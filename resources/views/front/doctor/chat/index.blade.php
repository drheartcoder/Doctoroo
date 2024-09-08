<style>
.input-msg-send-block input {
    width: 100% !important;
    height: 60px !important;
    border: 1px solid #e1e8eb !important;
    padding: 0 104px 0 9px !important;
    box-sizing: border-box !important;
    border-radius: 34px !important;
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
/*.online{
    background: #455b68;
    border-radius: 100%;
    height: 16px;
    width: 16px;
    display: block;
    position: absolute;
    bottom: 5px;
    right: -5px;
    border: 2px solid #fff;
}*/

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
.messages-section .chatt-message .avatar{overflow: visible !important;}
/*.chatt-message.right-avtr.appeared{overflow: visible !important;}*/
</style>
@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')
    
    <div class="mar300  has-header minhtnor">   
    <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li>
            </ul>
        </div>

        <div id="chat" class="tab-content medi chat-bx-main">
            <div class="row chat-tab-wrapper">

                <div class="dashboard_one message-chat-box">
                    <div class="close-btn-block">
                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                    </div>

                    <div class="send-to-search-block">
                            <div class="send-to-name">
                            <b>To</b> : <b>{{isset($patient_data['first_name'])?$patient_data['first_name']:''}} {{isset($patient_data['first_name'])?$patient_data['last_name']:''}}</b>
                            </div>
                        </div>
                    <div class="content content-d only-chat-tab">
                        <ul class="" id="get_dynamic_msg">
                        </ul>
                    </div>
                    <div class="input-msg-send-block">
                        <input type="text" name="send msg" id="message" placeholder="Type your message ..." />
                        <input type="hidden" name="patient_id" id="patient_id" value="{{ base64_encode($patient_id) }}">
                        <button type="submit" class="btn-flat btn_send_msg" onclick="sendMessageTopatient()"><i class="fa fa-paper-plane"></i> Send</button>
                        <button type="submit" class="btn-flat btn_spinner" style="display:none;" ><i class="fa fa-paper-plane"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></button>
                    </div> 

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

  <input type="hidden" id="user_profile_img" name="user_profile_img" value="{{ $user_profile_pic }}" />
  <input type="hidden" id="channel_id" name="channel_id" value="{{ $channel_id }}" />
  <input type="hidden" id="dump_id" name="dump_id" value="{{ $dump_id }}" />
  <input type="hidden" id="dump_session" name="dump_session" value="{{ $dump_session }}" />

  <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
  <script src="{{ url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>

  <script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/moment-with-locales.js"></script>
  <script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.js"></script>

  <script>
  
    setInterval('get_messages()',3000);

    var user_timezone = "{{$timezone_location}}";

    $(document).ready(function(){
        $('.content').scrollTop($('.content')[0].scrollHeight);

        var channel_id   = $("#channel_id").val();
        var dump_id      = $("#dump_id").val();
        var dump_session = $("#dump_session").val();

        create_virgil();

        if(dump_id != '' && dump_session != '' )
        {
          $('#get_dynamic_msg').html('<center><i style="margin-top:25%" class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>');
          get_messages();
        }
    });

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
                url: '{{ url("/") }}/doctor/patients/chats/virgil/store',
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
                      //alert('Something went wrong');
                      $("#dump_id").val(res.dump_id);
                      $("#dump_session").val(res.dump_session);
                    }
                    else {
                      //alert('Something went wrong');
                    }
                }
            });

        }
    }

    function get_messages()
    {
      var patient_user_id    = $('#patient_id').val();
      var profile_img        = $('#user_profile_img').val();
      var token              = "<?php echo csrf_token(); ?>";
      var url                = "{{ url('/') }}/doctor/patients/chats/get/messages";
      var msg_count          = $('ul#get_dynamic_msg li').length;

      $('#err_chat').html('');

      if(patient_user_id !== '')
      {
        var data          = new FormData();
        data.append('patient_id',patient_user_id);
        data.append('profile_img',profile_img);
        data.append('_token', token);

        $.ajax({
          url: url,
          type: 'POST',
          data:data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(res)   
          {
              if(res.status == 'success')
              {
                  var data = '';

                  var dump_id      = $("#dump_id").val();
                  var dump_session = $("#dump_session").val();

                  var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
                  var api          = virgil.API(VIRGIL_TOKEN);
                  var key          = api.keys.import(dump_session);

                  $(res.messages).each(function(eachkey, value){

                      var dec_msg   = key.decrypt(value.msg).toString();

                      if(value.from == res.doctor_name)
                      {   
                          data += '<li class="chatt-message right-avtr appeared">';
                          data += '<div class="avatar image-avtar"><img src="'+res.doc_profile_img+'" class="circle" alt="" height="50px" width="50px" />';
                          data += '<span class="onlinenew"></span>';
                          data += '</div>';
                          data += '<div class="text_wrapper first">';
                          data += '<div class="text">'+dec_msg+'</div>';
                          data += '<div class="time-snt-left right-align">'+value.datetime+'</div>';
                          data += '</div>';
                          data += '</li>';
                      }
                      else if(value.from == res.patient_name)
                      {
                          data += '<li class="chatt-message left-avtr appeared">';
                          data += '<div class="avatar"><img src="'+res.pat_profile_path+res.patient_pic+'" alt="" height="50px" width="50px" />';
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

                  $('#get_dynamic_msg').html('');
                  $('#get_dynamic_msg').html(data);
              }
              else if(res.status == 'error')
              {

              }
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
      var token             = "<?php echo csrf_token(); ?>";

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
                 cache: false,          
                 processData:false,  
                 beforeSend: function() 
                 {
                    $('.btn_spinner').show(); 
                    $('.btn_send_msg').hide();
                 },
                 success: function(res)   
                 {
                    $('.btn_spinner').hide(); 
                    $('.btn_send_msg').show();
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
   
   function createChaneel(ref)
   {
      window.location.href = '{{ $module_chat_path }}/create_channel/'+ref;
   }

   $("#message").on('keypress',function(event)
   {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            sendMessageTopatient();
        }
   })

   $("#search_term").on('keypress',function(event)
   {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
           $('#frm_search').submit();
        }
   })    

  $(document).ready(function(){
      var $enc_patient_id = "<?php echo $enc_patient_id; ?>";
      $('#tab_patient_history').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/details/" + $enc_patient_id;
      });
      $('#tab_medical_history').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/medical_history/" + $enc_patient_id;
      });
      $('#tab_consultation_history').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/consultation_history/" + $enc_patient_id;
      });
      $('#tab_tools').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
      });
      $('#tab_chat').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/chats/" + $enc_patient_id;
      });
      $('#tab_consultation_guide').click(function(){
          window.location = "{{ url('/') }}/doctor/patients/consultation_guide/" + $enc_patient_id;
      });
  });

</script>

@endsection
    