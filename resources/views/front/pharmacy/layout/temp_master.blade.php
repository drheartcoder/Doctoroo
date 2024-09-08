<!--common HEader -->        
@include('front.layout._header_coming_soon')  
<!--pharmacy header -->   
@include('front.pharmacy.layout._pharmacy_header')    
        
<!-- BEGIN Content -->
<div id="main-content">
    @yield('main_content')
</div>
    <!-- END Main Content -->

<!-- Footer -->        
@include('front.layout._footer_coming_soon')    
                
              