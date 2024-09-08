@extends('front.layout.master-coming-soon')                
@section('main_content')

      <!-- <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;"> -->
      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
      

         <div class="grrn-strip hidden-lg">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-7">
                     <div class="doc-reg">
                        Register your Interest to Join our platform!
                     </div>
                  </div>
                     <!-- <?php $user = Sentinel::check(); if($user==null){ ?>
                     <div class="col-sm-6 col-md-6 col-lg-5 join-regi-btn">
                     <button class="doc-reg-btn" data-toggle="modal" href="#dlogin">Doctor Login</button>
                     <button class="doc-reg-btn redirect_doc_signup">Register Now</button>
                     </div>
                     <?php }else{ ?>
                     <div class="col-sm-3 col-md-3 col-lg-4">&nbsp;</div>
                     <?php } ?> -->
               </div>
            </div>
         </div>
         <div class="join-bg">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-7">
                     <div class="join-banner">
                         @include('front.layout._operation_status')
                        <h1 class="wow fadeInDown" data-wow-delay="0.2s">Practice Healthcare Online.</h1>
                        <h4 class="wow fadeInDown" data-wow-delay="0.4s">Anytime, Anywhere.</h4>
                        <?php
                        $user = Sentinel::check();
                        if($user==null){ ?>
                        <button type="button" class="btn-grn wow zoomInUp" data-wow-delay="0.5s" href="#join-doc-popup" data-toggle="modal">
                           Join Doctoroo Now<!--<span class="co-so">(coming Soon)</span>-->
                        </button>
                        <div class="app-download wow fadeInDown" data-wow-delay="0.4s">
                           <div class="txt-ap">OR DOWNLOAD OUR Free APP Coming soon...! </div>
                           <div class="btn-two-for">
                              <!--<a href="#app-comingsoon" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>-->
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
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
               <h1 class="wow fadeInDown"> What is doctoroo?</h1>
               <div class="head-btm"></div>
               <p class="wow fadeInDown">Doctoroo is a telehealth and medication management platform that empowers doctors to treat more Australian patients with simplicity, convenience and quality.</p>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/dc1.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown">We bring you the patients</h3>
                     <div class="dc-content wow fadeInUp">
                        Our specialised marketing and deep industry relations attracts patients who immensely benefit from our platform, helping you treat more patients daily.
                     </div>
                  </div>
               </div>
               <div class="ver-divider"></div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/dc2.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown">Or you can bring your own</h3>
                     <div class="dc-content wow fadeInUp">
                        Our platform also allows you to treat your existing or selected patients only. There's also the flexibility of choosing to do both.
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
               <h1 class="wow fadeInDown">Take your practice online</h1>
               <div class="head-btm"></div>
               <div class="col-sm-12 col-md-6 col-lg-6 wow zoomIn">
                  <div class="online-left  wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/dc3.jpeg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.2s">
                     <h3>We're about to make your life and work a lot easier.</h3>
                     <p>Doctoroo makes it possible to offer your health services to patients across Australia, anytime, anywhere you are.</p>
                     <p>Whilist reducing overheads, such as rent, admin, office and travel costs, you can now practice medicine from your home, or anywhere in Australia.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6 pull-right">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/dc4.jpeg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6 pull-left">
                  <div class="online-right wow fadeIn" data-wow-delay="0.4s">
                     <h3>What do your patients need?</h3>
                     <p>Accessing doctoroo simply requires an internet-connected device. Put simply, if patients can access Facebook, they now have access to a doctor.</p>
                      <p>This is specially beneficial for patients who live in remote areas, who are housebound or simply can't make the time for a much needed consultation. These patients now have simple and affordable access to healthcare - through you.</p>
                     
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/dc5.jpeg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.6s">
                     <h3>Privacy, safety &amp; security</h3>
                     <p>Doctoroo was developed and is constantly being advanced with crucial input from innovative and respected healthcare professionals including doctors, pharmacists and medical scientists.</p>
                      <p>Our platform is Australian healthcare legislation-compliant, is stored in Australia in highly secured data centres.</p>
                      <p>Our platform has earned high reviews from both practitioners and patients a like. The effectiveness of telemedicine has also been evaluated in everal major cliical studies... <!-- <a href="#">Read More.</a> --></p>
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
               <h1 class="wow fadeInDown"><span>Benefits</span> for you</h1>
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
                        Treat patients during quiet times in your clinic
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="1s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit5.png" alt="img" />
                     <div class="benifit-content">
                        Lucrative Remuneration 
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="1.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit6.png" alt="img" />
                     <div class="benifit-content">
                        Remunerated weekly 
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
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                        Have a video consultation with patients
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.4s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                        Prepare prescriptions &amp; medical certificates
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.6s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                        Check Patient medical history &amp; medications
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.8s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                        Send prescriptions to pharmacies with one click 
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                        Message patients &amp; pharmacies
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1.2s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
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
               <h1 class="wow fadeInDown">How can doctoroo help you?</h1>
               <div class="tab-container wow slideInUp hidden-xs" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt=""/> 
                  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators tab-nav">
                        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel2" data-slide-to="1"></li>
                        <!-- <li data-target="#myCarousel2" data-slide-to="2"></li> -->
                     </ol>
                     <div class="carousel-inner">
                        <div class="item active first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/acne.png" width="70" alt=""/> 
                                          <span></span>
                                          Acne
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/advice-treatment.png" width="70" alt=""/> 
                                          <span></span>
                                          Advice & Treatment
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-digestion.png" width="70" alt=""/> 
                                          <span></span>
                                          Stomach Digestion
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/allergies.png" width="70" alt=""/> 
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/asthma.png" width="70" alt=""/> 
                                          <span></span>
                                          Asthma
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cold-flu.png" width="70" alt=""/> 
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/diarrhoea-vomiting.png" width="70" alt=""/> 
                                          <span></span>
                                          Diarrhoea Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/ear-problems.png" width="70" alt=""/> 
                                          <span></span>
                                          Ear Problems
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/eye-problems.png" width="70" alt=""/> 
                                          <span></span>
                                          Eye Problems
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/fever.png" width="70" alt=""/> 
                                          <span></span>
                                          Fever
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/hair-loss.png" width="70" alt=""/> 
                                          <span></span>
                                          Hair Loss
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/headaches-migraines.png" width="70" alt=""/> 
                                          <span></span>
                                          Headaches Migraines
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
                                    
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/itis.png" width="70" alt=""/> 
                                          <span></span>
                                          Itis
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/joint-pain.png" width="70" alt=""/> 
                                          <span></span>
                                          Joint Pain
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/mental-health.png" width="70" alt=""/> 
                                          <span></span>
                                          Mental Health
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/omitting.png" width="70" alt=""/> 
                                          <span></span>
                                          Omitting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/pregnancy.png" width="70" alt=""/> 
                                          <span></span>
                                          Pregnancy
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/respiratory-iIs-bronchitis.png" width="70" alt=""/> 
                                          <span></span>
                                          Respiratory iIs Bronchitis
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/sexual-health.png" width="70" alt=""/> 
                                          <span></span>
                                          Sexual Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/skin-conditions.png" width="70" alt=""/> 
                                          <span></span>
                                          Skin Conditions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-cramps.png" width="70" alt=""/> 
                                          <span></span>
                                          Stomach Cramps
                                       </a>
                                    </li>
                                     <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/prescriptions-repeats.png" width="70" alt=""/> 
                                          <span></span>
                                          Prescriptions Repeats
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/and-many-more.png" width="70" alt=""/> 
                                          <span></span>
                                          And Many More
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/what-we-cant-treat-yet.png" width="70" alt=""/> 
                                          <span></span>
                                          What we can’t treat yet
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="item first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-5.png" width="70" alt=""/> 
                                          <span></span>
                                          UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-6.png" width="70" alt=""/> 
                                          <span></span>
                                          Vomiting 
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-7.png" width="70" alt=""/> 
                                          <span></span>
                                          Depression
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-8.png" width="70" alt=""/> 
                                          <span></span>
                                          Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-9.png" width="70" alt=""/> 
                                          <span></span>
                                          Skin
                                       </a>
                                    </li>
                                     <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-1.png" width="70" alt=""/> 
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-2.png" width="70" alt=""/> 
                                          <span></span>
                                          Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-3.png" width="70" alt=""/> 
                                          <span></span>
                                          Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-4.png" width="70" alt=""/> 
                                          <span></span>
                                          Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-10.png" width="70" alt=""/> 
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-11.png" width="70" alt=""/> 
                                          <span></span>
                                         Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cat-icon-12.png" width="70" alt=""/> 
                                          <span></span>
                                          Upper Respiratory Infection
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div> -->
                        <div class="clearfix"></div>
                     </div>
                     
                  </div>
               </div>
                
                <div class="tab-container wow slideInUp visible-xs" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt=""/> 
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     
                     <div class="carousel-inner">
                        <div class="item active first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/acne.png" width="70" alt=""/> 
                                          <span></span>
                                          Acne
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/advice-treatment.png" width="70" alt=""/> 
                                          <span></span>
                                          Advice & Treatment
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-digestion.png" width="70" alt=""/> 
                                          <span></span>
                                          Stomach Digestion
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/allergies.png" width="70" alt=""/> 
                                          <span></span>
                                          Allergies
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
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/asthma.png" width="70" alt=""/> 
                                          <span></span>
                                          Asthma
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cold-flu.png" width="70" alt=""/> 
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/diarrhoea-vomiting.png" width="70" alt=""/> 
                                          <span></span>
                                          Diarrhoea Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/ear-problems.png" width="70" alt=""/> 
                                          <span></span>
                                          Ear Problems
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
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/eye-problems.png" width="70" alt=""/> 
                                          <span></span>
                                          Eye Problems
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/fever.png" width="70" alt=""/> 
                                          <span></span>
                                          Fever
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/hair-loss.png" width="70" alt=""/> 
                                          <span></span>
                                          Hair Loss
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/headaches-migraines.png" width="70" alt=""/> 
                                          <span></span>
                                          Headaches Migraines
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
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/itis.png" width="70" alt=""/> 
                                          <span></span>
                                          Itis
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/joint-pain.png" width="70" alt=""/> 
                                          <span></span>
                                          Joint Pain
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/mental-health.png" width="70" alt=""/> 
                                          <span></span>
                                          Mental Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/omitting.png" width="70" alt=""/> 
                                          <span></span>
                                          Omitting
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
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/pregnancy.png" width="70" alt=""/> 
                                          <span></span>
                                          Pregnancy
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/respiratory-iIs-bronchitis.png" width="70" alt=""/> 
                                          <span></span>
                                          Respiratory iIs Bronchitis
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/sexual-health.png" width="70" alt=""/> 
                                          <span></span>
                                          Sexual Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/skin-conditions.png" width="70" alt=""/> 
                                          <span></span>
                                          Skin Conditions
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
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-cramps.png" width="70" alt=""/> 
                                          <span></span>
                                          Stomach Cramps
                                       </a>
                                    </li>
                                     <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/prescriptions-repeats.png" width="70" alt=""/> 
                                          <span></span>
                                          Prescriptions Repeats
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/and-many-more.png" width="70" alt=""/> 
                                          <span></span>
                                          And Many More
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/what-we-cant-treat-yet.png" width="70" alt=""/> 
                                          <span></span>
                                          What we can’t treat yet
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                      
                            <a data-slide="prev" href="#myCarousel" class="left carousel-control"><i class="fa fa-angle-left"></i></a>
                            <a data-slide="next" href="#myCarousel" class="right carousel-control"><i class="fa fa-angle-right"></i></a>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
      <!-- Tab Slider End-->   
     
      <!--download app today-->
     <div class="app-download-section signup">
         <div class="bag-ligt">
            <div class="container">
               <div class="row">
                  <div class="hidden-xs hidden-sm col-md-5 col-lg-4 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/download-app-today.png" alt="Doctroo"/>
                         <div class="doc-mobile-call"><img src="{{ url('/') }}/public/images/video-img.jpg" alt=""/></div>
                     </div>
                  </div>
                  <div class="visible-xs col-md-6 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/download-app-today.png" width="333" alt="Doctroo"/>

                         <div class="doc-mobile-call">
                         <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h1>Want to join the future? Register your interest below</h1>
                        <span>Become a part of the team of doctors who will shape tomorrow's health.</span>
                        
                        <button type="button" class="btn-grn" data-toggle="modal" href="#join-doc-popup">Register your interest</button>
                        <div class="app-download">
                           
                           <div class="btn-two-for">
                              <!-- <a href="#app-comingsoon" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a> -->
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                            <div class="txt-ap"><span>Our app is coming soon - </span><br/>Practice medicine from any device </div>
                        </div>
                     </div>
                         </div>
                     </div>
                  </div>
                   
                  <div class="col-sm-12 col-md-7 col-lg-8 hidden-xs">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h1>Want to join the future? Register your interest below</h1>
                        <span>Become a part of the team of doctors who will shape tomorrow's health.</span>
                        <div class="connct-doc">After submitting your interest, we'll contact you to discuss any questions you may have and to complete registration.
                        </div>
                        <button type="button" class="btn-grn" data-toggle="modal" href="#join-doc-popup">Register your interest</button>
                        <div class="app-download">
                           <div class="txt-ap"><span>Our app is coming soon - </span><br/>Practice medicine from any device </div>
                           <div class="btn-two-for">
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--download app today-->

<script>
   var url = window.location.hash;
   if(url != '')
   {
      setTimeout(function(){
        $('#join-doc-popup').modal('show');   
      },2000);
   }
</script>
      
@include('front.doctor.signup')
@stop