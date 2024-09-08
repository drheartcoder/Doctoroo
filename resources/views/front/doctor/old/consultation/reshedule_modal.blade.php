{{--modal for assign anathor time--}}

<!--login popup start here-->
<div id="offer-time-modal" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
  <div class="modal-dialog loign-insw">
    <!-- Modal content-->
    <div class="modal-content logincont">
         <div class="modal-header head-loibg">
              <button type="button" class="login_close close" data-dismiss="modal">
              <img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
              </button>
         </div>
      <div class="modal-body bdy-pading">
        
               <br/>
              <div class="alert-box success alert alert-warning alert-dismissible" id="response_success_msg" style="display: none;">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span style="font-size: 20px;">×</span></button>
              </div>

               <div class="alert-box alert_error alert-dismissible" id="res_err_msg" style="display: none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span style="font-size: 20px;">×</span></button>   
               </div>
          
            <div class="login_box text-center">
               <div class="title_login"></div>
         
                  <?php
                     $consult_time =  convert_24_to_12($arr_booking_details['consultation_time']);
                  ?>
   
                     <div class="doc-head avle-doc">
                        Available Time:
                     </div>
                     <div class="inner-cont" style="height:400px;overflow:scroll;">
                       <div class="currnt-booked">
                        <div class="doc-rw">
                           <div class="doc-det">
                              <div class="doc-pro">
                              @if(isset($arr_booking_details['doctor_user_details']['profile_image']) && $arr_booking_details['doctor_user_details']['profile_image']!='' && file_exists($doctor_base_img_path.$arr_booking_details['doctor_user_details']['profile_image']))


                                 <img src="{{ $doctor_public_img_path.$arr_booking_details['doctor_user_details']['profile_image'] }}" alt="profile img"/>
                              @else

                                 <img src="{{ $doctor_public_img_path.'/default-image.jpeg' }}" alt="profile img"/>  

                              @endif
                              </div>
                              <div class="doc-nm">
                                 <span class="crrent-bked"> Currently Booked</span>
                                 {{ $arr_booking_details['doctor_user_details']['title'] or '' }}
                                 {{ $arr_booking_details['doctor_user_details']['first_name'] or '' }}
                                 {{ $arr_booking_details['doctor_user_details']['last_name'] or '' }}
                              </div>
                              <div class="see-doc-btn">
                                 <button class="view-time-btn" data-avail-time-target="11">
                                 View Times
                                 </button>

                              </div>

                              <div class="clearfix"></div>

                              <div class="see-doc-btn">
                                 Previous Booked Time:
                                 <button class="view-time-btn">
                                 {{ $consult_time or '' }}
                                 </button>

                              </div>
                              
                              <div class="clearfix"></div>
                             <div class="see-doc-btn">
                                 Previous Booked Date:
                                    
                                 {{ $consultation_date or '' }}
                              </div>

                               <div class="clearfix"></div>
                           </div>
                        </div>

                        <input type="hidden" name="time_slot" id="time_slot">
                        <input type="hidden" name="booking_date" id="booking_date">

                       @if(isset($arr_availble_time) && sizeof($arr_availble_time)>0) 
                         <div doctor-avail-time-section="11" class="doc-times-bx" style="display:none;">

                    
                           @foreach($arr_availble_time as $availble_time)

                              @if($availble_time['start_time']!='' && $availble_time['end_time']!='')


                               <?php
                                  $arr_time_slot = [];
                                  $start_time    = '';
                                  $start_time    = $availble_time['start_time'];
                                  
                                  $arr_time_slot    = create_booking_time_slots($availble_time['end_time']);

                 
                               ?>
                                <div class="day-txtt">
                                   @if(isset($availble_time['date']))
                                     <?php
                                       $day  = date('D',strtotime($availble_time['date']));
                                       $date = date('jS M Y',strtotime($availble_time['date']));
                                     ?>
                                   @endif
                                   {{ $day or '' }} {{ $date or '' }}
                                </div>

                                  @if(isset($arr_time_slot) && sizeof($arr_time_slot)>0)
                                    @foreach($arr_time_slot as $key=>$time_slot)
                                           
                                       
                                            <a onclick="setSelectedTime('{{$time_slot}}','{{ $availble_time['date'] }}','{{$key}}')" class="grn-time vlt_time_slot vlt_time_{{$key}}" >
                                            {{ $time_slot }}</a>
                                    
                                       

                                    @endforeach 
                                  @endif
                              @endif

                           @endforeach
                     
                            <div class="day-txtt">
                               <textarea cols="" rows="" name="message" id="message" data-rule-maxlength="255" placeholder="Please enter message " class="form-inputs" style="padding:10px;height:130px;margin:5px 0;"></textarea>
                               <div class="error" id="err_booking_msg"></div>
                            </div>
                            <div class="bk-bts">
                                                   
                                <button class="acc-btn" onclick="sendNotificationToPatient('{{ base64_encode($arr_booking_details['id']) }}','{{ base64_encode($arr_booking_details['patient_user_id']) }}')" >Submit</button>
                
                            </div>
                        </div>

                        @else
                        <div class="search-grey-bx">
                                <div class="row">
                                        {{ 'Currently no time is available.' }}
                                </div>
                        </div>
                       @endif     

                     </div>
                  </div>
                
            </div>

      
        </div>
      </div>
    </div>
</div> 
<script>
    
   function offerTimeToPatient()
   {

      var msg = "Do you want to offer other time to patient?";

         swal({
                

                  title: msg,
                  type: 'success',
                  showCancelButton: true,
                  allowOutsideClick: true,
                  html: true
                        
             },
             function(isConfirm)
             {
                   if(isConfirm)
                   {
                       $("#offer-time-modal").modal('show');  
                   }
            });


   }
    function setSelectedTime(time_slot,date,index)
   {
         
       $('.vlt_time_slot').not(this).each(function(){
             $(this).removeClass('book_time_slot');
             $(this).addClass('grn-time');
         
       });   
      
      $('.vlt_time_'+index).removeClass('grn-time');
      $('.vlt_time_'+index).addClass('book_time_slot');


      $('#time_slot').val(time_slot);
      $('#booking_date').val(date);

   }
   function sendNotificationToPatient(booking_id,patient_id)
   {
          $('#err_booking_msg').html('');
          var message      = $('#message').val();
          if(message=="")
          {
            $('#err_booking_msg').html('Please enter a message');
          }
          else
          {


                var url = '{{ $module_booking_path }}/offer_another_time';

                var token = $("input[name='_token']").val();    
             
                var data = new FormData();

                var booking_time = $('#time_slot').val();
                var booking_date = $('#booking_date').val();
               

                 data.append('booking_time',booking_time); 
                 data.append('booking_date',booking_date); 
                 data.append('booking_id',booking_id);
                 data.append('patient_id',patient_id);
                 data.append('message',message);  
                 data.append('_token',token);

                 $.ajax({
                      url : url,
                      type:'POST',        
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
                                   $('#response_success_msg').fadeIn(0, function()
                                   {
                                        $('#response_success_msg').html(res.msg);
                                       

                                   }).delay(2000).fadeOut('slow');  

                                   //window.location.href="{{ url('/') }}/send_notification/"+patient_id+'/'+message;
                           }
                           else if(res.status=="error")
                           {
                                  $('#res_err_msg').fadeIn(0, function()
                                   {
                                        $('#res_err_msg').html(res.msg);
                                      
                                   }).delay(2000).fadeOut('slow');  
                           }
                       } 
                 });   
          }

   }
  

</script>