@extends('admin.layout.master')    

@section('main_content')
    
    <style>
        .error
        {
            color:red;
        }
    </style>
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span> 
            <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>{{ isset($page_title)?$page_title:"" }} </h3>
                    <div class="box-tool"></div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')

                      <form method="post" action="{{ url($module_url_path.'/update/'.base64_encode($arr_data['id']))}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-sm-3 col-lg-2 control-label">Image:</label>
                          <div class="col-sm-9 col-lg-2 controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                    @if(isset($admin_img_path) && isset($arr_data['profile_pic']))
                                      <img src="{{$admin_img_path.'/public'.$arr_data['profile_pic']}}" alt="" />
                                    @endif
                                </div>
                                <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file" style="height:32px;">
                                      <span class="fileupload-new">Select Image</span>
                                      <span class="fileupload-exists">Change</span>
                                      <input type="file" class="file-input" name="image" id="image"  />
                                      <input type="hidden" class="form-control" name="image" id="oldprofileimage" value="" />
                                    </span>
                                    <a href="#" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                <div class="err" style="display: none; color: red;" id="err_image_file"></div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"></label>
                            <div class="col-sm-9 col-lg-4 controls">
                            <span class="label label-important">NOTE!</span>
                                <span>Image Format: jpeg,png,gif and Size should be less than or equalto 300px*300px.</span>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="old_profile_image" value="{{isset($arr_data['profile_pic'])?$arr_data['profile_pic']:''}}" />
                          <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">First Name<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                            <input type="text" name="first_name" id="first_name" value="{{ isset($arr_data['user_details']['first_name'])?$arr_data['user_details']['first_name']:'' }}" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="First Name">   
                            <span class='help-block'>{{ $errors->first('first_name') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Last Name<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                              <input type="text" name="last_name" id="last_name" value="{{ isset($arr_data['user_details']['last_name'])?$arr_data['user_details']['last_name']:'' }}" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Last Name">   
                              <span class='help-block'>{{ $errors->first('last_name') }}</span>
                            </div>
                        </div>
                        <?php 
                            $admin_email = "";
                            $user = Sentinel::check();
                            if($user)
                            {
                              $admin_email = $user->email;
                            }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Email<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                             <input type="text" name="email" id="email" value="{{ isset($admin_email)?$admin_email:'' }}" class="form-control" data-rule-required="true" data-rule-email="true" data-rule-maxlength="255" placeholder="Email"> 
                             <span class='help-block'>{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Contact Email<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                  <input type="text" class="form-control" name="contact_email" id="contact_email" value="{{ isset($arr_data['contact_email'])?$arr_data['contact_email']:'' }}" data-rule-required="true" data-rule-email="true"  />
                                <span class='error'>{{ $errors->first('contact_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Contact Number<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                 
                                  <input type="text" class="form-control" name="contact_no" id="contact_no" data-no-type='contact' data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-msg-minlength="Contact no should be atleast 6 digits" data-msg-maxlength="Contact no should not be more than 16 digits"  value="{{isset($arr_data['contact_no'])?$arr_data['contact_no']:''}}"/>
                                <span class='error err'>{{ $errors->first('contact_no') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Mobile Number<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                 
                                  <input type="text" class="form-control" name="mobile_no" data-no-type='mobile' id="mobile_no" data-rule-required="true" data-rule-maxlength="16" data-msg-minlength="Mobile no should be atleast 6 digits" data-msg-maxlength="Mobile no should not be more than 16 digits" data-rule-minlength="6" value="{{isset($arr_data['mobile_no'])?$arr_data['mobile_no']:''}}"/>
                                <span class='error err'>{{ $errors->first('mobile_no') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Fax</label>
                            <div class="col-sm-9 col-lg-4 controls">
                                  <input type="text" class="form-control" name="fax" id="fax" data-rule-number="true" data-rule-maxlength="16" data-msg-minlength="Fax no should be atleast 6 digits" data-msg-maxlength="Fax no should not be more than 16 digits" data-rule-minlength="6" value="{{isset($arr_data['fax'])?$arr_data['fax']:''}}"/>
                                <span class='error'>{{ $errors->first('fax') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Address<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">

                                <textarea class="form-control" name="address" data-rule-required="true">{{isset($arr_data['address'])?$arr_data['address']:''}}</textarea>
                                
                                <span class='error'>{{ $errors->first('address') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">ABN<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                 
                                  <input type="text" class="form-control" name="abn" id="abn" data-rule-required="true"  data-rule-maxlength="11"  value="{{isset($arr_data['abn'])?$arr_data['abn']:''}}"/>
                                <span class='error err'>{{ $errors->first('abn') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">ACN<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                  <input type="text" class="form-control" name="acn" id="acn" data-rule-required="true"  data-rule-maxlength="11"  value="{{isset($arr_data['acn'])?$arr_data['acn']:''}}"/>
                                <span class='error err'>{{ $errors->first('acn') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                               <input  style="visibility: hidden;" type="submit" name="btn_update" id="btn_update" class="btn btn-success" value="Update">
                               <input type="submit" class="btn btn-primary" name="btn_send_otp" id="btn_send_otp" value="Update">
                               <button type="submit" class="btn btn-success" id="btn_send_otp_spinner" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button>


                            </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    
    <!-- END Main Content --> 
<!-- Otp Send -->
<div id="verify_otp" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal">
            <img src="{{ url('/') }}/public/images/close-popup.png" alt="">
            </button>
         </div>

         <div class="modal-body bdy-pading">
             <br/>
               <div class="alert-box alert_error alert-dismissible" id="admin_error_msg" style="display: none;color:red">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>

                <div class="alert-box alert_success alert-dismissible" id="admin_success_msg" style="display: none;color:green">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>
               <form>
               <div class="login_box">
                  <div class="title_login">Verify OTP</div>
                  <div class="tag-txt">Check your registered mobile number</div>
                  <div class="user_box">
                     <input type="text" class="input_acct-logn" placeholder="Enter OTP" name="otp" id="otp"  value="" maxlength="6" >
                     <div class="otp_err" style="color:red;"></div>
                  </div>
                  
                  <div class="clearfix"></div>
                  <div class="login-bts">
                     <button class="btn btn-search-login border-btn-radius" value="" type="button" id="btn_verify_otp" >Verify OTP</button>
                  </div>

                  <div class="already-txt">
                         Didn't get OTP ? <a data-toggle="modal" href="" id="btn_resend_otp">Resend</a>
                      </div>
                  
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
<!-- End Otp Send -->

<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="email" id="email" value="{{ $user->email }}">

<script>
    $(document).ready(function(){
      $('#btn_send_otp').click(function(){
         //$('#btn_edit_patient').click();
         var url               = "{{ url('/') }}/admin/patient/send_otp_by_ajax";
         var _token            = $('input[name="_token"]').val();
         $.ajax({
            url: url,
            type: 'POST',        
            data:{_token:_token}, 
            beforeSend: function() 
            {
               $('#btn_send_otp_spinner').show();
               $('#btn_send_otp').hide();
            },
            success: function(res)   
            {
              if(res == 'success'){
               $("#verify_otp").modal('show');    
               $('#btn_send_otp_spinner').hide();
               $('#btn_send_otp').show(); 
              }else{
               alert('somethig went wrong......');
              }        
            }
         });
         return false;
      });

      $('#mobile_no,#contact_no,#fax').keydown(function(){
        if (this.value.match(/[^0-9+]/g)) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        }
      });

      // Allow only Alphabet Characters
      $('#first_name,#last_name').keyup(function() {
          if (this.value.match(/[^a-zA-Z]/g)) {
              this.value = this.value.replace(/[^a-zA-Z]/g, '');
          }
      });

      // check file extension and size of upload file
      var fileExtension = ['jpg','jpeg','png','gif','bmp'];
      $('#image').on('change', function(evt) {
          if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              $('#err_image_file').show();
              $('#image').focus();
              $('#err_image_file').html("Please upload valid image with valid extension i.e "+fileExtension.join(', '));
              $('#err_image_file').fadeOut(4000);
              $("#image").val('');
              return false;
          }
          if(this.files[0].size > 5000000)
          {
              $('#err_image_file').show();
              $('#image').focus();
              $('#err_image_file').html('Max size allowed is 5mb.');
              $('#err_image_file').fadeOut(4000);
              $("#image").val('');
              return false;
          }

            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width  = this.width;
                    if (height > 300 && width > 300) {
                        $('#err_image_file').show();
                        $('#image').focus();
                        $('#err_image_file').html('Image not allow greater than 300 x 300 diamentions.');
                        $('#err_image_file').fadeOut(4000);
                        $("#image").val('');
                        return false;
                        //clearFileInput(document.getElementById("image"));
                        
                        //event.preventDefault(); 
                    }
                };
 
            }


      });

   });
</script>
<script>
    var url = "<?php echo url(''); ?>";
    $(document).ready(function(){

        $('#btn_verify_otp').click(function(){
            
            var otp    = $('#otp').val();
            otp_id     = $('#otp_id').val();
            password   = $('#password').val();
            email      = $('#email').val();
            
            if($('#otp').val()== '' || $('#otp').val() == null)
            {
                $('.otp_err').show();
                $('.otp_err').html("Please enter OTP that is sent on your registered mobile no.");
                $('.otp_err').fadeOut(6000);
                return false;
            }
            else if($('#otp').val().length != 6)
            {
                $('.otp_err').show();
                $('.otp_err').html("Invalid OTP, Must have 6 digits");
                $('.otp_err').fadeOut(4000);
                return false;
            }

            $.ajax({
                url:url+'/admin/verify_otp_by_ajax',
                type:'get',
                data:{
                        otp:otp,
                        otp_id:otp_id,
                        email:email,
                        password:password
                     },
                success:function(res){              
                    if(res.status=="success")
                    { 
                        if(res.msg=='')
                        {
                           $('#btn_update').click();
                        }
                        else
                        {
                            $('#admin_error_msg').fadeIn(0, function()
                            {
                                $('#admin_error_msg').html(res.msg);
                            }).delay(6000).fadeOut('slow');
                        }
                    }
                    else if(res.status=="error" && res.msg!='')
                    {
                        $('#admin_error_msg').fadeIn(0, function()
                        {
                          $('#admin_error_msg').html(res.msg);
                        }).delay(6000).fadeOut('slow');
                    }
                }
            });
        });

        $('#btn_resend_otp').click(function(){
            var otp   = $('#otp').val();
            var email = $('#email').val();


            $.ajax({
                url:url+'/admin/resend_otp',
                type:'get',
                data:{otp:otp,email:email},
                success:function(data){
                    $('#otp_id').val(data.otp_id);
                    $('#admin_success_msg').fadeIn(0, function()
                    {
                        $('#admin_success_msg').html(data.msg);
                    }).delay(6000).fadeOut('slow');
                }
            });
        });

        $('#otp').keypress(function(e){
            
            if(e.keyCode == '13')
            {
                e.preventDefault();
                $('#btn_verify_otp').click();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#contact_no, #mobile_no').blur(function(){
            var a = $(this).val();
            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
             if (filter.test(a)) {
                $(this).closest('div').find('.err').html('');
                return true;
             }
            else 
            {
                if($(this).val() != '' && $(this).val().length > 5)
                {
                    var no_type = $(this).attr('data-no-type');
                    $(this).closest('div').find('.err').html('Invalid '+no_type+' Number');
                    $(".close").click();
                    return false;    
                }
                else
                {
                    $(this).closest('div').find('.err').html('');
                }
            }

       });
    });
    $(document).ready(function(){    
        $("#validation-form").validate({
          rules: {
            first_name: { lettersonly: true },
            last_name: { lettersonly: true }
          }
        });    

    });

    

</script>

@endsection