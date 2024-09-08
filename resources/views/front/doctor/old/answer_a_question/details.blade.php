@extends('front.doctor.layout.master')
@section('main_content')
<div class="banner-home inner-page-box">
 <div class="bg-shaad doc-bg-head">
 </div>
</div>
<!--calender section start-->    
<div class="container-fluid fix-left-bar">
 <div class="row">
    @include('front.doctor.layout._sidebar')
    <div class="col-sm-12 col-md-9 col-lg-10">
      @if(count($arr_details)>0)
       <div class="das-middle-content">
          <div class="row">
             <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="inner-head">Answer a Question</div>
               <div class="head-bor"></div>
                <div class="doc-dash-right-bx">
                   <div class="request-details-bx">
                      <div class="que-rply">
                         <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-8">
                               <h4> <span style="color:#848484;"> Question from: </span> {{$arr_details['patientinfo']['first_name'].' '.$arr_details['patientinfo']['last_name']}}</h4>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4" id="load_view_span">
                               <div class="ask-que">
                                  <h4> Asked : <span> {{date('d M',strtotime($arr_details['created_at'])).' , '.date('h:i A',strtotime($arr_details['created_at']))}}</span></h4>
                                  <h4> Views : <span> {{$view_count}}</span></h4>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="white-bxx">
                         <div class="uer-bxx">
                            <p>{{$arr_details['question'].' '.$arr_details['question']}}</p>
                             <br/>
                           @if(isset($arr_details['answer']) && $arr_details['answer']!="") 

                           <br/><hr/>
                           
                           <h5> Doctors Reply</h5>

                            <p> {{$arr_details['answer']}}</p>

                            @if(isset($arr_details['attachment']) && $arr_details['attachment']!="" && file_exists('uploads/front/doctor/reply_attachment/'.$arr_details['attachment']))

                            <p class="pull-right">
                              <a href="{{url('/')}}/doctor/download/{{base64_encode($arr_details['id'])}}" title="Download"><i class="fa fa-paperclip" aria-hidden="true"></i> Download Attachment
                            </p>

                            @endif

                            <div class="speak-btn">
                               <a href="" class="preview-link sum-btn"> Speak to a Patient</a>
                            </div>
                           @else 
                            <h5> Reply to this Patient</h5>
                           <form method="post" name="frm_answer" id="frm_answer" action="{{url('/')}}/doctor/reply/{{base64_encode($arr_details['id'])}}" enctype="multipart/form-data">

                            <textarea class="frm-in q-txta" id="reply_msg" name="reply_msg" cols="" rows="" placeholder="Reply to this Patient"></textarea>
                            <div class="err" id="err_reply_msg"></div>
                            <div class="last-row">
                               <a href="javascript:void(0);" onclick="appendMsg()" class="sugg-link">Suggest a Consultation</a>
                               <div class="attch-text">
                                  <div class="fileUpload">
                                     <span>Attach a File</span>
                                     <input type="file" class="upload" name="attach_file" id="attach_file" onchange="check_file_validation(this.value)" />
                                  </div>
                               </div>
                               <div class="err" id="err_attach_file"></div>
                              <button type="button" name="btn_answer_question" onclick="formValidation()" class="preview-link sum-btn"> Submit Reply</button>
                            </div>
                           </form> 
                          @endif  
                         </div>
                      </div>
                      <div class="clearfix"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
      @endif 
    </div>
 </div>
</div>
<!--calender section end-->     
<script>
  $(document).ready(function(){

      $("#load_view_span").load(location.href + " #load_view_span>*", "");
  });

 function appendMsg() 
 {
    var msg = 'I recommend that in order for me to be able to know more about your situation, A consultation would be required, which you can easily book from your end [Here].';
    var reply    =  $('#reply_msg').val();

    if(reply.indexOf(msg)!= -1)
    {

       var msg =  reply;
      
    }    
    else 
    {

        var msg =  reply+' '+msg; 
    }

    $('#reply_msg').val(msg);

 }

 function check_file_validation(ref)
 {

          
      $("#err_attach_file").html("");

       var ext = ref.split('.').pop();
       var file, img;

       if(ext != "doc" && ext != "pdf" && ext != "docx")
       {
          
             $('#err_attach_file').fadeIn(); 
             $('#err_attach_file').html('Please upload valid file with valid file extension i.e doc,pdf,docx.');
             $('#err_attach_file').fadeOut(4000);
             return false;
       }
       else
       {
            return true;
       }
}

function formValidation()
{

    var reply = $('#reply_msg').val();
    if($.trim(reply)=="")
    {

          $('#err_reply_msg').fadeIn('fast'); 
          $('#err_reply_msg').html('Please enter reply.');
          $('#err_reply_msg').fadeOut(5000);
          $('#reply_msg').focus();
          return false;  
    }
    else
    {

        $('form#frm_answer').submit();
        return true;
    }

}

</script>
@stop