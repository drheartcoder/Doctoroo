@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="javascript:void(0)" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
        <div class="searchicon"><a href="{{ url('/patient') }}/upcoming_search" class="menu-icon center-align"><i class="material-icons">search</i> </a></div>
    </div>

    <div class="header consultation-detailshead z-depth-2 bookhead">
        <div class="backarrow"><a href="{{url('/')}}/patient/past_consultation/details/{{$enc_booking_id}}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <!-- <h1 class="main-title left-align">Invoice</h1> -->

        <div class="download"><a href="javascript:void(0)" class="center-align" id="btn_download_pdf"><i class="material-icons">&#xE2C4;</i></a></div>
    </div>
    @foreach($invoice_data as $invoice)
        @php
            $consultation_id= isset($invoice['consultation_details']['consultation_id']) ? $invoice['consultation_details']['consultation_id'] : '';
            $pat_title      = isset($invoice['user_data']['title']) ? $invoice['user_data']['title'] : '';
            $pat_first      = isset($invoice['user_data']['first_name']) ? $invoice['user_data']['first_name'] : '';
            $pat_last       = isset($invoice['user_data']['last_name']) ? $invoice['user_data']['last_name'] : '';
            $pat_address    = isset($invoice['patient_data']['suburb']) ? $invoice['patient_data']['suburb'] : '';

            $amount[]       = isset($invoice['payment_amount']) ? $invoice['payment_amount'] : '';
            $status         = isset($invoice['payment_status']) ? $invoice['payment_status'] : '';

            $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $invoice['consultation_details']['consultation_datetime']);
            $booking_time   = date("h:i a",strtotime($consult_datetime));
            $booking_date   = date("d F, Y",strtotime($consult_datetime));

            $call_time[]    = isset($invoice['call_time']) ? $invoice['call_time'] : '';

            $doc_title      = isset($invoice['doctor_user_data']['title']) ? $invoice['doctor_user_data']['title'] : '';
            $doc_first      = isset($invoice['doctor_user_data']['first_name']) ? $invoice['doctor_user_data']['first_name'] : '';
            $doc_last       = isset($invoice['doctor_user_data']['last_name']) ? $invoice['doctor_user_data']['last_name'] : '';
        @endphp
    @endforeach

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

     <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">
        <div class="consultation-details">
            <div class="sub-header  z-depth-2">
                <div class="row detInfo">
                    <div class="col s6 m6 l6 left-align">
                        <div class="data">
                            <small>T0:</small>
                            <strong class="white-text">{{ $pat_title.' '.$pat_first.' '.$pat_last }}</strong>
                            <label class="white-text address" id="dec_pat_address">
                            </label>
                        </div>
                    </div>
                    <div class="col s6 m6 l6">
                        <div class="data right"><small>FROM:</small>
                            <strong class="white-text">{{ isset($admin_data['name']) ? $admin_data['name'] : '' }}</strong>
                            <label class="white-text address">
                                {{ isset($admin_data['address']) ? $admin_data['address'] : '' }}
                            </label>
                            <span class="abnnum"><em>ABN: {{ isset($admin_data['abn']) ? $admin_data['abn'] : '' }}</em></span>
                        </div>
                    </div>
                </div>
                <div class="row detInfo mrtp">
                    <div class="col s12 m12 l12 left-align">
                        <div class="data left">
                            <label class="white-text">
                                @php
                                    $amount1 = isset($amount[0]) ? $amount[0] : '';
                                    $amount2 = isset($amount[1]) ? $amount[1] : '';
                                    $total_amount = (int) $amount1 + (int) $amount2;
                                    $grand_total = add_gst($total_amount);
                                @endphp
                                {{'$'.number_format($grand_total, 2, '.', '')}}
                            </label>
                            <small>Total</small>
                        </div>
                        
                        <div class="data left">
                            <label class="white-text">@if($status == 'completed') Paid @else Un-Paid @endif</label>
                            <small>Payment Status</small>
                        </div>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
            </div>
            <div class="time-date ">
                <div class="row">
                    <div class="col s7 m6 l5"> <img src="{{url('')}}/public/images/clock-icon.jpg" alt="" />
                        <label class="time">{{ $booking_time }}</label>
                        <div class="date">{{ $booking_date }}</div>
                        <span class="greenColr">Time</span>
                    </div>
                    <div class="col s5 m6 l7 ">
                        <div class="mrtplft">
                            <label class="time">
                                @php
                                    $h1 = $h2 = $m1 = $m2 = '';

                                    $call_time1 = isset($call_time[0]) ? $call_time[0] : '';
                                    $call_time2 = isset($call_time[1]) ? $call_time[1] : '';
                                    
                                    if($call_time1 != '')
                                    {
                                        $explode1 = explode(':', $call_time1);
                                        $h1 = $explode1[0];
                                        $m1 = $explode1[1];
                                    }
                                    if($call_time2 != '')
                                    {
                                        $explode2 = explode(':', $call_time2);
                                        $h2 = $explode2[0];
                                        $m2 = $explode2[1];
                                    }
                                    $h = $h1 + $h2;
                                    $m = $m1 + $m2;
                                @endphp
                                {{ str_pad($h, 2, '0', STR_PAD_LEFT).':'.str_pad($m, 2, '0', STR_PAD_LEFT).':00' }}
                            </label>
                            <span class="greenColr">Length</span>
                        </div>
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
                                <span class="itemliid">Consultation ID: {{ $consultation_id }}</span>
                                <span class="itemliname">Consultation with {{ $doc_title.' '.$doc_first.' '.$doc_last }}</span>
                                <br/>
                                <span class="itemliname">Cost of first 4 mins </span>
                                @if($amount2 != '')
                                    <br/>
                                    <span class="itemliname">Cost after first 4 mins </span>
                                @endif
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">{{ '$'.number_format($amount1, 2, '.', '') }}</label>
                                <br/>
                                @if($amount2 != '')
                                    <br/>
                                    <label class="price">{{ '$'.number_format($amount2, 2, '.', '') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="listitems">
                        <div class="row valign">
                            <div class="col s8 m10 l10 valign-nor ">
                                <br/>
                                <span class="itemliname">Sub Total</span>
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">{{ '$'.number_format($total_amount, 2, '.', '') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="listitems">
                        <div class="row valign">
                            <div class="col s8 m10 l10 valign-nor ">
                                <br/>
                                <span class="itemliname">GST</span>
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">10%</label>
                            </div>
                        </div>
                    </div>
                    <!--invoice items end here-->
                </div>
                <!--total sub total start here-->
                <div class="invoicetotal">
                    <div class="row valign total">
                        <div class="col s8 m10 l10 valign-nor ">
                            TOTAL
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">
                                <?php $grand_total = add_gst($total_amount); ?>
                                {{ '$'.number_format($grand_total, 2, '.', '') }}
                            </label>
                        </div>
                    </div>
                </div>
                <!--total sub total end here-->
            </div>
        </div>
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
            <a href="online-waiting-room.html" class="modal-action waves-effect waves-green btn-cancel-cons right cnclbook ">Cancel Booking</a>
        </div>
    </div>
     <!-- Modal reason for cancellation ends-->

    <!--Container End-->

    <script>
        $(document).ready(function(){
            if($('#card_no').val() != '' && $('#card_no').val() != null)
                {
                    var card = detectCardType($('#card_no').val());
                    $('#card_type').html(card);
                }
        });
    </script>

    <script>
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
            return 'ELECTRON';
        } else if (re.maestro.test(number)) {
            return 'MAESTRO';
        } else if (re.dankort.test(number)) {
            return 'DANKORT';
        } else if (re.interpayment.test(number)) {
            return 'INTERPAYMENT';
        } else if (re.unionpay.test(number)) {
            return 'UNIONPAY';
        } else if (re.visa.test(number)) {
            return 'VISA';
        } else if (re.mastercard.test(number)) {
            return 'MASTERCARD';
        } else if (re.amex.test(number)) {
            return 'AMEX';
        } else if (re.diners.test(number)) {
            return 'DINERS';
        } else if (re.discover.test(number)) {
            return 'DISCOVER';
        } else if (re.jcb.test(number)) {
            return 'JCB';
        } else {
            return 'Unknown';
        }
    }
    </script>
    <script type="text/javascript">
        var dump_id      = "{{isset($invoice['user_data']['dump_id']) ? $invoice['user_data']['dump_id'] : ''}}"
        var dump_session = "{{isset($invoice['user_data']['dump_session']) ? $invoice['user_data']['dump_session'] : ''}}"
        var pat_address  = "{{isset($invoice['patient_data']['suburb']) ? $invoice['patient_data']['suburb'] : ''}}";

        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(dump_session);
        var dec_address  = key.decrypt(pat_address).toString();

        $("#dec_pat_address").html(dec_address);

            var _token = '{{csrf_token()}}';
        $('#btn_download_pdf').click(function(){
            $.ajax({
                   url:"{{url('')}}/patient/past_consultation/invoice/download/{{isset($enc_booking_id) ? $enc_booking_id : ''}}",
                   type:'get',
                   success:function(response){
                      if(response!='')
                      {
                        $.each(response.invoice_data,function(index,value){
                            if(value.patient_data.suburb != "")
                            {
                                var dec_suburb = key.decrypt(value.patient_data.suburb).toString();
                                response.invoice_data[index].patient_data.dec_suburb = dec_suburb;
                            }
                        });

                        $.ajax({
                           url:"{{url('')}}/patient/generate_invoice_pdf",
                           type:'post',
                           data:{'arr_data' : response,'_token' : _token},
                           
                           success:function(response){
                                pdf_url = "{{url('')}}/patient/generate_invoice_pdf";
                                window.open(pdf_url, '_blank');
                           }

                        });
                      }
                   }
                });
        });    
    </script>
@endsection