
function activate_account(user_id, status, type)
{
    if(status == '1'){
        msg = 'Do you really want to de-activate this '+type+'?';
    }else{
        msg = 'Do you really want to activate this '+type+'?';
    }
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
                    if (user_id != '')
                    {
                        $.post(ajax_url + 'user_administrator/activate_account',
                        {
                            'id': user_id,
                            'status': status,
                            'type':type
                        }, function(data, textStatus, xhr)
                        {
                        	//notification(data.flash_title,data.flash_message,data.flash_status);
                            if (data.flash_status)
                            {
                                location.reload();
                            }
                            
                        });
                    }
                    else
                    {
                    	//notification('Error!','Invalid argument',false);
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
                        $.post(ajax_url + 'users/delete_user',
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