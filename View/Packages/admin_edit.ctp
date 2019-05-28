<?php echo $this->element("admin/admin_sidebar"); ?>
<style>
.checkbox{display:inline-block;margin-right:6px;}
.checkbox label{margin:3px;4px;}
</style>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		
		<div class="page-header">
			<div class="page-header-title"><h4>Packages</h4></div>
		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5>Packages on vacdo</h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'packages','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
											
						<div class="card-body">
							<?php echo $this->Form->create('Package', array("url"=>array("plugin"=>"","controller"=>"packages","action"=>"edit","admin"=>true),"role"=>"form","class"=>""));?>
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12 form-group">
											<?php echo $this->Form->text('Package.title',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Package title")); echo $this->Form->hidden('Package.id');?>
											<?php echo $this->Form->error('Package.title'); ?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 form-group">
											<?php echo $this->Form->text('Package.numberofdays',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Number of days")); ?>
										</div>
										<div class="col-md-6 form-group">
											<?php echo $this->Form->text('Package.numberofnights',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Number of nights")); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<?php echo $this->Form->text('Package.price',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Price of the package")); ?>
										</div>
										<div class="col-md-3 form-group">
											<?php echo $this->Form->text('Package.discount',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Discount")); ?>
										</div>
										<div class="col-md-3 form-group">
											<?php $discounttype = array("PC"=>"Percentage","FT"=>"Flat");
											echo $this->Form->select('Package.discounttype',$discounttype,array("class"=>"form-control ie7-margin","empty"=>"Type")); ?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 form-group">
										<label class="mb-2 font-weight-bold">Assign suitable package type</label>
											<?php echo $this->Form->input('Packagetype', array('multiple'=>'checkbox', 'label'=>false, 'type'=>'select','separator'=>'&nbsp;','options'=>$apppackagetypes)); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label class="mb-2 font-weight-bold">Assign suitable Holiday themes</label>
											<?php echo $this->Form->input('Holidaytheme', array('multiple'=>'checkbox', 'label'=>false, 'type'=>'select','separator'=>'&nbsp;','options'=>$appholidaythemes)); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<label class="font-weight-bold">
										<?php echo $this->Form->checkbox('Package.active',array()); ?>&nbsp;Make it active</label>
										</div>
										<div class="col-md-6">
											<button type="submit" class="btn btn-primary">Update Package</button>
										</div>
									</div>
								</div><!--col-md-6-->
								
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12 form-group">
											<?php echo $this->Form->textarea('Package.description',array("rows"=>"4","class"=>"form-control ie7-margin","placeholder"=>"Describe about package")); ?>
											
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<?php echo $this->Form->textarea('Package.inclusions',array("rows"=>"4","class"=>"form-control ie7-margin","placeholder"=>"Mention what is included in this package")); ?>									
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<?php echo $this->Form->textarea('Package.exclusions',array("rows"=>"4","class"=>"form-control ie7-margin","placeholder"=>"Mention what is NOT included in this package")); ?>
										</div>
									</div>							
								</div>
								<?php echo $this->Form->end(); ?>
							
							</div><!--row-->
						
						
						</div><!-- card- body-->                
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