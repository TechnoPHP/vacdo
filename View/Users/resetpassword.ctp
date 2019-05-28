<div class="container bg-white py-3">	
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h3>Reset your password</h3><hr>
			<?php echo $this->Form->create('User', array("url"=>array("plugin"=>"","controller"=>"users","action"=>"resetpassword")));?>
			<div class="form-group">
				<?php echo $this->Form->hidden('User.confirmkey', array('value'=>$confirm,'class'=> '')); ?>
			</div>
			<div class="form-group">
				<label >New Password *</label>
					<?php echo $this->Form->password('User.password', array('class' => 'form-control')); ?>
					<?php echo $this->Form->error('User.password');?>
			</div>
			<div class="form-group">
				<label >Retype New Password *</label>
					<?php echo $this->Form->password('User.confirmpassword', array('class' => 'form-control')); ?>
					<?php echo $this->Form->error('User.confirmpassword');?>
			</div>
			<div class="form-group">
				<input name="" type="submit" value="Reset your password" class="btn btn-primary" />
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		
	</div><!--row--><div class="gap30"></div><div class="gap30"></div><div class="gap30"></div><div class="gap30"></div><div class="gap30"></div><div class="gap10"></div>
</div><!--container-->