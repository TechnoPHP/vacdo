<?php echo $this->element("admins/sidebar"); ?>
	<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><h6>Update Group<?php echo $this->Html->link("Back to list", array("plugin"=>"tagents","controller"=>"aagentgroups","action"=>"index","admin"=>true),array("class"=>"btn btn-outline-info btn-sm float-right")); ?></h6>
					</div>
					<div class="card-body">
						<?php echo $this->Form->create('Group', array("url"=>array("controller"=>"groups","action"=>"edit","admin"=>true),"role"=>"form","class"=>"form-inline"));	?>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Group.name',array("class"=>"form-control","placeholder"=>"Group name")); echo $this->Form->hidden('Group.id');?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Group.description',array("class"=>"form-control","placeholder"=>"Group description")); ?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="checkbox">
								<label>
								<?php echo $this->Form->checkbox('Group.active',array()); ?>Make it active</label>
							</div>
						</div>
						<div class="col-md-2">
						<button type="submit" class="btn btn-success">Update</button>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
					
                </div>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>