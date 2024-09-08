<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> -->
<!--header menus start here-->
<div class="inner-header navbar-fixed-top">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2 col-md-2 col-lg-2">
            <div class="inner_logo">
               <a href="{{ url('/') }}" class="hidden-xs hidden-sm hidden-md inner-logo"><img src="{{url('/')}}/public/images/logo.png" alt="Doctoroo"/></a>
               <a href="{{ url('/') }}" class="hidden-lg "><img src="{{url('/')}}/public/images/logo.png" alt="Doctoroo" /></a>
            </div>
         </div>

         <?php
            $arr_doctor_data = [];
            $arr_doctor_data=get_doctor_profile_data();

         ?>

         <div class="col-xs-7 col-sm-10 col-md-10 col-lg-10">
            <div class="button-right">
               <div class="menublock main-menu hidden-xs hidden-sm hidden-md">
                  <ul class="after-login">
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <!--<li>
                        <a href=""> <span class="header-icon-text hidden-xs hidden-sm ">About</span></a>
                        </li>-->
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <!--<li>
                        <a href="#"> <span class="header-icon-text hidden-xs hidden-sm ">Going global  </span></a>
                        </li>-->
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <!--<li>
                        <a data-toggle="modal" href="#login"> <span class="header-icon-text hidden-xs hidden-sm ">Log in </span></a>
                        </li>-->
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <!--<li>
                        <a href="#"> <span class="header-icon-text hidden-xs hidden-sm ">Member Sign Up </span></a>
                        </li>-->
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <!--<li>
                        <a href="#"> <span class="header-icon-text hidden-xs hidden-sm ">Doctor Sign Up</span></a>
                        </li>-->
                     <!-- <div class="hidden-xs hidden-sm hidden-md seprator line">|</div>-->
                     <li class="my-account">
                        <ul class="navbar-right">
                           <li class="dropdown">
                              <a data-toggle="dropdown" class="dropdown-toggle hidden-xs hidden-sm " href="#" title="My Profile">
                                 {{ $arr_doctor_data['title'] or '' }} {{ $arr_doctor_data['first_name'] or '' }} {{ $arr_doctor_data['last_name'] or '' }}<i class="fa fa-angle-down" aria-hidden="true"></i>
                                 <div class="user-icon">

                                 @if(isset($arr_doctor_data) && sizeof($arr_doctor_data)>0) 
                                    @if(isset($arr_doctor_data['profile_image']) && $arr_doctor_data['profile_image']!='' && file_exists($arr_doctor_data['doctor_base_img_path'].$arr_doctor_data['profile_image']))

                                        <img src="{{ $arr_doctor_data['doctor_public_img_path'].$arr_doctor_data['profile_image'] }}" class="img-circle" alt="pro img"/>
                                    @else
                                        <img src="{{$arr_doctor_data['doctor_public_img_path'].'default-image.jpeg'}}" class="img-circle" alt="pro img"/>
                                    @endif
                                 @else
                                     <img src="{{ url('/')}}/public/uploads/front/doctor/default-image.jpeg" class="img-circle" alt="pro img"/>
                                 @endif
                                     

                                 </div>
                              </a>
                              @if(isset($arr_doctor_data) && sizeof($arr_doctor_data)>0)
                                 <ul class="dropdown-menu" style="display: none;">
                                    <li><a href="#" class="hidden-md hidden-lg">Become a Recruiter</a></li>
                                    <li><a href="#" class="hidden-md hidden-lg">Help</a></li>
                                    <li><a href="{{ url('/') }}/doctor/profile/step1">My Account</a></li>
                                    <li><a href="{{ url('/') }}/doctor/profile/change_password">Change Password</a></li>
                                    <li class="last"><a href="{{ url('/') }}/logout">Logout</a></li>
                                 </ul>
                              @endif
                           </li>
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
                           <!-- <li> <a  href="">About</a></li>
                              <li> <a href="#">Going global</a> </li>-->
                           <!--<li> <a data-toggle="modal" href="#login">Log in</a> </li>
                              <li> <a href="#">Member Sign Up</a> </li>
                              <li> <a href="#">Doctor Sign Up</a> </li>-->
                           <li class="dropdown">
                              <div class="new_new_act">
                                 <div class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu2" type="button" class="dropdown-toggle">Dr.{{ $arr_doctor_data['first_name'] or '' }} {{ $arr_doctor_data['last_name'] or '' }}<span class="caret"></span>
                                    </a>
                                  @if(isset($arr_doctor_data) && sizeof($arr_doctor_data)>0)
                                    <ul aria-labelledby="dropdownMenu2" class="dropdown-menu">
                                       <li><a href="{{ url('/') }}/doctor/profile/step1">My Account</a></li>
                                       <li><a href="#">Unavailable Dates</a></li>
                                       <li><a href="#" style="border-bottom:none;">Contact</a></li>
                                        <li class="last"><a href="{{ url('/') }}/logout">Logout</a></li>
                                    </ul>
                                  @endif
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </nav>
                     <div id="page-content-wrapper">
                        <button type="button" class="hamburger is-closed animated fadeInRight" data-toggle="offcanvas">
                           <!--    <span class="hamb-top"></span> <span class="hamb-middle"></span> <span class="hamb-bottom"></span>-->
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
