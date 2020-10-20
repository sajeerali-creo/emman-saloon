<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Customers (UserController)
 * Customers Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Customers extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model');
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
            $data['dataRecords'] = $this->customers_model->customerListing();
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Customers';
            
            $this->loadViews("admin/customers/listing", $this->global, $data, NULL);
        }
    }

    function deleteCustomer()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $customerId = $this->input->post('customerId');
            $customerInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            
            
            $result = $this->customers_model->deleteCustomer($customerId, $customerInfo);
            
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
}

?>