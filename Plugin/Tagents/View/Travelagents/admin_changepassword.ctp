<?php echo $this->element("admin/admin_sidebar"); ?>
	<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
			<div class=""><?php echo $this->Session->flash(); ?> </div>
				<ul class="breadcrumb">
					<li><?php echo $this->Html->link("<i class='fa fa-home'></i> Home",array("controller"=>"users","action"=>"dashboard","admin"=>true),array("escape"=>false)); ?></li>
					
				</ul>
				<section class="panel">
					<header class="panel-heading">
					Change Password<div class="pull-right"><?php echo $this->Html->link("Back to dashboard", array("controller"=>"users","action"=>"dashboard","admin"=>true)); ?></div>
					</header>
					<div class="row">
						<div class="col-md-6">						
							<div class="panel-body">
								<?php echo $this->Form->create('User', array("url"=>array("controller"=>"users","action"=>"changepassword","admin"=>true),"role"=>"form","class"=>""));?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<label for="currentpassword">Current Password</label>
											<?php echo $this->Form->password('User.currentpassword',array("class"=>"form-control","placeholder"=>"Current Password")); echo $this->Form->error('User.currentpassword');?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<label for="password">New Password</label>
											<?php echo $this->Form->password('User.password',array("class"=>"form-control","placeholder"=>"New Password")); echo $this->Form->error('User.password');?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<label for="confirm_password">Retype Password</label>
											<?php echo $this->Form->password('User.confirm_password',array("class"=>"form-control","placeholder"=>"Retype Password")); echo $this->Form->error('User.confirm_password');?>
										</div>
									</div>
								</div>								
								<div class="row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-success">Create</button>
									</div>
								</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
						<div class="col-md-6"> YET TO DECIDE FOR CONTENT</div>
					</div>
                </section>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>