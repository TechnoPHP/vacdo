<div class="container">
<div class="row">
<div class="col-md-3">	
	<?php echo $this->element('Tagents.sidebar_dashboard');?>	
</div>
<div class="col-md-9">
	<h4>About <?php echo $currentuser['Travelagent']['firstname']; ?>
	<?php if($this->Session->check('Auth.Travelagent.id')){
			if($this->Session->read('Auth.Travelagent.id')==$currentuser['Travelagent']['id']){
	?>	
	<div class="pull-right btn btn-default"><?php echo $this->Html->link("Update Profile", array("controller"=>"travelagentprofiles","action"=>"edit/".$currentuser['Travelagentprofile']['id'],"admin"=>false));?>	</div>
	<?php } }?>
	</h4><hr>
	<div class="row">
		<div class="col-md-12">			
			<p><?php echo $currentuser['Travelagentprofile']['aboutme']; ?></p>
		</div>
	</div>
<style>
.well{display:inline-block;-webkit-border-radius:0;width:100%}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}</style>
	<h4><?php echo $currentuser['Travelagent']['firstname'];?>&nbsp;has these content
	<small class="pull-right">Click on the tab to see content of that category</small></h4>
	<hr>
	<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<button type="button" title="Tab One" id="buysell" class="btn btn-primary" href="#bs" data-toggle="tab"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
					<div class="hidden-xs">Tab One</div>
				</button>
			</div>
			<div class="btn-group" role="group">
				<button type="button" title="Tab Two" id="evnshow" class="btn btn-default" href="#es" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
					<div class="hidden-xs">Tab Two</div>
				</button>
			</div>
			<div class="btn-group" role="group">
				<button type="button" title="Tab Three" id="jbsvan" class="btn btn-default" href="#jv" data-toggle="tab"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
					<div class="hidden-xs">Tab Three</div>
				</button>
			</div>
			<div class="btn-group" role="group">
				<button type="button" title="Tab Four" id="hcserv" class="btn btn-default" href="#hc" data-toggle="tab"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
					<div class="hidden-xs">Tab Four</div>
				</button>
			</div>
		</div>
		<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
			
			<div class="btn-group" role="group">
				<button type="button" title="Tab Five" id="scitech" class="btn btn-default" href="#sci" data-toggle="tab"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					<div class="hidden-xs">Tab Five</div>
				</button>
			</div>
			
			<div class="btn-group" role="group">
				<button type="button" title="Tab Six" id="fdrc" class="btn btn-default" href="#fdr" data-toggle="tab"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span>
					<div class="hidden-xs">Tab Six</div>
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
</div><!--container-->

<?php echo $this->fetch('script_execute'); ?>
<script>$(":file").filestyle({buttonName: "btn-default",buttonText: "Change image"});</script>
<script>
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});</script>