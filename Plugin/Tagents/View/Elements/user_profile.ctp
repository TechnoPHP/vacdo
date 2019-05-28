	<?php echo $this->Html->script('bootstrap-filestyle.min',false); ?>
		<div class="card">
			<div id="Travelagentprofile" class="">
				<?php echo $this->Html->image($currentuser['Travelagentprofile']['userimage'],array("alt"=>"","class"=>"card-img-top img-fluid")); ?>
			</div>
			<div class="card-body">
				<h5 class="card-title"><?php echo $currentuser['Travelagent']['firstname'].'&nbsp;'.$currentuser['Travelagent']['lastname']; ?></h5>
			<?php if($currentuser['Travelagent']['id'] == $this->Session->read('Auth.Travelagent.id')){ ?>
			<?php echo $this->Form->create('Agentprofile',array('id'=>'imgForm','type' => 'file')); ?>
			<div class="form-group">
			<?php echo $this->Form->input("Travelagentprofile.image", array('type'=>'file',"class"=>"filestyle","data-buttonName"=>"btn-default","label"=>false));
			echo $this->Form->error('name',array('style'=>'color:red;'));				 
			echo $this->Form->hidden('Travelagentprofile.aagent_id', array('value'=>$this->Session->read("Auth.Travelagent.id")));
			echo $this->Form->hidden('Travelagentprofile.id', array('value'=>$currentuser['Travelagentprofile']['id']));
			echo $this->Form->end();?>
			</div>
			<div id="reviewloader1" style="display:none; " class="btn btn-primary">Image is being uploaded...</div>
			<div id='uploadError'>
				<?php if ($this->Session->check('Message.flash')):echo $this->Session->flash(); endif;  ?>
			</div>
			<?php } ?>
			</div><!--card-body -->
		
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><i class="fa fa-phone"></i>&nbsp;<?php echo $currentuser['Travelagent']['phone']; ?></li>
				<li class="list-group-item"><i class="fa fa-envelope"></i>&nbsp;<?php echo $currentuser['Travelagent']['email_address']; ?></li>
					
					<?php $msgtype=null;
					if (isset($currentuser['Travelagentprofile']['msgtype']) && (!empty($currentuser['Travelagentprofile']['msgtype']))){
						switch($currentuser['Travelagentprofile']['msgtype']){
							case 'HOT':		$msgtype = 'Hotmail';break;
							case 'YAH':		$msgtype = 'Yahoo';break;
							case 'SKY':		$msgtype = 'Skype';break;
							default : $msgtype = 'Messanger';
						}
					}
					?>
				<li class="list-group-item"><i class="fa fa-comments"></i>&nbsp;<?php echo $msgtype.":&nbsp;".$currentuser['Travelagentprofile']['messanger']; ?></li>
				<li class="list-group-item"><i class="fa fa-map-marker"></i>&nbsp;Location</li>
			</ul>
	</div><!-- card -->

<script type="text/javascript">
	$('#TravelagentprofileImage').on('change',(function(e) { 
        if($.trim($('#TravelagentprofileImage').val()) == ''){
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
	            url: '<?php echo Router::url('/');?>' + 'tagents/travelagentprofiles/uploadimage/',
				data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	            	$('#Travelagentprofile').html(data);
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
<script>$(":file").filestyle({buttonName: "btn btn-info",buttonText: "Change image"});</script>