var userDataTable = "";
$(document).ready(function() {
    $('.bs-select').selectpicker();
    $('.bs-select').selectpicker();
    tinymce.init({
        selector: '#Video_Description',
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
  
    $("#add_user").validate({
        ignore: [],
        rules: {
            Video_Description: {
                required: true,
            },
        },
        messages: {
            Video_Description: {
                required: "Please enter video discription",
            },
        },
        submitHandler: function() {
            var l = Ladda.create(document.querySelector('#add_user .ladda-button'));
            l.start();
            var formData = new FormData($('#add_user')[0]);
            $.ajax(ajax_url + 'getting_started/add_video', {
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                async: true,
                success: function(data) {
                    notification(data.flash_title, data.flash_message, data.flash_status);
                    
                },
                complete: function() {
                    l.stop();
                }
            });
        }
    });
});

