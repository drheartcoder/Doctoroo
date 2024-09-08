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
            <span class="dki ivider">
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

           <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">{{csrf_field()}}
            <div class="col-md-10">
              <div id="ajax_op_status">
                  
              </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <div class="btn-toolbar pull-right clearfix">
           <div class="btn-group">
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                      title="Multiple Active/Unblock" 
                      href="javascript:void(0);" 
                      onclick="javascript : return check_multi_action('checked_record[]','frm_manage','activate');" 
                      style="text-decoration:none;">
                      <i class="fa fa-unlock"></i>
              </a> 
            </div>

            <div class="btn-group">
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Multiple Deactive/Block" 
               href="javascript:void(0);" 
               onclick="javascript : return check_multi_action('checked_record[]','frm_manage','deactivate');"  
               style="text-decoration:none;">
                <i class="fa fa-lock"></i>
            </a> 
            </div>

             <div class="btn-group">    
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Multiple Delete" 
               href="javascript:void(0);" 
               onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');"  
               style="text-decoration:none;">
               <i class="fa fa-trash-o"></i>
            </a>
            </div>  

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

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="table1" >
               <thead>
                  <tr>
                     <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Message</th>
                     <th>Rating</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(isset($arr_feedbacks) && sizeof($arr_feedbacks)>0)
                  @foreach($arr_feedbacks as $feedback)
                    <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($feedback['feedback_id']) }}" /> 
                     </td>
                     <td> {{ isset($feedback['user_details']['first_name'])?$feedback['user_details']['first_name']:'--' }} &nbsp; {{isset($feedback['user_details']['last_name'])?$feedback['user_details']['last_name']:'--'}}</td>
                     <td> {{ isset($feedback['user_details']['email'])?$feedback['user_details']['email']:'--' }} </td>
                     <td>
                      <?php ?>
                      {{isset($feedback['feedback'])?$feedback['feedback']:'--'}}
                     </td>
                     <td>
                        {{isset($feedback['rating'])?$feedback['rating']:'--'}}
                     </td>
                     <td>
                        @if($feedback['status']=="Active")
                        <a href="{{ $module_url_path.'/changeStatus/'.base64_encode($feedback['feedback_id']).'/'.'Block' }}" class="btn btn-success">Active</a>
                        @else
                        <a href="{{ $module_url_path.'/changeStatus/'.base64_encode($feedback['feedback_id']).'/'.'Active' }}" class="btn btn-danger">Inactive</a>
                        @endif
                     </td>
                     <td> 
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($feedback['feedback_id'])}}" 
                           onclick="javascript:return confirm_delete()"  title="Delete">
                        <i class="fa fa-trash" ></i>
                        </a>   
                     </td>
                  </tr>
                  @endforeach
                  @endif
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
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
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

    function check_multi_action(checked_record,frm_id,action)
    {
      var checked_record = document.getElementsByName(checked_record);
      var len = checked_record.length;
      var flag=1;
      var input_multi_action = jQuery('input[name="multi_action"]');
      var frm_ref = jQuery("#"+frm_id);
      
      if(len<=0)
      {
        alert("No records to perform this action");
        return false;
      }
      
      if(confirm('Do you really want to perform this action'))
      {
        for(var i=0;i<len;i++)
        {
          if(checked_record[i].checked==true)
          {  
              flag=0;

              jQuery('input[name="multi_action"]').val(action);

              jQuery(frm_ref)[0].submit();  
            }
          }

        if(flag==1)
        {
          alert('Please select record(s)');
          return false;
        }  
          
      } 
      
  }

</script>
@stop                    


