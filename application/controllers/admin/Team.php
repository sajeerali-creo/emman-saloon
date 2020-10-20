<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Teams (UserController)
 * Teams Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Team extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
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
            $data['dataRecords'] = $this->team_model->teamListing();

            $this->global['arrCapabilities'] = $this->getAllCapabilities();
            $this->global['arrCommission'] = $this->getAllCommission();
            $this->global['arrLevel'] = $this->getAllLevel();
            $this->global['arrPositioning'] = $this->getAllPositioning();
            $this->global['arrGender'] = $this->getGender();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Team';
            
            $this->loadViews("admin/team/listing", $this->global, $data, NULL);
        }
    }

    function calenderTeam($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $data['arrFinalCalendarData'] = $this->getTeamCalendarViewInfo();

            $this->global['arrCapabilities'] = $this->getAllCapabilities();
            $this->global['arrCommission'] = $this->getAllCommission();
            $this->global['arrLevel'] = $this->getAllLevel();
            $this->global['arrPositioning'] = $this->getAllPositioning();
            $this->global['arrGender'] = $this->getGender();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Team';
            
            $this->loadViews("admin/team/calender", $this->global, $data, NULL);
        }
    }

    function addNewTeam($searchUserId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['pageTitle'] = '';
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Team';
            $this->global['arrCapabilities'] = $this->getAllCapabilities();
            $this->global['arrCommission'] = $this->getAllCommission();
            $this->global['arrLevel'] = $this->getAllLevel();
            $this->global['arrPositioning'] = $this->getAllPositioning();
            $this->global['arrGender'] = $this->getGender();

            $this->loadViews("admin/team/add", $this->global, $data, NULL);
        }
    }

    function addNewTeamInformation()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('txtFName','First Name','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtLName','Last Name','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstLevel','Level','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstGender','Gender','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtJoiningDate','Joining Date','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtExperience','Experience','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCommission','Commission','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtBasicSalary','Basic Salary','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtHourlyRate','Hourly Rate','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtTaxation','Taxation','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtEmail','Email','trim|required|valid_email|max_length[250]');
            $this->form_validation->set_rules('txtAdress','Adress','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPostCode','Post Code','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstPositioning','Positioning','trim|required|max_length[250]');
            $this->form_validation->set_rules('chkCapabilities[]','Capabilities','trim|required|max_length[250]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
         
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewTeam();
            }
            else
            {
                $txtFName =$this->security->xss_clean($this->input->post('txtFName'));
                $txtLName =$this->security->xss_clean($this->input->post('txtLName'));
                $lstLevel =$this->security->xss_clean($this->input->post('lstLevel'));
                $lstGender =$this->security->xss_clean($this->input->post('lstGender'));
                $txtJoiningDate =$this->security->xss_clean($this->input->post('txtJoiningDate'));
                $txtExperience =$this->security->xss_clean($this->input->post('txtExperience'));
                $lstCommission =$this->security->xss_clean($this->input->post('lstCommission'));
                $txtBasicSalary =$this->security->xss_clean($this->input->post('txtBasicSalary'));
                $txtHourlyRate =$this->security->xss_clean($this->input->post('txtHourlyRate'));
                $txtTaxation =$this->security->xss_clean($this->input->post('txtTaxation'));
                $txtPhone =$this->security->xss_clean($this->input->post('txtPhone'));
                $txtEmail =$this->security->xss_clean($this->input->post('txtEmail'));
                $txtAdress =$this->security->xss_clean($this->input->post('txtAdress'));
                $txtPostCode =$this->security->xss_clean($this->input->post('txtPostCode'));
                $lstPositioning =$this->security->xss_clean($this->input->post('lstPositioning'));
                $chkCapabilities =$this->security->xss_clean($this->input->post('chkCapabilities'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                        
                
                $teamInfo = array('first_name'=> $txtFName, 
                                'last_name'=> $txtLName, 
                                'level'=> $lstLevel, 
                                'gender'=> $lstGender, 
                                'joining_date'=> $txtJoiningDate, 
                                'experience'=> $txtExperience, 
                                'commission'=> $lstCommission, 
                                'basic_salary'=> $txtBasicSalary, 
                                'hourly_rate'=> $txtHourlyRate,
                                'taxation'=> $txtTaxation,
                                'phone'=> $txtPhone,
                                'email'=> $txtEmail,
                                'address'=> $txtAdress,
                                'post_code'=> $txtPostCode,
                                'positioning'=> $lstPositioning,
                                'capabilities'=> json_encode($chkCapabilities),
                                'status' => $rdStatus, 
                                'created_by'=>$this->vendorId, 
                                'add_date' => date('Y-m-d H:i:s'));                
          
                $result = $this->team_model->addNewTeam($teamInfo);
                if($result > 0){

                    $result = $this->team_model->updateTeam(array("team_id" => "ES" . $result), $result);

                    $this->session->set_flashdata('success', 'Record is added successfully');
                    redirect('securepanel/team');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    redirect('securepanel/team');
                }

            }
        }
    }

    function editTeam($teamId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($teamId == null)
            {
                redirect('securepanel/team');
            }
            
            
            $data['teamInfo'] = $this->team_model->getTeamInfo($teamId);

            if(empty($data['teamInfo']))
            {
                redirect('securepanel/team');
            }
            $this->global['arrCapabilities'] = $this->getAllCapabilities();
            $this->global['arrCommission'] = $this->getAllCommission();
            $this->global['arrLevel'] = $this->getAllLevel();
            $this->global['arrPositioning'] = $this->getAllPositioning();
            $this->global['arrGender'] = $this->getGender();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Team';
            
            $this->loadViews("admin/team/edit", $this->global, $data, NULL);
        }
    }
    
    function updateTeam()
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
        
            $teamId = $this->input->post('teamId');
            
            $this->form_validation->set_rules('txtFName','First Name','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtLName','Last Name','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstLevel','Level','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstGender','Gender','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtJoiningDate','Joining Date','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtExperience','Experience','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstCommission','Commission','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtBasicSalary','Basic Salary','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtHourlyRate','Hourly Rate','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtTaxation','Taxation','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtEmail','Email','trim|required|valid_email|max_length[250]');
            $this->form_validation->set_rules('txtAdress','Adress','trim|required|max_length[250]');
            $this->form_validation->set_rules('txtPostCode','Post Code','trim|required|max_length[250]');
            $this->form_validation->set_rules('lstPositioning','Positioning','trim|required|max_length[250]');
            $this->form_validation->set_rules('chkCapabilities[]','Capabilities','trim|required|max_length[250]');
            $this->form_validation->set_rules('rdStatus', 'Status', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->editTeam($teamId);
            }
            else
            {
                
                $txtFName =$this->security->xss_clean($this->input->post('txtFName'));
                $txtLName =$this->security->xss_clean($this->input->post('txtLName'));
                $lstLevel =$this->security->xss_clean($this->input->post('lstLevel'));
                $lstGender =$this->security->xss_clean($this->input->post('lstGender'));
                $txtJoiningDate =$this->security->xss_clean($this->input->post('txtJoiningDate'));
                $txtExperience =$this->security->xss_clean($this->input->post('txtExperience'));
                $lstCommission =$this->security->xss_clean($this->input->post('lstCommission'));
                $txtBasicSalary =$this->security->xss_clean($this->input->post('txtBasicSalary'));
                $txtHourlyRate =$this->security->xss_clean($this->input->post('txtHourlyRate'));
                $txtTaxation =$this->security->xss_clean($this->input->post('txtTaxation'));
                $txtPhone =$this->security->xss_clean($this->input->post('txtPhone'));
                $txtEmail =$this->security->xss_clean($this->input->post('txtEmail'));
                $txtAdress =$this->security->xss_clean($this->input->post('txtAdress'));
                $txtPostCode =$this->security->xss_clean($this->input->post('txtPostCode'));
                $lstPositioning =$this->security->xss_clean($this->input->post('lstPositioning'));
                $chkCapabilities =$this->security->xss_clean($this->input->post('chkCapabilities'));
                $rdStatus =$this->security->xss_clean($this->input->post('rdStatus'));
                             
                $teamInfo = array('team_id'=> "ES" . $teamId, 
                                'first_name'=> $txtFName, 
                                'last_name'=> $txtLName, 
                                'level'=> $lstLevel, 
                                'gender'=> $lstGender, 
                                'joining_date'=> $txtJoiningDate, 
                                'experience'=> $txtExperience, 
                                'commission'=> $lstCommission, 
                                'basic_salary'=> $txtBasicSalary, 
                                'hourly_rate'=> $txtHourlyRate,
                                'taxation'=> $txtTaxation,
                                'phone'=> $txtPhone,
                                'email'=> $txtEmail,
                                'address'=> $txtAdress,
                                'post_code'=> $txtPostCode,
                                'positioning'=> $lstPositioning,
                                'capabilities'=> json_encode($chkCapabilities),
                                'status' => $rdStatus,
                                'updated_by' => $this->vendorId, 
                                'update_date' => date('Y-m-d H:i:s'));  
                        
                $result = $this->team_model->updateTeam($teamInfo, $teamId);
                if($result){                    
                    $this->session->set_flashdata('success', 'Record is updated successfully');
                     redirect('securepanel/team');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                    $this->editTeam($teamId);
                }
            }           
        }
    }

    function detailTeam($teamId = NULL)
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($teamId == null)
            {
                redirect('securepanel/team');
            }
            
            
            $data['teamInfo'] = $this->team_model->getTeamInfo($teamId);

            if(empty($data['teamInfo']))
            {
                redirect('securepanel/team');
            }
            $this->global['arrCapabilities'] = $this->getAllCapabilities();
            $this->global['arrCommission'] = $this->getAllCommission();
            $this->global['arrLevel'] = $this->getAllLevel();
            $this->global['arrPositioning'] = $this->getAllPositioning();
            $this->global['arrGender'] = $this->getGender();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Team Details';
            
            $this->loadViews("admin/team/details", $this->global, $data, NULL);
        }
    }

    function deleteTeam()
    {
        if($this->isAdminCommon() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $teamId = $this->input->post('teamId');
            $teamInfo = array('is_deleted' => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            
            
            $result = $this->team_model->deleteTeam($teamId, $teamInfo);
            
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

            $teamId = $this->input->post('teamId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($teamId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $statusInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->team_model->updatSurvey($statusInfo, $teamId);
                

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

    function getAllCapabilities(){
        return array("1" => "Nails",
                    "2" => "Make Up",
                    "3" => "Facial",
                    "4" => "Morocan Bath",
                    "5" => "Body Traetment",
                    "6" => "Waxing",
                    "7" => "Hot Oil Massage",
                    "8" => "X-tenso Treatments",
                    "9" => "Hair Style",
                    "10" => "Blow Dry",
                    "11" => "Hair Cut",
                    "12" => "Kertain Treatment",
                    "13" => "Hair Coloring",
                    "14" => "L'oreal Treatment",
                    "15" => "Bleaching",
                    "16" => "X-tenso Treatments");
    }

    function getAllCommission(){
        return array("5" => "5%",
                    "10" => "10%",
                    "20" => "20%");
    }

    function getAllLevel(){
        return array("1" => "Junior",
                    "2" => "Senior",
                    "3" => "Manager");
    }

    function getAllPositioning(){
        return array("1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5");
    }

    function getGender(){
        return array("M" => "Male", 
            "F" => "Female", 
            "OT" => "Other");
    }

    function getTeamCalendarViewInfo(){
        $dataRecords = $this->team_model->teamOrderListing();
        foreach ($dataRecords as $teamId => $arrCartInfo) {
            foreach ($arrCartInfo['booking'] as $key => $value) {
                $arrFinalCalendarData[] = array(
                                                "title" => ucwords(strtolower($value['teamFName'])) . " " . strtolower($value['teamLName']) . " - " . ucwords(strtolower($value['serviceCategory'])) . " " . strtolower($value['serviceName']),
                                                "strDateTime" => date("Y-m-d H:i:s", strtotime($value['service_date'] . " " . $value['service_time'])),
                                                "person" => $value['person']
                                            );
            }
            
        }

        //echo "<pre>"; print_r($arrFinalCalendarData);   die();
        return $arrFinalCalendarData;
    }
}

?>