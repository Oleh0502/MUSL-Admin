 window.onload = function() {
 	var event_colors = ['m-fc-event--light m-fc-event--solid-warning','m-fc-event--accent','m-fc-event--light  m-fc-event--solid-danger','m-fc-event--danger m-fc-event--solid-focus','m-fc-event--primary','m-fc-event--light m-fc-event--solid-primary','m-fc-event--danger'];
    var calendar = $('#calendar1').fullCalendar({
         //editable: true,
         header: {
             left: 'prev,next today',
             center: 'title',
             right: 'month,agendaWeek,agendaDay'
         },
         events: ajax_url + "webinars/get_events",
         //selectable: true,
         //selectHelper: true,
         //droppable: true,
         eventMouseover: function(data, event, view) {
             tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#d3bb6a;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + '<b>Title</b>: ' + ': ' + data.title + '</br>' + '<b>Description</b>: ' + ': ' + data.description + '</div>';
             $("body").append(tooltip);
             $(this).mouseover(function(e) {
                 $(this).css('z-index', 10000);
                 $('.tooltiptopicevent').fadeIn('500');
                 $('.tooltiptopicevent').fadeTo('10', 1.9);
             }).mousemove(function(e) {
                 $('.tooltiptopicevent').css('top', e.pageY + 10);
                 $('.tooltiptopicevent').css('left', e.pageX + 20);
             });
         },
         eventMouseout: function(data, event, view) {
             $(this).css('z-index', 8);
             $('.tooltiptopicevent').remove();
         },
    });
 }


 function change_task_status(id,status){

      msg = 'Are you sure to mark this task as '+status;
    $.confirm({
        title: 'Confirm!',
        content: msg,
        buttons: {
            confirm: {
                keys: ['enter'],
                "scrollX": true,
                btnClass: 'btn-confirm',
                action: function() {
                    if (id != '' && status != '') {
                        $.post(ajax_url + 'dashboard/change_task_status', {
                            'id': id,
                            'status': status
                        }, function(data, textStatus, xhr) {
                            notification(data.flash_title, data.flash_message, data.flash_status);
                            if (data.flash_status) {
                                if(status == 'Completed'){
                                    $('#status_button_'+id+'').removeClass('label-danger');
                                    $('#status_button_'+id+'').removeClass('label-success');
                                    $('#status_button_'+id+'').removeClass('label-warning');
                                    $('#status_button_'+id+'').addClass('label-success');
                                }else{
                                    $('#status_button_'+id+'').removeClass('label-danger');
                                    $('#status_button_'+id+'').removeClass('label-success');
                                    $('#status_button_'+id+'').removeClass('label-warning');
                                    $('#status_button_'+id+'').addClass('label-danger');
                                }
                                $('#status_button_'+id+'').text(status);
                                //userDataTable.ajax.reload(null, false);
                            }
                        });
                    } else {
                        notification('Error!', 'Invalid argument', false);
                    }
                },
            },
            cancel: {
                keys: ['esc'],
                btnClass: 'btn-cancel',
            }
        }
    });

 }