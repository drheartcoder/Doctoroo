<!DOCTYPE html >
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <title>{{ isset($title)?$title:'Online Doctor | Book Doctors Online Australia | '.config('app.project.name') }}</title>
      <meta name="description" content="{{ isset($description)?$description:'Book doctor online in Australia in just a click away! doctoroo.com.au providing quality health related information and advice online and over the phone.' }}"/>
      <meta name="keywords" content="{{ isset($keyword)?$keyword:'Doctoroo' }}"/>
      <meta name="author" content="" />
      <meta property="og:title" content="Online Doctor | Book Doctors Online Australia | {{ config('app.project.name')}}" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.doctoroo.com.au" />
      <meta property="og:image" content="{{ url('/') }}/public/images/Doctroo.jpg" />
      <meta property="og:description" content="Doctroo" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
     
      <!-- ======================================================================== -->
       <link rel="icon" href="{{ url('/') }}/public/images/favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{ url('/') }}/public/css/bootstrap.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/multiselect/css/bootstrap-multiselect.css" rel="stylesheet" media="screen,projection" />
    
      <link href="{{ url('/') }}/public/css/doctroo.css" rel="stylesheet" />
      <!--font-awesome-css-start-here-->
      <link href="{{ url('/') }}/public/css/font-awesome.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/css/animate.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="{{ url('/') }}/public/css/owl.carousel.css" />
      <link href="{{ url('/') }}/public/css/loading.css" rel="stylesheet"/>
      <!--<script src="{{ url('/') }}/public/js/jquery.min.js"></script>-->

      <!-- <script async src="{{ url('/') }}/public/js/jquery-1.9.1.js"></script> -->
      <script  src="{{ url('/') }}/public/doctor_section/js/jquery-1.11.3.min.js"></script>
      <script async src="{{ url('/') }}/public/multiselect/js/bootstrap-multiselect.js"></script>
      <script  src="{{ url('/') }}/public/js/owl.carousel.js"></script>  
      <script async src="{{ url('/') }}/public/js/responsivetabs.js"></script>
      <script async src="{{ url('/') }}/public/js/loader.js"></script>
      <script>
            
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop:false,
                margin: 0,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 2,
                    
                    nav: true
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 30
                  }
                }
              })
            })
      </script>  
<!--silder css & js end here--> 
<!--model popup css-->
<link href="{{ url('/') }}/public/css/bootstrap-modal.css" rel="stylesheet" />
<style>
.modal.container {max-width: none;}
.modal-backdrop {position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;}
</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98131635-1', 'auto');
  ga('send', 'pageview');
</script>



</head>