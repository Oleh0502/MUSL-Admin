
$(document).ready(function() {
    var form = $("#customer_signup_page");
    form.validate({
        /*ignore: [],*/
        rules: {
            User_Password: "required",
            confirmpassword: {
                equalTo: "#User_Password"
            }
        },
        submitHandler: function() {
            var l = Ladda.create(document.querySelector('#customer_signup_page .ladda-button'));
            l.start();
            var forms = $('#customer_signup_page')[0]; // You need to use standard javascript object here
            var formData = new FormData(forms);
            $.ajax({
                url: ajax_url + 'register',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                success: function(data) {

                    if (data.flash_status) {
                        notification(data.flash_title,data.flash_message,data.flash_status);
                        forms.reset();
                        setTimeout(function() {
                            window.location.href = ajax_url + "login";
                        }, 2000);
                    } else {
                        if (data.flash_type == 'account') {
                            notification(data.flash_title,data.flash_message,data.flash_status);
                        } else if (data.flash_type == 'validation') {
                            console.log(data.flash_message);
                            $.each(data.flash_message, function(i, val) {
                                $('#' + i + '-error').text(val).show();
                            })
                        }
                    }
                },
                 complete: function()
                {
                   l.stop();
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
})