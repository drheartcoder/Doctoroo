@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

<div class="mid-con min-hei">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-section">
                    <div class="head-title">Error</div>
                    <div class="whit-bg">
                        <div class="acc-bx">

                            <div class="cap-title user-box" style="text-align: center;">Error</div>

                        </div>
                        <div class="box strip-bottom m-bottom">
                            <div class="strip-bg" style="background:none;">
                                <div class="radio-btns" style="text-align: center;float: none;">
                                    <div class="radio-btn pay-i common i2" style="float: none;">
                                        <img src="{{url('')}}/public/new/images/Erroricon404.png" alt="Loading..." >
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="info-app-cls payment-paypal paymt-sec payment-form" >
                                <div class="text-b" style="text-align: center;">
                                    <div class="pay-tril user-box">
                                        <span>We are facing error while making your payment.</span>
                                        <?php
                                            if(isset($_GET['message']) && !empty($_GET['message']))
                                            {
                                                echo '<br><span>'.urldecode($_GET['message']).'</span>';
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="pay-tril user-box">
                                        <span>Grand Total: USD ${{number_format($grandTotal,2,'.','')}}</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="user-box clsUserActions" style="text-align: center;">

                                <button class="blck-btn" onclick="location.href='{{$returnPageUrl}}'" type="button">Try again</button>
                                <div class="clr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection