@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
    <div class="medi marmain">
            <style>
               /* .error_class,.email_status,.datebirth_error
                {
                    color:red !important;
                    line-height: 35px !important;
                }*/
                .require_field
                {
                    color:red;
                }
               a.disabled
               {
                   pointer-events: none;
                   cursor: default;
                   opacity: 0.6;
                } 
            </style>
	<div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Invite Pharmacy</h1>
    </div>
    <div class="container posrel pdtbrl has-header minhtnor has-footer">
    <form id="invite_pharmacy_form">
        <div class="row pdrl" style="margin-top: 20px;">
            <div class="col l12 m12 s12">
                <span class="green-text">Please enter the details you know and we'll do our best to locate them.
                </span>
            </div>
        </div>

        <div class="row pdrl" style="margin-top: 20px;">
            <div class="input-field col s12 m12 l12   setlabel">
                <input type="text" id="pharmacy_name" class="validate ">
                <label for="reason" class="grey-text truncate">Enter Pharmacy Name<span class="require_field">*</span></label>
                 <span class="error_class"></span>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12   setlabel">
                <input type="text" id="pharmacy_no" class="validate ">
                <label for="reason" class="grey-text truncate">Pharmacy Number<span class="require_field">*</span></label>
                 <span class="error_class"></span>
            </div>
        </div>

        <div class="row pdrl">
            <div class="input-field col s12 m12 l12   setlabel">
                <input type="text" id="pharmacy_mail" class="validate " autocomplete="off">
                <label for="reason" class="grey-text truncate">Email<span class="require_field">*</span></label>
                 <span class="error_class"></span>
                 <span class="email_status"></span>
            </div>
        </div>

        <div class="row pdrl">
            <div class="input-field col s12 m12 l12   setlabel">
                <input type="text" id="person_name" class="validate ">
                <label for="reason" class="grey-text truncate">Name of contact person e.g. pharmacist, manager, etc.<span class="require_field">*</span></label>
                 <span class="error_class"></span>
            </div>
        </div>
        
                <a class="waves-effect waves-light futbtn" id="invite_pharmacy_btn" href="#">Invite Pharmacy</a>
        </form>
    </div>
    </div>

<script>
var url="<?php echo $module_url_path; ?>";
$(document).ready(function(){
	$('#invite_pharmacy_btn').click(function(){
		var pharmacy_name=$('#pharmacy_name').val();
		var pharmacy_no=$('#pharmacy_no').val();
		var person_name=$('#person_name').val();
		var pharmacy_mail=$('#pharmacy_mail').val();
        $('.error_class, .email_status').html('');

        if($('#pharmacy_name').val()=='')
        {
            $('#pharmacy_name').next('label').next('span').html("Please Enter Pharmacy name");
            return false;
        }
        else if($('#pharmacy_no').val()=='')
        {
            $('#pharmacy_no').next('label').next('span').html("Enter Pharmacy Number");
            return false;
        }
        else if($('#pharmacy_mail').val()=='')
        {
            $('#pharmacy_mail').next('label').next('span').html("Enter email address");
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
            $('#pharmacy_mail').next('label').next('span').next('span').html("Enter valid email");
            return false;
       }
        else if($('#person_name').val()=='')
        {
            $('#person_name').next('label').next('span').html("Enter Person name");
            return false;
        }
         
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
                $('#invite_pharmacy_form')[0].reset();
                  $(".open_popup").click();
                 $('.flash_msg_text').html(data.msg);
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
                    $('#invite_pharmacy_btn').addClass('disabled');
                }
                else
                {
                 $('#pharmacy_mail').next('label').next('span').html("");   
                 $('#invite_pharmacy_btn').removeClass('disabled');
                }
            }
        });
    }
    else
    {
        $('#pharmacy_mail').next('label').next('span').html("");   
        $('#invite_pharmacy_btn').removeClass('disabled');
    }
});

    $('#pharmacy_no').keydown(function(){
         $(this).val($(this).val().replace(/[^\d]/,''));
         $(this).keyup(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
         });
       });

});
</script>
    @endsection