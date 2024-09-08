@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<style>
    .check-left 
    {
    margin: 15px 0 0;
    text-align: left;
   }
</style>
<!--dashboard section-->            
      <link href="{{ url('/') }}/public/css/select2.min.css" rel="stylesheet" />
      <div class="middle-section">
         <div class="container">
            <div class="back-whhit-bx white-bg">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="see-d-dash-panel text-center">
                        <div class="distance">
                           <div class="row">
                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-right">
                              <?php if(Session::get('signup_type')=='FULL'){?>
                                 <a href="{{ url('/') }}/search/doctor/search_more_precise{{ '?'.Request::getQueryString() }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt="" /></a>
                                 <?php } else{?>
                                  <a href="{{ url('/') }}/search/doctor/who-is-patient/fast{{ '?'.Request::getQueryString() }}"><img src="{{ url('/') }}/public/images/arrow-grn.png" alt="" /></a>
                                  <?php } ?>
                              </div>
                              <ul class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" class="act"><i class="fa fa-circle"></i></a></li>
                                 <li><a href="javascript:void(0);" ><i class="fa fa-circle"></i></a></li>
                              </ul>
                              <!-- <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 arrow-grn text-left"><a href="#"><img src="{{ url('/') }}/public/images/arrow-disable.png" alt=""/></a></div> -->
                           </div>
                           <div class="clr"></div>
                        </div>
                        <form method="POST" action="{{ url('/') }}/search/doctor/store_step_6_checkout" id="payment_form" >
                            {{ csrf_field()}}
                        <div class="checkout-bx min-hgt-div">
                         @if($errors->first())
                          <div class="alert alert-danger alert-dismissible" style="text-align:left;">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span></button>
                             {!! $errors->first() !!}
                          </div>
                          @endif
                          <div class="col-sm-7 col-md-8 col-lg-8 ">

                         
                              <div class="check-left">
                                 <h2>Checkout</h2>
                                 <div class="row br-rggt">
                                    <div class="user-box">
                                       <div class="col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-lable">Pay with New card</div>
                                       </div>
                                       <div class="col-sm-12 col-md-9 col-lg-9">
                                          <a href="javascript:void(0);">
                                          <img src="{{ url('/') }}/public/images/pay-cards.png" alt="pay cards"/>
                                          </a>
                                       </div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user-box">
                                       <div class="col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-lable">Name on Card</div>
                                       </div>
                                       <div class="col-sm-12 col-md-9 col-lg-9 eway-secure" id="eway-secure-field-name">
                                          
                                       </div>
                                       <div id="status-name" class="error"></div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user-box">
                                       <div class="col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-lable">Card Number</div>
                                       </div>
                                       <div class="col-sm-12 col-md-9 col-lg-9 eway-secure" id="eway-secure-field-card" >
                                          <!-- <span class="check-icns"><i class="fa fa-credit-card"></i></span> -->
                                       </div>
                                       <div id="status-card" class="error"></div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user-box">
                                       <div class="col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-lable">Expires on</div>
                                       </div>
                                       <div class="col-sm-12 col-md-9 col-lg-9 eway-secure-drop" id="eway-secure-field-expiry">                                          
                                          <!-- <span class="check-icns"><i class="fa fa-calendar"></i></span> -->
                                       </div>
                                       <div id="status-expiry" class="error"></div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="user-box">
                                       <div class="col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-lable">Security Code</div>
                                       </div>
                                       <div class="col-sm-12 col-md-9 col-lg-9 eway-secure" id="eway-secure-field-cvn">
                                          
                                          <span class="info-icon"> <i class="fa fa-question-circle"></i></span>
                                       </div>
                                       <div id="status-cvn" class="error"></div>
                                       <div class="clearfix"></div>
                                    </div>
                                    <input type="hidden" id="securefieldcode" name="SecuredCardData" value="" />
                                    <div class="user-box text-right">
                                       <div class="col-lg-12 request-details-bx">
                                          <div class="check-box med-step2">
                                             <input class="css-checkbox" checked="checked" id="radio1" name="radiog_dark" type="checkbox"/>
                                             <label class="css-label radGroup2" for="radio1">Remember this card</label>
                                          </div>
                                       </div>
                                    </div>
                                      
                                    <p>
                                       <span class="clearfix"></span>
                                    </p>
                                 </div>
                              </div>
                              
                          </div>
                           <div class="col-sm-5 col-md-4 col-lg-4">
                              <div class="check-left">
                                 <h2>&nbsp;</h2>
                                 <div class="user-box">
                                    <div class="form-lable">Total</div>
                                    <div class="form-lable prce">AUD <?php $arr_price = get_consultation_minute_cost('01:00'); echo $arr_price['price']; ?></div>
                                    <button class="signup-pharma" type="submit" id="pay_now" > Pay Now</button>
                                    <p class="join-frm-txt">By completing your purchase, you agree to these <a href="#"> Terms of Service.</a></p>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                       </form>
                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <!--dashboard section-->
      </div>
