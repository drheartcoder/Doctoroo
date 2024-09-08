<!--login popup start here-->
<div id="profile-modal" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
  <div class="modal-dialog loign-insw">
    <!-- Modal content-->
    <div class="modal-content logincont">
      <div class="modal-header head-loibg">
        <button type="button" class="login_close close" data-dismiss="modal">
        <img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
        </button>
      </div>
      <div class="modal-body bdy-pading">
        
          
          
            <div class="login_box text-center">
              <div class="title_login"></div>

                <span>
                     Would you like to book a doctor now?
                </span>
       
                     <div class="popup_btnns">
                        <div class="login-bts">
                              <button class="btn btn-search-login" onclick="redirectToDoctor()" value="Yes" id="submits" type="submit">Yes</button>
                              <button class="btn btn-search-login1" onclick="redirectToProfile()" value="No" id="submits" type="submit">No</button>
                           </div>
                     </div>
                
            </div>
        </div>
      </div>
    </div>
<script>
  function redirectToProfile()
  {
    $('#status_redirect').val('no');
    $('#frm_patient_profile').submit();
        showProcessingOverlay();
     $('#profile-modal').modal('hide');

  }
  function redirectToDoctor()
  {
     $('#status_redirect').val('yes');
     $('#frm_patient_profile').submit();
      showProcessingOverlay();

  }

</script>