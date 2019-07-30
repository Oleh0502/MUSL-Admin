<?php
$ControllerName = $this->router->class;
$FunctionName   = $this->router->method;
$Parameter = $this->uri->segment(3);
$usertype = @$usertype;
?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">

        <!-- BEGIN SIDEBAR -->

        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

        <div class="page-sidebar navbar-collapse collapse">

            <!-- BEGIN SIDEBAR MENU -->

            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->

            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->

            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->

            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->

            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->

             <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>

				
                <li class="nav-item start <?php echo $ControllerName=='dashboard'? 'active':''; ?>">
                    <a href="<?php echo base_url('dashboard'); ?>" class="nav-link" >
                        <i class="icon-home"></i>
                        <span class="title"> Dashboard </span>                        
                        <?php echo $ControllerName=='dashboard'? '<span class="selected"></span>':''; ?>
					</a>
                </li>
                <?php if($this->session->userdata('User_Type')=='admin' || $this->session->userdata('User_Type')=='sub_admin') { ?>

                    <?php  if ($this->auth->has_permission('manage-roles')) {?>
                         <li class="nav-item <?php echo $ControllerName=='roles'? 'active':''; ?>">
                            <a href="<?php echo base_url('roles'); ?>" class="nav-link" >
                                <i class="fa fa-gears"></i>
                                <span class="title"> Manage Roles </span>
                                <?php echo $ControllerName=='roles'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-users')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='ausers'? 'active':''; ?>">
                            <a href="<?php echo base_url('ausers'); ?>" class="nav-link" >
                                <i class="fa fa-users"></i>
                                <span class="title"> Manage Admins </span>
                                <?php echo $ControllerName=='ausers'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                 <!--    <li class="nav-item <?php echo $ControllerName=='graph'? 'active':''; ?>">
                        <a href="<?php echo base_url('graph'); ?>" class="nav-link" >
                            <i class="fa fa-line-chart" aria-hidden="true"></i>
                            <span class="title"> Analytics Report</span>
                            <?php echo $ControllerName=='graph'? '<span class="selected"></span>':''; ?>
                        </a>
                    </li> -->

                    <!-- <?php  if ($this->auth->has_permission('manage-getting-started')) { ?>
                     <li class="nav-item <?php echo $ControllerName=='getting_started'? 'active':''; ?>">
                        <a href="<?php echo base_url('getting_started/manage'); ?>" class="nav-link" >
                            <i class="fa fa-diamond"></i>
                            <span class="title">Manage Getting Started </span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <?php } ?>
						
					<?php $setting_array = array('aweber', 'analytics'); ?> 
					<li class="nav-item <?php if(in_array($ControllerName,$setting_array)){ echo "active"; } ?>">
	                    <a href="javascript:;" class="nav-link nav-toggle ">
	                        <i class="fa fa-gear"></i>
	                        <span class="title"> Settings </span>
	                        <span class="arrow"></span>
	                       <span class="selected"></span>
	                    </a>
                    <ul class="sub-menu">
                    	<?php  if ($this->auth->has_permission('manage-aweber')) { ?>
	                     	<li class="nav-item <?php echo ($ControllerName=='aweber')? 'active':''; ?>">
	                     	 	<a href="<?php echo base_url('aweber') ?>" class="nav-link nav-toggle">
	                                <i class="fa fa-cogs"></i>
	                                <span class="title">Connect Aweber</span>
	                                <span class="selected"></span>
	                            </a>
	                     	</li>
                     	<?php } ?>
						<?php  if ($this->auth->has_permission('manage-analytics')) { ?>
                     	<li class="nav-item <?php echo ($ControllerName=='analytics')? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('analytics') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title"> Google Anaytics </span>
                                <span class="selected"></span>
                            </a>
                     	</li>
                     	<?php } ?>
                    </ul>
                </li>
 -->
                    <?php  if ($this->auth->has_permission('manage-customers')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='customers'? 'active':''; ?>">
                            <a href="<?php echo base_url('customers'); ?>" class="nav-link" >
                                <i class="fa fa-users"></i>
                                <span class="title"> Manage Customers </span>
                                <?php echo $ControllerName=='customers'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php  if ($this->auth->has_permission('manage-supplier')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='supplier'? 'active':''; ?>">
                            <a href="<?php echo base_url('supplier'); ?>" class="nav-link" >
                                <i class="fa fa-users"></i>
                                <span class="title"> Manage Suppliers </span>
                                <?php echo $ControllerName=='supplier'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-category')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='categories'? 'active':''; ?>">
                            <a href="<?php echo base_url('categories'); ?>" class="nav-link" >
                                <i class="fa fa-users"></i>
                                <span class="title"> Manage Categories </span>
                                <?php echo $ControllerName=='categories'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-items')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='items'? 'active':''; ?>">
                            <a href="<?php echo base_url('items'); ?>" class="nav-link" >
                                <i class="fa fa-users"></i>
                                <span class="title"> Manage Items </span>
                                <?php echo $ControllerName=='items'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-payments')) { ?>
                    <li class="nav-item <?php echo $ControllerName=='payment'? 'active':''; ?>">
                        <a href="<?php echo base_url('payment/all_transactions'); ?>" class="nav-link" >
                            <i class="icon-star"></i>
                            <span class="title"> Supplier Subscription </span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <?php }?>


                     <!-- <?php  if ($this->auth->has_permission('manage-notification')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='notifications'? 'active':''; ?>">
                            <a href="<?php echo base_url('notifications'); ?>" class="nav-link" >
                                <i class="fa fa-bell"></i>
                                <span class="title"> Manage Notifications </span>
                                <?php echo $ControllerName=='notifications'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>


                    <?php  if ($this->auth->has_permission('manage-tasks')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='tasks'? 'active':''; ?>">
                            <a href="<?php echo base_url('tasks'); ?>" class="nav-link" >
                                <i class="fa fa-tasks"></i>
                                <span class="title"> Manage Tasks </span>
                                <?php echo $ControllerName=='tasks'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>


                    <?php  if ($this->auth->has_permission('manage-downloads')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='downloads'? 'active':''; ?>">
                            <a href="<?php echo base_url('downloads'); ?>" class="nav-link" >
                                <i class="fa fa-download"></i>
                                <span class="title"> Manage Downloads </span>
                                <?php echo $ControllerName=='downloads'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-tags')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='tags'? 'active':''; ?>">
                            <a href="<?php echo base_url('tags'); ?>" class="nav-link" >
                                <i class="fa fa-tags"></i>
                                <span class="title"> Manage Tags </span>
                                <?php echo $ControllerName=='tags'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php  if ($this->auth->has_permission('manage-training') || $this->auth->has_permission('manage-webinar')) { ?>
                     <li class="nav-item <?php echo ($ControllerName=='training' || $ControllerName=='webinars')? 'active':''; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle ">
                                <i class="fa fa-graduation-cap"></i>
                                <span class="title"> Training Management  </span>
                                <span class="arrow"></span>
                            </a>

                             <ul class="sub-menu">
                            <?php  if ($this->auth->has_permission('manage-training')) { ?>
                                <li class="nav-item <?php echo $ControllerName=='training'? 'active':''; ?>">
                                    <a href="<?php echo base_url('training'); ?>" class="nav-link "> 
                                    <i class="fa fa-file-video-o"></i>
                                    <span class="title"> Manage Training Video's  </span>
                                    <span class="arrow"></span>
                                </a>
                                </li>
                            <?php } ?>
                            <?php  if ($this->auth->has_permission('manage-webinar')) { ?>
                                <li class="nav-item <?php echo ($ControllerName=='webinars' && $FunctionName == 'index')? 'active':''; ?>">
                                    <a href="<?php echo base_url('webinars'); ?>" class="nav-link "> 
                                    <i class="fa fa-file-video-o"></i>
                                    <span class="title"> Manage Webinar Video's  </span>
                                    <span class="arrow"></span>
                                </a>
                                </li>
                            <?php } ?>

                            <?php  if ($this->auth->has_permission('manage-webinar-calender')) { ?>
                                <li class="nav-item <?php echo( $ControllerName=='webinars' && $FunctionName == 'manage_calender')? 'active':''; ?>">
                                    <a href="<?php echo base_url('webinars/manage_calender'); ?>" class="nav-link "> 
                                    <i class="fa  fa-calendar"></i>
                                    <span class="title"> Schedule Webinars </span>
                                    <span class="arrow"></span>
                                </a>
                                </li>
                            <?php } ?>


                            </ul>
                        </li>
                    <?php } ?> -->


                    <!-- <?php  if ($this->auth->has_permission('manage-programs')) { ?>
                     <li class="nav-item <?php echo $ControllerName=='programs'? 'active':''; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle ">
                                <i class="fa  fa-cogs"></i>
                                <span class="title"> Program Management  </span>
                                <span class="arrow"></span>
                            </a>

                             <ul class="sub-menu">
                            <?php  if ($this->auth->has_permission('manage-programs')) { ?>
                                <li class="nav-item <?php echo ($ControllerName=='programs' && $FunctionName == 'index')? 'active':''; ?>">
                                    <a href="<?php echo base_url('programs'); ?>" class="nav-link "> 
                                    <i class="fa fa-tasks"></i>
                                    <span class="title"> Manage Program's  </span>
                                </a>
                                </li>
                            <?php } ?>
                          

                            </ul>
                        </li>
                    <?php } ?> -->
						
					<!-- <?php  if ($this->auth->has_permission('manage-tags')) { ?>
                        <li class="nav-item <?php echo $ControllerName=='newsletter'? 'active':''; ?>">
                            <a href="<?php echo base_url('newsletter/all'); ?>" class="nav-link" >
                                <i class="fa fa-tags"></i>
                                <span class="title"> Newsletter List </span>
                                <?php echo $ControllerName=='newsletter'? '<span class="selected"></span>':''; ?>
                            </a>
                        </li>
                    <?php } ?> -->


                    <!-- <?php  if ($this->auth->has_permission('manage-lcp') || $this->auth->has_permission('manage-vsl')) { ?>
                     <li class="nav-item <?php echo ($ControllerName=='lcp' || $ControllerName=='vsl') ? 'active':''; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle ">
                                <i class="fa fa-window-restore"></i>
                                <span class="title"> Template Management  </span>
                                <span class="arrow"></span>
                            </a>

                             <ul class="sub-menu">
                            <?php  if ($this->auth->has_permission('manage-lcp')) { ?>
                                <li class="nav-item <?php echo ($ControllerName=='lcp' && $FunctionName == 'index')? 'active':''; ?>">
                                    <a href="<?php echo base_url('lcp'); ?>" class="nav-link "> 
                                    <i class="fa fa-television"></i>
                                    <span class="title"> Manage LCP's  </span>
                                </a>
                                </li>
                            <?php } ?>

                            <?php  if ($this->auth->has_permission('manage-vsl')) { ?>
                                <li class="nav-item <?php echo ($ControllerName=='vsl' && $FunctionName == 'index')? 'active':''; ?>">
                                    <a href="<?php echo base_url('vsl'); ?>" class="nav-link "> 
                                    <i class="fa fa-television"></i>
                                    <span class="title"> Manage VSL's  </span>                                   
                                </a>
                                </li>
                            <?php } ?>


                            </ul>
                        </li>
                    <?php } ?>
					<?php  if ($this->auth->has_permission('manage-payments')) { ?>
					<li class="nav-item <?php echo $ControllerName=='payment'? 'active':''; ?>">
	                    <a href="<?php echo base_url('payment/all_transactions'); ?>" class="nav-link" >
	                        <i class="icon-star"></i>
	                        <span class="title"> Payments </span>
	                        <span class="selected"></span>
	                    </a>
                	</li>
					<?php }?>
					<?php  if ($this->auth->has_permission('manage-emails')) { ?>
					<li class="nav-item <?php echo $ControllerName=='emails'? 'active':''; ?>">
	                    <a href="<?php echo base_url('emails'); ?>" class="nav-link" >
	                        <i class="fa fa-envelope-o"></i>
	                        <span class="title">Manage Emails </span>
	                        <span class="selected"></span>
	                    </a>
                	</li>
					<?php }?> -->
                    <?php }?>

              

				<?php if($this->session->userdata('User_Type')=='customer') { ?>

                <li class="nav-item <?php echo $ControllerName=='user_notifications'? 'active':''; ?>">
                    <a href="<?php echo base_url('user_notifications/inbox'); ?>" class="nav-link" >
                        <i class="icon-star"></i>
                        <span class="title"> Notifications </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item <?php echo $ControllerName=='getting_started'? 'active':''; ?>">
                    <a href="<?php echo base_url('getting_started'); ?>" class="nav-link" >
                        <i class="fa fa-diamond"></i>
                        <span class="title"> Getting Started </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item <?php echo $ControllerName=='newsletter'? 'active':''; ?>" >
                    <a href="<?php echo base_url('newsletter'); ?>" class="nav-link" target="_blank">
                        <i class="fa fa-newspaper-o"></i>
                        <span class="title"> Newsletter Signup  </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item <?php echo $ControllerName=='graph'? 'active':''; ?>">
                    <a href="<?php echo base_url('graph'); ?>" class="nav-link" >
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        <span class="title"> Analytics Report</span>
                        <?php echo $ControllerName=='graph'? '<span class="selected"></span>':''; ?>
                    </a>
                </li>
				<?php $setting_array = array('aweber', 'getresponse', 'analytics', 'tracking','emails'); ?> <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle <?php if(in_array($ControllerName,$setting_array)){ echo " active"; } ?>">
                        <i class="fa fa-gear"></i>
                        <span class="title"> Settings </span>
                        <span class="arrow"></span>
                       <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                     	<li class="nav-item <?php echo ($ControllerName=='aweber')? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('aweber') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Aweber Integration</span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='getresponse')? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('getresponse') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Get Response</span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='analytics')? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('analytics') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title"> Google Anaytics </span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='tracking' && $FunctionName != 'pixel')? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('tracking/') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Tracking Codes</span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                    </ul>
                </li>
	
	

                <li class="heading">

                    <h3 class="uppercase"> Business</h3>

                </li>

				
                <li class="nav-item <?php echo ($ControllerName=='profile' && $FunctionName == 'index')? 'active':''; ?>">
                    <a href="<?php echo base_url('profile'); ?>" class="nav-link" >
                        <i class="fa fa-user"></i>
                        <span class="title"> My Profile  </span>
                        <span class="selected"></span>
                    </a>
                </li>

               <!--  <li class="nav-item <?php echo $ControllerName=='profile'? 'active':''; ?>">
                    <a href="<?php echo base_url('profile/change_password'); ?>" class="nav-link" >
                        <i class="fa fa-unlock-alt"></i>
                        <span class="title"> Change Password  </span>
                        <span class="arrow"></span>
                    </a>
                </li> -->

                <li class="heading">
                    <h3 class="uppercase"> Free Facebook Training</h3>
                </li>

                <li class="nav-item <?php echo ($ControllerName=='training' && $FunctionName=='view_trainings' && $Parameter == 'facebook_basic')? 'active':''; ?>">
                    <a href="<?php echo base_url('training/view_trainings/facebook_basic'); ?>" class="nav-link" >
                        <i class="fa fa-facebook-official"></i>
                        <span class="title"> Facebook Basics </span>
                       <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item <?php echo ($ControllerName=='training' && $FunctionName=='view_trainings' && $Parameter == 'facebook_post_formula')? 'active':''; ?>">
                    <a href="<?php echo base_url('training/view_trainings/facebook_post_formula'); ?>" class="nav-link" >
                        <i class="fa fa-paper-plane-o"></i>
                        <span class="title"> Facebook Post Formula  </span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item <?php echo ($ControllerName=='training' && $FunctionName=='view_trainings' && $Parameter == 'writing_copy')? 'active':''; ?>">
                    <a href="<?php echo base_url('training/view_trainings/writing_copy'); ?>" class="nav-link" >
                        <i class="fa fa-copy"></i>
                        <span class="title"> Writing Copy </span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="heading">
                    <h3 class="uppercase"> Marketing</h3>
                </li>

                <li class="nav-item <?php echo ($ControllerName=='my_leads' )? 'active':''; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle" >
                        <i class="fa fa-users"></i>
                        <span class="title"> Leads </span>
                        <span class="arrow"></span>
                       <span class="selected"></span>
                    </a>
                     <ul class="sub-menu">
                     	<li class="nav-item <?php echo ($ControllerName=='my_leads' && $Parameter=='active' )? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('my_leads/index/active/') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-user-plus"></i>
                                <span class="title"> Active Leads  </span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='my_leads' && $Parameter=='unconfirmed' )? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('my_leads/index/unconfirmed/') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-user-o"></i>
                                <span class="title"> Unconfirmed Leads  </span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='my_leads' && $Parameter=='completed' )? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('my_leads/index/completed/') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title"> Completed Leads  </span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     	 <li class="nav-item <?php echo ($ControllerName=='my_leads' && $Parameter=='scrubbed' )? 'active':''; ?>">
                     	 	<a href="<?php echo base_url('my_leads/index/scrubbed/') ?>" class="nav-link nav-toggle">
                                <i class="fa fa-user-times"></i>
                                <span class="title"> Scrubbed Leads  </span>
                                <span class="selected"></span>
                            </a>
                     	 </li>
                     </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-windows"></i>
                        <span class="title"> Marketing Suite  </span>
                        <span class="arrow"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">

                    <?php $programs = $this->programs;
                    if(!empty($programs)){
                    foreach ($programs as $key => $value) {
                    ?>

                        <li class="nav-item  ">
                                 <?php 
                            	if(!check_package($this->purchased,$value['Program_Id'])) {
                            		?>
		                            <a href="<?php echo base_url('payment/do_payment/'.$value['Program_Id']) ?>" class="nav-link nav-toggle">
		                                <i class="fa fa-cubes"></i>
		                                <span class="title"> <?php echo $value['Program_Name']; ?>  </span>
                            			<i class="fa fa-lock"></i>
		                                <span class="arrow"></span>
		                                <span class="selected"></span>
		                            </a>
                            		<?php
                            	} else{
                            		?>
                            		<a href="javascript:;" class="nav-link nav-toggle">
		                                <i class="fa fa-cubes"></i>
		                                <span class="title"> <?php echo $value['Program_Name']; ?>  </span>
		                                <span class="arrow"></span>
		                                <span class="selected"></span>
		                            </a>
                            		<?php
                            	}
                            	?>
                            <?php 
                            if(check_package($this->purchased,$value['Program_Id'])) {
                            ?>
								<ul class="sub-menu">
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('lcp/lcp_list/').$value['Program_Id']; ?>" class="nav-link "> Lead Capture Pages </a>
	                                </li>
	                                <li class="nav-item <?php echo ($ControllerName=='tracking' && $FunctionName=='pixel' )? 'active':''; ?>">
			                     	 	<a href="<?php echo base_url('tracking/pixel/'.$value['Program_Id']) ?>" class="nav-link nav-toggle">
			                                <span class="title">Tracking Pixel</span>
			                                <!-- <span class="selected"></span> -->
			                            </a>
			                     	 </li>
									<li class="nav-item ">
	                                    <a href="<?php echo base_url('vsl/redirect_url/').$value['Program_Id']; ?>" class="nav-link "> VSL Redirect Link </a>
	                                </li>
	                                <li class="nav-item <?php echo ($ControllerName=='emails' && $FunctionName=='autoresponder')? 'active':''; ?>">
			                     	 	<a href="<?php echo base_url('emails/autoresponder/'.$value['Program_Id']) ?>" class="nav-link nav-toggle">
			                                <span class="title">Autoresponder Emails</span>
			                                <!-- <span class="selected"></span> -->
			                            </a>
			                     	 </li>
	                            </ul>
                        	<?php } ?>
						</li>
                    
                   <?php } } ?>
                    </ul>

                </li>

                <li class="nav-item <?php echo ($ControllerName=='webinars' )? 'active':''; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-play-circle"></i>
                        <span class="title"> WEBINARS </span>
                        <span class="arrow"></span>
                    </a>
                	<ul class="sub-menu">
                        <li class="nav-item  <?php echo ($ControllerName=='webinars' && $FunctionName=='webinar_events' )? 'active':''; ?>">
                            <a href="<?php echo base_url('webinars/webinar_events'); ?>" class="nav-link ">
                                <i class="fa fa-calendar-check-o"></i>
                                <span class="title"> Webinar Schedule</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($ControllerName=='webinars' && $FunctionName=='view_webinars')? 'active':''; ?> ">
                            <a href="<?php echo base_url('webinars/view_webinars'); ?>" class="nav-link ">
                                <i class="fa fa-video-camera"></i>
                                <span class="title"> Recorded Webinars</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- <li class="nav-item  ">
                    <a href="<?php echo base_url('Rolodex'); ?>" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <span class="title"> Rolodex </span>
                        <span class="selected"></span>
                    </a>
                </li> -->

               <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-support"></i>
                        <span class="title"> Support </span>
                        <span class="arrow"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="https://keendevelopers.freshdesk.com/support/home" class="nav-link " target="_blank">
                                <i class="fa fa-ticket"></i>
                                <span class="title"> Helpdesk</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="https://keendevelopers.freshdesk.com/support/solutions" class="nav-link " target="_blank">
                                <i class="fa fa-question-circle"></i>
                                <span class="title"> FAQ's </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  <?php echo ($ControllerName=='downloads'  && $FunctionName=='view_downloads')? 'active':''; ?>">
                    <a href="<?php echo base_url('downloads/view_downloads'); ?>" class="nav-link ">
                        <i class="fa fa-download"></i>
                        <span class="title"> Downloads </span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item  <?php echo ($ControllerName=='payment'  && ($FunctionName=='index' || $FunctionName == 'transactions'))? 'active':''; ?>">
                    <a href="<?php echo base_url('payment'); ?>" class="nav-link ">
                        <i class="fa fa-money"></i>
                        <span class="title"> Subscriptions </span>
                        <span class="selected"></span>
                    </a>
                </li>

				<?php } ?>

                <li class="nav-item  ">
                    <a href="<?php echo base_url('logout'); ?>" class="nav-link ">
                        <i class="fa fa-sign-out"></i>
                        <span class="title"> Logout </span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->

    </div>
    <!-- END SIDEBAR -->
