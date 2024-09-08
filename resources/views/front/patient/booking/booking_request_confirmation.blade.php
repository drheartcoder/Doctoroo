@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header consultation-detailshead z-depth-2">
        <!-- <div class="backarrow"><a href="{{ URL::previous() }}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div> -->
        <!-- <div class="menu-dotted"><a class="dropdown-button center-align" href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule" data-toggle="modal" data-backdrop="static" data-target="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult" data-toggle="modal" data-backdrop="static" data-target="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div> -->
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

        <div class="sub-header booking-confirm  z-depth-2">
            <div class="booking-requested"> <img src="{{ url('/') }}/public/new/images/confirm-icon.png" alt="" />
                <h2>Booking Requested!</h2>
                <div class="row">
                    <div class="col s6">
                        @php
                        // check listisng image
                        if ( isset($doctor_details['userinfo']['profile_image']) && !empty($doctor_details['userinfo']['profile_image']) )
                        {
                            $profile_images = $doctor_image_url.$doctor_details['userinfo']['profile_image'];
                            // check if image exists or not
                            if ( File::exists($profile_images) )
                            {
                                $profile_images = $doctor_image_url."default-image.jpeg";
                            } // end if
                        } // end if
                        else
                        {
                            $profile_images = $doctor_image_url."default-image.jpeg";
                        } // end else

                        $doc_title      = isset($doctor_details['userinfo']['title'])?$doctor_details['userinfo']['title']:'';
                        $doc_first_name = isset($doctor_details['userinfo']['first_name'])?$doctor_details['userinfo']['first_name']:'';
                        $doc_last_name  = isset($doctor_details['userinfo']['last_name'])?$doctor_details['userinfo']['last_name']:'';
                        $doc_id         = isset($doctor_details['userinfo']['id'])?$doctor_details['userinfo']['id']:'';

                        @endphp
                        <?php $get_doc_data = \DB::table('users')->where('id',$doc_id)->first(); 
                              if(isset($get_doc_data->dump_id) && $get_doc_data->dump_id != ""){ $avl_dump_id = $get_doc_data->dump_id; } else { $avl_dump_id = ""; }
                              if(isset($get_doc_data->dump_session) && $get_doc_data->dump_session != ""){ $avl_dump_session = $get_doc_data->dump_session; } else { $avl_dump_session = ""; }
                        ?>
                        <h5><span class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span></h5>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                /*var doc_id           = "{{$doc_id}}";
                                var doc_first_name   = "{{$doc_first_name}}"; 
                                var doc_last_name    = "{{$doc_last_name}}"; 
                                var doc_title        = "{{$doc_title}}"; 
                                var card_id          = "{{$avl_dump_id}}"
                                var userkey          = "{{$avl_dump_session}}";
                                var VIRGIL_TOKEN     = "{{env('VIRGIL_TOKEN')}}";
                                var api              = virgil.API(VIRGIL_TOKEN);
                                var key              = api.keys.import(userkey);
                                 
                                if(doc_first_name != "" && doc_last_name != ""){
                                    var doc_first_name   = key.decrypt(doc_first_name).toString();
                                    var doc_last_name    = key.decrypt(doc_last_name).toString();
                                    var dr_name = doc_title+' '+doc_first_name+' '+doc_last_name;
                                    $('.doc_name'+doc_id).html(dr_name);
                                }
                                else
                                if(doc_first_name != ""){
                                    var doc_first_name   = key.decrypt(doc_first_name).toString();
                                    var dr_name = doc_title+' '+doc_first_name+' '+' ';
                                    $('.doc_name'+doc_id).html(dr_name);
                                }
                                else
                                if(doc_last_name != ""){
                                    var doc_last_name   = key.decrypt(doc_last_name).toString();
                                    var dr_name = doc_title+' '+' '+' '+doc_last_name;
                                    $('.doc_name'+doc_id).html(dr_name);
                                }*/
                            });
                        </script>
                        <p>Doctor</p>
                    </div>
                    <div class="col s6">
                        <h5>{{ $booking_time }}</h5>
                        <p>Requested Time</p>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
            </div>
        </div>
        <div class="patient">
            <?php $get_patient_data = \DB::table('users')->where('id',$patient_id)->first(); 
                  if(isset($get_patient_data->dump_id) && $get_patient_data->dump_id != ""){ $patient_dump_id = $get_patient_data->dump_id; } else { $patient_dump_id = ""; }
                  if(isset($get_patient_data->dump_session) && $get_patient_data->dump_session != ""){ $patient_dump_session = $get_patient_data->dump_session; } else { $patient_dump_session = ""; }
            ?>
            <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" />
            <h4><span class="patient_name<?php echo $patient_id; ?>">{{ $user_name }}</span></h4>
            <script type="text/javascript">
                $(document).ready(function(){
                    /*var patient_id           = "{{$patient_id}}";
                    var patient_first_name   = "{{$first_name}}"; 
                    var patient_last_name    = "{{$last_name}}"; 
                    var patient_title        = "{{''}}"; 
                    var card_id              = "{{$patient_dump_id}}"
                    var userkey              = "{{$patient_dump_session}}";
                    var VIRGIL_TOKEN         = "{{env('VIRGIL_TOKEN')}}";
                    var api                  = virgil.API(VIRGIL_TOKEN);
                    var key                  = api.keys.import(userkey);

                    if(patient_first_name != "" && patient_last_name != ""){
                        var patient_first_name   = key.decrypt(patient_first_name).toString();
                        var patient_last_name    = key.decrypt(patient_last_name).toString();
                        var patient_name = patient_title+' '+patient_first_name+' '+patient_last_name;
                        $('.patient_name'+patient_id).html(patient_name);
                    }
                    else
                    if(patient_first_name != ""){
                        var patient_first_name   = key.decrypt(patient_first_name).toString();
                        var patient_name = patient_title+' '+patient_first_name+' '+' ';
                        $('.patient_name'+patient_id).html(patient_name);
                    }
                    else
                    if(patient_last_name != ""){
                        var patient_last_name   = key.decrypt(patient_last_name).toString();
                        var patient_name = patient_title+' '+''+' '+patient_last_name;
                        $('.patient_name'+patient_id).html(patient_name);
                    }*/
                });
                </script>    
            <span>Patient</span>
        </div>

        <div class="data-content">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active waves-effect waves-light">What to do next <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <!-- <span>Once <sapn class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }} </span> confirms your booking, you'll be notified by email &amp; mobile notification</span>
                        <p>You can save consultation time &amp; cost by <a href="{{ url('/') }}/patient/my_health/medical_history/1" class="greencolor">completing your medical history</a> before your consultation.</p> -->

                        <p>Please login a few minutes before your booking time and await an SMS/email from the doctor to confirm the consultation/video call start time.</p>
                        <p>Please account for any unexpected delays from the doctor's end, it may take up to an hour after the confirmed time for the doctor to begin the video call. If there is more than an hour’s delay, you will be offered a full refund.</p>
                        <p>Before accepting the call, please ensure you:</p>
                        <ul class="pointsQues">
                            <li>Are in a private and quiet space</li>
                            <li>Have a charged device, internet connection and a microphone & camera</li>
                            <li>Test your internet connection and video quality <a href="https://tokbox.com/developer/tools/precall/" target="_blank">here</a> before the consultation to identify any issues before the call</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Payment <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>You have yet been charged - payment will only be processed once <span class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span> confirms your booking.</span>
                        <p>Until then, you may <a href="#cancellation_refunds" class="greencolor">reschedule or cancel your booking.</a></p>
                        <!-- <p><a href="{{ url('/patient') }}/booking/pricing_details" class="view-price-btn">View pricing details</a></p>  <a href="{{ url('/patient') }}/booking/cancellation_refunds" class="greencolor">-->
                        <!-- <p><a href="#pricing_details" class="greencolor" data-toggle="modal" >View Pricing Details</a></p> -->
                    </div>
                </li>

            </ul>


        </div>
        @if(isset($enc_booking_id) && !empty($enc_booking_id))
            <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/booking/online_waiting_room/{{ $enc_booking_id }}">Go to Online Waiting Room</a>
        @else
            <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/booking/online_waiting_room">Go to Online Waiting Room</a>
        @endif

        </div>
    </div>


    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="{{ url('/patient') }}/booking/cancellation_refunds"> View refund policy</a></p>
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
        <form method="POST" action="{{ url('/') }}/patient/booking/cancel_consultation">
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
    <div id="resechdule" class="modal resechdule fade" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none;">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="#cancellation_refunds" data-toggle="modal" > View refund policy</a></p>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="{{ url('/') }}/patient/booking/reschedule_consultation" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->
    <!--Container End-->

    <!--popup include -->
    @include('front.patient.booking.pricing_details')
    @include('front.patient.booking.cancellation_refunds')

    <script>
        $(document).ready(function() {
            
            // if other option is selected then show textbox for other reasons
            $('#other').click(function(){ 
                $("#other_reason").show();
            });
            $('#no_longer_need_a_doctor, #doctor_didnt_respond, #doctor_declined_my_booking').click(function(){ 
                $("#other_reason").hide();
            });

            // disable back button on browser
            window.history.pushState(null, "", window.location.href);        
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };

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
    </script>

@endsection