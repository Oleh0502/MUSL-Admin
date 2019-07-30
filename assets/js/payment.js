$(document).ready(function() {
    $('#Country').selectpicker();
    $('.profile_upload').click(function() {
        $('#profile_pic').trigger('click');
    });

    userDataTable = $('#all_transactions_table').DataTable(
    {
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "autoWidth ": false,
        "serverSide": true,
        "order": [],
        "ajax":
        {
            url: ajax_url + "payment/all_transactions_ajax",
            type: "POST",
            dataType: 'json',
            data: function(d) {
                d.user_id = user_id
            },
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

    //package form validate start here
    var validator = $("#payment_page").validate({
	    ignore: ":hidden:not(.profile_pic_cls)",
	      	rules:
	      	{
	          	package:
	          	{
	            	required: true,
	          	},
	          	card_type:
	          	{
	            	required: true,
	          	},
	         	ccn:
	          	{
	            	required: true,
	          	},
	          	month:
	          	{
	            	required: true,
	          	},
	          	year:
	          	{
	            	required: true,
	          	},
	          	cvv:
	          	{
	            	required: true,
	          	}
	         
	      	},
	      	messages:
	      	{
	          	package:
	          	{
	            	required: "Please select a package first.",
	          	},
	          	card_type:
	          	{
	            	required: "Please select a Card Type.",
	          	},
	         	ccn:
	          	{
	            	required: "Please select a Card Number.",
	          	},
	          	month:
	          	{
	            	required: "Please select a Month.",
	          	},
	          	year:
	          	{
	            	required: "Please select a Year.",
	          	},
	          	cvv:
	          	{
	            	required: "Please select a CCV.",
	          	}
	        
	      },
	    focusInvalid: true,
	    submitHandler: function(form) {
	    	var selected  = document.querySelector('input[name="package"]:checked').value;
	    	if(selected=='all'){
	    		$.confirm(
			    {
			        title: 'Confirm!',
			        content: 'Do you want buy Mega Pack ? </br<<b>Note: Your Previous Subscription will be auto cancelled.</b>' ,
			        buttons:
			        {
			            confirm:
			            {
			                keys: ['enter'],
			                "scrollX": true,
			                btnClass: 'btn-confirm',
			                action: function()
			                {
			                    form.submit();
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
	    	else {
	    		form.submit();
	    	}
	    }
	});
});

function perm_delete(user_id)
{
    $.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to cancel your current Plan ? Note: Your benefits will be lost after cancel the Subscription.',
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
                    	window.location.href= ajax_url+"/payment/cancel_plan/"+user_id
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

function admin_perm_delete(user_id)
{
    $.confirm(
    {
        title: 'Confirm!',
        content: 'Do you want to cancel Subscription ?',
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
                        $.post(ajax_url + 'payment/delete_subs',
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
