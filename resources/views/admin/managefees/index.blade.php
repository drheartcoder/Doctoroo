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
            <form method="post" action="{{url($module_url_path.'/update')}}"  onsubmit="return validateForm()" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
               
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Consultation Fee(in $)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                  
                      <input type="text" name="fees" id="consultation_fees" value="{{isset($arr_data['fee'])? $arr_data['fee']:''}}"  placeholder="Consultation Fee" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     
                     <span id="err_consultation" style="color:red;"></span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Doctoroo Fee(in $)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                      <input type="text" name="doctoroo_fee" id="doctoroo_fee" value="{{isset($arr_data['doctoroo_fee'])? $arr_data['doctoroo_fee']:''}}"  placeholder="Doctoroo Fee" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_doctoroo_fee" style="color:red;"></span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Doctoroo commission(in %)
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                  
                    <input type="text" name="doctoroo_commission" id="doctoroo_commission" value="{{isset($arr_data['doctoroo_commission'])? $arr_data['doctoroo_commission']:''}}"  placeholder="Doctoroo Commission" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span id="err_doctoroo_commission" style="color:red;"></span>
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
      
      // var ProcessingFee= document.forms["Form"]["processing_fees"].value;
       var consultationfees= document.forms["Form"]["consultation_fees"].value;
       var doctoroo_fee= document.forms["Form"]["doctoroo_fee"].value;
       var doctoroo_commission= document.forms["Form"]["doctoroo_commission"].value;
       /*var pharmacy= document.forms["Form"]["pharmacy"].value;
       var refund= document.forms["Form"]["refund"].value;
       var Refund_fee= document.forms["Form"]["Refund_fee"].value;*/
       setTimeout(function()
     {
      // document.getElementById('err_processing').innerHTML="";
       document.getElementById('err_consultation').innerHTML="";
       document.getElementById('err_doctoroo_commission').innerHTML="";
       document.getElementById('err_doctoroo_fee').innerHTML="";
       /*document.getElementById('err_pharmacy').innerHTML="";
       document.getElementById('err_refund').innerHTML="";
       document.getElementById('err_Refund').innerHTML="";*/
      
     },2000); 
   
       /*if(ProcessingFee=="")
       {
          document.getElementById('err_processing').innerHTML="Please Enter Processing Fees"; 
           return false;
       }*/
       if(consultationfees=="")
       {
          document.getElementById('err_consultation').innerHTML="Please Enter Consultation Fees"; 
           return false;
       }
       if(doctoroo_fee=="")
       {
          document.getElementById('err_doctoroo_fee').innerHTML="Please Enter Doctoroo Fee"; 
           return false;
       }
       if(doctoroo_commission =="")
       {
          document.getElementById('err_doctoroo_commission').innerHTML="Please Enter Doctoroo Commission"; 
          return false;
       }
       /*if(pharmacy=="")
       {
          document.getElementById('err_pharmacy').innerHTML="Please Select Pharmacy Fees"; 
           return false;
       }
       if(refund=="")
       {
          document.getElementById('err_refund').innerHTML="Please Select Refund"; 
           return false;
       }
       if(Refund_fee=="")
       {
          document.getElementById('err_Refund').innerHTML="Please Enter Refund Fees"; 
           return false;
       }*/
   
     }

     $(function () {
        $("input[id*='fee'],input[id*='doctoroo_commission'],input[id*='doctoroo_fee']").keydown(function (event) {

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