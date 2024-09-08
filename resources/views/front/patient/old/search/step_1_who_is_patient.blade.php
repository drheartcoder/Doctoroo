@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<style>
  .see-d-dash-panel.text-center {min-height: 600px;}
</style>
<!--dashboard section-->            
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx">
               <!-- <div class="row">-->
               <div class="dash-left">
                  <div class="see-doctr-panel">
                     <h2>See a Medical Doctor Now</h2>
                     <h4>for just $28 for the first 4 minutes</h4>
                     <a href="#pricing"  data-toggle="modal" class="chk_pricing">Check Pricing</a>   
                     <div class="bag-gren hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/see-dctr.png" alt=""/></div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-6 pdl">
                  <div class="see-d-dash-panel text-center">
                     <div class="distance">
                        <div class="row">
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-left"><!-- <a href="#"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt=""/></a> --></div>
                           <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">&nbsp;</div>
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-right"><a href="javascript:void(0);" class="chk_who_is_patient"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div>
                        </div>
                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                     <div class="section-box" >
                        @include('front.layout._operation_status')
                        <p>We need to ask a few questions to get you the best possible care.</p>
                        <h3>Who is the patient?</h3>
                        <form name="frm_who_is_patient" id="frm_who_is_patient" method="post" action="{{ url('/') }}/search/doctor/store_step_1_who_is_patient">
                        {{ csrf_field() }}
                        
                        <div class="row">
                           <div class="box-con-dash-step col-xs-10 col-sm-10 col-md-10 col-lg-10">
                           <div class="err" id="err_family_member"></div>
                              <div class="step-radios">
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
                           </div>
                        </div>
                        </form>
                     </div>
                     <!-- <a class="btn-grn chk_who_is_patient" href="javascript:void(0);" >Continue</a> -->
                  </div>
               </div>
               <div class="clr"></div>
               <!--  </div>-->
            </div>
         </div>
      </div>
      <!--login popup start here-->
      <div id="add_new_patient" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
         <div class="modal-dialog loign-insw">
            <!-- Modal content-->
            <div class="modal-content logincont">
               <div class="modal-header head-loibg">
                  <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up" /></button>
               </div>
               <div class="modal-body bdy-pading">
               <form name="frm_add_family_member" id="frm_add_family_member" action="{{ url('/') }}/search/store_family_member" method="post">
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

      

