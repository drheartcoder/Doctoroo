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
            </span> 
            <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>Details</h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')

                      <form method="post" action="{{ url($module_url_path.'/update')}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">

                      {{ csrf_field() }} 
                       <div class="box-content">
                                    <div class="row">
                                       <!-- <div class="col-md-6 ">
                                         
                                            <div class="form-group">
                                                <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Invited BY&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-5 controls">
                                               {{isset($data_info['userinfo']['roles'][0]['name'])?$data_info['userinfo']['roles'][0]['name']:''}}&nbsp;:&nbsp;-&nbsp;
                                                {{isset($data_info['userinfo']['first_name'])?$data_info['userinfo']['first_name']:''}}&nbsp;{{isset($data_info['userinfo']['last_name'])?$data_info['userinfo']['last_name']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Doctor Name&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    
                                                   {{isset($data_info['reg_doctor_name'])?$data_info['reg_doctor_name']:''}}
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Doctor Phone&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   {{isset($data_info['reg_doctor_phone'])?$data_info['reg_doctor_phone']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Doctor Pratice Name</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   {{isset($data_info['reg_practice_name'])?$data_info['reg_practice_name']:''}}
                                                </div>
                                            </div>
                                       </div> -->
                                        <div class="col-md-6">
                  <!-- BEGIN Left Side -->
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i> Personal Details</h3>
                     </div>
                     <div class="box-content"><br/>
                        <div class="form-group">
                           <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Invited BY</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                             {{isset($data_info['userinfo']['roles'][0]['name'])?$data_info['userinfo']['roles'][0]['name']:''}}&nbsp;:&nbsp;-&nbsp;
                                                {{isset($data_info['userinfo']['first_name'])?$data_info['userinfo']['first_name']:''}}&nbsp;{{isset($data_info['userinfo']['last_name'])?$data_info['userinfo']['last_name']:''}}
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">Doctor Name</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                             {{isset($data_info['reg_doctor_name'])?$data_info['reg_doctor_name']:''}}
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">Doctor Phone</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                              {{isset($data_info['reg_doctor_phone'])?$data_info['reg_doctor_phone']:''}}
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">Doctor Pratice Name</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                              {{isset($data_info['reg_practice_name'])?$data_info['reg_practice_name']:''}}
                           </div>
                        </div>
                       
                       
                        <div class="clearfix"></div>
                        <br/>
                     </div>
                  </div>
               </div>
                                    </div>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                    


       

    <!-- </div> -->
    <!-- END Main Content --> 
@endsection