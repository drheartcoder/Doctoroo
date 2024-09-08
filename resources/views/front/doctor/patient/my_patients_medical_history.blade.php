@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <!--tab start-->
    <div class="mar300  has-header minhtnor">
    <style>
       .required_field
       {
        color:red;
       }
    </style>
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

        <!--Medical History tab starts here-->
        <div id="medical" class="tab-content medi ">
            <div class="doctor-container">
                <!--Medical History section -->
                <div class="head-medical-pres">
                    <h2 class="center-align">Medical History</h2>
                    <span class="posleft qusame rescahnge"><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                </div>
                <div>
                    <div class="row">
                        <div class="col m6 s12 ">
                            <div class="round-box z-depth-3">
                                <div class="heading-round-box">General</div>
                                
                                <div class="green-border round-box-content height-753px posrel">
                                    
                                    @if(isset($general_arr_data) && !empty($general_arr_data))
                                    <div class="max-height-655px" id="show_general">

                                        @php
                                            $general_allergy                = isset($general_arr_data['allergy'])?$general_arr_data['allergy']:'';
                                            $general_allergy_details        = isset($general_arr_data['allergy_details'])?$general_arr_data['allergy_details']:'';

                                            $general_surgery                = isset($general_arr_data['surgery'])?$general_arr_data['surgery']:'';
                                            $general_surgery_details        = isset($general_arr_data['surgery_details'])?$general_arr_data['surgery_details']:'';

                                            $general_pregnancy              = isset($general_arr_data['pregnancy'])?$general_arr_data['pregnancy']:'';
                                            $general_pregnancy_details      = isset($general_arr_data['pregnancy_details'])?$general_arr_data['pregnancy_details']:'';

                                            $general_family_history         = isset($general_arr_data['family_history'])?$general_arr_data['family_history']:'';
                                            $general_family_history_details = isset($general_arr_data['family_history_details'])?$general_arr_data['family_history_details']:'';

                                            $general_other                  = isset($general_arr_data['other'])?$general_arr_data['other']:'';
                                            $general_other_details          = isset($general_arr_data['other_details'])?$general_arr_data['other_details']:'';

                                            $general_diabetes               = isset($general_arr_data['diabetes'])?$general_arr_data['diabetes']:'';
                                            $general_diabetes_details       = isset($general_arr_data['diabetes_details'])?$general_arr_data['diabetes_details']:'';

                                            $general_heart_disease          = isset($general_arr_data['heart_disease'])?$general_arr_data['heart_disease']:'';
                                            $general_heart_disease_details          = isset($general_arr_data['heart_disease_details'])?$general_arr_data['heart_disease_details']:'';

                                            $general_stroke                 = isset($general_arr_data['stroke'])?$general_arr_data['stroke']:'';
                                            $general_stroke_details         = isset($general_arr_data['stroke_details'])?$general_arr_data['stroke_details']:'';

                                            $general_blood_pressure         = isset($general_arr_data['blood_pressure'])?$general_arr_data['blood_pressure']:'';
                                            $general_blood_pressure_details = isset($general_arr_data['blood_pressure_details'])?$general_arr_data['blood_pressure_details']:'';

                                            $general_high_cholesterol       = isset($general_arr_data['high_cholesterol'])?$general_arr_data['high_cholesterol']:'';
                                            $general_high_cholesterol_details = isset($general_arr_data['high_cholesterol_details'])?$general_arr_data['high_cholesterol_details']:'';

                                            $general_asthma                 = isset($general_arr_data['asthma'])?$general_arr_data['asthma']:'';
                                            $general_asthma_details         = isset($general_arr_data['asthma_details'])?$general_arr_data['asthma_details']:'';

                                            $general_depression             = isset($general_arr_data['depression'])?$general_arr_data['depression']:'';
                                            $general_depression_details     = isset($general_arr_data['depression_details'])?$general_arr_data['depression_details']:'';

                                            $general_arthritis              = isset($general_arr_data['arthritis'])?$general_arr_data['arthritis']:'';
                                            $general_arthritis_details      = isset($general_arr_data['arthritis_details'])?$general_arr_data['arthritis_details']:'';
                                        @endphp

                                        <!--After saving collapse panel starts here-->
                                        <ul class="collapsible no-shadowNew" data-collapsible="accordion">
                                            
                                            @php
                                                $arr_general_health = array( 
                                                    array( 'Allergies', $general_allergy, $general_allergy_details ),
                                                    array( 'Surgeries / Procedure', $general_surgery, $general_surgery_details ),
                                                    array( 'Pregnancies', $general_pregnancy, $general_pregnancy_details ),
                                                    array( 'Family history', $general_family_history, $general_family_history_details ),
                                                    array( 'Other', $general_other, $general_other_details ),
                                                    array( 'Diabetes', $general_diabetes, $general_diabetes_details ),
                                                    array( 'Heart Disease (CHF, MI)', $general_heart_disease, $general_heart_disease_details ),
                                                    array( 'Stroke', $general_stroke, $general_stroke_details ),
                                                    array( 'High Blood Pressure', $general_blood_pressure, $general_blood_pressure_details ),
                                                    array( 'High Cholesterol', $general_high_cholesterol, $general_high_cholesterol_details ),
                                                    array( 'Asthma / COPD', $general_asthma, $general_asthma_details ),
                                                    array( 'Depression', $general_depression, $general_depression_details ),
                                                    array( 'Arthrits', $general_arthritis, $general_arthritis_details )
                                                                            );
                                            @endphp
                                            
                                            @foreach($arr_general_health as $key => $key_general)
                                                
                                                <?php
                                                    if($key_general['1'] == "yes")
                                                    {
                                                        ?>
                                                            <li>
                                                                <div class="collapsible-header">{{ $key_general['0'] }} <i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                                                                <div class="collapsible-body"><span id="key_{{$key}}">{{ $key_general['2'] }}</span></div>
                                                            </li>
                                                            <script type="text/javascript">
                                                                   var key_general          = "{{ $key_general['2'] }}"; 
                                                                   var foreach_key          = "{{ $key }}"; 
                                                                   var card_id              = "{{ $user_details->dump_id }}";
                                                                   var userkey              = "{{ $user_details->dump_session }}";
                                                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                                                   var key                  = api.keys.import(userkey);
                                                                       var decrypt_key_general   = key.decrypt(key_general).toString();
                                                                       $('#key_'+foreach_key).html(decrypt_key_general);
                                                            </script>
                                                        <?php
                                                    }
                                                    else if($key_general['1'] == "no")
                                                    {
                                                        ?>
                                                            <li>
                                                                <div class="collapsible-header disabled-item" style="border: solid 1px #9a9a9a;">{{ $key_general['0'] }}</div>
                                                            </li>
                                                        <?php
                                                    }
                                                ?>
                                            @endforeach


                                            @if(isset($dynamic_general_data) && !empty($dynamic_general_data))
                                                @foreach($dynamic_general_data as $key => $dygen_data)
                                                    @if($dygen_data['status'] == 'yes')
                                                    <li>
                                                        <div class="collapsible-header">{{ $dygen_data['title'] }} <i class="material-icons right arrow">keyboard_arrow_down</i></div>
                                                        <div class="collapsible-body"><span class="key_{{$key}}">{{ $dygen_data['description'] }}</span></div>
                                                        <script type="text/javascript">
                                                               var dygen_data           = "{{ $dygen_data['description'] }}"; 
                                                               var foreach_key          = "{{ $key }}"; 
                                                               var card_id              = "{{ $user_details->dump_id }}";
                                                               var userkey              = "{{ $user_details->dump_session }}";
                                                               var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                                               var api                  = virgil.API(VIRGIL_TOKEN);
                                                               var key                  = api.keys.import(userkey);
                                                                   var decrypt_dygen_data   = key.decrypt(dygen_data).toString();
                                                                   $('.key_'+foreach_key).html(decrypt_dygen_data);
                                                        </script>
                                                    </li>
                                                    @else
                                                        <li>
                                                                <div class="collapsible-header disabled-item" style="border: solid 1px #9a9a9a;">{{ $dygen_data['title'] }}</div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </ul>
                                        <!--After saving collapse panel ends here-->

                                        <div class="clr"></div>
                                    </div>



                                    <div class="max-height-655px" id="edit_general" style="display: none;">
                                        <!--for choosing panel starts here-->
                                        <ul class="collection medical-history brdrtopsd">
                                            
                                            @php
                                                $arr_edit_general_health = array( 
                                                    array( 'Allergies', 'allergy', $general_allergy, $general_allergy_details ),
                                                    array( 'Surgeries / Procedure', 'surgery', $general_surgery, $general_surgery_details ),
                                                    array( 'Pregnancies', 'pregnancy', $general_pregnancy, $general_pregnancy_details ),
                                                    array( 'Family history', 'family_history', $general_family_history, $general_family_history_details ),
                                                    array( 'Other', 'other', $general_other, $general_other_details ),
                                                    array( 'Diabetes', 'diabetes', $general_diabetes, $general_diabetes_details ),
                                                    array( 'Heart Disease (CHF, MI)', 'heart_disease', $general_heart_disease, $general_heart_disease_details ),
                                                    array( 'Stroke', 'stroke', $general_stroke, $general_stroke_details ),
                                                    array( 'High Blood Pressure', 'blood_pressure', $general_blood_pressure, $general_blood_pressure_details ),
                                                    array( 'High Cholesterol', 'high_cholesterol', $general_high_cholesterol, $general_high_cholesterol_details ),
                                                    array( 'Asthma / COPD', 'asthma', $general_asthma, $general_asthma_details ),
                                                    array( 'Depression', 'depression', $general_depression, $general_depression_details ),
                                                    array( 'Arthrits', 'arthritis', $general_arthritis, $general_arthritis_details )
                                                                                );
                                            @endphp
                                            
                                            @foreach($arr_edit_general_health as $key => $key_general)
                                                <li class="collection-item">
                                                    <div class="chkbx new">
                                                        @php
                                                            $is_checked = '';
                                                            if($key_general['2'] == "yes")
                                                            {
                                                                $is_checked  = 'checked';
                                                                $display_div = 'display:block';
                                                            }
                                                            else
                                                            {
                                                                $is_checked  = '';
                                                                $display_div = 'display:none';
                                                            }
                                                        @endphp
                                                        <input type="checkbox" class="filled-in arr_edit_general_health" id="edit_{{ $key_general['1'] }}" name="edit_{{ $key_general['1'] }}" data-get_edit_general_name="{{ $key_general['1'] }}" {{ $is_checked }} />
                                                        <label for="edit_{{ $key_general['1'] }}">{{ $key_general['0'] }}</label>
                                                    </div>
                                                    <!--on selecting any this div will open starts-->
                                                    <div class="hisdetails edit_{{ $key_general['1'] }}_details" style="{{ $display_div }}">
                                                        <div class="input-field">
                                                            <textarea id="edit_{{ $key_general['1'] }}_details" name="edit_{{ $key_general['1'] }}_details" class="materialize-textarea materialize-textarea-max-height" placeholder="Enter details if required">{{ $key_general['3'] }}</textarea>
                                                        </div>
                                                        <script type="text/javascript">
                                                               var key_general_name     = "{{ $key_general['3'] }}"; 
                                                               var foreach_key          = "{{ $key_general['1'] }}"; 
                                                               var card_id              = "{{ $user_details->dump_id }}";
                                                               var userkey              = "{{ $user_details->dump_session }}";
                                                               var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                                               var api                  = virgil.API(VIRGIL_TOKEN);
                                                               var key                  = api.keys.import(userkey);
                                                                   var decrypt_key_general_name   = key.decrypt(key_general_name).toString();
                                                                   $('#edit_'+foreach_key+'_details').html(decrypt_key_general_name);
                                                                   $('#edit_'+foreach_key+'_details').val(decrypt_key_general_name);
                                                        </script>
                                                    </div>
                                                    <!--on selecting any div will open ends-->
                                                    <div class="clear"></div>
                                                </li>
                                            @endforeach

                                                @foreach($dynamic_general_data as $dygen_data)
                                                    @php
                                                        $dynamic_checked = '';

                                                        $display_dynamic = '';

                                                        if(isset($dygen_data['status']) && !empty($dygen_data['status']) && $dygen_data['status'] == 'yes')
                                                        {
                                                            $dynamic_checked = 'checked';
                                                              $display_dynamic = 'display:block';
                                                        }
                                                        else
                                                        {
                                                            $dynamic_checked = '';
                                                            $display_dynamic = 'display:none';
                                                        }

                                                    @endphp
                                                    <li class="collection-item ">
                                                        <div class="chkbx new">
                                                            <input type="checkbox" class="filled-in dynamic_general_details" data-id="{{ $dygen_data['id'] }}" id="dynamic_details{{ $dygen_data['id'] }}" {{isset($dygen_data['status']) && $dygen_data['status'] == 'yes' ? 'checked' : '' }} />
                                                            <label for="dynamic_details{{ $dygen_data['id'] }}">{{ $dygen_data['title'] }}</label>
                                                        </div>
                                                        <!--on selecting any this div will open starts-->
                                                        <div class="dynamic_textfield_box hisdetails dynamic_details{{ $dygen_data['id'] }}" style="{{ $display_dynamic }}">
                                                            <div class="input-field">
                                                                <textarea id="dynamic_details{{ $dygen_data['id'] }}" name="dynamic_details{{ $dygen_data['id'] }}" class="materialize-textarea materialize-textarea-max-height dynamic_textarea dynamic_textarea{{ $dygen_data['id'] }}" placeholder="Enter details if required">{{ $dygen_data['description'] }}</textarea>
                                                            </div>
                                                            <script type="text/javascript">
                                                            $(document).ready(function(){
                                                                   var key_dygen_data       = "{{ $dygen_data['description'] }}"; 
                                                                   var foreach_key          = "{{ $dygen_data['id'] }}"; 
                                                                   var card_id              = "{{ $user_details->dump_id }}";
                                                                   var userkey              = "{{ $user_details->dump_session }}";
                                                                   var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                                                   var api                  = virgil.API(VIRGIL_TOKEN);
                                                                   var key                  = api.keys.import(userkey);
                                                                       var decrypt_key_dygen_data   = key.decrypt(key_dygen_data).toString();
                                                                       $('.dynamic_textarea'+foreach_key).html(decrypt_key_dygen_data);
                                                                       $('.dynamic_textarea'+foreach_key).val(decrypt_key_dygen_data);
                                                            });           
                                                            </script>

                                                            <a href="javascript:void(0);" class="del_dynamic_general" data-dynamic_general_id="{{ $dygen_data['id'] }}"><i class="material-icons">delete</i></a>
                                                        </div>
                                                        <!--on selecting any div will open ends-->
                                                        <div class="clear"></div>
                                                    </li>
                                                @endforeach

                                        </ul>
                                        <!--for choosing panel starts here-->
                                        
                                        <div class="clr"></div>
                                    </div>




                                    <!--If add new conditions starts here-->
                                    <a class="border-btn-nomarrl center-align truncate" href="#add_new_condition" data-backdrop="static" data-keyboard="false">
                                        <span class="font-size-16px">+</span> Add New
                                    </a>
                                    <!--If add new conditions ends here-->
                                    
                                    <div class="center-align position-absolute">
                                        <div class="display-inline margin-top-btm" id="edit_general_medical_div">
                                            <button id="edit_general_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="display-inline" id="save_general_medical_div" style="display: none;">
                                            <button id="btn_save_general_medical_form" class="border-btn lnht round-corner bt_submit_general_medical_form">Save</button>
                                        </div>
                                        <div class="display-inline margin-top-btm" id="cancel_general_medical_div" style="display: none;">
                                            <a href="javascript:void(0)" id="btn_cancel_general_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                        </div>
                                    </div>

                                    @else

                                    <div class="max-height-655px" id="new_general">
                                        <!--After saving collapse panel starts here-->
                                        <ul class="collapsible no-shadowNew" data-collapsible="accordion">
                                            
                                             @php
                                                $no_arr_general_health = array( 'Allergies', 'Surgeries / Procedure', 'Pregnancies', 'Family history', 'Other', 'Diabetes', 'Heart Disease (CHF, MI)', 'Stroke', 'High Blood Pressure', 'High Cholesterol', 'Asthma / COPD', 'Depression', 'Arthrits' );
                                            @endphp
                                            
                                            @foreach($no_arr_general_health as $key_general)
                                                <li>
                                                    <div class="collapsible-header disabled-item" style="border: solid 1px #9a9a9a;">{{ $key_general }}</div>
                                                </li>
                                            @endforeach

                                        </ul>
                                        <!--After saving collapse panel ends here-->
                                        <div class="clr"></div>
                                    </div>


                                    <div class="max-height-655px" id="edit_new_general" style="display:none;">
                                        <!--for choosing panel starts here-->
                                        <ul class="collection medical-history brdrtopsd">
                                            
                                            @php
                                                $edit_new_arr_general_health = array( 
                                                    array( 'Allergies', 'allergy' ),
                                                    array( 'Surgeries / Procedure', 'surgery' ),
                                                    array( 'Pregnancies', 'pregnancy' ),
                                                    array( 'Family history', 'family_history' ),
                                                    array( 'Other', 'other' ),
                                                    array( 'Diabetes', 'diabetes' ),
                                                    array( 'Heart Disease (CHF, MI)', 'heart_disease' ),
                                                    array( 'Stroke', 'stroke' ),
                                                    array( 'High Blood Pressure', 'blood_pressure' ),
                                                    array( 'High Cholesterol', 'high_cholesterol' ),
                                                    array( 'Asthma / COPD', 'asthma' ),
                                                    array( 'Depression', 'depression' ),
                                                    array( 'Arthrits', 'arthritis' )
                                                                            );
                                            @endphp
                                            
                                            @foreach($edit_new_arr_general_health as $key_general)

                                            <li class="collection-item  ">
                                                <div class="chkbx new">
                                                    <input type="checkbox" class="filled-in edit_new_arr_general_health" id="new_{{ $key_general['1'] }}" name="new_{{ $key_general['1'] }}" data-general_name="{{ $key_general['1'] }}" />
                                                    <label for="new_{{ $key_general['1'] }}">{{ $key_general['0'] }}</label>
                                                </div>
                                                <!--on selecting any this div will open starts-->
                                                <div class="hisdetails new_{{ $key_general['1'] }}_details" style="display:none;">
                                                    <div class="input-field">
                                                        <textarea id="new_{{ $key_general['1'] }}_details" name="new_{{ $key_general['1'] }}_details" class="materialize-textarea materialize-textarea-max-height" placeholder="Enter details if required"></textarea>
                                                    </div>
                                                </div>
                                                <!--on selecting any div will open ends-->
                                                <div class="clear"></div>
                                            </li>
                                            @endforeach

                                        </ul>
                                        <!--for choosing panel starts here-->
                                        
                                        <div class="clr"></div>
                                    </div>

                                    <!--If add new conditions starts here-->
                                    <a class="border-btn-nomarrl center-align truncate" href="#add_new_condition" data-backdrop="static" data-keyboard="false">
                                        <span class="font-size-16px">+</span> Add New
                                    </a>
                                    <!--If add new conditions ends here-->

                                    <div class="center-align position-absolute">
                                        <div class="display-inline margin-top-btm" id="edit_new_general_medical_div">
                                            <button id="edit_new_general_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="display-inline" id="save_new_general_medical_div" style="display: none;">
                                            <button id="btn_save_new_general_medical_form" class="border-btn lnht round-corner bt_submit_new_general_medical_form">Save</button>
                                        </div>
                                        <div class="display-inline margin-top-btm" id="cancel_new_general_medical_div" style="display: none;">
                                            <a href="javascript:void(0)" id="btn_cancel_new_general_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                        </div>
                                    </div>

                                    @endif
                                    
                                </div>
                                <div class="blue-border-block-bottom"></div>
                            </div>
                        </div>

                        <div class="col m6 s12">
                            <div class="round-box z-depth-3">
                                <div class="heading-round-box">Last Updated</div>
                                <div class="green-border round-box-content">
                                    <div class="right-align ">
                                        <div class="down-ld">
                                            Download as Pdf <a href="javascript:void(0)" class="bluedoc-bg btn-floating center-align white-text circle btn file_download" entitlement_name="Last Updated Medical History" id="btn_download_pdf"><i class="material-icons">file_download</i></a></div>
                                    </div>
                                    @php
                                        $user_title = isset($medical_updates_arr['user_info']['title'])?$medical_updates_arr['user_info']['title']:'';
                                        $user_first = isset($medical_updates_arr['user_info']['first_name'])?$medical_updates_arr['user_info']['first_name']:'';
                                        $user_last = isset($medical_updates_arr['user_info']['last_name'])?$medical_updates_arr['user_info']['last_name']:'';

                                        $updated_at = isset($medical_updates_arr['updated_at'])?$medical_updates_arr['updated_at']:'';
                                    @endphp
                                    <div class="row ">
                                        <div class="col s12 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Last Updated</strong> @if(isset($updated_at) && !empty($updated_at)) {{ date("h:i a, d M Y", strtotime($updated_at)) }} @endif
                                            </label>
                                        </div>
                                        <div class="col s12 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Updated By</strong>{{ $user_title.' '.$user_first.' '.$user_last }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="blue-border-block-bottom"></div>
                            </div>
                            <div class="round-box z-depth-3">
                                <div class="heading-round-box">Medication</div>
                                <div class="green-border round-box-content medication-history-details posrel">
                                    <div class="inner">
                                        <div class="">
                                            
                                            @if(isset($medication_arr_data) && !empty($medication_arr_data))
                                                @foreach($medication_arr_data as $key => $med_data)
                                                    <a href="{{ url('/') }}/doctor/patients/medication_details/{{ $enc_patient_id }}/{{ base64_encode($med_data['id']) }}" class="border-btn-nomarrl green-btn left-align truncate">
                                                    <i class="material-icons right">chevron_right</i><span class="medi_name_{{ $key }}">{{ $med_data['medication_name'] }}</span></a>
                                                    <script type="text/javascript">
                                                           var medication_name      = "{{ $med_data['medication_name'] }}"; 
                                                           var foreach_key          = "{{ $key }}"; 
                                                           var card_id              = "{{ $user_details->dump_id }}";
                                                           var userkey              = "{{ $user_details->dump_session }}";
                                                           var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                                                           var api                  = virgil.API(VIRGIL_TOKEN);
                                                           var key                  = api.keys.import(userkey);
                                                               var decrypt_medication_name   = key.decrypt(medication_name).toString();
                                                               $('.medi_name_'+foreach_key).html(decrypt_medication_name);
                                                    </script>
                                                @endforeach
                                            @else
                                                <div style="text-align: center;">No Medication Found</div>
                                            @endif

                                            
                                        </div>
                                    </div>
                                    <a href="{{ url('/') }}/doctor/patients/medication/add/{{ $enc_patient_id }}" class="border-btn-nomarrl center-align truncate" href="#"><span class="font-size-16px">+</span> Add New</a>
                                    <div class="clr"></div>
                                </div>
                                <div class="blue-border-block-bottom"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <div class="round-box z-depth-3">
                                <div class="heading-round-box">Lifestyle</div>

                                <!-- Display Lifestyle Starts -->
                                <div class="green-border round-box-content" id="show_lifestyle">
                                    <div class="row  pdrl" >
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Physical Activities</strong>
                                                <span  id="text_physical_activity">{{ !empty($lifestyle_arr_data['physical_activity']) ? $lifestyle_arr_data['physical_activity'] : 'NA' }}</span>
                                            </label>
                                        </div>
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Food Habits</strong>
                                                <span  id="text_food_habit">{{ !empty($lifestyle_arr_data['food_habit'])?$lifestyle_arr_data['food_habit']:'NA' }}</span>
                                            </label>
                                        </div>
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Smoking</strong>
                                                <span  id="text_smoking">{{ !empty($lifestyle_arr_data['smoking'])?$lifestyle_arr_data['smoking']:'NA' }}</span>
                                            </label>
                                        </div>
                                            
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Alcohol</strong>
                                                <span  id="text_alcohol">{{ !empty($lifestyle_arr_data['alcohol'])?$lifestyle_arr_data['alcohol']:'NA' }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row pdrl ">
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Stress Levels</strong>
                                                <span  id="text_stress_level">{{ !empty($lifestyle_arr_data['stress_level'])?$lifestyle_arr_data['stress_level']:'NA' }}</span>
                                            </label>
                                        </div>
                                        <div class="col s12 m6 l3 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Average Sleep</strong>
                                                <span  id="text_average_sleep">{{ !empty($lifestyle_arr_data['average_sleep'])?$lifestyle_arr_data['average_sleep']:'NA' }}</span>
                                            </label>
                                        </div>
                                        <div class="col s12  l6 martp">
                                            <label class="doc-details">
                                                <strong class="grey-text">Others</strong>
                                                <span  id="text_other">{{ !empty($lifestyle_arr_data['other_lifestyle'])?$lifestyle_arr_data['other_lifestyle']:'NA' }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <!-- Display Lifestyle Ends -->

                                <!-- Edit Lifestyle Starts -->
                                <div class="green-border round-box-content" id="edit_lifestyle" style="display: none;">
                                    <div class="row  pdrl" style="margin-top: 20px;">
                                        <div class="col s12 m6 l3 ">
                                            <?php $lifestyle_id = isset($lifestyle_arr_data['id']) ? $lifestyle_arr_data['id'] : ''; ?>
                                                <input type="hidden" id="txt_lifestyle_id" name="txt_lifestyle_id" value="{{$lifestyle_id}}" />
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_physical_activities" value="{{isset($lifestyle_arr_data['physical_activity']) && !empty($lifestyle_arr_data['physical_activity']) ? $lifestyle_arr_data['physical_activity'] : '' }}" class="validate physical_activity{{$lifestyle_id}}">
                                                    <label for="physical_activity" class="grey-text">Physical Activities <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_physical_activities" style="display:none;"></div>
                                                      <?php if(isset($lifestyle_arr_data['physical_activity'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var physical_activity_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var physical_activity       = "{{ $lifestyle_arr_data['physical_activity'] }}"; 
                                                                 var card_id                 = "{{ $user_details->dump_id }}";
                                                                 var userkey                 = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN            = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api                     = virgil.API(VIRGIL_TOKEN);
                                                                 var key                     = api.keys.import(userkey);
                                                                     var decrypt_physical_activity   = key.decrypt(physical_activity).toString();
                                                                     $('#cmb_physical_activities').val(decrypt_physical_activity);
                                                                     $('#text_physical_activity').html(decrypt_physical_activity);
                                                             });
                                                          </script>
                                                      <?php
                                                      } ?>
                                               </div>
                                        </div>

                                        <div class="col s12 m6 l3 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_food_habits" value="{{isset($lifestyle_arr_data['food_habit']) && !empty($lifestyle_arr_data['food_habit']) ? $lifestyle_arr_data['food_habit'] : '' }}" class="validate ">
                                                    <label for="cmb_food_habits" class="grey-text">Food Habits <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_food_habits" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['food_habit'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var food_habit_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var food_habit       = "{{ $lifestyle_arr_data['food_habit'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_food_habit   = key.decrypt(food_habit).toString();
                                                                     $('#cmb_food_habits').val(decrypt_food_habit);
                                                                     $('#text_food_habit').html(decrypt_food_habit);
                                                             });
                                                          </script>
                                                      <?php
                                                    } ?> 
                                               </div>
                                        </div>

                                        <div class="col s12 m6 l3 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_smoking" value="{{isset($lifestyle_arr_data['smoking']) && !empty($lifestyle_arr_data['smoking']) ? $lifestyle_arr_data['smoking'] : '' }}" class="validate ">
                                                    <label for="cmb_smoking" class="grey-text">Smoking <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_smoking" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['smoking'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var smoking_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var smoking       = "{{ $lifestyle_arr_data['smoking'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_smoking   = key.decrypt(smoking).toString();
                                                                     $('#cmb_smoking').val(decrypt_smoking);
                                                                     $('#text_smoking').html(decrypt_smoking);
                                                             });
                                                          </script>
                                                      <?php
                                                    } ?>
                                                </div>
                                        </div>

                                        <div class="col s12 m6 l3 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_alcohol" value="{{isset($lifestyle_arr_data['alcohol']) && !empty($lifestyle_arr_data['alcohol']) ? $lifestyle_arr_data['alcohol'] : '' }}" class="validate ">
                                                    <label for="cmb_alcohol" class="grey-text">Alcohol <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_alcohol" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['alcohol'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var alcohol_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var alcohol       = "{{ $lifestyle_arr_data['alcohol'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_alcohol   = key.decrypt(alcohol).toString();
                                                                     $('#cmb_alcohol').val(decrypt_alcohol);
                                                                     $('#text_alcohol').html(decrypt_alcohol);
                                                             });
                                                          </script>
                                                      <?php
                                                    } ?>
                                                </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row pdrl">

                                        <div class="col s12 m6 l3 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_stress_levels" value="{{isset($lifestyle_arr_data['stress_level']) && !empty($lifestyle_arr_data['stress_level']) ? $lifestyle_arr_data['stress_level'] : '' }}" class="validate ">
                                                    <label for="stress_level" class="grey-text">Stress Levels <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_stress_levels" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['stress_level'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var stress_level_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var stress_level       = "{{ $lifestyle_arr_data['stress_level'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_stress_level   = key.decrypt(stress_level).toString();
                                                                     $('#cmb_stress_levels').val(decrypt_stress_level);
                                                                     $('#text_stress_level').html(decrypt_stress_level);

                                                             });
                                                          </script>
                                                      <?php
                                                    } ?>
                                               </div>
                                        </div>

                                         <div class="col s12 m6 l3 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="cmb_average_sleep" value="{{isset($lifestyle_arr_data['average_sleep']) && !empty($lifestyle_arr_data['average_sleep']) ? $lifestyle_arr_data['average_sleep'] : '' }}" class="validate ">
                                                    <label for="average_sleep" class="grey-text">Average Sleep <span class="required_field">*</span></label>
                                                    <div class="err" id="err_cmb_average_sleep" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['average_sleep'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var average_sleep_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var average_sleep       = "{{ $lifestyle_arr_data['average_sleep'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_average_sleep   = key.decrypt(average_sleep).toString();
                                                                     $('#cmb_average_sleep').val(decrypt_average_sleep);
                                                                     $('#text_average_sleep').html(decrypt_average_sleep);
                                                             });
                                                          </script>
                                                      <?php
                                                    } ?>
                                               </div>
                                        </div>

                                        <div class="col s12  l6 ">
                                                <div class="input-field input-padding-25px">
                                                    <input type="text" id="text_lifestyle_other" value="{{isset($lifestyle_arr_data['other_lifestyle']) && !empty($lifestyle_arr_data['other_lifestyle']) ? $lifestyle_arr_data['other_lifestyle'] : '' }}" class="validate ">
                                                    <label for="text_lifestyle_other" class="grey-text">Other <span class="required_field">*</span></label>
                                                    <div class="err" id="err_text_lifestyle_other" style="display:none;"></div>
                                                    <?php if(isset($lifestyle_arr_data['other_lifestyle'])){
                                                      ?>
                                                         <script type="text/javascript">
                                                             $(document).ready(function(){
                                                                 var other_lifestyle_id    = "{{ $lifestyle_arr_data['id']}}"; 
                                                                 var other_lifestyle       = "{{ $lifestyle_arr_data['other_lifestyle'] }}"; 
                                                                 var card_id          = "{{ $user_details->dump_id }}";
                                                                 var userkey          = "{{ $user_details->dump_session }}";
                                                                 var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                                                                 var api              = virgil.API(VIRGIL_TOKEN);
                                                                 var key              = api.keys.import(userkey);
                                                                     var decrypt_other_lifestyle   = key.decrypt(other_lifestyle).toString();
                                                                     $('#text_lifestyle_other').val(decrypt_other_lifestyle);
                                                                     $('#text_other').html(decrypt_other_lifestyle);
                                                             });
                                                          </script>
                                                      <?php
                                                    } ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Lifestyle Ends -->

                                <div class="center-align">
                                    <div class="display-inline margin-top-btm" id="edit_lifestyle_medical_div">
                                        <a href="javascript:void(0)" id="edit_lifestyle_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="display-inline" id="save_lifestyle_medical_div" style="display: none;">
                                        <a href="javascript:void(0)" id="btn_save_lifestyle_medical_form" class="border-btn lnht round-corner">Save</a>
                                    </div>
                                    <div class="display-inline margin-top-btm" id="cancel_lifestyle_medical_div" style="display: none;">
                                        <a href="javascript:void(0)" id="btn_cancel_lifestyle_medical_form" class="bluedoc-bg btn-floating center-align white-text circle btn"><i class="material-icons">close</i></a>
                                    </div>
                                </div>
                                <div class="clr"></div>
                                <div class="blue-border-block-bottom"></div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--Medical History section -->
            </div>
        </div>
        <!--Medical History tab ends here-->

    </div>

    <!-- Modal add new condition -->
    <div id="add_new_condition" class="modal make-patient">
        <div class="modal-content">
            <h4>Add New Condition</h4>
        </div>
        <div class="modal-data padding-bottom">
            <p>Please add patient condition here</p>
            <div>
                <div class="row">
                    <div class="col s12 ">
                        <div class="input-field text-bx modal-fields input-padding-25px">
                            <input id="condition_title" name="condition_title" type="text" class="validate">
                            <label for="condition_title">Title <span class="required_field">*</span></label>
                            <div class="err" id="err_condition_title" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 ">
                        <div class="input-field text-bx modal-fields input-padding-25px">
                            <textarea id="condition_description" name="condition_description" type="text" class="materialize-textarea"></textarea>
                            <label for="condition_description">Description <span class="required_field">*</span></label>
                            <div class="err" id="err_condition_description" style="display:none;"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" id="close_add_new_condition" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" id="add_new_general_condition" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
        </div>
    </div>
    <!-- Modal add new condition End -->

    <!-- Modal delete dynamic general -->
    <a href="#open_delete_dynamic_pop" id="delete_dynamic_pop" class="delete_dynamic_pop"></a>
    <div id="open_delete_dynamic_pop" class="modal make-patient">
        <div class="modal-content">
            <h4 class="center-align">Confirm Delete General Medical Condition</h4>
        </div>
        <div class="modal-data padding-bottom">
            <div class="row">
                <div class="col s12 ">
                    
                        <p class="center-align">Are You Sure? You want to delete this General Medical Condition!</p>
                        <input type="hidden" id="get_dynamic_general_id" name="get_dynamic_general_id">
                   
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" id="cancel_delete_dynamic_general" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" id="confirm_delete_dynamic_general" class="modal-action waves-effect waves-green btn-cancel-cons right">Confirm</a>
        </div>
    </div>
    <!-- Modal delete dynamic general End -->

    <input type="hidden" id="medical_general_id" name="medical_general_id" value="{{ isset($general_arr_data['id'])?$general_arr_data['id']:'' }}">
    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
    <script>
        var medical_general_id  = $("#medical_general_id").val();
        var $enc_patient_id         = $("#enc_patient_id").val();
        $(document).ready(function(){

            /*-------general medication section starts-------*/
            // show edit form on edit click and hide show data
            $('#edit_general_medical_form').click(function(){
                $('#edit_general').show();
                $('#show_general').hide();

                $('#save_general_medical_div').show();
                $('#cancel_general_medical_div').show();
                $('#edit_general_medical_div').hide();
            });
            $('#btn_cancel_general_medical_form').click(function(){
                $('#show_general').show();
                $('#edit_general').hide();

                $('#edit_general_medical_div').show();
                $('#save_general_medical_div').hide();
                $('#cancel_general_medical_div').hide();
            });
            // show view data on save button click and hide edit form
            $('#btn_save_general_medical_form').click(function(){
                var allergies = $('#allergies').val();

                $('#show_general').show();
                $('#edit_general').hide();

                $('#edit_general_medical_div').show();
                $('#save_general_medical_div').hide();
                $('#cancel_general_medical_div').hide();
            });

            // edit general medication form
            $('.arr_edit_general_health').click(function(){
                var get_edit_general_name  = $(this).data("get_edit_general_name");
                var edit_general_name      = $('#edit_'+get_edit_general_name).is(':checked');

                if(edit_general_name == 'true')
                {
                    $('.edit_'+get_edit_general_name+'_details').show();
                }
                else if(edit_general_name == 'false')
                {
                    $('.edit_'+get_edit_general_name+'_details').hide();
                }

                $('#edit_'+get_edit_general_name).change(function(){
                    if($(this).is(':checked'))
                    {
                        $('.edit_'+get_edit_general_name+'_details').show();
                    }
                    else
                    {
                        $('.edit_'+get_edit_general_name+'_details').hide();
                    }
                });
            });

            $('.dynamic_general_details').change(function(){
                if($(this).is(':checked'))
                {
                    $(this).closest('li').find('.dynamic_textfield_box').show();
                }
                else
                {
                    $(this).closest('li').find('.dynamic_textfield_box').hide();
                }
            });


            $('#edit_new_general_medical_form').click(function(){
                $('#edit_new_general').show();
                $('#new_general').hide();

                $('#save_new_general_medical_div').show();
                $('#cancel_new_general_medical_div').show();
                $('#edit_new_general_medical_div').hide();
            });
            $('#btn_cancel_new_general_medical_form').click(function(){
                $('#new_general').show();
                $('#edit_new_general').hide();

                $('#edit_new_general_medical_div').show();
                $('#save_new_general_medical_div').hide();
                $('#cancel_new_general_medical_div').hide();
            });

            // for add new general medication form
            $('.edit_new_arr_general_health').click(function(){
                var general_name     = $(this).data("general_name");
                var new_general_name = $('#new_'+general_name).is(':checked');

                if(new_general_name == 'true')
                {
                    $('.new_'+general_name+'_details').show();
                }
                else if(new_general_name == 'false')
                {
                    $('.new_'+general_name+'_details').hide();
                }

                $('#new_'+general_name).change(function(){
                    if($(this).is(':checked'))
                    {
                        $('.new_'+general_name+'_details').show();
                    }
                    else
                    {
                        $('.new_'+general_name+'_details').hide();
                    }
                });
            });

            // show view data on save button click and hide edit form
            $('#btn_save_new_general_medical_form').click(function(){
                var allergies               = $('#new_allergy').is(':checked');
                var surgeries               = $('#new_surgery').is(':checked');
                var pregnancies             = $('#new_pregnancy').is(':checked');
                var family_history          = $('#new_family_history').is(':checked');
                var other                   = $('#new_other').is(':checked');
                var diabetes                = $('#new_diabetes').is(':checked');
                var heart_disease           = $('#new_heart_disease').is(':checked');
                var stroke                  = $('#new_stroke').is(':checked');
                var blood_pressure          = $('#new_blood_pressure').is(':checked');
                var high_cholesterol        = $('#new_high_cholesterol').is(':checked');
                var asthma                  = $('#new_asthma').is(':checked');
                var depression              = $('#new_depression').is(':checked');
                var arthritis               = $('#new_arthritis').is(':checked');

                var allergy_details         = $('#new_allergy_details').val();
                var surgeries_details       = $('#new_surgery_details').val();
                var pregnancy_details       = $('#new_pregnancy_details').val();
                var family_history_details  = $('#new_family_history_details').val();
                var other_details           = $('#new_other_details').val();
                var diabetes_details        = $('#new_diabetes_details').val();
                var heart_disease_details   = $('#new_heart_disease_details').val();
                var stroke_details          = $('#new_stroke_details').val();
                var blood_pressure_details  = $('#new_blood_pressure_details').val();
                var high_cholesterol_details= $('#new_high_cholesterol_details').val();
                var asthma_details          = $('#new_asthma_details').val();
                var depression_details      = $('#new_depression_details').val();
                var arthritis_details       = $('#new_arthritis_details').val();

                if(allergies == true) { allergies = 'yes'; } else { allergies = 'no'; }
                if(surgeries == true) { surgeries = 'yes'; } else { surgeries = 'no'; }
                if(pregnancies == true) { pregnancies = 'yes'; } else { pregnancies = 'no'; }
                if(family_history == true) { family_history = 'yes'; } else { family_history = 'no'; }
                if(other == true) { other = 'yes'; } else { other = 'no'; }
                if(diabetes == true) { diabetes = 'yes'; } else { diabetes = 'no'; }
                if(heart_disease == true) { heart_disease = 'yes'; } else { heart_disease = 'no'; }
                if(stroke == true) { stroke = 'yes'; } else { stroke = 'no'; }
                if(blood_pressure == true) { blood_pressure = 'yes'; } else { blood_pressure = 'no'; }
                if(high_cholesterol == true) { high_cholesterol = 'yes'; } else { high_cholesterol = 'no'; }
                if(asthma == true) { asthma = 'yes'; } else { asthma = 'no'; }
                if(depression == true) { depression = 'yes'; } else { depression = 'no'; }
                if(arthritis == true) { arthritis = 'yes'; } else { arthritis = 'no'; }


                 var card_id              = "{{ $user_details->dump_id }}"
                 var userkey              = "{{ $user_details->dump_session }}";
                 var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                 var api                  = virgil.API(VIRGIL_TOKEN);


                    var findkey = api.cards.get(card_id)
                       .then(function (cards) {

                                
                                var enc_allergy                  = allergies;
                                var enc_surgery                  = surgeries; 
                                var enc_pregnancy                = pregnancies; 
                                var enc_family_history           = family_history;
                                var enc_other                    = other;
                                var enc_diabetes                 = diabetes;
                                var enc_heart_desease            = heart_disease;
                                var enc_stroke                   = stroke;               
                                var enc_blood_pressure           = blood_pressure;
                                var enc_high_cholestrol          = high_cholesterol;
                                var enc_asthma                   = asthma; 
                                var enc_depression               = depression;
                                var enc_arthrits                 = arthritis;
                                
                                var enc_heart_desease_detail     = encrypt(api, heart_disease_details, cards);
                                var enc_surgery_details          = encrypt(api, surgeries_details, cards);
                                var enc_allergy_details          = encrypt(api, allergy_details, cards); 
                                var enc_pregnancy_details        = encrypt(api, pregnancy_details, cards);
                                var enc_family_history_details   = encrypt(api, family_history_details, cards);
                                var enc_other_details            = encrypt(api, other_details, cards);
                                var enc_diabetes_details         = encrypt(api, diabetes_details, cards);
                                var enc_stroke_details           = encrypt(api, stroke_details, cards);
                                var enc_blood_pressure_details   = encrypt(api, blood_pressure_details, cards);
                                var enc_high_cholesterol_details = encrypt(api, high_cholesterol_details, cards);
                                var enc_asthma_details           = encrypt(api, asthma_details, cards);
                                var enc_depression_details       = encrypt(api, depression_details, cards);
                                var enc_arthritis_details        = encrypt(api, arthritis_details, cards);
                                var token                        = "{{ csrf_token() }}";
                                $.ajax({
                                       url:'{{ url("/") }}/doctor/patients/medical_general/insert',
                                       type:'post',
                                       data:{
                                           _token: token,
                                           enc_patient_id:$enc_patient_id,
                                           allergies: enc_allergy,
                                           surgeries: enc_surgery,
                                           pregnancies: enc_pregnancy,
                                           family_history: enc_family_history,
                                           other: enc_other,
                                           surgeries_details: enc_surgery_details,
                                           diabetes: enc_diabetes,
                                           heart_disease: enc_heart_desease,
                                           heart_disease_details: enc_heart_desease_detail,
                                           stroke: enc_stroke,
                                           blood_pressure: enc_blood_pressure,
                                           high_cholesterol: enc_high_cholestrol,
                                           asthma: enc_asthma,
                                           depression: enc_depression,
                                           arthritis: enc_arthrits,
                                           allergy_details: enc_allergy_details,
                                           pregnancy_details: enc_pregnancy_details,
                                           family_history_details: enc_family_history_details,
                                           other_details: enc_other_details,
                                           diabetes_details: enc_diabetes_details,
                                           stroke_details: enc_stroke_details,
                                           blood_pressure_details: enc_blood_pressure_details,
                                           high_cholesterol_details: enc_high_cholesterol_details,
                                           asthma_details: enc_asthma_details,
                                           depression_details: enc_depression_details,
                                           arthritis_details: enc_arthritis_details
                                       },
                                       success:function(data){
                                            $("#add_new_condition .modal-close").click()
                                            $(".open_popup").click();
                                            $('.flash_msg_text').html(data.msg);
                                       }
                                    });

                    }).then(null, function (error) {
                        $(".open_popup").click();
                        $('.flash_msg_text').html(error);
                        return false;
                    });
                    $('#new_general').show();
                    $('#edit_new_general').hide();

                    $('#edit_new_general_medical_div').show();
                    $('#save_new_general_medical_div').hide();
                    $('#cancel_new_general_medical_div').hide();

            });

            $('.bt_submit_general_medical_form').click(function(){
                var allergies               = $('#edit_allergy').is(':checked');
                var surgeries               = $('#edit_surgery').is(':checked');
                var pregnancies             = $('#edit_pregnancy').is(':checked');
                var family_history          = $('#edit_family_history').is(':checked');
                var other                   = $('#edit_other').is(':checked');
                var diabetes                = $('#edit_diabetes').is(':checked');
                var heart_disease           = $('#edit_heart_disease').is(':checked');
                var stroke                  = $('#edit_stroke').is(':checked');
                var blood_pressure          = $('#edit_blood_pressure').is(':checked');
                var high_cholesterol        = $('#edit_high_cholesterol').is(':checked');
                var asthma                  = $('#edit_asthma').is(':checked');
                var depression              = $('#edit_depression').is(':checked');
                var arthritis               = $('#edit_arthritis').is(':checked');

                var allergy_details         = $('#edit_allergy_details').val();
                var surgeries_details       = $('#edit_surgery_details').val();
                var pregnancy_details       = $('#edit_pregnancy_details').val();
                var family_history_details  = $('#edit_family_history_details').val();
                var other_details           = $('#edit_other_details').val();
                var diabetes_details        = $('#edit_diabetes_details').val();
                var heart_disease_details   = $('#edit_heart_disease_details').val();
                var stroke_details          = $('#edit_stroke_details').val();
                var blood_pressure_details  = $('#edit_blood_pressure_details').val();
                var high_cholesterol_details= $('#edit_high_cholesterol_details').val();
                var asthma_details          = $('#edit_asthma_details').val();
                var depression_details      = $('#edit_depression_details').val();
                var arthritis_details       = $('#edit_arthritis_details').val();

                if(allergies == true) { allergies = 'yes'; } else { allergies = 'no'; }
                if(surgeries == true) { surgeries = 'yes'; } else { surgeries = 'no'; }
                if(pregnancies == true) { pregnancies = 'yes'; } else { pregnancies = 'no'; }
                if(family_history == true) { family_history = 'yes'; } else {  family_history = 'no'; }
                if(other == true) { other = 'yes'; } else { other = 'no'; }
                if(diabetes == true) { diabetes = 'yes'; } else { diabetes = 'no'; }
                if(heart_disease == true) { heart_disease = 'yes'; } else { heart_disease = 'no'; }
                if(stroke == true) { stroke = 'yes'; } else { stroke = 'no'; }
                if(blood_pressure == true) { blood_pressure = 'yes'; } else { blood_pressure = 'no'; }
                if(high_cholesterol == true) { high_cholesterol = 'yes'; } else { high_cholesterol = 'no'; }
                if(asthma == true) { asthma = 'yes'; } else { asthma = 'no'; }
                if(depression == true) { depression = 'yes'; } else { depression = 'no'; }
                if(arthritis == true) { arthritis = 'yes'; } else { arthritis = 'no'; }

                var dyn_arr = [];
                dyn_status = '';
                dyn_desc = '';
                dyn_id = '';

                var card_id              = "{{ $user_details->dump_id }}"
                var userkey              = "{{ $user_details->dump_session }}";
                var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                var api                  = virgil.API(VIRGIL_TOKEN);


                var findkey = api.cards.get(card_id)
                   .then(function (cards) {

                            $('.dynamic_general_details').each(function(){
                                 if($(this).is(':checked'))
                                 {
                                    dyn_status = 'yes';
                                    dyn_desc = $(this).closest('li').find('textarea').val();
                                 }
                                 else
                                 {
                                    dyn_status = 'no';
                                    dyn_desc = '';
                                 }

                                 if(dyn_desc != ""){
                                    dyn_desc = encrypt(api, dyn_desc, cards);
                                    dyn_id = $(this).attr('data-id');
                                    dyn_arr.push(dyn_id+'_'+dyn_status+'_'+dyn_desc);
                                 }


                            });
                            var enc_heart_desease_detail = enc_surgery_details = enc_allergy_details = enc_pregnancy_details = enc_family_history_details = enc_other_details = enc_diabetes_details = enc_stroke_details = enc_blood_pressure_details = enc_high_cholesterol_details = enc_asthma_details = enc_depression_details = enc_arthritis_details = '';

                            var enc_allergy                  = allergies;
                            var enc_surgery                  = surgeries; 
                            var enc_pregnancy                = pregnancies; 
                            var enc_family_history           = family_history;
                            var enc_other                    = other;
                            var enc_diabetes                 = diabetes;
                            var enc_heart_desease            = heart_disease;
                            var enc_stroke                   = stroke;               
                            var enc_blood_pressure           = blood_pressure;
                            var enc_high_cholestrol          = high_cholesterol;
                            var enc_asthma                   = asthma; 
                            var enc_depression               = depression;
                            var enc_arthrits                 = arthritis;
                            
                            var enc_heart_desease_detail     = encrypt(api, heart_disease_details, cards);
                            var enc_surgery_details          = encrypt(api, surgeries_details, cards);
                            var enc_allergy_details          = encrypt(api, allergy_details, cards); 
                            var enc_pregnancy_details        = encrypt(api, pregnancy_details, cards);
                            var enc_family_history_details   = encrypt(api, family_history_details, cards);
                            var enc_other_details            = encrypt(api, other_details, cards);
                            var enc_diabetes_details         = encrypt(api, diabetes_details, cards);
                            var enc_stroke_details           = encrypt(api, stroke_details, cards);
                            var enc_blood_pressure_details   = encrypt(api, blood_pressure_details, cards);
                            var enc_high_cholesterol_details = encrypt(api, high_cholesterol_details, cards);
                            var enc_asthma_details           = encrypt(api, asthma_details, cards);
                            var enc_depression_details       = encrypt(api, depression_details, cards);
                            var enc_arthritis_details        = encrypt(api, arthritis_details, cards);

                            var token                        = "{{ csrf_token() }}";

                            $.ajax({
                                   url:'{{ url("/") }}/doctor/patients/medical_general/update',
                                   type:'post',
                                   data:{
                                       _token: token,
                                       enc_patient_id:$enc_patient_id,
                                       medical_general_id:medical_general_id,
                                       allergies: enc_allergy,
                                       surgeries: enc_surgery,
                                       pregnancies: enc_pregnancy,
                                       family_history: enc_family_history,
                                       other: enc_other,
                                       surgeries_details: enc_surgery_details,
                                       diabetes: enc_diabetes,
                                       heart_disease: enc_heart_desease,
                                       heart_disease_details: enc_heart_desease_detail,
                                       stroke: enc_stroke,
                                       blood_pressure: enc_blood_pressure,
                                       high_cholesterol: enc_high_cholestrol,
                                       asthma: enc_asthma,
                                       depression: enc_depression,
                                       arthritis: enc_arthrits,
                                       allergy_details: enc_allergy_details,
                                       pregnancy_details: enc_pregnancy_details,
                                       family_history_details: enc_family_history_details,
                                       other_details: enc_other_details,
                                       diabetes_details: enc_diabetes_details,
                                       stroke_details: enc_stroke_details,
                                       blood_pressure_details: enc_blood_pressure_details,
                                       high_cholesterol_details: enc_high_cholesterol_details,
                                       asthma_details: enc_asthma_details,
                                       depression_details: enc_depression_details,
                                       arthritis_details: enc_arthritis_details,
                                       dyn_arr:dyn_arr
                                   },
                                   success:function(data){
                                        $("#add_new_condition .modal-close").click()
                                        $(".open_popup").click();
                                        $('.flash_msg_text').html(data.msg);
                                        setTimeout(
                                           function() 
                                           {
                                               //location.reload();
                                           }, 2000);
                                   }
                                });

                }).then(null, function (error) {
                    $(".open_popup").click();
                    $('.flash_msg_text').html(error);
                    return false;
                });

            });

            $('#add_new_general_condition').click(function(){
                var condition_title         = $('#condition_title').val();
                var condition_description   = $('#condition_description').val();

                if(condition_title == '')
                {
                    $('#err_condition_title').show();
                    $('#err_condition_title').html('Please enter Title.');
                    $('#err_condition_title').fadeOut(4000);
                    $('#condition_title').focus();
                    return false;
                }
                else if(condition_description == '')
                {
                    $('#err_condition_description').show();
                    $('#err_condition_description').html('Please enter Description.');
                    $('#err_condition_description').fadeOut(4000);
                    $('#condition_description').focus();
                    return false;
                }
                else
                {
                    /*var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:'{{ url("/") }}/doctor/patients/medical_condition/add',
                        type:'POST',
                        dataType:'json',
                        data:{_token:token, enc_patient_id:$enc_patient_id, medical_general_id:medical_general_id, title:condition_title, description:condition_description},
                        success:function(res){
                            if(res.status)
                            {
                                $("#add_new_condition .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(res.msg);
                            }
                        }
                    });*/

                      var card_id              = "{{ $user_details->dump_id }}"
                      var userkey              = "{{ $user_details->dump_session }}";
                      var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                      var api                  = virgil.API(VIRGIL_TOKEN);

                      var findkey = api.cards.get(card_id)
                         .then(function (cards) {

                                  var enc_condition_description            = encrypt(api, condition_description, cards);
                                  var token = "<?php echo csrf_token(); ?>";
                                   $.ajax({
                                       url:'{{ url("/") }}/doctor/patients/medical_condition/add',
                                       type:'POST',
                                       dataType:'json',
                                       data:{_token:token, enc_patient_id:$enc_patient_id, medical_general_id:medical_general_id, title:condition_title, description:enc_condition_description},
                                       success:function(res){
                                           if(res.status)
                                           {
                                               $("#add_new_condition .modal-close").click()
                                               $(".open_popup").click();
                                               $('.flash_msg_text').html(res.msg);
                                           }
                                       }
                                   });

                      }).then(null, function (error) {
                          $(".open_popup").click();
                          $('.flash_msg_text').html(error);
                          return false;
                      });
                }

            });

            $('.modal-close').click(function(){
                $('#condition_title').val('');
                $('#condition_description').val('');

                $('#condition_title').next('label').removeClass('active');
                $('#condition_description').next('label').removeClass('active');
            });

            //delete dynamic general 
            $(".del_dynamic_general").click(function(){
                var dynamic_general_id = $(this).attr("data-dynamic_general_id");
                $("#get_dynamic_general_id").val(dynamic_general_id);
                $("#delete_dynamic_pop").click();
            });

            $("#confirm_delete_dynamic_general").click(function(){
                var dynamic_general_id = $("#get_dynamic_general_id").val();
                if(dynamic_general_id != "")
                {
                    var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:'{{ url("/") }}/doctor/patients/medical_general/delete',
                        type:'POST',
                        dataType:'json',
                        data:{ _token:token, enc_patient_id:$enc_patient_id, medical_general_id:medical_general_id, dynamic_general_id:dynamic_general_id },
                        success:function(res){
                            if(res.status)
                            {
                                $("#open_delete_dynamic_pop .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(res.msg);
                            }
                        }
                    });
                }
            });
            /*-------general medication section ends-------*/


            /*-------lifestyle medication section starts-------*/
            // show edit form on edit click and hide show data
            $('#edit_lifestyle_medical_form').click(function(){
                $('#edit_lifestyle').show();
                $('#show_lifestyle').hide();

                $('#save_lifestyle_medical_div').show();
                $('#cancel_lifestyle_medical_div').show();
                $('#edit_lifestyle_medical_div').hide();
            });
            // show view data on save button click and hide edit form
            $('#btn_save_lifestyle_medical_form').click(function(){
                /*$('#show_lifestyle').show();
                $('#edit_lifestyle').hide();

                $('#edit_lifestyle_medical_div').show();
                $('#save_lifestyle_medical_div').hide();*/
            });
            $('#btn_cancel_lifestyle_medical_form').click(function(){
                $('#show_lifestyle').show();
                $('#edit_lifestyle').hide();

                $('#edit_lifestyle_medical_div').show();
                $('#save_lifestyle_medical_div').hide();
                $('#cancel_lifestyle_medical_div').hide();
            });

            $('#btn_save_lifestyle_medical_form').click(function(){
                var lifestyle_id        = $('#txt_lifestyle_id').val();
                var physical_activities = $('#cmb_physical_activities').val();
                var food_habits         = $('#cmb_food_habits').val();
                var smoking             = $('#cmb_smoking').val();
                var alcohol             = $('#cmb_alcohol').val();
                var stress_levels       = $('#cmb_stress_levels').val();
                var average_sleep       = $('#cmb_average_sleep').val();
                var other               = $('#text_lifestyle_other').val();
                
                if(physical_activities == '')
                {
                    $('#err_cmb_physical_activities').show();
                    $('#err_cmb_physical_activities').html('Please enter Physical Activities.');
                    $('#err_cmb_physical_activities').fadeOut(4000);
                    $('#cmb_physical_activities').focus();
                    return false;
                }
                else if(food_habits == '')
                {
                    $('#err_cmb_food_habits').show();
                    $('#err_cmb_food_habits').html('Please enter Food Habits.');
                    $('#err_cmb_food_habits').fadeOut(4000);
                    $('#cmb_food_habits').focus();
                    return false;
                }
                else if(smoking == '')
                {
                    $('#err_cmb_smoking').show();
                    $('#err_cmb_smoking').html('Please enter Smoking habit.');
                    $('#err_cmb_smoking').fadeOut(4000);
                    $('#cmb_smoking').focus();
                    return false;
                }
                else if(alcohol == '')
                {
                    $('#err_cmb_alcohol').show();
                    $('#err_cmb_alcohol').html('Please enter Alcohol habits.');
                    $('#err_cmb_alcohol').fadeOut(4000);
                    $('#cmb_alcohol').focus();
                    return false;
                }
                else if(stress_levels == '')
                {
                    $('#err_cmb_stress_levels').show();
                    $('#err_cmb_stress_levels').html('Please enter Stress levbel.');
                    $('#err_cmb_stress_levels').fadeOut(4000);
                    $('#cmb_stress_levels').focus();
                    return false;
                }
                else if(average_sleep == '')
                {
                    $('#err_cmb_average_sleep').show();
                    $('#err_cmb_average_sleep').html('Please enter Average Sleep.');
                    $('#err_cmb_average_sleep').fadeOut(4000);
                    $('#cmb_average_sleep').focus();
                    return false;
                }
                else if(other == '')
                {
                    $('#err_text_lifestyle_other').show();
                    $('#err_text_lifestyle_other').html('Please enter Other lifestyle.');
                    $('#err_text_lifestyle_other').fadeOut(4000);
                    $('#text_lifestyle_other').focus();
                    return false;
                }
                else
                {
                      var card_id              = "{{ $user_details->dump_id }}"
                      var userkey              = "{{ $user_details->dump_session }}";
                      var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                      var api                  = virgil.API(VIRGIL_TOKEN);

                      var findkey = api.cards.get(card_id)
                         .then(function (cards) {


                                  var enc_physical_activity     = encrypt(api, physical_activities, cards);
                                  var enc_food_habit            = encrypt(api, food_habits, cards);
                                  var enc_smoking               = encrypt(api, smoking, cards);
                                  var enc_alcohol               = encrypt(api, alcohol, cards);
                                  var enc_stress_level          = encrypt(api, stress_levels, cards);
                                  var enc_average_sleep         = encrypt(api, average_sleep, cards);
                                  var enc_other_lifestyle       = encrypt(api, other, cards);

                                    var token = "<?php echo csrf_token(); ?>";
                                    $.ajax({
                                        url:'{{ url("/") }}/doctor/patients/medical_condition/update_lifestyle',
                                        type:'POST',
                                        dataType:'json',
                                        data:{_token:token,
                                               enc_patient_id:$enc_patient_id,
                                               medical_general_id:medical_general_id,
                                               lifestyle_id:lifestyle_id,
                                               physical_activities:enc_physical_activity,
                                               food_habits:enc_food_habit,
                                               smoking:enc_smoking,
                                               alcohol:enc_alcohol,
                                               stress_levels:enc_stress_level,
                                               average_sleep:enc_average_sleep,
                                               other:enc_other_lifestyle},
                                        success:function(res){
                                            if(res.status)
                                            {
                                                $("#add_new_condition .modal-close").click()
                                                $(".open_popup").click();
                                                $('.flash_msg_text').html(res.msg);
                                                setTimeout(
                                                   function() 
                                                   {
                                                       location.reload();
                                                   }, 2000);
                                            }
                                        }
                                    });

                                    $('#show_lifestyle').show();
                                    $('#edit_lifestyle').hide();
                                    $('#edit_lifestyle_medical_div').show();
                                    $('#save_lifestyle_medical_div').hide();
                                    $('#cancel_lifestyle_medical_div').hide();   

                      }).then(null, function (error) {
                          $(".open_popup").click();
                          $('.flash_msg_text').html(error);
                          return false;
                      });
                }
            });
            /*-------lifestyle medication section ends-------*/


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

        });
    </script>
