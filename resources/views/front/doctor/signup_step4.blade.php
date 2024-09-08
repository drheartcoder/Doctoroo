@include('front.doctor.layout._new_header')

    <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/signup/step3/{{isset($enc_id) ? $enc_id : ''}}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Official Documents & Verification</h1>
    </div>

    <div class="container posrel has-header has-footer">
        <style>
            .required_field
            {
                color:red;
            }
        </style>

        @php
            //ahpra_registration
            if(Session::has('doctor_signup.step4.ahpra_registration_no'))
            {
                $ahpra_registration_no = Session::has('doctor_signup.step4.ahpra_registration_no') && !empty(Session::get('doctor_signup.step4.ahpra_registration_no')) ? Session::get('doctor_signup.step4.ahpra_registration_no') : '';
            }
            else if(isset($exists_doctor_data['ahpra_registration_no']))
            {
                $ahpra_registration_no = isset($exists_doctor_data['ahpra_registration_no'])?$exists_doctor_data['ahpra_registration_no']:'';
            }

            //medical_registration_no
            if(Session::has('doctor_signup.step4.medical_registration_no'))
            {
                $medical_registration_no = Session::has('doctor_signup.step4.medical_registration_no') && !empty(Session::get('doctor_signup.step4.medical_registration_no')) ? Session::get('doctor_signup.step4.medical_registration_no') : '';
            }
            else if(isset($exists_doctor_data['medical_registration_no']))
            {
                $medical_registration_no = isset($exists_doctor_data['medical_registration_no'])?$exists_doctor_data['medical_registration_no']:'';
            }

            //medicare_provider_no
            if(Session::has('doctor_signup.step4.medicare_provider_no'))
            {
                $medicare_provider_no = Session::has('doctor_signup.step4.medicare_provider_no') && !empty(Session::get('doctor_signup.step4.medicare_provider_no')) ? Session::get('doctor_signup.step4.medicare_provider_no') : '';
            }
            else if(isset($exists_doctor_data['medicare_provider_no']))
            {
                $medicare_provider_no = isset($exists_doctor_data['medicare_provider_no'])?$exists_doctor_data['medicare_provider_no']:'';
            }

            //prescriber_no
            if(Session::has('doctor_signup.step4.prescriber_no'))
            {
                $prescriber_no = Session::has('doctor_signup.step4.prescriber_no') && !empty(Session::get('doctor_signup.step4.prescriber_no')) ? Session::get('doctor_signup.step4.prescriber_no') : '';
            }
            else if(isset($exists_doctor_data['prescriber_no']))
            {
                $prescriber_no = isset($exists_doctor_data['prescriber_no'])?$exists_doctor_data['prescriber_no']:'';
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


        <form id="signup_step4" class="signup_step4" method="POST" action="{{ url('/') }}/doctor/signup/store_step4/{{isset($enc_id) ? $enc_id : ''}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="fieldspres ">
          <p class="bluedoc-text center-align "><u>How is my information protected?</u></p>
           <p class="center-align bluedoc-text">All Documents uploaded must be certified by a referee</p>
           <p class="bluedoc-text">Note: All the fields are mandatory but this step can be skip and save for later.</p>
            <div class="file-field input-field new-file-input input-padding-25px">
                <div class="file-with-label">
                    <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                    <input type="file" id="id_proof_file" name="id_proof_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="id_proof" name="id_proof" placeholder="Upload driver's licence or australian passport">
                </div>
                <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                <div class="err" style="display:none;" id="err_id_proof_file"></div>
                @if(Session::has('id_proof_error'))
                    <div class="err error_msg left-12px">{{ Session::get('id_proof_error') }}</div>
                @endif
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar  input-padding-25px">
                    <input type="text" id="medical_registration_no" name="medical_registration_no" class="validate"  value="">
                    <label for="medical_registration_no" class="grey-text truncate">Medical Registration No. <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_medical_registration_no"></div>
                    <input type="hidden" name="enc_medical_registration_no" id="enc_medical_registration_no" readonly="">
                </div>
            </div>
            <div class="file-field input-field new-file-input  input-padding-25px">
                <div class="file-with-label">
                    <span class="btn bluedoc-bg circle"><i class="material-icons">attach_file</i></span>
                    <input type="file" id="medical_registration_certificate_file" name="medical_registration_certificate_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="medical_registration_certificate" name="medical_registration_certificate" placeholder="Upload current medical registration certificate">
                </div>
                <p class="bluedoc-text">Note: Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</p>
                <div class="err" style="display:none;" id="err_medical_registration_certificate_file"></div>
                @if(Session::has('medical_registration_certificate_error'))
                    <div class="err error_msg left-12px">{{ Session::get('medical_registration_certificate_error') }}</div>
                @endif
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar input-padding-25px">
                    <input type="text" id="medicare_provider_no" name="medicare_provider_no" class="validate" value="">
                    <label for="medicare_provider_no" class="grey-text truncate">Medicare Provider No.</label>
                    <div class="err left-12px" style="display:none;" id="err_medicare_provider_no"></div>
                    <input type="hidden" name="enc_medicare_provider_no" id="enc_medicare_provider_no" readonly="">
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar">
                    <input type="text" id="prescriber_no" name="prescriber_no" class="validate" value="">
                    <label for="prescriber_no" class="grey-text truncate">Prescriber No. <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_prescriber_no"></div>
                    <input type="hidden" name="enc_prescriber_no" id="enc_prescriber_no" readonly="">
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar input-padding-25px">
                    <input type="text" id="ahpra_registration_no" name="ahpra_registration_no" class="validate" value="">
                    <label for="ahpra_registration_no" class="grey-text truncate">AHPRA Registration No. <span class="required_field">*</span></label>
                    <div class="err left-12px" style="display:none;" id="err_ahpra_registration_no"></div>
                    <input type="hidden" name="enc_ahpra_registration_no" id="enc_ahpra_registration_no" readonly="">
                </div>
            </div>

            <div class="otherdetails" style="margin-top: 30px;">
                <h3 class="sethead "><strong>Professional Insurance </strong></h3>
                <p class="bluedoc-text">
                    For peace of mind, you'll require Professional Indemnity insurance and Cyber Liability Insurance. You can obtain Cyber Liability Insurance online which is beneficial for covering both your online patient and personal security as well as doctoroo consultations. Policies start from as little as $5 a week. Please check with your insurer for details.
                </p>
                
                <div class="file-field input-field new-file-input input-padding-25px">
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
                    <div class="err error_msg left-12px">{{ Session::get('pi_insurance_policy_error') }}</div>
                @endif
            </div>
            <div class="file-field input-field new-file-input input-padding-25px">
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
                    <div class="err error_msg left-12px">{{ Session::get('cyber_liability_error') }}</div>
                @endif
            </div>

            </div>

            <!-- <div class="divider mrmintb"></div>-->
            <span class="left qusame rescahnge"><a href="{{ url('/') }}/doctor/signup/step5/{{isset($enc_id) ? $enc_id : ''}}" class="border-btn round-corner center-align">Save for Later</a></span>

            <span class="right qusame rescahnge">
                <button type="button" class="btn_signup_step4 border-btn round-corner center-align" id="btn_signup_step4">Next Step ></button>
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
      var token         = '{{ csrf_token () }}';
      
      $(document).ready(function(){
          
          decryptMyData(virgilToken);
          
          function decryptMyData()
          {
              var ahpra_registration_no     = '{{$ahpra_registration_no}}';
              var medical_registration_no   = '{{$medical_registration_no}}';
              var medicare_provider_no      = '{{$medicare_provider_no}}';
              var prescriber_no             = '{{$prescriber_no}}';
              
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
            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);
            
            var formData = new FormData($(this)[0]);

            $('#btn_signup_step4').click(function(){
                var id_proof                            = $("#id_proof").val();
                var medical_registration_no             = $("#medical_registration_no").val();
                var medical_registration_certificate    = $("#medical_registration_certificate").val();
                var medicare_provider_no                = $("#medicare_provider_no").val();
                var prescriber_no                       = $("#prescriber_no").val();
                var ahpra_registration_no               = $("#ahpra_registration_no").val();
                var pi_insurance_policy                 = $("#pi_insurance_policy").val();
                var cyber_liability_insurance_policy    = $("#cyber_liability_insurance_policy").val();

                if($.trim(id_proof) == '')
                {
                    $('#err_id_proof_file').show();
                    $('#id_proof_file').focus();
                    $('#err_id_proof_file').html('Please select any image/document file.');
                    $('#err_id_proof_file').fadeOut(4000);
                    $("#id_proof_file").val('');
                    return false;
                }
                else if($.trim(medical_registration_no) == '')
                {
                    $('#err_medical_registration_no').show();
                    $('#medical_registration_no').focus();
                    $('#err_medical_registration_no').html('Please enter Medical Registration No.');
                    $('#err_medical_registration_no').fadeOut(4000);
                    return false;
                }
                else if($.trim(medical_registration_certificate) == '')
                {
                    $('#err_medical_registration_certificate_file').show();
                    $('#err_medical_registration_certificate_file').focus();
                    $('#err_medical_registration_certificate_file').html('Please select any image/document file.');
                    $('#err_medical_registration_certificate_file').fadeOut(4000);
                    return false;
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
                else if($.trim(pi_insurance_policy) == '')
                {
                    $('#err_pi_insurance_policy_file').show();
                    $('#err_pi_insurance_policy_file').focus();
                    $('#err_pi_insurance_policy_file').html('Please upload PI Insurance Policy.');
                    $('#err_pi_insurance_policy_file').fadeOut(4000);
                    return false;
                }
                else if($.trim(cyber_liability_insurance_policy) == '')
                {
                    $('#err_cyber_liability_file').show();
                    $('#err_cyber_liability_file').focus();
                    $('#err_cyber_liability_file').html('Please upload Cyber Liability Insurance Policy.');
                    $('#err_cyber_liability_file').fadeOut(4000);
                    return false;
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
                        formData.append('enc_medical_registration_no',txtmedical_registration_no);
                        formData.append('enc_ahpra_registration_no',txtahpra_registration_no);
                        formData.append('enc_medicare_provider_no',txtmedicare_provider_no);
                        formData.append('enc_prescriber_no',txtprescriber_no);
                          $.ajax({
                              url:'{{ url("/") }}/doctor/signup/store_step4/{{$enc_id}}',
                              type:'post',
                              data:formData,
                              processData: false,
                              contentType: false,
                              success:function(data){
                               window.location.href = data.redirect;
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
                    $('#err_medical_registration_certificate_file').show();
                    $('#medical_registration_certificate_file').focus();
                    $('#err_medical_registration_certificate_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_medical_registration_certificate_file').fadeOut(4000);
                    $("#medical_registration_certificate_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_medical_registration_certificate_file').show();
                    $('#medical_registration_certificate_file').focus();
                    $('#err_medical_registration_certificate_file').html('Max size allowed is 5mb.');
                    $('#err_medical_registration_certificate_file').fadeOut(4000);
                    $("#medical_registration_certificate_file").val('');
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