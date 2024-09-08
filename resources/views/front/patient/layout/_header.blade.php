<html>
<head>
    <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>{{ isset($title)?$title:config('app.project.name') }}</title>
    <meta property="og:title" content="Doctroo" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.webwingtechnologies.com/" />
    <meta property="og:image" content="{{ url('/') }}/public/new/images/Doctroo.jpg" />
    <meta property="og:description" content="Doctroo" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <!-- ======================================================================== -->
    <link rel="icon" href="{{ url('/') }}/public/new/images/favicon.png" type="image/x-icon" />

    <!-- Jquery - notification popup box using toastr JS starts -->
    <script src="{{ url('/') }}/public/toastr/jquery.min.js"></script>
    <!-- <link href="{{ url('/') }}/public/toastr/bootstrap.min.css" rel="stylesheet"> -->
    <script src="{{ url('/') }}/public/toastr/toastr.min.js"></script>
    <link href="{{ url('/') }}/public/toastr/toastr.min.css" rel="stylesheet">
    <!-- Jquery - notification popup box using toastr JS ends -->

    <!-- Bootstrap Core CSS -->
    <!-- CSS  -->
    <link href="{{ url('/') }}/public/new/css/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" /> -->
    <link href="{{ url('/') }}/public/new/css/materialize.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/new/css/style.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/new/css/jquery.rateyo.min.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/new/css/doctoroo.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/new/css/font-awesome.min.css" rel="stylesheet" media="screen,projection" />
    <script src="{{ url('/') }}/public/new/js/jquery-1.11.3.min.js"></script>
    <script src="{{ url('/') }}/public/new/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/public/js/loader.js"></script>
    <link href="{{ url('/') }}/public/css/loading.css" rel="stylesheet"/>
    <!-- <link href="{{ url('/') }}/public/new/css/datepicker.css" rel="stylesheet" media="screen,projection" /> -->
    <script>
    var Module = {
        TOTAL_MEMORY: 1024 * 1024 * 256 // 768Mb
    };
    </script>
    <script crossorigin="anonymous" src="https://cdn.virgilsecurity.com/packages/javascript/sdk/4.5.1/virgil-sdk.min.js"></script>

    <style>
    .required_field{ color: red !important; }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px
    }
    .alert h4 {
        margin-top: 0;
        color: inherit
    }
    .alert .alert-link {
        font-weight: 700
    }
    .alert>p,
    .alert>ul {
        margin-bottom: 0
    }
    .alert>p+p {
        margin-top: 5px
    }
    .alert-dismissable,
    .alert-dismissible {
        padding-right: 35px
    }
    .alert-dismissable .close,
    .alert-dismissible .close {
        position: relative;
        top: -2px;
        right: -21px;
        color: inherit
    }
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6
    }
    .alert-success hr {
        border-top-color: #c9e2b3
    }
    .alert-success .alert-link {
        color: #2b542c
    }
    .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1
    }
    .alert-info hr {
        border-top-color: #a6e1ec
    }
    .alert-info .alert-link {
        color: #245269
    }
    .alert-warning {
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc
    }
    .alert-warning hr {
        border-top-color: #f7e1b5
    }
    .alert-warning .alert-link {
        color: #66512c
    }
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1
    }
    .alert-danger hr {
        border-top-color: #e4b9c0
    }
    .alert-danger .alert-link {
        color: #843534
    }
    </style>
    <!-- sweet alert -->
  <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script> 
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
