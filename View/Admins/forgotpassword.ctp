<div class="container">
<div class="row">
	<div class="col-md-6">
		<h4>Let`s find your account with announceit</h4><hr>
		<p><small>Please provide us your registered email address with this site. If your email address matches with the registered email address, you will be getting a link to reset your password. You can even change your own password once you log in.</small></p>		
		<div class="clearfix"></div>
		<?php echo $this->Form->create('User', array("url"=>array("controller"=>"users","action"=>"forgotpassword","admin"=>false),'role'=>'form'));?>
		<div class="form-group">
			<label>Whats your Email Id registered with announceit *</label>
			<?php echo $this->Form->text('User.email_address', array('class' => 'form-control')); ?>
			<?php echo $this->Form->error('User.email_address');?>
		</div>
		<div class="row">
			<div class="col-md-6 form-group">
				<input name="" type="submit" value="Reset your password" class="btn btn-primary" />
			</div>
			<div class="">						
				<?php echo $this->Html->link("<b>Not a memeber? Join us</b>", array('controller'=>'users','action'=>'login','admin'=>false),array('class'=>'btn pull-right','escape'=>false)); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-5">
		<h4>Forgot password? No worries</h4><hr>
		<ul class="list-common">
			<li>Provide your Email Id with the system</li>
			<li>Check your email inbox</li>
			<li>Click on the link or paste the link into browser address bar</li>
			<li>Reset the password. Happy announcing from full of your soul</li>
			<li>Still an issue?&nbsp;mail to support@announceit.today</li>
		</ul>
		<!-- ul class="list-common">
			<li>Split your announcement into 2 parts: a title and a description.</li>
			<li>Keep your announcement title less than 150 characters and most appropriate.</li>
			<li>Keep your announcement description less than 350 characters and most abstract of your message.</li>
			<li>Always select best suitable picture to your announcement.</li>
			<li>Upload video to youtube or vimeo if possible and link it to your announcement.</li>
			<li>Get notified for your announcement by checking "Notify me by email when someone reply on this announcement" box.</li>
		</ul -->
	</div>
</div><!-row--><div class="gap30"></div><div class="gap30"></div><div class="gap10"></div><div class="gap30"></div><div class="gap30"></div><div class="gap10"></div><div class="gap30"></div><div class="gap30"></div>
</div><!-container-->