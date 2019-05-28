<?php echo $this->element("admin/admin_sidebar"); ?>	
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Countries</h4></div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class=""><?php echo $this->Session->flash(); ?> </div>
				
				<ul class="pagination">
				<?php
					echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
					echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
					echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				?>
				</ul>
				<div class="card">
					<div class="card-header"><h6>List of Countries<?php echo $this->Html->link("Add New", array("plugin"=>"","controller"=>"countries","action"=>"create","admin"=>true),array("class"=>"btn btn-outline-info float-right btn-sm")); ?></h6></div>
					<div class="card-body">

							
							<table class="table table-bordered table-striped table-condensed">
								<thead>
								<tr>
									<th width="20%">Name</th>
									<th width="8%">ISO-2</th>
									<th width="8%">ISO-3</th>									
									<th width="8%">ISO-#</th>
									<th width="8%">PhCode</th>
									<th width="10%">Latitude</th>
									<th width="10%">Longitude</th>
									<th width="5%">Active</th>									
									<th width="15%">Action</th>								  
								</tr>
								</thead>							
								<tbody>
									<?php //pr($countries);exit;
										foreach($countries as $country){	?>
										<tr>
										
										
										<td><?php echo h($country['Country']['name']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['iso_2']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['iso_3']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['isonumeric']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['phonecode']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['lat']); ?>&nbsp;</td>
										<td><?php echo h($country['Country']['long']); ?>&nbsp; </td>
										<td><?php echo ($country['Country']['active']?"Yes":"No"); ?>&nbsp;</td>
										
										<td class="actions">
											<?php echo $this->Html->link(__('View'), array('action' => 'view', $country['Country']['id']),array('class'=>'badge badge-success')); ?>
											<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $country['Country']['id']),array('class'=>'badge badge-info')); ?>
											<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $country['Country']['id']), array('class'=>'badge badge-danger'), __('Are you sure you want to delete # %s?', $country['Country']['id'])); ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

						<p>
						<?php
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));
						?></p>
						<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div><!--/#content-->
				</div><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</div><!--page-wrapper-->
</div><!--main-body-->