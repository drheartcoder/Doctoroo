 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

 <div class="header paymethodhead z-depth-2 ">
        <div class="backarrow"><a href="{{url('/patient')}}/faq" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">How Can we help you?</h1>

    </div>


    <div class="container posrel has-header has-footer minhtnor ">
        <div class="medi ">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#faq" class="active">FAQ's</a>
                </li>
                <li class="tab truncate">
                    <a href="#support">Contact &amp; Support</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="faq" class="tab-content ">
                <div class="pdrl">
                    <div class="nav-wrapper">
                        <a href="{{url('/patient')}}/faq" class="breadcrumb">FAQ's</a>
                        <a href="#" class="breadcrumb">Security</a>
                    </div>
                    <div class="gray-strip">
                        <div class="bluedoc-text center-align">
                            Privacy &amp; Settings
                        </div>
                    </div>

                    <h2 class="faqhead">General</h2>
                    <ul class="collapsible faqbox" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>Why do we use it?</div>
                            <div class="collapsible-body"><span>

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>Why do we use it?</div>
                            <div class="collapsible-body"><span>

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>Why do we use it?</div>
                            <div class="collapsible-body"><span>

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


</span></div>
                        </li>
                    </ul>
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