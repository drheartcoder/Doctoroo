@extends('front.layout.master')                
@section('main_content')
<div class="banner-home inner-page-box">
   <div class="logout-banner">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner">
                  <div style="text-align:left;">
                  {{-- @include('front.layout._operation_status') --}}
                 
                  </div>
                  <h1 class="wow fadeInDown">Error</h1>
                  <h4 class="wow fadeInDown"> {{ $message or '' }} &nbsp;Error ! Please try again later OR <a href="{{ url('/') }}/contact-us" style="color:#50ab50;">contact</a> to {{ config('app.project.name') }} admin </h4>                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop