<aside class="col-md-4">
	<?php echo $this->element('blog_sidebar'); ?>
	
</aside>
<!-- h1 class="col-md-8">Posts
<?php 
if($this->Session->check("Auth.User")){
echo $this->Html->link("Create New Article",array("plugin"=>null,"controller"=>"articles","action"=>"create","admin"=>false),array("class"=>"btn btn-primary  pull-right"));
}
?>
</h1 -->
<section class="col-md-8">
	<div class="col-right">
		<?php //pr($posts);exit;
		foreach ($posts as $post){ ?>
			<div class="post">
				<h3><?php echo $this->Html->link($post['Article']['title'],array("controller"=>"articles","action"=>"view",'slug' => Inflector::slug($post['Article']['title'],'-'), 'id'=>$post['Post']['id'])); ?></h3>
				<div class="post_info clearfix">
					<div class="post-left">
						<ul>
							<li><i class="glyphicon glyphicon-calendar"></i>On <span><?php echo $this->Time->nicedate($post['Article']['modified']); ?>&nbsp;</li>
							
							<li><i class="glyphicon glyphicon-tags"></i>Tags 
								<?php $string = '';
								
									$string .= $this->Html->link($post['Tag']['name'], array("controller"=>"articles","action"=>"search","by"=>$post['Tag']['keyname'],"tid"=>$post['Tag']['id']),array("escape"=>false)).", ";
								 echo substr($string,0,-2); ?>
							</li>
						</ul>
					</div>
					<div class="post-right"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;<?php echo (count($post['Article']['postview_count'])>1)?$post['Article']['comment_count']." Comments":$post['Article']['postview_count']." Postviews" ;?>&nbsp;&nbsp;<i class="glyphicon glyphicon-comment"></i>&nbsp;<?php echo (count($post['Article']['comment_count'])>1)?$post['Article']['comment_count']." Comments":$post['Article']['comment_count']." Comment" ;?></div> 
				</div>
				<p><?php echo strip_tags($this->Text->truncate($post['Article']['body'],255,array('...')),'<p><a>'); ?>&nbsp;</p>
				
				<p><?php echo $this->Html->link("Read more",array("controller"=>"posts","action"=>"view",'slug' => Inflector::slug($post['Article']['title'],'-'),'id'=>$post['Article']['id']),array("class"=>"button_medium")); ?></p>	
			</div> <!-- end post -->
			<?php } ?>
			<p>
				<?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
			</p>
			<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
			</div>	   
	</div>
</section>