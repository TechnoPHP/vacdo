<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Do Vacation in India and Overseas');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
   
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->Script('jquery-3.3.1.min');
		echo $this->Html->Script(array('popper.min','bootstrap4.min'));		
	?>

	<?php
		echo $this->Html->css(array('bootstrap4.min','all.min','style'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body class="cnt-home">
	<div id="" >
		<?php echo $this->element('header');?>
		
		<div class="container">
			<?php echo $this->Flash->render('sellerauth');?>
			<?php echo $this->Flash->render(); ?>
		</div>
		<div class="">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->element('footer');?>
		</div>
	</div>
	
	<?php echo $this->Html->script(array()); ?>
	
	<?php echo $this->element('sql_dump'); ?>
	<script>if($('#confirm-success').hasClass('bg-success-custom')){setInterval("$('.bg-success-custom').hide('slow')","10000");}if($('#confirm-failure').hasClass('bg-danger-custom')){setInterval("$('.bg-danger-custom').hide('slow')","10000");}if($('#authMessage').hasClass('message')){setInterval("$('.message').hide('slow')","10000");}</script>
</body>
</html>
