<?php 

$header_logo = base_url('assets/images/logo.png');

?>



<!DOCTYPE html>

<html>

	<head>

		<title><?php echo WEBSITE_NAME; ?></title>

		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	</head>

<style>

a:hover{

	color:#609216!important;

}

tr{

	border-right:1px solid #eee;

	border-left:1px solid #eee;

	display: block;

}

</style>

<body>

<div style="width:600px; max-width:100%; margin: auto;">

	<table style="width:100%">

		<tbody>

			<tr style="border:1px solid #eee; display:block; text-align:center;">

				<td style="background:#30302f; width:100%; display: block; padding:15px 0px;">

					<?php

					if($header_logo){

					?>

					<img src="<?php echo $header_logo;?>" alt="Logo">

					<?php	

					}

					?>

				</td>

			</tr>

			<tr>

				<td>

					<p style="margin-bottom: 0; font-family: 'Raleway', sans-serif; font-size:14px; color:#555; line-height: 24px; padding:0 30px">

						<?php echo $content; ?>

					</p>

					<div class="helping-no">

				</div>

				</td>

			</tr>

			<tr style="background:#2f302e; padding:15px;  text-align:center;">

				<td style="width:100%; display:block;">

					<p style="font-size: 13px;margin: 0;color:#ffffff; font-family: 'Raleway', sans-serif; padding:20px;"> Copyright 2018 <?php echo WEBSITE_NAME; ?>. All right reserved</p>

				</td>

			</tr>

		</tbody>

	</table>

</div>

</body>

</html>