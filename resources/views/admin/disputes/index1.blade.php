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
                {{ isset($module_title)?$module_title:"" }}
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
          <div class="btn-toolbar pull-right clearfix">
          
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
          <br/><br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action" value="" />
              <table class="table table-advance"  id="table_module">
               <thead>
                  <tr>
                     <th> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                     <th>Added By</th>
                     <th>Against</th>
                     <th>Payment Reason</th>    
                     <th>Issue</th>
                     <th>Date And Time</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($arr_dispute)>0)
                    @foreach($arr_dispute as $dispute)
                       <tr>
                           <td>
                               <input type="checkbox" name="checked_record[]"  value="{{ base64_encode($dispute['id']) }}" />
                            </td>
                            <td>
                               {{isset($dispute['added_by_user_info']['title']) ? $dispute['added_by_user_info']['title'] :''}}
                               {{isset($dispute['added_by_user_info']['first_name'])?ucfirst($dispute['added_by_user_info']['first_name']):''}}
                               {{isset($dispute['added_by_user_info']['last_name'])?ucfirst($dispute['added_by_user_info']['last_name']):''}}
                            </td>
                            <td>
                              {{isset($dispute['against_user_info']['title']) ? $dispute['against_user_info']['title'] :''}}
                               {{isset($dispute['against_user_info']['first_name'])?ucfirst($dispute['against_user_info']['first_name']):''}}
                               {{isset($dispute['against_user_info']['last_name'])?ucfirst($dispute['against_user_info']['last_name']):''}}
                            </td>
                            <td>
                                {{isset($dispute['payment_reason'])?$dispute['payment_reason']:'NA'}}
                            </td>
                            <td>
                              {{isset($dispute['what_is_issue'])?(substr($dispute['what_is_issue'],0,40).'...'):'NA'}}
                            </td>
                            <td>
                              {{isset($dispute['created_at'])?(date('d M Y',strtotime($dispute['created_at'])).' / '.date('h:i A',strtotime($dispute['created_at']))):'NA'}}
                            </td>
                            <td>
                              {{isset($dispute['status']) && $dispute['status']=='new' ? 'New' : ''}}
                              {{isset($dispute['status']) && $dispute['status']=='opened' ? 'Opened' : ''}}
                              {{isset($dispute['status']) && $dispute['status']=='closed' ? 'Closed' : ''}}
                            </td>
                            <td>
                              <a href="{{url($module_url_path.'/view/'.base64_encode($dispute['id']))}}" title="View" class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                            </td>
                      </tr>
                    @endforeach
                  @else
                   <tr>
                      <td colspan="8"> 
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Sorry !</strong> Currently,no records found.
                        </div>
                      </td>
                   </tr> 
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
          { "bSortable": false },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true }
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

function check_multi_action(chk_name,frm_name,action)
{
    var tmpchk   = chk_name;
    var chk_name = document.getElementsByName(chk_name);
    var len      = chk_name.length;
    var flag     = 1;
    var frm_ref = jQuery("#"+frm_name);
    
    var chklen = $('[name="'+tmpchk+'"]:checked').length;
    if(chklen > 0)
    {
    
      if(confirm('Are you sure you want to perform this action ?'))
      {
        for(var i=0;i<len;i++)
        {
          if(chk_name[i].checked==true)
          {
            flag=0;
            jQuery('input[name="multi_action"]').val(action);
            jQuery(frm_ref)[0].submit();  
          }
        } 
      }
      else{
        return false;
      }
    }
    
    if(flag==1)
    {
      alert('Please select record(s)');
      return false;
    }
}

</script>
@stop                    


