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
            <h1 class="wow fadeInDown">Error</h1>
            @include('front.layout._operation_status') 
            <div style="text-align:center;">
              <h4 class="wow fadeInDown">Error ! Please try again later</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  