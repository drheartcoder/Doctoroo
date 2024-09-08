<!--forget pwd start here-->
<div id="forgetpwd" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body bdy-pading">
               {{ csrf_field() }}
               <div class="login_box">
                  <div class="title_login">Reset my Password</div>
                  <br/>
                  <div class="alert-box success alert alert-warning alert-dismissible" id="forget_password_success_msg" style="display: none;">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span style="font-size: 20px;">×</span></button>
                 </div>
                 <div class="alert-box alert_error alert-dismissible" id="forget_password_error_msg_mob_no" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>  
                </div>

                  <div class="alert-box alert_error alert-dismissible" id="err_msg" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span style="font-size: 20px;">×</span></button>   
                  </div>

                  <div class="forget-txt">Forgot your password? Please enter your registered mobile number.
                  </div>
                  <div class="user_box">
                     <input type="text" name="mobile_no_forget" class="input_acct-logn signp" id="mobile_no_forget" placeholder="Enter mobile number" />
                     <div class="err" id="err_mobile_no_forget"></div>
                  </div>
                  <div class="forget-txt">You will get a OTP on your registered mobile number.</div>
                  <div class="clearfix"></div>
                  <div class="login-bts"> 
                     <input type="hidden" id="user_type_forget" value="{{isset($user_type) ? $user_type : '' }}">
                     <button type="button" class="btn btn-search-login border-btn-radius" onclick="javascript:return forgetPasswordValidationCheck();" id="patient_forget" style="">Send OTP</button>
                  </div>
                  <div class="clearfix"></div>
               </div>
            <!-- </form> -->
         </div>
      </div>
   </div>
</div>
<!--forget pwd end here-->
<script>

  $('#mobile_no_forget').keydown(function(event){ 
    var keyCode = (event.keyCode ? event.keyCode : event.which);   
    if (keyCode == 13) {
        $('#patient_forget').click();
    }
  });

  $('#mobile_no_forget').keydown(function(){
      $(this).val($(this).val().replace(/[^\d]/,''));
      $(this).keyup(function(){
          $(this).val($(this).val().replace(/[^\d]/,''));
      });
  });

   function forgetPasswordValidationCheck()
   {
            var flag = 0;
            var mobile_no_forget      =  $('#mobile_no_forget').val();
            var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(mobile_no_forget)=='')
            {
               $('#err_mobile_no_forget').show();
               $('#mobile_no_forget').focus();
               $('#err_mobile_no_forget').html('Please enter mobile number.');
               $('#err_mobile_no_forget').fadeOut(4000);
               flag  = 1;
            }
            
            
            if(flag==1)
            {
               return false;
            }
            else
            {
              makeForgetPassword();
            }
   }
   function makeForgetPassword()
   {
        var url                = "{{ url('/') }}/forgotpassword";
        var mobile_no          = $('#mobile_no_forget').val();
        var user_type          = $('#user_type_forget').val();
        var token              = $("input[name='_token']").val();
       
        var data = new FormData();
        data.append('mobile_no',mobile_no);
        data.append('user_type',user_type);
        data.append('_token', token);
      
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

              if(res.status=="success" && res.otp_id !='0')
              { 
                  if(res.msg=='' )
                  {
                    $('#otp_id').val(res.otp_id);
                    
                    $('#email').val(res.email);
                    $('#verify_forget_password_otp').modal('show');
                  }
                  else
                  {
                      $('#forget_password_success_msg').fadeIn(0, function()
                      {
                           $('#forget_password_success_msg').html(res.msg);
                           hideProcessingOverlay();

                      }).delay(4000).fadeOut('slow');
                  }
              }
              else if(res.status=="error" && res.msg!='')
              {
                 $('#forget_password_error_msg_mob_no').fadeIn(0, function()
                    {
                         $('#forget_password_error_msg_mob_no').html(res.msg);
                         hideProcessingOverlay();

                    }).delay(4000).fadeOut('slow');
              }
              else if(res.otp_id == '0')
              {
                   $('#forget_password_error_msg_mob_no').fadeIn(0, function()
                   {
                       $('#forget_password_error_msg_mob_no').html("Invalid registered mobile number and country code");
                   }).delay(5000).fadeOut('slow');
              }
         }
      }); 
   }
</script>