@extends('front.pharmacy.layout.master')                
@section('main_content')

	   
      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
      <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">

          @include('front.pharmacy.layout.profile_layout._profile_sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Change Password</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>
                    <form method="post" action="{{ $module_url_path }}/update_password" enctype="multipart/form-data" id="frm_update_password_id" name="frm_update_password_id"> 
                    {{ csrf_field() }}
                     <div class="col-sm-12 col-md-12 col-lg-12">
                       @include('front.layout._operation_status')
                        <div class="doc-dash-right-bx">
                         <br/>
                          <div class="uer-bxx">
                              <div class="row">
                                 <div class="col-sm-12 col-md-4 col-lg-2">
                                    <div class="frm-label">Current Password <span style="color:red;">*</span></div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="password" name="current_password"  data-rule-required='true' minlength="6" class="frm-in" placeholder="Current Password" />
                                    <span class='err'>{{ $errors->first('current_password') }}</span>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                            </div>
                            <div class="uer-bxx">
                              <div class="row">
                                 <div class="col-sm-12 col-md-4 col-lg-2">
                                    <div class="frm-label">New Password <span style="color:red;">*</span></div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="password" name="new_password" id="new_password" minlength="6" data-rule-required='true'   class="frm-in" placeholder="New Password" />
                                    <span class='err'>{{ $errors->first('new_password') }}</span>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                            </div>
                            <div class="uer-bxx">
                              <div class="row">
                                 <div class="col-sm-12 col-md-4 col-lg-2">
                                    <div class="frm-label">Confirm Password <span style="color:red;">*</span></div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="password" class="frm-in" minlength="6" equalTo="#new_password" data-rule-required='true' name="confirm_password" placeholder="Confirm Password" />
                                    <span class='err'>{{ $errors->first('confirm_password') }}</span>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                            </div>
                            <hr/>
                            <div class="uer-bxx">
                              <div class="row">
                                 <div class="col-sm-12 col-md-4 col-lg-2">
                                    <div class="frm-label hidden-xs hidden-sm">&nbsp;</div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5">
                                    <div class="pre-btn">
                                 <!--  <div class="btn-grn" style="padding: 0px;">-->
                                      <input type="submit" class="btn-grn" name="btn_change_password" id="btn_change_password" value="Submit">
                                  <!-- </div>-->
                               </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                            </div>
                          <!-- <div class="row">
                             <div class="hidden-xs col-sm-2 col-md-2 col-lg-3">&nbsp;</div>
                              <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="password" name="current_password"  data-rule-required='true' minlength="6" class="input_acct-logn" placeholder="Current Password*" />

                                           <span class='err'>{{ $errors->first('current_password') }}</span>

                                       </div>
                                       <div class="user_box">
                                          <input type="password" name="new_password" id="new_password" minlength="6" data-rule-required='true'   class="input_acct-logn" placeholder="New Password*" />

                                          <span class='err'>{{ $errors->first('new_password') }}</span>
                                       </div>
                                   
                                        <div class="user_box">
                                          <input type="password" class="input_acct-logn" minlength="6" equalTo="#new_password" data-rule-required='true' name="confirm_password" placeholder="Confirm Password*" />
                                         <span class='err'>{{ $errors->first('confirm_password') }}</span>
                                       </div>

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                               <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">&nbsp;</div>
                              <div class="col-sm-12">
                                   <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                      <input type="submit" class="btn-grn" style="margin:0 auto 30px;" name="btn_change_password" id="btn_change_password" value="Submit">
                                   </div>
                              </div>


                           </div>-->
                            </div>
                         </div>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--calender section end-->  
        <script>
         
    $(document).ready(function(){


      $('#frm_update_password_id').validate({
          
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

 
</script>
@endsection