<?php echo $this->element("admin/admin_sidebar"); ?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					Update this comment<div class="pull-right"><?php echo $this->Html->link("Back to list", array("controller"=>"comments","action"=>"index","admin"=>true)); ?></div>
					</header>					
					<div class="row">
						<div class="col-md-12">						
							<div class="panel-body">
								<?php echo $this->Form->create('Comment', array("controller"=>"comments",'action' => 'edit','admin'=>true,'type'=>'file'));?>
									<div class="row">
										<div class="col-md-4 form-group">
										<label class="">Category </label>
											<?php echo $this->Form->select('Post.postcategory_id',$parent,array("class"=>"form-control","empty"=>"--Select Category--","disabled")); ?>
										</div>
										<div class="col-md-8 form-group">
										<label class="">Title </label>
											<?php echo $this->Form->text('Post.title',array("class"=>"form-control", "disabled")); echo $this->Form->hidden('Post.id');echo $this->Form->hidden('Comment.id');?>
										</div>
									</div>
									<div class="row">									
										<div class="col-md-12 form-group">
											<label class="">Message</label>
											<?php echo $this->Form->textarea('Comment.message',array("class"=>"form-control","rows"=>"6")); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 form-group">
											<label>First name</label>
										<?php echo $this->Form->text('Comment.firstname', array("class"=>"form-control"));?>
										</div>
										<div class="col-md-4 form-group">
											<label>Website</label>
										<?php echo $this->Form->text('Comment.website', array("class"=>"form-control"));?>
										</div>
										<div class="col-md-2 checkbox">
										<?php echo $this->Form->checkbox('Comment.active', array());?><label>Make it active</label>
										</div>
										<div class="col-md-2 form-group">
											<input name="" type="submit" value="Update" class="btn btn-success" />
										</div>
									</div>									
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</section>		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>