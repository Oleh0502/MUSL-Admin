
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo isset($Page_Title)? $Page_Title:'Make Money the Easy Way!  Hands Off!'; ?></title>
	<title></title>
	<meta content="IE=10,IE=9,IE=8" http-equiv="X-UA-Compatible" />
	<link href="/site/include/bg_image.css" media="all" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Bevan|Open+Sans:400,400italic,600,600italic,700,700italic,800,800italic|Open+Sans+CondensedPT+Sans:400,400italic,700,700italic|PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css" />
	
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.min.css" id="bootstrap-css" media="all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/template_pages/css/lcp_temp_4_instabuilder2.css'); ?>" media="all" rel="stylesheet" type="text/css" /><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js'></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    	<?php 
    	if(!empty($userInfo['google_analytics'])){
    		?>
		        ga('create', '<?php echo @$google_analytics; ?>', 'auto');
		        ga('create', '<?php echo $userInfo['google_analytics']; ?>', 'auto', 'clientTracker');
		        ga('send', 'pageview');
		        ga('clientTracker.send', 'pageview');
    		<?php
    	} else{
    		?>
		    	ga('create', '<?php echo @$google_analytics; ?>', 'auto');
		        ga('send', 'pageview');
    		<?php
    	}
    	?>
  	</script>
	<script type='text/javascript'>
		function validEmail(v) {
    		var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    		return (v.match(r) == null) ? false : true;
		}
		var noSplash='false';
			var delayaction=0;
			var aggamount = 0;
			$(document).ready(function() {
				var original_tc = parseInt($('#spots_left').html());
				var viewportHeight = $(window).height();
				if (viewportHeight < 700) {
					$('.wrapper').css('marginTop','12px');
				}
				$('.myfield').focus(function() {
					this.value = '';
				});
								$('.button2').live('click', function() {
					var myem = $('#myf').val();
					if (!validEmail(myem)) {
						alert('Email Address is Required');
						return false;
					}
					$(this).css('display', 'none');
					$('tbody').css('height', '70px');
					$('.loading').css('display', 'block');
					noSplash = 'true';
					//alert($('#myf').val());
						var typeemail2 = $('#form_holder').find('form').find('input[type="email2"]');
						var nameemail2 = $('#form_holder').find('form').find('input[name="email2"]');
						var nameEmail2 = $('#form_holder').find('form').find('input[name="Email2"]');
						var daemail2 = $('#form_holder').find('form').find('input[name="da_email"]');
						if (typeemail2.length > 0) {
							typeemail.val(myemail);
						}
						if (nameemail2.length > 0) {
							nameemail.val(myemail);
						}
						if (nameEmail2.length > 0) {
							nameEmail.val(myemail);
						}
						if (daemail2.length > 0) {
							daemail2.val(myemail);
						}
												$('#form_holder').find('form').find('input[type=submit]').trigger('click');
																			});
				$('.myfield').keypress(function(e) {
					if(e.which == 13) {
						e.preventDefault();
						$('.button2').trigger('click');
					}
				});
			setTimeout(function() {
        		$('.kic').each(function() {
            		var animClass = jQuery(this).attr('rel');
            		jQuery(this).addClass(animClass);
            		var wait = window.setTimeout( function(){jQuery('.kic').removeClass(animClass)},1300);
            });
          }, 1000);
			var tc = parseInt($('#spots_left').html());
		   if(tc > 0) {
			var tc = parseInt($('#spots_left').html());
			scarcify('spots_left', 1, 3, 5);
			for(var i=0; i<(tc - 1); i++) {
				scarcify('spots_left', 1, 2, 20);
			}
		}
			function scarcify(id, amt, randNumMin, randNumMax) {
				var randInt = (Math.floor(Math.random() * (randNumMax - randNumMin + 1)) + randNumMin);
				aggamount = aggamount + amt;
				delayaction = delayaction + (randInt * 1000);
				myval = parseInt($('#'+id).html()) - aggamount;

				var myparams= Array();
				  myparams[0] = myval;
				  myparams[1] = delayaction;
				setTimeout(function(myparams) {
					if (myparams[0] > 0) {
						if(myparams [0] <= 5) {
							$('#'+id).parent().addClass('redtext');
						}
						$('#'+id).html(myparams[0]);
						setCookie('ccount', myparams[0], 5);
					} else {
						$('#myform').hide();
					
					<?php if(isset($Offer_Expired_Text)){ ?> 

						$('.headline').html('<?php echo stripslashes($Offer_Expired_Text); ?>');

					<?php }else{ ?>
						$('.headline').html("<span class='redtext' style='color:#ff0000'>Sorry!</span><br>This offer has expired in your area.<br>Hit Refresh to Attempt to Open Additional Slots");
					<?php } ?>

						setCookie('ccount', original_tc-randInt,5);
					}
				},delayaction, myparams);
			}
			});
		function setCookie(c_name,value,exdays)
		{
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
			document.cookie=c_name + "=" + c_value;
		}
		function ucFirstAllWords( str )
		{
    		var pieces = str.split(" ");
    		//for ( var i = 0; i < pieces.length; i++ )
    		for ( var i = 0; i < 1; i++ )
    		{
        		var j = pieces[i].charAt(0).toUpperCase();
        		pieces[i] = j + pieces[i].substr(1).toLowerCase();
    		}
    		return pieces[0];
		}
		</script>
		<?php 
  	if(!empty($tracking_pixels['Tracking_Pixel'])){
    		echo html_entity_decode($tracking_pixels['Tracking_Pixel']);
    	}
  	?>
