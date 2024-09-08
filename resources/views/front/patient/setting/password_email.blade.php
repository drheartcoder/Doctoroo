@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<?php 
$email="";
$password="";
 foreach($user_arr as $val)
 {
     $email=$val['email'];
     $password=$val['password'];
 }
?>
<div class="header z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Email &amp; Password</h1>
        
        <div class="fix-add-btn">
            <a href="{{ $module_url_path.'/password_reset'}}"><span class="grey-text">Reset Password</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">edit</i></div> 
            </a>
    </div>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header minhtnor has-footer"> -->
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="email" id="reason" class="validate" value="{{$email}}" readonly>
                <label for="reason" class="grey-text truncate">Email</label>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="password" id="reason" class="validate " value="{{$password}}" readonly>
                <label for="reason" class="grey-text truncate">Password</label>
            </div>
        </div>

        </div>
    </div>

@endsection