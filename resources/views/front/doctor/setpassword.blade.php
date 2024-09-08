@extends('front.layout.master-coming-soon')                
@section('main_content')
<div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
   -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="bg-shaad inner-page-shaad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="banner-home-box">
                  <h1> Set Password</h1>
                  <div class="bor-light">&nbsp;</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--contact us section start here-->       
<div class="about-us-section">
   <div class="">
      <div class="container">
         <div class="row">
            <div class="about-video-section">
               <div class="container">
                  <form  name="frm_patient_signup" id="frm_patient_signup" action="{{ url('/') }}/doctor/verify_setpassword" method="post">
                     {{ csrf_field() }}

                   <input type="hidden" name="enc_user_id" id="enc_user_id" value="{{ $enc_user_id or ''}}">
                     
                   {{-- <h1 style="color:#50ab50;text-align:center;">Your account is activated successfully!</h1> --}}
                     </br>
                     <div class="reset-bx">
                        @include('front.layout._operation_status')
                        <div class="login_box">
                           <div class="title_login">Set password for account</div>
                            <div class="user_box">
                              <div class="form-lable" style="text-align:left;">Email ID<span> : </span>(Your register email id)</div>
                              <input type="input" name="email" id="email" class="form-inputs"/>
                              <div class="err" id="err_email"></div>
                           </div>
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">New Password<span> : </span> </div>
                              <input type="password" name="password" id="password" class="form-inputs"/>
                              <div class="err" id="err_password_login"></div>
                           </div>
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">Confirm Password<span> : </span> </div>
                              <input type="password" name="confirm_password" id="conpassword" class="form-inputs"/>
                              <!--<div class="err">Please enter valid textfields</div>-->
                              <div class="err" id="err_conpassword"></div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="login-bts">
                              <button class="btn btn-search-login " value="submit" id="set_password_btn" type="submit">Continue</button>
                            <a href="{{ url('/') }}/patient/back"><button class="btn btn-search-login1" value="back" type="button">Back</button></a>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
      $('#set_password_btn').click(function(event){
      var email  =  $('#email').val();
      var password_login  =  $('#password').val();
      var conpassword      =  $('#conpassword').val();
      var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if($.trim(email)=='')
      {
         $('#err_email').show();
         $('#email').focus();
         $('#err_email').html('Please enter your register email id.');
         $('#err_email').fadeOut(4000);
         return false;  
      }    
      if(!pemail_filter.test(email))
      {
         $('#err_email').show();
         $('#email').focus();
         $('#err_email').html('Please enter valid email id.');
         $('#err_email').fadeOut(4000);
         return false;  
      }
      if($.trim(password_login)=='')
      {
         $('#err_password_login').show();
         $('#password').focus();
         $('#err_password_login').html('Please enter new password.');
         $('#err_password_login').fadeOut(4000);
         return false;  
      }
      if($.trim(password_login).length<6)
      {
         $('#err_password_login').show();
         $('#password').focus();
         $('#err_password_login').html('Please enter password till 6 characters or more then 6 characters.');
         $('#err_password_login').fadeOut(4000);
         return false;  
      }
       if($.trim(conpassword)=='')
      {
         $('#err_conpassword').show();
         $('#conpassword').focus();
         $('#err_conpassword').html('Please enter reconfirm password.');
         $('#err_conpassword').fadeOut(4000);
         return false;  
      }
      if($('#password').val() != $('#conpassword').val()) {
                $('#err_conpassword').show();
         $('#conpassword').focus();
         $('#err_conpassword').html('Reconfirmed password does not match with new password.');
         $('#err_conpassword').fadeOut(4000);
         return false;  
           }
   
      else
      {
         return true;
      }
            
       });
   });
        
</script>
<!--contact us section end here-->           
<!--footer-->
@stop