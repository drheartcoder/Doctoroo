@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
   <style>
      .star,.err{ color:red; }

/*
      .multiselect {
           width: 200px;
         }
*/

         .selectBox {
           position: relative;
         }

         .selectBox select {
           width: 100%;
           font-weight: bold;
         }

         .overSelect {
           position: absolute;
           left: 0;
           right: 0;
           top: 0;
           bottom: 0;
         }

         #lang_checkboxes {
           display: none;
           border: 1px #dadada solid;
         }

         #lang_checkboxes label {
           display: block;
         }

         #lang_checkboxes label:hover {
           background-color: #1e90ff;
         }

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
         <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
      </ul>
   </div>
   <!-- END Breadcrumb -->
   <!-- BEGIN Main Content -->
   <div class="row">
      <form method="post" action="{{$module_url_path.'/update/'.base64_encode($data_info['userinfo']['id'])}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
         <div class="col-md-12">
            <div class="box box-blue">
               <div class="box-title">
                  <h3><i class="fa fa-file"></i>Edit Doctor Details</h3>
                  <div class="box-tool">
                  </div>
               </div>
               <div class="box-content">
                  @include('admin.layout._operation_status')
                     {{ csrf_field() }} 
                     <div class="row hidden-xs">
                        <div class="col-md-12">
                           <!-- <div class="box box-green"> -->
                           <div class="box-title">
                              <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                              <div class="box-tool">
                                 <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                 <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                              </div>
                           </div>
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-md-6 ">
                                    <div class="box box-gray">
                                       <div class="box-title">
                                          <h3><i class="fa fa-puzzle-piece"></i> About Yourself</h3>
                                       </div>
                                       <br>
                                       <div class="form-group">
                                          <label for="password1" class="col-xs-3 col-lg-4 control-label">First Name<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="first_name" id="first_name" value="{{isset($data_info['userinfo']['first_name'])?$data_info['userinfo']['first_name']:''}}" placeholder="First Name" class="form-control">
                                             <div class="err" id="err_fname">{{ $errors->first('first_name') }}</div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="password1" class="col-xs-3 col-lg-4 control-label">Last Name<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="last_name" id="last_name" value="{{isset($data_info['userinfo']['last_name'])?$data_info['userinfo']['last_name']:''}}" placeholder="Last Name" class="form-control">
                                             <div class="err" id="err_lname">{{ $errors->first('last_name') }}</div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="textfield1" class="col-xs-3 col-lg-4 control-label">Title<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <select class="form-control" name="title" id="title">
                                                <option value="">Select Title</option>
                                                @if(isset($arr_prefix) && sizeof($arr_prefix)>0)
                                                @foreach($arr_prefix as $prefix)
                                                @if($prefix['name']!='')
                                                <option value="{{ $prefix['name'] }}" 
                                                @if(isset($data_info['userinfo']['title']) && $data_info['userinfo']['title']==$prefix['name'])
                                                selected="selected" 
                                                @endif>{{ $prefix['name'] }}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                             </select>
                                             <div class="err" id="err_title"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="password1" class="col-xs-3 col-lg-4 control-label">Gender<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <select name="gender" class="form-control" id="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" @if($data_info['gender'] && $data_info['gender'] == 'Male')
                                                selected="selected"
                                                @endif >Male</option>
                                                <option value="Female"  @if($data_info['gender'] && $data_info['gender'] == 'Female')
                                                selected="selected"
                                                @endif>Female</option>
                                             </select>
                                             <span class="error_msg" style="color:#ff0000;"></span>
                                             <div class="err" id="err_gender">{{ $errors->first('gender') }}</div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="dob" class="col-xs-3 col-lg-4 control-label">Date of Birth<span class="star">*</span></label>
                                          {{-- <div class="col-sm-9 col-lg-8 controls">
                                                <input type="text" name="dob" id="dob" value="{{isset($data_info['dob'])?$data_info['dob']:''}}" placeholder="Enter Date of Birth" class="form-control">
                                                <div class="err" id="err_dob"></div>
                                          </div> --}}
                                          @php 
                                                $arr_months = array(1=>'Jan',
                                                                    2=>'Feb',
                                                                    3=>'March',
                                                                    4=>'April',
                                                                    5=>'May',
                                                                    6=>'June',
                                                                    7=>'July',
                                                                    8=>'Aug',
                                                                    9=>'Sep',
                                                                    10=>'Oct',
                                                                    11=>'Nov',
                                                                    12=>'Dec'); 
                                          @endphp

                                          @php $day=$months=$year="";
                                                if(isset($data_info['dob']) && $data_info['dob']!='0000-00-00')
                                                {
                                                
                                                    list($year,$months,$day) = explode('-',$data_info['dob']);
                                                } 
                                          @endphp
<!--                                           <div class="form-group">-->
                                                <div class="col-sm-9 col-lg-2 controls">
                                                   <select tabindex="1" name="day" id="day" class="form-control">
                                                      <option value="">-Day-</option>
                                                      <?php for($i=1;$i<=31;$i++)
                                                         { ?>
                                                      <option @if($day!="" && $i==$day) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                                      <?php } ?>
                                                   </select>
                                                   <div class="err" id="err_day">{{ $errors->first('day') }}</div>
                                                </div>
                                                <div class="col-sm-9 col-lg-3 controls">
                                                   <select tabindex="1" name="month" id="month" class="form-control">
                                                      <option value="">-Month-</option>
                                                      @if(count($arr_months)>0)
                                                      @foreach($arr_months as $key=>$month)
                                                      <option @if($months!="" && $key==$months) selected="selected" @endif value="{{$key}}">{{$month}}</option>
                                                      @endforeach
                                                      @endif
                                                   </select>
                                                   <div class="err" id="err_date_of_month">{{ $errors->first('month') }}</div>
                                                </div>
                                                <div class="col-sm-9 col-lg-3 controls">
                                                   <select tabindex="1" name="year" id="year" class="form-control">
                                                      <option value="">-Year-</option>
                                                      <?php $current_year = date('Y');
                                                         for($i=1969;$i<=$current_year;$i++)
                                                         { ?>
                                                      <option @if($year!="" && $i==$year) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                                      <?php } ?>
                                                   </select>
                                                   <div class="err" id="err_date_of_year">{{ $errors->first('year') }}</div>
                                                </div>
