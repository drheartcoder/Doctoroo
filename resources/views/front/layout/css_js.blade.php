      <?php $currentUrl  = Route::getCurrentRoute()->getPath();?> 
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      

      @if($currentUrl =="after-hours-home-doctor" || $currentUrl =="online-doctor-consultations" || $currentUrl =="online-doctors" || $currentUrl =="online-doctors-certificate" || $currentUrl =="online-doctor-prescriptions" || $currentUrl =="see-a-doctor-at-home" || $currentUrl =="talk-to-a-doctor-online" ||$currentUrl =="chat-with-a-doctor"||$currentUrl =="online-doctors-australia"||$currentUrl =="dial-a-doctor-on-demand"||$currentUrl =="book-a-doctor-online-in-australia"||$currentUrl =="see-a-gp-online"|| $currentUrl =="home-doctor-service-online"||$currentUrl =="get-a-sick-note-and-doctor-certificate"||$currentUrl =="homepage-doctoroo"||$currentUrl =="see-a-doctor-at-home-without-travelling-anywhere"||$currentUrl == "health/{page_slug}")
      @if(count($info)>0)
      <title><?php echo html_entity_decode($info['meta_title']);?> | {{ config('app.project.name')}} </title>
      <meta name="description" content="<?php echo html_entity_decode($info['meta_desc']);?>"/>
      <meta name="keywords" content="<?php echo html_entity_decode($info['meta_keyword']);?>"/>
      <meta name="author" content="" />
      <meta property="og:title" content="Doctroo" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.doctoroo.com.au" />
      <meta property="og:image" content="images/Doctroo.jpg" />
      <meta property="og:description" content="Doctroo" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      @endif
      @elseif(Request::segment(1)=='blogs' && Request::segment(2)!='search' && Request::segment(2)!='' && Request::segment(2)!='category' )
      <?php 
      
      $arr_slug = explode('-',urldecode(Request::segment(2)));     
      
      if(count($arr_slug)>0)
      {
            $blog_id = last($arr_slug);
      }

      //if(is_numeric($blog_id)){
      $arr_b = get_blog_details_new($blog_id); ?>
      <title>{{ $page_title or '' }} | {{ config('app.project.name')}}</title>
      <meta name="description" content="{{ $arr_b['meta_desc'] }}" />
      <meta name="keywords" content="{{ $arr_b['meta_keyword'] }}" />
      <meta name="author" content="Doctoroo" />
      <meta property="og:title" content="{{ $arr_b['title'] }}" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="{{ url('/blogs/'.str_replace(' ','-',$arr_b['title'].'-'.$arr_b['id'])) }}" />
      <meta property="og:image" content="{{ $blog_image_url.$arr_b['image'] }}" />
      <meta property="og:description" content="{{ strip_tags($arr_b['description']) }}" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      
      <?php //} ?>
      @else
      <title>Online Doctor | Book Doctors Online Australia |  {{ config('app.project.name')}}</title>
      <meta name="description" content="Book doctor online in Australia in just a click away! doctoroo.com.au providing quality health related information and advice online and over the phone."/>
      <meta name="keywords" content="Doctoroo"/>
      <meta name="author" content="" />
      <meta property="og:title" content="Online Doctor | Book Doctors Online Australia | {{ config('app.project.name')}}" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.doctoroo.com.au" />
      <meta property="og:image" content="{{ url('/') }}/public/images/Doctroo.jpg" />
      <meta property="og:description" content="Doctroo" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      
      @endif
      <!-- ======================================================================== -->
      <link rel="icon" href="{{ url('/') }}/public/images/favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{ url('/') }}/public/css/bootstrap.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/css/doctroo.css" rel="stylesheet" />
      <!--font-awesome-css-start-here-->

      <link href="{{ url('/') }}/public/css/font-awesome.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/css/animate.min.css" rel="stylesheet"/>
      <link href="{{ url('/') }}/public/css/loading.css" rel="stylesheet"/>
      <link href="{{ url('/') }}/public/css/dashboard-menu.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/css/jquery-ui.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
      <link href="{{ url('/') }}/public/assets/bootstrap-timepicker/compiled/timepicker.css" rel="stylesheet"/>
      <link href="{{ url('/') }}/public/css/jquery-ui.css" rel="stylesheet" />
      <script  src="{{ url('/') }}/public/js/jquery-1.11.3.min.js"></script>
      <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
      <script src="{{url('/')}}/public/assets/jquery-validation/dist/jquery.validate.min.js"></script>
      <script src="{{url('/')}}/public/assets/jquery-validation/dist/additional-methods.js"></script>
      <script src="{{url('/')}}/public/assets/bootstrap-datetimepicker/moment.js"></script>
      <link href = "{{url('/')}}/public/assets/sweetalert/sweetalert.css" rel="stylesheet" />
      <!--silder css & js start here-->   
      <script src="{{ url('/') }}/public/js/jquery.flexisel.js"></script>
      <script src="{{ url('/') }}/public/js/loader.js"></script>    
      <link href="{{ url('/') }}/public/css/bootstrap-modal.css" rel="stylesheet" />
      <style>
      .modal.container {max-width: none;}
      .modal-backdrop {position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;}
      </style> 
      <script>
      $(window).load(function(){
         hideProcessingOverlay();
      })
      $(function(){
            showProcessingOverlay();
      })
      </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-98131635-1', 'auto');
  ga('send', 'pageview');

</script>