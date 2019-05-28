<?php echo $this->element("admin/admin_sidebar"); ?>	
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Package types</h4></div>
		</div>
		<?php echo $this->Session->flash('auth');?>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Package types on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'packagetypes','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
					
						<div class="card-body">
						
							<table class="table table-bordered table-striped table-condensed">
								<thead>
								<tr>
									<th>Package type</th>
									<th width="60%">Description</th>
									<th>Active</th>
									<th>Action</th>								  
								</tr>
								</thead>							
								<tbody>
									<?php //pr($packagetypes); 
									foreach($packagetypes as $type){	?>
										<tr>
										<td><?php echo $type['Packagetype']['name']; ?> </td>
										<td><?php echo $type['Packagetype']['description']; ?> </td>
										<td><?php echo ($type['Packagetype']['active'])?"Yes":"No"; ?></td>
										<td>
											<?php echo $this->Html->link('View',array('controller'=>'packagetypes','action'=>'view/'.$type['Packagetype']['id'],'admin'=>true),array('class'=>'badge badge-success btn-xs')); ?>
										
											<?php echo $this->Html->link('Edit',array('controller'=>'packagetypes','action'=>'edit/'.$type['Packagetype']['id'],'admin'=>true),array('class'=>'badge badge-info btn-xs')); ?>
										
											<?php echo $this->Html->link('Delete',array('controller'=>'packagetypes','action'=>'delete/'.$type['Packagetype']['id'],'admin'=>true),array('class'=>'badge badge-danger btn-xs'),"Are you sure you want to delete?"); ?>
										</td>										
										</tr>
									<?php }	?>
								</tbody>
							</table>						
						
						</div><!-- card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->