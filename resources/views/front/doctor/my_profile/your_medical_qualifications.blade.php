@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead nopad z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Your Medical Qualifications</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    @if(isset($doctor_data) && !empty($doctor_data))
        @php
            $medical_qualification  = isset($doctor_data['medical_qualification'])?$doctor_data['medical_qualification']:'';
            $medical_school         = isset($doctor_data['medical_school'])?$doctor_data['medical_school']:'';
            $year_obtained          = isset($doctor_data['year_obtained'])?$doctor_data['year_obtained']:'';
            $country_obtained       = isset($doctor_data['country_obtained'])?$doctor_data['country_obtained']:'';
            $other_qualifications   = isset($doctor_data['other_qualifications'])?$doctor_data['other_qualifications']:'';
            $bank_account_name      = isset($doctor_data['bank_account_name'])?$doctor_data['bank_account_name']:'';
            $bsb                    = isset($doctor_data['bsb'])?$doctor_data['bsb']:'';
            $account_number         = isset($doctor_data['account_number'])?$doctor_data['account_number']:'';
            $user_dumpId            = isset($doctor_data['userinfo']['dump_id'])?$doctor_data['userinfo']['dump_id']:'';
            $user_dumpSessionId     = isset($doctor_data['userinfo']['dump_session'])?$doctor_data['userinfo']['dump_session']:'';
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
            <form id="signup_step3" class="signup_step3" method="POST" action="{{ url('/') }}/doctor/my_profile/update_your_medical_qualifications">
            {{ csrf_field() }}

            <div class="fieldspres ">
                
                <!-- @if(Session::has('redirect_msg'))
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12 text-bx lessmar">
                            {{ Session::get('redirect_msg') }}
                        </div>
                    </div>
                @endif -->


                <div class="row" style="margin-top: 20px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="medical_qualification" name="medical_qualification" class="validate" value="">
                        <label for="medical_qualification" class="grey-text truncate">Primary Medical Qualification (AMC recognised) <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_medical_qualification"></div>
                        <input type="hidden" name="enc_medical_qualification" id="enc_medical_qualification" readonly="">
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="medical_school" name="medical_school" class="validate" value="{{ $medical_school }}">
                        <label for="medical_school" class="grey-text truncate">Medical School <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_medical_school"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="year_obtained" name="year_obtained" class="validate" maxlength="4" value="{{ $year_obtained }}">
                        <label for="year_obtained" class="grey-text truncate">Year Obtained <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_year_obtained"></div>
                    </div>
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="country_obtained" name="country_obtained" class="validate" value="{{ $country_obtained }}">
                        <label for="country_obtained" class="grey-text truncate">Country Obtained <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_country_obtained"></div>
                    </div>
                </div>
                <div class="row marbtm40px" style="margin-top: 20px;" >
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="other_qualifications" name="other_qualifications" class="validate" value="{{ $other_qualifications }}">
                        <label for="other_qualifications" class="grey-text truncate">Other Related Qualifications</label>
                        <div class="err left-12px" style="display:none;" id="err_other_qualifications"></div>
                    </div>
                </div>
                <div class="otherdetails">
                    <h3 class="sethead ">Bank Account Details</h3>
                    <p class="bluedoc-text">
                        Required to create a Stripe account and recieve instant deposits for your consultations
                    </p>
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                            <input type="text" id="bank_account_name" name="bank_account_name" class="validate" value="">
                            <label for="bank_account_name" class="grey-text truncate">Bank Account Name <span class="required_field">*</span></label>
                            <div class="err left-12px" style="display:none;" id="err_bank_account_name"></div>
                            <input type="hidden" name="enc_bank_account_name" id="enc_bank_account_name" readonly="">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                            <input type="text" id="bsb" name="bsb" class="validate" value="">
                            <label for="bsb" class="grey-text truncate">BSB <span class="required_field">*</span></label>
                            <div class="err left-12px" style="display:none;" id="err_bsb"></div>
                            <input type="hidden" name="enc_bsb" id="enc_bsb" readonly="">
                        </div>
                        <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                            <input type="text" id="account_number" name="account_number" class="validate" value="">
                            <label for="account_number" class="grey-text truncate">Account Number <span class="required_field">*</span></label>
                            <div class="err left-12px" style="display:none;" id="err_account_number"></div>
                            <input type="hidden" name="enc_account_number" id="enc_account_number" readonly="">
                        </div>
                    </div>
                    
                </div>

                <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/settings" class="border-btn round-corner center-align">Back</a></span>
                <span class="right qusame rescahnge">
                    <button type="button" class="btn_signup_step3 border-btn round-corner center-align" id="btn_signup_step3">Update</button>
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
                    <p>{{ Session::get('redirect_msg') }}</p>
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
      $(document).ready(function(){

          var medical_qualification        = '{{$medical_qualification}}';
          var bank_account_name            = '{{$bank_account_name}}';
          var bsb                          = '{{$bsb}}';
          var account_number               = '{{$account_number}}';
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              
              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              if(medical_qualification!='')
              {
                  var txtmedical_qualification = decrypt(api, medical_qualification, key);
                  $('#medical_qualification').val(txtmedical_qualification);
              }

              if(bank_account_name!='' && bsb!='' && account_number!='' )
              {
                  var txtbank_account_name  = decrypt(api, bank_account_name, key);
                  var txtbsb                = decrypt(api, bsb, key);
                  var txtaccount_number     = decrypt(api, account_number, key);

                  $('#bank_account_name').val(txtbank_account_name);
                  $('#bsb').val(txtbsb);
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
            
            var status_msg = $('#status_msg').val();
            if(status_msg != '')
            {
                $(".open_status_popup").click();
            }

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
                else if($.trim(bank_account_name) == '')
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
                    $('#err_bsb').html('Please select BSB.');
                    $('#err_bsb').fadeOut(4000);
                    return false;
                }
                else if($.trim(account_number) == '')
                {
                    $('#err_account_number').show();
                    $('#account_number').focus();
                    $('#err_account_number').html('Please select Account Number.');
                    $('#err_account_number').fadeOut(4000);
                    return false;
                }
                else
                {
                    /* Data Encryption */                    
                      var medical_qualification        = $('#medical_qualification').val();
                      var bank_account_name            = $('#bank_account_name').val();
                      var bsb                          = $('#bsb').val();
                      var account_number               = $('#account_number').val();

                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                      var txtmedical_qualification      = encrypt(api, medical_qualification, cards);
                      var txtbank_account_name          = encrypt(api, bank_account_name, cards);
                      var txtbsb                        = encrypt(api, bsb, cards);
                      var txtaccount_number             = encrypt(api, account_number, cards);

                      if(txtmedical_qualification != '' && txtbank_account_name != '' && txtbsb != '' && txtaccount_number != '')
                      {
                          $('#enc_medical_qualification').val(txtmedical_qualification);
                          $('#enc_bank_account_name').val(txtbank_account_name);
                          $('#enc_bsb').val(txtbsb);
                          $('#enc_account_number').val(txtaccount_number);
                          
                          $('#signup_step3').submit();
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

@endsection