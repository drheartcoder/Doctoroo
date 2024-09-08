@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
 <div class="middle-section">
         <div class="container">
            <div class="row">
               <div class="back-whhit-bx white-bg">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="see-d-dash-panel text-center">
                        <div class="distance">
                           <div class="row">
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                                 <?php 
                                    $consultation_for = Session::get('consultation_for');
                                    if($consultation_for!='')
                                    {
                                       $arr_cons = explode(',',$consultation_for);
                                       if(in_array('All',$arr_cons) || in_array('medical_certificate',$arr_cons))
                                       {
                                          $url = '/search/doctor/medical-history/questions';
                                       }
                                       else if(in_array('All',$arr_cons) || in_array('prescription',$arr_cons))
                                       {
                                          $url = '/search/doctor/prescription/questions';
                                       }
                                       else
                                       {
                                           $url = '/search/doctor/what-are-you-seeking-from-doctor';
                                       }
                                    }
                                 ?>   
                              <a href="{{ url('/') }}{{ $url }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                              
                              </div>
                              <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10">
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              </ul>
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-left more_precise_doctor"><a href="#"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div>
                           </div>
                           <div class="clr"></div>
                        </div>
                        <form name="frm_precise_doctor" id="frm_precise_doctor" action="{{ url('/') }}/search/doctor/search_more_precise" method="get" enctype="multipart/form-data">  
                        <div class="choose-frm-bx">
                           <div class="col-sm-12">
                              <div class="text-center section-box">
                                 <br/>
                                 <h4>Search for a Doctor</h4>
                                 <div class="some-t">The below search will help you find the most suitable Doctor for you.</div>
                              </div>
                           </div>
                           <div class="hidden-xs col-sm-2 col-md-3 col-lg-4">&nbsp;</div>
                           <div class="col-sm-8 col-md-6 col-lg-4">
                              <div class="ch2 ch1">
                                 <div class="chose-avail-doc">
                                    <div class="doc-head">
                                       Search
                                    </div>

                                    <div class="search-row">
                                       <div class="search-txxt">Provider</div>
                                       <div class="drp-search">
                                          <div class="select-style">
                                             <select class="frm-select" name="speciality" id="speciality">
                                                <option value=""> - Select - </option>
                                                <?php if(count($speciality)>0){
                                                   foreach ($speciality as $sep_value) {?>
                                                      <option value="<?php echo $sep_value['speciality'] ?>" <?php if($sep_value['speciality']=='GP  (General Practitioner)' || Request::query('speciality')=='GP  (General Practitioner)'){echo 'selected';} ?>><?php echo $sep_value['speciality'] ?></option>
                                                 <?php } }?>     
                                             </select>
                                          </div>
                                       </div>
                                       <div id="err_speciality" class="error" style="text-align:center;"></div>
                                    </div>
                                    <div class="search-row">
                                       <div class="search-txxt">Date</div>
                                       <div class="drp-search">
                                          <input class="datepicker" placeholder="Select Date" type="text" name="available_date" id="available_date" value="{{ Request::query('available_date') }}"  />
                                          <span><img src="{{ url('/') }}/public/images/cal-icon.png" alt="icon"/> </span>
                                       </div>
                                       <div id="err_available_date" class="error" style="text-align:center;"></div>
                                    </div>
                                    <div class="search-row">
                                       <div class="search-txxt">Time</div>
                                       <div class="drp-search">
                                          <input class="timepicker-default" type="text" name="available_time" id="available_time"  value="{{ Request::query('available_time') }}" />
                                       </div>
                                       <div id="err_available_time" class="error" style="text-align:center;"></div>
                                    </div>
                                    <div class="search-row">
                                       <div class="search-txxt">Language</div>
                                       <div class="drp-search">
                                          <div class="select-style">
                                             <select class="frm-select" name="language" id="language">
                                                <option value=""> - Select - </option>
                                                <?php if(count($languages)>0){
                                                   foreach ($languages as $lang_value) {
                                                 ?>
                                                 <option value="<?php echo $lang_value['language']; ?>" <?php if($lang_value['language']=='English' ||  Request::query('language')=='English'){echo 'selected';} ?>><?php echo $lang_value['language']; ?></option>
                                                 <?php } } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div id="err_language" class="error" style="text-align:center;"></div>
                                    </div>
                                    <div class="search-row">
                                       <div class="search-txxt gen-head">Gender</div>
                                       <div class="radio-sections">
                                          <div class="radio-btn">
                                             <input type="radio" id="f-option" name="gender" checked="checked" value="Any" <?php if(Request::query('gender')=='Any'){echo 'checked="checked"';} ?> />
                                             <label for="f-option">
                                                <span class="interior-icon">
                                                   Any
                                                </span>
                                             </label>
                                             <div class="check br-rad"></div>
                                          </div>
                                          <div class="radio-btn">
                                             <input type="radio" id="f-option1" name="gender" value="Male" <?php if(Request::query('gender')=='Male'){echo 'checked="checked"';} ?> />
                                             <label for="f-option1">
                                                <span class="interior-icon">
                                                   M
                                                </span>
                                             </label>
                                             <div class="check"></div>
                                          </div>
                                          <div class="radio-btn">
                                             <input type="radio" id="f-option2" name="gender" value="Female" <?php if(Request::query('gender')=='Female'){echo 'checked="checked"';} ?> />
                                             <label for="f-option2">
                                                <span class="interior-icon">
                                                   F
                                                </span>
                                             </label>
                                             <div class="check br-rad1"></div>
                                          </div>
                                       </div>
                                       <div id="err_specific_doctor" class="error" style="text-align:center;"></div>
                                    </div>
                                    <div class="search-row search-bor-top">
                                       <div class="search-txxt doc-search">
                                        Specific Doctor 
                                        <span> (already on ur platform)</span>
                                        </div>
                                       <div class="radio-sections doc-search-radio">
                                          <div class="radio-btn">
                                             <input type="radio" id="f-option3" name="specific_doctor"  value="Yes" <?php if(Request::query('specific_doctor')==null || Request::query('specific_doctor')=='Yes'){echo 'checked="checked"';} ?> />
                                             <label for="f-option3">
                                                <span class="interior-icon">
                                                   Yes
                                                </span>
                                             </label>
                                             <div class="check br-rad"></div>
                                          </div>
                                          <div class="radio-btn">
                                             <input type="radio" id="f-option4" name="specific_doctor" value="No" <?php if(Request::query('specific_doctor')=='No'){echo 'checked="checked"';} ?>  />
                                             <label for="f-option4">
                                                <span class="interior-icon no">
                                                   No, 
                                                any Doctor
                                                </span>
                                             </label>
                                             <div class="check"></div>
                                          </div>
                                          <div id="err_specific_doctor" class="error" style="text-align:center;"></div>
                                       </div>
                                    </div>
                                    <a href="javascript:void(0);" class="req-btnns more_precise_doctor">Continue</a>
                                 </div>
                              </div>
                           </div>
                           <div class="hidden-xs col-sm-2 col-md-3 col-lg-4">&nbsp;</div>
                        </div>
                        </form>
                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="clr"></div>
               </div>
            </div>
         </div>
         <!--dashboard section-->
      </div>
