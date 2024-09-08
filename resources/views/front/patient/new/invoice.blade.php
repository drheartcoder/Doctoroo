 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

 <div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Invoices &amp; Codes</h1>

    </div>


    <div class="container posrel has-header has-footer minhtnor">
        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#invoices" class="active">Invoices</a>
                </li>
                <li class="tab truncate">
                    <a href="#codes">My Codes</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="invoices" class="tab-content">
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
                        <div class="left coupon-details "><span class="title">Order Id: 0038844</span>
                            <small>Value: $7.95</small>
                            
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown19' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown19' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View / Download Invoice</a></li>
                            <li><a href="#">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/deliverytruck.svg"  />
                            <p>12 Apr</p>
                        </span>
                        <div class="left coupon-details "><span class="title">Order Id: 0038844</span>
                            <small>Value: $7.95</small>
                            
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown20' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown20' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View / Download Invoice</a></li>
                            <li><a href="#">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/doctor-invoice.svg"  />
                            <p>12 Apr</p>
                        </span>
                        <div class="left coupon-details "><span class="title">Order Id: 0038844</span>
                            <small>Value: $7.95</small>
                            
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown21' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown21' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View / Download Invoice</a></li>
                            <li><a href="#">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="codes" class="tab-content">
                <div class="gray-strip">
                    <div class="bluedoc-text">
                        Available
                    </div>
                </div>
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat">Expiry: 03.05.2017</span>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown11' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                        </div>
                        <ul id='dropdown11' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat">Expiry: 03.05.2017</span>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown12' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                        </div>
                        <ul id='dropdown12' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat">Expiry: 03.05.2017</span>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown13' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                        </div>
                        <ul id='dropdown13' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat">Expiry: 03.05.2017</span>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown14' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                        </div>
                        <ul id='dropdown14' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="gray-strip">
                    <div class="bluedoc-text">
                        Used
                    </div>
                </div>
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="used-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat">Expiry: 03.05.2017</span>
                        </div>
                        
                        <ul id='dropdown15' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>

                </ul>
                <div class="gray-strip">
                    <div class="bluedoc-text">
                        Expired
                    </div>
                </div>
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="expired-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat red-text">Expiry: 03.05.2017</span>
                        </div>
                       
                        <ul id='dropdown16' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="expired-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat red-text">Expiry: 03.05.2017</span>
                        </div>
                        
                        <ul id='dropdown17' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="expired-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                        <div class="left coupon-details "><span class="title">Code: 0038844</span>
                            <small>Value: $7.95</small>
                            <span class="stat red-text">Expiry: 03.05.2017</span>
                        </div>
                        
                        <ul id='dropdown18' class='dropdown-content doc-rop rightless'>
                            <li><a href="#">View Details</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="questiononline center-align bluedoc-text">Want Mor Codes? <a class="bluedoc-text" href="{{url('/patient')}}/search_available_doctors">Invite a friend to get a $7 code</a></div>

            </div>


        </div>
        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>
    <!--Container End-->
    @endsection