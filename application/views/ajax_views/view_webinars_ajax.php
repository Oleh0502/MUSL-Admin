 <?php foreach ($videos as $key => $value) { ?>
        
    <!--       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="portlet light portlet-fit bordered resource_action">
                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-news font-white bg-blue" style="">
                                        <div class="list-head-title-container">
                                            <span class="badge badge-primary pull-right">#<?php echo $key+1; ?></span>
                                            <h4 class="list-title" style="text-align: left;"><?php echo $value['Video_Title']; ?></h4>
                                        </div>
                                    </div>

                                    <div class="mt-list-container list-news" style="padding-top: 0;">
                                    <a class="img-link" data-resource-id="330" data-toggle="modal" onclick="watch_video('<?php echo $value['Video_Id']; ?>');" href="#popup_video_modal"><img src="<?php echo $value['Video_Image']; ?>" style="width: 100%;"></a>
                                         <ul style="padding-top: 15px;">
                                            <li class="mt-list-item">
                                                <?php foreach (get_tags_by_comma($value['Video_Tags']) as $k => $tag) { ?>
                                                   <label class="btn blue btn-outline sbold btn-xs"><?php echo $tag['Tag_Name']; ?> </label>
                                                <?php } ?>
                                                
                                            </li>
                                            <li class="mt-list-item">
                                                <div class="list-item-content" style="min-height: 50px;">
                                                   <?php echo html_entity_decode($value['Video_Description']); ?>

                                                </div>

                                                <div class="list-item-content" style="padding-right: 0;">


                <a class="btn green-soft btn-block normal-link" id="330" data-toggle="modal" onclick="watch_video('<?php echo $value['Video_Id']; ?>');" href="#popup_video_modal">Watched Video</a>
            <div id="body_<?php echo $value['Video_Id']; ?>" style="display:none;"><?php echo $value['Video_Iframe']; ?></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div> -->
                     <div class="col-sm-12">
                <div class="portlet box green theme-color-box">
                    <div class="portlet-title">
                        <div class="video-title"><?php echo $value['Video_Title']; ?> <span class="badge badge-primary pull-right">#<?php echo $key+1; ?></span></div>                         
                    </div>
                    <div class="portlet-body">
                        <div class="row row-flex">
                            <div class="col-md-3 col-sm-4">
                               <a class="img-link" data-resource-id="330" data-toggle="modal" onclick="watch_video('<?php echo $value['Video_Id']; ?>');" href="#popup_video_modal"><img class="img-responsive" src="<?php echo $value['Video_Image']; ?>">
                               </a>
                            </div>
                            <div class="col-md-9 col-md-8">                               
                                <div class="video-tags">
                                     <h3>Video Tags</h3>
                                <?php foreach (get_tags_by_comma($value['Video_Tags']) as $k => $tag) { ?>
                                   <label class="btn blue btn-outline sbold btn-xs"><?php echo $tag['Tag_Name']; ?> </label>
                                <?php } ?>      
                                </div>                          
                                <div class="video-content">
                                   <?php echo html_entity_decode($value['Video_Description']); ?>
                                </div>
                                <a class="btn watch-btn green-soft btn-block normal-link" id="330" data-toggle="modal" onclick="watch_video('<?php echo $value['Video_Id']; ?>');" href="#popup_video_modal">Watched Video</a>
                                <div id="body_<?php echo $value['Video_Id']; ?>" style="display:none;"><?php echo $value['Video_Iframe']; ?></div> 
                            </div>
                        </div>

                    </div>

                </div>
            </div>
                   
<?php } 

if(count($videos) < DEFAULT_NO_PER_PAGE){
    echo '<h3 class="text-center">No More Videos</h3>';
}else{
    echo ' <div class="clearfix"></div><div class="button_container">                      
    <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333" id="load_more_btn" onclick="load_more('.($page+1).');"> <span class="ladda-label"> Load More</span> </button>
</div>';
}


?>