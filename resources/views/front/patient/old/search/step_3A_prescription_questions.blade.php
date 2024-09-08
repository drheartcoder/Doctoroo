@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<!--dashboard section-->            
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx patient-white-bx" style="background: rgb(255, 255, 255)">

               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="see-d-dash-panel text-center">
                     @include('front.layout._operation_status')
                     
                        <div class="distance">
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-left">
                              <a href="{{ url('/search/doctor/what-are-you-seeking-from-doctor') }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                           </div>
                           <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10" style="position:relative;">
                              
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <?php 
                              $consultation_for = Session::get('consultation_for');
                              if($consultation_for!='')
                              {
                                 $arr_cons = explode(',',$consultation_for);
                                 if(in_array('All',$arr_cons) || in_array('medical_certificate',$arr_cons))
                                 {
                                     $url = '/search/doctor/medical-history/questions';
                                 }
                                 else
                                 {
                                     $url = '/search/doctor/more-precise';
                                 }
                              }
                              ?>
                              <!-- <li><a href="{{ url('/') }}{{ $url }}" class="skip-txt"> Skip this step</a> </li> -->
                           </ul>
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                              <a href="javascript:void(0);" class="sbmt_prescription_questions"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a>
                           </div>
                           <div class="clr"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
               <form name="frm_prescription_questions" id="frm_prescription_questions" action="{{ url('/search/doctor/store_prescription_questions') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="col-sm-12 col-md-10 col-lg-10">
                     <br/>
                     <div class="faculty-text">
                        To make things simple, you can complete the before questions for your doctor to review before the call.
                     </div>                     
                  </div>
                  <div class="col-sm-12 col-md-8 col-lg-8 request-details-bx">                    

                     <div class="clearfix"></div>
                     <h4>Current Medications you are taking &nbsp;&nbsp; 
                        <input type="checkbox" value="No"  name="currently_taking_medications" id="any_medications1" class="css-checkbox" <?php if(isset($pres_ques_info[0]['currently_taking_medications'])){ if($pres_ques_info[0]['currently_taking_medications']=='No') echo 'checked="checked"';} ?>>
                        <label for="any_medications1" class="css-label radGroup2">&nbsp;None</label>
                     </h4>
                     <div class="error" id="err_currently_taking_medications"></div>                     

                     <textarea name="what_is_medications" id="what_is_medications" class="form-inputs" style="padding-top:10px;height:119px;"><?php if(isset($pres_ques_info[0]['what_is_medications'])){ echo $pres_ques_info[0]['what_is_medications'];} ?></textarea>
                     <div class="error" id="err_what_is_medications">@if($errors->has('what_is_medications')){{ $errors->first('what_is_medications') }} @endif</div>

                     <h4>Please upload your current prescription (Optional)</h4>
                     <div class="pres-ques">
                        <input class="upload" style="display:none" id="current_prescription_upload" name="current_prescription_upload"  type="file" />
                        <div class="fileUpload" style="cursor:pointer" onclick="triggerPrescriptionFile(this)"> <span>Upload</span></div>
                        <div class="fileUpload" style="cursor:pointer">
                        <?php if(isset($pres_ques_info[0]['current_prescription_upload'])){?>
                        <a href="{{ url('/search/download/prescription/') }}<?php  echo '/'.$pres_ques_info[0]['current_prescription_upload']; ?>" style="color:#50ab50;"><img src="{{ url('/') }}/public/images/download-img.png" /> Download Existing</a><?php } ?>
                        </div>

                        <div class="error" id="err_current_prescription_upload">@if($errors->has('current_prescription_upload')){{ $errors->first('current_prescription_upload') }} @endif</div>
                        <input id="old_current_prescription_upload" name="old_current_prescription_upload"  type="hidden" value="<?php if(isset($pres_ques_info[0]['current_prescription_upload'])){ echo $pres_ques_info[0]['current_prescription_upload'];} ?>" />
                     </div>

                     <h4>How long have you been taking the medication?</h4>
                     <input class="form-inputs" type="text" name="how_long_medications" id="how_long_medications" value="<?php if(isset($pres_ques_info[0]['how_long_medications'])){ echo $pres_ques_info[0]['how_long_medications'];} ?>"  />
                     <div class="error" id="err_how_long_medications">@if($errors->has('how_long_medications')){{ $errors->first('how_long_medications') }}@endif</div>
                     <div class="clearfix"></div>
                     <h4>Any other Information ?</h4>
                     <textarea name="other_info" id="other_info"  class="form-inputs" style="padding-top:10px;height:119px;"><?php if(isset($pres_ques_info[0]['other_info'])){ echo $pres_ques_info[0]['other_info'];} ?></textarea>
                     <div class="error" id="err_other_info">@if($errors->has('other_info')){{ $errors->first('other_info') }}@endif</div>
                     <br/>
                  </div>
                  <div class="col-sm-12">
                     
                     <div class="certi-btn text-right">
                        <button class="details-btn select-btn sbmt_prescription_questions" id="sbmt_prescription_questions" name="sbmt_prescription_questions">CONTINUE</button>
                     </div>
                  </div>
               </form>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function(){
            $('.sbmt_prescription_questions').click(function(){
               
               var currently_taking_medications = $('input[name="currently_taking_medications"]:checked').val();
               var what_is_medications = $('#what_is_medications').val();
               var current_prescription_upload = $('#current_prescription_upload').val();
               var how_long_medications = $('#how_long_medications').val();
               var other_info = $('#other_info').val();

               if($.trim(currently_taking_medications)=='' && $.trim(what_is_medications)=='')
               {
                  $('#err_what_is_medications').show();
                  $('#what_is_medications').focus();
                  $('#err_what_is_medications').html('Please enter your current medications.');
                  $('#err_what_is_medications').fadeOut(4000);
                  return false;  
               }
               else if($.trim(how_long_medications)=='' && $.trim(currently_taking_medications)=='')
               {
                  $('#err_how_long_medications').show();
                  $('#how_long_medications').focus();
                  $('#err_how_long_medications').html('Please enter how long you are taking any medication.');
                  $('#err_how_long_medications').fadeOut(4000);
                  return false;  
               }
               else if($.trim(other_info)=='' && $.trim(currently_taking_medications)=='')
               {
                  $('#err_other_info').show();
                  $('#other_info').focus();
                  $('#err_other_info').html('Please enter other information if any.');
                  $('#err_other_info').fadeOut(4000);
                  return false;  
               }
               else
               {
                  $('#frm_prescription_questions').submit();
                  return true;
               }
            });
         })
      </script>
@stop