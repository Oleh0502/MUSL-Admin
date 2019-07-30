<?php
include APPPATH.'third_party/AWeber-API-PHP-Library-master/aweber_api/aweber_api.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Awebers
{
	protected $consumerKey    = "Ak8P5CBedbktzSh6hS1Cl2kj";
    protected $consumerSecret = "TejVdRVFcC2GKNuvgPkh03Ago0L5JaEXWBQOrU7A";

    public function init(){
    	$CI = & get_instance();
    	return $aweber = new AWeberAPI($this->consumerKey, $this->consumerSecret);
    }
}

