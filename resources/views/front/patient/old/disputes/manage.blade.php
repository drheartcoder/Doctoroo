@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<!--calender section start-->    
<div class="container">
   <div class="row">
       <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="middle-section">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-3">
                  <div class="left-side-tabs">
                     <div class="msg-search"><input type="text" class="search_msg" name="search_dispute" id="search_dispute" placeholder="Search Dispute.."/></div>
                     <div class="new-msg">
                        Disputes
                     </div>
                     <div  class="messagecrollbar-msg content-d" id="left_dispute_bar">
                        <ul class="sub_respo1">
                           <!--search section-->
                           <?php  $id = 0;
                           if(Request::segment(3))
                           {
                                $id = base64_decode(Request::segment(3));
                           }
                            ?>
                          @if(count($arr_dispute)>0)
                           @foreach($arr_dispute as $dispute)
                            <li @if($id==$dispute['id']) class="msg-act" @endif>
                                <div class="massanger_user">
                                  <div class="user_details">
                                      <div class="user_name dispute_msg"><a href="{{url('/')}}/patient/dispute/{{base64_encode($dispute['id'])}}">{{isset($dispute['payment_reason'])?$dispute['payment_reason']:''}}</a></div>
                                      <div class="user_msg dispute_msg">{{isset($dispute['what_is_issue'])?substr($dispute['what_is_issue'],0,20):''}}...</div>
                                      <div class="user_msg pull-right">{{isset($dispute['created_at'])?(date('d M Y',strtotime($dispute['created_at'])).' / '.date('h:i A',strtotime($dispute['created_at']))):'NA'}}</div>
                                   </div>
                                </div>
                             </li>
                           @endforeach  
                          @else
                          <li>
                              <div class="massanger_user">
                                  <div class="user_details">
                                    <div class="alert alert-info alert-dismissible" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Currently,no records found.  
                                    </div>
                                  </div>
                              </div>
                           </li>
                          @endif 
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-9">
                  <div class="chat_user whit-bg-i">
                    <div id="chat_msg"></div>
                     <div class="chat-header">
                        <div class="row">
                           <div class="col-sm-12 col-md-4 col-lg-5">
                              <div class="cht-head-nm">
                              <?php $user = Sentinel::check(); ?>
                              @if($user)
                                {{ $user->first_name }} {{$user->last_name.','}} 
                              @endif  
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-8 col-lg-7">
                              <div class="chat-search">
                                 <div class="chatting-search">
                                  &nbsp;
                                 </div>
                                 <div class="setig-icon">
                                   &nbsp;
                                 </div>
                                 <a href="#add_dispute" data-toggle="modal"> Add Dispute</a>
                              </div>
                           </div>
                        </div>
                        <br/>
                     </div>
                     @if(count($arr_dispute_details)>0)
                     <div class="disput-section">
                     <div class="dispute-content-text">
                         <div class="dispute-lable">Payment Reason</div>
                         <div class="dispute-cntent">
                            {{isset($arr_dispute_details['payment_reason'])?$arr_dispute_details['payment_reason']:'NA'}}  
                         </div>
                     </div>
                     <div class="dispute-content-text">
                         <div class="dispute-lable">Payment</div>
                         <div class="dispute-cntent">
                             {{isset($arr_dispute_details['select_payment'])?$arr_dispute_details['select_payment']:'NA'}}  
                         </div>
                     </div>
                      <div class="dispute-content-text">
                         <div class="dispute-lable">What is the issue?</div>
                         <div class="dispute-cntent">
                           {{isset($arr_dispute_details['what_is_issue'])?$arr_dispute_details['what_is_issue']:'NA'}}  
                         </div>
                     </div>
                      <div class="dispute-content-text">
                         <div class="dispute-lable">What solution would you like?</div>
                         <div class="dispute-cntent">
                         {{isset($arr_dispute_details['what_solution_you_like'])?substr($arr_dispute_details['what_solution_you_like'],0,50):'NA'}}  
                         </div>
                     </div>
                     </div>
                     @if(count($arr_dispute_response)>0) 
                     <div class="messagecrollbar-msg-b content-d">
                        <div class="chatting-section">
                          @foreach($arr_dispute_response['disputeresponse'] as $response)
                          <?php
                           if($response['from_id']==0) 
                           {

                               $class = 'chat_left_side'; 
                               $desc_class = 'triangle-right left';
                           }
                           else
                           {

                              $class = "chat_right_side";
                              $desc_class = 'triangle-left right';
                           }
                          ?> 
                           <div class="{{$class}} msg-div">
                              <span>
                              @if(isset($arr_dispute_response['userinfo']['profile_image']) && file_exists('uploads/patient/profile-image/'.$arr_dispute_response['userinfo']['profile_image']) && $arr_dispute_response['userinfo']['profile_image']!="" && $response['to_id']!=0)
                               <img alt="" class="mCS_img_loaded" src="{{url('/')}}/public/uploads/patient/profile-image/{{$arr_dispute_response['userinfo']['profile_image']}}">
                              @else
                                <img alt="" class="mCS_img_loaded" src="{{url('/')}}/public/uploads/patient/profile-image/default-image.jpeg">
                              @endif 
                              </span> 
                              <p class="{{$desc_class}}">{{$response['response']}} 
                                 @if(isset($response['attachment']) && file_exists('uploads/patient/dispute-attachment/'.$response['attachment']) && $response['attachment']!="")
                                       @if($response['to_id']!=0)
                                        <a href="{{url('/')}}/patient/download_dispute/{{base64_encode($response['id'])}}">{{$response['attachment']}}</a>
                                       @endif 
                                      @endif
                                 <span class="rgt-time">  {{isset($response['updated_at'])?(date('d M Y',strtotime($response['updated_at'])).' / '.date('h:i A',strtotime($response['updated_at']))):''}}</span>
                              </p>
                              <div class="clr"></div>
                           </div>
                           <div class="clr"></div>
                         @endforeach  
                        </div>
                     </div>
                     @endif
                     <form id="data" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                     <div class="msg_input">
                        <textarea  cols="" rows="" class="msg-in" id="response_msg" name="response_msg" placeholder="Write a Reply..." style="padding-top:10px;"></textarea>
                        <div class="err" id="err_response_msg"></div>
                        <input type="hidden" name="dispute_id"  id="dispute_id" value="{{$dispute_id}}">
                        <input type="hidden" name="patient_id"  id="patient_id" value="{{isset($arr_dispute_response['userinfo']['id'])?$arr_dispute_response['userinfo']['id']:''}}"> 
                        <div class="msg-btn">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                           <div>
                               <span class="btn btn-default btn-file"><span class="fileupload-new"><i class="fa fa-paperclip"></i></span> 
                               <input type="file" id="upload_attachment" class="file-input" name="upload_attachment" onchange="getFileName(this);">
                               <input type="hidden" value="" name="old_profile_image">
                               </span> 
                               <a href="javascript:void(0);" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><i class="fa fa-times"></i></a>
                               <span></span> 
                            </div>
                         </div>
                           <button class="submit-msg" name="btn_save_chat" id="btn_save_chat"><i class="fa fa-paper-plane"></i> Send
                           </button>
                        </div>
                      </div>
                     </form>
                     @else
                      <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Currently,no records found.  
                      </div>
                     @endif 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--calender section end--> 
