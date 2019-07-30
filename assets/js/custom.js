
function notification(heading='',msg='',status = false){
	if(status){
		t = {
            theme: 'lime',
            heading : 'Success',
        }
	} else {
        t = {
            theme: 'ruby',
            heading : 'Error',
        }
	}
	$.notific8("zindex", 11500), $.notific8(msg,t);
}

