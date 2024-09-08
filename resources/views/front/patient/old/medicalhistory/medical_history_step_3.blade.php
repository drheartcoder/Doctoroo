@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<!--dashboard section-->            
<div class="middle-section">
   <div class="container">
     @include('front.layout._operation_status') 
      <div class="row">
         <div class="col-sm-12">
            <div class="med-his-txt">
               Your medical history is a record of your previous and present conditions, illnesses and surgeries. 
               By completing your medical history accurately, it allows your doctor to deliver proper care. It can also help speed the diagnosis of any complaints and point the way to proper treatment for you.  
            </div>
         </div>
      </div>
      <form action="{{ $module_url_path.'/store_step_3'}}" method="post" name="frm_step_two">
      {{csrf_field()}} 

      <input type="hidden" name="family_member_id" value="{{ $family_member_id or '' }}">
      
      <div class="back-whhit-bx patient-white-bx" style="background:#fff">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="see-d-dash-panel text-center">
                  @include('front.patient.layout.middlebar')
               </div>
            </div>
         </div>
         <div class="row">
            <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">&nbsp;</div>
            <div class="col-sm-12 col-md-12 col-lg-10 step4">
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="frm-bld">
                        Allergies
                     </div>
                     <div class="form-lable">Allergy &amp; Reaction</div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" name="allergies" id="allergies" placeholder="Allergy &amp; Reaction" class="form-inputs" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['allergies'])?$arr_medicalhistory['allergies']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="frm-bld">
                        Surgeries and Procedures
                     </div>
                     <div class="form-lable">When, why. successful? complications? </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" class="form-inputs" name="surgeries_and_procedures" id="surgeries_and_proceduress" placeholder="Surgeries and Procedures" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['surgeries_and_procedures'])?$arr_medicalhistory['surgeries_and_procedures']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>

            @if(isset($patient_age) && $patient_age>40)
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="form-lable">If over 40, had colonoscopy?</div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" name="had_colonoscopy" id="had_colonoscopy" placeholder="If over 50, had colonoscopy?" class="form-inputs" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['had_colonoscopy'])?$arr_medicalhistory['had_colonoscopy']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>
            @endif
          

               @if(isset($arr_patient['gender']) && $arr_patient['gender']=='F')
                  <div class=" user-box row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="frm-bld">
                           Obstetrics
                        </div>
                        <div class="frm-light"> If Female :</div>
                        <div class="form-lable">Past pregnancies? how many?</div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <textarea cols="" rows="" class="form-inputs" name="obstetrics" id="obstetrics" placeholder="Obstetrics" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['obstetrics'])?$arr_medicalhistory['obstetrics']:''}}</textarea>
                     </div>
                     <div class="clearfix"></div>
                  </div>
              @endif

               @if(isset($arr_patient['gender']) && $arr_patient['gender']=='F')
                  <div class=" user-box row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-lable">Complications? (miscarriages, diabetes, C-section etc)</div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <textarea cols="" rows="" name="complications" id="complications" placeholder="Complications? (miscarriages, diabetes, C-section etc)" class="form-inputs" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['complications'])?$arr_medicalhistory['complications']:''}}</textarea>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               @endif
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="frm-bld">
                        Family History
                     </div>
                     <div class="frm-light"> Since many diseases and conditions run in families,
                        please specify :
                     </div>
                     <div class="form-lable">Any medical cause of death of parents, grandparents, siblings and others (heart disease, stroke etc)</div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" name="family_history" id="family_history" placeholder="Family History" class="form-inputs" style="padding-top:10px;height:140px;">{{isset($arr_medicalhistory['family_history'])?$arr_medicalhistory['family_history']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="form-lable">Any genetic diseases known to be present in your family</div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" name="any_genetic_diseases" id="any_genetic_diseases" placeholder="Any genetic diseases known to be present in your family" class="form-inputs" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['any_genetic_diseases'])?$arr_medicalhistory['any_genetic_diseases']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class=" user-box row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <div class="frm-bld">
                        Other
                     </div>
                     <div class="form-lable">Any other issues or concerns that you'd like to note</div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6">
                     <textarea cols="" rows="" name="other" id="other" placeholder="Any other issues or concerns that you'd like to note" class="form-inputs" style="padding-top:10px;height:89px;">{{isset($arr_medicalhistory['other'])?$arr_medicalhistory['other']:''}}</textarea>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="col-sm-12">
                  <div class="btm-btns">
                     <button class="next-bttn" name="btn_extra_info" id="btn_extra_info" type="submit">Submit</button>
                  </div>
               </div>
            </div>
            <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">&nbsp;</div>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
      </div>
     </form> 
   </div>
</div>
<!--dashboard section-->
@stop
