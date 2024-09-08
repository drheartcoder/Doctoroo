@extends('front.layout.master-coming-soon')                
@section('main_content')
 <div class="banner-home">
          <div class="covermask"></div>
         <video id="my-video" class="video home-slider" autoplay="autoplay" preload="auto" loop="loop" muted="" width="100%" tabindex="0">
            <source src="{{ url('/') }}/public/video/homepagevid1.mp4" type="video/mp4" />
            <source src="{{ url('/') }}/public/video/homepagevid1.ogv" type="video/ogv" />
            <source src="{{ url('/') }}/public/video/homepagevid1.ogg" type="video/ogg" />
            <source src="{{ url('/') }}/public/video/homepagevid1.webm" type="video/webm" />
         </video>
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-10">
                  <div class="banner-home-box">
                     <h1 class="wow fadeInDown" data-wow-delay="0.2s"><span>See Qualified Australian Doctors.</span></h1>
                     <h4 class="wow fadeInDown" data-wow-delay="0.4s">Anytime. Anywhere.</h4>
                     <button type="button" class="btn-grn wow zoomInUp scrolld" data-wow-delay="0.5s" >Sign up for free</button>
                     <div class="app-download wow fadeInDown" data-wow-delay="0.4s">
                        <div class="btn-two-for hidden-xs">
                           <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt="App Store"/></a>
                           <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>          
      </div>
      <!--  We've All Been There...-->
      <div class="secound-sec">
         <div class="container">
            <div class="row">
                <h2 class="title">We've all been there...</h2>
                <div class="owl-carousel owl-theme features">
            <div class="item">
              <div class="circle">
                  <img src="{{ url('/') }}/public/images/feature-circle-1.jpg" alt="Wasted hours travelling to &amp; waiting for a doctor..."/>
                  <div class="circle-content">Wasted hours travelling to &amp; waiting for a doctor...</div>
               </div>
            </div>
            <div class="item">
              <div class="circle">
                  <img src="{{ url('/') }}/public/images/feature-circle-2.jpg" alt="In clinics infected with harmful viruses &amp; bacteria..."/>
                  <div class="circle-content">In clinics infected with harmful viruses &amp; bacteria...</div>
               </div>
            </div>
            <div class="item">
              <div class="circle">
                  <img src="{{ url('/') }}/public/images/feature-circle-3.jpg" alt="With embarrassing or uncomfortable questions..."/>
                  <div class="circle-content">With embarrassing or uncomfortable questions...</div>
               </div>
            </div>
            <div class="item">
             <div class="circle">
                        <img src="{{ url('/') }}/public/images/feature-circle-4.jpg" alt="Sometimes we just need a prescription or certificate..."/>
                        <div class="circle-content">Sometimes we just need a prescription or certificate...</div>
                        </div>
            </div>
            <div class="item">
             <div class="circle">
                        <img src="{{ url('/') }}/public/images/feature-circle-5.jpg" alt="All while we'd rather be elsewhere..."/>
                        <div class="circle-content">All while we'd rather be elsewhere...</div>
                    </div>
            </div>
            
          </div>
            </div>
         </div>
      </div>
      <!--Slider End-->
       
     
    <div class="whatisdoc-sec">
         <div class="container">
            <div class="row">
                <h2 class="title">What is doctoroo?</h2>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="facility">
                       <div class="image"> <img src="{{ url('/') }}/public/images/what-is-doctoroo-img1.png" width="327" alt="Easiest way to see a Doctor"/></div>
                        <h3>Easiest way to see a Doctor</h3>
                        <p>Caring doctors ready to see you in as little as a few minutes. Simply make an account and begin your journey to better health.</p>
                        </div>
                         </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="facility">
                        <div class="image"> <img src="{{ url('/') }}/public/images/what-is-doctoroo-img2.png" width="213" alt="Ready When you need it Most"/></div>
                        <h3>Ready When you need it Most</h3>
                        <p>Whether you need a prescription, medical certificate, referral or just to simply get advice and treatment, doctoroo is for you.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="facility">
                        <div class="image"><img src="{{ url('/') }}/public/images/what-is-doctoroo-img3.png" width="260" alt="Available Anywhere, on Any Device"/></div>
                        <h3>Available Anywhere, on Any Device</h3>
                        <p>Our mission is to deliver quality healthcare to every Australian, without device, time, language or location limits.</p>
                        </div>
                    </div>
                   <button type="button" class="btn-grn wow zoomInUp slideI" data-wow-delay="0.5s">What else can you do? <i class="fa fa-long-arrow-right"></i></button> 
            </div>
         </div>
      </div>   
       
      <!-- Tab Slider-->
      <div class="tab-slider">
         <div class="container">
            <div class="row">
               <h2 class="wow fadeInDown center_title">How can doctoroo help you?</h2>
               <div class="tab-container wow slideInUp hidden-xs" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt="How can doctoroo help you?"/> 
                  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators tab-nav">
                        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel2" data-slide-to="1"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="item active first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/acne.png" width="70" alt="Acne"/> 
                                          <span></span>
                                          Acne
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/advice-treatment.png" width="70" alt="Advice & Treatment"/>
                                          <span></span>
                                          Advice & Treatment
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-digestion.png" width="70" alt="Stomach Digestion"/> 
                                          <span></span>
                                          Stomach Digestion
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/allergies.png" width="70" alt="Allergies"/> 
                                          <span></span>
                                          Allergies
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/asthma.png" width="70" alt="Asthma"/> 
                                          <span></span>
                                          Asthma
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cold-flu.png" width="70" alt="Cold &amp; Flu"/> 
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/diarrhoea-vomiting.png" width="70" alt="Diarrhoea Vomiting"/> 
                                          <span></span>
                                          Diarrhoea Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/ear-problems.png" width="70" alt="Ear Problems"/> 
                                          <span></span>
                                          Ear Problems
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/eye-problems.png" width="70" alt="Eye Problems"/>
                                          <span></span>
                                          Eye Problems
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/fever.png" width="70" alt="Fever"/>
                                          <span></span>
                                          Fever
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/hair-loss.png" width="70" alt="Hair Loss"/>
                                          <span></span>
                                          Hair Loss
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/headaches-migraines.png" width="70" alt="Headaches Migraines"/> 
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/itis.png" width="70" alt="Itis"/> 
                                          <span></span>
                                          Itis
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/joint-pain.png" width="70" alt="Joint Pain"/>
                                          <span></span>
                                          Joint Pain
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/mental-health.png" width="70" alt="Mental Health"/>
                                          <span></span>
                                          Mental Health
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/omitting.png" width="70" alt="Omitting"/>
                                          <span></span>
                                          Omitting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/pregnancy.png" width="70" alt="Pregnancy"/>
                                          <span></span>
                                          Pregnancy
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/respiratory-iIs-bronchitis.png" width="70" alt="Respiratory iIs Bronchitis"/>
                                          <span></span>
                                          Respiratory iIs Bronchitis
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/sexual-health.png" width="70" alt="Sexual Health"/>
                                          <span></span>
                                          Sexual Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/skin-conditions.png" width="70" alt="Skin Conditions"/>
                                          <span></span>
                                          Skin Conditions
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-cramps.png" width="70" alt="Stomach Cramps"/>
                                          <span></span>
                                          Stomach Cramps
                                       </a>
                                    </li>
                                     <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/prescriptions-repeats.png" width="70" alt="Prescriptions Repeats"/>
                                          <span></span>
                                          Prescriptions Repeats
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/and-many-more.png" width="70" alt="And Many More"/>
                                          <span></span>
                                          And Many More
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/what-we-cant-treat-yet.png" width="70" alt="What we can’t treat yet"/>
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
                     
                  </div>
               </div>
                
                <div class="tab-container wow slideInUp visible-xs" data-wow-delay="0.7s">
                  <img src="{{ url('/') }}/public/images/tab-slider.png" class="tab-bg img-responsive visible-lg" alt="tab-slider"/>
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     
                     <div class="carousel-inner">
                        <div class="item active first-slide">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 margin-0">
                                 <ul class="category">
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/acne.png" width="70" alt="Acne"/>
                                          <span></span>
                                          Acne
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/advice-treatment.png" width="70" alt="Advice & Treatment"/>
                                          <span></span>
                                          Advice & Treatment
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-digestion.png" width="70" alt="Stomach Digestion"/>
                                          <span></span>
                                          Stomach Digestion
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/allergies.png" width="70" alt="Allergies"/>
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/asthma.png" width="70" alt="Asthma"/>
                                          <span></span>
                                          Asthma
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/cold-flu.png" width="70" alt="Cold &amp; Flu"/>
                                          <span></span>
                                          Cold &amp; Flu
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/diarrhoea-vomiting.png" width="70" alt="Diarrhoea Vomiting"/>
                                          <span></span>
                                          Diarrhoea Vomiting
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/ear-problems.png" width="70" alt="Ear Problems"/>
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/eye-problems.png" width="70" alt="Eye Problems"/>
                                          <span></span>
                                          Eye Problems
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/fever.png" width="70" alt="Fever"/>
                                          <span></span>
                                          Fever
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/hair-loss.png" width="70" alt="Hair Loss"/>
                                          <span></span>
                                          Hair Loss
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/headaches-migraines.png" width="70" alt="Headaches Migraines"/>
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/itis.png" width="70" alt="Itis"/>
                                          <span></span>
                                          Itis
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/joint-pain.png" width="70" alt="Joint Pain"/>
                                          <span></span>
                                          Joint Pain
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/mental-health.png" width="70" alt="Mental Health"/>
                                          <span></span>
                                          Mental Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/omitting.png" width="70" alt="Omitting"/>
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/pregnancy.png" width="70" alt="Pregnancy"/>
                                          <span></span>
                                          Pregnancy
                                       </a>
                                    </li>
                                    <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/respiratory-iIs-bronchitis.png" width="70" alt="Respiratory iIs Bronchitis"/>
                                          <span></span>
                                          Respiratory iIs Bronchitis
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/sexual-health.png" width="70" alt="Sexual Health"/>
                                          <span></span>
                                          Sexual Health
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/skin-conditions.png" width="70" alt="Skin Conditions"/>
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
                                          <img src="{{ url('/') }}/public/images/ipad_icons/stomach-cramps.png" width="70" alt="Stomach Cramps"/>
                                          <span></span>
                                          Stomach Cramps
                                       </a>
                                    </li>
                                     <li class="cat-box green-color">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/prescriptions-repeats.png" width="70" alt="Prescriptions Repeats"/>
                                          <span></span>
                                          Prescriptions Repeats
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/and-many-more.png" width="70" alt="And Many More"/>
                                          <span></span>
                                          And Many More
                                       </a>
                                    </li>
                                    <li class="cat-box">
                                       <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/ipad_icons/what-we-cant-treat-yet.png" width="70" alt="What we can’t treat yet"/>
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
      <div class="app-download-section">
         <div class="bag-ligt" id="register">
            <div class="container">
               <div class="row">
                  <div class="hidden-xs hidden-sm col-md-5 col-lg-4 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/download-app-today.png" alt="download app today"/>
                         <div class="doc-mobile-call"><img src="{{ url('/') }}/public/images/video-img.jpg" alt="video img"/></div>
                     </div>
                  </div>
                     <div class="visible-xs col-md-6 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/download-app-today.png" width="333" alt="download app today"/>

                         <div class="doc-mobile-call">
                         <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h2>Make an account for our prelaunch offer!</h2>
                        <span>Recieve $10 credit when you sign up &amp; invite a friend today!</span>
                        
                        <button type="button" class="btn-grn" data-toggle="modal" href="#signup-voucher">Sign up for free</button>
                        <div class="app-download">
                           <div class="btn-two-for">
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt="App Store"/></a>
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                            <div class="txt-ap">Our Free app is coming soon! </div>
                        </div>
                     </div>
                         </div>
                     </div>
                  </div>
                   
                  <div class="col-sm-12 col-md-7 col-lg-8 hidden-xs">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h2>Make an account for our prelaunch offer!</h2>
                        <span>Recieve $10 credit when you sign up &amp; invite a friend today!</span>
                        
                         <div class="row"><div class="connct-doc col-sm-12 col-md-12 col-lg-11">We know doctoroo will be loved by Australians, which is why we're offering you $10 credit to use during your next consult - all you need to do is signup &amp; invite a friend.</div></div>
                        <button type="button" id="btn_signup" class="btn-grn" data-toggle="modal" href="#signup-voucher">Sign up for free</button>
                        <div class="app-download">
                           
                           <div class="btn-two-for">
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt="App Store"/></a>
                              <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                            <div class="txt-ap">Our Free app is launching soon! </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<script>
   $(document).ready(function() {
      $('.scrolld').click(function(){
         $("html, body").animate({ scrollTop: $(document).height()-parseInt(1100) }, 1000);
      });

      $('.slideI').click(function(){
         $("html, body").animate({ scrollTop: $(document).height()-parseInt(1900) }, 1000);
      });

      var url = window.location.hash;
      if(url != '')
      {
         $("html, body").animate({ scrollTop: $(document).height()-parseInt(1100) }, 1000);
      }
   });
</script>
@stop    
