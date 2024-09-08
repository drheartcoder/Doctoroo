@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

     <style>
      /*.error_class,.datebirth_error,#valid_mail
      {
      color:red !important;
      line-height: 35px !important;
      }*/
      a.disabled {
      pointer-events: none;
      cursor: default;
      opacity: 0.6;
      }
      .text-bx {
      margin-top: 20px;
      margin-bottom: 20px;
      }

      .required_field
      {
         color:red;
      }
   </style>

    <!--tab start-->

    <div class="mar300  has-header minhtnor">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" id="tab_patient_history">
                    <a href="javascript:void(0);" class="disabled"><span><img src="{{url('/')}}/public/doctor_section/images/patient-details.svg" alt="icon" class="tab-icon"/> </span> Patient History </a>
                </li>
                <li class="tab" id="tab_medical_history">
                    <a href="javascript:void(0);" class="disabled"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab" id="tab_consultation_history">
                    <a href="javascript:void(0);" class="disabled"> <span><img src="{{url('/')}}/public/doctor_section/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Consultation History</a>
                </li>
                <li class="tab" id="tab_tools">
                    <a href="javascript:void(0);" class="disabled"> <span><img src="{{url('/')}}/public/doctor_section/images/menu7.svg" alt="icon" class="tab-icon" /> </span>Tools</a>
                </li>
                <li class="tab" id="tab_chat">
                    <a href="javascript:void(0);" class="disabled"> <span><img src="{{url('/')}}/public/doctor_section/images/chat.svg" alt="icon" class="tab-icon" /> </span>Chat</a>
                </li>
                <!-- <li class="tab" id="tab_consultation_guide">
                    <a href="javascript:void(0);" class="disabled"> <span><img src="{{url('/')}}/public/doctor_section/images/consultation.svg" alt="icon" class="tab-icon" /> </span>Consultation Guide</a>
                </li> -->
            </ul>
        </div>
    <div id="patient" class="tab-content medi ">
        <form id="add_details_form">
            <div class="doctor-container">
                <div class="head-medical-pres">
                    <h2 class="center-align">Add a New Patient</h2>

                    <span class="posleft qusame rescahnge"><a href="{{ url('/') }}/doctor/patients/doctoroo_patients" class="border-btn btn round-corner center-align">&lt; Back</a></span>

                    <!-- <span class="posright qusame rescahnge "><button type="submit" class="btn cart bluedoc-bg lnht round-corner center-align">Save</button></span> -->
                    <span class="posright qusame rescahnge "><button type="button" class="btn cart bluedoc-bg lnht round-corner center-align" id="store_patient_data">Save</button></span>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="round-box z-depth-3">
                            <div class="blue-border-block-top"></div>
                            <div class="round-box-content blue-border edit-profile">
                                <div class="row">
                                    <div class="col l6 m6 s12">
                                        <div class="input-field selct maronytb ">
                                            <select id="regular_doctor">
                                                <option value="">Are you this Patient's regular Doctor? </option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <span class="error_class"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l6 m6 s12">

                                        <div class="otherdetails">
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <h3 class="sethead ">Personal Information</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar  input-padding-25px">
                                                        <input type="text" id="fname" name="fname" class="validate" maxlength="16">
                                                        <label for="fname" class="grey-text truncate">First Name <span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field  text-bx lessmar  input-padding-25px">
                                                        <input type="text" id="lname" class="validate" maxlength="16">
                                                        <label for="lname" class="grey-text truncate">Last Name <span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="txt_userkey" class="validate">
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar  input-padding-25px">
                                                        <input type="text" id="dob" class="validate datepicker">
                                                        <label for="dob" class="grey-text truncate">Date of Birth <span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field selct maronytb">
                                                        <select id="patient_gender">
                                                            <option value="">Gender </option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar  input-padding-25px">
                                                        <input type="text" id="phone_no" class="validate" maxlength="14">
                                                        <label for="phone_no" class="grey-text truncate">Phone Number</label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="input-field text-bx lessmar  input-padding-25px">
                                                        <input type="text" id="mobile_no" class="validate" maxlength="14">
                                                        <label for="mobile_no" class="grey-text truncate">Mobile Number <span class="required_field">*</span></label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col l12 m12 s12">
                                                    <div class="input-field  text-bx lessmar input-padding-25px">
                                                        <input id="txt_address" type="text" class="validate" placeholder="Address" />
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12">

                                        <div class="otherdetails ">
                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <h3 class="sethead ">Entitlement</h3>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col s12 m12 l12 ">
                                                    <div class="input-field selct maronytb">
                                                        <select id="entitlement_no" disabled>
                                                            <option value="">Select Entitlement</option>
                                                            @foreach($entitlement as $val)
                                                              <option value="{{$val['id']}}">{{$val['entitlement']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <div class="input-field text-bx lessmar input-padding-25px">
                                                        <input type="text" id="card_no" disabled>
                                                        <label for="card_no" class="grey-text truncate">Enter Card Number </label>
                                                        <span class="error_class"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m12 l12 ">
                                                    <div class="input-field uploadImgnew">
                                                        <div class="file-field input-field">
                                                            <div class="btn bluedoc-bg btn-noline-height">
                                                                <span><i class="material-icons">camera_alt</i></span>
                                                                <input type="file" multiple disabled>
                                                            </div><span class="textside">Optional - Upload a photo of card.</span>
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <a class="border-btn-nomarrl center-align truncate btn_add" style="cursor: pointer;" ><span class="font-size-16px">+</span> Add Another Entitlement</a>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="blue-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 posrel">
                            <div class="heading-round-box">Regular Family Doctor</div>
                            <div class="green-border round-box-content  max-height">
                                <div class="text-content">
                                    <p class="grey-text" id="family_doctor_info">
                                        If you have selected above that you are this patient's doctor, this will be automatically added here. This can also be entered by you or the patient via the plus icon
                                    </p>
                                    <ul class="collection brdrtopsd" style="display: none;" id="family_doctor_block">
                                        @if(isset($doctor_arr) && !empty($doctor_arr))
                                        <li class="collection-item avatar  valign-wrapper">
                                            <div class="image-avtar left">
                                                <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" class="circle" />
                                            </div>
                                            <div class="doc-detail wid90 left">
                                                <span class="title"> Dr. {{isset($doctor_arr['first_name']) ? $doctor_arr['first_name'] : ''}} {{isset($doctor_arr['last_name']) ? $doctor_arr['last_name'] : ''}}
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endif
                                    </ul>

                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="javascript:void(0)">
                                        <div class="btn-floating btn-large medblue btn_add"><i class="large material-icons">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Regular Click &amp; Collect Pharmacies</div>
                            <div class="green-border round-box-content max-height">
                                <div class="text-content">
                                    <p class="grey-text">You are the patient may enter the pharmacy of choice of the patient</p>
                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="javascript:void(0)">
                                        <div class="btn-floating btn-large medblue"><i class="large material-icons btn_add">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Previously seen doctors on doctoroo</div>
                            <div class="green-border round-box-content  max-height">
                                <div class="text-content">
                                    <p class="grey-text">This will be added automatically</p>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="round-box z-depth-3 max-height posrel">
                            <div class="heading-round-box">Family Members</div>
                            <div class="green-border round-box-content max-height">
                                <div class="text-content">
                                    <p class="grey-text">You may add this patient's family members, if they've consented, or they may add this themselves later</p>
                                </div>
                                <div class="clr"></div>
                                <div class="fixed-action-btn hidetext">
                                    <a href="javascript:void(0)">
                                        <div class="btn-floating btn-large medblue btn_add" ><i class="large material-icons btn_add ">add</i></div> 
                                    </a>
                                </div>
                            </div>
                            <div class="green-border-block-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div id="add-family-member" class="modal  date-modal addperson">
            <div class="modal-content">
                <h4 class="center-align">Add someone to your account</h4>
                <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="input-field text-bx ">
                            <input id="firstname" type="text" class="validate">
                            <label for="firstname">First Name</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="lastname" type="text" class="validate">
                            <label for="lastname">Last Name</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:28px;">
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="gender" type="text" class="validate">
                            <label for="gender">Gender</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="datebirth" type="date" class="datepicker validate">
                            <label class="active" for="datebirth">Date of birth</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:28px;">
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="firstname" type="text" class="validate">
                            <label for="firstname">Email</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="lastname" type="text" class="validate">
                            <label for="lastname">Contact No.</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:28px;">
                    <div class="col s12 l12">
                        <div class="input-field ">
                            <input id="password" type="text" class="validate">
                            <label for="password" class="truncate">Your relationship to them e.g. Mother</label>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer ">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
                <a href="#minor" class="modal-action waves-effect waves-green btn-cancel-cons right modal-close">Add Person</a>
            </div>
    </div>
    <a href="#user_notification" id="user_model_open"></a>
    <div id="user_notification" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align"><strong>Note :</strong> Please fill up Add new patient form. Later you would be able to add this</p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Ok</a>
        </div>     
    </div>

    @include('google_api.google')
    <script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
    <script>
        $(document).ready(function(){
          var location = "Australia";
          $("#txt_address").geocomplete({
            details: ".geo-details",
            detailsAttribute: "data-geo",
          });
        });
    </script>

    <script>
        $(document).ready(function(){
            url ="<?php echo $module_url_path ; ?>";
            $('#phone_no, #mobile_no,#card_no').keydown(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
             $(this).keyup(function(){
                 $(this).val($(this).val().replace(/[^\d]/,''));
            });
           });

            // Allow only Alphanumeric Characters
            $('#fname, #lname').keyup(function() {
                if (this.value.match(/[^a-zA-Z]/g)) {
                    this.value = this.value.replace(/[^a-zA-Z]/g, '');
                }
            });

            /*function add_details_form()
            {*/
                $('#add_details_form').submit(function(e){
                    e.preventDefault();
                    
                    $('.error_class').html('');
                    
                    if($('#regular_doctor').val()=='' || $('#regular_doctor').val()==null)
                    {
                        $('#regular_doctor').closest('.col').find('.error_class').html("Please select an option");
                        $('#regular_doctor').focus();
                        return false;
                    }
                    else if($('#fname').val()=='' || $('#fname').val()==null)
                    {
                        $('#fname').next('label').next('span').html("Please Enter first name");
                        $('#fname').focus();
                        return false;
                    }
                    else if($('#lname').val()=='' || $('#lname').val()==null)
                    {
                        $('#lname').next('label').next('span').html("Enter last name");
                        $('#lname').focus();
                        return false;
                    }
                    else if($('#dob').val()=='' || $('#dob').val()==null)
                    {
                        $('#dob').next('label').next('span').html("Select date of birth");   
                        return false;
                    }
                    else if($('#patient_gender').val()=='' || $('#dob').val()==null)
                    {
                        $('#patient_gender').closest('.col').find('.error_class').html("Select Gender");   
                        $('#patient_gender').focus();
                        return false;
                    }
                    else if($('#mobile_no').val()=='' || $('#mobile_no').val()==null)
                    {
                        $('#mobile_no').next('label').next('span').html("Enter mobile number");
                        $('#mobile_no').focus();
                        return false;
                    }
                    else if($('#txt_address').val()=='' || $('#txt_address').val()==null)
                    {
                        $('#txt_address').next('span').html("Enter Address");
                        $('#txt_address').focus();
                        return false;
                    }
                    /*else if($('#entitlement_no').val()=='' || $('#entitlement_no').val()==null)
                    {
                        $('#entitlement_no').closest('.col').find('.error_class').html("Select Entitlement");
                        
                        return false;
                    }
                    else if($('#card_no').val()=='' || $('#card_no').val()==null)
                    {
                        $('#card_no').next('label').next('span').html("Enter card number");
                        $('#card_no').focus();
                        return false;
                    }*/

                    formData = new FormData();

                    formData.append('_token',"<?php echo csrf_token(); ?>");
                    formData.append('regular_doctor',$('#regular_doctor').val());
                    formData.append('fname',$('#fname').val());
                    formData.append('lname',$('#lname').val());
                    formData.append('dob',$('#dob').val());
                    formData.append('gender',$('#patient_gender').val());
                    formData.append('mobile_no',$('#mobile_no').val());
                    formData.append('phone_no',$('#phone_no').val());
                    formData.append('address',$('#txt_address').val());
                    formData.append('txt_userkey',$('#txt_userkey').val());
                    //formData.append('entitlement',$('#entitlement_no').val());  
                    //formData.append('card_no',$('#card_no').val());  
                    //formData.append('enc_patient_id',$('#enc_patient_id').val());  
                   
                    $.ajax({
                      url:url+'/patients/store_patient',
                      type:'post',
                      data:formData,
                      contentType:false,
                      processData:false,
                      cache:false,
                      dataType:'json',
                      success:function(data){
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                      }
                        
                    });
               });
            /*}*/

            $('#show_flash_msg .modal-close').click(function() {
                window.location = url+"/patients/myown_patients"
            });

            $('#regular_doctor').change(function(){
                regular_doctor_status = $(this).val();
                if($(this).val() == 'yes')
                {
                    $('#family_doctor_info').hide();
                    $('#family_doctor_block').show();
                }
                else
                {
                    $('#family_doctor_info').show();
                    $('#family_doctor_block').hide();
                }
            });

            $('.btn_add, #card_no').click(function(){
                $("#user_model_open").trigger("click");
                $('#user_notification').modal();
            });

            $('#entitlement_no').change(function(){
                $('#entitlement_no').empty();
                $("#user_model_open").trigger("click");
                $('#user_notification').modal();
            });

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true, // Close upon selecting a date,
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy-mm-dd',
                selectYears: 100, // `true` defaults to 10.
                //min: new Date(2015,3,20),
                max:new Date(),
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
        });
    </script>


<!-- Virgil Service starts HERRE --> 
<input type="hidden" id="virgilToken" name="virgilToken" value="{{ env('VIRGIL_TOKEN') }}" />
<script type="text/javascript">
    // generate token
$(document).ready(function(){
    $("#store_patient_data").bind('click',function()
    {
        var email       = "{{$doctor_email}}";
        var virgilToken = $('#virgilToken').val();
        var api         = virgil.API(virgilToken);

        // generate and save Virgil Key
        var userKey = api.keys.generate();

        // export Virgil key to string
        var exportedKey = userKey.export().toString("base64");
        $('#txt_userkey').val(exportedKey);

        // create Virgil Card
        var userCard = api.cards.create(email, userKey);

        // export Virgil Card to string
        var exportedCard = userCard.export();

        // transmit the Virgil Card to the server
        var _token = "{{ csrf_token() }}";

        $.ajax({
            url: '{{ url("/") }}/publish/card',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: _token,
                exportedCard: exportedCard
            },
            success: function (res)
            {
                if (res.status == 'success')
                {
                    $('#add_details_form').submit();
                    //add_details_form();
                }
                else
                {
                    alert('Something went wrong');
                }
            }
        });
    });
});
</script>
<!-- Virgil Service ends HERRE --> 

@endsection