<!--                                          </div>-->
                                          <div class="clearfix"></div>
                                       </div>
                                       <div class="form-group">
                                          <label for="citizenship" class="col-xs-3 col-lg-4 control-label">Citizen<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <select class="form-control" name="citizenship" id="citizenship">
                                                    <option value="" disabled selected>Are you Australian Citizen or Permanent Citizen</option>
                                                   <option value="Australian Citizen" {{isset($data_info['citizenship']) && $data_info['citizenship'] == 'Australian Citizen' ? 'selected' : '' }}>Australian Citizen</option>
                                                   <option value="Permanent Citizen"  {{isset($data_info['citizenship']) && $data_info['citizenship'] == 'Permanent Citizen' ? 'selected' : '' }}>Permanent Citizen</option>
                                             </select>
                                             <div class="err" id="err_citizenship">{{ $errors->first('citizenship') }}</div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="email" class="col-xs-3 col-lg-4 control-label">Email<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="email" value="{{isset($data_info['userinfo']['email'])?$data_info['userinfo']['email']:''}}" id="email" placeholder="Email" readonly="true" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="contact_no" class="col-xs-3 col-lg-4 control-label">Contact No.<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                                <input type="text" name="contact_no" id="contact_no" value="" placeholder="Enter Contact No." class="form-control">
                                                <div class="err" id="err_contact_no">{{ $errors->first('contact_no') }}</div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                             <label for="mobile_no" class="col-xs-3 col-lg-4 control-label">Mobile No.<span class="star">*</span></label>
                                             <div class="col-sm-3 col-lg-3 controls">
                                                <select name="mobile_code" class="form-control" id="mobile_code">
                                                      <option value="" selected>Code</option>
                                                      @if(isset($mobcode_data) && !empty($mobcode_data))
                                                          @foreach($mobcode_data as $mobcode)
                                                              <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == $data_info['mobile_code']) selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                                          @endforeach
                                                      @endif
                                                </select> 
                                                <div class="err" id="err_mobile_code">{{ $errors->first('mobile_code') }}</div>
                                             </div>
                                             <div class="col-sm-6 col-lg-5 controls">
                                                   <input type="text" name="mobile_no" id="mobile_no" value="{{isset($data_info['mobile_no'])?decrypt_value($data_info['mobile_no']):''}}" placeholder="Enter Mobile No." class="form-control">
                                                   <div class="err" id="err_mobile_no">{{ $errors->first('mobile_no') }}</div>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="address" class="col-xs-3 col-lg-4 control-label">Address<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="address" id="address" value="" placeholder="Enter Address" class="form-control">
                                             <div class="err" id="err_address">{{ $errors->first('address') }}</div>
                                          </div>
                                          
                                       </div>
                                       <div class="form-group">
                                          <label for="timezone" class="col-xs-3 col-lg-4 control-label">Timezone<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <select class="form-control" data-rule-required="true" name="timezone" id="timezone">
                                                <option value="">Select Timezone</option>
                                                    @if(isset($timezone_data) && !empty($timezone_data))
                                                       @foreach($timezone_data as $timezone)

                                                           <option value="{{ $timezone['id'] }}" {{ $timezone['id'] == $data_info['timezone'] ? 'selected' : '' }}>{{ $timezone['utc_offset'].' '.$timezone['location_name'] }}</option>

                                                       @endforeach
                                                   @endif
                                             </select>
                                             <div class="err" id="err_timezone">{{ $errors->first('timezone') }}</div>
                                          </div>
                                       </div>
                                       <!-- END Left Side -->
                                    </div>
                                 </div>
                                 <div class="col-md-6 ">
                                    <div class="box box-gray">
                                       <div class="box-title">
                                          <h3><i class="fa fa-puzzle-piece"></i>Your Medical Practice</h3>
                                       </div>
                                       <br>
                                       <div class="form-group">
                                          <label for="textfield2" class="col-xs-3 col-lg-4 control-label">Practice/Clinic Name<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="clinic_name" value="{{isset($data_info['clinic_name'])?$data_info['clinic_name']:''}}" id="clinic_name" placeholder="Enter Practice/Clinic Name" class="form-control">
                                             <div class="err" id="err_clinic_name"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="textarea2" class="col-xs-3 col-lg-4 control-label">Address<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <textarea name="clinic_address" id="clinic_address" placeholder="Enter Address" class="form-control"></textarea>
                                             <div class="err" id="err_clinic_address"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="textfield2" class="col-xs-3 col-lg-4 control-label">Email<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="clinic_email" readonly="true" value="" id="clinic_email" placeholder="Email" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="clinic_contact_no" class="col-xs-3 col-lg-4 control-label">Contact No.</label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <input type="text" name="clinic_contact_no" value="" id="clinic_contact_no" placeholder="Enter contact no." class="form-control">
                                             <div class="err" id="err_clinic_contact_no"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                             <label for="clinic_mobile_no" class="col-xs-3 col-lg-4 control-label">Mobile No.</label>
                                             <div class="col-sm-3 col-lg-3 controls">
                                                <select name="clinic_mobile_no_code" class="form-control" id="clinic_mobile_no_code">
                                                      <option value="" selected>Code</option>
                                                      @if(isset($mobcode_data) && !empty($mobcode_data))
                                                          @foreach($mobcode_data as $mobcode)
                                                              <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == $data_info['clinic_mobile_no_code']) selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                                          @endforeach
                                                      @endif
                                                </select> 
                                             </div>
                                             <div class="col-sm-6 col-lg-5 controls">
                                                   <input type="text" name="clinic_mobile_no" id="clinic_mobile_no" value="" placeholder="Enter Mobile No." class="form-control">
                                                   <div class="err" id="err_clinic_mobile_no"></div>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="password1" class="col-xs-3 col-lg-4 control-label">Experience<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <select class="form-control" data-rule-required="true" name="experience" id="experience">
                                                <option value="">Practicing Experience (in year)</option>
                                                @for($i=0;$i<=99;$i++)
                                                <option value="{{ $i or ''}}" @if(isset($data_info['experience']) && $data_info['experience']==$i) 
                                                selected="selected" 
                                                @endif
                                                >{{ $i  or '' }}</option>
                                                @endfor
                                             </select>
                                             <div class="err" id="err_experience"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="password1" class="col-xs-3 col-lg-4 control-label">Spoken Languages<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <div class="multiselect">
                                                 <div class="selectBox" onclick="showlang_checkboxes()">
                                                   <select class="form-control">
                                                     <option value="">Select an option</option>
                                                   </select>
                                                   <input type="hidden" id="sel_languages" name="sel_languages" value="{{$data_info['language']}}">
                                                   <div class="overSelect"></div>
                                                 </div>
                                                 <div id="lang_checkboxes">
                                                      @if(isset($arr_language) && sizeof($arr_language)>0)
                                                         @php $checked = ""; @endphp
                                                         @foreach($arr_language as $prefix)
                                                            @if($prefix['language']!='')
                                                               @if(isset($data_info['language']) && !empty($data_info['language']))
                                                                  @php
                                                                     $sel_languages = explode(',', $data_info['language']);
                                                                     if(in_array($prefix['id'], $sel_languages))
                                                                     {
                                                                        $checked = 'checked';
                                                                     }
                                                                     else
                                                                     {
                                                                        $checked = '';
                                                                     }

                                                                  @endphp
                                                               @endif
                                                               <label for="language_{{$prefix['id']}}">
                                                                  <input type="checkbox" class="language" value="{{$prefix['id']}}" id="language_{{$prefix['id']}}" {{$checked}} />{{ $prefix['language'] }}
                                                               </label>
                                                            @endif
                                                         @endforeach
                                                      @endif
                                                 </div>
                                            </div>

                                             <div class="err" id="err_language"></div>
                                        </div>
                                       </div>
                                       <!-- END Right Side -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--  </div> -->
                        </div>
                     </div>
               </div>
            </div>
         </div>

         <div class="col-md-12">
            <div class="box box-blue">
                  <div class="box-content">
                           {{ csrf_field() }} 
                           <div class="row hidden-xs">
                              <div class="col-md-12">
                                    <!-- <div class="box box-green"> -->
                                    <div class="box-title">
                                       <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                                       <div class="box-tool">
                                          <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                          <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                       </div>
                                    </div>
                                    <div class="box-content" id="medical_documents_block">
                                          <div class="row">
                                                <div class="col-md-6 ">
                                                      <div class="box box-gray">
                                                            <div class="box-title">
                                                               <h3><i class="fa fa-puzzle-piece"></i>Your Medical Qualifications</h3>
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                  <label for="medical_qualification" class="col-xs-3 col-lg-4 control-label">Primary Medical Qualification (AMC Recognised)<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="medical_qualification" id="medical_qualification" value="" placeholder="Enter medical qualification" class="form-control">
                                                                        <div class="err" id="err_medical_qualification"></div>
                                                                  </div>
                                                            </div>

                                                            <div class="form-group">
                                                                  <label for="medical_school" class="col-xs-3 col-lg-4 control-label">Medical School<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="medical_school" id="medical_school" value="{{ isset($data_info['medical_school']) ? $data_info['medical_school'] : '' }}" placeholder="Please enter medical school name" class="form-control">
                                                                        <div class="err" id="err_medical_school"></div>
                                                                  </div>
                                                            </div>

                                                            <div class="form-group">
                                                                  <label for="year_obtained" class="col-xs-3 col-lg-4 control-label">Year Obtained<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="year_obtained" id="year_obtained" value="{{ isset($data_info['year_obtained']) ? $data_info['year_obtained'] : '' }}" placeholder="Enter year obtained" class="form-control">
                                                                        <div class="err" id="err_year_obtained"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="country_obtained" class="col-xs-3 col-lg-4 control-label">Country Obtained<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="country_obtained" id="country_obtained" value="{{ isset($data_info['country_obtained']) ? $data_info['country_obtained'] : '' }}" placeholder="Enter country obtained" class="form-control">
                                                                        <div class="err" id="err_country_obtained"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="other_qualifications" class="col-xs-3 col-lg-4 control-label">Other Related Qualification<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="other_qualifications" id="other_qualifications" value="{{ isset($data_info['other_qualifications']) ? $data_info['other_qualifications'] : '' }}" placeholder="Enter other medical qualification" class="form-control">
                                                                        <div class="err" id="err_other_qualifications"></div>
                                                                  </div>
                                                            </div>

                                                            
                                                            <label for="other_qualifications" class="col-xs-3 col-lg-4 control-label">Bank Account Details</label>
                                                            <div class="clearfix"></div>
                                                            <br>

                                                             <div class="form-group">
                                                                  <label for="bank_account_name" class="col-xs-3 col-lg-4 control-label">Bank Name<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input bank_account_name="text" name="bank_account_name" id="bank_account_name" value="" placeholder="Enter bank name" class="form-control">
                                                                        <div class="err" id="err_bank_account_name"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="bsb" class="col-xs-3 col-lg-4 control-label">BSB<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="bsb" id="bsb" value="" placeholder="Enter BSB" class="form-control">
                                                                        <div class="err" id="err_bsb"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="account_number" class="col-xs-3 col-lg-4 control-label">Account Number<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="account_number" id="account_number" value="" placeholder="Enter account number" class="form-control">
                                                                        <div class="err" id="err_account_number"></div>
                                                                  </div>
                                                            </div>
                                                            <!-- END Right Side -->
                                                      </div>
                                                </div>
                                                 @if(isset($data_info) && !empty($data_info))
                                                   @php
                                                       $id_proof_file              = isset($data_info['id_proof_file'])?$data_info['id_proof_file']:'';
                                                       $medical_registration_no    = isset($data_info['medical_registration_no'])?$data_info['medical_registration_no']:'';
                                                       $medicare_provider_no       = isset($data_info['medicare_provider_no'])?$data_info['medicare_provider_no']:'';
                                                       $prescriber_no              = isset($data_info['prescriber_no'])?$data_info['prescriber_no']:'';
                                                       $ahpra_registration_no      = isset($data_info['ahpra_registration_no'])?$data_info['ahpra_registration_no']:'';
                                                       $abn                        = isset($data_info['abn'])?$data_info['abn']:'';
                                                       $pi_insurance_policy        = isset($data_info['pi_insurance_policy'])?$data_info['pi_insurance_policy']:'';
                                                       $medical_registration_certificate = isset($data_info['medical_registration_certificate'])?$data_info['medical_registration_certificate']:'';
                                                       $cyber_liability_insurance_policy = isset($data_info['cyber_liability_insurance_policy'])?$data_info['cyber_liability_insurance_policy']:'';
                                                   @endphp
                                                 @endif                                                

                                                <div class="col-md-6 ">
                                                      <div class="box box-gray">
                                                            <div class="box-title">
                                                               <h3><i class="fa fa-puzzle-piece"></i> Official Documents & Verification</h3>
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                               <label for="id_proof_file" class="col-xs-3 col-lg-4 control-label">Drivers Licence Certificate Or Australian Passport </label>
                                                               <div class="col-sm-9 col-lg-8 controls">
                                                                     <div>
                                                                           <div class="btn btn-primary btn-file remove" style="display:none;">
                                                                              <a class="file" ><i class="fa fa-trash"></i></a>
                                                                           </div>
                                                                           <input class="file" type="file" name="id_proof_file" id="id_proof_file" value="Upload"> 
                                                                           <div class="err" id="err_id_proof_file">
                                                                                 @if(Session::has('id_proof_error') && !empty(Session::get('id_proof_error')))
                                                                                       <input type="hidden" value="{{Session::get('id_proof_error')}}" id="id_proof_error_field">
                                                                                    {{Session::get('id_proof_error')}}
                                                                                 @endif
                                                                           </div>
                                                                     </div>
                                                                     <i><b>Note:</b>Supported file types jpg, jpeg, png, gif, bmp, txt, pdf, csv, doc, docx ,xlsx. </i> 
                                                                     <div id="err_ahpra"></div>

                                                                     @if(isset($data_info['id_proof_file']) && $data_info['id_proof_file']!='' && File::exists($doc_id_proof_public.$data_info['id_proof_file']))
                                                                        <a href="" id="dec_id_proof_file" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                        </a>
                                                                     @endif
                                                               </div>
                                                            </div>

                                                            <div class="form-group">
                                                                  <label for="medical_registration_no" class="col-xs-3 col-lg-4 control-label">Medical Registration Number<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="medical_registration_no" id="medical_registration_no" value="" placeholder="Enter medical registration number" class="form-control">
                                                                        <div class="err" id="err_medical_registration_no"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="password2" class="col-xs-3 col-lg-4 control-label">Current Medical Registration Certificate</label>
                                                               <div class="col-sm-9 col-lg-8 controls">
                                                                     <div>
                                                                           <div class="btn btn-primary btn-file remove" style="display:none;" id="medical_registration_certificate_box">
                                                                              <a class="file" ><i class="fa fa-trash"></i>
                                                                              </a>
                                                                           </div>
                                                                           <input class="file" type="file" id="medical_registration_certificate" name="medical_registration_certificate" value="Upload"> 
                                                                           <div class="err" id="err_medical_registration_certificate">
                                                                              @if(Session::has('medical_registration_certificate_error') && !empty(Session::get('medical_registration_certificate_error')))
                                                                                       <input type="hidden" value="{{Session::get('medical_registration_certificate_error')}}" id="medical_registration_certificate_error_field">
                                                                                    {{Session::get('medical_registration_certificate_error')}}
                                                                                 @endif
                                                                           </div>
                                                                     </div>
                                                                     <i><b>Note:</b>Supported file type JPG, JPEG ,PDF,DOC. </i> 
                                                                     <div id="err_ahpra"></div>
                                                                     @if(isset($data_info['medical_registration_certificate']) && $data_info['medical_registration_certificate']!='' && File::exists($doc_med_reg_public.$data_info['medical_registration_certificate']))
                                                                        <a href="" id="dec_medical_registration_certificate_file" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                        </a>
                                                                     @endif
                                                               </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="medicare_provider_no" class="col-xs-3 col-lg-4 control-label">Medicare Provider Number<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="medicare_provider_no" id="medicare_provider_no" value="" placeholder="Enter medicare provider number" class="form-control">
                                                                        <div class="err" id="err_medicare_provider_no"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="prescriber_no" class="col-xs-3 col-lg-4 control-label">Prescriber Number<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="prescriber_no" id="prescriber_no" value="" placeholder="Enter prescriber number" class="form-control">
                                                                        <div class="err" id="err_prescriber_no"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="ahpra_registration_no" class="col-xs-3 col-lg-4 control-label">AHPRA Registration Number<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="ahpra_registration_no" id="ahpra_registration_no" value="" placeholder="Enter AHPRA registration number" class="form-control">
                                                                        <div class="err" id="err_ahpra_registration_no"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="abn" class="col-xs-3 col-lg-4 control-label">ABN<span class="star">*</span></label>
                                                                  <div class="col-sm-9 col-lg-8 controls">
                                                                        <input type="text" name="abn" id="abn" value="{{ isset($data_info['abn']) ? $data_info['abn'] : '' }}" placeholder="Enter ABN" class="form-control">
                                                                        <div class="err" id="err_abn"></div>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="pi_insurance_policy" class="col-xs-3 col-lg-4 control-label">PI Insurance Policy Cover </label>
                                                               <div class="col-sm-9 col-lg-8 controls">
                                                                     <div>
                                                                           <div class="btn btn-primary btn-file remove" style="display:none;">
                                                                              <a class="file" ><i class="fa fa-trash"></i></a>
                                                                           </div>
                                                                           <input class="file" type="file" name="pi_insurance_policy" id="pi_insurance_policy" value="Upload"> 
                                                                     </div>
                                                                     <i><b>Note:</b>Supported file types jpg, jpeg, png, gif, bmp, txt, pdf, csv, doc, docx ,xlsx. </i> 
                                                                     <div id="err_ahpra"></div>

                                                                     @if(isset($data_info['pi_insurance_policy']) && $data_info['pi_insurance_policy']!='' && File::exists($doc_ins_pol_public.$data_info['pi_insurance_policy']))
                                                                        <a href="{{$doc_ins_pol.$data_info['pi_insurance_policy']}}" id="dec_pi_insurance_policy" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                        </a>
                                                                     @endif
                                                                     <div class="err" id="err_pi_insurance_policy">
                                                                        @if(Session::has('pi_insurance_policy_error') && !empty(Session::get('pi_insurance_policy_error')))
                                                                                       <input type="hidden" value="{{Session::get('pi_insurance_policy_error')}}" id="pi_insurance_policy_error_field">
                                                                                    {{Session::get('pi_insurance_policy_error')}}
                                                                           @endif
                                                                     </div>
                                                               </div>
                                                            </div>
                                                            <div class="form-group">
                                                               <label for="cyber_liability_insurance_policy" class="col-xs-3 col-lg-4 control-label">Cyber Liability Insurance Policy Cover </label>
                                                               <div class="col-sm-9 col-lg-8 controls">
                                                                     <div>
                                                                           <div class="btn btn-primary btn-file remove" style="display:none;">
                                                                              <a class="file" ><i class="fa fa-trash"></i></a>
                                                                           </div>
                                                                           <input class="file" type="file" id="cyber_liability_insurance_policy" name="cyber_liability_insurance_policy" value="Upload"> 
                                                                     </div>
                                                                     <i><b>Note:</b>Supported file types jpg, jpeg, png, gif, bmp, txt, pdf, csv, doc, docx ,xlsx. </i> 
                                                                     <div id="err_ahpra"></div>

                                                                     @if(isset($data_info['cyber_liability_insurance_policy']) && $data_info['cyber_liability_insurance_policy']!='' && File::exists($doc_cyb_liabl_public.$data_info['cyber_liability_insurance_policy']))
                                                                        <a href="{{$doc_cyb_liabl.$data_info['cyber_liability_insurance_policy']}}" id="dec_cyber_liability_insurance_policy" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                        </a>
                                                                     @endif
                                                                     <div class="err" id="err_cyber_liability_insurance_policy">
                                                                         @if(Session::has('cyber_liability_error') && !empty(Session::get('cyber_liability_error')))
                                                                                       <input type="hidden" value="{{Session::get('cyber_liability_error')}}" id="cyber_liability_error_field">
                                                                                    {{Session::get('cyber_liability_error')}}
                                                                           @endif
                                                                     </div>
                                                               </div>
                                                            </div>
                                                            <!-- END Left Side -->
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <!--  </div> -->
                              </div>
                  </div>
            </div>
            </div>
         </div>

         <div class="col-md-12">
            <div class="box box-blue">
               <div class="box-content">
                     {{ csrf_field() }} 
                     <div class="row hidden-xs">
                        <div class="col-md-12">
                           <!-- <div class="box box-green"> -->
                           <div class="box-title">
                              <!--   <h3><i class="fa fa-bars"></i> </h3> -->
                              <div class="box-tool">
                                 <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                 <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                              </div>
                           </div>
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-md-6 ">
                                    <div class="box box-gray">
                                       <div class="box-title">
                                          <h3><i class="fa fa-puzzle-piece"></i> Personalize your profile for Patients</h3>
                                       </div>
                                       <br>
                                       <div class="form-group">
                                          <label for="about_me" class="col-xs-3 col-lg-4 control-label">About Me Summary<span class="star">*</span></label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                             <textarea class="form-control" name="about_me" id="about_me"></textarea>
                                             <div class="err" id="err_about_me"></div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="profile_image" class="col-xs-3 col-lg-4 control-label">Photo Of Face </label>
                                           <div class="col-xs-3 col-lg-8 fileupload fileupload-new" data-provides="fileupload">
                                               <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">

                                                       @if(isset($data_info['userinfo']) && !empty($data_info['userinfo']['profile_image']) && File::exists($doc_profile_public.$data_info['userinfo']['profile_image']))
                                                       <img src="{{$doc_profile_pic.$data_info['userinfo']['profile_image']}}" alt="" />
                                                       @endif
                                               </div>
                                               <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                               <div>
                                                   <span class="btn btn-default btn-file" style="height:32px;">
                                                           <span class="fileupload-new">Select Image</span>
                                                           <span class="fileupload-exists">Change</span>
                                                           <input type="file" class="file-input" name="profile_image" id="profile_image"  />
                                                           <input type="hidden" class="form-control" name="image" id="oldprofileimage" value="" /> 
                                                   </span>
                                                   <a href="#" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>

                                               </div>
                                               <div class="err" id="err_profile_image"></div>
                                           </div>

                                       </div>

                                       <div class="form-group">
                                          <label for="profile_video" class="col-xs-3 col-lg-4 control-label">Introductory 30 Seconds Video </label>
                                          <div class="col-sm-9 col-lg-8 controls">
                                                <div>
                                                      <div class="btn btn-primary btn-file remove" style="display:none;">
                                                         <a class="file" ><i class="fa fa-trash"></i></a>
                                                      </div>
                                                      <input class="file" type="file" name="profile_video" id="profile_video" value="Upload"> 
                                                      <div class="err" id="err_profile_video"></div>
                                                </div>
                                                <i><b>Note:</b>Supported file types - mp4, ogg, webm. </i> 
                                                @if(isset($data_info['profile_video']) && $data_info['profile_video']!='' && File::exists($doc_video_public.$data_info['profile_video']))
                                                   <video width="320" height="240" controls>
                                                     <source src="{{$doc_video.$data_info['profile_video']}}" type="video/mp4">
                                                   </video>
                                                @endif
                                          </div>
                                       </div>



                                       <div class="form-group">
                                          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-4">
                                             <button style="visibility: hidden;" type="button" id="btn_edit_doctor" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
 
                                             <input type="submit" class="btn btn-primary" name="btn_send_otp" id="btn_send_otp" value="Update">

                                             <button type="submit" class="btn btn-success" id="btn_send_otp_spinner" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button>

                                             <button type="button" onclick="location.href = '{{ $module_url_path }}/verifieddoctor';" class="btn">Cancel</button>
                                          </div>
                                       </div>
                                       
                                       
                                       
                                       
                                       <!-- END Left Side -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--  </div> -->
                        </div>
                     </div>
                  
               </div>
            </div>
      </form>
   </div>

