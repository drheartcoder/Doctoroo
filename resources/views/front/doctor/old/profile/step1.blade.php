@extends('front.doctor.layout.master')                
@section('main_content')
  

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
                        <div class="patent-name"><span class="hi-txt">Hi </span>{{ isset($arr_doctor_data['userinfo']['first_name'])?$arr_doctor_data['userinfo']['first_name']:'' }} {{ isset($arr_doctor_data['userinfo']['last_name'])?$arr_doctor_data['userinfo']['last_name']:'' }}</div>
                        <br/>
                     </div>

                  <form action="{{ $module_url_path }}/update_step1" name="frm_doc_profile_step1" enctype="multipart/form-data" id="frm_doc_profile_step1" method="post">
                  {{ csrf_field() }}
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">

                            
                            @include('front.doctor.layout.middlebar')
                         
                           <div class="row">
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       About You
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                            <div class="select-style pharma-step-drp">
                                                  <select class="frm-select" name="title">
                                                    <option value="">Select Title</option>
                                                    @if(isset($arr_prefix) && sizeof($arr_prefix)>0)
                                                        @foreach($arr_prefix as $prefix)
                                                          @if($prefix['name']!='')
                                                           <option value="{{ $prefix['name'] }}" 

                                                              @if(isset($arr_doctor_data['userinfo']['title']) && $arr_doctor_data['userinfo']['title']==$prefix['name'])
                                                                 selected="" 
                                                              @endif

                                                           >{{ $prefix['name'] }}</option>
                                                          @endif
                                                        @endforeach
                                                    @endif
                                                 </select>
                                            </div>                                       
                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_doctor_data['userinfo']['first_name'])?$arr_doctor_data['userinfo']['first_name']:'' }}" name="first_name" placeholder="First name"/>
                                       </div>
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_doctor_data['userinfo']['last_name'])?$arr_doctor_data['userinfo']['last_name']:'' }}"  data-rule-required="true" name="last_name" placeholder="Last name"/>
                                       </div>

                                       <div class="user_box">
                                           Gender
                                           <div class="radio-btns">

                                                <div class="radio-btn">
                                                   <input type="radio"    
                                                    @if(isset($arr_doctor_data['gender']) && $arr_doctor_data['gender']=="Male")  checked=""
                                                    @endif  value="Male"  id="Radio13" name="gender"/>
                                                   <label for="Radio13">Male</label>
                                                   <div class="check"></div>
                                                </div>
                                               
                                                <div class="radio-btn">
                                                   <input type="radio" 
                                                    @if(isset($arr_doctor_data['gender']) && $arr_doctor_data['gender']=="Female") 
                                                    checked=""
                                                    @endif  value="Female"   id="Radio14" name="gender"/>
                                                   <label for="Radio14">Female</label>
                                                   <div class="check">
                                                      <div class="inside"></div>
                                                   </div>
                                                </div>
                                            </div>
                                         </div>
                                         <br/>

                                       <div class="user-box">
                                          <div class="select-style pharma-step-drp">

                                             <select class="frm-select" data-rule-required="true" name="language">
                                                <option value="">Spoken Languages</option>
                                              @if(isset($arr_language) && sizeof($arr_language)>0)
                                                @foreach($arr_language as $language)
                                                 <option value="{{ $language['language'] or ''}}" 
                                                 @if(isset($arr_doctor_data['language_spoken']) && $arr_doctor_data['language_spoken']==$language['language'])
                                                  selected="" 
                                                 @endif
                                                 >{{ $language['language'] or '' }}</option>
                                                @endforeach
                                              @endif

                                             </select>
                                          </div>

                                          <div class="clearfix"></div>
                                       </div>

                                         <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_doctor_data['medical_qualification'])?$arr_doctor_data['medical_qualification']:'' }}" data-rule-required="true" name="qualification" placeholder="Medical Qualification"/>
                                        </div>

                                        <div class="user-box">
                                          <div class="select-style pharma-step-drp">

                                             <select class="frm-select" data-rule-required="true" name="practice_experience">
                                                <option value="">Practicing Experience</option>
                                           
                                                @for($i=0;$i<=100;$i++)
                                                 <option value="{{ $i or ''}}" @if(isset($arr_doctor_data['practitioner_experience']) && $arr_doctor_data['practitioner_experience']==$i) 
                                                  selected="" 
                                                 @endif

                                                 >{{ $i  or '' }} Years(s)</option>
                                                @endfor
                                             
                                             </select>
                                          </div>
                                          <div class="clearfix"></div>
                                       </div>

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       Practice Details
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" name="practice_name" value="{{ isset($arr_doctor_data['regular_practice_name'])?$arr_doctor_data['regular_practice_name']:'' }}" class="input_acct-logn" placeholder="Regular practice name"/>
                                       </div>
                                       <div class="user_box">
                                            <textarea cols="" rows=""  placeholder="Enter Your Address" name="address" class="form-inputs" style="padding:10px;height:90px;margin:5px 0;">{{ isset($arr_doctor_data['practice_address'])?$arr_doctor_data['practice_address']:'' }}</textarea>
                                       </div>

                                        <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_doctor_data['practice_phone'])?$arr_doctor_data['practice_phone']:'' }}" name="office_phone" placeholder="Office Number" id="practice_phone"/>
                                         <div class="err" id="err_phone"></div>
                                        </div>


                                        <div class="user_box">
                                          <input type="text" class="input_acct-logn" value="{{ isset($arr_doctor_data['contact_mobile'])?$arr_doctor_data['contact_mobile']:'' }}" name="mobile_no" placeholder="Mobile Number" id="contact_mobile" />
                                        <div class="err" id="err_mobile"></div>
                                        </div>

                                       <div class="user_box">
                                          {{-- <div class="select-style pharma-step-drp">
                                             <select class="frm-select" data-rule-required="true" name="timezone">
                                                <option value="">Select Timezone</option>

                                                @if(isset($arr_timezone) && sizeof($arr_timezone)>0)
                                                  @foreach($arr_timezone as $timezone)
                                                      
                                                      <option value="{{ $timezone['id'] }}" 
                                                      
                                                      @if(isset($arr_doctor_data['practice_timezone']) && $arr_doctor_data['practice_timezone']==$timezone['id'])
                                                        selected="" 
                                                      @endif

                                                 >{{$timezone['time']}}</option>

                                                   
                                                  @endforeach
                                                @endif
                                             </select>
                                          </div> --}}

                                       <div class="user_box">
                                          <input type="text" readonly="" class="input_acct-logn" id="current_timezone" name="current_timezone" placeholder="Current Timezone" />
                                       </div>

                                       </div>
                                        <div class="user_box">
                                          <input type="text" class="input_acct-logn" data-rule-required="true" value="{{ isset($arr_doctor_data['suburb_of_practice'])?$arr_doctor_data['suburb_of_practice']:'' }}" name="suburb_practice" placeholder="Suburb Of Practice" />
                                       </div>
                                  
      
                                      
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                       Contact Info
                                    </div>
                                    <div class="pharma-step-content">
                                       <div class="user_box">
                                          <input type="text" value="{{ isset($arr_doctor_data['userinfo']['email'])?$arr_doctor_data['userinfo']['email']:'' }}" readonly="" class="input_acct-logn"  name="email_id" placeholder="Email Id"  />

                                       </div>
                                        <?php $phone_no = ''; ?>
                                          @if(isset($arr_doctor_data['contact_phone']) && $arr_doctor_data['contact_phone']!='')
                                            <?php
                                                
                                              $phone_no = implode(array_filter(str_split($arr_doctor_data['contact_phone'], 1), "is_numeric"));
                                            ?>
                                          
                                          @endif  
                                       <div class="user_box">
                                          <input type="text" class="input_acct-logn"  value="{{ $phone_no or '' }}" name="phone" id="phone" placeholder="Phone" />
                                            <div class="err" id="err_contact"></div>
                                       </div>
                                     

                                       <div class="user_box">
                                         <input type="file" id="doc_profile_image" style="visibility:hidden; height: 0;" name="doctor_profile_image"/>
                                         <div class="input-group pharma-up">
                                            <div class="btn btn-primary btn-file btn-gry">
                                               <a class="file" onclick="browseDoctorProfileImage()">Chooose file
                                               </a>
                                            </div>
                                            <input type="text" placeholder="Upload Logo" class="form-control file-caption  kv-fileinput-caption" id="doc_profile_image_name" disabled="disabled"/>
                                            <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                            <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_doc_image">
                                               <a class="file" onclick="removeBrowsedProfileImage()"><i class="fa fa-trash"></i>
                                               </a>
                                            </div>
                                         </div>
                                          <span class="note">Note:Supported file type jpeg,png,jpg.</span>
                                         <div class="error" id="err_profile_image"></div>
                                      </div>
                                       

                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                    <input type="submit" class="btn-grn pull-right" style="margin:0 0 30px;" name="btn_doctor_profile_step1" id="btn_doctor_profile_step1" value="Continue">
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
   <script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY" async defer></script> 
  <script>
  $(document).ready(function(){

     getCurrentLocation();          

  });

  /* get current timezone for that getting current local coordinates*/
  function getCurrentLocation()
  {

       if(!navigator.geolocation)
       {
            alert('Your Browser does not support HTML5 Geo Location. Please Use Newer Version Browsers');
       }
       navigator.geolocation.getCurrentPosition(success, error);
       function success(position)
       {
          var latitude  = position.coords.latitude; 
          var longitude = position.coords.longitude;   
          var accuracy  = position.coords.accuracy;

          var coordinates = latitude+','+longitude;
          var date        = new Date();
          var timestamp   = date.getTime()/1000 + date.getTimezoneOffset() * 60;
          var apikey      = 'AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY';
          var url         = 'https://maps.googleapis.com/maps/api/timezone/json?location='+coordinates+'&timestamp='+timestamp+'&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY';
          getTimeZone(url,timestamp); /*get timezone details*/

       }
       function error(err)
       {
          console.log('ERROR(' + err.code + '): ' + err.message);
       }

 }
 function getTimeZone(url,timestamp)
 {
      var xhr = new XMLHttpRequest()
      xhr.open('GET', url) 
      xhr.onload = function(){
          if (xhr.status === 200)
          { 
              var output = JSON.parse(xhr.responseText) 
              $('#current_timezone').val(output.timeZoneId);
              if (output.status == 'OK')
              { 

                  var offsets = output.dstOffset * 1000 + output.rawOffset * 1000 
                  var localdate = new Date(timestamp * 1000 + offsets) 
                  console.log(localdate.toLocaleString()); 
              } 
             
          }
          else{
              alert('Request failed.  Returned status of ' + xhr.status)
          }
      }
      xhr.send() 
 }

  $(document).ready(function()
  {

      $('#practice_phone').keyup(function()
      {
         num = $(this).val().replace(/\D/g,''); 
         $(this).val('('+num.substring(0,2) + ') ' + num.substring(2,6) + ' ' + num.substring(6,10)); 
      });

      $('#frm_doc_profile_step1').validate({
          errorElement:'span',
            errorPlacement: function (error, element) 
            {
              var name = $(element).attr("name");
              if(name == "doctor_profile_image") 
              {
                error.insertAfter('#err_profile_image').fadeOut(4000);
              }
              else
              {
                error.insertAfter(element).fadeOut(4000);
              }
           },
            rules: 
               {  
                   
                    doctor_profile_image: {
                        accept: "image/jpeg,image/png,image/jpg"
                    },
               
               },
               messages: {
                            first_name: "Pleae enter a firstname.",
                            last_name : "Pleae enter a lastname.",
                            language  : "Pleae select spoken language.",
                            qualification:"Please enter qualification.",
                            timezone:"Please select timezone.",
                            suburb_practice:'Please enter suburb of practice.',
                            practice_experience:'Please enter a experience.',
                            doctor_profile_image: 
                            {
                                accept: "Please select a valid image.",
                            },
                           
                        }


      });

    });

  $('#frm_doc_profile_step1').on('submit',function()
  {
        var form   = $(this);
        var isValid = form.valid();
        if(isValid)
        {
          showProcessingOverlay();
        }
        
         
  });
  
    function browseDoctorProfileImage() {
     
          $("#doc_profile_image").trigger('click');

     }
     $('#btn_doctor_profile_step1').click(function(){

      var practice_phone            = $('#practice_phone').val();
      var contact_mobile            = $('#contact_mobile').val();
      var phone                     = $('#phone').val();
      var onlydigit                 = /^[0-9]*(?:\.\d{1,2})?$/;
      var phone_no_filter           =/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
      
       if($.trim(practice_phone)=="")
       {

          $('#err_phone').fadeIn();
          $('#err_phone').html('Please enter practice office number.');
          $('#err_phone').fadeOut(4000);
          $('#practice_phone').focus();
          return false;
       }
       if(practice_phone=='()  ' || practice_phone.length<14)
       {
         $('#err_phone').show();
         $('#phone_number').focus();
         $('#err_phone').html('Please enter valid phone number.');
         $('#err_phone').fadeOut(4000);
         return false;  
       }
       else if($.trim(contact_mobile)=="")
       {
          $('#contact_mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('#contact_mobile').focus();
          return false;
       }
       else if($.trim(contact_mobile).length<10)
       {
          $('#contact_mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter 10 digit mobile number.');
          $('#err_mobile').fadeOut(4000);
          
          $('#contact_mobile').focus();
          return false;
       }
       else if(!$.trim(contact_mobile).match(onlydigit))
       {
          $('#contact_mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter mobile number.');
          $('#err_mobile').fadeOut(4000);
         
          $('#contact_mobile').focus();
          return false;
       }
       else if($.trim(contact_mobile).length>10)
       {
          $('#contact_mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter 10 digit mobile number.');
          $('#err_mobile').fadeOut(4000);
          
          $('#contact_mobile').focus();
          return false;
       }
        else if($.trim(phone)=="")
       {
          $('#phone').val('');
          $('#err_contact').fadeIn();
          $('#err_contact').html('Please enter contact phone number.');
          $('#err_contact').fadeOut(4000);
          
          $('#phone').focus();
          return false;
       }
       else if($.trim(phone).length<10)
       {
          $('#phone').val('');
          $('#err_contact').fadeIn();
          $('#err_contact').html('Please enter 10 digit contact phone number.');
          $('#err_contact').fadeOut(4000);
          
          $('#phone').focus();
          return false;
       }
       else if(!$.trim(phone).match(onlydigit))
       {
          $('#phone').val('');
          $('#err_contact').fadeIn();
          $('#err_contact').html('Please enter phone number.');
          $('#err_contact').fadeOut(4000);
          
          $('#phone').focus();
          return false;
       }
        else if($.trim(phone).length>10)
       {
          $('#phone').val('');
          $('#err_contact').fadeIn();
          $('#err_contact').html('Please enter 10 digit phone number.');
          $('#err_contact').fadeOut(4000);
          $('#phone').focus();
          return false;
       }



     });
     
     function removeBrowsedProfileImage() {
     $('#doc_profile_image_name').val("");
     $("#btn_remove_doc_image").hide();
     $("#doctor_profile_image").val("");
     }
     
     
     // This is the simple bit of jquery to duplicate the hidden field to subfile
     $('#doc_profile_image').change(function() 
     {
         if ($(this).val().length > 0) {
             $("#btn_remove_doc_image").show();
         }
       
         $('#doc_profile_image_name').val($(this).val());
     });

      $(document).ready(function() 
      {
            $("#step1_next_id").click(function() {
                $("#frm_doc_profile_step1").submit();
            });
            
      });
</script>
@endsection

