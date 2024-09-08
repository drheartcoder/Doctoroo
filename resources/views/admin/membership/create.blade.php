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

            <form method="post" action="{{url($module_url_path.'/store')}}" id="validation-form" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
              
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Category
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                     <select class="form-control" name="faq_cat" data-rule-required="true">
                           <option value="">Select Category</option>
                           @foreach($faq_cats as $val)
                              <option value="{{$val['id']}}">{{$val['category_name']}}</option>
                           @endforeach
                     </select>
                    <div class="error">{{ $errors->first('last_name') }}</div>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Question
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                     <input type="text" name="question" id="qusetion" placeholder="Question" class="form-control" data-rule-required="true" data-rule-maxlength="255">
                    <span id="err_title1" style="color:red;"></span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Answer
                  <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <textarea name="answer"  id="answer" rows="4" cols="50" class="form-control" data-rule-required="true"></textarea>
                    <span id="err_desc1" style="color:red;"></span>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Add</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

@stop