@extends('front.layout.master-coming-soon')
@section('main_content')
<div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
   -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="bg-shaad inner-page-shaad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="banner-home-box">
                  <h1>Reset my Password</h1>
                  <div class="bor-light">&nbsp;</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--contact us section start here-->       
<div class="rest-section">
   <div class="">
      <div class="container">
         <div class="row">
            <div class="about-video-section">
               <div class="container">
                  <form  name="frm_patient_signup" id="frm_patient_signup" action="{{ url('/') }}/store_resetpassword/{{ base64_encode($enc_id)}}" method="post">
                     {{ csrf_field() }}
                   <h1 style="color:#fff;text-align:center;margin-top:0;"></h1>
                     <br/>
                     <div class="reset-bx">
                        @if(Session::has('message'))
                            <p class="alert-box success alert-dismissible">{{ Session::get('message') }}</p>
                        @endif
                        <div class="login_box">
                           <div class="title_login">Reset Password</div>
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">New Password<span> : </span> </div>
                              <input type="password" name="password" id="password" class="form-inputs"/>
                              <!--<div class="err">Please enter valid textfields</div>-->
                              <div class="err" id="err_password_login"></div>
                           </div>
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">Reconfirm Password<span> : </span> </div>
                              <input type="password" name="conpassword" id="conpassword" class="form-inputs"/>
                              <!--<div class="err">Please enter valid textfields</div>-->
                              <div class="err" id="err_conpassword"></div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="login-bts">
                              <button class="btn btn-search-login border-btn-radius" value="submit" id="submits" type="submit">Reset Password</button>
                            <a href="{{ url('/') }}/patient/back"><button class="btn btn-search-login1 border-btn-radius" value="back" type="button">Back</button></a>
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
       $('#submits').click(function(event){
       var password_login  =  $('#password').val();
      var conpassword      =  $('#conpassword').val();
          
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