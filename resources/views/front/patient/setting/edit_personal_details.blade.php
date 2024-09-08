  @extends('front.patient.layout._no_sidebar_master')
  @section('main_content')
    <div class="header z-depth-2 bookhead">
      <div class="backarrow "><a href="{{ url('/') }}/patient/setting/personal_details" class="center-align"><i class="material-icons">chevron_left</i></a></div>
      <form action="{{url('patient/setting/store')}}" id="edit_personal_details" method="post" name="edit_personal_details" enctype="multipart/form-data">
        {{ csrf_field()}}
        <h1 class="main-title center-align">Personal Details</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer"> -->
      <style>
          .error,.required_field
          {
            color:red;
          }
      </style>
      <div class="fieldspres ">
      @if(Session::has('profile_status_msg') && Session::get('profile_status_msg') != null)
          <div class="gray-strip">
              <div class="bluedoc-text">
                  <span class="center-align">{{Session::get('profile_status_msg')}}</span>
              </div>
          </div>
        @php Session::forget('profile_status_msg'); @endphp
      @endif
        @if(isset($arr_personal_details) && !empty($arr_personal_details))

        <?php 
        $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
        $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
        $first_name         = isset($arr_personal_details[0]['first_name'])?$arr_personal_details[0]['first_name']:'';
        $last_name          = isset($arr_personal_details[0]['last_name'])?$arr_personal_details[0]['last_name']:'';
        $mobile_no          = isset($arr_personal_details[0]['patientinfo']['mobile_no'])?decrypt_value($arr_personal_details[0]['patientinfo']['mobile_no']):'';
        $address            = isset($arr_personal_details[0]['patientinfo']['suburb'])?$arr_personal_details[0]['patientinfo']['suburb']:'';
        $contact_no         = isset($arr_personal_details[0]['patientinfo']['phone_no'])?$arr_personal_details[0]['patientinfo']['phone_no']:'';
        ?>

        @foreach($arr_personal_details as $details)

        <h3 class="sethead">About you</h3>
        <div class="row" style="margin-top: 20px; position: relative">
          <div class="input-field col s12 m12 l12">
              <?php
                if (!empty($details['profile_image']) && File::exists($profile_img_base_path.$details['profile_image']))
                 {
                    $src = $profile_img_public_path . $details['profile_image'];
                 } 
                 else
                 {
                    $src = $profile_img_public_path . 'default-image.jpeg';
                }
              ?>
              <div class="image-avtar left"> 
                <img src="{{$src}}" alt="" class="disp_profile_img circle" />
              </div>
              <div class="input-field uploadImgnew edt-cameras">
                <div class="file-field input-field">
                  <div class="btn">
                      <span><i class="material-icons">camera_alt</i></span>
                      <input type="file" accept="image/x-png,image/gif,image/jpeg" name="profile_image" class="profile_image" multiple> 
                  </div>
                   <span class="textside">Profile Picture.</span>
                </div>
                <div class="clr"></div>
              </div>
              <div class="divider"></div>
              <span class="error"></span>
          </div>
         
          <div class="col s6 m6 l6">
            <span class="error"></span>
          </div>
       </div>
        <div class="row" style="margin-top: 20px;">
          <div class="input-field col s6 m6 l6  text-bx lessmar errormed-personal">
            <input type="text" id="first_name" class="validate" name="first_name" value="{{$first_name}}" maxlength="16">
            <label for="first_name" class="grey-text truncate">First Name <span class="required_field">*</span>
            </label>
            
            <input type="hidden" readonly="" name="enc_first_name" id="enc_first_name">

            <span class="error">{{ $errors->first('first_name') }}</span>
          </div>
          <div class="input-field col s6 m6 l6  text-bx lessmar errormed-personal">
            <input type="text" class="validate" name="last_name" id="last_name" value="{{$last_name}}" maxlength="16">
            <label for="last_name" class="grey-text truncate">Last Name <span class="required_field">*</span>
            </label>

            <input type="hidden" readonly="" name="enc_last_name" id="enc_last_name">

            <span class="error">{{ $errors->first('last_name') }}</span>
          </div>
        </div>
        <div class="row" style="margin-top: 20px;">
          <div class="input-field col s6 m6 l6 selct margin-one-more-px errormed-personal">
            <select name="gender" id="gender">
                <?php
                    $male   = '';
                    $female = '';
                    if ($details['patientinfo']['gender'] == 'M') {
                        $male = 'selected';
                    } else {
                        $female = 'selected';
                    }
                ?>
                <option value="" disabled >Gender <span class="required_field">*</span></option>
                <option value='M' {{$male}}>Male</option>
                <option value='F' {{$female}}>Female</option>
            </select>
              <input type="hidden" value="{{$details['patientinfo']['gender']}}" id="edit_gender" name="edit_gender">
          </div>
          <div class="input-field col s6 m6 l6 text-bx lessmar errormed-personal">
            <input id="datebirth" type="text" class="dob_datepicker ht45 validate" name="dob" 
            value="{{ date('d/m/Y', strtotime($details['patientinfo']['date_of_birth']))}}">
                <label class="active grey-text truncate" for="datebirth">Date of birth <span class="required_field">*</span>
               </label>
            <span class="error"></span>
          </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s12 m12 l12  text-bx lessmar errormed-personal">
                <input type="text" id="email" class="materialize-textarea" value="{{isset($details['email']) ? $details['email'] : ''}}" readonly disabled>
                <label for="email" class="grey-text truncate">Email</label>
            </div>
        </div>
        <div class="row" >
          
          <div class="col s12 m6 l6" style="margin-top: 20px;">
            <div class="row">
              <div class="input-field col s12 text-bx lessmar errormed-personal">
                <label class="grey-text truncate small-text-label">Contact No.</label>
                <input type="text" id="contact_no" class="validate" name="contact_no" value="" maxlength="14">
                <input type="hidden" readonly="" name="enc_contact_no" id="enc_contact_no" >
              </div>
            </div>
          </div>

          <div class="col s12 m6 l6 " style="margin-top: 20px;">
            <div class="row">
              <div class="col s4 input-field selct margin-one-more-px errormed-personal">
                <label class="grey-text truncate small-text-label">Mobile No. <span class="required_field">*</span></label>
                <select name="mobile_no_code" id="mobile_no_code">
                      <option value="0">Select Code</option>
                    @if(isset($mobcode_data) && !empty($mobcode_data))
                        @foreach($mobcode_data as $mobcode)
                            <option value="{{ $mobcode['id'] }}" {{isset($details['patientinfo']['mobile_code']) && $details['patientinfo']['mobile_code'] == $mobcode['id'] ? 'selected' : '' }} > +{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }}) </option>
                        @endforeach
                    @endif
                </select><br>
                <span class="error" id="mobile_code_err" style="padding-left: 13px;">{{ $errors->first('edit_mobile_no_code') }}</span> 
                <input type="hidden" name="edit_mobile_no_code" id="edit_mobile_no_code" value="{{isset($details['patientinfo']['mobile_code']) ? $details['patientinfo']['mobile_code'] : '' }}">
              </div>
              <div class="input-field col s8 text-bx lessmar errormed-personal">
                <input type="text" id="mobile_no" class="validate" name="mobile_no" value="{{$mobile_no}}" maxlength="14">
                <input type="hidden" readonly="" name="enc_mobile_no" id="enc_mobile_no">
                <span class="error">{{ $errors->first('mobile_no') }}</span>
              </div>
            </div>
          </div>

        </div>

        <div class="row" style="margin-top: 20px;">
          <div class="input-field col s12 m12 l12  text-bx lessmar errormed-personal">
            <input type="text" id="address" class="materialize-textarea" name="address" value="">
            <input type="hidden" readonly="" name="enc_address" id="enc_address">
            <label for="address" class="grey-text truncate">Address <span class="required_field">*</span>
            </label>
            <span class="error">{{ $errors->first('address') }}</span>
          </div>
        </div>

        <div class="row" style="margin-top: 20px;">
          <div class="input-field col s12 m12 l12  text-bx lessmar errormed-personal">
          <h5 class="digihis green-text">Timezone</h5>
            <select id="cmb_timezone" name="cmb_timezone">
                <option value="">Select Timezone</option>
                @foreach($timezone_data as $val)
                    <option value="{{$val['id']}}" {{isset($details['patientinfo']['timezone']) && $details['patientinfo']['timezone'] == $val['id'] ? 'selected' : '' }}>{{ $val['location_name'] }} ({{ $val['utc_offset'] }})</option> 
                @endforeach
            </select>
            <input type="hidden" readonly="" name="timezone" id="timezone">
            <span class="error">{{ $errors->first('timezone') }}</span>
          </div>
        </div>

        

    

    <br/>

        <div class="otherdetails">
            <h3 class="sethead">Entitlement</h3>  
        </div>
        <div class="row" style="margin-top: 20px;">
        

        <div class="otherdetails">
            <a href="#entitlement_popup" id="btn_entitlement"  class="border-btn round-corner  center-align">Add Entitlement</a>
        </div>

        <div class="input-field col s12 m12 l12 selct">
            <table>
                @if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
                    <thead>
                        <tr>
                            <th>Entitlement</th>
                            <th>Card No.</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($user_entitlement_arr as $key => $val)
                        <tr>
                            <td>{{isset($val['user_entitlement']['entitlement']) ? $val['user_entitlement']['entitlement'] : ''}}</td>
                            <td id="card_id_{{$key}}"></td>
                            <td>
                                @if(isset($val['affect_area_img']) && !empty($val['affect_area_img']))    
                                     @if($val['affect_area_img'] !='' && File::exists($patient_uploads_url.$val['affect_area_img']))
                                        <div class="image-avtar left"> 
                                            <img class="disp_img circle image_show_{{$key}}">
                                        </div>
                                     @else
                                        NA         
                                     @endif
                                  @else
                                     NA      
                                  @endif    
                            </td>
                            <td class="action-btns">
                                <a href='#entitlement_popup' class="entitlement_edit" value="{{isset($val['entitlement_id']) ? $val['entitlement_id'] : ''}}" data-entitlement="{{isset($val['user_entitlement']['entitlement']) ? $val['user_entitlement']['entitlement'] : ''}}"><i class="fa fa-pencil-square-o"></i></a> | 
                                <a href='#entitlement_delete_popup' class="entitlement_delete" value="{{isset($val['id']) ? $val['id'] : ''}}"><i class="fa fa-trash-o"></i></a>
                            </td>     
                        </tr>

                    <script type="text/javascript">
                        $(document).ready(function(){
                        var dumpSessionId = '{{ $user_dumpSessionId }}';
                        var dumpId        = '{{ $user_dumpId }}';
                        var VIRGIL_TOKEN  = "{{env('VIRGIL_TOKEN')}}";
                        var api           = virgil.API(VIRGIL_TOKEN);
                        var key           = api.keys.import(dumpSessionId);
                        var innerkey      = '{{$key}}';

                        var image_file = '{{$patient_uploads_base_url}}/{{$val["affect_area_img"]}}';
                        if(image_file!='')
                        {
                            var image_file_filename      = '{{ $val["affect_area_img"] }}';
                            var xhr = new XMLHttpRequest();
                            // this example with cross-domain issues.
                            xhr.open( "GET", image_file, true );
                            // Ask for the result as an ArrayBuffer.
                            xhr.responseType = "blob";
                            xhr.onload = function( e ) {
                              // Obtain a blob: URL for the image data.
                              var file = this.response;
                              var mime_type = file.type;

                              var fileReader = new FileReader();
                              fileReader.readAsArrayBuffer(file);
                              fileReader.onload = function ()
                              {
                                var img = imageUrl = '';
                                var imageData    = fileReader.result;
                                var fileAsBuffer = new Buffer(imageData);

                                var decryptedFile = key.decrypt(fileAsBuffer);
                                var blob = new Blob([decryptedFile], { type: mime_type });
                                
                                var urlCreator = window.URL || window.webkitURL;
                                
                                if(img=='' && imageUrl=='')
                                {
                                    var imageUrl = urlCreator.createObjectURL( blob );
                                    img.href      = imageUrl;
                                    $(".image_show_"+innerkey).attr('src',imageUrl);
                                }
                              }
                            };
                            xhr.send();
                        }

                        function decrypt(api, enctext, key)
                        {
                          var decrpyttext = key.decrypt(enctext);
                          var plaintext = decrpyttext.toString();
                          return plaintext;
                        }                                                

                        });
                    </script>                        
                    @endforeach    
                @else
                    <span class="green-text">No data found</span>    
                @endif 
            </table>
        </div>
        <div class="clr"></div><br>
        <div class="divider"></div>
    </div>
      </div>
        <span class="right qusame rescahnge">
            <input type="hidden" id="existing_images" name="existing_images">
            <button id="btn_edit_profile" type="button" class="btn cart bluedoc-bg lnht round-corner">SAVE</button>
        </span>
        <span class="left qusame rescahnge">
          <a class="border-btn round-corner  center-align" href="{{url('/patient')}}/setting/personal_details">CANCEL
          </a>
        </span>
        <div class="clr"></div>
      @endforeach
      @endif
      </div>
    </div>

    </form>

    <input type="hidden" value="{{Session::get('msg')}}" id="status">
    @php
          if(Session::has('msg'))
          {
             Session::forget('msg');
          }
    @endphp
    <a class="open_popups" href="#show_flash_msgs" style="display: none;"></a>
    <div id="show_flash_msgs" class="modal requestbooking" style="display: none;">
        <div class="modal-data">
          <a class="modal-close closeicon">
            <i class="material-icons">close</i>
          </a>
          <div class="row">
            <div class="col s12 l12 center-align" id="profile_msg">
              
            </div>
          </div>
        </div>
        <div class="modal-footer center-align ">
          <a href="{{$module_url_path}}/personal_details" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK
          </a>
        </div>
    </div>
    <div id="entitlement_delete_popup" class="modal requestbooking" style="display: none;">
        <div class="modal-data">
          <a class="modal-close closeicon">
            <i class="material-icons">close</i>
          </a>
          <div class="row">
            <div class="col s12 l12 center-align">
                <input type="hidden" id="delete_entitlement_id">
                Do you really want to delete this entitlement?
            </div>
          </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
            <a href="javascript:void(0)" id="delete_entitlement_btn" class="modal-action waves-effect waves-green btn-cancel-cons right">Yes</a>
        </div>
    </div>

    <div id="entitlement_popup" class="modal requestbooking small-modal date-modal">
         <form method="post" id="add_entitlement_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Entitlement</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data entitle-modal">
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field selct select2 errormed-add">
                        <select name="entitlement" id="entitlement" class="entitlement">
                            <option value="0" selected>Select Entitlement<span class="required_field">*</span>
                            </option>
                            @foreach($entitlement as $val)
                            <option value="{{$val['id']}}">{{$val['entitlement']}}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>
                     </div>
                  </div>
               </div>
               <div class="row" id="card_no_block" style="display: none">
                  <div class="col s12 l12">
                     <div class="input-field text-bx errormed-personals">
                        <input type="text" id="card_no" class="validate " name="card_no">
                        <input type="hidden" id="enc_card_no" class="validate " name="enc_card_no">
                          <label for="reason" class="grey-text truncate">Enter Card Number <span class="required_field">*</span></label>
                          <span class="error"></span>
                     </div>
                  </div>
               </div>
               <div class="row" id="affected_area_block" style="display: none">
                  <div class="col s12 l12">
                     <div class="input-field uploadImgnew new-upload-img edt-cameras">
                          <div class="file-field input-field">
                              <div>
                                <span data-multiupload="3">
                                
                                <span class="row">
                                   <div class="">
                                    <div class="upload-ent-card">
                                        <div class="btn ">
                                            <span><i class="material-icons">camera_alt</i></span>
                                        </div>
                                        <span class="textside">Upload Photo Of Entitlement Card.</span>
                                        <input data-multiupload-src class="upload_pic_btn affected_area" name="affected_area" id="affected_area" type="file">
                                        <div class="clr"></div>
                                    </div>
                                    </div>
                                    <div class="col s12 m2 l3  center-align">
                                        <span data-multiupload-holder></span>
                                    </div>
                                </span>
                                <span data-multiupload-fileinputs></span>
                                </span>
                              </div>
                          </div>
                          <div class="err left-side-btn" id="err_upload_pic_btn" style="display:none;"></div>
                          <div class="clr"></div>
                      </div>
                      <div class="divider"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="uploaded-img1 edt-modl-imgs" id="affected_area_img_section">
                  </div>
               </div>
            </div>
            <div class="modal-footer ">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
               <a href="javascript:void(0)" id="save_entitlement_btn" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
            </div>
         </form>
      </div>



  <!-- Data Decrypt -->
