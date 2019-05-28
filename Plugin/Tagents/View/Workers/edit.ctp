<div class="workers form">
<?php echo $this->Form->create('Worker'); ?>
	<fieldset>
		<legend><?php echo __('Edit Worker'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('aagent_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('dateofbirth');
		echo $this->Form->input('gender');
		echo $this->Form->input('phone');
		echo $this->Form->input('photo');
		echo $this->Form->input('ctaddress');
		echo $this->Form->input('ctlandmark');
		echo $this->Form->input('ctarea');
		echo $this->Form->input('ctcity');
		echo $this->Form->input('ctpincode');
		echo $this->Form->input('ptaddress');
		echo $this->Form->input('ptlandmark');
		echo $this->Form->input('ptarea');
		echo $this->Form->input('ptcity');
		echo $this->Form->input('ptpincode');
		echo $this->Form->input('active');
		echo $this->Form->input('approved');
		echo $this->Form->input('admin_id');
		echo $this->Form->input('agentremark');
		echo $this->Form->input('adminremark');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Worker.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Worker.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Workers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Aagents'), array('controller' => 'aagents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aagent'), array('controller' => 'aagents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admins'), array('controller' => 'admins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin'), array('controller' => 'admins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerprofiles'), array('controller' => 'workerprofiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerprofile'), array('controller' => 'workerprofiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerreferences'), array('controller' => 'workerreferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerreference'), array('controller' => 'workerreferences', 'action' => 'add')); ?> </li>
	</ul>
</div>
