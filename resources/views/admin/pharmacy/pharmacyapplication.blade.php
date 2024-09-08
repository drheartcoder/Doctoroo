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
                  <i class="fa fa-list"></i>
            </span>
            <li class="active">{{isset($module_title)?$module_title:'Pharmacy Applications'}}</li>
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
                {{isset($module_title)?$module_title:'Pharmacy Applications'}}
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
               href="{{ $module_url_path }}/applications"
               style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
            </a> 
            </div>

          </div>
          <br/>
          <br/> 
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  @if(count($arr_pharmacy)>0) id="table_module" @endif>
               <thead>
                  <tr>
                     <th><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                     <th>Pharmacy User Name</th>
                     <th>Pharmacy Name</th>                     
                     <th>Email ID</th>
                     <th>Contact Number</th>
                     <th>Suburb</th>
                     <th>Date & Time</th>
                     <th>Status</th>
                     <th>Admin Verification</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($arr_pharmacy)>0)
                   @foreach($arr_pharmacy as $pharmacy)
                   <tr>
                      <td>
                         <input type="checkbox" 
                            name="checked_record[]"  
                            value="{{ base64_encode($pharmacy['userinfo']['id']) }}" /> 
                      </td>
                      <td>

                         {{isset($pharmacy['userinfo']['first_name'])?ucfirst($pharmacy['userinfo']['first_name']):''}}
                         {{isset($pharmacy['userinfo']['last_name'])?ucfirst($pharmacy['userinfo']['last_name']):''}}

                      </td>
                      <td> {{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}} </td>
                      <td>

                         {{isset($pharmacy['userinfo']['email'])?$pharmacy['userinfo']['email']:''}}
                      </td>

                      <td>{{isset($pharmacy['phone'])?$pharmacy['phone']:'NA'}}</td>
                      <td>{{isset($pharmacy['address1'])?$pharmacy['address1']:'NA'}} {{isset($pharmacy['address2'])?$pharmacy['address2']:'NA'}}</td>
                      <td>
                          <?php $admin_datetime = convert_utc_to_userdatetime(1, "admin", $pharmacy['created_at']); ?>
                          {{isset($admin_datetime)?date('d-M-Y h:i:sa',strtotime($admin_datetime)):''}}
                      </td>
                      <td>
                         @if($pharmacy['userinfo']['user_status']=="Active")
                         <a href="{{ $module_url_path.'/deactivate/'.base64_encode($pharmacy['userinfo']['id']) }}" class="btn btn-success">Active</a>
                         @else
                         <a href="{{ $module_url_path.'/activate/'.base64_encode($pharmacy['userinfo']['id']) }}" class="btn btn-danger">Block</a>
                         @endif
                      </td>
                      <td>
                      <?php
                        $user = Sentinel::findById($pharmacy['userinfo']['id']);
                        if (isset($pharmacy['userinfo']['admin_verification_status_mini']) && ($pharmacy['userinfo']['admin_verification_status_mini']==1)) { ?>

                          <a href="javascript:void(0);" class="btn btn-success"><i class="fa fa-check"></i> Verified</a>

                       <?php  } else { ?>

                         <a href="{{ $module_url_path.'/admin_verified/'.base64_encode($pharmacy['userinfo']['id']) }}" class="btn btn-pink"><i class="fa fa-times"></i> Unverified</a>
                         
                      <?php }?> 
                      </td>
                    <td>
                       <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit_pharmacy/'.base64_encode($pharmacy['userinfo']['id']) }}"  title="Edit Pharmacy">
                       <i class="fa fa-edit" ></i>
                       </a>  
                       &nbsp;  
                       <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($pharmacy['userinfo']['id'])}}" 
                          onclick="javascript:return confirm_delete()"  title="Delete Pharmacy">
                       <i class="fa fa-trash" ></i>
                       </a> 

                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/show/'.base64_encode($pharmacy['userinfo']['id']) }}"  title="View Pharmacy">
                       <i class="fa fa-eye" ></i>
                       </a>  
                       &nbsp;  
                    </td>
                     @endforeach 
                     @else
                     <tr>
                       <td colspan="11" align="center">
                         <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Sorry!</strong> Currently,no records found.
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
          { "bSortable": false },
          { "bSortable": false },
          { "bSortable": false },
          { "bSortable": false },
          { "bSortable": false },
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


