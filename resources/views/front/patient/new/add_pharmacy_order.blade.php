@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

    <div class="header ordermedHead z-depth-2">
        <div class="backarrow "><a href="{{url('/patient')}}/my_orders" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Add Pharmacy</h1>
    </div>
    <div class="container posrel has-header has-footer minhtnor">
        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#list" class="active">LIST</a>
                </li>
                <li class="tab truncate">
                    <a href="#map">MAP</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="list" class="tab-content">
                <div class="marmain">
                    <div class="input-field targeticon">
                        <input id="search" type="text" class="validate" placeholder="Search Suburb or Postcode">
                    </div>
                    <div class="clr"></div>
                    <ul class="collection nobrdr brdrtopsd pdmintb">
                        <li class="collection-item avatar">
                            <a href="{{ url('/patient') }}/pharmacy_details" class="valign-wrapper"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                <small>345 Smith Road, Greystanes, NSW 2145</small>
                            </div>
                            <div class="right posrel"> </div>

                            <div class="clearfix"></div>
                                </a>
                        </li>
                        <li class="collection-item avatar">
                            <a href="{{ url('/patient') }}/pharmacy_details" class="valign-wrapper"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                <small>345 Smith Road, Greystanes, NSW 2145</small>
                            </div>
                            <div class="right posrel"> </div>

                            <div class="clearfix"></div>
                                </a>
                        </li>
                        <li class="collection-item avatar">
                            <a href="{{ url('/patient') }}/pharmacy_details" class="valign-wrapper"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                <small>345 Smith Road, Greystanes, NSW 2145</small>
                            </div>
                            <div class="right posrel"> </div>

                            <div class="clearfix"></div>
                                </a>
                        </li>
                        <li class="collection-item avatar">
                            <a href="{{ url('/patient') }}/pharmacy_details" class="valign-wrapper"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                <small>345 Smith Road, Greystanes, NSW 2145</small>
                            </div>
                            <div class="right posrel"> </div>

                            <div class="clearfix"></div>
                                </a>
                        </li>
                        <li class="collection-item avatar">
                            <a href="{{ url('/patient') }}/pharmacy_details" class="valign-wrapper"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                <small>345 Smith Road, Greystanes, NSW 2145</small>
                            </div>
                            <div class="right posrel"> </div>

                            <div class="clearfix"></div>
                                </a>
                        </li>
                    </ul>
                    <div class="divider"></div>

                    <div class="pdrl footstck">
                        <div class="container">
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <div class=" smalltext ">
                                        <a href="#" class="grey-text valign-wrapper"><img src="{{url('/')}}/public/new/images/store-grey-small.svg" class="shopgry" />How click and collect?</a>
                                    </div>
                                </div>
                                <div class="col l6 m6 s6">
                                    <div class=" smalltext right">
                                        <a href="#" class="grey-text  valign-wrapper"><img src="{{url('/')}}/public/new/images/delivery-truck-grey.svg" class="shopgry" />Change to delivery</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map" class="tab-content has-tab ">
                <div class="marmain" >
                    <div class="input-field targeticon">
                        <input id="search" type="text" class="validate" placeholder="Search Suburb or Postcode">
                    </div>
                    <div class="clr"></div>
                    <ul class="collection nobrdr brdrtopsd pdmintb" >

                        <li class="collection-item avatar ">
                            <div class="wid100 marbtm"><img class="responsive-img" src="{{url('/')}}/public/new/images/map-pharmacy.png" /></div>
                            <div class="valign-wrapper">
                                <div class="icon-location  text-center left"> <i class="material-icons grey-text">add_location</i> </div>
                                <div class="doc-detail-location big left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                                    <small>345 Smith Road, Greystanes, NSW 2145</small>
                                </div>
                                <div class="right posrel"> </div>
                            </div>
                            <div><span class="right qusame marbtm"><a href="{{url('/patient')}}/pharmacy_details" class="btn cart bluedoc-bg lnht round-corner">Select</a></span></div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                    <div class="divider"></div>
                    <div class="pdrl footstck">
                        <div class="container">
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <div class=" smalltext ">
                                        Can't find your pharmacy? <a href="{{ url('/patient') }}/invite_pharmacy" class="grey-text ">click here</a>
                                        <a href="#" class="grey-text valign-wrapper mrt"><img src="{{url('/')}}/public/new/images/delivery-truck-grey.svg" class="shopgry"  />Change to delivery</a>
                                    </div>
                                </div>
                                <div class="col l6 m6 s6">
                                    <div class=" smalltext right">
                                        <div class="icon-location  text-center left"> <i class="material-icons green-text">add_location</i></div> <div class="icon-location  text-center left">  <i class="material-icons ">add_location</i> </div><div class="clr"></div>
                                        <a href="#" class="grey-text">What's this?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

            </div>


        </div>
        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>

    @endsection