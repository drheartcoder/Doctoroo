@extends('front.patient.new.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">Messages</h1>

    </div>
    <div id="slide-out" class="side-nav fixed menu-main">
      @include('front.patient.new.layout._sidebar')
    </div>
    <div class="mar300 posrel has-header has-footer">

        <div class="container posrel futspace">
            <ul class="collection brdrtopsd messageslist">
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="{{ url('/patient') }}/my_messages">
                        <div class="image-avtar left"><img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{url('/')}}/public/new/images/doctor-icon-small.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right"> <span class="badge circle">1</span></div>

                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="{{ url('/patient') }}/my_messages">
                        <div class="image-avtar left"><img src="{{url('/')}}/public/new/images/avtar_messages1.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{url('/')}}/public/new/images/telemarketer.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right "> <span class="badge circle right">5</span></div>

                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="{{ url('/patient') }}/my_messages">
                        <div class="image-avtar left"><img src="{{url('/')}}/public/new/images/avtar_messages2.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{url('/')}}/public/new/images/online-store.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right right-align"> 28 Apr, <span>10.20pm</div>

                        <div class="clearfix"></div>
                    </a>
                </li>
                
            </ul>
            
        </div>
<div class="fixed-action-btn hidetext">
            <a href="javascript:void(0)"><span class="grey-text">New Message</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
                    </a>

                    </div>
    </div>
    <!--<div class="bag-footer hide-on-med-and-down">
    <div class="container">
        <div class="">
            <div class="footer-block row">
                <div class="col s12 m12 l3">
                    <div class="footer-section">
                        <div class="logo-footer">
                            <img src="{{url('/')}}/public/new/images/logo.png" alt="" />
                        </div>
                        <div class="text-footer">Lorem ipsum dolor sit amet, consectetured adipiscing elit, sed do eiusmod tempor inci didunt ut...</div>
                        <div class="emailer-info">
                            <input type="text" class="emiler-footer" placeholder="Email" /><span><button type="button" class="news-letter"><i class="fa fa-arrow-circle-o-right"></i></button>
                  </span>
                        </div>

                    </div>
                </div>
                <div class="col s12 m5 l4">

                    <div class="footer-section">
                        <div class="ftr-col">
                            <div class="footer-heading">
                                Learn More
                            </div>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#"> About Us</a></li>
                                    <li><a href="#"> Team </a></li>
                                    <li><a href="#"> Pricing </a></li>
                                    <li><a href="#"> Careers </a></li>
                                    <li><a href="#"> FAQ's </a></li>
                                    <li><a href="#"> Press </a></li>
                                    <li><a href="#"> Privacy Policy </a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="ftr-col-snd">
                            <div class="footer-heading">
                                Partners
                            </div>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#">Companies &amp; Organisations</a></li>
                                    <li><a href="#"> Private Health Funds </a></li>
                                </ul>
                            </div>
                            <p></p>
                            <div class="footer-heading">
                                Join our Platform
                            </div>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#">Doctors</a></li>
                                    <li><a href="#"> Pharmacies</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col s12 m4 l3">
                    <div class="footer-section">
                        <div class="footer-heading">
                            Get in Touch
                        </div>
                        <div class="footer-links">
                            <div class="get-touch-bx">
                                <div class="genral-heading">General Enquiries </div>
                                <p> 1300 352 184</p>
                                <p> customercare@doctoroo.com.au</p>
                            </div>
                            <div class="get-touch-bx">
                                <div class="genral-heading">Investors </div>
                                <p> investor@doctoroo.com.au</p>
                            </div>
                            <div class="get-touch-bx">
                                <div class="genral-heading">Media &amp; Press </div>
                                <p> media@doctoroo.com.au</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3 l2">
                    <div class="footer-section">
                        <div class="footer-heading">
                            Get Started
                        </div>
                        <div class="footer-links">
                            <div class="footer-app-imgs">
                                <a href="#"> <img src="{{url('/')}}/public/new/images/appstor.png" alt="img" /></a>

                                <a href="#"> <img src="{{url('/')}}/public/new/images/google-play.png" alt="img" /></a>
                                <a href="#"> <img src="{{url('/')}}/public/new/images/andr-app.png" alt="img" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col s12 m8 l8">
                    <div class="stament-copyright">&copy; 2017 Doctoroo Australia PTY. LTD. | ACN 616 602 629 | All Rights Reserved. <a href="#" class="terms-ftr-link"> Terms &amp; Conditions</a>
                    </div>
                </div>
                <div class="col s12 m4 l3">
                    <div class="social-link">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>-->
    <!-- Modal Reschedule -->
    <div id="resechdule" class="modal resechdule">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="{{ url('/patient') }}/cancellation_refunds"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->
    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="{{ url('/patient') }}/cancellation_refunds"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Structure End -->

    @endsection