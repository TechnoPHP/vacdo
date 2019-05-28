<?php echo $this->element('admins/sidebar');?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!--breadcrumbs start -->
				<div class=""><?php echo $this->Session->flash(); ?> </div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"users","action"=>"dashboard","admin"=>true),array("escape"=>false)); ?></li>
					<li class="breadcrumb-item"><a href="#">Users</a></li>
					<li class="breadcrumb-item">List</li>
					</ol>
				</nav>
				<!--breadcrumbs end -->
				<div><?php echo $this->Session->flash(); ?> </div>
				<div class="">
			<div class="card mb-3">
				<div class="card-body">
				<?php echo $this->Form->create("Aagentgroup",array("url"=>array("plugin"=>"tagents","controller"=>"aagents","action"=>"index","admin"=>true))); ?>
				<div class="form-inline">
					
					<?php echo $this->Form->select('Aagentgroup.id', $aagentgroups, array("empty"=>"--Select Group--","class"=>"form-control mx-sm-3"), false);?>
					<?php echo $this->Form->submit("Filter",array("class"=>"btn btn-primary btn-sm float-right")); ?>
					<?php echo $this->Form->error('Aagentgroup.name');?>
					
				</div>
				<?php	echo $this->Form->end();?>
				</div>
				</div>
				</div>
				<div class="card">
					<div class="card-header"><h6>List of Agents<?php echo $this->Html->link("Add New", array("plugin"=>"tagents","controller"=>"aagents","action"=>"create","admin"=>true),array("class"=>"btn btn-sm btn-outline-info float-right")); ?></h6>
					</div>
					<div class="card-body">
						
							<table class="table table-bordered table-striped table-condensed">
								<thead>
									<tr>
										<th width="10%">First Name</th>
										<th width="10%">Last Name</th>
										<th width="30%">Email</th>
										<th width="14%">phone</th>
										<th width="7%">Group</th>
										<th width="10%">Modified</th>
										<th width="14%" >Action</th>									
									</tr>							
								</thead>
								<tbody>
									<?php 
									foreach($aagents as $aagent){	?>
									<tr>
										<td><?php echo $aagent['Aagent']['firstname']?> </td>
										<td><?php echo $aagent['Aagent']['lastname']?> </td>
										<td><?php echo $aagent['Aagent']['email_address'];?> </td>
										<td><?php echo $aagent['Aagent']['phone']?></td>
										<td><?php echo $aagent['Aagentgroup']['name']; ?></td>
										<td><?php echo $this->Time->format('M j, Y',$aagent['Aagent']['modified']); ?></td>
										<td><?php echo $this->Html->link('View',array("plugin"=>"tagents","controller"=>"aagents",'action'=>'view/'.$aagent['Aagent']['id'],'admin'=>true),array('class'=>'badge badge-success')); ?> 
										<?php echo $this->Html->link('Edit',array("plugin"=>"tagents","controller"=>"aagents",'action'=>'edit/'.$aagent['Aagent']['id'],'admin'=>true),array('class'=>'badge badge-info')); ?> 
										<?php echo $this->Html->link('Delete',array("plugin"=>"tagents","controller"=>"aagents",'action'=>'delete/'.$aagent['Aagent']['id'],'admin'=>true),array('class'=>'badge badge-danger')); ?></td>
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
	</section>
</section>		