@extends('front.doctor.layout.master')                
@section('main_content')


       
      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
			 <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
            @include('front.doctor.layout._sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">{{ $page_title or '' }}</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>

                  <form action="{{ $module_doctor_path }}/preference/create" method="post" name="frm_doctor_pref" id="frm_doctor_pref">
                  {{ csrf_field() }}
               
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                     

                                 </div>
                                 <div class="clr"></div>
                                  @include('front.layout._operation_status')
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        <div class="row">
                            <div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>
                              <div class="col-sm-12 col-md-12 col-lg-10 request-details-bx1">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title" style="margin:0;">
                                       Preference Time
                                    </div>

                                    <div class="opening-bx">
                                       <div class="table-responsive basic-table">
                                          <table class="table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>

                                                <tr class="open-head">
                                                   <td class="tble-wdth" style="width:300px">Day</td>
                                                    <td style="min-width:250px;">Notification Status</td>
                                                   <td style="background:#e6e9ec;min-width:250px;">From Time</td>
                                                   <td style="min-width:250px;">To Time</td>
                                                </tr>

                                           @if(isset($arr_days) && sizeof($arr_days)>0)
                                             @foreach($arr_days as $day_key  => $day)

                                              <?php 
                                                 $small_case_day_slug = strtolower($day_key); 
                                                 $small_case_day = strtolower($day); 
                                              ?>

                                               @if(isset($arr_data) && sizeof($arr_data)>0)
                                                <?php 
                                                  $from_time = date("h:i A",strtotime($arr_data[$small_case_day_slug.'_from_time']));
                                                  $to_time = date("h:i A",strtotime($arr_data[$small_case_day_slug.'_to_time']));

                                                  $off_day = $arr_data[$small_case_day_slug.'_status'];
                                                ?>
                                                @endif

                                                <tr class="open-td">
                                                   <td style="padding:18px 22px !important;">{{ $day or '' }}
                                                   </td>
                                                   <td>
                                                       <label class="switch">
                                                            <input type="checkbox" @if(isset($off_day) && $off_day==1) checked=""  @endif   id="{{$small_case_day_slug}}_status" name="{{$small_case_day_slug}}_status"   onchange="checkOffStatus('{{$small_case_day_slug}}')" value="1" >
                                                            <span class="slider round">
                                                            <span class="on-button">off</span>
                                                            <span class="off-button">on</span>
                                                            </span>
                                                        </label>


                                                   </td>

                                                   <td  style="background:#e6e9ec;text-align:center;">
                                                    <div id="from_time_div_{{ $small_case_day_slug }}">
                                                      <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text"  data-rule-required="true" value="{{ $from_time or '' }}" class="form-control from-time-timepicker" id="{{$small_case_day_slug}}_open"  name="{{$small_case_day_slug}}_from_time"  aria-describedby="basic-addon2">
                                                   
                                                           <span class="input-group-addon" id="basic-addon2" style="top:-1px;
                                                           right:39px;">
                                                             <a href="javascript:void(0);" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                           </span>
                                                      </div>
                                                        <a onclick="setDefaultFromTime('{{$small_case_day_slug}}')" style="font-size:14px">Copy Start Time</a>
                                                    </div>
                                                   </td>


                                                 <td style="text-align:center;">
                                                   <div id="to_time_div_{{ $small_case_day_slug }}">
                                                      <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text" data-rule-required="true" value="{{ $to_time or '' }}" class="form-control to-time-timepicker" id="{{$small_case_day_slug}}_close"  name="{{$small_case_day_slug}}_to_time" aria-describedby="basic-addon2">
                                                   
                                                           <span class="input-group-addon" id="basic-addon2" style="top:-1px;
                                                           right:39px;">
                                                             <a href="javascript:void(0);" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                           </span>
                                                      </div>
                                                       <a onclick="setDefaultToTime('{{$small_case_day_slug}}')" style="font-size:14px">Copy End Time</a>
                                                    </div>
                                                   </td>
                                                </tr>
                                               
                                             @endforeach
                                          @endif
                                               
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>

                                  <div class="clearfix"></div>



                              </div>
                               <div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>

                                   <div class="pharma-step-bx" style="min-height:360px!important;">
                                      <div class="pharma-step-content">
                                         <h4> Select Preferences</h4>

                                         <h5>(Please select any preference to recevied notification.)</h5>
                                          <div class="check-box pharmacy-signup2 doctor_pref">
                                            <input type="checkbox"  class="css-checkbox" value=1  @if(isset($arr_data['noti_message']) && $arr_data['noti_message'])
                                                  checked='checked'
                                               @endif  name="noti_message" id="checkbox1" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox1">
                                                Messages
                                            </label>
                                         </div>

                                         <div class="check-box pharmacy-signup2 doctor_pref">
                                            <input type="checkbox"  class="css-checkbox" value=1  @if(isset($arr_data['noti_new_patient']) && $arr_data['noti_new_patient']==1)
                                                  checked='checked'
                                               @endif name="noti_new_patient" id="checkbox2" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox2">New Patients
                                            </label>
                                         </div>

                                         <div class="check-box pharmacy-signup2 doctor_pref">
                                            <input type="checkbox"  class="css-checkbox" value=1 @if(isset($arr_data['noti_new_booking']) && $arr_data['noti_new_booking']==1)
                                                  checked='checked'
                                               @endif name="noti_new_booking" id="checkbox3" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox3">New bookings
                                            </label>
                                         </div>


                                          <div class="check-box pharmacy-signup2 doctor_pref">
                                            <input type="checkbox"  class="css-checkbox" value=1  @if(isset($arr_data['noti_ans_a_question']) && $arr_data['noti_ans_a_question']==1)
                                                  checked='checked'
                                               @endif name="noti_ans_a_question" id="checkbox4" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox4">Answer a Question
                                            </label>
                                         </div>

                                          <div class="check-box pharmacy-signup2 doctor_pref">
                                            <input type="checkbox"  class="css-checkbox" value=1  @if(isset($arr_data['noti_accept_aust_patients']) && $arr_data['noti_accept_aust_patients']==1)
                                                  checked='checked'
                                               @endif name="noti_accept_aust_patients" id="checkbox5" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox5">Accept australien patients [Yes / No]
                                            </label>
                                         </div>
                                           <span class="err" id="err_doc_prefernces"></span>
                                    </div>
                                  
                                 </div>

                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                 
                                    <input type="submit" name="btn_submit" class="btn-grn pull-right" href="#" style="margin:0 0 30px;" value="Submit">

                                 </div>
                              </div>
                         </div>

                        </div>
                        <br/>
                     </div>
                    
                   </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!--calender section end-->       

<input type="hidden" id="arr_days" value="{{ (isset($arr_days))? json_encode($arr_days): json_encode(array()) }}">
<script>
   
    $(document).ready(function()
    {
          /*check off days & hide a time*/
          var arr_days      = $("#arr_days").val();
          arr_days           = JSON.parse(arr_days);
          
          jQuery.each(arr_days, function(index, item) {
                var day = index.toLowerCase();

                    if($('#'+day+'_status').is(":checked"))
                    {
                        $('#from_time_div_'+day).hide();
                        $('#to_time_div_'+day).hide();
                    }
            });

        $('#frm_profile_step3').validate({
          errorClass:'error',
          errorElement:'span',
        });



        $('.from-time-timepicker').timepicker();

        $('.to-time-timepicker').timepicker();
 
    });  
     $('#frm_doctor_pref').on('submit',function()
        {
             
                if($('.doctor_pref').find('input[type=checkbox]:checked').length == 0)
                {
                   $('#err_doc_prefernces').html('Please select atleast one checkbox.');
                   return false;
                }
                else
                {
                   showProcessingOverlay();
                }

        }); 

    /*set a default start time*/
    function setDefaultFromTime(day)
    {
          var time = $('#'+day+'_open').val();
            $('.from-time-timepicker').timepicker({

          }).val(time); 
    }

    /*set a default end time*/
    function setDefaultToTime(day)
    {
          var end_time = $('#'+day+'_close').val();
            $('.to-time-timepicker').timepicker({

          }).val(end_time); 
    }
    function checkOffStatus(day)
    {
        var is_off_day = $('#'+day+'_status').val();

        if($('#'+day+'_status').is(":checked"))
        {
            $('#from_time_div_'+day).hide();
            $('#to_time_div_'+day).hide();
        }
        else
        {
            $('#from_time_div_'+day).show();
            $('#to_time_div_'+day).show();
        }
       
    }
</script>
@endsection