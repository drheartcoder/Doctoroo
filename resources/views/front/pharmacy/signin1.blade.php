<!--login popup start here-->
<div id="pharmacy-signin-modal"  class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<!-- Modal content-->
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
				<img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
				</button>
			</div>
			<div class="modal-body bdy-pading">
				<!--error msg-->
					<br>
					   <div class="alert-box alert_error alert-dismissible" id="response_err_msg" style="display: none;">
                               	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span style="font-size: 20px;">×</span></button> 	
                        </div>
					
					<form name="frm_pharmacy_login" id="frm_pharmacy_login" action="" method="post">
					{{ csrf_field() }}
						<div class="login_box">
							<div class="title_login">Login as a Pharmacy</div>
							<div class="tag-txt">Please login to your account</div>
							<div class="user_box">
								<input type="text" class="input_acct-logn" tabindex="1"  placeholder="Email Address" value="{{(isset($_COOKIE["email"]))?$_COOKIE["email"]:''}}" name="pharmacy_email" id="pharmacy_email" />
								<div class="err" id="err_pharmacy_email"></div>
							</div>
							<div class="user_box">
								<input type="password" class="input_acct-logn" tabindex="2" value="{{(isset($_COOKIE["password"]))?$_COOKIE["password"]:''}}" placeholder="Password" name="pharmacy_password" id="pharmacy_password" value="" />
								<div class="err" id="err_pharmacy_password"></div>
							</div>
							<div class="user_box1">
								<!-- <input type="checkbox"  name="remember_me" {{ (isset($_COOKIE["email"]))?'checked':'' }} class="css-checkbox" id="remember_me" value="1">
								<label class="css-label radGroup2"  for="remember_me" >Remember me</label> -->
								<div class="forget-pass">
									<a data-toggle="modal" href="#forgetpwd" class="forgetpwd">Forgot Password?</a>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="login-bts">

							 <button type="button" tabindex="3" name="btn_pharmacy_login" id="btn_pharmacy_login" onclick="javascript:return pharmacyloginValidationCheck();" class="btn btn-search-login border-btn-radius" >Login</button>
							</div>
							<div class="login-borders">OR</div>
							<div class="login-bts">
								<button class="btn btn-search-login1 border-btn-radius" onclick="gotoPharmacysignup()" value="" type="button">Join Doctoroo</button>
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

	/*$(document).keypress(function(e) {
		
		 if(e.which == 13) { 	
		 	loginValidationCheck();
		 }
	});*/

	$("#pharmacy_email, #pharmacy_password").on('keypress',function(event)
	{
	  var keycode = event.keyCode || event.which;
	  if(keycode == '13')
	  {
	      pharmacyloginValidationCheck();
	  }
	})

	function pharmacyloginValidationCheck()
    {
    	   var flag = 0;
    	   var pharmacy_password   =  $('#pharmacy_password').val();
		   var pharmacy_email      =  $('#pharmacy_email').val();
		   var p_email_filter      = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		   
		   if($.trim(pharmacy_email)=='')
		   {
		      $('#err_pharmacy_email').show();
		      $('#pharmacy_email').focus();
		      $('#err_pharmacy_email').html('Please enter email id.');
		      $('#err_pharmacy_email').fadeOut(4000);
		      flag = 1;
		        
		   }
		   else if(!p_email_filter.test(pharmacy_email))
		   {
		      $('#err_pharmacy_email').show();
		      $('#pharmacy_email').focus();
		      $('#err_pharmacy_email').html('Please enter valid email id.');
		      $('#err_pharmacy_email').fadeOut(4000);
		      flag = 1;
		    
		   }
		   else if($.trim(pharmacy_password)=='')
		   {
		      $('#err_pharmacy_password').show();
		      $('#pharmacy_password').focus();
		      $('#err_pharmacy_password').html('Please enter Password.');
		      $('#err_pharmacy_password').fadeOut(4000);
		      flag = 1;
		     
		   }
		   else if($.trim(pharmacy_password).length<6)
		   {
		      $('#err_pharmacy_password').show();
		      $('#pharmacy_password').focus();
		      $('#err_pharmacy_password').html('Please enter Password more than 6 characters.');
		      $('#err_pharmacy_password').fadeOut(4000);
		      flag = 1;
		      
		   }
		   else if(flag==1)
		   {
		      return false;
		   }
		   else
		   {
		   		makepharmacyLogin();
		   }

    }

    function makepharmacyLogin()
    {
    	var url                = "{{ url('/') }}/pharmacy/login";
	    var pharmacy_email     = $('#pharmacy_email').val();
	    var pharmacy_password  = $('#pharmacy_password').val();
	    var pharmacy_remeber   = $('#remember_me').val();
	    var token              = $("input[name='_token']").val();    
	    
	    var data = new FormData();
	    data.append( 'email',pharmacy_email );  
	    data.append( 'password',pharmacy_password );  
	    data.append( 'remember_me',pharmacy_remeber );  
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

      	  	if(res.status=="success")
            { 
            	 showProcessingOverlay();
                 window.location.href = "{{url('/').'/pharmacy'}}/dashboard";     	

            }
            else if(res.status=="error" && res.msg!='')
            {
            		 $('#response_err_msg').fadeIn(0, function()
		              {
		                   $('#response_err_msg').html(res.msg);
		                   hideProcessingOverlay();

		              }).delay(4000).fadeOut('slow');
            }

          }
      }); 
    }
    function goToSignupPage()
    {

    	$('#pharmacy-signin-modal').modal('hide');
    	 showProcessingOverlay();
    	 $('#banner_text_id').hide();
         $('#div_pharmacy_signup').slideDown( "slow", function() {         
         $('#bannner_div_id').hide();
         initialize();
         hideProcessingOverlay();
       });
    }

</script>