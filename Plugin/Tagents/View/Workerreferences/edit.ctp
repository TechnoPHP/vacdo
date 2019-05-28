<div class="workerreferences form">
<?php echo $this->Form->create('Workerreference'); ?>
	<fieldset>
		<legend><?php echo __('Edit Workerreference'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('worker_id');
		echo $this->Form->input('fatherfullname');
		echo $this->Form->input('motherfullname');
		echo $this->Form->input('spoucefullname');
		echo $this->Form->input('referencefullname');
		echo $this->Form->input('referenceaddress');
		echo $this->Form->input('referencephone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Workerreference.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Workerreference.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Workerreferences'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
