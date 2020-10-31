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
            $sDate = $this->security->xss_clean($this->input->get('sDate'));
            $eDate = $this->security->xss_clean($this->input->get('eDate'));

            if(empty($sDate)){
                $sDate = date("F d, Y", strtotime("-29days"));
            }
            else{
                $sDate = date("F d, Y", strtotime($sDate));
            }

            if(empty($eDate)){
                $eDate = date("F d, Y");
            }
            else{
                $eDate = date("F d, Y", strtotime($eDate));
            }

            $this->startDate = date("Y-m-d 00:00:00", strtotime($sDate));
            $this->endDate = date("Y-m-d 23:59:59", strtotime($eDate));

            $data['sDate'] = $sDate;
            $data['eDate'] = $eDate;
            $data['dataRecords'] = $this->booking_model->bookingListing($this->startDate, $this->endDate, true);
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Booking';
            $data['pagePath'] = 'BookingList';
            
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
            $data['pagePath'] = 'AddBooking';
            $data['serviceInfo'] = $this->getFullServiceInfo(true);
            $data['teamInfo'] = $this->getTeamInfo();
            $data['productInfo'] = $this->getInventoryInfo();
            $data['arrTimeSlots'] = $this->getAllTimeSlots();
            $data['arrCustomers'] = $this->customers_model->customerListing();
            
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
                $arrAllSlots = $this->getAllTimeSlots();

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
                $taBookingNotes = $this->security->xss_clean($this->input->post('taBookingNotes'));

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
                print_r($arrAllSlots);
                print_r($txtPersonCount);
                print_r($lstServicer);
                print_r($lstProduct);
                die();*/
                
                
                $arrCartMasterInfo = array("customer_id" => $customerId, 
                                            "service_date" => $txtBookingDate, 
                                            "service_time" => $hdAvailableTime,
                                            "booking_note" => $taBookingNotes,
                                            "vat" => $txtVat,
                                            "service_charge" => $txtServiceCharge,
                                            "discount_price" => $txtDiscount,
                                            "status" => "PN",
                                            "booking_type" => ($rdServiceType == 'HS' ? 'home' : "saloon"),
                                            "total_price" => 0,
                                            "add_date" => date('Y-m-d H:i:s'),
                                            'created_by'=>$this->vendorId
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
                                        "add_date"              => date('Y-m-d H:i:s'),
                                        'created_by'=>$this->vendorId
                                    );

                    $cartPersonalInfoId = $this->cart_model->addIntoCartPersonalInfo($arrPersonalInfo);


                    $cartTotalPrice = 0;
                    $totalTeam = 0;
                    $arrSlots = array();

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){
                            $arrCartInfo = array("cartmaster_id" => $cartMasterId,
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                "add_date" => date('Y-m-d H:i:s'),
                                                'created_by'=>$this->vendorId
                                            );
                            $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);

                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];
                            
                            for($intSlotCount = 1; $intSlotCount <= ($arrAllServices[$value]["time_duration"] * 2); $intSlotCount++){
                                $arrSlots[] = $value;
                            }
                        }
                    }

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            $arrServicerInfo = array("cartmaster_id" => $cartMasterId,
                                                    "team_id" => $value,
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s'),
                                                    'created_by'=>$this->vendorId
                                                );

                            $cartServicerId = $this->cart_model->addIntoCartServicerInfo($arrServicerInfo);
                            

                            foreach ($lstProduct[$key] as $key1 => $value1) {
                                $arrProductInfo = array("cartmaster_id" => $cartMasterId,
                                                    "cart_servicer_id" => $cartServicerId,
                                                    "team_id" => $value,
                                                    "product_id" => $value1,
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s'),
                                                    'created_by'=>$this->vendorId
                                                );

                                $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);
                            }
                            $totalTeam++;
                            //Function call for add into admin notification
                            $this->cart_model->addIntoNotification($cartMasterId, "serviceboy", $value);
                        }
                    }

                    if(!empty($arrSlots) && $totalTeam > 0){
                        $indexOfSelectedSlot = array_search($hdAvailableTime, $arrAllSlots);
                        foreach ($arrSlots as $valueSlot) {
                            $arrSlotsInfo = array("cartmaster_id" => $cartMasterId,
                                            "service_id" => $valueSlot,
                                            "booking_date" => $txtBookingDate,
                                            "time_slot" => $arrAllSlots[$indexOfSelectedSlot++],
                                            "team_members_count" => $totalTeam,
                                            "add_date" => date('Y-m-d H:i:s'),
                                            'created_by'=>$this->vendorId
                                        );

                            $bookingSlotsId = $this->cart_model->addIntoBookingTimeSlotsInfo($arrSlotsInfo);
                        }
                    }

                    if($txtDiscount > 0){
                        $cartTotalPrice -= (($cartTotalPrice/100) * $txtDiscount);

                        if($cartTotalPrice < 0) $cartTotalPrice = 0;
                    }

                    $cartTotalPrice += $cartTotalPrice * 0.05;

                    $arrCartMasterInfo = array( "total_price" => $cartTotalPrice, "order_id" => "ES" . $cartMasterId, 'invoice_number' => date('Ymd') . "-" . $cartMasterId);
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
            $data['arrTimeSlots'] = $this->getAllTimeSlots();

            if(empty($data['bookingInfo']))
            {
                redirect('securepanel/booking');
            }
            $data['pagePath'] = 'EditBooking';
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
                $arrAllSlots = $this->getAllTimeSlots();

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
                $taBookingNotes = $this->security->xss_clean($this->input->post('taBookingNotes'));
                             
                $arrCartMasterInfo = array(
                                            "service_date" => $txtBookingDate, 
                                            "service_time" => $hdAvailableTime,
                                            "booking_note" => $taBookingNotes,
                                            "vat" => $txtVat,
                                            "service_charge" => $txtServiceCharge,
                                            "discount_price" => $txtDiscount,
                                            "status" => "CN",
                                            "booking_type" => ($rdServiceType == 'HS' ? 'home' : "saloon"),
                                            'updated_by' => $this->vendorId, 
                                            'update_date' => date('Y-m-d H:i:s')
                                        );

                $result = $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);
                if($result){  

                    $cartTotalPrice = 0;
                    $totalTeam = 0;
                    $arrSlots = array();

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){


                            if(isset($hdCartIds[$key]) && !empty($hdCartIds[$key])){
                                $arrCart = $this->cart_model->checkcartExist($hdCartIds[$key]);

                                if(!empty($arrCart)){
                                    $arrCartInfo = array(
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                'updated_by' => $this->vendorId, 
                                                'update_date' => date('Y-m-d H:i:s')
                                            );
                                    $cartId = $this->cart_model->updateCartInfo($arrCartInfo, $hdCartIds[$key]);
                                }
                                else{
                                    $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                "service_id" => $value,
                                                "price" => $arrAllServices[$value]["price"],
                                                "person" => $txtPersonCount[$key],
                                                "add_date" => date('Y-m-d H:i:s'),
                                                'created_by'=>$this->vendorId
                                            );
                                    $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                                }
                            }
                            else{
                                $arrCartInfo = array("cartmaster_id" => $bookingId,
                                                    "service_id" => $value,
                                                    "price" => $arrAllServices[$value]["price"],
                                                    "person" => $txtPersonCount[$key],
                                                    "add_date" => date('Y-m-d H:i:s'),
                                                    'created_by'=>$this->vendorId
                                                );
                                $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);
                            }
                            
                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];

                            for($intSlotCount = 1; $intSlotCount <= ($arrAllServices[$value]["time_duration"] * 2); $intSlotCount++){
                                $arrSlots[] = $value;
                            }
                        }
                    }


                    $arrProductInfo = array(
                                            'updated_by' => $this->vendorId, 
                                            'update_date' => date('Y-m-d H:i:s'),
                                            "is_deleted"    => "1",
                                            "status"        => 'IN',
                                        );
                    $this->cart_model->updateCartServicerInfoUsingCMID($arrProductInfo, $bookingId);
                    $this->cart_model->updateCartServicerProductInfoUsingCMID($arrProductInfo, $bookingId);

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            $arrServicerInfo = array("cartmaster_id" => $bookingId,
                                                    "team_id" => $value,
                                                    "status" => "AC",
                                                    "add_date" => date('Y-m-d H:i:s'),
                                                    'created_by'=>$this->vendorId
                                                );

                            $cartServicerId = $this->cart_model->addIntoCartServicerInfo($arrServicerInfo);
                            
                            if(isset($lstProduct[$key]) && !empty($lstProduct[$key])){
                                foreach ($lstProduct[$key] as $key1 => $value1) {
                                    $arrProductInfo = array("cartmaster_id" => $bookingId,
                                                        "cart_servicer_id" => $cartServicerId,
                                                        "team_id" => $value,
                                                        "product_id" => $value1,
                                                        "status" => "AC",
                                                        "add_date" => date('Y-m-d H:i:s'),
                                                        'created_by'=>$this->vendorId
                                                    );

                                    $cartProductId = $this->cart_model->addIntoCartServicerProductInfo($arrProductInfo);
                                }
                            }
                            
                            //Function call for add into admin notification
                            $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                            $totalTeam++;
                        }
                    }

                    $arrSlotsInfo = array(
                                            'updated_by' => $this->vendorId, 
                                            'update_date' => date('Y-m-d H:i:s'),
                                            'deleted_date' => date('Y-m-d H:i:s'),
                                            "is_deleted"    => "1"
                                        );
                    $this->cart_model->updateBookingTimeSlotsInfo($arrSlotsInfo, $bookingId);

                    if(!empty($arrSlots) && $totalTeam > 0){
                        $indexOfSelectedSlot = array_search($hdAvailableTime, $arrAllSlots);
                        foreach ($arrSlots as $valueSlot) {
                            $arrSlotsInfo = array("cartmaster_id" => $bookingId,
                                            "service_id" => $valueSlot,
                                            "booking_date" => $txtBookingDate,
                                            "time_slot" => $arrAllSlots[$indexOfSelectedSlot++],
                                            "team_members_count" => $totalTeam,
                                            "add_date" => date('Y-m-d H:i:s'),
                                            'created_by'=>$this->vendorId
                                        );

                            $bookingSlotsId = $this->cart_model->addIntoBookingTimeSlotsInfo($arrSlotsInfo);
                        }
                    }

                    if($txtDiscount > 0){
                        $cartTotalPrice -= (($cartTotalPrice/100) * $txtDiscount);

                        if($cartTotalPrice < 0) $cartTotalPrice = 0;
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

    function deleteBooking(){
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $booking = $this->input->post('booking');
            $deleteNote = $this->input->post('deleteNote');
            $bookingInfo = array('deleted_from' => 'admin', 'delete_note' => $deleteNote,'is_deleted' => '1', 'deleted_id' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            
            $result = $this->cart_model->updateCartMaster($bookingInfo, $booking);
            
            if ($result > 0) { 
                        
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
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
            
            
            $data['bookingInfo'] = $this->booking_model->getBookingInfo($bookingId, true);
            $data['bookingTeamProductInfo'] = $this->booking_model->getBookingServicerProductInfo($bookingId);
            $data['serviceInfo'] = $this->getFullServiceInfo(true);
            $data['teamInfo'] = $this->getTeamInfo();
            $data['productInfo'] = $this->getInventoryInfo();
            $data['arrTimeSlots'] = $this->getAllTimeSlots();

            if(empty($data['bookingInfo']))
            {
                redirect('securepanel/booking');
            }
            $data['pagePath'] = 'ViewBooking';
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
                                            "status" => "CN"
                                        );

                $result = $this->cart_model->updateCartMaster($arrCartMasterInfo, $bookingId);
                if($result){  

                    $cartTotalPrice = 0;

                    foreach ($lstService as $key => $value) {
                        if(!empty($value)){
                            $cartTotalPrice += $txtPersonCount[$key] * $arrAllServices[$value]["price"];
                        }
                    }

                    foreach ($lstServicer as $key => $value) {
                        if(!empty($value)){
                            //Function call for add into admin notification
                            $this->cart_model->addIntoNotification($bookingId, "serviceboy", $value);
                        }
                    }
                    if($txtDiscount > 0){
                        $cartTotalPrice -= (($cartTotalPrice/100) * $txtDiscount);

                        if($cartTotalPrice < 0) $cartTotalPrice = 0;
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
                                "name" => $value->team_id . " - " . $value->first_name . " " . $value->last_name);
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
        $dataRecords = $this->booking_model->bookingListing(true);
        $arrFinalCalendarData = array();
        foreach ($dataRecords as $cartMasterId => $arrCartInfo) {
            $teamName = '';
            if(!empty($arrCartInfo['teamInfo'])){
                foreach ($arrCartInfo['teamInfo'] as $key => $value) {
                    $teamName .= $value['first_name'] . " " . $value['last_name'] . ", ";
                }

                $teamName = " - " . trim($teamName, ", ");
            }

            foreach ($arrCartInfo['serviceAllInfo'] as $key => $value) {
                $startDate = date("Y-m-d H:i:s", strtotime($value['service_date'] . " " . $value['service_time']));
                $endDate = date("Y-m-d H:i:s", strtotime($startDate . " +" . (15 * $value['time_duration']) . "minutes"));
                $arrFinalCalendarData[$value['cartId']] = array(
                                                            "title" => ucwords(strtolower($value['serviceCategory'])) . " " . strtolower($value['serviceName']) . $teamName,
                                                            "strDateTime" => $startDate,
                                                            "endDateTime" => $endDate,
                                                            "person" => $value['person']
                                                        );
            }
            
        }
        return $arrFinalCalendarData;
    }

    function getAllTimeSlots(){
        $objTimeSlots = $this->cart_model->getAllTimeSlots();
        $arrResult = array();
        
        if(!empty($objTimeSlots)){
            foreach ($objTimeSlots as $key => $value) {
                $arrResult[$key] = $value->title;
            }
        }
        
        return $arrResult;
    }

    function checkBookingSlotAvailability(){
        $bookingDate = $this->security->xss_clean($this->input->post('bookingDate'));
        $bookingId = $this->security->xss_clean($this->input->post('bookingId'));
        $arrTeam = $this->team_model->teamListing();

        $currentDate = date("Y-m-d");
        $currentTime = date("H:i A");

        $totalTeamCount = count($arrTeam);
        $arrAllSlots = $this->getAllTimeSlots();
        $objSlotsInfo = $this->cart_model->getBookingTimeSlotsInfo($bookingDate, $bookingId);

        foreach ($objSlotsInfo as $key => $value) {
            $arrBookedSlots[$value->time_slot] = $value->totalCount;
        }

        $arrSkippableDate = array();
        if($currentDate == $bookingDate){
            foreach ($arrAllSlots as $key => $value) {
                if(strtotime($currentDate . ' ' . $currentTime) >= strtotime($bookingDate . ' ' . $value)){
                    $arrSkippableDate[] = $value;
                }
            }
        }
        
        $arrAvailableSlots = array();
        foreach ($arrAllSlots as $key => $value) {
            if(isset($arrBookedSlots[$value]) && !empty($arrBookedSlots[$value])){
                if($arrBookedSlots[$value] < $totalTeamCount && !in_array($value, $arrSkippableDate)){
                    $arrAvailableSlots[preg_replace('/[^0-9A-Za-z]/i', '', $value)] = $value;
                }
            }
            else{
                if(!in_array($value, $arrSkippableDate)){
                    $arrAvailableSlots[preg_replace('/[^0-9A-Za-z]/i', '', $value)] = $value;
                }
            }
        }

        echo(json_encode(array('status'=>TRUE, "slots" => $arrAvailableSlots))); 
    }

    function checkCustomerInfo(){
        $customerEmail = $this->security->xss_clean($this->input->post('customerEmail'));

        $objCustInfo = $this->customers_model->getCustomerInfoUsingEmail($customerEmail);

        $arrCustInfo = (array) $objCustInfo;

        if(!empty($arrCustInfo)){
            echo(json_encode(array('status'=>TRUE, "custInfo" => $arrCustInfo))); 
        }
    }
}

?>