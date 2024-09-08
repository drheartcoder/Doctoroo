@extends('front.doctor.layout.new_master')
@section('main_content')

<style type="text/css">
    .collection .collection-item .online {
        background: #50ab50;
        border-radius: 100%;
        height: 16px;
        width: 16px;
        display: block;
        position: absolute;
        bottom: 5px; top: auto;left: auto;
        right: 3px;
        border: 2px solid #fff;
    }
.onlinenew {
    background: #50ab50;
    border-radius: 100%;
    height: 16px;
    width: 16px;
    display: block;
    position: absolute;
    bottom: 5px;
    right: -5px;
    border: 2px solid #fff;
}

span.onlinenew {
background-color: #50ab50;
width: 17px;
height: 17px;
position: absolute;
border-radius: 50%;
bottom: 0px;
right: -5px;
border: 2px solid #fff;
}
span.online {
background-color: #455b68;
width: 17px;
height: 17px;
position: absolute;
border-radius: 50%;
bottom: 0px;
right: -5px;
border: 2px solid #fff;
}

.messages-section .chatt-message .avatar{overflow: visible !important;     }
.chatt-message.right-avtr.appeared .onlinenew{overflow: visible !important; right: -1px; bottom: -2px;}

</style>
    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">Messages</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">

        <div id="chat" class="tab-content chat-new medi chat-bx-main">
            <div class="chatting-wrapper">
                <div class="user-message-left-bar">
                    <div class="search-block-field">
                        <input type="text" name="search" id="search1" placeholder="Search..."/>
                        <button class="search-submit-btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="collection brdrtopsd messageslist message-page-main left-user-list-block">
                     <table id="myTable" class="table table-striped">
                      
                              @if(isset($patient_data) && !empty($patient_data))
                                @foreach($patient_data as $pat_data)

                                    @php
                                        $pat_id    = isset($pat_data['patient_user_details']['id'])?$pat_data['patient_user_details']['id']:'';
                                        $pat_title = isset($pat_data['patient_user_details']['title'])?$pat_data['patient_user_details']['title']:'';
                                        $pat_first = isset($pat_data['patient_user_details']['first_name'])?$pat_data['patient_user_details']['first_name']:'';
                                        $pat_last  = isset($pat_data['patient_user_details']['last_name'])?$pat_data['patient_user_details']['last_name']:'';
                                        $pat_is_online = isset($pat_data['patient_user_details']['is_online'])?$pat_data['patient_user_details']['is_online']:'';
                                        $pat_pic   = isset($pat_data['patient_user_details']['profile_image'])?$pat_data['patient_user_details']['profile_image']:'';

                                        if ( isset($pat_pic) && !empty($pat_pic) )
                                        {
                                            $profile_images = $patient_profile_pic.$pat_pic;
                                            if ( File::exists($profile_images) ) 
                                            {
                                                $profile_images = $patient_profile_pic."default-image.jpeg";
                                            }
                                        }
                                        else
                                        {
                                            $profile_images = $patient_profile_pic."default-image.jpeg";
                                        }
                                    @endphp
                                    <tr class="valign-wrapper">
                                        <td style="width:100%;">
                                            <div class="collection-item avatar get_patient" data-patient_id="{{ base64_encode($pat_id) }}" data-doctor_id="{{ $logged_dr_id }}">
                                                <a class="received-message message-read" href="javascript:void(0);">
                                                    <div class="image-avtar left">
                                                        <img src="{{ $profile_images }}" alt="" class="circle" />
                                                        @if($pat_is_online == 1)
                                                            <span class="onlinenew"></span>
                                                        @else
                                                            <span class="online"></span>
                                                        @endif
                                                    </div>
                                                    <div class="doc-detail truncate"><span class="title ">{{ $pat_title.' '.$pat_first.' '.$pat_last }}</span></div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>    
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <div class="collection-item avatar">
                                            <a class="valign-wrapper received-message message-read" href="javascript:void(0);">
                                                <div class="truncate"><span class="title ">No patient found</span></div>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>          
                                @endif

                                <tr id="hide_row" style="display:none;">
                                    <td>
                                        <div class="collection-item avatar">
                                            <a class="valign-wrapper received-message message-read" href="javascript:void(0);">
                                                <div class="truncate"><span class="title">No patient found</span></div>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </td>
                                </tr> 
                          
                            </table>
                        </div>

                    <div class="whit-transparent-block"></div>
                </div>

                <div id="hide_messages" class="dashboard_one message-chat-box all-messages-page select-message-option" >
                   
                    <div >
                        <div class="valign-wrapper center-align center-msg">

                                <span class="message-no">
                                    
                                    <img src="{{ url('/') }}/public/doctor_section/images/patient-no-message.png" />
                                    <span>Select Any Patient to start your chat</span> 
                                </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="dashboard_one message-chat-box all-messages-page" id="show_messages" style="display: none;">
                
                </div>
            </div>
        </div>
    </div>

