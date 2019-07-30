<!-- BEGIN CONTENT -->
<div class="page">
      <div class="page-header">
        <h1 class="page-title">Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span>Users</span>
            </li>
        </ol>
        <div class="page-header-actions">
          <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
            data-toggle="tooltip" data-original-title="Edit">
            <i class="icon wb-pencil" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
            data-toggle="tooltip" data-original-title="Refresh">
            <i class="icon wb-refresh" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
            data-toggle="tooltip" data-original-title="Setting">
            <i class="icon wb-settings" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <div class="page-content">
        <?php
                if($this->auth->has_permission('manage-users','View'))
                {
                    ?>
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">User View</h3>
                        </div>
                    <div class="panel-body container-fluid">
                    <div class="row">             
                        <!-- begin col-10 -->
                        <div class="col-md-12">
                           <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="#" class="fullscreen"> </a>
                                    </div>
                                    <div class="actions">
                                        <button class="btn btn-default" data-target="#exampleFormModal" data-toggle="modal" type="button"><i class="fa fa-plus"></i> Add New</button>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table id="user_datatable" class="table table-striped table-bordered display nowrap dt-responsive  custom_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <!-- <th>Company Name</th> -->
                                                <th>Created Date</th>
                                                <th width="15%" class="no-sort">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        <!-- end col-10 -->
                    </div>
                    </div>
                    </div>
                    <!-- end row -->
                    <?php
                } ?>
      </div>
</div>

<!-- Modal -->
                    <div class="modal fade" id="exampleFormModal" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
                      role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple">
                        <form class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleFormModalLabel">Set The Messages</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-xl-4 form-group">
                                <input type="text" class="form-control" name="firstName" placeholder="First Name">
                              </div>
                              <div class="col-xl-4 form-group">
                                <input type="email" class="form-control" name="lastName" placeholder="Last Name">
                              </div>
                              <div class="col-xl-4 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                              </div>
                              <div class="col-xl-12 form-group">
                                <textarea class="form-control" rows="5" placeholder="Type your message"></textarea>
                              </div>
                              <div class="col-md-12 float-right">
                                <button class="btn btn-primary btn-outline" data-dismiss="modal" type="button">Add Comment</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- End Modal -->

