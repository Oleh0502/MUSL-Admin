<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Emails extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    //Index Fnction Start here
    public function index()
    {
        if ($this->auth->has_permission('manage-emails'))
        {
            $where         = array('Is_Blocked' => '0','Is_Deleted'=>'0');
            $data['programs'] = $this->common_model->get_data('programs', $where);
            $where         = array('Email_Id!=' => '0');
            $data['emails'] = $this->common_model->get_data('emails', $where);
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('emails', $data);
            $this->load->view('include/footer');
        }
        else
        {
            redirect('','refresh');
        }
    }
    public function autoresponder($program_id)
    {
        if ($this->session->userdata('User_Type')=='customer')
        {
        	$res = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
	    	if(empty($res)) {
	    		$res2 = $this->common_model->get_data('packages_purchase',array('P_Type'=>'Single','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes','Package_Id'=>$program_id),'single');
	    		if(empty($res2)){
	    			redirect('home/payment/do_payment/'.$program_id);
	    		}
	    	}

            $data['emails'] = $this->db->where('Email_Id!=0 && Program_Id='.$program_id.' && ( User_Type="admin" || (User_Type="customer" && User_Id="'.$this->session->userdata('User_Id').'"))')->order_by('Email_Id','desc')->get('emails')->result_array();
            $data['program_id'] = $program_id;
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('auto_emails', $data);
            $this->load->view('include/footer');
        }
        else
        {
            redirect('','refresh');
        }
    }
    public function add_email()
    {
    	$input = $this->input->post();
    	if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input = $this->input->post();
                $perm_check = 0;
                if($this->session->userdata('User_Type'=='admin')) {
	                if ($this->auth->has_permission('manage-emails', 'Add'))
	                {
	                    $perm_check = 1;
	                }
	                if ($perm_check == 0)
	                {
	                    $notification['flash_status'] = false;
	                    $notification['flash_title'] = $this->lang->line('error_title');
	                    $notification['flash_message'] = $this->lang->line('permissions_error');
	                    exit(json_encode($notification));
	                }
                } 
                $this->form_validation->set_rules('Add_Program_Id', 'Program Id', 'trim|required');
                $this->form_validation->set_rules('Add_Title', 'Email Title', 'trim|required');
                $this->form_validation->set_rules('Add_Subject', 'Email Subject', 'trim|required');
                $this->form_validation->set_rules('Add_Days', 'Email Days', 'trim|required');
                $this->form_validation->set_rules('Add_Content', 'Email Content', 'trim|required');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status'] = false;
                    $notification['flash_title'] = $this->lang->line('error_title');
                    $errors = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                    $update_data = array(
                        'Email_Subject' => $input['Add_Subject'],
                        'Email_Title' => $input['Add_Title'],
                        'Email_Body' => $input['Add_Content'], // htmlentities($input['Add_Content']),
                        'Days' => $input['Edit_Days'], //htmlentities($input['Add_Days']),
                        'Program_Id' => $input['Add_Program_Id']
                    );
                    if($this->session->userdata('User_Type')!='admin') {
                    	// echo "sd";
                    	$update_data['User_Id'] = $this->session->userdata('User_Id');
                    	$update_data['User_Type'] = 'customer';
                    }
                    if ($this->common_model->insert_data('emails',$update_data))
                    {
                        $notification['flash_status'] = true;
                        $notification['flash_title'] = $this->lang->line('success_title');
                        $notification['flash_message'] = $this->lang->line('email_updated');
                    }
                    else
                    {
                        $notification['flash_status'] = false;
                        $notification['flash_title'] = $this->lang->line('error_title');
                        $notification['flash_message'] = $this->lang->line('cdommon_error');
                    }
                }
            }
            else
            {
                $notification['flash_status'] = false;
                $notification['flash_title'] = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        }
        else
        {
            $notification['flash_status'] = false;
            $notification['flash_title'] = $this->lang->line('error_title');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
        exit(json_encode($notification));
    }
    public function edit_email()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input = $this->input->post();
                $perm_check = 0;
                if($this->session->userdata('User_Type'=='admin')) {
	                if ($this->auth->has_permission('manage-emails', 'Edit'))
	                {
	                    $perm_check = 1;
	                }
	                if ($perm_check == 0)
	                {
	                    $notification['flash_status'] = false;
	                    $notification['flash_title'] = $this->lang->line('error_title');
	                    $notification['flash_message'] = $this->lang->line('permissions_error');
	                    exit(json_encode($notification));
	                }
            	}
                $this->form_validation->set_rules('Edit_Title', 'Email Title', 'trim|required');
                $this->form_validation->set_rules('Edit_Program_Id', 'Program Id', 'trim|required');
                $this->form_validation->set_rules('Edit_Id', 'Email Id', 'trim|required');
                $this->form_validation->set_rules('Edit_Subject', 'Email Subject', 'trim|required');
                $this->form_validation->set_rules('Edit_Days', 'Email Days', 'trim|required');
                $this->form_validation->set_rules('Edit_Content', 'Email Content', 'trim|required');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status'] = false;
                    $notification['flash_title'] = $this->lang->line('error_title');
                    $errors = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                	if($this->session->userdata('User_Type'!='admin')) {
                		$res = $this->common_model->get_data('emails', array('Email_Id'=>$input['Edit_Id'],'User_Id'=>$this->session->userdata('User_Id')));
                		if(empty($res)){
                			$notification['flash_status'] = false;
		                    $notification['flash_title'] = $this->lang->line('error_title');                    
		                    $notification['flash_message'] = 'Something went wrong.';
		                    exit(json_encode($notification));
                		}
                	}
                    $update_data = array(
                        'Email_Subject' => $input['Edit_Subject'],
                        'Program_Id' => $input['Edit_Program_Id'],
                        'Email_Title' => $input['Edit_Title'],
                        'Email_Body' => $input['Edit_Content'], // htmlentities($input['Edit_Content']),
                        'Days' => $input['Edit_Days'] //htmlentities($input['Edit_Days'])
                    );
                    if ($this->common_model->update_data('emails',$update_data, array('Email_Id'=>$input['Edit_Id'])))
                    {
                        $notification['flash_status'] = true;
                        $notification['flash_title'] = $this->lang->line('success_title');
                        $notification['flash_message'] = $this->lang->line('email_updated');
                    }
                    else
                    {
                        $notification['flash_status'] = false;
                        $notification['flash_title'] = $this->lang->line('error_title');
                        $notification['flash_message'] = $this->lang->line('cdommon_error');
                    }
                }
            }
            else
            {
                $notification['flash_status'] = false;
                $notification['flash_title'] = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        }
        else
        {
            $notification['flash_status'] = false;
            $notification['flash_title'] = $this->lang->line('error_title');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
        exit(json_encode($notification));
    }
     
    public function delete_email()
    {
    	header('Content-Type: application/json');
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input = $this->input->post();
                $perm_check = 0;
                if($this->session->userdata('User_Type'=='admin')) {
	                if ($this->auth->has_permission('manage-emails', 'Perm_Delete'))
	                {
	                    $perm_check = 1;
	                }
	                if ($perm_check == 0)
	                {
	                    $notification['flash_status'] = false;
	                    $notification['flash_title'] = $this->lang->line('error_title');
	                    $notification['flash_message'] = $this->lang->line('permissions_error');
	                    exit(json_encode($notification));
	                }
                } 
                
                $this->form_validation->set_rules('id', 'ID', 'trim|required');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status'] = false;
                    $notification['flash_title'] = $this->lang->line('error_title');
                    $errors = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                	if($this->session->userdata('User_Type'!='admin')) {
                		$res = $this->common_model->get_data('emails', array('Email_Id'=>$input['id'],'User_Id'=>$this->session->userdata('User_Id')));
                		if(empty($res)){
                			$notification['flash_status'] = false;
		                    $notification['flash_title'] = $this->lang->line('error_title');                    
		                    $notification['flash_message'] = 'Something went wrong.';
		                    exit(json_encode($notification));
                		}
                	}
                    if ($this->common_model->delete_data('emails',array('Email_Id'=>$input['id'])))
                    {
                        $notification['flash_status'] = true;
                        $notification['flash_title'] = $this->lang->line('success_title');
                        $notification['flash_message'] = $this->lang->line('email_updated');
                    }
                    else
                    {
                        $notification['flash_status'] = false;
                        $notification['flash_title'] = $this->lang->line('error_title');
                        $notification['flash_message'] = $this->lang->line('common_error');
                    }
                }
            }
            else
            {
                $notification['flash_status'] = false;
                $notification['flash_title'] = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        }
        else
        {
            $notification['flash_status'] = false;
            $notification['flash_title'] = $this->lang->line('error_title');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
        exit(json_encode($notification));
    }
    public function fetch_emails()
    {
        $where = array(
            'Email_Id!=' => '0',
        );
        $this->load->model("datatables/Email_list");
        $fetch_data = $this->Email_list->make_datatables($where);
        $data = array();
        $i = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->Email_Title;
            $sub_array[] = $row->Package_Name;
            $sub_array[] = $row->Email_Subject;
            $sub_array[] = $row->Days;
            $buttons = "";
            if ($this->auth->has_permission('manage-emails', 'Edit'))
            {
                $buttons.= '<a type="button" title="Edit" onclick=edit_email("'.$row->Email_Id.'") class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>';
            }
            if ($this->auth->has_permission('manage-emails', 'View'))
            {
                $buttons.= '<a type="button" title="View" onclick=view_email("'.$row->Email_Id.'") class="btn btn-icon-only green"><i class="fa fa-eye"></i></a>';
            }
            if ($this->auth->has_permission('manage-emails', 'Perm_Delete'))
            {
                $buttons.= '<a type="button" title="View" onclick=perm_delete("'.$row->Email_Id.'") class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';
            } 
            $sub_array[] = $buttons;
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]) ,
            "recordsTotal" => $this->Email_list->get_all_data($where) ,
            "recordsFiltered" => $this->Email_list->get_filtered_data($where) ,
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function fetch_emails_auto()
    {
        $where = array(
            'Email_Id!=' => '0',
        );
        $this->load->model("datatables/Email_list");
        $fetch_data = $this->Email_list->make_datatables($where);
        $data = array();
        $i = 1;
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->Email_Title;
            $sub_array[] = $row->Days;
            $buttons = "";
            $buttons.= '<a type="button" title="View" onclick=view_email("'.$row->Email_Id.'") class="btn btn-icon-only green"><i class="fa fa-eye"></i></a>';
            $sub_array[] = $buttons;
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]) ,
            "recordsTotal" => $this->Email_list->get_all_data($where) ,
            "recordsFiltered" => $this->Email_list->get_filtered_data($where) ,
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function get_email()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input = $this->input->post();
                $perm_check = 0;
                if ($this->auth->has_permission('manage-emails', 'View'))
                {
                    $perm_check = 1;
                }
                // if ($perm_check == 0)
                // {
                //     $notification['flash_status'] = false;
                //     $notification['flash_title'] = $this->lang->line('error_title');
                //     $notification['flash_message'] = $this->lang->line('permissions_error');
                //     exit(json_encode($notification));
                // }
                $this->form_validation->set_rules('id', 'Id', 'trim|required');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status'] = false;
                    $notification['flash_title'] = $this->lang->line('error_title');
                    $errors = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                    $data = $this->common_model->get_data('emails',array('Email_Id'=>$input['id']),'single');
                    $notification['flash_status'] = true;
                    //$data['Email_Body'] =  html_entity_decode($data['Email_Body']);
                    $data['Email_Body'] = stripslashes($data['Email_Body']);
                    $notification['data'] = $data;
                }
            }
            else
            {
                $notification['flash_status'] = false;
                $notification['flash_title'] = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        }
        else
        {
            $notification['flash_status'] = false;
            $notification['flash_title'] = $this->lang->line('error_title');
            $notification['flash_message'] = $this->lang->line('indirect_access');
        }
        header('Content-Type: application/json');
        exit(json_encode($notification));
    }
}