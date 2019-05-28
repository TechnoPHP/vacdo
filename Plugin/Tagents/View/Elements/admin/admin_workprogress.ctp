<div class="row">
	<div class="col-lg-6">
		<!--work progress start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in Buy & Sell</h1></div>
				<span class="pull-right"><small>Comments</small>&nbsp;|&nbsp;
				<small>Views</small></span>				
			</div>
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appBuynsale as $buynsale){?>
				<tr>
					<td><?php echo $buynsale['Buynsale']['title'];?></td>
				</tr>
				<?php } ?>
				
				</tbody>
			</table>
		</section>
	</div>
	<div class="col-lg-6">
		<!--work progress start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in Events & Shows</h1></div>
				<span class="pull-right"><small>Comments</small>&nbsp;|&nbsp;<small>Views</small></span>
			</div>
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appEventsnshow as $eventsnshow){?>
				<tr>
					<td><?php echo $this->Text->truncate($eventsnshow['Eventsnshow']['title'],155);?></td>
				</tr>
				<?php } ?>
				
				</tbody>
			</table>
		</section>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<!--user info table start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in Jobs & skills</h1></div>
				<span class="pull-right"><small>Comments</small>&nbsp;|&nbsp;<small>Views</small></span>
			</div>
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appJobsvacancy as $jobsvacancy){?>
				<tr>
					<td><?php echo $this->Text->truncate($jobsvacancy['Jobsvacancy']['title'],155);?></td>
				</tr>
				<?php } ?>				
				</tbody>
			</table>
		</section>
		<!--user info table end-->
	</div>
	<div class="col-lg-6">
		<!--user info table start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in House care services</h1></div>
				<span class="pull-right"><small>Comments</small>&nbsp;|&nbsp;<small>Views</small></span>
			</div>
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appHcservice as $hcservice){?>
				<tr>
					<td><?php echo $this->Text->truncate($hcservice['Hcservice']['title'],155);?></td>
				</tr>
				<?php } ?>				
				</tbody>
			</table>
		</section>
		<!--user info table end-->
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<!--user info table start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in Food and recipes</h1></div>
			</div>
			<div class="table-responsive">
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appfoodnrecipe as $foodnrecipe){ ?>
				<tr>
					<td><?php echo $this->Text->truncate($foodnrecipe['Foodnrecipe']['title'],155);?>
					</td>
				</tr>				
				<?php } ?>				
				</tbody>
			</table>
			</div>
		</section>
		<!--user info table end-->
	</div>
	<div class="col-lg-6">
		<!--user info table start-->
		<section class="panel">
			<div class="panel-body">
				<div class="task-progress"><h1>Latest in Science & Techno</h1></div>
			</div>
			<table class="table table-hover personal-task">
				<tbody>
				<?php foreach($appScintech as $scintech){ ?>
				<tr>
					<td><?php echo $scintech['Scintech']['title'];?></td>			
				</tr>				
				<?php } ?>				
				</tbody>
			</table>
		</section>
		<!--user info table end-->
	</div>
</div>