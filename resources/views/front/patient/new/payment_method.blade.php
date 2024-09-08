@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

<div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="review-booking.html" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Select Payment Method</h1>

    </div>
   
    
    <div class="container posrel has-header has-footer">
        <div class="paymethod">
            <div class="addpayment">
                <div class="row">
                    <div class="col s12 ">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <i class="material-icons right absright">chevron_right</i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="addpayment">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <i class="material-icons right absright">chevron_right</i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="addpayment">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <i class="material-icons right absright">chevron_right</i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="addpayment">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><i class="material-icons  center">add</i></span>
                            <a href="{{url('/patient')}}/payment_method"" class="left">Add Payment Method</a>
                            <i class="material-icons right absright">chevron_right</i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="savedcards">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper space">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>

                            <div class="right addcards">
                                <div class="input-field cardnum">
                                    <input id="last_name" type="text" class="validate" placeholder="Card Number">
                                    <span class="check right"><i class="material-icons">done</i></span>
                                </div>
                                <div class="input-field  left exp">
                                    <input id="exp" type="text" class="validate" placeholder="Expiry (MM/YY)">
                                    <span class="check right"><i class="material-icons">done</i></span>
                                </div>
                                <div class="input-field right cvv">
                                    <input id="cvv" type="text" class="validate" placeholder="CVV">
                                    <span class="check right"><i class="material-icons">done</i></span>
                                </div>

                            </div>
                        </div>
                        <button class="btn right savebtn">Saved Cards</button>

                    </div>
                </div>
            </div>

        </div>
        <a class="waves-effect waves-light futbtn" href="{{url('/patient')}}/review_booking">Save</a>
    </div>
    <!--Container End-->
    @endsection