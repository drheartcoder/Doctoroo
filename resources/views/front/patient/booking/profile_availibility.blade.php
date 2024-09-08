@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
  
    <div class="header profileHead  z-depth-2 bookhead">
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
                            if ( isset($doctor_details['0']['user_details']['profile_image']) && !empty($doctor_details['0']['user_details']['profile_image']) )
                            {
                                $profile_images = $doctor_image_url.$doctor_details['0']['user_details']['profile_image'];
                                // check if image exists or not
                                if ( File::exists($profile_images) ) 
                                {
                                    $profile_images = $doctor_image_url."default-image.jpeg";
                                }
                            }
                            else
                            {
                                $profile_images = $doctor_image_url."default-image.jpeg";
                            }

                            $doc_id             = isset($doctor_details['0']['user_details']['id'])?$doctor_details['0']['user_details']['id']:'';
                            $doc_title          = isset($doctor_details['0']['user_details']['title'])?$doctor_details['0']['user_details']['title']:'';
                            $doc_first_name     = isset($doctor_details['0']['user_details']['first_name'])?$doctor_details['0']['user_details']['first_name']:'';
                            $doc_last_name      = isset($doctor_details['0']['user_details']['last_name'])?$doctor_details['0']['user_details']['last_name']:'';
                            $doc_speciality     = isset($doctor_details['0']['doctor_details']['speciality'])?$doctor_details['0']['doctor_details']['speciality']:'';
                            $doc_id             = isset($doctor_details['0']['user_details']['id'])?$doctor_details['0']['user_details']['id']:'';
                            $doc_video             = isset($doctor_details['0']['doctor_details']['profile_video'])?$doctor_details['0']['doctor_details']['profile_video']:'';

                            // check listisng video
                            if ( isset($doctor_details['0']['doctor_details']['profile_video']) && !empty($doctor_details['0']['doctor_details']['profile_video']) )
                            {
                                $profile_video = $doctor_video_url.$doctor_details['0']['doctor_details']['profile_video'];
                                $folder_path   = public_path().config('app.project.img_path.doctor_video');

                                // check if video exists or not
                                if ( file_exists($folder_path.$doctor_details['0']['doctor_details']['profile_video']) ) 
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

                            <p> <span class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</span>
                            <small>{{ $doc_speciality }}</small></p>
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
                                $('.doc_name'+doc_id).html(dr_name);
                                $('.doc_name'+doc_id).html(dr_name);*/
                            });    
                            </script>
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

        <div class="tabli scrollspy  z-depth-2">
            <ul>
                <li>
                    <a href="{{ url('/patient') }}/booking/profile_about/{{ base64_encode($doc_id) }}/{{ base64_encode($get_selected_date) }}" class="valign-wrapper">About Me</a>
                </li>
                <li class="active">
                    <a href="{{ url('/patient') }}/booking/available_doctor/{{ base64_encode($doc_id) }}/{{ base64_encode($get_selected_date) }}" class="valign-wrapper">Availibility</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
        <div class="data-content">
            <div class="date-ro center-align">
                <h3>Choose a day</h3>
                <div class="dayChange  center-align">
                    <div class="valign-wrapper calendar">
                        <div class="input-field ">
                            @php
                                if( isset($doctor_details['0']['date']) && !empty($doctor_details['0']['date']))
                                {
                                    $given_date = date('d/m/Y', strtotime($doctor_details['0']['date']));
                                }
                                else
                                {
                                    
                                    $given_date = date('d/m/Y');
                                }
                            @endphp
                            <span class="valign-wrapper"><input id="date" type="text" value="{{ $given_date }}" class="validate center-align datepicker choosedate" placeholder="DD/MM/YYYY"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="time-ro center-align">
                <h3>Choose Time</h3>
                <ul class="choosetime" id="getting_time">
                
                    @if(isset($doc_fee_time_slot) && !empty($doc_fee_time_slot))
                        @foreach($doc_fee_time_slot as $time_slot)

                            <?php
                                echo '<li class="time circle">
                                    <a href="#requestbooking"
                                        class="valign-wrapper get_time" 
                                        data-doctor="'.$doc_id.'"
                                        data-date="'.date('l d F, Y', strtotime($doctor_details['0']['date'])).'"
                                        data-time="'.date('h:i a', strtotime($time_slot['time'])).'"
                                        doctor-rate="'.number_format($time_slot['total_patient_fee_for_four_min'], 2, '.', '').'"
                                        doctor-rate_per_min="'.number_format($time_slot['earning_per_min'], 2, '.', '').'"
                                        doctor-earning_for_4_min="'.number_format($time_slot['earning_for_4_min'], 2, '.', '').'"><span>'.date('h:i', strtotime($time_slot['time'])).'<small>'.date('a', strtotime($time_slot['time'])).'</small></span>
                                    </a>
                                </li>';
                            ?>

                        @endforeach
                    @endif
                </ul>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    </div>

    <!-- Modal requestbooking -->
    <div id="requestbooking" class="modal requestbooking fade" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none;">
        <div class="modal-content">
            <h4 class="center-align">Request Booking</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s2 l2 center-align title">Time</div>
                <div class="col s10 l10" id="time_schedule"><strong><span id="put_time"></span>, <span id="put_date"></span></strong></div>

                <form id="booking_details" method="POST" action="{{ url('/patient') }}/booking/review_booking">
                    {{ csrf_field() }}
                    <input type="hidden" name="booking_time" id="booking_time" value="">
                    <input type="hidden" name="booking_fee" id="booking_fee_txt" value="">
                    <input type="hidden" name="booking_fee_per_min" id="booking_fee_per_min_txt" value="">
                    <input type="hidden" name="booking_earning_for_4_min" id="booking_earning_for_4_min_txt" value="">
                </form>

            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">With</div>
                <div class="col s10 l10"><strong class="doc_name<?php echo $doc_id; ?>">{{ $doc_title.' '.$doc_first_name.' '.$doc_last_name }}</strong></div>
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
                    $('.doc_name'+doc_id).html(dr_name);
                    $('.doc_name'+doc_id).html(dr_name);*/
                });
                </script>
            </div>
            <div class="row">
                <div class="col s2 l2 center-align title">GP Fee</div>
                <div class="col s10 l10"><strong id="doctor_rate_html"></strong> for the first 4 minutes + additional time if required
                    <p><span class="title">Note:</span> You'll be charged once your doctor confirms your booking. </p>
                    <a href="#pricing_details" class="greencolor" data-dismiss="modal" data-toggle="modal" data-target="#pricing_details" >Pricing Details</a>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col s2 l2 center-align">
                    <div class="input-field chkbx  center-align">
                        <input type="checkbox" class="filled-in" id="chk" checked />
                        <label for="chk"></label>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="col s10 l10">Notify other available doctors if this doctor doesn't respond by the booking time or within 1 hour</div>
            </div> -->
            <div class="row">
                <div class="col s2 l2 center-align">
                    <div class="input-field chkbx  center-align">
                        Note
                    </div>
                </div>
                <div class="col s10 l10">By placing this booking, you give express consent for the chosen provider, as listed in the Privacy Policy and Terms.</div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Back</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons right submit_form">Continue</a>
        </div>
    </div>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <!--popup include -->
    @include('front.patient.booking.pricing_details')

    <script>
        $(document).ready(function(){

            $(document).on('click', '.get_time', function(){

                var doctor_id = $(this).data('doctor');
                var selected_date = jQuery(this).data("date");
                $('#put_date').html(selected_date);

                var selected_time = jQuery(this).data("time");
                $('#put_time').html(selected_time);

                var doc_time = $('#time_schedule strong').text();
                $('#booking_time').val(doc_time);

                var doctor_rate = $(this).attr('doctor-rate');
                var doctor_rate_per_min = $(this).attr('doctor-rate_per_min');
                var doctor_earning_for_4_min = $(this).attr('doctor-earning_for_4_min');
                $('#doctor_rate_html').html('$'+doctor_rate);
                $('#booking_fee_txt').val(doctor_rate);
                $('#booking_fee_per_min_txt').val(doctor_rate_per_min);
                $('#booking_earning_for_4_min_txt').val(doctor_earning_for_4_min);

                var url    = "{{ url('/patient/booking/get_fess') }}";
                var _token = $('#_token').val();

                $.ajax({
                    url:url,
                    type:'post',
                    data:{selected_time:selected_time,_token:_token,doctor_id:doctor_id},
                    //dataType:'json',
                    success:function(data){
                        $('#doctor_rate').html('$'+data);
                        $('#booking_fee').val(data);
                    }
                });

            });

            $(".submit_form").click(function(){
                $("#booking_details").submit();
            });
            
        });
    </script>

@endsection