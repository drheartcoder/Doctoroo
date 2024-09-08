@extends('front.doctor.layout.master')                   
@section('main_content')
<style>
   .book_time_slot
   {
      background: #644e7c;border: 1px solid #644e7c;color: #fff;padding: 2px 18px;
   }
   .vlt_time_slot
   {
      cursor: pointer;
   }
</style>
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
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="inner-head">{{ $page_title or '' }}</div>
                        <div class="head-bor"></div>
                        <div class="doc-dash-right-bx">
                           <div class="request-details-bx">

                            @include('front.layout._operation_status')

                              <div class="req-detail-head">
                                 patient Info
                                 <div class="doc-sign"><span><img src="{{ url('/') }}/public/images/doc-sign.png" alt="sign"/></span>Doctoroo Patient</div>
                              </div>
                              <div class="row">
                                 <div class="col-sm12 col-md-6 col-lg-6">
                                    <div class="table-responsive basic-table">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th style="color:#a5a5a5;font-family:'robotomedium';width:200px;">Name</th>
                                                <th>{{ $arr_booking_details['patient_user_details']['first_name'] or '--'}}{{ $arr_booking_details['patient_user_details']['last_name'] or '--'}}</th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Gender</td>
                                             <td>
                                                   @if(isset($arr_booking_details['patient_info']['gender']) && $arr_booking_details['patient_info']['gender']=='F')
                                                      {{ 'Female' }}

                                                   @elseif(isset($arr_booking_details['patient_info']['gender']) && $arr_booking_details['patient_info']['gender']=='M')

                                                       {{ 'Male' }}
                                                   @else
                                                   {{ '--' }}
                                                   @endif

                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Date of Birth</td>
                                             <td>{{ isset($arr_booking_details['patient_info']['date_of_birth'])?date('d M,Y',strtotime($arr_booking_details['patient_info']['date_of_birth'])):'--' }}</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Email</td>
                                             <td>{{ $arr_booking_details['patient_user_details']['email'] or '--'}}</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Mobile Phone</td>
                                             <td>{{ $arr_booking_details['patient_info']['phone_no'] or '--'}}</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Address</td>
                                             <td>{{ $arr_booking_details['patient_info']['streen_address'] or '--'}}</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td>{{ $arr_booking_details['patient_info']['suburb'] or ''}}</td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>

                                 {{-- {{ dd($arr_booking_details) }} --}}

                              @if(isset($arr_booking_details['consultation_time']) && $arr_booking_details['consultation_time']!='')
                                 <?php
                                    $consultation_time = '';
                                    $consultation_date = '';
                                    $consultation_time = date('h:i a', strtotime($arr_booking_details['consultation_time']));

                                    $consultation_date  = date('d-M-Y',strtotime($arr_booking_details['consultation_date']));
                                    $day                = date('D',strtotime($arr_booking_details['consultation_date']));
                                  ?>

                              @endif


                                 <div class="col-sm12 col-md-6 col-lg-6">
                                    <div class="med-div req-book">
                                       <div class="tble-title"> Bookings </div>
                                       <div class="med-cent ">
                                          <p> New Requested Booking</p>
                                          <div class="time-bxx"> <span> Time : </span>{{ $consultation_time or '' }} </div>
                                          <div class="time-bxx"> <span> Date : </span>{{ $day or '' }} {{ $consultation_date or '' }} </div>

                                          @if(isset($arr_booking_details['booking_status']) && $arr_booking_details['booking_status']=='Pending')
                                             <div class="bk-bts">
                                             
                                                 <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','confirm')" > Accept</button>


                                                 <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','decline')" > Decline</button>

                                                 <button class="acc-btn" onclick="offerTimeToPatient()"> Offer Another Time</button>
                                               
                                             </div>
                                          @else
                                             <div class="bk-bts">
                                                   

                                                <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','cancel')" >Cancel Booking</button>

                                                <button class="acc-btn"> Reschedule</button>

                                                <button class="acc-btn"> Notify Patient</button>
                                             </div>
                                          @endif
                                          <br/>

                                          

                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Photos Uploaded
                              </div>
                              <div class="portfolio-bx">
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="{{ url('/') }}/public/images/port1.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="{{ url('/') }}/public/images/port2.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="{{ url('/') }}/public/images/port3.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="{{ url('/') }}/public/images/port4.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="{{ url('/') }}/public/images/port5.jpg" alt="img"/>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Description uploaded
                              </div>
                              <div class="det-con">
                                 Non illo quia beatae ratione impedit sunt libero ut aliquam ipsam minus laborum quidem id perferendis magnam quasi reiciendis occaecati placeat inventore dolores maiores porro ipsa qui doloremque porro corrupti quo aut quia ipsam quaerat ut dolorum in et ratione est autem debitis
                              </div>
                              <div class="req-detail-head">
                                 Answers to all Questions
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> Increased heart rate ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       Dear Doctor, I am a 30-year-old male, 73 Kgs, 173 cm, smoker. I have been checking my heart rate over the past few weeks and it is constantly between 95 to 105. I have checked with 3-4 devices at different intervals during different days and my heart rate just would not go below 95. I had a blood test recently and my HSCRP, Cholesterol and all cardiac tests are within the normal range. I have started working out recently and am trying to cut down on cigarettes. 
                                    </div>
                                 </div>
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> Pulmonary blockage ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       My father had a heart attack about 5months ago which was his first he never had any heart problems before that. He was admitted to Apollo and diagnosed with Acute pulmonary edema, moderate LV dysfunction / moderate MR, CAG on 06-06-2016 was 80% ostio proximal LAD stenosis and recanalised lcx with no significant residual stenosis
                                    </div>
                                 </div>
                              </div>
                              <div class="ques-ans-bx last">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> High bp at night ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       Respected sir , when i check my bp at night it alwys stands in a highr side 140/90 mmhg during day time 120/70 to 130/70 I dont excercise... i sleep at 3 Am and wake up at 12 Pm....i know my routine is so bad I feel pain in my left arm...i am so worried about this in a young age and my pulse is atound 46 at night most of time..ist okay? Should i start treatment or manage by diet and excercise ??? Is't possible yo manage by diet and excercise ??? Kindly give ur expert advice ..i ll b thankful 
                                    </div>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Requested Medication Name
                              </div>
                              <div class="det-con">
                                 &nbsp;
                              </div>
                              <div class="req-detail-head">
                                 Normal GP Details
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Name</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Dr, John Smith
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Gender</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Male
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Date of Birth</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          27-03-1988
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Email</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          contact@gmail.com
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Mobile Phone</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          (+012) 345 6789
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box last">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Address</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Street 123, Avenue 45, Country
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="det-req-btns">
                                 <a href="#" class="req-btnns"> Request a Consultation</a>
                                 <a href="#" class="req-btnns"> Chat with Patient</a>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

