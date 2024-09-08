@extends('front.doctor.layout.new_master')
@section('main_content')
    <div class="header bookhead nopad">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="download" style="height: 44px;position: absolute;right: 10px;top: 0;"><a href="javascript:void(0)" class="center-align" id="btn_download_pdf"><i class="material-icons">&#xE2C4;</i></a></div>
    </div>
     <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')
  
    <div class="mar300  has-header minhtnor">
    
    @foreach($invoice_data as $invoice)
        @php
            $consultation_id= isset($invoice['consultation_details']['consultation_id']) ? $invoice['consultation_details']['consultation_id'] : '';
            $pat_title      = isset($invoice['user_data']['title']) ? $invoice['user_data']['title'] : '';
            $pat_first      = isset($invoice['user_data']['first_name']) ? $invoice['user_data']['first_name'] : '';
            $pat_last       = isset($invoice['user_data']['last_name']) ? $invoice['user_data']['last_name'] : '';
            $pat_address    = isset($invoice['patient_data']['suburb']) ? $invoice['patient_data']['suburb'] : '';

            $amount[]       = isset($invoice['payment_amount']) ? $invoice['payment_amount'] : '';
            $call_time[]    = isset($invoice['call_time']) ? $invoice['call_time'] : '';
            $status         = isset($invoice['payment_status']) ? $invoice['payment_status'] : '';

            $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $invoice['consultation_details']['consultation_datetime']);
            $booking_time   = isset($consult_datetime) ? date("h:i a",strtotime($consult_datetime)) : '';
            $booking_date   = isset($consult_datetime) ? date("d F, Y",strtotime($consult_datetime)) : '';

            $doc_title      = isset($invoice['doctor_user_data']['title']) ? $invoice['doctor_user_data']['title'] : '';
            $doc_first      = isset($invoice['doctor_user_data']['first_name']) ? $invoice['doctor_user_data']['first_name'] : '';
            $doc_last       = isset($invoice['doctor_user_data']['last_name']) ? $invoice['doctor_user_data']['last_name'] : '';

            $dump_id       = isset($invoice['user_data']['dump_id']) ? $invoice['user_data']['dump_id'] : '';
            $dump_session  = isset($invoice['user_data']['dump_session']) ? $invoice['user_data']['dump_session'] : '';
        @endphp
    @endforeach

        <div class="container">
            <div class="consultation-details">
                <div class="sub-header  z-depth-2">
                    <div class="row detInfo">
                        <div class="col s6 m6 l6 left-align">
                            @if(isset($invoice_data) && sizeof($invoice_data)>0)
                                <div class="data">
                                    <small>T0:</small>
                                    <strong class="white-text">{{ $pat_title.' '.$pat_first.' '.$pat_last }}</strong>
                                    <label class="white-text address"><span id="dec_pat_address"></span></label>
                                </div>
                            @endif
                        </div>
                        <div class="col s6 m6 l6">
                          @if(isset($arr_admin) && sizeof($arr_admin)>0)
                            @php
                                $admin_name = isset($arr_admin['name']) ? $arr_admin['name'] : '';
                                $admin_address = isset($arr_admin['address']) ? $arr_admin['address'] : '';
                                $admin_abn = isset($arr_admin['abn']) ? $arr_admin['abn'] : '';
                            @endphp
                            <div class="data right"><small>FROM:</small>
                                <strong class="white-text">{{ $admin_name }}</strong>
                                <label class="white-text address">
                                    {{ $admin_address }}
                                </label>
                                <span class="abnnum"><em>ABN: {{ $admin_abn }}</em></span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row detInfo mrtp">
                        <div class="col s12 m12 l12 left-align">
                        
                         @if(isset($invoice_data) && sizeof($invoice_data)>0)
                            <div class="data left">
                                <label class="white-text">
                                @php
                                    $amount1 = isset($amount[0]) ? $amount[0] : '';
                                    $amount2 = isset($amount[1]) ? $amount[1] : '';
                                    $total_amount = (int) $amount1 + (int) $amount2;
                                    $grand_total = add_gst($total_amount);
                                @endphp
                                {{'$'.number_format($grand_total, 2, '.', '')}}</label> 
                                <small>Total</small>
                            </div>
                            <div class="data left">
                                <label class="white-text">@if($status == 'completed') Paid @else Un-Paid @endif</label>
                                <small>Payment Status</small>
                            </div>
                            @endif
                        </div>
                    </div>
                    <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
                </div>
                <div class="time-date ">
                    <div class="row">
                            
                        <div class="col s7 m6 l5"> <img src="{{url('/')}}/public/doctor_section/images/clock-icon.png" alt="" />
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
                                {{ str_pad($h, 2, '0', STR_PAD_LEFT).':'.str_pad($m, 2, '0', STR_PAD_LEFT).':00' }}</label>
                            <span class="greenColr">Length</span></div>
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
                    @if(isset($invoice_data) && sizeof($invoice_data)>0)
                        <div class="row valign total">
                            <div class="col s8 m10 l10 valign-nor ">
                                TOTAL
                            </div>
                            <div class="col s4 m2 l2 valign-bottom">
                                <?php $grand_total = add_gst($total_amount); ?>
                                <label class="price">{{ '$'.number_format($grand_total, 2, '.', '') }}</label>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!--total sub total end here-->
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" id="dump_id" value="{{ $dump_id }}">
    <input type="hidden" id="dump_session" value="{{ $dump_session }}">
    <input type="hidden" id="pat_address" value="{{ $pat_address }}">

    <script type="text/javascript">
        var dump_id      = $("#dump_id").val();
        var dump_session = $("#dump_session").val();
        var pat_address  = $("#pat_address").val();

        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(dump_session);
        var dec_address  = key.decrypt(pat_address).toString();

        $("#dec_pat_address").html(dec_address);

            var _token = '{{csrf_token()}}';
        $('#btn_download_pdf').click(function(){
            $.ajax({
                   url:"{{$module_url_path}}/invoice/download/{{isset($enc_booking_id) ? $enc_booking_id : '' }}",
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
                           url:"{{$module_url_path}}/generate_invoice_pdf",
                           type:'post',
                           data:{'arr_data' : response,'_token' : _token},
                           
                           success:function(response){
                                pdf_url = "{{$module_url_path}}/generate_invoice_pdf";
                                window.open(pdf_url, '_blank');
                           }

                        });
                      }
                   }
                });
        });    
    </script>

    @endsection