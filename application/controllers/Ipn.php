<?php

require_once APPPATH.'third_party/paypal/PaypalRecurringPaymentProfile.php';

require_once APPPATH.'third_party/paypal/gencc.php';

defined('BASEPATH') or exit('No direct script access allowed');

class Ipn extends MY_Controller

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

        // $this->auth->is_login();	

       	$this->config->load('paypal_sample');

		$this->APIUsername = $this->config->item('APIUsername');

		$this->APIPassword = $this->config->item('APIPassword');

		$this->APISignature = $this->config->item('APISignature');

		$this->APIVersion = $this->config->item('APIVersion');

		$this->Sandbox = $this->config->item('Sandbox');

		$this->Currency = $this->config->item('Currency');		

    }



	public function notify(){

		if(isset($_POST) && !empty($_POST)){

			$this->load->library('paypal');

			$result = $this->paypal->verify_ipn($_POST);

			send_email('sameer.kakkar.38@gmail.com', 'Paypal Ipn', json_encode($_POST));


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

}

