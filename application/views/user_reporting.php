

<div class="content">
    
    <div class="musl-margin-left border-bottom w-100 musl-margin-right musl-column">
        <form method="post" class="mt-4">
            <div class="row">
                <div class="col">
                    <div class="input-group date" data-provide="datepicker">
   						<input type="text" class="form-control border-r-none" placeholder="Start Date" name="start_date" value="<?php echo @$post_data['start_date']; ?>">
    					<div class="input-group-addon">
        					<span class="fa fa-calendar"></span>
    					</div>
					</div>
                </div>
                <div class="col">
                    <div class="input-group date" data-provide="datepicker">
   						<input type="text" class="form-control border-r-none" placeholder="End Date" name="end_date" value="<?php echo @$post_data['end_date']; ?>">
    					<div class="input-group-addon">
        					<span class="fa fa-calendar"></span>
    					</div>
					</div>
                </div>
           
            </div>
            <div>
                <button type="submit" class="musl-login-button ml-0 mt-4 mb-3">Search</button>
            </div>
        </form>
    </div>
    

     <div class="musl-margin-left musl-margin-right w-100" style="margin-top: 50px;">

      <?php if(!empty($result)){ ?>
            <div class="report_txt">
                <h5>Number of Unique Users</h5>
                <p><?php echo $users; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Friend Profiles</h5>
                <p><?php echo $friend; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Flirt Profiles</h5>
                <p><?php echo $flirt; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Fun Profiles</h5>
                <p><?php echo $fun; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of User Sessions</h5>
                <p><?php echo $user_session; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Friend Profiles Sessions</h5>
                <p><?php echo $friend_session; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Flirt Profiles Sessions</h5>
                <p><?php echo $flirt_session; ?><p>
            </div>
            <div class="report_txt">
                <h5>Number of Fun Profiles Sessions</h5>
                <p><?php echo $fun_session; ?><p>
            </div>
           <!--  <div>
                <h5>Average Length of Session</h5>
                <p><?php echo $result['users']; ?><p>
            </div> -->
        
        <?php }else{ ?>
            <h3 class="text-center">No Profiles Found</h3>
        <?php } ?>
        </div>

</div>