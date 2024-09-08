@extends('front.layout.master-coming-soon')                
@section('main_content')

      <div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
         <div class="bg-shaad inner-page-shaad">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-home-box">
                        <h1> <?php echo html_entity_decode($dynamic_info['page_title']);?></h1>
                        <div class="bor-light">&nbsp;</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--contact us section start here-->
      <div class="about-us-section">
         <div class="">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s" style="max-width:none; margin-bottom:65px; visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                        <h1>  <?php echo html_entity_decode($dynamic_info['page_title']);?></h1>
                        <div class="our-mission">
                           <p class="fi-p">
                              <?php echo html_entity_decode($dynamic_info['page_desc']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--contact us section end here-->
      <!--footer-->
@stop