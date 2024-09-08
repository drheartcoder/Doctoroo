<?php $user = Sentinel::check(); ?>
<div class="navbar-fixed-top">
<div class="inner-header">
   <div class="container-fluid">
      <?php
      $user = Sentinel::check();
        if($user == null){
         ?>
         <div class="top-bar visible-lg">
            <a href="{{ url('/') }}" class="<?php if(Request::segment(1) == '' || Request::segment(1) == 'health' || Request::segment(1) == 'blogs' || Request::segment(1) == 'after-hours-home-doctor' || Request::segment(1) == 'online-doctor-consultations' || Request::segment(1) == 'online-doctors' || Request::segment(1) == 'online-doctor-prescriptions' || Request::segment(1) == 'see-a-doctor-at-home' || Request::segment(1) == 'talk-to-a-doctor-online' || Request::segment(1) == 'chat-with-a-doctor' || Request::segment(1) == 'online-doctors-australia' || Request::segment(1) == 'dial-a-doctor-on-demand' || Request::segment(1) == 'book-a-doctor-online-in-australia' || Request::segment(1) == 'see-a-gp-online' || Request::segment(1) == 'home-doctor-service-online' || Request::segment(1) == 'get-a-sick-note-and-doctor-certificate' || Request::segment(1) == 'homepage-doctoroo' || Request::segment(1) == 'see-a-doctor-at-home-without-travelling-anywhere' || Request::segment(1) == 'thankyou' || Request::segment(1) == 'ICareForYou' || Request::segment(1) == 'patient' || Request::segment(1) == 'home' || Request::segment(1) == 'resetpassword' ){ echo 'active'; } ?>"><span> <i class="fa fa-user"></i></span> Patient</a>
            <a href="javascript:void(0);">|</a>
            <a href="{{ url('/doctor') }}" class="<?php if(Request::segment(1) == 'doctor' ){ echo 'active'; } ?>" ><span> <i class="fa fa-user-md"></i></span> Doctor</a>
            <a href="javascript:void(0);">|</a>
            <a href="{{ url('/pharmacy') }}" class="<?php if(Request::segment(1) == 'pharmacy' ){ echo 'active'; } ?>"> <span><i class="fa fa-medkit"></i> </span>Pharmacy</a>
        </div>
    <?php }else{ ?>
      <div class="top-bar visible-lg" style="height: 30px;">
      </div>
    <?php } ?>

      <div class="row">
         <div class="col-sm-5 col-md-5 col-lg-2">
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
                    <li>
                        <a href="{{url('/')}}/health/about-us"> <span class="header-icon-text hidden-xs hidden-sm ">Our Mission</span></a>
                     </li>
                     
                     <!-- show only to patient, hide to doctor and pharmacy starts -->
                     <?php if(Request::segment(1) != 'pharmacy' && Request::segment(1) != 'doctor' ){ ?>
                     <li>
                        <a href="javascript:void(0);" class="act scrolld get_page_url"> <span class="header-icon-text hidden-xs hidden-sm ">See a Doctor</span></a>
                     </li>
                     <?php } ?>
                     <!-- show only to patient, hide to doctor and pharmacy ends -->
               
                      @if($user)
                          <?php  
                              $role_user_patient  = Sentinel::inRole('patient'); 
                              
                              $role_user_pharmacy = Sentinel::inRole('pharmacy'); 
                              
                              $role_user_doctor   = Sentinel::inRole('doctor');
                              
                          ?>

                          @if($role_user_patient)
                            <li><a href="{{url('/')}}/patient/dashboard">My Account </a></li>
                          @elseif($role_user_pharmacy)
                            <li><a href="{{url('/')}}/pharmacy/profile_step1">My Account </a></li>
                          @elseif($role_user_doctor)
                            <li><a href="{{url('/')}}/doctor/profile/dashboard">My Account </a></li>
                          @else
                          <li>
                            <a data-toggle="modal" href="#login"> <span class="header-icon-text hidden-xs hidden-sm ">Log in </span></a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="lst-cls scrolld"> <span class="header-icon-text hidden-xs hidden-sm ">Sign Up</span></a>
                          </li>
                          @endif
                      @else

                          <!-- Patient Sign-up and login-in starts -->
                          <?php if(Request::segment(1) != 'pharmacy' && Request::segment(1) != 'doctor' ){ ?>
                          <li>
                            <a data-toggle="modal" href="#login"> <span class="header-icon-text hidden-xs hidden-sm">Log in </span></a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="lst-cls scrolld get_page_url"> <span class="header-icon-text hidden-xs hidden-sm ">Create Account</span></a>
                          </li>
                          <?php } ?>
                          <!-- Patient Sign-up and login-in ends -->

                          <!-- Doctor Sign-up and login-in starts -->
                          <?php if(Request::segment(1) == 'doctor' && Request::segment(1) != 'pharmacy' && Request::segment(1) != '' ){ ?>
                          <li>
                            <a data-toggle="modal" href="#dlogin"> <span class="header-icon-text hidden-xs hidden-sm">Log in </span></a>
                          </li>
                          <li>
                            <a href="#join-doc-popup" data-toggle="modal" class="lst-cls scrolld"> <span class="header-icon-text hidden-xs hidden-sm ">Create Account</span></a>
                          </li>
                          <?php } ?>
                          <!-- Doctor Sign-up and login-in ends -->

                          <!-- Pharmacy Sign-up and login-in starts -->
                          <?php if(Request::segment(1) != 'doctor' && Request::segment(1) == 'pharmacy' && Request::segment(1) != '' ){ ?>
                          <li>
                            <a href="javascript:void(0);" onclick="openLoginModal()"> <span class="header-icon-text hidden-xs hidden-sm">Log in </span></a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" onclick="gotoPharmacysignup()" class="lst-cls scrolld"> <span class="header-icon-text hidden-xs hidden-sm ">Create Account</span></a>
                          </li>
                          <?php } ?>
                          <!-- Pharmacy Sign-up and login-in ends -->

                      @endif
                           
                  </ul>
               </div>
               <!--responsive menu start here-->
               <!-- Sidebar -->
               <div class="main-menu home-res-menu hidden-lg">
                  <div id="wrapper">
                     <div class="overlay"></div>
                     <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper">
                        <div class="sidebar-brand">
                        </div>
                        <ul class="nav sidebar-nav">
                            <li class="dropdown" style="border-bottom:none !important;">
                              <a href="{{url('/')}}/health/about-us"> <span class="header-icon-text hidden-xs hidden-sm ">Our Mission</span></a>
                            </li>

                            <!-- show only to patient, hide to doctor and pharmacy starts -->
                            <?php if(Request::segment(1) != 'pharmacy' && Request::segment(1) != 'doctor' ){ ?>
                                <li> <a href="#signup-voucher">See a Doctor</a> </li>
                            <?php } ?>
                            <!-- show only to patient, hide to doctor and pharmacy ends -->
                          
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
                                <!-- <li>
                                  <a data-toggle="modal" href="#login">Log in</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" href="#signup-voucher" class="lst-cls">Sign Up</a>
                                </li> -->
                                
                                @endif
                            @else
                            
                            <!-- Patient Sign-up and login-in starts -->
                            <?php if(Request::segment(1) != 'pharmacy' && Request::segment(1) != 'doctor' ){ ?>
                            <li>
                              <a data-toggle="modal" href="#login">Log in</a>
                            </li>
                            <li>
                              <a data-toggle="modal" href="#signup-voucher" class="lst-cls">Sign Up</a>
                            </li>
                            <?php } ?>
                            <!-- Patient Sign-up and login-in ends -->

                            <!-- Doctor Sign-up and login-in starts -->
                            <?php if(Request::segment(1) == 'doctor' && Request::segment(1) != 'pharmacy' && Request::segment(1) != '' ){ ?>
                            <li>
                              <a data-toggle="modal" href="#dlogin">Log in</a>
                            </li>
                            <li>
                              <a href="#join-doc-popup" class="lst-cls scrolld">Sign Up</a>
                            </li>
                            <?php } ?>
                            <!-- Doctor Sign-up and login-in ends -->

                            <!-- Pharmacy Sign-up and login-in starts -->
                            <?php if(Request::segment(1) != 'doctor' && Request::segment(1) == 'pharmacy' && Request::segment(1) != '' ){ ?>
                            <li>
                              <a href="javascript:void(0);" onclick="openLoginModal()">Log in</a>
                            </li>
                            <li>
                              <a href="javascript:void(0);" onclick="gotoPharmacysignup()" class="lst-cls scrolld">Sign Up</a>
                            </li>
                            <?php } ?>
                            <!-- Pharmacy Sign-up and login-in ends -->

                            @endif
                            <li>
                            <a href="{{ url('/') }}">Patient</a>
                            </li>
                            <li>
                            <a href="{{ url('/doctor') }}">Doctor</a>
                            </li>
                            <li>
                            <a href="{{ url('/pharmacy') }}" class="<?php if(Request::segment(1) == 'pharmacy' ){ echo 'active'; } ?>">Pharmacy</a>
                            </li>
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
                  <div class="col-sm-6 col-md-8 col-lg-5">
                     <div class="doc-reg">
                        Join the future of Australian Healthcare!
                     </div>
                  </div>
                  <!-- <?php
                      $user = Sentinel::check();
                  ?>
                  @if($user==false)
                  <div class="col-sm-6 col-md-4 col-lg-7">
                  <button class="doc-reg-btn" onclick="openLoginModal()">Pharmacy Login</button>
                  <button class="doc-reg-btn" onclick="gotoPharmacysignup()">Register Your Pharmacy</button>
                  </div>
                  @else
                  <div class="col-sm-6 col-md-3 col-lg-2">
                  &nbsp;
                  </div>
                  @endif -->
               </div>
            </div>
   </div>
