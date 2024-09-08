@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">
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
      <a href="{{ url($admin_panel_slug.'/dashboard') }}" class="call_loader"> Dashboard </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-envelope"></i>
      <a href="{{ $module_url_path }}" class="call_loader"> {{ $module_title or ''}} </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
    </span>
    <li class="active"> {{ $page_title or ''}} </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-title">
        <h3>
          <i class="fa fa-list"></i>
          {{ $page_title or ''}}
        </h3>
        <div class="box-tool">
          <a data-action="collapse" href="#"></a>
          <a data-action="close" href="#"></a>
        </div>
      </div>
      <div class="box-content">
        @include('admin.layout._operation_status')
       
        <form name="form-horizontal" id="frm_manage" enctype="multipart/form-data" method="POST" action="<?php echo url('/').$module_url_path.'/multi_action'; ?>"> 
        {{ csrf_field() }}
        <div class="col-md-10">
          <div id="ajax_op_status"></div>
          <div class="alert alert-danger" id="no_select" style="display:none;"></div>
          <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
        </div>
        <div class="btn-toolbar pull-right clearfix">
          <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
              <i class="fa fa-repeat"></i>
            </a> 
          </div>
        </div>
        <br/>
        <br/>
        <div class="clearfix">
        </div>
        <div class="table-responsive" style="border:0">
          <table class="table table-advance"  id="table_module" >
            <thead>
              <tr>
                <th>   ID       </th>
                <th>   Name     </th> 
                <th>   From     </th> 
                <th> From Email </th>
                <th>  Subject   </th>
                <th>   Action   </th>
              </tr>
            </thead>
            <tbody>
              @if(sizeof($arr_data)>0)
              @foreach($arr_data as $email_template)
              <tr>
                <td> {{ $email_template['id'] }}                  </td>

                <td> {{ $email_template['template_name'] }}       </td> 

                <td> {{ $email_template['template_from'] }}       </td> 

                <td> {{ $email_template['template_from_mail'] }}  </td>

                <td> {{ $email_template['template_subject'] }}    </td> 
                 
                <td> 
                  <a href="{{ $module_url_path.'/edit/'.base64_encode($email_template['id']) }}"  title="Edit" class="btn btn-circle btn-bordered call_loader">
                    <i class="fa fa-edit" ></i>
                  </a> &nbsp;&nbsp;
                  <a target="_blank" class="btn btn-circle btn-bordered" href="{{ $module_url_path.'/view/'.base64_encode($email_template['id']) }}"  title="View">
                    <i class="fa fa-eye" ></i>
                  </a> 
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div>   
        </div>
        </form>
      </div>
    </div>
  </div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
        $('#table_module').DataTable( {
            "pageLength": 10,
            "aoColumns": [
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });

</script>

@stop