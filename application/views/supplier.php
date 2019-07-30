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
	                    <span>Suppliers</span>
	                </li>
	            </ul>
	        </div>
	        <!-- END PAGE BAR -->
			<!-- begin #content -->
	            <?php
	            if($this->auth->has_permission('manage-supplier','View'))
	            {
	                ?>
	                <div class="row">             
	                    <!-- begin col-10 -->
	                    <div class="col-md-12">
	                       <!-- BEGIN Portlet PORTLET-->
	                        <div class="portlet box blue">
	                            <div class="portlet-title">
	                                <div class="caption">Supplier List</div>
	                                <div class="tools">
	                                    <a href="javascript:;" class="collapse"> </a>
	                                    <a href="javascript:;" class="reload"> </a>
	                                    <a href="#" class="fullscreen"> </a>
	                                </div>
                                    <div class="actions">
                                    	<a data-toggle="modal" href="#add_customer" class="btn btn-default btn-sm">
                                        <i class="fa fa-plus"></i> Add New</a>
                                    </div>
	                            </div>
	                            <div class="portlet-body">
	                            	<table id="user_datatable" class="table table-striped table-bordered display nowrap dt-responsive  custom_table" width="100%">
	                                    <thead>
	                                        <tr>
	                                            <th>Business Name</th>
	                                            <!-- <th>Last Name</th> -->
	                                            <th>Email</th>
	                                            <th>Contact</th>
	                                            <!-- <th>Company Name</th> -->
	                                            <th>Created Date</th>
                                                <th>Subscription Status</th>
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
	                <!-- end row -->
	                <?php
	            } ?>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
         <!-- responsive -->
    <div id="add_customer" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">Add Supplier</div>
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
                                        <label class="control-label">Business Name <span>*</span></label>
                                        <input type="text" name="Company" id="Company" class="form-control" placeholder="Business name">
                                    </div> 
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-grp">
                                        <label class="control-label">Select Category <span>*</span></label>
                                        <select class="bs-select form-control required selectpicker" name="Business_Category" id="Business_Category" data-live-search="true" >
                                            <option value="">Select Items</option>
                                        <?php 
                                            if(!empty($items))
                                            {
                                                foreach($items as $item)
                                                {
                                                    ?>
                                                    <option value="<?php echo $item['Item_Id']; ?>"><?php echo $item['Item_Title']; ?></option>
                                                        <?php
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div> 
                                </div>

                    			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                </div> -->
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
                        <div class="caption">Edit Supplier</div>
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
                    			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                </div> -->

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Business Name <span>*</span></label>
                                        <input type="text" name="edit_Company" id="edit_Company" class="form-control" placeholder="Business name">
                                    </div> 
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-grp">
                                        <label class="control-label">Select Category <span>*</span></label>
                                        <select class="bs-select form-control required selectpicker" name="edit_Items" id="edit_Items" data-live-search="true" >
                                            <option value="">Select Items</option>
                                        <?php 
                                            if(!empty($items))
                                            {
                                                foreach($items as $item)
                                                {
                                                    ?>
                                                    <option value="<?php echo $item['Item_Id']; ?>"><?php echo $item['Item_Title']; ?></option>
                                                        <?php
                                                }
                                            }
                                        ?>
                                        </select>
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
                        <div class="caption">View Supplier</div>
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
                    			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                </div> -->

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Business Name <span>*</span></label>
                                        <input type="text" name="view_Company" id="view_Company" class="form-control" placeholder="Business name">
                                    </div> 
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group form-grp">
                                        <label class="control-label">Select Category <span>*</span></label>
                                        <select class="bs-select form-control required selectpicker" name="view_Items" id="view_Items" data-live-search="true" >
                                            <option value="">Select Items</option>
                                        <?php 
                                            if(!empty($items))
                                            {
                                                foreach($items as $item)
                                                {
                                                    ?>
                                                    <option value="<?php echo $item['Item_Id']; ?>"><?php echo $item['Item_Title']; ?></option>
                                                        <?php
                                                }
                                            }
                                        ?>
                                        </select>
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
                               <!--  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Company">Company <span>*</span></label>
                                        <input readonly type="text" name="Company" id="view_Company" class="form-control" placeholder="Company">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Address1">Address 1 <span>*</span></label>
                                        <input readonly type="text" name="Address1" id="view_Address1" class="form-control" placeholder="Address 1">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Address2">Address 2 <span>*</span></label>
                                        <input readonly type="text" name="Address2" id="view_Address2" class="form-control" placeholder="Address 2">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="City">City <span>*</span></label>
                                        <input readonly type="text" name="City" id="view_City" class="form-control" placeholder="City">
                                    </div> 
                               	</div>
                               	<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="State">State <span>*</span></label>
                                        <input readonly type="text" name="State" id="view_State" class="form-control" placeholder="State">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Country">Country <span>*</span></label>
                                        <input readonly type="text" name="Country" id="view_Country" class="form-control" placeholder="Country">
                                    </div> 
                               	</div>
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Zipcode">Zip or Postcode <span>*</span></label>
                                        <input readonly type="text" name="Zipcode" id="view_Zipcode" class="form-control" placeholder="Zipcode">
                                    </div> 
                               	</div> -->
                               	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Phone">Phone Number<span>*</span></label>
                                        <input readonly type="text" name="User_Phone" id="view_User_Phone" class="form-control" placeholder="Phone Number">
                                    </div> 
                               	</div>
								<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="User_Name">User Name<span>*</span></label>
                                        <input readonly type="text" readonly name="view_User_Name" id="view_User_Name" class="form-control" placeholder="User Name">
                                    </div> 
                               	</div> -->
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
    <!-- Subscription form -->


    <div id="subscription_modal" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" >
                    <div class="portlet-title">
                        <div class="caption">Subscription Form</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form id="subscription_form">
                            <input type="hidden" value="" name="Subs_User_Id" id="Subs_User_Id">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-grp">
                                        <label class="control-label">Select Package <span>*</span></label>
                                        <select class="bs-select form-control required selectpicker" name="Package_Id" id="Package_Id" data-live-search="true" >
                                            <option value="">Select Package</option>
                                        <?php 
                                            if(!empty($packages))
                                            {
                                                foreach($packages as $item)
                                                {
                                                    ?>
                                                    <option value="<?php echo $item['Package_Id']; ?>"><?php echo $item['Package_Name'].'( $'.$item['Package_Price'].' For '.$item['Package_Duration'].' '.$item['Duration_Type'].' )'; ?></option>
                                                        <?php
                                                }
                                            }
                                        ?>
                                        </select>
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