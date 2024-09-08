<style>
     .modal-body{padding:0;}
   .close{position:absolute;right:10px;top:10px;z-index: 9;color: #fff;}
   .modal-header.head-loibg{padding:0;}
</style>

<div id="doctor_popup_{{ $doc_details_arr['doctor_details']['user_id'] }}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
<div class="modal-dialog modal-lg-listing">
  <!-- Modal content-->
  <div class="modal-content">
      <div class="modal-header head-loibg">
          <button type="button" class="login_close close" data-dismiss="modal">
             x
          </button>
      </div>
      <div class="modal-body">
      <div class="listing-bg-banner">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-8 col-lg-9">
                  <div class="left-side-joblist">
                     <div class="people-imgs">
                     @if(isset($doc_details_arr['profile_image']) && $doc_details_arr['profile_image']!="")
                        <img alt="" src="{{ $doc_profile_img_public_path.$doc_details_arr['profile_image'] }}" />
                     @endif
                     </div>
                     <div class="right-info rgt-pad-top">
                        <div class="head-title">{{ $doc_details_arr['title'] or '' }}
                                                {{ $doc_details_arr['first_name'] or '' }} 
                                                {{ $doc_details_arr['last_name'] or ''  }}</div>
                        <div class="location-time min-mrtp"><?php echo $doc_details_arr['doctor_details']['speciality']; ?></div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-4 col-lg-3">
                  <div class="listing-btn">
                     <button class="list-det-btn">
                     Book this doctor now
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="bor-ll listing-details-bx">
         <!-- <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="left-side-joblist">
                     <div class="right-info profile-listing ">
                        <div class="top-menu">
                           <a href="#about" data-spy="scroll" class="active-menu">About</a>
                           <a href="#contact" data-spy="scroll"> Education</a>
                           <a href="#languages" data-spy="scroll"> Languages</a>
                           <a href="#location" data-spy="scroll"> Availability  </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      <!--calender section start-->    
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

               <div id="about" class="back-whhit-bx white-clr ">
                @if($doc_details_arr['doctor_details']['video']!='')
                        
                  <div class="abt-video">
                     <div class="listing-video">
                        <!-- <iframe width="100%" height="314" src="https://www.youtube.com/embed/ysv8b8auZFg?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0"></iframe> -->
                        <video class="lazy-hidden" autoplay="" loop="" muted="" preload="auto" width="100%" height="314">
                             <source src="{{ $doctor_video_path.$doc_details_arr['doctor_details']['video'] }}" data-src="{{ url('/video') }}{{ $doc_details_arr['doctor_details']['video'] }}" type="video/mp4"></source>
                         </video>                    
                     </div>
                  </div>
               @endif
                 
               @if($doc_details_arr['doctor_details']['biography']!='')
                 
                  <div class="about-detls">
                     <div class="institue-detl">
                        <h4 >About Me</h4>
                        <p>
                           <?php echo $doc_details_arr['doctor_details']['biography']; ?>
                        </p>
                        <br/>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                @endif  

               </div>
               <div class="clearfix"></div>
              
               @if($doc_details_arr['doctor_details']['medical_qualification']!='')
             
                  <div class="back-whhit-bx white-clr " id="contact">
                     <div  class="institue-detl">
                        <h4 >Education</h4>
                        <div class="ser-txt-ins">
                           <ul>
                              <li><a href="#"><span><i class="fa fa-circle-o"></i></span><?php echo $doc_details_arr['doctor_details']['medical_qualification']; ?></a> </li>
                           </ul>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
              @endif

               @if($doc_details_arr['doctor_details']['language_spoken']!='')
               
                  <div class="back-whhit-bx white-clr " id="languages">
                     <div  class="institue-detl">
                        <h4 > Languages</h4>
                        <div class="ser-txt-ins">
                           <ul>
                              <li><a href="#"><span><i class="fa fa-circle-o"></i></span> <?php echo $doc_details_arr['doctor_details']['language_spoken']; ?></a> </li>
                           </ul>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               @endif
               <div  class="back-whhit-bx white-clr " id="location">
                  <div class="institue-detl">
                     <h4 >Availabilty time</h4>
                     <div class="avalable-time-bx">
                        <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-9">
                              <div class="select-date">
                                 <input type="text" class="form-inputs datepicker" placeholder="Select Date" />
                                 <span><img src="{{ url('/') }}/public/images/cal-icon.png" alt=""/> </span>
                              </div>
                              <div class="right-srw">
                                 <a href="#">
                                 <i class="fa fa-angle-left"></i>
                                 </a>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> TODAY</div>
                                 <div class="day-time"><a href="#" class="aval-time">15:30 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">16:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">16:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">17:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">17:30</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> TUE</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">13:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">13:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">14:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">14:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">15:00</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> WED</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:00</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> THU</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:30</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> FRI</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">13:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">13:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">14:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">14:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">15:00</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> SAT</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">12:00</a></div>
                              </div>
                              <div class="day-div">
                                 <div class="day-title"> SUN</div>
                                 <div class="day-time"><a href="#" class="aval-time">09:00 </a></div>
                                 <div class="day-time"><a href="#" class="aval-time">09:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:00</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">10:30</a></div>
                                 <div class="day-time"><a href="#" class="aval-time">11:00</a></div>
                              </div>
                              <div class="right-srw">
                                 <a href="#"> <i class="fa fa-angle-right"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <br/>
            </div>
         </div>
      </div>
</div>
</div>
</div>
</div>