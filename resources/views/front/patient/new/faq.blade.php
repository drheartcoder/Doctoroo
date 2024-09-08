@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')


<div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/my_orders" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">How Can we help you?</h1>

    </div>


    <div class="container posrel has-header has-footer minhtnor ">
        <div class="medi ">
            <ul class="tabs tabli nomarnw z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#faq" class="active">FAQ's</a>
                </li>
                <li class="tab truncate">
                    <a href="#support">Contact &amp; Support</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="faq" class="tab-content ">
                <div class="searchsec posrel">
                    <input type="text" id="autocomplete-input" class="newsearchbox" placeholder="Have a question? Ask or enter a search term">
                    <img src="{{url('/')}}/public/new/images/faqhead.png" class="responsive-img">                     
                </div>
                <div class="commonTopics center-align">
                    <h3>Common FAQ's Topics</h3>
                    <ul class="grey_btn">
                        <li><a href="#" class="bluedoc-text">General</a></li>
                        <li><a href="{{url('/patient')}}/faq_settings" class="bluedoc-text">Privacy &amp; Settings</a></li>
                        <li><a href="#" class="bluedoc-text">Disputes</a></li>
                        <li><a href="#" class="bluedoc-text">Medication Manager</a></li>
                        <li><a href="#" class="bluedoc-text">Family Accounts</a></li>
                        <li><a href="#" class="bluedoc-text">Pharmacy Orders</a></li>
                    </ul>
                    <div class="clr"></div>
                </div> 
                
            </div>
            <div id="support" class="tab-content">
                <div class="">
                    <ul class="collapsible supportbox" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header supporthead "> <i class="material-icons left">mail_outline</i> Send an email or message <i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body center-align">
                                <span class="email">Email us: <a href="mailto:wecare@doctoroo.com.au">wecare@doctoroo.com.au</a></span>
                                <p>- OR -</p>
                                <div class="input-field">
                                    <textarea id="textarea1" class="materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                                </div>
                                <span class="right qusame"><a href="{{ url('/patient') }}/my_health" class="btn cart bluedoc-bg lnht round-corner">SEND</a></span>
                                <div class="clr"></div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header supporthead"><i class="material-icons left">chat</i> Chat with us <i class="material-icons right arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body">
                                <div class="input-field">
                                    <textarea id="textarea1" class="materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                                </div>
                                <span class="right qusame"><a href="{{ url('/patient') }}/my_health" class="btn cart bluedoc-bg lnht round-corner">Start Chat</a></span>
                                <div class="clr"></div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header supporthead"><i class="material-icons left">phonelink_ring</i>Call us <i class="material-icons right arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body left-align">
                                <p><img src="{{url('/')}}/public/new/images/australia-flag.svg" class="flagicon left" /> +61 488 863 626</p>
                                <p>Mon - Fri <span class="bluedoc-text">9am - 5pm </span>(EST)</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_booking">Save</a>-->
    </div>
    <!--Container End-->

    @endsection