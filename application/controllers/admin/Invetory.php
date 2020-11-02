<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Products (UserController)
 * Products Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Invetory extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invetory_model');
        $this->load->model('supplier_model');
        $this->load->model('team_model');
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
            $data['dataRecords'] = $this->invetory_model->productListing('', $this->startDate, $this->endDate);
            $data['supplierRecords'] = $this->getAllSupplierInfo();
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Inventory';
            
            $this->loadViews("admin/invetory/listing", $this->global, $data, NULL);
        }
    }

    function listingEmployeeReport($pagination = "")
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
            $data['dataRecords'] = $this->invetory_model->employeeProductSellingListing($this->startDate, $this->endDate);
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Inventory Employee Report';
            
            $this->loadViews("admin/invetory/listingemployeereport", $this->global, $data, NULL);
        }
    }

    function listingProductReport($pagination = "")
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
            $data['dataRecords'] = $this->invetory_model->productSellingListing($this->startDate, $this->endDate);
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Inventory Sale Report';
            
            $this->loadViews("admin/invetory/listingproductreport", $this->global, $data, NULL);
        }
    }

    function addNewProduct($searchUserId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
            $data['supplierRecords'] = $this->getAllSupplierInfo();
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Product';

            $this->loadViews("admin/invetory/add", $this->global, $data, NULL);
        }
    }

    function addNewProductInformation()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            /*echo "<pre>";
            print_r($_REQUEST);
            die();*/
            
            $this->form_validation->set_rules('txtInvoiceNumber','Invoice Number','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstSupplier','Supplier','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCategory','Catogory','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtName','Name Of Product','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtQuantity','Quantity','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtDate','Date Of added','trim|required|max_length[20]');
            $this->form_validation->set_rules('txtCostOfBuy','Cost of Buy','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtBuyTax','Buy Tax','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtCostOfSell','Cost of Sell','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtSellTax','Sell Tax','trim|required|max_length[50]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
         
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewProduct();
            }
            else
            {
                $txtInvoiceNumber =$this->security->xss_clean($this->input->post('txtInvoiceNumber'));
                $lstSupplier =$this->security->xss_clean($this->input->post('lstSupplier'));
                $lstCategory =$this->security->xss_clean($this->input->post('lstCategory'));
                $txtName =$this->security->xss_clean($this->input->post('txtName'));
                $txtNameAr =$this->security->xss_clean($this->input->post('txtNameAr'));
                $txtQuantity =$this->security->xss_clean($this->input->post('txtQuantity'));
                $txtDate =$this->security->xss_clean($this->input->post('txtDate'));
                $txtCostOfBuy =$this->security->xss_clean($this->input->post('txtCostOfBuy'));
                $txtBuyTax =$this->security->xss_clean($this->input->post('txtBuyTax'));
                $txtCostOfSell =$this->security->xss_clean($this->input->post('txtCostOfSell'));
                $txtSellTax =$this->security->xss_clean($this->input->post('txtSellTax'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                        
                
                $productInfo = array('invoice_number'=> $txtInvoiceNumber, 
                                'suppliers_id'=> $lstSupplier, 
                                'category_id'=> $lstCategory, 
                                'title'=> $txtName, 
                                'title_ar'=> $txtNameAr, 
                                'quantity'=> $txtQuantity, 
                                'remaining_quantity'=> $txtQuantity, 
                                'date_of_add'=> $txtDate, 
                                'cost_of_buy'=> $txtCostOfBuy, 
                                'buy_tax'=> $txtBuyTax, 
                                'cost_of_sell'=> $txtCostOfSell, 
                                'sell_tax' => $txtSellTax, 
                                'status' => $rdStatus, 
                                'created_by'=>$this->vendorId, 
                                'add_date' => date('Y-m-d H:i:s'));                
          
                $result = $this->invetory_model->addNewProduct($productInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Record is added successfully');
                    redirect('securepanel/invetory');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    redirect('securepanel/invetory');
                }

            }
        }
    }

    function editProduct($productId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($productId == null)
            {
                redirect('securepanel/invetory');
            }
            
            
            $data['productInfo'] = $this->invetory_model->getProductInfo($productId);

            if(empty($data['productInfo']))
            {
                redirect('securepanel/invetory');
            }

            $data['supplierRecords'] = $this->getAllSupplierInfo();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Product';
            
            $this->loadViews("admin/invetory/edit", $this->global, $data, NULL);
        }
    }
    
    function updateProduct()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
        
            $productId = $this->input->post('productId');
            
            $this->form_validation->set_rules('txtInvoiceNumber','Invoice Number','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstSupplier','Supplier','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCategory','Catogory','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtName','Name Of Product','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtQuantity','Quantity','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtDate','Date Of added','trim|required|max_length[20]');
            $this->form_validation->set_rules('txtCostOfBuy','Cost of Buy','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtBuyTax','Buy Tax','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtCostOfSell','Cost of Sell','trim|required|max_length[50]');
            $this->form_validation->set_rules('txtSellTax','Sell Tax','trim|required|max_length[50]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->editProduct($productId);
            }
            else
            {
                
                $txtInvoiceNumber =$this->security->xss_clean($this->input->post('txtInvoiceNumber'));
                $lstSupplier =$this->security->xss_clean($this->input->post('lstSupplier'));
                $lstCategory =$this->security->xss_clean($this->input->post('lstCategory'));
                $txtName =$this->security->xss_clean($this->input->post('txtName'));
                $txtNameAr =$this->security->xss_clean($this->input->post('txtNameAr'));
                $txtQuantity =$this->security->xss_clean($this->input->post('txtQuantity'));
                $txtDate =$this->security->xss_clean($this->input->post('txtDate'));
                $txtCostOfBuy =$this->security->xss_clean($this->input->post('txtCostOfBuy'));
                $txtBuyTax =$this->security->xss_clean($this->input->post('txtBuyTax'));
                $txtCostOfSell =$this->security->xss_clean($this->input->post('txtCostOfSell'));
                $txtSellTax =$this->security->xss_clean($this->input->post('txtSellTax'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                
                $productInfo = array('invoice_number'=> $txtInvoiceNumber, 
                                'suppliers_id'=> $lstSupplier, 
                                'category_id'=> $lstCategory, 
                                'title'=> $txtName, 
                                'title_ar'=> $txtNameAr, 
                                'quantity'=> $txtQuantity, 
                                'remaining_quantity'=> $txtQuantity, 
                                'date_of_add'=> $txtDate, 
                                'cost_of_buy'=> $txtCostOfBuy, 
                                'buy_tax'=> $txtBuyTax, 
                                'cost_of_sell'=> $txtCostOfSell, 
                                'sell_tax' => $txtSellTax, 
                                'status' => $rdStatus,
                                'updated_by' => $this->vendorId, 
                                'update_date' => date('Y-m-d H:i:s'));    
                        
                $result = $this->invetory_model->updateProduct($productInfo, $productId);
                if($result){
                    $this->recalculateRemainingQuantity($productId, $txtQuantity);
                    $this->session->set_flashdata('success', 'Record is updated successfully');
                     redirect('securepanel/invetory');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    $this->editProduct($productId);
                }
            }           
        }
    }

    function deleteProduct()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $productId = $this->input->post('productId');
            $productInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            
            
            $result = $this->invetory_model->deleteProduct($productId, $productInfo);
            
            if ($result > 0) { 
                        
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    function sellProduct(){
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
            $this->global['pagePath'] = 'sellProduct';
            $data['productsInfo'] = $this->invetory_model->productListing("AC");
            $data['teamInfo'] = $this->team_model->teamListing("AC");
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Sell Product';

            $this->loadViews("admin/invetory/sell", $this->global, $data, NULL);
        }
    }

    function addSellProductInformation(){
        if($this->isAdminCommon() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        }
        else {
            $lstProduct =$this->security->xss_clean($this->input->post('lstProduct'));
            $txtCustomerName =$this->security->xss_clean($this->input->post('txtCustomerName'));
            $txtQuantity =$this->security->xss_clean($this->input->post('txtQuantity'));
            $txtPrice =$this->security->xss_clean($this->input->post('txtPrice'));
            $hdTaxRate =$this->security->xss_clean($this->input->post('hdTaxRate'));
            $lstEmployee =$this->security->xss_clean($this->input->post('lstEmployee'));

            $totalPrice = $txtQuantity * $txtPrice;
            $totalPrice += $totalPrice * ($hdTaxRate / 100);

            $productInfo = array('product_id' => $lstProduct,
                                'team_id' => $lstEmployee,
                                'customer_name' => $txtCustomerName,
                                'quantity' => $txtQuantity,
                                'item_price' => $txtPrice,
                                'tax' => $hdTaxRate,
                                'total_price' => $totalPrice,
                                'status' => 'AC', 
                                'created_by'=>$this->vendorId, 
                                'add_date' => date('Y-m-d H:i:s'));

            $result = $this->invetory_model->addSellProduct($productInfo);
            
            if ($result > 0) {
                //Update Invoice Number
                $arrProductUpInfo = array("invoice_number" => date('Ymd') . "000" . $result); 
                $this->invetory_model->updateSellProduct($arrProductUpInfo, $result);

                $this->recalculateRemainingQuantity($lstProduct);
                echo(json_encode(array('status'=>TRUE, "product_sale_id" => $result))); 
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

    function activeDeactiveSurvey(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            echo(json_encode(array('status'=>'access')));
        }
        else{

            $productId = $this->input->post('productId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($productId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $statusInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->invetory_model->updatSurvey($statusInfo, $productId);
                

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

    function addDummyProduct(){
        $productInfo = array('status' => 'IN', 
                        'created_by'=>$this->vendorId, 
                        'add_date' => date('Y-m-d H:i:s'));                
  
        $productId = $this->invetory_model->addNewProduct($productInfo);

        return $productId;
    }

    function getAllSupplierInfo(){
        $objSupplierInfo = $this->supplier_model->supplierListing(/*"AC"*/);

        $arrReturn = array();

        foreach ($objSupplierInfo as $key => $value) {
            $arrReturn[$value->id] = (array)$value;
            $arrCategory = explode(',_,_,', $value->category);
            $arrReturn[$value->id]['category'] = $arrCategory;
        }

        /*echo "<pre>";
        print_r($arrReturn);
        die();*/

        return $arrReturn;
    }

    function recalculateRemainingQuantity($productId, $totalQuantity = null){
        $objProductSales = $this->invetory_model->getProductSellDetails($productId);

        $sellQuantity = (isset($objProductSales->totalSale) ? $objProductSales->totalSale : 0);

        if(is_null($totalQuantity)){
            $arrProductInfo = $this->invetory_model->getProductInfo($productId);
            $totalQuantity = $arrProductInfo->quantity;
        }

        $remaining_quantity = ($totalQuantity - $sellQuantity);
        $productInfo = array( 'remaining_quantity'=> $remaining_quantity );  
        if($remaining_quantity <= 0){
            $productInfo['status'] = 'IN';
        }                  
        $result = $this->invetory_model->updateProduct($productInfo, $productId);
    }
}

?>