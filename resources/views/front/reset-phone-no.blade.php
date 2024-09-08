

<!--login popup start here-->
<div id="reset-phone-no" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
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
						<div class="title_login">Having trouble logging in? 

                        </div>
						<div class="tag-txt">In order to reset your phone number, we need to verify your identity. Please provide as much information as you can to the below answers. Leave blanks for any questions you're not sure about. It may take upto 3 business days to process your request.</div>
						<div class="user_box">
		                  <input type="text" class="input_acct-logn" placeholder="First Name" name="cpnfirst_name" id="cpnfirst_name" />
		                  <div class="err" id="err_cpnfirst_name" style="display:none;"></div>
		                </div>
		                

		                <div class="user_box">
		                  <input type="text" class="input_acct-logn" placeholder="Last Name" name="cpnlast_name" id="cpnlast_name" />
		                  <div class="err" id="err_cpnlast_name" style="display:none;"></div>
		                </div>
						<div class="user_box">
							<input type="text" class="input_acct-logn" placeholder="Registered Email id" name="old_ph_no" id="old_ph_no"  value="" >
							<div class="err" id="err_old_ph_no"></div>
						</div>
                       
                        <div class="clearfix"></div> 
                        <div class="row">
							<div class="user_box">
								<div class="user_box col-sm-4" style="padding-right: 0px;">
				                     <!-- <input type="text" class="input_acct-logn" placeholder="Code" name="vmob_code" id="vmob_code" /> -->
				                     <div class="select-style pharma-step-drp">
				                     <select class="input_acct-logn" name="cpnmob_code" id="cpnmob_code">
				                        <option value="">Code</option>
				                        @if(!empty($mobcode_data) && isset($mobcode_data))
				                           @foreach($mobcode_data as $mobcode)
				                              <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == '13') selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
				                           @endforeach
				                        @endif
				                     </select>
				                     <div class="err" id="err_cpnmob_code" style="display:none;"></div>
				                     </div>
				                  </div>
				                  <div class="user_box col-sm-8">
									<input type="text" class="input_acct-logn" placeholder="New Phone Number" name="new_ph_no" id="new_ph_no"  value="" maxlength="12" >
									<div class="err" id="err_new_ph_no"></div>
							      </div>
							</div>
						</div>

						
                        <div class="user_box">
		                  <input type="date" class="input_acct-logn datepicker" placeholder="Date of Birth" name="cpndob" id="cpndob" />
		                  <div class="err" id="err_cpndob" style="display:none;"></div>
		                </div>

                        <div class="clearfix"></div>
                        <div class="user_box">
		                     <input type="text" class="input_acct-logn" placeholder="Address" name="cpnstate" id="cpnstate" />
		                     <div class="err" id="err_cpnstate" style="display:none;"></div>
		                </div>

		                <div class="clearfix"></div>
                        <div class="user_box">
		                  <input type="date" class="input_acct-logn datepicker" placeholder="When was your last online consultation ?" name="last_consultation" id="last_consultation" />
		                  <div class="err" id="err_last_consultation" style="display:none;"></div>
		                </div>

		                <div class="clearfix"></div>
                        <div class="user_box">
                        	<textarea rows="4" class="input_acct-logn" cols="50" placeholder="Additional notes" id="additinal_notes" name="additinal_notes"></textarea>
		                    <div class="err" id="err_additinal_notes" style="display:none;"></div>
		                </div>
						
						
						<div class="clearfix"></div>
							<div class="login-bts">
					 			<button  class="btn btn-search-login border-btn-radius"  type="button" id="btn_change_phno" > Submit  </button>
					 		</div>
					 		<div class="login-bts">
					 			<button  class="btn btn-search-login border-btn-radius"  type="button" id="btn_cpngoback" >   Go Back </button>
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
<input type="hidden" id="cpnotp_id" name="cpnotp_id">
<input type="hidden" id="cpnuser_id" name="cpnuser_id">
<input type="hidden" id="cpnnew_mobile_no" name="cpnnew_mobile_no">
<input type="hidden" id="cpnnew_mobile_no_code" name="cpnnew_mobile_no_code">


@include('front.patient.change_ph_no_otp')


<?php 
if(\Request::segment(1)=='doctor'){ ?>
	<input type="hidden" id="slug" name="slug" value="doctor">
<?php } else { ?>
    <input type="hidden" id="slug" name="slug" value="patient">
<?php } ?>


