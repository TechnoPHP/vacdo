<div class="postcoverimages view">
<h2><?php echo __('Postcoverimage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($postcoverimage['Postcoverimage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postcoverimage['Post']['title'], array('controller' => 'posts', 'action' => 'view', $postcoverimage['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Namesmall'); ?></dt>
		<dd>
			<?php echo h($postcoverimage['Postcoverimage']['namesmall']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postcoverimage['Postcoverimage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($postcoverimage['Postcoverimage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Postcoverimage'), array('action' => 'edit', $postcoverimage['Postcoverimage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Postcoverimage'), array('action' => 'delete', $postcoverimage['Postcoverimage']['id']), array(), __('Are you sure you want to delete # %s?', $postcoverimage['Postcoverimage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Postcoverimages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Postcoverimage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
