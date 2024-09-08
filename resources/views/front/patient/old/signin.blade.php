<!--login popup start here-->
<div id="login" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<!-- Modal content-->
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
				<img src="{{ url('/') }}/public/images/close-popup.png" alt="">
				</button>
			</div>
			<div class="modal-body bdy-pading">
					    <div class="alert-box alert_error alert-dismissible" id="patient_err_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span style="font-size: 20px;">×</span></button> 	
                        </div>

                         <div class="alert-box success alert-dismissible" id="patient_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span style="font-size: 20px;">×</span></button> 	
                        </div>



					<form name="frm_login" id="frm_login" method="post">
					{{ csrf_field() }}
						<div class="login_box">
							<div class="title_login">Login as a Patient</div>
							<div class="tag-txt">Get started as a Patient</div>
							<div class="user_box">
								<input type="text" class="input_acct-logn" placeholder="Email Address" name="email_login" id="email_login"  value="{{(isset($_COOKIE["email"]))?$_COOKIE["email"]:''}}"/>
								<div class="err" id="err_email_login"></div>
							</div>
							<div class="user_box">
								<input type="password" class="input_acct-logn" placeholder="Password" name="password_login" id="password_login" value="{{(isset($_COOKIE["password"]))?$_COOKIE["password"]:''}}" />
								<div class="err" id="err_password_login"></div>
							</div>
							<div class="user_box1">
								<input type="checkbox" class="css-checkbox" id="rem_me" name="rem_me" value="1" {{ (isset($_COOKIE["email"]))?'checked':'' }}/>
								<label class="css-label radGroup2" for="rem_me" >Remember me</label>
								<div class="forget-pass">
									<a data-toggle="modal" href="#forgetpwd" class="forgetpwd">Forgot Password?</a>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="login-bts">
								<button class="btn btn-search-login" value="submit" type="button" name="patient_signin" id="patient_signin">Login</button>
							</div>
							<div class="login-borders">OR</div>
							<div class="login-bts">
								<button style="margin-bottom:0px !important;" class="btn btn-search-login1" value="" type="button" data-toggle="modal" href="#signup">Join Doctoroo</button>
							</div>
							<div class="main-social text-center">
								<!--<div class="connect-s">Connect with your favorite social network</div>
								<div class="fb-btns">
								<button style="" type="submit" value="submit" class="btn btn-search-fb"><span><i class="fa fa-facebook" ></i></span> Login With Facebook </button>
								</div>
								<div class="fb-btns">
								<button style="" type="submit" value="submit" class="btn btn-search-fb googluls"><span><i class="fa fa-google-plus" ></i></span> Login With Google+ </button>
								</div>
								</div> -->
								<div class="create-ac"><a data-toggle="modal" href="#dlogin" class="sign_up"> Are you a Doctor?</a></div>

								<div class="create-ac"><a data-toggle="modal" href="#pharmacy-signin-modal" class="sign_up"> Are you a Pharmacy?</a></div>
							<div class="clearfix">
							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
<script>

$(document).ready(function(){
   $('#patient_signin').click(function(){ 
   
   var password_login  =  $('#password_login').val();
   var email_login      =  $('#email_login').val();
   var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   
   if($.trim(email_login)=='')
   {
      $('#err_email_login').show();
      $('#email_login').focus();
      $('#err_email_login').html('Please enter email id.');
      $('#err_email_login').fadeOut(4000);
      return false;  
   }
   else if(!pemail_filter.test(email_login))
   {
      $('#err_email_login').show();
      $('#email_login').focus();
      $('#err_email_login').html('Please enter valid email id.');
      $('#err_email_login').fadeOut(4000);
      return false;  
   }
   else if($.trim(password_login)=='')
   {
      $('#err_password_login').show();
      $('#password_login').focus();
      $('#err_password_login').html('Please enter Password.');
      $('#err_password_login').fadeOut(4000);
      return false;  
   }
   else if($.trim(password_login).length<6)
   {
      $('#err_password_login').show();
      $('#password_login').focus();
      $('#err_password_login').html('Please enter Password more than 6 characters.');
      $('#err_password_login').fadeOut(4000);
      return false;  
   }
   else
   {
   	  //showProcessingOverlay();
      //return true;
      makePatientLogin();
   }
  });
});


    function makePatientLogin()
    {
    	var url                = "{{ url('/') }}/patient/signin_check";
	    var patient_email     = $('#email_login').val();
	    var patient_password  = $('#password_login').val();
	    var patient_remeber   = $('#rem_me').val();
	    var token              = $("input[name='_token']").val();    
	    
	    var data = new FormData();
	    data.append( 'email',patient_email );  
	    data.append( 'password',patient_password );  
	    data.append( 'remember_me',patient_remeber );  
	    data.append( '_token', token ); 

	     $.ajax({
         url: url,
         type: 'POST',        
         data:data, 
         contentType: false,     
         cache: false,          
         processData:false,  
         beforeSend: function() 
	     {
	        showProcessingOverlay();
	     },
         success: function(res)   
         {
         		 hideProcessingOverlay();
	         	if(res.status=="success")
	            { 
	            	if(res.msg=='')
	            	{
	                 	window.location.href = "{{url('/').'/patient'}}/profile";     	
	                 	//window.location.href="{{url('/')}}search/doctor/who-is-patient"
	            	}
	            	else
	            	{
	            		  $('#patient_success_msg').fadeIn(0, function()
			              {
			                   $('#patient_success_msg').html(res.msg);
			                  

			              }).delay(5000).fadeOut('slow');
	            	}

	            }
	            else if(res.status=="error" && res.msg!='')
	            {
	        		 $('#patient_err_msg').fadeIn(0, function()
		              {
		                   $('#patient_err_msg').html(res.msg);
		                   

		              }).delay(5000).fadeOut('slow');
	            }
         }
      }); 
    }

</script>