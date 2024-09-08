@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Disputes</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#new-dispute" class="active">New Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="#open-dispute">Open Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="#closed-dispute">Closed Disputes</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="new-dispute" class="tab-content">
                <div class="disp center-align">
                    <p>Our team cares for each of ours and can understand that sometimes things don't go as they should.</p>
                    <p>To open a new dispute regarding a previous or upcoming payment or service, click the button below.</p>
                </div>


                <a class="waves-effect waves-light futbtn" href="{{url('/patient')}}/open_disputes">Open New Dispute</a>

            </div>
            <div id="open-dispute" class="tab-content">
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align replied">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown20' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown20' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_status">Dispute Status</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align replied">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown21' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown21' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_status">Dispute Status</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align replied">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown22' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown22' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_status">Dispute Status</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div id="closed-dispute" class="tab-content">
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown23' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown23' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View / Download Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown24' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown24' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View / Download Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown25' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown25' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{ url('/patient') }}/consultation_invoice">View / Download Invoice</a></li>
                            <li><a href="{{ url('/patient') }}/disputes_details">View Consultation / Order Detail</a></li>
                            <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>
        <!--<a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_booking">Save</a>-->
    </div>
    </div>
    <!--Container End-->

@endsection