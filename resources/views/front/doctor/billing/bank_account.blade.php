@extends('front.doctor.layout.new_master')
@section('main_content')

 <div class="header bookhead ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    </div>
    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

     <div class="mar300  has-header minhtnor ">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab">
                    <a href="#consultation-invoices" onclick="location.href = '{{url('/')}}/doctor/billing';" ><span><img src="{{url('/')}}/public/doctor_section/images/invoice-white.svg" alt="icon" class="tab-icon"/> </span> Consultation Invoices </a>
                </li>
                <li class="tab">
                  <a href="#bank-account-details" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/bank.svg" alt="icon" class="tab-icon"/> </span> Bank Account Details</a>
                </li>
                <li class="tab">
                    <a href="#discount-codes" onclick="location.href = '{{url('/')}}/doctor/billing/my_discount';"> <span><img src="{{url('/')}}/public/doctor_section/images/discount-codes.svg" alt="icon" class="tab-icon"/> </span> My Discount Codes</a>
                </li>
            </ul>

        </div>
        
        <div id="bank-account-details" class="tab-content medi">
            <div class="doctor-container">
                <!--Medical History section -->
                <div class="head-medical-pres">
                    <h2 class="center-align">Bank Account Details </h2>
                    <span class="posleft qusame rescahnge"><a href="javascript:void(0)" onclick="window.history.back()" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                </div>
                <div>
                    <div class="row">
                        <div class="col l6 s12 ">
                            <div class="round-box z-depth-3">
                            @if(isset($arr_bank) && sizeof($arr_bank)>0) 
                                <div class="blue-border-block-top"></div>
                                
                                <div class="green-border round-box-content medication-history-details posrel space-edits" id="show_bank_details">
                                    <div class="">
                                        <div class="row ">
                                            <div class="col s12"><img src="{{url('/')}}/public/doctor_section/images/bank-icon.png" /></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12">
                                                <label class="doc-details green-text green-text-bh">
                                                    <strong class="bluedoc-text">Bank Name</strong>
                                                    <span class="bnks-txt-accnt" id="dec_bank_account_name"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text green-text-bh">
                                                    <strong class="bluedoc-text">Account Name</strong>
                                                   <span class="bnks-txt-accnt"> {{ $arr_user_data['title'].' '.$arr_user_data['first_name'].' '.$arr_user_data['last_name'] }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text green-text-bh">
                                                    <strong class="bluedoc-text">BSB</strong>
                                                    <span class="bnks-txt-accnt" id="dec_bsb"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text green-text-bh">
                                                    <strong class="bluedoc-text">Account No.</strong>
                                                    <span class="bnks-txt-accnt" id="dec_account_number"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                    <div class="center-align position-absolute">
                                        <div class="display-inline margin-top-btm"><a href="javascript:void(0)" class="bluedoc-bg btn-floating center-align white-text circle btn" id="edit_bank_details_form"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                    </div>
                                </div>

                                <div class="green-border round-box-content medication-history-details posrel " id="edit_bank_details" style="display: none;">
                                    <div class="">

                                        <div class="row ">
                                            <div class="col s12"><img src="{{url('/')}}/public/doctor_section/images/bank-icon.png" /></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12">
                                                <label class="doc-details green-text">
                                                    <strong class="bluedoc-text">Bank Name</strong>
                                                    <input type="text" name="bank_name" id="bank_name" value="{{$arr_bank['bank_account_name']}}" />
                                                </label>
                                                <div class="err" id="err_bank_name" style="display:none;"></div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text">
                                                    <strong class="bluedoc-text">Account Name</strong>
                                                    {{ $arr_user_data['title'].' '.$arr_user_data['first_name'].' '.$arr_user_data['last_name'] }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text">
                                                    <strong class="bluedoc-text">BSB</strong>
                                                    <input type="text" name="bsb" id="bsb" value="{{$arr_bank['bsb']}}" />
                                                </label>
                                                <div class="err" id="err_bsb" style="display:none;"></div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12 martp">
                                                <label class="doc-details green-text">
                                                    <strong class="bluedoc-text">Account No.</strong>
                                                    <input type="text" name="account_number" id="account_number" value="{{$arr_bank['account_number']}}" />
                                                </label>
                                                <div class="err" id="err_account_number" style="display:none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                    <div class="center-align">
                                        <div class="display-inline">
                                            <a href="javascript:void(0)" class="border-btn lnht round-corner" id="save_bank_details_form">Save</a>
                                            <a href="javascript:void(0)" id="cancel_bank_details_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="blue-border-block-bottom"></div>
                                @endif
                            </div>

                        </div>
                        <div class="col l6 s12 ">

                            <div class="round-box z-depth-3">
                                <div class="blue-border-block-top"></div>
                                <div class="green-border round-box-content medication-history-details posrel">
                                    <div  class="inner">
                                        <div class="row ">
                                            <div class="col s12"><img src="{{url('/')}}/public/doctor_section/images/stripe-icon.png" /></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col s12">
                                                <label class="doc-details martb">
                                                    <strong class="bluedoc-text">Login to your Strip Account</strong>
                                                </label>
                                                <!-- <a href="https://dashboard.stripe.com/login" target="_blank" class="bluedoc-text martb">https://dashboard.stripe.com/login</a> -->
                                                <a href="https://dashboard.stripe.com/login" class="stripe-connect" target="_blank"><span>Stripe Login</span></a>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row ">
                                            <div class="col s12">
                                                <label class="doc-details martb">
                                                    <strong class="bluedoc-text">Connect your Strip Account to Doctoroo Stripe Account</strong>
                                                </label>
                                                <a  href="https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id=ca_AvKPRFej5xooGJd43KtC5lr7eOCnNUSD&scope=read_write" class="stripe-connect" target="_blank"><span>Connect with Stripe</span></a>
                                                <!-- <a href="https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id=ca_AvKPRFej5xooGJd43KtC5lr7eOCnNUSD&scope=read_write" target="_blank" class="bluedoc-text martb">https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id=ca_AvKPRFej5xooGJd43KtC5lr7eOCnNUSD&scope=read_write</a> -->
                                                <p class="bluedoc-text">(Note: Even if you don't have account, click the link and create your own account and it will be automatically connect to Doctoroo Stripe Account)</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clr"></div>

                                </div>
                                <div class="blue-border-block-bottom"></div>
                            </div>

                        </div>
                    </div>

                </div>
                <!--Medical History section -->
            </div>
        </div>
        </div>

    <input type="hidden" id="stripe_msg" name="stripe_msg" value="{{ $stripe_msg }}">
    <a class="open_stripe_msg_popup" href="#show_stripe_msg" style="display: none;"></a>
    <div id="show_stripe_msg" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align" id="stripe_msg_text"></p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>   
        </div>     
    </div>

    <input type="hidden" id="stripe_created_count" name="stripe_created_count" value="<?php if(!empty(Session::get('stripe_created_count'))){ echo Session::get('stripe_created_count'); } else { echo '0'; } ?>">

<script type="text/javascript">
   var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
   var dumpSessionId = "{{isset($arr_bank['userinfo']['dump_session']) && $arr_bank['userinfo']['dump_session']!='' ? $arr_bank['userinfo']['dump_session'] : ''}}";
   var dumpId        = "{{isset($arr_bank['userinfo']['dump_id']) && $arr_bank['userinfo']['dump_id']!='' ? $arr_bank['userinfo']['dump_id'] : ''}}";
   var api           = virgil.API(virgilToken);
   var key           = api.keys.import(dumpSessionId);
 
   $(document).ready(function(){
       
       var bank_account_name  = "{{isset($arr_bank['bank_account_name']) && $arr_bank['bank_account_name']!='' ? $arr_bank['bank_account_name'] : ''}}";
       var bsb                = "{{isset($arr_bank['bsb']) && $arr_bank['bsb']!='' ? $arr_bank['bsb'] : ''}}";
       var account_number     = "{{isset($arr_bank['account_number']) && $arr_bank['account_number']!='' ? $arr_bank['account_number'] : ''}}";
       
       if(bank_account_name!='')
       {
         var txtbank_account_name = decrypt(api, bank_account_name, key);
         $('#dec_bank_account_name').html(txtbank_account_name);
         $('#bank_name').val(txtbank_account_name);
       }

       if(bsb!='')
       {
         var txtbsb = decrypt(api, bsb, key);
         $('#dec_bsb').html(txtbsb);
         $('#bsb').val(txtbsb);
       }

       if(account_number!='')
       {
         var txtaccount_number = decrypt(api, account_number, key);
         $('#dec_account_number').html(txtaccount_number);
         $('#account_number').val(txtaccount_number);
       }

   });

    function decrypt(api, enctext, key)
    {
        var decrpyttext = key.decrypt(enctext);
        var plaintext = decrpyttext.toString();
        return plaintext;
    }

    function encrypt(api, text, cards)
    {
      // encrypt the text using User's cards
      var encryptedMessage = api.encryptFor(text, cards);

      var encData = encryptedMessage.toString("base64");

      return encData;
    }


    $(document).ready(function(){
            var stripe_msg = $('#stripe_msg').val();
            if(stripe_msg != '')
            {
                $(".open_stripe_msg_popup").click();
                if(stripe_msg == 'success')
                {
                    var txt_stripe_msg = 'Successfully Your Stripe Account Connected to doctoroo Stripe Account!';
                }
                else if(stripe_msg == 'error')
                {
                    var txt_stripe_msg = 'Something Went Wrong! Please Try Again!';
                }
                $('#stripe_msg_text').html(txt_stripe_msg);
            }

            $('#edit_bank_details_form').click(function(){
                $('#edit_bank_details').show();
                $('#show_bank_details').hide();
            });
            $('#save_bank_details_form').click(function(){
                 var bank_name        = $('#bank_name').val();
                 var bsb              = $('#bsb').val();
                 var account_number   = $('#account_number').val();
                 var flag = 1;

                 if(bank_name == '')
                 {
                    $('#err_bank_name').show();
                    $('#err_bank_name').html('Please fill bank name.');
                    $('#err_bank_name').fadeOut(4000);
                    $('#bank_name').focus();
                    //return false;
                    flag = 0;
                 }
                 if(bsb == '')
                 {
                    $('#err_bsb').show();
                    $('#err_bsb').html('Please fill bsb.');
                    $('#err_bsb').fadeOut(4000);
                    $('#bsb').focus();
                    //return false;
                    flag = 0;
                 }
                 if(account_number == '')
                 {
                    $('#err_account_number').show();
                    $('#err_account_number').html('Please fill account no.');
                    $('#err_account_number').fadeOut(4000);
                    $('#account_number').focus();
                    //return false;
                    flag = 0;
                 }

                 if(flag == 0)
                 {
                    return false;
                 }
                 else
                 {
                    var findkey   = api.cards.get(dumpId).then(function (cards)
                    {
                      var enc_bank_name       = encrypt(api, bank_name, cards);
                      var enc_bsb             = encrypt(api, bsb, cards);
                      var enc_account_number  = encrypt(api, account_number, cards);

                        if(enc_bank_name!='' && enc_bsb!='' && enc_account_number!='')
                        {
                            var token = "<?php echo csrf_token(); ?>";
                            $.ajax({
                                url:'{{ url("/") }}/doctor/billing/update_bank_details',
                                type:'POST',
                                dataType:'json',
                                data:{_token:token, bank_name:enc_bank_name, bsb:enc_bsb, account_number:enc_account_number},
                                success:function(res){
                                    if(res.status)
                                    {
                                        $(".open_popup").click();
                                        $('.flash_msg_text').html(res.msg);
                                        
                                        $('#edit_bank_details').hide();
                                        $('#show_bank_details').show();
                                    }
                                }
                            });
                        }

                      }).then(null, function () {
                              console.log('Something went wrong.');
                                });

                      findkey.catch(function(error) {
                        console.log(error);
                      });  

                 }
            });

            $('#cancel_bank_details_form').click(function(){
                $('#edit_bank_details').hide();
                $('#show_bank_details').show();
            });
        });        

</script>

    <script type="text/javascript">
    $(document).ready(function(){
        var stripe_created_count = $('#stripe_created_count').val();
        if(stripe_created_count == '0'){
            var segment = "{{Request::segment(4)}}";
            if(segment == 'connect'){
                <?php Session::put('stripe_created_count','1'); ?>
                $(".open_popup").click();
                $('.flash_msg_text').html('Your Stripe account has been connected');
            }
        }
        $('.stripe-connect').click(function(){
            var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url:'{{ url("/") }}/doctor/billing/unset_session',
                    type:'POST',
                    dataType:'json',
                    data:{_token:token},
                    success:function(res){
                    }
                });
        });
    });
    </script>
    

  
    @endsection