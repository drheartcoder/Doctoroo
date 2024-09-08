@extends('front.doctor.layout.master')                
@section('main_content')
  <style>
  /*  .download
    {

      margin-left: 83%;
    }*/
  </style>

      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
      <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
            @include('front.doctor.layout._sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Doctor Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt">Hi </span>{{ $arr_doctor_data['userinfo']['first_name'] or '' }} {{ $arr_doctor_data['userinfo']['last_name'] or '' }}</div>
                        <br/>
                     </div>

                    <form action="{{ $module_url_path }}/update_step2" name="frm_doc_profile_step2" enctype="multipart/form-data" id="frm_doc_profile_step2" method="post">
                    {{ csrf_field() }}

                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">
  
                        @include('front.doctor.layout.middlebar')

                           <div class="row">
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                      Practitioner details
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ $arr_doctor_data['practitioner_provider_number'] or '' }}" id="provider_no" name="provider_no" placeholder="Provider number"/>
                                          <span class='error'>{{ $errors->first('provider_no') }}</span>
                                          <span class='error' id="err_provider_no"></span>
                                         
                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ $arr_doctor_data['practitioner_prescriber_number'] or '' }}" name="prescriber_no" data-rule-required="true" placeholder="Prescriber number"/>
                                          <span class='error'>{{ $errors->first('prescriber_no') }}</span>
                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ $arr_doctor_data['AHPRA_registration_number'] or '' }}" name="registration_no" data-rule-required="true" placeholder="AHPRA Registration Number"/>
                                          <span class='error'>{{ $errors->first('registration_no') }}</span>
                                       </div>

                                        <div class="user_box">
                                             <input type="file" id="AHPRA_certificate" style="visibility:hidden; height: 0;" name="AHPRA_certificate"/>
                                             <div class="input-group pharma-up">
                                                <div class="btn btn-primary btn-file btn-gry">
                                                   <a class="file" onclick="browseAhpraCertificate()">Upload 
                                                   </a>
                                                </div>
                                                <input type="text" placeholder="AHPRA Certificate" class="form-control file-caption  kv-fileinput-caption" id="AHPRA_certificate_name" disabled="disabled"/>
                                                <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                                <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_AHPRA_certificate">
                                                   <a class="file" onclick="removeAhpraCertificate()"><i class="fa fa-trash"></i>
                                                   </a>
                                                </div>
                                             </div>
                                             <span class="note">Note:supported file types JPG, JPEG ,PDF.</span>
                                             <div id="err_ahpra"></div>

                                              @if(isset($arr_doctor_data['AHPRA_certificate']) && $arr_doctor_data['AHPRA_certificate']!='')

                                               <a href="{{ $module_url_path }}/download/ahpra" class="download">
                                                  <img src="{{ url('/') }}/public/images/download-img.png" alt="upload icon"/></span>
                                               </a>

                                              @endif
                                              

                                          </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                      Insurance & Identification
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" name="abn_number" value="{{ $arr_doctor_data['ABN'] or '' }}"  data-rule-required="true" class="input_acct-logn" placeholder="ABN Number"/>
                                          <span class='error'>{{ $errors->first('practice_name') }}</span>
                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ $arr_doctor_data['telehealth_insurance_provider'] or '' }}" data-rule-required="true" name="telehealth_number" placeholder="Telehealth Insurance Provider">
                                          <span class='error'>{{ $errors->first('telehealth_number') }}</span>
                                        
                                       </div>
                                        <div class="user_box">
                                             <input type="file" id="insurance_policy" style="visibility:hidden; height: 0;" name="telehealth_certificate"/>
                                             <div class="input-group pharma-up">
                                                <div class="btn btn-primary btn-file btn-gry">
                                                   <a class="file" onclick="browseInsurance()">Upload 

                                                   </a>
                                                </div>
                                                <input type="text" placeholder="Insurance Policy" class="form-control file-caption  kv-fileinput-caption" id="insurance_policy_name" disabled="disabled"/>
                                                <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                                <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_insurance_policy">
                                                   <a class="file" onclick="removeInsurance()"><i class="fa fa-trash"></i>
                                                   </a>
                                                </div>
                                             </div>
                                             <span class="note">Note:supported file types JPG, JPEG ,PDF.</span>
                                             <div id="err_insurance_policy"></div>

                                              @if(isset($arr_doctor_data['upload_insurance_policy']) && $arr_doctor_data['upload_insurance_policy']!='')
                                                <a href="{{ $module_url_path }}/download/insurance" class="download">
                                                  <img src="{{ url('/') }}/public/images/download-img.png" alt="upload icon"/></span>
                                                </a>
                                              @endif
                                             
                                              
                                         </div>


                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ $arr_doctor_data['drivers_licence_number'] or '' }}" name="driver_licence" placeholder="Drivers licence number" />

                                       </div>

                                         <div class="user_box">
                                           <input type="file" id="driving_certificate" style="visibility:hidden; height: 0;" name="driving_certificate"/>
                                           <div class="input-group pharma-up">
                                              <div class="btn btn-primary btn-file btn-gry">
                                                 <a class="file" onclick="browseDrivingCertificate()">Upload 
                                                 </a>
                                              </div>
                                              <input type="text" placeholder="Drivers licence" class="form-control file-caption  kv-fileinput-caption" id="driving_certificate_name" disabled="disabled"/>
                                              <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                              <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_driving_certificate">
                                              <a class="file" onclick="removeDrivingCertificate()"><i class="fa fa-trash"></i>
                                                 </a>
                                              </div>
                                           </div>
                                            <span class="note">Note:supported file types JPG, JPEG ,PDF.</span>
                                             <div id="err_driving_certificate"></div>

                                             @if(isset($arr_doctor_data['upload_drivers_licence']) && $arr_doctor_data['upload_drivers_licence']!='')
                                               <a href="{{ $module_url_path }}/download/drivers_licence" class="download">
                                                   <img src="{{ url('/') }}/public/images/download-img.png" alt="upload icon"/></span>
                                               </a>
                                            @endif
                                          
                                           
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                     References

                                    </div>
                                    <div class="pharma-step-content">
                                      
                                    @for($i=0;$i<2;$i++)
                                      @if($i==0)
                                        First Refernce
                                      @else
                                        Second Refernce
                                      @endif
                                      <input type="hidden" value="{{ $i or 0 }}" name="ref_index[]">
                                       <div class="user_box">

                                          <input type="text" class="input_acct-logn" id="ref_name_{{ $i }}" value="{{ $arr_doctor_data['doctor_refernces'][$i]['reference_name'] or '' }}"  name="ref_name[]" placeholder="Reference Name"  />
                                          <div class='error' id="err_ref_name_{{ $i }}"></div>

                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" id="ref_number_{{ $i }}" value="{{ $arr_doctor_data['doctor_refernces'][$i]['reference_number'] or '' }}"   name="ref_number[]" placeholder="Reference Number" />
                                          <div class='error' id="err_ref_number_{{ $i }}"></div>
                                       </div> 
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" id="ref_email_{{ $i }}"  value="{{ $arr_doctor_data['doctor_refernces'][$i]['reference_email'] or '' }}"  name="ref_email[]" placeholder="Reference Email" />
                                         <div class='error' id="err_ref_email_{{ $i }}"></div>
                                       </div>
                                       <div class="user_box">
                                          <input type="text" id="ref_phone_{{ $i }}" class="input_acct-logn ref_phone" value="{{ $arr_doctor_data['doctor_refernces'][$i]['reference_phone'] or '' }}" name="ref_phone[]" placeholder="Reference Phone"/>
                                          <!-- <span class='error'>{{ $errors->first('ref_phone') }}</span> -->
                                          <div class='error' id="err_ref_phone_{{ $i }}"></div>
                                       </div>

                                      @endfor
                                      
                                       

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                
                                 <input type="submit" class="btn-grn pull-right" style="margin:0 0 30px;" name="btn_doctor_profile_step2" id="btn_doctor_profile_step2" value="Continue">

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
<script>

    /*AHPRA_certificate*/
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


     /*telehealth certificate*/
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
     })

      $('#frm_doc_profile_step2').validate({
           errorElement:'span',
            errorPlacement: function (error, element) 
            {
              var name = $(element).attr("name");
              if(name == "AHPRA_certificate") 
              {
                error.insertAfter('#err_ahpra').fadeOut(4000);
              }
              else if(name=='telehealth_certificate')
              {
                 error.insertAfter('#err_insurance_policy').fadeOut(4000);
              }
              else if(name=='driving_certificate')
              {
                 error.insertAfter('#err_driving_certificate').fadeOut(4000);
              }
              else
              {
                error.insertAfter(element).fadeOut(4000);
              }
           },
               rules: 
               {  
                   
                    AHPRA_certificate: {
                        accept: "image/jpeg,image/png,image/jpg,pdf",
                    },
                    telehealth_certificate: {
                        accept: "image/jpeg,image/png,image/jpg,pdf",
                    },
                    driving_certificate: {
                        accept: "image/jpeg,image/png,image/jpg,pdf",
                    },
               
               },
               messages: {
                           // provider_no      : "Pleae enter a provider number.",
                            prescriber_no    : "Please enter a prescriber number.",
                            registration_no  : "Please enter a AHPRA Registration Number.",
                            abn_number       : "Please enter a ABN number.",
                            telehealth_number: "Please enter a Telehealth Insurance Provider number.",
                            
                            AHPRA_certificate: 
                            {
                                accept: "Please select a valid certificate.",
                            },
                            telehealth_certificate: 
                            {
                                accept: "Please select a valid certificate.",
                            },
                            driving_certificate: 
                            {
                                accept: "Please select a valid certificate.",
                            },
                           
                        }
       });


      $('#frm_doc_profile_step2').on('submit',function()
      {
            var flag= 1;
            var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
            var phone_no_filter=/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
            var provider_number_filter = /^\d{3,}\d{1}[A-Z]{2}$/;

            $('#err_ref_name_0').html('');
            $('#err_ref_number_0').html('');
            $('#err_ref_email_0').html('');
            $('#err_ref_phone_0').html('');


            var ref_name        = $('#ref_name_0').val();
            var ref_number      = $('#ref_number_0').val();
            var ref_email       = $('#ref_email_0').val();
            var ref_phone       = $('#ref_phone_0').val();
            var provider_no     = $('#provider_no').val();
            
            if(provider_no=="")
            {
               $('#err_provider_no').show();
               $('#provider_no').focus();
               $('#err_provider_no').html('Please enter a provider number.');
               $('#err_provider_no').fadeOut(4000);
               return false;  
            }
            else if(!provider_number_filter.test(provider_no))
            {
               $('#err_provider_no').show();
               $('#provider_no').focus();
               $('#err_provider_no').html('Please enter a valid provider number.');
               $('#err_provider_no').fadeOut(4000);
               return false;  
            }
            if(ref_name=="")
            {

              $('#err_ref_name_0').show();
              $('#err_ref_name_0').html('Enter reference name.');
              $('#err_ref_name_0').focus();
              $('#err_ref_name_0').fadeOut(4000);
              return false;
            }
            
            if(ref_number=="")
            {
              $('#err_ref_number_0').show();
              $('#err_ref_number_0').html('Enter reference number.');
              $('#err_ref_number_0').focus();
              $('#err_ref_number_0').fadeOut(4000);
              return false;
            }
            
            if(!onlydigit.test(ref_number))
            {
               $('#err_ref_number_0').show();
               $('#err_ref_number_0').html('Enter a valid reference number.');
               $('#err_ref_number_0').focus();
               $('#err_ref_number_0').fadeOut(4000);
              return false; 
            }
            
            if(ref_email=="")
            {
              $('#err_ref_email_0').show();
              $('#err_ref_email_0').html('Enter reference email id.');
              $('#err_ref_email_0').focus();
              $('#err_ref_email_0').fadeOut(4000);
              return false;
            }
            
            if(!email_filter.test(ref_email))
            {
                $('#err_ref_email_0').show();
                $('#err_ref_email_0').html('Enter valid reference email id.');
                $('#err_ref_email_0').focus();
                $('#err_ref_email_0').fadeOut(4000);
                return false;
            }
            
            if(ref_phone=="")
            {
              $('#err_ref_phone_0').show();
              $('#err_ref_phone_0').html('Enter phone number.');
              $('#err_ref_phone_0').focus();
              $('#err_ref_phone_0').fadeOut(4000);
              return false;
            }
            
            if(!phone_no_filter.test(ref_phone))
            {

              $('#err_ref_phone_0').show();
               $('#err_ref_phone_0').html('Enter a valid phone number.');
               $('#err_ref_phone_0').focus();
               $('#err_ref_phone_0').fadeOut(4000);
               return false; 
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
            $("#step2_next_id").click(function() {
               
                $("#frm_doc_profile_step2").submit();
            });
            
      });

</script>

@endsection