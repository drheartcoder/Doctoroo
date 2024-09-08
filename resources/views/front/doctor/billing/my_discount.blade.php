@extends('front.doctor.layout.new_master')
@section('main_content')
<style>
    .error,.required_field
    {
        color:red;
    }
    .error_class
    {
      color:red;
    }
</style>
     <div class="header bookhead ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
     </div>
    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

     <div class="mar300  has-header minhtnor ">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab">
                    <a href="#consultation-invoices" onclick="location.href = '{{url('/')}}/doctor/billing';" ><span><img src="{{url('/')}}/public/doctor_section/images/invoice-white.svg" alt="icon" class="tab-icon"/> </span> Consultation Invoices </a>
                </li>
                <li class="tab">
                  <a href="#bank-account-details" onclick="location.href = '{{url('/')}}/doctor/billing/bank_account';"> <span><img src="{{url('/')}}/public/doctor_section/images/bank.svg" alt="icon" class="tab-icon"/> </span> Bank Account Details</a>
                </li>
                <li class="tab">
                    <a href="#discount-codes" class="active"> <span><img src="{{url('/')}}/public/doctor_section/images/discount-codes.svg" alt="icon" class="tab-icon"/> </span> My Discount Codes</a>
                </li>
            </ul>
        </div>

       <div id="discount-codes" class="tab-content medi ">
                <div class="doctor-container">
                    <!--Medical History section -->
                    <div class="head-medical-pres">
                        <h2 class="center-align">My Discount Codes</h2>
                        <span class="posleft qusame rescahnge"><a href="javascript:void(0)" onclick="window.history.back()" class="border-btn btn round-corner center-align">&lt; Back</a></span>
                    </div>
                    <div>
                        <div class="row">
                          <form name="validation-form" id="validation-form" method="POST" class="form-horizontal" action="{{url('/')}}/doctor/billing/store" >

                            {{ csrf_field() }}

                            <div class="col l6 s12 ">
                                <div class="round-box z-depth-3">
                                    <div class="heading-round-box">Create a new code</div>
                                    <div class="green-border round-box-content medication-history-details posrel">
                                        <div class=" grey-text codes-down ">
                                            <p>You may create a code to give to your patients if you wish to give certain patients a discount from your standard rate.</p>
                                            <p><strong>Please note:</strong> the discount will be on your earnings, not doctoroo's i.e. the patient will still need to pay the $10 - $20 fee to doctoroo, depending on the time of day and call duration.</p>

                                            <div class="input-field selct maronytb input-padding-25px">
                                                <input type="text" name="value" id="value" placeholder="value in %"/>
                                                <span class='error'>{{ $errors->first('value') }}</span>
                                                <div class="err" id="err_value" style="display:none;"></div>
                                            </div>
                                            
                                            <div class="input-field text-bx lessmar  input-padding-25px" style="margin-top: 10px;">
                                                <div class="input-field">
                                                    <label class="active" for="selected_date">Date of Valid</label>
                                                    <input id="selected_date" name="selected_date" type="text" class="datepicker">
                                                    <span class='error'>{{ $errors->first('selected_date_submit') }}</span>
                                                <div class="err" id="err_selected_date" style="display:none;"></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                        <div class="center-align position-absolute">
                                            <div class="display-inline margin-top-btm " id="save_coupon">
                                                <button type="submit" class="btn bluedoc-bg round-corner">Generate Code</button> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blue-border-block-bottom"></div>
                                </div>

                            </div>
                            <div class="col l6 s12 ">
                                <div class="round-box z-depth-3">
                                    <div class="heading-round-box">My Active Codes</div>
                                    <div class="green-border medication-history-details posrel">
                                        <div class="">
                                          @if(isset($arr_code) && sizeof($arr_code)>0)
                                              <ul class="collection brdrtopsd">
                                                @foreach($arr_code as $code)
                                                  <li class="collection-item valign-wrapper">
                                                      <span class="available-coupon left circle"><img src="{{url('/')}}/public/doctor_section/images/coupon.svg"  /></span>
                                                      <div class="left coupon-details "><span class="title">Code: {{$code['code']}}</span>
                                                          <small>Value: {{$code['value']}}%</small>
                                                          <span class="stat">Expiry: {{ date("d F, Y", strtotime($code['expiry_date'])) }}</span>
                                                      </div>

                                                      <div class="right posrel"> <a href="#" data-activates='dropdown_{{$code['id']}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                                      </div>

                                                      <ul id='dropdown_{{$code['id']}}' class='dropdown-content doc-rop rightless' data-code='{{$code['code']}}' data-id='{{$code['id']}}' data-value='{{$code['value']}}' data-date='{{ date("d/m/Y", strtotime($code['expiry_date'])) }}'>    
                                                          <li><a href="#share_codes"  class="btn_share_codes">Share</a></li>
                                                          <li><a href="#view_codes"  class="btn_show_codes">View</a></li>
                                                          <li><a href="javascript:void(0);" class="btn_edit_codes">Edit</a></li>
                                                          <li><a href="#delete_codes"  class="btn_delete_codes">Delete</a></li>
                                                      </ul>
                                                  </li>
                                                @endforeach
                                              </ul>
                                          @else
                                              <h5 class="no-data">No data found</h5>
                                          @endif
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="blue-border-block-bottom"></div>
                                </div>
                            </div>
                           </form>
                        </div>
                    </div>
                    <!--Medical History section -->
                </div>
       </div>
    </div>

    <a class="edit_codes" href="#edit_codes_section" style="display: none;"></a>
    <div id="edit_codes_section" class="modal  date-modal addperson date-modal">
        <div class="modal-content">
        <h4 class="center-align">Edit Code</h4>
           <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx input-padding-25px">
                        <input type="hidden" id="coupon_id">
                        <input id="code" type="text" class="validate" readonly="true">
                        <label for="code">Code</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx input-padding-25px">
                        <input id="code_value" type="text" class="validate">
                        <label for="password">Value in % <span class="required_field">*</span></label>
                        <span class="error left-12px"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field text-bx input-padding-25px">
                        <input id="valid_date" type="text" class="validate datepicker">
                        <label for="valid_date">Date of valid <span class="required_field">*</span></label>
                        <span class="error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer  center-align">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
           <a href="javascript:void(0)" class="waves-effect waves-green btn-cancel-cons" id="btn_upd_codes">Update</a>
        </div>  
    </div>

    <a class="view_code" href="#view_code_section" style="display: none;"></a>
    <div id="view_code_section" class="modal  date-modal addperson date-modal">
        <div class="modal-content">
        <h4 class="center-align">Discount Code Details</h4>
           <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field ">
                        <input id="view_code" type="text" class="validate" readonly="true">
                        <label for="view_code">Code</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field ">
                        <input id="view_code_value" type="text" class="validate" readonly="true">
                        <label for="view_code_value">Value in % <span class="required_field">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field ">
                        <input id="view_valid_date" type="text" class="validate" readonly="true">
                        <label for="view_valid_date">Date of valid <span class="required_field">*</span></label>
                    </div>
                </div>
            </div>
            
            <br/>

            <div class="row">
                <div class="col s12 l12">
                    <strong> Sharing Details :</strong>
                    <table class="patient_result">

                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer  center-align">
          <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">Close</a>
        </div>  
    </div>

    <div id="delete_codes" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align">Do you really want to delete this code? Your shared discount codes will also be deleted</p>
                    <input type="hidden" id="coupon_delete_id">
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0)" class="modal-action waves-effect waves-green btn-cancel-cons" id="delete_coupon">Yes</a>         
        </div>     
    </div>

    <style>
      .select-wrapper input.select-dropdown
      {
        margin: 0px !important;
      }
    </style>

    <div id="share_codes" class="modal  date-modal addperson">
        <form method="GET" name="share_code_form" id="share_code_form" action="{{$module_url_path}}/search_patient">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
               <h4 class="center-align">Share Code - Search Patient</h4>
               <a class="modal-close closeicon"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-data">
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field ">
                        <select id="patient_type" name="patient_type">
                           <option value="" >Patient Type</option>
                           <option value="doctoroo" >Doctoroo</option>
                           <option value="myown">Myown</option>
                        </select>
                        <span class="error_class"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field ">
                        <input id="patient_name" type="text" name="patient_name" class="validate" autocomplete="off">
                        <label for="patient_name">Patient Name</label>
                        <span class="result_disp" style="cursor: pointer;"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field text-bx ">
                        <input id="dob" name="dob" type="date" class="dob validate">
                        <label class="active" for="datebirth">Date of birth</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field ">
                        <select id="gender" name="gender">
                           <option value="" >Gender</option>
                           <option value="Male" >Male</option>
                           <option value="Female">Female</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field ">
                        <input id="entitlement_id" type="text" name="entitlement_id" class="validate">
                        <label for="entitlement_id">Entitlement Card No</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col s12 l12">
                     <div class="input-field ">
                        <select id="sort_by" name="sort_by">
                           <option value="" >Sort By</option>
                           <option value="ASC" >Alphabetical increasing</option>
                           <option value="DESC">Alphabetical Decreasing</option>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="other" id="err_msg">
                <div class="input-field">
                    <div class="err" id="err_form" style="display:none;"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer ">
               <input type="hidden" id="code_id" name="code_id">
               <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
               <a href="javascript:void(0)" id="btn_sumbit" class="modal-action waves-effect waves-green btn-cancel-cons right">Search</a>
            </div>
        </form>
    </div>

 <script>
     var url = "<?php echo $module_url_path; ?>";
     $(document).ready(function(){
        $('.btn_edit_codes').click(function(){
            
           $('#code').val($(this).parent().parent().attr('data-code'));
           $('#code_value').val($(this).parent().parent().attr('data-value'));
           $('#valid_date').val($(this).parent().parent().attr('data-date'));
           $('#coupon_id').val($(this).parent().parent().attr('data-id'));
           

           if($(this).parent().parent().attr('data-code') != '')
           {
            $('#code').next().addClass('active'); 
           }

           if($(this).parent().parent().attr('data-value') != '')
           {
            $('#code_value').next().addClass('active'); 
           }

           if($(this).parent().parent().attr('data-date') != '')
           {
            $('#valid_date').next().addClass('active'); 
           }
           
           $('.edit_codes').click();
        });

        $('.btn_show_codes').click(function(){
            
           $('#view_code').val($(this).parent().parent().attr('data-code'));
           $('#view_code_value').val($(this).parent().parent().attr('data-value'));
           $('#view_valid_date').val($(this).parent().parent().attr('data-date'));

           if($(this).parent().parent().attr('data-code') != '')
           {
            $('#view_code').next().addClass('active'); 
           }

           if($(this).parent().parent().attr('data-value') != '')
           {
            $('#view_code_value').next().addClass('active'); 
           }

           if($(this).parent().parent().attr('data-date') != '')
           {
            $('#view_valid_date').next().addClass('active'); 
           }

           var coupon_id = $(this).parent().parent().attr('data-id');
            var _token = "<?php echo csrf_token(); ?>";
            $.ajax({
               url:url+'/get_shared_patients',
               type:'post',
               data:{coupon_id:coupon_id,_token:_token},
               success:function(result){
                  if (result.status == 'success') {

                      res ="<tr><th>Shared to </th><th>Shared On</th></tr>";
                      $.each(result.data, function (i, obj) {

                          var created_at = convertDate(obj.created_at);
                          res += "<tr><td>" + obj.userinfo.first_name + " " + obj.userinfo.last_name + "</td><td>"+created_at+"</td></tr>";
                      });
                      $('.patient_result').html(res);
                  }
               }
            });

           $('.view_code').click();
        });

        $('#btn_upd_codes').click(function(){
             var code_val = $('#code_value').val();
             var expiry_date = $('#valid_date').val();
             var coupon_id = $('#coupon_id').val();
             var value_filter       = /^[0-9\.]*$/;

             $('.error').show();

             var per = parseFloat(code_val);

             if($.trim(code_val)=='')
             {
                $('#code_value').focus();
                $('#code_value').next('label').next('span').html("Please enter value");
                $('#code_value').next('label').next('span').fadeOut(4000);
                flag = 0;
                return false;
             }
             else if(!value_filter.test(code_val))
             {
                $('#code_value').focus();
                $('#code_value').next('label').next('span').html("Enter only numbers");
                $('#code_value').next('label').next('span').fadeOut(4000);
                flag = 0;
                return false;
                
             }
              else if (isNaN(per) || per < 0 || per > 100)
              {
                 $('#code_value').focus();
                 $('#code_value').next('label').next('span').html("Value should be upto 100");
                 $('#code_value').next('label').next('span').fadeOut(4000);
                 flag = 0;
                 return false;
              }
             if(expiry_date == '')
             {
                 $('#valid_date').next('label').next('span').html("Select date");
                 $('#valid_date').next('label').next('span').fadeOut(4000);
                 flag = 0;
                 return false;                  
             }

             var _token = "<?php echo csrf_token(); ?>";
             

             $.ajax({
                url:url+'/update_codes',
                type:'post',
                data:{code_val:code_val,expiry_date:expiry_date,coupon_id:coupon_id,_token:_token},
                success:function(data){
                    
                    $("#edit_codes_section .modal-close").click()
                    $(".open_popup").click();
                    $('.flash_msg_text').html(data.msg);
                }
             });

        });

        $('.btn_delete_codes').click(function(){
             $('#coupon_delete_id').val($(this).parent().parent().attr('data-id'));
        });

        $('#delete_coupon').click(function(){
            var coupen_id = $('#coupon_delete_id').val();

            var _token = "<?php echo csrf_token(); ?>";
             

             $.ajax({
                url:url+'/delete_codes',
                type:'post',
                data:{coupen_id:coupen_id,_token:_token},
                success:function(data){
                    $("#delete_codes .modal-close").click()
                    $(".open_popup").click();
                    $('.flash_msg_text').html(data.msg);
                }
             });

        });

        $('.modal-close').click(function(){
        	$('.error').html("");
        });

        $('.btn_share_codes').click(function(){

            $('#code_id').val($(this).parent().parent().attr('data-id'));

        });
        
        $('#patient_name').keyup(function (e) {
            $('#patient_type').closest('.row').find('.error_class').show();
            if($('#patient_type').val() == '')
            {
               $('#patient_type').closest('.row').find('.error_class').html('Please select patient type first');
               $('#patient_type').closest('.row').find('.error_class').fadeOut(4000);
               $('#patient_name').val('');
               return false;
            }

            if(e.which == 13) {
                $('#btn_sumbit').click();
                return false;
            }
            var patient_type =$('#patient_type').val();
            doc_keyword = $('#patient_name').val();
            if(doc_keyword != '') {
                $.ajax({
                    url: url + "/search_patient_name",
                    type: 'get',
                    data: {
                        doc_keyword: doc_keyword,
                        patient_type: patient_type
                    },
                    success: function (result) {

                        if (result.status == 'success' && result.patient_type =='myown')
                        {
                            $('.result_disp').show();
                            var res = '<ul>';
                            $.each(result.data, function (i, obj) {
                                res += "<li class='doc_name' data-val='" + obj.userinfo.first_name + " " + obj.userinfo.last_name + "''>" + obj.userinfo.first_name + " " + obj.userinfo.last_name + "</li>";
                            });
                            res += '</ul>';
                            $('.result_disp').html(res);
                        }

                        if(result.status=='success'  && result.patient_type =='doctoroo')
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
            } else {
                $('.result_disp').html();
                $('.result_disp').hide();
            }
        });

        $('#patient_type').change(function(){
          $('#patient_type').closest('.row').find('.error_class').show();
          if($(this).val() != '')
          {
            $('#patient_type').closest('.row').find('.error_class').html('');
            $('#patient_name').val('');
          }
          else
          {
             $('#patient_type').closest('.row').find('.error_class').html('Please select patient type first');
             $('#patient_type').closest('.row').find('.error_class').fadeOut(4000);
             $('#patient_name').val('');
             return false;
          }
        });

        $(document).on('click', '.doc_name', function () {
            var value = $(this).data('val');
            $('#patient_name').val(value);
            $('.result_disp').html();
            $('.result_disp').hide();
        });

         $("#btn_sumbit").click(function () {

            var patient_name = $("#patient_name").val();
            var sort_by = $("#sort_by").val();
            var selected_date = $("#dob").val();
            var entitlement_id = $('#entitlement_id').val();

            $('#patient_type').closest('.row').find('.error_class').show();

            var gender = $("#gender").val();

            if ($('#patient_type').val() == '') {

                 $('#patient_type').closest('.row').find('.error_class').html('Please select patient type first');
                 $('#patient_type').closest('.row').find('.error_class').fadeOut(4000);
                 $('#patient_name').val('');
                 return false;
            } 

            if (patient_name == '' && selected_date == '' && gender == '' && entitlement_id == '') {

                $('#err_form').show();
                $('#err_form').html('Please select atleast 1 option');
                $('#err_form').fadeOut(4000);
                return false;
            } else if (patient_name != '' || sort_by != '' || selected_date != '' || entitlement_id != '' || gender != '') {
                $("#share_code_form").submit();
                return true;
            }
        });

         $('.modal-close').click(function(){
            $('#share_code_form')[0].reset();
         });

       function convertDate(inputFormat)
       {
         function pad(s) { return (s < 10) ? '0' + s : s; }
         var d = new Date(inputFormat);
         return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
       }

     });
 </script>
 <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>
 <script>
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
            min: new Date(),
            //max:new Date(),
            // Accessibility labels
        });

      $('.dob').pickadate({
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
</script>

<script>
    $('#save_coupon').click(function(){

                 var value              = $('#value').val();
                 var selected_date      = $('#selected_date').val();
                 var value_filter       = /^[0-9\.]*$/;

                 var per = parseFloat(value);
                 var flag = 1;

                 if($.trim(value)=='')
                {
                    $('#err_value').show();
                    $('#value').focus();
                    $('#err_value').html('Please enter value.');
                    $('#err_value').fadeOut(4000);
                    flag = 0;
                    return false;
                }
                else if(!value_filter.test(value))
                 {
                    $('#err_value').show();
                    $('#value').focus();
                    $('#err_value').html('Please enter only numbers');
                    $('#err_value').fadeOut(4000);
                    flag = 0;
                 }
                  else if (isNaN(per) || per < 0 || per > 100) {
                     $('#err_value').show();
                     $('#value').focus();
                     $('#err_value').html('Value should be upto 100');
                     $('#err_value').fadeOut(4000);
                     flag = 0;
                      return false;
                  }
                 else if(selected_date == '')
                 {
                    $('#err_selected_date').show();
                    $('#err_selected_date').html('Please enter expiry date.');
                    $('#err_selected_date').fadeOut(4000);
                    flag = 0;
                 }
                 

                 if(flag == 0)
                 {
                    return false;
                 }
             });
    </script>

 @endsection