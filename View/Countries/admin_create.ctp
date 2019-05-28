<?php echo $this->element("admin/admin_sidebar"); ?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		
		<div class="page-header">
			<div class="page-header-title"><h4>Countries</h4></div>
		</div>
		
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Countries</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'countries','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<?php echo $this->Form->create('Country', array("url"=>array("controller"=>"countries","action"=>"edit","admin"=>true)));?>
							<div class="row">							
								<div class="col-md-6">
									<div class="">
										<div class="form-group">
											<label>Country Name *:</label>
											<?php echo $this->Form->text('Country.name', array('class'=>'form-control'));?>
											<?php echo $this->Form->error('Country.name');?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">	
												<label>ISO-2*</label>
												<?php echo $this->Form->text('Country.iso_2', array('class' => 'form-control')); ?>
												<?php echo $this->Form->error('Country.iso_2');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">	
												<label>ISO-3*</label>
												<?php echo $this->Form->text('Country.iso_3', array('class'=> 'form-control'));?>
													<?php echo $this->Form->error('Country.iso_3');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Phone Country Code *:</label>
												<?php echo $this->Form->text('Country.phonecode', array('class' => 'form-control')); ?>
												<?php echo $this->Form->error('Country.phonecode');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ISO numeric Code *:</label>
												<?php echo $this->Form->text('Country.isonumeric', array('class' => 'form-control')); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Latitude *:</label>
												<?php echo $this->Form->text('Country.lat', array('class'=>'form-control')); ?>
												<?php echo $this->Form->error('Country.lat');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">		
												<label>Longitude *:</label>
												<?php echo $this->Form->text('Country.long', array('class'=>'form-control')); ?>
												<?php echo $this->Form->error('Country.long');?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="">
										<div class="form-group">
											<label>About / Short Note on country:</label>
											<?php echo $this->Form->textarea('Country.about', array('rows'=>'10','class'=>'form-control')); ?>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
								
									<button type="submit" class="btn btn-sm btn-success">Update country</button>
								</div>
							</div><!-- end of row -->

															
							<?php echo $this->Form->end(); ?>

						</div><!--card-block-->
					</div><!--card-->
				</div><!--col-md-12 -->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->