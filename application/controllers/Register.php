<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->auth->is_login();
    }
    
	public function index()
    {   
        if(isset($_SESSION['User_Id'])){
            redirect('home');
        }
        if (isset($_POST) && !empty($_POST))
        {
            $input = $this->input->post();
            $this->form_validation->set_rules('User_First_Name', 'User first name', 'required');
            $this->form_validation->set_rules('User_Last_Name', 'User last name', 'required');
             $this->form_validation->set_rules('User_Phone', 'user contact number', 'required');
            $this->form_validation->set_rules('User_Email', 'User email', 'required|is_unique[users.User_Email]');
            $this->form_validation->set_rules('Company', 'Company', 'required');
            $this->form_validation->set_rules('Address1', 'Address1', 'required');
            $this->form_validation->set_rules('Address2', 'Address2', 'required');
            $this->form_validation->set_rules('City', 'City', 'required');
            $this->form_validation->set_rules('State', 'State', 'required');
            $this->form_validation->set_rules('Country', 'Country', 'required');
            $this->form_validation->set_rules('Zipcode', 'Zipcode', 'required');
            $this->form_validation->set_rules('User_Name', 'User_Name', 'required|is_unique[users.User_Name]');


            if ($this->form_validation->run() == false)
            {
                $notification['flash_status'] = false;
                $notification['flash_type'] = 'validation';
                $notification['flash_title']   = $this->lang->line('error_label');
                $notification['flash_message']    = $this->form_validation->error_array();
            }
            else
            {
                $password =$input['User_Password'];
                $input['User_Type'] = 'customer';
                $input['Modified_Date'] = date('Y-m-d H:i:s');
                $input['Created_Date'] = date('Y-m-d H:i:s');
                $input['User_Password'] = md5($input['User_Password']);
                $input['User_Image'] = 'dummy_user.png';
                $code = verificationcode();
                $input['Verify_Code'] = $code;

                unset($input['other_country']);
                unset($input['confirmpassword']);
            if ($this->common_model->insert_data('users', $input))
            {
            	$this->load->library('awebers');
            	$aweber = $this->awebers->init();
            	$data['user'] = $this->common_model->get_data('users',array('User_Type'=>'admin'),'single');
            	
            	//Aweber Account created 
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
					            	'cycle_day' => 0,
									  
					                # basic info
					                'name'      => $input['User_First_Name'].' '.$input['User_Last_Name'],
					            	'email'     => $input['User_Email']
						        )
							);
						}
						catch(AWeberAPIException $exc) {
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
            $notification['flash_message'] = $this->lang->line('register_success');

            }

            else{
                $notification['flash_status']  = false;
                $notification['flash_type'] = 'account';
	            $notification['flash_title']   = $this->lang->line('error_label');
	            $notification['flash_message'] = $this->lang->line('indirect_access');
            }
        }
        echo json_encode($notification); 
        }
        else{
            $data['countries'] = $this->common_model->get_data('countries', array());
            $this->load->view('register',$data);
            }
    }


    public function verify($code){

        $where = array(
                    'Verify_Code' => $code,
                );
       $input = $this->common_model->get_data('users', $where, 'single');
       if($input){

        $this->common_model->update_data("users", array('Verify_Code' => '','Is_Verified'=>'1'), array('User_Id' => $input['User_Id']));

        		//Mail to User
                $data['subject'] = $this->lang->line('customer_register_complete_subject_temp');
                $data['message'] = $this->lang->line('customer_register_complete_body_temp');
                $replaceto       = array("userfirstname__");
                $link = base_url('register/verify/'.$code);
                $replacewith     = array($input['User_First_Name'] . " " . $input['User_Last_Name']);
                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
                $view_content    = $this->load->view('email_template', $data, true);
                send_email($input['User_Email'], $data['subject'], $view_content);

            $this->load->view('include/header');
            $this->load->view('verify_success',$input);
            $this->load->view('include/footer');
   		}
       else
       {
            $this->session->set_flashdata('flash_msg',
            array('message' =>'Unable to verify account.','class' => 'danger'));
            header('Location: '.base_url());
       }
 
    }
}
