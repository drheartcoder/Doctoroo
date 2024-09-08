@extends('front.layout.master-coming-soon')                
@section('main_content')
      <!-- -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;-->
      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/pricing-bg.jpg'); background-repeat:no-repeat;background-attachment: fixed; background-position: center top;">
         <div class="pricing-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pricing-banner">
                        <h1>{{ isset($info['title'])?$info['title']:'' }}</h1>
                        <h3> {{ isset($info['subtitle'])?$info['subtitle']:'' }}</h3>
                        <button class="see-doctr-btn" href="#signup-voucher" data-toggle="modal" type="button" > See a Doctor</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--pricing plans section start-->
      <div class="daynamic-plan">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="dynamic-right-bx">
                     <div class="pln-left dynamic-left wow zoomIn">
                        <img class="img-resize" src="{{ url('/') }}/public/images/daynamic1.png" alt="Doctor App"/>
                     </div>
                  </div>
                  <div class="dynamic-left-bx pln-right wow fadeInLeft">
                     <h4 class="daynamic-heading">{{ isset($info['title1'])?$info['title1']:'' }}</h4>
                     <p>{!! $info['description1'] !!}</p>
                  </div>
               </div>
            </div>
            <div class="pln-divider"></div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="dynamic-right-bx1">
                     <div class="pln-left  wow zoomIn">
                        <img class="img-resize" src="{{ url('/') }}/public/images/daynamic2.png" alt="Online Doctor Chat"/>
                     </div>
                  </div>
                  <div class="dynamic-left-bx1 pln-right wow fadeInRight">
                     <h4 class="daynamic-heading">{{ isset($info['title2'])?$info['title2']:'' }}</h4>
                     <p>{!! $info['description2'] !!}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--pricing plans section end-->
      <!--gray section start-->
      <div class="pricing-table-dynamic">
         <div class="container">
            <div class="row">
               <div class="col-sm-4 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/signup-icon.png" alt="Sign up Icon"/>
                     <div class="benifit-heading">
                        Free to Signup 
                     </div>
                  </div>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeIn;">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/benifit3.png" alt="5-20 years Experienced Doctors"/>
                     <div class="benifit-heading">
                        5-20 years experienced doctors
                     </div>
                  </div>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                  <div class="benifit-bx">
                     <img src="{{ url('/') }}/public/images/language-icon.png" alt="Language Icon"/>
                     <div class="benifit-heading">
                        Other languages
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--gray section end-->
      <!--online-doc-aus start-->
      <div class="what-doc-section">
         <div class="container">
            <div class="online-doc-div">
               <h3> {{ isset($info['title3'])?$info['title3']:'' }} </h3>
               <div class="heading-btm-border"></div>
               <p>
                 {!! $info['description3'] !!}   
               </p>
         </div>
      </div>
       </div>
      <!--online-doc-aus end-->
      <!--blue section start-->
      <div class="blue-section chat-doctor">
         <div class="container">
            <div class="row">
              
               <div class="col-sm-12 col-md-12 col-lg-12">
                     <h2 class="white-colr text-algnt"><span> {{ isset($info['title4'])?$info['title4']:'' }}</span></h2>
                     <div class="bg-txt">
                        {!! $info['description4'] !!} 
                     </div>
               </div>
               <div class="clearfix"></div>
                  
              @if(isset($info) && sizeof($info)>0)
                     @foreach($info['aboutinfo'] as $arrs)
                  
               <div class="col-sm-6 col-md-4 col-lg-4">
                  
                  <div class="blue-bxx wow fadeInDown" data-wow-delay="0.2s">
                      
                     <div class="bg-img">
                        <img src="{{ url('/') }}/public/images/bag-doc-sign.png" alt="Bag Doctor Sign"/>
                     </div>
                     <div class="bg-txt">
                     {!! Str::words($arrs['description'], 10,'....')  !!}
                     </div>

                  </div>

               </div>
              
               @endforeach
               @endif
                     
              <div class="clearfix"></div>
               <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="bg-txt">
                     <br>
                        {!! $info['subdescription4'] !!} 
                     </div>
               </div>
            </div>
         </div>
      </div>
      <!--blue section end-->
      <!--green-section start-->
      <div class="green-section dynamic-green">
         <div class="container">
            <div class="green-bx-content">
               <h2 class="white-colr"> <span>{{ isset($info['title5'])?$info['title5']:'' }}  </span></h2>
               <div class="pln-div"></div>
                 <div class="pln-right text-center wow fadeIn" data-wow-delay="0.2s">
                    <p class="join-p">{!! $info['description5'] !!} </p>
                    <br/>
                     <br/>
                      <p class="join-p"> For full details <a href="{{ url('/pricing') }}"> View our Pricing</a> </p> 
                 </div>
            </div>
         </div>
      </div>
      <!--green-section end-->
      <!--online-medical-start-->
      <div class="what-doc-section online-medicl-certi chat-doctor">
         <div class="container">
            <h4 class="daynamic-heading">Frequently Asked Questions</h4>
            <div class="panel-group wow fadeInDown" id="accordion" >
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> {{ isset($info['title6'])?$info['title6']:'' }}</a>
                     </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                     <div class="panel-body">
                       {!! $info['description6'] !!}
                        <div class="how-it-list">
                          @if(isset($info) && sizeof($info)>0)
                         <ul>
                         <div class="row" style="font-family:sans-serif;font-size: 16px;">
                        
                         @foreach($info['dynamicfaq'] as $data)
                          <div class="col-sm-12 col-md-4 col-lg-4">
                             <li><span><i class="fa fa-circle"></i></span> {{ isset($data['faqdescription'])?$data['faqdescription']:'' }}</li>
                             </div>
                             @endforeach
                             </div>
                         </ul>
                         @else
                         <h1 style="text-align:center;color:#50ab50;"><b>Coming Soon!</b></h1>
                         @endif
                      </div>
                       {!! $info['subdescription6'] !!} 
                       <br>
                      <a class="see-green" href="{{url('/health/privacy-policy')}}"> View Privarcy Policy</a> 
                        <br/>
                     
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--online-medical-end-->
      <!--download app today-->
      <div class="app-download-section">
         <div class="bag-ligt">
            <div class="container">
               <div class="row">
                  <div class="hidden-xs hidden-sm col-md-5 col-lg-4 leftside wow fadeInLeft" data-wow-delay="0.6s">
                     <div class="img-slid-b">
                        <img src="{{ url('/') }}/public/images/app-img.png" alt="Doctroo"/>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-7 col-lg-8">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h2 class="white-colr text-algnt">See a Doctor Today, Wherever you are</h2>
                        <span>{{ isset($info['title7'])?$info['title7']:'' }}</span>
                        <div class="connct-doc">{!! $info['description7'] !!}
                        </div>
                        <button type="button" class="btn-grn" href="#signup-voucher" data-toggle="modal" >See a Doctor Now<span class="co-so">(coming Soon)</span></button>
                        <div class="app-download">
                           <div class="txt-ap">OR DOWNLOAD OUR free APPS(Coming Soon) </div>
                           <div class="btn-two-for">
                              <a href="javascript:void(0);"><img src="{{url('/')}}/public/images/appstor.png" alt="App Store"/></a>
                              <a href="javascript:void(0);"><img src="{{url('/')}}/public/images/google-play.png" alt="Google Play Store"/></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--download app today-->
      <!--see-doc section start-->
      <div class="see-dc">
         <div class="container">
            <div class="row">
               <div class="col-sm-8 col-md-9 col-lg-9">
                  <div class="see-left wow fadeInLeft">
                     <h3>See a doctor Today, from just $24</h3>
                     <p>Taking care of your health begins with a single step, make a doctoroo account and see a doctor today.</p>
                  </div>
               </div>
               <div class="col-sm-4 col-md-3 col-lg-3">
                  <button class="see-doctr-btn wow fadeInRight" href="#signup-voucher" data-toggle="modal" type="button" > See a Doctor</button>
               </div>
            </div>
         </div>
      </div>

@stop