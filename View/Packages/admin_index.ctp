<?php echo $this->element('admin/admin_sidebar');?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		
		<div class="page-header">
			<div class="page-header-title"><h4>Packages</h4></div>
		</div>
		<div><?php echo $this->Session->flash(); ?> </div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Packages on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'packages','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						
				
			
				
						
						<div class="card-body">					
						
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th width="34%">Name</th>
									<th width="10%">Destination</th>
									<th width="10%">Price</th>
									<th width="12%">Contact</th>
									<th width="10%">UpdatedOn</th>
									<th width="14%">Action</th>									
								</tr>							
							</thead>
							<tbody>
								<?php 
								foreach($packages as $package){	?>
								<tr>
									<td><strong><?php echo $package['Package']['title'];?></strong><br>
									<small>By <?php echo $package['Travelagency']['name'];?></small></td>
									<td><?php echo $package['Package']['numberofdays'];?>&nbsp;days </td>
									<td><?php echo $package['Package']['price'];?> </td>
									<td><?php echo $package['Travelagency']['phone'];?> </td>
									
									<td><?php echo $this->Time->format('M j, Y',$package['Package']['modified']); ?></td>
									<td><?php echo $this->Html->link('View',array('controller'=>'packages','action'=>'view/'.$package['Package']['id'],'admin'=>true),array('class'=>'badge badge-success')); ?> 
									<?php echo $this->Html->link('Edit',array('controller'=>'packages','action'=>'edit/'.$package['Package']['id'],'admin'=>true),array('class'=>'badge badge-info')); ?> 
									<?php //echo $this->Html->link('Delete',array('controller'=>'packages','action'=>'delete/'.$package['Package']['id'],'admin'=>true),array('class'=>'badge badge-danger')); ?></td>
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
					
                        </div><!--card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->