<style type="text/css">.footer {
	width:470px;
	margin:40px auto;
	color:#ffffff;
	font-family:'Lato';
	font-size:11px;
	text-align:center;
}
.shadow {
	        -webkit-box-shadow: 0px 0px 11px rgba(240, 240 ,240, 0.65);
-moz-box-shadow:    0px 0px 11px rgba(240, 240 ,240, 0.75);
box-shadow:         0px 0px 11px rgba(240, 240 ,240, 0.75);
}
.headline {
	margin: 16px auto;
	margin-bottom:10px !important;
	font-family: 'Lato';
	font-weight: bold;
	font-size:34px;
	max-width: 640px;
	text-align:center;
	/*color:#222;
	color:#fff;*/
	text-shadow: 1px 1px 1px #000;
	line-height:44px;
	letter-spacing:-1px;
}
.wob > .headline {
	color:#fff;
}
.headline2 {
	margin:8px auto;
	width:640px;
	font-family: 'Lato';
	font-size:24px;
	font-weight:bold;
	text-align:center;
	color:#222;
	text-shadow: 1px 1px 0px #999;
	line-height:30px;
	letter-spacing:-1px;
}
	.bow {
	background: #ffffff;
	background: -moz-linear-gradient(top, rgba(250,250,250,1) 0%, rgba(250,250,250,0.70) 30%, rgba(250,250,250,0.85) 60%, rgba(250,250,250,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(250,250,250,1)), color-stop(30%,rgba(250,250,250,0.85)), color-stop(60%,rgba(250,250,250,0.85)), color-stop(100%,rgba(250,250,250,1)));
	background: -webkit-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(250,250,250,0.85) 30%,rgba(250,250,250,0.85) 60%,rgba(250,250,250,1) 100%);
	background: -o-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(250,250,250,0.85) 30%,rgba(250,250,250,0.85) 60%,rgba(250,250,250,1) 100%);
	background: -ms-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(250,250,250,0.85) 30%,rgba(250,250,250,0.85) 60%,rgba(250,250,250,1) 100%);
	background: linear-gradient(to bottom, rgba(250,250,250,0.90) 0%,rgba(250,250,250,0.70) 30%,rgba(250,250,250,0.70) 60%,rgba(250,250,250,0.90) 100%);
		background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1.0) 30%, rgba(255,255,255,1.0) 60%, rgba(255,255,255,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(30%,rgba(255,255,255,1.0)), color-stop(60%,rgba(255,255,255,1.0)), color-stop(100%,rgba(255,255,255,1)));
	background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,1.0) 30%,rgba(255,255,255,1.0) 60%,rgba(255,255,255,1) 100%);
	background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,1.0) 30%,rgba(255,255,255,1.0) 60%,rgba(255,255,255,1) 100%);
	background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,1.0) 30%,rgba(255,255,255,1.0) 60%,rgba(255,255,255,1) 100%);
	background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,1.0) 30%,rgba(255,255,255,1.0) 60%,rgba(255,255,255,1) 100%);
}
	.headline {
		font-family: 'Lato', sans-serif !important;
	}
	#tubular-container {
		top:0px !important;
		left:0px !important;
	}
	.wrapper {
		margin-bottom:20px !important;
		margin-top:40px;
	}
	.outerwrapper { margin:0px auto;max-width:670px; }
	
