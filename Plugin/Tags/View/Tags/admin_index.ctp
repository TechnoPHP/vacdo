<?php echo $this->element("admin/admin_sidebar"); ?>	
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
			<!--breadcrumbs start -->
				<div class=""><?php echo $this->Session->flash(); ?> </div>
				<ul class="breadcrumb">
					<li><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"users","action"=>"dashboard","admin"=>true),array("escape"=>false)); ?></li>
					<li><a href="#">Tags</a></li>
					<li class="active">List</li>
				</ul>
				<!--breadcrumbs end -->
				<section class="panel">
					<header class="panel-heading">List of Tags<div class="pull-right">Tags are being populated as author assigne them with the post.</div></header>
					<div class="panel-body">
						<section id="unseen">
							<table class="table table-bordered table-striped table-condensed">
								<thead>
								<tr>
									<th width="10%"><?php echo $this->Paginator->sort('id');?></th>
									<th width="35%"><?php echo $this->Paginator->sort('name');?></th>
									<th width="35%"><?php echo $this->Paginator->sort('keyname');?></th>					
									<th width="15%" class="actions"><?php echo __d('tags', 'Actions');?></th>
								</tr>
								</thead>
								<tbody>
							<?php
							$i = 0;
							foreach ($tags as $tag):
								$class = null;
								if ($i++ % 2 == 0) {
									$class = ' class="altrow"';
								}
							?>
								<tr<?php echo $class;?>>
									<td>
										<?php echo $tag['Tag']['id']; ?>
									</td>
									
									<td>
										<?php echo $tag['Tag']['name']; ?>
									</td>
									<td>
										<?php echo $tag['Tag']['keyname']; ?>
									</td>
									
									<td class="actions">
										<?php echo $this->Html->link(__d('tags', 'View'), array('action' => 'view', $tag['Tag']['keyname']),array('class'=>'btn btn-success btn-xs')); ?>
										<?php echo $this->Html->link(__d('tags', 'Edit'), array('action' => 'edit', $tag['Tag']['id']),array('class'=>'btn btn-info btn-xs')); ?>
										<?php echo $this->Html->link(__d('tags', 'Delete'), array('action' => 'delete', $tag['Tag']['id']), array('class'=>'btn btn-danger btn-xs'), sprintf(__d('tags', 'Are you sure you want to delete # %s?'), $tag['Tag']['id'])); ?>
									</td>
								</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</section> <!-- unseen -->
						<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div><!--/#content-->
				</section><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>