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
    <div id="consultation-history" class="tab-content medi patient-list-block">

        <div class="patient-list-heading">
            <span class="patient-list-title">
                    Past Consultation
                </span>
        </div>
        <div class="z-depth-3 round-box">
            <div class="blue-border-block-top"></div>
            <div class="transactions-table table-responsive paitent-list-table">
                <!--div format starts here-->
                <div class="table consultation_lists" id="">
                    

                    <div class="table-row  hidden-xs">
                            <div class="no-data" style="color: #184059;">
                                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                                <span class="sr-only">Loading...</span> 
                            </div>
                    </div> 
                    <?php /*
                    @if($past_consultation_arr['data'])
                        <div class="table-row heading hidden-xs">
                            <div class="table-cell">Patient's Name</div>
                            <div class="table-cell">Consultation Time</div>
                            <div class="table-cell">Type</div>
                            <div class="table-cell">Status</div>
                            <div class="table-cell center-align">Consultation Details</div>
                        </div>
                        @foreach($past_consultation_arr['data'] as $val)
                            <div class="table-row content-row-table">
                                <div class="table-cell transaction-id">
                                    <span class="patient-profile-pic">
                                    <?php 
                                    $src="";
                                    if($val['familiy_member_info'] == null)
                                    {
                                     if(isset($val['patient_user_details']['profile_image']) && File::exists($profile_img_base_path.$val['patient_user_details']['profile_image']))
                                        {
                                           $src = $profile_img_public_path.$val['patient_user_details']['profile_image'];
                                        }
                                        else
                                        {
                                          $src = $profile_img_public_path.'default-image.jpeg';
                                        }
                                    }
                                    else
                                        {
                                          $src = $profile_img_public_path.'default-image.jpeg';
                                        }
                                    ?>
                                        <img src="{{$src}}" alt="" />
                                        @if($val['patient_user_details']['is_online'] == 1)
                                            <span class="onlinenew"></span>
                                        @else
                                            <span class="online"></span>
                                        @endif
                                    </span>
                                    <span class="patient-name-block">
                                        @if($val['familiy_member_info'] == null)
                                            {{isset($val['patient_user_details']['title']) ? $val['patient_user_details']['title'] : ''}}
                                            {{isset($val['patient_user_details']['first_name']) ? $val['patient_user_details']['first_name'] : ''}} {{isset($val['patient_user_details']['last_name']) ? $val['patient_user_details']['last_name'] : ''}}
                                            
                                        @elseif(isset($val['familiy_member_info']) && !empty($val['familiy_member_info']))
                                            {{isset($val['familiy_member_info']['first_name']) ? $val['familiy_member_info']['first_name'] : ''}} {{isset($val['familiy_member_info']['last_name']) ? $val['familiy_member_info']['last_name'] : ''}}
                                        @endif
                                    </span>
                                </div>
                                <div class="table-cell transaction-date">{{isset($val['consultation_datetime']) ? date("h:i a D, M d Y", strtotime($val['consultation_datetime'])) : ' '}}
                                </div>
                                <div class="table-cell transaction-price">
                                    Doctoroo
                                </div>
                                <div class="table-cell transaction-desciption">
                                    <span class="description">
                                        {{isset($val['booking_status']) ? $val['booking_status'] : 'Not found'}}
                                    </span>
                                </div>
                                <div class="table-cell transaction-status view-details-btn">
                                    <a href="{{$module_url_path}}/past_consultation_details/{{ base64_encode($val['id']) }}">View details</a>
                                </div>
                            </div>
                        @endforeach
                    @endif 
                    @if(sizeof($past_consultation_arr['data'])==0)
                        <div class="table-row  hidden-xs">
                                    <div class="no-data" style="color: #184059;">
                                        No data found
                                    </div>
                            </div>
                    @endif

                    */ ?>
                </div>
                <div class="paginaton-block-main"> {{ $paginate }} </div>
            </div>
            <div class="blue-border-block-bottom"></div>
        </div>
    </div>
</div>
<!-- Ajax Functionality -->
<input type="hidden" name="consultation_request_with_ajax" id="consultation_request_with_ajax" value="0">
<script type="text/javascript">
        $(document).ready(function(){
               setTimeout(function(){ new_consultation_request_with_ajax(); }, 0);
               setInterval(function(){ new_consultation_request_with_ajax(); }, 300);
        });
        function new_consultation_request_with_ajax(){
            
            var current_consultation_request_with_ajax = $('#consultation_request_with_ajax').val(); 
                if(current_consultation_request_with_ajax == 0){ 
                   <?php $page = Request::get('page'); if($page == ''){ $page = 1; } ?>
                   var page    = '{{$page}}'; 
                   var token   = "{{ csrf_token() }}";
                   var status   = "Completed";
                  
                   $.ajax({
                        url   : "{{ url('/') }}/doctor/consultation/consultation_request_with_ajax",
                        type  : "POST",
                        data: {page:page,_token:token,status:status},
                        success : function(res){
                            $('.consultation_lists').html(res);
                        }
                   });
                }  
            if(current_consultation_request_with_ajax == 0){ $('#consultation_request_with_ajax').val('5'); }
            else{  var new_consultation_request_with_ajax     = parseInt(current_consultation_request_with_ajax) - parseInt(1);
                $('#consultation_request_with_ajax').val(new_consultation_request_with_ajax);
            }    
        }
        $(document).mouseover(function(e) {
            $('#consultation_request_with_ajax').val('5');
        });
        $(document).keyup(function(e) {
            $('#consultation_request_with_ajax').val('5');
        });
</script>
<!-- End Ajax Functionality -->
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
    });
</script>

@endsection