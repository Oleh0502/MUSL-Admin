<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_reporting extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
	public function index()
	{
			if(isset($_POST) && !empty($_POST)){
            $data = array();
            $data['result'] = true;
            
            $data['users'] = $this->common_model->CountByCondition('users','(Created_Date >= "'.date('Y-m-d H:i:s',strtotime($_POST['start_date'])).'" && Created_Date <= "'.date('Y-m-d H:i:s',strtotime($_POST['end_date'])).'" && User_Type = "user")');
           
            $data['friend'] = $this->common_model->CountByCondition('user_profiles','(created_on >= "'.date('Y-m-d H:i:s',strtotime($_POST['start_date'])).'" && created_on <= "'.date('Y-m-d H:i:s',strtotime($_POST['end_date'])).'" && profile_type = "friend")');
            $data['flirt'] = $this->common_model->CountByCondition('user_profiles','(created_on >= "'.date('Y-m-d H:i:s',strtotime($_POST['start_date'])).'" && created_on <= "'.date('Y-m-d H:i:s',strtotime($_POST['end_date'])).'" && profile_type = "flirt")');
            $data['fun'] = $this->common_model->CountByCondition('user_profiles','(created_on >= "'.date('Y-m-d H:i:s',strtotime($_POST['start_date'])).'" && created_on <= "'.date('Y-m-d H:i:s',strtotime($_POST['end_date'])).'" && profile_type = "fun")');
           $data['user_session'] = 0;
           $data['friend_session'] = 0;
           $data['flirt_session'] = 0;
           $data['fun_session'] = 0;
           $data['post_data'] = $_POST;


               
            $this->load->view('include/login_header');
            $this->load->view('user_reporting',$data);
            $this->load->view('include/login_footer');
          }else{
    		$this->load->view('include/login_header');
    		$this->load->view('user_reporting');
    		$this->load->view('include/login_footer');
        }
       
	}
	public function list()
	{
		
			$this->load->view('include/login_header');
			$this->load->view('user_reporting_list');
			$this->load->view('include/login_footer');
       
	}
    


     
}
