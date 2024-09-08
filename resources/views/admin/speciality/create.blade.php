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
            <form method="post" action="{{url($module_url_path.'/store')}}" id="validation-form" class="form-horizontal" files="true" enctype="multipart/form-data" > 
            {{ csrf_field() }}
              
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="speciality">Speciality
                       <i class="red">*</i>                       
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="speciality" placeholder="Doctor Speciality" id="speciality" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                    <span class='help-block' id="err_speciality">{{ $errors->first('speciality') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Image Upload</label>
                  
                  <div class="col-sm-9 col-lg-10 controls">
                     <div class="fileupload fileupload-new" data-provides="fileupload">
                        
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                           <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        </div>

                        <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        
                        <div>
                           <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                           <span class="fileupload-exists">Change</span>
                           <input type="file" name="speciality_image" class="file-input" /></span>
                           <!--<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>-->
                        </div>

                     </div>                     
                  </div>

               </div>
                
                 <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Meta Title
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="meta_title" placeholder="Meta Title" id="meta_title" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                   <span class='help-block' id="err_meta_title">{{ $errors->first('meta_title') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Meta Keyword
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="meta_keyword" placeholder="Meta Keyword" id="meta_keyword" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                   <span class='help-block' id="err_meta_keyword">{{ $errors->first('meta_keyword') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_desc">Meta Description
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                     <input type="text" name="meta_desc" placeholder="Meta Description" id="meta_desc" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                     <span class='help-block' id="err_meta_desc">{{ $errors->first('meta_desc') }}</span>
                  </div>
                </div>

                
             <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <button type="submit" name="btn_speciality_save" id="btn_speciality_save" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
             </div>
            </div>
            </form>
          </div>

        </div>
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
        height:350,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
        content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
  </script>

  @stop
