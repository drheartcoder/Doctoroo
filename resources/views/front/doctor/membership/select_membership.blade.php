 @extends('front.doctor.layout.new_master')
@section('main_content')

 <div class="header bookhead nopad">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align small-device-text"></h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')


    <div class="mar300  has-header minhtnor">

        <div class="price-container">

            <div class="row bor-btm">
                <div class="col l9 s12">

                    <div class="row">
                        <div class="col m6">
                            <div class="membership-rate-box">
                                <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text">Standard Membership </h3>
                                    <h2 class="membership-price">Free
                                    <small>No Monthly Fees</small>
                                    </h2>
                                    
                                    <div class="center-align"><small class="grey-text ">Our entire platform free for you to use</small></div>
                                    <div class="center-align">
                                        <a class="btn grey-btn">Your Current Plan</a></div>
                                    <div class="divider mrmintb"></div>
                                    <p class="center-align bluedoc-text">Our Doctor's Favourite feature includes</p>

                                    <ul class="membership-points">
                                        <li>Select your own availibility </li>
                                        <li>Work anywhere you want</li>    
                                        <li>See your exsiting patients online</li>
                                        <li>See new patients australia wide</li>
                                        <li>Use the entire platform with no limits</li>
                                        <li>Unlimited Consultations</li>
                                         <li class="disabled-item">Set your own consultation rates</li>
                                         <li class="disabled-item">Option to see only your existing patients</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col m6">
                            <div class="membership-rate-box green-border">
                                <div class="custom-rates">
                                    <h3 class="center-align bluedoc-text">Premium Membership </h3>
                                    <h2 class="membership-price"><sup>$</sup>59.95
                                    <small>+ GST / month</small>
                                    </h2>
                                    <div class="center-align"><small class="grey-text">Practice medicine at your own time &amp; price</small></div>
                                    <div class="center-align">
                                        <a class="btn grey-btn green white-text">Select</a></div>
                                    <div class="divider mrmintb"></div>
                                    <p class="center-align bluedoc-text">Premium includes everything in standard plus:</p>

                                    <ul class="membership-points">
                                        <li>Select your own availibility </li>
                                        <li>Work anywhere you want</li>    
                                        <li>See your exsiting patients online</li>
                                        <li>See new patients australia wide</li>
                                        <li>Use the entire platform with no limits</li>
                                        <li>Unlimited Consultations</li>
                                         <li>Set your own consultation rates</li>
                                         <li>Option to see only your existing patients</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l3 s12 center-align">
                    <p class="center-align bluedoc-text"><a href="{{url('/')}}/doctor/membership/standard" class="center-align bluedoc-text"> <img src="{{url('/')}}/public/doctor_section/images/close-icon.png">
                     close</a></p>
                </div>
            </div>
            
        </div>
    </div>