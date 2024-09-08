<html>
<head>
   <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title> Patient | Doctoroo </title>    
    <link rel="icon" href="{{ url('/') }}/public/doctor_section/images/favicon.png" type="image/x-icon" />
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ url('/') }}/public/doctor_section/css/materialize.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/style.css" rel="stylesheet" media="screen,projection" />    
    <link href="{{ url('/') }}/public/doctor_section/css/doctoroo-doctor.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/materialize.clockpicker.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/css/font-awesome.min.css" rel="stylesheet" media="screen,projection" />
    <script src="{{ url('/') }}/public/doctor_section/js/jquery-1.11.3.min.js"></script>    
    <style>
        .displayblock{
          display: block;
        }
        .displaynone{
          display: none;
        }
        .video-chat-section{max-width: 700px; width: 100%; margin: 0 auto; position: relative;}
        .text-chat-section{max-width: 700px; width: 100%; margin: 0 auto; padding: 20px; border: 1px solid #dddddd;}
        .message-type-section{position: relative;}
        .text-chat-section input{height: 40px; width: 100%; border: 1px solid #dddddd; padding: 0 34px 0 15px; box-sizing: inherit !important;}
        .text-chat-section button{position: absolute;; right: 0; top: 10px; background: none; border: none; color: #22b848; font-size: 20px;}
        .my_profile{height: 50px; width: 50px; border: 1px solid #dddddd; border-radius: 50%; display: inline-block; float: left;}
        .mine{display: block; margin: 0 50px 20px 70px; background: #f4f4f4; border: 1px solid #dddddd; padding: 10px 15px; min-height: 38px; border-radius: 3px; position: relative;}
        .mine:before {content: ""; width: 0; height: 0; border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-right:10px solid #f4f4f4; position: absolute; left: -10px;}
        .my_msgtime{display: block; font-size: 13px; color: #aaaaaa;}
        .his_profile{float: right; height: 50px; width: 50px; border: 1px solid #dddddd; border-radius: 50%; display: inline-block;}
        .theirs{display: block; margin: 0 70px 20px 50px; background: #f4f4f4; border: 1px solid #dddddd; padding: 10px 15px; min-height: 38px; border-radius: 3px; position: relative; margin-bottom: 20px;}
        .theirs:before {content: ""; width: 0; height: 0; border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-left:10px solid #f4f4f4; position: absolute; right: -10px;}
        .his_msgtime{display: block; font-size: 13px; color: #aaaaaa;}
        .call-action-btns{position: absolute; left: 0; width: 100%; bottom: 30px; text-align: center; z-index: 9}
        .mute-btns, .end-call-btn, .stop-video-btn{display: inline-block; vertical-align: middle;}
        .mute-btns button, .stop-video-btn button, .end-call-btn a{height: 40px; width: 40px; border-radius: 50%; text-align: center; border: none; font-size: 17px;}        
        .end-call-btn a{background: #bf2e2a; display: inline-block; padding-top: 12px; color: #ffffff; transform: rotateZ(135deg); margin: 0 20px;}
        .video-call-main{position: relative; max-width: 700px; width: 100%; margin: 0 auto;}
        .call-duration{position: absolute; left: 30px; top: 30px; color: #ffffff; z-index: 9; font-size: 18px;}
        .video-caller{height: 200px; width: 180px; border: 3px solid #dddddd; position: absolute; right: 30px; bottom: 100px; z-index: 9;}
        @media all and (max-width:767px){.video-caller{height: 150px; width: 120px;}}
    </style>
    <!-- sweet alert -->
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script> 
    <link rel="stylesheet" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <style>
    .sweet-alert {
    background-color: white;
   
    width: 478px;
    padding: 17px;
    border-radius: 5px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 10%;
    margin-left: -256px;
    margin-top: 100px !important;
    overflow: hidden;
    display: none;
    z-index: 99999;
    }  
    {
          border-radius: 25px!important;
    }
    .pac-container:after {
    background-image: none !important;
    height: 0px;
    }
    .sweet-alert h2 {
    color: #184059;
    font-size: 18px;
    text-align: center;
    font-weight: 100;
    text-transform: none;
    position: relative;
     margin: -2px 0; 
    padding: 0;
    line-height: 23px;
    display: block;
      font-family: "nolan_nextmedium", sans-serif;
}
    .sweet-alert button {
        background-color: #184059 !important;
    color: white;
    border: none;
    box-shadow: none;
    font-size: 17px;
    font-weight: 500;
    -webkit-border-radius: 25px;
    border-radius: 25px;
    padding: 10px 32px;
    margin: 0px 5px 0 5px;
    cursor: pointer; 
    width: 130px;
    font-family: "nolan_nextmedium", sans-serif;
  }

  .sweet-alert p {
    color: #797979;
    font-size: 16px;
    text-align: center;
    font-weight: 300;
    position: relative;
    text-align: inherit;
    float: none;
    margin: 0;
    padding: 0;
    line-height: normal;
    padding: 11px;
    font-family: "nolan_nextmedium", sans-serif;

  }
  .sweet-alert fieldset { display: none;}
    .sweet-alert .sa-icon {width: 60px!important;height: 60px!important; margin: 10px auto!important;}
  .sweet-alert .sa-icon.sa-warning .sa-body {height: 30px;}

  </style>
    <!-- end sweet alert -->
</head>
<body  style="background-color:#184059;">

    <div id="videos">       
        <div class="video-call-main">
            <div class="call-action-btns">
                <div class="mute-btns">
                    <button id="btn_mute" class="displaynone" ><i class="fa fa-microphone-slash"></i></button>
                    <button id="btn_unmute" class="displayblock" ><i class="fa fa-microphone"></i></button>
                </div>
                <div class="end-call-btn">
                    <a href="javascript:void(0);" onclick="end_call()"  id="close_call"><i class="fa fa-phone"></i></a>
                </div>
                 <div class="stop-video-btn">
                  <button id="stop_video" class="displayblock" ><img src="{{ url('/') }}/public/images/stop-call-icon.png"/></button>
                  <button id="start_video" class="displaynone" ><i class="fa fa-video-camera"></i></button>                    
                </div>          
          </div>
          <div id="subscriber" class="video-chat-section" >             
              <div class="call-duration">
                  <div id="hms">{{ $call_time }}</div>
              </div>              
            </div>
            <div id="publisher" class="video-caller" ></div>
        </div>
    </div>

    <div id="no_video_call" style="display: none;">
      Doctor has not started or it seems like video call has ended
      <a href="javascript:void(0);" id="end_video_call">Close Video Call</a>
    </div>
    <!-- <div id="textchat" class="text-chat-section">
         <p id="history">
         </p>
         <form>
         	<div class="message-type-section">
              <input type="text" placeholder="Input your text here" id="msgTxt"></input>              
              <button type="submit" id="btn_send_msg" ><i class="fa fa-paper-plane"></i></button>
          </div>
         </form>
    </div> -->
    <script src="{{ url('/') }}/public/js/loader.js"></script>
    <link href="{{ url('/') }}/public/css/loading.css" rel="stylesheet"/>
    <input type="hidden" name="booking_id" id="booking_id" value="{{ $booking_id }}">

    <script src="{{ url('/') }}/public/toastr/jquery.min.js"></script>
    <!-- <link href="{{ url('/') }}/public/toastr/bootstrap.min.css" rel="stylesheet"> -->
    <script src="{{ url('/') }}/public/toastr/toastr.min.js"></script>
    <link href="{{ url('/') }}/public/toastr/toastr.min.css" rel="stylesheet">

    <script>
    var timeoutHandle;
    function count() {
      var startTime = document.getElementById('hms').innerHTML;
      var pieces = startTime.split(":");
      var time = new Date();
      time.setHours(pieces[0]);
      time.setMinutes(pieces[1]);
      time.setSeconds(pieces[2]);
      var timedif = new Date(time.valueOf() + 1000);
      var newtime = timedif.toTimeString().split(" ")[0];
      document.getElementById('hms').innerHTML=newtime;
      timeoutHandle=setTimeout(count, 1000);
      setTimeout(function(){
        update_call_time();
      },0);
    }
  </script>

  <script>
 


        interval = setInterval(function(){ check_doctor_active() }, 1000);

        // replace these values with those generated in your TokBox Account
        var token       = "{{ $token }}";
        var sessionId   = "{{ $sessionId }}";
        var apiKey      = "{{ $api_key }}";

        // Handling all of our errors here by alerting them
        function handleError(error) {
          if (error) {
            alert(error.message);
          }
        }


        // (optional) add server code here
        initializeSession();

        function initializeSession() {
          showProcessingOverlay();
          var session = OT.initSession(apiKey, sessionId);
          // Subscribe to a newly created stream
          session.on('streamCreated', function(event) {
            hideProcessingOverlay();
            count();
            var subscriber = session.subscribe(event.stream, 'subscriber', {
              insertMode: 'append',
              width: '100%',
              height: '100%',
              subscribeToAudio:true, subscribeToVideo:true
            }, handleError);
          });


          // Create a publisher
          var publisher = OT.initPublisher('publisher', {
            insertMode: 'append',
            width: '100%',
            height: '100%',
            publishAudio:true, publishVideo:true
          }, handleError);

          // Connect to the session
          session.connect(token, function(error) {
            // If the connection is successful, initialize a publisher and publish to the session
            if (error) {
              handleError(error);
            } else {
              session.publish(publisher, handleError);
            }
          });

          // Receive a message and append it to the history
          var msgHistory = document.querySelector('#history');
          session.on('signal:msg', function(event) {
            var pic = document.createElement('span');
            pic.className = event.from.connectionId === session.connection.connectionId ? 'my_profile' : 'his_profile';
            msgHistory.appendChild(pic);

            var msg = document.createElement('span');
            msg.textContent = event.data;
            msg.className = event.from.connectionId === session.connection.connectionId ? 'mine' : 'theirs';
            msgHistory.appendChild(msg);

      			//var mymsg = document.getElementsByClassName('mine').last();
            var mymsg   = document.querySelector('.mine');
      			var msgtime = document.createElement('span');
      			msgtime.textContent = "11:39";
            msgtime.className = event.from.connectionId === session.connection.connectionId ? 'my_msgtime' : 'his_msgtime';
            msg.appendChild(msgtime);

            msg.scrollIntoView();
          });

          // Text chat
          /*var form = document.querySelector('form');
          var msgTxt = document.querySelector('#msgTxt');*/

          // Send a signal once the user enters data in the form
         /* form.addEventListener('submit', function(event) {
            event.preventDefault();

            session.signal({
                type: 'msg',
                data: msgTxt.value
              }, function(error) {
                if (error) {
                  console.log('Error sending signal:', error.name, error.message);
                } else {
                  msgTxt.value = '';
                }
              });
          });*/

          var stop_video = document.querySelector('#stop_video');
          stop_video.addEventListener('click', function(event) {
            publisher.publishVideo(false);

            document.getElementById("start_video").classList.add("displayblock");
            document.getElementById("start_video").classList.remove("displaynone");

            document.getElementById("stop_video").classList.add("displaynone");
            document.getElementById("stop_video").classList.remove("displayblock");
          });

          var start_video = document.querySelector('#start_video');
          start_video.addEventListener('click', function(event) {
            publisher.publishVideo(true);

            document.getElementById("start_video").classList.add("displaynone");
            document.getElementById("start_video").classList.remove("displayblock");

            document.getElementById("stop_video").classList.add("displayblock");
            document.getElementById("stop_video").classList.remove("displaynone");
          });

          var mute_video = document.querySelector('#btn_mute');
          mute_video.addEventListener('click', function(event) {
            publisher.publishAudio(true);

            document.getElementById("btn_unmute").classList.add("displayblock");
            document.getElementById("btn_unmute").classList.remove("displaynone");

            document.getElementById("btn_mute").classList.add("displaynone");
            document.getElementById("btn_mute").classList.remove("displayblock");
          });

          var unmute_video = document.querySelector('#btn_unmute');
          unmute_video.addEventListener('click', function(event) {
            publisher.publishAudio(false);

            document.getElementById("btn_unmute").classList.add("displaynone");
            document.getElementById("btn_unmute").classList.remove("displayblock");

            document.getElementById("btn_mute").classList.add("displayblock");
            document.getElementById("btn_mute").classList.remove("displaynone");
          });
        }

        

        // check id doctor is on call or not
        function check_doctor_active()
        {
          var token = "<?php echo csrf_token(); ?>";
          var booking_id = document.getElementById("booking_id").value;
          $.ajax({
            url   : "{{ url('/') }}/patient/video/check_doctor_active",
            type : "POST",
            dataType: 'json',
            data:{_token:token, booking_id:booking_id },
            success : function(res){
             
              if(res)
              {
                if(res.call_status == 'end'){
                    hideProcessingOverlay();
                    swal({ title: "Doctor has ended this call...",   
                         text: "",  
                         type: "warning",   
                         showCancelButton: false,   
                         confirmButtonColor: "#184059",  
                         confirmButtonText: "Ok",  
                         cancelButtonText: "No",   
                         closeOnConfirm: false,   
                         closeOnCancel: false }, function(isConfirm){   
                          if (isConfirm) 
                          { 
                              window.close();
                          } 
                        });
                  }
                  if(res.call_status == 'reject'){
                    hideProcessingOverlay();
                    swal({ title: "Doctor has rejected your call...",   
                         text: "",  
                         type: "warning",   
                         showCancelButton: false,   
                         confirmButtonColor: "#184059",  
                         confirmButtonText: "Ok",  
                         cancelButtonText: "No",   
                         closeOnConfirm: false,     
                         closeOnCancel: false }, function(isConfirm){   
                          if (isConfirm) 
                          { 
                                window.close();
                               
                          } 
                        });
                  }
                clearTimeout(timeoutHandle);
                //toastr.success(res.msg, {timeOut: 10000})
                //alert('call is ended');
              }
            }
          });
        }
        /*var interval = setInterval(function () { check_doctor_active(); }, 6000);*/

        /*function close_call(){
          var _token = "<?php //echo csrf_token(); ?>";
          var call_time  = document.getElementById("hms").innerHTML;
          var booking_id = document.getElementById("booking_id").value;
          $.ajax({
              url: '{{ url("/") }}/patient/video/update_video_call_end_status',
              type: 'POST',
              //dataType: 'json',
              data: {
                  _token: _token,
                  call_time: call_time,
                  booking_id: booking_id
              },
              success: function (res) {
                  window.close();
              }
          });
        }*/
        function end_call(){
          var _token = "<?php echo csrf_token(); ?>";
          var call_time  = document.getElementById("hms").innerHTML;
          var booking_id = document.getElementById("booking_id").value;
          
           swal({   title: "Are you sure?",   
             text: "You want to end this call ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#184059",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                    swal("Call End!", "Your call has been ended.", "success");
                    window.close();
                    $.ajax({
                        url: '{{ url("/") }}/patient/video/status',
                        type: 'POST',
                        //dataType: 'json',
                        data: {
                            _token: _token,
                            call_time: call_time,
                            booking_id: booking_id,
                        },
                        success: function (res) {
                            window.close();
                        }
                    });
              } 
              else
              { 
                     swal("Cancelled");          
              } 
            });
        }
        function update_call_time(){
            var last_stored_time       = document.getElementById('last_stored_time').value;
            var last_stored_time_cnt   = document.getElementById('last_stored_time_cnt').value;
            var time       = document.getElementById('hms').innerHTML;
            var booking_id = document.getElementById("booking_id").value;
            var url        = '{{ url("/") }}/patient/video/update_video_call_time';
            var _token = "<?php echo csrf_token(); ?>";

            $.ajax({
                url:url,
                type:'POST',
                data:{time:time,booking_id:booking_id,_token:_token},
                //dataType:'json',
                success:function(data){
                     console.log(last_stored_time+' '+data);
                     if(last_stored_time == data){

                           if(last_stored_time_cnt<=10){
                            document.getElementById('last_stored_time_cnt').value = parseInt(last_stored_time_cnt) + parseInt(1);
                           }
                           else{
                              
                              $.ajax({
                                  url: '{{ url("/") }}/patient/video/update_video_call_end_status',
                                  type: 'POST',
                                  data: {
                                      _token: _token,
                                      call_time: time,
                                      booking_id: booking_id
                                  },
                                  success: function (res) {
                                  }
                              });

                              swal({ title: "Unfortunataly Doctor's call disconnected....",   
                               text: "",  
                               type: "warning",   
                               showCancelButton: false,   
                               confirmButtonColor: "#184059",  
                               confirmButtonText: "Ok",  
                               cancelButtonText: "No",   
                               closeOnConfirm: false,   
                               closeOnCancel: false }, function(isConfirm){   
                                if (isConfirm) 
                                { 
                                  window.close();
                                } 
                              });
                           }
                     }
                     else {
                        document.getElementById("last_stored_time").value     = data;
                        document.getElementById('last_stored_time_cnt').value = 0;
                     }  
                }
            });
        }
</script>

<input type="hidden" name="last_stored_time" id="last_stored_time"  >
<input type="hidden" name="last_stored_time_cnt" id="last_stored_time_cnt" value="0"  >


<script>
(function (global, $) {

var _hash = "!";
var noBackPlease = function () {
  global.location.href += "#";
  global.setTimeout(function () 
  {
    global.location.href += "!";
  }, 50);
};

global.onhashchange = function () {
  if (global.location.hash != _hash) {
    global.location.hash = _hash;
  }
};

global.onload = function () 
{
  noBackPlease();
    // disables backspace on page except on input fields and textarea..
    $(document.body).keydown(function (e) {
      var elm = e.target.nodeName.toLowerCase();
      if (e.which == 8 && (elm !== 'input' && elm  !== 'textarea')) 
      {
        e.preventDefault();
      }
        // stopping event bubbling up the DOM tree..
        e.stopPropagation();
      });
  };
})(window, jQuery || window.jQuery);
</script>
</body>
</html>
 