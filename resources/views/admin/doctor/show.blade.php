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
      <li><a href="{{ url($admin_panel_slug.'/doctor/applications') }}">Doctor Applications </a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($module_title)?$module_title.' Details':"Patient Details"}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($module_title)? $module_title.' Details':"Doctor Details" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <div class="box-content">
         <div class="row">
            <div class="col-md-6">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> About Yourself</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['userinfo']['title']) ? $data_info['userinfo']['title'] : ''}}
                           {{isset($data_info['userinfo']['first_name']) ? $data_info['userinfo']['first_name'] : ''}}
                           {{isset($data_info['userinfo']['last_name']) ? $data_info['userinfo']['last_name'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                      
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Gender</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{isset($data_info['gender']) && !empty($data_info['gender']) ? $data_info['gender'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['userinfo']['email']) && !empty($data_info['userinfo']['email']) ? $data_info['userinfo']['email'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Date of Birth</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ isset($data_info['dob'])? date("d M, Y",strtotime($data_info['dob'])):'' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Citizenship</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['citizenship']) && !empty($data_info['citizenship']) ? $data_info['citizenship'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                            +{{isset($data_info['mobile_country_code']['phonecode']) && !empty($data_info['mobile_country_code']['phonecode']) ? $data_info['mobile_country_code']['phonecode'] : ''}}<span id="mobile_no"></span>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Contact No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="contact_no"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                           <label class="col-xs-3 col-lg-5 control-label">Address</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls" id="address">
                           </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                    
                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">Timezone</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['doctor_timezone']['location']) ? $data_info['doctor_timezone']['location'] : ''}} {{isset($data_info['doctor_timezone']['utc_offset']) ? '('.$data_info['doctor_timezone']['utc_offset'].')' : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">Registration Time & Date</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                        <?php $admin_datetime = convert_utc_to_userdatetime(1, "admin", $data_info['userinfo']['created_at']); ?>
                           {{isset($admin_datetime) ? date("d M, Y, h:i a",strtotime($admin_datetime)) : ''}}
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
                     <h3><i class="fa fa-puzzle-piece"></i> Your Medical Practice</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Clinic Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="clinic_name">{{isset($data_info['clinic_name']) && $data_info['clinic_name'] !='0' ? $data_info['clinic_name'] : ''}}</div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Clinic Address</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="clinic_address"></div>
                     </div>
                      <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Clinic Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="clinic_email"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Contact No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="clinic_contact_no"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Mobile No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" >
                           {{isset($data_info['clinic_mobile_no_code']) && $data_info['clinic_mobile_no_code'] !='0' ? $data_info['clinic_mobile_no_code'] : ''}} <span id="clinic_mobile_no"></span>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Experience (in year)</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['experience']) ? $data_info['experience'] : 'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                           <label  class="col-xs-3 col-lg-5 control-label">Language Known</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                                 @if(isset($data_info['language']) && !empty($data_info['language']))
                                    @php
                                       $language_known = explode(',', $data_info['language']);
                                       @endphp
                                       <ul style="padding: 0 0 0 15px;">
                                             @php
                                        foreach($arr_language as $lang)
                                        {
                                             if(in_array($lang['id'], $language_known))
                                             {
                                                echo "<li>".$lang['language']."</li>";
                                             }
                                        }
                                    @endphp
                                       </ul>
                                 @endif
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
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Your Medical Qualifications</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Primay Qualification</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="medical_qualification">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                      
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">School</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{isset($data_info['medical_school']) && !empty($data_info['medical_school']) ? $data_info['medical_school'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Year Obtained</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['year_obtained']) && !empty($data_info['year_obtained']) ? $data_info['year_obtained'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">Country Obtained</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ isset($data_info['country_obtained'])? $data_info['country_obtained'] :'' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">Other Qualification</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_info['other_qualifications']) && !empty($data_info['other_qualifications']) ? $data_info['other_qualifications'] : ''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <label class="col-xs-3 col-lg-5 control-label">Bank Account Details</label>
                     <div class="clearfix"></div>
                     <br>
                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">Bank Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="bank_account_name">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label  class="col-xs-3 col-lg-5 control-label">BSB</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="bsb">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                           <label  class="col-xs-3 col-lg-5 control-label">Account No.</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls" id="account_number">
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
                     <h3><i class="fa fa-puzzle-piece"></i> Official Documents & Verification</h3>
                  </div>
                  <div class="box-content">

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

                     <?php
                          if(isset($id_proof_file) && !empty($id_proof_file))
                          {
                              $file       = $doc_id_proof.$id_proof_file;
                              $extension  = pathinfo($file, PATHINFO_EXTENSION); 
                          }
                      ?>

                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Driving license or Australian Passport</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($id_proof_file) && !empty($id_proof_file) && File::exists($doc_id_proof_public.$id_proof_file))
                              <a href="" id="dec_id_proof_file" download>Download</a>
                           @else
                              NA
                           @endif
                           
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Medical Registration No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="medical_registration_no">
                        </div>
                     </div>
                      <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Medical Registration Certificate</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($medical_registration_certificate) && !empty($medical_registration_certificate) && File::exists($doc_med_reg_public.$medical_registration_certificate))
                              <a href="" id="dec_medical_registration_certificate_file" download>Download</a>
                           @else
                              NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Medicare Provider No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="medicare_provider_no">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Prescriber No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="prescriber_no">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">AHPRA Registration No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="ahpra_registration_no">
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                      <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">ABN</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($abn) && !empty($abn) ? $abn : 'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <label class="col-xs-3 col-lg-5 control-label">Professional Insurance</label>

                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">PI Insurance Policy Cover</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($pi_insurance_policy) && !empty($pi_insurance_policy) && File::exists($doc_ins_pol_public.$pi_insurance_policy))
                              <a href="" id="dec_pi_insurance_policy" download>Download</a>
                           @else
                              NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                      <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Cyber Liability Insurance Policy Cover</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($cyber_liability_insurance_policy) && !empty($cyber_liability_insurance_policy) && File::exists($doc_cyb_liabl_public.$cyber_liability_insurance_policy))
                              <a href="" id="dec_cyber_liability_insurance_policy" download>Download</a>
                           @else
                              NA
                           @endif
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
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Personalize your profile for Patients</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">About Summary </label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="about_me">
                           
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                      
                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Profile Picture</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          
                           <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <div style="width: 200px; height: 150px;" class="fileupload-new img-thumbnail">
                                       @if(isset($data_info['userinfo']['profile_image']) && $data_info['userinfo']['profile_image']!="" && file_exists($doc_profile_public.$data_info['userinfo']['profile_image']))
                                       <img src="{{$doc_profile_pic.$data_info['userinfo']['profile_image']}}" width="188px" height="175px" alt=""/>
                                       @else
                                       <img src="{{url('/')}}/public/images/no-image.png" alt="" width="188px" height="175px" />
                                       @endif 
                                    </div>
                           </div>
                        </div>
                     </div>
                      <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label class="col-xs-3 col-lg-5 control-label">Introductory Video</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">

                           @if(isset($data_info['profile_video']) && !empty($data_info['profile_video']) && File::exists($doc_video_public.$data_info['profile_video']))
                              {{-- <a href="{{ $doc_video.$data_info['profile_video'] }}" download>Download</a> --}}
                              <video width="200" height="200" controls>
                                <source src="{{ $doc_video.$data_info['profile_video'] }}" type="video/mp4">
                              </video>
                           @else
                              NA
                           @endif
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

<!-- Decrypt Values -->
<script type="text/javascript">
 var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
 var api           = virgil.API(virgilToken);
 
 var dumpSessionId = '{{isset($data_info["userinfo"]["dump_session"])?$data_info["userinfo"]["dump_session"]:""}}';
 var dumpId        = '{{isset($data_info["userinfo"]["dump_id"])?$data_info["userinfo"]["dump_id"]:""}}';
 
 //  About Yourself
 var address        = "{{isset($data_info['address'])?$data_info['address']:''}}";
 var mobile_no      = "{{isset($data_info['mobile_no'])?$data_info['mobile_no']:''}}";
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
     $('#address').html(dec_address);
   }
   
   if(mobile_no!='')
   {
     var dec_mobile_no  = decrypt(api, mobile_no, key);
     $('#mobile_no').html(dec_mobile_no);
   }

   if(contact_no!='')
   {
     var dec_contact_no  = decrypt(api, contact_no, key);
     $('#contact_no').html(dec_contact_no);
   }

   
   //  Your Medical Practice
   if(clinic_email!='')
   {
     var dec_clinic_email     = decrypt(api, clinic_email, key);
     $('#clinic_email').html(dec_clinic_email);
   }
   
   if(clinic_address!='')
   {
     var dec_clinic_address  = decrypt(api, clinic_address, key);
     $('#clinic_address').html(dec_clinic_address);
   }

   if(clinic_mobile_no!='')
   {
     var dec_clinic_mobile_no  = decrypt(api, clinic_mobile_no, key);
     $('#clinic_mobile_no').html(dec_clinic_mobile_no);
   }

   if(clinic_contact_no!='')
   {
     var dec_clinic_contact_no  = decrypt(api, clinic_contact_no, key);
     $('#clinic_contact_no').html(dec_clinic_contact_no);
   }


   //  Your Medical Qualifications
   if(medical_qualification!='')
   {
     var dec_medical_qualification     = decrypt(api, medical_qualification, key);
     $('#medical_qualification').html(dec_medical_qualification);
   }
   
   if(bank_account_name!='')
   {
     var dec_bank_account_name  = decrypt(api, bank_account_name, key);
     $('#bank_account_name').html(dec_bank_account_name);
   }

   if(bsb!='')
   {
     var dec_bsb  = decrypt(api, bsb, key);
     $('#bsb').html(dec_bsb);
   }

   if(account_number!='')
   {
     var dec_account_number  = decrypt(api, account_number, key);
     $('#account_number').html(dec_account_number);
   }      


   //  Your Medical Qualifications
   if(medical_registration_no!='')
   {
     var dec_medical_registration_no     = decrypt(api, medical_registration_no, key);
     $('#medical_registration_no').html(dec_medical_registration_no);
   }
   
   if(medicare_provider_no!='')
   {
     var dec_medicare_provider_no  = decrypt(api, medicare_provider_no, key);
     $('#medicare_provider_no').html(dec_medicare_provider_no);
   }

   if(prescriber_no!='')
   {
     var dec_prescriber_no  = decrypt(api, prescriber_no, key);
     $('#prescriber_no').html(dec_prescriber_no);
   }

   if(ahpra_registration_no!='')
   {
     var dec_ahpra_registration_no  = decrypt(api, ahpra_registration_no, key);
     $('#ahpra_registration_no').html(dec_ahpra_registration_no);
   }

    var id_proof_file = '{{ $doc_id_proof.$id_proof_file }}';

    if(id_proof_file!='')
    {
        var id_proof_file_filename      = '{{ $id_proof_file }}';
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
            img.download = id_proof_file_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var medical_registration_certificate_file = '{{ $doc_med_reg.$medical_registration_certificate }}';

    if(medical_registration_certificate_file!='')
    {
        var medical_registration_certificate_file_filename      = '{{ $medical_registration_certificate }}';
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
            img.download = medical_registration_certificate_file_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var pi_insurance_policy_file = '{{ $doc_ins_pol.$pi_insurance_policy }}';

    if(pi_insurance_policy_file!='')
    {
        var filename      = '{{ $pi_insurance_policy }}';
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
            img.download = filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }

    var cyber_liability_insurance_policy = '{{ $doc_cyb_liabl.$cyber_liability_insurance_policy }}';
    if(cyber_liability_insurance_policy!='')
    {
        var cyber_liability_insurance_policy_filename      = '{{ $cyber_liability_insurance_policy }}';
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
            img.download = cyber_liability_insurance_policy_filename;
            img.href = imageUrl;
          }
        };
        xhr.send();
    }


   //  About Me
   if(about_me!='')
   {
     var dec_about_me     = decrypt(api, about_me, key);
     $('#about_me').html(dec_about_me);
   }   

 }

 function decrypt(api, enctext, key)
 {
     var decrpyttext = key.decrypt(enctext);
     var plaintext = decrpyttext.toString();
     return plaintext;
 }
</script>
@endsection