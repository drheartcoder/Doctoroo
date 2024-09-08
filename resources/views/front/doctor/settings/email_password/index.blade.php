@extends('front.doctor.layout.new_master')
@section('main_content')

@php
    $email = isset($user_arr['email'])?$user_arr['email']:'';
    $password = isset($user_arr['password'])?$user_arr['password']:'';
@endphp
    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ $module_url_path }}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Email &amp; Password</h1>
        <div class="fix-add-btn">
            <a href="{{ $module_url_path.'/password/reset' }}"><span class="grey-text">Reset Password</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">edit</i></div> 
            </a>
        </div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="email" id="reason" class="validate" value=" {{ $email}}" readonly>
                <label for="reason" class="grey-text truncate">Email</label>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="password" id="reason" class="validate " value="{{ $password }}" readonly>
                <label for="reason" class="grey-text truncate">Password</label>
            </div>
        </div>
    </div>
    </div>

@endsection