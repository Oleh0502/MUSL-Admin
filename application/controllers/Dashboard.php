<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
	public function index()
	{
    if($_SESSION['User_Type'] == 'admin'){
		$data['notification'] = $this->db->select('*')->from('notifications')->order_by('Noti_Id','desc')->limit(5)->get()->result_array();
  }else if($_SESSION['User_Type'] == 'customer'){
    $data['notification'] = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->order_by('Assign_Id','desc')->limit(5)->get()->result_array();
  }
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('dashboard',$data);
		$this->load->view('include/footer');
	}



    /*function check template slug*/

    public function template_slug(){
        if (isset($_POST['slug']) && isset($_POST['slug_type'])){
            if($_POST['slug_type']=='0'){
                 $data = $this->common_model->get_data('template_data', array('Template_Data_Link' =>$_POST['slug']));
                  if(!empty($data)){
                    echo '1';
                  }else{
                    echo '0';
                  } 
              }else if($_POST['slug_type']=='1'){
                  $data = $this->common_model->get_data('template_data', array('Template_Data_Id !=' => $_POST['templateid'])); 
                  $check='0'; 
                  //print_r($data);
                  foreach ($data as $key => $value) {                        
                        if($value['Template_Data_Link'] == $_POST['slug']){
                            $check='1';
                        }
                    
                  }               
                  echo $check;
              }
        }
    }
    

	 public function change_task_status()
        {
        if ($this->input->post()) {
            $input              = $this->input->post();
            $where              = array('Task_Id' => $_POST['id']);
            $data['Status'] = $input['status'];
            if ($this->common_model->update_data('tasks', $data, $where)) {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_label');
                $notification['flash_message'] = $this->lang->line('task_updated');
            } else {
                $notification['flash_status']  = false;
                $notification['flash_title']   = $this->lang->line('success_label');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        } else {
            $notification['flash_status']  = false;
            $notification['flash_title']   = $this->lang->line('success_label');
            $notification['flash_message'] = $this->lang->line('common_error');
        }
        header('Content-Type: application/json');
        exit(json_encode($notification));
    }

}
