@extends('front.pharmacy.layout.master')
@section('main_content')

	   
      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
      <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">

          @include('front.pharmacy.layout._sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div> 


                    <form method="post" action="{{ $module_url_path }}/store_signup_step1" enctype="multipart/form-data" id="frm_signup_id" name="frm_signup_id"> 
                    {{ csrf_field() }}

                    <input type="hidden" name="enc_pharmacy_id" id="enc_pharmacy_id" value="{{ $pharmacy_enc_id or '' }}">
                    <input type="hidden" name="enc_token_id" id="enc_token_id" value="{{ $enc_token_id or '' }}">

                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">

                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                      
                                    @include('front.pharmacy.layout.middlebar') 
                                 

                                 </div>
                                 <div class="clr"></div>
                                @include('front.layout._operation_status')
                              </div>
                              <div class="clearfix"></div>
                           </div>

                           <div class="row">
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       Contact Info
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" name="first_name" id="first_name" value="{{ isset($arr_temp_pharmacy['userinfo']['first_name'])?$arr_temp_pharmacy['userinfo']['first_name']:'' }}"  class="input_acct-logn" placeholder="First Name*" />

                                           <span class='err' id="err_first_name"></span>
                                           <span class='err'>{{ $errors->first('first_name') }}</span>

                                       </div>
                                       <div class="user_box">
                                          <input type="text" name="last_name" id="last_name" value="{{ isset($arr_temp_pharmacy['userinfo']['last_name'])?$arr_temp_pharmacy['userinfo']['last_name']:'' }}"  class="input_acct-logn" placeholder="Last Name*" />

                                          <span class='err' id="err_last_name"></span>
                                          <span class='err'>{{ $errors->first('last_name') }}</span>
                                       </div>
                                       <div class="user-box">
                                          <div class="select-style pharma-step-drp">
                                             <select class="frm-select" name="contact_role" id="contact_role" onchange="showOtherRole(this.value)" >
                                                <option value="">Select Contact Role</option>
                                                <option value="1" 
                                                  @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==1) 
                                                    selected="" 
                                                  @endif

                                                >Owner</option>
                                                <option value="2" 
                                                  @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==2) 
                                                    selected="" 
                                                  @endif
                                                  >Manager</option>
                                                <option value="3"

                                                  @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==3) 
                                                    selected="" 
                                                  @endif

                                                >Assistant Pharmacist</option>
                                                <option value="4" 

                                                 @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==4) 
                                                    selected="" 
                                                  @endif

                                                >Pharmacist</option>


                                                <option value="5"

                                                  @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==5) 
                                                    selected="" 
                                                  @endif

                                                >Retail Assistant</option>
                                                <option value="6"

                                                   @if(isset($arr_temp_pharmacy['contact_role']) && $arr_temp_pharmacy['contact_role']==6) 
                                                    selected="" 
                                                  @endif

                                                >other</option>

                                             </select>
                                          </div>
                                          <!--  <div class="err">Please enter valid textfields</div>-->
                                          <div class="clearfix"></div>
                                       </div>


                                      <div id="contact_role_div" style="display:none">

                                          <div class="user_box">
                                            <input type="text" class="input_acct-logn" value="{{ isset($arr_temp_pharmacy['other_role'])?$arr_temp_pharmacy['other_role']:'' }}"  name="other_role" id="other_role" placeholder="Other Role" />
                                             <span class='err' id="err_role"></span>
                                          </div>

                                      </div>


                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_temp_pharmacy['userinfo']['email'])?$arr_temp_pharmacy['userinfo']['email']:'' }}" id="email_id" name="email_id" placeholder="Email*" />

                                          <span class='err' id="err_email_id"></span>
                                          <span class='err'>{{ $errors->first('email_id') }}</span>
                                       </div>

                                    
                                        <div class="user_box">
                                          <input type="password" class="input_acct-logn" id="password"   name="password" placeholder="password*" />
                                          <span class='err' id="err_password"></span>
                                          <span class='err'>{{ $errors->first('password') }}</span>
                                       </div>


                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>

                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       Pharmacy Details
                                    </div>
                                    <?php $pharmacy_name     = ''; ?>
                                    @if(isset($arr_temp_pharmacy['pharmacy_name']) && $arr_temp_pharmacy['pharmacy_name']!='')
                                       <?php  $pharmacy_name = $arr_temp_pharmacy['pharmacy_name']; ?>    
                                    @endif

                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_main_pharmacy['pharmacy_name'])?$arr_main_pharmacy['pharmacy_name']:$pharmacy_name }}"  name="pharmacy_name" id="pharmacy_name" placeholder="Pharmacy Name*" />
                                          <span class='err' id="err_pharmacy_name"></span>
                                          <span class='err'>{{ $errors->first('pharmacy_name') }}</span>
                                       </div>
                                       
                                       <div class="user_box">
                                          <?php $phone_no = ''; ?>
                                          @if(isset($arr_main_pharmacy['phone_no']) && $arr_main_pharmacy['phone_no']!='')
                                            <?php
                                                
                                                $phone_no = implode(array_filter(str_split($arr_main_pharmacy['phone_no'], 1), "is_numeric"));
                                            ?>
                                          @elseif(isset($arr_temp_pharmacy['phone']) && $arr_temp_pharmacy['phone']!='')
                                               <?php
                                                 $phone_no = $arr_temp_pharmacy['phone'];
                                               ?>
                                          @endif

                                          <input type="text" class="input_acct-logn" value="{{ $phone_no or '' }}" data-rule-number="true" name="phone" id="phone_no" placeholder="Phone / Mobile*" />
                                          <span class='err' id="err_phone_no"></span>
                                          <span class='err'>{{ $errors->first('phone') }}</span>
                                       </div>



                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" data-rule-number="true"  data-rule-minlength="7" data-rule-maxlength="16" value="{{ isset($arr_temp_pharmacy['fax'])?$arr_temp_pharmacy['fax']:'' }}"  name="fax" id="fax" placeholder="Fax" />
                                           <span class='err' id="err_fax"></span>
                                       </div>

                                       <?php $address1 = ''; ?>
                                          @if(isset($arr_temp_pharmacy['address1']) && $arr_temp_pharmacy['address1']!='')
                                            <?php 
                                              $address1 = $arr_temp_pharmacy['address1'];
                                            ?>

                                          @endif

                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_main_pharmacy['suburb'])?$arr_main_pharmacy['suburb']:$address1 }}" id="address1" name="address1" placeholder="Address 1*" />
                                           <span class='err' id="err_address1"></span>
                                          <span class='err'>{{ $errors->first('address1') }}</span>

                                       </div>

                                       <?php $address2 = ''; ?>
                                       @if(isset($arr_temp_pharmacy['address2']) && $arr_temp_pharmacy['address2']!='')
                                          <?php 
                                            $address2 = $arr_temp_pharmacy['address2'];
                                          ?>

                                       @endif

                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_main_pharmacy['location'])?$arr_main_pharmacy['location']:$address2 }}" name="address2" placeholder="Address 2" />


                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>


                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       Pharmacy Details
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                              Is the Pharmacy part of a banner group?
                                      
                                           <div class="radio-btns">
                                                <div class="radio-btn">
                                                   <input type="radio"    
                                                    @if(isset($arr_temp_pharmacy['part_of_banner_group']) && $arr_temp_pharmacy['part_of_banner_group']=="Yes") 
                                                     checked=""
                                                    @endif  value="Yes" onclick="showOtherGroup(this.value)"  id="Radio13" name="part_of_banner_group"/>
                                                   <label for="Radio13">Yes</label>
                                                   <div class="check"></div>
                                                </div>
                                               
                                                <div class="radio-btn">
                                                   <input type="radio"
                                                    @if(isset($arr_temp_pharmacy['part_of_banner_group']) && $arr_temp_pharmacy['part_of_banner_group']=="No") 
                                                    checked=""
                                                    @else
                                                    checked=""
                                                    @endif  value="No"   id="Radio14" onclick="showOtherGroup(this.value)" name="part_of_banner_group"/>
                                                   <label for="Radio14">No</label>
                                                   <div class="check">
                                                      <div class="inside"></div>
                                                   </div>
                                                </div>
                                            </div>
                                         </div>
                                         <br/>

                                       <div class="user_box" id="other_group" style="display:none">
                                      
                                           <div class="select-style pharma-step-drp">
                                             <select class="frm-select" name="other_group" id="other_group_id">
                                                <option value="">Select Group</option>
                                                @if(isset($arr_banner_group) && sizeof($arr_banner_group)>0)
                                                  @foreach($arr_banner_group as $banner_group)
                                                    <option value="{{ $banner_group['id'] }}" @if(isset($arr_temp_pharmacy['other_group']) && $arr_temp_pharmacy['other_group']==$banner_group['id']) selected="" @endif >{{ $banner_group['name'] }}
                                                    </option>
                                                  @endforeach
                                                @endif
                                              </select>
                                            </div>
                                            <div id="err_other_group" class="error"></div>
                                       </div>
                                 
                                       <div class="user_box">
                                         <input type="file" id="pharmacy_logo"  style="visibility:hidden; height: 0;" name="pharmacy_logo"/>
                                         <div class="input-group pharma-up">
                                            <div class="btn btn-primary btn-file btn-gry">
                                               <a class="file"  onclick="browseImage()">Chooose file
                                               </a>
                                            </div>
                                            <input type="text" placeholder="Upload Logo" class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled"/>
                                            <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                            <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_image">
                                               <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i>
                                               </a>
                                            </div>
                                         </div>
                                          <span class="note">Note:allowed only jpeg,png,jpg.</span>
                                         <div id="err_pharmcy_logo"></div>
                                      </div>
                                       <div class="user_box">
                                          <input type="text" name="website" value="{{ isset($arr_temp_pharmacy['website'])?$arr_temp_pharmacy['website']:'' }}" url="true" class="input_acct-logn" placeholder="Website URL" />
                                          <div id="err_website"></div>

                                       </div>
                                       <div class="user_box">
                                          <input type="text" name="ABN" value="{{ isset($arr_temp_pharmacy['ABN_number'])?$arr_temp_pharmacy['ABN_number']:'' }}" class="input_acct-logn" data-rule-number="true"  data-rule-minlength="11" data-rule-maxlength="11" placeholder="Pharmacy ABN" />
                                           <div id="err_abn"></div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>

                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                   {{--  <a class="btn-grn pull-right" href="#" style="margin:0 0 30px;">Continue</a> --}}
                                    <input type="submit" class="btn-grn pull-right" style="margin:0 0 30px;" name="btn_signup_step1" id="btn_signup_step1" value="Continue">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--calender section end-->  
        <script>
         function browseImage() {
         
         $("#pharmacy_logo").trigger('click');
         }
         
         function removeBrowsedImage() {
         $('#profile_image_name').val("");
         $("#btn_remove_image").hide();
         $("#pharmacy_logo").val("");
         }
         
         
         // This is the simple bit of jquery to duplicate the hidden field to subfile
         $('#pharmacy_logo').change(function() {
           if ($(this).val().length > 0) {
               $("#btn_remove_image").show();
           }
         
           $('#profile_image_name').val($(this).val());
         });
            
    </script>
    <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
    <script>
    $(document).ready(function(){

      $('#email_id').on('blur',function(){

            $('#err_email_id').html('');
            var email_id   =  $(this).val();

            var email_id_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            if($.trim(email_id)!='')
            {
               if(!email_id_filter.test(email_id))
               {
                  $('#err_email_id').show();
                  $('#err_email_id').html('Please enter valid email id.');
                  /*$('#err_email_id').fadeOut(4000);*/
                  //$('#email_id').focus();
                  setTimeout(function(){ $('#email_id').focus(); });
                  return false;
               }
               var token = $('input[name="_token"]').val();
               $.ajax({
                     url   : "{{ url('/') }}/patient/duplicate/email",
                     type : "POST",
                     dataType:'json',
                     data: {_token:token,email_id:email_id},
                     success : function(res){
                        //$("#err_vemail_msg").html(res);
                        if($.trim(res)=='error')
                        {
                           $('#err_email_id').show();
                           $('#err_email_id').html('An account with this email already exists');
                           //$('#err_pemail').fadeOut(4000);
                           /*$('#frm_signup_id').attr('disabled',true);*/
                           $('#email_id').focus();   
                           return false; 
                        }
                        else if($.trim(res)=='success')
                        {
                           $('#err_email_id').show();
                           /*$('#frm_signup_id').attr('disabled',false);*/
                           return true;
                        }
                        else
                        {
                           $('#err_email_id').show();
                           $('#email_id').focus();
                           $('#err_email_id').html('Something has get wrong please try again later.');
                           return false;
                        }
                     }
               });
            }
      });

      var is_selected = $("#frm_signup_id input[type='radio']:checked").val();
      if(is_selected=='Yes')
      {
        showBannerGroup();
      }
      else
      {
        $('#other_group').hide();
      }

            $('#frm_signup_id').validate({

            errorElement:'span',
            errorPlacement: function (error, element) 
            {
            var name = $(element).attr("name");

            if(name === "pharmacy_logo") 
            {
            error.insertAfter('#err_pharmcy_logo').fadeOut(4000);
            }
            else
            {
            error.insertAfter(element).fadeOut(4000);
            }

            },
            rules: 
            {
            pharmacy_logo: {
            accept: "image/jpeg, image/png,image/jpg"
            },

            },
            messages: {
            "pharmacy_logo": 
            {
            accept: "Please upload a valid image.",
            }  
            }

            });

   });

  $(document).ready(function() 
  {
        $( "#frm_signup_id" ).submit(function( event ){

                var flag          =  0;
                var first_name    =  $('#first_name').val();
                var last_name     =  $('#last_name').val();
                var email         =  $('#email_id').val();
                var password      =  $('#password').val();
                var pharmacy_name =  $('#pharmacy_name').val();
                var phone_no      =  $('#phone_no').val();
                var address1      =  $('#address1').val();
                var fax           =  $('#fax').val();
                alert(phone_no);
                var alpha         = /^[a-zA-Z]*$/;
                var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                /*var phone_filter  = /^\d{10}$/;*/
                var integers      = /^[0-9]+$/;
                var fax_filter    = /^[0-9]{1,10}$/;


               if($.trim(first_name)=='')
               {
                  $('#err_first_name').show();
                  $('#first_name').focus();
                  $('#err_first_name').html('Please enter first name.');
                  $('#err_first_name').fadeOut(4000);
                  flag = 1;
               } 
               else if(!alpha.test(first_name))
               {
                  $('#err_first_name').show();
                  $('#first_name').focus();
                  $('#err_first_name').html('Please enter valid first name.');
                  $('#err_first_name').fadeOut(4000);
                  flag = 1;
               }
               else if($.trim(last_name)=='')
               {
                  $('#err_last_name').show();
                  $('#last_name').focus();
                  $('#err_last_name').html('Please enter last name.');
                  $('#err_last_name').fadeOut(4000);
                  flag = 1;
               }
               else if(!alpha.test(last_name))
               {
                  $('#err_last_name').show();
                  $('#last_name').focus();
                  $('#err_last_name').html('Please enter valid last name.');
                  $('#err_last_name').fadeOut(4000);
                  flag = 1; 
               } 
               else if($.trim(email)=='')
               {
                  $('#err_email_id').show();
                  $('#email_id').focus();
                  $('#err_email_id').html('Please enter email id.');
                  $('#err_email_id').fadeOut(4000);
                  flag = 1; 
               }
               else if(!email_filter.test(email))
               {
                  $('#err_email_id').show();
                  $('#email_id').focus();
                  $('#err_email_id').html('Please enter valid email id.');
                  $('#err_email_id').fadeOut(4000);
                  flag = 1;
               }
               else if($.trim(password)=='')
               {
                  $('#err_password').show();
                  $('#password').focus();
                  $('#err_password').html('Please enter a password.');
                  $('#err_password').fadeOut(4000);
                  flag = 1;  
               } 
               else if($.trim(password).length<6)
               {
                  $('#err_password').show();
                  $('#password').focus();
                  $('#err_password').html('For better security, use a password 6 characters long.');
                  $('#err_password').fadeOut(4000);
                  flag = 1;  
               }
               else if($.trim(pharmacy_name)=='')
               {
                  $('#err_pharmacy_name').show();
                  $('#pharmacy_name').focus();
                  $('#err_pharmacy_name').html('Please enter a pharmacy name.');
                  $('#err_pharmacy_name').fadeOut(4000);
                  flag = 1;
               }
               else if($.trim(phone_no)=='')
               {
                  $('#err_phone_no').show();
                  $('#phone_no').focus();
                  $('#err_phone_no').html('Please enter a phone number.');
                  $('#err_phone_no').fadeOut(4000);
                  flag = 1; 
               }
               else if(!integers.test(phone_no))
               {
                  $('#err_phone_no').show();
                  $('#phone_no').focus();
                  $('#err_phone_no').html('Please enter a valid phone number.');
                  $('#err_phone_no').fadeOut(4000);
                  flag = 1;  
               }
               else if($.trim(address1)=='')
               {
                  $('#err_address1').show();
                  $('#address1').focus();
                  $('#err_address1').html('Please enter a address.');
                  $('#err_address1').fadeOut(4000);
                  flag = 1;
               }
               if(flag == 1)
               {
                  return false;
               }
               else
               {
                  return true;
               }
             

        })

        $("#signup_step1_id").click(function() {
            $("#frm_signup_id").submit();
        });

        $("#signup_step2_id").click(function() {
            $("#frm_signup_id").submit();
        });

        $("#signup_step3_id").click(function() {
            $("#frm_signup_id").submit();
        });

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
$('#frm_signup_id').submit(function(){

      var is_selected = $("#frm_signup_id input[type='radio']:checked").val();
      if(is_selected=='Yes')
      {
          var other_group_val = $("#other_group_id").val();
          if(other_group_val=='')
          {
            $('#err_other_group').html('Please select other group.');
            return false;
          }
      }

     /* check role */
     var is_other_selected    = $("#contact_role").val();
     if(is_other_selected==6)
     {
           var other_role_val = $("#other_role").val();
          if(other_role_val=='')
          {
            $('#err_role').html('Please enter a other role.');
            return false;
          }
     }
  
 });
 function showOtherGroup(ref)
 {
    if(ref=='Yes')
    {
      showBannerGroup();
    }
    else
    {
      $('#other_group').hide();
    }
 }
 function showBannerGroup()
 {
         $('#other_group').show();
        
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
@endsection