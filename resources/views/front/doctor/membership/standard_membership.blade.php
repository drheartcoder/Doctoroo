@extends('front.doctor.layout.new_master')
@section('main_content')

<div class="header bookhead nopad">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
       
        <h1 class="main-title center-align small-device-text">Choose the right doctoroo membership for you</h1>

    </div>
   <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">
        <div class="bluedoc-bg center-align white-text" style="padding:10px; font-size: 14px; ">
            <div class="select-membership"><a href="{{url('/')}}/doctor/membership/standard" class="active standard">Standard</a> <a href="{{ url('/') }}/doctor/membership/premium" class="premium" >Premium</a></div>
            <div class="center-align"><a href="{{url('/')}}/doctor/membership/select_membership" class="white-text"><em>what's the difference</em></a></div>
        </div>
        <div class="price-container">
            <div class="head-medical-pres">
                <h2 class="center-align bluedoc-text">Standard Membership
                <small class="new-line">Free - No Monthly Fee</small></h2>
            </div>
            <div class="center-align bluedoc-text">
               <h3 class="green-text new-line">Use Anytime, Anywhere <span class="new-line">No commitments or limits</span></h3>
                <p>Below is your earning potential for day and night consultations with our standard membership. <br> If you wish to increase or customise your consultation rate, our popular <a href="premium-membership.html" class="green-text">premium membership</a> is also available</p>
            </div>
            <div class="row bor-btm">
                <div class="col l9 s12">
                  
                    <div class="row">
                        <div class="col m6">
                           <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text">Day rate
                             <small>(10am - 8pm)</small>
                            </h3>
                                   
                                </div>
                                {{--  {{dump($arr_membership)}}  --}}
                            <div class="membership-rate-box responsive-table">
                                
                                <div class="table price-list table-round-corner">
                                    <div class="table-row table-heading">
                                        <div class="table-cell">Call Time (mins)</div>
                                        <div class="table-cell">Patient Charge</div>
                                        <div class="table-cell">Your Earning</div>
                                        <div class="table-cell">Your pro-rata hourly rate</div>
                                    </div>
                                     @if(isset($arr_standard) && sizeof($arr_standard)>0)
                                     @foreach($arr_standard as $day)
                                    <div class="table-row">
                                        <div class="table-cell call-time">{{$day['time']}}</div>
                                        <div class="table-cell patient-charge">{{$day['patient_charges']}}</div>
                                        <div class="table-cell doctor-earning">${{$day['day']}}</div>
                                        <div class="table-cell hourly-rate">${{$day['day_hourly_rate']}}</div>
                                    </div>
                                     @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col m6">
                           <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text"> Night rate
                             <small>(8pm - 10am)</small>
                            </h3>   
                                     </div>
                            <div class="membership-rate-box responsive-table">
                                
                                <div class="table price-list table-round-corner">
                                    <div class="table-row table-heading ">
                                        <div class="table-cell">Call Time (mins)</div>
                                        <div class="table-cell">Patient Charge</div>
                                        <div class="table-cell">Your Earning</div>
                                        <div class="table-cell">Your pro-rata hourly rate</div>
                                    </div>
                                    @if(isset($arr_standard) && sizeof($arr_standard)>0)
                                     @foreach($arr_standard as $night)
                                    
                                    <div class="table-row">
                                        <div class="table-cell call-time">{{$night['time']}}</div>
                                        <div class="table-cell patient-charge">{{$night['patient_charges']}}</div>
                                        <div class="table-cell doctor-earning">${{$night['night']}}</div>
                                        <div class="table-cell hourly-rate">${{$night['night_hourly_rate']}}</div>
                                    </div>
                                     @endforeach
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="col l3 s12">
                    <p class="center-align bluedoc-text margin-top-45px" ><strong>Next Step:</strong></p>
                    <div class="row">
                        <div class="col s12 center-align">
                            <a href="javascript:void(0)" class="new-btn" >Select Standard
                            <small>Free</small></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <h2 class="faqhead center-align">Frequently Asked Questions</h2>
                     
                    @if(isset($arr_standard_faq) && sizeof($arr_standard_faq)>0)
                    @foreach($arr_standard_faq as $standard_faq)

                    <ul class="collapsible faqbox" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>{{$standard_faq['question']}}</div>
                            <div class="collapsible-body">
                                <span>
                                   {{$standard_faq['answer']}}
                                </span>
                            </div>
                        </li>
                      
                       
                    </ul>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection