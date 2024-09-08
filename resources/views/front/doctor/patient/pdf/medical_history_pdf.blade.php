@php
    $general_allergy                = '';
    $general_allergy_details        = '';

    $general_surgery                = '';
    $general_surgery_details        = '';

    $general_pregnancy              = '';
    $general_pregnancy_details      = '';

    $general_family_history         = '';
    $general_family_history_details = '';

    $general_other                  = '';
    $general_other_details          = '';

    $general_diabetes               = '';
    $general_diabetes_details       = '';

    $general_heart_disease          = '';
    $general_heart_disease_details  = '';

    $general_stroke                 = '';
    $general_stroke_details         = '';

    $general_blood_pressure         = '';
    $general_blood_pressure_details = '';

    $general_high_cholesterol       = '';
    $general_high_cholesterol_details = '';

    $general_asthma                 = '';
    $general_asthma_details         = '';

    $general_depression             = '';
    $general_depression_details     = '';

    $general_arthritis              = '';
    $general_arthritis_details      = '';
@endphp

@if(isset($general_arr_data) && !empty($general_arr_data))
    @php
        $general_allergy                = isset($general_arr_data['allergy'])?$general_arr_data['allergy']:'';
        $general_allergy_details        = !empty($general_arr_data['dec_allergy_details'])?$general_arr_data['dec_allergy_details']:'';

        $general_surgery                = isset($general_arr_data['surgery'])?$general_arr_data['surgery']:'';
        $general_surgery_details        = !empty($general_arr_data['dec_surgery_details']) ?$general_arr_data['dec_surgery_details']:'';

        $general_pregnancy              = isset($general_arr_data['pregnancy'])?$general_arr_data['pregnancy']:'';
        $general_pregnancy_details      = !empty($general_arr_data['dec_pregnancy_details'])?$general_arr_data['dec_pregnancy_details']:'';

        $general_family_history         = isset($general_arr_data['family_history'])?$general_arr_data['family_history']:'';
        $general_family_history_details = !empty($general_arr_data['dec_family_history_details'])?$general_arr_data['dec_family_history_details']:'';

        $general_other                  = isset($general_arr_data['other'])?$general_arr_data['other']:'';
        $general_other_details          = !empty($general_arr_data['dec_other_details'])?$general_arr_data['dec_other_details']:'';

        $general_diabetes               = isset($general_arr_data['diabetes'])?$general_arr_data['diabetes']:'';
        $general_diabetes_details       = !empty($general_arr_data['dec_diabetes_details'])?$general_arr_data['dec_diabetes_details']:'';

        $general_heart_disease          = isset($general_arr_data['heart_disease'])?$general_arr_data['heart_disease']:'';
        $general_heart_disease_details  = !empty($general_arr_data['dec_heart_disease_details'])?$general_arr_data['dec_heart_disease_details']:'';

        $general_stroke                 = isset($general_arr_data['stroke'])?$general_arr_data['stroke']:'';
        $general_stroke_details         = !empty($general_arr_data['dec_stroke_details'])?$general_arr_data['dec_stroke_details']:'';

        $general_blood_pressure         = isset($general_arr_data['blood_pressure'])?$general_arr_data['blood_pressure']:'';
        $general_blood_pressure_details = !empty($general_arr_data['dec_blood_pressure_details'])?$general_arr_data['dec_blood_pressure_details']:'';

        $general_high_cholesterol       = isset($general_arr_data['high_cholesterol'])?$general_arr_data['high_cholesterol']:'';
        $general_high_cholesterol_details = !empty($general_arr_data['dec_high_cholesterol_details'])?$general_arr_data['dec_high_cholesterol_details']:'';

        $general_asthma                 = isset($general_arr_data['asthma'])?$general_arr_data['asthma']:'';
        $general_asthma_details         = !empty($general_arr_data['dec_asthma_details'])?$general_arr_data['dec_asthma_details']:'';

        $general_depression             = isset($general_arr_data['depression'])?$general_arr_data['depression']:'';
        $general_depression_details     = !empty($general_arr_data['dec_depression_details'])?$general_arr_data['dec_depression_details']:'';

        $general_arthritis              = isset($general_arr_data['arthritis'])?$general_arr_data['arthritis']:'';
        $general_arthritis_details      = !empty($general_arr_data['dec_arthritis_details'])?$general_arr_data['dec_arthritis_details']:'';
    @endphp
@endif
 
