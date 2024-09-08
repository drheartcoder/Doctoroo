@extends('front.patient.new.layout._dashboard_master')
@section('main_content')

  <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Orders</h1>
        <div class="searchicon"><a class="menu-icon center-align button-collapse-open" data-activates="slide-out-right"><i class="material-icons">search</i> </a></div>
    </div>
    <div id="slide-out-right" class="side-nav z-depth-2 searchpatch">
        <div class="posrel">
            <div class="blueHeader">
                <div class="valign-wrapper">
                    <div class="searchdoc left">Search Orders</div>
                    <div class="result">100 results</div>
                    <div class="cancel right"><a href="#">Cancel</a></div>
                </div>
            </div>
            <div class="searchform">
                <div class="drname">
                    <div class="input-field">
                        <input id="doctor_name" placeholder="Type here" type="text" class="validate" value="'panendine forte'">
                        <label for="doctor_name">Pharmacy Name</label>
                        <a href="#" class="iconset"><i class="material-icons edit">mode_edit</i></a>
                        <a href="#" class="iconset"><i class="material-icons close">close</i></a>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="drname">
                    <div class="input-field">
                        <input id="doctor_name" placeholder="Type here" type="text" class="validate" value="'0333884'">
                        <label for="doctor_name">Order Id</label>
                        <a href="#" class="iconset"><i class="material-icons edit">mode_edit</i></a>
                        <a href="#" class="iconset"><i class="material-icons close">close</i></a>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="chooseoption">
                    <div class="input-field">
                        <select>
                            <option value="" disabled>Select</option>
                            <option value="1" selected>Lowest Price</option>
                            <option value="2">Highest Price</option>
                            <option value="3">Date</option>
                        </select>
                        <label>Sort By</label>
                    </div>
                    <!-- <div class="input-field">
                        <input id="doctor_name" placeholder="Enter Language here" type="text" class="validate" value="English">
                        <label for="doctor_name">Language</label>
                    </div>-->
                </div>
                <!--<div class="other">
                <div class="input-field">
                    <input id="doctor_name" placeholder="Enter Gender here" type="text" class="validate" value="Female">
                    <label for="doctor_name">Gender</label>
                </div>
            </div>-->
                <div class="divider"></div>

            </div>
            <div class="side-footer">
                <a href="#" class="left">CLEAR</a>
                <a href="{{ url('/patient') }}/my_orders" class="right">Apply</a>
            </div>
        </div>
    </div>
    <div id="slide-out" class="side-nav fixed menu-main">
        @include('front.patient.new.layout._sidebar')
    </div>
    <!--tab start-->

    <div class="mar300  has-header has-footer">

        <div class="consultation-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s3"><a class="active" href="#pending-order"><span><img src="{{url('/')}}/public/new/images/new-doc-icon.png" alt="icon"/> </span> Pending</a></li>
                <li class="tab col s3">
                    <a href="#past-order"> <span><img src="{{url('/')}}/public/new/images/upcuming-icon.png" alt="icon"/> </span> Past</a>
                </li>
                <li class="tab col s3">
                    <a href="#cancelled-order"> <span><img src="{{url('/')}}/public/new/images/past-icon.png" alt="icon"/> </span>Cancelled</a>
                </li>
                <li class="tab col s3">
                    <a href="#my-pharmacies"> <span><img src="{{url('/')}}/public/new/images/team-doc-icon.png" alt="icon"/> </span>My Pharmacies</a>
                </li>
            </ul>
        </div>
        <div class="medi">
            <div class="container minhtnor">

                <div id="pending-order" class="tab-content  has-footer  posrel">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            April, 2017
                        </div>
                    </div>
                    <ul class="collection brdrtopsd">
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/shop.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Chemist Warehouse Pharmacy Greystanes</small>
                                <small class="green-text">ready to collect</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown19' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown19' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/click_collect_current">View</a></li>
                                <li><a href="{{ url('/patient') }}/live_order_tracker_order_placed">Live order tracker</a></li>
                                <li><a href="{{ url('/patient') }}/click_collect_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Awaiting Pharmacy</small>
                                <small class="green-text">order sent</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown20' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown20' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/delivery_pending">View</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_order_placed">Live order tracker</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">$38.95</small>
                                <small class="green-text">order sent</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown21' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown21' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/delivery_pending">View</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_order_placed">Live order tracker</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clr"></div>
                    <div class="questiononline center-align bluedoc-text">Have a question? <a class="bluedoc-text" href="{{url('/patient')}}/faq">Visit FAQ's &amp; Support</a></div>
                </div>
                <div id="past-order" class="tab-content  has-footer  posrel">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            April, 2017
                        </div>
                    </div>
                    <ul class="collection brdrtopsd">
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/shop.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Chemist Warehouse Pharmacy Greystanes</small>
                                <small class="green-text">Collected</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown29' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown29' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/click_collect_past">View</a></li>
                                <li><a href="{{ url('/patient') }}/click_collect_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Awaiting Pharmacy</small>
                                <small class="green-text">order sent</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown30' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown30' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/delivery_past">View</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">$38.95</small>
                                <small class="green-text">order sent</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown31' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown31' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/delivery_pending">View</a></li>
                                <li><a href="{{ url('/patient') }}/delivery_edit_cancel">Edit or cancel</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clr"></div>
                    <div class="questiononline center-align bluedoc-text">Have a question? <a class="bluedoc-text" href="{{url('/patient')}}/faq">Visit FAQ's &amp; Support</a></div>
                </div>
                <div id="cancelled-order" class="tab-content  has-footer  posrel">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            April, 2017
                        </div>
                    </div>
                    <ul class="collection brdrtopsd">
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/shop.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Chemist Warehouse Pharmacy Greystanes</small>
                                <small class="red-text">Cancelled</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown22' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown22' class='dropdown-content doc-rop rightless'>

                                <li><a href="{{ url('/patient') }}/reorder">View</a></li>
                                <li><a href="{{ url('/patient') }}/reorder">Edit or restore</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">Awaiting Pharmacy</small>
                                <small class="red-text">Cancelled</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown23' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown23' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/reorder">View</a></li>
                                <li><a href="{{ url('/patient') }}/reorder">Edit or restore</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                            <div class="left coupon-details "><span class="title grey-text">Order Id: 0038844</span>
                                <small class="grey-text">$38.95</small>
                                <small class="red-text">Cancelled</small>

                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown24' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                            </div>
                            <ul id='dropdown24' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/patient') }}/reorder">View</a></li>
                                <li><a href="{{ url('/patient') }}/reorder">Edit or restore</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback or Dispute</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div id="my-pharmacies" class="tab-content  has-footer  posrel">

                    <div class="posrel " style="padding-bottom: 80px;!important">
                        <ul class="collapsible supportbox" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header active collapsehead bluedoc-text"> Click &amp; Collect Pharmacies <i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                                <div class="collapsible-body medi">
                                    <ul class="collection nopdrl brdrtopsd pdmintb ">
                                        <li class="collection-item avatar valign-wrapper ">
                                            <div class="icon-location text-center left"> <i class="material-icons font40px">add_location</i> </div>
                                            <div class="doc-detail-location big left"><span class="title"> Dr. Jonathan Smithonian</span>
                                                <small class="lht22">345 Smith Road, Greystanes, NSW 2145</small>
                                            </div>
                                            <div class="right posrel">
                                                <a href="#" data-activates='dropdown36' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown36' class='dropdown-content doc-rop rightless'>
                                                <li><a href="javascript:void(0);">View</a></li>
                                                <li><a href="javascript:void(0);">Feedback or Dispute</a></li>
                                                <li><a href="javascript:void(0);">Move to Other</a></li>
                                            </ul>

                                            <div class="clearfix"></div>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header collapsehead bluedoc-text"> Delivery &amp; other Pharmacies <i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                                <div class="collapsible-body">
                                    <ul class="collection nopdrl brdrtopsd pdmintb ">
                                        <li class="collection-item avatar valign-wrapper ">
                                            <div class="icon-location text-center left"> <i class="material-icons font40px">add_location</i> </div>
                                            <div class="doc-detail-location big left"><span class="title"> Dr. Jonathan Smithonian</span>
                                                <small class="lht22">345 Smith Road, Greystanes, NSW 2145</small>
                                            </div>
                                            <div class="right posrel">
                                                <a href="#" data-activates='dropdown37' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown37' class='dropdown-content doc-rop rightless'>
                                                <li><a href="javascript:void(0);">View</a></li>
                                                <li><a href="javascript:void(0);">Feedback or Dispute</a></li>
                                            </ul>

                                            <div class="clearfix"></div>
                                        </li>
                                       
                                        <li class="collection-item avatar valign-wrapper ">
                                            <div class="icon-location text-center left"> <i class="material-icons font40px">add_location</i> </div>
                                            <div class="doc-detail-location big left"><span class="title"> Dr. Jonathan Smithonian</span>
                                                <small class="lht22">345 Smith Road, Greystanes, NSW 2145</small>
                                            </div>

                                            <div class="right posrel">
                                                <a href="#" data-activates='dropdown38' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown38' class='dropdown-content doc-rop rightless'>
                                                <li><a href="javascript:void(0);">View</a></li>
                                                <li><a href="javascript:void(0);">Feedback or Dispute</a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </li>
                                        <li class="collection-item avatar valign-wrapper">
                                            <div class="icon-location  text-center left"> <i class="material-icons grey-text font40px">add_location</i> </div>
                                            <div class="doc-detail-location big left"><span class="title"> Dr. Jonathan Smithonian</span>
                                                <small class="lht22">345 Smith Road, Greystanes, NSW 2145</small>
                                            </div>
                                            <div class="right posrel">
                                                <a href="#" data-activates='dropdown39' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown39' class='dropdown-content doc-rop rightless'>
                                                <li><a href="javascript:void(0);">View</a></li>
                                                <li><a href="javascript:void(0);">Feedback or Dispute</a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </li>
                                        <li class="collection-item avatar valign-wrapper ">
                                            <div class="icon-location text-center left"> <i class="material-icons font40px">add_location</i> </div>
                                            <div class="doc-detail-location big left"><span class="title"> Dr. Jonathan Smithonian</span>
                                                <small class="lht22">345 Smith Road, Greystanes, NSW 2145</small>
                                            </div>
                                            <div class="right posrel">
                                                <a href="#" data-activates='dropdown40' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown40' class='dropdown-content doc-rop rightless'>
                                                <li><a href="javascript:void(0);">View</a></li>
                                                <li><a href="javascript:void(0);">Feedback or Dispute</a></li>
                                            </ul>

                                            <div class="clearfix"></div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>


                        <div class="right martp hidetext">
                            <a href="{{url('/patient')}}/add_pharmacy_order"><span class="grey-text">Add a new pharmacy</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                        </div>
                        <div class="clr"></div>



                    </div>

                </div>

                <!--Container End-->
            </div>
        </div>
    </div>

    @endsection