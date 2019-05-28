<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
	<div class="container">
		
		<?php echo $this->Html->link("Website Logo",array('plugin'=>'tagents','controller'=>'pages','action'=>'homepage','admin'=>false),array("class"=>"navbar-brand"));?>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExample09">
			<ul class="navbar-nav mr-auto">
				
				<?php if ($this->Session->check('Auth.Travelagent.id')){ ?>
				<li class="nav-item"><?php echo $this->Html->link("My workmen",array('plugin'=>'tagents','controller'=>'workers','action'=>'index','admin'=>false),array("class"=>"nav-link"));?></li>
				<li class="nav-item dropdown">
					<?php echo $this->Html->link("Welcome&nbsp;&nbsp;".$this->Session->read('Auth.Travelagent.firstname'),array('plugin'=>'tagents',"controller"=>"travelagents","action"=>"dashboard","admin"=>false),array("class"=>"nav-link dropdown-toggle","data-toggle"=>"dropdown", "aria-haspopup"=>"true","aria-expanded"=>"false","escape"=>false)); ?>
					<div class="dropdown-menu" aria-labelledby="dropdown09">
					<?php echo $this->Html->link("My Dashboard", array('plugin'=>'tagents','controller'=>'travelagents','action'=>'dashboard','admin'=>false),array("class"=>"dropdown-item")); ?>
					<?php echo $this->Html->link("My Travel Agency", array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'view','admin'=>false),array("class"=>"dropdown-item")); ?>
					<?php echo $this->Html->link("My Travel Packages", array('plugin'=>'tagents','controller'=>'packages','action'=>'index','admin'=>false),array("class"=>"dropdown-item")); ?>
					<?php echo $this->Html->link("My Package Inquiries", array('plugin'=>'tagents','controller'=>'inquiries','action'=>'index','admin'=>false),array("class"=>"dropdown-item")); ?>
					<?php echo $this->Html->link("Change Password", array('plugin'=>'tagents','controller'=>'travelagents','action'=>'changepassword/'.$this->Session->read('sessuserid'),'admin'=>false),array("class"=>"dropdown-item")); ?>
					<?php echo $this->Html->link("Logout", array("plugin"=>"tagents","controller"=>"travelagents","action"=>"logout","admin"=>false),array("class"=>"dropdown-item"));?>
					</div>
				</li>
				
				<?php }else { ?>
				
				<li class="nav-item"><?php echo $this->Html->link("Sign up",array('plugin'=>'tagents','controller'=>'travelagents','action'=>'register','admin'=>false),array("class"=>"nav-link"));?></li>
				<li class="nav-item"><?php echo $this->Html->link("Sign in",array('plugin'=>'tagents','controller'=>'travelagents','action'=>'login','admin'=>false),array("class"=>"nav-link"));?></li>
				<?php } ?>
			</ul>
		</div>
	</div><!--container -->
</nav>