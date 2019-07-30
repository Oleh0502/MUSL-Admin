<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();
    }
    public function index()
    {
        $data['userdata']  = $this->common_model->get_data('users', array('User_Id' => $this->session->userdata('User_Id')), 'single');
        $data['countries'] = $this->common_model->get_data('countries', array());
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('profile', $data);
        $this->load->view('include/footer');
    }

    public function update_profile()
    {

        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $PostData = $this->input->post();

                $this->form_validation->set_rules('User_First_Name', 'User first name', 'required');
                $this->form_validation->set_rules('User_Last_Name', 'User last name', 'required');
                $this->form_validation->set_rules('User_Phone', 'user phone number', 'required');
                $this->form_validation->set_rules('User_Email', 'email address', 'required|is_unique_update[users.User_Email.' . $_SESSION['User_Id'] . '.User_Id]');
                $this->form_validation->set_rules('Company', 'Company', 'required');
                $this->form_validation->set_rules('Address1', 'Address1', 'required');
                $this->form_validation->set_rules('Address2', 'Address2', 'required');
                $this->form_validation->set_rules('City', 'City', 'required');
                $this->form_validation->set_rules('State', 'State', 'required');
                $this->form_validation->set_rules('Country', 'Country', 'required');
                $this->form_validation->set_rules('Zipcode', 'Zipcode', 'required');
                //$this->form_validation->set_rules('User_Name', 'User_Name', 'required|is_unique[users.User_Name]');

                if (isset($PostData['CurrentPassword']) && ($PostData['CurrentPassword'] != '' || $PostData['Password'] != '' || $PostData['ConfirmPassword'] != '')) {
                    $this->form_validation->set_rules('CurrentPassword', 'CurrentPassword', 'trim|required|callback_validatepassword');
                    $this->form_validation->set_rules('Password', 'Password', 'trim|required');
                    $this->form_validation->set_rules('ConfirmPassword', 'Confirm Password', 'matches[Password]', array('matches' => $this->lang->line('confirm_password_error')));

                }

                if ($this->form_validation->run() == false) {
                    $notification['flash_status']  = false;
                    $notification['flash_type']    = 'validation';
                    $notification['flash_title']   = $this->lang->line('error_label');
                    $notification['flash_message'] = $this->form_validation->error_array();
                } else {
                    /*if ($PostData['CurrentPassword'] == '' || $PostData['Password'] == '' || $PostData['ConfirmPassword'] == '')
                    {

                    unset($PostData['CurrentPassword']);
                    unset($PostData['Password']);
                    unset($PostData['ConfirmPassword']);
                    }
                    else if (!$PostData['CurrentPassword'] == '' && !$PostData['Password'] == '' && !$PostData['ConfirmPassword'] == '')
                    {
                    unset($PostData['CurrentPassword']);
                    $PostData['User_Password'] = md5($PostData['Password']);
                    unset($PostData['ConfirmPassword']);
                    }*/

                    /* if (!empty($_FILES['profile_pic']['name']))
                    {
                    $PostData['ProfilePic'] = $this->upload_profilepic();
                    $this->session->set_userdata('ProfilePic', $PostData['ProfilePic']);
                    }*/

                    if (!empty($this->session->userdata('User_Id'))) {
                        $PostData['Modified_Date'] = date('Y-m-d H:i:s');
                        $where                     = array('User_Id' => $this->session->userdata('User_Id'));
                        if ($this->common_model->update_data('users', $PostData, array('User_Id' => $this->session->userdata('User_Id')))) {
                            $notification['flash_status']  = true;
                            $notification['flash_type']    = 'success';
                            $notification['flash_title']   = $this->lang->line('success_label');
                            $notification['flash_message'] = $this->lang->line('profile_updated');
                        } else {
                            $notification['flash_status']  = false;
                            $notification['flash_type']    = 'error';
                            $notification['flash_title']   = $this->lang->line('error_label');
                            $notification['flash_message'] = $this->lang->line('common_error');
                        }
                    }

                }
            } else {
                $notification['flash_status']  = false;
                $notification['flash_type']    = 'error';
                $notification['flash_title']   = $this->lang->line('error_label');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        } else {
            $notification['flash_status']  = false;
            $notification['flash_type']    = 'error';
            $notification['flash_title']   = $this->lang->line('error_label');
            $notification['flash_message'] = $this->lang->line('common_error');
        }

        echo json_encode($notification);
    }

     public function update_profile_pic()
    {

        if ($this->input->is_ajax_request()) {
            if (!empty($_FILES['profile_pic']['name']))
            {
            $PostData['User_Image'] = $this->upload_profilepic();
            $this->session->set_userdata('User_Image', $PostData['User_Image']);
            

                    

                    if (!empty($this->session->userdata('User_Id'))) {
                        $PostData['Modified_Date'] = date('Y-m-d H:i:s');
                        $where                     = array('User_Id' => $this->session->userdata('User_Id'));
                        if ($this->common_model->update_data('users', $PostData, array('User_Id' => $this->session->userdata('User_Id')))) {
                            $notification['flash_status']  = true;
                            $notification['flash_type']    = 'success';
                            $notification['flash_userdata'] = base_url('assets/images/profile_pics/').$PostData['User_Image'];
                            $notification['flash_title']   = $this->lang->line('success_label');
                            $notification['flash_message'] = $this->lang->line('profile_updated');
                        } else {
                            $notification['flash_status']  = false;
                            $notification['flash_type']    = 'error';
                            $notification['flash_title']   = $this->lang->line('error_label');
                            $notification['flash_message'] = $this->lang->line('common_error');
                        }
                    }

              
            } else {
                $notification['flash_status']  = false;
                $notification['flash_type']    = 'error';
                $notification['flash_title']   = $this->lang->line('error_label');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        } else {
            $notification['flash_status']  = false;
            $notification['flash_type']    = 'error';
            $notification['flash_title']   = $this->lang->line('error_label');
            $notification['flash_message'] = $this->lang->line('common_error');
        }

        echo json_encode($notification);
    }

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
                    $OldFileName = basename($this->session->userdata('ProfilePic'));
                    if ($OldFileName != 'male_rep.jpg' or $OldFileName != 'female_rep.jpg')
                    {
                        @unlink(FCPATH . "/assets/images/profile_pics/$OldFileName");
                    }
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


    public function validatepassword()
    {
        $where = array(
            'User_Id'   => $this->session->userdata('User_Id'),
            'User_Password' => md5($this->input->post('CurrentPassword')),
        );
        $user = $this->db->where($where)->get('users');
        if ($user->num_rows() > 0) {
            return true;
        } else {
            $this->form_validation->set_message('validatepassword', $this->lang->line('current_password_notmatched_error'));
            return false;
        }
    }

    public function change_password()
    {

        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $PostData = $this->input->post();
                //$this->form_validation->set_rules('User_Name', 'User_Name', 'required|is_unique[users.User_Name]');

                $this->form_validation->set_rules('CurrentPassword', 'CurrentPassword', 'trim|required|callback_validatepassword');
                $this->form_validation->set_rules('Password', 'Password', 'trim|required');
                $this->form_validation->set_rules('ConfirmPassword', 'Confirm Password', 'matches[Password]', array('matches' => $this->lang->line('confirm_password_error')));

                if ($this->form_validation->run() == false) {
                    $notification['flash_status']  = false;
                    $notification['flash_type']    = 'validation';
                    $notification['flash_title']   = $this->lang->line('error_label');
                    $notification['flash_message'] = $this->form_validation->error_array();
                } else {

                    unset($PostData['CurrentPassword']);
                    $PostData['User_Password'] = md5($PostData['Password']);
                    unset($PostData['ConfirmPassword']);
                    unset($PostData['Password']);
                    /* if (!empty($_FILES['profile_pic']['name']))
                    {
                    $PostData['ProfilePic'] = $this->upload_profilepic();
                    $this->session->set_userdata('ProfilePic', $PostData['ProfilePic']);
                    }*/

                    if (!empty($this->session->userdata('User_Id'))) {
                        $PostData['Modified_Date'] = date('Y-m-d H:i:s');
                        $where                     = array('User_Id' => $this->session->userdata('User_Id'));
                        if ($this->common_model->update_data('users', $PostData, array('User_Id' => $this->session->userdata('User_Id')))) {
                            $notification['flash_status']  = true;
                            $notification['flash_type']    = 'success';
                            $notification['flash_title']   = $this->lang->line('success_label');
                            $notification['flash_message'] = $this->lang->line('password_update_success');
                        } else {
                            $notification['flash_status']  = false;
                            $notification['flash_type']    = 'error';
                            $notification['flash_title']   = $this->lang->line('error_label');
                            $notification['flash_message'] = $this->lang->line('common_error');
                        }
                    }

                }
            } else {
                $notification['flash_status']  = false;
                $notification['flash_type']    = 'error';
                $notification['flash_title']   = $this->lang->line('error_label');
                $notification['flash_message'] = $this->lang->line('common_error');
            }
        } else {
            $notification['flash_status']  = false;
            $notification['flash_type']    = 'error';
            $notification['flash_title']   = $this->lang->line('error_label');
            $notification['flash_message'] = $this->lang->line('common_error');
        }

        echo json_encode($notification);
    }

}
