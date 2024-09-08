@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

<div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Invitations</h1>

    </div>


    <div class="container posrel has-header has-footer minhtnor ">
        <div class="medi ">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#family" class="active">Family &amp; Friends</a>
                </li>
                <li class="tab truncate">
                    <a href="#doctor">Doctor</a>
                </li>
                <li class="tab truncate">
                    <a href="#pharmacy">Pharmacy</a>
                </li>
            </ul>
            <div class="clear"></div>
            <div class="pdrl">
                <div id="family" class="tab-content ">
                    <h2 class="center-align bluedoc-text doctroo">Love Doctoroo?</h2>
                    <p class="center-align bluedoc-text">Invite someone you care about, So we can take care of them too!</p>

                    <div class="per50 center-align valign-wrapper">

                        <span class="left"> <img src="{{url('/')}}/public/new/images/share_link.png"></span> <span class="right marno qusame"><a href="#sharelink" class="btn cart bluedoc-bg lnht truncate round-corner">Share Link</a></span>
                    </div>
                    <div class="per50 center-align ">
                        <span class="bluedoc-text center-align">- OR -</span>
                    </div>
                    <div class="per50 center-align valign-wrapper">
                        <span class="left"> <div class="input-field">
          <input id="last_name" type="text" class="validate" value="http://sahdshkdsh.com">
          <label for="last_name">Your Code</label>
        </div></span> <span class="right marno qusame"><a href="#sharelink" class="btn cart bluedoc-bg lnht truncate round-corner">Copy Link</a></span>
                    </div>
                </div>
                <div id="doctor" class="tab-content">
                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="col l12 m12 s12">
                            <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                   </span></div>
                    </div>

                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="input-field col s6 m6 l6   setlabelhalf">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">First Name</label>
                        </div>


                        <div class="input-field col s6 m6 l6   setlabelhalf">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Last Name</label>
                        </div>

                    </div>

                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="input-field col s6 m6 l6   setlabelhalf">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Phone Number</label>
                        </div>


                        <div class="input-field col s6 m6 l6   setlabelhalf">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Email</label>
                        </div>

                    </div>
                    <div class="row pdrl" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Medical Pratice Name</label>
                        </div>

                    </div>
                    <div class="row pdrl" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Medical Pratice Address</label>
                        </div>

                    </div>
                    <a class="waves-effect waves-light futbtn" href="#">Invite Doctor</a>
                </div>
                <div id="pharmacy" class="tab-content">
                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="col l12 m12 s12">
                            <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                   </span></div>
                    </div>

                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Enter Pharmacy Name</label>
                        </div>

                    </div>
                    <div class="row pdrl" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Pharmacy Number</label>
                        </div>

                    </div>


                    <div class="row pdrl" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Name of contact person e.g. pharmacist, manager, etc.</label>
                        </div>

                    </div>
                    <div class="row pdrl" style="margin-top: 10px;">
                        <div class="input-field col s12 m12 l12   setlabel">

                            <input type="text" id="reason" class="validate ">
                            <label for="reason" class="grey-text truncate">Email</label>
                        </div>

                    </div>
                    <a class="waves-effect waves-light futbtn" href="#">Invite Pharmacy</a>

                </div>
            </div>


        </div>
        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>
    <!--Container End-->
    @endsection