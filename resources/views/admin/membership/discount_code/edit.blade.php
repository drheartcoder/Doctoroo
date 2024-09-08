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

            @php
            $arr_months = array( 1 => 'Jan',
                                 2 => 'Feb',
                                 3 => 'March',
                                 4 => 'April',
                                 5 => 'May',
                                 6 => 'June',
                                 7 => 'July',
                                 8 => 'Aug',
                                 9 => 'Sep',
                                10 => 'Oct',
                                11 => 'Nov',
                                12 => 'Dec');

            $current_year = date('Y');
            $last_year = date('Y', strtotime("+10 year"));
            @endphp

            <form method="post" action="{{ url($module_url_path.'/discount_code/update/'.base64_encode($membership_discount_code['id'])) }}"  onsubmit="return validateForm()" class="form-horizontal" name="Form" >
               {{ csrf_field() }}
               
               <div class="col-sm-6 col-lg-6">

                   <div class="form-group">
                      <label class="col-sm-3 col-lg-4 control-label" for="discount_code">Discount Code
                      <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-8 controls">
                          <input type="text" name="discount_code" id="discount_code" value="{{ isset( $membership_discount_code['code']) ? $membership_discount_code['code'] : ''}}"  placeholder="Discount Code" class="form-control" data-rule-required="true" data-rule-maxlength="50" readonly>
                         <span id="err_discount_code" style="color:red;">{{ $errors->first('code') }}</span>
                      </div>
                   </div>

                   <div class="form-group">
                      <label class="col-sm-3 col-lg-4 control-label" for="percentage">Discount (in %)
                      <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-8 controls">
                          <select class="form-control" id="percentage" name="percentage">
                            <option value="">-Discount-</option>
                            <?php for( $i = 1; $i <= 100; $i++) { ?>
                            <option value="{{ $i }}" @if($membership_discount_code['percentage'] == $i) selected @endif >{{ $i }}</option>
                            <?php } ?>
                          </select>
                         <span id="err_percentage" style="color:red;">{{ $errors->first('percentage') }}</span>
                      </div>
                   </div>

                  <?php
                  $start_day = $start_months = $start_year = "";
                  if(isset($membership_discount_code['start_expiry_date']) && $membership_discount_code['start_expiry_date']!='0000-00-00')
                  {
                    list($start_year,$start_months,$start_day) = explode('-',$membership_discount_code['start_expiry_date']);
                  }
                  ?>

                   <div class="form-group">
                      <label class="col-sm-3 col-lg-4 control-label" for="start_expiry_date">Start Expiry Date
                      <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-8 controls">

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="start_day" id="start_day" class="form-control">
                                <option value="">-Day-</option>
                                <?php for( $i = 1; $i <= 31; $i++) { ?>
                                <option @if( $start_day != "" && $i == $start_day) selected @endif value="{{ $i }}">{{ $i }}</option>
                                <?php } ?>
                             </select>
                          </div>

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="start_month" id="start_month" class="form-control">
                                <option value="">-Month-</option>
                                @if(count($arr_months)>0)
                                @foreach($arr_months as $key=>$start_month)
                                <option @if($start_months!="" && $key==$start_months) selected @endif value="{{ $key }}">{{ $start_month }}</option>
                                @endforeach
                                @endif
                             </select>
                          </div>

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="start_year" id="start_year" class="form-control">
                                <option value="">-Year-</option>
                                <?php for( $i = $current_year; $i <= $last_year; $i++) { ?>
                                <option @if($start_year!="" && $i==$start_year) selected @endif value="{{ $i }}">{{ $i }}</option>
                                <?php } ?>
                             </select>
                          </div>
                          <br/>
                          <br/>
                         <span id="err_start_expiry_date" style="color:red;">{{ $errors->first('start_expiry_date') }}</span>
                      </div>
                   </div>

                  <?php
                  $end_day = $end_months = $end_year = "";
                  if(isset($membership_discount_code['end_expiry_date']) && $membership_discount_code['end_expiry_date']!='0000-00-00')
                  {
                    list($end_year,$end_months,$end_day) = explode('-',$membership_discount_code['end_expiry_date']);
                  }
                  ?>

                   <div class="form-group">
                      <label class="col-sm-3 col-lg-4 control-label" for="end_expiry_date">End Expiry Date
                      <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-8 controls">

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="end_day" id="end_day" class="form-control">
                                <option value="">-Day-</option>
                                <?php for( $i = 1; $i <= 31; $i++) { ?>
                                <option @if( $end_day != "" && $i == $end_day) selected @endif value="{{ $i }}">{{ $i }}</option>
                                <?php } ?>
                             </select>
                          </div>

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="end_month" id="end_month" class="form-control">
                                <option value="">-Month-</option>
                                @if(count($arr_months)>0)
                                @foreach($arr_months as $key=>$end_month)
                                <option @if($end_months!="" && $key==$end_months) selected @endif value="{{ $key }}">{{ $end_month }}</option>
                                @endforeach
                                @endif
                             </select>
                          </div>

                          <div class="col-sm-9 col-lg-4 controls">
                             <select tabindex="1" name="end_year" id="end_year" class="form-control">
                                <option value="">-Year-</option>
                                <?php for( $i = $current_year; $i <= $last_year; $i++) { ?>
                                <option @if($end_year!="" && $i==$end_year) selected @endif value="{{ $i }}">{{ $i }}</option>
                                <?php } ?>
                             </select>
                          </div>
                          <br/>
                          <br/>
                         <span id="err_end_expiry_date" style="color:red;">{{ $errors->first('end_expiry_date') }}</span>
                      </div>
                   </div>



                   <div class="form-group">
                      <label class="col-sm-3 col-lg-4 control-label" for="status">Status
                      <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-8 controls">
                          <select class="form-control" id="status" name="status">
                            <option value="">-Status-</option>
                            <option value="active" @if($membership_discount_code['status'] == 'active') selected @endif >Active</option>
                            <option value="block" @if($membership_discount_code['status'] == 'block') selected @endif >Deactive</option>
                          </select>
                         <span id="err_status" style="color:red;">{{ $errors->first('status') }}</span>
                      </div>
                   </div>


               </div>

               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <button type="submit" id="btn_save" name="btn_save" class="btn btn-success" >Update</button>
                  </div>
               </div>

            </form>
         </div>
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
