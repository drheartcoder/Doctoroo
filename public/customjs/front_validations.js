$(document).ready(function(){

	$("#btn_contact").click(function(){

	  var name        = $('#name').val();
      var email       = $('#email_id').val();
      var phoneno     = $('#phone_no').val();
      var message     = $('#message').val();
      var filter      = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var name_filter = /^[a-zA-Z .]*$/.test(name);
      
      if(name=='')
      { 
        $('#name').val(''); 
        $("#name").css("border","1px solid red");
        $('#name').attr('placeholder','Please enter name.');
        $('#name').keyup(function () { $('#name').css("border","1px solid #727171"); $('#name').attr('placeholder',''); });
        $('#name').focus();
        return false;
      }
      else if(name_filter==false)
      {
        $('#name').val(''); 
        $("#name").css("border","1px solid red");
        $('#name').attr('placeholder','Please enter valid name.');
        $('#name').keyup(function () { $('#name').css("border","1px solid #727171"); $('#name').attr('placeholder',''); });
        $('#name').focus();
        return false;
      }
      else if(email=='' || !filter.test(email))
      { 
        $('#email_id').val(''); 
        $("#email_id").css("border","1px solid red");
        $('#email_id').attr('placeholder','Please enter valid email address.');
        $('#email_id').keyup(function () { $('#email_id').css("border","1px solid #727171"); $('#email_id').attr('placeholder',''); });
        $('#email_id').focus();
        return false;
      }
      else if(phoneno=='')
      {
        $('#phone_no').val(''); 
        $("#phone_no").css("border","1px solid red");
        $('#phone_no').attr('placeholder','Please enter phone number.');
        $('#phone_no').keyup(function () { $('#phone_no').css("border","1px solid #727171"); $('#phone_no').attr('placeholder',''); });
        $('#phone_no').focus();
        return false;
      }
      else if(isNaN(phoneno) || phoneno.length<=6 || phoneno.length>10)
      {
        $('#phone_no').val(''); 
        $("#phone_no").css("border","1px solid red");
        $('#phone_no').attr('placeholder','Please enter valid phone number greater than 6 and less than 10.');
        $('#phone_no').keyup(function () { $('#phone_no').css("border","1px solid #727171"); $('#phone_no').attr('placeholder',''); });
        $('#phone_no').focus();
        return false;
      }
      else if($.trim(message)=='')
      {
        $('#message').val(''); 
        $("#message").css("border","1px solid red");
        $('#message').attr('placeholder','Please enter message.');
        $('#message').keyup(function () { $('#message').css("border","1px solid #727171"); $('#message').attr('placeholder',''); });
        $('#message').focus();
        return false;
      }
		
	});
});