<script type="text/javascript">
  var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
  var dumpSessionId = '{{ $user_dumpSessionId }}';
  var dumpId        = '{{ $user_dumpId }}';
  formData          = new FormData();


  $(document).ready(function(){
      
      // Allow only Alphabet Characters
      $('#first_name, #last_name').keyup(function() {
          if (this.value.match(/[^a-zA-Z]/g)) {
              this.value = this.value.replace(/[^a-zA-Z]/g, '');
          }
      });


      /*var firstName    = '{{ $first_name }}';
      var lastName     = '{{ $last_name }}';*/
      //var mobile       = '{{ $mobile_no }}';
      var address      = '{{ $address }}';
      var contact_no   = '{{ $contact_no }}';
      
      decryptMyData(virgilToken);
      
      function decryptMyData()
      {
          var api       = virgil.API(virgilToken);
          var key       = api.keys.import(dumpSessionId);

          /*var txtfirst   = decrypt(api, firstName, key);
          var txtlast    = decrypt(api, lastName, key);*/
          //var txtmobile  = decrypt(api, mobile, key);
          var txtaddress = decrypt(api, address, key);

          if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
          {
              /*$('#first_name').val(txtfirst);
              $('#last_name').val(txtlast);*/
              //$('#mobile_no').val(txtmobile);
              $('#address').val(txtaddress);
          }

          if(contact_no!='')
          {
              var txtcontact_no = decrypt(api, contact_no, key);
              $('#contact_no').val(txtcontact_no);
          }
      }

  });
  
  function decrypt(api, enctext, key)
  {
      var decrpyttext = key.decrypt(enctext);
      var plaintext = decrpyttext.toString();
      return plaintext;
  }
