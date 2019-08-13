var Common_Data_Table;
$(document).ready(function() {
    Common_Data_Table = $('#user_datatable').DataTable({
        "processing": true,
        "scrollX": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "emails/fetch_emails",
            type: "POST",
            dataType: 'json',
            data: function(d) {},
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });
    $('#user_datatable_customer').DataTable({
        "processing": true,
        "scrollX": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "emails/fetch_emails_auto",
            type: "POST",
            dataType: 'json',
            data: function(d) {},
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });
    //Item Category Issue
    $("#add_email_form").validate({
        ignore: [],
        rules: {
            Add_Program_Id: {
                required: true,
            },
            Add_Title: {
                required: true,
            },
            Add_Subject: {
                required: true,
            },
            Add_Days: {
                required: true,
            },
            Add_Content: {
                required: true,
            },
        },
        messages: {
            Add_Program_Id: {
                required: "Program is required",
            },
            Add_Title: {
                required: "Title Field is required",
            },
            Add_Subject: {
                required: "Subject Field is required",
            },
            Add_Days: {
                required: "Days Field is required",
            },
            Add_Content: {
                required: "Content is required",
            },
        },
        submitHandler: function() {
            tinyMCE.triggerSave();
            var l = Ladda.create(document.querySelector('#add_email_form .ladda-button'));
            l.start();
            var formData = new FormData($('#add_email_form')[0]);
            $.ajax(ajax_url + 'emails/add_email', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                        Common_Data_Table.ajax.reload(null, false);
                        $('#add_email_form')[0].reset();
                        $('#add_email').modal('hide');
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });

    $("#add_email_form_auto").validate({
        ignore: [],
        rules: {
            Add_Program_Id: {
                required: true,
            },
            Add_Title: {
                required: true,
            },
            Add_Subject: {
                required: true,
            },
            Add_Days: {
                required: true,
            },
            Add_Content: {
                required: true,
            },
        },
        messages: {
            Add_Program_Id: {
                required: "Program is required",
            },
            Add_Title: {
                required: "Title Field is required",
            },
            Add_Subject: {
                required: "Subject Field is required",
            },
            Add_Days: {
                required: "Days Field is required",
            },
            Add_Content: {
                required: "Content is required",
            },
        },
        submitHandler: function() {
            tinyMCE.triggerSave();
            var l = Ladda.create(document.querySelector('#add_email_form_auto .ladda-button'));
            l.start();
            var formData = new FormData($('#add_email_form_auto')[0]);
            $.ajax(ajax_url + 'emails/add_email', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                        setTimeout(function(){
	                        window.location.reload();
                    	},500)
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });
    $("#edit_email_form").validate({
        ignore: [],
        rules: {
            Edit_Program_Id: {
                required: true,
            },
            Edit_Title: {
                required: true,
            },
            Edit_Subject: {
                required: true,
            },
            Edit_Days: {
                required: true,
            },
            Edit_Content: {
                required: true,
            },
        },
        messages: {
            Edit_Program_Id: {
                required: "Program is required",
            },
            Edit_Title: {
                required: "Title Field is required",
            },
            Edit_Subject: {
                required: "Subject Field is required",
            },
            Edit_Days: {
                required: "Days Field is required",
            },
            Edit_Content: {
                required: "Content is required",
            },
        },
        submitHandler: function() {
            tinyMCE.triggerSave();
            var l = Ladda.create(document.querySelector('#edit_email_form .ladda-button'));
            l.start();
            var formData = new FormData($('#edit_email_form')[0]);
            console.log('formData',formData);
            $.ajax(ajax_url + 'emails/edit_email', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                        Common_Data_Table.ajax.reload(null, false);
                        $('#edit_email_form')[0].reset();
                        $('#edit_email').modal('hide');
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });

    $("#edit_email_form_auto").validate({
        ignore: [],
        rules: {
            Edit_Program_Id: {
                required: true,
            },
            Edit_Title: {
                required: true,
            },
            Edit_Subject: {
                required: true,
            },
            Edit_Days: {
                required: true,
            },
            Edit_Content: {
                required: true,
            },
        },
        messages: {
            Edit_Program_Id: {
                required: "Program is required",
            },
            Edit_Title: {
                required: "Title Field is required",
            },
            Edit_Subject: {
                required: "Subject Field is required",
            },
            Edit_Days: {
                required: "Days Field is required",
            },
            Edit_Content: {
                required: "Content is required",
            },
        },
        submitHandler: function() {
            tinyMCE.triggerSave();
            var l = Ladda.create(document.querySelector('#edit_email_form_auto .ladda-button'));
            l.start();
            var formData = new FormData($('#edit_email_form_auto')[0]);
            console.log('formData',formData);
            $.ajax(ajax_url + 'emails/edit_email', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    if (data.flash_status) {
                    	setTimeout(function(){
	                        window.location.reload();
                    	},500)
                    }
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });
});
function add_email(){
	$('#add_email').modal('show');
	AddRemoveTinyMce('Add_Content');
}
function edit_email(id){
	$('#edit_email').modal('show');
    $.post(ajax_url + 'emails/get_email', {
        'id': id
    }, function(data, textStatus, xhr) {
        if (data.flash_status) {
            $('#Edit_Id').val(data.data.Email_Id);
            $('#Edit_Title').val(data.data.Email_Title);
            $('#Edit_Subject').val(data.data.Email_Subject);
            $('#Edit_Days').val(data.data.Days);
            $('#Edit_Program_Id').val(data.data.Program_Id);
            // $('#Edit_Content').val(data.data.Email_Body);
			AddRemoveTinyMce('Edit_Content');
			// AddRemoveTinyMce('Edit_Content2');
			setTimeout(function(){ tinyMCE.activeEditor.setContent(data.data.Email_Body); }, 500);
        } else {
            notification(data.flash_title, data.flash_message, false);
        }
    });
}

function view_email(id){
    $.post(ajax_url + 'emails/get_email', {
        'id': id
    }, function(data, textStatus, xhr) {
        if (data.flash_status) {
            $('#View_Subject').html(data.data.Email_Subject);
			$('#View_Content').html(data.data.Email_Body);
			$('#view_email').modal('show');
        } else {
            notification(data.flash_title, data.flash_message, false);
        }
    });
}
function perm_delete(user_id) {
    $.confirm({
        title: 'Confirm!',
        content: 'Do you want to delete Email ? ',
        buttons: {
            confirm: {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function() {
                    if (user_id != '') {
                        $.post(ajax_url + 'emails/delete_email', {
                            'id': user_id,
                        }, function(data, textStatus, xhr) {
                            notification(data.flash_title, data.flash_message, data.flash_status);
                            if (data.flash_status) {
                                Common_Data_Table.ajax.reload(null, false);
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

function perm_delete_auto(user_id) {
    $.confirm({
        title: 'Confirm!',
        content: 'Do you want to delete Email ? ',
        buttons: {
            confirm: {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function() {
                    if (user_id != '') {
                        $.post(ajax_url + 'emails/delete_email', {
                            'id': user_id,
                        }, function(data, textStatus, xhr) {
                            notification(data.flash_title, data.flash_message, data.flash_status);
                            if (data.flash_status) {
                                setTimeout(function(){
			                        window.location.reload();
		                    	},500)
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