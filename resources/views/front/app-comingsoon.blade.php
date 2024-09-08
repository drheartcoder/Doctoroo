<!--login popup start here-->
<div id="app-comingsoon" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
	
		<!-- Modal content-->
		<div class="modal-content logincont" style="background:#071e30 !important;border: solid 2px #ffffff;">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal" style="color:#ffffff;">
				<span style="font-size:12px;">X</span>
				</button>
			</div>
			<div class="modal-body bdy-pading">
				<!--error msg-->
					<form name="frm_login" id="frm_login" action="{{ url('/') }}/patient/signin_check" method="post">
					{{ csrf_field() }}
						<div class="login_box">
							<div class="title_login" style="color:#ffffff;">DoctorOO</div>
							<div class="">
			                     <div class="footer-app-imgs">
			                        <a href="#app-comingsoon" data-toggle="modal"> <img src="{{ url('/') }}/public/images/appstor.png" alt="App Store"/></a>
			                        <a href="#app-comingsoon" data-toggle="modal"> <img src="{{ url('/') }}/public/images/google-play.png" alt="Google Play Store"/></a>
			                       
			                     </div>
			                  </div>
							<div class="tag-txt" style="color:#ffffff;">Coming soon...</div>
							
							<div class="clearfix"></div>
						
							<div class="clearfix">
							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
<script>

$(document).ready(function(){
   $('#patient_signin').click(function(){ 
   
   var password_login  =  $('#password_login').val();
   var email_login      =  $('#email_login').val();
   var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   
   if($.trim(email_login)=='')
   {
      $('#err_email_login').show();
      $('#email_login').focus();
      $('#err_email_login').html('Please enter email id.');
      $('#err_email_login').fadeOut(4000);
      return false;  
   }
   else if(!pemail_filter.test(email_login))
   {
      $('#err_email_login').show();
      $('#email_login').focus();
      $('#err_email_login').html('Please enter valid email id.');
      $('#err_email_login').fadeOut(4000);
      return false;  
   }
   else if($.trim(password_login)=='')
   {
      $('#err_password_login').show();
      $('#password_login').focus();
      $('#err_password_login').html('Please enter Password.');
      $('#err_password_login').fadeOut(4000);
      return false;  
   }
   else if($.trim(password_login).length<6)
   {
      $('#err_password_login').show();
      $('#password_login').focus();
      $('#err_password_login').html('Please enter Password more than 6 characters.');
      $('#err_password_login').fadeOut(4000);
      return false;  
   }
   else
   {
      return true;
   }
  });
});
</script>