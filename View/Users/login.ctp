<?php echo $this->Flash->render('confirm-success') ?>
<div class="container">
	<div class="bg-white my-3">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="card">
				<h4 class="card-header">Sign in</h4>
					<div class="card-body ">
						<div class="form-group">
							<a href="#" class="btn btn-sm btn-info"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
							<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
						</div>
						<?php
						echo $this->Form->create('User', array("url"=>array('controller'=>'users','action' => 'login')),array("class"=>"register-form outer-top-xs"));
						?>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Email Id<span class="">&nbsp;*</span></label>
								<?php echo $this->Form->text('User.email',array("type"=>"text","class"=>"form-control ie7-margin")); ?>
								<?php echo $this->Form->error('User.email'); ?>
							</div>
							<div class="col-md-6 form-group">
								<label>Password<span class="">&nbsp;*</span></label>
								<?php echo $this->Form->text('User.password',array("type"=>"password","class"=>"form-control ie7-margin")); ?>
								<?php echo $this->Form->error('User.password'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 form-group">
								<?php echo $this->Form->submit(__('Login'),array("class"=>"btn-upper btn btn-primary checkout-page-button")); ?>
							</div>
							<div class="col-md-10 text-right">
								<?php echo $this->Html->link("Forgot password?",array("plugin"=>false,"controller"=>"users","action"=>"forgotpassword")); ?>
								<div class="clearfix"></div>
								<?php echo $this->Html->link("New registration",array("plugin"=>false,"controller"=>"users","action"=>"register")); ?>
							</div>
						</div>
						<?php 		echo $this->Form->end();?>
					</div><!--card-body-->
				</div><!--col-md-6-->
			</div>
		</div>
	</div>
</div>