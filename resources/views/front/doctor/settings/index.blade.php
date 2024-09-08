@extends('front.doctor.layout.new_master')
@section('main_content')

<style>
   .my-profile-sub-menu{margin-left: 66px;}
   .my-profile-sub-menu li{padding: 7px 0;}
</style>

<div class="header bookhead z-depth-2">
   <div class="backarrow "><a href="{{ url('/') }}/doctor/profile/dashboard" class="center-align"><i class="material-icons">close</i></a></div>
   <h1 class="main-title center-align truncate">Settings</h1>
</div>

<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')

<div class="mar300 has-header minhtnor">
<div class="container pdmintb pdtbrl">
   
   <h3 class="sethead">Account</h3>
   <ul class="setmenu">
      <li> <a href="javascript:void(0);" class="valign-wrapper"><span class="personalDet"></span> My Profile</a>
        <ul class="my-profile-sub-menu">
          <li><a href="{{url('/')}}/doctor/my_profile/about_yourself">- About Yourself</a></li>
          <li><a href="{{url('/')}}/doctor/my_profile/your_medical_practice">- Your Medical Practice</a></li>
          <li><a href="{{url('/')}}/doctor/my_profile/your_medical_qualifications">- Your Medical Qualifications</a></li>
          <li><a href="{{url('/')}}/doctor/my_profile/official_documents_verification">- Documents & Verification</a></li>
          <li><a href="{{url('/')}}/doctor/my_profile/personalise_your_profile_for_patients">- Personalise your profile</a></li>
        </ul>
      </li>

      <li> <a href="{{ url('/') }}/doctor/settings/email_and_password" class="valign-wrapper"><span class="emailpass"></span>  Email &amp; Password </a></li>
      <!-- <li> <a href="{{ url('/') }}/doctor/settings/notification" class="valign-wrapper"><span class="notifications"></span>  Notification Settings</a></li> -->
   </ul>

   <ul class="setmenu">
      <li> <a href="{{url('doctor/settings/camera_and_internet_test')}}" class="valign-wrapper"><span class="videocall"></span>  Camera & Internet Pre-call Test </a></li>
   </ul>

   <h3 class="sethead">Membership</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/doctor/membership/payment" class="valign-wrapper"><span class="personalDet"></span> Select Membership</a></li>
      <li> <a href="{{ url('/') }}/doctor/membership/billing" class="valign-wrapper"><span class="emailpass"></span> Membership Invoices </a></li>
      <li> <a href="{{ url('/') }}/doctor/settings/card/list" class="valign-wrapper"><span class="notifications"></span> Payment Methods</a></li>
      <li> <a href="{{ url('/') }}/doctor/membership/premium" class="valign-wrapper"><span class="personalDet"></span> Fee Schedule</a></li>
   </ul>

   <h3 class="sethead">Billing &amp; Payments</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/doctor/billing" class="valign-wrapper"><span class="payment"></span> Consultation Invoices</a></li>
      <li> <a href="{{ url('/') }}/doctor/billing/bank_account" class="valign-wrapper"><span class="invoices"></span> Bank Account Details</a></li>
      <li> <a href="{{ url('/') }}/doctor/billing/my_discount" class="valign-wrapper"><span class="invoices"></span> My Discount Codes</a></li>
   </ul>
   <h3 class="dispue-w"><a href="{{ url('/') }}/doctor/settings/disputes" class="valign-wrapper sethead"><span class="disputes"></span>Disputes</a></h3>
   <h3 class="dispue-w"><a href="{{ url('/') }}/doctor/settings/invitation" class="valign-wrapper sethead"><span class="invitations"></span>Invitations</a></h3>
   <h3 class="sethead">Help &amp; Support</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/doctor/settings/faq" class="valign-wrapper"><span class="faq"></span>Support &amp; FAQ’s</a></li>
      <li> <a href="{{ url('/') }}/doctor/settings/feedback" class="valign-wrapper"><span class="feedback"></span> Feedback &amp; Rate Doctoroo</a></li>
      <li> <a href="{{ url('/') }}/doctor/settings/legal" class="valign-wrapper"><span class="legal"></span> Legal</a></li>
   </ul>
   
   <a class="waves-effect waves-light futbtn space-btn-bottom" href="#logout">Log Out</a>
   <div class="clr"></div>
</div>
</div>
<!--Container End-->
@endsection