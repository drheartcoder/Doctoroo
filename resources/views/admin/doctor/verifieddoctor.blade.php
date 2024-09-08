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
      <li class="active">{{$module_title}}</li>
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
            {{$module_title}} 
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
                     title="Refresh"   href="{{url($module_url_path)}}/verifieddoctor" style="text-decoration:none;">
                  <i class="fa fa-repeat"></i>
                  </a> 
               </div>
            </div>
            <br/>
            <br>
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">
               <input type="hidden" name="multi_action" value="" />
               <table class="table table-advance"  @if(count($arr_data)>0) id="table_module" @endif >
                  <thead>
                     <tr>
                        <th> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Suburb</th>
                        <th>Date & Time</th>
                        <th>Stripe</th>
                        <th>Status</th>
                        <th>Doctor Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                     @if(count($arr_data)>0)
                     @foreach($arr_data as $key => $info)

                     <tr>
                        <td>
                           <input type="checkbox" 
                              name="checked_record[]"  
                              value="{{ base64_encode($info['userinfo']['id']) }}" /> 
                        </td>
                        <td>
                           {{isset($info['userinfo']['first_name'])?ucfirst($info['userinfo']['first_name']):''}}
                           {{isset($info['userinfo']['last_name'])?ucfirst($info['userinfo']['last_name']):''}}
                        </td>
                        <td>
                           {{isset($info['userinfo']['email'])?$info['userinfo']['email']:''}}
                        </td>
                        <td id="info_mobile_no_{{$key}}">{{isset($info['mobile_no'])?decrypt_value($info['mobile_no']):''}}
                        </td>
                        <td id="info_suburb_{{$key}}">
                        </td>
                        <td>
                          <?php $admin_datetime = convert_utc_to_userdatetime(1, "admin", $info['created_at']); ?>
                          {{isset($admin_datetime)?date('d-M-Y h:i:s a',strtotime($admin_datetime)):''}}
                        </td>
                        <td>
                          @if($info['stripe_connect'] == null)
                          <a class="btn btn-danger no_btn">Not Connected</a>
                          @else
                          <a class="btn btn-success no_btn">Connected</a>
                          @endif
                        </td>
                        <td>
                           @if($info['userinfo']['user_status']=="Active")
                           <a href="{{ $module_url_path.'/deactivate/'.base64_encode($info['userinfo']['id']) }}" class="btn btn-success">Active</a>
                           @else
                           <a href="{{ $module_url_path.'/activate/'.base64_encode($info['userinfo']['id']) }}" class="btn btn-danger">Block</a>
                           @endif
                        </td>
                        <td>
                           @if($info['doctor_status']=="offline")
                           <a href="{{ $module_url_path.'/offline/'.base64_encode($info['userinfo']['id']) }}" class="btn btn-danger" title="Doctor is offline">Offline</a>
                           @else
                           <a href="{{ $module_url_path.'/live/'.base64_encode($info['userinfo']['id']) }}" class="btn btn-success" title="Doctor is live">Live</a>
                           @endif
                        </td>

                        <td><a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($info['userinfo']['id']) }}"  title="Edit">
                           <i class="fa fa-edit" ></i>
                           </a>  
                           &nbsp;  
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($info['userinfo']['id'])}}" 
                              onclick="javascript:return confirm_delete()"  title="Delete">
                           <i class="fa fa-trash" ></i>
                           </a>
                           &nbsp;  
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/show/'.base64_encode($info['userinfo']['id']) }}"  title="View">
                           <i class="fa fa-eye" ></i>
                           </a>
                           &nbsp;  
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/show_fee_schedule/'.base64_encode($info['userinfo']['id']) }}"  title="View Fee Schedule">
                           <i class="fa fa-money" ></i>
                           </a>
                        </td>
                     </tr>

                   <!-- Decrypt Values -->
                   <script type="text/javascript">
                      var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                      var api           = virgil.API(virgilToken);
                      
                      var dumpSessionId = '{{isset($info["userinfo"]["dump_session"])?$info["userinfo"]["dump_session"]:""}}';
                      var dumpId        = '{{isset($info["userinfo"]["dump_id"])?$info["userinfo"]["dump_id"]:""}}';
                      var inner_key     = '{{ $key }}';
                      
                      /*var fname         = "{{isset($info['userinfo']['first_name'])?ucfirst($info['userinfo']['first_name']):''}}";
                      var lname         = "{{isset($info['userinfo']['last_name'])?ucfirst($info['userinfo']['last_name']):''}}";*/
                      var suburb        = "{{isset($info['address'])?$info['address']:''}}";
                      //var mobile_no     = "{{isset($info['mobile_no'])?$info['mobile_no']:''}}";
                      
                      if(dumpSessionId!='')
                      {
                        var key         = api.keys.import(dumpSessionId);
                        /*if(fname!='' && lname!='')
                        {
                          var dec_fname      = decrypt(api, fname, key);
                          var dec_lname      = decrypt(api, lname, key);
                          $('#info_name_'+inner_key).html(dec_fname+' '+dec_lname);
                        }*/
                        
                        if(suburb!='')
                        {
                          var dec_suburb     = decrypt(api, suburb, key);
                          $('#info_suburb_'+inner_key).html(dec_suburb);
                        }
                        
                        /*if(mobile_no!='')
                        {
                          var dec_mobile_no  = decrypt(api, mobile_no, key);
                          $('#info_mobile_no_'+inner_key).html(dec_mobile_no);
                        }*/
                      }

                      function decrypt(api, enctext, key)
                      {
                          var decrpyttext = key.decrypt(enctext);
                          var plaintext = decrpyttext.toString();
                          return plaintext;
                      }
                   </script>

                     @endforeach
                     @else
                     <tr>
                     <td colspan="8" align="center">
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
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
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