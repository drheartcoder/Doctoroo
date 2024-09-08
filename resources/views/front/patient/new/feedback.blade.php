@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

    <div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{ url('/patient') }}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Send Us your Feedback</h1>
    </div>


    <div class="container posrel has-header has-footer minhtnor ">
        <div class="medi pdtbrl center-align">
            <div class="wid80 marrl"> 
                <p class="center-align grey-text"> <strong>Your feebback is important to us -</strong></p>
                <p class="center-align grey-text">It's because of this kind of feedback that doctoroo continues to be improved by our team &amp; loved by our members.</p></div>
            
            <div class="ratings"><i class="material-icons active">add_circle</i> <i class="material-icons active">add_circle</i> <i class="material-icons active">add_circle</i> <i class="material-icons">add_circle</i> <i class="material-icons">add_circle</i></div>
                <div class="input-field">
                    <textarea id="textarea1" class="materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                </div>
             <span class="right qusame marbtm"><a href="{{ url('/patient') }}/settings" class="btn cart green lnht round-corner">Send Feedback</a></span>
            <div class="clr"></div>
                <div class="otherdetails">
                <a class="waves-effect waves-light btn cart bluedoc-bg round-corner" href="{{ url('/patient') }}/settings"><span class="truncate "> Rate us on the App Store</span> </a>
               
            </div>
        </div>
        <!--<a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_booking">Save</a>-->
    </div>
    <!--Container End-->

@endsection