<script>

var publicApiKey = "epk-4C78E5B7-3E64-4337-894B-35061D1CC97F";
var fieldStyles = 'border: 1px solid #dde7ed;border-radius: 3px;color: #666;font-family: "robotolight",sans-serif;font-size: 15px;height: 40px;line-height: normal;padding: 0 10px; position: relative;width: 100%;';

var fieldStylesexp = 'border: 1px solid #dde7ed;border-radius: 3px;color: #666;font-family: "robotolight",sans-serif;font-size: 15px;height: 40px;line-height: normal;padding: 0 10px; position: relative;width: 100%;  width : 45%;';


var nameFieldConfig = {
        publicApiKey: publicApiKey,
        fieldDivId: "eway-secure-field-name",
        fieldType: "name",
        styles: fieldStyles
    };
var cardFieldConfig = {
        publicApiKey: publicApiKey,
        fieldDivId: "eway-secure-field-card",
        fieldType: "card",
        styles: fieldStyles,
        maskValues: false
    };
var expiryFieldConfig = {
        publicApiKey: publicApiKey,
        fieldDivId: "eway-secure-field-expiry",
        fieldType: "expiry",
        styles: fieldStylesexp
    };
var cvnFieldConfig = {
        publicApiKey: publicApiKey,
        fieldDivId: "eway-secure-field-cvn",
        fieldType: "cvn",
        styles: fieldStyles
    };

</script>


<script>
var lastevent;
function secureFieldCallback(event) 
{
  //document.getElementById("pay_now").disable=false;
  document.getElementById("status-name").innerHTML  = '';
  document.getElementById("status-card").innerHTML  = '';
  document.getElementById("status-expiry").innerHTML= '';
  document.getElementById("status-cvn").innerHTML   = '';
  lastevent = event;
  if (!event.fieldValid) 
  {
    alert(event.errors);
  } 
  else 
  {
    if (event.valueIsValid) 
    {
      
    } 
    else 
    {
      var msg = 'Invalid';
      if(event.targetField=='name')
      {
        msg = 'Please enter valid Card holder name';
      }
      else if(event.targetField=='card')
      {
        msg = 'Please enter valid card number';
      }
      else if(event.targetField=='expiry')
      {
        msg = 'Please select valid expiry of card';
      }
      else if(event.targetField=='cvn')
      {
        msg = 'Please enter valid security code';
      }
      document.getElementById("status-"+event.targetField).innerHTML = msg;
      //document.getElementById("pay_now").disable=true;
      return false;
    }
    //document.getElementById("pay_now").disable=false;
    // set the Secure Field Code
    var s = document.getElementById("securefieldcode");
    s.value = event.secureFieldCode
  }
}
</script>

<script src="https://secure.ewaypayments.com/scripts/eWAY.min.js" data-init="false"></script>