<style>
  span.star{color:red;}
</style>
<!--join doctor poup start-->
<div id="add_dispute" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal"><img src="{{url('/')}}/public/images/close-popup.png" alt="Close Pop up"/></button>
         </div>
         <div class="modal-body bdy-pading">
            <div class="login_box">
               <div class="title_login">Dispute Payment</div>
               <div class="row">
               <div id="msg_div"></div>
               <p class="join-frm-txt">By proceeding, I agree that Doctoroo or its representatives may contact me by email, phone, or SMS at the email address or number I provide, including for marketing purposes. I have read and understand the Doctor Privacy Statement.</p>
               <div class="clearfix"></div>
                 <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="user_box">
                      <div class="pop-lable">Payment Reason <span class="star">*</span></div>
                      <div class="select-style select-width">
                         <select class="frm-select" name="payment_reason" id="payment_reason">
                            <option value="">- Select Payment Reason -</option>
                            <option value="Doctor consultation fee">Doctor consultation fee</option>
                            <option value="Pharmacy orders">Pharmacy orders</option>
                         </select>
                       </div>
                      <div class="err" id="err_payment_reason"></div>
                   </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="user_box">
                      <div class="cer-text" style="margin-top: 12px;">
                         Doctor Consultation Fee, Pharmacy Order
                      </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="user_box">
                      <div class="pop-lable">Select Payment <span class="star">*</span></div>
                      <div class="select-style select-width">
                         <select class="frm-select" name="select_payment" id="select_payment">
                            <option value="">- Select Payment -</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Credit Card">Credit Card</option>
                         </select>
                      </div>
                      <div class="err" id="err_select_payment"></div>
                   </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="user_box">
                      <div class="pop-lable">What is the issue? (Provide as much detail as possible) <span class="star">*</span></div>
                      <textarea cols="" rows="" name="what_is_issue" id="what_is_issue" class="form-inputs" style="padding-top:10px;height:119px;"></textarea>
                       <div class="err" id="err_what_is_issue"></div>
                   </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="user_box">
                      <div class="pop-lable">What solution would you like? <span class="star">*</span></div>
                      <textarea cols="" rows="" name="what_solution_you_like" id="what_solution_you_like" class="form-inputs" style="padding-top:10px;height:119px;"></textarea>
                      <div class="err" id="err_what_solution_you_like"></div>
                   </div>
                  </div>
                </div>
               <div class="clearfix"></div>
               <div class="login-bts text-center">
                  <button class="details-btn select-btn" value="submit" type="button" onclick="disputeValidation();">Submit</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--join doctor popup end-->  
