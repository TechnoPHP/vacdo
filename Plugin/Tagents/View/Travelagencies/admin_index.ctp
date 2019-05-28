<?php echo $this->element('admin/admin_sidebar');?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Travel agencies</h4></div>
		</div>
		<div><?php echo $this->Session->flash('auth');?><?php echo $this->Session->flash(); ?> </div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Travel agencies</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add new",array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
					
					
					<div class="card-body">
						
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th width="30%">Name</th>
									<th width="10%">City</th>
									<th width="10%">Phone</th>
									<th width="12%">Contact</th>
									<th width="12%">Modified</th>
									<th width="14%">Action</th>									
								</tr>							
							</thead>
							<tbody>
								<?php 
								foreach($travelagencies as $agency){	?>
								<tr>
									<td><?php echo $agency['Travelagency']['name']?> </td>
									<td><?php echo $agency['Travelagency']['city']?> </td>
									<td><?php echo $agency['Travelagency']['phone'];?> </td>
									<td>
									<?php foreach($agency['Travelagent'] as $agent){
									echo $agent['firstname'].' '.$agent['lastname'];
									}?> </td>
									<td><?php echo $this->Time->format('M j, Y',$agency['Travelagency']['modified']); ?></td>
									<td><?php echo $this->Html->link('View',array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'view/'.$agency['Travelagency']['id'],'admin'=>true),array('class'=>'badge badge-success')); ?> 
									<?php echo $this->Html->link('Edit',array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'edit/'.$agency['Travelagency']['id'],'admin'=>true),array('class'=>'badge badge-info')); ?> 
									<?php echo $this->Html->link('Delete',array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'delete/'.$agency['Travelagency']['id'],'admin'=>true),array('class'=>'badge badge-danger')); ?></td>
								</tr>
								<?php } ?>					
							</tbody>
						</table>
						
						<p>
						<?php
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));
						?>	</p>
						
						<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div>
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->