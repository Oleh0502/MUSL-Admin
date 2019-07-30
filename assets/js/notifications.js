var userDataTable = "";

$(document).ready(function()

{

	tinymce.init({

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

    });

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

            url: ajax_url + "notifications/fetch_notifications",

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





	$("#add_notification").validate(

    {

        rules:

        {

            Heading:

            {

                required: true,

                minlength: 2,

                maxlength: 100,

            },

            Description_Value:

            {

                required: true,

            }

        },

        messages:

        {

            Heading:

            {

                required: "Please enter notification heading",

                minlength: "Please enter minimum 2 characters",

                maxlength: "Deading name should be less than 100 characters",

            },

            Description_Value:

            {

                required: "Please enter description",

            }

        },

        submitHandler: function()

        {

        	// $('#'Description').html( tinymce.get('Description').getContent() );

        	var val = tinymce.get("Description_Value").getContent();

        	$('#Description_Value').val(val);

            var l = Ladda.create(document.querySelector('#add_notification .ladda-button'));

            l.start();

            var formData = new FormData($('#add_notification')[0]);

            $.ajax(ajax_url + 'notifications/add_notification',

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

    $.post(ajax_url + 'notifications/get_notification',

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



function edit_notification(user_id)

{

    $.post(ajax_url + 'notifications/get_notification',

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

        	$('#Notification_Id').val(data.data.Noti_Id);

        	$('#Heading').val(data.data.Heading);

        	tinyMCE.get('Description_Value').setContent(data.description);

            $("#user_heading_page").text('Edit Notification');

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

	tinyMCE.get('Description_Value').setContent('');

    $('#user_heading_page').val('');

    $('#add_notification')[0].reset();

    $('#user_heading_page').text('Add Notification');

    $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button>');

}





function perm_delete(user_id)

{

    $.confirm(

    {

        title: 'Confirm!',

        content: 'Do you want to delete the notification ?',

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

                        $.post(ajax_url + 'notifications/delete_notification',

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