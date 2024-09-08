                  @if(isset($arr_patient) && sizeof($arr_patient)>0)
                           <div class="tab-section">
                              <div class="doc-dash-right-bx">
                                 <div class="request-details-bx opening-bx">
                                    <div class="table-responsive basic-table" style="margin-bottom: 0px; border-bottom: 1px solid #ddd">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">

                                          <thead>
                                             <tr>
                                                <th style="color:#a5a5a5;font-family:'robotomedium';width:200px;">Name</th>
                                                <th>
                                                @if(isset($arr_patient['familymember']) && sizeof($arr_patient['familymember']>0))

                                                   {{isset($arr_patient['familymember']['first_name'])?$arr_patient['familymember']['first_name']:''}}
                                                   {{isset($arr_patient['familymember']['last_name'])?$arr_patient['familymember']['last_name']:''}}

                                                 @else
                                                   {{isset($arr_patient['userinfo']['first_name'])?$arr_patient['userinfo']['first_name']:''}}
                                                   {{isset($arr_patient['userinfo']['last_name'])?$arr_patient['userinfo']['last_name']:''}}
                                                @endif
                                                </th>
                                             </tr>
                                          </thead>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Gender</td>
                                             <td  colspan="5">

                                             @if(isset($arr_patient['familymember']) && sizeof($arr_patient['familymember']>0))

                                                 {{ $arr_patient['familymember']['gender'] or 'NA' }}

                                             @else

                                                @if(isset($arr_patient['gender']) && $arr_patient['gender']=='M')
                                                {{'Male'}}
                                                @elseif(isset($arr_patient['gender']) && $arr_patient['gender']=='F')
                                                {{'Female'}}
                                                @else
                                                 {{'NA'}}
                                                @endif 

                                             @endif
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Date of Birth</td>
                                             <td colspan="5">
                                             <?php
                                                $birth_date = '';
                                             ?>
                                             @if(isset($arr_patient['familymember']) && sizeof($arr_patient['familymember'])>0)
                                                @if(isset($arr_patient['familymember']['date_of_birth']) && $arr_patient['familymember']['date_of_birth']!='' && $arr_patient['familymember']['date_of_birth']!="0000-00-00")
                                                   <?php 
                                                    $birth_date = date('Y/m/d',strtotime($arr_patient['familymember']['date_of_birth']))
                                                   ?>
                                                   
                                                @endif
                                                
                                                
                                             @elseif(isset($arr_patient['date_of_birth']) && $arr_patient['date_of_birth']!=' 0000-00-00' && $arr_patient['date_of_birth']!='')

                                                   <?php 
                                                    $birth_date = date('Y/m/d',strtotime($arr_patient['date_of_birth']))
                                                   ?>

                                             @endif
                                             {{ $birth_date or 'NA'  }}
                                      
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
                                                {{isset($arr_patient['streen_address'])?$arr_patient['streen_address']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Mobile Phone</td>
                                             <td colspan="5">

                                              @if(isset($arr_patient['familymember']['mobile_number']) && sizeof($arr_patient['familymember']['mobile_number']>0))
                                                {{isset($arr_patient['familymember']['mobile_number'])?$arr_patient['familymember']['mobile_number']:'NA'}}
                                              @else
                                                {{isset($arr_patient['mobile_no'])?$arr_patient['mobile_no']:'NA'}}
                                              @endif

                                             </td>
                                          </tr>
                                          
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Home / Other Phone</td>
                                             <td colspan="5">
                                                {{isset($arr_patient['phone_no'])?$arr_patient['phone_no']:'NA'}}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="color:#a5a5a5;font-family:'robotomedium'">Email</td>
                                             <td colspan="5">{{isset($arr_patient['userinfo']['email'])?$arr_patient['userinfo']['email']:'NA'}}</td>
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
                                    @if(isset($arr_patient['regulardoctor']) && count($arr_patient['regulardoctor'])>0)
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
     
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                         @else
                         
                         <br/>
                         <div class="alert alert-info alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> No details found.
                         </div> 
                         
                        @endif 
                  
