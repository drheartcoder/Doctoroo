@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

    <div class="header pharmacydetailhead z-depth-2">
        <div class="backarrow"><a href="{{url('/patient')}}/add_pharmacy_order" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align truncate">Priceline Pharmacy Sydney West</h1>
    </div>
    <div class="container posrel has-footer">
        <div class="consultation-details">
            <div class="pharmacy-banner">
                <img src="{{url('/')}}/public/new/images/pharmacy-banner.png" class="responsive-img" />
            </div>
            <div class="sub-header  z-depth-2">

                <div class="row detInfo">
                    <div class="col s12 m12 l12 left-align">
                        <div class="valign-wrapper">
                            <div class="icon-location text-center left"> <i class="material-icons green-text">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate  green-text"> This is a doctoroo pharmacy &amp; is ready to take your order.</span>
                            </div>


                            <div class="clearfix"></div>
                        </div>
                        <!--<div class="data">
                            <small>This is a doctoroo pharmacy & is ready to take your order.</small></div>-->
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">call</i></a>


            </div>
            <div class="pdtbrl">
                <label class="call-pharmacy valign-wrapper"><i class="material-icons blue-text">call</i> (02) 8521 5520</label>
                <label class="call-pharmacy valign-wrapper"><i class="material-icons blue-text">call</i> (02) 8521 5520</label>
                <label class="website-pharmacy valign-wrapper"><i class="material-icons blue-text">public</i> www.westchemistpharmacy.com.au</label>
                <label class="location-pharmacy valign-wrapper"><i class="material-icons green-text">add_location</i> 45 Smith Road, Greystanes, NSW 2145</label>
                <div class="map">
                    <div class="wid100 marbtm"><img class="responsive-img" src="{{url('/')}}/public/new/images/map-pharmacy.png" /></div>
                    <div class="center">
                        <a href="#" class="dark-grey-text marmain texttransform">Open Map View</a>
                        <a href="#" class="dark-grey-text marmain texttransform">Get Directions</a>
                    </div>
                </div>
                <div class="divider martp"></div>
                <div class="pharmacyInfo">
                    <ul class="collapsible no-shadow" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header active"><i class="material-icons blue-text leftic">query_builder</i>Opening Hours<i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div class="col l6 m6 s6">Friday </div>
                                    <div class="col l6 m6 s6">Open 24 hours</div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m6 s6">Friday </div>
                                    <div class="col l6 m6 s6">Open 24 hours</div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m6 s6">Friday </div>
                                    <div class="col l6 m6 s6">Open 24 hours</div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m6 s6">Friday </div>
                                    <div class="col l6 m6 s6">Open 24 hours</div>
                                </div>
                            </div>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header active"><i class="material-icons blue-text leftic">query_builder</i>Service Provider<i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body">
                                <ul class="pharmacy-service">
                                    <li>Offer Click & Collect</li>
                                    <li>Passport Photos</li>
                                    <li>Specialised Compounding</li>
                                </ul>
                            </div>
                            <div class="divider"></div>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="divider"></div>
            <div class="pdrl"><a class="valign-wrapper martp grey-text" href="javascript:void(0)" > <i class="material-icons grey-text circle editicon center-align">edit</i> <em>Suggest an Edit</em></a></div>
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_order">Select this pharmacy</a>
    </div>

    <!--Container End-->
    @endsection