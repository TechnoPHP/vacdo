<?php echo $this->element("admin/admin_sidebar"); ?>
	<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Holiday themes</h4></div>
		</div>
		<?php echo $this->Session->flash('auth');?>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Holiday themes on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'holidaythemes','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<?php echo $this->Form->create('Holidaytheme', array("url"=>array("plugin"=>"","controller"=>"holidaythemes","action"=>"edit","admin"=>true),"role"=>"form","class"=>""));	?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->text('Holidaytheme.name',array("class"=>"form-control","placeholder"=>"Holidaytheme name")); echo $this->Form->hidden('Holidaytheme.id');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->textarea('Holidaytheme.description',array("class"=>"form-control","placeholder"=>"Holidaytheme description","rows"=>"5")); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="checkbox">
										<label>
										<?php echo $this->Form->checkbox('Holidaytheme.active',array()); ?>&nbsp;Make it active</label>
									</div>
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-sm btn-success">Update</button>
								</div>
							</div><!--row-->
							<?php echo $this->Form->end(); ?>
						</div><!--card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->