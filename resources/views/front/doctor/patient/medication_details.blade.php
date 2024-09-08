@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <!--tab start-->

    <div class="mar300  has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
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

        <!--Medication tab starts here-->
        <div id="medical" class="tab-content medi ">
            <div class="doctor-container">
                <div class="head-medical-pres">
                    <h2 class="center-align">Medication &amp; Prescription</h2>
                   <div class="float-right-button"><span id="btn_edit_medication_details"><a href="javascript:void(0)" class="bluedoc-bg btn-floating center-align white-text circle btn "><i class="fa fa-pencil" aria-hidden="true"></i></a></span>

                    <span id="btn_delete_medication_details" data-id="{{isset($enc_medication_id) ? $enc_medication_id : ''}}">
                        <a href="#confirm_delete_medication_popup" class="bluedoc-bg btn-floating  center-align white-text circle btn "><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </span>
                    

                     <span id="btn_cancel_medication_details" style="display: none;"><a href="javascript:void(0)" class="bluedoc-bg btn-floating bottom-position center-align white-text circle btn "><i class="material-icons">close</i></a></span>
                    <span id="btn_save_medication_details" class=" qusame right rescahnge" style="display: none;"><a href="javascript:void(0)" class="btn cart bluedoc-bg lnht round-corner center-align">Save</a></span>
                   
                    </div> <span class="posleft qusame rescahnge"><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                    <div class="clr"></div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3">
                            <div class="heading-round-box">Medication Details</div>
                            <div class="green-border posrel round-box-content table-img" id="show_medication_details_div">
                                <div class="table-row">
                                    <div class="table-cell">
                                        <div class="row ">
                                            <div class="col  s12 ">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Medication name or active ingredient</strong>
                                                    @php
                                                        $medication_name = !empty($medication_arr_data['medication_name'])?$medication_arr_data['medication_name']:'NA';
                                                    @endphp
                                                    <span id="dec_medication_name"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col  s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Enter use or reason for medication</strong>
                                                    <span id="dec_medication_purpose"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col  s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">How long have you been taking it?</strong>
                                                    <span id="dec_medication_duration"></span>
                                                </label>
                                            </div>
                                        </div>
                                            <!-- <div class="row ">
                                                <div class="col  s12 martp">
                                                    <label class="doc-details">
                                                        <strong class="grey-text">Prescription file</strong>
                                                        @if(isset($medication_arr_data['prescription_file']) && !empty($medication_arr_data['prescription_file']) && File::exists($patient_prescription_public.$medication_arr_data['prescription_file']))
                                                                <a href="{{ $patient_prescription.$medication_arr_data['prescription_file'] }}" target="_blank" class="circle btn-floating bluedoc-bg z-depth-1 view_prescription_file"><i class="material-icons">remove_red_eye</i></a>
                                                        @else
                                                            NA
                                                        @endif
                                                    </label>
                                                </div>
                                            </div> -->
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>

                            <div class="green-border round-box-content table-img" id="edit_medication_details_div" style="display: none;">
                                <div class="table-row">
                                   <div class="table-cell">
                                     <div class="margin-full">
                                       <div class="input-field text-bx lessmar input-padding-25px">
                                        @php
                                            $medication_name = !empty($medication_arr_data['medication_name'])?$medication_arr_data['medication_name']:'NA';
                                        @endphp
                                        <input type="text" id="txt_medication_name" name="txt_medication_name" class="validate" value="{{ $medication_name }}" />
                                        <label for="txt_medication_name" class="grey-text truncate">Enter medication name or active ingredient</label>
                                        <div class="err" id="err_txt_medication_name" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="margin-full"><div class="input-field  text-bx lessmar input-padding-25px">
                                        <input type="text" id="txt_medication_reason" name="txt_medication_reason" class="validate" value="{{ !empty($medication_arr_data['medication_purpose'])?$medication_arr_data['medication_purpose']:'NA' }}">
                                        <label for="txt_medication_reason" class="grey-text truncate">Enter use or reason for medication</label>
                                        <div class="err" id="err_txt_medication_reason" style="display:none;"></div>
                                    </div></div>
                                    <div class="margin-full"><div class="input-field  text-bx lessmar input-padding-25px">
                                        <input type="text" id="txt_medication_duration" name="txt_medication_duration" class="validate" value="{{ !empty($medication_arr_data['medication_duration'])?$medication_arr_data['medication_duration']:'NA' }}">
                                        <label for="txt_medication_duration" class="grey-text truncate">How long has this medication been taken?</label>
                                        <div class="err" id="err_txt_medication_duration" style="display:none;"></div>
                                    </div></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3">
                            <div class="heading-round-box">Recognisable Photo</div>
                            <div class="green-border posrel round-box-content table-img center-align">
                                
                                <div class="table-row" id="show_medication_photos_div">
                                    <div class="table-cell">
                                        @if(isset($medication_arr_data['medication_img']) && !empty($medication_arr_data['medication_img']))
                                            @foreach($medication_arr_data['medication_img'] as $med_img)
                                                
                                                @php
                                                    if ( isset($med_img['file']) && !empty($med_img['file']) )
                                                    {
                                                        $medication_image = $medication_path.$med_img['file'];
                                                        // check if image exists or not
                                                        if ( File::exists($medication_image) ) 
                                                        {
                                                            $medication_image = $medication_path."default.png";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $medication_image = $medication_path."default.png";
                                                    }
                                                @endphp

                                                <span class="disinline" id="display_medication_image_{{ $med_img['id'] }}"> <img src="{{ $medication_image }}" class="uploadImg circle" /></span>
                                            @endforeach
                                        @else
                                            <span class="disinline"> <img src="{{ $medication_path.'default.png' }}" class="uploadImg circle" />
                                            <p>Please upload any image of Medication</p></span>
                                        @endif
                                    </div>
                                </div>


                                <div class="table-cell" id="edit_medication_photos_div" style="display: none;">
                                    @php $medication_img_flag = "No"; @endphp
                                    @if(isset($medication_arr_data['medication_img']) && !empty($medication_arr_data['medication_img']))
                                            @foreach($medication_arr_data['medication_img'] as $med_img)
                                                
                                                @php
                                                    if ( isset($med_img['file']) && !empty($med_img['file']) )
                                                    {
                                                        $medication_image = $medication_path.$med_img['file'];
                                                        // check if image exists or not
                                                        if ( File::exists($medication_image) ) 
                                                        {
                                                            $medication_image = $medication_path."default.png";
                                                        }
                                                        else
                                                        {
                                                            $medication_img_flag = "Yes";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $medication_image = $medication_path."default.png";
                                                        $medication_img_flag = "No";
                                                    }
                                                @endphp

                                                <span id="medication_img_span_{{ $med_img['id'] }}">
                                                    <span class="disinline posrel"> <img src="{{ $medication_image }}" class="uploadImg circle" /> <a href="javascript:void(0);" class="del_image" data-img_id="{{ $med_img['id'] }}"><i class="material-icons">delete</i></a></span>
                                                    
                                                </span>
                                            @endforeach
                                        @endif

                                    <span class="disinline">
                                        <span class="input-field uploadImgnew">
                                            <div class="file-field input-field">
                                                <span class="bluedoc-bg btn-floating center-align white-text circle">
                                                    <span class="icon-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <input type="file" id="medication_img_upload" name="medication_img_upload" multiple>
                                                    <input type="hidden" id="medication_img_exist" name="medication_img_exist" value="{{ $medication_img_flag }}">
                                                </span>
                                            </div>
                                            <span class="clr"></span>
                                            <span class="icon-label">Upload New</span>
                                            <div class="err" id="err_medication_image_upload" style="display:none;"></div>
                                            @if(Session::has('medication_image_upload_error'))
                                                <div class="err error_msg">{{ Session::get('medication_image_upload_error') }}</div>
                                            @endif
                                        </span> 
                                    </span>
                                </div>


                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="head-medical-pres">
                            <h2 class="center-align">Digital Prescription</h2>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                        <div class="round-box z-depth-3">
                            <div class="blue-border-block-top"></div>
                            <div class="round-box-content blue-border">
                                <div>
                                    
                                    
                                    <div class="row posrel hide-on-med-and-down row-spacing-right-btm">
                                        <div class="col l2 m6 s12 ">Prescription</div>
                                        <div class="col l2 m6 s6">Repeats</div>
                                        <div class="col l2 m6 s6">Directions</div>
                                        <div class="col l3 m6 s6 valign-wrapper">Hardcopy Location <a class="tooltipped grey-text" data-position="bottom" data-delay="0" data-tooltip="Hardcopy location"><i class="material-icons">help_outline</i></a></div>
                                        <div class="col l3 m6 s6 valign-wrapper">Pharmacy <a class="tooltipped grey-text" data-position="bottom" data-delay="30" data-tooltip="Pharmacy"><i class="material-icons">help_outline</i></a></div>
                                    </div>
                                    
                                    @if(isset($prescription_arr_data) && !empty($prescription_arr_data))
                                        <div class="table_present" id="prescription_table">
                                            @foreach($prescription_arr_data as $key => $pre_data)
                                            @php
                                                // dump($prescription_arr_data);
                                                $pres_id      = !empty($pre_data['id'])?$pre_data['id']:'';
                                                $pres_date    = !empty($pre_data['prescription_date'])?$pre_data['prescription_date']:'';
                                                $pres_repeats = !empty($pre_data['repeats'])?$pre_data['repeats']:'';
                                                $pres_directions = !empty($pre_data['directions'])?$pre_data['directions']:'';
                                                $pres_hardcopy_location = !empty($pre_data['hardcopy_location'])?$pre_data['hardcopy_location']:'';
                                                $pres_pharmacy_name = !empty($pre_data['pharmacy_list']['company_name'])?$pre_data['pharmacy_list']['company_name']:'';
                                                $pres_pharmacy_id = !empty($pre_data['pharmacy_id'])?$pre_data['pharmacy_id']:'';
                                            @endphp
                                            <div class="row posrel row-spacing-right-btm">
                                                <div class="col l2 m12 s12  presi">
                                                    @if(isset($pre_data['uploaded_file']) && !empty($pre_data['uploaded_file']) && File::exists($prescription_base_path.$pre_data['uploaded_file']))
                                                        <a href="" class=" valign-wrapper doc_show_{{$key}}" download=""><img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="imageicon" />
                                                            <span class="truncate ">
                                                                <span class="green-text">Prescription</span>
                                                                <small class="truncate bluedoc-text">{{ date("d/m/Y", strtotime($pres_date)) }}</small>
                                                             </span>
                                                        </a>
                                                    @else
                                                    <a href="" class=" valign-wrapper" title="No file found">
                                                        <img src="{{ url('/') }}/public/doctor_section/images/rx-certi.png" class="imageicon" />
                                                        <span class="truncate ">
                                                                <span class="green-text">Prescription</span>
                                                                <small class="truncate bluedoc-text">{{ date("d/m/Y", strtotime($pres_date)) }}</small>
                                                        </span>
                                                    </a>                                                    
                                                    @endif                                                    
                                                </div>
                                                <div class="col l2 m3 s12">
                                                    <div class="cent-verticle valign-wrapper" id="dec_repeats_{{$key}}">
                                                        <!-- {{ $pres_repeats }} -->
                                                    </div>
                                                </div>
                                                @php $directions = isset($pres_directions) ? $pres_directions : '' @endphp
                                                <div class="col l2 m3 s12">
                                                    <div class="directionMessage" >
                                                        <!-- <span>{{ substr($directions,0,14) }}</span> @if( !empty(substr($directions,14)) ) <span class="more-content">{{ substr($directions,14) }}</span><a class="expand-more-btn green-text"> <i class="material-icons">keyboard_arrow_right</i> </a><a class="close-more-btn green-text"><i class="material-icons">keyboard_arrow_left</i> </a> @endif -->

                                                        <span id="dec_directions_{{$key}}"><!-- {{ substr($directions,0,14) }} --></span>
                                                    </div>
                                                </div>
                                                <div class="col l3 m3 s12">
                                                    <div class="cent-verticle valign-wrapper" id="dec_pres_hardcopy_location_{{$key}}">
                                                        <!-- {{ $pres_hardcopy_location }} -->
                                                    </div>
                                                </div>
                                                <div class="col l3 m3 s12">
                                                    <div class="cent-verticle valign-wrapper">
                                                        {{ $pres_pharmacy_name }}
                                                    </div>
                                                </div>
                                                <div class="posrel right-align btndot"><a data-activates="dropdown{{ $pre_data['id'] }}" class="dropdown-button green-text"><i class="material-icons">&#xE5D4;</i></a>
                                                    <ul id="dropdown{{ $pre_data['id'] }}" class='dropdown-content doc-rop table-drop'>
                                                        <input type="hidden" class="old_pres_uploaded_file" value="{{isset($pre_data['uploaded_file']) ? $pre_data['uploaded_file'] : ''}}">
                                                        <li><a href="javascript:void(0);" class="edit_prescription_values" id="edit_prescriptio" data-id="{{ $pre_data['id'] }}" data-repeats="{{ $pres_repeats }}" data-directions="{{ $pres_directions }}" data-hardcopy_location="{{ $pres_hardcopy_location }}" data-pharmacy_name="{{ $pres_pharmacy_name }}" data-pharmacy_id="{{ $pres_pharmacy_id }}" data-uploaded_file="{{ $pre_data['uploaded_file'] }}" >Edit</a></li>
                                                        <li><a href="#confirm_delete_prescription_popup" class="delete_prescription_btn" data-id="{{isset($pre_data['id']) ? $pre_data['id'] : '' }}">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                var dumpSessionId = "{{ isset($medication_arr_data['userinfo']['dump_session'])?$medication_arr_data['userinfo']['dump_session']:'' }}";
                                                var dumpId        = "{{ isset($medication_arr_data['userinfo']['dump_id'])?$medication_arr_data['userinfo']['dump_id']:'' }}";
                                                var VIRGIL_TOKEN  = "{{env('VIRGIL_TOKEN')}}";
                                                var api           = virgil.API(VIRGIL_TOKEN);
                                                var key           = api.keys.import(dumpSessionId);
                                                var innerkey      = '{{$key}}';
                                                
                                                var repeats                 = '{{ $pres_repeats }}';
                                                var directions              = '{{ $pres_directions }}';
                                                var pres_hardcopy_location  = '{{ $pres_hardcopy_location }}';

                                                if(repeats!='')
                                                {
                                                    var dec_repeats = decrypt(api, repeats, key);
                                                    $('#dec_repeats_'+innerkey).html(dec_repeats);
                                                }

                                                if(directions!='')
                                                {
                                                    var dec_directions = decrypt(api, directions, key);
                                                    $('#dec_directions_'+innerkey).html(dec_directions);
                                                }

                                                if(pres_hardcopy_location!='')
                                                {
                                                    var dec_pres_hardcopy_location = decrypt(api, pres_hardcopy_location, key);
                                                    $('#dec_pres_hardcopy_location_'+innerkey).html(dec_pres_hardcopy_location);
                                                }
                                                    
                                                var image_file = '{{ $prescription_path.$pre_data["uploaded_file"] }}';
                                                if(image_file!='')
                                                {
                                                    var image_file_filename      = '{{ $pre_data["uploaded_file"] }}';
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
                                                            $(".doc_show_"+innerkey).attr('href',imageUrl);
                                                            $(".doc_show_"+innerkey).attr('download',image_file_filename);
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

                                        </div>
                                    @else
                                    <!-- <div style="text-align: center; font-size: 18px; font-weight: bold; color: #184059;">No Prescription Found</div> -->
                                    @endif

                                    <button id="btn_add_digital_prescription" class="border-btn cart round-corner center-align margin-btm truncate"><span class="font-size-16px">+</span> Add a New Prescription</button>

                                    <div id="digital_prescription_add_form" class="add_digital_prescription" style="display: none;">
                                    <form method="POST" id="add_prescription_details" name="add_prescription_details" action="{{ url('/') }}/doctor/patients/prescription/add" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                        <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
                                        <input type="hidden" id="medical_general_id" name="medical_general_id" value="{{ $enc_medication_id }}">

                                        <div class="row posrel marbtm  row-spacing-right-btm">
                                            <div class="col l2 m12 s12  presi">
                                                <!-- icon with text to use -->
                                                <div class="input-field ">
                                                    <div class="file-field input-field">
                                                        <div class="btn file-btn-new bluedoc-bg circle">
                                                            <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
                                                            <input type="file" name="txt_uploaded_file" id="txt_uploaded_file">
                                                        </div>
                                                        <div class="file-path-wrapper new-file-path">
                                                            <input class="file-path validate" type="text" placeholder="Upload photo/scan of prescription">
                                                        </div>
                                                    </div>
                                                    <div class="clr"></div>
                                                </div>
                                                <!-- icon with text to use -->
                                                <div class="err" id="err_txt_uploaded_file" style="display:none;"></div>
                                                @if(Session::has('upload_file_error'))
                                                    <div class="err error_msg">{{ Session::get('upload_file_error') }}</div>
                                                @endif
                                            </div>
                                            <div class="col l2 m3 s12">
                                                <div class="input-field padno selct bluedoc-text doc input-padding-25px" >
                                                    <select id="cmb_repeats" name="cmb_repeats">
                                                        <option value="">Select</option>
                                                        <option value="2 Repeats">2 Repeats</option>
                                                        <option value="3 Repeats">3 Repeats</option>
                                                        <option value="5 Repeats">5 Repeats</option>
                                                        <option value="8 Repeats">8 Repeats</option>
                                                    </select>
                                                    <div class="err" id="err_cmb_repeats" style="display:none;"></div>
                                                </div>
                                            </div>
                                            <div class="col l2 m3 s12">
                                                <div class="truncate">
                                                    <div class="input-field input-padding-25px">
                                                        <textarea id="txt_direction" name="txt_direction" class="materialize-textarea enter-direction" placeholder="Enter Directions"></textarea>
                                                        <div class="err" id="err_txt_direction" style="display:none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col l3 m3 s12">
                                                <div class="input-field padno selct doc grey-text input-padding-25px">
                                                    <select id="cmb_hardcopy_location" name="cmb_hardcopy_location">
                                                        <option value="">Select Location</option>
                                                        <option value="With Pharmacy">With Pharmacy</option>
                                                        <option value="With Doctor">With Doctor</option>
                                                        <option value="With Patient">With Patient</option>
                                                    </select>
                                                    <div class="err" id="err_cmb_hardcopy_location" style="display:none;"></div>
                                                </div>
                                            </div>
                                            <div class="col l3 m3 s12">
                                                <div class="input-field padno selct doc grey-text input-padding-25px">
                                                    <select id="cmb_pharmacy_id" name="cmb_pharmacy_id">
                                                        <option value="">Select</option>
                                                        @if(isset($pharmacy_data) && !empty($pharmacy_data))
                                                            @foreach($pharmacy_data as $ph_data)
                                                                <option value="{{ $ph_data['id'] }}">{{ $ph_data['company_name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="err" id="err_cmb_pharmacy_id" style="display:none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="center-align">
                                            <button type="button" id="btn_save_prescription_details" name="btn_save_prescription_details" class="btn bluedoc-bg round-corner  center-align truncate lnht40px"> Save &amp; Add</button>

                                            <a href="javascript:void(0)" id="btn_cancel_prescription_details" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                        </div>
                                    </form>
                                    </div>

                                    <div id="digital_prescription_edit_form" class="edit_digital_prescription" style="display: none;">
                                        <input type="hidden" id="prescription_id" name="prescription_id" value="">
                                        <input type="hidden" id="old_pres_uploaded_file">

                                        <div class="row posrel marbtm row-spacing-right-btm">
                                            <div class="col l2 m12 s12 valign-wrapper presi">

                                                <!-- icon with text to use -->
                                                <div class="input-field ">
                                                    <div class="file-field input-field">
                                                        <div class="bluedoc-bg btn-floating center-align white-text circle">
                                                            <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
                                                            <input type="file" name="edit_pres_uploaded_file" id="edit_pres_uploaded_file">
                                                        </div>
                                                        <div class="file-path-wrapper new-file-path">
                                                            <input class="file-path validate" id="txt_filename" type="text" placeholder="Upload photo/scan of prescription">
                                                        </div>
                                                    </div>
                                                    <div class="clr"></div>
                                                </div>
                                                <!-- icon with text to use -->

                                                <div class="err" id="err_edit_pres_uploaded_file" style="display:none;"></div>
                                                @if(Session::has('upload_file_error'))
                                                    <div class="err error_msg">{{ Session::get('upload_file_error') }}</div>
                                                @endif
                                            </div>
                                            <div class="col l2 m3 s12">
                                                <div class="input-field padno selct bluedoc-text doc">
                                                    <select id="edit_cmb_repeats" name="edit_cmb_repeats">
                                                        <option value="">Select</option>
                                                        <option value="2 Repeats">2 Repeats</option>
                                                        <option value="3 Repeats">3 Repeats</option>
                                                        <option value="5 Repeats">5 Repeats</option>
                                                        <option value="8 Repeats">8 Repeats</option>
                                                    </select>
                                                    <div class="err" id="err_edit_cmb_repeats" style="display:none;"></div>
                                                </div>
                                            </div>
                                            <div class="col l2 m3 s12">
                                                <div class="truncate">
                                                    <div class="input-field">
                                                        <textarea id="edit_txt_direction" name="edit_txt_direction" class="materialize-textarea enter-direction" placeholder="Enter Directions"></textarea>
                                                        <div class="err" id="err_edit_txt_direction" style="display:none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col l3 m3 s12">
                                                <div class="input-field padno selct doc grey-text">
                                                    <select id="edit_cmb_hardcopy_location" name="edit_cmb_hardcopy_location">
                                                        <option value="">Select Location</option>
                                                        <option value="With Pharmacy">With Pharmacy</option>
                                                        <option value="With Doctor">With Doctor</option>
                                                        <option value="With Patient">With Patient</option>
                                                    </select>
                                                    <div class="err" id="err_edit_cmb_hardcopy_location" style="display:none;"></div>
                                                </div>
                                            </div>
                                            <div class="col l3 m3 s12">
                                                <div class="input-field padno selct doc grey-text">
                                                    <select id="edit_cmb_pharmacy_id" name="edit_cmb_pharmacy_id">
                                                        <option value="">Select</option>
                                                        @if(isset($pharmacy_data) && !empty($pharmacy_data))
                                                            @foreach($pharmacy_data as $ph_data)
                                                                <option value="{{ $ph_data['id'] }}">{{ $ph_data['company_name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="err" id="err_edit_cmb_pharmacy_id" style="display:none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="center-align">
                                            <a href="javascript:void(0);" id="btn_update_prescription_details" class="btn bluedoc-bg round-corner center-align truncate"> Update</a>

                                            <a href="javascript:void(0)" id="btn_cancel_update_prescription_details" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Medication tab ends here-->
    </div>

    <input type="hidden" class="response_msg" id="response_msg" name="response_msg" value="{{ Session::get('message') }}" />
    
    <a class="open_response_popup" href="#show_response_msg"></a>
    <div id="show_response_msg" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p class="center-align">{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <div id="confirm_delete_medication_popup" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="center-align">Are you sure you want to delete this medication?</div>
                    <input type="hidden" id="delete_medication_id">
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" id="btn_confirm_delete_medication" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>
    <a href="#confirm_delete_medication_status_popup" id="confirm_delete_medication_status_popup_link" style="display: none">Open</a>
    <div id="confirm_delete_medication_status_popup" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="center-align" id="delete_medication_status"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" id="btn_confirm_delete_medication" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <div id="confirm_delete_prescription_popup" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="center-align">Are you sure you want to delete this digital prescription?</div>
                    <input type="hidden" id="delete_prescription_id">
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" id="btn_confirm_delete_prescription" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <a class="open_confirm_delete_img_popup" href="#confirm_img_delete_msg"></a>
    <div id="confirm_img_delete_msg" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p>Are You Sure? You want to Delete this image!</p>
                    <input type="hidden" id="delete_image_id" name="delete_image_id" />
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="confirmed_delete_img" class="modal-close waves-effect waves-green btn-cancel-cons">Confirm</a>
            <a href="javascript:void(0)" id="cancel_delete_img" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
        </div>
    </div>

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
    <input type="hidden" id="medical_general_id" name="medical_general_id" value="{{ $medication_arr_data['id'] }}">
    <script>
        $(document).ready(function(){
          var PrescformData    = new FormData();
          var editformData     = new FormData();

          var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
          var dumpSessionId = "{{ isset($medication_arr_data['userinfo']['dump_session'])?$medication_arr_data['userinfo']['dump_session']:'' }}";
          var dumpId        = "{{ isset($medication_arr_data['userinfo']['dump_id'])?$medication_arr_data['userinfo']['dump_id']:'' }}";
          var api           = virgil.API(virgilToken);
          var key           = api.keys.import(dumpSessionId);
              
              decryptMyData(virgilToken);
              
              function decryptMyData()
              {
                  var medication_name       = "{{isset($medication_arr_data['medication_name'])?$medication_arr_data['medication_name']:''}}";
                  var medication_purpose    = "{{isset($medication_arr_data['medication_purpose'])?$medication_arr_data['medication_purpose']:''}}";
                  var medication_duration   = "{{isset($medication_arr_data['medication_duration'])?$medication_arr_data['medication_duration']:''}}";


                  var txtmedication_name = decrypt(api, medication_name, key);
                  var txtmedication_purpose = decrypt(api, medication_purpose, key);
                  var txtmedication_duration = decrypt(api, medication_duration, key);

                  if(medication_name!='')
                  {
                    var medication_name = decrypt(api, medication_name, key);
                    $('#dec_medication_name').html(medication_name);
                    $('#txt_medication_name').val(medication_name);
                  }

                  if(medication_purpose!='')
                  {
                    var medication_purpose = decrypt(api, medication_purpose, key);
                    $('#dec_medication_purpose').html(medication_purpose);
                    $('#txt_medication_reason').val(medication_purpose);
                  }

                  if(medication_duration!='')
                  {
                    var medication_duration = decrypt(api, medication_duration, key);
                    $('#dec_medication_duration').html(medication_duration);
                    $('#txt_medication_duration').val(medication_duration);
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

            var medical_general_id  = $("#medical_general_id").val();
            $enc_patient_id         = $("#enc_patient_id").val();

            setTimeout(function() {
                $('.error_msg').hide();
            }, 8000);

            var response_msg = $('#response_msg').val();
            if(response_msg != '')
            {
                $(".open_response_popup").click();
            }

            $('#reload_page').click(function(){
                window.location.reload();
            });

            $(".expand-more-btn").on("click", function () {
                $(this).parent(".directionMessage").addClass("active");
            });
            $(".close-more-btn").on("click", function () {
                $(this).parent(".directionMessage").removeClass("active");
            });

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

            var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];
            $('#txt_uploaded_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_txt_uploaded_file').show();
                    $('#txt_uploaded_file').focus();
                    $('#err_txt_uploaded_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_txt_uploaded_file').fadeOut(4000);
                    $("#txt_uploaded_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_txt_uploaded_file').show();
                    $('#txt_uploaded_file').focus();
                    $('#err_txt_uploaded_file').html('Max size allowed is 5mb.');
                    $('#err_txt_uploaded_file').fadeOut(4000);
                    $("#txt_uploaded_file").val('');
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
                        PrescformData.append('txt_uploaded_file',enc_file,filename);
                    });
                  }                

            });

            $('#btn_save_prescription_details').click(function(){
                var uploaded_file       = $('#txt_uploaded_file').val();
                var repeats             = $('#cmb_repeats').val();
                var direction           = $('#txt_direction').val();
                var hardcopy_location   = $('#cmb_hardcopy_location').val();
                var pharmacy_id         = $('#cmb_pharmacy_id').val();
                var medical_general_id  = $("#medical_general_id").val();
                var enc_patient_id      = $("#enc_patient_id").val();

                if(uploaded_file == '')
                {
                    $('#err_txt_uploaded_file').show();
                    $('#err_txt_uploaded_file').html('Please select file to upload.');
                    $('#err_txt_uploaded_file').fadeOut(4000);
                    $('#txt_uploaded_file').focus();
                    return false;
                }
                else if(repeats == '')
                {
                    $('#err_cmb_repeats').show();
                    $('#err_cmb_repeats').html('Please select Repeats.');
                    $('#err_cmb_repeats').fadeOut(4000);
                    $('#cmb_repeats').focus();
                    return false;
                }
                else if(direction == '')
                {
                    $('#err_txt_direction').show();
                    $('#err_txt_direction').html('Please enter Direction.');
                    $('#err_txt_direction').fadeOut(4000);
                    $('#txt_direction').focus();
                    return false;
                }
                else if(hardcopy_location == '')
                {
                    $('#err_cmb_hardcopy_location').show();
                    $('#err_cmb_hardcopy_location').html('Please select Hardcopy Location.');
                    $('#err_cmb_hardcopy_location').fadeOut(4000);
                    $('#cmb_hardcopy_location').focus();
                    return false;
                }
                else if(pharmacy_id == '')
                {
                    $('#err_cmb_pharmacy_id').show();
                    $('#err_cmb_pharmacy_id').html('Please select Pharmacy.');
                    $('#err_cmb_pharmacy_id').fadeOut(4000);
                    $('#cmb_pharmacy_id').focus();
                    return false;
                }
                else
                {
                    var token            = "<?php echo csrf_token(); ?>";

                    PrescformData.append("_token", token);
                    PrescformData.append("cmb_pharmacy_id", pharmacy_id);
                    PrescformData.append("medical_general_id", medical_general_id);
                    PrescformData.append("enc_patient_id", enc_patient_id);

                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        
                        if(repeats!='')
                        {
                            var txtrepeats = encrypt(api, repeats, cards);
                            PrescformData.append("cmb_repeats", txtrepeats);
                        }

                        if(direction!='')
                        {
                            var txtdirection = encrypt(api, direction, cards);
                            PrescformData.append("txt_direction", txtdirection);
                        }

                        if(hardcopy_location!='')
                        {
                            var txthardcopy_location = encrypt(api, hardcopy_location, cards);
                            PrescformData.append("cmb_hardcopy_location", txthardcopy_location);
                        }
                        
                        $.ajax({
                           url:'{{ url("/") }}/doctor/patients/prescription/add',
                           type:'POST',
                           dataType:'json',
                           processData: false,
                           contentType: false,
                           cache: false,
                           data: PrescformData,
                           success:function(res){
                              window.location.reload();
                           }
                        });
                      
                      }).then(null, function () {
                          console.log('Something went wrong.');
                      });

                      findkey.catch(function(error) {
                        console.log(error);
                      });
                }
                /*else
                {
                    
                    var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:'{{ url("/") }}/doctor/patients/prescription/add',
                        type:'POST',
                        dataType:'json',
                        data:{_token:token, enc_patient_id:$enc_patient_id, uploaded_file:uploaded_file, title:condition_title, description:condition_description},
                        success:function(res){
                            if(res.status)
                            {
                                $("#add_new_condition .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(res.msg);
                            }
                        }
                    });
                }*/
            });

            /*---show hide add prescription form starts---*/
            $('#btn_add_digital_prescription').click(function(){
                $('#digital_prescription_add_form').show();
                $('#btn_cancel_prescription_details').show();
                $('#digital_prescription_edit_form').hide();
            });
            $('#btn_cancel_prescription_details').click(function(){
                $('#digital_prescription_add_form').hide();
                $('#btn_cancel_prescription_details').hide();
            });
            /*---show hide add prescription form ends---*/

            // edit prescription 
            $('.edit_prescription_values').click(function(){
                var pres_id                 = $(this).data('id');
                var pres_repeats            = $(this).data('repeats');
                var pres_directions         = $(this).data('directions');
                var pres_hardcopy_location  = $(this).data('hardcopy_location');
                var pres_pharmacy_name      = $(this).data('pharmacy_name');
                var pres_pharmacy_id        = $(this).data('pharmacy_id');
                var pres_uploaded_file      = $(this).data('uploaded_file');


                  /*var txtpres_directions = decrypt(api, pres_directions, key);
                  var txtmedication_duration = decrypt(api, medication_duration, key);*/

                  if(pres_repeats!='')
                  {
                    var txtpres_repeats = decrypt(api, pres_repeats, key);
                    $('#edit_cmb_repeats').closest('.col').find('.select-dropdown').val(txtpres_repeats);
                    $('#edit_cmb_repeats').val(txtpres_repeats).attr('selected','selected');
                  }

                  if(pres_directions!='')
                  {
                    var txtpres_directions = decrypt(api, pres_directions, key);
                    $('#edit_txt_direction').val(txtpres_directions);
                  }

                  if(pres_hardcopy_location!='')
                  {
                    var txtpres_hardcopy_location = decrypt(api, pres_hardcopy_location, key);
                    $('#edit_cmb_hardcopy_location').closest('.col').find('.select-dropdown').val(txtpres_hardcopy_location);
                    $('#edit_cmb_hardcopy_location').val(txtpres_hardcopy_location).attr('selected','selected');
                  }

                $('#old_pres_uploaded_file').val($(this).closest('ul').find('.old_pres_uploaded_file').val());
                $('#txt_filename').val(pres_uploaded_file);

                $('#prescription_id').val(pres_id);

                $('#digital_prescription_edit_form').show();
                $('#digital_prescription_add_form').hide();



                

                $('#edit_cmb_pharmacy_id').closest('.col').find('.select-dropdown').val(pres_pharmacy_name);
                $('#edit_cmb_pharmacy_id').val(pres_pharmacy_id).attr('selected','selected');
            });

            $('#btn_cancel_update_prescription_details').click(function(){
                $('#digital_prescription_edit_form').hide();
            });

            
            $('#edit_pres_uploaded_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_edit_pres_uploaded_file').show();
                    $('#edit_pres_uploaded_file').focus();
                    $('#err_edit_pres_uploaded_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_edit_pres_uploaded_file').fadeOut(4000);
                    $("#edit_pres_uploaded_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_edit_pres_uploaded_file').show();
                    $('#edit_pres_uploaded_file').focus();
                    $('#err_edit_pres_uploaded_file').html('Max size allowed is 5mb.');
                    $('#err_edit_pres_uploaded_file').fadeOut(4000);
                    $("#edit_pres_uploaded_file").val('');
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
                        editformData.append('pres_uploaded_file',enc_file,filename);
                    });
                  }       
            });

            //submit update prescription form
            $('#btn_update_prescription_details').click(function(){
                var up_id                   = $('#prescription_id').val();
                var up_repeats              = $('#edit_cmb_repeats').val();
                var up_direction            = $('#edit_txt_direction').val();
                var up_hardcopy_location    = $('#edit_cmb_hardcopy_location').val();
                var up_pharmacy_id          = $('#edit_cmb_pharmacy_id').val();
                var up_pres_uploaded_file   = $('#edit_pres_uploaded_file').val();
                var old_pres_uploaded_file  = $('#old_pres_uploaded_file').val();


                if(up_repeats == '')
                {
                    $('#err_edit_cmb_repeats').show();
                    $('#edit_cmb_repeats').focus();
                    $('#err_edit_cmb_repeats').html("Please select Repeats");
                    $('#err_edit_cmb_repeats').fadeOut(8000);
                }
                else if(up_direction == '')
                {
                    $('#err_edit_txt_direction').show();
                    $('#edit_txt_direction').focus();
                    $('#err_edit_txt_direction').html("Please enter direction");
                    $('#err_edit_txt_direction').fadeOut(8000);
                }
                else if(up_hardcopy_location == '')
                {
                    $('#err_edit_cmb_hardcopy_location').show();
                    $('#edit_cmb_hardcopy_location').focus();
                    $('#err_edit_cmb_hardcopy_location').html("Please select Hardcopy Location");
                    $('#err_edit_cmb_hardcopy_location').fadeOut(8000);
                }
                else if(up_pharmacy_id == '')
                {
                    $('#err_edit_cmb_pharmacy_id').show();
                    $('#edit_cmb_pharmacy_id').focus();
                    $('#err_edit_cmb_pharmacy_id').html("Please select Pharmacy");
                    $('#err_edit_cmb_pharmacy_id').fadeOut(8000);
                }
                else
                {
                    var token            = "<?php echo csrf_token(); ?>";

                    var findkey   = api.cards.get(dumpId).then(function (cards) {

                    editformData.append("_token", token);
                    editformData.append("id", up_id);
                    editformData.append("pharmacy_id", up_pharmacy_id);
                    editformData.append("enc_patient_id", $enc_patient_id);
                    editformData.append("old_pres_uploaded_file", old_pres_uploaded_file);
                    
                    if(up_repeats!='')
                    {
                        var txtup_repeats = encrypt(api, up_repeats, cards);
                        editformData.append("repeats", txtup_repeats);
                    }

                    if(up_direction!='')
                    {
                        var txtdirection = encrypt(api, up_direction, cards);
                        editformData.append("direction", txtdirection);
                    }

                    if(up_hardcopy_location!='')
                    {
                        var txthardcopy_location = encrypt(api, up_hardcopy_location, cards);
                        editformData.append("hardcopy_location", txthardcopy_location);
                    }
                    
                    $.ajax({
                       url:'{{ url("/") }}/doctor/patients/prescription/edit',
                       type:'POST',
                       dataType:'json',
                       processData: false,
                       contentType: false,
                       cache: false,
                       data: editformData,
                       success:function(res){
                          $(".open_response_popup").click();
                          $('.flash_msg_text').html(res.msg);
                       }
                    });
                  
                  }).then(null, function () {
                      console.log('Something went wrong.');
                  });

                  findkey.catch(function(error) {
                    console.log(error);
                  });                    

/*                    $.ajax({
                       url:'{{ url("/") }}/doctor/patients/prescription/edit',
                       type:'POST',
                       dataType:'json',
                       processData: false,
                       contentType: false,
                       cache: false,
                       data: editformData,
                       success:function(res){
                          if(res.status)
                          {
                            $(".open_response_popup").click();
                            $('.flash_msg_text').html(res.msg);
                          }
                       }
                    });*/
                }
            });

            if($('#prescription_table').hasClass('table_present'))
            {
                $('#digital_prescription_add_form').hide();
                $('#btn_cancel_prescription_details').hide();
            }
            else
            {
                $('#digital_prescription_add_form').show();
                $('#btn_cancel_prescription_details').hide();
                $('#btn_add_digital_prescription').hide();
            }

            var imageExtension = ['jpg','jpeg','png','gif','bmp'];
            $('#medication_img_upload').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), imageExtension) == -1) {
                    $('#err_medication_image_upload').show();
                    $('#medication_image_upload').focus();
                    $('#err_medication_image_upload').html("Please upload valid image with valid extension i.e "+imageExtension.join(', '));
                    $('#err_medication_image_upload').fadeOut(8000);
                    $("#medication_image_upload").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    alert('Max size allowed is 5mb');
                    $('#err_medication_image_upload').show();
                    $('#medication_image_upload').focus();
                    $('#err_medication_image_upload').html('Max size allowed is 5mb.');
                    $('#err_medication_image_upload').fadeOut(8000);
                    $("#medication_image_upload").val('');
                    return false;
                }
            });

            $('.del_image').click(function(){
                var img_id = $(this).data('img_id');

                if(img_id == '')
                {
                    $(".open_popup").click();
                    $('.flash_msg_text').html("Error!! Something went wrong.");
                }
                else
                {
                    $('#delete_image_id').val(img_id);
                    $(".open_confirm_delete_img_popup").click();
                }
            });

            $('#confirmed_delete_img').click(function(){
                var img_id = $('#delete_image_id').val();

                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                   url:'{{ url("/") }}/doctor/patients/medication_image/delete',
                   type:'POST',
                   dataType:'json',
                   data:{_token:token, img_id:img_id },
                   success:function(res){
                      if(res.status == "success")
                      {
                        $('#medication_img_span_'+res.msg).remove();
                        $('#display_medication_image_'+res.msg).remove();
                      }
                   }
                });
            });

            // hide and show medication details for edit and display starts
            $('#btn_edit_medication_details').click(function(){
                $('#show_medication_details_div').hide();
                $('#edit_medication_details_div').show();

                $('#show_medication_photos_div').hide();
                $('#edit_medication_photos_div').show();

                $('#btn_cancel_medication_details').show();
                $('#btn_save_medication_details').show();

                $('#btn_edit_medication_details').hide();
            });
            $('#btn_cancel_medication_details').click(function(){
                $('#show_medication_details_div').show();
                $('#edit_medication_details_div').hide();

                $('#show_medication_photos_div').show();
                $('#edit_medication_photos_div').hide();

                $('#btn_cancel_medication_details').hide();
                $('#btn_save_medication_details').hide();

                $('#btn_edit_medication_details').show();
            });
            $('#btn_save_medication_details').click(function(){
                var name            = $('#txt_medication_name').val();
                var reason          = $('#txt_medication_reason').val();
                var duration        = $('#txt_medication_duration').val();
                var medication_img  = $('#medication_img_upload').val();

                if(name == '')
                {
                    $('#err_txt_medication_name').show();
                    $('#err_txt_medication_name').html('Please select medication name');
                    $('#err_txt_medication_name').fadeOut(8000);
                    $('#txt_medication_name').focus();
                    return false;
                }
                else if(reason == '')
                {
                    $('#err_txt_medication_reason').show();
                    $('#err_txt_medication_reason').html('Please select medication reason');
                    $('#err_txt_medication_reason').fadeOut(8000);
                    $('#txt_medication_reason').focus();
                    return false;
                }
                else if(duration == '')
                {
                    $('#err_txt_medication_duration').show();
                    $('#err_txt_medication_duration').html('Please select medication duration');
                    $('#err_txt_medication_duration').fadeOut(8000);
                    $('#txt_medication_duration').focus();
                    return false;
                }
                /*else if(medication_img == '')
                {
                    $('#err_medication_image_upload').show();
                    $('#err_medication_image_upload').html('Please select any image');
                    $('#err_medication_image_upload').fadeOut(8000);
                    $('#medication_img_upload').focus();
                    return false;
                }*/
                else
                {
                    var token       = "<?php echo csrf_token(); ?>";
                    var formData    = new FormData();

                    formData.append("_token", token);
                    if(medication_img != '')
                    {
                        formData.append( 'med_img', $( '#medication_img_upload' )[0].files[0] );
                    }

                      var findkey   = api.cards.get(dumpId).then(function (cards) {

                        var txtname     = encrypt(api, name, cards);
                        var txtreason   = encrypt(api, reason, cards);
                        var txtduration = encrypt(api, duration, cards);
                        
                        formData.append("name", txtname);
                        formData.append("reason", txtreason);
                        formData.append("duration", txtduration);
                        formData.append("enc_patient_id", $enc_patient_id);
                        formData.append("medical_general_id", medical_general_id);

                        $.ajax({
                           url:'{{ url("/") }}/doctor/patients/medication_details/edit',
                           type:'POST',
                           dataType:'json',
                           processData: false,
                           contentType: false,
                           cache: false,
                           data: formData,
                           success:function(res){
                              if(res.status)
                              {

                                $(".open_response_popup").click();
                                $('.flash_msg_text').html(res.msg);

                                $('#txt_medication_name').val();
                                $('#txt_medication_reason').val();
                                
                                $('#show_medication_details_div').show();
                                $('#edit_medication_details_div').hide();

                                $('#show_medication_photos_div').show();
                                $('#edit_medication_photos_div').hide();

                                $('#btn_cancel_medication_details').hide();
                                $('#btn_save_medication_details').hide();

                                $('#btn_edit_medication_details').show();
                              }
                           }
                        });

                      }).then(null, function () {
                          console.log('Something went wrong.');
                      });

                      findkey.catch(function(error) {
                        console.log(error);
                      });                    

                }
            });
            // hide and show medication details for edit and display ends

            $('#btn_delete_medication_details').click(function(){
               $('#delete_medication_id').val($(this).attr('data-id'));
            });

            $('#btn_confirm_delete_medication').click(function(){
                var id =   $('#delete_medication_id').val();
                $.ajax({
                    url:'{{ url("/") }}/doctor/patients/medication_details/delete',
                    type:'get',
                    data:{id:id},
                    success:function(data){
                        $("#confirm_delete_medication_status_popup_link").click();
                        $('#delete_medication_status').html(data.msg);
                    }
               });
            });

            $('#confirm_delete_medication_status_popup .modal-close').click(function(){
                    var enc_patient_id = $('#enc_patient_id').val();
                    window.location = '{{ url("/") }}/doctor/patients/medical_history/'+enc_patient_id;
            });

            $('.delete_prescription_btn').click(function(){
                    $('#delete_prescription_id').val($(this).attr('data-id'));
            
            });
            $('#btn_confirm_delete_prescription').click(function(){
                    var id = $('#delete_prescription_id').val();

                    $.ajax({
                        url:'{{ url("/") }}/doctor/patients/prescription/delete',
                        type:'get',
                        data:{id:id},
                        success:function(data){
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                        }
                    });

            
            });

        });
    
    </script>


@endsection