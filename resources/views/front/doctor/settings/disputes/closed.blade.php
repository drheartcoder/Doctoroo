@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Disputes</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')


    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="{{ url('/') }}/doctor/settings/disputes" class="redirect_new">New Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="{{ url('/') }}/doctor/settings/disputes/open" class="redirect_open">Open Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="{{ url('/') }}/doctor/settings/disputes/closed" class="active redirect_closed">Closed Disputes</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="closed-dispute" class="tab-content">
                @if(isset($dispute_arr['data']) && !empty($dispute_arr['data']))
                    <ul class="collection brdrtopsd">
                        @foreach($dispute_arr['data'] as $val)
                            <li class="collection-item valign-wrapper">
                                <span class="disputeIcon left circle center-align replied">
                                    <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                                  
                                </span>
                                <div class="left coupon-details "><span class="title">Dispute Id: {{isset($val['dispute_id']) ? $val['dispute_id'] : 'NA'}}</span>
                                    <small>Dispute Amount: {{isset($val['amount']) ? '$'.$val['amount'] : 'NA'}}</small>
                                    <small>Dispute Closed on: {{isset($val['closed_date']) && $val['closed_date'] != '0000-00-00 00:00:00' ? date('d.m.Y' , strtotime($val['closed_date'])) : 'NA'}}</small>
                                </div>
                                <div class="right posrel">
                                    <a href="#" data-activates='dispute_list_{{isset($val['id']) ? $val['id'] : ''}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                </div>
                                <ul id='dispute_list_{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless'>
                                    <li><a href="{{ url('') }}/doctor/consultation/past_consultation_details/{{isset($val['consultation_id']) ? base64_encode($val['consultation_id']) : ''}}">View Consultation Details</a></li>
                                    <li><a href="#dispute_details_modal" class="display_dispute_details">Dispute Details</a></li>
                                    @php
                                        
                                        $user_title = isset($val['added_by_user_info']['title']) ? $val['added_by_user_info']['title'] : '';
                                        $firstname = isset($val['added_by_user_info']['first_name']) ? $val['added_by_user_info']['first_name'] : '';
                                        $last_name = isset($val['added_by_user_info']['last_name']) ? $val['added_by_user_info']['last_name'] : '';

                                        $added_by_user_name = $user_title.' '.$firstname.' '.$last_name;

                                        $against_user_title = isset($val['against_user_info']['title']) ? $val['against_user_info']['title'] : '';
                                        $against_user_firstname = isset($val['against_user_info']['first_name']) ? $val['against_user_info']['first_name'] : '';
                                        $against_user_last_name = isset($val['against_user_info']['last_name']) ? $val['against_user_info']['last_name'] : '';

                                        $against_user_name = $against_user_title.' '.$against_user_firstname.' '.$against_user_last_name;

                                        if($current_user_id == $val['added_by_user_info']['id'])
                                        {
                                            $added_by_user_name = '';
                                        }
                                        else if($current_user_id == $val['against_user_info']['id'])
                                        {
                                            $against_user_name =  '';
                                        }

                                    @endphp
                                    <input type="hidden" class="dispute_enc_id" value="{{isset($val['id']) ? base64_encode($val['id']) : ''}}">
                                    <input type="hidden" class="dispute_id_view" value="{{isset($val['dispute_id']) ? $val['dispute_id'] : 'NA'}}">
                                    <input type="hidden" class="added_user_view" value="{{isset($added_by_user_name) ? $added_by_user_name : 'NA'}}">
                                    <input type="hidden" class="against_user_view" value="{{isset($against_user_name) ? $against_user_name : 'NA'}}">
                                    <input type="hidden" class="payment_reason_view" value="{{isset($val['payment_reason']) ? $val['payment_reason'] : 'NA'}}">
                                    <input type="hidden" class="payment_option_view" value="{{isset($val['select_payment']) ? $val['select_payment'] : 'NA'}}">
                                    <input type="hidden" class="payment_amt_view" value="{{isset($val['amount']) ? $val['amount'] : 'NA'}}">
                                    <input type="hidden" class="issue_view" value="{{isset($val['what_is_issue']) ? $val['what_is_issue'] : 'NA'}}">
                                    <input type="hidden" class="solution_like_view" value="{{isset($val['what_solution_you_like']) ? $val['what_solution_you_like'] : 'NA'}}">
                                    <input type="hidden" class="admin_comments" value="{{isset($val['admin_comments']) ? $val['admin_comments'] : 'NA'}}">
                                    <input type="hidden" class="close_on_view" value="{{isset($val['closed_date']) && $val['closed_date'] != '0000-00-00 00:00:00' ? date('d.m.Y' , strtotime($val['closed_date'])) : 'NA'}}">
                                    <input type="hidden" class="admin_comment_date_view" value="{{isset($val['admin_comment_date']) && $val['admin_comment_date'] != '0000-00-00 00:00:00' ? date('d.m.Y' , strtotime($val['admin_comment_date'])) : 'NA'}}">
                                    <input type="hidden" class="created_at_view" value="{{isset($val['created_at']) ? date('d.m.Y' , strtotime($val['created_at'])) : 'NA'}}">
                                </ul>
                            </li>
                        @endforeach
                        <div class="paginaton-block-main">
                            {{ $paginate->render() }}
                        </div>
                    </ul>
                @else
                    <div class="disp center-align">
                        <br>
                        <h5 class="center-align no-data">No records found</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    <!--Container End-->

    <div id="dispute_details_modal" class="modal addperson full-app date-modal" style="display:none;">
        <div class="modal-content">
            <h4 class="center-align">Dispute Details</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data no-right-left-padding min-height">
            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field text-bx">
                        <input id="dispute_id" name="dispute_id" type="text" class="validate" readonly="true">
                        <label for="dispute_id">Dispute ID</label>
                    </div>
                </div>
                <div class="col s12 m6" id="against_user_box_view">
                    <div class="input-field text-bx">
                        <input id="view_against_user" name="view_against_user" type="text" class="validate" readonly="true">
                        <label for="view_against_user">Against</label>
                    </div>
                </div>
                <div class="col s12 m6" id="added_user_box">
                    <div class="input-field text-bx">
                        <input id="view_added_by_user" name="view_added_by_user" type="text" class="validate" readonly="true">
                        <label for="view_added_by_user">Added By</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx">
                        <input id="view_reason" name="view_reason" type="text" class="validate" readonly="true">
                        <label for="view_reason">Payment Reason</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx">
                        <input id="view_pay_option" name="view_pay_option" type="text" class="validate" readonly="true">
                        <label for="view_pay_option">Payment Option</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx">
                        <input id="view_payment_amt" name="view_payment_amt" type="text" class="validate"  readonly="true">
                        <label for="view_payment_amt">Dispute Amount (in $)</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx">
                        <input id="view_issue" name="view_issue" type="text" class="validate"  readonly="true">
                        <label for="view_issue">What is the issue <span class="required_field">*</span></label>
                        <div class="error_class" id="err_txtissue" style="display:none;"></div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx ">
                        <input id="view_solution" name="view_solution" type="text" class="validate" readonly="true">
                        <label for="view_solution">What solution would you like</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx ">
                        <input id="created_at_date" name="created_at_date" type="text" class="validate" readonly="true">
                        <label for="view_solution">Dispute Added Date</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field text-bx ">
                        <input id="close_on_date" name="close_on_date" type="text" class="validate" readonly="true">
                        <label for="close_on_date">Closed On</label>
                    </div>
                </div>
            </div>

            <div class="row">
               <div class="col s12 m12">
                Comments
                <ul id="user_comments">

                </ul>
                </div>
            </div>

        </div>
        <div class="modal-footer resp-bottom-footer" align="center">
            <a href="javascript:void(0);"  class="modal-action modal-close waves-effect waves-green btn-cancel-cons back full-width-btn">Close</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            var url = "<?php echo $module_url_path; ?>";
            var current_user_id = "<?php echo $current_user_id; ?>";

            $('.redirect_new').click(function(){
                window.location.href = "{{ url('/') }}/doctor/settings/disputes";
            });
            $('.redirect_open').click(function(){
                window.location.href = "{{ url('/') }}/doctor/settings/disputes/open";
            });
            $('.redirect_closed').click(function(){
                window.location.href = "{{ url('/') }}/doctor/settings/disputes/closed";
            });

            $('.display_dispute_details').click(function(){

                $('#view_reason').val($(this).closest('ul').find('.payment_reason_view').val());
                $('#view_pay_option').val($(this).closest('ul').find('.payment_option_view').val());
                $('#view_payment_amt').val($(this).closest('ul').find('.payment_amt_view').val());
                $('#view_issue').val($(this).closest('ul').find('.issue_view').val());
                $('#view_solution').val($(this).closest('ul').find('.solution_like_view').val());
                $('#dispute_id').val($(this).closest('ul').find('.dispute_id_view').val());
                $('#admin_comments_view').val($(this).closest('ul').find('.admin_comments').val());
                $('#created_at_date').val($(this).closest('ul').find('.created_at_view').val());
                $('#admin_comment_date').val($(this).closest('ul').find('.admin_comment_date_view').val());
                $('#close_on_date').val($(this).closest('ul').find('.close_on_view').val());
                
                var added_by_user = $(this).closest('ul').find('.added_user_view').val();
                var against_user = $(this).closest('ul').find('.against_user_view').val();
                
                $('#added_user_box').css('display', 'none');
                $('#against_user_box_view').css('display', 'none');

                if(added_by_user == '')
                {
                    $('#against_user_box_view').css('display', 'block'); 
                    $('#view_against_user').val(against_user);   
                    $('#view_against_user').next('label').addClass('active');
                }
                else if(against_user == '')
                {
                      $('#added_user_box').css('display', 'block');  
                      $('#view_added_by_user').val(added_by_user);
                      $('#view_added_by_user').next('label').addClass('active');
                }

                $('#view_reason').next('label').addClass('active');
                $('#view_pay_option').next('label').addClass('active');
                $('#view_payment_amt').next('label').addClass('active');
                $('#view_issue').next('label').addClass('active');
                $('#view_solution').next('label').addClass('active');
                $('#dispute_id').next('label').addClass('active');
                $('#admin_comments_view').next('label').addClass('active');
                $('#close_on_date').next('label').addClass('active');
                $('#created_at_date').next('label').addClass('active');
                $('#admin_comment_date').next('label').addClass('active');

                var dispute_id = $(this).closest('ul').find('.dispute_enc_id').val();

                $.ajax({
                    url:url+'/disputes/comments',
                    type:'get',
                    data:{dispute_id:dispute_id},
                    dataType:'json',
                    success:function(data){
                          var response = '';

                          $.each(data,function(i,obj)
                           {  
                                title = "";

                                title = data[i]['userinfo']['title']+' ';

                                first_name = data[i]['userinfo']['first_name']+' ';

                                last_name  =  data[i]['userinfo']['last_name']+' ';

                                from_user_name = title + first_name + last_name;

                                if(data[i]['userinfo']['id'] == '1')
                                {
                                    from_user_name = 'Admin';                                
                                }
                                else if(data[i]['userinfo']['id'] == current_user_id)
                                {
                                    from_user_name = 'You';                                 
                                }

                                var date = new Date(data[i]['created_at']);

                                var day = date.getDate();
                                var month = date.getMonth();
                                var year = date.getFullYear();

                                var hh = date.getHours();
                                var m = date.getMinutes();
                                var s = date.getSeconds();
                                var dd = "AM";
                                var h = hh;
                                if (h >= 12) {
                                    h = hh - 12;
                                    dd = "PM";
                                }
                                if (h == 0) {
                                    h = 12;
                                 }
                                m = m < 10 ? "0" + m : m;

                                s = s < 10 ? "0" + s : s;

                                var reply_date = day+'.'+month+'.'+year+' '+h+':'+m+' '+dd;

                                response += "<li><strong>"+from_user_name+" : </strong>"+data[i]['response']+" "+reply_date+"</li>";
                               
                           });

                           $('#user_comments').html(response);
                           if(data == '')
                           {
                                $('#user_comments').html('NA');
                           }
                    }
                });

            });
        });
    </script>

@endsection