@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header consultation-detailshead z-depth-2">
        <div class="backarrow"><a href="my-consulations-1.html" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>


        <div class="menu-dotted"><a class="dropdown-button center-align" href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div>
    </div>

    @php
        $doc_title      = isset($consult_data['doctor_user_details']['title'])?$consult_data['doctor_user_details']['title']:'';
        $doc_first_name = isset($consult_data['doctor_user_details']['first_name'])?$consult_data['doctor_user_details']['first_name']:'';
        $doc_last_name  = isset($consult_data['doctor_user_details']['last_name'])?$consult_data['doctor_user_details']['last_name']:'';

        $pat_title      = isset($consult_data['patient_user_details']['title'])?$consult_data['patient_user_details']['title']:'';
        $pat_first_name = isset($consult_data['patient_user_details']['first_name'])?$consult_data['patient_user_details']['first_name']:'';
        $pat_last_name  = isset($consult_data['patient_user_details']['last_name'])?$consult_data['patient_user_details']['last_name']:'';

        $booking_datetime = isset($consult_data['consultation_datetime'])?$consult_data['consultation_datetime']:'';

        $enc_booking_id = isset($consult_data['id'])?base64_encode($consult_data['id']):'';
    @endphp

    <div class="container posrel has-header has-footer">
        <div class="sub-header booking-confirm  z-depth-2">
            <div class="booking-requested"> <img src="{{ url('/') }}/public/new/images/confirm-icon.png" alt="" />
                <h2>Booking Confirmed!</h2>
                <div class="row">
                    <div class="col s6">
                        <h5>{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</h5>
                        <p>Doctor</p>
                    </div>
                    <div class="col s6">
                        <h5>{{ date("h:s a, l d F, Y",strtotime($booking_datetime)) }}</h5>
                        <p>Confirmed Time</p>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
            </div>
        </div>
        <div class="patient">
            <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" />
            <h4>{{ $pat_title.' '.$pat_first_name.' '.$pat_last_name }}</h4>
            <span>Patient</span>
        </div>

        <div class="data-content">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active waves-effect waves-light">What to do next <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>Dr. Smithonian will call you via the doctoroo app at the above time.</span>
                        <p class="info-title">Please ensure:</p>
                        <ul>
                            <li><i class="fa fa-circle"></i> You're on time for your booking</li>
                            <li><i class="fa fa-circle"></i> You're in a private room</li>
                            <li><i class="fa fa-circle"></i> You have a charged device, internet and a microphone &amp; camera</li>
                        </ul>
                        <p>In the meantime, you can save consultation time &amp; cost by <a href="javascript:void(0);" class="greencolor">completing your medical history</a> before the consultation.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Reminders <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body pad0select">

                        <h5 class="digihis green-text">How would you like to be reminded?</h5>

                        <ul class="collection brdrtopsd">

                            <li class="collection-item norl ">
                                <div class="valign-wrapper wid100 marbtm">
                                    <div class="left wid90 truncate"><span class="title "><strong>SMS </strong> ($5 for 10 SMS credits)</span></div>
                                    <div class="right">
                                        <div class="right">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" checked >
                                                    <span class="lever greenbg"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clr divider " ></div>
                                <div >
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="input-field col s6 m6 l6  text-bx lessmar">

                                            <input type="text" id="reason" class="validate ">
                                            <label for="reason" class="grey-text truncate">Mobile Number</label>
                                        </div>
                                        <div class="input-field col s6 m6 l6  text-bx lessmar">

                                            <input type="text" id="reason" class="validate ">
                                            <label for="reason" class="grey-text truncate">Renter Mobile Number</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="input-field col s6 m6 l6 selct ">
                                            <select>
                                                <option value="" disabled selected>Please Select Amount</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>
                                        </div>
                                        <div class=" col s6 m6 l6 selct">
                                            <a class="waves-effect waves-light btn cart bluedoc-bg round-corner truncate notp" href="#"> Buy Credit </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item norl valign-wrapper">
                                <div class="left wid90 truncate"><span class="title "><strong>App Notification</strong></span>

                                </div>
                                <div class="right">

                                    <div class="switch">
                                        <label>

                                            <input type="checkbox" checked>
                                            <span class="lever greenbg"></span>
                                        </label>
                                    </div>
                                </div>

                            </li>
                            <li class="collection-item norl valign-wrapper">
                                <div class="left wid90 truncate"><span class="title "><strong>Email</strong></span>

                                </div>
                                <div class="right">
                                    <div class="switch">
                                        <label>

                                            <input type="checkbox" checked>
                                            <span class="lever greenbg"></span>
                                        </label>
                                    </div>

                                </div>

                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Payment <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>Your card has been debited a $28 booking fee which includes the first 4 minutes of the consultation.</span>
                        <p>If your consultation passes 4 minutes, your card will be debited $10 per 4 minute block.</p>
                        <div class="right"><a class="waves-effect waves-light btn  invoice" href="consultation-invoice.html"><i class="material-icons right">&#xE873;</i>View Invoice</a>
                            <p><a href="#pricing_details" class="greencolor" data-dismiss="modal" data-toggle="modal" data-target="#pricing_details" >View Pricing Details</a></p>
                        </div>
                        <div class="clr"></div>
                    </div>
                </li>
            </ul>
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/booking/online_waiting_room/{{ $enc_booking_id }}">close</a>
    </div>

    <!--popup include -->
    @include('front.patient.booking.pricing_details')

    <!-- Modal Reschedule -->
    <div id="resechdule" class="modal resechdule">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->

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
    
    <!-- Modal Structure End -->
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

    <!-- Modal Reminders -->
    <div id="reminders" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Reminders</h4>
        </div>
        <div class="row added-rem">

            <div class="col s2"><i class="fa fa-bell"></i></div>
            <div class="col s6 left-align"><span>5 minutes</span></div>
            <div class="col s2"><i class="fa fa-angle-down"></i></div>
            <div class="col s2">
                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
            </div>




        </div>
        <div class="row added-rem">

            <div class="col s2"><i class="fa fa-bell"></i></div>
            <div class="col s6 left-align"><span>2 hours</span></div>
            <div class="col s2"><i class="fa fa-angle-down"></i></div>
            <div class="col s2">
                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
            </div>


        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action waves-effect waves-green btn-add-remin"> <i class="material-icons">add</i> Add Reminder</a>
        </div>
    </div>
    <!-- Modal Reminders End -->

@endsection