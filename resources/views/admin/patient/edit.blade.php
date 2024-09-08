@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
   .grn-msg
   {
   color:green;
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
      <li><a href="{{ url($admin_panel_slug.'/patient') }}">Manage Patient </a></li>
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
         <br/>
         @include('admin.layout._operation_status') 
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
         @if(count($arr_patient)>0)   
         <form method="post" action="{{$module_url_path.'/update/'.base64_encode($arr_patient['userinfo']['id'])}}" id="frm_edit_patient" name="frm_edit_patient" enctype="multipart/form-data">
            {{ csrf_field() }}
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
                              <label for="textfield1" class="col-xs-3 col-lg-3 control-label">Title <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <select tabindex="1" name="title" id="title" class="form-control">
                                    <!-- <option value="">-Select Title-</option>
                                    <option @if(isset($arr_patient['userinfo']['title']) && $arr_patient['userinfo']['title']=="Miss") selected="selected" @endif value="Miss">Miss</option>
                                    <option @if(isset($arr_patient['userinfo']['title']) && $arr_patient['userinfo']['title']=="Mr") selected="selected" @endif value="Mr">Mr</option> -->
                                     <option value="">- Title -</option>
                                    @if(isset($arr_prefix) && sizeof($arr_prefix)>0)
                                        @foreach($arr_prefix as $prefix)
                                          <option value="{{ $prefix['name'] or '' }}" @if(isset($arr_patient['userinfo']['title']) && $arr_patient['userinfo']['title']==$prefix['name']) selected="selected" @endif >{{ $prefix['name'] or '' }}</option>
                                        @endforeach
                                     @endif
                                 </select>
                                 <div class="err" id="err_title">{{ $errors->first('title') }}</div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="textfield1" class="col-xs-3 col-lg-3 control-label">First Name <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{isset($arr_patient['userinfo']['first_name'])?$arr_patient['userinfo']['first_name']:''}}">
                                 <div class="err" id="err_first_name"> {{ $errors->first('first_name') }} </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="last_name" class="col-xs-3 col-lg-3 control-label">Last Name <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input type="text" class="form-control" name="last_name" placeholder="Last Name" id="last_name" value="{{isset($arr_patient['userinfo']['last_name'])?$arr_patient['userinfo']['last_name']:''}}">
                                 <div class="err" id="err_last_name">{{ $errors->first('last_name') }}</div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="gender" class="col-xs-3 col-lg-3 control-label">Gender <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <div class="form-inline">
                                    Male <input type="radio" name="gender" id="gender" @if(isset($arr_patient['gender']) && $arr_patient['gender']=="M") checked="checked" @endif value="M" class="form-control"> 
                                    Female <input type="radio" name="gender" id="gender" @if(isset($arr_patient['gender']) && $arr_patient['gender']=="F") checked="checked" @endif value="F" class="form-control"> 
                                 </div>
                                 <div class="err" id="err_gender">{{ $errors->first('gender') }}</div>
                              </div>
                           </div>
                           <?php $day=$months=$year="";
                              if(isset($arr_patient['date_of_birth']) && $arr_patient['date_of_birth']!='0000-00-00')
                              {
                              
                                  list($year,$months,$day) = explode('-',$arr_patient['date_of_birth']);
                              } 
                              
                              ?>
                           <div class="form-group">
                              <label for="" class="col-xs-3 col-lg-3 control-label">Date of Birth <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-2 controls">
                                 <select tabindex="1" name="day_of_birth" id="day_of_birth" class="form-control">
                                    <option value="">-Day-</option>
                                    <?php for($i=1;$i<=31;$i++)
                                       { ?>
                                    <option @if($day!="" && $i==$day) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                    <?php } ?>
                                 </select>
                                 <div class="err" id="err_day_of_birth">{{ $errors->first('day_of_birth') }}</div>
                              </div>
                              <div class="col-sm-9 col-lg-3 controls">
                                 <select tabindex="1" name="date_of_month" id="date_of_month" class="form-control">
                                    <option value="">-Month-</option>
                                    @if(count($arr_months)>0)
                                    @foreach($arr_months as $key=>$month)
                                    <option @if($months!="" && $key==$months) selected="selected" @endif value="{{$key}}">{{$month}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 <div class="err" id="err_date_of_month">{{ $errors->first('date_of_month') }}</div>
                              </div>
                              <div class="col-sm-9 col-lg-3 controls">
                                 <select tabindex="1" name="date_of_year" id="date_of_year" class="form-control">
                                    <option value="">-Year-</option>
                                    <?php $current_year = date('Y');
                                       for($i=1867;$i<=$current_year;$i++)
                                       { ?>
                                    <option @if($year!="" && $i==$year) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                    <?php } ?>
                                 </select>
                                 <div class="err" id="err_date_of_year">{{ $errors->first('date_of_year') }}</div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br>
                           <div class="form-group">
                              <label for="email" class="col-xs-3 col-lg-3 control-label">Email <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Email Id" value="{{isset($arr_patient['userinfo']['email'])?$arr_patient['userinfo']['email']:''}}" readonly="true">
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="phone_no" class="col-xs-3 col-lg-3 control-label">Contact No.</label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input type="text" name="phone_no" id="phone_no" value="" class="form-control" placeholder="Contact No ">
                                 <div class="err" id="err_phone_no"></div>
                              </div>

                                 <input placeholder="" name="enc_phone_no" id="enc_phone_no" class="form-control" type="hidden" value="" readonly="" />
                           </div>
                           <div class="clearfix">{{ $errors->first('first_name') }}</div>
                           <br/>
                           <div class="form-group">
                              <label for="mobile_no_code" class="col-xs-3 col-lg-3 control-label">Mobile Number <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-3 col-lg-4 controls">
                                 <select name="mobile_no_code" id="mobile_no_code" class="form-control">
                                       <option value="">Select Code</option>
                                       @if(isset($mobcode_data) && !empty($mobcode_data))
                                          @foreach($mobcode_data as $mobcode)
                                              <option value="{{ $mobcode['id'] }}" {{isset($arr_patient['mobile_code']) && $arr_patient['mobile_code'] == $mobcode['id'] ? 'selected' : '' }} > +{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }}) </option>
                                          @endforeach
                                       @endif
                                 </select>
                                 <div class="err" id="err_mobile_code">{{ $errors->first('mobile_no_code') }}</div>
                              </div>
                              <div class="col-sm-6 col-lg-4 controls">
                                 <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile Number" value="{{isset($arr_patient['mobile_no'])?decrypt_value($arr_patient['mobile_no']):''}}">
                                 <div class="err" id="err_mobile_no">{{ $errors->first('mobile_no') }}</div>
                                 
                                 <input placeholder="" name="enc_mobile_no" id="enc_mobile_no" class="form-control" type="hidden" value="" readonly="" />

                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="address" class="col-xs-3 col-lg-3 control-label">Address <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input placeholder="Enter your Postal Address" name="address" id="autocomplete" class="form-control" type="text" value=""/>
                                 <input type="hidden" name="street_number" id="street_number">
                                 <input type="hidden" name="route" id="route">
                                 <input type="hidden" name="locality" id="locality">
                                 <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1">
                                 <input type="hidden" name="post_code" id="postal_code">
                                 <input type="hidden" name="country" id="country">
                                 {{-- <a href="javascript:void(0);"><span id="span_manually_address" class="grn-msg"> Or enter address manually</span></a> --}}
                                 <div class="err" id="err_address">{{ $errors->first('address') }}</div>
                                 
                                 <input placeholder="" name="enc_address" id="enc_address" class="form-control" type="hidden" value="" readonly=""/>

                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="password2" class="col-xs-3 col-lg-3 control-label">Patient Profile <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <div style="width: 200px; height: 150px;" class="fileupload-new img-thumbnail">
                                       @if(isset($arr_patient['userinfo']['profile_image']) && $arr_patient['userinfo']['profile_image']!="" && file_exists($patient_profile_img_base_path.$arr_patient['userinfo']['profile_image']))
                                       <img src="{{$patient_profile_img_public_path.$arr_patient['userinfo']['profile_image']}}" width="188px" height="175px" alt=""/>
                                       @else
                                       <img src="{{url('/')}}/public/images/no-image.png" alt="" width="188px" height="175px" />
                                       @endif 
                                    </div>
                                    <div style="max-width: 200px; max-height: 150px; line-height: 30px;" class="fileupload-preview fileupload-exists img-thumbnail"></div>
                                    <div>
                                       <span class="btn btn-default btn-file"><span class="fileupload-new">Select Image</span> 
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="profile_image" class="file-input" id="profile_image">
                                       <input type="hidden" name="old_profile_image" value="{{isset($arr_patient['userinfo']['profile_image'])?$arr_patient['userinfo']['profile_image']:''}}">
                                       </span> 
                                       <a data-dismiss="fileupload" class="btn btn-default fileupload-exists" href="#">Remove</a>
                                       <span></span> 
                                    </div>
                                 </div>
                                 <i><b>Note:</b> Please upload image with JPEG ,JPG ,PNG ,GIF, BMP image file formats with the size greater than 188 x 175 resolution.  </i> 
                                 <div class="err" id="err_profile_image">{{ $errors->first('profile_image') }}</div>
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
                           <h3><i class="fa fa-puzzle-piece"></i> Entitlement Details</h3>
                        </div>
                        <div class="box-content">
                           <br/>
                        <div class="form-group">
                           <label for="password2" class="col-xs-3 col-lg-3 control-label">Entitlement </label>
                           <div class="col-sm-3 col-lg-1">:</div>
                           <div class="col-sm-9 col-lg-8 controls">
                              <div id="div_local_pharamcy">
                                 <select name="entitlement" id="entitlement" class="form-control">
                                    <option value="">Select Entitlement <span class="required_field">*</span>
                                  </option>
                                  @foreach($entitlement_arr as $val)
                                    <?php
                                      if ($arr_patient['entitlement_id'] == $val['id']) {
                                          $selected = 'selected';
                                      } else {
                                          $selected = '';
                                      }
                                     ?>
                                  <option value="{{$val['id']}}" {{$selected}}>{{$val['entitlement']}}</option>
                                  @endforeach
                                 </select>
                              </div>
                              <div class="err" id="err_entitlement">{{ $errors->first('entitlement') }}</div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                           <div class="form-group">
                              <label for="entitlement_card_no" class="col-xs-3 col-lg-3 control-label">Card Number. <span class="star">*</span></label>
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input type="text" name="entitlement_card_no" id="entitlement_card_no" value="{{isset($arr_patient['card_no'])?$arr_patient['card_no']:''}}" class="form-control" placeholder="Card number">
                                 <div class="err" id="err_entitlement_card_no">{{ $errors->first('entitlement_card_no') }}</div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <br/>
                           <div class="form-group">
                              <label for="password1" class="col-xs-3 col-lg-3 control-label">Photo of entitlement card. <span class="star">*</span></label>
                              <input type="hidden" id="existing_images" name="existing_images">
                              <div class="col-sm-3 col-lg-1">:</div>
                              <div class="col-sm-9 col-lg-8 controls">
                                 <input data-multiupload-src class="upload_pic_btn affected_area" name="affected_area[]" type="file" multiple="">
                                 @if(isset($affected_area_img_arr) && !empty($affected_area_img_arr))
                                     @foreach($affected_area_img_arr as $val)
                                         @if($val['affected_area_photo'] !='' && File::exists($patient_uploads_url.$val['affected_area_photo']))

                                             <div class="image-avtar left"> 
                                                 <img src="{{$patient_uploads_base_url}}/{{$val['affected_area_photo']}}" value="{{$val['affected_area_photo']}}" class="disp_img circle affected_area_photo" style="height: 60px; width: 60px;">
                                                  <a href="javascript:void(0)" class="remove_affected_area">Delete</a>
                                             </div>
                                                 
                                             
                                         @endif
                                     @endforeach
                                 @else
                                     <span class="green-text">No Image uploaded</span>
                                 @endif
                                 <div class="err" id="err_affected_area">{{ $errors->first('first_name') }}</div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-inline pull-right">
           
            <input style="visibility: hidden;" type="button" class="btn btn-success" name="btn_edit_patient" id="btn_edit_patient" value="Update">
           
            <input type="submit" class="btn btn-success" name="btn_send_otp" id="btn_send_otp" value="Update">

            <button type="submit" class="btn btn-success" id="btn_send_otp_spinner" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button>

            <input type="reset" class="btn btn-danger" onclick="location.href = '{{ $module_url_path }}';" name="btn_reset_patient" id="btn_reset_patient" value="Cancel">
            </div> 
            <div class="clearfix"></div><br/>
      </div>
</form>   
@else
<div class="alert alert-info alert-dismissible" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Sorry!</strong> Currently,no records found.
</div>
@endif    
</div>
</div>
<!-- END Main Content --> 


@include('admin.otp.otp')

<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="email" id="email" value="{{ $user->email }}">

<!-- Decrypt Values -->
<script type="text/javascript">
 var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
 var api           = virgil.API(virgilToken);
 
 var dumpSessionId  = '{{isset($arr_patient["userinfo"]["dump_session"])?$arr_patient["userinfo"]["dump_session"]:""}}';
 var dumpId         = '{{isset($arr_patient["userinfo"]["dump_id"])?$arr_patient["userinfo"]["dump_id"]:""}}';
 //  About Yourself
 var address        = "{{isset($arr_patient['suburb'])?$arr_patient['suburb']:''}}";
 //var mobile_no      = "{{isset($arr_patient['mobile_no'])?$arr_patient['mobile_no']:''}}";
 var contact_no     = "{{isset($arr_patient['phone_no'])?$arr_patient['phone_no']:''}}";

 if(dumpSessionId!='')
 {
   var key         = api.keys.import(dumpSessionId);
   
   //  About Yourself
   if(address!='')
   {
     var dec_address     = decrypt(api, address, key);
     $('#autocomplete').val(dec_address);
   }
   
   /*if(mobile_no!='')
   {
     var dec_mobile_no  = decrypt(api, mobile_no, key);
     $('#mobile_no').val(dec_mobile_no);
   }*/

   if(contact_no!='')
   {
     var dec_contact_no  = decrypt(api, contact_no, key);
     $('#phone_no').val(dec_contact_no);
   }
}


