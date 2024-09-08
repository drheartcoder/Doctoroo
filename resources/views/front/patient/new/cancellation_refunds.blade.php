@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

    <div class="header pricinghead z-depth-2 ">
        <div class="backarrow"><a href="#" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align">Pricing</h1>
    </div>

    <div class="container posrel has-header has-footer minhtnor content-panel">
        <div class="pricescetion">
            <h3 class="ques">How much does it cost to see a doctor?</h3>
            <p><a href="javascript:void(0);">Cancellation &amp; refunds</a> - you can cancel anytime before the doctor confirms your booking(you won't be charged until the doctor confirms)</p>
            <p>Exception - if doctor has confirmed, and theres more than 1 hour left until consultation, you can cancel &amp; get refund</p>
            <p>if there's less than 1 hour. you won't get a refund as the doctor may have missed on an oportunity to treat another patient in that timeslot which they had assigned to you.</p>
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_booking">Back</a>
    </div>
    <!--Container End-->

@endsection