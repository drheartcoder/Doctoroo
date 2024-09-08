@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
    
    $first_name = isset($member_data[0]['first_name'])?$member_data[0]['first_name']:'';
    $last_name  = isset($member_data[0]['last_name'])?$member_data[0]['last_name']:'';
    $contact_no = isset($member_data[0]['mobile_number'])?$member_data[0]['mobile_number']:'';

    $sender_first_name = isset($arr_personal_details[0]['first_name'])?$arr_personal_details[0]['first_name']:'';
    $sender_last_name  = isset($arr_personal_details[0]['last_name'])?$arr_personal_details[0]['last_name']:'';
?>

<div class="header z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/setting/family_members" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">Unlink Family Member</h1>
</div>
<div class="medi minhtnor">

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel pdtbrl has-header" style="padding-bottom: 80px;!important"> -->

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
            <div class="doc-detail  left"><span class="title" id="name"></span>
<!--                 <input type="hidden" id="dec_first_name" name="" readonly="" >
                <input type="hidden" id="dec_last_name" name="" readonly="" > -->

<!--                 <input type="hidden" id="dec_sender_first_name" name="" readonly="" >
                <input type="hidden" id="dec_sender_last_name" name="" readonly="" > -->

            </div>

            <div class="clearfix"></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" value="{{$member_data[0]['email']}}" id="email" class="validate ">
                <label for="reason" class="grey-text truncate">Email <span class="required_field" style="color:red;">*</span></label>
                <span class="error"></span>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" id="contact_no" value="{{$member_data[0]['mobile_number']}}" class="validate ">
                <label for="reason" class="grey-text truncate">Phone number</label>
            </div>

        </div>
        <div class="otherdetails">
            <a class="waves-effect waves-light btn cart bluedoc-bg round-corner" value="{{$member_data[0]['id']}}" href="javascript:void(0);" id="btn_unlink_member"><span class="truncate "> Send email to unlink</span> </a>

        </div>
        <div class="clr"></div>

        <a class="open_popup_unlink" href="#unlink" style="display: none;"></a>
        <div id="unlink" class="modal requestbooking" style="display: none;">
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

</div>
<!--Container End-->
</div>

<div class="container posrel has-header has-footer">



</div>
<!--Container End-->

<!-- Data Decrypt -->
<script type="text/javascript">
var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
var dumpSessionId = '{{ $user_dumpSessionId }}';
var dumpId        = '{{ $user_dumpId }}';

function decrypt(api, enctext, key)
{
    var decrpyttext = key.decrypt(enctext);
    var plaintext = decrpyttext.toString();
    return plaintext;
}

function encrypt(api, text, cards)
{
  // encrypt the text using User's cards
  var encryptedMessage = api.encryptFor(text, cards);

  var encData = encryptedMessage.toString("base64");

  return encData;
}


$(document).ready(function(){
  
  var firstName    = '{{ $first_name }}';
  var lastName     = '{{ $last_name }}';
  var contact_no   = '{{ $contact_no }}';

  var sender_first_name   = '{{ $sender_first_name }}';
  var sender_last_name    = '{{ $sender_last_name }}';
  
  decryptMyData(virgilToken);
  
  function decryptMyData()
  {
      var api       = virgil.API(virgilToken);
      var key       = api.keys.import(dumpSessionId);

/*      var txtfirst   = decrypt(api, firstName, key);
      var txtlast    = decrypt(api, lastName, key);
      
      var sender_first    = decrypt(api, sender_first_name, key);
      var sender_last     = decrypt(api, sender_last_name, key);

      if(txtfirst != '' && txtlast != '' && sender_first != '' && sender_last != '')
      {
          $('#name').html(txtfirst+' '+txtlast);
          $('#dec_first_name').val(txtfirst);
          $('#dec_last_name').val(txtlast);

          $('#dec_sender_first_name').val(sender_first);
          $('#dec_sender_last_name').val(sender_last);
      }*/

      if(contact_no!='')
      {
          var txtcontact_no = decrypt(api, contact_no, key);
          $('#contact_no').val(txtcontact_no);
      }
  }

});


</script>

<script>
    $('#unlink .modal-close').click(function() {
        window.location.href = "{{ url('/') }}/patient/setting/family_members";
    });

    var url="<?php echo $module_url_path; ?>" ;

    var token="<?php echo csrf_token(); ?>";

    $(document).ready(function(){
        $('#btn_unlink_member').click(function(){
            var member_id  = $(this).attr('value');
            var email      = $('#email').val();
            var member_first_name = $('#dec_first_name').val();
            var member_last_name  = $('#dec_last_name').val();
            
            var sender_first_name  = $('#dec_sender_first_name').val();
            var sender_last_name   = $('#dec_sender_last_name').val();

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
            url:url+'/family_members/member_unlink_mail',
            type:'get',
            data:{  
                    member_id          : member_id,
                    email              : email,
                    member_first_name  : member_first_name,
                    member_last_name   : member_last_name,
                    sender_first_name  : sender_first_name,
                    sender_last_name   : sender_last_name
                 },
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
</script>
@endsection