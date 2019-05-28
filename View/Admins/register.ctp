<div class="container">
	<div class="row">
		<div class="col-md-7">
			<div class=""><?php echo $this->Session->flash();?></div>
			<div class="panel">
				<div class="panel-heading">
					<div class="">Sign up</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 form-group">
							<lable><strong>About Agency</strong>&nbsp;&nbsp;<small>Provide information about your agency</small></lable>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->create('',array("url"=>array("plugin"=>"tagents","controller"=>"aagents","action"=>"register"), "role"=>"form", "id"=>"register-form")); ?>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->text('Agency.name',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Agency name")); ?>
										<?php echo $this->Form->error('Agency.name'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Agency.city',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"City")); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Agency.region',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"State")); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->select('Agency.country_id',$appcountries,array("class"=>"form-control ie7-margin","empty"=>"Select country"));?>
										<?php echo $this->Form->error('Agency.country_id'); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Agency.zipcode',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Zipcode"));?>
										
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 form-group">
										<lable><strong>Contact person</strong>&nbsp;&nbsp;<small>Provide information about contact person at your agency</small></lable>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.firstname',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"First name")); ?>
										<?php echo $this->Form->error('Aagent.firstname'); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.lastname',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Last name")); ?>
									</div>						
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.email_address',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Email address"));?>
										<?php echo $this->Form->error('Aagent.email_address'); ?>
										<small>Your email address will be your login name</small>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.phone',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Contact number"));?>
										<?php echo $this->Form->error('Aagent.phone'); ?>
									</div>
								</div>
								<div class="row">						
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.password',array("type"=>"password","class"=>"form-control ie7-margin","placeholder"=>"Password"));
										echo $this->Form->error('Aagent.password'); ?>
									</div>						
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Aagent.confirm_password',array("type"=>"password","class"=>"form-control ie7-margin","placeholder"=>"Retype password")); 
										echo $this->Form->error('confirm_password'); ?> 
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 form-group">
										<lable><strong>Validate you are human</strong>&nbsp;&nbsp;<small>Fill answer in the textbox</small></lable>
									</div>
								</div>
								<div class="row">				
									<?php $this->Captcha->render(array('type'=>'math','width'=>'188', 'clabel'=>'Enter captcha code','mlabel'=>'Answer simple maths', 'reload_txt'=>'Reload Captcha')); ?>				
								</div>
								
								<div class="">
									<div class="col-md-12 alert alert-info terms">
										By creating an account you confirm the acceptance of <?php echo $this->Html->link('Terms of Use',array("plugin"=>false,"controller"=>"pages","action"=>"terms"),array("class"=>"alert-link"));?>&nbsp;and&nbsp;<?php echo $this->Html->link('Privacy Policy',array("plugin"=>false,"controller"=>"pages","action"=>"privacypolicies"),array("class"=>"alert-link"));?>.
									</div>
								</div>			
								<div class="form-group">
									<div class="">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
										</div>
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