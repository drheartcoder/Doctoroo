@extends('front.layout.master-coming-soon')                
@section('main_content')
      <div id="home-header"> </div>
      <div class="banner-home inner-page-box" style="background: transparent url('{{url('/')}}/public/images/pricing-bg.jpg'); background-repeat:no-repeat;background-attachment: fixed; background-position: center top;">
         <div class="pricing-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pricing-banner">
                        <h1> {{ isset($info['title'])?$info['title']:'' }}</h1>
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
                        <img class="img-resize" src="{{url('/')}}/public/images/daynamic1.png" alt="Doctor App"/>
                     </div>
                  </div>
                  <div class="dynamic-left-bx pln-right wow fadeInLeft">
                     <h4 class="daynamic-heading">{{ isset($info['title1'])?$info['title1']:'' }}</h4>
                     <p> <?php echo html_entity_decode($info['description1']);?></p>
                  </div>
               </div>
            </div>
            <div class="pln-divider"></div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="dynamic-right-bx1">
                     <div class="pln-left  wow zoomIn">
                        <img class="img-resize" src="{{url('/')}}/public/images/daynamic2.png" alt="Online Doctor Chat"/>
                     </div>
                  </div>
                  <div class="dynamic-left-bx1 pln-right wow fadeInRight">
                     <h4 class="daynamic-heading">{{ isset($info['title2'])?$info['title2']:'' }}</h4>
                     <p><?php echo html_entity_decode($info['description2']);?></p>
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
                     <img src="{{url('/')}}/public/images/signup-icon.png" alt="Sign up Icon"/>
                     <div class="benifit-heading">
                        {{ isset($info['icon_description1'])?$info['icon_description1']:'' }}
                     </div>
                  </div>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeIn;">
                  <div class="benifit-bx">
                     <img src="{{url('/')}}/public/images/benifit3.png" alt="5-20 years Experienced Doctors"/>
                     <div class="benifit-heading">
                      {{ isset($info['icon_description2'])?$info['icon_description2']:'' }}
                     </div>
                  </div>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 wow fadeIn" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                  <div class="benifit-bx">
                     <img src="{{url('/')}}/public/images/language-icon.png" alt="Language Icon"/>
                     <div class="benifit-heading">
                       {{ isset($info['icon_description3'])?$info['icon_description3']:'' }}
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
            <h4 class="daynamic-heading">{{ isset($info['title3'])?$info['title3']:'' }}</h4>
            <div class="online-doc-div">
             
               <div class="heading-btm-border"></div>
               <p>
                  <?php echo html_entity_decode($info['description3']);?>
               </p>
               <p></p>
            </div>
         </div>
      </div>
      <!--online-doc-aus end-->
      <!--green-section start-->
      <div class="green-section dynamic-green">
         <div class="container">
            <div class="green-bx-content">
               <h1> How much does it <span> Cost?</span></h1>
               <div class="pln-div"></div>
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="pln-right wow fadeIn" data-wow-delay="0.2s">
                        <h3>We are Australia's most affordable platform</h3>
                        <p class="join-p">Doctoroo was built to make doctor's easily accessible and affordable for Australian's who dont have the time to travel to a doctor, wait for hours and then travel to the pharmacy, for something they could've easily done in a few minutes from their phones at home or the office. </p>
                        <div class="pln-list">
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="pln-right wow fadeIn" data-wow-delay="0.2s">
                        <div class="pln-list">
                           <p>Doctoroo also makes it easy for any Australians who:</p>
                           <ul>
                              <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="Live in remote areas"/></span> Live in remote areas </li>
                              <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="Are housebound"/></span> Are housebound </li>
                              <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="Have difficulty travailing"/></span> Have difficulty travailing  </li>
                              <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="Have trouble lining up childcare"/></span> Have trouble lining up childcare </li>
                              <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="Just don't have the time to make it to a doctor or pharmacy"/></span> Just don't have the time to make it to a doctor or pharmacy </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--green-section end-->
      <!--pricing table start-->
      <div class="pricing-table">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="plans-tble-bx">
                     <h1>We've summarized the cost in the following table</h1>
                  </div>
                  
                  <div class="prce-tble wow fadeInLeft">
                  <?php  $i=0;$class='';?>
                     @if(count($pricing)>0)
                       
                       <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Length of Call</h3>
                              <div class="pcr-sml">&nbsp;</div>
                           </div>
                           @foreach($pricing as $data)
                           <?php if($i%2==0)
                           {
                              $class = 'gray-srtip chge-size';
                           }   
                           else
                           {
                              $class = 'white-strip chge-size';
                            }?>
                           <div class="{{$class}}">{{ isset($data['length_of_call'])?$data['length_of_call']:'' }}</div>
                           <?php $i++;?>                   
                           @endforeach
                         
                        <div class="tbl-btm"> Average - 7.5 minutes</div>
                        </div>
                     </div>
                                           
                        <?php $j=0;$class='';?>
                       <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3> Day-time cost</h3>
                              <div class="pcr-sml">&nbsp;</div>
                           </div>
                            @foreach($pricing as $data)
                            <?php if($j%2==0)
                           {
                              $class = 'gray-srtip chge-size';
                           }   
                           else
                           {
                              $class = 'white-strip chge-size';
                            }?>
                          <div class="{{$class}}">{{ isset($data['day_time_cost'])?$data['day_time_cost']:'' }}</div>
                           
                          <?php $j++;?>
                          @endforeach

                           <div class="tbl-btm"> Average - 7.5 minutes</div>
                        </div>
                     </div>
                     

                      <?php $k=0; $class='';?>

                       <div class="col-sm-4 col-md-4 col-lg-4 pad-0 last">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Night-time cost</h3>
                              <div class="pcr-sml">&nbsp;</div>
                           </div>
                             @foreach($pricing as $data)

                            <?php if($k%2==0)
                           {
                              $class = 'gray-srtip chge-size';
                           }   
                           else
                           {
                              $class = 'white-strip chge-size';
                            }?>
                           <div class="{{$class}}">{{ isset($data['night_time_cost'])?$data['night_time_cost']:'' }}</div>
                            <?php $k++;?>
                          @endforeach
                         
                          
                           <div class="tbl-btm"> Average - 7.5 minutes</div>
                        </div>
                     </div>
                     @else

                     <h1 class="daynamic-heading" style="text-align:center;color:#50ab50;">Coming Soon!</h1>      
                  @endif
                  <div class="clearfix"></div>
                  </div>
               

               </div>
               <div class="col-sm-12">
                  <div class="please-note wow fadeInRight">
                     <h4> Please Note</h4>
                     <div class="pln-list">
                         @if(isset($info) && sizeof($info)>0)
                        <ul>
                        	@foreach($info['descriptioninfo'] as $arr)	
                           <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="{{ isset($arr['description'])?$arr['description']:'icon' }}"/></span> {{ isset($arr['description'])?$arr['description']:'' }} </li>
                           @endforeach
                        </ul>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--pricing table end-->
      <!--online-medical-start-->
    
      <div class="what-doc-section online-medicl-certi">
         <div class="container">
            <h4 class="daynamic-heading">Online Medical Certificates</h4>
            
            <div class="panel-group wow fadeInDown" id="accordion">
                 @if(count($faq)>0)
                @foreach($faq as $data_key => $data)
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{isset($data['id'])?$data['id']:'' }}">{{ isset($data['question'])?$data['question']:'' }}</a>
                     </h4>
                  </div>
                   @if($data_key == 0)
                  <div id="collapseOne{{ isset($data['id'])?$data['id']:'' }}" class="panel-collapse collapse in">
                     <div class="panel-body">
                        {{ isset($data['answer'])?$data['answer']:'' }}. 
                     </div>
                  </div>
                   @else
                   <div id="collapseOne{{ isset($data['id'])?$data['id']:'' }}" class="panel-collapse collapse">
                     <div class="panel-body">
                      {{ isset($data['answer'])?$data['answer']:'' }}
                     </div>
                  </div>
                     @endif
               </div>
                @endforeach
                @else
           		<h1 style="text-align:center;color:#50ab50;"><b>Coming Soon!</b></h1>    
            @endif
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
                        <img src="{{url('/')}}/public/images/app-img.png" alt="Doctroo"/>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-7 col-lg-8">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s">
                        <h1>See a Doctor Today, Wherever you are</h1>
                        <span>How do I get started?</span>
                        <div class="connct-doc">Average calls lasts 6-8 minutes and cost just $24 - $36.
                           All other app features are free for you
                        </div>
                        <button type="button" class="btn-grn" href="#signup-voucher" data-toggle="modal">See a Doctor Now<span class="co-so">(coming Soon)</span></button>
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
      <!--see-doc section end-->
      <!--footer-->
      @stop