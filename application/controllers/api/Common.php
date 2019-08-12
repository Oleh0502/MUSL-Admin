<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Common extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->auth->is_login();
    }
    
    //Get Categories Function Start here
    public function get_event_types()
    {
        //if (isset($_POST['id']) && !empty($_POST['id'])) {
            $where                = array('Is_Deleted' => "0", 'Is_Blocked' => "0");
            $data['event_types'] = $this->common_model->get_data('categories', $where);
            $data['cities'] = $this->common_model->get_data('cities', $where);
            if (!empty($data)) {
               $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            } else {
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        // } else {
        //     $notification['flash_status']  = false;
        //     $notification['flash_title']   = $this->lang->line('error_title');
        //     $notification['flash_message'] = $this->lang->line('common_error');
        // }
        header('Content-Type: application/json');
        echo $notification;
    }
    //Get Categories Function Ends here

    //Get Items Function Starts here
    public function get_items()
    {
        $where = array('Is_Deleted' => "0", 'Is_Blocked' => "0");
        
        if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
            $where['Category_Id'] =  $_POST['category_id'];
        }

            $categories = $this->common_model->get_data('categories', $where,'single');
            $data['items'] = $this->common_model->get_where_in('items', 'Item_Id', explode(',',$categories['Items']), array('Is_Deleted' => "0", 'Is_Blocked' => "0"));
            if (!empty($data)) {
                $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            } else {
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        // } else {
        //     $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        // }
        header('Content-Type: application/json');
        echo $notification;
    }
    //Get Items Function Ends here


    public function get_cities()
    {
            $where                = array('Is_Deleted' => "0", 'Is_Blocked' => "0");
            $data['cities'] = $this->common_model->get_data('cities', $where);
            if (!empty($data)) {
               $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            } else {
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
        
        header('Content-Type: application/json');
        echo $notification;
    }

    public function customer_signup()
    {  
        if (isset($_POST) && !empty($_POST))
        {
            $input = $this->input->post();
       

            if(empty($input['User_First_Name'])  || empty($input['User_Phone']) || empty($input['User_Email']) || empty($input['City']) || empty($input['User_Password'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
            if($this->common_model->get_data('users', array('User_Email'=>$input['User_Email'],'Is_Verified'=>'1'), 'single')){
                $notification = $this->common_model->api_response(false,$this->lang->line('email_name_exist'));
                 echo $notification;
                 exit;
            }
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
                $input['Is_Verified'] = '1';
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


    public function add_event()
    {  
        $input = $this->input->post();

        if(empty($input['event_name']) || empty($input['event_type']) || empty($input['user_id'])  || empty($input['event_date']) || empty($input['event_city']) || empty($input['event_budget']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

                $insert_data = array(
                    'event_name' => $input['event_name'],
                    'event_type' => $input['event_type'],
                    'user_id' => $input['user_id'],
                    'event_date' => date('Y-m-d H:i:s',  strtotime($input['event_date'])),
                    'event_city' => $input['event_city'],
                    'event_budget' => $input['event_budget'],
                    'created_on' => date('Y-m-d H:i:s')
                );

            if(isset($input['event_id'])){
                $result = $this->common_model->update_data('events', $insert_data,array('event_id'=>$input['event_id']));
            }else{
                $result = $this->common_model->insert_data('events', $insert_data);
            }
            if ($result)
            {
                if(isset($input['event_id'])){
                    $insert_id = $input['event_id'];
                    $this->common_model->delete_data('event_items', array('event_id'=>$input['event_id']));
                }else{
                    $insert_id = $this->db->insert_id();
                }

                foreach (json_decode($input['item_id']) as $key => $value) {
                    $insert_data = array(
                        'event_id' => $insert_id,
                        'item_id' => $value,
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    $this->common_model->insert_data('event_items', $insert_data);
                }

                $where = array(
                    'event_id'    => $insert_id,
                );
                $data['event_details'] = $this->common_model->get_data('events', $where, 'single');
                $data['event_items'] = $this->common_model->get_data('event_items', $where);
                
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'),$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }

    public function add_event_items()
    {  
        $input = $this->input->post();

        if(empty($input['event_id']) || empty($input['item_id']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

            if(!empty($input['item_id'])){
                foreach (json_decode($input['item_id']) as $key => $value) {
                    $insert_data = array(
                        'event_id' => $input['event_id'],
                        'item_id' => $value,
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    $this->common_model->insert_data('event_items', $insert_data);
                }

                $where = array(
                    'event_id'    => $input['event_id'],
                );
                $data['event_details'] = $this->common_model->get_data('events', $where, 'single');
                $data['event_items'] = $this->common_model->get_data('event_items', $where);
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'),$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }


    public function update_device_token()
    {  
        $input = $this->input->post();


        if(empty($input['device_token']) || empty($input['device_type']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
                $insert_data = array(
                    'device_token' => $input['device_token'],
                    'device_type' => $input['device_type'],
                );
            if ($this->common_model->update_data('tokens', $insert_data,array('user_id'=>$input['user_id'],'token_code'=>$input['token'])))
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


    public function get_user_events()
    {  
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);


            $data['events'] =  $this->db->select('e.*,ca.Category_Name,ci.City_Name')->from('events as e')->join('cities as ci','ci.City_Id = e.event_city','left')->join('categories as ca','ca.Category_Id = e.event_type','left')->where(array('e.user_id'=>$input['user_id'],'e.is_deleted' => '0'))->get()->result_array();

            if($data['events']){
                foreach ($data['events'] as $key => $value)
                {
                    $data['events'][$key]['event_items'] = $this->db->select('ei.*,i.Item_Title,sup.Company,ca.Category_Name,ci.City_Name')->from('event_items as ei')->join('items as i','i.item_id = ei.item_id','left')->join('cities as ci','ci.City_Id = "'.$value['event_city'].'"','left')->join('categories as ca','ca.Category_Id = "'.$value['event_type'].'"','left')->join('users as sup','sup.user_id = ei.supplier_id','left')->where(array('event_id'=>$value['event_id']))->get()->result_array();
                }
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

    public function organizer_data()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            
            $data['event_items'] = $this->db->select('ei.*,i.Item_Title,sup.Company,sup.Address1')->from('event_items as ei')->join('items as i','i.item_id = ei.item_id','left')->join('users as sup','sup.user_id = ei.supplier_id','left')->where(array('event_id'=>$input['event_id']))->get()->result_array();
                
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }


    public function supplier_categories()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where = array('Is_Deleted' => "0", 'Is_Blocked' => "0");
            $data['categories'] = $this->common_model->get_data('items', $where);
            $data['image_url'] = base_url('assets/images/category_images/');
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }

    public function get_supplier_by_categories()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            
            $where = array('u.Is_Deleted' => "0", 'u.Is_Blocked' => "0",'u.Is_Verified' => '1','u.Business_Category'=>$input['business_category']);

            if(isset($input['event_id'])){
                $data['event_details'] = $this->common_model->get_data('events',array('event_id'=>$input['event_id']),'single');
                $where['u.City'] = $data['event_details']['event_city'];
            }
            //$suppliers = $this->common_model->get_data('users', $where);

            $suppliers =  $this->db->select('u.*,i.Item_Title,ci.City_Name')->from('users as u')->join('cities as ci','ci.City_Id = u.City','left')->join('items as i','i.Item_Id = u.Business_Category','left')->where($where)->get()->result_array();

            if($suppliers){
                $data['supplier'] = $suppliers;
            }else{
                $data['supplier'] =  array();
            }
            if($suppliers){
                foreach ($data['supplier'] as $key => $value) {
                    $data['supplier'][$key]['rating'] = $this->common_model->select_data('AVG(rating) as average','ratings', array('rating_to'=>$value['User_Id']),'single')['average'];
                    // $data['supplier'][$key]['city_name'] = $this->common_model->select_data('City_Name','cities', array('City_Id'=>$value['City']),'single')['City_Name'];
                    if(isset($input['event_id'])){
                        $is_available = $this->common_model->get_data('supplier_calendar',array('supplier_id'=>$value['User_Id'],'DATE(booked_date)'=>date('Y-m-d', strtotime($data['event_details']['event_date']))),'single');
                        $data['supplier'][$key]['is_available'] = $is_available? 'no':'yes';
                    }
                }
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


    public function get_supplier_page_data()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where = array('u.Is_Deleted' => "0", 'u.Is_Blocked' => "0",'u.Is_Verified' => '1','u.User_Id'=>$input['supplier_id']);
            $data['supplier'] = $this->db->select('u.*,i.Item_Title,ci.City_Name')->from('users as u')->join('cities as ci','ci.City_Id = u.City','left')->join('items as i','i.Item_Id = u.Business_Category','left')->where($where)->get()->result_array();
            
            $data['supplier']['rating'] = $this->common_model->select_data('AVG(rating) as average','ratings', array('rating_to'=>$input['supplier_id']),'single')['average'];
            
            $data['supplier']['booked_dates'] = $this->common_model->get_data('supplier_calendar',array('supplier_id'=>$input['supplier_id'],'DATE(booked_date)>='=>date('Y-m-d')));

            $images = $this->common_model->get_data('supplier_images',array('supplier_id'=>$input['supplier_id']));
            $data['images_url'] = base_url('assets/images/supplier_images/');
            $data['supplier']['images'] = $images? $images:array();

            if(isset($input['event_id'])){
                $data['event_details'] = $this->common_model->get_data('events',array('event_id'=>$input['event_id']),'single');
                $is_available = $this->common_model->get_data('supplier_calendar',array('supplier_id'=>$input['supplier_id'],'DATE(booked_date)'=>date('Y-m-d', strtotime($data['event_details']['event_date']))),'single');
                $data['supplier']['is_available'] = $is_available? 'no':'yes';
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


    public function update_event_note()
    {  
        $input = $this->input->post();


        if(empty($input['event_id']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
                $insert_data = array(
                    'event_note' => $input['event_note'],
                );
            if ($this->common_model->update_data('events', $insert_data,array('event_id'=>$input['event_id'])))
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


    public function get_event_note()
    {  
        $input = $this->input->post();


        if(empty($input['event_id']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $data['event_details'] = $this->common_model->get_data('events', array('event_id'=>$input['event_id']),'single');
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
            
        }else{
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

            header('Content-Type: application/json');
            echo $notification;
    }

    public function add_schedule()
    {  
        $input = $this->input->post();

        if(empty($input['schedule_title']) || empty($input['schedule_date']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

                $insert_data = array(
                    'schedule_title' => $input['schedule_title'],
                    'user_id' => $input['user_id'],
                    'schedule' => date('Y-m-d H:i:s',  strtotime($input['schedule_date'])),
                    'created_on' => date('Y-m-d H:i:s')
                );

            if(isset($input['schedule_id'])){
                $result = $this->common_model->update_data('schedule', $insert_data,array('schedule_id'=>$input['schedule_id']));
            }else{
                $result = $this->common_model->insert_data('schedule', $insert_data);
            }
            if ($result)
            {
                if(isset($input['schedule_id'])){
                    $insert_id = $input['schedule_id'];
                }else{
                    $insert_id = $this->db->insert_id();
                }
                
                $where = array(
                    'schedule_id'    => $insert_id,
                );
                $data['schedule_details'] = $this->common_model->get_data('schedule', $where, 'single');
                
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'),$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
    }

    public function get_schedule_list()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where = array('is_deleted' => "0", 'user_id' => $input['user_id'],'DATE(schedule_date)>='=>date('Y-m-d'));
            $data['schedule_list'] = $this->common_model->get_data('schedule', $where,'','asc','','','schedule_date');
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }

    public function remove_schedule()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $this->common_model->delete_data('schedule_list', array('schedule_id'=>$input['schedule_id'],'user_id'=>$input['user_id']));
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }


     public function add_cart_items()
    {  
        $input = $this->input->post();

        if(empty($input['event_id']) || empty($input['items']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

            if(!empty($input['items'])){
                foreach (json_decode($input['items'],true) as $key => $value) {
                    $supplier = $this->common_model->get_data('users', array('User_Id'=>$value['supplier_id']),'single');
                    $insert_data = array(
                        'event_id' => $input['event_id'],
                        'item_id' => $value['item_id'],
                        'supplier_id' => $value['supplier_id'],
                        'user_id' => $input['user_id'],
                        'amount' => $supplier['Price'],
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    $check_item = $this->common_model->get_data('carts', array('item_id'=>$value['item_id'],'user_id'=>$input['user_id'], 'event_id'=>$input['event_id']),'single');
                    if($check_item){
                        $this->common_model->delete_data('carts', array('cart_id'=>$check_item['cart_id']));
                    }
                    $this->common_model->insert_data('carts', $insert_data);
                }

                $where = array(
                    'c.user_id'    => $input['user_id'],
                );
                $data['cart_items'] = $this->db->select('c.*,i.Item_Title,sup.Company')->from('carts as c')->join('items as i','i.item_id = c.item_id','left')->join('users as sup','sup.user_id = c.supplier_id','left')->where($where)->get()->result_array();
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'),$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }


    public function get_cart_list()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $where = array('c.user_id' => $input['user_id'], 'c.event_id' => $input['event_id']);
            $data['cart_items'] = $this->db->select('c.*,i.Item_Title,sup.Company,sup.User_Image,sup.Address1')->from('carts as c')->join('items as i','i.item_id = c.item_id','left')->join('users as sup','sup.user_id = c.supplier_id','left')->where($where)->get()->result_array();
            $data['image_url'] = base_url('assets/images/category_images/');
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }

    public function remove_item_from_cart()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $this->common_model->delete_data('carts', array('cart_id'=>$input['cart_id']));
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }


    public function checkout()
    {  
        $input = $this->input->post();

        if(empty($input['event_id']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }

        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $cart = $this->common_model->get_data('carts', array('user_id'=>$input['user_id'],'event_id'=>$input['event_id']));
            $event_items = $this->common_model->get_data('event_items', array('user_id'=>$input['user_id'],'event_id'=>$input['event_id']));
            if(!empty($cart)){

                $cart_items = array();
                $event_items = array();
                //Check cart data
                foreach ($cart as $key => $value) {
                  array_push($cart_items, $value['item_id']);
                }
                foreach ($event_items as $key => $value) {
                  array_push($event_items, $value['item_id']);
                }

                $result = array_diff($cart_items,$event_items);
                if(!empty($result)){
                    $notification = $this->common_model->api_response(false,'Please select supplier for all event items first.');
                    echo $notification;
                    exit;
                }
                foreach ($cart as $key => $value) {
                    $supplier = $this->common_model->get_data('users', array('User_Id'=>$value['supplier_id']),'single');
                    $this->common_model->update_data('event_items', array('total_installments'=>$supplier['Total_Installments'],'supplier_id'=>$value['supplier_id']),array('event_id'=>$input['event_id'],'item_id'=>$value['item_id']));
                }

                $this->common_model->update_data('events', array('status'=>'1'),array('event_id'=>$input['event_id']));

                $this->common_model->delete_data('carts', array('event_id'=>$input['event_id']));

                $notification = $this->common_model->api_response(true,'Order has been successfully placed.',$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }


    public function add_supplier_unavailable_day()
    {  
        $input = $this->input->post();

        if(empty($input['booked_date']) || empty($input['user_id']) || empty($input['token'])){
                 $notification = $this->common_model->api_response(false,$this->lang->line('common_error_parameters'));
                 echo $notification;
                 exit;
            }
        if (isset($input['user_id']) && isset($input['token']) )
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);

                $insert_data = array(
                    'supplier_id' => $input['user_id'],
                    'booked_date' => date('Y-m-d H:i:s',  strtotime($input['booked_date'])),
                    'created_on' => date('Y-m-d H:i:s'),
                    'is_deleted' => '0'
                );

            
            $result = $this->common_model->insert_data('supplier_calendar', $insert_data);
            if ($result)
            {
                if(isset($input['schedule_id'])){
                    $insert_id = $input['schedule_id'];
                }else{
                    $insert_id = $this->db->insert_id();
                }
                
                $where = array(
                    'calender_id'    => $insert_id,
                );
                $data['details'] = $this->common_model->get_data('supplier_calendar', $where, 'single');
                
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'),$data);
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }
            }else{
                $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
            }

            header('Content-Type: application/json');
            echo $notification;
        }

    public function remove_supplier_unavailable_day()
    {
        $input = $this->input->post();
        if (isset($input['user_id']) && isset($input['token']))
        {
            $this->auth->auth_app_user($input['user_id'],$input['token']);
            $this->common_model->delete_data('supplier_calendar', array('calender_id'=>$input['calender_id'],'supplier_id'=>$input['user_id']));
            $notification = $this->common_model->api_response(true,$this->lang->line('common_success'),$data);
        }
        else
        {
            $notification = $this->common_model->api_response(false,$this->lang->line('common_error'));
        }

        header('Content-Type: application/json');
        echo $notification;
    }

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


    public function upload_profilepic()
    {
        $this->load->library('image_lib');
        if (!empty($_FILES['User_Image']))
        {
            if ($_FILES['User_Image']['error'] == 0)
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
                if ($this->upload->do_upload('User_Image') == false)
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




    public function upload_gallary_images()
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


            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['images']['name']= $files['images']['name'][$i];
                $_FILES['images']['type']= $files['images']['type'][$i];
                $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['images']['error']= $files['images']['error'][$i];
                $_FILES['images']['size']= $files['images']['size'][$i];    

                $config = array();
                $config['upload_path'] = './assets/images/supplier_images';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '0';
                $config['overwrite']     = FALSE;

                $this->upload->initialize($config);
                $this->upload->do_upload('images');
                $dataInfo[] = $this->upload->data();
            }


            if(!empty($dataInfo)){
                foreach ($dataInfo as $key => $value) {
                    
                    $insert_data = array(
                        'image_name' => $value['file_name'],
                        'supplier_id' => $input['user_id'],
                        'created_on' => date('Y-m-d H:i:s'),
                    );

                    $this->common_model->insert_data('supplier_images', $insert_data);
                }

                // $data['cart_items'] = $this->db->select('c.*,i.Item_Title,sup.Company')->from('carts as c')->join('items as i','i.item_id = c.item_id','left')->join('users as sup','sup.user_id = c.supplier_id','left')->where($where)->get()->result_array();
                $notification = $this->common_model->api_response(true,$this->lang->line('event_added_success'));
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
