@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
        <div class="searchicon"><a href="{{ url('/patient') }}/upcoming_search" class="menu-icon center-align"><i class="material-icons">search</i> </a></div>
    </div>

    <div class="header consultation-detailshead z-depth-2 bookhead">
        <div class="backarrow"><a href="{{url('/')}}/patient/upcoming_consultation/details/{{$enc_booking_id}}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <!-- <h1 class="main-title left-align">Invoice</h1> -->

        <div class="download"><a href="javascript:void(0)" class="center-align" id="btn_download_pdf"><i class="material-icons">&#xE2C4;</i></a></div>
    </div>

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
                            <strong class="white-text">
                                @if(isset($consult_invoice['familiy_member_info']))
                                       @php $val = $consult_invoice['familiy_member_info']; @endphp
                                       {{isset($val['first_name']) ? $val['first_name'] : ''}}
                                       {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                @elseif(isset($consult_invoice['patient_user_details']))
                                     @php $val = $consult_invoice['patient_user_details']; @endphp
                                        {{isset($val['title']) ? $val['title'] : ''}}
                                        {{isset($val['first_name']) ? $val['first_name'] : ''}}
                                       {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                @endif
                            </strong>
                            <label class="white-text address" id="dec_address">
                            </label>
                        </div>
                    </div>
                    <div class="col s6 m6 l6">
                        <div class="data right"><small>FROM:</small>
                            <strong class="white-text">Doctoroo Australia Pvt. Ltd.</strong>
                            <label class="white-text address">
                                900 Biscayne Boulevard, Miami, FL 33132, USA
                            </label>
                            <span class="abnnum"><em>ABN: 15 616 602 629</em></span>
                        </div>
                    </div>
                </div>
                <div class="row detInfo mrtp">
                    <div class="col s12 m12 l12 left-align">
                        <div class="data left">
                            <label class="white-text">
                                @php 
                                    $consultation_charge = "";

                                    if(isset($consult_invoice['consultation_charge']))
                                    {
                                         $consultation_charge = $consult_invoice['consultation_charge'];
                                         $grand_total = add_gst($consultation_charge);
                                    }
                                @endphp
                                {{'$'.number_format($grand_total, 2, '.', '')}}
                            </label>
                            <small>Total</small></div>
                        <div class="data left">
                             <input type="hidden" value="{{isset($consult_invoice['card_number']) ? $consult_invoice['card_number'] : ''}}" id="card_no">
                            @php
                                if(isset($consult_invoice['card_number'])) 
                                {
                                     $temp_no = $consult_invoice['card_number'];
                                    $card_no = substr_replace($temp_no, str_repeat("X", 12), 0, 12);
                                }   
                            @endphp
                            <label class="white-text"><span id="card_type"></span> {{isset($card_no) ? $card_no : ''}}</label>
                            <small>Payment method</small></div>
                        <div class="data left">
                            <label class="white-text">Paid</label>
                            <small>Payment Status</small></div>
                    </div>
                </div>
                <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
            </div>
            <?php
                if($consult_invoice["consultation_datetime"] != '' && isset($consult_invoice["consultation_datetime"]))
                {
                    $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $consult_invoice["consultation_datetime"]);
                }
                else
                {
                    $consult_datetime = '';
                }
            ?>
            <div class="time-date ">
                <div class="row">
                    <div class="col s7 m6 l5"> <img src="{{url('')}}/public/images/clock-icon.jpg" alt="" />

                        <label class="time">{{ date("h:i a",strtotime($consult_datetime)) }}</label>
                        <div class="date">{{ date("d F, Y",strtotime($consult_datetime)) }}</div>
                        <span class="greenColr">Time</span>
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
                                <span class="itemliid">Consultation ID: {{isset($consult_invoice['consultation_id']) ? $consult_invoice['consultation_id'] : ''}}</span> <span class="itemliname">Consultation with {{isset($consult_invoice['doctor_user_details']['title']) ? $consult_invoice['doctor_user_details']['title'] : ''}} {{isset($consult_invoice['doctor_user_details']['first_name']) ? $consult_invoice['doctor_user_details']['first_name'] : ''}} {{isset($consult_invoice['doctor_user_details']['last_name']) ? $consult_invoice['doctor_user_details']['last_name'] : ''}}</span>
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <label class="price">{{isset($consult_invoice['consultation_charge']) ? '$'.$consult_invoice['consultation_charge'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                    <!--invoice items end here-->
                </div>
                <!--total sub total start here-->
                <div class="invoicetotal">
                    <div class="row valign subtotal">
                        <div class="col s8 m10 l10 valign-nor ">
                            SUBTOTAL
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">{{isset($consult_invoice['consultation_charge']) ? '$'.$consult_invoice['consultation_charge'] : ''}}</label>
                        </div>
                    </div>
                    <div class="row valign subtotal">
                        <div class="col s8 m10 l10 valign-nor ">
                            GST
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">$6.40</label>
                        </div>
                    </div>
                    <div class="row valign total">
                        <div class="col s8 m10 l10 valign-nor ">
                            TOTAL
                        </div>
                        <div class="col s4 m2 l2 valign-bottom">
                            <label class="price">
                                @php 
                                    $consultation_charge = "";

                                    if(isset($consult_invoice['consultation_charge']))
                                    {
                                         $consultation_charge = $consult_invoice['consultation_charge'];
                                    }
                                    $gst = "6.40";
                                    $total = $consultation_charge + $gst;

                                @endphp
                                {{$total}}
                            </label>
                        </div>
                    </div>
                </div>
                <!--total sub total end here-->
            </div>
        </div>
        </div>
    </div>

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
        var dump_id      = "{{isset($consult_invoice['patient_user_details']['dump_id']) ? $consult_invoice['patient_user_details']['dump_id'] : ''}}"
        var dump_session = "{{isset($consult_invoice['patient_user_details']['dump_session']) ? $consult_invoice['patient_user_details']['dump_session'] : ''}}"
        var address      = "{{ isset($consult_invoice['patient_info']['suburb']) ? $consult_invoice['patient_info']['suburb'] : ''}}";

        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(dump_session);
        var dec_address  = key.decrypt(address).toString();

        $("#dec_address").html(dec_address);

            var _token = '{{csrf_token()}}';
            $('#btn_download_pdf').click(function(){
                $.ajax({
                       url:"{{url('')}}/patient/upcoming_consultation/invoice/download/{{isset($enc_booking_id) ? $enc_booking_id : ''}}",
                       type:'get',
                       success:function(response){
                          if(response!='')
                          {
                            if(response.consult_invoice.patient_info.suburb != "")
                            {
                                var dec_suburb = key.decrypt(response.consult_invoice.patient_info.suburb).toString();
                                response.consult_invoice.patient_info.dec_suburb = dec_suburb;
                            }

                            $.ajax({
                               url:"{{url('')}}/patient/generate_upcoming_consultation_invoice_pdf",
                               type:'post',
                               data:{'arr_data' : response,'_token' : _token},
                               
                               success:function(response){
                                    pdf_url = "{{url('')}}/patient/generate_upcoming_consultation_invoice_pdf";
                                    window.open(pdf_url, '_blank');
                               }

                            });
                          }
                       }
                    });
            });    
    </script>

@endsection