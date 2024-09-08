@extends('front.pharmacy.layout.temp_master')                
@section('main_content')

      <div class="banner-home inner-page-box">
          <div class="bg-shaad doc-bg-head">
          </div>
      </div>
      <!--pharmacy services section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
             @include('front.pharmacy.layout.profile_layout._profile_sidebar') 

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>

                  <form action="{{ $module_url_path }}/update_profile_step2" id="frm_profile_step2_id" name="frm_profile_step2_id" method="post">
                  {{ csrf_field() }}


                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                          
                                       @include('front.pharmacy.layout.profile_layout._profile_middlebar') 

                                 </div>
                                 <div class="clr"></div>
                                 @include('front.layout._operation_status')
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="pharma-step-content">
                                       <div class="user_box">

                                        <div class="select-style pharma-step-drp">
                                          <select class="frm-select" data-rule-required='true' name="aprox_script_per_day">
                                          <option value="">Select Aprox Script Per Day</option>
                                             @for($i=1;$i<=100;$i++)

                                                 <option value="{{ $i }}"

                                                  @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==$i) selected="" 
                                                  @endif 


                                                  >{{ $i or '' }}</option>

                                             @endfor

                                          </select>
                                           <span class='err'>{{ $errors->first('aprox_script_per_day') }}</span>
                                       </div>
                                       </div>
                                       <div class="user-box">
                                          <div class="select-style pharma-step-drp">
                                             <select class="frm-select" data-rule-required='true' id="computer_system_used" name="computer_system_used"  onchange="checkOtherField(this.value)">
                                                <option value="">Computer System Used</option>
                                                <option value="1"

                                                  @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==1) selected="" 
                                                  @endif 

                                                  >FRED Dispense</option>
                                                <option value="2"

                                                  @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==2) selected="" 
                                                  @endif 


                                                >Minfos Dispense</option>
                                                <option value="3"

                                                  @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==3) selected="" 
                                                  @endif 

                                                >Corum LOTS</option>
                                                <option value="4"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==4) selected="" 
                                                  @endif 

                                                >Surefire Dispense (Amfac)</option>
                                                <option value="5"

                                                @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==5) selected="" 
                                                  @endif 

                                                >Simple Aquarius</option>
                                                <option value="6"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==6) selected="" 
                                                  @endif 

                                                >Healthsoft Pharmacy Pro</option>
                                                <option value="7"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==7) selected="" 
                                                  @endif 

                                                >Mountaintop Dispense</option>
                                                <option value="8"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==8) selected="" 
                                                  @endif 

                                                >Z Dispense</option>
                                                <option value="9"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==9) selected="" 
                                                  @endif 

                                                >CDS</option>
                                                <option value="10"

                                                 @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==10) selected="" 
                                                  @endif 

                                                >Other</option>
                                             </select>
                                          </div>
                                           <span class='err'>{{ $errors->first('computer_system_used') }}</span>
                                          <div class="clearfix"></div>
                                       </div>
                                       <div class="user_box" id="other_field" style="display:none">
                                          <input type="text" name="other_field" value="{{ $arr_pharmacy['other_computer_system']  or '' }}" class="input_acct-logn" placeholder="Other" />
                                       </div>

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-6 col-lg-8 request-details-bx1">
                                 <div class="pharma-step-bx">
                                    <div class="pharma-step-content">
                                       <h4> Update Professional services</h4>

                                       <h5>(Please select any professional services which can be advertised as being available to patients.)</h5>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value="1"  @if(isset($arr_pharmacy['accept_medical_certificate']) && $arr_pharmacy['accept_medical_certificate']==1) checked="" 
                                                  @endif   name="accept_medical_certificate" id="checkbox1" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox1">Accept Medical Certificates</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value="1" @if(isset($arr_pharmacy['accept_pharmacist_consultation']) && $arr_pharmacy['accept_pharmacist_consultation']==1) checked="" 
                                                  @endif name="accept_pharmacist_consultation" id="checkbox2" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox2">Accept Pharmacist consultations ($2/minute)</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value="1" @if(isset($arr_pharmacy['delivery']) && $arr_pharmacy['delivery']==1) checked="" 
                                                  @endif name="delivery" id="checkbox3" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"   for="checkbox3">Accept local deliveries (Provide boxes, click for courier to pickup)</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value="1" @if(isset($arr_pharmacy['herbal_medicines']) && $arr_pharmacy['herbal_medicines']==1) checked="" 
                                                  @endif name="herbal_medicines" id="checkbox4" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox4">Herbal Medicines</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value="1" @if(isset($arr_pharmacy['photo_services']) && $arr_pharmacy['photo_services']==1) checked="" 
                                                  @endif name="photo_services" id="checkbox5" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox5">Photo professional_services</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value="1" @if(isset($arr_pharmacy['specialized_compounding']) && $arr_pharmacy['specialized_compounding']==1) checked="" 
                                                  @endif name="specialized_compounding" id="checkbox6" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox6">Specialised Compounding</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value="1" @if(isset($arr_pharmacy['flu_vaccination_clinics']) && $arr_pharmacy['flu_vaccination_clinics']==1) checked="" 
                                                  @endif name="flu_vaccination_clinics" id="checkbox7" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox7">Flu Vaccination Clinics</label>
                                       </div>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <div  style="color:red" id="err_service"></div>
                                 </div>
                                
                              </div>
                              
                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                  
                                    <input type="submit" class="btn-grn pull-right" style="margin:0 0 30px;" name="btn_next" id="btn_next" value="Continue">
                                  
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--pharmacy services section end-->
<script>
   function checkOtherField(ref)
   {

         if(ref==10)
         {
               $('#other_field').show();
         }
         else
         {
               $('#other_field').hide();
         }
   }
   $(document).ready(function(){
      $('#frm_profile_step2_id').validate({
               errorElement:'span',
         
                
                        messages: {

                            'aprox_script_per_day'  : "Please Select aproximate script per day",
                            'computer_system_used'  : "Please Select computer system used",

                       },
                       errorPlacement: function(error, element) 
                       {

                             if (element.attr("type") == "checkbox") 
                             {
                               error.insertAfter('#err_service').fadeOut(4000);
                             } 
                             else 
                             {
                               error.insertAfter(element).fadeOut(4000);

                             }
                        }
                                           
                             

                });

      var computer_system_used = $('#computer_system_used').val();
      if(computer_system_used==10)
      {
            $('#other_field').show();
      }
      else
      {
            $('#other_field').hide();
      }

      $("#profile_next_step2_id").click(function() {
             showProcessingOverlay();
            $("#frm_profile_step2_id").submit();
      });
       $("#frm_profile_step2_id").submit(function(){
              if(!$('#frm_profile_step2_id input[type="checkbox"]').is(':checked'))
              {
                  $('#err_service').html('Select atleast one service.').fadeOut(4000);
                  return false;
              }
      });

        $('#frm_profile_step2_id').on('submit',function()
        {
              var form   = $(this);
              var isValid = form.valid();
              if(isValid)
              {
                showProcessingOverlay();
              }
        });

   });

</script>
@endsection