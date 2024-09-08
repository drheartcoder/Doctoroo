@extends('front.doctor.layout.master')                   
@section('main_content')
<style>
  .status_pointer
  {
    cursor: pointer;
  }
</style>
      <!--calender section start-->    

       <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>

      <div class="container-fluid fix-left-bar">
         <div class="row">
         @include('front.doctor.layout._sidebar')
            <div class="col-sm-12 col-md-9 col-lg-10">
              <div class="das-middle-content">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="inner-head">{{ $page_title or '' }}</div>
                       <div class="head-bor"></div>
                    </div>

                    {{--New Consultation--}}

                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 New Consultation
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                               {{--   {{ dd($arr_new_consult) }} --}}
                                @if(isset($arr_new_consult) && sizeof($arr_new_consult)>0)

                                  @foreach($arr_new_consult as $consultation)

                                    <tr>
                                      <td style="color: #868686;">
                                        
                                     @if(isset($consultation['consultation_time']) && $consultation['consultation_time']!='')
                                        <?php
                                           $consultation_time = '';
                                           $consultation_date = '';
                                           $consultation_time = date('h:i a', strtotime($consultation['consultation_time']));

                                           $consultation_date  = date('d M Y',strtotime($consultation['consultation_date']));

                                         ?>

                                             {{ $consultation_time or ''  }}, {{ $consultation_date or '' }}
                                      @endif

                                      </td>
                                       <td>

                                       @if(isset($consultation['familiy_member_info']) && $consultation['familiy_member_info']!='')

                                         {{ isset($consultation['familiy_member_info']['first_name'])?$consultation['familiy_member_info']['first_name']:'--' }}


                                         {{ isset($consultation['familiy_member_info']['last_name'])?$consultation['familiy_member_info']['last_name']:'--' }}

                                       @else

                                        {{ isset($consultation['patient_user_details']['first_name'])?$consultation['patient_user_details']['first_name']:'--' }}


                                        {{ isset($consultation['patient_user_details']['last_name'])?$consultation['patient_user_details']['last_name']:'--' }}

                                      @endif

                                       </td>
                                       <td style="color:#6b5883;"> 

                                             <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultation['id']) }}/{{ base64_encode($consultation['family_member_id']) }}">Details
                                             </a>
                                       </td>
                                       <td>
                                              <a onclick="changeBookingStatus('{{ base64_encode($consultation['id']) }}','{{ 'confirm' }}')" class="status_pointer">
                                                <img class="icons-dash" src="{{url('/')}}/public/images/check-icon.png" alt="icon"/>
                                             </a>
                                              <a  onclick="changeBookingStatus('{{ base64_encode($consultation['id']) }}','{{ 'decline' }}')" class="status_pointer">
                                                <img class="icons-dash" src="{{url('/')}}/public/images/cross-icon.png" alt="icon"/>
                                             </a>
                                       </td>
                                    </tr>
                                    @endforeach
                              @else
                              <div class="search-grey-bx">
                                    <div class="row">
                                       {{ 'No new consultations are present.' }}
                                    </div>
                              </div>

                              @endif

                                 </table>
                              </div>
                               </div>
                           </div>
                        </div>
                     </div>


                      {{--past Consultation--}}
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Expired Consultation
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                @if(isset($arr_past_consult) && sizeof($arr_past_consult)>0)

                                  @foreach($arr_past_consult as $consultation)

                                    <tr>
                                      <td style="color: #868686;">
                                        
                                               @if(isset($consultation['consultation_time']) && $consultation['consultation_time']!='')
                                                      <?php
                                                         $consultation_time = '';
                                                         $consultation_date = '';
                                                         $consultation_time = date('h:i a', strtotime($consultation['consultation_time']));

                                                         $consultation_date  = date('d M Y',strtotime($consultation['consultation_date']));

                                                       ?>

                                                       {{ $consultation_time or ''  }}, {{ $consultation_date or '' }}
                                                @endif

                                      </td>

                                       <td>

                                       @if(isset($consultation['familiy_member_info']) && $consultation['familiy_member_info']!='')

                                         {{ isset($consultation['familiy_member_info']['first_name'])?$consultation['familiy_member_info']['first_name']:'--' }}

                                         {{ isset($consultation['familiy_member_info']['last_name'])?$consultation['familiy_member_info']['last_name']:'--' }}

                                       @else

                                        {{ isset($consultation['patient_user_details']['first_name'])?$consultation['patient_user_details']['first_name']:'--' }}

                                        {{ isset($consultation['patient_user_details']['last_name'])?$consultation['patient_user_details']['last_name']:'--' }}
                                       @endif

                                       </td>

                                       <td style="color:#6b5883;"> 
                                           
                                          {{--1 set for expire consultation--}}
                                           <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultation['id']) }}/{{ base64_encode($consultation['family_member_id']) }}/{{ base64_encode(1) }}">
                                             Details
                                             </a>
                                       </td>
                                 
                                    </tr>
                                    @endforeach
                              @else
                              <div class="search-grey-bx">
                                    <div class="row">
                                       {{ 'No past consultations are present.' }}
                                    </div>
                              </div>
                              @endif

                              </table>
                              </div>


                             </div>
                           </div>
                        </div>
                     </div> 




                      {{--Confirmed Consultation--}}
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                Confirmed Consultation
                              </div>
                              <div class="content-d">
                                <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                 @if(isset($arr_confirmed_consult) && sizeof($arr_confirmed_consult)>0)

                                    @foreach($arr_confirmed_consult as $confirmed_consultation)

                                    <tr>
                                       <td style="color: #868686;">
                                         
                                               @if(isset($confirmed_consultation['consultation_time']) && $confirmed_consultation['consultation_time']!='')
                                                      <?php
                                                         $consultation_time = '';
                                                         $consultation_date = '';
                                                         $consultation_time = date('h:i a', strtotime($confirmed_consultation['consultation_time']));

                                                         $consultation_date  = date('d M Y',strtotime($confirmed_consultation['consultation_date']));

                                                       ?>

                                                       {{ $consultation_time or ''  }}, {{ $consultation_date or '' }}
                                                @endif

                                      </td>
                                       <td> 
                                         @if(isset($confirmed_consultation['familiy_member_info']) && $confirmed_consultation['familiy_member_info']!='')


                                            {{ isset($confirmed_consultation['familiy_member_info']['first_name'])?$confirmed_consultation['familiy_member_info']['first_name']:'--' }}

                                            {{ isset($confirmed_consultation['familiy_member_info']['last_name'])?$confirmed_consultation['familiy_member_info']['last_name']:'--' }}

                                         @else

                                             {{ isset($confirmed_consultation['patient_user_details']['first_name'])?$confirmed_consultation['patient_user_details']['first_name']:'--' }}

                                             {{ isset($confirmed_consultation['patient_user_details']['last_name'])?$confirmed_consultation['patient_user_details']['last_name']:'--' }}
                                         @endif

                                       </td>
                                       <td style="color:#6b5883;">   
                                          
                                           <a href="{{ $module_consult_path }}/details/{{ base64_encode($confirmed_consultation['id']) }}/{{ base64_encode($confirmed_consultation['family_member_id']) }}">Details
                                             </a>

                                       </td>
                                       <td style="color:#6b5883;" onclick="offerTimeToPatient()" >Reschedule </td>
                                    </tr>
                                  
                                    @endforeach

                                 @else
                                <div class="search-grey-bx">
                                      <div class="row">
                                         {{ 'No confirmed consultations are present.' }}
                                      </div>
                                </div>

                                 @endif
                                 </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     {{--Declined Consultation--}}
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Declined Consultation
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                @if(isset($arr_declined_consult) && sizeof($arr_declined_consult)>0)

                                  @foreach($arr_declined_consult as $consultation)

                                    <tr>
                                      <td style="color: #868686;">
                                        
                                               @if(isset($consultation['consultation_time']) && $consultation['consultation_time']!='')
                                                      <?php
                                                         $consultation_time = '';
                                                         $consultation_date = '';
                                                         $consultation_time = date('h:i a', strtotime($consultation['consultation_time']));

                                                         $consultation_date  = date('d M Y',strtotime($consultation['consultation_date']));

                                                       ?>

                                                       {{ $consultation_time or ''  }}, {{ $consultation_date or '' }}
                                                @endif

                                      </td>
                                       <td>

                                          @if(isset($consultation['familiy_member_info']) && $consultation['familiy_member_info']!='')


                                          {{ isset($consultation['familiy_member_info']['first_name'])?$consultation['familiy_member_info']['first_name']:'--' }}

                                          {{ isset($consultation['familiy_member_info']['last_name'])?$consultation['familiy_member_info']['last_name']:'--' }}

                                         @else


                                            {{ isset($consultation['patient_user_details']['first_name'])?$consultation['patient_user_details']['first_name']:'--' }}

                                           {{ isset($consultation['patient_user_details']['last_name'])?$consultation['patient_user_details']['last_name']:'--' }}

                                         @endif

                                       </td>
                                       <td style="color:#6b5883;"> 
                                         

                                          <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultation['id']) }}/{{ base64_encode($consultation['family_member_id']) }}">Details
                                             </a>

                                       </td>
                                 
                                    </tr>
                                    @endforeach
                              @else
                              <div class="search-grey-bx">
                                    <div class="row">
                                       {{ 'No declined consultations are present.' }}
                                    </div>
                              </div>
                              @endif

                              </table>
                              </div>


                             </div>
                           </div>
                        </div>
                     </div> 



                    

                  </div>
               </div>
            </div>
         </div>
      </div>

     
      <!-- custom scrollbars plugin -->
      <!-- custom scrollbars plugin -->
      <link href="{{ url('/') }}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <!-- custom scrollbar plugin -->
      <script src="{{ url('/') }}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script>
         (function($){
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
                 $(".content-d").mCustomScrollbar({theme:"dark"});
         
         });
         })(jQuery);
      </script>

      <script>
        
         function changeBookingStatus(ref,type)
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
                               var url ='{{ $module_consult_path }}/change_status/'+ref+'/'+type
                               window.location.href = url;
                         }
                  });

               
         }

      </script>
@endsection