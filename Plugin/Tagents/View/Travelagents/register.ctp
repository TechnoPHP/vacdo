<?php echo $this->Html->script('Tagents.typeahead',false); ?>
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<div class=""><?php echo $this->Session->flash();?></div>
			<div class="card">
				<h3 class="card-header">Sign up</h3>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 form-group">
							<lable><strong>About Travel Agency</strong>&nbsp;&nbsp;<small>Provide information about your travel agency</small></lable>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->create('',array("url"=>array("plugin"=>"tagents","controller"=>"travelagents","action"=>"register"), "role"=>"form", "id"=>"register-form")); ?>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->text('Travelagency.name',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Travel agency name")); ?>
										<?php echo $this->Form->error('Travelagency.name'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.phone',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Business contact number")); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.email',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Buisness email id")); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.city',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"City")); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.region',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"State")); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->select('Travelagency.country_id',$appcountries,array("class"=>"form-control ie7-margin","empty"=>"Select country"));?>
										<?php echo $this->Form->error('Travelagency.country_id'); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.zipcode',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Zipcode"));?>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php $options = array("<5"=>"less than 5","5-10"=>"between 5 to 10","10-15"=>"between 10 to 15","15>"=>"more than 15");
										echo $this->Form->select('Travelagency.teamsize',$options,array("class"=>"form-control ie7-margin","empty"=>"Agency team size"));?>
										<?php echo $this->Form->error('Travelagency.country_id'); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagency.website',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Website if any"));?>
										
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 form-group">
										<lable><strong>Agency Owner</strong>&nbsp;&nbsp;<small>Provide information of owner of travel agency</small></lable>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.firstname',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"First name")); ?>
										<?php echo $this->Form->error('Travelagent.firstname'); ?>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.lastname',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Last name")); ?>
									</div>						
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.email_address',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Email address"));?>
										<?php echo $this->Form->error('Travelagent.email_address'); ?>
										<small>Your email address will be your login name</small>
									</div>
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.phone',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Contact number"));?>
										<?php echo $this->Form->error('Travelagent.phone'); ?>
										<small>You can mention you business contact number</small>
									</div>
								</div>
								<div class="row">						
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.password',array("type"=>"password","class"=>"form-control ie7-margin","placeholder"=>"Password"));
										echo $this->Form->error('Travelagent.password'); ?>
									</div>						
									<div class="col-md-6 form-group">
										<?php echo $this->Form->text('Travelagent.confirm_password',array("type"=>"password","class"=>"form-control ie7-margin","placeholder"=>"Retype password")); 
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
								<div class="row">								
									
										<div class="col-md-4">
											<input type="submit" tabindex="" class="form-group btn btn-block btn-outline-info" value="Register Now">											
										</div>
										<div class="col-md-7">Already registered? 
										<?php echo $this->Html->link("Login here", array(),array("class"=>"")); ?>
										</div>
									
								</div>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
			</div><!--pannel-login -->
		</div><!--inner_pages -->
		<div class="col-md-4 col-sm-6">
			<p>* Provide basic information about your travel agency and contact person of the agency; mostly the owner of the agency or manager of the operations.</p>
			<p>* Once you submit the form, it will create an agency in the system with basic information and an agency contact person will get the email confirmation link.</p>
			<p>* After confirming the email link receieved in the email, the contact person may login and update/provide more information about the agency and himself.</p>
			<p>* The contact person may also get the verification call to check the registration is not done by mistake and he is intended to do aliance with VacDo.in.</p>
		</div>
	</div> <!--row-->
</div> <!-- container -->
<script>
    $(document).ready(function () {
        $('#TravelagencyName').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "/vacdo/tagents/travelagencies/agencylist.json",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item.Travelagency.name;
							
                        }));
                    }
                });
            }
        });
    });
</script>