@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')

      <link href="{{ url('/') }}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
    
      <div class="container-fluid fix-left-bar">
         <div class="row">
       
           <div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">{{ $page_title or '' }}</div>
                        <div class="head-bor"></div>

                   

                     </div>
                     <div class="col-sm-12">
                       <div class="alert-box alert_error alert-dismissible" id="chat_err_msg" style="display: none;">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span style="font-size: 20px;">×</span></button>  
                       </div>
                     </div>
                  </div>
                  <div class="row">
                
                     <div class="col-sm-12 col-md-12 col-lg-3">
                        <div class="left-side-tabs">
                           <form action="{{ $module_url_path }}" method="get" id="frm_search_doctor" name="frm_serach_doctor"> 
                              <div class="msg-search"><input type="text" name="search_term" id="search_term" class="search_msg" placeholder="Search.."/></div>
                          </form>
                           <div class="new-msg">
                              Chat with doctor
                           </div>
                           <div  class="messagecrollbar-msg content-d">
                              <ul class="sub_respo1">
                              @if(isset($arr_doctor_list) && sizeof($arr_doctor_list)>0)
                                 @foreach($arr_doctor_list as $list)
                            
                                    <li>
                                       <div class="massanger_user">
                                          <div class="user_img">
                                                @if(isset($list['doctor_user_details']['profile_image']) && $list['doctor_user_details']['profile_image']!='' && file_exists($doctor_base_img_path.'/'.$list['doctor_user_details']['profile_image']))
                                                    
                                                   <img src="{{ $doctor_public_img_path.'/'.$list['doctor_user_details']['profile_image'] }}" alt=""/>
                                                @else
                                                    <img src="{{ $doctor_public_img_path }}/default-image.jpeg" alt=""/>
                                                @endif
                                          </div>
                                          <div class="user_details">
                                             <a onclick="createChannel('{{ base64_encode($list['doctor_user_id']) }}')">
                                                <div class="user_name">

                                                 {{ isset($list['doctor_user_details']['title'])?$list['doctor_user_details']['title']:'' }}
                                                 {{ isset($list['doctor_user_details']['first_name'])?$list['doctor_user_details']['first_name']:'' }}
                                                 {{ isset($list['doctor_user_details']['last_name'])?$list['doctor_user_details']['last_name']:'' }}
                                                </div>
                                             </a>
                                   
                                          </div>
                                       </div>
                                    </li>
                                 @endforeach
                                 @else
                                    <div class="search-grey-bx">
                                      <div class="row">
                                            {{ 'No doctors are available.' }}
                                      </div>
                                   </div> 
                              @endif
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
                                       {{ $friendly_Name or '' }}
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-8 col-lg-7">
                                    <div class="chat-search">

                                      @if(isset($user_id) && $user_id!="")
                                       <a href="#doctor_profile_{{ $user_id }}" data-toggle="modal"> Doctor Profile</a>
                                      @endif

                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="messagecrollbar-msg-b">
                           
                              <div class="chatting-section">

                               <div id="refershChat">
                                 
                                 @if(isset($arr_show_msg) && sizeof($arr_show_msg)>0)
                        
                                   @foreach($arr_show_msg as $message)
                                     


                                         <?php
                                            $date = '';
                                            $date = date('d M,Y',strtotime($message['datetime']));
                                            $time = date('h:i a',strtotime($message['datetime']));

                                         ?>
                                         @if(isset($message['status']) && $message['status']=='Doctor')
                                          <div class="chat_left_side">
                                           
                                            <p class="triangle-right left">{{ $message['msg'] or '' }}
                                               <span class="rgt-time">
                                                    {{ $date or '' }} {{ $time or '' }}
                                               </span>
                                            </p>
                                            <div class="clr"></div>
                                          </div> 
                                       

                                        @elseif(isset($message['status']) && $message['status']=='Patient')
                                           <div class="chat_right_side">
                                               <p class="triangle-left right">{{ $message['msg'] or '' }}
                                               <span class="rgt-time" style="color:#bbb">
                                                 {{ $date or '' }}
                                                 {{ $time or '' }}
                                               </span>
                                              </p>
                                              <div class="clr"></div>
                                           </div> 
                                 
                                        @endif

                                   
                                  @endforeach
                                @endif   

                                 <div class="chat_right_side">
                                      <div id="append_msg"></div>
                                      <div class="clr"></div>
                                 </div> 

                              
                                 <div class="clr"></div>
                               </div>
                              </div>
                           </div>
                           <br/>
                           <div class="error" id="show_error"></div>
                           <div class="msg_input">
                              <textarea  cols="" rows="" id="message" name="message" class="msg-in" placeholder="Write a Reply..." style="padding-top:10px;"></textarea>
                              <input type="hidden" id="doctor_user_id" name="doctor_user_id">
                              <div id="err_chat" class="error"></div>
                              <div class="msg-btn">
                              {{--    <a href="#" class="pos-ab"><i class="fa fa-paperclip"></i></a> --}}
                                  <button class="submit-msg" onclick="sendMessageTopatient()">
                                          <i class="fa fa-paper-plane"></i> Send
                                  </button>
                              </div>

                           </div>
                        </div>
                      
                     </div>
                  </div>
               </div>
            </div>
               <div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>
         </div>
      </div>
     
@include('front.patient.chat.doctor_profile')

<script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
<script src="{{ url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
 /*   function autoRefresh()
    {
      
       $("#refershChat").load(location.href + " #refershChat");

    }
    setInterval('autoRefresh()',3000);*/
    
</script>
<script>

  $("#message").on('keypress',function(event)
   {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            sendMessageTopatient();
        }
   })  

   function sendMessageTopatient()
   {
      var url                = "{{ $module_url_path }}/send_message";
      var message            = $('#message').val();
      var token              = $("input[name='_token']").val(); 
      $('#err_chat').html('');

   
      if(message!='')
      {
           var data          = new FormData();
           data.append('message',message); 
           data.append('user_id',doctor_user_id);  
           data.append('_token', token); 

            $.ajax({
             url: url,
             type: 'POST',        
             data:data, 
             contentType: false,     
             cache: false,          
             processData:false,  
             beforeSend: function() 
             {
               showProcessingOverlay();
             },
             success: function(res)   
             {
                hideProcessingOverlay();
   
                if(res.status=="success")
                {
                   var msg_html = '';
                   msg_html    +=  '<p class="triangle-left right">'+res.message
                   msg_html    +=  '<span class="rgt-time" style="color:#bbb">'+res.datetime+'</span></p>';
                   jQuery("#append_msg").append(msg_html); 
                }
                else
                {

                    $('#chat_err_msg').fadeIn(0, function()
                    {
                         $('#chat_err_msg').html('Please select doctor for chating.');
                    }).delay(2000).fadeOut('slow');

                }
                $('#message').val('');
             }
          });
      }
      else
      {
          $('#err_chat').html('Enter a message');
      }
   

   }
   
   function createChannel(ref)
   {
      showProcessingOverlay();
      window.location.href = '{{ $module_url_path }}/create_channel/'+ref;
   }

   $("#search_term").on('keypress',function(event)
   {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            $('#frm_search_doctor').submit();
        }
   })  
</script>

@endsection