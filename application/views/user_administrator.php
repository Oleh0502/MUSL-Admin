

<div class="content">
    
    <div class="musl-margin-left border-bottom w-100 musl-margin-right musl-column">
        <form class="mt-4" method="get" id="search_form">
            <div class="row">
                <div class="col">
                    <label class="label" style="color: #ed3237;font-size: 11px;">*required</label>
                    <input type="text" name="profile_name" class="form-control" id="profile_name"
                           placeholder="User Profile Name*" required value="<?php echo @$_GET['profile_name']; ?>">
                </div>
                <div class="col">
                    <label class="label" style="color: #ed3237;font-size: 11px;"></label>

                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="Email Address" value="<?php echo @$_GET['email']; ?>">
                </div>
                <div class="col">
                    <label class="label" style="color: #ed3237;font-size: 11px;"></label>

                    <select name="profile_state" class="form-control" id="profile_state"
                           placeholder="Select Profile State" style="background:#dfdfdf ;">
                           <option value="">Select Profile State</option>
                           <option value="friend" <?php echo @$_GET['profile_state']=='friend'? 'selected':''; ?>>Friend</option>
                           <option value="flirt" <?php echo @$_GET['profile_state']=='flirt'? 'selected':''; ?>>Flirt</option>
                           <option value="fun" <?php echo @$_GET['profile_state']=='fun'? 'selected':''; ?>>Fun</option>
                       </select>
                </div>
            </div>
            <div>
                <button type="submit" class="musl-login-button ml-0 mt-4 mb-3">Search</button>
                <!-- formaction="<?php //echo base_url('user_administrator/list'); ?>"  -->
            </div>
        </form>
    </div>
    

    <?php if(!isset($_GET['user_id']) || empty($_GET['user_id'])){ ?>
    <div class="musl-margin-left musl-margin-right w-100">
    <?php if(!empty($result)){ ?>

            <table class="table">
                <tbody>
                <?php foreach ($result as $key => $value) { ?>
                    
                    <tr>
                        <!-- <td><a href="<?php //echo base_url('user_administrator/profile/').$value['profile_id']; ?>"><?php //echo $value['profile_name']; ?></a></td> -->
                        <td><a href="<?php echo $profile_url.$value['User_Id'].'&profile_id='.$value['profile_id']; ?>"><?php echo $value['profile_name']; ?></a></td>
                        <td><?php echo $value['User_Email']; ?> </td>
                        <td><img src="<?php echo base_url('assets/images/profile_pics/').$value['profile_pic']; ?>"
                                           style="width: 40px; height: 40px"></td>
                    </tr>

                <?php } ?>            
                    
                   
                </tbody>
            </table>
    <?php }else{ ?>
        <h3 class="text-center" style="margin-top: 50px;">No Profiles Found</h3>
    <?php } ?>
        </div>

    
    <?php }else{ ?>

        <div class="musl-margin-left border-bottom w-100 musl-margin-right musl-column">
            <div class="mt-3 mb-3 ml-2">
                <a href="javascript:;" onclick="$('#search_form').submit();">Back</a>
            </div>
        </div>
        <div class="musl-margin-left border-bottom w-100 musl-margin-right musl-column">
            <div class="row mt-3 mb-3">
                <div class="col-md-4"><?php echo $profile['profile_name']; ?></div>
                <div class="col-md-4"><span class="musl-email-text"><?php echo $user_details['User_Email']; ?></span></div>
                <div class="col-md-4 text-right"><a href="javascript:;" onclick="activate_account(<?php echo $user_details['User_Id']; ?>,<?php echo $user_details['Is_Blocked'] == '1'? '0':'1'; ?>,'user')" class="musl-<?php echo $user_details['Is_Blocked'] == '1'? 'activate':'deactivate'; ?>-color"><?php echo $user_details['Is_Blocked'] == '1'? 'Activate Profile':'Deactivate Profile'; ?></a></div>
            </div>
            <div class="row mt-1 mb-1 border-top border-bottom">
                <div class="col-md-4 "><span class="musl-profile-text">Profile Name</span></div>
                <div class="col-md-3"><span class="musl-profile-text">Profile Photo</span></div>
                <div class="col-md-3"><span class="musl-profile-text">Private Photos</span></div>
                <div class="col-md-2 text-right"><span class="musl-profile-text">Actions</span></div>
            </div>  
                <?php if(empty($profile_details)){ ?>
                    <h3 class="text-center">No Profiles Found</h3>
                <?php } ?>
                
                <?php foreach ($profile_details as $key => $value) { ?>
                <div class="row mt-1 mb-1 mt-3">
                    <div class="col-md-4">
                        <div class="musl-profile-text"><?php echo ucfirst($value['profile_type']); ?></div>
                        <?php echo $value['profile_name']; ?>
                    </div>
                    <div class="col-md-3"><img src="<?php echo base_url('assets/images/profile_pics/').$value['profile_pic']; ?>" style="width: 80px; height: 80px"></div>
                    <div class="col-md-3">
                        <button data-toggle="modal" data-target="#photoModal-<?php echo $value['profile_id']; ?>"
                                style="padding: 0; border-radius: 10px">
                            <img src="<?php echo base_url('assets/images/review.png'); ?>" class="musl-logo m-auto" style="width: 80px; height: 80px">
                        </button>
                    </div>
                        <div class="col-md-2 text-right">
                            <a href="javascript:;" onclick="activate_account(<?php echo $value['profile_id']; ?>,<?php echo $value['is_blocked'] == '1'? '0':'1'; ?>,'profile')" class="musl-<?php echo $value['is_blocked'] == '1'? 'enable':'disable'; ?>-color"><?php echo $value['is_blocked'] == '1'? 'Enable Profile':'Disable Profile'; ?></a>
                        </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="photoModal-<?php echo $value['profile_id']; ?>" tabindex="-1" role="dialog"
                     aria-labelledby="photoModalLabel-30"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #4A4A4A; opacity: 0.9;">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="photoModalLabel-30"
                                    style="color: white; font-size: 18px; font-weight: 400; line-height: 24px;">Private
                                    photos</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row ml-3 mr-3">
                                    <?php if(!empty($value['private_photos'])){ foreach ($value['private_photos'] as $key => $value) { ?>
                                        <div class="col-md-3">
                                            <img src="<?php echo base_url('assets/images/private_pics/').$value['private_pic_name']; ?>"
                                                   style="width: 80px; height: 80px">
                                        </div>
                                    <?php } }else{ ?>
                                        <h3 class="text-center">No Photos Found</h3>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="musl-button-back" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            

        </div>


    <?php } ?>

</div>