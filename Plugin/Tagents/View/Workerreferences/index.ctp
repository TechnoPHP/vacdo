<div class="workerreferences index">
	<h2><?php echo __('Workerreferences'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('worker_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fatherfullname'); ?></th>
			<th><?php echo $this->Paginator->sort('motherfullname'); ?></th>
			<th><?php echo $this->Paginator->sort('spoucefullname'); ?></th>
			<th><?php echo $this->Paginator->sort('referencefullname'); ?></th>
			<th><?php echo $this->Paginator->sort('referenceaddress'); ?></th>
			<th><?php echo $this->Paginator->sort('referencephone'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($workerreferences as $workerreference): ?>
	<tr>
		<td><?php echo h($workerreference['Workerreference']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($workerreference['Worker']['id'], array('controller' => 'workers', 'action' => 'view', $workerreference['Worker']['id'])); ?>
		</td>
		<td><?php echo h($workerreference['Workerreference']['fatherfullname']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['motherfullname']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['spoucefullname']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['referencefullname']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['referenceaddress']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['referencephone']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['created']); ?>&nbsp;</td>
		<td><?php echo h($workerreference['Workerreference']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $workerreference['Workerreference']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $workerreference['Workerreference']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $workerreference['Workerreference']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerreference['Workerreference']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Workerreference'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Workers'), array('controller' => 'workers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('controller' => 'workers', 'action' => 'add')); ?> </li>
	</ul>
</div>
