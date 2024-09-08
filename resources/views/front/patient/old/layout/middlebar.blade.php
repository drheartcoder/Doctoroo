
<?php
  $url = Request::segment(3);
?>            
            <div class="row">
                           <div class="distance" style="margin-bottom:0;position:relative;">
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-left">
                                @if(Request::segment(3)=='step-2')
                                 <a href="{{url('/')}}/patient/medicalhistory/step-1"><img src="{{url('/')}}/public/images/arrow-grn.png" alt=""/></a>

                                 @elseif(Request::segment(3)=='step-3')
                                   <a href="{{url('/')}}/patient/medicalhistory/step-2"><img src="{{url('/')}}/public/images/arrow-grn.png" alt=""/></a>
                                 @endif
                              </div>
                              <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10">

                                 <li><a href="{{url('/')}}/patient/medicalhistory/step-1" @if(Request::segment(3)=='step-1') class="act" @endif><i class="fa fa-circle"></i></a></li>
                                 <li><a href="{{url('/')}}/patient/medicalhistory/step-2" @if(Request::segment(3)=='step-2') class="act" @endif><i class="fa fa-circle"></i></a></li>
                                 <li><a href="{{url('/')}}/patient/medicalhistory/step-3" @if(Request::segment(3)=='step-3') class="act" @endif><i class="fa fa-circle"></i></a></li>

                                 @if(Request::segment(3)=='step-1')
                                 <a href="{{url('/')}}/patient/medicalhistory/step-2" class="skip-txt"> Skip this step</a> 

                                 @elseif(Request::segment(3)=='step-2')
                                 <a href="{{url('/')}}/patient/medicalhistory/step-3" class="skip-txt"> Skip this step</a> 
                                 @endif

                              </ul>
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                                @if(Request::segment(3)=='step-1')
                                 <a href="{{url('/')}}/patient/medicalhistory/step-2"><img src="{{url('/')}}/public/images/arrow-disable.png" alt=""/></a>

                                 @elseif(Request::segment(3)=='step-2')
                                   <a href="{{url('/')}}/patient/medicalhistory/step-3"><img src="{{url('/')}}/public/images/arrow-disable.png" alt=""/></a>
                                 @endif
                              </div>
                              <div class="clr"></div>
                              <div class="step-text">
                                 Steps 1 of 3
                              </div>
                           </div>
                        </div>
