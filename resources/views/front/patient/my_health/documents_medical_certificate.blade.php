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
                        <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="redirect_consultation">Consultation</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/prescription" class="redirect_prescription">Prescription</a>
                    </li>
                    <li class="tab truncate">
                        <a href="{{ url('/') }}/patient/my_health/documents/medical_certificate" class="active redirect_medical_certificate">Medical Certificate</a>
                    </li>
                </ul>
            
                <div class="clear"></div>

                <div id="consultation" class="tab-content">
                        <div class="pdrl">
                            <ul class="collection brdrtopsd marbt">

                                @if(isset($certificate_data['data']) && !empty($certificate_data['data']))
                                    @foreach($certificate_data['data'] as $cert_data)
                                        @php
                                            $document_id = isset($cert_data['id']) ? $cert_data['id'] : '';

                                            $upload_date = isset($cert_data['created_at']) && !empty($cert_data['created_at']) ? date('d M Y', strtotime($cert_data['created_at'])) : '';

                                            $user_title = isset($cert_data['user_data']['title']) ? $cert_data['user_data']['title'] : '';

                                            $user_first = isset($cert_data['user_data']['first_name']) ? $cert_data['user_data']['first_name'] : '';

                                            $user_last = isset($cert_data['user_data']['last_name']) ? $cert_data['user_data']['last_name'] : '';
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
                                                        <a onclick="generate_pdf('{{ base64_encode($cert_data['id']) }}',this,'download')" href="javascript:void(0)" target="_blank" class="circle btn-floating bluedoc-bg z-depth-1 right" data-dumpid="{{isset($cert_data['userinfo']['dump_id']) ? $cert_data['userinfo']['dump_id'] : ''}}" data-dumpsessionid="{{isset($cert_data['userinfo']['dump_session']) ? $cert_data['userinfo']['dump_session'] : ''}}" title="Download"><i class="material-icons">&#xE2C4;</i></a>

                                                        <a onclick="generate_pdf('{{ base64_encode($cert_data['id']) }}',this,'view')" href="javascript:void(0)" class="circle btn-floating bluedoc-bg z-depth-1 right" data-dumpid="{{isset($cert_data['userinfo']['dump_id']) ? $cert_data['userinfo']['dump_id'] : ''}}" data-dumpsessionid="{{isset($cert_data['userinfo']['dump_session']) ? $cert_data['userinfo']['dump_session'] : ''}}" title="View"><i class="material-icons">remove_red_eye</i></a>
                                                    </div>
                                                </div>
                                            </li>

                                    @endforeach
                                    <div class="paginaton-block-main">
                                        {{ $mc_paginate }}
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


        function generate_pdf(id,evt,type)
        {
            var dump_id      = $(evt).attr('data-dumpid');
            var dump_session = $(evt).attr('data-dumpsessionid');

            var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
            var api          = virgil.API(VIRGIL_TOKEN);
            var key          = api.keys.import(dump_session);            
            var _token       = '{{csrf_token()}}';
            
            $.ajax({
               url:'{{ url("/") }}/patient/my_health/documents/medical_certificate/download/'+id,
               type:'get',
               success:function(response){
                  if(response!='')
                  {
                    if(response.doctor_data.contact_no != "")
                    {
                        var dec_contact_no = key.decrypt(response.doctor_data.contact_no).toString();
                        response.doctor_data.dec_contact_no = dec_contact_no;
                    }

                    if(response.doctor_data.address != "")
                    {
                        var dec_address = key.decrypt(response.doctor_data.address).toString();
                        response.doctor_data.dec_address = dec_address;
                    }
                    if(response.doctor_data.medicare_provider_no != "")
                    {
                        var dec_medicare_provider_no = key.decrypt(response.doctor_data.medicare_provider_no).toString();
                        response.doctor_data.dec_medicare_provider_no = dec_medicare_provider_no;
                    }
                    response.type = type;
                        $.ajax({
                           url:'{{ url("/") }}/patient/my_health/documents/generate_medical_certificate_pdf',
                           type:'post',
                           data:{'arr_data' : response,'_token' : _token},
                           success:function(res){
                                pdf_url = '{{ url("/") }}/patient/my_health/documents/generate_medical_certificate_pdf';
                                window.open(pdf_url, '_blank');
                           }
                        });
                  }   
               }

            });        
        }

        </script>



@endsection