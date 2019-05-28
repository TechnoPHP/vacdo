<!-- Menu aside start -->
<div class="main-menu">
	
	<div class="main-menu-content">
		<ul class="main-navigation">
			
			<li class="nav-title" data-i18n="nav.category.navigation">
				<i class="ti-line-dashed"></i>
				<span>Navigation</span>
			</li>
			<li class="nav-item has-class">
				<a href="#!">
					<i class="fas fa-home"></i>
					<span>Dashboard</span>
				</a>
				<ul class="tree-1 has-class">
					<li class="has-class">
						<?php echo $this->Html->link("Default",array('plugin'=>'','controller'=>'admins','action'=>'dashboard','admin'=>true)); ?>
					</li>
					<li><?php echo $this->Html->link("Package types",array('plugin'=>'','controller'=>'packagetypes','action'=>'index','admin'=>true)); ?></li>
					<li><?php echo $this->Html->link("Holiday themes",array('plugin'=>'','controller'=>'holidaythemes','action'=>'index','admin'=>true)); ?></li>
					<li><?php echo $this->Html->link("Countries",array('plugin'=>'','controller'=>'countries','action'=>'index','admin'=>true)); ?></li>
				</ul>
			</li>
			
				
			<li class="nav-item single-item">
				<?php echo $this->Html->link("<i class='ti-view-grid'></i> Travel Packages",array('plugin'=>'','controller'=>'packages','action'=>'index','admin'=>true),array('escape'=>false)); ?>				
					<label class="label label-danger menu-caption">100+</label>
			</li>
			<li class="nav-item single-item">
				<?php echo $this->Html->link("<i class='ti-view-grid'></i> Destinations",array('plugin'=>'','controller'=>'destinations','action'=>'index','admin'=>true),array('escape'=>false)); ?>
					<label class="label label-danger menu-caption">100+</label>
			</li>
			<li class="nav-item single-item">
				<?php echo $this->Html->link("<i class='ti-view-grid'></i> Travel agencies",array('plugin'=>'tagents','controller'=>'travelagencies','action'=>'index','admin'=>true),array('escape'=>false)); ?>				
				<label class="label label-danger menu-caption">100+</label>
			</li>
			<li class="nav-item">
				<a href="#!">
					<i class="ti-layout-cta-btn-right"></i>
					<span >Travel Articles</span>
					<label class="label label-danger menu-caption">100+</label>
				</a>				
				<ul class="tree-1">
					<li><?php echo $this->Html->link("<i class='ti-view-grid'></i>Articles Categories",array('plugin'=>'','controller'=>'articlecategories','action'=>'index','admin'=>true),array('escape'=>false)); ?></li>
					<li><?php echo $this->Html->link("<i class='ti-view-grid'></i> Travel articles",array('plugin'=>'','controller'=>'articles','action'=>'index','admin'=>true),array('escape'=>false)); ?></li>
				</ul>
			</li>
			
			
			
			<li class="nav-title" data-i18n="nav.category.forms">
				<i class="ti-line-dashed"></i>
				<span>Forms</span>
			</li>
			
			<li class="nav-item single-item">
				<a href="form-picker.html">
					<i class="ti-pencil-alt"></i>
					<span data-i18n="nav.form-pickers.main"> Form Picker </span>
					<label class="label label-warning menu-caption">NEW</label>
				</a>
			</li>
			<li class="nav-item">
				<a href="#!">
					<i class="ti-layout-cta-btn-right"></i>
					<span data-i18n="nav.json-form.main">JSON Form</span>
					<label class="label label-danger menu-caption">HOT</label>
				</a>
				<ul class="tree-1">
					<li><a href="json-forms/simple-form.html" data-i18n="nav.json-form.simple-form">Simple Form</a></li>
					
					<li><a href="json-forms/localized-login.html" data-i18n="nav.json-form.localized-login">Localized Login</a></li>
				</ul>
			</li>
			
			
		
			
			<li class="nav-item">
				<a href="#!">
					<i class="ti-user"></i>
					<span data-i18n="nav.user-profile.main">User Profile</span>
				</a>
				<ul class="tree-1">
					<li><a href="timeline.html" data-i18n="nav.user-profile.timeline">Timeline</a></li>
					<li><a href="timeline-social.html" data-i18n="nav.user-profile.timeline-social">Timeline Social</a></li>
					<li><a href="user-profile.html" data-i18n="nav.user-profile.user-profile">User Profile</a></li>
					<li><a href="user-card.html" data-i18n="nav.user-profile.user-card">User Card</a></li>
				</ul>
			</li>
				
			
			
			
			
		</ul>
	</div><!--main-menu-content-->
</div>
<!-- Menu aside end -->