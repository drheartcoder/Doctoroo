@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<div class="middle-section">
         <div class="container">
            <div style="background:#fff" class="back-whhit-bx patient-white-bx">
                 <br>
              
                     <div class="med-his-txt">
                        Your consultation has been booked.
                     </div>
                     <div class="med-his-txt">
                        Dr. John Smith will call you at <span> 10:15AM on Tuesday 12th August.</span>
                     </div>
                     <div class="med-his-txt">
                        You'll be reminded 5 minutes before the consultation via a notification on your doctoroo app.
                     </div>
                     <div class="certi-btn">
                        <button class="details-btn pad-rgt"><span><i class="fa fa-bell"></i></span> Add Reminder</button>
                        <button class="details-btn pad-rgt">Reschedule Booking</button>
                        <button class="details-btn pad-rgt">Cancel Booking</button>
                     </div>
              
                 <br>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
@stop