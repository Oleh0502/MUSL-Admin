<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public __contruct(){
		parent::__contruct();
		$this->auth->is_login();
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
