@extends('front.patient.layout._after_patient_login_master') @section('main_content')
<!--dashboard section-->
<style>
    .star {
        color: red;
    }
</style>
<div class="middle-section">
    <div class="container">
        @include('front.layout._operation_status')
        <div class="row">
            <div class="col-sm-12">
                <div class="med-his-txt">
                    Your medical history is a record of your previous and present conditions, illnesses and surgeries.
                    <br/> By completing your medical history accurately, it allows your doctor to deliver proper care. It can also help speed the diagnosis of any complaints and point the way to proper treatment for you.
                </div>
            </div>
        </div>
        <form action="{{ $module_url_path.'/store_step_2'}}" method="post" name="frm_step_two">
            {{csrf_field()}}

            <input type="hidden" name="family_member_id" value="{{ $family_member_id or '' }}">


            <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="see-d-dash-panel text-center">

                            @include('front.patient.layout.middlebar')

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-box">
                            <h4 style="padding:0;">Lifestyle
                     <span>
                     Many of our lifestyle choices directly or indirectly contribute to our health
                     </span>
                  </h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="user-box ">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable">Daily Sleep</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="select-style my-pati">
                                        <select class="frm-select" name="daily_sleep" id="daily_sleep">
                                            <option value="">-Daily Sleep-</option>
                                            <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='< 4' ) selected='selected' @endif value="< 4">
                                                < 4</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='4-5' ) selected='selected' @endif value="4-5">4 - 5</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='5-6' ) selected='selected' @endif value="5-6">5 - 6</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='6-7' ) selected='selected' @endif value="6-7">6 - 7</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='7-8' ) selected='selected' @endif value="7-8">7 - 8</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='8-9' ) selected='selected' @endif value="8-9">8 - 9</option>
                                                    <option @if(isset($arr_medicalhistory[ 'daily_sleep']) && $arr_medicalhistory[ 'daily_sleep']=='10+' ) selected='selected' @endif value="10+">10+</option>
                                        </select>
                                    </div>
                                    <div class="err" id="err_daily_sleep"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable">Smoking</div>
                                </div>
                                <div class="col-sm-6 col-md-7 col-lg-7">
                                    <input type="text" name="smoking_frequency" class="form-inputs" id="smoking_frequency" value="{{isset($arr_medicalhistory['smoking_frequency'])?$arr_medicalhistory['smoking_frequency']:''}}">
                                    <div class="err" id="err_smoking_frequency"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="user-box ">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable">Diet</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="select-style my-pati">
                                        <select class="frm-select" name="diet_pattern" id="diet_pattern" onchange="showOtherDiet(this.value)">
                                            <option value="">-Select Diet-</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Western dietary pattern' ) selected='selected' @endif value="Western dietary pattern">Western dietary pattern</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Vegetarian' ) selected='selected' @endif value="Vegetarian">Vegetarian</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Vegan' ) selected='selected' @endif value="Vegan">Vegan</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Spicy diet' ) selected='selected' @endif value="Spicy diet">Spicy diet</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Gluten free' ) selected='selected' @endif value="Gluten free">Gluten free</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Lactose-free diet' ) selected='selected' @endif value="Lactose-free diet">Lactose-free diet</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Low-fat, high protein' ) selected='selected' @endif value="Low-fat, high protein">Low-fat, high protein</option>
                                            <option @if(isset($arr_medicalhistory[ 'diet_pattern']) && $arr_medicalhistory[ 'diet_pattern']=='Other' ) selected='selected' @endif value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="err" id="err_diet_pattern"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div id="other_diet_div" style="display:none">
                            <div class="user-box">
                                <div class="row">
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                        <div class="hidden-xs hidden-sm form-lable">&nbsp;</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 col-lg-7">
                                        <input type="text" name="diet_details" id="diet_details" value="{{isset($arr_medicalhistory['diet_other'])?$arr_medicalhistory['diet_other']:''}}" placeholder="Please enter your diet details..." class="form-inputs" />
                                        <div class="err" id="err_diet_details"> </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable big-lble">Recreational drug use (what and how often)
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <input type="text" placeholder="Recreational drug use" value="{{isset($arr_medicalhistory['recreational_drug_use'])?$arr_medicalhistory['recreational_drug_use']:''}}" name="recreational_drug" id="recreational_drug" class="form-inputs" />
                                    <div class="err" id="err_recreational_drug"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable">Exercise</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <input type="text" name="exercise" id="exercise" value="{{isset($arr_medicalhistory['excersice'])?$arr_medicalhistory['excersice']:''}}" class="form-inputs" placeholder="Please enter exercise details">
                                    <div class="err" id="err_exercise"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5 ">
                                    <div class="form-lable">Alcohol</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <input type="text" name="alcohol" id="alcohol" value="{{isset($arr_medicalhistory['alcohol'])?$arr_medicalhistory['alcohol']:''}}" class="form-inputs" placeholder="Please enter alcohol details">
                                    <div class="err" id="err_alcohol"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-lable">Stress Levels</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="select-style my-pati">
                                        <select class="frm-select" name="stress_level" id="stress_level">
                                            <option value="">-Stress Levels-</option>
                                            <option @if(isset($arr_medicalhistory[ 'stress_level']) && $arr_medicalhistory[ 'stress_level']=='High' ) selected='selected' @endif value="High">High</option>
                                            <option @if(isset($arr_medicalhistory[ 'stress_level']) && $arr_medicalhistory[ 'stress_level']=='Medium' ) selected='selected' @endif value="Medium">Medium</option>
                                            <option @if(isset($arr_medicalhistory[ 'stress_level']) && $arr_medicalhistory[ 'stress_level']=='Low' ) selected='selected' @endif value="Low">Low</option>
                                        </select>
                                    </div>
                                    <div class="err" id="err_stress_level"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5 ">
                                    <div class="form-lable">Marital Status</div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="select-style my-pati">
                                        <select class="frm-select" name="marital_status" id="marital_status">
                                            <option value="">Marital Status</option>
                                            <option @if(isset($arr_medicalhistory[ 'marital_status']) && $arr_medicalhistory[ 'marital_status']=='Married' ) selected='selected' @endif value="Married">Married</option>
                                            <option @if(isset($arr_medicalhistory[ 'marital_status']) && $arr_medicalhistory[ 'marital_status']=='Separated' ) selected='selected' @endif value="Separated">Separated</option>
                                            <option @if(isset($arr_medicalhistory[ 'marital_status']) && $arr_medicalhistory[ 'marital_status']=='Divorced' ) selected='selected' @endif value="Divorced">Divorced</option>
                                            <option @if(isset($arr_medicalhistory[ 'marital_status']) && $arr_medicalhistory[ 'marital_status']=='Widowed' ) selected='selected' @endif value="Widowed">Widowed</option>
                                            <option @if(isset($arr_medicalhistory[ 'marital_status']) && $arr_medicalhistory[ 'marital_status']=='Unmarried' ) selected='selected' @endif value="Unmarried">Unmarried</option>
                                        </select>
                                    </div>
                                    <div class="err" id="err_marital_status"> </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-box">
                            <h4 style="padding:0;">Only required if it’s related to any of your condition/s</h4>
                        </div>
                        <hr/>
                        <h4 style="padding:0;">Blood Pressure</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Sytolic Value (mmhg)
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs" name="sytolic_value" value="{{isset($arr_medicalhistory['sytolic_value'])?$arr_medicalhistory['sytolic_value']:''}}" id="sytolic_value" placeholder="Sytolic Value (mmhg)" />
                                            <div class="err" id="err_sytolic_value"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Pulse Value (bpm)
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs" name="pluse_value" value="{{isset($arr_medicalhistory['pluse_value'])?$arr_medicalhistory['pluse_value']:''}}" id="pluse_value" placeholder="Pulse Value (bpm)" />
                                            <div class="err" id="err_pluse_value"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Time
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input class="form-inputs timepicker-default" name="time" value="{{isset($arr_medicalhistory['time'])?$arr_medicalhistory['time']:''}}" id="time" placeholder="Time" type="text">
                                            <div class="err" id="err_time"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Diastolic Value (mmhg)
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs" name="diastolic_value" value="{{isset($arr_medicalhistory['diastolic_value'])?$arr_medicalhistory['diastolic_value']:''}}" id="diastolic_value" placeholder="Diastolic Value (mmhg)" />
                                            <div class="err" id="err_diastolic_value"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Measure Date
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs datepicker" name="measure_date" value="{{isset($arr_medicalhistory['measure_date'])?date('Y-m-d',strtotime($arr_medicalhistory['measure_date'])):''}}" id="measure_date" placeholder="Measure Date" />
                                            <span class="cal-icnnn"><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                                            <div class="err" id="err_measure_date"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4 style="padding:0;">Blood Sugar</h4>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable big-lble">
                                                Blood Sugar Value (mmol/l)
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs" name="blood_sugar_value" id="blood_sugar_value" value="{{isset($arr_medicalhistory['blood_sugar_value'])?$arr_medicalhistory['blood_sugar_value']:''}}" placeholder="Blood Sugar Value (mmol/l) " />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Meal
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">

                                            <div class="select-style">
                                                <select class="frm-select" name="meal" id="meal">
                                                    <option value="">Meal</option>
                                                    <option @if(isset($arr_medicalhistory[ 'meal']) && $arr_medicalhistory[ 'meal']=='1' ) selected='selected' @endif value="1">1</option>
                                                    <option @if(isset($arr_medicalhistory[ 'meal']) && $arr_medicalhistory[ 'meal']=='2' ) selected='selected' @endif value="2">2</option>
                                                    <option @if(isset($arr_medicalhistory[ 'meal']) && $arr_medicalhistory[ 'meal']=='3' ) selected='selected' @endif value="3">3</option>
                                                </select>
                                            </div>
                                            <div class="err" id="err_meal"> </div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Date Started
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input type="text" class="form-inputs datepicker" value="{{isset($arr_medicalhistory['blood_sugar_measure_date'])?date('Y-m-d',strtotime($arr_medicalhistory['blood_sugar_measure_date'])):''}}" name="sugar_measure_date" id="sugar_measure_date" placeholder="Date Started" />
                                            <span class="cal-icnnn"><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                                            <div class="err" id="err_sugar_measure_date"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="user-box">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <div class="form-lable">
                                                Time
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <input class="form-inputs timepicker-default" value="{{isset($arr_medicalhistory['blood_sugar_time'])?$arr_medicalhistory['blood_sugar_time']:''}}" name="sugar_time" id="sugar_time" placeholder="Time" type="text">
                                            <div class="err" id="err_sugar_time"> </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="currnt-medi-btn">
                            <div class="btm-btns">
                                <button class="next-bttn" name="btn_life_style" id="btn_life_style" type="submit">Save &amp; Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
