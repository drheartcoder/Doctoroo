@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')
   
   <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/my_consulations" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Notifications</h1>
        <div class="savebtntop"><a class=" btn-flat">Save</a></div>
    </div>
    {{-- {{dd(base_path('public/images'))}} --}}
    
    <div class="container posrel has-header padtp minhtnor">
<ul class="collection brdrtopsd marbt">
                    <li class="collection-item">
                        <div class="valign-wrapper quest">
                            <span class="circle btn-floating red center-align large">IL</span>
                            <a href="#" class="">
                                <p class="bluedoc-text"><strong>Jonathan Simonthanian</strong> has confirmed your consultation</p>
                                <small class="bluedoc-text"><strong>Consultation ID: 1138552</strong></small>
                                <small class="bluedoc-text"><strong>4 months ago</strong></small>
                            </a>

                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="valign-wrapper quest">
                            <span class="circle btn-floating red center-align large">IL</span>
                            <a href="#" class="">
                                <p class="bluedoc-text"><strong>Jonathan Simonthanian</strong> has confirmed your consultation</p>
                                <small class="bluedoc-text"><strong>Consultation ID: 1138552</strong></small>
                                <small class="bluedoc-text"><strong>4 months ago</strong></small>
                            </a>

                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="valign-wrapper quest">
                            <span class="circle btn-floating red center-align large">IL</span>
                            <a href="#" class="">
                                <p class="bluedoc-text"><strong>Jonathan Simonthanian</strong> has confirmed your consultation</p>
                                <small class="bluedoc-text"><strong>Consultation ID: 1138552</strong></small>
                                <small class="bluedoc-text"><strong>4 months ago</strong></small>
                            </a>

                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="valign-wrapper quest">
                            <span class="circle btn-floating red center-align large">IL</span>
                            <a href="#" class="">
                                <p class="bluedoc-text"><strong>Jonathan Simonthanian</strong> has confirmed your consultation</p>
                                <small class="bluedoc-text"><strong>Consultation ID: 1138552</strong></small>
                                <small class="bluedoc-text"><strong>4 months ago</strong></small>
                            </a>

                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="valign-wrapper quest">
                            <span class="circle btn-floating red center-align large">IL</span>
                            <a href="#" class="">
                                <p class="bluedoc-text"><strong>Jonathan Simonthanian</strong> has confirmed your consultation</p>
                                <small class="bluedoc-text"><strong>Consultation ID: 1138552</strong></small>
                                <small class="bluedoc-text"><strong>4 months ago</strong></small>
                            </a>

                        </div>
                    </li>
                </ul>
    </div>

    @endsection