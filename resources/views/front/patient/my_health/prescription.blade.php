@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align">My Health</h1>

        <!-- <div class="fix-add-btn">
          <a href="{{ url('/') }}/patient/my_health/add_medication"><span class="grey-text">Add Medication</span>
             <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
          </a>
        </div> -->
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="header ordermedHead z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/my_health/medical_history/general" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">PRESCRIPTION</h1>

    </div>

    <div class="has-header has-footer mar300">
       <div class="container">
        <div class="fieldspres ">
            
            <!-- <div class="mrbtm" >
                <h5 class="digihis bluedoc-text">Entitlement</h5>
                <div class="row" >
                    <div class="input-field col s6 m6 l6 selct">
                        <select class="cmb_entitlement" id="cmb_entitlement" name="cmb_entitlement">
                            <option value="" disabled selected>Select Entitlement</option>
                            @if(isset($entitlement_user_arr) && !empty($entitlement_user_arr))
                                @foreach($entitlement_user_arr as $list)
                                    <option data-card_no="{{ $list['card_no'] }}" value="{{ $list['entitlement_id'] }}">{{ $list['user_entitlement']['entitlement'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="input-field col s6 m6 l6  text-bx lessmar">
                        <input type="text" id="txt_card_no" name="txt_card_no" class="validate" readonly>
                        <label for="txt_card_no" class="grey-text truncate lbl_card_no">Enter Card Number</label>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col s12 m12 l12 ">
                        <div class="input-field uploadImgnew">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span><i class="material-icons">camera_alt</i></span>
                                    <input type="file" multiple>
                                </div><span class="textside">Optional - Upload photo of affected area.</span>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>

            <div class="row mrbtm">
                <label class="col s4 m4 l4 bluedoc-text truncate">Preferred Medication Brand:</label>
                <div class="input-field col s8 m8 l8 selct">
                    <select>
                        <option value="" disabled selected>Select an Preferred type</option>
                        <option value="original">Original</option>
                        <option value="generic">Generic</option>
                        <option value="either">Either</option>
                    </select>
                </div>
            </div>
            <div class="divider mrtpbtm"></div> -->

            <h5 class="digihis bluedoc-text">Digital History</h5>
            
            <div class="row posrel hide-on-med-and-down row-spacing-right-btm">
                <div class="col l2 m6 s12 ">Prescription</div>
                <div class="col l2 m6 s6">Repeats</div>
                <div class="col l2 m6 s6">Directions</div>
                <div class="col l3 m6 s6 valign-wrapper">Hardcopy Location <a class="tooltipped grey-text" data-position="bottom" data-delay="0" data-tooltip="Hardcopy location"><i class="material-icons">help_outline</i></a></div>
                <div class="col l3 m6 s6 valign-wrapper">Pharmacy <a class="tooltipped grey-text" data-position="bottom" data-delay="30" data-tooltip="Pharmacy"><i class="material-icons">help_outline</i></a></div>
            </div>
           
            @if(isset($prescription_arr_data) && !empty($prescription_arr_data))
                @foreach($prescription_arr_data as $key => $pre_data)
                    @php
                        $pres_id      = !empty($pre_data['id'])?$pre_data['id']:'';
                        $pres_date    = !empty($pre_data['prescription_date'])?$pre_data['prescription_date']:'';
                        $pres_repeats = !empty($pre_data['repeats'])?$pre_data['repeats']:'';
                        $pres_directions = !empty($pre_data['directions'])?$pre_data['directions']:'';
                        $pres_hardcopy_location = !empty($pre_data['hardcopy_location'])?$pre_data['hardcopy_location']:'';
                        $pres_pharmacy_name = !empty($pre_data['pharmacy_list']['company_name'])?$pre_data['pharmacy_list']['company_name']:'';
                        $pres_pharmacy_id = !empty($pre_data['pharmacy_id'])?$pre_data['pharmacy_id']:'';
                    @endphp
                    <div class="row posrel marbtm">
                        <div class="col l2 m12 s12  presi">
                            @if(isset($pre_data['uploaded_file']) && !empty($pre_data['uploaded_file']) && File::exists($prescription_base_path.$pre_data['uploaded_file']))
                                <a href="" class=" valign-wrapper doc_show_{{$key}}"" download><img src="{{url('')}}/public/new/images/rx-certi.png" class="imageicon" />
                                    <span class="truncate ">
                                        <span class="green-text">Prescription</span>
                                        <small class="truncate bluedoc-text">{{ date("d/m/Y", strtotime($pres_date)) }}</small>
                                     </span>
                                </a>
                            @else
                            <a href="javascript:void(0)" class=" valign-wrapper" title="No file found">
                                <img src="{{url('')}}/public/new/images/rx-certi.png" class="imageicon" />
                                <span class="truncate ">
                                        <span class="green-text">Prescription</span>
                                        <small class="truncate bluedoc-text">{{ date("d/m/Y", strtotime($pres_date)) }}</small>
                                </span>
                            </a>                                                    
                            @endif                                                    
                        </div>
                        <div class="col l2 m6 s6">
                            <div class="input-field padno selct bluedoc-text doc" id="dec_repeats_{{$key}}">
                                <!-- {{isset($pres_repeats) ? $pres_repeats : '' }} -->
                            </div>
                        </div>
                        <div class="col l2 m6 s6">
                            <div class="input-field padno selct bluedoc-text doc" id="dec_directions_{{$key}}">
                                <!-- {{isset($pres_directions) ? $pres_directions : '' }} -->
                            </div>
                        </div>
                        <div class="col l3 m6 s6">
                            <div class="input-field padno selct doc grey-text" id="dec_pres_hardcopy_location_{{$key}}">
                                <!-- {{isset($pres_hardcopy_location) ? $pres_hardcopy_location : '' }} -->
                            </div>
                        </div>
                        <div class="col l2 m5 s6">
                            <div class="input-field padno selct doc grey-text">
                                {{isset($pres_pharmacy_name) ? $pres_pharmacy_name : '' }}
                            </div>
                        </div>
                        <div class="col l1 m1 center-align btndot"><a href="#" data-activates='dropdown{{ isset($pre_data['id']) ? $pre_data['id'] : '' }}' class="dropdown-button green-text"><i class="material-icons">&#xE5D4;</i></a>
                            <ul id='dropdown{{ isset($pre_data['id']) ? $pre_data['id'] : '' }}' class='dropdown-content doc-rop'>
                                <input type="hidden" class="old_pres_uploaded_file" value="{{isset($pre_data['uploaded_file']) ? $pre_data['uploaded_file'] : ''}}">
                                <li>
                                    <a href="javascript:void(0);" class="edit_prescription_values" id="edit_prescriptio" data-id="{{ $pre_data['id'] }}" data-repeats="{{ $pres_repeats }}" data-directions="{{ $pres_directions }}" data-hardcopy_location="{{ $pres_hardcopy_location }}" data-pharmacy_name="{{ $pres_pharmacy_name }}" data-pharmacy_id="{{ $pres_pharmacy_id }}" data-uploaded_file="{{ $pre_data['uploaded_file'] }}" >Edit</a>
                                </li>
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
            @else 
                <span class="green-text center-align">No Digital Prescription Added yet</span>
           @endif                         
                
            <div class="otherdetails">
                <div class="col s12 marbtmspace ">
                    <div class="file-field input-field fullbtn " id="btn_add_prescription">
                        <div class="btn add transparent ">
                            <span class="truncate">Add New Prescription</span>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        
        <div class="blue-box-wrapper">
        <div class="round-box z-depth-3" id="add_prescription_section" style="display: none">
        <div class="blue-border-block-top"></div>
        <div class="fieldspres round-box-content">
            <form method="post" id="add_prescription_form" action="{{$module_url_path}}/prescription/store" enctype="multipart/form-data">
                <h5 class="digihis bluedoc-text">Digital History</h5>
                    {{ csrf_field() }}
                    <input type="hidden" value="{{isset($enc_medication_id) ? $enc_medication_id : ''}}" name="enc_medication_id" id="enc_medication_id_add">
                    <div class="row posrel marbtm">
                        <div class="col l2 m12 s12  presi">
                            <!-- icon with text to use -->
                            <div class="input-field ">
                                <div class="file-field input-field">
                                    <div class="bluedoc-bg btn-floating center-align white-text circle">
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

                        <!-- <div class="col l1 m12 s12  presi">
                            <div class="input-field uploadImgnew">
                                <div class="file-field input-field">
                                    <span class="bluedoc-bg btn-floating center-align white-text circle">
                                        <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
                                        <input type="file" name="txt_uploaded_file" id="txt_uploaded_file">
                                    </span>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="err" id="err_txt_uploaded_file" style="display:none;"></div>
                            @if(Session::has('upload_file_error'))
                                <div class="err error_msg">{{ Session::get('upload_file_error') }}</div>
                            @endif
                        </div> -->

                        <div class="col l2 m3 s12">
                            <div class="input-field padno selct bluedoc-text doc input-padding-25px">
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
                        <div class="col l3 m3 s12">
                            <div class="truncate">
                                <div class="input-field input-padding-25px">
                                    <textarea id="txt_direction" name="txt_direction" class="materialize-textarea enter-direction" placeholder="Enter Directions" style="padding:0;"></textarea>
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
                    <div class="clearfix"></div>
                    <span class="right qusame rescahnge">
                        <button type="button" class="btn cart bluedoc-bg lnht round-corner btn_save_prescription_details" id="btn_save_prescription_details">SAVE</button>
                    </span>
                    <span class="left qusame rescahnge">
                        <a class="border-btn round-corner  center-align" href="javascript:void(0)" id="btn_cancel_add_prescription">CANCEL</a>
                    </span>
                    <div class="clearfix"></div>
            </form>
        </div>
        <div class="blue-border-block-bottom"></div>
        </div>
        </div>
        <div class="fieldspres " id="edit_prescription_section" style="display: none">
            <form method="post" id="edit_prescription_form" action="{{$module_url_path}}/prescription/update" enctype="multipart/form-data">
                <h5 class="digihis bluedoc-text">Digital History</h5>
                    {{ csrf_field() }}
                    <input type="hidden" value="{{isset($enc_medication_id) ? $enc_medication_id : ''}}" name="enc_medication_id" id="enc_medication_id">
                    <input type="hidden" id="prescription_id" name="prescription_id" value="">
                    <input type="hidden" id="old_pres_uploaded_file" name="old_pres_uploaded_file">

                    <div class="row posrel marbtm">
                        <div class="col l2 m12 s12  presi">
                            <!-- <div class="input-field uploadImgnew">
                                <div class="file-field input-field">
                                    <span class="bluedoc-bg btn-floating center-align white-text circle">
                                        <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
                                        <input type="file" name="edit_pres_uploaded_file" id="edit_pres_uploaded_file">
                                    </span>
                                </div>
                                <div class="clr"></div>
                            </div> -->
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
                        <div class="err" id="err_txt_uploaded_file" style="display:none;"></div>
                        <div class="col l2 m3 s12">
                            <div class="input-field padno selct bluedoc-text doc input-padding-25px">
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
                                <div class="input-field input-padding-25px">
                                    <textarea id="edit_txt_direction" name="edit_txt_direction" class="materialize-textarea enter-direction" placeholder="Enter Directions"></textarea>
                                    <div class="err" id="err_edit_txt_direction" style="display:none;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col l3 m3 s12">
                            <div class="input-field padno selct doc grey-text input-padding-25px">
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
                            <div class="input-field padno selct doc grey-text input-padding-25px">
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
                    <div class="divider mrmintb"></div>
                    <span class="right qusame rescahnge">
                        <button type="button" class="btn cart bluedoc-bg lnht round-corner btn_save_prescription_details" id="btn_update_prescription_details">Update</button>
                    </span>
                    <span class="left qusame rescahnge">
                        <a class="border-btn round-corner  center-align" href="javascript:void(0)" id="btn_cancel_update_prescription_details">CANCEL</a>
                    </span>
            </form>
        </div>
        </div>
    </div>
    <!--Container End-->

     <input type="hidden" class="response_msg" id="response_msg" name="response_msg" value="{{ Session::get('message') }}" />

    @php
        Session::forget('message');
    @endphp
    
    <a class="open_response_popup" href="#show_response_msg"></a>
    <div id="show_response_msg" class="modal requestbooking">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                    <p class="center-align" id="action_message">{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <div id="confirm_delete_prescription_popup" class="modal requestbooking">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="center-align">Are you sure you want to delete this digital prescription?</div>
                    <input type="hidden" id="delete_prescription_id">
                </div>
            </div>
        </div>
        <div class="modal-footer center-align two-btn-block">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" id="btn_confirm_delete_prescription" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>



    <script>
        $(document).ready(function(){

          var PrescformData    = new FormData();
          var editformData     = new FormData();

          var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
          var dumpSessionId = "{{ isset($medication_arr_data['userinfo']['dump_session'])?$medication_arr_data['userinfo']['dump_session']:'' }}";
          var dumpId        = "{{ isset($medication_arr_data['userinfo']['dump_id'])?$medication_arr_data['userinfo']['dump_id']:'' }}";
          var api           = virgil.API(virgilToken);
          var key           = api.keys.import(dumpSessionId);

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

            var response_msg = $('#response_msg').val();
            if(response_msg != '')
            {
                $(".open_response_popup").click();
                $('#action_message').html(response_msg);
            }

            $('#btn_add_prescription').click(function(){
                $('#add_prescription_section').show();
                $('#edit_prescription_section').hide();
            });

            $('#btn_cancel_add_prescription').click(function(){
               $('#add_prescription_section').hide(); 
            });

            $('#btn_save_prescription_details').click(function(){
                var uploaded_file       = $('#txt_uploaded_file').val();
                var repeats             = $('#cmb_repeats').val();
                var direction           = $('#txt_direction').val();
                var hardcopy_location   = $('#cmb_hardcopy_location').val();
                var pharmacy_id         = $('#cmb_pharmacy_id').val();
                var enc_medication_id   = $("#enc_medication_id_add").val();
                //var enc_patient_id      = $("#enc_patient_id").val();

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
                    PrescformData.append("enc_medication_id", enc_medication_id);
                    // /PrescformData.append("enc_patient_id", enc_patient_id);

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
                           url:'{{$module_url_path}}/prescription/store',
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
                        editformData.append('edit_pres_uploaded_file',enc_file,filename);
                    });
                  }       
            });            

            $('.delete_prescription_btn').click(function(){
                $('#delete_prescription_id').val($(this).attr('data-id'));
            });
            
            var url = "<?php echo $module_url_path;  ?>";
            $('#btn_confirm_delete_prescription').click(function(){
                    var id = $('#delete_prescription_id').val();
                    $.ajax({
                        url:url+'/prescription/delete',
                        type:'get',
                        data:{id:id},
                        success:function(data){
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                        }
                    });
            });

            $('.edit_prescription_values').click(function(){
                var pres_id                 = $(this).data('id');
                var pres_repeats            = $(this).data('repeats');
                var pres_directions         = $(this).data('directions');
                var pres_hardcopy_location  = $(this).data('hardcopy_location');
                var pres_pharmacy_name      = $(this).data('pharmacy_name');
                var pres_pharmacy_id        = $(this).data('pharmacy_id');
                var pres_uploaded_file      = $(this).data('uploaded_file');
                
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

                $('#edit_prescription_section').show();
                $('#add_prescription_section').hide();

                /*$('#edit_cmb_repeats').closest('.col').find('.select-dropdown').val(pres_repeats);
                $('#edit_cmb_repeats').val(pres_repeats).attr('selected','selected');*/

                //$('#edit_txt_direction').val(pres_directions);

                /*$('#edit_cmb_hardcopy_location').closest('.col').find('.select-dropdown').val(pres_hardcopy_location);
                $('#edit_cmb_hardcopy_location').val(pres_hardcopy_location).attr('selected','selected');*/

                $('#edit_cmb_pharmacy_id').closest('.col').find('.select-dropdown').val(pres_pharmacy_name);
                $('#edit_cmb_pharmacy_id').val(pres_pharmacy_id).attr('selected','selected');
            });

            $('#btn_cancel_update_prescription_details').click(function(){
                $('#edit_prescription_section').hide();
            });

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
                    return false;
                }
                else if(up_direction == '')
                {
                    $('#err_edit_txt_direction').show();
                    $('#edit_txt_direction').focus();
                    $('#err_edit_txt_direction').html("Please enter direction");
                    $('#err_edit_txt_direction').fadeOut(8000);
                    return false;
                }
                else if(up_hardcopy_location == '')
                {
                    $('#err_edit_cmb_hardcopy_location').show();
                    $('#edit_cmb_hardcopy_location').focus();
                    $('#err_edit_cmb_hardcopy_location').html("Please select Hardcopy Location");
                    $('#err_edit_cmb_hardcopy_location').fadeOut(8000);
                    return false;
                }
                else if(up_pharmacy_id == '')
                {
                    $('#err_edit_cmb_pharmacy_id').show();
                    $('#edit_cmb_pharmacy_id').focus();
                    $('#err_edit_cmb_pharmacy_id').html("Please select Pharmacy");
                    $('#err_edit_cmb_pharmacy_id').fadeOut(8000);
                    return false;
                }
                else
                {
                    var token            = "<?php echo csrf_token(); ?>";

                    var findkey   = api.cards.get(dumpId).then(function (cards) {

                    editformData.append("_token", token);
                    editformData.append("prescription_id", up_id);
                    editformData.append("edit_cmb_pharmacy_id", up_pharmacy_id);
                    editformData.append("old_pres_uploaded_file", old_pres_uploaded_file);

                    if(up_repeats!='')
                    {
                        var txtup_repeats = encrypt(api, up_repeats, cards);
                        editformData.append("edit_cmb_repeats", txtup_repeats);
                    }

                    if(up_direction!='')
                    {
                        var txtdirection = encrypt(api, up_direction, cards);
                        editformData.append("edit_txt_direction", txtdirection);
                    }

                    if(up_hardcopy_location!='')
                    {
                        var txthardcopy_location = encrypt(api, up_hardcopy_location, cards);
                        editformData.append("edit_cmb_hardcopy_location", txthardcopy_location);
                    }
                    
                    $.ajax({
                       url:'{{$module_url_path}}/prescription/update',
                       type:'POST',
                       dataType:'json',
                       processData: false,
                       contentType: false,
                       cache: false,
                       data: editformData,
                       success:function(res){
                          $(".open_response_popup").click();
                          $('.flash_msg_text').html(res.msg);
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
            });

            $('#cmb_entitlement').change(function(){
                var card_no = $(this).find(':selected').data('card_no');
                $("#txt_card_no").val(card_no);
                $('.lbl_card_no').addClass('active');
            });

        });
    </script>

@endsection