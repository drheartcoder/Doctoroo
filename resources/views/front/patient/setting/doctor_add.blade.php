@extends('front.patient.layout._no_sidebar_master')
@section('main_content')
<style>
   .error,.required_field
   {
    color:red;
   }
</style>

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
?>

<div class="header z-depth-2 bookhead">
   <div class="backarrow "><a href="{{ url('/') }}/patient/setting/family_doctors" class="center-align"><i class="material-icons">chevron_left</i></a></div>
   <h1 class="main-title center-align">Add your Doctor</h1>
</div>
<div class="medi">
   <form id="add_doctor_form">
      
    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

      <!-- <div class="container posrel pdtbrl has-header minhtnor has-footer"> -->
         <div class="row pdrl">
            <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorchangesdd">
               <input type="text" id="fname" class="validate "  minlength="2"  maxlength="40">
               <label for="reason" class="grey-text truncate">First Name<span class="required_field">*</span></label>
               <span class="error"></span>
               <span class="result_disp"></span>
            </div>
            <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn errorchangesdd">
               <input type="text" id="lname" class="validate " minlength="2"  maxlength="40">
               <label for="reason" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
               <span class="error"></span>
               <span class="lname_result"></span>
            </div>
         </div>
         <div class="row pdrl">
            <div class="input-field col s6 m6 l6   setlabelhalf errorchangesdd">
               <input type="text" id="phone_no" class="validate " minlength="4" maxlength="16">
               <label for="reason" class="grey-text truncate">Phone Number</label>
            </div>
            <div class="input-field col s6 m6 l6   setlabelhalf errorchangesdd">
               <input type="text" id="mob_no" class="validate " minlength="6" maxlength="16">
               <label for="reason" class="grey-text truncate">Mobile Number</label>
               <span class="error"></span>
            </div>
         </div>
         <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel errorchangesdd">
               <input type="text" id="dr_mail" class="validate ">
               <label for="reason" class="grey-text truncate">Email</label>
               <span class="error"></span>
               <Span id="valid_mail" class="error"></Span>
            </div>
         </div>
         <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel errorchangesdd">
               <input type="text" id="pract_name" class="validate ">
               <label for="reason" class="grey-text truncate">Medical Pratice Name<span class="required_field">*</span></label>
               <span class="error"></span>
            </div>
         </div>
         <div class="row pdrl" >
            <div class="input-field col s12 m12 l12   setlabel errorchangesdd">
               <input type="text" id="pract_addr" placeholder="" class="validate " style="line-height: 20px !important
                  ;">
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
                     <input id="consultation_detail" type="checkbox">
                     <span class="lever greenbg" id="lever"></span>
                     </label>
                  </div>
               </div>
            </span>
            <div class="input-field martb errorchangesdd" id="consult_mail" style="display: none;">
               <input id="cons_mail" type="text" class="validate" placeholder="Doctor's Email" readonly="true">
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
                     <input type="checkbox" id="invite_cbox">
                     <span class="lever greenbg" id="invite_switch"></span>
                     </label>
                  </div>
               </div>
            </span>
            <div class="input-field martb"  id="invite_cbox_box" style="display: none;">
               <input id="invite_mail" type="text" class="validate" placeholder="Doctor's Email" readonly="true">
            </div>
         </div>
         <br>
         <br>
         <div class="center qusame rescahnge">
            <a href="" id="btn_save_doctor" class="btn cart bluedoc-bg lnht round-corner">Save</a>
         </div>
        
        </div>
      </div>

   </form>
</div>

<a href="#email_check_popup" id="email_check_popup_link" style="display: none"></a>
<div id="email_check_popup" class="modal requestbooking">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <p class="center-align" id="email_status"></p>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align">
      <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Ok</a>
   </div>
</div>

