@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">

<style>
   .error
   {
   color:red;
   }
   .err
   {
   color:red;
   }
</style>
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
      <li class=""> <a href="{{ url($admin_panel_slug.'/pharmacy/applications') }}">Pharmacy Applications</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
      </span>
      <li class="active">{{isset($module_title)?$module_title:'Verified Pharmacy Details'}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<form action="{{$module_url_path.'/update/'.base64_encode($arr_pharmacy['id'])}}" method="post" id="frm_pharmacy_edit_id" name="frm_pharmacy_edit_id" enctype="multipart/form-data">
   {{ csrf_field() }}
   <input type="hidden" name="enc_user_id" id="enc_user_id" value="{{ $enc_user_id or '' }}">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3>
               <i class="fa fa-text-width"></i>
               {{isset($module_title)?$module_title:'Update Pharmacy Details'}}
            </h3>
         </div>
         <div class="box-content">
            <div class="col-md-12">
               @include('admin.layout._operation_status')
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i> Contact Information</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">First Name<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="first_name" id="firstname" value="{{ isset($arr_pharmacy['userinfo']['first_name'])?$arr_pharmacy['userinfo']['first_name']:'' }}" id="first_name" class="form-control">
                              <div id="err_first_name" class="error">{{ $errors->first('first_name') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Last Name<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="last_name" id="last_name"  value="{{ isset($arr_pharmacy['userinfo']['last_name'])?$arr_pharmacy['userinfo']['last_name']:'' }}"  class="form-control">
                             <div id="err_last_name" class="error">{{ $errors->first('last_name') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                       
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Contact Role<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <select tabindex="1" name="contact_role" id="contact_role" onchange="showOtherRole(this.value)"  class="form-control">
                                 <option value="">Select Contact Role</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==1) 
                                 selected="" 
                                 @endif value="1">Owner</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==2) 
                                 selected="" 
                                 @endif value="2">Manager</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==3) 
                                 selected="" 
                                 @endif value="3">Assistant Pharmacist</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==4) 
                                 selected="" 
                                 @endif value="4">Pharmacist</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==5) 
                                 selected="" 
                                 @endif value="5">Retail Assistant</option>
                                 <option  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==6) 
                                 selected="" 
                                 @endif value="6">Other</option>
                              </select>
                           <span class='err' id="err_contact_role">{{ $errors->first('contact_role') }}</span>
                           </div>
                           <span class='error'></span>
                           
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group" id="contact_role_div" style="display:none">
                           <label class="col-sm-3 col-lg-5 control-label">Other Role</label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" class="input_acct-logn form-control" value="{{ isset($arr_pharmacy['other_role'])?$arr_pharmacy['other_role']:'' }}"  name="other_role" id="other_role" placeholder="Other Role" />
                              <span class='err' id="err_other_role"></span>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/> 
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Email Id</label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="email_id" readonly="" id="email_id"  value="{{ isset($arr_pharmacy['userinfo']['email'])?$arr_pharmacy['userinfo']['email']:'' }}" class="form-control">
                              <span class='error'>{{ $errors->first('email_id') }}</span>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <!-- <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Logo</label>
                                   <div class="col-sm-9 col-lg-7 controls">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                         <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                         @if(isset($arr_pharmacy['logo']) && file_exists($pharmacy_base_img_path.'/'.$arr_pharmacy['logo']) && $arr_pharmacy['logo']!='')
                                            <img src={{ $pharmacy_public_img_path.'/'.$arr_pharmacy['logo']}} alt="" />
                                           @else
                                             <img src={{ $pharmacy_public_img_path }}/default-image.jpeg alt="" />   
                                         @endif
                                         </div>
                                         <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                         <div>
                                            <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="pharmacy_logo" class="file-input" /></span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                         </div>
                                      </div>
                                    {{--   <span class="label label-important">NOTE!</span>
                                      <span>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span> --}}
                                        <div id="err_logo"></div>
                                   </div>
                           
                           
                           </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i> Pharmacy Details</h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Pharmacy Name<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="pharmacy_name" id="pharmacy_name" value="{{ isset($arr_pharmacy['pharmacy_name'])?$arr_pharmacy['pharmacy_name']:'' }}" class="form-control">
                               <div id="err_pharmacy_name" class="error">{{ $errors->first('pharmacy_name') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Contact Number<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="phone" data-rule-number="true" id="contactnumber" data-parsley-maxlength="10"  data-parsley-minlength="10" value="{{ isset($arr_pharmacy['phone'])?$arr_pharmacy['phone']:'' }}" class="form-control">
                               <div id="err_contact_number" class="error">{{ $errors->first('phone') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Fax</label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" data-rule-number="true" data-rule-minlength="7" data-rule-maxlength="16" name="fax" id="fax" value="{{ isset($arr_pharmacy['fax'])?$arr_pharmacy['fax']:'' }}" class="form-control">
                              <span class='error'>{{ $errors->first('fax') }}</span>
                            <div id="err_fax" class="error"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Address 1<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="address1" id="address" value="{{ isset($arr_pharmacy['address1'])?$arr_pharmacy['address1']:'' }}"  class="form-control">
                              <div id="err_address" class="error">{{ $errors->first('address1') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Address 2</label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <input type="text" name="address2" value="{{ isset($arr_pharmacy['address2'])?$arr_pharmacy['address2']:'' }}" class="form-control">
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i> Pharmacy Details </h3>
                     </div>
                     <div class="box-content">
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-5 control-label">Is the Pharmacy part of a banner group?</label>
                           <div class="col-sm-9 col-lg-7 controls">
                              <label class="radio">
                              <input type="radio"    
                              @if(isset($arr_pharmacy['part_of_banner_group']) && $arr_pharmacy['part_of_banner_group']=="Yes") 
                              checked=""
                              @endif  value="Yes"  id="Radio13" onclick="showOtherField(this.value)" name="part_of_banner_group"/>
                              <label for="Radio13">Yes</label>
                              <div class="check"></div>
                              <input type="radio" 
                              @if(isset($arr_pharmacy['part_of_banner_group']) && $arr_pharmacy['part_of_banner_group']=="No") 
                              checked=""
                              @endif  value="No"   id="Radio14" onclick="showOtherField(this.value)" name="part_of_banner_group"/>
                              <label for="Radio14">No</label>
                              <div class="check">
                                 <div class="inside"></div>
                                 </label>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group" id="other_field" style="display:none">
                              <label class="col-sm-3 col-lg-5 control-label">Other Group</label>
                              <div class="col-sm-9 col-lg-7 controls">
                                 <!-- <input type="text" name="other_group" value="{{ isset($arr_pharmacy['other_group'])?$arr_pharmacy['other_group']:'' }}" class="form-control"> -->
                                 <!-- <select class="frm-select form-control" name="other_group" id="other_group">
                                    <option value="">Select Group</option>
                                    @if(isset($arr_banner) && sizeof($arr_banner)>0)
                                      @foreach($arr_banner as $banner_group)
                                        <option value="{{ $banner_group['id'] }}" @if(isset($arr_pharmacy['other_group']) && $arr_pharmacy['other_group']==$banner_group['id']) selected="" @endif >{{ $banner_group['name'] }}
                                        </option>
                                      @endforeach
                                    @endif
                                    </select> -->
                                 <select class="frm-select form-control" name="other_group" id="other_group">
                                    <option value="">Select Group</option>
                                    @if(isset($arr_banner) && sizeof($arr_banner)>0)
                                    @foreach($arr_banner as $banner_group)
                                    <option value="{{ $banner_group['id'] }}" @if(isset($arr_pharmacy['other_group']) && $arr_pharmacy['other_group']==$banner_group['id']) selected="" @endif >{{ $banner_group['name'] }}
                                    </option>
                                    @endforeach
                                    @endif
                                 </select>
                                 <div id="err_other_group" class="error"></div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-5 control-label">Logo</label>
                              <div class="col-sm-9 col-lg-7 controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                       @if(isset($arr_pharmacy['logo']) && file_exists($pharmacy_base_img_path.'/'.$arr_pharmacy['logo']) && $arr_pharmacy['logo']!='')
                                       <img src={{ $pharmacy_public_img_path.'/'.$arr_pharmacy['logo']}} alt="" />
                                       @else
                                       <img src={{ $pharmacy_public_img_path }}/default-image.jpeg alt="" />   
                                       @endif
                                    </div>
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="pharmacy_logo" class="file-input" /></span>
                                       <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                 {{--   <span class="label label-important">NOTE!</span>
                                 <span>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span> --}}
                                 <div id="err_logo"></div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-5 control-label">Website URL</label>
                              <div class="col-sm-9 col-lg-7 controls">
                                 <input type="text" name="website" id="url" value="{{ isset($arr_pharmacy['website'])?$arr_pharmacy['website']:'' }}"  class="form-control">
                              <div id="err_website"></div>
                              <div id="err_url" class="error"></div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label class="col-sm-3 col-lg-5 control-label">Pharmacy ABN</label>
                              <div class="col-sm-9 col-lg-7 controls">
                                 <input type="text" name="ABN"  id="abn" value="{{ isset($arr_pharmacy['ABN_number'])?$arr_pharmacy['ABN_number']:'' }}" class="form-control">
                              <div id="err_abn" class="error"></div>
                              </div>
                           
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     
                     <div class="box">
                        <div class="box-title">
                           <h3>
                              <i class="fa fa-text-width"></i>
                              {{'Professional Services'}}
                           </h3>
                        </div>
                     </div>
                     <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i></h3>
                     </div>
                     <div class="col-md-5">
                        <div class="box box-gray">
                           <div class="box-content">
                              <br/>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-5 control-label">Select Aprox Script Per Day<span class="star">*</span></label>
                                 <div class="col-sm-9 col-lg-7 controls">
                                    <!-- <select class="form-control" data-rule-required='true' name="aprox_script_per_day">
                                       <option value="">Select</option>
                                          @for($i=1;$i<=100;$i++)
                                       
                                              <option value="{{ $i }}"
                                       
                                               @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==$i) selected="" 
                                               @endif 
                                       
                                       
                                               >{{ $i or '' }}</option>
                                       
                                          @endfor
                                       
                                       </select> -->
                                    <select class="frm-select form-control" id="aprox_script_per_day" name="aprox_script_per_day">
                                       <option value="">Select Aprox Script Per Day</option>
                                       <option value="1"    @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==1) selected="" 
                                       @endif  >1-50</option>
                                       <option value="2" @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==2) selected="" 
                                       @endif>50-100</option>
                                       <option value="3" @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==3) selected="" 
                                       @endif>100-150</option>
                                       <option value="4" @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==4) selected="" 
                                       @endif>upto 500</option>
                                       <option value="5" @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==5) selected="" 
                                       @endif>500+</option>
                                    </select>
                                    <div id="err_aprox_script" class="error">{{ $errors->first('aprox_script_per_day') }}</div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <br/>
                              <div class="form-group">
                                 <label class="col-sm-3 col-lg-5 control-label">Computer System Used<span class="star">*</span></label>
                                 <div class="col-sm-9 col-lg-7 controls">
                                    <select class="form-control" id="computer_system_used" name="computer_system_used"  onchange="checkOtherField(this.value)">
                                       <option value="">Computer System Used</option>
                                       <option value="1"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==1) selected="" 
                                       @endif 
                                       >FRED Dispense</option>
                                       <option value="2"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==2) selected="" 
                                       @endif 
                                       >Minfos Dispense</option>
                                       <option value="3"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==3) selected="" 
                                       @endif 
                                       >Corum LOTS</option>
                                       <option value="4"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==4) selected="" 
                                       @endif 
                                       >Surefire Dispense (Amfac)</option>
                                       <option value="5"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==5) selected="" 
                                       @endif 
                                       >Simple Aquarius</option>
                                       <option value="6"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==6) selected="" 
                                       @endif 
                                       >Healthsoft Pharmacy Pro</option>
                                       <option value="7"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==7) selected="" 
                                       @endif 
                                       >Mountaintop Dispense</option>
                                       <option value="8"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==8) selected="" 
                                       @endif 
                                       >Z Dispense</option>
                                       <option value="9"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==9) selected="" 
                                       @endif 
                                       >CDS</option>
                                       <option value="10"
                                       @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==10) selected="" 
                                       @endif   
                                       >Other</option>
                                    </select>
                                 <div id="err_computer" class="error">{{ $errors->first('computer_system_used') }}</div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <br/>
                              <div id="other_profile_computer_system" style="display:none">
                                 <div class="form-group">
                                    <label class="col-sm-3 col-lg-5 control-label">Other Computer System Used<span class="star">*</span></label>
                                    <div class="col-sm-9 col-lg-7 controls" >
                                       <input type="text" id="other" name="other_computer_system" value="{{ isset($arr_pharmacy['other_computer_system'])?$arr_pharmacy['other_computer_system']:'' }}" class="form-control">
                                     <div id="err_other" class="error"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="box box-gray">
                           <div class="box-content">
                              <br/>
                              <h5>UPDATE PROFESSIONAL SERVICES
                                <br>
                              (Please select any professional services which can be advertised as being available to patients.)</h5>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox"  class="css-checkbox" value="1"  @if( isset($arr_pharmacy['services']) && in_array("1", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif  name="services[]" id="checkbox3" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me"  for="checkbox3">Offer Click & Collect</label>
                              </div>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox"  class="css-checkbox" value="2"  @if( isset($arr_pharmacy['services']) && in_array("2", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif name="services[]" id="checkbox4" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me"  for="checkbox4">Offer Delivery to Patients</label>
                              </div>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox" class="css-checkbox" value="3"  @if( isset($arr_pharmacy['services']) && in_array("3", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif  name="services[]" id="checkbox5" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me"  for="checkbox5">Passport Photos</label>
                              </div>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox"  class="css-checkbox" value="4"  @if( isset($arr_pharmacy['services']) && in_array("4", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif name="services[]" id="checkbox6" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me" for="checkbox6">Specialised Compounding</label>
                              </div>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox" class="css-checkbox" value="5"  @if( isset($arr_pharmacy['services']) && in_array("5", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif  name="services[]" id="checkbox7" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me" for="checkbox7">Flu Vaccination Clinics</label>
                              </div>
                              <div class="check-box pharmacy-signup2">
                                 <input type="checkbox" class="css-checkbox" value="6"  @if( isset($arr_pharmacy['services']) && in_array("6", $arr_pharmacy['services']))
                                 checked='checked'
                                 @endif id="checkbox8" name="services[]" tabindex="3"/>
                                 <label class="css-label lite-red-check remember_me" for="checkbox8">Other</label>
                              </div>
                              <div id="other_service_id" style="display:none">
                                 <div class="user_box">
                                    <input type="text" name="other_service" value="{{ $arr_pharmacy['other_service']  or '' }}" id="other_prof_service" class="input_acct-logn form-control" placeholder="Please enter other service" />
                                 </div>
                                 <div id="err_prof_other_service" class="error"></div>
                              </div>
                           </div>
                           <div class="error" id="err_service"></div>
                        </div>
                     </div>
                  </div>
              </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="box">
                        <div class="box-title">
                           <h3>
                              <i class="fa fa-text-width"></i>
                              {{'Opening Hours'}}
                           </h3>
                        </div>
                     </div>
                      <div class="box box-gray">
                     <div class="box-title">
                        <h3><i class="fa fa-puzzle-piece"></i></h3>
                     </div>
                     <div class="box-content">
                        <div class="table-responsive">
                           <table class="table table-striped table-hover fill-head">
                              <thead>
                                 <tr>
                                    <th>Day</th>
                                    <th>On/Off</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if(isset($arr_days) && sizeof($arr_days)>0)
                                 @foreach($arr_days as $day_key  => $day)
                                 <?php 
                                    $small_case_day_slug  = strtolower($day_key); 
                                    $small_case_day       = strtolower($day); 
                                    $time                 = date("g:i a", strtotime("13:30"));
                                    
                                    $open_time            = $close_time = '';

                                    $selected_day = $arr_pharmacy['time_schedule'][$small_case_day_slug.'_off'];

                                    ?>
                                 @if(isset($arr_pharmacy_schedule) && sizeof($arr_pharmacy_schedule)>0)
                                 <?php 
                                    $open_time  = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_open']));
                                    $close_time = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_close']));
                            
                                    $off_day = $arr_pharmacy_schedule[$small_case_day_slug.'_off'];
                                    ?>
                                 @endif
                                 <tr>
                                    <td>
                                       {{ $day or '' }}
                                    </td>
                                    <td> 
                                       <!-- <input type="checkbox" id="{{$small_case_day_slug}}_off" name="{{$small_case_day_slug}}_off" @if(isset($off_day) && $off_day=='1') checked="checked"  @endif onchange="checkOffStatus('{{$small_case_day_slug}}')" value="1" > -->
                                       <input type="checkbox" id="{{$small_case_day_slug}}_off" name="{{$small_case_day_slug}}_off" @if(isset($selected_day) && $selected_day=='1') checked="checked"  @endif onchange="checkOffStatus('{{$small_case_day_slug}}')" value="1" >
                                    </td>
                                    <td>
                                       @if(isset($arr_pharmacy['time_schedule']) && sizeof($arr_pharmacy['time_schedule'])>0)
                                       <?php 
                                          $open_time = date("h:i A",strtotime($arr_pharmacy['time_schedule'][$small_case_day_slug.'_open']));
                                          $close_time = date("h:i A",strtotime($arr_pharmacy['time_schedule'][$small_case_day_slug.'_close']));
                                          ?>
                                       @endif
                                       <!-- <div id="start_time_div_{{$small_case_day_slug}}" class="clock-i input-group">
                                          <input type="text"  data-rule-required="true"  class="form-control timepicker-default" name="{{$small_case_day_slug}}_open" value="{{ $open_time }}" aria-describedby="basic-addon2">
                                          <a href="javascript:void(0);" id="basic-addon2" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                       </div>
                                    </td>
                                    <td>
                                       <div id="end_time_div_{{ $small_case_day_slug }}" class="clock-i input-group" style="margin:0 auto;">
                                          <input type="text" data-rule-required="true"  class="form-control timepicker-default" value="{{ $close_time }}" name="{{$small_case_day_slug}}_close" aria-describedby="basic-addon2">
                                          <a href="javascript:void(0);" id="basic-addon2" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                       </div> -->

                                       <div id="start_time_div_{{$small_case_day_slug}}" class="clock-i input-group" <?php if(isset($selected_day) && $selected_day=='1'){ echo 'style="display: none;"'; } ?>  >
                                                    <input type="text"  data-rule-required="true"  class="form-control timepicker-default" id="{{$small_case_day_slug}}_open" name="{{$small_case_day_slug}}_open" value="{{ $open_time }}" aria-describedby="basic-addon2">
                                                    <a href="javascript:void(0);" id="basic-addon2" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                 </div>
                                              </td>
                                              <td>
                                                 <div id="end_time_div_{{ $small_case_day_slug }}" class="clock-i input-group" <?php if(isset($selected_day) && $selected_day=='1'){ echo 'style="display: none;margin:0 auto;"'; } else { echo 'style="margin:0 auto;"'; } ?> >
                                                    <input type="text" data-rule-required="true"  class="form-control timepicker-default" value="{{ $close_time }}" id="{{$small_case_day_slug}}_close" name="{{$small_case_day_slug}}_close" aria-describedby="basic-addon2">
                                                    <a href="javascript:void(0);" id="basic-addon2" class="input-group-addon" style="height:34px;"><i class="fa fa-clock-o"></i></a>
                                                 </div>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-2control-label">Opening Hours Notes:<span class="star">*</span></label>
                           <div class="col-sm-9 col-lg-4 controls">
                              <textarea class="form-control" id="opening_hour_notes" name="opening_hour_notes" rows="3">{{ $arr_pharmacy['time_schedule']['opening_hour_notes'] or '' }}</textarea>
                              Any additional information to display regarding your opening hours e.g. Closed on 25th Dec.
                            <div id="err_opening" class="error">{{ $errors->first('opening_hour_notes') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                     </div>
                  </div>
              </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                           <button type="submit" style="visibility: hidden;"  class="btn btn-primary" id="valid"><i class="fa fa-check"></i>Update</button>

                           <input type="submit" class="btn btn-primary" name="btn_send_otp" id="btn_send_otp" value="Update">

                           <button type="submit" class="btn btn-success" id="btn_send_otp_spinner" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button>


                           <button type="button" class="btn" onclick="location.href = '{{ $module_url_path }}/verifiedpharmacies';" >Cancel</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      
</form>
</div>
@include('admin.otp.otp')

<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="email" id="email" value="{{ $user->email }}">

<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
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
            email      = $('#email').val();
            
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
                           $('#frm_pharmacy_edit_id').submit();
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
            var email = $('#email').val();


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


<input type="hidden" id="arr_days" value="{{ (isset($arr_days))? json_encode($arr_days): json_encode(array()) }}">
<script>
   function checkOtherField(ref)
     {
           if(ref==10)
           {
                 $('#other_profile_computer_system').show();
           }
           else
           {
                 $('#other_profile_computer_system').hide();
           }
   
     }
   
    function checkOffStatus(day)
   {
      var is_off_day = $('#'+day+'_off').val();
      if($('#'+day+'_off').is(":checked"))
      {
          $('#start_time_div_'+day).hide();
          $('#end_time_div_'+day).hide();

          $('#'+day+'_open').val("");
          $('#'+day+'_close').val("");
      }
      else
      {
          $('#start_time_div_'+day).show();
          $('#end_time_div_'+day).show();
      }
     
   }
   
   $("#frm_pharmacy_edit_id").submit(function()
   { 
            setTimeout(function()
            {
               $('#err_other_role').html('');
               $('#err_other_group').html('');
            },2000);
              
             var firstname                 =  $('#firstname').val();
             var lastname                  =  $('#last_name').val();
             var contact_role              =  $('#contact_role').val();
             var is_other_selected         =  $("#contact_role").val();            
             var pharmacy_name             =  $('#pharmacy_name').val();
             var contactnumber             =  $('#contactnumber').val();
             var fax                       =  $('#fax').val();
             var address                   =  $('#address').val();
             var part_of_banner_group      =  $("input[name='part_of_banner_group']:checked").val();
             var other_group               =  $('#other_group').val();
             var url                       =  $('#url').val();
             var abn                       =  $('#abn').val();
             var aprox_script_per_day      =  $('#aprox_script_per_day').val();
             var computer_system_used      =  $('#computer_system_used').val();
             var other                     =  $('#other').val();
             var other_service             =  $('#other_prof_service').val();
             var opening_hour_notes        =  $('#opening_hour_notes').val();
             var urlfilter                 = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;

             /*alert(part_of_banner_group);*/

             if($.trim(firstname)=="")
             {
                $('#firstname').val('');
                $('#err_first_name').show();
                $('#err_first_name').fadeIn();
                $('#err_first_name').html('Please enter first name.');
                $('#err_first_name').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#firstname').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(lastname)=="")
             {
                $('#last_name').val('');
                $('#err_last_name').show();
                $('#err_last_name').fadeIn();
                $('#err_last_name').html('Please enter last name.');
                $('#err_last_name').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#last_name').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(contact_role)=="")
             {
                $('#contact_role').val('');
                $('#contact_role').show();
                $('#err_contact_role').fadeIn();
                $('#err_contact_role').html('Please select contact role');
                $('#err_contact_role').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#contact_role').focus();
                $(".close").click();  
                return false;
             }
            if(is_other_selected==6)
            {
                var other_role_val = $("#other_role").val();
                if(other_role_val=='')
                {
                  $('#err_other_role').show();
                  $('#err_other_role').html('Please enter other role.');
                  $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#other_role').focus();

                 $(".close").click();  
                 return false;
                }
             }
             
             if($.trim(pharmacy_name)=="")
             {
                $('#pharmacy_name').val('');
                $('#err_pharmacy_name').show();
                $('#err_pharmacy_name').fadeIn();
                $('#err_pharmacy_name').html('Please enter pharmacy name');
                $('#err_pharmacy_name').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#pharmacy_name').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(contactnumber)=="")
             {
                $('#contactnumber').val('');
                $('#err_contact_number').show();
                $('#err_contact_number').fadeIn();
                $('#err_contact_number').html('Please enter contact number');
                $('#err_contact_number').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#contactnumber').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(fax).length<7 || $.trim(fax).length>=16 && $.trim(fax)!=="" )
             { 
                $('#fax').val('');
                $('#err_fax').show();
                $('#err_fax').fadeIn();
                $('#err_fax').html('Please enter fax number');
                $('#err_fax').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#fax').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(address)=="")
             {
                $('#address').val('');
                $('#err_address').fadeIn();
                $('#err_address').fadeIn();
                $('#err_address').html('Please enter address');
                $('#err_address').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#address').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(part_of_banner_group) == "Yes")
             {
                if($.trim(other_group)=="")
                {
                  $('#other_group').val('');
                  $('#err_other_group').show();
                  $('#err_other_group').fadeIn();
                  $('#err_other_group').html('Please select other group');
                  $('#err_other_group').fadeOut(4000);
                  $('html, body').animate({
                    scrollTop: $('#main-content').offset().top
                  }, 'slow');
                  $('#other_group').focus();
                  $(".close").click();  
                  return false;
                }
             }
              if(!urlfilter.test(url)&& $.trim(url)!=="")
             { 
                $('#url').val('');
                $('#err_url').show();
                $('#err_url').fadeIn();
                $('#err_url').html('Please enter valid website url');
                $('#err_url').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#url').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(abn).length<11 && $.trim(abn)!=="")
             { 
                $('#abn').val('');
                 $('#err_abn').show();
                $('#err_abn').fadeIn();
                $('#err_abn').html('Please enter 11 digit ABN number');
                $('#err_abn').fadeOut(4000);
                $('html, body').animate({
                      scrollTop: $('#main-content').offset().top
                  }, 'slow');
                $('#abn').focus();
                $(".close").click();  
                return false;
             }
             if($.trim(aprox_script_per_day)=="")
             {
                $('#aprox_script_per_day').val('');
                $('#err_aprox_script').fadeIn();
                $('#err_aprox_script').html('Please select approx script per day');
                $('#err_aprox_script').fadeOut(4000);
                $('#aprox_script_per_day').focus();

                $('html, body').animate({
                      scrollTop: $('#aprox_script_per_day').offset().top
                  }, 'slow');
                $('#abn').focus();

                $(".close").click();  
                return false;
             }
              if($.trim(computer_system_used)=="")
             {
                $('#computer_system_used').val('');
                $('#err_computer').show();
                $('#err_computer').fadeIn();
                $('#err_computer').html('Please select computer system');
                $('#err_computer').fadeOut(4000);
                $('#computer_system_used').focus();

                 $('html, body').animate({
                      scrollTop: $('#computer_system_used').offset().top
                  }, 'slow');
                $('#abn').focus();

                $(".close").click();  
                return false;
             }
             if(computer_system_used==10)
            {
                var other_system =  $('#other').val();
                if(other_system=='')
                { 
                    $('#err_other').show();
                    $('#err_other').fadeIn();
                    $('#err_other').html('Please enter your computer system.');
                    $('#err_other').fadeOut(4000);
                    $('#other').focus();

                    $('html, body').animate({
                      scrollTop: $('#other').offset().top
                      }, 'slow');
                    $('#abn').focus();

                    $(".close").click();  
                    return false;
                }
         
            }
   
            if(!$('input[name="services[]"]').is(':checked'))
            {
              $('#err_service').show();
                $('#err_service').html('Select atleast one service.').fadeOut(4000);

                $('html, body').animate({
                      scrollTop: $('#err_service').offset().top
                }, 'slow');

                $(".close").click();  
                return false;
            }
             
            if( $('#checkbox8').is(':checked'))
            { 
                
                if(other_service=='')
                {
                    $('#err_prof_other_service').show();
                    $('#err_prof_other_service').fadeIn();
                    $('#err_prof_other_service').html('Please enter other service.');
                    $('#err_prof_other_service').fadeOut(4000);
                    $('#other_prof_service').focus();

                    $('html, body').animate({
                      scrollTop: $('#err_prof_other_service').offset().top
                    }, 'slow');

                    $(".close").click();  
                    return false;
                }
         
            }
             if($.trim(opening_hour_notes)=="")
             {
                $('#err_opening').show();
                $('#opening_hour_notes').val('');
                $('#err_opening').fadeIn();
                $('#err_opening').html('Please enter opening hour notes');
                $('#err_opening').fadeOut(4000);
                $('#opening_hour_notes').focus();

                $('html, body').animate({
                      scrollTop: $('#opening_hour_notes').offset().top
                }, 'slow');

                $(".close").click();  
                return false;
             }
   
   
    });
   
   $(document).ready(function()
   {
        var computer_system_used = $('#computer_system_used').val();
        if(computer_system_used==10)
        {
              $('#other_profile_computer_system').show();
        }
        else
        {
              $('#other_profile_computer_system').hide();
        }
   
   
      $('#frm_pharmacy_edit_id').validate({
        errorClass:'error',
        errorElement:'span',
   
                     rules: 
                     {
                          pharmacy_logo: {
                              accept: "image/jpeg, image/png,image/jpg"
                          },
                         messages: {
                                    "pharmacy_logo": 
                                    {
                                        accept: "Please upload a valid image.",
                                    }  
                                }
                     },
                        errorPlacement: function(error, element) 
                           {
   
                                 if (element.attr("type") == "file") 
                                 {
                                   error.insertAfter('#err_logo');
                                 } 
                                 else 
                                 {
                                   error.insertAfter(element);
   
                                 }
                            }
   
    });
    $('.timepicker-default').timepicker(); 
   
    var is_selected = $("#frm_pharmacy_edit_id input[type='radio']:checked").val();
    if(is_selected=='Yes')
    {
        $('#other_field').show();
    }
    else
    {
        $('#other_field').hide();
    }
   
   
    var role       =  $('#contact_role').val();
    if(role==6)
    {
        $('#contact_role_div').show();
    }
    else
    {
        $('#contact_role_div').hide();
    }
   
   }); 
   $(document).ready(function()
   {
        /*check off days & hide a time*/
        var arr_days      = $("#arr_days").val();
        arr_days           = JSON.parse(arr_days);
        
        jQuery.each(arr_days, function(index, item) {
              var day = index.toLowerCase();
                  if($('#'+day+'_off').is(":checked"))
                  {
                      $('#start_time_div_'+day).hide();
                      $('#end_time_div_'+day).hide();
                  }
          });
   
      $('#frm_pharmacy_edit_id').validate({
        errorClass:'error',
        errorElement:'span',
      });
      $('.timepicker-default').timepicker();
   
      $('.end-time-timepicker-default').timepicker();
   
   });
   $(document).ready(function()
   {
        /*check off days & hide a time*/
        var arr_days      = $("#arr_days").val();
        arr_days           = JSON.parse(arr_days);
        
        jQuery.each(arr_days, function(index, item) {
              var day = index.toLowerCase();
                  if($('#'+day+'_off').is(":checked"))
                  {
                      $('#start_time_div_'+day).hide();
                      $('#end_time_div_'+day).hide();
                  }
          });
   
      $('#frm_pharmacy_edit_id').validate({
        errorClass:'error',
        errorElement:'span',
   
      });
   
   
      $('.timepicker-default').timepicker();
   
      $('.end-time-timepicker-default').timepicker();
      
            if($('#checkbox8').attr('checked')) {
          $("#other_service_id").show();
      } else {
          $("#other_service_id").hide();
      }
             
   
   }); 
   $("#checkbox8").click(function () {
        if ($(this).is(":checked")) {
            $("#other_service_id").show();
        } else {
            $("#other_service_id").hide();
        }
    });
    
   function showOtherField(ref)
   {
   if(ref=='Yes')
   {
    $('#other_field').show();
   }
   else
   {
      $('#other_field').hide();
   }
   
   }
   
   function showOtherRole(role)
   {
   if(role==6)
   {
      $('#contact_role_div').show();
   }
   else
   {
      $('#contact_role_div').hide();
   }
   }
</script>
@stop

