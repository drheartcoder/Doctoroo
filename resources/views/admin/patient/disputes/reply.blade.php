@extends('admin.layout.master')    
@section('main_content')

<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
</style>
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li><a href="{{ url($admin_panel_slug.'/dispute') }}">Manage Dispute Payment </a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($module_title)?$module_title:"Reply Dispute Payment"}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($module_title)?$module_title:"Reply Dispute Payment" }} </h3>
         <div class="box-tool">
            <a href="{{url($module_url_path)}}" class="btn btn-success">Back</a>
         </div>
      </div>
      <br/>
      <div class="box-content">
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
                @include('admin.layout._operation_status')  
               <div class="box box-gray">
                @if(count($arr_dispute)>0)
                  <div class="box-content">
                    <br/>
                    <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Patient Name</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                            {{isset($arr_dispute['userinfo']['title'])?$arr_dispute['userinfo']['title']:''}}  
                            {{isset($arr_dispute['userinfo']['first_name'])?$arr_dispute['userinfo']['first_name']:''}}
                            {{isset($arr_dispute['userinfo']['last_name'])?$arr_dispute['userinfo']['last_name']:''}}
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                      
                        <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">Select Payment</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                              {{isset($arr_dispute['select_payment'])?$arr_dispute['select_payment']:''}} 
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">Payment Reason</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                             {{isset($arr_dispute['payment_reason'])?$arr_dispute['payment_reason']:''}}      
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                     </div>
                    </div>  
                    <hr/>  
                    <div class="row">
                     <div class="col-md-12">
                       <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">What is issue ?</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          {{isset($arr_dispute['what_is_issue'])?$arr_dispute['what_is_issue']:''}} 
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                    </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                           <label for="password1" class="col-xs-3 col-lg-5 control-label">What solution you like ?</label>
                           <div class="col-sm-3 col-lg-2">:</div>
                           <div class="col-sm-9 col-lg-5 controls">
                              {{isset($arr_dispute['what_solution_you_like'])?$arr_dispute['what_solution_you_like']:''}} 
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                      </div>
                    </div>
                  </div>
                 @else
                   <div class="alert alert-info alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <strong>Sorry !</strong> Currently,no records found.
                   </div>
                 @endif 
               </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="box box-gray">
                  <hr/>
                   <div class="box-content" id="messages">
                      @if(count($arr_dispute_response['disputeresponse'])>0)
                        <ul class="messages messages-chat messages-stripped messages-zigzag slimScroll" style="height:250px">
                        @foreach($arr_dispute_response['disputeresponse'] as $response)  
                        
                           <li>
                              @if(isset($arr_dispute_response['userinfo']['profile_image']) && file_exists('uploads/patient/profile-image/'.$arr_dispute_response['userinfo']['profile_image']) && $arr_dispute_response['userinfo']['profile_image']!="" && $response['from_id']!=0)
                               <img alt="" src="{{url('/')}}/public/uploads/patient/profile-image/{{$arr_dispute_response['userinfo']['profile_image']}}">
                              @else
                                <img alt="" src="{{url('/')}}/public/uploads/patient/profile-image/default-image.jpeg">
                              @endif 
                               <div>
                                   <div>
                                       <h5>
                                       @if($response['from_id']!=0)
                                         {{isset($arr_dispute_response['userinfo']['title'])?$arr_dispute_response['userinfo']['title']:''}}  
                                         {{isset($arr_dispute_response['userinfo']['first_name'])?$arr_dispute_response['userinfo']['first_name']:''}}
                                         {{isset($arr_dispute_response['userinfo']['last_name'])?$arr_dispute_response['userinfo']['last_name']:''}}
                                       @else
                                       {{'Admin'}}
                                       @endif  
                                       </h5>
                                       <span class="time"><i class="fa fa-clock-o"></i> 
                                       {{isset($response['updated_at'])?(date('d M Y',strtotime($response['updated_at'])).' / '.date('h:i A',strtotime($response['updated_at']))):''}}
                                       </span>
                                   </div>
                                   <p>{{$response['response']}}
                                      @if(isset($response['attachment']) && file_exists('uploads/patient/dispute-attachment/'.$response['attachment']) && $response['attachment']!="")
                                       @if($response['from_id']!=0)
                                        <a href="{{url($module_url_path)}}/download_dispute/{{base64_encode($response['id'])}}">{{$response['attachment']}}</a>
                                       @endif 
                                      @endif
                                   </p>
                               </div>
                           </li>
                        @endforeach   
                       </ul>
                       @endif
                      <form id="data" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                       <div class="messages-input-form">
                        <div class="input">
                             <input type="text" class="form-control" id="response_msg" name="response_msg" placeholder="Write here...">
                         </div>
                        <div class="buttons">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                           <div>
                               <span class="btn btn-default btn-file"><span class="fileupload-new"><i class="fa fa-paperclip"></i></span> 
                               <input type="file" id="upload_attachment" class="file-input" name="upload_attachment" onchange="getFileName(this);">
                               <input type="hidden" value="" name="old_profile_image">
                               </span> 
                               <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><i class="fa fa-times"></i></a>
                               <span></span> 
                            </div>
                         </div>
                          <button class="btn btn-success" name="btn_save_chat" id="btn_save_chat"><i class="fa fa-share"></i></button>
                         </div>
                       </div>
                       <div class="err" id="err_response_msg"></div>
                       <input type="hidden" name="dispute_id"  id="dispute_id" value="{{$dispute_id}}">
                       <input type="hidden" name="patient_id"  id="patient_id" 
                       value="{{isset($arr_dispute['userinfo']['id'])?$arr_dispute['userinfo']['id']:''}}"> 
                      <br/> 
                     </form> 
                   </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- END Main Content --> 

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
            url: '{{ url($module_url_path) }}/response',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                
              if($.trim(data)=='success')
              {
                      $('#response_msg').val('');
                      $('#messages').load(location.href+" #messages>*","");
                       $('html, body').animate({
                             scrollTop: $('li').last().offset().top
                      }, 'slow');
                      return true; 
              }
              else if($.trim(data)=='invalid-file')
              {
                   
                    alert('Invalid file upload.');
                    return false; 
              }
              else if($.trim(data)=='invalid-extension')
              {
                   
                    alert('Please upload valid file extension i.e doc,docx and pdf etc.');
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
})


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
@endsection