@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')


    <div class="header consultation-detailshead z-depth-2">
        <div class="backarrow"><a href="{{ url('/patient') }}/consultation_details" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align">Invoice 0985110</h1>

        <div class="menu-dotted posrel"><a class="dropdown-button center-align " href="javascript:void(0);" data-activates="dropdown1"><i class="material-icons">&#xE5D4;</i></a>
            <ul id="dropdown1" class="dropdown-content doc-rop">
                <li><a href="#resechdule">Reschedule Booking</a></li>
                <li><a href="javascript:void(0);">Complete Medical History</a></li>
                <li><a href="#cancel-consult">Cancel Booking</a></li>
            </ul>
        </div>
        <div class="download"><a href="#" class="center-align"><i class="material-icons">&#xE2C4;</i></a></div>
    </div>
    
    <div class="container">
        <div class="consultation-details">
            <div class="sub-header  z-depth-2">
                <div class="row detInfo">
                    <div class="col s6 m6 l6 left-align">
                        <div class="data">
                            <small>T0:</small>
                            <strong class="white-text">Customer Name</strong>
                            <label class="white-text address">
                                277 Granville Street, Branville, NSW 2160
                            </label>

                        </div>

                    </div>
                    <div class="col s6 m6 l6">
                        <div class="data right"><small>FROM:</small>
                            <strong class="white-text">Doctoroo Australia Pty. Ltd.</strong>
                            <label class="white-text address">
                                Level 13, 50 Carrington St, Sydney NSW, 2000
                            </label>
                            <span class="abnnum"><em>ABN: 15 616 602 629</em></span>
                        </div>
                    </div>
                </div>
                <div class="row detInfo mrtp">
                    <div class="col s12 m12 l12 left-align">
                        <div class="data left">
                            <label class="white-text">$38555.50</label>
                            <small>Total</small></div>
                        <div class="data left">
                            <label class="white-text">Credit Card ****3345</label>
                            <small>Payment method</small></div>
                        <div class="data left">
                            <label class="white-text">Unpaid</label>
                            <small>Payment Status</small></div>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>


            </div>
            <div class="time-date ">
                <div class="row">
                    <div class="col s7 m6 l5"> <img src="{{ url('/') }}/public/new/images/clock-icon.png" alt="" />

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

            <div class="data-content marbookdetails">
                <div class="invoiceDetails ">
                    <div class="listDivider">
                        <div class="row ">
                            <div class="col s8 m10 l10">Item</div>
                            <div class="col s4 m2 l2">Amount</div>
                        </div>
                    </div>
                    <!--invoice items start here-->
                    <div class="listitems">
                        <div class="row valign">
                            <div class="col s8 m10 l10 valign-nor ">
                                <span class="itemliid">Consultation ID: 00884775</span> <span class="itemliname">Consultation with Dr. Jonathan Smithonian</span>
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">$48</label>
                            </div>
                        </div>
                    </div>
                    <!--invoice items end here-->
                </div>
                <!--total sub total start here-->
                <div class="invoicetotal">
                    <div class="row valign subtotal">
                        <div class="col s8 m10 l10 valign-nor ">
                            SUBTOTAL
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">$68.20</label>
                        </div>
                    </div>
                    <div class="row valign subtotal">
                        <div class="col s8 m10 l10 valign-nor ">
                            GST
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">$6.40</label>
                        </div>
                    </div>
                    <div class="row valign total">
                        <div class="col s8 m10 l10 valign-nor ">
                            TOTAL
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">$86.70</label>
                        </div>
                    </div>
                </div>
                <!--total sub total end here-->
            </div>

        </div>
    </div>

    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="{{ url('/patient') }}/cancellation_refunds"> View refund policy</a></p>
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
            <a href="{{ url('/patient') }}/online_waiting_room" class="modal-action waves-effect waves-green btn-cancel-cons right cnclbook ">Cancel Booking</a>
        </div>
    </div>
     <!-- Modal reason for cancellation ends-->

    <!-- Modal Reminders -->
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
    <!-- Modal Reminders End -->

@endsection