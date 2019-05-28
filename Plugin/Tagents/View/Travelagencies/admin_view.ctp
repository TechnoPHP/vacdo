<?php echo $this->element('admin/admin_sidebar');?>	
<div class="main-body">
	<div class="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div><?php echo $this->Session->flash(); ?> </div>
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
						Account Details Of <?php echo $agency['Travelagency']['name'];?>
							</div>
							<div class="col-md-2"><?php echo $this->Html->link("Back to list",array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'index','admin'=>true),array('class'=>'btn btn-outline-info btn-sm'))?>
							</div>
						</div>
					</div>
					
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
							
								<p><?php echo $agency['Travelagency']['name'];?></p>
								
								<p><?php echo $agency['Travelagency']['description'];?></p>
								<p><?php echo $agency['Travelagency']['created'];?></p>
								<p><?php echo ($agency['Travelagency']['active']=='1')? "Active":"Disable";?></p>
								<p><?php echo $this->Time->format('M jS, Y h:i A',$agency['Travelagency']['modified']); ?></p>
							</div>
						</div>
						<div class="col-md-6">
						<?php foreach($agency['Travelagent'] as $agent) {?>
							<p><?php echo $agent['firstname'].'&nbsp;'.$agent['lastname'];?></p>
						<?php } ?>
						</div>
					</div><!--card-body-->
				</div>
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</div>
</div>