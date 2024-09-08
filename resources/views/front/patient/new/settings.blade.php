@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

   <div class="header medicationhead z-depth-2">
        <div class="backarrow "><a href="{{url('/patient')}}/my_health" class="center-align"><i class="material-icons">close</i></a></div>
        <h1 class="main-title center-align truncate">Settings</h1>
    </div>
    <div class="container posrel has-header has-footer medicationmain">
        <h3 class="sethead">Account</h3>

        <ul class="setmenu">
            <li> <a href="{{url('/patient')}}/personal_details" class="valign-wrapper"><span class="personalDet"></span> Personal Details</a></li>

            <li> <a href="{{url('/patient')}}/family_member" class="valign-wrapper"><span class="familyMem"></span> Family Members </a></li>
            <li> <a href="{{url('/patient')}}/family_doctor" class="valign-wrapper"><span class="familydoc"></span> My Family Doctor</a></li>
            <li> <a href="{{url('/patient')}}/my_pharmacy" class="valign-wrapper"><span class="pharmacypref"></span>  My Pharamacy &amp; Preferences </a></li>
            <li> <a href="{{url('/patient')}}/email_password" class="valign-wrapper"><span class="emailpass"></span>  Email &amp; Password </a></li>
        </ul>



        <ul class="setmenu">
            <li>
                <h3 class="sethead"> <a href="{{url('/patient')}}/notification_settings" class="valign-wrapper bluedoc-text"><!--<span class="notifications"></span>--> Notification</a></h3></li>
        </ul>
        <h3 class="sethead">Billing &amp; Payments</h3>

        <ul class="setmenu">

            <li> <a href="{{url('/patient')}}/payment_method_settings" class="valign-wrapper"><span class="payment"></span> Payment Methods</a></li>
            <li> <a href="{{url('/patient')}}/invoice" class="valign-wrapper"><span class="invoices"></span> Invoices &amp; Codes</a></li>
            <li><a href="{{url('/patient')}}/invitation" class="valign-wrapper"><span class="invitations"></span>Invitation credit &amp; codes </a></li>
            <li> <a href="{{url('/patient')}}/disputes" class="valign-wrapper"><span class="disputes"></span> Disputes</a></li>

        </ul>
        <h3 class="sethead">Invitations</h3>

        <ul class="setmenu">

            <li> <a href="{{url('/patient')}}/invitation" class="valign-wrapper"><span class="invitations"></span> Invite patient/dr/pharmacy</a></li>
            <li> <a href="{{url('/patient')}}/invitation" class="valign-wrapper"><span class="invitations"></span> Invitation credit &amp; codes</a></li>


        </ul>
        <h3 class="sethead">Help &amp; Support</h3>

        <ul class="setmenu">

            <li> <a href="{{url('/patient')}}/faq" class="valign-wrapper"><span class="faq"></span>Support &amp; FAQ’s</a></li>
            <li> <a href="{{url('/patient')}}/feedback" class="valign-wrapper"><span class="feedback"></span> Feedback &amp; Rate Doctoroo</a></li>
            <li> <a href="{{url('/patient')}}/legal" class="valign-wrapper"><span class="legal"></span> Legal</a></li>

        </ul>
        <a class="waves-effect waves-light futbtn" href="#logout">Log Out</a>
        <div class="clr"></div>
    </div>
    <div id="logout" class="modal requestbooking">

        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p>Are you sure you want to Logout?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="{{ url('/patient') }}/index" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
        </div>

    </div>
    <!--Container End-->

    @endsection