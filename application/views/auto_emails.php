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
	                    <span>Emails</span>
	                </li>
	            </ul>
	        </div>
	        <!-- END PAGE BAR -->
			<!-- begin #content -->
	                <div class="row">             
	                    <!-- begin col-10 -->
	                    <div class="col-md-12">
	                       <!-- BEGIN Portlet PORTLET-->
	                        <div class="portlet box blue">
	                            <div class="portlet-title">
	                                <div class="caption">Email List</div>
	                                <div class="tools">
	                                    <a href="javascript:;" class="collapse"> </a>
	                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
	                                    <a href="javascript:;" class="reload"> </a>
	                                    <a href="#" class="fullscreen"> </a>
	                                    <a href="javascript:;" class="remove"> </a>
	                                </div>
	                                <div class="actions">
                                    	<a onclick="add_email()" class="btn btn-default btn-sm">
                                        <i class="fa fa-plus"></i> Add New</a>
                                    </div>
	                            </div>
	                            <div class="portlet-body">
	                            	<table class="table table-striped table-bordered display nowrap dt-responsive  custom_table" width="100%">
	                                    <thead>
	                                        <tr>
	                                            <th>Title</th>
			                                    <th>Days</th>
			                                    <th width="15%" class="no-sort">Actions</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php 
	                                    	if(!empty($emails)){
	                                    		foreach($emails as $email){
	                                    			?>
	                                    			<tr>
	                                    				<td>
	                                    					<?php echo $email['Email_Subject']; ?>
	                                    				</td>
	                                    				<td>
	                                    					<?php echo $email['Days']; ?>
	                                    				</td>
	                                    				<td>
	                                    					<a type="button" title="View" onclick="view_email('<?php echo $email['Email_Id']; ?>')" class="btn btn-icon-only green"><i class="fa fa-eye"></i></a>
	                                    					<?php 
	                                    					if($email['User_Id']==$this->session->userdata('User_Id')){
	                                    						?>
		                                    					<a type="button" title="Edit" onclick="edit_email(<?php echo $email['Email_Id']; ?>)" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>
		                                    					<a type="button" title="View" onclick="perm_delete_auto(<?php echo $email['Email_Id']; ?>)" class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>
	                                    						<?php
	                                    					}
	                                    					?>
	                                    				</td>
	                                    			</tr>
	                                    			<?php
	                                    		} 
	                                    	}else{
	                                    			?>
	                                    			<tr>
	                                    				No email founds.
	                                    			</tr>
	                                    			<?php
	                                    		}
	                                    	?>                                 
	                                    </tbody>
	                            	</table>
	                            </div>
	                        </div>
	                        <!-- END Portlet PORTLET-->
	                    </div>
	                    <!-- end col-10 -->
	                </div>
	                <!-- end row -->
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>

	<div id="add_email" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">Add Email</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="add_email_form_auto">
                			<div class="note note-info">
                                <h4 class="block">Please use below keywords for Dynamic Data.</h4>
                                <p> <span class="label label-primary" style="margin-left: 5px;"> __lead_first_name </span> <span class="label label-primary" style="margin-left: 5px;"> __full_name </span> <span class="label label-primary" style="margin-left: 5px;"> __phone </span> <span class="label label-primary" style="margin-left: 5px;"> __email </span></p>
                            </div>
                			<div class="row">
                				<input type="hidden" name="Add_Program_Id" id="Add_Program_Id" value="<?php echo $program_id; ?>">
                    			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">Programs<span>*</span></label>
                          				<select name="Add_Program_Id" id="Add_Program_Id" class="form-control">
                          					<option value="">Select Program</option>
                          					<?php 
                          					// if(!empty($programs)){
                          						// foreach($programs as $pro){
                          							?>
		                          					<option value="<?php echo $pro['Program_Id'] ?>"><?php echo $pro['Program_Name']; ?></option>
                          							<?php
                          						// }
                          					// }
                          					?>
                          				</select>
                                	</div> 
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">Title<span>*</span></label>
                          				<input type="text" name="Add_Title" id="Add_Title" class="form-control" placeholder="title">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Subject <span>*</span></label>
                                        <input type="text" class="form-control" name="Add_Subject" id="Add_Subject" placeholder="Subject">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Days<span>*</span></label>
                                        <input type="text" class="form-control" name="Add_Days" id="Add_Days" placeholder="days">
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Add_Content">Content <span>*</span></label>
                                        <textarea name="Add_Content" id="Add_Content" placeholder="Content"></textarea>
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-12">
                            		<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333">
	                                    <span class="ladda-label">
	                                        <i class="fa fa-save"></i> Save</span>
	                                </button>
                            	</div>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_email" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">Edit Email</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<form id="edit_email_form_auto">
                			<div class="note note-info">
                                <h4 class="block">Please use below keywords for Dynamic Data.</h4>
                                <p> <span class="label label-primary" style="margin-left: 5px;"> __lead_first_name </span> <span class="label label-primary" style="margin-left: 5px;"> __full_name </span> <span class="label label-primary" style="margin-left: 5px;"> __phone </span> <span class="label label-primary" style="margin-left: 5px;"> __email </span></p>
                            </div>
                			<div class="row">
                				<input type="hidden" name="Edit_Program_Id" id="Edit_Program_Id" value="<?php echo $program_id; ?>">
                				<!-- program_id -->
                				<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">Programs<span>*</span></label>
                          				<select name="Edit_Program_Id" id="Edit_Program_Id" class="form-control">
                          					<?php 
                          					//if(!empty($programs)){
                          						// foreach($programs as $pro){
                          							?>
		                          					<option value="<?php echo $pro['Program_Id'] ?>"><?php echo $pro['Program_Name']; ?></option>
                          							<?php
                          						//}
                          					//}
                          					?>
                          				</select>
                                	</div> 
                                </div> -->
                    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        			<div class="form-group fix-form-group form-grp">
                            			<label class="control-label">Title<span>*</span></label>
                            			<input type="hidden" name="Edit_Id" id="Edit_Id" class="form-control" placeholder="First name">
                          				<input type="text" name="Edit_Title" id="Edit_Title" class="form-control" placeholder="Title">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Subject <span>*</span></label>
                                        <input type="text" class="form-control" name="Edit_Subject" id="Edit_Subject" placeholder="Subject">
                                	</div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label class="control-label">Days<span>*</span></label>
                                        <input type="number" class="form-control" name="Edit_Days" id="Edit_Days" placeholder="Days">
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group fix-form-group form-grp">
                                        <label for="Edit_Content">Content <span>*</span></label>
                                        <textarea name="Edit_Content" id="Edit_Content" placeholder="User email"></textarea>
                                	</div> 
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-12">
                            		<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333">
	                                    <span class="ladda-label">
	                                        <i class="fa fa-save"></i> Save</span>
	                                </button>
                            	</div>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	

    <div id="view_email" class="modal fade" tabindex="-1" data-width="760">
        <div class="row">
            <div class="col-md-12">
            	<!-- BEGIN Portlet PORTLET-->
                <div class="portlet box blue" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption">View Email</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="#" class="fullscreen"> </a>
                            <a href="javascript:;" onclick="return false" data-dismiss="modal" class=""> <i class="fa fa-times" style="font-size: 21px; color: white;"></i> </a> </div>
                    </div>
                    <div class="portlet-body">
                    	<!-- <form id="edit_email_form"> -->
                			<div class="note note-info">
                                <h4 class="block" id="View_Subject">..</h4>
                            </div>
                			<div class="row">
                    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        			<div id="View_Content" style="min-height: 400px;"></div>
                                </div>
                            </div>
                    	<!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>