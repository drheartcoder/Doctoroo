@extends('front.doctor.layout.new_master')
 @section('main_content')
          <style>
        
        .consultation-time::before {
            content: "Day :";
        }
        
        .invoice-no::before {
            content: "Start Time :";
        }
        
        .invoice-total::before {
            content: "End Time :";
        }
        
        .invoice-status::before {
            content: "Fees :";
        }
        .action-btn::before {
            content: "Action :";
        }
        
      
        </style>
        <link href="{{ url('/' )}}/public/doctor_section/css/materialize.clockpicker.css" rel="stylesheet" media="screen,projection" />
        <script src="{{ url('/' )}}/public/doctor_section/js/materialize.clockpicker.js"></script>

        <div class="header bookhead z-depth-2 ">
            <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>

            <h1 class="main-title center-align">Fee Schedule</h1>
        </div>

        <div id="slide-out" class="side-nav fixed menu-main">
           @include('front.doctor.layout._new_sidebar')
        </div>

        <!--tabs start-->

        <div class="mar300  has-header minhtnor">
         <!-- <div class="dark-blue-patch">&nbsp;</div> -->
       
         
         <div class="doctor-container doctor-rates-main">
                <h2 class="center-align"></h2>
                
                          <div class="row">
                              <div class="col xl6 l12 s12">
                                  <div class="round-box z-depth-3">

                                        <input type="hidden" value="{{$doctoroo_commission}}" id="doctoroo_commission">
                                        <input type="hidden" value="{{$doctoroo_fee}}" id="doctoroo_fees">


                                        <form id="fees_form" method="post" action="{{ url('/doctor/membership/store_fees') }}" >
                                            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                            
                                            <div class="heading-round-box">Standard Fee Schedule </div>
                                                <div class="green-border round-box-content medication-history-details posrel">
                                                    <div class="input-wrapper">
                                                        <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label class="days-label">Days <input name="doctor_id"  id="doctor_id" type="hidden" value="" /> <input name="fees_id"  id="fees_id" type="hidden" value="" /> </label>
                                                        </div>
                                                        <div class="col s8 m10  l10">
                                                            <div class="days-name modal-fields" id="days_block">
                                                                
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="mon" id="mon" type="checkbox">
                                                                        <label for="mon"><span>Mon</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="tue" id="tue" type="checkbox">
                                                                        <label for="tue"><span>Tue</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="wed" id="wed" type="checkbox">
                                                                        <label for="wed"><span>Wed</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="thu" id="thu" type="checkbox">
                                                                        <label for="thu"><span>Thur</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="fri" id="fri" type="checkbox">
                                                                        <label for="fri"><span>Fri</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="sat" id="sat" type="checkbox">
                                                                        <label for="sat"><span>Sat</span></label>
                                                                    </span>
                                                                    <span>
                                                                        <input class="selected_day" name="day[]" value="sun" id="sun" type="checkbox">
                                                                        <label for="sun"><span>Sun</span></label>
                                                                    </span>
                                                                     <!--<span class="error" style="display: block;">g</span>-->
                                                                    <span id="err_week_days" class="err-msg" style="color:red;"></span>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="input-wrapper">
                                                    <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label>Time</label>
                                                        </div>
                                                        <div class="col s8 m10 l10">
                                                            <div class="row">
                                                                <div class="col s12 m5 l5">
                                                                  
                                                                   <div class="input-field clock-pick" style="margin-top:0px;">
                                                                        <span class="clock-icn">&nbsp;</span>
                                                                        <input id="start_time" name="start_time" type="text" class="validate available_time" placeholder="Start Time">
                                                                        <span id="err_start_time" class="err-msg" style="color:red;"></span>
                                                                     </div>
                                                                </div>
                                                                <div class="col s12 m2 l2">
                                                                    <div class="middle-sign">to</div>
                                                                </div>
                                                                <div class="col s12 m5 l5">
                                                                    <div class="input-field clock-pick" style="margin-top:0px;">
                                                                        <span class="clock-icn">&nbsp;</span>
                                                                        <input id="end_time" name="end_time" type="text" class="validate available_time" placeholder="End Time">
                                                                        <span id="err_end_time" class="err-msg" style="color:red;"></span>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="input-wrapper">
                                                   
                                                    <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label>GP Fee</label>
                                                        </div>
                                                        <div class="col s8 m10 l10">
                                                            <div class="row">
                                                                <div class="col s12 m5 l5">
                                                                    <div class="gp-fee-input">
                                                                        <span>$</span><input type="text"  placeholder="00.00" id="gp_in_min" name="gp_in_min"/><span>/min</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col s12 m2 l2">
                                                                    <div class="middle-sign">=</div>
                                                                </div>
                                                                <div class="col s12 m5 l5">
                                                                     <div class="gp-fee-input">
                                                                        <span>$</span><input type="text" readonly placeholder="00.00" id="gp_in_hr" name="gp_in_hr"/><span>/hr</span>
                                                                        <h6>pro-rata hourly rates</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                    </div>
                                                    <div class="input-wrapper">
                                                    <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label>Earnings</label>
                                                        </div>
                                                        <div class="col s8 m10  l10">
                                                           <div class="rates-block">
                                                            <div class="row">
                                                                <div class="col s12 m5 l5">
                                                                   <div class="rates">
                                                                       <input type="hidden" placeholder="00.00" id="earning_of_four_min" name="earning_of_four_min"/>
                                                                       <h4 id="earning_of_four_min_text">$00.00</h4>
                                                                       <h6>for first 4 minutes</h6>
                                                                   </div>
                                                                </div>
                                                                <div class="col s12 m2 l2">
                                                                    <div class="middle-sign bold"><i class="fa fa-plus"></i></div>
                                                                </div>
                                                                <div class="col s12 m5 l5">
                                                                    <div class="rates">
                                                                        <input type="hidden" placeholder="00.00" id="earning_of_min" name="earning_of_min"/>
                                                                       <h4 id="earning_of_min_text">$00.00</h4>
                                                                       <h6>per additional minute</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h5>Includes GST + $ 2.50 card processing fee</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                     <div class="input-wrapper">
                                                    <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label>Doctoroo Fee</label>
                                                        </div>
                                                        <div class="col s8 m10  l10">
                                                           <div class="rates-block">
                                                            <div class="row">
                                                                <div class="col s12 m5 l5">
                                                                    <div class="rates">
                                                                       <input type="hidden" placeholder="00.00" id="doctoroo_fee" readonly name="doctoroo_fee"/>
                                                                       <h4 id="doctoroo_fee_text" >$00.00</h4>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                            <h5>(${{$doctoroo_fee}} + {{$doctoroo_commission}}%)</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                     <div class="input-wrapper">
                                                    <div class="row">
                                                        <div class="col s4 m2 l2">
                                                            <label>Total Patient Fee</label>
                                                        </div>
                                                        <div class="col s8 m10  l10">
                                                           <div class="rates-block">
                                                            <div class="row">
                                                                <div class="col s12 m5 l5">
                                                                   <div class="rates">
                                                                       <input type="hidden" placeholder="00.00" id="total_patient_fee_of_four_min" readonly name="total_patient_fee_of_four_min"/>
                                                                       <h4 id="total_patient_fee_of_four_min_text" >$00.00</h4>
                                                                       <h6>for first 4 minutes</h6>
                                                                   </div>
                                                                </div>
                                                                <div class="col s12 m2 l2">
                                                                    <div class="middle-sign bold"><i class="fa fa-plus"></i></div>
                                                                </div>
                                                                <div class="col s12 m5 l5">
                                                                    <div class="rates">
                                                                        <input type="hidden" placeholder="00.00" id="total_patient_fee_of_additional_afer_four_min" name="total_patient_fee_of_additional_afer_four_min"/>
                                                                        <h4 id="total_patient_fee_of_additional_afer_four_min_text" >$00.00</h4>
                                                                        <h6>per additional after 4 minute</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="input-wrapper">
                                                         <div class="row">
                                                             <!-- <div class="col s4 m4 l4">
                                                                 <a href="my-patients-details.html#consultation-history" class="border-btn btn round-corner center-align m-0">Back</a>
                                                             </div> -->
                                                             <div class="col s6 m6 l6">
                                                                 <button type="reset" class="border-btn btn round-corner center-align m-0 Cancel">Cancel</button>
                                                             </div>
                                                             <div class="col s6 m6 l6">
                                                                 <button type="button" class="save_fess border-btn btn round-corner m-0 right">Save</button>
                                                             </div>
                                                          </div>
                                                    </div>
                                                     
                                                </div>
                                            <div class="green-border-block-bottom"></div>   
                                        </form>
                                  </div>
                                  
                              </div>
                              
                              <div class="col xl6 l12 s12">
                                  <div class="round-box z-depth-3 ">
                                      <div class="heading-round-box">Standard Fee Schedule</div>
                                            <div class="green-border round-box-content medication-history-details posrel">
                                               
                                               <div class="transactions-table table-responsive paitent-list-table ">
                                                <!--div format starts here-->
                                                <div class="table ">
                                                    <div class="table-row heading hidden-xs">
                                                        <div class="table-cell">Day</div>
                                                        <div class="table-cell">Start Time</div>
                                                        <div class="table-cell">End Time</div>
                                                        <div class="table-cell">Fees</div>
                                                        <div class="table-cell">Action</div>
                                                    </div>
                                                    <?php foreach($arr_getDoctorFees['data'] as $fees){

                                                        $start_time = convert_utc_to_userdatetime($doctor_id, "doctor", $fees->start_time);
                                                        $start_time = date('h:i a', strtotime($start_time));

                                                        $end_time =  convert_utc_to_userdatetime($doctor_id, "doctor", $fees->end_time);
                                                        $end_time =  date('h:i a', strtotime($end_time));
                                                        ?>
                                                            <div class="table-row content-row-table" id="{{$fees->id}}">
                                                                <div class="table-cell consultation-time">{{ strtoupper($fees->day) }}</div>
                                                                <div class="table-cell invoice-no">{{$start_time}}</div>
                                                                <div class="table-cell invoice-total">{{$end_time}}</div>
                                                                <div class="table-cell invoice-status">${{$fees->earning_for_4_min}}</div>
                                                                <div class="table-cell action-btn">
                                                                 <div class="posrel membership-drop">
                                                                    <a data-activates='dropdown{{$fees->id}}' class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                                                                    <ul id='dropdown{{$fees->id}}' class='dropdown-content doc-rop rightless'>
                                                                        <li><a class="view"  data-id="{{$fees->id}}">View</a></li>
                                                                        <li><a class="edit"  data-id="{{$fees->id}}">Edit</a></li>
                                                                        <li><a style="cursor:pointer" class="del"  data-id="{{$fees->id}}" >Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                    <?php } ?>
                                                </div>
                                                <?php if($obj_pagination != 'null'){
                                                    ?>
                                                         <div class="paginaton-block-main">
                                                            {{$obj_pagination->links()}}
                                                        </div>
                                                    <?php
                                                }?>
                                            </div>
                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                            
                                    </div>
                                <div class="green-border-block-bottom"></div>   
                          </div>
                      </div>
                  </div>
              <!-- <div class="next-step-btn">
                <p class="center-align bluedoc-text margin-top-45px" ><strong>Next Step:</strong></p>
                <a href="{{$module_url_path}}/payment" class="new-btn" >Select Premium Membership</a>
              </div> -->
        </div>
        </div>

        <a href="#remove_availability_popup" id="confirm_remove_popup_open" style="display: none">Delete</a>
        <div id="remove_availability_popup" class="modal addperson">
             <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
                <div class="row">
                    <div class="col s12 l12">
                        <p class="center-align">Are you sure you want to delete this record?</p>
                    </div>             
                </div>         
            </div>         
            <div class="modal-footer center-align">
                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
                <a href="javascript:void(0)"  class="modal-action waves-effect waves-green btn-cancel-cons" id="delete_fees">Yes</a>         
            </div>     
        </div>
        
        <input type="hidden" class="get_membership_time_slot_error_msg" id="get_membership_time_slot_error_msg" name="get_membership_time_slot_error_msg" value="{{ Session::get('message') }}" style="display: none;"/>
        <a class="open_membership_time_slot_error__popup" href="#membership_time_slot_error_msg" style="display: none;"></a>
        <div id="membership_time_slot_error_msg" class="modal addperson">
            <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
                <div class="row">
                    <div class="col s12 l12">
                        <div></div>
                        <p>{{ Session::get('message') }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer center-align ">
                <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
            </div>
        </div>


        <input type="hidden" id="dr_fees" name="dr_fees">
        <script>
            $(document).ready(function(){
                var get_err_msg = $('#get_membership_time_slot_error_msg').val();
                if(get_err_msg != '')
                {
                    $(".open_membership_time_slot_error__popup").click();
                }
            });
            $('.Cancel').click(function(){
                 $('.selected_day').attr('disabled', false);
                 $('.save_fess').show();
                 $('.save_fess').html('save');
            });     
 
            $('.del').click(function(){
              var id     = $(this).data('id'); 
              $('#dr_fees').val(id);
              $('#confirm_remove_popup_open').click();
            }); 

            $('#delete_fees').click(function(){
                var id     = $('#dr_fees').val();
                var url    = "{{ url('/doctor/membership/delete_doctor_fees') }}";
                var _token = $('#_token').val();

                    $.ajax({
                        url:url,
                        type:'post',
                        data:{id:id,_token:_token},
                        //dataType:'json',
                        success:function(data){
                            if(data == 'done'){
                                $('#'+id).hide();
                                $('#remove_availability_popup .modal-close').click();
                                $(".open_popup").click();
                                $('.flash_msg_text').html('Record deleted successfully');
                            }
                            else {
                                $('#remove_availability_popup .modal-close').click();
                                $(".open_popup").click();
                                $('.flash_msg_text').html('Something went wrong, Please try again later');
                            }
                        }
                    });
            });
            $('.edit').click(function(){
                var id     = $(this).data('id'); 
                var url    = "{{ url('/doctor/membership/edit_doctor_fees') }}";
                var _token = $('#_token').val();

                    $.ajax({
                        url:url,
                        type:'post',
                        data:{id:id,_token:_token},
                        //dataType:'json',
                        success:function(result){

                           $('.Cancel').click();

                           var data= new Array();
                           var data=result.split('_|_');
                           
                           $('#fees_id').val(data[0]);
                           $('#doctor_id').val(data[1]);

                           $('.selected_day').attr('disabled', true);
                           $('#'+data[2]).prop('checked', true);
                           $('#'+data[2]).attr('disabled', false);

                           $('#start_time').val(data[3]);
                           $('#end_time').val(data[4]);

                           $('#gp_in_min').val(data[5]);
                           $('#gp_in_hr').val(data[6]);

                           $('#earning_of_four_min').val(data[7]);
                           $('#earning_of_four_min_text').html('$'+data[7]);

                           $('#earning_of_min').val(data[8]);
                           $('#earning_of_min_text').html('$'+data[8]);

                           $('#doctoroo_fee').val(data[9]);
                           $('#doctoroo_fee_text').html('$'+data[9]);

                           $('#total_patient_fee_of_four_min').val(data[10]);
                           $('#total_patient_fee_of_four_min_text').html('$'+data[10]);

                           $('#total_patient_fee_of_additional_afer_four_min').val(data[11]);
                           $('#total_patient_fee_of_additional_afer_four_min_text').html('$'+data[11]);


                           $('.save_fess').html('update');
                        }
                    });
            });
            $('.view').click(function(){
                var id     = $(this).data('id'); 
                var url    = "{{ url('/doctor/membership/edit_doctor_fees') }}";
                var _token = $('#_token').val();

                    $.ajax({
                        url:url,
                        type:'post',
                        data:{id:id,_token:_token},
                        //dataType:'json',
                        success:function(result){

                           $('.Cancel').click();

                           var data= new Array();
                           var data=result.split('_|_');
                           
                           $('#fees_id').val(data[0]);
                           $('#doctor_id').val(data[1]);

                           
                           $('.selected_day').attr('disabled', true);
                           $('#'+data[2]).prop('checked', true);
                           $('#'+data[2]).attr('disabled', false);

                           $('#start_time').val(data[3]);
                           $('#end_time').val(data[4]);

                           $('#gp_in_min').val(data[5]);
                           $('#gp_in_hr').val(data[6]);

                           $('#earning_of_four_min').val(data[7]);
                           $('#earning_of_four_min_text').html('$'+data[7]);

                           $('#earning_of_min').val(data[8]);
                           $('#earning_of_min_text').html('$'+data[8]);

                           $('#doctoroo_fee').val(data[9]);
                           $('#doctoroo_fee_text').html('$'+data[9]);

                           $('#total_patient_fee_of_four_min').val(data[10]);
                           $('#total_patient_fee_of_four_min_text').html('$'+data[10]);

                           $('#total_patient_fee_of_additional_afer_four_min').val(data[11]);
                           $('#total_patient_fee_of_additional_afer_four_min_text').html('$'+data[11]);

                           $('.save_fess').hide();
                        }
                    });
            });
        </script>
        <script>
            $(document).ready(function() {

                  var doctoroo_fee        =  $('#doctoroo_fees').val();
                  var doctoroo_commission =  $('#doctoroo_commission').val();

                  var gp_in_min = $(this).val();
                  if(gp_in_min == ''){
                    gp_in_min = '0';
                  }

                  var gp_in_hr =  parseFloat( parseFloat(gp_in_min) * parseFloat(60) ).toFixed(2);
                  $('#gp_in_hr').val(gp_in_hr);

                  var earning_of_four_min =  parseFloat( parseFloat(gp_in_min) * parseFloat(4) ).toFixed(2);
                  $('#earning_of_four_min').val(earning_of_four_min);
                  $('#earning_of_four_min_text').html('$'+earning_of_four_min);


                  var earning_of_min =  parseFloat(gp_in_min).toFixed(2);
                  $('#earning_of_min').val(earning_of_min);
                  $('#earning_of_min_text').html('$'+earning_of_min);


                  var doctor_fee_commision =  parseFloat(earning_of_four_min) * ( parseFloat(doctoroo_commission) /100);
                  var doctoroo_fee         =  parseFloat( doctor_fee_commision + parseFloat(doctoroo_fee) ).toFixed(2);
                  $('#doctoroo_fee').val(doctoroo_fee);
                  $('#doctoroo_fee_text').html('$'+doctoroo_fee);


                  var total_patient_fee_of_four_min =  parseFloat(gp_in_min) * parseFloat(4);
                  var doctoroo_fee_for_four_min     = doctoroo_fee * parseFloat(4);

                  total_patient_fee_of_four_min     = parseFloat( parseFloat(total_patient_fee_of_four_min) + parseFloat(doctoroo_fee) ).toFixed(2);
                  $('#total_patient_fee_of_four_min').val(total_patient_fee_of_four_min);
                  $('#total_patient_fee_of_four_min_text').html('$'+total_patient_fee_of_four_min);

                  var total_patient_fee_of_additional_afer_four_min      = parseFloat(gp_in_min).toFixed(2);
                  $('#total_patient_fee_of_additional_afer_four_min').val(total_patient_fee_of_additional_afer_four_min);
                  $('#total_patient_fee_of_additional_afer_four_min_text').html('$'+total_patient_fee_of_additional_afer_four_min);


                        $('#gp_in_min').keyup(function(){

                          var doctoroo_fee        =  $('#doctoroo_fees').val();
                          var doctoroo_commission =  $('#doctoroo_commission').val();

                          var gp_in_min = $(this).val();
                          if(gp_in_min == ''){
                            gp_in_min = '0';
                          }

                          var gp_in_hr =  parseFloat( parseFloat(gp_in_min) * parseFloat(60) ).toFixed(2);
                          $('#gp_in_hr').val(gp_in_hr);


                          var earning_of_four_min =  parseFloat( parseFloat(gp_in_min) * parseFloat(4) ).toFixed(2);
                          $('#earning_of_four_min').val(earning_of_four_min);
                          $('#earning_of_four_min_text').html('$'+earning_of_four_min);


                          var earning_of_min =  parseFloat(gp_in_min).toFixed(2);
                          $('#earning_of_min').val(earning_of_min);
                          $('#earning_of_min_text').html('$'+earning_of_min);


                          var doctor_fee_commision =  parseFloat(earning_of_four_min) * ( parseFloat(doctoroo_commission) /100);
                          var doctoroo_fee         =  parseFloat( doctor_fee_commision + parseFloat(doctoroo_fee) ).toFixed(2);
                          $('#doctoroo_fee').val(doctoroo_fee);
                          $('#doctoroo_fee_text').html('$'+doctoroo_fee);


                          var total_patient_fee_of_four_min =  parseFloat(gp_in_min) * parseFloat(4);
                          var doctoroo_fee_for_four_min     = doctoroo_fee * parseFloat(4);

                          total_patient_fee_of_four_min     = parseFloat( parseFloat(total_patient_fee_of_four_min) + parseFloat(doctoroo_fee) ).toFixed(2);
                          $('#total_patient_fee_of_four_min').val(total_patient_fee_of_four_min);
                          $('#total_patient_fee_of_four_min_text').html('$'+total_patient_fee_of_four_min);

                          var total_patient_fee_of_additional_afer_four_min      = parseFloat(gp_in_min).toFixed(2);
                          $('#total_patient_fee_of_additional_afer_four_min').val(total_patient_fee_of_additional_afer_four_min);
                          $('#total_patient_fee_of_additional_afer_four_min_text').html('$'+total_patient_fee_of_additional_afer_four_min);

                        });

                  $('.Cancel').click(function(){
                      setTimeout(function(){
                          var doctoroo_fee        =  $('#doctoroo_fees').val();
                          var doctoroo_commission =  $('#doctoroo_commission').val();

                          var gp_in_min = $(this).val();
                          if(gp_in_min == ''){
                            gp_in_min = '0';
                          }

                          var gp_in_hr =  parseFloat( parseFloat(gp_in_min) * parseFloat(60) ).toFixed(2);
                          $('#gp_in_hr').val(gp_in_hr);

                          var earning_of_four_min = parseFloat( parseFloat(gp_in_min) * parseFloat(4) ).toFixed(2);
                          $('#earning_of_four_min').val(earning_of_four_min);
                          $('#earning_of_four_min_text').html('$'+earning_of_four_min);


                          var earning_of_min =  parseFloat(gp_in_min).toFixed(2);
                          $('#earning_of_min').val(earning_of_min);
                          $('#earning_of_min_text').html('$'+earning_of_min);


                          var doctor_fee_commision =  parseFloat(earning_of_four_min) * ( parseFloat(doctoroo_commission) /100);
                          var doctoroo_fee         =  parseFloat( doctor_fee_commision + parseFloat(doctoroo_fee) ).toFixed(2);
                          $('#doctoroo_fee').val(doctoroo_fee);
                          $('#doctoroo_fee_text').html('$'+doctoroo_fee);


                          var total_patient_fee_of_four_min =  parseFloat(gp_in_min) * parseFloat(4);
                          var doctoroo_fee_for_four_min     = doctoroo_fee * parseFloat(4);

                          total_patient_fee_of_four_min     = parseFloat( total_patient_fee_of_four_min + doctoroo_fee ).toFixed(2);
                          $('#total_patient_fee_of_four_min').val(total_patient_fee_of_four_min);
                          $('#total_patient_fee_of_four_min_text').html('$'+total_patient_fee_of_four_min);

                          var total_patient_fee_of_additional_afer_four_min      = parseFloat(gp_in_min).toFixed(2);
                          $('#total_patient_fee_of_additional_afer_four_min').val(total_patient_fee_of_additional_afer_four_min);
                          $('#total_patient_fee_of_additional_afer_four_min_text').html('$'+total_patient_fee_of_additional_afer_four_min);
                      },200);
                      $('html, body').animate({scrollTop:$('#err_week_days').position().top}, 'slow'); 
                  });

                  $('.save_fess').click(function(){
                     var days                =  $('[name="day[]"]:checked').length;
                     var start_time          =  $('#start_time').val();
                     var end_time            =  $('#end_time ').val();



                     $('.err-msg').html('');
                     var flag = 1;
                     if(days == 0){
                        $('#err_week_days').html('Please select atleast one day');
                        flag = 0;
                     } 
                     if(start_time == ''){
                        $('#err_start_time').html('Please select start time');
                        flag = 0;
                     } 
                     if(end_time == ''){
                        $('#err_end_time').html('Please select end time');
                        flag = 0;
                     }
                     if(flag == 1){
                          $('#fees_form').submit();
                          return true;
                     }  
                     else{
                        $('html, body').animate({scrollTop:$('#err_week_days').position().top}, 'slow');
                        return false;
                     }                   
                  });

            });
        </script>
        <div id="footer"></div>
        <!--  Scripts-->
        <script>
            $(".valign-wrapper").on("click", function () {
                $(this).parent(".collection-item").parent(".collection").parent(".user-message-left-bar").parent(".row").addClass("active");
            });
            $(".close-btn-block").on("click", function () {
                $(this).parent(".dashboard_one").parent(".row").removeClass("active");
            });
        </script>

        <script>
            $(".search-btn-content").on("click", function () {
                $(this).toggleClass("active");
                $(".search-hide-block").slideToggle("slow");
            });
            
            $('.available_time').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: true, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function(){} //Function for after opening timepicker
            });
        </script>
@endsection