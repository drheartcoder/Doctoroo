@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<div class="header z-depth-2 bookhead">
   <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
   <h1 class="main-title center-align">Family Members</h1>
   
   <div class="fix-add-btn">
        <a href="#addperson">
            <span class="grey-text">Add a person to your account</span>
            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
         </a>
    </div>
</div>

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
?>
<div class="medi minhtnor family-doct">
   <style>
      .error_class,.datebirth_error,#valid_mail
      {
      color:red !important;
      line-height: 35px !important;
      }
      a.disabled {
      pointer-events: none;
      cursor: default;
      opacity: 0.6;
      }
      .text-bx {
      margin-top: 20px;
      margin-bottom: 20px;
      }

      .required_field
      {
         color:red;
      }
   </style>

   <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

   <!-- <div class="container posrel has-header" style="padding-bottom: 80px;!important"> -->
      <div>
         @if(Session::has('message'))
         {{Session::get('message')}}
         @endif
      </div>

      @if(isset($family_members) && !empty($family_members))
      <ul class="collection brdrtopsd ">
         @foreach($family_members as $key => $member)
         <li class="collection-item avatar valign-wrapper">
            <?php 
               $src=$profile_img_public_path.'default-image.jpeg';
               ?>
            <div class="image-avtar left"> <img src="{{$src}}" alt="" class="circle" /></div>
            <div class="doc-detail wid90 left"><span class="title truncate" id="family_member_name_{{$key}}">{{$member['first_name']}} {{$member['last_name']}}</span>
            </div>
            <div class="right posrel"> <a href="#" data-activates='dropdown_{{$member['id']}}' class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
            <ul id='dropdown_{{$member["id"]}}' class='dropdown-content doc-rop rightless'>
               <li><a href="#viewperson" class="view_member_details" value='{{$member["id"]}}'>View Details</a></li>
               <li><a href="#viewperson" class="edit_member_details" value='{{$member["id"]}}'>Edit</a></li>
               <li><a href="#delete_member" class="delete_member_box" value='{{$member["id"]}}'>Delete</a></li>
               <li><a href="{{ $module_url_path.'/family_members/unlink/'.base64_encode($member["id"]) }}">Unlink Family Member</a></li>
            </ul>
            <div class="clearfix"></div>
         </li>
      @endforeach
      </ul>
      @else
      <h5 class="center-align no-data">There is no member added yet.</h5>
      @endif 
      <div class="clr"></div>
     
      <div id="viewperson" class="modal requestbooking small-modal date-modal">
         <form method="post" id="edit_member_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="member_id">
            <div class="modal-content">
               <h4 class="center-align modal_title member_modal_title">Member Details</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s6 l6">
                     <div class="input-field text-bx">
                        <input id="edit_firstname" name="firstname" type="text" class="validate">
                        <label for="firstname">First Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s6 l6">
                     <div class="input-field text-bx">
                        <input id="edit_lastname" name="lastname" type="text" class="validate">
                        <label for="lastname">Last Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s6 l6" id="view_gender_block" style="display: none">
                     <div class="input-field text-bx">
                     <input id="view_gender" name="view_gender" type="text" class="validate">
                        <label for="gender">Gender <span class="required_field">*</span></label>
                     </div>
                  </div>
                  <div class="col s6 l6" id="edit_gender_block" style="display: none;">
                     <div class="input-field selct gender-drop2">
                        <select id="edit_gender" name="edit_gender" class="edit_gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s6 l6" id="view_date_block" style="display: none;">
                     <div class="input-field text-bx ">
                        <input id="view_datebirth" name="" type="text" class="">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                     </div>
                  </div>
                  <div class="col s6 l6" id="edit_date_block" style="display: none;">
                     <div class="input-field text-bx ">
                        <input id="edit_datebirth" name="datebirth" type="date" class="dob_datepicker dob_upd validate">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s6 l6" id="edit_member_email_block" style="display: none;">
                     <div class="input-field text-bx">
                        <input id="edit_member_email" name="edit_member_email" type="text" class="validate" disabled>
                        <label for="edit_member_email">Email</label>
                        <span class="error_class"></span>
                     </div>
                  </div>

                   <div class="col s6 l6" id="view_member_email_block" style="display: none;">
                     <div class="input-field text-bx">
                        <input id="view_member_email" name="view_member_email" type="text" class="validate">
                        <label for="view_member_email">Email</label>
                     </div>
                  </div>


                  <div class="col s6 l6">
                     <div class="input-field text-bx ">
                        <input id="edit_contact_no" name="edit_contact_no" type="text" class="">
                        <label class="active" for="datebirth">Contact No.</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field text-bx">
                        <input id="edit_password" type="text" name="" class="validate">
                        <label for="password">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer center-align two-btn-block">
               <a href="javascript:void(0)" id="back_btn" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
               <a href="" id="edit_member_btn" class="modal-action waves-effect waves-green btn-cancel-cons">Update</a>
            </div>
         </form>
      </div>
      <div id="addperson" class="modal requestbooking small-modal date-modal">
         <form method="post" id="add_member_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Add someone to your account</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s6 l6">
                     <div class="input-field text-bx">
                        <input id="firstname" name="firstname" type="text" class="validate">
                        <label for="firstname">First Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s6 l6">
                     <div class="input-field text-bx">
                        <input id="lastname" name="lastname" type="text" class="validate">
                        <label for="lastname">Last Name <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               
               <!--<div class="row">
                  <div class="col s6 l6" id="view_gender_block" style="display: none">
                     <div class="input-field text-bx">
                     <input id="view_gender" name="view_gender" type="text" class="validate">
                        <label for="gender">Gender <span class="required_field">*</span></label>
                     </div>
                  </div>
                  <div class="col s6 l6" id="edit_gender_block" style="display: none;">
                     <div class="input-field selct gender-drop2">
                        <select id="edit_gender" name="edit_gender" class="edit_gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s6 l6" id="view_date_block" style="display: none;">
                     <div class="input-field text-bx ">
                        <input id="view_datebirth" name="" type="text" class="">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                     </div>
                  </div>
                  <div class="col s6 l6" id="edit_date_block" style="display: none;">
                     <div class="input-field text-bx ">
                        <input id="edit_datebirth" name="datebirth" type="date" class="dob_datepicker dob_upd validate">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>-->
               <div class="row">
                  <div class="col s6 l6">
                     <div class="input-field selct gender-drop2">
                        <select id="gender" name="gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
                  <div class="col s6 l6">
                     <div class="input-field text-bx ">
                        <input id="datebirth datepicker" name="datebirth" type="date" class="dob_datepicker dob validate">
                        <label class="active" for="datebirth">Date of birth <span class="required_field">*</span></label>
                        <span class="datebirth_error"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s6 l6">
                     <div class="input-field text-bx">
                        <input id="member_email" name="member_email" type="text" class="validate">
                        <label for="gender">Email</label>
                        <span class="error_class"></span>
                        <span id="valid_mail"></span>

                     </div>
                  </div>
                  <div class="col s6 l6">
                     <div class="input-field text-bx ">
                        <input id="contact_no" name="contact_no" type="text" class="">
                        <label class="active" for="contact_no">Contact No.</label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field  text-bx">
                        <input id="password" type="text" name="user_relation" class="validate">
                        <label for="password">Your relationship to them e.g. Mother <span class="required_field">*</span></label>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="modal-footer ">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
               <a href="" id="btn_submit" class="modal-action waves-effect waves-green btn-cancel-cons right">Add Person</a>
            </div>
         </form>
      </div>
      <div id="major" class="modal requestbooking">
         <div class="modal-content">
            <h4 class="center-align">Create a seperate account?</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
         </div>
         <div class="modal-data">
            <div class="row">
               <div class="col s12 l12 m12">
                  <strong>This person is above 18 years old and can legally see a doctor using their own independent account.</strong>
                  <p class="green-text">What's the difference?</p>
                  <p>Their own account enables them to use all features without your permission and you won't be notified of any of ther consultations or order and cannot access their account without their consent.</p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left truncate">Seperate Account</a>
            <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons right truncate">Add to this account</a>
         </div>
      </div>
      <div id="minor" class="modal requestbooking">
         <div class="modal-content">
            <h4 class="center-align">To Continue a parent or guardian is needed</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
         </div>
         <div class="modal-data">
            <div class="row">
               <div class="col s12 l12 m12">
                  <p>Good News - you can still see a doctor &amp; use all the features like all other users!</p>
                  <p>Simply ask a parent or guardian to create account in their name (you can help them if needed), and they can add you as a family member - its's tha simple!</p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="javascript:void(0)" id="close_btn" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left truncate">Close</a>
            <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons right truncate">Sign up as Parent</a>
         </div>
      </div>
      <div id="unlink" class="modal requestbooking">
         <div class="modal-content">
            <h4 class="center-align">Successfully Sent!</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
         </div>
         <div class="modal-data">
            <div class="row">
               <div class="col s12 l12 m12">
                  <p>An email will be sent to the email address you entered</p>
                  <p>Once confirmed by the recipient, their details will moved to their new, independent account and you will no longer be able to access their details.</p>
               </div>
            </div>
         </div>
        
            <div class="modal-footer center-align ">
               <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
            </div>
         
      </div>
      
      </div>
   </div>
   <!--Container End-->
   <div id="delete_member" class="modal requestbooking small-modal">
         <div class="modal-data">
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
               <div class="col s12 l12">
                  <input type="hidden" id="delete_member_id">
                  <p class="center-align">Do you really want to delete this member? This member's all data including consultation history will be deleted permanantly</p>
               </div>
            </div>
         </div>
         <div class="modal-footer center-align two-btn-block">
            <a class="modal-close modal-action waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="" class="modal-action waves-effect waves-green btn-cancel-cons" id="btn_delete_member">Delete</a>
         </div>
      </div>
