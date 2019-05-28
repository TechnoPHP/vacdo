function setPermission(id,operation){
	$.ajax({
	  async: true,
	  type: 'POST',
	  url: "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetPermission')) ?>",
	  dataType: 'json',
	  data: { acoID: id, operation: operation, aroID: '<?php echo $aroID; ?>' }
	})
	.success(function(data) {
	  tableAros.ajax.reload();
	  tableAros.draw();
	});

}

function setAllPermissions(){
	var dados = $( '#formAclArosAco' ).serializeArray();

	$.ajax({
	  async: true,
	  type: 'POST',
	  url: "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetAllPermission')) ?>",
	  dataType: 'json',
	  data: dados,
	})
	.success(function(data) {
	  msg = '';
	  switch(data.status){
	  	case 'success':
	  		msg = '<div class="activity-item"> <i class="fa fa-check text-success"></i>';
	  		msg = msg+' <div class="activity">'+data.msg+'</div> </div>';
	  	break;
	  	case 'warning':
	  		msg = '<div class="activity-item"> <i class="fa fa-exclamation-triangle text-warning"></i>'
	  		msg = msg+' <div class="activity">'+data.msg+'</div> </div>';
	  	break;
	  	case 'error':
	  		msg = '<div class="activity-item"> <i class="fa fa-times-circle-o text-warning"></i>'
	  		msg = msg+' <div class="activity">'+data.msg+'</div> </div>';
	  	break;
	  }
	  generateNoty(data.status,msg);

	  tableAros.ajax.reload();
	  tableAros.draw();

	  $('#markAll').attr('checked', false);

	});

}

function showProcessingPermissionMessage(){
	type =  'warning';
	msg = '<div class="activity-item"> <i class="fa fa-gears text-warning"></i>';
	msg = msg+' <div class="activity"><?php echo __('Processing permissions...') ?></div> </div>';

	generateNoty(type,msg);
}
