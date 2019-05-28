<!--state overview start-->
<div class="row state-overview">
	<div class="col-lg-3 col-sm-6">
		<section class="panel">
			<div class="symbol terques">
				<i class="fa fa-user"></i>
			</div>
			<div class="value"><h1 class="count">0</h1><p>Buy & Sale</p></div>
		</section>
	</div>
	<div class="col-lg-3 col-sm-6">
		<section class="panel">
			<div class="symbol red">
				<i class="fa fa-flag fa-2x"></i>
			</div>
			<div class="value"><h1 class="count2">0</h1><p>Events & Shows</p></div>
		</section>
	</div>
	<div class="col-lg-3 col-sm-6">
		<section class="panel">
			<div class="symbol yellow">
				<i class="fa fa-list-ul fa-2x"></i>
			</div>
			<div class="value"><h1 class="count3">0</h1><p>General knowledge</p></div>
		</section>
	</div>
	<div class="col-lg-3 col-sm-6">
		<section class="panel">
			<div class="symbol blue">
				<i class="fa fa-bar-chart-o"></i>
			</div>
			<div class="value"><h1 class="count4">0</h1><p>Science & Tech</p></div>
		</section>
	</div>
</div>
<!--state overview end-->
<script>
	var appBuynsalecount = <?php echo $appBuynsalecount; ?>;
	var appEventsnshowcount = <?php echo $appEventsnshowcount; ?>;
	var appGenknowledgecount = <?php echo $appGenknowledgecount; ?>;
	var appScintechcount = <?php echo $appScintechcount; ?>;
</script>
<?php echo $this->Html->script('adminjs/count'); ?>