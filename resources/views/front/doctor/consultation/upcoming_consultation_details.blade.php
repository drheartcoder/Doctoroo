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
                <a href="#consultation-history" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span>Past Consultations</a>
            </li>
            <li class="tab" id="tab_declined_consultation">
                <a href="#decline_consultation"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon" /> </span>Declined Consultations</a>
            </li>
        </ul>
    </div>

    <div id="past" class="tab-content medi past-consultation-main">
        <div class="patient-list-heading">
            <span class="left qusame rescahnge"><a href="{{URL::previous()}}" class="border-btn round-corner center-align"> <span class="arow-left-block"><i class="fa fa-angle-left"></i></span> Back </a>
            </span>
            <span class="patient-list-title">
                Upcoming Consultation Details
            </span>
        </div>
        <div class="row" id="display_details_block">
           

            <div class="col l8 m8 s8 responsive-set-block">
                <div class="blue-border-block-top"></div>
                <div class="past-consultaton-white">
                    <div class="past-details-head">
                        <div class="edit-down-save-btn">
                            <!-- <span class="edit-btn-past"><a class="btn-edit-past btn-floating" target="_blank" href="{{$module_url_path}}/past_consultation_details/download/{{isset($upcoming_consultation_arr['id']) ? base64_encode($upcoming_consultation_arr['id']) : ''}}"><i class="fa fa-download"></i></a></span> -->
                            <span class="edit-btn-past"><a class="btn-edit-past btn-floating" id="btn_edit_details" href="javascript:void(0)"><i class="fa fa-pencil"></i></a></span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="heading-past-details">
                            Upcoming consultation details
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row consultation-id-main">
                        <div class="col l4 m4 s4">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($upcoming_consultation_arr['consultation_id']) ? $upcoming_consultation_arr['consultation_id'] : ''}}
                                </div>
                                <div class="consultation-id-content">
                                    Consultation ID
                                </div>
                            </div>
                        </div>
                        <div class="col l5 m5 s5">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label" id="patient_name">@if(isset($upcoming_consultation_arr) && $upcoming_consultation_arr['familiy_member_info'] == null){{isset($upcoming_consultation_arr['patient_user_details']['title']) ? $upcoming_consultation_arr['patient_user_details']['title'] : ''}} {{isset($upcoming_consultation_arr['patient_user_details']['first_name']) ? $upcoming_consultation_arr['patient_user_details']['first_name'] : ''}} {{isset($upcoming_consultation_arr['patient_user_details']['last_name']) ? $upcoming_consultation_arr['patient_user_details']['last_name'] : ''}} @elseif(isset($upcoming_consultation_arr['familiy_member_info'])) {{isset($upcoming_consultation_arr['familiy_member_info']['first_name']) ? $upcoming_consultation_arr['familiy_member_info']['first_name'] : ''}} {{isset($upcoming_consultation_arr['familiy_member_info']['last_name']) ? $upcoming_consultation_arr['familiy_member_info']['last_name'] : ''}} @endif</div>
                                <div class="consultation-id-content">
                                    Consulting Patient
                                </div>
                            </div>
                        </div>
                        <div class="col l3 m3 s3">
                            <div class="consultation-id-block">
                                <div class="consultation-id-label">
                                    {{isset($upcoming_consultation_arr['booking_status']) ? $upcoming_consultation_arr['booking_status'] : ''}}
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
                            <p class="dec_consultation_note" id="doctor_consultation_notes"></p>

                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($upcoming_consultation_arr['patient_user_id']) && !empty($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : '' }}";
                                    var consultation_note      = "{{ isset($upcoming_consultation_arr['consultation_notes']['notes']) && !empty($upcoming_consultation_arr['consultation_notes']['notes']) ? $upcoming_consultation_arr['consultation_notes']['notes'] : '' }}"; 
                                    var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                    var key                    = api.keys.import(userkey);
                                    if(consultation_note != ""){
                                        var dec_consultation_note = key.decrypt(consultation_note).toString();
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
                                @if(isset($upcoming_consultation_arr['consultation_documents']) && !empty($upcoming_consultation_arr['consultation_documents']))
                                        @foreach($upcoming_consultation_arr['consultation_documents'] as $key => $val)
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
                                                    <br/>
                                                    <input type="hidden" class="txt_doc_show_{{$key}}" name="doc_show_{{$key}}" value="">
                                                    <!-- Decrypt Documents -->
                                                    <script type="text/javascript">
                                                     var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                                     var api           = virgil.API(virgilToken);
                                                     
                                                     var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                                     var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                                                                    img.download  = image_file_filename;
                                                                    img.href      = imageUrl;
                                                                    $(".doc_show_"+innerkey).attr('href',imageUrl);
                                                                    $(".txt_doc_show_"+innerkey).val(imageUrl);
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
                            <input type="hidden" class="doc_count" name="doc_count" value="{{ count($upcoming_consultation_arr['consultation_documents']) }}">
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
                                            <input type="hidden" class="txt_image_show_{{$key}}" name="image_show_{{$key}}" value="">
                                            <!-- Decrypt Images -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                                                            $(".txt_image_show_"+innerkey).val(imageUrl);
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
                            <input type="hidden" class="image_count" name="image_show" value="{{ count($health_images_arr) }}">
                    </div>

                    <div class="payment-invoice-disputes">
                        <div class="row">
                            @if(isset($upcoming_consultation_arr['invoice_info']) && !empty($upcoming_consultation_arr['invoice_info']))
                                <div class="col l6 m6 s6 col-payment-invoice">
                                    <div class="consultation-id-label doctor-consultation-note-head">
                                        Payment &amp; invoice
                                    </div>

                                    @foreach($upcoming_consultation_arr['invoice_info'] as $invoice_data)
                                        @php
                                            $pay_status = isset($invoice_data['payment_status']) ? $invoice_data['payment_status'] : '';
                                            $pay_id = isset($invoice_data['id']) ? $invoice_data['id'] : '';
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
                                                Total: {{ $pay_amount }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(isset($upcoming_consultation_arr['disputes']) && !empty($upcoming_consultation_arr['disputes']))
                                <div class="col l6 m6 s6 col-payment-invoice">
                                    <div class="consultation-id-label doctor-consultation-note-head">
                                        Disputes
                                    </div>
                                    @foreach($upcoming_consultation_arr['disputes'] as $dispute)
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
                                        if(isset($upcoming_consultation_arr['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$upcoming_consultation_arr['consultation_for']);
                                        }
                                    @endphp

                                    <script type="text/javascript">
                                        var purpose_for_arr = [];
                                    </script>

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
                                                    var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
                                                    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                                                    var api                    = virgil.API(VIRGIL_TOKEN);
                                                    var key                    = api.keys.import(userkey);

                                                    if(purpose_for != ""){
                                                      var dec_purpose_for   = key.decrypt(purpose_for).toString();

                                                      if(dec_purpose_for == 'advice_and_treatment'){
                                                        $('.dec_purpose_for'+purpose_key).html('Advice & Treatment');
                                                        purpose_for_arr.push("Advice & Treatment");
                                                      }
                                                      if(dec_purpose_for == 'prescriptions_and_repeats'){
                                                        $('.dec_purpose_for'+purpose_key).html('Prescription or Repeat');
                                                        purpose_for_arr.push("Prescription or Repeat");
                                                      }
                                                      if(dec_purpose_for == 'medical_cetificate'){
                                                        $('.dec_purpose_for'+purpose_key).html('Medical Cerrificate');
                                                        purpose_for_arr.push("Medical Cerrificate");
                                                      }
                                                      if(dec_purpose_for == 'other'){
                                                        $('.dec_purpose_for'+purpose_key).html('Other');
                                                        purpose_for_arr.push("Other");
                                                      }
                                                      $('#txt_purpose_for_arr').val(purpose_for_arr);
                                                    }
                                                    });
                                                </script>
                                            @endif        
                                        @endforeach
                                    @endif
                                </div>
                                <input type="hidden" id="txt_purpose_for_arr" name="purpose_for_arr" value="">
                            </div>
                        </div>
                        <div class="doctor-consultation-note">
                            <div class="consultation-id-label doctor-consultation-note-head">
                                Symptom(s) or reason for consultation
                            </div>
                            @php $symptoms = isset($upcoming_consultation_arr['symptoms']) && !empty($upcoming_consultation_arr['symptoms']) ? $upcoming_consultation_arr['symptoms'] : 'Not available' @endphp
                            <div class="doctor-consultation-note-content">
                                <!-- <span>{{ substr($symptoms,0,200) }}</span> @if( !empty(substr($symptoms,200)) ) <span class="more-content">{{ substr($symptoms,200) }}</span><a class="expand-more-btn green-text"> Read More </a><a class="close-more-btn green-text">Close </a> @endif -->
                                <p class="dec_symptoms"></p>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($upcoming_consultation_arr['patient_user_id']) && !empty($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : '' }}";
                                    var symptoms               = "{{ isset($upcoming_consultation_arr['symptoms']) && !empty($upcoming_consultation_arr['symptoms']) ? $upcoming_consultation_arr['symptoms'] : '' }}"; 
                                    var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                            <input type="hidden" class="pat_image_show_{{$key}}" name="pat_image_show_{{$key}}" value="">
                                            <!-- Decrypt Images -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                                                            $(".pat_image_show_"+innerkey).val(imageUrl);
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
                            <input type="hidden" class="pat_image_count" name="pat_image_show" value="{{ count($health_images_arr) }}">
                        </div>
                    </div>
                    <div class="blue-border-block-bottom"></div>
                </div>
            </div>

   <!-- !!!!!!!!!!! -->

                @php
                    $patient_id = isset($upcoming_consultation_arr['patient_user_details']['id']) ? $upcoming_consultation_arr['patient_user_details']['id'] : '';
                    $enc_patient_id = base64_encode($patient_id);

                    $booking_id = isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '';
                    $enc_booking_id = base64_encode($booking_id);
                @endphp
                <div class="col l4 m4 s4 responsive-set-block">
                    <div class="consultation-request-right-bar">
                        <div class="blue-border-block-top"></div>
                        <div class="past-consultaton-white right-bar-consultation-main">
                            <div class="reconnect-patient-inner">
                                <div class="reconnetct-patient-btn">

                                    <a class="btn-reconnect-patient truncate open_video_call" data-patient_id="{{ $enc_patient_id }}" data-booking_id="{{ $enc_booking_id }}" data-status="start" style="cursor: pointer;"> <i class="fa fa-video-camera"></i> Begin Video Consult</a>

                                    <script>
                                        $(document).on('click','.open_video_call',function(){
                                            var patient_id  = $(this).attr("data-patient_id");
                                            var booking_id  = $(this).attr("data-booking_id");
                                            var url         = "{{ url('/') }}/doctor/video/"+booking_id;
                                            var title       = 'Video Chat';
                                            var w           = 400;
                                            var h           = 650;
                                            var left        = (screen.width/2)-(w/2);
                                            var top         = (screen.height/2)-(h/2);
                                            window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                                        });
                                    </script>
                                </div>
                                <div class="time-date ">
                                    <div class="row">
                                        <div class="watch-img-block">
                                            <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                        </div>
                                        <div class="time-block-main">
                                            <div class="clock-block">
                                                <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $upcoming_consultation_arr["consultation_datetime"]); ?>
                                                <label class="time" style="font-weight: bold;">{{ date("h:i a D, d M Y",strtotime($consult_datetime)) }}</label>
                                                <span class="greenColr">Confirmed Time</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-date ">
                                    <div class="row">
                                        <div class="watch-img-block">
                                            <img src="{{url('/')}}/public/doctor_section/images/time-count-img.png" alt="" />
                                        </div>
                                        <div class="time-block-main">
                                            <div class="clock-block">
                                                <div class="time-count-block">
                                                    <input type="hidden" id="consultation_datetime" name="consultation_datetime" value="{{isset($upcoming_consultation_arr['consultation_datetime']) ? $upcoming_consultation_arr['consultation_datetime'] : ''}}">
                                                    <div class="get_countdown"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-message-patient" id="div_select_confirm_time" style="display: none;">
                                Live Time Status Update
                                <select id="cmb_video_timer" name="cmb_video_timer">
                                    <option value="" selected="selected">Select Time</option>
                                    <?php for($i = 1; $i <= 30; $i++) {?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?> mins</option>
                                    <?php } ?>
                                </select>
                                <input type="submit" id="btn_confirm_time" class="border-btn cart round-corner center-align" name="btn_confirm_time" value="Confirm Time">
                            </div>

                            <div class="btn-message-patient" id="div_ready_for_call" style="display: none;">
                                Call Status
                                <button class="btn_status_for_call ready-status" data-status="ready">Ready</button>
                                <button class="btn_status_for_call busy-status" data-status="busy">Busy</button>

                                
                                <div>Note: Patient is 
                                    @if($upcoming_consultation_arr['patient_is_ready'] == 1) 
                                        Ready
                                    @else
                                        Busy
                                    @endif        
                                    for video call
                                </div>

                                <input type="hidden" id="txt_set_booking_id" name="txt_set_booking_id" value="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}">
                            </div>

                            <div class="btn-message-patient">
                                @if($upcoming_consultation_arr['call_time'] != null && $upcoming_consultation_arr['call_time_patient'] != null &&  $upcoming_consultation_arr['call_time'] != '00:00:00' && $upcoming_consultation_arr['call_time_patient'] != '00:00:00') 
                                    <div class="generate_invoice_section" id="generate_invoice_section">
                                        <div class="border-btn cart round-corner center-align generate_invoice" style="cursor: pointer;">Generate Invoice</div>
                                    </div>
                                @else
                                    <div class="message-patient">
                                        <a class="border-btn cart round-corner center-align resechdule_booking" id="btn_resechdule" data-user_id="{{isset($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : ''}}" data-booking_id="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}" data-booking_status="Reschedule" style="cursor: pointer;">Reschedule Time</a>
                                    </div>
                                    <div class="cancel-consultation">
                                        <div class="border-btn cart round-corner center-align change_booking_status" data-user_id="{{isset($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : ''}}" data-booking_id="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}" data-booking_status="Cancelled" style="cursor: pointer;">Cancel Consultation</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
    <!-- !!!!!!!!!!! -->
        </div>


        <div class="row" id="edit_details_block" style="display: none;">
            <form id="edit_details_form" method="post" action="{{$module_url_path}}/past_consultation/update" enctype="multipart/form-data"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="consultation_id" id="consultation_id" value="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}">
                <input type="hidden" name="patient_user_id" id="patient_user_id" value="{{ isset($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : '' }}">
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
                                Upcoming consultation details Edit
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row consultation-id-main">
                            <div class="col l4 m4 s4">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        {{isset($upcoming_consultation_arr['consultation_id']) ? $upcoming_consultation_arr['consultation_id'] : ''}}
                                    </div>
                                    <div class="consultation-id-content">
                                        Consultation ID
                                    </div>
                                </div>
                            </div>
                            <div class="col l5 m5 s5">
                                <div class="consultation-id-block">
                                    <div class="consultation-id-label">
                                        @if(isset($upcoming_consultation_arr) && $upcoming_consultation_arr['familiy_member_info'] == null) 
                                        {{isset($upcoming_consultation_arr['patient_user_details']['title']) ? $upcoming_consultation_arr['patient_user_details']['title'] : ''}}
                                        {{isset($upcoming_consultation_arr['patient_user_details']['first_name']) ? $upcoming_consultation_arr['patient_user_details']['first_name'] : ''}} {{isset($upcoming_consultation_arr['patient_user_details']['last_name']) ? $upcoming_consultation_arr['patient_user_details']['last_name'] : ''}} 
                                        @elseif(isset($upcoming_consultation_arr['familiy_member_info'])) {{isset($upcoming_consultation_arr['familiy_member_info']['first_name']) ? $upcoming_consultation_arr['familiy_member_info']['first_name'] : ''}} {{isset($upcoming_consultation_arr['familiy_member_info']['last_name']) ? $upcoming_consultation_arr['familiy_member_info']['last_name'] : ''}} 
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
                                        {{isset($upcoming_consultation_arr['booking_status']) ? $upcoming_consultation_arr['booking_status'] : ''}}
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
                                <textarea class="materialize-textarea" name="consultation_notes" id="consultation_notes">{{ isset($upcoming_consultation_arr['consultation_notes']['notes']) && !empty($upcoming_consultation_arr['consultation_notes']['notes']) ? $upcoming_consultation_arr['consultation_notes']['notes'] : '' }}</textarea>
                                <input type="hidden" name="enc_consultation_notes" id="enc_consultation_notes" value="">
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    var patient_id             = "{{ isset($upcoming_consultation_arr['patient_user_id']) && !empty($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : '' }}";
                                    var consultation_note      = "{{ isset($upcoming_consultation_arr['consultation_notes']['notes']) && !empty($upcoming_consultation_arr['consultation_notes']['notes']) ? $upcoming_consultation_arr['consultation_notes']['notes'] : '' }}"; 
                                    var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                    var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                @if(isset($upcoming_consultation_arr['consultation_documents']) && !empty($upcoming_consultation_arr['consultation_documents']))
                                        @foreach($upcoming_consultation_arr['consultation_documents'] as $key => $val)
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
                                                     
                                                     var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                                     var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                                             
                                             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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
                                @if(isset($upcoming_consultation_arr['invoice_info']) && !empty($upcoming_consultation_arr['invoice_info']))
                                    <div class="col l6 m6 s6 col-payment-invoice">
                                        <div class="consultation-id-label doctor-consultation-note-head">
                                            Payment &amp; invoice
                                        </div>
                                        @foreach($upcoming_consultation_arr['invoice_info'] as $invoice_data)
                                            @php
                                                $pay_status = isset($invoice_data['payment_status']) ? $invoice_data['payment_status'] : '';
                                                $pay_id = isset($invoice_data['id']) ? $invoice_data['id'] : '';
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
                                                    Total: {{ $pay_amount }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($upcoming_consultation_arr['disputes']) && !empty($upcoming_consultation_arr['disputes']))
                                    <div class="col l6 m6 s6 col-payment-invoice">
                                        <div class="consultation-id-label doctor-consultation-note-head">
                                            Disputes
                                        </div>
                                        @foreach($upcoming_consultation_arr['disputes'] as $dispute)
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
                                        if(isset($upcoming_consultation_arr['consultation_for']))
                                        {
                                            $consultation_for = explode(',',$upcoming_consultation_arr['consultation_for']);
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
                                                    var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                                    var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                @php $symptoms = isset($upcoming_consultation_arr['symptoms']) && !empty($upcoming_consultation_arr['symptoms']) ? $upcoming_consultation_arr['symptoms'] : 'Not available' @endphp
                                <div class="doctor-consultation-note-content">
                                    <!-- <span>{{ substr($symptoms,0,200) }}</span> @if( !empty(substr($symptoms,200)) ) <span class="more-content">{{ substr($symptoms,200) }}</span><a class="expand-more-btn green-text"> Read More </a><a class="close-more-btn green-text">Close </a> @endif -->
                                    <p class="dec_symptoms"></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        var patient_id             = "{{ isset($upcoming_consultation_arr['patient_user_id']) && !empty($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : '' }}";
                                        var symptoms               = "{{ isset($upcoming_consultation_arr['symptoms']) && !empty($upcoming_consultation_arr['symptoms']) ? $upcoming_consultation_arr['symptoms'] : '' }}"; 
                                        var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
                                        var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
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
                                             
                                             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                                             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
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




            @php
                    $patient_id = isset($upcoming_consultation_arr['patient_user_details']['id']) ? $upcoming_consultation_arr['patient_user_details']['id'] : '';
                    $enc_patient_id = base64_encode($patient_id);

                    $booking_id = isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '';
                    $enc_booking_id = base64_encode($booking_id);
                @endphp
                <div class="col l4 m4 s4 responsive-set-block">
                    <div class="consultation-request-right-bar">
                        <div class="blue-border-block-top"></div>
                        <div class="past-consultaton-white right-bar-consultation-main">
                            <div class="reconnect-patient-inner">
                                <div class="reconnetct-patient-btn">

                                    <a class="btn-reconnect-patient truncate open_video_call" data-patient_id="{{ $enc_patient_id }}" data-booking_id="{{ $enc_booking_id }}" data-status="start" style="cursor: pointer;"> <i class="fa fa-video-camera"></i> Begin Video Consult</a>

                                    <script>
                                        $(document).on('click','.open_video_call',function(){
                                            var patient_id  = $(this).attr("data-patient_id");
                                            var booking_id  = $(this).attr("data-booking_id");
                                            var url         = "{{ url('/') }}/doctor/video/"+booking_id;
                                            var title       = 'Video Chat';
                                            var w           = 400;
                                            var h           = 650;
                                            var left        = (screen.width/2)-(w/2);
                                            var top         = (screen.height/2)-(h/2);
                                            window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                                        });
                                    </script>
                                </div>
                                <div class="time-date ">
                                    <div class="row">
                                        <div class="watch-img-block">
                                            <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
                                        </div>
                                        <div class="time-block-main">
                                            <div class="clock-block">
                                                <label class="time" style="font-weight: bold;">{{ date("h:i a D, d M Y",strtotime($consult_datetime)) }}</label>
                                                <span class="greenColr">Confirmed Time</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-date ">
                                    <div class="row">
                                        <div class="watch-img-block">
                                            <img src="{{url('/')}}/public/doctor_section/images/time-count-img.png" alt="" />
                                        </div>
                                        <div class="time-block-main">
                                            <div class="clock-block">
                                                <div class="time-count-block">
                                                    <input type="hidden" id="consultation_datetime" name="consultation_datetime" value="{{isset($upcoming_consultation_arr['consultation_datetime']) ? $upcoming_consultation_arr['consultation_datetime'] : ''}}">
                                                    <div class="get_countdown"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-message-patient" id="div_select_confirm_time" style="display: none;">
                                Live Time Status Update
                                <select id="cmb_video_timer" name="cmb_video_timer">
                                    <option value="" selected="selected">Select Time</option>
                                    <?php for($i = 1; $i <= 30; $i++) {?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?> mins</option>
                                    <?php } ?>
                                </select>
                                <input type="submit" id="btn_confirm_time" class="border-btn cart round-corner center-align" name="btn_confirm_time" value="Confirm Time">
                            </div>

                            <div class="btn-message-patient" id="div_ready_for_call" style="display: none;">
                                Call Status
                                <button class="btn_status_for_call ready-status" data-status="ready">Ready</button>
                                <button class="btn_status_for_call busy-status" data-status="busy">Busy</button>

                                
                                <div>Note: Patient is 
                                    @if($upcoming_consultation_arr['patient_is_ready'] == 1) 
                                        Ready
                                    @else
                                        Busy
                                    @endif        
                                    for video call
                                </div>

                                <input type="hidden" id="txt_set_booking_id" name="txt_set_booking_id" value="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}">
                            </div>

                            <div class="btn-message-patient">
                                @if($upcoming_consultation_arr['call_time'] != null && $upcoming_consultation_arr['call_time_patient'] != null &&  $upcoming_consultation_arr['call_time'] != '00:00:00' && $upcoming_consultation_arr['call_time_patient'] != '00:00:00') 
                                    <div class="generate_invoice_section" id="generate_invoice_section">
                                        <div class="border-btn cart round-corner center-align generate_invoice" style="cursor: pointer;">Generate Invoice</div>
                                    </div>
                                @else
                                    <div class="message-patient">
                                        <a class="border-btn cart round-corner center-align resechdule_booking" id="btn_resechdule" data-user_id="{{isset($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : ''}}" data-booking_id="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}" data-booking_status="Reschedule" style="cursor: pointer;">Reschedule Time</a>
                                    </div>
                                    <div class="cancel-consultation">
                                        <div class="border-btn cart round-corner center-align change_booking_status" data-user_id="{{isset($upcoming_consultation_arr['patient_user_id']) ? $upcoming_consultation_arr['patient_user_id'] : ''}}" data-booking_id="{{ isset($upcoming_consultation_arr['id']) ? $upcoming_consultation_arr['id'] : '' }}" data-booking_status="Cancelled" style="cursor: pointer;">Cancel Consultation</div>
                                    </div>
                                @endif
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



<!-- Modal Structure -->
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
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">No</a>
            <a href="javascript:void(0)" class="modal-action waves-effect waves-green btn-cancel-cons" id="change_status">Yes</a>         
        </div>     
    </div>

    <a class="confirm_resechdule" href="#popup_confirm_resechdule" style="display: none;"></a>
    <div id="popup_confirm_resechdule" class="modal addperson" style="display: none;">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align" id="resechdule_message"></p>
                    <input type="hidden" id="resechdule_patient_id">
                    <input type="hidden" id="resechdule_booking_id">
                    <input type="hidden" id="resechdule_booking_status">
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">No</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons" id="confirm_resechdule_yes">Yes</a>         
        </div>     
    </div>

    <form id="submit_resechdule_form" method="POST" action="{{ url('/') }}/doctor/consultation/show_available_time" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" id="get_resechdule_patient_id" name="get_patient_id" >
        <input type="hidden" id="get_resechdule_booking_id" name="get_booking_id" >
    </form>
<!-- Modal Structure -->

    <input type="hidden" id="get_consultation_id" name="get_consultation_id" value="{{ $upcoming_consultation_arr['id'] }}">

    <script>
        formData = new FormData();
        var url ="<?php echo $module_url_path; ?>";
        
        @if(isset($health_images_arr) && !empty($health_images_arr))
        @foreach($health_images_arr as $key => $val)
            @if($val['health_image'] !='' && File::exists($patient_uploads_public_url.$val['health_image']))

             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
             var api           = virgil.API(virgilToken);
             
             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
             if(dumpSessionId!='')
             {
                var image_file = '{{ $patient_uploads_base_url.$val["health_image"] }}';
                
                if(image_file!='')
                {
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
                        var image_file_filename      = '{{ $val["health_image"] }}';
                        var img = imageUrl = '';
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });
                        var dec_file = new File([blob], image_file_filename, { type: mime_type });
                        formData.append('doc_images_arr[]',dec_file);
                        var urlCreator = window.URL || window.webkitURL;
                      
                      }
                    };
                    xhr.send();
                }
             }
            @endif
        @endforeach
    @endif

    @if(isset($health_images_arr) && !empty($health_images_arr))
        @foreach($health_images_arr as $key => $val)
            @if($val['health_image'] !='' && File::exists($patient_uploads_public_url.$val['health_image']))

             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
             var api           = virgil.API(virgilToken);
             
             var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
             var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
             if(dumpSessionId!='')
             {
                var image_file = '{{ $patient_uploads_base_url.$val["health_image"] }}';
                
                if(image_file!='')
                {
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
                        var image_file_filename      = '{{ $val["health_image"] }}';
                        var img = imageUrl = '';
                        var imageData    = fileReader.result;
                        var fileAsBuffer = new Buffer(imageData);

                        var decryptedFile = key.decrypt(fileAsBuffer);
                        var blob = new Blob([decryptedFile], { type: mime_type });
                        var dec_file = new File([blob], image_file_filename, { type: mime_type });
                        formData.append('pat_images_arr[]',dec_file);
                        var urlCreator = window.URL || window.webkitURL;
                      
                      }
                    };
                    xhr.send();
                }
             }
            @endif
        @endforeach
    @endif    

    @if(isset($upcoming_consultation_arr['consultation_documents']) && !empty($upcoming_consultation_arr['consultation_documents']))
        @foreach($upcoming_consultation_arr['consultation_documents'] as $key => $val)
             @if($val['document'] !='' && File::exists($consultation_documents_public_url.$val['document']))
                    <!-- Decrypt Documents -->
                     var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                     var api           = virgil.API(virgilToken);
                     
                     var dumpSessionId = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_session"])?$upcoming_consultation_arr["patient_user_details"]["dump_session"]:""}}';
                     var dumpId        = '{{isset($upcoming_consultation_arr["patient_user_details"]["dump_id"])?$upcoming_consultation_arr["patient_user_details"]["dump_id"]:""}}';
                     if(dumpSessionId!='')
                     {
                        var image_file = '{{ $consultation_documents_base_url.$val["document"] }}';
                        
                        if(image_file!='')
                        {
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
                                var image_file_filename      = '{{ $val["document"] }}';
                                var innerkey       = '{{$key}}';
                                var img = imageUrl = '';
                                var imageData    = fileReader.result;
                                var fileAsBuffer = new Buffer(imageData);

                                var decryptedFile = key.decrypt(fileAsBuffer);
                                var blob = new Blob([decryptedFile], { type: mime_type });
                                
                                var dec_file = new File([blob], image_file_filename, { type: mime_type });
                                formData.append('doc_files_arr[]',dec_file);
                                var urlCreator = window.URL || window.webkitURL;
                              }
                            };
                            xhr.send();
                        }
                     }
             @endif
        @endforeach
