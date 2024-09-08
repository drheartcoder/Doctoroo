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
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Time
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="time" id="time" placeholder="Time" value="{{isset($arr_data['time'])?$arr_data['time']:''}}" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_time" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Day
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="day" id="day" value="{{isset($arr_data['day'])?$arr_data['day']:''}}"  placeholder="Day" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_day" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Day Hourly Rate
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="day_hourly_rate" id="day_hourly_rate" value="{{isset($arr_data['day_hourly_rate'])?$arr_data['day_hourly_rate']:''}}"  placeholder="Day Hourly Rate" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_day_hourly_rate" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Night
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="night" id="night" value="{{isset($arr_data['night'])?$arr_data['night']:''}}"  placeholder="Night" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_night" style="color:red;"></span>
                  </div>
               </div>
               <div class="clearfix"></div>
                     <br/>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Night Hourly Rate
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-5 controls">
                     <input type="text" name="night_hourly_rate" id="night_hourly_rate" value="{{isset($arr_data['night_hourly_rate'])?$arr_data['night_hourly_rate']:''}}"  placeholder="Night Hourly Rate" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_night_hourly_rate" style="color:red;"></span>
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
      
       var time               = document.forms["Form"]["time"].value;
       var day                = document.forms["Form"]["day"].value;
       var day_hourly_rate    = document.forms["Form"]["day_hourly_rate"].value;
       var night              = document.forms["Form"]["night"].value;
       var night_hourly_rate  = document.forms["Form"]["night_hourly_rate"].value;

       /*setTimeout(function()
     {
       document.getElementById('err_processing').innerHTML="";
       document.getElementById('err_consultation').innerHTML="";
       document.getElementById('err_pharmacy').innerHTML="";
       document.getElementById('err_refund').innerHTML="";
       document.getElementById('err_Refund').innerHTML="";
     },2000); */
   
       if(time=="")
       {
          document.getElementById('err_time').innerHTML="Please Enter Time"; 
           return false;
       }
       if(day=="")
       {
          document.getElementById('err_day').innerHTML="Please Enter Day"; 
           return false;
       }
       if(day_hourly_rate=="")
       {
          document.getElementById('err_day_hourly_rate').innerHTML="Please Enter Day Hourly Rate"; 
           return false;
       }
       if(night=="")
       {
          document.getElementById('err_night').innerHTML="Please Enter Night"; 
           return false;
       }
       if(night_hourly_rate=="")
       {
          document.getElementById('err_night_hourly_rate').innerHTML="Please Enter Night Hourly Rate"; 
           return false;
       }
     }
</script>
@stop