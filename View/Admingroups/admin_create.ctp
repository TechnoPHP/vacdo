<?php echo $this->element("admins/sidebar"); ?>
	<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="card">
					<div class="card-header"><h6>Create New Admin Group<?php echo $this->Html->link("Back to list", array("controller"=>"admingroups","action"=>"index","admin"=>true),array("class"=>"btn btn-sm btn-outline-info float-right")); ?></h6>
					</div>
					<div class="card-body">
						<?php echo $this->Form->create('Admingroup', array("url"=>array("controller"=>"admingroups","action"=>"create","admin"=>true),"role"=>"form","class"=>"form-inline"));	?>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Admingroup.name',array("class"=>"form-control","placeholder"=>"Group name")); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Admingroup.description',array("class"=>"form-control","placeholder"=>"Group description")); ?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="checkbox">
								<label>
								<?php echo $this->Form->checkbox('Admingroup.active',array()); ?>&nbsp;Make it active</label>
							</div>
						</div>
						<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-success">Create</button>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
					
                </section>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>