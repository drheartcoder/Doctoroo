<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      @include('front.layout.css_js')
      
      
      <style>
       /*
inspired from http://codepen.io/Rowno/pen/Afykb 
          */.inner-page-box .banner-home-box{padding:  105px 0 20px}
          .carousel-inner{padding-bottom: 0;}
          .carousel-caption{position: relative;left: 0;right: auto;padding-bottom: 0;}
.carousel-fade .carousel-inner .item {
  opacity: 0;
  transition-property: opacity;
}

.carousel-fade .carousel-inner .active {
  opacity: 1;
}

.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  opacity: 0;
  z-index: 1;
}

.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}

.carousel-fade .carousel-control {
  z-index: 2;
}

/*
WHAT IS NEW IN 3.3: "Added transforms to improve carousel performance in modern browsers."
now override the 3.3 new styles for modern browsers & apply opacity
*/
@media all and (transform-3d), (-webkit-transform-3d) {
    .carousel-fade .carousel-inner > .item.next,
    .carousel-fade .carousel-inner > .item.active.right {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.prev,
    .carousel-fade .carousel-inner > .item.active.left {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.next.left,
    .carousel-fade .carousel-inner > .item.prev.right,
    .carousel-fade .carousel-inner > .item.active {
      opacity: 1;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
}

/* just for demo purpose */
    html,
    body,
    .carousel,
    .carousel-inner,
    .carousel-inner .item {
      height: 100%;
    }

    .item:nth-child(1) {
      background-color: transparent;
    }

    .item:nth-child(2) {
      background-color: transparent;
    }

    .item:nth-child(3) {
       background-color: transparent;
    }
       </style>
      
      
   </head>
   <body>

   <?php
     $user      = Sentinel::check();
     $role_user = Sentinel::inRole('patient');
   ?>
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
                          <li>
                            <a href="{{ url('/') }}/patient/notification"><img src="{{ url('/') }}/public/images/alarm.png" height="35px" width="30px" style="margin-top:10px;"></a>
                          </li>
                           <li class="my-account">
                              <ul class="navbar-right">
                
                         
                               @if($user)
                               
                                    
                                   @if($role_user)
                                          
                                          <?php 
                                            $arr_data = [];
                                            $profile_image = "";
                                            $arr_data                     = get_profile_image(); 
                                           ?>

                                           @if(isset($arr_data) && sizeof($arr_data)>0)
                                              <?php
                                                $profile_image                = $arr_data['profile_image'];
                                                $user_profile_public_img_path = $arr_data['user_profile_public_img_path'];
                                                $user_profile_base_img_path   = $arr_data['user_profile_base_img_path'];
                                              ?>

                                           @endif
                                          
                                      
                                          <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle hidden-xs hidden-sm " href="#" title="My Profile">
                                                {{ $user->first_name }} {{$user->last_name }} 

                                               <?php 
                                                    $arr_familiy_data = [];
                                                    $arr_familiy_data =  get_familiy_member_info()

                                                ?>
                                                @if(isset($arr_familiy_data) && sizeof($arr_familiy_data)>0)

                                                   ({{ $arr_familiy_data['first_name'] or '' }} {{$arr_familiy_data['last_name'] or '' }})

                                                @endif
                                                
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                <div class="user-icon">
                                                 @if(isset($profile_image) && $profile_image!="" && file_exists($user_profile_base_img_path.$profile_image))    
                                                     <img class="img-circle" src="{{ url('/') }}/timthumb.php?src={{$user_profile_public_img_path.$profile_image}}&h=40&w=40"/> 
                                                     @else
                                                     <img  class="img-circle" src="{{ url('/') }}/timthumb.php?src={{ $user_profile_public_img_path}}/default-image.jpeg&h=40&w=40" alt="" />
                                                 @endif    
                                                 </div>

                                             </a>
                                             <ul class="dropdown-menu" style="display: none;">
                                                <li><a href="#" class="hidden-md hidden-lg">Become a Recruiter</a></li>
                                                <li><a href="#" class="hidden-md hidden-lg">Help</a></li>
                                                <li><a href="{{url('/')}}/patient/profile">My Account</a></li>
                                                <li><a href="{{url('/')}}/patient/profileimage">Upload Profile</a></li>
                                                <li><a href="{{url('/')}}/patient/change_password">Change Password</a></li>
                                                <li class="last"><a href="{{ url('/') }}/logout">Logout</a></li>
                                             </ul>
                                          </li>
                                      @endif
                                    @endif 
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
                             
                               @if($user)

                                   @if($role_user)

                                       <li class="dropdown">
                                          <div class="new_new_act">
                                              <div class="dropdown">
                                                   <a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu2" type="button" class="dropdown-toggle">{{ $user->first_name }} {{$user->last_name }}<span class="caret"></span>
                                                   </a>
                                                   <ul aria-labelledby="dropdownMenu2" class="dropdown-menu">
                                                      <li><a href="{{url('/')}}/patient/profile">My Account</a></li>
                                                      <li><a href="{{ url('/') }}/logout" style="border-bottom:none;">Logout</a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </li>

                                        @endif
                                    @endif
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
                        <div id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="carousel-caption">
                <div class="grn-cls">    
                Australia’s most affordable platform – available for you anytime, anywhere 1
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="carousel-caption">
                   <div class="grn-cls">    
                    Australia’s most affordable platform – available for you anytime, anywhere 2
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="carousel-caption">
                   <div class="grn-cls">    
                    Australia’s most affordable platform – available for you anytime, anywhere 3
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Controls -->
        <!--<a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>-->
    </div>
                       
                       
                       
                       
                       
                       
                        <!--<div class="grn-cls">Welcome to Australia's way of making your health, easier.</div>-->
                        <div class="bor-light">&nbsp;</div>
                        <h1>{{ isset($page_title)?$page_title:'Patient' }}</h1>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     <script>
         $(function() {
               $('#carouselHacked').carousel();
             
             $('.carousel').carousel({
                  interval: 20000
                })
            });
      </script>
