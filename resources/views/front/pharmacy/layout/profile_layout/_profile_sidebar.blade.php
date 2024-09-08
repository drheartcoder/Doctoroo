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
       $user          = Sentinel::check();
       $arr_pharmacy  = get_pharmacy_profile_data();

      ?>
       <div class="member-profile">
         <div class="rounded-box"> 
            
            @if(isset($arr_pharmacy) && sizeof($arr_pharmacy)>0)

                @if(isset($arr_pharmacy['logo']) && $arr_pharmacy['logo']!='' && file_exists($arr_pharmacy['pharmacy_base_img_path'].'/'.$arr_pharmacy['logo'])) 
                     <img src="{{ $arr_pharmacy['pharmacy_public_img_path'].'/'.$arr_pharmacy['logo'] }}" alt="pro img"/>
               @else
                     <img src="{{ $arr_pharmacy['pharmacy_public_img_path'] }}/default-image.jpeg"  alt="pro img"/>
               @endif
            @else
                <img src="{{ url('/') }}/public/uploads/front/pharmacy/default-image.jpeg" class="img-circle" alt="pro img"/>
            @endif

         </div>
         <div class="clearfix"></div>
         <div class="profile-name">
            <h5> {{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}</h5>
         </div>
      </div>
      <div class="box header">
         <div class="angle visible-xs visible-sm hidden-lg">
            <a class="top"> <span class="das-board-icon"> <i class="fa fa-tachometer"></i></span> Dashboard Menu <span><i class="fa fa-bars"></i></span>   </a>
         </div>
         <div id='cssmenu' class="hide-show bottom">
            <ul>
               <li class='has-sub @if(Request::segment(2)=='dashboard') active  @endif'>
                  <a href='{{ $module_url_path }}/dashboard'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-pro.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-pro-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Dashboard</div>
                  </a>
               </li>
               <li class='has-sub @if(Request::segment(2)=='profile_step1' || Request::segment(2)=='profile_step2' || Request::segment(2)=='profile_step3') active  @endif'>
                  <a href='{{ $module_url_path }}/profile_step1'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-acc.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-acc-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">My Account</div>
                  </a>
               </li>

               <li class='has-sub @if(Request::segment(2)=='change_password') active  @endif'>
                  <a href='{{ $module_url_path }}/change_password'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Change Password</div>
                  </a>
               </li>
               <li class='has-sub @if(Request::segment(2)=='preference') active  @endif'>
                  <a href='{{ $module_url_path }}/preference'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Preference</div>
                  </a>
               </li>

                <li class='has-sub @if(Request::segment(2)=='invitation') active  @endif'>
                  <a href='{{ $module_url_path }}/invitation'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Referral</div>
                  </a>
               </li>

                <li class='has-sub @if(Request::segment(2)=='delete') active  @endif'>
                  <a href='{{ $module_url_path }}/delete'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/change-pass.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/change-pass-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Delete Account</div>
                  </a>
               </li>


               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-cal.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-cal-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Calender &amp; Appoinments</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-his.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-his-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">History</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-patients.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-patients-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">My Patients</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-msg.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-msg-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Messages</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-req.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-req-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Requests</div>
                     <div class="count"> (0)</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-ques.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-ques-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Answer a Question</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
               <li class='has-sub'>
                  <!--sub-->
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-pre.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-pre-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Prescriptions</div>
                  </a>
                  <!--<ul class="submenu">
                     <li class="has-sub act"><a href='#'><div>- New Prescription</div></a></li>
                     <li class='has-sub'><a href='#'><div>- Past Prescription</div></a></li>
                     </ul>-->
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-tool.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-tool-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">My Tools</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-pharma.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-pharma-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Pharmacies</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-noti.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-noti-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Notifications</div>
                     <div class="count"> (0) </div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-bill.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-bill-hover.png" class="ove-img" alt="img"/>
                     </div>
                     <div class="side-text">Billing &amp; Payments</div>
                  </a>
               </li>
               <li class='has-sub'>
                  <a href='javascript:void(0);'>
                     <div class="side-icon">
                        <img src="{{ url('/') }}/public/images/dash-disputes.png" class="img-new" alt="img"/>
                        <img src="{{ url('/') }}/public/images/dash-disputes-hover.png" class="ove-img" alt="img"/>
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