<aside class="col-md-4">
<?php if($this->Session->check('Auth.User')){
		echo $this->element('profile_sidebar');
	}
	?>
</aside>
<h1 class="col-md-8">Profile</h1>
<?php echo $this->Html->link("Edit",array("controller"=>"profiles","action"=>"edit",),array("class"=>"button_red_small")); ?>
<section class="col-md-8">
	<div class="col-right">
	</div>
</section>