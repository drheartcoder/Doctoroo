@extends('front.pharmacy.layout.master')                
@section('main_content')


       
      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
			 <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
            @include('front.pharmacy.layout.profile_layout._profile_sidebar') 

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">{{ $page_title or '' }}</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>

                  <form action="{{ $module_url_path }}/prefernces/create" method="post" name="frm_profile_step3" id="frm_profile_step3">
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
                                       Prefernce Time
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

                                                <tr class="open-td">
                                                   <td style="padding:18px 22px !important;">{{ $day or '' }}
                                                   </td>
                                                   <td>
                                                       <label class="switch">
                                                            <input type="checkbox" id="{{$small_case_day_slug}}_off" name="{{$small_case_day_slug}}_status"  onchange="checkOffStatus('{{$small_case_day_slug}}')" value="1" >
                                                            <span class="slider round">
                                                            <span class="on-button">off</span>
                                                            <span class="off-button">on</span>
                                                            </span>
                                                        </label>


                                                   </td>

                                                   <td  style="background:#e6e9ec;text-align:center;">
                                                    <div id="start_time_div_{{ $small_case_day_slug }}">
                                                      <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text"  data-rule-required="true" value="" class="form-control from-time-timepicker" id="{{$small_case_day_slug}}_open"  name="{{$small_case_day_slug}}_from_time"  aria-describedby="basic-addon2">
                                                   
                                                           <span class="input-group-addon" id="basic-addon2" style="top:-1px;
                                                           right:39px;">
                                                             <a href="javascript:void(0);" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                           </span>
                                                      </div>
                                                        <a onclick="setDefaultFromTime('{{$small_case_day_slug}}')" style="font-size:14px">Copy Start Time</a>
                                                    </div>
                                                   </td>


                                                 <td style="text-align:center;">
                                                   <div id="end_time_div_{{ $small_case_day_slug }}">
                                                      <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text" data-rule-required="true" value="" class="form-control to-time-timepicker" id="{{$small_case_day_slug}}_close"  name="{{$small_case_day_slug}}_to_time" aria-describedby="basic-addon2">
                                                   
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
                                         <h4> Select Prefernces</h4>

                                         <h5>(Please select any prefernce to recevied notification.)</h5>
                                          <div class="check-box pharmacy-signup2">
                                            <input type="checkbox"  class="css-checkbox" value=1  @if(isset($arr_temp_pharmacy['services']) && in_array("1", $arr_temp_pharmacy['services']))
                                                  checked='checked'
                                               @endif  name="prefernces[]" id="checkbox3" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox3">
                                                Messages
                                            </label>
                                         </div>

                                         <div class="check-box pharmacy-signup2">
                                            <input type="checkbox"  class="css-checkbox" value=2  @if( isset($arr_temp_pharmacy['services']) && in_array("2", $arr_temp_pharmacy['services']))
                                                  checked='checked'
                                               @endif name="prefernces[]" id="checkbox4" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox4">New Patients
                                            </label>
                                         </div>

                                         <div class="check-box pharmacy-signup2">
                                            <input type="checkbox"  class="css-checkbox" value=2  @if( isset($arr_temp_pharmacy['services']) && in_array("2", $arr_temp_pharmacy['services']))
                                                  checked='checked'
                                               @endif name="prefernces[]" id="checkbox4" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox4">New bookings
                                            </label>
                                         </div>


                                          <div class="check-box pharmacy-signup2">
                                            <input type="checkbox"  class="css-checkbox" value=2  @if( isset($arr_temp_pharmacy['services']) && in_array("2", $arr_temp_pharmacy['services']))
                                                  checked='checked'
                                               @endif name="prefernces[]" id="checkbox4" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox4">Answer a Question
                                            </label>
                                         </div>

                                          <div class="check-box pharmacy-signup2">
                                            <input type="checkbox"  class="css-checkbox" value=2  @if( isset($arr_temp_pharmacy['services']) && in_array("2", $arr_temp_pharmacy['services']))
                                                  checked='checked'
                                               @endif name="prefernces[]" id="checkbox4" tabindex="3"/>
                                            <label class="css-label lite-red-check remember_me"  for="checkbox4">Accept australien patients [Yes / No]
                                            </label>
                                         </div>

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
                    if($('#'+day+'_off').is(":checked"))
                    {
                        $('#start_time_div_'+day).hide();
                        $('#end_time_div_'+day).hide();
                    }
            });

        $('#frm_profile_step3').validate({
          errorClass:'error',
          errorElement:'span',
        });



        $('.from-time-timepicker').timepicker();

        $('.to-time-timepicker').timepicker();
 
    });  
     $('#frm_profile_step3').on('submit',function()
        {
              var form   = $(this);
              var isValid = form.valid();
              if(isValid)
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
        var is_off_day = $('#'+day+'_off').val();
        if($('#'+day+'_off').is(":checked"))
        {
            $('#start_time_div_'+day).hide();
            $('#end_time_div_'+day).hide();
        }
        else
        {
            $('#start_time_div_'+day).show();
            $('#end_time_div_'+day).show();
        }
       
    }
</script>
@endsection