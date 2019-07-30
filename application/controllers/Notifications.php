<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
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

	//fetch notification list here
    public function fetch_notifications()
    {
        $where = array(
            'Noti_Id!=' => '1',
        );
        $this->load->model("datatables/Notification_list");
        $fetch_data = $this->Notification_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->Heading;
            $sub_array[] = get_date_format($row->Created);
            $buttons     = "";
            if ($this->auth->has_permission('manage-notification', 'View'))
            {
                $buttons .= '
				<a onclick="view_notification(' . $row->Noti_Id . ');" type="button" title="View" class="btn btn-icon-only green" ><i class="fa fa-eye"></i></a>
				';
            }
            if ($this->auth->has_permission('manage-notification', 'Edit'))
            {
                $buttons .= '
				<a onclick="edit_notification(' . $row->Noti_Id . ');" type="button" title="Edit" class="btn btn-icon-only blue" ><i class="fa fa-pencil"></i></a>
				';
            }
            if ($this->auth->has_permission('manage-roles', 'Perm_Delete'))
            {
                // if($this->check_used($row->Noti_Id))
                // {
                    $buttons .= '<a type="button" title="Delete" onclick="perm_delete(' . $row->Noti_Id . ');" class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';    
                // }
            }
            $sub_array[] = $buttons;
            $data[]      = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST["draw"]),
            "recordsTotal"    => $this->Notification_list->get_all_data($where),
            "recordsFiltered" => $this->Notification_list->get_filtered_data($where),
            "data"            => $data,
        );
        echo json_encode($output);
    }

	//Add Notification Function start here
    public function add_notification()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if (!empty($input['Notification_Id']))
                {
                    if ($this->auth->has_permission('manage-notification', 'Edit'))
                    {
                        $perm_check = 1;
                    }
                }
                else
                {
                    if ($this->auth->has_permission('manage-notification', 'Add'))
                    {
                        $perm_check = 1;
                    }
                }               
                if ($perm_check == 0)
                {
                    $notification['flash_status']  = false;
                    $notification['flash_title']   = $this->lang->line('error_title');
                    $notification['flash_message'] = $this->lang->line('permissions_error');
                    exit(json_encode($notification));

                }
	            $this->form_validation->set_rules('Heading', 'heading', 'required');
	            $this->form_validation->set_rules('Description_Value', 'description', 'required');
	            if ($this->form_validation->run() == false)
	            {
	                $notification['flash_status'] = false;
	                $notification['flash_type'] = 'validation';
	                $notification['flash_title']   = $this->lang->line('error_label');
	                $notification['flash_message']    = $this->form_validation->error_array();
	                exit(json_encode($notification));
	            }
	            
	            $input['Description'] = htmlentities($input['Description_Value']);
	            unset($input['Description_Value']);
	            $input['Created'] = date('Y-m-d H:i:s');
	            if (!empty($input['Notification_Id']))
                {
                    $where                  = array('Noti_Id' => $input['Notification_Id']);
                    unset($input['User_Email']);
                    unset($input['Notification_Id']);
                    if ($this->common_model->update_data('notifications', $input, $where))
                    {
                        $notification['flash_status']  = true;
                        $notification['flash_title']   = $this->lang->line('success_title');
                        $notification['flash_message'] = $this->lang->line('notification_updated');
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
                	unset($input['Notification_Id']);
		            if ($this->common_model->insert_data('notifications', $input))
		            {
		                $insert_id = $this->db->insert_id();
		                $sql= 'INSERT INTO '.$this->db->dbprefix('assign_notification').'(User_Id,Noti_Id) SELECT User_Id,"'.$insert_id.'" as noti_id FROM '.$this->db->dbprefix('users').' WHERE User_Type="customer"';
		                $this->db->query($sql);

			            $notification['flash_status']  = true;
			            $notification['flash_type'] = 'account';
			            $notification['flash_title']   = $this->lang->line('success_label');
			            $notification['flash_message'] = $this->lang->line('notification_added');
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
        exit(json_encode($notification));
    }

     //Get User Info Here
    public function get_notification()
    {
        if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $where                = array('Noti_Id' => $_POST['id']);
            $notification['data'] = $this->common_model->get_data('notifications', $where, 'single');
            if (!empty($notification['data']))
            {
                $notification['flash_status'] = true;
                $notification['description'] = html_entity_decode($notification['data']['Description']);
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
        header('Content-Type: application/json');
        exit(json_encode($notification));
    }

    public function delete_notification()
    {
        if ($this->input->post())
        {
        	if ($this->auth->has_permission('manage-notification', 'Perm_Delete'))
            {
                $perm_check = 1;
            }                
            if ($perm_check == 0)
            {
                $notification['flash_status']  = false;
                $notification['flash_title']   = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('permissions_error');
                exit(json_encode($notification));
            }
            $input              = $this->input->post();
            $where              = array('Noti_Id' => $_POST['id']);
            $data['Is_Deleted'] = '1';
            if ($this->db->where($where)->delete('notifications'))
            {
            	$this->db->where($where)->delete('assign_notification');
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('notification_deleted');
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
        header('Content-Type: application/json');
        exit(json_encode($notification));
    }
}
