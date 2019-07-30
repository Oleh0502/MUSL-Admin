<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_counters()
    {
        $this->auth->is_login();
        $data['notifications']  = $this->common_model->unread_notification_counter($this->session->userdata('User_Id'));
        $data['webinar_count'] = $this->common_model->CountByCondition('webinars', array('DATE(Webinar_Start_Date) >='=>Date('Y-m-d'),'Is_Deleted'=>'0','Is_Blocked'=>'0'));
        echo json_encode($data);
    }

}
