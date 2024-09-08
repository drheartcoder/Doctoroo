@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')

<!--dashboard section-->            
      <link href="{{ url('/') }}/public/css/select2.min.css" rel="stylesheet" />
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx white-bg">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="see-d-dash-panel text-center">
                        <div class="distance">
                           <div class="row">
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-right">
                                 <a href="{{ url('/') }}/search/doctor/more-precise{{ '?'.Request::getQueryString() }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt="" /></a>
                              </div>
                              <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" ><i class="fa fa-circle"></i></a></li>
                              </ul>
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-left"><a href="#"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div>
                           </div>
                           <div class="clr"></div>
                        </div>
                        
                        <div class="choose-frm-bx">
                        
                           <div class="col-sm-12">
                              <div class="text-center section-box">
                                 <br/>
                                 <h4>Search for a Doctor</h4>
                                 <div class="some-t">The below search will help you find the most suitable Doctor for you.</div>
                              </div>
                           </div>
                           <div class="col-sm-4 col-md-4 col-lg-2">&nbsp;</div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                              <div class="ch2">
                                <!--  <h5></h5> -->
                                 <div class="row" style="position:relative;">
                                    <div class="col-sm-4 col-md-4 col-lg-12">
                                        <div class="chose-avail-doc">
                                          <div class="doc-head doc-h1">
                                             Select a suitable time
                                             <span>You'll be seen by any available Doctor</span>  
                                          </div>
                                          <div class="inner-cont">
                                             <div class="doc-rw">
                                                <div class="doc-det ">
                                                
                                                   <?php 
                                                $today = date('Y-m-d');
                                                if(count($suitable_doctor['get_suit_dates_arr'][0]['doctor_availability'])>0)
                                                { ?>
                                                    
                                                    <div class="arws"><a href="#"><i class="fa fa-angle-left"></i></a></div>
                                                   <?php foreach ($suitable_doctor['get_suit_dates_arr'][0]['doctor_availability'] as $suit_value) 
                                                   {?>
                                                      <?php if($today==$suit_value['date']){?>
                                                      <a href="#" class="cal-dy">Today</a>   
                                                      <?php } else{?>
                                                      <a href="#" class="cal-dy"><?php echo date('D dS',strtotime($suit_value['date'])); ?></a>   
                                                      <?php } 
                                                   } ?>
                                                   <div class="arws"><a href="#"> <i class="fa fa-angle-right"></i></a></div>
                                                <?php } ?>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det ">
                                                   <div class="view-time-btn1 " data-suitable-time-target="21">
                                                      <div class="time-count">
                                                         8.00 am
                                                      </div>
                                                      <a href="#" class="add-to-cart-block1">
                                                      <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                      <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                      </a>
                                                   </div>
                                                </div>
                                                <div class="doc-times-bx1" style="display:none;" doctor-suitable-time-section="21">
                                                   <div class="doc-det">
                                                      <div class="doc-pro">
                                                         <img src="{{ url('/') }}/public/images/doc-pro.png" alt="profile img" class="mCS_img_loaded"/>
                                                      </div>
                                                      <div class="doc-nm">
                                                         Dr. Matt Noble
                                                         <span class="doc-status">
                                                         Available Now
                                                         </span>
                                                      </div>
                                                      <div class="see-doc-btn">
                                                         <a href="#" class="add-to-cart-block1">
                                                         <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                         <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                         </a>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                   </div>
                                                   <div class="dco-dir"></div>
                                                   <div class="doc-det">
                                                      <div class="doc-pro">
                                                         <img src="{{ url('/') }}/public/images/doc-pro1.png" alt="profile img" class="mCS_img_loaded"/>
                                                      </div>
                                                      <div class="doc-nm">
                                                         Dr. Martine De
                                                         <span class="doc-status">
                                                         Available Now
                                                         </span>
                                                      </div>
                                                      <div class="see-doc-btn">
                                                         <a href="#" class="add-to-cart-block1">
                                                         <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                         <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                         </a>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det">
                                                   <div data-suitable-time-target="22">
                                                      <div class="time-count" >
                                                         8.30 am
                                                      </div>
                                                      <a href="#" class="add-to-cart-block1">
                                                      <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                      <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                      </a>
                                                   </div>
                                                </div>
                                                <div class="doc-times-bx1" style="display:none;" doctor-suitable-time-section="22">
                                                   <div class="doc-det">
                                                      <div class="doc-pro">
                                                         <img src="{{ url('/') }}/public/images/doc-pro.png" alt="profile img" class="mCS_img_loaded"/>
                                                      </div>
                                                      <div class="doc-nm">
                                                         Dr. Matt Noble
                                                         <span class="doc-status">
                                                         Available Now
                                                         </span>
                                                      </div>
                                                      <div class="see-doc-btn">
                                                         <a href="#" class="add-to-cart-block1">
                                                         <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                         <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                         </a>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                   </div>
                                                   <div class="dco-dir"></div>
                                                   <div class="doc-det">
                                                      <div class="doc-pro">
                                                         <img src="{{ url('/') }}/public/images/doc-pro1.png" alt="profile img" class="mCS_img_loaded"/>
                                                      </div>
                                                      <div class="doc-nm">
                                                         Dr. Martine De
                                                         <span class="doc-status">
                                                         Available Now
                                                         </span>
                                                      </div>
                                                      <div class="see-doc-btn">
                                                         <a href="#" class="add-to-cart-block1">
                                                         <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                         <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                         </a>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det">
                                                   <div class="time-count">
                                                      9.00 am
                                                   </div>
                                                   <a href="#" class="add-to-cart-block1">
                                                   <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                   <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det">
                                                   <div class="time-count">
                                                      9.30 am
                                                   </div>
                                                   <a href="#" class="add-to-cart-block1">
                                                   <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                   <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det">
                                                   <div class="time-count">
                                                      10.00 am
                                                   </div>
                                                   <a href="#" class="add-to-cart-block1">
                                                   <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                   <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="doc-rw">
                                                <div class="doc-det">
                                                   <div class="time-count">
                                                      10.30 am
                                                   </div>
                                                   <a href="#" class="add-to-cart-block1">
                                                   <img src="{{ url('/') }}/public/images/right-icon.png" class="img-new" alt=""/>
                                                   <img src="{{ url('/') }}/public/images/right-icon-hover.png" class="ove-img" alt=""/>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>                                             
                                       </div>
                                    </div>
                                   <!-- <div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div> -->
                                 </div>
                              </div>
                           </div>

                           <div class="col-sm-8 col-md-6 col-lg-4">
                            <form name="frm_precise_doctor" id="frm_precise_doctor" action="{{ url('/') }}/search/doctor/search_more_precise" method="get" enctype="multipart/form-data"> 
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
                                 <br />
                              </div>

                            </form>
                           </div>
                           
                         
                           <div class="col-sm-4 col-md-4 col-lg-2">&nbsp;</div>
                        </div>

                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <!--dashboard section-->
      </div>
      <script src="{{url('/') }}/public/js/select2.full.js"></script>  
      <script> 
      
      $(document).scrollTop($(document).height());

      $(function() {
          $( "#available_date" ).datepicker({
              numberOfMonths: 1,
              showButtonPanel: false,
                 minDate: '0' 
          });
      });


   $(document).ready(function()
   {
      var arr_avail_time = $("[data-suitable-time-target]");
       $.each(arr_avail_time,function(index,elem)
       {
          $(elem).on('click',function()
           {
              var target = $(elem).attr('data-suitable-time-target');
              var target_elem = $('[doctor-suitable-time-section="'+target+'"]');    
              var arr_avail_time_section = $('[doctor-suitable-time-section]').not(target_elem);    
              
              
              $(arr_avail_time_section).each(function(index,elem)
              {
                  $(elem).hide();
              });
              
              $(target_elem).slideToggle('slow');
              $(elem).toggleClass('active');
           });       
       });
       
      $('#srch_by_name').keyup(function(){
        var srch_name = $('#srch_by_name').val();
        if(srch_name!='')
        {
          $('.doctor_div').each(function(){
            var doc_name = $(this).attr('data-doc-name');
            if (doc_name.toLowerCase().indexOf(srch_name) >= 0)
            {
              $(this).show();
            }
            else
            {
              $(this).hide();
            }
            
          });
        }
        else
        {
          $('.doctor_div').each(function(){
            $(this).show();
          });
        }
      });
          
      $(".js-example-basic-multiple").select2();         
                 
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

      $('.more_precise_doctor').click(function(){
         var speciality       = $('#speciality').val();
         var available_date   = $('#available_date').val();
         var available_time   = $('#available_time').val();
         var language         = $('#language').val();
         var gender           = $('input[name="gender"]:checked').val();
         var specific_doctor  = $('input[name="specific_doctor"]').val();

         var hrs_time = Converttimeformat(available_time);
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
         else if(hrs_time<current_time &&  second==first)
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
            showProcessingOverlay();
            $('#frm_precise_doctor').submit();
            return true;
         }

      });
   });


</script>
@stop