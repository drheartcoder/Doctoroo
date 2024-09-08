<link href="{{ url('/') }}/public/new/css/doctoroo.css" rel="stylesheet" media="screen,projection" />

@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>
    
    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <script type="text/javascript">
        var card_id      = "{{ isset($doctor_arr['userinfo']['dump_id']) && !empty($doctor_arr['userinfo']['dump_id']) ? $doctor_arr['userinfo']['dump_id'] : '' }}"
        var userkey      = "{{ isset($doctor_arr['userinfo']['dump_session']) && !empty($doctor_arr['userinfo']['dump_session']) ? $doctor_arr['userinfo']['dump_session'] : '' }}";
        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(userkey);
    </script>

    <div class="has-header profile mar300">
    <div class="container">
        <div class="subheader">
            <div class="profilesumm">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            @php
                            // check listisng image
                            if ( isset($doctor_arr['userinfo']['profile_image']) && !empty($doctor_arr['userinfo']['profile_image']) )
                            {
                                $profile_images = $doctor_image_url.$doctor_arr['userinfo']['profile_image'];
                            } // end if
                            else
                            {
                                $profile_images = $doctor_image_url."default-image.jpeg";
                            } // end else

                            $doc_title          = isset($doctor_arr['userinfo']['title'])?$doctor_arr['userinfo']['title']:'';
                            $doc_first_name     = isset($doctor_arr['userinfo']['first_name'])?$doctor_arr['userinfo']['first_name']:'';
                            $doc_last_name      = isset($doctor_arr['userinfo']['last_name'])?$doctor_arr['userinfo']['last_name']:'';
                            $doc_speciality     = isset($doctor_arr['speciality'])?$doctor_arr['speciality']:'';
                            $doc_id             = isset($doctor_arr['userinfo']['id'])?$doctor_arr['userinfo']['id']:'';
                            $doc_video          = isset($doctor_arr['profile_video'])?$doctor_arr['profile_video']:'';

                            // check listisng video
                            if ( isset($doctor_arr['profile_video']) && !empty($doctor_arr['profile_video']) )
                            {
                                $profile_video = $doctor_video_url.$doctor_arr['profile_video'];
                                $folder_path   = public_path().config('app.project.img_path.doctor_video');

                                // check if video exists or not
                                if ( file_exists($folder_path.$doctor_arr['profile_video']) ) 
                                {
                                    $profile_video = $profile_video;
                                }
                                else
                                {
                                    $profile_video = $doctor_video_url."default-video.mp4";
                                }
                            }
                            else
                            {
                                $profile_video = $doctor_video_url."default-video.mp4";
                            }

                            @endphp

                            <img src="{{ $profile_images }}" class="circle left" />
                            <p>{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}
                            <small>{{ $doc_speciality }}</small></p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <iframe src="{{ $profile_video }}" frameborder="0" allowfullscreen class="videoBox responsive-video"></iframe> -->
            <video class="videoBox responsive-video" controls loop>
                <source src="{{ $profile_video }}" type="video/mp4">
                <source src="{{ $profile_video }}" type="video/ogg">
                <source src="{{ $profile_video }}" type="video/webm">
                Your browser does not support the video tag.
            </video>

        </div>

        <div class="tabli scrollspy  z-depth-4">
            <ul>
                <li class="active" style="width: 100%;">
                    <a href="{{ url('/') }}/doctor/profile_about/{{ base64_encode($doc_id) }}" class="valign-wrapper">About Me</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>

        <div class="data-content">
            <div class="tab">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active waves-effect waves-light">About Me<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body about-me-wraper">
                        <!--<ul class="blt">
                            <li><strong>Gender : </strong>{{ isset($doctor_arr['gender'])?$doctor_arr['gender']:'' }}</li>
                            <li><strong>Address : </strong>{{ isset($doctor_arr['address'])?$doctor_arr['address']:'' }}</li>
                            <li><strong>Email : </strong>{{ isset($doctor_arr['userinfo']['email'])?$doctor_arr['userinfo']['email']:'' }}</li>
                            <li><strong>Contact no. : </strong>{{ isset($doctor_arr['contact_no'])?$doctor_arr['contact_no']:'' }}</li>
                            <li><strong>Mobile no. : </strong>{{ isset($doctor_arr['mobile_no'])?$doctor_arr['mobile_no']:'' }}</li>
                            @if(isset($fees_arr['day_total_rate']) && $fees_arr['day_total_rate'] != '0')
                            <li><strong>Consultation fee(8 AM to 8 PM) : </strong>{{isset($fees_arr['day_total_rate']) ? '$'.$fees_arr['day_total_rate'] : ''}}</li>
                            @else
                                <li><strong>Consultation fee(8 AM to 8 PM) : </strong>{{isset($admin_fees_arr['fee']) ? '$'.$admin_fees_arr['fee'] : ''}}</li>
                            @endif
                            @if(isset($fees_arr['night_total_rate']) && $fees_arr['night_total_rate'] != '0')
                            <li><strong>Consultation fee(8 PM to 8 AM) : </strong>{{isset($fees_arr['night_total_rate']) ? '$'.$fees_arr['night_total_rate'] : ''}}</li>
                            @else
                                <li><strong>Consultation fee(8 AM to 8 PM) : </strong>{{isset($admin_fees_arr['fee']) ? '$'.$admin_fees_arr['fee'] : ''}}</li>
                            @endif
                            
                        </ul>-->
                        <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="content-block">
                                <label>Gender</label>
                                <div class="content">{{ isset($doctor_arr['gender'])?$doctor_arr['gender']:'' }}</div>
                            </div>
                            <div class="content-block">
                                <label>Address</label>
                                <div class="content" id="dec_address"></div>
                            </div>
                            <div class="content-block">
                                <label>Contact no.</label>
                                <div class="content" id="dec_contact_no"></div>
                            </div>
                            <div class="content-block">

                                <label>AHPRA no.</label>
                                @if(isset($doctor_arr['ahpra_registration_no']) && $doctor_arr['ahpra_registration_no'] != '')
                                 <div class="content"><a target="_blank" id="ahpra_link" href="" class="dec_ahpra_registration_no"></a></div> 
                                @else
                                 <div class="content dec_ahpra_registration_no" ></div>
                                @endif 
                                
                            </div>
                            <div class="content-block">
                                <label>ABN</label>
                                <div class="content">{{ isset($doctor_arr['abn'])?$doctor_arr['abn']:'' }}</div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="content-block">
                                <label>Medical Clinic</label>
                                <div class="content" id="dec_clinic_name">{{ isset($doctor_arr['clinic_name'])?$doctor_arr['clinic_name']:'' }}</div>
                            </div>
                            <div class="content-block">
                                <label>Address</label>
                                <div class="content" id="dec_clinic_address"></div>
                            </div>
                            <div class="content-block">
                                <label>Contact no.</label>
                                <div class="content" id="dec_clinic_contact_no"></div>
                            </div>
                            <div class="content-block">
                               <div class="note"><b>Note :</b> It is your responsibility to confirm the identity of your Provider, along with any of these details with your Health care Provider and relevant authorities.</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </li>
                <script type="text/javascript">
                    var address = "{{ isset($doctor_arr['address'])?$doctor_arr['address']:'' }}";
                    var contact_no = "{{ isset($doctor_arr['contact_no'])?$doctor_arr['contact_no']:'' }}";
                    var ahpra_registration_no = "{{ isset($doctor_arr['ahpra_registration_no'])?$doctor_arr['ahpra_registration_no']:'' }}";
                    var clinic_name = "{{ isset($doctor_arr['clinic_name'])?$doctor_arr['clinic_name']:'' }}";
                    var clinic_address = "{{ isset($doctor_arr['clinic_address'])?$doctor_arr['clinic_address']:'' }}";
                    var clinic_contact_no = "{{ isset($doctor_arr['clinic_contact_no'])?$doctor_arr['clinic_contact_no']:'' }}";

                    if(address != "" && address != null){
                        var dec_address = key.decrypt(address).toString();
                        $('#dec_address').html(dec_address);
                    }
                    if(contact_no != "" && contact_no != null){
                        var dec_contact_no = key.decrypt(contact_no).toString();
                        $('#dec_contact_no').html(dec_contact_no);
                    }
                    if(ahpra_registration_no != "" && ahpra_registration_no != null){
                        var dec_ahpra_registration_no = key.decrypt(ahpra_registration_no).toString();
                        $('.dec_ahpra_registration_no').html(dec_ahpra_registration_no);

                        $("#ahpra_link").prop("href", "https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx?reg="+dec_ahpra_registration_no)
                    }
                    if(clinic_address != "" && clinic_address != null){
                        var dec_clinic_address = key.decrypt(clinic_address).toString();
                        $('#dec_clinic_address').html(dec_clinic_address);
                    }
                    if(clinic_contact_no != "" && clinic_contact_no != null){
                        var dec_clinic_contact_no = key.decrypt(clinic_contact_no).toString();
                        $('#dec_clinic_contact_no').html(dec_clinic_contact_no);
                    }

                </script>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Education<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body about-me-wraper">
                        <!--<ul class="blt">
                            <li> <strong>Qualification : </strong>{{ isset($doctor_arr['medical_qualification'])?$doctor_arr['medical_qualification']:'' }}</li>
                            <li> <strong>Year Obtained : </strong>{{ isset($doctor_arr['year_obtained'])?$doctor_arr['year_obtained']:'' }}</li>
                            <li> <strong>Country Obtained : </strong>{{ isset($doctor_arr['country_obtained'])?$doctor_arr['country_obtained']:'' }}</li>
                            <li> <strong>Other Qualification : </strong>{{ isset($doctor_arr['other_qualifications'])?$doctor_arr['other_qualifications']:'' }}</li>
                        </ul>-->
                        
                           
                         
                                 <table class="responsive-table">
                                     <thead>
                                         <tr>
                                             <th>Qualification</th>
                                             <th>Year Obtained</th>
                                             <th>Country</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>B.Med.Sci</td>
                                             <td>2017</td>
                                             <td>Australia</td>
                                         </tr>
                                         <tr>
                                             <td>MBBS</td>
                                             <td>2008</td>
                                             <td>Singapore</td>
                                         </tr>
                                         <tr>
                                             <td>FRACS</td>
                                             <td>2003</td>
                                             <td>Australia</td>
                                         </tr>
                                     </tbody>
                                 </table>
                           
                            <div class="content-block">
                                <label>Experience as a Practitioner</label>
                                <div class="content">{{ isset($doctor_arr['experience'])?$doctor_arr['experience']:'' }}</div>
                            </div>
                            <div class="content-block">
                                <label>Languages Sopken</label>
                                <div class="content">
                                    <ul class="row">
                                       @if(isset($languages_arr) && !empty($languages_arr))
                                @foreach($languages_arr as $lang)
                                        <li class="col s6 m6 l6"><i class="fa fa-circle"></i> {{$lang['language']}}</li>
                                       
                                        @endforeach
                            @endif 
                                    </ul>
                                </div>
                            </div>
                        
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Pricing<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body about-me-wraper">
                         <div>
                                 <table class="responsive-table pricing-tbl">
                                     <thead>
                                         <tr>
                                             <th>Time</th>
                                             <th>Price (First 4 Minutes)</th>
                                             <th>Additional Price-Per-Minute</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>9AM - 6PM</td>
                                             <td>$ 28</td>
                                             <td>$ 7</td>
                                         </tr>
                                         <tr>
                                             <td>6AM - 11PM</td>
                                             <td>$ 38</td>
                                             <td>$ 9</td>
                                         </tr>
                                        
                                     </tbody>
                                 </table>
                             </div>
                            <a href="#" class="link">Read more about the pricing structure</a>
                    </div>
                   
                </li>
               <!-- <li>
                    <div class="collapsible-header waves-effect waves-light">Identification<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <ul class="blt">
                            <li><strong>AHPRA NO. : </strong>{{ isset($doctor_arr['ahpra_registration_no'])?$doctor_arr['ahpra_registration_no']:'' }}</li>
                            <li><strong>ABN : </strong>{{ isset($doctor_arr['abn'])?$doctor_arr['abn']:'' }}</li>
                            
                            <li style="list-style: none !important;">It is your responsibility to confirm these details with your doctor and relevant authorities. <a href="" class="green-text">Read Full Terms</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header waves-effect waves-light">Languages<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <ul class="blt">
                            @if(isset($languages_arr) && !empty($languages_arr))
                                @foreach($languages_arr as $lang)
                                    <li>{{$lang['language']}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </li>-->
            </ul></div>
        </div>

    </div>
    </div>

@endsection