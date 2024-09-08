@extends('front.pharmacy.layout.master')                
@section('main_content')

	   
      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
      <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">

          @include('front.pharmacy.layout.profile_layout._profile_sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt"></span></div>
                        <br/>
                     </div>

                    <form method="post" action="{{ $module_url_path }}/update_profile_step1" enctype="multipart/form-data" id="frm_profile_step1_id" name="frm_profile_step1_id"> 
                    {{ csrf_field() }}


                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">

                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                 <div class="see-d-dash-panel text-center">
                                      
                                     @include('front.pharmacy.layout.profile_layout._profile_middlebar')  
                                 

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
                                          <input type="text" name="first_name"  value="{{ isset($arr_pharmacy['userinfo']['first_name'])?$arr_pharmacy['userinfo']['first_name']:'' }}"  class="input_acct-logn" placeholder="First Name*" />

                                           <span class='err'>{{ $errors->first('first_name') }}</span>

                                       </div>
                                       <div class="user_box">
                                          <input type="text" name="last_name"   value="{{ isset($arr_pharmacy['userinfo']['last_name'])?$arr_pharmacy['userinfo']['last_name']:'' }}"  class="input_acct-logn" placeholder="Last Name*" />

                                          <span class='err'>{{ $errors->first('last_name') }}</span>
                                       </div>
                                       <div class="user-box">
                                          <div class="select-style pharma-step-drp">
                                             <select class="frm-select" name="contact_role" id="contact_role" onchange="showOtherRole(this.value)" >
                                                <option value="">Select Contact Role</option>
                                                <option value="1" 
                                                  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==1) 
                                                    selected="" 
                                                  @endif

                                                >Owner</option>
                                                <option value="2" 
                                                  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==2) 
                                                    selected="" 
                                                  @endif
                                                  >Manager</option>
                                                <option value="3"

                                                  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==3) 
                                                    selected="" 
                                                  @endif

                                                >Assistant Pharmacist</option>
                                                <option value="4" 

                                                 @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==4) 
                                                    selected="" 
                                                  @endif

                                                >Pharmacist</option>


                                                <option value="5"

                                                  @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==5) 
                                                    selected="" 
                                                  @endif

                                                >Retail Assistant</option>
                                                <option value="6"

                                                   @if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==6) 
                                                    selected="" 
                                                  @endif

                                                >other</option>

                                             </select>
                                          </div>

                                          <div class="clearfix"></div>
                                       </div>

                                      <div id="contact_role_div" style="display:none">

                                        <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_pharmacy['other_role'])?$arr_pharmacy['other_role']:'' }}"  name="other_role" id="other_role" placeholder="Other Role" />
                                           <span class='err' id="err_role"></span>
                                        </div>

                                      </div>

                                      <div class="user_box">
                                          <input type="text" class="input_acct-logn" readonly="" value="{{ isset($arr_pharmacy['userinfo']['email'])?$arr_pharmacy['userinfo']['email']:'' }}" id="email_id"  name="email_id" placeholder="Email*" />

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
                                    @if(isset($arr_pharmacy['pharmacy_name']) && $arr_pharmacy['pharmacy_name']!='')
                                       <?php  $pharmacy_name = $arr_pharmacy['pharmacy_name']; ?>    
                                    @endif

                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text"  data-rule-required="true" class="input_acct-logn" value="{{ isset($arr_pharmacy['pharmacy_name'])?$arr_pharmacy['pharmacy_name']:$pharmacy_name }}"  name="pharmacy_name"  placeholder="Pharmacy Name*" />
                                          <span class='err' id="err_pharmacy_name"></span>

                                       </div>
                                       
                                       <div class="user_box">
                                          <?php $phone_no = ''; ?>
                                          @if(isset($arr_pharmacy['phone_no']) && $arr_pharmacy['phone_no']!='')
                                            <?php
                                                
                                                $phone_no = implode(array_filter(str_split($arr_pharmacy['phone_no'], 1), "is_numeric"));
                                            ?>
                                          @elseif(isset($arr_pharmacy['phone']) && $arr_pharmacy['phone']!='')
                                               <?php
                                                 $phone_no = $arr_pharmacy['phone'];
                                               ?>
                                          @endif  

                                          <input type="text" class="input_acct-logn" data-rule-number="true" data-rule-minlength="10" data-rule-maxlength="10" value="{{ $phone_no or '' }}"  name="phone" id="phone_no" placeholder="Phone / Mobile*" />
                                          <span class='err' id="err_phone_no"></span>
                                          <span class='err'>{{ $errors->first('phone') }}</span>
                                       </div>



                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" data-rule-number="true"  data-rule-minlength="7" data-rule-maxlength="16" value="{{ isset($arr_pharmacy['fax'])?$arr_pharmacy['fax']:'' }}"  name="fax" id="fax" placeholder="Fax" />
                                           <span class='err' id="err_fax"></span>
                                       </div>

                                       <?php $address1 = ''; ?>
                                          @if(isset($arr_pharmacy['address1']) && $arr_pharmacy['address1']!='')
                                            <?php 
                                              $address1 = $arr_pharmacy['address1'];
                                            ?>

                                          @endif

                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_pharmacy['suburb'])?$arr_pharmacy['suburb']:$address1 }}" id="address1" name="address1" placeholder="Address 1*" />
                                           <span class='err' id="err_address1"></span>
                                          <span class='err'>{{ $errors->first('address1') }}</span>

                                       </div>

                                       <?php $address2 = ''; ?>
                                       @if(isset($arr_pharmacy['address2']) && $arr_pharmacy['address2']!='')
                                          <?php 
                                            $address2 = $arr_pharmacy['address2'];
                                          ?>

                                       @endif

                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_pharmacy['location'])?$arr_pharmacy['location']:$address2 }}" name="address2" placeholder="Address 2" />


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
                                                    @if(isset($arr_pharmacy['part_of_banner_group']) && $arr_pharmacy['part_of_banner_group']=="Yes") 
                                                     checked=""
                                                    @endif  value="Yes"  id="Radio13" onclick="showOtherField(this.value)" name="part_of_banner_group"/>
                                                   <label for="Radio13">Yes</label>
                                                   <div class="check"></div>
                                                </div>
                                               
                                                <div class="radio-btn">
                                                   <input type="radio" 
                                                    @if(isset($arr_pharmacy['part_of_banner_group']) && $arr_pharmacy['part_of_banner_group']=="No") 
                                                    checked=""
                                                    @endif  value="No"   id="Radio14" onclick="showOtherField(this.value)" name="part_of_banner_group"/>
                                                   <label for="Radio14">No</label>
                                                   <div class="check">
                                                      <div class="inside"></div>
                                                   </div>
                                                </div>
                                            </div>
                                         </div>
                                         <br/>
                                      <div id="other_field" style="display:none">
                                       <div class="user_box">
                                      
                                           <div class="select-style pharma-step-drp">
                                             <select class="frm-select" name="other_group" id="other_group">
                                                <option value="">Select Group</option>
                                                @if(isset($arr_banner_group) && sizeof($arr_banner_group)>0)
                                                  @foreach($arr_banner_group as $banner_group)
                                                    <option value="{{ $banner_group['id'] }}" @if(isset($arr_pharmacy['other_group']) && $arr_pharmacy['other_group']==$banner_group['id']) selected="" @endif >{{ $banner_group['name'] }}
                                                    </option>
                                                  @endforeach
                                                @endif
                                              </select>
                                              <div id="err_other_group" class="error"></div>
                                            </div>

                                       </div>
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
                                          <input type="text" name="website" value="{{ isset($arr_pharmacy['website'])?$arr_pharmacy['website']:'' }}" url="true" class="input_acct-logn" placeholder="Website URL" />
                                          <div id="err_website"></div>

                                       </div>
                                       <div class="user_box">
                                          <input type="text" name="ABN" value="{{ isset($arr_pharmacy['ABN_number'])?$arr_pharmacy['ABN_number']:'' }}" class="input_acct-logn" data-rule-number="true"  data-rule-minlength="11" data-rule-maxlength="11" placeholder="Pharmacy ABN" />
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
            

    $(document).ready(function(){


      $('#frm_profile_step1_id').validate({
          
                errorElement:'span',
                errorPlacement: function (error, element) 
                {
                  var name = $(element).attr("name");
                  if(name == "pharmacy_logo") 
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
                    first_name:"required",
                    last_name :"required",
                    address1  :"required",
                    pharmacy_name:"required",
                    pharmacy_logo: {
                        accept: "image/jpeg,image/png,image/jpg"
                    },
               
               },
               messages: {
                            first_name: "Pleae enter a firstname",
                            last_name : "Pleae enter a lastname",
                            address1  : "Pleae enter a Address",
                            pharmacy_name:"Pleae enter a pharmacy name",
                            phone:
                            {
                              maxlength:"Only 10 numbers are allowed.",
                              minlength:"Only 10 numbers are allowed."
                            },
                            pharmacy_logo: 
                            {
                                accept: "Please upload a valid image.",
                            },
                           
                        }
                      
      });

      var is_selected = $("#frm_profile_step1_id input[type='radio']:checked").val();
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

  $('#frm_profile_step1_id').submit(function()
  {

  
         var is_selected = $("#frm_profile_step1_id input[type='radio']:checked").val();
          if(is_selected=='Yes')
          {
              var other_group_val = $("#other_group").val();
              if(other_group_val=='')
              {
                $('#err_other_group').html('Please select other group.');
                return false;
              }
          }

         /* check role */
         var is_other_selected = $("#contact_role").val();
         if(is_other_selected==6)
         {
               var other_role_val = $("#other_role").val();
              if(other_role_val=='')
              {
                $('#err_role').html('Please enter a other role.');
                return false;
              }
         }

        var form   = $(this);
        var isValid = form.valid();
        if(isValid)
        {
          showProcessingOverlay();
        }
  });

  $(document).ready(function() 
  {
        
         $("#profile_step2_id").click(function() {

            $("#frm_profile_step1_id").submit();
        });

        $("#profile_next_step1_id").click(function() {

            $("#frm_profile_step1_id").submit();
        });

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
@endsection