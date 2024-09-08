@extends('front.layout.master-coming-soon')
@section('main_content')
<style>
  .logout-banner h2 {
    color: #50AB50;
    font-family: "robotomedium",sans-serif;
    font-size: 35px;
    text-shadow: 1px 0 3px rgba(0, 0, 0, 0.53);
    text-transform: uppercase;
}
</style>
<div class="banner-home inner-page-box">
   <div class="logout-banner">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="thanks-banner">
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="password_set_model" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
    <div class="modal-dialog loign-insw">
        <!-- Modal content-->
        <div class="modal-content logincont">
            <div class="modal-header head-loibg">
                <button type="button" class="login_close close" data-dismiss="modal">
                <img src="{{ url('/') }}/public/images/close-popup.png" alt="">
                </button>
            </div>
            <div class="modal-body bdy-pading">
                        <div class="alert-box alert_error alert-dismissible" id="patient_err_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span style="font-size: 20px;">×</span></button>    
                        </div>

                         <div class="alert-box success alert-dismissible" id="patient_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span style="font-size: 20px;">×</span></button>    
                        </div>

                        <form name="frm_password_set" id="frm_password_set" method="post">
                            {{ csrf_field() }}
                            <div class="login_box">
                                <div class="title_login">Set Details</div>
                                @if($password_status=='not_set')
                                    <div class="tag-txt">Get started as a Patient</div>
                                    
                                    <center><p class="set_password_status"></p></center>
                                    <div class="user_box">
                                        <select name="mobile_no_code" class="form-control" id="mobile_no_code">
                                              <option value="" selected>Country Code</option>
                                              @if(isset($mobcode_data) && !empty($mobcode_data))
                                                  @foreach($mobcode_data as $mobcode)
                                                      <option value="{{ $mobcode['id'] }}" @if($mobcode['id'] == '13') selected  @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                                  @endforeach
                                              @endif
                                        </select> 
                                        <div class="err error_class" id="mobile_no_code_err"></div>
                                    </div>
                                    <div class="user_box">
                                        <input type="text" class="input_acct-logn"  placeholder="Mobile No." name="mobile_no_set" id="mobile_no_set" value="" />
                                        <div class="err error_class" id="mobile_no_err"></div>
                                    </div>
                                    <div class="user_box">
                                        <input type="password" class="input_acct-logn"  placeholder="Password" name="password_set" id="password_set" value="" />
                                        <div class="err error_class" id="password_err"></div>
                                    </div>

                                    <div class="user_box">
                                        <input type="password" class="input_acct-logn"  placeholder="Re - Password" name="password_set" id="re_password" value="" />
                                        <div class="err error_class" id="password_err"></div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <div class="login-bts">
                                        <button type="button" class="btn btn-search-login" value="{{$user_id}}" type="button" name="member_password_set" id="member_password_set">Save</button>
                                    </div>
                                @elseif($password_status=='already_set')
                                    <h5>Your Password has been set already! You can't set again</h5>
                                    <br>
                                    <button type="button" class="login_close close btn btn-search-login" value="{{$user_id}}" type="button"  data-dismiss="modal" >Ok</button>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="forget-pass">
                                        <a data-toggle="modal" href="#forgetpwd" class="forgetpwd">Forgot Password?</a>
                                    </div>
                                @endif
                            
                                <div class="main-social text-center">
                                    <br/>
                                    <br/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
$('#password_set_model').modal('show');
});
</script>

