 <?php foreach ($templates as $key => $value) { ?>
  	<div class="portlet box green">
        <div class="portlet-title">
            <div class="caption"><?php echo $value['Template_Data_Title']; ?></div>
        </div>
        <div class="portlet-body">
            <div class="col-md-4">
                <a href="<?php echo base_url('lcp/page/').$_SESSION['User_Name'].'/'.$value['Template_Data_Link'].'/'.@$_SESSION['tracking'];; ?>" target="_blank" title="click here to preview">
                    <img src="<?php echo $value['screenshot']; ?>" style="width:90%;height:auto;">
                </a>
            </div>
            <div class="col-md-8">
                <div class="input-group" style="margin-bottom: 15px;">
                    <input type="text" onclick="this.select();" class="form-control" value="<?php echo base_url('lcp/page/').$_SESSION['User_Name'].'/'.$value['Template_Data_Link'].'/'.@$_SESSION['tracking'];; ?>" style="min-height: 37px;" readonly="">
                    <span class="input-group-addon">                              
                            <a href="<?php echo base_url('lcp/page/').$_SESSION['User_Name'].'/'.$value['Template_Data_Link'].'/'.@$_SESSION['tracking'];; ?>" target="_blank"><i class="fa fa-external-link"></i></a>
                    </span>
                </div>
                	<?php 
            		$check_selected = array(
            			'Id' => '',
            			'Program' => '',
            			'Template_Id' => '',
            			'Customer_Id' => '',
            			'Type' => '',
            			'Aweber_Used_List' => '',
            			'Get_response_used_list' => ''
            		);
            		if(!empty($selected)){
            			foreach($selected as $sel){
            				if($sel['Program'] == $program_id && $sel['Template_Id'] == $value['Template_Data_Id']){
            					$check_selected = $sel;
            				}
            			}
            		}
                	if(!empty($aweber_lists) && !empty($getresponse_lists)){
                		?>
                		<form class="main_container_selection">
                			<input type="hidden" name="program" value="<?php echo $program_id; ?>">
                			<input type="hidden" name="template" value="<?php echo $value['Template_Data_Id']; ?>">
                        	<p style="margin-top: 20px; margin-bottom: -15px;">Select the type whose list you want to use.</p>
                        	<div class="input-group" style="padding-top:30px; margin-bottom: 30px;">
                             	<select class="form-control" name="list_type" onchange="check_type(this)"> 
                                    <option value="Aweber" <?php echo ($check_selected['Type']=='Aweber')?'selected':''; ?>>Aweber</option>
                                    <option value="GetResponse" <?php echo ($check_selected['Type']=='GetResponse')?'selected':''; ?>>GetResponse</option>
                                </select>
                            </div>
                        	<div  class="aweber_list_conatiner" style="<?php echo ($check_selected['Type']=='Aweber')?'display:block':'display:none'; ?>">
                        		<p style="margin-top: 20px; margin-bottom: -15px;">Aweber: Select the list you would like to use with this Lead Capture Page</p>
                            	<div class="input-group"  style="padding-top:30px; margin-bottom: 30px;">
                            		<select class="form-control" name="instant_aweber_list_id"> 
                            			<option value="">Select List</option>
                                        <?php if(!empty($aweber_lists)){
	                                		foreach($aweber_lists as $list) {
	                                		?>
	                                    		<option value="<?php echo $list->id; ?>" <?php echo ($list->id==$check_selected['Aweber_Used_List'])?'selected':''; ?>><?php echo $list->name; ?></option>
	                                	<?php } } ?>
                                    </select>
                                    <span class="input-group-btn">                              
                                       <input type="button" name="button" onclick="update_list_capture(this)" id="button" value="Update" class="btn btn-primary">
                                    </span>
                                </div>
                        	</div>
                        	<div  class="get_response_list_conatiner" <?php echo ($check_selected['Type']=='GetResponse')?'display:block':'display:none'; ?>>
                        		<p style="margin-top: 20px; margin-bottom: -15px;">GetResponse: Select the list you would like to use with this Lead Capture Page</p>
                                <div class="input-group " style="padding-top:30px; margin-bottom: 30px;">
                                    <select class="form-control" name="instant_get_response_list_id"> 
                                    	<option value="">Select List</option>
                                        <?php if(!empty($getresponse_lists)){
	                                		foreach($getresponse_lists as $key => $list) {
	                                		?>
	                                    		<option value="<?php echo $key; ?>" <?php echo ($key==$check_selected['Get_response_used_list'])?'selected':''; ?>><?php echo $list['name']; ?></option>
	                                	<?php } } ?>
                                    </select>
                                    <span class="input-group-btn">                              
                                        <input type="button" name="button" onclick="update_list_capture(this)" id="button" value="Update" class="btn btn-primary">
                                    </span>
                                </div>
                        	</div>
                        </form>
                		<?php
                	}
                	?>
                	<?php
                	if(!empty($aweber_lists) && empty($getresponse_lists)){
                		?>
                		<form class="main_container_selection">
                			<input type="hidden" name="program" value="<?php echo $program_id; ?>">
                			<input type="hidden" name="template" value="<?php echo $value['Template_Data_Id']; ?>">
                        	<div  class="aweber_list_conatiner">
                        		<p style="margin-top: 20px; margin-bottom: -15px;">Aweber: Select the list you would like to use with this Lead Capture Page</p>
                            	<div class="input-group"  style="padding-top:30px; margin-bottom: 30px;">
                            		<select class="form-control" name="instant_aweber_list_id">
                            			<option value="">Select List</option> 
                                        <?php if(!empty($aweber_lists)){
	                                		foreach($aweber_lists as $list) {
	                                		?>
	                                    		<option value="<?php echo $list->id; ?>" <?php echo ($list->id==$check_selected['Aweber_Used_List'])?'selected':''; ?>><?php echo $list->name; ?></option>
	                                	<?php } } ?>
                                    </select>
                                    <span class="input-group-btn">                              
                                        <input type="button" name="button" onclick="update_list_capture(this)" id="button" value="Update" class="btn btn-primary">
                                    </span>
                                </div>
                        	</div>
                        </form>
                		<?php
                	}
                	?>
                	<?php 
                	if(empty($aweber_lists) && !empty($getresponse_lists)){
                		?>
                		<form class="main_container_selection">
                			<input type="hidden" name="program" value="<?php echo $program_id; ?>">
                			<input type="hidden" name="template" value="<?php echo $value['Template_Data_Id']; ?>">
                        	<div class="get_response_list_conatiner">
                        		<p style="margin-top: 20px; margin-bottom: -15px;">GetResponse: Select the list you would like to use with this Lead Capture Page</p>
                                <div class="input-group " style="padding-top:30px; margin-bottom: 30px;">
                                    <select class="form-control" name="instant_get_response_list_id"> 
                                    	<option value="">Select List</option>
                                        <?php if(!empty($getresponse_lists)){
	                                		foreach($getresponse_lists as $key => $list) {
	                                		?>
	                                    		<option value="<?php echo $key; ?>" <?php echo ($key==$check_selected['Get_response_used_list'])?'selected':''; ?>><?php echo $list['name']; ?></option>
	                                	<?php } } ?>
                                    </select>
                                    <span class="input-group-btn">                              
                                        <input type="button" name="button" onclick="update_list_capture(this)" id="button" value="Update" class="btn btn-primary">
                                    </span>
                                </div>
                        	</div>
                        </form>
                		<?php
                	}
                	?>
			        <a class="btn btn-primary btn-lg" href="\" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('lcp/page/').$_SESSION['User_Name'].'/'.$value['Template_Data_Link'].'/'.@$_SESSION['tracking'];; ?>', 'newwindow', 'width=300, height=250'); return false;" style="float: left; min-width: 48%;"><i class="fa fa-facebook-square" aria-hidden="true"></i> Post to Facebook</a>
					<a class="btn btn-primary btn-lg" href="\" onclick="window.open('https://twitter.com/intent/tweet?text=Powerful New Opportunity <?php echo base_url('lcp/page/').$_SESSION['User_Name'].'/'.$value['Template_Data_Link'].'/'.@$_SESSION['tracking'];; ?>', 'newwindow', 'width=300, height=250'); return false;" style="float: right; min-width: 48%;"><i class="fa fa-twitter" aria-hidden="true"></i> Post to Twitter</a>              
            </div>
            <div class="clear"></div>
        </div>
	</div>
                   
<?php } 

if(count($templates) < DEFAULT_NO_PER_PAGE){
    echo '<h3 class="text-center">No More Pages Found</h3>';
}else{
    echo ' <div class="clearfix"></div><div class="button_container">                      
    <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333" id="load_more_btn" onclick="load_more('.($page+1).');"> <span class="ladda-label"> Load More</span> </button>
</div>';
}


?>