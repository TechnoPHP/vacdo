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
	<title>
		<?php echo $cakeDescription ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css(array());

		
		echo $this->Html->css(array("bootstrap4.min","all.min","admin/style","admin/themify-icons","admin/admin-style","admin/flag-icon.min","admin/component","admin/amchart"));
		echo $this->Html->script(array('jquery-3.3.1.min','bootstrap4.min'));
	
		echo $scripts_for_layout;
	?>

</head>
<body class="menu-static">
	<!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->
	<?php echo $this->element("admin/admin_header"); ?>


	<?php echo $content_for_layout; ?>


	<?php //echo $this->element("admin/admin_footer"); ?>


	
 <!-- js placed at the end of the document so the pages load faster -->
<?php
    echo $this->Html->script(array('admin/jquery-ui.min','admin/tether.min','admin/jquery.slimscroll','admin/modernizr','admin/css-scrollbars','admin/classie','admin/d3.min','admin/raphael.min','admin/morris','admin/main','admin/amcharts','admin/serial','admin/light','admin/custom-amchart','admin/script'));

?>
<script>
</script>
		
<?php echo $this->element('sql_dump'); ?>
</body>
</html>