<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_administrator extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    //User Administartor page content
	public function index()
	{
	    if(isset($_GET) && !empty($_GET)){
            $data = array();
            $where = '';
            if(!isset($_GET['user_id']) || empty($_GET['user_id'])){
                if(!empty($_GET['profile_name'])){
                    $where = ' and (profile_name like "%'.$_GET['profile_name'].'%")';
                }

                if(!empty($_GET['email'])){
                    $where .= ' and u.User_Email = "'.$_GET['email'].'"';
                }

                if(!empty($_GET['profile_state'])){
                    $where .= ' and profile_type = "'.$_GET['profile_state'].'"';
                }
                $where = ltrim($where, ' and');
                $data['result'] = $this->db->select('p.*,u.User_Email,u.User_Id')->from('users as u')->where($where)->join('user_profiles as p','u.User_Id = p.user_id','left')->get()->result_array();
            }else{
                $data['user_details'] = $this->db->select('*')->from('users')->where(array('User_Id'=>$_GET['user_id']))->get()->row_array();
                $data['profile'] = $this->db->select('*')->from('user_profiles')->where(array('profile_id'=>$_GET['profile_id']))->get()->row_array();
                $data['profile_details'] = $this->db->select('p.*,u.User_Email,u.Is_Blocked,u.User_Id')->from('users as u')->where(array('u.User_Id'=>$_GET['user_id']))->join('user_profiles as p','u.User_Id = p.user_id','right')->get()->result_array();
                foreach ($data['profile_details'] as $key => $value) {
                    $data['profile_details'][$key]['private_photos'] = $this->common_model->get_data('private_pics',array('profile_id'=>$value['profile_id']));
                }
            }
            $data['profile_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}&user_id=";
            $this->load->view('include/login_header');
            $this->load->view('user_administrator',$data);
            $this->load->view('include/login_footer');
            }
            else
            {
    		$this->load->view('include/login_header');
    		$this->load->view('user_administrator');
    		$this->load->view('include/login_footer');
        }
	}

    //Activate/Deactivate account
    public function activate_account()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input              = $this->input->post();
                if($input['type'] == 'profile'){
                    $where              = array('profile_id' => $_POST['id']);
                    $data['is_blocked'] = $input['status'];
                    $table = 'user_profiles';
                }

                if($input['type'] == 'user'){
                    $where              = array('User_Id' => $_POST['id']);
                    $data['Is_Blocked'] = $input['status'];
                    $table = 'users';
                }
                if ($this->common_model->update_data($table, $data, $where))
                {
                    $notification['flash_status']  = true;
                    $notification['flash_title']   = $this->lang->line('success_title');
                    $notification['flash_message'] = $this->lang->line('customer_updated');
                }
                else
                {
                    $notification['flash_status']  = false;
                    $notification['flash_title']   = $this->lang->line('error_title');
                    $notification['flash_message'] = $this->lang->line('common_error');
                }
            }
            else
            {
                $notification['flash_status']  = false;
                $notification['flash_title']   = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        }
        else
        {
            $notification['flash_status']  = false;
            $notification['flash_title']   = $this->lang->line('error_title');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
        header('Content-Type: application/json');
        exit(json_encode($notification));
    }

     
}
