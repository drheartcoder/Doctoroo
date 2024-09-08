    <div class="mar300  has-header minhtnor">
        <div id="patient" class="tab-content medi ">
            <div class="doctor-container">
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
                                                if(isset($patient_details['userinfo']['profile_image']) && !empty($patient_details['userinfo']['profile_image']) && File::exists($profile_img_base_path.$patient_details['userinfo']['profile_image']))
                                                {
                                                   $src = $profile_img_public_path.$patient_details['userinfo']['profile_image'];
                                                }
                                                else
                                                {
                                                   $src = $profile_img_public_path.'default-image.jpeg';
                                                }  
                                            @endphp
                                            <img src="{{$src}}" alt="" class="circle" /></span>
                                            <h2 class="center-align" style="margin: 0;">Patient Details</h2>
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
                                                    <strong class="grey-text">First Name: </strong> {{isset($patient_details['userinfo']['first_name']) ? $patient_details['userinfo']['first_name'] : '' }} 
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Last Name: </strong> {{isset($patient_details['userinfo']['last_name']) ? $patient_details['userinfo']['last_name'] : '' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col m6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Date of Birth: </strong> {{isset($patient_details['date_of_birth']) ? date('d F, Y', strtotime($patient_details['date_of_birth'])) : '-' }}
                                                </label>
                                            </div>
                                            <div class="col l6 s6 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Gender: </strong> {{isset($patient_details['gender'] ) && $patient_details['gender'] == 'F' ? 'Female' : '' }}
                                                    {{isset($patient_details['gender'] ) && $patient_details['gender'] == 'M' ? 'Male' : '' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Phone No.:  </strong> {{isset($patient_details['phone_no']) ? $patient_details['phone_no'] : '-' }}
                                                </label>
                                            </div>
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Mobile No.:  </strong> {{isset($patient_details['mobile_no']) ? $patient_details['mobile_no'] : '-' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row martp">
                                            <div class="col s12">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Address:  </strong>  {{isset($patient_details['suburb']) ? $patient_details['suburb'] : '-' }}
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
                                        <div class="row">
                                            <div class="col l6 s12 martp posrel">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Medicare No.: </strong> 2547 2577 2545 4524
                                                </label>
                                            </div>
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">IRN: </strong> 2
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Pension HCC No.: </strong> 987654321
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">Safety Net No.: </strong> 988453211
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col l6 s12 martp">
                                                <label class="doc-details">
                                                    <strong class="grey-text">DVA No.: </strong> 9885522
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 posrel">
                            <div class="heading-round-box">Regular Family Doctor</div>
                            <div class="green-border round-box-content  max-height">
                                <div class="text-content">
                                    <ul class="collection brdrtopsd ">
                                        @if(isset($patient_details['familydoctor']) && !empty($patient_details['familydoctor']))
                                        @foreach($patient_details['familydoctor'] as $doctor)
                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="doc-detail wid90 left">
                                                <span class="title"> Dr. {{isset($doctor['first_name']) ? $doctor['first_name'] : ''}} {{isset($doctor['last_name']) ? $doctor['last_name'] : ''}}
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                        @else
                                         <h5 class="center-align">No Doctor added yet</h5>
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
                            <div class="heading-round-box">Regular Click &amp; Collect Pharmacies</div>
                            <div class="green-border round-box-content max-height">
                                <div class="text-content">
                                    <ul class="collection brdrtopsd ">
                                    @if(isset($pharmacy_data) && !empty($pharmacy_data))
                                        @foreach($pharmacy_data as $ph_data)
                                            <li class="collection-item avatar valign-wrapper">
                                                <div class="doc-detail-location left">
                                                    <span class="title truncate"> {{ $ph_data['pharmacy_user_details']['title'].' '.$ph_data['pharmacy_user_details']['first_name'].' '.$ph_data['pharmacy_user_details']['last_name'] }}
                                                    </span>
                                                    <small>
                                                        {{ $ph_data['pharmacy_details']['address1'].' '.$ph_data['pharmacy_details']['address2'] }}
                                                    </small>
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                        @endforeach
                                    @else
                                       <h5 class="center-align">No Data Found</h5> 
                                    @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
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
                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="doc-detail wid90 left">
                                                <span class="title"> {{ isset($val['doctor_user_details']['title']) ? $val['doctor_user_details']['title'] : '' }} {{ isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : '' }} {{ isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : '' }}
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                        @else
                                            <h5 class="center-align">No Data Found</h5>
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
                                    @if(isset($patient_details['memberfamily']))
                                        @foreach($patient_details['memberfamily'] as $member)
                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="doc-detail wid90 left">
                                                <span class="title">{{isset($member['first_name']) ? $member['first_name'] : ''}} {{isset($member['last_name']) ? $member['last_name'] : ''}}
                                                </span>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                        @else
                                         <h5 class="center-align">No Member added yet</h5>
                                        @endif
                                    </ul>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
    </div>
    
    
