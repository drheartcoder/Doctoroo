 @extends('front.doctor.layout.new_master')
 @section('main_content')

<?php
    $disabled_mail = "";
    $disabled_msg = "";
    $disabled_app = "";
    if(!empty($notification_arr))
    {
       foreach($notification_arr as $val)
       {
        if($val['notification']=='notification_email')
        {
            $notification_email_status=(($val['status']=='yes') ? 'checked' : '');

            if($val['status']!='yes')
            {
             $disabled_mail='disabled';
            }
        }
        else if($val['notification']=='email_consultation')
        {
          $email_consultation=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='email_orders')
        {
            $email_orders=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='email_newsletter')
        {
            $email_newsletter=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='msg_notification')
        {
            $msg_notification=(($val['status']=='yes') ? 'checked' : '');

            if($val['status']!='yes')
            {
                $disabled_msg='disabled';
            }
        }
        else if($val['notification']=='msg_consultation')
        {
            $msg_consultation=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='msg_orders')
        {
            $msg_orders=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='msg_newsletter')
        {
         $msg_newsletter=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='app_notification')
        {
          $app_notification=(($val['status']=='yes') ? 'checked' : '');
          if($val['status']!='yes')
          {
            $disabled_app='disabled';
          }
        }
        else if($val['notification']=='app_consultation')
        {
         $app_consultation=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='app_orders')
        {
            $app_orders=(($val['status']=='yes') ? 'checked' : '');
        }
        else if($val['notification']=='app_newsletter')
        {
            $app_newsletter=(($val['status']=='yes') ? 'checked' : '');
        }
    }

    $doc_mobile = isset($doc_data['mobile_no'])?$doc_data['mobile_no']:'';
  }
    ?>

    <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{$module_url_path}}" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Notification Settings</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
        <style>
            .error,
            .error_amount,
            .required_field {
                color: red;
            }
        </style>

        <ul class="collection nobrder brdrtopsd" id="notification_section">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">Email &amp; Notification</span>

                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_email_n_notification" <?php if(isset($notification_email_status)) { echo $notification_email_status; } else { echo 'checked'; } ?> >
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title">Consultations</span>

                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_email_consultation" <?php if(isset($email_consultation)) { echo $email_consultation; } ?> {{$disabled_mail}}>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>
                                <input type="checkbox" id="chk_email_orders" <?php if(isset($email_orders)) { echo $email_orders; } ?> {{$disabled_mail}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" id="chk_email_newsletter" <?php if(isset($email_newsletter)) { echo $email_newsletter; } ?> {{$disabled_mail}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="divider"></div>
        <ul class="collection nobrder brdrtopsd" id="text_sms_section">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">Text Messages (SMS) Notification</span>
                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_msg_notification" <?php if(isset($msg_notification)) { echo $msg_notification; } else { echo 'checked'; } ?> >
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Consultations</span>
                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_msg_consultation" <?php if(isset($msg_consultation)) { echo $msg_consultation; } ?> {{$disabled_msg}}>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>
                                <input type="checkbox" id="chk_msg_orders" <?php if(isset($msg_orders)) { echo $msg_orders; } ?> {{$disabled_msg}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>
                                <input type="checkbox" id="chk_msg_newsletter" <?php if(isset($msg_newsletter)) { echo $msg_newsletter; } ?> {{$disabled_msg}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="divider"></div>
        <div class="divider"></div>
        <ul class="collection nobrder brdrtopsd" id="mobile_app_section">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">App(Mobile Push) Notification</span>
                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_app_notification" <?php if(isset($app_notification)) { echo $app_notification; }else { echo 'checked'; } ?> >
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Consultations</span>
                </div>
                <div class="right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" id="chk_app_consultation" <?php if(isset($app_consultation)) { echo $app_consultation; } ?> {{$disabled_app}}>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>
                                <input type="checkbox" id="chk_app_orders" <?php if(isset($app_orders)) { echo $app_orders; } ?> {{$disabled_app}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>
                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>
                                <input type="checkbox" id="chk_app_newsletter" <?php if(isset($app_newsletter)) { echo $app_newsletter; } ?> {{$disabled_app}}>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="divider"></div>

        <div class="actnbtn"> <span class="right qusame rescahnge"><a href="javascript:void(0)" id="btn_save_notification" class="btn cart bluedoc-bg lnht round-corner">SAVE</a></span>
            <span class="left qusame rescahnge"><a class="border-btn round-corner center-align" href="{{$module_url_path}}">CANCEL</a></span></div>
        <div class="clr"></div>
        <style>
            .doctorForm [type="radio"]:not(:checked) + label::before {
                transition: .28s ease;
                border: 0 none;
                font-family: "Material icons";
                content: '\e5ca';
                font-size: 20px;
                background-color: #53ab57;
                line-height: 30px;
                padding: 0;
                margin: 0;
                color: #fff;
                text-align: center;
                width: 30px;
                height: 30px;
                box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.14), 0 1px 7px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -1px rgba(0, 0, 0, 0.2);
            }
        </style>
        
        </div>
    </div>
    </div>

    <a class="open_status_msg_popup" href="#status_msg_popup" style="display: none;"></a>
    <div id="status_msg_popup" class="modal addperson" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div id="flash_msg_text" style="text-align: center;"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
        </div>
    </div>

    <script>
        var url     = "<?php echo $module_url_path; ?>";
        var _token  = "<?php echo csrf_token(); ?>";

        $(document).ready(function() {
            $('#chk_email_n_notification').change(function() {
                if ($(this).is(':checked') == true) {
                    $('#notification_section').removeClass('not_allowed');
                    $('#chk_email_consultation,#chk_email_orders,#chk_email_newsletter').prop('disabled', false);
                } else {
                    $('#notification_section').addClass('not_allowed');
                    $('#chk_email_consultation,#chk_email_orders,#chk_email_newsletter').prop('disabled', true);
                    $('#chk_email_consultation,#chk_email_orders,#chk_email_newsletter').prop('checked', false);
                }
            });

            $('#chk_msg_notification').change(function() {
                if ($(this).is(':checked') == true) {
                    $('#text_sms_section').removeClass('not_allowed');
                    $('#chk_msg_consultation, #chk_msg_orders,#chk_msg_newsletter').prop('disabled', false);
                } else {
                    $('#text_sms_section').addClass('not_allowed');
                    $('#chk_msg_consultation, #chk_msg_orders,#chk_msg_newsletter').prop('disabled', true);
                    $('#chk_msg_consultation, #chk_msg_orders,#chk_msg_newsletter').prop('checked', false);
                }
            });

            $('#chk_app_notification').change(function() {
                if ($(this).is(":checked") == true) {
                    $('#mobile_app_section').removeClass('not_allowed');
                    $('#chk_app_consultation, #chk_app_orders, #chk_app_newsletter').prop('disabled', false);
                } else {
                    $('#mobile_app_section').addClass('not_allowed');
                    $('#chk_app_consultation, #chk_app_orders, #chk_app_newsletter').prop('disabled', true);
                    $('#chk_app_consultation, #chk_app_orders, #chk_app_newsletter').prop('checked', false);
                }
            });

            $('#btn_save_notification').click(function() {
                email_notification = email_consultation = email_orders = email_newsletter = "";

                if ($('#chk_email_n_notification').is(':checked') == true) {
                    email_notification = 'yes';
                } else {
                    email_notification = email_consultation = email_orders = email_newsletter = 'no';
                }
                email_consultation      = ($('#chk_email_consultation').is(':checked') == true) ? 'yes' : 'no';
                email_orders            = ($('#chk_email_orders').is(':checked') == true) ? 'yes' : 'no';
                email_newsletter        = ($('#chk_email_newsletter').is(':checked') == true) ? 'yes' : 'no';

                msg_notification = msg_consultation = msg_orders = msg_newsletter = "";

                if ($('#chk_msg_notification').is(':checked') == true) {
                    msg_notification = 'yes';
                } else {
                    msg_notification = msg_consultation = msg_orders = msg_newsletter = 'no';
                }

                var msg_consultation    = ($('#chk_msg_consultation').is(':checked') == true) ? 'yes' : 'no';
                var msg_orders          = ($('#chk_msg_orders').is(':checked') == true) ? 'yes' : 'no';
                var msg_newsletter      = ($('#chk_msg_newsletter').is(':checked') == true) ? 'yes' : 'no';

                var app_notification    = ($('#chk_app_notification').is(':checked') == true) ? 'yes' : 'no';
                var app_consultation    = ($('#chk_app_consultation').is(':checked') == true) ? 'yes' : 'no';
                var app_orders          = ($('#chk_app_orders').is(':checked') == true) ? 'yes' : 'no';
                var app_newsletter      = ($('#chk_app_newsletter').is(':checked') == true) ? 'yes' : 'no';

                $.ajax({
                    url: '{{ url("/") }}/doctor/settings/store_notification',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email_notification: email_notification,
                        email_consultation: email_consultation,
                        email_orders: email_orders,
                        email_newsletter: email_newsletter,
                        msg_notification: msg_notification,
                        msg_consultation: msg_consultation,
                        msg_orders: msg_orders,
                        msg_newsletter: msg_newsletter,
                        app_notification: app_notification,
                        app_consultation: app_consultation,
                        app_orders: app_orders,
                        app_newsletter: app_newsletter,
                        _token: _token
                    },
                    success: function(data) {
                        $(".open_status_msg_popup").click();
                        $('#flash_msg_text').html(data.msg);

                    }
                });
            });
        });
    </script>

    @endsection