<?php echo $this->element("admins/sidebar"); ?>
	<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><h6>Create New Agent Group<?php echo $this->Html->link("Back to list", array("plugin"=>"tagents","controller"=>"travelagentgroups","action"=>"index","admin"=>true),array("class"=>"btn btn-outline-info btn-sm float-right")); ?></h6>
					</div>
					<div class="card-body">
						<?php echo $this->Form->create('Travelagentgroup', array("url"=>array("plugin"=>"tagents","controller"=>"travelagentgroups","action"=>"create","admin"=>true),"role"=>"form","class"=>"form-inline"));	?>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Aagentgroup.name',array("class"=>"form-control","placeholder"=>"Group name")); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Aagentgroup.description',array("class"=>"form-control","placeholder"=>"Group description")); ?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="checkbox">
								<label>
								<?php echo $this->Form->checkbox('Aagentgroup.active',array()); ?>&nbsp;Make it active</label>
							</div>
						</div>
						<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-success">Create</button>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
					
                </div>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>