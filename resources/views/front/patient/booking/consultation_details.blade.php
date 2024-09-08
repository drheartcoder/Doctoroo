@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

	<div class="header consultation-detailshead z-depth-2">
        <div class="backarrow"><a href="{{ URL::previous() }}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align">Consultation Details</h1>

        <!-- <div class="menu-dotted posrel">
            <a class="dropdown-button center-align" href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div> -->
        <!-- <div class="download"><a href="#" class="center-align"><i class="material-icons">&#xE2C4;</i></a></div> -->
    </div>

    @php
        $pat_title      = isset($consult_data['patient_user_details']['title'])?$consult_data['patient_user_details']['title']:'';
        $pat_first_name = isset($consult_data['patient_user_details']['first_name'])?$consult_data['patient_user_details']['first_name']:'';
        $pat_last_name  = isset($consult_data['patient_user_details']['last_name'])?$consult_data['patient_user_details']['last_name']:'';

        $doc_title      = isset($consult_data['doctor_user_details']['title'])?$consult_data['doctor_user_details']['title']:'';
        $doc_first_name = isset($consult_data['doctor_user_details']['first_name'])?$consult_data['doctor_user_details']['first_name']:'';
        $doc_last_name  = isset($consult_data['doctor_user_details']['last_name'])?$consult_data['doctor_user_details']['last_name']:'';

        $consultation_id = isset($consult_data['consultation_id'])?$consult_data['consultation_id']:'';
        $charge = isset($consult_data['consultation_charge'])?$consult_data['consultation_charge']:'';
        $card_no = isset($consult_data['card_number'])?$consult_data['card_number']:'';
        $card_number = substr_replace($card_no, str_repeat("*", 12), 0, 12);

        $booking_datetime = isset($consult_data['consultation_datetime'])?$consult_data['consultation_datetime']:'';
        $enc_booking_id = isset($consult_data['id'])?base64_encode($consult_data['id']):'';
    @endphp

    <div class="container posrel has-footer">
        <div class="consultation-details">
            <div class="sub-header  z-depth-2">
                <div class="row detInfo">
                    <div class="col s6 m6 l6 left-align">
                        <div class="data">
                            <label class="white-text">{{ $pat_title.' '.$pat_first_name.' '.$pat_last_name }}</label>
                            <small>Patient Name</small>
                        </div>
                        <div class="data">
                            <label class="white-text">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</label>
                            <small>Doctor</small></div>

                    </div>
                    <div class="col s6 m6 l6 right-align">
                        <label class="date white-text">{{ date("d F, Y",strtotime($booking_datetime)) }}</label>
                        <label class="consId white-text"><span>Consultation ID:</span> {{ $consultation_id }}</label>
                        <a class="view-invoice white-text" href="consultation-invoice.html">View Invoice <span><i class="material-icons">&#xE873;</i></span></a>
                    </div>
                </div>
                <div class="row detInfo mrtp">
                    <div class="col s12 m12 l12 left-align">
                        <div class="data left">
                            <label class="white-text">${{ $charge }}</label>
                            <small>Total</small></div>
                        <div class="data">
                            <label class="white-text">Credit Card {{ $card_number }}</label>
                            <small>Payment method</small></div>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>


            </div>
            <div class="time-date ">
                <div class="row">
                    <div class="col s7 m6 l5"> <img src="{{ url('/') }}/public/new/images/clock-icon.png" alt="" />

                        <label class="time">{{ date("h:i a",strtotime($booking_datetime)) }}</label>
                        <div class="date">{{ date("d F, Y",strtotime($booking_datetime)) }}</div>
                        <span class="greenColr">Time</span>
                    </div>
                    <div class="col s5 m6 l7 ">
                        <div class="mrtplft">
                            <label class="time">8 mins 44 secs</label>
                            <span class="greenColr">Length</span></div>
                    </div>
                </div>
            </div>

            <div class="data-content">
                <ul class="collapsible" data-collapsible="expandable">
                    <li>
                        <div class="collapsible-header active waves-effect waves-light">Doctor Notes <i class="material-icons right">expand_more</i></div>
                        <div class="collapsible-body">
                            <span>My name is Doctor Jonthan Smithonian and l've been practicing medicene for the past 7 years and<a href="#">  Read more</a></span>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header waves-effect waves-light">Photos <i class="material-icons right">expand_more</i></div>
                        <div class="collapsible-body center">


                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="{{ url('/') }}/public/new/images/download-icon.svg" /></a>
                                <img src="{{ url('/') }}/public/new/images/trail_photo.png" class="materialboxed">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header waves-effect waves-light">Documents &amp; certificates <i class="material-icons right">expand_more</i></div>
                        <div class="collapsible-body">
                        <ul class="collection brdrtopsd ">
                        <li class="collection-item martb">
                            <div class="row">
                                <div class="col l9 m9 s8">
                                    <div class="valign-wrapper pres">
                                        <img src="{{ url('/') }}/public/new/images/rx-certi.png" />
                                        <a href="#">
                                            <p class="green-text">Prescription 0034400 - 12 Mar 2017</p>
                                            
                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s4 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item martb">
                            <div class="row">
                                <div class="col l9 m9 s8">
                                    <div class="valign-wrapper pres">
                                        <img src="{{ url('/') }}/public/new/images/rx-doc.png" />
                                        <a href="#">
                                            <p class="green-text">Referral 99034 - 12 Mar 2017</p>

                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s4 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item martb">
                            <div class="row">
                                <div class="col l9 m9 s8">
                                    <div class="valign-wrapper pres">
                                        <img src="{{ url('/') }}/public/new/images/cer-doc.png" />
                                        <a href="#">
                                            <p class="green-text">Medical Certificate 00343 - 12 Mar 2017</p>

                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s4 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>

                    </ul>
                        </div>
                    </li>

                </ul>


            </div>
            <div class="divider"></div>
            <div class="center">
                <a href="#" class="greyBtn">Feedback</a>
                <a href="#" class="greyBtn">Dispute</a>
                <a href="#" class="greyBtn">Other</a>
            </div>
        </div>
        <a href="{{ url('/') }}/patient/booking/online_waiting_room/{{ $enc_booking_id }}" class="waves-effect waves-light futbtn">close</a>
    </div>

    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#cancel-reason" class="modal-action  modal-close waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    <!-- Modal Cancel Consultation End -->

    <!-- Modal reason for cancellation -->
    <div id="cancel-reason" class="modal requestbooking">
        <div class="modal-content bigcancelhead">
            <h4>Please let us know why, because we care.</h4>
        </div>
        <div class="modal-data doctorForm">
            <div class="input-field col s12 radio">

                <p>
                    <input name="group1" type="radio" id="test1" checked />
                    <label for="test1">No Longer need a doctor</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input name="group1" type="radio" id="test2" />
                    <label for="test2">Doctor didn't respond</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input name="group1" type="radio" id="test3" />
                    <label for="test3">Doctor declined my booking</label>
                </p>
                <div class="divider"></div>
                <p>
                    <input name="group1" type="radio" id="test4" />
                    <label for="test4">Other</label>
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="online-waiting-room.html" class="modal-action waves-effect waves-green btn-cancel-cons right cnclbook ">Cancel Booking</a>
        </div>
    </div>
     <!-- Modal reason for cancellation ends-->

    <!-- Modal Reschedule -->
    <div id="resechdule" class="modal resechdule">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="javascript:void(0);"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->

@endsection