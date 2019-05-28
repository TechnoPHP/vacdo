<?php echo $this->element('admin/admin_sidebar');?>	
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					
					<header class="panel-heading">Information Of <?php echo $country['Country']['name'];?> <div class="pull-right"><?php echo $this->Html->link("Back to list", array("controller"=>"countries","action"=>"index","admin"=>true)); ?></div></header>
					
					<div class="panel-body">
						<p><label>ISO-2 &nbsp;</label><?php echo $country['Country']['iso_2']; ?></p>
						
						<p><label>ISO-3 &nbsp;</label><?php echo $country['Country']['iso_3']; ?></p>
						<p><label>ISO-numeric &nbsp;</label><?php echo $country['Country']['isonumeric'];?></p>
						<p><label>ISD ph Code &nbsp;  </label><?php echo $country['Country']['phonecode'];?></p>
						<p><label>Latitude &nbsp;  </label><?php echo $country['Country']['lat'];?></p>
						<p><label>Longitude &nbsp;  </label><?php echo $country['Country']['long'];?></p>
						<p><label>Status &nbsp;  </label><?php echo ($country['Country']['active']=='1')? "Active":"Disable";?></p>
						<p><label>About &nbsp;  </label></p><p><?php echo $country['Country']['about'];?></p>
					</div>
				
				</section>	
		
			</div><!-- end of id welcome -->
		</div><!--/#content.span10-->
	</section>
</section>