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
      <li><a href="{{ url($admin_panel_slug.'/patient') }}">Manage Patient</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i>Medical History</h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <div class="box-content">
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Patient Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                        @if(isset($data_history['patient_details']['userinfo']['title']))
                           {{($data_history['patient_details']['userinfo']['title'])?$data_history['patient_details']['userinfo']['title']:'NA'}} &nbsp;&nbsp;{{isset($data_history['patient_details']['userinfo']['first_name'])?$data_history['patient_details']['userinfo']['first_name']:'NA'}}&nbsp;&nbsp;{{isset($data_history['patient_details']['userinfo']['last_name'])?$data_history['patient_details']['userinfo']['last_name']:'NA'}}
                        @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Gender</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['patient_details']['gender']) && $data_history['patient_details']['gender']=="M")
                           Male
                           @elseif(isset($data_history['patient_details']['gender']) && $data_history['patient_details']['gender']=="F")
                           Female
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_history['patient_details']['userinfo']['email'])?$data_history['patient_details']['userinfo']['email']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Date of Birth</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_history['patient_details']['date_of_birth'])? date('d-M-Y',strtotime($data_history['patient_details']['date_of_birth'])):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['patient_details']['mobile_no']) && $data_history['patient_details']['mobile_no']!="")
                           {{$data_history['patient_details']['mobile_no']}}
                           @else
                           <?php echo"NA";?>
                           @endif  
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Family Member Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                           {{$data_family['first_name']}}
                           @else
                           <?php echo"NA";?>
                           @endif  
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
         </div>
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Health Issue</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_history['health_issue'])?$data_history['health_issue']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Current/Past Illnesses and Conditions.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($illness_str) && $illness_str!="")
                        {{$illness_str}}
                        @else
                        <?php echo"NA";?>
                        @endif  

                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Any Other Current/Past Medical Treatment.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['current_past_treatment']) && $data_history['current_past_treatment']!="")
                           {{isset($data_history['current_past_treatment'])?$data_history['current_past_treatment']:'NA'}}
                           @else
                         <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     
                     @if(isset($arr_curr_medicalhistory) && sizeof($arr_curr_medicalhistory)>0)
                     @foreach($arr_curr_medicalhistory as $medical_history)
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Current Medications Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['medication_name'])&& $medical_history['medication_name']!="")
                           {{ isset($medical_history['medication_name'])?$medical_history['medication_name']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Date Started</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php $date = ''; ?>
                           @if(isset($medical_history['date_started']) && $medical_history['date_started']!='')
                           <?php $date = date('d M,Y',strtotime($medical_history['date_started']))  ?>
                           @endif
                           @if($date!="01 Jan,1970")
                           {{ $date }}
                           @else
                           {{ 'NA' }}
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Number Taken</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['m_number'])&& $medical_history['m_number']!="")
                           {{ isset($medical_history['m_number'])?$medical_history['m_number']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Frequency</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['frequency'])&& $medical_history['frequency']!="")
                           {{isset ($medical_history['frequency'])?$medical_history['frequency']:'NA' }}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Medication use</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php $medicine_use = ''; ?>
                           @if(isset($medical_history['m_use']))
                           @if(strlen($medical_history['m_use'])>60)
                           <?php  $medicine_use = str_limit($medical_history['m_use'],60); ?>
                           @else
                           <?php $medicine_use = $medical_history['m_use']; ?>
                           @endif
                           @endif
                           {{ ($medicine_use)?$medicine_use:'NA' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     @endforeach
                     @else
                     <div class="alert alert-info alert-dismissible" role="alert" align="center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sorry!</strong> Currently,no medication present.
                     </div>
                     @endif
                     <div class="clearfix"></div>
                     <br/>
                     @if(isset($arr_past_medicalhistory) && sizeof($arr_past_medicalhistory)>0)
                     @foreach($arr_past_medicalhistory as $medical_history)
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Past Medications Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['medication_name'])&& $medical_history['medication_name']!="")
                           {{isset($medical_history['medication_name'])?$medical_history['medication_name']:'NA' }}
                           @else
                        <?php echo"NA";?>
                        @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Date Started</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['date_started']) && $medical_history['date_started']!='')
                           <?php 
                              $date = '';
                              $date = date('d M,Y',strtotime($medical_history['date_started']))  
                              ?>
                           @endif
                           @if($date!="01 Jan,1970")
                           {{ $date }}
                           @else
                           {{ 'NA' }}
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Number Taken</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['m_number'])&& $medical_history['m_number']!="")
                           {{ isset($medical_history['m_number'])?$medical_history['m_number']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Frequency</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_history['frequency'])&& $medical_history['frequency']!="")
                           {{ isset($medical_history['frequency'])?$medical_history['frequency']:'NA' }}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Medication use</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php $medicine_use = ''; ?>
                           @if(isset($medical_history['m_use']))
                           @if(strlen($medical_history['m_use'])>60)
                           <?php  $medicine_use = str_limit($medical_history['m_use'],60); ?>
                           @else
                           <?php  $medicine_use = $medical_history['m_use']; ?>
                           @endif
                           @endif
                           {{ ($medicine_use)?$medicine_use:'NA' }}
                        </div>
                     </div>
                     @endforeach
                     @else
                     <div class="alert alert-info alert-dismissible" role="alert" align="center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sorry!</strong> Currently,Past medication are not present.
                     </div>
                     @endif
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Daily Sleep</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['daily_sleep'])&& $data_history['daily_sleep']!="")
                           {{isset($data_history['daily_sleep'])?$data_history['daily_sleep']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Smoking</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['smoking_status'])&& $data_history['smoking_status']!="")
                           {{isset($data_history['smoking_status'])&&$data_history['smoking_status']!=""?:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Diet</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['diet_pattern'])&& $data_history['diet_pattern']!="")
                           {{isset($data_history['diet_pattern'])?$data_history['diet_pattern']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Diet Other</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['diet_other'])&& $data_history['diet_other']!="")
                           {{isset($data_history['diet_other'])?$data_history['diet_other']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Recreational drug use </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['recreational_drug_use'])&& $data_history['recreational_drug_use']!="")
                           {{isset($data_history['recreational_drug_use'])?$data_history['recreational_drug_use']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Exercise</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['excersice'])&& $data_history['excersice']!="")
                           {{isset($data_history['excersice'])?$data_history['excersice']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Alcohol</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['alcohol'])&& $data_history['alcohol']!="")
                           {{isset($data_history['alcohol'])?$data_history['alcohol']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Stress Levels</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['stress_level'])&& $data_history['stress_level']!="")
                           {{isset($data_history['stress_level'])?$data_history['stress_level']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Marital Status</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['marital_status'])&& $data_history['marital_status']!="")
                           {{isset($data_history['marital_status'])?$data_history['marital_status']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Sytolic Value (mmhg) </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['sytolic_value'])&& $data_history['sytolic_value']!="")
                           {{isset($data_history['sytolic_value'])?$data_history['sytolic_value']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Pulse Value (bpm) </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['pluse_value'])&& $data_history['pluse_value']!="")
                           {{isset($data_history['pluse_value'])?$data_history['pluse_value']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Time</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['time'])&& $data_history['time']!="")
                           {{isset($data_history['time'])?$data_history['time']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Diastolic Value (mmhg)</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['diastolic_value'])&& $data_history['diastolic_value']!="")
                           {{isset($data_history['diastolic_value'])?$data_history['diastolic_value']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Measure Date</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                         @if(isset($data_history['measure_date'])&& $data_history['measure_date']!="")
                           {{isset($data_history['measure_date'])?date('d-M-Y',strtotime($data_history['measure_date'])):'NA'}}
                           @else
                           <?php echo"NA"; ?>
                           @endif

                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Blood Sugar Value </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['blood_sugar_value'])&& $data_history['blood_sugar_value']!="")
                           {{isset($data_history['blood_sugar_value'])?$data_history['blood_sugar_value']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Meal</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['meal'])&& $data_history['meal']!="")
                           {{isset($data_history['meal'])?$data_history['meal']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Blood Sugar Date Started  </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['blood_sugar_measure_date'])&& $data_history['blood_sugar_measure_date']!="")
                           {{isset($data_history['blood_sugar_measure_date'])?date('d-M-Y',strtotime($data_history['blood_sugar_measure_date'])):'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Time </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          @if(isset($data_history['blood_sugar_time'])&& $data_history['blood_sugar_time']!="")
                           {{isset($data_history['blood_sugar_time'])?$data_history['blood_sugar_time']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Medical History Of @if(isset($data_family['first_name']) && $data_family['first_name']!="")
                        {{$data_family['first_name']}}
                        @else
                        <?php echo"NA";?>
                        @endif  
                     </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Allergies </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['allergies'])&& $data_history['allergies']!="")
                           {{isset($data_history['allergies'])?$data_history['allergies']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Surgeries and Procedures  </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['surgeries_and_procedures'])&& $data_history['surgeries_and_procedures']!="")
                           {{isset($data_history['surgeries_and_procedures'])?$data_history['surgeries_and_procedures']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Obstetrics </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['obstetrics'])&& $data_history['obstetrics']!="")
                           {{isset($data_history['obstetrics'])?$data_history['obstetrics']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Complications </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['complication'])&& $data_history['complications']!="")
                           {{isset($data_history['complications'])?$data_history['complications']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Family History </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['family_history'])&& $data_history['family_history']!="")
                           {{isset($data_history['family_history'])?$data_history['family_history']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Any Genetic Diseases</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['any_genetic_diseases'])&& $data_history['any_genetic_diseases']!="")
                           {{isset($data_history['any_genetic_diseases'])?$data_history['any_genetic_diseases']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Other  </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_history['other'])&& $data_history['other']!="")
                           {{isset($data_history['other'])?$data_history['other']:'NA'}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@stop

