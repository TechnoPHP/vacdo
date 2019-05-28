<div class="workerprofiles form">
<?php echo $this->Form->create('Workerprofile'); ?>
	<fieldset>
		<legend><?php echo __('Add Workerprofile'); ?></legend>
	<?php
		echo $this->Form->input('worker_id');
		echo $this->Form->input('document');
		echo $this->Form->input('idnumber');
		echo $this->Form->input('documentimage');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Workerprofiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
