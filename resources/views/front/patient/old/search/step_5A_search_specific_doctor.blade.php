@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<style>
   .popup_btnns_booking .btn {
    display: inline-block;
    margin: 20px 10px 20px 0;
    max-width: 153px;
   }
</style>
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
                             <!--  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-left"><a href="#"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div> -->
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
                                   <!-- <div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div> -->
                                    <div class="col-sm-4 col-md-4 col-lg-12">
                                       <div class="chose-avail-doc">
                                          <div class="doc-head">
                                             Search for a specific doctor 
                                          </div>
                                         
                                          <div class="doc-rw">
                                             <div class="doc-det1">
                                                <div class="">
                                                   <div class="search-txxt1">Search Doctors</div>
                                                   <div class="sepcific-doc">
                                                      <input class="form-inputs" name="srch_by_name" id="srch_by_name" placeholder="Search by doctor name.." type="text"/>
                                                   </div>
                                                </div>
                                             </div>
                                          </div> 

                                          <div class="doc-head avle-doc">
                                             Available Doctors :
                                          </div> 
                                                      
                                          <div class="inner-cont" id="content-d">
                                             <?php if(count($available_doctor_arr)>0){ 
                                                foreach ($available_doctor_arr as $doc_value) { 
                                             ?>
                                             <div class="doc-rw doctor_div" data-doc-name="<?php echo $doc_value['first_name']." ".$doc_value['last_name']; ?>">
                                                <div class="doc-det">
                                                   <div class="doc-pro">
                                                   <?php 
                                                   if(isset($doc_value['profile_image']) && $doc_value['profile_image']!='' && file_exists($doc_profile_img_base_path.$doc_value['profile_image'])){?>
                                                      <img src="{{ $doc_profile_img_public_path.$doc_value['profile_image'] }}" alt="profile img"/>
                                                   <?php } else{?>
                                                      <img src="{{ $doc_profile_img_public_path.'default-image.jpeg' }}" alt="profile img"/>
                                                   <?php } ?>
                                                   </div>
                                                   <div class="doc-nm">
                                                      <a href="#doctor_popup_{{ $doc_value['doctor_details']['user_id'] }}" data-toggle="modal">
                                                      <?php echo $doc_value['title'].". ".$doc_value['first_name']." ".$doc_value['last_name']; ?></a>
                                                      <span class="doc-status">
                                                      Available Now
                                                      </span>
                                                   </div>
                                                   <div class="see-doc-btn">
                                                      <button class="view-time-btn get_doc_time" data-day-type="today" data-doctor-id="<?php echo $doc_value['doctor_details']['user_id']; ?>" data-avail-time-target="<?php echo $doc_value['doctor_details']['user_id']; ?>" >
                                                      View Times
                                                      </button>
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </div>
                                             </div>
                                             <?php $doc_details_arr = $doc_value;  ?>
                                              @include('front.patient.search.doctor_details_popup') 
                                             <div id="slot_div_<?php echo $doc_value['doctor_details']['user_id']; ?>" doctor-avail-time-section="<?php echo $doc_value['doctor_details']['user_id']; ?>" class="doc-times-bx" style="display:none;height:auto; max-height:300px;overflow-y:scroll;overflow-x:hidden;">
                                                <img src="{{ url('/') }}/public/images/load.gif" height="150" width="150" />
                                             </div>
                                          <?php } }elseif(date("H:i")>=convert_12_to_24(urldecode(Request::query('available_time')))){ ?>
                                             <div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span>Requested time should be greater than current time.
                                             </div> 
                                          <?php }else{ ?>
                                             <div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span>Doctors Not available.
                                             </div> 
                                             <?php } ?>

                                            <div class="next-avail-doc">
                                                Next Available Doctors :<!--  <span> (Wed 17th)</span> -->
                                             </div>
                                             <?php 
                                                if(count($next_doctor_arr)>0){ 
                                                foreach ($next_doctor_arr as $nxt_doc_value) { 
                                             ?>
                                             <div class="doc-rw doctor_div" data-doc-name="<?php echo $nxt_doc_value['first_name']." ".$nxt_doc_value['last_name']; ?>">
                                                <div class="doc-det">
                                                   <div class="doc-pro">
                                                      <img src="{{ $doc_profile_img_public_path.$nxt_doc_value['profile_image'] }}" alt="profile img"/>
                                                   </div>
                                                   <div class="doc-nm">
                                                      <a href="#doctor_popup_{{ $nxt_doc_value['doctor_details']['user_id'] }}" data-toggle="modal"><?php echo $nxt_doc_value['title'].". ".$nxt_doc_value['first_name']." ".$nxt_doc_value['last_name']; ?></a>
                                                      <span class="doc-status1">
                                                      Available {{ ($nxt_doc_value['doctor_availability'][0]['date'])?date('D,d M',strtotime($nxt_doc_value['doctor_availability'][0]['date'])):'' }}
                                                      </span>
                                                   </div>
                                                   <div class="see-doc-btn next-doc-btn">
                                                      <button data-day-type="nextday" class="get_doc_time" data-doctor-id="<?php echo $nxt_doc_value['doctor_details']['user_id']; ?>" data-avail-time-target="N<?php echo $nxt_doc_value['doctor_details']['user_id']; ?>">
                                                      Book Now
                                                      </button>
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </div>
                                             </div>
                                             <?php $doc_details_arr = $nxt_doc_value;  ?>
                                              @include('front.patient.search.doctor_details_popup') 
                                             <div id="nxt_slot_div_<?php echo $nxt_doc_value['doctor_details']['user_id']; ?>"  doctor-avail-time-section="N<?php echo $nxt_doc_value['doctor_details']['user_id']; ?>" class="doc-times-bx" style="display:none;height:200px;overflow-y:scroll;overflow-x:hidden;">                                                
                                             </div>
                                             <?php } }elseif(date("H:i")>=convert_12_to_24(urldecode(Request::query('available_time')))){ ?>
                                             <div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span>Requested time should be greater than current time.
                                             </div> 
                                          <?php }else{ ?>
                                             <div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span>Doctors Not available.
                                             </div> 
                                             <?php } ?>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- <div class="col-sm-4 col-md-4 col-lg-4">&nbsp;</div> -->
                                 </div>
                              </div>
                           </div>

                           <!-- Time confirm modal-->

