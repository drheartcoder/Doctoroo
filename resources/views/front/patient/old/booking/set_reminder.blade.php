     
@if(isset($arr_upcoming_booking['data']) && sizeof($arr_upcoming_booking['data'])>0)

    @foreach($arr_upcoming_booking['data'] as $key=>$booking)

      <div id="set-reminder-{{ $booking['id'] }}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content logincont">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
               </div>

           <form action="{{ $module_url_path }}/create_reminder" method="post" id="frm_reminder">
           {{ csrf_field() }}


            <input type="hidden" name="booking_id" id="booking_id" value="{{ isset($booking['id'])?$booking['id']:'' }}">
            <input type="hidden" name="doctor_user_id" id="doctor_user_id" value="{{ isset($booking['doctor_user_id'])?$booking['doctor_user_id']:'' }}">

           

           <div class="modal-body bdy-pading">
              <div class="login_box">
                     <div class="title_login">Reminder</div>

               {{--edit block for reminder--}}
                @if(isset($booking['reminder_info']) && sizeof($booking['reminder_info'])>0)
                  @foreach($booking['reminder_info'] as $reminder)

                  <div id="reminder_div_{{$reminder['id']}}">
                   <div class="user_box">
                     <div class="row">
                     <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">

                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
                          <div class="select-style pharma-step-drp fleft">
                             <select id="cd-dropdown" class="cd-select" name="existing_reminder_hour[{{ $reminder['id'] }}]">
                               {{-- <option value="" class="fa fa-bell">Select Hour</option> --}}
                                @for($i=1;$i<=60;$i++)
                                   <option value="{{ $i }}" @if(isset($reminder['reminder_hour']) && $reminder['reminder_hour']==$i) selected="" @endif  class="fa fa-bell">{{ $i }} Hour</option>
                                @endfor
                             </select>
                          </div>
                        </div>

                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
                          <div class="select-style pharma-step-drp fleft">
                             <select id="cd-dropdown" class="cd-select" name="existing_reminder_minute[{{ $reminder['id'] }}]">
                            {{--    <option value="" class="fa fa-bell">Select minute</option> --}}
                                   @for($i=1;$i<=60;$i++)
                                      <option @if(isset($reminder['reminder_minute']) && $reminder['reminder_minute']==$i) selected="" @endif  value="{{ $i }}" class="fa fa-bell">{{ $i }} Minute</option>
                                   @endfor 
                             </select>
                          </div>
                        </div>

                      </div>

                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                              <span class="close-reminder"> <a onclick="deleteReminder('{{ base64_encode($reminder['id']) }}','{{ $reminder['id'] }}')"><i class="fa fa-times"></i></a> </span>
                             </div>
                       <div class="clearfix"></div>

                    </div>
                  </div>
                </div>
                @endforeach

             @else

            {{--new block for reminder--}}
              <div id="reminder_div_0">
               <div class="user_box">
                  <div class="row">

                     <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">

                       <div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
                            <div class="select-style pharma-step-drp fleft">
                               <select id="cd-dropdown" class="cd-select" name="reminder_hour[]">
                                {{--  <option value="" class="fa fa-bell">Select Hour</option> --}}
                                  @for($i=1;$i<=60;$i++)
                                     <option value="{{ $i }}"  class="fa fa-bell">{{ $i }} Hour</option>
                                  @endfor
                               </select>
                            </div>
                       </div>
                       <div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
                            <div class="select-style pharma-step-drp fleft">
                               <select id="cd-dropdown" class="cd-select" name="reminder_minute[]">
                                {{--  <option value="" class="fa fa-bell">Select minute</option> --}}
                                     @for($i=1;$i<=60;$i++)
                                        <option  value="{{ $i }}" class="fa fa-bell">{{ $i }} Minute</option>
                                     @endfor 
                               </select>
                            </div>
                        </div>
                     </div>
                
                     <div class="clearfix"></div>
                  </div>
               </div>
              </div>

          @endif
              

               
                 <div id="appendReminder_{{ $booking['id'] }}"></div>

                 <div class="user_box">
                          <a onclick="addreminder('{{ $booking['id'] }}')" class="reminder-link"> <i class="fa fa-bell"></i>
                       Add Reminder</a>
                 </div>

               
                 <div class="clearfix"></div>
                 <div class="login-bts text-center">
                    <button class="details-btn select-btn" value="submit" type="submit">Save</button>
                 </div>
                 <div class="clearfix"></div>
            </div>
        </div>

            

              </form>
            </div>
         </div>
      </div>
      @endforeach
@endif
<script>
   function addreminder(id)
   {
              var index  = parseInt(Math.random() * (150-1) + 1);
              var html = '';

               html     += '<div id="reminder_div_'+index+'">'
               html     += '<div class="user_box"><div class="row">'
               html     += '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">'

               html     += '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">'
               html     += '<div class="select-style pharma-step-drp fleft">'
               html     += '<select id="cd-dropdown" class="cd-select" name="reminder_hour[]">'
                           for(var j=1;j<=60;j++){  
               html     +=  '<option value="'+j+'" class="fa fa-bell">'+j+' Hour</option>'
                            }

               html     +=  '<select></div></div>'
              
               html     += '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">'
               html     += '<div class="select-style pharma-step-drp fleft">'
               html     += '<select id="cd-dropdown" class="cd-select" name="reminder_minute[]">'
                          for(var k=1;k<=60;k++){  
               html     +=  '<option value="'+k+'" class="fa fa-bell">'+k+' Minute</option>'
                           }
               html     +=  '<select>'
               html     +=  '</div></div></div>'
               html     +=  '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">'
         
               html     +=  '<span class="close-reminder"><a onclick="removeReminder('+index+')"><i class="fa fa-times"></i></a></span></div><div class="clearfix"></div></div></div>'
                html     +=  '</div>';
              
               
               jQuery("#appendReminder_"+id).append(html);

               index    = Number(index) + Number(1);
               $('#reminder_index').val(index);

 
   }
   function removeReminder(ref)
   {  
        $('#reminder_div_'+ref).remove(); 
   }
   function deleteReminder(ref,id)
   {
         var url     = "{{ $module_url_path }}/delete_reminder/"+ref;
  
         $.ajax({
           url: url,
           type: 'GET',        
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
              console.log(res);
              $("#reminder_div_"+id).load(location.href+" #reminder_div>*","");
              
           }
      }); 
   }
   
</script>