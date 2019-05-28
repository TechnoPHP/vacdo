<?php echo $this->element("admin/admin_sidebar"); ?>
<?php echo $this->Html->css('fileinput.min');echo $this->Html->script('fileinput.min'); ?>
<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Destinations</h4></div>
		</div>
		
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5 >Latest destinations on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'destinations','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							
							<?php echo $this->Form->create('Destination', array("url"=>array("controller"=>"destinations",'action' => 'edit','admin'=>true),'type'=>'file'));?>
								<div class="row">
									<div class="col-md-4 form-group">
									<label class="">Country </label>
										<?php echo $this->Form->select('Destination.country',$appdestinationcountry,array("class"=>"form-control","empty"=>"--Select Country--")); ?>
									</div>
									<div class="col-md-8 form-group">
									<label class="">Dastination name </label>
										<?php echo $this->Form->text('Destination.name',array("class"=>"form-control")); echo $this->Form->hidden('Destination.id');?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2 form-group">
										<label>Destination Image<span class="">*</span></label>
										<?php 
										if(!empty($this->request->data['Destination']['imagename'])){
											echo $this->Html->image($this->request->data['Destination']['imagename'],array('class'=>'img-fluid')); ?>
										<?php } ?>
									</div>
									<div class="col-md-8 form-group">
										<label>Destination Image<span class="">*</span></label>
										<?php 
										echo $this->Form->input('Destination.image', array('type'=>'file',"class"=>"file", "data-max-file-count"=>"1", "label"=>false)); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="">About destination</label>
										<?php echo $this->Form->textarea('Destination.about', array("class"=>"form-control ckeditor")); ?>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 form-group">
										<label class="">Tags </label>
										<?php echo $this->Form->text('Destination.tags',array("class"=>"form-control")); ?>
									</div>
									
									<div class="col-md-6 form-group">
										Tags are keywords relevent to the post. These tags will be useful to find this post to viewers. Select 2 to 4 key words which describs best to your post and separate by comma.
									</div>
								</div>
								<div class="form-group">
									<input name="" type="submit" value="Create" class="btn btn-success" />
								</div>									
							<?php echo $this->Form->end(); ?>
									
						</div><!--card-block-->
					</div><!--card-->
				</div><!--col-md-12 -->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->
<script type="text/javascript">
CKEDITOR.replace( 'DestinationAbout', {
toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],[ 'NumberedList','BulletedList' ],[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ]],
width: '',
height: '300',
});</script>
<script>$("#DestinationImage").fileinput({showUpload: false, maxFileCount: 10, mainClass: "input-group-lg"});</script>