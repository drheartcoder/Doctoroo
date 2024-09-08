@extends('front.doctor.layout.new_master')
@section('main_content')

    <link href="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" media="screen,projection" />
    <link href="{{ url('/') }}/public/doctor_section/js/datetimepicker/pmd-datetimepicker.css" rel="stylesheet" media="screen,projection" />

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="header bookhead nopad">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a>
        </div>
        <h1 class="main-title center-align">Calendar &amp; Availability</h1>
        <div class="right available-now-text"><span>Available Now</span>
            <span class="switch">
                <label>
                    <input type="checkbox" checked disabled>
                    <span class="lever greenbg"></span>
                </label>
            </span>
        </div>
    </div>

    <div class="mar300  has-header minhtnor light-grey">
        <div id="patient" class="tab-content medi ">
            <div class="container has-header paddingtpbtm posrel calendar-main-block">
                <div id="datepicker-inline"></div>
                <div class="divider"></div>
                <div class="clearfix"></div>
                <a class="waves-effect waves-light futbtn" href="#add_availability">+ Add Availability</a>
            </div>
            <div class="appointment-box-main">
                <div class="transactions-table table-responsive paitent-list-table patient-consultation-history">                    
                    <div class="table ">
                        <div class="table-row ">                            
                            <div class="table-cell"><span class="month-name-block" id="day">{{isset($current_day) ? $current_day : ''}}</span> <span id="month">{{isset($current_month) ? $current_month : ''}}</span></div>
                        </div>
                        <div class="table-row content-row-table">                            
                            <div class="table-cell transaction-date section-appointment-date">
                                <span class="appointment-date">
                                    <span class="time-appointment bluedoc-text">Available Time</span>
                                    <span id="availabel_time">
                                        @if(isset($get_available_time_arr) && !empty($get_available_time_arr))
                                            
                                            @foreach($get_available_time_arr as $val)
                                                
                                                <?php
                                                $start_time = convert_utc_to_userdatetime($doctor_id, "doctor", $val['start_time']);
                                                $end_time = convert_utc_to_userdatetime($doctor_id, "doctor", $val['end_time']);
                                                ?>

                                                <span class="subject-appointment">
                                                    {{ isset($val['start_time']) ? date('h:iA' , strtotime($start_time)) : '' }}-{{isset($val['end_time']) ? date('h:iA' , strtotime($end_time)) : '' }}
                                                    <a href="javascript:void(0)" data-id="{{$val['id']}}" data-date="{{date('d/m/Y', strtotime($val['date']))}}" data-start-time="{{$start_time}}" data-end-time="{{$end_time}}" class="edit_availability_time"><span class="fa fa-edit"></span></a>
                                                </span>                                  
                                            @endforeach
                                            
                                        @else
                                            <span class="subject-appointment"> No Available time</span>     
                                        @endif
                                    </span>
                                </span>  
                                <div class="divider"></div>
                            </div>                            
                        </div>
                        
                        <div class="table-row content-row-table">                            
                            <div class="table-cell transaction-date section-appointment-date">
                                    <span class="time-appointment bluedoc-text">Consultation Time</span>
                                    <span class="appointment-date" id="booking_time">
                                    @if(isset($get_booking_time_arr) && !empty($get_booking_time_arr))
                                        
                                        @foreach($get_booking_time_arr as $val)
                                            @if(isset($val['familiy_member_info']) && !empty($val['familiy_member_info']))
                                                <span class="appointment-date">
                                                    <span class="drop-arrow-img"></span>
                                                    <span class="subject-appointment">{{isset($val['familiy_member_info']['first_name']) ? $val['familiy_member_info']['first_name'] : ''}} {{isset($val['familiy_member_info']['last_name']) ? $val['familiy_member_info']['last_name'] : ''}} - {{$val['consultation_time']}} </span>
                                                </span>                                
                                            @else
                                                <span class="appointment-date">
                                                    <span class="drop-arrow-img"></span>
                                                    <span class="subject-appointment">{{isset($val['patient_user_details']['first_name']) ? $val['patient_user_details']['first_name'] : ''}} {{isset($val['patient_user_details']['last_name']) ? $val['patient_user_details']['last_name'] : ''}} - {{$val['consultation_time']}} </span>
                                                </span>                                
                                            @endif
                                        @endforeach
                                        
                                    @else
                                        <span class="subject-appointment"> No Consultation time</span>     
                                    @endif
                                    </span>
                                                               
                            </div>                            
                        </div>
                                                                
                    </div>
                </div>
            </div>            
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="add_availability" class="modal date-modal availability show">
        <form method="post" id="add_member_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Availability Session</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data modal-data-scroll">
                        
                     <div class="input-field text-bx modal-fields input-padding-25px">
                        <input id="date" name="date" type="date" class="available_date validate">
                        <label class="active" for="date">Date <span class="required_field">*</span></label>
                        <span class="error" id="err_date" style="display:none;"></span>
                     </div>
                 
                     <div class="input-field text-bx modal-fields input-padding-25px" style="margin-top:0px;">
                        <input id="start_time" name="start_time" type="text" class="validate available_time">
                        <label class="active" for="start_time">Available From <span class="required_field">*</span></label>
                        <span class="error" id="err_start_time" style="display:none;"></span>
                     </div>

                     <div class="input-field text-bx modal-fields input-padding-25px" style="margin-top: 0px;">
                        <input id="end_time" name="end_time" type="text" class="validate available_time">
                        <label class="active" for="end_time">Available To <span class="required_field">*</span></label>
                        <span class="error" id="err_end_time" style="display:none;"></span>
                     </div>

                     <div class="row">
                         <div class="col s6 m6">
                             <div class="input-field" >
                                Advanced Options
                                <span class="error" id="repeat_err"></span>
                             </div>
                         </div>
                         <div class="col s6 m6">
                            <div class="right" >
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" id="advance_options">
                                        <span class="lever greenbg"></span>
                                    </label>
                                </div>
                            </div>
                         </div>
                     </div>

                     <div class="row advance_options_fields" style="display: none;">
                         <div class="col s12 m12">
                             <div class="input-field selct gender-drop input-padding-25px" >
                                <label class="grey-text truncate small-text-label less-left">Repeats </label>
                                <select id="repeat" name="repeat" class="repeat" disabled>
                                   <option value="" selected>Select</option>
                                   <option value="daily" >Repeat Daily</option>
                                   <option value="weekly">Repeat Weekly</option>
                                 </select>
                                 <span class="error" id="err_repeat" style="display:none;"></span>
                             </div>
                         </div>
                         <!-- <div class="col s4 m3">
                            <div class="right" style="margin-top: 30px;">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" id="advance_options">
                                        <span class="lever greenbg"></span>
                                    </label>
                                </div>
                            </div>
                         </div> -->
                     </div>
                
                     <!-- <div class="input-field selct gender-drop modal-fields" style="margin-top: 10px; margin-right: 12px; margin-left: 12px;">
                          <label class="grey-text truncate small-text-label less-left">Frequency </label>
                            <select id="frequency" name="frequency" class="frequency">
                                <option value=""  selected disabled>Select</option>
                                <option value="every_day" >Every day</option>
                                <option value="every_2_day" >Every 2 days</option>
                                <option value="every_2_day" >Every 3 days</option>
                                <option value="every_4_day" >Every 4 days</option>
                                <option value="every_5_day" >Every 5 days</option>
                                <option value="every_6_day" >Every 6 days</option>
                                <option value="repeat_weekly">Repeat Weekly</option>
                            </select>
                     </div> -->
                
                     <div class="days-name modal-fields" style="margin-top: 10px; display: none;" id="days_block">
                         <label class="grey-text truncate small-text-label days-btm">Days </label>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Monday" id="mon" />
                                <label for="mon"><span>Mon</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Tuesday" id="tue" />
                                <label for="tue"><span>Tue</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Wednesday" id="wed" />
                                <label for="wed"><span>Wed</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Thursday" id="thurs" />
                                <label for="thurs"><span>Thur</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Friday" id="fri" />
                                <label for="fri"><span>Fri</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Saturday" id="sat" />
                                <label for="sat"><span>Sat</span></label>
                            </span>
                            <span>
                                <input class="selected_day" name="day" type="checkbox" value="Sunday" id="sun" />
                                <label for="sun"><span>Sun</span></label>
                            </span>
                             <!--<span class="error" style="display: block;">g</span>-->
                            <span  id="err_week_days" style="display:none;"></span>
                     </div>
                    <div class="advance_options_fields" style="display:none;">
                     <div class="row radio-new" style="margin-top: 30px;">
                         <div class="col s12">
                           <label class="grey-text truncate small-text-label days-btm">Ends  <span class="required_field">*</span></label>
                         </div>
                         <div class="error" id="err_ends_msg" style="display:none;"></div>

                         <div class="col s4 m3">
                            <input type="radio" name="radio_ends" id="radio_ends_on" />
                            <label for="radio_ends_on">On</label>
                         </div>
                         <div class="col s8 m9 ">
                             <div class="input-field text-bx input-padding-25px">
                                 <input id="ends_on" name="ends_on" type="text" class="validate available_date">
                                 <label class="active" for="ends_on">Select Date</label>
                                 <span class="error" id="err_ends_on" ></span>
                            </div>
                         </div>
                     </div>
                    </div>
                  
            </div>
            <div class="modal-footer ">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left">Cancel</a>
               <a href="javascript:void(0)" id="btn_save" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
            </div>
        </form>
    </div>
    
    <a href="#edit_availability_time" id="edit_availability_popup_open" style="display: none">Edit</a>
    <div id="edit_availability_time" class="modal  date-modal availability show">
        <form method="post" id="edit_availability_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="edit_available_id" id="edit_available_id">
            <div class="modal-content">
               <h4 class="center-align">Edit Availability Session</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data modal-data-scroll">
                     <div class="input-field text-bx modal-fields input-padding-25px">
                        <input id="edit_date" name="edit_date" type="text" class="" disabled=""> 
                        <label class="active" for="edit_date">Date</label>
                        <span class="error" id="err_edit_date" style="display:none;"></span>
                     </div>
                 
                     <div class="input-field text-bx modal-fields input-padding-25px" style="margin-top:0px;">
                        <input id="edit_start_time" name="edit_start_time" type="text" class="validate available_time">
                        <label class="active" for="edit_start_time">Available From <span class="required_field">*</span></label>
                        <span class="error" id="err_edit_start_time" style="display:none;"></span>
                     </div>

                     <div class="input-field text-bx modal-fields input-padding-25px" style="margin-top: 0px;">
                        <input id="edit_end_time" name="edit_end_time" type="text" class="validate available_time">
                        <label class="active" for="edit_end_time">Available To <span class="required_field">*</span></label>
                        <span class="error" id="err_edit_end_time" style="display:none;"></span>
                     </div>
            </div>
            <div class="modal-footer ">
               <!-- <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a> -->
               <a href="#remove_availability_popup" id="remove_availability_btn" class="modal-action waves-effect waves-green btn-cancel-cons left">Delete</a>
               <a href="javascript:void(0)" id="btn_edit_availability" class="modal-action waves-effect waves-green btn-cancel-cons right">Save</a>
            </div>
        </form>
    </div>

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
            <a href="javascript:void(0)" class="modal-action waves-effect waves-green btn-cancel-cons" id="delete_availability">Yes</a>         
        </div>     
    </div>

    <a href="#confirm_remove_availability_popup" id="confirm_remove_popup_open" style="display: none">Delete</a>
     <div id="confirm_remove_availability_popup" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="confirm_msg"></p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" class="modal-action waves-effect waves-green btn-cancel-cons" id="confirm_delete_availability">Yes</a>         
        </div>     
    </div>

    <script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/moment-with-locales.js"></script>
    <script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.js"></script>
    
    <script>
        var url = "<?php echo $module_url_path; ?>";

        $(document).ready(function(){

            $(document).on('click','.edit_availability_time',function(){
                $('#edit_available_id').val($(this).attr('data-id'));

                var date = $(this).attr('data-date');
                var start_time = $(this).attr('data-start-time').substring(11, 19);
                var end_time = $(this).attr('data-end-time').substring(11, 19);

                if(start_time !='' || start_time != null)
                {
                   var hours = start_time.substr(0,start_time.indexOf(':'));
                   var minutes = moment(start_time, ["h:mm A"]).format("mm");
                   if(hours > 12)
                   {
                     start_ext = 'PM';
                   }
                   else
                   {
                    start_ext = 'AM';
                   }

                   
                   var time_format = moment(start_time, ["h:mm A"]).format("A");;
                            
                    if(hours == 00)
                    {
                      start_time = '12'+':'+minutes+time_format;
                      $('#edit_start_time').val(start_time);     
                    }
                    else
                    {
                        time = start_time+start_ext;
                        var start_time = moment(time, ["h:mm A"]).format("hh:mmA");
                        $('#edit_start_time').val(start_time);     
                    }

                   
                   $('#edit_start_time').next('label').addClass('active');
                }
                else
                {
                    $('#edit_start_time').val('');   
                }

                if(end_time !='' || end_time != null)
                {
                   var end_hours = end_time.substr(0,end_time.indexOf(':'));
                   var minutes = moment(end_time, ["h:mm A"]).format("mm");
                   if(end_hours > 12)
                   {
                     end_ext = 'PM';
                   }
                   else
                   {
                    end_ext = 'AM';
                   }

                   var to_time_format = moment(end_time, ["h:mm A"]).format("A");;
                            
                    if(end_hours == 00)
                    {
                      end_time = '12'+':'+minutes+to_time_format;
                      $('#edit_end_time').val(end_time);     
                    }
                    else
                    {
                        time = end_time+start_ext;
                        var end_time = moment(time, ["h:mm A"]).format("hh:mmA");
                        $('#edit_end_time').val(end_time);     
                    }

                   $('#edit_end_time').next('label').addClass('active');
                }
                else
                {
                    $('#edit_end_time').val('');   
                }

                if(date != '' || date != null)
                {
                    $('#edit_date').val(date);
                    $('#edit_date').next('label').addClass('active');
                }
                else
                {
                 $('#edit_date').val('');   
                }

                $('#edit_availability_popup_open').click();
            });

            $('#btn_edit_availability').click(function(){
                var id = $('#edit_available_id').val();
                var start_time = $('#edit_start_time').val();
                var end_time = $('#edit_end_time').val();

                var start_time = moment(start_time, 'hh:mmA').unix();
                var end_time = moment(end_time, 'hh:mmA').unix();

                if(start_time == '' || start_time == null)
                {
                    $('#err_edit_start_time').show();
                    $('#err_edit_start_time').fadeOut(4000);
                    $('#err_edit_start_time').html('Please select from date.');
                    return false;

                }
                else if(end_time == '' || end_time == null)
                {
                    $('#err_edit_end_time').show();
                    $('#err_edit_end_time').fadeOut(4000);
                    $('#err_edit_end_time').html('Please select to date.');
                    return false;
                }
                else if(start_time >= end_time)
                {
                    $('#err_edit_end_time').show();
                    $('#err_edit_end_time').fadeOut(5000);
                    $('#err_edit_end_time').html('Invalid time. Start time should be less than to time');
                    return false;
                }

                $.ajax({
                    url:url+'/update',
                    type:'get',
                    data:{id:id,start_time:$('#edit_start_time').val(),end_time:$('#edit_end_time').val()},
                    dataType:'json',
                    success:function(data){
                        $("#edit_availability_time .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
                
            });
            
            $('#advance_options').click(function(){
                var option = $("#advance_options").is(":checked");
                if(option == true)
                {
                    $('#repeat').attr("disabled", false);
                    $('select').material_select();

                    $('.advance_options_fields').css('display','block');
                }
                else if(option == false)
                {
                    $('#repeat').attr("disabled", true);
                    $('select').material_select();

                    $('.advance_options_fields').css('display','none');
                    $('#days_block').css('display','none');
                }
            });

            $('#repeat').change(function(){
                if($(this).val() == 'daily')
                {
                    $('#days_block').hide();
                }
                else if($(this).val() == 'weekly')
                {
                    $('#days_block').show();
                }
            });

            $('#radio_ends_on').click(function(){
                var radio_ends_on = $('#radio_ends_on').is(":checked");
                if(radio_ends_on == true)
                {
                    $('#ends_on').attr("disabled", false);
                    //$('#after_occurence').attr("disabled", true);
                    $('select').material_select();
                }
                else if(radio_ends_on == false)
                {
                    $('#ends_on').attr("disabled", true);
                    //$('#after_occurence').attr("disabled", false);
                    $('select').material_select();
                }
            });

            $('#btn_save').click(function(){

                var date             = $('#date').val();
                var from_time        = $('#start_time').val();
                var to_time          = $('#end_time').val();

                var advance_options  = $("#advance_options").is(":checked");
                var repeat           = $('#repeat').val();

                var radio_ends_on    = $('#radio_ends_on').is(":checked");
                var ends_on          = $('#ends_on').val();

                //var radio_ends_after = $('#radio_ends_after').is(":checked");
              //  var after_occurence  = $('#after_occurence').val();

                var days = [];
                var days_cnt = 0;
                $('.selected_day').each(function(){
                    if($(this).is(':checked'))
                    {
                        days.push($(this).val());
                        days_cnt++;
                    }
                });

                /*var frequency       = $('#frequency').val();*/

                if(date == '' || date == null)
                {
                    $('#err_date').html("Please select date");
                    $('#err_date').show();
                    $('#err_date').fadeOut(8000);
                    return false;   
                }
                else if(from_time == '' || from_time == null)
                {
                    $('#err_start_time').html("Please select from available time.");
                    $('#err_start_time').show();
                    $('#err_start_time').fadeOut(8000);
                    return false;
                }
                else if(to_time == '' || to_time == null)
                {
                    $('#err_end_time').html("Please select to available time.");
                    $('#err_end_time').show();
                    $('#err_end_time').fadeOut(8000);
                    return false;  
                }
                else if(from_time == to_time)
                {
                    $('#err_end_time').html("Start and End available time should not be same.");
                    $('#err_end_time').show();
                    $('#err_end_time').fadeOut(8000);
                    return false;   
                }
                else if(advance_options == true)
                {
                    if(repeat == '')
                    {
                        $('#err_repeat').html("Please select repeat");
                        $('#err_repeat').show();
                        $('#repeat').focus();
                        $('#err_repeat').fadeOut(8000);
                        return false;
                    }
                    else if(repeat == 'weekly')
                    {
                        if(days_cnt == '')
                        {
                            $('#err_week_days').html("Please select atleast 1 day").css('color','red');
                            $('#err_week_days').show();
                            $('#err_week_days').fadeOut(8000);
                            return false;
                        }
                        else if(ends_on == '')
                        {
                            $('#err_ends_on').html("Please select end date");
                            $('#err_ends_on').show();
                            $('#err_ends_on').fadeOut(8000);
                            return false;   
                        }
                    }
                    else if(repeat == 'daily')
                    {
                        if(ends_on == '')
                        {
                            $('#err_ends_on').html("Please select end date");
                            $('#err_ends_on').show();
                            $('#err_ends_on').fadeOut(8000);
                            return false;   
                        }
                    }
                    
                }
                
                var _token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url:url+'/store',
                    type:'POST',
                    dataType:'json',
                    data:{
                            _token:_token,
                            date:date,
                            from_time:from_time,
                            to_time:to_time,
                            radio_ends_on:radio_ends_on,
                            ends_on:ends_on,
                            advance_options:advance_options,
                            repeat:repeat,
                            days:days
                         },
                    success:function(data){
                        $("#add_availability .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
            });

        });
    </script>
    
    <script>
     var url = "<?php echo $module_url_path; ?>";
        // Inline datepicker

        $('#datepicker-inline').datetimepicker({
            inline: true,
          }).on("dp.change", function(date) {

            var selected_date = date['date']['_d'];

            var get_selected_date = new Date(selected_date).getTime();
            var dateTime =  new Date(get_selected_date).toLocaleString('en-US', { timeZone: "{{config('app.timezone')}}" });
            dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");

            var month = selected_date.getMonth()+1;

            var formattedMonth = moment(month, 'MM').format('MMM');
            var day = selected_date.getDate();
            $('#month').html(formattedMonth);
            $('#day').html(day);

            var _token = "<?php echo csrf_token(); ?>";

            $.ajax({
                url:url+'/get_available_time',
                type:"post",
                data:{selected_date:dateTime,_token:_token},
                success:function(result){
                    if(result != '')
                    {
                        var res='';
                        availabel_time="";
                        $.each(result,function(i,obj)
                        {
                            var  dt = new Date(obj.date);
                            
                            date = moment(dt.toString()).format("DD/MM/YYYY");

                            var start_time = moment(obj.start_time.substring(11, 19), ["h:mm A"]).format("hh:mmA");
                            var end_time = moment(obj.end_time.substring(11, 19), ["h:mm A"]).format("hh:mmA");

                            var hours = start_time.substr(0,start_time.indexOf(':'));
                            var minutes = moment(obj.start_time, ["h:mm A"]).format("mm");
                            var time_format = moment(obj.start_time, ["h:mm A"]).format("A");
                            
                            if(hours == 00)
                            {
                              start_time = '12'+':'+minutes+time_format;
                            }

                            var to_hours = end_time.substr(0,end_time.indexOf(':'));
                            var to_minutes = moment(obj.start_time, ["h:mm A"]).format("mm");;
                            var to_time_format = moment(obj.start_time, ["h:mm A"]).format("A");;
                            
                            if(to_hours == 00)
                            {
                              end_time = '12'+':'+to_minutes+to_time_format;
                            }
                            
                            availabel_time +='<span class="subject-appointment">'+start_time+"-"+end_time+'<a href="javascript:void(0)" data-id="'+obj.id+'" data-date="'+date+'" data-start-time="'+obj.start_time+'" data-end-time="'+obj.end_time+'" class="edit_availability_time"> <span class="fa fa-edit"></a></span>';
                        });
                        
                        $('#availabel_time').html(availabel_time);
                    }
                    else
                    {
                        $('#availabel_time').html('<span class="subject-appointment">No Available time</span>');   
                    }
                }
            });

            $.ajax({
                url:url+'/get_booking_time',
                type:"post",
                data:{selected_date:selected_date,_token:_token},
                success:function(result){
                    if(result != '')
                    {
                        var name ='';
                        var time ='';
                        var booking =""
                        $.each(result,function(i,obj)
                        {
                         if(obj.familiy_member_info)
                         {
                            name = obj.familiy_member_info.first_name+' '+obj.familiy_member_info.last_name;

                         }
                         else
                         {
                            name = obj.patient_user_details.first_name+' '+obj.patient_user_details.last_name;
                         }
                         
                         time = obj.consultation_time;

                         booking +='<span class="appointment-date"><span class="drop-arrow-img"></span><span class="subject-appointment">'+name+' - '+time+'</span></span>';
                        });
                        
                        $('#booking_time').html(booking);
                    }
                    else
                    {
                        $('#booking_time').html('<span class="appointment-date"><span class="drop-arrow-img"></span><span class="subject-appointment">No Consultation Time</span></span>');   
                    }
                }
            });

        });
    </script>

    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>

    <script>
        $('.available_date').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            //selectYears: 100, // `true` defaults to 10.
            min: new Date(),
            //max:new Date(),
            onOpen: function() {
                console.log( 'Opened')
            },
            onClose: function() {
                console.log( 'Closed ' + this.$node.val() )
                //cal_selected_date = this.$node.val();
                //alert(cal_selected_date);
            },
            onSelect: function() {
                console.log( 'Selected: ' + this.$node.val() )
                cal_selected_date = this.$node.val();
                //alert(cal_selected_date);
            },
            onStart: function() {
                console.log( 'Hello there :)' )
            }

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

    <script>
        $(document).ready(function(){
            $('#remove_availability_btn').click(function(){
                $('#edit_availability_time .modal-close').click();
            });

            $('#delete_availability').click(function(){
                var id = $('#edit_available_id').val(); 
                $.ajax({
                    url:url+'/delete_available_time',
                    type:'get',
                    data:{id:id,action:'check_booking_time'},
                    dataType:'json',
                    success:function(data){

                        $('#remove_availability_popup .modal-close').click();
                        if(data.status =='success')
                        {
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                        }
                        else if(data.status == 'consultation_booked')
                        {
                            $('#confirm_remove_popup_open').click();
                            $('.confirm_msg').html(data.msg);
                        }
                    }
                });
            });

            $('#confirm_delete_availability').click(function(){
                var id = $('#edit_available_id').val(); 
                $.ajax({
                    url:url+'/delete_available_time',
                    type:'get',
                    data:{id:id,action:'confirm_delete'},
                    dataType:'json',
                    success:function(data){
                            $('#confirm_remove_availability_popup .modal-close').click();
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                    }
                });
            });


        });
    </script>

  
    @endsection

