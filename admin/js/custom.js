$(document).ready(function(){ 
///////// start of ready function //////////

$("#submit_button").live("click",function(event){
		
		event.preventDefault();
		 $(".warning").hide();
		if(validate_login()==false)
		return false;
		
		var url = $("#validate_user_url").val();

		   $.ajax({
           type: "POST",
           url: url,
           data: $("#loginform").serialize(), // serializes the form's elements.
           success: function(data)
           {
			   
			   if(data=='inactive')
			 	 {
				 $(".warning").show().html("Sorry - account is inactive as yet");
			  	  return false; 
				  }
				  else if(data=='invalid')
				  {
				  $(".warning").show().html("Sorry - Wrong username Or password");
			  	  return false; 
				  }
				  else
				  {	
				  		$(".success").show().html("Logging in... Please wait...");
						setTimeout(function() {
						window.location = 'dashboard.php';},2000);
						return false;
				  }
		   }
	}); 
});








////////// end of ready function //////////
});



function validate_login()
{
	var user 			= $("#username").val();
	var password 		= $("#password").val();
	
	if(user=='' || password=='')
	{
		$(".warning").show().html("Please Enter Username & password");
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}



function validate_buildings()
{
	var address 	= 	$("#building_address").val();
	var desc 		= 	$("#textarea_wysiwyg").val();

	
	if(address=='')
	{
		alert("Please Select Building from address list");
		$("#building_address").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else if(desc=='')
	{
		alert("Please Enter Building Description");
		$("#textarea_wysiwyg").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}



function validate_users()
{
	var full_name 	= 	$("#full_name").val();
	var email 		= 	$("#email").val();
	var login_name 	= 	$("#login_name").val();
	var status 		= 	$("#status").val();
	
	if(full_name=='')
	{
		alert("Please Enter Full Name");
		$("#full_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else if(email=='')
	{
		alert("Please Enter Email address");
		$("#email").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else if(login_name=='')
	{
		alert("Please Enter Login Name");
		$("#login_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}

	else if(status=='')
	{
		alert("Please Select Status");
		$("#status").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}



function validate_contents()
{
	var title 		= 	$("#title").val();
	var desc 		= 	$("#textarea_wysiwyg").val();
	var status 		= 	$("#status").val();
	
	if(title=='')
	{
		alert("Please Enter Title");
		$("#title").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else if(desc=='')
	{
		alert("Please Enter Description");
		$("#textarea_wysiwyg").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else if(status=='')
	{
		alert("Please Select Status");
		$("#status").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}



function validate_testimonials()
{
	var name 		= 	$("#name").val();
	var desc 		= 	$("#textarea_wysiwyg").val();
	var status 		= 	$("#status").val();

	if(name=='')
	{
		alert("Please Enter Name");
		$("#name").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else if(desc=='')
	{
		alert("Please Enter Testimonial");
		$("#textarea_wysiwyg").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	

	else if(status=='')
	{
		alert("Please Select Status");
		$("#status").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}



function validate_settings()
{
	var name 		= 	$("#unique_name").val();
	var title 		= 	$("#title").val();
	var value 		= 	$("#value").val();

	if(name=='')
	{
		alert("Please Enter a Unique Name");
		$("#unique_name").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else if(title=='')
	{
		alert("Please Enter Title");
		$("#title").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	

	else if(value=='')
	{
		alert("Please Enter value");
		$("#value").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	else 
	{ 
		return true; 
	}
		
}

function validate_bulk_import()
{
	var approval_code 		= 	$("#approval_code").val();

	if(approval_code=='')
	{
		alert("Please enter approval code");
		$("#approval_code").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else if(approval_code!='4567')
	{
		alert("Approval code is not correct, try again");
		$("#approval_code").focus();
		$(".wl_formstatus").hide();
		return false;
	}
	
	else 
	{ 
		return true; 
	}
		
}

