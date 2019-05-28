<?php echo $this->element("admin/admin_sidebar"); ?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					Create New Post<div class="pull-right"><?php echo $this->Html->link("Back to list", array("controller"=>"posts","action"=>"index","admin"=>true)); ?></div>
					</header>
					
					<div class="row">
						<div class="col-md-12">						
							<div class="panel-body">
								<?php echo $this->Form->create('Post', array("controller"=>"posts",'action' => 'create','admin'=>true,'type'=>'file'));?>
									<div class="row">
										<div class="col-md-4 form-group">
										<label class="">Category </label>
											<?php echo $this->Form->select('Post.postcategory_id',$parent,array("class"=>"form-control","empty"=>"--Select Category--")); ?>
										</div>
										<div class="col-md-8 form-group">
										<label class="">Title </label>
											<?php echo $this->Form->text('Post.title',array("class"=>"form-control")); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label>Featured Image<span class="">*</span></label>
											<?php echo $this->Form->input('Postcoverimage.image', array('type'=>'file',"class"=>"file", "data-max-file-count"=>"1", "label"=>false)); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label class="">Body</label>
											<?php echo $this->Form->textarea('Post.body', array("class"=>"form-control ckeditor")); ?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 form-group">
											<label class="">Tags </label>
											<?php echo $this->Form->text('Post.tags',array("class"=>"form-control")); ?>
										</div>
										
										<div class="col-md-6 form-group">
											Tags are keywords relevent to the post. These tags will be useful to find this post to viewers. Select 2 to 4 key words which describs best to your post and separate by comma.
										</div>
									</div>
									<div class="form-group">
										<input name="" type="submit" value="Create" class="btn btn-success" />
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