<script>
window.onload = function () {
    showProcessingOverlay();
    eWAY.setupSecureField(nameFieldConfig, secureFieldCallback);
    eWAY.setupSecureField(cardFieldConfig, secureFieldCallback);
    eWAY.setupSecureField(expiryFieldConfig, secureFieldCallback);
    eWAY.setupSecureField(cvnFieldConfig, secureFieldCallback);
    hideProcessingOverlay();
    
};
</script>
      <script src="{{url('/') }}/public/js/select2.full.js"></script>  
      <script> 
      
      $(document).scrollTop($(document).height());

      $(function() {
          $( "#available_date" ).datepicker({
              numberOfMonths: 1,
              showButtonPanel: false,
                 minDate: '0' //would work too
          });
      });


      $(document).ready(function()
      {
        $('#srch_by_name').keyup(function(){
           var srch_name = $('#srch_by_name').val();
           if(srch_name!='')
           {
             $('.doctor_div').each(function(){
               var doc_name = $(this).attr('data-doc-name');
               if (doc_name.toLowerCase().indexOf(srch_name) >= 0)
               {
                 $(this).show();
               }
               else
               {
                 $(this).hide();
               }
               
             });
           }
           else
           {
             $('.doctor_div').each(function(){
               $(this).show();
             });
           }
         });


          var arr_avail_time = $("[data-avail-time-target]");
          $.each(arr_avail_time,function(index,elem)
          {
             $(elem).on('click',function()
              {
                 var target = $(elem).attr('data-avail-time-target');
                 var target_elem = $('[doctor-avail-time-section="'+target+'"]');    
                 var arr_avail_time_section = $('[doctor-avail-time-section]').not(target_elem);    
                 
                 
                 $(arr_avail_time_section).each(function(index,elem)
                 {
                     $(elem).hide();
                 });
                 
                 $(target_elem).slideToggle('slow');
              });       
          });
          
          
          
           $(".js-example-basic-multiple").select2();         
                 
      $('#available_date').datepicker({ dateFormat: 'dd-mm-yy' });
       
      function Converttimeformat(time) 
      {
         // var time = $("#starttime").val();
         var time = time;//document.getElementById('available_time').value;
         var hrs = Number(time.match(/^(\d+)/)[1]);
         var mnts = Number(time.match(/:(\d+)/)[1]);
         var format = time.match(/\s(.*)$/)[1];
         if (format == "PM" && hrs < 12) hrs = hrs + 12;
         if (format == "AM" && hrs == 12) hrs = hrs - 12;
         var hours = hrs.toString();
         var minutes = mnts.toString();
         if (hrs < 10) hours = "0" + hours;
         if (mnts < 10) minutes = "0" + minutes;
         return hours + ":" + minutes;
      }

      $('.more_precise_doctor').click(function(){
         var speciality       = $('#speciality').val();
         var available_date   = $('#available_date').val();
         var available_time   = $('#available_time').val();
         var language         = $('#language').val();
         var gender           = $('input[name="gender"]:checked').val();
         var specific_doctor  = $('input[name="specific_doctor"]').val();

         var hrs_time = Converttimeformat(available_time);
         var current_date     = new Date();
         var current_time     = current_date.getHours()+':'+current_date.getMinutes(); 
         var curr_new_date    = current_date.getDate()+'-'+parseInt(current_date.getMonth()+parseInt(1))+'-'+current_date.getFullYear();
         var first            = current_date.getFullYear()+'-'+parseInt(current_date.getMonth()+parseInt(1))+'-'+current_date.getDate();

         var from             = available_date.split("-");
         var newdate          = new Date(from[2], from[1] - 1, from[0]);
         var second           = newdate.getFullYear()+'-'+parseInt(newdate.getMonth()+parseInt(1))+'-'+newdate.getDate();
         
         
         if($.trim(speciality)=='')
         {
            $('#err_speciality').show();
            $('#speciality').focus();
            $('#err_speciality').html('Please select speciality');
            $('#err_speciality').fadeOut(4000);
            return false;  
         }
         else if($.trim(available_date)=='')
         {
            $('#err_available_date').show();
            $('#available_date').focus();
            $('#err_available_date').html('Please select available date');
            $('#err_available_date').fadeOut(4000);
            return false;  
         }
         else if($.trim(available_time)=='')
         {
            $('#err_available_time').show();
            $('#available_time').focus();
            $('#err_available_time').html('Please select available time');
            $('#err_available_time').fadeOut(4000);
            return false;  
         }
         else if(hrs_time<current_time &&  second==first)
         {
            $('#err_available_time').show();
            $('#available_time').focus();
            $('#err_available_time').html('Please select time greater that current time');
            $('#err_available_time').fadeOut(4000);
            return false;  
         }
         else if($.trim(language)=='')
         {
            $('#err_language').show();
            $('#language').focus();
            $('#err_language').html('Please select language');
            $('#err_language').fadeOut(4000);
            return false;  
         }
         else if($.trim(gender)=='')
         {
            $('#err_gender').show();
            $('#gender').focus();
            $('#err_gender').html('Please select gender');
            $('#err_gender').fadeOut(4000);
            return false;  
         }
         else if($.trim(specific_doctor)=='')
         {
            $('#err_specific_doctor').show();
            $('#specific_doctor').focus();
            $('#err_specific_doctor').html('Please select specific doctor');
            $('#err_specific_doctor').fadeOut(4000);
            return false;  
         }
         else
         {
            showProcessingOverlay();
            $('#frm_precise_doctor').submit();
            return true;
         }
      });

      $('.get_doc_time').click(function(){
         var doctor_id = $(this).attr('data-doctor-id');
         var day_type = $(this).attr('data-day-type');
         var available_time = $('#available_time').val();
         var available_date = $('#available_date').val();
         if(doctor_id!='' && day_type!='')
         {
            $.ajax({
               url:'{{ url("/") }}/search/doctor/availability',
               type:'get',
               data:{doctor_id:doctor_id,day_type:day_type,available_time:available_time,available_date:available_date},
               success:function(res){ //return false;
                  if(res!='')
                  {
                     if(day_type=='today')
                     {
                        $('#slot_div_'+doctor_id).html(res);
                     }
                     else
                     {
                        $('#nxt_slot_div_'+doctor_id).html(res);
                     }
                  }
               }
            });
         }
      });

      $('.assign_confirm_time').bind('click',function(){ 
            
      });

      });
  
      

      $(document).on('click', '.assign_confirm_time', function(){
            var cdate = $(this).attr('data-date');
            var ctime = $(this).attr('data-time');
            if(cdate!='' && ctime!='')
            {
               $('#confirm_date').val(cdate);
               $('#confirm_time').val(ctime);
               $('#spn_confirm_date').html(cdate);
               $('#spn_confirm_time').html(ctime);
               $('#confirm_time_popup').modal('show');
               return true;
            }
            return false;
      });

</script>
@stop