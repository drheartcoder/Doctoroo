<style>
    .pac-container{z-index: 9999;}
</style>

<!--Signup popup start here-->
<div id="signup-voucher" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt=""></button>
         </div>
         <div class="modal-body bdy-pading">
         <form name="frm_patient_signup_voucher" id="frm_patient_signup_voucher" method="post" action="{{ url('/') }}/patient/signup_voucher/store">
         {{ csrf_field() }}
         <br/>
         <div class="alert-box alert_error alert-dismissible" id="patient_err_msg_signup" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span style="font-size: 20px;">×</span></button>   
         </div>
            <div class="login_box signup2">
              
               <div class="tag-txt green-title">Sign up for free</div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="First Name" name="vfirst_name" id="vfirst_name" maxlength="16" />
                  <div class="err" id="err_vfirst_name" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Last Name" name="vlast_name" id="vlast_name" maxlength="16" />
                  <div class="err" id="err_vlast_name" style="display:none;"></div>
               </div>
               <div class="row">
                  <div class="user_box col-sm-4" style="padding-right: 0px;">
                     <!-- <input type="text" class="input_acct-logn" placeholder="Code" name="vmob_code" id="vmob_code" /> -->
                     <div class="select-style pharma-step-drp">
                     <select class="input_acct-logn" name="vmob_code" id="vmob_code">
                        <option value="">Code</option>
                        @if(!empty($mobcode_data) && isset($mobcode_data))
                           @foreach($mobcode_data as $mobcode)
                              <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == '13') selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                           @endforeach
                        @endif
                     </select>
                     <div class="err" id="err_vmob_code" style="display:none;"></div>
                     </div>
                  </div>
                  <div class="user_box col-sm-8">
                     <input type="text" class="input_acct-logn" placeholder="Mobile" name="vmobile" id="vmobile" min="6" maxlength="14" />
                     <div class="err" id="err_vmobile" style="display:none;"></div>
                  </div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Email Address" name="vemail" id="vemail" />
                  <div class="err" id="err_vemail_msg"></div>
                  <div class="err" id="err_vemail" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="password" class="input_acct-logn" placeholder="Password" name="vpass_word" id="vpass_word" />
                  <div class="err" id="err_vpass_word" style="display:none;"></div>
               </div>

                <div class="user_box">
                  <input type="date" class="input_acct-logn datepicker" placeholder="Date of Birth" name="vdob" id="vdob" />
                  <div class="err" id="err_vdob" style="display:none;"></div>
                </div>
              
                <div class="user_box">
                     <input type="text" class="input_acct-logn" placeholder="Address" name="vstate" id="vstate" />
                     <div class="err" id="err_vstate" style="display:none;"></div>
                </div>
                <p class="green-txt">Have a Friends Code ?</p>
                <div class="user_box">
                  <input type="text" class="input_acct-logn" value="@if(!empty($friend_referral_code) && isset($friend_referral_code)){{$friend_referral_code}}@endif" placeholder="Enter Friends code" name="friends_code" id="friends_code" />
                  <div class="err" id="err_friends_code" style="display:none;"></div>
                  <div class="err" id="err_friends_code_msg"></div>
                  <p class="green-txt" style="display:none;">Isn't Just Amazing !</p>
                  
                  @if(!empty($friend_referral_code) && isset($friend_referral_code))
                     <p class="green-txt">Isn't 
                     @if(!empty($arr_user_details) && isset($arr_user_details)){{$arr_user_details}}@endif Just Amazing !</p>
                  @endif

                </div>
               
                <div class="clearfix"></div>

                <div class="login-bts">
                  <button class="btn btn-search-login border-btn-radius" value="submit" type="button" name="patient_signup_voucher" id="patient_signup_voucher" >Sign up Now</button>
               </div>
               <div class="already-txt">
                  Already a Member? <a data-toggle="modal" href="#login">Sign In</a>
               </div>
                
                <div class="clearfix"></div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--Signup popup end here-->

<!--minor user popup start here-->
<div id="minor" class="modal fade sm-model2" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt=""></button>
         <h4 class="center-align">To Continue a parent or guardian is needed</h4>
         <div class="modal-data">
            <p>Good News - you can still see a doctor &amp; use all the features like all other users!</p>
            <p>Simply ask a parent or guardian to create account in their name (you can help them if needed), and they can add you as a family member - it's that simple!</p>
         </div>
         <div class="modal-footer">
            <a href="#signup-voucher" data-toggle="modal" class="sign-up-par">Sign up as Parent</a>
         </div>
      </div>
   </div>
