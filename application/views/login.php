
<!-- <div class="top">
    <div class="login_logo">
          <img class="brand-img" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="...">
    </div>
</div> -->
<style type="text/css">
	.form-group {
     margin-bottom: 0; 
}
</style>

<div class="content">
    <div class="m-auto">
        <!-- <div class="musl-login">Login</div> -->
        <div class="">
        	<div class="form-group">
        		<div class="alert alert-success alert-dismissable alert-red" style="display:none">
                    <a href="javascript:void(0);" class="close" data-hide="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <span id="common_success">Indicates a successful or positive action.</span>
                </div>

                <div class="alert alert-danger alert-dismissable alert-green" style="display:none">
                    <a href="javascript:void(0);" class="close" data-hide="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <span id="common_error">Indicates a successful or positive action.</span>
                </div>
        	</div>
            <form method="post" class="form-horizontal" id="login_form_div">
                <div class="musl-login">Login</div>
                <div class="form-group row">
                    <div class="col-md-12" style="height: 55px;">
                        <input class="form-control" type="text" id="User_Email" name="User_Email" placeholder="Email" value="<?php echo set_value('User_Email') ?>">
                        <label class="error" for="User_Email">
                            <?php echo form_error('User_Email'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="height: 55px;">
                        <input type="password" class="form-control" name="User_Password" id="User_Password" placeholder="Password">
                        <label class="error" for="User_Password">
                            <?php echo form_error('User_Password'); ?>
                        </label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="musl-login-button ml-0 mb-3">Submit</button>
                </div>
                <a class="forgot" href="javascript:;" onclick="$('#login_form_div').hide(); $('#forgot_form_div').show();">Forgot Password?</a>
            </form>

            <form method="post" class="form-horizontal" id="forgot_form_div" action="<?php echo base_url('login/forgot'); ?>" style="display: none">
                <div class="musl-login">Forgot Password</div>
                <div class="form-group row">
                    <div class="col-md-12" style="height: 55px;">
                        <input class="form-control" type="text" id="User_Email_forgot" name="User_Email_forgot" placeholder="Email" >
                        <label class="error" for="User_Email_forgot" id="User_Email_forgot-error">
                        </label>
                    </div>
                </div>
               
                <div>
                    <button type="submit" class="musl-login-button ml-0 mb-3">Submit</button>
                </div>
                <a class="forgot" href="javascript:;" onclick="$('#login_form_div').show(); $('#forgot_form_div').hide();">< Back</a>
            </form>

            <!-- <a href="#" class="forgot">Forgot Username?</a> -->
        </div>
    </div>

</div>