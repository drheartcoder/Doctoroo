@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')
 <script  src="{{url('/')}}/public/js/responsivetabs.js"></script>
  <div class="middle-section">
         <div class="container">
                   @include('front.layout._operation_status')
                   <div class="das-middle-content">
                        <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                           
                           <form action="{{ $module_url_path }}/store" method="post" name="frm_ask_question" id="frm_ask_question">
                              {{ csrf_field() }}
                           <div class="tab-section">
                              <div class="doc-dash-right-bx" style="margin:0;">
                             
                                    <div class="white-bxx">
                                       <div class="uer-bxx">
                                          <div class="gree-txt"></div>
                                          <br/>
                                         
                                          <h5>Enter Your Question here?</h5>
                                          <textarea class="frm-in q-txta" cols="" rows="" data-rule-required="true" id="question" name="question">  
                                          </textarea>
                                          <div class="last-row">
                                          <input type="submit" class="preview-link sum-btn" value="Submit" name="btn_submit">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                              
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>

                  <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                  <nav>
                     <ul>
                        <li><a href="#two">Answered Questions</a></li>
                        <li><a href="#three">Unanswered Questions</a></li>
                     </ul>
                  </nav>

                  {{--answered tab start--}}
                   <div class="content res-full-tab">
                       <div id="two">
                         <div class="container-fluid fix-left-bar">
                              <div class="row">
                                 <div class="col-sm-12 col-md-9 col-lg-10">
                                    <div class="das-middle-content">
                                       <div class="row">
                                          <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="inner-head">Answered Questions</div>

                                          @if(isset($arr_answerd_question) && sizeof($arr_answerd_question)>0)
                                           @foreach($arr_answerd_question as $answered_question)
                                            <div class="head-bor"></div>
                                             <div class="doc-dash-right-bx">
                                                <div class="request-details-bx">
                                                   <div class="que-rply">
                                                      <div class="row">
                                                         <div class="col-sm-12 col-md-12 col-lg-7">
                                                            <h4> <span style="color:#848484;"> Answered By: </span>{{ $answered_question['doctor_details']['first_name'] or '' }}{{ $answered_question['doctor_details']['last_name'] or '' }}</h4>
                                                         </div>
                                                         <div class="col-sm-12 col-md-12 col-lg-5">
                                                            <div class="ask-que">
                                                               <h4> Answered : 
                                                               <span>
                                                                <?php
                                                                  $date = date('d,M Y h:i',strtotime($answered_question['created_at']));
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
                                                         
                                                         <span style="font-size:14px;"> Thanks,</span><br/>
                                                         <p>{{ $answered_question['patient_details']['first_name'] or '' }}{{ $answered_question['patient_details']['last_name'] or '' }}</p>
                                                        
                                                         
                                                      </div>
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </div>
                                             </div>
                                            @endforeach

                                            @else

                                              {{ 'No answers given by doctor' }}

                                          @endif

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                       </div>

                      {{--unanswered tab start--}}
                     <div id="three">
                       <div class="container-fluid fix-left-bar">
                              <div class="row">
                                 <div class="col-sm-12 col-md-9 col-lg-10">
                                    <div class="das-middle-content">
                                       <div class="row">
                                          <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="inner-head">Unanswered Questions</div>

                                           <div class="head-bor"></div>

                                        @if(isset($arr_unanswerd_question['arr_question']['data']) && sizeof($arr_unanswerd_question['arr_question']['data'])>0)
                                           @foreach($arr_unanswerd_question['arr_question']['data'] as $unanswered_question)

                                           
                                             <div class="doc-dash-right-bx">
                                                <div class="request-details-bx">
                                                   <div class="que-rply">
                                                      <div class="row">
                                                         <div class="col-sm-12 col-md-12 col-lg-8">
                                                            <h4> 
                                                            <span style="color:#848484;"> Question from: 
                                                            </span>

                                                            {{ $unanswered_question['patient_details']['first_name'] or '' }}{{ $unanswered_question['patient_details']['last_name'] or '' }}
                                                            </h4>
                                                         </div>
                                                         <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <div class="ask-que">
                                                               <h4> Asked : <span>
                                                                <?php
                                                                  if(isset($unanswered_question['created_at']))
                                                                  {
                                                                    $date = date('d,M Y h:i',strtotime($unanswered_question['created_at']));
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
                                            {{ 'No questions' }}
                                            @endif

                                          </div>
                                       </div>
                                    </div>
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
                              
               </div>
            </div>
         </div>

        <script>
         $(document).on('responsive-tabs.initialised', function(event, el) {
                    console.log(el);
                });
         
            $(document).on('responsive-tabs.change', function(event, el, newPanel) {
                console.log(el);
                console.log(newPanel);
            });
         
            $('[data-responsive-tabs]').responsivetabs({
                initialised: function() {
                    console.log(this);
                },
         
                change: function(newPanel) {
                    console.log(newPanel);
                }
            });
      </script>
      <script>
          
          $(document).ready(function(){


              $('#frm_ask_question').validate({
                  errorElement:'span',

                     messages: {
                            question:
                            {
                                required:"Pleae enter a question.",
                            },   
                                  
                           
                        }
              });  

           });


      </script>
@endsection