<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Services (UserController)
 * Services Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Services extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        $this->isLoggedIn();   
    }
   
    function servicesListing($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['serviceRecords'] = $this->service_model->serviceListing();
			
            //echo "<pre>"; print_r($data['userRecords']);die();
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Services';
            
            $this->loadViews("admin/services/serviceslisting", $this->global, $data, NULL);
        }
    }

    function addNewService($searchUserId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
			
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Service';
            $data['serviceCatInfo'] = $this->service_model->getAllServiceCategory();

            $this->loadViews("admin/services/addService", $this->global, $data, NULL);
        }
    }

    function addNewServiceInformation()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('txtTitle','Name Of Service','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCategory','Category','trim|required');
            $this->form_validation->set_rules('txtPrice','Price','trim|required|numeric');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
         
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewSurvey();
            }
            else
            {
                $txtTitle =$this->security->xss_clean($this->input->post('txtTitle'));
                $lstCategory =$this->security->xss_clean($this->input->post('lstCategory'));
                $txtPrice =$this->security->xss_clean($this->input->post('txtPrice'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                		
                
				$serviceInfo = array('title'=> $txtTitle, 
                                'category_id'=> $lstCategory, 
                                'price'=> $txtPrice, 
                                'status' => $rdStatus, 
                                'created_by'=>$this->vendorId, 
                                'add_date' => date('Y-m-d H:i:s'));                
		  
				$result = $this->service_model->addNewService($serviceInfo);
				if($result > 0){
					$this->session->set_flashdata('success', 'Record is added successfully');
					redirect('securepanel/services');
				}
				else
				{
					$this->session->set_flashdata('error', 'Record is NOT updated successfully');
					redirect('securepanel/services');
				}

			}
		}
    }

    function editService($serviceId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($serviceId == null)
            {
                redirect('securepanel/services');
            }
            
            
            $data['serviceInfo'] = $this->service_model->getServiceInfo($serviceId);
            $data['serviceCatInfo'] = $this->service_model->getAllServiceCategory();

            if(empty($data['serviceInfo']))
            {
                redirect('securepanel/services');
            }
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Service';
            
            $this->loadViews("admin/services/editService", $this->global, $data, NULL);
        }
    }
    
    function updateService()
    {
		if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
		
            $serviceId = $this->input->post('serviceId');
            
            $this->form_validation->set_rules('txtTitle','Name Of Service','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCategory','Category','trim|required');
            $this->form_validation->set_rules('txtPrice','Price','trim|required|numeric');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
			
            if($this->form_validation->run() == FALSE)
            {
               $this->editService($serviceId);
            }
            else
            {
				
                $txtTitle =$this->security->xss_clean($this->input->post('txtTitle'));
                $lstCategory =$this->security->xss_clean($this->input->post('lstCategory'));
                $txtPrice =$this->security->xss_clean($this->input->post('txtPrice'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                             
                $serviceInfo = array('title'=> $txtTitle, 
                                    'category_id'=> $lstCategory, 
                                    'price'=> $txtPrice, 
                                    'status' => $rdStatus,
                                    'updated_by' => $this->vendorId, 
                                    'update_date' => date('Y-m-d H:i:s'));		
						
				$result = $this->service_model->updateService($serviceInfo, $serviceId);
				if($result){					
					$this->session->set_flashdata('success', 'Record is updated successfully');
					 redirect('securepanel/services');
				}
				else
				{
					$this->session->set_flashdata('error', 'Record is NOT updated successfully');
					$this->editService($serviceId);
				}
			}			
		}
    }

    function deleteServices()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $serviceId = $this->input->post('serviceId');
            $serviceInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
			
			
            $result = $this->service_model->deleteService($serviceId, $serviceInfo);
            
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

    function activeDeactiveSurvey(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            echo(json_encode(array('status'=>'access')));
        }
        else{

            $serviceId = $this->input->post('serviceId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($serviceId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $statusInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->service_model->updatSurvey($statusInfo, $serviceId);
                

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