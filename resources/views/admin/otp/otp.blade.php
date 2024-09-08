<!-- Otp Send -->
<div id="verify_otp" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">
            <img src="{{ url('/') }}/public/images/close-popup.png" alt="">
            </button>
         </div>

         <div class="modal-body bdy-pading">
             <br/>
               <div class="alert-box alert_error alert-dismissible" id="admin_error_msg" style="display: none;color:red">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>

                <div class="alert-box alert_success alert-dismissible" id="admin_success_msg" style="display: none;color:green">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>
               <form>
               <div class="login_box">
                  <div class="title_login">Verify OTP</div>
                  <div class="tag-txt">Check your registered mobile number</div>
                  <div class="user_box">
                     <input type="text" class="input_acct-logn" placeholder="Enter OTP" name="otp" id="otp"  value="" maxlength="6" >
                     <div class="otp_err" style="color:red;"></div>
                  </div>
                  
                  <div class="clearfix"></div>
                  <div class="login-bts">
                     <button class="btn btn-search-login border-btn-radius" value="" type="button" id="btn_verify_otp" >Verify OTP</button>
                  </div>

                  <div class="already-txt">
                         Didn't get OTP ? <a data-toggle="modal" href="" id="btn_resend_otp">Resend</a>
                      </div>
                  
                  <div class="main-social text-center">
                     <br/>
                     <br/>
                  <div class="clearfix"></div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End Otp Send -->
