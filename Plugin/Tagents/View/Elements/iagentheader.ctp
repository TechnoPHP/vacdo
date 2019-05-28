<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">WebSiteName</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><?php echo $this->Html->link("Home",array('plugin'=>'tagents','controller'=>'pages','action'=>'homepage','admin'=>false));?></li>
			<?php if ($this->Session->check('Auth.Travelagent.id')){ ?>
			<li><?php echo $this->Html->link("Welcom&nbsp;&nbsp;".$this->Session->read('Auth.Travelagent.firstname'),	array('plugin'=>'tagents',"controller"=>"aagents","action"=>"dashboard","admin"=>false),array("aria-expanded"=>"false","escape"=>false)); ?>
			</li>
			<li><?php echo $this->Html->link("Change Password", array('plugin'=>'tagents','controller'=>'travelagents','action'=>'changepassword/'.$this->Session->read('sessuserid'),'admin'=>false)); ?></li>
			<li><?php echo $this->Html->link("Logout", array("plugin"=>"tagents","controller"=>"travelagents","action"=>"logout","admin"=>false));?></li>
			<?php }else { ?>
			
			<li><?php echo $this->Html->link("Sign up",array('plugin'=>'tagents','controller'=>'travelagents','action'=>'register','admin'=>false));?></li>
			<li><?php echo $this->Html->link("Sign in",array('plugin'=>'tagents','controller'=>'travelagents','action'=>'login','admin'=>false));?></li>
			<?php } ?>	
			<li><?php echo $this->Html->link("Workers",array('plugin'=>'tagents','controller'=>'workers','action'=>'index','admin'=>false));?></li>
		</ul>
	</div>
</nav>