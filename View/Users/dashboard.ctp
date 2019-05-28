<div class="container p-3">
	<div class="row">
		<div class="col-md-3">
			<nav>
				<?php echo $this->element('sidebar_dashboard');?>
			</nav>
		</div>
		<div class="col-md-9">
			<h4>About <?php echo $currentuser['User']['firstname']; ?>
			<?php if($this->Session->check('Auth.User.id')){
				if($this->Session->read('Auth.User.id')==$currentuser['Profile']['user_id']){
			?>	
			<div class="float-right btn btn-light"><?php echo $this->Html->link("Update Profile", array("controller"=>"profiles","action"=>"edit/".$currentuser['Profile']['id'],"admin"=>false));?>	</div>
			<?php } }?>
			</h4><hr>
			<div class="row">
				<div class="col-md-12">			
					<p><?php //echo $currentuser['Profile']['aboutme']; ?></p>
				</div>
			</div>
		<style>
		.well{display:inline-block;-webkit-border-radius:0;width:100%}
		.btn-pref .btn {
			-webkit-border-radius:0 !important;
		}</style>
			<h4><?php echo $currentuser['User']['firstname'];?>&nbsp;has these activities
			<small class="float-right"><small>Click on the tab to see content of that category</small></small></h4>
			<hr>
			<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<button type="button" title="My Shops" id="buysell" class="btn btn-primary" href="#bs" data-toggle="tab"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
							<div class="hidden-xs">My Shops</div>
						</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" title="My Products" id="evnshow" class="btn btn-default" href="#es" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
							<div class="hidden-xs">My Products</div>
						</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" title="Orderds Received" id="jbsvan" class="btn btn-default" href="#jv" data-toggle="tab"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
							<div class="hidden-xs">Orderds Received</div>
						</button>
					</div>
					
				</div>
				
				<div class="well">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="bs">
							
							<div class="row carousel-row">
								<div class="slide-row">
									Contente goes here
								</div>
							</div><!--carousel-row-->
						
						</div> <!--tabpanel div -->
						<div role="tabpanel" class="tab-pane fade in" id="es">				
							
							<div class="row carousel-row">
								<div class="slide-row">
								Contente goes here
								</div>
							</div>
									
						</div> <!-- tabpanel div -->
						<div role="tabpanel" class="tab-pane fade in" id="jv">		
							<div class="row carousel-row">
								<div class="slide-row">
									Contente goes here
								</div>
							</div>
						</div> <!--tabpanel div -->
						<div role="tabpanel" class="tab-pane fade in" id="hc">		
							<div class="row carousel-row">
								<div class="slide-row">
									Contente goes here
								</div>
							</div>					
						</div> <!--tabpanel div -->
						
						<div role="tabpanel" class="tab-pane" id="sci">
							<div class="row carousel-row">
								<div class="slide-row">Contente goes here
								</div>
							</div>					
						</div> <!-- tab div -->
						
						<div role="tabpanel" class="tab-pane" id="fdr">
							<div class="row carousel-row">
								<div class="slide-row">
								Contente goes here
								</div>
							</div>
						</div>
					</div><!-- tab-content -->
				</div><!-- well -->

		</div><!--end of col-md-9-->
	</div><!--row-->
</div><!--bg-white-->

<?php echo $this->fetch('script_execute'); ?>

<script>
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});</script>