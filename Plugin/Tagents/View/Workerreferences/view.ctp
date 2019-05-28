<div class="workerreferences view">
<h2><?php echo __('Workerreference'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Worker'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workerreference['Worker']['id'], array('controller' => 'workers', 'action' => 'view', $workerreference['Worker']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fatherfullname'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['fatherfullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Motherfullname'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['motherfullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spoucefullname'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['spoucefullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referencefullname'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['referencefullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referenceaddress'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['referenceaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referencephone'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['referencephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($workerreference['Workerreference']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workerreference'), array('action' => 'edit', $workerreference['Workerreference']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workerreference'), array('action' => 'delete', $workerreference['Workerreference']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerreference['Workerreference']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerreferences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerreference'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
