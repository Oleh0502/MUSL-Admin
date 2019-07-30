<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_notifications extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    	$this->load->library('pagination');
    	$this->load->model('Notifications_model','notification');
    }

	public function index()
	{
		if ($this->auth->has_permission('manage-notification'))
        {
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('notification_list');
            $this->load->view('include/footer');
        }
        else
        {
            redirect('','refresh');
        }
	}

	public function read($id)
	{
		$data['inbox_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Is_Deleted'=>'no','Important'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();

		$data['trash_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where('an.Is_Deleted','yes')->order_by('Assign_Id','desc')->get()->num_rows();

		$data['important_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Important'=>'yes','Is_Deleted'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();


		$data['notification'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where('an.Assign_Id',$id)->order_by('Assign_Id','desc')->limit(5)->get()->row_array();
		if(!empty($data['notification'])){
			// $this->common_model->update_data('assign_notification',array('Is_Read','yes'),array('Assign_Id',$id));
	        $this->load->view('include/header');
	        $this->load->view('include/sidebar');
	        $this->load->view('read_notification',$data);
	        $this->load->view('include/footer');
		}
		else{
			redirect('home','refresh');
		}
	}

	public function inbox()
	{
		if(isset($_POST) && !empty($_POST)){
			$input = $this->input->post();
			$update_data = array();
			if($input['action']=='read'){
				$update_data['Is_Read'] = 'yes';
			}
			else if($input['action']=='unread'){
				$update_data['Is_Read'] = 'no';
			}
			else if($input['action']=='important'){
				$update_data['Important'] = 'yes';
			}
			else if($input['action']=='delete'){
				$update_data['Is_Deleted'] = 'yes';
			}
			$ids = implode(',', $input['actions_id']);
			$sql = $this->common_model->update_data('assign_notification',$update_data,array('FIND_IN_SET(Assign_Id,"'.$ids.'")!='=>'0','User_Id'=>$this->session->userdata('User_Id')));
			if($sql){
				$this->session->set_flashdata('flash_status',true);
				$this->session->set_flashdata('msg','Notificatiosn has been updated');
			}
			redirect('home/user_notifications/inbox');
		}
		// init params
        $params = array();
        $params['inbox_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Is_Deleted'=>'no','Important'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();

		$params['trash_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where('an.Is_Deleted','yes')->order_by('Assign_Id','desc')->get()->num_rows();

		$params['important_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Important'=>'yes','Is_Deleted'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();

        $limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $where = array('Is_Deleted'=>'no','Important'=>'no');
        $total_records = $this->notification->get_total($where);
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->notification->get_current_page_records($limit_per_page, $page*$limit_per_page,$where);
                 
            $config['base_url'] = base_url() . 'user_notifications/inbox';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<div class="btn-toolbar margin-bottom-10 my-custom-pagination">';
            $config['full_tag_close'] = '</div>';
             
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['first_tag_close'] = '</div></div>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['last_tag_close'] = '</div></div>';
             
            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<button type="button" class="btn blue">';
            $config['next_tag_close'] = '</button>';
 
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<button type="button" class="btn blue">';
            $config['prev_tag_close'] = '</button>';
 
            $config['cur_tag_open'] = '<button type="button" class="btn blue disabled">';
            $config['cur_tag_close'] = '</button>';
 
            $config['num_tag_open'] = '<button type="button" class="btn blue">';
            $config['num_tag_close'] = '</button>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('inbox_notifications',$params);
        $this->load->view('include/footer');
	}

	public function important()
	{
		if(isset($_POST) && !empty($_POST)){
			$input = $this->input->post();
			$update_data = array();
			if($input['action']=='read'){
				$update_data['Is_Read'] = 'yes';
			}
			else if($input['action']=='unread'){
				$update_data['Is_Read'] = 'no';
			}
			else if($input['action']=='important'){
				$update_data['Important'] = 'no';
			}
			else if($input['action']=='delete'){
				$update_data['Is_Deleted'] = 'yes';
			}
			$ids = implode(',', $input['actions_id']);
			$sql = $this->common_model->update_data('assign_notification',$update_data,array('FIND_IN_SET(Assign_Id,"'.$ids.'")!='=>'0','User_Id'=>$this->session->userdata('User_Id')));
			if($sql){
				$this->session->set_flashdata('flash_status',true);
				$this->session->set_flashdata('msg','Notificatiosn has been updated');
			}
			redirect('home/user_notifications/important');
		}
		// init params
        $params = array();
        $params['inbox_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Is_Deleted'=>'no','Important'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();

		$params['trash_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where('an.Is_Deleted','yes')->order_by('Assign_Id','desc')->get()->num_rows();

		$params['important_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Important'=>'yes','Is_Deleted'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();
        $limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $where = array('Is_Deleted'=>'no', 'Important' => 'yes');
        $total_records = $this->notification->get_total($where);
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->notification->get_current_page_records($limit_per_page, $page*$limit_per_page,$where);
                 
            $config['base_url'] = base_url() . 'user_notifications/important';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<div class="btn-toolbar margin-bottom-10 my-custom-pagination">';
            $config['full_tag_close'] = '</div>';
             
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['first_tag_close'] = '</div></div>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['last_tag_close'] = '</div></div>';
             
            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<button type="button" class="btn blue">';
            $config['next_tag_close'] = '</button>';
 
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<button type="button" class="btn blue">';
            $config['prev_tag_close'] = '</button>';
 
            $config['cur_tag_open'] = '<button type="button" class="btn blue disabled">';
            $config['cur_tag_close'] = '</button>';
 
            $config['num_tag_open'] = '<button type="button" class="btn blue">';
            $config['num_tag_close'] = '</button>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('important_notifications',$params);
        $this->load->view('include/footer');
	}

	public function trash()
	{
		if(isset($_POST) && !empty($_POST)){
			$input = $this->input->post();
			$update_data = array();
			if($input['action']=='delete'){
				$update_data['Is_Deleted'] = 'no';
			}
			$ids = implode(',', $input['actions_id']);
			$sql = $this->common_model->update_data('assign_notification',$update_data,array('FIND_IN_SET(Assign_Id,"'.$ids.'")!='=>'0','User_Id'=>$this->session->userdata('User_Id')));
			if($sql){
				$this->session->set_flashdata('flash_status',true);
				$this->session->set_flashdata('msg','Notificatiosn has been updated');
			}
			redirect('home/user_notifications/trash');
		}
		// init params
        $params = array();
        $params['inbox_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Is_Deleted'=>'no','Important'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();

		$params['trash_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where('an.Is_Deleted','yes')->order_by('Assign_Id','desc')->get()->num_rows();

		$params['important_count'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where(array('an.Important'=>'yes','Is_Deleted'=>'no'))->order_by('Assign_Id','desc')->get()->num_rows();
        $limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $where = array('Is_Deleted'=>'yes');
        $total_records = $this->notification->get_total($where);
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->notification->get_current_page_records($limit_per_page, $page*$limit_per_page,$where);
                 
            $config['base_url'] = base_url() . 'user_notifications/trash';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<div class="btn-toolbar margin-bottom-10 my-custom-pagination">';
            $config['full_tag_close'] = '</div>';
             
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['first_tag_close'] = '</div></div>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<div class="btn-group"><button type="button" class="btn blue">';
            $config['last_tag_close'] = '</div></div>';
             
            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<button type="button" class="btn blue">';
            $config['next_tag_close'] = '</button>';
 
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<button type="button" class="btn blue">';
            $config['prev_tag_close'] = '</button>';
 
            $config['cur_tag_open'] = '<button type="button" class="btn blue disabled">';
            $config['cur_tag_close'] = '</button>';
 
            $config['num_tag_open'] = '<button type="button" class="btn blue">';
            $config['num_tag_close'] = '</button>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('trash_notifications',$params);
        $this->load->view('include/footer');
	}
}
