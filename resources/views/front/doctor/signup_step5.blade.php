@include('front.doctor.layout._new_header')
    @php
    if(Session::has('doctor_signup.step5.about_me'))
    {
        $user_about_me = Session::has('doctor_signup.step5.about_me') && !empty(Session::get('doctor_signup.step5.about_me')) ? Session::get('doctor_signup.step5.about_me') : '';
    }
    else if(isset($exists_doctor_data['about_me']))
    {
        $user_about_me = isset($exists_doctor_data['about_me'])?$exists_doctor_data['about_me']:'';
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

    <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/signup/step4/{{isset($enc_id) ? $enc_id : ''}}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Personalize your profile for Patients</h1>
    </div>

    <div class="container posrel has-header has-footer">
        <style>
            .required_field
            {
                color:red;
            }
        </style>
        <form id="signup_step5" class="signup_step5" method="POST" action="{{ url('/') }}/doctor/signup/store_step5/{{isset($enc_id) ? $enc_id : ''}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="fieldspres ">
            <p class="bluedoc-text">Note: All the fields are mandatory</p>
            <div class="row" style="margin-top: 10px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <textarea id="about_me" name="about_me" class="materialize-textarea"></textarea>
                    <label for="about_me" class="grey-text truncate">About me summary <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_about_me"></div>
                    <input type="hidden" name="enc_about_me" id="enc_about_me" readonly="">

                </div>
            </div>
            <div class="file-field input-field new-file-input  input-padding-25px">
                <div class="file-with-label">
                    <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                    <input type="file" id="profile_pic_file" name="profile_pic_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate " type="text" id="profile_pic" name="profile_pic" placeholder="Upload a clear photo of your face">
                </div>
                <div class="err" style="display:none;" id="err_profile_pic_file"></div>
                @if(Session::has('image_type_error'))
                    <div class="err error_msg">{{ Session::get('image_type_error') }}</div>
                @endif
            </div>
            <div class="file-field input-field new-file-input marbtm40px input-padding-25px">
                <div class="file-with-label">
                    <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                    <input type="file" id="intro_video_file" name="intro_video_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="intro_video" name="intro_video" placeholder="Upload an introductory 30 seconds video">
                </div>
                <div class="err" style="display:none;" id="err_intro_video_file"></div>
                @if(Session::has('video_type_error'))
                    <div class="err error_msg">{{ Session::get('video_type_error') }}</div>
                @endif
            </div>
            
            <button type="button" class="btn_signup_step5 btn cart green lnht round-corner marbtm" id="btn_signup_step5">Submit Your Details</button>

            <small class="submit-message center-align ">By submitting your details, you agree to doctoroo's <a href="{{ url('/') }}/health/terms-and-condition" class="green-text">terms &amp; coditions</a> and <a href="{{ url('/') }}/health/privacy-policy"  class="green-text">privacy policy</a></small>
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
              var about_me     = "{{$user_about_me}}";
              
              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              if(about_me!='')
              {
                  var txtabout_me = decrypt(api, about_me, key);
                  $('#about_me').val(txtabout_me);
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
            $('#btn_signup_step5').click(function(){
                
                var about_me            = $('#about_me').val();
                var profile_pic_file    = $('#profile_pic_file').val();
                //var profile_file_size   = $("#profile_pic_file")[0].files[0].size;
                var intro_video_file    = $('#intro_video_file').val();
                //var video_file_size     = $("#intro_video_file")[0].files[0].size;

                if($.trim(about_me) == '')
                {
                    $('#err_about_me').show();
                    $('#about_me').focus();
                    $('#err_about_me').html('Please enter About me summary.');
                    $('#err_about_me').fadeOut(4000);
                    return false;
                }
                else if($.trim(profile_pic_file) == '')
                {
                    $('#err_profile_pic_file').show();
                    $('#profile_pic_file').focus();
                    $('#err_profile_pic_file').html('Please select image file.');
                    $('#err_profile_pic_file').fadeOut(4000);
                    return false;
                }
                else
                {
                      /* Data Encryption */                    
                      var about_me     = $('#about_me').val();
                      
                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                      var txtabout_me      = encrypt(api, about_me, cards);

                      if(txtabout_me != '')
                      {
                          $('#enc_about_me').val(txtabout_me);
                          $('#signup_step5').submit();
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

            $('#profile_pic_file').on('change', function(evt) {
                var imageExtension      = ['jpg','jpeg','png','gif','bmp'];
                if($.inArray($(this).val().split('.').pop().toLowerCase(), imageExtension) == -1)
                {
                    $('#err_profile_pic_file').show();
                    $('#profile_pic_file').focus();
                    $('#err_profile_pic_file').html("Please upload valid image/document with valid extension i.e "+imageExtension.join(', '));
                    $('#err_profile_pic_file').fadeOut(4000);
                    $("#profile_pic_file").val('');
                    return false;
                }
                else if(this.files[0].size > 5000000)
                {
                    $('#err_profile_pic_file').show();
                    $('#profile_pic_file').focus();
                    $('#err_profile_pic_file').html('Max size allowed is 5mb.');
                    $('#err_profile_pic_file').fadeOut(4000);
                    $('#profile_pic_file').val('');
                    return false;
                }
            });

            $('#intro_video_file').on('change', function(evt) {
                var videoExtension      = ['mp4','ogg','webm'];
                if($.inArray($(this).val().split('.').pop().toLowerCase(), videoExtension) == -1)
                {
                    $('#err_intro_video_file').show();
                    $('#intro_video_file').focus();
                    $('#err_intro_video_file').html("Please upload valid video with valid extension i.e "+videoExtension.join(', ')+' only.');
                    $('#err_intro_video_file').fadeOut(4000);
                    $("#intro_video_file").val('');
                    return false;
                }
                else if(this.files[0].size > 10000000)
                {
                    $('#err_intro_video_file').show();
                    $('#intro_video_file').focus();
                    $('#err_intro_video_file').html('Max size allowed is 10mb.');
                    $('#err_intro_video_file').fadeOut(4000);
                    $('#intro_video_file').val('');
                    return false;
                }
            });

            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);

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