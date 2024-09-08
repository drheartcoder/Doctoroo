@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
 <script  src="{{url('/')}}/public/js/responsivetabs.js"></script>
<!--dashboard section-->            
<div class="middle-section">
   <div class="container">
      <div data-responsive-tabs class="garag-profile-nav ans-tabs">
         <nav>
            <ul>
               <li><a href="#one">Medical History</a> </li>
               <li><a href="#two">Medications</a></li>
               <li><a href="#three">Medical Documentation</a></li>
            </ul>
         </nav>
         <div class="content res-full-tab">

            <div id="one">
               <div class="tab-section">
                  <div class="doc-dash-right-bx" style="margin:0;">
                     <div class="request-details-bx">
                        <div class="table-responsive basic-table">
                           <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0" border="0">
                              <tbody>
                                <tr>
                                  <td>
                                     @include('front.layout._operation_status')
                                  </td>
                                
                                </tr>
                                @if(!empty($arr_medical_history['health_issue']) && $arr_medical_history['health_issue']!="")
                                 <tr>
                                    <td class="med-head">Health Issue</td>
                                 </tr>
                                 <tr>
                                     
                                    <td>
                                       @if(isset($arr_medical_history['health_issue']) && strlen($arr_medical_history['health_issue']) >=150)
                                          {{ str_limit($arr_medical_history['health_issue'], 150).'..' }}
                                       @endif
                                    </td>
                                 </tr>
                                {{--@else
                                  <tr><td>{{ 'Health issues are not added yet.' }}</td></tr>  
                                --}}

                                @endif
                                @if($illness_str!="")
                                 <tr>
                                    <td class="med-head">Current/Past Illnesses and Conditions</td>
                                 </tr>
                                 <tr>
                                    <td style="color:#a5a5a5;font-family:'robotomedium';">
                                       
                                       {!! $illness_str or '' !!}

                                    </td>
                                 </tr>
                                 @endif

                                 @if( !empty($arr_medical_history['daily_sleep']) || !empty($arr_medical_history['smoking_frequency']) ||
                                 !empty($arr_medical_history['excersice']) || !empty($arr_medical_history['alcohol']) ||
                                 !empty($arr_medical_history['stress_level']) || !empty($arr_medical_history['diet_pattern']) || !empty($arr_medical_history['marital_status']))
                                 <tr>
                                    <td class="med-head">About Lifestyle</td>
                                 </tr>
                                 <tr>

                                    <td>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Daily Sleep:
                                      {{ $arr_medical_history['daily_sleep'] or '' }}<br/>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Smoking:
                                      {{ $arr_medical_history['smoking_frequency'] or '' }}<br/>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Exercise:
                                      {{ $arr_medical_history['excersice'] or '' }}<br/>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Alcohol:
                                      {{ $arr_medical_history['alcohol'] or '' }}
                                      <br/>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Stress Levels:
                                      {{ $arr_medical_history['stress_level'] or '' }}
                                      <br/>
                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Diet Pattern:
                                      {{ $arr_medical_history['diet_pattern'] or '' }}
                                      <br/>

                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Recreational drug use :
                                      {{ $arr_medical_history['recreational_drug_use'] or '' }}
                                      <br/>

                                      <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Marital Status:
                                      {{ $arr_medical_history['marital_status'] or '' }}
                                      <br/>
                                    </td>
                                
                                 </tr>
                                 @else
                                  <tr><td>{{ 'Lifestyle is not added yet.' }}</td></tr>  
                                 @endif
                                 @if(!empty($arr_medical_history['sytolic_value']) || !empty($arr_medical_history['diastolic_value']) || !empty($arr_medical_history['pluse_value']) || !empty($arr_medical_history['measure_date']) || !empty($arr_medical_history['time']))
                                 <tr>
                                    <td class="med-head">Blood Pressure</td>
                                 </tr>
                                 <tr>
                                    <td>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Sytolic value:
                                          {{ $arr_medical_history['sytolic_value'] or '' }}<br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Diastolic value:
                                          {{ $arr_medical_history['diastolic_value'] or '' }}<br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Pulse Value:
                                           {{ $arr_medical_history['pluse_value'] or '' }}<br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Measure Date:
                                          {{ $arr_medical_history['measure_date'] or '' }}
                                          <br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Time:
                                           {{ $arr_medical_history['time'] or '' }}
                                           <br/>
                                           
                                    </td>
                                 </tr>
                                 @endif

                                 @if(!empty($arr_medical_history['blood_sugar_value']) || !empty($arr_medical_history['meal']) || !empty($arr_medical_history['blood_sugar_measure_date']) ||  !empty($arr_medical_history['blood_sugar_time']))                                 <tr>
                                    <td class="med-head">Blood Sugar</td>
                                 </tr>
                                 <tr>
                                    <td> 
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Blood sugar rate:
                                          {{ $arr_medical_history['blood_sugar_value'] or '' }}<br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Meal:
                                          {{ $arr_medical_history['meal'] or '' }}<br/>

                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Measure Date:
                                          {{ $arr_medical_history['blood_sugar_measure_date'] or '' }}
                                          <br/>
                                          <span><i class="fa fa-angle-double-right"></i></span> &nbsp; Time:
                                           {{ $arr_medical_history['blood_sugar_time'] or '' }}
                                           <br/>
                                    </td>
                                 </tr>
                                 @else
                                   <tr><td>{{ 'Health details are not added yet.' }}</td></tr>  
                                 @endif

                                 @if(!empty($arr_medical_history['allergies']))
                                     <tr>
                                        <td class="med-head">Allergies</td>
                                     </tr>
                                      <tr>
                                        <td>{{ $arr_medical_history['allergies'] or '' }}</td>
                                     </tr>
                                 @endif

                                 @if(!empty($arr_medical_history['surgeries_and_procedures']))
                                    <tr>
                                      <td class="med-head">Surgeries and Procedures</td>
                                   </tr>
                                    <tr>
                                      <td>{{ $arr_medical_history['surgeries_and_procedures'] or '' }}</td>
                                   </tr>
                                 @endif

                                 @if(!empty($arr_medical_history['obstetrics']))
                                    <tr>
                                      <td class="med-head">Obstetrics</td>
                                    </tr>
                                    <tr>
                                      <td>{{ $arr_medical_history['obstetrics'] or '' }}</td>
                                    </tr>
                                  @endif
                                  @if(!empty($arr_medical_history['complications']))
                                      <tr>
                                        <td class="med-head">Complications</td>
                                      </tr>
                                      <tr>
                                        <td>{{ $arr_medical_history['complications'] or '' }}</td>
                                      </tr>
                                  @endif
                                  @if(!empty($arr_medical_history['family_history']))
                                     <tr>
                                      <td class="med-head">Family History</td>
                                    </tr>
                                    <tr>
                                      <td>{{ $arr_medical_history['family_history'] or '' }}</td>
                                    </tr>
                                  @endif
                                  @if(!empty($arr_medical_history['any_genetic_diseases']))
                                    <tr>
                                      <td class="med-head">Diseases</td>
                                    </tr>
                                    <tr>
                                      <td>{{ $arr_medical_history['any_genetic_diseases'] or '' }}</td>
                                    </tr>
                                  @endif
                                  @if(!empty($arr_medical_history['other']))
                                     <tr>
                                      <td class="med-head">Other</td>
                                    </tr>
                                    <tr>
                                      <td>{{ $arr_medical_history['other'] or '' }}</td>
                                    </tr>
                                  @endif

                              </tbody>
                           </table>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="two">

               <div class="tab-section">
                  <div class="tab-heding">
                     <h2> Current Medications</h2>
                     <button class="helth-add-btn" onclick="addCurrentMedication()">Add</button>
                  </div>
                  
                  @if(isset($arr_curr_medicalhistory) && sizeof($arr_curr_medicalhistory)>0)
                  <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                        <tr class="table-head">
                           <td>Name</td>
                           <td>Date Started</td>
                           <td>Quantity Taken</td>
                           <td>Period Taken</td>
                            <td>Use</td>
                           <td style="text-align:center;">Action</td>
                        </tr>

                     @foreach($arr_curr_medicalhistory as $medical_history)
                        <tr>
                           <td style="padding-top: 20px ! important;">{{ ($medical_history['medication_name']!="")?$medical_history['medication_name']:'--'}}</td>

                           <td>
                              <div class="qnty-drop">
                                 <?php $date = ''; ?>
                                 @if(isset($medical_history['date_started']) && $medical_history['date_started']!='')

                                   <?php $date = date('d M,Y',strtotime($medical_history['date_started']))  ?>

                                 @endif
                                 @if($date!="01 Jan,1970")
                                  {{ $date }}
                                 @else
                                 {{ '--' }}
                                 @endif
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                                 {{ ($medical_history['m_number']!="")?$medical_history['m_number']:'--'}}
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                                 {{ ($medical_history['frequency'])?$medical_history['frequency']:'--' }}
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                              <?php $medicine_use = ''; ?>
                                @if(isset($medical_history['m_use']))

                                  @if(strlen($medical_history['m_use'])>60)
                                   <?php  $medicine_use = str_limit($medical_history['m_use'],60); ?>
                                  @else
                                     <?php $medicine_use = $medical_history['m_use']; ?>
                                  @endif

                                @endif

                                {{ ($medicine_use)?$medicine_use:'--' }}
                              
                              </div>
                           </td>
                            <td style="text-align:center;"> <a onclick="delete_medication('{{ base64_encode($medical_history['id']) }}')" class="grn-drp"> <i class="fa fa-trash"></i></a></td>
                        </tr>
                        
                    @endforeach     
                       
                      
                     
                     </table>
                      </div>

                    @else
                           <div class="search-grey-bx">
                                <div class="row">
                                     {{ 'Currently no medication present' }}
                                </div>
                            </div>

                    
                    @endif
                 
               

                  <br/>
                  <div class="tab-heding">
                     <h2> Past Medications</h2>
                     <button class="helth-add-btn" onclick="addPastMedication()">Add</button>
                  </div>

              

                 
                   @if(isset($arr_past_medicalhistory) && sizeof($arr_past_medicalhistory)>0)
                   <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                        <tr class="table-head">
                           <td>Name</td>
                           <td>Date Started</td>
                           <td>Quantity Taken</td>
                           <td>Period Taken</td>
                            <td>Use</td>
                           <td style="text-align:center;">Action</td>
                        </tr>

                      @foreach($arr_past_medicalhistory as $medical_history)
                        <tr>
                        
                           <td style="padding-top: 20px ! important;">{{ ($medical_history['medication_name']!="")?$medical_history['medication_name']:'--' }}</td>

                           <td>
                              <div class="qnty-drop">

                                 @if(isset($medical_history['date_started']) && $medical_history['date_started']!='')
                                 <?php 
                                  $date = '';
                                  $date = date('d M,Y',strtotime($medical_history['date_started']))  
                                 ?>
                                 @endif
                                 @if($date!="01 Jan,1970")
                                  {{ $date }}
                                 @else
                                 {{ '--' }}
                                 @endif
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                                {{ ($medical_history['m_number']!="")?$medical_history['m_number']:'--'}}
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                                 {{ ($medical_history['frequency'])?$medical_history['frequency']:'--' }}
                              </div>
                           </td>
                           <td>
                              <div class="qnty-drop">
                            
                                 <?php $medicine_use = ''; ?>
                                @if(isset($medical_history['m_use']))

                                  @if(strlen($medical_history['m_use'])>60)
                                   <?php  $medicine_use = str_limit($medical_history['m_use'],60); ?>
                                  @else
                                     <?php  $medicine_use = $medical_history['m_use']; ?>
                                  @endif

                                @endif

                                {{ ($medicine_use)?$medicine_use:'--' }}
                              </div>
                           </td>
                           <td style="text-align:center;"> <a onclick="delete_medication('{{ base64_encode($medical_history['id']) }}')" class="grn-drp"> <i class="fa fa-trash"></i></a></td>
                        </tr>
                     @endforeach

                     </table>
                      </div>
                  @else
                         <div class="search-grey-bx">
                             <div class="row">
                                {{ 'Past medication are not present' }}
                              </div>
                          </div>

                    
                  @endif
                 
               
                  <div class="clearfix"></div>
                  <br/>
               </div>
            </div>
            <div id="three">
               <div class="tab-section">
                  <div class="tab-heding">
                     <h2>Current Prescription</h2>
                  </div>

               
                
                       
                      @if(isset($arr_curr_prescription) && sizeof($arr_curr_prescription)>0) 
                       <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                          <tr class="table-head">
                             <td>Prescription File</td>
                             <td style="text-align:center;">Action</td>
                          </tr>
                       
                           @foreach($arr_curr_prescription as $file)
                            @if(isset($file['file_name']) && $file['file_name']!="")
                            <tr>
                               <td style="padding-top: 20px ! important;"><a class="see-green">{{ $file['file_name'] or '' }}</a></td>
                               <td style="text-align:center;"> <a href="{{ $module_url_path }}/download/{{ base64_encode($file['id']) }}" class="grn-drp"> <i class="fa fa-cloud-download"></i></a></td>
                            </tr>

                            
                            @endif
                          @endforeach
                             </table>
                       </div>
                        @else
                       
                           <div class="search-grey-bx">
                                <div class="row">
                                      {{ 'Currenly no prescriptions are present.' }}
                                </div>
                          </div>

                        @endif
                        
                
                  

                  <br/>
                 
                  <div class="tab-heding">
                     <h2>Past Prescription</h2>
                  </div>
                 

                  @if(isset($arr_past_prescription) && sizeof($arr_past_prescription)>0)
                    <div class="table-responsive basic-table not-tble pre-table" style="margin-bottom:20px;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                        <tr class="table-head">
                            <td>Prescription File</td>
                             <td style="text-align:center;">Action</td>
                        </tr>
                         @foreach($arr_past_prescription as $files)

                           @if(isset($files['file_name']) && $files['file_name']!="")
                            <tr>
                               <td style="padding-top: 20px ! important;"><a class="see-green">{{ $files['file_name'] or '' }}
                               </a></td>
                               <td style="text-align:center;"> <a href="{{ $module_url_path }}/download/{{base64_encode($files['id']) }}" class="grn-drp"> <i class="fa fa-cloud-download"></i></a></td>
                            </tr>
                          @endif
                        @endforeach
                    </table>
                   </div>
                  @else
                           <div class="search-grey-bx">
                                <div class="row">
                                      {{ 'No past prescriptions are present.' }}
                                </div>
                          </div>                      
                   @endif
                 


               </div>
            </div>
         </div>
      </div>
   </div>
