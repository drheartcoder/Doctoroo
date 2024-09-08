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
         <div class="row">
            @include('admin.layout._operation_status')
               
               <div class="col-sm-6 col-lg-6">
                   <div class="form-group">
                      <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Discount Code</label>
                      <div class="col-sm-3 col-lg-2">:</div>
                      <div class="col-sm-9 col-lg-5 controls">
                         {{ isset( $membership_discount_code['code']) ? $membership_discount_code['code'] : ''}}
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <br/>

                   <div class="form-group">
                      <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Discount (in %)</label>
                      <div class="col-sm-3 col-lg-2">:</div>
                      <div class="col-sm-9 col-lg-5 controls">
                         {{ isset( $membership_discount_code['percentage']) ? $membership_discount_code['percentage'] : ''}}
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <br/>

                   <div class="form-group">
                      <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Start Expiry Date</label>
                      <div class="col-sm-3 col-lg-2">:</div>
                      <div class="col-sm-9 col-lg-5 controls">
                         {{ isset( $membership_discount_code['start_expiry_date']) ? $membership_discount_code['start_expiry_date'] : ''}}
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <br/>

                   <div class="form-group">
                      <label for="textfield1" class="col-xs-3 col-lg-5 control-label">End Expiry Date</label>
                      <div class="col-sm-3 col-lg-2">:</div>
                      <div class="col-sm-9 col-lg-5 controls">
                         {{ isset( $membership_discount_code['end_expiry_date']) ? $membership_discount_code['end_expiry_date'] : ''}}
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <br/>

                   <div class="form-group">
                      <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Status</label>
                      <div class="col-sm-3 col-lg-2">:</div>
                      <div class="col-sm-9 col-lg-5 controls">
                         {{ isset( $membership_discount_code['status']) ? $membership_discount_code['status'] : ''}}
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <br/>
               </div>

               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <a href="{{ url('/') }}/admin/membership/discount_code/list" id="btn_back" name="btn_back" class="btn btn-success" >Back</a>
                  </div>
               </div>
            </div>
         </div>

         <!-- Doctor List Starts -->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Doctor Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <table class="table table-bordered table table-advance" id="table_module">
                        @if(count($used_discount)>0)
                        <thead>
                           <tr>
                              <th>Title</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email</th>
                              <th>Date of Use</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($used_discount as $used)
                           <tr>
                              <td>{{ ($used['user_details']['title']) ? $used['user_details']['title'] : 'NA' }}</td>
                              <td>{{ ($used['user_details']['first_name']) ? $used['user_details']['first_name'] : 'NA' }}</td>
                              <td>{{ ($used['user_details']['last_name']) ? $used['user_details']['last_name'] : 'NA' }}</td>
                              <td>{{ ($used['user_details']['email']) ? $used['user_details']['email'] : 'NA' }}</td>
                              <td>{{ ($used['created_at']) ? date("d M Y, h:i a", strtotime($used['created_at'])) : 'NA' }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                        @else
                        <div class="alert alert-info alert-dismissible" role="alert" align="center">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <strong>Sorry!</strong> Currently,no records found.
                        </div>
                        @endif
                     </table>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
         </div>
         <!-- Doctor List Ends -->

      </div>
   </div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('#btn_save').click(function(){
      var discount_code = $('#discount_code').val();
      var percentage    = $('#percentage').val();
      var start_day     = $('#start_day').val();
      var start_month   = $('#start_month').val();
      var start_year    = $('#start_year').val();
      var end_day       = $('#end_day').val();
      var end_month     = $('#end_month').val();
      var end_year      = $('#end_year').val();
      var status        = $('#status').val();

      var start_date    = start_year + '-' + start_month + '-' + start_day;
      var end_date      = end_year + '-' + end_month + '-' + end_day;
      
      if ($.trim(discount_code) == '') {
          $('#err_discount_code').show();
          $('#discount_code').focus();
          $('#err_discount_code').html('Please enter discount code');
          $('#err_discount_code').fadeOut(8000);
          return false;
      }
      if ($.trim(percentage) == '') {
          $('#err_percentage').show();
          $('#percentage').focus();
          $('#err_percentage').html('Please select percentage');
          $('#err_percentage').fadeOut(8000);
          return false;
      }
      if ($.trim(start_day) == '' || $.trim(start_month) == '' || $.trim(start_year) == '') {
          $('#err_start_expiry_date').show();
          $('#err_start_expiry_date').html('Please select start expiry date');
          $('#err_start_expiry_date').fadeOut(8000);
          return false;
      }
      if ($.trim(end_day) == '' || $.trim(end_month) == '' || $.trim(end_year) == '') {
          $('#err_end_expiry_date').show();
          $('#err_end_expiry_date').html('Please select end expiry date');
          $('#err_end_expiry_date').fadeOut(8000);
          return false;
      }
      if(Date.parse(start_date) >= Date.parse(end_date)) {
          $('#err_end_expiry_date').show();
          $('#err_end_expiry_date').html('End date should not be equal or should be greater than start date');
          $('#err_end_expiry_date').fadeOut(8000);
          return false;
      }
      if ($.trim(status) == '') {
          $('#err_status').show();
          $('#status').focus();
          $('#err_status').html('Please select status');
          $('#err_status').fadeOut(8000);
          return false;
      }
  });
});
</script>
@stop                    
