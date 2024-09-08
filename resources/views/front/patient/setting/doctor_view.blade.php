@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
 <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/family_doctors" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Doctor Details</h1>
        <div class="savebtntop">{{-- <a href="" id="btn_edit_doctor" user_id="{{$family_doctor->user_id}}" value="{{$family_doctor->id}}" class=" btn-flat">Save</a> --}}</div>

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
            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" value="<?php if(!empty($family_doctor->first_name)){ echo $family_doctor->first_name;} ?>" id="fname" class="validate " readonly>
                <label for="reason" class="grey-text truncate">First Name</label>
                <span class="error"></span>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" value="<?php if(!empty($family_doctor->last_name)){ echo $family_doctor->last_name;} ?>" id="lname" class="validate " readonly>
                <label for="reason" class="grey-text truncate">Last Name</label>
                <span class="error"></span>
            </div>

        </div>

        <div class="row pdrl" >
            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" value="<?php if(!empty($family_doctor->phone_no)){ echo $family_doctor->phone_no;} ?>" id="phone_no" class="validate " readonly>
                <label for="reason" class="grey-text truncate">Phone Number</label>
            </div>


            <div class="input-field col s6 m6 l6   setlabelhalf">

                <input type="text" value="<?php if(!empty($family_doctor->mobile_no)){ echo $family_doctor->mobile_no;} ?>" id="mob_no" class="validate " readonly>
                <label for="reason" class="grey-text truncate">Mobile Number</label>
                <span class="error"></span>
            </div>

        </div>
        <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel">

                <input type="text" id="dr_mail" value="<?php if(!empty($family_doctor->email)){ echo $family_doctor->email;} ?>" class="validate " readonly='true'>
                <label for="reason" class="grey-text truncate">Email</label>
                <span class="error"></span>
            </div>

        </div>
        <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel">

                <input type="text" id="pract_name" value="<?php if(!empty($family_doctor->practice_name)){ echo $family_doctor->practice_name;} ?>" class="validate " readonly>
                <label for="reason" class="grey-text truncate">Medical Pratice Name</label>
            </div>

        </div>
        <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel">

                <input type="text" value="<?php if(!empty($family_doctor->practice_address)){ echo $family_doctor->practice_address;} ?>" id="pract_addr" class="validate " readonly>
                <label for="reason" class="grey-text truncate" >Medical Pratice Address</label>
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
                    <input id="consultation_detail" disabled="" type="checkbox" {{$checked}}>
                    <span class="lever greenbg" id="lever"></span>
            </label>
        </div>
    </div>
    </span>
    <div class="input-field martb" id="consult_mail" style="display:{{isset($family_doctor->consultation_details) && $family_doctor->consultation_details =='yes' ? 'block' : 'none'}}">
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
                    <input type="checkbox" id="invite_cbox" disabled="" {{isset($family_doctor->invitation) && $family_doctor->invitation =='yes' ? 'checked' : ''}}>
                    <span class="lever greenbg" id="invite_switch"></span>
                </label>
        </div>
    </div>
    </span>
    <div class="input-field martb"  id="invite_cbox_box" style="display:{{isset($family_doctor->invitation) && $family_doctor->invitation =='yes' ? 'block' : 'none'}}">
          <input id="invite_mail" value="<?php if(!empty($family_doctor->email)){ echo $family_doctor->email;} ?>" type="text" class="validate" placeholder="Doctor's Email" readonly="true">
      </div>
      </div>
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
  
  var firstName    = '{{ $first_name }}';
  var lastName     = '{{ $last_name }}';
  var mobile       = '{{ $mobile_no }}';
  var address      = '{{ $address }}';
  var contact_no   = '{{ $contact_no }}';
  
  decryptMyData(virgilToken);
  
  function decryptMyData()
  {
      var api       = virgil.API(virgilToken);
      var key       = api.keys.import(dumpSessionId);

      //var txtfirst   = decrypt(api, firstName, key);
      //var txtlast    = decrypt(api, lastName, key);
      //var txtmobile  = decrypt(api, mobile, key);
      var txtaddress = decrypt(api, address, key);

      if(/*txtfirst != '' && txtlast != '' && txtmobile != '' &&*/ txtaddress != '')
      {
          /*$('#fname').val(txtfirst);
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


    @endsection
    