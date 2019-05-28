<div class="container mt-5">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-8">
			<h3>Welcome Administrator</h3>
		</div><!--/span-->
	</div><!--/row-->
	
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="card" style="">
				<div class="card-body">
					<p><h5 class="card-title">Sign In</h5>	</p>
	<?php
				echo $this->Form->create('Admin', array("url"=>array("controller"=>"admins","action"=>"login","admin"=>true), "class"=>""));?>
				
				
				<div class="">
					<?php echo $this->Session->flash();?>
					<div class="form-group">
					<?php echo $this->Form->text('Admin.email_address',array("class"=>"form-control","placeholder"=>"User ID")); ?>
					<?php echo $this->Form->error('Admin.email_address');?>
					</div>

					<div class="form-group">
					<?php echo $this->Form->password('Admin.password',array("class"=>"form-control","placeholder"=>"Password")); ?>
					<?php echo $this->Form->error('Admin.password');?>
					</div>
				
					<div class="form-group">
					<button type="submit" value="LogIn" class="btn btn-primary">Log In</button>
					<?php echo $this->Html->link("Forgot Password", array("plugin"=>"","controller"=>"admins","action"=>"forgotpassword","admin"=>"true"),array("class"=>"card-link float-right mt-3")); ?>
					</div>							
				</div>
			<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div><!--end of row-->
</div>	<!--end of container-->