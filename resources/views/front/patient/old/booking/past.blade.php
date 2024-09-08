@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')


	  <?php
		 $segment = '';
		 $segment = Request::segment(3);
	  ?>

      <div class="middle-section">
         <div class="container">
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
         
                  <div id="two">
                     <div class="tab-section">

                      @if(isset($arr_past_booking['data']) && sizeof($arr_past_booking['data'])>0)
                            <div class="row">
                               <div class="col-sm-7 col-md-6 col-lg-8">
                                  <div class="book-search">
                                     <input type="text" class="search-in" placeholder="Search Doctor Name (Select from previously seen)" />
                                     <span> <button class="pharna-search-btn"> Search</button></span>
                                  </div>
                               </div>
                               <div class="col-sm-2 col-md-2 col-lg-2">
                                  <div class="sort-txt text-right">Sort By</div>
                               </div>
                               <div class="col-sm-3 col-md-4 col-lg-2">
                                  <div class="select-style my-pati">
                                     <select class="frm-select">
                                        <option>By Date</option>
                                        <option>Lorem</option>
                                        <option>Lorem</option>
                                        <option>Lorem</option>
                                     </select>
                                  </div>
                               </div>
                            </div>
                        @endif
                     @if(isset($arr_past_booking['data']) && sizeof($arr_past_booking['data'])>0)

                        <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                              <tr class="table-head">
                                 <td>Time</td>
                                 <td>Doctor</td>
                                 <td>Consultation Details</td>
                                 <td>Cost</td>
                                 <td>Invoice</td>
                              </tr>
                      

                            @foreach($arr_past_booking['data'] as $booking)

                                    @if(isset($booking['consultation_time']) && $booking['consultation_time']!='')
                                        <?php $time = convert_24_to_12($booking['consultation_time']);  ?>
                                    @endif
                                   

                               <tr>
                                 <td style="padding-top: 20px ! important;"> {{ $time or '' }}</td>
                                 <td style="padding-top: 20px ! important;">
                                   
                                     Dr. {{ $booking['doctor_user_details']['first_name'] or '' }}
                                    {{ $booking['doctor_user_details']['last_name'] or '' }}

                                 </td>
                                  <td style="padding-top: 20px ! important;">
                                      <a href="#" class="see-green">
                                     Consultation Details</a>
                                  </td>
                                 <td style="padding-top: 20px ! important;">{{ $booking['refind_amount'] or '' }}</td>
                                 <td style="padding-top: 20px ! important;">
                                    <a href="#" class="ino-doen"> <i class="fa fa-cloud-download"></i>&nbsp; Download </a>
                                 </td>
                              </tr>

                            @endforeach
                     
                         
                
                           </table>
                        </div>

                      @else
                      
                          <div class="search-grey-bx">
                             <div class="row">
                                {{ 'Past bookings are not present.' }}
                              </div>
                          </div>

                      @endif

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


 <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
<script>
	     $(document).on('responsive-tabs.initialised', function(event, el) {
             console.log(el);
         });
         
         $(document).on('responsive-tabs.change', function(event, el, newPanel) {
             console.log(el);
             console.log(newPanel);
         });
         
         $('[data-responsive-tabs]').responsivetabs({
             initialised: function() {
                 console.log(this);
             },
         
             change: function(newPanel) {
                 console.log(newPanel);
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