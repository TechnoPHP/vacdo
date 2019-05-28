<div class="col-left">
	<div class="sidebar">
		<p><?php 
			if(!empty($profile['Profile']['userimage']) ){
			echo $this->Html->image($profile['Profile']['userimage'],array("class"=>"img-rounded img-responsive thumbnail" ,"alt"=>$profile['User']['firstname']));
			}else{
			echo $this->Html->image('usericon.jpg',array("class"=>"img-rounded shadow" ,"alt"=>'Profile Image')); 
			}?>
		</p>
		<p>
			<?php
			if(isset($profile['User']['firstname']) && !empty($profile['User']['firstname'])){ ?>
				<h4><?php echo $profile['User']['firstname']; ?></h4>
			<?php }?>
		</p>
		<p>
			<?php if(isset($profile['Profile']['quotes']) && !empty($profile['Profile']['quotes'])){
				echo $profile['Profile']['quotes'];
			} ?>
		</p>
			   
	</div><!-- end siedebar  -->		
</div><!-- end  col left -->

<?php /*
if ($this->Session->check("Auth.User")){
	if(($this->Session->read("Auth.User.Group.name")==='managers')) {
		if($this->Session->read("Auth.User.School.id")){
			echo $this->element('manager_links'); 
		}
	}
}*/
?>