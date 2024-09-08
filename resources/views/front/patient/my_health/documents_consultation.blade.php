@extends('front.patient.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align">My Health</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300  has-header has-footer">
        <div class="consultation-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_health/medical_history/general" class="redirect_medical"> <span><img src="{{ url('/') }}/public/new/images/medical-history.svg" alt="icon" class="tab-icon" /> </span> Medical History</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="redirect_documents active"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Documents</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_health/doctor_Activity" class="doctor_Activity"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Doctor Activity</a>
                </li>
            </ul>
        </div>

        <div class="container minhtnor">
            
            <div class="medi">
                <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="active redirect_consultation">Consultation</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/prescription" class="redirect_prescription">Prescription</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/medical_certificate" class="redirect_medical_certificate">Medical Certificate</a>
                    </li>
                </ul>
            
                <div class="clear"></div>

                <div id="consultation" class="tab-content">
                        <div class="pdrl">
                            <ul class="collection brdrtopsd marbt">

                                @if(isset($booking_document['data']) && !empty($booking_document['data']))
                                    @foreach($booking_document['data'] as $key => $book_data)
                                        
                                        @if(isset($book_data['document']) && !empty($book_data['document']) && File::exists($consultation_documents_public_url.$book_data['document']))

                                        @php
                                            $document_id = isset($book_data['id']) ? $book_data['id'] : '';

                                            $upload_date = isset($book_data['created_at']) && !empty($book_data['created_at']) ? date('d M Y', strtotime($book_data['created_at'])) : '';

                                            $user_title = isset($book_data['user_data']['title']) ? $book_data['user_data']['title'] : '';

                                            $user_first = isset($book_data['user_data']['first_name']) ? $book_data['user_data']['first_name'] : '';

                                            $user_last = isset($book_data['user_data']['last_name']) ? $book_data['user_data']['last_name'] : '';
                                        @endphp

                                            <li class="collection-item martb">
                                                <div class="row">
                                                    <div class="col l5 m5 s12">
                                                        <div class="valign-wrapper pres">
                                                            <img src="{{ url('/')}}/public/new/images/rx-certi.png" />
                                                            <a href="javascript:void(0);">
                                                                <p class="bluedoc-text"> CD{{ $document_id }} Document - {{ $upload_date }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col l4 m4 s8">
                                                       <div class="patient-name">{{ $user_title.' '.$user_first.' '.$user_last }}</div>
                                                    </div>
                                                    <div class="col l3 m3 s4 right actionnew">
                                                        <a class="doc_show_{{$key}}" class="circle btn-floating bluedoc-bg z-depth-1 right" title="Download" download><i class="material-icons">&#xE2C4;</i></a>
                                                        <a class="doc_show_{{$key}}" target="_blank" class="circle btn-floating bluedoc-bg z-depth-1 right"  title="View"><i class="material-icons">remove_red_eye</i></a>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- Decrypt Documents -->
                                            <script type="text/javascript">
                                             var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                                             var api           = virgil.API(virgilToken);
                                             
                                             var dumpSessionId = '{{isset($arr_user["dump_session"])?$arr_user["dump_session"]:""}}';
                                             var dumpId        = '{{isset($arr_user["dump_id"])?$arr_user["dump_id"]:""}}';
                                             if(dumpSessionId!='')
                                             {
                                                var image_file = '{{ $consultation_documents_base_url.$book_data["document"] }}';
                                                if(image_file!='')
                                                {
                                                    var image_file_filename      = '{{ $book_data["document"] }}';
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
                                    <div class="paginaton-block-main">
                                        {{ $bd_paginate }}
                                    </div>
                                @else
                                    <li class="collection-item martb">
                                        <div class="row">
                                            <p style="width: 100%; text-align: center;">No Document found</p>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                </div>

            </div>

        </div>
    </div>

    <!--Container End-->    

    <script>
        $(document).ready(function(){
            
            $('.redirect_medical').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/medical_history/general";
            });
            $('.redirect_documents').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/documents/consultation";
            });
            $('.doctor_Activity').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/doctor_Activity";
            });

            $('.redirect_consultation').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/documents/consultation";
            });
            $('.redirect_prescription').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/documents/prescription";
            });
            $('.redirect_medical_certificate').click(function(){
                window.location.href = "{{ url('/') }}/patient/my_health/documents/medical_certificate";
            });
        });
    </script>

@endsection