<table width="100%" cellspacing="0" cellpadding="0px" style="max-width: 800px; font-size:11pt; font-family:Arial, Helvetica, sans-serif; line-height:16pt; color:#333; text-align:justify;">
    <tr>
        <td style="padding-bottom: 20px; border-bottom: solid 2px #ededed;" align="left">
            <img height="50px" width="158px" src="images/color-logo.png" />
        </td>
    </tr>
    <tr>
        <td style="padding-bottom: 30px;" align="left">
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr style="font-size:11pt;">
                    <td width="50%" valign="middle">
                        <h4 style="font-size: 15pt; font-weight: bold; margin: 0 0 10px; padding: 0; text-transform: uppercase">Medical History</h4>
                        <p><strong>Type :</strong> 
                        {{isset($patient_arr['patientinfo']['type']) && $patient_arr['patientinfo']['type']=='doctoroo' ? 'Doctoroo Patient' : ''}}  
                            {{isset($patient_arr['patientinfo']['type']) && $patient_arr['patientinfo']['type']=='myown' ? 'My own Patient' : ''}}
                        </p>
                    </td>
                    <td align="right">
                        @php 
                            $src="";
                            if(isset($patient_arr['profile_image']) && !empty($patient_arr['profile_image']) && File::exists($profile_img_base_path.$patient_arr['profile_image']))
                            {
                               $src = $profile_img_public_path.$patient_arr['profile_image'];
                            }
                            else
                            {
                               $src = $profile_img_public_path.'default-image.jpeg';
                            }  
                        @endphp
                        <img height="70px" width="70px" src="{{$src}}" />
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr>
                    <td colspan="2" bgcolor="#efefef">
                        <strong>Personal Information</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td width="50%"><strong>First Name : </strong>{{isset($patient_arr['first_name']) ? $patient_arr['first_name'] : ''}}</td>
                    <td><strong>Last Name :</strong> {{isset($patient_arr['last_name']) ? $patient_arr['last_name'] : ''}} </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Date of Birth : </strong>{{isset($patient_arr['patientinfo']['date_of_birth']) ? date('dS F, Y', strtotime($patient_arr['patientinfo']['date_of_birth'])) : '-' }}</td>
                    <td><strong>Gender :</strong>{{isset($patient_arr['patientinfo']['gender']) && $patient_arr['patientinfo']['gender'] == 'M' ? 'Male' : ''}} {{isset($patient_arr['patientinfo']['gender']) && $patient_arr['patientinfo']['gender'] == 'F' ? 'Female' : ''}} </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Phone No. : </strong>{{isset($patient_arr['patientinfo']['dec_phone_no']) ? $patient_arr['patientinfo']['dec_phone_no'] : 'NA'}}</td>
                    <td><strong>Mobile No. : </strong>{{isset($patient_arr['patientinfo']['mobile_no']) ? decrypt_value($patient_arr['patientinfo']['mobile_no']) : 'NA'}} </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td colspan="2"><strong>Address : </strong>{{isset($patient_arr['patientinfo']['dec_suburb']) ? $patient_arr['patientinfo']['dec_suburb'] : 'NA'}}</td>
                </tr>

            </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr>
                    <td bgcolor="#efefef">
                        <strong>General</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            
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

                            @foreach($arr_general_health as $key_general)
                                <?php
                                    if($key_general['1'] == "yes")
                                    {
                                        ?>
                                            <li style="padding:0 0 10px; margin-left: 15px;"><strong> {{ $key_general['0'] }} </strong>
                                                <p style="line-height: 16pt;">{{ $key_general['2'] }}</p>
                                            </li>
                                        <?php
                                    }
                                ?>
                            @endforeach

                            @if(isset($dynamic_general_data) && !empty($dynamic_general_data))
                                @foreach($dynamic_general_data as $dygen_data)
                                    <li style="padding:0 0 10px; margin-left: 15px;"><strong>{{ $dygen_data['title'] }}</strong>
                                        <p style="line-height: 16pt;">{{ $dygen_data['dec_description'] }}</p>
                                    </li>
                                @endforeach
                            @endif

                            @if($general_arr_data == null && empty($general_arr_data) && empty($dynamic_general_data))
                                <li style="padding:0 0 10px; margin-left: 15px;"><strong>No Data Found</strong></li>
                            @endif
                        </ul>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr>
                    <td colspan="2" bgcolor="#efefef">
                        <strong>Lifestyle</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td width="50%"><strong>Physical Activities : </strong>{{ !empty($lifestyle_arr_data['dec_physical_activity']) ? $lifestyle_arr_data['dec_physical_activity'] : 'NA' }} </td>
                    <td><strong>Food Habbits : </strong>{{ !empty($lifestyle_arr_data['dec_food_habit'])?$lifestyle_arr_data['dec_food_habit']:'NA' }} </td>
                </tr>

                <tr style="font-size:11pt;">
                    <td width="50%"><strong>Smoking : </strong>{{ !empty($lifestyle_arr_data['dec_smoking'])?$lifestyle_arr_data['dec_smoking']:'NA' }}</td>
                    <td width="50%"><strong>Alcohol : </strong>{{ !empty($lifestyle_arr_data['dec_alcohol'])?$lifestyle_arr_data['dec_alcohol']:'NA' }}</td>
                </tr>
                <tr style="font-size:11pt;">
                    <td width="50%"><strong>Stress Levels : </strong>{{ !empty($lifestyle_arr_data['dec_stress_level'])?$lifestyle_arr_data['dec_stress_level']:'NA' }}</td>
                    <td width="50%"><strong>Average : </strong>{{ !empty($lifestyle_arr_data['dec_average_sleep'])?$lifestyle_arr_data['dec_average_sleep']:'NA' }}</td>
                </tr>
                <tr style="font-size:11pt;">
                    <td colspan="2"><strong>Others : </strong>{{ !empty($lifestyle_arr_data['dec_other_lifestyle'])?$lifestyle_arr_data['dec_other_lifestyle']:'NA' }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr>
                    <td bgcolor="#efefef">
                        <strong>Medication</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            
                            @if(isset($medication_arr_data) && !empty($medication_arr_data))
                                @foreach($medication_arr_data as $med_data)
                                    <li style="padding:0 0 10px; margin-left: 15px;"><strong>{{isset($med_data['dec_medication_name']) ? $med_data['dec_medication_name'] : 'NA'}}</strong>
                                        <p style="line-height: 16pt;"><strong>Duration :</strong>
                                        {{isset($med_data['dec_medication_duration']) ? $med_data['dec_medication_duration'] : 'NA'}}</p>
                                        <p style="line-height: 16pt;"><strong>Purpose :</strong> {{isset($med_data['dec_medication_purpose']) ? $med_data['dec_medication_purpose'] : 'NA'}}</p>
                                    </li>
                                @endforeach
                            @else
                                <li style="padding:0 0 10px; margin-left: 15px;"><strong>No Data Found</strong></li>
                            @endif
                        </ul>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
</table>



