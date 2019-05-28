<style>
/* Tabs*/
#tabs.nav-tabs { border-bottom: 2px solid #DDD; }
#tabs.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
#tabs.nav-tabs > li > a { border: none; color: #ffffff;background: #5a4080; }
#tabs.nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; }
#tabs.nav-tabs > li > a::after { content: ""; background: #5a4080; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
#tabs.nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
#tabs.tab-nav > li > a::after { background: ##5a4080 none repeat scroll 0% 0%; color: #fff; }
#tabs.tab-pane { padding: 15px 0; }
#tabs.tab-content{padding:20px}
#tabs.nav-tabs > li  {width:20%; text-align:center;}
#tabs.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
@media all and (max-width:724px){
#tabs.nav-tabs > li > a > span {display:none;}	
#tabs.nav-tabs > li > a {padding: 5px 5px;}
}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-3">	
			<?php echo $this->element('Tagents.sidebar_dashboard');?>	
		</div>
		<div class="col-md-9">
			<h4><?php echo $currentuser['Travelagency']['name']; ?>
			
			</h4><hr>
			
			<section id="tabs">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<nav>
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">About Agency</a>
									
									<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Agency Team</a>
									
									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Packages</a>
									
									<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Inquiries</a>
								</div>
							</nav>
							<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									<?php if($this->Session->check('Auth.Travelagent.id')){
											if($this->Session->read('Auth.Travelagent.id')==$currentuser['Travelagent']['id']){
										?>	
											<div class="pull-right btn btn-default">
												<?php echo $this->Html->link("Update Profile", array("controller"=>"travelagentprofiles","action"=>"edit/".$currentuser['Travelagentprofile']['id'],"admin"=>false));?>
											</div>
										<?php } 
									}?>
									<?php echo $currentuser['Travelagentprofile']['aboutme']; ?>
								</div>
								<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
									Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
								</div>
								<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
									Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
								</div>
								<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
									Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</section><!-- ./Tabs -->			
		</div><!--end of col-md-9-->
	</div><!--row-->
</div><!--container-->


<div class="container">
	<div class="row">
		<div class="col-md-3">	
			<?php echo $this->element('Tagents.sidebar_dashboard');?>	
		</div>
		<div class="col-md-9">
		  <!-- Nav tabs -->
			<div class="card">
				<ul class="nav nav-tabs" role="tablist">
				  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-home"></i>  <span>About Agency</span></a></li>
				  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Agency Team</span></a></li>
				  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i>  <span>Packages</span></a></li>
				  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i>  <span>Inquiries</span></a></li>
				  
				</ul>
			
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
					<div role="tabpanel" class="tab-pane" id="profile">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
					<div role="tabpanel" class="tab-pane" id="messages">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
					<div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
					
					
				</div><!--tab-content-->
			</div><!--card-->
		</div><!--col-md-9-->
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