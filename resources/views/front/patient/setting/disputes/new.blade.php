@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">

        <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>

        <h1 class="main-title center-align">Disputes</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="{{ url('/') }}/patient/setting/disputes" class="active redirect_new">New Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="{{ url('/') }}/patient/setting/disputes/open" class="redirect_open">Open Disputes</a>
                </li>
                <li class="tab truncate">
                    <a href="{{ url('/') }}/patient/setting/disputes/closed" class="redirect_closed">Closed Disputes</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="new-dispute" class="tab-content">
                @if(isset($dispute_arr['data']) && !empty($dispute_arr['data']))
                    <ul class="collection brdrtopsd">
                        @foreach($dispute_arr['data'] as $val)
                            <li class="collection-item valign-wrapper">
                                <span class="disputeIcon left circle center-align replied">
                                    <img src="{{ url('/') }}/public/new/images/handshake.svg"  />
                                  
                                </span>
                                <div class="left coupon-details "><span class="title">Dispute Id: {{isset($val['dispute_id']) ? $val['dispute_id'] : 'NA'}}</span>
                                    <small>Dispute Amount: {{isset($val['amount']) ? '$'.$val['amount'] : 'NA'}}</small>
                                    <small>Created on: {{isset($val['created_at']) ? date('d.m.Y' , strtotime($val['created_at'])) : 'NA'}}</small>
                                </div>
                                <div class="right posrel">
                                    <a href="#" data-activates='dispute_list_{{isset($val['id']) ? $val['id'] : ''}}' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>
                                </div>
                                <ul id='dispute_list_{{isset($val['id']) ? $val['id'] : ''}}' class='dropdown-content doc-rop rightless'>
                                    <li><a href="{{ url('') }}/patient/past_consultation/details/{{isset($val['consultation_id']) ? base64_encode($val['consultation_id']) : ''}}">View Consultation Details</a></li>
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
                                    
                                    <input type="hidden" class="dispute_id_view" value="{{isset($val['dispute_id']) ? $val['dispute_id'] : 'NA'}}">
                                    <input type="hidden" class="added_user_view" value="{{isset($added_by_user_name) ? $added_by_user_name : 'NA'}}">
                                    <input type="hidden" class="against_user_view" value="{{isset($against_user_name) ? $against_user_name : 'NA'}}">
                                    <input type="hidden" class="payment_reason_view" value="{{isset($val['payment_reason']) ? $val['payment_reason'] : 'NA'}}">
                                    <input type="hidden" class="payment_option_view" value="{{isset($val['select_payment']) ? $val['select_payment'] : 'NA'}}">
                                    <input type="hidden" class="payment_amt_view" value="{{isset($val['amount']) ? $val['amount'] : 'NA'}}">
                                    <input type="hidden" class="issue_view" value="{{isset($val['what_is_issue']) ? $val['what_is_issue'] : 'NA'}}">
                                    <input type="hidden" class="solution_like_view" value="{{isset($val['what_solution_you_like']) ? $val['what_solution_you_like'] : 'NA'}}">
                                    <input type="hidden" class="admin_comments" value="{{isset($val['admin_comments']) ? $val['admin_comments'] : 'NA'}}">
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
                        <p>Our team cares for each of ours and can understand that sometimes things don't go as they should.</p>
                        <p>To open a new dispute regarding a previous or upcoming payment or service, click the button below.</p>
                    </div>
                @endif

                <a class="waves-effect waves-light futbtn" href="#open_disputes">Open New Dispute</a>
            </div>
        </div>

        </div>
    </div>
    <!--Container End-->


    <div id="open_disputes" class="modal requestbooking full-app date-modal" style="display:none;">
        <form id="add_new_dispute_form" method="POST" action="{{ url('/') }}/patient/setting/disputes/store" >
            {{ csrf_field() }}
                <div class="modal-content">
                    <h4 class="center-align">Add New Dispute</h4>
                    <a class="modal-close closeicon"><i class="material-icons">close</i></a>
                </div>
                <div class="modal-data no-right-left-padding min-height">
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="input-field selct gender-drop2">
                                <select id="cmbconsultid" name="cmbconsultid" >
                                    <option value="" selected>Select Consultation ID <span class="required_field">*</span></option>
                                    @if(isset($consult_data) && !empty($consult_data))
                                        @foreach($consult_data as $val)
                                            <option value="{{ $val['id'] }}">{{ $val['consultation_id'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error_class " id="err_cmbconsultid" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s12 m12" style="display: none;" id="against_user_box">
                            <div class="input-field text-bx">
                                <input type="hidden" id="against_user_id" name="against_user_id">
                                <input id="against_user" name="against_user" type="text" class="validate" readonly="true">
                                <label for="against_user">Against</label>
                                <div class="error_class " id="err_against_user" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s12 m12">
                            <div class="input-field text-bx">
                                <input id="txtreason" name="txtreason" type="text" class="validate">
                                <label for="txtreason">Payment Reason <span class="required_field">*</span></label>
                                <div class="error_class " id="err_txtreason" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s12 m12">
                            <div class="input-field text-bx">
                                <input id="txtoption" name="txtoption" type="text" class="validate">
                                <label for="txtoption">Payment Option <span class="required_field">*</span></label>
                                <div class="error_class" id="err_txtoption" style="display:none;"></div>
                            </div>
                        </div>
                         <div class="col s12 m12">
                            <div class="input-field text-bx">
                                <input id="txtpayment" name="txtpayment" type="text" class="validate">
                                <label for="txtpayment">Dispute Amount (in $)<span class="required_field">*</span></label>
                                <div class="error_class" id="err_txtpayment" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s12 m12">
                            <div class="input-field text-bx">
                                <input id="txtissue" name="txtissue" type="text" class="validate">
                                <label for="txtissue">What is the issue <span class="required_field">*</span></label>
                                <div class="error_class" id="err_txtissue" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col s12 m12">
                            <div class="input-field text-bx ">
                                <input id="txtsolution" name="txtsolution" type="text" class="validate">
                                <label for="txtsolution">What solution would you like <span class="required_field">*</span></label>
                                <div class="error_class" id="err_txtsolution" style="display:none;"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer ">
                    <a href="javascript:void(0);" id="btn_close_app_family" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
                    <a href="javascript:void(0);" id="submit_form" class="modal-action waves-effect waves-green btn-cancel-cons right">Add Dispute</a>
                </div>
        </form>

    </div>

    <div id="dispute_details_modal" class="modal requestbooking full-app date-modal" style="display:none;">
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
                        <label for="view_solution">Created on</label>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer resp-bottom-footer" align="center">
            <a href="javascript:void(0);"  class="modal-action modal-close waves-effect waves-green btn-cancel-cons back full-width-btn">Close</a>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            
            $('#submit_form').click(function(){
                var consultid   = $('#cmbconsultid').val();
                var reason      = $('#txtreason').val();
                var option      = $('#txtoption').val();
                var amount     = $('#txtpayment').val();
                var issue       = $('#txtissue').val();
                var solution    = $('#txtsolution').val();
                var against_user_id = $('#against_user_id').val();

                if ($.trim(consultid) == '')
                {
                    $('#err_cmbconsultid').show();
                    $('#cmbconsultid').focus();
                    $('#err_cmbconsultid').html('Please select consultation id.');
                    $('#err_cmbconsultid').fadeOut(4000);
                    return false;
                }
                else if ($.trim(reason) == '')
                {
                    $('#err_txtreason').show();
                    $('#txtreason').focus();
                    $('#err_txtreason').html('Please enter payment reason.');
                    $('#err_txtreason').fadeOut(4000);
                    return false;
                }
                else if ($.trim(option) == '')
                {
                    $('#err_txtoption').show();
                    $('#txtoption').focus();
                    $('#err_txtoption').html('Please enter payment option.');
                    $('#err_txtoption').fadeOut(4000);
                    return false;
                }
                else if ($.trim(amount) == '')
                {
                    $('#err_txtpayment').show();
                    $('#txtpayment').focus();
                    $('#err_txtpayment').html('Please enter Dispute amount.');
                    $('#err_txtpayment').fadeOut(4000);
                    return false;
                }
                else if ($.trim(issue) == '')
                {
                    $('#err_txtissue').show();
                    $('#txtissue').focus();
                    $('#err_txtissue').html('Please enter issue.');
                    $('#err_txtissue').fadeOut(4000);
                    return false;
                }
                else if ($.trim(solution) == '')
                {
                    $('#err_txtsolution').show();
                    $('#txtsolution').focus();
                    $('#err_txtsolution').html('Please enter what solution you want.');
                    $('#err_txtsolution').fadeOut(4000);
                    return false;
                }
                else
                {
                    //return true;
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '{{ url("/") }}/patient/setting/disputes/store',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: token,
                            consultid: consultid,
                            reason: reason,
                            option: option,
                            amount: amount,
                            issue: issue,
                            solution: solution,
                            against_user_id:against_user_id
                        },
                        success: function (res) {
                            if (res) {
                                $("#open_disputes .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(res.msg);
                            }
                        }
                    });
                }
            });

            $('.redirect_new').click(function(){
                window.location.href = "{{ url('/') }}/patient/setting/disputes";
            });
            $('.redirect_open').click(function(){
                window.location.href = "{{ url('/') }}/patient/setting/disputes/open";
            });
            $('.redirect_closed').click(function(){
                window.location.href = "{{ url('/') }}/patient/setting/disputes/closed";
            });
            $('#txtpayment').keydown(function(){
                 $(this).val($(this).val().replace(/[^\d]/,''));

                 $(this).keyup(function(){
                     $(this).val($(this).val().replace(/[^\d]/,''));
                 });
            });

            $('#cmbconsultid').change(function(){
                    consultation_id = $(this).val();
                    $.ajax({
                        url: '{{ url("/") }}/patient/setting/disputes/against_user',
                        type: 'get',
                        dataType: 'json',
                        data: {consultation_id:consultation_id},
                        success: function (res) {
                            if(res.status == 'success')
                            {
                                $('#against_user_box').show();
                                $('#against_user').val(res.against_user_name);
                                $('#against_user').next('label').addClass('active');
                            }
                            else
                            {
                                $('#against_user_box').show();
                                $('#against_user').val('');
                                $('#against_user').next('label').addClass('active');   
                            }
                            $('#against_user_id').val(res.against_user_id);
                        }
                    });
            });

            $('.display_dispute_details').click(function(){

                $('#view_reason').val($(this).closest('ul').find('.payment_reason_view').val());
                $('#view_pay_option').val($(this).closest('ul').find('.payment_option_view').val());
                $('#view_payment_amt').val($(this).closest('ul').find('.payment_amt_view').val());
                $('#view_issue').val($(this).closest('ul').find('.issue_view').val());
                $('#view_solution').val($(this).closest('ul').find('.solution_like_view').val());
                $('#dispute_id').val($(this).closest('ul').find('.dispute_id_view').val());
                $('#created_at_date').val($(this).closest('ul').find('.created_at_view').val());
                
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
                $('#created_at_date').next('label').addClass('active');

            });

            $('#open_disputes .modal-close').click(function(){
                $('#add_new_dispute_form')[0].reset();
                $('#against_user_box').css('display','none');
            });

        });
    </script>


@endsection