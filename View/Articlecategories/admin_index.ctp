<?php echo $this->element("admin/admin_sidebar"); ?>	
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Travel article categories</h4></div>
		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Latest article categories on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'articlecategories','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-content">
								<div class="project-table">
									<table id="e-product-list" class="table table-striped dt-responsive nowrap" width="100%" cellspacing="0">
										<thead>
											<tr>
										
											<th width="25%">Name</th>
											<th width="30%">Parent</th>									
											<th width="5%">Active</th>
											<th width="20%">Created</th>
											<th width="15%">Action</th>								  
											</tr>
										</thead>							
										<tbody>
											<?php //pr($articalcategories);exit;
												foreach($articalcategories as $postcategory){	?>
												<tr>
												
												
												<td><?php echo h($postcategory['Articlecategory']['name']); ?>&nbsp;</td>
												<td>
													<?php echo $this->Html->link($postcategory['ParentCategory']['name'], array('controller' => 'articlecategories', 'action' => 'view', $postcategory['ParentCategory']['id'])); ?>
												</td>
												<td><?php echo ($postcategory['Articlecategory']['active']?"Yes":"No"); ?>&nbsp;</td>										
												<td><?php echo $this->Time->niceShort($postcategory['Articlecategory']['created']); ?>&nbsp;</td>
												<td class="actions">
													<?php echo $this->Html->link(__('View'), array('action' => 'view', $postcategory['Articlecategory']['id']),array('class'=>'badge badge-success btn-xs')); ?>
													<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $postcategory['Articlecategory']['id']),array('class'=>'badge badge-info btn-xs')); ?>
													<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $postcategory['Articlecategory']['id']), array('class'=>'badge badge-danger btn-xs'), __('Are you sure you want to delete # %s?', $postcategory['Articlecategory']['id'])); ?>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
                                </div>
                            </div>
						</div><!--/card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->