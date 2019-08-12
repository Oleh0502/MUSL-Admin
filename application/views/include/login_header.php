<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/fonts/font-awesome/font-awesome.css'); ?>">
    <link rel="stylesheet" href="assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/css/styles.css">

    <link href="<?php echo base_url('assets/global/vendor/jquery-confirm/css/jquery-confirm.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/global/vendor/jquery-notific8/jquery.notific8.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/custom/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/global/vendor/img-zoom/imgzoom.css'); ?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
	.musl-header {
    display: flex;
    background-image: url("assets/images/header_bkg.jpg");
    width: 100%;
    height: 113px;
}
</style>
</head>
<script type="text/javascript">
    var ajax_url = '<?php echo base_url(); ?>';
</script>
<body>
	<div class="header musl-header w-100">
    <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="musl-logo m-auto">
</div>
<?php
    $ControllerName = $this->router->class;
    $FunctionName   = $this->router->method;
    $usertype = @$usertype;
?>
<?php
	if(isset($_SESSION['User_Id']) && !empty($_SESSION['User_Id'])){
 ?>
    <div class="musl-menu border-bottom d-flex w-100">
        <div class="musl-margin-left mt-auto mb-auto">
            <a href="<?php echo base_url('user_administrator'); ?>" class="musl-link musl-font-bold <?php echo $ControllerName=='user_administrator'? 'font-weight-bold':''; ?> ">User Administrator</a>
        </div>
        <div class="m-l-20 mt-auto mb-auto">
            <a href="<?php echo base_url('user_reporting'); ?>" class="musl-link <?php echo $ControllerName=='user_reporting'? 'font-weight-bold':''; ?> ">User Reporting</a>
        </div>
        <div class="m-l-20 mt-auto mb-auto">
        <a class="m-l-20 mt-auto mb-auto" href="<?php echo base_url('logout'); ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
    </div>
    </div>
    <?php } ?>