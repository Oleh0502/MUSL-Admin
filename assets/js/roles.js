var userDataTable = "";
$(document).ready(function()
{
    //$('#User_Contact').forceNumeric();
    userDataTable = $('#user_datatable').DataTable(
    {
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax":
        {
            url: ajax_url + "roles/fetch_roles",
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
    $("#add_role").validate(
    {
        rules:
        {
            Role_Name:
            {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
        },
        messages:
        {
            Role_Name:
            {
                required: "Please enter role title",
                minlength: "Please enter minimum 2 characters",
                maxlength: "Role title should be less than 20 characters",
            }
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#add_role .ladda-button'));
            l.start();
            var formData = new FormData($('#add_role')[0]);
            $.ajax(ajax_url + 'roles/add_role',
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

function edit_role(role_id)
{
    $.post(ajax_url + 'roles/get_role',
    {
        'id': role_id
    }, function(data, textStatus, xhr)
    {
        $('html,body').animate(
        {
            scrollTop: 0
        }, 500);
        if (data.flash_status)
        {
            $('#Role_Id').val(data.data.Role_Id);
            $('#Role_Name').val(data.data.Role_Name);
            $('#permission_block').html(data.permission_block);
            $("#user_heading_page").text('Edit Role');
            $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>'); }
        else
        {
        	notification(data.flash_title,data.flash_message,false);
        }
    });
}

function cancel_edit()
{
    $('#Role_Id').val('');
    $('#add_role')[0].reset();
    $('#user_heading_page').text('Add Role');
    $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>'); $('.parent_input').each(function()
    {
        $(this).removeAttr('checked');
        $(this).parents('td').siblings('td').find('.sub_input').attr('disabled', 'disabled').removeAttr('checked');
    })
}

function check_all_check(obj)
{
    if ($(obj).is(':checked'))
    {
        $(obj).parents('td').siblings('td').find('input').removeAttr ('disabled')
        $(obj).parents('td').siblings('td').find('input').prop('checked', 'checked');
    }
    else
    {
        $(obj).parents('td').siblings('td').find('input').prop('disabled', 'disabled');
        $(obj).parents('td').siblings('td').find('input').removeAttr('checked');
    }
}

function check_all_check2(obj)
{
    var total = $(obj).parents('tr').find('.sub_input').length;
    var nonempty = $(obj).parents('tr').find('.sub_input').filter(function()
    {
        if ($(this).is(':checked'))
        {
            return $(this).val();
        }
    });
    if (nonempty.length == 0)
    {
        $(obj).parents('tr').find('.parent_input').removeAttr('checked');
        $(obj).parents('tr').find('.parent_input').parents('td').siblings('td').find('.sub_input').attr('disabled', 'disabled');
    }
}

function activate_role(role_id, status, msg)
{
    $.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to ' + msg + ' role?',
        buttons:
        {
            confirm:
            {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function()
                {
                    if (role_id != '' && status != '')
                    {
                        $.post(ajax_url + 'roles/activate_role',
                        {
                            'id': role_id,
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
                    	notification('Error','Invalid argument',false);
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

function perm_delete(role)
{
    $.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to delete role?',
        buttons:
        {
            confirm:
            {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function()
                {
                    if (role != '')
                    {
                        $.post(ajax_url + 'roles/delete_role',
                        {
                            'id': role,
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
                    	notification('Error','Invalid argument',false);
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