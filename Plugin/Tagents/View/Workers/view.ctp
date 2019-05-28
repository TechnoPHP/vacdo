<div class="workers view">
<h2><?php echo __('Worker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aagent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($worker['Aagent']['id'], array('controller' => 'aagents', 'action' => 'view', $worker['Aagent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($worker['Category']['name'], array('controller' => 'categories', 'action' => 'view', $worker['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dateofbirth'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['dateofbirth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctaddress'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ctaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctlandmark'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ctlandmark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctarea'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ctarea']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctcity'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ctcity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctpincode'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ctpincode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ptaddress'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ptaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ptlandmark'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ptlandmark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ptarea'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ptarea']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ptcity'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ptcity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ptpincode'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['ptpincode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approved'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['approved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin'); ?></dt>
		<dd>
			<?php echo $this->Html->link($worker['Admin']['id'], array('controller' => 'admins', 'action' => 'view', $worker['Admin']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agentremark'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['agentremark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adminremark'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['adminremark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($worker['Worker']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Worker'), array('action' => 'edit', $worker['Worker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Worker'), array('action' => 'delete', $worker['Worker']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $worker['Worker']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Workers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Worker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Aagents'), array('controller' => 'aagents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aagent'), array('controller' => 'aagents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admins'), array('controller' => 'admins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin'), array('controller' => 'admins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerprofiles'), array('controller' => 'workerprofiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerprofile'), array('controller' => 'workerprofiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workerreferences'), array('controller' => 'workerreferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workerreference'), array('controller' => 'workerreferences', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Workerprofiles'); ?></h3>
	<?php if (!empty($worker['Workerprofile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Worker Id'); ?></th>
		<th><?php echo __('Document'); ?></th>
		<th><?php echo __('Idnumber'); ?></th>
		<th><?php echo __('Documentimage'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($worker['Workerprofile'] as $workerprofile): ?>
		<tr>
			<td><?php echo $workerprofile['id']; ?></td>
			<td><?php echo $workerprofile['worker_id']; ?></td>
			<td><?php echo $workerprofile['document']; ?></td>
			<td><?php echo $workerprofile['idnumber']; ?></td>
			<td><?php echo $workerprofile['documentimage']; ?></td>
			<td><?php echo $workerprofile['created']; ?></td>
			<td><?php echo $workerprofile['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'workerprofiles', 'action' => 'view', $workerprofile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'workerprofiles', 'action' => 'edit', $workerprofile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'workerprofiles', 'action' => 'delete', $workerprofile['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerprofile['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Workerprofile'), array('controller' => 'workerprofiles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Workerreferences'); ?></h3>
	<?php if (!empty($worker['Workerreference'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Worker Id'); ?></th>
		<th><?php echo __('Fatherfullname'); ?></th>
		<th><?php echo __('Motherfullname'); ?></th>
		<th><?php echo __('Spoucefullname'); ?></th>
		<th><?php echo __('Referencefullname'); ?></th>
		<th><?php echo __('Referenceaddress'); ?></th>
		<th><?php echo __('Referencephone'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($worker['Workerreference'] as $workerreference): ?>
		<tr>
			<td><?php echo $workerreference['id']; ?></td>
			<td><?php echo $workerreference['worker_id']; ?></td>
			<td><?php echo $workerreference['fatherfullname']; ?></td>
			<td><?php echo $workerreference['motherfullname']; ?></td>
			<td><?php echo $workerreference['spoucefullname']; ?></td>
			<td><?php echo $workerreference['referencefullname']; ?></td>
			<td><?php echo $workerreference['referenceaddress']; ?></td>
			<td><?php echo $workerreference['referencephone']; ?></td>
			<td><?php echo $workerreference['created']; ?></td>
			<td><?php echo $workerreference['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'workerreferences', 'action' => 'view', $workerreference['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'workerreferences', 'action' => 'edit', $workerreference['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'workerreferences', 'action' => 'delete', $workerreference['id']), array('confirm' => __('Are you sure you want to delete # %s?', $workerreference['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Workerreference'), array('controller' => 'workerreferences', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
