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
					<li><a href="#">Postcategories</a></li>
					<li class="active">List</li>
				</ul>
				<!--breadcrumbs end -->
				<section class="panel">
					<header class="panel-heading">List of Postcategories<div class="pull-right"><?php echo $this->Html->link("Back to list", array("controller"=>"postcategories","action"=>"index","admin"=>true)); ?></div></header>
					<div class="panel-body">
					<div class="postcategories view">

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Postcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postcategory['ParentPostcategory']['name'], array('controller' => 'postcategories', 'action' => 'view', $postcategory['ParentPostcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo ($postcategory['Postcategory']['active']?"Yes":"No"); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($postcategory['Postcategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
					</div>
				</section><!-- panel -->
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>