<!--dashboard section-->
<script>
    $(document).ready(function() {
        var ref = $('#diet_pattern').val();
        if (ref == 'Other') {
            $('#other_diet_div').show();
        } else {
            $('#other_diet_div').hide();
        }


        $('#btn_life_style').click(function() {

            var daily_sleep = $('#daily_sleep').val();
            var smoking_status = $('#smoking_status').val();
            var smoking_option = $('#smoking_frequency').val();
            var diet_pattern = $('#diet_pattern').val();
            var exercise = $('#exercise').val();
            var stress_level = $('#stress_level').val();
            var marital_status = $('#marital_status').val();

            /* if($.trim(daily_sleep)=="")
             {

                $('#daily_sleep').val('');
                $('#err_daily_sleep').fadeIn();
                $('#err_daily_sleep').html('Please select daily sleep.');
                $('#err_daily_sleep').fadeOut(4000);
                $('#daily_sleep').focus();
                return false;
             }
             else if($.trim(smoking_status)=="")
             {

                $('#smoking_status').val('');
                $('#err_smoking_status').fadeIn();
                $('#err_smoking_status').html('Please select smoking status');
                $('#err_smoking_status').fadeOut(4000);
                $('#smoking_status').focus();
                return false; 
             }
             else if($.trim(smoking_status)!="" && $.trim(smoking_option)=="")
             {

                $('#smoking_frequency').val('');
                $('#err_smoking_frequency').fadeIn();
                $('#err_smoking_frequency').html('Please select smoking option');
                $('#err_smoking_frequency').fadeOut(4000);
                $('#smoking_frequency').focus();
                return false; 
             }
             else if($.trim(diet_pattern)=="")
             {

                $('#diet_pattern').val('');
                $('#err_diet_pattern').fadeIn();
                $('#err_diet_pattern').html('Please select diet pattern.');
                $('#err_diet_pattern').fadeOut(4000);
                $('#diet_pattern').focus();
                return false;   
             }
             else if($.trim(exercise)=="")
             {

                $('#exercise').val('');
                $('#err_exercise').fadeIn();
                $('#err_exercise').html('Please enter exercise details.');
                $('#err_exercise').fadeOut(4000);
                $('#exercise').focus();
                return false;     
             }
             else if($.trim(stress_level)=="")
             {

                $('#stress_level').val('');
                $('#err_stress_level').fadeIn();
                $('#err_stress_level').html('Please select stress level.');
                $('#err_stress_level').fadeOut(4000);
                $('#stress_level').focus();
                return false;     
             }
             else if($.trim(marital_status)=="")
             {

                $('#marital_status').val('');
                $('#err_marital_status').fadeIn();
                $('#err_marital_status').html('Please select marital status.');
                $('#err_marital_status').fadeOut(4000);
                $('#marital_status').focus();
                return false;     
             }*/

        });

    });

    function showOtherDiet(ref) {
        if (ref == 'Other') {
            $('#other_diet_div').show();
        } else {
            $('#other_diet_div').hide();
        }
    }
</script>
@stop