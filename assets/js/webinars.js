var userDataTable = "";
$(document).ready(function() {
    $('.bs-select').selectpicker();
    tinymce.init({
        selector: '#Video_Description',
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
    });
    // $('#User_Contact').forceNumeric();
    userDataTable = $('#user_datatable').DataTable({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "autoWidth ": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "webinars/fetch_webinar_videos",
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
        rules: {
            Video_Description: {
                required: true,
            },
        },
        messages: {
            Video_Description: {
                required: "Please enter video discription",
            },
        },
        submitHandler: function() {
            var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'webinars/add_video', {
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


 $("#webinar_event_form").validate({
        ignore: [],
        
        submitHandler: function() {
            var l = Ladda.create(document.querySelector('#webinar_event_form .ladda-button'));
            l.start();
            var formData = new FormData($('#webinar_event_form')[0]);
            $.ajax(ajax_url + 'webinars/add_event', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                        $("#webinar_event_form")[0].reset();
                        $('#calendar1').fullCalendar('refetchEvents');
                        $('.event-form-title').text('Add New Event');
                        $('#cancel_btn').hide();
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });

function edit_user(user_id) {
    $.post(ajax_url + 'webinars/get_video', {
        'id': user_id
    }, function(data, textStatus, xhr) {
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        if (data.flash_status) {
            $('#Video_Id').val(data.data.Video_Id);
            $('#Video_Title').val(data.data.Video_Title);
            $('#Video_File').val(data.data.Video_File);
            $('#Video_Format').selectpicker('val',data.data.Video_Format);
            $('#Video_Format').selectpicker('refresh');
            tinymce.get("Video_Description").setContent(data.data.Video_Description);
            /*var s = $('#Video_Description').val(data.data.Video_Description);
            tinymce.activeEditor.setContent(s);*/
            $('#Video_Tags').selectpicker('val',data.data.Video_Tags);
            $('#Video_Tags').selectpicker('refresh');
            $("#user_heading_page").text('Edit Video');
            $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        } else {
            notification(data.flash_title, data.flash_message, false);
        }
    });
}

function cancel_edit() {
    $('#Video_Id').val('');
    $('#add_user')[0].reset();
    $('#Video_Tags').selectpicker('refresh');
    $('#Video_Format').selectpicker('refresh');
    $('#user_heading_page').text('Add Video');
    $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>');
}

function watch_video(video_id){
    var html = $('#body_'+video_id+'').html();
    $('#popup_video_block').html(html);
}

function load_more(page){
    if($('.ladda-button').length){
        var l = Ladda.create(document.querySelector('.ladda-button'));
        l.start();
     }
     $.post(ajax_url + 'webinars/view_webinars', {
            'search': $('#video_search').val(),
            'page': page
        }, function(data, textStatus, xhr) {
            $('#load_more_btn').remove();
            if(page == '1'){
                $('#video_block_section').html(data);
            }else{
                $('#video_block_section').append(data);
            }
            if($('.ladda-button').length){
                l.stop();
            }
        });
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
                        $.post(ajax_url + 'webinars/activate_account', {
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
                        $.post(ajax_url + 'webinars/delete_user', {
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



function default_video(user_id, msg) {
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
                        $.post(ajax_url + 'webinars/default_video', {
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