@extends('front.patient.new.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
        <div class="searchicon"><a href="{{ url('/patient') }}/index_search" class="menu-icon center-align"><i class="material-icons">search</i> </a></div>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.new.layout._sidebar')

    <div class="mar300  has-header has-footer">

        <div class="consultation-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s3"><a class="active" href="#test1"><span><img src="{{ url('/') }}/public/new/images/new-doc-icon.png" alt="icon"/> </span> New</a></li>
                <li class="tab col s3">
                    <a href="#test2"> <span><img src="{{ url('/') }}/public/new/images/upcuming-icon.png" alt="icon"/> </span> Upcoming</a>
                </li>
                <li class="tab col s3">
                    <a href="#test3"> <span><img src="{{ url('/') }}/public/new/images/past-icon.png" alt="icon"/> </span>Past</a>
                </li>
                <li class="tab col s3">
                    <a href="#test4"> <span><img src="{{ url('/') }}/public/new/images/team-doc-icon.png" alt="icon"/> </span>My Doctors</a>
                </li>
            </ul>
        </div>
        <div class="container minhtnor">

            <div id="test1" class="col s12 tab-content">
                <div class="my-con-bx">
                </div>
            </div>
            <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/book_a_doctor">Book New Consultation</a>
            <div id="test2" class="col s12 tab-content">
                <div class="my-con-bx">
                    <div class="doc-img">
                        <img src="{{ url('/') }}/public/new/images/doc-icon.png" alt="doctor icon" />
                        <p>
                            You have no upcoming consultations. Top below book a new one.
                        </p>

                    </div>
                </div>
            </div>
            <div id="test3" class="col s12 tab-content medi">
                <div class="gray-strip">
                    <div class="row">
                        <div class="col s12">
                            <div class="month-title">
                                April, 2017
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <div class="left wid100"><small>Web 12th Apr, 12:35pm</small>
                            <span class="title"> Dr. Jonathan Smith</span>

                        </div>
                        <div class="right posrel"><a href="#" data-activates='dropdown' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                        <ul id='dropdown' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_details">View Consultation Details</a></li>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                            <li><a href="{{ url('/patient') }}/feedback">Feedback &amp; Review</a></li>
                            <li><a href="javascript:void(0);">Delete</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <div class="left wid100"><small>Web 12th Apr, 12:35pm</small>
                            <span class="title"> Dr. Jonathan Smith</span>

                        </div>
                        <div class="right posrel"><a href="#" data-activates='dropdown1' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                        <ul id='dropdown1' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_details">View Consultation Details</a></li>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                            <li><a href="{{ url('/patient') }}/feedback">Feedback &amp; Review</a></li>
                            <li><a href="javascript:void(0);">Delete</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <div class="left wid100"><small>Web 12th Apr, 12:35pm</small>
                            <span class="title"> Dr. Jonathan Smith</span>

                        </div>
                        <div class="right posrel"><a href="#" data-activates='dropdown2' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                        <ul id='dropdown2' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_details">View Consultation Details</a></li>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                            <li><a href="{{ url('/patient') }}/feedback">Feedback &amp; Review</a></li>
                            <li><a href="javascript:void(0);">Delete</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <div class="left wid100"><small>Web 12th Apr, 12:35pm</small>
                            <span class="title"> Dr. Jonathan Smith</span>

                        </div>
                        <div class="right posrel"><a href="#" data-activates='dropdown3' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                        <ul id='dropdown3' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_details">View Consultation Details</a></li>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                            <li><a href="{{ url('/patient') }}/feedback">Feedback &amp; Review</a></li>
                            <li><a href="javascript:void(0);">Delete</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </li>
                </ul>

            </div>
            <div id="test4" class="col s12 tab-content medi">
                <div class="available-now martp">
                    <div class="col s12 title1">April 2017</div>

                    <ul class="collection">
                        <li class="collection-item avatar ">
                            <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                                <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-1.jpg" alt="" class="circle" />
                                    <span class="onlinenew"></span> </div>
                                <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                    <p class="availability bluedoc-text"> <strong>Last Booking :</strong> Wed 13th April 2017, 12.35pm</p>
                                </div>
                                <div class="doc-action right"> <span class=" btn secondary-content border">Book now</span></div>

                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="collection-item avatar ">
                            <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                                <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-2.jpg" alt="" class="circle" />
                                    <span class="onlinenew"></span> </div>
                                <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                    <p class="availability bluedoc-text"> <strong>Last Booking :</strong> Wed 13th April 2017, 12.35pm</p>
                                </div>
                                <div class="doc-action right"> <span class="btn secondary-content border">Book now</span></div>

                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="collection-item avatar ">
                            <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                                <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-3.jpg" alt="" class="circle" />
                                    <span class="onlinenew"></span> </div>
                                <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                    <p class="availability bluedoc-text"> <strong>Last Booking :</strong> Wed 13th April 2017, 12.35pm</p>
                                </div>
                                <div class="doc-action right"> <span class="btn secondary-content border">Book now</span></div>

                                <div class="clearfix"></div>
                            </a>
                        </li>

                    </ul>


                </div>

            </div>


            <!-- Modal Cancel Consultation -->
            <div id="cancel-consult" class="modal cancel-consult">
                <div class="modal-content">
                    <h4>Cancel Consultation</h4>
                </div>
                <p>Are you sure you want to cancel this consultation?</p>
                <p>You will/won't be refunded the booking fee.</p>
                <p class="view-policy"><a href="javascript:void(0);"> View refund policy</a></p>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
                    <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
                </div>
            </div>
            <!-- Modal Structure End -->

            <!-- Modal Reminders -->
            <div id="reminders" class="modal cancel-consult">
                <div class="modal-content">
                    <h4>Reminders</h4>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="added-rem">
                            <div class="col s2"><i class="fa fa-bell"></i></div>
                            <div class="col s6 left-align"><span>5 minutes</span></div>
                            <div class="col s2"><i class="fa fa-angle-down"></i></div>
                            <div class="col s2">
                                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="added-rem">
                            <div class="col s2"><i class="fa fa-bell"></i></div>
                            <div class="col s6 left-align"><span>2 hours</span></div>
                            <div class="col s2"><i class="fa fa-angle-down"></i></div>
                            <div class="col s2">
                                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action waves-effect waves-green btn-add-remin"> <i class="material-icons">add</i> Add Reminder</a>
                </div>
            </div>
            <!-- Modal Reminders End -->

            <!--Container End-->
        </div>

    </div>

@endsection