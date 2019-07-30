 <?php foreach ($downloads as $key => $value) { ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                        <div class="portlet light portlet-fit bordered resource_action">
                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-news font-white bg-blue" style="">
                                        <div class="list-head-title-container">
                                           <!--  <span class="badge badge-primary pull-right">#1</span> -->
                                            <h4 class="list-title" style="text-align: left;"><?php echo $value['Download_Title']; ?></h4>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-list-container list-news" style="">
                                   <a class="img-link" href="<?php echo base_url('assets/uploads/downloads/').$value['Download_File']; ?>" data-resource-id="362" ><img src="<?php echo base_url('assets/images/PDF.png'); ?>" style="width: auto; max-height: 150px; display: block; margin: 0 auto;"></a>
                                                            <ul style="padding-top: 15px;">
                                            <li class="mt-list-item">
                                                <div class="list-item-content" style="min-height: 50px;">
                                                    <?php echo html_entity_decode($value['Download_Description']); ?>
                                                    
                                                </div>

                                                <div class="list-item-content" style="padding-right: 0;">
                                                
                                                    <!-- http://d25a3umysx9zir.cloudfront.net/downloads/videos/ee_animated_logo.mp4.zip -->
                                                 <a href="<?php echo base_url('assets/uploads/downloads/').$value['Download_File']; ?>" id="362" target="_blank">
                                                <button class="btn red-mint btn-block" type="submit">Download</button></a>
                                                <div id="body1" style="display:none;"><?php echo base_url('assets/uploads/downloads/').$value['Download_File']; ?></div>
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>

                    </div>
       
                   
<?php } 

if(count($downloads) < DEFAULT_NO_PER_PAGE){
    echo '<h3 class="text-center">No More Files</h3>';
}else{
    echo ' <div class="clearfix"></div><div class="button_container">                      
    <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333" id="load_more_btn" onclick="load_more('.($page+1).');"> <span class="ladda-label"> Load More</span> </button>
</div>';
}


?>