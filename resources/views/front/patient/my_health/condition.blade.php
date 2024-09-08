@extends('front.patient.layout._dashboard_master')
@section('main_content')
<div class="header bookhead ">
   <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
   <h1 class="main-title center-align">My Health</h1>
   <div class="fix-add-btn position-top" style="display: none;" id="add_medication_box">
      <a href="{{ url('/') }}/patient/my_health/add_medication" id="add_new_medication">
         <span class="grey-text">Add Medication</span>
         <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
      </a>
   </div>
</div>
<!-- SideBar Section -->
@include('front.patient.layout._sidebar')
<div class="mar300  has-header">
   <div class="consultation-tabs">
      <ul class="tabs tabs-fixed-width">
         <li class="tab col s3">
            <a href="{{ url('/') }}/patient/my_health/medical_history/general" id="tab_test2" class="redirect_medical active"> <span><img src="{{ url('/') }}/public/new/images/medical-history.svg" alt="icon" class="tab-icon" /> </span> Medical History</a>
         </li>
         <li class="tab col s3">
            <a href="{{ url('/') }}/patient/my_health/documents/consultation" class="redirect_documents"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Documents</a>
         </li>
         <li class="tab col s3">
            <a href="{{ url('/') }}/patient/my_health/doctor_Activity" class="doctor_Activity"> <span><img src="{{ url('/') }}/public/new/images/medical-document.svg" alt="icon" class="tab-icon" /> </span>Doctor Activity</a>
         </li>
      </ul>
   </div>

   <div class="container minhtnor">
      <style>
         .required_field
         {
            color:red;
         }
      </style>
      <div id="history" class="tab-content medicationmain">
        <div class="tabs footer ">
            <?php
               $general = $conditions = $medication = $lifestyle = "";
               
               if($active_tab_id=='general')
               {
                 $general='active';
               }
               else if($active_tab_id=='medication')
               {
                 $medication='active';
                 ?>
                 <style>
                     #add_medication_box{display:inline-block !important;}
                 </style>
            <?php
               }
               else if($active_tab_id=='lifestyle')
               {
                  $lifestyle='active';
                 
               }
               ?>
            <ul class="tabs tabs-fixed-width">
               <li class="tab" id="general_tab">
                  <a href="#general"><span class="gen {{$general}}"><img src="{{ url('/') }}/public/new/images/general.svg" alt="icon" class="tab-icon"/> </span> General </a>
               </li>
               <li class="tab" id="medication_tab">
                  <a href="#medication-condition" class="{{$medication}}"> <span class="medica-i"><img src="{{ url('/') }}/public/new/images/medication-icon-his.svg" alt="icon" class="tab-icon"/> </span>Medication</a>
               </li>
               <li class="tab" id="lifestyle_tab">
                  <a href="#lifestyle" class="{{$lifestyle}}"> <span class="lifes-i"><img src="{{ url('/') }}/public/new/images/lifestyle-icon.svg" alt="icon" class="tab-icon" /> </span>Lifestyle</a>
               </li>
            </ul>
         </div>



         
         <div id="general" class="tab-content ">
            <div class="gray-strip">
               <div class="bluedoc-text">
                  <strong>General</strong> - Select / enter details of the below general history
               </div>
            </div>
            <ul class="collection brdrtopsd">

                           
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="allergy" {{isset($general_health_arr['allergy']) && $general_health_arr['allergy'] =='yes' ? 'checked' : ''}} />
                     <label for="allergy" class="bluedoc-text">Allergies</label>
                  </div>

                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['allergy_details']) ? $general_health_arr['allergy_details'] :''}} */ ?>" id="allergy_details" style="{{isset($general_health_arr['allergy']) && $general_health_arr['allergy'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['allergy_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var allergy_details      = "{{ $general_health_arr['allergy_details'] }}"; 
                                   var card_id              = "{{ $user_details->dump_id }}"
                                   var userkey              = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                   var key                  = api.keys.import(userkey);
                                       var decrypt_allergy_details   = key.decrypt(allergy_details).toString();
                                       $('#allergy_details').val(decrypt_allergy_details);
                               });
                            </script>
          
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>

               </li>

               <li class="collection-item posrel">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="surgery" {{isset($general_health_arr['surgery']) && $general_health_arr['surgery'] =='yes'  ? 'checked' : ''}} />
                     <label for="surgery" class="bluedoc-text">Surgeries / Procedures</label>
                  </div>
                  <div class="hisdetails">
                     <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['surgery_details']) ? $general_health_arr['surgery_details'] :''}} */ ?>" id="surgery_details" style="{{isset($general_health_arr['surgery']) && $general_health_arr['surgery'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['surgery_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var surgery_details      = "{{ $general_health_arr['surgery_details'] }}"; 
                                   var card_id              = "{{ $user_details->dump_id }}";
                                   var userkey              = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                   var key                  = api.keys.import(userkey);
                                       var decrypt_surgery_details   = key.decrypt(surgery_details).toString();
                                       $('#surgery_details').val(decrypt_surgery_details);
                               });
                            </script>
          
                        <?php
                        } ?>
                     </div>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="pregnancy" {{isset($general_health_arr['pregnancy']) && $general_health_arr['pregnancy'] == 'yes' ? 'checked' : ''}} />
                     <label for="pregnancy" class="bluedoc-text smalltext">Pregnancies
                     <br>
                     <small class="grey-text">Past pregnancies? Complications?</small></label>
                  </div>
                  <div class="hisdetails">
                     <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['pregnancy_details']) ? $general_health_arr['pregnancy_details'] :''}} */ ?>" id="pregnancy_details" style="{{isset($general_health_arr['pregnancy']) && $general_health_arr['pregnancy'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['pregnancy_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var pregnancy_details      = "{{ $general_health_arr['pregnancy_details'] }}"; 
                                   var card_id              = "{{ $user_details->dump_id }}";
                                   var userkey              = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                   var key                  = api.keys.import(userkey);
                                       var decrypt_pregnancy_details   = key.decrypt(pregnancy_details).toString();
                                       $('#pregnancy_details').val(decrypt_pregnancy_details);
                               });
                            </script>
          
                        <?php
                        } ?>
                     </div>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="family_history" {{isset($general_health_arr['family_history']) && $general_health_arr['family_history'] == 'yes' ? 'checked' : ''}} />
                     <label for="family_history" class="bluedoc-text">Family history</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['family_history_details']) ? $general_health_arr['family_history_details'] :''}} */ ?>" id="family_history_details" style="{{isset($general_health_arr['family_history']) && $general_health_arr['family_history'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['family_history_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var family_history_details      = "{{ $general_health_arr['family_history_details'] }}"; 
                                   var card_id              = "{{ $user_details->dump_id }}";
                                   var userkey              = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                   var key                  = api.keys.import(userkey);
                                       var decrypt_family_history_details   = key.decrypt(family_history_details).toString();
                                       $('#family_history_details').val(decrypt_family_history_details);
                               });
                            </script>
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="other" {{isset($general_health_arr['other']) && $general_health_arr['other'] == 'yes' ? 'checked' : ''}} />
                     <label for="other" class="bluedoc-text">Other</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['other_details']) ? $general_health_arr['other_details'] :''}} */ ?>" id="other_details" style="{{isset($general_health_arr['other']) && $general_health_arr['other'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['other_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var other_details  = "{{ $general_health_arr['other_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                    = api.keys.import(userkey);
                                       var decrypt_other_details   = key.decrypt(other_details).toString();
                                       $('#other_details').val(decrypt_other_details);
                               });
                            </script>
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>
               </li>

               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="diabetes" {{isset($general_health_arr['diabetes']) && $general_health_arr['diabetes'] == 'yes' ? 'checked' : ''}} />
                     <label for="diabetes" class="bluedoc-text">Diabetes</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['diabetes_details']) ? $general_health_arr['diabetes_details'] :''}} */ ?>" id="diabetes_details" style="{{isset($general_health_arr['diabetes']) && $general_health_arr['diabetes'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['diabetes_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var diabetes_details  = "{{ $general_health_arr['diabetes_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                    = api.keys.import(userkey);
                                       var decrypt_diabetes_details   = key.decrypt(diabetes_details).toString();
                                       $('#diabetes_details').val(decrypt_diabetes_details);
                               });
                            </script>
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item posrel">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="heart_desease" {{isset($general_health_arr['heart_disease']) && $general_health_arr['heart_disease'] == 'yes' ? 'checked' : ''}}  />
                     <label for="heart_desease" class="bluedoc-text">Heart Disease (CHF, MI)</label>
                  </div>
                  <div class="hisdetails">
                     <div class="input-field ">
                        <input type="text" id="heart_desease_detail" value="<?php /* {{isset($general_health_arr['heart_disease_details'])? $general_health_arr['heart_disease_details'] : ''}} */ ?>" id="reason" class="validate heart_desease_detail" placeholder="Enter details if required" style="{{isset($general_health_arr['heart_disease']) && $general_health_arr['heart_disease'] == 'yes' ? '' : 'display:none'}}" >
                        <?php if(isset($general_health_arr['heart_disease_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var heart_disease_details  = "{{ $general_health_arr['heart_disease_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                    = api.keys.import(userkey);
                                       var decrypt_heart_disease_details   = key.decrypt(heart_disease_details).toString();
                                       $('.heart_desease_detail').val(decrypt_heart_disease_details);
                               });
                            </script>
                        <?php
                        } ?>
                     </div>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="stroke" {{isset($general_health_arr['stroke']) && $general_health_arr['stroke'] == 'yes' ? 'checked' : ''}}   />
                     <label for="stroke" class="bluedoc-text">Stroke</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['stroke_details']) ? $general_health_arr['stroke_details'] :''}} */ ?>" id="stroke_details" style="{{isset($general_health_arr['stroke']) && $general_health_arr['stroke'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['stroke_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var stroke_details  = "{{ $general_health_arr['stroke_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                    = api.keys.import(userkey);
                                       var decrypt_stroke_details   = key.decrypt(stroke_details).toString();
                                       $('#stroke_details').val(decrypt_stroke_details);
                               });
                            </script>
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="blood_pressure" {{isset($general_health_arr['blood_pressure']) && $general_health_arr['blood_pressure'] == 'yes' ? 'checked' : ''}}   />
                     <label for="blood_pressure" class="bluedoc-text">High Blood Pressure</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['blood_pressure_details']) ? $general_health_arr['blood_pressure_details'] :''}} */ ?>" id="blood_pressure_details" style="{{isset($general_health_arr['blood_pressure']) && $general_health_arr['blood_pressure'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['blood_pressure_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var blood_pressure_details  = "{{ $general_health_arr['blood_pressure_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                     = api.keys.import(userkey);
                                       var decrypt_blood_pressure_details   = key.decrypt(blood_pressure_details).toString();
                                       $('#blood_pressure_details').val(decrypt_blood_pressure_details);
                               });
                            </script>
                        <?php
                        } ?>
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="high_cholestrol" {{isset($general_health_arr['high_cholesterol']) && $general_health_arr['high_cholesterol'] == 'yes' ? 'checked' : ''}}   />
                     <label for="high_cholestrol" class="bluedoc-text">High Cholesterol</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['high_cholesterol_details']) ? $general_health_arr['high_cholesterol_details'] :''}} */ ?>" id="high_cholesterol_details" style="{{isset($general_health_arr['high_cholesterol']) && $general_health_arr['high_cholesterol'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['high_cholesterol_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var high_cholesterol_details  = "{{ $general_health_arr['high_cholesterol_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                     = api.keys.import(userkey);
                                       var decrypt_high_cholesterol_details   = key.decrypt(high_cholesterol_details).toString();
                                       $('#high_cholesterol_details').val(decrypt_high_cholesterol_details);
                               });
                            </script>
                        <?php
                        } ?> 
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="asthma"  {{isset($general_health_arr['asthma']) && $general_health_arr['asthma'] == 'yes' ? 'checked' : ''}}  />
                     <label for="asthma" class="bluedoc-text">Asthma / COPD</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['asthma_details']) ? $general_health_arr['asthma_details'] :''}} */ ?>" id="asthma_details" style="{{isset($general_health_arr['asthma']) && $general_health_arr['asthma'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['asthma_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var asthma_details  = "{{ $general_health_arr['asthma_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                     = api.keys.import(userkey);
                                       var decrypt_asthma_details   = key.decrypt(asthma_details).toString();
                                       $('#asthma_details').val(decrypt_asthma_details);
                               });
                            </script>
                        <?php
                        } ?> 
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="depression" {{isset($general_health_arr['depression']) && $general_health_arr['depression'] == 'yes' ? 'checked' : ''}}   />
                     <label for="depression" class="bluedoc-text">Depression</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['depression_details']) ? $general_health_arr['depression_details'] :''}} */ ?>" id="depression_details" style="{{isset($general_health_arr['depression']) && $general_health_arr['depression'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['depression_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var depression_details  = "{{ $general_health_arr['depression_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                     = api.keys.import(userkey);
                                       var decrypt_depression_details   = key.decrypt(depression_details).toString();
                                       $('#depression_details').val(decrypt_depression_details);
                               });
                            </script>
                        <?php
                        } ?> 
                  </div>
                  <div class="clear"></div>
               </li>
               
               <li class="collection-item  ">
                  <div class="chkbx new">
                     <input type="checkbox" class="filled-in general_issue" id="arthrits" {{isset($general_health_arr['arthritis']) && $general_health_arr['arthritis'] == 'yes' ? 'checked' : ''}}   />
                     <label for="arthrits" class="bluedoc-text">Arthrits</label>
                  </div>
                  <div class="input-field ">
                        <input type="text" value="<?php /* {{isset($general_health_arr['arthritis_details']) ? $general_health_arr['arthritis_details'] :''}} */ ?>" id="arthritis_details" style="{{isset($general_health_arr['arthritis']) && $general_health_arr['arthritis'] =='yes'  ? '' : 'display:none'}}"  class="validate " placeholder="Enter details if required">
                        <?php if(isset($general_health_arr['arthritis_details'])){
                        ?>
                           <script type="text/javascript">
                               $(document).ready(function(){

                                   var arthritis_details  = "{{ $general_health_arr['arthritis_details'] }}"; 
                                   var card_id                 = "{{ $user_details->dump_id }}";
                                   var userkey                 = "{{ $user_details->dump_session }}";
                                   var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                   var api                     = virgil.API(VIRGIL_TOKEN);
                                   var key                     = api.keys.import(userkey);
                                       var decrypt_arthritis_details   = key.decrypt(arthritis_details).toString();
                                       $('#arthritis_details').val(decrypt_arthritis_details);
                               });
                            </script>
                        <?php
                        } ?> 
                 </div>
                  <div class="clear"></div>
               </li>

               @if(isset($dynamic_general_data) && !empty($dynamic_general_data))
                     <?php $cnt = 0; ?>
                     @foreach($dynamic_general_data as $v)
                        <?php $cnt++; ?>
                        <li class="collection-item  ">
                           <div class="chkbx new">
                              <input type="checkbox" class="filled-in dynamic_history" data-id="{{$v['id']}}" id="general_{{$v['id']}}" {{isset($v['status']) && $v['status'] == 'yes' ? 'checked' : ''}}   />
                              <label for="general_{{$v['id']}}" class="bluedoc-text">{{$v['title']}}</label>
                           </div>
                           <div class="hisdetails">
                           <div class="input-field " >
                              <input type="text" value="{{isset($v['description']) ? $v['description'] :''}}" style="display:{{ isset($v['status']) && $v['status'] =='yes' ? 'block' : 'none' }}"  class="validate dyn_description dyn_description{{$cnt}}" placeholder="Enter details if required">
                              <?php if(isset($v['description'])){
                              ?>
                                 <script type="text/javascript">
                                     $(document).ready(function(){
                                         var count                   = "{{$cnt}}";
                                         var description             = "{{ $v['description'] }}"; 
                                         var card_id                 = "{{ $user_details->dump_id }}";
                                         var userkey                 = "{{ $user_details->dump_session }}";
                                         var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                         var api                     = virgil.API(VIRGIL_TOKEN);
                                         var key                     = api.keys.import(userkey);
                                             var decrypt_description   = key.decrypt(description).toString();
                                             $('.dyn_description'+count).val(decrypt_description);
                                     });
                                  </script>
                              <?php
                              } ?> 
                            </div>
                           <a href="javascript:void(0);" class="del_dynamic_general" data-dynamic_general_id="{{$v['id']}}"><i class="material-icons">delete</i></a>
                        </div>
                           <div class="clear"></div>
                        </li>
                     @endforeach

               @endif

            </ul>

            <span class="left qusame marbtm mrgtht"><a href="#add_new_condition" class="btn cart bluedoc-bg lnht round-corner" id="btn_add_general_health">Add new</a></span>

            <span class="right qusame marbtm mrgtht"><a href="javascript:void(0)" class="btn cart bluedoc-bg lnht round-corner" id="btn_save_general_health">Save</a></span>
            <div class="clr"></div>
         </div>

         <div id="medication-condition" class="tab-content marbt">
            <div class="gray-strip">
               <div class="bluedoc-text">
                  <strong>Medication</strong> - Select / enter all medication that you ve had
               </div>
            </div>
             <form id="add_medication_form" enctype="multipart/form-data">
                  <input type="hidden" id="remove_pres_file">
                   
                  @if(isset($medication_arr) && !empty($medication_arr))
                  <ul class="collapsible no-shadow " data-collapsible="accordion">
                       @foreach($medication_arr as $val)
                          <li>
                             <div class="collapsible-header "><i class="material-icons right iconpatch">chevron_right</i>
                             <span class="medication_name_box medication_name_box{{$val['id']}}">{{isset($val['medication_name']) && $val['medication_name'] !='' ? $val['medication_name'] : 'Not Found'}}</span></div>
                             <?php if(isset($val['medication_name'])){
                             ?>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        var medi_id                 = "{{$val['id']}}"; 
                                        var medication_name         = "{{ $val['medication_name'] }}"; 
                                        var card_id                 = "{{ $user_details->dump_id }}";
                                        var userkey                 = "{{ $user_details->dump_session }}";
                                        var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                        var api                     = virgil.API(VIRGIL_TOKEN);
                                        var key                     = api.keys.import(userkey);
                                            var decrypt_medication_name   = key.decrypt(medication_name).toString();
                                            $('.medication_name_box'+medi_id).html(decrypt_medication_name);
                                    });
                                 </script>
                             <?php
                             } ?>
                             <div class="collapsible-body">
                                <div class="form">
                                   <div class="input-field col s12 text-bx">
                                      <input type="text" id="reason" class="validate active_ingredient validate active_ingredient{{$val['id']}}" value="{{isset($val['medication_name']) && $val['medication_name'] !='' ? $val['medication_name'] : ''}}">
                                      <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter medication name or active ingredient</label>
                                      <?php if(isset($val['medication_name'])){
                                      ?>
                                         <script type="text/javascript">
                                             $(document).ready(function(){
                                                 var medi_id                 = "{{$val['id']}}"; 
                                                 var medication_name         = "{{ $val['medication_name'] }}"; 
                                                 var card_id                 = "{{ $user_details->dump_id }}";
                                                 var userkey                 = "{{ $user_details->dump_session }}";
                                                 var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                                 var api                     = virgil.API(VIRGIL_TOKEN);
                                                 var key                     = api.keys.import(userkey);
                                                     var decrypt_medication_name   = key.decrypt(medication_name).toString();
                                                     $('.active_ingredient'+medi_id).val(decrypt_medication_name);
                                             });
                                          </script>
                                      <?php
                                      } ?>
                                   </div>
                                   
                                   <div class="clear"></div>
                                   <div class="input-field col s12 text-bx">
                                      <input type="text" id="reason" class="validate medication_purpose medication_purpose{{$val['id']}}" value="{{isset($val['medication_purpose']) && $val['medication_purpose'] !='' ? $val['medication_purpose'] : ''}}">
                                      <?php if(isset($val['medication_purpose'])){
                                      ?>
                                         <script type="text/javascript">
                                             $(document).ready(function(){
                                                 var medi_id                 = "{{$val['id']}}"; 
                                                 var medication_purpose         = "{{ $val['medication_purpose'] }}"; 
                                                 var card_id                 = "{{ $user_details->dump_id }}";
                                                 var userkey                 = "{{ $user_details->dump_session }}";
                                                 var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                                 var api                     = virgil.API(VIRGIL_TOKEN);
                                                 var key                     = api.keys.import(userkey);
                                                     var decrypt_medication_purpose   = key.decrypt(medication_purpose).toString();
                                                     $('.medication_purpose'+medi_id).val(decrypt_medication_purpose);
                                             });
                                          </script>
                                      <?php
                                      } ?>
                                      <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter use or why you take</label>
                                   </div>
                                   <div class="clear"></div>
                                   <div class="input-field col s12 text-bx">
                                      <input type="text" id="reason" class="validate medication_duration medication_duration{{$val['id']}}" value="{{isset($val['medication_duration']) && $val['medication_duration'] !='' ? $val['medication_duration'] : ''}}">
                                      <?php if(isset($val['medication_purpose'])){
                                      ?>
                                         <script type="text/javascript">
                                             $(document).ready(function(){
                                                 var medi_id                 = "{{$val['id']}}"; 
                                                 var medication_duration         = "{{ $val['medication_duration'] }}"; 
                                                 var card_id                 = "{{ $user_details->dump_id }}";
                                                 var userkey                 = "{{ $user_details->dump_session }}";
                                                 var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                                 var api                     = virgil.API(VIRGIL_TOKEN);
                                                 var key                     = api.keys.import(userkey);
                                                     var decrypt_medication_duration   = key.decrypt(medication_duration).toString();
                                                     $('.medication_duration'+medi_id).val(decrypt_medication_duration);
                                             });
                                          </script>
                                      <?php
                                      } ?>
                                      <label for="reason" data-error="wrong" data-success="right" class="truncate">How long have you been taking it?</label>
                                   </div>
                                   <div class="clear"></div>                                     
                           
                                   <div class="otherdetails resp-center">
                                     <div class="row">
                                         <div class="col s12 m3 l3">
                                              <span class="left qusame "><a href="#delete_medication_box" class="delete_medication btn border-btn  round-corner" data-id="{{isset($val['id']) && $val['id'] !='' ? $val['id'] : ''}}" data-file="{{isset($val['prescription_file']) ? $val['prescription_file'] : '' }}">DELETE</a></span>
                                         </div>
                                         <div class="col s12 m6 l6">
                                             <span class="qusame "><a href="{{$module_url_path}}/prescription/{{isset($val['id']) && $val['id'] !='' ? base64_encode($val['id']) : ''}}" class="btn border-btn  round-corner">View Prescription</a></span>
                                         </div>
                                         <div class="col s12 m3 l3">
                                             <span class="right qusame ">
                                                 <a href="javascript:void(0)" class="btn_save_medication btn cart bluedoc-bg round-corner" id="{{isset($val['id']) && $val['id'] !='' ? $val['id'] : ''}}">SAVE</a>
                                             </span>
                                         </div>
                                     </div>
                                      
                                    </div>
                                   
                                   <div class="clear"></div>
                                </div>
                             </div>  
                             <div class="clearfix"></div>
                          </li>
                       @endforeach
                  </ul>
                  @else
                  <h5 class="center-align no-data">No medication added yet</h5>
                  @endif
            </form> 
         </div>

         <div id="lifestyle" class="tab-content">
            <div class="gray-strip">
               <div class="bluedoc-text">
                  <strong>Lifestyle</strong> - Please Complete the below questions
               </div>
            </div>
            <div class="row  pdrl" style="margin-top: 20px;">
                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="physical_activity" value="{{isset($lifestyle_arr['physical_activity']) && !empty($lifestyle_arr['physical_activity']) ? $lifestyle_arr['physical_activity'] : '' }}" class="validate ">
                     <label for="physical_activity" class="grey-text">Physical Activities <span class="required_field">*</span></label>
                     <?php if(isset($lifestyle_arr['physical_activity'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var physical_activity       = "{{ $lifestyle_arr['physical_activity'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_physical_activity   = key.decrypt(physical_activity).toString();
                                    $('#physical_activity').val(decrypt_physical_activity);
                            });
                         </script>
                     <?php
                     } ?>
                     <span class="err" id="physical_activity_err"></span>
                  </div>

                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="food_habit" value="{{isset($lifestyle_arr['food_habit']) ? $lifestyle_arr['food_habit'] : ''}}" class="validate ">
                     <?php if(isset($lifestyle_arr['food_habit'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var food_habit              = "{{ $lifestyle_arr['food_habit'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_food_habit   = key.decrypt(food_habit).toString();
                                    $('#food_habit').val(decrypt_food_habit);
                            });
                         </script>
                     <?php
                     } ?>
                     <label for="food_habit" class="grey-text">Food Habbits <span class="required_field">*</span></label>
                     <span class="err" id="food_habit_err"></span>
                  </div>
            </div>
            <div class="row pdrl" style="margin-top: 20px;">
                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="smoking" value="{{isset($lifestyle_arr['smoking']) && !empty($lifestyle_arr['smoking']) ? $lifestyle_arr['smoking'] : '' }}" class="validate ">
                     <?php if(isset($lifestyle_arr['smoking'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var smoking                 = "{{ $lifestyle_arr['smoking'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_smoking   = key.decrypt(smoking).toString();
                                    $('#smoking').val(decrypt_smoking);
                            });
                         </script>
                     <?php
                     } ?>
                     <label for="smoking" class="grey-text">Smoking <span class="required_field">*</span></label>
                     <span class="err" id="smoking_err"></span>
                  </div>   

                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="alcohol" value="{{isset($lifestyle_arr['alcohol']) && !empty($lifestyle_arr['alcohol']) ? $lifestyle_arr['alcohol'] : '' }}" class="validate ">
                     <?php if(isset($lifestyle_arr['alcohol'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var alcohol                 = "{{ $lifestyle_arr['alcohol'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_alcohol   = key.decrypt(alcohol).toString();
                                    $('#alcohol').val(decrypt_alcohol);
                            });
                         </script>
                     <?php
                     } ?>
                     <label for="alcohol" class="grey-text">Alcohol <span class="required_field">*</span></label>
                     <span class="err" id="alcohol_err"></span>
                  </div>   
            </div>

            <div class="row pdrl" style="margin-top: 20px;">
                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="stress_level" value="{{isset($lifestyle_arr['stress_level']) && !empty($lifestyle_arr['stress_level']) ? $lifestyle_arr['stress_level'] : '' }}" class="validate ">
                     <?php if(isset($lifestyle_arr['stress_level'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var stress_level                 = "{{ $lifestyle_arr['stress_level'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_stress_level   = key.decrypt(stress_level).toString();
                                    $('#stress_level').val(decrypt_stress_level);
                            });
                         </script>
                     <?php
                     } ?>
                     <label for="stress_level" class="grey-text">Stress Levels <span class="required_field">*</span></label>
                     <span class="err" id="stress_level_err"></span>
                  </div>   

                  <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorleft-ten">
                     <input type="text" id="average_sleep" value="{{isset($lifestyle_arr['average_sleep']) && !empty($lifestyle_arr['average_sleep']) ? $lifestyle_arr['average_sleep'] : '' }}" class="validate ">
                     <?php if(isset($lifestyle_arr['average_sleep'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var average_sleep                 = "{{ $lifestyle_arr['average_sleep'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_average_sleep   = key.decrypt(average_sleep).toString();
                                    $('#average_sleep').val(decrypt_average_sleep);
                            });
                         </script>
                     <?php
                     } ?>
                     <label for="average_sleep" class="grey-text">Average Sleep <span class="required_field">*</span></label>
                     <span class="err" id="sleep_err"></span>
                  </div>   
            </div>
            
            <div class="row pdrl" style="margin-top: 20px;">
               <div class="input-field col s12 m12 l12 setlabel errorleft-ten">
                  <input type="text" id="other_lifestyle" value="{{isset($lifestyle_arr['other_lifestyle']) ? $lifestyle_arr['other_lifestyle'] : ''}}" class="validate ">
                  <?php if(isset($lifestyle_arr['other_lifestyle'])){
                     ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var other_lifestyle         = "{{ $lifestyle_arr['other_lifestyle'] }}"; 
                                var card_id                 = "{{ $user_details->dump_id }}";
                                var userkey                 = "{{ $user_details->dump_session }}";
                                var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                var api                     = virgil.API(VIRGIL_TOKEN);
                                var key                     = api.keys.import(userkey);
                                    var decrypt_average_sleep   = key.decrypt(other_lifestyle).toString();
                                    $('#other_lifestyle').val(decrypt_average_sleep);
                            });
                         </script>
                     <?php
                  } ?>
                  <label for="other_lifestyle" class="grey-text">Other <span class="required_field">*</span></label>
                  <span class="err" id="other_err"></span>
               </div>
            </div>
            <span class="right qusame marbtm mrgtht"><a href="javascript:void(0)" class="btn cart bluedoc-bg lnht round-corner" id="btn_save_lifestyle">Save</a></span>
            <div class="clr"></div>
         </div>

         

      </div>
   </div>