<script>
    var url="<?php echo $module_path; ?>" ;
    var redirect_url="<?php echo url(''); ?>";
    var token="<?php echo csrf_token(); ?>";

            $(document).ready(function(){
                $('#member_password_set').click(function(e){
                    e.preventDefault();
                    $('#password_err').html('');

                    $('.set_password_status').html("");

                    var user_id        =$(this).attr('value');
                    var password       =$('#password_set').val();
                    var mobile_no_code =$('#mobile_no_code').val();
                    var mobile_no      =$('#mobile_no_set').val();


                    $('.error_class').html("");
                    if($('#mobile_no_code').val()=='')
                    {
                        $('#mobile_no_code').next('.error_class').show();
                        $('#mobile_no_code').next('.error_class').fadeOut(4000);
                        $('#mobile_no_code').next('.error_class').html("Please Select Country Code");
                        return false;
                    }
                    if($('#mobile_no_set').val()=='')
                    {
                        $('#mobile_no_set').next('.error_class').show();
                        $('#mobile_no_set').next('.error_class').fadeOut(4000);
                        $('#mobile_no_set').next('.error_class').html("Please Enter Mobile number");
                        return false;
                    }
                    if($('#password_set').val()=='')
                    {
                        $('#password_set').next('.error_class').show();
                        $('#password_set').next('.error_class').fadeOut(4000);
                        $('#password_set').next('.error_class').html("Please Enter Password");
                        return false;
                    }
                    else if($('#password_set').val().length<6)
                    {
                         $('#password_set').next('.error_class').show();
                         $('#password_set').next('.error_class').fadeOut(6000);
                         $('#password_set').next('.error_class').html('Password must be 6 or more that 6 characters');
                         return false;
                    }
                    else if($('#re_password').val()=='')
                    {
                        $('#re_password').next('.error_class').show();
                        $('#re_password').next('.error_class').fadeOut(6000);
                        $('#re_password').next('.error_class').html("Please Enter Re - Password");
                        return false;
                    }
                    else if($('#re_password').val().length<6)
                    {
                         $('#re_password').next('.error_class').show();
                         $('#re_password').next('.error_class').fadeOut(6000);
                         $('#re_password').next('.error_class').html('Password must be 6 or more that 6 characters');
                         return false;
                    }
                    else if($('#re_password').val() != password)
                    {
                      $('#re_password').next('.error_class').show();
                      $('#re_password').next('.error_class').fadeOut(6000);
                      $('#re_password').next('.error_class').html("Both Password doesn't match");
                      return false;
                    }
                    
                    showProcessingOverlay();
                    
                    $.ajax({
                         url:url+'/family_members/account_details_set',
                         type:'get',
                         data:{user_id:user_id,password:password,mobile_no_code:mobile_no_code,mobile_no:mobile_no},
                         success:function(res){

                            hideProcessingOverlay();

                            if(res.status == 'success'  && res.otp_id !='0')
                              {
                                 
                                 $('#otp_id').val(res.otp_id);
                                 $('#password').val(res.password);
                                 $('#email').val(res.email);
                                 $('#verify_otp').modal('show');
                              }
                              else if(res.status == 'error')
                              {
                                  $('.set_password_status').fadeIn(0, function()
                                   {
                                       $('.set_password_status').html(res.msg).css('color','red');
                                   }).delay(5000).fadeOut('slow');
                              }
                              else if(res.otp_id == '0')
                              {
                                    $('.set_password_status').fadeIn(0, function()
                                   {
                                       $('.set_password_status').html(res.msg).css('color','red');
                                   }).delay(5000).fadeOut('slow');
                              }
                         }
                    });
                });

                 $('#mobile_no_set').keydown(function(){
                   $(this).val($(this).val().replace(/[^\d]/,''));
                   $(this).keyup(function(){
                       $(this).val($(this).val().replace(/[^\d]/,''));
                   });
                 });

                 $('#mobile_no_set').blur(function(){
                    var mobile_no = $(this).val();
                    var _token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:url+'/family_members/mobile_no_check',
                        type:'post',
                        data:{_token:_token,mobile_no:mobile_no},
                        success:function(data){
                            if(data.status == 'error')
                            {
                               $('#mobile_no_set').next('.error_class').html(data.msg);
                               $('#mobile_no_set').focus();
                            }
                            else
                            {
                              $('#mobile_no_set').next('.error_class').html('');
                            }
                        }
                    });
                 });

            });
    </script>
@stop

