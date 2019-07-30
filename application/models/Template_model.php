<?php
class Template_model extends CI_Model
{
    public function get_fields($parms)
    {
        $this->db->select('tf.*,tfd.Field_Data_Value');
    	$this->db->from('template_fields as tf');
        $this->db->join('template_fields_data as tfd','tf.Template_Field_Id = tfd.Template_Field_Id','left');
    	$this->db->where(array('tf.Template_Id' => $parms['Template_Id'],'tfd.Template_Data_Id' => $parms['Template_Data_Id']));
    	return $this->db->get()->result_array();
    }

    public function get_lcp_list($parms)
    {
    	$this->db->select('td.*,t.Template_Type');
    	$this->db->from('template_data as td');
    	$this->db->join('templates as t','t.Template_Id = td.Template_Id','left');
    	$this->db->where(array('td.Is_Deleted' => '0', 'td.Is_Blocked' => '0','td.Program_Id'=>$parms['Program_Id'], 't.Template_Type' => $parms['Template_Type']));
    	if(isset($parms['search']) && !empty($parms['search'])){
    		$this->db->where($parms['search']);
    	}
    	$this->db->limit(DEFAULT_NO_PER_PAGE, $parms['start']);
    	$this->db->order_by('Created_On','desc');
    	return $this->db->get()->result_array();
    }

    public function get_vsl_list($parms)
    {
        $this->db->select('td.*,t.Template_Type');
        $this->db->from('template_data as td');
        $this->db->join('templates as t','t.Template_Id = td.Template_Id','left');
        $this->db->where(array('td.Is_Deleted' => '0', 'td.Is_Blocked' => '0','td.Program_Id'=>$parms['Program_Id'], 't.Template_Type' => $parms['Template_Type']));
        if(isset($parms['search']) && !empty($parms['search'])){
            $this->db->where($parms['search']);
        }
        $this->db->limit(DEFAULT_NO_PER_PAGE, $parms['start']);
        $this->db->order_by('Created_On','desc');
        return $this->db->get()->result_array();
    }
}
