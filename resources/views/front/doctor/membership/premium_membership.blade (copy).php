@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead nopad">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align">Premium Membership</h1>
        <!--<div class="main-title">Premium Membership</div>-->
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')


    <div class="mar300  has-header minhtnor">
        <!--<div class="bluedoc-bg center-align white-text" style="padding:10px; font-size: 14px; ">
            <div class="select-membership"><a href="{{url('/')}}/doctor/membership/premium" class="premium">Premium</a></div>
        </div>-->
        <div class="price-container">
            <div class="head-medical-pres">
                <h2 class="center-align green-text">Your Time, Your Way</h2>
            </div>

            @if(isset($arr_premium_rates) && !empty($arr_premium_rates))
                @php
                    $day_rate   = isset($arr_premium_rates['day_rate'])?$arr_premium_rates['day_rate']:'';
                    $night_rate = isset($arr_premium_rates['night_rate'])?$arr_premium_rates['night_rate']:'';
                @endphp
            @else
                @php
                    $day_rate   = "";
                    $night_rate = "";
                @endphp
            @endif

            <div class="row bor-btm">
                <div class="col l9 s12">
                    <p class="center-align bluedoc-text"><strong>Enter your custom consultation rates below:</strong></p>
                    <div class="row">
                        <div class="col m6">
                            <div class="membership-rate-box">
                                <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text">Premium Day rate
                                        <small>(8am - 8pm)</small>
                                    </h3>
                                    <form method="post" action="{{ url('/') }}/doctor/membership/store_day_rate">
                                        {{ csrf_field() }}
                                        <div class="custom-price">
                                            <div class="input-field text-bx lessmar" >
                                                <input type="text" id="edit_day_rate" name="edit_day_rate" class="validate dollar-textbx" value="{{ $day_rate }}">
                                                <label for="edit_day_rate" class="truncate dollar-sign">$</label>
                                            </div>  
                                        </div>
                                        <div class="center-align custom-price-message">Enter Custom Day Rate eg. $10</div>
                                        <div class="center-align"><button type="submit" class="btn grey-btn" id="btn_day_calc_save" disabled>Save</button></div>
                                        <p class="center-align bluedoc-text">The above rate will be added to our standard rate. See below for pricing details:</p>
                                    </form>
                                </div>
                                <div class="table price-list">
                                    <div class="table-row table-heading">
                                        <div class="table-cell">Call Time (mins)</div>
                                        <div class="table-cell">Patient Charge</div>
                                        <div class="table-cell">Your Earning</div>
                                        <!-- <div class="table-cell">Your pro-rata hourly rate</div> -->
                                    </div>
                                    @if(isset($arr_premium) && sizeof($arr_premium)>0)
                                        @foreach($arr_premium as $day)
                                            <div class="table-row">
                                                <div class="table-cell call-time">Up to {{ $day['call_time'] }} mins</div>
                                                <div class="table-cell patient-charge show_day_patient_charge{{ $day['id'] }}">${{ $day['day_patient_charge'] }}</div>
                                                <div class="table-cell doctor-earning show_day_doctor_earning{{ $day['id'] }}">${{ $day['day_doctor_earning'] }}</div>
                                                <!-- <div class="table-cell hourly-rate">${{ $day['day_pro_rata_hourly_rate'] }}</div> -->
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col m6">
                            <div class="membership-rate-box">
                                <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text">Premium Night rate
                                        <small>(8pm - 8am)</small>
                                    </h3>
                                    <form method="post" action="{{ url('/') }}/doctor/membership/store_night_rate">
                                        {{ csrf_field() }}
                                        <div class="custom-price">
                                            <div class="input-field text-bx lessmar" >
                                                <input type="text" id="edit_night_rate" name="edit_night_rate" class="validate dollar-textbx" value="{{ $night_rate }}">
                                                <label for="edit_night_rate" class="truncate dollar-sign">$</label>
                                            </div>
                                        </div>
                                        <div class="center-align custom-price-message">Enter Custom Day Rate eg. $10</div>
                                        <div class="center-align"><button type="submit" class="btn grey-btn" id="btn_night_calc_save" disabled>Save</button></div>
                                        <p class="center-align bluedoc-text">The above rate will be added to our standard rate. See below for pricing details:</p>
                                    </form>
                                </div>
                                <div class="table price-list">
                                    <div class="table-row table-heading">
                                        <div class="table-cell">Call Time (mins)</div>
                                        <div class="table-cell">Patient Charge</div>
                                        <div class="table-cell">Your Earning</div>
                                        <!-- <div class="table-cell">Your pro-rata hourly rate</div> -->
                                    </div>
                                    @if(isset($arr_premium) && sizeof($arr_premium)>0)
                                        @foreach($arr_premium as $night)
                                            <div class="table-row">
                                                <div class="table-cell call-time">Up to {{ $night['call_time'] }} mins</div>
                                                <div class="table-cell patient-charge show_night_patient_charge{{ $night['id'] }}">${{ $night['night_patient_charge'] }}</div>
                                                <div class="table-cell doctor-earning show_night_doctor_earning{{ $night['id'] }}">${{ $night['night_doctor_earning'] }}</div>
                                                <!-- <div class="table-cell hourly-rate">${{ $night['night_pro_rata_hourly_rate'] }}</div> -->
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l3 s12">
                    <p class="center-align bluedoc-text"><strong>Next Step:</strong></p>
                    <div class="row">
                        <div class="col s12 center-align">
                            <a href="{{$module_url_path}}/payment" class="new-btn">SELECT PREMIUM
                            <small>{{isset($membership_plan_arr['monthly_amount']) ? '$'.$membership_plan_arr['monthly_amount'] : '' }}/mo. + GST</small></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <h2 class="faqhead center-align">Frequently Asked Questions</h2>
                    @if(isset($arr_premium_faq) && sizeof($arr_premium_faq)>0)
                    @foreach($arr_premium_faq as $premium_faq)
                    <ul class="collapsible faqbox" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>{{$premium_faq['question']}}</div>
                            <div class="collapsible-body"><span>
                                
                                {{$premium_faq['answer']}}
                            </span></div>
                        </li>
                    </ul>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="status_msg" id="status_msg" name="status_msg" value="{{ Session::get('status_msg') }}" style="display: none;"/>
    <a class="open_status_popup" href="#show_status_msg" style="display: none;"></a>
    
    <div id="show_status_msg" class="modal date-modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div></div>
                    <p class="center-align">{{ Session::get('status_msg') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var status_msg = $('#status_msg').val();
            if(status_msg != '')
            {
                $(".open_status_popup").click();
            }

            $('#edit_day_rate').on('keyup',function(){
                var edit_value = $('#edit_day_rate').val();
                if(edit_value != '')
                {
                    var doctoroo_commission = parseInt(10) + parseInt(edit_value) * (parseInt(15)/parseInt(100));
                    var patient_charge = parseInt(edit_value) + doctoroo_commission;
                    //alert(patient_charge);
                    var doctor_earning = edit_value;
                    for(i = 1; i <= 4; i++)
                    {
                        $('.show_day_patient_charge'+i).html('$' + patient_charge);
                        patient_charge = parseInt(patient_charge) + parseInt(edit_value);

                        $('.show_day_doctor_earning'+i).html('$' + doctor_earning);
                        doctor_earning = parseInt(doctor_earning) + parseInt(edit_value);
                    }

                    $("#btn_day_calc_save").attr("disabled", false);
                    $('#btn_day_calc_save').css('background','#50ab50');
                    $('#btn_day_calc_save').css('color','#fff');
                }
                else
                {
                    $("#btn_day_calc_save").attr("disabled", true);
                    $('#btn_day_calc_save').css('background','#ebeced');
                    $('#btn_day_calc_save').css('color','#7f7f7f');
                }
            });

            $('#edit_night_rate').on('keyup',function(){
                var edit_value = $('#edit_night_rate').val();
                if(edit_value != '')
                {
                    var doctoroo_commission = parseInt(10) + parseInt(edit_value) * (parseInt(15)/parseInt(100));
                    var patient_charge = parseInt(edit_value) + doctoroo_commission;
                    //alert(patient_charge);
                    
                    var doctor_earning = edit_value;
                    for(i = 1; i <= 4; i++)
                    {
                        $('.show_night_patient_charge'+i).html('$' + patient_charge);
                        patient_charge = parseInt(patient_charge) + parseInt(edit_value);

                        $('.show_night_doctor_earning'+i).html('$' + doctor_earning);
                        doctor_earning = parseInt(doctor_earning) + parseInt(edit_value);
                    }

                    $("#btn_night_calc_save").attr("disabled", false);
                    $('#btn_night_calc_save').css('background','#50ab50');
                    $('#btn_night_calc_save').css('color','#fff');
                }
                else
                {
                    $("#btn_night_calc_save").attr("disabled", true);
                    $('#btn_night_calc_save').css('background','#ebeced');
                    $('#btn_night_calc_save').css('color','#7f7f7f');
                }
            });

             $(function () {
        $("input[id*='edit_day_rate'],input[id*='edit_night_rate']").keydown(function (event) {

            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
            
        });
    </script>

    @endsection