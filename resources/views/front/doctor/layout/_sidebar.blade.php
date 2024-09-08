<script type='text/javascript' src='{{ url('/') }}/public/js/left-menu-jquery.js'></script> 
<div class="col-sm-12 col-md-3 col-lg-2 left-green-box">
   <div class="clearfix"></div>
   <div class="left-section-member">
      <!--<div class="video-img-bx">
         <div class="video-smll"><img src="images/video-small.png" alt="img"/></div>
         <img src="images/video-big.png" alt="img"/>
         <div class="video-ics">
         <a href="#" ><img src="images/video-icon1.png" alt="icon"/></a>
         </div>
         
         </div>-->
      <?php
         $arr_doctor_data = [];
         $arr_doctor_data=get_doctor_profile_data();

      ?>
      <div class="member-profile">
         <div class="rounded-box">
            @if(isset($arr_doctor_data) && sizeof($arr_doctor_data)>0) 
               @if(isset($arr_doctor_data['profile_image']) && $arr_doctor_data['profile_image']!='' && file_exists($arr_doctor_data['doctor_base_img_path'].$arr_doctor_data['profile_image']))
                  <img src="{{ $arr_doctor_data['doctor_public_img_path'].$arr_doctor_data['profile_image'] }}" alt="pro img"/>
               @else
                  <img src="{{$arr_doctor_data['doctor_public_img_path'].'default-image.jpeg'}}" alt="pro img"/>
               @endif
            @else
                <img src="{{ url('/')}}/public/uploads/front/doctor/default-image.jpeg" alt="pro img"/>
            @endif 
         </div>
         <div class="clearfix"></div>
         <div class="profile-name">
            @if(isset($arr_doctor_data['first_name']) && isset($arr_doctor_data['last_name']))
               <h5>{{ $arr_doctor_data['title'] or '' }} {{ $arr_doctor_data['first_name'] }} {{ $arr_doctor_data['last_name'] }}</h5>
            @else
               {{ '' }}
            @endif
         </div>
      </div>
      <div class="box header">
         <div class="angle visible-xs visible-sm hidden-lg">
            <a class="top"> <span class="das-board-icon"> <i class="fa fa-tachometer"></i></span> Dashboard Menu <span><i class="fa fa-bars"></i></span>   </a>
         </div>

         <div id='cssmenu' class="hide-show bottom">
            <ul>
                 <li class='has-sub @if(Request::Segment(3)=='dashboard') active  @endif'>
                  <a href='{{ url('/') }}/doctor/profile/dashboard' >
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-pro.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-pro-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Dashboard</div>
                  </a>
               </li>
               <li class='has-sub @if(Request::Segment(3)=='step1') active  @endif'>
                  <a href='{{ url('/') }}/doctor/profile/step1' >
                      <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-acc.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-acc-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">My Account</div>
                  </a>
               </li>

                <li class='has-sub @if(Request::Segment(3)=='change_password') active  @endif'>
                  <a href='{{ url('/') }}/doctor/profile/change_password' >
                      <div class="side-icon">
                        <img src="{{url('/')}}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Change Password</div>
                  </a>
               </li>

               <li class='has-sub @if(Request::Segment(2)=='preference') active  @endif'>
                  <a href='{{ url('/') }}/doctor/preference' >
                      <div class="side-icon">
                        <img src="{{url('/')}}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Preferences</div>
                  </a>
               </li>

               <li class='has-sub @if(Request::Segment(2)=='invitation') active  @endif'>
                  <a href='{{ url('/') }}/doctor/invitation' >
                      <div class="side-icon">
                        <img src="{{url('/')}}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Referral</div>
                  </a>
               </li>

               <li class='has-sub @if(Request::Segment(2)=='delete') active  @endif'>
                  <a href='{{ url('/') }}/doctor/delete' >
                      <div class="side-icon">
                        <img src="{{url('/')}}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Delete Account</div>
                  </a>
               </li>



               <li class='has-sub @if(Request::Segment(2)=='appointment') active  @endif'>
                  <a href='{{ url('/') }}/doctor/appointment'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-cal.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-cal-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Calender &amp; Appoinments</div>
                  </a>
               </li>


               <li class='has-sub sub'>
                  <a href='#'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-pre.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-pre-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Patients</div>
                  </a>
                  <ul class="submenu">
                     <li class="has-sub">
                        <a href='{{url('/')}}/doctor/patients/mypatient'>
                           <div>- My Patients</div>
                        </a>
                     </li>
                     <li class='has-sub  @if(Request::Segment(3)=='patients') act  @endif'>
                        <a href='{{url('/')}}/doctor/patients'>
                           <div>- Doctoroo Patient</div>
                        </a>
                     </li>
                  </ul>
               </li>


                <li class='has-sub  @if(Request::Segment(2)=='answer-a-question') active  @endif'>
                  <a href="{{url('/')}}/doctor/answer-a-question" >
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-ques.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-ques-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Answer a Question</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>

                <li class='has-sub @if(Request::Segment(2)=='consultation') active  @endif'>
                  <a href='{{ url('/') }}/doctor/consultation'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-req.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-req-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Patient Consultation</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
               
               <li class='has-sub  @if(Request::Segment(2)=='history') active  @endif'>
                  <a href='{{ url('/') }}/doctor/history'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-his.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-his-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">History</div>
                  </a>
               </li>
              
               <li class='has-sub'>
                  <a href='{{ url('/') }}/doctor/chat'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-msg.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-msg-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Messages</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
              
               <li class='has-sub sub'>
                  <a href='#'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-pre.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-pre-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Prescriptions</div>
                  </a>
                  <ul class="submenu">
                     <li class="has-sub act">
                        <a href=''>
                           <div>- New Prescription</div>
                        </a>
                     </li>
                     <li class='has-sub'>
                        <a href=''>
                           <div>- Past Prescription</div>
                        </a>
                     </li>
                  </ul>
               </li>

               <li class='has-sub'>
                  <a href='#'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-tool.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-tool-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">My Tools</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='#'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-pharma.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-pharma-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Pharmacies</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href=''>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-noti.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-noti-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Notifications</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href=''>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-bill.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-bill-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Billing &amp; Payments</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='#'>
                     <div class="side-icon">
                        <img src="{{url('/')}}/public/images/dash-disputes.png" class="img-new" alt="img"/>
                        <img src="{{url('/')}}/public/images/dash-disputes-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Disputes</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
             
            </ul>
         </div>
      </div>
   </div>
</div>
<script>
   $('.top').on('click', function() {
       $parent_box = $(this).closest('.box');
       $parent_box.siblings().find('.bottom').slideUp();
       $parent_box.find('.bottom').slideToggle(1000, 'swing');
   });
</script>