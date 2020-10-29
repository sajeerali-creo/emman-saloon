<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Backcontroller (LoginController)
 * Backcontroller class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Backcontroller extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');      

    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if($this->session->tempdata('penalty')){
            //Shows code that user is on a penalty
            $this->loadThis();
        }
        else if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('admin/users/login');
        }
        else
        {
            redirect('/securepanel/users');
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function register(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            $this->load->view('admin/users/register');
        }
        else{
            redirect('securepanel/users');
        }
    }

    
      /**
     * This function used to logged in user
     */
    public function registration()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname','Name','trim|required|max_length[50]');           
        $this->form_validation->set_rules('mobile','Mobile Number','required|max_length[15]');
        $this->form_validation->set_rules('email','Email Address','trim|required|valid_email|max_length[50]');        
        $this->form_validation->set_rules('notes','Address','trim|required|max_length[1500]');    
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_exists_username|max_length[20]');
        $this->form_validation->set_rules('password','Password','required|max_length[15]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[15]');
        
        if($this->form_validation->run() == FALSE) {
            $this->register();
        }
        else{
           
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->security->xss_clean($this->input->post('password'));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $notes = $this->security->xss_clean($this->input->post('notes'));
            $username = $this->security->xss_clean($this->input->post('username'));
            
            $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>2, 'name'=> $name, 'mobile'=>$mobile , 'username'=>$username, 'createdBy'=>2, 'parentUserId'=>9, 'createdDtm'=>date('Y-m-d H:i:s'), 'notes'=>$notes, 'active' => 0);           
            
            $this->load->model('user_model');
            $result = $this->user_model->addNewUserDetails($userInfo);            

            if($result > 0){                   
                $this->load->library('email');

                $config['protocol']    = "smtp";
                $config['smtp_host'] = "smtp.gmail.com";
                $config['smtp_crypto'] = 'tls';
                $config['smtp_port'] = "587";
                $config['smtp_user'] = ADMINMAIL;
                $config['smtp_pass'] = ADMINMAILPASS;
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['wordwrap'] = TRUE;
                $config['newline'] = "\r\n";
                $config['crlf'] = "\r\n";
            
                $this->email->initialize($config);
                
                //Admin Email 
                $this->email->from(ADMINMAIL, ADMINNAME); 
                $this->email->to(ADMINTOMAIL); 
                $this->email->subject('Emcsquared : New User Registration');

                $data = $userInfo;
                $emailOuter = $this->load->view('email/emailoutertemplate',$data,true);
                $adminMessageBody = $this->load->view('email/registeradmin',$data,true);
                $fullEmailMessage = str_replace('[contentarea]',$adminMessageBody,$emailOuter);

                $adminMessageBody = $this->load->view('email/registeradmin',$data,true);
                $this->email->set_mailtype("html");
                $this->email->message($fullEmailMessage);
                $rs = $this->email->send();

                //User Email
                $this->load->library('email');
                $config['protocol']    = "smtp";
                $config['smtp_host'] = "smtp.gmail.com";
                $config['smtp_crypto'] = 'tls';
                $config['smtp_port'] = "587";
                $config['smtp_user'] = ADMINMAIL;
                $config['smtp_pass'] = ADMINMAILPASS;
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['wordwrap'] = TRUE;
                $config['newline'] = "\r\n";
                $config['crlf'] = "\r\n";
            
                $this->email->initialize($config);
                
                //Admin Email 
                $this->email->from(ADMINMAIL, ADMINNAME); 
                $this->email->to($email);
                $this->email->subject('Emcsquared : New User Registration');

                $emailOuter = $this->load->view('email/emailoutertemplate',$data,true);
                $userMessageBody = $this->load->view('email/registeruser',$data,true);
                $fullEmailMessage = str_replace('[contentarea]',$userMessageBody,$emailOuter);

                $this->email->set_mailtype("html");
                $this->email->message($fullEmailMessage);
                $rs = $this->email->send();
                
                if($rs){
                    $this->session->set_flashdata('success', 'Account is created successfully. One of our team members will get in touch with you shortly.');
                    redirect('securepanel/register');
                }   
                else{
                    $this->session->set_flashdata('error', 'Sorry, Account creation failed. Please try again later.');
                    $this->register();
                }       

               
            }
            else{
                $this->session->set_flashdata('error', 'Sorry, Account creation failed. Please try again later.');
                $this->register();
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
     * This function used to logged in user
     */
    public function loginAdmin()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[50]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            

            

            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->security->xss_clean($this->input->post('password'));
            
            $result = $this->login_model->loginAdmin($username, $password);
            
            if($this->session->tempdata('penalty')){
                //Shows code that user is on a penalty
                $this->loadThis();
            }
            else if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->userId);
               
                if(isset($_REQUEST['remember_me'])) {
                    $cookie_name  = 'user_name_session';  
                    $cookie_pass  = 'user_pass_session';  
                    $cookie_name_value = rawurldecode ($username);
                    $cookie_pass_value = rawurldecode ($password);
                    setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
                    setcookie($cookie_pass, $cookie_pass_value, time() + (86400 * 7), "/"); // one day example
                }
                else{
                    $cookie_name  = 'user_name_session';  
                    $cookie_pass  = 'user_pass_session';  
                    $cookie_name_value = "";
                    $cookie_pass_value = "";
                    setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
                    setcookie($cookie_pass, $cookie_pass_value, time() + (86400 * 7), "/"); // one day example
                }					

                $sessionArray = array('userId'=>$result->userId,                    
                                        'role'=>$result->roleId,
                                        'roleText'=>$result->role,
                                        'name'=>$result->name,
                                        'profilepic'=> $result->profilepic,
                                        'fl_notification'=> $result->fl_notification,
                                        'parentUserId'=>$result->parentUserId,
                                        'lastLogin'=> (isset($lastLogin->createdDtm) ? $lastLogin->createdDtm : gmdate("Y-m-d H:i:s")),
                                        'isLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['profilepic'], $sessionArray['fl_notification'],  $sessionArray['lastLogin'], $sessionArray['parentUserId']);

                $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->login_model->lastLogin($loginInfo);
                $redirectLink  = $this->login_model->getRoleRedirectLink($result->roleId);
                
                redirect('securepanel/' . $redirectLink->firstpage);
            }
            else
            {
                $attempt = $this->session->userdata('attempt');
                $attempt++;
                $this->session->set_userdata('attempt', $attempt);

                if ($attempt >= 3) {
                    $this->session->set_flashdata('error', 'Your account is locked');
                    
                    /*$this->db->set('attempts', 'attempts+120', FALSE);
                    $this->db->where($where);
                    $this->db->update('users'); // gives UPDATE mytable SET field = field+1 WHERE id = 2*/
                    $attempt = 0;

                    //code for setting tempdata when reached maximun tries
                    $this->session->set_tempdata('penalty', true, 300); //set the name of the sess var to 'penalty, the value will be true and will expire within 5 minutes (expressed in sec.)


                } else {
                    $this->session->set_flashdata('error', 'Username or password mismatch');
                }
                
                $this->index();
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('admin/users/forgotPassword');
        }
        else
        {
            redirect('securepanel/users');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPassword()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username','Username','trim|required|max_length[20]');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $username = $this->security->xss_clean($this->input->post('username'));
            
            if($this->login_model->checkActiveUserExist($username))
            {
                $userInfoEmail = $this->login_model->getCustomerInfoByUsername($username);
                if(!empty($userInfoEmail)){
                    $data1["name"] = $userInfoEmail->name;
                    $data1["email"] = $userInfoEmail->email;
                    $data1["message"] = "Reset Your Password";
                    $encoded_username = urlencode($username);
                    $email = $userInfoEmail->email;
               
                    $this->load->helper('string');
                    $data['username'] = $username;
                    $data['activation_id'] = random_string('alnum',15);
                    $data['createdDtm'] = date('Y-m-d H:i:s');
                    $data['agent'] = getBrowserAgent();
                    $data['client_ip'] = $this->input->ip_address();
                
                     $save = $this->login_model->resetPassword($data);                
                
                    if($save)
                    {
                        $data1['reset_link'] = base_url() . "securepanel/confirmresetpassword/" . $data['activation_id'] . "/" . $encoded_username;

                        $sendStatus = $this->resetPasswordEmail($data1);

                        /*echo "<pre>";
                        print_r($data1);
                        die();*/

                        $sendStatus = true;

                        if($sendStatus){
                            $status = "send";
                            setFlashData($status, "Reset password link has been sent. Please check your mail.");
                        } else {
                            $status = "notsend";
                            setFlashData($status, "Email has been failed, try again.");
                        }
                    }
                    else
                    {
                        $status = 'unable';
                        setFlashData($status, "It seems an error while sending your details, try again.");
                    }
                }
                else
                {
                    $status = 'invalid';
                    setFlashData($status, "This username is not registered with us.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This username is not registered with us.");
            }
            redirect('/securepanel/forgotpassword');
        }
    }

    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        

        $this->load->library('email');
                
        //Admin Email 
        $this->email->from(ADMINMAIL, ADMINNAME);
        $this->email->to($detail["email"]);
        $this->email->bcc('sarathcp007@gmail.com');
        $this->email->subject(PROJECT_NAME . ' : Reset Password');

        
        $emailOuter = $this->load->view('email/emailoutertemplate',$data,true);
        $adminMessageBody = $this->load->view('email/resetPassword',$data,true);
        $fullEmailMessage = str_replace('[contentarea]',$adminMessageBody,$emailOuter);
        
        $this->email->set_mailtype("html");
        $this->email->message($fullEmailMessage);
        $status = $this->email->send();

        
        return $status;
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function confirmResetPassword($activation_id, $username)
    {
        // Get email and activation code from URL values at index 3-4
        $username = urldecode($username);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($username, $activation_id);
        
        $data['username'] = $username;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('admin/users/newPassword', $data);
        }
        else
        {
            redirect('/securepanel/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createNewPassword()
    {
        $status = '';
        $message = '';
        $username = strtolower($this->input->post("username"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->confirmResetPassword($activation_id, urlencode($username));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($username, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createNewPassword($username, $password);
                
                $status = 'success';
                $message = 'Password reset successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("/securepanel/login");
        }
    }

     /**
     * This function is used to check whether email already exist or not
     */
    function checkUsernameExistRegistration()
    {
        $userId = $this->input->post("userId");
        $username = $this->input->post("username");

        if(empty($userId)){
            $result = $this->user_model->checkUsernameExists($username);
        } else {
            $result = $this->user_model->checkUsernameExists($username, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    /**
     * This function is used to load the set of views
     */
    function loadThis() {
        $this->global ['pageTitle'] = PROJECT_NAME . ' : Access Denied';
        
        $this->load->view ( 'accessblock' );
    }
    
}

?>