<div id="slide-out" class="side-nav fixed menu-main">
<div id="side-nav">

<div class="clientlogin valign-wrapper">
    <div class="profile-pic left circle">
        <a href="{{url('')}}/patient/setting/personal_details">
            <img src="{{ $user_profile_pic }}" class=" circle" />
        </a>
    </div>
    <a href="{{url('')}}/patient/setting/personal_details">
        <div class="left sidename">
            <h3>{{ $arr_user_data['title'].' '.$arr_user_data['first_name'].' '.$arr_user_data['last_name'] }}</h3>
            {{ $arr_user_data['email'] }}
        </div>
    </a>
</div>
<ul class="collapsible menu_patch check_sidebar" id="my_sidebar" data-collapsible="accordion">
    <li>
        <a class="collapsible-header micon menu1" href="{{url('/')}}/patient/booking">SEE A DOCTOR</a>
    </li>
    <li>
        <div class="collapsible-header micon menu2">MY CONSULTATIONS</div>
        <div class="collapsible-body">
            <ul>
                <li><a id="open_tab1" href="{{ url('/') }}/patient/dashboard">New Booking</a></li>
                <li><a id="open_tab2" href="{{ url('/') }}/patient/upcoming_consultations">Upcoming Consultations</a></li>
                <li><a id="open_tab3" href="{{ url('/') }}/patient/past_consultations">Past Consultations</a></li>
                <li><a href="{{ url('/') }}/patient/declined_consultations">Declined Consultations</a></li>
                <li><a id="open_tab4" href="{{ url('/') }}/patient/my_doctors">My Doctors</a></li>
            </ul>
        </div>
    </li>

    <li>
        <div class="collapsible-header micon menu11">MY HEALTH</div>
        <div class="collapsible-body">
            <ul>
                <!-- <li><a href="{{url('/patient')}}/my_health">Medication manager</a></li> -->
                <li><a href="{{url('/patient')}}/my_health/medical_history/general">Medical history</a></li>
                <li><a href="{{url('/patient')}}/my_health/documents/consultation">Documents & Certificates</a></li>
                <li><a href="{{url('/patient')}}/my_health/doctor_Activity">Doctor Activity</a></li>
                <!-- <li><a href="{{url('/patient')}}/my_health/ask_a_doctor">Ask a doctor</a></li> -->
            </ul>
        </div>
    </li>
    <!-- <li> <a class="collapsible-header micon menu4" href="{{url('/patient')}}/my_shop">MY ONLINE PHARMACY</a>
    </li>
    <li>
        <div class="collapsible-header micon menu12"> MY ORDERS</div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{url('/patient')}}/my_orders">Orders</a>
                    <ul>
                        <li><a href="{{ url('/patient') }}/my_orders#past-order">PAST</a></li>
                        <li><a href="{{ url('/patient') }}/my_orders#pending-order">PENDING </a></li>
                        <li><a href="{{ url('/patient') }}/my_orders#cancelled-order">CANCELLED </a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/patient') }}/my_orders#my-pharmacies">My pharmacies</a></li>
            </ul>
        </div>
    </li> -->
    <li>
        <div class="collapsible-header micon menu13 posrel"> MY MESSAGES &amp; NOTIFICATIONS 
            @php
                $new_messages ="0";
                $new_notifications = new_notification_count();
                $total = $new_messages + $new_notifications; 
            @endphp

            <span class="count-no">{{$total}}</span></div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{ url('/') }}/patient/chat" class="posrel">Messages  <span class="count-no">{{$new_messages}}</span></a></li>
                <li><a href="{{ url('/') }}/patient/messages_and_notification/notification" class="posrel">Notifications  @if(new_notification_count())<span class="count-no">{{new_notification_count()}}</span> @endif </a></li>
            </ul>
        </div>


    </li>
    <li>
        <a class="collapsible-header micon menu7" href="{{url('/patient')}}/setting">SETTINGS</a>

    </li>

    <li>
        <a class="collapsible-header micon menu10" id="logout_btn" href="#logout">LOGOUT</a>
    </li>
</ul>

<div class="sidemenu-footer center ">
    <img src="{{ url('/') }}/public/new/images/footermenuapp.png" />
    <div class="followus">follow us
        <a href="#"><img src="{{ url('/') }}/public/new/images/fb.svg"></a>
        <a href="#"><img src="{{ url('/') }}/public/new/images/tw.svg"></a>
        <a href="#"><img src="{{ url('/') }}/public/new/images/in.svg"></a>
        <a href="#"><img src="{{ url('/') }}/public/new/images/gplus.svg"></a>
    </div>
</div>
</div>
</div>
