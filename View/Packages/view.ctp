<?php echo $this->element('sidebar_dashboard');?>	
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">Account Details Of <?php echo $agency['Agency']['name'];?> <div class="pull-right"><?php echo $this->Html->link("Add New", array("plugin"=>"tagents","controller"=>"agencies","action"=>"create","admin"=>true)); ?></div></header>
					<div><?php echo $this->Session->flash(); ?> </div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel-body">
								<p><label>Name </label><?php echo $agency['Agency']['name'];?></p>
								
								<p><label>Name </label><?php echo $agency['Agency']['description'];?></p>
								<p><label>Registered on </label><?php echo $agency['Agency']['created'];?></p>
								<p><label>Status </label><?php echo ($agency['Agency']['active']=='1')? "Active":"Disable";?></p>
								<p><?php echo $this->Time->format('M jS, Y h:i A',$agency['Agency']['modified']); ?></p>
							</div>
						</div>
						<div class="col-md-6">
						<?php foreach($agency['Aagent'] as $agent) {?>
							<p><?php echo $agent['firstname'].'&nbsp;'.$agent['lastname'];?></p>
						<?php } ?>
						</div>
					</div>				
				</section>		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>