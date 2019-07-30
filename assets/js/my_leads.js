var Common_Data_Table;
$(document).ready(function() {
    Common_Data_Table = $('#user_datatable').DataTable({
        "processing": true,
        "scrollX": true,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: ajax_url + "my_leads/fetch_leads",
            type: "POST",
            dataType: 'json',
            data: function(d) {
            	d.status = $('#user_datatable_div').attr('rel-name');
            },
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-sort"]
        }],
    });

    $("#edit_notes_form").validate(
    {
        rules:
        {
            Lead_Id:
            {
                required: true,
            },
            Notes:
            {
                required: true,
            }
        },
        messages:
        {
            Lead_Id:
            {
                required: "Please enter title",
            },
            Notes:
            {
                required: "Please enter notes",
            }
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#edit_notes_form .ladda-button'));
            l.start();
            var formData = new FormData($('#edit_notes_form')[0]);
            $.ajax(ajax_url + 'my_leads/edit_notes_form',
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
                        $('#edit_notes').modal('hide');
                        Common_Data_Table.ajax.reload(null, false);
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

function delete_lead(user_id){
	$.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to delete this lead user?',
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
                        $.post(ajax_url + 'my_leads/delete_lead',
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

function edit_email(user_id){
	if (user_id != '')
    {
        $.post(ajax_url + 'my_leads/get_lead',
        {
            'id': user_id
        }, function(data, textStatus, xhr)
        {
            if (data.flash_status)
            {
                $('#edit_notes').modal('show');
                $('#Lead_Id').val(data.data.Id);
                $('#Notes').val(data.data.Notes);
            }
        });
    }
    else
    {
    	notification('Error','Invalid argument',false);
    }
}