@extends('front.layout.master-coming-soon')
@section('main_content')
<style>
  .logout-banner h2 {
    color: #50AB50;
    font-family: "robotomedium",sans-serif;
    font-size: 35px;
    text-shadow: 1px 0 3px rgba(0, 0, 0, 0.53);
    text-transform: uppercase;
}
</style>
<div class="banner-home inner-page-box">
   <div class="logout-banner">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner">
                  @if(isset($status) && !empty($status))
                    <h1 class="wow fadeInDown">{{$status}}</h1>
                    <h3 class="wow fadeInDown" style="color:#f2f2f2">{{ isset($message) ? $message : ''}}</h3> 
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop