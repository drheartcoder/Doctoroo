 @extends('front.patient.layout._no_sidebar_master')
@section('main_content')

 <div class="header z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">Invoices &amp; Codes</h1>
</div>

<!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

<!-- <div class="container posrel has-header has-footer minhtnor"> -->
    <style>
        .text-bx {
          margin-top: 20px;
          margin-bottom: 20px;
          }
    </style>
    <div class="medi">
        <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
            <li class="tab truncate">
                <a href="#invoices" class="active">Invoices</a>
            </li>
            <li class="tab truncate">
                <a href="#codes">My Codes</a>
            </li>
        </ul>
        <div class="clear"></div>

        <div id="invoices" class="tab-content">
        @if(isset($invoice_data['data']) && !empty($invoice_data['data']))
            <ul class="collection brdrtopsd">
                @foreach($invoice_data['data'] as $val)
                    <li class="collection-item valign-wrapper">
                        <span class="invoiceIcon left circle center-align">
                            <img src="{{url('/')}}/public/new/images/doctor-invoice.svg"  />
                            <p>{{ isset($val['consultation_details']['consultation_date']) ? date('d M' , strtotime($val['consultation_details']['consultation_date'])) : 'NA' }}</p>
                        </span>
                        <div class="left coupon-details "><span class="title">Invoice Id: {{ isset($val['invoice_id']) ? $val['invoice_id'] : 'NA' }}</span>
                        </div>
                        <div class="right posrel">
                            <a href="#" data-activates='dropdown{{ isset($val["id"]) ? $val["id"] : "" }}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                        </div>
                        <ul id='dropdown{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless'>
                            <li><a href="{{url('')}}/patient/past_consultation/invoice/{{isset($val['id']) ? base64_encode($val['id']) : ''}}">View / Download Invoice</a></li>
                            <li><a href="{{url('')}}/patient/past_consultation/details/{{isset($val['booking_id']) ? base64_encode($val['booking_id']) : ''}}">View Consultation Details</a></li>
                            <li><a href="{{url('')}}/patient/setting/disputes">Dispute</a></li>
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="paginaton-block-main">{{ $paginate->render() }}</div>
        @else
            <h5 class="center-align no-data"> No data found</h5>
        @endif
        </div>


        <div id="codes" class="tab-content">
            <div class="gray-strip">
                <div class="bluedoc-text">
                    Available
                </div>
            </div>
            <ul class="collection brdrtopsd">
                @if(isset($coupon_arr))
                    @php $available='0'; @endphp
                    @foreach($coupon_arr as $val)
                        @if($val['status'] == 'pending')
                            @php $available++; @endphp
                            <li class="collection-item valign-wrapper">
                                <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                                <div class="left coupon-details "><span class="title">Code: {{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}</span>
                                    <small>Value: {{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'].'%' : '' }}</small>
                                    <span class="stat">Expiry: {{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}</span>
                                </div>
                                <div class="right posrel">
                                    <a href="#" data-activates='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                                </div>
                                <ul id='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless' data-code="{{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}" data-value="{{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'] : '' }}" data-expire-date="{{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}">

                                    <input type="hidden" class="doctor_title" value="{{isset($val['doctorinfo']['title']) ? $val['doctorinfo']['title'] : '' }}">

                                    <input type="hidden" class="doctor_first_name" value="{{isset($val['doctorinfo']['first_name']) ? $val['doctorinfo']['first_name'] : '' }}">

                                    <input type="hidden" class="doctor_last_name" value="{{isset($val['doctorinfo']['last_name']) ? $val['doctorinfo']['last_name'] : '' }}">
                                    <input type="hidden" class="doctor_shared_date" value="{{isset($val['coupondetails']['created_at']) ? date('d/m/Y', strtotime($val['coupondetails']['created_at'])) : '' }}">

                                    <li><a href="#view_code_details" class="view_code_details">View Details</a></li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    @if($available == '0')
                        <h5 class="center-align no-data"> No data found</h5>
                    @endif
                @endif
            </ul>
            <div class="gray-strip">
                <div class="bluedoc-text">
                    Used
                </div>
            </div>
            <ul class="collection brdrtopsd">

                @if(isset($coupon_arr))
                    @php $used='0'; @endphp 
                    @foreach($coupon_arr as $val)
                        @if($val['status'] == 'used')
                            @php $used++; @endphp
                            <li class="collection-item valign-wrapper">
                                <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                                <div class="left coupon-details "><span class="title">Code: {{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}</span>
                                    <small>Value: {{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'].'%' : '' }}</small>
                                    <span class="stat">Expiry: {{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}</span>
                                </div>
                                 <div class="right posrel">
                                    <a href="#" data-activates='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                                </div>
                                <ul id='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless' data-code="{{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}" data-value="{{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'] : '' }}" data-expire-date="{{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}">

                                    <input type="hidden" class="doctor_title" value="{{isset($val['doctorinfo']['title']) ? $val['doctorinfo']['title'] : '' }}">

                                    <input type="hidden" class="doctor_first_name" value="{{isset($val['doctorinfo']['first_name']) ? $val['doctorinfo']['first_name'] : '' }}">

                                    <input type="hidden" class="doctor_last_name" value="{{isset($val['doctorinfo']['last_name']) ? $val['doctorinfo']['last_name'] : '' }}">
                                    <input type="hidden" class="doctor_shared_date" value="{{isset($val['coupondetails']['created_at']) ? date('d/m/Y', strtotime($val['coupondetails']['created_at'])) : '' }}">

                                    <li><a href="#view_code_details" class="view_code_details">View Details</a></li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    @if($used == '0')
                        <h5 class="center-align no-data"> No data found</h5>
                    @endif
                @endif
            </ul>
            <div class="gray-strip">
                <div class="bluedoc-text">
                    Expired
                </div>
            </div>
            <ul class="collection brdrtopsd">    
                @if(isset($coupon_arr))
                    @php $expired='0'; @endphp 
                    @foreach($coupon_arr as $val)
                        @if($val['status'] == 'expired')
                            @php $expired++; @endphp
                            <li class="collection-item valign-wrapper">
                                <span class="available-coupon left circle"><img src="{{url('/')}}/public/new/images/coupon.svg"  /></span>
                                <div class="left coupon-details "><span class="title">Code: {{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}</span>
                                    <small>Value: {{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'].'%' : '' }}</small>
                                    <span class="stat red-text">Expiry: {{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}</span>
                                </div>
                                 <div class="right posrel">
                                    <a href="#" data-activates='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                                </div>
                                <ul id='dropdown_{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless' data-code="{{isset($val['coupondetails']['code']) ? $val['coupondetails']['code'] : '' }}" data-value="{{isset($val['coupondetails']['value']) ? $val['coupondetails']['value'] : '' }}" data-expire-date="{{isset($val['coupondetails']['expiry_date']) ? date('d.m.Y',strtotime($val['coupondetails']['expiry_date'])) : '' }}">

                                    <input type="hidden" class="doctor_title" value="{{isset($val['doctorinfo']['title']) ? $val['doctorinfo']['title'] : '' }}">

                                    <input type="hidden" class="doctor_first_name" value="{{isset($val['doctorinfo']['first_name']) ? $val['doctorinfo']['first_name'] : '' }}">

                                    <input type="hidden" class="doctor_last_name" value="{{isset($val['doctorinfo']['last_name']) ? $val['doctorinfo']['last_name'] : '' }}">
                                    <input type="hidden" class="doctor_shared_date" value="{{isset($val['coupondetails']['created_at']) ? date('d/m/Y', strtotime($val['coupondetails']['created_at'])) : '' }}">

                                    <li><a href="#view_code_details" class="view_code_details">View Details</a></li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    @if($expired == '0')
                        <h5 class="center-align no-data"> No data found</h5>
                    @endif
                @endif
                
            </ul>
            <div class="questiononline center-align bluedoc-text">Want More Codes? <a class="bluedoc-text" href="{{url('/patient')}}/setting/invitation">Invite a friend</a></div>

        </div>

    </div>

    </div>
</div>
    <!--Container End-->

    <div id="view_code_details" class="modal requestbooking small-modal date-modal">
        <div class="modal-content">
            <h4 class="center-align">Discount Code Details</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx">
                        <input id="code" type="text" class="validate" readonly="true">
                        <label for="code">Code</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx">
                        <input id="value" type="text" class="validate" readonly="true">
                        <label for="value">Value in %</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx">
                        <input id="valid_date" type="text" class="validate" readonly="true">
                        <label for="valid_date">Date of Valid</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6 l6">
                     Shared : <span id="shared_by"></span>
                </div>
                <div class="col s6 l6">
                   Date : <span id="shared_date"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a class="modal-action modal-close waves-effect waves-green btn-cancel-cons" style="cursor: pointer;">Close</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
            $('.view_code_details').click(function(){
                $('#code').val($(this).parent().parent().attr('data-code'));
                $('#value').val($(this).parent().parent().attr('data-value'));
                $('#valid_date').val($(this).parent().parent().attr('data-expire-date'));

                if($('#code').val() != '')
                {
                    $('#code').next('label').addClass('active');
                }
                 if($('#value').val() != '')
                {
                    $('#value').next('label').addClass('active');
                }
                 if($('#valid_date').val() != '')
                {
                    $('#valid_date').next('label').addClass('active');
                }
                var title = $(this).closest('ul').find('.doctor_title').val();
                var first_name = $(this).closest('ul').find('.doctor_first_name').val();
                var last_name = $(this).closest('ul').find('.doctor_last_name').val();

                $('#shared_by').html(title+' '+first_name+' '+last_name);
                $('#shared_date').html($(this).closest('ul').find('.doctor_shared_date').val());

            });
            
        });
    </script>

    @endsection