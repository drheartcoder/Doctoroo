@extends('front.patient.layout._no_sidebar_master')
    @section('main_content')

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Invitations</h1>
    </div>
    <style>
        .share-links li
        {
            display: inline;
            vertical-align: top;
            margin:10px;
        }
        /*.error_class,.email_status,.datebirth_error
        {
            color:red !important;
            line-height: 35px !important;
        }*/
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
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer minhtnor "> -->
        <div class="medi ">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#family" class="active">Family &amp; Friends</a>
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
                <div id="family" class="tab-content ">
                    <h2 class="center-align bluedoc-text doctroo">Love Doctoroo?</h2>
                    <p class="center-align bluedoc-text">Invite someone you care about, So we can take care of them too!</p>

                    <div class="per50 center-align valign-wrapper">
                        <span class="left"> <img src="{{url('/')}}/public/new/images/share_link.png"></span> <span class="right marno qusame"><a href="#sharelink" class="btn cart bluedoc-bg lnht truncate round-corner">Share Link</a></span>
                    </div>
                    <div class="per50 center-align ">
                        <span class="bluedoc-text center-align">- OR -</span>
                    </div>
                    <div class="input-field">
                        <input id="referral_url" type="text" class="validate" value="{{$refererral_url}}">
                        <label for="last_name">Your Link</label>
                    </div>
                    <br>
                    <span class="right marno qusame">
                        <a href="javascript:void(0)" class="copy_link btn cart bluedoc-bg lnht truncate round-corner">Copy Link</a>
                    </span>
                    <br>
                    <div class="input-field">
                        <input id="referral_code" class="input-code" type="text" style="width: 140px;" value="{{$refererral_code}}">
                        <label for="last_name">Your Code</label>
                    </div>
                </div>
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
                            <a class="waves-effect waves-light futbtn" href="" id="invite_doctor">Invite Doctor</a>
                        </form>
                    </div>
                    <div id="pharmacy" class="tab-content">
                        <form id="invite_pharmacy_form">
                            <div class="row pdrl" >
                                <div class="col l12 m12 s12">
                                    <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                                    </span>
                                </div>
                            </div>

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
    
                            <a class="waves-effect waves-light futbtn" id="invite_pharmacy_btn" href="">Invite Pharmacy</a>
                        </form>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            <!--Container End-->

            <div id="sharelink" class="modal bottom-sheet">
                
                 <a class="modal-close bottom-modal-close-icon closeicon"><i class="material-icons">close</i></a>
                <div class="modal-data">
                    <h2>Share with</h2>
                    <div class="row marbtm">

                        <div class="col l4 m4 s4">
                            <a href="javascript:void(0)" class="copy_link center-align">
                                <img src="{{ url('/') }}/public/new/images/copy_share.svg" />
                                <small>Copy to Clipboard</small>
                            </a>
                        </div>
                        <!-- <div class="col l4 m4 s4">
                            <a href="https://twitter.com/intent/tweet?text=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url={{$refererral_url}}" class="center-align link_share twitter link_twitter">
                                <img src="{{ url('/') }}/public/images/emailer-twitter.png" />
                                <small>Twitter</small>
                            </a>
                        </div> -->
                        <div class="col l4 m4 s4">
                            <a href="https://twitter.com/intent/tweet?text=What%27s+the+best+way+to+see+a+doctor%3F+Sign+up+to+doctoroo+for+free+like+I+did%3A&url={{$refererral_url}}" class="center-align link_share twitter link_twitter">
                                <img src="{{ url('/') }}/public/images/emailer-twitter.png" />
                                <small>Twitter</small>
                            </a>
                        </div>
                        <div class="col l4 m4 s4">
                            <a href="https://www.facebook.com/sharer/sharer.php?t=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&u={{$refererral_url}}" class="center-align link_share fb fa-lg link_fb">
                                <img src="{{ url('/') }}/public/images/facebook_share.svg" />
                                <small>Facebook</small>
                            </a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col l4 m4 s4">
                            <a href="https://plus.google.com/share?prefilltext=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&quote=What%27s+the+best+way+to+see+a+doctor%3F+On+any+device%2C+anytime%2C+anywhere%21+Sign+up+to+doctoroo+for+free+like+I+did+to+see+a+doctor+online%2C+get+your+prescriptions%2C+certificates+and+medication+delivered+when+you+or+your+family+need+it+most%3A&url={{$refererral_url}}" class="center-align link_share goole-plus link_gplus">
                                <img src="{{ url('/') }}/public/new/images/gplus.svg" />
                                <small>Gmail</small>
                            </a>
                        </div>
                        <div class="col l4 m4 s4">
                            <a href="javascript:void(0);" class="center-align link_skype skype-share" data-href="{{ url('/') }}" data-lang='' data-text="What's the best way to see a doctor? On any device, anytime, anywhere! Sign up to doctoroo for free like I did to see a doctor online, get your prescriptions, certificates and medication delivered when you or your family need it most:" width='780' height='550'>
                                <img src="{{ url('/') }}/public/images/skype.png" />
                                <small>Skype</small>
                            </a>
                        </div>
                        
                    </div>
                </div>
                
            </div>

            <a class="open_pharmacy_popup" href="#show_pharmacy_msg" style="display: none;"></a>
            <div id="show_pharmacy_msg" class="modal requestbooking" style="display: none;">
               <div class="modal-data">
                  <a class="modal-close closeicon"><i class="material-icons">close</i></a>
                  <div class="row">
                     <div class="col s12 l12">
                        <div class="flash_pharmacy_msg_text center-align"></div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer center-align ">
                  <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
               </div>
            </div>

    <script>
             $('.copy_link').click(function()
             {
                $('#referral_url').val();
                $('#referral_url').select();
                document.execCommand('copy');
            });
    </script>

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
                    url:url+'/invite_pharmacy_data',
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
                        
                        $(".open_pharmacy_popup").click();
                        $('.flash_pharmacy_msg_text').html(data.msg);
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
             url:url+'/invite_doctor',
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
                $('#invite_doctor').removeClass('disabled')
                $('#doctor_invitation_form')[0].reset();
                $(".open_popup").click();
                $('.flash_msg_text').html(data.msg);
            }
        });
       });
        });

    $('#email_id').bind('keyup blur',function(){
        var email_id=$(this).val();

        $.ajax({
         url:url+'/check_doctor_invitation_mail',
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
             url:url+'/check_pharmacy_invitation_mail',
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

    $('#phone_no,#pharmacy_no').keydown(function(){
         $(this).val($(this).val().replace(/[^\d]/,''));
         $(this).keyup(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
         });
       });

    </script>

    @endsection