<!-- responsive -->
<div id="add_customer" class="modal fade" tabindex="-1" data-width="760">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box blue" style="margin-bottom: 0px !important;">
                <div class="portlet-title">
                    <div class="caption">Add User</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="#" class="fullscreen"> </a>
                        <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="add_user">
                			<div class="row">
                    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">First Name <span>*</span></label>
                          				<input type="text" name="User_First_Name" id="User_First_Name" class="form-control" placeholder="First name">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Last Name <span>*</span></label>
                                        <input type="text" name="User_Last_Name" id="User_Last_Name" class="form-control" placeholder="Last name">
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Email">Email <span>*</span></label>
                                        <input type="email" name="User_Email" id="User_Email" class="form-control" placeholder="User email">
                                	</div> 
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Company">Company <span>*</span></label>
                                        <input type="text" name="Company" id="Company" class="form-control" placeholder="Company">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Address1">Address 1 <span>*</span></label>
                                        <input type="text" name="Address1" id="Address1" class="form-control" placeholder="Address 1">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Address2">Address 2 <span>*</span></label>
                                        <input type="text" name="Address2" id="Address2" class="form-control" placeholder="Address 2">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="City">City <span>*</span></label>
                                        <input type="text" name="City" id="City" class="form-control" placeholder="City">
                                    </div> 
                               	</div>
                               	<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="State">State <span>*</span></label>
                                        <input type="text" name="State" id="State" class="form-control" placeholder="State">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Country">Country <span>*</span></label>
                                        <input type="text" name="Country" id="Country" class="form-control" placeholder="Country">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Zipcode">Zip or Postcode <span>*</span></label>
                                        <input type="text" name="Zipcode" id="Zipcode" class="form-control" placeholder="Zipcode">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Phone">Phone Number<span>*</span></label>
                                        <input type="text" name="User_Phone" id="User_Phone" class="form-control" placeholder="Phone Number">
                                    </div> 
                               	</div>
								<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Name">User Name<span>*</span></label>
                                        <input type="text" name="User_Name" id="User_Name" class="form-control" placeholder="User Name">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Password">Password<span>*</span></label>
                                        <input type="password" name="User_Password" id="User_Password" class="form-control" placeholder="Enter Password">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Password_Confirm">Confirm Password<span>*</span></label>
                                        <input type="password" name="User_Password_Confirm" id="User_Password_Confirm" class="form-control" placeholder="Enter Confirm Password">
                                    </div> 
                               	</div>
                            </div>
                            <div class="button_container">                      
                                <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_customer" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">Edit User</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="edit_user">
                			<input type="hidden" value="" name="User_Id" id="User_Id">
                			<div class="row">
                    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">First Name <span>*</span></label>
                          				<input type="text" name="edit_User_First_Name" id="edit_User_First_Name" class="form-control" placeholder="First name">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Last Name <span>*</span></label>
                                        <input type="text" name="edit_User_Last_Name" id="edit_User_Last_Name" class="form-control" placeholder="Last name">
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_User_Email">Email <span>*</span></label>
                                        <input type="email" name="edit_User_Email" id="edit_User_Email" class="form-control" placeholder="User email">
                                	</div> 
                                </div>
                               <!--  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_Company">Company <span>*</span></label>
                                        <input type="text" name="edit_Company" id="edit_Company" class="form-control" placeholder="Company">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_Address1">Address 1 <span>*</span></label>
                                        <input type="text" name="edit_Address1" id="edit_Address1" class="form-control" placeholder="Address 1">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_Address2">Address 2 <span>*</span></label>
                                        <input type="text" name="edit_Address2" id="edit_Address2" class="form-control" placeholder="Address 2">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_City">City <span>*</span></label>
                                        <input type="text" name="edit_City" id="edit_City" class="form-control" placeholder="City">
                                    </div> 
                               	</div>
                               	<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_State">State <span>*</span></label>
                                        <input type="text" name="edit_State" id="edit_State" class="form-control" placeholder="State">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_Country">Country <span>*</span></label>
                                        <input type="text" name="edit_Country" id="edit_Country" class="form-control" placeholder="Country">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_Zipcode">Zip or Postcode <span>*</span></label>
                                        <input type="text" name="edit_Zipcode" id="edit_Zipcode" class="form-control" placeholder="Zipcode">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_User_Phone">Phone Number<span>*</span></label>
                                        <input type="text" name="edit_User_Phone" id="edit_User_Phone" class="form-control" placeholder="Phone Number">
                                    </div> 
                               	</div>
								<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="edit_User_Name">User Name<span>*</span></label>
                                        <input type="text" readonly name="edit_User_Name" id="edit_User_Name" class="form-control" placeholder="User Name">
                                    </div> 
                               	</div> -->
                            </div>
                            <div class="button_container">                      
                                <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="view_customer" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">View User</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="view_user">
                			<!-- <input type="hidden" value="" name="User_Id" id="User_Id"> -->
                			<div class="row">
                    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">First Name <span>*</span></label>
                          				<input readonly type="text" name="User_First_Name" id="view_User_First_Name" class="form-control" placeholder="First name">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Last Name <span>*</span></label>
                                        <input readonly type="text" name="User_Last_Name" id="view_User_Last_Name" class="form-control" placeholder="Last name">
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Email">Email <span>*</span></label>
                                        <input readonly type="email" name="User_Email" id="view_User_Email" class="form-control" placeholder="User email">
                                	</div> 
                                </div>
                               
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="City">City <span>*</span></label>
                                        <input readonly type="text" name="City" id="view_City" class="form-control" placeholder="City">
                                    </div> 
                               	</div>
                               
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Phone">Phone Number<span>*</span></label>
                                        <input readonly type="text" name="User_Phone" id="view_User_Phone" class="form-control" placeholder="Phone Number">
                                    </div> 
                               	</div>
							
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="reset_password_customer" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">Reset Password</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="reset_password_form">
                			<input type="hidden" value="" name="Reset_User_Id" id="Reset_User_Id">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Reset_User_Password">Password<span>*</span></label>
                                        <input type="password" name="Reset_User_Password" id="Reset_User_Password" class="form-control" placeholder="User Password">
                                    </div> 
                               	</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Reset_User_Password_Confirm">Confirm Password<span>*</span></label>
                                        <input type="password" name="Reset_User_Password_Confirm" id="Reset_User_Password_Confirm" class="form-control" placeholder="Confirm Password">
                                    </div> 
                               	</div>
                            </div>
                            <div class="button_container">                      
                                <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>