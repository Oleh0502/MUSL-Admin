var userDataTable = "";
$(document).ready(function() {
    $('.bs-select').selectpicker();
    $('.bs-select').selectpicker();
    tinymce.init({
        selector: '#Download_Description',
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
            url: ajax_url + "downloads/fetch_downloads",
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
    $("#download_file_form").validate({
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
            var l = Ladda.create(document.querySelector('#download_file_form .ladda-button'));
            l.start();
            var formData = new FormData($('#download_file_form')[0]);
            $.ajax(ajax_url + 'downloads/add_download', {
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


function edit_user(user_id) {
    $.post(ajax_url + 'downloads/get_download', {
        'id': user_id
    }, function(data, textStatus, xhr) {
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        if (data.flash_status) {
            $('#Download_Id').val(data.data.Download_Id);
            $('#Download_Title').val(data.data.Download_Title);
            $('#Download_File').removeClass('required');
            $('#File_Image').removeClass('required');
            //$('#Video_File').val(data.data.Video_File);
           
            tinymce.get("Download_Description").setContent(data.data.Download_Description);
            $("#user_heading_page").text('Edit File');
            $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        } else {
            notification(data.flash_title, data.flash_message, false);
        }
    });
}

function cancel_edit() {
    $('#Download_Id').val('');
    $('#download_file_form')[0].reset();
    $('#Download_File').addClass('required');
    $('#File_Image').addClass('required');
    $('#user_heading_page').text('Add New File');
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
     $.post(ajax_url + 'downloads/view_downloads', {
            'search': $('#video_search').val(),
            'page': page
        }, function(data, textStatus, xhr) {
            $('#load_more_btn').remove();
            if(page == '1'){
                $('#downloads_block_section').html(data);
            }else{
                $('#downloads_block_section').append(data);
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
                        $.post(ajax_url + 'downloads/activate_download', {
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
                        $.post(ajax_url + 'downloads/delete_download', {
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