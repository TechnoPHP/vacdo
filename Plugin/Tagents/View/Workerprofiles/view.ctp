<div class="workerprofiles view">
<h2><?php echo __('Workerprofile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Worker'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workerprofile['Worker']['id'], array('controller' => 'workers', 'action' => 'view', $workerprofile['Worker']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['document']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idnumber'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['idnumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documentimage'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['documentimage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($workerprofile['Workerprofile']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workerprofile'), array('action' => 'edit', $workerprofile['Workerprofile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workerprofile'), array('action' => 'delete', $workerprofile['Workerprofile']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerprofile['Workerprofile']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerprofiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerprofile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