<script>
    $(document).ready(function(){
        
        var page       = 'medical_history';
        var token      = "<?php echo csrf_token(); ?>";
        var url        = "<?php echo $module_url_path; ?>";
        var patient_id = $('#enc_patient_id').val();
        $.ajax({
           url:url+'/patients/patient_history/view',
           type:'post',
           data:{ page:page,patient_id:patient_id,_token:token},
           success:function(data){
              //alert(data);
           }
        }); 

        $('.file_download').click(function(){
            var token            =  "<?php echo csrf_token(); ?>";
            var url              =  "<?php echo $module_url_path; ?>";
            var patient_id       =  $('#enc_patient_id').val();
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

    });
</script>


<script type="text/javascript">
//Generate MEdical PDF
    var _token = '{{csrf_token()}}';
    $('#btn_download_pdf').click(function(){
        $.ajax({
               url:"{{$module_url_path}}/patients/medical_history/download/{{$enc_patient_id}}",
               type:'get',
               success:function(response){
                  if(response!='')
                  {
                    //Personal Information
                    if(response.patient_arr.patientinfo.phone_no != "")
                    {
                        var dec_phone_no = key.decrypt(response.patient_arr.patientinfo.phone_no).toString();
                        response.patient_arr.patientinfo.dec_phone_no = dec_phone_no;
                    }

                    if(response.patient_arr.patientinfo.suburb != "")
                    {
                        var dec_suburb = key.decrypt(response.patient_arr.patientinfo.suburb).toString();
                        response.patient_arr.patientinfo.dec_suburb = dec_suburb;
                    }

                    //General Information
                    if(response.general_arr_data.allergy_details != "")
                    {
                        var dec_allergy_details = key.decrypt(response.general_arr_data.allergy_details).toString();
                        response.general_arr_data.dec_allergy_details = dec_allergy_details;
                    }

                    if(response.general_arr_data.arthritis_details != "")
                    {
                        var dec_arthritis_details = key.decrypt(response.general_arr_data.arthritis_details).toString();
                        response.general_arr_data.dec_arthritis_details = dec_arthritis_details;
                    }

                    if(response.general_arr_data.asthma_details != "")
                    {
                        var dec_asthma_details = key.decrypt(response.general_arr_data.asthma_details).toString();
                        response.general_arr_data.dec_asthma_details = dec_asthma_details;
                    }

                    if(response.general_arr_data.blood_pressure_details != "")
                    {
                        var dec_blood_pressure_details = key.decrypt(response.general_arr_data.blood_pressure_details).toString();
                        response.general_arr_data.dec_blood_pressure_details = dec_blood_pressure_details;
                    }

                    if(response.general_arr_data.depression_details != "")
                    {
                        var dec_depression_details = key.decrypt(response.general_arr_data.depression_details).toString();
                        response.general_arr_data.dec_depression_details = dec_depression_details;
                    }

                    if(response.general_arr_data.diabetes_details != "")
                    {
                        var dec_diabetes_details = key.decrypt(response.general_arr_data.diabetes_details).toString();
                        response.general_arr_data.dec_diabetes_details = dec_diabetes_details;
                    }

                    if(response.general_arr_data.family_history_details != "")
                    {
                        var dec_family_history_details = key.decrypt(response.general_arr_data.family_history_details).toString();
                        response.general_arr_data.dec_family_history_details = dec_family_history_details;
                    }

                    if(response.general_arr_data.heart_disease_details != "")
                    {
                        var dec_heart_disease_details = key.decrypt(response.general_arr_data.heart_disease_details).toString();
                        response.general_arr_data.dec_heart_disease_details = dec_heart_disease_details;
                    }

                    if(response.general_arr_data.high_cholesterol_details != "")
                    {
                        var dec_high_cholesterol_details = key.decrypt(response.general_arr_data.high_cholesterol_details).toString();
                        response.general_arr_data.dec_high_cholesterol_details = dec_high_cholesterol_details;
                    }

                    if(response.general_arr_data.other_details != "")
                    {
                        var dec_other_details = key.decrypt(response.general_arr_data.other_details).toString();
                        response.general_arr_data.dec_other_details = dec_other_details;
                    }

                    if(response.general_arr_data.pregnancy_complication_details != "")
                    {
                        var dec_pregnancy_complication_details = key.decrypt(response.general_arr_data.pregnancy_complication_details).toString();
                        response.general_arr_data.dec_pregnancy_complication_details = dec_pregnancy_complication_details;
                    }

                    if(response.general_arr_data.pregnancy_details != "")
                    {
                        var dec_pregnancy_details = key.decrypt(response.general_arr_data.pregnancy_details).toString();
                        response.general_arr_data.dec_pregnancy_details = dec_pregnancy_details;
                    }

                    if(response.general_arr_data.stroke_details != "")
                    {
                        var dec_stroke_details = key.decrypt(response.general_arr_data.stroke_details).toString();
                        response.general_arr_data.dec_stroke_details = dec_stroke_details;
                    }

                    if(response.general_arr_data.surgery_details != "")
                    {
                        var dec_surgery_details = key.decrypt(response.general_arr_data.surgery_details).toString();
                        response.general_arr_data.dec_surgery_details = dec_surgery_details;
                    }

                    //Dynamic general information
                    $.each(response.dynamic_general_data,function(index,value){
                        if(value.description!='')
                        {
                            var dec_description = key.decrypt(value.description).toString();
                            response.dynamic_general_data[index].dec_description = dec_description;   
                        }
                    });

                    //Life Style information
                    if(response.lifestyle_arr_data.alcohol != "")
                    {
                        var dec_alcohol = key.decrypt(response.lifestyle_arr_data.alcohol).toString();
                        response.lifestyle_arr_data.dec_alcohol = dec_alcohol;
                    }

                    if(response.lifestyle_arr_data.average_sleep != "")
                    {
                        var dec_average_sleep = key.decrypt(response.lifestyle_arr_data.average_sleep).toString();
                        response.lifestyle_arr_data.dec_average_sleep = dec_average_sleep;
                    }

                    if(response.lifestyle_arr_data.food_habit != "")
                    {
                        var dec_food_habit = key.decrypt(response.lifestyle_arr_data.food_habit).toString();
                        response.lifestyle_arr_data.dec_food_habit = dec_food_habit;
                    }

                    if(response.lifestyle_arr_data.other_lifestyle != "")
                    {
                        var dec_other_lifestyle = key.decrypt(response.lifestyle_arr_data.other_lifestyle).toString();
                        response.lifestyle_arr_data.dec_other_lifestyle = dec_other_lifestyle;
                    }

                    if(response.lifestyle_arr_data.physical_activity != "")
                    {
                        var dec_physical_activity = key.decrypt(response.lifestyle_arr_data.physical_activity).toString();
                        response.lifestyle_arr_data.dec_physical_activity = dec_physical_activity;
                    }

                    if(response.lifestyle_arr_data.smoking != "")
                    {
                        var dec_smoking = key.decrypt(response.lifestyle_arr_data.smoking).toString();
                        response.lifestyle_arr_data.dec_smoking = dec_smoking;
                    }

                    if(response.lifestyle_arr_data.stress_level != "")
                    {
                        var dec_stress_level = key.decrypt(response.lifestyle_arr_data.stress_level).toString();
                        response.lifestyle_arr_data.dec_stress_level = dec_stress_level;
                    }

                    //Medication Information
                    $.each(response.medication_arr_data,function(index,value){
                        if(value.active_ingredient!='')
                        {
                            var dec_active_ingredient = key.decrypt(value.active_ingredient).toString();
                            response.medication_arr_data[index].dec_active_ingredient = dec_active_ingredient;   
                        }

                        if(value.medication_duration!='')
                        {
                            var dec_medication_duration = key.decrypt(value.medication_duration).toString();
                            response.medication_arr_data[index].dec_medication_duration = dec_medication_duration;   
                        }

                        if(value.medication_name!='')
                        {
                            var dec_medication_name = key.decrypt(value.medication_name).toString();
                            response.medication_arr_data[index].dec_medication_name = dec_medication_name;   
                        }

                        if(value.medication_purpose!='')
                        {
                            var dec_medication_purpose = key.decrypt(value.medication_purpose).toString();
                            response.medication_arr_data[index].dec_medication_purpose = dec_medication_purpose;   
                        }
                    });
                    

                    $.ajax({
                       url:"{{$module_url_path}}/patients/generate_medical_history_pdf_download",
                       type:'post',
                       data:{'arr_data' : response,'_token' : _token},
                       success:function(data_response){
                            pdf_url = "{{$module_url_path}}/patients/generate_medical_history_pdf_download";
                            window.open(pdf_url, '_blank');
                       }

                    });
                        
                  }
               }
            });
    });    
</script>

@endsection