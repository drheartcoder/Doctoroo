@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header profileHead reviewhead z-depth-2 bookhead">
        <div class="menuBtn  hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow"><a href="{{ url('/patient') }}/booking/show_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Complete your booking request </h1>
    </div>
    <!-- SideBar Section -->
	@include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer defaultOpen">
    <style>
        .required_field
        {
            color:red;
        }
        a.disabled_link {
          opacity: 0.5;
          pointer-events: none;
          cursor: default;
        }
    </style>
        <div class="container paddingtpbtm">
            <div class="reviewsSection">
                <div class="bookingdet">
                    <div class="profilesumm">
                        <div class="row">
                            <div class="col s12 ">
                                <div class="valign-wrapper">

                                    
                                    @php
                                    // check listisng image
                                    if ( isset($doctor_details['user_details']['profile_image']) && !empty($doctor_details['user_details']['profile_image']) )
                                    {
                                        $profile_images = $doctor_image_url.$doctor_details['user_details']['profile_image'];
                                        // check if image exists or not
                                        if ( File::exists($profile_images) ) 
                                        {
                                            $profile_images = $doctor_image_url."default-image.jpeg";
                                        } // end if
                                    } // end if
                                    else
                                    {
                                        $profile_images = $doctor_image_url."default-image.jpeg";
                                    } // end else

                                    $doc_title = isset($doctor_details['user_details']['title'])?$doctor_details['user_details']['title']:'';
                                    $doc_first_name = isset($doctor_details['user_details']['first_name'])?$doctor_details['user_details']['first_name']:'';
                                    $doc_last_name  = isset($doctor_details['user_details']['last_name'])?$doctor_details['user_details']['last_name']:'';
                                    $doc_id         = isset($doctor_details['user_details']['id'])?$doctor_details['user_details']['id']:'';

                                    $pat_first_name = isset($patient_details['first_name'])?$patient_details['first_name']:'';
                                    $pat_last_name  = isset($patient_details['last_name'])?$patient_details['last_name']:'';
                                    $patient_id     = isset($patient_details['user_id'])?$patient_details['user_id']:'';

                                    @endphp

                                    <?php $get_doc_data = \DB::table('users')->where('id',$doc_id)->first(); 
                                          if(isset($get_doc_data->dump_id) && $get_doc_data->dump_id != ""){ $avl_dump_id = $get_doc_data->dump_id; } else { $avl_dump_id = ""; }
                                          if(isset($get_doc_data->dump_session) && $get_doc_data->dump_session != ""){ $avl_dump_session = $get_doc_data->dump_session; } else { $avl_dump_session = ""; }
                                    ?>

                                    <img src="{{ $profile_images }}" class="circle left" />
                                    <p>
                                        <span class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            /*var doc_id           = "{{$doc_id}}";
                                            var doc_first_name   = "{{$doc_first_name}}"; 
                                            var doc_last_name    = "{{$doc_last_name}}"; 
                                            var doc_title        = "{{$doc_title}}"; 
                                            var card_id          = "{{$avl_dump_id}}"
                                            var userkey          = "{{$avl_dump_session}}";
                                            var VIRGIL_TOKEN     = "{{env('VIRGIL_TOKEN')}}";
                                            var api              = virgil.API(VIRGIL_TOKEN);
                                            var key              = api.keys.import(userkey);

                                             
                                            if(doc_first_name != "" && doc_last_name != ""){
                                                var doc_first_name   = key.decrypt(doc_first_name).toString();
                                                var doc_last_name    = key.decrypt(doc_last_name).toString();
                                                var dr_name = doc_title+' '+doc_first_name+' '+doc_last_name;
                                                $('.doc_name'+doc_id).html(dr_name);
                                            }
                                            else
                                            if(doc_first_name != ""){
                                                var doc_first_name   = key.decrypt(doc_first_name).toString();
                                                var dr_name = doc_title+' '+doc_first_name+' '+' ';
                                                $('.doc_name'+doc_id).html(dr_name);
                                            }
                                            else
                                            if(doc_last_name != ""){
                                                var doc_last_name   = key.decrypt(doc_last_name).toString();
                                                var dr_name = doc_title+' '+' '+' '+doc_last_name;
                                                $('.doc_name'+doc_id).html(dr_name);
                                            }*/
                                        });
                                        </script>
                                        <small>
                                        <?php $get_patient_data = \DB::table('users')->where('id',$patient_id)->first(); 
                                              if(isset($get_patient_data->dump_id) && $get_patient_data->dump_id != ""){ $patient_dump_id = $get_patient_data->dump_id; } else { $patient_dump_id = ""; }
                                              if(isset($get_patient_data->dump_session) && $get_patient_data->dump_session != ""){ $patient_dump_session = $get_patient_data->dump_session; } else { $patient_dump_session = ""; }
                                        ?>    
                                        <label>{{ isset($booking_time)?$booking_time:Session::get('booking.booking_time') }}</label>
                                        <label class="patient_name<?php echo $patient_id; ?>">For {{ $pat_first_name.' '.$pat_last_name }} </label>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            /*var patient_id           = "{{$patient_id}}";
                                            var patient_first_name   = "{{$pat_first_name}}"; 
                                            var patient_last_name    = "{{$pat_last_name}}"; 
                                            var patient_title        = "{{'For'}}"; 
                                            var card_id              = "{{$patient_dump_id}}"
                                            var userkey              = "{{$patient_dump_session}}";
                                            var VIRGIL_TOKEN         = "{{env('VIRGIL_TOKEN')}}";
                                            var api                  = virgil.API(VIRGIL_TOKEN);
                                            var key                  = api.keys.import(userkey);

                                            if(patient_first_name != "" && patient_last_name != ""){
                                                var patient_first_name   = key.decrypt(patient_first_name).toString();
                                                var patient_last_name    = key.decrypt(patient_last_name).toString();
                                                var patient_name = patient_title+' '+patient_first_name+' '+patient_last_name;
                                                $('.patient_name'+patient_id).html(patient_name);
                                            }
                                            else
                                            if(patient_first_name != ""){
                                                var patient_first_name   = key.decrypt(patient_first_name).toString();
                                                var patient_name = patient_title+' '+patient_first_name+' '+' ';
                                                $('.patient_name'+patient_id).html(patient_name);
                                            }
                                            else
                                            if(patient_last_name != ""){
                                                var patient_last_name   = key.decrypt(patient_last_name).toString();
                                                var patient_name = patient_title+' '+''+' '+patient_last_name;
                                                $('.patient_name'+patient_id).html(patient_name);
                                            }
*/

                                            
                                        });
                                        </script>    
                                        </small>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="addpayment pay-process">
                   <div class="card-payment">
                    <div class="row">
                        <div class="col s12 m6 l6">       
                                <div class="input-field pay-right-sectn">
                                    @if(isset($payment_details) && !empty($payment_details))
                                    <select class="icons select_card" id="select_payment_card">
                                        <option value="">Select Card for Payment</option>
                                        @foreach($payment_details as $cards)
                                            @php
                                                $temp_no = $cards['card_no'];
                                                $card_no = str_pad($temp_no, 16, "X", STR_PAD_LEFT);
                                             
                                                $card_imgcard_img   = "";
                                                if($cards['card_type'] == 'Visa')
                                                {
                                                    $card_img = url('/').'/public/new/images/visa.png';
                                                }
                                                else if($cards['card_type'] == 'MasterCard')
                                                {
                                                    $card_img = url('/').'/public/new/images/master-card.png';   
                                                }
                                                else if($cards['card_type'] == 'Electron')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';         
                                                }
                                                else if($cards['card_type'] == 'Dankort')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else if($cards['card_type'] == 'Interpayment')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else if($cards['card_type'] == 'Unionpay')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else if($cards['card_type'] == 'Maestro')
                                                {
                                                    $card_img = url('/').'/public/new/images/Mastorcard.png';      
                                                }
                                                else if($cards['card_type'] == 'Amex')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else if($cards['card_type'] == 'Diners')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else if($cards['card_type'] == 'JCB')
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                else
                                                {
                                                    $card_img = url('/').'/public/new/images/blank.png';      
                                                }
                                                $selected = '';

                                                if(Session::has('last_payment_method_id') && Session::get('last_payment_method_id') == $cards['id'])
                                                {
                                                    $selected = 'selected';
                                                }
                                                else
                                                {
                                                    $selected = '';
                                                }                     
                                            @endphp

                                            <option class="left" data-icon="{{ $card_img }}" data-card_id="{{ $cards['id'] }}" data-card_no="{{ base64_encode($cards['card_no']) }}" data-expire_date="{{ $cards['card_expiry_date'] }}" data-cvv="{{ $cards['cvv'] }}" {{ $selected }}>{{ $card_no }}</option>
                                        @endforeach
                                        <option value="Add Payment Method" id="popup_payment_method" >Add Payment Method</option>
                                    </select>

                                    @else
                                        <div class="valign-wrapper space">
                                            <div class="right addcards">
                                                <div class="input-field cardnum ext-mar padding-btm-error" style="width: 100%;">
                                                    <input type="text" class="validate" id="add_card_no" name="card_no" maxlength="16" placeholder="Card Number *">
                                                    <div class="err" id="err_add_card_no" style="display:none;"></div>
                                                </div>
                                                <div style="width: 100%;">
                                                    <div class="input-field small-field-left padding-btm-error">
                                                        <input type="text" class="validate" id="add_card_exp" name="card_expiry_date" maxlength="5" placeholder="Expiry (MM/YY) *">
                                                        <div class="err" id="err_add_card_exp" style="display:none;"></div>
                                                    </div>
                                                    <div class="input-field small-field-right padding-btm-error">
                                                        <input type="text" class="validate" id="add_card_cvv" name="cvv" maxlength="4" placeholder="CVV *">
                                                        <div class="err" id="err_add_card_cvv" style="display:none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="note-security">
                                            <p class="bluedoc-text">Your payment details are safe using Stripe. Any payment on our platform is encrypted by Industry Standard Security.</p>
                                        </div>
                                        <input type="hidden" class="validate" id="add_card_type" name="card_type" placeholder="Card type">
                                        <div class="clr"></div>
                                        <button id="btn_add_new_card" class="border-btn btn round-corner center-align margin-top-none">SAVE</button>
                                    @endif
                                </div>
                         </div>
                        <div class="col s12 m6 l6">
                              <!-- <span class="circle left imgdiv"><a href="{{ url('/') }}/patient/setting/payment_method_settings" class="center"><i class="material-icons center">add</i></a></span> -->
                              <div class="pay-cards">
                                    <img src="{{ url('/') }}/public/new/images/visa.png"/>
                                    <img src="{{ url('/') }}/public/new/images/master-card.png"/>
                              </div>
                        </div> 
                    </div>
                    </div>
                <div class="divider"></div>
                <div class="note">
                    <strong>Please Note:</strong> Your card will only be charged once your doctor confirms your booking time.<br/>
                    <a href="#pricing_details" class="greencolor" data-toggle="modal" >View Pricing Details</a>
                </div>

                <div class="data-content marbookdetails">
                    
                    <!--total sub total start here-->
                    <div class="invoicetotal">

                        @php
                            $book_time = isset($booking_time)?$booking_time:Session::get('booking.booking_time') ;

                            $hour = strtok($book_time, ':');
                            $time_format = "";
                            $time_booking = "";
                            if(isset($hour))
                            {
                                $full_format = substr($book_time, strpos($book_time, " ") + 1);    
                            }
                            if(isset($full_format))
                            {
                                $format = explode(',', $full_format);    
                            }
                            if(isset($format[0]))
                            {
                                $time_format = $format[0];    
                            }
                            
                        @endphp

                        <div class="row valign subtotal">
                            @php
                                $doctoroo_commission = isset($admin_fees_arr['doctoroo_commission']) ? $admin_fees_arr['doctoroo_commission'] : '';
                                $doctor_rt = isset($booking_earning_for_4_min) ? $booking_earning_for_4_min : '';
                                
                                $comm = number_format((float) $doctor_rt, 2, '.', '') * ($doctoroo_commission/100);
                                
                                $commission = number_format((float)$comm, 2, '.', '') + number_format((float) 10, 2, '.', '') ;
                                
                                $dr_rt = isset($booking_earning_for_4_min) ? $booking_earning_for_4_min : '';
                                $total = number_format((float) $dr_rt, 2, '.', '') + $commission;
                            @endphp
                        </div>
                        <div class="row valign subtotal">
                            <div class="col s8 m10 l10 valign-nor ">
                                Doctor fee (first 4 mins.)
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">{{isset($booking_earning_for_4_min) ? '$'.number_format($booking_earning_for_4_min, 2, '.', '') : '' }}</label>
                            </div>
                        </div>
                        <div class="row valign subtotal">
                            <div class="col s8 m10 l10 valign-nor ">
                                Booking fee
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">
                                    {{ '$'.number_format($commission, 2, '.', '') }}
                                </label>
                            </div>
                        </div>
                         <div class="row valign subtotal">
                            <div class="col s8 m10 l10 valign-nor ">
                                Sub Total
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">
                                    {{ '$'.number_format($total, 2, '.', '') }}
                                </label>
                            </div>
                        </div>
                        <div class="row valign subtotal">
                            <div class="col s8 m10 l10 valign-nor ">
                                GST
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">
                                    10%
                                </label>
                            </div>
                        </div>
                        <div class="row valign total">
                            <div class="col s8 m10 l10 valign-nor ">
                                TOTAL
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price green">
                                    <?php $grand_total = add_gst($total); ?>
                                    {{ '$'.number_format($grand_total, 2, '.', '') }}
                                </label>
                            </div>
                        </div>
                        <form action="{{ url('/') }}/patient/booking/payment/stripe/stripePayment" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" class="card_id" id="card_id" name="card_id" value="">
                            <input type="hidden" class="card_no" id="card_no" name="card_no" value="">
                            <input type="hidden" class="expire_date" id="expire_date" name="expire_date" value="">
                            <input type="hidden" class="cvv" id="cvv" name="cvv" value="">

                            <button type="submit" class="border-btn cart round-corner center-align btn_payment" id="btnStripeCheckout" name="btnStripeCheckout">Request Booking</button>
                        </form>
                    </div>
                    <!--total sub total end here-->
                    <div class="err center-align" id="err_payment" style="display:none; width: 100%;"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="whit-bg openAfterStripe" style="display: none;">
        <div class="acc-bx">
            <div class="cap-title user-box" style="text-align: center;">Please wait</div>
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
            <div class="info-app-cls paymt-sec " >
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
</div>
 <!-- Closing of mar300 -->

    <!-- Modal requestbooking -->
    <div id="requestbooking" class="modal requestbooking" style="display: none;">
        <div class="modal-content">
            <h4 class="center-align">Request Booking</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s2 l2 center-align title">Time</div>
                <div class="col s10 l10"><strong>{{ isset($booking_time)?$booking_time:'' }}</strong></div>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">With</div>
                <div class="col s10 l10"><strong>{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</strong></div>
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
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="{{ url('/patient') }}/booking_request_confirmation" class="modal-action waves-effect waves-green btn-cancel-cons right ">Continue</a>
        </div>
    </div>
    <!-- Modal requestbooking End -->

    <!-- Modal add card start -->
    <a href="#add_payment_card" id="add_payment" style="display: none;"></a>
    <div id="add_payment_card" class="modal requestbooking" style="display: none;">
        <form id="payment_method_form">
            <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
                <div class="modal-content">
                    <h4 class="center-align">Add Payment Method</h4>
                    <a class="modal-close closeicon"><i class="material-icons">close</i></a>
                </div>
                <div class="modal-data">
                    <div class="row">
                        <div class="col s12 l12">
                            <div class="input-field text-bx">
                                <input id="popup_card_no" type="text" class="validate">
                                <label for="popup_card_no">Card No. <span class="required_field">*</span></label>
                                <div class="error_class" id="err_popup_card_no" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6 l6">
                            <div class="input-field text-bx ">
                                <input id="popup_card_expiry_date" type="text" class="validate number" placeholder="MM/YY" maxlength="5">
                                <label class="active" for="popup_card_expiry_date">Expiry Date <span class="required_field">*</span></label>
                                <div class="error_class" id="err_popup_card_expiry_date" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s6 l6">
                            <div class="input-field text-bx">
                                <input id="popup_cvv" type="text" maxlength="4" class="validate">
                                <label for="popup_cvv">CVV <span class="required_field">*</span></label>
                                <div class="error_class" id="err_popup_cvv" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            <div class="note-security">
                                <p class="bluedoc-text">Your payment details are safe using Stripe. Any payment on our platform is encrypted by Industry Standard Security.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer center-align ">
                <a class="modal-close modal-action waves-effect waves-green btn-cancel-cons left back">Cancel</a>
                <a class="modal-action waves-effect waves-green btn-cancel-cons right" id="btn_popup_add_payment_method">Add</a>
            </div>
        </form>
    </div>
    <!-- Modal add card end -->

    <input type="hidden" class="payment_error_msg" id="payment_error_msg" name="payment_error_msg" value="{{ Session::get('message') }}" style="display: none;"/>
    <!-- @if(Session::has('message'))
        <input type="hidden" class="payment_error_msg" id="payment_error_msg" name="payment_error_msg" value="{{ Session::get('message') }}" />
    @endif -->
    <a class="open_payment_popup" href="#payment_err_msg" style="display: none;"></a>
    <div id="payment_err_msg" class="modal requestbooking" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div></div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>
    </div>


    <a class="select_payment_card_popup" href="#select_card_error" style="display: none;"></a>
    <div id="select_card_error" class="modal requestbooking" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div></div>
                    <p id="select_card_error_msg"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>
    </div>

    <!--popup include -->
    @include('front.patient.booking.pricing_details')

<script>
$(document).ready(function(){
    var err_msg = $('#payment_error_msg').val();
    if(err_msg != '')
    {
        $(".open_payment_popup").click();
        //$('#payment_err_msg').modal();
    }

    $('#select_payment_card').change(function () {
        if ($(this).val() == "Add Payment Method") {
            $('#add_payment').click();
        }
    });

    $('#popup_card_no, #popup_cvv').keydown(function () {
        $(this).val($(this).val().replace(/[^\d]/, ''));
        $(this).keyup(function () {
            $(this).val($(this).val().replace(/[^\d]/, ''));
        });
    });

    $('#add_card_exp').keyup(function(event) {
      var inputLength = event.target.value.length; 
        if(inputLength === 2 || inputLength === 5){
          var thisVal = event.target.value;
          if(inputLength<5)
          {
            thisVal += '/';
          $(event.target).val(thisVal);  
          }
        }
    });

    $('.select_card').change(function(){
        var card_id     = $(this).find(':selected').data("card_id");
        var card_no     = $(this).find(':selected').data("card_no");
        var expire_date = $(this).find(':selected').data("expire_date");
        var cvv         = $(this).find(':selected').data("cvv");

        var card_64     = Base64.decode(card_no);
        $('#card_img').attr('src',detectCardType(card_64));

        $('#card_id').val(card_id);
        $('#card_no').val(card_no);
        $('#expire_date').val(expire_date);
        $('#cvv').val(cvv);
    });

    $('.btn_payment').click(function(){
        var card_id     = $('#card_id').val();
        var card_no     = $('#card_no').val();
        var expire_date = $('#expire_date').val();
        var cvv         = $('#cvv').val();

        if(card_id == '' && card_no == '' && expire_date == '' && cvv == '')
        {
            $('.select_payment_card_popup').click();
            $('#select_card_error_msg').html('Please Select Card for the Payment');
            return false;
        }
    });

    $('#add_card_no').blur(function(){
        var card_no     = $('#add_card_no').val();
        if(card_no != '')
        {
            $('#add_card_type').val(detectCardType(card_no));
        }
    });

    $('#add_card_exp, #popup_card_expiry_date').keyup(function(event) {
      var inputLength = event.target.value.length; 
        if(inputLength === 2 || inputLength === 5){
          var thisVal = event.target.value;
          if(inputLength<5)
          {
            thisVal += '/';
          $(event.target).val(thisVal);  
          }
        }
    });

    $('#btn_add_new_card').click(function(){
        var card_no     = $('#add_card_no').val();
        var expiry_date = $('#add_card_exp').val();
        var cvv         = $('#add_card_cvv').val();
        var card_type   = $('#add_card_type').val();

        var number      = /^[0-9]*$/;
        var date        = /^[0-9\/]*$/;
        var alpha       = /^[a-zA-Z]*$/;

        if(card_no == '')
        {
            $('#err_add_card_no').show();
            $('#add_card_no').focus();
            $('#err_add_card_no').html('Please Enter Card Number.');
            $('#err_add_card_no').fadeOut(4000);
            return false;
        }
        else if(!number.test(card_no))
        {
            $('#err_add_card_no').show();
            $('#add_card_no').focus();
            $('#err_add_card_no').html('Please enter only numbers.');
            $('#err_add_card_no').fadeOut(4000);
            return false;  
        }
        
        var res=validateCardNumber(card_no);
        if(res==false)
        {
            $('#err_add_card_no').show();
            $('#err_add_card_no').html("Invalid Card number");
            $('#err_add_card_no').fadeOut(4000);
            return false;
        }
        if(expiry_date == '')
        {
            $('#err_add_card_exp').show();
            $('#add_card_exp').focus();
            $('#err_add_card_exp').html('Please Enter Card Expire Date.');
            $('#err_add_card_exp').fadeOut(4000);
            return false;
        }
        else if(!date.test(expiry_date))
        {
            $('#err_add_card_exp').show();
            $('#add_card_exp').focus();
            $('#err_add_card_exp').html('Please enter only numbers.');
            $('#err_add_card_exp').fadeOut(4000);
            return false;  
        }

        var date = new Date();

        var month= ("0" + (date.getMonth() + 1)).slice(-2);
        var year= ("0" + (date.getYear())).slice(-2);
        var current_date=month+'/'+year;
        
        card_expiry_month=expiry_date.substr(0,expiry_date.indexOf('/'));
        
        card_expiry_year=expiry_date.substr(expiry_date.indexOf('/')+1);
        
        if(card_expiry_year > year)
        {
            $('#err_add_card_exp').html("");
        }
        else if(card_expiry_year ==year && card_expiry_month >= month)
        {
            $('#err_add_card_exp').html("");
        }
        else
        {
            $('#err_add_card_exp').show();
            $('#add_card_exp').focus();
            $('#err_add_card_exp').html('Invalid card expiry date.');
            $('#err_add_card_exp').fadeOut(4000);
            return false;
        }

        date_status=check_date(expiry_date);    
            
        if(date_status==false)
        {
            $('#err_add_card_exp').show();
            $('#add_card_exp').focus();
            $('#err_add_card_exp').html('Invalid card expiry date.');
            $('#err_add_card_exp').fadeOut(4000);
            
            return false;
        }

        if(cvv == '')
        {
            $('#err_add_card_cvv').show();
            $('#add_card_cvv').focus();
            $('#err_add_card_cvv').html('Please Enter Card CVV.');
            $('#err_add_card_cvv').fadeOut(4000);
            return false;
        }
        else if(!number.test(cvv))
        {
            $('#err_add_card_cvv').show();
            $('#add_card_cvv').focus();
            $('#err_add_card_cvv').html('Please enter only numbers.');
            $('#err_add_card_cvv').fadeOut(4000);
            return false;  
        }

        $res = validate_cvv(cvv);
        if($res == false)
        {
            $('#err_add_card_cvv').show();
            $('#add_card_cvv').focus();
            $('#err_add_card_cvv').html('Invalid CVV number.');
            $('#err_add_card_cvv').fadeOut(4000);
            return false;
            
        }

        $('#btn_add_new_card').prop('disabled' , true);

        var token = $('input[name="_token"]').val();
        $.ajax({
           //url:'{{ url("/") }}/patient/setting/payment_method',
           url:'{{ url("/") }}/patient/setting/card/store',
           type:'POST',
           dataType:'json',
           data:{_token:token, card_no:card_no, card_expiry_date:expiry_date, cvv:cvv, card_type:card_type },
           success:function(res){
              if(res.msg)
              {
                location.reload();
              }
           }
        });
    });

    $("#btn_popup_add_payment_method").click(function(){
        
        var card_no     = $('#popup_card_no').val();
        var expiry_date = $('#popup_card_expiry_date').val();
        var cvv         = $('#popup_cvv').val();
        //var card_type   = detectCardType(card_no);

        var number      = /^[0-9]*$/;
        var date        = /^[0-9\/]*$/;
        var alpha       = /^[a-zA-Z]*$/;

        if ($.trim(card_no) == '') {
            $('#err_popup_card_no').show();
            $('#err_popup_card_no').html('Please enter card no.');
            $('#err_popup_card_no').fadeOut(4000);
            $('#popup_card_no').focus();
            return false;
        } else if (!number.test(card_no)) {
            $('#err_popup_card_no').show();
            $('#err_popup_card_no').html('Please enter valid card no.');
            $('#err_popup_card_no').fadeOut(4000);
            $('#popup_card_no').focus();
            return false;
        }

        var res=validateCardNumber(card_no);
        if(res==false)
        {
            $('#err_popup_card_no').show();
            $('#err_popup_card_no').html('Please enter valid card no.');
            $('#err_popup_card_no').fadeOut(4000);
            $('#popup_card_no').focus();
            return false;
        }
        if ($.trim(expiry_date) == '') {
            $('#err_popup_card_expiry_date').show();
            $('#err_popup_card_expiry_date').html('Please enter expiry date.');
            $('#err_popup_card_expiry_date').fadeOut(4000);
            $('#popup_card_expiry_date').focus();
            return false;
        } else if (!date.test(expiry_date)) {
            $('#err_popup_card_expiry_date').show();
            $('#err_popup_card_expiry_date').html('Please enter valid expiry date.');
            $('#err_popup_card_expiry_date').fadeOut(4000);
            $('#popup_card_expiry_date').focus();
            return false;
        }

        var date = new Date();

        var month= ("0" + (date.getMonth() + 1)).slice(-2);
        var year= ("0" + (date.getYear())).slice(-2);
        var current_date=month+'/'+year;
        
        card_expiry_month=expiry_date.substr(0,expiry_date.indexOf('/'));
        
        card_expiry_year=expiry_date.substr(expiry_date.indexOf('/')+1);
        
        if(card_expiry_year > year)
        {
            $('#err_popup_card_expiry_date').html("");
        }
        else if(card_expiry_year ==year && card_expiry_month >= month)
        {
            $('#err_popup_card_expiry_date').html("");
        }
        else
        {
            $('#err_add_card_exp').show();
            $('#popup_card_expiry_date').focus();
            $('#err_popup_card_expiry_date').html('Invalid card expiry date.');
            $('#err_popup_card_expiry_date').fadeOut(4000);
            return false;
        }

        date_status=check_date(expiry_date);    
            
        if(date_status==false)
        {
            $('#err_popup_card_expiry_date').show();
            $('#popup_card_expiry_date').focus();
            $('#err_popup_card_expiry_date').html('Invalid card expiry date.');
            $('#err_popup_card_expiry_date').fadeOut(4000);
            
            return false;
        }

        if ($.trim(cvv) == '') {
            $('#err_popup_cvv').show();
            $('#err_popup_cvv').html('Please enter cvv.');
            $('#err_popup_cvv').fadeOut(4000);
            $('#popup_cvv').focus();
            return false;
        } else if (!number.test(cvv)) {
            $('#err_popup_cvv').show();
            $('#err_popup_cvv').html('Please enter valid cvv.');
            $('#err_popup_cvv').fadeOut(4000);
            $('#popup_cvv').focus();
            return false;
        }

        $res=validate_cvv(cvv);
        if($res==false)
        {
            $('#err_popup_cvv').show();
            $('#err_popup_cvv').html('Invalid CVV number.');
            $('#err_popup_cvv').fadeOut(4000);
            $('#popup_cvv').focus();
            return false;
        }

        $('#btn_popup_add_payment_method').addClass('disabled_link');
    
        var token = $('input[name="_token"]').val();
        $.ajax({
           //url:'{{ url("/") }}/patient/setting/payment_method',
           url:'{{ url("/") }}/patient/setting/card/store',
           type:'POST',
           dataType:'json',
           data:{_token:token, card_no:card_no, card_expiry_date:expiry_date, cvv:cvv },
           success:function(res){
              if(res.msg)
              {
                //location.reload();
                $('#add_payment_card').hide();
                $(".open_popup").click();
                $('.flash_msg_text').html(res.msg);
              }
           }
        });
    });

    

    /*function expiry_date_check(val) {
        var sum = 0;
        for (var i = 0; i < val.length; i++) {
            var intVal = parseInt(val.substr(i, 1));
            if (i % 2 == 0) {
                intVal *= 2;
                if (intVal > 9) {
                    intVal = 1 + (intVal % 10);
                }
            }
            sum += intVal;
        }
        return (sum % 10) == 0;
    }*/

    function detectCardType(number) {
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
            //return 'ELECTRON';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.maestro.test(number)) {
            return 'MAESTRO';
            //return "{{ url('/') }}/public/new/images/Mastorcard.png";
        } else if (re.dankort.test(number)) {
            return 'DANKORT';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.interpayment.test(number)) {
            return 'INTERPAYMENT';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.unionpay.test(number)) {
            return 'UNIONPAY';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.visa.test(number)) {
            return 'VISA';
            //return "{{ url('/') }}/public/new/images/visa.png";
        } else if (re.mastercard.test(number)) {
            return 'MASTERCARD';
            //return "{{ url('/') }}/public/new/images/master-card.png";
        } else if (re.amex.test(number)) {
            return 'AMEX';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.diners.test(number)) {
            return 'DINERS';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else if (re.discover.test(number)) {
            return 'DISCOVER';
            //return "{{ url('/') }}/public/new/images/Discover.png";
        } else if (re.jcb.test(number)) {
            return 'JCB';
            //return "{{ url('/') }}/public/new/images/blank.png";
        } else {
            return 'Unknown';
            //return "{{ url('/') }}/public/new/images/blank.png";
        }
    }

    var Base64 = {


        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


        encode: function(input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = Base64._utf8_encode(input);

            while (i < input.length) {

                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

            }

            return output;
        },


        decode: function(input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

            while (i < input.length) {

                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }

            }

            output = Base64._utf8_decode(output);

            return output;

        },

        _utf8_encode: function(string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {

                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }

            return utftext;
        },

        _utf8_decode: function(utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;

            while (i < utftext.length) {

                c = utftext.charCodeAt(i);

                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                }
                else if ((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                }
                else {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }

            }

            return string;
        }

    }

});
</script>
<script>
    $(document).ready(function(){

        $('#add_card_no, #add_card_cvv,').keydown(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
             $(this).keyup(function(){
                 $(this).val($(this).val().replace(/[^\d]/,''));
             });
        });

        $('#popup_card_no').on('input', function(){
             var number = $(this).val();
             number = number.replace(/[^\dA-Z]/g, '').trim().substring(0, 19);
             $('#popup_card_no').val(number);
        });

        $('.modal-close').click(function(){
            $('#payment_method_form')[0].reset();
            $('#popup_card_no').next('label').removeClass('active');
            $('#popup_cvv').next('label').removeClass('active');
        });

        $('.open_popup .close').click(function(){
            window.reload();
        });

    });

    function validateCardNumber(number) {
        var regex = new RegExp("^[0-9]{16}$");
        if (!regex.test(number))
            return false;

        return luhnCheck(number);
    }

    function luhnCheck(val) {
        var sum = 0;
        for (var i = 0; i < val.length; i++) {
            var intVal = parseInt(val.substr(i, 1));
            if (i % 2 == 0) {
                intVal *= 2;
                if (intVal > 9) {
                    intVal = 1 + (intVal % 10);
                }
            }
            sum += intVal;
        }
        return (sum % 10) == 0;
    }

    function check_date(value)
    {
        var today       = new Date();
        var thisYear    = today.getFullYear();
        var expMonth    = +value.substr(0, 2);
        var expYear     = +value.substr(3, 4);
        
        var thisYear    = thisYear.toString().substring(2);
        yearexp         = +thisYear+20;

        if(expMonth >= 1 && expMonth <= 12 && (expYear >= thisYear && expYear < thisYear + 20) && expYear <= yearexp)
        {
            return true;
        }
        else
        {
            return false;
        }
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

</script>

@endsection