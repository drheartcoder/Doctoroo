@extends('front.layout.master-coming-soon')                
@section('main_content')
<div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
   -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="bg-shaad inner-page-shaad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="banner-home-box">
                  <h1> {{ $page_title or ''}}</h1>
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

            @if(count($faq_info)>0)
               <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s" style="max-width:none; margin-bottom:65px; visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                
                  <div class="our-mission">
                     <p class="fi-p">
                     
                     <div class="what-doc-section online-medicl-certi" style="padding:0px;">
                        <div class="container">
                           <h4 class="daynamic-heading"></h4>
                           <div class="panel-group wow fadeInDown" id="accordion" >
                              
                               @foreach($faq_info as $data_key => $data)

                              <div class="panel panel-default">
                                 
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{isset($data['id'])?$data['id']:'' }}">{{ isset($data['question'])?$data['question']:'' }}</a>
                                    </h4>
                                 </div>
                                @if($data_key == 0)
                                 <div id="collapseOne{{ isset($data['id'])?$data['id']:'' }}" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                      {{ isset($data['answer'])?$data['answer']:'' }}
                                    </div>
                                 </div>
                                 @else
                                 <div id="collapseOne{{ isset($data['id'])?$data['id']:'' }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      {{ isset($data['answer'])?$data['answer']:'' }}
                                    </div>
                                 </div>
                                 @endif
                              </div>
                                @endforeach
                           </div>
                        </div>
                     </div>
                     </p>
                  </div>
               </div>
           @else
           <h1  style="text-align:center;">Coming Soon</h1>    
            @endif
            </div>
         </div>
      </div>
   </div>
</div>
<!--contact us section end here-->           
<!--footer-->
@stop