<a class="open_popup_msg_error" href="#show_flash_msg_error" style="display: none;"></a>
<div id="show_flash_msg_error" class="modal addperson" style="display: none;">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <div class="flash_msg_error_txt center-align">Blank message cannot be send. Please enter your message</div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align ">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
   </div>
</div>

<!-- seraching table row TA-->
 <script >
  $(document).ready(function() {
    $('#search1').keyup(function() {
      searchTable1($(this).val());
    });
  });
  function searchTable1(inputVal) {
    var table = $('#myTable');
    var count = 0;
    table.find('tr').each(function(index, row) {
      var allCells = $(row).find('td');
      if (allCells.length > 0) {
        var found = false;
        allCells.each(function(index, td) {
          var regExp = new RegExp(inputVal, 'i');
          if (regExp.test($(td).text())) {
            found = true;
            return false;
          }
        });
        if (found == true){
          $(row).show();
           count = count  + 1;
        } else {
          $(row).hide();
        }
      }
    });
    if (count == 0) {
      $('#hide_row').show();
    }
    else {
      $('#hide_row').hide();
    }
  }
  </script>
  <!--end seraching table row TA-->    
<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
<input type="hidden" id="user_profile_img" name="user_profile_img" value="{{ $user_profile_pic }}" />
<input type="hidden" id="user_timezone" name="user_timezone" value="" />
<input type="hidden" id="dump_id" name="dump_id" value="" />
<input type="hidden" id="dump_session" name="dump_session" value="" />
<input type="hidden" id="selected_patient_id" name="selected_patient_id" value="" />