</div>
<!--Container End-->
<a class="popup_open" href="#show_msg" style="display: none;"></a>
<div id="show_msg" class="modal requestbooking" style="display: none;">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <div class="flash_msg_text center-align"></div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align ">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
   </div>
</div>

<a class="open_popup_link" href="#show_status_msg" style="display: none;"></a>
<div id="show_status_msg" class="modal requestbooking" style="">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <div class="flash_status_msg center-align"></div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align ">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
   </div>
</div>

<div id="delete_medication_box" class="modal requestbooking" style="display: none;">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <input type="hidden" id="medication_delete_id">
            <input type="hidden" id="delete_prescription_file">
            <div class=" center-align">Do you really want to delete this medication?</div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align two-btn-block">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons" id="btn_delete_medication">Yes</a>
   </div>
</div>

<div id="add_new_condition" class="modal requestbooking">
     <div class="modal-content">
         <h4 class="center-align">Add New Condition</h4>
     </div>
     <div class="modal-data padding-bottom">
         <p>Please add patient condition here</p>
         <div>
             <div class="row">
                 <div class="col s12 ">
                     <div class="input-field text-bx modal-fields input-padding-25px">
                         <input id="condition_title" name="condition_title" type="text" class="validate">
                         <label for="condition_title">Title <span class="required_field">*</span></label>
                         <div class="err" id="err_condition_title" style="display:none;"></div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col s12 ">
                     <div class="input-field text-bx modal-fields input-padding-25px">
                         <textarea id="condition_description" name="condition_description" type="text" class="materialize-textarea"></textarea>
                         <label for="condition_description">Description <span class="required_field">*</span></label>
                         <div class="err" id="err_condition_description" style="display:none;"></div>
                     </div>
                     <div class="clr"></div>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal-footer">
      <input type="hidden" id="medical_general_id" name="medical_general_id" value="{{ isset($general_health_arr['id'])?$general_health_arr['id']:'' }}">
         <a href="javascript:void(0);" id="close_add_new_condition" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
         <a href="javascript:void(0);" id="add_new_general_condition" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
     </div>
