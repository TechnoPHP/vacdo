<?php echo $this->element('admin/admin_sidebar');?>
<style>.popover {max-width:500px; border: solid 1px #ccc;}</style>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!--breadcrumbs start -->
				<div class=""><?php echo $this->Session->flash(); ?> </div>
				<ul class="breadcrumb">
					<li><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"users","action"=>"dashboard","admin"=>true),array("escape"=>false)); ?></li>
					<li><a href="#">Comments</a></li>
					<li class="active">List</li>
				</ul>
				<!--breadcrumbs end -->			
				<section class="panel">
					<header class="panel-heading">
					List of Comments
					<div class="pull-right">
						<?php echo $this->Html->link("Add New", array("controller"=>"#","action"=>"#","admin"=>true)); ?>
					</div>
					</header>					
					<div class="panel-body">
						<section id="unseen">
							<table class="table table-bordered table-striped table-condensed">
								<thead>
								<tr>
									<th width="5%">Active</th>
									<th width="60%">Comment</th>
									<th width="11%">Date</th>
									<th width="15%">Action</th>
								</tr>
								</thead>							
								<tbody>
								<?php //pr($comments); 
								foreach($comments as $comment){?>					
									<tr>
									<td><?php echo ($comment['Comment']['active'])?"Yes":"No"; ?></td>
										<td><?php echo $this->Html->link($this->Text->truncate($comment['Comment']['message'],150),'#',array("data-toggle"=>"popover", "data-placement"=>"top", "title"=>"Full Comment","data-content"=>$comment['Comment']['message'])); ?></td>
										<td><?php echo $this->Time->nicedate($comment['Comment']['modified']); ?></td>
										<td>
										<?php echo $this->Html->link("View",array("controller"=>"comments","action"=>"view/".$comment['Comment']['id'],"admin"=>true),array('class'=>'btn btn-success btn-xs')); ?> 
										<?php echo $this->Html->link("Edit",array("controller"=>"comments","action"=>"edit/".$comment['Comment']['id'],"admin"=>true),array('class'=>'btn btn-info btn-xs'));?> 
										<?php echo $this->Form->postLink ("Delete",array("controller"=>"comments","action"=>"delete/".$comment['Comment']['id'],"admin"=>true),array('class'=>'btn btn-danger btn-xs'),"Are you sure you want to delete?"); ?>
										</td>
									</tr>
								<?php }	?>
								</tbody>
							</table>						
						</section> <!-- unseen -->
						<p>
						<?php
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));
						?></p>
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
<script>$(function () { $("[data-toggle='popover']").popover({ trigger: "hover focus" }); });</script>