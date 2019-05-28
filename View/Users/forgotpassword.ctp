<div class="container">
	<div class="bg-white p-3">
		<div class="row">
			<div class="col-md-6">
				<div class="card mb-3">
				<div class="card-header">Let`s find your account with vacation site</div>
				<div class="card-body"><p><small>Please provide us your registered email address with this site. If your email address matches with the registered email address, you will be getting a link to reset your password. You can even change your own password once you log in.</small></p>

				<?php echo $this->Form->create('User', array("url"=>array("plugin"=>"","controller"=>"users","action"=>"forgotpassword","admin"=>false),'role'=>'form'));?>
				<div class="form-group">
					<label>Whats your Email Id registered with vacation site *</label>
					<?php echo $this->Form->text('User.email', array('class'=>'form-control')); ?>
					<?php echo $this->Form->error('User.email');?>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input name="" type="submit" value="Reset your password" class="btn btn-primary" />
					</div>
					<div class="">						
						<?php echo $this->Html->link("<b>Not a memeber? Join us</b>", array('plugin'=>'','controller'=>'users','action'=>'register','admin'=>false),array('class'=>'btn pull-right','escape'=>false)); ?>
					</div>
				</div>
				</div><!-- card-body-->
				<?php echo $this->Form->end(); ?>
				</div><!-- card -->
			</div>
			
			<div class="col-md-6">
				<div class="card mb-3">
				<div class="card-header">	Forgot password?&nbsp;&nbsp;No worries</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Provide your Email Id with the system</li>
					<li class="list-group-item bg-light">Check your email inbox</li>
					<li class="list-group-item">Click on the link or paste the link into browser address bar</li>
					<li class="list-group-item bg-light">Reset the password. Enjoy vacation from full of your soul</li>
					<li class="list-group-item">Still an issue?&nbsp;mail to support@vacdo.in</li>
				</ul>
				</div>
			</div>
		</div><!--row-->
	</div><!--bg-white-->
</div><!--container-->
	