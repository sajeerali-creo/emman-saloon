<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Frontcontroller extends CI_Controller{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
		$this->load->model('contactus_model');
       
        $this->frontLogin = false;
		
        $isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
        $this->frontUsername = "";        
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
            $this->frontLogin = false;
        } 
        else {
            $this->frontLogin = true;
            $this->frontUsername = $this->session->userdata ( 'name' );
        }

    }

    /**
     * Index Page for this controller.
     */
    public function index(){		
        $data['title'] = 'Emcsquared';
        $data['description'] = 'Emcsquared - Home';  
        $data['currentpage'] = 'homepage';
		$this->load->view('frontend/header', $data);	
        $this->load->view('frontend/home', $data);
        $this->load->view('frontend/footer', $data);		
    }

    /*
	* About Us Page controller.
	*/
    public function aboutus(){      
     
        $data['title'] = 'About Us';
        $data['description'] = 'Emcsquared : About Us';
        $data['mainhead'] = 'About Us';
        $data['subhead'] = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';

		$data['currentpage'] = 'aboutuspage';
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/banner-style1', $data);
		$this->load->view('frontend/aboutus', $data);
        $this->load->view('frontend/footer-style1', $data);           
    }

    /*
	* Features Page controller.
	*/
    public function features(){      
     
        $data['title'] = 'Features';
        $data['description'] = 'Emcsquared : Services';
        $data['mainhead'] = 'Features';
        $data['subhead'] = '';
        $data['currentpage'] = 'featurepage';
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/featurebanner', $data);
		$this->load->view('frontend/services', $data);
        $this->load->view('frontend/footer-style1', $data);        
    }


     /*
	* Contact Us Page controller.
	*/
    public function contactus(){      
     
        $data['title'] = 'Contact Us';
        $data['description'] = 'Emcsquared : Contact Us';
        $data['mainhead'] = 'Contact Us';
        $data['subhead'] = '';
        $data['currentpage'] = 'contactuspage';

        if (!empty($this->session->flashdata('error'))) {

            $data['error'] = $this->session->flashdata('error');
        }
		
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/banner-style1', $data);
		$this->load->view('frontend/contactus', $data);
        $this->load->view('frontend/footer-style1', $data);
        
    }

    /**
	* Sitemap controller.
	*/
    public function sitemap(){
        $data['title'] = 'Sitemap';
        $data['description'] = 'Sitemap - Emcsquared';
        $data['mainhead'] = 'SITEMAP';
        $data['subhead'] = ''; 
        $data['currentpage'] = 'sitemappage';        
          
       

        
		$this->load->view('frontend/header', $data);
        $this->load->view('frontend/banner-style1', $data);
		$this->load->view('frontend/sitemap', $data);
        $this->load->view('frontend/footer-style1', $data);
         
     }


    /**
	* Thank You Page
	*/
    public function thankyou(){

        $data['currentpage'] = 'thankyoupage';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('phone','Phone Number','required|max_length[15]');
         
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
           // redirect('contact-us');
           // exit();
        }
        else{

            $name = $this->input->post("name");
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
		
            if(!empty($name) && !empty($phone) && !empty($email)){
                
                //Save Contact Details
                $arrContactDetails = array();
                $arrContactDetails['name'] = $name;
                $arrContactDetails['phone'] = $phone;
                $arrContactDetails['email'] = $email;
                $arrContactDetails['message'] = $this->input->post('message');		
                $InsUserId =$this->contactus_model->saveContactDetails($arrContactDetails);
                $this->load->library('email');
                $this->email->from('ansi@bubblegum.ae', 'Admin');
                $this->email->to('ansi@bubblegum.ae');
                $this->email->subject('Emcsquared : Contact Us Inquiry');
                $messageBody = '<html><head></head><body style="margin: 0; background-color: #ffffff; color: #000000; font: 16px/165% Arial, Helvetica, sans-serif;">
                <div style="margin: 20px auto; width: 590px;">
                        <div style="width:99%; padding: 0px 0 0px; border: 1px solid #cecece;border-radius:6px;
                        margin-top: 15px;">
                                
                                    <div style="background-color: #f2f2f3;padding: 5px 20px 15px;border-radius:6px 6px 0 0;border-bottom: 1px solid #cecece;text-align:center;">
                                <div style="max-width: 91px !important;max-height: 100px !important;float: left;margin-top: 1%;">
                                <img src="' . base_url() . 'assets/public/images/frontend/logo-email.jpg" alt="Emcsquared" width="91" height="100" style="max-width: 91px;max-height: 100px;display: block;">
                                </div>
                                
                            
                                
                                
                                <div style="clear: both;"></div>
                            </div>
                            <div style="padding: 23px 20px 50px 23px; background-color: #fdfdfd; border-radius: 0 0 5px 5px;">
                                <div style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 165%; padding: 5px 0 10px 0;">
                                    <p style="font-weight: bold;font-size:20px;margin-top: 0;margin-bottom: 35px;color: #000000;" align="center">Congratulations! You just acquired a new inquiry.</p>
                                    
                
                                <table style="border-spacing:0;width:100%;margin-top:20px">
                    <tbody><tr style="color:#fff">
                        <td style="border-radius:5px 5px 0 0;border:none;background-color: #000000;padding:10px 15px;font-size:16px;font-weight:bold;line-height:165%;" colspan="2">Submitted Data</td>
                    </tr>
                                        <tr>
                            <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 1px;padding:14px 14px 14px 14px;font-size:14px;text-align:left;font-weight:bold;width:165px;color:#000000;line-height:165%">Name:</td>
                        <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 0;font-size:14px;padding-left:14px;color:#000000;line-height:165%">' . $name . '</td>
                    </tr>
                
                                            
                    <tr style="background-color: #f4f4f4;">
                            <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 1px;padding:14px 14px 14px 14px;font-size:14px;text-align:left;font-weight:bold;width:165px;color:#000000;line-height:165%">Phone:</td>
                        <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 0;font-size:14px;padding-left:14px;color:#000000;line-height:165%">' . $phone . '</td>
                    </tr>
                    <tr style="">
                    <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 1px;padding:14px 14px 14px 14px;font-size:14px;text-align:left;font-weight:bold;width:165px;color:#000000;line-height:165%">Message:</td>
                    <td style="border-color:#ccc;border-style:solid;border-width:0 1px 1px 0;font-size:14px;padding-left:14px;color:#000000;line-height:165%">' . $arrContactDetails['message'] . '</td></tr>       
                    </tbody></table>
                                    <div style="clear:both;"></div> </div>
                            </div>
                        
                        </div>
                    </div>        
                </body></html>';
                $this->email->set_mailtype("html");
                $this->email->message( $messageBody);
                $rs = $this->email->send();
                if($rs){
                    
                }
            }
        }
        

        $data['title'] = 'Thank You';
        $data['description'] = 'Emcsquared : Thank You';
        $data['mainhead'] = 'THANK YOU';
        $data['subhead'] = '<p style="color:#ffffff;">Thank you for contacting us. One of our team members will get in touch with you shortly</p>';
        $data['bottomimage'] = false;
		
		$this->load->view('frontend/header', $data);
        $this->load->view('frontend/banner-style1', $data);
		$this->load->view('frontend/thankyou', $data);
        $this->load->view('frontend/footer-style1', $data);
    }


    /**
	* Thank You Page
	*/
    public function thankyou1(){

        $data['currentpage'] = 'thankyoupage';
        

        $data['title'] = 'Thank You';
        $data['description'] = 'Emcsquared : Thank You';
        $data['mainhead'] = 'THANK YOU';
        $data['subhead'] = '<p style="color:#ffffff;">Thanks For Attending The Class!</p>';
        $data['bottomimage'] = false;
		
		$this->load->view('frontend/header', $data);
        $this->load->view('frontend/banner-style1', $data);
		$this->load->view('frontend/thankyou', $data);
        $this->load->view('frontend/footer-style1', $data);
    }




    

	

   
    
	
	

    
}

?>