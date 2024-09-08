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
                <a href="#upcoming_consultation" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span> Upcoming Consultations</a>
            </li>
            <li class="tab" id="tab_past_consultation">
                <a href="#consultation-history"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon"/> </span>Past Consultations</a>
            </li>
            <li class="tab" id="tab_declined_consultation">
                <a href="#decline_consultation"> <span><img src="{{url('/')}}/public/doctor_section/images/patient-consultation.svg" alt="icon" class="tab-icon" /> </span>Declined Consultations</a>
            </li>
        </ul>
    </div>
    
    <div id="upcoming_consultation" class="tab-content medi patient-list-block">
        <div class="patient-list-heading">
            <span class="patient-list-title">
                    Available Time
            </span>
        </div>
        <div class="z-depth-3 round-box available-time-doctor">
            <div class="blue-border-block-top"></div>
            <div class="transactions-table table-responsive paitent-list-table">

                <div class="data-content">
                    <div class="date-ro center-align">
                        <h3>Choose a day</h3>
                        <div class="dayChange  center-align">
                            <div class="valign-wrapper calendar">
                                <div class="input-field ">
                                    @php
                                        if( isset($doctor_details['0']['date']) && !empty($doctor_details['0']['date']))
                                        {
                                            $given_date = date('d/m/Y', strtotime($doctor_details['0']['date']));
                                        }
                                        else
                                        {
                                            
                                            $given_date = date('d/m/Y');
                                        }

                                        $pat_title          = isset($booking_data['patient_user_details']['title'])?$booking_data['patient_user_details']['title']:'';
                                        $pat_first_name     = isset($booking_data['patient_user_details']['first_name'])?$booking_data['patient_user_details']['first_name']:'';
                                        $pat_last_name      = isset($booking_data['patient_user_details']['last_name'])?$booking_data['patient_user_details']['last_name']:'';

                                        $pat_id     = isset($booking_data['patient_user_id'])?$booking_data['patient_user_id']:'';
                                        $booking_id = isset($booking_data['id'])?$booking_data['id']:'';
                                    @endphp
                                    <span class="valign-wrapper"><input id="date" type="text" value="{{ $given_date }}" class="validate center-align datepicker choosedate" placeholder="DD/MM/YYYY"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="time-ro center-align">
                        <h3>Choose Time</h3>
                        <ul class="choosetime" id="getting_time">
                            @if(isset($doc_fee_time_slot) && !empty($doc_fee_time_slot))
                                @foreach($doc_fee_time_slot as $time_slot)

                                    <?php
                                        echo '<li class="time circle">
                                            <a href="#requestbooking"
                                                class="valign-wrapper get_time" 
                                                data-doctor="'.$doctor_id.'"
                                                data-date="'.date('l d F, Y', strtotime($doctor_details['0']['date'])).'"
                                                data-time="'.date('h:i a', strtotime($time_slot['time'])).'"
                                                doctor-rate="'.number_format($time_slot['total_patient_fee_for_four_min'], 2, '.', '').'"
                                                doctor-rate_per_min="'.number_format($time_slot['earning_per_min'], 2, '.', '').'"
                                                doctor-earning_for_4_min="'.number_format($time_slot['earning_for_4_min'], 2, '.', '').'"><span>'.date('h:i', strtotime($time_slot['time'])).'<small>'.date('a', strtotime($time_slot['time'])).'</small></span>
                                            </a>
                                        </li>';
                                    ?>

                                @endforeach
                            @endif

                            <!-- @if(isset($doctor_details) && !empty($doctor_details))
                                @php $time_var = isset($time_interval) ? $time_interval : ""; @endphp
                                @foreach($doctor_details as $doc_data)

                                    @php
                                        $current_time = strtotime(date("Y-m-d h:i a"));
                                        
                                        $sdate = date('Y-m-d h:i a', strtotime($doc_data['date'].' '.$doc_data['start_time']));
                                        $edate = date('Y-m-d h:i a', strtotime($doc_data['date'].' '.$doc_data['end_time']));
                                        
                                        $startTime = strtotime($sdate);
                                        $endTime   = strtotime($edate);

                                        $time = $startTime;

                                        if( $time > $current_time )
                                        {
                                            while ($time < $endTime) 
                                            {
                                                $doctor_rate = '';
                                                $doctor_rate_per_min = '';

                                                $next_time_slot = date("H:i:s", $time);
                                                $current_day = strtolower(date("D"));

                                                $get_time_rate = DB::table('doctor_fees')->where('doctor_id', $doc_data['user_id'])
                                                                                         ->where('day', $current_day)
                                                                                         ->where('start_time', '<=', $next_time_slot)
                                                                                         ->where('end_time', '>=', $next_time_slot)
                                                                                         ->first();
                                                if($get_time_rate)
                                                {
                                                    $doctor_rate = $get_time_rate->total_patient_fee_for_four_min;
                                                    $doctor_rate_per_min = $get_time_rate->earning_per_min;
                                                }
                                                else
                                                {
                                                    $doctor_rate = $highest_fees['total_patient_fee_for_four_min'];
                                                    $doctor_rate_per_min = $highest_fees['earning_per_min'];
                                                }

                                                @endphp
                                                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper get_time" data-doctor="{{ $doc_data['user_id'] }}" data-date="{{ date('l d F, Y', strtotime($doctor_details['0']['date'])) }}" data-time="{{ date('h:i a', $time) }}" doctor-rate="{{ $doctor_rate }}" doctor-rate_per_min="{{ $doctor_rate_per_min }}" ><span>{{ date('h:i', $time) }}<small>{{ date('a', $time) }}</small></span></a></li>
                                                @php
                                                $time = strtotime('+'.$time_var.' minutes', $time);
                                            }
                                        }

                                        else if( $time < $current_time )
                                        {
                                            $i = 0;
                                            $doctor_rate = '';
                                            while ($current_time < $endTime) 
                                            {
                                                
                                                $time =  date('Y-m-d h:i a', strtotime('+ '.$time_var.' minutes',$time));
                                                $time = strtotime($time);

                                                $current_time = strtotime('+'.$time_var.' minutes', $time);                                        
                                                $cr_time = strtotime(date("Y-m-d h:i a"));
                                                if($current_time > $cr_time)
                                                {
                                                    if($i != 0)
                                                    {
                                                        $doctor_rate = '';
                                                        $doctor_rate_per_min = '';

                                                        $next_time_slot = date("H:i:s", $current_time);
                                                        $current_day  = strtolower(date("D"));

                                                        $get_time_rate = DB::table('doctor_fees')->where('doctor_id', $doc_data['user_id'])
                                                                                                 ->where('day', $current_day)
                                                                                                 ->where('start_time', '<=', $next_time_slot)
                                                                                                 ->where('end_time', '>=', $next_time_slot)
                                                                                                 ->first();
                                                        if($get_time_rate)
                                                        {
                                                            $doctor_rate = $get_time_rate->total_patient_fee_for_four_min;
                                                            $doctor_rate_per_min = $get_time_rate->earning_per_min;
                                                            $doctor_earning_for_4_min = $get_time_rate->earning_for_4_min;
                                                        }
                                                        else
                                                        {
                                                            $doctor_rate = $highest_fees['total_patient_fee_for_four_min'];
                                                            $doctor_rate_per_min = $highest_fees['earning_per_min'];
                                                            $doctor_earning_for_4_min = $highest_fees['earning_for_4_min'];
                                                        }

                                                        @endphp
                                                            <li class="time circle"><a href="#requestbooking" class="valign-wrapper get_time" data-doctor="{{ $doc_data['user_id'] }}" data-date="{{ date('l d F, Y', strtotime($doctor_details['0']['date'])) }}" data-time="{{ date('h:i a', $current_time) }}" doctor-rate="{{ $doctor_rate }}" doctor-rate_per_min="{{ $doctor_rate_per_min }}" doctor-earning_for_4_min="{{ $doctor_earning_for_4_min }}"><span>{{ date('h:i', $current_time) }}<small>{{ date('a', $current_time) }}</small></span></a></li>
                                                        @php
                                                    }
                                                    $i++;
                                                }

                                            }

                                        }

                                    @endphp

                                @endforeach

                            @endif -->
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                </div>
                
            </div>
            <div class="blue-border-block-bottom"></div>
        </div>
    </div>
