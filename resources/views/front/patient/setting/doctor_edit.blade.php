@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
 <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/family_doctors" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Edit Doctor Details</h1>
    </div>
    <div class="medi">
          <style>
          .error
          {
            color:red;
          }
          </style>

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';

    $first_name = isset($family_doctor->first_name) ? $family_doctor->first_name : '';
    $last_name  = isset($family_doctor->last_name) ? $family_doctor->last_name : '';
    $contact_no = isset($family_doctor->phone_no) ? $family_doctor->phone_no : '';
    $mobile_no  = isset($family_doctor->mobile_no) ? $family_doctor->mobile_no : '';
    $address    = isset($family_doctor->practice_address) ? $family_doctor->practice_address : '';
?>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

        <div class="row pdrl">
            <div class="input-field col s6 m6 l6  setlabelhalf errorchangesdd">

                <input type="text"  id="fname" class="validate " value="{{$first_name}}">
                <label for="reason" class="grey-text truncate">First Name<span class="required_field">*</span></label>
                <span class="error"></span>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf errorchangesdd">

                <input type="text"  id="lname" class="validate " value="{{$last_name}}">
                <label for="reason" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
                <span class="error"></span>
            </div>

        </div>

        <div class="row pdrl" >
            <div class="input-field col s6 m6 l6   setlabelhalf errorchangesdd">

                <input type="text"  id="phone_no" class="validate ">
                <label for="reason" class="grey-text truncate">Phone Number</label>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf errorchangesdd">

                <input type="text" id="mob_no" class="validate " value="<?php if(!empty($family_doctor->mobile_no)){ echo $family_doctor->mobile_no;} ?>" class="validate " readonly='true'>
                <label for="reason" class="grey-text truncate">Mobile Number<span class="required_field">*</span></label>
                <span class="error"></span>
            </div>

        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12 setlabel errorchangesdd">

                <input type="text" id="dr_mail" value="<?php if(!empty($family_doctor->email)){ echo $family_doctor->email;} ?>" class="validate " readonly='true'>
                <label for="reason" class="grey-text truncate">Email<span class="required_field">*</span></label>
                <span class="error"></span>
            </div>

        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12 setlabel errorchangesdd">

                <input type="text" id="pract_name" placeholder="" value="<?php if(!empty($family_doctor->practice_name)){ echo $family_doctor->practice_name;} ?>" class="validate ">
                <label for="reason" class="grey-text truncate">Medical Pratice Name<span class="required_field">*</span></label>
                  <span class="error"></span>
            </div>

        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12 setlabel errorchangesdd">

                <input type="text" id="pract_addr" class="validate ">
                <label for="reason" class="grey-text truncate">Medical Pratice Address</label>
            </div>

        </div>
        <div class="pdrl">
            <div class="green-text padtopbtm">Preferences</div>
            <p class="bluedoc-text pdtnob">Send Consultation Details</p>
            <span class="valign-wrapper">
                 <div class="left wid90 ">
            <p class="grey-text pdbnot">Would you like to email this doctor every online consultation summary</p>
        </div>
        <div class="right">
            <div class="switch">
                <label>
                    <?php 
                        if($family_doctor->consultation_details=='yes')
                        {
                            $checked='checked';
                        }
                        else
                        {
                            $checked='';
                        }
                    ?>
                    <input id="consultation_detail" type="checkbox" {{$checked}}>
                    <span class="lever greenbg" id="lever"></span>
            </label>
        </div>
    </div>
    </span>
    <div class="input-field martb" id="consult_mail" style="display:{{isset($family_doctor->consultation_details) && $family_doctor->consultation_details =='yes' ? 'block' : 'none'}} ">
          <input id="cons_mail" type="text" class="validate" value="<?php if(!empty($family_doctor->email)){ echo $family_doctor->email;} ?>" placeholder="Doctor's Email" readonly="true">
          
        </div>
    </div>
        <div class="divider mgtb"></div>
   <div class="pdrl">
            
            <p class="bluedoc-text pdtnob">Invite them to doctoroo</p>
            <span class="valign-wrapper">
                 <div class="left wid90 ">
            <p class="grey-text pdbnot">Would you like to invite this doctor to start seeing them on doctoroo</p>
        </div>
        <div class="right">
            <div class="switch">
                <label>
                    <input type="checkbox" id="invite_cbox" {{isset($family_doctor->invitation) && $family_doctor->invitation =='yes' ? 'checked' : ''}}>
                    <span class="lever greenbg" id="invite_switch"></span>
            </label>
        </div>
    </div>
    </span>
    <div class="input-field martb"  id="invite_cbox_box" style="display:{{isset($family_doctor->invitation) && $family_doctor->invitation =='yes' ? 'block' : 'none'}} ">
        <input id="invite_mail" type="text" class="validate" value="<?php if(!empty($family_doctor->email)){ echo $family_doctor->email;} ?>" placeholder="Doctor's Email" readonly="true">
    </div>
    </div>
    <br>
    <br>
    <span class="right qusame rescahnge">
             <a href="" id="btn_edit_doctor" user_id="{{$family_doctor->user_id}}" value="{{$family_doctor->id}}" class="btn cart bluedoc-bg lnht round-corner">Save</a>
             
        </span>


            </div>

         </div>

         

    </div>

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
  
  /*var firstName    = '{{ $first_name }}';
  var lastName     = '{{ $last_name }}';*/
  //var mobile       = '{{ $mobile_no }}';
  var address      = '{{ $address }}';
  var contact_no   = '{{ $contact_no }}';
  
  decryptMyData(virgilToken);
  
  function decryptMyData()
  {
      var api       = virgil.API(virgilToken);
      var key       = api.keys.import(dumpSessionId);

/*      var txtfirst   = decrypt(api, firstName, key);
      var txtlast    = decrypt(api, lastName, key);*/
      //var txtmobile  = decrypt(api, mobile, key);
      var txtaddress = decrypt(api, address, key);

      if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
      {
/*          $('#fname').val(txtfirst);
          $('#lname').val(txtlast);*/
          //$('#mob_no').val(txtmobile);
          $('#pract_addr').val(txtaddress);
      }

      if(contact_no!='')
      {
          var txtcontact_no = decrypt(api, contact_no, key);
          $('#phone_no').val(txtcontact_no);
      }
  }

});

