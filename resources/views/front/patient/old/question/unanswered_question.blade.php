@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')

 <script  src="{{url('/')}}/public/js/responsivetabs.js"></script>
           @include('front.patient.question.ask_question')
                  {{--unanswered tab start--}}
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
                                            <!--<div class="inner-head">Unanswered Questions</div>

                                           <div class="head-bor"></div>-->

                                        @if(isset($arr_unanswerd_question['arr_question']['data']) && sizeof($arr_unanswerd_question['arr_question']['data'])>0)
                                           @foreach($arr_unanswerd_question['arr_question']['data'] as $unanswered_question)

                                           
                                             <div class="doc-dash-right-bx">
                                                <div class="request-details-bx">
                                                   <div class="que-rply">
                                                      <div class="row">
                                                         <div class="col-sm-12 col-md-12 col-lg-8">
                                                            <h4> 
                                                            <span style="color:#848484;"> Question from :  
                                                            </span>

                                                            {{ $unanswered_question['patientinfo']['first_name'] or '' }}{{ $unanswered_question['patientinfo']['last_name'] or '' }}
                                                            </h4>
                                                         </div>
                                                         <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <div class="ask-que">
                                                               <h4> Asked : <span>
                                                                <?php
                                                                  if(isset($unanswered_question['created_at']))
                                                                  {
                                                                    $date = date('d , M Y h:i',strtotime($unanswered_question['created_at']));
                                                                  }

                                                                ?>    
                                                                {{ $date or '' }}

                                                               </span></h4>
                                                              {{--  <h4> Views : <span> 43</span></h4> --}}
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="white-bxx">
                                                      <div class="uer-bxx">
                                                         <div class="gree-txt">{{  $unanswered_question['question'] or '' }}</div>
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
                              $arr_pagination = $arr_unanswerd_question['arr_pagination']
                            ?>

                             @include('front.layout._pagination_view', ['paginator' =>$arr_pagination])
                               

                          </div>
                       </div>
                    </div>
                </div>
          </div> 
      <div class="clearfix"></div>
      <!--ask question div start from here-->
    </div>
  </div>
  </form>
 </div>
</div>
</div>
</div>
</div>
        <script>
         $(document).on('responsive-tabs.initialised', function(event, el) {
                 // console.log(el);
              });
       
          $(document).on('responsive-tabs.change', function(event, el, newPanel) {
             // console.log(el);
             // console.log(newPanel);
          });
       
          $('[data-responsive-tabs]').responsivetabs({
              initialised: function() {
                  //console.log(this);
              },
       
              change: function(newPanel) {
                 // console.log(newPanel);
              }
          });
</script>
@endsection