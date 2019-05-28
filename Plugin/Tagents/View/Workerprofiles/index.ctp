<div class="workerprofiles index">
	<h2><?php echo __('Workerprofiles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('worker_id'); ?></th>
			<th><?php echo $this->Paginator->sort('document'); ?></th>
			<th><?php echo $this->Paginator->sort('idnumber'); ?></th>
			<th><?php echo $this->Paginator->sort('documentimage'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($workerprofiles as $workerprofile): ?>
	<tr>
		<td><?php echo h($workerprofile['Workerprofile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($workerprofile['Worker']['id'], array('controller' => 'workers', 'action' => 'view', $workerprofile['Worker']['id'])); ?>
		</td>
		<td><?php echo h($workerprofile['Workerprofile']['document']); ?>&nbsp;</td>
		<td><?php echo h($workerprofile['Workerprofile']['idnumber']); ?>&nbsp;</td>
		<td><?php echo h($workerprofile['Workerprofile']['documentimage']); ?>&nbsp;</td>
		<td><?php echo h($workerprofile['Workerprofile']['created']); ?>&nbsp;</td>
		<td><?php echo h($workerprofile['Workerprofile']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $workerprofile['Workerprofile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $workerprofile['Workerprofile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $workerprofile['Workerprofile']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerprofile['Workerprofile']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Workerprofile'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
