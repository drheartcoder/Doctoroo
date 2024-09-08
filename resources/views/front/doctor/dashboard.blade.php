@extends('front.doctor.layout.new_master') @section('main_content')

<div class="header bookhead ">
    <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

    <h1 class="main-title center-align">Home</h1>
</div>

<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')

<div class="mar300  has-header has-footer minhtnor">
    <div id="patient" class="tab-content medi ">
        <form id="add_details_form">
            <div class="doctor-container">
                <div class="row">
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 posrel">
                            <div class="heading-round-box">New Consultaion Requests</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Tony Jacson 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="clr"></div>
                            </div>
                            
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> View All consultations </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Upcoming Consultaion</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Tony Jacson 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> View All consultations </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">My Patients</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Tony Jacson 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>

                                <div class="clr"></div>
                            </div>
                            
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> View All Patients </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 posrel">
                            <div class="heading-round-box">Messages</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Tony Jacson 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="clr"></div>
                            </div>
                            
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> View All Messages </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Notifications</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Tony Jacson 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> View All Notifications </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col s6 m6 l6 xl4 s12 col-responsiv">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Schedule Availability</div>
                            <div class="dash-date-main for-height">
                                <div class="dash-time-date-main">
                                    <span>John Smith 03.01.18 11:50AM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="dash-time-date-main">
                                    <span>Anna Thonas 03.05.18 07:50PM</span> <a href="javascript:void(0)" class="dadh-details">Details</a>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="table-cell center-align dash">
                               <a href="javascript:void(0)" class="btn"> Open Calender </a>
                            </div>

                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
</div>

@endsection