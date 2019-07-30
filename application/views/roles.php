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
                    <span>Roles</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- begin #content -->
		    <?php 
		    if($this->auth->has_permission('manage-roles','Add') || $this->auth->has_permission('manage-roles','Edit'))
		    {
		        ?>
		        <!-- begin row -->
		        <div class="row">             
		            <!-- begin col-10 -->
		            <div class="col-md-12">
		            	<!-- BEGIN Portlet PORTLET-->
						<div class="portlet box blue">
						    <div class="portlet-title">
						        <div class="caption">
						            Add Role</div>
						        <div class="tools">
						            <a href="javascript:;" class="collapse"> </a>
						            <a href="javascript:;" class="reload"> </a>
						            <a href="#" class="fullscreen"> </a>
						        </div>
						    </div>
						    <div class="portlet-body">
						    	<form  id="add_role">
		                            <input type="hidden" value="" name="Role_Id" id="Role_Id">
		                            <div class="row">
		                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                    <div class="form-group form-grp">
		                                        <label class="">Role Title <span>*</span></label> 
		                                        <input type="text" name="Role_Name" id="Role_Name" class="form-control" placeholder="Enter Title ">
		                                    </div> 
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                    <div class="form-group">
		                                        <label class="heading-permission">Permissions <span>*</span></label>
		                                        <div class="sticky-table sticky-headers sticky-rtl-cells">

		                                            <table class="table table-bordered" id="testtable">
		                                                <thead>
		                                                    <tr class="sticky-row">
		                                                        <th style="min-width: 180px;">Title</th>
		                                                        <th>Add</th>
		                                                        <th>Edit</th>
		                                                        <th>View</th>
		                                                        <th>Delete</th>
		                                                        <th>Activate/Deactivate</th>
		                                                    </tr>
		                                                </thead>
		                                                <tbody id="permission_block">
		                                                <?php 
		                                                    if(!empty($permissions))
		                                                    {
		                                                        foreach($permissions as $perm)
		                                                        {
		                                                            ?>
		                                                            <tr data-id="<?php echo $perm['Perm_Id']; ?>">
		                                                                <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" data-name="per_id" name="perm_id[]" class="m-l-5 parent_input" value="<?php echo $perm['Perm_Id']; ?>" onchange="check_all_check(this)"><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                        <p><?php echo $perm['Perm_Name']; ?></p>
		                                                                    </div>
		                                                                </td>
		                                                                <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" onchange="check_all_check2(this)" value="1" name="add[<?php echo $perm['Perm_Id']; ?>]" class="sub_input"   disabled><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                    </div>
		                                                                </td>
		                                                                <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" onchange="check_all_check2(this)" value="1" name="edit[<?php echo $perm['Perm_Id']; ?>]" class="sub_input"  disabled><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                    </div>
		                                                                </td>
		                                                                <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" onchange="check_all_check2(this)" value="1" name="view[<?php echo $perm['Perm_Id']; ?>]" class="sub_input"  disabled><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                    </div>
		                                                                </td>
		                                                                 <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" onchange="check_all_check2(this)" value="1" name="perm_delete[<?php echo $perm['Perm_Id']; ?>]" class="sub_input"  disabled><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                    </div>
		                                                                </td>
		                                                                <td>
		                                                                    <div class="checkbox">
		                                                                        <label>
		                                                                            <input type="checkbox" onchange="check_all_check2(this)" value="1" name="delete[<?php echo $perm['Perm_Id']; ?>]" class="sub_input"  disabled><span class="cr"><i class="cr-icon fa fa-check"></i></span>
		                                                                        </label>
		                                                                    </div>
		                                                                </td>
		                                                               
		                                                            </tr>
		                                                            <?php
		                                                        }
		                                                    }
		                                                ?>
		                                                </tbody>
		                                            </table>
		                                        </div>
		                                    </div> 
		                                </div>
		                            </div>
		                            <div class="button_container">   
		                            	<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333">
		                                    <span class="ladda-label">
		                                        <i class="fa fa-save"></i> Save</span>
		                                </button>
		                            </div>
		                        </form>
						    </div>
						</div>
						<!-- END Portlet PORTLET-->
		            </div>
		            <!-- end col-10 -->
		        </div>
		        <!-- end row -->
	    		<?php
			} 
	    	if($this->auth->has_permission('manage-roles','View'))
	    	{
	        	?>
	        	<div class="row">             
	            	<!-- begin col-10 -->
	            	<div class="col-md-12">
	            		<!-- BEGIN Portlet PORTLET-->
						<div class="portlet box blue">
						    <div class="portlet-title">
						        <div class="caption">
						           Roles List</div>
						        <div class="tools">
						            <a href="javascript:;" class="collapse"> </a>
						            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
						            <a href="javascript:;" class="reload"> </a>
						            <a href="#" class="fullscreen"> </a>
						            <a href="javascript:;" class="remove"> </a>
						        </div>
						    </div>
						    <div class="portlet-body">
						    	<table id="user_datatable" class="table table-striped table-bordered display nowrap dt-responsive  custom_table" width="100%">
		                            <thead>
		                                <tr>
		                                    <th>Title</th>
		                                    <th>Created Date</th>
		                                    <th>Modified Date</th>
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
	    	}
	    	?>
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
<!-- END CONTENT BODY -->
                    
                    
                    
                    
                    
                        