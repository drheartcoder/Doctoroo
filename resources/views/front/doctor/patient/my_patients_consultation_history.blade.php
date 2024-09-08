@extends('front.doctor.layout.new_master') @section('main_content')
<style>
   .consultation-date::before {
   content: "Consultation Date :";
   }
   .consultation-id::before {
   content: "Time :";
   }
   .requested-doctor::before {
   content: "Requested Doctor :";
   }
   .consultation-status::before {
   content: "Status :";
   }
   .consultation-view-details::before {
   content: "Consultation Details :";
   }
   .disabled 
   {
      pointer-events: none;
      color: #e1e1e1 !important;
   }
</style>
<div class="header bookhead ">
   <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
</div>
<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')
<!--tab start-->
<div class="mar300  has-header minhtnor">
   <div class="consultation-tabs ">
      <ul class="tabs tabs-fixed-width">
         <li class="tab" id="tab_patient_history">
            <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
         </li>
         <li class="tab" id="tab_medical_history">
            <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
         </li>
         <li class="tab" id="tab_consultation_history">
            <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
         </li>
         <li class="tab" id="tab_tools">
            <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
         </li>
         <li class="tab" id="tab_chat">
            <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
         </li>
         <!-- <li class="tab" id="tab_consultation_guide">
            <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
         </li> -->
      </ul>
   </div>
   <div id="consultation-history" class="tab-content medi patient-list-block">
      
      <div class="patient-list-heading">
         <span class="patient-list-title">
         Patient's doctoroo consultation history
         </span>
      </div>
      <div class="z-depth-3 round-box">
         <div class="blue-border-block-top"></div>
         <div class="transactions-table table-responsive paitent-list-table patient-consultation-history">

            <!--new Consultation list starts here-->
            <div class="new-request-head">
               New consultation requests
            </div>
            <!--div format starts here-->
            <div class="table ">
               <div class="table-row heading hidden-xs">
                  <div class="table-cell">Consultation Date</div>
                  <div class="table-cell">Time</div>
                  {{-- <div class="table-cell">Requested Doctor</div> --}}
                  <div class="table-cell">Status</div>
                  <div class="table-cell center-align">Consultation Details</div>
               </div>               
               @if(isset($new_booking) && !empty($new_booking)) 
               @php $counter = 1; @endphp
               @foreach($new_booking as $val) 
               @if($counter <= $show_records) 
               <div class="table-row content-row-table">
                  
                  <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $val["consultation_datetime"]); ?>

                  <div class="table-cell consultation-date">
                     {{isset($consult_datetime) ? date('D, F d, Y', strtotime($consult_datetime)) : '-'}}
                  </div>
                  <div class="table-cell consultation-id">{{isset($consult_datetime) ? date('h:i A', strtotime($consult_datetime)) : ''}}</div>
                  {{-- <div class="table-cell requested-doctor">Dr. {{isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : ''}} {{isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : ''}} </div> --}}
                  <div class="table-cell consultation-status">{{isset($val['booking_status']) ? $val['booking_status'] : ''}}</div>
                     @if(isset($current_doctor_id) && $current_doctor_id == $val['doctor_user_id'])
                        <div class="table-cell consultation-view-details view-details-btn">
                           <a href="{{$module_url_path}}/patients/new_consultation_details/{{$enc_patient_id}}/{{isset($val['id']) ? base64_encode($val['id']) : ''}}">View details</a>
                        </div>
                      @else 
                        <div class="table-cell consultation-view-details view-details-btn">
                           <a href="javascript:void(0)" style="cursor: auto;" class="disabled">View details</a>
                        </div>
                     @endif
               </div>
               @endif
               @php $counter += 1; @endphp 
               @endforeach 
               @if(sizeof($new_booking) > $show_records)
               <div class="table-row content-row-table">
                  <div class="table-cell"></div>
                  <div class="table-cell"></div>
                  <div class="table-cell"></div>
                  <div class="table-cell"></div>
                  <div class="table-cell center-align">
                     <a href="{{$module_url_path}}/patients/consultation_history/new/{{$enc_patient_id}}" class="btn">Show All</a>
                  </div>
               </div>
               @endif @else
               <div class="table-row content-row-table">
                  <div class="table-cell">
                     <p class="grey-text left-align">No Consultations</p>
                  </div>
               </div>
               @endif
            </div>
            <!--new Consultation list ends here-->

            <!--Upcoming Consultation list starts here-->
            <div class="new-request-head">
               Upcoming Consultation
            </div>
            <div class="table ">
               <div class="table-row heading hidden-xs">
                  <div class="table-cell">Consultation Date</div>
                  <div class="table-cell">Time</div>
                  {{-- <div class="table-cell">Requested Doctor</div> --}}
                  <div class="table-cell">Status</div>
                  <div class="table-cell center-align">Consultation Details</div>
               </div>
               @if(isset($upcoming_consultation_arr) && !empty($upcoming_consultation_arr)) @php $counter = 1; @endphp @foreach($upcoming_consultation_arr as $val) 
               @if($counter <= $show_records) 
               <div class="table-row content-row-table">
                  
                  <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $val["consultation_datetime"]); ?>

                  <div class="table-cell transaction-id">
                     {{isset($consult_datetime) ? date('D, F d, Y', strtotime($consult_datetime)) : '-'}}
                  </div>
                  <div class="table-cell transaction-date">{{isset($consult_datetime) ? date('h:i A', strtotime($consult_datetime)) : ''}}</div>
                  {{-- <div class="table-cell transaction-price">Dr. {{isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : ''}} {{isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : ''}} </div> --}}
                  <div class="table-cell transaction-desciption"><span class="description">{{isset($val['booking_status']) ? $val['booking_status'] : ''}}</span></div> 
                  @if(isset($current_doctor_id) && $current_doctor_id == $val['doctor_user_id'])
                     <div class="table-cell transaction-status view-details-btn">
                        <a href="{{$module_url_path}}/patients/upcoming_consultation_details/{{$enc_patient_id}}/{{isset($val['id']) ? base64_encode($val['id']) : ''}}">View details</a>
                     </div>
                  @else 
                        <div class="table-cell consultation-view-details view-details-btn">
                           <a href="javascript:void(0)" style="cursor: auto;" class="disabled">View details</a>
                        </div>
                  @endif
               </div>
               @endif @php $counter += 1; @endphp @endforeach @if(sizeof($upcoming_consultation_arr) > $show_records)
                  <div class="table-row content-row-table">
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell center-align">
                        <a href="{{$module_url_path}}/patients/consultation_history/upcoming/{{$enc_patient_id}}" class="btn">Show All</a> 
                     </div>
                  </div>
               @endif @else
               <div class="table-row content-row-table">
                  <div class="table-cell">
                     <span class="grey-text left">No Consultations </span>
                  </div>
               </div>
               @endif
            </div>
            <!--Upcoming Consultation list ends here-->

            <!--Past Consultation list starts here-->
            <div class="new-request-head">
               Past Consultation
            </div>
            <div class="table ">
               <div class="table-row heading hidden-xs">
                  <div class="table-cell">Consultation Date</div>
                  <div class="table-cell">Time</div>
                  {{-- <div class="table-cell">Requested Doctor</div> --}}
                  <div class="table-cell">Status</div>
                  <div class="table-cell center-align">Consultation Details</div>
               </div>
               @if(isset($past_consultation_arr) && !empty($past_consultation_arr)) 
               @php $counter = 1; @endphp 
               @foreach($past_consultation_arr as $val) 
               @if($counter <= $show_records) 
               <div class="table-row content-row-table">
                  
                  <?php $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $val["consultation_datetime"]); ?>

                  <div class="table-cell transaction-id">
                     {{isset($consult_datetime) ? date('D, F d, Y', strtotime($consult_datetime)) : '-'}}
                  </div>
                  <div class="table-cell transaction-date">{{isset($consult_datetime) ? date('h:i A', strtotime($consult_datetime)) : ''}}
                  </div>
                  {{-- <div class="table-cell transaction-price">Dr. {{isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : ''}} {{isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : ''}}
                  </div> --}}
                  <div class="table-cell transaction-desciption"><span class="description">{{isset($val['booking_status']) ? $val['booking_status'] : ''}}</span>
                  </div>
                  @if(isset($current_doctor_id) && $current_doctor_id == $val['doctor_user_id'])
                     <div class="table-cell transaction-status view-details-btn"><a href="{{$module_url_path}}/patients/past_consultation_details/{{$enc_patient_id}}/{{isset($val['id']) ? base64_encode($val['id']) : ''}}">View details</a>
                     </div>
                  @else 
                     <div class="table-cell consultation-view-details view-details-btn">
                        <a href="javascript:void(0)" style="cursor: auto;" class="disabled">View details</a>
                     </div>
                  @endif
               </div>
               @endif
               @php $counter += 1; 
               @endphp
               @endforeach @if(sizeof($past_consultation_arr) > $show_records)
                  <div class="table-row content-row-table">
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell"></div>
                     <div class="table-cell center-align">
                        <a href="{{$module_url_path}}/patients/consultation_history/past/{{$enc_patient_id}}" class="btn">Show All</a> 
                     </div>
                  </div>
               @endif 
               @else
               <div class="table-row content-row-table">
                  <div class="table-cell">
                     <span class="grey-text left">No Consultations </span>
                  </div>
               </div>
               @endif
            </div>
            <!--Past Consultation list ends here-->
            
         </div>
         <div class="blue-border-block-bottom"></div>
      </div>
   </div>
</div>
<input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
<script>
   $(document).ready(function () {
       $enc_patient_id = $("#enc_patient_id").val();
   
       $('#tab_patient_history').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/details/" + $enc_patient_id;
       });
       $('#tab_medical_history').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/medical_history/" + $enc_patient_id;
       });
       $('#tab_consultation_history').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/consultation_history/" + $enc_patient_id;
       });
       $('#tab_tools').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
       });
       $('#tab_chat').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/chats/" + $enc_patient_id;
       });
       $('#tab_consultation_guide').click(function () {
           window.location = "{{ url('/') }}/doctor/patients/consultation_guide/" + $enc_patient_id;
       });
   });
</script>
@endsection