@extends('front.patient.new.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow "><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Available Doctors</h1>
    </div>

    <div id="slide-out-right" class="side-nav z-depth-2 searchpatch" >
        <div class="blueHeader">
            <div class="valign-wrapper">
                <div class="searchdoc left">Search Doctors</div>
                <div class="result">100 results</div>
                <div class="cancel right"><a href="#">Cancel</a></div>
            </div>
        </div>
        <div class="searchform">
            <div class="drname">
                <div class="input-field">
                    <input id="doctor_name" placeholder="Type here" type="text" class="validate" value="'panendine forte'">
                    <label for="doctor_name">Name of Doctor</label>
                    <a href="#" class="iconset"><i class="material-icons edit">mode_edit</i></a>
                    <a href="#" class="iconset"><i class="material-icons close">close</i></a>
                </div>
            </div>
            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select>
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                    <label>Type of Doctor</label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="other">
                <div class="input-field">
                    <label class="active" for="date">Date</label>
                    <input id="date" type="date" class="datepicker">

                </div>
            </div>

            <div class="divider"></div>
            <div class="other">
                <div class="input-field">
                    <label for="timepicker_default">Time </label>
                    <input id="timepicker_default" class="timepicker" type="time">
                </div>
            </div>
            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select>
                        <option value="" disabled>Select</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3" selected>English</option>
                    </select>
                    <label>Language</label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select>
                        <option value="" disabled>Select</option>
                        <option value="1">Male</option>
                        <option value="2" selected>Female</option>
                    </select>
                    <label>Gender</label>
                </div>
            </div>
            <div class="divider"></div>
             <div class="side-footer">
            <a href="#" class="left">CLEAR</a>
            <a href="{{ url('/patient') }}/available_doctors_3" class="right">SEARCH</a>
        </div>
        </div>
        
    </div>

    <!-- SideBar Section -->
	@include('front.patient.new.layout._sidebar')

    <div class=" app-header available-doc z-depth-2 has-header ">
        <div class="container">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col s12 l12 m12">
                    <div class="input-field searchHead button-collapse-open" data-activates="slide-out-right" class="button-collapse-open">
                        <!--            <img src="images/seach-icon.png" alt=""/>-->
                        <a href="" class="menu-icon center-align prefix"><i class="material-icons">search</i></a>
                        <input type="text" id="autocomplete-input" class="autocomplete" placeholder="Search & filter doctors">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mar300">
        <div class="container">
            <div class="available-now">
                <div class="col s12 title1">Available Now</div>

                <ul class="collection">
                    <li class="collection-item avatar ">
                        <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                            <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-1.jpg" alt="" class="circle" />
                                <span class="online"></span> </div>
                            <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                            </div>
                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">See now</span></div>

                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="collection-item avatar ">
                        <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                            <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-2.jpg" alt="" class="circle" />
                                <span class="online"></span> </div>
                            <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                            </div>
                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">See now</span></div>

                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="collection-item avatar ">
                        <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                            <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-3.jpg" alt="" class="circle" />
                                <span class="online"></span> </div>
                            <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                            </div>
                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">See now</span></div>

                            <div class="clearfix"></div>
                        </a>
                    </li>

                </ul>
                <div class="col s12 title1">Available tomorrow</div>
                <ul class="collection ava-tomorrow">
                    <li class="collection-item avatar ">
                        <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                            <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-1.jpg" alt="" class="circle" />
                                <span class="online"></span> </div>
                            <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                            </div>
                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">Book now</span></div>

                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li class="collection-item avatar ">
                        <a class="valign-wrapper" href="{{ url('/patient') }}/profile_availibility">
                            <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/avtar-2.jpg" alt="" class="circle" />
                                <span class="online"></span> </div>
                            <div class="doc-detail  left"><span class="title">Dr. Jonathan Smithonian</span>
                                <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                            </div>
                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">Book now</span></div>

                            <div class="clearfix"></div>
                        </a>
                    </li>


                </ul>

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