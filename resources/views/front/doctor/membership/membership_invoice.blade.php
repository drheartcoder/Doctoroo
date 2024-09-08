@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead nopad">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/membership/billing" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        
        <h1 class="main-title right-align padding-right-less">Tax Invoice for {{isset($membership_arr['created_at']) ? date('dS M,Y', strtotime($membership_arr['created_at'])) : '' }} <a class="invoice-down" target="_blank" id="btn_download_pdf" href="javascript:void(0)"><i class="material-icons">&#xE2C4;</i></a></h1>
    </div>
   <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')
    <div class="mar300  has-header minhtnor">

        <div class="container">
            <div class="consultation-details">
                <div class="sub-header  z-depth-2">
                    <div class="row detInfo">
                        <div class="col s6 m6 l6 left-align">
                            <div class="data">
                                <small>TO:</small>
                                <strong class="white-text">{{isset($membership_arr['userinfo']['title']) ? $membership_arr['userinfo']['title'] : ''}} {{isset($membership_arr['userinfo']['first_name']) ? $membership_arr['userinfo']['first_name'] : ''}} {{isset($membership_arr['userinfo']['last_name']) ? $membership_arr['userinfo']['last_name'] : ''}}</strong>
                                <label class="white-text address" id="dec_address"></label>
                            </div>
                        </div>
                        <div class="col s6 m6 l6">
                            <div class="data right"><small>FROM:</small>
                                <strong class="white-text">{{isset($admin_arr['name']) &&  !empty($admin_arr) ? $admin_arr['name'] : ''}}</strong>
                                <label class="white-text address">
                                    {{isset($admin_arr['address']) &&  !empty($admin_arr) ? $admin_arr['address'] : ''}}
                                </label>
                                <span class="abnnum"><em>ABN: {{isset($admin_arr['abn']) &&  !empty($admin_arr) ? $admin_arr['abn'] : ''}}</em></span>
                            </div>
                        </div>
                    </div>
                    <div class="row detInfo mrtp">
                        <div class="col s12 m12 l12 left-align">
                            <div class="data left">
                                <label class="white-text">
                                    {{ isset($membership_arr['total_amount']) ? '$'.number_format($membership_arr['total_amount'], 2, '.', '') : '' }}
                                </label>
                                <small>Total</small></div>
                            <div class="data left">
                                <label class="white-text">
                                        {{isset($membership_arr['status']) && $membership_arr['status'] == 'paid' ? 'Paid' : '' }}
                                        {{isset($membership_arr['status']) && $membership_arr['status'] == 'unpaid' ? 'Unpaid' : '' }}
                                </label>
                                <small>Payment Status</small></div>
                            <div class="data left">
                                <label class="white-text">{{isset($membership_arr['created_at']) ? date('d M, Y', strtotime($membership_arr['created_at'])) : '' }}</label>
                                <small>Billing date</small></div>
                        </div>
                    </div>
                    <a class="btn-floating btn-large halfway-fab waves-effect waves-light green newFontsize"><i class="material-icons">check</i></a>
                </div>
                <div class="time-date ">
                    <div class="row">
                        <div class="col s7 m6 l5"> <img src="{{url('')}}/public/new/images/clock-icon.png" alt="" />
                            <label class="time mrtplft">{{isset($membership_arr['start_date']) ? date('M d, Y', strtotime($membership_arr['start_date'])) : '' }} - {{isset($membership_arr['end_date']) ? date('M d, Y', strtotime($membership_arr['end_date'])) : '' }}</label>
                            <span class="greenColr">Billing Period</span>
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
                                    <span class="itemliid"></span> <span class="itemliname">Membership ( {{isset($membership_arr['package']) && $membership_arr['package'] == 'monthly' ? 'Monthly' : '' }}{{isset($membership_arr['package']) && $membership_arr['package'] == 'annually' ? 'Bi - Annually' : '' }} )</span>
                                </div>
                                <div class="col s4 m2 l2 valign-bottom">
                                    <label class="price">
                                        {{isset($membership_arr['amount']) && !empty($membership_arr['amount']) ? '$'.number_format($membership_arr['amount'], 2, '.', '') : 'NA'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if(isset($membership_arr['discount_data']) && $membership_arr['discount_data'] != null)
                        <div class="listitems">
                            <div class="row valign">
                                <div class="col s8 m10 l10 valign-nor ">
                                    <span class="itemliid"></span> <span class="itemliname">Discount Code ( {{ isset($membership_arr['discount_data']['code']) ? $membership_arr['discount_data']['code'] : '' }} )</span>
                                </div>
                                <div class="col s4 m2 l2 valign-bottom">
                                    <label class="price">
                                        {{ isset($membership_arr['discount_data']['percentage']) ? $membership_arr['discount_data']['percentage'].'%' : '' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="listitems">
                            <div class="row valign">
                                <div class="col s8 m10 l10 valign-nor ">
                                    <span class="itemliid"></span> <span class="itemliname">GST </span>
                                </div>
                                <div class="col s4 m2 l2 valign-bottom">
                                    <label class="price">
                                        10 %
                                    </label>
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
                                <label class="price">{{ isset($membership_arr['total_amount']) ? '$'.$membership_arr['total_amount'] : '' }}</label>
                            </div>
                        </div>
                    </div>
                    <!--total sub total end here-->
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var card_id                = "{{ isset($membership_arr['userinfo']['dump_id']) && !empty($membership_arr['userinfo']['dump_id']) ? $membership_arr['userinfo']['dump_id'] : '' }}"
    var userkey                = "{{ isset($membership_arr['userinfo']['dump_session']) && !empty($membership_arr['userinfo']['dump_session']) ? $membership_arr['userinfo']['dump_session'] : '' }}";
    var address                = "{{isset($membership_arr['doctorinfo']['address']) ? $membership_arr['doctorinfo']['address'] : ''}}";
    var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
    var api                    = virgil.API(VIRGIL_TOKEN);
    var key                    = api.keys.import(userkey);    
    
    if(address!='')
    {
        var _address = key.decrypt(address).toString();
        $('#dec_address').html(_address);
    }

    var _token = '{{csrf_token()}}';
    $('#btn_download_pdf').click(function(){
        $.ajax({
               url:"{{$module_url_path}}/invoice/download/{{isset($enc_id) ? $enc_id : '' }}",
               type:'get',
               success:function(response){
                  if(response!='')
                  {
                    if(response.membership_arr.doctorinfo.address != "")
                    {
                        var dec_address = key.decrypt(response.membership_arr.doctorinfo.address).toString();
                        response.membership_arr.doctorinfo.dec_address = dec_address;
                    }

                    $.ajax({
                       url:"{{$module_url_path}}/generate_membership_invoice_pdf",
                       type:'post',
                       data:{'arr_data' : response,'_token' : _token},
                       
                       success:function(response){
                            pdf_url = "{{$module_url_path}}/generate_membership_invoice_pdf";
                            window.open(pdf_url, '_blank');
                       }

                    });
                  }
               }
            });
    });    
</script>

@endsection