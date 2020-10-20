<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : booking (UserController)
 * booking Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Booking extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking_model');
        $this->load->model('service_model');
        $this->load->model('team_model');
        $this->load->model('customers_model');
        $this->load->model('cart_model');
        $this->load->model('invetory_model');
        $this->isLoggedIn();   
    }
   
    function listing($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['dataRecords'] = $this->booking_model->bookingListing();
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Booking';
            
            $this->loadViews("admin/booking/listing", $this->global, $data, NULL);
        }
    }

    function listingCalendar($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['arrFinalCalendarData'] = $this->getBookingInforForCalendar();
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Booking';
            
            $this->loadViews("admin/booking/calendar", $this->global, $data, NULL);
        }
    }

    function notification()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['dataRecords'] = $this->cart_model->getNotificationListing('admin');
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Notifications';
            
            $this->loadViews("admin/booking/notification", $this->global, $data, NULL);
        }
    }

    function addNewBooking($searchUserId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
            $data['serviceInfo'] = $this->getFullServiceInfo(true);
            $data['teamInfo'] = $this->getTeamInfo();
            $data['productInfo'] = $this->getInventoryInfo();
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Booking';

            $this->loadViews("admin/booking/add", $this->global, $data, NULL);
        }
    }

    function addNewBookingInformation()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('rdServiceType','Service Type','trim|required');
            $this->form_validation->set_rules('lstService[]','service','trim|required');
            $this->form_validation->set_rules('txtPersonCount[]','Number of Persons','trim|required');
            $this->form_validation->set_rules('txtBookingDate','Booking Date','trim|required');
            $this->form_validation->set_rules('hdAvailableTime','Booking Time','trim|required');
            $this->form_validation->set_rules('lstServicer[]','Servicer','trim|required');
            $this->form_validation->set_rules('txtCustomerName','Customer Name','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtCustomerEmail','Email','trim|required|valid_email|max_length[250]');
            $this->form_validation->set_rules('txtCustomerPhone','Phone','trim|required|max_length[250]');
         
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewBooking();
            }
            else
            {
                $arrAllServices = $this->getFullServiceInfo();

                $rdServiceType = $this->security->xss_clean($this->input->post('rdServiceType'));
                $lstService = $this->security->xss_clean($this->input->post('lstService'));
                $txtPersonCount = $this->security->xss_clean($this->input->post('txtPersonCount'));
                $txtBookingDate = $this->security->xss_clean($this->input->post('txtBookingDate'));
                $hdAvailableTime = $this->security->xss_clean($this->input->post('hdAvailableTime'));
                $lstServicer = $this->security->xss_clean($this->input->post('lstServicer'));
                $lstProduct = $this->security->xss_clean($this->input->post('lstProduct'));
                $txtServiceCharge = $this->security->xss_clean($this->input->post('txtServiceCharge'));
                $txtDiscount = $this->security->xss_clean($this->input->post('txtDiscount'));
                $txtVat = $this->security->xss_clean($this->input->post('txtVat'));
                $txtCustomerName = $this->security->xss_clean($this->input->post('txtCustomerName'));
                $txtCustomerEmail = $this->security->xss_clean($this->input->post('txtCustomerEmail'));
                $txtCustomerPhone = $this->security->xss_clean($this->input->post('txtCustomerPhone'));
                $taCustomerLocation = $this->security->xss_clean($this->input->post('taCustomerLocation'));

                //check customer exist
                $arrCustomerInfo = $this->customers_model->checkCustomerExist($txtCustomerEmail, $txtCustomerPhone);

                if(!empty($arrCustomerInfo)){
                    $customerId = $arrCustomerInfo->id;
                }
                else{
                    $userInfo = array('email' => $txtCustomerEmail, 'first_name'=> $txtCustomerName, 'last_name' => '', 'phone_number' => $txtCustomerPhone,'username' => $txtCustomerEmail,'location_full_address' => $taCustomerLocation, 'password' => getHashedPassword("123456"), 'add_date' => date('Y-m-d H:i:s'));

                    $customerId = $this->customers_model->addNewUserDetails($userInfo);
                }

                /*echo "<pre>";
                //print_r($arrAllServices);
                print_r($_REQUEST);
                print_r($lstService);
                print_r($txtPersonCount);
                print_r($lstServicer);
                print_r($lstProduct);
                die();*/
                
                
                $arrCartMasterInfo = array("customer_id" => $customerId, 
                                            "service_date" => $txtBookingDate, 
                                            "service_time" => $hdAvailableTime,
                                            "booking_note" => '',
                                            "vat" => $txtVat,
                                            "service_charge" => $txtServiceCharge,
                                            "discount_price" => $txtDiscount,
                                            "status" => "PN",
                                            "booking_type" => ($rdServiceType == 'HS' ? 'home' : "saloon"),
                                            "total_price" => 0,
                                            "add_date" => date('Y-m-d H:i:s')
                                        );

                $cartMasterId = $this->cart_model->addIntoCartMaster($arrCartMasterInfo);

                if($cartMasterId > 0){
                    $arrPersonalInfo = array("cartmaster_id"  => $cartMasterId, 
                                        "first_name"            => $txtCustomerName, 
                                        "last_name"             => '', 
                                        "email"                 => $txtCustomerEmail, 
                                        "phone"                 => $txtCustomerPhone, 
                                        "address"               => $taCustomerLocation,
                                        "location_latitude"     => '',
                                        "location_longitude"    => '',
                                        "add_date"              => date('Y-m-d H:i:s')
                                    );

                    $cartPersonalInfoId = $this->cart_model->addIntoCartPersonalInfo($arrPersonalInfo);


                    $cartTotalPrice = 0;

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){
                            $arrCartInfo = array("cartmaster_id" => $cartMasterId,
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                "add_date" => date('Y-m-d H:i:s')
                                            );
                            $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);

                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];
                        }
                    }

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            /*$arrServicerInfo = array("cartmaster_id" => $cartMasterId,
                                                    "team_id" => $value,
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );

                            $cartServicerId = $this->cart_model->addIntoCartServicerInfo($arrServicerInfo);*/
                            


                            $arrProductInfo = array("cartmaster_id" => $cartMasterId,
                                                    "team_id" => $value,
                                                    "product_id" => $lstProduct[$key],
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );

                            $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);

                            //Function call for add into admin notification
                            $this->cart_model->addIntoNotification($cartMasterId, "serviceboy", $value);
                        }
                    }

                    $cartTotalPrice += $cartTotalPrice * 0.05;

                    $arrCartMasterInfo = array( "total_price" => $cartTotalPrice, "order_id" => "ES" . $cartMasterId);
                    $this->cart_model->updateCartMaster($arrCartMasterInfo, $cartMasterId);

                    $this->session->set_flashdata('success', 'Booking is added successfully');

                    /*echo "<pre>";
                    print_r($arrAllServices);
                    print_r($lstService);
                    print_r($txtPersonCount);
                    print_r($lstServicer);
                    print_r($lstProduct);
                    die();*/
                    redirect('securepanel/booking');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    redirect('securepanel/booking');
                }

            }
        }
    }

    function editBooking($bookingId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($bookingId == null)
            {
                redirect('securepanel/booking');
            }
            
            
            $data['bookingInfo'] = $this->booking_model->getBookingInfo($bookingId);
            $data['bookingTeamProductInfo'] = $this->booking_model->getBookingServicerProductInfo($bookingId);
            $data['serviceInfo'] = $this->getFullServiceInfo(true);
            $data['teamInfo'] = $this->getTeamInfo();
            $data['productInfo'] = $this->getInventoryInfo();

            if(empty($data['bookingInfo']))
            {
                redirect('securepanel/booking');
            }
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Booking';
            
            $this->loadViews("admin/booking/edit", $this->global, $data, NULL);
        }
    }
    
    function updateBooking()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            /*echo "<pre>";
            print_r($_REQUEST);
            die();*/
            $this->load->library('form_validation');
        
            $bookingId = $this->input->post('bookingId');
            
            $this->form_validation->set_rules('rdServiceType','Service Type','trim|required');
            $this->form_validation->set_rules('lstService[]','service','trim|required');
            $this->form_validation->set_rules('txtPersonCount[]','Number of Persons','trim|required');
            $this->form_validation->set_rules('txtBookingDate','Booking Date','trim|required');
            $this->form_validation->set_rules('hdAvailableTime','Booking Time','trim|required');
            $this->form_validation->set_rules('lstServicer[]','Servicer','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->editBooking($bookingId);
            }
            else
            {
                
                $arrAllServices = $this->getFullServiceInfo();

                $rdServiceType = $this->security->xss_clean($this->input->post('rdServiceType'));
                $lstService = $this->security->xss_clean($this->input->post('lstService'));
                $txtPersonCount = $this->security->xss_clean($this->input->post('txtPersonCount'));
                $txtBookingDate = $this->security->xss_clean($this->input->post('txtBookingDate'));
                $hdAvailableTime = $this->security->xss_clean($this->input->post('hdAvailableTime'));
                $lstServicer = $this->security->xss_clean($this->input->post('lstServicer'));
                $lstProduct = $this->security->xss_clean($this->input->post('lstProduct'));
                $txtServiceCharge = $this->security->xss_clean($this->input->post('txtServiceCharge'));
                $txtDiscount = $this->security->xss_clean($this->input->post('txtDiscount'));
                $txtVat = $this->security->xss_clean($this->input->post('txtVat'));
                $hdCartIds = $this->security->xss_clean($this->input->post('hdCartIds'));
                $hdCSPId = $this->security->xss_clean($this->input->post('hdCSPId'));
                             
                $arrCartMasterInfo = array(
                                            "service_date" => $txtBookingDate, 
                                            "service_time" => $hdAvailableTime,
                                            "vat" => $txtVat,
                                            "service_charge" => $txtServiceCharge,
                                            "discount_price" => $txtDiscount,
                                            "status" => "CN",
                                            "booking_type" => ($rdServiceType == 'HS' ? 'home' : "saloon")
                                        );

                $result = $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);
                if($result){  

                    $cartTotalPrice = 0;

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){


                            if(isset($hdCartIds[$key]) && !empty($hdCartIds[$key])){
                                $arrCart = $this->cart_model->checkcartExist($hdCartIds[$key]);

                                if(!empty($arrCart)){
                                    $arrCartInfo = array(
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key]
                                            );
                                    $cartId = $this->cart_model->updateCartInfo($arrCartInfo, $hdCartIds[$key]);
                                }
                                else{
                                    $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                "add_date" => date('Y-m-d H:i:s')
                                            );
                                    $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                                }
                            }
                            else{
                                $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                    "service_id" => $value,
                                                    "price" => $arrAllServices[$value]["price"],
                                                    "person" => $txtPersonCount[$key],
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );
                                $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                            }
                            
                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];
                        }
                    }

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            //var_dump($hdCSPId[$key]); die();

                            if(isset($hdCSPId[$key]) && !empty($hdCSPId[$key])){
                                $arrProduct = $this->cart_model->checkcartServiceProductExist($hdCSPId[$key]);

                                if(!empty($arrProduct)){
                                    $arrProductInfo = array(
                                                    "team_id" => $value,
                                                    "product_id" => $lstProduct[$key]
                                                );

                                    $cartProductId = $this->cart_model->updateCartServiceProductInfo($arrProductInfo, $hdCSPId[$key]);
                                }
                                else{
                                    $arrProductInfo = array("cartmaster_id" => $bookingId,
                                                    "team_id" => $value,
                                                    "product_id" => $lstProduct[$key],
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );

                                    $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);
                                    //Function call for add into admin notification
                                    $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                                }
                            }
                            else{
                                $arrProductInfo = array("cartmaster_id" => $bookingId,
                                                "team_id" => $value,
                                                "product_id" => $lstProduct[$key],
                                                "status" => "AC",
                                                "add_date" => date('Y-m-d H:i:s')
                                            );

                                $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);

                                //Function call for add into admin notification
                                $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                            }                            
                        }
                    }

                    $cartTotalPrice += $cartTotalPrice * 0.05;

                    $arrCartMasterInfo = array( "total_price" => $cartTotalPrice);
                    $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);

                    $this->session->set_flashdata('success', 'Booking is updated successfully');
                     redirect('securepanel/booking');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Booking is NOT updated successfully');
                    $this->editBooking($bookingId);
                }
            }           
        }
    }

    function viewBooking($bookingId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($bookingId == null)
            {
                redirect('securepanel/booking');
            }
            
            
            $data['bookingInfo'] = $this->booking_model->getBookingInfo($bookingId);
            $data['bookingTeamProductInfo'] = $this->booking_model->getBookingServicerProductInfo($bookingId);
            $data['serviceInfo'] = $this->getFullServiceInfo(true);
            $data['teamInfo'] = $this->getTeamInfo();
            $data['productInfo'] = $this->getInventoryInfo();

            if(empty($data['bookingInfo']))
            {
                redirect('securepanel/booking');
            }

            $this->cart_model->updateNotificationInfo($bookingId, "admin");
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : View Booking';
            
            $this->loadViews("admin/booking/view", $this->global, $data, NULL);
        }
    }

    function confirmBooking()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
        
            $bookingId = $this->input->post('bookingId');
            
            $this->form_validation->set_rules('rdServiceType','Service Type','trim|required');
            $this->form_validation->set_rules('lstService[]','service','trim|required');
            $this->form_validation->set_rules('txtPersonCount[]','Number of Persons','trim|required');
            $this->form_validation->set_rules('txtBookingDate','Booking Date','trim|required');
            $this->form_validation->set_rules('hdAvailableTime','Booking Time','trim|required');
            $this->form_validation->set_rules('lstServicer[]','Servicer','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->editBooking($bookingId);
            }
            else
            {
                
                $arrAllServices = $this->getFullServiceInfo();

                $rdServiceType = $this->security->xss_clean($this->input->post('rdServiceType'));
                $lstService = $this->security->xss_clean($this->input->post('lstService'));
                $txtPersonCount = $this->security->xss_clean($this->input->post('txtPersonCount'));
                $txtBookingDate = $this->security->xss_clean($this->input->post('txtBookingDate'));
                $hdAvailableTime = $this->security->xss_clean($this->input->post('hdAvailableTime'));
                $lstServicer = $this->security->xss_clean($this->input->post('lstServicer'));
                $lstProduct = $this->security->xss_clean($this->input->post('lstProduct'));
                $txtServiceCharge = $this->security->xss_clean($this->input->post('txtServiceCharge'));
                $txtDiscount = $this->security->xss_clean($this->input->post('txtDiscount'));
                $txtVat = $this->security->xss_clean($this->input->post('txtVat'));
                $hdCartIds = $this->security->xss_clean($this->input->post('hdCartIds'));
                $hdCSPId = $this->security->xss_clean($this->input->post('hdCSPId'));
                             
                $arrCartMasterInfo = array(
                                            "service_date" => $txtBookingDate, 
                                            "service_time" => $hdAvailableTime,
                                            "vat" => $txtVat,
                                            "service_charge" => $txtServiceCharge,
                                            "discount_price" => $txtDiscount,
                                            "status" => "CN",
                                            "booking_type" => ($rdServiceType == 'HS' ? 'home' : "saloon")
                                        );

                $result = $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);
                if($result){  

                    $cartTotalPrice = 0;

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){


                            if(isset($hdCartIds[$key]) && !empty($hdCartIds[$key])){
                                $arrCart = $this->cart_model->checkcartExist($hdCartIds[$key]);

                                if(!empty($arrCart)){
                                    $arrCartInfo = array(
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key]
                                            );
                                    $cartId = $this->cart_model->updateCartInfo($arrCartInfo, $hdCartIds[$key]);
                                }
                                else{
                                    $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                "add_date" => date('Y-m-d H:i:s')
                                            );
                                    $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                                }
                            }
                            else{
                                $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                    "service_id" => $value,
                                                    "price" => $arrAllServices[$value]["price"],
                                                    "person" => $txtPersonCount[$key],
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );
                                $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                            }
                            
                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];
                        }
                    }

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            //var_dump($hdCSPId[$key]); die();

                            if(isset($hdCSPId[$key]) && !empty($hdCSPId[$key])){
                                $arrProduct = $this->cart_model->checkcartServiceProductExist($hdCSPId[$key]);

                                if(!empty($arrProduct)){
                                    $arrProductInfo = array(
                                                    "team_id" => $value,
                                                    "product_id" => $lstProduct[$key]
                                                );

                                    $cartProductId = $this->cart_model->updateCartServiceProductInfo($arrProductInfo, $hdCSPId[$key]);
                                }
                                else{
                                    $arrProductInfo = array("cartmaster_id" => $bookingId,
                                                    "team_id" => $value,
                                                    "product_id" => $lstProduct[$key],
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s')
                                                );

                                    $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);
                                    //Function call for add into admin notification
                                    $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                                }
                            }
                            else{
                                $arrProductInfo = array("cartmaster_id" => $bookingId,
                                                "team_id" => $value,
                                                "product_id" => $lstProduct[$key],
                                                "status" => "AC",
                                                "add_date" => date('Y-m-d H:i:s')
                                            );

                                $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);
                                //Function call for add into admin notification
                                $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                            }                            
                        }
                    }

                    $cartTotalPrice += $cartTotalPrice * 0.05;

                    $arrCartMasterInfo = array( "total_price" => $cartTotalPrice);
                    $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);

                    $this->session->set_flashdata('success', 'Booking is updated successfully');
                     redirect('securepanel/booking');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Booking is NOT updated successfully');
                    $this->editBooking($bookingId);
                }
            }           
        }
    }

    function deleteBooking()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $bookingId = $this->input->post('bookingId');
            $bookingInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            
            
            $result = $this->booking_model->deleteBooking($bookingId, $bookingInfo);
            
            if ($result > 0) { 
                        
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = PROJECT_NAME . ' : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function activeDeactiveSurvey()
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            echo(json_encode(array('status'=>'access')));
        }
        else{

            $bookingId = $this->input->post('bookingId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($bookingId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $statusInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->booking_model->updatSurvey($statusInfo, $bookingId);
                

                if($result == true){

                    echo(json_encode(array('status'=>TRUE))); 
                }
                else { 
                    echo(json_encode(array('status'=>FALSE))); 
                } 
            }  
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }          
        }
    }

    function getFullServiceInfo($flGroupByCategory = false)
    {
        $arrServices = $this->service_model->getAllServices();
        $arrReturn = array();
        
        if($flGroupByCategory){
            foreach ($arrServices as $key => $value) {
                $arrReturn[$value->category_id]['categoryName'] = $value->category_name;
                $arrReturn[$value->category_id]['services'][] = array("id" => $value->id,
                                                                        "title" => $value->title,
                                                                        "price" => $value->price);
            }
        }
        else{
            foreach ($arrServices as $key => $value) {
                $arrReturn[$value->id] = (array)$value;
            }
        }

        return $arrReturn;
    }

    function getTeamInfo()
    {
        $arrTeam = $this->team_model->teamListing();
        $arrReturn = array();
        foreach ($arrTeam as $key => $value) {
            $arrReturn[] = array("id" => $value->id, 
                                "name" => $value->first_name . " " . $value->last_name);
        }
        /*echo "<pre>";
        print_r($arrReturn);
        die();*/

        return $arrReturn;
    }

    function getInventoryInfo()
    {
        $objProducts = $this->invetory_model->productListing();
        $arrData = array();
        foreach ($objProducts as $key => $value) {
            $arrData[] = array("id" => $value->id, "title" => $value->title);
        }

        return $arrData;     
    }

    function getBookingInforForCalendar(){
        $dataRecords = $this->booking_model->bookingListing();
        $arrFinalCalendarData = array();
        foreach ($dataRecords as $cartMasterId => $arrCartInfo) {
            foreach ($arrCartInfo['serviceAllInfo'] as $key => $value) {
                $arrFinalCalendarData[$value['cartId']] = array(
                                                            "title" => ucwords(strtolower($value['serviceCategory'])) . " " . strtolower($value['serviceName']),
                                                            "strDateTime" => date("Y-m-d H:i:s", strtotime($value['service_date'] . " " . $value['service_time'])),
                                                            "person" => $value['person']
                                                        );
            }
            
        }
        return $arrFinalCalendarData;
    }
}

?>