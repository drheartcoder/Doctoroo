@extends('front.layout.master-coming-soon')                
@section('main_content')
      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/pricing-bg.jpg'); background-repeat:no-repeat;background-attachment: fixed; background-position: center top;">
         <div class="pricing-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pricing-banner">
                         <h1> <?php echo html_entity_decode($pricingdata['title_1']);?></h1>
                        <h3> <?php echo html_entity_decode($pricingdata['description_1']);?></h3>
                        <button class="see-doctr-btn" href="#signup-voucher" data-toggle="modal" type="button" > See a Doctor</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--pricing plans section start-->
      <div class="pricing-plan">
         <div class="container">
            <h1 class="wow fadeInDown"> Pricing  <span>Plans</span></h1>
            <div class="head-btm"></div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
                  <div class="pln-left wow zoomIn">
                     <img class="img-resize" src="{{ url('/') }}/public/images/p1.jpg" alt="Pricing Plans"/>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                  <div class="pln-right wow fadeIn join-left" data-wow-delay="0.4s">
                     <h3><?php echo html_entity_decode($pricingdata['title_2']);?></h3>
                     <p><?php echo html_entity_decode($pricingdata['description_2']);?></p>
                  </div>
               </div>
            </div>
            <div class="pln-divider"></div>
            <div class="col-sm-6 col-md-6 col-lg-6 wow zoomIn pull-left">
               <div class="pln-left">
                  <img class="img-resize" src="{{ url('/') }}/public/images/p2.jpg" alt="Pricing Plans"/>
               </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 pull-left">
               <div class="pln-right wow fadeIn" data-wow-delay="0.2s">
                  <h3><?php echo html_entity_decode($pricingdata['title_3']);?></h3>
                  <p class="join-p"></p>
                  <p><?php echo html_entity_decode($pricingdata['description_3']);?></p>
               </div>
            </div>
         </div>
      </div>
      <!--pricing plans section end-->
      <!--green-section start-->
      <div class="green-section">
         <div class="container">
            <div class="green-bx-content">
               <h1> How much does it <span> Cost?</span></h1>
               <div class="pln-div"></div>
               <p>Less than any other platform <br/>
                  We've priced your consultations so that you only pay for what you use  if your consultation lasts for 7 minutes, why should you pay for a full 15-minute consultation?<br/>
                  The cost during standard hours (8am - 8pm) is $24 for the first 4 minutes, and $10 for each 4 minutes after that. After hours is just an extra $15. 
               </p>
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
                  <?php  $i=0;$p=1;$class='';?>
                     @if(count($pricing)>0)
                       <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Length of Call</h3>
                              <div class="pcr-sml">&nbsp;</div>
                           </div>
                           <?php $count=count($pricing); ?>
                           @foreach($pricing as $data)
                          
                           <?php 
                           if($i%2==0)
                           {
                              $class = 'gray-srtip chge-size';
                           } 
                           else
                           {

                              $class = 'white-strip chge-size';
                           }                    
                           if($count==$p)
                           {
                              
                               $class = 'tbl-btm';
                           }
                        

                            ?>
                           <div class="{{$class}}">{{ isset($data['length_of_call'])?$data['length_of_call']:'' }}</div>
                           <?php $i++; $p++;?>                   
                           @endforeach
                     
                        </div>
                     </div>
                                           
                        <?php $j=0;$a=1;$class='';?>
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
                            }
                            if($count==$a)
                           {
                              
                               $class = 'tbl-btm';
                           }

                            ?>
                          <div class="{{$class}}">{{ isset($data['day_time_cost'])?$data['day_time_cost']:'' }}</div>
                          <?php $j++; $a++;?>
                          @endforeach

                        </div>
                     </div>
                     
                      <?php $k=0; $t=1;$class='';?>

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
                           } 

                           if($count==$t)
                           {
                              $class = 'tbl-btm';

                           }

                           ?>
                           <div class="{{$class}}">{{ isset($data['night_time_cost'])?$data['night_time_cost']:'' }}</div>
                            <?php $k++; $t++;?>
                          @endforeach
                         
                        </div>
                     </div>
                     @else

                     <h1 class="daynamic-heading" style="text-align:center;color:#50ab50;">Coming Soon!</h1>      
                  @endif
                  <div class="clearfix"></div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="please-note">
                     <h4> Please Note</h4>
                     <div class="pln-list">
                         @if(isset($pricingnote) && sizeof($pricingnote)>0)
                        <ul>
                            @foreach($pricingnote as $arr)  
                           <li><span><img src="{{url('/')}}/public/images/det-list-icn.png" alt="{{ isset($arr['pricing_note'])?$arr['pricing_note']:'' }}"/></span> {{ isset($arr['pricing_note'])?$arr['pricing_note']:'' }} </li>
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
      <!--see-doc section start-->
      <div class="see-dc">
         <div class="container">
            <div class="row">
               <div class="col-sm-8 col-md-9 col-lg-9">
                  <div class="see-left">
                     <h3>See a doctor Today, from just $28</h3>
                     <p>Taking care of your health begins with a single step, make a doctoroo account and see a doctor today.</p>
                  </div>
               </div>
               <div class="col-sm-4 col-md-3 col-lg-3">
                  <button class="see-doctr-btn" href="#signup-voucher" data-toggle="modal" type="button" > See a Doctor</button>
               </div>
            </div>
         </div>
      </div>
      <!--see-doc section end-->
@stop