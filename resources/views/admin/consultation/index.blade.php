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

            {{-- <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
            </a> 
            </div> --}}

          </div>
          <br/>

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="consultation-table" >
               <thead>
                  <tr> 
                  <!-- <th width="10px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th> -->
                      <th>Consultation Id</th>
                      <th>Patient</th>
                      <th>Relationship</th>
                      <th>Doctor</th>
                      <th>Consultation For</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Booking Status</th>
                      <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($arr_consultation_data)>0)
                     @foreach($arr_consultation_data as $key =>  $data)

                  <tr>
                       <!-- <td> <input type="checkbox" name="checked_record[]"  value="{{ base64_encode($data['id']) }}" /></td> -->
                        <td>
                           {{isset($data['consultation_id'])?$data['consultation_id']:'NA'}}
                        </td>
                        <td>
                           {{isset($data['patient_user_details']['first_name'], $data['patient_user_details']['last_name'])?ucfirst($data['patient_user_details']['first_name']).' '.ucfirst($data['patient_user_details']['last_name']):''}}
                        </td>
                        <td>
                           {{-- Check whether User is Patient or not --}}
                           @if($data['family_member_id'] != '0')

                           {{isset($data['familiy_member_info']['first_name'], $data['familiy_member_info']['last_name'])?ucfirst($data['familiy_member_info']['first_name']).' '.ucfirst($data['familiy_member_info']['last_name']):''}}

                           ({{isset($data['familiy_member_info']['relationship'])?ucfirst($data['familiy_member_info']['relationship']):''}})

                           @elseif($data['family_member_id'] == '0')
                           {{ 'Self' }}

                           @endif
                        </td>
                        <td>
                           {{isset($data['doctor_user_details']['first_name'], $data['doctor_user_details']['last_name'])?'Dr. '.ucfirst($data['doctor_user_details']['first_name']).' '.ucfirst($data['doctor_user_details']['last_name']):''}}
                        </td>
                        <td id="info_consultation_for_{{$key}}">
                         <!-- Decrypt Values -->
                         <?php
                               $arr_consult = [];
                               $arr_consult = explode(',',$data['consultation_for']);
                           ?>
                          <script type="text/javascript">
                          var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                          var api           = virgil.API(virgilToken);
                          
                          var dumpSessionId    = '{{isset($data["patient_user_details"]["dump_session"])?$data["patient_user_details"]["dump_session"]:""}}';
                          var dumpId           = '{{isset($data["patient_user_details"]["dump_id"])?$data["patient_user_details"]["dump_id"]:""}}';
                          var inner_key        = '{{ $key }}';
                          var str_consultation_for = trim_str_consultation_for = '';
                           <?php 
                           if(count($arr_consult)>0)
                           {
                              foreach($arr_consult as $_key => $val)
                              {
                                  if($val!='')
                                  {
                           ?>
                                        if(dumpSessionId!='')
                                        {
                                          var consultation_for = '{{$val}}';
                                          var key              = api.keys.import(dumpSessionId);
                                          if(consultation_for!='')
                                          {
                                            var dec_consultation_for     = decrypt(api, consultation_for, key);
                                            
                                            if(dec_consultation_for == 'advice_and_treatment'){
                                              dec_consultation_for = ' Advice & Treatment,';
                                            }
                                            if(dec_consultation_for == 'prescriptions_and_repeats'){
                                              dec_consultation_for = ' Prescription or Repeat,';
                                            }
                                            if(dec_consultation_for == 'medical_cetificate'){
                                              dec_consultation_for = ' Medical Certificate,';
                                            }
                                            if(dec_consultation_for == 'other'){
                                              dec_consultation_for = ' Other,';
                                            }

                                            str_consultation_for += dec_consultation_for;
                                            trim_str_consultation_for = str_consultation_for.replace(/(^,)|(,$)/g, "")
                                          }
                                        }
                           <?php
                                  }
                              }
                           }
                           ?>
                            $('#info_consultation_for_'+inner_key).html(trim_str_consultation_for);
                            function decrypt(api, enctext, key)
                            {
                                var decrpyttext = key.decrypt(enctext);
                                var plaintext = decrpyttext.toString();
                                return plaintext;
                            }
                          </script>
                        </td>
                        <td>
                           <?php $consult_datetime = convert_utc_to_userdatetime(1, "admin", $data['consultation_datetime']); ?>
                            {{($consult_datetime)? date('d-M-Y',strtotime($consult_datetime)):'NA'}}
                        </td>
                        <td>
                         <?php $consult_datetime = convert_utc_to_userdatetime(1, "admin", $data['consultation_datetime']); ?>
                           {{($consult_datetime)? date('h:i a',strtotime($consult_datetime)):'NA'}}
                           <!-- {{($data['consultation_time'])? convert_24_to_12($consult_datetime):'NA'}} -->
                        </td>
                        <td>
                           {{isset($data['booking_status'])?ucfirst($data['booking_status']):'NA'}}
                        </td>
                        <td>
                          {{-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}"  title="View">
                           <i class="fa fa-edit" ></i>
                           </a> --}} 

                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/show/'.base64_encode($data['id']) }}"  title="Show">
                           <i class="fa fa-eye" ></i>
                           </a> 

                           <!-- &nbsp;  
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}" 
                              onclick="javascript:return confirm_delete()"  title="Delete">
                           <i class="fa fa-trash" ></i>
                           </a>  -->
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                     <td colspan="9" align="center">
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
          if( [i].checked==true)
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


