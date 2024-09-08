<!-- HEader -->        
@include('front.patient.layout._after_patient_login_header')    
@include('front.patient.layout._after_patient_login_menu')          
<!-- BEGIN Content -->
<div id="main-content">
    @yield('main_content')
</div>
    <!-- END Main Content -->

<!-- Footer -->        
@include('front.layout._footer')    
                
              