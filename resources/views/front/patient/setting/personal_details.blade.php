@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

<div class="header z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">Personal Details</h1>
    <div class="fix-add-btn">
        <a href="{{ url('/') }}/patient/setting/edit_personal_details"><span class="grey-text show_txt">Edit Details</span>
            <div class="btn-floating btn-large medblue"><i class="large material-icons">edit</i></div> 
        </a>
    </div>
</div>

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
    $first_name         = isset($arr_personal_details[0]['first_name'])?$arr_personal_details[0]['first_name']:'';
    $last_name          = isset($arr_personal_details[0]['last_name'])?$arr_personal_details[0]['last_name']:'';
    $mobile_no          = isset($arr_personal_details[0]['patientinfo']['mobile_no'])?decrypt_value($arr_personal_details[0]['patientinfo']['mobile_no']):'';
    $address            = isset($arr_personal_details[0]['patientinfo']['suburb'])?$arr_personal_details[0]['patientinfo']['suburb']:'';
    $contact_no         = isset($arr_personal_details[0]['patientinfo']['phone_no'])?$arr_personal_details[0]['patientinfo']['phone_no']:'';
    
 ?>

<!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">


    <div class="fieldspres ">
        @if(isset($arr_personal_details) && !empty($arr_personal_details))
        @foreach($arr_personal_details as $details)
       
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s12 m12 l12 selct">
                <?php 
                    if(!empty($details['profile_image']) && File::exists($profile_img_base_path.$details['profile_image']))
                    {
                        $src = $profile_img_public_path.$details['profile_image'];
                    }
                    else
                    {   
                        $src = $profile_img_public_path.'default-image.jpeg';
                    }
                ?>
                <div class="image-avtar left"> <img src="{{ $src }}" alt="" class="disp_img circle" /></div>
                <div class="clr"></div><br>
                <div class="divider"></div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s6 m6 l6  text-bx lessmar">

                <input type="text" id="first_name" class="validate" value="{{$first_name}}" readonly>
                <label for="reason" class="grey-text truncate">First Name</label>
            </div>
            <div class="input-field col s6 m6 l6  text-bx lessmar">

                <input type="text" id="last_name" class="validate" value="{{$last_name}}" readonly>
                <label for="reason" class="grey-text truncate">Last Name</label>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s6 m6 l6  text-bx lessmar">
                <input type="text" id="reason" class="validate" value="{{isset($details['patientinfo']['gender']) && $details['patientinfo']['gender'] == 'F' ? 'Female' : ''}} {{isset($details['patientinfo']['gender']) && $details['patientinfo']['gender'] == 'M' ? 'Male' : ''}}" placeholder="gender" readonly>
                <label for="reason" class="grey-text truncate">Gender</label>
            </div>

            <div class="input-field col s6 m6 l6 text-bx lessmar">
                 <input type="text" id="reason" class="validate" value="{{ date('d/m/Y', strtotime($details['patientinfo']['date_of_birth']))}}" placeholder="gender" readonly>
                 <label class="active grey-text truncate" for="datebirth">Date of birth</label>
                 <div class="error">{{ $errors->first('datebirth') }}</div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s12 m12 l12  text-bx lessmar">
                <input type="text" id="email" class="materialize-textarea" value="{{ isset($details['email']) ? $details['email'] : '' }}" readonly>
                <label for="email" class="grey-text truncate">Email</label>
            </div>
        </div>
     <div class="row" style="margin-top: 20px;">
        <div class="input-field col s6 m6 l6  text-bx lessmar">
            <label for="reason1" class="grey-text truncate">Contact No.</label>
            <input type="text" id="contact_no" class="validate" value="" readonly>
        </div>
        <div class="input-field col s12 m6 l6  text-bx lessmar">
            <div class="row">
                <div class="col s3">
                    @php
                        $mobile_code = isset($details['patientinfo']['mobile_code']) ? $details['patientinfo']['mobile_code'] : '';
                    @endphp
                    <input type="text" id="reason" class="validate" value="+{{ $mobcode_data['phonecode'] }} ({{ $mobcode_data['iso3'] }})" readonly>
                    <label for="reason" class="grey-text truncate">Mobile No.</label>
                </div>
                <div class="col s9">
                    <input type="text" id="mobile_no" class="validate" value="{{$mobile_no}}" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="input-field col s12 m12 l12  text-bx lessmar">
            <input type="text" id="address" class="materialize-textarea" value="" readonly>
            <label for="address" class="grey-text truncate">Address</label>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="input-field col s12 m12 l12  text-bx lessmar">
            <input type="text" id="texttimezone" class="materialize-textarea" value="{{ $details['patientinfo']['timezone_data']['location_name'] }} ({{ $details['patientinfo']['timezone_data']['utc_offset'] }})" readonly>
            <label for="texttimezone" class="grey-text truncate">Timezone</label>
        </div>
    </div>
    <br/>

    <!-- <h5 class="digihis green-text">Timezone</h5>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col s12 l6 m6">
            <div class="input-field nomar">
                <select id="user_timezone" class="amount-drop">
                    @foreach($timezone_data as $val)
                        <?php
                        $selected = ''; 
                        if(isset($user_timezone_id))
                        {
                            if($val['id']==$user_timezone_id)
                            {
                              $selected='selected';  
                            }    
                            else
                            {
                              $selected='';
                            }
                        }
                        ?>
                        <option my_attr="{{$val['utc_offset']}} {{$val['location']}}" value="{{$val['id']}}" {{$selected}}>{{ $val['location_name'] }} ({{ $val['utc_offset'] }})</option>   
                    @endforeach
                </select>
            </div>
        </div>
    </div> -->

    

    

        <div class="otherdetails">
            <h3 class="sethead">Entitlement</h3>  
        </div>
    <div class="row" >
     
        <div class="input-field col s12 m12 l12 selct">
            
            <table>
                @if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
                    <thead>
                        <tr>
                            <th>Entitlement</th>
                            <th>Card No.</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    @foreach($user_entitlement_arr as $key => $val)
                        <tr>
                            <td>{{isset($val['user_entitlement']['entitlement']) ? $val['user_entitlement']['entitlement'] : ''}}</td>
                            <td id="card_id_{{$key}}"></td>
                            <td>
                                @if(isset($val['affect_area_img']) && !empty($val['affect_area_img']))    
                                     @if($val['affect_area_img'] !='' && File::exists($patient_uploads_url.$val['affect_area_img']))
                                        <div class="image-avtar left"> 
                                            <img class="disp_img circle image_show_{{$key}}">
                                        </div>
                                     @else
                                        NA         
                                     @endif
                                  @else
                                     NA      
                                  @endif    
                            </td>
                        </tr>

                     <script type="text/javascript">
                        $(document).ready(function(){
                        var dumpSessionId = '{{ $user_dumpSessionId }}';
                        var dumpId        = '{{ $user_dumpId }}';
                        var VIRGIL_TOKEN  = "{{env('VIRGIL_TOKEN')}}";
                        var api           = virgil.API(VIRGIL_TOKEN);
                        var key           = api.keys.import(dumpSessionId);
                        var innerkey      = '{{$key}}';

                        var image_file = '{{$patient_uploads_base_url}}/{{$val["affect_area_img"]}}';
                        if(image_file!='')
                        {
                            var image_file_filename      = '{{ $val["affect_area_img"] }}';
                            var xhr = new XMLHttpRequest();
                            // this example with cross-domain issues.
                            xhr.open( "GET", image_file, true );
                            // Ask for the result as an ArrayBuffer.
                            xhr.responseType = "blob";
                            xhr.onload = function( e ) {
                              // Obtain a blob: URL for the image data.
                              var file = this.response;
                              var mime_type = file.type;

                              var fileReader = new FileReader();
                              fileReader.readAsArrayBuffer(file);
                              fileReader.onload = function ()
                              {
                                var img = imageUrl = '';
                                var imageData    = fileReader.result;
                                var fileAsBuffer = new Buffer(imageData);

                                var decryptedFile = key.decrypt(fileAsBuffer);
                                var blob = new Blob([decryptedFile], { type: mime_type });
                                
                                var urlCreator = window.URL || window.webkitURL;
                                
                                if(img=='' && imageUrl=='')
                                {
                                    var imageUrl = urlCreator.createObjectURL( blob );
                                    img.href      = imageUrl;
                                    $(".image_show_"+innerkey).attr('src',imageUrl);
                                }
                              }
                            };
                            xhr.send();
                        }

                        function decrypt(api, enctext, key)
                        {
                          var decrpyttext = key.decrypt(enctext);
                          var plaintext = decrpyttext.toString();
                          return plaintext;
                        }                                                

                        });
                    </script>                         
                    @endforeach    
                @else
                    <span class="green-text">No data found</span>    
                @endif 
            </table>
        </div>
        <div class="clr"></div><br>
        <div class="divider"></div>
    </div>

    

    @endforeach
    @endif

    </div>
