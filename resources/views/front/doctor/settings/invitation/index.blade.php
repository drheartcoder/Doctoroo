@extends('front.doctor.layout.new_master')
    @section('main_content')

    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Invitations</h1>
    </div>
    <style>
        .share-links li
        {
            display: inline;
            vertical-align: top;
            margin:10px;
        }
        .required_field
        {
            color:red;
        }
        a.disabled {
           pointer-events: none;
           cursor: default;
           opacity: 0.6;
       }
    </style>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdtbrl">
        <div class="medi ">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#patient" class="active">Patient</a>
                </li>
                <li class="tab truncate">
                    <a href="#doctor">Doctor</a>
                </li>
                <li class="tab truncate">
                    <a href="#pharmacy">Pharmacy</a>
                </li>
            </ul>
            <div class="clear"></div>
            <div class="pdrl">
                <div id="patient" class="tab-content ">
                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="col l12 m12 s12">
                            <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                            </span></div>
                        </div>
                        <form id="patient_invitation_form">
                            <div class="row pdrl" style="margin-top: 20px;">
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="patient_first_name" class="validate " minlength="2" maxlength="50">
                                    <label for="patient_first_name" class="grey-text truncate">First Name<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="patient_last_name" class="validate " minlength="2" maxlength="50">
                                    <label for="patient_last_name" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                            </div>
                            <div class="row pdrl" >
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="patient_phone_no" class="validate ">
                                    <label for="patient_phone_no" class="grey-text truncate">Phone Number</label>
                                </div>
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="patient_email_id" class="validate" autocomplete="off">
                                    <label for="patient_email_id" class="grey-text truncate">Email<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                    <span class="email_status left-12px"></span>
                                </div>
                            </div>
                            <div class="row pdrl" style="margin-top: 10px;">
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="patient_address" class="validate ">
                                    <label for="patient_address" class="grey-text truncate">Address</label>
                                </div>
                            </div>
                            <a class="waves-effect waves-light futbtn space-btn-bottom " href="" id="invite_patient">Invite Patient</a>
                        </form>
                    </div>
                </div>
                <div class="pdrl">
                <div id="doctor" class="tab-content">
                    <div class="row pdrl" style="margin-top: 20px;">
                        <div class="col l12 m12 s12">
                            <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                            </span></div>
                        </div>
                        <form id="doctor_invitation_form">
                            <div class="row pdrl" style="margin-top: 20px;">
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="first_name" class="validate " minlength="2" maxlength="50">
                                    <label for="reason" class="grey-text truncate">First Name<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="last_name" class="validate " minlength="2" maxlength="50">
                                    <label for="reason" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                            </div>
                            <div class="row pdrl" >
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="phone_no" class="validate ">
                                    <label for="reason" class="grey-text truncate">Phone Number</label>
                                </div>
                                <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
                                    <input type="text" id="email_id" class="validate" autocomplete="off">
                                    <label for="reason" class="grey-text truncate">Email<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                    <span class="email_status left-12px"></span>
                                </div>
                            </div>
                            <div class="row pdrl" style="margin-top: 10px;">
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="practice_name" class="validate" minlength="2" maxlength="256">
                                    <label for="reason" class="grey-text truncate">Medical Pratice Name<span class="required_field">*</span></label>
                                    <span class="error_class  left-12px"></span>
                                </div>
                            </div>
                            <div class="row pdrl" style="margin-top: 10px;">
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="practice_addr" class="validate ">
                                    <label for="reason" class="grey-text truncate">Medical Pratice Address</label>
                                </div>
                            </div>
                            <a class="waves-effect waves-light futbtn space-btn-bottom" href="" id="invite_doctor">Invite Doctor</a>
                        </form>
                    </div>
            </div>
                   
                   <div class="pdrl">
                    <div id="pharmacy" class="tab-content">
                       <div class="row pdrl" style="margin-top: 20px;">
                                <div class="col l12 m12 s12">
                                    <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                                    </span>
                                </div>
                            </div>

                        <form id="invite_pharmacy_form">
                            
                            <div class="row pdrl" style="margin-top: 20px;">
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="pharmacy_name" class="validate " minlength="2" maxlength="50">
                                    <label for="reason" class="grey-text truncate">Enter Pharmacy Name<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                            </div>

                            <div class="row pdrl" >
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="pharmacy_no" class="validate "  maxlength="20">
                                    <label for="reason" class="grey-text truncate">Pharmacy Number<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                            </div>

                            <div class="row pdrl" >
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="pharmacy_mail" class="validate " autocomplete="off">
                                    <label for="pharmacy_mail" class="grey-text truncate">Email<span class="required_field ">*</span></label>
                                    <span class="error_class left-12px"></span>
                                    <span class="email_status left-12px"></span>
                                </div>
                            </div>

                            <div class="row pdrl" >
                                <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
                                    <input type="text" id="person_name" class="validate "  maxlength="50">
                                    <label for="reason" class="grey-text truncate">Name of contact person e.g. pharmacist, manager, etc.<span class="required_field">*</span></label>
                                    <span class="error_class left-12px"></span>
                                </div>
                            </div>
    
                            <a class="waves-effect waves-light futbtn space-btn-bottom" id="invite_pharmacy_btn" href="">Invite Pharmacy</a>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!--Container End-->

            <a class="open_invitation_popup" href="#show_invitation_msg" style="display: none;"></a>
            <div id="show_invitation_msg" class="modal addperson" style="display: none;">
               <div class="modal-data">
                  <a class="modal-close closeicon"><i class="material-icons">close</i></a>
                  <div class="row">
                     <div class="col s12 l12">
                        <div class="flash_invitation_msg_text center-align"></div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer center-align ">
                  <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
               </div>
            </div>

    <!-- share popup window start here -->
    <script>
            var popupSize = {
                width: 780,
                height: 550
            };

            $(document).on('click', '.link_share', function(e){

                var
                verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

                var popup = window.open($(this).prop('href'), 'social',
                    'width='+popupSize.width+',height='+popupSize.height+
                    ',left='+verticalPos+',top='+horisontalPos+
                    ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

                if (popup) {
                    popup.focus();
                    e.preventDefault();
                }

            });
        </script>
        <!-- share popup window end here -->

        <!-- Skype share popup window start here -->
        <script>
    // Place this code in the head section of your HTML file 
    (function(r, d, s) {
      r.loadSkypeWebSdkAsync = r.loadSkypeWebSdkAsync || function(p) {
        var js, sjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(p.id)) { return; }
        js = d.createElement(s);
        js.id = p.id;
        js.src = p.scriptToLoad;
        js.onload = p.callback
        sjs.parentNode.insertBefore(js, sjs);
    };
    var p = {
        scriptToLoad: 'https://swx.cdn.skype.com/shared/v/latest/skypewebsdk.js',
        id: 'skype_web_sdk'
    };
    r.loadSkypeWebSdkAsync(p);
    })(window, document, 'script');
    </script>

    <script>
        var url="<?php echo $module_url_path; ?>";
        $(document).ready(function(){
            $('#invite_pharmacy_btn').click(function(e){
                e.preventDefault();
                var pharmacy_name=$('#pharmacy_name').val();
                var pharmacy_no=$('#pharmacy_no').val();
                var person_name=$('#person_name').val();
                var pharmacy_mail=$('#pharmacy_mail').val();
                $('.error_class, .email_status').html('');

                if($('#pharmacy_name').val()=='')
                {
                    $('#pharmacy_name').next('label').next('span').show();
                    $('#pharmacy_name').next('label').next('span').fadeOut(4000);
                    $('#pharmacy_name').next('label').next('span').html("Please Enter Pharmacy name");
                    $('#pharmacy_name').focus();
                    return false;
                }
                else if($('#pharmacy_no').val()=='')
                {
                    $('#pharmacy_no').next('label').next('span').show();
                    $('#pharmacy_no').next('label').next('span').fadeOut(4000);
                    $('#pharmacy_no').next('label').next('span').html("Enter Pharmacy Number");
                    $('#pharmacy_no').focus();
                    return false;
                }
                else if($('#pharmacy_mail').val()=='')
                {
                    $('#pharmacy_mail').next('label').next('span').show();
                    $('#pharmacy_mail').next('label').next('span').fadeOut(4000);
                    $('#pharmacy_mail').next('label').next('span').html("Enter email address");
                    $('#pharmacy_mail').focus();
                    return false;
                }

                function isValidEmailAddress(emailAddress)
                {
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    return pattern.test(emailAddress);
                };

                var email=isValidEmailAddress(pharmacy_mail);
            
                if(email==false)
                {
                    $('#pharmacy_mail').next('label').next('span').next('.email_status').show();
                    $('#pharmacy_mail').next('label').next('span').next('.email_status').fadeOut(4000);
                    $('#pharmacy_mail').next('label').next('span').next('.email_status').html("Enter valid email");
                    $('#pharmacy_mail').focus();
                    return false;
                }
                else if($('#person_name').val()=='')
                {
                    $('#person_name').next('label').next('span').show();
                    $('#person_name').next('label').next('span').fadeOut(4000);
                    $('#person_name').next('label').next('span').html("Enter Person name");
                    $('#person_name').focus();
                    return false;
                }

                $(this).addClass('disabled');

                $.ajax({
                    url:url+'/invitation/pharmacy',
                    type:'get',
                    data:{
                        pharmacy_name:pharmacy_name,
                        pharmacy_no:pharmacy_no,
                        person_name:person_name,
                        pharmacy_mail:pharmacy_mail
                    },
                    success:function(data){
                        $('#invite_pharmacy_btn').removeClass('disabled');
                        $('#invite_pharmacy_form')[0].reset();
                        
                        $(".open_invitation_popup").click();
                        $('.flash_invitation_msg_text').html(data.msg);
                    }
                });
            });

            $('#invite_doctor').click(function(e){
                e.preventDefault();
                var first_name=$('#first_name').val();
                var last_name=$('#last_name').val();
                var phone_no=$('#phone_no').val();
                var email_id=$('#email_id').val();
                var practice_name=$('#practice_name').val();
                var practice_addr=$('#practice_addr').val();

                $('.error_class, .email_status').html('');

                if($('#first_name').val()=='')
                {
                   $('#first_name').next('label').next('span').show();
                   $('#first_name').next('label').next('span').fadeOut(4000);
                   $('#first_name').next('label').next('span').html("Please Enter first name");
                   $('#first_name').focus();
                   return false;
                }
                else if($('#last_name').val()=='')
                {
                   $('#last_name').next('label').next('span').show();
                   $('#last_name').next('label').next('span').fadeOut(4000);
                   $('#last_name').next('label').next('span').html("Enter last name");
                   $('#last_name').focus();
                   return false;
                }
                else if($('#email_id').val()=='')
                {
                   $('#email_id').next('label').next('span').show();
                   $('#email_id').next('label').next('span').fadeOut(4000);
                   $('#email_id').next('label').next('span').html("Enter email address");
                   $('#email_id').focus();
                   return false;
                }

                function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    
                    return pattern.test(emailAddress);
                };


                var email=isValidEmailAddress(email_id);
            
                if(email==false)
                {
                    $('#email_id').next('label').next('span').next('.email_status').show();
                    $('#email_id').next('label').next('span').next('.email_status').fadeOut(4000);
                    $('#email_id').next('label').next('span').next('.email_status').html("Enter valid email");
                    $('#email_id').focus();
                    return false;
                }

                if($('#practice_name').val()=='')
                {
                   $('#practice_name').next('label').next('span').show();
                   $('#practice_name').next('label').next('span').fadeOut(4000);
                   $('#practice_name').next('label').next('span').html("Enter practice name");
                   $('#practice_name').focus();
                   return false;
                }

                $(this).addClass('disabled');

                $.ajax({
                    url:url+'/invitation/doctor',
                    type:'get',
                    data:{
                        first_name:first_name,
                        last_name:last_name,
                        phone_no:phone_no,
                        email_id:email_id,
                        practice_name:practice_name,
                        practice_addr:practice_addr
                    },
                    dataType:'json',
                    success:function(data){
                        $('#invite_doctor').removeClass('disabled');
                        $('#doctor_invitation_form')[0].reset();
                        $(".open_invitation_popup").click();
                        $('.flash_invitation_msg_text').html(data.msg);
                    }
                });
            });
        });

        $('#email_id').bind('keyup blur',function(){
            var email_id=$(this).val();

            $.ajax({
                 url:url+'/invitation/doctor/check',
                 type:'get',
                 data:{email_id:email_id},
                 success:function(data){
                    if(data.status=='exist')
                    {
                        $('#email_id').next('label').next('span').html("Email address is already exist");    
                        $('#email_id').focus();
                    }
                    else
                    {
                        $('#email_id').next('label').next('span').html("");   
                    }
                 }
            });
        });

        $('#pharmacy_mail').bind('keyup blur',function(){
            var email_id=$(this).val();
            if($(this).val()!='')
            {
                $.ajax({
                 url:url+'/invitation/pharmacy/check',
                 type:'get',
                 data:{email_id:email_id},
                 success:function(data){

                    if(data.status=='exist')
                    {
                        $('#pharmacy_mail').next('label').next('span').html(data.msg);
                        $('#pharmacy_mail').focus();
                        $('#invite_pharmacy_btn').addClass('disabled');
                    }
                    else
                    {
                     $('#pharmacy_mail').next('label').next('span').html('');

                     $('#invite_pharmacy_btn').removeClass('disabled');   
                 }

             }
         });
            }
            else
            {
                $('#pharmacy_mail').next('label').next('span').html('');
                $('#invite_pharmacy_btn').removeClass('disabled');
            }    
        });

        $('#phone_no,#pharmacy_no,#patient_phone_no').keydown(function(){
            $(this).val($(this).val().replace(/[^\d]/,''));
            $(this).keyup(function(){
                 $(this).val($(this).val().replace(/[^\d]/,''));
            });
        });

    </script>

    <script>
           $(document).ready(function(){

                $('#invite_patient').click(function(e){
                    e.preventDefault();
                    var first_name=$('#patient_first_name').val();
                    var last_name=$('#patient_last_name').val();
                    var phone_no=$('#patient_phone_no').val();
                    var email_id=$('#patient_email_id').val();
                    var address=$('#patient_address').val();

                    if($('#patient_first_name').val()=='')
                    {
                       $('#patient_first_name').next('label').next('span').show();
                       $('#patient_first_name').next('label').next('span').fadeOut(4000);
                       $('#patient_first_name').next('label').next('span').html("Please Enter first name");
                       $('#patient_first_name').focus();
                       return false;
                   }
                   else if($('#patient_last_name').val()=='')
                   {
                       $('#patient_last_name').next('label').next('span').show();
                       $('#patient_last_name').next('label').next('span').fadeOut(4000);
                       $('#patient_last_name').next('label').next('span').html("Enter last name");
                       $('#patient_last_name').focus();
                       return false;
                   }
                   else if($('#patient_email_id').val()=='')
                   {
                       $('#patient_email_id').next('label').next('span').show();
                       $('#patient_email_id').next('label').next('span').fadeOut(4000);
                       $('#patient_email_id').next('label').next('span').html("Enter email address");
                       $('#patient_email_id').focus();
                       return false;
                   }

                   function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    
                    return pattern.test(emailAddress);
                    };


                    var email=isValidEmailAddress(email_id);
                
                    if(email==false)
                    {
                        $('#patient_email_id').next('label').next('span').next('.email_status').show();
                        $('#patient_email_id').next('label').next('span').next('.email_status').fadeOut(4000);
                        $('#patient_email_id').next('label').next('span').next('.email_status').html("Enter valid email");
                        $('#patient_email_id').focus();
                        return false;
                    }

                    $(this).addClass('disabled');
                
                    $.ajax({
                         url:url+'/invitation/patient',
                         type:'get',
                         data:{
                            first_name:first_name,
                            last_name:last_name,
                            phone_no:phone_no,
                            email_id:email_id,
                            address:address
                         },
                         dataType:'json',
                         success:function(data){
                                $('#invite_patient').removeClass('disabled');
                                $('#patient_invitation_form')[0].reset();
                                $(".open_invitation_popup").click();
                                $('.flash_invitation_msg_text').html(data.msg);
                         } 
                    });
                });

                $('#patient_email_id').bind('keyup blur',function(){
                    var email_id=$(this).val();
                    $.ajax({
                             url:url+'/invitation/patient/check',
                             type:'get',
                             data:{email_id:email_id},
                             success:function(data){
                                    if(data.status=='exist')
                                    {
                                        $('#patient_email_id').next('label').next('span').html("Email address is already exist");    
                                        $('#patient_email_id').focus();
                                    }
                                    else
                                    {
                                        $('#patient_email_id').next('label').next('span').html("");   
                                    }
                             }
                    });
                });
            }); 
    </script>

    @endsection
