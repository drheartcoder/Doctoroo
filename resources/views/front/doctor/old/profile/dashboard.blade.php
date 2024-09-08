@extends('front.doctor.layout.master')                
@section('main_content')
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
                      <div class="inner-head">Dashboard</div>
                       <div class="head-bor"></div>
                       <div class="doc-name">
                             @if(isset($arr_doctor_data) && sizeof($arr_doctor_data))
                                 Hi <span> Dr.{{ $arr_doctor_data['first_name'] or '' }} {{ $arr_doctor_data['last_name'] or '' }}
                                 </span>, Welcome back
                             @endif
                        </div>
                    </div>
                     <div class="col-sm-12">
                       <div style="margin-top:10px;">@include('front.layout._operation_status')</div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-8">
                        <!-- <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Calendar
                              </div>
                              <div class="calender-bxx">
                                 <img class="img-responsive" src="{{url('/')}}/public/images/cal-img1.png" alt="img"/>
                              </div>
                              <a class="links" href=""> Update Availability</a>
                           </div>
                        </div> -->
                     <!-- </div>
                     <div class="col-sm-12 col-md-12 col-lg-4"> -->
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 New Consultation
                              </div>
                              <div class="content-d" style="height:310px;">
                                 <div class="table-responsive basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                    @if(isset($arr_booking_data) && sizeof($arr_booking_data)>0)
                                     @foreach($arr_booking_data as $booking)

                                       <tr>
                                          <td>&nbsp;</td>
                                          <td style="color: #868686;">
                                                @if(isset($booking['consultation_time']) && $booking['consultation_time']!='')
                                                      <?php
                                                         $consultation_time = '';
                                                         $consultation_date = '';
                                                         $consultation_time = strtoupper(date('h:i a', strtotime($booking['consultation_time'])));
                                                         $consultation_date  = date('d M Y',strtotime($booking['consultation_date']));
                                                       ?>
                                                       <span style="color:#50ab50;">{{ $consultation_time or ''  }}</span> , <span style="color:#6b5883;">{{ $consultation_date or '' }}</span>
                                                @endif
                                          </td>

                                          <td>
                                            <span style="">{{ $booking['patient_user_details']['first_name'] or '' }}</span>
                                            {{ $booking['patient_user_details']['last_name']  or '' }}
                                          </td>
                                          
                                          
                                          <td>
                                             <a href="javascript:void(0);" style="color:#A7A7A7;font-size:16px;font-weight:normal;text-decoration:none;">
                                                {{ $booking['booking_status'] }}
                                             </a>
                                          </td>
                                          <td style="width:20%;">
                                             <a onclick="changeBookingStatus('{{ base64_encode($booking['id']) }}','{{ 'confirm' }}')" style="cursor:pointer;">
                                             <span style="color:#289C28;font-size:16px;font-weight:normal;text-decoration:none;">Accept</span> 
                                                <!-- <img class="icons-dash" src="{{url('/')}}/public/images/check-icon.png" alt="icon"/> -->
                                             </a>
                                          /
                                             <a onclick="changeBookingStatus('{{ base64_encode($booking['id']) }}','{{ 'decline' }}')" style="cursor:pointer;">
                                                <span style="color:#F32A2A;font-size:16px;font-weight:normal;text-decoration:none;">Reject</span>
                                                <!-- <img class="icons-dash" src="{{url('/')}}/public/images/cross-icon.png" alt="icon"/> -->
                                             </a>
                                          </td>
                                          <td style="color:#6b5883;">
                                             <a href="{{ url('/') }}/doctor/consultation/details/{{ base64_encode($booking['id']) }}">
                                             Details</a>
                                          </td>
                                       </tr>
                                     @endforeach
                                    @else

                                       <div class="search-grey-bx">
                                           <div class="row">
                                                    {{ 'No new consultations are available' }}
                                            </div>
                                       </div>


                                    @endif
                                      
                                    
                                     
                                    </table>
                                 </div>
                              </div>
                              <a class="links" href="#" style="text-align:center;"> View All Bookings</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Reminders
                              </div>
                              <div class="content-d">
                                 <div class="table-responsive basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;"> 8:40 am, 12 JUN</td>
                                          <td>Odit, iusto, dolorem, aut ipsum...</td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Messages
                              </div>
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Medical Certificate</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Nicolas Payne</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Caroline Fowler</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2" style="text-align:center;">
                                          <a href="" class="links"> View All Messages</a>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Notifications
                              </div>
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                    <tr>
                                       <td style="white-space:normal;">
                                          Odit, iusto, dolorem, aut ipsum 
                                          rem atque enim
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          At, veniam, officia pariatur voluptas 
                                          molestias nobis
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          Laborum, ducimus, perferendis 
                                          nulla magni sequi
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2" style="text-align:center;">
                                          <a href="" class="links"> View All Notifications</a>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Requests
                              </div>
                              <div class="table-responsive basic-table">
                                 <div class="table-responsive basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                       <tr>
                                          <td style="white-space:normal;">
                                             <span style="font-family:'robotomedium',sans-serif;font-size:16px;">Prescription </span><br/>
                                             Transport few items from Hills...
                                          </td>
                                          <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                       </tr>
                                       <tr>
                                          <td style="white-space:normal;">
                                             <span style="font-family:'robotomedium',sans-serif;font-size:16px;">Medical Certificate</span><br/>
                                             Transport few items from Hills...
                                          </td>
                                          <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                       </tr>
                                       <tr>
                                          <td style="white-space:normal;">
                                             <span style="font-family:'robotomedium',sans-serif;font-size:16px;">Referral </span><br/>
                                             Transport few items from Hills...
                                          </td>
                                          <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                       </tr>
                                       <tr>
                                          <td colspan="2" style="text-align:center;">
                                             <a href="" class="links"> View All Requests</a>
                                          </td>
                                       </tr>
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
      <!--calender section end-->       
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
                         var url ='{{ url('/') }}/doctor/consultation/change_status/'+ref+'/'+type
                         window.location.href = url;
                   }
            });

         
   }
</script>

@endsection