<?php } 
if($currentUrl=="doctor"){
?>
 <div class="grrn-strip hidden-xs hidden-sm hidden-md">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-md-9 col-lg-7">
                     <div class="doc-reg">
                        Register your Interest to Join our platform!
                     </div>
                  </div>
                      <!-- <?php
                      $user = Sentinel::check();
                      if($user==null){ ?>
                     <div class="col-sm-6 col-md-3 col-lg-5">
                          <button class="doc-reg-btn" data-toggle="modal" href="#dlogin">Doctor Login</button>
                          <button class="doc-reg-btn redirect_doc_signup">Register Now</button>
                     </div>
                     <?php }else{?>
                     <div class="col-sm-3 col-md-3 col-lg-4">&nbsp;</div>
                     <?php } ?> -->
               </div>
            </div>
</div>
<?php } ?>

<!--header menus end  here-->


<input type="hidden" class="current_url" value="{{ URL::current() }}">

<input type="hidden" class="base_url" value="{{ url('/') }}">
<input type="hidden" class="redirect_url" value="{{ url('/') }}#register">

<input type="hidden" class="mob_base_url" value="{{ url('/doctor') }}">
<input type="hidden" class="mob_redirect_url" value="{{ url('/doctor') }}#join-doc-popup  ">

<script>
  $(document).ready(function() {
    $('.get_page_url').click(function(){

      var url = $.trim($('.current_url').val().toUpperCase());
      var base_url = $.trim($('.base_url').val().toUpperCase());
      var redirect_url = $('.redirect_url').val();

      if(url != base_url)
      {
        $(location).attr('href', redirect_url);
      }
    });

    $('.mob_get_page_url').click(function(){

      var url = $.trim($('.current_url').val().toUpperCase());
      var mob_base_url = $.trim($('.mob_base_url').val().toUpperCase());
      var mob_redirect_url = $('.mob_redirect_url').val();

      if(url != mob_base_url)
      {
        $(location).attr('href', mob_redirect_url);
      }
    });

    $(".redirect_doc_signup").click(function(){
      window.location.href = "{{ url('/') }}/doctor/signup/step1";
    });

  });
</script>