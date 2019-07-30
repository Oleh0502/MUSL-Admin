<?php
include APPPATH.'third_party/getresponse/jsonRPCClient.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Getresponselib
{
	protected $_ci;  
	protected $api_key;  
	protected $api_url = 'http://api2.getresponse.com';
	function __construct($api_key = '')
	{
		$this->_ci = & get_instance();
		$this->api_key = $api_key;
	}


    public function init(){
    	# initialize JSON-RPC client
		return  $client = new jsonRPCClient($this->api_url);
    }
}

