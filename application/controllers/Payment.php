<?php
require_once APPPATH.'third_party/paypal/PaypalRecurringPaymentProfile.php';
require_once APPPATH.'third_party/paypal/gencc.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Payment extends MY_Controller
{
	protected $APIUsername = '';
	protected $APIPassword = '';
	protected $APISignature = '';
	protected $APIVersion = '';
	protected $Sandbox = '';
	protected $Currency = '';
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_login();	
       	$this->config->load('paypal_sample');
		$this->APIUsername = $this->config->item('APIUsername');
		$this->APIPassword = $this->config->item('APIPassword');
		$this->APISignature = $this->config->item('APISignature');
		$this->APIVersion = $this->config->item('APIVersion');
		$this->Sandbox = $this->config->item('Sandbox');
		$this->Currency = $this->config->item('Currency');		
    }
    //Index Fnction Start here
    public function do_payment($program_id)
    {
        $where         = array('Is_Deleted' => '0','Program_Id'=>$program_id);
        $data['program'] = $this->common_model->get_data('programs', $where,'single');
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('do_payment', $data);
        $this->load->view('include/footer');
    }
    public function go() {
    	if(isset($_POST) && !empty($_POST)) {
    		$input = $this->input->post();
    		if(!empty($input['package'])) {
    			$package = $input['package']; 
    			if(strtolower($package=='all')){
    				$res = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    				if(empty($res)){
    					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
		    			//Payment start here
		    			$curl = curl_init();
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');

						$this->APIUsername = $this->config->item('APIUsername');
						$this->APIPassword = $this->config->item('APIPassword');
						$this->APISignature = $this->config->item('APISignature');


						curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
						    'USER' => $this->APIUsername,
						    'PWD' => $this->APIPassword,
						    'SIGNATURE' => $this->APISignature,
						 
						    'METHOD' => 'SetExpressCheckout',
						    'VERSION' => '108',		 
						    'PAYMENTREQUEST_0_AMT' => 45.00,
						    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
						    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
						    'PAYMENTREQUEST_0_ITEMAMT' => 45.00,
						 
						    'L_PAYMENTREQUEST_0_NAME0' => $userInfo['User_First_Name'].' '.$userInfo['User_Last_Name'],
						    'L_PAYMENTREQUEST_0_DESC0' => 'Arimaccabi Payment',
						    'L_PAYMENTREQUEST_0_QTY0' => 1,
						    'L_PAYMENTREQUEST_0_AMT0' => 45.00,

						    'L_BILLINGTYPE0' => 'RecurringPayments',
						    'L_BILLINGAGREEMENTDESCRIPTION0' => 'Arimaccabi Payment',
						 
						    'CANCELURL' => 'http://localhost/cancel.html',
						    'RETURNURL' => base_url('payment/complete/'.$package)
						)));
						 
						$response =    curl_exec($curl);
						curl_close($curl);
						$nvp = array();
						if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
						    foreach ($matches['name'] as $offset => $name) {
						        $nvp[$name] = urldecode($matches['value'][$offset]);
						    }
						}
						if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
						    $query = array(
						        'cmd'    => '_express-checkout',
						        'token'  => $nvp['TOKEN']
						    );
						    $redirectURL = sprintf('https://www.sandbox.paypal.com/cgi-bin/webscr?%s', http_build_query($query));

						    header('Location: ' . $redirectURL);
						} else {
						    $notification['flash_status']  = false;
	            			$notification['flash_title']   = $this->lang->line('error_label');
	            			$notification['flash_message'] = 'Something went wrong.';
	            			$this->setFlashMessage($notification);
		        			redirect($_SERVER['HTTP_REFERER']);
						}
    				} else{
    					$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect($_SERVER['HTTP_REFERER']);
    				}
    			} else{
    				$res = $this->common_model->get_data('packages_purchase',array('Package_Id'=>$package,'Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    				if(empty($res)){
    					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
		    			//Payment start here
		    			$curl = curl_init();
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');

						$this->APIUsername = $this->config->item('APIUsername');
						$this->APIPassword = $this->config->item('APIPassword');
						$this->APISignature = $this->config->item('APISignature');


						curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
						    'USER' => $this->APIUsername,
						    'PWD' => $this->APIPassword,
						    'SIGNATURE' => $this->APISignature,
						 
						    'METHOD' => 'SetExpressCheckout',
						    'VERSION' => '108',		 
						    'PAYMENTREQUEST_0_AMT' => 15.00,
						    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
						    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
						    'PAYMENTREQUEST_0_ITEMAMT' => 15.00,
						 
						    'L_PAYMENTREQUEST_0_NAME0' => $userInfo['User_First_Name'].' '.$userInfo['User_Last_Name'],
						    'L_PAYMENTREQUEST_0_DESC0' => 'Arimaccabi Payment',
						    'L_PAYMENTREQUEST_0_QTY0' => 1,
						    'L_PAYMENTREQUEST_0_AMT0' => 15.00,

						    'L_BILLINGTYPE0' => 'RecurringPayments',
						    'L_BILLINGAGREEMENTDESCRIPTION0' => 'Arimaccabi Payment',
						 
						    'CANCELURL' => base_url('payment/do_payment/'.$package),
						    'RETURNURL' => base_url('payment/complete/'.$package)
						)));
						 
						$response =    curl_exec($curl);
						curl_close($curl);
						$nvp = array();
						if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
						    foreach ($matches['name'] as $offset => $name) {
						        $nvp[$name] = urldecode($matches['value'][$offset]);
						    }
						}
						if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
						    $query = array(
						        'cmd'    => '_express-checkout',
						        'token'  => $nvp['TOKEN']
						    );
						    $redirectURL = sprintf('https://www.sandbox.paypal.com/cgi-bin/webscr?%s', http_build_query($query));

						    header('Location: ' . $redirectURL);
						} else {
						    $notification['flash_status']  = false;
	            			$notification['flash_title']   = $this->lang->line('error_label');
	            			$notification['flash_message'] = 'Something went wrong.';
	            			$this->setFlashMessage($notification);
		        			redirect($_SERVER['HTTP_REFERER']);
						}
    				} else{
    					$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect($_SERVER['HTTP_REFERER']);
    				}
    			}
			} else{
    			$notification['flash_status']  = false;
    			$notification['flash_title']   = $this->lang->line('error_label');
    			$notification['flash_message'] = 'Invalid Payment Details.';
    			$this->setFlashMessage($notification);
	        	redirect($_SERVER['HTTP_REFERER']);
    		}
    	}
    	else{
    		$notification['flash_status']  = false;
			$notification['flash_title']   = $this->lang->line('error_label');
			$notification['flash_message'] = $this->lang->line('indirect_access');
			$this->setFlashMessage($notification);
	        redirect($_SERVER['HTTP_REFERER']);
    	}
	}


	/*public function go() {
    	if(isset($_POST) && !empty($_POST)) {
    		$input = $this->input->post();
    		if(!empty($input['card_type']) && !empty($input['ccn']) && !empty($input['month']) && !empty($input['year']) && !empty($input['cvv']) && !empty($input['package'])) { 
    			$package = $input['package'];
    			if(strtolower($package=='all')){
    				$res = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    				if(empty($res)){
    					$this->load->library('paypal');
    					$res2 = $this->common_model->get_data('packages_purchase',array('Package_Id!='=>'all','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'));
    					//Suspend the previous plans first
    					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
    					if(!empty($res2)){
    						foreach($res2 as $ress){
    							$result = $this->paypal->cancel_recurring($ress['Transaction_Id']);
    							if($result['status']){
    								$packageInfo = $this->common_model->get_data('programs',array('Program_Id'=>$ress['Package_Id']),'single');
    								$this->common_model->update_data('packages_purchase',array('Active'=>'no'),array('Transaction_Id'=>$ress['Transaction_Id']));
    								//Mail to User
					                // $data['subject'] = $this->lang->line('plan_deactivate_mail_to_customer_subject');
					                // $data['message'] = $this->lang->line('plan_deactivate_mail_to_customer_body');
					                // $replaceto       = array("__USERNAME", "__PLAN_NAME");
					                // $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$packageInfo['Program_Name']);
					                // $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
					                // $view_content    = $this->load->view('email_template', $data, true);
					                // send_email($userInfo['User_Email'], $data['subject'], $view_content);
    							}
    						}
    					}
						$data  = array(
							'amount' => '45.00',
							'card_number' => $input['ccn'],
							'credit_card_type' => $input['card_type'],
							'month' => $input['month'],
							'year' => $input['year'],
							'cvv' => $input['cvv'],
							'first_name' => $userInfo['User_First_Name'],
							'last_name' => $userInfo['User_Last_Name'],
							'street' => '101 West 1th street apt 1',
							'city' => 'Brooklyn',
							'state' => 'NY',
							'country' => 'USA',
							'zip' => '11201',
							'desc' => 'Arimaccabi Payment',
						);
						$results = $this->paypal->do_recurring($data);
						if($results['status']){
							$insert_payment_details = array(
								'Package_Id'=>$input['package'],
								'Customer_Id'=>$this->session->userdata('User_Id'),
								'Transaction_Id'=>$results['info']['PROFILEID'],
								'P_Type' => 'All',
								'Created_Date' => date('Y-m-d H:i:s'),
								'Active' => 'yes'
							);
							$this->common_model->insert_data('packages_purchase',$insert_payment_details);
							// $history = array(
							// 	'Customer_Id'=>$this->session->userdata('User_Id'),
							// 	'Transaction_Id'=>$results['info']['PROFILEID'],
							// 	'Amount' => '45.00',
							// 	'Created_Date' => date('Y-m-d H:i:s')
							// );
							// $this->common_model->insert_data('transactions',$history);
							//Mail to User
			                $data['subject'] = $this->lang->line('plan_buy_mail_to_customer_subject');
			                $data['message'] = $this->lang->line('plan_buy_mail_to_customer_body');
			                $replaceto       = array("__USERNAME", "__PLAN_NAME");
			                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],'Mega Plan');
			                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
			                $view_content    = $this->load->view('email_template', $data, true);
			                send_email($userInfo['User_Email'], $data['subject'], $view_content);
							$notification['flash_status']  = true;
	            			$notification['flash_title']   = $this->lang->line('success_label');
	            			$notification['flash_message'] = 'Payment has been completed successfully.';
	            			// print_r($notification);
	            			$this->setFlashMessage($notification);
	        				redirect('home/payment/payment_success');
						} else{
							$notification['flash_status']  = false;
	            			$notification['flash_title']   = $this->lang->line('error_label');
	            			$notification['flash_message'] = $results['msg'];
	            			$this->setFlashMessage($notification);
	        				redirect($_SERVER['HTTP_REFERER']);
						}
					} else{
						$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect($_SERVER['HTTP_REFERER']);
    				}
    			} else{
    				$res = $this->common_model->get_data('packages_purchase',array('Package_Id'=>$package,'Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    				if(empty($res)){
    					$res2 = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    					if(empty($res2)){
	    					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
	    					$packageInfo = $this->common_model->get_data('programs',array('Program_Id'=>$package),'single');
							$this->load->library('paypal');
							$data  = array(
								'amount' => '15.00',
								'card_number' => $input['ccn'],
								'credit_card_type' => $input['card_type'],
								'month' => $input['month'],
								'year' => $input['year'],
								'cvv' => $input['cvv'],
								'first_name' => $userInfo['User_First_Name'],
								'last_name' => $userInfo['User_Last_Name'],
								'street' => '101 West 1th street apt 1',
								'city' => 'Brooklyn',
								'state' => 'NY',
								'country' => 'USA',
								'zip' => '11201',
								'desc' => 'Arimaccabi Payment',
							);
							$results = $this->paypal->do_recurring($data);
							if($results['status']){
								$insert_payment_details = array(
									'Package_Id'=>$input['package'],
									'Customer_Id'=>$this->session->userdata('User_Id'),
									'Transaction_Id'=>$results['info']['PROFILEID'],
									'P_Type' => 'Single',
									'Created_Date' => date('Y-m-d H:i:s'),
									'Active' => 'yes'
								);
								$this->common_model->insert_data('packages_purchase',$insert_payment_details);
								// $history = array(
								// 	'Customer_Id'=>$this->session->userdata('User_Id'),
								// 	'Transaction_Id'=>$results['info']['PROFILEID'],
								// 	'Amount' => '15.00',
								// 	'Created_Date' => date('Y-m-d H:i:s')
								// );
								// $this->common_model->insert_data('transactions',$history);
								//Mail to User
				                $data['subject'] = $this->lang->line('plan_buy_mail_to_customer_subject');
				                $data['message'] = $this->lang->line('plan_buy_mail_to_customer_body');
				                $replaceto       = array("__USERNAME", "__PLAN_NAME");
				                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$packageInfo['Program_Name']);
				                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
				                $view_content    = $this->load->view('email_template', $data, true);
				                send_email($userInfo['User_Email'], $data['subject'], $view_content);
								$notification['flash_status']  = true;
		            			$notification['flash_title']   = $this->lang->line('success_label');
		            			$notification['flash_message'] = 'Payment has been completed successfully.';
		            			$this->setFlashMessage($notification);
	        					redirect('home/payment/payment_success');
							} else{
								$notification['flash_status']  = false;
		            			$notification['flash_title']   = $this->lang->line('error_label');
		            			$notification['flash_message'] = $results['msg'];
		            			$this->setFlashMessage($notification);
	        					redirect($_SERVER['HTTP_REFERER']);
							}
    					} else{
    						$notification['flash_status']  = false;
	            			$notification['flash_title']   = $this->lang->line('error_label');
	            			$notification['flash_message'] = 'You have alreday a max plan.';
	            			$this->setFlashMessage($notification);
	        				redirect($_SERVER['HTTP_REFERER']);
    					}
    				} else{
    					$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect($_SERVER['HTTP_REFERER']);
    				}
    			}
    		} else{
    			$notification['flash_status']  = false;
    			$notification['flash_title']   = $this->lang->line('error_label');
    			$notification['flash_message'] = 'Invalid Payment Details.';
    			$this->setFlashMessage($notification);
	        	redirect($_SERVER['HTTP_REFERER']);
    		}
    	}
    	else{
    		$notification['flash_status']  = false;
			$notification['flash_title']   = $this->lang->line('error_label');
			$notification['flash_message'] = $this->lang->line('indirect_access');
			$this->setFlashMessage($notification);
	        redirect($_SERVER['HTTP_REFERER']);
    	}
	}*/


	public function payment_success(){
		$this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('payment_success');
        $this->load->view('include/footer');
	}
	public function cancel_plan($plan_id) {
    	if(isset($plan_id) && !empty($plan_id)) {
    		$this->load->library('paypal');
			$result = $this->paypal->cancel_recurring($plan_id);
			print_r($result);
			die;
			// if($result['status']){
			// 	$this->common_model->update_data('packages_purchase',array('Active'=>'no'),array('Transaction_Id'=>$plan_id));
   //              $notification['flash_status']  = true;
			// 	$notification['flash_title']   = $this->lang->line('success_label');
			// 	$notification['flash_message'] = "Your Plan has been Cancelled Successfully.";
			// 	$this->setFlashMessage($notification);
		 //        redirect($_SERVER['HTTP_REFERER']);
			// } else{
			// 	$notification['flash_status']  = false;
			// 	$notification['flash_title']   = $this->lang->line('error_label');
			// 	$notification['flash_message'] = $result['msg'];
			// 	$this->setFlashMessage($notification);
	  //       	redirect($_SERVER['HTTP_REFERER']);
			// }
    	}
    	else{
   //  		$notification['flash_status']  = false;
			// $notification['flash_title']   = $this->lang->line('error_label');
			// $notification['flash_message'] = $this->lang->line('indirect_access');
			// $this->setFlashMessage($notification);
	  //       redirect($_SERVER['HTTP_REFERER']);
    	}
	}
	public function index(){
		$data = array();
		$data['subscriptions'] = $this->db->select('pp.*,p.Program_Name')->from('packages_purchase pp')->join('programs p','p.Program_Id=pp.Package_Id','left')->where(array('pp.Customer_Id'=>$this->session->userdata('User_Id')))->order_by('P_Id','desc')->get()->result_array();
		$this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('subscriptions', $data);
        $this->load->view('include/footer');
	}
	public function transactions($plan){
		$data = array();
		$data['subscriptions'] = $this->db->select('pp.*,p.Program_Name')->from('packages_purchase pp')->join('programs p','p.Program_Id=pp.Package_Id','left')->where(array('pp.Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes','Transaction_Id'=>$plan))->get()->row_array();
		$data['transactions'] = $this->db->select('t.*')->from('transactions t')->where(array('t.Customer_Id'=>$this->session->userdata('User_Id'),'Transaction_Id'=>$plan))->order_by('id','desc')->get()->result_array();
		$this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('transactions', $data);
        $this->load->view('include/footer');
	}
	public 	function setFlashMessage($notification){
		if(!empty($notification)){
        	foreach ($notification as $key => $value) {
	        	$this->session->set_flashdata($key, $value);
        	}
        }
	}  
