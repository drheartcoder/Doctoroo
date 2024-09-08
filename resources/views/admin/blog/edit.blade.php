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
      <form method="post" action="{{$module_url_path.'/update/'.$enc_id}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
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
                           <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{isset($blog_data['title'])?$blog_data['title']:''}}" >
                           <div class="err" id="err_title"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Date
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="date" class="form-control datepicker" id="date" placeholder="Date" value="{{isset($blog_data['date'])?$blog_data['date']:''}}" >
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
                           <input type="text" name="postedby" placeholder="Posted By" id="postedby" class="form-control" value="{{isset($blog_data['postedby'])?$blog_data['postedby']:''}}" >
                           <div class="err" id="err_postedby"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-3 control-label">Image </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                 @if(isset($blog_data['image']) && isset($blog_data['image']))
                                 <img src="{{$img_path.$blog_data['image']}}" alt="" />
                                 @else
                                 <img src="{{url('/')}}/public/images/no_image.png" alt="" />
                                 @endif  
                                 <!--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />-->
                              </div>
                              <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                 <span class="fileupload-exists">Change</span>
                                 <input type="file" name="blog_image" class="file-input" id="image"/></span>
                                 
                              </div>
                           </div>
                           <i><b>Note:</b>Supported file type jpeg,png,jpg  </i> 
                           <div class="err" id="err_image"></div>
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
                              <textarea class='form-control desc' id='template_html'  name="description" rows='10' data-rule-required='true' placeholder='Email Template Body'><?php echo html_entity_decode($blog_data['description']);?></textarea>
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
                           <input type="text" name="meta_title" class="form-control" value="{{isset($blog_data['meta_title'])?$blog_data['meta_title']:''}}" id="metatitle" placeholder="Meta Title"><span class="error_msg" style="color:#ff0000;"></span>
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
                           <input type="text" name="meta_keyword" class="form-control" value="{{isset($blog_data['meta_keyword'])?$blog_data['meta_keyword']:''}}" id="metakeyword" placeholder="Meta Keyword"><span class="error_msg" style="color:#ff0000;"></span>
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
                           <input type="text" name="meta_desc" class="form-control"  value="{{isset($blog_data['meta_desc'])?$blog_data['meta_desc']:''}}" id="metadesc" placeholder="Meta description" ><span class="error_msg" style="color:#ff0000;"></span>
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
                  <button type="submit" name="btn_save" id="edit_blog" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
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
    });
   
   $(function()
   {
      $('.datepicker').datepicker({format: "yyyy-mm-dd" });
   });
   
   $('#edit_blog').click(function(){
   
       var title                     = $('#title').val();
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
   $(document).ready(function()
   { 
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
         $('#edit_blog').removeAttr('disabled'); 
         $("#err_image").html("");
         return true;
        
             
      }  
      else
      {
   
         $('#edit_blog').attr('disabled','disabled');
         $("#err_image").html("Please select valid image to upload.");
           
   
      }
       
   });
   
   });
</script>
@endsection

