  <?php $controller =  $this->router->class; ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<!-- <?php echo base_url('assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js'); ?> -->

<script src="<?php echo base_url('assets/global/vendor/jquery-validation/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/vendor/jquery-validation/js/additional-methods.min.js'); ?>" ></script>

<script src="<?php echo base_url('assets/global/js/Config.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/vendor/jquery-confirm/js/jquery-confirm.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/vendor/jquery-notific8/jquery.notific8.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/custom.js'); ?>" type="text/javascript"></script>



<?php if(file_exists('assets/custom/js/'.strtolower($controller).'.js')){ ?>

    <script src="<?php echo base_url('assets/custom/js/'.strtolower($controller).'.js'); ?>" type="text/javascript"></script>
    
<?php } ?>

<script type="text/javascript">
	$('.datepicker').datepicker({ format: 'yyyy/mm/dd' });
</script>

<script type="text/javascript" src="<?php echo base_url('assets/global/vendor/img-zoom/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/vendor/img-zoom/jquery.imgzoom.pack.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.zoom-pic').imgZoom();
  });
</script>

</body>
</html>