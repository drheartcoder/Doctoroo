    @extends('admin.layout.master')
    @section('main_content')
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
                  <div class="col-md-12">
                     <div class="box box-gray">
                        <div class="box-content">
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">ID</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['invoice_no']) ? $membership_arr['invoice_no'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Name</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['userinfo']['title']) ? $membership_arr['userinfo']['title'] : ''}} {{isset($membership_arr['userinfo']['first_name']) ? $membership_arr['userinfo']['first_name'] : ''}} {{isset($membership_arr['userinfo']['last_name']) ? $membership_arr['userinfo']['last_name'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Transaction Id</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                {{isset($membership_arr['transaction_id']) ? $membership_arr['transaction_id'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Membership Plan</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['package']) && $membership_arr['package'] == 'annually' ? 'Annually' : ''}} {{isset($membership_arr['package']) && $membership_arr['package'] == 'monthly' ? 'Monthly' : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Plan Amount</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['amount']) ? '$'.$membership_arr['amount'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">GST Amount</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['gst']) ? '$'.$membership_arr['gst'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Discount Amount</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['discount']) ? '$'.$membership_arr['discount'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Total Amount</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['total_amount']) ? '$'.$membership_arr['total_amount'] : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">Start Date</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                 {{isset($membership_arr['start_date']) ? date('d M Y' , strtotime($membership_arr['start_date'])) : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label class="col-xs-3 col-lg-5 control-label">End Date</label>
                              <div class="col-sm-3 col-lg-2">:</div>
                              <div class="col-sm-9 col-lg-5 controls">
                                  {{isset($membership_arr['end_date']) ? date('d M Y' , strtotime($membership_arr['end_date'])) : ''}}
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                        </div>
                     </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
     
  <!-- END Main Content -->
  @stop
