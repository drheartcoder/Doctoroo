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
                    <h3><i class="fa fa-file"></i>Personal Details </h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')

                      <form method="post" action="{{ url($module_url_path.'/update')}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">

                      {{ csrf_field() }} 
                       <div class="box-content">
                                    <div class="row">
                                       <div class="col-md-6 ">
                                          <!-- BEGIN Left Side -->
                                            <div class="form-group">
                                                <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Name&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                {{isset($data_info['userinfo']['title'])?$data_info['userinfo']['title']:''}} &nbsp;&nbsp;{{isset($data_info['userinfo']['first_name'])?$data_info['userinfo']['first_name']:''}}&nbsp;&nbsp;{{isset($data_info['userinfo']['last_name'])?$data_info['userinfo']['last_name']:''}}
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Gender&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                     @if($data_info['gender']=="M")
                                                     Male
                                                     @elseif($data_info['gender']=="F")
                                                     Female
                                                     @else
                                                     Na
                                                     @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Email&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    {{isset($data_info['userinfo']['email'])?$data_info['userinfo']['email']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Date of Birth&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    {{isset($data_info['date_of_birth'])?$data_info['date_of_birth']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-xs-3 col-lg-2 control-label">Mobile No&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                     {{isset($data_info['mobile_no'])?$data_info['mobile_no']:''}}
                                                </div>
                                            </div>
                                            
                                          <!-- END Left Side -->
                                       </div>
                                       <div class="col-md-6 ">
                                          <!-- BEGIN Right Side -->
                                            <div class="form-group">
                                                <label for="textfield2" class="col-xs-3 col-lg-2 control-label">Address&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                  {{isset($data_info['streen_address'])?$data_info['streen_address']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="col-xs-3 col-lg-2 control-label">Country&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                     {{isset($data_info['country'])?$data_info['country']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="col-xs-3 col-lg-2 control-label">State&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    {{isset($data_info['state'])?$data_info['state']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="col-xs-3 col-lg-2 control-label">City&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   {{isset($data_info['city'])?$data_info['city']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="col-xs-3 col-lg-2 control-label">Suburb&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    {{isset($data_info['suburb'])?$data_info['suburb']:''}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="col-xs-3 col-lg-2 control-label">Zipcode&nbsp;:</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   {{isset($data_info['zipcode'])?$data_info['zipcode']:''}}
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>Medicare Details </h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')

                      <form method="post" action="{{ url($module_url_path.'/update')}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">

                      {{ csrf_field() }} 
                       <div class="box-content">
                                    <div class="row">
                                       <div class="col-md-12 ">
                              <!-- BEGIN Left Side -->

                                @if(count($data_medicare)>0)
                                
                              @foreach($data_medicare as $data)
                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Medicare Type&nbsp;:</label>
                                 <div class="col-sm-3 col-lg-3 controls">
                                    {{isset($data['medicare_type'])?$data['medicare_type']:''}}
                                 </div>
                              </div>
                              @if($data['medicare_type']=="Concession")
                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Medicare Card Number&nbsp;:</label>
                                 <div class="col-sm-3 col-lg-3 controls">
                                    {{isset($data['medicare_card_no'])?$data['medicare_card_no']:''}}
                                 </div>
                              </div>
                              <!-- <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Photo of Your Card</label>
                                 <div class="col-sm-3 col-lg-3 controls">
                                   <img src="{{ url('/') }}/public/uploads/{{isset($data['card_image'])?$data['card_image']:"--"}}">
                                 </div>
                              </div> -->
                              @elseif($data['medicare_type']=="Medicare")
                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Medicare Card Number&nbsp;:</label>
                                 <div class="col-sm-9 col-lg-10 controls">
                                    {{isset($data['medicare_card_no'])?$data['medicare_card_no']:''}}
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Individual Reference No&nbsp;:</label>
                                 <div class="col-sm-9 col-lg-10 controls">
                                    {{isset($data['individual_card_no'])?$data['individual_card_no']:''}}
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-2 control-label">Medicare Card Expiry&nbsp;:</label>
                                 <div class="col-sm-9 col-lg-10 controls">
                                    {{isset($data['medicare_card_expiry_month'])?$data['medicare_card_expiry_month']:''}} &nbsp;{{isset($data['medicare_card_expiry_year'])?$data['medicare_card_expiry_year']:''}}
                                 </div>
                              </div>
                              @else
                               <div class="alert alert-info alert-dismissible" role="alert" align="center">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Sorry!</strong> Currently,no records found.
                            </div>
                              @endif
                              @endforeach
                              @else
                       
                             <div class="alert alert-info alert-dismissible" role="alert" align="center">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Sorry!</strong> Currently,no records found.
                            </div>
                    
                              @endif
                              <!-- END Right Side -->
                           </div>
                                
                            </div>
                            </form>
                        </div>
                    
                </div>
            </div>
            

       

    <!-- </div> -->
    <!-- END Main Content --> 
@endsection