
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" dir="ltr"> <!--<![endif]-->
<head>

    <!-- Matomo -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//staging.keendevelopers.com/arimaccabi/matomo/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo isset($Page_Title)? $Page_Title:'Main Title'; ?></title>
    <meta name="description" content="" />

    <!-- Meta data for responsive -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css' />

    <!-- Main css files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template_pages/css/lcp_template_1.css'); ?>" />
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

    	if(!empty($tracking_pixels['Tracking_Pixel'])){
    		echo html_entity_decode($tracking_pixels['Tracking_Pixel']);
    	}
    	?>
  	</script>
    </head>
<body class="color-blue" style="background-image: url(<?php echo isset($Background_Image)? base_url('assets/template_pages/images/').$Background_Image:'http://d12ser86h4rm4i.cloudfront.net/bg/B31.jpg'; ?>)">
<section id="home" style="display: block;">
 <?php echo isset($Main_Title)? stripslashes($Main_Title):'Main Title'; ?> 
        <button type="button" data-move="contact"><?php echo isset($Button_Title)? $Button_Title:'Button Title'; ?></button>
</section>
<section id="contact">
    <?php echo isset($Form_Text)? stripslashes($Form_Text):'Form Text'; ?>
        <!-- Get Reponse 1 -->
    <form accept-charset="utf-8" action="<?php echo base_url('lcp/savepage/'.$username.'/'.$page_link.'/'.$tracking_code); ?>" method="post" id="subscribe">
        <input type="text" name="email" id="email" placeholder="Your Email" />
        <button type="submit"><?php echo isset($Form_Button)? $Form_Button:'Form Button'; ?></button>
        <span><?php echo isset($Button_Bottom_Text)? $Button_Bottom_Text:'Button Bottom Text'; ?></span>
    </form>
   <!-- /Get Reponse 1 -->
    </section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/template_pages/js/lcp_template_1.js'); ?>"></script>
<script type="text/javascript">
    var isMobile = window.matchMedia("only screen and (max-width: 760px)");
    var $email = $("input#email");

    //----------------
    // Remove Sapces.
    //----------------
    str = $email.val();
    str = str.replace(/\s+/g, '');

    //------------------
    // Replace , in .
    //-----------------
    str = str.replace(",",".");

    $email.val( str );

    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }

    if ( isMobile.matches )
        $email.attr("data-placement","top").attr("title","").tooltip({ "title": "Your email address is in the incorrect format!", "container": "body", trigger: 'manual', html: true });
    else
        $email.attr("data-placement","right").attr("title","").tooltip({ "title": "Your email address is in the incorrect format!", "container": "body", trigger: 'manual', html: true });

    $("#subscribe").submit( function() {
        if( ! validateEmail( $email.val() ) )
        {
            $email.tooltip("show");
            return false;
        }
        else
            return true;
    });
</script>
</body>
</html>
