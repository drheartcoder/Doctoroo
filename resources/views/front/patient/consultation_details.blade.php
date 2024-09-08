@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
        <div class="searchicon"><a href="{{ url('/patient') }}/upcoming_search" class="menu-icon center-align"><i class="material-icons">search</i> </a></div>
    </div>

    <div class="header consultation-detailshead z-depth-2">
        <div class="backarrow"><a href="my-consulations-1.html" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align">Consultation Details</h1>

        <!-- <div class="menu-dotted posrel"><a class="dropdown-button center-align" href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div> -->
        <!-- <div class="download"><a href="#" class="center-align"><i class="material-icons">&#xE2C4;</i></a></div> -->
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">
        <div class="consultation-details">
            <div class="sub-header  z-depth-2">
                <div class="row detInfo">
                    <div class="col s6 m6 l6 left-align">
                        <div class="data">
                            <label class="white-text">
                                @if(isset($upcoming_consult_arr['familiy_member_info']))
                                       @php $val = $upcoming_consult_arr['familiy_member_info']; @endphp
                                       {{isset($val['first_name']) ? $val['first_name'] : ''}}
                                       {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                @elseif(isset($upcoming_consult_arr['patient_user_details']))
                                     @php $val = $upcoming_consult_arr['patient_user_details']; @endphp
                                        {{isset($val['first_name']) ? $val['first_name'] : ''}}
                                       {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                @endif
                             </label>
                            <small>Patient Name</small>
                        </div>
                        <div class="data">
                            <label class="white-text">{{isset($upcoming_consult_arr['doctor_user_details']['title']) ? $upcoming_consult_arr['doctor_user_details']['title'] : ''}} {{isset($upcoming_consult_arr['doctor_user_details']['first_name']) ? $upcoming_consult_arr['doctor_user_details']['first_name'] : ''}} {{isset($upcoming_consult_arr['doctor_user_details']['last_name']) ? $upcoming_consult_arr['doctor_user_details']['last_name'] : ''}}</label>
                            <small>Doctor</small></div>

                    </div>
                    <div class="col s6 m6 l6 right-align">
                        <label class="date white-text">3 Feb 2017</label>
                        <label class="consId white-text"><span>Consultation ID:</span> 0985110</label>
                        <a class="view-invoice white-text" href="consultation-invoice.html">View Invoice <span><i class="material-icons">&#xE873;</i></span></a>
                    </div>
                </div>
                <div class="row detInfo mrtp">
                    <div class="col s12 m12 l12 left-align">
                        <div class="data left">
                            <label class="white-text">$38555.50</label>
                            <small>Total</small></div>
                        <div class="data">
                            <label class="white-text">Credit Card ****3345</label>
                            <small>Payment method</small></div>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>


            </div>
            <div class="time-date ">
                <div class="row">
                    <div class="col s7 m6 l5"> <img src="{{url('')}}/public/images/clock-icon.jpg" alt="" />

                        <label class="time">12:35pm - 12:44pm</label>
                        <div class="date">25 September, 2017</div>
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
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
                            </div>
                            <div class="max-width-carousel ">
                                <a class="downicon z-depth-2" href="#"><img  src="images/download-icon.svg" /></a>
                                <img src="images/trail_photo.png" class="materialboxed">
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
                                        <img src="images/rx-certi.png" />
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
                                        <img src="images/rx-doc.png" />
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
                                        <img src="images/cer-doc.png" />
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
        <a class="waves-effect waves-light futbtn">close</a>
        </div>
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

    <!--Container End-->

@endsection