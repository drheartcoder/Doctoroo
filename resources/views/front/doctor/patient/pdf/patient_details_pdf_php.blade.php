<table width="100%" cellspacing="0" cellpadding="0px" style="max-width: 800px; font-size:11pt; font-family:Arial, Helvetica, sans-serif; line-height:16pt; color:#333; text-align:justify;">
    <tr>
        <td style="padding-bottom: 30px;" align="left">
            <table width="100%" cellspacing="0" cellpadding="10">
                <tr style="font-size:11pt;">
                    <td width="50%" valign="middle">
                        <h4 style="font-size: 15pt; font-weight: bold; margin: 0 0 10px; padding: 0;">PATIENT INFORMATION</h4>
                        <p><strong>Type :</strong>  
                            {{isset($patient_details['type']) && $patient_details['type']=='doctoroo' ? 'Doctoroo Patient' : ''}}  
                            {{isset($patient_details['type']) && $patient_details['type']=='myown' ? 'My own Patient' : ''}}
                        </p>
                    </td>
                    <td align="right">
                        @php 
                            $src="";
                            if(isset($patient_details['userinfo']['profile_image']) && !empty($patient_details['userinfo']['profile_image']) && File::exists($profile_img_base_path.$patient_details['userinfo']['profile_image']))
                            {
                               //$src = $profile_img_public_path.$patient_details['userinfo']['profile_image'];
                               $src = 'file:///'.$profile_img_base_path.$patient_details['userinfo']['profile_image'];
                            }
                            else
                            {
                               //$src = $profile_img_public_path.'default-image.jpeg';
                               $src = 'file:///'.$profile_img_base_path.'default-image.jpeg';
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
                    <td width="50%"><strong>First Name :</strong> 
                        {{isset($patient_details['userinfo']['first_name']) ? $patient_details['userinfo']['first_name'] : '' }}
                    </td>
                    <td><strong>Last Name :</strong>
                        {{isset($patient_details['userinfo']['last_name']) ? $patient_details['userinfo']['last_name'] : '' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Date of Birth :</strong> {{isset($patient_details['date_of_birth']) ? date('d F, Y', strtotime($patient_details['date_of_birth'])) : '-' }}
                    </td>
                    <td><strong>Gender :</strong> 
                        {{isset($patient_details['gender'] ) && $patient_details['gender'] == 'F' ? 'Female' : '' }}
                        {{isset($patient_details['gender'] ) && $patient_details['gender'] == 'M' ? 'Male' : '' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td><strong>Phone No. :</strong> 
                        {{isset($patient_details['dec_phone_no']) ? $patient_details['dec_phone_no'] : '-' }}
                    </td>
                    <td><strong>Mobile No. :</strong>  
                        {{isset($patient_details['mobile_no']) ? decrypt_value($patient_details['mobile_no']) : '-' }}
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td colspan="2"><strong>Address :</strong> 
                        {{isset($patient_details['dec_suburb']) ? $patient_details['dec_suburb'] : '-' }}
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
                        <strong>Entitlement</strong>
                    </td>
                </tr>
                @if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
                    @foreach($user_entitlement_arr as $entitle_val)
                        <tr style="font-size:11pt;">
                            <td width="50%"><strong>{{isset($entitle_val['user_entitlement']['entitlement']) ? $entitle_val['user_entitlement']['entitlement'] : ''}} :</strong> {{isset($entitle_val['dec_card_no']) ? $entitle_val['dec_card_no'] : '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr style="font-size:11pt;">
                        <td width="50%">
                            Not Available
                        </td>
                    </tr>
                @endif
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
                        <strong>Regular Family Doctors</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            @if(isset($patient_details['familydoctor']) && !empty($patient_details['familydoctor']))
                                @foreach($patient_details['familydoctor'] as $doctor)
                                    <li style="padding:0 0 10px; margin-left: 15px;" >
                                        {{isset($doctor['first_name']) ? $doctor['first_name'] : ''}} 
                                        {{isset($doctor['last_name']) ? $doctor['last_name'] : ''}}
                                    </li>
                                @endforeach
                            @endif
                            @if(isset($regular_doctor_arr))
                                @foreach($regular_doctor_arr as $val)
                                    <li style="padding:0 0 10px; margin-left: 15px;" >
                                        {{isset($val['title']) ? $val['title'] : ''}}
                                        {{isset($val['first_name']) ? $val['first_name'] : ''}}
                                        {{isset($val['last_name']) ? $val['last_name'] : ''}}
                                    </li>
                                @endforeach
                            @endif
                            @if(empty($patient_details[0]['familydoctor']) && empty($regular_doctor_arr))
                                 <p class="grey-text">
                                    No regular family doctor added yet.
                                </p>
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
                    <td bgcolor="#efefef">
                        <strong>Regular Click & Collect Pharmacies</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            @if(isset($pharmacy_data) && !empty($pharmacy_data))
                                @foreach($pharmacy_data as $ph_data)
                                    <li style="padding-bottom: 10px">
                                         {{ $ph_data['pharmacy_user_details']['title'].' '.$ph_data['pharmacy_user_details']['first_name'].' '.$ph_data['pharmacy_user_details']['last_name'] }}
                                        <small>
                                            {{ $ph_data['pharmacy_details']['address1'].' '.$ph_data['pharmacy_details']['address2'] }}
                                        </small>
                                    </li>
                                @endforeach
                            @else
                               <p class="grey-text">
                                    No Pharmacy added yet.
                                </p>
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
                    <td bgcolor="#efefef">
                       <strong>Previously Seen Doctoroo Doctors</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            @if(isset($previous_seen_dr) && !empty($previous_seen_dr))
                                @foreach($previous_seen_dr as $val)
                                    <li style="padding-bottom: 10px">
                                            {{ isset($val['doctor_user_details']['title']) ? $val['doctor_user_details']['title'] : '' }} {{ isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : '' }} {{ isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : '' }}
                                    </li>
                                @endforeach
                            @else
                                <p class="grey-text">
                                    No previously seen doctoroo doctor.
                                </p>
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
                    <td bgcolor="#efefef">
                       <strong>Family Members</strong>
                    </td>
                </tr>
                <tr style="font-size:11pt;">
                    <td>
                        <ul style="margin: 0 15px; padding:0;">
                            @if(isset($patient_details['memberfamily']) & !empty($patient_details['memberfamily']))
                                @foreach($patient_details['memberfamily'] as $member)
                                    <li style="padding-bottom: 10px">
                                        {{isset($member['first_name']) ? $member['first_name'] : ''}}
                                        {{isset($member['last_name']) ? $member['last_name'] : ''}}
                                    </li>
                                @endforeach
                            @else
                                <p class="grey-text">
                                    No Member added yet.
                                </p>
                            @endif
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
