jQuery(document).ready(function($){
$("#feedback_button").click(function(){
    	$('.feedback .form').slideToggle();   		
});
function validateEmail(email) { 
  var re = /\S+@\S+\.\S+/;
    return re.test(email);
} 
	$("#submit_form").click(function(){
		var name = $.trim($("#feedback_name").val());
		var email =  $.trim($("#feedback_email").val());
		if(name == "")
		{
					$("#feedback_name").addClass('not_valid');
					return false;
		}else{
							$("#feedback_name").removeClass('not_valid');
		}
		if(validateEmail(email) == false)
		{
		$("#feedback_email").addClass('not_valid');
		
			return false;	
		}else{
		$("#feedback_email").removeClass('not_valid');
			
		}
				$("#submit_form").val('Loading...');

var data = {
		action: 'send_form',
		name: $("#feedback_name").val(),
		email:$("#feedback_email").val()
	};
	
	$.post(window.ajaxurl, data, function(response) {
		if(response == "success")
		{
			$('.feedback .form').html("<h3>You will be contacted shortly. <br /> Thank You</h3>");
			$("#submit_form").val('Send');
		}
	});
});

});