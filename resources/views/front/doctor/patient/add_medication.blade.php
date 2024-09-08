@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/medication-icon.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/doctor.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/doctor.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/doctor.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>

        <div id="medical" class="tab-content medi">
           <div class="doctor-container">
              <div class="head-medical-pres">
                 <h2 class="center-align">Medication &amp; Prescription</h2>
                 <span class="posleft qusame rescahnge "><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                 <span class="posright qusame rescahnge "><a href="javascript:void(0)" id="save_new_medication_details" class="btn cart bluedoc-bg lnht round-corner center-align">Save</a></span>
              </div>
              <div class="row">
                <form method="POST" class="store_medication_form" id="store_medication_form" action="{{ url('/') }}/doctor/patients/medication/store" enctype="multipart/form-data">
                <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ isset($enc_patient_id)?$enc_patient_id:'' }}">
                {{ csrf_field() }}
                 <div class="col m6 s12">
                    <div class="round-box z-depth-3">
                       <div class="heading-round-box">Medication Details</div>
                       <div class="green-border round-box-content edit-profile">
                          @if(isset($medication_arr_data) && !empty($medication_arr_data))
                          <div class="input-field selct maronytb">
                             <select id="cmb_exist_medication" name="cmb_exist_medication">
                                <option value="">Select existing medication Or add below</option>
                               </select>
                             <div class="err" id="err_cmb_exist_medication" style="display:none;"></div>
                             <input type="hidden" readonly="" name="enc_exist_medication" id="enc_exist_medication">
                          </div>
                          @endif
                          <div class="input-field text-bx lessmar input-padding-25px">
                             <input type="text" id="txt_name" name="txt_name" class="validate">
                             <input type="hidden" readonly="" name="enc_name" id="enc_name">

                             <label for="txt_name" class="grey-text truncate">Enter medication name or active ingredient</label>
                             <div class="err" id="err_txt_name" style="display:none;"></div>
                          </div>
                          <div class="input-field  text-bx lessmar input-padding-25px">
                             <input type="text" id="txt_reason" name="txt_reason" class="validate">
                             <input type="hidden" readonly="" name="enc_reason" id="enc_reason">
                             <label for="txt_reason" class="grey-text truncate">Enter use or reason for medication</label>
                             <div class="err" id="err_txt_reason" style="display:none;"></div>
                          </div>
                          <div class="input-field  text-bx lessmar input-padding-25px">
                             <input type="text" id="txt_duration" name="txt_duration" class="validate">
                             <input type="hidden" readonly="" name="enc_duration" id="enc_duration">
                             <label for="txt_duration" class="grey-text truncate">How long has this medication been taken?</label>
                             <div class="err" id="err_txt_duration" style="display:none;"></div>
                          </div>
                          <div class="clr"></div>
                       </div>
                       <div class="green-border-block-bottom"></div>
                    </div>
                 </div>
                 <div class="col m6 s12">
                    <div class="round-box z-depth-3">
                       <div class="heading-round-box">Recognisable Photo</div>
                       <div class="green-border posrel round-box-content table-img center-align">
                          <div class="table-row">
                             <div class="table-cell">
                                <span class="disinline">
                                   <span class="input-field uploadImgnew  input-padding-25px">
                                      <div class="file-field input-field">
                                         <span class="bluedoc-bg btn-floating center-align white-text circle">
                                         <span class="icon-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            <input type="file" id="upload_img" name="upload_img" multiple>
                                         </span>
                                      </div>
                                      <span class="clr"></span>
                                      <span class="icon-label">Upload New</span>
                                      <div class="err" id="err_upload_img" style="display:none;"></div>
                                      @if(Session::has('upload_img_error'))
                                          <div class="err error_msg">{{ Session::get('upload_img_error') }}</div>
                                      @endif
                                   </span>
                                </span>
                             </div>
                          </div>
                       </div>
                       <div class="green-border-block-bottom"></div>
                    </div>
                 </div>
                </form>
              </div>
              <div class="row">
                 <div class="col s12">
                    <div class="head-medical-pres">
                       <h2 class="center-align">Digital Prescription</h2>
                       <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="round-box z-depth-3">
                       <div class="blue-border-block-top"></div>
                       <div class="round-box-content blue-border disabled-item">
                          <div>
                             <div class="row posrel  hide-on-med-and-down  row-spacing-right-btm">
                                <div class="col l2 m6 s12 ">Prescription</div>
                                <div class="col l2 m6 s6">Repeats</div>
                                <div class="col l2 m6 s6">Directions</div>
                                <div class="col l3 m6 s6 valign-wrapper">Hardcopy Location <a class="tooltipped grey-text" data-position="bottom" data-delay="0" data-tooltip="I am a tooltip"><i class="material-icons">help_outline</i></a></div>
                                <div class="col l3 m6 s6 valign-wrapper">Pharmacy <a class="tooltipped grey-text" data-position="bottom" data-delay="30" data-tooltip="I am a tooltip"><i class="material-icons">help_outline</i></a></div>
                             </div>
                             
                             <div class="row posrel marbtm row-spacing-right-btm">
                                <div class="col l2 m12 s12 valign-wrapper presi">
                                   <div class="input-field uploadImgnew">
                                      <div class="file-field input-field">
                                         <span class="bluedoc-bg btn-floating center-align white-text circle not_allowed_here" style="background: #9e9e9e !important;">
                                         <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
                                         <!-- <input type="file" multiple> -->
                                         <input type="file" name="txt_uploaded_file" id="txt_uploaded_file">
                                         </span>
                                      </div>
                                      <div class="clr"></div>
                                   </div>
                                   Upload Digital Copy
                                </div>
                                <div class="col l2 m3 s12">
                                   <div class="input-field padno selct bluedoc-text doc grey-text not_allowed_here input-padding-25px">
                                      <select disabled>
                                         <option value="" disabled selected>Select</option>
                                      </select>
                                   </div>
                                </div>
                                <div class="col l2 m3 s12">
                                   <div class="truncate">
                                      <div class="input-field not_allowed_here input-padding-25px">
                                         <textarea id="textarea1" class="materialize-textarea enter-direction" placeholder="Enter Directions" disabled style="color: #9e9e9e !important;"></textarea>
                                      </div>
                                   </div>
                                </div>
                                <div class="col l3 m3 s12">
                                   <div class="input-field padno selct doc grey-text not_allowed_here input-padding-25px">
                                      <select disabled>
                                         <option value="" disabled selected>Select Location</option>
                                      </select>
                                   </div>
                                </div>
                                <div class="col l3 m3 s12">
                                   <div class="input-field padno selct doc grey-text not_allowed_here input-padding-25px">
                                      <select disabled>
                                         <option value="" disabled selected>Select</option>
                                      </select>
                                   </div>
                                </div>
                             </div>
                             <div class="center-align not_allowed_here">
                                <button class="btn bluedoc-bg round-corner center-align truncate" style="background: #9e9e9e !important;"> Save &amp; Add</button>
                             </div>
                          </div>
                       </div>
                       <div class="blue-border-block-bottom"></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>

    </div>

    <input type="hidden" class="response_msg" id="response_msg" name="response_msg" value="{{ Session::get('message') }}" />
    <a class="open_response_popup" href="#show_response_msg"></a>
    <div id="show_response_msg" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <a class="open_not_allowed_popup" href="#show_not_allowed"></a>
    <div id="show_not_allowed" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p>Important Note: First save medication details first and then prescription</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <script>
    $(document).ready(function(){

          var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
          var dumpSessionId = "{{ isset($user_data['dump_session'])?$user_data['dump_session']:'' }}";
          var dumpId        = "{{ isset($user_data['dump_id'])?$user_data['dump_id']:'' }}";
          var api           = virgil.API(virgilToken);
          var key           = api.keys.import(dumpSessionId);          

          function decrypt(api, enctext, key)
          {
              var decrpyttext = key.decrypt(enctext);
              var plaintext = decrpyttext.toString();
              return plaintext;
          }

          function encrypt(api, text, cards)
          {
            // encrypt the text using User's cards
            var encryptedMessage = api.encryptFor(text, cards);

            var encData = encryptedMessage.toString("base64");

            return encData;
          }

            $enc_patient_id         = $("#enc_patient_id").val();

            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);

            var response_msg = $('#response_msg').val();
            if(response_msg != '')
            {
                $(".open_response_popup").click();
            }

            $('#reload_page').click(function(){
                window.location.reload();
            });

            $('.not_allowed_here').click(function(){
                $(".open_not_allowed_popup").click();
            });

            $('#tab_patient_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/details/" + $enc_patient_id;
            });
            $('#tab_medical_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/medical_history/" + $enc_patient_id;
            });
            $('#tab_consultation_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_history/" + $enc_patient_id;
            });
            $('#tab_tools').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
            });
            $('#tab_chat').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/chats/" + $enc_patient_id;
            });
            $('#tab_consultation_guide').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_guide/" + $enc_patient_id;
            });

            var imageExtension = ['jpg','jpeg','png','gif','bmp'];
            $('#upload_img').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), imageExtension) == -1) {
                    $('#err_upload_img').show();
                    $('#upload_img').focus();
                    $('#err_upload_img').html("Please upload valid image with valid extension i.e "+imageExtension.join(', '));
                    $("#upload_img").val('');
                    setTimeout(function() { 
                        $("#err_upload_img").fadeOut();
                    }, 4000);
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_upload_img').show();
                    $('#upload_img').focus();
                    $('#err_upload_img').html('Max size allowed is 5mb.');
                    $("#upload_img").val('');
                    setTimeout(function() { 
                        $("#err_upload_img").fadeOut();
                    }, 4000);
                    return false;
                }
            });


            $('#save_new_medication_details').click(function(){

                var exist_medication    = $('#cmb_exist_medication').val();
                var is_exists           = $('#cmb_exist_medication').length;
                var name                = $('#txt_name').val();
                var reason              = $('#txt_reason').val();
                var duration            = $('#txt_duration').val();
                var upload_img          = $('#upload_img').val();
                var flag                = 1;


                if(is_exists == 1)
                {
                    if((exist_medication == "") && (name == ""))
                    {
                        $("#err_cmb_exist_medication").show();
                        $("#err_cmb_exist_medication").html("Please select existing medication or enter new medication name");
                        $("#cmb_exist_medication").focus();

                        $("#err_txt_name").show();
                        $("#err_txt_name").html("Please select existing medication or enter new medication name");
                        $("#txt_name").focus();

                        setTimeout(function() { 
                            $("#err_cmb_exist_medication").fadeOut();
                            $("#err_txt_name").fadeOut();
                        }, 4000);
                        flag = 0;
                    }
                    if((exist_medication != "") && (name != ""))
                    {
                        $("#err_cmb_exist_medication").show();
                        $("#err_cmb_exist_medication").html("Please don't select existing medication or enter medication name any 1 of them not both");
                        $("#cmb_exist_medication").focus();

                        $("#err_txt_name").show();
                        $("#err_txt_name").html("Please don't select existing medication or enter medication name any 1 of them not both");
                        $("#txt_name").focus();
                        
                        setTimeout(function() { 
                            $("#err_cmb_exist_medication").fadeOut();
                            $("#err_txt_name").fadeOut();
                        }, 4000);
                        flag = 0;
                    }
                }
                else
                {
                  if(name == "")
                    {
                        $("#err_txt_name").show();
                        $("#err_txt_name").html("Please select existing medication or enter new medication name");
                        $("#txt_name").focus();

                        setTimeout(function() { 
                            $("#err_txt_name").fadeOut();
                        }, 4000);
                        flag = 0;
                    }
                }
                
                if(reason == "")
                {
                    $("#err_txt_reason").show();
                    $("#err_txt_reason").html("Please enter reason");
                    $("#txt_reason").focus();
                    setTimeout(function() { 
                        $("#err_txt_reason").fadeOut();
                    }, 4000);
                    flag = 0;
                }
                if(duration == "")
                {
                    $("#err_txt_duration").show();
                    $("#err_txt_duration").html("Please enter duration");
                    $("#txt_duration").focus();
                    setTimeout(function() { 
                        $("#err_txt_duration").fadeOut();
                    }, 4000);
                    flag = 0;
                }
                if(upload_img == "")
                {
                    $("#err_upload_img").show();
                    $("#err_upload_img").html("Please select any image file");
                    $("#upload_img").focus();
                    setTimeout(function() { 
                        $("#err_upload_img").fadeOut();
                    }, 4000);
                    flag = 0;
                }
                if(flag == 0)
                {
                    return false;
                }
                else
                {
                  var findkey   = api.cards.get(dumpId).then(function (cards) {
                  
                  if(name!='')
                  {
                    var txtname     = encrypt(api, name, cards);
                    $("#enc_name").val(txtname);
                  }
                  
                  if(reason!='')
                  {
                    var txtreason     = encrypt(api, reason, cards);
                    $("#enc_reason").val(txtreason);
                  }
                  
                  if(duration!='')
                  {
                    var txtduration     = encrypt(api, duration, cards);
                    $("#enc_duration").val(txtduration);
                  }
                  
                  if(exist_medication!='')
                  {
                    var txtexist_medication     = encrypt(api, exist_medication, cards);
                    $("#enc_exist_medication").val(txtexist_medication);
                  }
                  
                  $("#store_medication_form").submit();
                    
                  }).then(null, function () {
                      console.log('Something went wrong.');
                  });

                  findkey.catch(function(error) {
                    console.log(error);
                  });
                }
            });

      <?php 
        if(isset($medication_arr_data) && !empty($medication_arr_data))
        {
       ?>

        var medication_arr_data = '<?php echo json_encode($medication_arr_data); ?>';
        var medication_arr_data = jQuery.parseJSON( medication_arr_data );

      $.each(medication_arr_data, function (inner_key, val) {
          var dec_medication_name   = decrypt(api, val.medication_name, key);
          var data = '<option value="'+dec_medication_name+'">'+dec_medication_name+'</option>';
          $('#cmb_exist_medication').append(data);
      });
      <?php } ?>
  
  });

    </script>


@endsection