@extends('front.layout.master-coming-soon')                
@section('main_content')

<style>
   .highlight-pharma-row
   {
      background:#eee;
       outline: none;
       padding: 5px 0 5px 10px;
   }
   .pharmcy-hide-div {
    padding: 25px 0 30px;
}
</style>

<script>
$(document).ready(function(){
   $('#sign_up_pharmacy').click(function(){
      $('.login_close').click();
   });
   $('#sign_up_pharmacy_footer').click(function(){
      $('.login_close').click();
   });
   $('#pharmacy_register_id, #join_pharmacy, #sign_up_pharmacy, #sign_up_pharmacy_footer').click(function(){
      $('#banner_text_id').hide();
      $('#div_pharmacy_signup').slideDown( "slow", function() {         
         $('#bannner_div_id').hide();
         initialize();
      });
   });
});
</script>

      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/ph_banner.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">

         <div class="grrn-strip hidden-lg" id="banner_text_id" <?php if(array_key_exists('search_term', $_GET)){echo 'style="display:none;"';}else{echo 'style="display:block;"';} ?>>
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-8 col-lg-7">
                     <div class="doc-reg">
                        Join the future of Australian Healthcare!
                     </div>
                  </div>
                  <!-- <?php $user = Sentinel::check(); ?>
                  @if($user==false)
                  <div class="col-sm-6 col-md-4 col-lg-5 join-regi-btn">
                    <button class="doc-reg-btn " onclick="openLoginModal()">Pharmacy Login</button>
                    <button class="doc-reg-btn" onclick="gotoPharmacysignup()">Register Your Pharmacy</button>
                  </div>
                  @else
                    <div class="col-sm-3 col-md-3 col-lg-2">&nbsp;</div>
                  @endif -->
               </div>
            </div>
         </div>
         <!-- start pharmacy register div -->
         <div class="pharmacy-signup-bx" id="div_pharmacy_signup" <?php if(array_key_exists('search_term', $_GET)){echo 'style="display:block;padding:0;" ';}else{echo 'style="display:none;padding:0;" ';} ?>> 
         <div style="background-repeat:no-repeat;
         -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;" class="banner-home inner-page-box">
         <div class="bg-shaad inner-page-shaad">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-home-box pharma-reg">
                        <h1> Pharmacy Signup</h1>
                        <div class="bor-light">&nbsp;</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="pharmcy-hide-div">
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
                      {{--<input type="hidden" name="pharmacy_id" id="pharmacy_id" /> --}}
                      {{-- <input type="hidden" name="suburb" id="suburb" /> --}}
                     <span> <button class="pharna-search-btn">Search</button></span>
                  </div>
               </form>
                  <div class="left-map-section mobile-height" id="content-d1">
                     <div class="chatting-section">
                       <?php
                           $arr_claim_id = [];
                        ?>
                     <?php $i=0;?>
                     @if(isset($arr_search_location) && sizeof($arr_search_location)>0)
                        @foreach($arr_search_location as $pharmacy)
                        
                         
                           <div class="pharma-row pharmacy_div pharmacy_{{ $pharmacy['id'] }}" tabindex='1'>
                              <div class="row">
                                 <div class="col-sm-7 col-md-6 col-lg-7">

                                  @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')
                                    <div class="disable-home-icon"> 
                                    <i class="fa fa-home"></i></div>
                                  @else
                                    <div class="home-icon"> 
                                    <i class="fa fa-home"></i></div>
                                  @endif
                                


                                    <div class="pharmcy-detail-bx">

                                       <a style="cursor: pointer;" onclick="highlightMarker('{{ $i }}','{{$pharmacy['id']}}');">
                                       
                                        @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')
                                            
                                         {{isset($pharmacy['pharmacy_applications']['pharmacy_name'])?$pharmacy['pharmacy_applications']['pharmacy_name']:''}}
                                        @else
                                         {{ isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:' ' }}
                                        @endif

                                       </a>

                                       <input type="hidden" name="pharmacy_id" id="pharmacy_id" value="{{ $pharmacy['id'] }}">
                                       <div class="pharna-add">

                                        @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')

                                           {{ isset($pharmacy['pharmacy_applications']['address2'])?$pharmacy['pharmacy_applications']['address2']:' ' }}

                                        @else
                                          {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                                        @endif


                                          <br/>

                                          @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')

                                             {{ isset($pharmacy['pharmacy_applications']['address1'])?$pharmacy['pharmacy_applications']['address1']:' ' }}
                                          
                                          @else

                                           {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                                          @endif
                                       </div>

                                    </div>
                                 </div>
                               
                                 <div class="col-sm-5 col-md-6 col-lg-5">
                                    <div class="pharma-btns">
                                       <button class="details-btn" onclick="getDetails('{{ $pharmacy['id'] }}');">
                                       Details</button>
                                    @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')
                                        
                                        <?php
                                          array_push($arr_claim_id,$pharmacy['id']);
                                        ?>
                                       <button class="details-btn disabled-btn"  disabled="">Already claimed</button>

                                    @else
                                      
                                       <button onclick="goToSignUpPage('{{ base64_encode($pharmacy['id']) }}')" class="details-btn select-btn">claim pharmacy</button>
                                    @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
   
                        <div id="pharmacy_detail_{{$pharmacy['id']}}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
                           <div class="modal-dialog loign-insw">
                              <!-- Modal content-->
                              <div class="modal-content logincont">
                                 <div class="modal-header head-loibg">
                                    <button type="button" class="login_close close" onclick="setHighlightPharmacy('{{$pharmacy['id']}}')" data-dismiss="modal">&times;</button>
                                 </div>
                                 <div class="modal-body bdy-pading">
                                     <div class="login_box">
                                      <div class="title_login">Pharmacy Details</div>
                                       <div class="forget-txt bb-head">
                                      
                                      @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')

                                         {{isset($pharmacy['pharmacy_applications']['pharmacy_name'])?$pharmacy['pharmacy_applications']['pharmacy_name']:''}}

                                       @else
                                        
                                        {{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}}

                                      @endif


                                       </div>
                                       <div class="forget-txt">
                                         <div class="popup-icns">
                                          <img src="{{url('/')}}/public/images/marker.jpg" width="20px" />
                                          </div>
                                          <div class="popup-details-content">
                                            <div class="forget-txt">  
                                          @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')

                                           {{ isset($pharmacy['pharmacy_applications']['address2'])?$pharmacy['pharmacy_applications']['address2']:' ' }}
                                            
                                            <br/>
                                           
                                           {{ isset($pharmacy['pharmacy_applications']['address1'])?$pharmacy['pharmacy_applications']['address1']:' ' }}

                                          @else
                                            {{ isset($pharmacy['location'])?$pharmacy['location']:'--' }}
                                            <br/>
                                            {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:'--' }}

                                          @endif
                                          </div>  
                                         </div>
                                         <div class="clearfix"></div>
                                            <div class="popup-icns">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            </div>
                                            <div class="popup-details-content">
                                              @if(isset($pharmacy['pharmacy_applications']) && $pharmacy['pharmacy_applications']!='')

                                                  {{ isset($pharmacy['pharmacy_applications']['phone'])?$pharmacy['pharmacy_applications']['phone']:'--' }}
                                              @else
                                                 {{ isset($pharmacy['phone_no'])?$pharmacy['phone_no']:'--' }}
                                              @endif
                                            </div>
                                       </div>  
                                       <div class="clearfix"></div>
                                      <br/>
                                   </div>
                                </div>
                              </div>
                           </div>
                         </div>

                         <?php $i++;?>
                        @endforeach
                     @else
                           {{ 'Pharmacies are not available' }}
                     @endif
                       <input type="hidden" id="arr_claim" name="arr_claim" value="{{ json_encode($arr_claim_id, false) }}">
                     </div>
                  </div>

                  <div class="cant-find-txt">
                     Cant't find your Pharmacy?
                  </div>
                  <button onclick="goToSignUpPage('')" class="signup-pharma">
                  Signup your Pharmacy from Scratch</button>

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
                              <span><i class="fa fa-home"></i></span> Unclaimed Pharmacy
                           </div>
                           <div class="key-details">
                              <span><i class="fa fa-home"></i></span> Claimed Pharmacy already on Doctoroo
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
         </div>
         <!-- end pharmacy register div -->
         <div class="join-bg" id="bannner_div_id" <?php if(array_key_exists('search_term', $_GET)){echo 'style="display:none;"';}else{echo 'style="display:block;"';} ?>>
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-7">
                     <div class="join-banner">
                         @include('front.layout._operation_status')
                        <h1 class="wow fadeInDown" data-wow-delay="0.2s">Amaze Your Customers, Grow Your Pharmacy.</h1>
                        <h4 class="wow fadeInDown" data-wow-delay="0.4s">The Future of Pharmacies Belongs With You.</h4>
                        <?php
                           $user = Sentinel::check();
                        ?>
                        @if($user==null)
                            <!-- <button type="button" class="btn-grn wow zoomInUp" data-wow-delay="0.5s" id="join_pharmacy"> -->
                            <button type="button" class="btn-grn wow zoomInUp" data-wow-delay="0.5s" onclick="gotoPharmacysignup()">
                               Join As Pharmacy
                            </button>
                            <div class="app-download wow fadeInDown" data-wow-delay="0.4s">
                               <div class="txt-ap">OR DOWNLOAD OUR Free APP Coming soon...! </div>
                               <div class="btn-two-for">
                                  <!-- <a href="#app-comingsoon" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a> -->
                                  <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                                  <a href="javascript:void(0);" data-toggle="modal"><img src="{{ url('/') }}/public/images/google-play.png" alt=""/></a>
                               </div>
                            </div>
                        @endif
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-7">
                     <div class="banner-home-box-join visible-lg">&nbsp;</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard menu-->
      <!--banner section start-->
     

      <!--banner section end-->
      <!--what doc section start-->
      <div class="what-doc-section">
         <div class="container">
            <div class="row" style="position:relative;">
               <h1 class="wow fadeInDown"> What is doctoroo?</h1>
               <div class="head-btm"></div>
               <p class="wow fadeInDown">An innovative telehealth and medication management platform that empowers doctors to treat patients online and enables pharmacies to manage their patients' medications, effectively and conveniently.</p>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/ph1.jpg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown"> Medication management made easy</h3>
                     <div class="dc-content wow fadeInUp">
                        As a pharmacy, there's only one thing more important than selling helpful medication - and that's ensuring your patients are properly taking their medication. doctoroo makes adherence as easy as it should have always been.
                     </div>
                  </div>
               </div>
               <div class="ver-divider"></div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="dc-bx">
                     <div class="dc-img wow zoomIn">
                        <img src="{{ url('/') }}/public/images/ph2.jpeg" alt="img"/>
                     </div>
                     <h3 class="wow fadeInDown"> A service your customers can't ignore</h3>
                     <div class="dc-content wow fadeInUp">
                        The effectiveness of doctoroo is partly due to the benefits it brings customers - saving them time, improving their health boosting their quality of life. Ultimately, they'll love you for it.
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
               <h1 class="wow fadeInDown">Take your pharmacy to where your customers are - online.</h1>
               <div class="head-btm"></div>
               <div class="col-sm-12 col-md-6 col-lg-6 wow zoomIn">
                  <div class="online-left">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/ph3.jpeg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.2s">
                     <h3>Customers are busy & expect convenience</h3>
                     <p>Its well known that to be competitive, you must service and exceed the expectations of your customers.</p>
                     <p>
                        With work, family and other commitments, customers have become extremely time-poor or may have difficulty travelling to the pharmacy or doctor - just some of the reasons why the adherence of medication is affected.
                     </p>
                     <p>With almost the entire population now using mobile and other devices daily, being an effetive pharmacy today assumes that you are where your patients are - online.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6 pull-right">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/ph4.jpeg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6 pull-left">
                  <div class="online-right wow fadeIn" data-wow-delay="0.4s">
                     <h3>Attract these customers & win their loyalty</h3>
                     <p>With industry competition surging, staying relevant & valuable is dependent on winning the loyalty of as many customers as possible.</p>
                     <p>doctoroo's integrated platform and innovative features (below) enables you to offer convenience, speed and reliability that your customers will genuinely thank you for.</p>
                     <div class="fb-tag">
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-left wow zoomIn">
                     <img class="img-responsive" src="{{ url('/') }}/public/images/ph5.jpg" alt="img"/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="online-right wow fadeIn" data-wow-delay="0.6s">
                     <h3>Privacy, safety & security</h3>
                     <p>Doctoroo was developed and is constantly being advanced with crucial input from innovative and respected healthcare professionals including doctors, pharmacists and medical scientists.</p>
                     <p>Our platform is Australian healthcare legislation-compliant, is stored in Australia in highly secured data centres.</p>
                     <p>Our platform has earned high reviews from both practitioners and patients a like. The effectiveness of telemedicine has also been evaluated in everal major cliical studies...</p>
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
               <h1 class="wow fadeInDown">Benefits for you</h1>
               <br/>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="0.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit1.png" alt="img" />
                     <div class="benifit-content">
                        Gain more customers & their loyalty
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="0.4s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit2.png" alt="img" />
                     <div class="benifit-content">
                        More Rix volume with existing patients
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="0.6s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit5.png" alt="img" />
                     <div class="benifit-content">
                        Increased revenue & business growth
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="0.8s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit5.png" alt="img" />
                     <div class="benifit-content">
                        Reduce waiting time for patients in your pharmacy
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="1s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit4.png" alt="img" />
                     <div class="benifit-content">
                        Offer an online doctor service in-store
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="1.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit3.png" alt="img" />
                     <div class="benifit-content">
                        Relevance & competitiveness in the industry
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="1.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit6.png" alt="img" />
                     <div class="benifit-content">
                        Ehanced workflow effciency & less stressed staff
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3 col-lg-3 wow fadeIn" data-wow-delay="1.2s">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit6.png" alt="img" />
                     <div class="benifit-content">
                        Increase patient medication adherence & script refilling rate
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
               <h1> Some of doctoroo's most loved features</h1>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="blue-bxx wow fadeInDown" data-wow-delay="0.2s">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Click & Collect
                        <p class="sm-txt" style="padding: 0px;">
                          Patients place their order & once you've accepted & prepared it, they simply collect it in-store.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.4s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Medication reminders
                        <p class="sm-txt" style="padding: 0px;">
                          Customers can set reminders & be notified to take their medication throughout the day.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.6s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Delivery (invitation only)
                        <p class="sm-txt" style="padding: 0px;">
                          Deliver nation wide, where a courier collects the order from your pharmacy in just one click.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="0.8s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Prescription & order history
                        <p class="sm-txt" style="padding: 0px;">
                          Customers can view all their previous prescriptions and get new prescriptions by seeing a doctor on doctoroo.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Medication Management
                        <p class="sm-txt" style="padding: 0px;">
                          Customers enter their medication, upload prescriptions and simply reorder when required.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 wow fadeInDown" data-wow-delay="1.2s">
                  <div class="blue-bxx">
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="img"/>
                     </div>
                     <div class="bg-txt" style="padding: 0px;">
                        Message & notify customers
                        <p class="sm-txt" style="padding: 0px;">
                          Easily send a message to your customers via doctoroo -improve service & loyalty.
                        </p>
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
      <div class="app-download-section ph_footer">
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
                        <h1>Want to join the future of healthcare?</h1>
                        <span>Become a part of the team of pharmacies who will shape tomorrows health, today.</span>
                        <div class="connct-doc">After submitting your interest, we'll contact you to discuss any questions you may have and to complete registration.
                        </div>
                        <?php
                          $user = Sentinel::check();
                        ?>

                        @if($user==null)
                          <button type="button" class="btn-grn" href="javascript:void(0);" onclick="gotoPharmacysignup()">Register Your Pharmacy</span></button>
                          <div class="app-download">
                             <div class="txt-ap"><span>Our app is coming soon - </span><br/>Practice medicine from any device </div>
                             <div class="btn-two-for">
                                <a data-toggle="modal" href="javascript:void(0);"><img src="{{ url('/') }}/public/images/appstor.png" alt=""/></a>
                                <a data-toggle="modal" href="javascript:void(0);"><img src="{{ url('/') }}/public/images/google-play.png" alt=""/></a>
                             </div>
                          </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--download app today-->      
      <!-- Footer top company logo start here      -->

      <input type="hidden" id="arr_map_location" value="{{ (isset($arr_search_location))? json_encode($arr_search_location): json_encode(array()) }}">

      <!-- Footer top company logo End here      -->       
      <!--footer-->
      <!-- custom scrollbars plugin -->
      <!-- custom scrollbars plugin -->

      <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <!-- custom scrollbar plugin -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

   


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
      <script  src="{{ url('/') }}/public/js/jquery-ui.js"></script> 
      <script>
         
      var markers  = [];
         $(document).ready(function() {

                 initialize();
         });

         /*get listing of all suburb & postcode*/
        $("input[name='search_term']").autocomplete(
        {
            
            minLength:3,
            extraParams: {
               country: 'Australia'
            },       
            source:"{{ $module_url_path }}/location_listing",
            search: function () {
                 showProcessingOverlay();
             },
             response: function () {
               hideProcessingOverlay();
            },
            select:function(event,ui)
            {
               
            }
         });
            
         $('#frm_search_pharmacy').submit(function(){
               showProcessingOverlay();
         })
        
         function initialize()
         {

               var arr_json_claim          = $('#arr_claim').val();

               var arr_claim               = JSON.parse(arr_json_claim);
              
               var icon               = '';
               var id                 = ''; 
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


              for(var lat_long in arr_lat_long) 
              {
                   
                  var data          = arr_lat_long[lat_long];
                 
                  id               = data.id; 
                  /* show differnt icon for claimed & un cliamed pharmacy */
                   if($.inArray(id,arr_claim )>-1)
                   {
                       icon = {
                                         url: site_url+'/images/map-gray-icon.png', 
                                     };
                   }
                   else
                   {
                      icon  =   {
                                      url: site_url+'/images/map-green-icon.png', 
                                };
                   }


                 
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

                        if(data.pharmacy_applications!='' && data.pharmacy_applications!=null)
                        {
                              var pharmacy_name  = data.pharmacy_applications.pharmacy_name;
                        }
                        else
                        {
                             var  pharmacy_name  = data.pharmacy_name;
                        }

                        google.maps.event.addListener(marker, "click", function (e) 
                        {
                           getDetails(data.id);
                           infoWindow.setContent(pharmacy_name);
                           infoWindow.open(map, marker);
                           setHighlightPharmacy(data.id);
                        });
                   })(marker, data);
                    markers.push(marker);
               }
                         
               map.setCenter(latlngbounds.getCenter());
               map.fitBounds(latlngbounds);

                

         }  
         
          function highlightMarker(index,ref)
          {

              google.maps.event.trigger(markers[index], 'click');
          }
         function setHighlightPharmacy(elem)
         {
            $('.pharmacy_div').removeClass('highlight-pharma-row');
            $('.pharmacy_'+elem).removeClass('pharma-row');
            $('.pharmacy_'+elem).addClass('highlight-pharma-row');

            setTimeout(function(){
               $('.pharmacy_'+elem).focus();

              },1000);

           
         }
         function goToSignUpPage(ref)
         {  

             swal({
                title: "Are you sure?",
                text: "Do you want to proceed for signup?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
               
                
             },

              function(isConfirm)
              {
                 if (isConfirm)
                 {
                      var token = Math.floor(100000 + Math.random() * 900000);
                      showProcessingOverlay();
                       if(ref!='')
                       {

                          var url = '{{ $module_url_path }}/signup_step1/'+btoa(token)+'/'+ref;
                         
                       }
                       else
                       {
                          var url = '{{ $module_url_path }}/signup_step1/'+btoa(token);
                      
                       }
                       window.location.href = url;
                  }
               });
         }
         function openLoginModal()
         {
               $('#pharmacy-signin-modal').modal('show');

         }
         function getDetails(ref)
         {
             $('#pharmacy_detail_'+ref).modal('show');
         
         }

        function gotoPharmacysignup()
        {
          var token = Math.floor(100000 + Math.random() * 900000);
          showProcessingOverlay();
          var url = '{{ $module_url_path }}/signup_step1/'+btoa(token);
          window.location.href = url;
        }
        
      </script>
      <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY"></script> 
@stop