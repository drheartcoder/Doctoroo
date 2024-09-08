@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead z-depth-2">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align truncate">About Yourself</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    @if(isset($doctor_data) && !empty($doctor_data))
        @php
            $first_name         = isset($doctor_data['userinfo']['first_name'])?$doctor_data['userinfo']['first_name']:'';
            $last_name          = isset($doctor_data['userinfo']['last_name'])?$doctor_data['userinfo']['last_name']:'';
            $email              = isset($doctor_data['userinfo']['email'])?$doctor_data['userinfo']['email']:'';
            $title              = isset($doctor_data['userinfo']['title'])?$doctor_data['userinfo']['title']:'';
            $profile_image      = isset($doctor_data['userinfo']['profile_image'])?$doctor_data['userinfo']['profile_image']:'';
            $gender             = isset($doctor_data['gender'])?$doctor_data['gender']:'';
            $dob                = isset($doctor_data['dob'])?$doctor_data['dob']:'';
            $citizenship        = isset($doctor_data['citizenship'])?$doctor_data['citizenship']:'';
            $contact_no         = isset($doctor_data['contact_no'])?$doctor_data['contact_no']:'';
            $mobile_code        = isset($doctor_data['mobile_code'])?$doctor_data['mobile_code']:'';
            $mobile_no          = isset($doctor_data['mobile_no'])?decrypt_value($doctor_data['mobile_no']):'';
            $address            = isset($doctor_data['address'])?$doctor_data['address']:'';
            $timezone           = isset($doctor_data['timezone'])?$doctor_data['timezone']:'';
            $abn                = isset($doctor_data['abn'])?$doctor_data['abn']:'';
            $user_dumpId        = isset($doctor_data['userinfo']['dump_id'])?$doctor_data['userinfo']['dump_id']:'';
            $user_dumpSessionId = isset($doctor_data['userinfo']['dump_session'])?$doctor_data['userinfo']['dump_session']:'';
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
        <div class=" container posrel ">
            <form id="update_step1" class="update_step1" method="POST" action="{{ url('/') }}/doctor/my_profile/update_about_yourself">
            {{ csrf_field() }}

            <div class="fieldspres ">
                <p class="bluedoc-text">Note: All the fields are mandatory.</p>

                <!-- @if(Session::has('redirect_msg'))
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12 text-bx lessmar">
                            {{ Session::get('redirect_msg') }}
                        </div>
                    </div>
                @endif -->

                <div class="row" style="margin-top: 20px;">
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="first_name" name="first_name" class="validate" value="{{$first_name}}">
                        <label for="first_name" class="grey-text truncate">First Name <span class="required_field">*</span></label>
                        <div class="err error" style="display:none;" id="err_first_name"></div>
                        <input type="hidden" readonly="" name="enc_first_name" id="enc_first_name">
                    </div>
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="last_name" name="last_name" class="validate" value="{{$last_name}}">
                        <label for="last_name" class="grey-text truncate">Last Name <span class="required_field">*</span></label>
                        <div class="err error" style="display:none;" id="err_last_name"></div>
                        <input type="hidden" readonly="" name="enc_last_name" id="enc_last_name">
                    </div>
                </div>
                <div class="row" style="margin-top: 0px;"> 
                    <div class="input-field col s12 m6 l6 selct input-padding-25px ">
                        <select id="title" name="title">
                            <option value="">Title</option>
                            @if(isset($prefix_data) && !empty($prefix_data))
                                @foreach($prefix_data as $prefix)
                                    <option value="{{ $prefix['name'] }}" @if($prefix['name'] == $title) selected @endif>{{ $prefix['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="err left-12px" style="display:none;" id="err_title"></div>
                    </div>
                    <div class="input-field col s12 m6 l6 selct input-padding-25px">
                        <select id="gender" name="gender">
                            <option value="" disabled >Gender</option>
                            <option value="Male" {{ $gender == 'Male' ? 'selected' : ''}} >Male</option>
                            <option value="Female" {{ $gender == 'Female' ? 'selected' : ''}} >Female</option>
                        </select>
                        <div class="err left-12px" style="display:none;" id="err_gender"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12 text-bx lessmar input-padding-25px">
                        <input id="datebirth" name="datebirth" type="text" class="dob_datepicker ht45 validate" value="{{ date('d/m/Y',strtotime($dob)) }}">
                        <label class="active grey-text truncate" for="datebirth">Date of Birth <span class="required_field">*</span></label>
                        <div class="err left-12px" style="display:none;" id="err_datebirth"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;" >
                    <div class="input-field col s12 m12 l12 selct input-padding-25px ">
                        <select id="citizenship" name="citizenship">
                            <option value="">Are you Australian Citizen or Permanent Citizen</option>
                            <option value="Australian Citizen" {{ $citizenship == 'Australian Citizen' ? 'selected' : ''}} >Australian Citizen</option>
                            <option value="Permanent Citizen" {{ $citizenship == 'Permanent Citizen' ? 'selected' : ''}} >Permanent Citizen</option>
                        </select>
                        <div class="err left-12px" style="display:none;" id="err_citizenship"></div>
                    </div>
                </div>
                <div class="row marbtm40px" style="margin-top: 30px;">
                        <div class="input-field col s12 m6 l6  text-bx lessmar  input-padding-25px">
                            <input type="text" disabled id="email" name="email" class="validate" value="{{ $email }}">
                            <label for="email" class="grey-text truncate">Email</label>
                            <div class="err" style="display:none;" id="err_email"></div>
                            @if(Session::has('msg'))
                                <div class="err" id="already_exist">{{ Session::get('msg') }}</div>
                            @endif
                        </div>

                        <div class="input-field col s12 m6 l6  text-bx lessmar  input-padding-25px">
                            <input type="password" disabled id="password" name="password" class="validate" value="********" placeholder="" style="height: 43px!important;">
                            <label for="password" class="grey-text truncate">Password</label>
                            <div class="err" style="display:none;" id="err_password"></div>
                        </div>
                    </div>

                <div class="otherdetails">
                    <h3 class="sethead ">Contact Details</h3>
                    <div class="row" >
                        <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px " style="margin-top: 20px;">
                            <label class="grey-text truncate ">Contact No. </label>
                            <input type="text" id="contact_no" name="contact_no" class="validate" value="">
                            <div class="err left-12px" style="display:none;" id="err_contact_no"></div>
                            <input type="hidden" readonly="" name="enc_contact_no" id="enc_contact_no">
                        </div>
                        <div class="col s12 m6 l6 " style="margin-top: 20px;">
                            <div class="row posrel input-padding-25px">
                                <div class="col s5 m4 input-field selct ">
                                    <label class="grey-text truncate small-text-label">Mobile No. <span class="required_field">*</span></label>
                                    <select name="mobile_code" class="margin-2px new-code" id="mobile_code">
                                        <option value="">Code</option>
                                        @if(isset($mobcode_data) && !empty($mobcode_data))
                                            @foreach($mobcode_data as $mobcode)
                                                <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == $mobile_code) selected @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                            @endforeach
                                        @endif
                                    </select> 
                                    
                                </div>
                                <div class="input-field col s7 m8 text-bx lessmar">
                                    <input type="text" id="mobile_no" name="mobile_no" class="validate" value="{{$mobile_no}}">
                                </div>
                                <div class="err left-12px" style="display:none;" id="err_mobile_no"></div>
                                <div class="err left-12px" style="display:none;" id="err_mobile_code"></div>
                            </div>
                            <input type="hidden" readonly="" name="enc_mobile_no" id="enc_mobile_no">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                            <input type="text" id="address" name="address" class="materialize-textarea" placeholder="" value="" />
                            <label for="address" class="grey-text truncate">Address <span class="required_field">*</span></label>
                            <div class="err left-12px" style="display:none;" id="err_address"></div>
                            <input type="hidden" readonly="" name="enc_address" id="enc_address">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m6 l6 selct input-padding-25px">
                            <select id="timezone" name="timezone">
                                <option value="" >Time Zone</option>
                                @if(isset($timezone_data) && !empty($timezone_data))
                                    @foreach($timezone_data as $timezone1)
                                        For International timezone
                                        <option value="{{ $timezone1['id'] }}" @if($timezone1['id'] == $timezone) selected @endif >{{ $timezone1['location_name']. ' (' .$timezone1['utc_offset'].')' }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="err left-12px" style="display:none;" id="err_timezone"></div>
                        </div>
                        <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                            <input type="text" id="abn" name="abn" class="validate" value="{{ $abn }}">
                            <label for="abn" class="grey-text truncate">ABN</label>
                            <div class="err left-12px" style="display:none;" id="err_abn"></div>
                        </div>
                </div>
                
                </div>

                <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/settings" class="border-btn round-corner center-align">Back</a></span>
                <span class="right qusame rescahnge">
                    <button type="button" class="btn_update_step1 border-btn round-corner center-align" id="btn_update_step1">Update</button>
                </span>
                <div class="clr"></div>
            </div>
            </form>
        </div>
    <!--Container End-->
    </div>
    </div>

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
          
          /*var firstName    = '{{$first_name}}';
          var lastName     = '{{$last_name}}';*/
          //var mobile       = '{{$mobile_no}}';
          var address      = '{{$address}}';
          var contact_no   = '{{$contact_no}}';
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
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

              if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
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

    <!--  Scripts-->
    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>

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
            var status_msg = $('#status_msg').val();
            if(status_msg != '')
            {
                $(".open_status_popup").click();
            }

            setTimeout(function() {
                $('#already_exist').hide();
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

            $('#btn_update_step1').click(function(){
                var first_name      = $('#first_name').val();
                var last_name       = $('#last_name').val();
                var title           = $('#title').val();
                var gender          = $('#gender').val();
                var datebirth       = $('#datebirth').val();
                var citizenship     = $('#citizenship').val();
                var email           = $('#email').val();
                var password        = $('#password').val();
                var contact_no      = $('#contact_no').val();
                var mobile_code     = $('#mobile_code').val();
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
                    $('#err_datebirth').html('Please enter Date of Birth.');
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
                else if($.trim(mobile_code) == '')
                {
                    $('#err_mobile_code').show();
                    $('#mobile_code').focus();
                    $('#err_mobile_code').html('Please select Mobile Code.');
                    $('#err_mobile_code').fadeOut(4000);
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
                      if(contact_no!='')
                      {
                        var txtcontact_no = encrypt(api, contact_no, cards);
                        $('#enc_contact_no').val(txtcontact_no);
                      }

                      if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
                      {
                          /*$('#enc_first_name').val(txtfirst);
                          $('#enc_last_name').val(txtlast);*/
                          //$('#enc_mobile_no').val(txtmobile);
                          $('#enc_address').val(txtaddress);

                          $('#update_step1').submit();
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
        $("#address").geocomplete({
            details: ".geo-details",
            detailsAttribute: "data-geo",
        });
      });
    </script>

@endsection
