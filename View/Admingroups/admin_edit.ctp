<?php echo $this->element("admins/sidebar"); ?>
	<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="card">
					<header class="card-header"><h6>Update Admin Group<?php echo $this->Html->link("Back to list", array("plugin"=>false,"controller"=>"admingroups","action"=>"index","admin"=>true),array("class"=>"btn btn-sm btn-outline-info float-right")); ?></h6>
					</header>
					<div class="card-body">
						<?php echo $this->Form->create('Admingroup', array("url"=>array("controller"=>"admingroups","action"=>"edit","admin"=>true),"role"=>"form","class"=>"form-inline"));	?>
						<div class="col-md-3">
							<div class="form-group">
								<?php echo $this->Form->text('Admingroup.name',array("class"=>"form-control","placeholder"=>"Group name")); echo $this->Form->hidden('Admingroup.id');?>
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
						<button type="submit" class="btn btn-sm btn-success">Update</button>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
					
                </section>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>