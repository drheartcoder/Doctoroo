<style>
     .modal-body{padding:0;}
   .close{position:absolute;right:10px;top:10px;z-index: 9;color: #fff;}
   .modal-header.head-loibg{padding:0;}
</style>

@if(isset($arr_doctor_list) && sizeof($arr_doctor_list)>0)
  @foreach($arr_doctor_list as $list)


<div id="doctor_profile_{{ $list['doctor_user_id'] }}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
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

                      @if(isset($list['doctor_user_details']['profile_image']) && $list['doctor_user_details']['profile_image']!='' && file_exists($doctor_base_img_path.'/'.$list['doctor_user_details']['profile_image']))
                                                    
                         <img src="{{ $doctor_public_img_path.'/'.$list['doctor_user_details']['profile_image'] }}" alt=""/>
                     @else
                         <img src="{{ $doctor_public_img_path }}/default-image.jpeg" alt=""/>
                     @endif
                     </div>
                     <div class="right-info rgt-pad-top">
                        <div class="head-title">
                           
                            {{ isset($list['doctor_user_details']['title'])?$list['doctor_user_details']['title']:'' }}
                            {{ isset($list['doctor_user_details']['first_name'])?$list['doctor_user_details']['first_name']:'' }}
                            {{ isset($list['doctor_user_details']['last_name'])?$list['doctor_user_details']['last_name']:'' }}

                        </div>
                        <div class="location-time min-mrtp"></div>
                     </div>
                  </div>
               </div>
              {{--  <div class="col-sm-12 col-md-4 col-lg-3">
                  <div class="listing-btn">
                     <button class="list-det-btn">
                     Book this doctor now
                     </button>
                  </div>
               </div> --}}
            </div>
         </div>
      </div>
      <div class="bor-ll listing-details-bx">
         
      </div>
      <!--calender section start-->    
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

               <div id="about" class="back-whhit-bx white-clr ">
                @if(isset($list['doctor_info']['video']) && $list['doctor_info']['video']!='' && file_exists($video_base_path.$list['doctor_info']['video'])) 
                     
                        <div class="abt-video">
                           <div class="listing-video">
                            
                               <video controls width="100%"> 
                               @if(isset($list['doctor_info']['video_extension']) && $list['doctor_info']['video_extension']=='mp4')

                                   <source src="{{ $video_public_path.$list['doctor_info']['video'] }}" type=video/mp4>

                               @elseif(isset($list['doctor_info']['video_extension']) && $list['doctor_info']['video_extension']=='ogv')


                                   <source src="{{ $video_public_path.$list['doctor_info']['video'] }}" type=video/ogg> 

                               @elseif(isset($list['doctor_info']['video_extension']) && $list['doctor_info']['video_extension']=='webm')


                                   <source src="{{ $video_public_path.$list['doctor_info']['video'] }}" type=video/webm> 


                               @endif
                            
                               </video>
                                                         
                          </div>
                       </div> 
                 @endif
               </div>
            </div>
                
              
                 
               @if(isset($list['doctor_info']['biography']) && $list['doctor_info']['biography']!='')
                 
                  <div class="about-detls">
                     <div class="institue-detl">
                        <h4 >About Me</h4>
                         <p>
                           {{  $list['doctor_info']['biography'] or '' }}
                        </p> 
                        <br/>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                @endif  

               </div>

               @if(isset($list['doctor_info']['speciality']) && $list['doctor_info']['speciality']!='')
                 
                  <div class="back-whhit-bx white-clr " id="contact">
                     <div  class="institue-detl">
                        <h4 >Speciality</h4>
                        <div class="ser-txt-ins">
                           <ul>
                          <li><a href="#"><span><i class="fa fa-circle-o"></i></span>

                           {{ $list['doctor_info']['speciality'] or '' }}

                          </a> </li> 
                           </ul>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                @endif  


               <div class="clearfix"></div>
              
               @if(isset($list['doctor_info']['medical_qualification']) && $list['doctor_info']['medical_qualification']!='')
             
                  <div class="back-whhit-bx white-clr " id="contact">
                     <div  class="institue-detl">
                        <h4 >Education</h4>
                        <div class="ser-txt-ins">
                           <ul>
                          <li><a href="#"><span><i class="fa fa-circle-o"></i></span>

                           {{ $list['doctor_info']['medical_qualification'] or '' }}

                          </a> </li> 
                           </ul>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
              @endif

               @if(isset($list['doctor_info']['language_spoken']) && $list['doctor_info']['language_spoken']!='')
               
                  <div class="back-whhit-bx white-clr " id="languages">
                     <div  class="institue-detl">
                        <h4 > Languages</h4>
                        <div class="ser-txt-ins">
                           <ul>
                           <li><a href="#"><span><i class="fa fa-circle-o"></i></span>
                                  {{ $list['doctor_info']['language_spoken'] or '' }}
                            </a> </li>
                           </ul>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               @endif
             
               <br/>
            </div>
         </div>
      </div>
</div>
</div>
</div>
</div>
@endforeach
@endif