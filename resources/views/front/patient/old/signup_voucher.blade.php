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
            <div class="login_box signup2">
              
               <div class="tag-txt green-title">Sign up for free</div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="First Name" name="vfirst_name" id="vfirst_name" />
                  <div class="err" id="err_vfirst_name" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Last Name" name="vlast_name" id="vlast_name" />
                  <div class="err" id="err_vlast_name" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Mobile" name="vmobile" id="vmobile" />
                  <div class="err" id="err_vmobile" style="display:none;"></div>
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
                    <!-- <div class="select-style pharma-step-drp">
                        <select class="frm-select input_acct-logn" name="vstate" id="vstate">
                           <option value="">State or Territory</option>
                           @if(isset($get_states) && sizeof($get_states)>0)
                              @foreach($get_states as $states)
                                 <option value="{{$states['id']}}">{{$states['name']}}</option>
                              @endforeach
                           @endif
                        </select>
                        <input type="text" class="input_acct-logn" placeholder="Suburb" name="vstate" id="autocomplete" onfocus="geolocate()" />
                        <div class="err" id="err_vstate" style="display:none;"></div>
                    </div> -->
                     <input type="text" class="input_acct-logn" placeholder="Suburb" name="vstate" id="vstate" />
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
                  <button class="btn btn-search-login" value="submit" type="button" name="patient_signup_voucher" id="patient_signup_voucher" >Sign up Now</button>
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

  });
</script>

<script>

   $(document).ready(function(){
      
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
                           //$('#err_pemail').fadeOut(4000);
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

      $('#patient_signup_voucher').click(function()
      {
         var vfirst_name   =  $('#vfirst_name').val();
         var vlast_name    =  $('#vlast_name').val();
         var vpass_word    =  $('#vpass_word').val();
         var vemail        =  $('#vemail').val();
         var vmobile       =  $('#vmobile').val();
         var vstate        =  $('#vstate').val();
         var friends_code  =  $('#friends_code').val();
         var vemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         var alpha         = /^[a-zA-Z]*$/;
         var mobile_filter = /^[0-9]*$/;

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
         else if($.trim(vpass_word)=='')
         {
            $('#err_vpass_word').show();
            $('#vpass_word').focus();
            $('#err_vpass_word').html('Please enter Password.');
            $('#err_vpass_word').fadeOut(4000);
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
            showProcessingOverlay();
            var token = $('input[name="_token"]').val();
            
            $.ajax({
               url:'{{ url("/patient/signup_voucher/store") }}',
               type:'POST',
               dataType:'json',
               data:{_token:token, vfirst_name:vfirst_name, vlast_name:vlast_name, vemail:vemail, vmobile:vmobile, vpass_word:vpass_word, vstate:vstate, friends_code:friends_code },
               success:function(res){
                  if(res.response == 'success')
                  {
                     hideProcessingOverlay();
                     $('#referral_share').modal('show');
                     $('#referral_code').val(res.randomString);
                     $('#referral_url').val(res.referral_url);

                     $("a.link_skype").attr("data-href", res.referral_url);
                     //$("a.link_gmail").attr("href", res.referral_url);
                     $("a.link_twitter").attr("href", "https://twitter.com/intent/tweet?text=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url="+res.referral_url);
                     $("a.link_fb").attr("href", "https://www.facebook.com/sharer/sharer.php?t=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&u="+res.referral_url);
                     $("a.link_gplus").attr("href", "https://plus.google.com/share?prefilltext=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url="+res.referral_url);
                     //$("a.link_whatsapp").attr("href", "https://api.whatsapp.com/send?phone="+res.moblie+"&text="+res.referral_url);
                  }
               }
            });
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