<script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/moment-with-locales.js"></script>
  <script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.js"></script>


    <!--  Scripts-->
    <script>
        $(document).ready(function(){
            $(".valign-wrapper").on("click", function () {
                $(this).parent().parent().parent().parent().parent().addClass("active");
                $('.close-btn-block').addClass("show");

                setInterval('get_messages()',9000);

            });

            //$('.get_patient').click(function(){
            $(".get_patient").on("click", function () {

                var patient_id = $(this).data("patient_id");
                var token = $('input[name="_token"]').val();

                $("#selected_patient_id").val(patient_id);
                
                $('.message-no').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ');
                $('#get_dynamic_msg').html('<center><i style="margin-top:25%" class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>');

                $.ajax({
                    url: '{{ url("/") }}/doctor/patients/chats/get/'+patient_id,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: token,
                         patient_id: patient_id,
                    },
                    success: function (res) {
                        $('#hide_messages').hide();

                        var data = '';
                        var html_data = '';

                        var dump_id      = res.dump_id;
                        var dump_session = res.dump_session;

                        $("#dump_id").val(dump_id);
                        $("#dump_session").val(dump_session);

                        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
                        var api          = virgil.API(VIRGIL_TOKEN);
                        var key          = api.keys.import(dump_session);

                        $("#user_timezone").val(res.user_timezone);

                        data += '<div class="close-btn-block">';
                        data += '<a class="grey-text" onclick="close_tab()"><i class="fa fa-long-arrow-left"></i> Back</a>';
                        data += '</div>';
                        data += '<div class="send-to-search-block">';
                        data += '<div class="send-to-name">';
                        data += 'To: '+res.patient_fullname;
                        data += '</div>';
                        data += '</div>';
                        data += '<div class="content content-d">';
                        data += '<ul class="messages-section" id="get_dynamic_msg">';

                        $(res.msg).each(function(eachkey, value){

                            var dec_msg   = key.decrypt(value.msg).toString();

                            if(value.from == res.doctor_name)
                            {   
                                data += '<li class="chatt-message right-avtr appeared">';
                                data += '<div class="avatar"><img src="'+res.dr_profile_image+'" alt="" height="50px" width="50px" />';
                                data += '<span class="onlinenew"></span>';
                                data += '</div>';
                                data += '<div class="text_wrapper first">';
                                data += '<div class="text">'+dec_msg+'</div>';
                                data += '<div class="time-snt-left right-align">'+value.datetime+'</div>';
                                data += '</div>';
                                data += '</li>';
                            }
                            if(value.from == res.patient_name)
                            {
                                data += '<li class="chatt-message left-avtr appeared">';
                                data += '<div class="avatar"><img src="'+res.pat_profile+'" alt="" height="50px" width="50px" />';
                                if(res.pat_is_online == '1')
                                {
                                    data += '<span class="onlinenew"></span>';
                                }
                                else
                                {
                                    data += '<span class="online"></span>';
                                }
                                data += '</div>';
                                data += '<div class="text_wrapper first">';
                                data += '<div class="text">'+dec_msg+'</div>';
                                data += '<div class="time-snt-right left-align">'+value.datetime+'</div>';
                                data += '</div>';
                                data += '</li>';
                            }

                        });

                        data += '</ul>';
                        data += '</div>';
                        data += '<div class="input-msg-send-block">';
                        data += '<input type="text" name="send msg" id="message" placeholder="Type your message ..." />';
                        data += '<input type="hidden" name="patient_id" id="patient_id" value="'+res.enc_patient_id+'">';
                        data += '<button onclick="sendMessageTopatient()" type="button" class="btn-flat send_button" ><i class="fa fa-paper-plane"></i> Send</button>';
                        data += '<button type="button" class="btn-flat send_spinner" style="display: none;"><i class="fa fa-paper-plane"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></button>';
                        data += '</div>';

                        $('#show_messages').css('display', 'block');
                        $('#show_messages').html(data);

                    }
                });

            });
        });


        function get_messages()
        {
          var patient_id        = $('#selected_patient_id').val();
          var profile_img       = $('#user_profile_img').val();
          var token             = "<?php echo csrf_token(); ?>";

          $('#err_chat').html('');

          if(patient_id !== '')
          {
            var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";

            $.ajax({
                    url: '{{ url("/") }}/doctor/patients/chats/get/'+patient_id,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: token,
                         patient_id: patient_id,
                    },
                    success: function (res) {
                        $('#hide_messages').hide();

                        var data = '';
                        var html_data = '';

                        var dump_id      = res.dump_id;
                        var dump_session = res.dump_session;

                        $("#dump_id").val(dump_id);
                        $("#dump_session").val(dump_session);

                        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
                        var api          = virgil.API(VIRGIL_TOKEN);
                        var key          = api.keys.import(dump_session);

                        $("#user_timezone").val(res.user_timezone);

                        $(res.msg).each(function(eachkey, value){

                            var dec_msg   = key.decrypt(value.msg).toString();

                            if(value.from == res.doctor_name)
                            {   
                                data += '<li class="chatt-message right-avtr appeared">';
                                data += '<div class="avatar"><img src="'+res.dr_profile_image+'" alt="" height="50px" width="50px" />';
                                data += '<span class="onlinenew"></span>';
                                data += '</div>';
                                data += '<div class="text_wrapper first">';
                                data += '<div class="text">'+dec_msg+'</div>';
                                data += '<div class="time-snt-left right-align">'+value.datetime+'</div>';
                                data += '</div>';
                                data += '</li>';
                            }
                            if(value.from == res.patient_name)
                            {
                                data += '<li class="chatt-message left-avtr appeared">';
                                data += '<div class="avatar"><img src="'+res.pat_profile+'" alt="" height="50px" width="50px" />';
                                if(res.pat_is_online == '1')
                                {
                                    data += '<span class="onlinenew"></span>';
                                }
                                else
                                {
                                    data += '<span class="online"></span>';
                                }
                                data += '</div>';
                                data += '<div class="text_wrapper first">';
                                data += '<div class="text">'+dec_msg+'</div>';
                                data += '<div class="time-snt-right left-align">'+value.datetime+'</div>';
                                data += '</div>';
                                data += '</li>';
                            }

                        });

                        $('#get_dynamic_msg').html(data);

                    }
                });
          }
        }

        function sendMessageTopatient()
        {
            var url               = "{{ url('/') }}/doctor/patients/chats/send/message";
            var message           = $('#message').val();
            var patient_user_id   = $('#patient_id').val();
            var profile_img       = $('#user_profile_img').val();
            var token             = $('input[name="_token"]').val();

            var user_timezone     = $('#user_timezone').val();
            var dump_id           = $("#dump_id").val();
            var dump_session      = $("#dump_session").val();

            var VIRGIL_TOKEN      = "{{env('VIRGIL_TOKEN')}}";
            var api               = virgil.API(VIRGIL_TOKEN);
            var key               = api.keys.import(dump_session);

            if(message != '')
            {
                var findkey = api.cards.get(dump_id)
                .then(function (cards) {

                    var enc_message = encrypt(api, message, cards);

                    var data = new FormData();
                    data.append('message',enc_message);
                    data.append('patient_id',patient_user_id);
                    data.append('profile_img',profile_img);
                    data.append('_token', token);

                     if(enc_message!='')
                     {
                          $.ajax({
                           url: url,
                           type: 'POST',
                           data:data,
                           contentType: false,
                           dataType: 'json',
                           cache: false,
                           processData:false,
                           beforeSend: function()
                           {
                             $('.send_spinner').show();
                             $('.send_button').hide();
                           },
                           success: function(res)
                           {
                              $('.send_spinner').hide();
                              $('.send_button').show();
                              $('#message').val('');
                              
                              var data = '';

                              if(res.status == 'success')
                              {
                                  var dec_msg   = key.decrypt(res.arr_msg.message).toString();

                                  data += '<li class="chatt-message right-avtr appeared">';
                                  data += '<div class="avatar"><img src="'+res.profile_img+'" alt="" height="50px" width="50px" />';
                                  data += '<span class="onlinenew"></span>';
                                  data += '</div>';
                                  data += '<div class="text_wrapper first">';
                                  data += '<div class="text">'+dec_msg+'</div>';
                                  data += '<div class="time-snt-left right-align">'+res.arr_msg.datetime+'</div>';
                                  data += '</div>';
                                  data += '</li>';

                                  $('#get_dynamic_msg').append(data);
                              }
                              else if(res.status == 'error')
                              {

                              }

                           }
                        });
                     }
                     else
                     {
                        return false;
                     }

                });
             }
          else
          {
              $(".open_popup_msg_error").click();
          }

        }
        
        $(document).on('keypress', '#message', function(event){
              var keycode = event.keyCode || event.which;
              if(keycode == '13')
              {
                  sendMessageTopatient();
              }
        });

        function close_tab(){
                /*$(this).parent().removeClass("active");
                $(this).removeClass("show");*/
                $('#show_messages').hide();
        }
        
    </script>
    
@endsection