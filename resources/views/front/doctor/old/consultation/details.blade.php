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
                                                <th>
                                                @if(isset($arr_booking_details['familiy_member_info']) && sizeof(['familiy_member_info'])>0)

                                                    {{ $arr_booking_details['familiy_member_info']['first_name'] or '--'}}
                                                    {{ $arr_booking_details['familiy_member_info']['last_name'] or '--'}}

                                                @else
                                                    {{ $arr_booking_details['patient_user_details']['first_name'] or '--'}}
                                                    {{ $arr_booking_details['patient_user_details']['last_name'] or '--'}}
                                                @endif
                                                </th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Gender</td>
                                             <td>
                                             @if(isset($arr_booking_details['familiy_member_info']) && sizeof(['familiy_member_info'])>0)   

                                                 {{ $arr_booking_details['familiy_member_info']['gender'] or ''  }}


                                             @else
                                                   @if(isset($arr_booking_details['patient_info']['gender']) && $arr_booking_details['patient_info']['gender']=='F')
                                                      {{ 'Female' }}

                                                   @elseif(isset($arr_booking_details['patient_info']['gender']) && $arr_booking_details['patient_info']['gender']=='M')

                                                       {{ 'Male' }}
                                                   @else
                                                   {{ '--' }}
                                                   @endif
                                             @endif

                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Date of Birth</td>

                                             <td>
                                              @if(isset($arr_booking_details['familiy_member_info']) && sizeof(['familiy_member_info'])>0)

                                                {{ isset($arr_booking_details['familiy_member_info']['date_of_birth'])?date('d M,Y',strtotime($arr_booking_details['familiy_member_info']['date_of_birth'])):'--' }}

                                              @else

                                              {{ isset($arr_booking_details['patient_info']['date_of_birth'])?date('d M,Y',strtotime($arr_booking_details['patient_info']['date_of_birth'])):'--' }}

                                             @endif
                                             </td>

                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Email</td>
                                             <td>{{ $arr_booking_details['patient_user_details']['email'] or '--'}}</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Mobile Phone</td>
                                             <td>

                                                 @if(isset($arr_booking_details['familiy_member_info']) && sizeof(['familiy_member_info'])>0)

                                                   {{ isset($arr_booking_details['familiy_member_info']['mobile_number'])?$arr_booking_details['familiy_member_info']['mobile_number']:'--' }}

                                                 @else

                                                    {{ $arr_booking_details['patient_info']['phone_no'] or '--'}}
                                                 @endif

                                             </td>
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
                                          <p>Booking Details</p>
                                          <div class="time-bxx"> <span> Time : </span>{{ $consultation_time or '' }} </div>
                                          <div class="time-bxx"> <span> Date : </span>{{ $day or '' }} {{ $consultation_date or '' }} </div>

                                    {{--status 1 set for expire records--}}
                                    @if(isset($status) && $status=="1")

                                    @else

                                    @if(isset($arr_booking_details['booking_status']) && $arr_booking_details['booking_status']=='Pending')
                                      <div class="bk-bts">
                                        <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','confirm')" > Accept</button>
                                        <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','decline')" > Decline</button>
                                        <button class="acc-btn" onclick="offerTimeToPatient()"> Offer Another Time</button>
                                      </div>
                                    @else
                                    <div class="bk-bts">                                                   
                                      @if(isset($arr_booking_details['booking_status']) && $arr_booking_details['booking_status']!='Declined')
                                        <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','decline')" >Decline Booking</button>
                                      @else
                                        <button class="acc-btn" onclick="changeStatus('{{ base64_encode($arr_booking_details['id']) }}','confirm')" > Accept</button>
                                      @endif
                                        <button class="acc-btn" onclick="offerTimeToPatient()" > Reschedule</button>
                                        <button class="acc-btn"> Notify Patient</button>
                                        <button class="acc-btn" onclick="javascript:window.location.href='{{ url('/doctor/consultation/call/'.base64_encode($arr_booking_details['id'])) }}'"> Start Consultation</button>
                                    </div>
                                    @endif
                                    <br/>

                                    @endif

                                       </div>
                                    </div>
                                 </div>
                              </div>

                              @if(isset($arr_booking_details['health_images']) && sizeof($arr_booking_details['health_images'])>0)

                              <div class="req-detail-head">
                                 Photos Uploaded
                              </div>
                              <div class="portfolio-bx">

                              
                                @foreach($arr_booking_details['health_images'] as $health_images)
                                 @if(isset($health_images['health_image']) && $health_images['health_image']!="" && file_exists($health_issue_base_img_path.$health_images['health_image']))
                          
                                   <div class="port">
                                      <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                      <img src="{{ $health_issue_public_img_path.$health_images['health_image'] }}" height="150" width="200" alt="img"/>
                                   </div>

                                 @endif
                                @endforeach
                              @endif

                              </div>
                              <div class="req-detail-head">
                                 Health issue
                              </div>
                              <div class="det-con">
                               {{isset($arr_booking_details['health_issue'])?$arr_booking_details['health_issue']:'--'}}
                              </div>
                              
                          @if(isset($arr_booking_details['health_precription']['current_prescription_upload']) && $arr_booking_details['health_precription']['current_prescription_upload']!="" && file_exists($prescription_base_img_path.$arr_booking_details['health_precription']['current_prescription_upload']))

                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">Uploaded current prescription</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">

                                        <a href="{{ $module_booking_path }}/download/{{ base64_encode($arr_booking_details['health_precription']['temp_booking_id']) }}" class="download">

                                             <img src="{{ url('/') }}/public/images/download-img.png" alt="upload icon"/></span>
                                        </a>
                                    </div>
                                 </div>
                              </div>
                              
                          @endif

                          @if(isset($arr_booking_details['health_precription']['currently_taking_medications']) && $arr_booking_details['health_precription']['currently_taking_medications']!="")
                          <div class="req-detail-head">
                                Prescription Questions 
                              </div>

                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">About Current Medications you are taking.</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       {{ $arr_booking_details['health_precription']['currently_taking_medications'] or '--' }}
                                    </div>
                                 </div>
                              </div>
                              
                          @endif

                          @if(isset($arr_booking_details['health_precription']['what_is_medications']) && $arr_booking_details['health_precription']['what_is_medications']!="")
                           

                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">About Medications previously you were taken.</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       {{ $arr_booking_details['health_precription']['what_is_medications'] or '--' }}
                                    </div>
                                 </div>
                              </div>
                              
                          @endif

                          @if(isset($arr_booking_details['health_precription']['how_long_medications']) && $arr_booking_details['health_precription']['how_long_medications']!="")


                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">How long have you been taking the medication?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                     {{ $arr_booking_details['health_precription']['how_long_medications'] or '--' }}
                                    </div>
                                 </div>
                              </div>
                              
                          @endif

                          @if(isset($arr_booking_details['health_precription']['other_info']) && $arr_booking_details['health_precription']['other_info']!="")


                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">Any other Information?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                     {{ $arr_booking_details['health_precription']['other_info'] or '--' }}
                                    </div>
                                 </div>
                              </div>
                          @endif

                           <div class="req-detail-head">
                                 Downloads
                           </div>
                           <div class="det-con">
                              test
                           </div>  
                          @if(isset($arr_booking_details['medical_question']['symptoms_from']) && $arr_booking_details['medical_question']['symptoms_from']!="" && isset($arr_booking_details['medical_question']['certificate_from_date']) && $arr_booking_details['medical_question']['certificate_from_date']!="")
                           <div class="req-detail-head">
                                Medical Certificate Questions 
                              </div>
                           @if(isset($arr_booking_details['medical_question']['symptoms_from']) && $arr_booking_details['medical_question']['symptoms_from']!="")

                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">How Long have you had the symptoms ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                     {{ $arr_booking_details['medical_question']['symptoms_from'] or '--' }}
                                    </div>
                                 </div>
                              </div>
                              
                          @endif

                          @if(isset($arr_booking_details['medical_question']['certificate_from_date']) && $arr_booking_details['medical_question']['certificate_from_date']!="")


                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text">What dates do you need the certificate for ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                        <div class="q-icon">
                                            certificate from date :
                                       </div>
                                          {{ $arr_booking_details['medical_question']['certificate_from_date'] }}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="q-icon">certificate to date :</div>
                                          {{ $arr_booking_details['medical_question']['certificate_to_date'] }} 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                          @endif
                           @endif


                             
                              
                        @if(!empty($arr_booking_details['regular_doctor_info']['reg_doctor_name']) && sizeof($arr_booking_details['regular_doctor_info'])>0 && $arr_booking_details['regular_doctor_info']!='')

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
                                           @if(isset($arr_booking_details['regular_doctor_info']['reg_doctor_name']) && $arr_booking_details['regular_doctor_info']['reg_doctor_name']!="")
                                            Dr, {{ $arr_booking_details['regular_doctor_info']['reg_doctor_name'] }}
                                           @endif
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              
                              
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Phone Number</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                         {{ $arr_booking_details['regular_doctor_info']['reg_doctor_phone'] or '' }}
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
                                          {{ $arr_booking_details['regular_doctor_info']['reg_doctor_address'] or '' }}
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>

                        @endif

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

      @include('front.doctor.consultation.reshedule_modal')


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
</script>
@endsection