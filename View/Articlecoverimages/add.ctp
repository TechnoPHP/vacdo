<div class="postcoverimages form">
<?php echo $this->Form->create('Postcoverimage'); ?>
	<fieldset>
		<legend><?php echo __('Add Postcoverimage'); ?></legend>
	<?php
		echo $this->Form->input('post_id');
		echo $this->Form->input('namesmall');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Postcoverimages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
