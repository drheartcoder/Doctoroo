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

              <table class="table table-advance"  id="consultation-table" >
               <thead>
                  <tr> 
                        <th width="10px"></th>
                        <th>Time From</th>
                        <th>Time To</th>
                        <th>Patient Day Cost</th>
                        <th>Doctor Day Fee</th>
                        <th>Day Profit</th>
                        <th>Patient Night Cost</th>
                        <th>Doctor Night Fee</th>
                        <th>Night Profit</th>
                        <th>Action</th>
                         
                  </tr>
               </thead>
               <tbody>
                  @if(count($arr_data)>0)
                     @foreach($arr_data as $info)

                  <tr>
                        <td>
                           <input type="checkbox" 
                              name="checked_record[]"  
                              value="{{ base64_encode($info['price_id']) }}" /> 
                        </td>
                        <!-- <td></td> -->
                        <td>
                           {{isset($info['consultation_time_from'])?$info['consultation_time_from']:'NA'}}
                           
                        </td>
                        <td>
                           {{isset($info['consultation_time_to'])?$info['consultation_time_to']:'NA'}}
                        </td>
                        <td>
                           {{isset($info['patient_day_cost'])?$info['patient_day_cost']:'NA'}}
                        </td>
                        <td>
                           {{isset($info['doctor_day_fee'])?$info['doctor_day_fee']:'NA'}}
                        </td>
                        <td>
                          {{isset($info['day_profit'])?$info['day_profit']:'NA'}}
                        </td>
                        <td>
                           {{isset($info['patient_night_cost'])?$info['patient_night_cost']:'NA'}}
                        </td>
                        <td>
                          {{isset($info['doctor_night_fee'])?$info['doctor_night_fee']:'NA'}}
                        </td>
                        <td>
                        {{isset($info['night_profit'])?$info['night_profit']:'NA'}}
                        </td>
                      
                        <td><a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($info['price_id']) }}"  title="Edit">
                           <i class="fa fa-edit" ></i>
                           </a>  
                           &nbsp;  
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($info['price_id'])}}" 
                              onclick="javascript:return confirm_delete()"  title="Delete">
                           <i class="fa fa-trash" ></i>
                           </a> 
                        </td>
                     </tr>
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
</div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {

       $('#consultation-table').DataTable( {
             "pageLength": 10
          } );
       

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


