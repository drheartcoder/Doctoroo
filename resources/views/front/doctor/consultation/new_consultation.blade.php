@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align"></h1>
    </div>

    <!-- SideBar Section -->
	@include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_consultation_request">
                    <a href="#new_consultation" class="active"><span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span> New Consultation Request </a>
                </li>
                <li class="tab" id="tab_upcoming_consultation">
                    <a href="#upcoming_consultation"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span> Upcoming Consultations</a>
                </li>
                <li class="tab" id="tab_past_consultation">
                    <a href="#consultation-history"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span>Past Consultations</a>
                </li>
                <li class="tab" id="tab_declined_consultation">
                    <a href="#decline_consultation"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon" /> </span>Declined Consultations</a>
                </li>                
            </ul>
        </div>

        <div id="new_consultation" class="tab-content medi patient-list-block">
            <div class="patient-list-heading">                
                <span class="patient-list-title">
                    New Consultation Request
                </span>
            </div>
            
            <div class="z-depth-3 round-box">
            <div class="blue-border-block-top"></div>
            <div class="transactions-table table-responsive paitent-list-table">
                <div class="table consultation_lists" id="">
                    
                    <div class="table-row  hidden-xs">
                        <div class="no-data" style="color: #184059;">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span> 
                        </div>
                    </div> 

                        <!-- @if(isset($arr_booking['data']) && !empty($arr_booking['data']))
                            <div class="table-row heading hidden-xs">
                                <div class="table-cell">Patient's Name</div>
                                <div class="table-cell">Consultation Time</div>
                                <div class="table-cell">Type</div>
                                <div class="table-cell">Status</div>
                                <div class="table-cell center-align">Consultation Details</div>                        
                            </div>

                            @foreach($arr_booking['data'] as $booking_data)

                                @php
                                if($booking_data['familiy_member_info'] == null)
                                {
                                    $pat_title      = isset($booking_data['patient_user_details']['title'])?$booking_data['patient_user_details']['title']:'';
                                    $pat_first_name = isset($booking_data['patient_user_details']['first_name'])?$booking_data['patient_user_details']['first_name']:'';
                                    $pat_last_name  = isset($booking_data['patient_user_details']['last_name'])?$booking_data['patient_user_details']['last_name']:'';
                                }
                                else
                                {
                                    $pat_title      = "";
                                    $pat_first_name = isset($booking_data['familiy_member_info']['first_name'])?$booking_data['familiy_member_info']['first_name']:'';
                                    $pat_last_name  = isset($booking_data['familiy_member_info']['last_name'])?$booking_data['familiy_member_info']['last_name']:'';
                                }

                                // check listisng image
                                if($booking_data['familiy_member_info'] == null)
                                {
                                    if ( isset($booking_data['patient_user_details']['profile_image']) && !empty($booking_data['patient_user_details']['profile_image']) )
                                    {
                                        $profile_images = $profile_img_path.$booking_data['patient_user_details']['profile_image'];
                                        // check if image exists or not
                                        if ( File::exists($profile_images) ) 
                                        {
                                            $profile_images = $profile_img_path."default-image.jpeg";
                                        } // end if
                                    } // end if
                                    else
                                    {
                                        $profile_images = $profile_img_path."default-image.jpeg";
                                    } // end else
                                 } 
                                 else
                                    {
                                        $profile_images = $profile_img_path."default-image.jpeg";
                                    }  
                                @endphp

                                <div class="table-row content-row-table">
                                    <div class="table-cell transaction-id">
                                        <span class="patient-profile-pic">
                                            <img src="{{ $profile_images }}" alt="" />
                                            @if($booking_data['patient_user_details']['is_online'] == 1)
                                                <span class="onlinenew"></span>
                                            @else
                                                <span class="online"></span>
                                            @endif
                                        </span>
                                        <span class="patient-name-block">{{ $pat_title.' '.$pat_first_name.' '.$pat_last_name }}</span>
                                    </div>
                                    <div class="table-cell transaction-date">{{ date("h:i a D, M d Y", strtotime($booking_data['consultation_datetime'])) }}</div>
                                    <div class="table-cell transaction-price">Doctoroo</div>
                                    <div class="table-cell transaction-desciption"><span class="description">{{ $booking_data['booking_status'] }}</span></div>
                                    <div class="table-cell transaction-status view-details-btn"><a href="{{ url('/') }}/doctor/consultation/new_consultation_request_details/{{ base64_encode($booking_data['id']) }}">View details</a></div>
                                </div>
                            @endforeach
                        @else
                            <div class="table-row  hidden-xs">
                                <div class="no-data" style="color: #184059;">
                                    No Request for Now
                                </div>
                            </div>
                        @endif -->

                    </div>

                   <div class="paginaton-block-main"> {{ $paginate }} </div>
                </div>
                <div class="blue-border-block-bottom"></div>
            </div>
        </div>

    </div>

    <input type="hidden" class="offer_msg" id="offer_msg" name="offer_msg" value="{{ Session::get('offer_msg') }}" />
    <a class="open_offer_msg_popup" href="#show_offer_msg"></a>
    <div id="show_offer_msg" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p>{{ Session::get('offer_msg') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align full-width-btn">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
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
                       var status  = "Pending";
                      
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
        var url ="<?php echo $module_url_path; ?>";
        $(document).ready(function(){
            
            var offer_msg = $('#offer_msg').val();
            if(offer_msg != '')
            {
                $(".open_offer_msg_popup").click();
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
        });
    </script>

@endsection