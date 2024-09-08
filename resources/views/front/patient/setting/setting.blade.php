@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<div class="header z-depth-2 bookhead">
   <div class="backarrow "><a href="{{url('patient/dashboard')}}" class="center-align"><i class="material-icons">close</i></a></div>
   <h1 class="main-title center-align truncate">Settings</h1>
</div>

   <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer medicationmain">
        <div class="container book-doct-wraper">

<!-- <div class="container posrel has-header has-footer medicationmain"> -->
   <h3 class="sethead">Account</h3>
   <ul class="setmenu">
      <li> <a href="{{url('patient/setting/personal_details')}}" class="valign-wrapper"><span class="personalDet"></span> Personal Details</a></li>
      <li> <a href="{{url('patient/setting/family_members')}}" class="valign-wrapper"><span class="familyMem"></span> Family Members </a></li>
      <li> <a href="{{url('patient/setting/family_doctors')}}" class="valign-wrapper"><span class="familydoc"></span> My Family Doctor</a></li>
      <li> <a href="{{url('patient/setting/')}}/my_pharmacy" class="valign-wrapper"><span class="pharmacypref"></span>  My Pharamacy &amp; Preferences </a></li>
      <li> <a href="{{url('patient/setting/email_and_password')}}" class="valign-wrapper"><span class="emailpass"></span>  Email &amp; Password </a></li>
      <!-- <li> <a href="{{ url('/') }}/patient/setting/notification_settings" class="valign-wrapper"><span class="notifications"></span>  Notification Setting</a>
      </li> -->
   </ul>
   <ul class="setmenu">
      <li> <a href="{{url('patient/setting/camera_and_internet_test')}}" class="valign-wrapper"><span class="videocall"></span>  Camera & Internet Pre-call Test </a></li>
   </ul>
   <h3 class="sethead">Billing &amp; Payments</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/patient/setting/card/list" class="valign-wrapper"><span class="payment"></span> Payment Methods</a></li>
      <li> <a href="{{ url('/') }}/patient/setting/invoice" class="valign-wrapper"><span class="invoices"></span> Invoices &amp; Codes</a></li>
      <li> <a href="{{ url('/') }}/patient/setting/disputes" class="valign-wrapper"><span class="disputes"></span> Disputes</a></li>
   </ul>
   <h3 class="sethead">Invitations</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/patient/setting/invitation" class="valign-wrapper"><span class="invitations"></span> Invite patient/dr/pharmacy</a></li>
      <li> <a href="{{ url('/') }}/patient/setting/invitation" class="valign-wrapper"><span class="invitations"></span> Invitation credit &amp; codes</a></li>
   </ul>
   <h3 class="sethead">Help &amp; Support</h3>
   <ul class="setmenu">
      <li> <a href="{{ url('/') }}/patient/setting/faq" class="valign-wrapper"><span class="faq"></span>Support &amp; FAQ’s</a></li>
      <li> <a href="{{ url('/') }}/patient/setting/feedback" class="valign-wrapper"><span class="feedback"></span> Feedback &amp; Rate Doctoroo</a></li>
      <li> <a href="{{ url('/') }}/patient/setting/legal" class="valign-wrapper"><span class="legal"></span> Legal</a></li>
   </ul>
   <a class="waves-effect waves-light futbtn" href="#logout">Log Out</a>
   <div class="clr"></div>

   </div>
</div>
<!--Container End-->
@endsection