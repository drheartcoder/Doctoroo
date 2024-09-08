@extends('admin.layout.master')                
@section('main_content')
<?php $admin_path = config('app.project.admin_panel_slug'); ?>

    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-file-o"></i> Dashboard</h1>
            <h4>Overview, stats, chat and more</h4>
             
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active"><i class="fa fa-home"></i> Home</li>

        </ul>
    </div>
    <!-- END Breadcrumb -->


    <!-- BEGIN Tiles -->
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6 tile-active">
                            <a class="tile tile-blue" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/account_settings'}}">
                                <div class="img img-center">
                                    <i class="fa fa-server"></i>
                                </div>
                                <p class="title text-center">Account Settings</p>
                            </a>

                            <a class="tile tile-green" href="{{ url('/').'/'.$admin_path.'/account_settings'}}">
                                <p>Manage your account Settings.</p>
                            </a>
                        </div>

                       <div class="col-md-6 tile-active">
                            <a class="tile tile-green" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/static_pages'}}">
                                <div class="img img-center">
                                    <i class="fa  fa-sitemap"></i>
                                </div>
                                <p class="title text-center">Front Pages</p>
                            </a>

                            <a class="tile tile-pink" href="{{ url('/').'/'.$admin_path.'/static_pages'}}">
                                <p>Manage front pages, you can add,edit,delete by front pages also...</p>
                            </a>
                        </div>
                     </div>

                    <div class="row">
                        <div class="col-md-6 tile-active">
                            <a class="tile tile-pink" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/speciality'}}">
                                <div class="img img-center">
                                    <i class="fa fa-medkit"></i>
                                </div>
                                <p class="title text-center">Site Settings</p>
                            </a>

                            <a class="tile tile-orange" href="{{ url('/').'/'.$admin_path.'/speciality'}}">
                                <p>Manage site status.</p>
                            </a>
                        </div>

                        <div class="col-md-6 tile-active">
                           <a class="tile tile-orange" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/ContactEnquiry'}}">
                                <div class="img img-center">
                                    <i class="fa  fa-wrench"></i>
                                </div>
                                <p class="title text-center">Contact Enquiry</p>
                            </a>

                            <a class="tile tile-dark-blue" href="{{ url('/').'/'.$admin_path.'/ContactEnquiry'}}">
                                <p>Manage site status.</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 tile-active">
                            <div class="tile tile-magenta">
                                <div class="img img-center">
                                    <i class="fa fa-medkit"></i>
                                </div>
                                <p class="title text-center">Doctor Speciality</p>
                            </div>

                            <div class="tile tile-blue">
                                <p class="title">Doctor Speciality</p>
                                <p>Manage doctor speciality, you can add,edit,delete by doctor speciality also..</p>
                                <div class="img img-bottom">
                                    <i class="fa fa-medkit"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 tile-active">
                            <div class="tile tile-lime">
                                <div class="img img-center">
                                   <i class="fa fa-puzzle-piece"></i>
                                </div>
                                <p class="title text-center">How It Work Section</p>
                            </div>

                            <div class="tile tile-sky-blue">
                                <p class="title">How It Work Section</p>
                                <p>Manage How It Work Section.</p>
                                <div class="img img-bottom">
                                   <i class="fa fa-puzzle-piece"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="content">
                            <p class="big">128</p>
                            <p class="title">Comments</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-download"></i>
                        </div>
                        <div class="content">
                            <p class="big">+160</p>
                            <p class="title">Downloads</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 tile-active">
                    <div class="tile tile-img" data-stop="3500" style="background-image: url(img/demo/gallery/5.jpg);">
                        <p class="title">Gallery</p>
                    </div>

                    <a class="tile tile-lime" data-stop="5000" href="">
                        <p class="title">Gallery page</p>
                        <p>Click on this tile block to see our amazing gallery page. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="img img-bottom">
                            <i class="fa fa-picture-o"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- END Tiles -->
               
@stop