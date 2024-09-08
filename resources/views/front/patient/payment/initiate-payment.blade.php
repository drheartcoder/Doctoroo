@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

<div class="mid-con min-hei">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="main-section">
                    <div class="head-title">Processing your payment</div>
                    <?php
                        /*$multipleArray['redirectTo'];*/
                    ?>
                    <form id="frmPaymentInitiate" name="frmPaymentInitiate" action="{{$redirectTo}}" method="post">
                    {{csrf_field()}}
                    <div class="whit-bg">
                        <div class="acc-bx">

                            <div class="cap-title user-box" style="text-align: center;">Please wait
                                <!-- <p>Please select the preferred payment method to use on this package.</p> -->
                            </div>

                        </div>
                        <div class="box strip-bottom m-bottom">
                            <div class="strip-bg" style="background:none;">
                                <div class="radio-btns" style="text-align: center;float: none;">
                                    <div class="radio-btn pay-i common i2" style="float: none;">
                                        <img src="{{url('')}}/public/new/images/processing.gif" alt="Loading..." >
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="info-app-cls payment-paypal paymt-sec payment-form" >
                                <div class="text-b" style="text-align: center;">
                                    <div class="pay-tril user-box">
                                        <span>We're processing your payment.</span>
                                    </div>
                                    <div class="pay-tril user-box">
                                        This process may take few minutes, so please be patient.
                                        <br>
                                        <span>Please</span> do not close this window or <span>click the Back Or Refresh button</span> on your <span>browser</span>.
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection