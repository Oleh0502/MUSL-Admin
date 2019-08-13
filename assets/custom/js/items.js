var userDataTable = "";

$(document).ready(function()

{

    $('#User_Id').selectpicker();
	/*tinymce.init({

        selector: '#Description_Value',

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

    });*/

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

            url: ajax_url + "items/fetch_tasks",

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





	$("#add_task").validate(

    {

        rules:

        {

            Heading:

            {

                required: true,

                minlength: 2,

                maxlength: 100,

            },

           /* Description_Value:

            {

                required: true,

            }*/

        },

        messages:

        {

            Heading:

            {

                required: "Please enter item name",

                minlength: "Please enter minimum 2 characters",

                maxlength: "Item name should be less than 100 characters",

            },

          /*  Description_Value:

            {

                required: "Please enter description",

            }*/

        },

        submitHandler: function()

        {

        	// $('#'Description').html( tinymce.get('Description').getContent() );

        	/*var val = tinymce.get("Description_Value").getContent();

        	$('#Description_Value').val(val);*/

            var l = Ladda.create(document.querySelector('#add_task .ladda-button'));

            l.start();

            var formData = new FormData($('#add_task')[0]);

            $.ajax(ajax_url + 'items/add_task',

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





function view_notification(user_id)

{

    $.post(ajax_url + 'items/get_notification',

    {

        'id': user_id

    }, function(data, textStatus, xhr)

    {

        if (data.flash_status)

        {

            $('#description_id').html(data.description);

            $('#view_customer').modal('show');

        }

        else

        {

            notification(data.flash_title,data.flash_message,false);

        }

    });

}



function get_task(user_id)

{

    $.post(ajax_url + 'items/get_task',

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

        	$('#Item_Id').val(data.data.Item_Id);

        	$('#Item_Title').val(data.data.Item_Title);

            // $('#User_Id').selectpicker('val',data.data.User_Id);
            // $('#User_Id').selectpicker('refresh');

        	//tinyMCE.get('Description_Value').setContent(data.description);

            $("#user_heading_page").text('Edit Task');

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

	//tinyMCE.get('Description_Value').setContent('');

    $('#user_heading_page').val('');

    $('#add_task')[0].reset();

    $('#user_heading_page').text('Add Task');

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
                        $.post(ajax_url + 'items/activate_account',
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


function perm_delete(user_id)

{

    $.confirm(

    {

        title: 'Confirm!',

        content: 'Do you want to delete the task ?',

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

                        $.post(ajax_url + 'items/delete_notification',

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