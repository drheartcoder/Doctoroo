@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

  <div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Payment Method</h1>

    </div>


    <div class="container posrel has-header has-footer">
        <div class="paymethod">
            <div class="addpayment">
                <div class="row">
                    <div class="col s12 posrel">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <div class="right posrel"> <a href="#" data-activates='dropdown2' class="dropdown-button nortpad"><i class="material-icons green-text">&#xE5D4;</i></a>
                                <ul id='dropdown2' class='dropdown-content doc-rop'>
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="addpayment">
                <div class="row">
                    <div class="col s12 posrel">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <div class="right posrel"> <a href="#" data-activates='dropdown1' class="dropdown-button nortpad"><i class="material-icons green-text">&#xE5D4;</i></a>
                                <ul id='dropdown1' class='dropdown-content doc-rop'>
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="addpayment">
                <div class="row">
                    <div class="col s12 posrel">
                        <div class="valign-wrapper">
                            <span class="circle left imgdiv"><span class="cards master"></span></span>
                            <label class="left paylabel">Mastercard 1234</label>
                            <div class="right posrel"> <a href="#" data-activates='dropdown3' class="dropdown-button nortpad"><i class="material-icons green-text">&#xE5D4;</i></a>
                                <ul id='dropdown3' class='dropdown-content doc-rop'>
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>

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
                            <a href="{{url('/patient')}}/payment_method" class="left">Add Payment Method</a>
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
                        <a class=" right border-btn round-corner">Saved Cards</a>

                    </div>
                </div>
            </div>

        </div>
        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>
    <!--Container End-->
    @endsection