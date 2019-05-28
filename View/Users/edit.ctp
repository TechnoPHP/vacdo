<div class="col-md-12 form">
<?php echo $this->Form->create('User'); ?>
	<h3><?php echo __('Edit User'); ?></h3>
	<?php
		echo $this->Form->input('id');
	?>
	<div class="row">			
		<div class="col-md-6 form-group">
			<label>Select Group</label>
			<?php echo $this->Form->select('User.group_id',$groups,array("class"=>"form-control","empty"=>"Select Group"));?>
		</div>
	</div>
	<div class="row">			
		<div class="col-md-6 col-sm-4 col-sx-2 form-group">
		<label>First Name</label>
			<?php echo $this->Form->text('User.firstname',array("class"=>"form-control","placeholder"=>"First name"));?>
		</div>
		<div class="col-md-6 form-group">
		<label>Last Name</label>
			<?php echo $this->Form->text('User.lastname',array("class"=>"form-control","placeholder"=>"Last name"));?>
		</div>
	</div>
	<div class="row">			
		<div class="col-md-6 form-group">
		<label>Email Address</label>
			<?php echo $this->Form->text('User.email',array("class"=>"form-control","placeholder"=>"Email address"));?>
		</div>
		<div class="col-md-6 form-group">
		<label>Password</label>
			<?php //echo $this->Form->text('User.password',array("class"=>"form-control","placeholder"=>"password"));?>
		</div>
	</div>
	<div class="row">			
		<div class="col-md-6 form-group">
		<label>Contact number</label>
			<?php echo $this->Form->text('User.phone',array("class"=>"form-control","placeholder"=>"Contact number"));?>
		</div>
	</div>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stores'), array('controller' => 'stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Store'), array('controller' => 'stores', 'action' => 'add')); ?> </li>
	</ul>
</div>
