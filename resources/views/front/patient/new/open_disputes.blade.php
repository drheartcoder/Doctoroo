@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

<div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Disputes</h1>

    </div>


    <div class="container posrel has-header has-footer minhtnor">
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
                <div class="row pdrl" style="margin-top: 20px;">
                    <div class="input-field col s12 m12 l12 selct">
                        <select>
                            <option value="" disabled selected>Select Payment or service to dispute</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                </div>
                <div class="row pdrl" style="margin-top: 20px;">
                    <div class="input-field col s12 m12 l12   setlabel">

                        <input type="text" id="reason" class="validate ">
                        <label for="reason" class="grey-text truncate">Other</label>
                    </div>

                </div>
                <div class="row pdrl" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12   setlabel">

                        <input type="text" id="reason" class="validate ">
                        <label for="reason" class="grey-text truncate">What is the Issue? (Please provide as much details as possible )</label>
                    </div>

                </div>
                <div class="row pdrl" style="margin-top: 10px;">
                    <div class="input-field col s12 l12 m12 uploadImgnew ">
                        <div class="file-field input-field brbtmupload">
                            <div class="btn">
                                <span><i class="material-icons">camera_alt</i></span>
                                <input type="file" multiple>
                            </div>
                            <span class="textside grey-text">Upload Photos if required</span>

                        </div>
                        <div class="clr"></div>
                    </div>

                </div>

                <div class="row pdrl" style="margin-top: 10px;">
                    <div class="input-field col s12 m12 l12   setlabel">

                        <input type="text" id="reason" class="validate ">
                        <label for="reason" class="grey-text truncate">What can we do to resolve this?</label>
                    </div>

                </div>
                <a class="waves-effect waves-light futbtn" href="#disputecreate">Open Dispute</a>
            </div>
            <div id="open-dispute" class="tab-content">
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                         <span class="disputeIcon left circle center-align replied">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown20' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown20' class='dropdown-content doc-rop rightless'>
                            <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align replied">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown21' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown21' class='dropdown-content doc-rop rightless'>
                             <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align replied">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Replied on: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown22' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown22' class='dropdown-content doc-rop rightless'>
                             <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div id="closed-dispute" class="tab-content">
                <ul class="collection brdrtopsd">
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown23' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown23' class='dropdown-content doc-rop rightless'>
                             <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown24' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown24' class='dropdown-content doc-rop rightless'>
                             <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                    <li class="collection-item valign-wrapper">
                        <span class="disputeIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/handshake.svg"  />
                          
                        </span>
                        <div class="left coupon-details "><span class="title">Dispute Id: 0038844</span>
                            <small>Dispute Amount: $7.95</small>
                            <small>Dispute Closed: 03.05.2017</small>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown25' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown25' class='dropdown-content doc-rop rightless'>
                             <li><a href="consultation-invoice.html">View / Download Invoice</a></li>
                            <li><a href="disputes-details.html">View Consultation / Order Detail</a></li>
                            <li><a href="disputes.html">Dispute</a></li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>
        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>
    <!--Container End-->
    <div id="disputecreate" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Successfully Sent</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12"><p>Thank you for opening a dispute and letting us know of a fault - your feedback &amp; honesty are very much appreciated &amp; will help shape a better doctoroo for everyone to use.</p>
                    <p>We'll review your situation and make sure to act on your issue asap to reach the most reasonable resolution for you.</p></div>
            </div>
</div> 
            <div class="modal-footer center-align ">
                <a href="{{url('/patient')}}/open_disputes" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
            </div>
        
        </div>
        @endsection