@extends('front.patient.layout._dashboard_master')
@section('main_content')
    
    <style>
        .error_class,.datebirth_error
        {
            color:red !important;
            line-height: 35px !important;
        }
        .text-bx {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        a.disabled {
           pointer-events: none;
           cursor: default;
           opacity: 0.6;
        }
    </style>

    <div class="header bookhead z-depth-2 ">
        <div class="menuBtn"><a href="{{ URL::previous() }}" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow"><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">BOOK A DOCTOR</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container paddingtpbtm book-doct-wraper">
            <form method="POST" action="{{ url('/patient') }}/booking/show_available_doctors" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="doctorForm book-doct-btm">

                    <div class="input-field col s12 selct">
                        <select id="patient" name="patient">
                            <option value="" disabled selected>Who is Seeing the doctor? <span class="required_field">*</span></option>
                            <option value="{{ $user_details['id'] }}" type="{{ 'user' }}">{{ $user_details['first_name'].' '.$user_details['last_name'] }}</option>
                            @if(isset($family_members) && !empty($family_members))
                                @foreach($family_members as $family_data)
                                    <option value="{{ $family_data['id'] }}" type="{{ 'family' }}">{{$family_data['first_name'].' '.$family_data['last_name']}}</option>
                                @endforeach
                            @endif
                            <option value="Add Family Member" id="popup_family_member" >Add Family Member</option>
                        </select>
                    </div>
                    <div class="err" id="err_patient" style="display:none;"></div>

                    <input type="hidden" name="user_type" id="user_type" value="">

                    <div class="input-field col s12 radio">
                        <p class="headelement">Why do you want to see the doctor? <span class="required_field">*</span></p>
                            <ul class="collection bookdoc brdrtopsd">
                                <li class="collection-item  ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in reason_for_doctor" id="advice_treatment" name="advice_treatment" value="advice_and_treatment" />
                                        <label for="advice_treatment" class="bluedoc-text">Advice &amp; Treatment</label>
                                    </div>
                                    <div class="clear"></div>
                                </li>

                                <li class="collection-item ">
                                    <div class="chkbx new ">
                                        <input type="checkbox" class="filled-in reason_for_doctor" id="prescriptions_repeats" name="prescriptions_repeats" value="prescriptions_and_repeats" />
                                        <label for="prescriptions_repeats" class="bluedoc-text">Prescriptions &amp; Repeats</label>                                       
                                    </div>
                                    <div class="clear"></div>
                                </li>

                                <li class="collection-item ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in reason_for_doctor" id="medical_cetificate" name="medical_cetificate" value="medical_cetificate" />
                                        <label for="medical_cetificate" class="bluedoc-text">Medical Cetificate</label>
                                    </div>
                                    <div class="clear"></div>
                                </li>

                                <li class="collection-item ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in reason_for_doctor" id="other" name="other" value="other" />
                                        <label for="other" class="bluedoc-text">Other</label>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            </ul>
                            
                            <div class="err" id="err_reason_for_doctor" style="display:none;"></div>
                    </div>
                    <div class="divider"></div>

                    <div class="input-field col s12 text-bx">
                        <input type="text" id="symptoms" name="symptoms" class="validate">
                        <label for="symptoms">Enter your symptoms or reason for call <span class="required_field">*</span></label>
                    </div>
                    <div class="err" id="err_symptoms" style="display:none;"></div>

                </div>
                <div class="book-doct-btm">
                <div class="divider"></div>
                <div class="input-field col s12 uploadImg">
                    <div class="file-field input-field">
                        
                        <div class="btn">
                            <span><i class="material-icons">camera_alt</i></span>
                            <input type="file" id="medical_files" name="medical_files" multiple >
                        </div>
                        <span class="textside">Optional - Upload photo of affected area.</span>

                    </div>
                    <div class="clr"></div>
                </div>
                <div class="divider"></div>
                <div class="bookdoc">
                <div class="input-field col s12 chkbx new">
                    <div class="check-bl">
                    <input type="checkbox" class="filled-in" id="no_emergency" checked />
                    <label for="no_emergency">This is not an Emergency <span class="required_field">*</span> or</label>
                    </div>
                    <a href="#emergencies_warning" class="any-txt" style="color: #000;">Any of these</a>
                    <div class="clr"></div>
                    <div class="err" id="err_no_emergency" style="display:none;"></div>
                </div>
                </div>
                <button type="submit" id="btn_submit" class="waves-effect waves-light futbtn">Next</button>
                <a href="#note" class="btn cart green lnht round-corner" id="no_btn">Next</a>
                </div>
            </form>

            <input type="hidden" id="user_limit" name="user_limit" value="{{ $user_booking_limit }}">

        </div>
    </div>

    <!-- Note Modal -->
    <div id="note" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Important Note</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                There are already 3 Consultations which are schedule or have been Completed.
            </div>
            <div class="row">
                You have reach your limit for this month.
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons submit_form">Ok</a>
        </div>
    </div>

    <!-- Emergencies Warning Modal -->
    <div id="emergencies_warning" class="modal requestbooking big-modal">
       <div class="model-wraper2">
        <div class="modal-content">
            <h4 class="center-align">Emergencies & Non-Suitable Conditions</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        
        <div class="modal-data scroll-div">
            <div class="row ">
                Please <strong> call 000 </strong> if you are experincing any of the below sysmptoms, as an online doctor is not suitable in these situations.
            </div>
            <div class="row">
                <ul class="pointsQues">
                    <li>Chest pain or chest tightness</li>
                    <li>Serious assault</li>
                    <li>sudden onset of weakness, numbness or paralysis of the face, arm, or leg</li>
                    <li>poisoning/overdose</li>
                    <li>Severe burns</li>
                    <li>unconsciousness or fitting</li>
                    <li>suicidal or extreme psychological distress</li>
                    <li>difficulty breathing or turning blue</li>
                    <li>sudden collapse or blackout</li>
                    <li>snake, funnel web or red back spider bite</li>
                    <li>severe or disttressing pain</li>
                    <li>heart palpitations</li>
                    <li>heavy or uncontrollable bleeding</li>
                    <li>severe allergic reaction</li>
                    <li>injury from a major accident</li>
                </ul>
            </div>
        </div>
        <div class="modal-footer center-align full-width">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons submit_form">Ok</a>
        </div>
       </div>
    </div>

    <!-- Emergencies Warning Modal -->
    <a href="#add_family_member" id="add_member" style="display: none;"></a>
    <div id="add_family_member" class="modal requestbooking date-modal">
        <div class="modal-content">
            <h4 class="center-align">Add Family Member</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data min-height">
            <div class="row">
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="firstname" name="firstname" type="text" class="validate">
                        <label for="firstname">First Name <span class="required_field">*</span></label>
                        <div class="error_class" id="err_first_name" style="display:none;"></div>
                    </div>
                </div>
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="lastname" name="lastname" type="text" class="validate">
                        <label for="lastname">Last Name <span class="required_field">*</span></label>
                        <div class="error_class" id="err_lastname" style="display:none;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6 l6">
                    <div class="input-field selct gender-drop2">
                        <select id="gender" name="gender">
                            <option value="" >Gender <span class="required_field">*</span></option>
                            <option value="male" >Male</option>
                            <option value="female">Female</option>
                        </select>
                        <div class="error_class" id="err_gender" style="display:none;"></div>
                    </div>
                </div>
                <div class="col s6 l6">
                    <div class="input-field text-bx ">
                        <input id="datepicker" name="datebirth" type="text" class="dob_datepicker dob validate">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <div class="error_class" id="err_datebirth" style="display:none;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="email" name="email" type="text" class="validate">
                        <label for="email">Email <span class="required_field">*</span></label>
                        <div class="error_class" id="err_email" style="display:none;"></div>
                    </div>
                </div>
                <div class="col s6 l6">
                    <div class="input-field text-bx ">
                        <input id="contact_no" name="contact_no" type="text" class="validate" >
                        <label class="active" for="contact_no">Contact no <span class="required_field">*</span></label>
                        <div class="error_class" id="err_contact_no" style="display:none;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field ">
                        <input id="relationship" type="text" name="relationship" class="validate">
                        <label for="relationship">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                        <div class="error_class" id="err_relationship" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer ">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
            <a href="javascript:void(0);" id="submit_form" class="modal-action waves-effect waves-green btn-cancel-cons right">Add Person</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // number validation for contact no
            $('#contact_no').keydown(function(){
                $(this).val($(this).val().replace(/[^\d]/,''));
                $(this).keyup(function(){
                    $(this).val($(this).val().replace(/[^\d]/,''));
                });
            });
            
            var user_limit = $("#user_limit").val();
            if(user_limit == 'Yes')
            {
                $('#btn_submit').css('display','none');
                $('#no_btn').css('display','block');
            }
            else
            {
                $('#btn_submit').css('display','block');
                $('#no_btn').css('display','none');
            }

            // if patient is selected then to get patient type
            $('#patient').change(function(){
                $('#user_type').val($('#patient option:selected').attr('type'));

                if($(this).val() == "Add Family Member")
                {
                    $("#add_member").trigger("click");
                    $('#add_family_member').modal();
                }
            });

            // validation before submitting form
            $('#btn_submit').click(function(){ 
                
                var patient                 = $('#patient').val();
                var reason_for_doctor       = $(".reason_for_doctor:checked").length;
                var symptoms                = $('#symptoms').val();
                var no_emergency            = $("#no_emergency").is(":checked");

                if($.trim(patient)=='')
                {
                    $('#err_patient').show();
                    $('#patient').focus();
                    $('#err_patient').html('Please select patient');
                    $('#err_patient').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('.mar300').position().top}, 2000);
                    return false;
                }
                else if(reason_for_doctor == 0)
                {
                    $('#err_reason_for_doctor').show();
                    $('#err_reason_for_doctor').html('Please select atleast 1 option');
                    $('#err_reason_for_doctor').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('#err_patient').position().top}, 2000);
                    return false;
                }
                if($.trim(symptoms)=='')
                {
                    $('#err_symptoms').show();
                    $('#symptoms').focus();
                    $('#err_symptoms').html('Please enter symptoms');
                    $('#err_symptoms').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('#err_reason_for_doctor').position().top}, 2000);
                    return false;
                }
                if(no_emergency == false)
                {
                    $('#err_no_emergency').show();
                    $('#no_emergency').focus();
                    $('#err_no_emergency').html('Please select this if it is not an Emergency');
                    $('#err_no_emergency').fadeOut(8000);
                    $('html, body').animate({scrollTop:$('#err_symptoms').position().top}, 2000);
                    return false;
                }
                return true;
            });


            // validation before submitting family member form
            $('#submit_form').click(function(){
                var firstname       = $('#firstname').val();
                var lastname        = $('#lastname').val();
                var gender          = $('#gender').val();
                var datepicker      = $('#datepicker').val();
                var email           = $('#email').val();
                var contact_no      = $('#contact_no').val();
                var relationship    = $('#relationship').val();

                var vemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var mobile_filter = /^[0-9]*$/;
                var alpha         = /^[a-zA-Z]*$/;

                if($.trim(firstname)=='')
                {
                    $('#err_first_name').show();
                    $('#err_first_name').html('Please enter first name.');
                    $('#err_first_name').fadeOut(4000);
                    $('#firstname').focus();
                    return false;
                }
                else if(!alpha.test(firstname))
                {
                   $('#err_first_name').show();
                   $('#err_first_name').html('Please enter valid first name.');
                   $('#err_first_name').fadeOut(4000);
                   $('#firstname').focus();
                   return false;
                }   
                if($.trim(lastname)=='')
                {
                    $('#err_lastname').show();
                    $('#lastname').focus();
                    $('#err_lastname').html('Please enter last name.');
                    $('#err_lastname').fadeOut(4000);
                    return false;
                }
                else if(!alpha.test(lastname))
                 {
                    $('#err_lastname').show();
                    $('#lastname').focus();
                    $('#err_lastname').html('Please enter valid last name.');
                    $('#err_lastname').fadeOut(4000);
                    return false;  
                 }
                if($.trim(gender)=='')
                {
                    $('#err_gender').show();
                    $('#gender').focus();
                    $('#err_gender').html('Please select gender.');
                    $('#err_gender').fadeOut(4000);
                    return false;
                }
                if($.trim(datepicker)=='')
                {
                    $('#err_datepicker').show();
                    $('#datepicker').focus();
                    $('#err_datepicker').html('Please enter Date of Birth.');
                    $('#err_datepicker').fadeOut(4000);
                    return false;
                }
                if($.trim(email)=='')
                {
                    $('#err_email').show();
                    $('#email').focus();
                    $('#err_email').html('Please enter email.');
                    $('#err_email').fadeOut(4000);
                    return false;
                }
                else if(!vemail_filter.test(email))
                 {
                    $('#err_email').show();
                    $('#email').focus();
                    $('#err_email').html('Please enter a valid email.');
                    $('#err_email').fadeOut(4000);
                    return false;  
                 }
                if($.trim(contact_no)=='')
                {
                    $('#err_contact_no').show();
                    $('#contact_no').focus();
                    $('#err_contact_no').html('Please enter contact no.');
                    $('#err_contact_no').fadeOut(4000);
                    return false;
                }
                else if(!mobile_filter.test(contact_no))
                 {
                    $('#err_contact_no').show();
                    $('#contact_no').focus();
                    $('#err_contact_no').html('Please enter only numbers.');
                    $('#err_contact_no').fadeOut(4000);
                    return false;  
                 }
                if($.trim(relationship)=='')
                {
                    $('#err_relationship').show();
                    $('#relationship').focus();
                    $('#err_relationship').html('Please enter relationship.');
                    $('#err_relationship').fadeOut(4000);
                    return false;
                }
                else if(!alpha.test(relationship))
                 {
                    $('#err_relationship').show();
                    $('#relationship').focus();
                    $('#err_relationship').html('Please enter valid relationship.');
                    $('#err_relationship').fadeOut(4000);
                    return false;  
                 }
                 else
                 {
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                       url:'{{ url("/") }}/patient/setting/family_members/add',
                       type:'POST',
                       dataType:'json',
                       data:{_token:token, firstname:firstname, lastname:lastname, gender:gender, datebirth:datepicker, email:email, contact_no:contact_no, user_relation:relationship },
                       success:function(res){
                          if(res.status)
                          {
                            $("#add_family_member .modal-close").click()
                            $(".open_popup").click();
                            $('.flash_msg_text').html(res.msg);
                          }
                       }
                    });
                 }
            });

            $('#email').blur(function(){
                var email_id=$(this).val();
                if($(this).val()!='')
                {
                    $.ajax({
                        url:'{{ url("/") }}/patient/setting/check_member_mail',
                        type:'get',
                        data:{email_id:email_id},
                        success:function(data)
                        {
                            if(data.status=='exist')
                            {
                                $('#err_email').show();
                                $('#err_email').html('E-mail is already registered');
                                $('#submit_form').addClass('disabled');
                                $('#email').focus();
                            }
                            else
                            {
                                $('#err_email').hide();
                                $('#err_email').html('');
                                $('#submit_form').removeClass('disabled');
                           }
                       }
                   });
                }
                else
                {
                    $('#email').next('label').next('span').html("");   
                    $('#submit_form').removeClass('disabled');
                } 
            });

        });
    </script>

@endsection