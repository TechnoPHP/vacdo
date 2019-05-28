<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-9">
				<h5>Latest destinations on vacdo</h5>
			</div>
			<div class="col-md-3 text-right">
		<?php echo $this->Html->link("Add New",array('plugin'=>'','controller'=>'destinations','action'=>'create','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
			</div>
		</div>
	</div>
	<div class="card-block">
		<div class="table-content">
			<div class="project-table">
				<table id="e-product-list" class="table table-striped dt-responsive nowrap" width="100%" cellspacing="0">
					<tbody>
					<?php foreach($appdestinations as $destination){ ?>
						<tr>							
							<td class="pro-name">
								<h6><?php echo $destination['Destination']['name'];?></h6>
							</td>
							<td>
								<h6><label class="label label-danger"><?php echo $destination['Destination']['country'];?></label></h6>
							</td>
							
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--card -->