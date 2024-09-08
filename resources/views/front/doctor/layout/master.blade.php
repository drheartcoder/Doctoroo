<!--common HEader -->        
@include('front.layout._header')
<!--pharmacy header -->
@include('front.doctor.layout._header')

<!-- BEGIN Content -->
<div id="main-content">
    @yield('main_content')
</div>
    <!-- END Main Content -->

<!-- Footer -->
@include('front.layout._footer')
                
              