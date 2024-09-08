@extends('front.patient.layout._dashboard_master')                
@section('main_content')
<!--dashboard section-->            
<div class="middle-section">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="dash-panel">
               <h2>Schedule an Appointment</h2>
               <div class="bg-i"><img src="{{url('/')}}/public/images/patient-dashbor-img.png" alt=""/></div>
               <div class="doctr-b"><a href="#" class="btn-grn"><span><img src="{{url('/')}}/public/images/video-dash.png" alt=""/></span> See a Doctor Now</a></div>
            </div>
         </div>
         <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="dash-panel">
               <h2>Let's make your health Easier</h2>
               <div class="box-dash-panel mar-btm">
                  <div class="row">
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr1.png" alt=""/>
                                 <div class="name-pati"><a href="#">See a Doctor Now</a></div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash1.png" alt=""/>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr2.png" alt=""/>
                                 <div class="name-pati"><a href="#">Coming Soon...</a></div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash2.png" alt=""/>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr3.png" alt=""/>
                                 <div class="name-pati"><a href="#">Coming Soon...</a></div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash7.png" alt=""/>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr4.png" alt=""/>
                                 <div class="name-pati"><a href="#">Schedule &nbsp; Update 
                                    Bookings</a>
                                 </div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash4.png" alt=""/>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr5.png" alt=""/>
                                 <div class="name-pati"><a href="#">Get a New Prescription! 
                                    <span>(if you already know what you need)</span></a>
                                 </div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash5.png" alt=""/>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="patient-dash-box">
                           <div class="hover-div">
                              <div class="hover-content">
                                 <img src="{{url('/')}}/public/images/see-dctr6.png" alt=""/>
                                 <div class="name-pati"><a href="#">Get a Medical Certificate</a></div>
                              </div>
                           </div>
                           <img class="img-s" src="{{url('/')}}/public/images/pat-dash6.png" alt=""/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="doctr-b"><a href="#" class="btn-grn"><span><img src="{{url('/')}}/public/images/ques-dash.png" alt=""/></span> How Does it Work?</a></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--dashboard section--> 
@stop