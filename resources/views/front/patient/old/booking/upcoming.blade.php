@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')


		<?php
		 $segment = '';
		 $segment = Request::segment(3);
		?>


		      <!--dashboard section-->
      <div class="middle-section">
         <div class="container">
           @include('front.layout._operation_status')  
            <div data-responsive-tabs class="garag-profile-nav ans-tabs">
               <nav>
                  <ul>
                     <li @if(isset($segment) && $segment=="upcoming") class="active" @endif >
                          <a onclick="redirectToConsultation('upcoming')">Upcoming consultations</a> </li>
                     <li @if(isset($segment) && $segment=="past") class="active" @endif >
                     	  <a onclick="redirectToConsultation('past')" >Past consultations</a></li>
                  </ul>
               </nav>

               <div class="content res-full-tab">
                  <div id="one">
                     <div class="tab-section">

                     @if(isset($arr_upcoming_booking['data']) && sizeof($arr_upcoming_booking['data'])>0)

                        <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">


                              <tr class="table-head">
                                 <td>Time</td>
                                 <td>Doctor</td>
                                 <td>Set Reminder</td>
                                 <td>Reschedule</td>
                                 <td>Cancel</td>
                              </tr>
                         

                            @foreach($arr_upcoming_booking['data'] as $key=>$booking)
                              <tr>
                                 <td style="padding-top: 20px ! important;">
                                     @if(isset($booking['consultation_date']) && $booking['consultation_date']!='')
                                        <?php $date = date('d M Y',strtotime($booking['consultation_date']));  ?>
                                    @endif

                                    @if(isset($booking['consultation_time']) && $booking['consultation_time']!='')
                                        <?php $time = convert_24_to_12($booking['consultation_time']);  ?>
                                    @endif
                                    {{ $date or '' }}, {{ $time or '' }}
                                 </td>
                                 <td style="padding-top: 20px ! important;">
                                    
                                   Dr. {{ $booking['doctor_user_details']['first_name'] or '' }}
                                    {{ $booking['doctor_user_details']['last_name'] or '' }}

                                 </td>
                                 <td>
                                     {{-- <input type="text" class="dose-in input_bor-white" />  --}}
                                      <a  data-toggle="modal" href="#set-reminder-{{ $booking['id'] }}" class="cancel-link">Set Reminder</a>
                                 </td>
                                 <td style="padding-top: 20px ! important;">
                                     <a class="see-green"> See Available Times</a>
                                 </td>
                                 <td style="padding-top: 20px ! important;">
                                     <a href="#" class="cancel-link"> Cancel Appointment</a>
                                 </td>
                              </tr>
                            @endforeach
                       
                           </table>
                           
                           @include('front.layout._pagination_view', ['paginator' =>$arr_pagination])

                        </div>

                         @else
                           <div class="search-grey-bx">
                             <div class="row">
                                {{ 'Upcoming bookings are not present.' }}
                             </div>
                           </div>
                         @endif

                     </div>
                  </div>
               </div>


            </div>
         </div>
      </div>

      @include('front.patient.booking.set_reminder')

 <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
<script>
	    $(document).on('responsive-tabs.initialised', function(event, el) {
             //console.log(el);
         });
         
         $(document).on('responsive-tabs.change', function(event, el, newPanel) {
             //console.log(el);
             //console.log(newPanel);
         });
         
         $('[data-responsive-tabs]').responsivetabs({
             initialised: function() {
                 //console.log(this);
             },
         
             change: function(newPanel) {
                 //console.log(newPanel);
             }
         });
</script>
<script>
	function redirectToConsultation(url)
	{
		var redirect_url     = '{{ $module_url_path }}/'+url
		window.location.href = redirect_url;
	}
</script>
@endsection
