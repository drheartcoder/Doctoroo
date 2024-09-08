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
                    <a href="{{ url('/') }}/patient/my_health/documents/consultation" id="tab_test3" class="redirect_documents active"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Documents</a>
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
                        <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="redirect_consultation">Consultation</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/prescription" class="active redirect_prescription">Prescription</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/medical_certificate" class="redirect_medical_certificate">Medical Certificate</a>
                    </li>
                </ul>
            
                <div class="clear"></div>
                <div id="prescription" class="tab-content">
                        <div class="pdrl">
                            <ul class="collection brdrtopsd marbt">
                                @if(isset($prescription_data['data']) && !empty($prescription_data['data']))
                                    @foreach($prescription_data['data'] as $key => $pre_data)
                                        
                                        @if(isset($pre_data['uploaded_file']) && !empty($pre_data['uploaded_file']) && File::exists($prescription_img_base_path.$pre_data['uploaded_file']))

                                        @php
                                            $pre_id = isset($pre_data['id']) ? $pre_data['id'] : '';

                                            $upload_date = isset($pre_data['file_added_on']) && !empty($pre_data['file_added_on']) ? date('d M Y', strtotime($pre_data['file_added_on'])) : '';

                                            $user_title = isset($pre_data['userinfo']['title']) ? $pre_data['userinfo']['title'] : '';
                                            
                                            if($user_title=='')
                                            {
                                                $user_title = isset($pre_data['doctor_details']['title']) ? $pre_data['doctor_details']['title'] : '';
                                            }

                                            $user_first = isset($pre_data['userinfo']['first_name']) ? $pre_data['userinfo']['first_name'] : '';

                                            if($user_first=='')
                                            {
                                                $user_first = isset($pre_data['doctor_details']['first_name']) ? $pre_data['doctor_details']['first_name'] : '';
                                            }

                                            $user_last = isset($pre_data['userinfo']['last_name']) ? $pre_data['userinfo']['last_name'] : '';

                                            if($user_last=='')
                                            {
                                                $user_last = isset($pre_data['doctor_details']['last_name']) ? $pre_data['doctor_details']['last_name'] : '';
                                            }

                                        @endphp

                                            <li class="collection-item martb">
                                                <div class="row">
                                                    <div class="col l5 m5 s12">
                                                        <div class="valign-wrapper pres">
                                                            <img src="{{ url('/')}}/public/new/images/rx-certi.png" />
                                                            <a href="javascript:void(0);">
                                                                <p class="bluedoc-text"> PP{{ $pre_id }} Prescription - {{ $upload_date }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col l4 m4 s8">
                                                       <div class="patient-name">{{ $user_title.' '.$user_first.' '.$user_last }}</div>
                                                    </div>
                                                    <div class="col l3 m3 s4 right actionnew">
                                                        <a class="circle btn-floating bluedoc-bg z-depth-1 right doc_show_{{$key}}" title="Downlad" download><i class="material-icons white-color">&#xE2C4;</i></a>
                                                        <a target="_blank" class="circle btn-floating bluedoc-bg z-depth-1 right doc_show_{{$key}}" title="View"><i class="material-icons white-color">remove_red_eye</i></a>
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
                                                var image_file = '{{ $prescription_img_public_path.$pre_data["uploaded_file"] }}';
                                                if(image_file!='')
                                                {
                                                    var image_file_filename      = '{{ $pre_data["uploaded_file"] }}';
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
                                        {{ $pp_paginate }}
                                    </div>
                                @else
                                    <li class="collection-item martb">
                                        <div class="row">
                                            <p style="width: 100%; text-align: center;">No Prescription found</p>
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