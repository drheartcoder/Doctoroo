@extends('front.pharmacy.layout.master')                
@section('main_content')

      <div class="banner-home inner-page-box">
          <div class="bg-shaad doc-bg-head">
          </div>
      </div>
      <!--pharmacy services section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
             @include('front.pharmacy.layout._sidebar') 

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>

                  <form action="{{ $module_url_path }}/store_signup_step2" id="frm_signup_step2_id" name="frm_signup_step2_id" method="post">
                  {{ csrf_field() }}

                  <input type="hidden" name="enc_token_id" id="enc_token_id" value="{{ $enc_token_id or '' }}">

                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                          
                                       @include('front.pharmacy.layout.middlebar') 

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
                                          <option value="1"    @if(isset($arr_temp_pharmacy['aprox_script_per_day']) && $arr_temp_pharmacy['aprox_script_per_day']==1) selected="" 
                                                  @endif  >1-50</option>
                                          <option value="2" @if(isset($arr_temp_pharmacy['aprox_script_per_day']) && $arr_temp_pharmacy['aprox_script_per_day']==2) selected="" 
                                                  @endif>50-100</option>
                                          <option value="3" @if(isset($arr_temp_pharmacy['aprox_script_per_day']) && $arr_temp_pharmacy['aprox_script_per_day']==3) selected="" 
                                                  @endif>100-150</option>
                                          <option value="4" @if(isset($arr_temp_pharmacy['aprox_script_per_day']) && $arr_temp_pharmacy['aprox_script_per_day']==4) selected="" 
                                                  @endif>upto 500</option>
                                          <option value="5" @if(isset($arr_temp_pharmacy['aprox_script_per_day']) && $arr_temp_pharmacy['aprox_script_per_day']==5) selected="" 
                                                  @endif>500+</option>

                               
                                          </select>
                                           <span class='err'>{{ $errors->first('aprox_script_per_day') }}</span>
                                       </div>
                                       </div>
                                       <div class="user-box">
                                          <div class="select-style pharma-step-drp">
                                             <select class="frm-select" data-rule-required='true' id="computer_system_used" name="computer_system_used"  onchange="checkOtherField(this.value)">
                                                <option value="">Computer System Used</option>
                                                <option value="1"

                                                  @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==1) selected="" 
                                                  @endif 

                                                  >FRED Dispense</option>
                                                <option value="2"

                                                  @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==2) selected="" 
                                                  @endif 


                                                >Minfos Dispense</option>
                                                <option value="3"

                                                  @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==3) selected="" 
                                                  @endif 

                                                >Corum LOTS</option>
                                                <option value="4"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==4) selected="" 
                                                  @endif 

                                                >Surefire Dispense (Amfac)</option>
                                                <option value="5"

                                                @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==5) selected="" 
                                                  @endif 

                                                >Simple Aquarius</option>
                                                <option value="6"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==6) selected="" 
                                                  @endif 

                                                >Healthsoft Pharmacy Pro</option>
                                                <option value="7"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==7) selected="" 
                                                  @endif 

                                                >Mountaintop Dispense</option>
                                                <option value="8"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==8) selected="" 
                                                  @endif 

                                                >Z Dispense</option>
                                                <option value="9"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==9) selected="" 
                                                  @endif 

                                                >CDS</option>
                                                <option value="10"

                                                 @if(isset($arr_temp_pharmacy['computer_system_used']) && $arr_temp_pharmacy['computer_system_used']==10) selected="" 
                                                  @endif 

                                                >Other</option>
                                             </select>
                                          </div>
                                           <span class='err'>{{ $errors->first('computer_system_used') }}</span>
                                          <div class="clearfix"></div>
                                       </div>
                                       <div class="user_box" id="other_field" style="display:none">
                                          <input type="text" name="other_field" id="other_system" value="{{ $arr_temp_pharmacy['other_computer_system']  or '' }}" class="input_acct-logn" placeholder="Please enter your system" />
                                          <div id="err_other_system" class="error"></div>
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
                                          <input type="checkbox"  class="css-checkbox" value=1  @if( isset($arr_temp_pharmacy['services']) && in_array("1", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif  name="services[]" id="checkbox3" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox3">Offer Click & Collect</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value=2  @if( isset($arr_temp_pharmacy['services']) && in_array("2", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif name="services[]" id="checkbox4" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox4">Offer Delivery to Patients</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value=3 @if( isset($arr_temp_pharmacy['services']) && in_array("3", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif  name="services[]" id="checkbox5" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me"  for="checkbox5">Passport Photos</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox"  class="css-checkbox" value=4  @if( isset($arr_temp_pharmacy['services']) && in_array("4", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif name="services[]" id="checkbox6" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox6">Specialised Compounding</label>
                                       </div>
                                       <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value=5  @if( isset($arr_temp_pharmacy['services']) && in_array("5", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif  name="services[]" id="checkbox7" tabindex=3/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox7">Flu Vaccination Clinics</label>
                                       </div>
                                        <div class="check-box pharmacy-signup2">
                                          <input type="checkbox" class="css-checkbox" value=6  @if( isset($arr_temp_pharmacy['services']) && in_array("6", $arr_temp_pharmacy['services']))
                                                checked='checked'
                                             @endif id="checkbox8" name="services[]" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox8">Other</label>
                                       </div>

                                        <div id="other_service_id" style="display:none">
                                           <div class="user_box">
                                              <input type="text" name="other_service" value="{{ $arr_temp_pharmacy['other_service']  or '' }}" id="other_prof_service" class="input_acct-logn" placeholder="Please enter other service" />
                                           </div>
                                           <div id="err_prof_other_service" class="error"></div>
                                       </div>

                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <div style="color:red" id="err_service_id"></div>
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
      $('#frm_signup_step2_id').validate({
                     errorElement:'span',
               
                            messages: {

                                  'aprox_script_per_day'  : "Please Select aproximate script per day",
                                  'computer_system_used'  : "Please Select computer system used",

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

       /*to checked other services*/
        if($('#checkbox8').attr('checked')) {
            $("#other_service_id").show();
        } else {
            $("#other_service_id").hide();
        }

         /*to checked other services*/
         $("#checkbox8").click(function () {
            if ($(this).is(":checked")) {
                $("#other_service_id").show();
            } else {
                $("#other_service_id").hide();
            }
        });

       $("#next_signup_step2_id").click(function() {

            $("#frm_signup_step2_id").submit();

        });


   });

    $("#frm_signup_step2_id").submit(function(){

            $('#err_service_id').html('');
            if(!$('#frm_signup_step2_id input[type="checkbox"]').is(':checked'))
            {
                $('#err_service_id').html('Select atleast one service.');
                return false;
            }

            var computer_system_used = $('#computer_system_used').val();
            if(computer_system_used==10)
            {
                var other_system =  $('#other_system').val();
                if(other_system=='')
                {
                    $('#err_other_system').html('Please enter your computer system.');
                    return false;
                }
         
            }

            /*other service */

            if($('#checkbox8').attr('checked'))
            {
                var other_service =  $('#other_prof_service').val();
                if(other_service=='')
                {
                    $('#err_prof_other_service').html('Please enter other service.');
                    return false;
                }
         
            }

     
    });

</script>
@endsection