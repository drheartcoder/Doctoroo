@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<div class="middle-section">
         <div class="container">
            <div style="background:#fff" class="back-whhit-bx patient-white-bx">
                 <br>

                 @if(isset($arr_notification) && sizeof($arr_notification)>0)
 
                         <div class="med-his-txt">
                            Your consultation has been scheduled by,
                         </div>
                         <div class="med-his-txt">
                             <span>
                                {{ $arr_notification['user_details']['title']      or '--' }} 
                                {{ $arr_notification['user_details']['first_name'] or '--' }}
                                {{ $arr_notification['user_details']['last_name']  or '--' }}
                             </span>
                                 will call you at <span> on {{ $arr_notification['booking_details']['reschedule_date_time'] or '--' }}.</span>
                         </div>
                         <div class="med-his-txt">
                             You'll be reminded 5 minutes before the consultation via a notification on your doctoroo app.
                         </div>
                         <div class="certi-btn"> 
                            <button class="details-btn pad-rgt" onclick="GoToBackPage()">Back</button>
                         </div>
             
                 @endif
                 <br>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <script>
          function GoToBackPage()
          {
            window.location.href = '{{ $module_url_path }}';
          }
      </script>
@stop