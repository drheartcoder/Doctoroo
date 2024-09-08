@extends('front.doctor.layout.new_master') @section('main_content')

<div class="header bookhead ">
    <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
</div>

<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')

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

    <div id="past" class="tab-content medi past-consultation-main">
        <div class="patient-list-heading">
            <span class="left qusame rescahnge"><a href="{{URL::previous()}}" class="border-btn round-corner center-align"> <span class="arow-left-block"><i class="fa fa-angle-left"></i></span> Back </a>
            </span>
            <span class="patient-list-title">
                Consultation Details
            </span>
        </div>
        <div class="row" id="display_details_block">
           

            <div class="col l8 m8 s8 responsive-set-block">
                <div class="blue-border-block-top"></div>
                <div class="past-consultaton-white">
                    <div class="past-details-head">
                        <div class="edit-down-save-btn">
                            <span class="edit-btn-past"><a class="btn-edit-past btn-floating" href="javascript:void(0)" id="btn_download_pdf"><i class="fa fa-download"></i></a></span>
                            <span class="edit-btn-past"><a class="btn-edit-past btn-floating" id="btn_edit_details" href="javascript:void(0)"><i class="fa fa-pencil"></i></a></span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="heading-past-details">
                            Post-consultation details
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row consultation-id-main">
                        <div class="col l4 m4 s4">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($past_consultation_arr['consultation_id']) ? $past_consultation_arr['consultation_id'] : ''}}
                                </div>
                                <div class="consultation-id-content">
                                    Consultation ID
                                </div>
                            </div>
                        </div>
                        <div class="col l5 m5 s5">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        @if(isset($upcoming_consultation_arr) ) 
                                        {{isset($upcoming_consultation_arr['doctor_user_details']['title']) ? $upcoming_consultation_arr['doctor_user_details']['title'] : ''}}
                                        {{isset($upcoming_consultation_arr['doctor_user_details']['first_name']) ? $upcoming_consultation_arr['doctor_user_details']['first_name'] : ''}} {{isset($upcoming_consultation_arr['doctor_user_details']['last_name']) ? $upcoming_consultation_arr['doctor_user_details']['last_name'] : ''}} 
                                        @endif
                                    </div>
                                    <div class="consultation-id-content">
                                        Consulting Doctor
                                    </div>
                                </div>
                            </div> 
                        <div class="col l3 m3 s3">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($past_consultation_arr['booking_status']) ? $past_consultation_arr['booking_status'] : ''}}
                                </div>
                                <div class="consultation-id-content">
                                    Status
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doctor-consultation-note">
                        <div class="consultation-id-label doctor-consultation-note-head">
                            Doctor's Consultation Notes
                        </div>
                        <div class="doctor-consultation-note-content">
                            <p class="dec_consultation_note"></p>

                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($past_consultation_arr['patient_user_id']) && !empty($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '' }}";
                                    var consultation_note      = "{{ isset($past_consultation_arr['consultation_notes']['notes']) && !empty($past_consultation_arr['consultation_notes']['notes']) ? $past_consultation_arr['consultation_notes']['notes'] : '' }}"; 
                                    var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                    var key                    = api.keys.import(userkey);
                                    if(consultation_note != ""){
                                        var dec_consultation_note   = key.decrypt(consultation_note).toString();
                                        $('.dec_consultation_note').html(dec_consultation_note);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <div class="doctor-consultation-note">
                        <div class="consultation-id-label doctor-consultation-note-head">
                            Documents
                        </div>
                        <div class="doctor-consultation-note-content">
                            <ul class="collection brdrtopsd ">
                                @if(isset($past_consultation_arr['consultation_documents']) && !empty($past_consultation_arr['consultation_documents']))
                                        @foreach($past_consultation_arr['consultation_documents'] as $key => $val)
                                             @if($val['document'] !='' && File::exists($consultation_documents_public_url.$val['document']))
                                                    <li class="collection-item martb">
                                                        <div class="row">
                                                            <div class="col l9 m9 s8 p-0">
                                                                <div class="valign-wrapper pres">
                                                                    <img src="{{url('/')}}/public/doctor_section/images/rx-certi.png" />
                                                                    <a class="doc_show_{{$key}}" target="_blank">
                                                                        <p class="green-text">{{$val['document']}}</p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- Decrypt Documents -->
                                                    <script type="text/javascript">
                                                     var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                                     var api           = virgil.API(virgilToken);
                                                     
                                                     var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                                     var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
                                                     if(dumpSessionId!='')
                                                     {
                                                        var image_file = '{{ $consultation_documents_base_url.$val["document"] }}';
                                                        
                                                        if(image_file!='')
                                                        {
                                                            var image_file_filename      = '{{ $val["document"] }}';
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
                                                                    // /$(".doc_show_"+innerkey).attr('download',imageUrl);
                                                                    $(".doc_show_"+innerkey).attr('href',imageUrl);
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
                                    <span class="green-text">No document Uploaded</span>
                                @endif
                            </ul>
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
                                                <img class="materialboxed image_show_{{$key}}" class="materialboxed">
                                                <!-- <a href="javascript:void(0)" data-del-id="{{ $val['id'] }}" class="remove_img_btn"><i class="fa fa-times"></i></a> -->
                                            </div>
                                            <!-- Decrypt Images -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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

                    <div class="payment-invoice-disputes">
                        <div class="row">
                            @if(isset($past_consultation_arr['invoice_info']) && !empty($past_consultation_arr['invoice_info']))
                                <div class="col l6 m6 s6 col-payment-invoice">
                                    <div class="consultation-id-label doctor-consultation-note-head">
                                        Payment &amp; invoice
                                    </div>

                                    @foreach($past_consultation_arr['invoice_info'] as $invoice_data)
                                        @php
                                            $pay_status = isset($invoice_data['payment_status']) ? $invoice_data['payment_status'] : '';
                                            $pay_id = isset($invoice_data['invoice_id']) ? $invoice_data['invoice_id'] : '';
                                            $pay_amount = isset($invoice_data['payment_amount']) ? $invoice_data['payment_amount'] : '';
                                        @endphp

                                        <div class="payment-image-box payment-icon-img">
                                            <img src="{{url('/')}}/public/doctor_section/images/doctor-avtar.png" alt="" />
                                        </div>
                                        <div class="payment-content-box">
                                            <div class="payment-status">
                                                Status:
                                            </div>
                                            <div class="payment-status-content">
                                                {{ ucwords($pay_status) }}
                                            </div>
                                            <div class="payment-status">
                                                Invoice ID: {{ $pay_id }}
                                            </div>
                                            <div class="payment-status-content">
                                                Total: ${{ number_format($pay_amount, 2, '.', '') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(isset($past_consultation_arr['disputes']) && !empty($past_consultation_arr['disputes']))
                                <div class="col l6 m6 s6 col-payment-invoice">
                                    <div class="consultation-id-label doctor-consultation-note-head">
                                        Disputes
                                    </div>
                                    @foreach($past_consultation_arr['disputes'] as $dispute)
                                        <div>
                                            <div class="payment-image-box">
                                                <img src="{{url('/')}}/public/doctor_section/images/handshake.svg" alt="" />
                                            </div>
                                            <div class="payment-content-box disput-id-content">
                                                <div class="payment-status">
                                                    {{isset($dispute['dispute_id']) ? $dispute['dispute_id'] : 'NA'}}
                                                </div>
                                                <div class="payment-status-content">
                                                    Total: {{isset($dispute['amount']) ? '$'.$dispute['amount'] : 'NA'}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="blue-border-block-bottom"></div>

                <div class="consultation-request-details-main">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white">
                        <div class="past-details-head">
                            <div class="heading-past-details">
                                Consultation request details
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
                                        if(isset($past_consultation_arr['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$past_consultation_arr['consultation_for']);
                                        }
                                    @endphp

                                    @if(isset($consultation_for))
                                        @foreach($consultation_for as $key=>$purpose)
                                            @if($purpose != "")
                                                <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                    <div class="purpose-block-content">
                                                        <div class=" purpose-check-img">
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
                                                    var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                            @php $symptoms = isset($past_consultation_arr['symptoms']) && !empty($past_consultation_arr['symptoms']) ? $past_consultation_arr['symptoms'] : 'Not available' @endphp
                            <div class="doctor-consultation-note-content">
                                <!-- <span>{{ substr($symptoms,0,200) }}</span> @if( !empty(substr($symptoms,200)) ) <span class="more-content">{{ substr($symptoms,200) }}</span><a class="expand-more-btn green-text"> Read More </a><a class="close-more-btn green-text">Close </a> @endif -->
                                <p class="dec_symptoms"></p>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($past_consultation_arr['patient_user_id']) && !empty($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '' }}";
                                    var symptoms               = "{{ isset($past_consultation_arr['symptoms']) && !empty($past_consultation_arr['symptoms']) ? $past_consultation_arr['symptoms'] : '' }}"; 
                                    var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                             
                                             var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
            </div>

<!-- !!!!!!!!!!! -->

            <div class="col l4 m4 s4 responsive-set-block">
                <div class="consultation-request-right-bar">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white right-bar-consultation-main">
                        <div class="reconnect-patient-inner">
                            <!-- <div class="reconnetct-patient-btn">
                                <a class="btn-reconnect-patient truncate" href="#reconnect_modal"> <i class="fa fa-video-camera"></i> Re-connect to patient</a>
                            </div> -->
                            <div class="time-date ">
                                <div class="row">
                                    <div class="watch-img-block">
                                        <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                    </div>
                                    <div class="time-block-main">
                                        
                                        <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $past_consultation_arr["consultation_datetime"]); ?>

                                        <div class="clock-block">
                                            <label class="time" style="font-size: 18px;"> {{isset($consult_datetime) ? date("h:i a D", strtotime($consult_datetime)): ''}},</label>
                                            <div class="date" style="font-size: 16px;">   {{isset($consult_datetime) ? date("F d Y", strtotime($consult_datetime)): ''}}</div>
                                            <span class="greenColr">Time</span>
                                        </div>
                                        @php
                                            $call_time_doc = isset($past_consultation_arr['call_time']) ? $past_consultation_arr['call_time'] : '';
                                            $call_time_pat = isset($past_consultation_arr['call_time_patient']) ? $past_consultation_arr['call_time_patient'] : '';

                                            if($call_time_doc > $call_time_pat)
                                            {
                                                $call_time = $call_time_pat;
                                            }
                                            else
                                            {
                                                $call_time = $call_time_doc;
                                            }
                                        @endphp
                                        <div class="min-lengh-block">
                                            <div class="mrtplft">
                                                <label class="time">{{ $call_time }}</label>
                                                <span class="greenColr">Length</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-message-patient">
                            <div class="message-patient">
                                @php
                                    $patient_id = isset($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '';
                                    $enc_patient_id = base64_encode($patient_id);
                                @endphp
                                <a href="{{ url('/') }}/doctor/patients/chats/{{ $enc_patient_id }}" class="border-btn cart round-corner center-align">Message Patient</a>
                            </div>
                            <!-- <div class="cancel-consultation">
                                <a class="border-btn cart round-corner center-align truncate">Cancel Consultation</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="blue-border-block-bottom"></div>
                </div>
            </div>
        </div>

<!-- !!!!!!!!!!! -->        

        <div class="row" id="edit_details_block" style="display: none;">
            <form id="edit_details_form" method="POST" action="{{$module_url_path}}/consultation/past_consultation/update" enctype="multipart/form-data"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="consultation_id" id="consultation_id" value="{{ isset($past_consultation_arr['id']) ? $past_consultation_arr['id'] : '' }}">
                <input type="hidden" name="patient_user_id" id="patient_user_id" value="{{ isset($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '' }}">
                <input type="hidden" id="upd_status" value="{{Session::has('message') ? Session::get('message') : '' }}">
                
                <div class="col l8 m8 s8 responsive-set-block">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white">
                        <div class="past-details-head">
                            <div class="edit-down-save-btn">
                                <span class="posright qusame rescahnge new-position ">
                                    <button type="button" class="border-btn lnht round-corner center-align" id="btn_submit_doctor_notes">Save</button>
                                </span>
                                <a href="javascript:void(0)" id="btn_cancel_edit" class="bluedoc-bg btn-floating cancel-ico new-position center-align white-text circle btn" ><i class="material-icons">close</i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="heading-past-details">
                                Post-consultation details Edit
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row consultation-id-main">
                            <div class="col l4 m4 s4">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        {{isset($past_consultation_arr['consultation_id']) ? $past_consultation_arr['consultation_id'] : ''}}
                                    </div>
                                    <div class="consultation-id-content">
                                        Consultation ID
                                    </div>
                                </div>
                            </div>
                            <div class="col l5 m5 s5">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        @if(isset($upcoming_consultation_arr) ) 
                                        {{isset($upcoming_consultation_arr['doctor_user_details']['title']) ? $upcoming_consultation_arr['doctor_user_details']['title'] : ''}}
                                        {{isset($upcoming_consultation_arr['doctor_user_details']['first_name']) ? $upcoming_consultation_arr['doctor_user_details']['first_name'] : ''}} {{isset($upcoming_consultation_arr['doctor_user_details']['last_name']) ? $upcoming_consultation_arr['doctor_user_details']['last_name'] : ''}} 
                                        @endif
                                    </div>
                                    <div class="consultation-id-content">
                                        Consulting Doctor
                                    </div>
                                </div>
                            </div> 
                            <div class="col l3 m3 s3">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        {{isset($past_consultation_arr['booking_status']) ? $past_consultation_arr['booking_status'] : ''}}
                                    </div>
                                    <div class="consultation-id-content">
                                        Status
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-consultation-note">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Doctor's Consultation Notes
                            </div>
                            <div class="doctor-consultation-note-content">
                                <textarea class="materialize-textarea" name="consultation_notes" id="consultation_notes">{{ isset($past_consultation_arr['consultation_notes']['notes']) && !empty($past_consultation_arr['consultation_notes']['notes']) ? $past_consultation_arr['consultation_notes']['notes'] : '' }}</textarea>
                                <input type="hidden" name="enc_consultation_notes" id="enc_consultation_notes" value="">
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($past_consultation_arr['patient_user_id']) && !empty($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '' }}";
                                    var consultation_note      = "{{ isset($past_consultation_arr['consultation_notes']['notes']) && !empty($past_consultation_arr['consultation_notes']['notes']) ? $past_consultation_arr['consultation_notes']['notes'] : '' }}"; 
                                    var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                    var key                    = api.keys.import(userkey);
                                    if(consultation_note != ""){
                                        var dec_consultation_note   = key.decrypt(consultation_note).toString();
                                        $('#consultation_notes').val(dec_consultation_note);
                                    }
                                });
                            </script>
                        </div>
                        <div class="doctor-consultation-note">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Documents
                            </div>
                            <div class="doctor-consultation-note-content">
                                <ul class="collection brdrtopsd ">
                                @if(isset($past_consultation_arr['consultation_documents']) && !empty($past_consultation_arr['consultation_documents']))
                                    @foreach($past_consultation_arr['consultation_documents'] as $key => $val)
                                        @if($val['document'] !='' && File::exists($consultation_documents_public_url.$val['document']))
                                            <li class="collection-item martb">
                                                <div class="row">
                                                    <div class="col l9 m9 s8 p-0">
                                                        <div class="valign-wrapper pres">
                                                            <img src="{{url('/')}}/public/doctor_section/images/rx-certi.png" />
                                                            <a class="doc_show_{{$key}}" target="_blank">
                                                                <p class="green-text">{{$val['document']}}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col l3 m3 s4 right actionnew p-0">
                                                        <a href="javascript:void(0)" class="circle btn-floating bluedoc-bg z-depth-1 right document-edit-btn white-text remove_document_btn" data-id="{{ $val['id'] }}"><i class="fa fa-trash-o  white-text"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Decrypt Documents -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
                                             if(dumpSessionId!='')
                                             {
                                                var image_file = '{{ $consultation_documents_base_url.$val["document"] }}';
                                                
                                                if(image_file!='')
                                                {
                                                    var image_file_filename      = '{{ $val["document"] }}';
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
                                                            // /$(".doc_show_"+innerkey).attr('download',imageUrl);
                                                            $(".doc_show_"+innerkey).attr('href',imageUrl);
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
                                    <span class="green-text">No document Uploaded</span>
                                @endif
                                    <br>
                                    <span id="err_consultation_document" class="err">
                                        {{Session::has('doc_error') ? Session::get('doc_error') : ''}}
                                    </span>
                                    <input type="hidden" id="delete_doc" name="delete_doc">
                                    <input type="hidden" id="delete_img" name="delete_img">
                            </ul>
                                <div class="disput-popup">
                                    <span class="input-field uploadImg padding-new">
                                        <span class="file-field ">
                                            <span class="bluedoc-bg btn-floating mrgtht-8px center-align white-text circle">
                                                <span class="icon-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                <input type="file" id="consultation_document" name="consultation_document[]" multiple>
                                            </span>
                                        </span>
                                        <span class="icon-label">Upload New</span>
                                    </span>
                                </div>
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
                                                <img class="materialboxed image_show_{{$key}}" class="materialboxed">
                                                <a href="javascript:void(0)" data-del-id="{{ $val['id'] }}" class="remove_img_btn"><i class="fa fa-times"></i></a>
                                            </div>
                                            <!-- Decrypt Images -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                            <div class="disput-popup">
                                <span class="input-field uploadImg padding-new">
                                            <span class="file-field ">
                                                <span class="bluedoc-bg btn-floating mrgtht-8px center-align white-text circle">
                                                        <span class="icon-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <input type="file"  id="consultation_images" name="consultation_images[]" multiple>
                                </span>
                                </span>
                                <span class="icon-label">Upload New</span>
                                <br><br>
                                <span class="err" id="err_consultation_images"></span>
                                </span>
                            </div>
                        </div>
                        <div class="payment-invoice-disputes">
                            <div class="row">
                                @if(isset($past_consultation_arr['invoice_info']) && !empty($past_consultation_arr['invoice_info']))
                                    <div class="col l6 m6 s6 col-payment-invoice">
                                        <div class="consultation-id-label doctor-consultation-note-head">
                                            Payment &amp; invoice
                                        </div>
                                        @foreach($past_consultation_arr['invoice_info'] as $invoice_data)
                                            @php
                                                $pay_status = isset($invoice_data['payment_status']) ? $invoice_data['payment_status'] : '';
                                                $pay_id = isset($invoice_data['invoice_id']) ? $invoice_data['invoice_id'] : '';
                                                $pay_amount = isset($invoice_data['payment_amount']) ? $invoice_data['payment_amount'] : '';
                                            @endphp

                                            <div class="payment-image-box payment-icon-img">
                                                <img src="{{url('/')}}/public/doctor_section/images/doctor-avtar.png" alt="" />
                                            </div>
                                            <div class="payment-content-box">
                                                <div class="payment-status">
                                                    Status:
                                                </div>
                                                <div class="payment-status-content">
                                                    {{ ucwords($pay_status) }}
                                                </div>
                                                <div class="payment-status">
                                                    Invoice ID: {{ $pay_id }}
                                                </div>
                                                <div class="payment-status-content">
                                                    Total: ${{ number_format($pay_amount, 2, '.', '') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($past_consultation_arr['disputes']) && !empty($past_consultation_arr['disputes']))
                                    <div class="col l6 m6 s6 col-payment-invoice">
                                        <div class="consultation-id-label doctor-consultation-note-head">
                                            Disputes
                                        </div>
                                        @foreach($past_consultation_arr['disputes'] as $dispute)
                                            <div>
                                                <div class="payment-image-box">
                                                    <img src="{{url('/')}}/public/doctor_section/images/handshake.svg" alt="" />
                                                </div>
                                                <div class="payment-content-box disput-id-content">
                                                    <div class="payment-status">
                                                        {{isset($dispute['dispute_id']) ? $dispute['dispute_id'] : 'NA'}}
                                                    </div>
                                                    <div class="payment-status-content">
                                                        Total: {{isset($dispute['amount']) ? '$'.$dispute['amount'] : 'NA'}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="blue-border-block-bottom"></div>

                    <div class="consultation-request-details-main">
                        <div class="blue-border-block-top"></div>
                        <div class="past-consultaton-white">
                            <div class="past-details-head">
                                <div class="heading-past-details">
                                    Consultation request details
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
                                        if(isset($past_consultation_arr['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$past_consultation_arr['consultation_for']);
                                        }
                                    @endphp

                                    @if(isset($consultation_for))
                                        @foreach($consultation_for as $key=>$purpose)
                                            @if($purpose != "")
                                                <div class="col l6 m6 s6 p-0 col-payment-invoice">
                                                    <div class="purpose-block-content">
                                                        <div class=" purpose-check-img">
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
                                                    var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                @php $symptoms = isset($past_consultation_arr['symptoms']) && !empty($past_consultation_arr['symptoms']) ? $past_consultation_arr['symptoms'] : 'Not available' @endphp
                                <div class="doctor-consultation-note-content">
                                    <!-- <span>{{ substr($symptoms,0,200) }}</span> @if( !empty(substr($symptoms,200)) ) <span class="more-content">{{ substr($symptoms,200) }}</span><a class="expand-more-btn green-text"> Read More </a><a class="close-more-btn green-text">Close </a> @endif -->
                                    <p class="dec_symptoms"></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        var patient_id             = "{{ isset($past_consultation_arr['patient_user_id']) && !empty($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '' }}";
                                        var symptoms               = "{{ isset($past_consultation_arr['symptoms']) && !empty($past_consultation_arr['symptoms']) ? $past_consultation_arr['symptoms'] : '' }}"; 
                                        var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                        var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                             
                                             var dumpSessionId = '{{isset($past_consultation_arr["patient_user_details"]["dump_session"])?$past_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($past_consultation_arr["patient_user_details"]["dump_id"])?$past_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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

                </div>
            </form>




            <div class="col l4 m4 s4 responsive-set-block">
                <div class="consultation-request-right-bar">
                    <div class="blue-border-block-top"></div>
                    <div class="past-consultaton-white right-bar-consultation-main">
                        <div class="reconnect-patient-inner">
                            <!-- <div class="reconnetct-patient-btn">
                                <a class="btn-reconnect-patient truncate" href="#reconnect_modal"> <i class="fa fa-video-camera"></i> Re-connect to patient</a>
                            </div> -->
                            <div class="time-date ">
                                <div class="row">
                                    <div class="watch-img-block">
                                        <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                    </div>
                                    <div class="time-block-main">
                                        
                                        <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $past_consultation_arr["consultation_datetime"]); ?>

                                        <div class="clock-block">
                                            <label class="time" style="font-size: 18px;">{{isset($consult_datetime) ? date("h:i a D", strtotime($consult_datetime)): ''}},</label>
                                            <div class="date" style="font-size: 16px;">{{isset($consult_datetime) ? date("F d Y", strtotime($consult_datetime)): ''}}</div>
                                            <span class="greenColr">Time</span>
                                        </div>
                                        @php
                                            $call_time_doc = isset($past_consultation_arr['call_time']) ? $past_consultation_arr['call_time'] : '';
                                            $call_time_pat = isset($past_consultation_arr['call_time_patient']) ? $past_consultation_arr['call_time_patient'] : '';

                                            if($call_time_doc > $call_time_pat)
                                            {
                                                $call_time = $call_time_pat;
                                            }
                                            else
                                            {
                                                $call_time = $call_time_doc;
                                            }
                                        @endphp
                                        <div class="min-lengh-block">
                                            <div class="mrtplft">
                                                <label class="time">{{ $call_time }}</label>
                                                <span class="greenColr">Length</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-message-patient">
                            <div class="message-patient">
                                @php
                                    $patient_id = isset($past_consultation_arr['patient_user_id']) ? $past_consultation_arr['patient_user_id'] : '';
                                    $enc_patient_id = base64_encode($patient_id);
                                @endphp
                                <a href="{{ url('/') }}/doctor/patients/chats/{{ $enc_patient_id }}" class="border-btn cart round-corner center-align">Message Patient</a>
                            </div>
                            <!-- <div class="cancel-consultation">
                                <a class="border-btn cart round-corner center-align truncate">Cancel Consultation</a>
                            </div> -->
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
    });
</script>

<script>
var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"
var userkey                = "{{ isset($past_consultation_arr['patient_user_details']['dump_session']) && !empty($past_consultation_arr['patient_user_details']['dump_session']) ? $past_consultation_arr['patient_user_details']['dump_session'] : '' }}";
var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
var api                    = virgil.API(VIRGIL_TOKEN);
var key                    = api.keys.import(userkey);

$(document).ready(function(){
var formData = new FormData();


    var url = "<?php echo $module_url_path; ?>";

    if($('#upd_status').val() !='')
    {
        $(".open_popup").click();
        $('.flash_msg_text').html($('#upd_status').val());

    }

    $('#btn_edit_details').click(function(){
            $('#edit_details_block').show();    
            $('#edit_patient').show();    
            $('#display_details_block').hide();    
            $('#display_patient').hide();    
       });

    $('#btn_cancel_edit').click(function(){
            $('#edit_details_block').hide();    
            $('#edit_patient').hide();    
            $('#display_details_block').show();    
            $('#display_patient').show();    
    });

    $('#edit_details_form').submit(function(e){
            $('#edit_details_form').submit();
       });
    
       var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

        $('#consultation_document').on('change', function(evt) {

            $.each(this.files, function (index, file) {

            var size = file.size;
            var ext  = file.name.substring(file.name.lastIndexOf('.') + 1);

                if(ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="pdf" && ext!="PDF" && ext!="xlsx" && ext!="XLXS" && ext!="docx" && ext!="DOCX" && ext!="doc" && ext!="DOC" && ext!="txt" && ext!="TXT" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")   
                {
                    alert('This file type is not supported.');

                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        callback(true, e.target.result);
                    }  
                    return false;
                }
                if( file.size >= 5000000)
                { 
                    alert('Max size allowed is 5mb.');

                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        callback(true, e.target.result);
                    }  
                    return false;
                }
                var file_obj = file;
                var fileReader = new FileReader();
                fileReader.readAsArrayBuffer(file_obj);
                fileReader.onload = function (e) {
                    var filename   =  file_obj.name.split('\\').pop();
                    var imageData              = fileReader.result;
                    var fileAsBuffer           = new Buffer(imageData);
                    var api                    = virgil.API(VIRGIL_TOKEN);
                    var findkey                = api.cards.get(card_id).then(function (cards) {
                        var encryptedFile      = api.encryptFor(fileAsBuffer, cards);
                        var blob               = new Blob([encryptedFile]);
                        var enc_file = new File([blob], filename);
                        formData.append('consultation_document[]',enc_file);
                    }); 
                }
            });
        });

       $('.remove_document_btn').click(function(){
            $(this).closest('li').remove();
            var delete_val = $('#delete_doc').val();
            var delete_id  = $(this).attr('data-id')+',';
            multiple_ids = delete_val + delete_id;
            
            $('#delete_doc').val(multiple_ids);
       });


        var imagefileExtension = ['jpg','jpeg','png','gif','bmp'];

        $('#consultation_images').on('change', function(evt) {

            $.each(this.files, function (index, file) {

            var size = file.size;
            var ext  = file.name.substring(file.name.lastIndexOf('.') + 1);

                if(ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")   
                {
                    alert('This file type is not supported.');

                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        callback(true, e.target.result);
                    }  
                    return false;
                }
                if( file.size >= 5000000)
                { 
                    alert('Max size allowed is 5mb.');

                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        callback(true, e.target.result);
                    }  
                    return false;
                }
                var file_obj = file;
                var fileReader = new FileReader();
                fileReader.readAsArrayBuffer(file_obj);
                fileReader.onload = function (e) {
                    var filename   =  file_obj.name.split('\\').pop();
                    var imageData              = fileReader.result;
                    var fileAsBuffer           = new Buffer(imageData);
                    var api                    = virgil.API(VIRGIL_TOKEN);
                    var findkey                = api.cards.get(card_id).then(function (cards) {
                        var encryptedFile      = api.encryptFor(fileAsBuffer, cards);
                        var blob               = new Blob([encryptedFile]);
                        var enc_file = new File([blob], filename);
                        formData.append('consultation_images[]',enc_file);
                    }); 
                }
            });
        });

        $('.remove_img_btn').click(function(){
            $(this).closest('div').remove();
            var delete_val = $('#delete_img').val();
            var delete_id  = $(this).attr('data-del-id')+',';
            multiple_ids = delete_val + delete_id;
            
            $('#delete_img').val(multiple_ids);
        });

       $('#btn_submit_doctor_notes').click(function(){

        var consultation_notes     = $("#consultation_notes").val();
        var card_id                = "{{ isset($past_consultation_arr['patient_user_details']['dump_id']) && !empty($past_consultation_arr['patient_user_details']['dump_id']) ? $past_consultation_arr['patient_user_details']['dump_id'] : '' }}"

        var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
        var api                    = virgil.API(VIRGIL_TOKEN);

        var consultation_id = $('#consultation_id').val();
        var patient_user_id = $('#patient_user_id').val();
        var delete_img      = $('#delete_img').val();
        var delete_doc      = $('#delete_doc').val();
        var _token          = '{{csrf_token()}}';

        formData.append('_token',_token);
        formData.append('patient_user_id',patient_user_id);
        formData.append('consultation_id',consultation_id);
        formData.append('delete_img',delete_img);
        formData.append('delete_doc',delete_doc);
        formData.append('enc_consultation_notes',enc_consultation_notes);
        // get User's card(s)
        var findkey = api.cards.get(card_id)
        .then(function (cards) {

            var enc_consultation_notes = encrypt(api, consultation_notes, cards);
            formData.append('enc_consultation_notes',enc_consultation_notes);
            //$("#enc_consultation_notes").val(enc_consultation_notes);
            //document.getElementById("edit_details_form").submit();

                    $.ajax({
                        url:"{{$module_url_path}}/consultation/past_consultation/update",
                        type:'post',
                        data:formData,
                        processData: false,
                        contentType: false,
                        cache:false,
                        success:function(data){
                          window.location.reload();
                        }
                    });

        }).then(null, function () {
            $(".open_popup").click();
            $('.flash_msg_text').html('Something went wrong');
        });

    });

    function encrypt(api, text, cards)
    {
        // encrypt the text using User's cards
        var encryptedMessage = api.encryptFor(text, cards);
        var encData = encryptedMessage.toString("base64");
        return encData;
    }

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


<script type="text/javascript">
    var _token = '{{csrf_token()}}';
    $('#btn_download_pdf').click(function(){
        $.ajax({
               url:"{{url('/')}}/doctor/consultation/past_consultation_details/download/{{isset($past_consultation_arr['id']) ? base64_encode($past_consultation_arr['id']) : ''}}",
               type:'get',
               success:function(response){

                  if(response!='')
                  {
                    if(response.past_consultation_arr.patient_info.phone_no != "")
                    {
                        var dec_phone_no = key.decrypt(response.past_consultation_arr.patient_info.phone_no).toString();
                        response.past_consultation_arr.patient_info.dec_phone_no = dec_phone_no;
                    }

                    if(response.past_consultation_arr.patient_info.suburb != "")
                    {
                        var dec_suburb = key.decrypt(response.past_consultation_arr.patient_info.suburb).toString();
                        response.past_consultation_arr.patient_info.dec_suburb = dec_suburb;
                    }

                    response.arr_consultation_for = [];
                    if(response.past_consultation_arr.consultation_for != "")
                    {
                        var arr_consultation_for = response.past_consultation_arr.consultation_for.split(',');
                        $.each(arr_consultation_for,function(index,value){
                            if(value!=undefined && value!='')
                            {
                                var dec_purpose = key.decrypt(value).toString();
                                response.arr_consultation_for.push(dec_purpose);   
                            }
                        });
                    }

                    if(response.past_consultation_arr.symptoms != "")
                    {
                        var dec_symptoms = key.decrypt(response.past_consultation_arr.symptoms).toString();
                        response.past_consultation_arr.dec_symptoms = dec_symptoms;
                    }

                    $.ajax({
                       url:"{{url('/')}}/doctor/consultation/past_consultation_details_generate_pdf",
                       type:'post',
                       data:{'arr_data' : response,'_token' : _token},
                       
                       success:function(response){
                            pdf_url = "{{url('/')}}/doctor/consultation/past_consultation_details_generate_pdf";
                            window.open(pdf_url, '_blank');
                       }

                    });
                        
                  }
               }
            });
    });    
</script>
@endsection