<script type="text/javascript">
var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
var dumpSessionId = '{{ $user_dumpSessionId }}';
var dumpId        = '{{ $user_dumpId }}';
var token         = "<?php echo csrf_token(); ?>";
function encrypt(api, text, cards)
{
  // encrypt the text using User's cards
  var encryptedMessage = api.encryptFor(text, cards);

  var encData = encryptedMessage.toString("base64");

  return encData;
}
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
       $('#btn_save_doctor').click(function(e){
           e.preventDefault();
   
           var fname=$('#fname').val();
           var lname=$('#lname').val();
           var phone_no=$('#phone_no').val();
           var mob_no=$('#mob_no').val();
           var dr_mail=$('#dr_mail').val();
           var pract_name=$('#pract_name').val();
           var pract_addr=$('#pract_addr').val();
   
           var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);  //email address
      
           $('.error').html('');
           if($('#fname').val()=='')
           {
               $('#fname').next('label').next('span').html("Please Enter first name");
                $('#fname').next('label').next('span').fadeOut(4000);
                $('#fname').next('label').next('span').show();
                $('html, body').animate({
                    scrollTop: $('#fname').position().top
                }, 1000);
                $('#fname').focus(); 
                return false;
           }
           else if($('#lname').val()=='')
           {
               $('#lname').next('label').next('span').html("Enter last name");
               $('#lname').next('label').next('span').fadeOut(4000);
               $('#lname').next('label').next('span').show();
               $('html, body').animate({
                    scrollTop: $('#lname').position().top
                }, 1000);
                $('#lname').focus(); 
                return false;
           }
           
           else if($('#dr_mail').val()!='')
           {
              if(pattern.test(dr_mail)==false)
              {
                $('#valid_mail').show();
                $('#valid_mail').html("Enter valid email");
                $('#valid_mail').fadeOut(4000);
                $('#dr_mail').focus();
                 return false;
              }
           }
           else if($('#pract_name').val()=='')
           {
               $('#pract_name').next('label').next('span').show();
               $('#pract_name').next('label').next('span').fadeOut(4000);
               $('#pract_name').next('label').next('span').html("Enter medical practice name");
               $('#pract_name').next('label').next('span').focus();
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
          var txtmobile = txtaddress = txtcontact_no = ''
          var api       = virgil.API(virgilToken);
          var findkey   = api.cards.get(dumpId).then(function (cards) {

/*          var txtfirst      = encrypt(api, fname, cards);
          var txtlast       = encrypt(api, lname, cards);*/
          
          if(mob_no!='')
          {
            var txtmobile     = encrypt(api, mob_no, cards);
          }
          if(pract_addr!='')
          {
            var txtaddress    = encrypt(api, pract_addr, cards);
          }
          if(phone_no!='')
          {
            var txtcontact_no = encrypt(api, phone_no, cards);
          }
           $('#btn_save_doctor').attr('disabled',true);
     
             $.ajax({
                 url:url+'/family_doctors/add_data',
                 type:'get',
                 data:{
                     fname:fname,
                     /*encfname:txtfirst,*/
                     lname:lname,
                     /*enclname:txtlast,*/
                     phone_no:txtcontact_no,
                     enc_mob_no:txtmobile,
                     mob_no:mob_no,
                     consultation:consultation,
                     dr_mail:dr_mail,
                     pract_name:pract_name,
                     enc_pract_addr:txtaddress,
                     pract_addr:pract_addr,
                     mail_action:mail_action
                 },
                 success:function(data){
                     $('#btn_save_doctor').attr('disabled',true);
                     $(".alert-success").show();
                     $('#status').html(data.msg);
                     $(".open_popup").click();
                     $('.flash_msg_text').html(data.msg);
                        
                     $('#add_doctor_form')[0].reset();
                     $('#consult_mail').hide();
                     $('#invite_cbox_box').hide();
     
                     $(".alert-dismissable").fadeTo(2000, 500).slideUp(500, function(){
                     $(".alert-dismissable").slideUp(500);
                 });
                 }
             });

          }).then(null, function () {
              console.log('Something went wrong.');
          });

          findkey.catch(function(error) {
            console.log(error);
          });

   
           
       });
   });

   $('#dr_mail').keyup(function(){
       if($(this).val() == '' || $(this).val() == null)
       {
          $('#consultation_detail').prop('checked',false);
          $('#invite_cbox').prop('checked',false);
          $('#consult_mail').hide();
          $('#invite_cbox_box').hide();
       }
   });
   
    $('#consultation_detail').change(function(){
       if($('#consultation_detail').is(':checked'))
       {
           if($('#dr_mail').val() == '' || $('#dr_mail').val() == null)
           {
              $('#email_check_popup_link').click();
              $('#email_status').html('Please enter email address to on this option');
              $('#consultation_detail').prop('checked',false);
              return false;
           }

           $('#consult_mail').show();
       }
       else
       {
          $('#consult_mail').hide();
       }
   });
   
   $('#dr_mail').blur(function(){
        var email=$(this).val();
   
   if($(this).val()!='')
   {
        $.ajax({
               url:url+'/family_doctors/add_data',
               type:'get',
               data:{email:email,action:'check_mail'},
               dataType:'json',
               success:function(data){
                   if(data.msg!='not_exist')
                   {
                      
                       $('#dr_mail').next('label').next('span').html(data.msg);
                        $('#btn_save_doctor').attr('disabled',true);
                       return false;    
                   }
                   else
                   {
                       $('#dr_mail').next('label').next('span').html('');   
                        $('#btn_save_doctor').attr('disabled',false);
                   }
                   
               }
        });
       }
   else
   {
     $('#dr_mail').next('label').next('span').html('');   
                    $('#btn_save_doctor').attr('disabled',false);  
   } 
   });
   
   $('#dr_mail').keyup(function(){
       $('#cons_mail').val($(this).val());
       $('#invite_mail').val($(this).val());
   });
   
   $('#invite_cbox').change(function(){
               if($('#invite_cbox').is(':checked'))
               {
                   if($('#dr_mail').val() == '' || $('#dr_mail').val() == null)
                   {
                      $('#email_check_popup_link').click();
                      $('#email_status').html('Please enter email address to on this option');
                      $('#invite_cbox').prop('checked',false);
                      return false;
                   }
                   
                   $('#invite_cbox_box').show(); 
               }
               else
               {
                  $('#invite_cbox_box').hide();
               }
   });
   
   $('#lname').keyup(function(){
       var search_txt=$(this).val();
   
       if($(this).val()!='')
       {
               $.ajax({
                       url:url+'/family_doctors/add_data',
                       type:'get',
                       data:{search_txt:search_txt,action:'search_dr_by_lname'},
                       success:function(data){
                           $('.lname_result').show();
                           var res='<ul>';
                              $.each(data.response,function(i,obj)
                               {
                                 res+="<li><a href='' class='select_doctor_by_name' id='"+obj.id+"'>"+obj.first_name+' '+obj.last_name+"</a></li>";
                              
                              });
                              res+='</ul>';
                              $('.lname_result').html(res);
                       }
               });
       }
       else
       {
                 $('.lname_result').html('');
       }
   
   });
   
   $(document).on('click','.select_doctor_by_name',function(e){
       e.preventDefault();
       $('.lname_result').hide();
         var user_id=$(this).attr('id');
               $.ajax({
                   url:url+'/family_doctors/add_data',
                   type:'get',
                   data:{user_id:user_id,action:'select_doctor'},
                   success:function(data){
                       
                         $.each(data.response,function(i,obj)
                               {
                                   $('#fname').val(obj.first_name);
                                   $('#lname').val(obj.last_name);
                                   $('#phone_no').val(obj.contact_phone);
                                   $('#dr_mail').val(obj.email);
                                   $('#mob_no').val(obj.mobile_no);
                                   $('#pract_name').val(obj.clinic_name);
                                   $('#pract_addr').val(obj.clinic_address);

                                   $('#cons_mail').val(obj.email);
                                   $('#invite_mail').val(obj.email);

                                   if($('#fname').val() !='' && $('#fname').val() !=null)
                                   {
                                    $('#fname').next('label').addClass('active');
                                   }

                                   if($('#lname').val() !='' && $('#lname').val() !=null)
                                   {
                                    $('#lname').next('label').addClass('active');
                                   }

                                   if($('#phone_no').val() !='' && $('#phone_no').val() !=null)
                                   {
                                    $('#phone_no').next('label').addClass('active');
                                   }

                                   if($('#mob_no').val() !='' && $('#mob_no').val() !=null)
                                   {
                                    $('#mob_no').next('label').addClass('active');
                                   }

                                   if($('#dr_mail').val() !='' && $('#dr_mail').val() !=null)
                                   {
                                    $('#dr_mail').next('label').addClass('active');
                                    $('#dr_mail').blur();
                                   }

                                   if($('#pract_addr').val() !='' && $('#pract_addr').val() !=null)
                                   {
                                    $('#pract_addr').next('label').addClass('active');
                                   }
                                   if($('#pract_name').val() !='' && $('#pract_name').val() !=null)
                                   {
                                    $('#pract_name').next('label').addClass('active');
                                   }
                                 
                          });
                   }
               });
       
   });
   
   $('#fname').keyup(function(){
       var search_txt=$(this).val();
       if($(this).val()!='')
       {
               $.ajax({
                       url:url+'/family_doctors/add_data',
                       type:'get',
                       data:{search_txt:search_txt,action:'search_dr'},
                       success:function(data){
                           $('.result_disp').show();
                           var res='<ul>';
                              $.each(data.response,function(i,obj)
                               {
                                 res+="<li><a href='' class='select_doctor' id='"+obj.id+"'>"+obj.first_name+' '+obj.last_name+"</a></li>";
                          });
                              res+='</ul>';
                              $('.result_disp').html(res);
                       }
               });
       }
       else
       {
                 $('.result_disp').html('');
       }
   $(document).on('click','.select_doctor',function(e){
       e.preventDefault();
       $('.result_disp').hide();
         var user_id=$(this).attr('id');
               $.ajax({
                   url:url+'/family_doctors/add_data',
                   type:'get',
                   data:{user_id:user_id,action:'select_doctor'},
                   success:function(data){
                       
                         $.each(data.response,function(i,obj)
                               {
                                   $('#fname').val(obj.first_name);
                                   $('#lname').val(obj.last_name);
                                   $('#phone_no').val(obj.contact_phone);
                                   $('#dr_mail').val(obj.email);
                                   $('#cons_mail').val(obj.email);
                                   $('#phone_no').val(obj.contact_no);
                                   $('#mob_no').val(obj.mobile_no);
                                   $('#pract_name').val(obj.clinic_name);
                                   $('#pract_addr').val(obj.clinic_address);

                                   $('#cons_mail').val(obj.email);
                                   $('#invite_mail').val(obj.email);

                                   if($('#fname').val() !='' && $('#fname').val() !=null)
                                   {
                                    $('#fname').next('label').addClass('active');
                                   }

                                   if($('#lname').val() !='' && $('#lname').val() !=null)
                                   {
                                    $('#lname').next('label').addClass('active');
                                   }

                                   if($('#phone_no').val() !='' && $('#phone_no').val() !=null)
                                   {
                                    $('#phone_no').next('label').addClass('active');
                                   }

                                   if($('#mob_no').val() !='' && $('#mob_no').val() !=null)
                                   {
                                    $('#mob_no').next('label').addClass('active');
                                   }

                                   if($('#dr_mail').val() !='' && $('#dr_mail').val() !=null)
                                   {
                                    $('#dr_mail').next('label').addClass('active');
                                    $('#dr_mail').blur();
                                   }

                                   if($('#pract_addr').val() !='' && $('#pract_addr').val() !=null)
                                   {
                                    $('#pract_addr').next('label').addClass('active');
                                   }
                                   if($('#pract_name').val() !='' && $('#pract_name').val() !=null)
                                   {
                                    $('#pract_name').next('label').addClass('active');
                                   }

                                 
                          });
                   }
               });
   });

       $('#lname,#phone_no,#mob_no,#dr_mail,#pract_name,#pract_addr').focus(function(){
          $('.result_disp').hide();
      });

      $('#fname,#phone_no,#mob_no,#dr_mail,#pract_name,#pract_addr').focus(function(){
          $('.lname_result').hide();
      });
      
      $('.modal-close').click(function(){
          window.location = url+"/family_doctors";
      });
   
   });
   
</script>
@endsection