</div>

<!-- Modal delete dynamic general -->
    <a href="#open_delete_dynamic_pop" id="delete_dynamic_pop" class="delete_dynamic_pop"></a>
    <div id="open_delete_dynamic_pop" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Confirm Delete General Medical Condition</h4>
        </div>
        <div class="modal-data padding-bottom">
            <div class="row">
                <div class="col s12 ">
                    
                        <p class="center-align">Are You Sure? You want to delete this General Medical Condition!</p>
                        <input type="hidden" id="get_dynamic_general_id" name="get_dynamic_general_id">
                   
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" id="cancel_delete_dynamic_general" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" id="confirm_delete_dynamic_general" class="modal-action waves-effect waves-green btn-cancel-cons right">Confirm</a>
        </div>
    </div>
    <!-- Modal delete dynamic general End -->


<script>
   var url="<?php echo $module_url_path; ?>";
       $(document).ready(function(){
     
           $('.redirect_medical').click(function(){
               window.location.href = "{{ url('/') }}/patient/my_health/medical_history/general";
           });
           $('.redirect_documents').click(function(){
               window.location.href = "{{ url('/') }}/patient/my_health/documents/consultation";
           });

           $('.doctor_Activity').click(function(){
               window.location.href = "{{ url('/') }}/patient/my_health/doctor_Activity";
           });

           
   
           $('#btn_save_general_health').click(function(){
           
             var allergy                 = $('#allergy').is(':checked') ? 'yes' : 'no';
   
             var surgery                 = $('#surgery').is(':checked') ? 'yes' : 'no';
             
             var pregnancy               = $('#pregnancy').is(':checked') ? 'yes' : 'no';
   
             var family_history          = $('#family_history').is(':checked') ? 'yes' : 'no';
             
             var other                   = $('#other').is(':checked') ? 'yes' : 'no';
   
             var diabetes                = $('#diabetes').is(':checked') ? 'yes' : 'no';
   
             var heart_desease           = $('#heart_desease').is(':checked') ? 'yes' : 'no';
   
             var stroke                  = $('#stroke').is(':checked') ? 'yes' : 'no';
             
             var blood_pressure          = $('#blood_pressure').is(':checked') ? 'yes' : 'no';
             
             var high_cholestrol         = $('#high_cholestrol').is(':checked') ? 'yes' : 'no';
   
             var asthma                  = $('#asthma').is(':checked') ? 'yes' : 'no';
   
             var depression              = $('#depression').is(':checked') ? 'yes' : 'no';
   
             var arthrits                = $('#arthrits').is(':checked') ? 'yes' : 'no';

             var allergy_details         = $('#allergy_details').val();

             var pregnancy_details       = $('#pregnancy_details').val();

             var family_history_details  = $('#family_history_details').val();

             var other_details           = $('#other_details').val();

             var diabetes_details        = $('#diabetes_details').val();

             var stroke_details          = $('#stroke_details').val();

             var blood_pressure_details  = $('#blood_pressure_details').val();

             var high_cholesterol_details= $('#high_cholesterol_details').val();

             var asthma_details          = $('#asthma_details').val();

             var depression_details      = $('#depression_details').val();

             var arthritis_details       = $('#arthritis_details').val();

             var surgery_details         = $('#surgery_details').val();

             var heart_desease_detail    = $('#heart_desease_detail').val();


             var dyn_arr = [];


             var card_id              = "{{ $user_details->dump_id }}"
             var userkey              = "{{ $user_details->dump_session }}";
             var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
             var api                  = virgil.API(VIRGIL_TOKEN);


                var findkey = api.cards.get(card_id)
                   .then(function (cards) {

                            $('.dynamic_history').each(function(){
                                 var id = $(this).attr('data-id');
                                 var dyn_check="";
                                 var dyn_desc
                                 if($(this).is(':checked'))
                                 {
                                    dyn_check ='yes';
                                    dyn_desc = $(this).closest('li').find('.dyn_description').val();

                                 }
                                 else
                                 {
                                    dyn_check ='no';  
                                    dyn_desc = '';
                                 }

                                 dyn_arr.push(id + '_'+dyn_check+ '_'+encrypt(api, dyn_desc, cards));
                            });

                            var enc_allergy                  = allergy;
                            var enc_surgery                  = surgery; 
                            var enc_pregnancy                = pregnancy; 
                            var enc_family_history           = family_history;
                            var enc_other                    = other;
                            var enc_surgery_details          = encrypt(api, surgery_details, cards);
                            var enc_diabetes                 = diabetes;
                            var enc_heart_desease            = heart_desease;
                            var enc_heart_desease_detail     = encrypt(api, heart_desease_detail, cards);
                            var enc_stroke                   = stroke;               
                            var enc_blood_pressure           = blood_pressure;
                            var enc_high_cholestrol          = high_cholestrol;
                            var enc_asthma                   = asthma; 
                            var enc_depression               = depression;
                            var enc_arthrits                 = arthrits;
                            
                            var enc_allergy_details          = encrypt(api, allergy_details, cards); 
                            var enc_pregnancy_details        = encrypt(api, pregnancy_details, cards);
                            var enc_family_history_details   = encrypt(api, family_history_details, cards);
                            var enc_other_details            = encrypt(api, other_details, cards);
                            var enc_diabetes_details         = encrypt(api, diabetes_details, cards);
                            var enc_stroke_details           = encrypt(api, stroke_details, cards);
                            var enc_blood_pressure_details   = encrypt(api, blood_pressure_details, cards);
                            var enc_high_cholesterol_details = encrypt(api, high_cholesterol_details, cards);
                            var enc_asthma_details           = encrypt(api, asthma_details, cards);
                            var enc_depression_details       = encrypt(api, depression_details, cards);
                            var enc_arthritis_details        = encrypt(api, arthritis_details, cards);
                            var token                        = "{{ csrf_token() }}";
                            $.ajax({
                                   url:url+'/general_store',
                                   type:'post',
                                   data:{
                                       _token: token,
                                       allergy: enc_allergy,
                                       surgery: enc_surgery,
                                       pregnancy: enc_pregnancy,
                                       family_history: enc_family_history,
                                       other: enc_other,
                                       surgery_details: enc_surgery_details,
                                       diabetes: enc_diabetes,
                                       heart_desease: enc_heart_desease,
                                       heart_desease_detail: enc_heart_desease_detail,
                                       stroke: enc_stroke,
                                       blood_pressure: enc_blood_pressure,
                                       high_cholestrol: enc_high_cholestrol,
                                       asthma: enc_asthma,
                                       depression: enc_depression,
                                       arthrits: enc_arthrits,
                                       dyn_arr:dyn_arr,
                                       allergy_details: enc_allergy_details,
                                       pregnancy_details: enc_pregnancy_details,
                                       family_history_details: enc_family_history_details,
                                       other_details: enc_other_details,
                                       diabetes_details: enc_diabetes_details,
                                       stroke_details: enc_stroke_details,
                                       blood_pressure_details: enc_blood_pressure_details,
                                       high_cholesterol_details: enc_high_cholesterol_details,
                                       asthma_details: enc_asthma_details,
                                       depression_details: enc_depression_details,
                                       arthritis_details: enc_arthritis_details
                                   },
                                   success:function(data){
                                       $(".popup_open").click();
                                       $('.flash_msg_text').html(data.msg);

                                       setTimeout(
                                         function() 
                                         {
                                             window.location  = url + '/medical_history/general';
                                         }, 2000);

                                   }
                                });

                }).then(null, function (error) {
                    $(".open_popup").click();
                    $('.flash_msg_text').html(error);
                    return false;
                });
           });
   
           $('#btn_save_health_conditions').click(function(){
             
             var diabetes                = $('#diabetes').is(':checked') ? 'yes' : 'no';
   
             var heart_desease           = $('#heart_desease').is(':checked') ? 'yes' : 'no';
   
             var stroke                  = $('#stroke').is(':checked') ? 'yes' : 'no';
             
             var blood_pressure          = $('#blood_pressure').is(':checked') ? 'yes' : 'no';
             
             var high_cholestrol         = $('#high_cholestrol').is(':checked') ? 'yes' : 'no';
   
             var asthma                  = $('#asthma').is(':checked') ? 'yes' : 'no';
   
             var depression              = $('#depression').is(':checked') ? 'yes' : 'no';
   
             var arthrits                = $('#arthrits').is(':checked') ? 'yes' : 'no';
   
             if($('#heart_desease').is(':checked'))
              {
                 heart_desease_detail=$('#heart_desease_detail').val();
              }
              else
              {
                heart_desease_detail='';
              }
   
              $.ajax({
                 url:url+'/condition_store',
                 type:'get',
                 data:{
                     diabetes:diabetes,
                     heart_desease:heart_desease,
                     heart_desease_detail:heart_desease_detail,
                     stroke:stroke,
                     blood_pressure:blood_pressure,
                     high_cholestrol:high_cholestrol,
                     asthma:asthma,
                     depression:depression,
                     arthrits:arthrits
                 },
                 success:function(data){
                     $(".popup_open").click();
                     $('.flash_msg_text').html(data.msg);
                 }
              });              
           });
   
           $('#btn_save_lifestyle').click(function(){
             
             var physical_activity        =  $('#physical_activity').val();
   
             var food_habit               =  $('#food_habit').val();
   
             var smoking                  =  $('#smoking').val();
   
             var alcohol                  =  $('#alcohol').val();
   
             var stress_level             =  $('#stress_level').val();
   
             var average_sleep            =  $('#average_sleep').val();
   
             var other_lifestyle          =  $('#other_lifestyle').val();

             if(physical_activity == '' || physical_activity == null)
             {
               $('#physical_activity_err').show();
               $('#physical_activity_err').html("Please enter physical activity");
               $('#physical_activity_err').fadeOut(4000);
               $('#physical_activity').focus();
               return false;
             }
             else if(food_habit == '' || food_habit == null)
             {
               $('#food_habit_err').show();
               $('#food_habit_err').html("Please enter food habit");
               $('#food_habit_err').fadeOut(4000);
               $('#food_habit').focus();
               return false;
             }
             else if(smoking == '' || smoking == null)
             {
               $('#smoking_err').show();
               $('#smoking_err').html("Please enter smoking activity");
               $('#smoking_err').fadeOut(4000);
               $('#smoking').focus();
               return false;
             }
             else if(alcohol == '' || alcohol == null)
             {
               $('#alcohol_err').show();
               $('#alcohol_err').html("Please enter alcohol activity");
               $('#alcohol_err').fadeOut(4000);
               $('#alcohol').focus();
               return false;
             }
             else if(stress_level == '' || stress_level == null)
             {
               $('#stress_level_err').show();
               $('#stress_level_err').html("Please enter stress level");
               $('#stress_level_err').fadeOut(4000);
               $('#stress_level').focus();
               return false;
             }
             else if(average_sleep == '' || average_sleep == null)
             {
               $('#sleep_err').show();
               $('#sleep_err').html("Please enter physical average sleep");
               $('#sleep_err').fadeOut(4000);
               $('#average_sleep').focus();
               return false;
             }
             else if(other_lifestyle == '' || other_lifestyle == null)
             {
               $('#other_err').show();
               $('#other_err').html("Please enter other lifestyle");
               $('#other_err').fadeOut(4000);
               $('#other_lifestyle').focus();
               return false;
             }
   
             

              var card_id              = "{{ $user_details->dump_id }}"
              var userkey              = "{{ $user_details->dump_session }}";
              var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
              var api                  = virgil.API(VIRGIL_TOKEN);

              var findkey = api.cards.get(card_id)
                 .then(function (cards) {

                          var enc_physical_activity     = encrypt(api, physical_activity, cards);
                          var enc_food_habit            = encrypt(api, food_habit, cards);
                          var enc_smoking               = encrypt(api, smoking, cards);
                          var enc_alcohol               = encrypt(api, alcohol, cards);
                          var enc_stress_level          = encrypt(api, stress_level, cards);
                          var enc_average_sleep         = encrypt(api, average_sleep, cards);
                          var enc_other_lifestyle       = encrypt(api, other_lifestyle, cards);

                          var token = "<?php echo csrf_token(); ?>";
                           $.ajax({
                             url:url+'/lifestyle_store',
                             type:'post',
                             data:{
                                 _token:token,
                                 physical_activity:enc_physical_activity,
                                 food_habit:enc_food_habit,
                                 smoking:enc_smoking,
                                 alcohol:enc_alcohol,
                                 stress_level:enc_stress_level,
                                 average_sleep:enc_average_sleep,
                                 other_lifestyle:enc_other_lifestyle
                             },
                             success:function(data){
                                 
                                 $(".popup_open").click();
                                 $('.flash_msg_text').html(data.msg);
                                 setTimeout(
                                   function() 
                                   {
                                       window.location  = url + '/medical_history/lifestyle';
                                   }, 2000);
                             }
                          });     

              }).then(null, function (error) {
                  $(".open_popup").click();
                  $('.flash_msg_text').html(error);
                  return false;
              });


           });

           $('.general_issue').change(function(){
               if($(this).is(':checked'))
               {
                  $(this).closest('li').find('input').show();
               }
               else
               {
                  $(this).closest('li').find('input').hide();
                   $(this).closest('li').find('input').val('');
               }
           });
   
           $('.btn_save_medication').click(function(){
   
               var id=$(this).attr('id');
   
               var active_ingredient=$(this).closest('li').find('.active_ingredient').val();
   
               var medication_purpose=$(this).closest('li').find('.medication_purpose').val();
   
               var medication_duration=$(this).closest('li').find('.medication_duration').val();
               
               var card_id              = "{{ $user_details->dump_id }}"
               var userkey              = "{{ $user_details->dump_session }}";
               var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
               var api                  = virgil.API(VIRGIL_TOKEN);

               var findkey = api.cards.get(card_id)
                 .then(function (cards) {

                           var enc_active_ingredient                 = encrypt(api, active_ingredient, cards);
                           var enc_medication_purpose                = encrypt(api, medication_purpose, cards);
                           var enc_medication_duration               = encrypt(api, medication_duration, cards);


                           var _token="<?php echo csrf_token(); ?>";
                           var formData = new FormData();
                           formData.append('id',id);
                           formData.append('active_ingredient',enc_active_ingredient);
                           formData.append('medication_purpose',enc_medication_purpose);
                           formData.append('medication_duration',enc_medication_duration);
                           formData.append('_token',_token);
                           
                                 $.ajax({
                                   url:url+'/medication_deatails_add',
                                   type:'post',
                                   data:formData,
                                   success:function(data){
                                       
                                       $(".open_popup_link").click();
                                       $('.flash_status_msg').html(data.msg);
                                       if(data.status == 'success')
                                       {
                                          setTimeout(
                                            function() 
                                            {
                                                window.location  = url + '/medical_history/medication';
                                            }, 2000);
                                          
                                       }
                                   },
                                    cache: false,
                                    contentType: false,
                                    processData: false
                                });

               }).then(null, function (error) {
                  $(".open_popup").click();
                  $('.flash_msg_text').html(error);
                  return false;
               });

               
   
           });
   
           $('#general_tab,#condition_tab,#lifestyle_tab').click(function(){
             $('#add_new_medication').hide();
               $('#add_medication_box').hide();
           });
   
           $('#medication_tab').click(function(){
             $('#add_medication_box').show();
             $('#add_new_medication').show();
           });

           $('#show_status_msg .modal-close').click(function(){
               window.location  = url + '/medical_history/medication';
           });

           $('.delete_medication').click(function(){
               var id = $(this).attr('data-id');
               $('#medication_delete_id').val(id); 
               
               $('#delete_prescription_file').val($(this).attr('data-file'));
               
           });

           $('#btn_delete_medication').click(function(){
               var id = $('#medication_delete_id').val();

               var delete_prescription_file = $('#delete_prescription_file').val();

               $.ajax({
                  url:url+'/medication_deatails_delete',
                  type:'get',
                  data:{id:id,delete_prescription_file:delete_prescription_file},
                  success:function(data){
                     $(".open_popup_link").click();
                     $('.flash_status_msg').html(data.msg);
                     if(data.status == 'success')
                     {
                        setTimeout(
                          function() 
                          {
                              window.location  = url + '/medical_history/medication';
                          }, 5000);
                        
                     }
                  }
               });
           });

           $('.dynamic_history').change(function(){
                if($(this).is(':checked'))
                {
                  $(this).closest('li').find('.dyn_description').show();
                }
                else
                {
                  $(this).closest('li').find('.dyn_description').hide();
                  $(this).closest('li').find('.dyn_description').val('');
                }
           });

           $('#add_new_general_condition').click(function(){
                var condition_title         = $('#condition_title').val();
                var condition_description   = $('#condition_description').val();
                var medical_general_id      = $('#medical_general_id').val();

                if(condition_title == '')
                {
                    $('#err_condition_title').show();
                    $('#err_condition_title').html('Please enter Title.');
                    $('#err_condition_title').fadeOut(4000);
                    $('#condition_title').focus();
                    return false;
                }
                else if(condition_description == '')
                {
                    $('#err_condition_description').show();
                    $('#err_condition_description').html('Please enter Description.');
                    $('#err_condition_description').fadeOut(4000);
                    $('#condition_description').focus();
                    return false;
                }
                else
                {

                      var card_id              = "{{ $user_details->dump_id }}"
                      var userkey              = "{{ $user_details->dump_session }}";
                      var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                      var api                  = virgil.API(VIRGIL_TOKEN);

                      var findkey = api.cards.get(card_id)
                         .then(function (cards) {

                                  var enc_condition_description            = encrypt(api, condition_description, cards);
                                  var token = "<?php echo csrf_token(); ?>";
                                   $.ajax({
                                       url:url+'/add_new_general_condition',
                                       type:'POST',
                                       dataType:'json',
                                       data:{_token:token, medical_general_id:medical_general_id, title:condition_title, description:enc_condition_description},
                                       success:function(res){
                                           if(res.status)
                                           {
                                               $("#add_new_condition .modal-close").click()
                                               $(".open_popup").click();
                                               $('.flash_msg_text').html(res.msg);
                                           }
                                       }
                                   });

                      }).then(null, function (error) {
                          $(".open_popup").click();
                          $('.flash_msg_text').html(error);
                          return false;
                      });
                }
            });

                      //delete dynamic general 
            $(".del_dynamic_general").click(function(){
                var dynamic_general_id = $(this).attr("data-dynamic_general_id");
                $("#get_dynamic_general_id").val(dynamic_general_id);
                $("#delete_dynamic_pop").click();
            });

            $("#confirm_delete_dynamic_general").click(function(){
                var dynamic_general_id = $("#get_dynamic_general_id").val();
                var medical_general_id = $("#medical_general_id").val();

                if(dynamic_general_id != "")
                {
                    var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:url+'/medical_general/delete',
                        type:'POST',
                        dataType:'json',
                        data:{ _token:token, medical_general_id:medical_general_id, dynamic_general_id:dynamic_general_id },
                        success:function(res){
                            if(res.status)
                            {
                                $("#open_delete_dynamic_pop .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(res.msg);
                            }
                        }
                    });
                }
            });
   
       });
    
    /*script for sticky tabs on mobile start*/
    var stickyNavTop = $('.tabs.footer').offset().top;
             var stickyNav = function() {
                 var scrollTop = $(window).scrollTop();
                 if (scrollTop > stickyNavTop) {
                     $('.tabs.footer').addClass('sticky');
                 } else {
                     $('.tabs.footer').removeClass('sticky');
                 }
             };
             stickyNav();
             $(window).scroll(function() {
                 stickyNav();
             });
    /*script for sticky tabs on mobile end*/


    
</script>
@endsection