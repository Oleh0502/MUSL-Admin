<!DOCTYPE html>

<html>

<head>

<title></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<style type="text/css">

    /* FONTS */

    @import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');



    /* CLIENT-SPECIFIC STYLES */

    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }

    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }

    img { -ms-interpolation-mode: bicubic; }



    /* RESET STYLES */

    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

    table { border-collapse: collapse !important; }

    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }



    /* iOS BLUE LINKS */

    a[x-apple-data-detectors] {

        color: inherit !important;

        text-decoration: none !important;

        font-size: inherit !important;

        font-family: inherit !important;

        font-weight: inherit !important;

        line-height: inherit !important;

    }



    /* MOBILE STYLES */

    @media screen and (max-width:600px){

        h1 {

            font-size: 32px !important;

            line-height: 32px !important;

        }

    }



    /* ANDROID CENTER FIX */

    div[style*="margin: 16px 0;"] { margin: 0 !important; }

</style>

</head>

<body style="background-color: #f3f5f7; margin: 0 !important; padding: 0 !important;">

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<?php $this->load->view('emails/header'); ?>

    	<tr>

        	<td align="center" style="padding: 0px 10px 0px 10px;">
				<table style="max-width: 600px; text-align: left">
					<tr>
						<td>
			            	<?php echo html_entity_decode($content); ?>
							
						</td>
					</tr>
				</table>

        	</td>

    	</tr>

    	<!-- COPY BLOCK -->

    	<tr>

        	<td align="center" style="padding: 10px 10px 50px 10px;">

           		<?php $this->load->view('emails/footer'); ?>

        	</td>

    	</tr>

	</table>

</body>

</html>

