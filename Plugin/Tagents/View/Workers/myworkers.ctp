<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="">
			<h3><?php echo __('Actions'); ?></h3>		
			<?php echo $this->Html->link(__('New Worker'), array('action' => 'create'),array('class'=>'btn btn-block btn-outline-info')); ?>
			<?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index'),array('class'=>'btn btn-block btn-outline-info')); ?>
			<?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'create'),array('class'=>'btn btn-block btn-outline-info')); ?>
			</div>
		</div><!-- col-md-3 -->
		<div class="col-md-10">
			
			<h2><?php echo __('Workers'); ?></h2>
			<div class="table-responsive">
				<table class="table table-striped">
				<thead class="thead-light">
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('aagent'); ?></th>
					<th><?php echo $this->Paginator->sort('category'); ?></th>
					<th><?php echo $this->Paginator->sort('firstname'); ?></th>
					<th><?php echo $this->Paginator->sort('lastname'); ?></th>
					
					<th><?php echo $this->Paginator->sort('gender'); ?></th>
					<th><?php echo $this->Paginator->sort('phone'); ?></th>
					<th><?php echo $this->Paginator->sort('ctcity'); ?></th>
					
					<th><?php echo $this->Paginator->sort('active'); ?></th>
					<th><?php echo $this->Paginator->sort('approved'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($myworkers as $worker): ?>
				<tr>
					<td><?php echo h($worker['Worker']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($worker['Aagent']['firstname'], array('controller' => 'aagents', 'action' => 'view', $worker['Aagent']['id'])); ?>
					</td>
					<td>
						<?php echo $this->Html->link($worker['Category']['name'], array('controller' => 'categories', 'action' => 'view', $worker['Category']['id'])); ?>
					</td>
					<td><?php echo h($worker['Worker']['firstname']); ?>&nbsp;</td>
					<td><?php echo h($worker['Worker']['lastname']); ?>&nbsp;</td>
					<td><?php echo h($worker['Worker']['gender']); ?>&nbsp;</td>
					<td><?php echo h($worker['Worker']['phone']); ?>&nbsp;</td>				
					<td><?php echo h($worker['Worker']['ctcity']); ?>&nbsp;</td>				
					<td><?php echo h($worker['Worker']['active']); ?>&nbsp;</td>
					<td><?php echo h($worker['Worker']['approved']); ?>&nbsp;</td>
					<td><?php echo h($worker['Worker']['modified']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $worker['Worker']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $worker['Worker']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $worker['Worker']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $worker['Worker']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</tbody>
				</table>
			</div>
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
		</div><!-- col-md-9 -->
		
	</div><!-- row -->
</div><!-- container -->
