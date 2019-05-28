<?php $this->assign('title','Searched articles');  ?>
<div class="contain">
	<div class="row">		
		<?php echo $this->Form->create("",array('url'=>array('controller'=>'posts','action'=>'searchfull','admin'=>false),array('class'=>'form-inline'))); ?>
		<div class="col-md-3 form-group">
		<?php echo $this->Form->text('Post.fullsearch',array("type"=>"text","class"=>"col-md-12 form-control")); ?>
		
		</div><?php echo $this->Form->submit('Search',array('class'=>'btn btn-default'));?>
		<?php echo $this->Form->end(); ?>
	</div>

      <h1 class="page_title">Searched Articles<span class="hilight_text">Collaborate, Communicate & Connect</span></h1>
	<div class="content_box">
		<div class="row">
			<?php foreach ($posts as $post){ //pr($post);?>
			<div class="col-md-6">
				<artical>
					<div class="">
						
						<div class="">
							<P><?php echo $this->Html->link($this->Text->truncate($post['Fulltextpost']['title'],70),array("controller"=>"posts","action"=>"view",'slug' => Inflector::slug($post['Fulltextpost']['title'],'-'),'id'=>$post['Fulltextpost']['id'])); ?></P>
							<P><?php echo $this->Text->truncate($post['Fulltextpost']['body'],150); ?></P>
							
							
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