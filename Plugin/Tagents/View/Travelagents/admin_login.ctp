<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Welcome to Administration</h2>
		</div><!--/span-->
	</div><!--/row-->
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4">			
			<?php
				echo $this->Form->create('User', array("url"=>array("controller"=>"users","action"=>"login","admin"=>true), "class"=>"form-signin"));?>
				<h2 class="form-signin-heading">sign in now</h2>
				
				<div class="login-wrap">
					<?php echo $this->Session->flash();?>
					<div class="">
					<?php echo $this->Form->text('User.email_address',array("class"=>"form-control","placeholder"=>"User ID")); ?>
					<?php echo $this->Form->error('User.email_address');?>
					</div>

					<div class="">
					<?php echo $this->Form->password('User.password',array("class"=>"form-control","placeholder"=>"Password")); ?>
					<?php echo $this->Form->error('User.password');?>
					</div>
				
					<div class="">
					<button type="submit" value="LogIn" class="btn btn-lg btn-login btn-block">Log In</button>
					</div>							
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div><!--end of row-->
</div>	<!--end of container-->