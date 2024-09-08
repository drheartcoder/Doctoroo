@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<!--dashboard section-->            
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx" style="background: rgb(255, 255, 255)">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="see-d-dash-panel text-center">
                     @include('front.layout._operation_status')
                        <div class="distance">
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-left">
                              <a href="{{ url('/search/doctor/who-is-patient') }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
                           </div>
                           <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-10" style="position:relative;">
                              
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <li><a href="javascript:void(0);"><i class="fa fa-circle"></i></a></li>
                              <!-- <li><a href="{{ url('/search/doctor/prescription/questions') }}" class="skip-txt"> Skip this step</a> </li> -->
                           </ul>
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 arrow-grn text-right">
                              <a href="javascript:void(0);" class="chk_health_issue"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a>
                           </div>
                           <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                        <div class="section-box">
                           <div class="hidden-xs hidden-sm col-sm-2 col-md-1 col-lg-2">
                              &nbsp;
                           </div>
                           <form name="frm_what_are_you_seeking" id="frm_what_are_you_seeking" action="{{ url('/') }}/search/doctor/store_step_2_what_are_you_seeking_from_doctor" method="post" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="col-sm-12 col-md-10 col-lg-8">
                              <h4 id="service">What are you seeking from the doctor?</h4>
                              <div class="step-radios">
                              <?php $advice_and_treatement = $all = $prescription = $medical_certificate ='';
                              if(count($arr_booking)>0)
                              { 
                                 $arr_cons = explode(',',$arr_booking[0]['consultation_for']); 
                                 if(in_array('advice_and_treatement',$arr_cons))
                                 {
                                    $advice_and_treatement = 'checked="checked"';
                                 }
                                 if(in_array('prescription',$arr_cons))
                                 {
                                    $prescription = 'checked="checked"';
                                 }
                                 if(in_array('medical_certificate',$arr_cons))
                                 {
                                    $medical_certificate = 'checked="checked"';
                                 }
                                 if(in_array('All',$arr_cons))
                                 {
                                    $all = 'checked="checked"';
                                 }
                              } 
                              ?>
                                 <div class="radio-btn">
                                    <input class="service" type="checkbox" id="advice_and_treatement" value="advice_and_treatement" name="selector[]" <?php echo $advice_and_treatement; ?> />
                                    <label for="advice_and_treatement">
                                    <span class="interior-icon">
                                    Advice &amp;
                                    Treatment
                                    </span>
                                    </label>
                                    <div class="check br-rad"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input class="service" type="checkbox" id="prescription" value="prescription" name="selector[]" <?php echo $prescription; ?> />
                                    <label for="prescription" class="txt-cen">
                                    <span class="interior-icon">
                                    Prescription & Repeats
                                    </span>
                                    </label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input class="service" type="checkbox" id="medical_certificate" value="medical_certificate" name="selector[]" <?php echo $medical_certificate;  ?> />
                                    <label for="medical_certificate">
                                    <span class="interior-icon">
                                    Medical
                                    Certificate 
                                    </span>
                                    </label>
                                    <div class="check br-rad1"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input class="service" type="checkbox" id="all" value="All" name="selector[]" <?php echo $all; ?> />
                                    <label for="all" class="txt-cen">
                                    <span class="interior-icon">
                                    All
                                    </span>
                                    </label>
                                    <div class="check br-rad1"></div>
                                 </div>
                                 <div id="err_service" class="error"></div>
                              </div>
                              <br/>
                              <h4>Tell the Doctor what’s wrong</h4>
                              <div class="err" id="err_health_issue"></div>
                              <textarea class="dash-area" name="health_issue" id="health_issue" cols="0" placeholder="Why are you seeing the Doctor today? Describe the issue &amp; symptoms" rows="0"><?php if(isset($arr_booking[0]['health_issue'])){echo $arr_booking[0]['health_issue'];} ?></textarea>
                              
                              <h4>Show the Doctor</h4>
                              <h5> If visible, you can take a photo & show your doctor the affected area</h5>
                              <div class="pos">
                                 <div class="package">
                                    <div class="user-box">
                                       <input type="file" style="visibility:hidden; height: 0;" name="profile_image[]" id="profile_image0" />
                                       <div class="input-group browseImage" data-browse="0">
                                          <div class="btn btn-primary btn-file btn-gry">
                                             <a class="file">Chooose file
                                             </a>
                                          </div>
                                          <input type="text" placeholder="Upload Photo" class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled"/>
                                          <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                          <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_image">
                                             <a class="file" ><i class="fa fa-trash"></i>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="clones1">
                                    <a href="javascript:void(0);" class="clone-bx" id="add_package"><i class="fa fa-plus"></i></a>
                                 </div>
                                 <div class="clones">
                                    <a href="javascript:void(0)" id="remove_package" class="clone-bx"><i class="fa fa-minus"></i></a>
                                 </div>

                              <div class="step-radios image-hover" id="booking_images_div">
                              <?php if(count($arr_booking_images)>0){ 
                                 foreach ($arr_booking_images as $img_arr) {?>
                                 <div class="mass_photo">
                                   <span class="mass_close"><a class="booking_images" href="javascript:void(0)" data-id="<?php echo $img_arr['id'] ?>"><i class="fa fa-trash-o"></i></a></span>
                                    <img src="<?php echo $health_issue_base_img_public_path.$img_arr['health_image'] ?>" width="100%" />
                                </div>
                                 <!--<div class="radio-btn">
                                    <img src="<?php echo $health_issue_base_img_public_path.$img_arr['health_image'] ?>" width="100%" />
                                    <a class="booking_images" href="javascript:void(0);" data-id="<?php echo $img_arr['id'] ?>" >Delete</a>
                                 </div>-->
                                <?php } }?>
                              </div>
                              <div id="err_images"></div>
                              </div>
                              <a class="btn-grn chk_health_issue" href="javascript:void(0);" >Continue</a>
                              <br class="hidden-xs" />
                           </div>
                           </form>
                           <div class="hidden-xs hidden-sm col-sm-2 col-md-1 col-lg-2">
                              &nbsp;
                           </div>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard section-->
      <!--clone start-->
      <script>
         $(document).ready(function() {

         $('.service').click(function(){
            var val = $(this).val();
            if(val=='All')
            {
               if($(this).is(":checked"))
               {
                  $('input[name="selector[]"]').attr('checked',true);
               }
               else
               {
                  $('input[name="selector[]"]').attr('checked',false);  
               }
            }
         });


         $('.booking_images').click(function(){
              var id =  $(this).attr('data-id'); 
            $.ajax({
               url:'{{ url("/") }}/search/delete/booking_images/'+id,
               type:'GET',
               success:function(res){
                  if(res=='success')
                  {
                     showProcessingOverlay();
                     window.location.reload();
                  }  
                  else
                  {
                     $('#err_images').html('Error While deleting image , Please try again later');
                     return false;
                  }
               }
            });
         });

            $('.chk_health_issue').click(function(){
               var selector = $('input[name="selector[]"]:checked').length;
               var health_issue = $('#health_issue').val();
               if(selector==0)
               {
                  $('#err_service').show();
                  $('#service').focus();
                  $('#err_service').html('Please select service for you seeking for doctor.');
                  $('#err_service').fadeOut(4000);
                  return false; 
               }
               else if($.trim(health_issue)=='')
               {
                  $('#err_health_issue').show();
                  $('#health_issue').focus();
                  $('#err_health_issue').html('Please enter your health issue.');
                  $('#err_health_issue').fadeOut(4000);
                  return false; 
               }
               else
               {
                  $('#frm_what_are_you_seeking').submit();
                  return true;
               }
            });

            $('.browseImage').click(function(){ 
               var val = $(this).attr('data-browse');
               $('#profile_image'+val).trigger('click');
            });


            $('#add_package').on('click',function(){
               $('.package').last().clone(true,true).insertAfter($('.package').last());    
               var profile_image =    $('input[name="profile_image[]"]');
               var len = parseInt(profile_image.length); 
               $('input[name="profile_image[]"]').last().attr('id','profile_image'+len);
               $('input[name="profile_image[]"]').closest('div').find('.browseImage').attr('data-browse',len);
               $('input[name="profile_image[]"]').last().attr('value','');
            });
             
            $('#remove_package').on('click',function(){
               if($('.package').length>1)
               {
                  $('.package').last().remove();
               }
               else
               {
                  swal("Sorry ! Can't remove last record");
               }                                                       
            })             
         });
      </script>
      <!--clone start end-->
@stop