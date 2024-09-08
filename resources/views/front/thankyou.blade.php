@extends('front.layout.master-coming-soon')
@section('main_content')
<div class="banner-home inner-page-box">
   <div class="logout-banner">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner">
                  <h1 class="wow fadeInDown">{{ $message1 or '' }}</h1>
                  <h2 class="wow fadeInDown" style="color:#e6ffe6">{{ $message2 or '' }}</h2>
                  <h3 class="wow fadeInDown" style="color:#f2f2f2">{{ $message or ''}}</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop