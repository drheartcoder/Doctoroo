@extends('front.patient.layout._after_patient_login_master')
@section('main_content')


<style>
.sticky_btn {
    bottom: 350px;
    position: fixed;
    right: 0;
}
</style>

<!--file upload css-->
<link rel="stylesheet" href="{{url('/')}}/public/css/bootstrap-fileupload.css"/>
<!--dashboard section-->   
<style>
  .star{ color:#ff4d4d; } 
</style>
<!--Seema(27-Feb-2017)-->        
<div class="middle-section">
   <div class="container">
      @include('front.layout._operation_status')
      <?php 
           $user       = Sentinel::check();
           $activation = Activation::completed($user);
        ?>
        @if($user->verification_status==0)
        
           <div class="alert-box warning alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button><span>warning: </span> Your Account is not verified yet. Please verify your account by clicking on verification link given in registered email. Click here to <a href="{{ url('/') }}/patient/resend-verification-email/{{ $user->id }}">Resend verification email.</a></div>
        
        @endif


      <div class="back-whhit-bx patient-white-bx" style="background:#fff">
         <div class="clearfix"></div>
         <div class="add-new-head">
            Personal Details
         </div>
         <form method="post" name="frm_patient_profile" id="frm_patient_profile" action="{{url('/')}}/patient/store_profile" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="signup_type" id="signup_type" value="full">
        <input type="hidden" name="status_redirect" id="status_redirect" value="">

         <div class="row" id="div_personal_details">
            <div class="col-sm-12 col-md-12 col-lg-6">
             <?php 
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
               ?>

               <div class="user-box ">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Title <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                          <div class="select-style my-pati">
                           <select class="frm-select" name="title" id="title">
                              <option value="">- Title -</option>
                              @if(isset($arr_prefix) && sizeof($arr_prefix)>0)
                                  @foreach($arr_prefix as $prefix)
                                    <option value="{{ $prefix['name'] or '' }}" @if(isset($patient_arr['userinfo']['title']) && $patient_arr['userinfo']['title']==$prefix['name']) selected="selected" @endif >{{ $prefix['name'] or '' }}</option>
                                  @endforeach
                              @endif
                           </select>
                          </div>    
                        <div class="err" id="err_title"></div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">First Name <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="First Name" name="first_name" id="first_name" class="form-inputs" type="text" value="{{isset($patient_arr['userinfo']['first_name'])?$patient_arr['userinfo']['first_name']:old('first_name')}}" />
                         <div class="err" id="err_first_name"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Last Name <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Last Name" name="last_name" id="last_name" class="form-inputs" type="text" value="{{isset($patient_arr['userinfo']['last_name'])?$patient_arr['userinfo']['last_name']:''}}" />
                         <div id="err_last_name" class="err"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Gender <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <div class="radio-btns user_box pre-rad">
                           <div class="radio-btn aftr-cl">
                              <input name="gender" id="RadioMale" type="radio" value="M" @if(isset($patient_arr['gender']) && $patient_arr['gender']=='M') checked="checked" @endif/>
                              <label for="RadioMale">Male</label>
                              <div class="check"></div>
                           </div>
                           <div class="radio-btn aftr-cl">
                              <input  id="Radio5" name="gender" type="radio" value="F" @if(isset($patient_arr['gender']) && $patient_arr['gender']=='F') checked="checked" @endif/>
                              <label for="Radio5" data-toggle="modal" href="#send-order" class="forgetpwd" onclick="javascript:$('#Radio5').attr('checked',true); return true;">Female</label>
                              <div class="check"></div>
                           </div>
                         </div>
                        <div id="err_gender" class="err" style="position: inherit;"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Email <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Email Address" name="email_address" id="email_address" class="form-inputs" type="text" readonly="true" value="{{isset($patient_arr['userinfo']['email'])?$patient_arr['userinfo']['email']:''}}" />
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <?php $day=$months=$year="";
                 if(isset($patient_arr['date_of_birth']) && $patient_arr['date_of_birth']!='0000-00-00')
                 {

                     list($year,$months,$day) = explode('-',$patient_arr['date_of_birth']);
                 } 

                ?>
             </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Date of Birth <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-4 col-md-3 col-lg-3">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="day_of_birth" id="day_of_birth">
                              <option value="">- Date -</option>
                              <?php 
                                 for($i=1;$i<=31;$i++)
                                 { ?>
                                  
                                    <option @if($day!="" && $i==$day) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                 <?php   
                                 }
                              ?>
                           </select>
                        </div>
                        <div class="err" id="err_day_of_birth"></div>    
                      </div>
                     <div class="col-sm-4 col-md-3 col-lg-3 margn">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="date_of_month" id="date_of_month">
                              <option value="">- Month -</option>
                              @if(count($arr_months)>0)
                              @foreach($arr_months as $key=>$month)
                                 <option @if($months!="" && $key==$months) selected="selected" @endif value="{{$key}}">{{$month}}</option>
                              @endforeach   
                              @endif
                           </select>
                        </div>
                       <div class="err" id="err_date_of_month"></div>    
                     </div>
                     <div class="col-sm-4 col-md-3 col-lg-3">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="date_of_year" id="date_of_year">
                              <option value="">- Year -</option>
                              <?php $current_year = date('Y');
                              for($i=1900;$i<=$current_year;$i++)
                              { 
                                 ?>

                                 <option @if($year!="" && $i==$year) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                <?php  
                              }
                              ?>
                           </select>
                        </div>
                       <div class="err" id="err_date_of_year"></div>   
                     </div>

                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Mobile No. <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                      <input placeholder="Mobile Number" name="mobile_no" id="mobile_no" class="form-inputs" type="text" value="{{isset($patient_arr['mobile_no'])?$patient_arr['mobile_no']:''}}"/>
                       <!--  <span class="num-digit">+61</span> -->
                        <div class="err" id="err_mobile_no"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Phone No <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Phone No (02) 9876 5432" name="phone_no" id="phone_no" class="form-inputs" type="text" value="{{isset($patient_arr['phone_no'])?$patient_arr['phone_no']:''}}"/>
                        <div class="err" id="err_phone_no"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>   
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Address <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter your Postal Address" name="address" id="autocomplete" class="form-inputs pharamcyinfo" type="text" value="{{isset($patient_arr['streen_address'])?$patient_arr['streen_address']:''}}" />
                        
                         <input type="hidden" name="street_number" id="street_number">
                         <input type="hidden" name="route" id="route">
                         <input type="hidden" name="locality" id="locality">
                         <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1">
                         <input type="hidden" name="post_code" id="postal_code">
                         <input type="hidden" name="country" id="country">
                        <a href="javascript:void(0);"><span id="span_manually_address" class="grn-msg"> Or enter address manually</span></a>
                        <input type="hidden" name="manually_flag" id="manually_flag">
                        <div class="err" id="err_address"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="manually_div" @if(isset($patient_arr['manually_address']) && $patient_arr['manually_address']!="") style="display:block;" @else style="display:none;" @endif>
                <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Address</div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter your address manually" name="manually_address" id="manually_address" class="form-inputs" type="text" value="{{isset($patient_arr['manually_address'])?$patient_arr['manually_address']:''}}"/>
                        <div class="err" id="err_manually_address"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Suburb <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Suburb" id="suburb" name="suburb" class="form-inputs pharamcyinfo" type="text" value="{{isset($patient_arr['suburb'])?$patient_arr['suburb']:''}}" onblur="getPharmacy(this.value);" />
                        <div class="err" id="err_suburb"></div>

                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Zipcode <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Zipcode" name="zipcode" id="postal_code" class="form-inputs" type="text" value="{{isset($patient_arr['zipcode'])?$patient_arr['zipcode']:''}}"/>
                        <div class="err" id="err_zipcode"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="add-new-head">
            Medicare Details
         </div>
         <div class="" id="div_medicare_section">
            <div class="col-sm-12 col-md-12 col-lg-12  request-details-bx">
               <div class="med-his-txt">Your Medicare details will only be used if the Doctor prescribes you a prescription, or if yould like ti invite them for future consulations 
               </div>
               <div class="step-radios text-center">
                  <div class="radio-btn">
                     <input type="radio" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && 
                     $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Private") checked="checked" @endif id="f-option-private" name="medicare_type" value="Private" />
                     <label for="f-option-private" class="txt-cen">
                     <span class="interior-icon">
                     Private
                     </span>
                     </label>
                     <div class="check br-rad"></div>
                  </div>
                  <div class="radio-btn">
                     <input type="radio" id="f-option-medicare" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Medicare") checked="checked" @endif name="medicare_type" value="Medicare" />
                     <label for="f-option-medicare" class="txt-cen">
                     <span class="interior-icon">
                     Medicare
                     </span>
                     </label>
                     <div class="check"></div>
                  </div>
                  <div class="radio-btn">
                     <input type="radio" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Concession") checked="checked" @endif id="f-option-concession" name="medicare_type" value="Concession" />
                     <label for="f-option-concession" class="txt-cen">
                     <span class="interior-icon">
                     Concession 
                     </span>
                     </label>
                     <div class="check br-rad1"></div>
                  </div>
                  <div class="radio-btn">
                     <input type="radio" id="f-option-safety" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Safety Net Card") checked="checked" @endif name="medicare_type" value="Safety Net Card" />
                     <label for="f-option-safety">
                     <span class="interior-icon">
                     Safety Net
                     Card
                     </span>
                     </label>
                     <div class="check br-rad1"></div>
                  </div>
                  <div class="err" id="err_medicare_type">
               </div>
               <br/>
               <!--<div class="check-box med-step2">
                  <input class="css-checkbox" id="radio1" name="radiog_dark" type="checkbox"/>
                  <label class="css-label radGroup2" for="radio1">I Don't have a medicare Card</label>
                  </div>-->
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="row" id="div_medicare" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && ($patient_arr['medicaredetails']['medicare_type']=="Medicare" || $patient_arr['medicaredetails']['medicare_type']=="Concession" || $patient_arr['medicaredetails']['medicare_type']=="Safety Net Card")) style="display:block" @else style="display:none" @endif>
            <div class="col-sm-12 col-md-12 col-lg-6 ">
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-4">
                        <div class="form-lable big-lble" id="name_of_card">

                        @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Medicare")
                        
                          Medicare Card Number

                        @elseif(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Concession")

                            Concession Card Number

                        @elseif(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Safety Net Card")
                
                          Safety Card Number

                        @endif  

                       <span class="star">*</span>
                      </div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-8">
                        <input placeholder="Card Number" class="form-inputs" type="text" name="card_no" id="card_no"  value="{{isset($patient_arr['medicaredetails']['medicare_card_no'])?$patient_arr['medicaredetails']['medicare_card_no']:''}}" />
                         <div class="err" id="err_card_no"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box" id="div_medicare_details" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Medicare") style="display:block" @else style="display:none" @endif>
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-4">
                        <div class="form-lable big-lble">Medicare Card Expiry <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-6 col-md-5 col-lg-4 margn">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="card_month" id="card_month">
                              <option value="">- Month -</option>
                              @if(count($arr_months)>0)
                              @foreach($arr_months as $month)
                                 <option @if(isset($patient_arr['medicaredetails']['medicare_card_expiry_month']) && 
                                 $patient_arr['medicaredetails']['medicare_card_expiry_month']!="" && $patient_arr['medicaredetails']['medicare_card_expiry_month']==$month) selected="selected" @endif value="{{$month}}">{{$month}}</option>
                              @endforeach   
                              @endif
                           </select>
                        </div>
                        <div class="err" id="err_card_month"></div>
                     </div>
                     <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="card_year" id="card_year">
                              <option value="">- Year -</option>
                               <?php $current_year = date('Y');
                                 for($i=$current_year;$i<=($current_year+10);$i++)
                                 { 
                                    ?>

                                    <option @if(isset($patient_arr['medicaredetails']['medicare_card_expiry_year']) && 
                                 $patient_arr['medicaredetails']['medicare_card_expiry_year']!="" && $patient_arr['medicaredetails']['medicare_card_expiry_year']==$i) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                   <?php  
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="err" id="err_card_year"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box" id="div_upload_card"  @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && ($patient_arr['medicaredetails']['medicare_type']=="Concession" || $patient_arr['medicaredetails']['medicare_type']=="Safety Net Card")) style="display:block" @else style="display:none" @endif>
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-4">
                        <div class="form-lable hidden-xs hidden-sm">&nbsp;</div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-8">
                        <div class="medicl-detl">
                           <div class="photos-upload">
                             <div class="photo-pro-img">
                              @if(isset($patient_arr['medicaredetails']['card_image']) && $patient_arr['medicaredetails']['card_image']!="" && file_exists('uploads/patient/card-photo/'.$patient_arr['medicaredetails']['card_image']))
                              
                                 <img src="{{url('/')}}/public/uploads/patient/card-photo/{{$patient_arr['medicaredetails']['card_image']}}" width="188px" height="175px" alt=""/>
                              @else
                                 <img src="{{url('/')}}/public/images/no-image.png" alt="" width="188px" height="175px" />
                              @endif   
                             </div>
                              <input class="upload" name="card_photo" style="display:none" id="prescription_file1" type="file" />
                              <input type="hidden" name="old_card_photo" id="old_card_photo" value="{{isset($patient_arr['medicaredetails']['card_image'])?$patient_arr['medicaredetails']['card_image']:''}}">
                              <div class="fileUpload photo-up" style="cursor:pointer" onclick="triggerPrescriptionFile(this)"> 
                              <span>Upload A Photo of your Card </span> 
                             </div>
                           </div>
                        </div>
                        <div class="cant-find-txt" style="text-align:left;">
                           Or you can skip this now &amp; upload later
                        </div>
                        <div id="name_of_card_file"></div>
                        <div class="err" id="err_card_photo"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6" id="div_reference_no" @if(count($patient_arr['medicaredetails'])>0 && isset($patient_arr['medicaredetails']['medicare_type']) && $patient_arr['medicaredetails']['medicare_type']!="" && $patient_arr['medicaredetails']['medicare_type']=="Medicare") style="display:block" @else style="display:none" @endif>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-7">
                        <div class="form-lable">Individual Reference No. <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-5">
                        <input placeholder="Individual Reference No" name="reference_no" id="reference_no" value="{{isset($patient_arr['medicaredetails']['individual_card_no'])?$patient_arr['medicaredetails']['individual_card_no']:''}}" class="form-inputs" type="text"/>
                         <div class="err" id="err_reference_no"></div>
                         <a href="#what_is_this" class="what-is-link"  data-toggle="modal">what’s this?</a>  
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="add-new-head" id="regular_heading" style="cursor:pointer;">
            My Regular Doctor <span class="optional-txt"> (Optional)</span>
            <span class="drop-arw"><i class="fa fa-angle-down"></i></span>
         </div>
         <div class="clearfix"></div>
         <div id="div-my-regular-doctor" style="display:none;">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12  request-details-bx">
               <div class="med-his-txt">If you wish your family GP to be updated about your Doctoroo consultations, or if you'd like to invite them for future consultations, please enter their details below.
               </div>
               <h5 class="green-txxt">You only need to complete any details you know, we'll do our best to locate your Doctor.</h5>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="row request-details-bx">
            <div class="col-sm-12 col-md-12 col-lg-6"> 
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="form-lable">Doctor's Name</div>
                     </div>
                     <div class="col-sm-12 col-md-7 col-lg-7">
                        <input placeholder="Enter Doctor Name" name="doctor_name" id="doctor_name" class="form-inputs" type="text" value="{{isset($patient_arr['regulardoctor']['reg_doctor_name'])?$patient_arr['regulardoctor']['reg_doctor_name']:''}}" />
                         <div class="err" id="err_doctor_name"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="form-lable">Doctor's Practice Name</div>
                     </div>
                     <div class="col-sm-12 col-md-7 col-lg-7">
                        <input placeholder="Enter Doctor Practice Name" name="practice_name" id="practice_name" class="form-inputs" value="{{isset($patient_arr['regulardoctor']['reg_doctor_name'])?$patient_arr['regulardoctor']['reg_practice_name']:''}}" type="text"/>
                        <div class="err" id="err_practice_name"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="form-lable">Doctor's Phone</div>
                     </div>
                     <div class="col-sm-12 col-md-7 col-lg-7">
                        <input placeholder="Enter Doctor Phone" name="doctor_phone" id="doctor_phone" class="form-inputs" type="text" value="{{isset($patient_arr['regulardoctor']['reg_doctor_name'])?$patient_arr['regulardoctor']['reg_doctor_phone']:''}}" />
                        <div class="err" id="err_doctor_phone"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="form-lable">Doctor's Address</div>
                     </div>
                     <div class="col-sm-12 col-md-7 col-lg-7">
                        <textarea placeholder="Enter Doctor Address" rows="2" name="doctor_address" id="doctor_address"  style="padding-top:10px;height:89px;" class="form-inputs">{{isset($patient_arr['regulardoctor']['reg_doctor_name'])?$patient_arr['regulardoctor']['reg_doctor_address']:''}}</textarea>
                         <div class="err" id="err_doctor_address"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            
            <div class="col-sm-12 col-md-12 col-lg-10  request-details-bx">
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-5 col-lg-3">
                        <div class="form-lable hidden-xs hidden-sm">&nbsp;</div>
                     </div>
                     <div class="col-sm-12 col-md-7 col-lg-9">
                        <div class="check-box med-step2">
                           <input class="css-checkbox" id="radio-regular-notify" @if(isset($patient_arr['regulardoctor']['notify_my_regular_doctor']) &&
                            $patient_arr['regulardoctor']['notify_my_regular_doctor']==1) checked="checked" @endif name="notify_my_regular_doctor" type="checkbox" value="1" />
                           <label class="css-label radGroup2" for="radio-regular-notify">Notify my regular Doctor of all my consulations</label>
                        </div>
                        <div class="check-box med-step2">
                           <input class="css-checkbox" id="radio-regular-invite" @if(isset($patient_arr['regulardoctor']['invite_this_doctor']) &&
                            $patient_arr['regulardoctor']['invite_this_doctor']==1) checked="checked" @endif name="invite_this_doctor" type="checkbox" value="1" />
                           <label class="css-label radGroup2" for="radio-regular-invite">Invite this Doctor onto our platform</label>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
        </div> 
        <div class="add-new-head" id="pharmacy_heading">
            My Local Pharmacy <span class="optional-txt"> (Optional)</span>
         </div>
         <div id="div_load_pharmacy">
        
         <div class="row">
            <div class="col-sm-12">
               <div class="signup-txt">
                  To join our platform, search for your pharmacy below, select it and continue the registration processs
               </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
               <div class="search-bx">
                  <input type="text" class="search-in" name="search_pharmacy"  id="search_pharmacy" value="{{isset($patient_arr['suburb'])?$patient_arr['suburb']:''}}" placeholder="Search By Suburb or Postcode" />
                  <span> <button class="pharna-search-btn" type="button" id="pharmacy_search"> Search</button></span>
                  <div class="err" id="err_search_pharmacy"></div>
               </div>

               <div class="left-map-section" id="content-d1">
                  <div class="chatting-section">
                   @if(count($arr_pharmacies)>0)
                  <?php $i=0;?>
                  @foreach($arr_pharmacies as $pharmacy)
                     <div class="pharma-row <?php if($i==(count($arr_pharmacies)-1)){ echo"last"; } ?>">
                        <div class="row">
                           <div class="col-sm-7 col-md-6 col-lg-7">
                              <div class="home-icon @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) act @endif"> <i class="fa fa-home"></i></div>
                                <div class="pharmcy-detail-bx">
                                 <a href="javascript:void(0);" onclick="myClick('<?php echo $i;?>');" @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) class="act" @endif>  {{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}}</a>
                                 <div class="pharna-add">
                                    {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                                     <br/>
                                    {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-5 col-md-6 col-lg-5">
                              <div class="pharma-btns">
                                 <button class="details-btn" type="button" onclick="getDetails('<?php echo $pharmacy['id'];?>');">Details</button>
                               {{--   <button class="details-btn select-btn">Select</button> --}}
                               <div class="step-radios1 rdio-select-btn">
                                 <div class="radio-btn">
                                    <input type="radio" @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) checked="checked" @endif name="local_pharmacy" id="local_pharmacy<?php echo $pharmacy['id'];?>" value="{{ $pharmacy['id'] }}">
                                    <label for="local_pharmacy<?php echo $pharmacy['id'];?>">
                                    <span class="interior-icon">
                                     Select
                                    </span>
                                    </label>
                                    <div class="check"></div>
                                 </div>
                               </div>
                              </div> 
                           </div>
                        </div>
                     </div>
                     <?php $i++;?>
                     <!--Pharmacy Deatil -->
                    <div id="pharmacydetail{{$pharmacy['id']}}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
                       <div class="modal-dialog loign-insw">
                          <!-- Modal content-->
                          <div class="modal-content logincont">
                             <div class="modal-header head-loibg">
                                <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
                             </div>
                             <div class="modal-body bdy-pading">
                                 <div class="login_box">
                                  <div class="title_login">Pharmacy Details</div>
                                   <div class="forget-txt bb-head">{{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}}</div>
                                   <div class="forget-txt">
                                     <div class="popup-icns">
                                      <img src="{{url('/')}}/public/images/marker.jpg" width="20px" />
                                      </div>
                                      <div class="popup-details-content">
                                        <div class="forget-txt">  
                                        {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                                        <br/>
                                        {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                                      </div>  
                                     </div>
                                     <div class="clearfix"></div>
                                        <div class="popup-icns">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <div class="popup-details-content">
                                          {{ isset($pharmacy['phone_no'])?$pharmacy['phone_no']:' ' }}
                                        </div>
                                   </div>  
                                   <div class="clearfix"></div>
                                  <br/>
                               </div>
                            </div>
                          </div>
                       </div>
                    </div>
                     @endforeach 
                  </div>
                  @else
                 <div class="alert alert-info alert-dismissible" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <strong>Sorry,</strong> Currently no any pharmacy avaliable.
                 </div>
                 @endif 
               </div>
              </div>
            </div>  
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="pharma-map" id="map" style="width:100%;height:465px;"></div>
            </div>
         </div>
         </div>
         <div class="pull-right hidden-lg" style="margin:10px 0 0">
            <button class="search-btn btn_save_profile" name="btn_save_profile"  type="button">Save My Profile</button>
         </div>
         <div class="clearfix"></div>
         <br/>
       </form> 
      </div>
   </div>
  <div class="sticky_btn visible-lg">
        <button class="search-btn btn_save_profile" name="btn_save_profile"  type="button">Save My Profile</button>
     </div>
</div>
  <div id="what_is_this" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body bdy-pading">
             <div class="login_box">
              <div class="title_login">Medicare Card Detail</div>
              <div class="medicare-div">
                <img src="{{url('/')}}/public/images/madicare.png"/>
              </div>
           </div>
          </div>
        </div>
      </div>
      </div>




<!--Pharmacy Deatil end here-->
<!--dashboard section-->
 <!--file upload js -->
<script src="{{url('/')}}/public/js/bootstrap-fileupload.js"></script>
<link href="{{url('/')}}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- custom scrollbar plugin -->
<script src="{{url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>    
<script  src="{{ url('/') }}/public/js/jquery-ui.js"></script> 
<script>
      (function($){
      $(window).on("load",function(){
      
      $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
      $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
      
              $("#content-d1").mCustomScrollbar({theme:"dark"});
    
              
      });
      })(jQuery);

      function readURL(input) {


        if (input.files) {

           var profile_image=input.files[0]['name'];
          
            $("#err_profile_image").html("");

             var ext = profile_image.split('.').pop();
          
             var file, img;

             if(ext != "gif" && ext != "GIF" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG" && ext != "png" && ext != "PNG" && ext != "BMP" && ext != "bmp")
             {
                    
                    $('#err_profile_image').fadeIn(); 
                   $('#err_profile_image').html('Please upload valid file with valid image extension i.e png,jpg,gif,bmp.');
                   $('#err_profile_image').fadeOut(4000);
                   $('html, body').animate({
                         scrollTop: $('#div_profile_of_patient').offset().top
                     }, 'slow');
                   $('#profile_image').focus();
                   return false;
             }
             else
             {
                  var reader = new FileReader();
              
                  reader.onload = function (e) {
                      $('#upload-f')
                          .attr('src', e.target.result)
                          .width(160)
                          .height(160);
                  };
                
                  reader.readAsDataURL(input.files[0]);
                  return true
            }      
        }
     }
</script>
{{--notification script--}}
  <input type="hidden" id="arr_notification" value="{{ (isset($arr_notification))? json_encode($arr_notification): json_encode(array()) }}">

 <script src="{{ url('/') }}/public/js/OneSignalSDK.js" async='async'></script>
 <script>

           var login_user_id   = '{{ $user_id }}';

           var OneSignal = window.OneSignal || [];
     
            OneSignal.push(["init", {
            appId: "11df23bf-ba27-40dc-b05d-04d636487720",
            autoRegister: true, 
            subdomainName: 'https://doctoroo.onesignal.com',

           
            httpPermissionRequest: {
              enable: true
            },

            notifyButton: {
                enable: false /* Set to false to hide */
            }
          }]);
          OneSignal.push(["sendTags", {user_id:login_user_id}]);
</script>

<script>

function getDetails(ref)
{

    $('#pharmacydetail'+ref).modal('show');
}

function getPharmacy(suburb)
{
   
  // var suburb = $('#suburb').val();

   if(suburb!="")
   {

    
      $('#search_pharmacy').val(suburb);

         $.ajax({
            url   : "{{ url('/') }}/patient/search_pharmacy_by_suburb",
            type : "GET",
            data: 'search_pharmacy='+suburb,
            beforeSend: function() {
               showProcessingOverlay();
            },
            success : function(res){
               
               if($.trim(res)!='error')
               {
                 
                   $('#div_load_pharmacy').html(res); 
                   initialize();
                   $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
                   $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
                   $("#content-d1").mCustomScrollbar({theme:"dark"});
              
                   return true; 
               }
            },
           complete: function() {
                 $('html, body').animate({
                     scrollTop: $('#pharmacy_heading').offset().top
                 }, 'slow');
                hideProcessingOverlay();
            }
         });
   }

}

 $(document).ready(function(){

   $('#phone_no').keyup(function()
     {
         num = $(this).val().replace(/\D/g,''); 
         $(this).val('('+num.substring(0,2) + ') ' + num.substring(2,6) + ' ' + num.substring(6,10)); 
      
     });

  /*=================Toggle script for hide div=====*/
  $('#regular_heading').click(function(){

     var clicks = $(this).data('clicks');
      if (clicks) {

        $('.drop-arw i').removeClass('fa fa-angle-up');
        $('.drop-arw i').addClass('fa fa-angle-down');  
        
      } else {

          $('.drop-arw i').removeClass('fa fa-angle-down');
          $('.drop-arw i').addClass('fa fa-angle-up');
      }
    $(this).data("clicks", !clicks);
    $('#div-my-regular-doctor').toggle();
  });

 $('#span_manually_address').click(function(){

    $('#manually_div').toggle();
 });
  /*get listing of all suburb & postcode*/
  $("input[name='search_pharmacy']").autocomplete(
  {
         
          minLength:3,
          extraParams: {
             country: 'Australia'
          },       
          source:"{{url('/')}}/patient/location_listing",
          search: function () {


               /*showProcessingOverlay();*/

           },
           response: function () {
             /*hideProcessingOverlay();*/
          },
          select:function(event,ui)
          {
              
            var search_pharmacy = $('#search_pharmacy').val();

            if($.trim(search_pharmacy)=="")
            {

               $('#search_pharmacy').val('');
               $('#err_search_pharmacy').html('Please enter suburb or postcode.');
               $('#err_search_pharmacy').fadeOut(4000);
               $('#search_pharmacy').focus();
               return false;

            }
            else
            {     


               $.ajax({
                  url   : "{{ url('/') }}/patient/search_pharmacy",
                  type : "GET",
                  data: 'search_pharmacy='+search_pharmacy,
                  beforeSend: function() {
                     showProcessingOverlay();
                  },
                  success : function(res){
                     
                     if($.trim(res)!='error')
                     {
                         
                         $('#div_load_pharmacy').html(res); 
                         initialize();
                         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
                         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
                         $("#content-d1").mCustomScrollbar({theme:"dark"});
                    
                         return true; 
                     }
                  },
                  complete: function() {
                     hideProcessingOverlay();
                  }
               });
            }   
          }
    });

   $('#pharmacy_search').on('click',function(){


      var search_pharmacy = $('#search_pharmacy').val();

      if($.trim(search_pharmacy)=="")
      {

         $('#search_pharmacy').val('');
         $('#err_search_pharmacy').html('Please enter suburb or postcode.');
         $('#err_search_pharmacy').fadeOut(4000);
         $('#search_pharmacy').focus();
         return false;

      }
      else
      {     


         $.ajax({
            url   : "{{ url('/') }}/patient/search_pharmacy",
            type : "GET",
            data: 'search_pharmacy='+search_pharmacy,
            beforeSend: function() {
               showProcessingOverlay();
            },
            success : function(res){
               
               if($.trim(res)!='error')
               {
                   
                   $('#div_load_pharmacy').html(res); 
                   initialize();
                   $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
                   $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
                   $("#content-d1").mCustomScrollbar({theme:"dark"});
              
                   return true; 
               }
            },
            complete: function() {
               hideProcessingOverlay();
            }
         });
      }   
   });     
   
   /*=====Upload Card Photo==============================*/


     $("#prescription_file1").change(function (e) 
     {

         var filename=$("#prescription_file1").val();
         $('#name_of_card_file').html(filename);
         var flag=1;
         $("#err_card_photo").html("");

         var ext = filename.split('.').pop();
         var file, img;

         if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG" || ext == "BMP" || ext == "bmp")
         {
               $("#err_card_photo").html("");
         }  
         else
         {
               $('#err_card_photo').html('Please upload valid file with valid image extension i.e png,jpg,gif,bmp.');
               $('#err_card_photo').fadeOut(4000);
               $('html, body').animate({
                     scrollTop: $('#div_medicare_section').offset().top
                 }, 'slow');
               $('#prescription_file1').focus();
               return false;
         }
     
   });

  /*============Medicare Script============================*/

   $('input[name="medicare_type"]').on('change',function(){

      var option = $( 'input[name=medicare_type]:checked' ).val();

      if(option=='Private')
      {

         $('div#div_medicare').hide();
      }
      if(option=='Medicare')
      {

         $('#name_of_card').html('Medicare Card Number <span class="star">*</span>'); 
         $('div#div_medicare').show();
         $('div#div_medicare_details').show();
         $('div#div_upload_card').hide();
         $('div#div_reference_no').show();
      }
      if(option=='Concession' || option=="Safety Net Card")
      {
         if(option=="Concession") 
         {
          
            $('#name_of_card').html('Concession Card Number <span class="star">*</span>');
         }

         if(option=='Safety Net Card')   
         {

             $('#name_of_card').html('Safety Card Number <span class="star">*</span>');
         }

         $('div#div_medicare').show();
         $('div#div_upload_card').show();
         $('div#div_medicare_details').hide();
         $('div#div_reference_no').hide();
      }
     

   });

   /*===================Validation(Seema-27-Feb-2017)================================*/

     $('.btn_save_profile').click(function(){
   
      var err_flag = 0;

      var title         = $('#title').val();
      var first_name    = $('#first_name').val();
      var last_name     = $('#last_name').val();
      var day_of_birth  = $('#day_of_birth').val();
      var date_of_month = $('#date_of_month').val();
      var date_of_year  = $('#date_of_year').val();
      var mobile_no     = $('#mobile_no').val();
      var phone_no      = $('#phone_no').val();
      var address       = $('#autocomplete').val();
      //var country       = $('#country').val();
     // var state         = $('#administrative_area_level_1').val();
      var city          = $('#locality').val();
      var manually_add  = $('#manually_address').val();
      var suburb        = $('#suburb').val();
      //var postal_code   = $('#postal_code').val();

      /*=============Medicare==================================*/

      var medicare_type = $('input[name="medicare_type"]:checked').val();
      var card_no       = $('#card_no').val();
      var reference_no  = $('#reference_no').val();
      var card_month    = $('#card_month').val();
      var card_year     = $('#card_year').val();
      var card_photo    = $('#prescription_file1').val();
      var old_card_photo= $('#old_card_photo').val();
      var card_ext      = card_photo.split('.').pop();

      /*=============Regular Doctor================================*/

      var doctor_name    = $('#doctor_name').val();
      var practice_name  = $('#practice_name').val();
      var doctor_phone   = $('#doctor_phone').val();
      var doctor_address = $('#doctor_address').val();

      var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var nodigit_regexp= /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
      var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;

      var phone_no_filter=/\?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

     /// var phone_no_filter=/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;


      if($.trim(title)=="")
      {
       
         $('#title').val('');
         $('#err_title').fadeIn();         
         $('#err_title').html('Please enter title.');
         $('#err_title').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#title').focus();
         err_flag = 1
      } 
     else if($.trim(first_name)=="")
      {
        
         $('#first_name').val('');
         $('#err_first_name').fadeIn();
         $('#err_first_name').html('Please enter first name.');
         $('#err_first_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#first_name').focus();
         err_flag = 1
      } 
      else if(!nodigit_regexp.test(first_name))
      {
        
         $('#first_name').val('');
         $('#err_first_name').fadeIn();
         $('#err_first_name').html('Please enter valid first name,only character allowed.');
         $('#err_first_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#first_name').focus();
          err_flag = 1
      } 
      else if($.trim(last_name)=="")
      {

         $('#last_name').val('');
         $('#err_last_name').fadeIn();
         $('#err_last_name').html('Please enter last name.');
         $('#err_last_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#last_name').focus();
          err_flag = 1
      } 
      else if(!nodigit_regexp.test(last_name))
      {
         $('#last_name').val('');
         $('#err_last_name').fadeIn();
         $('#err_last_name').html('Please enter valid last name,only character allowed.');
         $('#err_last_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#last_name').focus();
          err_flag = 1
      } 
      else if(!$('input[name="gender"]').is(':checked'))
      {
         $('#err_gender').fadeIn();
         $('#err_gender').html('Please select gender.');
         $('#err_gender').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('input[name="gender"]').focus();
          err_flag = 1
      } 
      else if($.trim(day_of_birth)=="")
      {
         $('#day_of_birth').val('');
         $('#err_day_of_birth').fadeIn();
         $('#err_day_of_birth').html('Please select day.');
         $('#err_day_of_birth').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#day_of_birth').focus();
          err_flag = 1
      } 
      else if($.trim(date_of_month)=="")
      {

         $('#date_of_month').val('');
         $('#err_date_of_month').fadeIn();
         $('#err_date_of_month').html('Please select month.');
         $('#err_date_of_month').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#date_of_month').focus();
          err_flag = 1
      } 
      else if($.trim(date_of_year)=="")
      {

         $('#date_of_year').val('');
         $('#err_date_of_year').fadeIn();
         $('#err_date_of_year').html('Please select year.');
         $('#err_date_of_year').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#date_of_year').focus();
          err_flag = 1
      } 
      else if($.trim(mobile_no)=="")
      {
         $('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(!onlydigit.test(mobile_no))
      {
         $('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter valid mobile number.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(mobile_no.length < 10)
      {
         //$('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number of 10 digit.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(mobile_no.length > 10)
      {
       
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number of 10 digit.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if($.trim(phone_no)=='')
      {
         $('#err_phone_no').show();
         $('#phone_no').focus();
         $('#err_phone_no').html('Please enter phone number.');
         $('#err_phone_no').fadeOut(4000);

         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#phone_no').focus();
          err_flag = 1
      } 
  
      else if(phone_no=='()  ' || phone_no.length<14)
      {
         $('#err_phone_no').show();
         $('#phone_no').focus();
         $('#err_phone_no').html('Please enter valid phone number.');
         $('#err_phone_no').fadeOut(4000);

         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#phone_no').focus();
          err_flag = 1
      } 

    
      else if($.trim(address)=="")
      {
         $('#autocomplete').val('');
         $('#err_address').fadeIn();
         $('#err_address').html('Please enter your address.');
         $('#err_address').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#autocomplete').focus();
          err_flag = 1
      } 
      else if($.trim(suburb)=="" && manually_add!="")
      {
         $('#suburb').val('');
         $('#err_suburb').fadeIn();
         $('#err_suburb').html('Please enter suburb name.');
         $('#err_suburb').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#suburb').focus();
          err_flag = 1
      } 
   /*   else if(!nodigit_regexp.test(suburb) && manually_add!="")
      {
         $('#suburb').val('');
         $('#err_suburb').fadeIn();
         $('#err_suburb').html('Please enter valid suburb,only character allowed.');
         $('#err_suburb').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#suburb').focus();
          err_flag = 1
      } */
      /* else if($.trim(postal_code)=="")
      {
         $('#postal_code').val('');
         $('#err_zipcode').fadeIn();
         $('#err_zipcode').html('Please enter zipcode.');
         $('#err_zipcode').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#postal_code').focus();
          err_flag = 1
      } 
      else if(!onlydigit.test(postal_code))
      {
         $('#postal_code').val('');
         $('#err_zipcode').fadeIn();
         $('#err_zipcode').html('Please enter valid zipcode.');
         $('#err_zipcode').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#postal_code').focus();
          err_flag = 1
      } */
     else if(!$('input[name="medicare_type"]').is(':checked'))
      {

         $('#err_medicare_type').fadeIn();
         $('#err_medicare_type').html('Please select medicare type.');
         $('#err_medicare_type').fadeOut(10000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('input[name="medicare_type"]').focus();
          err_flag = 1
      } 
      else if((medicare_type=='Medicare' || medicare_type=='Concession') && $.trim(card_no)=="")
      {

         $('#err_card_no').fadeIn();
         $('#err_card_no').html('Please enter card number.');
         $('#err_card_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#card_no').focus();
          err_flag = 1
      }
      else if((medicare_type=='Medicare' || medicare_type=='Concession') && !onlydigit.test(card_no))
      {
         
         $('#err_card_no').fadeIn();
         $('#err_card_no').html('Please enter valid card number,only number is allowed.');
         $('#err_card_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#card_no').focus();
          err_flag = 1
      }
       else if(medicare_type=='Medicare' && $.trim(reference_no)=="")
      {

         $('#err_reference_no').fadeIn();
         $('#err_reference_no').html('Please enter reference number.');
         $('#err_reference_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#reference_no').focus();
          err_flag = 1
      } 
      else if(medicare_type=='Medicare' && $.trim(card_month)=="")
      {

         $('#err_card_month').fadeIn();
         $('#err_card_month').html('Please select card expiry month.');
         $('#err_card_month').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#card_month').focus();
          err_flag = 1
      } 
      else if(medicare_type=='Medicare' && $.trim(card_year)=="")
      {

         $('#err_card_year').fadeIn();
         $('#err_card_year').html('Please select card expiry year.');
         $('#err_card_year').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#card_year').focus();
          err_flag = 1
      } 
      else if(medicare_type=='Concession' && $.trim(card_photo)=="" && $.trim(old_card_photo)=="")
      {

         $('#err_card_photo').fadeIn();
         $('#err_card_photo').html('Please upload your card photo.');
         $('#err_card_photo').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#prescription_file1').focus();
          err_flag = 1
      } 
      else if(medicare_type=='Concession' && $.trim(card_photo)!="" && card_ext == "gif" && card_ext == "GIF" && card_ext == "JPEG" && card_ext == "jpeg" && card_ext == "jpg" && card_ext == "JPG" && card_ext == "png" && card_ext == "PNG" && card_ext == "BMP" && card_ext == "bmp")
      {

         $('#err_card_photo').fadeIn();
         $('#err_card_photo').html('Please upload your card photo.');
         $('#err_card_photo').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div_medicare_section').offset().top
           }, 'slow');
         $('#prescription_file1').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_name)=="")
      {

         $('#doctor_name').val('');
         $('#err_doctor_name').fadeIn();
         $('#err_doctor_name').html('Please enter doctor name.');
         $('#err_doctor_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_name').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_name)!="" && !nodigit_regexp.test(doctor_name))
      {

         $('#doctor_name').val('');
         $('#err_doctor_name').fadeIn();
         $('#err_doctor_name').html('Please enter valid doctor name,only character allowed.');
         $('#err_doctor_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_name').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(practice_name)=="")
      {

         $('#practice_name').val('');
         $('#err_practice_name').fadeIn();
         $('#err_practice_name').html('Please enter practice doctor name.');
         $('#err_practice_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#practice_name').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(practice_name)!="" && !nodigit_regexp.test(practice_name))
      {

         $('#practice_name').val('');
         $('#err_practice_name').fadeIn();
         $('#err_practice_name').html('Please enter valid practice name,only character allowed.');
         $('#err_practice_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#practice_name').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_phone)=="")
      {

         $('#doctor_phone').val('');
         $('#err_doctor_phone').fadeIn();
         $('#err_doctor_phone').html('Please enter doctor phone number.');
         $('#err_doctor_phone').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_phone').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_phone)!="" && !onlydigit.test(doctor_phone))
      {

         $('#doctor_phone').val('');
         $('#err_doctor_phone').fadeIn();
         $('#err_doctor_phone').html('Please enter valid phone number.');
         $('#err_doctor_phone').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_phone').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_phone)!="" && doctor_phone.length < 7)
      {
         
         $('#doctor_phone').val('');
         $('#err_doctor_phone').fadeIn();
         $('#err_doctor_phone').html('Please enter mobile number is greater than 7 digit.');
         $('#err_doctor_phone').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_phone').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_phone)!="" && doctor_phone.length > 16)
      {
      
         $('#doctor_phone').val('');
         $('#err_doctor_phone').fadeIn();
         $('#err_doctor_phone').html('Please enter mobile number is less than 16 digit.');
         $('#err_doctor_phone').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_phone').focus();
          err_flag = 1
      } 
      else if($('input[name="invite_this_doctor"]').is(':checked') && $.trim(doctor_address)=="")
      {
      
         $('#doctor_address').val('');
         $('#err_doctor_address').fadeIn();
         $('#err_doctor_address').html('Please enter doctor address.');
         $('#err_doctor_address').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#div-my-regular-doctor').offset().top
           }, 'slow');
         $('#doctor_address').focus();
          err_flag = 1
      } 
      if(err_flag==0)
      {

          $('#profile-modal').modal('toggle');
      }
      else
      {
          return false;
      }
     

    });   
 });  
</script>

<script>

     
function init()
{

   initialize();
   initAutocomplete();

}
   /*================Map================*/
   var markers = [];
   var local_pharmacy = "<?php echo $patient_arr['my_local_pharmacy'];?>";
   function initialize() 
   {

    var site_url           = "{{ $site_url }}";
    var locations =[];  
    <?php if(count($arr_pharmacies)>0){  $i=0;?>

    locations = [

      <?php foreach ($arr_pharmacies as $pharmacy) { 
     
         $pharmacy_name = preg_replace("/(\'|&#0*39;)/", "", $pharmacy['pharmacy_name']); ?>
   

         [<?php echo"'".$pharmacy_name."'";?>, <?php echo $pharmacy["latitude"];?>, <?php echo $pharmacy["longitude"];?>,<?php echo $pharmacy['id'];?>]
         <?php if($i<count($arr_pharmacies)-1){
         echo',';
         }
      }
      $i++;
     
      ?>   
    ];
    <?php }?>
    
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 3,
      center: new google.maps.LatLng(-33.865143, 151.209900),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();

 

    var marker, i;

    for (i = 0; i < locations.length; i++) 
    {  
        
      if(local_pharmacy==locations[i][3])  
      {

           var icon = {
                          url: site_url+'/images/map-green-icon.png', 
                      };
      }
      else
      {

          var icon = {
                          url: site_url+'/images/map-green-icon.png', 
                      };
      }

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        title: locations[i][0],
         icon:icon
      });

      latlngbounds.extend(marker.position);

      var content = '<div class="pharmcy-detail-bx" style="font-size: 13px;line-height: 18px;font-weight: 400; margin-right: 1px;max-height: 80px;overflow-y: auto;overflow-x: hidden;font-family:robotolight",sans-serif">'+locations[i][0]+'</div>';

       /*===================On Click===========================================*/   

         google.maps.event.addListener(marker, 'click', (function(marker, i) {
           return function() {

             <?php if(count($arr_pharmacies)>0){
             foreach ($arr_pharmacies as $pharmacy) 
             {

                 $pharmacy_id = '#pharmacydetail'.$pharmacy['id'];  
                $pharmacy_name = preg_replace("/(\'|&#0*39;)/", "", $pharmacy['pharmacy_name']);

            ?>

           var pharmacy_name = "<?php echo $pharmacy_name;?>";
              if(pharmacy_name==locations[i][0])
              {

              $('<?php echo $pharmacy_id;?>').modal('show');
            }
            <?php } }?>

          infowindow.setContent(content);
          infowindow.open(map, marker);
          setHighlightPharmacy(i);

           }

        })(marker, i));   

      /*===================MouseOver===========================================*/   
      
         google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
           return function() {

        
          
          var infowindow = new google.maps.InfoWindow({
            content: content,
            borderRadius: 4,
            borderWidth: 10,
            borderColor: '#FF0000',
            maxWidth: 300
          });


          infowindow.open(map, marker);
          setHighlightPharmacy(i);

           }

         
         })(marker, i));

        
      markers.push(marker);
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);


    }


 }
           
  function myClick(id){

      google.maps.event.trigger(markers[id], 'click');
  }

function setHighlightPharmacy(elem)
{
   $('.pharmacy_div').removeClass('highlight-pharma-row');
   $('.pharmacy_'+elem).removeClass('pharma-row');
   $('.pharmacy_'+elem).addClass('highlight-pharma-row');

   setTimeout(function(){
      $('.pharmacy_'+elem).focus();

     },200);
  
  
}
  </script>

<script>

  var glob_autocomplete;
  var componentForm = 
  {
    street_number: 'long_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'long_name',
    postal_code: 'short_name',
    country:'long_name'
  };

  var glob_options = {};
  glob_options.types = ['address'];

  function changeCountryRestriction(ref)
  {
    var country_code = $(ref).val();
    destroyPlaceChangeListener(autocomplete);
    // load states function
    // loadStates(country_code);  

    glob_options.componentRestrictions = {country: country_code}; 

    initAutocomplete(country_code);

    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
  }


  function initAutocomplete(country_code) 
  {
    glob_options.componentRestrictions = {country: country_code}; 

    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
  }


  function initGoogleAutoComponent(elem,options,autocomplete_ref)
  {
    autocomplete_ref = new google.maps.places.Autocomplete(elem,options);
    autocomplete_ref = createPlaceChangeListener(autocomplete_ref,fillInAddress);

    return autocomplete_ref;
  }
  

  function createPlaceChangeListener(autocomplete_ref,fillInAddress)
  {
    autocomplete_ref.addListener('place_changed', fillInAddress);
    return autocomplete_ref;
  }

  function destroyPlaceChangeListener(autocomplete_ref)
  {
    google.maps.event.clearInstanceListeners(autocomplete_ref);
  }

  function fillInAddress() 
  {
    // Get the place details from the autocomplete object.
    var place = glob_autocomplete.getPlace();

    for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
    }

    

    if(place.address_components.length > 0 )
    {

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

        var locality  = $('#locality').val();
        var state     = $('#administrative_area_level_1').val();
        var postcode  = $('#postal_code').val();
        var new_suburb = locality+' '+state+' '+postcode;
        $('#suburb').val(new_suburb);
        getPharmacy(new_suburb);

      }

      /*$.each(place.address_components,function(index,elem)
      {
          var addressType = elem.types[0];
       
          if(glob_component_form[addressType])
          {
             var val = elem[glob_component_form[addressType]];
             $("#"+addressType).val();  

          }
      });  
*/
    //}
    
  }

</script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3&region=Australia&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places&callback=init" async defer></script>

@stop      