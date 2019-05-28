<?php echo $this->Html->script('bootstrap-filestyle.min',false); ?>
<div class="card" style="">
	<div id="Profile">
	<?php echo $this->Html->image($currentuser['Profile']['userimage'],array("alt"=>"","class"=>"img-fluid mb-2")); ?>
	</div>			
	<?php if($currentuser['User']['id'] == $this->Session->read('Auth.User.id')){ ?>
	<?php echo $this->Form->create('Profile',array('id'=>'imgForm','type' => 'file')); ?>
	<div class="form-group">
	<?php echo $this->Form->input("Profile.image", array('type'=>'file',"class"=>"filestyle","data-buttonName"=>"btn-default","label"=>false));
	echo $this->Form->error('name',array('style'=>'color:red;'));				 
	echo $this->Form->hidden('Profile.user_id', array('value'=>$this->Session->read("Auth.User.id")));
	echo $this->Form->hidden('Profile.id', array('value'=>$currentuser['Profile']['id']));
	echo $this->Form->end();?>
	</div>
	<div id="reviewloader1" style="display:none; " class="btn btn-light">Image is being uploaded...</div>
	<div id='uploadError'>
		<?php if ($this->Session->check('Message.flash')):echo $this->Session->flash(); endif;  ?>
	</div>
	<?php } ?>
	<div class="card-body">
		<h5 class="card-title"><?php echo $currentuser['User']['firstname'].'&nbsp;'.$currentuser['User']['lastname']; ?></h4><hr>
		<p><i class="fas fa-phone"></i>&nbsp;<?php echo $currentuser['User']['phone']; ?></p>
		<p><i class="far fa-envelope"></i>&nbsp;<?php echo $currentuser['User']['email']; ?></p>
		<p><i class="glyphicon glyphicon-map-marker"></i>&nbsp;</h5>
			
	</div><!-- card-body -->	
</div><!-- card -->
<script type="text/javascript">
	$('#ProfileImage').on('change',(function(e) { 
        if($.trim($('#ProfileImage').val()) == ''){
			document.getElementById('uploadError').innerHTML = 'Please select file';
			document.getElementById('uploadError').style.display = 'block';
			return false;
		}else{
			document.getElementById('uploadError').style.display = 'none';
			document.getElementById('reviewloader1').style.display = 'block';
	        e.preventDefault();
	        
			var formData = new FormData($('#imgForm')[0]);
			
	        $.ajax({
	            type:'POST',
	            url: '<?php echo Router::url('/');?>' + 'profiles/uploadimage/',
				data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	            	$('#Profile').html(data);
	               	document.getElementById('reviewloader1').style.display = 'none';
	            },
	            error: function(data){
	                console.log("error");
	                console.log(data);
	            }
	        });
	     }
    }));
</script>
<script>$(":file").filestyle({buttonName: "btn-default",buttonText: "Change image"});</script>