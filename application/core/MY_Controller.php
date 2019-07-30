<?php 
class MY_Controller extends CI_Controller {

   public $purchased;
   public $programs;

   function __construct() {
       parent::__construct();
       // $this->purchased = $this->common_model->get_data('packages_purchase',array('Active'=>'yes','Customer_Id'=>$this->session->userdata('User_Id')));
       // $this->programs = $this->common_model->get_programs(); 
   }
}
?>