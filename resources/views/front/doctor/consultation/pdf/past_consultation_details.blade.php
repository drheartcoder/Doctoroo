<table width="100%" cellspacing="0" cellpadding="0px" style="max-width: 800px; font-size:11pt; font-family:Arial, Helvetica, sans-serif; line-height:16pt; color:#333; text-align:justify;">
    <tr>
        <td style="padding-bottom: 30px;" align="left">
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr style="font-size:11pt;">
                    <td width="50%" valign="middle">
                        <h4 style="font-size: 15pt; font-weight: bold; margin: 0 0 10px; padding: 0;">POST CONSULTATION</h4>
                    </td>
                    <td align="right">
                        @php 
                            $src="";
                            if(isset($past_consultation_arr['patient_user_details']['profile_image']) && !empty($past_consultation_arr['patient_user_details']['profile_image']) && File::exists($profile_img_base_path.$past_consultation_arr['patient_user_details']['profile_image']))
                            {
                               $src = $profile_img_public_path.$past_consultation_arr['patient_user_details']['profile_image'];
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
                <tr  style="font-size:11pt;">
                    <td colspan="2" bgcolor="#efefef">
                        <strong>Personal Information</strong>
                    </td>
                </tr>
            @if(isset($past_consultation_arr) && $past_consultation_arr['familiy_member_info'] == null)
                <tr style="font-size:11pt;">
                    <td width="50%"><strong>First Name :</strong> 
                        {{isset($past_consultation_arr['patient_user_details']['first_name']) ? $past_consultation_arr['patient_user_details']['first_name'] : '' }}
                    </td>
                    <td><strong>Last Name :</strong>
                        {{isset($past_consultation_arr['patient_user_details']['last_name']) ? $past_consultation_arr['patient_user_details']['last_name'] : '' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Date of Birth :</strong> {{isset($past_consultation_arr['patient_info']['date_of_birth']) ? date('dS F, Y', strtotime($past_consultation_arr['patient_info']['date_of_birth'])) : '' }}
                    </td>
                    <td><strong>Gender :</strong> 
                        {{isset($past_consultation_arr['patient_info']['gender'] ) && $past_consultation_arr['patient_info']['gender'] == 'F' ? 'Female' : '' }}
                        {{isset($past_consultation_arr['patient_info']['gender'] ) && $past_consultation_arr['patient_info']['gender'] == 'M' ? 'Male' : '' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Phone No. :</strong> 
                        {{isset($past_consultation_arr['patient_info']['dec_phone_no']) ? $past_consultation_arr['patient_info']['dec_phone_no'] : '' }}
                    </td>
                    <td><strong>Mobile No. :</strong>  
                        {{isset($past_consultation_arr['patient_info']['mobile_no']) ? decrypt_value($past_consultation_arr['patient_info']['mobile_no']) : '' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td colspan="2"><strong>Address :</strong> 
                        {{isset($past_consultation_arr['patient_info']['dec_suburb']) ? $past_consultation_arr['patient_info']['dec_suburb'] : '' }}
                    </td>
                </tr>

                @elseif(isset($past_consultation_arr['familiy_member_info']))    
                    <tr style="font-size:11pt;">
                        <td width="50%"><strong>First Name :</strong> 
                            {{isset($past_consultation_arr['familiy_member_info']['first_name']) ? $past_consultation_arr['familiy_member_info']['first_name'] : '' }}
                        </td>
                        <td><strong>Last Name :</strong>
                            {{isset($past_consultation_arr['familiy_member_info']['last_name']) ? $past_consultation_arr['familiy_member_info']['last_name'] : '' }}
                        </td>
                    </tr>
                    <tr style="font-size:11pt;">
                        <td><strong>Date of Birth :</strong> {{isset($past_consultation_arr['familiy_member_info']['date_of_birth']) ? date('dS F, Y', strtotime($past_consultation_arr['familiy_member_info']['date_of_birth'])) : '' }}
                        </td>
                        <td><strong>Gender :</strong> 
                            {{isset($past_consultation_arr['familiy_member_info']['gender'])  ? $past_consultation_arr['familiy_member_info']['gender'] : '' }}
                        </td>
                    </tr>
                    <tr style="font-size:11pt;">
                        <td><strong>Phone No. :</strong> 
                            
                        </td>
                        <td><strong>Mobile No. :</strong>  
                            {{isset($past_consultation_arr['familiy_member_info']['mobile_number']) ? $past_consultation_arr['familiy_member_info']['mobile_number'] : '' }}
                        </td>
                    </tr>
                    <tr style="font-size:11pt;">
                        <td colspan="2"><strong>Address :</strong> </td>
                    </tr>
                @endif    
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom: 30px;" align="left">
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr style="font-size:11pt;">
                    <td width="50%" valign="middle">
                        <p><strong>Consultation ID :</strong> {{isset($past_consultation_arr['consultation_id']) ? $past_consultation_arr['consultation_id'] : ''}}</p>
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
                        <strong>Consultation Details</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td width="50%"> <strong>Consulting Patient :</strong> @if(isset($past_consultation_arr) && $past_consultation_arr['familiy_member_info'] == null){{isset($past_consultation_arr['patient_user_details']['first_name']) ? $past_consultation_arr['patient_user_details']['first_name'] : ''}} {{isset($past_consultation_arr['patient_user_details']['last_name']) ? $past_consultation_arr['patient_user_details']['last_name'] : ''}}@elseif(isset($past_consultation_arr['familiy_member_info'])){{isset($past_consultation_arr['familiy_member_info']['first_name']) ? $past_consultation_arr['familiy_member_info']['first_name'] : ''}} {{isset($past_consultation_arr['familiy_member_info']['last_name']) ? $past_consultation_arr['familiy_member_info']['last_name'] : ''}}
                    @endif</td>
                    <td><strong>Status :</strong> {{isset($past_consultation_arr['booking_status']) ? $past_consultation_arr['booking_status'] : 'NA'}}  </td>
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
                        <strong>Purpose of consultation</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td width="100%"> 
                        <ul style="margin: 0 15px; padding:0;">
                            @php
                              $consultation_purpose=array(
                                                          'advice_and_treatment'      =>  'Advice & Treatment',
                                                          'prescriptions_and_repeats' =>  'Prescription or Repeat',
                                                          'medical_cetificate'        =>  'Medical Cerrificate',
                                                          'other'                     =>  'Other'
                                                          );
                              if(isset($past_consultation_arr['consultation_for']))
                              {
                                  $consultation_for = $arr_consultation_for;
                                  //$consultation_for=explode(',',$past_consultation_arr['consultation_for']);
                              }
                            @endphp
                            @foreach($consultation_purpose as $key=>$purpose)
                                @php
                                    $selected_img="";
                                    if(isset($consultation_for))
                                    {
                                        if(in_array($key, $consultation_for))
                                        {
                                            @endphp
                                            <li style="padding:0 0 10px; margin-left: 15px;"> {{$purpose}} </li>
                                            @php
                                        }                                      
                                    }
                                @endphp
                            @endforeach
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
                    <td bgcolor="#efefef">
                        <strong>Symptom/s or reason for consultation</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <p style="line-height: 16pt;">{{isset($past_consultation_arr['dec_symptoms']) && !empty($past_consultation_arr['dec_symptoms']) ? $past_consultation_arr['dec_symptoms'] : 'Not available'}} 
                        </p>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
</table>
