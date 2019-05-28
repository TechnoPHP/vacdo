<?php echo $this->element("admin/admin_sidebar"); ?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Package</h4></div>
		</div>
		<?php echo $this->Session->flash('auth');?>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Create new travel agency</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<?php echo $this->Form->create('Travelagency', array("url"=>array("plugin"=>"tagents","controller"=>"agencies","action"=>"create","admin"=>true),"role"=>"form","class"=>""));?>
							<div class="row">
								<div class="col-md-12 form-group">
									<?php echo $this->Form->text('Travelagency.name',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Travel agency name")); ?>
									<?php echo $this->Form->error('Travelagency.name'); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<?php echo $this->Form->textarea('Travelagency.description',array("rows"=>"4","class"=>"form-control ie7-margin","placeholder"=>"Something about agency")); ?>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<?php echo $this->Form->text('Travelagency.phone',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Work phone")); ?>
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
								<div class="col-md-6">
								<label>
								<?php echo $this->Form->checkbox('Travelagency.active',array()); ?>&nbsp;Make it active</label>
								</div>
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary">Create New Travel agency</button>
								</div>
							</div>
							<?php echo $this->Form->end(); ?>
						

						</div><!--card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->
<script>
$("select#UserCountryId").change(function()
	  {
		  $("select#UserRegionId").html("<option value=''>Loading...</option>");
		  
		    $.getJSON("http://<?php echo $_SERVER['SERVER_NAME']; ?>/acldemo/"+"regions/getregions/"+$(this).val(),{ajax: 'true'}, function(objData){
		      var options = '<option value="">--- Choose Region ---</option>';
		      if(objData!=null)
		      {
			      $.each(objData, function(i,item){
			    	  
			          options += '<option value="' +i+ '">' +item + '</option>';
			          
			        });
		      }
		      $("select#UserRegionId").html(options);
		    });
	  });
</script>