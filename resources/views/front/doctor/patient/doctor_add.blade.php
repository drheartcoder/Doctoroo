@extends('front.doctor.layout.new_master')
@section('main_content')
<style>
   .error,.required_field
   {
    color:red;
   }
</style>
 <div class="header bookhead nopad">
    <h1 class="main-title center-align">Add Family Doctor</h1>
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>


    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

<div class="mar300 has-header posrel">
   <form id="add_doctor_form">
      <div class="container posrel pdtbrl has-header minhtnor has-footer">
         <div class="row ">
            <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn input-padding-25px">
               <input type="text" id="fname" class="validate ">
               <label for="reason" class="grey-text truncate">First Name<span class="required_field">*</span></label>
               <span class="error left-12px"></span>
               <span class="result_disp"></span>
            </div>
            <div class="input-field col s6 m6 l6 setlabelhalf name-suggestn input-padding-25px">
               <input type="text" id="lname" class="validate ">
               <label for="reason" class="grey-text truncate">Last Name<span class="required_field">*</span></label>
               <span class="error left-12px"></span>
               <span class="lname_result"></span>
            </div>
         </div>
         <div class="row ">
            <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
               <input type="text" id="phone_no" class="validate ">
               <label for="reason" class="grey-text truncate">Phone Number</label>
            </div>
            <div class="input-field col s6 m6 l6   setlabelhalf input-padding-25px">
               <input type="text" id="mob_no" class="validate ">
               <label for="reason" class="grey-text truncate">Mobile Number</label>
               <span class="error left-12px"></span>
            </div>
         </div>
         <div class="row ">
            <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
               <input type="text" id="dr_mail" class="validate ">
               <label for="reason" class="grey-text truncate">Email</label>
               <span class="error left-12px"></span>
               <Span id="valid_mail" class="error left-12px"></Span>
            </div>
         </div>
         <div class="row " >
            <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
               <input type="text" id="pract_name" class="validate ">
               <label for="reason" class="grey-text truncate">Medical Pratice Name<span class="required_field">*</span></label>
               <span class="error left-12px"></span>
            </div>
         </div>
         <div class="row ">
            <div class="input-field col s12 m12 l12   setlabel input-padding-25px">
               <input type="text" id="pract_addr" placeholder="" class="validate " style="line-height: 20px !important
                  ;">
               <label for="reason" class="grey-text truncate">Medical Pratice Address</label>
            </div>
         </div>
         <div >
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
                     <span class="lever greenbg"></span>
                     </label>
                  </div>
               </div>
            </span>
            <div class="input-field martb" id="consult_mail" style="display: none;">
               <input id="cons_mail" type="text" class="validate" placeholder="Doctor's Email" readonly="true">
            </div>
         </div>
         <div class="divider mgtb"></div>
         <div>
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
   </form>
</div>

<a href="#email_check_popup" id="email_check_popup_link" style="display: none"></a>
<div id="email_check_popup" class="modal addperson">
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

   
    var url="<?php echo $module_url_path; ?>" ;
    $(document).ready(function(){

      $('#show_flash_msg .modal-close').click(function(){
          var enc_patient_id = "<?php echo $enc_patient_id; ?>"; 
          window.location = url+'/patients/details/'+enc_patient_id;
      });

      $('#btn_save_doctor').click(function(e){
           e.preventDefault();
   
           var fname = $('#fname').val();
           var lname = $('#lname').val();
           var phone_no = $('#phone_no').val();
           var mob_no = $('#mob_no').val();
           var dr_mail = $('#dr_mail').val();
           var pract_name = $('#pract_name').val();
           var pract_addr = $('#pract_addr').val();
   
           var enc_patient_id = "<?php echo $enc_patient_id; ?>"; 

           var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);  //email address
      
           $('.error').html('');

           if($('#fname').val()=='')
           {
                $('#fname').next('label').next('span').html("Please Enter first name");
                $('#fname').next('label').next('span').fadeOut(4000);
                $('#fname').next('label').next('span').show();
                $('html, body').animate({
                    scrollTop: $('.mar300').position().top
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
                    scrollTop: $('.mar300').position().top
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

          if($('#pract_name').val()=='')
          {
             $('#pract_name').next('label').next('span').show();
             $('#pract_name').next('label').next('span').fadeOut(4000);
             $('#pract_name').next('label').next('span').html("Enter medical practice name");
             $('#pract_name').next('label').next('span').focus();
             return false;
          }              
   
         var consultation = "";
         if($('#consultation_detail').is(':checked'))
         {
           consultation = 'yes';
         }  
         else
         {
           consultation = 'no';
         }
   
        var mail_action = "";
         if($('#invite_cbox').is(':checked'))
         {
               mail_action = "send";
         }
         else
         {
              mail_action = "";
         }
          
          var VIRGIL_TOKEN = "{{env('VIRGIL_TOKEN')}}";
          var api          = virgil.API(VIRGIL_TOKEN);
          var card_id      = "{{ isset($user_data['dump_id']) && !empty($user_data['dump_id']) ? $user_data['dump_id'] : '' }}";

          // get User's card(s)
          var findkey = api.cards.get(card_id)
          .then(function (cards) {

              var enc_phone_no = encrypt(api, phone_no, cards);
              var enc_pract_addr = encrypt(api, pract_addr, cards);

              if(enc_phone_no != '' && enc_phone_no != null && enc_pract_addr != '' && enc_pract_addr != null)
              {
                $.ajax({
                    url:url+'/patients/family_doctors/add_data',
                    type:'get',
                    data:{
                      fname:fname,
                      lname:lname,
                      phone_no:enc_phone_no,
                      mob_no:mob_no,
                      consultation:consultation,
                      dr_mail:dr_mail,
                      pract_name:pract_name,
                      pract_addr:enc_pract_addr,
                      enc_patient_id:enc_patient_id,
                      mail_action:mail_action
                     },
                    success:function(data){
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
              }

          }).then(null, function () {
              $(".open_popup").click();
              $('.flash_msg_text').html('Something went wrong');
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
               url:url+'/patients/family_doctors/add_data',
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
                       url:url+'/patients/family_doctors/add_data',
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
                   url:url+'/patients/family_doctors/add_data',
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
                       url:url+'/patients/family_doctors/add_data',
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
                   url:url+'/patients/family_doctors/add_data',
                   type:'get',
                   data:{user_id:user_id,action:'select_doctor'},
                   success:function(data){
                         $.each(data.response,function(i,obj)
                               {
                                   $('#fname').val(obj.first_name);
                                   $('#lname').val(obj.last_name);
                                   $('#phone_no').val(obj.contact_phone);
                                   $('#dr_mail').val(obj.email);
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
   
   });
   
</script>

<script>
  $(document).ready(function(){
       $('#mob_no, #phone_no').keydown(function(){
       $(this).val($(this).val().replace(/[^\d]/,''));
       $(this).keyup(function(){
           $(this).val($(this).val().replace(/[^\d]/,''));
       });
     });
  });
</script>

@endsection