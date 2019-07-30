<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifications_model extends CI_Model 
{
 
    public function get_current_page_records($limit, $start,$where) 
    {
 		$query = $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where($where)->order_by('Assign_Id','desc')->limit($limit, $start)->get();
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
     
    public function get_total($where) 
    {
        return $this->db->select('*')->from('assign_notification an')->join('notifications n','n.Noti_Id=an.Noti_Id','left')->where('User_Id',$this->session->userdata('User_Id'))->where($where)->order_by('Assign_Id','desc')->get()->num_rows();
    }
}