<script>
$(document).ready(function(){

    $("form#data").submit(function(){

      var response   = $('#response_msg').val(); 
      if($.trim(response)=="")
      {

          $('#err_response_msg').fadeIn('fast');
          $('#err_response_msg').html('Please enter a dispute response.');
          $('#err_response_msg').fadeOut(4000);
          $('#response_msg').focus();
          return false;
      }
      else
      { 

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '{{url('/')}}/patient/dispute_response',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                
              if($.trim(data)=='success')
              {
                      $('#response_msg').val('');
                      $('.chatting-section').load(location.href+" .chatting-section>*","");
                      $('html, body').animate({
                             scrollTop: $('.msg-div').last().offset().top
                      }, 'slow');
                      return true; 
              }
              else if($.trim(data)=='invalid-file')
              {
                   
                   
                    $('#chat_msg').html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span'+
                                        'aria-hidden="true">&times;</span></button>'+
                                        '<strong>Error !</strong> Invalid file upload.</div>');
                    return false; 
              }
              else if($.trim(data)=='invalid-extension')
              {
                   
                  
                    $('#chat_msg').html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span'+
                                        'aria-hidden="true">&times;</span></button>'+
                                        '<strong>Error !</strong> Please upload valid file extension i.e doc,docx and pdf etc.</div>');
                    return false; 
              }
              else if($.trim(data)=='invalid')
              {

                  $('#chat_msg').html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span'+
                                        'aria-hidden="true">&times;</span></button>'+
                                        '<strong>Error !</strong> Please upload valid file extension i.e doc,docx and pdf etc.</div>');
                  return false; 
              }

            },
            cache: false,
            contentType: false,
            processData: false
        });

      }  
        return false;
    });
});

  function getFileName(input)
  {

        if (input.files) {

            var upload_attachment = input.files[0]['name'];
            $("#err_response_msg").html("");

             var ext = upload_attachment.split('.').pop();
          
             var file, img;

             if(ext != "doc" && ext != "pdf" && ext != "docx")
             {
                    
                  $('#err_response_msg').fadeIn(); 
                  $('#err_response_msg').html('Please upload valid file with valid extension i.e doc,docx,pdf.');
                  $('#err_response_msg').fadeOut(4000);
                  return false;
            }
            else
            {
                return true;
            }
         
        }  
  }
