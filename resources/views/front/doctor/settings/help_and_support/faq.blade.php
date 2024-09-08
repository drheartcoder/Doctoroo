@extends('front.doctor.layout.new_master')
@section('main_content')


    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">How Can we help you?</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
    <style>
        .error
        {
            color:red;
        }
    </style>
        <div class="medi ">
            <ul class="tabs tabli nomarnw z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#faq" class="active">FAQ's</a>
                </li>
                <li class="tab truncate">
                    <a href="#support">Contact &amp; Support</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="faq" class="tab-content ">
                <div class="searchsec posrel" style="position: relative !important;">
                    <div class="auto-bg"><img src="{{url('/')}}/public/new/images/faqhead.png" class="responsive-img"></div>   
                    <div class="auto-search-block">
                    <input type="text" id="autocomplete-input" class="newsearchbox search_faq" placeholder="Have a question? Ask or enter a search term">
                    <ul id="search_faq_result"></ul>
                    </div>                  
                    
                </div>
                <div class="commonTopics center-align">
                    <h3>Common FAQ's Topics</h3>
                    <ul class="grey_btn">
                        @foreach($faq_cats_arr as $val)
                        <li><a href="{{$module_url_path}}/faqs/{{$val['id']}}" class="bluedoc-text">{{$val['category_name']}}</a></li>
                        @endforeach
                    </ul>
                    <div class="clr"></div>
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

    <div id="show_msg" class="modal addperson" style="display: none;">
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

    <script>
    var url='<?php echo $module_url_path; ?>';
    $(document).ready(function(){
        $('.search_faq').keyup(function(){
            var search_txt=$(this).val();
            if($(this).val()!='')
            {
              $.ajax({
                 url:url+'/faq/search_faq',
                 type:'get',
                 data:{search_txt:search_txt},
                 dataType:'json',
                 success:function(data){
                    var search_list='';
                            $.each(data,function(i,obj)
                        {
                                search_list+="<li class='collapsible'><a style='color:purple;' href='{{$module_url_path}}/faqs/"+obj.category_id+"/"+obj.id+"'>"+obj.question+"</a></li>";
                                
                         });   
                            $('#search_faq_result').html(search_list);
                 }
              });
            }
            else
            {
                $('#search_faq_result').html('');
            }
        });

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