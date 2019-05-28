$('#sync_acos').on('click',function(){
	
	$.ajax({
	  async: true,
	  type: 'POST',
	  url: "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'acosSyncAjax')) ?>",
	  dataType: 'json',
	})
	.success(function(data) {
	  
	  $.each(data,function(index,value){
	  	$.each(value,function(type,message){
	  		textMessage = '';
	  		switch(type){
	  			case 'success':
	  				textMessage = '<div class="activity-item"> <i class="fa fa-check text-success"></i> <div class="activity">'+message+'</div> </div>'
	  			break;
	  			case 'warning':
	  				textMessage = '<div class="activity-item"> <i class="fa fa-exclamation-triangle text-warning"></i> <div class="activity">'+message+'</div> </div>'
	  			break;
	  			case 'error':
	  				textMessage = '<div class="activity-item"> <i class="fa fa-times-circle-o text-warning"></i> <div class="activity">'+message+'</div> </div>'
	  			break;
	  		}

	  		generateNoty(type,textMessage);
	  	});
	  });

	});
	

});