@extends('front.doctor.layout.new_master') @section('main_content')

<div class="header bookhead ">
    <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
</div>

<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')

<div class="mar300  has-header minhtnor">
    <div class="consultation-tabs ">
        <ul class="tabs tabs-fixed-width">
            <li class="tab" id="tab_consultation_request">
                <a href="#new_consultation"><span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span> New Consultation Request </a>
            </li>
            <li class="tab" id="tab_upcoming_consultation">
                <a href="#upcoming_consultation"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span> Upcoming Consultations</a>
            </li>
            <li class="tab" id="tab_past_consultation">
                <a href="#consultation-history"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span>Past Consultations</a>
            </li>
            <li class="tab" id="tab_declined_consultation">
                <a href="#decline_consultation" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon" /> </span>Declined Consultations</a>
            </li>
        </ul>
    </div>

    <div id="past" class="tab-content medi past-consultation-main">
        <div class="patient-list-heading">
            <span class="left qusame rescahnge"><a href="{{URL::previous()}}" class="border-btn round-corner center-align"> <span class="arow-left-block"><i class="fa fa-angle-left"></i></span> Back </a>
            </span>
            <span class="patient-list-title">
                    Declined Consultation Details
                </span>
        </div>
        <div class="row">
            <div class="col l8 m8 s8 responsive-set-block">
                <div class="blue-border-block-top"></div>
                <div class="past-consultaton-white">
                    <div class="past-details-head">
                        <div class="heading-past-details">
                            Declined consultation details
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row consultation-id-main">
                        <div class="col l4 m4 s4">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($declined_consultation_arr['consultation_id']) ? $declined_consultation_arr['consultation_id'] : ''}}
                                </div>
                                <div class="consultation-id-content">
                                    Consultation ID
                                </div>
                            </div>
                        </div>
                        <div class="col l5 m5 s5">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    @if(isset($declined_consultation_arr) && $declined_consultation_arr['familiy_member_info'] == null) 
                                    {{isset($declined_consultation_arr['patient_user_details']['title']) ? $declined_consultation_arr['patient_user_details']['title'] : ''}}
                                    {{isset($declined_consultation_arr['patient_user_details']['first_name']) ? $declined_consultation_arr['patient_user_details']['first_name'] : ''}} {{isset($declined_consultation_arr['patient_user_details']['last_name']) ? $declined_consultation_arr['patient_user_details']['last_name'] : ''}} 
                                    @elseif(isset($declined_consultation_arr['familiy_member_info'])) {{isset($declined_consultation_arr['familiy_member_info']['first_name']) ? $declined_consultation_arr['familiy_member_info']['first_name'] : ''}} {{isset($declined_consultation_arr['familiy_member_info']['last_name']) ? $declined_consultation_arr['familiy_member_info']['last_name'] : ''}} 
                                    @endif
                                </div>
                                <div class="consultation-id-content">
                                    Consulting Patient
                                </div>
                            </div>
                        </div>
                        <div class="col l3 m3 s3">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($declined_consultation_arr['booking_status']) ? $declined_consultation_arr['booking_status'] : ''}}
                                </div>
                                <div class="consultation-id-content">
                                    Status
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doctor-consultation-note">
                        <div class="doctor-consultation-note purpose-consultation-main">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Purpose of consultation
                            </div>
                            <div class="doctor-consultation-note-content">
                                <div class="row">
                                    @php
                                        $consultation_for = "";
                                        if(isset($declined_consultation_arr['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$declined_consultation_arr['consultation_for']);
                                        }
                                    @endphp

                                    @if(isset($consultation_for))
                                        @foreach($consultation_for as $key=>$purpose)
                                            @if($purpose != "")
                                                <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                    <div class="purpose-block-content">
                                                        <div class=" purpose-check-img" id="advice_and_treatment">
                                                            <img src="{{url('/')}}/public/doctor_section/images/confirm-icon-0.png" alt="" />
                                                        </div>
                                                        <div class="purpose-text-block dec_purpose_for{{$key}}">
                                                            <!-- {{ $purpose }} -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(document).ready(function(){
                                                    var purpose_key            = "{{ $key }}";     
                                                    var purpose_for            = "{{ $purpose }}"; 
                                                    var card_id                = "{{ isset($declined_consultation_arr['patient_user_details']['dump_id']) && !empty($declined_consultation_arr['patient_user_details']['dump_id']) ? $declined_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($declined_consultation_arr['patient_user_details']['dump_session']) && !empty($declined_consultation_arr['patient_user_details']['dump_session']) ? $declined_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                                    var key                    = api.keys.import(userkey);

                                                    if(purpose_for != ""){
                                                      var dec_purpose_for   = key.decrypt(purpose_for).toString();

                                                      if(dec_purpose_for == 'advice_and_treatment'){
                                                        $('.dec_purpose_for'+purpose_key).html('Advice & Treatment');
                                                      }
                                                      if(dec_purpose_for == 'prescriptions_and_repeats'){
                                                        $('.dec_purpose_for'+purpose_key).html('Prescription or Repeat');
                                                      }
                                                      if(dec_purpose_for == 'medical_cetificate'){
                                                        $('.dec_purpose_for'+purpose_key).html('Medical Cerrificate');
                                                      }
                                                      if(dec_purpose_for == 'other'){
                                                        $('.dec_purpose_for'+purpose_key).html('Other');
                                                      }
                                                    }
                                                    });
                                                </script>
                                            @endif        
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="doctor-consultation-note">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Symptom(s) or reason for consultation
                            </div>
                            @php $symptoms = isset($declined_consultation_arr['symptoms']) && !empty($declined_consultation_arr['symptoms']) ? $declined_consultation_arr['symptoms'] : 'Not available' @endphp
                            <div class="doctor-consultation-note-content">
                                <p class="dec_symptoms"></p>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($declined_consultation_arr['patient_user_id']) && !empty($declined_consultation_arr['patient_user_id']) ? $declined_consultation_arr['patient_user_id'] : '' }}";
                                    var symptoms               = "{{ isset($declined_consultation_arr['symptoms']) && !empty($declined_consultation_arr['symptoms']) ? $declined_consultation_arr['symptoms'] : '' }}"; 
                                    var card_id                = "{{ isset($declined_consultation_arr['patient_user_details']['dump_id']) && !empty($declined_consultation_arr['patient_user_details']['dump_id']) ? $declined_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($declined_consultation_arr['patient_user_details']['dump_session']) && !empty($declined_consultation_arr['patient_user_details']['dump_session']) ? $declined_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                    var key                    = api.keys.import(userkey);
                                    if(symptoms != ""){
                                        var dec_symptoms   = key.decrypt(symptoms).toString();
                                        $('.dec_symptoms').html(dec_symptoms);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <div class="doctor-consultation-note uploaded-images-block">
                        <div class="consultation-id-label doctor-consultation-note-head">
                            Uploaded image(s)
                        </div>
                        <div class="collapsible-body center">
                                @if(isset($health_images_arr) && !empty($health_images_arr))
                                    @foreach($health_images_arr as $key => $val)
                                        @if($val['health_image'] !='' && File::exists($patient_uploads_public_url.$val['health_image']))

                                            <div class="max-width-carousel ">
                                                <img class="materialboxed image_show_{{$key}}">
                                            </div>
                                            <!-- Decrypt Images -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($declined_consultation_arr["patient_user_details"]["dump_session"])?$declined_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($declined_consultation_arr["patient_user_details"]["dump_id"])?$declined_consultation_arr["patient_user_details"]["dump_id"]:""}}';
                                             if(dumpSessionId!='')
                                             {
                                                var image_file = '{{ $patient_uploads_base_url.$val["health_image"] }}';
                                                
                                                if(image_file!='')
                                                {
                                                    var image_file_filename      = '{{ $val["health_image"] }}';
                                                    var xhr = new XMLHttpRequest();
                                                    // this example with cross-domain issues.
                                                    xhr.open( "GET", image_file, true );
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
                                                        var innerkey       = '{{$key}}';
                                                        var img = imageUrl = '';
                                                        var imageData    = fileReader.result;
                                                        var fileAsBuffer = new Buffer(imageData);

                                                        var decryptedFile = key.decrypt(fileAsBuffer);
                                                        var blob = new Blob([decryptedFile], { type: mime_type });
                                                        
                                                        var urlCreator = window.URL || window.webkitURL;
                                                        
                                                        if(img=='' && imageUrl=='')
                                                        {
                                                            var imageUrl = urlCreator.createObjectURL( blob );
                                                            /*var img = document.querySelector( ".image_file_"+innerkey );
                                                            var img_show = document.querySelector( ".image_show_"+innerkey );*/
                                                            img.download  = image_file_filename;
                                                            img.href      = imageUrl;
                                                            //$(".image_file_"+innerkey).attr('href',imageUrl);
                                                            $(".image_show_"+innerkey).attr('download',imageUrl);
                                                            $(".image_show_"+innerkey).attr('src',imageUrl);
                                                        }
                                                      }
                                                    };
                                                    xhr.send();
                                                }
                                             }
                                            </script>

                                        @endif
                                    @endforeach
                                @else
                                    <span class="green-text">No Image uploaded</span>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="blue-border-block-bottom"></div>

            </div>
            <div class="col l4 m4 s4 responsive-set-block">
                <div class="consultation-request-right-bar">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white right-bar-consultation-main">
                        <div class="reconnect-patient-inner">
                            <div class="time-date ">
                                <div class="row">
                                    <div class="watch-img-block">
                                        <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                    </div>
                                    <div class="time-block-main">
                                        <div class="clock-block">
                                            <label class="time" style="font-size: 18px;">{{isset($declined_consultation_arr['consultation_datetime']) ? date("h:i a D", strtotime($declined_consultation_arr['consultation_datetime'])): ''}},</label>
                                            <div class="date" style="font-size: 16px;">{{isset($declined_consultation_arr['consultation_datetime']) ? date("F d Y", strtotime($declined_consultation_arr['consultation_datetime'])): ''}}</div>
                                            <span class="greenColr">Requested Time</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-message-patient">
                            <div class="message-patient">
                                @php
                                    $patient_id = isset($declined_consultation_arr['patient_user_id']) ? $declined_consultation_arr['patient_user_id'] : '';
                                    $enc_patient_id = base64_encode($patient_id);
                                @endphp
                                <a href="{{ url('/') }}/doctor/patients/chats/{{ $enc_patient_id }}" class="border-btn cart round-corner center-align">Message Patient</a>
                            </div>
                            <div class="cancel-consultation">
                                <div class="border-btn cart round-corner center-align offer_time_btn" data-user_id="{{isset($declined_consultation_arr['patient_user_id']) ? $declined_consultation_arr['patient_user_id'] : ''}}" data-booking_id="{{ isset($declined_consultation_arr['id']) ? $declined_consultation_arr['id'] : '' }}" style="cursor: pointer;">Offer alternative time</div>
                            </div>
                        </div>
                    </div>
                    <div class="blue-border-block-bottom"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reconnect_modal" class="modal re-connect-modal-main">
    <div class="modal-content">
        <h4 style="text-align: center;">Re-connect with Patient</h4>
        <div class="model-content-block">
            <div class="input-field col s6 m6 l6  text-bx lessmar">
                <input type="text" id="reason" class="validate">
                <label for="reason" class="grey-text truncate">Please enter reason for reconnecting with patient</label>
            </div>
            <div class="re-connection-content">
                The patient charge will continue as normal from the previously cut-off consultation time
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat left">Cancel</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat right">Continue</a>
        <div class="clearfix"></div>
    </div>
