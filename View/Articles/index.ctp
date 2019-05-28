<?php $this->assign('title','Articles');  ?>
<div class="container">
	<div class="row">
		<div class="col-md-3 form-group">
			<?php echo $this->Form->create("",array('url'=>array('controller'=>'posts','action'=>'searchfull','admin'=>false),array('class'=>'form-inline'))); ?>
			<?php echo $this->Form->text('Article.fullsearch',array("type"=>"text","class"=>"col-md-12 form-control")); ?></div>
			<?php echo $this->Form->submit('Search',array('class'=>'btn btn-default'));?>
			<?php echo $this->Form->end(); ?>
		
		<div class="col-md-8">
		</div>
	</div>
      <h1 class="page_title">Articles pubhlised</h1>
	<div class="content_box">
		<div class="row">
			<?php foreach ($posts as $post){ //pr($post);?>
			<div class="col-md-6">
				<artical>
					<div class="artical_box">
						<div class="artical_thum">
							<?php 
							if(!empty($post['Articlecoverimage']['namemedium'])){
							echo $this->Html->image($post['Articlecoverimage']['namesmall'], array('class'=>'img-fluid'));
							}else{
							echo $this->Html->image("php_default.jpg", array('class'=>'img-fluid'));
							}
							?>
						</div>
						<div class="artical_content">
							<P><?php echo $this->Html->link($this->Text->truncate($post['Article']['title'],70),array("controller"=>"articles","action"=>"view",'slug' => Inflector::slug($post['Article']['title'],'-'),'id'=>$post['Article']['id'])); ?></P>
							<div class="artical_thum_date"> 
								<?php echo $this->Time->niceShort($post['Article']['created']); ?> 
							</div>
							<div class="comment">
								<span aria-hidden="true" class="glyphicon glyphicon-comment"></span> 
								<?php echo (count($post['Article']['comment_count'])>1)?$post['Article']['comment_count']." Comments":$post['Article']['comment_count']." Comment" ;?> 
								<span aria-hidden="true" class="glyphicon glyphicon-eye-open "></span>
								<?php echo (count($post['Article']['articleview_count'])>1)?$post['Article']['comment_count']." Comments":$post['Article']['articleview_count']." Postviews" ;?>
							</div>
							<div class="star">
								<?php echo $this->Ratings->display_for($post); ?>
							</div>
							<?php echo $this->Html->link("Read More",array("controller"=>"articles","action"=>"view",'slug' => Inflector::slug($post['Article']['title'],'-'),'id'=>$post['Article']['id']),array("class"=>"read_more")); ?></a> 
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
		<?php $this->Paginator->options(array('url'=>array('controller'=> 'articles','action'=>'index')));
			echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
			echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	</ul>
</div>
<div class="gap"></div>
<?php echo $this->fetch('script_execute'); ?>