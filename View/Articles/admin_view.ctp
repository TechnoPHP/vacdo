<?php echo $this->element("admin/admin_sidebar"); ?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">				
				<section class="panel">
					<header class="panel-heading">
						<strong><?php echo $post['Article']['title'];?></strong>
						<div class="pull-right">
							<?php echo $this->Html->link('Back to list', array('controller'=>'articles','action'=>'index','admin'=>true)); ?>
						</div>
						<div>
							<?php $total = count($treePath);
							echo '<ul id="category-breadcrumbs" class="postbreadcrumb breadcrumb">';
							echo '<li>';
							echo $this->Html->link('All', array('controller'=>'articles','action'=>'index','articlecategory_id' => '','admin'=>true));
							echo '</li>';
							foreach ($treePath as $key => $treeCategory) {
								if (!$treeCategory['Articlecategory']['active']) {
									continue;
								}
								echo '<li>';
								if ($total === $key + 1) {
									echo h($treeCategory['Articlecategory']['name']);
								} else {
									echo $this->Html->link($treeCategory['Articlecategory']['name'], array('controller'=>'articles','action'=>'index', $treeCategory['Articlecategory']['id'],'admin'=>true));
								}
								echo '</li>';
							}
							echo '</ul>';
							?>
						</div>
					</header>					
					<div class="panel-body">	
						<?php echo preg_replace("/<img /","<img class='img-responsive' ",$post['Article']['body']);?>		
						<hr/>
						<h4><?php echo count($post['Comment']);?>&nbsp;Comments</h4>
						<div id="comments">						
							<?php 
								$options = array('model'=>'Comment','alias'=>'message','element' => 'adminnodecomment', 'class' => 'commentlist','type' => 'ul','itemType' => 'li');
								echo $this->Tree->generate($comments,$options);
							?>        
						</div><!-- End Comments -->
					</div>
				</section><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>		