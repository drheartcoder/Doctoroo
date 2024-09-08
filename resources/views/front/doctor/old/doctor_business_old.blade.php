@extends('front.layout.master-coming-soon')
@section('main_content')

      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
         <div class="grrn-strip hidden-lg">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-9 col-lg-8">
                     <div class="doc-reg">
                        Register your Interest to Join our platform!
                     </div>
                  </div>
                  
                      <?php
                      $user = Sentinel::check();
                      if($user==null){ ?>
                     <div class="col-sm-3 col-md-3 col-lg-2">
                     <button class="doc-reg-btn" data-toggle="modal" href="#join-doc-popup">Register Now</button>
                     </div>
                     <div class="col-sm-3 col-md-3 col-lg-2">
                     <button class="doc-reg-btn" data-toggle="modal" href="#dlogin">Doctor Login</button>
                     </div>
                     <?php }else{?>
                     <div class="col-sm-3 col-md-3 col-lg-4">&nbsp;</div>
                     <?php } ?>
               </div>
            </div>
         </div>
         <div class="join-bg">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-7">
                     <div class="join-banner">
                         @include('front.layout._operation_status')
                        <h1 class="wow fadeInDown" data-wow-delay="0.2s">Practice Healthcare <span>Online.</span></h1>
                        <h4 class="wow fadeInDown" data-wow-delay="0.4s">Anytime, Anywhere.</h4>
                        <?php
                        $user = Sentinel::check();
                        if($user==null){ ?>
                        <button type="button" class="btn-grn wow zoomInUp" data-wow-delay="0.5s" href="#join-doc-popup" data-toggle="modal">
                           Join Doctor Now<!--<span class="co-so">(coming Soon)</span>-->
                        </button>
                        <div class="app-download wow fadeInDown" data-wow-delay="0.4s">
                           <div class="txt-ap">OR DOWNLOAD OUR APPS(Coming Soon!) </div>
                           <div class="btn-two-for">
                              <a href="#app-comingsoon" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a href="#app-comingsoon" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt=""/></a>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-7">
                     <div class="banner-home-box-join visible-lg">&nbsp;</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--</div>-->
      <!--what doc section start-->
      <div class="what-doc-section">
         <div class="container">
            <div class="row" style="position:relative;">
               <h1 class="wow fadeInDown"> What is <span>doctoroo</span>?</h1>
               <div class="head-btm"></div>
               <p class="wow fadeInDown">Doctoroo is an online platform allowing Healthcare professionals to offer their services online - through video visits, digital prescriptions and connected pharmacy network.</p>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/dc1.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown"> We Bring you the Patients</h3>
                     <div class="dc-content wow fadeInUp">
                        Our specialised marketing will attract patients who find doctoroo convenient and afficient to use, which helps you treat more patients everyday.
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
                     <p>With doctoroo's online platform, all your patients need in order to meet with you is a computer or phone and internet. This means that patients who live in remote areas, who are housebound, who have trouble lining up childcare, or just have to much going on in their lives to make room for a much needed consultation, now have a connection to healthcare - and to you.</p>
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
                     <p>Developed with input from Doctors, Pharmacists, Psychologists, doctoroo is Australian Healthcare legislation-compliant, secure, and has earned high reviews from practitioners and patients. The effectiveness of telemedicine has also been avaluated in several major clinical studies (see below).</p>
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
                     <img src="{{ url('/') }}/public/images/benifit3.png" alt="5-20 years Experienced Doctors" />
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
               <h1> What can you do on <span> doctoroo</span>?</h1>
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
            <div class="doctorlogo-title">Your Local Pharmacies with doctoroo</div>
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
                        <?php
                        $user = Sentinel::check();
                        if($user==null){ ?>
                        <button type="button" class="btn-grn" data-toggle="modal" href="#signup">See a Doctor Now<span class="co-so">(coming Soon)</span></button>
                        <div class="app-download">
                           <div class="txt-ap">OR DOWNLOAD OUR free APPS(Coming Soon) </div>
                           <div class="btn-two-for">
                              <a data-toggle="modal" href="#app-comingsoon"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a data-toggle="modal" href="#app-comingsoon"><img src="{{ url('/') }}/public/images/google-play.png" alt=""/></a>
                           </div>
                        </div>
                        <?php } ?>
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
               <center>  Coming Soon!</center>
               <!--
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
                  -->
            </div>
            <!--         <div class="in-press-but"><a href="#">More from the Press</a></div>-->
         </div>
      </div>
      <!-- Footer top company logo End here      -->      
@include('front.doctor.signup')
@stop