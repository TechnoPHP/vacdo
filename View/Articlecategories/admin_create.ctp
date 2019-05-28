<?php echo $this->element("admin/admin_sidebar"); ?>
	
<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<div class="main-body">
	<div class="page-wrapper">
		
		<div class="page-header">
			<div class="page-header-title"><h4>Article categories</h4></div>
		</div>
		
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5 >Latest Article categories on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'articlecategories','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<?php echo $this->Form->create('Articlecategory', array("url"=>array("controller"=>"articlecategories",'action' => 'create','admin'=>true)));	?>
							
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
										<label for="parentcategoryname">Parent Category</label>
											<?php echo $this->Form->select('Articlecategory.parent_id',$parent,array("class"=>"form-control","empty"=>"Select Parent Category")); ?>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
										<label for="categoryname">Category Name</label>
											<?php echo $this->Form->text('Articlecategory.name',array("class"=>"form-control","placeholder"=>"Category Name")); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="checkbox">
											<label>
											<?php echo $this->Form->checkbox('Articlecategory.active',array()); ?>Make it active</label>
										</div>
									</div>
								
									<div class="col-md-3">
										<div class="form-group">
										<input name="" type="submit" value="Create" class="btn btn-success" />
									</div>
								</div>
							<?php echo $this->Form->end(); ?>							
							</div>
						</div><!--card-block-->
					</div><!--card-->
				</div><!--col-md-12 -->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->