</div>

    <!-- Modal requestbooking -->
    <div id="requestbooking" class="modal addperson fade" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none;">
        <div class="modal-content">
            <h4 class="center-align">Offer Alternative Time</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s3 l3 center-align title">Consultation</div>
                <div class="col s9 l9"><strong>{{ $booking_data['consultation_id'] }}</strong></div>
                <div class="col s3 l3 center-align title">Time</div>
                <div class="col s9 l9" id="time_schedule"><strong><span id="put_time"></span>, <span id="put_date"></span></strong></div>

                <form id="booking_details" method="POST" action="{{ url('/') }}/doctor/consultation/process_offer_time">
                    {{ csrf_field() }}
                    <input type="hidden" name="booking_time" id="booking_time" value="">
                    <input type="hidden" name="booking_id" id="booking_id" value="{{ $booking_id }}">
                    <input type="hidden" name="patient_id" id="patient_id" value="{{ $pat_id }}">
                </form>

            </div>
            <div class="row">
                <div class="col s3 l3 center-align title">Patient</div>
                <div class="col s9 l9"><strong>{{ $pat_title.' '.$pat_first_name.' '.$pat_last_name }}</strong></div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons right submit_form" id="booking_details_submit_form">Continue</a>
        </div>
    </div>

<!-- get today's date -->
<input type="hidden" id="txt_7day" name="txt_7day" value="{{ date('Y,m,d', strtotime('+6 day')) }}">

