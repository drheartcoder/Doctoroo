<style>
   a:hover {
    cursor:pointer;
   }
 </style>

    <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="see-d-dash-panel text-center">
               <div class="row">
                  <div class="distance" style="margin-bottom:0;position:relative;">
                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-left">
                     <!--previous arrows-->
                     @if(Request::segment(3)=='step1')

                     @elseif(Request::segment(3)=='step2')
                        <a href="{{ $module_url_path }}/step1"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                     @elseif(Request::segment(3)=='step3')
                          <a href="{{ $module_url_path }}/step2"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                     @endif

                   
                     </div>
                     <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10">
                        <li><a href=""  @if(Request::segment(3)=='step1') class="act" @endif><i class="fa fa-circle"></i></a></li>
                        <li><a href="" @if(Request::segment(3)=='step2') class="act" @endif><i class="fa fa-circle"></i></a></li>
                        <li><a href="" @if(Request::segment(3)=='step3') class="act" @endif ><i class="fa fa-circle"></i></a></li>
                     </ul>
                     
                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                        <!--next arrows-->
                         @if(Request::segment(3)=='step1')
                            <a id="step1_next_id"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a>
                         @elseif(Request::segment(3)=='step2')
                            <a id="step2_next_id"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a>
                         @elseif(Request::segment(3)=='step3')
                         
                         @endif


                     </div>
                     
                     <div class="clr"></div>
                     <div class="step-text">
                         @if(Request::segment(3)=='step1')
                           Steps 1 of 3
                          @elseif(Request::segment(3)=='step2')
                           Steps 2 of 3
                          @elseif(Request::segment(3)=='step3')
                           Steps 3 of 3
                          @endif
                        </div>
                  </div>
               </div>
               <div class="clr"></div>
            </div>
            <div class="clr"></div>
            @include('front.layout._operation_status')
         </div>
    </div>
       