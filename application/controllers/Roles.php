<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Roles extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    //Index Fnction Start here
    public function index()
    {
        if ($this->auth->has_permission('manage-roles'))
        {
            $where               = array('Perm_Id!=' => '0');
            $data['permissions'] = $this->common_model->get_data('permissions', $where);
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('roles', $data);
            $this->load->view('include/footer');
        }
        else
        {
            redirect('', 'refresh');
        }
    }
    //fetch user list here
    public function fetch_roles()
    {
        $where = array(
            'Role_Id!=' => '1',
        );
        $this->load->model("datatables/Role_list");
        $fetch_data = $this->Role_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->Role_Name;
            $sub_array[] = get_date_format($row->Created_Date);
            $sub_array[] = get_date_format($row->Modified_Date);
            $buttons     = "";
            if ($this->auth->has_permission('manage-roles', 'Edit'))
            {
                $buttons .= '
				<a href="javascript:;" onclick="edit_role(' . $row->Role_Id . ');" class="btn btn-icon-only blue" title="Edit">
	                <i class="fa fa-edit"></i>
	            </a>
				';
            }
            // if ($this->auth->has_permission('manage-roles', 'Delete'))
            // {
            //     if ($row->Is_Deleted == 1)
            //     {
            //         $buttons .= '<a type="button" title="' . $this->lang->line('ac_msg') . '" onclick=activate_role(' . $row->Role_Id . ',"0","' . $this->lang->line('ac_msg') . '"); class="tb_checkicon hover_class fa_custom"><i class="fa fa-times-circle"></i></a>';
            //     }
            //     else
            //     {
            //         $buttons .= '<a type="button" title="' . $this->lang->line('de_msg') . '" onclick=activate_role(' . $row->Role_Id . ',"1","' . $this->lang->line('de_msg') . '"); class="tb_delicon hover_class fa_custom"><i class="fa fa-check"></i></a>';
            //     }
            // }
            if ($this->auth->has_permission('manage-roles', 'Perm_Delete'))
            {
                if($this->check_used($row->Role_Id))
                {
                    $buttons .= '<a type="button" title="Delete" onclick="perm_delete(' . $row->Role_Id . ');" class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';    
                }
            }
            $sub_array[] = $buttons;
            $data[]      = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST["draw"]),
            "recordsTotal"    => $this->Role_list->get_all_data($where),
            "recordsFiltered" => $this->Role_list->get_filtered_data($where),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function check_used($Role)
    {
        $sql = $this->db->where('Role',$Role)->get('users');
        if($sql->num_rows()<=0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Add user Function start here
    public function add_role()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post())
            {
                $input      = $this->input->post();
                $perm_check = 0;
                if (!empty($input['Role_Id']))
                {
                    if ($this->auth->has_permission('manage-roles', 'Edit'))
                    {
                        $perm_check = 1;
                    }
                }
                else
                {
                    if ($this->auth->has_permission('manage-roles', 'Add'))
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
                $this->form_validation->set_rules('Role_Name', 'Role title', 'trim|required|min_length[2]|max_length[20]');
                if ($this->form_validation->run() == false)
                {
                    $notification['flash_status']  = false;
                    $notification['flash_title']   = $this->lang->line('error_title');
                    $errors                        = $this->form_validation->_error_array;
                    $notification['flash_message'] = array_values($errors)[0];
                }
                else
                {
                    if (!empty($input['Role_Id']))
                    {
                        $where = array('Role_Name' => $input['Role_Name'], 'Role_Id!=' => $input['Role_Id']);
                    }
                    else
                    {
                        $where = array('Role_Name' => $input['Role_Name']);
                    }
                    if ($this->common_model->check_data('roles', $where))
                    {
                        if (!empty($input['Role_Id']))
                        {
                            $insert['Role_Name']     = $input['Role_Name'];
                            $insert['Modified_Date'] = date('Y-m-d H:i:s');
                            $query_status            = $this->common_model->update_data('roles', $insert, array('Role_Id' => $input['Role_Id']));
                            $Role_Id                 = $input['Role_Id'];
                        }
                        else
                        {
                            $insert['Role_Name']    = $input['Role_Name'];
                            $insert['Created_Date'] = date('Y-m-d H:i:s');
                            $query_status           = $this->common_model->insert_data('roles', $insert);
                            $Role_Id                = $this->db->insert_id();
                        }
                        if ($query_status)
                        {
                            $permissions = @$input['perm_id'];
                            $add         = @$input['add'];
                            $edit        = @$input['edit'];
                            $view        = @$input['view'];
                            $delete      = @$input['delete'];
                            $perm_delete = @$input['perm_delete'];
                            if (!empty($permissions))
                            {
                                if (!empty($input['Role_Id']))
                                {
                                    $this->common_model->delete_data('role_perm', array('Role_Id' => $Role_Id));
                                }
                                foreach ($permissions as $perm)
                                {
                                    $perm_insert            = array();
                                    $perm_insert['Role_Id'] = $Role_Id;
                                    $perm_insert['Perm_Id'] = $perm;
                                    if ($this->common_model->check_data('role_perm', $perm_insert))
                                    {
                                        if (!empty($add[$perm]))
                                        {
                                            $perm_insert['Add'] = '1';
                                        }
                                        else
                                        {
                                            $perm_insert['Add'] = '0';
                                        }
                                        if (!empty($edit[$perm]))
                                        {
                                            $perm_insert['Edit'] = '1';
                                        }
                                        else
                                        {
                                            $perm_insert['Edit'] = '0';
                                        }
                                        if (!empty($view[$perm]))
                                        {
                                            $perm_insert['View'] = '1';
                                        }
                                        else
                                        {
                                            $perm_insert['View'] = '0';
                                        }
                                        if (!empty($delete[$perm]))
                                        {
                                            $perm_insert['Delete'] = '1';
                                        }
                                        else
                                        {
                                            $perm_insert['Delete'] = '0';
                                        }
                                        if (!empty($perm_delete[$perm]))
                                        {
                                            $perm_insert['Perm_Delete'] = '1';
                                        }
                                        else
                                        {
                                            $perm_insert['Perm_Delete'] = '0';
                                        }
                                        $this->common_model->insert_data('role_perm', $perm_insert);
                                    }
                                }
                                $notification['flash_status'] = true;
                                $notification['flash_title']  = $this->lang->line('success_title');
                                if (!empty($input['Role_Id']))
                                {
                                    $notification['flash_message'] = $this->lang->line('role_updated');
                                }
                                else
                                {
                                    $notification['flash_message'] = $this->lang->line('role_added');
                                }
                            }
                            else
                            {
                                $where_del = array('Role_Id' => $Role_Id);
                                $this->common_model->delete_data('roles', $where_del);
                                $notification['flash_status']  = false;
                                $notification['flash_title']   = $this->lang->line('error_title');
                                $notification['flash_message'] = $this->lang->line('permission_empty');
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
                        $notification['flash_message'] = $this->lang->line('role_name_unique');
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
    public function get_role()
    {
        if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $where                = array('Role_Id' => $_POST['id']);
            $notification['data'] = $this->common_model->get_data('roles', $where, 'single');
            $get['data_perms']    = $this->common_model->get_data('role_perm', $where);
            $where                = array('Perm_Id!=' => '0');
            $get['permissions']   = $this->common_model->get_data('permissions', $where);
            $perm_block           = '';
            foreach ($get['permissions'] as $perms)
            {
                if (search_permission($perms['Perm_Id'], $get['data_perms']))
                {
                    $disabled = "";
                    $perm_block .= '<tr data-id="' . $perms['Perm_Id'] . '">
                                        <td><div class="checkbox"><label><input type="checkbox" data-name="per_id" name="perm_id[]" class="m-l-5 parent_input" value="' . $perms['Perm_Id'] . '" checked=checked onchange="check_all_check(this)"><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div>' . $perms['Perm_Name'] . '</td>';
                }
                else
                {
                    $disabled = "disabled=disabled";
                    $perm_block .= '<tr data-id="' . $perms['Perm_Id'] . '">
                                        <td><div class="checkbox"><label><input type="checkbox" data-name="per_id" name="perm_id[]" class="m-l-5 parent_input" value="' . $perms['Perm_Id'] . '" onchange="check_all_check(this)"><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div>' . $perms['Perm_Name'] . '</td>';
                }
                if (search_checked($perms['Perm_Id'], $get['data_perms'], 'Add'))
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="add[' . $perms['Perm_Id'] . ']" class="sub_input" checked="checked" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                else
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="add[' . $perms['Perm_Id'] . ']" class="sub_input" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                if (search_checked($perms['Perm_Id'], $get['data_perms'], 'Edit'))
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="edit[' . $perms['Perm_Id'] . ']" class="sub_input" checked="checked" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                else
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="edit[' . $perms['Perm_Id'] . ']" class="sub_input" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                if (search_checked($perms['Perm_Id'], $get['data_perms'], 'View'))
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="view[' . $perms['Perm_Id'] . ']" class="sub_input" checked="checked" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                else
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="view[' . $perms['Perm_Id'] . ']" class="sub_input" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                if (search_checked($perms['Perm_Id'], $get['data_perms'], 'Perm_Delete'))
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="perm_delete[' . $perms['Perm_Id'] . ']" class="sub_input" checked="checked" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                else
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="perm_delete[' . $perms['Perm_Id'] . ']" class="sub_input" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                if (search_checked($perms['Perm_Id'], $get['data_perms'], 'Delete'))
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="delete[' . $perms['Perm_Id'] . ']" class="sub_input" checked="checked" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                else
                {
                    $perm_block .= '<td><div class="checkbox"><label><input type="checkbox" onchange="check_all_check2(this)" value="1" name="delete[' . $perms['Perm_Id'] . ']" class="sub_input" ' . $disabled . '><span class="cr"><i class="cr-icon fa fa-check"></i></span></label></div></td>';
                }
                $perm_block .= '</tr>';
            }
            $notification['permission_block'] = $perm_block;
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

    //Activate and Deactivate Role here
    public function activate_role()
    {
        if ($this->input->post())
        {
            $input              = $this->input->post();
            $where              = array('Role_Id' => $_POST['id']);
            $data['Is_Deleted'] = $input['status'];
            if ($this->common_model->update_data('roles', $data, $where))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('role_updated');
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

    public function delete_role()
    {
        if ($this->input->post())
        {
            $input              = $this->input->post();
            $where              = array('Role_Id' => $_POST['id']);
            if ($this->db->where($where)->delete('roles'))
            {
                $notification['flash_status']  = true;
                $notification['flash_title']   = $this->lang->line('success_title');
                $notification['flash_message'] = $this->lang->line('role_deleted');
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
