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
							Hi <?php echo (!empty($_POST['name']))?$_POST['name']:$_POST['email']; ?> <br/>
							Thank you for your interest in our 'ground breaking' business that is changing so many lives.<br/>
							Our You First Compensation Plan is one of the reasons for this, the second is the Exitus Sales System!
							Financial Freedom is now a reality for anyone who wants it!<br/>
							However, at Exitus we value your PRIVACY, so would ask you to take a moment to view our COMPLIANCE page HERE<br/>
							As soon as you have viewed our COMPLIANCE page, all you need to do it click the link below to CONFIRM your email address and your ACCEPTANCE of our PRIVACY Policy.<br/>
							<a href="<?php echo $confim_link; ?>">Click Here To Confirm Your Email Address And ACCEPT Our Privacy Policy</a><br/>
							As soon as you have clicked the link above you will be taken to my Marketing website where you can watch our exciting business presentation<br/>
							Here you will learn exactly how you can start making serious online income, working just a few hours a week!<br/>
							You will get access to all the information regarding our business including: The Products, How Our Business Works and How You Get Paid First and Fast!<br/><br/>
							Here is the link again:<br/>
							Click Here To Confirm Your Email Address And Accept Our Privacy Policy<br/>
							To your success!<br/>
							<?php echo $userInfo['User_First_Name'].' '.$userInfo['User_Last_Name']; ?>
							Phone: <?php echo ($userInfo['User_Phone'])?$userInfo['User_Phone']:'n/a'; ?>
							Skype: <?php echo ($userInfo['User_Skype'])?$userInfo['User_Skype']:'n/a'; ?>
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