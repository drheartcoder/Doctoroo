@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div id="slide-out-right" class="side-nav z-depth-2 searchpatch patient-list-right-search" >
        <div class="blueHeader">
            <div class="valign-wrapper">
                <div class="searchdoc left">Search Patients</div>
                
                <div class="cancel right cancel_search"><a href="javascript:void(0)">Cancel</a></div>
            </div>
        </div>
    <form method="POST" id="search_doctor_form" name="search_doctor" action="{{$module_url_path}}/patients/search_patient">
        <input type="hidden" value="{{csrf_token()}}" name="_token">
        <div class="searchform">
            <div class="drname">
                <div class="input-field  name-suggestn">
                    <input id="doctor_name" name="doctor_name" placeholder="Type here" type="text" class="validate" value="{{isset($doctor_name) ? $doctor_name : '' }}" autocomplete="off">
                    <label for="doctor_name">Patient Name</label>
                    <span class="result_disp" style="cursor: pointer;"></span>
                </div>
            </div>
           
            <div class="divider"></div>
            <div class="other">
                <div class="input-field">
                    <label class="active" for="selected_date">Date of Birth</label>
                    <input id="selected_date" name="selected_date" type="text" class="datepicker" value="{{isset($dob) ? $dob : ''}}">
                    <input type="hidden" name="patient_type" id="patient_type" value="doctoroo">
                </div>
            </div>

            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select id="gender" name="gender">
                        <option value="">Select</option>
                        <option value="Male" {{isset($gender) && $gender=='Male' ? 'selected' : ''}}>Male</option>
                        <option value="Female" {{isset($gender) && $gender=='Female' ? 'selected' : ''}}>Female</option>
                    </select>
                    <label>Gender</label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="other">
                <div class="input-field">
                    <label class="active" for="entitlement_id">Entitlement Card No</label>
                    <input id="entitlement_id" name="entitlement_id" type="text" value="{{isset($entitlement_id) ? $entitlement_id : '' }}">
                </div>
            </div>

            <div class="divider"></div>
            <div class="chooseoption">
                <div class="input-field">
                    <select id="sort_by" name="sort_by">
                        <option value="ASC">Alphabetical increasing</option>
                        <option value="DESC">Alphabetical Decreasing</option>
                    </select>
                    <label>Sort by</label>
                </div>
            </div>

            <div class="divider"></div>
            <div class="other" id="err_msg" >
                <div class="input-field">
                    <div class="err" id="err_form" style="display:none;"></div>
                </div>
            </div>
            <div class="side-footer">
            <a href="javascript:void(0)" class="left cancel_search">CLEAR</a>
            <a href="javascript:void(0)" id="btn_sumbit" class="right">SEARCH</a>
        </div>
        </div>
      </form>  
    </div>

    <div class="mar300  has-header minhtnor doctor-patient-list-main">
        <div class="search-paitent-block">
            <div class="input-field searchHead button-collapse-open" data-activates="slide-out-right" class="button-collapse-open">
                <a href="" class="menu-icon center-align prefix"><i class="material-icons">search</i></a>
                <input type="text" id="autocomplete-input" class="autocomplete">
            </div>
        </div>
        <div id="medical" class="tab-content medi patient-list-block doctor-patient-list-main">
            <div class="patient-list-heading">
                <span class="patient-list-title">
                    Search Result(s)
                </span>                
            </div>
            <div class="blue-border-block-top"></div>
            <div class="transactions-table table-responsive paitent-list-table">
                <!--div format starts here-->
                @if(isset($patients_arr['data']) && sizeof($patients_arr['data']) != '0')
                <div class="table ">
                    <div class="table-row heading hidden-xs">
                        <div class="table-cell">Patient's Name</div>                        
                        <div class="table-cell">Type</div>
                        <div class="table-cell">Date of birth</div>
                        <div class="table-cell">Gender</div>
                        <div class="table-cell center-align">Patient Details</div>
                    </div>
                            @foreach($patients_arr['data'] as $val)
                                <div class="table-row content-row-table">
                                    <div class="table-cell transaction-id">
                                        @php
                                            $src="";
                                            if(isset($val['patient_user_details']['profile_image']) && File::exists($profile_img_base_path.$val['patient_user_details']['profile_image']))
                                            {
                                               $src = $profile_img_public_path.$val['patient_user_details']['profile_image'];
                                            }
                                            else
                                            {
                                               $src = $profile_img_public_path.'default-image.jpeg';
                                            }  
                                        @endphp
                                            <span class="patient-profile-pic"><img src="{{$src}}" alt="" /> </span>
                                            <span class="patient-name-block">{{isset($val['patient_user_details']['first_name']) ? $val['patient_user_details']['first_name'] : ''}} {{isset($val['patient_user_details']['last_name']) ? $val['patient_user_details']['last_name'] : ''}}</span>
                                    </div>                        
                                    <div class="table-cell transaction-price">Doctoroo</div>
                                    <div class="table-cell transaction-date">
                                        {{isset($val['patient_info']['date_of_birth']) ? date('Y/m/d', strtotime($val['patient_info']['date_of_birth'])) : ''}}
                                    </div>
                                    <div class="table-cell transaction-desciption">
                                        <span class="description">
                                            @php
                                                if(isset($val['patient_info']['gender']))
                                                {
                                                    if($val['patient_info']['gender']=='F')   
                                                    {
                                                        echo "Female";
                                                    }
                                                    else
                                                    {
                                                        echo "Male";
                                                    }
                                                }
                                            @endphp
                                        </span>
                                    </div>
                                    <div class="table-cell transaction-status view-details-btn"><a href="{{ url('/') }}/doctor/patients/details/{{ base64_encode($val['patient_user_details']['id']) }}">View details</a></div>
                                </div>            
                            @endforeach
                </div>
                @else
                    <h5 class="center-align">No Records found...</h5>
                @endif
                <div class="paginaton-block-main">
                    {{$paginate}}
                </div>
            </div>
            <div class="blue-border-block-bottom"></div>
        </div>        
    </div>

    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>
    <script>
    $(document).ready(function(){
        var url="<?php echo $module_url_path; ?>";

        $('#doctor_name').keyup(function(e){
            if (e.which == 13) {
                $('#btn_sumbit').click();
                return false;
            }
            doc_keyword = $('#doctor_name').val();
            if(doc_keyword != '')
            {
                $.ajax({
                    url: url+"/patients/search_patient_name",
                    type:'get',
                    data:{doc_keyword:doc_keyword,patient_type:'doctoroo'},
                    success:function(result){
                        
                        if(result.status=='success')
                        {
                            $('.result_disp').show();
                            var res='<ul>';
                            $.each(result.data,function(i,obj)
                            {
                               res+="<li class='doc_name' data-val='"+obj.patient_user_details.first_name+" "+obj.patient_user_details.last_name+"''>"+obj.patient_user_details.first_name+" "+obj.patient_user_details.last_name+"</li>";
                            });
                            res+='</ul>';
                            $('.result_disp').html(res);
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
            var sort_by         = $("#sort_by").val();
            var selected_date   = $("#selected_date").val();
            var selected_time   = $("#selected_time").val();
            var entitlement_id  =$('#entitlement_id').val();
            
            var gender          = $("#gender").val();
             
            if(doctor_name == '' &&  selected_date == ''  && gender == '' && entitlement_id == '' )
            {
               
                $('#err_form').show();
                $('#err_form').html('Please select atleast 1 option');
                $('#err_form').fadeOut(6000);
                return false;
            }
            else if(doctor_name != '' || sort_by != '' || selected_date != '' || entitlement_id != '' ||  gender != '' )
            {
                $("#search_doctor_form").submit();
                return true;
            }
        });
    });

    $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            //selectYears: 100, // `true` defaults to 10.
            //min: new Date(2015,3,20),
            max:new Date(),
            // Accessibility labels
            /*labelMonthNext: 'Next month',
            labelMonthPrev: 'Previous month',
            labelMonthSelect: 'Select a month',
            labelYearSelect: 'Select a year',*/
            onOpen: function() {
              console.log( 'Opened')
            },
            onClose: function() {
              console.log( 'Closed ' + this.$node.val() )
              
              selected_date = this.$node.val();
            },
            onSelect: function() {
              console.log( 'Selected: ' + this.$node.val() )
            },
            onStart: function() {
              console.log( 'Hello there :)' )
            }
        });

        $('.timepicker').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: false, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function(){} //Function for after opening timepicker
            });
        $('.cancel_search').click(function(){
            var url="<?php echo $module_url_path; ?>";
            window.location = url+"/patients/doctoroo_patients";
        });  
    
    </script>

@endsection