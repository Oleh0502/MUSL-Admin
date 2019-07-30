  <?php $controller =  $this->router->class; ?>
    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="<?php echo base_url('assets/global/vendor/babel-external-helpers/babel-external-helpers.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/jquery/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/popper-js/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/bootstrap/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/animsition/animsition.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/mousewheel/jquery.mousewheel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/asscrollbar/jquery-asScrollbar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/asscrollable/jquery-asScrollable.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js'); ?>"></script>
    
    <!-- Plugins -->
    <script src="<?php echo base_url('assets/global/vendor/switchery/switchery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/intro-js/intro.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/screenfull/screenfull.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/slidepanel/jquery-slidePanel.js'); ?>"></script>
        <script src="<?php echo base_url('assets/global/vendor/chartist/chartist.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/global/vendor/aspieprogress/jquery-asPieProgress.js'); ?>"></script>
        <script src="<?php echo base_url('assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js'); ?>"></script>
    

    

    <!-- Scripts -->
    <script src="<?php echo base_url('assets/global/js/Component.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/Plugin.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Base.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Config.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/js/Section/Menubar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/Section/GridMenu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/Section/Sidebar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/Section/PageAside.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/Plugin/menu.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/global/js/config/colors.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/config/tour.js'); ?>"></script>
    <script>Config.set('assets', "<?php echo base_url('assets'); ?>");</script>
    
    <script src="<?php echo base_url('assets/global/vendor/jquery-validation/js/jquery.validate.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/vendor/jquery-validation/js/additional-methods.min.js'); ?>" ></script>

    <script src="<?php echo base_url('assets/global/vendor/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/vendor/datatables/datatables.bootstrap.js'); ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/global/vendor/datatables/table-datatables-responsive.min.js'); ?>" type="text/javascript"></script>

    <!-- Page -->
    <script src="<?php echo base_url('assets/js/Site.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Plugin/asscrollable.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Plugin/slidepanel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Plugin/switchery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/global/js/Plugin/aspieprogress.js'); ?>"></script>

    <script src="<?php echo base_url('assets/examples/js/dashboard/ecommerce.js'); ?>"></script>

    <script src="<?php echo base_url('assets/global/scripts/custom.js'); ?>" type="text/javascript"></script>
    <?php if(file_exists('assets/js/'.strtolower($controller).'.js')){ ?>

        <script src="<?php echo base_url('assets/js/'.strtolower($controller).'.js'); ?>" type="text/javascript"></script>
        
    <?php } ?>
  </body>
</html>