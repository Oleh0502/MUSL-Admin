<div>
    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        <div class="brand">
          <img class="brand-img" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="...">
          <h2 class="brand-text"></h2>
        </div>

        <div class="alert alert-success alert-dismissable alert-red" style="display:none">
            <a href="javascript:void(0);" class="close" data-hide="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <span id="common_success">Indicates a successful or positive action.</span>
            </div>

            <div class="alert alert-danger alert-dismissable alert-green" style="display:none">
            <a href="javascript:void(0);" class="close" data-hide="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <span id="common_error">Indicates a successful or positive action.</span>
       </div>
       <div id="login_form_div">
        <p>Sign into your account</p>
        <form  method="post" id="login_form">
         
          <div class="form-group">
            <label class="sr-only" for="inputEmail">Email</label>
            <input type="email" class="form-control" id="User_Email" name="User_Email" placeholder="Email" value="<?php echo set_value('User_Email') ?>">
            <label class="error" for="User_Email"><?php echo form_error('User_Email'); ?></label>
          </div>
          <div class="form-group">
            <label class="sr-only" for="inputPassword">Password</label>
            <input type="password" class="form-control" name="User_Password" id="User_Password"
              placeholder="Password">
              <label class="error" for="User_Password"><?php echo form_error('User_Password'); ?></label>
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
              <input type="checkbox" id="inputCheckbox" name="remember">
              <label for="inputCheckbox">Remember me</label>
            </div>
            <a class="float-right" href="javascript:;" onclick="$('#login_form_div').hide(); $('#forgot_form_div').show();">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
        <!-- <p>Still no account? Please go to <a href="register.html">Register</a></p> -->
      </div>
      <div id="forgot_form_div" class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out" style="display: none">
      <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        <h2>Forgot Your Password ?</h2>
        <p>Input your registered email to reset your password</p>
        
        <form class="forget-form" id="forgot_form" method="post">
          <div class="form-group">
            <input type="email" class="form-control"  name="User_Email_forgot" id="User_Email_forgot" placeholder="Your Email">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Reset Your Password</button>
          </div>
          <a class="float-right" href="javascript:;" onclick="$('#login_form_div').show(); $('#forgot_form_div').hide();">Back</a>
        </form>
      </div>
    </div>


       <footer class="page-copyright page-copyright-inverse">
         <!--  <p>Admin Panel Created By <a href="https://www.keendevelopers.com">Keen Developers</a></p>
          <p>© 2018. All RIGHT RESERVED.</p> -->
          <div class="social">
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-twitter" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-facebook" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-dribbble" aria-hidden="true"></i>
        </a>
          </div>
        </footer>

      </div>
    </div>
    <!-- End Page -->
