var imageLoader = document.getElementById('profile_pic');
imageLoader.addEventListener('change', readURL, false);
$('.selectpicker').change(function() {
    $(this).valid();
})
$(document).ready(function() {
    $('#Country').selectpicker();
    $('.profile_upload').click(function() {
        $('#profile_pic').trigger('click');
    });
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.profile_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
});
$("#profile_pic").change(function() {
    if ($("#profile_pic").valid() == true) {
        readURL(this);
    }
});
var validator = $("#profile_info_form").validate({
    ignore: ":hidden:not(.profile_pic_cls)",
    /*  rules:
      {
          profile_pic:
          {
              extension: "jpg|jpeg|png|gif",
          },
         
      },
      messages:
      {
          profile_pic: "File must be PNG, JPG or GIF, max. 3MB",
          'Degree[]':
          {
              required: "This field is required.",
          },
        
      },*/
    focusInvalid: true,
    submitHandler: function() {
        var l = Ladda.create(document.querySelector('#profile_info_form .ladda-button'));
        l.start();
        var formData = new FormData($('#profile_info_form')[0]);
        $.ajax(ajax_url + 'profile/update_profile', {
            async: true,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.flash_type == 'validation') {
                    $.each(data.flash_message, function(i, val) {
                        $('#' + i + '-error').text(val).css("cssText", "color: red !important;").show();
                    })
                } else {
                    if (data.flash_status) {
                        notification(data.flash_title, data.flash_message, true);
                    } else {
                        notification(data.flash_title, data.flash_message, false);
                    }
                }
            },
            complete: function() {
                l.stop();
            }
        });
    }
});
$("#change_password_form").validate({
    ignore: ":hidden:not(.profile_pic_cls)",
    rules: {
        Password: "required",
        ConfirmPassword: {
            equalTo: "#Password"
        }
    },
    focusInvalid: true,
    submitHandler: function() {
        var l = Ladda.create(document.querySelector('#change_password_form .ladda-button'));
        l.start();
        var formData = new FormData($('#change_password_form')[0]);
        $.ajax(ajax_url + 'profile/change_password', {
            async: true,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.flash_type == 'validation') {
                    $.each(data.flash_message, function(i, val) {
                        $('#' + i + '-error').text(val).css("cssText", "color: red !important;").show();
                    })
                } else {
                    if (data.flash_status) {
                        notification(data.flash_title, data.flash_message, true);
                    } else {
                        notification(data.flash_title, data.flash_message, false);
                    }
                }
            },
            complete: function() {
                l.stop();
            }
        });
    }
});
$("#update_picture_form").validate({
    ignore: ":hidden:not(.profile_pic_cls)",
      rules:
      {
          profile_pic:
          {
              extension: "jpg|jpeg|png|gif",
          },
         
      },
      messages:
      {
          profile_pic: "File must be PNG, JPG or GIF, max. 3MB",
          'Degree[]':
          {
              required: "This field is required.",
          },
        
      },
    focusInvalid: true,
    submitHandler: function() {
        var l = Ladda.create(document.querySelector('#update_picture_form .ladda-button'));
        l.start();
        var formData = new FormData($('#update_picture_form')[0]);
        $.ajax(ajax_url + 'profile/update_profile_pic', {
            async: true,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.flash_type == 'validation') {
                    $.each(data.flash_message, function(i, val) {
                        $('#' + i + '-error').text(val).css("cssText", "color: red !important;").show();
                    })
                } else {
                    if (data.flash_status) {
                        notification(data.flash_title, data.flash_message, true);
                        $('.profile-userpic img').attr('src',data.flash_userdata);
                        $('#header_profile_pic').attr('src',data.flash_userdata);
                    } else {
                        notification(data.flash_title, data.flash_message, false);
                    }
                }
            },
            complete: function() {
                l.stop();
            }
        });
    }
});

/*
$('.selectpicker').selectpicker().change(function()
{
    $(this).valid()
});*/