{{--modal for assign anathor time--}}

<!--login popup start here-->
<div id="offer-time-modal" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
  <div class="modal-dialog loign-insw">
    <!-- Modal content-->
    <div class="modal-content logincont">
         <div class="modal-header head-loibg">
              <button type="button" class="login_close close" data-dismiss="modal">
              <img src="{{ url('/') }}/public/images/close-popup.png" alt="">
              </button>
         </div>
      <div class="modal-body bdy-pading">
        
               <br/>
              <div class="alert-box success alert alert-warning alert-dismissible" id="response_success_msg" style="display: none;">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span style="font-size: 20px;">×</span></button>
              </div>

               <div class="alert-box alert_error alert-dismissible" id="res_err_msg" style="display: none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span style="font-size: 20px;">×</span></button>   
               </div>
          
            <div class="login_box text-center">
               <div class="title_login"></div>
                  <?php
                     $consult_time =  convert_24_to_12($arr_booking_details['consultation_time']);
                  ?>
   
                     <div class="doc-head avle-doc">
                        Available Time:
                     </div>
                     <div class="inner-cont" style="height:400px;overflow:scroll;">
                       <div class="currnt-booked">
                        <div class="doc-rw">
                           <div class="doc-det">
                              <div class="doc-pro">
                              
                              @if(isset($arr_booking_details['doctor_user_details']['profile_image']) && $arr_booking_details['doctor_user_details']['profile_image']!='' && file_exists($doctor_base_img_path.$arr_booking_details['doctor_user_details']['profile_image']))


                                 <img src="{{ $doctor_public_img_path.$arr_booking_details['doctor_user_details']['profile_image'] }}" alt="profile img"/>
                              @else

                                 <img src="{{ $doctor_public_img_path.'/default-image.jpeg' }}" alt="profile img"/>  

                              @endif
                              </div>
                              <div class="doc-nm">
                                 <span class="crrent-bked"> Currently Booked</span>
                                 {{ $arr_booking_details['doctor_user_details']['title'] or '' }}
                                 {{ $arr_booking_details['doctor_user_details']['first_name'] or '' }}
                                 {{ $arr_booking_details['doctor_user_details']['last_name'] or '' }}
                              </div>
                              <div class="see-doc-btn">
                                 <button class="view-time-btn" data-avail-time-target="11">
                                 View Times
                                 </button>

                              </div>

                              <div class="clearfix"></div>

                              <div class="see-doc-btn">
                                 Previous Booked Time:
                                 <button class="view-time-btn">
                                 {{ $consult_time or '' }}
                                 </button>

                              </div>
                              
                              <div class="clearfix"></div>
                             <div class="see-doc-btn">
                                 Previous Booked Date:
                                    
                                 {{ $consultation_date or '' }}
                              </div>

                               <div class="clearfix"></div>
                           </div>
                        </div>

                        <input type="hidden" name="time_slot" id="time_slot">
                        <input type="hidden" name="booking_date" id="booking_date">

                       @if(isset($arr_availble_time) && sizeof($arr_availble_time)>0) 
                         <div doctor-avail-time-section="11" class="doc-times-bx" style="display:none;">

                    
                           @foreach($arr_availble_time as $availble_time)

                              @if($availble_time['start_time']!='' && $availble_time['end_time']!='')


                               <?php
                                  $arr_time_slot = [];
                                  $start_time    = '';
                                  $start_time    = $availble_time['start_time'];
                                  
                                  $arr_time_slot    = create_booking_time_slots($availble_time['end_time']);

                 
                               ?>
                                <div class="day-txtt">
                                   @if(isset($availble_time['date']))
                                     <?php
                                       $day  = date('D',strtotime($availble_time['date']));
                                       $date = date('jS M Y',strtotime($availble_time['date']));
                                     ?>
                                   @endif
                                   {{ $day or '' }} {{ $date or '' }}
                                </div>

                                  @if(isset($arr_time_slot) && sizeof($arr_time_slot)>0)
                                    @foreach($arr_time_slot as $key=>$time_slot)
                                           
                                       
                                            <a onclick="setSelectedTime('{{$time_slot}}','{{ $availble_time['date'] }}','{{$key}}')" class="grn-time vlt_time_slot vlt_time_{{$key}}" >
                                            {{ $time_slot }}</a>
                                    
                                       

                                    @endforeach 
                                  @endif
                              @endif

                           @endforeach
                     
                            <div class="day-txtt">
                               <textarea cols="" rows="" name="message" id="message" data-rule-maxlength="255" placeholder="Please enter message " class="form-inputs" style="padding:10px;height:130px;margin:5px 0;"></textarea>
                               <div class="error" id="err_booking_msg"></div>
                            </div>
                            <div class="bk-bts">
                                                   
                                <button class="acc-btn" onclick="sendNotificationToPatient('{{ base64_encode($arr_booking_details['patient_user_id']) }}')" >Submit</button>
                
                            </div>
                        </div>

                        @else
                        <div class="search-grey-bx">
                                <div class="row">
                                        {{ 'Currently no time is available.' }}
                                </div>
                        </div>
                       @endif     

                     </div>
                  </div>
                
            </div>

      
        </div>
      </div>
    </div>
