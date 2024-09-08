@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')
<style class="text/css">
.dashboard-menu{margin-bottom: 0;}
</style>

 <div class="rest-section">
   <div class="">
      <div class="container">
         <div class="row">
            <div class="about-video-section">
               <div class="container">
                  <form  name="frm_patient_change_password" id="frm_patient_change_password" action="{{ $patient_path }}/update_password" method="post">
                     {{ csrf_field() }}
                     <div class="reset-bx">
                       @include('front.layout._operation_status')
                        <div class="login_box">
                           <div class="title_login">Change Password</div>
                          <!--  <div class="cant-find-txt" style="text-align:left;">You have successfully been identified.</div> -->
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">Current Password<span style="color:red;">*</span> </div>
                              <input type="password" name="current_password"  data-rule-required='true' minlength="6" class="form-inputs"/>
   
                             <span class='err'>{{ $errors->first('current_password') }}</span>
                           </div>
                           <div class="user_box">
                              <div class="form-lable" style="text-align:left;">New Password<span style="color:red;">*</span></div>
                              <input type="password" name="new_password" id="new_password" minlength="6" data-rule-required='true' class="form-inputs"/>

                               <span class='err'>{{ $errors->first('new_password') }}</span>
                           </div>
                            <div class="user_box">
                              <div class="form-lable" style="text-align:left;">Confirm Password<span style="color:red;">*</span></div>
                              <input type="password" minlength="6" equalTo="#new_password" data-rule-required='true' name="confirm_password" class="form-inputs"/>

                              <span class='err'>{{ $errors->first('confirm_password') }}</span>
                           </div>
                           <div class="clearfix"></div>
                           <div class="login-bts">
                              <button class="btn btn-search-login " value="submit" id="submits" type="submit">Submit</button>
                               <button class="btn btn-search-login1" onclick="redirectToBack()" value="back" type="button">Back</button>
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
    
    
      <!--calender section end-->  
   <script>
         
    $(document).ready(function(){


      $('#frm_patient_change_password').validate({
          
                errorElement:'span',
               
              
               messages: {
                            current_password:
                            {
                                required:"Pleae enter a current password.",
                                minlength:"Please enter atleast 6 character password.",

                            },   
                            new_password:
                            {
                                required:"Pleae enter a new password.",
                                 minlength:"Please enter atleast 6 character password.",

                            },
                            confirm_password:
                            {
                                required:"Pleae enter a confirm password.",
                                equalTo:'Current password & confirm password should be same.', 
                                minlength:"Please enter atleast 6 character password.",    

                            } 

                                             
                           
                        }
                      
      });

    

   });

  function redirectToBack()
  {
      window.location.href="{{ $module_url_path }}";
  }
 
</script>
@endsection