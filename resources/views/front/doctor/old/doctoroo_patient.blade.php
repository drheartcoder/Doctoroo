@extends('front.doctor.layout.master')                
@section('main_content')
<script  src="{{url('/')}}/public/js/responsivetabs.js"></script>
<div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
<!--calender section start-->    
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.doctor.layout._sidebar')
      <div class="col-sm-8 col-md-9 col-lg-10">
         <div class="das-middle-content">
            <div class="row">
               <div class="col-sm-12">
                  <div class="inner-head">My Patients</div>
                  <div class="head-bor"></div>
                  @if(count($arr_patient)>0) 
                  <div class="patent-name">
                     {{isset($arr_patient['first_name'])?$arr_patient['first_name']:''}}
                     {{isset($arr_patient['last_name'])?$arr_patient['last_name']:''}},
                  </div>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-3">
                  <div class="search-phrm box">
                   <form method="get" name="frm_search_patient" id="frm_search_patient" action="{{ url('/')}}/doctor/mypatients/doctoroo">   
                     <div class="patient-search">
                        <input type="text" class="srch-phrm" placeholder="Search Patients" />
                        <span><button class="serch-btnn"> <img src="{{url('/')}}/public/images/search-phrm.png" alt="img search"/></button> </span>
                        <div class="dwn-arw"><a class="top-arrow"><i class="fa fa-angle-up" ></i></a> </div>
                     </div>
                     <div class="serch-cont-bx bottom" style="display:block;">
                        <div class="user_box">
                           <input type="text" class="form-inputs" name="patient_name" id="patient_name" placeholder="Name" />
                           <div class="err" id="err_patient_name"></div>
                        </div>
                        <div class="user_box">
                           <input type="text" class="form-inputs" name="email" id="email" placeholder="Email" />
                           <div class="err" id="err_email"></div>
                        </div>
                        <div class="user_box">
                           <input type="text" class="form-inputs" name="phone_no" id="phone_no" placeholder="Phone" />
                           <div class="err" id="err_phone_no"></div>
                        </div>
                        <div class="user_box">
                           <div class="select-style my-pati">
                              <select class="frm-select" name="sort_by" id="sort_by" onchange="sortBy(this.value)">
                                 <option value="">Sort by</option>
                                 <option value="name">Name</option>
                                 <option value="booking">Booking</option>
                               </select>
                           </div>
                          <div class="err" id="err_sort_by"></div>
                        </div>
                        <button class="search-btn pull-right" name="btn_search" type="submit" id="btn_search">Search</button>
                        <div class="clearfix"></div>
                     </div>
                     <div class="clearfix"></div>
                    </form> 
                  </div>
                  <div class="left-side-tabs my-patients-leftbar">
                     <div  class="content-d">
                       @if(count($arr_patient_list)>0) 
                        <ul class="sub_respo1">
                         @foreach($arr_patient_list as $patient)
                           
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img">
                                 @if(isset($patient['profile_image']) && $patient['profile_image']!="" && file_exists('uploads/patient/profile-image/'.$patient['profile_image']))
                                    <img src="{{ url('/') }}/public/uploads/patient/profile-image/{{$patient['profile_image']}} alt=""/>
                                 @else
                                    <img src="{{ url('/') }}/public/uploads/patient/profile-image/default-image.jpeg" alt=""/>
                                 @endif   
                                 </div>
                                 <div class="user_details">
                                    <div class="user_name">
                                     <a href="{{url('/')}}/doctor/mypatients/{{$patient['first_name'].''.$patient['last_name'].'-'.$patient['id']}}">{{$patient['first_name'].' '.$patient['last_name']}}</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                         @endforeach  
                        </ul>
                       @else
                           <div class="alert alert-info alert-dismissible" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> No Records Found.
                           </div> 
                       @endif
                     </div>
                     <!--message conversion end here-->
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-9">
                  <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                     <nav>
                        <ul>
                           <li><a href="#one">Patient Info </a> </li>
                           <li><a href="#two">Medical History</a></li>
                           <li><a href="#three">Orders</a></li>
                           <li><a href="#four">Prescription</a></li>
                           <li><a href="#fiv">Safety  Net</a></li>
                        </ul>
                     </nav>
                     <div class="content res-full-tab"  style="background:none;">
                        <div id="one">
                          @if(count($arr_patient)>0) 
                           <div class="tab-section">
                              <div class="doc-dash-right-bx">
                                 <div class="request-details-bx opening-bx">
                                    <div class="table-responsive basic-table" style="margin-bottom: 0px; border-bottom: 1px solid #ddd">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th style="color:#a5a5a5;font-family:'robotomedium';width:200px;">Name</th>
                                                <th>
                                                      {{isset($arr_patient['first_name'])?$arr_patient['first_name']:''}}
                                                      {{isset($arr_patient['last_name'])?$arr_patient['last_name']:''}}
                                                </th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Gender</td>
                                             <td  colspan="5">
                                                @if(isset($arr_patient['patientinfo']['gender']) && $arr_patient['patientinfo']['gender']=='M')
                                                {{'Male'}}
                                                @elseif(isset($arr_patient['patientinfo']['gender']) && $arr_patient['patientinfo']['gender']=='F')
                                                {{'Female'}}
                                                @else
                                                 {{'NA'}}
                                                @endif 
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Date of Birth</td>
                                             <td colspan="5">
                                                {{isset($arr_patient['patientinfo']['date_of_birth'])?date('d-m-Y',strtotime($arr_patient['patientinfo']['date_of_birth'])):'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">MediCare No</td>
                                             <td>
                                                {{isset($arr_patient['medicaredetails']['medicare_card_no'])?$arr_patient['medicaredetails']['medicare_card_no']:'NA'}}
                                             </td>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';width:5%;">IRN</td>
                                             <td>
                                                   {{isset($arr_patient['medicaredetails']['individual_card_no'])?$arr_patient['medicaredetails']['individual_card_no']:'NA'}}
                                             </td>
                                              <td style="color:#a5a5a5;font-family:'robotomedium';width:10%;">Medicare Expiry</td>
                                             <td>
                                                {{isset($arr_patient['medicaredetails']['medicare_card_expiry_month'])?date('F',strtotime($arr_patient['medicaredetails']['medicare_card_expiry_month'])):'NA'}} 
                                                {{isset($arr_patient['medicaredetails']['medicare_card_expiry_year'])?' - '.$arr_patient['medicaredetails']['medicare_card_expiry_year']:''}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Concession Card Holder</td>
                                             <td  colspan="5">
                                                <div class="regi_toggle" data-toggle="buttons-radio">
                                                                                                
                                                  <button id="btn-video" data-target="reg2" class="pagi_one btn-settings  @if(isset($arr_patient['medicaredetails']['medicare_type']) && ($arr_patient['medicaredetails']['medicare_type']!='Concession')) neagtive @endif" type="button">No</button>
                                                   <button id="btn-game" data-target="reg1" class="pagi_one btn-settings  @if(isset($arr_patient['medicaredetails']['medicare_type']) && ($arr_patient['medicaredetails']['medicare_type']=='Concession'))  positive @endif" type="button">Yes</button> 
                                                </div>
                                                <div class="paypal_box container1" id="reg1" @if(isset($arr_patient['medicaredetails']['medicare_type']) && ($arr_patient['medicaredetails']['medicare_type']=='Concession')) style="display:block;" @else style="display:none;" @endif>
                                                   <div class="clearfix"></div>
                                                  
                                                   <div class="payment-bx">
                                                     {{--  <div class="payment-head-text">Pensioners Card No.
                                                         <a href="#" class="see-green">View Card</a>
                                                      </div>
                                                      <div class="payment-head-text">Health Care Card No.
                                                         <a href="#" class="see-green">View Card</a>
                                                      </div> --}}
                                                      @if(isset($arr_patient['medicaredetails']['medicare_type']) && ($arr_patient['medicaredetails']['medicare_type']=='Concession')) 
                                                       <div class="payment-head-text">Card No.
                                                         <input type="text" placeholder="Card Number" name="card_no" value="{{isset($arr_patient['medicaredetails']['medicare_card_no'])?$arr_patient['medicaredetails']['medicare_card_no']:''}}" class="form-inputs card-input" />
                                                         <a href="{{url('/')}}/patient/doctor/mypatients/download_card/{{base64_encode($arr_patient['id'])}}" class="see-green">View Card</a>
                                                      </div>
                                                      @endif  
                                                   </div>
                                                 </div>
                                                <!--<div class="paypal_box container1" id="reg2" style="display:block;"></div>-->
                                             </td>
                                          </tr>
                                        {{--   <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">CN Card No.</td>
                                             <td colspan="5">12345658</td>
                                          </tr> --}}
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Address</td>
                                             <td colspan="5">
                                                {{isset($arr_patient['patientinfo']['streen_address'])?$arr_patient['patientinfo']['streen_address']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Mobile Phone</td>
                                             <td colspan="5">
                                                {{isset($arr_patient['patientinfo']['mobile_no'])?$arr_patient['patientinfo']['mobile_no']:'NA'}}
                                             </td>
                                          </tr>
                                          
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Home / Other Phone</td>
                                             <td colspan="5">
                                                {{isset($arr_patient['patientinfo']['phone_no'])?$arr_patient['patientinfo']['phone_no']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Email</td>
                                             <td colspan="5">{{isset($arr_patient['email'])?$arr_patient['email']:'NA'}}</td>
                                          </tr>
                                       </table>
                                    </div>
                                    <div class="chat-wth-btn">
                                       <button class="btn-grn" type="button">Chat with Patient</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="req-detail-head">
                                      Selected Pharmacys
                                    </div>
                                    <br/>
                                    <div class="select-pharma content-d">
                                       <div class="pharma-row">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">Walgreens Drug Store 00355</a>
                                                   <div class="pharna-add">
                                                      Carr. #2 Plaza Victoria, aguadilla 
                                                      787-882-8044
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="pharma-row">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">Walgreens Drug Store 00183</a>
                                                   <div class="pharna-add">
                                                      4210 Carr 693, Dorado 
                                                      787-278-5811
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="pharma-row">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">Walgreens Drug Store 00183</a>
                                                   <div class="pharna-add">
                                                      Carr 2 KM 81.7 Bo Carrizales, Hatillo
                                                      787-880-0190
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="pharma-row">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">Walgreens Drug Store 00183</a>
                                                   <div class="pharna-add">
                                                      4210 Carr 693, Dorado 787-278-
                                                      5811
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="pharma-row">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">Walgreens Drug Store 00183</a>
                                                   <div class="pharna-add">
                                                      URB JARDINES FAGOT 2500 CALLE 
                                                      OBISP, PONCE 787-843-8415
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="pharma-row last">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="pharmcy-detail-bx1">
                                                   <a href="#">CVS/pharmacy #8429</a>
                                                   <div class="pharna-add">
                                                      Calle Publica &amp; PR 2, Vega Baja
                                                      787-855-3044
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="pharma-btns1">
                                                   <button class="details-btn">Details</button>
                                                   <button class="details-btn select-btn">Chat with Pharmacy</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="chat-wth-btn1">
                                       <button class="btn-grn" type="button">Add My Pharmacy</button>
                                    </div>
                                    @if(count($arr_patient['regulardoctor'])>0)
                                    <div class="req-detail-head">
                                       Patient's Regular Family Doctor
                                    </div>
                                    <div class="table-responsive basic-table" style="margin-bottom:0;">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th style="color:#a5a5a5;font-family:'robotomedium';width:200px;">Doctor Name</th>
                                                <th>
                                                   {{isset($arr_patient['regulardoctor']['reg_doctor_name'])?$arr_patient['regulardoctor']['reg_doctor_name']:'NA'}}
                                                </th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Patient Name</td>
                                             <td>
                                                {{isset($arr_patient['regulardoctor']['reg_practice_name'])?$arr_patient['regulardoctor']['reg_practice_name']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Phone</td>
                                             <td> 
                                                {{isset($arr_patient['regulardoctor']['reg_doctor_phone'])?$arr_patient['regulardoctor']['reg_doctor_phone']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Address</td>
                                             <td>
                                                {{isset($arr_patient['regulardoctor']['reg_doctor_address'])?$arr_patient['regulardoctor']['reg_doctor_address']:'NA'}}
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                    @endif
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <div class="tble-frmt">
                                       <div class="tble-title-grn">
                                          Doctoroo Doctor's that have seen this Patient
                                       </div>
                                       <div class="content-d request-details-bx-pati" style="height:216px;">
                                          <div class="table-responsive basic-table ">
                                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                                <tr>
                                                   <td>
                                                      <div class="doc-pro">
                                                         <img src="{{url('/')}}/public/images/doc-pro.png" alt="profile img"/>
                                                      </div>
                                                      <div class="doc-nm my-patients-leftbar">
                                                         Dr. Matt Noble
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="see-doc-btn prple-btnn"><button>Details</button></div>
                                                      <div class="see-doc-btn"><button>Chat</button></div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="doc-pro">
                                                         <img src="{{url('/')}}/public/images/doc-pro1.png" alt="profile img"/>
                                                      </div>
                                                      <div class="doc-nm my-patients-leftbar">
                                                         Dr. Martine De
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="see-doc-btn prple-btnn"><button>Details</button></div>
                                                      <div class="see-doc-btn"><button>Chat</button></div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="doc-pro">
                                                         <img src="{{url('/')}}/public/images/doc-pro.png" alt="profile img"/>
                                                      </div>
                                                      <div class="doc-nm my-patients-leftbar">
                                                         Dr. Matt Noble
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="see-doc-btn prple-btnn"><button>Details</button></div>
                                                      <div class="see-doc-btn"><button>Chat</button></div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="doc-pro">
                                                         <img src="{{url('/')}}/public/images/doc-pro.png" alt="profile img"/>
                                                      </div>
                                                      <div class="doc-nm my-patients-leftbar">
                                                         Dr. Matt Noble
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="see-doc-btn prple-btnn"><button>Details</button></div>
                                                      <div class="see-doc-btn"><button>Chat</button></div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="doc-pro">
                                                         <img src="{{url('/')}}/public/images/doc-pro.png" alt="profile img"/>
                                                      </div>
                                                      <div class="doc-nm my-patients-leftbar">
                                                         Dr. Matt Noble
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div class="see-doc-btn prple-btnn"><button>Details</button></div>
                                                      <div class="see-doc-btn"><button>Chat</button></div>
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          @else
                            <div class="inner-head">Welcome!</div> 
                          @endif 
                        </div>
                        <div id="two">
                           <div class="tab-section">
                            @if(count($arr_medical_history)>0)  
                             <div class="doc-dash-right-bx" style="margin:0;">
                              <div class="request-details-bx">
                                 <div class="table-responsive basic-table">
                                    <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0" border="0">
                                       <tbody>
                                          <tr>
                                             <td class="med-head">HEALTH ISSUE</td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <span>{{isset($arr_medical_history['health_issue'])?$arr_medical_history['health_issue']:'NA'}}</span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">CURRENT/PAST ILLNESSES AND CONDITIONS</td>
                                          </tr>
                                          <tr>
                                                <td>{{ $illness_str or '' }}</td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">ABOUT LIFESTYLE</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-angle-double-right"></i> Daily Sleep
                                             <span> : </span>
                                             {{isset($arr_medical_history['daily_sleep'])?$arr_medical_history['daily_sleep']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-angle-double-right"></i> Smoking
                                             <span> : </span>
                                             {{isset($arr_medical_history['smoking_frequency'])?$arr_medical_history['smoking_frequency']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-angle-double-right"></i> Exercise
                                             <span> : </span>
                                             {{isset($arr_medical_history['excersice'])?$arr_medical_history['excersice']:'NA'}}</td>
                                          </tr>
                                           <tr>
                                             <td><i class="fa fa-angle-double-right"></i> Alcohol
                                              <span> : </span>
                                             {{isset($arr_medical_history['alcohol'])?$arr_medical_history['alcohol']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-angle-double-right"></i> Stress Levels
                                             <span> : </span>
                                             {{isset($arr_medical_history['stress_level'])?$arr_medical_history['stress_level']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                            
                                             <td><span><i class="fa fa-angle-double-right"></i></span>  Diet Pattern
                                             <span> : </span>
                                             {{isset($arr_medical_history['diet_pattern'])?$arr_medical_history['diet_pattern']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <span><i class="fa fa-angle-double-right"></i></span>  Marital Status
                                                <span> : </span>
                                                {{isset($arr_medical_history['marital_status'])?$arr_medical_history['marital_status']:'NA'}}
                                             </td>
                                           </tr>
                                          <tr>
                                             <td class="med-head">BLOOD PRESSURE</td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Sytolic Value
                                                <span> : </span>
                                                {{isset($arr_medical_history['sytolic_value'])?$arr_medical_history['sytolic_value']:'NA'}}
                                             </td>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Diastolic value
                                                <span> : </span>
                                                {{isset($arr_medical_history['diastolic_value'])?$arr_medical_history['diastolic_value']:'NA'}}
                                             </td>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Pulse Value
                                                <span> : </span>
                                                {{isset($arr_medical_history['pluse_value'])?$arr_medical_history['pluse_value']:'NA'}}
                                             </td>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Measure Date
                                                <span> : </span>
                                                {{isset($arr_medical_history['measure_date'])?$arr_medical_history['measure_date']:'NA'}}
                                             </td>
                                             <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Time
                                                <span> : </span>
                                                {{isset($arr_medical_history['time'])?$arr_medical_history['time']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">BLOOD SUGAR</td>
                                          </tr>
                                          <tr>
                                              <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Blood Sugar Rate
                                                <span> : </span>
                                                {{isset($arr_medical_history['blood_sugar_value'])?$arr_medical_history['blood_sugar_value']:'NA'}}
                                             </td>
                                              <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Meal
                                                <span> : </span>
                                                {{isset($arr_medical_history['meal'])?$arr_medical_history['meal']:'NA'}}
                                             </td>
                                              <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Measure Date
                                                <span> : </span>
                                                {{isset($arr_medical_history['blood_sugar_measure_date'])?$arr_medical_history['blood_sugar_measure_date']:'NA'}}
                                             </td>
                                              <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                <span><i class="fa fa-angle-double-right"></i></span>   Time
                                                <span> : </span>
                                                {{isset($arr_medical_history['blood_sugar_time'])?$arr_medical_history['blood_sugar_time']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">ALLERGIES</td>
                                          </tr>
                                          <tr>
                                             <td>{{isset($arr_medical_history['allergies'])?$arr_medical_history['allergies']:'NA'}}</td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">SURGERIES AND PROCEDURES</td>
                                          </tr>
                                          <tr>
                                             <td>{{isset($arr_medical_history['surgeries_and_procedures'])?$arr_medical_history['surgeries_and_procedures']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">OBSTETRICS</td>
                                          </tr>
                                           <tr>
                                             <td>{{isset($arr_medical_history['obstetrics'])?$arr_medical_history['obstetrics']:'NA'}}
                                             </td>
                                          </tr>
                                           <tr>
                                             <td class="med-head">COMPLICATIONS</td>
                                          </tr>
                                           <tr>
                                             <td>{{isset($arr_medical_history['complications'])?$arr_medical_history['complications']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">FAMILY HISTORY</td>
                                          </tr>
                                           <tr>
                                             <td>{{isset($arr_medical_history['family_history'])?$arr_medical_history['family_history']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">DISEASES</td>
                                          </tr>
                                           <tr>
                                             <td>{{isset($arr_medical_history['any_genetic_diseases'])?$arr_medical_history['any_genetic_diseases']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="med-head">OTHER</td>
                                          </tr>
                                           <tr>
                                             <td>{{isset($arr_medical_history['other'])?$arr_medical_history['other']:'NA'}}
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                            </div>
                            @else
                            <div class="alert alert-warning alert-dismissible" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> No Records Found.
                            </div> 
                            @endif  
                           </div>
                         </div>
                        <div id="three">
                           <div class="tab-section">
                           </div>
                        </div>
                        <div id="four">
                           <div class="tab-section">
                           </div>
                        </div>
                        <div id="five">
                           <div class="tab-section">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--calender section end--> 
<script>
/*========Search===================*/
 $(document).ready(function(){

   $('#btn_search').on('click',function(){

      var name    = $('#patient_name').val();
      var email   = $('#email').val();
      var phone   = $('#phone_no').val();
      var sort_by = $('#sort_by').val();
      var onlydigit      = /^[0-9]*(?:\.\d{1,2})?$/;
      var email_filter   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var nodigit_regexp = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;

      if($.trim(name)=="" && $.trim(email)=="" && $.trim(phone)=="" && $.trim(sort_by)=="")
      {

            $('#err_sort_by').fadeIn('fast');
            $('#err_sort_by').html('Please enter atleast one field for search.');
            $('#err_sort_by').fadeOut(4000);
            $('#patient_name').focus();
            return false;
      }
      else if($.trim(name)!="" && !nodigit_regexp.test(name))
      {

            $('#err_patient_name').fadeIn('fast');
            $('#err_patient_name').html('Please enter only character letter.');
            $('#err_patient_name').fadeOut(4000);
            $('#patient_name').focus();
            return false;     
      }
      else if($.trim(email)!="" && !email_filter.test(email))
      {

            $('#err_email').fadeIn('fast');
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            $('#email').focus();
            return false;  
      }
      else if($.trim(phone)!="" && !onlydigit.test(phone))
      {

            $('#err_phone_no').fadeIn('fast');
            $('#err_phone_no').html('Please enter only digit.');
            $('#err_phone_no').fadeOut(4000);
            $('#phone_no').focus();
            return false;  
      }
      else
      {

          return true;  
      }

   });

 });  
</script>
<!-- custom scrollbars plugin -->
<!-- custom scrollbars plugin -->
<link href="{{url('/')}}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- custom scrollbar plugin -->
<script src="{{url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
   (function($){
   $(window).on("load",function(){
   
   $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
   $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
   
           $(".content-d").mCustomScrollbar({theme:"dark"});
   
   });
   })(jQuery);
    
    /*side search arow hide show start*/
    $('.top-arrow').on('click', function() {//alert($(this).find('i').html());
       $parent_box = $(this).closest('.box');
       if($(this).html()=='<i class="fa fa-angle-down"></i>')
       {
           $(this).html('<i class="fa fa-angle-up"></i>');
       }
       else
       {
               $(this).html('<i class="fa fa-angle-down"></i>');
       }
       $parent_box.find('.bottom').slideToggle(1000, 'swing');
   });
     /*side search arow hide show end*/
    
    /*responsive tabs start*/
    $(document).on('responsive-tabs.initialised', function(event, el) {
              concole.log(el);
          });
   
      $(document).on('responsive-tabs.change', function(event, el, newPanel) {
          concole.log(el);
          concole.log(newPanel);
      });
   
      $('[data-responsive-tabs]').responsivetabs({
          initialised: function() {
              concole.log(this);
          },
   
          change: function(newPanel) {
              concole.log(newPanel);
          }
      });
   
   
</script>
<script>
   //onclick toggle
   $(document).ready(function() {
   
   $('.container1').hide();
   $(".container1:first").addClass("act1").show(); 
   
   $('.regi_toggle button').click(function(){
   var button_target = jQuery(this).data("target");
   if(button_target == "reg1")
   {
     $('#btn-game').addClass('positive'); // remove the class from the button
     $('#btn-video').removeClass('neagtive'); // remove the class from the button
     var target = "#" + $(this).data("target");
     $(".container1").not(target).hide();
     $(target).show();
   //  target.slideToggle();
   }else
   {
     $('#btn-game').removeClass('positive'); // remove the class from the button
     $('#btn-video').addClass('neagtive'); // remove the class from the button
     var target = "#" + $(this).data("target");
     $(".container1").not(target).hide();
     $(target).show();
   //   target.slideToggle();
   }
   
   
   });
   
   });
   
</script>
@stop