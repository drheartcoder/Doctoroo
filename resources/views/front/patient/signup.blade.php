<!--Signup popup start here-->
<div id="signup" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content logincont">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up"></button>
         </div>
         <div class="modal-body bdy-pading">
         <form name="frm_patient_signup" id="frm_patient_signup" method="post" action="{{ url('/') }}/patient/signup/store">
         {{ csrf_field() }}
            <div class="login_box">
               <div class="title_login">Get Started</div>
               <div class="tag-txt">Please Sign Up to your account</div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="First Name" name="pfirst_name" id="pfirst_name" />
                    <div class="err" id="err_pfirst_name" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Last Name" name="plast_name" id="plast_name" />
                    <div class="err" id="err_plast_name" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="text" class="input_acct-logn" placeholder="Email Address" name="pemail" id="pemail" />
                    <div class="err" id="err_pemail" style="display:none;"></div>
               </div>
               <div class="user_box">
                  <input type="password" class="input_acct-logn" placeholder="Password" name="ppass_word" id="ppass_word" />
                   <div class="err" id="err_ppass_word" style="display:none;"></div>
               </div>
               <div class="clearfix"></div>
               <div class="login-bts">
                  <button class="btn btn-search-login" value="submit" type="submit" name="patient_signup" id="patient_signup" >Sign up Now</button>
               </div>
               <div class="already-txt">
                  Already a Member? <a data-toggle="modal" href="#login">Sign In</a>
               </div>
               <div class="clearfix"></div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script>

$(document).ready(function(){

$('#pemail').on('keyup blur',function(){
 
   $('#err_pemail').html('');
   var pemail   =  $(this).val();
  // $('#patient_signup').attr('disabled',true);
   //$('#err_pemail').html('');
   var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   
   if($.trim(pemail)!='')
   {
      if(!pemail_filter.test(pemail))
      {
         $('#err_pemail').show();         
         $('#err_pemail').html('Please enter valid email id.');
         $('#err_pemail').fadeOut(4000);
         $('#pemail').focus();	
         return false;  
      }

      $.ajax({
            url   : "{{ url('/') }}/patient/duplicate/email",
            type : "GET",
            data: {email_id:pemail},
            success : function(res){
               if($.trim(res)=='error')
               {
                  $('#err_pemail').show();         
                  $('#err_pemail').html('Email id already exist.');
                  //$('#err_pemail').fadeOut(4000);
                  $('#patient_signup').attr('disabled',true);
                  $('#pemail').focus();   
                  return false; 
               }
               else if($.trim(res)=='success')
               {
                  $('#err_pemail').show();
                  $('#patient_signup').attr('disabled',false);
                  return true;
               }
               else
               {
               	$('#err_pemail').show();
                  $('#pemail').focus();
                  $('#err_pemail').html('Something has get wrong please try again later.');
                  return false;
               }
            }
      });
   }
});


   $('#patient_signup').click(function(){ 
   var pfirst_name =  $('#pfirst_name').val();
   var plast_name  =  $('#plast_name').val();
   var ppass_word  =  $('#ppass_word').val();
   var pemail      =  $('#pemail').val();
   var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   var alpha = /^[a-zA-Z]*$/;

   if($.trim(pfirst_name)=='')
   {
      $('#err_pfirst_name').show();
      $('#pfirst_name').focus();
      $('#err_pfirst_name').html('Please enter first name.');
      $('#err_pfirst_name').fadeOut(4000);
      return false;
   }  
   else if(!alpha.test(pfirst_name))
   {
      $('#err_pfirst_name').show();
      $('#pfirst_name').focus();
      $('#err_pfirst_name').html('Please enter valid first name.');
      $('#err_pfirst_name').fadeOut(4000);
      return false;
   }   
   else if($.trim(plast_name)=='')
   {
      $('#err_plast_name').show();
      $('#plast_name').focus();
      $('#err_plast_name').html('Please enter last name.');
      $('#err_plast_name').fadeOut(4000);
      return false;  
   }
  else if(!alpha.test(plast_name))
   {
      $('#err_plast_name').show();
      $('#plast_name').focus();
      $('#err_plast_name').html('Please enter valid last name.');
      $('#err_plast_name').fadeOut(4000);
      return false;  
   }
   else if($.trim(pemail)=='')
   {
      $('#err_pemail').show();
      $('#pemail').focus();
      $('#err_pemail').html('Please enter email id.');
      $('#err_pemail').fadeOut(4000);
      return false;  
   }
   else if(!pemail_filter.test(pemail))
   {
      $('#err_pemail').show();
      $('#pemail').focus();
      $('#err_pemail').html('Please enter valid email id.');
      $('#err_pemail').fadeOut(4000);
      return false;  
   }
   else if($.trim(ppass_word)=='')
   {
      $('#err_ppass_word').show();
      $('#ppass_word').focus();
      $('#err_ppass_word').html('Please enter Password.');
      $('#err_ppass_word').fadeOut(4000);
      return false;  
   }
   else if($.trim(ppass_word).length<6)
   {
      $('#err_ppass_word').show();
      $('#ppass_word').focus();
      $('#err_ppass_word').html('For better security, use a password 6 characters long.');
      $('#err_ppass_word').fadeOut(4000);
      return false;  
   }
   else
   {
      showProcessingOverlay();
      return true;
   }
  });
});
</script>
<!--Signup popup end here-->