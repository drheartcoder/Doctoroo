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
            <form method="post" action="{{url($module_url_path.'/edit')}}"  onsubmit="return validateForm()" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Time Interval
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                     <input type="text" name="time_interval" id="time_interval" placeholder="Time Interval" value="{{ isset($time_interval_arr['time_interval']) ? $time_interval_arr['time_interval'] : '' }}" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_time_interval" style="color:red;"></span>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
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
       var time_interval= document.forms["Form"]["time_interval"].value;
       
       setTimeout(function()
       {
         document.getElementById('err_time_interval').innerHTML="";
       },2000); 
   
       if(time_interval=="")
       {
          document.getElementById('err_time_interval').innerHTML="Please Enter Time Interval"; 
          return false;
       }
     }
</script>
@stop