</script>    

    @include('google_api.google')
    <script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js">
    </script>
    <script>
        $(document).ready(function(){
          var location = "Australia";
          $("#address").geocomplete({
            details: ".geo-details",
            detailsAttribute: "data-geo",
          });
        });
    </script>
    <script>
      var url="<?php echo $module_url_path;?>";
      $(document).ready(function()
      {
        if($('#status').val()!='')
        {
          $(".open_popups").click();
          $('#profile_msg').html($('#status').val());
        }

        $('#mobile_no,#contact_no,#card_no').keydown(function(){
         $(this).val($(this).val().replace(/[^\d]/,''));
         $(this).keyup(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
         });
       });
        
        function readURL(input) 
        {
          if($(input).attr('class')=='profile_image')
          {
                var filename = $('.profile_image').val();
                var ext = filename.match(/\.(.+)$/)[1];

                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                        
                        break;
                    default:
                        $('.profile_image').closest('.col').next('.col').find('.error').html('This is not an allowed file type.');
                        $('.disp_profile_img').attr('src',"{{$profile_img_public_path}}default-image.jpeg");
                        exit();
                }

                $('.profile_image').closest('.col').next('.col').find('.error').html('');

            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                $('.disp_profile_img').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
              exit();
            } 
          }

          var filename = $('.affected_area').val().replace(/C:\\fakepath\\/i, '');
          $('#browse_file').html(filename);
           
        }

        $(".profile_image").change(function()
        {
          readURL(this);
        }
                                  );
        $('#entitlement').change(function()
        {
          $('#entitlement_id').val($(this).val());
        }
                                )
      });

      $('#gender').change(function()
      {
        $('#edit_gender').val($('#gender').val());
      }
                         );
      $('#btn_edit_profile').click(function(e)
      {
        var dob = $('#datebirth').val();
        var today = new Date();
        var curr_date = today.getDate();
        var curr_month = today.getMonth() + 1;
        var curr_year = today.getFullYear();

        var pieces = dob.split('/');
        var birth_date = pieces[0];
        var birth_month = pieces[1];
        var birth_year = pieces[2];

        if (curr_month == birth_month && curr_date >= birth_date) var age = parseInt(curr_year-birth_year);
        if (curr_month == birth_month && curr_date < birth_date) var age = parseInt(curr_year-birth_year-1);
        if (curr_month > birth_month) var age = parseInt(curr_year-birth_year);
        if (curr_month < birth_month) var age = parseInt(curr_year-birth_year-1);

        $('.error').html('');
        if($('#first_name').val()=='')
        {
          $('#first_name').next('label').next('span').html("Please Enter first name");
          e.preventDefault();
        }
        else if($('#last_name').val()=='')
        {
          $('#last_name').next('label').next('span').html("Enter last name");
          e.preventDefault();
        }
        else if($('#datebirth').val()=='')
        {
          $('#datebirth').closest('.input-field').find('.error').html("Select Date of Birth");
          $('#datebirth').focus();
          e.preventDefault();
        }
        else if(age < 18)
         {
          $('#datebirth').closest('.input-field').find('.error').html("Invalid Birth date, it must be before 18 years");
          $('#datebirth').focus();
          e.preventDefault();
         }
         else if($('#edit_mobile_no_code').val()=='' || $('#edit_mobile_no_code').val() == '0')
        {
          $('#mobile_code_err').html("Select Code");
          e.preventDefault();
        }
        else if($('#mobile_no').val()=='')
        {
          $('#mobile_no').next('span').html("Enter mobile number");
          $('#mobile_no').focus();
          e.preventDefault();
        }
        else if($('#address').val()=='')
        {
          $('#address').next('label').next('span').html("Enter your address");
          $('#address').focus();
          e.preventDefault();
        }
        else if($('#cmb_timezone').val()=='')
        {
          $('#cmb_timezone_err').html("Select Code");
          $('#cmb_timezone').focus();
          e.preventDefault();
        }


        /* Data Encryption */                    
        /*var firstName    = $('#first_name').val();
        var lastName     = $('#last_name').val();*/
        //var mobile       = $('#mobile_no').val();
        var address      = $('#address').val();
        var contact_no   = $('#contact_no').val();

        var api       = virgil.API(virgilToken);
        var findkey   = api.cards.get(dumpId).then(function (cards) {

        /*var txtfirst      = encrypt(api, firstName, cards);
        var txtlast       = encrypt(api, lastName, cards);*/
        //var txtmobile     = encrypt(api, mobile, cards);
        if(contact_no!='')
        {
            var txtcontact_no = encrypt(api, contact_no, cards);
            $('#enc_contact_no').val(txtcontact_no);
        }
        var txtaddress    = encrypt(api, address, cards);

        if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
        {
            /*$('#enc_first_name').val(txtfirst);
            $('#enc_last_name').val(txtlast);*/
            //$('#enc_mobile_no').val(txtmobile);
            $('#enc_address').val(txtaddress);
            $('#timezone').val($('#cmb_timezone').val());

            $('#edit_personal_details').submit();
        }
        
        }).then(null, function () {
            console.log('Something went wrong.');
        });

        findkey.catch(function(error) {
          console.log(error);
        });

      });
    </script> 
    <script type="text/javascript">
      function encrypt(api, text, cards)
      {
        // encrypt the text using User's cards
        var encryptedMessage = api.encryptFor(text, cards);

        var encData = encryptedMessage.toString("base64");

        return encData;
      }
    </script>
    <script>
    //dropzone script with multiple files
    (function ($) {
        function readMultiUploadURL(input, callback,counter) {
          var counter=0;
            if (input.files) {

                $.each(input.files, function (index, file) {

                    var size = input.files[0].size;
                    var ext  = file.name.substring(file.name.lastIndexOf('.') + 1);

                    if(ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")   
                    {
                         $('.upload_pic_btn').replaceWith($('.upload_pic_btn').val('').clone(true));
                         counter= 1;
                        var reader = new FileReader();
                        reader.onload = function(e) 
                        {
                            callback(true, e.target.result,counter);
                        }  
                        return false;
                    }
                    if( file.size >= 5000000)
                    { 
                        //alert('Max size allowed is 5mb.');
                        $('#err_upload_pic_btn').show();
                        $('.upload_pic_btn').focus();
                        $('#err_upload_pic_btn').html('File is too large, Maximum size allowed is 5 mb.');
                        $('#err_upload_pic_btn').fadeOut(8000);

                        counter= 1;
                        var reader = new FileReader();
                        reader.onload = function(e) 
                        {
                            callback(true, e.target.result,counter);
                        }  
                        return false;
                    }

                        var reader = new FileReader();
                        reader.onload = function (e) {

                        callback(false, e.target.result,counter);
                    }
                    reader.readAsDataURL(file);
                });

            }
            callback(true, false,counter);
        }


        var arr_multiupload = $("span[data-multiupload]");


        if (arr_multiupload.length > 0) {
            $.each(arr_multiupload, function (index, elem) {
                var container_id = $(arr_multiupload[0]).attr("data-multiupload");


                var id_multiupload_img = "multiupload_img_" + container_id + "_";
                var id_multiupload_img_remove = "multiupload_img_remove" + container_id + "_";
                var id_multiupload_file = id_multiupload_img + "_file";

                var block_multiupload_src = "data-multiupload-src-" + container_id;
                var block_multiupload_holder = "data-multiupload-holder-" + container_id;
                var block_multiupload_fileinputs = "data-multiupload-fileinputs-" + container_id;


                var input_src = $(arr_multiupload[0]).find("input[data-multiupload-src]");
                $(input_src).removeAttr('data-multiupload-src')
                    .attr(block_multiupload_src, "");


                var block_img_holder = $(arr_multiupload[0]).find("span[data-multiupload-holder]");
                $(block_img_holder).removeAttr('data-multiupload-holder')
                    .attr(block_multiupload_holder, "");

                var block_fileinputs = $(arr_multiupload[0]).find("span[data-multiupload-fileinputs]");
                $(block_fileinputs).removeAttr('data-multiupload-fileinputs')
                    .attr(block_multiupload_fileinputs, "");

                $(input_src).on('change', function (event) {
                  $('.upload-photo').remove();
                    readMultiUploadURL(event.target, function (has_error, img_src,counter) {
                        if (has_error == false && counter == '0') {
                            addImgToMultiUpload(img_src);
                        }
                    })
                });

                function addImgToMultiUpload(img_src) {
                    $(block_img_holder).html('');
                    var id = Math.random().toString(36).substring(2, 10);

                    var html = '<div class="posrel disinline popup-uploadd" id="' + id_multiupload_img + id + '">' +
                        '<span class="upload-close">' +
                        '<a href="javascript:void(0)" class="del_image" id="' + id_multiupload_img_remove + id + '" ><i class="fa fa-trash-o"></i></a>' +
                        '</span>' +
                        '<img src="' + img_src + '" >' +
                        '</div>';

                    var file_input = '<input type="file" name="file[]" id="' + id_multiupload_file + id + '" value="" style="display:none" />';
                    $(block_img_holder).append(html);
                    $(block_fileinputs).append(file_input);

                    bindRemoveMultiUpload(id);
                }

                function bindRemoveMultiUpload(id) {
                    $("#" + id_multiupload_img_remove + id).on('click', function () {
                        $("#" + id_multiupload_img + id).remove();
                        $("#" + id_multiupload_file + id).remove();
                    });
                }


            });
        }
    })(jQuery);
</script>

<script>
$(document).ready(function(){

  var url = "<?php echo $module_url_path; ?>";
  var patient_uploads_base_url = "<?php echo $patient_uploads_base_url; ?>";
    var fileExtension = ['jpg','jpeg','png','gif','bmp'];

    $('.upload_pic_btn').on('change', function(evt) {

        if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#err_upload_pic_btn').show();
            $('.upload_pic_btn').focus();
            $('#err_upload_pic_btn').html("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
            $('#err_upload_pic_btn').fadeOut(9000);
            $(".upload_pic_btn").val('');
            $('.upload-photo').remove();
            return false;
        }
        if(this.files[0].size > 5000000)
        {
            $('#err_upload_pic_btn').show();
            $('.upload_pic_btn').focus();
            $('#err_upload_pic_btn').html('File is too large, Maximum size allowed is 5 mb.');
            $('#err_upload_pic_btn').fadeOut(8000);
            $(".upload_pic_btn").val('');
            return false;
        }

        var file_obj = $(this)[0].files[0];
        var filename  =  $(this).val().split('\\').pop();
        var fileReader = new FileReader();
        fileReader.readAsArrayBuffer(file_obj);
        fileReader.onload = function ()
        {
          var imageData    = fileReader.result;
          var fileAsBuffer = new Buffer(imageData);
          var api       = virgil.API(virgilToken);
          var findkey   = api.cards.get(dumpId).then(function (cards) {
              var encryptedFile = api.encryptFor(fileAsBuffer, cards);
              var blob = new Blob([encryptedFile]);
              var enc_file = new File([blob], filename);
              //console.log(enc_file);
              formData.append('affected_area',enc_file,filename);
          });
        }           

    });

    $(document).on('click','.remove_affected_area',function(){
       $(this).closest('.image-avtar').remove();
    });

    $('#mobile_no_code').change(function(){
       $('#edit_mobile_no_code').val($(this).val());
    });

    $('#entitlement').change(function(){
      var id = $(this).val();
      if(id !='0')
      {
          $.ajax({
           url:url+'/entitlement/get_details',
           type:'get',
           data:{id:id},
           success:function(data){
              $('#card_no_block').show();
              $('#affected_area_block').show();
              if(data.status == 'success')
              {
                  var dec_card_no   = decrypt(api, data.card_no, key);
                  $('#card_no').val(dec_card_no);
                  
                  if(data.affected_area_photo !='')
                  {
                    var image_file = patient_uploads_base_url+'/'+data.affected_area_photo;
                    if(image_file!='')
                    {
                        var image_file_filename      = data.affected_area_photo;
                        var xhr = new XMLHttpRequest();
                        // this example with cross-domain issues.
                        xhr.open( "GET", image_file, true );
                        // Ask for the result as an ArrayBuffer.
                        xhr.responseType = "blob";
                        xhr.onload = function( e ) {
                          // Obtain a blob: URL for the image data.
                          var file = this.response;
                          var mime_type = file.type;

                          var fileReader = new FileReader();
                          fileReader.readAsArrayBuffer(file);
                          fileReader.onload = function ()
                          {
                            var img = imageUrl = '';
                            var imageData    = fileReader.result;
                            var fileAsBuffer = new Buffer(imageData);

                            var decryptedFile = key.decrypt(fileAsBuffer);
                            var blob = new Blob([decryptedFile], { type: mime_type });
                            
                            var urlCreator = window.URL || window.webkitURL;
                            
                            if(img=='' && imageUrl=='')
                            {
                                var imageUrl = urlCreator.createObjectURL( blob );
                                image = '<div class="image-avtar left"><img src="'+imageUrl+'" value="'+data.affected_area_photo+'" class="disp_img circle affected_area_photo"><a href="javascript:void(0)" class="remove_affected_area"><i class="fa fa-times"></i></a></div>';
                                 $('#affected_area_img_section').html(image);  
                            }
                          }
                        };
                        xhr.send();
                    }  
                  }
                  else
                  {

                     $('#affected_area_img_section').html('<span class="green-text">No Image uploaded</span>');
                  }

                  if(data.card_no !='' || data.card_no != null)
                  {
                      $('#card_no').next('label').addClass('active');
                  }
                  
              }
              else if(data.status == 'error')
              {
                $('#card_no').next('label').removeClass('active'); 
                $('#card_no').val('');
                $('#affected_area_img_section').html('<span class="green-text">No Image uploaded</span>');
              }
              
           }
        });
      }
      else
      {
          $('#card_no_block').hide();
          $('#affected_area_block').hide();
      }
        
    });

    $('#save_entitlement_btn').click(function(e){

        var entitlement_id = $('#entitlement').val();
        var card_no        = $('#card_no').val();
        var enc_card_no    = '';


        if($('#entitlement').val()=='' || $('#entitlement').val() == '0')
        {
          $('#entitlement').closest('.input-field').find('.error').show();
          $('#entitlement').closest('.input-field').find('.error').fadeOut(4000);
          $('#entitlement').closest('.input-field').find('.error').html("Select Entitlement");
          $('#entitlement').focus();
          e.preventDefault();
        }
        else if($('#card_no').val()=='')
        {
          $('#card_no').closest('.input-field').find('.error').show();
          $('#card_no').closest('.input-field').find('.error').html("Enter card number");
          $('#card_no').closest('.input-field').find('.error').fadeOut(4000);
          $('#card_no').focus();
          e.preventDefault();
        }

        /* Data Encryption */                    
          var api       = virgil.API(virgilToken);
          var findkey   = api.cards.get(dumpId).then(function (cards) {
          var enc_card_no  = encrypt(api, card_no, cards);

          //On success 
          var src_arr =[];
          $('.affected_area_photo').each(function(){
               src_arr.push( $(this).attr('value'));
          });
          
          var aff_imgs = src_arr.toString();

          $('#existing_images').val(aff_imgs);

/*          var file_data = $('#affected_area').prop('files')[0];   

          formData.append("affected_area[]", document.getElementById('affected_area').files[0]);*/
          formData.append('_token' , "<?php echo csrf_token(); ?>");
          formData.append('entitlement_id' , entitlement_id);
          formData.append('card_no' , card_no);
          formData.append('enc_card_no' , enc_card_no);
          formData.append('existing_images' , aff_imgs);
          
          $.ajax({
             url:url+'/entitlement/store',
             type:'post',
             data:formData,
             cache: false,
             contentType: false,
             processData: false,
             success:function(data){
                $('#entitlement_popup .modal-close').click();
                $(".open_popup").click();
                $('.flash_msg_text').html(data.msg);
             }
          });
        
        });
        
    });

    $('#entitlement_popup .modal-close').click(function(){

          $('#card_no_block').hide();
          $('#affected_area_block').hide();
    });

    $('.entitlement_edit').click(function(){
      var id = $(this).attr('value');
      var entitlement = $(this).attr('data-entitlement');



      $('.entitlement').find('.select-dropdown').val(entitlement);
      $('.entitlement').val(id).attr('selected','selected');
      
      if(id !='0')
      {
          $.ajax({
           url:url+'/entitlement/get_details',
           type:'get',
           data:{id:id},
           success:function(data){
              $('#card_no_block').show();
              $('#affected_area_block').show();
              if(data.status == 'success')
              {
                  var dec_card_no   = decrypt(api, data.card_no, key);
                  $('#card_no').val(dec_card_no);

                  if(data.affected_area_photo !='')
                  {
                    var image_file = patient_uploads_base_url+'/'+data.affected_area_photo;
                    if(image_file!='')
                    {
                        var image_file_filename      = data.affected_area_photo;
                        var xhr = new XMLHttpRequest();
                        // this example with cross-domain issues.
                        xhr.open( "GET", image_file, true );
                        // Ask for the result as an ArrayBuffer.
                        xhr.responseType = "blob";
                        xhr.onload = function( e ) {
                          // Obtain a blob: URL for the image data.
                          var file = this.response;
                          var mime_type = file.type;

                          var fileReader = new FileReader();
                          fileReader.readAsArrayBuffer(file);
                          fileReader.onload = function ()
                          {
                            var img = imageUrl = '';
                            var imageData    = fileReader.result;
                            var fileAsBuffer = new Buffer(imageData);

                            var decryptedFile = key.decrypt(fileAsBuffer);
                            var blob = new Blob([decryptedFile], { type: mime_type });
                            
                            var urlCreator = window.URL || window.webkitURL;
                            
                            if(img=='' && imageUrl=='')
                            {
                                var imageUrl = urlCreator.createObjectURL( blob );
                                image = '<div class="image-avtar left"><img src="'+imageUrl+'" value="'+data.affected_area_photo+'" class="disp_img circle affected_area_photo"><a href="javascript:void(0)" class="remove_affected_area"><i class="fa fa-times"></i></a></div>';
                                 $('#affected_area_img_section').html(image);  
                            }
                          }
                        };
                        xhr.send();
                    }

                  }
                  else
                  {

                     $('#affected_area_img_section').html('<span class="green-text">No Image uploaded</span>');
                  }

                  if(data.card_no !='' || data.card_no != null)
                  {
                      $('#card_no').next('label').addClass('active');
                  }   
              }
              else if(data.status == 'error')
              {
                $('#card_no').next('label').removeClass('active'); 
                $('#card_no').val('');
                $('#affected_area_img_section').html('<span class="green-text">No Image uploaded</span>');
              }
           }
        });
      }
      else
      {
          $('#card_no_block').hide();
          $('#affected_area_block').hide();
      }
    });

    $(document).on('click','.upload-photo',function(){
       $('#affected_area').val('')
    });

    $('#btn_entitlement').click(function(){
      $('.entitlement').find('.select-dropdown').val("Select Entitlement");
      $('.entitlement').val('0').attr('selected','selected');
    });

    $('.entitlement_delete').click(function(){
         $('#delete_entitlement_id').val($(this).attr('value'));
    });

    $('#delete_entitlement_btn').click(function(){
        var id = $('#delete_entitlement_id').val();

        var _token = "<?php echo csrf_token(); ?>";

        $.ajax({
           url:url+'/entitlement/delete',
           type:'post',
           data:{_token:_token, id:id},
           success:function(data){
              $('#entitlement_delete_popup .modal-close').click();
              $(".open_popup").click();
              $('.flash_msg_text').html(data.msg);
              
           }
        });
                  
    });


});
</script>

@if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
<script type="text/javascript">
  
  var user_entitlement_arr = '<?php echo json_encode($user_entitlement_arr); ?>';
  var user_entitlement_arr = jQuery.parseJSON( user_entitlement_arr );
  
  var api       = virgil.API(virgilToken);
  var key       = api.keys.import(dumpSessionId);
  
  $.each(user_entitlement_arr, function (inner_key, val) {
    var card_no   = decrypt(api, val.card_no, key);
    $('#card_id_'+inner_key).html(card_no);
  });

</script>
@endif
        
  </div>
  <!--Container End-->
  @endsection


