@extends('front.doctor.layout.master')                
@section('main_content')
<script  src="{{url('/')}}/public/js/responsivetabs.js"></script>

<div class="banner-home inner-page-box">
	 <div class="bg-shaad doc-bg-head">
	 </div>
</div>
<!--calender section start-->    
<div class="container-fluid fix-left-bar">
 <div class="row">
    @include('front.doctor.layout._sidebar')
    <div class="col-sm-12 col-md-9 col-lg-10">
       <div class="das-middle-content">
          <div class="row">
             <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="inner-head"> Answer a Question</div>
               <div class="head-bor"></div>
                @include('front.layout._operation_status')
                <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                   <nav>
                      <ul>
                         <li><a href="#one">New Questions </a> </li>
                         <li><a href="#two">Answered Questions</a></li>
                      </ul>
                   </nav>
                   <div class="content res-full-tab" id="load_answer_ques">
                      <div id="one">
                         <div class="tab-section">
                            <div class="tble-frmt">
                               <div class="tble-title">
                                  <div class="row">
                                     <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="new-que">New Questions
                                        </div>
                                     </div>
                                     <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="ans-search">
                                           <input placeholder="Search Questions" type="text" name="search_question" id="search_question" />
                                           <span><img src="{{url('/')}}/public/images/search-ans-icon.png" alt="img"/></span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="ans-content content-d" id="one_div">
                                @if(count($arr_new_question['data'])>0)
                                 @foreach($arr_new_question['data'] as $question) 
                                  <div class="ans-row">
                                     <div class="row">
                                        <div class="col-sm-12 col-md-8 col-lg-9">
                                           <div class="new-q">
                                              <?php echo html_entity_decode(ucfirst($question['question']));?>
                                           </div>
                                           <div class="new-gry">
                                              From : {{$question['patientinfo']['first_name'].' '.$question['patientinfo']['last_name']}}, 
                                              {{date('d M',strtotime($question['created_at'])).' '.date('h:i A',strtotime($question['created_at']))}}
                                           </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                           <a href="{{url('/')}}/doctor/answer-a-question/{{base64_encode($question['id'])}}" class="open-q-btn"> Open Question </a>
                                        </div>
                                     </div>
                                  </div>
                                  @endforeach
                                  @else 
                                  <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Sorry!</strong> Currently, No records found.
                                  </div>
                                 @endif 
                               </div>
                               @include('front.layout._pagination_view', ['arr_pagination' =>$arr_pagination])    
                            </div>
                         </div>
                      </div>
                       <div id="two">
                         <div class="tab-section">
                            <div class="tble-frmt">
                               <div class="tble-title">
                                  <div class="row">
                                     <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="new-que">Answered Questions
                                        </div>
                                     </div>
                                     <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="ans-search">
                                            <input placeholder="Search Questions" type="text" name="search_ans_question" id="search_ans_question" />
                                           <span><img src="{{url('/')}}/public/images/search-ans-icon.png" alt="img"/></span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="ans-content content-d" id="two_div">
                                @if(count($arr_answer_a_question['data'])>0)
                                 @foreach($arr_answer_a_question['data'] as $answer) 
                                  <div class="ans-row">
                                     <div class="row">
                                        <div class="col-sm-12 col-md-8 col-lg-9">
                                           <div class="new-q">
                                              <?php echo html_entity_decode(ucfirst($answer['question']));?>
                                           </div>
                                           <div class="new-gry">
                                              From : {{$answer['patientinfo']['first_name'].' '.$answer['patientinfo']['last_name']}}, 
                                              {{date('d M',strtotime($answer['created_at'])).' '.date('h:i A',strtotime($answer['created_at']))}}
                                           </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 col-lg-3">
                                           <a href="{{url('/')}}/doctor/answer-a-question/{{base64_encode($answer['id'])}}" class="open-q-btn"> Open Question </a>
                                        </div>
                                     </div>
                                  </div>
                                 @endforeach
                                 @else 
                                 <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Sorry!</strong> Currently, No records found.
                                  </div>
                                 @endif 
                               </div>
                               @include('front.layout._pagination_view', ['arr_pagination' =>$arr_answer_pagination])    
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
</div>

<!--calender section end-->     
<script>

$("#search_question").on("keyup", function() {
   
    var value = $.trim($(this).val().toLowerCase());
    
     $("#one_div .ans-row").each(function(index) {
      
             $row = $(this);
         
            var id = $.trim($row.find(".new-q:first").text().toLowerCase());
           
            if (id.indexOf(value) === -1) {
               $row.hide();
            }
            else {
               $row.show();
            }
     });
});


$("#search_ans_question").on("keyup", function() {
   
    var value = $.trim($(this).val().toLowerCase());

     $("#two_div .ans-row").each(function(index) {
      
             $row = $(this);
         
            var id = $.trim($row.find(".new-q:first").text().toLowerCase());
           
            if (id.indexOf(value) === -1) {
               $row.hide();
            }
            else {
               $row.show();
            }
     });
});
</script>
<!-- custom scrollbars plugin -->
<!-- custom scrollbars plugin -->
<link href="{{url('/')}}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- custom scrollbar plugin -->
<script src="{{url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
 (function($){
 $(window).on("load",function(){
 
 $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
 $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
 
         $(".content-d").mCustomScrollbar({theme:"dark"});
 
 });
 })(jQuery);
  
  $(document).on('responsive-tabs.initialised', function(event, el) {
            concole.log(el);
        });
 
    $(document).on('responsive-tabs.change', function(event, el, newPanel) {
        concole.log(el);
        concole.log(newPanel);
    });
 
    $('[data-responsive-tabs]').responsivetabs({
        initialised: function() {
            concole.log(this);
        },
 
        change: function(newPanel) {
            concole.log(newPanel);
        }
    });
</script>
<!-- custom scrollbars plugin -->
@stop