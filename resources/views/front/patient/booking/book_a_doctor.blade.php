@extends('front.patient.layout._dashboard_master')
@section('main_content')
<style>
    .error_class,
    .datebirth_error {
        color: red !important;
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
    <!-- <div class="backarrow"><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div> -->
    <h1 class="main-title center-align">BOOK A DOCTOR</h1>
</div>

<!-- SideBar Section -->
@include('front.patient.layout._sidebar')

<div class="mar300 has-header has-footer">   

        <div class="container paddingtpbtm book-doct-wraper">
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
               <!-- <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button> -->
               <?php echo html_entity_decode(Session::get('error')); ?>
            </div>
        @endif

        <form id="book_a_doctor_form" method="POST" action="{{ url('/patient') }}/booking/show_available_doctors" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="doctorForm book-doct-btm">
                <div class="posrel">
                    <div class="input-field col s12 selct padbtm30">
                        
                        <div id="see_a_doctor">
                        <select id="patient" name="patient">
                            <option value="" disabled selected>Who is seeing the doctor? <span class="required_field">*</span></option>
                            <option value="{{ $user_details['id'] }}" type="{{ 'user' }}">{{ $user_details['first_name'].' '.$user_details['last_name'] }}</option>
                            @if(isset($family_members) && !empty($family_members)) 
                                @foreach($family_members as $family_data) 
                                    @if(isset($inserted_family_member_id) && !empty($inserted_family_member_id)) 
                                        @if($family_data['id'] == $inserted_family_member_id)
                                        <option value="{{ $family_data['id'] }}" type="{{ 'family' }}" selected>{{$family_data['first_name'].' '.$family_data['last_name']}}</option>
                                        @else
                                        <option value="{{ $family_data['id'] }}" type="{{ 'family' }}">{{$family_data['first_name'].' '.$family_data['last_name']}}</option>
                                        @endif 
                                    @else
                                    <option value="{{ $family_data['id'] }}" type="{{ 'family' }}">{{$family_data['first_name'].' '.$family_data['last_name']}}</option>
                                    @endif 
                                @endforeach 
                            @endif
                            <option value="Add Family Member" id="popup_family_member">Add Family Member</option>
                        </select> 
                        </div>
                    </div>
                    

                    <div class="err" id="err_patient" style="display:none;"></div>
                 <input type="hidden" name="user_type" id="user_type" value="">
                </div>
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
                                <label for="medical_cetificate" class="bluedoc-text">Medical Certificate</label>
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
                    <div class="divider"></div>
                    <div class="err" id="err_reason_for_doctor" style="display:none;"></div>
                </div>

                <div class="posrel">
                    <div class="input-field col s12 text-bx padbtm30" style="margin-bottom: 0;">
                        <input type="text" id="symptoms" name="symptoms" class="validate">
                        <label for="symptoms">Enter your symptoms or reason for call <span class="required_field">*</span></label>
                    </div>
                    <div class="err" id="err_symptoms" style="display:none;"></div>
                </div>
            </div>
            <div class="book-doct-btm">
                <div class="divider"></div>
                <div class="input-field col s12 uploadImg new-upload-img">
                    <div class="file-field input-field">

                        <div>
                            <span data-multiupload="3">
                                <span data-multiupload-holder></span>
                                <div class="clr">
                                    <div class="btn ">
                                        <span><i class="material-icons" style="margin-top:9px;">camera_alt</i></span>
                                    </div>
                                    <span class="textside">Optional - Upload photo of affected area.</span>
                                        <input data-multiupload-src class="upload_pic_btn" name="img[]" id="affected_area_id" type="file" multiple="">
                                    <div class="clr"></div>
                                </div>
                                <span data-multiupload-fileinputs></span>
                            </span>
                        </div>

                    </div>
                    <div class="err left-side-btn" id="err_upload_pic_btn" style="display:none;"></div>
                    @if(Session::has('medical_img_error'))
                        <div class="err error_msg">{{ Session::get('medical_img_error') }}</div>
                    @endif
                    <div class="clr"></div>
                </div>
            </div>
            
            <div class="divider"></div>
            <div class="bookdoc">
                <div class="input-field col s12 chkbx new">
                    <div class="check-bl">
                        <input type="checkbox" class="filled-in" id="no_emergency" />
                        <label for="no_emergency">This is not an emergency <span class="required_field">*</span> or</label>
                    </div>
                    <a href="#emergencies_warning" class="any-txt" style="color: #53ab57;">any of these</a>
                    <div class="clr"></div>
                    <br>
                    <div class="err" id="err_no_emergency" style="display:none; bottom: -10px;"></div>
                </div>
            </div>
            <button type="button" id="btn_submit" class="waves-effect waves-light futbtn">Next</button>
            <a href="#note" class="btn cart green lnht round-corner" id="no_btn">Next</a>
    </div>
    </form>

    <input type="hidden" id="user_limit" name="user_limit" value="{{ $user_booking_limit }}">
</div>
</div>

<!-- Note Modal -->
<div id="note" class="modal requestbooking" style="display:none;">
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
<div id="emergencies_warning" class="modal requestbooking big-modal" style="display:none;">
    <div class="model-wraper2">
        <div class="modal-content">
            <h4 class="center-align">Emergencies & Non-Suitable Conditions</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>

        <div class="modal-data scroll-div">
            <div class="row ">
                If you are experiencing a medical emergency immediately dial 000.
            <br/>
            <br/>
            Do not book or see a doctor on the platform if you, or the patient, have or think you may have an emergency or critical condition or symptom, including, but in no way limited to:
            </div>
            <div class="row">
                <ul class="pointsQues">
                    <li>Chest pain or chest tightness</li>
                    <li>Serious assault</li>
                    <li>Sudden onset of weakness, numbness or paralysis of the face, arm, or leg</li>
                    <li>Poisoning/overdose</li>
                    <li>Severe burns</li>
                    <li>Unconsciousness or fitting</li>
                    <li>Suicidal or extreme psychological distress</li>
                    <li>Difficulty breathing</li>
                    <li>Sudden collapse or blackout</li>
                    <li>Any animal or unknown bites</li>
                    <li>Severe or distressing pain</li>
                    <li>Heart palpitations</li>
                    <li>Heavy or uncontrollable bleeding</li>
                    <li>Severe allergic reaction</li>
                    <li>Injury from a major accident</li>
                    <li>Any other condition/s on our Site that we have suggested as inappropriate for a telemedicine consultation</li>
                    <li>Or if you have or think you may have a condition or symptom which you don’t believe or doubt can be diagnosed or treated via an online telehealth consultation</li>
                </ul>
            </div>
            <div class="row ">
                IF YOU ARE IN DOUBT ABOUT THE SERIOUSNESS OF YOUR CONDITION, THE APPROPRIATENESS OR EFFECTIVENESS OF AN ONLINE CONSULTATION OR BELIEVE THAT YOU, OR ANYONE IS IN AN URGENT, DANGEROUS OR EMERGENCY SITUATION, YOU SHOULD NOT USE DOCTOROO AND INSTEAD CONTACT 000 IMMEDIATELY OR SEEK ALTERNATIVE AND APPROPRIATE MEDICAL SERVICES. DOCTOROO IS IN NO WAY A REPLACEMENT FOR YOUR REGULAR GP OR HEALTHCARE PROVIDER. SHOULD YOUR SYMPTOM/S OR CONDITION DEGRADE, YOU AGREE TO CONTACT YOUR REGULAR GP IMMEDIATELY OR SEEK OTHER, APPROPRIATE AND IMMEDIATE HEALTHCARE ADVICE, OPINION AND/OR TREATMENT.
                <br/>
                <br/>
                By accessing and using the Site, and continuing with this consultation booking, you agree that you have had sufficient opportunity to access these Terms and that you have read, accepted and agree to comply with and be legally bound by these Terms. You should immediately cease accessing and using this Site if you do not accept these Terms.
            </div>
        </div>
        <div class="modal-footer center-align full-width">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons submit_form">Ok</a>
        </div>
    </div>
</div>

<!-- Emergencies Warning Modal -->
<a href="#add_family_member" id="add_member" style="display: none;"></a>
<div id="add_family_member" class="modal requestbooking full-app date-modal" style="display:none;">
    <form id="add_family_member_form">
            <div class="modal-content">
                <h4 class="center-align">Add Family Member</h4>
                <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data no-right-left-padding min-height">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="firstname" name="firstname" type="text" class="validate">
                            <label for="firstname">First Name <span class="required_field">*</span></label>
                            <div class="error_class " id="err_first_name" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="lastname" name="lastname" type="text" class="validate">
                            <label for="lastname">Last Name <span class="required_field">*</span></label>
                            <div class="error_class" id="err_lastname" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="input-field selct gender-drop2">
                            <select id="gender" name="gender">
                                <option value="">Gender <span class="required_field">*</span></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="error_class" id="err_gender" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field text-bx ">
                            <input id="datepicker" name="datebirth" type="text" class="dob_datepicker dob validate">
                            <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                            <div class="error_class" id="err_datebirth" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="input-field text-bx ">
                            <input id="contact_no" name="contact_no" type="text" class="validate">
                            <label class="active" for="contact_no">Contact No. <span class="required_field">*</span></label>
                            <div class="error_class" id="err_contact_no" style="display:none;"></div>
                        </div>
                    </div>


                    <div class="col s12 m6">
                        <div class="input-field text-bx">
                            <input id="email" name="email" type="text" class="validate">
                            <label for="email">Email <span class="required_field">*</span></label>
                            <div class="error_class" id="err_email" style="display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12">
                        <div class="input-field text-bx">
                            <input id="relationship" type="text" name="relationship" class="validate">
                            <label for="relationship" class="truncate">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                            <div class="error_class" id="err_relationship" style="display:none;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
                <a href="javascript:void(0);" id="btn_close_app_family" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
                <a href="javascript:void(0);" id="submit_form" class="modal-action waves-effect waves-green btn-cancel-cons right">Add Person</a>
            </div>
    </form>

</div>

<input type="hidden" class="booking_msg" id="booking_msg" name="booking_msg" value="{{ Session::get('message') }}" style="display: none;"/>
<a class="open_booking_msg_popup" href="#show_booking_msg" style="display: none;"></a>
<div id="show_booking_msg" class="modal requestbooking" style="display: none;">
    <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
        <div class="row">
            <div class="col s12 l12">
                <div></div>
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>
    </div>
    <div class="modal-footer center-align ">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
    </div>
</div>

<script>
    $(document).ready(function () {
        var formData = new FormData();
        var booking_msg = $('#booking_msg').val();
        if(booking_msg != '')
        {
            $(".open_booking_msg_popup").click();
        }

        setTimeout(function() {
            $('.error_msg').hide();
        }, 8000);

        // number validation for contact no
        $('#contact_no').keydown(function () {
            $(this).val($(this).val().replace(/[^\d]/, ''));
            $(this).keyup(function () {
                $(this).val($(this).val().replace(/[^\d]/, ''));
            });
        });

        var user_limit = $("#user_limit").val();
        if (user_limit == 'Yes') {
            $('#btn_submit').css('display', 'none');
            $('#no_btn').css('display', 'block');
        } else {
            $('#btn_submit').css('display', 'block');
            $('#no_btn').css('display', 'none');
        }

        // if patient is selected then to get patient type
        /*$('#patient').change(function () {
            $('#user_type').val($('#patient option:selected').attr('type'));

            if ($(this).val() == "Add Family Member") {
                $("#add_member").trigger("click");
                $('#add_family_member').modal();
            }
        });*/

        $(document).on('change', '#patient', function(){
            // if patient is selected then to get patient type
            $('#user_type').val($('#patient option:selected').attr('type'));

            if ($(this).val() == "Add Family Member") {
                $("#add_member").trigger("click");
                $('#add_family_member').modal();
            }
        });

        // validation before submitting form
        $('#btn_submit').click(function () {


            var patient             = $('#patient').val();
            var user_type           = $('#user_type').val();
            var reason_for_doctor   = $(".reason_for_doctor:checked").length;
            var symptoms            = $('#symptoms').val();
            var no_emergency        = $("#no_emergency").is(":checked");
            var file_upload         = $('.upload_pic_btn').val();
            var fileExtension       = ['jpg','jpeg','png','gif','bmp'];

            var flag                = 0;



            if ($.trim(patient) == '') {
                $('#err_patient').show();
                $('#patient').focus();
                $('#err_patient').html('Please select patient');
                $('#err_patient').fadeOut(8000);
                $('html, body').animate({
                    scrollTop: $('.mar300').position().top
                }, 2000);
                flag =1;
            } else if (reason_for_doctor == 0) {
                $('#err_reason_for_doctor').show();
                $('#err_reason_for_doctor').html('Please select atleast 1 option');
                $('#err_reason_for_doctor').fadeOut(8000);
                $('html, body').animate({
                    scrollTop: $('#err_patient').position().top
                }, 2000);
                flag =1;
            }
            if ($.trim(symptoms) == '') {
                $('#err_symptoms').show();
                $('#symptoms').focus();
                $('#err_symptoms').html('Please enter symptoms');
                $('#err_symptoms').fadeOut(8000);
                $('html, body').animate({
                    scrollTop: $('#err_reason_for_doctor').position().top
                }, 2000);
                flag =1;
            }

            if (no_emergency == false) {
                $('#err_no_emergency').show();
                $('#no_emergency').focus();
                $('#err_no_emergency').html('Please select this if it is not an Emergency');
                $('#err_no_emergency').fadeOut(8000);
                $('html, body').animate({
                    scrollTop: $('#err_symptoms').position().top
                }, 2000);
                flag =1;
            }

           /* if(file_upload != '')
            {
                if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#err_upload_pic_btn').show();
                    $('.upload_pic_btn').focus();
                    $('#err_upload_pic_btn').html("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
                    $('#err_upload_pic_btn').fadeOut(8000);
                    $(".upload_pic_btn").val('');
                    flag =1;
                }
            }*/
            /*if(file_upload != '')
            {
                if(this.files[0].size > 5000000)
                {
                    $('#err_upload_pic_btn').show();
                    $('.upload_pic_btn').focus();
                    $('#err_upload_pic_btn').html('Max size allowed is 5mb.');
                    $('#err_upload_pic_btn').fadeOut(8000);
                    $(".upload_pic_btn").val('');
                    flag =1;
                }
            }*/
       
            if(flag == 1){
               return false;
            }
            else{
                var card_id              = "{{ $user_details['dump_id'] }}"
                var userkey              = "{{ $user_details['dump_session'] }}";
                var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                var api                  = virgil.API(VIRGIL_TOKEN);
                var _token               = '{{ csrf_token() }}';
                
                formData.append('_token',_token);
                formData.append('patient',patient);
                formData.append('reason_for_doctor',reason_for_doctor);
                formData.append('no_emergency',no_emergency);
                formData.append('file_upload',file_upload);
                formData.append('fileExtension',fileExtension);
                formData.append('user_type',user_type);

                // get User's card(s)
                var findkey = api.cards.get(card_id)
                .then(function (cards) {

                        if($("#advice_treatment:checked").length > 0){
                        var advice_treatment  = $("#advice_treatment:checked").val();
                        enc_advice_treatment  = encrypt(api, advice_treatment, cards);
                        //formData.append('enc_advice_treatment',enc_advice_treatment);
                         //$("#advice_treatment").val(enc_advice_treatment);
                         formData.append('advice_treatment',enc_advice_treatment);
                        }
                        if($("#prescriptions_repeats:checked").length > 0){
                        var prescriptions_repeats = $("#prescriptions_repeats:checked").val();
                        enc_prescriptions_repeats = encrypt(api, prescriptions_repeats, cards);
                        //$("#prescriptions_repeats").val(enc_prescriptions_repeats);
                         formData.append('prescriptions_repeats',enc_prescriptions_repeats);

                        }
                        if($("#medical_cetificate:checked").length > 0){
                        var medical_cetificate  = $("#medical_cetificate:checked").val();
                        enc_medical_cetificate  = encrypt(api, medical_cetificate, cards);
                        // /$("#medical_cetificate").val(enc_medical_cetificate);
                         formData.append('medical_cetificate',enc_medical_cetificate);
                        }
                        if($("#other:checked").length > 0){
                        var other = $("#other:checked").val();
                        enc_other     = encrypt(api, other, cards);
                          //$("#other").val(enc_other);
                         formData.append('other',enc_other);
                        }
                        enc_symptoms = encrypt(api, symptoms, cards);
                          //$("#symptoms").val(enc_symptoms);
                         formData.append('symptoms',enc_symptoms);

                        $.ajax({
                            url:"{{ url('/patient') }}/booking/show_available_doctors",
                            type:'post',
                            data:formData,
                            processData: false,
                            contentType: false,
                            cache:false,
                            success:function(data){
                              window.location.href = data.redirectTo;
                            }
                        });

                        /*$('#book_a_doctor_form').submit();
                        return true;*/

                }).then(null, function (error) {
                    $(".open_popup").click();
                    $('.flash_msg_text').html(error);
                    return false;
                });
                return false;
            }
        });

        // validation before submitting family member form
        $('#submit_form').click(function () {
            var firstname       = $('#firstname').val();
            var lastname        = $('#lastname').val();
            var gender          = $('#gender').val();
            var datepicker      = $('#datepicker').val();
            var email           = $('#email').val();
            var contact_no      = $('#contact_no').val();
            var relationship    = $('#relationship').val();

            var vemail_filter   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var mobile_filter   = /^[0-9]*$/;
            var alpha           = /^[a-zA-Z]*$/;

            var flag = 0;

            if ($.trim(firstname) == '') {
                $('#err_first_name').show();
                $('#err_first_name').html('Please enter first name.');
                $('#err_first_name').fadeOut(4000);
                $('#firstname').focus();
                flag = 1;
            } else if (!alpha.test(firstname)) {
                $('#err_first_name').show();
                $('#err_first_name').html('Please enter valid first name.');
                $('#err_first_name').fadeOut(4000);
                $('#firstname').focus();
                flag = 1;
            }
            if ($.trim(lastname) == '') {
                $('#err_lastname').show();
                $('#lastname').focus();
                $('#err_lastname').html('Please enter last name.');
                $('#err_lastname').fadeOut(4000);
                flag = 1;
            } else if (!alpha.test(lastname)) {
                $('#err_lastname').show();
                $('#lastname').focus();
                $('#err_lastname').html('Please enter valid last name.');
                $('#err_lastname').fadeOut(4000);
                flag = 1;
            }
            if ($.trim(gender) == '') {
                $('#err_gender').show();
                $('#gender').focus();
                $('#err_gender').html('Please select gender.');
                $('#err_gender').fadeOut(4000);
                flag = 1;
            }
            if ($.trim(datepicker) == '') {
                $('#err_datepicker').show();
                $('#datepicker').focus();
                $('#err_datepicker').html('Please enter Date of Birth.');
                $('#err_datepicker').fadeOut(4000);
                flag = 1;
            }
            if ($.trim(email) == '') {
                $('#err_email').show();
                $('#email').focus();
                $('#err_email').html('Please enter email.');
                $('#err_email').fadeOut(4000);
                flag = 1;
            } else if (!vemail_filter.test(email)) {
                $('#err_email').show();
                $('#email').focus();
                $('#err_email').html('Please enter a valid email.');
                $('#err_email').fadeOut(4000);
                flag = 1;
            }
            if ($.trim(contact_no) == '') {
                $('#err_contact_no').show();
                $('#contact_no').focus();
                $('#err_contact_no').html('Please enter contact no.');
                $('#err_contact_no').fadeOut(4000);
                flag = 1;
            } else if (!mobile_filter.test(contact_no)) {
                $('#err_contact_no').show();
                $('#contact_no').focus();
                $('#err_contact_no').html('Please enter only numbers.');
                $('#err_contact_no').fadeOut(4000);
                flag = 1;
            }
            if ($.trim(relationship) == '') {
                $('#err_relationship').show();
                $('#relationship').focus();
                $('#err_relationship').html('Please enter relationship.');
                $('#err_relationship').fadeOut(4000);
                flag = 1;
            } else if (!alpha.test(relationship)) {
                $('#err_relationship').show();
                $('#relationship').focus();
                $('#err_relationship').html('Please enter valid relationship.');
                $('#err_relationship').fadeOut(4000);
                flag = 1;
            } 

            if(flag == 0){
                
                showProcessingOverlay(); 
                var card_id              = "{{ $user_details['dump_id'] }}"
                var userkey              = "{{ $user_details['dump_session'] }}";
                var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
                var api                  = virgil.API(VIRGIL_TOKEN);
                 
                // get User's card(s)
                var findkey = api.cards.get(card_id)
                .then(function (cards) {
 
                        firstname   = firstname;
                        lastname    = lastname;
                        datepicker  = encrypt(api, datepicker, cards);
                        contact_no  = encrypt(api, contact_no, cards);

                        //console.log(firstname+' '+lastname+' '+datepicker+' '+contact_no);
                       
                        //var token = $('input[name="_token"]').val();
                        var _token  = '{{ csrf_token() }}';
                        $.ajax({
                            url: '{{ url("/") }}/patient/setting/family_members/add',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: _token,
                                firstname: firstname,
                                lastname: lastname,
                                gender: gender,
                                datebirth: datepicker,
                                email: email,
                                contact_no: contact_no,
                                user_relation: relationship
                            },
                            success: function (res) {
                                hideProcessingOverlay();
                                if (res.status) {
                                    $("#add_family_member .modal-close").click()
                                    $(".open_popup").click();
                                    $('.flash_msg_text').html(res.msg);
                                }
                            }
                        });
                  
                }).then(null, function () {
                hideProcessingOverlay();
                $(".open_popup").click();
                $('.Something went wrong').html(res.msg);
                });
            }
            else{
                return false;
            }
        });

        function encrypt(api, text, cards)
        {
          // encrypt the text using User's cards
          var encryptedMessage = api.encryptFor(text, cards);

          var encData = encryptedMessage.toString("base64");

          return encData;
        }

        $('#email').blur(function () {
            var email_id = $(this).val();
            if ($(this).val() != '') {
                $.ajax({
                    url: '{{ url("/") }}/patient/setting/check_member_mail',
                    type: 'get',
                    data: {
                        email_id: email_id
                    },
                    success: function (data) {
                        if (data.status == 'exist') {
                            $('#err_email').show();
                            $('#err_email').html('E-mail is already registered');
                            $('#err_email').fadeOut(4000);
                            $('#submit_form').addClass('disabled');
                            $('#email').focus();
                        } else {
                            $('#err_email').hide();
                            $('#err_email').html('');
                            $('#submit_form').removeClass('disabled');
                        }
                    }
                });
            } else {
                $('#email').next('label').next('span').html("");
                $('#submit_form').removeClass('disabled');
            }
        });

        $('.modal-close').click(function(){
            $('#add_family_member_form')[0].reset();
            $('#add_family_member_form label').removeClass('active');
        });

        var fileExtension = ['jpg','jpeg','png','gif','bmp'];

        $('.upload_pic_btn').on('change', function(evt) {
            if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('#err_upload_pic_btn').show();
                $('.upload_pic_btn').focus();
                $('#err_upload_pic_btn').html("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
                $('#err_upload_pic_btn').fadeOut(8000);
                $(".upload_pic_btn").val('');
                $('.upload-photo').remove();
                return false;
            }
            if(this.files[0].size > 5000000)
            {
                $('#err_upload_pic_btn').show();
                $('.upload_pic_btn').focus();
                $('#err_upload_pic_btn').html('Max size allowed is 5mb.');
                $('#err_upload_pic_btn').fadeOut(8000);
                $(".upload_pic_btn").val('');
                return false;
            }
        });

        //dropzone script with multiple files
        function readMultiUploadURL(input, formData, callback) {

            var card_id              = "{{ $user_details['dump_id'] }}"
            var userkey              = "{{ $user_details['dump_session'] }}";
            var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
            
            if (input.files) {
                var arr_img = [];
                $.each(input.files, function (index, file) {

                    var size = input.files[0].size;
                    var ext  = file.name.substring(file.name.lastIndexOf('.') + 1);

                        if(ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")   
                        {
                            alert('This file type is not supported.');

                            var reader = new FileReader();
                            reader.onload = function(e) 
                            {
                                callback(true, e.target.result);
                            }  
                            return false;
                        }
                        if( file.size >= 5000000)
                        { 
                            alert('Max size allowed is 5mb.');

                            var reader = new FileReader();
                            reader.onload = function(e) 
                            {
                                callback(true, e.target.result);
                            }  
                            return false;
                        }
                        var affected_area_file_obj = file;
                        var fileReader = new FileReader();
                        fileReader.readAsArrayBuffer(affected_area_file_obj);
                        fileReader.onload = function (e) {
                            var filename   =  affected_area_file_obj.name.split('\\').pop();
                            var imageData              = fileReader.result;
                            var fileAsBuffer           = new Buffer(imageData);
                            var api                    = virgil.API(VIRGIL_TOKEN);
                            var findkey                = api.cards.get(card_id).then(function (cards) {
                                var encryptedFile      = api.encryptFor(fileAsBuffer, cards);
                                var blob               = new Blob([encryptedFile]);
                                var affected_area_file = new File([blob], filename);
                                //console.log(affected_area_file);
                                arr_img.push(affected_area_file);
                                //console.log(arr_img);
                                formData.append('enc_imgs[]',affected_area_file);
                                // /formData.append('enc_imgs',"asdasdasd");
                            }); 
                        }
                        
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            callback(false, e.target.result);
                        }
                        reader.readAsDataURL(file);
                });
            }
            callback(true, false);
        }
        
        var arr_multiupload = $("span[data-multiupload]");


        if (arr_multiupload.length > 0) {
            $.each(arr_multiupload, function (index, elem) {
                var container_id = $(elem).attr("data-multiupload");

                var id_multiupload_img = "multiupload_img_" + container_id + "_";
                var id_multiupload_img_remove = "multiupload_img_remove" + container_id + "_";
                var id_multiupload_file = id_multiupload_img + "_file";

                var block_multiupload_src = "data-multiupload-src-" + container_id;
                var block_multiupload_holder = "data-multiupload-holder-" + container_id;
                var block_multiupload_fileinputs = "data-multiupload-fileinputs-" + container_id;

                var input_src = $(elem).find("input[data-multiupload-src]");
                $(input_src).removeAttr('data-multiupload-src')
                    .attr(block_multiupload_src, "");

                var block_img_holder = $(elem).find("span[data-multiupload-holder]");
                $(block_img_holder).removeAttr('data-multiupload-holder')
                    .attr(block_multiupload_holder, "");

                var block_fileinputs = $(elem).find("span[data-multiupload-fileinputs]");
                $(block_fileinputs).removeAttr('data-multiupload-fileinputs')
                    .attr(block_multiupload_fileinputs, "");

                $(input_src).on('change', function (event) {

                    readMultiUploadURL(event.target,formData, function (has_error, img_src) {
                        if (has_error == false) {
                            addImgToMultiUpload(img_src);
                        }
                    })
                });

                function addImgToMultiUpload(img_src) {

                    var id = Math.random().toString(36).substring(2, 10);

                    var html = '<div class="upload-photo" id="' + id_multiupload_img + id + '">' +
                        '<span class="upload-close">' +
                        '<a href="javascript:void(0)" id="' + id_multiupload_img_remove + id + '" ><i class="fa fa-trash-o"></i></a>' +
                        '</span>' +
                        '<img src="' + img_src + '" >' +
                        '</div>';

                    var file_input = '<input type="file" name="file[]" id="' + id_multiupload_file + id + '" value="" style="display:none" />';
                    $(block_img_holder).append(html);
                    $(block_fileinputs).append(file_input);

                    bindRemoveMultiUpload(id);
                }

                function bindRemoveMultiUpload(id) {
                    $("#" + id_multiupload_img_remove + id).on('click', function () {
                        $("#" + id_multiupload_img + id).remove();
                        $("#" + id_multiupload_file + id).remove();
                    });
                }


            });
        }

    });

</script>


@endsection