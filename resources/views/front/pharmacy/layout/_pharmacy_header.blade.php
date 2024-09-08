<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--header menus start here-->

<?php 
   $user         = Sentinel::check();
   $arr_pharmacy = get_pharmacy_profile_data();


?>
<div class="inner-header navbar-fixed-top">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2 col-md-2 col-lg-2">
            <div class="inner_logo">
               <a href="{{ url('/') }}" class="hidden-xs hidden-sm hidden-md inner-logo"><img src="{{ url('/') }}/public/images/logo.png" alt="DoctorOO"/></a>
               <a href="{{ url('/') }}" class="hidden-lg "><img src="{{ url('/') }}/public/images/logo.png" alt="Doctroo" /></a>
            </div>
         </div>
         <div class="col-xs-7 col-sm-10 col-md-10 col-lg-10">
            <div class="button-right">
               <div class="menublock main-menu hidden-xs hidden-sm hidden-md">
                  <ul class="after-login">
                     <li class="my-account">
                        <ul class="navbar-right">
                           <li class="dropdown">
                              <a data-toggle="dropdown" class="dropdown-toggle hidden-xs hidden-sm " href="javascript:void(0);" title="My Profile">
                                 {{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}
                                 <i class="fa fa-angle-down" aria-hidden="true"></i>

                               <div class="user-icon">
                              @if(isset($arr_pharmacy) && sizeof($arr_pharmacy)>0)
                                
                                    @if(isset($arr_pharmacy['logo']) && $arr_pharmacy['logo']!='' && file_exists($arr_pharmacy['pharmacy_base_img_path'].'/'.$arr_pharmacy['logo'])) 
                                          <img src="{{ $arr_pharmacy['pharmacy_public_img_path'].'/'.$arr_pharmacy['logo'] }}"  class="img-circle" alt="pro img"/>
                                    @else
                                          <img src="{{ $arr_pharmacy['pharmacy_public_img_path'] }}/default-image.jpeg" class="img-circle" alt="pro img"/>
                                    @endif
                               @else
                                    <img src="{{ url('/') }}/public/uploads/front/pharmacy/default-image.jpeg" class="img-circle" alt="pro img"/>
                              @endif
                                </div>

                              </a>

                            @if($user)

                              <ul class="dropdown-menu" style="display: none;">
                                 <li><a href="#" class="hidden-md hidden-lg">Become a Recruiter</a></li>
                                 <li><a href="#" class="hidden-md hidden-lg">Help</a></li>
                                 <li><a href="{{ $module_url_path }}/profile_step1">My Account</a></li>
                                 <li><a href="#">Unavailable Dates</a></li>
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
                           <li class="dropdown">
                              <div class="new_new_act">
                                 <div class="dropdown">

                                    @if($user)   
                                   
                                        <a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu2" type="button" class="dropdown-toggle">{{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}
                                        <span class="caret"></span>
                                        </a>

                                  
                                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu">
                                          <li><a href="{{ $module_url_path }}/profile_step1">My Account</a></li>
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