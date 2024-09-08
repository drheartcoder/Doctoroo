@extends('admin.layout.master')    
@section('main_content')

<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
</style>
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
      </span> 
      <li><a href="{{ url($admin_panel_slug.'/stripe/connected_accounts') }}">Stripe Details </a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($module_title)?$module_title:"Account Details"}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($module_title)?$module_title:"Account Details" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      @if(count($account_data)>0)

        @php
          $data = [];

          if(isset($doctor_data) && !empty($doctor_data))
          {
            $doc_title = isset($doctor_data['title'])?$doctor_data['title']:'';
            $doc_first = isset($doctor_data['first_name'])?$doctor_data['first_name']:'';
            $doc_last = isset($doctor_data['last_name'])?$doctor_data['last_name']:'';

            $doc_name = $doc_title.' '.$doc_first.' '.$doc_last;
            $doc_status = 'Yes';
          }
          else
          {
            $doc_name = isset($account_data['display_name'])?$account_data['display_name']:'';
            $doc_status = 'No';
          }

          $doc_email        = isset($account_data['email'])?$account_data['email']:'';
          $doc_account_id   = isset($account_data['id'])?$account_data['id']:'';
          $doc_type         = isset($account_data['type'])?$account_data['type']:'';
          $doc_country      = isset($account_data['country'])?$account_data['country']:'';
          $doc_currency     = isset($account_data['default_currency'])?$account_data['default_currency']:'';
          $doc_descriptor   = isset($account_data['statement_descriptor'])?$account_data['statement_descriptor']:'';
          $business_name    = isset($account_data['business_name'])?$account_data['business_name']:'';
          $business_url     = isset($account_data['business_url'])?$account_data['business_url']:'';
          $support_email    = isset($account_data['support_email'])?$account_data['support_email']:'';
          $support_phone    = isset($account_data['support_phone'])?$account_data['support_phone']:'';
          $timezone         = isset($account_data['timezone'])?$account_data['timezone']:'';

          $enc_account_id   = base64_encode($doc_account_id);
        @endphp

      <div class="box-content">
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Personal Details</h3>
                  </div>
                  
                  <div class="box-content">
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ $doc_name }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $doc_email }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     

                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Descriptor</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $doc_descriptor }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                  </div>
               </div>
            </div>

            <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Account Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>

                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Account Id</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ $doc_account_id }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label"> Type</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $doc_type }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     
                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Country</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $doc_country }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Currency</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $doc_currency }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="password2" class="col-xs-3 col-lg-5 control-label">Timezone</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{ $timezone }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Business Details </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-3 col-lg-5 controls">
                          {{ $business_name }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">URL</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-3 col-lg-5 controls">
                          {{ $business_url }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                        {{ $support_email }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Phone</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ $support_phone }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Action</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     
                     <div class="form-group">
                        <!-- <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Delete</label>
                        <div class="col-sm-3 col-lg-1">:</div> -->
                        <div class="col-sm-3 col-lg-8 controls">
                           <a href="{{ url($admin_panel_slug.'/stripe/connected_accounts/delete/'.$enc_account_id) }}" class="btn btn-success" onclick="return confirm('Are you sure you want to delete this account?');" >Delete</a>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <!-- <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Reject</label>
                        <div class="col-sm-3 col-lg-1">:</div> -->
                        <div class="col-sm-3 col-lg-8 controls">
                           <a href="{{ url($admin_panel_slug.'/stripe/connected_accounts/reject/'.$enc_account_id) }}" class="btn btn-success" onclick="return confirm('Are you sure you want to reject this account?');">Reject</a>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
         
         </div>
      </div>
      @endif
   </div>
</div>
<!-- END Main Content --> 
@endsection