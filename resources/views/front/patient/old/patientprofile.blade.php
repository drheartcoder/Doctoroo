@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<div class="middle-section min-heights">
    <div class="container">
       @include('front.layout._operation_status')
      <form method="post" name="frm_patient_profile" action="{{url('/')}}/patient/upload_profile" enctype="multipart/form-data">
      {{csrf_field()}}
       <div class="row">
           <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
           <div class="col-sm-10 col-md-8 col-lg-6 text-center">
           <div class="back-whhit-bx patient-white-bx" style="background:#fff">
          <div class="clearfix"></div>
           <div class="add-new-head">
            Upload Patient Profile
           </div>
            <div class="row" id="div_profile_of_patient">
            <div class="col-sm-12 col-md-12 col-lg-12  request-details-bx">
            <?php

               $profile_image = "";
               $arr_data                     = get_profile_image(); 
  
               if(isset($arr_data) && sizeof($arr_data)>0)
               {   
                  $profile_image                = $arr_data['profile_image'];
                  $user_profile_public_img_path = $arr_data['user_profile_public_img_path'];
                  $user_profile_base_img_path   = $arr_data['user_profile_base_img_path'];
               }

               ?>

                <div class="profile-edit-wrapper patient-pro-img" style="height:175px;">
                <div class="pro-edit-img">
                 @if(isset($profile_image) && $profile_image!="" && file_exists($user_profile_base_img_path.$profile_image))       
                   <img src="{{ url('/') }}/timthumb.php?src={{$user_profile_public_img_path.$profile_image}}&h=175&w=188" id="upload-f" alt=""/> 
                 @else
                     <img src="{{ url('/') }}/timthumb.php?src={{ $user_profile_base_img_path }}/default-image.jpeg&h=175&w=188" alt="" id="upload-f" />
                     
                  @endif   
                   <!--<div class="pro-dark-pattern">&nbsp;</div>-->
                  
                </div>
               
                <!--<span> <img src="{{url('/')}}/public/images/Profile-edit-img.png" alt=""/> </span>-->
                <input class="file-upload" type="file" onchange="readURL(this);" id="profile-image" name="profile-image"/>
                <input type="hidden" name="old_profile_image" value="{{$profile_image}}">
               </div>
                <div class="clearfix"></div>
                <div class="err" id="err_profile_image"> </div>
                <div class="clearfix"></div>

                <br/>
              
               <div class="note-txxt">Note: Please upload image with JPEG ,JPG ,PNG ,GIF, BMP image file formats with the size greater than 321 x164 resolution. </div>
             </div>
            <div class="clearfix"></div>
            <div class="text-center">
            <button type="submit" id="btn_patient_profile" name="btn_patient_profile" class="search-btn">Save My Profile</button><br/>
         </div>
         <div class="clearfix"></div>
         </div>
        </div>
           </div>
           <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
       </div>
        
      </form>  
    </div>
</div>
  <script>
    
     function readURL(input) 
     {

          if (input.files) {

           var profile_image=input.files[0]['name'];
          
            $("#err_profile_image").html("");

             var ext = profile_image.split('.').pop();
             var file, img;

             if(ext != "gif" && ext != "GIF" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG" && ext != "png" && ext != "PNG" && ext != "BMP" && ext != "bmp")
             {
                    
                   $('#err_profile_image').fadeIn(); 
                   $('#err_profile_image').html('Please upload valid file with valid image extension i.e png, jpg, bmp.');
                   //$('#err_profile_image').fadeOut(4000);
                   $('html, body').animate({
                         scrollTop: $('#div_profile_of_patient').offset().top
                     }, 'slow');
                   $('#profile_image').focus();
                   return false;
             }
             else
             {
                  var reader = new FileReader();
                   reader.readAsDataURL(input.files[0]);
                  reader.onload = function (e) {
                   
                        $('#upload-f')
                          .attr('src', e.target.result);
                          

                     var image = new Image();
                     image.src = e.target.result;
            
                    image.onload = function () {
                  
                    var height = this.height;
                    var width = this.width;
                   
                    if (height < 188 && width < 175) {

                        $('#err_profile_image').fadeIn(); 
                         $('#err_profile_image').html('Please upload image of size greater than 200 X 190 for better resolution.');
                         $('#err_profile_image').fadeOut(4000);
                         $('html, body').animate({
                               scrollTop: $('#div_profile_of_patient').offset().top
                           }, 'slow');
                         $('#profile_image').focus();
                         return false;
                     
                    }
                  
                    };      

                  };
             
                  return true
            }      
        }
     }
  </script>
@stop   
   