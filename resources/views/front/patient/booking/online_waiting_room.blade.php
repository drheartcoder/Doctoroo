@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow "><a href="{{ url('/') }}/patient/booking/search_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align onlinehead">Online Waiting Room</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.layout._sidebar')

    @php
        $doc_title      = isset($doctor_details['userinfo']['title'])?$doctor_details['userinfo']['title']:'';
        $doc_first_name = isset($doctor_details['userinfo']['first_name'])?$doctor_details['userinfo']['first_name']:'';
        $doc_last_name  = isset($doctor_details['userinfo']['last_name'])?$doctor_details['userinfo']['last_name']:'';
    @endphp

    <div class="mar300   has-header has-footer">
        <input type="hidden" value="{{Session::get('message')}}" id="request_status">
        @if(Session::has('message'))
            @php  Session::forget('message') @endphp
        @endif

        <div class="online-consultid center-align">Consultation ID : {{ isset($consultation_data['consultation_id'])?$consultation_data['consultation_id']:'' }}</div>
        <div class="container">
            <div class="online-room-details ">
                <div class="clock">
                    <div class="valign-wrapper row">
                        <div class="col l2 s2 m2"></div>
                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/clockbig.png" class="timeicn"></div>
                        <div class="col l8 s7 m8 consult">Time until Consultation
                            <div id="get_countdown">{{ isset($diff_time)?$diff_time:'' }}</div>
                        </div>
                    </div>
                </div>
                @php 
                    $cancel_booking = "";
                    $booking_details_url = "";
                @endphp
                @if(isset($booking_status) && !empty($booking_status))
                    <ul class="collapsible" data-collapsible="accordion">
                        @foreach($booking_status as $status_data)
                            <li class="schedule">
                                <div class="valign-wrapper row collapsible-header">
                                   
                                    <?php
                                        $status_created_time = isset($status_data['created_at'])?$status_data['created_at']:'';
                                        $status_datetime = convert_utc_to_userdatetime($patient_id, "patient", $status_created_time);
                                    ?>

                                    @if($status_data['status'] == 'Pending')
                                        <?php $get_avl_doc_data = \DB::table('users')->where('id',$doctor_details['userinfo']['id'])->first(); 
                                            if(isset($get_avl_doc_data->dump_id) && $get_avl_doc_data->dump_id != ""){ $avl_dump_id = $get_avl_doc_data->dump_id; } else { $avl_dump_id = ""; }
                                            if(isset($get_avl_doc_data->dump_session) && $get_avl_doc_data->dump_session != ""){ $avl_dump_session = $get_avl_doc_data->dump_session; } else { $avl_dump_session = ""; }
                                        ?>
                                        @php
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url("/").'/patient/booking/booking_request_confirmation/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                        <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">
                                            Consultation with <span class="doc_name<?php echo $doctor_details['userinfo']['id']; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span> requested <i class="material-icons absright">keyboard_arrow_down</i></div>

                                    @elseif($status_data['status'] == 'Cancelled')
                                        @php
                                            $cancel_booking = "display:none";
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url("/").'/patient/booking/consultation_details/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                        <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">Request Cancelled by
                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] == $current_login_user ? 'You' : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['title']) ? $status_data['userinfo']['title'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['first_name']) ? $status_data['userinfo']['first_name'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['last_name']) ? $status_data['userinfo']['last_name'] : '' }}
                                        <i class="material-icons absright">keyboard_arrow_down</i></div>
                                        <input type="hidden" id="cancel_status" value="Yes">

                                    @elseif($status_data['status'] == 'Rescheduled')
                                        @php
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url("/").'/patient/booking/consultation_details/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                            <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">Consultation Rescheduled request by
                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] == $current_login_user ? 'You' : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['title']) ? $status_data['userinfo']['title'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['first_name']) ? $status_data['userinfo']['first_name'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['last_name']) ? $status_data['userinfo']['last_name'] : '' }}
                                        <i class="material-icons absright">keyboard_arrow_down</i>
                                        </div>

                                    @elseif($status_data['status'] == 'Confirmed')
                                        @php
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url("/").'/patient/booking/confirm_booking/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                        <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">Request Confirmed by
                                            {{isset($status_data['userinfo']['id'])  && isset($status_data['userinfo']['title']) ? $status_data['userinfo']['title'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && isset($status_data['userinfo']['first_name']) ? $status_data['userinfo']['first_name'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['last_name']) ? $status_data['userinfo']['last_name'] : '' }}
                                            <i class="material-icons absright">keyboard_arrow_down</i>
                                        </div>

                                    @elseif($status_data['status'] == 'Declined')
                                        @php 
                                            $cancel_booking ="display:none";
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url("/").'/patient/booking/consultation_details/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                        <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">
                                            Request Declined by
                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] == $current_login_user ? 'You' : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['title']) ? $status_data['userinfo']['title'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['first_name']) ? $status_data['userinfo']['first_name'] : '' }}

                                            {{isset($status_data['userinfo']['id']) && $status_data['userinfo']['id'] != $current_login_user && isset($status_data['userinfo']['last_name']) ? $status_data['userinfo']['last_name'] : '' }}
                                            <i class="material-icons absright">keyboard_arrow_down</i>
                                        </div>

                                    @elseif($status_data['status'] == 'Completed')
                                        @php 
                                            $created_time = isset($consultation_data['created_at'])?$consultation_data['created_at']:'';
                                            $booking_details_url = url('/').'/patient/booking/consultation_details/'.$enc_booking_id;
                                        @endphp
                                        <div class="col l2 s2 m2 time">{{ date("h:i a", strtotime($status_datetime)) }}
                                        <small>{{ date("D, d M", strtotime($status_datetime)) }}</small>
                                        </div>

                                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/confirm-icon-0.png" class="timeicn"></div>
                                        <div class="col l8 s7 m8 info">
                                            Consultation completed
                                            <i class="material-icons absright">keyboard_arrow_down</i>
                                        </div>    
                                    @endif

                                </div>
                                <div class="valign-wrapper row collapsible-body">
                                    <div class="col l2 s2 m2"></div>
                                    <div class="col l8 s8 m9 left-align">
                                        <div class="details white z-depth-4">
                                            <h3>You can rebook another or time below</h3>
                                            <div class="acti"><a href="{{ $booking_details_url }}" class="greyBtn">View Details</a>
                                                <a href="{{ url('/') }}/patient/chat/messages/{{ base64_encode($consultation_data['doctor_user_id']) }}" class="greyBtn">Chat</a></div>
                                        </div>
                                    </div>
                                    <div class="col l2 s2 m2"></div>
                                </div>
                            </li>
                        @endforeach
                        <div class="schedule"></div>
                    </ul>
                @endif

                <div class="timeremain">
                    <div class="valign-wrapper row">
                        <div class="col l2 s2 m2"></div>
                        <div class="col l2 s3 m2 center-align imgmain"><img src="{{ url('/') }}/public/new/images/finalblt.png"></div>
                        <div class="col l8 s7 m8 info"></div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="center">

                    <a href="#reschedule" id="btn_reschedule" class="greyBtn" style="{{$cancel_booking}}">Reschedule Booking</a>
                    <a href="#reschedule_within_1hr" id="btn_reschedule_within_1hr" class="greyBtn" style="display: none;">Reschedule Booking</a>
                    <a href="{{ url('/') }}/patient/my_health/medical_history/1" class="greyBtn">Complete Medical History</a>
                    <a href="#cancel-consult" class="greyBtn" style="{{$cancel_booking}}">Cancel Booking</a>
                </div>

            </div>
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ url('/') }}/patient/dashboard">close</a>

        <input type="hidden" id="current_datetime" name="current_datetime" value="{{ $current_datetime }}">
        <input type="hidden" id="consultation_datetime" name="consultation_datetime" value="{{ date('M d, Y H:i:s', strtotime($consultation_datetime)) }}">
    </div>

    @php $enc_id = isset($status_data['booking_id']) ? base64_encode($status_data['booking_id']) : ''; @endphp
    
    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4 class="center-align">Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p id="cancel_statement"></p>
        <p class="view-policy"><a href="#cancellation_refunds" data-toggle="modal" > View refund policy</a></p>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#cancel-reason" class="modal-action  modal-close waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    
    <!-- Modal Structure End -->
    <!-- Modal reason for cancellation -->
    <div id="cancel-reason" class="modal requestbooking">
        <div class="modal-content bigcancelhead">
            <h4>Please let us know why, because we care.</h4>
        </div>
        <form method="POST" action="{{ url('/') }}/patient/booking/cancel_consultation/{{ $enc_id }}">
        {{ csrf_field() }}
        <div class="modal-data doctorForm">
            <div class="input-field col s12 radio">
                <p>
                    <input class="rad_cancel_reason" name="booking_cancel_reason" type="radio" value="No longer need a Doctor" id="no_longer_need_a_doctor" checked />
                    <label for="no_longer_need_a_doctor">No Longer need a doctor</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input class="rad_cancel_reason" name="booking_cancel_reason" type="radio" value="Doctor didn't respond" id="doctor_didnt_respond" />
                    <label for="doctor_didnt_respond">Doctor didn't respond</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input class="rad_cancel_reason" name="booking_cancel_reason" type="radio" value="Doctor declined my booking" id="doctor_declined_my_booking" />
                    <label for="doctor_declined_my_booking">Doctor declined my booking</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input class="rad_cancel_reason" name="booking_cancel_reason" type="radio" value="Other" id="other" />
                    <label for="other">Other</label>
                </p>
                <p id="other_reason" style="display: none;">
                    <input type="text" id="other_reason_txt" name="other_reason" class="validate" placeholder="Other reasons">
                    <div class="err" id="err_other_reason" style="display:none;"></div>
                </p>
                <div class="err" id="err_cancel_reason" style="display:none;"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <button type="submit" id="btn_cancel" name="btn_cancel" class="modal-action right search-btn waves-green btn-cancel-cons">Cancel Booking</button>
        </div>
        </form>
    </div>
     <!-- Modal reason for cancellation ends-->
    
    <!-- Modal Reschedule -->
    <div id="reschedule" class="modal requestbooking fade" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none;">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <div class="modal-content">
            <p>Are you sure you want to reschedule this consultation?</p>
            <p></p>
            <p class="view-policy"><a href="#cancellation_refunds" data-toggle="modal" > View refund policy</a></p>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="{{ url('/') }}/patient/booking/reschedule_consultation/{{ $enc_id }}" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>

    <!-- Modal Reschedule -->
    <div id="reschedule_within_1hr" class="modal requestbooking fade" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none;">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <div class="modal-content">
            <p>Are you sure you want to reschedule this consultation?</p>
            <p></p>
            <p class="view-policy"><a href="#cancellation_refunds" data-toggle="modal" > View refund policy</a></p>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="{{ url('/') }}/patient/booking/reschedule_within_1hr_consultation/{{ $enc_id }}" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>

    <a class="open_popups" href="#show_flash_msgs" style="display: none;"></a>
    <div id="show_flash_msgs" class="modal requestbooking" style="display: none;">
        <div class="modal-data">
          <a class="modal-close closeicon">
            <i class="material-icons">close</i>
          </a>
          <div class="row">
            <div class="col s12 l12 center-align" id="status_display">
              
            </div>
          </div>
        </div>
        <div class="modal-footer center-align ">
          <a href="" class="modal-close waves-effect waves-green btn-cancel-cons">OK
          </a>
        </div>
    </div>
    <!-- Modal Reschedule End -->

    <!--popup include -->
    @include('front.patient.booking.pricing_details')
    @include('front.patient.booking.cancellation_refunds')

