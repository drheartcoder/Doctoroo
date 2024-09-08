@extends('front.layout.master-coming-soon')                
@section('main_content')
 <div class="banner-home">
         <video id="my-video" class="video home-slider" autoplay="autoplay" preload="auto" loop="loop" muted="" width="100%" tabindex="0">
            <source src="video/homepagevid1.mp4" type="video/mp4" />
            <source src="video/homepagevid1.ogv" type="video/ogv" />
            <source src="video/homepagevid1.ogg" type="video/ogg" />
            <source src="video/homepagevid1.webm" type="video/webm" />
         </video>
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-10">
                  <div class="banner-home-box">
                    <h1 class="wow fadeInDown" data-wow-delay="0.2s"><span>See Qualified Australian Doctors.</span></h1>
                     <h4 class="wow fadeInDown" data-wow-delay="0.4s">Anytime. Anywhere.</h4>
                     <?php
                      $user = Sentinel::check();
                      if($user==null){ ?>
                     <button type="button" class="btn-grn wow zoomInUp" data-wow-delay="0.5s" href="#signup" data-toggle="modal" id="open_signup">Sign up for free</button>
                     <div class="app-download wow fadeInDown" data-wow-delay="0.4s">
                        <div class="btn-two-for hidden-xs">
                           <a href="#"><img src="images/appstor.png" alt="App Store"/></a>
                           <a href="#"><img src="images/google-play.png" alt="Google Play Store"/></a>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--  We've All Been There...-->
      <div class="secound-sec hidden-xs">
         <div class="container">
            <div class="row">
               <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                     <!--Slide One-->
                     <div class="item active first-slide">
                        <h1 class="title">We've all been there...<br/> <span></span></h1>
                        <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                           <img src="{{ url('/') }}/public/images/sec-two-img1.jpg" alt="Wasted hours waiting for a GP"/> 
                           <div class="caption">Wasted hours waiting for a GP</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                           <img src="{{ url('/') }}/public/images/sec-two-img2.jpg" alt="Waiting in areas infected with bacteria &amp; viruses"/>
                           <div class="caption">Waiting in areas infected with bacteria &amp; viruses</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                           <img src="{{ url('/') }}/public/images/sec-two-img3.jpg" alt="With embarrasing or awkward health questions"/>
                           <div class="caption">With embarrasing or awkward health questions</div>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-3 mar-btm thumb-img wow fadeIn">
                           <img class="height-200" src="{{ url('/') }}/public/images/sec-two-img5.jpg" alt="Sometimes we just need a quick Prescription"/>
                           <div class="caption">Sometimes we just need a quick Prescription</div>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-3 mar-btm thumb-img wow fadeIn">
                           <img class="height-200" src="{{ url('/') }}/public/images/sec-two-img4.jpg" alt="all while we'd rather be in bed"/>
                           <div class="caption">all while we'd rather be in bed</div>
                        </div>
                        <div class="col-sm-4 col-md-6 col-lg-6 thumb-img wow fadeIn">
                           <img class="height-200" src="{{ url('/') }}/public/images/sec-two-img6.jpg" alt="Which is where you can now talk to a Dr from..."/>
                           <div class="caption">Which is where you can now talk to a<br class="hidden-xs"/> Dr from...</div>
                        </div>
                     </div>
                     <!--slide two-->
                     <div class="item secound-slide">
                        <h1 class="title">We've made things very simple for you<br/> <span></span></h1>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide2-img11.png" class="img-responsive" alt="Speak privately with a Doctor via Video &amp; Chat"/>
                           <p>Speak privately with a Doctor via Video &amp; Chat</p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide2-img21.png" class="img-responsive hidden-xs" alt="Get Prescriptions, Medical Certificates &amp; Referrals"/>
                           <img src="{{ url('/') }}/public/images/slide2-img2-xs.png" class="img-responsive visible-xs" alt="Get Prescriptions, Medical Certificates &amp; Referrals"/>
                           <p>Get Prescriptions, Medical Certificates &amp; Referrals</p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide2-img31.png" class="img-responsive hidden-xs" alt="Get your Medication Delivered to you"/>
                           <img src="{{ url('/') }}/public/images/slide2-img3-xs.png" class="img-responsive visible-xs" alt="Get your Medication Delivered to you"/>
                           <p>Get your Medication Delivered to you</p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide2-img41.png" class="img-responsive hidden-xs" alt="Or ready to collect from your chosen Pharmacy"/>
                           <img src="{{ url('/') }}/public/images/slide2-img4-xs.png" class="img-responsive visible-xs" alt="Or ready to collect from your chosen Pharmacy"/>
                           <p>Or ready to collect from your chosen Pharmacy</p>
                        </div>
                     </div>
                     <!-- Slide Three-->
                     <div class="item third-slide">
                        <h1 class="title">What else can you do?<br/> <span></span></h1>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <h3>Who can you talk to?</h3>
                           <ul class="doc-specialist-list">
                              <li>Doctors</li>
                              <li>Psychologists</li>
                              <li>Counsellors</li>
                              <li>Naturopaths</li>
                              <li>Pharmacists</li>
                           </ul>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide3-img11.jpg" class="img-responsive" alt="Daily Medication Reminders"/>
                           <p>Daily Medication Reminders</p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide3-img21.jpg" class="img-responsive" alt="New Prescription &amp; Repeat Reminder"/>
                           <p>New Prescription &amp; Repeat Reminder</p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                           <img src="{{ url('/') }}/public/images/slide3-img31.jpg" class="img-responsive" alt="Measure &amp; Monitor your Health"/>
                           <p>Measure &amp; Monitor your Health</p>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <!--main container-->
               </div>
            </div>
         </div>
      </div>
      <!--for mobile start-->
      <div class="secound-sec visible-xs">
         <div class="container">
            <div class="row">
               <div class="first-slide">
                    <h1 class="title">We've all been there...<br/> <span></span></h1>
                    <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                      <div class="mobileslide1-list third-slide">
                          <ul class="doc-specialist-list">
                              <li>Wasted hours waiting for a GP</li>
                              <li>Waiting in areas infected with bacteria &amp; viruses </li>
                              <li>With embarrasing or awkward health questions</li>
                              <li>Sometimes we just need a quick Prescription</li>
                              <li>all while we'd rather be in bed</li>
                              <li>Which is where you can now talk to a<br class="hidden-xs"/> Dr from...</li>
                              
                          </ul>
                      </div>
                    </div>
                    <h1 class="title">We've made things very simple for you<br/> <span></span></h1>
                    <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                      <div class="mobileslide1-list third-slide">
                          <ul class="doc-specialist-list">
                              <li>Speak privately with a Doctor via Video &amp; Chat</li>
                              <li>Get Prescriptions, Medical Certificates &amp; Referrals</li>
                              <li>Get your Medication Delivered to you</li>
                              <li>Or ready to collect from your chosen Pharmacy</li>
                          </ul>
                      </div>
                    </div>
                    <h1 class="title">What else can you do?<br/> <span></span></h1>
                    <div class="col-sm-4 col-md-4 col-lg-4 mar-btm thumb-img wow fadeIn">
                     <div class="mobileslide1-list third-slide">
                         <ul class="doc-specialist-list">
                             <li><p> Daily Medication Reminders</p></li>
                             <li><p>New Prescription &amp; Repeat Reminder</p></li>
                             <li><p>Measure &amp; Monitor your Health</p></li>
                         </ul>
                     </div>
                      <div class="third-slide">
                        <h1 class="title">Who can you talk to?<br/> <span></span></h1>
                          <ul class="doc-specialist-list">
                              <li>Doctors</li>
                              <li>Psychologists</li>
                              <li>Counsellors</li>
                              <li>Naturopaths</li>
                              <li>Pharmacists</li>
                           </ul>
                      </div>
                    </div>
                </div>
             </div>
          </div>
      </div>
      <!--for mobile end-->
      <!--Slider End-->
      <!-- Tab Slider-->
      <div class="tab-slider">
         <div class="container">
            <div class="row">
               <h1 class="wow fadeInDown"><span>Some</span> Conditions Our Doctors Treat</h1>
               <p class="wow fadeInDown">Doctors on our platform treat most common illnesses quickly &smp; effectively through a video call from your phone, iPad or computer</p>
               <div class="tab-container wow slideInUp" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt="Some Conditions Our Doctors Treat"/> 
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
                                          <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt="Cold &amp; Flu"/>
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt="Sore Throat"/>
                                          <span></span>
                                          Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt="Eye"/>
                                          <span></span>
                                          Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt="Sports Injuries"/>
                                          <span></span>
                                          Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt="UTIs"/>
                                          <span></span>
                                          UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt="Vomiting"/>
                                          <span></span>
                                          Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt="Depression"/>
                                          <span></span>
                                          Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt="Anxiety"/>
                                          <span></span>
                                          Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt="Skin"/>
                                          <span></span>
                                          Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt="Allergies"/>
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt="Repeat Prescriptions"/>
                                          <span></span>
                                          Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt="Upper Respiratory Infection"/>
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
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt="Cold &amp; Flu"/>
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt="Sore Throat"/>
                                          <span></span>
                                          Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt="Eye"/>
                                          <span></span>
                                          Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt="Sports Injuries"/>
                                          <span></span>
                                          Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt="UTIs"/>
                                          <span></span>
                                          UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt="Vomiting"/>
                                          <span></span>
                                          Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt="Depression"/>
                                          <span></span>
                                          Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt="Anxiety"/>
                                          <span></span>
                                          Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt="Skin"/>
                                          <span></span>
                                          Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt="Allergies"/>
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt="Repeat Prescriptions"/>
                                          <span></span>
                                          Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt="Upper Respiratory Infection"/>
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
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-1.png" width="39" alt="Cold &amp; Flu"/>
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-2.png" width="52" alt="Sore Throat"/>
                                          <span></span>
                                          Sore Throat
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-3.png" width="85" alt="Eye"/>
                                          <span></span>
                                          Eye
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-4.png" width="61" alt="Sports Injuries"/>
                                          <span></span>
                                          Sports Injuries
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-5.png" width="65" alt="UTIs"/>
                                          <span></span>
                                          UTIs
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-6.png" width="85" alt="Vomiting"/>
                                          <span></span>
                                          Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-7.png" width="47" alt="Depression"/>
                                          <span></span>
                                          Depression
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-8.png" width="47" alt="Anxiety"/>
                                          <span></span>
                                          Anxiety
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-9.png" width="59" alt="Skin"/>
                                          <span></span>
                                          Skin
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-10.png" width="68" alt="Allergies"/>
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-11.png" width="54" alt="Repeat Prescriptions"/>
                                          <span></span>
                                         Repeat Prescriptions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="#">
                                          <img src="{{ url('/') }}/public/images/cat-icon-12.png" width="66" alt="Upper Respiratory Infection"/>
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
                  <div class="meet-title wow fadeInDown">Meet the Doctors &amp; Psychologists</div>
                  <div class="meet-subtitle wow fadeInDown">You'll be seen by Australian Qualified Doctors, who are fully registered and have complete indemnity insurance. Highest quality of care, with a smile :)</div>
                  <div class="row">
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.5s">
                           <div class="title-expect"><a href="#">Dr. Kristin Dean</a></div>
                           <div class="title-text">MBBS</div>
                           <div class="img-b"><img src="{{ url('/') }}/public/images/kristin-dean.png" width="250" alt="Dr. Kristin Dean"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.7s">
                           <div class="title-expect"><a href="#">Dr. Prentiss Taylor</a></div>
                           <div class="title-text">B Med Sci, MBBS</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/prentiss-taylor.png" width="250" alt="Dr. Prentiss Taylor"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="0.9s">
                           <div class="title-expect"><a href="#">Dr. Anjali Mahto</a></div>
                           <div class="title-text">MBBCh BSc MRCP (Derm)</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/anjali-mahto.png" width="250" alt="Dr. Anjali Mahto"/></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="expect-box text-center wow fadeIn" data-wow-delay="1s">
                           <div class="title-expect"><a href="#">Dr. Craig Dike</a></div>
                           <div class="title-text">Psychologist</div>
                           <div class="img-b"> <img src="{{ url('/') }}/public/images/craig-dike.png" width="250" alt="Dr. Craig Dike"/></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--what to expect-->  
      <div class="section-two textimonial text-center">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="text-center wow fadeInDown" data-wow-delay="0.2s">Meet our Users</h1>
                  <p class="sub-title wow fadeInDown" data-wow-delay="0.4s"> Everyday Australians, who love the convenience of doctoroo.</p>
                  <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                     <!-- Bottom Carousel Indicators -->
                     <ol class="carousel-indicators wow zoomIn" data-wow-delay="0.6s">
                        <li data-target="#quote-carousel" data-slide-to="0"><img class="img-responsive " src="{{ url('/') }}/public/images/testi-profile-1.png" alt="Meet our Users"/></li>
                        <li data-target="#quote-carousel" data-slide-to="1" class="active"><img class="img-responsive" src="{{ url('/') }}/public/images/testi-profile.png" alt="Meet our Users"/></li>
                        <li data-target="#quote-carousel" data-slide-to="2" class="last-carsol"><img class="img-responsive" src="{{ url('/') }}/public/images/testi-profile-2.png" alt="Meet our Users"/></li>
                     </ol>
                     <!-- Carousel Slides / Quotes -->
                     <div class="carousel-inner text-center wow fadeInDown" data-wow-delay="0.5s">
                        <!-- Quote 1 -->
                        <div class="item">
                           <blockquote>
                              <div class="row">
                                 <div class="col-sm-10 col-md-10 col-lg-10 col-sm-offset-1">
                                    <p>"I don's miss sitting in the waiting room with all the sick, sneezy people."</p>
                                    <small>Aleandra</small>
                                 </div>
                              </div>
                           </blockquote>
                        </div>
                        <!-- Quote 2 -->
                        <div class="item active">
                           <blockquote>
                              <div class="row">
                                 <div class="col-sm-10 col-md-10 col-lg-10 col-sm-offset-1">
                                    <p>"I don's miss sitting in the waiting room with all the sick, sneezy people."</p>
                                    <small>Aleandra</small>
                                 </div>
                              </div>
                           </blockquote>
                        </div>
                        <!-- Quote 3 -->
                        <div class="item">
                           <blockquote>
                              <div class="row">
                                 <div class="col-sm-10 col-md-10 col-lg-10 col-sm-offset-1">
                                    <p>"I don's miss sitting in the waiting room with all the sick, sneezy people."</p>
                                    <small>Aleandra</small>
                                 </div>
                              </div>
                           </blockquote>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="client-logo">
         <div class="container">
            <div class="doctorlogo-title">Your Local Pharmacies with doctoroo</div>
            <div class="client_slider">
               <center>  Coming Soon!</center>
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
                        <div class="doc-mobile-call"></div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-7 col-lg-8">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h2>See a Doctor Today, Wherever you are</h2>
                        <span>How much does it cost?</span>
                        <div class="connct-doc">Consultations are very affordable at $24 for 4 minutes, and just $10 for every 4 minutes after that. Just add $20 for anytime aftershours (from 8pm -  8am)
                           <span>All other app features are free for you to use (no astericks!)</span>
                        </div>
                        <?php
                        $user = Sentinel::check();
                        if($user==null){ ?>
                        <button type="button" class="btn-grn" href="#signup" data-toggle="modal">See a Doctor Now<span class="co-so">(coming Soon)</span></button>
                        <div class="app-download">
                           <div class="txt-ap">OR DOWNLOAD OUR free APPS(Coming Soon) </div>
                           <div class="btn-two-for">
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt="App Store"/></a>
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
      <!--download app today-->      
      <!-- Footer top company logo start here      -->
      <div class="client-section">
         <div class="container">
            <div class="doctorlogo-title">In the Press</div>
            <div class="row">
               <center>  Coming Soon!</center>
            </div>
         </div>
      </div>
      <?php $currentUrl  = Route::getCurrentRoute()->getPath();
      if($currentUrl=='home'){?>      
      <script>
      $(document).ready(function(){
        $('#open_signup').click();
      });
      </script>
      <?php } ?>
@stop    