function decrypt(api, enctext, key)
{
  var decrpyttext = key.decrypt(enctext);
  var plaintext = decrpyttext.toString();
  return plaintext;
}

function encrypt(api, text, cards)
{
 // encrypt the text using User's cards
 var encryptedMessage = api.encryptFor(text, cards);

 var encData = encryptedMessage.toString("base64");

 return encData;
}
</script>

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
                           $('#btn_edit_patient').click();
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
<script>
   /*=========load Pharmacy using ajax=====*/
   function getPharmacy(suburb)
   {
   
        if(suburb!="") 
        {
   
            
           $('select[name="local_pharmacy"]').find('option').eq(0).html('Please wait..');
   
            $.ajax({
                  url   : "{{ $module_url_path.'/local_pharmacy'}}",
                  type : "GET",
                  data: 'search_pharmacy='+suburb,
                  success : function(res){
                     
                     if($.trim(res)!='error')
                     {
                         $('select[name="local_pharmacy"]').find('option').eq(0).html('-Select Local Pharamacy-');  
                         $('#div_local_pharamcy').html(res);
                         return true; 
                     }
                     
   
                  }
            });
        }
   
   }
   
   
   /*====================================*/
   function medicareTypes(type)
   {
   
       if(type!="")
       {
   
          if(type=='Private') 
          {
            
             $('#div_card_no').hide()
             $('#div_medicare').hide();
             $('#div_concession').hide();
          }
   
          if(type=="Medicare")
          {  $('#name_of_card').html('Medicare Card Number <span class="star">*</span>'); 
             $('#div_card_no').show()
             $('#div_concession').hide();
             $('#div_medicare').show();
          }
   
          if(type=="Concession")
          {
             $('#name_of_card').html('Concession Card Number <span class="star">*</span>');
             $('#div_medicare').hide();
             $('#div_card_no').show();
             $('#div_concession').show();
          }
          if(type=="Safety Net Card")
          {
             $('#name_of_card').html('Safety Card Number <span class="star">*</span>');
             $('#div_medicare').hide();
             $('#div_card_no').show();
             $('#div_concession').show();
          }
   
       }
   
   }
    $(document).ready(function(){
   
   
     $("#card_photo").change(function (e) 
      {
         
          var filename=$("#card_photo").val();
          $('#card_photo').html(filename);
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
                $('#card_photo').focus();
                return false;
          }
      
    });
   $('#span_manually_address').click(function(){
   
    $('#manually_div').toggle();
   });
   /*---------------------------------------profile image--------------------*/
   
    $(document).ready(function(){
    var _URL = window.URL || window.webkitURL;
       $("#profile_image").change(function (e) {
       var filename=$("#profile_image").val();
       var flag=1;
       $("#err_profile_image").html("");
       var ext = filename.split('.').pop();
       var file, img;
       if ((file = this.files[0])) {
           img = new Image();
           img.onload = function () {
               if(this.width<321 && this.height<164)
               {
                 $("#err_profile_image").html("Please select image of size 188 x 175.");
                 return false;     
               }
   
           };
           img.src = _URL.createObjectURL(file);
       }
      if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG" || ext == "BMP" || ext == "bmp")
        {
           $("#err_profile_image").html("");
        }  
        else
        {
           $("#err_profile_image").html("Please select valid image to upload.");
            return false;
        }
       
     });
   });
   
   $(document).ready(function()
  { 
      $('#phone_no,#mobile_no,#entitlement_card_no').keydown(function(){
         $(this).val($(this).val().replace(/[^\d]/,''));
         $(this).keyup(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
         });
      });

  });
   
   $('#btn_edit_patient').click(function(){
       
       var title         = $('#title').val();
       var first_name    = $('#first_name').val();
       var last_name    = $('#last_name').val();
       var day_of_birth  = $('#day_of_birth').val();
       var date_of_month = $('#date_of_month').val();
       var date_of_year  = $('#date_of_year').val();
       var mobile_code   = $('#mobile_no_code').val();
       var mobile_no     = $('#mobile_no').val();
       var phone         = $('#phone_no').val();
       var address       = $('#autocomplete').val();


       var entitlement           = $('#entitlement').val();
       var entitlement_card_no   = $('#entitlement_card_no').val();
       
       
       var nodigit_regexp= /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
       var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
       var phone_no_filter=/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;


       var src_arr =[];
        $('.affected_area_photo').each(function(){
             src_arr.push( $(this).attr('value'));
        });
        
        var aff_imgs = src_arr.toString();

        $('#existing_images').val(aff_imgs);
        
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          return 
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
       }
       else if($.trim(mobile_code)=="")
       {
   
          $('#mobile_code').val('');
          $('#err_mobile_code').fadeIn();
          $('#err_mobile_code').html('Select mobile code.');
          $('#err_mobile_code').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#date_of_year').focus();
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
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
          $(".close").click();
          return false;
       }
       else if($.trim(entitlement)=="")
       {
          $('#err_entitlement').fadeIn();
          $('#err_entitlement').html('Please select entitlement.');
          $('#err_entitlement').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#autocomplete').focus();
          $(".close").click();
          return false;
       }
       else if($.trim(entitlement_card_no)=="")
       {
          $('#err_entitlement_card_no').fadeIn();
          $('#err_entitlement_card_no').html('Please enter card number.');
          $('#err_entitlement_card_no').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#autocomplete').focus();
          $(".close").click();
          return false;
       }      
       else
       {
          var api       = virgil.API(virgilToken);
          var findkey   = api.cards.get(dumpId).then(function (cards) {

          /*if(mobile_no!='')
          {
            var txtmobile     = encrypt(api, mobile_no, cards);
            $('#enc_mobile_no').val(txtmobile);
          }*/

          if(phone!='')
          {
            var txtphone     = encrypt(api, phone, cards);
            $('#enc_phone_no').val(txtphone);
          }

          if(address!='')
          {
            var txtaddress    = encrypt(api, address, cards);
            $('#enc_address').val(txtaddress);
          }

          $('#frm_edit_patient').submit();
          
          }).then(null, function () {
              console.log('Something went wrong.');
          });

          findkey.catch(function(error) {
            console.log(error);
          });
         
       }
   
     });   
   });  
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
   
     }
   }
</script>

@include('google_api.googleapi')
<script>
   $(document).ready(function(){
      $('.remove_affected_area').click(function(){
       $(this).closest('.image-avtar').remove(); 
    });

      var fileExtension = ['jpg','jpeg','png','gif','bmp'];

    $('.upload_pic_btn').on('change', function(evt) {

        if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#err_affected_area').show();
            $('#affected_area').focus();
            $('#err_affected_area').html("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
            $('#err_affected_area').fadeOut(9000);
            $(".upload_pic_btn").val('');
            $('.upload-photo').remove();
            return false;
        }
        if(this.files[0].size > 5000000)
        {
            $('#err_affected_area').show();
            $('#affected_area').focus();
            $('#err_affected_area').html('File is too large, Maximum size allowed is 5 mb.');
            $('#err_affected_area').fadeOut(8000);
            $(".upload_pic_btn").val('');
            return false;
        }

    });

   });
</script>
@endsection