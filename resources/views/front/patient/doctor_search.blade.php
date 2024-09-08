@extends('front.patient.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
        <div class="searchicon">
            <a href="" class="menu-icon center-align prefix button-collapse-open" data-activates="slide-out-right"><i class="material-icons">search</i></a>
        </div>
    </div>

    <div id="slide-out-right" class="side-nav z-depth-2 searchpatch " >
        <div class="blueHeader">
            <div class="valign-wrapper">
                <div class="searchdoc left">Search Doctors</div>
                <div class="result"></div>
                <div class="cancel right"><a href="">Cancel</a></div>
            </div>
        </div>

        <style>
            .name-suggestn ul li {
                border-bottom: 1px solid #eeeeee;
                color: #26a69a;
                display: block;
                font-size: 15px;
                padding: 7px 12px;
            }
        </style>

        <form method="GET" id="search_doctor_form" name="search_doctor" action="{{ url('/patient') }}/my_doctors/search">
            <div class="searchform">
                <div class="drname">
                    <div class="input-field name-suggestn">
                        <input id="doctor_name" name="doctor_name" placeholder="Type here" type="text" class="validate" value="{{isset($doctor_name) ? $doctor_name : '' }}" autocomplete="off">
                        <label for="doctor_name">Name of Doctor</label>
                        <span class="result_disp" style="cursor: pointer;"></span>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="other">
                    <div class="input-field">
                        <label class="active" for="selected_date">Consultation Date</label>
                        <input id="selected_date" name="selected_date" value="{{isset($selected_date) ? $selected_date : '' }}" type="text" class="datepicker">

                    </div>
                </div>

                <div class="divider"></div>
                <div class="other">
                    <div class="input-field">
                        <label for="selected_time">Consultation Time </label>
                        <input id="selected_time" name="selected_time" value="{{ isset($selected_time) ? $selected_time : '' }}" class="timepicker" type="text">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="chooseoption">
                    <div class="input-field">
                        <select id="language" name="language" class="amount-drop">
                            <option value="">Select</option>
                            @if(isset($language) && !empty($language))
                                @foreach($language as $lang_data)
                                    <option value="{{ $lang_data['id'] }}" {{ isset($selected_language) && $selected_language == $lang_data['id'] ? 'selected' : '' }}>{{ $lang_data['language'] }}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Language</label>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="chooseoption">
                    <div class="input-field">
                        <select id="gender" name="gender">
                            <option value="">Select</option>
                            <option value="Male" {{ isset($gender) && $gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ isset($gender) && $gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <label>Gender</label>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="other" id="err_msg" >
                    <div class="input-field">
                        <div class="err" id="err_form" style="display:none;"></div>
                    </div>
                </div>
                <div class="side-footer search-botom">
                    <a href="{{ url('/') }}/patient/my_doctors" class="left search-btn">CLEAR</a>
                    <button type="button" name="btn_sumbit" id="btn_sumbit" class="right search-btn">Search</button>
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300  has-header has-footer">

        <div class="consultation-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s3" >
                    <a href="{{ url('/') }}/patient/dashboard" class="redirect_dashboard"><span><img src="{{ url('/') }}/public/new/images/new-doc-icon.png" alt="icon"/> </span> New</a></li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/upcoming_consultations" class="redirect_upcoming"> <span><img src="{{ url('/') }}/public/new/images/upcuming-icon.png" alt="icon"/> </span> Upcoming</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/past_consultations" class="redirect_past"> <span><img src="{{ url('/') }}/public/new/images/past-icon.png" alt="icon"/> </span>Past</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/declined_consultations" class="redirect_declined" id="tab_test4"> <span><img src="{{ url('/') }}/public/new/images/past-icon.png" alt="icon"/> </span>Declined</a>
                </li>
                <li class="tab col s3">
                    <a class="active" href="{{ url('/') }}/patient/my_doctors" id="tab_test4"> <span><img src="{{ url('/') }}/public/new/images/team-doc-icon.png" alt="icon"/> </span>My Doctors</a>
                </li>
            </ul>
        </div>
        <div class="container minhtnor">

            <div id="test4" class="col s12 tab-content medi">
                <div class="available-now martp">
                    @if(isset($doctors_arr['data']) && !empty($doctors_arr['data']))
                        <ul class="collection">
                            @foreach($doctors_arr['data'] as $val)
                            
                            @php
                                // check listisng image
                                if ( isset($val['doctor_user_details']['profile_image']) && !empty($val['doctor_user_details']['profile_image']) )
                                {
                                    $profile_images = $doctor_image_url.$val['doctor_user_details']['profile_image'];
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

                                $consult_date = isset($val['doctor_availability'][0]['date'])?$val['doctor_availability'][0]['date']:'';
                                $doc_id = isset($val['doctor_user_details']['id'])?$val['doctor_user_details']['id']:'';
                                $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $val["consultation_datetime"]);
                            @endphp

                            <li class="collection-item avatar ">
                               <div class="valign-wrapper">
                                <div class="image-avtar left"> <img src="{{ $profile_images }}" alt="" class="circle" />
                                <span class="onlinenew"></span> </div>
                                <div class="doc-detail  left"><span class="title">{{ isset( $val["doctor_user_details"]["title"]) ? $val["doctor_user_details"]["title"] :''}} {{ isset($val["doctor_user_details"]["first_name"]) ? $val["doctor_user_details"]["first_name"] : ''}} {{ isset($val["doctor_user_details"]["last_name"]) ? $val["doctor_user_details"]["last_name"] : '' }}</span>
                                    <p class="availability bluedoc-text"> <strong>Last Booking : </strong>{{ date("l d F, Y",strtotime($consult_datetime)) }} {{' '. date("h:i a",strtotime($consult_datetime)) }}</p>
                                </div>
                                
                                @if(isset($val['doctor_availability']) &&$val['doctor_availability'] != null)
                                    <a class="valign-wrapper" href="{{ url('/') }}/patient/booking/select_doctor/{{ base64_encode($doc_id) }}">
                                        <div class="doc-action right"><span class="btn secondary-content border">Book now</span></div>
                                    </a>
                                @endif

                                <div class="clearfix"></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="my-con-bx">
                            <div class="doc-img">
                                <img src="{{ url('/') }}/public/new/images/doc-icon.png" alt="doctor icon" />
                                <p class="no-data">No records founds.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!--Container End-->
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#doctor_name').keyup(function(e){
                doc_keyword = $('#doctor_name').val();
                if(doc_keyword != '')
                {
                    if(e.keyCode == 13 )
                    {
                       $('#btn_sumbit').click();
                    }
                    $.ajax({
                        url: "{{ url('/') }}/patient/my_doctors/search_doctor_name",
                        type:'get',
                        data:{doc_keyword:doc_keyword},
                        success:function(result){
                            
                            if(result.status=='success')
                            {
                                $('.result_disp').show();
                                var res='<ul>';
                                $.each(result.data,function(i,obj)
                                {
                                   res+="<li class='doc_name' data-val='"+obj.doctor_user_details.title+" "+obj.doctor_user_details.first_name+" "+obj.doctor_user_details.last_name+"''>"+obj.doctor_user_details.title+" "+obj.doctor_user_details.first_name+" "+obj.doctor_user_details.last_name+"</li>";
                                });
                                res+='</ul>';
                                $('.result_disp').html(res);
                            }
                            else
                            {
                                $('.result_disp').html('');   
                            }

                        }
                    });
                }
                else
                {
                    $('.result_disp').html();
                    $('.result_disp').hide();
                }
            });

            $(document).on('click', '.doc_name', function(){
               var value = $(this).data('val');
               $('#doctor_name').val(value);
               $('.result_disp').html();
               $('.result_disp').hide();
            });

            $("#btn_sumbit").click( function(){

                var doctor_name     = $("#doctor_name").val();
                var speciality      = $("#speciality").val();
                var selected_date   = $("#selected_date").val();
                var selected_time   = $("#selected_time").val();
                var language        = $("#language").val();
                var gender          = $("#gender").val();

                if(doctor_name == '' && selected_date == '' && selected_time == '' && language == '' && gender == '' )
                {
                    $('#err_form').show();
                    $('#err_form').html('Please select atleast 1 option');
                    $('#err_form').fadeOut(6000);
                    return false;
                }
                else if(doctor_name != '' || selected_date != '' || selected_time != '' || language != '' || gender != '' )
                {
                    $("#search_doctor_form").submit();
                    return true;
                }
            });
        });
    </script>

<script>
    $(document).ready(function(){
        $('.redirect_dashboard').click(function(){
            window.location.href = "{{ url('/') }}/patient/dashboard";
        });
        $('.redirect_upcoming').click(function(){
            window.location.href = "{{ url('/') }}/patient/upcoming_consultations";
        });
        $('.redirect_past').click(function(){
            window.location.href = "{{ url('/') }}/patient/past_consultations";
        });
        $('.redirect_declined').click(function(){
            window.location.href = "{{ url('/') }}/patient/declined_consultations";
        });
        $('.redirect_mydoctors').click(function(){
            window.location.href = "{{ url('/') }}/patient/my_doctors";
        });
    });
</script>

@endsection