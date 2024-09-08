@include('front.doctor.layout._new_header')

    <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/signup/step2/{{isset($enc_id) ? $enc_id : ''}}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Your Medical Qualifications</h1>
    </div>

    <div class="container posrel has-header has-footer">
        <style>
            .required_field
            {
                color:red;
            }
        </style>

        @php
            // medical qualification
            if(Session::has('doctor_signup.step3.medical_qualification'))
            {
                $medical_qualification = Session::has('doctor_signup.step3.medical_qualification') && !empty(Session::get('doctor_signup.step3.medical_qualification')) ? Session::get('doctor_signup.step3.medical_qualification') : '';
            }
            else if(isset($exists_doctor_data['medical_qualification']))
            {
                $medical_qualification = isset($exists_doctor_data['medical_qualification'])?$exists_doctor_data['medical_qualification']:'';
            }

            // bank account name
            if(Session::has('doctor_signup.step3.bank_account_name'))
            {
                $bank_account_name = Session::has('doctor_signup.step3.bank_account_name') && !empty(Session::get('doctor_signup.step3.bank_account_name')) ? Session::get('doctor_signup.step3.bank_account_name') : '';
            }
            else if(isset($exists_doctor_data['bank_account_name']))
            {
                $bank_account_name = isset($exists_doctor_data['bank_account_name'])?$exists_doctor_data['bank_account_name']:'';
            }

            // bank bsb
            if(Session::has('doctor_signup.step3.bsb'))
            {
                $bsb = Session::has('doctor_signup.step3.bsb') && !empty(Session::get('doctor_signup.step3.bsb')) ? Session::get('doctor_signup.step3.bsb') : '';
            }
            else if(isset($exists_doctor_data['bsb']))
            {
                $bsb = isset($exists_doctor_data['bsb'])?$exists_doctor_data['bsb']:'';
            }            

            // bank account_number
            if(Session::has('doctor_signup.step3.account_number'))
            {
                $account_number = Session::has('doctor_signup.step3.account_number') && !empty(Session::get('doctor_signup.step3.account_number')) ? Session::get('doctor_signup.step3.account_number') : '';
            }
            else if(isset($exists_doctor_data['account_number']))
            {
                $account_number = isset($exists_doctor_data['account_number'])?$exists_doctor_data['account_number']:'';
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

        <form id="signup_step3" class="signup_step3" method="POST" action="{{ url('/') }}/doctor/signup/store_step3/{{isset($enc_id) ? $enc_id : ''}}">
        {{ csrf_field() }}

        <div class="fieldspres ">
            <p class="bluedoc-text">Note: All the fields are mandatory</p>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="medical_qualification" name="medical_qualification" class="validate" value="">
                    <label for="medical_qualification" class="grey-text truncate">Primary Medical Qualification (AMC recognised) <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_medical_qualification"></div>
                    <input type="hidden" name="enc_medical_qualification" id="enc_medical_qualification" readonly="">
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="medical_school" name="medical_school" class="validate" value="{{ Session::has('doctor_signup.step3.medical_school') && !empty(Session::get('doctor_signup.step3.medical_school')) ? Session::get('doctor_signup.step3.medical_school') : '' }}">
                    <label for="medical_school" class="grey-text truncate">Medical School <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_medical_school"></div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="year_obtained" name="year_obtained" class="validate" maxlength="4" value="{{ Session::has('doctor_signup.step3.year_obtained') && !empty(Session::get('doctor_signup.step3.year_obtained')) ? Session::get('doctor_signup.step3.year_obtained') : '' }}">
                    <label for="year_obtained" class="grey-text truncate">Year Obtained <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_year_obtained"></div>
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="country_obtained" name="country_obtained" class="validate" value="{{ Session::has('doctor_signup.step3.country_obtained') && !empty(Session::get('doctor_signup.step3.country_obtained')) ? Session::get('doctor_signup.step3.country_obtained') : '' }}">
                    <label for="country_obtained" class="grey-text truncate">Country Obtained <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_country_obtained"></div>
                </div>
            </div>
            <div class="row marbtm40px" style="margin-top: 30px;" >
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="other_qualifications" name="other_qualifications" class="validate" value="{{ Session::has('doctor_signup.step3.other_qualifications') && !empty(Session::get('doctor_signup.step3.other_qualifications')) ? Session::get('doctor_signup.step3.other_qualifications') : '' }}">
                    <label for="other_qualifications" class="grey-text truncate">Other Related Qualifications</label>
                    <div class="err left-12px" style="display:none;" id="err_other_qualifications"></div>
                </div>
            </div>
            <div class="otherdetails">
                <h3 class="sethead ">Bank Account Details</h3>
                <p class="bluedoc-text">
                    Required to create a Stripe account and recieve instant deposits for your consultations
                </p>
                <div class="row" style="margin-top: 30px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="bank_account_name" name="bank_account_name" class="validate" value="{{ Session::has('doctor_signup.step3.bank_account_name') && !empty(Session::get('doctor_signup.step3.bank_account_name')) ? Session::get('doctor_signup.step3.bank_account_name') : '' }}">
                        <label for="bank_account_name" class="grey-text truncate">Bank Account Name <!-- <span class="required_field">*</span> --></label>
                        <div class="err left-12px" style="display:none;" id="err_bank_account_name"></div>
                        <input type="hidden" name="enc_bank_account_name" id="enc_bank_account_name" readonly="">
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="bsb" name="bsb" class="validate" value="{{ Session::has('doctor_signup.step3.bsb') && !empty(Session::get('doctor_signup.step3.bsb')) ? Session::get('doctor_signup.step3.bsb') : '' }}">
                        <label for="bsb" class="grey-text truncate">BSB <!-- <span class="required_field">*</span> --></label>
                        <div class="err left-12px" style="display:none;" id="err_bsb"></div>
                        <input type="hidden" name="enc_bsb" id="enc_bsb" readonly="">
                    </div>
                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="account_number" name="account_number" class="validate" value="{{ Session::has('doctor_signup.step3.account_number') && !empty(Session::get('doctor_signup.step3.account_number')) ? Session::get('doctor_signup.step3.account_number') : '' }}">
                        <label for="account_number" class="grey-text truncate">Account Number <!-- <span class="required_field">*</span> --></label>
                        <div class="err left-12px" style="display:none;" id="err_account_number"></div>
                        <input type="hidden" name="enc_account_number" id="enc_account_number" readonly="">
                    </div>
                </div>
                
            </div>

            <span class="right qusame rescahnge">
                <button type="button" class="btn_signup_step3 border-btn round-corner center-align" id="btn_signup_step3">Next Step ></button>
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
              var medical_qualification        = "{{$medical_qualification}}";
              var bank_account_name            = "{{$bank_account_name}}";
              var bsb                          = "{{$bsb}}";
              var account_number               = "{{$account_number}}";
              
              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              if(medical_qualification!='')
              {
                  var txtmedical_qualification = decrypt(api, medical_qualification, key);
                  $('#medical_qualification').val(txtmedical_qualification);
              }

              if(bank_account_name!='')
              {
                  var txtbank_account_name  = decrypt(api, bank_account_name, key);
                  $('#bank_account_name').val(txtbank_account_name);
              }

              if(bsb!='')
              {
                  var txtbsb                = decrypt(api, bsb, key);
                  $('#bsb').val(txtbsb);
              }

              if(account_number!='' )
              {
                  var txtaccount_number     = decrypt(api, account_number, key);
                  $('#account_number').val(txtaccount_number);
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
            $('#year_obtained, #account_number,#bsb').keydown(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
                $(this).keyup(function(){
                    $(this).val($(this).val().replace(/[^\d]/,''));
                });
            });

            $('#btn_signup_step3').click(function(){
                var medical_qualification       = $('#medical_qualification').val();
                var medical_school              = $('#medical_school').val();
                var year_obtained               = $('#year_obtained').val();
                var country_obtained            = $('#country_obtained').val();
                var other_qualifications        = $('#other_qualifications').val();
                var bank_account_name           = $('#bank_account_name').val();
                var bsb                         = $('#bsb').val();
                var account_number              = $('#account_number').val();

                var email_filter        = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var alpha               = /^[a-zA-Z]*$/;
                var integers            = /^[0-9]*$/;

                if($.trim(medical_qualification) == '')
                {
                    $('#err_medical_qualification').show();
                    $('#medical_qualification').focus();
                    $('#err_medical_qualification').html('Please enter Primary Medical Qualification.');
                    $('#err_medical_qualification').fadeOut(4000);
                    return false;
                }
                else if($.trim(medical_school) == '')
                {
                    $('#err_medical_school').show();
                    $('#medical_school').focus();
                    $('#err_medical_school').html('Please enter Medical School.');
                    $('#err_medical_school').fadeOut(4000);
                    return false;
                }
                else if($.trim(year_obtained) == '')
                {
                    $('#err_year_obtained').show();
                    $('#year_obtained').focus();
                    $('#err_year_obtained').html('Please enter Year.');
                    $('#err_year_obtained').fadeOut(4000);
                    return false;
                }
                else if($.trim(country_obtained) == '')
                {
                    $('#err_country_obtained').show();
                    $('#country_obtained').focus();
                    $('#err_country_obtained').html('Please enter Country.');
                    $('#err_country_obtained').fadeOut(4000);
                    return false;
                }
                /*else if($.trim(bank_account_name) == '')
                {
                    $('#err_bank_account_name').show();
                    $('#bank_account_name').focus();
                    $('#err_bank_account_name').html('Please select Bank Account Name.');
                    $('#err_bank_account_name').fadeOut(4000);
                    return false;
                }
                else if($.trim(bsb) == '')
                {
                    $('#err_bsb').show();
                    $('#bsb').focus();
                    $('#err_bsb').html('Please enter BSB.');
                    $('#err_bsb').fadeOut(4000);
                    return false;
                }
                else if($.trim(account_number) == '')
                {
                    $('#err_account_number').show();
                    $('#account_number').focus();
                    $('#err_account_number').html('Please enter Account Number.');
                    $('#err_account_number').fadeOut(4000);
                    return false;
                }*/
                else
                {
                    /* Data Encryption */                    
                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                      if(medical_qualification!='')
                      {
                        var txtmedical_qualification      = encrypt(api, medical_qualification, cards);
                        $('#enc_medical_qualification').val(txtmedical_qualification);
                      }

                      if(bank_account_name!='')
                      {
                        var txtbank_account_name          = encrypt(api, bank_account_name, cards);
                        $('#enc_bank_account_name').val(txtbank_account_name);
                      }

                      if(bsb!='')
                      {
                        var txtbsb                        = encrypt(api, bsb, cards);
                        $('#enc_bsb').val(txtbsb);
                      }

                      if(account_number!='')
                      {
                        var txtaccount_number             = encrypt(api, account_number, cards);
                        $('#enc_account_number').val(txtaccount_number);
                      }

                        $('#signup_step3').submit();
                      
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