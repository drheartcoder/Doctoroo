<div id="slide-out" class="side-nav fixed menu-main">
<div id="side-nav">

<div class="clientlogin valign-wrapper">
    <div class="profile-pic left circle">
        <img src="{{ url('/') }}/public/new/images/avtar-1.jpg" class=" circle" />

    </div>
    <div class="left sidename">
        <h3>Jonathan Smith</h3>
        <a href="mailto:">jonathan.smithonian@gmail.com</a></div>
</div>
<ul class="collapsible menu_patch" data-collapsible="accordion">
    <li>
        <a class="collapsible-header micon menu1" href="{{url('/patient')}}/book_a_doctor">SEE A DOCTOR</a>
    </li>
    <li>
        <div class="collapsible-header micon menu2">MY CONSULTATIONS</div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{url('/patient')}}/book_a_doctor">New Booking</a></li>
                <li><a href="{{url('/patient')}}/my_consulations">Upcoming Consultations</a></li>
                <li><a href="{{url('/patient')}}/my_consulations">Past Consultations</a></li>
                <li><a href="{{url('/patient')}}/my_consulations">My Doctors</a></li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header micon menu11">MY HEALTH</div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{url('/patient')}}/my_health">Medication manager</a></li>
                <li><a href="{{url('/patient')}}/my_health_specific/medical_history">Medical history</a></li>
                <li><a href="{{url('/patient')}}/my_health_specific/documents_certificates">Documents & Certificates</a></li>
                <li><a href="{{url('/patient')}}/my_health_specific/ask_a_doctor">Ask a doctor</a></li>

            </ul>
        </div>
    </li>
    <li> <a class="collapsible-header micon menu4" href="{{url('/patient')}}/my_shop">MY ONLINE PHARMACY</a>
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


    </li>
    <li>
        <div class="collapsible-header micon menu13"> MY MESSAGES &amp; NOTIFICATIONS</div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{url('/patient')}}/messages_list">Messages</a></li>
                <li><a href="{{url('/patient')}}/notification">Notifications</a></li>
            </ul>
        </div>


    </li>
    <li>
        <a class="collapsible-header micon menu7" href="{{url('/patient')}}/setting">SETTINGS</a>

    </li>

    <li>
        <div class="collapsible-header micon menu10">LOGOUT</div>
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

<script>
    $('.collapsible').collapsible();
    $('.button-collapse').sideNav({
        menuWidth: 310, // Default is 240
        edge: 'left', // Choose the horizontal origin
    });
</script>
