@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <script type="text/javascript">
        var card_id      = "{{isset($patient_details[0]['userinfo']['dump_id']) && !empty($patient_details[0]['userinfo']['dump_id']) ? $patient_details[0]['userinfo']['dump_id'] : ''}}";
        var userkey      = "{{isset($patient_details[0]['userinfo']['dump_session']) && !empty($patient_details[0]['userinfo']['dump_session']) ? $patient_details[0]['userinfo']['dump_session'] : ''}}";
        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(userkey);
    </script>

    <!--tab start-->
    <div class="mar300  has-header minhtnor">
    <style>
      a.disabled {
          pointer-events: none;
          cursor: default;
          opacity: 0.6;
      }
      .text-bx {
          margin-top: 20px;
          margin-bottom: 20px;
      }
      .required_field
      {
         color:red;
      }
   </style>
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);" class="active"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>
        <div id="patient" class="tab-content medi ">
            <input type="hidden" value="{{isset($enc_patient_id) ? $enc_patient_id : ''}}" id="patient_id">
            <div class="doctor-container">
                <div class="head-medical-pres" id="display_patient">
                    <h2 class="center-align"></h2>
                    <span class="posleft qusame rescahnge "><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                    @if($patient_details[0]['original_profile_type'] == 'doctoroo')
                        <span class="posright qusame rescahnge">
                            <a href="{{isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'doctoroo' ? '#make-my-patient' : '#make-my-patient'}}" id="btn_change_patient_type" value="{{isset($patient_details[0]['type']) ? $patient_details[0]['type'] : ''}}" class="btn cart bluedoc-bg  round-corner center-align icon-btn" ><i class="material-icons" >notifications_none</i>{{isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'doctoroo' ? 'Doctoroo Patient' : ''}} {{isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'myown' ? 'My Own Patient' : ''}} 
                            </a>
                        </span>
                    @endif
                </div>


                <div class="row"  id="display_details_block">
                    <div class="col s12">
                        <div class="round-box z-depth-3">
                            <div class="blue-border-block-top"></div>
                            <div class="round-box-content blue-border">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="head-medical-pres" style="margin: 0 0 10px;">
                                            <span class="posleft qusame rescahnge image-avtar">
                                            @php 
                                                $src="";
                                                if(isset($patient_details[0]['userinfo']['profile_image']) && !empty($patient_details[0]['userinfo']['profile_image']) && File::exists($profile_img_base_path.$patient_details[0]['userinfo']['profile_image']))
                                                {
                                                   $src = $profile_img_public_path.$patient_details[0]['userinfo']['profile_image'];
                                                }
                                                else
                                                {
                                                   $src = $profile_img_public_path.'default-image.jpeg';
                                                }

                                                $pat_is_online = isset($patient_details[0]['userinfo']['is_online']) ? $patient_details[0]['userinfo']['is_online'] : '';
                                            @endphp
                                                <img src="{{$src}}" alt="" class="circle" />
                                                @if($pat_is_online == 1)
                                                    <span class="onlinenew"></span>
                                                @else
                                                    <span class="online"></span>
                                                @endif
                                            </span>
                                            <h2 class="center-align" style="margin: 0;">Patient Details</h2>
                                            <a href="javascript:void(0)" class="bluedoc-bg btn-floating edit-ico center-align white-text circle btn" id="btn_edit_details"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" id="btn_download_pdf" class="bluedoc-bg btn-floating download-ico center-align white-text circle btn file_download" entitlement_name="all details and" target="_blank"><i class="material-icons">file_download</i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col l6 s12 ">
                                        <div class="row">
                                            <div class="col s12 martp">
                                                <h3 class="sethead ">Personal Information</h3> 
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">First Name</strong> {{isset($patient_details[0]['userinfo']['first_name']) ? $patient_details[0]['userinfo']['first_name'] : '' }} 
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Last Name</strong> {{isset($patient_details[0]['userinfo']['last_name']) ? $patient_details[0]['userinfo']['last_name'] : '' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col m6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Date of Birth</strong> {{isset($patient_details[0]['date_of_birth']) ? date('d F, Y', strtotime($patient_details[0]['date_of_birth'])) : '-' }}
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Gender</strong> {{isset($patient_details[0]['gender'] ) && $patient_details[0]['gender'] == 'F' ? 'Female' : '' }}
                                                    {{isset($patient_details[0]['gender'] ) && $patient_details[0]['gender'] == 'M' ? 'Male' : '' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Phone No. </strong> <span class="dec_phone_no"></span>
                                                </label>
                                            </div>
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Mobile No. </strong> {{isset($patient_details[0]['mobile_no']) ? decrypt_value($patient_details[0]['mobile_no']) : '-' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row martp">
                                            <div class="col s12">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Address. </strong> <span class="dec_address"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l6 s12 ">
                                        <div class="row">
                                            <div class="col s12 martp">
                                                <h3 class="sethead ">Entitlement</h3>
                                            </div>
                                        </div>
                                        @if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
                                            @foreach($user_entitlement_arr as $key => $entitle_val)
                                                <div class="row ">
                                                    <div class="col l6 s12 martp posrel">
                                                        <label class="doc-details">
                                                            <strong class="grey-text"> {{isset($entitle_val['user_entitlement']['entitlement']) ? $entitle_val['user_entitlement']['entitlement'] : ''}} </strong> <span class="dec_card_no_{{$entitle_val['id']}}"></span>
                                                        </label>
                                                        @if($entitle_val['affect_area_img'] !='' && File::exists($patient_uploads_url.$entitle_val['affect_area_img']))
                                                            <a download class="bluedoc-bg btn-floating download-medicare center-align white-text circle btn file_download image_show_{{$key}}" entitlement_name="{{isset($entitle_val['user_entitlement']['entitlement']) ? $entitle_val['user_entitlement']['entitlement'] : ''}}"><i class="material-icons ">file_download</i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <script>
                                                    var card_no = "{{isset($entitle_val['card_no']) ? $entitle_val['card_no'] : '' }}";

                                                    if(card_no != ""){
                                                        var dec_card_no   = key.decrypt(card_no).toString();
                                                        $(".dec_card_no_{{$entitle_val['id']}}").html(dec_card_no);
                                                    }
                                                    var image_file = '{{$patient_uploads_base_url.$entitle_val["affect_area_img"]}}';
                                                    if(image_file!='')
                                                    {
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
                                                            var innerkey   = '{{$key}}';
                                                            var image_file_filename      = '{{ $entitle_val["affect_area_img"] }}';
                                                            
                                                            var img = imageUrl = '';
                                                            var imageData    = fileReader.result;
                                                            var fileAsBuffer = new Buffer(imageData);

                                                            var decryptedFile = key.decrypt(fileAsBuffer);
                                                            var blob = new Blob([decryptedFile], { type: mime_type });
                                                            
                                                            var urlCreator = window.URL || window.webkitURL;
                                                            if(img=='' && imageUrl=='')
                                                            {
                                                                var imageUrl = urlCreator.createObjectURL( blob );
                                                                $(".image_show_"+innerkey).attr('href',imageUrl);
                                                                $(".image_show_"+innerkey).attr('download',image_file_filename);
                                                            }
                                                          }
                                                        };
                                                        xhr.send();
                                                    }                                                                      
                                                </script>

                                            @endforeach
                                        @else
                                            <div class="row">
                                                <div class="col l6 s12 martp posrel">
                                                    <span class="green-text">NA</span> 
                                                </div>
                                            </div>                                               
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="head-medical-pres" style="display: none;" id="edit_patient">
                    <h2 class="center-align">Edit Patient Details</h2>
                    <span class="posleft qusame rescahnge hide-on-med-and-down"><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                </div>
                <div class="row" style="display: none;" id="edit_details_block">
                    <div class="col s12">
                       <form id="edit_details_form" enctype="multipart/form-data"> 
                        <div class="round-box z-depth-3">
                            <div class="blue-border-block-top"></div>
                            <div class="round-box-content blue-border edit-profile">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="head-medical-pres" style="margin: 0 0 10px;">
                                            <span class="posright qusame rescahnge new-position ">
                                              <button type="submit" class="border-btn lnht round-corner center-align">Save</button>
                                            </span>
                                            <a href="javascript:void(0)" id="btn_cancel_edit" class="bluedoc-bg btn-floating cancel-ico new-position center-align white-text circle btn" ><i class="material-icons">close</i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m12 s12">
                                        <div class="input-field selct maronytb">
                                            <select id="regular_doctor">
                                                <option value="">Are you this Patient's regular Doctor? </option>
                                                <option value="yes" {{isset($regular_doctor_status) && $regular_doctor_status == 'yes' ? 'selected' : ''}} >Yes</option>
                                                <option value="no" {{isset($regular_doctor_status) && $regular_doctor_status == 'no' ? 'selected' : ''}}>No</option>
                                            </select>
                                            <span class="error_class"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m12 s12">
                                        <div class="otherdetails">
                                            <div class="row">
                                                <div class="col l12 m12 s12">
                                                    <h3 class="sethead ">Personal Information</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar input-padding-25px">
                                                        <input type="text" id="fname" name="fname" value="{{isset($patient_details[0]['userinfo']['first_name']) ? $patient_details[0]['userinfo']['first_name'] : '' }}" class="validate">
                                                        <label for="fname" class="grey-text truncate">First Name<span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field  text-bx lessmar input-padding-25px">
                                                        <input type="text" id="lname" value="{{isset($patient_details[0]['userinfo']['last_name']) ? $patient_details[0]['userinfo']['last_name'] : '' }}" class="validate">
                                                        <label for="lname" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar input-padding-25px"> 
                                                        <input type="text" id="dob" value="{{isset($patient_details[0]['date_of_birth']) ? date('d/m/Y', strtotime($patient_details[0]['date_of_birth'])) : '' }}" class="validate datepicker">
                                                        <label for="dob" class="grey-text truncate">Date of Birth<span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field selct maronytb">
                                                        <select id="patient_gender">
                                                            <option value="">Gender</option>
                                                            <option value="M" {{isset($patient_details[0]['gender'] ) && $patient_details[0]['gender'] == 'M' ? 'selected' : '' }}>Male</option>
                                                            <option value="F" {{isset($patient_details[0]['gender'] ) && $patient_details[0]['gender'] == 'F' ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar input-padding-25px">
                                                        <input type="text" id="phone_no" value="{{isset($patient_details[0]['phone_no']) ? $patient_details[0]['phone_no'] : '' }}" class="validate dec_phone_no">
                                                        <label for="phone_no" class="grey-text truncate">Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar input-padding-25px">
                                                        <input type="text" id="mobile_no" value="{{isset($patient_details[0]['mobile_no']) ? decrypt_value($patient_details[0]['mobile_no']) : '' }}" class="validate">
                                                        <label for="mobile_no" class="grey-text truncate">Mobile Number<span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l12 m12 s12">
                                                    <div class="input-field  text-bx lessmar input-padding-25px">
                                                        <input type="text" id="address" class="materialize-textarea dec_address" value="{{isset($patient_details[0]['suburb']) ? $patient_details[0]['suburb'] : '' }}">
                                                        <label for="address" class="grey-text truncate">Address<span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col l6 m12 s12">
                                        <div class="otherdetails">
                                            <div class="row">
                                                <div class="col l6 m12 s12">
                                                    <h3 class="sethead ">Entitlement</h3>
                                                </div>
                                            </div>
                                            
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
                                                            <td><span class="dec_card_no_{{$val['id']}}"></span></td>
                                                            <td>
                                                                @if(isset($val['affect_area_img']) && !empty($val['affect_area_img']))    
                                                                     @if($val['affect_area_img'] !='' && File::exists($patient_uploads_url.$val['affect_area_img']))
                                                                        <div class="image-avtar left"> 
                                                                            <img  class="disp_img circle edit_image_show_{{$key}}">
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

                                                        <script>
                                                            var card_no = "{{isset($val['card_no']) ? $val['card_no'] : '' }}";

                                                            if(card_no != ""){
                                                                var dec_card_no   = key.decrypt(card_no).toString();
                                                                $(".dec_card_no_{{$val['id']}}").html(dec_card_no);
                                                            }

                                                            var image_file = '{{$patient_uploads_base_url.$val["affect_area_img"]}}';
                                                            if(image_file!='')
                                                            {
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
                                                                    var innerkey   = '{{$key}}';
                                                                    var image_file_filename      = '{{ $val["affect_area_img"] }}';
                                                                    
                                                                    var img = imageUrl = '';
                                                                    var imageData    = fileReader.result;
                                                                    var fileAsBuffer = new Buffer(imageData);

                                                                    var decryptedFile = key.decrypt(fileAsBuffer);
                                                                    var blob = new Blob([decryptedFile], { type: mime_type });
                                                                    
                                                                    var urlCreator = window.URL || window.webkitURL;
                                                                    if(img=='' && imageUrl=='')
                                                                    {
                                                                        var imageUrl = urlCreator.createObjectURL( blob );
                                                                        $(".edit_image_show_"+innerkey).attr('src',imageUrl);
                                                                    }
                                                                  }
                                                                };
                                                                xhr.send();
                                                            }                                                                  
                                                        </script>
                                                    @endforeach    
                                                @else
                                                    <tr>
                                                        <td>
                                                            <span class="green-text">Not available</span>    
                                                        </td>
                                                    </tr>
                                                @endif 
                                            </table>
                                            <a class="border-btn-nomarrl center-align truncate" href="#entitlement_popup" id="btn_entitlement"><span class="font-size-16px">+</span> Add Another Entitlement</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                      </form>
                    </div>
                </div>

    <script>
        var phone_no = "{{isset($patient_details[0]['phone_no']) && !empty(isset($patient_details[0]['phone_no'])) ? $patient_details[0]['phone_no'] : ''}}";
        var address = "{{isset($patient_details[0]['suburb']) && !empty(isset($patient_details[0]['suburb'])) ? $patient_details[0]['suburb'] : ''}}";

        if(phone_no != ""){
            var dec_phone_no   = key.decrypt(phone_no).toString();
            $('.dec_phone_no').html(dec_phone_no);
            $('.dec_phone_no').val(dec_phone_no);
        }

        if(address != ""){
            var dec_address   = key.decrypt(address).toString();
            $('.dec_address').html(dec_address);
            $('.dec_address').val(dec_address);
        }
    </script>

                <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 posrel">
                            <div class="heading-round-box">Regular Family Doctor</div>
                            <div class="green-border round-box-content  max-height">
                                <div class="text-content">
                                    <ul class="collection brdrtopsd ">
                                        @if(isset($patient_details[0]['familydoctor']) && !empty($patient_details[0]['familydoctor']))
                                        @foreach($patient_details[0]['familydoctor'] as $doctor)
                                            <li class="collection-item avatar  valign-wrapper">
                                                <div class="image-avtar left">
                                                    <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" class="circle" />
                                                </div>
                                                <div class="doc-detail wid90 left">
                                                    <span class="title"> {{isset($doctor['first_name']) ? $doctor['first_name'] : ''}} {{isset($doctor['last_name']) ? $doctor['last_name'] : ''}}
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                        @endforeach
                                        @endif
                                        @if(isset($regular_doctor_arr))
                                            @foreach($regular_doctor_arr as $val)
                                                <li class="collection-item avatar  valign-wrapper">
                                                    <div class="image-avtar left">
                                                        <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" class="circle" />
                                                    </div>
                                                    <div class="doc-detail wid90 left">
                                                        
                                                        @if(isset($val['id']) && $val['id'] != '')
                                                        <span class="title"><a target="_blank" href="{{ url('/') }}/doctor/profile_about/{{ base64_encode($val['id']) }}" class="valign-wrapper">{{isset($val['title']) ? $val['title'] : ''}} {{isset($val['first_name']) ? $val['first_name'] : ''}} {{isset($val['last_name']) ? $val['last_name'] : ''}}</a></span>
                                                        @else
                                                        <span class="title">{{isset($val['title']) ? $val['title'] : ''}} {{isset($val['first_name']) ? $val['first_name'] : ''}} {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if(empty($patient_details[0]['familydoctor']) && empty($regular_doctor_arr))
                                         <p class="grey-text">If you have selected above that you are this patient's regular doctor will automatically added here. Otherwise either you or the Patient can enter their doctor details.
                                        </p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="{{$module_url_path}}/patients/family_doctors/add/{{$enc_patient_id}}">
                                        <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>

                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Regular Click &amp; Collect Pharmacies</div>
                            <div class="green-border round-box-content max-height">
                                <div class="text-content">
                                    <ul class="collection brdrtopsd ">
                                    @if(isset($pharmacy_data) && !empty($pharmacy_data))
                                        @foreach($pharmacy_data as $ph_data)
                                            <?php /*<li class="collection-item avatar valign-wrapper">
                                                <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                                                <div class="doc-detail-location left">
                                                    <span class="title truncate"> {{ $ph_data['pharmacy_user_details']['title'].' '.$ph_data['pharmacy_user_details']['first_name'].' '.$ph_data['pharmacy_user_details']['last_name'] }}
                                                    </span>
                                                    <small>
                                                        {{ $ph_data['pharmacy_details']['address1'].' '.$ph_data['pharmacy_details']['address2'] }}
                                                    </small>
                                                </div>
                                                <div class="right posrel"> <a href="#" data-activates='dropdown_{{$ph_data['pharmacy_user_details']['first_name']}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                                </div>
                                                <ul id='dropdown_{{$ph_data['pharmacy_user_details']['first_name']}}' class='dropdown-content doc-rop rightless'>
                                                    <li><a href="">View Message</a></li>
                                                    <li><a href="">Change</a></li>
                                                    <li><a href="#delete_pharmacy" class="delete_pharmacy" data-pharmacy_id="{{ base64_encode($ph_data['id']) }}">Delete</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </li>*/ ?>

                                            <li class="collection-item avatar valign-wrapper">
                                                <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                                                <div class="doc-detail-location left">
                                                    <span class="title truncate"> {{ $ph_data['pharmacy_list']['company_name'] }}
                                                    </span>
                                                    <small>
                                                        {{ $ph_data['pharmacy_list']['street'].', '.$ph_data['pharmacy_list']['suburb'].', '.$ph_data['pharmacy_list']['state'].', '.$ph_data['pharmacy_list']['code'] }}
                                                    </small>
                                                </div>
                                                <div class="right posrel"> <a href="#" data-activates='dropdown_{{$ph_data["id"]}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                                </div>
                                                <ul id='dropdown_{{$ph_data["id"]}}' class='dropdown-content doc-rop rightless'>
                                                    <!-- <li><a href="">View Message</a></li>
                                                    <li><a href="">Change</a></li> -->
                                                    <li><a href="#delete_pharmacy" class="delete_pharmacy" data-pharmacy_id="{{ base64_encode($ph_data['id']) }}">Delete</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </li>
                                        @endforeach
                                    @else
                                       <p  class="grey-text">
                                          You may add the Patient's regular pharmacy in order to collect their medication from - or they can add it labelMonthPrev
                                       </p> 
                                    @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="{{$module_url_path}}/patients/add_pharmacy/{{$enc_patient_id}}">
                                        <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Previously Seen Doctoroo Doctors</div>
                            <div class="green-border round-box-content">
                                <div class="text-content-big">
                                    <ul class="collection brdrtopsd ">
                                        @if(isset($previous_seen_dr) && !empty($previous_seen_dr))
                                        @foreach($previous_seen_dr as $val)
                                        @php 
                                            $src="";
                                            if(isset($val['doctor_user_details']['profile_image']) && File::exists($profile_img_base_path.$val['doctor_user_details']['profile_image']) && !empty($val['doctor_user_details']['profile_image']))
                                            {
                                               $src = $profile_img_public_path.$val['doctor_user_details']['profile_image'];
                                            }
                                            else
                                            {
                                               $src = $profile_img_public_path.'default-image.jpeg';
                                            }  
                                        @endphp

                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="image-avtar left"> <img src="{{$src}}" alt="" class="circle" /></div>
                                            <div class="doc-detail wid90 left">
                                                <span class="title"> 
                                                    @if(isset($val['doctor_user_details']['id']) && $val['doctor_user_details']['id'] != '')
                                                    <a target="_blank" href="{{ url('/') }}/doctor/profile_about/{{ base64_encode($val['doctor_user_details']['id']) }}" class="valign-wrapper">{{ isset($val['doctor_user_details']['title']) ? $val['doctor_user_details']['title'] : '' }} {{ isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : '' }} {{ isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : '' }}</a>
                                                    @else
                                                    {{ isset($val['doctor_user_details']['title']) ? $val['doctor_user_details']['title'] : '' }} {{ isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : '' }} {{ isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : '' }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                        @else
                                        <p class="grey-text">This will be added automatically</p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Family Members</div>
                            <div class="green-border round-box-content max-height">
                                <div class="text-content">
                                    <ul class="collection brdrtopsd ">
                                    @if(isset($patient_details[0]['memberfamily']) && !empty($patient_details[0]['memberfamily']))
                                        @foreach($patient_details[0]['memberfamily'] as $member)
                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="image-avtar left"> 
                                                <img src="{{$profile_img_public_path}}default-image.jpeg" alt="" class="circle" />
                                            </div>
                                            <div class="doc-detail wid90 left">
                                                <span class="title">{{isset($member['first_name']) ? $member['first_name'] : ''}} {{isset($member['last_name']) ? $member['last_name'] : ''}}
                                                </span>
                                            </div>
                                            <div class="right posrel"> <a href="#" data-activates='dropdown_{{$member['id']}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                            </div>
                                            <ul id='dropdown_{{$member['id']}}' class='dropdown-content doc-rop member_action_panel'>
                                                <input type="hidden" value="{{isset($member['first_name']) ? $member['first_name'] : ''}}" class='member_fname'>

                                                <input type="hidden" value="{{isset($member['last_name']) ? $member['last_name'] : ''}}" class='member_lname'>

                                                <input type="hidden" value="{{isset($member['email']) ? $member['email'] : ''}}" class='member_email'>

                                                <input type="hidden" value="{{isset($member['gender']) ? $member['gender'] : ''}}" class='member_gender'>

                                                <input type="hidden" value="{{isset($member['date_of_birth']) ? $member['date_of_birth']   : ''}}" class='member_dob'>

                                                <input type="hidden" value="{{isset($member['mobile_number']) ? $member['mobile_number'] : ''}}" class='member_mobile_no'>

                                                <input type="hidden" value="{{isset($member['relationship']) ? $member['relationship']   : ''}}" class='member_relationship'>

                                                <input type="hidden" value="{{isset($member['id']) ? $member['id']   : ''}}" class='member_id'>

                                                <li><a href="#view_member" class="view_member">View Details</a></li>
                                                <li><a href="#edit_member" class="edit_member">Edit</a></li>
                                                <li><a href="#delete_member" class="delete_member_box" value="{{$member["id"]}}">Delete</a></li>
                                                <li><a href="{{ $module_url_path.'/patients/family_members/unlink/'.$enc_patient_id.'/'.base64_encode($member["id"]) }}">Unlike Family Member</a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                        @else
                                         <p class="grey-text">You may add this Patient's family members if they consented, or they can add later.</p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="#add_member">
                                        <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="add_member" class="modal  date-modal addperson">
        <form method="post" id="add_member_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Add someone to your account</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="firstname" name="firstname" type="text" class="validate">
                        <label for="firstname">First Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="lastname" name="lastname" type="text" class="validate">
                        <label for="lastname">Last Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field selct select2">
                        <select id="gender" name="gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx ">
                        <input id="datebirth datepicker" name="datebirth" type="date" class="datepicker dob validate" value="">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="member_email" name="member_email" type="text" class="validate">
                        <label for="gender">Email</label>
                        <span class="error_class"></span>
                        <span id="valid_mail"></span>

                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx ">
                        <input id="contact_no" name="contact_no" type="text" class="">
                        <label class="active" for="contact_no">Contact no</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field text-bx">
                        <input id="password" type="text" name="user_relation" class="validate">
                        <label for="password">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer ">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
               <a href="" id="btn_submit" class="modal-action waves-effect waves-green btn-cancel-cons right">Add Person</a>
            </div>
         </form>
    </div>

    <div id="edit_member" class="modal  date-modal addperson">
        <form method="post" id="edit_member_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="member_id">
            <div class="modal-content">
               <h4 class="center-align modal_title member_modal_title">Edit Member</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s12 m6">
                        <input type="hidden" id="edit_member_id">
                     <div class="input-field text-bx">
                        <input id="edit_firstname" name="edit_firstname" type="text" class="validate">
                        <label for="edit_firstname">First Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="edit_lastname" name="lastname" type="text" class="validate">
                        <label for="lastname">Last Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6" id="edit_gender_block">
                     <div class="input-field selct gender-drop">
                        <select id="edit_gender" name="edit_gender" class="edit_gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  
                  <div class="col s12 m6" id="edit_date_block">
                     <div class="input-field text-bx ">
                        <input id="edit_datebirth" name="datebirth" type="date" class="datepicker dob_upd validate" value="">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="edit_member_email" name="edit_member_email" type="text" class="validate" readonly="">
                        <label for="edit_member_email">Email</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx ">
                        <input id="edit_contact_no" name="edit_contact_no" type="text" class="">
                        <label class="active" for="datebirth">Contact no</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field text-bx">
                        <input id="edit_password" type="text" name="" class="validate">
                        <label for="password">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="show_date_html">
            </div>

            <div class="modal-footer center-align">
               <a href="javascript:void(0)" id="back_btn" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
               <a href="" id="edit_member_btn" class="modal-action waves-effect waves-green btn-cancel-cons">Update</a>
            </div>
         </form>
    </div>

    <div id="view_member" class="modal  date-modal addperson">
      
            <div class="modal-content">
               <h4 class="center-align modal_title member_modal_title">Member Details</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="view_firstname" name="edit_firstname" type="text" class="validate" readonly="">
                        <label for="view_firstname">First Name</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="view_lastname" name="lastname" type="text" class="validate"  readonly="">
                        <label for="view_lastname">Last Name</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field selct gender-drop">
                        <input type="text" id="view_gender" readonly="">
                        <span class="error_class"></span>
                     </div>
                  </div>
                  
                  <div class="col s12 m6" id="edit_date_block">
                     <div class="input-field text-bx ">
                        <input id="view_datebirth" name="view_datebirth" type="text" class="dob_upd validate" readonly="">
                        <label class="active" for="view_datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 m6">
                     <div class="input-field text-bx">
                        <input id="view_member_email" name="view_member_email" type="text" class="validate" readonly="">
                        <label for="view_member_email">Email</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s12 m6">
                     <div class="input-field text-bx ">
                        <input id="view_contact_no" name="edit_contact_no" type="text" class=""  readonly="">
                        <label class="active" for="view_contact_no">Contact no</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field text-bx">
                        <input id="view_password" type="text" name="" class="validate"  readonly="">
                        <label for="view_password">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer center-align">
               <a href="javascript:void(0)" id="back_btn" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Ok</a>
               
            </div>
    </div>

      <div id="delete_member" class="modal  date-modal addperson">
          <div class="modal-content">
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <p class="center-align">Do you really want to delete this member? This member's all data including consultation history will be deleted permanantly</p>
              <input type="hidden" id="delete_member_id">
            </div>
            <div class="modal-footer">
                <a class="modal-close modal-action waves-effect waves-green btn-cancel-cons">Cancel</a>
                <a href="" class="modal-action waves-effect waves-green btn-cancel-cons" id="btn_delete_member">Delete</a>
            </div>
      </div>

    <div id="delete_pharmacy" class="modal  date-modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p>Are you sure you want to Delete Pharmacy?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-close modal-action waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons confirm_delete_pharmacy">Delete</a>
            <input type="hidden" id="delete_pharmacy_id">
        </div>
    </div>


    <a class="popup_open" href="#pharmacy_confirmation" style="display: none;"></a>

    <div id="pharmacy_confirmation" class="modal  date-modal addperson">
        <div class="modal-content">
           <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
           <div class="flash_msg_text center-align">Do you really want to add this pharmacy?</div>
           <input type="hidden" id="pharmacy_id">
        </div>
        <div class="modal-footer  center-align">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons" id="btn_add_pharmacy">Yes</a>
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">No</a>
        </div>  
    </div>

    <!-- Modal Reschedule -->
    <div id="make-my-patient" class="modal make-patient">
        <div class="modal-content">
            <h4 class="center-align">{{isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'doctoroo' ? 'Make My Own Patient' : ''}} {{isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'myown' ? 'Change Patient type to general doctoroo patient' : ''}}</h4>
        </div>
        @if(isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'doctoroo')
        <p class="center-align">This patient will recieve a notification and E - mail. Patient will need to approve your request before their profile type is changed.</p>
        @elseif(isset($patient_details[0]['type']) && $patient_details[0]['type'] == 'myown')
        <p class="center-align">Are you sure you want to remove this Patient as your own Patient? They will still be able to book a consultation with you. This patient will recieve a notification and E - mail. Patient will need to approve your request before their profile type is changed.</p>
        @endif

        <input type="hidden" id="patient_type">
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons right" id="btn_send_notification">Continue</a>
        </div>
    </div>

    <div id="entitlement_popup" class="modal addperson small-modal date-modal">
         <form method="post" id="add_entitlement_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Entitlement</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data entitle-modal">
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field selct select2">
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
                     <div class="input-field text-bx">
                        <input type="text" id="card_no" class="validate enc_card_no" name="card_no" value="">
                        <label for="reason" class="grey-text truncate">Enter Card Number <span class="required_field">*</span></label>
                        <span class="error"></span>
                     </div>
                  </div>
               </div>
               <div class="row" id="affected_area_block" style="display: none">
                  <div class="col s12 l12">
                     <div class="input-field uploadImgnew new-upload-img">
                          <div class="file-field input-field">
                              <div>
                               <span data-multiupload="3">
                               <span class="row">
                                   <div class="col s12 m10 l9">
                                        <div class="upload-ent-card">
                                            <div class="btn">
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
                  <div class="uploaded-img1" id="affected_area_img_section">
                  </div>
               </div>
            </div>
            <div class="modal-footer ">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
               <a href="javascript:void(0)" id="save_entitlement_btn" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
            </div>
         </form>
    </div>

    <div id="entitlement_delete_popup" class="modal addperson" style="display: none;">
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

    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>

    <script>
        var entitlementformData = new FormData();
        var card_id      = "{{isset($patient_details[0]['userinfo']['dump_id']) && !empty($patient_details[0]['userinfo']['dump_id']) ? $patient_details[0]['userinfo']['dump_id'] : ''}}";
        var userkey      = "{{isset($patient_details[0]['userinfo']['dump_session']) && !empty($patient_details[0]['userinfo']['dump_session']) ? $patient_details[0]['userinfo']['dump_session'] : ''}}";
        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(userkey);

        $(document).ready(function(){
            var url = "<?php echo $module_url_path; ?>";
            var patient_uploads_base_url = "<?php echo $patient_uploads_base_url; ?>";
            $('#entitlement').change(function(){
              var id = $(this).val();
              var patient_id = $('#patient_id').val();
              if(id !='0')
              {
                  $.ajax({
                   url:url+'/patients/entitlement/get_details',
                   type:'get',
                   data:{id:id,patient_id:patient_id},
                   success:function(data){
                      $('#card_no_block').show();
                      $('#affected_area_block').show();
                      if(data.status == 'success')
                      {
                          //$('#card_no').val(data.card_no);
                            var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                            var api                    = virgil.API(VIRGIL_TOKEN);
                            var key                    = api.keys.import(userkey);

                            if(data.card_no != "")
                            {
                                var dec_card_no = key.decrypt(data.card_no).toString();
                                $('#card_no').val(dec_card_no);
                            }

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
                  var findkey   = api.cards.get(card_id).then(function (cards) {
                      var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                      var blob = new Blob([encryptedFile]);
                      var enc_file = new File([blob], filename);
                      console.log(enc_file);
                      entitlementformData.append('affected_area',enc_file,filename);
                  });
                }           

            });            

            $('#save_entitlement_btn').click(function(){

                var entitlement_id = $('#entitlement').val();
                var card_no        = $('#card_no').val();
                var patient_id = $('#patient_id').val();

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
                var src_arr =[];
                $('.affected_area_photo').each(function(){
                     src_arr.push( $(this).attr('value'));
                });
                
                var aff_imgs = src_arr.toString();
                $('#existing_images').val(aff_imgs);

                var file_data = $('#affected_area').prop('files')[0];   

                if(card_no != '')
                {
                    var findkey = api.cards.get(card_id)
                    .then(function (cards) {
                        var enc_card_no = encrypt(api, card_no, cards);

                        //entitlementformData.append("affected_area[]", document.getElementById('affected_area').files[0]);
                        entitlementformData.append('_token' , "<?php echo csrf_token(); ?>");
                        entitlementformData.append('entitlement_id' , entitlement_id);
                        entitlementformData.append('card_no' , enc_card_no);
                        entitlementformData.append('existing_images' , aff_imgs);
                        entitlementformData.append('patient_id' , patient_id);
                        
                        $.ajax({
                           url:url+'/patients/entitlement/store',
                           type:'post',
                           data:entitlementformData,
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
                }
                
            });

            $('#entitlement_popup .modal-close').click(function(){

                  $('#card_no_block').hide();
                  $('#affected_area_block').hide();
            });

            $(document).on('click','.remove_affected_area',function(){
               $(this).closest('.image-avtar').remove();
            });

            $('.entitlement_edit').click(function(){
              var id = $(this).attr('value');
              var entitlement = $(this).attr('data-entitlement');
              var patient_id = $('#patient_id').val();

              $('.entitlement').find('.select-dropdown').val(entitlement);
              $('.entitlement').val(id).attr('selected','selected');
              
              if(id !='0')
              {
                  $.ajax({
                   url:url+'/patients/entitlement/get_details',
                   type:'get',
                   data:{id:id,patient_id:patient_id},
                   success:function(data){
                      $('#card_no_block').show();
                      $('#affected_area_block').show();
                      if(data.status == 'success')
                      {
                            var VIRGIL_TOKEN           = "{{env('VIRGIL_TOKEN')}}";
                            var api                    = virgil.API(VIRGIL_TOKEN);
                            var key                    = api.keys.import(userkey);

                            if(data.card_no != "")
                            {
                                var dec_card_no = key.decrypt(data.card_no).toString();
                                $('#card_no').val(dec_card_no);
                            }
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
                var patient_id = $('#patient_id').val();

                $.ajax({
                   url:url+'/patients/entitlement/delete',
                   type:'post',
                   data:{_token:_token, id:id,patient_id:patient_id},
                   success:function(data){
                      $('#entitlement_delete_popup .modal-close').click();
                      $(".open_popup").click();
                      $('.flash_msg_text').html(data.msg);
                      
                   }
                });
                          
            });

        });
    </script>

    <script>
    $(document).ready(function(){
        var url="<?php echo $module_url_path; ?>";

        $('#phone_no, #mobile_no,#card_no').keydown(function(){
            $(this).val($(this).val().replace(/[^\d]/,''));
            $(this).keyup(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
            });
        });
        
        //$('#btn_submit').click(function(e){
        $(document).on('click', '#btn_submit', function(e){
           e.preventDefault();
   
           var firstname = $('#firstname').val();
           var lastname = $('#lastname').val();
           var gender = $("#gender").val();
           var member_email = $('#member_email').val();
           var contact_no = $('#contact_no').val();
           var datebirth = $('.dob').val();
           var enc_patient_id = "<?php echo $enc_patient_id; ?>";
            
           $('.error_class,#valid_mail').html("");
           $('.datebirth_error').html("");
           var user_relation = $("input[name='user_relation']").val();
   
            if($('#firstname').val() == '')
            {
               $('#firstname').next('label').next('span').html("Please Enter first name");
               return false;
            }
            else if($('#lastname').val() == '')
            {
                $('#lastname').next('label').next('span').html("Please Enter Last name");
                return false;   
            }
            else if($('#gender').val() == '')
            {
                $('#gender').closest('.col').find('.error_class').html("Select Gender");
                return false;
            }
            else if($('.dob').val() == '')
            {
                $('.datebirth_error').html("Select Birth Date");   
                return false;
            }

            if($('#member_email').val() != '')
            {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if(pattern.test($('#member_email').val()) == false)
                {
                    $('#valid_mail').html("Enter valid email").css('color','red');
                    return false;
                }
            }
            
            if($("input[name='user_relation']").val()=='')
            {
               $("input[name='user_relation']").next('label').next('span').html("Enter Your Relation");
               return false;
            }

            if(contact_no != "" && contact_no != null && datebirth != "" && datebirth != null){
                var findkey = api.cards.get(card_id)
                .then(function (cards) {
                    
                    var enc_contact_no = encrypt(api, contact_no, cards);
                    var enc_dob = encrypt(api, datebirth, cards);

                    var formData = new FormData($('#add_member_form')[0]);
                    formData.append('firstname',firstname);
                    formData.append('lastname',lastname);
                    formData.append('gender',gender);
                    formData.append('email',member_email);
                    formData.append('contact_no',enc_contact_no);
                    formData.append('datebirth',enc_dob);
                    formData.append('user_relation',user_relation);
                    formData.append('enc_patient_id',enc_patient_id);
               
                    $.ajax({
                       url:url+'/patients/family_members/add',
                       type:'post',
                       data:formData,
                       processData: false,
                       contentType: false,
                       success:function(data){
                        if(data.status)
                          {
                            $("#add_member .modal-close").click()
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                          }
                       }
                   });

                }).then(null, function () {
                    $(".open_popup").click();
                    $('.flash_msg_text').html('Something went wrong');
                });
            }
        });
   
       $('#close_btn').click(function(){
            $('#minor').hide();
            location.reload();
        });

       $('.edit_member').click(function(){

            var firstname = $(this).closest('.member_action_panel').find('.member_fname').val();
            var lastname = $(this).closest('.member_action_panel').find('.member_lname').val();
            var email = $(this).closest('.member_action_panel').find('.member_email').val();
            var contact_no = $(this).closest('.member_action_panel').find('.member_mobile_no').val();
            var dob = $(this).closest('.member_action_panel').find('.member_dob').val();
            var gender = $(this).closest('.member_action_panel').find('.member_gender').val();
            var relationship = $(this).closest('.member_action_panel').find('.member_relationship').val();
            var member_id = $(this).closest('.member_action_panel').find('.member_id').val();

            if(contact_no != ""){
                var dec_contact_no = key.decrypt(contact_no).toString();
                $('#edit_contact_no').val(dec_contact_no);
            }

            if(dob != ""){
                var dec_dob   = key.decrypt(dob).toString();
                $('#edit_datebirth').val(dec_dob);
            }

            $('#edit_firstname').val(firstname);
            $('#edit_lastname').val(lastname);
            $('#edit_member_email').val(email);
            $('.edit_gender').find('.select-dropdown').val(gender);
            $('#edit_gender').val(gender).attr('selected','selected');
            $('#edit_password').val(relationship);
            $('#edit_member_id').val(member_id);

            if($('#edit_member_email').val() !='' && $('#edit_member_email').val() !=null)
            {
                $('#edit_member_email').next('label').addClass('active');    
            }
            else
            {
                $('#edit_member_email').next('label').removeClass('active');       
            }

            if($('#edit_firstname').val() !='' && $('#edit_firstname').val() !=null)
            {
                $('#edit_firstname').next('label').addClass('active');    
            }
            else
            {
                $('#edit_firstname').next('label').removeClass('active');       
            }

            if($('#edit_lastname').val() !='' && $('#edit_lastname').val() !=null)
            {
                $('#edit_lastname').next('label').addClass('active');    
            }
            else
            {
                $('#edit_lastname').next('label').removeClass('active');       
            }

            if($('#edit_contact_no').val() !='' && $('#edit_contact_no').val() !=null)
            {
                $('#edit_contact_no').next('label').addClass('active');    
            }
            else
            {
                $('#edit_contact_no').next('label').removeClass('active');       
            }

            if($('#edit_datebirth').val() !='' && $('#edit_datebirth').val() !=null)
            {
                $('#edit_datebirth').next('label').addClass('active');    
            }
            else
            {
                $('#edit_datebirth').next('label').removeClass('active');       
            }

            if($('#edit_password').val() !='' && $('#edit_password').val() !=null)
            {
                $('#edit_password').next('label').addClass('active');    
            }
            else
            {
                $('#edit_password').next('label').removeClass('active');       
            }
            
       });

        //$('#edit_member_btn').click(function(e){
        $(document).on('click', '#edit_member_btn', function(e){
           e.preventDefault();
            
            var member_id = $('#edit_member_id').val();
            var firstname = $('#edit_firstname').val();
            var lastname = $('#edit_lastname').val();      
            var gender = $('#edit_gender').val();
            var datebirth = $('#edit_datebirth').val();
            var user_relation = $('#edit_password').val();
            var email = $('#edit_member_email').val();
            var contact_no = $('#edit_contact_no').val();   
            var member_email = $('#edit_member_email').val();
   
           $('.error_class,#valid_mail').html("");
           $('.datebirth_error').html("");
   
           if($('#edit_firstname').val()=='')
           {
               $('#edit_firstname').next('label').next('span').html("Please Enter first name");
               return false;
           }
           else if($('#edit_lastname').val()=='')
           {
               $('#edit_lastname').next('label').next('span').html("Please Enter Last name");
               return false;   
           }
           else if($('#edit_gender').val()=='')
           {
               $('#edit_gender').closest('#edit_gender_block').find('.error_class').html("Select Gender");
               return false;
           }
           else if($('#edit_datebirth').val()=='')
            {
               $('.datebirth_error').html("Enter Birth Date");            
               return false;
            }
            else if($("#edit_password").val()=='')
            {
             $("#edit_password").next('label').next('span').html("Enter Your Relation");
             return false;
            }

            if(contact_no != "" && contact_no != null && datebirth != "" && datebirth != null){
                var findkey = api.cards.get(card_id)
                .then(function (cards) {
                    
                    var enc_contact_no = encrypt(api, contact_no, cards);
                    var enc_dob = encrypt(api, datebirth, cards);

                    var formData = new FormData($('#edit_member_form')[0]);
                    formData.append('member_id',member_id);
                    formData.append('firstname',firstname);
                    formData.append('lastname',lastname);
                    formData.append('gender',gender);
                    formData.append('member_email',member_email);
                    formData.append('contact_no',enc_contact_no);
                    formData.append('datebirth',enc_dob);
                    formData.append('user_relation',user_relation);    
                    $.ajax({
                        url:url+'/patients/family_members/edit',
                        type:'post',
                        data:formData,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success:function(data){
                         if(data.status)
                         {
                             $("#edit_member .modal-close").click()
                             $(".open_popup").click();
                             $('.flash_msg_text').html(data.msg);
                         }
                     }
                    });

                }).then(null, function () {
                    $(".open_popup").click();
                    $('.flash_msg_text').html('Something went wrong');
                });
            }
        });

        $('.view_member').click(function(){

            var firstname = $(this).closest('.member_action_panel').find('.member_fname').val();
            var lastname = $(this).closest('.member_action_panel').find('.member_lname').val();
            var email = $(this).closest('.member_action_panel').find('.member_email').val();
            var contact_no = $(this).closest('.member_action_panel').find('.member_mobile_no').val();
            var dob = $(this).closest('.member_action_panel').find('.member_dob').val();
            var gender = $(this).closest('.member_action_panel').find('.member_gender').val();
            var relationship = $(this).closest('.member_action_panel').find('.member_relationship').val();
            var member_id = $(this).closest('.member_action_panel').find('.member_id').val();

            if(contact_no != ""){
                var dec_contact_no = key.decrypt(contact_no).toString();
                $('#view_contact_no').val(dec_contact_no);
            }

            if(dob != ""){
                var dec_dob   = key.decrypt(dob).toString();
                $('#view_datebirth').val(dec_dob);
            }

            $('#view_firstname').val(firstname);
            $('#view_lastname').val(lastname);
            $('#view_member_email').val(email);
            $('.view_gender').find('.select-dropdown').val(gender);
            $('#view_gender').val(gender).attr('selected','selected');
            $('#view_password').val(relationship);
            $('#view_member_id').val(member_id);

            $('#view_firstname').next('label').addClass('active');
            $('#view_lastname').next('label').addClass('active');
            $('#view_member_email').next('label').addClass('active');
            $('#view_contact_no').next('label').addClass('active');
            $('#view_datebirth').next('label').addClass('active');
            $('#view_password').next('label').addClass('active');

       });

        $('.delete_member_box').click(function(){
           $('#delete_member_id').val($(this).attr('value'));
       });
   
       $('#btn_delete_member').click(function(e){
           e.preventDefault();
           var member_id=$('#delete_member_id').val();
           $.ajax({
               url:url+'/patients/family_members/delete',
               type:'get',
               data:{member_id:member_id},
               success:function(data){
                   if(data.status)
                    {
                        $("#delete_member .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
               }
           });
       });

       $('#member_email').blur(function(){
           var email_id=$(this).val();
           if($(this).val()!='')
           {
               $.ajax({
                   url:url+'/patients/check_member_mail',
                   type:'get',
                   data:{email_id:email_id},
                   success:function(data){
                       if(data.status=='exist')
                       {
                           $('#member_email').next('label').next('span').html("This E mail is already registered");
                           $('#btn_submit').addClass('disabled');
                       }
                       else
                       {
                        $('#member_email').next('label').next('span').html("");   
                        $('#btn_submit').removeClass('disabled');
                    }
                }
            });
           }
           else
           {
               $('#member_email').next('label').next('span').html("");   
               $('#btn_submit').removeClass('disabled');
           } 
       });

       $('.delete_pharmacy').click(function(){
             $('#delete_pharmacy_id').val(jQuery(this).data("pharmacy_id"));
       });

       $('.confirm_delete_pharmacy').click(function(){
                var pharmacy_id = $('#delete_pharmacy_id').val();
                if(pharmacy_id != '')
                {
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                        url: url+'/patients/delete_my_pharmacy',
                        type:'get',
                        dataType:'json',
                        data:{pharmacy_id:pharmacy_id,_token:token},
                        success:function(data){
                            if(data.msg)
                            {
                                $("#delete_pharmacy .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(data.msg);
                            }
                        }
                    });
                }
            });

       $('#btn_edit_details').click(function(){
            $('#edit_details_block').show();    
            $('#edit_patient').show();    
            $('#display_details_block').hide();    
            $('#display_patient').hide();    
       });
       $('#btn_cancel_edit').click(function(){
            $('#edit_details_block').hide();    
            $('#edit_patient').hide();    
            $('#display_details_block').show();    
            $('#display_patient').show();    
       });

       $('#edit_details_form').submit(function(e){
            e.preventDefault();
            $('.error_class').html('');

            var enc_phone_no = '';
            var enc_address = '';
            
            if($('#regular_doctor').val()=='' || $('#regular_doctor').val()==null)
            {
                $('#regular_doctor').closest('.col').find('.error_class').html("Please select an option");
                $('#regular_doctor').focus();
                return false;
            }
            else if($('#fname').val()=='' || $('#fname').val()==null)
            {
                $('#fname').next('label').next('span').html("Please Enter first name");
                $('#fname').focus();
                return false;
            }
            else if($('#lname').val()=='' || $('#lname').val()==null)
            {
                $('#lname').next('label').next('span').html("Enter last name");
                $('#lname').focus();
                return false;
            }
            else if($('#dob').val()=='' || $('#dob').val()==null)
            {
                $('#dob').next('label').next('span').html("Select date of birth");   
                return false;
            }
            else if($('#patient_gender').val()=='' || $('#dob').val()==null)
            {
                $('#patient_gender').closest('.col').find('.error_class').html("Select Gender");   
                $('#patient_gender').focus();
                return false;
            }
            else if($('#mobile_no').val()=='' || $('#mobile_no').val()==null)
            {
                $('#mobile_no').next('label').next('span').html("Enter mobile number");
                $('#mobile_no').focus();
                return false;
            }
            else if($('#address').val()=='' || $('#address').val()==null)
            {
                $('#address').next('label').next('span').html("Enter Address");
                $('#address').focus();
                return false;
            }
            /*else if($('#entitlement_no').val()=='' || $('#address').val()==null)
            {
                $('#entitlement_no').closest('.col').find('.error_class').html("Select Entitlement");
                $('#entitlement_no').focus();
                return false;
            }
            else if($('#card_no').val()=='' || $('#card_no').val()==null)
            {
                $('#card_no').next('label').next('span').html("Enter card number");
                $('#card_no').focus();
                return false;
            }*/

            /*var src_arr =[];
            $('.affected_area_photo').each(function(){
                 src_arr.push( $(this).attr('value'));
            });

            var aff_imgs = src_arr.toString();*/

            var findkey = api.cards.get(card_id)
            .then(function (cards) {

                if($('#phone_no').val() != "")
                {
                    enc_phone_no = encrypt(api, $('#phone_no').val(), cards);
                }
                if($('#address').val() != "")
                {
                    enc_address = encrypt(api, $('#address').val(), cards);
                }

                formData = new FormData();
                formData.append('affected_area', $( '#affected_area' )[0].files[0]);
                formData.append('_token',"<?php echo csrf_token(); ?>");  
                formData.append('regular_doctor',$('#regular_doctor').val());  
                formData.append('fname',$('#fname').val());  
                formData.append('lname',$('#lname').val());  
                formData.append('dob',$('#dob').val());  
                formData.append('gender',$('#patient_gender').val());  
                formData.append('mobile_no',$('#mobile_no').val());  
                formData.append('phone_no',$('#phone_no').val());  
                formData.append('address',$('#address').val());  
                /*formData.append('entitlement',$('#entitlement_no').val());  
                formData.append('card_no',$('#card_no').val());  */
                formData.append('enc_patient_id',$('#enc_patient_id').val());
                formData.append('enc_phone_no',enc_phone_no);
                formData.append('enc_address',enc_address);
                //formData.append('existing_images',aff_imgs);  

                $.ajax({
                  url:url+'/patients/edit_patient',
                  type:'post',
                  data:formData,
                  contentType:false,
                  processData:false,
                  cache:false,
                  dataType:'json',
                  success:function(data){
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }  
                });
            })
       });

       $('#btn_change_patient_type').click(function(){
            $('#patient_type').val($(this).attr('value'));
       });

       $('#regular_doctor').change(function(){
            if($(this).val() == 'yes')
            {

            }
            else
            {

            }
       });

       $('#btn_send_notification').click(function(){
            var enc_patient_id="<?php echo $enc_patient_id; ?>";
            var patient_type=$('#patient_type').val();
            
            $.ajax({
                url:url+'/patients/notify_patient',
                type:'get',
                dataType:'json',
                data:{enc_patient_id:enc_patient_id,patient_type:patient_type},
                success:function(data){
                    $('#make-my-patient .modal-close').click();
                    $(".open_popup").click();
                    $('.flash_msg_text').html(data.msg);
                }
            });
       });

       $('.modal-close').click(function(){
            $('#add_member_form')[0].reset();
            $('.error_class').html('');
            $('#add_member_form label').removeClass('active');
       });
       
    });

    $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            //selectYears: 100, // `true` defaults to 10.
            //min: new Date(2015,3,20),
            max:new Date(),
            // Accessibility labels
            /*labelMonthNext: 'Next month',
            labelMonthPrev: 'Previous month',
            labelMonthSelect: 'Select a month',
            labelYearSelect: 'Select a year',*/
            onOpen: function() {
                //console.log( 'Opened')
            },
            onClose: function() {
                //console.log( 'Closed ' + this.$node.val() )
                selected_date = this.$node.val();
            },
            onSelect: function() {
              //console.log( 'Selected: ' + this.$node.val() )
            },
            onStart: function() {
              //console.log( 'Hello there :)' )
            }
        });

        $('.timepicker').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: false, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function(){} //Function for after opening timepicker
            });
        $('.cancel_search').click(function(){
            var url="<?php echo $module_url_path; ?>";
            window.location = url+"/patients/doctoroo_patients";
        });  
    
    </script>

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
    <script>
        $(document).ready(function(){
            $enc_patient_id = $("#enc_patient_id").val();

            $('#tab_patient_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/details/" + $enc_patient_id;
            });
            $('#tab_medical_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/medical_history/" + $enc_patient_id;
            });
            $('#tab_consultation_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_history/" + $enc_patient_id;
            });
            $('#tab_tools').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
            });
            $('#tab_chat').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/chats/" + $enc_patient_id;
            });
            $('#tab_consultation_guide').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_guide/" + $enc_patient_id;
            });

            $("#affected_area").change(function () {
                var filenames = '';
                for (var i = 0; i < this.files.length; i++) {
                    filenames += '<li>' + this.files[i].name + '</li>';
                }

                $(".filename").html('<ul>' + filenames + '</ul>');
            });

        });
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
                var container_id = $(elem).attr("data-multiupload");


                var id_multiupload_img = "multiupload_img_" + container_id + "_";
                var id_multiupload_img_remove = "multiupload_img_remove" + container_id + "_";
                var id_multiupload_file = id_multiupload_img + "_file";

                var block_multiupload_src = "data-multiupload-src-" + container_id;
                var block_multiupload_holder = "data-multiupload-holder-" + container_id;
                var block_multiupload_fileinputs = "data-multiupload-fileinputs-" + container_id;


                var input_src = $(elem).find("input[data-multiupload-src]");
                $(input_src).removeAttr('data-multiupload-src')
                    .attr(block_multiupload_src, "");


                var block_img_holder = $(elem).find("span[data-multiupload-holder]");
                $(block_img_holder).removeAttr('data-multiupload-holder')
                    .attr(block_multiupload_holder, "");

                var block_fileinputs = $(elem).find("span[data-multiupload-fileinputs]");
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

                    var html = '<div class="upload-photo posrel disinline popup-uploadd" id="' + id_multiupload_img + id + '">' +
                        '<span class="upload-close ">' +
                        '<a href="javascript:void(0)" class="del_image" id="' + id_multiupload_img_remove + id + '" ><i class="fa fa-trash-o"></i></a>' +
                        '</span>' +
                        '<img src="' + img_src + '" height="110px" width="110px">' +
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
             
            var page  = 'patient_details'; 
            var token = $('input[name="_token"]').val();
            var url   ="<?php echo $module_url_path; ?>";
            var patient_id = $('#patient_id').val();
            $.ajax({
               url:url+'/patients/patient_history/view',
               type:'post',
               data:{ page:page, patient_id:patient_id,_token:token},
               success:function(data){
                  //alert(data);
               }
            });

/*            $('.file_download').click(function(){
                var token = $('input[name="_token"]').val();
                var url   ="<?php echo $module_url_path; ?>";
                var patient_id = $('#patient_id').val();
                var entitlement_name =  $(this).attr('entitlement_name')
                $.ajax({
                   url:url+'/patients/patient_history/view',
                   type:'post',
                   data:{ patient_id:patient_id,_token:token,entitlement_name:entitlement_name},
                   success:function(data){
                      //alert(data);
                   }
                });
            });
*/
        });
</script>
<script type="text/javascript">
    var _token = '{{csrf_token()}}';
    $('#btn_download_pdf').click(function(){
        $.ajax({
               url:"{{$module_url_path}}/patients/details/download/{{isset($patient_details[0]['user_id']) ? base64_encode($patient_details[0]['user_id']) : ''}}",
               type:'get',
               success:function(response){
                  if(response!='')
                  {
                    if(response.patient_details.phone_no != "")
                    {
                        var dec_phone_no = key.decrypt(response.patient_details.phone_no).toString();
                        response.patient_details.dec_phone_no = dec_phone_no;
                    }

                    if(response.patient_details.suburb != "")
                    {
                        var dec_suburb = key.decrypt(response.patient_details.suburb).toString();
                        response.patient_details.dec_suburb = dec_suburb;
                    }

                    $.each(response.user_entitlement_arr,function(index,value){
                        if(value.card_no!='')
                        {
                            var dec_card_no = key.decrypt(value.card_no).toString();
                            response.user_entitlement_arr[index].dec_card_no = dec_card_no;   
                        }
                    });

                    $.ajax({
                       url:"{{$module_url_path}}/patients/generate_patient_details_pdf_download",
                       type:'post',
                       data:{'arr_data' : response,'_token' : _token},
                       
                       success:function(response){
                            pdf_url = "{{$module_url_path}}/patients/generate_patient_details_pdf_download";
                            window.open(pdf_url, '_blank');
                       }

                    });
                        
                  }
               }
            });
    });    
</script>

@endsection