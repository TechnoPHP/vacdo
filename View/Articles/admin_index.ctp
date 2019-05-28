<?php echo $this->element('admin/admin_sidebar');?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Travel articles</h4></div>
		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Latest articles on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'articles','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
					
						<div class="card-body">
							<div class="table-content">
								<div class="project-table">
									<table id="e-product-list" class="table table-striped dt-responsive nowrap" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th width="10%">Image</th>
												<th width="50%">Title</th>
												<th width="11%">PublisedOn</th>
												<th width="7%">Active</th>
												<th width="15%">Action</th>
											</tr>
										</thead>							
										<tbody>
											<?php //pr($posts); 
											foreach($posts as $post){?>					
												<tr>
													<td><?php 
													if(!empty($post['Articlecoverimage']['namesmall'])){
													echo $this->Html->image($post['Articlecoverimage']['namesmall'], array('class'=>'img-responsive'));
													}else{
													echo $this->Html->image("php_default_small.jpg", array('class'=>'img-responsive'));
													} ?>
													</td>
													<td><?php echo $post['Article']['title']; 
														echo "&nbsp;&nbsp;(".$post['Article']['comment_count'].")"; ?>
													</td>
													<td><?php echo $this->Time->niceShort($post['Article']['modified']); ?></td>
													<td><?php echo ($post['Article']['active'])?"Yes":"No"; ?></td>
													<td>
													<?php echo $this->Html->link("View",array("controller"=>"articles","action"=>"view/".$post['Article']['id'],"admin"=>true),array('class'=>'badge badge-success btn-xs')); ?> 
													<?php echo $this->Html->link("Edit",array("controller"=>"articles","action"=>"edit/".$post['Article']['id'],"admin"=>true),array('class'=>'badge badge-info btn-xs'));?> 
													<?php echo $this->Html->link("Delete",array("controller"=>"articles","action"=>"delete/".$post['Article']['id'],"admin"=>true),array('class'=>'badge badge-danger btn-xs'),"Are you sure you want to delete?"); ?>
													
													</td>
												</tr>
											<?php }	?>
										</tbody>
									</table>
                                </div>
                            </div>
						
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
						
						</div><!--/card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->