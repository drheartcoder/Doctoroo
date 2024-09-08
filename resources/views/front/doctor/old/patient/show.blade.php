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
      <div class="col-sm-8 col-md-9 col-lg-10">
         <div class="das-middle-content">
            <div class="row">
               <div class="col-sm-12">
                  <div class="inner-head">My Patients</div>
                  <div class="head-bor"></div>
                  @if(isset($arr_patient) && sizeof($arr_patient)>0) 
                  <div class="patent-name">
                     {{isset($arr_patient['first_name'])?$arr_patient['first_name']:''}}
                     {{isset($arr_patient['last_name'])?$arr_patient['last_name']:''}},
                  </div>
                  @endif
               </div>
            </div>

            <div class="row">
            {{--searching part--}}
               <div class="col-sm-12 col-md-12 col-lg-3">
                  <div class="search-phrm box">
                      <form method="get" name="frm_search_patient" id="frm_search_patient" action="{{ $module_patient_path }}">   
                         <div class="patient-search">
                            <input type="text" class="srch-phrm" placeholder="Search Patients" />
                            <span><button class="serch-btnn"> <img src="{{url('/')}}/public/images/search-phrm.png" alt="img search"/></button> </span>
                            <div class="dwn-arw"><a class="top-arrow"><i class="fa fa-angle-up" ></i></a> </div>
                         </div>
                         <div class="serch-cont-bx bottom" style="display:block;">
                            <div class="user_box">
                               <input type="text" class="form-inputs" name="patient_name" id="patient_name" placeholder="Name" />
                               <div class="err" id="err_patient_name"></div>
                            </div>
                            <div class="user_box">
                               <input type="text" class="form-inputs" name="email" id="email" placeholder="Email" />
                               <div class="err" id="err_email"></div>
                            </div>
                            <div class="user_box">
                               <input type="text" class="form-inputs" name="phone_no" id="phone_no" placeholder="Phone" />
                               <div class="err" id="err_phone_no"></div>
                            </div>
                            <div class="user_box">
                               <div class="select-style my-pati">
                                  <select class="frm-select" name="sort_by" id="sort_by" onchange="sortBy(this.value)">
                                     <option value="">Sort by</option>
                                     <option value="name">Name</option>
                                     <option value="booking">Booking</option>
                                   </select>
                               </div>
                              <div class="err" id="err_sort_by"></div>
                            </div>
                            <button class="search-btn pull-right" name="btn_search" type="submit" id="btn_search">Search</button>
                            <div class="clearfix"></div>
                         </div>
                     <div class="clearfix"></div>
                    </form> 
                </div>

                  {{--list of patient with family member--}}
                  <div class="left-side-tabs my-patients-leftbar">
                     <div  class="content-d">
                       @if(isset($arr_patient_list) && sizeof($arr_patient_list)>0) 
                        <ul class="sub_respo1">
                         @foreach($arr_patient_list as $patient)
                           
                           <li>  
                              <div class="massanger_user">
                                 <div class="user_img">

                                 @if(isset($patient['patient_user_details']['profile_image']) && $patient['patient_user_details']['profile_image']!="" && file_exists($patient_base_img_path.$patient['patient_user_details']['profile_image']))
                                    <img src="{{ $patient_public_img_path.$patient['patient_user_details']['profile_image']}}" alt=""/>
                                 @else
                                    <img src="{{ $patient_public_img_path.'default-image.jpeg' }}" alt=""/>
                                 @endif   

                                 </div>
                                 <div class="user_details">
                                    <div class="user_name">

                                    <a href="{{ $module_patient_path }}/details/{{ base64_encode($patient['patient_user_id']) }}">
                                         {{$patient['patient_user_details']['first_name'] or ''}} {{ $patient['patient_user_details']['last_name'] or ''}}
                                    </a>
                                    </div>
                                 </div>
                              </div>
                                 {{--family member list--}}
                               <ul>
                                     <li>
                                        @if(isset($patient['familiy_member']) && sizeof($patient['familiy_member'])>0)
                                          @foreach($patient['familiy_member'] as $familiy_member)
                                            
                                           <div class="massanger_user">
                                              
                                               <div class="user_details">
                                                  <div class="user_name">

                                                  <a href="{{ $module_patient_path }}/details/{{ base64_encode($patient['patient_user_id']) }}/{{ base64_encode($familiy_member['id']) }}">
                                                    {{ $familiy_member['first_name'] or ''}} {{ $familiy_member['last_name'] or ''}}
                                                  </a>
                                                   (  {{ $familiy_member['relationship'] or ''}} )
                                                  </div>
                                               </div>
                                          </div>
                                          @endforeach
                                        @endif

                                    </li>

                              </ul>
                           </li>
                         @endforeach  
                        </ul>
                       @else
                           <div class="alert alert-info alert-dismissible" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> No Records Found.
                           </div> 
                       @endif
                     </div>
                   
                  </div>

               </div>
               <div class="col-sm-12 col-md-12 col-lg-9">
                  <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                     <nav>
                        <ul>
                           <li><a href="#one">Patient Info </a> </li>
                           <li><a href="#two">Medical History</a></li>
                           <li><a href="#four">Prescription</a></li>
                           <li><a href="#three">Orders</a></li> 
                           <li><a href="#fiv">Safety Net</a></li>
                        </ul>
                     </nav>
                         <div class="content res-full-tab"  style="background:none;">
                         <div id="one">

                               @include('front.doctor.patient.patient_info')

                         </div>
                         <div id="two">
                           
                                @include('front.doctor.patient.medical_history')

                         </div>
                        <div id="three">
                           <div class="tab-section">
                           </div>
                        </div>
                        <div id="four">
                           <div class="tab-section">
                           </div>
                        </div>
                        <div id="five">
                           <div class="tab-section">
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
/*========Search===================*/
 $(document).ready(function(){

   $('#btn_search').on('click',function(){

      var name    = $('#patient_name').val();
      var email   = $('#email').val();
      var phone   = $('#phone_no').val();
      var sort_by = $('#sort_by').val();
      var onlydigit      = /^[0-9]*(?:\.\d{1,2})?$/;
      var email_filter   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var nodigit_regexp = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;

      if($.trim(name)=="" && $.trim(email)=="" && $.trim(phone)=="" && $.trim(sort_by)=="")
      {

            $('#err_sort_by').fadeIn('fast');
            $('#err_sort_by').html('Please enter atleast one field for search.');
            $('#err_sort_by').fadeOut(4000);
            $('#patient_name').focus();
            return false;
      }
      else if($.trim(name)!="" && !nodigit_regexp.test(name))
      {

            $('#err_patient_name').fadeIn('fast');
            $('#err_patient_name').html('Please enter only character letter.');
            $('#err_patient_name').fadeOut(4000);
            $('#patient_name').focus();
            return false;     
      }
      else if($.trim(email)!="" && !email_filter.test(email))
      {

            $('#err_email').fadeIn('fast');
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            $('#email').focus();
            return false;  
      }
      else if($.trim(phone)!="" && !onlydigit.test(phone))
      {

            $('#err_phone_no').fadeIn('fast');
            $('#err_phone_no').html('Please enter only digit.');
            $('#err_phone_no').fadeOut(4000);
            $('#phone_no').focus();
            return false;  
      }
      else
      {

          return true;  
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
    
    /*side search arow hide show start*/
    $('.top-arrow').on('click', function() {//alert($(this).find('i').html());
       $parent_box = $(this).closest('.box');
       if($(this).html()=='<i class="fa fa-angle-down"></i>')
       {
           $(this).html('<i class="fa fa-angle-up"></i>');
       }
       else
       {
               $(this).html('<i class="fa fa-angle-down"></i>');
       }
       $parent_box.find('.bottom').slideToggle(1000, 'swing');
   });
     /*side search arow hide show end*/
    
    /*responsive tabs start*/
        $(document).on('responsive-tabs.initialised', function(event, el) {
            
          });
      
         $(document).on('responsive-tabs.change', function(event, el, newPanel) {
            
         });
   
      $('[data-responsive-tabs]').responsivetabs({
          initialised: function() {
           
          },
   
          change: function(newPanel) {
          
          }
      });
   
   
</script>
<script>
   //onclick toggle
   $(document).ready(function() {
   
   $('.container1').hide();
   $(".container1:first").addClass("act1").show(); 
   
   $('.regi_toggle button').click(function(){
   var button_target = jQuery(this).data("target");
   if(button_target == "reg1")
   {
     $('#btn-game').addClass('positive'); // remove the class from the button
     $('#btn-video').removeClass('neagtive'); // remove the class from the button
     var target = "#" + $(this).data("target");
     $(".container1").not(target).hide();
     $(target).show();
   //  target.slideToggle();
   }else
   {
     $('#btn-game').removeClass('positive'); // remove the class from the button
     $('#btn-video').addClass('neagtive'); // remove the class from the button
     var target = "#" + $(this).data("target");
     $(".container1").not(target).hide();
     $(target).show();
   //   target.slideToggle();
   }
   
   
   });
   
   });
   
</script>
@stop