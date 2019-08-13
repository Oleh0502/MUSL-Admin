<?php

if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}

function verificationcode()
{
    $string           = "1234567890";
    $string_shufffled = str_shuffle($string);
    $code             = substr($string_shufffled, 1, 5);
    return $code;
}

function GetProfilePic()
{
    if (isset($_SESSION['User_Image']) && !$_SESSION['User_Image'] == '') {
        if (!file_exists(FCPATH . "assets/images/profile_pics/" . @$_SESSION['User_Image'])) {
            $profile_pic = base_url('assets/images/profile_pics/dummy_user.png');
        } else {
            $profile_pic = base_url('assets/images/profile_pics/') . @$_SESSION['User_Image'];
        }
    } else {
        $profile_pic = base_url('assets/images/profile_pics/dummy_user.png');
    }

    return $profile_pic;
}

function get_date_format($date)
{
    if ($date == '0000-00-00 00:00:00') {
        return "N/A";
    } else {
        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $newDateString = $myDateTime->format('d-m-Y');
    }
}

function get_formatted_items($items)
{
    $return = '<ul>';
    if($items){
        foreach ($items as $key => $value) {
            $return .= '<li>'.$value['Item_Title'].'</li>';
        }
    }
    $return .= '</ul>';
    return $return;
}


function get_date_format_without_min($date)
{

    if ($date == '0000-00-00 00:00:00') {

        return "N/A";

    } else {

        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        return $newDateString = $myDateTime->format('d-m-Y');

    }

}

function set_date_format($date)
{

    if ($date == '00-00-0000') {

        return "N/A";

    } else {

        $myDateTime = DateTime::createFromFormat('d-m-Y', $date);

        return $newDateString = $myDateTime->format('Y-m-d h:i:s');

    }

}

function filter_date($date)
{

    if ($date == '00-00-0000') {

        return false;

    } else {

        $myDateTime = DateTime::createFromFormat('d-m-Y', $date);

        return $newDateString = $myDateTime->format('Y-m-d');

    }

}

function randomPassword()
{

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = array(); //remember to declare $pass as an array

    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

    for ($i = 0; $i < 6; $i++) {

        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];

    }

    return implode($pass); //turn the array into a string

}

//Link generate

function randomLink()
{

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = array(); //remember to declare $pass as an array

    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

    for ($i = 0; $i < 15; $i++) {

        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];

    }

    return implode($pass); //turn the array into a string

}

function search_permission($id, $array)
{
    foreach ($array as $key => $val) {
        if ($val['Perm_Id'] === $id) {
            return true;
        }
    }
    return false;
}

function search_checked($id, $array, $keyword)
{
    foreach ($array as $key => $val) {
        if ($val['Perm_Id'] === $id) {
            if ($val[$keyword] == '1') {
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}

//Send Mail here

/*function send_email($from_email, $from_name, $mail_to, $mail_subject, $mail_content, $attach = "")
{
$CI = &get_instance();
$config['protocol'] = 'sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = true;
$config['mailtype'] = 'html';
$CI->email->initialize($config);
$CI->email->from($from_email, $from_name);
$CI->email->to($mail_to);
$CI->email->subject($mail_subject);
$CI->email->message($mail_content);
$CI->email->set_mailtype('html');
$CI->email->set_newline("\r\n");
if (isset($attach) && !empty($attach)) {
$CI->email->attach($attach);
}
if ($CI->email->send()) {
return true;
} else {
return false;
}
}*/
function send_email($To, $Subject, $Content)
{
    $ci = &get_instance();
    $ci->load->library('email');
    $config = array(
        'charset'  => 'utf-8',
        'wordwrap' => true,
        'mailtype' => 'html',
    );
    $ci->email->initialize($config);
    $ci->email->from(FROM_EMAIL, FROM_NAME);
    $ci->email->to($To);
    $ci->email->subject($Subject);
    $ci->email->message($Content);
    if ($ci->email->send()) {
        return true;
    } else {
        return log_message('info', $ci->email->print_debugger());
    }
}
//User profile check

function image_exist($image)
{

    if (!file_exists($image)) {

        return base_url(DEFAULT_IMAGE);

    } else {

        return base_url($image);

    }

}
