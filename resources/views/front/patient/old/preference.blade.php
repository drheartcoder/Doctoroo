@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')

  
       <div class="middle-section">
         <div class="container">
           @include('front.layout._operation_status')
           <div class="das-middle-content">
                <div class="row">
                   <div class="col-sm-12 col-md-12 col-lg-12">

                   <form action="{{ $module_url_path }}/preference/create" method="post" name="frm_patient_pref" id="frm_patient_pref">
                      {{ csrf_field() }}
                   <div class="tab-section">
                      <div class="doc-dash-right-bx" style="margin:0;">

                            <div class="white-bxx">
                               <div class="uer-bxx">
                                  <div class="gree-txt"></div>
                                    <br/>

                          
                                     <div class="user-box request-details-bx">
                                       
                                         <h4> Select Preference</h4>
                                         <h5>(Please select any preference to recevied notification.)</h5>
                                         
                                      <div class="check-box med-step2 patient_pref">
                                          <input type="checkbox"  class="css-checkbox" @if(isset($arr_prefernce['sms_notification']) && $arr_prefernce['sms_notification']==1) checked="" @endif  id="radio1" value="1" name="sms_notification" />
                                          <label class="css-label radGroup2 " for="radio1">SMS notification</label>
                                      </div>
                                       
                                        <div class="check-box med-step2 patient_pref">
                                          <input type="checkbox" @if(isset($arr_prefernce['stop_notification']) && $arr_prefernce['stop_notification']==1) checked="" @endif  class="css-checkbox" id="radio2" value="1" name="stop_notification" />
                                          <label class="css-label radGroup2 " for="radio2">Stop all notifications</label>
                                        </div>
                                       
                                        <div class="check-box med-step2 patient_pref">
                                          <input type="checkbox" @if(isset($arr_prefernce['stop_marketing_notification']) && $arr_prefernce['stop_marketing_notification']==1) checked="" @endif  class="css-checkbox" id="radio3" value="1" name="stop_marketing_notification" />
                                          <label class="css-label radGroup2 " for="radio3">Stop marketing notifications</label>
                                        </div>
                                           <span class="err" id="err_patient_prefernces"></span>
                                      </div>
                           

                                  <input type="submit" style="margin-bottom:10px;" class="preview-link sum-btn" value="Submit" name="btn_submit">


                                  </div>
                               </div>
                            </div><!--white-bxx-->   
                        </div>
                    </div>
                  </form>
                </div>
                </div>
              </div>
            </div>
          </div>



<script>
   
   
     $('#frm_patient_pref').on('submit',function()
        {
              $('#err_patient_prefernces').html('');
                if($('.patient_pref').find('input[type=checkbox]:checked').length == 0)
                {
                   $('#err_patient_prefernces').html('Please select atleast one checkbox.');
                   return false;
                }
                else
                {
                   showProcessingOverlay();
                }

        }); 

 
</script>
@endsection