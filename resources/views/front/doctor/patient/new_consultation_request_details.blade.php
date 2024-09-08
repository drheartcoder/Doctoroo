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
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>
        
        <div id="new_consultation" class="tab-content medi past-consultation-main">
            <div class="patient-list-heading">
                <span class="left qusame rescahnge">
                    <a href="{{ URL::previous() }}" class="border-btn round-corner center-align">
                        <span class="arow-left-block"><i class="fa fa-angle-left"></i></span>
                    Back</a>
                </span>
                <span class="patient-list-title">
                    Consultation Details
                </span>
            </div>
            <div class="row">
                <div class="col l8 m8 s8 responsive-set-block">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white">
                        <div class="past-details-head">
                            <div class="heading-past-details">
                                Consultation Request Details
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row consultation-id-main">
                            <div class="col l4 m4 s4">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        {{ isset($arr_booking['consultation_id'])?$arr_booking['consultation_id']:'' }}
                                    </div>
                                    <div class="consultation-id-content">
                                        Consultation ID
                                    </div>
                                </div>
                            </div>
                            <div class="col l5 m5 s5">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        @php
                                            $doc_title      = isset($arr_booking['doctor_user_details']['title'])?$arr_booking['doctor_user_details']['title']:'';
                                            $doc_first_name = isset($arr_booking['doctor_user_details']['first_name'])?$arr_booking['doctor_user_details']['first_name']:'';
                                            $doc_last_name  = isset($arr_booking['doctor_user_details']['last_name'])?$arr_booking['doctor_user_details']['last_name']:'';
                                        @endphp
                                        {{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}
                                    </div>
                                    <div class="consultation-id-content">
                                        Consulting Doctor
                                    </div>
                                </div>
                            </div>
                            <div class="col l3 m3 s3">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        {{ isset($arr_booking['booking_status'])?$arr_booking['booking_status']:'' }}
                                    </div>
                                    <div class="consultation-id-content">
                                        Status
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-consultation-note purpose-consultation-main">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Purpose of consultation
                            </div>
                            <div class="doctor-consultation-note-content">
                                <div class="row">
                                    @php
                                        $consultation_for = "";
                                        if(isset($arr_booking['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$arr_booking['consultation_for']);
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
                                                    var card_id                = "{{ isset($arr_booking['patient_user_details']['dump_id']) && !empty($arr_booking['patient_user_details']['dump_id']) ? $arr_booking['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($arr_booking['patient_user_details']['dump_session']) && !empty($arr_booking['patient_user_details']['dump_session']) ? $arr_booking['patient_user_details']['dump_session'] : '' }}";
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
                            @php $symptoms = isset($arr_booking['symptoms'])?$arr_booking['symptoms']:'' @endphp
                            <div class="doctor-consultation-note-content">
                                <!-- <span>{{ substr($symptoms,0,200) }}</span> @if( !empty(substr($symptoms,200)) )<span class="more-content">{{ substr($symptoms,200) }}</span><a class="expand-more-btn green-text"> Read More </a><a class="close-more-btn green-text">Close </a> @endif -->
                                <p class="dec_symptoms"></p>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($arr_booking['patient_user_id']) && !empty($arr_booking['patient_user_id']) ? $arr_booking['patient_user_id'] : '' }}";
                                    var symptoms               = "{{ isset($arr_booking['symptoms']) && !empty($arr_booking['symptoms']) ? $arr_booking['symptoms'] : '' }}"; 
                                    var card_id                = "{{ isset($arr_booking['patient_user_details']['dump_id']) && !empty($arr_booking['patient_user_details']['dump_id']) ? $arr_booking['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($arr_booking['patient_user_details']['dump_session']) && !empty($arr_booking['patient_user_details']['dump_session']) ? $arr_booking['patient_user_details']['dump_session'] : '' }}";
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
                                             
                                             var dumpSessionId = '{{isset($arr_booking["patient_user_details"]["dump_session"])?$arr_booking["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($arr_booking["patient_user_details"]["dump_id"])?$arr_booking["patient_user_details"]["dump_id"]:""}}';
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
                                <div class="reconnetct-patient-btn">
                                    <div class="btn-reconnect-patient truncate change_booking_status" data-user_id="{{ isset($arr_booking['patient_user_id']) ? $arr_booking['patient_user_id'] : ''}}" data-booking_id="{{isset($arr_booking['id']) ? $arr_booking['id'] : ''}}" data-booking_status="Confirmed" style="cursor: pointer;"> Accept Consultation
                                    </div>
                                </div>
                                <div class="time-date ">
                                    <div class="row">
                                        <div class="watch-img-block">
                                            <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                        </div>
                                        <div class="time-block-main">
                                            
                                            <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $arr_booking["consultation_datetime"]); ?>

                                            <div class="clock-block">
                                                <label class="time" style="font-weight: bold;">{{ isset($consult_datetime)?date("h:i a D, d M Y",strtotime($consult_datetime)):'' }}</label>
                                                <span class="greenColr">Requested Time</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-message-patient">
                                <div class="message-patient">
                                    <div class="border-btn cart round-corner center-align change_booking_status" data-user_id="{{isset($arr_booking['patient_user_id']) ? $arr_booking['patient_user_id'] : ''}}" data-booking_id="{{ isset($arr_booking['id']) ? $arr_booking['id'] : '' }}" data-booking_status="Declined" style="cursor: pointer;">Decline Consultation</div>
                                </div>
                                <div class="message-patient">
                                    <div class="border-btn cart round-corner center-align offer_time_btn" data-user_id="{{isset($arr_booking['patient_user_id']) ? $arr_booking['patient_user_id'] : ''}}" data-booking_id="{{ isset($arr_booking['id']) ? $arr_booking['id'] : '' }}" style="cursor: pointer;">Offer alternative time</div>
                                </div>
                                @php
                                    $patient_id = isset($arr_booking['patient_user_id']) ? $arr_booking['patient_user_id'] : '';
                                    $enc_patient_id = base64_encode($patient_id);
                                @endphp
                                <div class="cancel-consultation">
                                    <a href="{{ url('/') }}/doctor/patients/chats/{{ $enc_patient_id }}" class="border-btn cart round-corner center-align truncate">Message Patient</a>
                                </div>
                            </div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal re-connect-modal-main">
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

    <a class="open_popup_alert_msg" href="#popup_alert_msg" style="display: none;"></a>
    <div id="popup_alert_msg" class="modal addperson" style="display: none;">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align msg_status"></p>
                    <p class="center-align success_msg" style="display: none;"></p>
                </div>             
            </div>         
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn" id="redirect_href">OK</a>
        </div>     
    </div>

    <a class="confirm_action" href="#popup_confirm_action" style="display: none;"></a>
    <div id="popup_confirm_action" class="modal addperson" style="display: none;">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align" id="status_message"></p>
                    <input type="hidden" id="user_id">
                    <input type="hidden" id="booking_id">
                    <input type="hidden" id="booking_status">
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons" id="change_status">Yes</a>    
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
        var url ="<?php echo $module_url_path; ?>";
        $(document).ready(function(){  
            $('#tab_consultation_request').click(function(){
                window.location = url+"/new_consultation_request";
            });
            $('#tab_upcoming_consultation').click(function(){
                window.location = url+"/upcoming_consultation";
            });
            $('#tab_past_consultation').click(function(){
                window.location = url+"/past_consultation";
            });
            $('#tab_declined_consultation').click(function(){
                window.location = url+"/decline_consultation";
            });

            $(".expand-more-btn").on("click", function () {
                $(this).parent(".doctor-consultation-note-content").addClass("active");
            });
            $(".close-more-btn").on("click", function () {
                $(this).parent(".doctor-consultation-note-content").removeClass("active");
            });

            $('.change_booking_status').click(function(){
                
                $('#user_id').val($(this).data("user_id"));
                $('#booking_id').val($(this).data("booking_id"));
                $('#booking_status').val($(this).data("booking_status"));

                booking_status = $(this).data("booking_status");

                $('.confirm_action').click();
               
                if(booking_status == 'Confirmed')
                {
                    status = 'Confirm';
                }
                else if(booking_status == 'Declined')
                {
                 status = 'Decline';   
                }
                else
                {
                    status = '';
                }
                
                $('#status_message').html("Are you sure you want to accept this consultation?");

            });

            $('#change_status').click(function(){
                var user_id         = $('#user_id').val();
                var booking_id      = $('#booking_id').val();
                var booking_status  = $('#booking_status').val();
                
                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url   : "{{ url('/') }}/doctor/consultation/booking_status",
                    type : "POST",
                    dataType:'json',
                    data:{_token:token, user_id:user_id, booking_id:booking_id, booking_status:booking_status},
                    success : function(res){
                        if(res.status == 'success')
                        {
                            $(".msg_status").html("Consultation successfully "+booking_status.toLowerCase());
                            if(booking_status == "Confirmed")
                            {
                                $(".success_msg").html("Consultation is been moved to Upcoming Consultation section. You'll be redirect to Upcoming Consultation List");
                                $("#redirect_href").attr("href", "{{ url('/') }}/doctor/consultation/upcoming_consultation");
                            }
                            else if(booking_status == "Declined")
                            {
                                $(".success_msg").html("Consultation is been moved to Declined Consultation section. You'll be redirect to Declined Consultation List");
                                $("#redirect_href").attr("href", "{{ url('/') }}/doctor/consultation/decline_consultation");
                            }
                            $('#popup_confirm_action .modal-close').click();
                            $(".open_popup_alert_msg").click();
                        }
                        else if(res.status == 'error')
                        {
                            $(".msg_status").html("Something went wrong while "+booking_status+" Consultation");
                            $(".show_msg").html("");
                            $('#popup_confirm_action .modal-close').click();
                            $(".open_popup_alert_msg").click();
                        }
                    }
                });
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

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
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