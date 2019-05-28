<?php echo $this->element("admin/admin_sidebar"); ?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	  <!--state overview start-->
		<?php echo $this->element('admin/admin_dashboard_count'); ?>
		<?php //echo $this->element('admin/admin_earning_charts'); ?>
		<?php echo $this->element('admin/admin_workprogress'); ?>
		<?php //echo $this->element('admin/admin_timeline'); ?>
	</section>
</section>
<!--main content end-->
<?php echo $this->element("admin/admin_right_sidebar"); ?>