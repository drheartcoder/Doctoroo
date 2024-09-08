@include('front.doctor.layout._new_header')


    <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/signup/step1/{{isset($enc_id) ? $enc_id : ''}}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Your Medical Practice</h1>
    </div>

    <div class="container posrel has-header has-footer">
        <style>
            .required_field
            {
                color:red;
            }
        </style>

        @php
            if(Session::has('doctor_signup.step2.experience'))
            {
                $experience = Session::has('doctor_signup.step2.experience') && !empty(Session::get('doctor_signup.step2.experience')) ? Session::get('doctor_signup.step2.experience') : '';
            }
            else if(isset($exists_doctor_data['experience']))
            {
                $experience = isset($exists_doctor_data['experience'])?$exists_doctor_data['experience']:'';
            }

            //clinic address
            if(Session::has('doctor_signup.step2.clinic_address'))
            {
                $clinic_address = Session::has('doctor_signup.step2.clinic_address') && !empty(Session::get('doctor_signup.step2.clinic_address')) ? Session::get('doctor_signup.step2.clinic_address') : '';
            }
            else if(isset($exists_doctor_data['clinic_address']))
            {
                $clinic_address = isset($exists_doctor_data['clinic_address'])?$exists_doctor_data['clinic_address']:'';
            }

            //clinic email
            if(Session::has('doctor_signup.step2.clinic_email'))
            {
                $clinic_email = Session::has('doctor_signup.step2.clinic_email') && !empty(Session::get('doctor_signup.step2.clinic_email')) ? Session::get('doctor_signup.step2.clinic_email') : '';
            }
            else if(isset($exists_doctor_data['clinic_email']))
            {
                $clinic_email = isset($exists_doctor_data['clinic_email'])?$exists_doctor_data['clinic_email']:'';
            }


            //clinic Contact No
            if(Session::has('doctor_signup.step2.clinic_contact_no'))
            {
                $clinic_contact_no = Session::has('doctor_signup.step2.clinic_contact_no') && !empty(Session::get('doctor_signup.step2.clinic_contact_no')) ? Session::get('doctor_signup.step2.clinic_contact_no') : '';
            }
            else if(isset($exists_doctor_data['clinic_contact_no']))
            {
                $clinic_contact_no = isset($exists_doctor_data['clinic_contact_no'])?$exists_doctor_data['clinic_contact_no']:'';
            }

            //clinic Mobile No
            if(Session::has('doctor_signup.step2.clinic_mobile_no'))
            {
                $clinic_mobile_no = Session::has('doctor_signup.step2.clinic_mobile_no') && !empty(Session::get('doctor_signup.step2.clinic_mobile_no')) ? Session::get('doctor_signup.step2.clinic_mobile_no') : '';
            }
            else if(isset($exists_doctor_data['clinic_mobile_no']))
            {
                $clinic_mobile_no = isset($exists_doctor_data['clinic_mobile_no'])?$exists_doctor_data['clinic_mobile_no']:'';
            }

            if(Session::has('doctor_signup.step1.dumpSessionId'))
            {
                $user_dumpSessionId = Session::has('doctor_signup.step1.dumpSessionId') && !empty(Session::get('doctor_signup.step1.dumpSessionId')) ? Session::get('doctor_signup.step1.dumpSessionId') : '';
            }
            else if(isset($exists_doctor_data['userinfo']['dump_session']))
            {
                $user_dumpSessionId = isset($exists_doctor_data['userinfo']['dump_session'])?$exists_doctor_data['userinfo']['dump_session']:'';
            }


            if(Session::has('doctor_signup.step1.dumpId'))
            {
                $user_dumpId = Session::has('doctor_signup.step1.dumpId') && !empty(Session::get('doctor_signup.step1.dumpId')) ? Session::get('doctor_signup.step1.dumpId') : '';
            }
            else if(isset($exists_doctor_data['userinfo']['dump_id']))
            {
                $user_dumpId = isset($exists_doctor_data['userinfo']['dump_id'])?$exists_doctor_data['userinfo']['dump_id']:'';
            }

        @endphp


        <form id="signup_step2" class="signup_step2" method="POST" action="{{ url('/') }}/doctor/signup/store_step2/{{isset($enc_id) ? $enc_id : ''}}">
        {{ csrf_field() }}

        <div class="fieldspres">
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="clinic_name" name="clinic_name" class="validate" value="{{ Session::has('doctor_signup.step2.clinic_name') && !empty(Session::get('doctor_signup.step2.clinic_name')) ? Session::get('doctor_signup.step2.clinic_name') : '' }}">
                    <label for="clinic_name" class="grey-text truncate">Practice / Clinic Name </label>
                    <div class="err left-12px" style="display:none;" id="err_clinic_name"></div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    
                    <input type="text" id="clinic_address" name="clinic_address" class="materialize-textarea" placeholder="" value="">
                    <label for="clinic_address" class="grey-text truncate">Address </label>
                    <div class="err left-12px" style="display:none;" id="err_clinic_address"></div>
                    <input type="hidden" name="enc_clinic_address" id="enc_clinic_address" readonly="">
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="clinic_email" name="clinic_email" class="validate" value="">
                    <label for="clinic_email" class="grey-text truncate">Email </label>
                    <div class="err left-12px" style="display:none;" id="err_clinic_email"></div>
                </div>
                <input type="hidden" name="enc_clinic_email" id="enc_clinic_email" readonly="">
            </div>
            <div class="row marbtm40px" style="margin-top: 30px;" >
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="clinic_contact_no" name="clinic_contact_no" class="validate" value="">
                    <label for="clinic_contact_no" class="grey-text truncate">Office No.</label>
                    <div class="err left-12px" style="display:none;" id="err_clinic_contact_no"></div>
                    <input type="hidden" name="enc_clinic_contact_no" id="enc_clinic_contact_no" readonly="">
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <div class="row">
                        <div class="col s4 input-field selct input-padding-25px">
                            <label for="" class="grey-text truncate small-text-label">Mobile No.</label>
                            <select name="clinic_mobile_no_code" id="clinic_mobile_no_code">
                                    <option value="" selected>Code</option>
                                    @if(isset($mobcode_data) && !empty($mobcode_data))
                                        @foreach($mobcode_data as $mobcode)
                                            <option value="{{ $mobcode['id'] }}" @if(!empty(Session::get('doctor_signup.step2.clinic_mobile_no_code')))
                                            {{ Session::get('doctor_signup.step2.clinic_mobile_no_code') == $mobcode['id'] ? 'selected' : '' }} @elseif($mobcode['id'] == '13') selected @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                        @endforeach
                                    @endif
                            </select> 
                        </div>
                        <div class="input-field col s8 text-bx lessmar input-padding-25px">
                            <input type="text" id="clinic_mobile_no" name="clinic_mobile_no" class="validate" value="">
                            <div class="err left-12px" style="display:none;" id="err_clinic_mobile_no"></div>
                            <input type="hidden" name="enc_clinic_mobile_no" id="enc_clinic_mobile_no" readonly="">
                        </div>

                    </div>
                    
                </div>
            </div>

            <div class="otherdetails">
                <h3 class="sethead ">Your Experience</h3>
                <div class="row ">
                    <div class="input-field col s12 m12 l12 selct input-padding-25px" style="margin-top: 30px;">
                        <select id="experience" name="experience">
                            <option disabled selected>Years in Practice</option>
                            <?php for($i=0;$i<100;$i++) {?>
                               <option value="<?php echo $i; ?>" {{ isset($experience) && $experience == $i ? 'selected' : '' }}><?php echo $i; ?></option>
                            <?php } ?> 
                        </select>
                        <div class="err left-12px" style="display:none;" id="err_experience"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="input-field col s12 m12 l12  selct input-padding-25px">
                        <select multiple id="language" name="language">
                            <?php $selected =""; ?>
                            <option disabled selected>Language/s spoken during Consultations</option>
                            @if(isset($language_data) && !empty($language_data))
                                @foreach($language_data as $language)
                                    @if(Session::has('doctor_signup.step2.language') && !empty(Session::get('doctor_signup.step2.language')) || isset($exists_doctor_data['language']) && !empty($exists_doctor_data['language']))
                                        @php 
                                            if(Session::has('doctor_signup.step2.language') && !empty(Session::get('doctor_signup.step2.language')))
                                             {
                                                $arr = explode(',', Session::get('doctor_signup.step2.language'));
                                             }
                                             else if(!empty($exists_doctor_data['language']))
                                             {
                                                $arr = explode(',', $exists_doctor_data['language']);      
                                             }   

                                            
                                            if(in_array($language['id'], $arr ))
                                            {
                                                $selected = 'selected';
                                            } 
                                            else
                                            {
                                                $selected = '';
                                            }   
                                        @endphp
                                    @endif
                                    <option class="multi_languages" value="{{ $language['id'] }}" {{$selected}}>{{ $language['language'] }}</option>
                                @endforeach
                                <option value="Other" <?php if(Session::has('other_lan') && !empty(Session::get('other_lan'))) { echo 'selected="selected"'; } ?>  >Other</option>
                            @endif
                        </select>
                        <input type="hidden" id="multi_languages" name="multi_languages">
                        <div class="err left-12px" style="display:none;" id="err_language"></div>
                        <!-- <p class="bluedoc-text">Note: For multiple language add comma (,) to separate. For example: English, French, Spanish </p> -->
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 other_lang" style="display:none;">
                   <div class="user_box">
                      <input type="text" class="input_acct-logn" value="<?php if(Session::has('other_languages_session') && !empty(Session::get('other_languages_session'))) { echo Session::get('other_languages_session'); } ?>" placeholder="Enter other languages eg. marathi,hindi,english" name="other_languages" id="other_languages" />
                        <div class="err" style="display:none;" id="err_other_languages"></div>
                   </div><span>If have more than one language  then please enter languages using comma(,)</span>
                </div>

                <script>
                 $(document).ready(function(){

                    if ($('#language').val().indexOf('Other') > -1)
                    {
                       $('.other_lang').show();
                       $('#other_languages').show();
                    }
                    else{
                       $('#other_languages').val('');
                       $('#other_languages').hide();
                    }


                   $('#language').change(function(){
                        var value = $(this).val();
                        if (value.indexOf('Other') > -1)
                        {
                           $('.other_lang').show();
                           $('#other_languages').show();
                        }
                        else{
                           $('#other_languages').val('');
                           $('#other_languages').hide();
                        }
                   });
                 });
                 </script>
            </div>

            <span class="right qusame rescahnge">
                <button type="button" class="btn_signup_step2 border-btn round-corner center-align" id="btn_signup_step2">Next Step ></button>
            </span>
            <div class="clr"></div>

        </div>

        </form>
    </div>
    <!--Container End-->

    <div id="footer-full"></div>

    <!--  Scripts-->
    <script src="{{ url('/') }}/public/doctor_section/js/materialize.js"></script>
    <script src="{{ url('/') }}/public/doctor_section/js/init.js"></script>

    <!-- Data Decrypt -->
    <script type="text/javascript">
      var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
      var dumpSessionId = '{{ $user_dumpSessionId }}';
      var dumpId        = '{{ $user_dumpId }}';
      $(document).ready(function(){
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              var email        = '{{$clinic_email}}';
              var address      = '{{$clinic_address}}';
              var mobile       = '{{$clinic_mobile_no}}';
              var contact_no   = '{{$clinic_contact_no}}';

              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              if(address!='')
              {
                  var txtaddress = decrypt(api, address, key);
                  $('#clinic_address').val(txtaddress);
              }
              
              if(email!='' && mobile!='' && contact_no!='')
              {
                  var txtemail   = decrypt(api, email, key);
                  var txtmobile  = decrypt(api, mobile, key);
                  var txtcontact_no = decrypt(api, contact_no, key);
                  
                  $('#clinic_email').val(txtemail);
                  $('#clinic_mobile_no').val(txtmobile);
                  $('#clinic_contact_no').val(txtcontact_no);
              }
          }

          function decrypt(api, enctext, key)
          {
              var decrpyttext = key.decrypt(enctext);
              var plaintext = decrpyttext.toString();
              return plaintext;
          }
      });
    </script>

    <script>
        $(document).ready(function(){
            // number validation for contact no
            $('#clinic_contact_no, #clinic_mobile_no').keydown(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
                $(this).keyup(function(){
                    $(this).val($(this).val().replace(/[^\d]/,''));
                });
            });

            $('#btn_signup_step2').click(function(){
                var clinic_name         = $('#clinic_name').val();
                var clinic_address      = $('#clinic_address').val();
                var clinic_email        = $('#clinic_email').val();
                var clinic_contact_no   = $('#clinic_contact_no').val();
                var clinic_mobile_no    = $('#clinic_mobile_no').val();
                var clinic_mobile_no_code = $('#clinic_mobile_no_code').val();
                var experience          = $('#experience').val();
                var language            = $('#language').val();

                var email_filter        = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var alpha               = /^[a-zA-Z]*$/;
                var integers            = /^[0-9]*$/;
                var multi_languages = []; 
                $('#language .multi_languages').each(function(){

                      if($(this).is(':checked'))
                      {
                            
                            multi_languages.push(this.value);
                      }
                });

                var multi = multi_languages.toString();

                $('#multi_languages').val(multi);

               /* if($.trim(clinic_name) == '')
                {
                    $('#err_clinic_name').show();
                    $('#clinic_name').focus();
                    $('#err_clinic_name').html('Please enter Practice / Clinic Name.');
                    $('#err_clinic_name').fadeOut(4000);
                    return false;
                }
                else if($.trim(clinic_address) == '')
                {
                    $('#err_clinic_address').show();
                    $('#clinic_address').focus();
                    $('#err_clinic_address').html('Please enter Address.');
                    $('#err_clinic_address').fadeOut(4000);
                    return false;
                }
                else if($.trim(clinic_email) == '')
                {
                    $('#err_clinic_email').show();
                    $('#clinic_email').focus();
                    $('#err_clinic_email').html('Please enter Email.');
                    $('#err_clinic_email').fadeOut(4000);
                    return false;
                }else*/
                if(!email_filter.test(clinic_email) && clinic_email!='')
                {
                    $('#err_clinic_email').show();
                    $('#clinic_email').focus();
                    $('#err_clinic_email').html('Please enter valid Email.');
                    $('#err_clinic_email').fadeOut(4000);
                    return false;
                }
                else if(!integers.test(clinic_contact_no))
                {
                    $('#err_clinic_contact_no').show();
                    $('#clinic_contact_no').focus();
                    $('#err_clinic_contact_no').html('Please enter valid Contact no.');
                    $('#err_clinic_contact_no').fadeOut(4000);
                    return false;
                }
                else if(!integers.test(clinic_mobile_no))
                {
                    $('#err_clinic_mobile_no').show();
                    $('#clinic_mobile_no').focus();
                    $('#err_clinic_mobile_no').html('Please enter valid Mobile no.');
                    $('#err_clinic_mobile_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(experience) == '')
                {
                    $('#err_experience').show();
                    $('#experience').focus();
                    $('#err_experience').html('Please select Experience.');
                    $('#err_experience').fadeOut(4000);
                    return false;
                }
                else if($.trim(language) == '')
                {
                    $('#err_language').show();
                    $('#language').focus();
                    $('#err_language').html('Please select Language.');
                    $('#err_language').fadeOut(4000);
                    return false;
                }
                else
                {
                    /* Data Encryption */                    
                      var email        = $('#clinic_email').val();
                      var address      = $('#clinic_address').val();
                      var contact_no   = $('#clinic_contact_no').val();
                      var mobile       = $('#clinic_mobile_no').val();

                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                      var txtemail      = encrypt(api, email, cards);
                      var txtaddress    = encrypt(api, address, cards);
                      var txtmobile     = encrypt(api, mobile, cards);
                      var txtcontact_no = encrypt(api, contact_no, cards);

                      if(txtemail != '' && txtaddress != '' && txtmobile != '' && txtcontact_no != '')
                      {
                          $('#enc_clinic_email').val(txtemail);
                          $('#enc_clinic_address').val(txtaddress);
                          $('#enc_clinic_mobile_no').val(txtmobile);
                          $('#enc_clinic_contact_no').val(txtcontact_no);

                          $('#signup_step2').submit();
                      }
                      
                      }).then(null, function () {
                          console.log('Something went wrong.');
                      });

                      findkey.catch(function(error) {
                        console.log(error);
                      });

                    function encrypt(api, text, cards)
                    {
                      // encrypt the text using User's cards
                      var encryptedMessage = api.encryptFor(text, cards);

                      var encData = encryptedMessage.toString("base64");

                      return encData;
                    }
                }
            });

        });
    </script>

    @include('google_api.google')
    <script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
    <script>
      $(document).ready(function(){
        var location = "Australia";
        $("#clinic_address").geocomplete({
            details: ".geo-details",
            detailsAttribute: "data-geo",
        });
      });
    </script>

    <!-- Loader starts -->
    <script>
    $(window).on('beforeunload', function(){
        showProcessingOverlay();
    });
    $(document).ready(function(){
        hideProcessingOverlay();
    });
    $(window).bind("load", function() { 
        hideProcessingOverlay();
    });
    </script>
    <!-- Loader ends -->

    <!--upcoming modal start-->

</body>

</html>