<!--main content start-->
<style>
.checkbox input{
  margin: 0 5px 0 0px;
}
</style>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><h6>Create New Package<?php echo $this->Html->link("Back to list", array("controller"=>"packages","action"=>"index","admin"=>false),array("class"=>"btn btn-sm btn-outline-info float-right")); ?></h6>
					</div>
					<div class="row">
						<div class="col-md-6">						
							<div class="card-body">
								<?php echo $this->Form->create('Package', array("url"=>array("plugin"=>"tagents","controller"=>"packages","action"=>"create","admin"=>false),"role"=>"form","class"=>""));?>
								
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->text('Package.title',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Package title")); ?>
										<?php echo $this->Form->error('Package.title'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->textarea('Package.description',array("rows"=>"4","class"=>"form-control ie7-margin","placeholder"=>"Describe about package")); ?>
										
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
										<?php echo $this->Form->text('Agency.discount',array("type"=>"text","class"=>"form-control ie7-margin","placeholder"=>"Discount")); ?>
									</div>
									<div class="col-md-3 form-group">
										<?php $discounttype = array("PC"=>"Percentage","FT"=>"Flat");
										echo $this->Form->select('Agency.discounttype',$discounttype,array("class"=>"form-control ie7-margin","empty"=>"Type")); ?>
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
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->input('Packagetype', array('multiple'=>'checkbox', 'label'=>false, 'type'=>'select','separator'=>'&nbsp;','options'=>$apppackagetypes,'before' => '<label>Assign suitable package types</lablel>')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<?php echo $this->Form->input('Holidaytheme', array('multiple'=>'checkbox', 'label'=>false, 'type'=>'select','separator'=>'&nbsp;','options'=>$appholidaythemes,'before' => '<label>Assign suitable Holiday themes</lablel>')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<label>
									<?php echo $this->Form->checkbox('Package.active',array()); ?>&nbsp;Make it active</label>
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary">Create New Package</button>
									</div>
								</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
						<div class="col-md-6">
						
							
						</div>
					</div>
                </div>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</div>

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