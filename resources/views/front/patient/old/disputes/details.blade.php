@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<!--calender section start-->    
<div class="container">
   <div class="row">
       <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="middle-section">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-3">
                  <div class="left-side-tabs">
                     <div class="msg-search"><input type="text" class="search_msg" placeholder="Search.."/></div>
                     <div class="new-msg">
                        New Messages
                     </div>
                     <div  class="messagecrollbar-msg content-d">
                        <ul class="sub_respo1">
                           <!--search section-->
                            <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation1.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation2.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li class="msg-act">
                              <div class="massanger_user ">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation3.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation4.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation1.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation4.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="massanger_user">
                                 <div class="user_img"><img src="{{url('/')}}/public/images/Convesation1.jpg" alt=""/></div>
                                 <div class="user_details">
                                    <div class="user_name">Dolores Chambers</div>
                                    <div class="user_msg">Praesent ipsum urna...</div>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-9">
                  <div class="chat_user whit-bg-i">
                     <div class="chat-header">
                        <div class="row">
                           <div class="col-sm-12 col-md-4 col-lg-5">
                              <div class="cht-head-nm">
                                 John Smith,
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-8 col-lg-7">
                              <div class="chat-search">
                                 <div class="chatting-search">
                                    <input type="text"  />
                                    <button><img src="{{url('/')}}/public/images/chat-search-icon.png" alt="img"/></button>
                                 </div>
                                 <div class="setig-icon">
                                    <a href="#"><i class="fa fa-cog"></i></a> 
                                 </div>
                                 <a href="#"> Patient Profile</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="messagecrollbar-msg-b content-d">
                        <div class="chatting-section">
                           <div class="chat_left_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation8.jpg" /></span> 
                              <p class="triangle-right left">Nanti  kita technical meeting lomba jogja 
                                 <span class="rgt-time"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_right_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation9.jpg"/></span> 
                              <p class="triangle-left right">Semua satu team ITone yang berangkat ke jogja? 
                                 <span class="rgt-time" style="color:#bbb"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_left_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation8.jpg"/></span> 
                              <p class="triangle-right left">Iya,semua kita berangkat pake pesawat biar cepet dari  jakarta berangkat, terus dari sini kita 
                                 naik kereta ke jakarta
                                 <span class="rgt-time"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_right_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation9.jpg"/></span> 
                              <p class="triangle-left right">Ok,berarti kita beberpa hari disana?
                                 <span class="rgt-time" style="color:#bbb"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_left_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation8.jpg"/></span> 
                              <p class="triangle-right left">Yaiyalah tenang kita tidur di hotel ko 
                                 <span class="rgt-time"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_right_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation9.jpg"/></span> 
                              <p class="triangle-left right">Ok,berarti kita beberpa hari disana?
                                 <span class="rgt-time" style="color:#bbb"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_left_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation8.jpg"/></span> 
                              <p class="triangle-right left">Yaiyalah tenang kita tidur di hotel ko 
                                 <span class="rgt-time"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_right_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation9.jpg"/></span> 
                              <p class="triangle-left right">Ok,berarti kita beberpa hari disana? 
                                 <span class="rgt-time" style="color:#bbb"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_left_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation8.jpg"/></span> 
                              <p class="triangle-right left">Yaiyalah tenang kita tidur di hotel ko 
                                 <span class="rgt-time"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="chat_right_side">
                              <span><img alt="" src="{{url('/')}}/public/images/Convesation9.jpg"/></span> 
                              <p class="triangle-left right">Ok,berarti kita beberpa hari disana? 
                                 <span class="rgt-time" style="color:#bbb"> 10/1, 5:13pm</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="clr"></div>
                        </div>
                     </div>
                     <div class="msg_input">
                        <textarea  cols="" rows="" class="msg-in" placeholder="Write a Reply..." style="padding-top:10px;"></textarea>
                        <div class="msg-btn">
                           <a href="#" class="pos-ab"><i class="fa fa-paperclip"></i></a>
                           <button class="submit-msg"><i class="fa fa-paper-plane"></i> Send
                           </button>
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
</script>
<!-- custom scrollbars plugin -->
@stop