@extends('front.layout.master')                
@section('main_content')

<style>
   .highlight-pharma-row
   {
      background:#eee;
       outline: none;
       padding: 5px 0 5px 10px;
   }

</style>

      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
         -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
         <div class="bg-shaad inner-page-shaad">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-home-box">
                        <h1>Pharmacy Sign Up</h1>
                        <div class="bor-light">&nbsp;</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard menu-->
      <!--banner section start-->
      <div class="pharmacy-signup-bx">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="signup-txt">
                     To join our platform, search for your pharmacy below, select it and continue the registration processs
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
               <form action="{{ $module_url_path }}" method="get" id="frm_search_pharmacy">
                  <div class="search-bx">
                     <input type="text" class="search-in" name="search_term" value="{{ $search_term or '' }}"  placeholder="Search By suburb or postcode" />
                      {{--<input type="hidden" name="pharmacy_id" id="pharmacy_id" />
                      <input type="hidden" name="search_term" id="search_term" value="{{ $search_term or '' }}" /> --}}
                     <span> <button class="pharna-search-btn">Search</button></span>
                  </div>
               </form>
                  <div class="left-map-section" id="content-d1">
                     <div class="chatting-section">

                     @if(isset($arr_search_location) && sizeof($arr_search_location)>0)
                        @foreach($arr_search_location as $pharmacy)
                        
                       
                           <div class="pharma-row pharmacy_div pharmacy_{{ $pharmacy['id'] }}" tabindex='1'>
                              <div class="row">
                                 <div class="col-sm-7 col-md-6 col-lg-7">
                                    <div class="home-icon"> <i class="fa fa-home"></i></div>
                                    <div class="pharmcy-detail-bx">
                                       <a href="#">{{ isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:' ' }}</a>

                                       <div class="pharna-add">
                                          {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                                          <br/>
                                          {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                                       </div>

                                    </div>
                                 </div>
                                 <div class="col-sm-5 col-md-6 col-lg-5">
                                    <div class="pharma-btns">
                                       <button class="details-btn">Details</button>
                                       <button onclick="goToSignUpPage('{{ base64_encode($pharmacy['id']) }}')" class="details-btn select-btn">claim pharmacy</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
   

                        @endforeach
                     @else
                           {{ 'Pharmacies are not available' }}
                     @endif
                         
                     </div>
                  </div>

                  <div class="cant-find-txt">
                     Cant't find your Pharmacy?
                  </div>
                  <button class="signup-pharma"> Signup your Pharmacy from Scratch</button>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="pharma-map">
                    {{--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d929.6306409823535!2d151.20810376103555!3d-33.868348886363215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae407edb3615%3A0x92c103b2e9e0f56!2sAustralian+Medico+Legal+Services+PTY+LTD!5e0!3m2!1sen!2sin!4v1481967689863" width="100%" height="465" frameborder="0" style="border:0"></iframe> --}}
                   <div id="pharmacy_map" style="height:457px;"></div>

                  </div>
                  <div class="key-box">
                     <div class="row">
                        <div class="col-sm-1">
                           <div class="key-text"> Key:</div>
                        </div>
                        <div class="col-lg-11">
                           <div class="key-details gre-txt">
                              <span><i class="fa fa-home"></i></span> Claimed Pharmacy already on Doctoroo
                           </div>
                           <div class="key-details">
                              <span><i class="fa fa-home"></i></span> Uncliamed Pharmacy
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!--banner section end-->
       <!--what doc section start-->
      <div class="what-doc-section">
         <div class="container">
            <div class="row" style="position:relative;">
               <h1 class="wow fadeInDown"> What is <span>Doctoroo</span>?</h1>
               <div class="head-btm"></div>
               <p class="wow fadeInDown">Doctoroo is an online platform allowing Healthcare professionals to offer their services online - through video visits, digital prescriptions and connected pharmacy network.</p>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/dc1.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown"> We Bring you the Patients</h3>
                     <div class="dc-content wow fadeInUp">
                        Our specialised marketing will attract patients who find Doctoroo convenient and afficient to use, which helps you treat more patients everyday.
                     </div>
                  </div>
               </div>
               <div class="ver-divider"></div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/dc2.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown"> Or you can bring your own</h3>
                     <div class="dc-content wow fadeInUp">
                        Our system is also designed so that you can choose to treat your existing patients only. You can also choose to do both.
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--what doc section end-->
      <!--online gray section start-->
      <div class="online-section">
         <div class="container">
            <div class="row">
               <h1 class="wow fadeInDown">Take your Practice <span>Online</span></h1>
               <div class="head-btm"></div>
               <div class="col-sm-12 col-md-6 col-lg-6 wow zoomIn">
                  <div class="online-left">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/online1.png" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.2s">
                     <h3>We're about to make your life and work a lot easier.</h3>
                     <p>Doctoroo makes it possible to offer your health services to patients across Australia, anytime, anywhere you are.</p>
                     <p>
                        Whilist reducing overheads, such as rent, admin, office and travel costs, you can now practice medicine from your home, or anywhere in
                     </p>
                     <p>Australia - whether on a relaxing lounge or from a holiday house, 24/7.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6 pull-right">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/online2.png" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6 pull-left">
                  <div class="online-right wow fadeIn" data-wow-delay="0.4s">
                     <h3>What do your patients need?</h3>
                     <p>With Doctoroo's online platform, all your patients need in order to meet with you is a computer or phone and internet. This means that patients who live in remote areas, who are housebound, who have trouble lining up childcare, or just have to much going on in their lives to make room for a much needed consultation, now have a connection to healthcare - and to you.</p>
                     <div class="fb-tag">
                        If you patients can access facebook. Then they can accesss a Doctor.
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/online3.png" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.6s">
                     <h3>Safety &amp; Security</h3>
                     <p>Developed with input from Doctors, Pharmacists, Psychologists, Doctoroo is Australian Healthcare legislation-compliant, secure, and has earned high reviews from practitioners and patients. The effectiveness of telemedicine has also been avaluated in several major clinical studies (see below).</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--online gray section end-->
      <!--benifits section start-->
      <div class="what-doc-section">
         <div class="container">
            <div class="row">
               <h1 class="wow fadeInDown"><span>Benefits</span> for You</h1>
               <br/>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit1.png" alt="img" />
                     <div class="benifit-content">
                        Treat your existing patients when they can't travel to you
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.4s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit2.png" alt="img" />
                     <div class="benifit-content">
                        No commitments, work whenever you want, whenever you want
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.6s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit3.png" alt="img" />
                     <div class="benifit-content">
                        Treat more patients per day Australia-wide
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.8s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit4.png" alt="img" />
                     <div class="benifit-content">
                        Treat patients during quite times in you clinic
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="1s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit5.png" alt="img" />
                     <div class="benifit-content">
                        Earn $180 per hour
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="1.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit6.png" alt="img" />
                     <div class="benifit-content">
                        Get paid weekly
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--benifits section end-->
      <!--blue section start-->
      <div class="blue-section">
         <div class="container">
            <div class="row">
               <h1> What can you do on <span> Doctoroo</span>?</h1>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="blue-bxx wow fadeInDown" data-wow-delay="0.2s">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Have a video consultation with patients
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.4s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Prepare prescriptions &amp; Medical Certificates
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.6s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Check Patient medical history &amp; medications
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.8s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Send prescriptions to pharmacies with one click 
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Message patients &amp; pharmacies
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1.2s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt">
                        Set your availability times and appointment reminders
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--blue section end-->
      <!-- Tab Slider-->
      <div class="tab-slider land-tab">
         <div class="container">
            <div class="row">
               <h1 class="wow fadeInDown">Common <span>Conditions Patients </span> may see you for</h1>
               <p class="wow fadeInDown">We treat most common illnesses quickly and effectively through a video doctor visit.</p>
               <div class="tab-container wow slideInUp" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt=""/> 
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators tab-nav">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="item active first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt=""/> 
                                       <span></span>
                                       Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt=""/> 
                                       <span></span>
                                       Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt=""/> 
                                       <span></span>
                                       Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt=""/> 
                                       <span></span>
                                       Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt=""/> 
                                       <span></span>
                                       UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt=""/> 
                                       <span></span>
                                       Vomiting 
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt=""/> 
                                       <span></span>
                                       Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt=""/> 
                                       <span></span>
                                       Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt=""/> 
                                       <span></span>
                                       Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt=""/> 
                                       <span></span>
                                       Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt=""/> 
                                       <span></span>
                                       Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt=""/> 
                                       <span></span>
                                       Upper Respiratory Infection
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="item first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt=""/> 
                                       <span></span>
                                       Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt=""/> 
                                       <span></span>
                                       Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt=""/> 
                                       <span></span>
                                       Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt=""/> 
                                       <span></span>
                                       Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt=""/> 
                                       <span></span>
                                       UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt=""/> 
                                       <span></span>
                                       Vomiting 
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt=""/> 
                                       <span></span>
                                       Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt=""/> 
                                       <span></span>
                                       Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt=""/> 
                                       <span></span>
                                       Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt=""/> 
                                       <span></span>
                                       Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt=""/> 
                                       <span></span>
                                       Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt=""/> 
                                       <span></span>
                                       Upper Respiratory Infection
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="item first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt=""/> 
                                       <span></span>
                                       Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt=""/> 
                                       <span></span>
                                       Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt=""/> 
                                       <span></span>
                                       Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt=""/> 
                                       <span></span>
                                       Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt=""/> 
                                       <span></span>
                                       UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt=""/> 
                                       <span></span>
                                       Vomiting 
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt=""/> 
                                       <span></span>
                                       Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt=""/> 
                                       <span></span>
                                       Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt=""/> 
                                       <span></span>
                                       Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt=""/> 
                                       <span></span>
                                       Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt=""/> 
                                       <span></span>
                                       Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                       <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt=""/> 
                                       <span></span>
                                       Upper Respiratory Infection
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Tab Slider End-->    
      <!--what to expect-->
      <div class="what-u-expect">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="meet-title wow fadeInDown"><span> Meet Other</span> Doctors &amp; Psychologists</div>
                  <div class="meet-subtitle wow fadeInDown">Our board-certified physicians and doctorate-level psychologists. Highest quality of care, with a smile.</div>
                  <div class="row">
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.5s">
                           <div class="title-expect"><a href="#">Dr. Kristin Dean</a></div>
                           <div class="title-text">Board-Certified MD</div>
                           <div class="img-b"><img src="{{ url('/') }}/public/images/kristin-dean.png" width="250" alt="Doctroo"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.7s">
                           <div class="title-expect"><a href="#">Dr. Prentiss Taylor</a></div>
                           <div class="title-text">Board-Certified MD</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/prentiss-taylor.png" width="250" alt="Doctroo"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.9s">
                           <div class="title-expect"><a href="#">Dr. Anjali Mahto</a></div>
                           <div class="title-text">MBBCh BSc MRCP (Derm)</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/anjali-mahto.png" width="250" alt="Doctroo"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="1s">
                           <div class="title-expect"><a href="#">Dr. Craig Dike</a></div>
                           <div class="title-text">Psychologist</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/craig-dike.png" width="250" alt="Doctroo"/></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--what to expect-->  
      <div class="client-logo">
         <div class="container">
            <div class="doctorlogo-title">Your Local Pharmacies with Doctoroo</div>
            <div class="client_slider">
               <!-- <center>  Coming Soon!</center>-->
               <ul id="flexiselDemo3">
                  <li>
                     <img src="{{ url('/') }}/public/images/doctor-logo-1.png" alt="cilent img" />
                  </li>
                  <li>
                     <img src="{{ url('/') }}/public/images/doctor-logo-2.png" alt="cilent img" />
                  </li>
                  <li>
                     <img src="{{ url('/') }}/public/images/doctor-logo-3.png" alt="cilent img"/>
                  </li>
                  <li>
                     <img src="{{ url('/') }}/public/images/doctor-logo-4.png" alt="cilent img" />
                  </li>
                  <li>
                     <img src="{{ url('/') }}/public/images/doctor-logo-5.png" alt="cilent img" />
                  </li>
               </ul>
               <div class="clr"></div>
            </div>
         </div>
      </div>
      <!--download app today-->
      <div class="app-download-section">
         <div class="bag-ligt">
            <div class="container">
               <div class="row">
                  <div class="hidden-xs hidden-sm col-md-5 col-lg-4 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/download-app-today.png" alt="Doctroo"/>
                        <div class="doc-mobile-call"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/ysv8b8auZFg?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0"></iframe></div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-7 col-lg-8">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h1>See a Doctor Today, Wherever you are</h1>
                        <span>How much does it cost?</span>
                        <div class="connct-doc">Average calls lasts 6-8 minues and cost just $24 - $36.
                           All other app features are free for you (no astericks!)
                        </div>
                        <button type="button" class="btn-grn" data-toggle="modal" href="#signup">See a Doctor Now<span class="co-so">(coming Soon)</span></button>
                        <div class="app-download">
                           <div class="txt-ap">OR DOWNLOAD OUR free APPS(Coming Soon) </div>
                           <div class="btn-two-for">
                              <a data-toggle="modal" href="#app-comingsoon"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a data-toggle="modal" href="#app-comingsoon"><img src="{{ url('/') }}/public/images/google-play.png" alt=""/></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--download app today-->      
      <!-- Footer top company logo start here      -->
      <div class="client-section">
         <div class="container">
            <div class="doctorlogo-title">In the Press</div>
            <div class="row">
               <!--<center>  Coming Soon!</center>-->
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client1.png" alt=""/></div>
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client2.png" alt=""/></div>
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client3.png" alt=""/></div>
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client4.png" alt=""/></div>
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client5.png" alt=""/></div>
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="client-img"><img src="{{ url('/') }}/public/images/client6.png" alt=""/></div>
               </div>
            </div>
            <div class="in-press-but"><a href="#">More from the Press</a></div>
         </div>
      </div>
      <!-- Footer top company logo End here      -->

      <input type="hidden" id="arr_map_location" value="{{ (isset($arr_search_location))? json_encode($arr_search_location): json_encode(array()) }}">
      <!-- Footer top company logo End here      -->       
      <!--footer-->
      <!-- custom scrollbars plugin -->
      <!-- custom scrollbars plugin -->

      <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <!-- custom scrollbar plugin -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

   
      <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY"></script> 

      <script>
         (function($){
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
                 $("#content-d1").mCustomScrollbar({theme:"dark"});
                 
         });
         })(jQuery);
      </script>
     <script  src="{{ url('/') }}/public/js/jquery.scrollTo.js"></script> 
      <script>
         
         $(document).ready(function() {

                 initialize();
         });

         /* function getCurrentLocation()
         {

               if(!navigator.geolocation){
                alert('Your Browser does not support HTML5 Geo Location. Please Use Newer Version Browsers');
                }
               navigator.geolocation.getCurrentPosition(success, error);
               function success(position)
               {
                  var latitude  = position.coords.latitude; 
                  var longitude = position.coords.longitude;   
                  var accuracy  = position.coords.accuracy;
                  document.getElementById("current_latitude").value  = latitude;
                  document.getElementById("current_longitude").value = longitude;
                 // document.getElementById("acc").value  = accuracy;
               }
               function error(err){
                  alert('ERROR(' + err.code + '): ' + err.message);
               }

         }*/
         function initialize()
         {
               var lat_lng            = new Array();
               var arr_lat_long       = $("#arr_map_location").val();
               arr_lat_long           = JSON.parse(arr_lat_long);
               var site_url           = '{{ $site_url }}';
               map = new google.maps.Map(document.getElementById('pharmacy_map'), 
               {
                  center: {
                     lat: -33.865143,
                     lng: 151.209900
                  },
                  scrollwheel: true,
                  scaleControl: true,
                  overviewMapControl: true,
                  zoom: 4,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
               });

               var infoWindow   = new google.maps.InfoWindow();
               var latlngbounds = new google.maps.LatLngBounds();

               var icon = {
                      url: site_url+'/images/pharmacy.png', 
                  };

              for(var lat_long in arr_lat_long) 
              {
                  
                  var data          = arr_lat_long[lat_long];
                  var myLatlng      = new google.maps.LatLng(data.latitude, data.longitude);
                  lat_lng.push(myLatlng);

                     var marker     = new google.maps.Marker({
                      position: myLatlng,
                      map: map,
                      title: data.pharmacy_name,
                      icon:icon,
                  
                  });

                 latlngbounds.extend(marker.position);
                 
                  (function (marker, data)
                   {
                        google.maps.event.addListener(marker, "click", function (e) 
                        {
                           infoWindow.setContent(data.pharmacy_name);
                           infoWindow.open(map, marker);
                           setHighlightPharmacy(data.id);
                        });
                   })(marker, data);
               }
               map.setCenter(latlngbounds.getCenter());
               map.fitBounds(latlngbounds);
               //map.setZoom(Math.max(17, map.getZoom()) );
                

         }
         function setHighlightPharmacy(elem)
         {
            $('.pharmacy_div').removeClass('highlight-pharma-row');
            $('.pharmacy_'+elem).removeClass('pharma-row');
            $('.pharmacy_'+elem).addClass('highlight-pharma-row');

            setTimeout(function(){
               $('.pharmacy_'+elem).focus();

              },200);

           
         }
         function goToSignUpPage(ref)
         {
               if(ref!='')
               {
                  var url = '{{ $module_url_path }}/signup_step1/'+ref;
                  window.location.href = url;
               }
               else
               {
                     alert('Error occure while signup for this pharmacy.');
               }
               
         }
      </script>
   
@stop