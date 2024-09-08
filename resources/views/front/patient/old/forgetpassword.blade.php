<!--forget pwd start here-->
<div id="forgetpwd" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body bdy-pading">
            <form method="post" id="frm_forget_password" name="frm_forget_password">
               {{ csrf_field() }}
               <div class="login_box">
                  <div class="title_login">Reset my Password</div>

                  <br/>
                  <div class="alert-box success alert alert-warning alert-dismissible" id="success_msg" style="display: none;">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span style="font-size: 20px;">×</span></button>
                 </div>

                  <div class="alert-box alert_error alert-dismissible" id="err_msg" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span style="font-size: 20px;">×</span></button>   
                  </div>

                  <div class="forget-txt">Forgot your password? Please enter your email address
                  </div>
                  <div class="user_box">
                     <input type="text" name="email_forget" class="input_acct-logn signp" id="email_forget" placeholder="Enter Email Address" />
                     <div class="err" id="err_email_forget"></div>
                  </div>
                  <div class="forget-txt">You will get a link for reset password on your email address.</div>
                  <div class="clearfix"></div>
                  <div class="login-bts"> 
                     <button class="btn btn-search-login" onclick="javascript:return forgetPasswordValidationCheck();"   type="button" id="patient_forget" style="">Send verification email</button>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--forget pwd end here-->
<script>
   function forgetPasswordValidationCheck()
   {
            var flag = 0;   
            var email_forget      =  $('#email_forget').val();
            var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(email_forget)=='')
            {
               $('#err_email_forget').show();
               $('#email_forget').focus();
               $('#err_email_forget').html('Please enter email id.');
               $('#err_email_forget').fadeOut(4000);
               flag  = 1;
            }
            else if((!pemail_filter.test(email_forget)))
            {
               $('#err_email_forget').show();
               $('#email_forget').focus();
               $('#err_email_forget').html('Please enter valid email id');
               $('#err_email_forget').fadeOut(4000);
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
       var user_email         = $('#email_forget').val();
       var token              = $("input[name='_token']").val(); 
       
       var data = new FormData();
       data.append('email',user_email);  
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
               if(res.status=="success")
               { 
                    
                    $('#success_msg').fadeIn(0, function()
                       {
                            $('#success_msg').html(res.msg);
                           

                       }).delay(6000).fadeOut('slow');

               }
               else if(res.status=="error" && res.msg!='')
               {
                      $('#err_msg').fadeIn(0, function()
                       {
                            $('#err_msg').html(res.msg);
 

                       }).delay(4000).fadeOut('slow');
               }
            
         }
      }); 
   }
</script>