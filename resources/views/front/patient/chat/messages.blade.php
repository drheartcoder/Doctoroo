<style>
.input-msg-send-block input {
    width: 100% !important;
    height: 60px !important;
    border: 1px solid #e1e8eb !important;
    padding: 0 104px 0 9px !important;
    box-sizing: border-box !important;
    border-radius: 34px !important;
}
.input-msg-send-block button {
    position: absolute !important;
    right: 4px !important;
    top: 3px !important;
    padding: 6px 21px !important;
    height: 54px !important;
    background-color: #4CAF50 !important;
    color: #fff !important;
    border-radius: 60px !important;
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
.online{
    background: #455b68;
    border-radius: 100%;
    height: 16px;
    width: 16px;
    display: block;
    position: absolute;
    bottom: 5px;
    right: -5px;
    border: 2px solid #fff;
}
.messages-section .chatt-message .avatar{overflow: visible !important;}
.chatt-message.right-avtr.appeared .onlinenew{overflow: visible !important; right: -1px; bottom: -2px;}
</style>
@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/chat" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Messages</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer minhtnor">

        <div class="container posrel futspace">
            <div class="dashboard_one">
                <div class="content content-d only-chat-tab">
                    <ul class="messages-section" id="get_dynamic_msg">
                      
                      <!-- @if(isset($arr_all_msg) && !empty($arr_all_msg))
                        @foreach($arr_all_msg as $all_msg)
                          @if($all_msg['from'] == $patient_name)
                            <li class="chatt-message right-avtr appeared">
                                <div class="avatar"><img src="{{ $user_profile_pic }}"  alt="" height="50px" width="50px" /></div>
                                <div class="text_wrapper first">
                                    <div class="text">{{ $all_msg['msg'] }}</div>
                                    <div class="time-snt-left right-align">{{ date("D, F d, Y, h:i a", strtotime($all_msg['datetime'])) }}</div>
                                </div>
                            </li>
                          @endif

                          @if($all_msg['from'] == $doctor_name)
                            <li class="chatt-message left-avtr appeared">
                                <div class="avatar"><img src="{{ $doctor_public_img_path.'/'.$doctor_pic }}"  alt="" height="50px" width="50px" /></div>
                                <div class="text_wrapper first">
                                    <div class="text">{{ $all_msg['msg'] }}</div>
                                    <div class="time-snt-right left-align">{{ date("D, F d, Y, h:i a", strtotime($all_msg['datetime'])) }}</div>
                                </div>
                            </li>
                          @endif
                        @endforeach
                      @endif -->

                    </ul>
                </div>
                <div class="input-msg-send-block">
                    <input type="text" name="message" id="message" placeholder="Type your message ..." />
                    <input type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor_id }}">
                    <button type="submit" class="btn-flat send_button" onclick="sendMessageTodoctor()"><i class="fa fa-paper-plane"></i> Send</button>
                    <button type="button" class="btn-flat send_spinner" style="display: none;"><i class="fa fa-paper-plane"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>


<a class="open_popup_msg_error" href="#show_flash_msg_error" style="display: none;"></a>
<div id="show_flash_msg_error" class="modal requestbooking" style="display: none;">
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

<input type="hidden" id="user_profile_img" name="user_profile_img" value="{{ $user_profile_pic }}" />
<input type="hidden" id="channel_id" name="channel_id" value="{{ $channel_id }}" />
<input type="hidden" id="dump_id" name="dump_id" value="{{ $dump_id }}" />
<input type="hidden" id="dump_session" name="dump_session" value="{{ $dump_session }}" />

<script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
<script src="{{ url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/moment-with-locales.js"></script>
<script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.js"></script>

