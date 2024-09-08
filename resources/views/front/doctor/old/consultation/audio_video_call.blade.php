@extends('front.doctor.layout.master')                   
@section('main_content')
<style>
   .book_time_slot
   {
      background: #644e7c;border: 1px solid #644e7c;color: #fff;padding: 2px 18px;
   }
   .vlt_time_slot
   {
      cursor: pointer;
   }
</style>
	 <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
           <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
              @include('front.doctor.layout._sidebar')
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="inner-head">Consultation</div>
                        <div class="head-bor"></div>
                        <div class="doc-dash-right-bx">
                           <div class="request-details-bx">

                              <div class="req-detail-head">
                                 Archive Options:
                                 <div class="doc-sign"><span><img src="images/doc-sign.png" alt="sign"/></span>Doctoroo Patient</div>
                              </div>
                              <div class="row">
                                 <div class="col-sm12 col-md-6 col-lg-6">
                                    <div class="table-responsive basic-table">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th style="color:#a5a5a5;font-family:'robotomedium';width:200px;">Name</th>
                                                <th>John Smith</th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Gender</td>
                                             <td>Male</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Date of Birth</td>
                                             <td>27-03-1988</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Email</td>
                                             <td>contact@gmail.com</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Mobile Phone</td>
                                             <td>(+012) 345 6789</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Address</td>
                                             <td>Street 123, Avenue 45, Country</td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="col-sm12 col-md-6 col-lg-6">
                                    <div class="med-div req-book">
                                       <div class="tble-title"> Bookings </div>
                                       <div class="med-cent ">
                                          <p> New Requested Booking</p>
                                          <div class="time-bxx"> <span> Time:</span>    4:30 PM </div>
                                          <div class="time-bxx"> <span> Date: </span>  Date:    Wednesday 13-Aug-17 </div>
                                          <div class="bk-bts">
                                             <button class="acc-btn"> Accept</button>
                                             <button class="acc-btn"> Decline</button>
                                          </div>
                                          <div class="bk-bts">
                                             <button class="acc-btn"> Offer Another Time</button>
                                             <button class="acc-btn"> Reschedule</button>
                                             <button class="acc-btn"> Notify Patient</button>
                                          </div>
                                          <br/>
                                          <div class="bk-bts">
                                             <button class="details-btn gry-btnn">Cancel Booking</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Photos Uploaded
                              </div>
                              <div class="portfolio-bx">
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="images/port1.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="images/port2.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="images/port3.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="images/port4.jpg" alt="img"/>
                                 </div>
                                 <div class="port">
                                    <span class="mass_close"><a href="javascript:void(0)"><i class="fa fa-times-circle"></i></a></span>
                                    <img src="images/port5.jpg" alt="img"/>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Description uploaded
                              </div>
                              <div class="det-con">
                                 Non illo quia beatae ratione impedit sunt libero ut aliquam ipsam minus laborum quidem id perferendis magnam quasi reiciendis occaecati placeat inventore dolores maiores porro ipsa qui doloremque porro corrupti quo aut quia ipsam quaerat ut dolorum in et ratione est autem debitis
                              </div>
                              <div class="req-detail-head">
                                 Answers to all Questions
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> Increased heart rate ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       Dear Doctor, I am a 30-year-old male, 73 Kgs, 173 cm, smoker. I have been checking my heart rate over the past few weeks and it is constantly between 95 to 105. I have checked with 3-4 devices at different intervals during different days and my heart rate just would not go below 95. I had a blood test recently and my HSCRP, Cholesterol and all cardiac tests are within the normal range. I have started working out recently and am trying to cut down on cigarettes. 
                                    </div>
                                 </div>
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> Pulmonary blockage ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       My father had a heart attack about 5months ago which was his first he never had any heart problems before that. He was admitted to Apollo and diagnosed with Acute pulmonary edema, moderate LV dysfunction / moderate MR, CAG on 06-06-2016 was 80% ostio proximal LAD stenosis and recanalised lcx with no significant residual stenosis
                                    </div>
                                 </div>
                              </div>
                              <div class="ques-ans-bx last">
                                 <div class="question_one">
                                    <div class="q-icon">Q :</div>
                                    <div class="que-text"> High bp at night ?</div>
                                 </div>
                                 <div class="answer_one">
                                    <div class="q-icon">A :</div>
                                    <div class="que-text">
                                       Respected sir , when i check my bp at night it alwys stands in a highr side 140/90 mmhg during day time 120/70 to 130/70 I dont excercise... i sleep at 3 Am and wake up at 12 Pm....i know my routine is so bad I feel pain in my left arm...i am so worried about this in a young age and my pulse is atound 46 at night most of time..ist okay? Should i start treatment or manage by diet and excercise ??? Is't possible yo manage by diet and excercise ??? Kindly give ur expert advice ..i ll b thankful 
                                    </div>
                                 </div>
                              </div>
                              <div class="req-detail-head">
                                 Requested Medication Name
                              </div>
                              <div class="det-con">
                                 &nbsp;
                              </div>
                              <div class="req-detail-head">
                                 Normal GP Details
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Name</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Dr, John Smith
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Gender</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Male
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Date of Birth</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          27-03-1988
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Email</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          contact@gmail.com
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Mobile Phone</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          (+012) 345 6789
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="user-box last">
                                    <div class="faculty-head">
                                       <div class="faculty-lable">Address</div>
                                    </div>
                                    <div class="faculty-subhead">
                                       <div class="faculty-text">
                                          Street 123, Avenue 45, Country
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="ques-ans-bx">
                                 <div class="row">
                                    <div class="user_box">
                                       <div class="col-sm-5 col-lg-3 col-lg-3">
                                          <div class="con-lble dwn-let">Prescription Period :</div>
                                       </div>
                                       <div class="col-sm-7 col-lg-9 col-lg-9">
                                          <a href="#" class="view-dwn-btn">View &amp; Download</a>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user_box">
                                       <div class="col-sm-5 col-lg-3 col-lg-3">
                                          <div class="con-lble dwn-let">Retrieval Period :</div>
                                       </div>
                                       <div class="col-sm-7 col-lg-9 col-lg-9">
                                          <a href="#" class="view-dwn-btn">View &amp; Download</a>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user_box">
                                       <div class="col-sm-5 col-lg-3 col-lg-3">
                                          <div class="con-lble dwn-let">Medical Certificate Period :</div>
                                       </div>
                                       <div class="col-sm-7 col-lg-9 col-lg-9">
                                          <a href="#" class="view-dwn-btn">View &amp; Download</a>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user_box">
                                       <div class="col-sm-5 col-lg-3 col-lg-3">
                                          <div class="con-lble dwn-let">Pathology Retrieval :</div>
                                       </div>
                                       <div class="col-sm-7 col-lg-9 col-lg-9">
                                          <a href="#" class="view-dwn-btn">View &amp; Download</a>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="det-req-btns">
                                 <a href="#" class="req-btnns"> Request a Consultation</a>
                                 <a href="#" class="req-btnns"> Chat with Patient</a>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection