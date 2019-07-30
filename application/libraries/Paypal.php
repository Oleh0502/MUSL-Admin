<?php
require_once APPPATH.'third_party/paypal/PaypalRecurringPaymentProfile.php';
require_once APPPATH.'third_party/paypal/gencc.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Paypal
{
    protected $APIUsername = '';
	protected $APIPassword = '';
	protected $APISignature = '';
	protected $APIVersion = '';
	protected $Sandbox = '';
	protected $Currency = '';
	protected $_ci;      
	function __construct()
	{
		$this->_ci = & get_instance();
		$this->_ci->config->load('paypal_sample');
		$this->APIUsername = $this->_ci->config->item('APIUsername');
		$this->APIPassword = $this->_ci->config->item('APIPassword');
		$this->APISignature = $this->_ci->config->item('APISignature');
		$this->APIVersion = $this->_ci->config->item('APIVersion');
		$this->Sandbox = $this->_ci->config->item('Sandbox');
		$this->Currency = $this->_ci->config->item('Currency');
	}

	public function do_recurring($data){
		$info = array();
		// try {
			$payment_details = array();
		    $payment_details['AMT']                = $data['amount'];
		    $payment_details['ACCT']               = $data['card_number'];
		    $payment_details['CREDITCARDTYPE']     = $data['credit_card_type'];    //Visa
																		//MasterCard
																		//Discover
																		//Amex
																		//Maestro
		    $payment_details['EXPDATE']            = $data['month'].$data['year'];
		    $payment_details['CVV2']               = $data['cvv'];
		    $payment_details['FIRSTNAME']          = $data['first_name'];
		    $payment_details['LASTNAME']           = $data['last_name'];
		    $payment_details['STREET']             = $data['street'];
		    $payment_details['CITY']               = $data['city'];
		    $payment_details['STATE']              = $data['state'];
		    $payment_details['COUNTRY']            = $data['country'];
		    $payment_details['ZIP']                = $data['zip'];
		    $payment_details['PROFILESTARTDATE']   = Date('Y-m-d H:i:s');
		    $payment_details['DESC']               = $data['desc'];
		    $payment_details['BILLINGPERIOD']      = 'Month';
		    $payment_details['BILLINGFREQUENCY']   = '1';
		    $payment_details['TOTALBILLINGCYCLES'] = '100000';
		    $payment_details['TAXAMOUNT']          = '0.00';
		    $payment_details['CURRENCYCODE']       = $this->Currency;
		    $api_username               = $this->APIUsername;
		    $api_pasword                = $this->APIPassword;
		    $api_signature              = $this->APISignature;
		    $api_env                    = $this->Sandbox;
		    $api_version                = $this->APIVersion;
		    $pp_profile                 = new PaypalRecurringPaymentProfile($api_username, $api_pasword, $api_signature, $api_version, $api_env);
		    $pp_create_profile          = $pp_profile->createProfile($payment_details);
		    if($pp_create_profile && strtolower($pp_create_profile['ACK'])=='success'){
			    $pp_profile_details         = $pp_profile->getProfileDetails($pp_create_profile['PROFILEID']);
		    	$info['status'] = true;
		    	$info['info'] = $pp_profile_details;
		    	$info['info2'] = $pp_create_profile;
		    } else{
		    	$info['status'] = false;
		    	$info['msg'] = $pp_create_profile['L_LONGMESSAGE0'];
		    }
		    return $info;
		// } catch (Exception $e) {
		// 	$info['status'] = false;
		// 	$info['msg'] = $e->getMessage();
		// 	return $info;
		// }
	}

	public function cancel_recurring($profile_id){
	    $api_username               = $this->APIUsername;
	    $api_pasword                = $this->APIPassword;
	    $api_signature              = $this->APISignature;
	    $api_env                    = $this->Sandbox;
	    $api_version                = $this->APIVersion;
	    $pp_profile                 = new PaypalRecurringPaymentProfile($api_username, $api_pasword, $api_signature, $api_version, $api_env);
	    $pp_profile_status   = $pp_profile->manageProfileStatus($profile_id, 'Cancel', 'Arimaccabi - profile was suspended!');
	    if($pp_profile_status && strtolower($pp_profile_status['ACK'])=='success'){
		    $pp_profile_details = $pp_profile->getProfileDetails($profile_id);
	    	$info['status'] = true;
	    	$info['info'] = $pp_profile_details;
	    	$info['info2'] = $pp_profile_status;
	    } else{
	    	$info['status'] = false;
	    	$info['msg'] = $pp_create_profile['L_LONGMESSAGE0'];
	    }
	    return $info;
	}

	public function verify_ipn($postData){
		if(!empty($postData)){
			$req = 'cmd=_notify-validate';
			foreach ($_POST as $key => $value) {
			  	if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
			    	$value = urlencode(stripslashes($value));
			  	} else {
			    	$value = urlencode($value);
			  	}
			  	$req .= "&$key=$value";
			}
	        // send_email('sameer.kakkar.38@gmail.com', 'Subs',json_encode($_POST));
			// $ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
			$ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
			if ( !($res = curl_exec($ch)) ) {
			  	return array(
			  		'status' => false,
			  		'msg' => curl_error($ch) . " when processing IPN data"
			  	);
			}
			curl_close($ch);
		  	// send_email('sameer.kakkar.38@gmail.com', 'verified',json_encode($res));
			if (strcmp ($res, "VERIFIED") == 0) {
			  	return array(
			  		'status' => true
			  	);
			} else if (strcmp ($res, "INVALID") == 0) {
			  	return array(
			  		'status' => true,
			  		'msg' => 'IPN invalid, log for manual investigation'
			  	);
			}
		}
		else{
			return array(
		  		'status' => true,
		  		'msg' => 'INVALID Access'
		  	);
		}
	}
}