</div>
<!--minor user popup start here-->

@if(!empty($friend_referral_code) && isset($friend_referral_code) )
<script>
   $(document).ready(function () {
        $('#signup-voucher').modal('show');
    });
</script>
@endif

@include('google_api.google')
<script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
<script>
  $(document).ready(function(){
    var location = "Australia";
    $("#vstate").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
    });

    // Allow only Alphabet Characters
    $('#vfirst_name, #vlast_name').keyup(function() {
        if (this.value.match(/[^a-zA-Z]/g)) {
            this.value = this.value.replace(/[^a-zA-Z]/g, '');
        }
    });
  });
</script>

<script crossorigin="anonymous" src="https://cdn.virgilsecurity.com/packages/javascript/sdk/4.5.1/virgil-sdk.min.js"></script>
<input type="hidden" id="VIRGIL_TOKEN" name="VIRGIL_TOKEN" value="{{ env('VIRGIL_TOKEN') }}" />
<script>
   $(document).ready(function(){
      // Allow only Numeric Characters
      $('#vmobile').keyup(function() {
         $(this).val($(this).val().replace(/[^\d]/,''));
          $(this).keyup(function(){
              $(this).val($(this).val().replace(/[^\d]/,''));
          });
      });

      $('#vemail').on('blur',function(){

            $('#err_vemail').html('');
            var vemail   =  $(this).val();

            var vemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            if($.trim(vemail)!='')
            {
               if(!vemail_filter.test(vemail))
               {
                  $('#err_vemail').show();         
                  $('#err_vemail').html('Please enter valid email id.');
                  $('#err_vemail').fadeOut(4000);
                  $('#vemail').focus();   
                  return false;  
               }
               var token = $('input[name="_token"]').val();
               $.ajax({
                     url   : "{{ url('/') }}/patient/duplicate/email",
                     type : "POST",
                     dataType:'json',
                     data: {_token:token,email_id:vemail},
                     success : function(res){
                        //$("#err_vemail_msg").html(res);
                        if($.trim(res)=='error')
                        {
                           $('#err_vemail').show();
                           $('#err_vemail').html('An account with this email already exists');
                           $('#patient_signup_voucher').attr('disabled',true);
                           $('#vemail').focus();   
                           return false; 
                        }
                        else if($.trim(res)=='success')
                        {
                           $('#err_vemail').show();
                           $('#patient_signup_voucher').attr('disabled',false);
                           return true;
                        }
                        else
                        {
                           $('#err_vemail').show();
                           $('#vemail').focus();
                           $('#err_vemail').html('Something has get wrong please try again later.');
                           return false;
                        }
                     }
               });
            }
      });

      $('#vmobile').on('blur',function(){

            $('#err_vmobile').html('');
            var vmobile   =  $(this).val();
            
            if($.trim(vmobile)!='')
            {
               var token = $('input[name="_token"]').val();

               $.ajax({
                     url   : "{{ url('/') }}/patient/duplicate/mobile_no",
                     type : "POST",
                     dataType:'json',
                     data: {_token:token,mobile_no:vmobile},
                     success : function(res){
                        //$("#err_vemail_msg").html(res);
                        if($.trim(res.status)=='error')
                        {
                           $('#err_vmobile').show();
                           $('#err_vmobile').html(res.msg);
                           $('#patient_signup_voucher').attr('disabled',true);
                         //  $('#vmobile').focus();   
                           return false; 
                        }
                        else if($.trim(res.status)=='success')
                        {
                           $('#err_vmobile').show();
                           $('#patient_signup_voucher').attr('disabled',false);
                           return true;
                        }
                        else
                        {
                           //$('#err_vmobile').show();
                           $('#vmobile').focus();
                           $('#err_vmobile').html('Something went to wrong please try again later.');
                           return false;
                        }
                     }
               });
            }
      });

      $('#patient_signup_voucher').click(function()
      {
         var vfirst_name   =  $('#vfirst_name').val();
         var vlast_name    =  $('#vlast_name').val();
         var vpass_word    =  $('#vpass_word').val();
         var vemail        =  $('#vemail').val();
         var vmob_code     =  $('#vmob_code').val();
         var vmobile       =  $('#vmobile').val();
         var vdob 		   =  $('#vdob').val();
         var vstate        =  $('#vstate').val();
         var friends_code  =  $('#friends_code').val();

         var vemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         var alpha         = /^[a-zA-Z]*$/;
         var mobile_filter = /^[0-9]*$/;

         var today = new Date();
         var curr_date = today.getDate();
         var curr_month = today.getMonth() + 1;
         var curr_year = today.getFullYear();

         var pieces = vdob.split('/');
         var birth_date = pieces[0];
         var birth_month = pieces[1];
         var birth_year = pieces[2];

         if (curr_month == birth_month && curr_date >= birth_date) var age = parseInt(curr_year-birth_year);
         if (curr_month == birth_month && curr_date < birth_date) var age = parseInt(curr_year-birth_year-1);
         if (curr_month > birth_month) var age = parseInt(curr_year-birth_year);
         if (curr_month < birth_month) var age = parseInt(curr_year-birth_year-1);

         if($.trim(vfirst_name)=='')
         {
            $('#err_vfirst_name').show();
            $('#vfirst_name').focus();
            $('#err_vfirst_name').html('Please enter first name.');
            $('#err_vfirst_name').fadeOut(4000);
            return false;
         }  
         else if(!alpha.test(vfirst_name))
         {
            $('#err_vfirst_name').show();
            $('#vfirst_name').focus();
            $('#err_vfirst_name').html('Please enter valid first name.');
            $('#err_vfirst_name').fadeOut(4000);
            return false;
         }   
         else if($.trim(vlast_name)=='')
         {
            $('#err_vlast_name').show();
            $('#vlast_name').focus();
            $('#err_vlast_name').html('Please enter last name.');
            $('#err_vlast_name').fadeOut(4000);
            return false;  
         }
         else if(!alpha.test(vlast_name))
         {
            $('#err_vlast_name').show();
            $('#vlast_name').focus();
            $('#err_vlast_name').html('Please enter valid last name.');
            $('#err_vlast_name').fadeOut(4000);
            return false;  
         }
         else if($.trim(vmob_code)=='')
         {
            $('#err_vmob_code').show();
            $('#vmob_code').focus();
            $('#err_vmob_code').html('Please select code.');
            $('#err_vmob_code').fadeOut(4000);
            return false;  
         }
         else if($.trim(vmobile)=='')
         {
            $('#err_vmobile').show();
            $('#vmobile').focus();
            $('#err_vmobile').html('Please enter mobile number.');
            $('#err_vmobile').fadeOut(4000);
            return false;  
         }
         else if(!mobile_filter.test(vmobile))
         {
            $('#err_vmobile').show();
            $('#vmobile').focus();
            $('#err_vmobile').html('Please enter only numbers.');
            $('#err_vmobile').fadeOut(4000);
            return false;  
         }
         else if($.trim(vemail)=='')
         {
            $('#err_vemail').show();
            $('#vemail').focus();
            $('#err_vemail').html('Please enter your email.');
            $('#err_vemail').fadeOut(4000);
            return false;  
         }
         else if(!vemail_filter.test(vemail))
         {
            $('#err_vemail').show();
            $('#vemail').focus();
            $('#err_vemail').html('Please enter a valid email.');
            $('#err_vemail').fadeOut(4000);
            return false;  
         }
         /*else if($.trim(vemail)!='')
         {
            var token = $('input[name="_token"]').val();
            $.ajax({
                  url   : "{{ url('/') }}/patient/duplicate/email",
                  type : "POST",
                  dataType:'json',
                  data: {_token:token,email_id:vemail},
                  success : function(res){
                     if($.trim(res)=='error')
                     {
                        $('#err_vemail').show();
                        $('#err_vemail').html('An account with this email already exists');
                        $('#vemail').focus();   
                        return false; 
                     }
                  }
            });
         }*/
         else if($.trim(vpass_word)=='')
         {
            $('#err_vpass_word').show();
            $('#vpass_word').focus();
            $('#err_vpass_word').html('Please enter Password.');
            $('#err_vpass_word').fadeOut(4000);
            return false;  
         }
         else if($.trim(vdob)=='')
         {
            $('#err_vdob').show();
            $('#vdob').focus();
            $('#err_vdob').html('Please Select Date of Birth.');
            $('#err_vdob').fadeOut(4000);
            return false;  
         }
         else if(age < 18)
         {
            $('#err_vdob').show();
            $('#err_vdob').html("Your age is less than 18 years, you can't create your account");
            $('#err_vdob').fadeOut(4000);
            return false;
         }
         else if($.trim(vstate)=='')
         {
            $('#err_vstate').show();
            $('#vstate').focus();
            $('#err_vstate').html('Please enter Suburb');
            $('#err_vstate').fadeOut(4000);
            return false;  
         }
         else
         {
              /* Virgil Encryption */
              var VIRGIL_TOKEN = $('#VIRGIL_TOKEN').val(); 

              // generate token
              var api = virgil.API(VIRGIL_TOKEN);
              console.log("api: "+api);

              // generate and save Virgil Key
              var userKey = api.keys.generate();
              console.log("userKey: "+userKey);

              // export Virgil key to string
              var exportedKey = userKey.export().toString("base64");
              console.log("exportedKey: "+exportedKey);
              //$('#txt_userkey').val(exportedKey);

              // create Virgil Card
              var userCard = api.cards.create(vemail, userKey);
              console.log("userCard: "+userCard);

              // export Virgil Card to string
              var exportedCard = userCard.export();
              console.log("exportedCard: "+exportedCard);

              // transmit the Virgil Card to the server
              //var _token = $('input[name="_token"]').val();
              var _token = "{{ csrf_token() }}";

              showProcessingOverlay();
              $.ajax({
                  url: '{{ url("/") }}/publish/card',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      _token: _token,
                      exportedCard: exportedCard,
                      //userKey: userKey,
                      //vemail: vemail
                  },
                  success: function (res) {
                      if (res.status == 'success') {
                          
                          /* Insert In Data */
                          
                          $.ajax({
                                 url:'{{ url("/patient/signup-voucher/store") }}',
                                 type:'POST',
                                 dataType:'json',
                                 data:{_token:_token,
                                        vfirst_name:vfirst_name, 
                                        vlast_name:vlast_name,
                                        vemail:vemail, 
                                        vmob_code:vmob_code, 
                                        vmobile:vmobile, 
                                        vpass_word:vpass_word, 
                                        vstate:vstate, 
                                        friends_code:friends_code, 
                                        vdob:vdob,
                                        virgil_private_key:exportedKey,
                                        virgil_public_key:exportedCard
                                        },
                                 success:function(res){
                                    hideProcessingOverlay();
                                    if(res.response == 'success'  && res.otp_id !='0')
                                    {
                                       $('#otp_id').val(res.otp_id);
                                       $('#password').val(res.password);
                                       $('#email').val(res.email);
                                       $('#verify_otp').modal('show');
                                       
                                       $("a.link_twitter").attr("href", "https://twitter.com/intent/tweet?text=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did%3A&url="+res.referral_url);
                                       $("a.link_fb").attr("href", "https://www.facebook.com/sharer/sharer.php?t=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&u="+res.referral_url);
                                       $("a.link_gplus").attr("href", "https://plus.google.com/share?prefilltext=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url="+res.referral_url);
                                    }
                                    else if(res.response == 'error' || res.response =='exist')
                                    {
                                        $('#patient_err_msg_signup').fadeIn(0, function()
                                         {
                                             $('#patient_err_msg_signup').html(res.message);
                                         }).delay(5000).fadeOut('slow');
                                    }
                                    else if(res.otp_id == '0')
                                    {
                                      $('#patient_err_msg_signup').fadeIn(0, function()
                                      {
                                          $('#patient_err_msg_signup').html(res.message);
                                      }).delay(5000).fadeOut('slow');
                                   }
                                 }
                              });
                              /* End Insert In Data */
                      }
                      else {
                        hideProcessingOverlay();
                        alert('Something went wrong');
                      }
                  }
              });

            /* End Virgil Encryption */



           /*showProcessingOverlay();
            
            $.ajax({
               url:'{{ url("/patient/signup-voucher/store") }}',
               type:'POST',
               dataType:'json',
               data:{_token:token, vfirst_name:vfirst_name, vlast_name:vlast_name, vemail:vemail, vmob_code:vmob_code, vmobile:vmobile, vpass_word:vpass_word, vstate:vstate, friends_code:friends_code, vdob:vdob },
               success:function(res){
                  hideProcessingOverlay();
                  if(res.response == 'success'  && res.otp_id !='0')
                  {
                     $('#otp_id').val(res.otp_id);
                     $('#password').val(res.password);
                     $('#email').val(res.email);
                     $('#verify_otp').modal('show');
                     
                     $("a.link_twitter").attr("href", "https://twitter.com/intent/tweet?text=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did%3A&url="+res.referral_url);
                     $("a.link_fb").attr("href", "https://www.facebook.com/sharer/sharer.php?t=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&u="+res.referral_url);
                     $("a.link_gplus").attr("href", "https://plus.google.com/share?prefilltext=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url="+res.referral_url);
                  }
                  else if(res.response == 'error' || res.response =='exist')
                  {
                      $('#patient_err_msg_signup').fadeIn(0, function()
                       {
                           $('#patient_err_msg_signup').html(res.message);
                       }).delay(5000).fadeOut('slow');
                  }
                  else if(res.otp_id == '0')
                  {
                     $('#patient_err_msg_signup').fadeIn(0, function()
                    {
                        $('#patient_err_msg_signup').html(res.message);
                    }).delay(5000).fadeOut('slow');
                 }
               }
            });*/
         }
      });
      // on manually enter friend code
      $('#friends_code').on('blur',function(){
         $('#patient_signup_voucher').attr('disabled',false);
         $('#err_friends_code').html('');
         var friends_code   =  $(this).val();
         if($.trim(friends_code) != '')
         {
            var token = $('input[name="_token"]').val();
            $.ajax({
                  url   : "{{ url('/') }}/patient/check_code/friends_code",
                  type : "POST",
                  dataType:'json',
                  data: {_token:token,friends_code:friends_code},
                  success : function(res){
                     if($.trim(res.status)=='error')
                     {
                        $('#err_friends_code').show();         
                        
                        $('#err_friends_code').html('Enter Referral Code is does not exists');
                        $('#patient_signup_voucher').attr('disabled',true);
                        $('#friends_code').focus();   
                        return false;
                     }
                     else if($.trim(res.status)=='success')
                     {
                        $('#err_friends_code').show();
                        $('#err_friends_code').html("<p class='green-txt'>Isn't "+res.username+" Just Amazing !</p>");
                        $('#patient_signup_voucher').attr('disabled',false);
                        return true;
                     }
                     else
                     {
                        $('#err_friends_code').show();
                        $('#friends_code').focus();
                        $('#err_friends_code').html('Something has get wrong please try again later.');
                        $('#patient_signup_voucher').attr('disabled',false);
                        return false;
                     }
                  }
            });
         }
      });

   });
