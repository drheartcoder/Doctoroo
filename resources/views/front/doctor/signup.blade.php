
<!--join doctor poup start-->
      <div id="join-doc-popup" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up"/></button>
               </div>
               <form name="frm_doctor_signup" id="frm_doctor_signup" method="post" action="{{ url('/') }}/doctor/signup/store">
               {{ csrf_field() }}
               <div class="modal-body bdy-pading">
                  <div class="login_box">
                     <div class="title_login">Join doctoroo</div>
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="First Name" name="first_name" id="first_name" maxlength="16" />
                                <div class="err" style="display:none;" id="err_first_name"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Last Name" name="last_name" id="last_name" maxlength="16" />
                                <div class="err" style="display:none;" id="err_last_name"></div>
                           </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn txt_unique_email" placeholder="Email" name="doc_email" id="doc_email" />
                                <div class="err" style="display:none;" id="err_doc_email"></div>
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
                              <select class="input_acct-logn" name="mobile_code" id="mobile_code">
                                <option value="">Code</option>
                                  @if(!empty($mobcode_data) && isset($mobcode_data))
                                    @foreach($mobcode_data as $mobcode)
                                      <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == '13') selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                    @endforeach
                                  @endif
                                </select>
                              <div class="err" id="err_mobile_code" style="display:none;"></div>
                            </div>
                           </div>
                        </div>
                         
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Phone Number" name="phone_number" id="phone_number" />
                              <div class="err" id="err_phone_number" style="display:none;"></div>
                           </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                                 <select class="frm-select" name="speciality" id="speciality">
                                    <option value="">Select Speciality</option>
                                    @if(count($arr_speciality)>0)
                                       @foreach($arr_speciality as $speci)
                                          <option value="<?php echo $speci['speciality']; ?>"><?php echo $speci['speciality']; ?></option>
                                       @endforeach 
                                    @endif
                                 </select>
                              </div>
                                <div class="err" style="display:none;" id="err_speciality"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                              <select class="frm-select" name="practitioning_experience" id="practitioning_experience">
                                    <option value="">Select Practicing Experience</option>
                                    <?php for($i=0;$i<100;$i++)
                                    {?>
                                       <option value="<?php echo $i; ?>"><?php echo $i." Year(s)"; ?></option>
                                    <?php } ?> 
                              </select>
                              </div>
                                <div class="err" style="display:none;" id="err_practitioning_experience"></div>
                           </div>
                        </div>                        
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box" >
                              <input type="text" class="input_acct-logn" placeholder="Practice address" name="suburb" id="suburb" value="" />
                              <div class="err" style="display:none;" id="err_suburb"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Medical Qualification" name="medical_qualification" id="medical_qualification" />
                                <div class="err" style="display:none;" id="err_medical_qualification"></div>
                           </div>

                        </div>


                        <!-- <select name="language[]" id="language" multiple="multiple">
                          <option value="">Select Spoken languages</option>
                          @if(count($arr_language)>0)
                             @foreach( $arr_language as $lang)
                                   <option value="<?php echo $lang['language']; ?>"><?php echo $lang['language']; ?></option>
                             @endforeach
                          @endif
                        </select>

                        
                        <script>                      
                           $('#language').multiselect(
                           {
                                enableFiltering: true,
                                filterPlaceholder: 'Search for something...'
                           });
                        </script> -->


                        <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="select-style pharma-step-drp">
                                 <select name="language" id="language" multiple="multiple">
                                    <option value="">Select Spoken languages</option>
                                    @if(count($arr_language)>0)
                                       @foreach( $arr_language as $lang)
                                             <option value="<?php echo $lang['language']; ?>"><?php echo $lang['language']; ?></option>
                                       @endforeach
                                    @endif
                                 </select>
                              </div>
                                <div class="err" style="display:none;" id="err_language"></div>
                           </div>
                        </div> -->
                        
                        

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="user_box">
                              <div class="select-style pharma-step-drp multi-select-block lang-drop-wraper">
                                    <div class="assignment-gray-main">
                                        <select name="language[]" id="language" class="js-example-basic-multiple lang-drop" multiple="multiple">
                                          <!-- <option value="" disabled selected>Select Spoken languages</option> -->
                                          @if(count($arr_language)>0)
                                            @foreach( $arr_language as $lang)
                                              <option value="<?php echo $lang['id']; ?>"><?php echo $lang['language']; ?></option>
                                            @endforeach
                                          @endif
                                          <option value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                         </div>

                         <script>
                         $(document).ready(function(){
                           $('#language').change(function(){
                              if ($("#language option[value=Other]:selected").length > 0){
                                $('.other_lang').show();
                              } else {
                                $('.other_lang').hide();
                              }
                           });
                         });
                         </script>

                        
                        <div class="col-sm-12 col-md-6 col-lg-6 other_lang" style="display:none;">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="eg. Marathi, Hindi, English" name="other_languages" id="other_languages" />
                                <div class="err" style="display:none;" id="err_other_languages"></div>
                           </div>
                        </div>



                         <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <input type="text" class="input_acct-logn" placeholder="Provider Number" name="provider_number" id="provider_number" />
                                <div class="err" style="display:none;" id="err_provider_number"></div>
                           </div>
                        </div>




                        <div class="clearfix"></div>
                        <script>
                          $(document).ready(function() {
                            $('.click_check').click(function(){ 
                                $(".ahpra_div").toggle();
                            });
                          });
                        </script>
                        <div class="col-sm-12 col-md-6 col-lg-6 request-details-bx1" style="padding-right:0px;">
                           <div class="check-box pharmacy-signup2 join-dc">
                              <input type="checkbox" class="css-checkbox click_check" id="register_ahpra" name="register_ahpra" value="1"  />
                              <label class="css-label lite-red-check remember_me"  for="register_ahpra">Are you registered with AHPRA?</label>
                               <div class="err" style="display:none;" id="err_register_ahpra"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box ahpra_div" style="display: none">
                              <input type="text" class="input_acct-logn" placeholder="AHPRA Registration Number" name="AHPRA" id="AHPRA" />
                                <div class="err" style="display:none;" id="err_AHPRA"></div>
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

                     <input type="hidden" name="txt_userkey" id="txt_userkey" value="">

                     <div class="clearfix"></div>
                     <div class="login-bts text-center">
                        <button class="details-btn select-btn border-btn-radius btnCommonRegistration" value="submit" type="button" name="doctor_signup" id="doctor_signup">Signup</button>
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
      

      <link href="{{ url('/') }}/public/css/select2.min.css" rel="stylesheet" />
      <script src="{{ url('/') }}/public/js/select2.full.js"></script>
	   	   
	   <script>
           $(".js-example-basic-multiple").select2();
        </script>


