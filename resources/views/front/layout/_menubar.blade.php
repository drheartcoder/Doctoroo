  <?php        
$user = Sentinel::check();
?>
<div class="navbar-fixed-top">
<div class="inner-header">
   <div class="container-fluid">
     <div class="top-bar visible-lg">
        <a href="{{ url('/doctor') }}"><span> <i class="fa fa-user-md"></i></span> Doctor</a>
        <a href="javascript:void(0);">|</a>
        <a href="{{ url('/pharmacy') }}"> <span><i class="fa fa-medkit"></i> </span>Pharmacy</a>
    </div>
      <div class="row">
         <div class="col-sm-6 col-md-3 col-lg-2">
            <div class="inner_logo wow fadeInDown">
               <a href="{{ url('/') }}" class="logo-min visible-lg"><img src="{{ url('/') }}/public/images/logo.png" alt="Doctoroo"/></a>
               <a href="{{ url('/') }}" class="res-min hidden-lg"><img src="{{ url('/') }}/public/images/logo.png" alt="Doctoroo"/></a>
               <?php
                $user = Sentinel::check();
                if($user==null){ ?>
               <a href="#app-comingsoon" data-toggle="modal" class="app-min hidden-lg"><img src="{{ url('/') }}/public/images/app-logo.png" alt="Doctoroo"/></a>
               <a href="#app-comingsoon" data-toggle="modal" class="app-min hidden-lg"><img src="{{ url('/') }}/public/images/play-store-logo.png" alt="Doctoroo"/></a>
               <?php } ?>
            </div>
         </div>
         <div class="col-xs-7 col-sm-7 col-md-7 col-lg-10">
            <div class="button-right">
                <div class="menublock my-account1 main-menu hidden-xs hidden-sm hidden-md wow slideInRight">
                  <ul class="after-login">
                   <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle"> <span class="header-icon-text hidden-xs hidden-sm">Our Mission</span></a>
                        <ul style="display: none;" class="dropdown-menu">
                          <li><a href="{{ url('/talk-to-a-doctor-online') }}">Talk to a Doctor online</a></li>
                          <li><a href="{{ url('/see-a-doctor-at-home') }}">See a Doctor at home</a></li>
                          <li><a href="{{ url('/online-doctor-prescriptions') }}">Online Doctor Prescriptions</a></li>
                          <li><a href="{{ url('/online-doctors-certificate') }}">Online Doctors Certificate</a></li>
                          <li><a href="{{ url('/online-doctors') }}">Online Doctors</a></li>
                          <li><a href="{{ url('/online-doctor-consultations') }}">Online Doctor Consultations</a></li>
                          <li class="last"><a href="{{ url('/after-hours-home-doctor') }}">After hours home Doctor</a></li>
                       </ul>
                     </li>  -->
                     <!-- <li>
                        <a href="{{url('/')}}/health/about-us"> <span class="header-icon-text hidden-xs hidden-sm ">About Us</span></a>
                     </li>
                     <li>
                        <a href="{{url('/')}}/health/what-we-do"> <span class="header-icon-text hidden-xs hidden-sm ">What we do</span></a>
                     </li> -->
                     <li>
                        <a href="" class="act"> <span class="header-icon-text hidden-xs hidden-sm ">See a Doctor</span></a>
                     </li>
               
                      @if($user)
                          <?php  
                              $role_user_patient  = Sentinel::inRole('patient'); 
                              $role_user_pharmacy = Sentinel::inRole('pharmacy'); 
                              $role_user_doctor   = Sentinel::inRole('doctor');
                          ?>
                          @if($role_user_patient)
                          <li><a href="{{url('/')}}/patient/profile">My Account </a></li>
                          @elseif($role_user_pharmacy)
                          <li><a href="{{url('/')}}/pharmacy/profile_step1">My Account </a></li>
                          @elseif($role_user_doctor)
                          <li><a href="{{url('/')}}/doctor/profile/dashboard">My Account </a></li>
                          @else
                          <li>
                            <a data-toggle="modal" href="#login"> <span class="header-icon-text hidden-xs hidden-sm ">Log in </span></a>
                          </li>
                          <li>
                            <a data-toggle="modal" href="#signup" class="lst-cls"> <span class="header-icon-text hidden-xs hidden-sm ">Sign Up</span></a>
                          </li>
                          @endif
                      @else
                          <li>
                            <a data-toggle="modal" href="#login"> <span class="header-icon-text hidden-xs hidden-sm ">Log in </span></a>
                          </li>
                          <li>
                            <a data-toggle="modal" href="#signup" class="lst-cls"> <span class="header-icon-text hidden-xs hidden-sm ">Create Account</span></a>
                          </li>
                      @endif
                           
                  </ul>
               </div>
               <!--responsive menu start here-->
               <!-- Sidebar -->
               <div class="main-menu home-res-menu hidden-lg">
                  <div id="wrapper">
                     <div class="overlay"></div>
                     <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                        <div class="sidebar-brand">
                        </div>
                        <ul class="nav sidebar-nav">
                            <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Our Services  <i class="fa fa-angle-down"></i></a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ url('/talk-to-a-doctor-online') }}">Talk to a Doctor online</a></li>
                                <li><a href="{{ url('/see-a-doctor-at-home') }}">See a Doctor at home</a></li>
                                <li><a href="{{ url('/online-doctor-prescriptions') }}">Online Doctor Prescriptions</a></li>
                                <li><a href="{{ url('/online-doctors-certificate') }}">Online Doctors Certificate</a></li>
                                <li><a href="{{ url('/online-doctors') }}">Online Doctors</a></li>
                                <li><a href="{{ url('/online-doctor-consultations') }}">Online Doctor Consultations</a></li>
                                <li class="last"><a href="{{ url('/after-hours-home-doctor') }}">After hours home Doctor</a></li>
                             </ul>
                           </li>
                           <!-- <li> <a  href="{{ url('/') }}/health/about-us">About Us</a></li>
                           <li> <a href="{{ url('/') }}/health/what-we-do">What we do</a> </li> -->
                           <li> <a href="#">See a Doctor</a> </li>
                          
                            @if($user)
                                <?php  
                                    $role_user_patient  = Sentinel::inRole('patient'); 
                                    $role_user_pharmacy = Sentinel::inRole('pharmacy'); 
                                    $role_user_doctor   = Sentinel::inRole('doctor');
                                ?>
                                @if($role_user_patient)
                                <li><a href="{{url('/')}}/patient/profile">My Account </a></li>
                                @elseif($role_user_pharmacy)
                                <li><a href="{{url('/')}}/pharmacy/profile_step1">My Account </a></li>
                                @elseif($role_user_doctor)
                                <li><a href="{{url('/')}}/doctor/profile/dashboard">My Account </a></li>
                                @else
                                <li>
                                  <a data-toggle="modal" href="#login">Log in</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" href="#signup" class="lst-cls">Create Account</a>
                                </li>
                                
                                @endif
                            @else
                            <li>
                              <a data-toggle="modal" href="#login">Log in</a>
                            </li>
                            <li>
                              <a data-toggle="modal" href="#signup" class="lst-cls">Create Account</a>
                            </li>
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
            <div class="clearfix"></div>
         </div>
      </div>
   </div>
