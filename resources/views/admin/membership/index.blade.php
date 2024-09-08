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

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="membership-table" >
               <thead>
                  <tr>
                     <th width="10%">ID</th>
                     <th width="10%">Name</th>
                     <th width="10%">Transaction Id</th>
                     <th width="10%">Amount Paid</th>
                     <th width="10%">Membership plan</th>
                     <th width="10%">Start date</th>
                     <th width="10%">End date</th>
                     <th width="10%">Action</th>
                  </tr>
               </thead>
               <tbody>
               @if(isset($arr_membership))
                  @foreach($arr_membership as $membership)
                  <tr>
                     <td>
                        {{ isset($membership['invoice_no']) ? $membership['invoice_no'] : '' }}
                     </td>
                     <td> {{ isset($membership['userinfo']['title'])?$membership['userinfo']['title'] : '' }} {{ isset($membership['userinfo']['first_name'])?$membership['userinfo']['first_name'] : '' }} {{ isset($membership['userinfo']['last_name'])?$membership['userinfo']['last_name'] : '' }}
                     </td>
                     <td>
                        {{ isset($membership['transaction_id']) ? $membership['transaction_id'] : '' }}
                     </td>
                     <td>
                        {{ isset($membership['total_amount']) ? '$'.$membership['total_amount'] : '' }}
                     </td>
                     <td>
                        {{ isset($membership['package']) && $membership['package'] == 'annually' ? 'Annually' : '' }}

                        {{ isset($membership['package']) && $membership['package'] == 'monthly' ? 'Monthly' : '' }}
                     </td>
                     <td>
                        {{ isset($membership['start_date'])  ? date('d M Y' , strtotime($membership['start_date'])) : '' }}
                     </td>
                     <td>
                        {{ isset($membership['end_date'])  ? date('d M Y' , strtotime($membership['end_date'])) : '-' }}
                     </td>
                     <td>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/show/'.base64_encode($membership['id']) }}" title="" data-original-title="View">
                           <i class="fa fa-eye"></i>
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

       $('#membership-table').DataTable( {
            "pageLength": 10,
            "aoColumns": [
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
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
              /* Set Action in hidden input*/
              jQuery('input[name="multi_action"]').val(action);

              /*Submit the referenced form */
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


