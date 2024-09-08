@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

  <div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">About Doctoroo</h1>
    </div>
    <div class="container posrel has-header has-footer minhtnor pdtbrl">
        <div class="center-align"><img src="{{url('/')}}/public/new/images/doctoroo-legal-logo.png" />
            <p class="grey-text">Version 2.10.033</p>
            <p class="grey-text">Build 2551</p>
            <p class="grey-text">DOCTOROO AUSTRALIA PTY. LTD</p>
            <p class="grey-text">ACN 985212152</p>
        </div>
        <div class="divider"></div>
        <p><a href="{{url('/patient')}}/mission" class="dark-grey-text">Our Mission</a></p>
        <div class="divider"></div>
        <p><a href="{{url('/patient')}}/privacy" class="dark-grey-text">Privacy Policy</a></p>
        <div class="divider"></div>
        <p><a href="{{url('/patient')}}/conditions" class="dark-grey-text">Terms &amp; Condition</a></p>
        <div class="divider"></div>
        
    </div>
    <!--Container End-->
    @endsection