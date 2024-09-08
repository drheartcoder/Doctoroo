@extends('front.doctor.layout.new_master')
@section('main_content')
 
<div class="medi">
<style>
.error,.required_field
{
    color:red;
}
</style>
    
    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ $module_url_path }}/email_and_password" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Password Reset</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <form action="{{ url('/') }}/doctor/settings/password/update" method="POST" id="reset_password_form">
        {{ csrf_field() }}
            <div class="row pdrl">
                <div class="input-field col s12 m12 l12  setlabel errormed-docs" style="margin-top: 30px;">
                    <input type="password" id="old_password" name="old_password" class="validate">
                    <label for="old_password" class="grey-text truncate">Enter Old Password <span class="required_field">*</span></label>
                    <span class="error"></span>
                </div>
            </div>
            <div class="row pdrl">
                <div class="input-field col s12 m12 l12  setlabel errormed-docs" style="margin-top: 30px;">
                    <input type="password" id="password" name="password" class="validate "  >
                    <label for="password" class="grey-text truncate">Enter New Password <span class="required_field">*</span></label>
                    <span class="error"></span>
                </div>
            </div>
            <div class="row pdrl">
                <div class="input-field col s12 m12 l12  setlabel errormed-docs" style="margin-top: 30px;">
                    <input type="password" id="re_password" name="re_password" class="validate "  >
                    <label for="re_password" class="grey-text truncate">Re - enter New Password <span class="required_field">*</span></label>
                    <span class="error"></span>
                </div>
            </div>
            <div class="otherdetails">
                <button type="submit" class="waves-effect waves-light btn cart bluedoc-bg round-corner center-align" id="save_password" style="cursor: pointer;">Save Password</button>
            </div>
        </form>
    </div>
    </div>

</div>


<input type="hidden" id="status_msg" name="status_msg" value="{{ Session::get('message') }}" style="display: none;"/>
<a class="open_status_msg_popup" href="#status_msg_popup" style="display: none;"></a>
<div id="status_msg_popup" class="modal addperson" style="display: none;">
    <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
        <div class="row">
            <div class="col s12 l12">
                <div style="text-align: center;">{{ Session::get('message') }}</div>
                <!-- <p>{{ Session::get('message') }}</p> -->
            </div>
        </div>
    </div>
    <div class="modal-footer center-align ">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
    </div>
</div>

<script>
var url = "<?php echo $module_url_path; ?>" ;
$(document).ready(function(){
    var status_msg = $('#status_msg').val();
    if(status_msg != '')
    {
        $(".open_status_msg_popup").click();
    }


    $('#save_password').click(function(e){
        e.preventDefault();
        var old_password = $('#old_password').val();
        var password = $('#password').val();
        var re_password = $('#re_password').val();

            $('.error').html("");
            if($('#old_password').val() == '')
            {
                $('#old_password').next('label').next('span').html("Please enter Old password");
                $('#old_password').focus();
                return  false;
            }
            else if($('#password').val() == '')
            {
                $('#password').next('label').next('span').html("Please enter password");
                $('#password').focus();
                return  false;
            }
            else if($('#password').val().length < 6)
            {
                $('#password').next('label').next('span').html("Password should be 6 or more that 6 characters");
                $('#password').focus();
                return  false;
            }
            else if($('#re_password').val() == '')
            {
                $('#re_password').next('label').next('span').html("Please enter re-password");
                $('#re_password').focus();
                return  false;
            }
            else if($('#re_password').val().length < 6)
            {
                $('#re_password').next('label').next('span').html("Password should be 6 or more that 6 characters");
                $('#re_password').focus();
                return  false;
            }
            else if(password != re_password)
            {
                $('#re_password').next('label').next('span').html("Both passwords don't match");
                return false;
            }
            else
            {
                $('#reset_password_form').submit();
            }

    });
});
</script>

@endsection