@endif

        $(document).ready(function(){

            // generate invoice
            $('.generate_invoice').click(function(){
                var booking_id  = $('#get_consultation_id').val();
                var token       = "<?php echo csrf_token(); ?>";

                var patient_name  = $('#patient_name').html();
                var doctor_consultation_notes = $("#doctor_consultation_notes").html();
                var symptoms = $(".dec_symptoms").html();
                var purpose_for_arr = $("#txt_purpose_for_arr").val();

                var doc_count = $('.doc_count').val();
                var image_count = $('.image_count').val();
                var pat_image_count = $('.pat_image_count').val();

                if(doc_count > 0)
                {   
                    var doc_files_arr = [];
                    for (var i = 0; i < doc_count; i++) {
                        var doc_files = $(".txt_doc_show_"+i).val();
                        doc_files_arr.push(doc_files);
                    }
                }

                if(image_count > 0)
                {
                    var doc_images_arr = [];
                    for (var i = 0; i < image_count; i++) {
                        var doc_images = $(".txt_image_show_"+i).val();
                        doc_images_arr.push(doc_images);
                    }
                }

                if(pat_image_count > 0)
                {
                    var pat_images_arr = [];
                    for (var i = 0; i < pat_image_count; i++) {
                        var pat_images = $(".pat_image_show_"+i).val();
                        pat_images_arr.push(pat_images);
                    }
                }
                formData.append('_token',token);
                formData.append('booking_id',booking_id);
                formData.append('patient_name',patient_name);
                formData.append('doctor_consultation_notes',doctor_consultation_notes);
                formData.append('symptoms',symptoms);
                //formData.append('doc_files_arr',doc_files_arr);
                //formData.append('doc_images_arr',doc_images_arr);
                //formData.append('pat_images_arr',pat_images_arr);
                formData.append('purpose_for_arr',purpose_for_arr);
                if(booking_id != '')
                {
                    $.ajax({
                          url:'{{ url("/") }}/patient/booking/payment/stripe/confirm_payment',
                          type:'POST',
                          data:formData,
                          contentType:false,
                          processData:false,
                          cache:false,
                          success:function(data){
                            if(data == 'success')
                            {
                                $(".open_popup_alert_msg").click();
                                $('.msg_status').html('Success! Invoice Generated Successfull...!');
                                $("#redirect_href").attr("href", "{{ url('/') }}/doctor/consultation/past_consultation");

                            }
                            else
                            {
                                $(".open_popup_alert_msg").click();
                                $('.msg_status').html('Error! Something went worng...!');
                            }
                          }
                    });
                }
            });




            var reschedule_status = $('#reschedule_status').val();
            if(reschedule_status !='' && reschedule_status != null)
            {  
                $(".open_popup").click();
                $('.flash_msg_text').html(reschedule_status);             
            }

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


            // cancel booking
            $('.change_booking_status').click(function(){

                $('#user_id').val($(this).data("user_id"));
                $('#booking_id').val($(this).data("booking_id"));
                $('#booking_status').val($(this).data("booking_status"));

                booking_status = $(this).data("booking_status");

                $('.confirm_action').click();
               
                if(booking_status == 'Cancelled')
                {
                    status = 'Cancel';
                }
                else
                {
                    status = '';
                }

                $('#status_message').html("Are you sure you want to "+status+" Consultation?");

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
                    data:{_token:token, user_id:user_id, booking_id:booking_id, booking_status:booking_status },
                    success : function(res){
                        if(res.status == 'success')
                        {
                            $(".msg_status").html("Consultation Successfully "+booking_status);
                            $(".success_msg").html("Consultation is been moved to Declined Consultation section. You'll be redirect to Declined Consultation List");
                            $("#redirect_href").attr("href", "{{ url('/') }}/doctor/consultation/decline_consultation");
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

            // resechdule booking
            $('.resechdule_booking').click(function(){
                var patient_id = $(this).data("user_id");
                var booking_id = $(this).data("booking_id");
                var booking_status = $(this).data("booking_status");

                $('#resechdule_patient_id').val(patient_id);
                $('#resechdule_booking_id').val(booking_id);
                $('#resechdule_booking_status').val(booking_status);

                $('#get_resechdule_patient_id').val(patient_id);
                $('#get_resechdule_booking_id').val(booking_id);

                $('#resechdule_message').html("Are you sure you want to Resechdule Consultation?");
                $('.confirm_resechdule').click();
            });

            $('#confirm_resechdule_yes').click(function(){
                $('#popup_confirm_resechdule .modal-close').click();
                $('#submit_resechdule_form').submit();
            });

            /*$('#confirm_resechdule_yes').click(function(){
                var patient_id      = $('#resechdule_patient_id').val();
                var booking_id      = $('#resechdule_booking_id').val();
                var booking_status  = $('#resechdule_booking_status').val();
                
                var token = "< ?php echo csrf_token(); ?>";
                $.ajax({
                    url   : "{{ url('/') }}/doctor/consultation/resechdule_booking",
                    type : "POST",
                    dataType:'json',
                    data:{_token:token, patient_id:patient_id, booking_id:booking_id, booking_status:booking_status },
                    success : function(res){
                        if(res.status == 'success')
                        {
                            $(".msg_status").html("Consultation Successfully "+booking_status);
                            $(".success_msg").html("Consultation is been moved to Declined Consultation section. You'll be redirect to Declined Consultation List");
                            $("#redirect_href").attr("href", "{{ url('/') }}/doctor/consultation/decline_consultation");
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
            });*/


            $(".expand-more-btn").on("click", function () {
                $(this).parent(".doctor-consultation-note-content").addClass("active");
            });
            $(".close-more-btn").on("click", function () {
                $(this).parent(".doctor-consultation-note-content").removeClass("active");
            });


            // live time status update
            $('#btn_confirm_time').click(function(){
                var update_time = $('#cmb_video_timer').val();
                var consultation_id = $('#get_consultation_id').val();

                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url   : "{{ url('/') }}/doctor/consultation/update_booking_time",
                    type : "POST",
                    dataType:'json',
                    data:{_token:token, update_time:update_time, consultation_id:consultation_id },
                    success : function(res){
                        if(res)
                        {
                            $(".open_popup").click();
                            $('.flash_msg_text').html(res.msg);
                        }
                    }
                });

            });

            // update call status
            $('.btn_status_for_call').click(function(){
                var booking_id = $('#txt_set_booking_id').val();
                var call_status = $(this).data("status");

                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url   : "{{ url('/') }}/doctor/consultation/update_booking_call_status",
                    type : "POST",
                    dataType:'json',
                    data:{_token:token, booking_id:booking_id, call_status:call_status },
                    success : function(res){
                        if(res)
                        {
                            $(".open_popup").click();
                            $('.flash_msg_text').html(res.msg);
                        }
                    }
                });
            });

            $('.open_video_call').click(function(){
                var booking_id = $('#txt_set_booking_id').val();
                var call_status = $(this).data("status");

                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url   : "{{ url('/') }}/doctor/consultation/start_video_call",
                    type : "POST",
                    dataType:'json',
                    data:{_token:token, booking_id:booking_id, call_status:call_status },
                    success : function(res){
                        if(res)
                        {
                            /*$(".open_popup").click();
                            $('.flash_msg_text').html(res.msg);*/
                        }
                    }
                });
            });

            

        });
    </script>

    <script>

        function get_remaining_time()
        {
            // Set the date we're counting down to
            //var countDownDate = new Date("Aug 5, 2017 15:37:25").getTime();
            var given_time = $('#consultation_datetime').val();
            var countDownDate = new Date(given_time).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
                //var now =  new Date().toLocaleString('en-US', { timeZone: 'Australia/Sydney' });
                var aus =  new Date().toLocaleString('en-US', { timeZone: "{{config('app.timezone')}}" });
                var now = new Date(aus).getTime();
                
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if(days > 0)
                {
                    days = days + ' days ';
                }
                else
                {
                    days = "";
                }

                if(hours > 0)
                {
                    hours = hours + ' hrs ';
                }
                else
                {
                   hours = "";
                }

                if(minutes > 0)
                {
                    minutes = minutes + ' mins ';
                }
                else
                {
                    minutes = "";
                }

                // hide resechdule btn before 1 hr of booking
                if(days + hours < 1)
                {
                    $('#btn_resechdule').css('display', 'none');
                    $('#div_select_confirm_time').css('display', 'block');
                    $('#div_ready_for_call').css('display', 'block');
                }
                
                // Output the result in an element with id="demo"
                //document.getElementById("get_countdown").innerHTML = days + hours + minutes + seconds + ' secs';
                var time_countdown = days + hours + minutes + seconds + ' secs';
                $(".get_countdown").html(time_countdown);
                
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    //document.getElementById("get_countdown").innerHTML = "Time Expired";
                    $(".get_countdown").html("Time Expired");
                }
            }, 1000);
        }
    get_remaining_time();
    </script>




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
$(document).ready(function(){

var formData = new FormData();

var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"
var userkey                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_session']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_session']) ? $upcoming_consultation_arr['patient_user_details']['dump_session'] : '' }}";
var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";

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
            var card_id                = "{{ isset($upcoming_consultation_arr['patient_user_details']['dump_id']) && !empty($upcoming_consultation_arr['patient_user_details']['dump_id']) ? $upcoming_consultation_arr['patient_user_details']['dump_id'] : '' }}"

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
                            url:"{{$module_url_path}}/past_consultation/update",
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

@endsection