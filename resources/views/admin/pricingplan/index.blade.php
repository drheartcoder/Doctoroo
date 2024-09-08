@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .error{
   color:red;
   }
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
      <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i>{{ isset($page_title)?$page_title:"" }} Section</h3>
         <div class="box-tool">
         </div>
      </div>
      <div class="box-content">
         @include('admin.layout._operation_status')
         <form method="post" action="{{url($module_url_path.'/update')}}" id="validation-form" class="form-horizontal" name="Form" >
            {{ csrf_field() }} 
            <div class="row hidden-xs">
               <div class="col-md-12">
                  <!-- <div class="box box-green"> -->
                  <div class="box-title">
                     <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                     <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                     </div>
                  </div>
                  <div class="box-content">
                     <div class="row">
                        <div class="col-md-12 ">
                           <div class="box box-gray">
                              <div class="box-title">
                                 <h3><i class="fa fa-puzzle-piece"></i>Pricing Plan</h3>
                              </div>
                              <br>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Section1&nbsp;:
                                 </label>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Title
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <input type="text" name="title_1" id="title_1" placeholder="Title" value="{{isset($arr_data['title_1'])?$arr_data['title_1']:''}}" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                                    <span id="err_title1" style="color:red;"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Description
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <textarea name="description_1"  id="description_1"  class="form-control" data-rule-required="true">{{isset($arr_data['description_1'])?$arr_data['description_1']:''}}</textarea>
                                    <span id="err_desc1" style="color:red;"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Section2&nbsp;:
                                 </label>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Title
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <input type="text" name="title_2" placeholder="Title" id="title_2" value="{{isset($arr_data['title_2'])?$arr_data['title_2']:''}}" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                                    <span id="err_title2" style="color:red;"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Description
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <textarea name="description_2"  id="desc_2" class="form-control" data-rule-required="true"> {{isset($arr_data['description_2'])?$arr_data['description_2']:''}}</textarea>
                                    <span id="err_desc2" style="color:red;"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Section3&nbsp;:
                                 </label>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Title
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <input type="text" name="title_3" id="title_3" placeholder="Title" value="{{isset($arr_data['title_3'])?$arr_data['title_3']:''}}" id="title" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                                    <span id="err_title3" style="color:red;"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-2 control-label" for="page_title">Description
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <textarea name="description_3" id="description_3"  class="form-control" data-rule-required="true">{{isset($arr_data['description_3'])?$arr_data['description_3']:''}}</textarea>  
                                    <span id="err_desc3" style="color:red;"></span>
                                 </div>
                              </div>
                              <br>
                              <div class="form-group" style="margin-left:150px;">
                                 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
                                 </div>
                              </div>
                              <!-- END Left Side -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--  </div> -->
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i>Pricing Table Section</h3>
         <div class="box-tool">
         </div>
      </div>
      <div class="box-content">
         <form method="post" action="{{url($module_url_path.'/store')}}" name="myForm" onsubmit="return addMore(this)" class="form-horizontal">
            {{ csrf_field() }} 
            <div class="row hidden-xs">
               <div class="col-md-12">
                  <!-- <div class="box box-green"> -->
                  <div class="box-title">
                     <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                     <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                     </div>
                  </div>
                  <div class="box-content">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="box box-gray">
                              <div class="box-title">
                                 <h3><i class="fa fa-puzzle-piece"></i>Pricing Table</h3>
                              </div>
                              <br>
                              <table class="table table-bordered">
                                 <div class="errorTxt"></div>
                                 <thead>
                                    <tr>
                                       <th>Length Of Call</th>
                                       <th>Day-Time Cost(8AM-8PM)</th>
                                       <th>Night-Time Cost(8PM-8AM)</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="addmore">
                                    @if(isset($arr_info) && sizeof($arr_info)>0)
                                    @foreach($arr_info as $arr)
                                    <tr class="clone">
                                       <!--<div class="error"><h5><span class="err_length" style="color:#ff0000;"></span></h5></div>-->
                                       <td><input type="text" name="length_of_call[]" value="{{isset($arr['length_of_call'])?$arr['length_of_call']:''}}" class="form-control length_of_call" data-rule-required="true"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><input type="text" name="day_time_cost[]"  value="{{isset($arr['day_time_cost'])?$arr['day_time_cost']:''}}" class="form-control day_time_cost" data-rule-required="true"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><input type="text" name="night_time_cost[]"  value="{{isset($arr['night_time_cost'])?$arr['night_time_cost']:''}}""  class="form-control night_time_cost" data-rule-required="true"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><a onclick="removePricing(this)" href="javascript:void(0)" id="reset" class="glyphicon glyphicon-minus"></a></td>
                                       <!-- <td> <a class="glyphicon glyphicon-minus" href="{{ $module_url_path.'/delete/'.base64_encode($arr['id'])}}" 
                                          title="Delete"> </a></td> -->
                                    </tr>
                                    @endforeach
                                    @endif
                                    <tr class="clone" id="validate">
                                       <!-- data-rule-required="true" -->
                                       <td><input type="text" name="length_of_call[]" class="form-control  length_of_call"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><input type="text" name="day_time_cost[]"  class="form-control  day_time_cost"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><input type="text" name="night_time_cost[]" class="form-control  night_time_cost"><span class="error_msg" style="color:#ff0000;"></span></td>
                                       <td><a href="javascript:void(0)" onclick="addMorePricing(this)" class="glyphicon glyphicon-plus"></a>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-5">
                              <button type="submit" name="btn_save" id="valid" class="btn btn-success" >Submit</button>
                           </div>
                        </div>
                        <!-- END Left Side -->
                     </div>
                  </div>
               </div>
            </div>
            <!--  </div> -->
      </form>
   </div>
