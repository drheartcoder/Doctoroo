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
            </span> 
              <li>
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/howitworks') }}">Manage</a>
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
                    <h3><i class="fa fa-file"></i>{{ isset($page_title)?$page_title:"" }} </h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')
                    <form method="post" action="{{ url($module_url_path.'/update/'.$enc_id)}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-sm-3 col-lg-2 control-label">Image:</label>
                          <div class="col-sm-9 col-lg-2 controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                    @if(isset($admin_img_path) && isset($arr_data['image']))
                                      <img src="{{$admin_img_path.$arr_data['image']}}" alt="" />
                                    @endif
                                 </div>
                                <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file" style="height:32px;">
                                            <span class="fileupload-new">Select Image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" class="file-input" name="image" id="image"  />
                                    </span>
                                    <a href="#" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"></label>
                            <div class="col-sm-9 col-lg-4 controls">
                            <span class="label label-important">NOTE!</span>
                                <span>Image Formate: jpeg,png,gif and Size should be less than or equalto 88px*110px.</span>    
                                  
                            </div>
                        </div>
                          <input type="hidden" class="form-control" name="old_image" value="{{isset($arr_data['image'])?$arr_data['image']:''}}" />
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Title<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                             <input type="text" name="title" id="title" value="{{isset($arr_data['title'])?$arr_data['title']:''}}" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Title">   
                              <span class='help-block'>{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="col-sm-3 col-lg-2 control-label" for="page_desc">Description <i class="red">*</i></label>
                           <div class="col-sm-6 col-lg-8 controls">
                               <textarea name="description" placeholder="Description" id="description" class="form-control" data-rule-required="true"> 
                               {{isset($arr_data['title'])?$arr_data['title']:''}}</textarea>                
                            <span class='help-block'>{{ $errors->first('description') }}</span>
                          </div>
                        </div>

                      
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                              <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
                            </div>
                       </div>
                    </form>
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

@endsection


  