<script>
$(document).ready(function(){
		$('#btn_change_phno').click(function()
		{
			var vemail_filter 		= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var alpha               =  /^[a-zA-Z]*$/;
			var mobile_filter       =  /^[0-9]*$/;
            var cpnfirst_name       =  $('#cpnfirst_name').val();
            var cpnlast_name        =  $('#cpnlast_name').val();
            var old_ph_no           =  $('#old_ph_no').val();
            var new_ph_no           =  $('#new_ph_no').val();
            var cpndob 		        =  $('#cpndob').val();
            var cpnstate            =  $('#cpnstate').val();
            var last_consultation 	=  $('#last_consultation').val();
            var additinal_notes     =  $('#additinal_notes').val();
            var cpnmob_code         =  $('#cpnmob_code').val();

			if($.trim(cpnfirst_name)=='')
			{
				$('#err_cpnfirst_name').show();
				$('#cpnfirst_name').focus();
				$('#err_cpnfirst_name').html('Please enter first name.');
				$('#err_cpnfirst_name').fadeOut(4000);
				return false;
			}  
			else if(!alpha.test(cpnfirst_name))
			{
				$('#err_cpnfirst_name').show();
				$('#cpnfirst_name').focus();
				$('#err_cpnfirst_name').html('Please enter valid first name.');
				$('#err_cpnfirst_name').fadeOut(4000);
				return false;
			}   
			else if($.trim(cpnlast_name)=='')
			{
				$('#err_cpnlast_name').show();
				$('#cpnlast_name').focus();
				$('#err_cpnlast_name').html('Please enter last name.');
				$('#err_cpnlast_name').fadeOut(4000);
				return false;  
			}
			else if(!alpha.test(cpnlast_name))
			{
				$('#err_cpnlast_name').show();
				$('#cpnlast_name').focus();
				$('#err_cpnlast_name').html('Please enter valid last name.');
				$('#err_cpnlast_name').fadeOut(4000);
				return false;  
			}
			else if($.trim(old_ph_no)=='')
			{
				$('#err_old_ph_no').show();
				$('#old_ph_no').focus();
				$('#err_old_ph_no').html('Please enter email id.');
				$('#err_old_ph_no').fadeOut(4000);
				return false;  
			}
			else if(!vemail_filter.test(old_ph_no))
			{
				$('#err_old_ph_no').show();
				$('#old_ph_no').focus();
				$('#err_old_ph_no').html('Please enter vaild email id.');
				$('#err_old_ph_no').fadeOut(4000);
				return false;  
			}
			else if($.trim(cpnmob_code)=='')
			{
				$('#err_cpnmob_code').show();
				$('#cpnmob_code').focus();
				$('#err_cpnmob_code').html('Please select code.');
				$('#err_cpnmob_code').fadeOut(4000);
				return false;  
			}
			else if($.trim(new_ph_no)=='')
			{
				$('#err_new_ph_no').show();
				$('#new_ph_no').focus();
				$('#err_new_ph_no').html('Please enter mobile number.');
				$('#err_new_ph_no').fadeOut(4000);
				return false;  
			}
			else if(!mobile_filter.test(new_ph_no))
			{
				$('#err_new_ph_no').show();
				$('#new_ph_no').focus();
				$('#err_new_ph_no').html('Please enter only numbers.');
				$('#err_new_ph_no').fadeOut(4000);
				return false;  
			}
			else if($.trim(cpndob)=='')
			{
				$('#err_cpndob').show();
				$('#cpndob').focus();
				$('#err_cpndob').html('Please Select Date of Birth.');
				$('#err_cpndob').fadeOut(4000);
				return false;  
			}
			else if($.trim(cpnstate)=='')
			{
				$('#err_cpnstate').show();
				$('#cpnstate').focus();
				$('#err_cpnstate').html('Please enter Suburb');
				$('#err_cpnstate').fadeOut(4000);
				return false;  
			}
			else
            {
            	showProcessingOverlay();
            	var token = $('input[name="_token"]').val();

            	var slug  = $('#slug').val();
	        	if(slug=='doctor'){
	        		var url = "{{ url('/') }}/doctor/change_mobile_no/store";
	        	}else{
	        		var url = "{{ url('/') }}/patient/change_mobile_no/store";
	        	}

            	
            	$.ajax({
	               url:url,
	               type:'get',
	               dataType:'json',
	               data:{   _token:token,
							cpnfirst_name:cpnfirst_name,
							cpnlast_name:cpnlast_name,
							old_ph_no:old_ph_no,
							new_ph_no:new_ph_no,
							cpndob:cpndob,
							cpnstate:cpnstate,
							last_consultation:last_consultation,
							additinal_notes:additinal_notes,
							cpnmob_code:cpnmob_code,
	               },
	               success:function(res){
                      hideProcessingOverlay();
	               	  if(res.status=='success'){
	               	    $('#cpnotp_id').val(res.otp_id);
                        $('#cpnuser_id').val(res.cpnuser_id);
                        $('#cpnnew_mobile_no').val(res.cpnnew_mobile_no);
                        $('cpnnew_mobile_no_code').val(cpnmob_code);
	               	    $('#cpnverify_otp').modal('show');
	               	  }
	               	  else{

                        sweetAlert(res.msg);
                        $('#cpnotp_id').val('');
	               	  }
	               }
	            });
            }
 		});
		$('#old_ph_no').on('blur',function(){
			
		    $('#err_old_ph_no').html('');
		    var old_ph_no   =  $(this).val();

            var slug  = $('#slug').val();
        	if(slug=='doctor'){
        		var url = "{{ url('/') }}/doctor/duplicate/email";
        	}else{
        		var url = "{{ url('/') }}/patient/duplicate/email";
        	} 

        	$('#btn_change_phno').attr('disabled',true);

		    if($.trim(old_ph_no)!='')
		    {
		       var token = $('input[name="_token"]').val();
		       $.ajax({
		             url     : url,
		             type    : "get",
		             dataType:'json',
		             data: {_token:token,email_id:old_ph_no},
		             success : function(res){
		                if($.trim(res)=='success')
		                {
		                   $('#err_old_ph_no').show();
		                   $('#err_old_ph_no').html('your email id does not exists');
		                   $('#btn_change_phno').attr('disabled',true);
		                   return false; 
		                }
		                else if($.trim(res)=='error')
		                {
		                   $('#err_old_ph_no').show();
		                   $('#btn_change_phno').attr('disabled',false);
		                   return true;
		                }
		                else
		                {
		                   $('#old_ph_no').focus();
		                   $('#err_old_ph_no').html('Something went to wrong please try again later.');
		                   $('#btn_change_phno').attr('disabled',true);
		                   return false;
		                }
		             }
		       });
		    }
		});


        /*$('#new_ph_no').on('blur',function(){

            $('#err_new_ph_no').html('');
            var new_ph_no   =  $(this).val();

            var slug  = $('#slug').val();
        	if(slug=='doctor'){
        		var url = "{{ url('/') }}/doctor/duplicate/mobile_no";
        	}else{
        		var url = "{{ url('/') }}/patient/duplicate/mobile_no";
        	}

        	$('#btn_change_phno').attr('disabled',false);

            if($.trim(new_ph_no)!='')
            {
               var token = $('input[name="_token"]').val();

               $.ajax({
                     url   : url,
                     type : "get",
                     dataType:'json',
                     data: {_token:token,mobile_no:new_ph_no},
                     success : function(res){
                        if($.trim(res.status)=='error')
                        {
                           $('#err_new_ph_no').show();
                           $('#err_new_ph_no').html(res.msg);
                           $('#btn_change_phno').attr('disabled',true);
                           return false; 
                        }
                        else if($.trim(res.status)=='success')
                        {
                           $('#err_new_ph_no').show();
                           $('#btn_change_phno').attr('disabled',false);
                           return true;
                        }
                        else
                        {
                           $('#new_ph_no').focus();
                           $('#err_new_ph_no').html('Something went to wrong please try again later.');
                           return false;
                        }
                     }
               });
            }
      });*/
     
});
</script>

