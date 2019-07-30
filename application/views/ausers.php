<!-- BEGIN CONTENT -->
<div class="page">
      <div class="page-header">
        <h1 class="page-title">Admin users</h1>
        <ol class="breadcrumb">
          	<li class="breadcrumb-item">
	        	<a href="<?php echo base_url(); ?>">Home</a>
	        </li>
	        <li class="breadcrumb-item">
	        	<span>Admin users</span>
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
	            if($this->auth->has_permission('manage-admin','Add') || $this->auth->has_permission('manage-admin','Edit'))
	            {
	                ?>
	                <!-- begin row -->
	                <div class="panel">
	                	<div class="panel-heading">
            				<h3 class="panel-title">Add User</h3>
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
	                            </div>
	                            <div class="portlet-body">
	                            	<form id="add_user">
	                        			<input type="hidden" value="" name="User_Id" id="User_Id">
	                        			<div class="row">
	                            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                                			<div class="form-group form-grp">
	                                    			<label class="control-label">First Name <span>*</span></label>
	                                  				<input type="text" name="User_First_Name" id="User_First_Name" class="form-control" placeholder="First name">
			                                	</div> 
			                                </div>
			                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                                    <div class="form-group form-grp">
			                                        <label class="control-label">Last Name <span>*</span></label>
			                                        <input type="text" name="User_Last_Name" id="User_Last_Name" class="form-control" placeholder="Last name">
			                                	</div> 
			                                </div>
			                            </div>
			                            <div class="row">
			                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                                    <div class="form-group form-grp">
			                                        <label for="User_Email">Email <span>*</span></label>
			                                        <input type="email" name="User_Email" id="User_Email" class="form-control" placeholder="User email">
			                                	</div> 
			                                </div>
			                                     
			                                       
			                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                                    <div class="form-group form-grp">
			                                        <label for="User_Phone">Contact Number <span>*</span></label>
			                                        <input type="text" name="User_Phone" id="User_Phone" class="form-control" placeholder="Contact number">
			                                    </div> 
			                               	</div>
			                            </div>
			                            <div class="row">      
			                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                                    <div class="form-group form-grp">
			                                        <label class=" control-label">Role <span>*</span></label>
			                                        <select class="default-select2 form-control required" name="Role" id="Role">
			                                        <?php 
			                                            if(!empty($roles))
			                                            {
			                                                foreach($roles as $role)
			                                                {
			                                                    ?>
			                                                    <option value="<?php echo $role['Role_Id']; ?>"><?php echo $role['Role_Name']; ?></option>
			                                                        <?php
			                                                }
			                                            }
			                                        ?>
			                                      	</select>
			                                    </div> 
			                                </div>
			                            </div>
			                            <div class="row">
		                                	<div class="col-md-2 offset-5 button_container">
		                                    	<button type="submit" class="btn btn-raised btn-block btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>
		                                	</div>
		                                </div>
	                            	</form>
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
	            } 
	            if($this->auth->has_permission('manage-admin','View'))
	            {
	                ?>
	   				<!-- Panel Form Elements -->
	                <div class="panel">
	                	<div class="panel-heading">
            				<h3 class="panel-title">Users List</h3>
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
	                            </div>
	                            <div class="portlet-body">
	                            	<table id="user_datatable" class="table table-striped table-bordered   custom_table" width="100%">
	                                    <thead>
	                                        <tr>
	                                            <th>Name</th>
	                                            <!-- <th class="no-sort">Image</th> -->
	                                            <th>Email</th>
	                                            <th>Contact</th>
	                                            <th>User Type</th>
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
	                <!-- End Panel Form Elements -->
	                <?php
	            } ?>
      </div>
</div>
<!-- END CONTENT BODY -->
                    
                    
                    
                    
                    
                    
                    
                    
                    
                        