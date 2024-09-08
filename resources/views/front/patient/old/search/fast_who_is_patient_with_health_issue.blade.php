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
                              <a href="{{ url('/') }}/search/doctor/search_more_precise{{ '?'.Request::getQueryString() }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a>
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
                           <form name="frm_what_are_you_seeking" id="frm_what_are_you_seeking" action="{{ url('/') }}/search/doctor/store_fast_who_is_patient{{ '?'.Request::getQueryString() }}" method="post" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="col-sm-12 col-md-10 col-lg-8">
                              <h4 id="service">Who is a patient?</h4>
                               <div class="step-radios">
                               <div class="err" id="err_who_is_patient"></div>
                                 <div class="radio-btn">
                                    <input type="radio" id="f-option0" name="selector" value="0" <?php if(Session::get('booking_patient_id')=='0'){echo 'checked="checked"';} ?> class="chk_who_is_patient" />
                                    <label class="txt-cen" for="f-option0">
                                       <span class="interior-icon">
                                          Me
                                       </span>
                                    </label>
                                    <div class="check br-rad"></div>
                                 </div>
                                    <?php if(count($family_members)>0){ 
                                       foreach ($family_members as $value) {
                                          $booking_patient_id = '';
                                          if(Session::get('booking_patient_id')!='')
                                          {
                                             $booking_patient_id =   Session::get('booking_patient_id');
                                          }
                                       ?>
                                       <div class="radio-btn">
                                          <input class="chk_who_is_patient" type="radio" id="f-option<?php echo $value['id']; ?>" name="selector" value="<?php echo $value['id']; ?>" <?php  if($booking_patient_id==$value['id'])echo 'checked="checked"';  ?> />
                                          <label for="f-option<?php echo $value['id']; ?>" title="<?php echo $value['first_name']; ?>">
                                             <span class="interior-icon">
                                                <?php echo $value['first_name']; ?>
                                             </span>
                                          </label>
                                          <div class="check br-rad1"></div>
                                       </div>
                                    <?php } } ?>
                                 <div class="radio-btn">
                                    <input type="radio" id="f-option" name="selector" href="#add_new_patient" data-toggle="modal" id="add_new_member_id" />
                                    <label for="f-option">
                                       <span class="interior-icon">
                                          Someone<br/>
                                          Else
                                       </span>
                                    </label>
                                    <div class="check br-rad1"></div>
                                 </div>
                              </div>
                              <br/>                              
                             
                              <h4>Tell the Doctor what’s wrong</h4>
                              <div class="err" id="err_health_issue"></div>
                              <textarea class="dash-area" name="health_issue" id="health_issue" cols="0" placeholder="Why are you seeing the Doctor today? Describe the issue &amp; symptoms" rows="0"><?php if(isset($arr_booking[0]['health_issue'])){echo $arr_booking[0]['health_issue'];} ?></textarea>
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
       <div id="add_new_patient" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content logincont">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up" /></button>
               </div>
               <div class="modal-body bdy-pading">
               <form name="frm_add_family_member" id="frm_add_family_member" action="{{ url('/') }}/search/doctor/store_fast_who_is_patient{{ '?'.Request::getQueryString() }}" method="post">
               {{ csrf_field() }}
               <input type="hidden" class="input_acct-logn" name="account_action" id="account_action" value="" />
                  <div class="login_box">
                     <div class="title_login add">Add someone to your account</div>
                     <div class="user_box">
                        <input type="text" class="input_acct-logn" placeholder="First Name" name="first_name" id="first_name" />
                          <div class="err" id="err_first_name"></div>
                     </div>
                     <div class="user_box">
                        <input type="text" class="input_acct-logn" placeholder="Last Name" name="last_name" id="last_name" />
                          <div class="err" id="err_last_name"></div>
                     </div>
                     <div class="radio-btns user_box">
                        <div class="radio-btn">
                           <input checked="checked" id="male_id" name="gender" type="radio" value="Male"  />
                           <label for="male_id">Male</label>
                           <div class="check"></div>
                        </div>
                        <div class="radio-btn">
                           <input  id="female_id" name="gender" type="radio" value="Female" />
                           <label for="female_id">Female</label>
                           <div class="check">
                              <div class="inside"></div>
                           </div>
                        </div>
                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                     <div class="user_box">
                       <div class="row">
                        <!-- <input type="text" class="input_acct-logn datepicker" placeholder="Date of Birth" name="date_of_birth" id="date_of_birth" value="" /> -->
                          <div class="col-sm-4">
                            <div class="select-style pharma-step-drp">
                              <select id="day" name="day" class="frm-select">
                                    <option value="">- Date -</option>
                                    <?php 
                                    for($i=1;$i<=31;$i++)
                                    {?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php }
                                    ?>
                              </select>
                             </div>
                           </div>

                            <div class="col-sm-4">
                             <div class="select-style pharma-step-drp">
                              <select id="month" name="month" class="frm-select">
                                    <option value="">- Month -</option>
                                    <?php $month = array('1'=>'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec') ;
                                    for($m=1;$m<=count($month);$m++)
                                    {?>
                                        <option value="<?php echo $m; ?>"><?php echo $month[$m]; ?></option>
                                    <?php }
                                    ?>
                              </select>
                             </div>
                           </div>

                          <div class="col-sm-4">                         
                           <div class="select-style pharma-step-drp">
                            <select id="year" name="year" class="frm-select">
                                  <option value="">- Year -</option>
                                  <?php 
                                  for($y=1900;$y<=date('Y');$y++)
                                  {?>
                                      <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                  <?php }
                                  ?>
                            </select>
                           </div>
                           </div>
                          
                          </div>
                          <div class="err" id="err_date_of_birth"></div>
                          <div class="clearfix"></div>
                     </div>
                     <div class="user_box">
                        <input type="text" class="input_acct-logn" placeholder="Your relationship to them e.g. mother" name="relationship" id="relationship" value="" />
                          <div class="err" id="err_relationship"></div>
                     </div>
                     <div class="user_box">
                        <input type="text" class="input_acct-logn" placeholder="Mobile number" name="mobile_number" id="mobile_number" value="" />
                          <div class="err" id="err_mobile_number"></div>
                     </div>
                     <div class="clr"></div>
                     <div class="text-right bottom-padding user_box">
                        <a data-dismiss="modal" class="btn-grn1 tran-btn1 add_new_patient_close" style="cursor:pointer;">Cancel</a>
                        <button class="btn-grn1" type="submit" name="sbmt_add_member" id="sbmt_add_member" href="#confirm_add_member" data-toggle="modal">Add person</button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

     
      <div id="confirm_add_member" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content logincont">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up" /></button>
               </div>
               <div class="modal-body bdy-pading">
               <form name="frm_add_family_member" id="frm_add_family_member" action="{{ url('/') }}/search/store_family_member" method="post">
               {{ csrf_field() }}
                  <div class="login_box">
                     <div class="title_login add">"Would you like to create new account for this person or like to add in your account?"</div>
                     
                     <div class="clr"></div>
                     <div class="text-right bottom-padding user_box">
                        <a data-dismiss="modal" class="btn-grn1 tran-btn1 add_new_patient_close setvaluemember" style="cursor:pointer;" data-value="add_new_account">Add New Account</a>
                        <a data-dismiss="modal" class="btn-grn1 tran-btn1 add_new_patient_close setvaluemember" style="cursor:pointer;" data-value="add_to_this_account">Add to this account</a>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!--dashboard section-->
      <!--clone start-->
      <script>
         $(document).ready(function() {

      $('#sbmt_add_member').click(function(){
         var first_name    = $('#first_name').val();
         var last_name     = $('#last_name').val();
         var day           = $('#day').val();
         var month         = $('#month').val();
         var year          = $('#year').val();
         var relationship  = $('#relationship').val();
         var alpha = /^[a-zA-Z]*$/;
         var mobile_number = $('#mobile_number').val();
         var phone_no_filter=/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

         if($.trim(first_name)=='')
         {
            $('#err_first_name').show();
            $('#first_name').focus();
            $('#err_first_name').html('Please enter first name.');
            $('#err_first_name').fadeOut(4000);
            return false;  
         }
         else if(!alpha.test(first_name))
         {
            $('#err_first_name').show();
            $('#first_name').focus();
            $('#err_first_name').html('Please enter valid first name.');
            $('#err_first_name').fadeOut(4000);
            return false;  
         }
         else if($.trim(last_name)=='')
         {
            $('#err_last_name').show();
            $('#last_name').focus();
            $('#err_last_name').html('Please enter last name.');
            $('#err_last_name').fadeOut(4000);
            return false;  
         }
         else if(!alpha.test(last_name))
         {
            $('#err_last_name').show();
            $('#last_name').focus();
            $('#err_last_name').html('Please enter valid last name.');
            $('#err_last_name').fadeOut(4000);
            return false;  
         }
         else if($.trim(day)=='')
         {
            $('#err_date_of_birth').show();
            $('#day').focus();
            $('#err_date_of_birth').html('Please select Birth Date.');
            $('#err_date_of_birth').fadeOut(4000);
            return false;  
         }
         else if($.trim(month)=='')
         {
            $('#err_date_of_birth').show();
            $('#month').focus();
            $('#err_date_of_birth').html('Please select Birth Month.');
            $('#err_date_of_birth').fadeOut(4000);
            return false;  
         }
         else if($.trim(year)=='')
         {
            $('#err_date_of_birth').show();
            $('#year').focus();
            $('#err_date_of_birth').html('Please select Birth Year.');
            $('#err_date_of_birth').fadeOut(4000);
            return false;  
         }
         else if($.trim(relationship)=='')
         {
            $('#err_relationship').show();
            $('#relationship').focus();
            $('#err_relationship').html('Please enter relationship.');
            $('#err_relationship').fadeOut(4000);
            return false;  
         }
         else if($.trim(mobile_number)=='')
         {
            $('#err_mobile_number').show();
            $('#mobile_number').focus();
            $('#err_mobile_number').html('Please enter mobile number.');
            $('#err_mobile_number').fadeOut(4000);
            return false;  
         }
         else if(!phone_no_filter.test(mobile_number))
         {
            $('#err_mobile_number').show();
            $('#mobile_number').focus();
            $('#err_mobile_number').html('Please enter valid mobile number.');
            $('#err_mobile_number').fadeOut(4000);
            return false; 
         }
         else
         {
            //showProcessingOverlay();
            return true;
         }
      });


      $('.setvaluemember').click(function(){
         var acc = $(this).attr('data-value');
         $('#account_action').val(acc);
         $('#add_new_member_id').click();
         $('#frm_add_family_member').submit();
      });     

      $('.chk_health_issue').click(function(){ 
         var selector = $('input[name=selector]:checked'); 
         var health_issue = $('#health_issue').val();
         if(selector.length==0)
         {
            $('#err_who_is_patient').show();
            $('#err_who_is_patient').html('Please select who is a patient.');
            $('#err_who_is_patient').fadeOut(4000);
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

         });
      </script>
      <!--clone start end-->
@stop