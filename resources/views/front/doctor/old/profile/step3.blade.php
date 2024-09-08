@extends('front.doctor.layout.master')                
@section('main_content')
  <style>
    .note
    {
      color:#ff6666;font-size:11px;
    }
  </style>

      <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
      <!--calender section start-->    
      <div class="container-fluid fix-left-bar">
         <div class="row">
            
            @include('front.doctor.layout._sidebar')

            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Doctor Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="patent-name"><span class="hi-txt">Hi </span>{{ $arr_doctor_data['userinfo']['first_name'] or '' }} {{ $arr_doctor_data['userinfo']['last_name'] or '' }}</div>
                        <br/>
                     </div>

                    <form action="{{ $module_url_path }}/update_step3" name="frm_doc_profile_step3" enctype="multipart/form-data" id="frm_doc_profile_step3" method="post">
                    {{ csrf_field() }}

                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="back-whhit-bx patient-white-bx" style="background:#fff">

                        @include('front.doctor.layout.middlebar')

                           <div class="row">
                             <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">&nbsp;</div>
                              <div class="col-sm-12 col-md-12 col-lg-8">
                                 <div class="pharma-step-bx">
                                    <div class="tble-title">
                                      Practitioner details
                                    </div>
                                    <div class="pharma-step-content">
                                      
                                     
                                       <div class="user_box">
                                            <textarea cols="" rows="" name="biography" data-rule-maxlength="255" placeholder="Please enter your Biography here. Include things such as: When you graduated, why you chose Medicine, What your approach to treating patients is, Years of experience etc" data-rule-required="true" class="form-inputs" style="padding:10px;height:130px;margin:5px 0;">{{ $arr_doctor_data['biography'] or ''  }}</textarea>
                                       </div>

                                        <div class="user_box">
                                             <input type="file" id="doctor_video" style="visibility:hidden; height: 0;" name="doctor_video"/>
                                             <div class="input-group pharma-up">
                                                <div class="btn btn-primary btn-file btn-gry">
                                                   <a class="file" onclick="browseVideo()">Upload 
                                                   </a>
                                                </div>
                                                <input type="text" placeholder="Upload Video" class="form-control file-caption  kv-fileinput-caption" id="video_name" disabled="disabled"/>
                                                <span class="hidden-xs hidden-sm hidden-md"><img src="{{ url('/') }}/public/images/upload-icon.png" alt="upload icon"/></span>
                                                <div class="btn btn-primary btn-file remove" style="display:none;" id="btn_remove_video">
                                                   <a class="file" onclick="removeVideo()"><i class="fa fa-trash"></i>
                                                   </a>
                                                </div>

                                             </div>
                                              <div id="err_video"></div>
                                              <span class="error">{{  $errors->first('doctor_video') }}</span>
                                               <span class="note">Note:supported file types ogv,webm,mp4 & size upto 10 MB.</span>
                                          </div>
                                         
                                    </div>
                                    <div class="clearfix"></div>
                                      <div class="">
                                          <div class="user-box">
                                             @if(isset($arr_doctor_data['video']) && $arr_doctor_data['video']!='' && file_exists($video_base_path.$arr_doctor_data['video']))
                                    
                                               <div class="col-sm-12 col-md-12 col-lg-12">
                                               <div class="videoWrapper">
                                                    <video controls width="100%"> 
                                                    @if(isset($arr_doctor_data['video_extension']) && $arr_doctor_data['video_extension']=='mp4')

                                                        <source src="{{ $video_public_path.$arr_doctor_data['video'] }}" type=video/mp4>

                                                    @elseif(isset($arr_doctor_data['video_extension']) && $arr_doctor_data['video_extension']=='ogv')


                                                        <source src="{{ $video_public_path.$arr_doctor_data['video'] }}" type=video/ogg> 

                                                    @elseif(isset($arr_doctor_data['video_extension']) && $arr_doctor_data['video_extension']=='webm')


                                                        <source src="{{ $video_public_path.$arr_doctor_data['video'] }}" type=video/webm> 


                                                    @endif
                                                 
                                                    </video>
                                          
                                                </div>
                                               </div> 
                                             @endif
                                             <div class="clearfix"></div>
                                          </div>
                                      </div>
                                      <div class="clearfix"></div>
                                 </div>
                              </div>
                                

                              <div class="col-sm-12">
                                 <div class="see-d-dash-panel text-center" style="padding: 0px;">
                                
                                 <input type="submit" class="btn-grn pull-right" style="margin:0 0 30px;" name="btn_doctor_profile_step2" id="btn_doctor_profile_step2" value="Finish & submit">

                                 </div>
                              </div>
                             <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">&nbsp;</div>
                           </div>

                        </div>
                     </div>

                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
<script>

    /*AHPRA_certificate*/
    function browseVideo() 
    {
        $("#doctor_video").trigger('click');
     }
     
     function removeVideo() {
     $('#video_name').val("");
     $("#btn_remove_video").hide();
     $("#doctor_video").val("");
     }
     
     $('#doctor_video').change(function() 
     {
          
         if ($(this).val().length > 0) {
             $("#btn_remove_video").show();
         }
       
         $('#video_name').val($(this).val());
     });


      $('#frm_doc_profile_step3').validate({
           errorElement:'span',
            errorPlacement: function (error, element) 
            {
              if(name == "doctor_video") 
              {
                error.insertAfter('#err_video').fadeOut(4000);
              }
              else
              {
                error.insertAfter(element).fadeOut(4000);
              }
              
           },
           rules: 
           {  
               
                    doctor_video: {
          
                           extension: 'ogv|webm|mp4',

                       },

                 },         
           messages: {
                       
                        biography:
                        {
                            required:"Please enter a biography.",
                        },
                        doctor_video: 
                        {
                            accept:"Please upload a valid video.",
                        },
                       
                    }
       });

      $('#frm_doc_profile_step3').on('submit',function()
      {
            
            var form   = $(this);
            var isValid = form.valid();
            if(isValid)
            {
              showProcessingOverlay();
            }
      });
</script>

@endsection