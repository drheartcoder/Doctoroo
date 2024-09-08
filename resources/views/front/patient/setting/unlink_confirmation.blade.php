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
                  @if($status=='already_exist')
                      <h2 class="wow fadeInDown">Your Account is already registered</h2>
                  @elseif($status=='create')
                      <h2 class="wow fadeInDown">Congratulation</h2> 
                      @endif
                  
                      @if($status=='create')
                        <h4  class="wow fadeInDown" style="color:#3a3a3a">Your Account has been <strong>unlink</strong> successfully. Please Check your email to set your password and mobile number</h4>
                     @elseif($status=='already_exist')
                          <h4  class="wow fadeInDown" style="color:#3a3a3a">Your email address is already registered.</h4>
                     @endif
                  
                
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop