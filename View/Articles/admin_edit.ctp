<?php echo $this->element("admin/admin_sidebar"); ?>
	<?php echo $this->Html->css('fileinput.min');echo $this->Html->script('fileinput.min'); ?>
<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class=""><?php echo $this->Session->flash(); ?> </div>
				<section class="panel">
					<header class="panel-heading">
					Update Article<div class="pull-right"><?php echo $this->Html->link("Back to list", array("controller"=>"articles","action"=>"index","admin"=>true)); ?></div>
					</header>					
					<div class="row">
						<div class="col-md-12">						
							<div class="panel-body">
								<?php echo $this->Form->create('Article', array("url"=>array("controller"=>"articles",'action' => 'edit','admin'=>true),'type'=>'file'));?>
									<div class="row">
										<div class="col-md-4 form-group">
										<label class="">Category </label>
											<?php echo $this->Form->select('Article.articlecategory_id',$parent,array("class"=>"form-control","empty"=>"--Select Category--")); ?>
										</div>
										<div class="col-md-8 form-group">
										<label class="">Title </label>
											<?php echo $this->Form->text('Article.title',array("class"=>"form-control")); echo $this->Form->hidden('Article.id');?>
										</div>
										
									</div>
									<div class="row">									
										<div class="col-md-4 form-group">
											<?php echo $this->Html->image($featured_image,array('class'=>'img-responsive'));echo $this->Form->hidden('Postcoverimage.id',array());
											?>
										</div>
										<div class="col-md-8 form-group">
											<label>Featured Image<span class="">*</span></label>
											<?php echo $this->Form->input('Articlecoverimage.image', array('type'=>'file',"class"=>"file", "data-max-file-count"=>"1", "label"=>false,'required'=>false)); ?>
										</div>
									</div>
									<div class="row">									
										<div class="col-md-12 form-group">
											<label class="">Description</label>
											<?php echo $this->Form->textarea('Article.body',array("class"=>"form-control ckeditor")); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label class="">Tags </label>
											<?php echo $this->Form->text('Article.tags', array("class"=>"form-control")); ?>
										</div>
										
										<div class="col-md-6 form-group">
											Tags are keywords relevent to the Article. These tags will be useful to find this Article to viewers. Select 2 to 4 key words which describs best to your Article and separate by comma.
										</div>
									</div>
									<div class="form-group">
										<input name="" type="submit" value="Update" class="btn btn-success" />
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
<script type="text/javascript">
CKEDITOR.replace( 'PostBody', {
toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],[ 'NumberedList','BulletedList' ],[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],[ 'Source']],
width: '',
height: '300',
});</script>
<script>$("#PostcoverimageImage").fileinput({showUpload: false, maxFileCount: 10, mainClass: "input-group-lg"});</script>