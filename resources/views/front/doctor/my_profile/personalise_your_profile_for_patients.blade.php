@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead line-ht-less nopad z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Personalize your profile for Patients</h1>
    </div>

    @if(isset($doctor_data) && !empty($doctor_data))
        @php
            $about_me           = isset($doctor_data['about_me'])?$doctor_data['about_me']:'';
            $profile_video      = isset($doctor_data['profile_video'])?$doctor_data['profile_video']:'';
            $profile_image      = isset($doctor_data['userinfo']['profile_image'])?$doctor_data['userinfo']['profile_image']:'';
            $user_dumpId        = isset($doctor_data['userinfo']['dump_id'])?$doctor_data['userinfo']['dump_id']:'';
            $user_dumpSessionId = isset($doctor_data['userinfo']['dump_session'])?$doctor_data['userinfo']['dump_session']:'';
        @endphp
    @endif

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <div class="container posrel has-header has-footer">
            <form id="signup_step5" class="signup_step5" method="POST" action="{{ url('/') }}/doctor/my_profile/update_personalise_your_profile_for_patients" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="fieldspres ">
                <!-- @if(Session::has('redirect_msg'))
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12 text-bx lessmar">
                            {{ Session::get('redirect_msg') }}
                        </div>
                    </div>
                @endif -->


                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar ">
                        <textarea id="about_me" name="about_me" class="materialize-textarea input-padding-25px"></textarea>
                        <label for="about_me" class="grey-text truncate">About me summary</label>
                        <div class="err left-12px" style="display:none;" id="err_about_me"></div>
                        <input type="hidden" name="enc_about_me" id="enc_about_me" readonly="">
                    </div>
                </div>

                @if(isset($profile_image) && !empty($profile_image) && File::exists($doc_profile_public.$profile_image))
                    @php $src = $doctor_profile_pic.$profile_image @endphp

                 @else
                    @php $src = ""; @endphp
                @endif
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar ">
                            <div class="upload-photo-profile">
                                <img src="{{ $src }}" id="profile_pic_preview" />
                                <input type="hidden" id="old_profile_image" name="old_profile_image" value="{{ $doctor_profile_pic.$profile_image }}" />
                            </div>
                        </div>
                    </div>
                

                
                <div class="file-field input-field new-file-input">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="profile_pic_file" name="profile_pic_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate " type="text" id="profile_pic" name="profile_pic" placeholder="Upload a clear photo of your face">
                    </div>
                    <p class="bluedoc-text  input-padding-25px">Note: Please upload image with jpg/jpeg/png/gif/bmp extension only.</p>
                    <div class="err" style="display:none;" id="err_profile_pic_file"></div>
                    @if(Session::has('image_type_error'))
                        <div class="err error_msg">{{ Session::get('image_type_error') }}</div>
                    @endif
                </div>

                <!-- Data Decrypt -->
                <script type="text/javascript">
                  var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                  var dumpSessionId = '{{ $user_dumpSessionId }}';
                  var dumpId        = '{{ $user_dumpId }}';
                  $(document).ready(function(){
                      var about_me     = '{{$about_me}}';
                      
                      decryptMyData(virgilToken);
                      
                      function decryptMyData()
                      {
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
                    $('#profile_pic_file').on('change', function(evt) {
                        var imageExtension      = ['jpg','jpeg','png','gif','bmp'];
                        if($.inArray($(this).val().split('.').pop().toLowerCase(), imageExtension) == -1)
                        {
                            $('#err_profile_pic_file').show();
                            $('#profile_pic_file').focus();
                            $('#err_profile_pic_file').html("Please upload valid image with valid extension i.e "+imageExtension.join(', '));
                            $('#err_profile_pic_file').fadeOut(4000);
                            $('#profile_pic_preview').attr('src', '');
                            $("#profile_pic_file").val('');
                            return false;
                        }
                        else if(this.files[0].size > 5000000)
                        {
                            $('#err_profile_pic_file').show();
                            $('#profile_pic_file').focus();
                            $('#err_profile_pic_file').html('Max size allowed is 5mb.');
                            $('#err_profile_pic_file').fadeOut(4000);
                            $('#profile_pic_preview').attr('src', '');
                            $('#profile_pic_file').val('');
                            return false;
                        }
                        else
                        {
                            readURL(this);
                        }
                    });

                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#profile_pic_preview').attr('src', e.target.result);
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                </script>

                @if(isset($profile_video) && !empty($profile_video))
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar ">
                            <video width="100%" height="240" controls style="max-width: 350px; margin-bottom: 15px;">
                                <source src="{{ $doctor_profile_video.$profile_video }}" type="video/mp4">
                                <source src="{{ $doctor_profile_video.$profile_video }}" type="video/ogg">
                                <source src="{{ $doctor_profile_video.$profile_video }}" type="video/webm">
                            </video>
                            <input type="hidden" id="old_profile_video" name="old_profile_video" value="{{ $doctor_profile_video.$profile_video }}" />
                        </div>
                    </div>
                @endif

               
                <div class="file-field input-field new-file-input marbtm40px ">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="intro_video_file" name="intro_video_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" id="intro_video" name="intro_video" placeholder="Upload an introductory 30 seconds video">
                    </div>
                     <p class="bluedoc-text  input-padding-25px">Note: Please upload video with mp4/ogg/webm extension only.</p>
                    <div class="err" style="display:none;" id="err_intro_video_file"></div>
                    @if(Session::has('video_type_error'))
                        <div class="err error_msg">{{ Session::get('video_type_error') }}</div>
                    @endif
                </div>

                <script>
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
                </script>
                
                <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/settings" class="border-btn round-corner center-align">Back</a></span>
                <span class="right qusame rescahnge">
                    <button type="button" class="btn_signup_step5 border-btn round-corner center-align" id="btn_signup_step5">Update</button>
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


    <script>
        $(document).ready(function(){

            var status_msg = $('#status_msg').val();
            if(status_msg != '')
            {
                $(".open_status_popup").click();
            }
            

            $('#btn_signup_step5').click(function(){
                
                var about_me            = $('#about_me').val();

                var profile_pic_file    = $('#profile_pic_file').val();
                var old_profile_image   = $('#old_profile_image').val();

                var intro_video_file    = $('#intro_video_file').val();
                var old_profile_video   = $('#old_profile_video').val();

                if($.trim(about_me) == '')
                {
                    $('#err_about_me').show();
                    $('#about_me').focus();
                    $('#err_about_me').html('Please enter About me summary.');
                    $('#err_about_me').fadeOut(4000);
                    return false;
                }
                /*else if($.trim(old_profile_image) == '')
                {
                    if($.trim(profile_pic_file) == '')
                    {
                        $('#err_profile_pic_file').show();
                        $('#profile_pic_file').focus();
                        $('#err_profile_pic_file').html('Please select image file.');
                        $('#err_profile_pic_file').fadeOut(4000);
                        return false;
                    }
                }
                else if($.trim(old_profile_video) == '')
                {
                    else if($.trim(intro_video_file) == '')
                    {
                        $('#err_intro_video_file').show();
                        $('#intro_video_file').focus();
                        $('#err_intro_video_file').html('Please select video file.');
                        $('#err_intro_video_file').fadeOut(4000);
                        return false;
                    }
                }*/
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

            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);

        });
    </script>

@endsection