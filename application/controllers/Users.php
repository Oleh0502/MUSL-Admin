<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    //Index Fnction Start here
    public function index()
    {
        if ($this->auth->has_permission('manage-users'))
        {
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('users');
            $this->load->view('include/footer');
        }
        else
        {
            redirect('','refresh');
        }
    }
    //fetch user list here
    public function fetch_users()
    {
        $where = array(
            'u.User_Id!=' =>$this->session->userdata('User_Id'),
            'u.User_Type='=>    'user',
            'u.Is_Deleted' => '0'
        );
        $this->load->model("datatables/Users_list");
        $fetch_data = $this->Users_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->User_First_Name;
            $sub_array[] = $row->User_Last_Name;
            $sub_array[] = $row->User_Email;
            $sub_array[] = @$row->User_Phone;
            //$sub_array[] = $row->Company;
            $sub_array[] = get_date_format($row->Created_Date);
            $buttons     = '<a data-toggle="modal" href="#view_customer" onclick="view_user(' . $row->User_Id . ');" type="button" title="View" class="btn btn-icon-only green" ><i class="fa fa-eye"></i></a>';
            if ($this->auth->has_permission('manage-users', 'Edit'))
            {
                $buttons .= '<a data-toggle="modal" href="#edit_customer" type="button" title="Edit" onclick="edit_user(' . $row->User_Id . ');" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>';
                $buttons .= '<a data-toggle="modal" href="#reset_password_customer" type="button" title="Reset Password" onclick="reset_password_cus(' . $row->User_Id . ');" class="btn btn-icon-only dark"><i class="fa fa-user"></i></a>';
            }
            if ($this->auth->has_permission('manage-users', 'Delete'))
            {
                if ($row->Is_Blocked == 1)
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('account_activate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Activate_label').'" onclick=activate_account(' . $row->User_Id . ',"0","'.$msg.'"); class="btn btn-icon-only yellow"><i class="fa fa-times-circle"></i></a>';
                }
                else
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('account_deactivate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Deactivate_label').'" onclick=activate_account(' . $row->User_Id . ',"1","'.$msg.'"); class="btn btn-icon-only purple"><i class="fa fa-check"></i></a>';
                }
            }
            if ($this->auth->has_permission('manage-users', 'Perm_Delete'))
            {
                $msg = preg_replace('/\s+/', '_', $this->lang->line('admin_delete_title'));
                $buttons .= '<a type="button" title="'.$this->lang->line('Delete_title').'" onclick=perm_delete(' . $row->User_Id . ',"'.$msg.'"); class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';
            }
            $sub_array[] = $buttons;
            $data[]      = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST["draw"]),
            "recordsTotal"    => $this->Users_list->get_all_data($where),
            "recordsFiltered" => $this->Users_list->get_filtered_data($where),
            "data"            => $data,
        );
        echo json_encode($output);
    }
    //Add user Function start here
    public function add_user()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if ($this->auth->has_permission('manage-users', 'Add'))
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
	            $this->form_validation->set_rules('User_First_Name', 'User first name', 'required');
	            $this->form_validation->set_rules('User_Last_Name', 'User last name', 'required');
	            $this->form_validation->set_rules('User_Phone', 'user contact number', 'required');
	            $this->form_validation->set_rules('User_Email', 'User email', 'required|is_unique[users.User_Email]');
	            //$this->form_validation->set_rules('Company', 'Company', 'required');
	            //$this->form_validation->set_rules('Address1', 'Address1', 'required');
	            //$this->form_validation->set_rules('Address2', 'Address2', 'required');
	            $this->form_validation->set_rules('City', 'City', 'required');
	            //$this->form_validation->set_rules('State', 'State', 'required');
	            //$this->form_validation->set_rules('Country', 'Country', 'required');
	            //$this->form_validation->set_rules('Zipcode', 'Zipcode', 'required');
	            //$this->form_validation->set_rules('User_Name', 'User_Name', 'required|is_unique[users.User_Name]');
	            if ($this->form_validation->run() == false)
	            {
	                $notification['flash_status'] = false;
	                $notification['flash_type'] = 'validation';
	                $notification['flash_title']   = $this->lang->line('error_label');
	                $errors                        = $this->form_validation->_error_array;
                    $notification['flash_message'] = array_values($errors)[0];
	                exit(json_encode($notification));
	            }
                $password  =$input['User_Password'];
                $input['User_Type'] = 'user';
                $input['Modified_Date'] = date('Y-m-d H:i:s');
                $input['Created_Date'] = date('Y-m-d H:i:s');
                $input['User_Password'] = md5($input['User_Password']);
                $input['User_Image'] = 'dummy_user.png';
                $code = verificationcode();
                $input['Verify_Code'] = $code;
                unset($input['other_country']);
                unset($input['User_Password_Confirm']);
	            if ($this->common_model->insert_data('users', $input))
	            {
	            	//Add user to Aweber Subscribe
	            	$this->load->library('awebers');
	            	$aweber = $this->awebers->init();
	            	$data['user'] = $this->common_model->get_data('users',array('User_Type'=>'admin'),'single');
	            	//get Aweber account functionality
	            	if(!empty($data['user']['used_list'])){
	            		try {
			            	$account = $aweber->getAccount($data['user']['accessToken'], $data['user']['accessTokenSecret']);
				    		$aweber_user = $account->loadFromUrl('https://api.aweber.com/1.0/accounts');
				    		$account_id = $aweber_user->data['entries'][0]['id'];
				    		$list = $account->loadFromUrl("/accounts/{$account_id}/lists/{$data['user']['used_list']}");
							# create a subscriber
						    $params = array(
						        'email' => $input['User_Email'],
						        'misc_notes' => 'arimaccabi',
						        'name' => $input['User_First_Name'].' '.$input['User_Last_Name'],
						        'custom_fields' => array(
						            'phone' => $input['User_Phone']
						        ),
						    );
						    $subscribers = $list->subscribers;
						    $new_subscriber = $subscribers->create($params);
					    } catch(AWeberAPIException $exc) {
						}
	            	}
	            	//get response account created
	            	if(!empty($data['user']['get_response_used_list'])){
		            	try {
			            	$this->load->library('getresponselib');
	    					$getRes = $this->getresponselib->init();					    
						    # add contact to the campaign
							try {
								$result = $getRes->add_contact(
							        $data['user']['get_response_api_key'],
							        array (
							            # identifier of 'test' campaign
						                'campaign'  => $data['user']['get_response_used_list'],								  
						                # basic info
						                'name'      => $input['User_First_Name'].' '.$input['User_Last_Name'],
						            	'email'     => $input['User_Email']
							        )
							    );
							} catch (Exception $e) {
								
							}
					    } catch(AWeberAPIException $exc) {
						}
	            	}
	                $insert_id = $this->db->insert_id();
	                $where = array(
	                    'User_Email'    => $input['User_Email'],
	                    'User_Password' => md5($password),
	                );
	                $input = $this->common_model->get_data('users', $where, 'single');
	                
	                
	                //Mail to User
	                $data['subject'] = $this->lang->line('customer_register_subject_temp');
	                $data['message'] = $this->lang->line('customer_register_body_temp');
	                $replaceto       = array("userfirstname__", "activationlink__");
	                $link = base_url('register/verify/'.$code);
	                $replacewith     = array($input['User_First_Name'] . " " . $input['User_Last_Name'],$link);
	                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
	                $view_content    = $this->load->view('email_template', $data, true);
	                send_email($input['User_Email'], $data['subject'], $view_content);
	                //Mail to Admin
	                $data['subject'] = $this->lang->line('customer_reg_subject_for_admin');
	                $data['message'] = $this->lang->line('customer_reg_body_for_admin');
	                $replaceto       = array("userfirstname__", "email__","mobilecontact__");
	                $replacewith     = array($input['User_First_Name'] . " " . $input['User_Last_Name'],$input['User_Email'],$input['User_Phone']);
	                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
	                $view_content    = $this->load->view('email_template', $data, true);
	                send_email(ADMIN_MAIL, $data['subject'], $view_content);
		            $notification['flash_status']  = true;
		            $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('success_label');
		            $notification['flash_message'] = $this->lang->line('customer_added');
	            }
            	else
            	{
	                $notification['flash_status']  = false;
	                $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('error_label');
		            $notification['flash_message'] = $this->lang->line('indirect_access');
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
    //Add user Function start here
    public function edit_user()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if ($this->auth->has_permission('manage-users', 'Edit'))
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
                $this->form_validation->set_rules('User_Id', 'User Id', 'required');
	            $this->form_validation->set_rules('edit_User_First_Name', 'User first name', 'required');
	            $this->form_validation->set_rules('edit_User_Last_Name', 'User last name', 'required');
	            $this->form_validation->set_rules('edit_User_Phone', 'user contact number', 'required');
	            // $this->form_validation->set_rules('User_Email', 'User email', 'required|is_unique[users.User_Email]');
	            $this->form_validation->set_rules('edit_Company', 'Company', 'required');
	            $this->form_validation->set_rules('edit_Address1', 'Address1', 'required');
	            $this->form_validation->set_rules('edit_Address2', 'Address2', 'required');
	            $this->form_validation->set_rules('edit_City', 'City', 'required');
	            $this->form_validation->set_rules('edit_State', 'State', 'required');
	            $this->form_validation->set_rules('edit_Country', 'Country', 'required');
	            $this->form_validation->set_rules('edit_Zipcode', 'Zipcode', 'required');
	            // $this->form_validation->set_rules('User_Name', 'User_Name', 'required|is_unique[users.User_Name]');
	            if ($this->form_validation->run() == false)
	            {
	                $notification['flash_status'] = false;
	                $notification['flash_type'] = 'validation';
	                $notification['flash_title']   = $this->lang->line('error_label');
	                $errors                        = $this->form_validation->_error_array;
                    $notification['flash_message'] = array_values($errors)[0];
	                exit(json_encode($notification));
	            }
	            $update_data['User_Id'] = $input['User_Id'];
	            $update_data['User_First_Name'] = $input['edit_User_First_Name'];
	            $update_data['User_Last_Name'] = $input['edit_User_Last_Name'];
	            $update_data['User_Phone'] = $input['edit_User_Phone'];
	            $update_data['Company'] = $input['edit_Company'];
	            $update_data['Address1'] = $input['edit_Address1'];
	            $update_data['Address2'] = $input['edit_Address2'];
	            $update_data['City'] = $input['edit_City'];
	            $update_data['State'] = $input['edit_State'];
	            $update_data['Country'] = $input['edit_Country'];
	            $update_data['Zipcode'] = $input['edit_Zipcode'];
                $update_data['Modified_Date'] = date('Y-m-d H:i:s');
	            if ($this->common_model->update_data('users', $update_data,  array('User_Id'=>$input['User_Id'])))
	            {
		            $notification['flash_status']  = true;
		            $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('success_label');
		            $notification['flash_message'] = $this->lang->line('customer_updated');
	            }
            	else
            	{
	                $notification['flash_status']  = false;
	                $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('error_label');
		            $notification['flash_message'] = $this->lang->line('indirect_access');
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
    //reset user Function start here
    public function reset_user_password()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if ($this->auth->has_permission('manage-users', 'Edit'))
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
                $this->form_validation->set_rules('Reset_User_Id', 'User first name', 'required');
	            $this->form_validation->set_rules('Reset_User_Password', 'Ppassword', 'required');
	            $this->form_validation->set_rules('Reset_User_Password_Confirm', 'Confirm Password', 'required|matches[Reset_User_Password]');
	            if ($this->form_validation->run() == false)
	            {
	                $notification['flash_status'] = false;
	                $notification['flash_type'] = 'validation';
	                $notification['flash_title']   = $this->lang->line('error_label');
	                $errors                        = $this->form_validation->_error_array;
                    $notification['flash_message'] = array_values($errors)[0];
	                exit(json_encode($notification));
	            }
                $input['Modified_Date'] = date('Y-m-d H:i:s');
                $input['User_Password'] = md5($input['Reset_User_Password']);
                unset($input['Reset_User_Password_Confirm']);
                unset($input['Reset_User_Password']);
                $User_Id = $input['Reset_User_Id'];
                unset($input['Reset_User_Id']);
	            if ($this->common_model->update_data('users', $input,  array('User_Id'=>$User_Id)))
	            {
		            $notification['flash_status']  = true;
		            $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('success_label');
		            $notification['flash_message'] = $this->lang->line('password_update_success');
	            }
            	else
            	{
	                $notification['flash_status']  = false;
	                $notification['flash_type'] = 'account';
		            $notification['flash_title']   = $this->lang->line('error_label');
		            $notification['flash_message'] = $this->lang->line('indirect_access');
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
    public function get_user()
    {
        if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $where                = array('User_Id' => $_POST['id']);
            $notification['data'] = $this->common_model->get_data('users', $where, 'single');
            if (!empty($notification['data']))
            {
                $notification['flash_status'] = true;
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
    //Activate and Deactivate Account here
    public function activate_account()
    {
    	if ($this->input->is_ajax_request())
        {
	        if ($this->input->post())
	        {
	        	$perm_check = 0;
	        	if ($this->auth->has_permission('manage-users', 'Delete'))
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
	            $where              = array('User_Id' => $_POST['id']);
	            $data['Is_Blocked'] = $input['status'];
	            if ($this->common_model->update_data('users', $data, $where))
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
    public function delete_user()
    {
        if ($this->input->post())
        {
        	if ($this->auth->has_permission('manage-users', 'Perm_Delete'))
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
            $where              = array('User_Id' => $_POST['id']);
            $data['Is_Deleted'] = '1';
            if ($this->common_model->update_data('users', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('customer_deleted');
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
