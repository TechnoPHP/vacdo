<?php echo $this->element('admin/admin_sidebar');?>	
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
									<h5><?php echo $package['Package']['title'];?></h5>
									By&nbsp;<?php echo $package['Travelagency']['name'];?>
								</div>
								<div class="col-md-2 text-right">
							<?php echo $this->Html->link("Back to list",array('plugin'=>'','controller'=>'packages','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?php echo $package['Package']['description'];?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?php echo ($package['Package']['active']==1)? "Active":"Disable";?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">Updated on
									<?php echo $this->Time->format('M jS, Y',$package['Package']['modified']); ?>
								</div>
							</div>	
								
						</div><!--card-body-->
					</div><!-- card-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->