</div>

   <!-- Data Decrypt -->
<script type="text/javascript">
var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
var dumpSessionId = '{{ $user_dumpSessionId }}';
var dumpId        = '{{ $user_dumpId }}';

var api       = virgil.API(virgilToken);
var key       = api.keys.import(dumpSessionId);

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

</script>

<script>


   var url="<?php echo $module_url_path; ?>" ;
   
   var token="<?php echo csrf_token(); ?>";
   $(document).ready(function(){
       $('#btn_submit').click(function(e){
           e.preventDefault();
   
           var firstname=$('#firstname').val();
           var lastname=$('#lastname').val();
           var gender=$("#gender").val();
           var member_email=$('#member_email').val();
           var contact_no=$('#contact_no').val();
           var datebirth=$('.dob').val();

           $('.error_class,#valid_mail').html("");
           $('.datebirth_error').html("");
           var user_relation=$("input[name='user_relation']").val();
   
           if($('#firstname').val()=='')
           {
               $('#firstname').next('label').next('span').html("Please Enter first name");
               return false;
           }
           else if($('#lastname').val()=='')
           {
   
            $('#lastname').next('label').next('span').html("Please Enter Last name");
   
            return false;   
        }
        else if($('#gender').val()=='')
        {
   
           $('#gender').closest('.col').find('.error_class').html("Select Gender");
           return false;
       }
       else if($('.dob').val()=='')
       {
           $('.datebirth_error').html("Select Birth Date");   
           return false;
       }
       /*else if($('#member_email').val()=='')
       {
           $('#member_email').next('label').next('span').html("Enter email address");
           return false;
       }*/
      
       if($('#member_email').val()!='')
       {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if(pattern.test($('#member_email').val())==false)
                {
                  $('#valid_mail').html("Enter valid email");
                   return false;
                }
       }

        if($("input[name='user_relation']").val()=='')
        {
         $("input[name='user_relation']").next('label').next('span').html("Enter Your Relation");

         return false;
        }
        /* Data Encryption */                    
        var api       = virgil.API(virgilToken);
        var findkey   = api.cards.get(dumpId).then(function (cards) {

        /*var txtfirst      = encrypt(api, firstname, cards);
        var txtlast       = encrypt(api, lastname, cards);*/
        var txtdatebirth  = encrypt(api, datebirth, cards);

        if(/*txtfirst != '' && txtlast != '' && */txtdatebirth != '')
        {
           var formData=new FormData($('#add_member_form')[0]);
           
           formData.append('firstname',firstname);
           formData.append('lastname',lastname);
           formData.append('gender',gender);
           formData.append('email',member_email);
           formData.append('datebirth',txtdatebirth);
           formData.append('user_relation',user_relation);
           
           if(contact_no!='')
           {
            var txtcontact_no = encrypt(api, contact_no, cards);
            formData.append('contact_no',txtcontact_no);
           }
      
           $.ajax({
              url:url+'/family_members/add',
              type:'post',
              data:formData,
              processData: false,
              contentType: false,
              success:function(data){
               if(data.status)
                 {
                   $("#addperson .modal-close").click()
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
   
       $('#close_btn').click(function(){
        $('#minor').hide();
        location.reload();
    });
   
       $('.view_member_details').click(function(e){
           e.preventDefault();
           $('#back_btn').html('OK');
           $('#view_date_block').css('display','block');
           $('#view_member_email_block').css('display','block');
           $('#edit_date_block').css('display','none');
           $('#edit_member_email_block').css('display','none');
           $('#edit_member_btn').hide();
           $('.member_modal_title').html("Member Details");
   
           $('#view_gender_block').show();
           $('#edit_gender_block').hide();
           var id=$(this).attr('value');
           $.ajax({
            url:url+'/family_members/view',
            type:'get',
            data:{id:id,action:'view'},
            dataType:'json',
            success:function(data){
   
   
               $.each(data.response,function(i,obj)
               {  
                 var dec_contact_no  = ''; 
                 /*var dec_first_name  = decrypt(api, obj.first_name, key);
                 var dec_last_name   = decrypt(api, obj.last_name, key);*/
                 var dec_dob         = decrypt(api, obj.date_of_birth, key);
                 
                 if(obj.mobile_number!='')
                 {
                     var dec_contact_no  = decrypt(api, obj.mobile_number, key);
                 }

                   $('#edit_firstname').val(obj.first_name).prop('readonly',true);
                   $('#edit_lastname').val(obj.last_name).prop('readonly',true);  
                   $('#view_gender').val(obj.gender).prop('readonly',true);   
                   $('#edit_contact_no').val(dec_contact_no).prop('readonly',true);
                   $('#view_member_email').val(obj.email).prop('readonly',true);
                   $('#edit_password').val(obj.relationship).prop('readonly',true);  

                   $('#edit_firstname').next('label').addClass('active');
                   $('#edit_lastname').next('label').addClass('active');
                   $('#view_gender').next('label').addClass('active');
                   $('#edit_contact_no').next('label').addClass('active');
                   $('#view_datebirth').next('label').addClass('active');
                   $('#edit_password').next('label').addClass('active');

                   //var dob = convertDate(obj.date_of_birth);
                   $('#view_datebirth').val(dec_dob).prop('readonly',true);

                   if($('#view_member_email').val() != '')
                   {
                      $('#view_member_email').next('label').addClass('active'); 
                   }

               });
           }
       });
       });

       function convertDate(inputFormat)
       {
         function pad(s) { return (s < 10) ? '0' + s : s; }
         var d = new Date(inputFormat);
         return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
       }
   
       $('.edit_member_details').click(function(){
           var id=$(this).attr('value');
           $('#back_btn').html('Cancel');
           $('#member_id').val(id);
   
           $('#view_date_block').css('display','none');
           $('#edit_date_block').css('display','block');
           $('#edit_member_btn').show();

           $('#edit_member_email_block').css('display','block');
           $('#view_member_email_block').css('display','none');
   
           $('#view_gender_block').hide();
           $('#edit_gender_block').show();
   
           $('.member_modal_title').html("Edit Member");
           var id  = $(this).attr('value');

           $.ajax({
            url:url+'/family_members/view',
            type:'get',
            data:{id:id,action:'view'},
            dataType:'json',
            success:function(data){
  
               $.each(data.response,function(i,obj)
               {    
                    var dec_contact_no  = ''; 
                    /*var dec_first_name  = decrypt(api, obj.first_name, key);
                    var dec_last_name   = decrypt(api, obj.last_name, key);*/
                    var dec_dob         = decrypt(api, obj.date_of_birth, key);
                    
                    if(obj.mobile_number!='')
                    {
                        var dec_contact_no  = decrypt(api, obj.mobile_number, key);
                    }

                    $('#edit_firstname').val(obj.first_name).prop('readonly',false);
                    $('#edit_lastname').val(obj.last_name).prop('readonly',false);      
                    $('#edit_contact_no').val(dec_contact_no).prop('readonly',false);
                    $('#edit_member_email').val(obj.email).prop('readonly',true);
                    
                    $('#edit_password').val(obj.relationship).prop('readonly',false);

                    $('#edit_firstname').next('label').addClass('active');
                    $('#edit_lastname').next('label').addClass('active');
                    $('#edit_datebirth').next('label').addClass('active');
                    $('#edit_contact_no').next('label').addClass('active');
                    $('#view_datebirth').next('label').addClass('active');
                    $('#edit_password').next('label').addClass('active');

                    $('.edit_gender').find('.select-dropdown').val(obj.gender);
                    $('#edit_gender').val(obj.gender).attr('selected','selected');

                    //var dob = convertDate(dec_dob);

                    $('#edit_datebirth').val(dec_dob).prop('readonly',false);

                    if($('#edit_member_email').val() != '')
                    {
                       $('#edit_member_email').next('label').addClass('active'); 
                    }
                    else
                    {
                       $('#edit_member_email').next('label').removeClass('active');  
                    }
                    
                });
                
           }
       });
       });
   
       $('#edit_member_btn').click(function(e){
           e.preventDefault();
            
           var member_id=$('#member_id').val();
           var firstname=$('#edit_firstname').val();
           var lastname=$('#edit_lastname').val();      
           var gender=$('#edit_gender').val();
           var datebirth=$('#edit_datebirth').val();
           var user_relation=$('#edit_password').val();
   
           var email=$('#edit_member_email').val();
           var contact_no=$('#edit_contact_no').val();   
           var member_email=$('#edit_member_email').val();
   
           $('.error_class,#valid_mail').html("");
           $('.datebirth_error').html("");
   
           if($('#edit_firstname').val()=='')
           {
               $('#edit_firstname').next('label').next('span').html("Please Enter first name");
               return false;
           }
           else if($('#edit_lastname').val()=='')
           {
               $('#edit_lastname').next('label').next('span').html("Please Enter Last name");
               return false;   
           }
           else if($('#edit_gender').val()=='')
           {
               $('#edit_gender').closest('#edit_gender_block').find('.error_class').html("Select Gender");
               return false;
           }
           else if($('#edit_datebirth').val()=='')
            {
               $('.datebirth_error').html("Enter Birth Date");            
               return false;
            }
            else if($("#edit_password").val()=='')
            {
             $("#edit_password").next('label').next('span').html("Enter Your Relation");
             return false;
            }
   
           /* Data Encryption */                    
           var api       = virgil.API(virgilToken);
           var findkey   = api.cards.get(dumpId).then(function (cards) {

           /*var txtfirst      = encrypt(api, firstname, cards);
           var txtlast       = encrypt(api, lastname, cards);*/
           var txtdatebirth  = encrypt(api, datebirth, cards);

           if(/*txtfirst != '' && txtlast != '' && */txtdatebirth != '')
           {
               var formData=new FormData($('#edit_member_form')[0]);  
               
               formData.append('member_id',member_id);
               formData.append('firstname',firstname);
               formData.append('lastname',lastname);
               formData.append('gender',gender);
               formData.append('member_email',member_email);
               formData.append('datebirth',txtdatebirth);
               formData.append('user_relation',user_relation);
               
               if(contact_no!='')
               {
                  var txtcontact_no = encrypt(api, contact_no, cards);
                  formData.append('contact_no',txtcontact_no);
               }    
      
               $.ajax({
                   url:url+'/family_members/edit',
                   type:'post',
                   data:formData,
                   processData: false,
                   contentType: false,
                   dataType:'json',
                   success:function(data){
                    if(data.status)
                    {
                        $("#viewperson .modal-close").click()
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
   
       $('.delete_member_box').click(function(){
           $('#delete_member_id').val($(this).attr('value'));
       });
   
       $('#btn_delete_member').click(function(e){
           e.preventDefault();
           var member_id=$('#delete_member_id').val();

           $.ajax({
               url:url+'/family_members/delete',
               type:'get',
               data:{member_id:member_id},
               success:function(data){
                   if(data.status)
                    {
                        $("#delete_member .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
               }
           });
       });
   
       $('#member_email').blur(function(){
           var email_id=$(this).val();
           if($(this).val()!='')
           {
               $.ajax({
                   url:url+'/check_member_mail',
                   type:'get',
                   data:{email_id:email_id},
                   success:function(data){
                       if(data.status=='exist')
                       {
                           $('#member_email').next('label').next('span').html("This E mail is already registered");
                           $('#btn_submit').addClass('disabled');
                       }
                       else
                       {
                        $('#member_email').next('label').next('span').html("");   
                        $('#btn_submit').removeClass('disabled');
                    }
                }
            });
           }
           else
           {
               $('#member_email').next('label').next('span').html("");   
               $('#btn_submit').removeClass('disabled');
           } 
       });

       $('#edit_contact_no, #contact_no').keydown(function(){
         $(this).val($(this).val().replace(/[^\d]/,''));
         $(this).keyup(function(){
             $(this).val($(this).val().replace(/[^\d]/,''));
         });
       });

       $('.modal-close').click(function(){
         $('#add_member_form')[0].reset();
         $('.error_class').html('');
         $('#add_member_form label').removeClass('active');
       });
       
   });

</script>

<!-- @if(isset($family_members) && !empty($family_members))
<script type="text/javascript">
  
  var family_members = '<?php echo json_encode($family_members); ?>';
  var family_members = jQuery.parseJSON( family_members );
  
  
  $.each(family_members, function (inner_key, val) {
    var first_name   = decrypt(api, val.first_name, key);
    var last_name   = decrypt(api, val.last_name, key);
    var name = first_name+' '+last_name;
    $('#family_member_name_'+inner_key).html(name);

  });

</script>
@endif -->

@endsection