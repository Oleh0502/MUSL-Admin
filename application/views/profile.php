
<style type="text/css">
    
#profileform{margin-top:15px;font-size:16px;}

#profileform .formLabels{font-size:16px;}

#profileform .form-control{font-size:15px;height:40px !important;background:#fff;}

#profileform .bootstrap-select>.dropdown-toggle{height:40px !important;}

#profileform>[class*='col-']{padding-left:0;}

#profileform .field_container{height:57px;margin-bottom:0 !important;}

.profilepic_main{border:1px dashed #ddd;width:100%;padding:0;}

.profimg_wrapper{height:110px;width:110px;position:relative;margin:15px auto;display:block;}

.profilepic_main .profilepic_container{height:100%;width:100%;overflow:hidden;position:relative;border-radius:50%!important;

border:1px solid #ddd;}

.drag_section{padding-right:0 !important;background:#f7f7f7;}

.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {

background: #3fbfc7 !important;}
.Upload_separator{display: inline-block;background: #eaeaea;padding: 10px;border-radius: 50%!important;position: absolute;

left: 50%;z-index: 1000;transform: translate(-50%,-50%);color: #939393;top: 50%;cursor: default;font-size: 14px;}

.profilepic_main .profilepic_container .profile_img{position:absolute;margin:auto;top:0;right:0;bottom:0;left:0;

max-width:100%;}

.profilepic_main .cam_icon{position: absolute;bottom: -5px;left: 50%;transform: translateX(-50%);font-size: 16px;

color: #3fbfc7;z-index: 1000;padding:9px;background: #fff;border-radius: 30px!important;border: 1px solid #3fbfc7;}

.profpic_btncontainer {display:inline-block;text-align:center;margin:30px 0;}

#profile_pic{position:absolute;width:100%;height:200px;top:-50px;left:0;z-index:2;opacity:0;cursor:pointer;
}

.profpic_btncontainer .profile_upload{color: #3fbfc7;border: 1px solid #3fbfc7;padding: 8px 15px;max-width: 150px;

width: 100%;border-radius: 30px!important;display: inline-block;text-align: center;cursor: pointer;}

.profpic_btncontainer .profileup_desc{font-size:14px;color:#939393;display:block;margin:10px 0;}

.dragdrop_container{text-align:center;width:100%;padding: 19px 0;color:#d8d8d8 !important;

cursor:pointer;    height: 140px;}

 .dragdrop_container i{   margin-top: 25px;}

.dragdrop_container h4{color:#939393 !important;}

#rep_save{margin-top:15px;}

#rep_save .create_btn{width:auto !important;padding: 12px 25px;}

.prescription_hist{ color: black;font-size: 25px;position: relative;text-align: center;
}

.prescription_hist::after {background: #3fbfc7 none repeat scroll 0 0;bottom: 0;content: "";height: 2px;left: 0;margin: auto;position: absolute;right: 0;width: 100px; top: 40px;
}

.custom_bg_section{background: #fafafa none repeat scroll 0 0;border-top: 1px solid #ddd; float: left; margin: 20px 0;overflow: auto; padding: 10px 20px; width: 100%;
}

.separator{margin: 40px -30px 5px;border-top: 2px solid #cfcfcf;display: block;clear: both;}

#profileform input[type="text"],#profileform input[type="email"],#profileform input[type="tel"],

#profileform input[type="password"]{background-color: white;

background-image: url("../../assets/img/profileuser1.png");background-position: 96% 50%; 

background-repeat: no-repeat;padding-right:35px;}

#profileform input[type="email"]{background-image: url("../../assets/img/profilemail.png");

background-position: 98% 50%;}

#profileform input[type="tel"]{background-image: url("../../assets/img/profiletel.png");

background-position: 98% 50%;}

#profileform input[type="password"]{background-image: url("../../assets/img/profilepass.png");}

</style>

<!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
        	<!-- BEGIN PAGE BAR -->
	        <div class="page-bar" style="margin-bottom: 20px;">
	            <ul class="page-breadcrumb">
	                <li>
	                    <a href="<?php echo base_url(); ?>">Home</a>
	                    <i class="fa fa-circle"></i>
	                </li>
	                <li>
	                    <span>Customers</span>
	                </li>
	            </ul>
	        </div>
	        <!-- END PAGE BAR -->
			
			<div class="row">
				<div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                        <?php if($userdata['User_Image'] == ''){ ?>
                                            <img src="<?php echo base_url('assets/images/profile_pics/dummy_user.png'); ?>" class="img-responsive" alt="">
                                        <?php }else{ ?>
                                             <img src="<?php echo base_url('assets/images/profile_pics/').$userdata['User_Image']; ?>" class="img-responsive" alt="">
                                        <?php } ?>
                                         </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php echo $userdata['User_First_Name'].' '.$userdata['User_Last_Name']; ?></div>
                                            <div class="profile-usertitle-job"> <?php echo $userdata['User_Name']; ?> </div>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                        <!-- SIDEBAR BUTTONS -->
                                        <div class="profile-userbuttons">
                                            <button type="button" class="btn btn-circle blue btn-sm"><i class="fa fa-envelope"></i> <?php echo $userdata['User_Email']; ?></button>
                                            <br/>
                                            <button type="button" style="margin: 10px 0;" class="btn btn-circle red btn-sm"><i class="fa fa-phone"></i> <?php echo $userdata['User_Phone']; ?></button>
                                            <?php if(isset($userdata['User_Skype']) && !empty($userdata['User_Skype'])){ ?>
                                            <button type="button" style="margin: 10px 0;" class="btn btn-circle green btn-sm"><i class="fa fa-skype"></i> <?php echo $userdata['User_Skype']; ?></button>
                                            <?php } ?>


                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->
                                        <!-- SIDEBAR MENU -->
                                       <!--  <div class="profile-usermenu">
                                            <ul class="nav">
                                                <li>
                                                    <a href="page_user_profile_1.html">
                                                        <i class="icon-home"></i> Overview </a>
                                                </li>
                                                <li class="active">
                                                    <a href="page_user_profile_1_account.html">
                                                        <i class="icon-settings"></i> Account Settings </a>
                                                </li>
                                                <li>
                                                    <a href="page_user_profile_1_help.html">
                                                        <i class="icon-info"></i> Help </a>
                                                </li>
                                            </ul>
                                        </div> -->
                                        <!-- END MENU -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                    <!-- PORTLET MAIN -->
                                  <!--   <div class="portlet light ">
                                        <div class="row list-separated profile-stat">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 37 </div>
                                                <div class="uppercase profile-stat-text"> Projects </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 51 </div>
                                                <div class="uppercase profile-stat-text"> Tasks </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 61 </div>
                                                <div class="uppercase profile-stat-text"> Uploads </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-globe"></i>
                                                <a href="http://www.keenthemes.com/">www.keenthemes.com</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-twitter"></i>
                                                <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-facebook"></i>
                                                <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Personal Info</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_2" data-toggle="tab" aria-expanded="false">Change Avatar</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_3" data-toggle="tab" aria-expanded="false">Change Password</a>
                                                        </li>
                                                       <!--  <li class="">
                                                            <a href="#tab_1_4" data-toggle="tab" aria-expanded="false">Privacy Settings</a>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <form role="form" id="profile_info_form">
                                                                <div class="form-group">
                                                                    <label class="control-label">First Name</label>
                                                                    <input type="text" placeholder="John" class="form-control required" name="User_First_Name" value="<?php echo $userdata['User_First_Name']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <input type="text" placeholder="Doe" class="form-control required" name="User_Last_Name" value="<?php echo $userdata['User_Last_Name']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Mobile Number</label>
                                                                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control required" name="User_Phone" value="<?php echo $userdata['User_Phone']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="email" placeholder="example@domain.com" class="form-control required" name="User_Email" value="<?php echo $userdata['User_Email']; ?>"> </div>
<!--                                                                 <div class="form-group">
                                                                    <label class="control-label">Company</label>
                                                                    <input type="text" placeholder="Company Name" class="form-control required" name="Company" value="<?php echo $userdata['Company']; ?>"> </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label">Address 1</label>
                                                                    <input type="text" placeholder="Address Line 1" class="form-control required" name="Address1" value="<?php echo $userdata['Address1']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Address 2</label>
                                                                    <input type="text" placeholder="Address Line 1" class="form-control required" name="Address2" value="<?php echo $userdata['Address2']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">City / Town</label>
                                                                    <input type="text" placeholder="City Name" class="form-control required" name="City" value="<?php echo $userdata['City']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">State / Province</label>
                                                                    <input type="text" placeholder="State Name" class="form-control required" name="State" value="<?php echo $userdata['State']; ?>"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Country / Territory</label>

                                                                    <select class="bs-select form-control required" name="Country" id="Country" data-live-search="true">
                                                                        <?php 
                                                                            if(!empty($countries))
                                                                            {
                                                                                foreach($countries as $cont)
                                                                                {
                                                                                    $selected = $cont['id'] == $userdata['Country']? 'selected':'';

                                                                                    ?>
                                                                            <option value="<?php echo $cont['id']; ?>" <?php echo $selected; ?>><?php echo $cont['name']; ?></option>
                                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                        </select>
                                                                     </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Zipcode/Postal Code</label>
                                                                    <input type="text" placeholder="Country" class="form-control required" name="Zipcode" value="<?php echo $userdata['Zipcode']; ?>"> </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Skype ID</label>
                                                                    <input type="text" placeholder="Skype Id" class="form-control required" name="User_Skype" value="<?php echo $userdata['User_Skype']; ?>"> </div>

                                                                <div class="margiv-top-10 text-center">
                                                                   <!--  <a href="javascript:;" class="btn green"> Save Changes </a> -->
                                                                   <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save Changes </span> </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                                eiusmod. </p>
                                                            <form role="form" id="update_picture_form">
                                                                <div class="form-group">


                                                                    <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="formLabels">Upload Your Profile Photo</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilepic_main">
                                        <div class="Upload_separator">OR</div>                                  
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-5 pro_container">
                                                <div class="profimg_wrapper">
                                                    <span class="fa fa-camera cam_icon"></span>
                                                    <div class="profilepic_container">              
                                                        <img src="<?php echo GetProfilePic(); ?>" alt="" class="profile_img" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-7 pro_container">
                                                <div class="profpic_btncontainer">
                                                    <span class="profile_upload">Choose a file</span>
                                                    <span class="profileup_desc">PNG, JPG or GIF, max. 3MB</span>
                                                    
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 drag_section">
                                            <div class="dragdrop_container uploader">
                                                <i class="fa fa-cloud-download fa-4x"></i>
                                                <h4>Drag & Drop File</h4>
                                                <input type="file" class="profile_pic_cls" name="profile_pic" id="profile_pic"  ><!--style="display:none"   -->
                                            </div>
                                        </div>
                                    </div>                                          
                                </div>      
                                <label id="profile_pic-error"  class="error" for="profile_pic"><?php echo form_error('profile_pic'); ?></label>                                             
                            </div>

                                                                  
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-danger">NOTE!</span>
                                                                        <span> Please upload an image with dimenstions 200 x 200 px and of JPG, JPEG or PNG Format</span>
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10 text-center">
                                                                    <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save ChangeS </span> </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane" id="tab_1_3">
                                                            <form id="change_password_form">
                                                                <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <input type="password" class="form-control required" id="CurrentPassword" name="CurrentPassword"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" class="form-control required" id="Password" name="Password"> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" class="form-control required" id="ConfirmPassword" name="ConfirmPassword"> </div>
                                                                <div class="margin-top-10 text-center">
                                                                    <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Change Password </span> </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->
                                                        <!-- PRIVACY SETTINGS TAB -->
                                                        <div class="tab-pane" id="tab_1_4">
                                                            <form action="#">
                                                                <table class="table table-light table-hover">
                                                                    <tbody><tr>
                                                                        <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option2" checked=""> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option2" checked=""> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option2" checked=""> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option2" checked=""> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                                <!--end profile-settings-->
                                                                <div class="margin-top-10 text-center">
                                                                    <a href="javascript:;" class="btn red"> Save Changes </a>
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PRIVACY SETTINGS TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
			</div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
                    
                    
                    
                    
                    
                    
                    
                    
                    
                        