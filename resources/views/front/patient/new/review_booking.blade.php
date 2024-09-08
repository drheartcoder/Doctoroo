@extends('front.patient.new.layout._dashboard_master')
@section('main_content')

    <div class="header reviewhead z-depth-2 ">
        <div class="menuBtn  hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow  hide-on-large-only"><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Complete your booking request </h1>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.new.layout._sidebar')

    <div class="mar300  has-header has-footer">
        <div class="container paddingtpbtm">
            <div class="reviewsSection">
                <div class="bookingdet">
                    <div class="profilesumm">
                        <div class="row">
                            <div class="col s12 ">
                                <div class="valign-wrapper">
                                    <img src="{{ url('/') }}/public/new/images/avtar-4.png" class="circle left" />
                                    <p>Dr. Jonathan Smithonian <small><label>12.30 pm, Wed, 12th Apr</label>
                                    <label>For Chistion Nehme</label>
                                    </small></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="addpayment">
                    <div class="row">
                        <div class="col s12 ">
                            <div class="valign-wrapper">
                                <span class="circle left imgdiv"><a href="{{ url('/patient') }}/payment_method" class="center"><i class="material-icons  center">add</i></a></span>

                                <div class="input-field">
                                    <select class="icons">
                                        <option value="" disabled selected>Add Payment Method</option>
                                        <option value="" data-icon="{{ url('/') }}/public/new/images/visacard.png" class="left circle">example 1</option>
                                        <option value="" data-icon="{{ url('/') }}/public/new/images/mastercard.png" class="left circle">example 2</option>
                                        <option value="" data-icon="{{ url('/') }}/public/new/images/visacard.png" class="left circle">example 3</option>
                                    </select>
                                    <img src="{{ url('/') }}/public/new/images/cards-add.png" />
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="divider"></div>


                <div class="note"><strong>Please Note:</strong> Your card will only be charged once your doctor confirms your booking time. <a href="{{ url('/patient') }}/pricing_details" class="pricing-details right">View pricing details</a> </div>

                <div class="data-content marbookdetails">
                    <div class="invoiceDetails">

                    </div>
                    <!--total sub total start here-->
                    <div class="invoicetotal btm50">
                        <div class="row valign subtotal">
                            <div class="col s8 m10 l10 valign-nor ">
                                Booking fee + first 4 mins
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">$68.20</label>
                            </div>
                        </div>
                        <div class="row valign vouchercode">
                            <div class="col s8 m10 l10 valign-nor ">
                                <div class="input-field">
                                    <input id="voucher-code" type="text" class="validate" placeholder="Voucher Code">
                                </div>
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">-$6.40</label>
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
        <a class="waves-effect waves-light futbtn" href="#requestbooking">Request Booking</a>
    </div>
    <!-- Modal requestbooking -->
    <div id="requestbooking" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Request Booking</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s2 l2 center-align title">Time</div>
                <div class="col s10 l10"><strong>12.35pm Wed, 25th May</strong></div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">With</div>
                <div class="col s10 l10"><strong>Dr. Jonathan Smithonian</strong></div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">Cost</div>
                <div class="col s10 l10"><strong>$28</strong> booking fees include first 4 mins
                    <p><span class="title">Note:</span> You'll be charged once your doctor confirms your booking. </p>
                    <a class="greencolor">Pricing Details</a>
                </div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align">
                    <div class="input-field chkbx  center-align">
                        <input type="checkbox" class="filled-in" id="chk" />
                        <label for="chk"></label>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="col s10 l10">Notify other available doctors if this doctor doesn't respond by the booking time or within 1hour</div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="{{ url('/patient') }}/booking_request_confirmation" class="modal-action waves-effect waves-green btn-cancel-cons right ">Continue</a>
        </div>
    </div>
    <!-- Modal requestbooking End -->

@endsection