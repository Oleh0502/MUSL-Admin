<?php
class Video_model extends CI_Model
{
    public function get_videos($parms)
    {
    	$this->db->from('videos');
    	$this->db->where(array('Is_Deleted' => '0', 'Is_Blocked' => '0', 'Video_Type' => $parms['Video_Type']));
    	if(isset($parms['search']) && !empty($parms['search'])){
    		$this->db->where($parms['search']);
    	}
    	if(isset($parms['Training']) && !empty($parms['Training'])){
    		$this->db->where('LOWER(Training_Type)',$parms['Training']);
    	}
    	$this->db->limit(DEFAULT_NO_PER_PAGE, $parms['start']);
    	$this->db->order_by('Created_On','desc');
    	return $this->db->get()->result_array();
    }
}
