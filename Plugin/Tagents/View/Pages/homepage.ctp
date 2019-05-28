<style>
.tagent{
	z-index:0;
	position:relative;
}
.tagent:after{
	position:absolute !important;
	width:100%;
	height:100%;
	left:0px;
	top:0px;
	content:"";
	background-color:rgba(255,255,255,0.6);
	z-index:0;
}
.tagent .card-img-overlay{
z-index:1;
}
</style>

<div class="card border-0">
	<div  class="tagent">
		<?php echo $this->Html->image('agent-banner.jpg',array("class"=>"card-img img-fluid")); ?>
		<div class="card-img-overlay text-center">
			<h1 class="card-title">Get 100% Genuine Travel Leads</h1>
			<h3 class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</h3>
			<p class="card-text">Last updated 3 mins ago</p>
		</div>
	</div>
</div>
