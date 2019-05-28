<?php echo $this->element('admin/admin_sidebar');?>	
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">Account Details Of <?php echo $user['User']['firstname'].'&nbsp;&nbsp;'.$user['User']['lastname'];?> <div class="pull-right"><?php echo $this->Html->link("Add New", array("controller"=>"users","action"=>"create","admin"=>true)); ?></div></header>
					<div><?php echo $this->Session->flash(); ?> </div>
					<div class="row">
						<div class="col-md-6">						
							<div class="panel-body">
								<p><label>Name </label><?php echo $user['User']['firstname'].'&nbsp;&nbsp;'.$user['User']['lastname'];?></p>
								
								<p><label>Group </label><?php echo $user['Group']['name']; ?></p>
								<p><label>Email </label><?php echo $user['User']['email_address'];?></p>
								<p><label>Registered on </label><?php echo $user['User']['created'];?></p>
								<p><label>Status </label><?php echo ($user['User']['active']=='1')? "Active":"Disable";?></p>
								<p><label>Last LoggedIn </label><?php echo $user['User']['lastlogin'];?></p>
							</div>
						</div>
					</div>				
				</section>		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>