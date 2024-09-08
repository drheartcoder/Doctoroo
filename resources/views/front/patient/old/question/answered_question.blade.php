@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')

 <script  src="{{url('/')}}/public/js/responsivetabs.js"></script>

	@include('front.patient.question.ask_question')

  <div class="col-sm-12">
        <div class="content res-full-tab">
 			      <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                  <nav>
                     <ul>
                        <li @if(Request::segment(3)=='answered') class="active" @endif ><a  onclick="javascript:window.location.href='{{ $module_url_path }}/answered';">Answered Questions</a></li>
                        <li @if(Request::segment(3)=='unanswered') class="active" @endif><a  onclick="javascript:window.location.href='{{ $module_url_path }}/unanswered';">Unanswered Questions</a></li>
                     </ul>
                  </nav>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <!--<div class="das-middle-content">-->
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                <!--<div class="inner-head">Answered Questions</div>
                                 <div class="head-bor"></div>-->
                              @if(isset($arr_answerd_question['arr_question']['data']) && sizeof($arr_answerd_question['arr_question']['data'])>0)
                                 @foreach($arr_answerd_question['arr_question']['data'] as $answered_question)


                                 <div class="doc-dash-right-bx">
                                    <div class="request-details-bx">
                                       <div class="que-rply">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-12 col-lg-7">
                                                <h4> <span style="color:#848484;"> Answered By : </span>{{ $answered_question['doctorinfo']['first_name'] or '' }}{{ $answered_question['doctorinfo']['last_name'] or '' }}</h4>
                                             </div>
                                             <div class="col-sm-12 col-md-12 col-lg-5">
                                                <div class="ask-que">
                                                   <h4> Answered : 
                                                   <span>
                                                    <?php
                                                      $date = date('d , M Y h:i',strtotime($answered_question['created_at']));
                                                    ?>    
                                                    {{ $date or '' }}
                                                   </span>
                                                   </h4>
                                                  {{--  <h4> Views : <span> 43</span></h4> --}}
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="white-bxx">
                                          <div class="uer-bxx">
                                             <div class="gree-txt">
                                             {{ $answered_question['question'] or '' }}</div>
                                             <br/>

                                             <p>
                                              {{ $answered_question['answer'] or '' }}
                                             <br/></p>
                                             <br/>


                                          </div>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                                @endforeach

                                @else
                                  <div class="search-grey-bx">
                                    <div class="row">
                                      {{ 'Not having any questions.' }}
                                    </div>
                                  </div>

                              @endif

                              </div>
                           </div>
                        <!--</div>-->

                        <?php
                          $arr_pagination = [];
                          $arr_pagination = $arr_answerd_question['arr_pagination']
                        ?>

                         @include('front.layout._pagination_view', ['paginator' =>$arr_pagination])

                     </div>
                  </div><!--inner row-->
           </div><!--data_responsive_tabs-->
      </div><!--content-->
   </div><!--col-sm-12-->
  <div class="clearfix"></div>
  <!--ask question div-->
    </div><!--white-bxx-->
   </div><!--doc-dash-right-bx-->
 </form><!--tab-section-->
</div><!--col-lg-12-->
</div><!--row-->
</div><!--das-middle-content-->

 </div><!--container-->
</div><!--middle-section-->



<script>
 $(document).on('responsive-tabs.initialised', function(event, el) {
            //console.log(el);
        });
 
    $(document).on('responsive-tabs.change', function(event, el, newPanel) {
        //console.log(el);
       // console.log(newPanel);
    });
 
    $('[data-responsive-tabs]').responsivetabs({
        initialised: function() {
           // console.log(this);
        },
 
        change: function(newPanel) {
          //  console.log(newPanel);
        }
    });
</script>
@endsection