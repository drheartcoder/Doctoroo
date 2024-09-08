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
     <form action="{{ $module_url_path.'/store_step_1'}}" method="post" name="frm_step_one" id="frm_step_one" enctype="multipart/form-data">
      {{csrf_field()}}

      <input type="hidden" name="family_member_id" value="{{ $family_member_id or '' }}">

      <div class="back-whhit-bx patient-white-bx" style="background:#fff">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="see-d-dash-panel text-center">
                  
                   @include('front.patient.layout.middlebar')

                  <div class="clr"></div>
               </div>
               <div class="clr"></div>
               <br/>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
               <div class="section-box">
                  <div class="hist-list">
                     <ul>
                        <li> Location of problem?</li>
                        <li> Symptoms (headache, chest pain, coughing, vomiting etc)</li>
                        <li> When did this problem begin?</li>
                        <li> Has it changed over time?</li>
                        <li> Does it vary depending on time of day?</li>
                        <li> Does anything make the symptoms better or worse?</li>
                        <li> Does the problem interfere with daily activities or sleep?</li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
               <div class="section-box">
                  <div class="med-his-txt">
                     Please provide as much detail about your current symptoms or condition, by answering the questions provided. 
                  </div>
                  <textarea cols="" name="health_issue" id="health_issue" rows="" class="frm-in" style="height:153px;padding-top:10px;">
                    {{isset($arr_medicalhistory['health_issue'])?$arr_medicalhistory['health_issue']:''}}
                  </textarea>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="section-box">
                  <h4 style="padding:0;">Current Medications</h4>
                  <div class="med-his-txt">
                     Here you can list the medications you have taken in the past, and the one you are taking now.
                  </div>
                  <?php $j=1;?>
                  @if(isset($arr_curr_medicalhistory) && count($arr_curr_medicalhistory)>0)
                  @foreach($arr_curr_medicalhistory as $history)
                    <div class="current-medic clone_curr_div" id="clone_curr_div{{$j}}">
                     <div class="remove_curr_medication" id="removecurrdiv{{$j}}">
                     <div class="col-div">
                        <div class="pharma-in">
                         <input type="text" class="form-inputs curr_medication_name" name="curr_medication_name[]" id="curr_medication_name" placeholder="Medication Name" value="{{isset($history['medication_name'])?$history['medication_name']:''}}">
                         </div>
                         <div class="err err_curr_medication_name" id="err_curr_medication_name"></div>
                     </div>
                     <div class="don-load">
                        <div class="fileUpload attached-block">
                           <span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>
                           <input class="upload" name="curr_precription_file[]" id="curr_precription_file" type="file"/>
                            <input type="hidden" name=old_curr_precription_file[] value="{{isset($history['precription_file'])?$history['precription_file']:''}}">
                           <div class="err err_curr_precription_file" id="err_curr_precription_file"></div>
                        </div>
                     </div>
                     <div class="col-div cal-in">
                        <input type="text" class="form-inputs datepicker" name="curr_date_started[]" id="curr_date_started" placeholder="Date Started" value="{{isset($history['date_started'])?date('m/d/y',strtotime($history['date_started'])):''}}"/>
                        <span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                        <div class="err err_curr_date_started" id="err_curr_date_started"></div>
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in ">
                           <div class="select-style">
                              <select class="frm-select" name="curr_number[]" id="curr_number">
                                <option value="">Number</option>
                                <?php for($i=1;$i<100;$i++) { ?>
                                 <option @if(isset($history['m_number']) && $history['m_number']==$i) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                <?php }?>
                               </select>
                            </div>
                        </div>
                       <div class="err err_curr_number" id="err_curr_number"></div> 
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in">
                           <div class="select-style">
                              <select class="frm-select" name="curr_frequency[]" id="curr_frequency">
                                 <option value="">Frequency</option>
                                 <option @if(isset($history['frequency']) && $history['frequency']=='Daily') selected="selected" @endif value="Daily">Daily</option>
                                 <option @if(isset($history['frequency']) && $history['frequency']=='Weekly') selected="selected" @endif value="Weekly">Weekly</option>
                                 <option @if(isset($history['frequency']) && $history['frequency']=='Monthly') selected="selected" @endif value="Monthly">Monthly</option>
                              </select>
                           </div>
                        </div>
                       <div class="err err_curr_frequency" id="err_curr_frequency"></div>
                     </div>
                     <div class="col-div">
                        <input type="text" class="form-inputs" name="curr_use[]" id="curr_use" placeholder="Use" value="{{isset($history['m_use'])?$history['m_use']:''}}"/>
                        <div class="err err_curr_use" id="err_curr_use"></div>
                     </div>
                     @if(isset($history['precription_file']) && file_exists('uploads/patient/precription_file/'.$history['precription_file']))
                      <span class="don-load don-load1"><a href="{{url('/')}}/patient/medicalhistory/download/{{base64_encode($history['id'])}}">
                          <i class="fa fa-download"></i>
                          </a></span>
                     @endif 
                     <div class="col-div plus-icn-in">
                       <a href="javascript:void(0);" onclick="removecurrentmedication('<?php echo $j;?>')"> <i class="fa fa-minus-square"></i></a>
                     </div>
                    </div>
                    <div class="col-div plus-icn-in class_curr_medication">
                     <?php if($j==1){ ?>
                      <a href="javascript:void(0);" onclick="addCurrentMedication();"> <i class="fa fa-plus-square"></i></a>
                     <?php }?>  
                    </div> 
                    </div>
                  <?php $j++;?>
                  @endforeach
                  @else
                  <div class="current-medic clone_curr_div" id="clone_curr_div">
                    <div class="remove_curr_medication" id="removecurrdiv0">
                     <div class="col-div">
                        <div class="pharma-in">
                            <input type="text" class="form-inputs curr_medication_name" name="curr_medication_name[]" value="" id="curr_medication_name" placeholder="Medication Name">
                         </div>
                         <div class="err err_curr_medication_name" id="err_curr_medication_name"></div>
                     </div>
                     <div class="don-load">
                        <div class="fileUpload attached-block">
                           <span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>
                           <input class="upload" name="curr_precription_file[]" id="curr_precription_file" type="file"/>
                           <input type="hidden" name=old_curr_precription_file[]>
                           <div class="err err_curr_precription_file" id="err_curr_precription_file"></div>
                        </div>
                     </div>
                     <div class="col-div cal-in">
                        <input type="text" class="form-inputs datepicker" name="curr_date_started[]" id="curr_date_started" placeholder="Date Started" />
                        <span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                        <div class="err err_curr_date_started" id="err_curr_date_started"></div>
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in ">
                           <div class="select-style">
                              <select class="frm-select" name="curr_number[]" id="curr_number">
                                 <option value="">Number</option>
                                 <?php for($i=1;$i<100;$i++) { ?>
                                 <option value="{{$i}}">{{$i}}</option>
                                 <?php }?>
                                </select>
                            </div>
                        </div>
                       <div class="err err_curr_number" id="err_curr_number"></div> 
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in">
                           <div class="select-style">
                              <select class="frm-select" name="curr_frequency[]" id="curr_frequency">
                                 <option value="">Frequency</option>
                                 <option value="Daily">Daily</option>
                                 <option value="Weekly">Weekly</option>
                                 <option value="Monthly">Monthly</option>
                              </select>
                           </div>
                        </div>
                       <div class="err err_curr_frequency" id="err_curr_frequency"></div>
                     </div>
                     <div class="col-div">
                        <input type="text" class="form-inputs" name="curr_use[]" id="curr_use" placeholder="Use" />
                        <div class="err err_curr_use" id="err_curr_use"></div>
                     </div>
                     <div class="col-div plus-icn-in">
                      <a href="javascript:void(0);" onclick="removecurrentmedication(0)"> <i class="fa fa-minus-square"></i></a>
                    </div> 
                    </div> 
                    <div class="col-div plus-icn-in class_curr_medication">
                     <a href="javascript:void(0);" onclick="addCurrentMedication();"> <i class="fa fa-plus-square"></i></a>
                    </div> 
                  </div>
                  @endif
                  <div class="append_curr_medication"></div>
                   <br/>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="section-box">
                  <h4 style="padding:0;">Past Medications</h4>
                  <div class="med-his-txt">
                     Here you can list the medications you have taken in the past, and the one you are taking now.
                  </div>
                  <?php $k=1;?>
                  @if(count($arr_past_medicalhistory)>0)
                  @foreach($arr_past_medicalhistory as $pasthistory)
                    <div class="current-medic clone_past_div" id="clone_past_div{{$k}}">
                    <div class="remove_curr_medication" id="removepastdiv{{$k}}">
                     <div class="col-div">
                        <div class="pharma-in">
                            <input type="text" class="form-inputs past_medication_name" name="past_medication_name[]" id="past_medication_name" placeholder="Medication Name" value="{{isset($pasthistory['medication_name'])?$pasthistory['medication_name']:''}}">
                          </div>
                      </div>
                      <div class="err err_past_medication_name" id="err_past_medication_name"></div> 
                     <div class="don-load">
                        <div class="fileUpload attached-block">
                           <span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>
                           <input class="upload" type="file" name="past_precription_file[]" id="past_precription_file"/>
                           <input type="hidden" name=old_past_precription_file[] value="{{isset($pasthistory['precription_file'])?$pasthistory['precription_file']:''}}">
                           <div class="err err_past_precription_file" id="err_past_precription_file"></div>
                        </div>
                     </div>
                     <div class="col-div cal-in">
                        <input type="text" class="form-inputs datepicker" name="past_date_started[]" id="past_date_started" placeholder="Date Started" value="{{isset($pasthistory['date_started'])?date('m/d/y',strtotime($pasthistory['date_started'])):''}}"/>
                        <span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                         <div class="err err_past_date_started" id="err_past_date_started"></div>
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in ">
                           <div class="select-style">
                              <select class="frm-select" name="past_number[]" id="past_number">
                                 <option value="">Number</option>
                                 <?php for($i=1;$i<100;$i++) { ?>
                                 <option @if(isset($pasthistory['m_number']) && $pasthistory['m_number']==$i) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                <?php }?>
                              </select>
                            </div>
                        </div>
                       <div class="err err_past_number" id="err_past_number"></div> 
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in">
                           <div class="select-style">
                              <select class="frm-select" name="past_frequency[]" id="past_frequency">
                                 <option value="">Frequency</option>
                                  <option @if(isset($pasthistory['frequency']) && $pasthistory['frequency']=='Daily') selected="selected" @endif value="Daily">Daily</option>
                                 <option @if(isset($pasthistory['frequency']) && $pasthistory['frequency']=='Weekly') selected="selected" @endif value="Weekly">Weekly</option>
                                 <option @if(isset($pasthistory['frequency']) && $pasthistory['frequency']=='Monthly') selected="selected" @endif value="Monthly">Monthly</option>
                              </select>
                            </div>
                        </div>
                       <div class="err err_past_frequency" id="err_past_frequency"></div>   
                     </div>
                     <div class="col-div">
                        <input type="text" class="form-inputs" name="past_use[]" id="past_use" placeholder="Use" value="{{isset($pasthistory['m_use'])?$pasthistory['m_use']:''}}"/>
                        <div class="err err_past_use" id="err_past_use"></div> 
                     </div>
                     @if(isset($pasthistory['precription_file']) && file_exists('uploads/patient/precription_file/'.$pasthistory['precription_file']))
                     <span class="don-load don-load1"><a href="{{url('/')}}/patient/medicalhistory/download/{{base64_encode($pasthistory['id'])}}"><i class="fa fa-download"></i></a></span>
                     @endif
                    <div class="col-div plus-icn-in">
                     <a href="javascript:void(0);" onclick="removepastmedication('<?php echo $k;?>')"> <i class="fa fa-minus-square"></i></a>
                   </div>
                  </div>
                  <div class="col-div plus-icn-in class_curr_medication">
                  <?php if($k==1){ ?>
                    <a href="javascript:void(0);" onclick="addPastMedication()"> <i class="fa fa-plus-square"></i></a>
                   <?php } ?>
                  </div>
                  </div>
                  <?php $k++;?>
                  @endforeach
                  @else
                  <div class="current-medic clone_past_div" id="clone_past_div">
                    <div class="remove_curr_medication" id="removepastdiv">
                     <div class="col-div">
                        <div class="pharma-in">
                          <input type="text" class="form-inputs past_medication_name" name="past_medication_name[]" value="" id="past_medication_name" placeholder="Medication Name">
                        </div>
                      </div>
                      <div class="err err_past_medication_name" id="err_past_medication_name"></div> 
                     <div class="don-load">
                        <div class="fileUpload attached-block">
                           <span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>
                           <input class="upload" type="file" name="past_precription_file[]" id="past_precription_file" />
                            <input type="hidden" name=old_past_precription_file[]>
                           <div class="err err_past_precription_file" id="err_past_precription_file"></div>
                        </div>
                     </div>
                     <div class="col-div cal-in">
                        <input type="text" class="form-inputs datepicker" name="past_date_started[]" id="past_date_started" placeholder="Date Started" />
                        <span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>
                         <div class="err err_past_date_started" id="err_past_date_started"></div>
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in ">
                           <div class="select-style">
                              <select class="frm-select" name="past_number[]" id="past_number">
                                 <option value="">Number</option>
                                 <?php for($i=1;$i<100;$i++) { ?>
                                 <option value="{{$i}}">{{$i}}</option>
                                 <?php }?>
                              </select>
                            </div>
                        </div>
                       <div class="err err_past_number" id="err_past_number"></div> 
                     </div>
                     <div class="col-div num-drp">
                        <div class="pharma-in">
                           <div class="select-style">
                              <select class="frm-select" name="past_frequency[]" id="past_frequency">
                                 <option value="">Frequency</option>
                                 <option value="Daily">Daily</option>
                                 <option value="Weekly">Weekly</option>
                                 <option value="Monthly">Monthly</option>
                              </select>
                            </div>
                        </div>
                       <div class="err err_past_frequency" id="err_past_frequency"></div>   
                     </div>
                     <div class="col-div">
                        <input type="text" class="form-inputs" name="past_use[]" id="past_use" placeholder="Use" />
                        <div class="err err_past_use" id="err_past_use"></div> 
                     </div>
                     <div class="col-div plus-icn-in">
                      <a href="javascript:void(0);" onclick="removepastmedication(0)"> <i class="fa fa-minus-square"></i></a>
                    </div>  
                   </div> 
                    <div class="col-div plus-icn-in class_curr_medication">
                     <a href="javascript:void(0);" onclick="addPastMedication()"> <i class="fa fa-plus-square"></i></a>
                    </div>
                  </div>
                  @endif
                  <div class="append_past_medication"></div>
                  <div class="currnt-medi-btn">
                  </div>
                  <div class="currnt-medi-btn">
                    <!--  <button class="btn-grn addPastMedication" type="button" onclick="addPastMedication();">Add Medications</button> -->
                     <div class="btm-btns">
                        <button class="next-bttn" type="button" name="btn_save_medicalhistory" id="btn_save_medicalhistory" onclick="savemedicalhistory()">Save &amp; Continue</button> 
                       {{--  <a href="{{url('/')}}/patient/medicalhistory/step-2" class="skip-btn"> Skip this step</a>  --}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     </form> 
   </div>
</div>
<!--dashboard section-->
<script  src="{{ url('/') }}/public/js/jquery-ui.js"></script> 
<script>
/*=====================Autocompleted for medication===========*/
               
$(document).ready(function(){

  $('input[name^="curr_medication_name"],input[name^="past_medication_name"]').each(function (i) {
    var ac_new_invoice = (function (i) {
        return {
          minLength:3,
         
          source:"{{url('/')}}/patient/medicalhistory/medication_listing",
          search: function () {
           },
           response: function () {
          },
          select:function(event,ui)
          {
             
          }
        };
    })(i);
    $(this).autocomplete(ac_new_invoice);
});

});                     

/*=====================Add Current medication=======================*/

  var regex = /^(.+?)(\d+)$/i;
  var cloneIndex = $(".clone_curr_div").length;

  function addCurrentMedication()
  {

      var content = '';
      var curr_medication_name =  $("input[name='curr_medication_name[]']:last").val();
      var curr_precription_file=  $("input[name='curr_precription_file[]']:last").val();
      var curr_ext             =  curr_precription_file.split('.').pop();
      var old_curr_precription =  $("input[name='old_curr_precription_file[]']:last").length;
      var curr_date_started    =  $("input[name='curr_date_started[]']:last").val();
      var curr_number          =  $("select[name='curr_number[]']:last").val();
      var curr_frequency       =  $("select[name='curr_frequency[]']:last").val();
      var curr_use             =  $("input[name='curr_use[]']:last").val();


     /* if($.trim(curr_medication_name)=="")
      {

         $('.clone_curr_div').find('.err_curr_medication_name').eq(cloneIndex-1).fadeIn('fast');
         $('.clone_curr_div').find('.err_curr_medication_name').eq(cloneIndex-1).html('Please select medication name.');  
         $('.clone_curr_div').find('.err_curr_medication_name').eq(cloneIndex-1).fadeOut(4000);
         return false;
      }

      else if($.trim(curr_date_started)=="")
      {

         $('.clone_curr_div').find('.err_curr_date_started').eq(cloneIndex-1).fadeIn('fast');
         $('.clone_curr_div').find('.err_curr_date_started').eq(cloneIndex-1).html('Please select started date.');  
         $('.clone_curr_div').find('.err_curr_date_started').eq(cloneIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(curr_number)=="")
      {

         $('.clone_curr_div').find('.err_curr_number').eq(cloneIndex-1).fadeIn();
         $('.clone_curr_div').find('.err_curr_number').eq(cloneIndex-1).html('Please select number.');  
         $('.clone_curr_div').find('.err_curr_number').eq(cloneIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(curr_frequency)=="")
      {

         $('.clone_curr_div').find('.err_curr_frequency').eq(cloneIndex-1).fadeIn();
         $('.clone_curr_div').find('.err_curr_frequency').eq(cloneIndex-1).html('Please select frequency.');  
         $('.clone_curr_div').find('.err_curr_frequency').eq(cloneIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(curr_use)=="")
      {

         $('.clone_curr_div').find('.err_curr_use').eq(cloneIndex-1).fadeIn();
         $('.clone_curr_div').find('.err_curr_use').eq(cloneIndex-1).html('Please enter use.');  
         $('.clone_curr_div').find('.err_curr_use').eq(cloneIndex-1).fadeOut(4000);
         return false;
      }*/


      content  = '<div class="current-medic clone_curr_div" id="clone_curr_div'+(cloneIndex+1)+'">';
      content += '<div class="remove_curr_medication" id="removecurrdiv'+(cloneIndex+1)+'">'; 
      content += '<div class="col-div">';
      content += '<div class="pharma-in">';
      content += ' <input type="text" class="form-inputs curr_medication_name" name="curr_medication_name[]" value="" id="curr_medication_name'+cloneIndex+'" placeholder="Medication Name">';
      content += '</div>';
      content += '<div class="err err_curr_medication_name" id="err_curr_medication_name"></div>';
      content += '</div>';
      content += '<div class="don-load">';
      content += '<div class="fileUpload attached-block">';
      content += '<span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>';
      content += '<input class="upload" name="curr_precription_file[]" id="curr_precription_file" type="file"/>';
      content += '<div class="err err_curr_precription_file" id="err_curr_precription_file"></div>';
      content += '</div>&nbsp;</div>';
      content += '<div class="don-load don-load1">';
      content += '&nbsp;';
      content += '</div>';
      content += '<div class="col-div cal-in">';
      content += '<input type="text" class="form-inputs datepicker" name="curr_date_started[]" id="curr_date_started'+cloneIndex+'" placeholder="Date Started" />';
      content += '<span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>';
      content += '<div class="err err_curr_date_started" id="err_curr_date_started"></div>';
      content += '</div>&nbsp;';
      content += '<div class="col-div num-drp">';
      content += '<div class="pharma-in">';
      content += '<div class="select-style">';
      content += '<select class="frm-select" name="curr_number[]" id="curr_number">';
      content += '<option value="">Number</option>';
      <?php for($i=1;$i<100;$i++) { ?>
      content += '<option value="{{$i}}">{{$i}}</option>';
      <?php }?>
      content += '</select>';
      content += '</div>';
      content += '</div>';
      content += '<div class="err err_curr_number" id="err_curr_number"></div>';
      content += '</div>';
      content += '<div class="col-div num-drp">';
      content += '<div class="pharma-in">';
      content += '<div class="select-style">';
      content += '<select class="frm-select" name="curr_frequency[]" id="curr_frequency">';
      content += '<option value="">Frequency</option>';
      content += '<option value="Daily">Daily</option>';
      content += '<option value="Weekly">Weekly</option>'
      content += '<option value="Monthly">Monthly</option>';
      content += '</select>';
      content += '</div>';
      content += '</div>';
      content += '<div class="err err_curr_frequency" id="err_curr_frequency"></div>';
      content += '</div>';
      content += '<div class="col-div">';
      content += '<input type="text" class="form-inputs" name="curr_use[]" id="curr_use" placeholder="Use" />';
      content += '<div class="err err_curr_use" id="err_curr_use"></div>';
      content += '</div>';
      content += '<div class="col-div plus-icn-in" id="btns">';
      content += '<a href="javascript:void(0);" onclick="removecurrentmedication('+(cloneIndex+1)+')"> <i class="fa fa-minus-square"></i></a>';
      content += '</div></div></div>';
           
      $('div.append_curr_medication').append(content).find('#curr_date_started'+cloneIndex).datepicker();     
      $('.curr_medication_name').each(function (i) {
          var ac_new_invoice = (function (i) {
              return {
                minLength:3,
                source:"{{url('/')}}/patient/medicalhistory/medication_listing",
                search: function () {
                 },
                 response: function () {
                },
                select:function(event,ui)
                {
                   
                }
              };
          })(i);
      $(this).autocomplete(ac_new_invoice);
  });
    cloneIndex++  ;

}




/*======================Past Medication==========================*/
  var regex = /^(.+?)(\d+)$/i;
  var clonepastIndex = $(".clone_past_div").length;

  function addPastMedication()
  {

      var content = '';
      var past_medication_name =  $("input[name='past_medication_name[]']:last").val();
      var past_date_started    =  $("input[name='past_date_started[]']:last").val();
      var past_precription_file=  $("input[name='past_precription_file[]']:last").val();
      var past_ext             =  past_precription_file.split('.').pop();
      var old_past_precription=  $("input[name='old_past_precription_file[]']:last").length;
      var past_number          =  $("select[name='past_number[]']:last").val();
      var past_frequency       =  $("select[name='past_frequency[]']:last").val();
      var past_use             =  $("input[name='past_use[]']:last").val();


     /* if($.trim(past_medication_name)=="")
      {
         
         $('.clone_past_div').find('.err_past_medication_name').eq(clonepastIndex-1).fadeIn('fast');
         $('.clone_past_div').find('.err_past_medication_name').eq(clonepastIndex-1).html('Please select medication name.');  
         $('.clone_past_div').find('.err_past_medication_name').eq(clonepastIndex-1).fadeOut(4000);
         return false;
      }
    
      else if($.trim(past_date_started)=="")
      {

         $('.clone_past_div').find('.err_past_date_started').eq(clonepastIndex-1).fadeIn('fast');
         $('.clone_past_div').find('.err_past_date_started').eq(clonepastIndex-1).html('Please select started date.');  
         $('.clone_past_div').find('.err_past_date_started').eq(clonepastIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(past_number)=="")
      {

         $('.clone_past_div').find('.err_past_number').eq(clonepastIndex-1).fadeIn();
         $('.clone_past_div').find('.err_past_number').eq(clonepastIndex-1).html('Please select number.');  
         $('.clone_past_div').find('.err_past_number').eq(clonepastIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(past_frequency)=="")
      {

         $('.clone_past_div').find('.err_past_frequency').eq(clonepastIndex-1).fadeIn();
         $('.clone_past_div').find('.err_past_frequency').eq(clonepastIndex-1).html('Please select frequency.');  
         $('.clone_past_div').find('.err_past_frequency').eq(clonepastIndex-1).fadeOut(4000);
         return false;
      }
      else if($.trim(past_use)=="")
      {

         $('.clone_past_div').find('.err_past_use').eq(clonepastIndex-1).fadeIn();
         $('.clone_past_div').find('.err_past_use').eq(clonepastIndex-1).html('Please enter use.');  
         $('.clone_past_div').find('.err_past_use').eq(clonepastIndex-1).fadeOut(4000);
         return false;
      }*/

      content  = '<div class="current-medic clone_past_div" id="clone_past_div'+(clonepastIndex+1)+'">';
      content += ' <div class="remove_curr_medication" id="removepastdiv'+(clonepastIndex+1)+'">';
      content += '<div class="col-div">';
      content += '<div class="pharma-in">';
      content += ' <input type="text" class="form-inputs past_medication_name" name="past_medication_name[]" value="" id="past_medication_name'+clonepastIndex+'">';
      content += '</div>';
      content += '<div class="err err_past_medication_name" id="err_past_medication_name"></div>';
      content += '</div>';
      content += '<div class="don-load">';
      content += '<div class="fileUpload attached-block">';
      content += '<span><img src="{{url('/')}}/public/images/purple-download.png" alt=""/> </span>';
      content += '<input class="upload" name="past_precription_file[]" id="past_precription_file" type="file"/>';
      content += '<div class="err err_past_precription_file" id="err_past_precription_file"></div>';
      content += '</div>&nbsp;</div>';
        content += '<div class="don-load don-load1">';
      content += '&nbsp;';
      content += '</div>';
      content += '<div class="col-div cal-in">';
      content += '<input type="text" class="form-inputs datepicker" name="past_date_started[]" id="past_date_started'+clonepastIndex+'" placeholder="Date Started" />';
      content += '<span><img src="{{url('/')}}/public/images/cal-icon.png" alt=""/> </span>';
      content += '<div class="err err_past_date_started" id="err_past_date_started"></div>';
      content += '</div>&nbsp;';
      content += '<div class="col-div num-drp">';
      content += '<div class="pharma-in">';
      content += '<div class="select-style">';
      content += '<select class="frm-select" name="past_number[]" id="past_number">';
      content += '<option value="">Number</option>';
      <?php for($i=1;$i<100;$i++) { ?>
      content += '<option value="{{$i}}">{{$i}}</option>';
      <?php }?>
      content += '</select>';
      content += '</div>';
      content += '</div>';
      content += '<div class="err err_past_number" id="err_past_number"></div>';
      content += '</div>';
      content += '<div class="col-div num-drp">';
      content += '<div class="pharma-in">';
      content += '<div class="select-style">';
      content += '<select class="frm-select" name="past_frequency[]" id="past_frequency">';
      content += '<option value="">Frequency</option>';
      content += '<option value="Daily">Daily</option>';
      content += '<option value="Weekly">Weekly</option>'
      content += '<option value="Monthly">Monthly</option>';
      content += '</select>';
      content += '</div>';
      content += '</div>';
      content += '<div class="err err_past_frequency" id="err_past_frequency"></div>';
      content += '</div>';
      content += '<div class="col-div">';
      content += '<input type="text" class="form-inputs" name="past_use[]" id="past_use" placeholder="Use" />';
      content += '<div class="err err_past_use" id="err_past_use"></div>';
      content += '</div>';
      content += '<div class="col-div plus-icn-in">';
      content += '<a href="javascript:void(0);" onclick="removepastmedication('+(clonepastIndex+1)+')"> <i class="fa fa-minus-square"></i></a>';
      content += '</div>';
      content += '</div></div>';

      $('div.append_past_medication').append(content).find('#past_date_started'+clonepastIndex).datepicker();     
      $('.past_medication_name').each(function (i) {
          var ac_new_invoice = (function (i) {
              return {
                minLength:3,
                source:"{{url('/')}}/patient/medicalhistory/medication_listing",
                search: function () {
                     
                 },
                 response: function () {
                   
                },
                select:function(event,ui)
                {
                   
                }
              };
          })(i);
        $(this).autocomplete(ac_new_invoice);
      });
      clonepastIndex++;
}

   

function removecurrentmedication(ref)
{ 
    
    if(cloneIndex>1)
    {

        $('#removecurrdiv'+ref).remove();     
        cloneIndex--;
    }  
      
}

function removepastmedication(ref)
{

   if(clonepastIndex>1) 
   { 

      $('#removepastdiv'+ref).remove();   
      clonepastIndex--; 
   }   
}

function savemedicalhistory()
{
  
    /*=================Current Medication==================================*/
/*
    var arr_curr_medication     = $("input[name^='curr_medication_name']");
    flag=1;
    $.each(arr_curr_medication, function (index,svalue)  
    {   

          var value = $(this).val();
       
          if($.trim(value) == "")
          {

              $('.err_curr_medication_name').eq(index).fadeIn('fast');
              $('.err_curr_medication_name').eq(index).html('Please select medication name.');
              $('.err_curr_medication_name').eq(index).fadeOut(4000);
              flag=0;
          } 

    });


    var arr_curr_date_started   = $("input[name^='curr_date_started']");
    $.each(arr_curr_date_started, function (index,svalue)  
    {   
     
          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_curr_date_started').eq(index).fadeIn('fast');
              $('.err_curr_date_started').eq(index).html('Please select started date.');
              $('.err_curr_date_started').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_curr_number   = $("select[name^='curr_number']");
    $.each(arr_curr_number, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_curr_number').eq(index).fadeIn('fast');
              $('.err_curr_number').eq(index).html('Please select number.');
              $('.err_curr_number').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_curr_frequency   = $("select[name^='curr_frequency']");
    $.each(arr_curr_frequency, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_curr_frequency').eq(index).fadeIn('fast');
              $('.err_curr_frequency').eq(index).html('Please select frequency.');
              $('.err_curr_frequency').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_curr_use   = $("input[name^='curr_use']");
    $.each(arr_curr_use, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_curr_use').eq(index).fadeIn('fast');
              $('.err_curr_use').eq(index).html('Please enter use.');
              $('.err_curr_use').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); */

   /*=====================Past Medication =====================================*/ 

 /*   var arr_past_medication     = $("input[name^='past_medication_name']");
    
    $.each(arr_past_medication, function (index,svalue)  
    {   

          var value = $(this).val();
        
          if($.trim(value) == "")
          {

              $('.err_past_medication_name').eq(index).fadeIn('fast');
              $('.err_past_medication_name').eq(index).html('Please select medication name.');
              $('.err_past_medication_name').eq(index).fadeOut(4000);
              flag=0;
          } 

    });

 
    var arr_past_date_started   = $("input[name^='past_date_started']");
    $.each(arr_past_date_started, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_past_date_started').eq(index).fadeIn('fast');
              $('.err_past_date_started').eq(index).html('Please select started date.');
              $('.err_past_date_started').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_past_number   = $("select[name^='past_number']");
    $.each(arr_past_number, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_past_number').eq(index).fadeIn('fast');
              $('.err_past_number').eq(index).html('Please select number.');
              $('.err_past_number').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_past_frequency   = $("select[name^='past_frequency']");
    $.each(arr_past_frequency, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_past_frequency').eq(index).fadeIn('fast');
              $('.err_past_frequency').eq(index).html('Please select frequency.');
              $('.err_past_frequency').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 

    var arr_past_use   = $("input[name^='past_use']");
    $.each(arr_past_use, function (index,svalue)  
    {   

          var value = $(this).val();
          
          if($.trim(value)=="") 
          {

              $('.err_past_use').eq(index).fadeIn('fast');
              $('.err_past_use').eq(index).html('Please enter use.');
              $('.err_past_use').eq(index).fadeOut(4000);
              flag=0;
          } 

    }); 
    */
   /* if(flag==0)
    {

       return false;
    }
    else if(flag==1)
    {
      $('form#frm_step_one').submit();
      return true;
    }
*/
    $('form#frm_step_one').submit();
      return true;
  
}

</script>
@stop
