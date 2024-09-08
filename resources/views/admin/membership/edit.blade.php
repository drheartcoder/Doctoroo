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
            <form method="post" action="{{$module_url_path.'/update/'.$enc_id}}" id="validation-form" class="form-horizontal" files="true" enctype="multipart/form-data" > 
            {{ csrf_field() }}
              
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="name">Name                       
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="name" value="{{isset($membership_arr['userinfo']['title']) ? $membership_arr['userinfo']['title'] : ''}} {{isset($membership_arr['userinfo']['first_name']) ? $membership_arr['userinfo']['first_name'] : ''}} {{isset($membership_arr['userinfo']['last_name']) ? $membership_arr['userinfo']['last_name'] : ''}}" placeholder="Language" id="name" class="form-control" readonly="true">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="day_rate">Consultation Fee(Day) in $
                       <i class="red">*</i>                       
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="day_rate" value="{{isset($membership_arr['day_rate']) ? $membership_arr['day_rate'] : ''}}" placeholder="Day rate" id="day_rate" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                    <span class='help-block' id="err_day_rate">{{ $errors->first('day_rate') }}</span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="night_rate">Consultation Fee(Night) in $
                       <i class="red">*</i>                       
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="night_rate" value="{{isset($membership_arr['night_rate']) ? $membership_arr['night_rate'] : ''}}" placeholder="Night rate" id="night_rate" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                    <span class='help-block' id="err_night_rate">{{ $errors->first('night_rate') }}</span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="package">Membership Plan         
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="package" value="{{isset($membership_arr['membership_payment']['package']) && $membership_arr['membership_payment']['package'] == 'annually' ? 'Annually' : ''}} {{isset($membership_arr['membership_payment']['package']) && $membership_arr['membership_payment']['package'] == 'monthly' ? 'monthly' : ''}}" placeholder="package" id="package" class="form-control" readonly="true">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="start_date">Start Date
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="start_date" value="{{isset($membership_arr['membership_payment']['start_date']) ? date('d/m/Y' , strtotime($membership_arr['membership_payment']['start_date'])) : ''}}" placeholder="Membership Start Date" id="start_date" class="form-control" readonly="true">
                    
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="end_date">End Date
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="end_date" value="{{isset($membership_arr['membership_payment']['end_date']) ? date('d/m/Y' , strtotime($membership_arr['membership_payment']['end_date'])) : ''}}" placeholder="Membership Start Date" id="end_date" class="form-control"  readonly="true">
                  </div>
              </div>
                
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <button type="submit" name="btn_language_save" id="btn_language_save" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
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

    $(function () {
        $("input[id*='day_rate'],input[id*='night_rate']").keydown(function (event) {

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
