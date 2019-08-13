$( document ).ready(function() {

 //    $( "#login_form" ).validate(

	// {

	// 	focusInvalid: false,

	// 	invalidHandler: function(form, validator)

	// 	{

 //        	if (!validator.numberOfInvalids())

 //            return;

 //        	var top_to_list = parseFloat($(validator.errorList[0].element).offset().top)-150;

 //       		$('html, body').animate({

 //            	scrollTop:top_to_list

 //        	}, 1000);

 //    	},

	// 	rules:

 //        {

 //        	User_Password:

 //        	{

 //        		required:true,

 //        		minlength: 6,

	// 		},

 //            User_Email:

 //            {

 //            	minlength: 6,

 //                required: true,

 //            }

 //        },

 //        messages:

 //        {

 //        	User_Email:

 //            {

 //            	minlength:"Username should be minimum 6 character long",

 //            	required:"Please enter your Username and try again",

 //            },

 //            User_Password:

 //            {

 //            	required:"Please enter your password to proceed further",

 //            	minlength:"Password should be minimum 6 character long"

 //            }

 //        },

 //        submitHandler: function(form){

 //        	form.submit();	

 //        }

	// });


      var form = $("#forgot_form_div");
    form.validate({
        submitHandler: function() {
            $(".loader").removeClass("hide");
            var forms = $('#forgot_form_div')[0]; // You need to use standard javascript object here
            var formData = new FormData(forms);
            $.ajax({
                url: ajax_url + 'login/forgot',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                success: function(data) {
                    if (data.flash_status) {
                        $('#login_form').show();
                        $('#forgot_form').hide();
                        $('.alert-success').slideDown();
                        $('.alert #common_success').text(data.flash_message);
                        $('#forgot_form_div')[0].reset();
                    } else {
                        if(data.flash_type == 'validation'){
                            $.each(data.flash_message, function(i,val){
                                $('#'+i+'-error').text(val).show();
                            })
                        }
                    }
                }
            }).done(function() {
                $(".loader").addClass("hide");
                console.log("success");
            }).fail(function() {
                $(".loader").addClass("hide");
                console.log("error");
            }).always(function() {
                $(".loader").addClass("hide");
                console.log("complete");
            });
        }
    });

});

