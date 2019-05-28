<div class="bscategories index">
	<h2><?php echo __('Countries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('iso_2'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($countries as $country): ?>
	<tr>
		<td><?php echo h($country['Country']['id']); ?>&nbsp;</td>
		<td><?php echo h($country['Country']['iso_2']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(h($country['Country']['name']),array('subdomain'=>$country['Country']['iso_2'],'controller'=>'buynsales','action'=>'filter')); ?>&nbsp;</td>
		
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $country['Country']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $country['Country']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $country['Country']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $country['Country']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Bscategory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Buynsales'), array('controller' => 'buynsales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buynsale'), array('controller' => 'buynsales', 'action' => 'add')); ?> </li>
	</ul>
</div>
