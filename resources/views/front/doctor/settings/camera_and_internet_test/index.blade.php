@extends('front.doctor.layout.new_master')
@section('main_content')

  <div class="header bookhead z-depth-2 ">
        <div class="backarrow"><a href="{{$module_url_path}}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">About Doctoroo</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <p>
        <span class="title ">Please check the quality of your internet, camera and microphone and whether your device & browser support the doctoroo platform. If there are any issues, please test and have the consultation from another device or browser. </span>
        </p>

        <span class="qusame rescahnge"><a href="https://tokbox.com/developer/tools/precall/" target="_blank" class="btn cart bluedoc-bg lnht round-corner">Pre-Call Test</a></span>
        
    </div>
    </div>
    <!--Container End-->
    @endsection