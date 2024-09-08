@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align"></h1>
    </div>

	<!-- SideBar Section -->
	@include('front.doctor.layout._new_sidebar')

	<div class="mar300 has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>

            
        <div class="medi">
	        <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
	            <li class="tab truncate active">
	                <a href="#tools" class="active" id="redirect_certificate">Medication Certificate Generator</a>
	            </li>
	            <li class="tab truncate">
	                <a href="#other_file_upload" id="redirect_other_files">Referral, Pathology Request & Other Document Upload</a>
	            </li>
	        </ul>

	        <!--Tools tab starts here-->
		    <div id="tools" class="tab-content medi">
		        <div class="doctor-container">
		            <div class="head-medical-pres">
		                <h2 class="center-align">Medication Certificate Generator</h2>
		                <span class="posleft qusame rescahnge "><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
		            </div>
		            <div class="row">
		                <div class="col m6 s12">
		                    <div class="round-box z-depth-3">
		                        <div class="heading-round-box">Make Your Certificate here</div>
		                        <div class="green-border round-box-content edit-profile">
		                        <form method="POST" id="medical_certi_form" action="{{ url('/') }}/doctor/patients/tools/generate_medical_certificate/store">
		                        {{ csrf_field() }}
		                            <div class="input-field selct padnotop input-padding-25px">
		                                <select id="patient_id" name="patient_id">
		                                    <option value="">Select Patient</option>
		                                    @if(isset($user_data) && !empty($user_data))
		                                    	<option value="{{ $user_data['user_id'] }}" type="user">{{ $user_data['userinfo']['first_name'].' '.$user_data['userinfo']['last_name'] }}</option>
		                                    @endif
		                                    @if(isset($family_members_data) && !empty($family_members_data))
		                                    	@foreach($family_members_data as $family)
		                                    		<option value="{{ $family['id'] }}" type="family">{{ $family['first_name'].' '.$family['last_name'] }}</option>
		                                    	@endforeach
		                                    @endif
		                                </select>
		                                <div class="err" id="err_patient_details" style="display:none;"></div>
		                            </div>
		                            <input type="hidden" id="patient_type" name="patient_type" />
		                            <div class="row minus-margin">
		                            	
		                            	<div class="col s6 l6">
                                            <div class="input-field  text-bx lessmar  input-padding-25px">
	                            			<input type="text" id="start_date" name="start_date" class="validate datepicker">
			                            	<label for="start_date" class="grey-text truncate">Select from Date</label>
			                            	<div class="err" id="err_start_date" style="display:none;"></div>
                                            </div>
		                            	</div>
	                            	
	                            		<div class="col s6 l6">
                                            <div class="input-field  text-bx lessmar input-padding-25px">
		                            		<input type="text" id="end_date" name="end_date" class="validate datepicker">
			                            	<label for="end_date" class="grey-text truncate">Select to Date</label>
			                            	<div class="err" id="err_end_date" style="display:none;"></div>
                                            </div>
		                            	</div>
		                            	
		                            </div>
		                            <div class="input-field selct padnotop  input-padding-25px">
		                                <select id="activity" name="activity">
		                                    <option value="">Absent from</option>
		                                    <option value="Work">Work</option>
		                                    <option value="Study">Study</option>
		                                    <option value="Sport">Sport</option>
		                                    <option value="Other">Other</option>
		                                </select>
		                                <div class="err" id="err_activity" style="display:none;"></div>
		                            </div>
		                            <div class="input-field  text-bx lessmar  input-padding-25px">
		                                <input type="text" id="reason_for_absent" name="reason_for_absent" class="validate">
		                                <label for="reason_for_absent" class="grey-text truncate">Enter Reason (if Required)</label>
		                                <div class="err" id="err_reason_for_absent" style="display:none;"></div>
		                            </div>
		                            <div class="clr"></div>
		                            <button type="button" class="" id="btn_generate_medical_certificate" style="display:none;">Save</button>
		                        </form>
		                        </div>
		                        <div class="blue-border-block-bottom"></div>
		                    </div>
		                </div>
		                <div class="col m6 s12">

		                    <div class="round-box z-depth-3">
		                        <div class="heading-round-box">Or: Upload your own</div>
		                        <div class="green-border posrel round-box-content table center-align">
		                            <div class="table-row">
		                                <div class="table-cell">
		                                    <!-- icon with text to use -->
		                                    <div class="input-field ">
		                                        <div class="file-field input-field">
		                                            <div class="btn file-btn-new bluedoc-bg circle">
		                                                <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
		                                                <input type="file" multiple>
		                                            </div>
		                                            <div class="file-path-wrapper new-file-path">
		                                                <input class="file-path validate" type="text" placeholder="Upload a medical ceritificate">
		                                            </div>
		                                        </div>
		                                        <div class="clr"></div>
		                                    </div>
		                                    <!-- icon with text to use -->
		                                    <div class="btn-absolute">
		                                        <a class="btn bluedoc-bg round-corner  pos-abs-btn">Upload &amp; Save</a>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="blue-border-block-bottom"></div>
		                    </div>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col s12">
		                    <div class="head-medical-pres">
		                        <h2 class="center-align">Preview</h2>
		                    </div>
	                        <div class="clearfix"></div>
		                    <div class="round-box z-depth-3">
		                        <div class="blue-border-block-top"></div>
		                        <div class="round-box-content blue-border">
		                            <!--table for print/pdf starts here-->
		                            <div class="preview-table">
		                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 630px; font-size:14px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#333; text-align:justify;">
		                                    <tr>
		                                        <td>
		                                            <h1 style="margin:0; padding: 0; text-align: center; font-size: 33px; font-weight: bolder; font-family: 'Arial';">Medical Certificate</h1>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td>
		                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
		                                                <tr>
		                                                    <td style="text-align: left; padding:0 10px;">Dr. [Doctor's Full Name]</td>
		                                                </tr>
		                                                <tr>
		                                                    <td height="15px" style="padding:0 10px;"></td>
		                                                </tr>
		                                                <tr>
		                                                    <td align="left" style="text-align: left; padding:0 10px;"> Example Address
		                                                        <br> Example Address 2
		                                                        <br> Phone : (02) 98765 43210
		                                                        <br> Provider Number : (02) 988765 </td>
		                                                </tr>
		                                                <tr>
		                                                    <td height="15px" style="padding:0 10px;"></td>
		                                                </tr>
		                                                <tr>
		                                                    <td align="right" style="text-align: right;">Date: 24/04/2017</td>
		                                                </tr>
		                                                <tr>
		                                                    <td height="15px" style="padding:0 10px;"></td>
		                                                </tr>
		                                                <tr>
		                                                    <td style="text-align: left; padding:0 10px;">
		                                                        I, Dr [Doctor's Full Name], after careful examination on [todays date], hereby certify that [Patient's Name] is suffering from [condition - optional].
		                                                    </td>
		                                                </tr>
		                                                <tr>
		                                                    <td height="15px" style="padding:0 10px;"></td>
		                                                </tr>
		                                                <tr>
		                                                    <td style="text-align: left; padding:0 10px;">
		                                                        I consider that a period of absence from [activity - work, study, sport, other] during [date] to [date] [inclusive/exclusive] is absolutely necessary for the restoration of their health.
		                                                    </td>
		                                                </tr>

		                                                <tr>
		                                                    <td height="15px" style="padding:0 10px;"></td>
		                                                </tr>
		                                                <tr>
		                                                    <td style="text-align: left; padding:0 10px;">
		                                                        Yours Sincerly
		                                                    </td>
		                                                </tr>
		                                                <tr>
		                                                    <td style="text-align: left; padding:0 10px;">
		                                                        Dr. [Doctor's Full Name]
		                                                    </td>
		                                                </tr>
		                                            </table>
		                                        </td>
		                                    </tr>
		                                </table>
		                                <div class="center-align"><a href="javascript:void(0);" class="btn round-corner" id="btn_medical_generate">Save &amp; Generate</a></div>
		                            </div>
		                            <!--table for print/pdf ends here-->
		                        </div>
		                        <div class="blue-border-block-bottom"></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <!--tools tab ends here-->

	    </div>
    </div>

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
    <script>
        var card_id      = "{{isset($doctor_info['dump_id']) && !empty($doctor_info['dump_id']) ? $doctor_info['dump_id'] : ''}}";
        var userkey      = "{{isset($doctor_info['dump_session']) && !empty($doctor_info['dump_session']) ? $doctor_info['dump_session'] : ''}}";
        var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
        var api          = virgil.API(VIRGIL_TOKEN);
        var key          = api.keys.import(userkey);

        $(document).ready(function(){
            $enc_patient_id = $("#enc_patient_id").val();

            $("#btn_medical_generate").click(function(){
            	var patient_id 			= $("#patient_id").val();
	            var patient_type 		= $('#patient_details option:selected').attr('type');
            	var start_date 			= $("#start_date").val();
            	var end_date 			= $("#end_date").val();
            	var activity 			= $("#activity").val();
            	var reason_for_absent 	= $("#reason_for_absent").val();

            	if(patient_id == '')
            	{
            		$('#err_patient_id').show();
                    $('#patient_id').focus();
                    $('#err_patient_id').html('Please select Patient');
                    $('#err_patient_id').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    return false;
            	}
            	else if(start_date == '')
            	{
            		$('#err_start_date').show();
                    $('#err_start_date').html('Please select Start Date');
                    $('#err_start_date').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    //$('#start_date').focus();
                    return false;
            	}
            	else if(end_date == '')
            	{
            		$('#err_end_date').show();
                    $('#err_end_date').html('Please select End Date');
                    $('#err_end_date').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    //$('#start_date').focus();
                    return false;
            	}
            	else if(start_date > end_date)
            	{
            		$('#err_end_date').show();
                    $('#err_end_date').html('Start date should be less than end date');
                    $('#err_end_date').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    //$('#start_date').focus();
                    return false;
            	}

            	else if(activity == '')
            	{
            		$('#err_activity').show();
                    $('#activity').focus();
                    $('#err_activity').html('Please select Activity for Absent');
                    $('#err_activity').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    return false;
            	}
            	else
            	{
            		var formData = new FormData($('#medical_certi_form')[0]);
                    var _token   = '{{csrf_token()}}';
                    $.ajax({
                       url:'{{ url("/") }}/doctor/patients/tools/generate_medical_certificate/store',
                       type:'post',
                       data:formData,
                       processData: false,
                       contentType: false,
                       success:function(response){
                          if(response!='')
		                  {
		                    if(response.doctor_data.contact_no != "")
		                    {
		                        var dec_contact_no = key.decrypt(response.doctor_data.contact_no).toString();
		                        response.doctor_data.dec_contact_no = dec_contact_no;
		                    }

		                    if(response.doctor_data.address != "")
		                    {
		                        var dec_address = key.decrypt(response.doctor_data.address).toString();
		                        response.doctor_data.dec_address = dec_address;
		                    }
		                    if(response.doctor_data.medicare_provider_no != "")
		                    {
		                        var dec_medicare_provider_no = key.decrypt(response.doctor_data.medicare_provider_no).toString();
		                        response.doctor_data.dec_medicare_provider_no = dec_medicare_provider_no;
		                    }
			                    $.ajax({
			                       url:'{{ url("/") }}/doctor/patients/tools/generate/generate_medical_certificate_pdf',
			                       type:'post',
			                       data:{'arr_data' : response,'_token' : _token},
			                       success:function(res){
			                            pdf_url = '{{ url("/") }}/doctor/patients/tools/generate/generate_medical_certificate_pdf';
			                            window.open(pdf_url, '_blank');
			                       }
			                    });
		                  }   
                       }

                    });

                    /*$.ajax({
                       url:'{{ url("/") }}/doctor/patients/tools/generate_medical_certificate/store',
                       type:'POST',
                       data: formdata,
                       success:function(res){
                       	console.log(res);
                       	return false;
                       }
                    });*/
            	}
            });

            $("#patient_id").change(function(){
        		var patient_id 		= $("#patient_id").val();
        		var patient_type 	= $('#patient_id option:selected').attr('type');
        		$("#patient_type").val(patient_type);
        	});
        	/*$("#activity").change(function(){
        		var activity 		= $("#activity").val();
        	});*/

            $('#tab_patient_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/details/" + $enc_patient_id;
            });
            $('#tab_medical_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/medical_history/" + $enc_patient_id;
            });
            $('#tab_consultation_history').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_history/" + $enc_patient_id;
            });
            $('#tab_tools').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
            });
            $('#tab_chat').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/chats/" + $enc_patient_id;
            });
            $('#tab_consultation_guide').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/consultation_guide/" + $enc_patient_id;
            });


            $('#redirect_certificate').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/tools/" + $enc_patient_id;
            });
            $('#redirect_other_files').click(function(){
                window.location = "{{ url('/') }}/doctor/patients/tools/other_file_upload/" + $enc_patient_id;
            });
        });

		    
    </script>
    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>

    <script>
    	$('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            format: 'dd-mm-yyyy',
            formatSubmit: 'yyyy-mm-dd',
            selectYears: 100, // `true` defaults to 10.
            //min: new Date(2015,3,20),
            //max:new Date(),
            // Accessibility labels
            /*labelMonthNext: 'Next month',
            labelMonthPrev: 'Previous month',
            labelMonthSelect: 'Select a month',
            labelYearSelect: 'Select a year',*/
            onOpen: function() {
              console.log( 'Opened')
            },
            onClose: function() {
              console.log( 'Closed ' + this.$node.val() )
              selected_date = this.$node.val();
            },
            onSelect: function() {
              console.log( 'Selected: ' + this.$node.val() )
            },
            onStart: function() {
              console.log( 'Hello there :)' )
            }
        });
    </script>

@endsection