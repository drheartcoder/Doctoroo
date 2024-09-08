<!--login popup start here-->
<div id="verify_otp" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
				<img src="{{ url('/') }}/public/images/close-popup.png" alt="">
				</button>
			</div>

			<div class="modal-body bdy-pading">
			    <br/>
			    <div class="alert-box alert_error alert-dismissible" id="patient_otp_error_msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>

                <div class="alert-box success alert-dismissible" id="patient_otp_success_msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>
				<form>
					<div class="login_box">
						<div class="title_login">Enter Your Security Code</div>
						<div class="tag-txt">Please check your registered phone number for an SMS security code & enter it below to login</div>
						<div class="user_box">
							<input type="text" class="input_acct-logn" placeholder="Enter SMS security code" name="otp" id="otp"  value="" maxlength="6" autofocus>
							<div class="err"></div>
						</div>
						
						<div class="clearfix"></div>
						<div class="login-bts">
							<button class="btn btn-search-login border-btn-radius" value="" type="button" id="btn_verify_otp" >Sign-in to My Account</button>
						</div>

						<div class="already-txt">
		                   Didn't recieve a code? <a data-toggle="modal" href="" id="btn_resend_otp">Try again</a>
		                   <br/>
		                   Or, <a data-toggle="modal" href="#reset-phone-no" id="btn_reset_phone_no">Reset your phone number</a>
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

	$('#btn_verify_otp').click(function(){
		var _token = "<?php echo csrf_token(); ?>";
		var otp =$('#otp').val();
		otp_id	   = $('#otp_id').val();
		password   = $('#password').val();
		email      = $('#email').val();

		if($('#otp').val()== '' || $('#otp').val() == null)
		{
			$('.err').show();
			$('.err').html("Please enter OTP that is sent on your registered mobile no.");
			$('.err').fadeOut(6000);
			return false;
		}
		else if($('#otp').val().length != 6)
		{
			$('.err').show();
			$('.err').html("Invalid OTP, Must have 6 digits");
			$('.err').fadeOut(4000);
			return false;
		}

		$('#btn_verify_otp').attr('disabled',true);

		$.ajax({
			url:url+'/patient/verify_otp',
			type:'get',
			data:{
					otp:otp,
					otp_id:otp_id,
					email:email,
					password:password,
					_token:_token
				 },
			success:function(res){
	         	if(res.status=="success")
	            { 
	            	if(res.msg=='')
	            	{
	                 	window.location.href = "{{ url('/') }}/patient/dashboard";
	            	}
	            	else
	            	{
	            		$('#patient_otp_success_msg').fadeIn(0, function()
			            {
			                $('#patient_otp_success_msg').html(res.msg);
			            }).delay(6000).fadeOut('slow');
			            $('#btn_verify_otp').attr('disabled',true);
	            	}
	            }
	            else if(res.status=="error" && res.msg!='')
	            {
	        		$('#patient_otp_error_msg').fadeIn(0, function()
		            {
		              $('#patient_otp_error_msg').css('display', 'block');
		              $('#patient_otp_error_msg').html(res.msg);
		            }).delay(6000).fadeOut('slow');
		            $('#btn_verify_otp').attr('disabled',false);
	            }
			}
		});
	});

	$('#btn_resend_otp').click(function(){
		var otp =$('#otp').val();
		var email = $('#email').val();

		$('#btn_resend_otp').attr('disabled',true);

		$.ajax({
			url:url+'/patient/resend_otp',
			type:'get',
			data:{otp:otp,email:email},
			success:function(data){
				$('#otp_id').val(data.otp_id);
				$('#patient_otp_success_msg').fadeIn(0, function()
	            {
	                $('#patient_otp_success_msg').css('display', 'block');
	                $('#patient_otp_success_msg').html(data.msg);
	            }).delay(6000).fadeOut('slow');

	            $('#btn_resend_otp').attr('disabled',false);
			}
		});
	});

	$('#otp').keypress(function(e){
		
		if(e.keyCode == '13')
		{
			e.preventDefault();
			$('#btn_verify_otp').click();
		}
	});
});
   
</script>