</div>
</div>
<?php $currentUrl  = Route::getCurrentRoute()->getPath();
  if($currentUrl=="pharmacy"){
 ?>
    <div class="grrn-strip hidden-xs hidden-sm hidden-md" id="banner_text_id" <?php if(array_key_exists('search_term', $_GET)){echo 'style="display:none;"';}else{echo 'style="display:block;"';} ?>>
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="doc-reg">
                        Register your Interest to Join our platform!
                     </div>
                  </div>
                  <?php
                      $user = Sentinel::check();
                  ?>
                  @if($user==false)
                  <div class="col-sm-6 col-md-6 col-lg-6 join-regi-btn">
                   <button class="doc-log-btn" onclick="openLoginModal()">Login</button>
                   <button class="doc-reg-btn" id="pharmacy_register_id">Register Now</button>                  
                  </div>
                  @else
                  <div class="col-sm-3 col-md-3 col-lg-2">
                  &nbsp;
                  </div>
                  @endif
               </div>
            </div>
    </div>
<?php } 
if($currentUrl=="doctor"){
?>
 <div class="grrn-strip hidden-xs hidden-sm hidden-md">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="doc-reg">
                        Register your Interest to Join our platform!
                     </div>
                  </div>
                  
                      <?php
                      $user = Sentinel::check();
                      if($user==null){ ?>
                     <div class="col-sm-6 col-md-6 col-lg-6 join-regi-btn">
                     <button class="doc-log-btn" data-toggle="modal" href="#dlogin">Login</button>
                     <button class="doc-reg-btn" data-toggle="modal" href="#join-doc-popup">Register Now</button>
                     <!-- <button class="doc-reg-btn" href="{{ url('/') }}/doctor/signup/step1">Register Now</button> -->
                     
                     <div class="clearfix"></div>
                     </div>
                     <?php }else{?>
                     <div class="col-sm-6 col-md-6 col-lg-6 join-regi-btn">&nbsp;</div>
                     <?php } ?>
               </div>
            </div>
</div>
<?php } ?>

<!--header menus end  here-->