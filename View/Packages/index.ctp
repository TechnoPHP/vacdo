<?php //echo $this->element('sidebar_dashboard');?>
<!--main content start-->

<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div><?php echo $this->Flash->render(); ?> </div>
				<div class="card">
					<div class="card-header"><h6>List of Packages<?php echo $this->Html->link("Add New", array("plugin"=>"tagents","controller"=>"packages","action"=>"create","admin"=>false),array("class"=>"btn btn-sm btn-outline-info float-right")); ?></h6>
					</div>
			
					
					
					<div class="card-body">
						
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th width="30%">Name</th>
									<th width="8%">#Days</th>
									<th width="8%">#Nights</th>
									<th width="12%">Price</th>
									<th width="10%">Modified</th>
									<th width="14%">Action</th>									
								</tr>							
							</thead>
							<tbody>
								<?php 
								foreach($packages as $package){	?>
								<tr>
									<td><?php echo $package['Package']['title']?> </td>
									<td><?php echo $package['Package']['numberofdays']?> </td>
									<td><?php echo $package['Package']['numberofnights'];?> </td>
									<td><?php echo $package['Package']['price'];?> </td>
									<td><?php echo $this->Time->format('M jS, Y',$package['Package']['modified']); ?></td>
									<td><?php echo $this->Html->link('View',array('controller'=>'packages','action'=>'view/'.$package['Package']['id'],'admin'=>false),array('class'=>'badge badge-success')); ?> 
									<?php echo $this->Html->link('Edit',array('controller'=>'packages','action'=>'edit/'.$package['Package']['id'],'admin'=>false),array('class'=>'badge badge-info')); ?> 
									<?php echo $this->Html->link('Delete',array('controller'=>'packages','action'=>'delete/'.$package['Package']['id'],'admin'=>false),array('class'=>'badge badge-danger')); ?></td>
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
				</div><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</div>
</div>