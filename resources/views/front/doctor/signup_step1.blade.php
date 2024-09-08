@include('front.doctor.layout._new_header')

    <div class="header ordermedHead z-depth-2 ">
        <h1 class="main-title center-align">About Yourself</h1>
    </div>

    <div class="container posrel has-header has-footer">
        <style>
            .required_field
            {
                color:red;
            }
        </style>

        @php
            $enc_doctor_id = isset($enc_doctor_id)?$enc_doctor_id:'';

            // first name
            if(Session::has('doctor_signup.step1.first_name'))
            {
                $user_firstname = Session::has('doctor_signup.step1.first_name') && !empty(Session::get('doctor_signup.step1.first_name')) ? Session::get('doctor_signup.step1.first_name') : '';
            }
            else if(isset($exists_doctor_data['userinfo']['first_name']))
            {
                $user_firstname = isset($exists_doctor_data['userinfo']['first_name'])?$exists_doctor_data['userinfo']['first_name']:'';
            }

            // last name
            if(Session::has('doctor_signup.step1.last_name'))
            {
                $user_lastname = Session::has('doctor_signup.step1.last_name') && !empty(Session::get('doctor_signup.step1.last_name')) ? Session::get('doctor_signup.step1.last_name') : '';
            }
            else if(isset($exists_doctor_data['userinfo']['last_name']))
            {
                $user_lastname = isset($exists_doctor_data['userinfo']['last_name'])?$exists_doctor_data['userinfo']['last_name']:'';
            }

            // email
            if(Session::has('doctor_signup.step1.email'))
            {
                $user_email = Session::has('doctor_signup.step1.email') && !empty(Session::get('doctor_signup.step1.email')) ? Session::get('doctor_signup.step1.email') : '';
            }
            else if(isset($exists_doctor_data['userinfo']['email']))
            {
                $user_email = isset($exists_doctor_data['userinfo']['email'])?$exists_doctor_data['userinfo']['email']:'';
            }

            // mobile number
            if(Session::has('doctor_signup.step1.mobile_no'))
            {
                $user_mobile_no = Session::has('doctor_signup.step1.mobile_no') && !empty(Session::get('doctor_signup.step1.mobile_no')) ? decrypt_value(Session::get('doctor_signup.step1.mobile_no')) : '';
            }
            else if(isset($exists_doctor_data['mobile_no']))
            {
                $user_mobile_no = isset($exists_doctor_data['mobile_no'])?decrypt_value($exists_doctor_data['mobile_no']):'';
            }

            // Contact number
            if(Session::has('doctor_signup.step1.contact_no'))
            {
                $user_contact_no = Session::has('doctor_signup.step1.contact_no') && !empty(Session::get('doctor_signup.step1.contact_no')) ? Session::get('doctor_signup.step1.contact_no') : '';
            }
            else if(isset($exists_doctor_data['contact_no']))
            {
                $user_contact_no = isset($exists_doctor_data['contact_no'])?$exists_doctor_data['contact_no']:'';
            }            

            // mobile number code
            if(Session::has('doctor_signup.step1.mobile_code'))
            {
                $user_mobile_code = Session::has('doctor_signup.step1.mobile_code') && !empty(Session::get('doctor_signup.step1.mobile_code')) ? Session::get('doctor_signup.step1.mobile_code') : '';
            }
            else if(isset($exists_doctor_data['mobile_code']))
            {
                $user_mobile_code = isset($exists_doctor_data['mobile_code'])?$exists_doctor_data['mobile_code']:'';
            }

            // gender
            if(Session::has('doctor_signup.step1.gender'))
            {
                $user_gender = Session::has('doctor_signup.step1.gender') && !empty(Session::get('doctor_signup.step1.gender')) ? Session::get('doctor_signup.step1.gender') : '';
            }
            else if(isset($exists_doctor_data['gender']))
            {
                $user_gender = isset($exists_doctor_data['gender'])?$exists_doctor_data['gender']:'';
            }

            // address
            if(Session::has('doctor_signup.step1.address'))
            {
                $user_address = Session::has('doctor_signup.step1.address') && !empty(Session::get('doctor_signup.step1.address')) ? Session::get('doctor_signup.step1.address') : '';
            }
            else if(isset($exists_doctor_data['address']))
            {
                $user_address = isset($exists_doctor_data['address'])?$exists_doctor_data['address']:'';
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

        <form id="signup_step1" class="signup_step1" method="POST" action="{{ url('/') }}/doctor/signup/store_step1/{{ $enc_doctor_id }}">
        {{ csrf_field() }}

        <div class="fieldspres ">
            <p class="bluedoc-text">Note: All the fields are mandatory</p>

            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="first_name" name="first_name" class="validate check_value" value="{{$user_firstname}}">
                    <label for="first_name" class="grey-text truncate">First Name <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_first_name"></div>
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="last_name" name="last_name" class="validate check_value" value="{{$user_lastname}}">
                    <label for="last_name" class="grey-text truncate">Last Name <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_last_name"></div>
                </div>
                <input type="hidden" readonly="" name="enc_first_name" id="enc_first_name">

            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6 selct input-padding-25px">
                    <select id="title" name="title">
                        <option value="" disabled selected>Title</option>
                        @if(isset($prefix_data) && !empty($prefix_data))
                            @foreach($prefix_data as $prefix)
                                <option value="{{ $prefix['name'] }}" {{Session::get('doctor_signup.step1.title') == $prefix['name'] ? 'selected' : '' }}>{{ $prefix['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="err left-12px" style="display:none;" id="err_title"></div>
                </div>
                <div class="input-field col s6 m6 l6 selct  input-padding-25px">
                    <select id="gender" name="gender">
                        <option value="" disabled selected>Gender</option>
                        <option value="Male" {{ $user_gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user_gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <div class="err left-12px" style="display:none;" id="err_gender"></div>
                </div>
                <input type="hidden" readonly="" name="enc_last_name" id="enc_last_name">
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12 text-bx lessmar  input-padding-25px">
                    <input id="datebirth" name="datebirth" type="text" class="dob_datepicker ht45 validate check_value" value="{{ Session::has('doctor_signup.step1.datebirth_submit') && !empty(Session::get('doctor_signup.step1.datebirth_submit')) ? Session::get('doctor_signup.step1.datebirth_submit') : '' }}">
                    <label class="active grey-text truncate" for="datebirth">Date of Birth <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_datebirth"></div>
                </div>
            </div>
            <div class="row marbtm40px" style="margin-top: 20px;" >
                <div class="input-field col s12 m12 l12 selct input-padding-25px">
                    <select id="citizenship" name="citizenship">
                        <option value="" disabled selected>Are you Australian Citizen or Permanent Citizen</option>
                        <option value="Australian Citizen" {{Session::get('doctor_signup.step1.citizenship') == 'Australian Citizen' ? 'selected' : '' }}>Australian Citizen</option>
                        <option value="Permanent Citizen" {{Session::get('doctor_signup.step1.citizenship') == 'Permanent Citizen' ? 'selected' : '' }}>Permanent Citizen</option>
                    </select>
                    <div class="err left-12px" style="display:none;" id="err_citizenship"></div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                    
                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="email" name="email" class="validate check_value" value="{{ $user_email }}" disabled>
                        <label for="email" class="grey-text truncate">Email <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_email"></div>
                        @if(Session::has('msg'))
                            <div class="err left-12px already_exist">{{ Session::get('msg') }}</div>
                        @endif
                    </div>

                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="password" id="password" name="password" class="validate check_value" value="{{ Session::has('doctor_signup.step1.password') && !empty(Session::get('doctor_signup.step1.password')) ? Session::get('doctor_signup.step1.password') : '' }}" style="height: 43px!important;" >
                        <label for="password" class="grey-text truncate">Password <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_password"></div>
                    </div>
                </div>

            <div class="otherdetails">
                <h3 class="sethead ">Contact Details</h3>
                <div class="row" >
                    <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px" style="margin-top: 20px;">
                        <input type="text" id="contact_no" name="contact_no" class="validate check_value" value="">
                        <label class="grey-text truncate small-text-label">Contact No. </label>
                        <div class="err left-12px" style="display:none;" id="err_contact_no"></div>
                        <input type="hidden" readonly="" name="enc_contact_no" id="enc_contact_no">
                    </div>

                    <div class="col s12 m6 l6 " style="margin-top: 20px;">
                        <div class="row">
                            <div class="col s4 input-field selct input-padding-25px">
                                <label class="grey-text truncate small-text-label">Mobile No. <span class="required_field">*</span></label>
                                <select name="mobile_no_code" id="mobile_no_code" disabled>
                                    <option value="" selected>Code</option>
                                    @if(isset($mobcode_data) && !empty($mobcode_data))
                                        @foreach($mobcode_data as $mobcode)
                                            <option value="{{ $mobcode['id'] }}" @if($user_mobile_code == $mobcode['id']) selected @elseif($mobcode['id'] == '13') selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="input-field col s8 text-bx lessmar input-padding-25px">
                                <input type="text" id="mobile_no" name="mobile_no" class="validate" value="{{$user_mobile_no}}" readonly>
                                <div class="err left-12px" style="display:none;" id="err_mobile_no"></div>
                                <div class="err left-12px" style="display:none;" id="err_mobile_no_code"></div>
                                @if(Session::has('mobile_error_msg'))
                                    <div class="err left-12px already_exist">{{ Session::get('mobile_error_msg') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                        <input type="hidden" readonly="" name="enc_mobile_no" id="enc_mobile_no">
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="address" name="address" class="materialize-textarea check_value" placeholder="" value="" />
                        <label for="address" class="grey-text truncate">Address <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_address"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                <div class="input-field col s6 m6 l6 selct input-padding-25px">
                    <select id="timezone" name="timezone">
                        <option disabled selected>Time Zone</option>
                        
                        @if(isset($timezone_data) && !empty($timezone_data))
                            @foreach($timezone_data as $timezone)

                                <option value="{{ $timezone['id'] }}" {{Session::get('doctor_signup.step1.timezone') == $timezone['id'] ? 'selected' : '' }}>{{ $timezone['location_name'].' ('.$timezone['utc_offset'].')' }}</option>

                            @endforeach
                        @endif
                    </select>
                    <div class="err left-12px" style="display:none;" id="err_timezone"></div>
                    <input type="hidden" readonly="" name="enc_address" id="enc_address">
                </div>

                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="abn" name="abn" class="validate check_value" value="{{ Session::has('doctor_signup.step1.abn') && !empty(Session::get('doctor_signup.step1.abn')) ? Session::get('doctor_signup.step1.abn') : '' }}">
                    <label for="abn" class="grey-text truncate">ABN <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_abn"></div>
                </div>

            </div>
            
            </div>

            <span class="right qusame rescahnge">
                <button type="button" class="btn_signup_step1 border-btn round-corner center-align" id="btn_signup_step1">Next Step ></button>
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
    <!-- <script src="{{ url('/') }}/public/doctor_section/js/materialize.min.js"></script> -->
    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>

    <!-- Data Decrypt -->
    <script type="text/javascript">
      var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
      var dumpSessionId = '{{ $user_dumpSessionId }}';
      var dumpId        = '{{ $user_dumpId }}';

      $(document).ready(function(){
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              /*var firstName    = "{{$user_firstname}}";
              var lastName     = "{{$user_lastname}}";*/
              // /var mobile       = "{{$user_mobile_no}}";
              var address      = "{{$user_address}}";
              var contact_no   = "{{$user_contact_no}}";

              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              /*var txtfirst   = decrypt(api, firstName, key);
              var txtlast    = decrypt(api, lastName, key);*/
              //var txtmobile  = decrypt(api, mobile, key);
              var txtaddress = decrypt(api, address, key);

              if(contact_no!='')
              {
                var txtcontact_no = decrypt(api, contact_no, key);
                $('#contact_no').val(txtcontact_no);
              }

              if(/*txtfirst != '' && txtlast != '' && txtmobile != '' && */txtaddress != '')
              {
                  /*$('#first_name').val(txtfirst);
                  $('#last_name').val(txtlast);*/
                  //$('#mobile_no').val(txtmobile);
                  $('#address').val(txtaddress);
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
        $('.dob_datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 150, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            //selectYears: 100, // `true` defaults to 10.
            //min: new Date(2015,3,20),
            max:new Date(),
            // Accessibility labels
            /*labelMonthNext: 'Next month',
            labelMonthPrev: 'Previous month',
            labelMonthSelect: 'Select a month',
            labelYearSelect: 'Select a year',*/
            onOpen: function() {
              console.log( 'Opened')
            },
            onClose: function() {
              console.log( 'Closed ' + this.$node.val() )
              
              selected_date = this.$node.val();
            },
            onSelect: function() {
              console.log( 'Selected: ' + this.$node.val() )
            },
            onStart: function() {
              console.log( 'Hello there :)' )
            }
        });

        $(document).ready(function(){
            setTimeout(function() {
                $('.already_exist').hide();
            }, 5000);

            // number validation for contact no
            $('#contact_no, #mobile_no').keydown(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
                $(this).keyup(function(){
                    $(this).val($(this).val().replace(/[^\d]/,''));
                });
            });

            $('#first_name, #last_name').keydown(function(){
                $(this).val($(this).val().replace(/[^a-z A-Z]/,''));
                $(this).keyup(function(){
                    $(this).val($(this).val().replace(/[^a-z A-Z]/,''));
                });
            });

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
                        $('#err_email').html('Please enter valid Email.');
                        $('#err_email').fadeOut(4000);
                        return false;  
                    }

                    $.ajax({
                        url   : "{{ url('/') }}/doctor/duplicate/email",
                        type : "GET",
                        data: {email_id:email},
                        success : function(res)
                        {
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

            $('#btn_signup_step1').click(function(){
                var first_name      = $('#first_name').val();
                var last_name       = $('#last_name').val();
                var title           = $('#title').val();
                var gender          = $('#gender').val();
                var datebirth       = $('#datebirth').val();
                var citizenship     = $('#citizenship').val();
                var email           = $('#email').val();
                var password        = $('#password').val();
                var contact_no      = $('#contact_no').val();
                var mobile_no_code  = $('#mobile_no_code').val();
                var mobile_no       = $('#mobile_no').val();
                var address         = $('#address').val();
                var timezone        = $('#timezone').val();
                var abn             = $("#abn").val();
                var email_filter    = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var alpha           = /^[a-zA-Z ]*$/;
                var integers        = /^[0-9]*$/;

                if($.trim(first_name) == '')
                {
                    $('#err_first_name').show();
                    $('#first_name').focus();
                    $('#err_first_name').html('Please enter First Name.');
                    $('#err_first_name').fadeOut(4000);
                    return false;
                }
                else if(!alpha.test(first_name))
                {
                    $('#err_first_name').show();
                    $('#first_name').focus();
                    $('#err_first_name').html('Please enter valid First Name.');
                    $('#err_first_name').fadeOut(4000);
                    return false;
                }
                else if($.trim(last_name) == '')
                {
                    $('#err_last_name').show();
                    $('#last_name').focus();
                    $('#err_last_name').html('Please enter Last Name.');
                    $('#err_last_name').fadeOut(4000);
                    return false;
                }   
                else if(!alpha.test(last_name))
                {
                    $('#err_last_name').show();
                    $('#last_name').focus();
                    $('#err_last_name').html('Please enter valid Last Name.');
                    $('#err_last_name').fadeOut(4000);
                    return false;
                }
                else if($.trim(title) == '')
                {
                    $('#err_title').show();
                    $('#title').focus();
                    $('#err_title').html('Please select Title.');
                    $('#err_title').fadeOut(4000);
                    return false;
                }
                else if($.trim(gender) == '')
                {
                    $('#err_gender').show();
                    $('#gender').focus();
                    $('#err_gender').html('Please select Gender.');
                    $('#err_gender').fadeOut(4000);
                    return false;
                }
                else if($.trim(datebirth) == '')
                {
                    $('#err_datebirth').show();
                    $('#datebirth').focus();
                    $('#err_datebirth').html('Please select Date of Birth.');
                    $('#err_datebirth').fadeOut(4000);
                    return false;
                }
                else if($.trim(citizenship) == '')
                {
                    $('#err_citizenship').show();
                    $('#citizenship').focus();
                    $('#err_citizenship').html('Please select Citizenship.');
                    $('#err_citizenship').fadeOut(4000);
                    return false;
                }
                else if($.trim(email) == '')
                {
                    $('#err_email').show();
                    $('#email').focus();
                    $('#err_email').html('Please enter Email.');
                    $('#err_email').fadeOut(4000);
                    return false;
                }
                else if(!email_filter.test(email))
                {
                    $('#err_email').show();
                    $('#email').focus();
                    $('#err_email').html('Please enter valid Email.');
                    $('#err_email').fadeOut(4000);
                    return false;
                }
                else if($.trim(password) == '')
                {
                    $('#err_password').show();
                    $('#password').focus();
                    $('#err_password').html('Please enter Password.');
                    $('#err_password').fadeOut(4000);
                    return false;
                }
                else if($.trim(contact_no) == '')
                {
                    $('#err_contact_no').show();
                    $('#contact_no').focus();
                    $('#err_contact_no').html('Please enter Contact no.');
                    $('#err_contact_no').fadeOut(4000);
                    return false;
                }
                else if(!integers.test(contact_no))
                {
                    $('#err_contact_no').show();
                    $('#contact_no').focus();
                    $('#err_contact_no').html('Please enter valid Contact no.');
                    $('#err_contact_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(mobile_no_code) == '')
                {
                    $('#err_mobile_no_code').show();
                    $('#mobile_no_code').focus();
                    $('#err_mobile_no_code').html('Please enter Mobile no code.');
                    $('#err_mobile_no_code').fadeOut(4000);
                    return false;
                }
                else if($.trim(mobile_no) == '')
                {
                    $('#err_mobile_no').show();
                    $('#mobile_no').focus();
                    $('#err_mobile_no').html('Please enter Mobile no.');
                    $('#err_mobile_no').fadeOut(4000);
                    return false;
                }
                else if(!integers.test(mobile_no))
                {
                    $('#err_mobile_no').show();
                    $('#mobile_no').focus();
                    $('#err_mobile_no').html('Please enter valid Mobile no.');
                    $('#err_mobile_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(address) == '')
                {
                    $('#err_address').show();
                    $('#address').focus();
                    $('#err_address').html('Please enter Address.');
                    $('#err_address').fadeOut(4000);
                    return false;
                }
                else if($.trim(timezone) == '')
                {
                    $('#err_timezone').show();
                    $('#timezone').focus();
                    $('#err_timezone').html('Please select Timezone.');
                    $('#err_timezone').fadeOut(4000);
                    return false;
                }
                else if($.trim(abn) == '')
                {
                    $('#err_abn').show();
                    $('#abn').focus();
                    $('#err_abn').html('Please enter ABN.');
                    $('#err_abn').fadeOut(4000);
                    return false;
                }
                else
                {
                      /* Data Encryption */                    
/*                      var firstName    = $('#first_name').val();
                      var lastName     = $('#last_name').val();*/
                      var mobile       = $('#mobile_no').val();
                      var address      = $('#address').val();
                      var contact_no   = $('#contact_no').val();

                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

/*                      var txtfirst      = encrypt(api, firstName, cards);
                      var txtlast       = encrypt(api, lastName, cards);*/
                      //var txtmobile     = encrypt(api, mobile, cards);
                      var txtaddress    = encrypt(api, address, cards);
                      var txtcontact_no = encrypt(api, contact_no, cards);

                      if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '' && txtcontact_no != '')
                      {
                          /*$('#enc_first_name').val(txtfirst);
                          $('#enc_last_name').val(txtlast);*/
                          // /$('#enc_mobile_no').val(txtmobile);
                          $('#enc_address').val(txtaddress);
                          $('#enc_contact_no').val(txtcontact_no);

                          $('#signup_step1').submit();
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

            var check_value = $('.check_value').val();
            if(check_value != '' && check_value != null)
            {
                $('.check_value').next('label').addClass('active');
            }
            else
            {
                $('.check_value').next('label').removeClass('active');
            }

        });
    </script>

    @include('google_api.google')
    <script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
    <script>
      $(document).ready(function(){
        var location = "Australia";
        $("#address").geocomplete({
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