</div>
</div>
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i>Pricing Notes Section</h3>
         <div class="box-tool">
         </div>
      </div>
      <div class="box-content">
         <form method="post" action="{{url($module_url_path.'/updatenote')}}" name="myForm" class="form-horizontal">
            {{ csrf_field() }} 
            <div class="row hidden-xs">
               <div class="col-md-12">
                  <!-- <div class="box box-green"> -->
                  <div class="box-title">
                     <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                     <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                     </div>
                  </div>
                  <div class="box-content">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="box box-gray">
                              <div class="box-title">
                                 <h3><i class="fa fa-puzzle-piece"></i>Pricing Notes</h3>
                              </div>
                              <br>
                              @if(isset($arr_note) && sizeof($arr_note)>0)
                              @foreach($arr_note as $arr)
                              <div class="form-group clones">
                                 <label class="col-sm-3 col-lg-3 control-label" for="page_title">Pricing Notes
                                 <i class="red">*</i>
                                 </label>
                                 <div class="col-sm-6 col-lg-8 controls">
                                    <textarea name="pricing_note[]" id="pricing_note"  class="form-control pricing_note" data-rule-required="true">{{isset($arr['pricing_note'])?$arr['pricing_note']:''}}</textarea>  
                                    <span class="error_msg" style="color:red;"></span>
                                    <br>
                                    <a onclick="removedesc(this)" href="javascript:void(0)" class="glyphicon glyphicon-minus"></a>
                                 </div>
                              </div>
                              @endforeach
                              @endif
                              <div class="clearfix"></div>
                              <br/>     
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-3 control-label" for="page_title">
                                 </label>
                                 <div class="col-sm-6 col-lg-4 controls">
                                    <a href="javascript:void(0)" id="plusnote" class="glyphicon glyphicon-plus"></a>
                                 </div>
                              </div>
                              <br>
                              <center>
                                 <div class="form-group">
                                    <button type="submit" name="btn_save" id="validnote" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
                                 </div>
                              </center>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--  </div> -->
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   function saveTinyMceContent()
   {
     tinyMCE.triggerSave();
   }
   
   $(document).ready(function() {
    $('#valid').click(function(e) { 
        var isValid = 1;
         
         setTimeout(function()
             {
               $('span.error_msg').html('');
           },2000);
        $('input[type="text"]').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = 0;
           //$(".error").first().find(".err_length").html("Please Enter All Fields.");
          $(this).next().html("Please Enter Fields");
          //alert("please Enter All Fields");       
          }
           
        });
       
      if(isValid==0)
      { 
        return false;
      }
      else
      {
        return true;
      }
   
   });
   });
   function addMorePricing(ref)
   {
   
   var to_be_replaced = '<a onclick="removePricing(this)" href="javascript:void(0)" id="reset" class="glyphicon glyphicon-minus"></a>';
   var arr_input = $(ref).parent().parent().find("input");
   var is_valid_for_add = false;
   
   if(arr_input.length > 0 )
   { 
    $.each(arr_input,function(index,elem)
    { 
      is_valid_for_add = $(elem).valid();    
    });
   }
   if(is_valid_for_add)
   {
      var parent_tr = $(ref).parent();
      $(ref).remove();
      $(parent_tr).html(to_be_replaced);
      var html = '<tr class="clone">'+
                '<td><input type="text" name="length_of_call[]" class="form-control  length_of_call" ><span class="error_msg" style="color : red;"></span></td>'+
                '<td><input type="text" name="day_time_cost[]"  class="form-control day_time_cost" ><span class="error_msg" style="color : red;"></span></td>'+
                '<td><input type="text" name="night_time_cost[]" class="form-control night_time_cost"><span class="error_msg" style="color : red;"></span></td>'+
                '<td><a href="javascript:void(0)" onclick="addMorePricing(this)" class="glyphicon glyphicon-plus"></a></a>'+
                '</td>'+
                '</tr>';
   
     $(".addmore").append(html);
   }
   }
   
   function removePricing(ref)
   {
   //$(ref).parent().parent().remove(); 
   if($(".clone").length==1)
   {
    alert("you cant remove last input");
    return false;
   }
   else{
   
   $(ref).parent().parent().remove();
   }
   
   }
   /*------------notes--------------------*/
   $(document).ready(function(){
    
    $("#plusnote").click(function()
    {  
   
   var desc= $(".clones").last().find(".desc").val();
   $(".clones").last().find(".err_desc").html("");
   if(desc=="")
   {
    $(".clones").last().find(".err_desc").html("Please enter the fields.");
    return false;
   }
   else
   {
        $(".clones").last().find(".err_desc").html("");
       $($(".clones").last().clone().insertAfter($(".clones").last())).find('textarea').val('');    
   }
   
   
   });
   
    /*--------------clone vaildation-----------*/
    $('#validnote').click(function(e) {
    
        var isValid = 1;
         
         setTimeout(function()
             {
                $('.error_msg').html('');
           },2000);
        $('.pricing_note').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = 0;
           //$(".error").first().find(".err_length").html("Please Enter All Fields.");
          $(this).next().html("Please Enter Fields");
          //alert("please Enter All Fields");       
          }
           
        });
       
      if(isValid==0)
      { 
        return false;
      }
      else
      {
        return true;
      }
   
   });
   });
   function removedesc(ref)
   { 
   //$(ref).parent().parent().remove(); 
   if($(".clones").length==1)
   {
       alert("you cant remove last input");
       return false;
   }
   else
   {
       $(ref).parent().parent().remove();
   }
   
}
</script>
<!-- END Main Content --> 
@endsection

