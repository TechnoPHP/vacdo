<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class=""><?php echo $this->Session->flash();?></div>
			<div class="card mb-3">
				<h3 class="card-header ">Sign in</h3>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">							
							<?php echo $this->Form->create('Tagents.Travelagent',array("url"=>array("plugin"=>"tagents","controller"=>"travelagents","action"=>"login"), "role"=>"form","id"=>"login-form")); ?>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->input('Travelagent.email_address',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Email Id","label"=>false)); ?>
										<?php echo $this->Form->error('Travelagent.email_address'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->input('Travelagent.password',array("type"=>"password","class"=>"form-control ie7-margin", "placeholder"=>"Password","label"=>false));?>
										<?php echo $this->Form->error('Travelagent.password'); ?>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-6">
										<?php echo $this->Form->submit('Log In',array("class"=>"btn btn-primary")); ?>
									</div>
									<div class="form-group text-right col-lg-6">
										<?php echo $this->Html->link("Forgot Password ?",array("plugin"=>"tagents","controller"=>"travelagents","action"=>"forgotpassword","admin"=>false),array("class"=>"text-right")); ?>
									</div>
								</div>
								<div class="">
									<div class="col-lg-12">
										<div class="text-center">Click on <?php echo $this->Html->link("Sign up",array("plugin"=>"tagents","controller"=>"travelagents","action"=>"register")); ?> if you are not yet registered agency</div>
									</div>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
			</div><!--pannel-login -->
		</div><!--inner_pages -->
		<div class="col-md-4 col-sm-6">
			
		</div>
	</div> <!--row-->
</div> <!-- container -->