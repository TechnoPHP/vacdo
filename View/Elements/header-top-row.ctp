<div class="header-top-area">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-9 col-xs-12">
					<div class="header-top-left">
						<ul class="header-top-contact m-0 p-0">
							<li><i class="fas fa-map-marker-alt" aria-hidden="true"></i>Seventh Avenue New York</li>
							<li><i class="fa fa-phone" aria-hidden="true"></i>+123-456-7890</li>
							<li><i class="far fa-envelope" aria-hidden="true"></i>info@vacdo.in</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-xs-12 book-tab">
					<div class="header-top-right text-right">
						<div class="book-btn">
							<?php echo $this->Html->link('Travel Agent? Join Us',array('plugin'=>'tagents','controller'=>'pages','action'=>'homepage','admin'=>false));?>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-xs-12 book-tab">
					<div class="header-top-right text-right">
						<?php if (!$this->Session->check("Auth.User")){  ?>
							<div class="dropdown mt-2">
								<a class="btn btn-success dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  Travelers Login
										</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<?php echo $this->Html->link('Sign In',array('plugin'=>'','controller'=>'users','action'=>'login','admin'=>false),array("class"=>"dropdown-item"));?>
									<?php echo $this->Html->link('Sign Up',array('plugin'=>'','controller'=>'users','action'=>'register','admin'=>false),array("class"=>"dropdown-item"));?>
								</div>
							</div>
						<?php }else{ ?>
							<div class="dropdown mt-2">
								<a class="btn btn-success dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Welcom&nbsp;<?php echo ucfirst($this->Session->read("Auth.User.firstname"));?></a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<?php echo $this->Html->link('My Profile',array('plugin'=>'','controller'=>'users','action'=>'login','admin'=>false),array("class"=>"dropdown-item"));?>
									<?php echo $this->Html->link('My Reviews',array('plugin'=>'','controller'=>'reviews','action'=>'register','admin'=>false),array("class"=>"dropdown-item"));?>
									<?php echo $this->Html->link('My Destinations',array('plugin'=>'','controller'=>'reviews','action'=>'register','admin'=>false),array("class"=>"dropdown-item"));?>
									<div class="dropdown-divider"></div>
									<?php echo $this->Html->link('Logout',array('plugin'=>'','controller'=>'users','action'=>'logout','admin'=>false),array("class"=>"dropdown-item"));?>
								</div>
							</div>	
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- header top end -->


<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
	
		<?php echo $this->Html->link($this->Html->image("vacdo.png",array("alt"=>"logo")),array('plugin'=>'','controller'=>'/'),array('escape'=>false));?>
		
		<div class="header-bottom-area collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav main-menu float-right">
				<li class="nav-item active">
				<a class="nav-link" href="#">Weekends <span class="sr-only">(current)</span></a>
				</li>
			  
				<li class="nav-item">
				<a class="nav-link" href="#">Destination Guides</a>
				</li>
				<li class="nav-item">
				<?php echo $this->Html->link('Travel Articles',array('plugin'=>'','controller'=>'articles','action'=>'index','admin'=>false),array("class"=>"nav-link"));?>
				</li>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Holiday Packages
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
				<?php 
					foreach($apppackagetypes as $key=>$apppackagetype){
				?>
				  <?php echo $this->Html->link($apppackagetype,array('plugin'=>'tagents','controller'=>'packages','action'=>'index',$key),array("class"=>"dropdown-item"));?>
				  
				<?php }?>
				</div>
				</li>
			</ul>
		</div>

	</div><!-- /.container -->
</nav>