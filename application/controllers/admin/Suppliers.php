<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Suppliers (UserController)
 * Suppliers Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Suppliers extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('supplier_model');
        $this->isLoggedIn();   
    }
   
    function suppliersListing($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['supplierRecords'] = $this->supplier_model->supplierListing('', 'SD');
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Suppliers';
            
            $this->loadViews("admin/suppliers/supplierslisting", $this->global, $data, NULL);
        }
    }

    function addNewSupplier($searchUserId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
            $this->global['pagePath'] = 'supplier';
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Supplier';

            $this->loadViews("admin/suppliers/addSupplier", $this->global, $data, NULL);
        }
    }

    function addNewSupplierInformation()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('txtTitle','Name Of Supplers','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtCountry','Country','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtCity','City','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPostCode','Post Code','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtFax','Fax','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtWeb','Web','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtEmail','Email','trim|required|valid_email|max_length[250]');
            $this->form_validation->set_rules('txtCatogory','Catogory','trim|required|max_length[250]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
         
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewSurvey();
            }
            else
            {
                $txtTitle =$this->security->xss_clean($this->input->post('txtTitle'));
                $txtCountry =$this->security->xss_clean($this->input->post('txtCountry'));
                $txtCity =$this->security->xss_clean($this->input->post('txtCity'));
                $txtPostCode =$this->security->xss_clean($this->input->post('txtPostCode'));
                $txtPhone =$this->security->xss_clean($this->input->post('txtPhone'));
                $txtFax =$this->security->xss_clean($this->input->post('txtFax'));
                $txtWeb =$this->security->xss_clean($this->input->post('txtWeb'));
                $txtEmail =$this->security->xss_clean($this->input->post('txtEmail'));
                $txtCatogory =$this->security->xss_clean($this->input->post('txtCatogory'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                        
                
                $supplierInfo = array('title'=> $txtTitle, 
                                'country'=> $txtCountry, 
                                'city'=> $txtCity, 
                                'postcode'=> $txtPostCode, 
                                'phone'=> $txtPhone, 
                                'fax'=> $txtFax, 
                                'web'=> $txtWeb, 
                                'email'=> $txtEmail, 
                                'category'=> $txtCatogory, 
                                'status' => $rdStatus, 
                                'created_by'=>$this->vendorId, 
                                'add_date' => date('Y-m-d H:i:s'));                
          
                $result = $this->supplier_model->addNewSupplier($supplierInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Record is added successfully');
                    redirect('securepanel/suppliers');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    redirect('securepanel/suppliers');
                }

            }
        }
    }

    function editSupplier($supplierId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($supplierId == null)
            {
                redirect('securepanel/suppliers');
            }
            
            
            $data['supplierInfo'] = $this->supplier_model->getSupplierInfo($supplierId);

            if(empty($data['supplierInfo']))
            {
                redirect('securepanel/suppliers');
            }
            else if( $data['supplierInfo']->status == 'SD'){
                $this->session->set_flashdata('error', 'Sorry! Access restricted.');
                redirect('securepanel/suppliers');
            }
            $this->global['pagePath'] = 'supplier';
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Supplier';
            
            $this->loadViews("admin/suppliers/editSupplier", $this->global, $data, NULL);
        }
    }

    function detailSupplier($supplierId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($supplierId == null)
            {
                redirect('securepanel/suppliers');
            }
            
            
            $data['supplierInfo'] = $this->supplier_model->getSupplierInfo($supplierId);

            if(empty($data['supplierInfo']))
            {
                redirect('securepanel/suppliers');
            }
            else if( $data['supplierInfo']->status == 'SD'){
                $this->session->set_flashdata('error', 'Sorry! Access restricted.');
                redirect('securepanel/suppliers');
            }
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Supplier Details';
            
            $this->loadViews("admin/suppliers/details", $this->global, $data, NULL);
        }
    }
    
    function updateSupplier()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
        
            $supplierId = $this->input->post('supplierId');
            
            $this->form_validation->set_rules('txtTitle','Name Of Supplers','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtCountry','Country','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtCity','City','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPostCode','Post Code','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtFax','Fax','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtWeb','Web','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtEmail','Email','trim|required|valid_email|max_length[250]');
            $this->form_validation->set_rules('txtCatogory','Catogory','trim|required|max_length[250]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->editSupplier($supplierId);
            }
            else
            {
                
                $txtTitle =$this->security->xss_clean($this->input->post('txtTitle'));
                $txtCountry =$this->security->xss_clean($this->input->post('txtCountry'));
                $txtCity =$this->security->xss_clean($this->input->post('txtCity'));
                $txtPostCode =$this->security->xss_clean($this->input->post('txtPostCode'));
                $txtPhone =$this->security->xss_clean($this->input->post('txtPhone'));
                $txtFax =$this->security->xss_clean($this->input->post('txtFax'));
                $txtWeb =$this->security->xss_clean($this->input->post('txtWeb'));
                $txtEmail =$this->security->xss_clean($this->input->post('txtEmail'));
                $txtCatogory =$this->security->xss_clean($this->input->post('txtCatogory'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                             
                $supplierInfo = array('title'=> $txtTitle, 
                                    'country'=> $txtCountry, 
                                    'city'=> $txtCity, 
                                    'postcode'=> $txtPostCode, 
                                    'phone'=> $txtPhone, 
                                    'fax'=> $txtFax, 
                                    'web'=> $txtWeb, 
                                    'email'=> $txtEmail, 
                                    'category'=> $txtCatogory, 
                                    'status' => $rdStatus,
                                    'updated_by' => $this->vendorId, 
                                    'update_date' => date('Y-m-d H:i:s'));  
                        
                $result = $this->supplier_model->updateSupplier($supplierInfo, $supplierId);
                if($result){                    
                    $this->session->set_flashdata('success', 'Record is updated successfully');
                     redirect('securepanel/suppliers');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    $this->editSupplier($supplierId);
                }
            }           
        }
    }

    function deleteSupplier()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $supplierId = $this->input->post('supplierId');

            $supplierInfo = $this->supplier_model->getSupplierInfo($supplierId);
            
            if( $supplierInfo->status == 'SD'){
                echo(json_encode(array('status'=>'access')));
            }
            else{
                $supplierUpInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
                
                
                $result = $this->supplier_model->deleteSupplier($supplierId, $supplierUpInfo);
                
                if ($result > 0) { 
                            
                    echo(json_encode(array('status'=>TRUE))); 
                }
                else { 
                    echo(json_encode(array('status'=>FALSE))); 
                }
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

            $supplierId = $this->input->post('supplierId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($supplierId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $statusInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->supplier_model->updatSurvey($statusInfo, $supplierId);
                

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
}

?>