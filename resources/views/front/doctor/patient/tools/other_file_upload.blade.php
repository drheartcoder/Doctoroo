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
                <li class="tab truncate">
                    <a href="#tools" id="redirect_certificate">Medication Certificate Generator</a>
                </li>
                <li class="tab truncate active">
                    <a href="#other_file_upload" class="active" id="redirect_other_files">Referral, Pathology Request & Other Document Upload</a>
                </li>
            </ul>

            <!--Tools tab starts here-->
    	    <div id="other_file_upload" class="tab-content medi">
    	        <div class="doctor-container">
    	            
    	            <div class="row">
    	                <div class="col s12">
    	                    <div class="head-medical-pres">
    	                        <h2 class="center-align">Referral, Pathology Request & Other Document Upload</h2>
    	                		<span class="posleft qusame rescahnge "><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>
    	                    </div>
                            <div class="clearfix"></div>

    	                    <!-- <div class="round-box z-depth-3">
    	                        <div class="blue-border-block-top"></div>
    	                        <div class="round-box-content blue-border">
    	                            
    	                        	<div class="green-border posrel round-box-content table center-align">
    		                            <div class="table-row">
    		                                <div class="table-cell">
    		                                    
    		                                	<form method="POST" id="form_other_file_upload" action="{{ url('/') }}/doctor/patients/tools/other_file_upload/store">
    		                                	{{ csrf_field() }}
    		                                	<input type="hidden" id="txt_patient_id" name="txt_patient_id" value="{{ $enc_patient_id }}">

    		                                    <div class="input-field ">
    		                                        <div class="file-field input-field">
    		                                            <div class="btn file-btn-new bluedoc-bg circle">
    		                                                <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
    		                                                <input type="file" id="txt_file" name="txt_file">
    		                                            </div>
    		                                            <div class="file-path-wrapper new-file-path">
    		                                                <input class="file-path validate" type="text" placeholder="Upload a medical ceritificate">
    		                                            </div>
    		                                        </div>
    		                                        <div class="clr"></div>
    		                                    </div>

    		                                    @if(isset($booking_data) && !empty($booking_data))
    		                                    <div class="input-field selct padnotop  input-padding-25px">
    				                                <select id="activity" name="activity">
    				                                    <option value="">Consultation Id</option>
    				                                    @foreach($booking_data as $book)
    				                                    	<option value="{{ $book['id'] }}">{{ $book['consultation_id'] }}</option>
    				                                    @endforeach
    				                                </select>
    				                                <div class="err" id="err_activity" style="display:none;"></div>
    				                            </div>
    				                            @endif

    		                                    <div class="btn-absolute">
    		                                        <a class="btn bluedoc-bg round-corner pos-abs-btn">Upload &amp; Save</a>
    		                                    </div>

    		                                    </form>

    		                                </div>
    		                            </div>
    		                        </div>

    	                        </div>
    	                        <div class="blue-border-block-bottom"></div>
    	                    </div> -->

    	                    <div class="round-box z-depth-3">
    	                        <div class="blue-border-block-top"></div>
    	                        <div class="posrel round-box-content table center-align">
    	                            <div class="table-row">
    	                                <div class="table-cell">
    	                                    
    	                                	<form method="POST" id="form_other_file_upload" action="{{ url('/') }}/doctor/patients/tools/store_upload_file" enctype="multipart/form-data">
    		                                	{{ csrf_field() }}
    		                                <input type="hidden" id="txt_patient_id" name="txt_patient_id" value="{{ $enc_patient_id }}">

    	                                    <!-- icon with text to use -->
    	                                    <div class="input-field ">
    	                                        <div class="file-field input-field">
    	                                            <div class="btn file-btn-new bluedoc-bg circle">
    	                                                <span class="icon-plus font-size-14px"><i class="material-icons">&#xE2C3;</i></span>
    	                                                <input type="file" id="txt_file" name="txt_file">
    	                                            </div>
    	                                            <div class="file-path-wrapper new-file-path input-padding-25px">
    	                                                <input class="file-path truncate validate center-align" type="text" placeholder="Upload Document">
    	                                            </div>
    	                                        </div>
    	                                        <div class="clr"></div>
    	                                    	<div class="err" id="err_file" style="display:none;"></div>
    	                                    </div>
    	                                    <!-- icon with text to use -->
    	                                    @if(isset($booking_data) && !empty($booking_data))
    		                                    <div class="input-field selct">
    				                                <select class="input-padding-25px" id="cmb_booking_id" name="cmb_booking_id">
    				                                    <option value="">Consultation Id</option>
    				                                    @foreach($booking_data as $book)
    				                                    	<option value="{{ $book['id'] }}">{{ $book['consultation_id'] }}</option>
    				                                    @endforeach
    				                                </select>
    				                                <div class="err" id="err_cmb_booking_id" style="display:none;"></div>
    				                            </div>
    				                        @endif

    	                                    <div class="btn-absolute">
    											<a class="btn bluedoc-bg round-corner pos-abs-btn" id="btn_form_submit">Upload &amp; Save</a>
    	                                    </div>

    	                                    </form>

    	                                </div>
    	                            </div>
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

    <input type="hidden" class="file_error_msg" id="file_error_msg" name="file_error_msg" value="{{ Session::get('txt_file_error') }}" />
    <a class="open_file_error_msg_popup" href="#show_file_error_msg"></a>
    <div id="show_file_error_msg" class="modal addperson">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text">{{ Session::get('txt_file_error') }}</div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0)" id="reload_page" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <input type="hidden" id="enc_patient_id" name="enc_patient_id" value="{{ $enc_patient_id }}">
    <script>
        $(document).ready(function(){
            var formData      = new FormData();
            var _token        = '{{csrf_token()}}';
            var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
            var api           = virgil.API(virgilToken);
             
            var dumpSessionId = '{{isset($patient_data["dump_session"])?$patient_data["dump_session"]:""}}';
            var dumpId        = '{{isset($patient_data["dump_id"])?$patient_data["dump_id"]:""}}';

            $enc_patient_id = $("#enc_patient_id").val();

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


            var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];
            $('#txt_file').on('change', function(evt) {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_file').show();
                    $('#txt_file').focus();
                    $('#err_file').html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                    $('#err_file').fadeOut(4000);
                    $("#txt_file").val('');
                    return false;
                }
                if(this.files[0].size > 5000000)
                {
                    $('#err_file').show();
                    $('#txt_file').focus();
                    $('#err_file').html('Max size allowed is 5mb.');
                    $('#err_file').fadeOut(4000);
                    $("#txt_file").val('');
                    return false;
                }

                  var file_obj = $(this)[0].files[0];
                  var filename  =  $(this).val().split('\\').pop();
                  var fileReader = new FileReader();
                  fileReader.readAsArrayBuffer(file_obj);
                  fileReader.onload = function ()
                  {
                    var imageData    = fileReader.result;
                    var fileAsBuffer = new Buffer(imageData);
                    var api       = virgil.API(virgilToken);
                    var findkey   = api.cards.get(dumpId).then(function (cards) {
                        var encryptedFile = api.encryptFor(fileAsBuffer, cards);
                        var blob = new Blob([encryptedFile]);
                        var enc_file = new File([blob], filename);
                        formData.append('txt_file',enc_file,filename);
                    });
                  }
            });

            $('#btn_form_submit').click(function(){
            	var file 		    = $('#txt_file').val();
                var booking_id      = $('#cmb_booking_id').val();
            	var txt_patient_id 	= $('#txt_patient_id').val();

            	if(file == '')
            	{
            		$('#err_file').show();
                    $('#txt_file').focus();
                    $('#err_file').html('Please select any document/image to upload');
                    $('#err_file').fadeOut(8000);
                    return false;
            	}
            	else if(booking_id == '')
            	{
            		$('#err_cmb_booking_id').show();
                    $('#cmb_booking_id').focus();
                    $('#err_cmb_booking_id').html('Please select consultation id');
                    $('#err_cmb_booking_id').fadeOut(8000);
                    return false;
            	}
            	else
            	{
                     
                    formData.append('_token',_token);
                    formData.append('txt_patient_id',txt_patient_id);
                    formData.append('cmb_booking_id',booking_id);
                    $.ajax({
                            url:"{{ url('/') }}/doctor/patients/tools/store_upload_file",
                            type:'post',
                            data:formData,
                            processData: false,
                            contentType: false,
                            cache:false,
                            success:function(data){
                              window.location.reload();
                            }
                        });
            		//$('#form_other_file_upload').submit();
            	}
            });

            var file_error_msg = $('#file_error_msg').val();
            if(file_error_msg != '')
            {
                $(".open_file_error_msg_popup").click();
            }
        });
		    
    </script>

@endsection