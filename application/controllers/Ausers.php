<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ausers extends MY_Controller
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
            $where         = array('Is_Deleted' => '0','Role_Id!='=>'1');
            $data['roles'] = $this->common_model->get_data('roles', $where);
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('ausers', $data);
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
            'u.User_Type'=> 'sub_admin',
            'u.Is_Deleted' => '0'
        );
        $this->load->model("datatables/Auser_list");
        $fetch_data = $this->Auser_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->User_First_Name . " " . $row->User_Last_Name;
            // if(!empty($row->User_Image))
            // {
            //     $image = image_exist('./assets/upload/users/'.$row->User_Image);
            // }
            // else
            // {
            //     $image = base_url('demo');
            // }
            // $sub_array[] = '<img style="max-width:50px;" src="'.$image.'" alt="">';
            $sub_array[] = $row->User_Email;
            $sub_array[] = @$row->User_Phone;
            $sub_array[] = $row->Role_Name;
            $sub_array[] = get_date_format($row->Created_Date);
            $buttons     = "";
            if ($this->auth->has_permission('manage-users', 'Edit'))
            {
                $buttons .= '<a type="button" title="Edit" onclick="edit_user(' . $row->User_Id . ');" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>';
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
            "recordsTotal"    => $this->Auser_list->get_all_data($where),
            "recordsFiltered" => $this->Auser_list->get_filtered_data($where),
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
                if (!empty($input['User_Id']))
                {
                    if ($this->auth->has_permission('manage-users', 'Edit'))
                    {
                        $perm_check = 1;
                    }
                }
                else
                {
                    if ($this->auth->has_permission('manage-users', 'Add'))
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
                $this->form_validation->set_rules('User_First_Name', 'First name', 'trim|required|min_length[2]|max_length[20]');
                $this->form_validation->set_rules('User_Last_Name', 'Last name', 'trim|required|min_length[2]|max_length[20]');
                if (empty($input['User_Id']))
                {
                    $this->form_validation->set_rules('User_Email', 'Email', 'trim|required|is_unique[users.User_Email]');
                }
                $this->form_validation->set_rules('User_Phone', 'Phone Number', 'trim|required|numeric');
                $this->form_validation->set_rules('Role', 'Role', 'trim|required');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status']  = false;
                    $notification['flash_title']   = $this->lang->line('error_title');
                    $errors                        = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                    if (!empty($input['User_Id']))
                    {
                        $input['Modified_Date'] = date('Y-m-d H:i:s');
                        $where                  = array('User_Id' => $input['User_Id']);
                        unset($input['User_Email']);
                        $input['User_Type'] = 'sub_admin';
                        if ($this->common_model->update_data('users', $input, $where))
                        {
                            $notification['flash_status']  = true;
                            $notification['flash_title']   = $this->lang->line('success_title');
                            $notification['flash_message'] = $this->lang->line('user_updated');
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
                        //print_r($this->lang->line('admin_registration_mail_subject'));die();
                        $password               = randomPassword();
                        $input['User_Password'] = md5($password);
                        // $input['Username'] = $input['User_First_Name'].'-1545';
                        $input['Created_Date']  = date('Y-m-d H:i:s');
                        $input['User_Type'] = 'sub_admin';
                        if ($this->common_model->insert_data('users', $input))
                        {
                            // $data['message']      = $this->lang->line('admin_registration_mail_body');
                            // $replaceto            = array("__FULL_NAME", "__EMAIL", "__USERNAME","__PASSWORD");
                            // $replacewith          = array($input['User_First_Name'] . " " . $input['User_Last_Name'] , $input['User_Email'] ,'demo',$password );
                            // $data['message']      = str_replace($replaceto, $replacewith, $data['message']);
                            // $data['link_message'] = "Click on the following link to Login";
                            // $data['link']         = base_url('login');
                            // $data['subject']      = $this->lang->line('admin_registration_mail_subject');
                            // $content              = $this->load->view('email/email_template', $data, true);
                            // send_email(EMAIL_FROM, NAME_FROM, $input['User_Email'], $data['subject'], $content);


                            $notification['flash_status']  = true;
                            $notification['flash_title']   = $this->lang->line('success_title');
                            $notification['flash_message'] = $this->lang->line('user_added');
                        }
                        else
                        {
                            $notification['flash_status']  = false;
                            $notification['flash_title']   = $this->lang->line('error_title');
                            $notification['flash_message'] = $this->lang->line('common_error');
                        }
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
        if ($this->input->post())
        {
            $input              = $this->input->post();
            $where              = array('User_Id' => $_POST['id']);
            $data['Is_Blocked'] = $input['status'];
            if ($this->common_model->update_data('users', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('user_updated');
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
    public function delete_user()
    {
        if ($this->input->post())
        {
            $input              = $this->input->post();
            $where              = array('User_Id' => $_POST['id']);
            $data['Is_Deleted'] = '1';
            if ($this->common_model->update_data('users', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('user_deleted');
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
