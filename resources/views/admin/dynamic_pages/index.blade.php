@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">

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

           <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">                     
          
           {{csrf_field()}}
            <div class="col-md-10">
            

            <div id="ajax_op_status">
                
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <br/>

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="table1" >
               <thead>
                  <tr>
                     <!-- <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th> -->
                     <th>Page Name</th>
                     <th>Page Slug</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($arr_dynamic_pages as $page)
                  <tr>
                     <!-- <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($page['page_id']) }}" /> 
                     </td> -->
                     <td> {{ isset($page['page_name'])?$page['page_name']:'' }} </td>
                     <td> {{ isset($page['page_slug'])?$page['page_slug']:'' }} </td>
                    
                     <td> 

                     @if($page['footer_dynamic']=="yes")
                     
                       <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/dynamicedit/'.base64_encode($page['page_id']) }}"  title="Edit">
                        <i class="fa fa-edit"></i>
                        </a>  
                     
                      @else
                         <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($page['page_id']) }}"  title="Edit">
                        <i class="fa fa-edit"></i>
                        </a>  
                        &nbsp;  
                      
                      @endif 
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
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
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });
    
    function confirm_delete()
    {
       if(confirm('Are you sure to delete this record?'))
       {
        return true;
       }
       return false;
    }

</script>
@stop                    


