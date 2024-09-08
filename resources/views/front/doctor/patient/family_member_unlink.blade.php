@extends('front.doctor.layout.new_master')
@section('main_content')

<div class="header bookhead">
    <div class="backarrow "><a class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">Personal Details</h1>
</div>

<!-- SideBar Section -->
@include('front.doctor.layout._new_sidebar')

<div class="header bookhead">
    <h1 class="main-title center-align">Unlink Family Member</h1>
</div>
<div class="medi minhtnor">
    <div class="container posrel pdtbrl has-header" style="padding-bottom: 80px;!important">
        <div class="valign-wrapper">
            <?php 
            if(!empty($member_data[0]['profile_img']))
            {
                $src=$profile_img_public_path.'/'.$member_data[0]['profile_img'];      
            }    
            else
            {
                $src=$profile_img_public_path.'/default-image.jpeg';
            }
            ?>    
            <div class="image-avtar marleft left"> <img src="{{$src}}" alt="" class="circle" /></div>
            <div class="doc-detail  left">
                <span class="title"> {{$member_data[0]['first_name'].' '.$member_data[0]['last_name']}}</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s6 m6 l6   setlabelhalf">
                <input type="text" value="{{$member_data[0]['email']}}" id="email" class="validate ">
                <label for="email" class="grey-text truncate">Email <span class="required_field" style="color:red;">*</span></label>
                <span class="error"></span>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf">
                <input type="text" id="mobile_number" class="validate" value="">
                <label for="mobile_number" class="grey-text truncate">Phone number</label>
            </div>
        </div>

        <div class="otherdetails">
            <a class="waves-effect waves-light btn cart bluedoc-bg round-corner" value="{{$member_data[0]['id']}}" href="javascript:void(0);" id="btn_unlink_member"><span class="truncate "> Send email to unlink</span> </a>

        </div>
        <div class="clr"></div>

        <a class="open_popup_unlink" href="#unlink" style="display: none;"></a>
        <div id="unlink" class="modal addperson" style="display: none;">
                <div class="modal-content">
                    <h4 class="center-align" id="mail_send_title"></h4>
                    <a class="modal-close closeicon"><i class="material-icons">close</i></a>
                </div>
                <div class="modal-data">
                    <div class="row">
                        <div class="col s12 l12 m12">
                            <span id="mail_success" style="display: none;">
                                <p>An email has been sent to the email address you entered</p>
                                <p>Once confirmed by the recipient, their details will moved to their new, independent account and you will no longer be able to access their details.</p>
                            </span>
                            <span id="mail_failure" style="display: none;">
                             <p>Something went to wrong</p> 
                         </span>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                <div class="modal-footer center-align ">
                    <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn" id="ok_btn" style="display: none;">OK</a>
                </div>
            </div>
        </div>
</div>
<!--Container End-->
</div>

<div class="container posrel has-header has-footer">

</div>

<script>
    $('#unlink .modal-close').click(function() {
        window.location.href = "{{ url('/') }}/doctor/patients/details/{{$enc_patient_id}}";
    });

    var url="<?php echo $module_url_path; ?>" ;

    var token="<?php echo csrf_token(); ?>";

    $(document).ready(function(){
        $('#btn_unlink_member').click(function(){
            var member_id=$(this).attr('value');
            var email=$('#email').val();
            var enc_patient_id="<?php echo $enc_patient_id; ?>";
            if($('#email').val()=='')
            {
                $('.error').html('Please enter email').css('color','red');
                return false;
            }

            function isValidEmailAddress(emailAddress) {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            return pattern.test(emailAddress);
        };

        var email_check=isValidEmailAddress(email);

        if(email_check==false)
        {
            $('.error').html('Enter valid email').css('color','red');
            return false;
        }
        $('#btn_unlink_member').attr('disabled',true);
        
        $.ajax({
            url:url+'/patients/family_members/member_unlink_mail',
            type:'get',
            data:{enc_patient_id:enc_patient_id,member_id:member_id,email:email},
            success:function(data){
              
              if(data.status=='success')
              {
                $('#mail_send_title').html(data.msg);
                $(".open_popup_unlink").click();
                $('#mail_success').show();
            }  
            else
            {
                $('#mail_failure').html(data.msg);
                $(".open_popup_unlink").click();
                $('#mail_failure').show();   
            }
            $('#ok_btn').show();
        }
    });
    });
    });


    var card_id      = "{{isset($member_data[0]['userinfo']['dump_id']) && !empty($member_data[0]['userinfo']['dump_id']) ? $member_data[0]['userinfo']['dump_id'] : ''}}";
    var userkey      = "{{isset($member_data[0]['userinfo']['dump_session']) && !empty($member_data[0]['userinfo']['dump_session']) ? $member_data[0]['userinfo']['dump_session'] : ''}}";
    var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
    var api          = virgil.API(VIRGIL_TOKEN);
    var key          = api.keys.import(userkey);
    var mobile_number = "{{isset($member_data[0]['mobile_number']) && !empty($member_data[0]['mobile_number']) ? $member_data[0]['mobile_number'] : ''}}";

    if(mobile_number != ""){
        var dec_mobile_number   = key.decrypt(mobile_number).toString();
        $('#mobile_number').val(dec_mobile_number);
    }
</script>
@endsection