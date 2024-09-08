<!--dashboard menu-->   
<?php $currentUrl  = Route::getCurrentRoute()->getPath(); ?>   
<div class="dashboard-menu">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="nav">
               <ul class="nav-list">
                  <li class="nav-item"><a href="{{url('/')}}/search/doctor"  class="menu_class @if($currentUrl=='search/doctor') act @endif">See a Doctor </a></li>
                  <li class="nav-item"><a href="{{url('/')}}/search/doctor" class="menu_class  @if($currentUrl=='patient/profile') act @endif">Schedule & Update Bookings</a></li>
                  <li class="nav-item"><a href="{{url('/')}}/patient/precription" class="menu_class  @if($currentUrl=='patient/precription') act @endif">Get a new Prescription</a></li>
                  <li class="nav-item"><a href="{{url('/')}}/patient/medical-certificate" class="menu_class  @if($currentUrl=='patient/medical-certificate') act @endif">Get a Medical Certificate</a></li>
                </ul>
               <div class="clr"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--dashboard menu-->    