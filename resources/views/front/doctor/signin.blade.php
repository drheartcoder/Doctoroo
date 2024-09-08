<!--login popup start here-->
<div id="dlogin" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<!-- Modal content-->
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
				<img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
				</button>
			</div>
			<div class="modal-body bdy-pading">
						<br/>
					    <div class="alert-box alert_error alert-dismissible" id="doctor_err_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span style="font-size: 20px;">×</span></button> 	
                        </div>

                         <div class="alert-box success alert-dismissible" id="doctor_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span style="font-size: 20px;">×</span></button> 	
                        </div>
					
					<form name="frm_dlogin" id="frm_login" action="">
					{{ csrf_field() }}
						<div class="login_box">
							<div class="title_login">Login as a Doctor</div>
							<div class="tag-txt">Please login to your account</div>
							<div class="user_box">
								<input type="text" class="input_acct-logn" placeholder="Email Address" name="demail_login" id="demail_login" value="{{(isset($_COOKIE["email"]))?$_COOKIE["email"]:''}}" />
								<div class="err" id="err_demail_login"></div>
							</div>
							<div class="user_box">
								<input type="password" class="input_acct-logn"  placeholder="Password" name="dpassword_login" id="dpassword_login" value="{{(isset($_COOKIE["password"]))?$_COOKIE["password"]:''}}" />
								<div class="err" id="err_dpassword_login"></div>
							</div>
							<div class="user_box1">
								<!-- <input type="checkbox"  name="doctor_remember_me" {{ (isset($_COOKIE["email"]))?'checked':'' }} class="css-checkbox" id="doctor_remember_me" value="1">
								<label class="css-label radGroup2"  for="doctor_remember_me" >Remember me</label> -->
								<div class="forget-pass">
									<a data-toggle="modal" href="#forgetpwd" class="forgetpwd">Forgot Password?</a>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="login-bts">
								<input type="hidden" id="otp_id" name="otp_id">
								<input type="hidden" id="password" name="password">
								<input type="hidden" id="email" name="email">

							 <button type="button" name="btn_doctor_login" id="btn_doctor_login" onclick="javascript:return doctorLoginValidationCheck();" class="btn btn-search-login border-btn-radius" >Login</button>
							</div>
							<div class="login-borders">OR</div>
							<div class="login-bts">
								<button class="btn btn-search-login1 border-btn-radius" id="create_doctor_account" type="button">Join Doctoroo</button>
							</div>
							<div class="clearfix">
							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
<script>

	$("#create_doctor_account").click(function(){
		$('#join-doc-popup').modal();
		//window.location = "{{ url('/') }}/doctor/signup/step1";
	});

	$("#demail_login, #dpassword_login").on('keypress',function(event)
	{
	  var keycode = event.keyCode || event.which;
	  if(keycode == '13')
	  {
	      doctorLoginValidationCheck();
	  }
	})	

	
   function doctorLoginValidationCheck()
   {
   		   var flag  = 0;
		   var dpassword_login  =  $('#dpassword_login').val();
		   var demail_login      =  $('#demail_login').val();
		   var demail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		   
		   if($.trim(demail_login)=='')
		   {
		      $('#err_demail_login').show();
		      $('#demail_login').focus();
		      $('#err_demail_login').html('Please enter email id.');
		      $('#err_demail_login').fadeOut(4000);
		      flag  = 1;
		   }
		   else if(!demail_filter.test(demail_login))
		   {
		      $('#err_demail_login').show();
		      $('#demail_login').focus();
		      $('#err_demail_login').html('Please enter valid email id.');
		      $('#err_demail_login').fadeOut(4000);
		      flag  = 1;
		   }
		   else if($.trim(dpassword_login)=='')
		   {
		      $('#err_dpassword_login').show();
		      $('#dpassword_login').focus();
		      $('#err_dpassword_login').html('Please enter Password.');
		      $('#err_dpassword_login').fadeOut(4000);
		      flag  = 1;  
		   }
		   else if($.trim(dpassword_login).length<6)
		   {
		      $('#err_dpassword_login').show();
		      $('#dpassword_login').focus();
		      $('#err_dpassword_login').html('Please enter Password more than 6 characters.');
		      $('#err_dpassword_login').fadeOut(4000);
		      flag  = 1;  
		   }
		   if(flag == 1)
		   {
		   		return false;
		   }
		   else
		   {
		      makeDoctorLogin();
		   }
	}
		 


	function makeDoctorLogin()
    {
    	var url                = "{{ url('/') }}/doctor/signin";
	    var doctor_email       = $('#demail_login').val();
	    var doctor_password    = $('#dpassword_login').val();

	     $.ajax({
         url: url,
         type: 'GET',        
         data:{doctor_email:doctor_email,doctor_password:doctor_password},
         dataType:'json',  
         beforeSend: function() 
	     {
	        showProcessingOverlay();
	     },
         success: function(res)   
         {
     		hideProcessingOverlay();

 			if(res.status=="success" && res.otp_id !='0')
            { 
            	if(res.msg=='' )
            	{
            		$('#otp_id').val(res.otp_id);
            		$('#password').val(res.password);
            		$('#email').val(res.email);
            		$('#verify_doctor_otp').modal('show');
            	}
            	else
            	{
            		  $('#doctor_success_msg').fadeIn(0, function()
		              {
		                   $('#doctor_success_msg').html(res.msg);
		                   hideProcessingOverlay();

		              }).delay(4000).fadeOut('slow');
            	}

            }
            else if(res.status=="error" && res.msg!='')
            {
        		 $('#doctor_err_msg').fadeIn(0, function()
	              {
	                   $('#doctor_err_msg').html(res.msg);
	                   hideProcessingOverlay();

	              }).delay(4000).fadeOut('slow');
            }
            else if(res.otp_id == '0')
              {
                  $('#doctor_err_msg').fadeIn(0, function()
                 {
                     $('#doctor_err_msg').html("Invalid registered mobile number and country code");
                 }).delay(5000).fadeOut('slow');
              }

      	  	
         }
      }); 
    }
</script>