</div>

<a class="confirm_offer_time" href="#popup_confirm_offer_time" style="display: none;"></a>
    <div id="popup_confirm_offer_time" class="modal addperson" style="display: none;">
        <form id="offer_time_form" method="POST" action="{{ url('/') }}/doctor/consultation/show_available_time">
        {{ csrf_field() }}
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align">Are you sure you want to offer an alternative time?</p>
                    <input type="hidden" id="get_patient_id" name="get_patient_id">
                    <input type="hidden" id="get_booking_id" name="get_booking_id">
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons" id="confirm_offer_time_yes">Yes</a>
        </div>
        </form>
    </div>

<script>
    var url = "<?php echo $module_url_path; ?>";
    $(document).ready(function () {
        $('#tab_consultation_request').click(function () {
            window.location = url + "/new_consultation_request";
        });
        $('#tab_upcoming_consultation').click(function () {
            window.location = url + "/upcoming_consultation";
        });
        $('#tab_past_consultation').click(function () {
            window.location = url + "/past_consultation";
        });
        $('#tab_declined_consultation').click(function () {
            window.location = url + "/decline_consultation";
        });

        $(".expand-more-btn").on("click", function () {
            $(this).parent(".doctor-consultation-note-content").addClass("active");
        });
        $(".close-more-btn").on("click", function () {
            $(this).parent(".doctor-consultation-note-content").removeClass("active");
        });

        $('.offer_time_btn').click(function(){
            $('#get_patient_id').val($(this).data("user_id"));
            $('#get_booking_id').val($(this).data("booking_id"));
            $('.confirm_offer_time').click();
        });

        $('#confirm_offer_time_yes').click(function(){
            $("#offer_time_form").submit();
        });
    });
</script>

@endsection