@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead z-depth-2">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Official Documents & Verification</h1>
    </div>

    @if(isset($doctor_data) && !empty($doctor_data))
        @php
            $id_proof_file                    = isset($doctor_data['id_proof_file'])?$doctor_data['id_proof_file']:'';
            $medical_registration_no          = isset($doctor_data['medical_registration_no'])?$doctor_data['medical_registration_no']:'';
            $medicare_provider_no             = isset($doctor_data['medicare_provider_no'])?$doctor_data['medicare_provider_no']:'';
            $prescriber_no                    = isset($doctor_data['prescriber_no'])?$doctor_data['prescriber_no']:'';
            $ahpra_registration_no            = isset($doctor_data['ahpra_registration_no'])?$doctor_data['ahpra_registration_no']:'';
            $pi_insurance_policy              = isset($doctor_data['pi_insurance_policy'])?$doctor_data['pi_insurance_policy']:'';
            $medical_registration_certificate = isset($doctor_data['medical_registration_certificate'])?$doctor_data['medical_registration_certificate']:'';
            $cyber_liability_insurance_policy = isset($doctor_data['cyber_liability_insurance_policy'])?$doctor_data['cyber_liability_insurance_policy']:'';
            $user_dumpId                      = isset($doctor_data['userinfo']['dump_id'])?$doctor_data['userinfo']['dump_id']:'';
            $user_dumpSessionId               = isset($doctor_data['userinfo']['dump_session'])?$doctor_data['userinfo']['dump_session']:'';
        @endphp
    @endif

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <div class="container posrel has-header has-footer">
            <form id="signup_step4" class="signup_step4" method="POST" action="{{ url('/') }}/doctor/my_profile/update_official_documents_verification" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="fieldspres ">
                <p class="bluedoc-text center-align "><u>How is my information protected?</u></p>
                <p class="center-align bluedoc-text">All Documents uploaded must be certified by a referee.</p>
                
                <!-- @if(Session::has('redirect_msg'))
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12 text-bx lessmar">
                            {{ Session::get('redirect_msg') }}
                        </div>
                    </div>
                @endif -->

                <?php
                    $file       = $doc_id_proof.$id_proof_file;
                    $extension  = pathinfo($file, PATHINFO_EXTENSION); 
                ?>

                @if(isset($id_proof_file) && !empty($id_proof_file) && File::exists($doc_id_proof_public.$id_proof_file))
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar ">
                            <div class="uploaded-doc">
                                <a id="dec_id_proof_file" href="" class="valign-wrapper pres bluedoc-text" download><img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="margin-right-10px upload-img-icon" > <span> {{ $id_proof_file }} </span></a>
                                <input type="hidden" id="old_id_proof_file" name="old_id_proof_file" value="{{ $doc_id_proof.$id_proof_file }}" />
                            </div>
                        </div>
                    </div>
                @endif


                <div class="file-field input-field new-file-input  input-padding-25px doc-error" style="margin-top: 15px;">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="id_proof_file" name="id_proof_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" id="id_proof" name="id_proof" placeholder="Upload driver's licence or australian passport" >
                    </div>
                    <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                    <div class="err " style="display:none;" id="err_id_proof_file"></div>
                    @if(Session::has('id_proof_error'))
                        <div class="err error_msg">{{ Session::get('id_proof_error') }}</div>
                    @endif
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar  input-padding-25px">
                        <input type="text" id="medical_registration_no" name="medical_registration_no" class="validate" value="">
                        <label for="medical_registration_no" class="grey-text truncate active">Medical Registration No.</label>
                        <div class="err left-12px" style="display:none;" id="err_medical_registration_no"></div>
                    </div>
                </div>

                @if(isset($medical_registration_certificate) && !empty($medical_registration_certificate) && File::exists($doc_med_reg_public.$medical_registration_certificate))
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar ">
                            <div class="uploaded-doc">
                                <a id="dec_medical_registration_certificate_file" href="" class="valign-wrapper pres bluedoc-text" download><img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="margin-right-10px upload-img-icon" >  <span> {{ $medical_registration_certificate }} </span></a>
                                <input type="hidden" id="old_medical_registration_certificate" name="old_medical_registration_certificate" value="{{ $doc_med_reg.$medical_registration_certificate }}" />
                            </div>
                        </div>
                    </div>
                @endif

                <div class="file-field input-field new-file-input  input-padding-25px doc-error" style="margin-top: 15px;">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="medical_registration_certificate_file" name="medical_registration_certificate_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" id="medical_registration_certificate" name="medical_registration_certificate" placeholder="Upload current medical registration certificate">
                    </div>
                    <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                    <div class="err" style="display:none;" id="err_medical_registration_certificate"></div>
                    <input type="hidden" name="enc_medical_registration_no" id="enc_medical_registration_no" readonly="">

                    @if(Session::has('medical_registration_certificate_error'))
                        <div class="err error_msg">{{ Session::get('medical_registration_certificate_error') }}</div>
                    @endif
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="medicare_provider_no" name="medicare_provider_no" class="validate" value="">
                        <label for="medicare_provider_no" class="grey-text truncate active">Medicare Provider No.</label>
                        <div class="err left-12px" style="display:none;" id="err_medicare_provider_no"></div>
                        <input type="hidden" name="enc_medicare_provider_no" id="enc_medicare_provider_no" readonly="">
                    </div>
                    <div class="input-field col s12 m6 l6  text-bx lessmar input-padding-25px">
                        <input type="text" id="prescriber_no" name="prescriber_no" class="validate" value="">
                        <label for="prescriber_no" class="grey-text truncate active">Prescriber No.</label>
                        <div class="err left-12px" style="display:none;" id="err_prescriber_no"></div>
                        <input type="hidden" name="enc_prescriber_no" id="enc_prescriber_no" readonly="">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                        <input type="text" id="ahpra_registration_no" name="ahpra_registration_no" class="validate" value="">
                        <label for="ahpra_registration_no" class="grey-text truncate active">AHPRA Registration No.</label>
                        <div class="err left-12px" style="display:none;" id="err_ahpra_registration_no"></div>
                        <input type="hidden" name="enc_ahpra_registration_no" id="enc_ahpra_registration_no" readonly="">
                    </div>
                </div>

                <div class="otherdetails" style="margin-top: 30px;">
                    <h3 class="sethead "><strong>Professional Insurance </strong></h3>
                    <p class="bluedoc-text">
                        For peace of mind, you'll require Professional Indemnity insurance and Cyber Liability Insurance. You can obtain Cyber Liability Insurance online which is beneficial for covering both your online patient and personal security as well as doctoroo consultations. Policies start from as little as $5 a week. Please check with your insurer for details.
                    </p>

                    @if(isset($pi_insurance_policy) && !empty($pi_insurance_policy)  && File::exists($doc_ins_pol_public.$pi_insurance_policy))
                        <div class="row" style="margin-top: 10px;">
                            <div class="input-field col s12 m12 l12  text-bx lessmar ">
                                <div class="uploaded-doc">
                                    <a id="dec_pi_insurance_policy" href=""  class="valign-wrapper pres  bluedoc-text" download><img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="margin-right-10px upload-img-icon" >  <span>{{ $pi_insurance_policy }}</span></a>
                                    <input type="hidden" id="old_pi_insurance_policy" name="old_pi_insurance_policy" value="{{ $doc_ins_pol.$pi_insurance_policy }}" />
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="file-field input-field new-file-input input-padding-25px doc-error" style="margin-top: 15px;">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="pi_insurance_policy_file" name="pi_insurance_policy_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" id="pi_insurance_policy" name="pi_insurance_policy" placeholder="Upload professional indemnity insurance policy cover (inc. telehealth)">
                    </div>
                    <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                    <div class="err" style="display:none;" id="err_pi_insurance_policy_file"></div>
                    @if(Session::has('pi_insurance_policy_error'))
                        <div class="err error_msg">{{ Session::get('pi_insurance_policy_error') }}</div>
                    @endif
                </div>
                

                @if(isset($cyber_liability_insurance_policy) && !empty($cyber_liability_insurance_policy)  && File::exists($doc_cyb_liabl_public.$cyber_liability_insurance_policy))
                    <div class="row" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12  text-bx lessmar ">
                            <div class="uploaded-doc">
                                <a id="dec_cyber_liability_insurance_policy" href=""  class="valign-wrapper pres  bluedoc-text" download><img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="margin-right-10px upload-img-icon"  >  <span>{{ $cyber_liability_insurance_policy }}</span></a>
                                <input type="hidden" id="old_cyber_liability_insurance_policy" name="old_cyber_liability_insurance_policy" value="{{ $doc_cyb_liabl.$cyber_liability_insurance_policy }}" />
                            </div>
                        </div>
                    </div>
                @endif

                <div class="file-field input-field new-file-input input-padding-25px doc-error" style="margin-top: 15px;">
                    <div class="file-with-label">
                        <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                        <input type="file" id="cyber_liability_file" name="cyber_liability_file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate " type="text" id="cyber_liability_insurance_policy" name="cyber_liability_insurance_policy" placeholder="Upload cyber liability insurance policy cover">
                    </div>
                    <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                    <div class="err" style="display:none;" id="err_cyber_liability_file"></div>
                    @if(Session::has('cyber_liability_error'))
                        <div class="err error_msg ">{{ Session::get('cyber_liability_error') }}</div>
                    @endif
                </div>

                </div>

                <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/settings" class="border-btn round-corner center-align">Back</a></span>
                <span class="right qusame rescahnge">
                    <button type="button" class="btn_signup_step4 border-btn round-corner center-align" id="btn_signup_step4">Update</button>
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
      var token         = '{{ csrf_token () }}';

      $(document).ready(function(){
          var ahpra_registration_no     = '{{$ahpra_registration_no}}';
          var medical_registration_no   = '{{$medical_registration_no}}';
          var medicare_provider_no      = '{{$medicare_provider_no}}';
          var prescriber_no             = '{{$prescriber_no}}';
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              
              var api       = virgil.API(virgilToken);
              var key       = api.keys.import(dumpSessionId);

              if(ahpra_registration_no!='')
              {
                  var txtahpra_registration_no = decrypt(api, ahpra_registration_no, key);
                  $('#ahpra_registration_no').val(txtahpra_registration_no);
              }

              if(medical_registration_no!='' && medicare_provider_no!='' && prescriber_no!='' )
              {
                  var txtmedical_registration_no = decrypt(api, medical_registration_no, key);
                  var txtmedicare_provider_no  = decrypt(api, medicare_provider_no, key);
                  var txtprescriber_no         = decrypt(api, prescriber_no, key);

                  $('#medical_registration_no').val(txtmedical_registration_no);
                  $('#medicare_provider_no').val(txtmedicare_provider_no);
                  $('#prescriber_no').val(txtprescriber_no);
              }

                var id_proof_file = '{{ $doc_id_proof.$id_proof_file }}';
                if(id_proof_file!='')
                {
                    var id_proof_file_filename      = '{{ $id_proof_file }}';
                    var xhr = new XMLHttpRequest();
                    // this example with cross-domain issues.
                    xhr.open( "GET", id_proof_file, true );
                    // Ask for the result as an ArrayBuffer.
                    xhr.responseType = "blob";
                    xhr.onload = function( e ) {
                       var api         = virgil.API(virgilToken);
                       var key         = api.keys.import(dumpSessionId);
                       
                      // Obtain a blob: URL for the image data.
                      var file = this.response;
                      var mime_type = file.type;

                      var fileReader = new FileReader();
                      fileReader.readAsArrayBuffer(file);
                      fileReader.onload = function ()
                      {
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });
                        
                        var urlCreator = window.URL || window.webkitURL;
                        var imageUrl = urlCreator.createObjectURL( blob );
                        var img = document.querySelector( "#dec_id_proof_file" );
                        img.download = id_proof_file_filename;
                        img.href = imageUrl;
                      }
                    };
                    xhr.send();
                }

                var medical_registration_certificate_file = '{{ $doc_med_reg.$medical_registration_certificate }}';

                if(medical_registration_certificate_file!='')
                {
                    var medical_registration_certificate_file_filename      = '{{ $medical_registration_certificate }}';
                    var xhr = new XMLHttpRequest();
                    // this example with cross-domain issues.
                    xhr.open( "GET", medical_registration_certificate_file, true );
                    // Ask for the result as an ArrayBuffer.
                    xhr.responseType = "blob";
                    xhr.onload = function( e ) {
                       var api         = virgil.API(virgilToken);
                       var key         = api.keys.import(dumpSessionId);
                       
                      // Obtain a blob: URL for the image data.
                      var file = this.response;
                      var mime_type = file.type;

                      var fileReader = new FileReader();
                      fileReader.readAsArrayBuffer(file);
                      fileReader.onload = function ()
                      {
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });

                        var urlCreator = window.URL || window.webkitURL;
                        var imageUrl = urlCreator.createObjectURL( blob );
                        var img = document.querySelector( "#dec_medical_registration_certificate_file" );
                        img.download = medical_registration_certificate_file_filename;
                        img.href = imageUrl;
                      }
                    };
                    xhr.send();
                }

                var pi_insurance_policy_file = '{{ $doc_ins_pol.$pi_insurance_policy }}';

                if(pi_insurance_policy_file!='')
                {
                    var filename      = '{{ $pi_insurance_policy }}';
                    var xhr = new XMLHttpRequest();
                    // this example with cross-domain issues.
                    xhr.open( "GET", pi_insurance_policy_file, true );
                    // Ask for the result as an ArrayBuffer.
                    xhr.responseType = "blob";
                    xhr.onload = function( e ) {
                       var api         = virgil.API(virgilToken);
                       var key         = api.keys.import(dumpSessionId);
                       
                      // Obtain a blob: URL for the image data.
                      var file = this.response;
                      var mime_type = file.type;

                      var fileReader = new FileReader();
                      fileReader.readAsArrayBuffer(file);
                      fileReader.onload = function ()
                      {
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });

                        var urlCreator = window.URL || window.webkitURL;
                        var imageUrl = urlCreator.createObjectURL( blob );
                        var img = document.querySelector( "#dec_pi_insurance_policy" );
                        img.download = filename;
                        img.href = imageUrl;
                      }
                    };
                    xhr.send();
                }


                var cyber_liability_insurance_policy = '{{ $doc_cyb_liabl.$cyber_liability_insurance_policy }}';

                if(cyber_liability_insurance_policy!='')
                {
                    var cyber_liability_insurance_policy_filename      = '{{ $cyber_liability_insurance_policy }}';
                    var xhr = new XMLHttpRequest();
                    // this example with cross-domain issues.
                    xhr.open( "GET", cyber_liability_insurance_policy, true );
                    // Ask for the result as an ArrayBuffer.
                    xhr.responseType = "blob";
                    xhr.onload = function( e ) {
                       var api         = virgil.API(virgilToken);
                       var key         = api.keys.import(dumpSessionId);
                       
                      // Obtain a blob: URL for the image data.
                      var file = this.response;
                      var mime_type = file.type;

                      var fileReader = new FileReader();
                      fileReader.readAsArrayBuffer(file);
                      fileReader.onload = function ()
                      {
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });

                        var urlCreator = window.URL || window.webkitURL;
                        var imageUrl = urlCreator.createObjectURL( blob );
                        var img = document.querySelector( "#dec_cyber_liability_insurance_policy" );
                        img.download = cyber_liability_insurance_policy_filename;
                        img.href = imageUrl;
                      }
                    };
                    xhr.send();
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

            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);

            var formData = new FormData($(this)[0]);

            $('#btn_signup_step4').click(function(){
                var id_proof_file                       = $("#id_proof_file").val();
                var medical_registration_no             = $("#medical_registration_no").val();
                var medical_registration_certificate    = $("#medical_registration_certificate").val();
                var medicare_provider_no                = $("#medicare_provider_no").val();
                var prescriber_no                       = $("#prescriber_no").val();
                var ahpra_registration_no               = $("#ahpra_registration_no").val();
              
                var pi_insurance_policy                 = $("#pi_insurance_policy").val();
                var cyber_liability_insurance_policy    = $("#cyber_liability_insurance_policy").val();

                var old_id_proof_file                    = $('#old_id_proof_file').val();
                var old_medical_registration_certificate = $('#old_medical_registration_certificate').val();
                var old_pi_insurance_policy              = $('#old_pi_insurance_policy').val();
                var old_cyber_liability_insurance_policy = $('#old_cyber_liability_insurance_policy').val();

                if($.trim(old_id_proof_file) == '')
                {
                    if($.trim(id_proof_file) == '')
                    {
                        $('#err_id_proof_file').show();
                        $('#id_proof_file').focus();
                        $('#err_id_proof_file').html('Please select any image/document file.');
                        $('#err_id_proof_file').fadeOut(4000);
                        $("#id_proof_file").val('');
                        return false;
                    }
                }
                else if($.trim(medical_registration_no) == '')
                {
                    $('#err_medical_registration_no').show();
                    $('#medical_registration_no').focus();
                    $('#err_medical_registration_no').html('Please enter Medical Registration No.');
                    $('#err_medical_registration_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(old_medical_registration_certificate) == '')
                {
                    if($.trim(medical_registration_certificate) == '')
                    {
                        $('#err_medical_registration_certificate').show();
                        $('#medical_registration_certificate').focus();
                        $('#err_medical_registration_certificate').html('Please select any image/document file.');
                        $('#err_medical_registration_certificate').fadeOut(4000);
                        return false;
                    }
                }
                else if($.trim(prescriber_no) == '')
                {
                    $('#err_prescriber_no').show();
                    $('#prescriber_no').focus();
                    $('#err_prescriber_no').html('Please enter Prescriber No.');
                    $('#err_prescriber_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(ahpra_registration_no) == '')
                {
                    $('#err_ahpra_registration_no').show();
                    $('#ahpra_registration_no').focus();
                    $('#err_ahpra_registration_no').html('Please enter AHPRA Registration No.');
                    $('#err_ahpra_registration_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(old_pi_insurance_policy) == '') 
                {

                    if($.trim(pi_insurance_policy) == '')
                    {
                        $('#err_pi_insurance_policy').show();
                        $('#pi_insurance_policy').focus();
                        $('#err_pi_insurance_policy').html('Please enter PI Insurance Policy.');
                        $('#err_pi_insurance_policy').fadeOut(4000);
                        return false;
                    }
                }
                else if($.trim(old_cyber_liability_insurance_policy) == '')
                {
                    if($.trim(cyber_liability_insurance_policy) == '')
                    {
                        $('#err_cyber_liability_insurance_policy').show();
                        $('#cyber_liability_insurance_policy').focus();
                        $('#err_cyber_liability_insurance_policy').html('Please enter Cyber Liability Insurance Policy.');
                        $('#err_cyber_liability_insurance_policy').fadeOut(4000);
                        return false;
                    }
                }
                else
                {
                    /* Data Encryption */                    
                      var ahpra_registration_no     = $('#ahpra_registration_no').val();
                      var medical_registration_no   = $('#medical_registration_no').val();
                      var medicare_provider_no      = $('#medicare_provider_no').val();
                      var prescriber_no             = $('#prescriber_no').val();
                      
                      var api       = virgil.API(virgilToken);
                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                      var txtahpra_registration_no      = encrypt(api, ahpra_registration_no, cards);
                      var txtmedical_registration_no    = encrypt(api, medical_registration_no, cards);
                      var txtmedicare_provider_no       = encrypt(api, medicare_provider_no, cards);
                      var txtprescriber_no              = encrypt(api, prescriber_no, cards);

                      if(txtahpra_registration_no != '' && txtmedical_registration_no != '' && txtmedicare_provider_no != '' && txtprescriber_no != '')
                      {
                          $('#enc_ahpra_registration_no').val(txtahpra_registration_no);
                          $('#enc_medical_registration_no').val(txtmedical_registration_no);
                          $('#enc_medicare_provider_no').val(txtmedicare_provider_no);
                          $('#enc_prescriber_no').val(txtprescriber_no);
                          
                            formData.append('_token',token);
                            formData.append('old_id_proof_file',old_id_proof_file);
                            formData.append('old_medical_registration_certificate',old_medical_registration_certificate);
                            formData.append('old_pi_insurance_policy',old_pi_insurance_policy);
                            formData.append('old_cyber_liability_insurance_policy',old_cyber_liability_insurance_policy);

                            formData.append('enc_medical_registration_no',txtmedical_registration_no);
                            formData.append('enc_ahpra_registration_no',txtahpra_registration_no);
                            formData.append('enc_medicare_provider_no',txtmedicare_provider_no);
                            formData.append('enc_prescriber_no',txtprescriber_no);
                          
                          $.ajax({
                              url:'{{ url("/") }}/doctor/my_profile/update_official_documents_verification',
                              type:'post',
                              data:formData,
                              processData: false,
                              contentType: false,
                              success:function(data){
                               window.location.reload();
                              }
                          });
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
            
            var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

            $('#id_proof_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_id_proof_file').show();
                    $('#id_proof_file').focus();
                    $('#err_id_proof_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_id_proof_file').fadeOut(4000);
                    $("#id_proof_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_id_proof_file').show();
                    $('#id_proof_file').focus();
                    $('#err_id_proof_file').html('Max size allowed is 5mb.');
                    $('#err_id_proof_file').fadeOut(4000);
                    $("#id_proof_file").val('');
                    return false;
                }

                  var id_proof_file_obj = $(this)[0].files[0];
                  var filename  =  $(this).val().split('\\').pop();
                  var fileReader = new FileReader();
                  fileReader.readAsArrayBuffer(id_proof_file_obj);
                  fileReader.onload = function ()
                  {
                    var imageData    = fileReader.result;
                    var fileAsBuffer = new Buffer(imageData);
                    var api       = virgil.API(virgilToken);
                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                        var blob = new Blob([encryptedFile]);
                        var id_proof_file = new File([blob], filename);
                        formData.append('id_proof_file',id_proof_file);
                    });
                  }
            });

            $('#medical_registration_certificate_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_medical_registration_certificate').show();
                    $('#medical_registration_certificate').focus();
                    $('#err_medical_registration_certificate').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_medical_registration_certificate').fadeOut(4000);
                    $("#medical_registration_certificate").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_medical_registration_certificate').show();
                    $('#medical_registration_certificate').focus();
                    $('#err_medical_registration_certificate').html('Max size allowed is 5mb.');
                    $('#err_medical_registration_certificate').fadeOut(4000);
                    $("#medical_registration_certificate").val('');
                    return false;
                }

                  var medical_registration_certificate_file_obj = $(this)[0].files[0];
                  var filename  =  $(this).val().split('\\').pop();
                  var fileReader = new FileReader();
                  fileReader.readAsArrayBuffer(medical_registration_certificate_file_obj);
                  fileReader.onload = function ()
                  {
                    var imageData    = fileReader.result;
                    var fileAsBuffer = new Buffer(imageData);
                    var api       = virgil.API(virgilToken);
                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                        var blob = new Blob([encryptedFile]);
                        var medical_registration_certificate_file = new File([blob], filename);
                        formData.append('medical_registration_certificate_file',medical_registration_certificate_file);
                    });
                  }                
            });

            $('#pi_insurance_policy_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_pi_insurance_policy_file').show();
                    $('#pi_insurance_policy_file').focus();
                    $('#err_pi_insurance_policy_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_pi_insurance_policy_file').fadeOut(4000);
                    $("#pi_insurance_policy_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_pi_insurance_policy_file').show();
                    $('#pi_insurance_policy_file').focus();
                    $('#err_pi_insurance_policy_file').html('Max size allowed is 5mb.');
                    $('#err_pi_insurance_policy_file').fadeOut(4000);
                    $("#pi_insurance_policy_file").val('');
                    return false;
                }

                  var pi_insurance_policy_file_obj = $(this)[0].files[0];
                  var filename  =  $(this).val().split('\\').pop();
                  var fileReader = new FileReader();
                  fileReader.readAsArrayBuffer(pi_insurance_policy_file_obj);
                  fileReader.onload = function ()
                  {
                    var imageData    = fileReader.result;
                    var fileAsBuffer = new Buffer(imageData);
                    var api       = virgil.API(virgilToken);
                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                        var blob = new Blob([encryptedFile]);
                        var pi_insurance_policy_file = new File([blob], filename);

                        formData.append('pi_insurance_policy_file',pi_insurance_policy_file);
                    });
                  }
            });

            $('#cyber_liability_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_cyber_liability_file').show();
                    $('#cyber_liability_file').focus();
                    $('#err_cyber_liability_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_cyber_liability_file').fadeOut(4000);
                    $("#cyber_liability_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_cyber_liability_file').show();
                    $('#cyber_liability_file').focus();
                    $('#err_cyber_liability_file').html('Max size allowed is 5mb.');
                    $('#err_cyber_liability_file').fadeOut(4000);
                    $("#cyber_liability_file").val('');
                    return false;
                }

                  var cyber_liability_file_obj = $(this)[0].files[0];
                  var filename  =  $(this).val().split('\\').pop();
                  var fileReader = new FileReader();
                  fileReader.readAsArrayBuffer(cyber_liability_file_obj);
                  fileReader.onload = function ()
                  {
                    var imageData    = fileReader.result;
                    var fileAsBuffer = new Buffer(imageData);
                    var api       = virgil.API(virgilToken);
                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                        var blob = new Blob([encryptedFile]);
                        var cyber_liability_file = new File([blob], filename);

                        formData.append('cyber_liability_file',cyber_liability_file);
                    });
                  }
            });
        });
    </script>

@endsection