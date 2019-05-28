<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->meta(array('name'=>'robots','content'=>'noindex, nofollow'),null,array('inline'=>false)); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $cakeDescription ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css("bootstrap.min");
		echo $this->Html->css("bootstrap-reset");
		echo $this->Html->css("all.min");
		echo $this->Html->css("owl.carousel");
		echo $this->Html->css("slidebars");
		echo $this->Html->css("style");
		echo $this->Html->script('jquery214.min');
		echo $this->Html->script('bootstrap.min');
	
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body>
<section id="container">
	<?php echo $this->element("admin/admin_header"); ?>

	<div class="">		
		
		<?php echo $this->fetch('content'); ?>
	</div><!--/.container-->

	<?php echo $this->element("admin/admin_footer"); ?>
</section>

	
 <!-- js placed at the end of the document so the pages load faster -->
<?php
    echo $this->Html->script('adminjs/jquery.dcjqaccordion.2.7');
	echo $this->Html->script('adminjs/jquery.scrollTo.min');
	echo $this->Html->script('adminjs/jquery.nicescroll');
    echo $this->Html->script('adminjs/jquery.sparkline');
	echo $this->Html->script('adminjs/jquery.easy-pie-chart');
	echo $this->Html->script('adminjs/owl.carousel');
	echo $this->Html->script('adminjs/jquery.customSelect.min');
	echo $this->Html->script('adminjs/respond.min');
   
	echo $this->Html->script('adminjs/slidebars.min');
   
	echo $this->Html->script('adminjs/common-scripts');
  
	echo $this->Html->script('adminjs/sparkline-chart');
?>
<script>
  //owl carousel
  $(document).ready(function() {
	  $("#owl-demo").owlCarousel({
		  navigation : true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem : true,
		  autoPlay:true

	  });
  });
  //custom select box
  $(function(){
	  $('select.styled').customSelect();
  });
</script>

<script>if($('#flashMessage').hasClass('message')){setInterval("$('.message').hide('slow')","10000");}if($('#authMessage').hasClass('message')){setInterval("$('.message').hide('slow')","10000");}</script>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>