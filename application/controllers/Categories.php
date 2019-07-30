<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    //Index Fnction Start here
    public function index()
    {
        if ($this->auth->has_permission('manage-category'))
        {
            $data['items'] = $this->common_model->get_data('items', array('Is_Blocked'=>'0'));
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('categories',$data);
            $this->load->view('include/footer');
        }
        else
        {
            redirect('','refresh');
        }
    }
    //fetch user list here
    public function fetch_tags()
    {
        $where = array(
            'Is_Deleted' => '0'
        );
        $this->load->model("datatables/Category_list");
        $fetch_data = $this->Category_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->Category_Name;
            $sub_array[] = get_formatted_items($this->common_model->select_where_in('items', 'Item_Id', explode(',', $row->Items)));
            // if(!empty($row->User_Image))
            // {
            //     $image = image_exist('./assets/upload/users/'.$row->User_Image);
            // }
            // else
            // {
            //     $image = base_url('demo');
            // }
            // $sub_array[] = '<img style="max-width:50px;" src="'.$image.'" alt="">';
            $sub_array[] = get_date_format($row->Created_On);
            $sub_array[] =get_date_format($row->Modified_On);
            $buttons     = "";
            if ($this->auth->has_permission('manage-category', 'Edit'))
            {
                $buttons .= '<a type="button" title="Edit" onclick="edit_user(' . $row->Category_Id . ');" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>';
            }
            if ($this->auth->has_permission('manage-category', 'Delete'))
            {
                if ($row->Is_Blocked == 1)
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('category_activate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Activate_label').'" onclick=activate_account(' . $row->Category_Id . ',"0","'.$msg.'"); class="btn btn-icon-only yellow"><i class="fa fa-times-circle"></i></a>';
                }
                else
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('category_deactivate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Deactivate_label').'" onclick=activate_account(' . $row->Category_Id . ',"1","'.$msg.'"); class="btn btn-icon-only purple"><i class="fa fa-check"></i></a>';
                }
            }
            if ($this->auth->has_permission('manage-category', 'Perm_Delete'))
            {
                $msg = preg_replace('/\s+/', '_', $this->lang->line('tag_delete_title'));

                $buttons .= '<a type="button" title="'.$this->lang->line('Delete_title').'" onclick=perm_delete(' . $row->Category_Id . ',"'.$msg.'"); class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';
            }
            $sub_array[] = $buttons;
            $data[]      = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST["draw"]),
            "recordsTotal"    => $this->Category_list->get_all_data($where),
            "recordsFiltered" => $this->Category_list->get_filtered_data($where),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    //Add user Function start here
    public function add_tag()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if (!empty($input['Category_Id']))
                {
                    if ($this->auth->has_permission('manage-category', 'Edit'))
                    {
                        $perm_check = 1;
                    }
                }
                else
                {
                    if ($this->auth->has_permission('manage-category', 'Add'))
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
                $this->form_validation->set_rules('Category_Name', 'Tag name', 'trim|required|min_length[2]|max_length[20]');
                
                if (empty($input['Category_Id']))
                {
                    $this->form_validation->set_rules('Category_Name', 'Tag Name', 'trim|required|is_unique[tags.Tag_Name]');
                }
                
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status']  = false;
                    $notification['flash_title']   = $this->lang->line('error_title');
                    $errors                        = $this->form_validation->single_error();
                    $notification['flash_message'] = $errors;
                }
                else
                {
                    $input['Items'] = implode(',', $input['Items']);     
                    if (!empty($input['Category_Id']))
                    {
                        $input['Modified_On'] = date('Y-m-d H:i:s');
                        $where                  = array('Category_Id' => $input['Category_Id']);
                        unset($input['User_Email']);
                        if ($this->common_model->update_data('categories', $input, $where))
                        {
                            $notification['flash_status']  = true;
                            $notification['flash_title']   = $this->lang->line('success_title');
                            $notification['flash_message'] = $this->lang->line('category_updated');
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
                        $input['Created_On']  = date('Y-m-d H:i:s');
                        if ($this->common_model->insert_data('categories', $input))
                        {
                            $notification['flash_status']  = true;
                            $notification['flash_title']   = $this->lang->line('success_title');
                            $notification['flash_message'] = $this->lang->line('category_added');
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
    public function get_tag()
    {
        if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $where                = array('Category_Id' => $_POST['id']);
            $notification['data'] = $this->common_model->get_data('categories', $where, 'single');
            $notification['data']['Items'] = explode(',', $notification['data']['Items']);
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
            $where              = array('Category_Id' => $_POST['id']);
            $data['Is_Blocked'] = $input['status'];
            if ($this->common_model->update_data('Categories', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('category_updated');
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
            $where              = array('Category_Id' => $_POST['id']);
            $data['Is_Deleted'] = '1';
            if ($this->common_model->update_data('categories', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('category_deleted');
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
