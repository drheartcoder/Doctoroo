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
                                 <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Added By</label>
                                 <div class="col-sm-3 col-lg-2">:</div>
                                 <div class="col-sm-9 col-lg-5 controls">
                                   {{isset($arr_dispute['added_by_user_info']['title']) ? $arr_dispute['added_by_user_info']['title'] :''}}
                                   {{isset($arr_dispute['added_by_user_info']['first_name'])?ucfirst($arr_dispute['added_by_user_info']['first_name']):''}}
                                   {{isset($arr_dispute['added_by_user_info']['last_name'])?ucfirst($arr_dispute['added_by_user_info']['last_name']):''}}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <br/>

                              <div class="form-group">
                                 <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Against</label>
                                 <div class="col-sm-3 col-lg-2">:</div>
                                 <div class="col-sm-9 col-lg-5 controls">
                                   {{isset($arr_dispute['against_user_info']['title']) ? $arr_dispute['against_user_info']['title'] :''}}
                                   {{isset($arr_dispute['against_user_info']['first_name'])?ucfirst($arr_dispute['against_user_info']['first_name']):''}}
                                   {{isset($arr_dispute['against_user_info']['last_name'])?ucfirst($arr_dispute['against_user_info']['last_name']):''}}
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
                              <div class="form-group">
                                 <label for="password1" class="col-xs-3 col-lg-5 control-label">Payment Amount</label>
                                 <div class="col-sm-3 col-lg-2">:</div>
                                 <div class="col-sm-9 col-lg-5 controls">
                                   {{isset($arr_dispute['amount'])? '$'.$arr_dispute['amount']:''}}      
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
                         <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label for="password1" class="col-xs-3 col-lg-5 control-label">Status</label>
                               <div class="col-sm-3 col-lg-2">:</div>
                               <div class="col-sm-9 col-lg-5 controls">
                                  {{isset($arr_dispute['status']) && $arr_dispute['status'] == 'opened' ? 'Opened' :''}} 
                                  {{isset($arr_dispute['status']) && $arr_dispute['status'] == 'closed' ? 'Closed' :''}} 
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label for="password1" class="col-xs-3 col-lg-5 control-label">Added On</label>
                               <div class="col-sm-3 col-lg-2">:</div>
                               <div class="col-sm-9 col-lg-5 controls">
                                  {{isset($arr_dispute['created_at'])?(date('d M Y',strtotime($arr_dispute['created_at'])).' / '.date('h:i A',strtotime($arr_dispute['created_at']))):'NA'}}
                               </div>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                          </div>
                        </div>
                        @if(isset($arr_dispute['status']) && $arr_dispute['status'] == 'closed')
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                 <label for="password1" class="col-xs-3 col-lg-5 control-label">Closed On</label>
                                 <div class="col-sm-3 col-lg-2">:</div>
                                 <div class="col-sm-9 col-lg-5 controls">
                                    {{isset($arr_dispute['closed_date']) && $arr_dispute['closed_date'] != '0000-00-00 00:00:00' ?(date('d M Y',strtotime($arr_dispute['closed_date'])).' / '.date('h:i A',strtotime($arr_dispute['closed_date']))):'NA'}}
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <br/>
                            </div>
                          </div>
                        @endif

                      </div>
                     @else
                       <div class="alert alert-info alert-dismissible" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <strong>Sorry!</strong> Currently,no records found.
                       </div>
                     @endif 
                 </div>
              </div>
            </div>
            <div class="row">
              
              @if($add_by_user_arr['name'] == 'Patient')
                <div class="col-md-6">
                        <div class="box box-gray">
                           <div class="box-content">
                              <br/>
                              <div class="form-group">
                                 <label class="col-sm-2 col-lg-3 control-label">Refund to</label>
                                <form id="change_status_form" method="post" action="{{ $module_url_path }}/refund">
                                {{csrf_field()}}
                                 <div class="col-sm-9 col-lg-7 controls">
                                    <select class="frm-select form-control" id="cmb_refund_to" name="cmb_refund_to">
                                       <option value="">Select whom to refund</option>
                                       <option value="{{isset($add_by_user_arr['id']) ? $add_by_user_arr['id'] : '' }}" data-role="{{isset($add_by_user_arr['name']) ? $add_by_user_arr['name'] : '' }}">{{isset($add_by_user_arr['title']) ? $add_by_user_arr['title'] : '' }} {{isset($add_by_user_arr['first_name']) ? $add_by_user_arr['first_name'] : '' }} {{isset($add_by_user_arr['last_name']) ? $add_by_user_arr['last_name'] : '' }} {{isset($add_by_user_arr['name']) ? '('.$add_by_user_arr['name'].')' : '' }}</option>
                                       <!-- <option value="{{isset($against_user_arr['id']) ? $against_user_arr['id'] : '' }}" data-role="{{isset($against_user_arr['name']) ? $against_user_arr['name'] : '' }}">{{isset($against_user_arr['title']) ? $against_user_arr['title'] : '' }} {{isset($against_user_arr['first_name']) ? $against_user_arr['first_name'] : '' }} {{isset($against_user_arr['last_name']) ? $against_user_arr['last_name'] : '' }} {{isset($against_user_arr['name']) ? '('.$against_user_arr['name'].')' : '' }}</option> -->
                                    </select>
                                    <div id="err_cmb_refund_to" class="error" style="color:red;"></div>
                                 </div>
                                 <div class="col-sm-2 col-lg-2 controls">
                                    <div class="buttons">
                                        <input type="hidden" name="txt_dispute_id" id="txt_dispute_id" value="{{ isset($enc_dispute_id) ? $enc_dispute_id : '' }}">
                                        <button class="btn btn-success" name="btn_refund" id="btn_refund">Refund</button>
                                    </div>
                                 </div>
                                 </form>
                                 <script>
                                  $(document).ready(function(){
                                    $('#btn_refund').click(function(){
                                      var role = $('#cmb_refund_to option:selected').attr('data-role');
                                      var user = $('#cmb_refund_to option:selected').val();
                                      
                                      if(user == '')
                                      {
                                        $('#err_cmb_refund_to').show();
                                        $('#err_cmb_refund_to').html('Please select which user to refund');
                                        $('#err_cmb_refund_to').focus();
                                        return false;
                                      }

                                    });
                                  });
                                 </script>
                              </div>
                              <div class="clearfix"></div>
                              <br/>
                           </div>
                        </div>
                     </div>
              @endif

                     <div class="col-md-6">
                        <div class="box box-gray">
                            <form id="change_status_form" method="post" action="{{ $module_url_path }}/change_status/{{isset($enc_dispute_id) ? $enc_dispute_id : '' }}">
                               {{csrf_field()}}
                               <div class="box-content">
                                  <br/>
                                  <div class="form-group">
                                     <label class="col-sm-2 col-lg-3 control-label">Change Status to</label>
                                     <div class="col-sm-9 col-lg-7 controls">
                                        <select class="frm-select form-control" id="dispute_status" name="dispute_status">
                                            <option value="new" {{ isset($arr_dispute['status']) && $arr_dispute['status'] == 'new' ? 'selected' : '' }}>New</option>
                                            <option value="opened" {{ isset($arr_dispute['status']) && $arr_dispute['status'] == 'opened' ? 'selected' : '' }}>Open</option>
                                            <option value="closed" {{ isset($arr_dispute['status']) && $arr_dispute['status'] == 'closed' ? 'selected' : '' }}>Close</option> 
                                        </select>
                                        <div id="err_aprox_script" class="error">{{ $errors->first('dispute_status') }}</div>
                                     </div>
                                     <div class="col-sm-2 col-lg-2 controls">
                                        <div class="buttons">
                                            <button type="submit" class="btn btn-success" name="btn_save_chat" id="btn_change_status">Change</button>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <br/>
                               </div>
                            </form>
                        </div>
                     </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                  <div class="box box-gray">
                    <hr/>
                      <div class="messages msg-wrapper">
                        @if(isset($arr_dispute_response) && !empty($arr_dispute_response))
                            @foreach($arr_dispute_response as $val)
                                <div class="box-content"> 
                                   <div class="row">
                                    <label class="col-sm-2 col-lg-3 control-label">
                                          @if(isset($current_user_id) && $current_user_id == $val['userinfo']['id'])
                                            Admin
                                          @else
                                          {{isset($val['userinfo']['title']) ? $val['userinfo']['title'] : ''}} {{isset($val['userinfo']['first_name']) ? $val['userinfo']['first_name'] : ''}} {{isset($val['userinfo']['last_name']) ? $val['userinfo']['last_name'] : ''}}
                                          @endif
                                    </label>
                                    <div class="col-sm-8 col-lg-7 controls msg">
                                      {{isset($val['response']) ? $val['response'] : ''}}
                                    </div>
                                    <div class="col-sm-2 col-lg-2 date">
                                      {{-- 13.10.2017 3:29 PM --}}
                                        {{isset($val['created_at']) ? date('M d,Y h:m A' , strtotime($val['created_at'])) : ''}}
                                    </div>
                                    </div>
                               </div>
                               
                            @endforeach       
                        @endif
                    </div>
                 </div>
              </div>
           </div>

            <div class="row">
              <div class="col-md-5">
                  <div class="box box-gray">
                    <hr/>
                    <span id="comment_status" style="color: green"></span>
                     <div class="box-content" id="messages"> 
                         <form id="data" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                               <label class="col-sm-2 col-lg-3 control-label rpl-text">Reply</label>
                              <div class="col-sm-9 col-lg-7 controls">
                                <div class="input">
                                     <input type="text" class="form-control" id="response_msg" name="response_msg" placeholder="Write here..." value="">
                                     <div class="err" id="err_response_msg"></div>
                                </div>
                               </div>
                                <div class="buttons">
                                  <button class="btn btn-success" name="btn_save_chat" id="btn_save_chat">Reply</button>
                                </div>
                             
                             <input type="hidden" name="dispute_id"  id="dispute_id" value="{{$dispute_id}}">
                             <input type="hidden" name="added_by_user_id"  id="added_by_user_id" 
                             value="{{isset($arr_dispute['added_by_user_info']['id'])?$arr_dispute['added_by_user_info']['id']:''}}"> 
                             <input type="hidden" name="against_user_id"  id="against_user_id" 
                             value="{{isset($arr_dispute['against_user_info']['id'])?$arr_dispute['against_user_info']['id']:''}}"> 
                            <br/> 
                         </form> 
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
        $('#err_response_msg').html('Please enter a reply.');
        $('#err_response_msg').fadeOut(4000);
        $('#response_msg').focus();
        return false;
      }
      else
      { 
        var formData = new FormData($(this)[0]);

        var response   = $('#response_msg').val(); 
        
        $.ajax({
            url: '{{ url($module_url_path) }}/response',
            type: 'POST',
            data: formData,
            async: false,
            dataType:'json',
            success: function (data) { 
              if(data.status =='success')
              {
                $('.messages').append('<br><div class="box-content"><label class="col-sm-2 col-lg-3 control-label">Admin</label><div class="col-sm-9 col-lg-9 controls msg">'+response+'</div></div>');
              }
              else if(data.status =='error')
              {
                $('#comment_status').show();
                $('#comment_status').fadeOut(4000);
                $('#data')[0].reset();  
                $('#comment_status').html(data.msg);
              }
               $('#response_msg').focus();
               $('#data')[0].reset();  
              
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