</div> 

{{---scrollbar css & js--}}
      <link href="{{ url('/') }}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <script src="{{ url('/') }}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>

      <script>
         (function($){
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; 
         $.mCustomScrollbar.defaults.axis="yx"; 
         
                 $("#content-scroll").mCustomScrollbar({theme:"dark"});
                 $("#content-d1").mCustomScrollbar({theme:"dark"});
         
         });
         })(jQuery);
      </script>


<script>

     $(document).ready(function()
      {
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
          
      
      
      });
         


   function changeStatus(ref,type)
   {  

         var msg = "Do you want to change the status of booking to "+type+"?";

         swal({
                

                  title: msg,
                  type: 'success',
                  showCancelButton: true,
                  allowOutsideClick: true,
                  html: true
                        
             },
             function(isConfirm)
             {
                   if(isConfirm)
                   {
                         var url = '{{ $module_booking_path }}/'+'change_status/'+ref+'/'+type
                         window.location.href = url;
                   }
            });

         
   }
   function offerTimeToPatient()
   {

      var msg = "Do you want to offer other time to patient?";

         swal({
                

                  title: msg,
                  type: 'success',
                  showCancelButton: true,
                  allowOutsideClick: true,
                  html: true
                        
             },
             function(isConfirm)
             {
                   if(isConfirm)
                   {
                       $("#offer-time-modal").modal('show');  
                   }
            });


   }
   function sendNotificationToPatient(patient_id)
   {
          $('#err_booking_msg').html('');
          var message      = $('#message').val();
          if(message=="")
          {
            $('#err_booking_msg').html('Please enter a message');
          }
          else
          {


                var url = '{{ $module_booking_path }}/offer_another_time';

                var token = $("input[name='_token']").val();    
             
                var data = new FormData();

                var booking_time = $('#time_slot').val();
                var booking_date = $('#booking_date').val();
               

                 data.append('booking_time',booking_time); 
                 data.append('booking_date',booking_date); 
                 data.append('patient_id',patient_id);
                 data.append('message',message);  
                 data.append('_token',token);

                 $.ajax({
                      url : url,
                      type:'POST',        
                      data:data, 
                      contentType: false,     
                      cache: false,          
                      processData:false,
                        beforeSend: function() 
                       {
                         showProcessingOverlay();
                       },
                       success: function(res)   
                       { 
                            hideProcessingOverlay();
                           if(res.status=="success")
                           {
                                   $('#response_success_msg').fadeIn(0, function()
                                   {
                                        $('#response_success_msg').html(res.msg);
                                       

                                   }).delay(2000).fadeOut('slow');  

                                   window.location.href="{{ url('/') }}/send_notification/"+patient_id+'/'+message;
                           }
                           else if(res.status=="error")
                           {
                                  $('#res_err_msg').fadeIn(0, function()
                                   {
                                        $('#res_err_msg').html(res.msg);
                                      
                                   }).delay(2000).fadeOut('slow');  
                           }
                       } 
                 });   
          }

   }
   function setSelectedTime(time_slot,date,index)
   {
         
       $('.vlt_time_slot').not(this).each(function(){
             $(this).removeClass('book_time_slot');
             $(this).addClass('grn-time');
         
       });   
      
      $('.vlt_time_'+index).removeClass('grn-time');
      $('.vlt_time_'+index).addClass('book_time_slot');


      $('#time_slot').val(time_slot);
      $('#booking_date').val(date);

   }

  
</script>
@endsection