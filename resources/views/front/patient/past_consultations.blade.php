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
                <div class="searchdoc left">Search</div>
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

        <form method="GET" id="search_doctor_form" name="search_doctor" action="{{ url('/patient') }}/past_consultations/search_past_consultation">
            <div class="searchform">
                <div class="drname">
                    <div class="input-field name-suggestn">
                        <input id="doctor_name" name="doctor_name" placeholder="Type here" type="text" class="validate" value="" autocomplete="off">
                        <label for="doctor_name">Name of Doctor</label>
                        <span class="result_disp" style="cursor: pointer;"></span>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="other">
                    <div class="input-field">
                        <label class="active" for="selected_date">Date</label>
                        <input id="selected_date" name="selected_date" type="text" class="datepicker">

                    </div>
                </div>

                <div class="divider"></div>
                <div class="other">
                    <div class="input-field">
                        <label for="selected_time">Time </label>
                        <input id="selected_time" name="selected_time" class="timepicker" type="text">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="other" id="err_msg" >
                    <div class="input-field">
                        <div class="err" id="err_form" style="display:none;"></div>
                    </div>
                </div>
                <div class="side-footer search-botom">
                    <a href="{{ url('/') }}/patient/past_consultations" class="left search-btn">CLEAR</a>
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
                    <a class="active" href="{{ url('/') }}/patient/past_consultations" id="tab_test3"> <span><img src="{{ url('/') }}/public/new/images/past-icon.png" alt="icon"/> </span>Past</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/declined_consultations" class="redirect_declined" id="tab_test4"> <span><img src="{{ url('/') }}/public/new/images/past-icon.png" alt="icon"/> </span>Declined</a>
                </li>
                <li class="tab col s3">
                    <a href="{{ url('/') }}/patient/my_doctors" class="redirect_mydoctors"> <span><img src="{{ url('/') }}/public/new/images/team-doc-icon.png" alt="icon"/> </span>My Doctors</a>
                </li>
            </ul>
        </div>
        <div class="container minhtnor">

            <div id="test3" class="col s12 tab-content medi">
                <div class="available-now consultation_lists">
                @if(isset($past_consult_arr['data']) && !empty($past_consult_arr['data']))
                    <ul class="collection brdrtopsd">
                        @foreach($past_consult_arr['data'] as $past_consult_data)
                            <li class="collection-item valign-wrapper">
                                
                                @php
                                    // check listisng image
                                    if ( isset($past_consult_data['doctor_user_details']['profile_image']) && !empty($past_consult_data['doctor_user_details']['profile_image']) )
                                    {
                                        $profile_images = $doctor_image_url.$past_consult_data['doctor_user_details']['profile_image'];
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

                                    $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $past_consult_data["consultation_datetime"]);
                                @endphp
                                <div class="image-avtar left">
                                    <img src="{{ $profile_images }}" alt="" class="circle" />
                                    @if($past_consult_data['doctor_user_details']['is_online'] == 1)
                                        <span class="onlinenew"></span>
                                    @else
                                        <span class="online"></span>
                                    @endif
                                </div>

                                <div class="left wid100"><small>{{ date("l d F, Y",strtotime($consult_datetime)).' '.date("h:i a",strtotime($consult_datetime)) }}</small>
                                    <span class="title">{{ $past_consult_data["doctor_user_details"]["title"].' '.$past_consult_data["doctor_user_details"]["first_name"].' '.$past_consult_data["doctor_user_details"]["last_name"] }}</span>
                                </div>
                                <div class="right posrel">
                                <a href="#" data-activates='dropdown{{ $past_consult_data["id"] }}' class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                                <ul id='dropdown{{ $past_consult_data["id"] }}' class='dropdown-content doc-rop rightless'>
                                    <li><a href="{{ url('/') }}/patient/booking/online_waiting_room/{{ base64_encode($past_consult_data['id']) }}" class="get_booking_id">Track Booking Status</a></li>
                                    <li><a href="{{ url('/patient') }}/past_consultation/details/{{base64_encode($past_consult_data["id"])}}">View Consultation Details</a></li>
                                    <li><a href="{{ url('/patient') }}/past_consultation/invoice/{{base64_encode($past_consult_data["id"])}}">View Invoice</a></li>
                                    <li><a href="{{ url('/patient') }}/setting/disputes">Dispute</a></li>
                                    <li><a href="{{ url('/patient') }}/setting/feedback">Feedback &amp; Review</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>
                        @endforeach
                    </ul>
                <div class="paginaton-block-main">{{ $paginate->render() }}</div>
                @else
                    <div class="my-con-bx">
                        <div class="doc-img">
                            <img src="{{ url('/') }}/public/new/images/doc-icon.png" alt="doctor icon" />
                            <p class="no-data">You have no past consultations.</p>
                        </div>
                    </div>
                @endif
                </div>
            </div>
            <!--Container End-->
        </div>

    </div>

<script>
    $(document).ready(function(){
        $('#doctor_name').keyup(function(e){
            doc_keyword = $('#doctor_name').val();

            if(doc_keyword != '')
            {

                if (e.which == 13) {
                    $('#btn_sumbit').click();
                    return false; 
                }
                

                $.ajax({
                    url: "{{ url('/') }}/patient/past_consultations/search_doctor_name",
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
                            $('.result_disp').html("");
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
                
                var selected_date   = $("#selected_date").val();
                var selected_time   = $("#selected_time").val();
                
                $('#err_form').show();
                if(doctor_name == ''  && selected_date == '' && selected_time == '')
                {
                    $('#err_form').show();
                    $('#err_form').html('Please select atleast 1 option');
                    $('#err_form').fadeOut(6000);
                    return false;
                }
                else if(doctor_name != '' || selected_date != '' || selected_time != '')
                {
                    $("#search_doctor_form").submit();
                    return true;
                }
            });

    });
</script>   
<!-- Ajax Functionality -->
<input type="hidden" name="consultation_request_with_ajax" id="consultation_request_with_ajax" value="0">
<script type="text/javascript">
        /*$(document).ready(function(){
               setInterval(function(){ new_consultation_request_with_ajax(); }, 500);
        });
        function new_consultation_request_with_ajax(){
            var current_consultation_request_with_ajax = $('#consultation_request_with_ajax').val(); 
                if(current_consultation_request_with_ajax == 0){ 
                  $('.consultation_lists').load(location.href+" .consultation_lists");    
                }  
            if(current_consultation_request_with_ajax == 0){ $('#consultation_request_with_ajax').val('5'); }
            else{  var new_consultation_request_with_ajax     = parseInt(current_consultation_request_with_ajax) - parseInt(1);
                $('#consultation_request_with_ajax').val(new_consultation_request_with_ajax);
            }  
        }
        $(document).mouseover(function(e) {
            $('#consultation_request_with_ajax').val('5');
        });
        $(document).keyup(function(e) {
            $('#consultation_request_with_ajax').val('5');
        });
        $(window).bind('mousewheel', function(event) {
            if (event.originalEvent.wheelDelta >= 0) {
                console.log('Scroll up');
                $('#consultation_request_with_ajax').val('5');
            }
            else {
                console.log('Scroll down');
                $('#consultation_request_with_ajax').val('5');
            }
        });*/
</script>
<!-- End Ajax Functionality -->
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