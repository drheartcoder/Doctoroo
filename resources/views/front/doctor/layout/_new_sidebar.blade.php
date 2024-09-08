<div id="slide-out" class="side-nav fixed menu-main">
<div id="side-nav">

<div class="clientlogin valign-wrapper">
    <div class="profile-pic left circle">
        <a href="{{url('')}}/doctor/my_profile/about_yourself">
            <img src="{{ $user_profile_pic }}" class=" circle" />
        </a>
    </div>
    <a href="{{url('')}}/doctor/my_profile/about_yourself">
        <div class="left sidename">
            <h3>{{ $arr_user_data['title'].' '.$arr_user_data['first_name'].' '.$arr_user_data['last_name'] }}</h3>
            {{ $arr_user_data['email'] }}
        </div>
    </a>
</div>

@if(membership() == 0)

    <script>
      $(document).ready(function(){
        var url = '<?php echo url("/doctor/membership/payment") ?>';
        var current_url = window.location.href; 
        if(current_url != url){
           window.location.href = url;
        }
      });
    </script>
    <style>
        #my_sidebar a,#my_sidebar div
        {
            pointer-events: none;
            cursor: default;
        }
    </style>
@endif
    

<ul class="collapsible menu_patch check_sidebar" id="my_sidebar" data-collapsible="accordion">
    <li>
        <a class="collapsible-header micon home-icon" href="{{ url('/') }}/doctor/profile/dashboard">HOME</a>
    </li>
    <li>
        <a class="collapsible-header micon consultation-icon" href="{{ url('/') }}/doctor/consultation/new_consultation_request">CONSULTATIONS</a>
    </li>
    <li>
        <a class="collapsible-header micon available-icon" href="{{ url('/') }}/doctor/availability">CALENDAR &amp; AVAILABILITY</a>
    <li>
        <a class="collapsible-header micon menu3" href="{{ url('/') }}/doctor/patients/myown_patients">MY PATIENTS</a>
    </li>
    <li>
        <a class="collapsible-header micon message" href="{{ url('/') }}/doctor/messages">MESSAGES</a>
    </li>
    <li>
        <a class="collapsible-header micon menu13" href="{{ url('/') }}/doctor/notification">NOTIFICATIONS @if(new_notification_count() != '' && new_notification_count() !=null) <span class="count-no">{{new_notification_count()}}</span> @endif</a>
    </li>   
    {{-- <li>
        <a class="collapsible-header micon menu6" href="{{ url('/') }}/doctor/profile/dashboard">ANSWER QUESTION</a>
    </li> --}}
    <li>
        <a class="collapsible-header micon menu4" href="{{ url('/') }}/doctor/pharmacies">PHARMACIES</a>
    </li>
    <li>
        <a class="collapsible-header micon menu7" href="{{ url('/') }}/doctor/settings">SETTINGS</a>
    </li>
    <li class="margin-btm-54px">
        <a style="pointer-events: auto;cursor: pointer;" class="collapsible-header micon menu10" id="logout_btn" href="#logout">LOGOUT</a>
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
    /*$('.collapsible').collapsible();
    $('.button-collapse').sideNav({
        menuWidth: 310, // Default is 240
        edge: 'left', // Choose the horizontal origin
    });*/
</script>
