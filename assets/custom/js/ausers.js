var userDataTable = "";
$(document).ready(function()
{
    // $('#User_Contact').forceNumeric();
    userDataTable = $('#user_datatable').DataTable(
    {
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "autoWidth ": false,
        "serverSide": true,
        "order": [],
        "ajax":
        {
            url: ajax_url + "ausers/fetch_users",
            type: "POST",
            dataType: 'json',
            data: function(d) {},
        },
        // "oLanguage":
        // {
        //     sProcessing: '<div class="animationload"><div class="osahanloading"></div></div>',
        //     sEmptyTable: "No keywords found!"
        // },
        "aoColumnDefs": [
        {
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });
    $("#add_user").validate(
    {
        rules:
        {
            User_First_Name:
            {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            User_Last_Name:
            {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            User_Email:
            {
                required: true,
                email: true
            },
            User_Phone:
            {
                required: true,
                number: true
            }
        },
        messages:
        {
            User_First_Name:
            {
                required: "Please enter first name",
                minlength: "Please enter minimum 2 characters",
                maxlength: "First name should be less than 20 characters",
            },
            User_Last_Name:
            {
                required: "Please enter last name",
                minlength: "Please enter minimum 2 characters",
                maxlength: "Last name shoull be less than 20 characters",
            },
            User_Email:
            {
                required: "Please enter email",
                email: "Please enter valid email"
            },
            User_Phone:
            {
                required: "Please enter contact number",
                number: "Please enter valid contact number"
            }
        },
        submitHandler: function()
        {
            // var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            // l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'ausers/add_user',
            {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async : true,
                success: function(data)
                {
                	notification(data.flash_title,data.flash_message,data.flash_status);
                    if (data.flash_status)
                    {
                        cancel_edit();
                        userDataTable.ajax.reload(null, false);
                    }

                },
                complete: function()
                {
                    //l.stop();
                }
            });
        }
    });
});

function edit_user(user_id)
{
    $.post(ajax_url + 'ausers/get_user',
    {
        'id': user_id
    }, function(data, textStatus, xhr)
    {
        $('html,body').animate(
        {
            scrollTop: 0
        }, 500);
        if (data.flash_status)
        {
            $('#User_Id').val(data.data.User_Id);
            $('#User_First_Name').val(data.data.User_First_Name);
            $('#User_Last_Name').val(data.data.User_Last_Name);
            $('#User_Email').val(data.data.User_Email).attr('readonly', 'readonly');
            $('#User_Phone').val(data.data.User_Phone);
            $("#Role").val(data.data.Role);
            $("#user_heading_page").text('Edit User');
            $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        }
        else
        {
            notification(data.flash_title,data.flash_message,false);
        }
    });
}

function cancel_edit()
{
    $('#User_Id').val('');
    $('#add_user')[0].reset();
    $('#User_Email').removeAttr('readonly', 'readonly');
    $('#user_heading_page').text('Add User');
    $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>');
}

function activate_account(user_id, status, msg)
{
    msg = msg.split('_').join(' ');
    $.confirm(
    {
        title: 'Confirm!',
        content: msg ,
        buttons:
        {
            confirm:
            {
                keys: ['enter'],
                "scrollX": true,
                btnClass: 'btn-confirm',
                action: function()
                {
                    if (user_id != '' && status != '')
                    {
                        $.post(ajax_url + 'ausers/activate_account',
                        {
                            'id': user_id,
                            'status': status
                        }, function(data, textStatus, xhr)
                        {
                        	notification(data.flash_title,data.flash_message,data.flash_status);
                            if (data.flash_status)
                            {
                                userDataTable.ajax.reload(null, false);
                            }
                            
                        });
                    }
                    else
                    {
                    	notification('Error!','Invalid argument',false);
                    }
                },
            },
            cancel:
            {
                keys: ['esc'],
                btnClass: 'btn-cancel',
            }
        }
    });
}

function perm_delete(user_id,msg)
{
     msg = msg.split('_').join(' ');
    $.confirm(
    {
        title: 'Confirm!',
        content: msg,
        buttons:
        {
            confirm:
            {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function()
                {
                    if (user_id != '')
                    {
                        $.post(ajax_url + 'ausers/delete_user',
                        {
                            'id': user_id,
                        }, function(data, textStatus, xhr)
                        {
                        	notification(data.flash_title,data.flash_message,data.flash_status);
                            if (data.flash_status)
                            {
                              	userDataTable.ajax.reload(null, false);
                            }
                        });
                    }
                    else
                    {
                    	notification('Error!','Invalid argument',false);
                    }
                },
            },
            cancel:
            {
                keys: ['esc'],
                btnClass: 'btn-cancel',
            }
        }
    });
}