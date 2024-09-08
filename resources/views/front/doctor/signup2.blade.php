<script>
   var url = window.location.hash;
   if(url != '')
   {
      setTimeout(function(){
        $('#join-doc-popup').modal('show');   
      },2000);
   }
</script>
      
<script src='https://www.google.com/recaptcha/api.js'></script>

<!--join doctor poup start-->
      <div id="join-doc-popup" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal"><img src="https://www.doctoroo.com.au/images/close-popup.png" alt="Close Pop up"/></button>
               </div>
               <form name="frm_doctor_signup" name="frm_doctor_signup" method="post" action="https://www.doctoroo.com.au/doctor/signup/store" data-captcha-type="recaptcha_v2" enctype="multipart/form-data">
               <input type="hidden" name="_token" value="BCrgFJOhm4X0xqEfE59dZGjTPM73qEfln3kCYhnS">
               <div class="modal-body bdy-pading">
                  <div class="login_box">
                     <div class="title_login">Join doctoroo</div>
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="First Name *" name="first_name" id="first_name" />
                                <div class="err" style="display:none;" id="err_first_name"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Last Name *" name="last_name" id="last_name" />
                                <div class="err" style="display:none;" id="err_last_name"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                                 <select class="frm-select" name="speciality" id="speciality">
                                    <option value="">Select Speciality</option>
                                                                                                                     <option value="GP  (General Practitioner)">GP  (General Practitioner)</option>
                                        
                                                                     </select>
                              </div>
                                <div class="err" style="display:none;" id="err_speciality"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Email *" name="email" id="email" />
                                <div class="err" style="display:none;" id="err_email"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Phone Number" name="phone_number" id="phone_number" />
                                <div class="err" style="display:none;" id="err_phone_number"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                                 <select class="frm-select" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                 </select>
                              </div>
                                <div class="err" style="display:none;" id="err_gender"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                                 <select class="frm-select" name="language" id="language">
                                    <option value="">Select Spoken languages</option>
                                                                                                                        <option value="English">English</option>
                                                                                                            </select>
                              </div>
                                <div class="err" style="display:none;" id="err_language"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box" >
                              <!-- <input type="text" class="input_acct-logn" placeholder="Practice address" name="suburb" id="autocomplete" onfocus="geolocate()" value="" /> -->
                              <input type="text" class="input_acct-logn" placeholder="Practice address *" name="suburb" id="suburb" value="" />
                              <div class="err" style="display:none;" id="err_suburb"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Medical Qualification" name="medical_qualification" id="medical_qualification" />
                                <div class="err" style="display:none;" id="err_medical_qualification"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                              <select class="frm-select" name="practitioning_experience" id="practitioning_experience">
                                    <option value="">Select Practicing Experience</option>
                                                                           <option value="0">0 Year(s)</option>
                                                                           <option value="1">1 Year(s)</option>
                                                                           <option value="2">2 Year(s)</option>
                                                                           <option value="3">3 Year(s)</option>
                                                                           <option value="4">4 Year(s)</option>
                                                                           <option value="5">5 Year(s)</option>
                                                                           <option value="6">6 Year(s)</option>
                                                                           <option value="7">7 Year(s)</option>
                                                                           <option value="8">8 Year(s)</option>
                                                                           <option value="9">9 Year(s)</option>
                                                                           <option value="10">10 Year(s)</option>
                                                                           <option value="11">11 Year(s)</option>
                                                                           <option value="12">12 Year(s)</option>
                                                                           <option value="13">13 Year(s)</option>
                                                                           <option value="14">14 Year(s)</option>
                                                                           <option value="15">15 Year(s)</option>
                                                                           <option value="16">16 Year(s)</option>
                                                                           <option value="17">17 Year(s)</option>
                                                                           <option value="18">18 Year(s)</option>
                                                                           <option value="19">19 Year(s)</option>
                                                                           <option value="20">20 Year(s)</option>
                                                                           <option value="21">21 Year(s)</option>
                                                                           <option value="22">22 Year(s)</option>
                                                                           <option value="23">23 Year(s)</option>
                                                                           <option value="24">24 Year(s)</option>
                                                                           <option value="25">25 Year(s)</option>
                                                                           <option value="26">26 Year(s)</option>
                                                                           <option value="27">27 Year(s)</option>
                                                                           <option value="28">28 Year(s)</option>
                                                                           <option value="29">29 Year(s)</option>
                                                                           <option value="30">30 Year(s)</option>
                                                                           <option value="31">31 Year(s)</option>
                                                                           <option value="32">32 Year(s)</option>
                                                                           <option value="33">33 Year(s)</option>
                                                                           <option value="34">34 Year(s)</option>
                                                                           <option value="35">35 Year(s)</option>
                                                                           <option value="36">36 Year(s)</option>
                                                                           <option value="37">37 Year(s)</option>
                                                                           <option value="38">38 Year(s)</option>
                                                                           <option value="39">39 Year(s)</option>
                                                                           <option value="40">40 Year(s)</option>
                                                                           <option value="41">41 Year(s)</option>
                                                                           <option value="42">42 Year(s)</option>
                                                                           <option value="43">43 Year(s)</option>
                                                                           <option value="44">44 Year(s)</option>
                                                                           <option value="45">45 Year(s)</option>
                                                                           <option value="46">46 Year(s)</option>
                                                                           <option value="47">47 Year(s)</option>
                                                                           <option value="48">48 Year(s)</option>
                                                                           <option value="49">49 Year(s)</option>
                                                                           <option value="50">50 Year(s)</option>
                                                                           <option value="51">51 Year(s)</option>
                                                                           <option value="52">52 Year(s)</option>
                                                                           <option value="53">53 Year(s)</option>
                                                                           <option value="54">54 Year(s)</option>
                                                                           <option value="55">55 Year(s)</option>
                                                                           <option value="56">56 Year(s)</option>
                                                                           <option value="57">57 Year(s)</option>
                                                                           <option value="58">58 Year(s)</option>
                                                                           <option value="59">59 Year(s)</option>
                                                                           <option value="60">60 Year(s)</option>
                                                                           <option value="61">61 Year(s)</option>
                                                                           <option value="62">62 Year(s)</option>
                                                                           <option value="63">63 Year(s)</option>
                                                                           <option value="64">64 Year(s)</option>
                                                                           <option value="65">65 Year(s)</option>
                                                                           <option value="66">66 Year(s)</option>
                                                                           <option value="67">67 Year(s)</option>
                                                                           <option value="68">68 Year(s)</option>
                                                                           <option value="69">69 Year(s)</option>
                                                                           <option value="70">70 Year(s)</option>
                                                                           <option value="71">71 Year(s)</option>
                                                                           <option value="72">72 Year(s)</option>
                                                                           <option value="73">73 Year(s)</option>
                                                                           <option value="74">74 Year(s)</option>
                                                                           <option value="75">75 Year(s)</option>
                                                                           <option value="76">76 Year(s)</option>
                                                                           <option value="77">77 Year(s)</option>
                                                                           <option value="78">78 Year(s)</option>
                                                                           <option value="79">79 Year(s)</option>
                                                                           <option value="80">80 Year(s)</option>
                                                                           <option value="81">81 Year(s)</option>
                                                                           <option value="82">82 Year(s)</option>
                                                                           <option value="83">83 Year(s)</option>
                                                                           <option value="84">84 Year(s)</option>
                                                                           <option value="85">85 Year(s)</option>
                                                                           <option value="86">86 Year(s)</option>
                                                                           <option value="87">87 Year(s)</option>
                                                                           <option value="88">88 Year(s)</option>
                                                                           <option value="89">89 Year(s)</option>
                                                                           <option value="90">90 Year(s)</option>
                                                                           <option value="91">91 Year(s)</option>
                                                                           <option value="92">92 Year(s)</option>
                                                                           <option value="93">93 Year(s)</option>
                                                                           <option value="94">94 Year(s)</option>
                                                                           <option value="95">95 Year(s)</option>
                                                                           <option value="96">96 Year(s)</option>
                                                                           <option value="97">97 Year(s)</option>
                                                                           <option value="98">98 Year(s)</option>
                                                                           <option value="99">99 Year(s)</option>
                                     
                              </select>

                              
                              </div>
                                <div class="err" style="display:none;" id="err_practitioning_experience"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Provider Number" name="provider_number" id="provider_number" />
                                <div class="err" style="display:none;" id="err_provider_number"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box ahpra_div" style="display: none">
                              <input type="text" class="input_acct-logn" placeholder="AHPRA Registration Number" name="AHPRA" id="AHPRA" />
                                <div class="err" style="display:none;" id="err_AHPRA"></div>
                           </div>
                        </div>
                        <script>
                          $(document).ready(function() {
                            $('.click_check').click(function(){ 
                                $(".ahpra_div").toggle();
                            });
                          });
                        </script>
                        <div class="col-sm-12 col-md-12 col-lg-12 request-details-bx1">
                           <div class="check-box pharmacy-signup2 join-dc">
                              <input type="checkbox" class="css-checkbox click_check" id="register_ahpra" name="register_ahpra" value="1"  />
                              <label class="css-label lite-red-check remember_me"  for="register_ahpra">Are you registered with AHPRA?</label>
                               <div class="err" style="display:none;" id="err_register_ahpra"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 request-details-bx1">
                           <div class="check-box pharmacy-signup2 join-dc">
                              <input type="checkbox" class="css-checkbox" id="legally_telemedicine" name="legally_telemedicine" value="1" />
                              <label class="css-label lite-red-check remember_me"  for="legally_telemedicine">Are you legally able to provide telemedicine services to patient's in Australia?</label>
                              <div class="err" style="display:none;" id="err_legally_telemedicine"></div>
                           </div>
                           <br/>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 request-details-bx1">
                           <div class="check-box pharmacy-signup2 join-dc">
                              <input type="checkbox" class="css-checkbox" id="ABN_invited" name="ABN_invited" value="1" />
                              <label class="css-label lite-red-check remember_me"  for="ABN_invited">Do you have an ABN or do you agree to get an ABN should be invited to our platform?</label>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="g-recaptcha" data-sitekey="6Lc0pTAUAAAAAOp62VVfz_xwwKLseWMr77Krm5-a"></div>
                     <br/>
                     <div class="login-bts text-center">
                        <button class="details-btn select-btn" value="submit" type="submit" name="doctor_signup" id="doctor_signup">Signup</button>
                     </div>
                     <p class="join-frm-txt">By proceeding, I agree that doctoroo or its representatives may contact me by email, phone, or SMS at the email address or number I provide, including for marketing purposes. I have read and understand the Doctor Privacy Statement.</p>
                     <div class="clearfix"></div>
                  </div>
               </div>
               </form>
            </div>
         </div>
      </div>


      <style>
         .pac-container.pac-logo {
             z-index: 9999 !important;

         }
      </style>

