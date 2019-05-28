<?php echo $this->element("admins/sidebar"); ?>	
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
			<?php echo $this->Flash->render('auth');?>
				<!--breadcrumbs start -->
				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"admins","action"=>"dashboard","admin"=>false),array("escape"=>false)); ?></li>
					<li class="breadcrumb-item"><a href="#">Admin Groups</a></li>
					<li class="breadcrumb-item">List</li>
				</ol>
				</nav>
				<!--breadcrumbs end -->
				<section class="card">
					<header class="card-header">List of Admin groups<div class="float-right"><?php echo $this->Html->link("Add New", array("controller"=>"admingroups","action"=>"create","admin"=>true),array("class"=>"btn  btn-sm btn-outline-info")); ?></div></header>
					
					<div class="card-body">
						<section id="unseen">
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
									foreach($admingroups as $group){	?>
										<tr>
										<td><?php echo $group['Admingroup']['name']; ?> </td>
										<td><?php echo $group['Admingroup']['description']; ?> </td>
										<td><?php echo ($group['Admingroup']['active'])?"Yes":"No"; ?></td>
										<td>
											<?php echo $this->Html->link('View',array('controller'=>'admingroups','action'=>'view/'.$group['Admingroup']['id'],'admin'=>true),array('class'=>'badge badge-success p-1')); ?>
										
											<?php echo $this->Html->link('Edit',array('controller'=>'admingroups','action'=>'edit/'.$group['Admingroup']['id'],'admin'=>true),array('class'=>'badge badge-info p-1')); ?>
										
											<?php echo $this->Html->link('Delete',array('controller'=>'admingroups','action'=>'delete/'.$group['Admingroup']['id'],'admin'=>true),array('class'=>'badge badge-danger p-1'),"Are you sure you want to delete?"); ?>
										</td>										
										</tr>
									<?php }	?>
								</tbody>
							</table>						
						</section> <!-- unseen -->
					</div><!--/#content.span10-->
				</section><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>