@-webkit-keyframes tada {
    0% {-webkit-transform: scale(1);}    
    10%, 20% {-webkit-transform: scale(0.9) rotate(-3deg);}
    30%, 50%, 70%, 90% {-webkit-transform: scale(1.5) rotate(3deg);}
    40%, 60%, 80% {-webkit-transform: scale(1.5) rotate(-3deg);}
    100% {-webkit-transform: scale(1) rotate(0);}
}

@-moz-keyframes tada {
    0% {-moz-transform: scale(1);}    
    10%, 20% {-moz-transform: scale(0.9) rotate(-3deg);}
    30%, 50%, 70%, 90% {-moz-transform: scale(1.5) rotate(3deg);}
    40%, 60%, 80% {-moz-transform: scale(1.5) rotate(-3deg);}
    100% {-moz-transform: scale(1) rotate(0);}
}

@-o-keyframes tada {
    0% {-o-transform: scale(1);}    
    10%, 20% {-o-transform: scale(0.9) rotate(-3deg);}
    30%, 50%, 70%, 90% {-o-transform: scale(1.5) rotate(3deg);}
    40%, 60%, 80% {-o-transform: scale(1.5) rotate(-3deg);}
    100% {-o-transform: scale(1) rotate(0);}
}

@keyframes tada {
    0% {transform: scale(1);}    
    10%, 20% {transform: scale(0.9) rotate(-3deg);}
    30%, 50%, 70%, 90% {transform: scale(1.5) rotate(3deg);}
    40%, 60%, 80% {transform: scale(1.5) rotate(-3deg);}
    100% {transform: scale(1) rotate(0);}
}

.tada {
    -webkit-animation-name: tada;
    -moz-animation-name: tada;
    -o-animation-name: tada;
    animation-name: tada;
}	
.smaller {
	font-size:34px;
}
.redtext {
	color:#DD0000 !important;
}
.yellowtext {
	color:#FFE00F !important;
}
.overlay {
	background-color:#fff;
	height:100%;
	width:100%;
	position:absolute;
	top:0px;
	left:0px;
	z-index:30;
}
.highlight {
	background-color:#ffe00f;
	padding:4px 8px;
}
.honest {
	width:449px;
	height:101px;
	margin:0px auto;
	margin-top:18px !important;
}
.loading {
	background:url('images/loading.gif');
	height:32px;
	width:32px;	
	display:none;
	margin-top:2px;
	position:relative;
	left:-80px;
}
div.kic {
-moz-animation-delay: 0.2s;
    -moz-animation-duration: 1s;
    -moz-animation-fill-mode: both;
    -moz-animation-timing-function: ease;
    -moz-backface-visibility: hidden;
    -webkit-animation-fill-mode: both;
    -moz-animation-fill-mode: both;
    -ms-animation-fill-mode: both;
    -o-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-duration: 1s;
    -moz-animation-duration: 1s;
    -ms-animation-duration: 1s;
    -o-animation-duration: 1s;
    animation-duration: 1s;
    display: inline-block;
}

.wrapper {
	max-width:670px;
	min-height:270px;
	padding: 0px 15px;
	margin:0px auto;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	padding-bottom:16px !important;
	padding-top:10px !important;
-webkit-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.7);
-moz-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.7);
box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.7);}
.animated {
    -webkit-animation-fill-mode: both;
    -moz-animation-fill-mode: both;
    -ms-animation-fill-mode: both;
    -o-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-duration: 1s;
    -moz-animation-duration: 1s;
    -ms-animation-duration: 1s;
    -o-animation-duration: 1s;
    animation-duration: 1s;
}
.wde {
	width:350;height:90px;
}
@media screen and ( max-width: 450px ) { 
	.wde { width:250;height:64px;
	}
}

