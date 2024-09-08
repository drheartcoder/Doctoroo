@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
</style>
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li><a href="{{ url($admin_panel_slug.'/consultation') }}">Consultation </a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($module_title)?$module_title:"Consultation"}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($module_title)?$module_title:"Patient Details" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      @if(count($arr_consultation_data)>0)
      @php $data = $arr_consultation_data; @endphp
      <div class="box-content">
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Patient Details</h3>
                  </div>
                  
                  <div class="box-content">
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Patient Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data['patient_user_details']['first_name'], $data['patient_user_details']['last_name'])?ucfirst($data['patient_user_details']['first_name']).' '.ucfirst($data['patient_user_details']['last_name']):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                      
                     <!-- <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Patient Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if($data['family_member_id'] != '0')
                           {{isset($data['familiy_member_info']['first_name'], $data['familiy_member_info']['last_name'])?ucfirst($data['familiy_member_info']['first_name']).' '.ucfirst($data['familiy_member_info']['last_name']):''}}
                           @elseif($data['family_member_id'] == '0')
                           {{ 'Self' }}
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> -->

                     @if($data['family_member_id'] != '0')
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Relationship</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                            @if($data['family_member_id'] != '0')
                           {{isset($data['familiy_member_info']['first_name'], $data['familiy_member_info']['last_name'])?ucfirst($data['familiy_member_info']['first_name']).' '.ucfirst($data['familiy_member_info']['last_name']):'NA'}}
                           @elseif($data['family_member_id'] == '0')
                           {{ 'Self' }}
                           @endif
                           {{isset($data['familiy_member_info']['relationship'])?'('.ucfirst($data['familiy_member_info']['relationship']).')':'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     @endif

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Signup Type</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data['patient_info']['type']) && $data['patient_info']['type'] == 'doctoroo' ? 'Doctoroo' : ''}}
                           {{isset($data['patient_info']['type']) && $data['patient_info']['type'] == 'myown' ? 'My Own' : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Consultation Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>

                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Consultation Id</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                       {{($data['consultation_id'])? $data['consultation_id']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Doctor</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data['doctor_user_details']['first_name'], $data['doctor_user_details']['last_name'])?'Dr. '.ucfirst($data['doctor_user_details']['first_name']).' '.ucfirst($data['doctor_user_details']['last_name']):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label"> Consultation For</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="info_consultation_for"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Symptoms</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="info_symptoms"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     
                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Consultation Time</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                       <?php $consult_datetime = convert_utc_to_userdatetime(1, "admin", $data['consultation_datetime']); ?>
                       {{($consult_datetime)? date("h:i a",strtotime($consult_datetime)):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Consultation Date</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php $consult_datetime = convert_utc_to_userdatetime(1, "admin", $data['consultation_datetime']); ?>
                           {{($consult_datetime)? date('d-M-Y',strtotime($consult_datetime)):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>


                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Booking Status</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data['booking_status'])&& $data['booking_status']!="")
                           {{isset($data['booking_status'])?ucfirst($data['booking_status']):'NA'}}
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>


                     @if($data['booking_status'] == 'Cancelled')

                     @foreach($data['booking_status_data'] as $cancel_data)
                      @if($cancel_data['status'] == 'Cancelled')
                        <div class="form-group">
                            <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Cancelled by</label>
                            <div class="col-sm-3 col-lg-2">:</div>
                            <div class="col-sm-9 col-lg-5 controls">

                               @if($cancel_data['performed_by'] == $data['patient_user_details']['id'])

                               {{isset($data['patient_user_details']['first_name'], $data['patient_user_details']['last_name'])?ucfirst($data['patient_user_details']['first_name']).' '.ucfirst($data['patient_user_details']['last_name']):'NA'}}

                               @elseif($cancel_data['performed_by'] == $data['doctor_user_details']['id'])

                               {{isset($data['doctor_user_details']['first_name'], $data['doctor_user_details']['last_name'])?'Dr. '.ucfirst($data['doctor_user_details']['first_name']).' '.ucfirst($data['doctor_user_details']['last_name']):'NA'}}

                               @endif

                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <br/>

                         <div class="form-group">
                            <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Cancelled reason</label>
                            <div class="col-sm-3 col-lg-2">:</div>
                            <div class="col-sm-9 col-lg-5 controls">
                               {{$cancel_data['comment']}}
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <br/>
                      @endif
                     @endforeach

                     @endif

                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Payment Details </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Charge</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-3 col-lg-5 controls">
                          @if(isset($data['consultation_charge'])&& $data['consultation_charge']!="")
                           $ {{isset($data['consultation_charge'])?$data['consultation_charge']:'NA'}}
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Paid By</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-3 col-lg-5 controls">
                          @if(Isset($data['card_paid_by'])&& $data['card_paid_by']!="")
                           {{isset($data['card_paid_by'])?ucfirst($data['card_paid_by']):'NA'}}
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                  </div>
               </div>
            </div>
            <!-- <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Card Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Name</label>
                        <div class="col-sm-3 col-lg-1">:</div>
                        <div class="col-sm-3 col-lg-8 controls">
                           @if(isset($data['card_name'])&& $data['card_name']!="")
                           {{isset($data['card_name'])?ucfirst($data['card_name']):'NA'}}
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Number</label>
                        <div class="col-sm-3 col-lg-1">:</div>
                        <div class="col-sm-3 col-lg-8 controls">
                           @if(isset($data['card_number'])&& $data['card_number']!="")
                           {{isset($data['card_number'])?$data['card_number']:'NA'}}
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Card Expiry Date</label>
                        <div class="col-sm-3 col-lg-1">:</div>
                        <div class="col-sm-3 col-lg-8 controls">
                           {{isset($data['card_exp_month'], $data['card_exp_year'])?$data['card_exp_month'].'/'.$data['card_exp_year']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     {{-- <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Card Expiry Year</label>
                        <div class="col-sm-3 col-lg-1">:</div>
                        <div class="col-sm-9 col-lg-8 controls">
                           {{isset($data['card_exp_year'])?$data['card_exp_year']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> --}}
                  </div>
               </div>
            </div> -->
            <div class="clearfix"></div>
            <br/>
         
         </div>
      </div>
      @endif
   </div>
</div>

 @if($data['consultation_for']!='')
 <?php
       $arr_consult = [];
       $arr_consult = explode(',',$data['consultation_for']);
 ?>
  <script type="text/javascript">
  var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
  var api           = virgil.API(virgilToken);
  
  var dumpSessionId    = '{{isset($data["patient_user_details"]["dump_session"])?$data["patient_user_details"]["dump_session"]:""}}';
  var dumpId           = '{{isset($data["patient_user_details"]["dump_id"])?$data["patient_user_details"]["dump_id"]:""}}';
  var symptoms         = "{{ isset($data['symptoms']) && !empty($data['symptoms']) ? $data['symptoms'] : '' }}"; 
  var str_consultation_for = trim_str_consultation_for = '';
   <?php 
   if(count($arr_consult)>0)
   {
      foreach($arr_consult as $_key => $val)
      {
          if($val!='')
          {
   ?>
                if(dumpSessionId!='')
                {
                  var consultation_for = '{{$val}}';
                  var key              = api.keys.import(dumpSessionId);
                  if(consultation_for!='')
                  {
                    var dec_consultation_for     = decrypt(api, consultation_for, key);
                    
                    if(dec_consultation_for == 'advice_and_treatment'){
                      dec_consultation_for = ' Advice & Treatment,';
                    }
                    if(dec_consultation_for == 'prescriptions_and_repeats'){
                      dec_consultation_for = ' Prescription or Repeat,';
                    }
                    if(dec_consultation_for == 'medical_cetificate'){
                      dec_consultation_for = ' Medical Certificate,';
                    }
                    if(dec_consultation_for == 'other'){
                      dec_consultation_for = ' Other,';
                    }

                    str_consultation_for += dec_consultation_for;
                    trim_str_consultation_for = str_consultation_for.replace(/(^,)|(,$)/g, "")
                  }
                }
   <?php
          }
      }
   }
   ?>

   if(symptoms != '' && symptoms != null)
   {
      var dec_symptoms = decrypt(api, symptoms, key);
      $('#info_symptoms').html(dec_symptoms);
   }

    $('#info_consultation_for').html(trim_str_consultation_for);
    function decrypt(api, enctext, key)
    {
        var decrpyttext = key.decrypt(enctext);
        var plaintext = decrpyttext.toString();
        return plaintext;
    }
  </script>
@endif
<!-- END Main Content --> 
@endsection