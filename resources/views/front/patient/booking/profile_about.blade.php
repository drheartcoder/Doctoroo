@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<div class="header profileHead  z-depth-2">
   <div class="backarrow"><a href="{{ url('/patient') }}/booking/show_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
</div>
<!-- SideBar Section -->
@include('front.patient.layout._sidebar')
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
                     <?php $get_doc_data = \DB::table('users')->where('id',$doc_id)->first(); 
                          if(isset($get_doc_data->dump_id) && $get_doc_data->dump_id != ""){ $avl_dump_id = $get_doc_data->dump_id; } else { $avl_dump_id = ""; }
                          if(isset($get_doc_data->dump_session) && $get_doc_data->dump_session != ""){ $avl_dump_session = $get_doc_data->dump_session; } else { $avl_dump_session = ""; }
                     ?>
                     <p><span class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span>
                        <small>{{ $doc_speciality }}</small>
                     </p>
                     <script type="text/javascript">
                      $(document).ready(function(){
                        /*var doc_id           = "{{$doc_id}}";
                        var doc_first_name   = "{{$doc_first_name}}"; 
                        var doc_last_name    = "{{$doc_last_name}}"; 
                        var doc_title        = "{{$doc_title}}"; 
                        var card_id          = "{{ $avl_dump_id }}"
                        var userkey          = "{{ $avl_dump_session }}";
                        var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
                        var api              = virgil.API(VIRGIL_TOKEN);
                        var key              = api.keys.import(userkey);
                        var doc_first_name   = key.decrypt(doc_first_name).toString();
                        var doc_last_name    = key.decrypt(doc_last_name).toString();
                        var dr_name = doc_title+' '+doc_first_name+' '+doc_last_name;
                        $('.doc_name'+doc_id).html(dr_name);*/
                      });
                    </script>
                  </div>
               </div>
            </div>
         </div>
         <video class="videoBox responsive-video" controls loop>
            <source src="{{ $profile_video }}" type="video/mp4">
            <source src="{{ $profile_video }}" type="video/ogg">
            <source src="{{ $profile_video }}" type="video/webm">
            Your browser does not support the video tag.
         </video>
      </div>
      <div class="tabli scrollspy  z-depth-2">
         <ul>
            <li class="active">
               <a href="{{ url('/patient') }}/booking/profile_about/{{ base64_encode($doc_id) }}/{{ base64_encode($get_selected_date) }}" class="valign-wrapper">About Me</a>
            </li>
            <li>
               <a href="{{ url('/patient') }}/booking/available_doctor/{{ base64_encode($doc_id) }}/{{ base64_encode($get_selected_date) }}" class="valign-wrapper">Availibility</a>
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
                     <div class="row">
                        <div class="col s12 m6 l6">
                           <div class="content-block">
                              <label>Gender</label>
                              <div class="content">{{ isset($doctor_arr['gender'])?$doctor_arr['gender']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <label>Address</label>
                              <div class="content" id="id_doc_address1">{{ isset($doctor_arr['address'])?$doctor_arr['address']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <label>Contact no.</label>
                              <div class="content" id="id_doc_contact_no1">{{ isset($doctor_arr['contact_no'])?$doctor_arr['contact_no']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <label>AHPRA no.</label>
                              @if(isset($doctor_arr['ahpra_registration_no']) && $doctor_arr['ahpra_registration_no'] != '')
                              <div class="content"><a target="_blank" href="http://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx?reg={{$doctor_arr['ahpra_registration_no']}}" id="id_doc_ahpra_no">{{$doctor_arr['ahpra_registration_no']}}</a></div>
                              @else
                              <div class="content" id="id_doc_ahpra_no">{{ isset($doctor_arr['ahpra_registration_no'])?$doctor_arr['ahpra_registration_no']:'' }}</div>
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
                              <div class="content">{{ isset($doctor_arr['clinic_name'])?$doctor_arr['clinic_name']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <label>Address</label>
                              <div class="content" id="id_doc_address2">{{ isset($doctor_arr['clinic_address'])?$doctor_arr['clinic_address']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <label>Contact no.</label>
                              <div class="content" id="id_doc_contact_no2">{{ isset($doctor_arr['clinic_contact_no'])?$doctor_arr['clinic_contact_no']:'' }}</div>
                           </div>
                           <div class="content-block">
                              <div class="note"><b>Note :</b> It is your responsibility to confirm the identity of your Provider, along with any of these details with your Health care Provider and relevant authorities.</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>

               <li>
                  <div class="collapsible-header waves-effect waves-light">Education<i class="material-icons right">expand_more</i></div>
                  <div class="collapsible-body about-me-wraper">
                     <table class="responsive-table">
                        <thead>
                           <tr>
                              <th>Medical Qualification</th>
                              <th>School</th>
                              <th>Year Obtained</th>
                              <th>Country</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td id="id_doc_medical_qaulification">{{ isset($doctor_arr['medical_qualification'])?$doctor_arr['medical_qualification']:'' }}</td>
                              <td>{{ isset($doctor_arr['medical_school'])?$doctor_arr['medical_school']:'' }}</td>
                              <td>{{ isset($doctor_arr['year_obtained'])?$doctor_arr['year_obtained']:'' }}</td>
                              <td>{{ isset($doctor_arr['country_obtained'])?$doctor_arr['country_obtained']:'' }}</td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="content-block">
                        <label>Other Related Qualification</label>
                        <div class="content">{{ isset($doctor_arr['other_qualifications'])?$doctor_arr['other_qualifications']:'' }}</div>
                     </div>
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
                                 <!-- <th>Time</th> -->
                                 <th class="center-align">Day</th>
                                 <th class="center-align">Time</th>
                                 <th class="center-align">Price (First 4 Minutes)</th>
                                 <th class="center-align">Additional Price-Per-Minute</th>
                              </tr>
                           </thead>
                           <tbody>
                            @if(isset($getDoctorFees) && !empty($getDoctorFees))
                                @foreach($getDoctorFees as $key => $fees)
                                <?php
                                $day = date('l', strtotime(isset($fees->day) && $fees->day!= '' ? $fees->day : ''));
                                
                                $start_time = isset($fees->start_time) && $fees->start_time!= '' ? $fees->start_time : '';
                                $start_time = date('h:i A', strtotime($start_time));

                                
                                $end_time = isset($fees->end_time) && $fees->end_time!= '' ? $fees->end_time : '';
                                $end_time =  date('h:i A', strtotime($end_time));
                                 ?>
                                <tr>
                                    <td class="center-align">{{ strtoupper($day) }}</td>
                                    <td class="center-align">{{ $start_time }} - {{ $end_time }} </td>
                                    <td class="center-align">${{ $fees->total_patient_fee_for_four_min }}</td>
                                    <td class="center-align">${{ $fees->total_patient_fee_of_additional_afer_four_min }}</td>
                                </tr>
                                @endforeach
                            @endif
                           </tbody>
                        </table>
                     </div>
                     <a href="#pricing_details" class="link">Read more about the pricing structure</a>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  var card_id          = "{{ $avl_dump_id }}"
  var userkey          = "{{ $avl_dump_session }}";
  var VIRGIL_TOKEN     = "{{ env('VIRGIL_TOKEN') }}";
  var api              = virgil.API(VIRGIL_TOKEN);
  var key              = api.keys.import(userkey);

  var id_doc_address1    = $("#id_doc_address1").html();
  var dcrypt_id_doc_address1      = key.decrypt(id_doc_address1).toString();
  $("#id_doc_address1").html(dcrypt_id_doc_address1);

  var id_doc_contact_no1 = $("#id_doc_contact_no1").html();
  var dcrypt_id_doc_contact_no1 = key.decrypt(id_doc_contact_no1).toString();
  $("#id_doc_contact_no1").html(dcrypt_id_doc_contact_no1);


  var id_doc_address2    = $("#id_doc_address2").html();
  var dcrypt_id_doc_address2      = key.decrypt(id_doc_address2).toString();
  $("#id_doc_address2").html(dcrypt_id_doc_address2);

  var id_doc_contact_no2 = $("#id_doc_contact_no2").html();
  var dcrypt_id_doc_contact_no2 = key.decrypt(id_doc_contact_no2).toString();
  $("#id_doc_contact_no2").html(dcrypt_id_doc_contact_no2);

  var id_doc_ahpra_no = $("#id_doc_ahpra_no").html();
  var dcrypt_id_doc_ahpra_no = key.decrypt(id_doc_ahpra_no).toString();
  $("#id_doc_ahpra_no").html(dcrypt_id_doc_ahpra_no);

  var id_doc_medical_qaulification = $("#id_doc_medical_qaulification").html();
  var dcrypt_id_doc_medical_qaulification = key.decrypt(id_doc_medical_qaulification).toString();
  $("#id_doc_medical_qaulification").html(dcrypt_id_doc_medical_qaulification);

  
 </script>
<!--popup include -->
@include('front.patient.booking.pricing_details')

@endsection

