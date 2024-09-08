<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />
      <meta name="author" content="" />
      <title>Doctoroo</title>
      <meta property="og:title" content="Doctroo" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="http://www.webwingtechnologies.com/" />
      <meta property="og:image" content="images/Doctroo.jpg" />
      <meta property="og:description" content="Doctroo" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      <!-- ======================================================================== -->
      <link rel="icon" href="{{ url('/') }}/public/images/favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{ url('/') }}/public/css/bootstrap.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/css/doctroo.css" rel="stylesheet" />
      <!--font-awesome-css-start-here-->
      <link href="{{ url('/') }}/public/css/font-awesome.min.css" rel="stylesheet" />
      <!--model popup css-->
      <link href="{{ url('/') }}/public/css/bootstrap-modal.css" rel="stylesheet" />
      <style>
         .modal.container {max-width: none;}
         .modal-backdrop {position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;}
      </style>
      <!--dashboard menu-->
      <link href="{{ url('/') }}/public/css/dashboard-menu.css" rel="stylesheet" />
      <!-- datepicker css start-->
      <link href="{{ url('/') }}/public/css/jquery-ui.css" rel="stylesheet" />
      <script  src="{{ url('/') }}/public/js/jquery-1.11.3.min.js"></script>
   </head>
   <body>
      <!--header menus start here-->
      <div class="inner-header navbar-fixed-top">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-2 col-md-2 col-lg-2">
                  <div class="inner_logo">
                     <a href="{{ url('/') }}" class="hidden-xs hidden-sm hidden-md inner-logo"><img src="{{ url('/') }}/public/images/logo.png" alt="Doctoroo"/></a>
                     <a href="{{ url('/') }}" class="hidden-lg "><img src="{{ url('/') }}/public/images/logo.png" alt="Doctoroo" /></a>
                  </div>
               </div>
               <div class="col-xs-7 col-sm-10 col-md-10 col-lg-10">
                  <div class="button-right">
                     <div class="menublock main-menu hidden-xs hidden-sm hidden-md">
                        <ul class="after-login">
                           <li class="my-account">
                              <ul class="navbar-right">
                               <?php
                               $user = Sentinel::check();
                               
                               if($user)
                               {
                                   $role_user = Sentinel::inRole('patient');

                                   if($role_user)
                                   { 
                                       ?>
                                          <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle hidden-xs hidden-sm " href="#" title="My Profile">
                                                {{ $user->first_name }} {{$user->last_name }} <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                <div class="user-icon">

                                                   <img alt="" class="img-circle" src="{{ url('/') }}/public/images/ph1.png" />
                                                </div>
                                             </a>
                                             <ul class="dropdown-menu" style="display: none;">
                                                <li><a href="#" class="hidden-md hidden-lg">Become a Recruiter</a></li>
                                                <li><a href="#" class="hidden-md hidden-lg">Help</a></li>
                                                <li><a href="{{url('/')}}/patient/profile">My Account</a></li>
                                                <li><a href="#">Unavailable Dates</a></li>
                                                <li class="last"><a href="{{ url('/') }}/patient/logout">Logout</a></li>
                                             </ul>
                                          </li>
                                    <?php } }?>      
                              </ul>
                           </li>
                        </ul>
                     </div>
                     <!--responsive menu start here-->
                     <!-- Sidebar -->
                     <div class="main-menu hidden-lg">
                        <div id="wrapper">
                           <div class="overlay"></div>
                           <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                              <div class="sidebar-brand">
                              </div>
                              <ul class="nav sidebar-nav">
                               <?php
                               $user = Sentinel::check();
                               
                               if($user)
                               {
                                   $role_user = Sentinel::inRole('patient');

                                   if($role_user)
                                   { 
                                       ?>
                                          <li class="dropdown">
                                             <div class="new_new_act">
                                                <div class="dropdown">
                                                   <a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu2" type="button" class="dropdown-toggle">{{ $user->first_name }} {{$user->last_name }}<span class="caret"></span>
                                                   </a>
                                                   <ul aria-labelledby="dropdownMenu2" class="dropdown-menu">
                                                      <li><a href="{{url('/')}}/patient/profile">My Account</a></li>
                                                      <li><a href="javascript:void(0);">Unavailable Dates</a></li>
                                                      <li><a href="{{ url('/') }}/patient/logout" style="border-bottom:none;">Logout</a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </li>
                                    <?php } }?>            
                              </ul>
                           </nav>
                           <div id="page-content-wrapper">
                              <button type="button" class="hamburger is-closed animated fadeInRight" data-toggle="offcanvas">
                              </button>
                           </div>
                        </div>
                     </div>
                     <!-- /#sidebar-wrapper -->
                     <!--responsive menu end here-->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--header menus end  here-->
      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
         -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
         <div class="bg-shaad inner-page-shaad">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-home-box">
                        <div class="grn-cls">Welcome to Australia's way of making your health, easier.</div>
                        <div class="bor-light">&nbsp;</div>
                        <h1>{{ isset($page_title)?$page_title:'Patient' }}</h1>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard menu-->      
      <?php $currentUrl  = Route::getCurrentRoute()->getPath(); ?>
      <div class="dashboard-menu">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="nav">
                     <ul class="nav-list">
                        <li class="nav-item"><a href="#" class="menu_class">See a Doctor </a></li>
                        <li class="nav-item"><a href="" class="menu_class">My Health</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">My Pharmacy &amp; Orders</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">Messages</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">Documents</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">Family Members</a></li>
                        <li class="nav-item lst-bor-0"><a href="{{url('/')}}/patient/profile" @if($currentUrl=='patient/profile') class="act menu_class" @else class="menu_class" @endif>My Account</a></li>
                     </ul>
                     <div class="clr"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard menu-->   