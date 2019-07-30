<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$( document ).ready(function() {
	$( "form" ).submit(function( event ) {
		//GetResponse API	
		if($('#apicomplete').val() != 'Y') {	
			var email_val = $('input[name="email"]').val();
			var name_val = $('input[name="name"]').val()+' '+$('input[name="lastName"]').val();
				$.post( "/getresponse/index.php", { name: name_val, email: email_val })
					.done(function( data ) {
						$('<input>').attr({
							type: 'hidden',
							id: 'apicomplete',
							name: 'apicomplete',
							value: 'Y'
						}).appendTo('form');
					$( ".button" ).click();
				});
				return false;
		}
		//End GetResponse API
	});
});
</script>