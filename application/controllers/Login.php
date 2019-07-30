<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        
    }
	public function index()
	{
		if(isset($_SESSION['User_Id']) && !empty($_SESSION['User_Id'])){
        	redirect('/user_administrator');
        }
		if ($this->input->post())
        {
        	$data = array();
            $input = $this->input->post();
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('User_Email', 'User Email', 'required|is_exist');
            $this->form_validation->set_rules('User_Password', 'Password name', 'required|check_password');
            if ($this->form_validation->run() == false)
            {
                $this->load->view('include/login_header');
				$this->load->view('login');
				$this->load->view('include/login_footer');
            }
            else
            {
                $where        = array('User_Email' => $input['User_Email'], 'User_Password' => md5($input['User_Password']));
                $User_Info    = $this->common_model->get_data('users', $where, 'single');
                $SessionData  = array(
                    'User_Id'         => $User_Info['User_Id'],
                    'User_Email'      => $User_Info['User_Email'],
                    'User_Name'      => $User_Info['User_Name'],
                    // 'User_First_Name' => $User_Info['User_First_Name'],
                    // 'User_Last_Name'  => $User_Info['User_Last_Name'],
                    'User_Contact'    => $User_Info['User_Contact'],
                    'User_Image'      => $User_Info['User_Image'],
                    'User_Type'       => $User_Info['User_Type'],
                    'Role'            => $User_Info['Role'],

                );
                $this->session->set_userdata($SessionData);
                redirect(base_url('user_administrator'));

            }
        }
        else{
			$this->load->view('include/login_header');
			$this->load->view('login');
			$this->load->view('include/login_footer');
        }
	}

    public function logout(){
        $Info = array(
            'User_Id',
            'User_Email',
            // 'User_First_Name',
            // 'User_Last_Name',
            'User_Contact',
            'User_Image',
            'User_Type',
            'Role',
        );
        $this->session->unset_userdata($Info);
        redirect('/', 'refresh');
    }


     public function forgot()
    {
        if(isset($_SESSION['User_Id']) && !empty($_SESSION['User_Id'])){
        	redirect('/home/dashboard');
        }
        if ($this->input->post())
        {
            $input = $this->input->post();
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('User_Email_forgot', 'User Email', 'trim|required|is_exist');
            if ($this->form_validation->run() == false)
            {
                $notification['flash_status'] = false;
                $notification['flash_type'] = 'validation';
                $notification['flash_title']   = $this->lang->line('error_label');
                $notification['flash_message']    = $this->form_validation->error_array();;
            }
            else
            {
                $User_Info                        = $this->common_model->select_data(array('User_Email', 'User_Id'), 'users', array('User_Email' => $input['User_Email_forgot']), 'single', '', array('User_Email' => $input['User_Email_forgot']));
                $where                            = array('User_Email' => $User_Info['User_Email']);
                $password                         = $Password                         = RandomPassword(8);
                $update_password['User_Password'] = md5($password);
                $update_password['Modified_Date'] = date('Y-m-d H:i:s');
                $this->common_model->update_data('users', $update_password, $where);

                $data['subject'] = $this->lang->line('forgot_password_subject_temp');
                $data['message'] = $this->lang->line('forgot_password_body_temp');
                $replaceto       = array("userfirstname__", "password__","loginlink__");
                $replacewith     = array('Admin',$password,base_url('login'));
                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
                $view_content    = $this->load->view('email_template', $data, true);
                send_email($User_Info['User_Email'], $data['subject'], $view_content);

                $notification['data']   = $User_Info;
                $notification['flash_status'] = true;
                $notification['flash_title'] = 'account';
                $notification['flash_message']    = $this->lang->line('forget_password_success');
            }
				echo json_encode($notification);
        }
        else
        {
            $notification['flash_status']  = false;
            $notification['flash_type'] = 'account';
            $notification['flash_title']   = $this->lang->line('error_label');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
    }
}
