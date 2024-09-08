@extends('front.pharmacy.layout.temp_master')                
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
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>
                  <form action="{{ $module_url_path }}/update_profile_step3" method="post" name="frm_profile_step3" id="frm_profile_step3">
                  {{ csrf_field() }}

                    <input type="hidden" name="enc_token_id" id="enc_token_id" value="{{ $enc_token_id or '' }}">
               
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                     
                                    @include('front.pharmacy.layout.profile_layout._profile_middlebar') 

                                 </div>
                                 <div class="clr"></div>
                                  @include('front.layout._operation_status')
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class="row">
                           <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">&nbsp;</div>
                              <div class="col-sm-12 col-md-12 col-lg-8 request-details-bx1">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title" style="margin:0;">
                                       Opening Hours
                                    </div>
                                    <div class="opening-bx">
                                       <div class="table-responsive basic-table">
                                          <table class="table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>

                                          

                                                <tr class="open-head">
                                                   <td class="tble-wdth" style="width:300px">Day</td>
                                                   <td style="background:#e6e9ec;min-width:250px;">Start Time</td>
                                                   <td style="min-width:250px;">End Time</td>
                                                </tr>

                                           @if(isset($arr_days) && sizeof($arr_days)>0)
                                             @foreach($arr_days as $day_key  => $day)

                                              <?php 
                                                 $small_case_day_slug = strtolower($day_key); 
                                                 $small_case_day = strtolower($day); 
                                              ?>
                                                @if(isset($arr_pharmacy_schedule) && sizeof($arr_pharmacy_schedule)>0)
                                                <?php 
                                                  $open_time = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_open']));
                                                  $close_time = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_close']));
                                                ?>
                                                @endif

                                                <tr class="open-td">
                                                   <td style="padding:18px 22px !important;">{{ $day or '' }}
                                                   {{-- <span class="grn-drp"> Same for All Day's </span> --}}
                                                   </td>
                                                   <td  style="background:#e6e9ec;text-align:center;">

                                                      <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text"  data-rule-required="true"  class="form-control timepicker-default" value="{{ $open_time or '' }}" name="{{$small_case_day_slug}}_open"  aria-describedby="basic-addon2">
                                                   
                                                           <span class="input-group-addon" id="basic-addon2" style="top:-1px;
                                                           right:39px;">
                                                             <a href="javascript:void(0);" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                           </span>
                                                      </div>
                                                   
                                                   </td>
                                                   <td style="text-align:center;">
                                                          <div class="clock-i input-group" style="margin:0 auto;">
                                                        <input type="text" data-rule-required="true"  class="form-control timepicker-default" value="{{ $close_time or '' }}"  name="{{$small_case_day_slug}}_close" aria-describedby="basic-addon2">
                                                   
                                                           <span class="input-group-addon" id="basic-addon2" style="top:-1px;
                                                           right:39px;">
                                                             <a href="javascript:void(0);" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                           </span>
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
                                    <div class="open-note-bx">
                                       <div class="row">
                                          <div class="col-sm-12 col-md-12 col-lg-2">
                                             <div class="cer-text"> Opening Hours Notes</div>
                                          </div>
                                          <div class="col-sm-12 col-md-12 col-lg-6">
                                             <textarea cols="" rows="" name="opening_hour_notes" data-rule-maxlength="255" id="opening_hour_notes"  class="form-inputs" style="padding:10px;height:130px;margin:5px 0;">{{ $arr_pharmacy_schedule['opening_hour_notes'] }}</textarea>
                                              <span class="err" id="err_notes"></span>
                                          </div>
                                          <div class="col-sm-12 col-md-12 col-lg-4">
                                             <div class="cer-text">
                                                Any additional information to display regarding your opening hours e.g. Closed on 25th Dec.
                                             </div>
                                          </div>
                                       </div>
                                      
                                    </div>
                                 </div>
                              </div>
                               <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">&nbsp;</div>
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

<script>
   
    $(document).ready(function()
    {
        $("#frm_profile_step3").submit(function( event ){
              
                var opening_hour_notes    =  $('#opening_hour_notes').val();
                 if($.trim(opening_hour_notes)=='')
                 {
                    $('#err_notes').show();
                    $('#opening_hour_notes').focus();
                    $('#err_notes').html('Please enter opening hour notes.');
                    $('#err_notes').fadeOut(4000);
                    return false;
                 } 

        });

        $('#frm_profile_step3').validate({
          errorClass:'error',
          errorElement:'span',
        });
        $('.timepicker-default').timepicker();
 
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

</script>
@endsection