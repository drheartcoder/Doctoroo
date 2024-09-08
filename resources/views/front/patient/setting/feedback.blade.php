@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">
       <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
       <h1 class="main-title center-align">Send Us your Feedback</h1>
    </div>
    <style>
        .error,.rating_error
        {
          color:red;
        }
    </style>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer minhtnor "> -->
       <form id="form_send_feedback">
          <div class="medi pdtbrl center-align">
             <div class="wid80 marrl">
                <p class="center-align grey-text"> <strong>Your feedback is important to us -</strong></p>
                <p class="center-align grey-text">It's because of this kind of feedback that doctoroo continues to be improved by our team &amp; loved by our members.</p>
             </div>
            
             <center><div id="rateYo"></div></center>
              <span class="rating_error"></span>
             <div class="input-field">
                <textarea id="feedback" class="materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                <span class="error left"></span>
             </div>
             <span class="right qusame marbtm"><a href="javascript:void(0)" id="btn_send_feedback" class="btn cart green lnht round-corner">Send Feedback</a></span>
             <div class="clr"></div>
             <!-- <div class="otherdetails">
                <a class="waves-effect waves-light btn cart bluedoc-bg round-corner" href="{{ url('/patient') }}/settings"><span class="truncate "> Rate us on the App Store</span> </a>
             </div> -->
          </div>
       </form>

       </div>
    </div>
    <!--Container End-->

    <script>
        var url="<?php echo $module_url_path; ?>";
        var _token="<?php echo csrf_token(); ?>";
        
        $(document).ready(function(){
             var $rateYo = $("#rateYo").rateYo();
             $('#btn_send_feedback').click(function(){
                $('.error,.rating_error').html('');
                
                var rating = $rateYo.rateYo("rating");
     
                var feedback=$('#feedback').val();
                 if(rating=='0')
                {
                    $('.rating_error').html('Please Select Rating');
                    return false;
                }
                else if($('#feedback').val()=='')
                {
                 $('.error').html('Please Enter message');
                 return false;
                }

                $.ajax({
                    url:url+'/feedback/store',
                    type:'post',
                    data:{feedback:feedback,rating:rating,_token:_token},
                    success:function(data){
                        $('#form_send_feedback')[0].reset();
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $(function () {
              $("#rateYo").rateYo({
                rating: 3.6
              });
            });
        });
    </script>

@endsection







