<div class="container">
	<div class="row">
		<div class="col-md-3">
			<h3><?php echo __('Actions'); ?></h3>
				<?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $agent['Aagent']['id']) ,array('class'=>'btn btn-block btn-outline-info'), __('Are you sure you want to delete # %s?', $agent['Aagent']['id'])); ?>
				<?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $agent['Aagent']['id']),array('class'=>'btn btn-block btn-outline-info')); ?>
				
				<?php echo $this->Html->link(__('List Users'), array('action' => 'index'),array('class'=>'btn btn-block btn-outline-info')); ?>
				<?php echo $this->Html->link(__('New User'), array('action' => 'add'),array('class'=>'btn btn-block btn-outline-info')); ?>
				<?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index'),array('class'=>'btn btn-block btn-outline-info')); ?>
				<?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'),array('class'=>'btn btn-block btn-outline-info')); ?>
				
			</ul>
		</div>
		<div class="col-md-9">
		<h2><?php echo __('Agent'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($agent['Aagent']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Email ID'); ?></dt>
				<dd>
					<?php echo h($agent['Aagent']['email_address']); ?>
					&nbsp;
				</dd>
				
				<dt><?php echo __('Group'); ?></dt>
				<dd>
					<?php echo $this->Html->link($agent['Group']['name'], array('plugin'=>'','controller' => 'groups', 'action' => 'view', $agent['Group']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($agent['Aagent']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($agent['Aagent']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
	</div>
</div>