</div>

    <div id="add_current_medication" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
             <div class="modal-dialog loign-insw">
                <!-- Modal content-->
                <div class="modal-content logincont">
                   <div class="modal-header head-loibg">
                      <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
                   </div>

                  <form action="{{ $module_url_path }}/add_medication" enctype="multipart/form-data" method="post" name="frm_add_medication" id="frm_add_medication">
                  {{ csrf_field() }}
                   <div class="modal-body bdy-pading">
                       <div class="login_box">
                        <div class="title_login">Add Current Medication</div>

                             <input type="hidden" name="type" value="current">

                             <div class="user_box">
                                  <input type="text" class="input_acct-logn" data-rule-required="true" name="medication_name" placeholder="Medication Name" />
                                  <div class="clearfix"></div>
                             </div>

                             <div class="user_box">
                                    <input type="text" class="input_acct-logn datepicker medication_current_date" data-rule-required="true" name="medication_date"  placeholder="Date Started" />
                                    <div class="clearfix"></div>
                             </div>

                               <div class="user_box">
                                  <div class="select-style pharma-step-drp">
                                      <select class="frm-select" name="medication_quantity" data-rule-required="true">
                                        <option value="">Quantity Taken</option>
                                          @for($i=1;$i<100;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                          @endfor
                                      </select>

                                  </div>
                                
                                   <span id="err_quantity"></span>
                              </div>
                              <div class="user_box">
                                  <div class="select-style pharma-step-drp">
                                      <select class="frm-select" data-rule-required="true" name="period_taken">
                                        <option value="">Period Taken</option>
                                        <option value="Every 3 Hours">Every 3 Hours</option>
                                        <option value="Every 4 Hours">Every 4 Hours</option>
                                        <option value="Every 6 Hours">Every 6 Hours</option>
                                        <option value="Every 8 Hours">Every 8 Hours</option>
                                        <option value="Every 12 Hours">Every 12 Hours</option>
                                        <option value="Every 24 Hours">Every 24 Hours</option>
                                        <option value="2 Times a Day">2 Times a Day</option>
                                        <option value="3 Times a Day">3 Times a Day</option>
                                        <option value="4 Times a Day">4 Times a Day</option>
                                        <option value="5 Times a Day">5 Times a Day</option>
                                      </select>
                                  </div>
                                  <span id="err_period_taken"></span>
                                  <div class="clearfix"></div>
                              </div> 

                              <div class="user_box">
                                  <input type="text" class="input_acct-logn" data-rule-required="true" name="use" placeholder="Use" />
                                  <span id="err_use"></span> 
                                  <div class="clearfix"></div>
                              </div>
                            
                               <div class="user_box">
                                   <input type="file" id="current_medication_file" style="visibility:hidden; height: 0;" name="current_medication_file"/>
                                   <div class="input-group pharma-up">
                                      <div class="btn btn-primary btn-file btn-gry">
                                         <a class="file" onclick="browseCurrentMedicationFile()">Chooose file
                                         </a>
                                      </div>
                                      <input type="text" placeholder="Upload Logo" class="form-control file-caption  kv-fileinput-caption" id="current_medi_name" disabled="disabled"/>
                                      <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                      <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_current_medication">
                                         <a class="file" onclick="removeCurrentMedicationFile()"><i class="fa fa-trash"></i>
                                         </a>
                                      </div>
                                   </div>
                                    <span class="note">Note:Supported file type jpeg,png,jpg.</span>
                                    <div class="error" id="err_profile_image"></div>
                                </div>

                       
                      <div class="see-d-dash-panel text-center" style="padding: 0px;">
                        <input type="submit" name="btn_add_medication" value="submit" class="btn-grn" style="margin:0 auto 30px;">
                      </div>

                     </div>
               
                  </div>

                </form>

                </div>
             </div>
       </div>

           <div id="add_past_medication" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
             <div class="modal-dialog loign-insw">
                <!-- Modal content-->
                <div class="modal-content logincont">
                   <div class="modal-header head-loibg">
                      <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
                   </div>

                  <form action="{{ $module_url_path }}/add_medication" enctype="multipart/form-data" method="post" name="frm_past_medication" id="frm_past_medication">
                  {{ csrf_field() }}
                   <div class="modal-body bdy-pading">
                       <div class="login_box">
                        <div class="title_login">Add Past Medication</div>

                             <input type="hidden" name="type" value="past">

                             <div class="user_box">
                                  <input type="text" class="input_acct-logn" data-rule-required="true" name="medication_name" placeholder="Medication Name" />
                                  <div class="clearfix"></div>
                             </div>

                             <div class="user_box">
                                    <input type="text" class="input_acct-logn datepicker medication_past_date" data-rule-required="true" name="medication_date"  placeholder="Date Started" />
                                    <div class="clearfix"></div>
                             </div>

                               <div class="user_box">
                                  <div class="select-style pharma-step-drp">
                                      <select class="frm-select" name="medication_quantity" data-rule-required="true">
                                        <option value="">Quantity Taken</option>
                                          @for($i=1;$i<100;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                          @endfor
                                      </select>

                                  </div>
                                
                                   <span id="err_quantity"></span>
                              </div>
                              <div class="user_box">
                                  <div class="select-style pharma-step-drp">
                                      <select class="frm-select" data-rule-required="true" name="period_taken">
                                          <option value="">Period Taken</option>
                                          <option value="Every 3 Hours">Every 3 Hours</option>
                                          <option value="Every 4 Hours">Every 4 Hours</option>
                                          <option value="Every 6 Hours">Every 6 Hours</option>
                                          <option value="Every 8 Hours">Every 8 Hours</option>
                                          <option value="Every 12 Hours">Every 12 Hours</option>
                                          <option value="Every 24 Hours">Every 24 Hours</option>
                                          <option value="2 Times a Day">2 Times a Day</option>
                                          <option value="3 Times a Day">3 Times a Day</option>
                                          <option value="4 Times a Day">4 Times a Day</option>
                                          <option value="5 Times a Day">5 Times a Day</option>

                                      </select>
                                  </div>
                                  <span id="err_period_taken"></span>
                                  <div class="clearfix"></div>
                              </div> 

                              <div class="user_box">
                                  <input type="text" class="input_acct-logn" data-rule-required="true" name="use" placeholder="Use" />
                                  <span id="err_use"></span> 
                                  <div class="clearfix"></div>
                              </div>


                                <div class="user_box">
                                         <input type="file" id="past_medication_file" style="visibility:hidden; height: 0;" name="past_medication_file"/>
                                         <div class="input-group pharma-up">
                                            <div class="btn btn-primary btn-file btn-gry">
                                               <a class="file" onclick="browsePastMedicationFile()">Chooose file
                                               </a>
                                            </div>
                                            <input type="text" placeholder="Upload Logo" class="form-control file-caption  kv-fileinput-caption" id="doc_past_medi_name" disabled="disabled"/>
                                            <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                            <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_past_medication">
                                               <a class="file" onclick="removePastMedicationFile()"><i class="fa fa-trash"></i>
                                               </a>
                                            </div>
                                         </div>
                                          <span class="note">Note:Supported file type jpeg,png,jpg.</span>
                                          <div class="error" id="err_profile_image"></div>
                                </div>
                      
                       
                          <div class="see-d-dash-panel text-center" style="padding: 0px;">
                            <input type="submit" name="btn_add_medication" value="submit" class="btn-grn" style="margin:0 auto 30px;">
                          </div>

                     </div>
               
                  </div>

                </form>

                </div>
             </div>
       </div>

<!--dashboard section-->
<!--responsive tab script start-->
<script>
      

    $(document).ready(function(){

          $('.medication_current_date').datepicker({ minDate: 0 });
 
         $('.medication_past_date').datepicker({  maxDate: 0 });


    })


       $(document).on('responsive-tabs.initialised', function(event, el) {
             
       });
   
      $(document).on('responsive-tabs.change', function(event, el, newPanel) {
         
      });
   
      $('[data-responsive-tabs]').responsivetabs({
          initialised: function() {
             
          },
   
          change: function(newPanel) {
              
          }
      });


      /*Browse file for past medication start*/
      function browsePastMedicationFile() {
     
          $("#past_medication_file").trigger('click');

      }

      function removePastMedicationFile() {
         $('#doc_past_medi_name').val("");
         $("#btn_remove_past_medication").hide();
         $("#past_medication_file").val("");
      }
     
    
      $('#past_medication_file').change(function() 
      {
         if ($(this).val().length > 0) {
             $("#btn_remove_past_medication").show();
         }
       
         $('#doc_past_medi_name').val($(this).val());
      });

       /*Browse file for past medication end*/



       /*Browse file for current medication start*/
      function browseCurrentMedicationFile() {
     
          $("#current_medication_file").trigger('click');

      }

      function removeCurrentMedicationFile() {
         $('#current_medi_name').val("");
         $("#btn_remove_current_medication").hide();
         $("#current_medication_file").val("");
      }
     
    
      $('#current_medication_file').change(function() 
      {
         if ($(this).val().length > 0) {
             $("#btn_remove_current_medication").show();
         }
       
         $('#current_medi_name').val($(this).val());
      });

       /*Browse file for current medication end*/


</script>
<script>
  function addCurrentMedication()
  {
      $('#add_current_medication').modal('toggle');
  }
  function addPastMedication()
  {
      $('#add_past_medication').modal('toggle');
  }
  $(document).ready(function(){


        $("#frm_add_medication").validate({
                
             
                errorElement: 'span',
                rules: 
                {  
                   
                    current_medication_file: {
                        accept: "image/jpeg,image/png,image/jpg"
                    },
               
                },
               messages: {

                                'medication_name'      : "Please enter a  medicine name",
                                'medication_date'      : "Please enter a  medication date",
                                'period_taken'         : "Please enter a  medication period",
                                'medication_quantity'  : "Please enter a  medicine quantity",
                                'use'                  : "Please enter a  medicine use",
                                'current_medication_file' :"Please enter a valid medication file",


                           }
                             
         }); 



        $("#frm_past_medication").validate({
                
             
                errorElement: 'span',
                rules: 
                {  
                   
                    past_medication_file: {
                        accept: "image/jpeg,image/png,image/jpg"
                    },
               
                },
                 messages: {

                                  'medication_name'      : "Please enter a  medicine name",
                                  'medication_date'      : "Please enter a  medication date",
                                  'period_taken'         : "Please enter a  medication period",
                                  'medication_quantity'  : "Please enter a  medicine quantity",
                                  'use'                  : "Please enter a  medicine use",
                                  'past_medication_file' :"Please enter a valid medication file",


                             }
                             
         }); 

        

  });

  $('#frm_add_medication').submit(function(){

        var form   = $(this);
        var isValid = form.valid();
        if(isValid)
        {
          showProcessingOverlay();
        }

  });

  $('#frm_past_medication').submit(function(){

        var form   = $(this);
        var isValid = form.valid();
        if(isValid)
        {
          showProcessingOverlay();
        }

  });

  function delete_medication(elem)
  { 
        swal({
        title: "Are you sure?",
        text: "You want to delete this medication details?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        //closeOnCancel: false
     },
     
        function(isConfirm)
        {

            if (isConfirm)
            {
               //swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
               window.location.href= '{{ $module_url_path }}/delete/'+elem;
            } 
      });
}
  
</script>

@stop