<script>
    var url = "<?php echo $module_url_path; ?>";
    $(document).ready(function () {

        $('#tab_consultation_request').click(function () {
            window.location = url + "/new_consultation_request";
        });

        $('#tab_upcoming_consultation').click(function(){
                window.location = url+"/upcoming_consultation";
        });

        $('#tab_past_consultation').click(function () {
            window.location = url + "/past_consultation";
        });

        $('#tab_declined_consultation').click(function () {
            window.location = url + "/decline_consultation";
        });

        $(document).on('click', '.get_time', function(){
            var selected_date = jQuery(this).data("date");
            $('#put_date').html(selected_date);

            var selected_time = jQuery(this).data("time");
            $('#put_time').html(selected_time);

            var doc_time = $('#time_schedule strong').text();
            $('#booking_time').val(doc_time);
        });

        $('#booking_details_submit_form').click(function(){
            $('#booking_details').submit();
        });
    });
</script>

<link rel="stylesheet" href="{{ url('/') }}/public/date-time-picker/css/clock-picker.css"  media="screen,projection"/>
<script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>
<script>
   var sevenday = $('#txt_7day').val();
   $('.datepicker').pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 10, // Creates a dropdown of 15 years to control year,
     today: 'Today',
     clear: 'Clear',
     close: 'Ok',
     closeOnSelect: true, // Close upon selecting a date,
     format: 'dd/mm/yyyy',
     formatSubmit: 'yyyy-mm-dd',
     //selectYears: 10, // `true` defaults to 10.
     min: new Date(),
     max: new Date(sevenday),
     // Accessibility labels
     /*labelMonthNext: 'Next month',
     labelMonthPrev: 'Previous month',
     labelMonthSelect: 'Select a month',
     labelYearSelect: 'Select a year',*/
     onOpen: function() {
           //console.log( 'Opened')
       },
       onClose: function() {
           //console.log( 'Closed ' + this.$node.val() )
           
           selected_date = this.$node.val();
           var token = $('input[name="_token"]').val();
           $.ajax({
                url   : "{{ url('/') }}/doctor/consultation/get_doctor_available_time",
                type  : "POST",
                data: {_token:token,selected_date:selected_date},
                success : function(res){
                    if($.trim(res)=='error')
                    {
                        $('.choosetime').empty(); 
                    }
                    else
                    {
                        $('#getting_time').empty(); 
                        $('#getting_time').append(res);
                    }
                }
           });
       },
       onSelect: function() {
           //console.log( 'Selected: ' + this.$node.val() )
       },
       onStart: function() {
           //console.log( 'Hello there :)' )
       }
   });
</script>

@endsection