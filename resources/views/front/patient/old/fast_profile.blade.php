@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')


<style>
.sticky_btn {
    bottom: 350px;
    position: fixed;
    right: 0;
}
</style>

<!--file upload css-->
<link rel="stylesheet" href="{{url('/')}}/public/css/bootstrap-fileupload.css"/>
<!--dashboard section-->   
<style>
  .star{ color:#ff4d4d; } 
</style>
<!--Seema(27-Feb-2017)-->        
<div class="middle-section">
   <div class="container">
      @include('front.layout._operation_status')
      <?php 
           $user       = Sentinel::check();
           $activation = Activation::completed($user);
        ?>
        @if($user->verification_status==0)
        
           <div class="alert-box warning alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button><span>warning: </span> Your Account is not verified yet. Please verify your account by clicking on verification link given in registered email. Click here to <a href="{{ url('/') }}/patient/resend-verification-email/{{ $user->id }}">Resend verification email.</a></div>
          
        @endif


      <div class="back-whhit-bx patient-white-bx" style="background:#fff">
         <div class="clearfix"></div>
         <div class="add-new-head">
            Personal Details
         </div>
         <form method="post" name="frm_patient_profile" id="frm_patient_profile" action="{{url('/')}}/patient/profile/store_fast_profile" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="signup_type" id="signup_type" value="fast">
        <input type="hidden" name="status_redirect" id="status_redirect" value="">

         <div class="row" id="div_personal_details">
            <div class="col-sm-12 col-md-12 col-lg-6">
             <?php 
                  $arr_months = array(1=>'Jan',
                                      2=>'Feb',
                                      3=>'March',
                                      4=>'April',
                                      5=>'May',
                                      6=>'June',
                                      7=>'July',
                                      8=>'Aug',
                                      9=>'Sep',
                                      10=>'Oct',
                                      11=>'Nov',
                                      12=>'Dec'); 
               ?>

               <div class="user-box ">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Title <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                          <div class="select-style my-pati">
                           <select class="frm-select" name="title" id="title">
                              <option value="">- Title -</option>
                              @if(isset($arr_prefix) && sizeof($arr_prefix)>0)
                                  @foreach($arr_prefix as $prefix)
                                    <option value="{{ $prefix['name'] or '' }}" @if(isset($patient_arr['userinfo']['title']) && $patient_arr['userinfo']['title']==$prefix['name']) selected="selected" @endif >{{ $prefix['name'] or '' }}</option>
                                  @endforeach
                              @endif
                           </select>
                          </div>    
                        <div class="err" id="err_title"></div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">First Name <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="First Name" name="first_name" id="first_name" class="form-inputs" type="text" value="{{isset($patient_arr['userinfo']['first_name'])?$patient_arr['userinfo']['first_name']:old('first_name')}}" />
                         <div class="err" id="err_first_name"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Last Name <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Last Name" name="last_name" id="last_name" class="form-inputs" type="text" value="{{isset($patient_arr['userinfo']['last_name'])?$patient_arr['userinfo']['last_name']:''}}" />
                         <div id="err_last_name" class="err"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Gender <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <div class="radio-btns user_box pre-rad">
                           <div class="radio-btn aftr-cl">
                              <input name="gender" id="RadioMale" type="radio" value="M" @if(isset($patient_arr['gender']) && $patient_arr['gender']=='M') checked="checked" @endif/>
                              <label for="RadioMale">Male</label>
                              <div class="check"></div>
                           </div>
                           <div class="radio-btn aftr-cl">
                              <input  id="Radio5" name="gender" type="radio" value="F" @if(isset($patient_arr['gender']) && $patient_arr['gender']=='F') checked="checked" @endif/>
                              <label for="Radio5" data-toggle="modal" href="#send-order" class="forgetpwd" onclick="javascript:$('#Radio5').attr('checked',true); return true;">Female</label>
                              <div class="check"></div>
                           </div>
                         </div>
                        <div id="err_gender" class="err" style="position: inherit;"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Email <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Email Address" name="email_address" id="email_address" class="form-inputs" type="text" readonly="true" value="{{isset($patient_arr['userinfo']['email'])?$patient_arr['userinfo']['email']:''}}" />
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <?php $day=$months=$year="";
                 if(isset($patient_arr['date_of_birth']) && $patient_arr['date_of_birth']!='0000-00-00')
                 {

                     list($year,$months,$day) = explode('-',$patient_arr['date_of_birth']);
                 } 

                ?>
             </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Date of Birth <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-4 col-md-3 col-lg-3">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="day_of_birth" id="day_of_birth">
                              <option value="">- Date -</option>
                              <?php 
                                 for($i=1;$i<=31;$i++)
                                 { ?>
                                  
                                    <option @if($day!="" && $i==$day) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                 <?php   
                                 }
                              ?>
                           </select>
                        </div>
                        <div class="err" id="err_day_of_birth"></div>    
                      </div>
                     <div class="col-sm-4 col-md-3 col-lg-3 margn">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="date_of_month" id="date_of_month">
                              <option value="">- Month -</option>
                              @if(count($arr_months)>0)
                              @foreach($arr_months as $key=>$month)
                                 <option @if($months!="" && $key==$months) selected="selected" @endif value="{{$key}}">{{$month}}</option>
                              @endforeach   
                              @endif
                           </select>
                        </div>
                       <div class="err" id="err_date_of_month"></div>    
                     </div>
                     <div class="col-sm-4 col-md-3 col-lg-3">
                        <div class="select-style my-pati">
                           <select class="frm-select" name="date_of_year" id="date_of_year">
                              <option value="">- Year -</option>
                              <?php $current_year = date('Y');
                              for($i=1900;$i<=$current_year;$i++)
                              { 
                                 ?>

                                 <option @if($year!="" && $i==$year) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                                <?php  
                              }
                              ?>
                           </select>
                        </div>
                       <div class="err" id="err_date_of_year"></div>   
                     </div>

                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Mobile No. <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                      <input placeholder="Mobile Number" name="mobile_no" id="mobile_no" class="form-inputs" type="text" value="{{isset($patient_arr['mobile_no'])?$patient_arr['mobile_no']:''}}"/>
                       <!--  <span class="num-digit">+61</span> -->
                        <div class="err" id="err_mobile_no"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Phone No <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Phone No (02) 9876 5432" name="phone_no" id="phone_no" class="form-inputs" type="text" value="{{isset($patient_arr['phone_no'])?$patient_arr['phone_no']:''}}"/>
                        <div class="err" id="err_phone_no"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>   
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Address <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter your Postal Address" name="address" id="autocomplete" class="form-inputs pharamcyinfo" type="text" value="{{isset($patient_arr['streen_address'])?$patient_arr['streen_address']:''}}" />
                        
                         <input type="hidden" name="street_number" id="street_number">
                         <input type="hidden" name="route" id="route">
                         <input type="hidden" name="locality" id="locality">
                         <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1">
                         <input type="hidden" name="post_code" id="postal_code">
                         <input type="hidden" name="country" id="country">
                        <a href="javascript:void(0);"><span id="span_manually_address" class="grn-msg"> Or enter address manually</span></a>
                        <input type="hidden" name="manually_flag" id="manually_flag">
                        <div class="err" id="err_address"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="manually_div" @if(isset($patient_arr['manually_address']) && $patient_arr['manually_address']!="") style="display:block;" @else style="display:none;" @endif>
                <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Address</div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter your address manually" name="manually_address" id="manually_address" class="form-inputs" type="text" value="{{isset($patient_arr['manually_address'])?$patient_arr['manually_address']:''}}"/>
                        <div class="err" id="err_manually_address"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Suburb <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Suburb" id="suburb" name="suburb" class="form-inputs pharamcyinfo" type="text" value="{{isset($patient_arr['suburb'])?$patient_arr['suburb']:''}}"  />
                        <div class="err" id="err_suburb"></div>

                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               </div>
               <div class="user-box">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-lable">Zipcode <span class="star">*</span></div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <input placeholder="Enter Zipcode" name="zipcode" id="postal_code" class="form-inputs" type="text" value="{{isset($patient_arr['zipcode'])?$patient_arr['zipcode']:''}}"/>
                        <div class="err" id="err_zipcode"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
        
         </div>
         <div class="pull-right hidden-lg" style="margin:10px 0 0">
            <button class="search-btn btn_save_profile" name="btn_save_profile"  type="button">Save My Profile</button>
         </div>
         <div class="clearfix"></div>
         <br/>
       </form> 
      </div>
   </div>
  <div class="sticky_btn visible-lg">
        <button class="search-btn btn_save_profile" name="btn_save_profile"  type="button">Save My Profile</button>
     </div>
</div>
  




<!--Pharmacy Deatil end here-->
<!--dashboard section-->
 <!--file upload js -->
<script src="{{url('/')}}/public/js/bootstrap-fileupload.js"></script>
<link href="{{url('/')}}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- custom scrollbar plugin -->
<script src="{{url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>    
<script  src="{{ url('/') }}/public/js/jquery-ui.js"></script> 
<script>
      (function($){
      $(window).on("load",function(){
      
      $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
      $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
      
              $("#content-d1").mCustomScrollbar({theme:"dark"});
    
              
      });
      })(jQuery);

      function readURL(input) {


        if (input.files) {

           var profile_image=input.files[0]['name'];
          
            $("#err_profile_image").html("");

             var ext = profile_image.split('.').pop();
          
             var file, img;

             if(ext != "gif" && ext != "GIF" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG" && ext != "png" && ext != "PNG" && ext != "BMP" && ext != "bmp")
             {
                    
                    $('#err_profile_image').fadeIn(); 
                   $('#err_profile_image').html('Please upload valid file with valid image extension i.e png,jpg,gif,bmp.');
                   $('#err_profile_image').fadeOut(4000);
                   $('html, body').animate({
                         scrollTop: $('#div_profile_of_patient').offset().top
                     }, 'slow');
                   $('#profile_image').focus();
                   return false;
             }
             else
             {
                  var reader = new FileReader();
              
                  reader.onload = function (e) {
                      $('#upload-f')
                          .attr('src', e.target.result)
                          .width(160)
                          .height(160);
                  };
                
                  reader.readAsDataURL(input.files[0]);
                  return true
            }      
        }
     }
</script>
<script>
 $(document).ready(function(){

 $('#span_manually_address').click(function(){
      $('#manually_div').toggle();
   });

   $('#phone_no').keyup(function()
     {
         num = $(this).val().replace(/\D/g,''); 
         $(this).val('('+num.substring(0,2) + ') ' + num.substring(2,6) + ' ' + num.substring(6,10)); 
     });

  

    $('.btn_save_profile').click(function(){
   
      var err_flag = 0;

      var title         = $('#title').val();
      var first_name    = $('#first_name').val();
      var last_name     = $('#last_name').val();
      var day_of_birth  = $('#day_of_birth').val();
      var date_of_month = $('#date_of_month').val();
      var date_of_year  = $('#date_of_year').val();
      var mobile_no     = $('#mobile_no').val();
      var phone_no      = $('#phone_no').val();
      var address       = $('#autocomplete').val();
      var city          = $('#locality').val();
      var manually_add  = $('#manually_address').val();
      var suburb        = $('#suburb').val();
      var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var nodigit_regexp= /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
      var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;

      var phone_no_filter=/\?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
      if($.trim(title)=="")
      {
         $('#title').val('');
         $('#err_title').fadeIn();         
         $('#err_title').html('Please enter title.');
         $('#err_title').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#title').focus();
         err_flag = 1
      } 
     else if($.trim(first_name)=="")
      {
         $('#first_name').val('');
         $('#err_first_name').fadeIn();
         $('#err_first_name').html('Please enter first name.');
         $('#err_first_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#first_name').focus();
         err_flag = 1
      } 
      else if(!nodigit_regexp.test(first_name))
      {
        
         $('#first_name').val('');
         $('#err_first_name').fadeIn();
         $('#err_first_name').html('Please enter valid first name,only character allowed.');
         $('#err_first_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#first_name').focus();
          err_flag = 1
      } 
      else if($.trim(last_name)=="")
      {

         $('#last_name').val('');
         $('#err_last_name').fadeIn();
         $('#err_last_name').html('Please enter last name.');
         $('#err_last_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#last_name').focus();
          err_flag = 1
      } 
      else if(!nodigit_regexp.test(last_name))
      {
         $('#last_name').val('');
         $('#err_last_name').fadeIn();
         $('#err_last_name').html('Please enter valid last name,only character allowed.');
         $('#err_last_name').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#last_name').focus();
          err_flag = 1
      } 
      else if(!$('input[name="gender"]').is(':checked'))
      {
         $('#err_gender').fadeIn();
         $('#err_gender').html('Please select gender.');
         $('#err_gender').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('input[name="gender"]').focus();
          err_flag = 1
      } 
      else if($.trim(day_of_birth)=="")
      {
         $('#day_of_birth').val('');
         $('#err_day_of_birth').fadeIn();
         $('#err_day_of_birth').html('Please select day.');
         $('#err_day_of_birth').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#day_of_birth').focus();
          err_flag = 1
      } 
      else if($.trim(date_of_month)=="")
      {
         $('#date_of_month').val('');
         $('#err_date_of_month').fadeIn();
         $('#err_date_of_month').html('Please select month.');
         $('#err_date_of_month').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#date_of_month').focus();
          err_flag = 1
      } 
      else if($.trim(date_of_year)=="")
      {

         $('#date_of_year').val('');
         $('#err_date_of_year').fadeIn();
         $('#err_date_of_year').html('Please select year.');
         $('#err_date_of_year').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#date_of_year').focus();
          err_flag = 1
      } 
      else if($.trim(mobile_no)=="")
      {
         $('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(!onlydigit.test(mobile_no))
      {
         $('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter valid mobile number.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(mobile_no.length < 10)
      {
         //$('#mobile_no').val('');
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number of 10 digit.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if(mobile_no.length > 10)
      {
         $('#err_mobile_no').fadeIn();
         $('#err_mobile_no').html('Please enter mobile number of 10 digit.');
         $('#err_mobile_no').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#mobile_no').focus();
          err_flag = 1
      } 
      else if($.trim(phone_no)=='')
      {
         $('#err_phone_no').show();
         $('#phone_no').focus();
         $('#err_phone_no').html('Please enter phone number.');
         $('#err_phone_no').fadeOut(4000);

         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#phone_no').focus();
          err_flag = 1
      } 
      else if(phone_no=='()  ' || phone_no.length<14)
      {
         $('#err_phone_no').show();
         $('#phone_no').focus();
         $('#err_phone_no').html('Please enter valid phone number.');
         $('#err_phone_no').fadeOut(4000);

         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#phone_no').focus();
          err_flag = 1
      } 
      else if($.trim(address)=="")
      {
         $('#autocomplete').val('');
         $('#err_address').fadeIn();
         $('#err_address').html('Please enter your address.');
         $('#err_address').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#autocomplete').focus();
          err_flag = 1
      } 
      else if($.trim(suburb)=="" && manually_add!="")
      {
         $('#suburb').val('');
         $('#err_suburb').fadeIn();
         $('#err_suburb').html('Please enter suburb name.');
         $('#err_suburb').fadeOut(4000);
         $('html, body').animate({
               scrollTop: $('#main-content').offset().top
           }, 'slow');
         $('#suburb').focus();
          err_flag = 1
      } 
      if(err_flag==0)
      {
          $('#profile-modal').modal('toggle');
      }
      else
      {
          return false;
      }
    });   


}); 

  var glob_autocomplete;
  var componentForm = 
  {
    street_number: 'long_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'long_name',
    postal_code: 'short_name',
    country:'long_name'
  };

  var glob_options = {};
  glob_options.types = ['address'];

  function changeCountryRestriction(ref)
  {
    var country_code = $(ref).val();
    destroyPlaceChangeListener(autocomplete);
    // load states function
    // loadStates(country_code);  

    glob_options.componentRestrictions = {country: country_code}; 

    initAutocomplete(country_code);

    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
  }


  function initAutocomplete(country_code) 
  {
    glob_options.componentRestrictions = {country: country_code}; 

    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
  }


  function initGoogleAutoComponent(elem,options,autocomplete_ref)
  {
    autocomplete_ref = new google.maps.places.Autocomplete(elem,options);
    autocomplete_ref = createPlaceChangeListener(autocomplete_ref,fillInAddress);

    return autocomplete_ref;
  }
  

  function createPlaceChangeListener(autocomplete_ref,fillInAddress)
  {
    autocomplete_ref.addListener('place_changed', fillInAddress);
    return autocomplete_ref;
  }

  function destroyPlaceChangeListener(autocomplete_ref)
  {
    google.maps.event.clearInstanceListeners(autocomplete_ref);
  }

  function fillInAddress() 
  {
    // Get the place details from the autocomplete object.
    var place = glob_autocomplete.getPlace();

    for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
    }

    

    if(place.address_components.length > 0 )
    {

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

        var locality  = $('#locality').val();
        var state     = $('#administrative_area_level_1').val();
        var postcode  = $('#postal_code').val();
        var new_suburb = locality+' '+state+' '+postcode;
        $('#suburb').val(new_suburb);
       

      }
    
  }

</script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3&region=Australia&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places&callback=initAutocomplete" async defer></script>

@stop      