<script>

    //var interval =  setInterval('get_messages()',500);
    setInterval('get_messages()',3000);

    create_virgil();

    var user_timezone = "{{$timezone_location}}";

    $(document).ready(function(){
      $('.content').scrollTop($('.content')[0].scrollHeight);

      $('#get_dynamic_msg').html('<center><i style="margin-top:25%" class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>');
      get_messages();
    });

    $("#message").on('keypress',function(event)
    {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            sendMessageTodoctor();
        }
    })  

    function get_messages()
    {
      var doctor_user_id     = $('#doctor_id').val();
      var profile_img        = $('#user_profile_img').val();
      var token              = "<?php echo csrf_token(); ?>";
      var url                = "{{ $module_url_path }}/get_messages";
      var msg_count          = $('ul#get_dynamic_msg li').length;

      var channel_id          = $('#channel_id').val();

      $('#err_chat').html('');

      if(doctor_user_id !== '')
      {
        var data          = new FormData();
        data.append('doctor_id',doctor_user_id);
        data.append('profile_img',profile_img);
        data.append('_token', token);
        data.append('channel_id', channel_id);

        $.ajax({
          url: url,
          type: 'POST',
          data:data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(res)   
          {
            if(res)
            {
              $('#get_dynamic_msg').html('');

              var data = '';

              var dump_id      = $("#dump_id").val();
              var dump_session = $("#dump_session").val();

              var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
              var api          = virgil.API(VIRGIL_TOKEN);
              var key          = api.keys.import(dump_session);

              $(res.messages).each(function(eachkey, value){

                  var dec_msg   = key.decrypt(value.msg).toString();

                  if(value.from == res.patient_name)
                  {   
                      data += '<li class="chatt-message right-avtr appeared">';
                      data += '<div class="avatar image-avtar"><img src="'+res.patient_img+'" alt="" height="50px" width="50px" />';
                      data += '<span class="onlinenew"></span>';
                      data += '</div>';
                      data += '<div class="text_wrapper first">';
                      data += '<div class="text">'+dec_msg+'</div>';
                      data += '<div class="time-snt-left right-align">'+value.datetime+'</div>';
                      data += '</div>';
                      data += '</li>';
                  }
                  else if(value.from == res.doctor_name)
                  {
                      data += '<li class="chatt-message left-avtr appeared">';
                      data += '<div class="avatar image-avtar"><img src="'+res.doctor_img+'" class="circle" alt="" height="50px" width="50px" />';
                      if(res.doctor_is_online == '1')
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

              /*var get_count = $('#msg_count').val();
              if(get_count != msg_count)
              {

              }*/
            }
          }
        });
      }
    }

   function sendMessageTodoctor()
   {

      var url                = "{{ $module_url_path }}/send_message";
      var message            = $('#message').val();
      var doctor_user_id     = $('#doctor_id').val();
      var profile_img        = $('#user_profile_img').val();
      var token              = "<?php echo csrf_token(); ?>";
      var channel_id          = $('#channel_id').val();
      $('#err_chat').html('');

      var dump_id      = $("#dump_id").val();
      var dump_session = $("#dump_session").val();

      var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
      var api          = virgil.API(VIRGIL_TOKEN);
      var key          = api.keys.import(dump_session);

      if(message != '')
      {

      var findkey = api.cards.get(dump_id)
      .then(function (cards) {

          var enc_message = encrypt(api, message, cards);

          if(enc_message != '')
          {
               var data          = new FormData();
               data.append('message',enc_message); 
               data.append('doctor_id',doctor_user_id);
               data.append('profile_img',profile_img);
               data.append('_token', token); 
               data.append('channel_id', channel_id);

                $.ajax({
                 url: url,
                 type: 'POST',        
                 data:data, 
                 contentType: false,     
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
                    if(res)
                    {
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
                            data += '<div class="time-snt-left right-align">'+res.datetime+'</div>';
                            data += '</div>';
                            data += '</li>';

                            $('#get_dynamic_msg').append(data);
                        }
                        else if(res.status == 'error')
                        {

                        }
                    }
                 }
              });
          }
          else
          {
              $(".open_popup_msg_error").click();
          }

      });

       }
      else
      {
          $(".open_popup_msg_error").click();
      }
   }
   
   function createChannel(ref)
   {
      
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

   function create_virgil()
  {
        var channel_id   = $("#channel_id").val();
        var dump_id      = $("#dump_id").val();
        var dump_session = $("#dump_session").val();

        if(dump_id == '' && dump_session == '' )
        {
            var virgilToken = "{{env('VIRGIL_TOKEN')}}";
        
            var api         = virgil.API(virgilToken);
            console.log('api '+api);

            // generate and save Virgil Key
            var userKey = api.keys.generate();
            console.log('userKey '+userKey);

            // export Virgil key to string
            var exportedKey = userKey.export().toString("base64");
            console.log('exportedKey '+exportedKey);

            // create Virgil Card
            var userCard = api.cards.create(channel_id, userKey);
            console.log('userCard '+userCard);

            // export Virgil Card to string
            var exportedCard = userCard.export();
            console.log('exportedCard '+exportedCard);

            // transmit the Virgil Card to the server
            var _token = "{{ csrf_token() }}";
            console.log('_token '+_token);

            $.ajax({
                url: '{{ url("/") }}/patient/chat/virgil/store',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: _token,
                    exportedCard: exportedCard,
                    exportedKey: exportedKey,
                    channel_id: channel_id
                },
                success: function (res) {
                    if (res.status == 'success') {
                      
                      $("#dump_id").val(res.dump_id);
                      $("#dump_session").val(res.dump_session);

                      console.log('dump_id '+res.dump_id);
                      console.log('dump_session '+res.dump_session);

                    }
                    else {
                      //alert('Something went wrong');
                    }
                }
            });

        }
    }
</script>

@endsection