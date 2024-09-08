@extends('front.doctor.layout.new_master')
@section('main_content')

<div class="header bookhead nopad">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
       
        <h1 class="main-title center-align">Membership Billing</h1>

    </div>
   <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <style>
        .bill-date::before {
            content: "Bill Date :";
        }
        
        .invoice-no::before {
            content: "Invoice No. :";
        }
        
        .invoice-total::before {
            content: "Total :";
        }
        
        .invoice-status::before {
            content: "Status :";
        }
        
        .invoice-details::before {
            content: "View Invoice :";
        }
    </style>

     <div class="mar300  has-header minhtnor">
        <div class="doctor-container">
            <div class="z-depth-3 round-box">
                <div class="blue-border-block-top"></div>
                <div class="transactions-table table-responsive paitent-list-table patient-consultation-history">
                    <!--membership billing  starts here-->
                    <div class="new-request-head">
                        Membership Billing
                    </div>
                    <div class="table ">
                        <div class="table-row heading hidden-xs">
                            <div class="table-cell">Bill Date</div>
                            <div class="table-cell">Invoice No.</div>
                            <div class="table-cell">Total</div>
                            <div class="table-cell">Status</div>
                            <div class="table-cell center-align">Invoice Details</div>
                        </div>
                        @if(isset($membership_arr['data']) && !empty($membership_arr['data']))
                            @foreach($membership_arr['data'] as $val)
                                <div class="table-row content-row-table">
                                    <div class="table-cell bill-date">
                                        {{isset($val['created_at']) ? date('D, M d,Y', strtotime($val['created_at'])) : '' }}
                                    </div>
                                    <div class="table-cell invoice-no">{{isset($val['invoice_no']) && !empty($val['invoice_no']) ? $val['invoice_no'] : 'NA' }}</div>
                                    <div class="table-cell invoice-total">
                                        {{isset($val['total_amount']) && !empty($val['total_amount']) ? '$'.$val['total_amount'] : 'NA' }}
                                    </div>
                                    <div class="table-cell invoice-status">
                                        {{isset($val['status']) && $val['status'] == 'paid' ? 'Paid' : '' }}
                                        {{isset($val['status']) && $val['status'] == 'unpaid' ? 'Unpaid' : '' }}
                                    </div>
                                    <div class="table-cell invoice-details view-details-btn"><a href="{{$module_url_path}}/invoice/{{isset($val['id']) ? base64_encode($val['id']) : '' }}">View Invoice</a></div>
                                </div>
                            @endforeach
                        @else
                            <div class="table-row content-row-table">
                                <div class="table-cell bill-date">
                                    <span class="green-text center-align">No data found</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--membership billing list ends here-->
                    
                    <div class="paginaton-block-main">
                        <ul>
                            <li>
                                {{$paginate->render()}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="blue-border-block-bottom"></div>
            </div>
        </div>
    </div>
@endsection