<script>
  $(document).ready(function(){
    var location = "Australia";
    $("#suburb").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
    });

    // Allow only Alphabet Characters
    $('#first_name, #last_name').keyup(function() {
        if (this.value.match(/[^a-zA-Z]/g)) {
            this.value = this.value.replace(/[^a-zA-Z]/g, '');
        }
    });

  });
</script>

<!-- <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places" async defer>

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        document.getElementById('autocomplete').value = '';
       /* for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }*/

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        var addr;
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
             addr = place.address_components[i][componentForm[addressType]]+' ';
            document.getElementById('autocomplete').value +=addr;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
</script>

@include('google_api.google') -->
  
      <!--join doctor popup end-->  
<script>

   $(document).ready(function(){

   $('#doc_email').blur(function(){
      var email   =  $(this).val();
      $('#doctor_signup').attr('disabled',false);
      $('#err_doc_email').html('');
      var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      
      if($.trim(email)!='')
      {
         if(!email_filter.test(email))
         {
            $('#err_doc_email').show();
            $('#doc_email').focus();
            $('#err_doc_email').html('Please enter valid email id.');
            $('#err_doc_email').fadeOut(4000);
            return false;  
         }

         $.ajax({
               url   : "{{ url('/') }}/doctor/duplicate/email",
               type : "GET",
               data: {email_id:email},
               success : function(res){
                  if($.trim(res)=='error')
                  {
                     $('#err_doc_email').show();
                     $('#doc_email').focus();
                     $('#err_doc_email').html('Email id already exist');
                     $('#doctor_signup').attr('disabled',true);
                     return false;
                  }
                  else if($.trim(res)=='success')
                  {
                     $('#err_doc_email').show();
                     //$('#err_email').html('<span style="color:green !important;">Email id Available</span>');
                     $('#doctor_signup').attr('disabled',false);
                     return true;
                  }
               }
         });
      }
   });

   $('#phone_number').blur(function(){
      var mobile_no   =  $(this).val();
      $('#doctor_signup').attr('disabled',false);
      $('#err_phone_number').html('');
      
      if($.trim(mobile_no)!='')
      {
         

         $.ajax({
               url   : "{{ url('/') }}/doctor/duplicate/mobile_no",
               type : "GET",
               data: {mobile_no:mobile_no},
               success : function(res){
                  if($.trim(res.status)=='error')
                  {
                     $('#err_phone_number').show();
                     $('#phone_number').focus();
                     $('#err_phone_number').html(res.msg);
                     $('#doctor_signup').attr('disabled',true);
                     return false;
                  }
                  else if($.trim(res)=='success')
                  {
                     $('#err_phone_number').show();
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
      var first_name                =  $('#first_name').val();
      var last_name                 =  $('#last_name').val();
      var speciality                =  $('#speciality').val();
      var email                     =  $('#doc_email').val();
      var mobile_code               =  $('#mobile_code').val();
      var phone_number              =  $('#phone_number').val();
      var gender                    =  $('#gender').val();
      var language                  =  $('#language').val();
      var suburb                    =  $('#suburb').val();
      var medical_qualification     =  $('#medical_qualification').val();
      var practitioning_experience  =  $('#practitioning_experience').val();
      /*var provider_number           =  $('#provider_number').val();*/

      var other_languages           =  $('#other_languages').val();

      var register_ahpra            =  $("#register_ahpra").is(":checked");
      var AHPRA                     =  $('#AHPRA').val();
      var legally_telemedicine      =  $("#legally_telemedicine").is(":checked");
      var provider_number_filter    =  /^\d{3,}\d{1}[A-Z]{2}$/;
      var email_filter              =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var alpha                     =  /^[a-zA-Z]*$/;
      var integers                  =  /^[0-9]*$/;


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
         $('#err_doc_email').show();
         $('#doc_email').focus();
         $('#err_doc_email').html('Please enter email id.');
         $('#err_doc_email').fadeOut(4000);
         return false;  
      }
      else if(!email_filter.test(email))
      {
         $('#err_doc_email').show();
         $('#doc_email').focus();
         $('#err_doc_email').html('Please enter valid email id.');
         $('#err_doc_email').fadeOut(4000);
         return false;  
      }
      else if($.trim(gender)=='')
      {
         $('#err_gender').show();
         $('#gender').focus();
         $('#err_gender').html('Please select gender.');
         $('#err_gender').fadeOut(4000);
         return false;  
      }
      else if($.trim(mobile_code) == '')
      {
         $('#err_mobile_code').show();
         $('#mobile_code').focus();
         $('#err_mobile_code').html('Please select mobile code.');
         $('#err_mobile_code').fadeOut(4000);
         return false;  
      }
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
      }
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
      }
      else if($.trim(language)=='')
      {
         $('#err_language').show();
         $('#language').focus();
         $('#err_language').html('Please select language.');
         $('#err_language').fadeOut(4000);
         return false;  
      }
      else if($.trim(suburb)=='')
      {
         $('#err_suburb').show();
         $('#suburb').focus();
         $('#err_suburb').html('Please enter suburb.');
         $('#err_suburb').fadeOut(4000);
         return false;  
      }
      else if($.trim(medical_qualification)=='')
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
      }*/
      /*else if($.trim(provider_number)=='')
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
      }
      else
      {
         return true;
      }*/
      
     });
   });
    
      $(".lang-drop").select2({
            
              placeholder: "Language",
         });
</script>
<!-- Virgil Service starts HERRE --> 
<input type="hidden" id="virgilToken" name="virgilToken" value="{{ env('VIRGIL_TOKEN') }}" />
<script type="text/javascript">
    // generate token
$(document).ready(function(){
  $(".btnCommonRegistration").bind('click',function()
  {
  var email       = $('#doc_email').val();
  var virgilToken = $('#virgilToken').val();
  var api         = virgil.API(virgilToken);

  // generate and save Virgil Key
  var userKey = api.keys.generate();

  // export Virgil key to string
  var exportedKey = userKey.export().toString("base64");
  $('#txt_userkey').val(exportedKey);

  // create Virgil Card
  var userCard = api.cards.create(email, userKey);

  // export Virgil Card to string
  var exportedCard = userCard.export();

  // transmit the Virgil Card to the server
  var _token = "{{ csrf_token() }}";

  $.ajax({
      url: '{{ url("/") }}/publish/card',
      type: 'POST',
      dataType: 'json',
      data: {
          _token: _token,
          exportedCard: exportedCard
      },
      success: function (res) {
          if (res.status == 'success') {
            $('#frm_doctor_signup').submit();
          }
          else {
            alert('Something went wrong');
          }
      }
  });
});
});
</script>
<!-- Virgil Service ends HERRE --> 