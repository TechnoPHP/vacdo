<div class="container">
	<div class="bg-white my-2">
		<div class="row">
			<div class="col-md-6 col-sm-6 ">
				<div class="card">
				<h4 class="card-header">Sign up</h4>
					<div class="card-body">
					<?php echo $this->Form->create('User', array("url"=>array('controller'=>'users','action' => 'register')),array("class"=>"register-form outer-top-xs")); ?>
					<div class="row">			
						<div class="col-md-6 form-group">
						<label>First Name</label>
							<?php echo $this->Form->text('User.firstname',array("class"=>"form-control","placeholder"=>"First name"));?><?php echo $this->Form->error('User.firstname');?>
						</div>
						<div class="col-md-6 form-group">
						<label>Last Name</label>
							<?php echo $this->Form->text('User.lastname',array("class"=>"form-control","placeholder"=>"Last name"));?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
						<label>Email Address</label>
							<?php echo $this->Form->text('User.email',array("class"=>"form-control","placeholder"=>"Email address"));?><?php echo $this->Form->error('User.email');?>
						</div>
						<div class="col-md-6 form-group">
						<label>Contact number</label>
							<?php echo $this->Form->text('User.phone',array("class"=>"form-control","placeholder"=>"Contact number"));?><?php echo $this->Form->error('User.phone');?>
						</div>
						
					</div>
					<div class="row">			
						<div class="col-md-6 form-group">
						<label>Password</label>
							<?php echo $this->Form->password('User.password',array("class"=>"form-control","placeholder"=>"password"));?><?php echo $this->Form->error('User.password');?>
						</div>
						<div class="col-md-6 form-group">
						<label>Retype Password</label>
							<?php echo $this->Form->password('User.confirmpassword',array("class"=>"form-control","placeholder"=>"password"));?><?php echo $this->Form->error('User.confirmpassword');?>
						</div>
					</div>
					<?php echo $this->Form->submit(__('Sign up'),array("class"=>"btn-upper btn btn-primary checkout-page-button")); ?>
					<?php echo $this->Form->end(); ?>
					</div><!--card-body-->
				
				</div><!--card-->
			</div><!--col-md-6 -->
		</div><!--row -->
	</div><!--bg-white-->
</div>