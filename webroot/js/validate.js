$(document).ready(function(){
	jQuery('#receiver').blur(function(){
		jQuery.post(
			'validateform', //Plugin/controller and action path
			{field: jQuery('#receiver').attr('id'), value: jQuery('#receiver').val()},
			namevalidation
		);
	});
	function namevalidation(error){
		if(error.length >0){
			if(jQuery('#name-validate').length==0){
				jQuery('#receiver').after('<div id="name-validate" class="errror-message">'+error+'</div>');
			}
		}else{
			jQuery('#name-validate').remove();
		}
	}
	jQuery('#recemail').blur(function(){
		jQuery.post(
			'validateform', //Plugin/controller and action path
			{field: jQuery('#recemail').attr('id'), value: jQuery('#recemail').val()},
			emailvalidation
		);
	});
	function emailvalidation(error1){
		if(error1.length >0){
			if(jQuery('#email-validate').length==0){
				jQuery('#recemail').after('<div id="email-validate" class="error-message">'+error1+'</div>');
			}
		}else{
			jQuery('#email-validate').remove();
		}
	}
	/*jQuery('#TofriendCaptcha').blur(function(){
		jQuery.post(
			'validateform', //Plugin/controller and action path
			{field: jQuery('#TofriendCaptcha').attr('id'), value: jQuery('#TofriendCaptcha').val()},
			capvalidation
		);
	});
	function capvalidation(error4){
		if(error4.length >0){
			if(jQuery('#message-validate').length==0){
				jQuery('#TofriendCaptcha').after('<div id="message-validate" class="error-message">'+error4+'</div>');
			}
		}else{
			jQuery('#message-validate').remove();
		}
	}*/
	
	jQuery('#message').blur(function(){
		jQuery.post(
			'validateform', //Plugin/controller and action path
			{field: jQuery('#message').attr('id'), value: jQuery('#message').val()},
			messagevalidation
		);
	});
	function messagevalidation(error3){
		if(error3.length >0){
			if(jQuery('#message-validate').length==0){
				jQuery('#message').after('<div id="message-validate" class="error-message">'+error3+'</div>');
			}
		}else{
			jQuery('#message-validate').remove();
		}
	}
	
});