</div>
<!--<div class="fixed-action-btn hidetext">
    <a href="{{ url('/') }}/patient/setting/edit_personal_details"><span class="grey-text show_txt">Edit Details</span>
        <div class="btn-floating btn-large medblue"><i class="large material-icons">edit</i></div> 
    </a>
</div>-->

</div>
<!--Container End-->

<!-- Data Decrypt -->
<script type="text/javascript">
  var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
  var dumpSessionId = '{{ $user_dumpSessionId }}';
  var dumpId        = '{{ $user_dumpId }}';

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

          /*var txtfirst   = decrypt(api, firstName, key);
          var txtlast    = decrypt(api, lastName, key);*/
          //var txtmobile  = decrypt(api, mobile, key);
          var txtaddress = decrypt(api, address, key);

          if(/*txtfirst != '' && txtlast != '' && txtmobile != '' && */txtaddress != '')
          {
              /*$('#first_name').val(txtfirst);
              $('#last_name').val(txtlast);*/
              //$('#mobile_no').val(txtmobile);
              $('#address').val(txtaddress);
          }

          if(contact_no!='')
          {
              var txtcontact_no = decrypt(api, contact_no, key);
              $('#contact_no').val(txtcontact_no);
          }
      }

  });
      function decrypt(api, enctext, key)
      {
          var decrpyttext = key.decrypt(enctext);
          var plaintext = decrpyttext.toString();
          return plaintext;
      }
</script>

@if(isset($user_entitlement_arr) && !empty($user_entitlement_arr))
<script type="text/javascript">
  
  var user_entitlement_arr = '<?php echo json_encode($user_entitlement_arr); ?>';
  var user_entitlement_arr = jQuery.parseJSON( user_entitlement_arr );
  
  var api       = virgil.API(virgilToken);
  var key       = api.keys.import(dumpSessionId);
  
  $.each(user_entitlement_arr, function (inner_key, val) {
    var card_no   = decrypt(api, val.card_no, key);
    $('#card_id_'+inner_key).html(card_no);
  });

</script>
@endif

@endsection