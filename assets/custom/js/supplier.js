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
            url: ajax_url + "supplier/fetch_users",
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
    $("#edit_user").validate(
    {
        rules:
        {
            edit_User_First_Name:
            {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            edit_User_Last_Name:
            {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            edit_Company:
            {
                required: true
            },
            edit_Address1:
            {
                required: true
            },
            edit_Address2:
            {
                required: true
            },
            edit_City:
            {
                required: true
            },
            edit_State:
            {
                required: true
            },
            edit_Country:
            {
                required: true
            },
            edit_Zipcode:
            {
                required: true
            },
            edit_User_Name:
            {
                required: true
            },
            edit_User_Email:
            {
                required: true,
                email: true
            },
            edit_User_Phone:
            {
                required: true,
                number: true
            }
        },
        messages:
        {
            edit_User_First_Name:
            {
                required: "Please enter first name",
                minlength: "Please enter minimum 2 characters",
                maxlength: "First name should be less than 20 characters",
            },
            edit_User_Last_Name:
            {
                required: "Please enter last name",
                minlength: "Please enter minimum 2 characters",
                maxlength: "Last name shoull be less than 20 characters",
            },
            edit_User_Email:
            {
                required: "Please enter email",
                email: "Please enter valid email"
            },
            edit_User_Phone:
            {
                required: "Please enter contact number",
                number: "Please enter valid contact number"
            },
            edit_Company:
            {
                required: "Please enter Company",
            },
            edit_Address1:
            {
                required: "Please enter Address 1",
            },
            edit_Address2:
            {
                required: "Please enter Address 2",
            },
            edit_City:
            {
                required: "Please enter city",
            },
            edit_State:
            {
                required: "Please enter state",
            },
            edit_Country:
            {
                required: "Please enter country",
            },
            edit_Zipcode:
            {
                required: "Please enter zipcode",
            },
            edit_User_Name:
            {
                required: "Please enter user name",
            }
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#edit_user .ladda-button'));
            l.start();
            var formData = new FormData($('#edit_user')[0]);
            $.ajax(ajax_url + 'supplier/edit_user',
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
	                	$('#edit_customer').modal('toggle');
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
	$("#add_user").validate(
    {
        rules:
        {
            // User_First_Name:
            // {
            //     required: true,
            //     minlength: 2,
            //     maxlength: 20,
            // },
            // User_Last_Name:
            // {
            //     required: true,
            //     minlength: 2,
            //     maxlength: 20,
            // },
            Company:
            {
                required: true
            },
            Address1:
            {
                required: true
            },
            Address2:
            {
                required: true
            },
            City:
            {
                required: true
            },
            State:
            {
                required: true
            },
            Country:
            {
                required: true
            },
            Zipcode:
            {
                required: true
            },
            User_Name:
            {
                required: true
            },
            User_Password:
            {
                required: true
            },
            User_Password_Confirm:
            {
                required: true,
                equalTo: "#User_Password"
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
            // User_First_Name:
            // {
            //     required: "Please enter first name",
            //     minlength: "Please enter minimum 2 characters",
            //     maxlength: "First name should be less than 20 characters",
            // },
            // User_Last_Name:
            // {
            //     required: "Please enter last name",
            //     minlength: "Please enter minimum 2 characters",
            //     maxlength: "Last name shoull be less than 20 characters",
            // },
            User_Email:
            {
                required: "Please enter email",
                email: "Please enter valid email"
            },
            User_Phone:
            {
                required: "Please enter contact number",
                number: "Please enter valid contact number"
            },
            Company:
            {
                required: "Please enter Company",
            },
            Address1:
            {
                required: "Please enter Address 1",
            },
            Address2:
            {
                required: "Please enter Address 2",
            },
            City:
            {
                required: "Please enter city",
            },
            State:
            {
                required: "Please enter state",
            },
            Country:
            {
                required: "Please enter country",
            },
            Zipcode:
            {
                required: "Please enter zipcode",
            },
            User_Name:
            {
                required: "Please enter user name",
            },
            User_Password:
            {
                required: "Please enter password",
            },
            User_Password_Confirm:
            {
                required: "Please enter confirm password",
                equalTo : "password Should be match with confirm password"
            },
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'supplier/add_user',
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
		            	$('#add_customer').modal('toggle');
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


$("#subscription_form").validate(
    {
        rules:
        {
            package_id:
            {
                required: true,
            }
        },
        messages:
        {
            package_id:
            {
                required: "Please select a subscription plan.",
            },
          
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#subscription_form .ladda-button'));
            l.start();
            var formData = new FormData($('#subscription_form')[0]);
            $.ajax(ajax_url + 'supplier/add_subscription',
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
                        $('#subscription_modal').modal('toggle');
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

	$("#reset_password_form").validate(
    {
        rules:
        {
            Reset_User_Id:
            {
                required: true,
            },
            Reset_User_Password:
            {
                required: true
            },
            Reset_User_Password_Confirm:
            {
                required: true,
                equalTo: "#Reset_User_Password"
            }
        },
        messages:
        {
            Reset_User_Password:
            {
                required: "Please enter password",
            },
            Reset_User_Password_Confirm:
            {
                required: "Please enter confirm password",
                equalTo : "password Should be match with confirm password"
            },
        },
        submitHandler: function()
        {
            var l = Ladda.create(document.querySelector('#reset_password_form .ladda-button'));
            l.start();
            var formData = new FormData($('#reset_password_form')[0]);
            $.ajax(ajax_url + 'supplier/reset_user_password',
            {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async : true,
                success: function(data)
                {
                	$('#reset_password_customer').modal('toggle');
                	notification(data.flash_title,data.flash_message,data.flash_status);
                    if (data.flash_status)
                    {
                        $('#reset_password_form')[0].reset();
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
    $.post(ajax_url + 'supplier/get_user',
    {
        'id': user_id
    }, function(data, textStatus, xhr)
    {
        if (data.flash_status)
        {
            $('#edit_user').find('#User_Id').val(data.data.User_Id);
            // $('#edit_user').find('#edit_User_First_Name').val(data.data.User_First_Name);
            // $('#edit_user').find('#edit_User_Last_Name').val(data.data.User_Last_Name);
            $('#edit_user').find('#edit_Company').val(data.data.Company);

            $('#edit_user').find('#edit_Items').val(data.data.Company);
            $('#edit_Items').selectpicker('refresh');

            $('#edit_user').find('#edit_User_Email').val(data.data.User_Email).attr('readonly', 'readonly');
            $('#edit_user').find('#edit_User_Phone').val(data.data.User_Phone);
            $('#edit_user').find('#edit_Company').val(data.data.Company);

            $('#edit_user').find('#edit_Items').val(data.data.Business_Category);
            $('#edit_Items').selectpicker('refresh');

            $('#edit_user').find('#edit_Address1').val(data.data.Address1);
            $('#edit_user').find('#edit_Address2').val(data.data.Address2);
            $('#edit_user').find('#edit_City').val(data.data.City);
            $('#edit_user').find('#edit_State').val(data.data.State);
            $('#edit_user').find('#edit_Country').val(data.data.Country);
            $('#edit_user').find('#edit_Zipcode').val(data.data.Zipcode);
            $('#edit_user').find('#edit_User_Name').val(data.data.User_Name).attr('readonly', 'readonly');
            $('#edit_user').find('#edit_Country').val(data.data.Country);
            $('#edit_user').find("#user_heading_page").text('Edit User');
            // $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        }
        else
        {
            notification(data.flash_title,data.flash_message,false);
        }
    });
}
function view_user(user_id)
{
    $.post(ajax_url + 'supplier/get_user',
    {
        'id': user_id
    }, function(data, textStatus, xhr)
    {
        if (data.flash_status)
        {
            $('#view_customer').find('#view_User_Id').val(data.data.User_Id);
            // $('#view_customer').find('#view_User_First_Name').val(data.data.User_First_Name);
            // $('#view_customer').find('#view_User_Last_Name').val(data.data.User_Last_Name);

            $('#view_user').find('#view_Company').val(data.data.Company);

            $('#view_user').find('#view_Items').val(data.data.Business_Category);
            $('#view_Items').selectpicker('refresh');

            $('#view_customer').find('#view_User_Email').val(data.data.User_Email).attr('readonly', 'readonly');
            $('#view_customer').find('#view_User_Phone').val(data.data.User_Phone);
            $('#view_customer').find('#view_Company').val(data.data.Company);
            $('#view_customer').find('#view_Address1').val(data.data.Address1);
            $('#view_customer').find('#view_Address2').val(data.data.Address2);
            $('#view_customer').find('#view_City').val(data.data.City);
            $('#view_customer').find('#view_State').val(data.data.State);
            $('#view_customer').find('#view_Country').val(data.data.Country);
            $('#view_customer').find('#view_Zipcode').val(data.data.Zipcode);
            $('#view_customer').find('#view_User_Name').val(data.data.User_Name).attr('readonly', 'readonly');
            $('#view_customer').find('#view_Country').val(data.data.Country);
            // $('.button_container').html('<button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333"> <span class="ladda-label"> <i class="fa fa-save"></i> Save</span> </button><button type="button" onclick="cancel_edit()" class="btn btn-danger custom_btn m-r-5 m-b-5"><i class="fa fa-times fa-custom"></i>Cancel</button>');
        }
        else
        {
            notification(data.flash_title,data.flash_message,false);
        }
    });
}

function do_subscription(user_id)
{
    $('#subscription_modal').modal('show');
    $('#Package_Id').val('');
    $('#Package_Id').selectpicker('refresh');
    $('#Subs_User_Id').val(user_id);
}

function reset_password_cus(user_id){
	$('#reset_password_form').find('#Reset_User_Id').val(user_id);
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
                        $.post(ajax_url + 'supplier/activate_account',
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
                        $.post(ajax_url + 'supplier/delete_user',
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