
<?php
$admin_path     = config('app.project.admin_panel_slug');
?>
<div id="sidebar" class="navbar-collapse collapse">
   <!-- BEGIN Navlist -->
   <ul class="nav nav-list">
      <li class="<?php  if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>">
         <a href="{{ url('/').'/'.$admin_path.'/dashboard'}}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
         </a>
      </li>
      <li class="<?php  if(Request::segment(2) == 'account_settings' || Request::segment(2) == 'socialsettings' || Request::segment(2) == 'siteSettings' ){ echo 'active'; } ?>">
         <a href="javascript:void(0)" class="dropdown-toggle">
            <i class="fa fa-wrench"></i>
            <span>Settings</span>
            <b class="arrow fa fa-angle-right"></b>
         </a>
         <ul class="submenu">
            <li style="display: block;"><a href="{{ url($admin_path.'/account_settings')}}">Profile</a></li>
            <li style="display: block;"><a href="{{ url($admin_path.'/socialsettings')}}">Social Settings</a></li>
            <!-- <li style="display: block;"><a href="{{ url($admin_panel_slug.'/siteSettings')}}">Site Settings</a></li> -->
         </ul>
      </li>
      <li class="<?php  if(Request::segment(3) == 'verifieddoctor' ||Request::segment(3) == 'applications' || Request::segment(2) == 'patient' || Request::segment(2) == 'pharmacy'){ echo 'active'; } ?>">
         <a href="javascript:void(0)" class="dropdown-toggle">
            <i class="fa fa-user"></i>
            <span>User</span>
            <b class="arrow fa fa-angle-right"></b>
         </a>
         <ul class="submenu">
            <li style="display: block;">
               <a  href="javascript:void(0)" class="dropdown-toggle">Doctor</a>
               <ul class="submenu">
                  <li style="display: block;"><a href="{{ url($admin_path.'/doctor/verifieddoctor')}}">Verified Doctor</a></li>
                  <li style="display: block;"><a href="{{ url($admin_path.'/doctor/applications')}}">Doctor Applications</a></li>
               </ul>
            </li>
            <li style="display: block;"><a href="{{ url($admin_path.'/patient')}}">Patient</a></li>
            <li style="display: block;" class="<?php  if(Request::segment(2) == 'pharmacy'){ echo 'active'; } ?>">
               <a  href="javascript:void(0)" class="dropdown-toggle">Pharmacy</a>
               <ul class="submenu">
                  <li style="display: block;" class="<?php if(Request::segment(2) == 'pharmacy' && Request::segment(3) == 'verifiedpharmacies'){ echo 'active'; } ?>"><a href="{{ url($admin_path.'/pharmacy/verifiedpharmacies')}}">Verified Pharmacies </a></li>
                  <li style="display: block;" class="<?php  if(Request::segment(2) == 'pharmacy' && Request::segment(3) == 'applications'){ echo 'active'; } ?>"><a href="{{ url($admin_path.'/pharmacy/applications')}}"> Pharmacy Applications</a></li>
               </ul>
            </li>
         </ul>
      </li>

     <li class="<?php  if(Request::segment(2) == 'static_pages' || Request::segment(2) == 'pricingplan'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa  fa-sitemap"></i>
         <span>Front Pages</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/static_pages')}}">Manage </a></li>
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/pricingplan')}}">Pricing Plan </a></li>
      </ul>
   </li>
   <li class="<?php  if(Request::segment(2) == 'dynamic_pages' || Request::segment(2) == 'pages_section'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa  fa-sitemap"></i>
         <span>Dynamic Pages</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/dynamic_pages')}}">Manage </a></li>
      </ul>
   </li>
   <li class="<?php  if(Request::segment(2) == 'blog' ){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa  fa-sitemap"></i>
         <span>Blog</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/blog')}}">Manage </a></li>
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/blog/category')}}">Category </a></li>
      </ul>
   </li>

   <li class="<?php  if(Request::segment(2) == 'consultation' || Request::segment(2) == 'managefees' || Request::segment(2) == 'consultationprice' || Request::segment(2) == 'doctor_consultation_prices' || Request::segment(3) == 'time_interval' || Request::segment(2) == 'speciality' || Request::segment(2) == 'languages' ){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-users"></i>
         <span>Consultations</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_path.'/consultation')}}">Manage</a></li>
         <li style="display: block;">
               <a  href="javascript:void(0)" class="dropdown-toggle">Doctor</a>
               <ul class="submenu">
                  <li style="display: block;"><a href="{{ url($admin_panel_slug.'/managefees')}}">Manage Fees</a></li>
                  <!-- <li style="display: block;"><a href="{{ url($admin_panel_slug.'/consultationprice')}}">Consultation Price</a></li>
                  <li style="display: block;"><a href="{{ url($admin_panel_slug.'/doctor_consultation_prices')}}">Consultation Earnings</a></li> -->
                  <li style="display: block;"><a href="{{ url($admin_panel_slug.'/doctor/time_interval')}}">Time Interval</a></li>
                  <li style="display: block;"><a href="{{ url($admin_panel_slug.'/speciality')}}">Speciality</a></li>
                  <li style="display: block;"><a href="{{ url($admin_panel_slug.'/languages')}}">Language Spoken</a></li>
               </ul>
         </li>
      </ul>
   </li>

   <!-- Payment Section  -->
   <li class="<?php if(Request::segment(2) == 'payment' || Request::segment(2) == 'dispute' || Request::segment(2) == 'stripe' ){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-list"></i>
         <span>Payments</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         
         <li style="display: block;">
               <a  href="javascript:void(0)" class="dropdown-toggle">Consultation</a>
               <ul class="submenu">
                  <!-- <li style="display: block;"><a href="{{ url($admin_panel_slug.'/invoices')}}">Invoices</a></li> -->
                  <li class="<?php if(Request::segment(2) == 'dispute' ){ echo 'active'; } ?>" style="display: block;"><a href="{{ url($admin_panel_slug.'/dispute')}}">Dispute</a></li>
               </ul>
         </li>
         <li style="display: block;">
               <a  href="javascript:void(0)" class="dropdown-toggle">Stripe</a>
               <ul class="submenu">
                  <li class="<?php if(Request::segment(3) == 'connected_accounts' ){ echo 'active'; } ?>" style="display: block;"><a href="{{ url($admin_panel_slug.'/stripe/connected_accounts')}}">Connected Accounts</a></li>
               </ul>
         </li>
      </ul>
   </li>

   <li class="<?php  if(Request::segment(2) == 'membership'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-envelope"></i>
         <span>Membership</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;" class="<?php if(Request::segment(2) == 'membership' && Request::segment(3) == ''){ echo 'active'; } ?>"><a href="{{ url($admin_path.'/membership')}}">Manage</a> </li>
         <li style="display: block;" class="<?php if(Request::segment(2) == 'membership' && Request::segment(3) == 'plan_price'){ echo 'active'; } ?>"><a href="{{ url($admin_path.'/membership/plan_price')}}">Plans & Prices</a> </li>
         <li style="display: block;" class="<?php if(Request::segment(2) == 'membership' && Request::segment(3) == 'discount_code'){ echo 'active'; } ?>"><a href="{{ url($admin_path.'/membership/discount_code/list')}}">Discount Code</a> </li>
      </ul>
   </li>

   <li class="<?php  if(Request::segment(2) == 'invitation'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-users"></i>
         <span>Invitations</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_path.'/invitation/patient')}}">Patient</a></li>
         <li style="display: block;"><a href="{{ url($admin_path.'/invitation/doctor')}}">Doctor</a></li>
         <li style="display: block;"><a href="{{ url($admin_path.'/invitation/pharmacy')}}">Pharmacy</a></li>
      </ul>
   </li>

   <li class="<?php  if(Request::segment(2) == 'mobile_number_change_request'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-phone-square" aria-hidden="true"></i>
         <span>Change Request's </span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_path.'/mobile_number_change_request/patient')}}">Patient</a></li>
         <li style="display: block;"><a href="{{ url($admin_path.'/mobile_number_change_request/doctor')}}">Doctor</a></li>
      </ul>
   </li>

   <li class="<?php  if(Request::segment(2) == 'email_template'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-envelope" ></i>
         <span>Email Template</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/email_template')}}">Manage</a> </li>
      </ul>
   </li>
   <li class="<?php  if(Request::segment(2) == 'howitworks'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-puzzle-piece"></i>
         <span>How It Work Section</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url('/admin/howitworks')}}">Manage </a></li>
      </ul>
   </li>
   <li class="<?php if(Request::segment(2) == 'faqs'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-question""></i>
         <span>FAQ's</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/faqs')}}">Manage </a></li>
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/faqs/category')}}">Category </a></li>
      </ul>
   </li>

   <li class="<?php if(Request::segment(2) == 'membership_faqs'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-question-circle"></i>
         <span>Membership FAQ's</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/membership_faqs')}}">Manage </a></li>
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/membership_faqs/category')}}">Category </a></li>
      </ul>
   </li>

   <li class="<?php if(Request::segment(2) == 'feedback'){ echo 'active'; } ?>">
      <a href="javascript:void(0)" class="dropdown-toggle">
         <i class="fa fa-question-circle"></i>
         <span>Feedback</span>
         <b class="arrow fa fa-angle-right"></b>
      </a>
      <ul class="submenu">
         <li style="display: block;"><a href="{{ url($admin_panel_slug.'/feedback')}}">Manage </a></li>
      </ul>
   </li>
   <!-- END Navlist -->
   <!-- BEGIN Sidebar Collapse Button -->
   <div id="sidebar-collapse" class="visible-lg">
      <i class="fa fa-angle-double-left"></i>
   </div>
   <!-- END Sidebar Collapse Button -->
</div>

