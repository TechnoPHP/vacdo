<?php echo $this->element("admins/sidebar"); ?>	
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!--breadcrumbs start -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"admins","action"=>"dashboard","admin"=>false),array("escape"=>false)); ?></li>
						<li class="breadcrumb-item"><a href="#">Agent Groups</a></li>
						<li class="breadcrumb-item">List</li>
					</ol>
				</nav>
				<!--breadcrumbs end -->
				<div class="card">
					<div class="card-header"><h6>List of Agent groups<?php echo $this->Html->link("Add New", array("plugin"=>"tagents","controller"=>"aagentgroups","action"=>"create","admin"=>true),array("class"=>"btn btn-outline-info btn-sm float-right")); ?></h6></div>
					<?php echo $this->Session->flash('auth');?>
					<div class="card-body">
						
							<table class="table table-bordered table-striped table-condensed">
								<thead>
								<tr>
									<th>Group</th>
									<th>Description</th>
									<th>Active</th>
									<th>Action</th>								  
								</tr>
								</thead>							
								<tbody>
									<?php //pr($admingroups); 
									foreach($aagentgroups as $group){	?>
										<tr>
										<td><?php echo $group['Group']['name']; ?> </td>
										<td><?php echo $group['Group']['description']; ?> </td>
										<td><?php echo ($group['Group']['active'])?"Yes":"No"; ?></td>
										<td>
											<?php echo $this->Html->link('View',array('controller'=>'groups','action'=>'view/'.$group['Group']['id'],'admin'=>true),array('class'=>'badge badge-success btn-xs')); ?>
										
											<?php echo $this->Html->link('Edit',array('controller'=>'groups','action'=>'edit/'.$group['Group']['id'],'admin'=>true),array('class'=>'badge badge-info btn-xs')); ?>
										
											<?php echo $this->Html->link('Delete',array('controller'=>'groups','action'=>'delete/'.$group['Group']['id'],'admin'=>true),array('class'=>'badge badge-danger btn-xs'),"Are you sure you want to delete?"); ?>
										</td>										
										</tr>
									<?php }	?>
								</tbody>
							</table>						
						
					</div><!--/#content.span10-->
				</div><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>