<div id="pricing" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
<div class="modal-dialog modal-lg">
<!-- Modal content-->
  <div class="modal-content">
      <div class="modal-header head-loibg">
      <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up" /></button>
      </div>
        <div class="modal-body bdy-pading">
          <!--pricing table start-->
          <div class="row">
               <div class="col-sm-12">
                <div class="plans-tble-bx">
                  <h1>We've summarized the cost in the following table</h1>
                </div>
                  <div class="prce-tble">
                  <?php $length_arr= $night_time_arr=$day_time_arr=array();
                  if(count($arr_pricing)>0)
                  {
                    foreach ($arr_pricing as $pricing_value) 
                    {
                        $length_arr[] = $pricing_value['length_of_call'];
                        $night_time_arr[] = $pricing_value['night_time_cost'];
                        $day_time_arr[] = $pricing_value['day_time_cost'];
                    }
                  }
                  ?>
                     <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Length of Call</h3>
                              <div class="pcr-sml">&nbsp;</div>
                           </div>
                           <?php 
                           $cnt = count($length_arr);
                           if($cnt>0){ 
                            $k = 1;
                            foreach ($length_arr as $len_value) { 
                              if($cnt!=$k){
                            ?>
                            <div class="<?php if(!$k%2==0){ echo 'gray-srtip'; }else{ echo 'white-strip'; } ?>"><?php echo $len_value; ?></div>
                            <?php }else{?>
                            <div class="tbl-btm"><?php echo $len_value; ?></div>
                           <?php } $k++; } }?>
                        </div>
                     </div>
                     <div class="col-sm-4 col-md-4 col-lg-4 pad-0">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Day-time cost</h3>
                              <div class="pcr-sml">(8am - 8pm)</div>
                           </div>
                           <?php 
                           $cnt = count($day_time_arr);
                           if($cnt>0){ 
                            $j = 1;
                            foreach ($day_time_arr as $day_value) { 
                              if($cnt!=$j){
                            ?>
                            <div class="<?php if(!$j%2==0){ echo 'gray-srtip chge-size'; }else{ echo 'white-strip chge-size'; } ?>"><?php echo $day_value; ?></div>
                            <?php }else{?>
                            <div class="tbl-btm chng-sf"><?php echo $day_value; ?></div>
                           <?php } $j++; } }?>

                        </div>
                     </div>
                     <div class="col-sm-4 col-md-4 col-lg-4 pad-0 last">
                        <div class="tble">
                           <div class="tble-heading">
                              <h3>Night-time cost</h3>
                              <div class="pcr-sml">(8pm - 8am)</div>
                           </div>
                           <?php 
                           $cnt = count($night_time_arr);
                           if($cnt>0){ 
                            $o = 1;
                            foreach ($night_time_arr as $night_value) { 
                              if($cnt!=$o){
                            ?>
                            <div class="<?php if(!$o%2==0){ echo 'gray-srtip chge-size'; }else{ echo 'white-strip chge-size'; } ?>"><?php echo $night_value; ?></div>
                            <?php }else{?>
                            <div class="tbl-btm chng-sf"><?php echo $night_value; ?></div>
                           <?php } $o++; } }?>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <?php if(count($arr_pricing_notes)>0){  ?>
               <div class="col-sm-12">
                  <div class="please-note">
                     <h4> Please Note</h4>
                     <div class="pln-list">
                        <ul>
                        <?php 
                          foreach ($arr_pricing_notes as $note_value) {
                          ?>
                          <li><span><img src="{{ url('/') }}/public/images/det-list-icn.png" alt="icn"/></span><?php echo $note_value['pricing_note']; ?></li>
                          <?php }  ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <?php } ?>
          </div>
          <!--pricing table end-->
          <!--see-doc section start-->
          <div class="see-dc">
                <div class="row">
                   <div class="col-sm-12 col-md-8 col-lg-8">
                      <div class="see-left">
                         <h3>See a doctor Today, from just $28</h3>
                         <p>Taking care of your health begins with a single step, make a doctoroo account and see a doctor today.</p>
                      </div>
                   </div>
                   <div class="col-sm-12 col-md-4 col-lg-4">
                      <button class="see-doctr-btn" data-dismiss="modal"> See a Doctor</button>
                   </div>
                </div>
          </div>
          <!--see-doc section end-->
        </div>
    </div>
  </div>
</div>

<!-- popup for ask full signup or fast signup -->
<div id="type_of_signup" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
  <div class="modal-dialog loign-insw">
    <!-- Modal content-->
    <div class="modal-content logincont">
      <div class="modal-header head-loibg">
        <button type="button" class="login_close close" data-dismiss="modal">
        <img src="{{ url('/') }}/public/images/close-popup.png" alt="Close Pop up">
        </button>
      </div>
      <div class="modal-body bdy-pading">
            <div class="login_box">
              <div class="title_login">Welcome to Doctoroo</div>
              <div class="tag-txt">How much time do you have to complete your signup?</div>
              <div class="clearfix"></div>
              <div class="login-bts">
              <div class="clr"></div>
             <div class="text-right bottom-padding user_box">
             <div class="two_btn_signup">
                <button class="btn-grn1" type="button" name="sbmt_fast_signup" onclick="javascript: window.location.href='<?php echo url('/patient/profile/fast'); ?>';" >Fast Signup</button>
                <p>
                1 Min to book doctor. </p><p>Your first consultation may take long</p>
              </div>
              <div class="two_btn_signup">
                <button class="btn-grn1" type="button" name="sbmt_full_signup" onclick="javascript: window.location.href='<?php echo url('/patient/profile'); ?>';" >Full Signup</button>
                <p>Takes 5-6 minutes. </p><p>Save consultation time and cost</p>
             </div>
             </div>
              </div>              
            </div>
      </div>
  </div>
</div>
<!-- popup for ask full signup or fast signup -->

<script>
   $(document).ready(function(){

    <?php if($show_popup=='1'){ ?>
      $('#type_of_signup').modal('show');
    <?php } ?>

      $('.chk_who_is_patient').click(function(){ 
         var family_member =    $('input[name=selector]:checked');
         if(family_member.length>0)
         {
            $('#frm_who_is_patient').submit();
            return true;
         }
         else
         {
            $('#err_family_member').html('Please select family member.');
            return false;
         }        
      });

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
      
   })
</script>
@stop