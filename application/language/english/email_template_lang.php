<?php



///////////////////////////////////////////STUDENT REGISTRATION///////////////////////////////

//Customer registration email before verification

$lang['customer_register_subject_temp'] = 'Account Verification';
$lang['customer_register_body_temp'] = 'Thanks for registering with '.WEBSITE_NAME_EMAIL.'.<br/><br/> Before you can start, please click on the link below for account verification. <br/><br/><a href="activationlink__">activationlink__</a><br/><br/>Still have any questions, simply go to our <a href="'.CONTACT_PAGE_LINK.'">Contact</a> page to submit a message. <br /><br />Thanks<br/><b>'.WEBSITE_NAME_EMAIL.'</b>';

//customer register email to admin
$lang['customer_reg_subject_for_admin'] = 'New Customer Registration';
$lang['customer_reg_body_for_admin'] = 'Hello Admin,<br/><br/>A new Customer has been registered with '.WEBSITE_NAME_EMAIL.'.<br/><br/>The details of the account are given below:<br/><br/><b>Name:</b> userfirstname__<br/><b>Email : </b> email__<br/><br/><b>Contact:</b> mobilecontact__<br/><br/><a href="'.DASHBOARDLINK.'">Click</a> here to see the Customer details.<br/><br/><b>'.WEBSITE_NAME_EMAIL.'</b>';

//Forgot password email
$lang['forgot_password_subject_temp'] = 'New Account Password Requested';
$lang['forgot_password_body_temp'] = 'We received a request to reset the password associated with this email address.<br/><br/>
If you made this request, please click the button below to reset your password.<br/><br/>
If you did not request to have your password reset, you can safely ignore this email. Be assured your account is safe.<br/><br/>
<a href="resetlink__">Reset Password</a><br/><br/>Thanks<br/><b>'.WEBSITE_NAME_EMAIL.'</b>';

//Customer register complete email
$lang['customer_register_complete_subject_temp'] = 'Account Registered';
$lang['customer_register_complete_body_temp'] = 'Your account has been created by '.WEBSITE_NAME_EMAIL.'.<br/><br/>Simply go to login page and Login with your<b> Username / Email </b> and <b>Password</b> to access your account.<br/><br/>

Still have any questions, simply go to our <a href="'.CONTACT_PAGE_LINK.'">Contact</a> page to submit a message. <br /><br />Thanks<br/><b>'.WEBSITE_NAME_EMAIL.'</b>';//<a href="loginlink__">Click here for login</a><br/><br/>


