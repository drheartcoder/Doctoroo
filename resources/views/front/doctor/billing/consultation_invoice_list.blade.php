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
                    <a href="#consultation-invoices" class="active"><span><img src="{{url('/')}}/public/doctor_section/images/invoice-white.svg" alt="icon" class="tab-icon"/> </span> Consultation Invoices </a>
                </li>
                <li class="tab">
                  <a href="#bank-account-details" onclick="location.href = '{{url('/')}}/doctor/billing/bank_account';"> <span><img src="{{url('/')}}/public/doctor_section/images/bank.svg" alt="icon" class="tab-icon"/> </span> Bank Account Details</a>
                </li>
                <li class="tab">
                    <a href="#discount-codes" onclick="location.href = '{{url('/')}}/doctor/billing/my_discount';"> <span><img src="{{url('/')}}/public/doctor_section/images/discount-codes.svg" alt="icon" class="tab-icon"/> </span> My Discount Codes</a>
                </li>
            </ul>
        </div>

        <div id="consultation-invoices" class="tab-content medi patient-list-block ">
            <div class="head-medical-pres">
                <h2 class="center-align">Consultation Invoices</h2>
                <span class="posleft qusame rescahnge "><a href="" onclick="window.history.back()" class="border-btn btn round-corner center-align">&lt; Back</a></span>
            </div>
            <div class="clearfix"></div>
            <div class="z-depth-3 round-box">
                <div class="blue-border-block-top"></div>
                <div class="transactions-table table-responsive paitent-list-table ">
                    <!--div format starts here-->
                    <div class="table ">
                        @if(isset($invoice_data['data']) && sizeof($invoice_data['data'])>0)
                            <div class="table-row heading hidden-xs">
                                <div class="table-cell">Patients Name</div>
                                <div class="table-cell">Time</div>
                                <div class="table-cell">Invoice No.</div>
                                <div class="table-cell">Consultation No.</div>
                                <div class="table-cell">Sub Total</div>
                                <div class="table-cell">Status</div>
                                <div class="table-cell center-align">Invoice Details</div>
                            </div>
                            @php
                                $booking_id = '';
                                $invoice_id = [];
                                $payment_amount = 0;
                                $cnt = 0;
                            @endphp
 
                            @foreach($invoice_data['data'] as $invoice)
                                @php
                                    $booking_id = $invoice['booking_id'];
                                @endphp

                                <?php $cnt1 = $cnt++; ?>
                                @if(!in_array($invoice['invoice_id'], $invoice_id))
                                   <?php  $invoice_id[] = $invoice['invoice_id'];  $payment_amount += $invoice['payment_amount'];?>
                                   <div class="table-row content-row-table {{ $invoice['invoice_id'].$cnt1 }}" >
                                        <div class="table-cell patients-name">
                                            @if(isset($invoice['user_data']['profile_image']) && $invoice['user_data']['profile_image']!="" && file_exists($profile_image_base_img_path.$invoice['user_data']['profile_image']))
                                                <img src="{{ $profile_image_public_img_path.$invoice['user_data']['profile_image'] }}" class="patient-profile-pic">
                                            @else
                                                <img src="{{ $profile_image_public_img_path.'default-image.jpeg' }}" class="patient-profile-pic">
                                            @endif 
                                            <span class="patient-name-block">{{ $invoice['user_data']['title'].' '.$invoice['user_data']['first_name'].' '.$invoice['user_data']['last_name'] }}</span>
                                        </div> 
                                        <div class="table-cell consultation-time">{{ date("M d, Y", strtotime($invoice['updated_at'])) }}</div>
                                        <div class="table-cell invoice-no">{{ $invoice['invoice_id'] }}</div>
                                        <div class="table-cell invoice-no">{{ $invoice['consultation_details']['consultation_id'] }}</div>
                                        <div class="table-cell invoice-total">${{ $invoice['payment_amount'] }}</div>
                                        <div class="table-cell invoice-status">@if($invoice['payment_status'] == 'completed') Paid @else Un-Paid @endif</div>
                                        <div class="table-cell invoice-details view-details-btn"><a href="{{ url('/')}}/doctor/billing/view/{{ base64_encode($invoice['booking_id']) }}">Invoice details</a></div>
                                    </div>
                                @else
                                    <?php $payment_amount += $invoice['payment_amount'];?>
                                    <div class="table-row content-row-table {{ $invoice['invoice_id'].$cnt1}}" >
                                        <div class="table-cell patients-name">
                                            @if(isset($invoice['user_data']['profile_image']) && $invoice['user_data']['profile_image']!="" && file_exists($profile_image_base_img_path.$invoice['user_data']['profile_image']))
                                                <img src="{{ $profile_image_public_img_path.$invoice['user_data']['profile_image'] }}" class="patient-profile-pic">
                                            @else
                                                <img src="{{ $profile_image_public_img_path.'default-image.jpeg' }}" class="patient-profile-pic">
                                            @endif 
                                            <span class="patient-name-block">{{ $invoice['user_data']['title'].' '.$invoice['user_data']['first_name'].' '.$invoice['user_data']['last_name'] }}</span>
                                        </div> 
                                        <div class="table-cell consultation-time">{{ date("M d, Y", strtotime($invoice['updated_at'])) }}</div>
                                        <div class="table-cell invoice-no">{{ $invoice['invoice_id'] }}</div>
                                        <div class="table-cell invoice-no">{{ $invoice['consultation_details']['consultation_id'] }}</div>
                                        <div class="table-cell invoice-total">${{ $invoice['payment_amount'] }}</div>
                                        <div class="table-cell invoice-status">@if($invoice['payment_status'] == 'completed') Paid @else Un-Paid @endif</div>
                                        <div class="table-cell invoice-details view-details-btn"><a href="{{ url('/')}}/doctor/billing/view/{{ base64_encode($invoice['booking_id']) }}">Invoice details</a></div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            var cnt     = '{{$cnt1}}';
                                            var inc_id  = '{{ $invoice["invoice_id"]}}';
                                            var pre_cnt = parseInt(cnt) - parseInt(1);
                                            if(pre_cnt < 0){
                                                pre_cnt = 0;
                                            }
                                            $('.'+inc_id+pre_cnt).hide();
                                        });
                                    </script>
                                @endif
                            @endforeach

                        @else
                           <h5 class="no-data">No data found</h5>
                        @endif
                    </div>
                    <div class="paginaton-block-main"> </div>
                </div>
                <div class="blue-border-block-bottom"></div>
            </div>
        </div>
    </div>
    <script>
        $(".expand-more-btn").on("click", function () {
            $(this).parent(".doctor-consultation-note-content").addClass("active");
        });
        $(".close-more-btn").on("click", function () {
            $(this).parent(".doctor-consultation-note-content").removeClass("active");
        });
    </script>

    @endsection