<?php echo $this->element("admin/admin_sidebar"); ?>
<?php //echo $this->element("admin/admin_sidebar_chat"); ?>

<div class="main-body">
	<div class="page-wrapper">
		
		<div class="page-header">
			<div class="page-header-title"><h4>Dashboard</h4></div>
		</div>
		
		<div class="page-body">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<div class="row">
						<div class="col-md-6 col-xl-6">
							<?php echo $this->element("admin/admin_dashboard_countries");?>
						</div>
						<div class="col-md-6 col-xl-6">
						<?php echo $this->element("admin/admin_dashboard_destinations");?>
						</div>
					</div><!--row -->
				</div>
			</div><!--row-->
		</div><!--page-body-->		
	</div><!--page-wrapper-->
</div><!--main-body-->
	

<?php //echo $this->element("admins/right_sidebar"); ?>