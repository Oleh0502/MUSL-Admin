function perm_delete(user_id)
{
    $.confirm(
    {
        title: 'Confirm!',
        content: 'Do You want to delete the selected code?',
        buttons:
        {
            confirm:
            {
                keys: ['enter'],
                btnClass: 'btn-confirm',
                action: function()
                {
                    window.location.href = ajax_url+'/tracking/delete_code/'+user_id
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