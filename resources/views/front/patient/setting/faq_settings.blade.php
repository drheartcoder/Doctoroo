@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/faq" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">How Can we help you?</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer minhtnor "> -->
    <style>
        .error
        {
            color:red;
        }
    </style>
        <div class="medi ">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#faq" class="active">FAQ's</a>
                </li>
                <li class="tab truncate">
                    <a href="#support">Contact &amp; Support</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="faq" class="tab-content ">
                <div class="pdrl">
                    <div class="nav-wrapper">
                        <a href="{{$module_url_path}}/faq" class="breadcrumb">FAQ's</a>
                        <a href="#" class="breadcrumb"><?php if(isset($category_name)) { echo $category_name;} ?></a>
                    </div>
                    <div class="gray-strip">
                        <div class="bluedoc-text center-align">
                            <?php if(isset($category_name)) { echo $category_name;} ?>
                        </div>
                    </div>
                    
                    <h2 class="faqhead"><?php if(isset($category_name)) { echo $category_name;} ?></h2>
                    <ul class="collapsible faqbox" data-collapsible="accordion">
                    <?php $active=''; ?>
                        @foreach($faq_arr as $val)
                        <li>
                                <?php 
                                     if(!empty($faq_id))
                                     {
                                        if($val['id']==$faq_id)
                                        {
                                            $active='active';
                                        } 
                                     }   
                                ?>
                            <div class="collapsible-header {{$active}}" id="{{$active}}"><i class="material-icons white-text bluedoc-bg headicon circle">add</i>{{$val['question']}}</div>
                            <div class="collapsible-body">
                                <span>
                                    {{$val['answer']}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @if(sizeof($faq_arr)==0)
                        <h5 class="no-data">No data found</h5>
                    @endif
                </div>
            </div>
              <div id="support" class="tab-content">
                <div class="">
                    <ul class="collapsible supportbox" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header supporthead "> <i class="material-icons left">mail_outline</i> Send an email or message <i class="material-icons right  arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body center-align">
                                <span class="email">Email us: <a href="mailto:wecare@doctoroo.com.au">wecare@doctoroo.com.au</a></span>
                                <p>- OR -</p>
                                <form id="send_msg_form">
                                <div class="input-field">
                                    <textarea  class="msg materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                                    <span class="left error"></span>
                                </div>
                                <span class="right qusame"><a href="javascript:void(0)" class="btn_msg_send btn cart bluedoc-bg lnht round-corner">SEND</a></span>
                               
                                <div class="clr"></div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header supporthead"><i class="material-icons left">chat</i> Chat with us <i class="material-icons right arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body">
                                <div class="input-field">
                                    <textarea id="textarea1" class="msg materialize-textarea textArea" placeholder="Enter your Message or Enquiry"></textarea>
                                    <span class="error"></span>
                                </div>
                                <span class="right qusame"><a href="javascript:void(0)" class="btn_msg_send btn cart bluedoc-bg lnht round-corner">Start Chat</a></span>
                                <div class="clr"></div>
                            </div>
                        </li>
                         </form>
                        <li>
                            <div class="collapsible-header supporthead"><i class="material-icons left">phonelink_ring</i>Call us <i class="material-icons right arrow">keyboard_arrow_down</i></div>
                            <div class="collapsible-body left-align">
                                <p><img src="{{url('/')}}/public/new/images/australia-flag.svg" class="flagicon left" /> +61 488 863 626</p>
                                <p>Mon - Fri <span class="bluedoc-text">9am - 5pm </span>(EST)</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/review_booking">Save</a>-->

        </div>
    </div>
    <!--Container End-->

    <a class="popup_open" href="#show_msg" style="display: none;"></a>
    <div id="show_msg" class="modal requestbooking" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text center-align"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <?php
    if(!empty($faq_id))
    {
    ?>
    <script>
    $(document).ready(function(){
           $('html, body').animate({
        scrollTop: $("#active").offset().top
    }, 2000); 
    });
    </script>
    <?php } ?>

<script>
var url="<?php echo $module_url_path; ?>";
$(document).ready(function(){
    
$('.btn_msg_send').click(function(e){
    e.preventDefault();
  var msg=$(this).closest('li').find('.msg').val();
$('.error').html('');
   if($(this).closest('li').find('.msg').val()=='')
   {
    $(this).closest('li').find('.error').html("Please enter message");
    
    return false;
   }
    
    $.ajax({
        url:url+'/enquiry_msg',
        type:'get',
        data:{msg:msg},
        dataType:'json',
        success:function(data){
            $('#send_msg_form')[0].reset();
            $(".popup_open").click();
            $('.flash_msg_text').html(data.msg);
        }
    });
});

});
</script>
    @endsection