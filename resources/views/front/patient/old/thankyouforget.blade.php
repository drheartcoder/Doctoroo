@extends('front.layout.master')                
@section('main_content')
<div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="join-bg thanks-bg">
      <div class="container">
      
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner">
                  <div style="text-align:left;">
                 
                  </div>
                  <h1 class="wow fadeInDown">Thank You</h1>
                  <h4 class="wow fadeInDown">Verification email has been sent! Please check your email and click the link to verify your account!</h4>                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop