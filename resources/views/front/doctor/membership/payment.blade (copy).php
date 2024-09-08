@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>
    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">
        <div class="bluedoc-bg center-align white-text" style="padding:10px; font-size: 14px; ">
            You're one step closer to beginning your membership
        </div>

        <div class="doctor-container">
            <div class="row">
                <div class="col l4 s12">
                    <div class="z-depth-3 round-box">
                        <div class="blue-border-block-top"></div>
                        <div class="round-box-content">
                            <div class="heading-past-details-new">
                                Membership Plan 
                            </div>
                            <div class="row membership-text">
                                <div class="col s6  right-align truncate">Membership</div>
                                <div class="col s6" id="membership_amt">{{isset($membership_plan_arr['monthly_amount']) ? '$'.$membership_plan_arr['monthly_amount'] : '' }}</div>
                            </div>
                            
                            <!-- <div class="row membership-text">
                                <div class="col s6 right-align"><u><a href="#discount_code_popup" class="view-details-btn green-text">Voucher Code</a></u></div>
                                <div class="col s6 green-text" id="show_voucher_code">Apply Code</div>
                            </div> -->
                            
                            <div class="row membership-text">
                                <input type="text" name="voucher_code" id="voucher_code" placeholder="Enter voucher code">
                                <div id="err_voucher_code" style="color:red;"></div>
                                <div id="succ_voucher_code" style="color:green;"></div>
                                <button type="submit" id="apply_code" class="btn cart round-corner lnht">Apply Code</button>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('#apply_code').click(function(){
                                       var voucher_code = $('#voucher_code').val();
                                       $('#err_voucher_code').html('');
                                       $('#succ_voucher_code').html('');
                                       
                                       if(voucher_code == ""){
                                          $('#err_voucher_code').html('Please enter voucher code');
                                          return false;
                                       }else {


                                            var _token = "<?php echo csrf_token(); ?>";
                                            $.ajax({
                                                url:'{{ url("/") }}/doctor/membership/check_voucher_code_available',
                                                type:'get',
                                                data:{_token:_token,voucher_code:voucher_code},
                                                success:function(result){
                                                    var data = new Array();
                                                    data     = result.split('_|_');
                                                    if(data[0] == 'error'){
                                                      $('#err_voucher_code').html(data[1]);
                                                      return false;          
                                                    }else if(data[0] == 'success'){
                                                        var percentage  = data[2];     
                                                        var discount_id = data[3];
                                                        var code        = voucher_code;
                                                        var base_price  = $('#txt_membership_base_price').val();
                                                        var gst_amt     = $('#txt_membership_base_gst').val();
                                                        
                                                        if(base_price == '' || base_price == null)
                                                        {
                                                            base_price = {{ isset($membership_plan_arr['monthly_amount']) ? $membership_plan_arr['monthly_amount'] : '' }};
                                                            gst_amt = {{ isset($membership_plan_arr['monthly_gst']) ? $membership_plan_arr['monthly_gst'] : '' }};
                                                        }

                                                        var discount_price = base_price * (percentage / 100);
                                                        var after_discount = base_price - discount_price;
                                                        var new_price = parseFloat(after_discount) + parseFloat(gst_amt);
                                                        
                                                        $('#total_amt').html('$'+new_price.toFixed(2));
                                                        $('#membership_price').val(new_price.toFixed(2));
                                                        //$('#show_voucher_code').html(percentage+'%');
                                                        $('#discount_id').val(discount_id);

                                                        $('#succ_voucher_code').html(data[1]);
                                                    }
                                                }
                                            });
                                       }
                                    });
                                });
                            </script>

                            <div class="row membership-text">
                                <div class="col s6 right-align">GST</div>
                                <div class="col s6" id="gst_amt">{{isset($membership_plan_arr['monthly_gst']) ? '$'.$membership_plan_arr['monthly_gst'] : '' }}</div>
                            </div>
                        </div>
                       <div class="heading-round-box-green">
                            <div class="row">
                                <div class="col s6 right-align">Total</div>
                                <div class="col s6 left-align" id="total_amt">{{isset($membership_plan_arr['total_monthly_amount']) ? '$'.$membership_plan_arr['total_monthly_amount'] : '' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="z-depth-3 round-box">
                        <div class="blue-border-block-top"></div>
                        <div class="round-box-content">
                            <div class="heading-past-details-new">
                                Your Premium Membership
                            </div>
                             <div class="row membership-text">
                                <div class="col s6 right-align">Type</div>
                                <div class="col s6">{{ isset($membership_arr['package']) && $membership_arr['package'] == 'annually' ? 'Annually' : ''  }}
                                {{ isset($membership_arr['package']) && $membership_arr['package'] == 'monthly' ? 'Monthly' : ''  }}
                                </div>
                            </div>
                            <div class="row membership-text">
                                <div class="col s6 right-align">Start Date</div>
                                <div class="col s6">{{ isset($membership_arr['start_date']) ? date('d M Y' , strtotime($membership_arr['start_date'])) : 'NA'  }}
                                </div>
                            </div>
                            <div class="row membership-text">
                                <div class="col s6 right-align">End Date</div>
                                <div class="col s6">{{ isset($membership_arr['end_date']) ? date('d M Y' , strtotime($membership_arr['end_date'])) : 'NA'  }}
                                </div>
                            </div>
                        </div>
                        @if(isset($membership_arr['package']) && $membership_arr['package'] == 'monthly')
                            <div class="heading-round-box-green">
                                <div class="row">
                                    @if(isset($membership_arr['next_month_membership']) && $membership_arr['next_month_membership'] == 'yes')
                                        <div class="col s12 m12 center-align"><a href='#cancel_next_month_membership_popup' style="color:white;">Cancel</a></div>
                                    @elseif($membership_arr['next_month_membership'] && $membership_arr['next_month_membership'] == 'no') 
                                        <div class="col s12 m12 center-align"><a href='#get_next_month_membership_popup' style="color:white;">Continue</a></div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col l8 s12">
                    <div class="z-depth-3 round-box">
                        <div class="blue-border-block-top"></div>
                        <div class="round-box-content">
                            <ul class="membership-points">
                                <li>You may change your membership at anytime</li>
                                <li>Start practicing online almost instantly!</li>
                            </ul>
                            @php
                                $monthly_amount = isset($membership_plan_arr['total_monthly_amount']) ? '$'.$membership_plan_arr['total_monthly_amount'] : '';

                                $monthly_discount = isset($membership_plan_arr['monthly_discount']) ? $membership_plan_arr['monthly_discount'].'%' : '';

                                $annually_amount = isset($membership_plan_arr['total_annually_amount']) ? '$'.$membership_plan_arr['total_annually_amount'] : '';

                                $annually_discount = isset($membership_plan_arr['annually_discount']) ? $membership_plan_arr['annually_discount'].'%' : '';
                            @endphp
                            <form id="payment_card_form">
                                <div class="payment-box">
                                    <ul class="payment-option">
                                        <li>
                                            <div class="radio-input">

                                                <?php if(!empty(\Session::get('mem_package')) && \Session::get('mem_package') =="monthly"){ 
                                                 ?>
                                                 <script type="text/javascript">
                                                    $(document).ready(function(){
                                                        setTimeout(function(){
                                                         $('#monthly').click();
                                                        },200);
                                                    });
                                                 </script>
                                                 <?php
                                                }else if(!empty(\Session::get('mem_package')) && \Session::get('mem_package') =="annually"){ 
                                                  ?>
                                                  <script type="text/javascript">
                                                    $(document).ready(function(){
                                                        setTimeout(function(){
                                                         $('#annual').click();
                                                        },200);
                                                    });
                                                  </script>
                                                 <?php
                                                } ?>


                                                <input name="package" class="package" type="radio" value="monthly" id="monthly" >
                                                <label for="monthly">Monthly - {{ $monthly_amount }} (inc. GST)
                                                @if(!empty($monthly_discount) && $monthly_discount != null && $monthly_discount != 0)
                                                    <span class="badge">Save {{ $monthly_discount }}</span>
                                                @endif
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-input">
                                                <input name="package" class="package" value="annually" type="radio" id="annual" >
                                                <label for="annual" class="left-100px-pad">Annually - {{ $annually_amount }} (inc. GST) <small>Billed {{ $annually_amount }} AUD every 6 months</small>
                                                @if(!empty($annually_discount) && $annually_discount != null && $annually_discount != 0)
                                                    <span class="badge">Save {{ $annually_discount }}</span>
                                                @endif
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="card-option">
                                        @if(isset($payment_methods))
                                            @foreach($payment_methods as $val)
                                                <li>
                                                    @php 
                                                        $checked = '';

                                                        if(Session::has('last_payment_method_id') && Session::get('last_payment_method_id') == $val['id'])
                                                        {
                                                            $checked = 'checked';
                                                        }                          
                                                        else
                                                        {
                                                            $checked = '';
                                                        }

                                                        $card_id = isset($val['id']) ? $val['id'] : '';
                                                        $temp_no = $val['card_no'];
                                                        $card_no = str_pad($temp_no, 16, "X", STR_PAD_LEFT);

                                                    @endphp
                                                    <div class="radio-input">
                                                        <input name="payment_card" type="radio" id="{{ $card_id }}" {{ $checked }}>
                                                        <label for="{{ $card_id }}"  data-card_id="{{ $val['id'] }}" class="visa selected_card">{{ $card_no }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                    <a href="javascript:void(0)" class="add-card" id="add_card">Add new card</a>

                                        <div class="add-new-card-fields" id="add_card_fields" style="display: none">
                                            
                                                <div class="card-details">
                                                    <div class="input-field  card-num">
                                                        <input  placeholder="Card Number" id="card_number" onkeyup="detectCardType(this.value)" type="text" class="validate">
                                                        <span class="card-img" id="detect_card"></span>
                                                        <p class="error-msg"></p>
                                                    </div>
                                                
                                                    <div class="input-field  card-expiry">
                                                        <input  placeholder="MM / YY" type="text" id="card_expiry_date" class="validate number" maxlength="5">
                                                        <p class="error-msg"></p>
                                                    </div>
                                                    <div class="input-field  card-cvv">
                                                        <input placeholder="CVC" id="cvv_number" type="text" class="validate" maxlength="4">
                                                        <p class="error-msg"></p>
                                                    </div>
                                                    <div class="clr"></div>
                                                    <div >
                                                        <a href="" class=" btn btn-block bluedoc-bg " id="btn_add_payment_method">Add</a>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            </form>

                            <form method="post" action="{{ url('/') }}/patient/booking/payment/stripe/membershipPayment">
                                <input type="hidden" class="card_id" id="card_id" name="card_id" value="">
                                <input type="hidden" id="membership_price" name="membership_price">
                                <input type="hidden" id="membership_package" name="membership_package">
                                <input type="hidden" id="discount_id" name="discount_id">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" id="btn_confirm_payment"  class="btn cart round-corner lnht">Confirm Payment</button>
                            </form>
                            
                            <div class="note-security">
                                <p class="bluedoc-text">Your payment details are safe. any payment on our platform is encrypted by Industry Standard 128 SSl</p>
                                <p>You authorise doctoroo to charge your card on the subscription period until your membership is cancelled. <a href="javascript:void(0)" class="green-text">Full terms available here.</a> </p>
                            </div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="payment_error_msg" id="payment_error_msg" name="payment_error_msg" value="{{ Session::get('message') }}" style="display: none;"/>
    <a class="open_payment_popup" href="#payment_err_msg" style="display: none;"></a>
    <div id="payment_err_msg" class="modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                     <p class="center-align">{{ Session::get('message') }}</p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>     
    </div>

    <a class="select_payment_card_popup" href="#select_card_error" style="display: none;"></a>
    <div id="select_card_error" class="modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p id="select_card_error_msg" class="center-align"></p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>     
    </div>

    <div id="cancel_next_month_membership_popup" class="modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                     <p class="center-align">Do you really want to cancel next month membership payment?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">cancel</a>
            <a href="javascript:void(0)" class="waves-effect waves-green btn-cancel-cons" id="cancel_membership_btn">Yes</a>
        </div>
    </div>

    <div id="get_next_month_membership_popup" class="modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align">Do you really want to pay for next month membership?</p>
                </div>
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">cancel</a>
            <a href="javascript:void(0)" class="waves-effect waves-green btn-cancel-cons" id="get_membership_btn">Yes</a>
        </div>     
    </div>

    <!-- Pricing Details Modal Start -->
    <div id="discount_code_popup" class="modal addperson fade big-modal" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none; max-width: 1000px; top: 20%;">
        <div class="model-wraper2">
            <div class="modal-content">
                <h4 class="center-align">Pricing Details</h4>
                <a class="modal-close closeicon">
                    <i class="material-icons">close</i>
                </a>
            </div>
            <div class="modal-data scroll-div">
                <div class="pricescetion">
                    <h3 class="ques">How much does it cost to see a doctor?</h3>
                    <div class="row">
                        <div id="test1" class="col s12 padno">
                            <table class="bordered striped">
                                <thead>
                                    <tr style="background: #22b14c;">
                                        <th class="center-align">Code</th>
                                        <th class="center-align">Percentage</th>
                                        <th class="center-align">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($discount_data) > 0)
                                    @foreach($discount_data as $dis_data)
                                        @if($dis_data['used_discount']['doctor_id'] != $current_doctor_id)
                                            <tr>
                                                <td class="center-align">{{ $dis_data['code'] }}</td>
                                                <td class="center-align">{{ $dis_data['percentage'].'%' }}</td>
                                                <td class="center-align"><span class="apply_code" data-discount_id="{{ $dis_data['id'] }}" data-code="{{ $dis_data['code'] }}" data-percentage="{{ $dis_data['percentage'] }}" style="text-decoration: underline; cursor: pointer;">Apply</span></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr><td class="center-align no-data" colspan="3">No Discount Available</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer center-align">
                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Close</a>
            </div>
        </div>
    </div>
    <!-- Pricing Details Modal End -->

    <input type="hidden" id="txt_membership_base_price" name="txt_membership_base_price" style="display: none;"/>
    <input type="hidden" id="txt_membership_base_gst" name="txt_membership_base_gst" style="display: none;"/>
    <script>
        var url = "<?php echo $module_url_path; ?>";
        $(document).ready(function(){
            var err_msg = $('#payment_error_msg').val();
            if(err_msg != '')
            {
                $(".open_payment_popup").click();
            }

            $('#payment_err_msg .modal-close').click(function(){
                window.location = url+"/billing";
            });

            $('input.number').keyup(function(event){
                var inputLength = event.target.value.length; 
                if(inputLength === 2 || inputLength === 5)
                {
                  var thisVal = event.target.value;
                  if(inputLength<5)
                  {
                    thisVal += '/';
                  $(event.target).val(thisVal);  
                  }
                }
            });

            $("#card_number").bind('input', function(e) {
                var number = $(this).val();
                detectCardType(number);
            });

            $('.selected_card').click(function(){
                var card_id = $(this).data("card_id");
                $('#card_id').val(card_id);
            });

            $('#btn_confirm_payment').click(function(){
                var card_id = $('#card_id').val();

                if($('#membership_package').val() == '' || $('#membership_package') == null )
                {
                    $('.select_payment_card_popup').click();
                    $('#select_card_error_msg').html('Please Select Package');
                    return false;
                }
                else if(card_id == '' || card_id == null)
                {
                    $('.select_payment_card_popup').click();
                    $('#select_card_error_msg').html('Please Select Card');
                    return false;
                }
            });

            $('.package').change(function(){
                $('#membership_package').val($(this).val());
                membership_package = $(this).val();

                var membership_amt = "";
                var voucher_code = "";
                var gst = "";
                var package_type = "";

                if(membership_package == 'annually')
                {
                   var membership_amt = {{ isset($membership_plan_arr['annually_amount']) ? $membership_plan_arr['annually_amount'] : '' }};
                   var voucher_code = "0";
                   var gst = {{ isset($membership_plan_arr['annually_gst']) ? $membership_plan_arr['annually_gst'] : '' }};
                   var package_type = "Annually";
                   var total_amt = {{ isset($membership_plan_arr['total_annually_amount']) ? $membership_plan_arr['total_annually_amount'] : '' }};
                }
                else if(membership_package == 'monthly')
                {
                   var membership_amt = {{ isset($membership_plan_arr['monthly_amount']) ? $membership_plan_arr['monthly_amount'] : '' }};
                   var voucher_code = "0";
                   var gst = {{ isset($membership_plan_arr['monthly_gst']) ? $membership_plan_arr['monthly_gst'] : '' }};
                   var package_type = "Monthly";
                   var total_amt = {{ isset($membership_plan_arr['total_monthly_amount']) ? $membership_plan_arr['total_monthly_amount'] : '' }};
                }

                $('#membership_amt').html('$'+membership_amt);
                $('#txt_membership_base_price').val(membership_amt);
                $('#voucher_code').html(voucher_code);
                $('#gst_amt').html('$'+gst);
                $('#txt_membership_base_gst').val(gst);
                $('#package_type').html(package_type);
                $('#total_amt').html('$'+total_amt);
                $('#membership_price').val(total_amt);

                $('#show_voucher_code').html('Apply Code');
            });

            $('#add_card').click(function(){
                $('#add_card_fields').toggle(300);
            });

            $('#btn_add_payment_method').click(function(e){

                e.preventDefault();
                var Package = $("input[name='package']:checked").val();
            
                var card_no = $('#card_number').val();
                var card_expiry_date = $('#card_expiry_date').val();
                var cvv = $('#cvv_number').val();

                $('.error-msg').html('');
                $('.error-msg').show();
                $('.card_expiry_date_err').html('');

                if($('#card_number').val()=='')
                {
                    $('#card_number').next('span').next('p').html("Please Enter Card number");
                    $('#card_number').next('span').next('p').fadeOut(4000);;
                    return false;
                }

                var card_type = '';
                card_type = detectCardType(card_no);

                function validateCardNumber(number)
                {
                    var regex = new RegExp("^[0-9]{16}$");
                    if (!regex.test(number))
                        return false;

                    return luhnCheck(number);
                }

                function luhnCheck(val)
                {
                    var sum = 0;
                    for (var i = 0; i < val.length; i++)
                    {
                        var intVal = parseInt(val.substr(i, 1));

                        if (i % 2 == 0) 
                        {
                            intVal *= 2;

                            if (intVal > 9)
                             {
                                intVal = 1 + (intVal % 10);
                             }
                        }

                        sum += intVal;
                    }
                    return (sum % 10) == 0;
                }

                var res = validateCardNumber(card_no);

                if(res == false)
                {
                     $('#card_number').next('span').next('p').html("Invalid Card number");
                     $('#card_number').next('span').next('p').fadeOut(4000);;
                     return false;
                }

                if($('#card_expiry_date').val()=='')
                {
                    $('#card_expiry_date').next('p').html("Enter card expiry date");
                    $('#card_expiry_date').next('p').fadeOut(4000);
                    return false;
                }

                var date = new Date();

                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                var year = ("0" + (date.getYear())).slice(-2);
                var current_date = month+'/'+year;
            

                card_expiry_month = card_expiry_date.substr(0,card_expiry_date.indexOf('/'));
                card_expiry_year = card_expiry_date.substr(card_expiry_date.indexOf('/')+1);
            
                if(card_expiry_year > year)
                {
                    $('#card_expiry_date').next('p').html("");
                }
                else if(card_expiry_year == year && card_expiry_month >= month)
                {
                    $('#card_expiry_date').next('p').html("");
                }
                else
                {
                    $('#card_expiry_date').next('p').html("Invalid card expiry date");
                    $('#card_expiry_date').next('p').fadeOut(4000);
                    return false;
                }

                date_status = check_date(card_expiry_date);    
                
                if(date_status == false)
                {
                    $('#card_expiry_date').next('p').html("Invalid card expiry date");
                    $('#card_expiry_date').next('p').fadeOut(4000);
                    return false;
                }
                if($('#cvv_number').val()=='')
                {
                    $('#cvv_number').next('p').html("Enter CVV number");
                    return false;
                }

                function validate_cvv(cvv)
                {
                    var myRe = /^[0-9]{3,4}$/;
                    var myArray = myRe.exec(cvv);
                    if(cvv!=myArray)
                    {
                        return false;
                    }
                    else
                    {
                     return true;
                    }
                }

                $res=validate_cvv(cvv);
                if($res==false)
                {
                    $('#cvv_number').next('p').html("Invalid CVV number");
                    return false;
                }

                var _token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url:'{{ url("/") }}/doctor/settings/card/store',
                    type:'post',
                    data:{
                        _token:_token,
                        card_no:card_no,
                        Package:Package,
                        card_type:card_type,
                        card_expiry_date:card_expiry_date,
                        cvv:cvv,
                    },
                    success:function(data){
                        //$('#payment_card_form')[0].reset();
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
            });
        
            $('#card_number').on('input', function(){
                var number = $(this).val();
                number = number.replace(/[^\dA-Z]/g, '').trim().substring(0, 19);
                $('#card_number').val(number);
            });

            $('#cvv_number').keydown(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
                $(this).keyup(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
             });
                
            });

            $('#cancel_membership_btn').click(function(){
                $.ajax({
                    url:url+'/cancel',
                    type:'get',
                    data:{},
                    dataType:'json',
                    success:function(data){
                        $("#cancel_next_month_membership_popup .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
            });

            $('#get_membership_btn').click(function(){
                $.ajax({
                    url:url+'/get_membership',
                    type:'get',
                    data:{},
                    dataType:'json',
                    success:function(data){
                        $("#get_next_month_membership_popup .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
            });

            $('.apply_code').click(function(){
                var discount_id = $(this).data('discount_id');
                var code        = $(this).data('code');
                var percentage  = $(this).data('percentage');
                var base_price  = $('#txt_membership_base_price').val();
                var gst_amt     = $('#txt_membership_base_gst').val();
                
                if(base_price == '' || base_price == null)
                {
                    base_price = {{ isset($membership_plan_arr['monthly_amount']) ? $membership_plan_arr['monthly_amount'] : '' }};
                    gst_amt = {{ isset($membership_plan_arr['monthly_gst']) ? $membership_plan_arr['monthly_gst'] : '' }};
                }

                var discount_price = base_price * (percentage / 100);
                var after_discount = base_price - discount_price;
                var new_price = parseFloat(after_discount) + parseFloat(gst_amt);
                
                $('#total_amt').html('$'+new_price.toFixed(2));
                $('#membership_price').val(new_price.toFixed(2));
                $('#show_voucher_code').html(percentage+'%');
                $('#discount_id').val(discount_id);
                $("#discount_code_popup .modal-close").click();
            });

        });
    </script>

    <script>

        var image_url = "<?php echo url('').'/doctor_section/images/'; ?>";

        function detectCardType(number)
        {
            var re = {
                electron: /^(4026|417500|4405|4508|4844|4913|4917)\d+$/,
                maestro: /^(5018|5020|5038|5612|5893|6304|6759|6761|6762|6763|0604|6390)\d+$/,
                dankort: /^(5019)\d+$/,
                interpayment: /^(636)\d+$/,
                unionpay: /^(62|88)\d+$/,
                visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
                mastercard: /^5[1-5][0-9]{14}$/,
                amex: /^3[47][0-9]{13}$/,
                diners: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
                discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
                jcb: /^(?:2131|1800|35\d{3})\d{11}$/
            };
            if (re.electron.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'ELECTRON';
            } else if (re.maestro.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'Mastorcard.png)');
                return 'MAESTRO';
            } else if (re.dankort.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'DANKORT';
            } else if (re.interpayment.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'INTERPAYMENT';
            } else if (re.unionpay.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'UNIONPAY';
            } else if (re.visa.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'visa-cards.png)');
                return 'VISA';
            } else if (re.mastercard.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'master-card.png)');
                return 'MASTERCARD';
            } else if (re.amex.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'amex-card.png)');
                return 'AMEX';
            } else if (re.diners.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'DINERS';                
            } else if (re.discover.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'Discover.png)');
                return 'DISCOVER';
            } else if (re.jcb.test(number)) {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                return 'JCB';
            } else {
                $('#detect_card').css('background-image', 'url(' + image_url + 'blank.png)');
                //return 'Unknown';
                return "{{ url('/') }}/public/new/images/blank.png";
            }
        }

        function check_date(value)
        {        
            var today = new Date();
            var thisYear = today.getFullYear();
            var expMonth = +value.substr(0, 2);
            var expYear = +value.substr(3, 4);
            
            var thisYear = thisYear.toString().substring(2);
            yearexp= +thisYear+20;

            if(expMonth >= 1 && expMonth <= 12 && (expYear >= thisYear && expYear < thisYear + 20) && expYear <= yearexp)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    
    </script>

@endsection