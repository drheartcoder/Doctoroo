@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
 
<div class="medi">
<style>
.error,.required_field
{
    color:red;
}
</style>

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/email_and_password" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Password Reset</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header minhtnor has-footer"> -->
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel errorchangesdd" style="margin-top: 30px;">
                <input type="password" id="old_password" class="validate "  >
                <label for="reason" class="grey-text truncate">Enter Old Password <span class="required_field">*</span></label>
                <span class="error"></span>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel errorchangesdd" style="margin-top: 30px;">
                <input type="password" id="password" class="validate "  >
                <label for="reason" class="grey-text truncate">Enter New Password <span class="required_field">*</span></label>
                <span class="error"></span>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel errorchangesdd" style="margin-top: 30px;">
                <input type="password" id="re_password" class="validate "  >
                <label for="reason" class="grey-text truncate">Re - enter New Password <span class="required_field">*</span></label>
                <span class="error"></span>
            </div>
        </div>
        <div class="otherdetails">
            <a class="waves-effect waves-light btn cart bluedoc-bg round-corner center-align " id="save_password" href="">Save Password</a>
        </div>

        </div>
    </div>

</div>

<script>
var url="<?php echo $module_url_path; ?>" ;
$(document).ready(function(){
    $('#save_password').click(function(e){
        e.preventDefault();
        var old_password = $('#old_password').val();
        var password = $('#password').val();
        var re_password = $('#re_password').val();

        $('.error').html("");
            if($('#old_password').val()=='')
            {
                $('#old_password').next('label').next('span').html("Please enter Old password");
                $('#old_password').focus();
                return  false;
            }
            else if($('#password').val()=='')
            {
                $('#password').next('label').next('span').html("Please enter password");
                $('#password').focus();
                return  false;
            }
            else if($('#password').val().length<6)
            {
                $('#password').next('label').next('span').html("Password should be 6 or more that 6 characters");
                $('#password').focus();
                return  false;
            }
            else if(old_password == password)
            {
                $('#password').next('label').next('span').html("Old and new Password should not be same");
                $('#password').focus();
                return  false;
            }
            else if($('#re_password').val()=='')
            {
                $('#re_password').next('label').next('span').html("Please enter re-password");
                $('#re_password').focus();
                return  false;
            }
            else if($('#re_password').val().length<6)
            {
                $('#re_password').next('label').next('span').html("Password should be 6 or more that 6 characters");
                $('#re_password').focus();
                return  false;
            }

           if(password!=re_password)
            {
                $('#re_password').next('label').next('span').html("Both passwords don't match");
                 return false;
            }     

            $.ajax({
                    url:url+'/password_reset_data',
                    type:'get',
                    data:{password:password,old_password:old_password},
                    dataType:'json',
                    success:function(data){
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }

            });

    });
});
</script>

@endsection
