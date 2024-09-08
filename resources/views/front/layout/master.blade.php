<!-- HEader -->        
@include('front.layout._header')    
        
<!-- BEGIN Sidebar -->
@include('front.layout._menubar')
<!-- END Sidebar -->

<!-- BEGIN Content -->
<div id="main-content">
    @yield('main_content')
</div>
    <!-- END Main Content -->

<!-- Footer -->        
@include('front.layout._footer')    
                
              