                        <div class="tab-section">
                             <div class="doc-dash-right-bx">
                                 <div class="request-details-bx">
                                     <div class="table-responsive basic-table">
                                       <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>
                                               @if(isset($arr_medical_history['health_issue']) && $arr_medical_history['health_issue']!='')
                                                 <tr>
                                                     <td class="med-head">HEALTH ISSUE</td>
                                                 </tr>

                                                 <tr>
                                                     <td>
                                                          <span>{{isset($arr_medical_history['health_issue'])?$arr_medical_history['health_issue']:'NA'}}</span>

                                                     </td>
                                                 </tr>
                                              @endif
                                              
                                               @if(isset($illness_str) && $illness_str!='')
                                                 <tr>
                                                     <td class="med-head">CURRENT/PAST ILLNESSES AND CONDITIONS</td>
                                                 </tr>
                                                 <tr>
                                                     <td>
                                                        {!! $illness_str or '' !!}
                                                     </td>
                                                 </tr>
                                               @endif


                                                 <tr>
                                                     <td class="med-head">ABOUT LIFESTYLE</td>
                                                 </tr>
                                                 <tr>
                                                    <td>
                                                        <i class="fa fa-angle-double-right"></i> Daily Sleep
                                                            <span> : </span>
                                                         {{isset($arr_medical_history['daily_sleep'])?$arr_medical_history['daily_sleep']:'NA'}}<br/>

                                                        <i class="fa fa-angle-double-right"></i> Smoking
                                                          <span> : </span>
                                                         {{isset($arr_medical_history['smoking_frequency'])?$arr_medical_history['smoking_frequency']:'NA'}}<br/>

                                                         <i class="fa fa-angle-double-right"></i> Exercise
                                                         <span> : </span>
                                                         {{isset($arr_medical_history['excersice'])?$arr_medical_history['excersice']:'NA'}}<br/>

                                                         <i class="fa fa-angle-double-right"></i> Alcohol
                                                         <span> : </span>
                                                         {{isset($arr_medical_history['alcohol'])?$arr_medical_history['alcohol']:'NA'}}<br/>

                                                         <i class="fa fa-angle-double-right"></i> Stress Levels
                                                         <span> : </span>
                                                        {{isset($arr_medical_history['stress_level'])?$arr_medical_history['stress_level']:'NA'}}<br/>

                                                        <span><i class="fa fa-angle-double-right"></i></span>  Diet Pattern
                                                         <span> : </span>
                                                         {{isset($arr_medical_history['diet_pattern'])?$arr_medical_history['diet_pattern']:'NA'}}<br/>

                                                          <span><i class="fa fa-angle-double-right"></i></span> Marital Status
                                                         <span> : </span>
                                                        {{isset($arr_medical_history['marital_status'])?$arr_medical_history['marital_status']:'NA'}}<br/>

                                                   </td>
                                                 </tr>

                           
                                                 <tr>
                                                     <td class="med-head">BLOOD PRESSURE</td>
                                                 </tr>
                                                 <tr>
                                                     <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Sytolic Value
                                                      <span> : </span>
                                                       {{isset($arr_medical_history['sytolic_value'])?$arr_medical_history['sytolic_value']:'NA'}}<br/>
                                                 
                                                  
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Diastolic value
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['diastolic_value'])?$arr_medical_history['diastolic_value']:'NA'}}<br/>
                                                 
                                                  
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Pulse Value
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['pluse_value'])?$arr_medical_history['pluse_value']:'NA'}}<br/>
                                                 
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Measure Date
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['measure_date'])?$arr_medical_history['measure_date']:'NA'}}<br/>
                                                  
                                                   
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Time
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['time'])?$arr_medical_history['time']:'NA'}}
                                                   
                                                 </tr>
                                                 <tr>
                                                     <td class="med-head">BLOOD SUGAR</td>
                                                 </tr>
                                                 <tr>
                                                     <td style="color:#a5a5a5;font-family:'robotomedium';">
                                                      <span><i class="fa fa-angle-double-right"></i></span>Blood Sugar Rate
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['blood_sugar_value'])?$arr_medical_history['blood_sugar_value']:'NA'}}<br/>
                                                 
                                                 
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Meal
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['meal'])?$arr_medical_history['meal']:'NA'}}<br/>
                                                  
                                                    
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Measure Date
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['blood_sugar_measure_date'])?$arr_medical_history['blood_sugar_measure_date']:'NA'}}<br/>
                                                 
                                               
                                                      <span><i class="fa fa-angle-double-right"></i></span>   Time
                                                      <span> : </span>
                                                      {{isset($arr_medical_history['blood_sugar_time'])?$arr_medical_history['blood_sugar_time']:'NA'}}<br/>
                                                   </td>
                                                 </tr>

                                                @if(isset($arr_medical_history['allergies']) && $arr_medical_history['allergies']!='')
                                                   
                                                 <tr>
                                                     <td class="med-head">ALLERGIES</td>
                                                 </tr>
                                                 <tr>
                                                     <td>{{isset($arr_medical_history['allergies'])?$arr_medical_history['allergies']:'NA'}}</td>
                                                 </tr>
                                                @endif

                                                @if(isset($arr_medical_history['surgeries_and_procedures']) && $arr_medical_history['surgeries_and_procedures']!='')
                                                 <tr>
                                                     <td class="med-head">SURGERIES AND PROCEDURES</td>
                                                 </tr>
                                                 <tr>
                                                       <td>{{isset($arr_medical_history['surgeries_and_procedures'])?$arr_medical_history['surgeries_and_procedures']:'NA'}}
                                                       </td>
                                                 </tr>
                                                @endif

                                               @if(isset($arr_medical_history['obstetrics']) && $arr_medical_history['obstetrics']!='')
                                                 <tr>
                                                   <td class="med-head">OBSTETRICS</td>
                                                </tr>
                                                 <tr>
                                                   <td>{{isset($arr_medical_history['obstetrics'])?$arr_medical_history['obstetrics']:'NA'}}
                                                   </td>
                                                </tr>
                                             @endif
                                               @if(isset($arr_medical_history['complications']) && $arr_medical_history['complications']!='')
                                                 <tr>
                                                   <td class="med-head">COMPLICATIONS</td>
                                                </tr>
                                                 <tr>
                                                   <td>{{isset($arr_medical_history['complications'])?$arr_medical_history['complications']:'NA'}}
                                                   </td>
                                                </tr>
                                             @endif
                                             @if(isset($arr_medical_history['family_history']) && $arr_medical_history['family_history']!='')
                                                <tr>
                                                   <td class="med-head">FAMILY HISTORY</td>
                                                </tr>
                                                 <tr>
                                                   <td>{{isset($arr_medical_history['family_history'])?$arr_medical_history['family_history']:'NA'}}
                                                   </td>
                                                </tr>
                                             @endif
                                             @if(isset($arr_medical_history['any_genetic_diseases']) && $arr_medical_history['any_genetic_diseases']!='')
                                                <tr>
                                                   <td class="med-head">DISEASES</td>
                                                </tr>
                                                 <tr>
                                                   <td>{{isset($arr_medical_history['any_genetic_diseases'])?$arr_medical_history['any_genetic_diseases']:'NA'}}
                                                   </td>
                                                </tr>
                                             @endif
                                              @if(isset($arr_medical_history['other']) && $arr_medical_history['other']!='')
                                                <tr>
                                                   <td class="med-head">OTHER</td>
                                                </tr>
                                                 <tr>
                                                   <td>{{isset($arr_medical_history['other'])?$arr_medical_history['other']:'NA'}}
                                                   </td>
                                                </tr>
                                              @endif
                                          </tbody>
                                       </table>
                                     </div>
                                     <div class="clearfix"></div>
                                 </div>
                             </div>
                         </div>