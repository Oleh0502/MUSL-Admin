var Common_Data_Table;
$(document).ready(function() {
    Common_Data_Table = $('#user_datatable').DataTable({
        "processing": true,
        "scrollX": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "newsletter/fetch_list",
            type: "POST",
            dataType: 'json',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });
});

function delete_news(user_id){
	$.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to delete this user from list?',
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
                        $.post(ajax_url + 'newsletter/delete_news',
                        {
                            'id': user_id
                        }, function(data, textStatus, xhr)
                        {
                        	notification(data.flash_title,data.flash_message,data.flash_status);
                            if (data.flash_status)
                            {
                                Common_Data_Table.ajax.reload(null, false);
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