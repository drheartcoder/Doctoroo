@extends('admin.layout.master')
@section('main_content')
<!-- BEGIN Page Title -->
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
      <i class="fa fa-desktop"></i>
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
      </span> 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
      </span>
      <li class="active">{{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3>
               <i class="fa fa-text-width"></i>
               {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
               <a data-action="collapse" href="#"></a>
               <a data-action="close" href="#"></a>
            </div>
         </div>
         <div class="box-content"> 
            
            @include('admin.layout._operation_status') 
            
            <form method="post" action="{{url($module_url_path.'/update/'.$enc_id)}}"  onsubmit="return validateForm()" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
               <br>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Consultation Time From
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="consultation_time_from" id="consultation_time_from" placeholder="Consultation Time From" value="{{isset($arr_data['consultation_time_from'])?$arr_data['consultation_time_from']:''}}" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_consultfrom" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Consultation Time To
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="consultation_time_to" id="consultation_time_to" value="{{isset($arr_data['consultation_time_to'])?$arr_data['consultation_time_to']:''}}"  placeholder="Consultation Time From" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_consultto" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Patient Day Cost
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="patient_day_cost" id="patient_day_cost" value="{{isset($arr_data['patient_day_cost'])?$arr_data['patient_day_cost']:''}}"  placeholder="Patient Day Cost" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_patientdaycost" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Doctor Day Fee
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="doctor_day_fee" id="doctor_day_fee" value="{{isset($arr_data['doctor_day_fee'])?$arr_data['doctor_day_fee']:''}}"  placeholder="Doctor Day Fee" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_doctordayfee" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Day Profit
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="day_profit" id="day_profit" value="{{isset($arr_data['day_profit'])?$arr_data['day_profit']:''}}"  placeholder="Day Profit" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_dayprofit" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Patient Night Cost
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="patient_night_cost" id="patient_night_cost" value="{{isset($arr_data['patient_night_cost'])?$arr_data['patient_night_cost']:''}}"  placeholder="Patient Night Cost" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_patientnightcost" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Doctor Night Fee
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="doctor_night_fee" id="doctor_night_fee" value="{{isset($arr_data['doctor_night_fee'])?$arr_data['doctor_night_fee']:''}}"  placeholder="Doctor Night Fee" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_doctornightfee" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Night Profit
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="night_profit" id="night_profit" value="{{isset($arr_data['night_profit'])?$arr_data['night_profit']:''}}"  placeholder="Night Profit" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_nightprofit" style="color:red;"></span>
                  </div>
               </div>
             <div class="clearfix"></div>
                     <br/>
             
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-4">
                     <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
                  </div>
               </div>
            </form>
         
      </div>
      </div>
   </div>

<script>
   function validateForm()
     { 
      
       var consultation_time_from     = document.forms["Form"]["consultation_time_from"].value;
       var consultation_time_to       = document.forms["Form"]["consultation_time_to"].value;
       var patient_day_cost           = document.forms["Form"]["patient_day_cost"].value;
       var doctor_day_fee             = document.forms["Form"]["doctor_day_fee"].value;
       var day_profit                 = document.forms["Form"]["day_profit"].value;
       var patient_night_cost         = document.forms["Form"]["patient_night_cost"].value;
       var night_profit               = document.forms["Form"]["night_profit"].value;
       /*var night_profit                 = document.forms["Form"]["night_profit"].value;*/
       /*setTimeout(function()
     {
       document.getElementById('err_processing').innerHTML="";
       document.getElementById('err_consultation').innerHTML="";
       document.getElementById('err_pharmacy').innerHTML="";
       document.getElementById('err_refund').innerHTML="";
       document.getElementById('err_Refund').innerHTML="";
      
     },2000); */
   
       if(consultation_time_from=="")
       {
          document.getElementById('err_consultfrom').innerHTML="Please Enter Consultation Time From"; 
           return false;
       }
       if(consultation_time_to=="")
       {
          document.getElementById('err_consultto').innerHTML="Please Enter Consultation Time To"; 
           return false;
       }
       if(patient_day_cost=="")
       {
          document.getElementById('err_patientdaycost').innerHTML="Please Enter Patient Day Cost "; 
           return false;
       }
       if(doctor_day_fee=="")
       {
          document.getElementById('err_doctordayfee').innerHTML="Please Enter Doctor Day Fee"; 
           return false;
       }
       if(day_profit=="")
       {
          document.getElementById('err_dayprofit').innerHTML="Please Enter Day Profit"; 
           return false;
       }
       if(patient_night_cost=="")
       {
          document.getElementById('err_patientnightcost').innerHTML="Please Enter Patient Night Cost"; 
           return false;
       }
       if(doctor_night_fee=="")
       {
          document.getElementById('err_doctornightfee').innerHTML="Please Enter Doctor Night Fee"; 
           return false;
       }
       if(night_profit=="")
       {
          document.getElementById('err_nightprofit').innerHTML="Please Enter Night Profit"; 
           return false;
       }
   
     }
</script>
@stop