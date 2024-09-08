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
                    <a href="{{ url('/') }}/patient/my_health/documents/consultation" id="tab_test3" class="redirect_documents "> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Documents</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_health/doctor_Activity" class="doctor_Activity active"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Doctor Activity</a>
                </li>
            </ul>
        </div>
        <div class="container minhtnor">
            <div id="document" class="tab-content">
                    <div class="pdrl">
                        <ul class="collection brdrtopsd marbt">
                            @if(isset($arr_doctor_activity['data']) && !empty($arr_doctor_activity['data']))
                                @foreach($arr_doctor_activity['data'] as $doct_act)
                                        <?php $get_doctor = \DB::table('users')->select('first_name','last_name')->where('id' , $doct_act->doctor_id)->first(); ?>
                                        <li class="collection-item martb">
                                            <div class="row">
                                                <div class="col l1 m1 s4 left " style="margin-top: 7px;">
                                                    <span class="circle btn-floating red center-align large">{{substr($get_doctor->first_name,0,1)}}{{substr($get_doctor->last_name,0,1)}}</span>
                                                </div> 
                                                <div class="col l8 m4 s8">
                                                       <div class="patient-name" style="text-align:justify;">
                                                        {{'Dr. '.$get_doctor->first_name}} {{$get_doctor->last_name}} {{$doct_act->action}}
                                                      </div>
                                                </div>
                                                <div class="col l3 m3 s4 right actionnew">
                                                       <?php echo  date('F j, Y', strtotime($doct_act->created_at))." at ".date("g:i a", strtotime($doct_act->created_at)); ?>
                                                </div>
                                            </div>
                                        </li> 
                                @endforeach
                                <div class="paginaton-block-main">
                                    <div class=""> {{$obj_pagination->links()}} </div>     
                                    <div class="clearfix"></div>
                                </div>
                            @else
                                <li class="collection-item martb">
                                    <div class="row">
                                        <p style="width: 100%; text-align: center;">No Doctor Activity found</p>
                                    </div>
                                </li>
                            @endif
                        </ul>
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
            
        });
    </script>

@endsection