</script>
<script>

$(document).ready(function(){

  $("#search_dispute").on("keyup", function() {
     
      var value = $.trim($(this).val().toLowerCase());

       $("div#left_dispute_bar ul li").each(function(index) {
        
               $row = $(this);
           
              var id = $.trim($row.find(".dispute_msg").text().toLowerCase());
             
              if (id.indexOf(value) === -1) {
                 $row.hide();
              }
              else {
                 $row.show();
              }
       });
  });

});
  
function disputeValidation()
{

    var payment_reason         = $('#payment_reason').val();
    var select_payment         = $('#select_payment').val();
    var what_is_issue          = $('#what_is_issue').val();
    var what_solution_you_like = $('#what_solution_you_like').val();
    //var nodigit_regexp         = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;

    if($.trim(payment_reason)=="")
    {

        $('#err_payment_reason').fadeIn('fast');
        $('#err_payment_reason').html('Please select payment reason.');
        $('#err_payment_reason').fadeOut(4000);
        return false;
    }
    else if($.trim(select_payment)=="")
    {

        $('#err_select_payment').fadeIn('fast');
        $('#err_select_payment').html('Please select payment type.');
        $('#err_select_payment').fadeOut(4000);
        return false;
    }
    else if($.trim(what_is_issue)=="")
    {

        $('#err_what_is_issue').fadeIn('fast');
        $('#err_what_is_issue').html('Please enter what is issue.');
        $('#err_what_is_issue').fadeOut(4000);
        $('#what_is_issue').focus();
        return false;
    }
    else if($.trim(what_solution_you_like)=="")
    {

        $('#err_what_solution_you_like').fadeIn('fast');
        $('#err_what_solution_you_like').html('Please enter what solution you like.');
        $('#err_what_solution_you_like').fadeOut(4000);
        $('#what_solution_you_like').focus();
        return false;
    }
    else
    {

        dataString = 'payment_reason='+payment_reason+'&select_payment='+select_payment+'&what_is_issue='+what_is_issue+'&what_solution_you_like='+what_solution_you_like;

         $.ajax({
            url   : "{{ url('/') }}/patient/store_dispute",
            type : "GET",
            data: dataString,
            beforeSend: function() {
               showProcessingOverlay();
            },
            success : function(res){
               
               if($.trim(res)!='success')
               {
                   
                  $('#msg_div').html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                     '<span aria-hidden="true">&times;</span></button>'+
                                     '<strong>Success!</strong> Dispute has been added successfully.</div>');      
                  $('div.left-side-tabs').load(location.href+ " .left-side-tabs>*", "");                       
                  return true; 
               }
               else if($.trim(res)!='error')
               {

                  $('#msg_div').html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                     '<span aria-hidden="true">&times;</span></button>'+
                                     '<strong>Error!</strong> Problem Occured, While adding dispute.</div>');          
                  return false; 
               }
               else if($.trim(res)!='not-valid')
               {

                  $('#msg_div').html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                     '<span aria-hidden="true">&times;</span></button>'+
                                     '<strong>Warning!</strong> Invalid User.</div>');          
                  return false; 
               }

            },
            complete: function() {
               hideProcessingOverlay();
            }
         });
     
    }
}

</script>
 <!-- custom scrollbars plugin -->
<link href="{{url('/')}}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- custom scrollbar plugin -->
<script src="{{url('/')}}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
   (function($){
   $(window).on("load",function(){
   
   $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
   $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
   
           $(".content-d").mCustomScrollbar({theme:"dark"});
   
   });
   })(jQuery);
</script>
<!-- custom scrollbars plugin -->
@stop