<!-- @include('google_api.google') -->
<script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
<script>
  $(document).ready(function(){
    var location = "Australia";
    $("#cpnstate").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
    });
  });
</script>

<!--  Scripts-->
<script src="{{ url('/') }}/public/new/js/picker.js"></script>
<script src="{{ url('/') }}/public/new/js/picker.date.js"></script>

<script>
$( '.datepicker' ).pickadate({
  labelMonthNext: 'Go to the next month',
  labelMonthPrev: 'Go to the previous month',
  labelMonthSelect: 'Pick a month from the dropdown',
  labelYearSelect: 'Pick a year from the dropdown',
  selectMonths: true,
  selectYears: true,
  format: 'dd/mm/yyyy',
  formatSubmit: 'yyyy-mm-dd',
  defaultValue: false,
  selectYears: 150,
  max: new Date(),
  onOpen: function() {
    console.log( 'Opened')
  },
  onClose: function() {
    console.log( 'Closed ' + this.$node.val() )
    var selected_date = this.$node.val();

    var today = new Date();
	   var curr_date = today.getDate();
	   var curr_month = today.getMonth() + 1;
	   var curr_year = today.getFullYear();

	   var pieces = selected_date.split('/');
	   var birth_date = pieces[0];
	   var birth_month = pieces[1];
	   var birth_year = pieces[2];

	   if (curr_month == birth_month && curr_date >= birth_date) var age = parseInt(curr_year-birth_year);
	   if (curr_month == birth_month && curr_date < birth_date) var age = parseInt(curr_year-birth_year-1);
	   if (curr_month > birth_month) var age = parseInt(curr_year-birth_year);
	   if (curr_month < birth_month) var age = parseInt(curr_year-birth_year-1);

  },
  onSelect: function() {
    console.log( 'Selected: ' + this.$node.val() )
  },
  onStart: function() {
    console.log( 'Hello there :)' )
  }
});

$('#btn_cpngoback').click(function(){
	/*$('input').val('');
	$('select').val('');*/
	$("#login").modal('show');
});

</script>
