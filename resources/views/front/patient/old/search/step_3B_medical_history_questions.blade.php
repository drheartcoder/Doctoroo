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
                          <?php 
                              $consultation_for = Session::get('consultation_for');
                              if($consultation_for!='')
                              {
                                 $arr_cons = explode(',',$consultation_for);
                                 if(in_array('All',$arr_cons) || in_array('prescription',$arr_cons))
                                 {
                                    $url = '/search/doctor/prescription/questions';
                                 }
                                 else
                                 {
                                     $url = '/search/doctor/what-are-you-seeking-from-doctor';
                                 }
                              }
                          ?>   
                              <a href="{{ url('/') }}{{ $url }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                           </div>
                           <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10" style="position:relative;">
                              
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <!-- <li><a href="{{ url('/search/doctor/more-precise') }}" class="skip-txt"> Skip this step</a> </li> -->
                           </ul>
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                              <a href="javascript:void(0);" class="sbmt_medication_questions"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a>
                           </div>
                           <div class="clr"></div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
               <form name="frm_prescription_questions" id="frm_prescription_questions" action="{{ url('/search/doctor/store_step_3B_medical_certificate_questions') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="col-sm-12 col-md-10 col-lg-10">
                        <br/>
                        <div class="faculty-text">
                            To make things simple, you can complete the before questions for your doctor to review before the call.
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8 request-details-bx">                        
                        <h4>How Long have you had the symptoms ?</h4>
                        <div class="select-style my-pati select-width">
                            <select class="frm-select" name="symptoms_from" id="symptoms_from">
                                <option value=""> - Select - </option>
                                <option value="1-2 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="1-2 Days"){echo 'selected="selected"';} } ?>>1-2 Days</option>
                                <option value="2-3 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="2-3 Days"){echo 'selected="selected"';} } ?>>2-3 Days</option>
                                <option value="3-4 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="3-4 Days"){echo 'selected="selected"';} } ?>>3-4 Days</option>
                                <option value="4-5 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="4-5 Days"){echo 'selected="selected"';} } ?>>4-5 Days</option>
                                <option value="5-6 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="5-6 Days"){echo 'selected="selected"';} } ?>>5-6 Days</option>
                                <option value="6-8 Days" <?php if(isset($medi_ques_info[0]['symptoms_from'])){ if($medi_ques_info[0]['symptoms_from']=="6-8 Days"){echo 'selected="selected"';} } ?>>6-8 Days</option>                                
                            </select>
                            <div class="error" id="err_symptoms_from"></div>
                        </div>
                        <h4>What dates do you need the certificate for ?</h4>
                        <div class="row" style="position:relative;">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <input class="form-inputs datepicker" placeholder="mm/dd/yyyy" type="text" name="certificate_from_date" id="certificate_from_date" value="<?php if(isset($medi_ques_info[0]['certificate_from_date'])){echo date('d-m-Y',strtotime($medi_ques_info[0]['certificate_from_date'])); } ?>" />
                                <span class="cal-ics"><img src="{{ url('/') }}/public/images/cal-icon.png" alt="icon"/></span>
                                <div class="error" id="err_certificate_from_date"></div>
                            </div>
                            <div class="or-txt" style="font-family:'robotolight';">To</div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <input class="form-inputs datepicker" placeholder="mm/dd/yyyy" type="text" name="certificate_to_date" id="certificate_to_date" value="<?php if(isset($medi_ques_info[0]['certificate_to_date'])){echo date('d-m-Y',strtotime($medi_ques_info[0]['certificate_to_date'])); } ?>" />
                                <span class="cal-ics"><img src="{{ url('/') }}/public/images/cal-icon.png" alt="icon"/> </span>
                                <div class="error" id="err_certificate_to_date"></div>
                            </div>
                        </div>
                        <br/>
                        <div class="check-box med-step2">
                            <input type="checkbox" name="tc" id="tc" value="checked" class="css-checkbox" <?php  if(isset($medi_ques_info[0]['certificate_to_date'])){ echo 'checked="checked"'; }?> />
                            <label class="css-label radGroup2" for="radio1" onclick="javascript:return chk_terms();">I confirm and agree to <a data-toggle="modal" href="#TandC" class="terms-c_link"> Terms &amp; Conditions </a></label>
                            <div class="error" id="err_tc"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="cer-text">
                            In order for a GP to Supply you with a medical certificate then you need to book a 4 minute consultation. ($24)
                        </div>
                        <div class="certi-btn">
                            <button class="details-btn select-btn sbmt_medication_questions">Confirm &amp; Select consultation time</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="clearfix"></div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
<script>
function chk_terms()
{
  if($("input[name='tc']:checked").length)
  {
    $("#tc").attr("checked",false);
  }
  else
  {
    $("#tc").attr("checked",true);
  }
}

$(document).ready(function(){

    $('#certificate_from_date').datepicker({ dateFormat: 'dd-mm-yy' });
    $('#certificate_to_date').datepicker({ dateFormat: 'dd-mm-yy' });

    $('.sbmt_medication_questions').click(function(){
        
        var symptoms_from = $('#symptoms_from').val();

        var certificate_from_date = $('#certificate_from_date').val();
        var certificate_to_date = $('#certificate_to_date').val();
        
        var date = certificate_from_date.substring(0, 2);
        var month = certificate_from_date.substring(3, 5);
        var year = certificate_from_date.substring(6, 10);

        var myDate = new Date(year, month - 1, date);
        
        var date1 = certificate_to_date.substring(0, 2);
        var month1 = certificate_to_date.substring(3, 5);
        var year1 = certificate_to_date.substring(6, 10);

        var myDate1 = new Date(year1, month1 - 1, date1);


        var tc = $('input[name="tc"]:checked').length;
        
        if($.trim(symptoms_from)=='')
        {
          $('#err_symptoms_from').show();
          $('#symptoms_from').focus();
          $('#err_symptoms_from').html('Please enter Symptoms from days.');
          $('#err_symptoms_from').fadeOut(4000);
          return false;  
        }
        else if($.trim(certificate_from_date)=='')
        {
          $('#err_certificate_from_date').show();
          $('#certificate_from_date').focus();
          $('#err_certificate_from_date').html('Please enter from which date you want a certificate.');
          $('#err_certificate_from_date').fadeOut(4000);
          return false;  
        }
        else if($.trim(certificate_to_date)=='')
        {
          $('#err_certificate_to_date').show();
          $('#certificate_to_date').focus();
          $('#err_certificate_to_date').html('Please enter upto which date you want a certificate.');
          $('#err_certificate_to_date').fadeOut(4000);
          return false;  
        }
        else if(myDate>=myDate1)
        {
          $('#err_certificate_from_date').show();
          $('#certificate_from_date').focus();
          $('#err_certificate_from_date').html('Start date should be less than End date.');
          $('#err_certificate_from_date').fadeOut(4000);
          return false;  
        }
        else if(tc==0)
        {
          $('#err_tc').show();
          $('#tc').focus();
          $('#err_tc').html('Please accept Terms and Conditions.');
          $('#err_tc').fadeOut(4000);
          return false;  
        }
        else
        {
            $('#frm_prescription_questions').submit();
            return true;
        }
    });
});
</script>
@stop