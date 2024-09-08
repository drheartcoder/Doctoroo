@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

 <div class="header questionhead z-depth-2">
        <div class="backarrow "><a href="{{url('/patient')}}/my_health" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align truncate">Ask Doctor a Free Question</h1>


    </div>
    <div class="container has-header">
        <div class="center-align patchque">
            <span class="circle btn-floating green large">&#63;</span>
            <h3 class="bluedoc-text">
                        Hello John,
                        <span>how can the doctor help you today?</span>
                    </h3>
        </div>

        <div class="form">
            <div class="input-field col s12 text-bx">

                <input type="text" id="reason" class="validate">
                <label for="reason" data-error="wrong" data-success="right">Enter your question</label>
            </div>

            <div class="input-field col s12 marbtmspace ">
                <div class="file-field input-field fullbtn">
                    <div class="btn transparent">
                        <span class="truncate"><i class="material-icons white-text">camera_alt</i> Upload one or more files</span>

                        <input type="file" multiple>
                    </div>
                    <!--<div class="file-path-wrapper">
                                <input class="file-path validate white-text" type="text" placeholder="Upload one or more files">
                            </div>-->
                </div>
                <div class="clr"></div>
            </div>

            <div class="noteNew center-align">Not for emergencies or <a href="{{ url('/patient') }}/emergencies_warning">any of these.</a></div>
            <a class="waves-effect waves-light btn cart bluedoc-bg round-corner truncate" href="{{ url('/patient') }}/my_health#askdoctor">Send My Question</a>

            <div class="center-align reschange "><a class="border-btn round-corner truncate" href="{{ url('/patient') }}/search_available_doctors">See a doctor online instead</a></div>
        </div>
    </div>


    <!--Container End-->

    @endsection