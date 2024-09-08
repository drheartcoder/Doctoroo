@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

    <div class="header consultation-detailshead z-depth-2">
        <div class="backarrow"><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <div class="menu-dotted"><a class="dropdown-button center-align" href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div>
    </div>

    <div class="container posrel has-header has-footer">
        <div class="sub-header booking-confirm  z-depth-2">
            <div class="booking-requested"> <img src="{{ url('/') }}/public/new/images/confirm-icon.png" alt="" />
                <h2>Booking Requested!</h2>
                <div class="row">
                    <div class="col s6">
                        <h5>Dr. Jonathan Smithonian</h5>
                        <p>Doctor</p>
                    </div>
                    <div class="col s6">
                        <h5>3:30 pm Web, 25 May 2017</h5>
                        <p>Confirmed Time</p>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
            </div>
        </div>
        <div class="patient">
            <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" />
            <h4>Arnoldian Jackson</h4>
            <span>Patient</span>
        </div>

        <div class="data-content">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active waves-effect waves-light">What to do next <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>Once Dr. Smithonian confirms your booking, you'll be notified by email &amp; mobile notification</span>
                        <p>You can save consultation time &amp; cost by <a href="#">completing your medical history</a> before your consultation.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Payment <i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>You have yet been charged - payment will only be processed once Dr. Smothinian confirms your booking.</span>
                        <p>Until then, you may <a href="{{ url('/patient') }}/cancellation_refunds">reschedule or cancel your booking.</a></p>
                        <p><a href="{{ url('/patient') }}/pricing_details" class="view-price-btn">View pricing details</a></p>
                    </div>
                </li>

            </ul>


        </div>

        <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/online_waiting_room">close</a>
    </div>


    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="{{ url('/patient') }}/cancellation_refunds"> View refund policy</a></p>
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
            <a href="{{ url('/patient') }}/online_waiting_room" class="modal-action waves-effect waves-green btn-cancel-cons right cnclbook ">Cancel Booking</a>
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
        <p class="view-policy"><a href="{{ url('/patient') }}/cancellation_refunds"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->
    <!--Container End-->

@endsection