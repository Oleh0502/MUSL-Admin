<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->auth->is_login();
    }
    
   public function customer()
    {  
        if (isset($_POST) && !empty($_POST))
        {
            $input = $this->input->post();
            // $this->form_validation->set_rules('User_First_Name', 'User first name', 'required');
            // $this->form_validation->set_rules('User_Last_Name', 'User last name', 'required');
            // $this->form_validation->set_rules('User_Phone', 'user contact number', 'required');
            // $this->form_validation->set_rules('User_Email', 'User email', 'required|is_unique[users.User_Email]');
            // $this->form_validation->set_rules('City', 'City', 'required');


            // if ($this->form_validation->run() == false)
            // {
            //     $notification['flash_status'] = false;
            //     $notification['flash_type'] = 'validation';
            //     $notification['flash_title']   = $this->lang->line('error_label');
            //     $notification['flash_message']    = $this->form_validation->error_array();
            // }
            // else
            // {
                $password = $input['User_Password'];
                $input['User_Type'] = 'customer';
                $input['Modified_Date'] = date('Y-m-d H:i:s');
                $input['Created_Date'] = date('Y-m-d H:i:s');
                $input['User_Password'] = md5($input['User_Password']);
                $input['User_Image'] = 'dummy_user.png';
                $code = verificationcode();
                $input['Verify_Code'] = $code;

                // $device_type = $input['device_type'];
                // $device_token = $input['device_token'];
                // $token_code = randomPassword();

                // unset($input['device_type']);
                // unset($input['device_token']);

                unset($input['other_country']);
                unset($input['confirmpassword']);
            if ($this->common_model->insert_data('users', $input))
            {

                $data['user'] = $this->common_model->get_data('users',array('User_Type'=>'admin'),'single');
                $insert_id = $this->db->insert_id();

                // $insert_token = array(
                //     'user_id' => $insert_id,
                //     'token_code' => $token_code,
                //     'device_type' => $device_type,
                //     'device_token' => $device_token,
                // );
                // $this->common_model->insert_data('tokens', $insert_token);

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

                //$input['token_code'] = $token_code;
                $notification = $this->common_model->api_response(true,$this->lang->line('register_success'),$input);

            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }

}