</script>

@include('google_api.google')
<script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
<script>
  $(document).ready(function(){
    var location = "Australia";
    $("#pract_addr").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
    });

  });
</script>

<script>
// number validation for contact no
$('#mob_no, #phone_no').keydown(function(){
  $(this).val($(this).val().replace(/[^\d]/,''));
  $(this).keyup(function(){
      $(this).val($(this).val().replace(/[^\d]/,''));
  });
});

var url="<?php echo $module_url_path; ?>" ;
$(document).ready(function(){
    $('#btn_edit_doctor').click(function(e){
        e.preventDefault();
        var doctor_id=$(this).attr('value');
        var user_id=$(this).attr('user_id')
        var fname=$('#fname').val();
        var lname=$('#lname').val();
        var phone_no=$('#phone_no').val();
        var mob_no=$('#mob_no').val();
        var dr_mail=$('#dr_mail').val();
        var pract_name=$('#pract_name').val();
        var pract_addr=$('#pract_addr').val();

        $('.error').html('');
if($('#fname').val()=='')
{
    
    $('#fname').next('label').next('span').html("Please Enter first name");
    return false;
}
else if($('#lname').val()=='')
{
    $('#lname').next('label').next('span').html("Enter last name");
    return false;
}
else if($('#mob_no').val()=='') 
 {
    $('#mob_no').next('label').next('span').html("Enter Mobile number");
    return false;           
 }
else if($('#pract_name').val()=='')
         {
            $('#pract_name').next('label').next('span').html("Enter medical practice name");
            return false;
         }

      var consultation="";
      if($('#consultation_detail').is(':checked'))
      {
        consultation='yes';
      }  
      else
      {
        consultation='no';
      }

      var mail_action="";
      if($('#invite_cbox').is(':checked'))
      {
            mail_action="send";
      }
      else
      {
           mail_action="";
      }

       /* Data Encryption */                    
       var api       = virgil.API(virgilToken);
       var findkey   = api.cards.get(dumpId).then(function (cards) {

/*       var txtfirst      = encrypt(api, fname, cards);
       var txtlast       = encrypt(api, lname, cards);*/
       var txtmob_no     = encrypt(api, mob_no, cards);

       if(/*txtfirst != '' && txtlast != '' && */txtmob_no != '')
       {
           if(phone_no!='')
           {
              var txtcontact_no = encrypt(api, phone_no, cards);
           }

           if(pract_addr!='')
           {
              var txtaddress = encrypt(api, pract_addr, cards);
           }    
            
               $.ajax({
                url:url+'/family_doctors/edit_data',
                type:'get',
                data:{
                    doctor_id:doctor_id,
                    user_id:user_id,
                    fname:fname,
                    lname:lname,
                    phone_no:txtcontact_no,
                    mob_no:txtmob_no,
                    consultation:consultation,
                    dr_mail:dr_mail,
                    pract_name:pract_name,
                    pract_addr:txtaddress,
                    mail_action:mail_action
                },
                success:function(data){
                    if(data.msg)
                    {
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                }
            });
       }
       
       }).then(null, function () {
           console.log('Something went wrong.');
       });

       findkey.catch(function(error) {
         console.log(error);
       });
    });
});

$('#lever').click(function(){
    if($('#consultation_detail').is(':checked'))
    {
        $('#consult_mail').hide();
    }
    else
    {
        $('#consult_mail').show();
    }
});

$('#dr_mail').keyup(function(){
    $('#cons_mail').val($(this).val());
    $('#invite_mail').val($(this).val());
});

$('#invite_switch').click(function(){
    if($('#invite_cbox').is(':checked'))
    {
        $('#invite_cbox_box').hide();
    }
    else
    {
        $('#invite_cbox_box').show();
    }
});

</script>
    @endsection
    