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
            url: ajax_url + "programs/fetch_tags",
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
       
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'programs/add_tag',
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
                    l.stop();
                }
            });
        }
    });
});

function edit_user(user_id)
{
    $.post(ajax_url + 'programs/get_tag',
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
            $('#Program_Id').val(data.data.Program_Id);
            $('#Program_Name').val(data.data.Program_Name);
            
            $("#user_heading_page").text('Edit Tag');
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
    $('#Program_Id').val('');
    $('#add_user')[0].reset();
    $('#user_heading_page').text('Add Tag');
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
                        $.post(ajax_url + 'programs/activate_account',
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
                        $.post(ajax_url + 'programs/delete_user',
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