<script>
   $(document).ready(function(){

      $('#available_date').datepicker({ dateFormat: 'dd-mm-yy' });
       
       function Converttimeformat(time) 
       {
         // var time = $("#starttime").val();
         var time = time;//document.getElementById('available_time').value;
         var hrs = Number(time.match(/^(\d+)/)[1]);
         var mnts = Number(time.match(/:(\d+)/)[1]);
         var format = time.match(/\s(.*)$/)[1];
         if (format == "PM" && hrs < 12) hrs = hrs + 12;
         if (format == "AM" && hrs == 12) hrs = hrs - 12;
         var hours = hrs.toString();
         var minutes = mnts.toString();
         if (hrs < 10) hours = "0" + hours;
         if (mnts < 10) minutes = "0" + minutes;
         return hours + ":" + minutes;
       }

       function getHour24(timeString)
      {
          time = null;
          var matches = timeString.match(/^(\d{1,2}):00 (\w{2})/);
          if (matches != null && matches.length == 3)
          {
              time = parseInt(matches[1]);
              if (matches[2] == 'PM')
              {
                  time += 12;
              }
          }
          return time;
      }

      $('.more_precise_doctor').click(function(){
         var speciality       = $('#speciality').val();
         var available_date   = $('#available_date').val();
         var available_time   = $('#available_time').val();
         var language         = $('#language').val();
         var gender           = $('input[name="gender"]:checked').val();
         var specific_doctor  = $('input[name="specific_doctor"]').val();

         var hrs_time         = Converttimeformat(available_time);

         var current_date     = new Date();
         var current_time     = current_date.getHours()+':'+current_date.getMinutes(); 
         var curr_new_date    = current_date.getDate()+'-'+parseInt(current_date.getMonth()+parseInt(1))+'-'+current_date.getFullYear();
         var first            = current_date.getFullYear()+'-'+parseInt(current_date.getMonth()+parseInt(1))+'-'+current_date.getDate();

         var from             = available_date.split("-");
         var newdate          = new Date(from[2], from[1] - 1, from[0]);
         var second           = newdate.getFullYear()+'-'+parseInt(newdate.getMonth()+parseInt(1))+'-'+newdate.getDate();
         
         if($.trim(speciality)=='')
         {
            $('#err_speciality').show();
            $('#speciality').focus();
            $('#err_speciality').html('Please select speciality');
            $('#err_speciality').fadeOut(4000);
            return false;  
         }
         else if($.trim(available_date)=='')
         {
            $('#err_available_date').show();
            $('#available_date').focus();
            $('#err_available_date').html('Please select available date');
            $('#err_available_date').fadeOut(4000);
            return false;  
         }
         else if($.trim(available_time)=='')
         {
            $('#err_available_time').show();
            $('#available_time').focus();
            $('#err_available_time').html('Please select available time');
            $('#err_available_time').fadeOut(4000);
            return false;  
         }
         else if(hrs_time>current_time && second!=first)
         {
            $('#err_available_time').show();
            $('#available_time').focus();
            $('#err_available_time').html('Please select time greater that current time');
            $('#err_available_time').fadeOut(4000);
            return false;  
         }
         else if($.trim(language)=='')
         {
            $('#err_language').show();
            $('#language').focus();
            $('#err_language').html('Please select language');
            $('#err_language').fadeOut(4000);
            return false;  
         }
         else if($.trim(gender)=='')
         {
            $('#err_gender').show();
            $('#gender').focus();
            $('#err_gender').html('Please select gender');
            $('#err_gender').fadeOut(4000);
            return false;  
         }
         else if($.trim(specific_doctor)=='')
         {
            $('#err_specific_doctor').show();
            $('#specific_doctor').focus();
            $('#err_specific_doctor').html('Please select specific doctor');
            $('#err_specific_doctor').fadeOut(4000);
            return false;  
         }
         else
         {
            $('#frm_precise_doctor').submit();
            return true;
         }return false;  

      });
   });
</script>
@stop