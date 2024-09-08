<div id="appoinment-create-modal" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
         </div>

         <div class="modal-body bdy-pading"> 
            <form  action="{{ url('/') }}/doctor/appointment/create" method="post" id="frm_create_appoinment" name="frm_create_appoinment">
               {{ csrf_field() }}
               <div class="login_box">
                  <div class="title_login">Create Appointment</div>
                  <div class="forget-txt">
                  </div>
                  <div class="user_box">
                      <input type="text" name="patient_name" data-rule-required="true" class="input_acct-logn signp" id="patient_name" placeholder="Enter Patient Name" />
                  </div>
                  <input type="hidden" name="start_time" id="start_time">
                  <input type="hidden" name="end_time" id="end_time">

                  <div class="user_box">
                        <div class="select-style pharma-step-drp">

                           <select class="frm-select" id="time_slot"  data-rule-required="true" name="time_slot">
                                <option value="">Select Time Slot</option>
                                <option value="15">15 Min</option>
                                <option value="30">30 Min</option>
                                <option value="60">1 Hour</option>
                            
                           </select>
                        </div>
                  </div>
                 
                  <div class="clearfix"></div>
                        <div class="login-bts"> 
                           <button class="btn btn-search-login" onclick="javascript:return validateAppoinment()"  name="btn_appoinment" id="btn_appoinment" style="">Create Appointment</button>
                        </div>
                  <div class="clearfix"></div>
               </div>
            </form>
         </div>


      </div>
   </div>
</div>


<script>
      
   function validateAppoinment()
   {
            var validator = $("#frm_create_appoinment").validate({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                   error.insertAfter(element);
            },

            messages: {
              patient_name: "Enter patient name.",
              time_slot   : "Enter time slot.",

            }
          }); 

          if($("#frm_create_appoinment").valid() == true)
          {
               $('#frm_create_appoinment').submit();

          }
          else
          {
            return false;
          }
   }
   


</script>