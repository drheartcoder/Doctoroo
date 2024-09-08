@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead nopad z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Your Medical Practice</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')
    
    @if(isset($doctor_data) && !empty($doctor_data))
        @php
            $clinic_name         = isset($doctor_data['clinic_name'])?$doctor_data['clinic_name']:'';
            $clinic_address      = isset($doctor_data['clinic_address'])?$doctor_data['clinic_address']:'';
            $clinic_email        = isset($doctor_data['clinic_email'])?$doctor_data['clinic_email']:'';
            $clinic_contact_no   = isset($doctor_data['clinic_contact_no'])?$doctor_data['clinic_contact_no']:'';
            $clinic_mobile_no    = isset($doctor_data['clinic_mobile_no'])?$doctor_data['clinic_mobile_no']:'';
            $experience          = isset($doctor_data['experience'])?$doctor_data['experience']:'';
            $languages           = isset($doctor_data['language'])?$doctor_data['language']:'';
            $selected_language   = explode(',', $languages);
            $user_dumpId         = isset($doctor_data['userinfo']['dump_id'])?$doctor_data['userinfo']['dump_id']:'';
            $user_dumpSessionId  = isset($doctor_data['userinfo']['dump_session'])?$doctor_data['userinfo']['dump_session']:'';
        @endphp
    @endif

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <style>
        .required_field
        {
            color:red;
        }
        </style>
        <div class="container posrel has-header has-footer">
            <form id="signup_step2" class="signup_step2" method="POST" action="{{ url('/') }}/doctor/my_profile/update_your_medical_practice">
            {{ csrf_field() }}

            <div class="fieldspres ">

                <!-- @if(Session::has('redirect_msg'))
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12 text-bx lessmar ">
                            {{ Session::get('redirect_msg') }}
                        </div>
                    </div>
                @endif -->

                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="clinic_name" name="clinic_name" class="validate" value="{{ $clinic_name }}">
                        <label for="clinic_name" class="grey-text truncate">Practice / Clinic Name <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_clinic_name"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="clinic_address" name="clinic_address" class="materialize-textarea" value="" placeholder="" />
                        <label for="clinic_address" class="grey-text truncate">Address <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_clinic_address"></div>
                        <input type="hidden" name="enc_clinic_address" id="enc_clinic_address" readonly="">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="clinic_email" name="clinic_email" class="validate" value="">
                        <label for="clinic_email" class="grey-text truncate">Email <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_clinic_email"></div>
                        <input type="hidden" name="enc_clinic_email" id="enc_clinic_email" readonly="">
                    </div>
                </div>
                <div class="row marbtm40px" style="margin-top: 10px;" >
                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="clinic_contact_no" name="clinic_contact_no" class="validate" value="" maxlength="16">
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
                                            <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == $doctor_data['clinic_mobile_no_code']) selected @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                        @endforeach
                                    @endif
                            </select> 
                        </div>
                        <div class="input-field col s8 text-bx lessmar input-padding-25px">
                            <input type="text" id="clinic_mobile_no" name="clinic_mobile_no" class="validate" value="" maxlength="14">
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
                                <option value="">Years in Practice</option>
                                <?php for($i=0; $i<100; $i++) {?>
                                   <option value="<?php echo $i; ?>" @if($i == $experience) selected @endif ><?php echo $i; ?></option>
                                <?php } ?> 
                            </select>
                            <div class="err left-12px" style="display:none;" id="err_experience"></div>
                        </div>
                    </div>
                   
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  selct input-padding-25px">
                            <select multiple id="doc_lang" name="doc_lang[]">
                                <option disabled selected>Language/s spoken during Consultations</option>

                                @if(isset($language_data) && !empty($language_data))
                                    @foreach($language_data as $language)
                                        <?php
                                            if(in_array($language['id'], $selected_language )) { $selected = 'selected'; }
                                            else { $selected = ''; }
                                        ?>
                                        <option value="{{ $language['id'] }}" {{ $selected }} >{{ $language['language'] }}</option>
                                    @endforeach
                                    <option value="Other">Other</option>
                                @endif
                            </select>
                            <div class="err left-12px" style="display:none;" id="err_doc_lang"></div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-6 other_lang" style="display:none;">
                       <div class="user_box">
                          <input type="text" class="input_acct-logn" placeholder="Enter other languages eg. marathi,hindi,english" name="other_languages" id="other_languages" />
                            <div class="err" style="display:none;" id="err_other_languages"></div>
                       </div><span>If have more than one language  then please enter languages using comma(,)</span>
                    </div>


                    <script>
                     $(document).ready(function(){
                       $('#doc_lang').change(function(){
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

                <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/settings" class="border-btn round-corner center-align">Back</a></span>
                <span class="right qusame rescahnge">
                    <button type="button" class="btn_signup_step2 border-btn round-corner center-align" id="btn_signup_step2">Update</button>
                </span>
                <div class="clr"></div>

            </div>

            </form>
        </div>
    </div>
    </div>
    <!--Container End-->


    <input type="hidden" class="status_msg" id="status_msg" name="status_msg" value="{{ Session::get('redirect_msg') }}" style="display: none;"/>
    <a class="open_status_popup" href="#show_status_msg" style="display: none;"></a>
    <div id="show_status_msg" class="modal date-modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div></div>
                    <p class="center-align">{{ Session::get('redirect_msg') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>
    </div>

    <!-- Data Decrypt -->
        <script type="text/javascript">
      var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
      var dumpSessionId = '{{ $user_dumpSessionId }}';
      var dumpId        = '{{ $user_dumpId }}';
      var email = '{{ $clinic_email }}';
      var address = '{{ $clinic_address }}';
      var mobile = '{{ $clinic_mobile_no }}';
      var contact_no = '{{ $clinic_contact_no }}';
      
      $(document).ready(function(){
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              //var email        = $('#clinic_email').val();
              /*var address      = $('#clinic_address').val();
              var mobile       = $('#clinic_mobile_no').val();
              var contact_no   = $('#clinic_contact_no').val();*/

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
            
            var status_msg = $('#status_msg').val();
            if(status_msg != '')
            {
                $(".open_status_popup").click();
            }

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
                var experience          = $('#experience').val();
                var doc_lang            = $('#doc_lang').val();

                var email_filter        = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var alpha               = /^[a-zA-Z]*$/;
                var integers            = /^[0-9]*$/;

                if($.trim(clinic_name) == '')
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
                }
                else if(!email_filter.test(clinic_email))
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
                else if($.trim(doc_lang) == '')
                {
                    $('#err_doc_lang').show();
                    $('#doc_lang').focus();
                    $('#err_doc_lang').html('Please select Language.');
                    $('#err_doc_lang').fadeOut(4000);
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

    <!-- @include('google_api.google') -->
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

@endsection