@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')


  <div class="header medicationhead z-depth-2">
        <div class="backarrow "><a href="{{url('/patient')}}/my_health" class="center-align"><i class="material-icons">close</i></a></div>
        <h1 class="main-title center-align truncate">Medication Details</h1>


    </div>
    <div class="container has-header minhtnor medicationmain">
        <div class="form">
            <div class="input-field col s12 text-bx">
                <input type="text" id="reason" class="validate">
                <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter medication name or active ingredient</label>
            </div>
            <span class="right qusame rescahnge"><a href="{{ url('/patient') }}/my_health#medication" class="btn cart bluedoc-bg lnht round-corner">SAVE</a></span>

            
            <div class="clr"></div>

        </div>
        
    </div>


    <!--Container End-->
@endsection