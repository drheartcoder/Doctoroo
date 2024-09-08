

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
      <li><a href="{{$module_url_path}}">{{ $module_title or ''}}</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">{{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($page_title)?$page_title:"" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <form method="post" action="{{$module_url_path.'/dynamicupdate/'.$enc_id}}" id="validation-form" class="form-horizontal" name="Form" >
         {{ csrf_field() }}
         <div class="box-content">
            @include('admin.layout._operation_status') 
            <div class="row">
               <div class="col-md-6">
                  <!-- BEGIN Left Side -->
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i>Sections</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section1&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title" id="title" placeholder="Title" value="{{isset($pages_data['title'])?$pages_data['title']:''}}" class="form-control description" data-rule-maxlength="255">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Subtitle
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="subtitle"  id="subtitle"  class="form-control description">{{isset($pages_data['subtitle'])?$pages_data['subtitle']:''}}</textarea>
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section2&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title1
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title1" placeholder="Title" id="title1" value="{{isset($pages_data['title1'])?$pages_data['title1']:''}}" class="form-control description"  data-rule-maxlength="255">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description1
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description1"  id="description1" class="form-control description"><?php echo html_entity_decode($pages_data['description1']);?></textarea>
                              <span class="error_msg" style="color:red;"></span>
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
                        <h3><i class="fa fa-puzzle-piece"></i>Sections</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section3&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title2
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title2" id="title2" placeholder="Title" value="{{isset($pages_data['title2'])?$pages_data['title2']:''}}" id="title" class="form-control description">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description2
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description2" id="description2"  class="form-control description"><?php echo html_entity_decode($pages_data['description2']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section4&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title3
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title3" id="title3" placeholder="Title" value="{{isset($pages_data['title3'])?$pages_data['title3']:''}}" id="title" class="form-control description">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description3
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description3" id="description3"  class="form-control description"><?php echo html_entity_decode($pages_data['description3']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
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
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i>Sections</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section5&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title4
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title4" id="title4" placeholder="Title" value="{{isset($pages_data['title4'])?$pages_data['title4']:''}}" id="title" class="form-control description">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description4
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description4" id="description4"  class="form-control description"><?php echo html_entity_decode($pages_data['description4']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        @if(isset($pages_desc) && sizeof($pages_desc)>0)
                        @foreach($pages_desc as $arr)
                        <div class="form-group clone">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description[]" id="description"  class="form-control description">{{isset($arr['description'])?$arr['description']:''}}</textarea>  
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
                              <a href="javascript:void(0)" onclick="addMorePricing(this)" id="plus" class="glyphicon glyphicon-plus"></a>
                           </div>
                        </div>
                        <br>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">SubDescription4
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="subdescription4" id="subdescription4"  class="form-control description"><?php echo html_entity_decode($pages_data['subdescription4']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                           <div class="clearfix"></div>
                        <br/>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section6&nbsp;:
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title5
                              <i class="red">*</i>
                              </label>
                              <div class="col-sm-6 col-lg-7 controls">
                                 <input type="text" name="title5" id="title5" placeholder="Title" value="{{isset($pages_data['title5'])?$pages_data['title5']:''}}" class="form-control description">
                                 <span class="error_msg" style="color:red;"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description5
                              <i class="red">*</i>
                              </label>
                              <div class="col-sm-6 col-lg-7 controls">
                                 <textarea name="description5"  id="description5" class="form-control description"><?php echo html_entity_decode($pages_data['description5']);?></textarea>
                                 <span class="error_msg" style="color:red;"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <!-- BEGIN Left Side -->
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i>Sections</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section7&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title6
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title6" id="title6" placeholder="Title" value="{{isset($pages_data['title6'])?$pages_data['title6']:''}}" id="title" class="form-control description">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description6
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description6" id="description6"  class="form-control description"><?php echo html_entity_decode($pages_data['description6']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        @if(isset($pages_faq) && sizeof($pages_faq)>0)
                        @foreach($pages_faq as $arrs)
                        <div class="form-group clones">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="faqdescription[]" id="faqdescription"  class="form-control description">{{isset($arrs['faqdescription'])?$arrs['faqdescription']:''}}</textarea>  
                              <span class="error_msg" style="color:red;"></span>
                              <br>
                              <a onclick="removefaq(this)" href="javascript:void(0)" class="glyphicon glyphicon-minus"></a>
                           </div>
                        </div>
                        @endforeach
                        @else

                        @endif
                        <div class="clearfix"></div>
                        <br/>     
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <a href="javascript:void(0)" onclick="addMorePricing(this)" id="plusdynamic" class="glyphicon glyphicon-plus"></a>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                           <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">SubDescription6
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                               <textarea name="subdescription6"  id="subdescription6" class="form-control description"><?php echo html_entity_decode($pages_data['subdescription6']);?></textarea>  
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                  <!-- BEGIN Left Side -->
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i>Sections</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Section8&nbsp;:
                           </label>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title7
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <input type="text" name="title7" id="title7" placeholder="Title" value="{{isset($pages_data['title7'])?$pages_data['title7']:''}}" class="form-control description">
                              <span class="error_msg" style="color:red;"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description7
                           <i class="red">*</i>
                           </label>
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea name="description7"  id="description7" class="form-control description"><?php echo html_entity_decode($pages_data['description7']);?></textarea>
                              <span class="error_msg" style="color:red;"></span>
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
                     <h3><i class="fa fa-puzzle-piece"></i>Meta Section</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Meta Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{isset($pages_data['meta_title'])?$pages_data['meta_title']:''}}" class="form-control description">
                           <span class="error_msg" style="color:red;"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Meta Keyword
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" value="{{isset($pages_data['meta_keyword'])?$pages_data['meta_keyword']:''}}" class="form-control description">
                           <span class="error_msg" style="color:red;"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Meta Description
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <textarea name="meta_desc"  id="meta_desc" class="form-control description"><?php echo html_entity_decode($pages_data['meta_desc']);?></textarea>
                           <span class="error_msg" style="color:red;"></span>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <center>
               <div class="form-group">
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
               </div>
            </center>
         </div>
      </form>
   </div>
</div>
<!-- END Main Content --> 
<script>
   function saveTinyMceContent()
   {
     tinyMCE.triggerSave();
   }
   
   $(document).ready(function(){
    
    $("#plus").click(function()
    {  
   
   var desc= $(".clone").last().find(".desc").val();
   $(".clone").last().find(".err_desc").html("");
   if(desc=="")
   {
    $(".clone").last().find(".err_desc").html("Please enter the fields.");
    return false;
   }
   else
   {
        $(".clone").last().find(".err_desc").html("");
       $($(".clone").last().clone().insertAfter($(".clone").last())).find('textarea').val('');    
   }
   
   
   });
    $("#plusdynamic").click(function()
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
    $('#valid').click(function(e) {
    
        var isValid = 1;
         
         setTimeout(function()
             {
                $('.error_msg').html('');

           },9000);
        $('.description').each(function() {
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
   /*--------------remove clone---------------------*/
   function removedesc(ref)
   { 
   //$(ref).parent().parent().remove(); 
   if($(".clone").length==1)
   {
       alert("you cant remove last input");
       return false;
   }
   else
   {
       $(ref).parent().parent().remove();
   }
   
   }
    
   function removefaq(ref)
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
@endsection

