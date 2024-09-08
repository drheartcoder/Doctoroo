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
                    <a href="{{ url('/') }}/patient/my_health/medical_history" id="tab_test2" class="redirect_medical active"> <span><img src="{{ url('/') }}/public/new/images/medical-history.svg" alt="icon" class="tab-icon" /> </span> Medical History</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="redirect_documents"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Documents</a>
                </li>
            </ul>
        </div>
        <div class="container minhtnor">

            <div id="history" class="tab-content medicationmain">

                <div class="form">
                    <div class="beforecomplete">
                        <p class="green-text">Your medical history is important for doctors to diagnose and treat you.</p>
                        <p class="bluedoc-text mr50">You can complete it: </p>
                        <ul>
                            <li class="bluedoc-text"> Before your first consultation (takes 2-3 minutes) </li>
                            <li class="bluedoc-text">During your first consultation (may be longer &amp; cost more)</li>
                        </ul>
                    </div>
                    <div>
                        <p class="green-text nospc">There are 3 steps. select "General" to begin.</p>

                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner conditions"
                             href="{{ url('/') }}/patient/my_health/medical_history/1">
                            <span class="left valign-wrapper truncate wid80">
                                <img src="{{ url('/')}}/public/new/images/general.svg" alt="icon" class="tab-icon" />  GENERAL
                            </span>
                            <i class="material-icons right">chevron_right</i>
                        </a>
                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner conditions"
                             href="{{ url('/') }}/patient/my_health/medical_history/2">
                            <span class="left valign-wrapper truncate wid80">
                                <img src="{{ url('/')}}/public/new/images/medication-icon-his.svg" alt="icon" class="tab-icon" /> MEDICATION
                            </span>
                            <i class="material-icons right">chevron_right</i>
                        </a>
                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner conditions"
                            href="{{ url('/') }}/patient/my_health/medical_history/3">
                            <span class="left valign-wrapper truncate wid80">
                                <img src="{{ url('/')}}/public/new/images/lifestyle-icon.svg" alt="icon" class="tab-icon" />  LIFESTYLE
                            </span>
                            <i class="material-icons right">chevron_right</i>
                        </a>
                    </div>

                </div>

            </div>

            <!--Container End-->
        </div>

    </div>

<script>
var url="<?php echo  url('/'); ?>/patient/my_health/condition";

    $(document).ready(function(){
        $('.redirect_medical').click(function(){
            window.location.href = "{{ url('/') }}/patient/my_health/medical_history";
        });
        $('.redirect_documents').click(function(){
            window.location.href = "{{ url('/') }}/patient/my_health/documents/consultation";
        });
    });
</script>

@endsection