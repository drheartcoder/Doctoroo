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
            <br/>
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
                     <input type="text" class="input_acct-logn" placeholder="Email Address" name="email_login" id="email_login" value="{{(isset($_COOKIE["email"]))?$_COOKIE["email"]:''}}"/>
                     <div class="err" id="err_email_login"></div>
                  </div>
                  <div class="user_box">
                     <input type="password" class="input_acct-logn" placeholder="Password" name="password_login" id="password_login" value="{{(isset($_COOKIE["password"]))?$_COOKIE["password"]:''}}" />
                     <div class="err" id="err_password_login"></div>
                  </div>
                  <div class="user_box1">
                     <div class="forget-pass">
                        <a data-toggle="modal" href="#forgetpwd" class="forgetpwd">Forgot Password?</a>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="login-bts">
                     <input type="hidden" id="otp_id" name="otp_id">
                     <input type="hidden" id="password" name="password">
                     <input type="hidden" id="email" name="email">
                     <button class="btn btn-search-login g-recaptcha border-btn-radius" value="submit" type="button" name="patient_signin" id="patient_signin" onclick="javascript:return patientLoginValidationCheck();" >Login</button>
                  </div>
                  <div class="login-borders">OR</div>
                  <div class="login-bts">
                     <button style="margin-bottom:0px !important;" class="btn btn-search-login1 border-btn-radius" value="" type="button" data-toggle="modal" href="#signup-voucher">Join Doctoroo</button>
                  </div>
                  <br/>
                  <br/>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   $("#email_login, #password_login").on('keypress',function(event)
   {
     var keycode = event.keyCode || event.which;
     if(keycode == '13')
     {
         patientLoginValidationCheck();
     }
   })
   
     function patientLoginValidationCheck()
     {
     
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
         makePatientLogin();
      }
     }
   
   
      function makePatientLogin()
      {
        var url               = "{{ url('/') }}/patient/signin_check";
       var patient_email     = $('#email_login').val();
       var patient_password  = $('#password_login').val();
       var patient_remeber   = $('#rem_me').val();
       
        $.ajax({
           url: url,
           type: 'GET',
           data:{email:patient_email,password:patient_password},
           beforeSend: function()
        {
           showProcessingOverlay();
        },
           success: function(res)   
           {
            hideProcessingOverlay();
            if(res.status=="success" && res.otp_id !='0')
              { 
                if(res.msg=='')
                {
                  $('#otp_id').val(res.otp_id);
                  $('#password').val(res.password);
                  $('#email').val(res.email);
                  $('#verify_otp').modal('show');
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
              else if(res.otp_id == '0')
              {
                  $('#patient_err_msg').fadeIn(0, function()
                 {
                     $('#patient_err_msg').html("Invalid registered mobile number and country code");
                 }).delay(5000).fadeOut('slow');
              }
           }
        }); 
      }
   
</script>