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
      <form method="post" action="{{url($module_url_path.'/store')}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         {{ csrf_field() }}
         <div class="box-content">
            @include('admin.layout._operation_status') 
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN Left Side -->
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="title" class="form-control" id="title" placeholder="Title" >
                           <div class="err" id="err_title"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Category
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <select name="blog_cat" id="blog_cat" class="form-control">
                              <option value="">--Select--</option>
                              @if(count($cat_arr)>0)
                                @foreach($cat_arr as $catarr)
                                <option value="{{ $catarr['id'] }}">{{ $catarr['category'] }}</option>
                                @endforeach
                              @endif
                           </select>
                           <div class="err" id="err_blog_cat"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Date
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="date" placeholder="Date" id="date" class="form-control datepicker" >
                           <div class="err" id="err_date"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group ">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Posted By
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="postedby" id="postedby"  placeholder="Posted By" class="form-control" >
                           <div class="err" id="err_postedby"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Image Upload</label>
                        <div class="col-sm-3 col-lg-7 controls">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                 <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                              </div>
                              <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                 <span class="fileupload-exists">Change</span>
                                 <input type="file" name="blog_image"  id="image" class="file-input" /></span>
                                 <!--<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>-->
                              </div>
                              <i><b>Note:</b>Supported file type jpeg,png,jpg  </i>
                              <div class="err" id="err_image"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group ">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Description
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-6 col-lg-7 controls">
                              <textarea class='form-control desc' id='template_html' name="description" rows='10' data-rule-required='true' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('template_html') }} </span> 
                              <div class="err" id="err_desc"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title"> Meta Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_title" class="form-control" id="metatitle" placeholder="Meta Title">
                           <div class="err" id="err_metatitle"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title"> Meta Keyword
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_keyword" class="form-control" id="metakeyword" placeholder="Meta Keyword">
                           <div class="err" id="err_metakeyword"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Meta Description
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_desc" class="form-control" id="metadesc" placeholder="Meta description" >
                           <div class="err" id="err_metadesc"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <center>
               <div class="form-group">
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
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
   $(document).ready(function()
    {
      tinymce.init({
        selector: 'textarea',
        relative_urls: false,
        remove_script_host:false,
        convert_urls:false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
          '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
          '//www.tinymce.com/css/codepen.min.css'
        ]
      });
      var _URL = window.URL || window.webkitURL;
   $("#image").change(function (e) 
   { 
      var filename=$("#image").val();
      var flag=1;
      $("#err_image").html("");
      var ext = filename.split('.').pop();
      var file, img;
      
      if(ext == "jpeg" || ext == "png" || ext == "jpg")
      {
         $('#valid').removeAttr('disabled'); 
         $("#err_image").html("");
         return true;        
      }  
      else
      {
         $('#valid').attr('disabled','disabled');
         $("#err_image").html("Please select valid image to upload.");
      }
       
   });

    $(function()
   {
      $('.datepicker').datepicker({format: "yyyy-mm-dd" });
   });
   
    $('#valid').click(function(){
   
       var title                     = $('#title').val();
       var blog_cat                  = $('#blog_cat').val();
       var date                      = $('#date').val();
       var postedby                  = $('#postedby').val();
       var desc                      = $('.desc').val();
       var metatitle                 = $('#metatitle').val();
       var metakeyword               = $('#metakeyword').val();
       var metadesc                  = $('#metadesc').val();
      
       if($.trim(title)=="")
       {
          $('#title').val('');
          $('#err_title').fadeIn();         
          $('#err_title').html('Please enter title.');
          $('#err_title').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#title').focus();
          return false;
       }
       if($.trim(blog_cat)=="")
       {
          $('#blog_cat').val('');
          $('#err_blog_cat').fadeIn();         
          $('#err_blog_cat').html('Please select category.');
          $('#err_blog_cat').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#blog_cat').focus();
          return false;
       }
       if($.trim(date)=="")
       {
          $('#date').val('');
          $('#err_date').fadeIn();         
          $('#err_date').html('Please enter date.');
          $('#err_date').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#date').focus();
          return false;
       }
       if($.trim(postedby)=="")
       {
          $('#postedby').val('');
          $('#err_postedby').fadeIn();         
          $('#err_postedby').html('Please enter posted by.');
          $('#err_postedby').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#postedby').focus();
          return false;
       }
       if($.trim(desc)=="")
       {
          $('.desc').val('');
          $('#err_desc').fadeIn();         
          $('#err_desc').html('Please enter description.');
          $('#err_desc').fadeOut(4000);
         
          $('.desc').focus();
          return false;
       }
       if($.trim(metatitle)=="")
       {
          $('#metatitle').val('');
          $('#err_metatitle').fadeIn();         
          $('#err_metatitle').html('Please enter meta title.');
          $('#err_metatitle').fadeOut(4000);
         
          $('#metatitle').focus();
          return false;
       }
        if($.trim(metakeyword)=="")
       {
          $('#metakeyword').val('');
          $('#err_metakeyword').fadeIn();         
          $('#err_metakeyword').html('Please enter meta keyword.');
          $('#err_metakeyword').fadeOut(4000);
         
          $('#metakeyword').focus();
          return false;
       }
        if($.trim(metadesc)=="")
       {
          $('#metadesc').val('');
          $('#err_metadesc').fadeIn();         
          $('#err_metadesc').html('Please enter meta description.');
          $('#err_metadesc').fadeOut(4000);
         
          $('#metadesc').focus();
          return false;
       }
    
   });
});
   
</script>
@endsection

