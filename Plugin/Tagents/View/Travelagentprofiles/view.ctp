<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<aside class="col-md-4">
<?php if($this->Session->check('Auth.User')){
		echo $this->element('profile_sidebar');
	}
	?>
</aside>
<h3 class="col-md-8">Profile of&nbsp;<?php echo $profile['User']['firstname'];?>
<?php 
		if ($this->Session->check("Auth.User")){ 
			if(($this->Session->read("Auth.User.id")===$profile['User']['id'])) {
				echo $this->Html->link('Edit Profile',array("controller"=>"profiles","action"=>"edit",$profile['Profile']['id']), array("class"=>"button_red_small pull-right")); 
			}
		}
		
?>
</h3>

<section class="col-md-8">
	<div class="profile col-right">
		<h3>About&nbsp;<?php echo $profile['User']['firstname'];?></h3><hr>
		<p><?php echo $profile['Profile']['aboutme'];?></p>
		<h3>Quote from&nbsp;<?php echo $profile['User']['firstname'];?></h3><hr>
		<p><?php echo $profile['Profile']['quotes'];?></p>
	</div>
</section>