<!--login popup start here-->
<div id="confirm_time_popup" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">
            <img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
            </button>
         </div>
         <div class="modal-body bdy-pading">
            <div class="login_box">
               <form name="frm_confirm_booking" id="frm_confirm_booking" method="post" action="{{ url('/') }}/search/doctor/confirm_booking{{ '?'.Request::getQueryString() }}">
               {{csrf_field()}}
                  <div class="title_login">Confirm Booking</div>
                  <div class="tag-txt">You've selected to see the doctor at: <span id="spn_confirm_time" style="color:#51ab51;"></span> on Thursday <span style="color:#51ab51;" id="spn_confirm_date"></span>. Would you like to finalise this booking?</div>                  
                  <div class="popup_btnns_booking" style="text-align:center;">
                     <div class="login-bts">
                        <input type="hidden" name="confirm_date" id="confirm_date" value="" />
                        <input type="hidden" name="confirm_time" id="confirm_time" value="" />
                        <input type="hidden" name="doctor_id" id="doctor_id" value="" />                        
                        <button class="btn btn-search-login" value="Yes" name="confirm_booking" id="confirm_booking" type="submit">Confirm Booking</button>
                        <button class="btn btn-search-login1 login_close" data-dismiss="modal" value="cancel"  type="button">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>



                           <!-- Time confirm modal-->

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
                                          <input class="timepicker-default" type="text" name="available_time" id="available_time"  value="{{ urldecode(Request::query('available_time')) }}" />
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
                 minDate: '0' //would work too
          });
      });


      $(document).ready(function()
      {

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


          var arr_avail_time = $("[data-avail-time-target]");
          $.each(arr_avail_time,function(index,elem)
          {
             $(elem).on('click',function()
              {
                 var target = $(elem).attr('data-avail-time-target');
                 var target_elem = $('[doctor-avail-time-section="'+target+'"]');    
                 var arr_avail_time_section = $('[doctor-avail-time-section]').not(target_elem);    
                 
                 
                 $(arr_avail_time_section).each(function(index,elem)
                 {
                     $(elem).hide();
                 });
                 
                 $(target_elem).slideToggle('slow');
              });       
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

      $('.get_doc_time').click(function(){
         var doctor_id = $(this).attr('data-doctor-id');
         var day_type = $(this).attr('data-day-type');
         var available_time = $('#available_time').val();
         var available_date = $('#available_date').val();
         if(doctor_id!='' && day_type!='')
         {
            $.ajax({
               url:'{{ url("/") }}/search/doctor/availability',
               type:'get',
               data:{doctor_id:doctor_id,day_type:day_type,available_time:available_time,available_date:available_date},
               success:function(res){ //return false;
                  if(res!='')
                  {
                     if(day_type=='today')
                     {
                        $('#slot_div_'+doctor_id).html(res);
                     }
                     else
                     {
                        $('#nxt_slot_div_'+doctor_id).html(res);
                     }
                  }
               }
            });
         }
      });

      

      });

      $(document).on('click', '.assign_confirm_time', function(){
            var cdate = $(this).attr('data-date');
            var ctime = $(this).attr('data-time');
            var doctor_id = $(this).attr('data-doctor-id');
            if(cdate!='' && ctime!='' && doctor_id!='')
            {
               $('#confirm_date').val(cdate);
               $('#confirm_time').val(ctime);
               $('#doctor_id').val(doctor_id);
               $('#spn_confirm_date').html(cdate);
               $('#spn_confirm_time').html(ctime);
               $('#confirm_time_popup').modal('show');
               return true;
            }
            return false;
      });

</script>
@stop