<script src="{{ url('/') }}/public/new/js/moment.js"></script>
<script src="{{ url('/') }}/public/new/js/moment-with-locales.js"></script>
<script>
    $(document).ready(function(){
        
        var request_status = $('#request_status').val();
        if(request_status != '')
        {
            $(".open_popups").click();
            $('#status_display').html($('#request_status').val());
        }

        var cancel_status = $('#cancel_status').val();
        if(cancel_status == 'Yes')
        {
            $('#get_countdown').html("Consultation Cancel");
        }
        else
        {
            //check_time();
            get_remaining_time();
        }


        // if other option is selected then show textbox for other reasons
        $('#other').click(function(){ 
            $("#other_reason").show();
        });
        $('#no_longer_need_a_doctor, #doctor_didnt_respond, #doctor_declined_my_booking').click(function(){ 
            $("#other_reason").hide();
        });

        $('#btn_cancel').click(function(){
            var rad_cancel_reason       = $(".rad_cancel_reason:checked").length;
            var other                   = $("#other").is(":checked");
            var other_reason            = $('#other_reason_txt').val();

            if(rad_cancel_reason == 0)
            {
                $('#err_cancel_reason').show();
                $('#err_cancel_reason').html('Please select atleast 1 option');
                $('#err_cancel_reason').fadeOut(8000);
                return false;
            }
            if(other == true)
            {
                if(other_reason == '')
                {
                    $('#err_other_reason').show();
                    $('#err_other_reason').html('Please enter other reason');
                    $('#err_other_reason').fadeOut(8000);
                    return false;
                }
            }
            else
            {
                return true;
            }
        });
    });

    function check_time(current_datetime, consultation_datetime)
    {
       var user_sel_timezone = "{{config('app.timezone')}}";

       var dateTime =  new Date().toLocaleString('en-US', { timeZone: user_sel_timezone });
       dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
        
        var current_datetime        = dateTime;
        var consultation_datetime   = $('#consultation_datetime').val();

        if(current_datetime >= consultation_datetime){
         $('#get_countdown').html('Time has Past');
        }
        else{

            var token = $('input[name="_token"]').val();
            $.ajax({
                url   : "{{ url('/') }}/patient/booking/difference_bet_time/"+current_datetime+'/'+consultation_datetime,
                type : "GET",
                data: {},
                success : function(res){
                    $('#get_countdown').html(res);
                    setTimeout(function(){
                       check_time();
                    },2000);
                }
            });
        }  
    }

    function get_remaining_time()
    {
        var user_sel_timezone = "{{config('app.timezone')}}";

        // Set the date we're counting down to
        var given_time = $('#consultation_datetime').val();
        var countDownDate = new Date(given_time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var aus = new Date().toLocaleString('en-US', { timeZone: user_sel_timezone });
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

            // hide reschedule btn before 1 hr of booking
            if(days + hours < 1)
            {
                $('#btn_reschedule').css('display', 'none');
                $('#btn_reschedule_within_1hr').css('display', 'inline-block');
                $('#cancel_statement').html("You won't be refunded the booking fee.");
            }
            else
            {
                $('#cancel_statement').html("You will be refunded the booking fee.");
            }
            
            // Output the result in an element with id="demo"
            document.getElementById("get_countdown").innerHTML = days + hours + minutes + seconds + ' secs';
            
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("get_countdown").innerHTML = "Time Expired";
            }
        }, 1000);
    }
</script>

@endsection