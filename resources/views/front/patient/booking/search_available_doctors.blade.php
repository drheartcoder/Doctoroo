@extends('front.patient.layout._dashboard_master')
@section('main_content')
    
    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow "><a href="{{ url('/') }}/patient/booking/show_available_doctors" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">Available Doctors</h1>
    </div>

    {{-- {{dump($available_doctor_today)}} --}}

    <div id="slide-out-right" class="side-nav z-depth-2 searchpatch" >
        <div class="blueHeader">
            <div class="valign-wrapper">
                <div class="searchdoc left">Search Doctors</div>
                <div class="result"></div>
                <div class="cancel right"><a href="">Cancel</a></div>
            </div>
        </div>

        <style>
            .name-suggestn ul li {
                border-bottom: 1px solid #eeeeee;
                color: #26a69a;
                display: block;
                font-size: 15px;
                padding: 7px 12px;
            }
        </style>

        <form method="GET" id="search_doctor_form" name="search_doctor" action="{{ url('/patient') }}/booking/search_available_doctors">
        <div class="searchform">
            <div class="drname">
                <div class="input-field name-suggestn">
                    <input id="doctor_name" name="doctor_name" placeholder="Type here" type="text" class="validate" autocomplete="off" @if(!empty($selected_doctor_name) && $selected_doctor_name != null ){ value="{{ $selected_doctor_name }}" } @endif >
                    <label for="doctor_name">Name of Doctor</label>
                    <span class="result_disp" style="cursor: pointer;"></span>
                </div>
            </div>
            <div class="divider"></div>
            
            <div class="other">
                <div class="input-field">
                    <label class="active" for="selected_date">Date</label>
                    <input id="selected_date" name="date" type="text" class="datepicker" @if(!empty($selected_date) && $selected_date != null){ value="{{ date('d/m/Y',strtoTime($selected_date)) }}" } @endif>

                </div>
            </div>

            <div class="divider"></div>
            <div class="other">
                <div class="input-field">
                    <label for="selected_time">Time </label>
                    <input id="selected_time" name="selected_time" class="timepicker" type="text" @if(!empty($selected_time) && $selected_time != null){ value="{{ $selected_time }}" } @endif>
                </div>
            </div>
            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select id="language" name="language">
                        <option value="">Select</option>
                        @if(isset($language) && !empty($language))
                            @foreach($language as $lang_data)
                                <option value="{{ $lang_data['id'] }}" @if(!empty($selected_language)) @if($selected_language == $lang_data['id']) selected @endif @endif >{{ $lang_data['language'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Languages spoken</label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select id="gender" name="gender">
                        <option value="">Select</option>
                        <option value="Male" @if(!empty($selected_gender)) @if($selected_gender == "Male") selected @endif @endif >Male</option>
                        <option value="Female" @if(!empty($selected_gender)) @if($selected_gender == "Female") selected @endif @endif >Female</option>
                    </select>
                    <label>Gender</label>
                </div>
            </div>
            <!-- <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select id="consult_fee" name="consult_fee">
                        <option value="">Sort by</option>
                        <option value="low" {{isset($sort_by) && $sort_by == 'low_to_high' ? 'selected' : '' }}>Low to High</option>
                        <option value="high"  {{isset($sort_by) && $sort_by == 'high_to_low' ? 'selected' : '' }}>High to Low</option>
                    </select>
                    <label>Consult fee</label>
                </div>
            </div> -->
            <div class="divider"></div>
            <div class="other" id="err_msg" >
                <div class="input-field">
                    <div class="err" id="err_form" style="display:none;"></div>
                </div>
            </div>
            <div class="side-footer">
                <a href="{{ url('/') }}/patient/booking/show_available_doctors" class="left search-btn">CLEAR</a>
                <button type="button" name="btn_sumbit" id="btn_sumbit" class="right search-btn">Search</button>
            </div>
        </div>
        {{ csrf_field() }}
        </form>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class=" app-header available-doc z-depth-2 has-header ">
        <div class="container">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col s12 l12 m12">
                    <div class="input-field searchHead button-collapse-open" data-activates="slide-out-right" class="button-collapse-open">
                        <a href="" class="menu-icon center-align prefix search-margin-o"><i class="material-icons">search</i></a>
                        <input type="text" id="autocomplete-input" class="autocomplete" placeholder="Search & filter doctors" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mar300 minhtnor">
        <div class="container">
            <div class="available-now">
                <div class="col s12 title1">Search Result(s)</div>
                @php
                    $count = 0;
                    $count_tomorrow = 0;
                @endphp
                @if(empty($selected_doctor_date))
                    <div class="col s12 title1">Available Now</div>
                    <ul class="collection">
                        @if(isset($available_doctor_today) && !empty($available_doctor_today))
                            
                            @foreach($available_doctor_today as $doc_data)
                                @php
                                    $current_date = date("Y-m-d");
                                @endphp

                                @if(isset($doc_data))
                                    @php
                                    // check listisng image
                                    if ( isset($doc_data['profile_image']) && !empty($doc_data['profile_image']) )
                                    {
                                        $profile_images = $doctor_image_url.$doc_data['profile_image'];
                                        // check if image exists or not
                                        if ( File::exists($profile_images) ) 
                                        {
                                            $profile_images = $doctor_image_url."default-image.jpeg";
                                        } // end if
                                    } // end if
                                    else
                                    {
                                        $profile_images = $doctor_image_url."default-image.jpeg";
                                    } // end else

                                    $get_date = isset($selected_date)?$selected_date:$doc_data['date'];
                                    
                                    

                                    $current_time = date('H:i:s');
                                    $consult_fee = '';

                                    if($doc_data['start_time'] <= $current_time && $doc_data['end_time'] <= $current_time)
                                    {
                                        $consult_fee = isset($doc_data['total_patient_fee_for_four_min']) ? '$'.$doc_data['total_patient_fee_for_four_min'] : '';
                                    }
                                    else
                                    {
                                        $get_consult_fee = DB::table('doctor_fees')->select('total_patient_fee_for_four_min')
                                                                                   ->where('doctor_id', $doc_data['user_id'])
                                                                                   ->orderBy('total_patient_fee_for_four_min', 'DESC')
                                                                                   ->first();

                                        $consult_fee = $get_consult_fee['total_patient_fee_for_four_min'];
                                    }

                                    @endphp
                                    
                                    <li class="collection-item avatar ">
                                        <a class="valign-wrapper" href="{{ url('/patient') }}/booking/available_doctor/{{ base64_encode($doc_data['user_id']) }}/{{ base64_encode($get_date) }}">
                                            <div class="image-avtar left">
                                                <img src="{{ $profile_images }}" alt="" class="circle" />
                                                @if($doc_data['is_online'] == 1)
                                                    <span class="onlinenew"></span>
                                                @else
                                                    <span class="online"></span>
                                                @endif
                                            </div>
                                            <div class="doc-detail  left"><span class="title">{{ $doc_data['title'].' '.$doc_data['first_name'].' '.$doc_data['last_name'] }}</span>
                                                <p class="doctor-price"><strong>Consult Fee :</strong> {{ $consult_fee }}</p>
                                            @php

                                                $current_time = date("H:i");
                                                $current_time_str = strtotime($current_time);
                                                
                                                $start_time = date("H:i" , strtotime($doc_data['start_time']));
                                                $start_time_str = strtotime($start_time);

                                                $end_time = date("H:i" , strtotime($doc_data['end_time']));
                                                $end_time_str = strtotime($end_time);
                                                
                                            @endphp
                                                @if($current_time_str > $start_time_str && $current_time_str < $end_time_str)
                                                    <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                                            @endif
                                            </div>
                                            
                                           
                                            <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">See now</span></div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                   
                                 @else
                                    @if($count == 0)
                                        <li class="collection-item avatar ">
                                            <p style="font-weight: 800; text-align: center; font-size: 18px; line-height: 60px;">{{ "Unfortunately no doctors are available" }}</p>
                                        </li>
                                        @php 
                                            $count = 1;
                                        @endphp
                                    @endif
                                @endif
                                
                            @endforeach
                        @else
                            <li class="collection-item avatar ">
                                <p style="font-weight: 800; text-align: center; font-size: 18px; line-height: 60px;">{{ "Unfortunately no doctors are available" }}</p>
                            </li>
                        @endif

                    </ul>
                @endif


                @if(empty($selected_doctor_date))
                     <ul class="collection ava-tomorrow">
                        <div class="col s12 title1">Available tomorrow</div>
                            @if(isset($available_doctor_tomorrow) && !empty($available_doctor_tomorrow))

                                @foreach($available_doctor_tomorrow as $doc_data)
                                        @if($doc_data)
                                            @php
                                            // check listisng image
                                            if ( isset($doc_data['profile_image']) && !empty($doc_data['profile_image']) )
                                            {
                                                $profile_images = $doctor_image_url.$doc_data['profile_image'];
                                                // check if image exists or not
                                                if ( File::exists($profile_images) ) 
                                                {
                                                    $profile_images = $doctor_image_url."default-image.jpeg";
                                                } // end if
                                            } // end if
                                            else
                                            {
                                                $profile_images = $doctor_image_url."default-image.jpeg";
                                            } // end else

                                            $get_date = isset($selected_date)?$selected_date:$doc_data['date'];
                                             $current_date = date("Y-m-d");

                                            $consult_fee = '';
                                            $consult_fee = isset($doc_data['total_patient_fee_for_four_min']) ? '$'.$doc_data['total_patient_fee_for_four_min'] : '';
                                            if($consult_fee == '')
                                            {
                                                $get_consult_fee = DB::table('doctor_fees')->select('total_patient_fee_for_four_min')
                                                                                           ->where('doctor_id', $doc_data['user_id'])
                                                                                           ->orderBy('total_patient_fee_for_four_min', 'DESC')
                                                                                           ->first();

                                                $consult_fee = $get_consult_fee['total_patient_fee_for_four_min'];
                                            }

                                            @endphp

                                            <li class="collection-item avatar ">
                                                <a class="valign-wrapper" href="{{ url('/patient') }}/booking/available_doctor/{{ base64_encode($doc_data['doctor_user_id']) }}/{{ base64_encode($get_date) }}">
                                                    <div class="image-avtar left">
                                                        <img src="{{ $profile_images }}" alt="" class="circle" />
                                                        @if($doc_data['is_online'] == 1)
                                                            <span class="onlinenew"></span>
                                                        @else
                                                            <span class="online"></span>
                                                        @endif
                                                    </div>
                                                    <div class="doc-detail  left"><span class="title">{{ $doc_data['title'].' '.$doc_data['first_name'].' '.$doc_data['last_name'] }}</span>
                                                    <p class="doctor-price"><strong>Consult Fee :</strong> {{ $consult_fee }}</p>
                                                    </div>
                                                    @php
                                                       
                                                    @endphp
                                                    <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">Book now</span></div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        @else
                                            @if($count_tomorrow == 0)
                                                <li class="collection-item avatar ">
                                                    <p style="font-weight: 800; text-align: center; font-size: 18px; line-height: 60px;">{{ "Unfortunately no doctors are available" }}</p>
                                                </li>
                                                @php 
                                                    $count_tomorrow = 1;
                                                @endphp
                                            @endif
                                        @endif
                                @endforeach
                            @else
                                <li class="collection-item avatar ">
                                    <p style="font-weight: 800; text-align: center; font-size: 18px; line-height: 60px;">{{ "Unfortunately no doctors are available" }}</p>
                                </li>
                            @endif

                    </ul>
                @endif
                @if(isset($selected_doctor_date) && !empty($selected_doctor_date))
                    <ul class="collection ava-tomorrow">
                        <div class="col s12 title1">Available On - {{isset($selected_doctor_date) && !empty($selected_doctor_date) ? date('d M Y' , strtotime($selected_doctor_date) ) : ''}}</div>
                            @if(isset($get_available_doctor_on_date) && !empty($get_available_doctor_on_date))

                                @foreach($get_available_doctor_on_date as $doc_data)
                                        @if($doc_data != '')
                                            @php
                                            // check listisng image
                                            if ( isset($doc_data['profile_image']) && !empty($doc_data['profile_image']) )
                                            {
                                                $profile_images = $doctor_image_url.$doc_data['profile_image'];
                                                // check if image exists or not
                                                if ( File::exists($profile_images) ) 
                                                {
                                                    $profile_images = $doctor_image_url."default-image.jpeg";
                                                } // end if
                                            } // end if
                                            else
                                            {
                                                $profile_images = $doctor_image_url."default-image.jpeg";
                                            } // end else

                                            $get_date = isset($selected_date)?$selected_date:$doc_data['date'];
                                             $current_date = date("Y-m-d");

                                            $consult_fee = '';
                                            $consult_fee = isset($doc_data['total_patient_fee_for_four_min']) ? '$'.$doc_data['total_patient_fee_for_four_min'] : '';
                                            if($consult_fee == '')
                                            {
                                                $get_consult_fee = DB::table('doctor_fees')->select('total_patient_fee_for_four_min')
                                                                                           ->where('doctor_id', $doc_data['user_id'])
                                                                                           ->orderBy('total_patient_fee_for_four_min', 'DESC')
                                                                                           ->first();

                                                $consult_fee = $get_consult_fee['total_patient_fee_for_four_min'];
                                            }

                                            @endphp

                                            <li class="collection-item avatar ">
                                                <a class="valign-wrapper" href="{{ url('/patient') }}/booking/available_doctor/{{ base64_encode($doc_data['doctor_user_id']) }}/{{ base64_encode($get_date) }}">
                                                    <div class="image-avtar left">
                                                        <img src="{{ $profile_images }}" alt="" class="circle" />
                                                        @if($doc_data['is_online'] == 1)
                                                            <span class="onlinenew"></span>
                                                        @else
                                                            <span class="online"></span>
                                                        @endif
                                                    </div>
                                                    <div class="doc-detail  left"><span class="title">{{ $doc_data['title'].' '.$doc_data['first_name'].' '.$doc_data['last_name'] }}</span>
                                                    <p class="doctor-price"><strong>Consult Fee :</strong> {{ $consult_fee }}</p>
                                                        @php

                                                            $current_time = date("H:i");
                                                            $current_time_str = strtotime($current_time);
                                                            
                                                            $start_time = date("H:i" , strtotime($doc_data['start_time']));
                                                            $start_time_str = strtotime($start_time);

                                                            $end_time = date("H:i" , strtotime($doc_data['end_time']));
                                                            $end_time_str = strtotime($end_time);
                                                            
                                                        @endphp
                                                        @if(date("Y-m-d" , strtotime($doc_data['date'])) == $current_date && $current_time_str > $start_time_str && $current_time_str < $end_time_str)
                                                            <p class="availability"><i class="material-icons">schedule</i> Available Now</p>
                                                        @endif
                                                    </div>
                                                    @php
                                                       
                                                    @endphp
                                                    @if(isset($doc_data['date']) &&  date("Y-m-d" , strtotime($doc_data['date'])) == $current_date)
                                                    <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">See now</span></div>
                                                    @else
                                                        <div class="doc-action right"> <span class="waves-effect waves-light btn secondary-content">Book now</span></div>
                                                    @endif

                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        @endif
                                @endforeach
                            @else
                                <li class="collection-item avatar ">
                                    <p style="font-weight: 800; text-align: center; font-size: 18px; line-height: 60px;">{{ "Unfortunately no doctors are available" }}</p>
                                </li>
                            @endif

                    </ul>
                @endif


            </div>

            <!-- Modal Cancel Consultation -->
            <div id="cancel-consult" class="modal cancel-consult">
                <div class="modal-content">
                    <h4>Cancel Consultation</h4>
                </div>
                <p>Are you sure you want to cancel this consultation?</p>
                <p>You will/won't be refunded the booking fee.</p>
                <p class="view-policy"><a href="javascript:void(0);"> View refund policy</a></p>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
                    <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
                </div>
            </div>
            <!-- Modal Structure End -->

            <!-- Modal Reminders -->
            <div id="reminders" class="modal cancel-consult">
                <div class="modal-content">
                    <h4>Reminders</h4>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="added-rem">
                            <div class="col s2"><i class="fa fa-bell"></i></div>
                            <div class="col s6 left-align"><span>5 minutes</span></div>
                            <div class="col s2"><i class="fa fa-angle-down"></i></div>
                            <div class="col s2">
                                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="added-rem">
                            <div class="col s2"><i class="fa fa-bell"></i></div>
                            <div class="col s6 left-align"><span>2 hours</span></div>
                            <div class="col s2"><i class="fa fa-angle-down"></i></div>
                            <div class="col s2">
                                <a href="javascript:void(0);"><img src="images/close-icon.png" alt="" /></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action waves-effect waves-green btn-add-remin"> <i class="material-icons">add</i> Add Reminder</a>
                </div>
            </div>
            <!-- Modal Reminders End -->

            <!--Container End-->
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#doctor_name').keyup(function(e){
                doc_keyword = $('#doctor_name').val();
                if(doc_keyword != '')
                {
                    if(e.keyCode == '13')
                    {
                        $('#btn_sumbit').click(); 
                    }
                    $.ajax({
                        url: "{{ url('/') }}/patient/booking/search_doctor_name",
                        type:'get',
                        data:{doc_keyword:doc_keyword},
                        success:function(result){
                            
                            if(result.status=='success')
                            {
                                $('.result_disp').show();
                                var res='<ul>';
                                $.each(result.data,function(i,obj)
                                {
                                   res+="<li class='doc_name' data-val='"+obj.userinfo.title+' '+obj.userinfo.first_name+" "+obj.userinfo.last_name+"''>"+obj.userinfo.title+' '+obj.userinfo.first_name+" "+obj.userinfo.last_name+"</li>";
                                });
                                res+='</ul>';
                                $('.result_disp').html(res);
                            }
                            else
                            {
                                $('.result_disp').html('');   
                            }
                        }
                    });
                }
                else
                {
                    $('.result_disp').html();
                    $('.result_disp').hide();
                }
            });

            $(document).on('click', '.doc_name', function(){
               var value = $(this).data('val');
               $('#doctor_name').val(value);
               $('.result_disp').html();
               $('.result_disp').hide();
            });

            $("#btn_sumbit").click( function(){

                var doctor_name     = $("#doctor_name").val();
                var selected_date   = $("#selected_date").val();
                var selected_time   = $("#selected_time").val();
                var language        = $("#language").val();
                var gender          = $("#gender").val();
                var consult_fee     = $("#consult_fee").val();

                if(doctor_name == '' && consult_fee =='' && selected_date == '' && selected_time == '' && language == '' && gender == '' )
                {
                    $('#err_form').show();
                    $('#err_form').html('Please select atleast 1 option');
                    $('#err_form').fadeOut(6000);
                    return false;
                }
                /*else if(consult_fee != '' && selected_time == '')
                {
                    $('#err_form').show();
                    $('#err_form').html('Please select time');
                    $('#err_form').fadeOut(6000);
                    return false;
                }*/
                else if(doctor_name != '' || consult_fee !='' || selected_date != '' || selected_time != '' || language != '' || gender != '' )
                {
                    $("#search_doctor_form").submit();
                    return true;
                }
            });

            $('.timepicker').pickatime({
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
        });
    </script>

@endsection