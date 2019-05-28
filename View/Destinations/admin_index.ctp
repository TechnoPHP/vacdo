<?php echo $this->element('admin/admin_sidebar');?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Destinations</h4></div>
		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Latest destinations on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'destinations','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-content">
								<div class="project-table">
									<table id="e-product-list" class="table table-striped dt-responsive nowrap" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Image</th>
												<th>Destination</th>
												<th>Country</th>
												
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($destinations as $destination){ ?>
											<tr>
												<td class="col-md-2">
													<?php echo $this->Html->image($destination['Destination']['imagename'],array("class"=>"img-fluid","alt"=>"")); ?>
												</td>
												<td class="col-md-6">
													<h6><?php echo $destination['Destination']['name'];?></h6>
													<span><?php echo CakeText::truncate($destination['Destination']['about'],200,array('ellipsis'=>'...','exact'=>false ));?></span>
												</td>
												
												<td class="col-md-2">
													<label class="label label-danger"><?php echo $destination['Destination']['country']; ?></label>
												</td>
												<td class="col-md-2 action-icon">
												<?php echo $this->Html->link("<i class='far fa-eye'></i>",array('plugin'=>'','controller'=>'destinations','action'=>'view',$destination['Destination']['id'],'admin'=>true),array('class'=>'mr-2','escape' => false));?>
												<?php echo $this->Html->link("<i class='far fa-edit text-info'></i>",array('plugin'=>'','controller'=>'destinations','action'=>'edit',$destination['Destination']['id'],'admin'=>true),array('class'=>'mr-2','escape' => false));?>
													
													<a href="#!" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="far fa-trash-alt text-danger"></i></a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->