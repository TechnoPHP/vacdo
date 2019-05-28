<div class="contain">  
      <h1  class="page_title">Articles pubhlised<span class="hilight_text">Collaborate, Communicate & Connect</span></h1>
	<div class="content_box">
		<div class="row">
			<?php foreach ($posts as $post){ //pr($post);?>
			<div class="col-md-6">
				<artical>
					<div class="artical_box">
						<div class="artical_thum">
							<?php 
							if(!empty($post['Postcoverimage']['namemedium'])){
							echo $this->Html->image($post['Postcoverimage']['namemedium'], array('class'=>'img-responsive'));
							}else{
							echo $this->Html->image("php_default.jpg", array('class'=>'img-responsive'));
							}
							?>
						</div>
						<div class="artical_content">
							<P><?php echo $this->Html->link($this->Text->truncate($post['Post']['title'],70),array("controller"=>"posts","action"=>"view",'slug' => Inflector::slug($post['Post']['title'],'-'),'id'=>$post['Post']['id'])); ?></P>
							<div class="artical_thum_date"> 
								<?php echo $this->Time->nicedate($post['Post']['modified']); ?> 
							</div>
							<div class="comment">
								<span aria-hidden="true" class="glyphicon glyphicon-comment"></span> 
								<?php echo (count($post['Post']['comment_count'])>1)?$post['Post']['comment_count']." Comments":$post['Post']['comment_count']." Comment" ;?> 
								<span aria-hidden="true" class="glyphicon glyphicon-eye-open "></span>
								<?php echo (count($post['Post']['postview_count'])>1)?$post['Post']['comment_count']." Comments":$post['Post']['postview_count']." Postviews" ;?>
							</div>
							<div class="star">
								<?php echo $this->Ratings->display_for($post); ?>
							</div>
							<?php echo $this->Html->link("Read More",array("controller"=>"posts","action"=>"view",'slug' => Inflector::slug($post['Post']['title'],'-'),'id'=>$post['Post']['id']),array("class"=>"read_more")); ?></a> 
						</div><!-- artical content -->
					</div><!-- artical_box -->
				</artical>
			</div>
			<?php } ?>
		</div>
	</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<ul class="pagination">
		<?php $this->Paginator->options(array('url'=>array('controller'=> 'posts','action'=>'filter','category'=>$this->params['category'],
		'postcategoryid'=>$this->params['postcategoryid'])));
			echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
			echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	</ul>
</div>
<div class="gap"></div>
<?php echo $this->fetch('script_execute'); ?>