<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="admin_email" id="admin_email" value="{{ $user->email }}">

<!-- Decrypt Values -->
<script type="text/javascript">
 var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
 var api           = virgil.API(virgilToken);
 
 var dumpSessionId = '{{isset($data_info["userinfo"]["dump_session"])?$data_info["userinfo"]["dump_session"]:""}}';
 var dumpId        = '{{isset($data_info["userinfo"]["dump_id"])?$data_info["userinfo"]["dump_id"]:""}}';
 //  About Yourself
 var address        = "{{isset($data_info['address'])?$data_info['address']:''}}";
 //var mobile_no      = "{{isset($data_info['mobile_no'])?$data_info['mobile_no']:''}}";
 var contact_no     = "{{isset($data_info['contact_no'])?$data_info['contact_no']:''}}";

 //  Your Medical Practice
 var clinic_email          = "{{isset($data_info['clinic_email'])?$data_info['clinic_email']:''}}";
 var clinic_address        = "{{isset($data_info['clinic_address'])?$data_info['clinic_address']:''}}";
 var clinic_mobile_no      = "{{isset($data_info['clinic_mobile_no'])?$data_info['clinic_mobile_no']:''}}";
 var clinic_contact_no     = "{{isset($data_info['clinic_contact_no'])?$data_info['clinic_contact_no']:''}}";

 //  Your Medical Qualifications
 var medical_qualification    = "{{isset($data_info['medical_qualification'])?$data_info['medical_qualification']:''}}";
 var bank_account_name        = "{{isset($data_info['bank_account_name'])?$data_info['bank_account_name']:''}}";
 var bsb                      = "{{isset($data_info['bsb'])?$data_info['bsb']:''}}";
 var account_number           = "{{isset($data_info['account_number'])?$data_info['account_number']:''}}"; 

  //  Official Documents & Verification
 var medical_registration_no    = "{{$medical_registration_no}}";
 var medicare_provider_no       = "{{$medicare_provider_no}}";
 var prescriber_no              = "{{$prescriber_no}}";
 var ahpra_registration_no      = "{{$ahpra_registration_no}}";

 //  About me
 var about_me    = "{{isset($data_info['about_me'])?$data_info['about_me']:''}}"; 
 
 if(dumpSessionId!='')
 {
   var key         = api.keys.import(dumpSessionId);
   
   //  About Yourself
   if(address!='')
   {
     var dec_address     = decrypt(api, address, key);
     $('#address').val(dec_address);
   }
   
/*   if(mobile_no!='')
   {
     var dec_mobile_no  = decrypt(api, mobile_no, key);
     $('#mobile_no').val(dec_mobile_no);
   }*/

   if(contact_no!='')
   {
     var dec_contact_no  = decrypt(api, contact_no, key);
     $('#contact_no').val(dec_contact_no);
   }

   
   //  Your Medical Practice
   if(clinic_email!='')
   {
     var dec_clinic_email     = decrypt(api, clinic_email, key);
     $('#clinic_email').val(dec_clinic_email);
   }
   
   if(clinic_address!='')
   {
     var dec_clinic_address  = decrypt(api, clinic_address, key);
     $('#clinic_address').val(dec_clinic_address);
   }

   if(clinic_mobile_no!='')
   {
     var dec_clinic_mobile_no  = decrypt(api, clinic_mobile_no, key);
     $('#clinic_mobile_no').val(dec_clinic_mobile_no);
   }

   if(clinic_contact_no!='')
   {
     var dec_clinic_contact_no  = decrypt(api, clinic_contact_no, key);
     $('#clinic_contact_no').val(dec_clinic_contact_no);
   }


   //  Your Medical Qualifications
   if(medical_qualification!='')
   {
     var dec_medical_qualification     = decrypt(api, medical_qualification, key);
     $('#medical_qualification').val(dec_medical_qualification);
   }
   
   if(bank_account_name!='')
   {
     var dec_bank_account_name  = decrypt(api, bank_account_name, key);
     $('#bank_account_name').val(dec_bank_account_name);
   }

   if(bsb!='')
   {
     var dec_bsb  = decrypt(api, bsb, key);
     $('#bsb').val(dec_bsb);
   }

   if(account_number!='')
   {
     var dec_account_number  = decrypt(api, account_number, key);
     $('#account_number').val(dec_account_number);
   }      


   //  Your Medical Qualifications
   if(medical_registration_no!='')
   {
     var dec_medical_registration_no     = decrypt(api, medical_registration_no, key);
     $('#medical_registration_no').val(dec_medical_registration_no);
   }
   
   if(medicare_provider_no!='')
   {
     var dec_medicare_provider_no  = decrypt(api, medicare_provider_no, key);
     $('#medicare_provider_no').val(dec_medicare_provider_no);
   }

   if(prescriber_no!='')
   {
     var dec_prescriber_no  = decrypt(api, prescriber_no, key);
     $('#prescriber_no').val(dec_prescriber_no);
   }

   if(ahpra_registration_no!='')
   {
     var dec_ahpra_registration_no  = decrypt(api, ahpra_registration_no, key);
     $('#ahpra_registration_no').val(dec_ahpra_registration_no);
   }

    var id_proof_file = '{{ $doc_id_proof.$id_proof_file }}';
    var id_proof_file_filename      = '{{ $id_proof_file }}';
    if(id_proof_file_filename!='')
    {
        var xhr = new XMLHttpRequest();
        // this example with cross-domain issues.
        xhr.open( "GET", id_proof_file, true );
        // Ask for the result as an ArrayBuffer.
        xhr.responseType = "blob";
        xhr.onload = function( e ) {
           var api         = virgil.API(virgilToken);
           var key         = api.keys.import(dumpSessionId);
           
          // Obtain a blob: URL for the image data.
          var file = this.response;
          var mime_type = file.type;

          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(file);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);

            var decryptedFile = key.decrypt(fileAsBuffer);
            var blob = new Blob([decryptedFile], { type: mime_type });
            
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL( blob );
            var img = document.querySelector( "#dec_id_proof_file" );
            //img.download = id_proof_file_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var medical_registration_certificate_file = '{{ $doc_med_reg.$medical_registration_certificate }}';

    var medical_registration_certificate_file_filename      = '{{ $medical_registration_certificate }}';
    if(medical_registration_certificate_file_filename!='')
    {
        var xhr = new XMLHttpRequest();
        // this example with cross-domain issues.
        xhr.open( "GET", medical_registration_certificate_file, true );
        // Ask for the result as an ArrayBuffer.
        xhr.responseType = "blob";
        xhr.onload = function( e ) {
           var api         = virgil.API(virgilToken);
           var key         = api.keys.import(dumpSessionId);
           
          // Obtain a blob: URL for the image data.
          var file = this.response;
          var mime_type = file.type;

          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(file);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);

            var decryptedFile = key.decrypt(fileAsBuffer);
            var blob = new Blob([decryptedFile], { type: mime_type });

            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL( blob );
            var img = document.querySelector( "#dec_medical_registration_certificate_file" );
            //img.download = medical_registration_certificate_file_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var pi_insurance_policy_file = '{{ $doc_ins_pol.$pi_insurance_policy }}';
    var filename      = '{{ $pi_insurance_policy }}';

    if(filename!='')
    {
        var xhr = new XMLHttpRequest();
        // this example with cross-domain issues.
        xhr.open( "GET", pi_insurance_policy_file, true );
        // Ask for the result as an ArrayBuffer.
        xhr.responseType = "blob";
        xhr.onload = function( e ) {
           var api         = virgil.API(virgilToken);
           var key         = api.keys.import(dumpSessionId);
           
          // Obtain a blob: URL for the image data.
          var file = this.response;
          var mime_type = file.type;

          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(file);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);

            var decryptedFile = key.decrypt(fileAsBuffer);
            var blob = new Blob([decryptedFile], { type: mime_type });

            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL( blob );
            var img = document.querySelector( "#dec_pi_insurance_policy" );
            //img.download = filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var cyber_liability_insurance_policy = '{{ $doc_cyb_liabl.$cyber_liability_insurance_policy }}';
    var cyber_liability_insurance_policy_filename      = '{{ $cyber_liability_insurance_policy }}';
    if(cyber_liability_insurance_policy_filename!='')
    {
        var xhr = new XMLHttpRequest();
        // this example with cross-domain issues.
        xhr.open( "GET", cyber_liability_insurance_policy, true );
        // Ask for the result as an ArrayBuffer.
        xhr.responseType = "blob";
        xhr.onload = function( e ) {
           var api         = virgil.API(virgilToken);
           var key         = api.keys.import(dumpSessionId);
           
          // Obtain a blob: URL for the image data.
          var file = this.response;
          var mime_type = file.type;

          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(file);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);

            var decryptedFile = key.decrypt(fileAsBuffer);
            var blob = new Blob([decryptedFile], { type: mime_type });
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL( blob );
            var img = document.querySelector( "#dec_cyber_liability_insurance_policy" );
            //img.download = cyber_liability_insurance_policy_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

   //  About Me
   if(about_me!='')
   {
     var dec_about_me     = decrypt(api, about_me, key);
     $('#about_me').val(dec_about_me);
   }   

 }

 function decrypt(api, enctext, key)
 {
     var decrpyttext = key.decrypt(enctext);
     var plaintext = decrpyttext.toString();
     return plaintext;
 }
</script>

@include('admin.otp.otp')
<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="email" id="email" value="{{ $user->email }}">

<script>

    $(document).ready(function(){
      $('#btn_send_otp').click(function(){
         //$('#btn_edit_patient').click();
         var url               = "{{ url('/') }}/admin/patient/send_otp_by_ajax";
         var _token            = $('input[name="_token"]').val();
         $.ajax({
            url: url,
            type: 'POST',        
            data:{_token:_token}, 
            beforeSend: function() 
            {
               $('#btn_send_otp_spinner').show();
               $('#btn_send_otp').hide();
            },
            success: function(res)   
            {
              if(res == 'success'){
               $("#verify_otp").modal('show');    
               $('#btn_send_otp_spinner').hide();
               $('#btn_send_otp').show(); 
              }else{
               alert('somethig went wrong......');
              }        
            }
         });
         return false;
      });
   });
</script>
<script>
    var url = "<?php echo url(''); ?>";
    $(document).ready(function(){

        $('#btn_verify_otp').click(function(){
            
            var otp    = $('#otp').val();
            otp_id     = $('#otp_id').val();
            password   = $('#password').val();
            email      = $('#admin_email').val();
            
            if($('#otp').val()== '' || $('#otp').val() == null)
            {
                $('.otp_err').show();
                $('.otp_err').html("Please enter OTP that is sent on your registered mobile no.");
                $('.otp_err').fadeOut(6000);
                return false;
            }
            else if($('#otp').val().length != 6)
            {
                $('.otp_err').show();
                $('.otp_err').html("Invalid OTP, Must have 6 digits");
                $('.otp_err').fadeOut(4000);
                return false;
            }

            $.ajax({
                url:url+'/admin/verify_otp_by_ajax',
                type:'get',
                data:{
                        otp:otp,
                        otp_id:otp_id,
                        email:email,
                        password:password
                     },
                success:function(res){              
                    if(res.status=="success")
                    { 
                        if(res.msg=='')
                        {
                           $('#btn_edit_doctor').click();
                        }
                        else
                        {
                            $('#admin_error_msg').fadeIn(0, function()
                            {
                                $('#admin_error_msg').html(res.msg);
                            }).delay(6000).fadeOut('slow');
                        }
                    }
                    else if(res.status=="error" && res.msg!='')
                    {
                        $('#admin_error_msg').fadeIn(0, function()
                        {
                          $('#admin_error_msg').html(res.msg);
                        }).delay(6000).fadeOut('slow');
                    }
                }
            });
        });

        $('#btn_resend_otp').click(function(){
            var otp   = $('#otp').val();
            var email = $('#admin_email').val();

            $.ajax({
                url:url+'/admin/resend_otp',
                type:'get',
                data:{otp:otp,email:email},
                success:function(data){
                    $('#otp_id').val(data.otp_id);
                    $('#admin_success_msg').fadeIn(0, function()
                    {
                        $('#admin_success_msg').html(data.msg);
                    }).delay(6000).fadeOut('slow');
                }
            });
        });

        $('#otp').keypress(function(e){
            
            if(e.keyCode == '13')
            {
                e.preventDefault();
                $('#btn_verify_otp').click();
            }
        });
    });
</script>
@include('google_api.google')

<script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>

<script>
   
   $(document).ready(function(){
     var location = "Australia";
     $("#address, #clinic_address").geocomplete({
       details: ".geo-details",
       detailsAttribute: "data-geo",
     });
   });

</script>
   


<script>
   function browseAhpraCertificate() 
       {
           $("#AHPRA_certificate").trigger('click');
       }
        
        function removeAhpraCertificate() {
        $('#AHPRA_certificate_name').val("");
        $("#btn_remove_AHPRA_certificate").hide();
        $("#AHPRA_certificate").val("");
        }
        
        $('#AHPRA_certificate').change(function() 
        {
            if ($(this).val().length > 0) {
                $("#btn_remove_AHPRA_certificate").show();
            }
          
            $('#AHPRA_certificate_name').val($(this).val());
        });
        function browseInsurance() 
        {
           $("#insurance_policy").trigger('click');
        }
        
        function removeInsurance() {
        $('#insurance_policy_name').val("");
        $("#btn_remove_telehealth_certificate").hide();
        $("#telehealth_certificate").val("");
        }
        
        $('#insurance_policy').change(function() 
        {
            if ($(this).val().length > 0) {
                $("#btn_remove_insurance_policy").show();
            }
          
            $('#insurance_policy_name').val($(this).val());
        });
   
        /*Driving licence certificate*/
        function browseDrivingCertificate() 
        {
           $("#driving_certificate").trigger('click');
        }
        
        function removeDrivingCertificate() {
        $('#driving_certificate_name').val("");
        $("#btn_remove_driving_certificate").hide();
        $("#driving_certificate").val("");
        }
        
        $('#driving_certificate').change(function() 
        {
            if ($(this).val().length > 0) {
                $("#btn_remove_driving_certificate").show();
            }
          
            $('#driving_certificate_name').val($(this).val());
        });

   
   $('#btn_edit_doctor').click(function(){
       
       var first_name                = $('#first_name').val();
       var last_name                 = $('#last_name').val();
       var title                     = $('#title').val();
       var gender                    = $('#gender').val();
       var dob                       = $('#dob').val();
       var citizenship               = $('#citizenship').val();
       var contact_no                = $('#contact_no').val();
       var mobile_code               = $('#mobile_code').val();
       var mobile_no                 = $('#mobile_no').val();
       var address                   = $('#address').val();
       var timezone                  = $('#timezone').val();      

       var day                       = $('#day').val(); 
       var month                     = $('#month').val(); 
       var year                      = $('#year').val(); 
       
       var nodigit_regexp= /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
       var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
       var phone_no_filter=/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;


       var clinic_name               = $('#clinic_name').val();
       var clinic_address            = $('#clinic_address').val();
       var clinic_contact_no         = $('#clinic_contact_no').val();
       var clinic_mobile_no          = $('#clinic_mobile_no').val();
       var clinic_mobile_no_code     = $('#clinic_mobile_no_code').val();
       var experience                = $('#experience').val();
       var language                  = $('#language').val();

       var medical_qualification     = $('#medical_qualification').val();
       var medical_school            = $('#medical_school').val();
       var year_obtained             = $('#year_obtained').val();
       var country_obtained          = $('#country_obtained').val();
       var other_qualifications      = $('#other_qualifications').val();
       var bank_account_name         = $('#bank_account_name').val();
       var bsb                       = $('#bsb').val();
       var account_number            = $('#account_number').val();

       var medical_registration_no   = $('#medical_registration_no').val();
       var medicare_provider_no      = $('#medicare_provider_no').val();
       var prescriber_no             = $('#prescriber_no').val();
       var ahpra_registration_no     = $('#ahpra_registration_no').val();
       var abn                       = $('#abn').val();
       var about_me                  = $('#about_me').val();

       var sel_languages = [];
       $('.language').each(function(){

            if($(this).is(':checked'))
            {
               sel_languages.push($(this).val());
            }
       });

       language = sel_languages.toString();

       $('#sel_languages').val(language);
       
       var formData = new FormData($("#validation-form")[0]);
      
      if($.trim(first_name)=="")
       {
          $('#first_name').val('');
          $('#err_fname').fadeIn();         
          $('#err_fname').html('Please enter first name.');
          $('#err_fname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#first_name').focus();
          $(".close").click();
          return false;
       }
       else if(!nodigit_regexp.test(first_name))
       {
          $('#first_name').val('');
          $('#err_fname').fadeIn();
          $('#err_fname').html('Please enter valid first name,only character allowed.');
          $('#err_fname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#first_name').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(last_name)=="")
       {
          $('#last_name').val('');
          $('#err_lname').fadeIn();
          $('#err_lname').html('Please enter last name.');
          $('#err_lname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#last_name').focus();
          $(".close").click();
          return false;
       }
       else if(!nodigit_regexp.test(last_name))
       {
          $('#last_name').val('');
          $('#err_lname').fadeIn();
          $('#err_lname').html('Please enter valid last name,only character allowed.');
          $('#err_lname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#last_name').focus();
          $(".close").click();
          return false;
        }
       if($.trim(title)=="")
       {
          $('#title').val('');
          $('#err_title').fadeIn();         
          $('#err_title').html('Please select title.');
          $('#err_title').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#title').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(gender)=="")
       {
          $('#err_gender').fadeIn();
          $('#err_gender').html('Please select gender.');
          $('#err_gender').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#gender').focus();
          $(".close").click();
          return false;
       }
       if($.trim(day)=="")
       {
          $('#err_day').fadeIn();         
          $('#err_day').html('Please select day.');
          $('#err_day').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $(".close").click();
          return false;
       }
       if($.trim(month)=="")
       {
          $('#err_date_of_month').fadeIn();         
          $('#err_date_of_month').html('Please select month.');
          $('#err_date_of_month').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $(".close").click();
          return false;
       }
       if($.trim(year)=="")
       {
          $('#err_date_of_year').fadeIn();         
          $('#err_date_of_year').html('Please select year.');
          $('#err_date_of_year').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $(".close").click();
          return false;
       }
       if($.trim(citizenship)=="")
       {
          $('#err_citizenship').fadeIn();         
          $('#err_citizenship').html('Please select citizenship.');
          $('#err_citizenship').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#citizenship').focus();
          $(".close").click();
          return false;
       }
       if($.trim(contact_no)=="")
       {
          $('#err_contact_no').fadeIn();         
          $('#err_contact_no').html('Please enter contact no.');
          $('#err_contact_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#contact_no').focus();
          $(".close").click();
          return false;
       }
       if($.trim(mobile_code)=="")
       {
          $('#err_mobile_code').fadeIn();         
          $('#err_mobile_code').html('Select code.');
          $('#err_mobile_code').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile_code').focus();
          $(".close").click();
          return false;
       }if($.trim(mobile_no)=="")
       {
          $('#err_mobile_no').fadeIn();         
          $('#err_mobile_no').html('Please enter mobile no.');
          $('#err_mobile_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile_no').focus();
          $(".close").click();
          return false;
       }
       if($.trim(address)=="")
       {
          $('#err_address').fadeIn();         
          $('#err_address').html('Please enter address.');
          $('#err_address').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#address').focus();
          $(".close").click();
          return false;
       }
       if($.trim(timezone)=="")
       {
          $('#err_timezone').fadeIn();         
          $('#err_timezone').html('Please select timezone.');
          $('#err_timezone').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#timezone').focus();
          $(".close").click();
          return false;
       }

        else if($.trim(clinic_name)=="")
       {
          $('#err_clinic_name').fadeIn();
          $('#err_clinic_name').html('Please enter clinic/practice name.');
          $('#err_clinic_name').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#clinic_name').focus();
          $(".close").click();
          return false;
       }

       else if($.trim(clinic_address)=="")
       {
          $('#err_clinic_address').fadeIn();
          $('#err_clinic_address').html('Please enter clinic address.');
          $('#err_clinic_address').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#clinic_address').focus();
          $(".close").click();
          return false;
       }
       else if(!$.trim(clinic_contact_no).match(onlydigit))
       {
          $('#clinic_contact_no').val('');
          $('#err_clinic_contact_no').fadeIn();
          $('#err_clinic_contact_no').html('Please enter valid contact number.');
          $('#err_clinic_contact_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#clinic_contact_no').focus();
          $(".close").click();
          return false;
       }
       else if(!$.trim(clinic_mobile_no).match(onlydigit))
       {
          $('#clinic_mobile_no').val('');
          $('#err_clinic_mobile_no').fadeIn();
          $('#err_clinic_mobile_no').html('Please enter valid mobile number.');
          $('#err_clinic_mobile_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#clinic_mobile_no').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(experience)=="")
       {
          $('#err_experience').fadeIn();
          $('#err_experience').html('Please select experience in year.');
          $('#err_experience').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#experience').focus();
          $(".close").click();
          return false;
       }
        
       else if($.trim(language)=="")
       {
          $('#err_language').fadeIn();
          $('#err_language').html('Please select languages.');
          $('#err_language').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#language').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(medical_qualification)=="")
       {
          $('#err_medical_qualification').fadeIn();
          $('#err_medical_qualification').html('Please enter medical qualification.');
          $('#err_medical_qualification').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#medical_qualification').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(medical_school)=="")
       {
          $('#err_medical_school').fadeIn();
          $('#err_medical_school').html('Please enter medical school name.');
          $('#err_medical_school').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#medical_school').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(year_obtained)=="")
       {
          $('#err_year_obtained').fadeIn();
          $('#err_year_obtained').html('Please enter year obtained.');
          $('#err_year_obtained').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#year_obtained').focus();
          $(".close").click();
          return false;
       }
        else if($.trim(country_obtained)=="")
       {
          $('#err_country_obtained').fadeIn();
          $('#err_country_obtained').html('Please enter country obtained.');
          $('#err_country_obtained').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#country_obtained').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(other_qualifications)=="")
       {
          $('#err_other_qualifications').fadeIn();
          $('#err_other_qualifications').html('Please enter other qualification.');
          $('#err_other_qualifications').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#other_qualifications').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(bank_account_name)=="")
       {
          $('#err_bank_account_name').fadeIn();
          $('#err_bank_account_name').html('Please enter bank name.');
          $('#err_bank_account_name').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#bank_account_name').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(bsb)=="")
       {
          $('#err_bsb').fadeIn();
          $('#err_bsb').html('Please enter BSB.');
          $('#err_bsb').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#bsb').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(account_number)=="")
       {
          $('#err_account_number').fadeIn();
          $('#err_account_number').html('Please enter account number.');
          $('#err_account_number').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#account_number').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(medical_registration_no)=="")
       {
          $('#err_medical_registration_no').fadeIn();
          $('#err_medical_registration_no').html('Please enter medical registration number.');
          $('#err_medical_registration_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#medical_registration_no').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(medicare_provider_no)=="")
       {
          $('#err_medicare_provider_no').fadeIn();
          $('#err_medicare_provider_no').html('Please enter medical provider number.');
          $('#err_medicare_provider_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#medicare_provider_no').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(prescriber_no)=="")
       {
          $('#err_prescriber_no').fadeIn();
          $('#err_prescriber_no').html('Please enter prescriber number.');
          $('#err_prescriber_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#prescriber_no').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(ahpra_registration_no)=="")
       {
          $('#err_ahpra_registration_no').fadeIn();
          $('#err_ahpra_registration_no').html('Please enter APHRA registration number.');
          $('#err_ahpra_registration_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#ahpra_registration_no').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(abn)=="")
       {
          $('#err_abn').fadeIn();
          $('#err_abn').html('Please enter abn.');
          $('#err_abn').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
            }, 'slow');
          $('#abn').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(about_me)=="")
       {
          $('#err_about_me').fadeIn();
          $('#err_about_me').html('Please enter About Summary.');
          $('#err_about_me').fadeOut(4000);
          $('#about_me').focus();
          $(".close").click();
          return false;
       }

        var api       = virgil.API(virgilToken);
        var findkey   = api.cards.get(dumpId).then(function (cards) {

        //About Yourself
        /*var txtmobile     = encrypt(api, mobile_no, cards);
        if(mobile_no!='')
        {
          var txtmobile_no = encrypt(api, mobile_no, cards);
          formData.append('enc_mobile_no',txtmobile_no);
        }*/
        
        var txtaddress    = encrypt(api, address, cards);
        if(address!='')
        {
          var txtaddress = encrypt(api, address, cards);
          formData.append('enc_address',txtaddress);
        }

        if(contact_no!='')
        {
          var txtcontact_no = encrypt(api, contact_no, cards);
          formData.append('enc_contact_no',txtcontact_no);
        }

        //Official Documents
        if(ahpra_registration_no!='')
        {
          var txtahpra_registration_no      = encrypt(api, ahpra_registration_no, cards);
          formData.append('enc_ahpra_registration_no',txtahpra_registration_no);
        }

        if(medical_registration_no!='')
        {
          var txtmedical_registration_no    = encrypt(api, medical_registration_no, cards);
          formData.append('enc_medical_registration_no',txtmedical_registration_no);
        }

        if(medicare_provider_no!='')
        {
          var txtmedicare_provider_no       = encrypt(api, medicare_provider_no, cards);
          formData.append('enc_medicare_provider_no',txtmedicare_provider_no);
        }

        if(prescriber_no!='')
        {
          var txtprescriber_no              = encrypt(api, prescriber_no, cards);
          formData.append('enc_prescriber_no',txtprescriber_no);
        }

        //Your Medical Practice
        if(clinic_address!='')
        {
          var txtclinic_address      = encrypt(api, clinic_address, cards);
          formData.append('enc_clinic_address',txtclinic_address);
        }

        if(clinic_contact_no!='')
        {
          var txtclinic_contact_no      = encrypt(api, clinic_contact_no, cards);
          formData.append('enc_clinic_contact_no',txtclinic_contact_no);
        }

        if(clinic_mobile_no!='')
        {
          var txtclinic_mobile_no      = encrypt(api, clinic_mobile_no, cards);
          formData.append('enc_clinic_mobile_no',txtclinic_mobile_no);
        }

        //Your Medical Qualifications
        if(medical_qualification!='')
        {
          var txtmedical_qualification      = encrypt(api, medical_qualification, cards);
          formData.append('enc_medical_qualification',txtmedical_qualification);
        }

        if(bank_account_name!='')
        {
          var txtbank_account_name      = encrypt(api, bank_account_name, cards);
          formData.append('enc_bank_account_name',txtbank_account_name);
        }

        if(bsb!='')
        {
          var txtbsb      = encrypt(api, bsb, cards);
          formData.append('enc_bsb',txtbsb);
        }

        if(account_number!='')
        {
          var txtaccount_number      = encrypt(api, account_number, cards);
          formData.append('enc_account_number',txtaccount_number);
        }

        //About me
        if(about_me!='')
        {
          var txtabout_me      = encrypt(api, about_me, cards);
          formData.append('enc_about_me',txtabout_me);
        }        

        $.ajax({
            url:"{{$module_url_path.'/update/'.base64_encode($data_info['userinfo']['id'])}}",
            type:'post',
            data:formData,
            processData: false,
            contentType: false,
            cache:false,
            success:function(data){
              window.location.reload();
            }
        });
        
        }).then(null, function () {
            console.log('Something went wrong.');
        });

        findkey.catch(function(error) {
          console.log(error);
        });

        function encrypt(api, text, cards)
        {
          // encrypt the text using User's cards
          var encryptedMessage = api.encryptFor(text, cards);

          var encData = encryptedMessage.toString("base64");

          return encData;
        }
        
   }); 
   
</script>

<script>
$(document).ready(function(){
   
   $('#profile_video').on('change', function(evt) {

       var videoExtension      = ['mp4','ogg','webm'];
       if($.inArray($(this).val().split('.').pop().toLowerCase(), videoExtension) == -1)
       {
           $('#err_profile_video').show();
           $('#profile_video').focus();
           $('#err_profile_video').html("Please upload valid video with valid extension i.e "+videoExtension.join(', ')+' only.');
           $('#err_profile_video').fadeOut(6000);
           $("#profile_video").val('');
           return false;
       }
       else if(this.files[0].size > 5000000)
       {
           $('#err_profile_video').show();
           $('#profile_video').focus();
           $('#err_profile_video').html('Max size allowed is 5mb.');
           $('#err_profile_video').fadeOut(6000);
           $('#profile_video').val('');
           return false;
       }
   });

   $('#profile_image').on('change', function(evt) {
          var imageExtension      = ['jpg','jpeg','png','gif','bmp'];
          if($.inArray($(this).val().split('.').pop().toLowerCase(), imageExtension) == -1)
          {
              $('#err_profile_image').show();
              $('#profile_image').focus();
              $('#err_profile_image').html("Please upload valid image/document with valid extension i.e "+imageExtension.join(', '));
              $('#err_profile_image').fadeOut(6000);
              $("#profile_image").val('');
              return false;
          }
          else if(this.files[0].size > 5000000)
          {
              $('#err_profile_image').show();
              $('#profile_image').focus();
              $('#err_profile_image').html('Max size allowed is 5mb.');
              $('#err_profile_image').fadeOut(6000);
              $('#profile_image').val('');
              return false;
          }
   });

   var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

   $('#cyber_liability_insurance_policy').on('change', function(evt) {
       var formData = new FormData($("#validation-form")[0]);


          if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              $('#err_cyber_liability_insurance_policy').show();
              $('#cyber_liability_insurance_policy').focus();
              $('#err_cyber_liability_insurance_policy').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
              $('#err_cyber_liability_insurance_policy').fadeOut(6000);
              $("#cyber_liability_insurance_policy").val('');
              return false;
          }
          if(this.files[0].size > 5000000)
          {
              $('#err_cyber_liability_insurance_policy').show();
              $('#cyber_liability_insurance_policy').focus();
              $('#err_cyber_liability_insurance_policy').html('Max size allowed is 5mb.');
              $('#err_cyber_liability_insurance_policy').fadeOut(6000);
              $("#cyber_liability_insurance_policy").val('');
              return false;
          }

          var cyber_liability_file_obj = $(this)[0].files[0];
          var filename  =  $(this).val().split('\\').pop();
          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(cyber_liability_file_obj);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);
            var api       = virgil.API(virgilToken);
            var findkey   = api.cards.get(dumpId).then(function (cards) {
                var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                var blob = new Blob([encryptedFile]);
                var cyber_liability_file = new File([blob], filename);

                formData.append('enc_cyber_liability_file',cyber_liability_file,filename);
            });
          }
   });

   $('#medical_registration_certificate').on('change', function(evt) {
       var formData = new FormData($("#validation-form")[0]);

          if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              $('#err_medical_registration_certificate').show();
              $('#medical_registration_certificate').focus();
              $('#err_medical_registration_certificate').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
              $('#err_medical_registration_certificate').fadeOut(6000);
              $("#medical_registration_certificate").val('');
              return false;
          }
          if(this.files[0].size > 5000000)
          {
              $('#err_medical_registration_certificate').show();
              $('#medical_registration_certificate').focus();
              $('#err_medical_registration_certificate').html('Max size allowed is 5mb.');
              $('#err_medical_registration_certificate').fadeOut(6000);
              $("#medical_registration_certificate").val('');
              return false;
          }
          var medical_registration_certificate_file_obj = $(this)[0].files[0];
          var filename  =  $(this).val().split('\\').pop();
          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(medical_registration_certificate_file_obj);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);
            var api       = virgil.API(virgilToken);
            var findkey   = api.cards.get(dumpId).then(function (cards) {
                var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                var blob = new Blob([encryptedFile]);
                var medical_registration_certificate_file = new File([blob], filename);
                formData.append('enc_medical_registration_certificate_file',medical_registration_certificate_file,filename);
            });
          }
   });

   $('#pi_insurance_policy').on('change', function(evt) {
        var formData = new FormData($("#validation-form")[0]);

          if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              $('#err_pi_insurance_policy').show();
              $('#pi_insurance_policy').focus();
              $('#err_pi_insurance_policy').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
              $('#err_pi_insurance_policy').fadeOut(6000);
              $("#pi_insurance_policy").val('');
              return false;
          }
          if(this.files[0].size > 5000000)
          {
              $('#err_pi_insurance_policy').show();
              $('#pi_insurance_policy').focus();
              $('#err_pi_insurance_policy').html('Max size allowed is 5mb.');
              $('#err_pi_insurance_policy').fadeOut(6000);
              $("#pi_insurance_policy").val('');
              return false;
          }

          var pi_insurance_policy_file_obj = $(this)[0].files[0];
          var filename  =  $(this).val().split('\\').pop();
          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(pi_insurance_policy_file_obj);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);
            var api       = virgil.API(virgilToken);
            var findkey   = api.cards.get(dumpId).then(function (cards) {
                var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                var blob = new Blob([encryptedFile]);
                var pi_insurance_policy_file = new File([blob], filename);

                formData.append('enc_pi_insurance_policy_file',pi_insurance_policy_file,filename);
            });
          }
   });

   $('#id_proof_file').on('change', function(evt) {
        var formData = new FormData($("#validation-form")[0]);

          if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              $('#err_id_proof_file').show();
              $('#id_proof_file').focus();
              $('#err_id_proof_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
              $('#err_id_proof_file').fadeOut(6000);
              $("#id_proof_file").val('');
              return false;
          }
          if(this.files[0].size > 5000000)
          {
              $('#err_id_proof_file').show();
              $('#id_proof_file').focus();
              $('#err_id_proof_file').html('Max size allowed is 5mb.');
              $('#err_id_proof_file').fadeOut(6000);
              $("#id_proof_file").val('');
              return false;
          }
          
          var id_proof_file_obj = $(this)[0].files[0];
          var filename  =  $(this).val().split('\\').pop();
          var fileReader = new FileReader();
          fileReader.readAsArrayBuffer(id_proof_file_obj);
          fileReader.onload = function ()
          {
            var imageData    = fileReader.result;
            var fileAsBuffer = new Buffer(imageData);
            var api       = virgil.API(virgilToken);
            var findkey   = api.cards.get(dumpId).then(function (cards) {
                var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                var blob = new Blob([encryptedFile]);
                var id_proof_file = new File([blob], filename);
                formData.append('enc_id_proof_file',id_proof_file,filename);
            });
          }
   });

   if($('#id_proof_error_field').val() !='' && $('#id_proof_error_field').val() != null)
   {
      $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
      }, 'slow');
   }
   if($('#medical_registration_certificate_error_field').val() !='' && $('#medical_registration_certificate_error_field').val() != null)
   {
      $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
      }, 'slow');
   }
   if($('#pi_insurance_policy_error_field').val() !='' && $('#pi_insurance_policy_error_field').val() != null)
   {
      $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
      }, 'slow');
   }
   if($('#cyber_liability_error_field').val() !='' && $('#cyber_liability_error_field').val() != null)
   {
      $('html, body').animate({
                scrollTop: $('#medical_documents_block').offset().top
      }, 'slow');
   }

});
</script>

<script>
   var expanded = false;

   function showlang_checkboxes() {
     var lang_checkboxes = document.getElementById("lang_checkboxes");
     if (!expanded) {
       lang_checkboxes.style.display = "block";
       expanded = true;
     } else {
       lang_checkboxes.style.display = "none";
       expanded = false;
     }
   }
</script>

<!-- END Main Content --> 
@endsection

