<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>{{ isset($page_title)?$page_title:'Doctoroo' }}</title>
    <meta property="og:title" content="Doctroo" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.webwingtechnologies.com/" />
    <meta property="og:image" content="images/Doctroo.jpg" />
    <meta property="og:description" content="Doctroo" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <!-- ======================================================================== -->
    <link rel="icon" href="{{ url('/') }}/public/doctor_section/images/favicon.png" type="image/x-icon" />

    <!-- Jquery - notification popup box using toastr JS starts -->
    <script src="{{ url('/') }}/public/toastr/jquery.min.js"></script>
    <!-- <link href="{{ url('/') }}/public/toastr/bootstrap.min.css" rel="stylesheet"> -->
    <script src="{{ url('/') }}/public/toastr/toastr.min.js"></script>
    <link href="{{ url('/') }}/public/toastr/toastr.min.css" rel="stylesheet">
    <!-- Jquery - notification popup box using toastr JS ends -->
    
    <!-- Bootstrap Core CSS -->
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ url('/') }}/public/doctor_section/css/materialize.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/style.css" rel="stylesheet" media="screen,projection" />
    <!-- <link href="{{ url('/') }}/public/doctor_section/css/doctoroo.css" rel="stylesheet" media="screen,projection" /> -->
    <link href="{{ url('/') }}/public/doctor_section/css/doctoroo-doctor.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/materialize.clockpicker.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/font-awesome.min.css" rel="stylesheet" media="screen,projection" />
    <!-- <script src="{{ url('/') }}/public/doctor_section/js/jquery-1.11.3.min.js"></script> -->

    <!-- Loader files starts -->
    <script src="{{ url('/') }}/public/js/loader.js"></script>
    <link href="{{ url('/') }}/public/css/loading.css" rel="stylesheet"/>
    <link href="{{ url('/') }}/public/new/css/jquery.rateyo.min.css" rel="stylesheet" media="screen,projection" />
    <!-- Loader files ends -->

    <!-- Virgil Service -->
    
    <script>
    var Module = {
        TOTAL_MEMORY: 1024 * 1024 * 256 // 768Mb
    };
    </script>

    <script crossorigin="anonymous" src="https://cdn.virgilsecurity.com/packages/javascript/sdk/4.5.1/virgil-sdk.min.js"></script>

    <style>
        .err{
            color: red;
        }
    </style>
<!-- sweet alert -->
  <!-- <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script> -->
  <link rel="stylesheet" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
  <style>
  .sweet-alert {
  background-color: white;
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  width: 478px;
  padding: 17px;
  border-radius: 5px;
  text-align: center;
  position: fixed;
  left: 50%;
  top: 10%;
  margin-left: -256px;
  margin-top: 100px !important;
  overflow: hidden;
  display: none;
  z-index: 99999;
  }  
  .pac-container:after {
  background-image: none !important;
  height: 0px;
  }
  </style>

  <!-- end sweet alert -->
</head>

<body>
