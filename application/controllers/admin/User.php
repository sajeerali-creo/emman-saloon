<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('login_model');
        $this->load->model('cart_model');
        $this->isLoggedIn();   
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->global['pageTitle'] = PROJECT_NAME . ' : Dashboard';
        $data['classInfo'] = "";
        /*if(isset($arrUpcomingCourse)){
            $data['classInfo'] = $arrUpcomingCourse;
        }
        if(isset($arrCompletedCourse)){
            $data['arrCompletedCourse'] = $arrCompletedCourse;
        }*/


        
        $data['totalSales'] = $this->fnFindTotalSales();
        $data['totalBooking'] = $this->fnFindTotalBooking();
        $data['totalConfirmBooking'] = $this->fnFindTotalConfirmBooking();
        $data['totalPendingBooking'] = $this->fnFindTotalPendingBooking();
        $data['totalCompletedBooking'] = $this->fnFindTotalCompletedBooking();
        $data['totalHomeServices'] = $this->fnFindTotalHomeServices();
        $data['totalSaloonServices'] = $this->fnFindTotalSaloonServices();
        $data['totalProductSale'] = $this->fnFindTotalProductSale();
        $data['totalProductUse'] = $this->fnFindTotalProductUse();
        $data['totalTeam'] = $this->fnFindTotalTeam();
        $data['totalActiveTeam'] = $this->fnFindTotalActiveTeam();
        $data['totalOffTeam'] = $this->fnFindTotalOffTeam();
        $data['totalCustomers'] = $this->fnFindTotalCustomers();
        $data['totalSuppliers'] = $this->fnFindTotalSuppliers();
        

        /*echo "<pre>";
        print_r( $data);
        die();
        */
        
        $this->loadViews("admin/dashboard", $this->global, $data , NULL);
    }

    
    function fnFindTotalSales(){
        $objRp = $this->cart_model->getTotalSales();
        return number_format($objRp->totalPrice, 2);
    }

    function fnFindTotalBooking(){
        $objRp = $this->cart_model->getTotalBooking();
        return $objRp->totalCount;
    }

    function fnFindTotalConfirmBooking(){
        $objRp = $this->cart_model->getTotalConfirmBooking();
        return $objRp->totalCount;
    }

    function fnFindTotalPendingBooking(){
        $objRp = $this->cart_model->getTotalPendingBooking();
        return $objRp->totalCount;
    }

    function fnFindTotalCompletedBooking(){
        $objRp = $this->cart_model->getTotalCompletedBooking();
        return $objRp->totalCount;
    }

    function fnFindTotalHomeServices(){
        $objRp = $this->cart_model->getTotalHomeServices();
        return $objRp->totalCount;
    }

    function fnFindTotalSaloonServices(){
        $objRp = $this->cart_model->getTotalHomeServices();
        return $objRp->totalCount;
    }

    function fnFindTotalProductSale(){
        $objRp = $this->cart_model->getProductSales();
        return $objRp->totalCount;
    }

    function fnFindTotalProductUse(){
        $objRp = $this->cart_model->getTotalProductUse();
        return $objRp->totalCount;
    }

    function fnFindTotalTeam(){
        $objRp = $this->cart_model->getTotalTeam();
        return $objRp->totalCount;
    }
    
    function fnFindTotalActiveTeam(){
        $objRp = $this->cart_model->getTotalActiveTeam();
        return $objRp->totalCount;
    }

    function fnFindTotalOffTeam(){
        $objRp = $this->cart_model->getTotalOffTeam();
        return $objRp->totalCount;
    }

    function fnFindTotalCustomers(){
        $objRp = $this->cart_model->getTotalCustomers();
        return $objRp->totalCount;
    }

    function fnFindTotalSuppliers(){
        $objRp = $this->cart_model->getTotalSuppliers();
        return $objRp->totalCount;
    }
    
    /**
     * This function is used to load the user list
     */
    function users($pagination = "")
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {        
            
            $arrActiveusers = array("All"=>"All", "AC"=>"Active", "IN"=>"Inactive");
            $data['arrActiveusers'] = $arrActiveusers;

            $activeStatus = $this->security->xss_clean($this->input->post('activeStatus'));
			if(empty($activeStatus)){
				$activeStatus = $this->input->get('activeStatus', TRUE);
            }
            if(empty($activeStatus)){
                $activeStatus = "All";
            }

            $lstTags = $this->security->xss_clean($this->input->post('lstTags'));
            if(empty($lstTags)){
                $lstTags = $this->input->get('lstTags', TRUE);
            }
            if(empty($lstTags)){
                $lstTags = array();
            }
            
            $data['lstTags'] = $lstTags;
            $data['activeStatus'] = $activeStatus;

            if($activeStatus == 'All'){
                $selectedActiveStatus = '';
            }
            else{
                $selectedActiveStatus = $activeStatus;
            }

			$searchText = $this->security->xss_clean($this->input->post('searchText'));
			if(empty($searchText)){
				$searchText = $this->input->get('searchText', TRUE);
			}
            $data['searchText'] = $searchText;
			
			$sortOrder = $this->security->xss_clean($this->input->post('sortOrder'));
			if(empty($sortOrder)){
				$sortOrder = $this->input->get('sortOrder', TRUE);
			}
			if(empty($sortOrder)){
                $sortOrder = "DESC";
            }
			$data['sortOrder'] = $sortOrder;
			
			$sortOrderBy = $this->security->xss_clean($this->input->post('sortOrderBy'));
			if(empty($sortOrderBy)){
				$sortOrderBy = $this->input->get('sortOrderBy', TRUE);
            }

            if(empty($sortOrderBy)){
                $sortOrderBy = "add_date";
            }
            $data['sortOrderBy'] = $sortOrderBy;
            
            $commonurl = "";
            $and = "";

            if(!empty($searchText)){
                $commonurl .=  $and . 'searchText=' . $searchText; 
                $and = '&';
            }

            if(!empty($activeStatus)){
                $commonurl .=  $and . 'activeStatus=' . $activeStatus;
                $and = '&'; 
            }
            if(!empty($lstTags)){
                foreach ($lstTags as $key => $value) {
                    $commonurl .=  $and . 'lstTags[' . $key . ']=' . $value;
                    $and = '&'; 
                }
            }

			
			$data['orderbyNameAscUrl'] = base_url() . "securepanel/users/" . "?sortOrderBy=first_name&sortOrder=ASC&" . $commonurl;
			$data['orderbyNameDesUrl'] = base_url() . "securepanel/users/" . "?sortOrderBy=first_name&sortOrder=DESC&"  . $commonurl;
			$data['orderbycreatedDtmAscUrl'] = base_url() . "securepanel/users/" . "?sortOrderBy=add_date&sortOrder=ASC&"  . $commonurl;
			$data['orderbycreatedDtmDesUrl'] = base_url() . "securepanel/users/" . "?sortOrderBy=add_date&sortOrder=DESC&"  . $commonurl;
			          
            $this->load->library('pagination');
            
            $count = $this->user_model->usersCount($searchText, $selectedActiveStatus, $lstTags);

            if(!empty($sortOrderBy)){
                $commonurl .=  $and . 'sortOrderBy=' . $sortOrderBy; 
                $and = '&';
            }
            if(!empty($sortOrder)){
                $commonurl .=  $and . 'sortOrderBy=' . $sortOrder; 
                $and = '&';
            }

			$returns = $this->paginationCompress ( "securepanel/users/", $count, 100, SEGMENT,  "?" . $commonurl );
		       
            $data['userRecords'] = $this->user_model->users($searchText, $returns["page"], $pagination, $sortOrder, $sortOrderBy, $selectedActiveStatus, $lstTags);
			
			//$data['allroles'] = $this->user_model->getUserRoles($this->role);
			//$data['allLevel1Parents'] = $this->user_model->allLevel1Parents(2);
			//$data['allsubcat'] = $this->user_model->allSubCat();
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : User Listing';
            $data['allCountry'] = $this->getCountryCode();
            $data['allGender'] = $this->getGender();
            $data['allTagsInfo'] = $this->tags_model->getAllTags(true);
            $this->loadViews("admin/users/users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewUser()
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data = array();            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New User';
            $data['allCountry'] = $this->getCountryCode();
            $data['allGender'] = $this->getGender();
            $this->loadViews("admin/users/addnewuser", $this->global, $data, NULL);
        }
    }

     /**
     * This function is used to check whether email already exist or not
     */
    function checkUsernameExists()
    {
        $username = $this->input->post("username");
        if(!empty($username)){
            $userId = $this->input->post("userId");
            

            if(empty($userId)){
                $result = $this->user_model->checkUsernameExists($username);
            } else {
                $result = $this->user_model->checkUsernameExists($username, $userId);
            }

            if(empty($result)){ echo("true"); }
            else { echo("false"); }
        }
        else{
            echo("false");
        }
    }
    /**
     * This function is used to check whether email already exist or not
     */
    function checkCustomerUsernameExists()
    {
        $username = $this->input->post("username");
        if(!empty($username)){
            $userId = $this->input->post("userId");
            

            if(empty($userId)){
                $result = $this->user_model->checkCustomerUsernameExists($username);
            } else {
                $result = $this->user_model->checkCustomerUsernameExists($username, $userId);
            }

            if(empty($result)){ echo("true"); }
            else { echo("false"); }
        }
        else{
            echo("false");
        }
    }
    

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $email = $this->input->post("email");
        if(!empty($email)){
            $userId = $this->input->post("userId");
            

            if(empty($userId)){
                $result = $this->user_model->checkEmailExists($email);
            } else {
                $result = $this->user_model->checkEmailExists($email, $userId);
            }

            if(empty($result)){ echo("true"); }
            else { echo("false"); }
        }
        else{
            echo("false");
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUserDetails()
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else{

            $parentRoles = 0;
            $studentClass = 0;
			$this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','First Name','trim|required|max_length[50]');
            $this->form_validation->set_rules('lname','Last Name','trim|required|max_length[50]');
            $this->form_validation->set_rules('mobile','Mobile Number','required|max_length[15]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('lstGender','Gender','trim|required|max_length[50]');
            $this->form_validation->set_rules('religion','Religion','trim|required|max_length[50]');
            $this->form_validation->set_rules('address1','Address1','trim|required|max_length[50]');
            $this->form_validation->set_rules('address2','Address2','trim|required|max_length[50]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[50]');
            $this->form_validation->set_rules('state','State','trim|required|max_length[50]');
            $this->form_validation->set_rules('lstCountry','Country','trim|required|max_length[50]');
			
            $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_exists_username|max_length[50]');
            $this->form_validation->set_rules('password','Password','required|max_length[50]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[50]');
            
            
            $error = false; 
            if($this->form_validation->run() == FALSE){
                 $this->addNewUser();
                 $error = true;
            }        
            else{
                $image = false;
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $lstGender = $this->security->xss_clean($this->input->post('lstGender'));
                $religion = $this->security->xss_clean($this->input->post('religion'));
                $address1 = $this->security->xss_clean($this->input->post('address1'));
                $address2 = $this->security->xss_clean($this->input->post('address2'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $state = $this->security->xss_clean($this->input->post('state'));
                $lstCountry = $this->security->xss_clean($this->input->post('lstCountry'));
                $username = $this->security->xss_clean($this->input->post('username'));
                $password = $this->security->xss_clean($this->input->post('password'));
                 
                $userInfo = array('email' => $email, 'first_name'=> $name, 'last_name' => $lname, 'phone_number' => $mobile, 'gender' => $lstGender, 'religion' => $religion, 'address1' => $address1, 'address2' => $address2, 'city' => $city, 'state' => $state, 'country' => $lstCountry,'username' => $username,'password' => getHashedPassword($password),  'created_by' => $this->vendorId, 'add_date' => date('Y-m-d H:i:s'));
                 
                 
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUserDetails($userInfo);
                if($result > 0 && $error == false){
                    $this->addUpdateSystemDefinedTags($result, $lstGender, $lstCountry);

                    $this->session->set_flashdata('success', 'New User registration is done successfully.');
                    redirect('securepanel/users');
                }
                else{
                    $this->session->set_flashdata('error', 'User creation failed');
                    $this->addNewUser();
                }
            }
        }
    }

    function addUpdateSystemDefinedTags($userId, $gender, $country){

        $arrCountry = $this->getCountryCode();
        $arrGender = $this->getGender();

        $strGender = '';
        $strCountry = '';
        if(isset($arrGender[$gender]) && !empty($arrGender[$gender])){
            $strGender = $arrGender[$gender];
        }

        if(isset($arrCountry[$country]) && !empty($arrCountry[$country])){
            $strCountry = $arrCountry[$country]['name'];
        }

        if(!empty($strGender) || !empty($strCountry)){
            if(!empty($strGender)){
                $objResult = $this->tags_model->getSystemDefinedTags($strGender, "CATGENDER");

                $objCheck = $this->tags_model->checkUserTagExist($objResult['0']->id, $userId);

                if((empty($objCheck) || empty($objCheck['0']->tag_id)) && !empty($objResult['0']->id)){
                    $userTagsInfo = array('customer_id' => $userId, 'tag_id' => $objResult['0']->id, 'created_by' => $this->vendorId, 'add_date' => date('Y-m-d H:i:s'));
                    $resultNew = $this->user_model->addNewUserTags($userTagsInfo);
                }
            }

            if(!empty($strCountry)){
                $objResult = $this->tags_model->getSystemDefinedTags($strCountry, "CATCOUNTRY");

                $objCheck = $this->tags_model->checkUserTagExist($objResult['0']->id, $userId);

                if((empty($objCheck) || empty($objCheck['0']->tag_id)) && !empty($objResult['0']->id)){
                    $userTagsInfo = array('customer_id' => $userId, 'tag_id' => $objResult['0']->id, 'created_by' => $this->vendorId, 'add_date' => date('Y-m-d H:i:s'));
                    $resultNew = $this->user_model->addNewUserTags($userTagsInfo);
                }
            }
        }
    }

    function deleteSystemDefinedTag($userId, $catCode, $catVal){

        $objResult = $this->tags_model->getSystemDefinedTags($catVal, $catCode);

        $objCheck = $this->tags_model->checkUserTagExist($objResult['0']->id, $userId);

        if(!empty($objCheck) && !empty($objCheck['0']->tag_id) && !empty($objResult['0']->id)){

            $arrDeleteInfo = array("is_deleted" => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            $result = $this->user_model->deleteOldUserTags($arrDeleteInfo, $userId, $objCheck['0']->id);
        }
    }

    
    function getResetPassword($username){
        $encoded_username = urlencode($username);       

        $this->load->helper('string');
        $restData['username'] = $username;
        $restData['activation_id'] = random_string('alnum',15);
        $restData['createdDtm'] = date('Y-m-d H:i:s');
        $restData['agent'] = getBrowserAgent();
        $restData['client_ip'] = $this->input->ip_address();

        $save = $this->login_model->resetPassword($restData);                

        if($save){
            $reset_link = base_url() . "securepanel/confirmresetpassword/" . $restData['activation_id'] . "/" . $encoded_username;  
            return $reset_link;
        }
        return false;
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function edituser($userId = NULL)
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('securepanel/users');
            }
            
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['allCountry'] = $this->getCountryCode();
            $data['allGender'] = $this->getGender();
            
            if(empty($data['userInfo']))
            {
                redirect('securepanel/users');
            }
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit User';
            
            $this->loadViews("admin/users/edituser", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function updateuser()
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            /*echo "<pre>";
            print_r($_REQUEST);
            die();*/
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('first_name','Last Name','trim|required|max_length[50]');
            $this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[50]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('phone_number','Mobile Number','required|max_length[15]');
            $this->form_validation->set_rules('lstGender','Gender','trim|required|max_length[50]');
            $this->form_validation->set_rules('religion','Religion','trim|required|max_length[50]');
            $this->form_validation->set_rules('address1','Address1','trim|required|max_length[50]');
            $this->form_validation->set_rules('address2','Address2','trim|required|max_length[50]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[50]');
            $this->form_validation->set_rules('state','State','trim|required|max_length[50]');
            $this->form_validation->set_rules('lstCountry','Country','trim|required|max_length[50]');

            if(isset($_REQUEST['username'])){
                $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_exists_username|max_length[20]');
            }
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[15]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[15]');
            
            $documentInfoNew = $this->user_model->getUserInfo($userId);          
            
            if($this->form_validation->run() == FALSE){
               $this->edituser($userId);
            }
            else
            {
			
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('first_name'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('last_name'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));              
                $mobile = $this->security->xss_clean($this->input->post('phone_number'));  
                $lstGender = $this->security->xss_clean($this->input->post('lstGender'));
                $religion = $this->security->xss_clean($this->input->post('religion'));
                $address1 = $this->security->xss_clean($this->input->post('address1'));
                $address2 = $this->security->xss_clean($this->input->post('address2'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $state = $this->security->xss_clean($this->input->post('state'));
                $lstCountry = $this->security->xss_clean($this->input->post('lstCountry'));

                if(isset($_REQUEST['username'])){
                    $username = $this->security->xss_clean($this->input->post('username'));
                }
                else {
                    $username = '';
                }

                $password = $this->input->post('password');

                $userInfo = array('email' => $email, 'first_name'=> $name, 'last_name' => $lname, 'phone_number' => $mobile, 'gender' => $lstGender, 'religion' => $religion, 'address1' => $address1, 'address2' => $address2, 'city' => $city, 'state' => $state, 'country' => $lstCountry, 'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));

                if(!empty($username)){
                    $userInfo["username"] = $username;
                }

                if(!empty($password)){
                    $userInfo["password"] = getHashedPassword($password);
                }
                               
				$error = false;
				$this->load->library('upload');
							
				if($error == false){
					
                    $result = $this->user_model->updateuser($userInfo, $userId);
                    if($result){

                        if($documentInfoNew->gender != $lstGender){
                            $arrGender = $this->getGender();
                            $strGender = '';
                            if(isset($arrGender[$documentInfoNew->gender]) && !empty($arrGender[$documentInfoNew->gender])){
                                $strGender = $arrGender[$documentInfoNew->gender];
                            }
                            
                            if(!empty($strGender)){
                                $this->deleteSystemDefinedTag($userId, "CATGENDER", $strGender);
                            }
                        }

                        if($documentInfoNew->country != $lstCountry){
                            $arrCountry = $this->getCountryCode();
                            $strCountry = '';
                            if(isset($arrCountry[$documentInfoNew->country]) && !empty($arrCountry[$documentInfoNew->country])){
                                $strCountry = $arrCountry[$documentInfoNew->country]['name'];
                            }
                            if(!empty($strCountry)){
                                $this->deleteSystemDefinedTag($userId, "CATCOUNTRY", $strCountry);
                            }
                        }
                        $this->addUpdateSystemDefinedTags($userId, $lstGender, $lstCountry);

                        $this->session->set_flashdata('success', 'Record is updated successfully');
                        redirect('securepanel/edituser/' . $userId);
                    }
                    else{
                        $this->session->set_flashdata('error', 'Record is NOT updated successfully');
                        $this->edituser($userId);
                    }
				}					
			}
        }
    }

    function assigntags($userId = NULL){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('securepanel/users');
            }

            $this->load->model('tags_model');

            $data['userId'] = $userId;
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['allTagsInfo'] = $this->tags_model->getAllTags(true);
            $data['userTagsInfo'] = $this->getUserTagsInfo($userId);
            $this->global['pageTitle'] = PROJECT_NAME . ' : Assign Tags';
            
            $this->loadViews("admin/users/assigntags", $this->global, $data, NULL);
        }
    }

    function getUserTagsInfo($userId){
        $arrData = array();
        $arrResult = $this->user_model->getUserTagsInfo($userId);

        foreach ($arrResult as $key => $arrValue) {
            $arrData[$arrValue->tag_id] = $arrValue;
        }

        return $arrData;
    }

    function updateusertagsinfo(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');

            /*echo "<pre>";
            print_r($_REQUEST);
            die();*/

            $arr_tag_ids_selected = $this->security->xss_clean($this->input->post('tag_ids_selected'));

            $arrDeleteInfo = array("is_deleted" => '1', 'updated_by' => $this->vendorId, 'deleted_date' => date('Y-m-d H:i:s'));
            $result = $this->user_model->deleteOldUserTags($arrDeleteInfo, $userId);

            foreach ($arr_tag_ids_selected as $key => $value) {
                $userTagsInfo = array('customer_id' => $userId, 'tag_id' => $value, 'created_by' => $this->vendorId, 'add_date' => date('Y-m-d H:i:s'));
                $resultNew = $this->user_model->addNewUserTags($userTagsInfo);
            }

            if($resultNew > 0){
                $this->session->set_flashdata('success', 'Tags assigned successfully.');
                redirect('securepanel/users');
            }
            else{
                $this->session->set_flashdata('error', 'Tags not assigned successfully');
                $this->assigntags($userId);
            }
        }
    }

    function activedeactiveuser(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            echo(json_encode(array('status'=>'access')));
        }
        else{

            $userId = $this->input->post('userId');
            $stat = $this->input->post('stat'); 
          
            if(!empty($userId) && ($stat == 0 || $stat == 1)) {

                if($stat == '0'){
                    $statN = 'IN';
                }
                else{
                    $statN = 'AC';
                }

                $userInfo = array('status' => $statN,'updated_by' => $this->vendorId, 'update_date' => date('Y-m-d H:i:s'));           
                $result = $this->user_model->updateuser($userInfo, $userId);
                

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
    


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteuser()
    {
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('is_deleted'=> '1','updated_by'=>$this->vendorId, 'deleted_date'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) { 										
				echo(json_encode(array('status'=>TRUE))); 
			}
            else { 
				echo(json_encode(array('status'=>FALSE))); 
			}
            
           
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = PROJECT_NAME . ' : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if(!$this->isSuperAdmin()){
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : User Login History';
            
            $this->loadViews("admin/loginHistory", $this->global, $data, NULL);
        }        
    }

    /**
     * This function is used to show users profile
     */
    function settings()
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        
        $this->global['pageTitle'] = PROJECT_NAME . ' : Settings';
        $this->loadViews("admin/users/settings", $this->global, $data, NULL);
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function settingsUpdate()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[15]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[15]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->settings();
        }
        else
        {
            $oldPassword = $this->security->xss_clean($this->input->post('oldPassword'));
            $newPassword = $this->security->xss_clean($this->input->post('newPassword'));
            $chkNotification = $this->security->xss_clean($this->input->post('chkNotification'));
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('securepanel/settings');
            }
            else
            {
                if(empty($chkNotification)){
                    $chkNotification = 0;
                }

                $usersData = array('password'=>getHashedPassword($newPassword), 
                                'fl_notification'=>getHashedPassword($chkNotification), 
                                'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { 
                    $this->session->set_flashdata('success', 'Password updation successful'); 
                }
                else { 
                    $this->session->set_flashdata('error', 'Password updation failed'); 
                }
                
                redirect('securepanel/settings');
            }
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? PROJECT_NAME . ' : My Profile' : PROJECT_NAME . ' : Change Password';
        $this->loadViews("admin/users/profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','First Name','trim|required|max_length[50]');
        $this->form_validation->set_rules('lname','Last Name','trim|required|max_length[50]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|max_length[15]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[50]');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            $userInfo = array('name'=>$name, 'lname'=>$lname, 'email'=>$email, 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->updateAdminUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('securepanel/profile');
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[15]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[15]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->security->xss_clean($this->input->post('oldPassword'));
            $newPassword = $this->security->xss_clean($this->input->post('newPassword'));
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('securepanel/profile/'.$active);
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('securepanel/profile');
            }
        }
    }

    function exists_username($username)
    {
       
        $return = false;

        
        $result = $this->user_model->checkUsernameExists($username);
       

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('exists_username', 'The {field} already taken');
            $return = false;
        }

        return $return;

    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
	
	function getparentlists(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else{  
       
            $role = $this->input->post('role');
            $role = 2;
        
            $result = $this->user_model->allParentRole($role);
            $arrDetails = array();
            
            if ($result > 0) { 
                $i = 0;
                $arrDetails[$i]['parentUserId'] = "";
                $arrDetails[$i]['title'] = "Please Select";
                $i++;
                foreach($result as $key => $val){
                    $arrDetails[$i]['parentUserId'] = $val->parentUserId;
                    $arrDetails[$i]['title'] = $val->name;
                    $i++;
                }
                        
                        
                echo(json_encode($arrDetails)); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
		
    }
    function getclasslist(){
        if(!$this->isSuperAdmin() && !$this->isMainAdmin() && !$this->isTeacher()){
            $this->loadThis();
        }
        else{   
       
            $parentRoles = $this->input->post('parentRoles');	
        
            $result = $this->user_model->allParentClasses($parentRoles);
            $arrDetails = array();
            
            if ($result > 0) { 
                $i = 0;
                $arrDetails[$i]['schoolgradeId'] = "";
                $arrDetails[$i]['title'] = "Please Select";
                $i++;
                foreach($result as $key => $val){
                    $arrDetails[$i]['schoolgradeId'] = $val->schoolgradeId;
                    $arrDetails[$i]['title'] = $val->name;
                    $i++;
                }
                        
                        
                echo(json_encode($arrDetails)); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
		
    }
    function deleteFile($fileName){
        if(!empty($fileName)){
            $path_to_file = './uploads/' . $fileName;
            if(unlink($path_to_file)) {
                return true;
            }
            else {
                return false;
            }
        }
        else{
            return true;
        }
    }

    function check_password($password)
    {
        if(preg_match('^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}$', $password)){
            return true;
        }
        $this->form_validation->set_message('check_password', 'Password must be at least 8 characters, no more than 15 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit.');
        return false;
        

    }
    function getteacherinfo(){
        $api = new WiziqAPI("9FnsNn876Ws83OsM4OOFBw==", "F0uQeMlVvFc=");
        $api->getTeacherInfo(array());
    }

    function getGender(){
        return array("M" => "Male", "F" => "Female", "OT" => "Other");
    }

    function getCountryCode(){
        $countryArray = array(
            'AD'=>array('name'=>'ANDORRA','code'=>'376'),
            'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
            'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),
            'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
            'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
            'AL'=>array('name'=>'ALBANIA','code'=>'355'),
            'AM'=>array('name'=>'ARMENIA','code'=>'374'),
            'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
            'AO'=>array('name'=>'ANGOLA','code'=>'244'),
            'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
            'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
            'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),
            'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
            'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
            'AW'=>array('name'=>'ARUBA','code'=>'297'),
            'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
            'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
            'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
            'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
            'BE'=>array('name'=>'BELGIUM','code'=>'32'),
            'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
            'BG'=>array('name'=>'BULGARIA','code'=>'359'),
            'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
            'BI'=>array('name'=>'BURUNDI','code'=>'257'),
            'BJ'=>array('name'=>'BENIN','code'=>'229'),
            'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
            'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
            'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
            'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
            'BR'=>array('name'=>'BRAZIL','code'=>'55'),
            'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
            'BT'=>array('name'=>'BHUTAN','code'=>'975'),
            'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
            'BY'=>array('name'=>'BELARUS','code'=>'375'),
            'BZ'=>array('name'=>'BELIZE','code'=>'501'),
            'CA'=>array('name'=>'CANADA','code'=>'1'),
            'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),
            'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
            'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
            'CG'=>array('name'=>'CONGO','code'=>'242'),
            'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
            'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
            'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
            'CL'=>array('name'=>'CHILE','code'=>'56'),
            'CM'=>array('name'=>'CAMEROON','code'=>'237'),
            'CN'=>array('name'=>'CHINA','code'=>'86'),
            'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
            'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
            'CU'=>array('name'=>'CUBA','code'=>'53'),
            'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
            'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
            'CY'=>array('name'=>'CYPRUS','code'=>'357'),
            'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
            'DE'=>array('name'=>'GERMANY','code'=>'49'),
            'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
            'DK'=>array('name'=>'DENMARK','code'=>'45'),
            'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
            'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
            'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
            'EC'=>array('name'=>'ECUADOR','code'=>'593'),
            'EE'=>array('name'=>'ESTONIA','code'=>'372'),
            'EG'=>array('name'=>'EGYPT','code'=>'20'),
            'ER'=>array('name'=>'ERITREA','code'=>'291'),
            'ES'=>array('name'=>'SPAIN','code'=>'34'),
            'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
            'FI'=>array('name'=>'FINLAND','code'=>'358'),
            'FJ'=>array('name'=>'FIJI','code'=>'679'),
            'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
            'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),
            'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),
            'FR'=>array('name'=>'FRANCE','code'=>'33'),
            'GA'=>array('name'=>'GABON','code'=>'241'),
            'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
            'GD'=>array('name'=>'GRENADA','code'=>'1473'),
            'GE'=>array('name'=>'GEORGIA','code'=>'995'),
            'GH'=>array('name'=>'GHANA','code'=>'233'),
            'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
            'GL'=>array('name'=>'GREENLAND','code'=>'299'),
            'GM'=>array('name'=>'GAMBIA','code'=>'220'),
            'GN'=>array('name'=>'GUINEA','code'=>'224'),
            'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
            'GR'=>array('name'=>'GREECE','code'=>'30'),
            'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
            'GU'=>array('name'=>'GUAM','code'=>'1671'),
            'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
            'GY'=>array('name'=>'GUYANA','code'=>'592'),
            'HK'=>array('name'=>'HONG KONG','code'=>'852'),
            'HN'=>array('name'=>'HONDURAS','code'=>'504'),
            'HR'=>array('name'=>'CROATIA','code'=>'385'),
            'HT'=>array('name'=>'HAITI','code'=>'509'),
            'HU'=>array('name'=>'HUNGARY','code'=>'36'),
            'ID'=>array('name'=>'INDONESIA','code'=>'62'),
            'IE'=>array('name'=>'IRELAND','code'=>'353'),
            'IL'=>array('name'=>'ISRAEL','code'=>'972'),
            'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
            'IN'=>array('name'=>'INDIA','code'=>'91'),
            'IQ'=>array('name'=>'IRAQ','code'=>'964'),
            'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),
            'IS'=>array('name'=>'ICELAND','code'=>'354'),
            'IT'=>array('name'=>'ITALY','code'=>'39'),
            'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
            'JO'=>array('name'=>'JORDAN','code'=>'962'),
            'JP'=>array('name'=>'JAPAN','code'=>'81'),
            'KE'=>array('name'=>'KENYA','code'=>'254'),
            'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
            'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
            'KI'=>array('name'=>'KIRIBATI','code'=>'686'),
            'KM'=>array('name'=>'COMOROS','code'=>'269'),
            'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
            'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),
            'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
            'KW'=>array('name'=>'KUWAIT','code'=>'965'),
            'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),
            'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
            'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
            'LB'=>array('name'=>'LEBANON','code'=>'961'),
            'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
            'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
            'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
            'LR'=>array('name'=>'LIBERIA','code'=>'231'),
            'LS'=>array('name'=>'LESOTHO','code'=>'266'),
            'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
            'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
            'LV'=>array('name'=>'LATVIA','code'=>'371'),
            'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
            'MA'=>array('name'=>'MOROCCO','code'=>'212'),
            'MC'=>array('name'=>'MONACO','code'=>'377'),
            'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
            'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
            'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
            'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
            'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),
            'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
            'ML'=>array('name'=>'MALI','code'=>'223'),
            'MM'=>array('name'=>'MYANMAR','code'=>'95'),
            'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
            'MO'=>array('name'=>'MACAU','code'=>'853'),
            'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),
            'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
            'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
            'MT'=>array('name'=>'MALTA','code'=>'356'),
            'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
            'MV'=>array('name'=>'MALDIVES','code'=>'960'),
            'MW'=>array('name'=>'MALAWI','code'=>'265'),
            'MX'=>array('name'=>'MEXICO','code'=>'52'),
            'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
            'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
            'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
            'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
            'NE'=>array('name'=>'NIGER','code'=>'227'),
            'NG'=>array('name'=>'NIGERIA','code'=>'234'),
            'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
            'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
            'NO'=>array('name'=>'NORWAY','code'=>'47'),
            'NP'=>array('name'=>'NEPAL','code'=>'977'),
            'NR'=>array('name'=>'NAURU','code'=>'674'),
            'NU'=>array('name'=>'NIUE','code'=>'683'),
            'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
            'OM'=>array('name'=>'OMAN','code'=>'968'),
            'PA'=>array('name'=>'PANAMA','code'=>'507'),
            'PE'=>array('name'=>'PERU','code'=>'51'),
            'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
            'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
            'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
            'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
            'PL'=>array('name'=>'POLAND','code'=>'48'),
            'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
            'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
            'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),
            'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
            'PW'=>array('name'=>'PALAU','code'=>'680'),
            'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
            'QA'=>array('name'=>'QATAR','code'=>'974'),
            'RO'=>array('name'=>'ROMANIA','code'=>'40'),
            'RS'=>array('name'=>'SERBIA','code'=>'381'),
            'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
            'RW'=>array('name'=>'RWANDA','code'=>'250'),
            'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
            'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
            'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
            'SD'=>array('name'=>'SUDAN','code'=>'249'),
            'SE'=>array('name'=>'SWEDEN','code'=>'46'),
            'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
            'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),
            'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
            'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
            'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),
            'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
            'SN'=>array('name'=>'SENEGAL','code'=>'221'),
            'SO'=>array('name'=>'SOMALIA','code'=>'252'),
            'SR'=>array('name'=>'SURINAME','code'=>'597'),
            'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
            'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
            'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),
            'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
            'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
            'TD'=>array('name'=>'CHAD','code'=>'235'),
            'TG'=>array('name'=>'TOGO','code'=>'228'),
            'TH'=>array('name'=>'THAILAND','code'=>'66'),
            'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
            'TK'=>array('name'=>'TOKELAU','code'=>'690'),
            'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
            'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
            'TN'=>array('name'=>'TUNISIA','code'=>'216'),
            'TO'=>array('name'=>'TONGA','code'=>'676'),
            'TR'=>array('name'=>'TURKEY','code'=>'90'),
            'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
            'TV'=>array('name'=>'TUVALU','code'=>'688'),
            'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
            'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
            'UA'=>array('name'=>'UKRAINE','code'=>'380'),
            'UG'=>array('name'=>'UGANDA','code'=>'256'),
            'US'=>array('name'=>'UNITED STATES','code'=>'1'),
            'UY'=>array('name'=>'URUGUAY','code'=>'598'),
            'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
            'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
            'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
            'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
            'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
            'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),
            'VN'=>array('name'=>'VIET NAM','code'=>'84'),
            'VU'=>array('name'=>'VANUATU','code'=>'678'),
            'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),
            'WS'=>array('name'=>'SAMOA','code'=>'685'),
            'XK'=>array('name'=>'KOSOVO','code'=>'381'),
            'YE'=>array('name'=>'YEMEN','code'=>'967'),
            'YT'=>array('name'=>'MAYOTTE','code'=>'262'),
            'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
            'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
            'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')
        );

        return $countryArray;
    }

    
	
}

?>