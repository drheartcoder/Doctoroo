@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<div class="header z-depth-2 bookhead">
   <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
   <h1 class="main-title center-align">Camera & Internet Pre-call Test</h1>
</div>

<div class="medi minhtnor family-doct">
   <style>
      .error_class,.datebirth_error,#valid_mail
      {
      color:red !important;
      line-height: 35px !important;
      }
      a.disabled {
      pointer-events: none;
      cursor: default;
      opacity: 0.6;
      }
      .text-bx {
      margin-top: 20px;
      margin-bottom: 20px;
      }

      .required_field
      {
         color:red;
      }
   </style>

   <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

         <p>
            <span class="title ">Please check the quality of your internet, camera and microphone and whether your device & browser support the doctoroo platform. If there are any issues, please test and have the consultation from another device or browser. </span>
         </p>

         <span class="qusame rescahnge"><a href="https://tokbox.com/developer/tools/precall/" target="_blank" class="btn cart bluedoc-bg lnht round-corner">Pre-Call Test</a></span>

      
      <div class="clr"></div>
      
      </div>
   </div>
   <!--Container End-->

</div>

@endsection