<blockquote>
	<?php
	
	//pr($data);
	$category = $data['Comment'];
	//pr($category);exit;
	
	?>
	<h4><?php if(!empty($category['user_id'])){
			echo $this->Html->link($category['firstname'],array("controller"=>"users","action"=>"view",$category['user_id']),array('target' => '_blank'));
			}else if(!empty($category['website'])){
			echo $this->Html->link($category['firstname'],$category['website'],array('target' => '_blank'));
			}else{
			echo $category['firstname'];
			} ?><span>&nbsp;On&nbsp;<?php echo $this->Time->niceDate($category['modified']); ?></span></h4>
	<p><?php echo $category['message']; ?></p>	
		<?php if($this->Session->check("Auth.User")){?>	
		<span class="panel-title plr">
			<a class="accordion-toggle btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $category['id']; ?>">&nbsp;&nbsp;Reply&nbsp;To&nbsp;<?php echo $category['firstname']; ?></a>
		</span>
		<?php } ?>

</blockquote>

<div id="collapse<?php echo $category['id']; ?>" class="panel-collapse collapse">
	<div class="panel panel-default">
		<div class="panel-heading">Reply to <?php echo $category['firstname']; ?></div>
		<div class="panel-body">
			<?php echo $this->Form->create('Comment',array("controller"=>"comments","action"=>"create","admin"=>true)); ?>
			<div class="row">
				<div class="form-group col-md-12">
					
				<?php echo $this->Form->textarea('Comment.message',array("type"=>"textarea","class"=>"form-control ie7-margin","rows"=>4)); ?>
				<?php echo $this->Form->error('Comment.message'); ?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><?php echo $this->Form->input('Comment.post_id',array("value"=>$category['post_id'],"type"=>"hidden")); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('Comment.parent_id',array("value"=>$category['id'],"type"=>"hidden")); ?></div>						
				<div class="col-md-3">
				<?php echo $this->Form->input('Comment.user_id', array("value"=>"1", "type"=>"hidden")); ?>
				</div>
				<div class="col-md-3">
				<?php echo $this->Form->input('Comment.firstname', array("value"=>$this->Session->read('Auth.User.firstname'), "type"=>"hidden")); ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<?php echo $this->Form->submit('Submit',array("class"=>"btn btn-primary")); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div><!-- end of panel-collapse collapse -->