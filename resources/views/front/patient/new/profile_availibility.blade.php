@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')


    <div class="header profileHead  z-depth-2">
        <div class="backarrow"><a href="{{ url('/patient') }}/search_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
    </div>

    <div class="container has-header profile">
        <div class="subheader">
            <div class="profilesumm">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            <img src="{{ url('/') }}/public/new/images/avtar-4.png" class="circle left" />
                            <p>Dr. Jonathan Smithonian <small>MBBS (Syd. Uni),  FRACCS, Grad. Dip</small></p>
                        </div>

                    </div>
                </div>
            </div>
            <iframe src="https://www.youtube.com/embed/KXdUNp_9oHs" frameborder="0" allowfullscreen class="videoBox responsive-video"></iframe>

        </div>

        <div class="tabli scrollspy  z-depth-2">
            <ul>
                <li>
                    <a href="{{ url('/patient') }}/profile_about" class="valign-wrapper">About Me</a>
                </li>
                <li class="active">
                    <a href="{{ url('/patient') }}/profile_availibility" class="valign-wrapper">Availibility</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
        <div class="data-content">
            <div class="date-ro center-align">
                <h3>Choose a day</h3>
                <div class="dayChange  center-align">
                    <div class="valign-wrapper calendar">
                        <div class="input-field ">
                            <span class="valign-wrapper"><input id="date" type="date" class="validate center-align datepicker choosedate" placeholder="Pick a date"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="time-ro center-align">
                <h3>Choose Time</h3>

                <ul class="choosetime">
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.30 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.35 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.40 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.45 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.50 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>11.55 <small>pm</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.00 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.05 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.10 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.15 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.20 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.25 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.30 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.35 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.40 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.45 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.50 <small>am</small></span></a></li>
                    <li class="time circle"><a href="#requestbooking" class="valign-wrapper"><span>12.55 <small>am</small></span></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>

    <!-- Modal requestbooking -->
    <div id="requestbooking" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Request Booking</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s2 l2 center-align title">Time</div>
                <div class="col s10 l10"><strong>12.35pm Wed, 25th May</strong></div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">With</div>
                <div class="col s10 l10"><strong>Dr. Jonathan Smithonian</strong></div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">Cost</div>
                <div class="col s10 l10"><strong>$28</strong> booking fees include first 4 mins
                    <p><span class="title">Note:</span> You'll be charged once your doctor confirms your booking. </p>
                    <a class="greencolor">Pricing Details</a>
                </div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align">
                    <div class="input-field chkbx  center-align">
                        <input type="checkbox" class="filled-in" id="chk" />
                        <label for="chk"></label>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="col s10 l10">Notify other available doctors if this doctor doesn't respond by the booking time or within 1hour</div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="{{ url('/patient') }}/review_booking" class="modal-action waves-effect waves-green btn-cancel-cons right ">Continue</a>
        </div>
    </div>

@endsection