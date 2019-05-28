<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<aside class="col-md-4">
	<?php echo $this->element('blog_sidebar'); ?>
</aside>

<h1 class="col-md-8">Update a Post</h1>
<section class="col-md-8">
	<div class="col-right">		
		<div class="posts form">
		<?php echo $this->Form->create('Post',array("controller"=>"posts","action"=>"add")); ?>			
			<div class="row">						
				<div class="col-md-3"><?php echo $this->Form->input('Post.title',array("type"=>"text","class"=>"span6 ie7-margin")); ?>
					<?php echo $this->Form->error('Post.title'); ?></div>
			</div>			
			<div class="row">
				<div class="col-md-3"><?php echo $this->Form->input('Post.body',array("type"=>"textarea","class"=>"span6 ie7-margin ckeditor"));?>
					<?php echo $this->Form->error('Post.body'); ?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><?php echo $this->Form->hidden('Post.user_id',array("value"=>$user_id, "type"=>"text", "class"=>"span6 ie7-margin"));?>
					<?php echo $this->Form->error('Post.user_id'); ?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><?php echo $this->Form->submit('Submit',array("class"=>"button_medium")); ?></div>
			</div>
			
		<?php echo $this->Form->end(); ?>
		</div>
			
	</div>
</section>
<script type="text/javascript">
CKEDITOR.replace( 'PostBody', {
toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],[ 'NumberedList','BulletedList' ],[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ]],
width: '700',
height: '300',
});
</script>