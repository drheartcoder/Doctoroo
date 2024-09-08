@extends('front.layout.master-coming-soon')                
@section('main_content')
<div class="banner-home inner-page-box " style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="join-bg thanks-bg">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner min-height-web">
                  <h1 class="wow fadeInDown">THANK-YOU FOR YOUR INTEREST</h1>
                  <h4 class="wow fadeInDown">You're one step closer to joining the future of healthcare.</h4>
                  <div class="txt-ap">Our Team will revise your application, and will endeavour to contact you with any further information required, and a link to continue your application. Talk Soon.</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<input type="hidden" id="status_reg" value="{{Session::get('status')}}">

<input type="hidden" id="reg_otp_id" value="{{Session::get('reg_otp_id')}}">
<input type="hidden" id="reg_password" value="{{Session::get('reg_password')}}">
<input type="hidden" id="reg_email" value="{{Session::get('reg_email')}}">

@php
   Session::forget('status');
@endphp

<script>
$(document).ready(function(){

      if($('#status_reg').val() =='success')
      {
         $('#verify_doctor_otp').modal('show');   
         $('#otp_id').val($('#reg_otp_id').val());
         $('#password').val($('#reg_password').val());
         $('#email').val($('#reg_email').val());
      }

});
</script>

@stop