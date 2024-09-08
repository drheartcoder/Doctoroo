@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <!--tab start-->

    <div class="mar300  has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>

        <div id="consultation" class="tab-content medi ">
            <div class="consultation-content">
                <div class="consultation-guide">
                    <div class="width-760 left">
                        <div class="round-box z-depth-3">
                            <div class="heading-round-box">Consultation Guide</div>
                            <div class="green-border round-box-content posrel nopadding-top">
                                <div class="width-200px left">
                                    <ul>
                                        <li class="schedule active">
                                            <div class="valign-wrapper row">
                                                <div class="col s12 m8 time right-align">Identity
                                                    <small>Confirmation</small>
                                                </div>
                                                <div class="col s12 m4  center-align imgmain "><img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" class="timeicn"  id="btn_identity_confirmation"></div>
                                            </div>
                                        </li>
                                        <li class="schedule">
                                            <div class="valign-wrapper row">
                                                <div class="col s12 m8 time right-align">Reason for
                                                    <small>Consultation</small>
                                                </div>
                                                <div class="col s12 m4  center-align imgmain"><img src="{{url('/')}}/public/doctor_section/images/confirm-icon-inactive.png" class="timeicn" id="btn_consultation_result"></div>
                                            </div>
                                        </li>
                                        <li class="schedule">
                                            <div class="valign-wrapper row">
                                                <div class="col s12 m8 time right-align">Medical
                                                    <small>History</small>
                                                </div>
                                                <div class="col s12 m4  center-align imgmain"><img src="{{url('/')}}/public/doctor_section/images/confirm-icon-inactive.png" class="timeicn" id="btn_medical_history"></div>
                                            </div>
                                        </li>
                                        <li class="schedule">
                                            <div class="valign-wrapper row">
                                                <div class="col s12 m8 time  right-align">Notes &amp;
                                                    <small>Summary</small>
                                                </div>
                                                <div class="col s12 m4  center-align imgmain"><img src="{{url('/')}}/public/doctor_section/images/confirm-icon-inactive.png" class="timeicn" id="btn_notes_summery"></div>
                                            </div>
                                        </li>
                                        <li class="schedule">
                                            <div class="valign-wrapper row">
                                                <div class="col s12 m8 time right-align">Document &amp;
                                                    <small>Upload</small>
                                                </div>
                                                <div class="col s12 m4 center-align imgmain"><img src="{{url('/')}}/public/doctor_section/images/confirm-icon-inactive.png" class="timeicn" id="btn_document_upload"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Identity Confirmation -->
                                <div class="width-521px right" id="identity_confirm_block">
                                    <div class="close-btn-block">
                                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="iden-confirmation">
                                        <div class="row ">
                                            <div class="col s12">
                                                <div class="margin-bottom-29px"> <img src="{{url('/')}}/public/doctor_section/images/identity-confirmation.png" /></div>
                                                <p class="grey-text">
                                                    You are responsible for confirming the patient's identity at the beginning of the consultation. The below details are the details the patient has entered into the platform. Confirm their identity by asking them to provide the below details or using another appropriate method until you satisfied.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">First Name</strong> Jonathan
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Last Name</strong> Simonthan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col m6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Date of Birth</strong> 18 Feb, 1988
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Gender</strong> Female
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Phone No. </strong> (03) 9876543210
                                                </label>
                                            </div>
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Mobile No. </strong> (03) 9876543210
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row martp">
                                            <div class="col s12">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Address. </strong> Unit 5/430 Example Street, Melbourne 3000 VIC
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- consultation purpose -->
                                <div class="width-521px right"  style="display:none;" id="consultation_purpose_block">
                                    <div class="close-btn-block">
                                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="purpose-consultation">
                                        <div class="row ">
                                            <div class="col s12">
                                                <div class="margin-bottom-29px"> <img src="{{url('/')}}/public/doctor_section/images/consultation-reason.png" /></div>
                                                <div class="doctor-consultation-note purpose-consultation-main">
                                                    <div class="consultation-id-label doctor-consultation-note-head">
                                                        Purpose of consultation
                                                    </div>
                                                    <div class="doctor-consultation-note-content">
                                                        <div class="row">
                                                            <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                                <div class="purpose-block-content">
                                                                    <div class="purpose-check-img">
                                                                        <img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" alt="" />
                                                                    </div>
                                                                    <div class="purpose-text-block">
                                                                        Advice &amp; Treatment
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                                <div class="purpose-block-content">
                                                                    <div class="purpose-check-img">
                                                                        <img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" alt="" />
                                                                    </div>
                                                                    <div class="purpose-text-block">
                                                                        Medical Cerrificate
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                                <div class="purpose-block-content">
                                                                    <div class="purpose-check-img">
                                                                        <img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" alt="" />
                                                                    </div>
                                                                    <div class="purpose-text-block">
                                                                        Prescription or Repeat
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                                <div class="purpose-block-content">
                                                                    <div class="purpose-check-img">
                                                                        <img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" alt="" />
                                                                    </div>
                                                                    <div class="purpose-text-block">
                                                                        Other
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doctor-consultation-note">
                                                    <div class="consultation-id-label doctor-consultation-note-head">
                                                        Symptom(s) or reason for consultation
                                                    </div>
                                                    <div class="doctor-consultation-note-content">
                                                        <span>This patient has shown sings and symptoms of a sever back ache which has bee has shown signs and symptoms of a sever back ache which has been accumulat sings and symptoms of a sever back ache which has been This patient has shown sings and symptoms of a sever back ache which has bee has shown signs and symptoms of a sever back ache which has been accumulat sings and symptoms of a sever back ache which has been</span>
                                                    </div>
                                                </div>
                                                <div class="doctor-consultation-note uploaded-images-block">
                                                    <div class="consultation-id-label doctor-consultation-note-head">
                                                        Uploaded Image(s)
                                                    </div>
                                                    <div>
                                                        <div class="max-width-carousel ">
                                                            <img src="{{url('/')}}/public/doctor_section/images/trail_photo.png" class="materialboxed">
                                                        </div>
                                                        <div class="max-width-carousel ">
                                                            <img src="{{url('/')}}/public/doctor_section/images/trail_photo.png" class="materialboxed">
                                                        </div>
                                                        <div class="max-width-carousel ">
                                                            <img src="{{url('/')}}/public/doctor_section/images/trail_photo.png" class="materialboxed">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Medical history -->
                                <div class="width-521px right" style="display:none;" id="medical_history_block">
                                    <div class="close-btn-block">
                                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="medical-history">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="margin-bottom-29px"> <img src="{{url('/')}}/public/doctor_section/images/medical-history.png" /></div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Last Updated</strong>38 Days Ago
                                                </label>
                                            </div>
                                            <div class="col s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Updated By</strong>Jonathan Simonthan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <!-- Notes & summery -->
                                <div class="width-521px right" style="display: none;" id="notes_summery_block">
                                   <div class="close-btn-block">
                                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="notes-summary">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <textarea id="textarea1" class="materialize-textarea" readonly>Symptoms displayed include sore throat, heavy dry cough and a general headache. Symptoms displayed include sore throat, heavy dry cough and a general headache.</textarea>
                                                    <label for="textarea1"> Reason for Visit: </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <textarea id="textarea1" class="materialize-textarea" readonly> Symptoms displayed include sore throat, heavy dry cough and a general headache. Symptoms displayed include sore throat, heavy dry cough and a general headache. Actions: Symptoms displayed include sore throat, heavy dry cough and a general headache. Symptoms displayed include sore throat, heavy dry cough and a general headache. </textarea>
                                                    <label for="textarea1"> Diagnosis:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <textarea id="textarea1" class="materialize-textarea" readonly>Symptoms displayed include sore throat, heavy dry cough and a general headache. Symptoms displayed include sore throat, heavy dry cough and a general headache.</textarea>
                                                    <label for="textarea1">Actions:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <!-- Document upload -->
                                <div class="width-521px right" style="display: none;" id="document_upload_block">
                                    <div class="close-btn-block">
                                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="documents-upload">
                                        <div class="row ">
                                            <div class="col s12">
                                                <div class="margin-bottom-29px"> <img src="{{url('/')}}/public/doctor_section/images/documents-icon.png" /></div>
                                                <p class="grey-text">
                                                    Upload required documents for the patient to access
                                                </p>
                                                <div class="input-field marbtmspace ">
                                                    <div class="file-field input-field fullbtn">
                                                        <div class="btn transparent">
                                                            <span class="truncate"> Prescription</span>
                                                            <input type="file" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="clr"></div>
                                                </div>
                                                <div class="input-field marbtmspace ">
                                                    <div class="file-field input-field fullbtn">
                                                        <div class="btn transparent">
                                                            <span class="truncate"> Medical Certificate</span>

                                                            <input type="file" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="clr"></div>
                                                </div>
                                                <div class="input-field marbtmspace ">
                                                    <div class="file-field input-field fullbtn">
                                                        <div class="btn transparent">
                                                            <span class="truncate"> Other</span>

                                                            <input type="file" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="clr"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="width-340 right">
                        <div class="round-box z-depth-3">
                            <div class="heading-round-box">&nbsp;</div>
                            <div class="green-border center-align ">
                                <iframe src="https://tokbox.com/embed/embed/ot-embed.js?embedId=788ad688-15ec-4f47-b639-9a693d5df4e3&room=room{{ $enc_patient_id }}&iframe=true" allow="microphone; camera" width="100%" height=343 ></iframe>
                                <div class="clr"></div>
                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                        <div class="consultation-request-right-bar">
                            <div class="blue-border-block-top"></div>
                            <div class="past-consultaton-white right-bar-consultation-main">
                                <div class="reconnect-patient-inner less-padding-5px">
                                    <div class="time-date no-right-left ">
                                        <div class="row">
                                            <div class="watch-img-block">
                                            </div>
                                            <div class="time-block-main">
                                                <div class="clock-block">
                                                    <label class="time">C3897744</label>
                                                    <span class="greenColr">Consultation Id</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-date no-right-left ">
                                        <div class="row">
                                            <div class="watch-img-block">
                                                <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                            </div>
                                            <div class="time-block-main">
                                                <div class="clock-block">
                                                    <label class="time">12:35pm Wed, 27Mar 2017</label>
                                                    <span class="greenColr">Start Time</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="time-date no-right-left ">
                                        <div class="row">
                                            <div class="watch-img-block">
                                                <img src="{{url('/')}}/public/doctor_section/images/dollar-sign.png" alt="" />
                                            </div>
                                            <div class="time-block-main">
                                                <div class="clock-block">
                                                    <label class="time">$24.00</label>
                                                    <span class="greenColr">Your Earning Thus far</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-date no-right-left ">
                                        <div class="row">
                                            <div class="watch-img-block">
                                                <img src="{{url('/')}}/public/doctor_section/images/dollar-sign.png" alt="" />
                                            </div>
                                            <div class="time-block-main">
                                                <div class="clock-block">
                                                    <label class="time">$24.00</label>
                                                    <span class="greenColr">Patient Charged Thus far</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">

    <script>
    $(document).ready(function(){
        var img_path = "<?php echo url('/').'/public/doctor_section/images'; ?>";

        $('#btn_identity_confirmation').click(function(){
            $(this).attr('src',img_path+'/confirm-icon-0.png');
            $('#consultation_purpose_block').hide();
            $('#identity_confirm_block').show();
            $('#medical_history_block').hide();
            $('#notes_summery_block').hide();
            $('#document_upload_block').hide();

            $('#btn_consultation_result,#btn_medical_history,#btn_notes_summery,#btn_document_upload').attr('src',img_path+'/confirm-icon-inactive.png');
            $('#btn_consultation_result,#btn_medical_history,#btn_notes_summery,#btn_document_upload').closest('li').removeClass('active');
        });

        $('#btn_consultation_result').click(function(){
            if($(this).closest('li').prev().hasClass('active'))
            {
                $(this).attr('src',img_path+'/confirm-icon-0.png');
                $(this).closest('li').addClass('active');
                $('#consultation_purpose_block').show();
                $('#identity_confirm_block').hide();
                $('#medical_history_block').hide();
                $('#notes_summery_block').hide();
                $('#document_upload_block').hide();  

                $('#btn_medical_history,#btn_notes_summery,#btn_document_upload').attr('src',img_path+'/confirm-icon-inactive.png');
                $('#btn_medical_history,#btn_notes_summery,#btn_document_upload').closest('li').removeClass('active');
            }
        });

        $('#btn_medical_history').click(function(){
            if($(this).closest('li').prev().hasClass('active'))
            {
                $(this).attr('src',img_path+'/confirm-icon-0.png');
                $(this).closest('li').addClass('active');
                $('#consultation_purpose_block').hide();
                $('#medical_history_block').show();
                $('#identity_confirm_block').hide();
                $('#notes_summery_block').hide();
                $('#document_upload_block').hide();

                $('#btn_notes_summery,#btn_document_upload').attr('src',img_path+'/confirm-icon-inactive.png');
                $('#btn_notes_summery,#btn_document_upload').closest('li').removeClass('active');
            }
        });

        $('#btn_notes_summery').click(function(){
            if($(this).closest('li').prev().hasClass('active'))
            {
                $(this).attr('src',img_path+'/confirm-icon-0.png');
                $(this).closest('li').addClass('active');
                $('#consultation_purpose_block').hide();
                $('#medical_history_block').hide();
                $('#identity_confirm_block').hide();
                $('#notes_summery_block').show();
                $('#document_upload_block').hide();

                $('#btn_document_upload').attr('src',img_path+'/confirm-icon-inactive.png');
                $('#btn_document_upload').closest('li').removeClass('active');
            }
        });
        $('#btn_document_upload').click(function(){
            if($(this).closest('li').prev().hasClass('active'))
            {
                $(this).attr('src',img_path+'/confirm-icon-0.png');
                $(this).closest('li').addClass('active');
                $('#consultation_purpose_block').hide();
                $('#medical_history_block').hide();
                $('#identity_confirm_block').hide();
                $('#notes_summery_block').hide();
                $('#document_upload_block').show();
            }
        });
    });
    </script>

    <script>
        $(document).ready(function(){
            $enc_patient_id = $("#enc_patient_id").val();

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
        });
    </script>

@endsection