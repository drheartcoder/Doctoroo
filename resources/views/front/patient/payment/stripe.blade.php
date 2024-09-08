<script src="https://checkout.stripe.com/checkout.js"></script>
<script>            
function handleStripeToken(token) 
{
    $('.defaultLoader').hide();
    $("input[name='stripeToken']").val(token.id );
    $("#frmMakePayment").ajaxSubmit({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        dataType: 'json',
        beforeSend: function(data, statusText, xhr, wrapper) {
            $('.openAfterPayment').hide();
            $('.closeAfterFormOpen,.defaultLoader,.openAfterFormClose').hide();
        },
        success: function(data, statusText, xhr, wrapper){
            if(data.status == "done"){

                $('.closeAfterFormOpen,.defaultLoader,.openAfterFormClose').hide();
                $('.openAfterPayment').hide();
                location.href= data.redirectTo;
            }
            else{
                $('.openAfterPayment,.closeAfterFormOpen,.openAfterFormClose').hide();
                location.href= data.redirectTo;
            }
        },
        error: function(data, statusText, xhr, wrapper){
            $('.openAfterPayment,.closeAfterFormOpen,.openAfterFormClose').hide();
            location.href= data.redirectTo;
        }
    });
}
var handler = StripeCheckout.configure({
    key: "{{$multipleArray['stripeKey']}}",
    image: "https://stripe.com/img/documentation/checkout/marketplace.png",
    allowRememberMe: false,
    token: handleStripeToken,
    opened:function(){
        $('.defaultLoader').show();
        $('.closeAfterFormOpen,.openAfterPayment,.openAfterFormClose').hide();
    },
    closed:function(){
        $('.defaultLoader').show();
        setTimeout( function(){ 
            $('.openAfterPayment,.defaultLoader').hide();
            //$('.openAfterFormClose').show();
        },20000 );
    }
});

$(document).ready(function()
{
    handler.open({
       name: "{{$multipleArray['boxName']}}",
       description: "{{$multipleArray['boxDesc']}}",
       amount: {{$multipleArray['boxPrice']}},
       email: "{{$multipleArray['boxEmail']}}"
    });
    return false;
});
$('body').on('click','#btnRetry',function(){
    handler.open({
       name: "{{$multipleArray['boxName']}}",
       description: "{{$multipleArray['boxDesc']}}",
       amount: {{$multipleArray['boxPrice']}},
       email: "{{$multipleArray['boxEmail']}}"
    });
    return false;
});

$('body').on('click','#btnCancel',function(){
    $.alert.open('confirm', 'Are you sure want to cancel this transaction ?', function(button) {
     if (button == 'yes')
        location.href="{{$multipleArray['cancelUrl']}}";
        else if (button == 'no')
          return false;
        else
          return false;
    });
});
</script>
<div class="mid-con min-hei">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-section">
                    <div class="head-title">Make your payment</div>
                    <form id="frmMakePayment" name="frmMakePayment" action="{{$multipleArray['formAction']}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="stripeToken" value="" />
                        <div class="whit-bg closeAfterFormOpen" style="display: none;" >
                            <div class="acc-bx">
                                <div class="cap-title user-box" style="text-align: center;">Please wait</div>
                            </div>
                            <div class="box strip-bottom m-bottom">
                                <div class="strip-bg" style="background:none;">
                                    <div class="radio-btns" style="text-align: center;float: none;">
                                        <div class="radio-btn pay-i common i2" style="float: none;">
                                            <img src="{{url('')}}/front-assets/images/processing.gif" alt="Loading..." >
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="info-app-cls payment-paypal paymt-sec payment-form" >
                                    <div class="text-b" style="text-align: center;">
                                        <div class="pay-tril user-box">
                                            <span>We're processing your request.</span>
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

                        <div class="whit-bg openAfterFormClose" style="display: none;" >
                            <div class="acc-bx">
                                <div class="cap-title user-box" style="text-align: center;">Please click on below any button to complete this transaction</div>
                            </div>
                            <div class="box strip-bottom m-bottom">
                                <div class="info-app-cls payment-paypal paymt-sec payment-form" >
                                    <div class="text-b" style="text-align: center;">
                                        <div class="pay-tril user-box">
                                            <button class="blck-btn" id="btnCancel" name="btnCancel" type="button">Cancel</button>
                                        </div>
                                        <div class="pay-tril user-box">
                                            <button class="blck-btn" name="btnRetry" id="btnRetry"  type="button">Retry</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="whit-bg openAfterPayment" style="display: none;">
                            <div class="acc-bx">
                                <div class="cap-title user-box" style="text-align: center;">Please wait</div>
                            </div>
                            <div class="box strip-bottom m-bottom">
                                <div class="strip-bg" style="background:none;">
                                    <div class="radio-btns" style="text-align: center;float: none;">
                                        <div class="radio-btn pay-i common i2" style="float: none;">
                                            <img src="{{url('')}}/front-assets/images/processing.gif" alt="Loading..." >
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="info-app-cls payment-paypal paymt-sec payment-form" >
                                    <div class="text-b" style="text-align: center;">
                                        <div class="pay-tril user-box">
                                            <span>We're approving your payment.</span>
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


                        <div class="whit-bg defaultLoader" style="display: block;">
                            <div class="acc-bx">
                                <div class="cap-title user-box" style="text-align: center;">Please wait</div>
                            </div>
                            <div class="box strip-bottom m-bottom">
                                <div class="strip-bg" style="background:none;">
                                    <div class="radio-btns" style="text-align: center;float: none;">
                                        <div class="radio-btn pay-i common i2" style="float: none;">
                                            <img src="{{url('')}}/front-assets/images/processing.gif" alt="Loading..." >
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>