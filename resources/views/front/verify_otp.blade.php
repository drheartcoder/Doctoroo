<!--login popup start here-->
<div id="verify_forget_password_otp" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
					<img src="{{ url('/') }}/public/images/close-popup.png" alt="Close">
				</button>
			</div>

			<div class="modal-body bdy-pading">
			    <br/>
	            <div class="alert-box alert_error alert-dismissible" id="forget_mob_error_msg" style="display: none;">
	               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	               <span style="font-size: 20px;">×</span></button> 	
	            </div>
			    <div class="alert-box alert_error alert-dismissible" id="forget_error_msg_mob_no" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>

                <div class="alert-box success alert-dismissible forget_success_msg" id="forget_success_msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>
				<form>
					<div class="login_box">
						<div class="title_login">Enter Your Security Code</div>
						<div class="tag-txt">Please check your registered phone number for an SMS security code & enter it below to login</div>
						<div class="user_box">
							<input type="text" class="input_acct-logn" placeholder="Enter OTP" name="forget_password_otp" id="forget_password_otp"  value="" maxlength="6" autofocus>
							<div class="err" ></div>
						</div>
						<div class="clearfix"></div>
						<div class="login-bts">
							<button class="btn btn-search-login border-btn-radius" value="" type="button" id="btn_verify_forget_password_otp" >Verify OTP</button>
						</div>
						<div class="already-txt">
		                   Didn't get OTP ? <a data-toggle="modal" href="" id="btn_resend_forget_password_otp">Resend</a>
		                </div>
						<div class="main-social text-center">
							<br/>
							<br/>
						<div class="clearfix"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
var url = "<?php echo url(''); ?>";
$(document).ready(function(){

	$('#btn_verify_forget_password_otp').click(function(){
		var _token = "<?php echo csrf_token(); ?>";
		var otp    = $('#forget_password_otp').val();
		otp_id	   = $('#otp_id').val();
		email      = $('#email').val();

		if($('#forget_password_otp').val()== '' || $('#forget_password_otp').val() == null)
		{
			$('.err').show();
			$('.err').html("Please enter OTP that is sent on your registered mobile no.");
			$('.err').fadeOut(6000);
			return false;
		}
		else if($('#forget_password_otp').val().length != 6)
		{
			$('.err').show();
			$('.err').html("Invalid OTP, Must have 6 digits");
			$('.err').fadeOut(4000);
			return false;
		}

		showProcessingOverlay();
		
		$.ajax({
			url:url+'/forgotpassword/verify_otp',
			type:'get',
			data:{
					otp:otp,
					otp_id:otp_id,
					email:email,
					_token:_token
				 },
			success:function(res){
							
				hideProcessingOverlay();
	         	if(res.status=="success")
	            { 
	            	if(res.msg=='' && res.id !='')
	            	{
	                 	window.location.href = "{{url('/').'/resetpassword'}}/"+res.id;    
	            	}
	            	else
	            	{
	            		$('#forget_error_msg_mob_no').fadeIn(0, function()
			            {
			                $('#forget_error_msg_mob_no').html(res.msg);
			            }).delay(6000).fadeOut('slow');
	            	}
	            }
	            else if(res.status=="error" && res.msg!='')
	            {
	        		$('#forget_error_msg_mob_no').fadeIn(0, function()
		            {
		                $('#forget_error_msg_mob_no').html(res.msg);
		            }).delay(6000).fadeOut('slow');
	            }
	            else if(res.status=="error" && res.otp_id =='0')
	            {
	        		$('#forget_mob_error_msg').fadeIn(0, function()
		            {
		                $('#forget_mob_error_msg').html(res.msg);
		            }).delay(6000).fadeOut('slow');
	            }
	            else if(res.status=="no_membership")
	            { 
	            	if(res.msg=='')
	            	{
	                 	window.location.href = "{{url('/').'/doctor'}}/membership/premium";    
	            	}
	            	else
	            	{
	            		$('#forget_error_msg_mob_no').fadeIn(0, function()
			            {
			                $('#forget_error_msg_mob_no').html(res.msg);
			            }).delay(6000).fadeOut('slow');
	            	}
	            }

			}
		});
	});

	$('#btn_resend_forget_password_otp').click(function(){
		var otp =$('#otp').val();
		var email = $('#email').val();
		$.ajax({
			url:url+'/forgotpassword/resend_otp',
			type:'get',
			data:{otp:otp,email:email},
			success:function(data){
				$('#otp_id').val(data.otp_id);
				if(data.status == 'success')
				{
					$('.forget_success_msg')
					$('.forget_success_msg').fadeIn(0, function()
		            {
		                $('.forget_success_msg').html(data.msg);
		            }).delay(6000).fadeOut('slow');	
				}
				else if(data.status =='error')
				{
					$('#forget_mob_error_msg').fadeIn(0, function()
		            {
		                $('#forget_mob_error_msg').html(data.msg);
		            }).delay(6000).fadeOut('slow');
				}
				
			}
		});
	});

	$('#forget_password_otp').keypress(function(e){
		
		if(e.keyCode == '13')
		{
			e.preventDefault();
			$('#btn_verify_forget_password_otp').click();
		}
	});
	
});
   
</script>