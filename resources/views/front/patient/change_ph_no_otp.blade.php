<!--login popup start here-->
<div id="cpnverify_otp" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
	<div class="modal-dialog loign-insw">
		<div class="modal-content logincont">
			<div class="modal-header head-loibg">
				<button type="button" class="login_close close" data-dismiss="modal">
				<img src="{{ url('/') }}/public/images/close-popup.png" alt="">
				</button>
			</div>

			<div class="modal-body bdy-pading">
			    <br/>
			    <div class="alert-box alert_error alert-dismissible" id="patient_error_msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>

                <div class="alert-box success alert-dismissible patient_success_msg" id="patient_success_msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span style="font-size: 20px;">×</span></button> 	
                </div>
				<form>
					<div class="login_box">
						<div class="title_login">Enter Your Security Code</div>
						<div class="tag-txt">Please check your registered phone number for an SMS security code & enter it below to send change phone number request</div>
						<div class="user_box">
							<input type="text" class="input_acct-logn" placeholder="Enter SMS security code" name="cpnotp" id="cpnotp"  value="" maxlength="6" autofocus>
							<div class="err"></div>
						</div>
						
						<div class="clearfix"></div>
						<div class="login-bts">
							<button class="btn btn-search-login border-btn-radius" value="" type="button" id="btn_cpnverify_otp" >Send request</button>
						</div>

						<div class="already-txt">
		                   Didn't recieve a code? <a data-toggle="modal" href="" id="btn_resend_cpnotp">Try again</a>
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

	$('#btn_cpnverify_otp').click(function(){
		var _token = $('input[name="_token"]').val();
		var cpnotp            = $('#cpnotp').val();
		var cpnotp_id         = $('#cpnotp_id').val();
		var cpnuser_id        = $('#cpnuser_id').val();
		var cpnnew_mobile_no  = $('#cpnnew_mobile_no').val();



		var cpnfirst_name       =  $('#cpnfirst_name').val();
        var cpnlast_name        =  $('#cpnlast_name').val();
        var old_ph_no           =  $('#old_ph_no').val();
        var new_ph_no           =  $('#new_ph_no').val();
        var cpndob 		        =  $('#cpndob').val();
        var cpnstate            =  $('#cpnstate').val();
        var last_consultation 	=  $('#last_consultation').val();
        var additinal_notes     =  $('#additinal_notes').val();
        var cpnmob_code         =  $('#cpnmob_code').val();
        
      




        if(cpnotp_id== '' || cpnotp_id == null || cpnotp_id == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   
        if(cpnuser_id== '' || cpnuser_id == null || cpnuser_id == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   
        if(cpnnew_mobile_no== '' || cpnnew_mobile_no == null || cpnnew_mobile_no == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   

		if($('#cpnotp').val()== '' || $('#cpnotp').val() == null)
		{
			$('.err').show();
			$('.err').html("Please enter OTP that is sent on your registered mobile no.");
			$('.err').fadeOut(6000);
			return false;
		}
		else if($('#cpnotp').val().length != 6)
		{
			$('.err').show();
			$('.err').html("Invalid OTP, Must have 6 digits");
			$('.err').fadeOut(4000);
			return false;
		}

		showProcessingOverlay();


		var slug  = $('#slug').val();
    	if(slug=='doctor'){
    		var url = "{{ url('/') }}/doctor/verify_cpnotp";
    	}else{
    		var url = "{{ url('/') }}/patient/verify_cpnotp";
    	}
		$.ajax({
			url:url,
			type:'get',
			data:{
					cpnotp:cpnotp,
					cpnotp_id:cpnotp_id,
					cpnuser_id:cpnuser_id,
					cpnnew_mobile_no:cpnnew_mobile_no,
					_token:_token,

					cpnfirst_name:cpnfirst_name,
					cpnlast_name:cpnlast_name,
					old_ph_no:old_ph_no,
					new_ph_no:new_ph_no,
					cpndob:cpndob,
					cpnstate:cpnstate,

					last_consultation:last_consultation,
					additinal_notes:additinal_notes,
					cpnmob_code:cpnmob_code

				 },
			success:function(res){				
				hideProcessingOverlay();
	         	if(res.status=="success")
	            { 
	            	$('#cpnotp').val('');
					$('#cpnotp_id').val('');
					$('#cpnuser_id').val('');
					$('#cpnnew_mobile_no').val('');




                    $('#cpnfirst_name').val('');
                    $('#cpnlast_name').val('');
                    $('#old_ph_no').val('');
                    $('#new_ph_no').val('');
                    $('#cpndob').val('');
                    $('#cpnstate').val('');
                    $('#last_consultation').val('');
                    $('#additinal_notes').val('');
                    $('#cpnmob_code').val('');
                    



					$('#cpnverify_otp').modal('hide');
	            	sweetAlert(res.msg);
	            }
	            else if(res.status=="error" && res.msg!='')
	            {
	        		sweetAlert(res.msg);
	        		return false;
	            }
			}
		});
	});
	$('#btn_resend_cpnotp').click(function(){
        var _token = $('input[name="_token"]').val();
		var cpnotp            = $('#cpnotp').val();
		var cpnotp_id         = $('#cpnotp_id').val();
		var cpnuser_id        = $('#cpnuser_id').val();
		var cpnnew_mobile_no  = $('#cpnnew_mobile_no').val(); 
		var cpnnew_mobile_no_code  = $('#cpnnew_mobile_no_code').val(); 

		

        if(cpnotp_id== '' || cpnotp_id == null || cpnotp_id == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   
        if(cpnuser_id== '' || cpnuser_id == null || cpnuser_id == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   
        if(cpnnew_mobile_no== '' || cpnnew_mobile_no == null || cpnnew_mobile_no == 0)
        {
           sweetAlert('Something went wrong please try again later');
           return false;
        }   

        showProcessingOverlay();

        var slug  = $('#slug').val();
    	if(slug=='doctor'){
    		var url = "{{ url('/') }}/doctor/resend_cpnotp";
    	}else{
    		var url = "{{ url('/') }}/patient/resend_cpnotp";
    	}

    	
		$.ajax({
			url:url,
			type:'get',
			data:{_token:_token,
				   cpnotp:cpnotp,
				   cpnotp_id:cpnotp_id,
				   cpnuser_id:cpnuser_id,
				   cpnnew_mobile_no:cpnnew_mobile_no,
				   cpnnew_mobile_no_code:cpnnew_mobile_no_code
				   },
			success:function(data){
				hideProcessingOverlay();
	            if(data.status=="success")
	            { 
	            	$('#cpnotp_id').val(data.otp_id);
	                $('#cpnuser_id').val(data.cpnuser_id);
	                $('#cpnnew_mobile_no').val(data.cpnnew_mobile_no);
	                $('cpnnew_mobile_no_code').val(cpnnew_mobile_no_code);
	           	    $('#cpnverify_otp').modal('show');
	            	sweetAlert(data.msg);
	            }
	            else if(data.status=="error")
	            {
	        		sweetAlert(data.msg);
	        		return false;
	            }
			}
		});
	});
	$('#cpnotp').keypress(function(e){
		if(e.keyCode == '13')
		{
			e.preventDefault();
			$('#btn_cpnverify_otp').click();
		}
	});
});
   
</script>