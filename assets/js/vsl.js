var userDataTable = "";
$(document).ready(function() {
    $('.bs-select').selectpicker();
   
    // $('#User_Contact').forceNumeric();
    userDataTable = $('#user_datatable').DataTable({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "autoWidth ": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "vsl/fetch_templates",
            type: "POST",
            dataType: 'json',
            data: function(d) {},
        },
        // "oLanguage":
        // {
        //     sProcessing: '<div class="animationload"><div class="osahanloading"></div></div>',
        //     sEmptyTable: "No keywords found!"
        // },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });
    $("#add_user").validate({
        ignore: [],
        /*rules: {
            Video_Description: {
                required: true,
            },
        },
        messages: {
            Video_Description: {
                required: "Please enter video discription",
            },
        },*/
        submitHandler: function() {
            tinyMCE.triggerSave();
            var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'vsl/add_vsl', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                        cancel_edit();
                        userDataTable.ajax.reload(null, false);
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });
});

function load_more(page){
    if($('.ladda-button').length){
        var l = Ladda.create(document.querySelector('.ladda-button'));
        l.start();
     }
     $.post(ajax_url + 'vsl/vsl_list', {
           //'search': $('#video_search').val(),
           'program_id': $('#program_id').val(),
            'page': page
        }, function(data, textStatus, xhr) {
            $('#load_more_btn').remove();
            if(page == '1'){
                $('#page_block_section').html(data);
            }else{
                $('#page_block_section').append(data);
            }
            if($('.ladda-button').length){
                l.stop();
            }
        });
}

function get_template_fields(obj){
    if($('#Template_Data_Id').val() != ''){
        return;
    }
    $('#page_link').attr('href',ajax_url+'vsl/view_template/'+$(obj).find(':selected').attr('data-id'));

    $.post(ajax_url + 'vsl/get_template_fields', {
        'id': $(obj).val()
    }, function(data, textStatus, xhr) {

       
        /*$('html,body').animate({
            scrollTop: 0
        }, 500);*/
        $('#template_fields').html(data);

    //       tinymce.init({
    //     selector: '.textarea_field',
    //     height: 200,
    //     theme: 'modern',
    //     plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
    //     toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    //     image_advtab: true,
    //     templates: [{
    //         title: 'Test template 1',
    //         content: 'Test 1'
    //     }, {
    //         title: 'Test template 2',
    //         content: 'Test 2'
    //     }],
    //     content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tinymce.com/css/codepen.min.css']
    // });
        
    }); 
}


function edit_user(user_id) {
    $('#template_fields').empty();
    cancel_edit();
    $.post(ajax_url + 'vsl/get_page', {
        'id': user_id
    }, function(data, textStatus, xhr) {
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        if (data.flash_status) {
            
            $('#Template_Data_Id').val(data.data.Template_Data_Id);
            
            $('#Program_Id').selectpicker('val',data.data.Program_Id);
            $('#Program_Id').selectpicker('refresh');
             $('#Template_Id').selectpicker('val',data.data.Template_Id);
            $('#Template_Id').selectpicker('refresh');
            $('#Template_Type').val('VSL');
            $('#template_fields').html(data.data.html);
            /*tinymce.get("Video_Description").setContent(data.data.Video_Description);*/
            /*var s = $('#Video_Description').val(data.data.Video_Description);
            tinymce.activeEditor.setContent(s);*/
            $("#user_heading_page").text('Edit Video Sales Page');
            $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        } else {
            notification(data.flash_title, data.flash_message, false);
        }
    });
}

function cancel_edit() {
    $('#template_fields').empty();
    $('#Template_Data_Id').val('');
    $('#add_user')[0].reset();
    $('#Program_Id').val('');
    $('#Template_Type').val('VSL');
    $('#Template_Id').val('');
    $('#Program_Id').selectpicker('refresh');
    $('#Template_Id').selectpicker('refresh');
    $('#user_heading_page').text('Add Video Sales Page');
    $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>');
}

function watch_video(video_id){
    var html = $('#body_'+video_id+'').html();
    $('#popup_video_block').html(html);
}

function activate_account(user_id, status, msg) {
    msg = msg.split('_').join(' ');
    $.confirm({
        title: 'Confirm!',
        content: msg,
        buttons: {
            confirm: {
                keys: ['enter'],
                "scrollX": true,
                btnClass: 'btn-confirm',
                action: function() {
                    if (user_id != '' && status != '') {
                        $.post(ajax_url + 'vsl/activate_account', {
                            'id': user_id,
                            'status': status
                        }, function(data, textStatus, xhr) {
                            notification(data.flash_title, data.flash_message, data.flash_status);
                            if (data.flash_status) {
                                userDataTable.ajax.reload(null, false);
                            }
                        });
                    } else {
                        notification('Error!', 'Invalid argument', false);
                    }
                },
            },
            cancel: {
                keys: ['esc'],
                btnClass: 'btn-cancel',
            }
        }
    });
}

function perm_delete(user_id, msg) {
    msg = msg.split('_').join(' ');
    $.confirm({
        title: 'Confirm!',
        content: msg,
        buttons: {
            confirm: {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function() {
                    if (user_id != '') {
                        $.post(ajax_url + 'vsl/delete_user', {
                            'id': user_id,
                        }, function(data, textStatus, xhr) {
                            notification(data.flash_title, data.flash_message, data.flash_status);
                            if (data.flash_status) {
                                userDataTable.ajax.reload(null, false);
                            }
                        });
                    } else {
                        notification('Error!', 'Invalid argument', false);
                    }
                },
            },
            cancel: {
                keys: ['esc'],
                btnClass: 'btn-cancel',
            }
        }
    });
}

function AddRemoveTinyMce(editorId) {
	if(tinyMCE.get(editorId)) 
	{
		tinyMCE.EditorManager.execCommand('mceFocus', false, editorId);                    
		tinyMCE.EditorManager.execCommand('mceRemoveEditor', true, editorId);
        tinymce.EditorManager.execCommand('mceAddEditor', false, editorId); 

	} else {
		tinymce.EditorManager.execCommand('mceAddEditor', false, editorId);				
	}
}

function check_type(obj){
	alert($(obj).val());
	if($(obj).val()=='Aweber'){
		$(obj).parents('.main_container_selection').find('.aweber_list_conatiner').show();
		$(obj).parents('.main_container_selection').find('.get_response_list_conatiner').hide();
	} else{
		$(obj).parents('.main_container_selection').find('.aweber_list_conatiner').hide();
		$(obj).parents('.main_container_selection').find('.get_response_list_conatiner').show();
	}
}

function update_list_capture(obj){
	formdata = $(obj).parents('.main_container_selection').serialize();
	$.post(ajax_url + 'vsl/save_list', formdata, function(data, textStatus, xhr) {
		console.log('data',data);
	    notification(data.flash_title, data.flash_message, data.flash_status);
	});
}