<script>
  $(document).ready(function(){
    var location = "Australia";
    $("#suburb").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
    });

    $("#doctor_signup").click(function(){
      var errorDivs = document.getElementsByClassName("recaptcha-error");
      if (errorDivs.length)
      {
        //errorDivs[0].className = "";
        alert("error");
      }
      var errorMsgs = document.getElementsByClassName("recaptcha-error-message");
      if (errorMsgs.length)
      {
        //errorMsgs[0].parentNode.removeChild(errorMsgs[0]);
        alert("success");
      }
    });

  });
</script>
<!--join doctor popup end-->  
<script>

   $(document).ready(function(){

   $('#email').blur(function(){
      var email   =  $(this).val();
      $('#doctor_signup').attr('disabled',false);
      $('#err_email').html('');
      var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      
      if($.trim(email)!='')
      {
         if(!email_filter.test(email))
         {
            $('#err_email').show();
            $('#email').focus();
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            return false;  
         }

         $.ajax({
               url   : "https://www.doctoroo.com.au/doctor/duplicate/email",
               type : "GET",
               data: {email_id:email},
               success : function(res){
                  if($.trim(res)=='error')
                  {
                     $('#err_email').show();
                     $('#email').focus();
                     $('#err_email').html('Email id already exist');
                     $('#doctor_signup').attr('disabled',true);
                     return false;
                  }
                  else if($.trim(res)=='success')
                  {
                     $('#err_email').show();
                     //$('#err_email').html('<span style="color:green !important;">Email id Available</span>');
                     $('#doctor_signup').attr('disabled',false);
                     return true;
                  }
               }
         });
      }
   });

    /*$('#phone_number').keyup(function()
     {
         num = $(this).val().replace(/\D/g,''); 
         $(this).val('('+num.substring(0,2) + ') ' + num.substring(2,6) + ' ' + num.substring(6,10)); 
        //this.value = this.value.replace(/(\d{2})\-?(\d{4})\-?(\d{4})/,'$1 $2 $3');
     });*/

      $('#doctor_signup').click(function(){
      var first_name =  $('#first_name').val();
      var last_name  =  $('#last_name').val();
      var speciality =  $('#speciality').val();
      var email      =  $('#email').val();
      var phone_number= $('#phone_number').val();
      var gender     =  $('#gender').val();
      var language   =  $('#language').val();
      var suburb     =  $('#suburb').val();
      var medical_qualification  =  $('#medical_qualification').val();
      var practitioning_experience = $('#practitioning_experience').val();
      /*var provider_number  =  $('#provider_number').val();*/
      var register_ahpra              = $("#register_ahpra").is(":checked");
      var AHPRA      = $('#AHPRA').val();
      var legally_telemedicine              = $("#legally_telemedicine").is(":checked");
      var provider_number_filter = /^\d{3,}\d{1}[A-Z]{2}$/;
      var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var alpha = /^[a-zA-Z]*$/;
      var integers = /^[0-9]*$/;

      if($.trim(first_name)=='')
      {
         $('#err_first_name').show();
         $('#first_name').focus();
         $('#err_first_name').html('Please enter first name.');
         $('#err_first_name').fadeOut(4000);
         return false;
      }   
      else if(!alpha.test(first_name))
      {
         $('#err_first_name').show();
         $('#first_name').focus();
         $('#err_first_name').html('Please enter valid first name.');
         $('#err_first_name').fadeOut(4000);
         return false;
      } 
      else if($.trim(last_name)=='')
      {
         $('#err_last_name').show();
         $('#last_name').focus();
         $('#err_last_name').html('Please enter last name.');
         $('#err_last_name').fadeOut(4000);
         return false;  
      }
      else if(!alpha.test(last_name))
      {
         $('#err_last_name').show();
         $('#last_name').focus();
         $('#err_last_name').html('Please enter valid last name.');
         $('#err_last_name').fadeOut(4000);
         return false;  
      }
      /*else if($.trim(speciality)=='')
      {
         $('#err_speciality').show();
         $('#speciality').focus();
         $('#err_speciality').html('Please select speciality.');
         $('#err_speciality').fadeOut(4000);
         return false;  
      }*/
      if($.trim(email)=='')
      {
         $('#err_email').show();
         $('#email').focus();
         $('#err_email').html('Please enter email id.');
         $('#err_email').fadeOut(4000);
         return false;  
      }
      else if(!email_filter.test(email))
      {
         $('#err_email').show();
         $('#email').focus();
         $('#err_email').html('Please enter valid email id.');
         $('#err_email').fadeOut(4000);
         return false;  
      }/*
      else if($.trim(phone_number)=='')
      {
         $('#err_phone_number').show();
         $('#phone_number').focus();
         $('#err_phone_number').html('Please enter phone number.');
         $('#err_phone_number').fadeOut(4000);
         return false;  
      }
      else if(!integers.test(phone_number))
      {
         $('#err_phone_number').show();
         $('#phone_number').focus();
         $('#err_phone_number').html('Please enter only numbers.');
         $('#err_phone_number').fadeOut(4000);
         return false;    
      }*/
      /*else if(phone_number=='()  ' || phone_number.length<14)
      {
         $('#err_phone_number').show();
         $('#phone_number').focus();
         $('#err_phone_number').html('Please enter valid phone number.');
         $('#err_phone_number').fadeOut(4000);
         return false;  
      }*/
      
      /*else if($.trim(gender)=='')
      {
         $('#err_gender').show();
         $('#gender').focus();
         $('#err_gender').html('Please select gender.');
         $('#err_gender').fadeOut(4000);
         return false;  
      }*/
      /*else if($.trim(language)=='')
      {
         $('#err_language').show();
         $('#language').focus();
         $('#err_language').html('Please select language.');
         $('#err_language').fadeOut(4000);
         return false;  
      }*/
      else if($.trim(suburb)=='')
      {
         $('#err_suburb').show();
         $('#suburb').focus();
         $('#err_suburb').html('Please enter suburb.');
         $('#err_suburb').fadeOut(4000);
         return false;  
      }
      /*else if($.trim(medical_qualification)=='')
      {
         $('#err_medical_qualification').show();
         $('#medical_qualification').focus();
         $('#err_medical_qualification').html('Please enter medical qualification.');
         $('#err_medical_qualification').fadeOut(4000);
         return false;  
      }
      else if($.trim(practitioning_experience)=='')
      {
         $('#err_practitioning_experience').show();
         $('#practitioning_experience').focus();
         $('#err_practitioning_experience').html('Please enter practitioning experience.');
         $('#err_practitioning_experience').fadeOut(4000);
         return false;  
      }
      else if($.trim(provider_number)=='')
      {
         $('#err_provider_number').show();
         $('#provider_number').focus();
         $('#err_provider_number').html('Please enter provider number.');
         $('#err_provider_number').fadeOut(4000);
         return false;  
      }
      else if(!provider_number_filter.test(provider_number))
      {
         $('#err_provider_number').show();
         $('#provider_number').focus();
         $('#err_provider_number').html('Please enter a valid provider number.');
         $('#err_provider_number').fadeOut(4000);
         return false;  
      }*/
      /*if(register_ahpra == true)
      {
        if($.trim(AHPRA)=='')
        {
           $('#err_AHPRA').show();
           $('#AHPRA').focus();
           $('#err_AHPRA').html('Please enter AHPRA number.');
           $('#err_AHPRA').fadeOut(4000);
           return false;  
        } 
      }
      else if(legally_telemedicine == false)
      {
         $('#err_legally_telemedicine').show();
         $('#legally_telemedicine').focus();
         $('#err_legally_telemedicine').html('Please select legally telemedicine.');
         $('#err_legally_telemedicine').fadeOut(4000);
         return false;  
      }*/
      else
      {
         return true;
      }
      
     });
   });
</script>
