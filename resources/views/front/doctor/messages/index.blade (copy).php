@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">Messages</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">

        <div id="chat" class="tab-content medi chat-bx-main">
            <div class="row">
                <div class="user-message-left-bar">
                    <div class="search-block-field">
                        <input type="text" name="search" id="search1" />
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
                                    <tr>
                                        <td >
                                            <div class="collection-item avatar get_patient" data-patient_id="{{ base64_encode($pat_id) }}" data-doctor_id="{{ $logged_dr_id }}">
                                                <a class="valign-wrapper received-message message-read" href="javascript:void(0);">
                                                    <div class="image-avtar left"><img src="{{ $profile_images }}" alt="" class="circle" /></div>
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
                                                <div class="truncate"><span class="title ">No Patients to Show</span></div>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>          
                                @endif
                          
                            </table>
                        </div>
                        <!-- <ul class="collection brdrtopsd messageslist message-page-main left-user-list-block">

                            @if(isset($patient_data) && !empty($patient_data))
                                @foreach($patient_data as $pat_data)

                                    @php
                                        $pat_id    = isset($pat_data['patient_user_details']['id'])?$pat_data['patient_user_details']['id']:'';
                                        $pat_title = isset($pat_data['patient_user_details']['title'])?$pat_data['patient_user_details']['title']:'';
                                        $pat_first = isset($pat_data['patient_user_details']['first_name'])?$pat_data['patient_user_details']['first_name']:'';
                                        $pat_last  = isset($pat_data['patient_user_details']['last_name'])?$pat_data['patient_user_details']['last_name']:'';
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

                                    <li class="collection-item avatar get_patient" data-patient_id="{{ base64_encode($pat_id) }}" data-doctor_id="{{ $logged_dr_id }}">
                                        <a class="valign-wrapper received-message message-read" href="javascript:void(0);">
                                            <div class="image-avtar left"><img src="{{ $profile_images }}" alt="" class="circle" /></div>
                                            <div class="doc-detail truncate"><span class="title ">{{ $pat_title.' '.$pat_first.' '.$pat_last }}</span></div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>

                                @endforeach
                            @else
                                <li class="collection-item avatar">
                                    <a class="valign-wrapper received-message message-read" href="javascript:void(0);">
                                        <div class="truncate"><span class="title ">No Patients to Show</span></div>
                                        <div class="clearfix"></div>
                                    </a>
                                </li>
                            @endif
                        </ul> -->
                    <div class="whit-transparent-block"></div>
                </div>

                <div id="hide_messages" class="dashboard_one message-chat-box all-messages-page select-message-option" >
                    <div class="close-btn-block">
                        <a href="#" class="grey-text"><i class="fa fa-long-arrow-left"></i> Back</a>
                    </div>
                    <div >
                        <div class="valign-wrapper center-align center-msg">

                                <span class="message-no">
                                    
                                    <img src="{{ url('/') }}/public/doctor_section/images/patient-no-message.png" />
                                    <span>Select Any Patient to start your chat</span> 
                                </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="dashboard_one message-chat-box all-messages-page" id="show_messages" style="display:none">
                </div>
            </div>
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
    <!--  Scripts-->
    <script>
        $(document).ready(function(){
            $(".valign-wrapper").on("click", function () {
                $(this).parent(".collection-item").parent(".collection").parent(".user-message-left-bar").parent(".row").addClass("active");
            });
            $(".close-btn-block").on("click", function () {
                $(this).parent(".dashboard_one").parent(".row").removeClass("active");
            });
            $(".search-btn-content").on("click", function () {
                $(this).toggleClass("active");
                $(".search-hide-block").slideToggle("slow");
            });

            $('.get_patient').click(function(){
                var patient_id = $(this).data("patient_id");
                var token = $('input[name="_token"]').val();
                
                $('.message-no').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ');
                $('#get_dynamic_msg').html('<center><i style="margin-top:25%" class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>');

                $.ajax({
                    url: '{{ url("/") }}/doctor/patients/chats/get/'+patient_id,
                    type: 'POST',
                    //dataType: 'json',
                    data: {
                        _token: token,
                         patient_id: patient_id,
                    },
                    success: function (res) {
                        $('#hide_messages').hide();
                        $('#show_messages').show();
                        $('#show_messages').html(res);
                        $('#get_dynamic_msg').scrollTop($('#get_dynamic_msg')[0].scrollHeight)
                        
                        setTimeout(function(){
                          setInterval('get_messages()',3000);
                        },500);
                    }
                });

            });
        });
        function get_messages()
        {
          var patient_user_id    = $('#patient_id').val();
          var profile_img        = $('#user_profile_img').val();
          var token              = "<?php echo csrf_token(); ?>";
          var url                = "{{ url('/') }}/doctor/patients/chats/get/messages";

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
                $('#get_dynamic_msg').html(res);
                //$('#get_dynamic_msg').scrollTop($('#get_dynamic_msg')[0].scrollHeight)
              }
            });
          }
        }
        function sendMessageTopatient()
        {
              var url               = "{{ url('/') }}/doctor/patients/chats/send/message";
              var message           = $('#message').val();
              var patient_user_id   = $('#patient_id').val();
              var profile_img       =  $('#user_profile_img').val();
              var token             = $('input[name="_token"]').val();
              var data              = new FormData();
              data.append('message',message);
              data.append('patient_id',patient_user_id);
              data.append('profile_img',profile_img);
              data.append('_token', token);

               if(message!='')
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
                       $('.send_spinner').show();
                       $('.send_button').hide();
                     },
                     success: function(res)   
                     {
                        $('.send_spinner').hide();
                        $('.send_button').show();
                        $('#message').val('');
                        $('#get_dynamic_msg').append(res);
                        $('#get_dynamic_msg').scrollTop($('#get_dynamic_msg')[0].scrollHeight)
                     
                     }
                  });
               }
               else
               {
                  return false;
               }
        }
    </script>
@endsection