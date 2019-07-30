
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<?php
        $ControllerName = $this->router->class;
        $FunctionName   = $this->router->method;
        $usertype = @$usertype;
    ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title>MUSL | <?php echo ucfirst($ControllerName); ?></title>
    
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/apple-touch-icon.png'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('assets/global/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/css/bootstrap-extend.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/site.min.css'); ?>">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/animsition/animsition.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/asscrollable/asScrollable.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/switchery/switchery.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/intro-js/introjs.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/slidepanel/slidePanel.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/flag-icon-css/flag-icon.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/chartist/chartist.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/aspieprogress/asPieProgress.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/examples/css/dashboard/ecommerce.css'); ?>">
    
    <link href="<?php echo base_url('assets/global/vendor/datatables/datatables.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/global/vendor/datatables/datatables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/global/vendor/jquery-confirm/css/jquery-confirm.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/global/vendor/jquery-notific8/jquery.notific8.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Fonts -->
        <link rel="stylesheet" href="<?php echo base_url('assets/global/fonts/font-awesome/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/fonts/web-icons/web-icons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/global/fonts/brand-icons/brand-icons.min.css'); ?>">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="<?php echo base_url('assets/global/vendor/breakpoints/breakpoints.js'); ?>"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition ecommerce_dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src="<?php echo ('assets/images/logo.png'); ?>" title="Remark">
         <!--  <span class="navbar-brand-text hidden-xs-down"> Remark</span> -->
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon wb-search" aria-hidden="true"></i>
        </button>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
            <li class="nav-item hidden-float">
              <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>
            
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
           
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img alt="" class="img-circle" id="header_profile_pic" src="<?php echo base_url('assets/images/profile_pics/'). ($_SESSION['User_Image'] == ''? 'dummy_user.png':$_SESSION['User_Image']); ?>" style="max-height:40px;">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?php echo base_url('profile'); ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <!-- <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a> -->
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="<?php echo base_url('logout'); ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
           
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                  data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
    </nav> 
    <script type="text/javascript">
            var ajax_url = '<?php echo base_url(); ?>';
        </script>