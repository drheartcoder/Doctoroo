@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">

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
            <form method="post" action="{{url($module_url_path.'/plan_price/update')}}"  onsubmit="return validateForm()" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
               
               <div class="col-sm-6 col-lg-6">

               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="monthly_amount">Monthly Amount(in $)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="monthly_amount" id="monthly_amount" value="{{isset($membership_arr['monthly_amount'])? $membership_arr['monthly_amount']:''}}"  placeholder="Monthly Amount" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_monthly_amount" style="color:red;">{{ $errors->first('monthly_amount') }}</span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="monthly_gst">Monthly GST(in %)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="monthly_gst" id="monthly_gst" value="{{isset($membership_arr['monthly_gst'])? $membership_arr['monthly_gst']:''}}"  placeholder="Monthly GST" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_monthly_gst" style="color:red;">{{ $errors->first('monthly_gst') }}</span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="monthly_discount">Monthly Discount(in %)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="monthly_discount" id="monthly_discount" value="{{isset($membership_arr['monthly_discount'])? $membership_arr['monthly_discount']:''}}"  placeholder="Monthly Discount" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_monthly_discount" style="color:red;">{{ $errors->first('monthly_discount') }}</span>
                  </div>
               </div>
               </div>
               <div class="col-sm-6 col-lg-6">
               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="annually_amount">Annually Amount(in $)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="annually_amount" id="annually_amount" value="{{isset($membership_arr['annually_amount'])? $membership_arr['annually_amount']:''}}"  placeholder="Annually Amount" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_annually_amount" style="color:red;">{{ $errors->first('annually_amount') }}</span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="annually_gst">Annually GST(in %)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="annually_gst" id="annually_gst" value="{{isset($membership_arr['annually_gst'])? $membership_arr['annually_gst']:''}}"  placeholder="Annually GST" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_annually_gst" style="color:red;">{{ $errors->first('annually_gst') }}</span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-4 control-label" for="annually_discount">Annually Discount(in %)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-8 controls">
                  
                      <input type="text" name="annually_discount" id="annually_discount" value="{{isset($membership_arr['annually_discount'])? $membership_arr['annually_discount']:''}}"  placeholder="Annually Discount" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_annually_discount" style="color:red;">{{ $errors->first('annually_discount') }}</span>
                  </div>
               </div>
               </div>
               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-10">
                     <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
   function validateForm()
     { 
      
      // var ProcessingFee= document.forms["Form"]["processing_fees"].value;
       var monthly_amount= document.forms["Form"]["monthly_amount"].value;
       var monthly_gst= document.forms["Form"]["monthly_gst"].value;
       var monthly_discount= document.forms["Form"]["monthly_discount"].value;
       var annually_amount= document.forms["Form"]["annually_amount"].value;
       var annually_gst= document.forms["Form"]["annually_gst"].value;
       var annually_discount= document.forms["Form"]["annually_discount"].value;
       
       setTimeout(function()
     {
      // document.getElementById('err_processing').innerHTML="";
       document.getElementById('err_monthly_amount').innerHTML="";
       document.getElementById('err_monthly_gst').innerHTML="";
       document.getElementById('err_monthly_discount').innerHTML="";
       document.getElementById('err_annually_amount').innerHTML="";
       document.getElementById('err_annually_gst').innerHTML="";
       document.getElementById('err_annually_discount').innerHTML="";
      
     },2000); 
   
       /*if(ProcessingFee=="")
       {
          document.getElementById('err_processing').innerHTML="Please Enter Processing Fees"; 
           return false;
       }*/
       if(monthly_amount=="")
       {
          document.getElementById('err_monthly_amount').innerHTML="Please Enter Monthly plan amount"; 
           return false;
       }
       if(monthly_gst=="")
       {
          document.getElementById('err_monthly_gst').innerHTML="Please Enter monthly GST"; 
           return false;
       }
       if(monthly_discount =="")
       {
          document.getElementById('err_monthly_discount').innerHTML="Please Enter monthly plan discount"; 
          return false;
       }
       if(annually_amount =="")
       {
          document.getElementById('err_annually_amount').innerHTML="Please Enter Annually plan amount"; 
          return false;
       }
       if(annually_gst =="")
       {
          document.getElementById('err_annually_gst').innerHTML="Please Enter Annually GST"; 
          return false;
       }
       if(annually_discount =="")
       {
          document.getElementById('err_annually_gst').innerHTML="Please Enter Annually plan discount"; 
          return false;
       }
   
     }

     $(function () {
        $("#monthly_amount, #monthly_gst, #monthly_discount, #annually_amount, #annually_gst, #annually_discount").keydown(function (event) {

            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });

</script>
@stop                    


