<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">	
		<h3>Change your password</h3><hr>
			<?php echo $this->Form->create('User', array("url"=>array("controller"=>"users","action"=>"changepassword"),'class'=>''));?>
			<div class="form-group">
				<label>Current Password *</label>
				<?php echo $this->Form->password('User.current_password', array('class' => 'form-control')); ?>
				<?php echo $this->Form->hidden('User.confirm', array('value'=>$confirm,'class' => '')); ?>
				<?php echo $this->Form->error('User.current_password');?>
			</div>
			<div class="form-group">
				<label >New Password *</label>
					<?php echo $this->Form->password('User.password', array('class' => 'form-control')); ?>
					<?php echo $this->Form->error('User.password');?>
			</div>
			<div class="form-group">
				<label >Retype New Password *</label>
					<?php echo $this->Form->password('User.confirm_password', array('class' => 'form-control')); ?>
					<?php echo $this->Form->error('User.confirm_password');?>
			</div>
			<div class="form-group">
				<input name="" type="submit" value="Change your password" class="btn btn-primary" />
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="gap30"></div><div class="gap30"></div><div class="gap30"></div><div class="gap10"></div>
</div>