.button2 {
	cursor:pointer;
}
.input2 {border: 0px #ffcd05 solid;padding: 0;  width: 100%;max-width : 350px; margin: 0; -webkit-appearance: none;  background-color: #FFF;  text-indent: 1em; left: 0;  font-size: 1em; color: #333333;  border-radius: 0.47777777em; height: 2em;  line-height: 2em; }
	
	.input3 {border: 2px #999999 solid;padding: 0;  width: 100%;max-width : 350px; margin: 0; -webkit-appearance: none;  background-color: #FFF;  text-indent: 1em; left: 0;  font-size: 1em; color: #333333;  border-radius: 0.47777777em; height: 2em;  line-height: 2em; }
	div#bg_image img {
	    position: absolute;
	    right: 0;
	    left: 0;
	    width: 100%;
	    bottom: 0;
	    top: 0;
	    margin: auto;
	    min-width: 50%;
	    min-height: 50%;
	    z-index:-1;
	}
	div#ib2_el_9CLvGB9v-popup-box h1 {
	    text-align: center;
	    font-weight: 800;
	    color: red;
	}
	div#ib2_el_9CLvGB9v-popup-box h2 {
    text-align: center;
    font-weight: 700;
    font-size: 34px;
}
	</style>

	
<style type="text/css" id="ib2-main-css">   body { font-family: "Open Sans", sans-serif; font-size: 14px; color:#333; overflow: hidden;} body a { color: #428bca; } body a:hover, body a:focus { color: #2a6496; }  body { min-height: auto; height: auto; }  </style>  <style type="text/css" media="print">#wpadminbar { display:none; }</style>&nbsp;<style type="text/css" media="screen"> 	html { margin-top: 32px !important; } 	* html body { margin-top: 32px !important; } 	@media screen and ( max-width: 782px ) { 		html { margin-top: 46px !important; } 		* html body { margin-top: 46px !important; } 	} </style> 


<script type="text/javascript">  var ib2_popup = 1,  ib2_poptime = 'unfocus',   ib2_popid = 'ib2_el_9CLvGB9v',  ib2_slider = 0,  ib2_slider_close = 0,  ib2_attbar = 0,  post_id = 1945,  webinar_url = '',  powered_by = 'no',  powered_by_link = '',  powered_img = '';    jQuery(document).ready(function($){  	if ( ib2_attbar == 0 ) {  		jQuery('.ib2-notification-bar').remove();  	}  });  </script>

<style type="text/css" media="screen">  	html { margin-top: 0px !important; }  	* html body { margin-top: 0px !important; }  	</style>  <style type="text/css">.ib2-section-content p { line-height: 1.4 !important; margin-bottom: 18px !important; }</style>&nbsp;<style type="text/css">  @media only screen and (max-width: 767px) {  	body {  		background-size: auto auto !important;  	}	  }  </style>   

	
	<link href="/imagesrte/d171879/LL2/money2.png" rel="icon" type="image/png" />
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" type="text/javascript"></script>  <![endif]-->

	
</head>
<body style="background-color: #cccccc">
<div id="bg_image"><img src="<?php echo isset($Background_Image)? base_url('assets/template_pages/images/').$Background_Image:base_url('assets/template_pages/images/calculator.jpg'); ?>" /></div>

<div style="margin-top:40px;">&nbsp;</div>

<div align="center" class="within_bg_image">
<div id="outerwrapper">
<div class="wrapper wob shadow" style="border:3px;border-color:#B900B9;border-style:solid;background:rgba(0,0,0, .80)">
<div class="headline">

<?php if(isset($Main_Page_Text)){ echo stripslashes($Main_Page_Text); }else{ ?>

<p style="text-align: center; line-height: 40px;"><span style="font-family: &quot;PT Sans Narrow&quot;,sans-serif; font-size: 40px;"><span style="color: #fff;font-weight:normal;">
 New System Will Pay Your Bills and Cover Your Kid&rsquo;s College Fund and More!<br />
<span style="color:#FFC926;font-weight:bold;">Free Video Explains Everything!</span><br/>Enter Your Email Below!
</span></span></p>

<?php  } ?>

<div style="margin-top:0px;margin-bottom:20px;"><span style="color: #33ff00;font-size:36px;font-weight:bold;">Only <span id="spots_left">23</span> spots left...</span></div>



<div style="font-size:20px;">
<form action="<?php echo base_url('lcp/savepage/'.$username.'/'.$page_link.'/'.$tracking_code); ?>" method="post" name="formK" onsubmit="return ValidateEmail();"><script type="text/javascript" src="<?php echo base_url('assets/template_pages/js/lcp_temp_3_EmailCheck.js'); ?>"></script><script type="text/javascript" src="<?php echo base_url('assets/template_pages/js/lcp_temp_3_RealVerify.js'); ?>"></script>
<input type="hidden" name="DL" value="296036">
<INPUT type="hidden" name="V_ID" value="918554643">

<input type=hidden name=CapturePageThankYou value=239297>
<center><table><TR><TD height=18 valign=middle align=CENTER><A class=ThankYouForReturningLink href=/site/index.asp?DL=296036&page=239297 STYLE='text-decoration:none;'>
<!-- 	<FONT size=-2>Thank you for returning</A><BR><A href=/site/index.asp?DL=296036&page=239297 STYLE='text-decoration:none;'><img src=/site/images/skip_survey.gif border=0></FONT> --></A></TD></TR></table></center><input name="MandatoryFieldsPrimary" type="hidden" value="First,Email" /><input class="text" name="name" type="hidden" value="Subscriber" />
<div style="text-align:center;">
<p><input class="input3" name="email" placeholder="Email" type="text" value="" /></p>

<div class="kic" rel="tada"><input class="wde" name="submit" src="<?php echo base_url('assets/template_pages/images/let-me-in-m.png'); ?>" type="image" /></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<div id="ib2_el_9CLvGB9v-popup" class="container ib2-section-el ib2-popup" style="width: 700px; max-width: 100%; position: absolute; top: 396.5px; left: 359px; display: none; height: auto;"><div class="el-content el-cols" style="background-color: rgba(255, 255, 255, 1); padding: 15px 25px; border-radius: 10px; border-width: 3px; border-style: solid;border-color: #ff0000; box-shadow: 0px 0px 8px 3px rgb(61, 61, 61);"><div id="ib2_el_9CLvGB9v-popup-box" class="ib2-pop-content" style="width: 100%; min-height: 180px;"><div style="padding: 0px; position: relative;" id="ib2_el_sIsod7g6" class="ib2-content-el ib2-text-el ib2-title-el"><h1 style="text-align: center;" data-mce-style="text-align: center;">
<?php if(isset($Popup_Text)){ echo stripslashes($Popup_Text); }else{ ?>
	<span data-mce-style="font-family: Bevan,cursive; color: #ff0000;" style="font-family: Bevan,cursive; color: rgb(255, 0, 0);">
		STOP<br data-mce-bogus="1"></span>
	</h1>
	<h2 style="text-align: center;"><span style="font-family: Bevan,cursive;">
		<span style="color: rgb(0, 0, 0);">Don't Leave or You will Leave Money on the Table.</span><br></span>
	</h2>

	<p>
	<span data-mce-style="font-family: PT Sans,sans-serif;" style="font-family: &quot;PT Sans&quot;,sans-serif;"><span style="color: rgb(0, 0, 0);">Please fill out the form for complete details and discover the real facts about earning money online.<br></span></span>
<?php  } ?>


<form action="<?php echo base_url('lcp/savepage/'.$username.'/'.$page_link.'/'.$tracking_code); ?>" method="post"><script type="text/javascript" src="<?php echo base_url('assets/template_pages/js/lcp_temp_3_RealVerify.js'); ?>"></script>
<input type="hidden" name="DL" value="296036">
<INPUT type="hidden" name="V_ID" value="638113113">

<input type=hidden name=CapturePageThankYou value=239297>
<center><table><TR><TD height=18 valign=middle align=CENTER><A class=ThankYouForReturningLink href=/site/index.asp?DL=296036&page=239297 STYLE='text-decoration:none;'><!-- <FONT size=-2>Thank you for returning</A><BR><A href=/site/index.asp?DL=296036&page=239297 STYLE='text-decoration:none;'><img src=/site/images/skip_survey.gif border=0></FONT> --></A></TD></TR></table></center><input name="MandatoryFieldsPrimary" type="hidden" value="First,Email" /><input class="text" name="name" type="hidden" value="Subscriber" />
<div style="text-align:center;"><div style="font-size:20px;">
<p><input class="input3 ib2-required ib2-validate-email" name="email" placeholder="Email Address" type="text" /></p></div>

<div class="kic" rel="tada"><input class="wde" name="submit" src="<?php echo base_url('assets/template_pages/images/let-me-in-m.png'); ?>" type="image" /></div>
</div>
</form>
</p>
</div></div></div>
  
<a class="ib2-close-pop" href="#"><img border="0" src="<?php echo base_url('assets/template_pages/images/pop-close.png'); ?>" /></a></div>

<div class="ib2-popup-bg" style="display: none;"></div>
<script type='text/javascript' src="<?php echo base_url('assets/template_pages/js/lcp_temp_4_instabuilder2.js'); ?>"></script></div>

<!-- 10.0.0.145'440425'296036'171879'296036' -->
</body>
</html>