/*	public function notify(){
		if(isset($_POST) && !empty($_POST)){
			$this->load->library('paypal');
			$result = $this->paypal->verify_ipn($_POST);
			if($result['status']){
				$input = $_POST;
				switch (strtolower($input['txn_type'])) {
					case 'recurring_payment':
						$this->save_transaction($input);
						break;
					case 'recurring_payment_profile_cancel':
						$this->cancel_transaction($input);
						break;
					default:
						log_message('info', 'Invalid IPN Hits.');
						break;
				}
			}
		}
	}
	//Save transaction here
	public function save_transaction($postData){
		if(!empty($postData)){
			if(strtolower($postData['txn_type'])=='recurring_payment'){
				$getrecurringDetails = $this->common_model->get_data('packages_purchase',array('Transaction_Id'=> $postData['recurring_payment_id']),'single');
				if(!empty($getrecurringDetails)){
					$insertData = array(
						'Customer_Id' => $getrecurringDetails['Customer_Id'],
						'Transaction_Id' => $postData['recurring_payment_id'],
						'Amount' => $postData['mc_gross'],
						'Created_Date' => date('Y-m-d H:i:s'),
						'Payment_fees' => $postData['payment_fee'],
						'Currency' => $postData['currency_code'],
						'Txn_Id' => $postData['txn_id'],
						'Next_Payment_Date' => $postData['next_payment_date']
					);
					$this->common_model->insert_data('transactions',$insertData);
					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$getrecurringDetails['Customer_Id']),'single');
					if(!empty($userInfo)){
						$packageInfo = $this->common_model->get_data('programs', array('Program_Id'=>$getrecurringDetails['Package_Id']),'single');
						//send mail here
		                $data['subject'] = $this->lang->line('recurring_payment_to_customer_subject');
		                $data['message'] = $this->lang->line('recurring_payment_to_customer_body');
		                $replaceto       = array("__USERNAME", "__AMOUNT", "__PLAN_NAME");
		                if(!empty($packageInfo)){
			                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$postData['mc_gross'], $packageInfo['Program_Name']);
		                } else{
			                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$postData['mc_gross'], 'Mega Pack');
		                }
		                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
		                $view_content    = $this->load->view('email_template', $data, true);
		                send_email($userInfo['User_Email'], $data['subject'], $view_content);
					}
				}
			}
		}
	}
	//Cancel transaction here
	public function cancel_transaction($postData){
		if(!empty($postData)){
			if(strtolower($postData['txn_type'])=='recurring_payment_profile_cancel'){
				$getrecurringDetails = $this->common_model->get_data('packages_purchase',array('Transaction_Id'=> $postData['recurring_payment_id']),'single');
				if(!empty($getrecurringDetails)){
					$updateData = array(
						'Active' => 'no'
					);
					$this->common_model->update_data('packages_purchase',$updateData, array('P_Id'=>$getrecurringDetails['P_Id']));
					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$getrecurringDetails['Customer_Id']),'single');
					if(!empty($userInfo)) {
						$packageInfo = $this->common_model->get_data('programs', array('Program_Id'=>$getrecurringDetails['Package_Id']),'single');
						//send mail here
		                $data['subject'] = $this->lang->line('plan_deactivate_mail_to_customer_subject');
		                $data['message'] = $this->lang->line('plan_deactivate_mail_to_customer_body');
		                $replaceto       = array("__USERNAME", "__PLAN_NAME");
		                 if(!empty($packageInfo)){
			                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$packageInfo['Program_Name']);
		                } else{
		                	$replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],'Mega Pack');
		                }
		                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
		                $view_content    = $this->load->view('email_template', $data, true);
		                send_email($userInfo['User_Email'], $data['subject'], $view_content);
					}
				}
			}
		}
	}
*/
	public function delete_subs()
    {
        if ($this->input->post())
        {
        	if ($this->auth->has_permission('manage-payments', 'Perm_Delete'))
            {
                $perm_check = 1;
            }                
            if ($perm_check == 0)
            {
                $notification['flash_status']  = false;
                $notification['flash_title']   = $this->lang->line('error_title');
                $notification['flash_message'] = $this->lang->line('permissions_error');
                exit(json_encode($notification));
            }
            $this->load->library('paypal');
			$result = $this->paypal->cancel_recurring($_POST['id']);
			if($result['status']){
				$this->common_model->update_data('packages_purchase',array('Active'=>'no'),array('Transaction_Id'=>$_POST['id']));
                $notification['flash_status']  = true;
				$notification['flash_title']   = $this->lang->line('success_label');
				$notification['flash_message'] = "Your Plan has been Cancelled Successfully.";
			} else{
				$notification['flash_status']  = false;
				$notification['flash_title']   = $this->lang->line('error_label');
				$notification['flash_message'] = $result['msg'];
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
	public function all_transactions($user_id = ''){
		if ($this->auth->has_permission('manage-payments', 'View'))
        {
			$data = array();
			$data['user_id'] = $user_id == ''?'':$user_id;
			$this->load->view('include/header');
	        $this->load->view('include/sidebar');
	        $this->load->view('all_transactions',$data);
	        $this->load->view('include/footer');
	    }
	}
	public function all_transactions_ajax(){
		$data = array();
		$where = array(
            'pp.P_Id!=' => '0'
        );
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
        	$where['pp.Customer_Id'] = $_POST['user_id'];
        }
        $this->load->model("datatables/Transactions_list");
        $fetch_data = $this->Transactions_list->make_datatables($where);
        $data       = array();
        foreach ($fetch_data as $row)
        {
            $sub_array   = array();
            $sub_array[] = $row->Company;
            $sub_array[] = ($row->Package_Name)?$row->Package_Name:'Mega Pack';
            $sub_array[] = get_date_format($row->Created_Date);
            $sub_array[] = get_date_format($row->Valid_From);
            $sub_array[] = get_date_format($row->Valid_To);
            if($row->Active=='yes'){
            	$text = '<span class="label label-sm label-success" > Active </span>';
            }else if($row->Active=='no'){
            	$text = '<span class="label label-sm label-danger" > Cancelled </span>';
            }
            $sub_array[] = @$text;
            $buttons     = '<a data-toggle="modal" href="'.base_url('payment/transaction/'.$row->Customer_Id.'/'.$row->P_Id).'" type="button" title="View" class="btn btn-icon-only green" ><i class="fa fa-eye"></i></a>';
            if ($this->auth->has_permission('manage-customers', 'Delete'))
            {
            	if($row->Active=='yes'){
	                $buttons .= '<a type="button" title="Cancel Subscription" onclick=admin_perm_delete("'.$row->Transaction_Id.'"); class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';
            	}
            }
            /*if ($this->auth->has_permission('manage-customers', 'Edit'))
            {
                $buttons .= '<a data-toggle="modal" href="#edit_customer" type="button" title="Edit" onclick="edit_user(' . $row->User_Id . ');" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>';
                $buttons .= '<a data-toggle="modal" href="#reset_password_customer" type="button" title="Reset Password" onclick="reset_password_cus(' . $row->User_Id . ');" class="btn btn-icon-only dark"><i class="fa fa-user"></i></a>';
            }
            if ($this->auth->has_permission('manage-customers', 'Delete'))
            {
                if ($row->Is_Blocked == 1)
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('account_activate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Activate_label').'" onclick=activate_account(' . $row->User_Id . ',"0","'.$msg.'"); class="btn btn-icon-only yellow"><i class="fa fa-times-circle"></i></a>';
                }
                else
                {
                    $msg = preg_replace('/\s+/', '_', $this->lang->line('account_deactivate'));
                    $buttons .= '<a type="button" title="'.$this->lang->line('Deactivate_label').'" onclick=activate_account(' . $row->User_Id . ',"1","'.$msg.'"); class="btn btn-icon-only purple"><i class="fa fa-check"></i></a>';
                }
            }
            if ($this->auth->has_permission('manage-customers', 'Perm_Delete'))
            {
                $msg = preg_replace('/\s+/', '_', $this->lang->line('admin_delete_title'));
                $buttons .= '<a type="button" title="'.$this->lang->line('Delete_title').'" onclick=perm_delete(' . $row->User_Id . ',"'.$msg.'"); class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>';
            }*/
            $sub_array[] = $buttons;
            $data[]      = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST["draw"]),
            "recordsTotal"    => $this->Transactions_list->get_all_data($where),
            "recordsFiltered" => $this->Transactions_list->get_filtered_data($where),
            "data"            => $data,
        );
        echo json_encode($output);
	}
	public function transaction($user_id,$payment_id){
		$data = array();
		$payment_info = $this->common_model->get_data('packages_purchase',array('P_Id'=>$payment_id,'Customer_Id'=>$user_id),'single');
		$data['info_transactions'] = $this->common_model->get_data('transactions', array('Transaction_Id'=>$payment_info['Transaction_Id'],'Customer_Id'=>$user_id));
		$this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('all_transactions_single', $data);
        $this->load->view('include/footer');
	}

	public function test(){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');

		$this->APIUsername = $this->config->item('APIUsername');
		$this->APIPassword = $this->config->item('APIPassword');
		$this->APISignature = $this->config->item('APISignature');


		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->APIUsername,
		    'PWD' => $this->APIPassword,
		    'SIGNATURE' => $this->APISignature,
		 
		    'METHOD' => 'SetExpressCheckout',
		    'VERSION' => '108',		 
		    'PAYMENTREQUEST_0_AMT' => 100,
		    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
		    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
		    'PAYMENTREQUEST_0_ITEMAMT' => 100,
		 
		    'L_PAYMENTREQUEST_0_NAME0' => 'Demo',
		    'L_PAYMENTREQUEST_0_DESC0' => 'Assign Demo',
		    'L_PAYMENTREQUEST_0_QTY0' => 1,
		    'L_PAYMENTREQUEST_0_AMT0' => 100,

		    'L_BILLINGTYPE0' => 'RecurringPayments',
		    'L_BILLINGAGREEMENTDESCRIPTION0' => 'Example',
		 
		    'CANCELURL' => 'http://localhost/cancel.html',
		    'RETURNURL' => base_url('payment/test2')
		)));
		 
		$response =    curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
		    $query = array(
		        'cmd'    => '_express-checkout',
		        'token'  => $nvp['TOKEN']
		    );

		    $redirectURL = sprintf('https://www.sandbox.paypal.com/cgi-bin/webscr?%s', http_build_query($query));

		    header('Location: ' . $redirectURL);
		} else {
		    //Opz, alguma coisa deu errada.
		    //Verifique os logs de erro para depuração.
		} 
	}

	public function complete($package_id){
		if(!empty($_GET['token']) && !empty($_GET['PayerID'])){
			$amount = 15.00;
			if($package_id=='all'){
				$amount = 45.00;
			}


			//Check payment information here
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
			    'USER' => $this->APIUsername,
			    'PWD' => $this->APIPassword,
			    'SIGNATURE' => $this->APISignature,
			    'METHOD' => 'CreateRecurringPaymentsProfile',
			    'VERSION' => '108',
			    'TOKEN' => $_GET['token'],
			    'PayerID' => $_GET['PayerID'],
			    'PROFILESTARTDATE' => Date('Y-m-d H:i:s'),
			    'DESC' => 'Arimaccabi Payment',
			    'BILLINGPERIOD' => 'Month',
			    'BILLINGFREQUENCY' => '1',
			    'AMT' => $amount,
			    'CURRENCYCODE' => 'USD',
			    'COUNTRYCODE' => 'USA',
			    'MAXFAILEDPAYMENTS' => 3
			)));
			 
			$response =    curl_exec($curl);
			curl_close($curl);
			$nvp = array();
			if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
			    foreach ($matches['name'] as $offset => $name) {
			        $nvp[$name] = urldecode($matches['value'][$offset]);
			    }
			}
			if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
			    if(strtolower($package_id=='all')){
			    	$res = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    				if(empty($res)){
    					$res2 = $this->common_model->get_data('packages_purchase',array('Package_Id!='=>'all','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'));
    					$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
    					//Suspend the previous plans first
    					if(!empty($res2)){
    						foreach($res2 as $ress){
    							$result = $this->paypal->cancel_recurring($ress['Transaction_Id']);
    							if($result['status']){
    								$packageInfo = $this->common_model->get_data('programs',array('Program_Id'=>$ress['Package_Id']),'single');
    								$this->common_model->update_data('packages_purchase',array('Active'=>'no'),array('Transaction_Id'=>$ress['Transaction_Id']));
    								//Mail to User
					                // $data['subject'] = $this->lang->line('plan_deactivate_mail_to_customer_subject');
					                // $data['message'] = $this->lang->line('plan_deactivate_mail_to_customer_body');
					                // $replaceto       = array("__USERNAME", "__PLAN_NAME");
					                // $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$packageInfo['Program_Name']);
					                // $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
					                // $view_content    = $this->load->view('email_template', $data, true);
					                // send_email($userInfo['User_Email'], $data['subject'], $view_content);
    							}
    						}
    					}
    					$insert_payment_details = array(
							'Package_Id'=>$package_id,
							'Customer_Id'=>$this->session->userdata('User_Id'),
							'Transaction_Id'=>$nvp['PROFILEID'],
							'P_Type' => 'All',
							'Created_Date' => date('Y-m-d H:i:s'),
							'Active' => 'yes'
						);
						$this->common_model->insert_data('packages_purchase',$insert_payment_details);
						//Mail to User
		                $data['subject'] = $this->lang->line('plan_buy_mail_to_customer_subject');
		                $data['message'] = $this->lang->line('plan_buy_mail_to_customer_body');
		                $replaceto       = array("__USERNAME", "__PLAN_NAME");
		                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],'Mega Plan');
		                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
		                $view_content    = $this->load->view('email_template', $data, true);
		                send_email($userInfo['User_Email'], $data['subject'], $view_content);
						$notification['flash_status']  = true;
            			$notification['flash_title']   = $this->lang->line('success_label');
            			$notification['flash_message'] = 'Payment has been completed successfully.';
            			// print_r($notification);
            			$this->setFlashMessage($notification);
        				redirect('home/payment/payment_success');

    				} else{
    					$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect(base_url('payment/do_payment/'.$package_id));
    				}
			    } else{
			    	$res = $this->common_model->get_data('packages_purchase',array('Package_Id'=>$package_id,'Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
			    	if(empty($res)){
			    		$res2 = $this->common_model->get_data('packages_purchase',array('P_Type'=>'All','Customer_Id'=>$this->session->userdata('User_Id'),'Active'=>'yes'),'single');
    					if(empty($res2)){
    						$userInfo = $this->common_model->get_data('users',array('User_Id'=>$this->session->userdata('User_Id')),'single');
	    					$packageInfo = $this->common_model->get_data('programs',array('Program_Id'=>$package_id),'single');

	    					$insert_payment_details = array(
								'Package_Id'=>$package_id,
								'Customer_Id'=>$this->session->userdata('User_Id'),
								'Transaction_Id'=>$nvp['PROFILEID'],
								'P_Type' => 'Single',
								'Created_Date' => date('Y-m-d H:i:s'),
								'Active' => 'yes'
							);
							$this->common_model->insert_data('packages_purchase',$insert_payment_details);

							$data['subject'] = $this->lang->line('plan_buy_mail_to_customer_subject');
			                $data['message'] = $this->lang->line('plan_buy_mail_to_customer_body');
			                $replaceto       = array("__USERNAME", "__PLAN_NAME");
			                $replacewith     = array($userInfo['User_First_Name'] . " " . $userInfo['User_Last_Name'],$packageInfo['Program_Name']);
			                $data['content'] = str_replace($replaceto, $replacewith, $data['message']);
			                $view_content    = $this->load->view('email_template', $data, true);
			                send_email($userInfo['User_Email'], $data['subject'], $view_content);
							$notification['flash_status']  = true;
	            			$notification['flash_title']   = $this->lang->line('success_label');
	            			$notification['flash_message'] = 'Payment has been completed successfully.';
	            			$this->setFlashMessage($notification);
        					redirect('home/payment/payment_success');

    					} else{
    						$notification['flash_status']  = false;
	            			$notification['flash_title']   = $this->lang->line('error_label');
	            			$notification['flash_message'] = 'You have alreday a max plan.';
	            			$this->setFlashMessage($notification);
	            			redirect(base_url('payment/do_payment/'.$package_id));
    					}
			    	} else{
			    		$notification['flash_status']  = false;
            			$notification['flash_title']   = $this->lang->line('error_label');
            			$notification['flash_message'] = 'You have alreday activated this plan';
            			$this->setFlashMessage($notification);
	        			redirect(base_url('payment/do_payment/'.$package_id));
			    	}
			    }
			} else{
				$notification['flash_status']  = false;
				$notification['flash_title']   = $this->lang->line('error_label');
				$notification['flash_message'] = 'Payment information is incorrect.';
				$this->setFlashMessage($notification);
				redirect(base_url('payment/do_payment/'.$package_id));
			}
		} else{
			$notification['flash_status']  = false;
			$notification['flash_title']   = $this->lang->line('error_label');
			$notification['flash_message'] = 'You are trying to make indirect payment.';
			$this->setFlashMessage($notification);
			redirect(base_url('payment/do_payment/'.$package_id));
		}	
		// Array ( [PROFILEID] => I-HHC7KJX5CJHG [PROFILESTATUS] => ActiveProfile [TIMESTAMP] => 2018-08-20T16:52:31Z [CORRELATIONID] => 5e4cbd1cc19a [ACK] => Success [VERSION] => 108 [BUILD] => 46457558 )
	}
}