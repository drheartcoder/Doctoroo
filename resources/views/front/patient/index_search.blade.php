@extends('front.patient.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Consultations</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.layout._sidebar')

    <div class=" app-header available-doc z-depth-2 has-header ">
        <div class="container">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col s12 l12 m12">
                    <div class="input-field searchHead searchinput">
                        <a href="" class="menu-icon center-align prefix"><i class="material-icons">search</i></a>
                        <input type="text" id="search_consultation" class="autocomplete" placeholder="Search">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mar300 has-footer">

        <div class="container minhtnor">
            <div class="medi">
                @if(isset($consult_arr['data']) && !empty($consult_arr['data']))
                <ul class="collection brdrtopsd" id="consultation_list">
                    @foreach($consult_arr['data'] as $consult_arr)
                        
                        <?php $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $consult_arr["consultation_datetime"]); ?>

                        <li class="collection-item valign-wrapper">
                            <div class="left wid100"><small>{{ date("l d F, Y",strtotime($consult_datetime)).' '.date("h:i a",strtotime($consult_datetime)) }}</small>
                                <span class="title">{{ $consult_arr["doctor_user_details"]["title"].' '.$consult_arr["doctor_user_details"]["first_name"].' '.$consult_arr["doctor_user_details"]["last_name"] }}</span>
                            </div>
                            <div class="right posrel">
                            <a href="#" data-activates='dropdown{{ $consult_arr["id"] }}' class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                            <ul id='dropdown{{ $consult_arr["id"] }}' class='dropdown-content doc-rop rightless'>
                                <li><a href="{{ url('/') }}/patient/booking/online_waiting_room/{{ base64_encode($consult_arr['id']) }}" class="get_booking_id">Track Booking Status</a></li>
                                <li><a href="{{ url('/patient') }}/consultation_details">View Consultation Details</a></li>
                                <li><a href="{{ url('/patient') }}/consultation_invoice">View Invoice</a></li>
                                <li><a href="{{ url('/patient') }}/disputes">Dispute</a></li>
                                <li><a href="{{ url('/patient') }}/feedback">Feedback &amp; Review</a></li>
                                <li><a href="javascript:void(0);">Delete</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
                <div class="paging">{{ $paginate->render() }}</div>
                @else
                    <div class="my-con-bx">
                        <div class="doc-img">
                            <img src="{{ url('/') }}/public/new/images/doc-icon.png" alt="doctor icon" />
                            <p class="no-data">You have no consultations.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!--Container End-->
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
            $('#search_consultation').keyup(function(){
                var search_key = $('#search_consultation').val();

                if($.trim(search_key) != '')
                {
                    var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url   : "{{ url('/') }}/patient/consultation_search",
                        type : "POST",
                        //dataType:'json',
                        data: {_token:token,search_key:search_key},
                        success : function(res){
                            $('#consultation_list').empty();
                            $('#consultation_list').append(res);
                        }
                    });
                }

            });
        });
    </script>

@endsection