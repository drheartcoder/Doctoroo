@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
 <!--dashboard section-->            
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx">
               <div class="dash-left">
                     <div class="see-doctr-panel">
                        <h2>See a Medical Doctor Now</h2>
                        <h4>for just $20 for the first 5 minutes</h4>
                        <div class="bag-gren hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/see-dctr.png" alt=""/></div>
                     </div>
                  </div>
               <div class="col-sm-12 col-md-12 col-lg-6 pdl">
                     <div class="see-d-dash-panel text-center">
                        <div class="distance">
                           <div class="row">
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-left"><a href="#"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a></div>
                              <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> &nbsp; </div>
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-right"><a href="#"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div>
                           </div>
                           <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                        <div class="section-box height-bx">
                           <h2>Great, let's get started.</h2>
                           <div class="some-t">Your visit with a Doctroo Physician will cost:</div>
                           <div class="min-bx"><a href="">Pricing</a></div>
                           <a href="#" class="apply-cpn">Apply a Coupon</a>
                           <a class="btn-grn" href="#">OK, let's go</a>
                        </div>
                     </div>
                  </div>
               <div class="clr"></div>
            </div>
         </div>
      </div>
      <!--dashboard section-->
@stop