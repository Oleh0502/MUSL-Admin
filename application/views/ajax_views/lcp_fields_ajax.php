
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   
        <label class=" control-label">Select VSL<span>*</span></label>
         <div class="form-group form-grp input-group">
        <select class="bs-select form-control " name="Video_Template_Id" id="Video_Template_Id" data-live-search="true" onchange="$('#page_link_vsl').attr('href',ajax_url+'vsl/page/admin/'+$(this).find(':selected').attr('data-id'));">
            <option value="">Select Template</option>
        <?php 
            if(!empty($video_pages))
            {
                foreach($video_pages as $video_page)
                {
                    $select = '';
                    if(isset($Video_Template_Id) && $video_page['Template_Data_Id'] == $Video_Template_Id){
                        $select = 'selected';
                    }
                    ?>
                    <option <?php echo $select; ?> value="<?php echo $video_page['Template_Data_Id']; ?>" data-id="<?php echo $video_page['Template_Data_Link']; ?>"><?php echo $video_page['Template_Data_Title']; ?></option>
                        <?php
                }
            }
        ?>
        </select>

        <span class="input-group-addon">                              
                <a href="<?php echo base_url(); ?>"  id="page_link_vsl" target="_blank"><i class="fa fa-external-link" ></i></a>
        </span>

    </div> 
</div>

<?php foreach ($data as $key => $value) { ?>

<?php if($value['Template_Field_Type'] == 'text'){ ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"> <?php echo $value['Template_Field_Title']; ?> <span>*</span></label>
                <input type="text" name="Temp_Field[<?php echo $value['Template_Field_Id']; ?>]" id="<?php echo $value['Template_Field_Key']; ?>" class="form-control required" placeholder="<?php echo $value['Template_Field_Placeholder']; ?>" value="<?php echo isset($value['Field_Data_Value'])? $value['Field_Data_Value']:''; ?>">
        </div> 
    </div>

<?php }else if($value['Template_Field_Type'] == 'textarea'){ ?>

    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"><?php echo $value['Template_Field_Title']; ?> <span>*</span></label>
                <textarea name="Temp_Field[<?php echo $value['Template_Field_Id']; ?>]" id="texn_<?php echo $value['Template_Field_Id']; ?>" class="form-control required textarea_field_<?php echo $value['Template_Field_Id']; ?>" placeholder="<?php echo $value['Template_Field_Placeholder']; ?>"><?php echo isset($value['Field_Data_Value'])? stripslashes($value['Field_Data_Value']):''; ?></textarea>
        </div> 
    </div>


     <script type="text/javascript">
        AddRemoveTinyMce('texn_<?php echo $value['Template_Field_Id']; ?>');
	
       /* tinymce.init({
        mode : "textareas",
		editor_selector : "tinymce-enabled-message",     
        selector: '.textarea_field_<?php echo $value['Template_Field_Id']; ?>',
        height: 200,
        theme: 'modern',
        plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }],
        content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tinymce.com/css/codepen.min.css']
    });*/


    </script>


<?php }else if($value['Template_Field_Type'] == 'image'){ ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"><?php echo $value['Template_Field_Title']; ?> <span>*</span></label>
                <input type="file" name="Temp_Field_<?php echo $value['Template_Field_Id']; ?>" id="<?php echo $value['Template_Field_Key']; ?>" class="form-control <?php echo isset($value['Field_Data_Value'])? '':'required'; ?>" placeholder="Video Title" accept="image/*">
        </div> 
    </div>

<?php }else if($value['Template_Field_Type'] == 'video'){ ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"><?php echo $value['Template_Field_Title']; ?> <span>*</span></label>
                <input type="text" name="Temp_Field[<?php echo $value['Template_Field_Id']; ?>]" id="<?php echo $value['Template_Field_Key']; ?>" class="form-control required" placeholder="<?php echo $value['Template_Field_Placeholder']; ?>" value="<?php echo isset($value['Field_Data_Value'])? $value['Field_Data_Value']:''; ?>">
        </div> 
    </div>

<?php } ?>



<?php } ?>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"> Page Title <span>*</span></label>
                <input type="text" name="Template_Data_Title" id="Template_Data_Title" class="form-control required" placeholder="Enter Page Title" value="<?php echo (isset($Template_Data_Title) && !empty($Template_Data_Title))? $Template_Data_Title:''; ?>">
        </div> 
    </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group form-grp">
            <label class="control-label"> Template Page Link <span>*</span></label>
                <input baseurl="<?php echo base_url();?>" type="text" name="Template_Data_Link" id="Template_Data_Link" class="form-control required" placeholder="eg. page_link (use '_' instead of space)" value="<?php echo (isset($Template_Data_Link) && !empty($Template_Data_Link))? $Template_Data_Link:''; ?>" updateslug="<?php echo (isset($Template_Data_Link) && !empty($Template_Data_Link))?'1':'0'; ?>" templateid="<?php echo(isset($Template_Data_Id)? $Template_Data_Id:'');?>">
               <label id="slug-error" class="error"></label>

        </div> 
    </div>
