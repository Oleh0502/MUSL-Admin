
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
            

            <form method="post" class="form-horizontal" id="forgot_form_div" action="<?php echo base_url('register/change_password'); ?>" >
                <div class="musl-login">Change Password</div>
                <div class="form-group row">
                    <div class="col-md-12" style="height: 55px;">
                        <input class="form-control" type="hidden" id="User_Id" name="User_Id" value="<?php echo $User_Id; ?>">
                        <input class="form-control" type="text" id="User_Password" name="User_Password" placeholder="New Password" >
                        <label class="error" for="User_Password" id="User_Password-error">
                        </label>
                    </div>
                </div>
               
                <div>
                    <button type="submit" class="musl-login-button ml-0 mb-3">Submit</button>
                </div>
                
            </form>

            <!-- <a href="#" class="forgot">Forgot Username?</a> -->
        </div>
    </div>

</div>