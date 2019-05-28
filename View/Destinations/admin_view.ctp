<?php echo $this->element("admin/admin_sidebar"); ?>
<!--main content start-->
<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title"><h4>Destinations</h4></div>
		</div>
		
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5><?php echo $destination['Destination']['name'].', '.$destination['Destination']['country'];?></h5>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'destinations','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<label class="">About </label>
									<span class="float-left col-md-2"><?php 
									echo $this->Html->image($destination['Destination']['imagename'],array('class'=>'img-fluid','alt'=>$destination['Destination']['name']));?></span>
									<?php echo $destination['Destination']['about']; ?>
								</div>
							</div>							
						</div><!--card-block-->
					</div><!--card-->
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									<label class="">Tags : </label>
									<?php 
									foreach($destination['Tag'] as $tag){
										echo  $tag['name'].', ';
									}
									?>
								</div>
								
							</div>
						</div>
						
					</div><!--card-->
				</div><!--col-md-12 -->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->