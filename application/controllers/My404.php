<?php
class My404 extends CI_Controller{
	public function __construct(){
	   parent::__construct();
	}
	public function index(){
	   $this->output->set_status_header('404');
	   //$this->load->view('err404');  
 $data['title'] = '404 - Page Not Found';
        $data['description'] = 'Page you are looking for not found';
     
         
          $data['innerpage'] = true;
          $data['errorpage'] = true;          
          $data['innerpageother'] = true;
		
         $this->load->view('frontend/Header', $data);
        
		 
      
        
		$this->load->view('my404', $data);
		
        $this->load->view('frontend/Footerstyle1', $data);
        
		
	}
}