</script>

<!--  Scripts-->
<script src="{{ url('/') }}/public/new/js/picker.js"></script>
<script src="{{ url('/') }}/public/new/js/picker.date.js"></script>

<script>
  $( '.datepicker' ).pickadate({
    labelMonthNext: 'Go to the next month',
    labelMonthPrev: 'Go to the previous month',
    labelMonthSelect: 'Pick a month from the dropdown',
    labelYearSelect: 'Pick a year from the dropdown',
    selectMonths: true,
    selectYears: true,
    format: 'dd/mm/yyyy',
    formatSubmit: 'yyyy-mm-dd',
    defaultValue: false,
    selectYears: 150, // `true` defaults to 10.
    //min: [2015,3,20],
    max: new Date(),
    onOpen: function() {
      console.log( 'Opened')
    },
    onClose: function() {
      console.log( 'Closed ' + this.$node.val() )
      var selected_date = this.$node.val();

      var today = new Date();
	   var curr_date = today.getDate();
	   var curr_month = today.getMonth() + 1;
	   var curr_year = today.getFullYear();

	   var pieces = selected_date.split('/');
	   var birth_date = pieces[0];
	   var birth_month = pieces[1];
	   var birth_year = pieces[2];

	   if (curr_month == birth_month && curr_date >= birth_date) var age = parseInt(curr_year-birth_year);
	   if (curr_month == birth_month && curr_date < birth_date) var age = parseInt(curr_year-birth_year-1);
	   if (curr_month > birth_month) var age = parseInt(curr_year-birth_year);
	   if (curr_month < birth_month) var age = parseInt(curr_year-birth_year-1);

	   if(age < 18)
      {
         $('#minor').modal('show');
         $('#patient_signup_voucher').attr('disabled',true);
      }
      else
      {
         $('#patient_signup_voucher').attr('disabled',false);
      }
	   
    },
    onSelect: function() {
      console.log( 'Selected: ' + this.$node.val() )
    },
    onStart: function() {
      console.log( 'Hello there :)' )
    }
  })
</script>

<script src="{{ url('/') }}/public/new/js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/public/new/js/materialize.js"></script>
<link href="{{ url('/') }}/public/css/datepicker.css" rel="stylesheet" media="screen,projection" />
