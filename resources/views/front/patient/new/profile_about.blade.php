@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')


    <div class="header profileHead  z-depth-2">
        <div class="backarrow"><a href="{{ url('/patient') }}/search_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
    </div>

    <div class="container has-header profile">
        <div class="subheader">
            <div class="profilesumm">
                <div class="row">
                    <div class="col s12">
                        <div class="valign-wrapper">
                            <img src="{{ url('/') }}/public/new/images/avtar-4.png" class="circle left" />
                            <p>Dr. Jonathan Smithonian <small>MBBS (Syd. Uni),  FRACCS, Grad. Dip</small></p>
                        </div>

                    </div>
                </div>
            </div>
            <iframe src="https://www.youtube.com/embed/KXdUNp_9oHs" frameborder="0" allowfullscreen class="videoBox responsive-video"></iframe>
            
        </div>
        <div class="tabli  z-depth-2">
             <ul >
                  <li  class="active">
                    <a href="{{ url('/patient') }}/profile_about" class="valign-wrapper">About Me</a>
                </li>
                <li>
                    <a href="{{ url('/patient') }}/profile_availibility" class="valign-wrapper">Availibility</a>
                </li>
                </ul>
            </div>
        
        <div class="data-content">
            <div class="tab">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active waves-effect waves-light">About Me<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <span>My name is Doctor Jonthan Smithonian and l've been practicing medicene for the past 7 years and<a href="#">  Read more</a></span>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header active waves-effect waves-light">Education<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <ul class="blt">
                            <li>Bachelor of Medicine, Sydney University, 2003</li>
                            <li>Bachelor of Medicine, Sydney University, 2003</li>
                            <li>Bachelor of Medicine, Sydney University, 2003</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header active waves-effect waves-light">Languages<i class="material-icons right">expand_more</i></div>
                    <div class="collapsible-body">
                        <ul class="blt">
                            <li>English</li>
                            <li>Spanish</li>
                            <li>French</li>
                        </ul>
                    </div>
                </li>
            </ul></div>
        </div>

    </div>

@endsection