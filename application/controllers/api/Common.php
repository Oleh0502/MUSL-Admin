<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Common extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->auth->is_login();
    }
    //Register user Start here
    public function register()
    {  
        if (isset($_POST) && !empty($_POST))
        {
            $input = $this->input->post();
       

            if(empty($input['User_Email']) || empty($input['User_Password'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
            if($this->common_model->get_data('users', array('User_Email'=>$input['User_Email'],'Is_Verified'=>'1'), 'single')){
                $notification = $this->common_model->api_response(false,$this->lang->line('email_name_exist'));
                 echo $notification;
                 exit;
            }
          
                $password = $input['User_Password'];
                $input['Is_Verified'] = '0';
                $input['User_Type'] = 'user';
                $input['Modified_Date'] = date('Y-m-d H:i:s');
                $input['Created_Date'] = date('Y-m-d H:i:s');
                $input['User_Password'] = md5($input['User_Password']);
                //$input['User_Image'] = 'dummy_user.png';
                $code = verificationcode();
                $input['Verify_Code'] = $code;

            if ($this->common_model->insert_data('users', $input))
            {

                $data['user'] = $this->common_model->get_data('users',array('User_Type'=>'admin'),'single');
                $insert_id = $this->db->insert_id();

                $where = array(
                    'User_Email'    => $input['User_Email'],
                    'User_Password' => md5($password),
                );

                $input = $this->common_model->get_data('users', $where, 'single');
                
                
                //Mail to User
                $data['subject'] = $this->lang->line('customer_register_subject_temp');
                $data['message'] = $this->lang->line('customer_register_body_temp');
                $replaceto       = array("activationlink__");
                $link = base_url('register/verify/'.$code);
                $replacewith     = array($link);
                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
                $view_content    = $this->load->view('email_template', $data, true);
                send_email($input['User_Email'], $data['subject'], $view_content);

                //Mail to Admin
                $data['subject'] = $this->lang->line('customer_reg_subject_for_admin');
                $data['message'] = $this->lang->line('customer_reg_body_for_admin');
                $replaceto       = array("email__","mobilecontact__");
                $replacewith     = array($input['User_Email'],$input['User_Phone']);
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
    //register aoi ends here

    //Login Start here
    public function login()
    {
        if ($this->input->post())
        {
            $data = array();
            $input = $this->input->post();

            if(empty($input['device_type']) || empty($input['User_Email']) || empty($input['User_Password'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
            
                $where        = array('User_Email' => $input['User_Email'], 'User_Password' => md5($input['User_Password']));
                $User_Info    = $this->common_model->get_data('users', $where, 'single');
                if($User_Info){
                   
                   if($User_Info['Is_Deleted'] == '1'){
                        $notification = $this->common_model->api_response(false,$this->lang->line('account_delete_error'));
                   }else if($User_Info['Is_Blocked'] == '1'){
                        $notification = $this->common_model->api_response(false,$this->lang->line('account_block_error'));
                   }else if($User_Info['Is_Verified'] == '0'){
                        $notification = $this->common_model->api_response(false,$this->lang->line('account_verify_error'));
                   }else{
                        $device_type = $input['device_type'];
                        $device_token = $input['device_token'];
                        $token_code = randomPassword();

                        $insert_token = array(
                            'user_id' => $User_Info['User_Id'],
                            'token_code' => $token_code,
                            'device_type' => $device_type,
                            'device_token' => $device_token,
                            'created_on' => date('Y-m-d H:i:s')
                        );

                       

                        $this->common_model->insert_data('tokens', $insert_token);
                        $User_Info['image_url'] = base_url('assets/images/profile_pics/');

                        $User_Info['token_code'] = $token_code;
                        $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$User_Info);
                    }

                }else{
                    $notification = $this->common_model->api_response(false,'Invalid Login Credentials.');
                }
        }
        else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }
        header('Content-Type: application/json');
        echo $notification;

    }
    //Login Start here

    //Logout Start here
    public function logout()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $this->common_model->delete_data('tokens', array('token_code'=>$input['token'],'user_id'=>$input['user_id']));
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }
    //Logout Start here


    //CREATE PROFILE Starts Here
    public function create_profile()
    {  
        if (isset($_POST) && !empty($_POST))
        {
            $input = $this->input->post();
       

            if (isset($input['user_id']) && isset($input['token']))
            {
                $this->auth->auth_app_user($input['user_id'],$input['token']);
                // if(empty($input['profile_type'])){
                //      $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                //      echo $notification;
                //      exit;
                // }
                if($this->common_model->get_data('user_profiles', array('profile_type'=>$input['profile_type'],'user_id'=>$input['user_id']), 'single')){
                    $notification = $this->common_model->api_response(false,'This profile type is already exist.');
                     echo $notification;
                     exit;
                }
              
                    $input['created_by'] = $input['user_id'];
                    $input['profile_type'] = $input['profile_type'];
                    $input['modified_on'] = date('Y-m-d H:i:s');
                    $input['created_on'] = date('Y-m-d H:i:s');

                    if (!empty($_FILES['profile_pic']['name']))
                    {
                        $input['profile_pic'] = $this->upload_profilepic();
                    }
                    unset($input['token']); 
                if ($this->common_model->insert_data('user_profiles', $input))
                {
                    $insert_id = $this->db->insert_id();
                    $data['profile_details'] = $this->common_model->get_data('user_profiles',array('profile_id'=>$insert_id),'single');
                    //$input['token_code'] = $token_code;
                    $notification = $this->common_model->api_response(true,'Profile has been successfully created.',$data);

                }else{
                    $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
                }
            }else
            {
                $notification = $this->common_model->api_response(false,$this->lang->line('token_mismatched'));
            }
        }else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

            header('Content-Type: application/json');
            echo $notification;
        }
    //create profile ends here

    //Update Profile Start here
    public function update_profile()
    {  
        $input = $this->input->post();
        if(empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            
            if (!empty($_FILES['User_Image']['name']))
            {
                $input['User_Image'] = $this->upload_profilepic();
                if($input['User_Image']){
                    $user_details = $this->common_model->get_data('users', array('User_Id'=>$input['user_id']),'single');
                    $OldFileName = $user_details['User_Image'];
                    if ($user_details['User_Image'] != 'male_rep.jpg' or $user_details['User_Image'] != 'female_rep.jpg')
                    {
                        @unlink(FCPATH . "/assets/images/profile_pics/$OldFileName");
                    }
                }
            }

            if(isset($input['User_Password']) && $input['User_Password'] != ''){
                $input['User_Password'] = md5($input['User_Password']);
            }

            unset($input['token']);

            if ($this->common_model->update_data('users', $input,array('User_Id'=>$input['user_id'])))
            {
                $notification = $this->common_model->api_response(true,$this->lang->line('common_success'));
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        }else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

            header('Content-Type: application/json');
            echo $notification;
    }
    //Update Profile Ends here

    //Upload Profile Picture function starts here
    public function upload_profilepic()
    {
        $this->load->library('image_lib');
        if (!empty($_FILES['profile_pic']))
        {
            if ($_FILES['profile_pic']['error'] == 0)
            {
                $Options = 'gif|jpg|png|jpeg';
                $Path    = './assets/images/profile_pics';
                $config  = $this->common_model->set_upload_options($Path, $Options);
                if ($this->input->post('width'))
                {
                    $config['max_width'] = $this->input->post('width');
                }
                if ($this->input->post('height'))
                {
                    $config['max_height'] = $this->input->post('height');
                }
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_pic') == false)
                {
                    $error = $this->upload->display_errors();
                    if (preg_match('/dimension/i', $error))
                    {
                        echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), 'Invalid Image Size.');

                        exit;
                    }
                    if (preg_match('/filetype/', $error))
                    {
                        echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), 'Only PNG, JPG,JPEG images allowed.');

                        exit;
                    }
                    else
                    {
                        echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), $this->upload->display_errors());

                        exit;
                    }
                }
                else
                {
                    $data        = $this->upload->data();
                    $fileName    = $data['file_name'];
                    
                    /*$fileName = base_url('assets/uploads/profile_pics/' . $fileName);*/
                    $configSize2['image_library']  = 'gd2';
                    $configSize2['source_image']   = $data['full_path'];
                    $configSize2['create_thumb']   = false;
                    $configSize2['maintain_ratio'] = false;
                    $configSize2['width']          = 350;
                    $configSize2['height']         = 350;
                    $configSize2['overwrite']      = true;
                    $configSize2['new_image']      = $data['file_name'];
                    $this->image_lib->initialize($configSize2);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    return $fileName;
                }
            }
        }
    }
    //Upload Profile Picture function ends here


    //Upload Profile Private Pictures function starts here
    public function upload_private_images()
    {  
        $input = $this->input->post();
        if(empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $this->load->library('image_lib');
            if (!empty($_FILES['private_image']))
            {
                if ($_FILES['private_image']['error'] == 0)
                {
                    $Options = 'gif|jpg|png|jpeg';
                    $Path    = './assets/images/private_pics';
                    $config  = $this->common_model->set_upload_options($Path, $Options);
                    if ($this->input->post('width'))
                    {
                        $config['max_width'] = $this->input->post('width');
                    }
                    if ($this->input->post('height'))
                    {
                        $config['max_height'] = $this->input->post('height');
                    }
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('private_image') == false)
                    {
                        $error = $this->upload->display_errors();
                        if (preg_match('/dimension/i', $error))
                        {
                            echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), 'Invalid Image Size.');

                            exit;
                        }
                        if (preg_match('/filetype/', $error))
                        {
                            echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), 'Only PNG, JPG,JPEG images allowed.');

                            exit;
                        }
                        else
                        {
                            echo $this->common_model->AjaxFlashMessage(false, $this->lang->line('error_title'), $this->upload->display_errors());

                            exit;
                        }
                    }
                    else
                    {
                        $data        = $this->upload->data();
                        $fileName    = $data['file_name'];
                        $insert_data = array(
                            'profile_id' => $input['profile_id'],
                            'private_pic_name' => $fileName,
                            'created_on' => date('Y-m-d H:i:s'),
                            'created_by' => $input['user_id'],
                        );
                        $this->common_model->insert_data('private_pics', $insert_data);
                        $insert_data['private_pic_id'] = $this->db->insert_id();
                        $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$insert_data);
                    }
                }
            }
        }else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }
    //Upload Profile Private Pictures function starts here

    //remove Private Picture function starts here
    public function remove_private_image()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

            $pic_details = $this->common_model->get_data('private_pics', array('private_pic_id'=>$input['private_pic_id']),'single');
            $OldFileName = $pic_details['private_pic_name'];

            if($this->common_model->delete_data('private_pics', array('private_pic_id'=>$input['private_pic_id']))){
                @unlink(FCPATH . "/assets/images/private_image/$OldFileName");
            }
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }
    //Upload Private Picture function ends here

    //Forgot password api start here
    public function forgot_password()
    {
        if ($this->input->post())
        {
            $data = array();
            $input = $this->input->post();

            if(empty($input['User_Email'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
            
                $where        = array('User_Email' => $input['User_Email']);
                $User_Info    = $this->common_model->get_data('users', $where, 'single');
                if($User_Info){
                    
                    $token_code = $User_Info['User_Id'].randomPassword();


                    //Mail to User
                    $data['subject'] = $this->lang->line('forgot_password_subject_temp');
                    $data['message'] = $this->lang->line('forgot_password_body_temp');
                    $replaceto       = array("resetlink__");
                    $link = base_url('register/forgot_pass/'.$token_code);
                    $replacewith     = array($link);
                    $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
                    $view_content    = $this->load->view('email_template', $data, true);
                    send_email($User_Info['User_Email'], $data['subject'], $view_content);

                    $this->common_model->update_data('users', array('Verify_Code'=>$token_code),array('User_Id'=>$User_Info['User_Id']));
                    $notification = $this->common_model->api_response(true,'Reset password email has been successfully sent.');
                }else{
                    $notification = $this->common_model->api_response(false,'This email is not assosiate with any account.');
                }
        }
        else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }
        header('Content-Type: application/json');
        echo $notification;
    }
    //Forgot password api ends here

    //Get dashboard profiles Function Start here
    public function get_dashboard_profile_list()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where                = array('is_blocked' => "0", 'is_blocked' => "0");
            $data['user_profiles'] = $this->common_model->get_data('user_profiles', $where);
            if($data['user_profiles']){
                foreach ($data['user_profiles'] as $key => $value) {
                   $where = array('to_id' => $value['profile_id'], 'is_checked' => "0");
                   $data['user_profiles'][$key]['notification_count'] = $this->common_model->CountByCondition('notifications', $where);

                   $where = array('message_to' => $value['profile_id'], 'FIND_IN_SET("' . $value['profile_id'] . '",read_by)!=' => '0');
                   $data['user_profiles'][$key]['message_count'] = $this->common_model->CountByCondition('messages', $where);
                }
            }
            if (!empty($data)) {
               $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            } else {
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }
            header('Content-Type: application/json');
            echo $notification;
    }
    //Get dashboard  profiles Function Ends here

    //Get profile edit data
    public function get_profile_edit_data()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            if(empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where = array('is_blocked' => "0", 'is_blocked' => "0", 'profile_id'=>$_POST['profile_id']);
            $data['profile_details'] = $this->common_model->get_data('user_profiles', $where,'single');
            $data['profile_pic_url'] = base_url('assets/images/profile_pics/');
            $data['private_pics'] = $this->common_model->get_data('private_pics', array('profile_id'=>$_POST['profile_id']));
            $data['private_pic_url'] = base_url('assets/images/private_pics/');
            $data['options'] = $this->common_model->get_data('profile_options', array('is_deleted'=>'0'));
            
            if (!empty($data)) {
                $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            } else {
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        } else {
            $notification = $this->common_model->api_response(false,$this->lang->line('token_mismatched'));
        }
        header('Content-Type: application/json');
        echo $notification;
    }

}
