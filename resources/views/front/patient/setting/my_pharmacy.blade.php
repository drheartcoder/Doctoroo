@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">My Pharmacies</h1>
        <div class="fix-add-btn">
            <a  href="{{ url('/') }}/patient/setting/add_pharmacy"><span class="grey-text">Add Pharmacy</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
            </a>
        </div>
    </div>

    <div class="medi marmain">
    <style>
        .error
            {
                color:red;
            }
    </style>


    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

        <!-- <div class="container posrel has-header" style="padding-bottom: 80px;!important"> -->

        <form id="patient_preferences_form" action="post" enctype="multipart/form-data">
            <div class="green-text padtopbtm">My Click &amp; Collect Pharmacies</div>
            @if(Session::has('msg'))
                <div class="green-text padtopbtm">{{Session::get('msg')}}</div>
            @endif
            <ul class="collection brdrtopsd ">
                @if(isset($pharmacy_data) && !empty($pharmacy_data))
                    @foreach($pharmacy_data as $ph_data)

                        <li class="collection-item avatar valign-wrapper">
                            <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                            <div class="doc-detail-location left"><span class="title truncate">{{ $ph_data['pharmacy_list']['company_name'] }}</span>
                                <small>{{ $ph_data['pharmacy_list']['street'].', '.$ph_data['pharmacy_list']['suburb'].', '.$ph_data['pharmacy_list']['state'].', '.$ph_data['pharmacy_list']['code'] }}</small>
                            </div>
                            <div class="right posrel"> <a href="javascript:void(0);" data-activates='dropdown{{ $ph_data["id"] }}' class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                            <ul id='dropdown{{ $ph_data["id"] }}' class='dropdown-content doc-rop rightless'>
                                <!-- <li><a href="javascript:void(0);" class="view_msg" data-pharmacy_id="{{ $ph_data['id'] }}">View Message</a></li>
                                <li><a href="javascript:void(0);" class="change" data-pharmacy_id="{{ $ph_data['id'] }}">Change</a></li> -->
                                <li><a href="#delete" class="delete" data-pharmacy_id="{{ base64_encode($ph_data['id']) }}">Delete</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </li>

                    @endforeach
                @else
                    <li class="collection-item avatar valign-wrapper">
                        <div class="doc-detail-location left">
                            <h5 class="no-data" style="text-align: center;">No pharmacy added</h5>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                @endif
            </ul>
            
            <div class="clr"></div>
            <div class="green-text padtopbtm">Preferences</div>
            <div class="bluedoc-text">Preferred Medication Brand</div>
            <p class="grey-text">Do you prefer Original or Generic medications?
                <a  href="#difference-msg">What is the differece?</a>
            </p>
            <div class="row" >
                    <div class="input-field col s12 m12 l12 selct padbtm30 errorchanges">
                        <select id="brand" name="brand">
                            <option value="">Select Brand</option>
                            <?php 
                                $brand_arr=array('Original','Generic','Either');
                                $sel='';
                                foreach($brand_arr as $brand)
                                {
                                    if(isset($user_entitlement_arr['brand']))
                                    {
                                        if($user_entitlement_arr['brand']==$brand)
                                        {
                                            $sel='selected';
                                        }    
                                        else
                                        {
                                            $sel='';
                                        }
                                    }
                                    ?>
                                    <option value="{{$brand}}" {{$sel}}>{{$brand}}</option>        
                                    <?php
                                }
                            ?>
                        </select>
                        <span class="error left-12px"></span>
                    </div>
                </div>
            <div class="clr"></div>
           
            <div >
                <div class="bluedoc-text">Entitlement</div>
                <div class="row" style="">
                    <div class="input-field col s6 m6 l6 selct padbtm30 errorchanges">
                        <select id="entitlement" name="entitlement">
                                 <option value="0">Select Entitlement</option>
                            @foreach($entitlement as $val)
                                <?php 
                                        $selected="";
                                    if(isset($user_entitlement_arr['entitlement_id']))
                                    {
                                        if($user_entitlement_arr['entitlement_id']==$val['id'])
                                        {
                                            $selected='selected';
                                        }    
                                        else
                                        {
                                            $selected='';
                                        }
                                    }
                                ?>
                                <option value="{{$val['id']}}" {{$selected}}>{{$val['entitlement']}}</option>
                            @endforeach
                        </select>
                        <span class="error left-12px"></span>
                    </div>
                    <div class="input-field col s6 m6 l6  text-bx lessmar errorchanges">
                        <input type="text" id="card_no" name='card_no' class="validate " value="<?php if(isset($user_entitlement_arr['card_no']) && $user_entitlement_arr['card_no']!='0'){echo $user_entitlement_arr['card_no'];} else { echo ''; } ?>">
                        <label for="card_no" class="grey-text truncate">Card Number <span style="color:red;">*</span></label>
                        <span class="error"></span>
                    </div>

                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col s12 m12 l12 ">
                        <div class="input-field uploadImgnew new-upload-img doctr-mtrz">
                            <div class="file-field input-field">
                                <!-- <div class="btn">
                                    <span><i class="material-icons">camera_alt</i></span>
                                    <input type="file" name="file_affected_area" id="file_affected_area" multiple>
                                </div><span class="textside">Optional - Upload photo of affected area.</span> -->
                                <div>
                                    <span data-multiupload="3">
                                    <span data-multiupload-holder></span>
                                    <div class="clr">
                                        <div class="btn ">
                                            <span><i class="material-icons">camera_alt</i></span>
                                        </div>
                                        <span class="textside">Upload Photo Of Entitlement Card</span>
                                        <input data-multiupload-src class="upload_pic_btn" type="file" multiple="">
                                        <div class="clr"></div>
                                    </div>
                                    <span data-multiupload-fileinputs></span>
                                    </span>
                                    <!-- <input type="file" id="medical_files" name="medical_files" multiple> -->
                                </div>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>
            <span class="left qusame rescahnge">
                <a class="border-btn round-corner  center-align" href="{{$module_url_path}}">CANCEL
                </a>
            </span>
            <span class="right qusame rescahnge">
                <button id="btn_save_patient_preference" type="submit" class="btn cart bluedoc-bg lnht round-corner">SAVE</button>
            </span>
        
            <div class="clr"></div>
            </form>


            </div>

        </div>
        <!--Container End-->
    </div>

    <div id="delete" class="modal requestbooking">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p>Are you sure you want to Delete Pharmacy?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align two-btn-block">
            <a href="javascript:void(0);" class="modal-close modal-action waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="javascript:void(0);" class="modal-action waves-effect waves-green btn-cancel-cons confirm_delete">Delete</a>
        </div>
    </div>
    
<!--what is difference popup start-->
<div id="difference-msg" class="modal requestbooking small-modal">
      
        <div class="modal-content">
            <h4 class="center-align">What is Difference?</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        
        <div class="modal-data">
            <p style=" margin: 0;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons submit_form full-width-btn">Ok</a>
        </div>
      
    </div>    
<!--what is difference popup end-->    

<script>
var url="<?php echo $module_url_path; ?>";
    $(document).ready(function() {
        $('.delete').click(function(){
            var pharmacy_id = jQuery(this).data("pharmacy_id");
            $('.confirm_delete').click(function(){
                if(pharmacy_id != '')
                {
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '{{ url("/") }}/patient/setting/delete_my_pharmacy',
                        type:'get',
                        dataType:'json',
                        data:{pharmacy_id:pharmacy_id,_token:token},
                        success:function(data){
                            if(data.msg)
                            {
                                $("#delete .modal-close").click()
                                $(".open_popup").click();
                                $('.flash_msg_text').html(data.msg);
                            }
                        }
                    });
                }
            });
        });

        var _token="<?php echo csrf_token(); ?>"
        $('#patient_preferences_form').submit(function(e){
            e.preventDefault();
            $('.error').html('');

            if($('#brand').val()=='' || $('#brand').val()==null)
            {
                $('#brand').closest('.input-field').find('.error').html("Please select Brand");
                return false;
            }
            else if($('#entitlement').val()=='0' || $('#entitlement').val()=='')
            {
                $('#entitlement').closest('.input-field').find('.error').html("select Entitlement");
                return false;
            }
            else if($('#card_no').val()=='' || $('#card_no').val()==null)
            {
                $('#card_no').closest('.input-field').find('.error').html("Enter your card number.");
                return false;
            }

            var form = $('#patient_preferences_form')[0];
            var formData = new FormData(form);
            formData.append('_token',_token);
            $.ajax({
                url:url+'/preference_store',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(data){
                   $(".open_popup").click();
                   $('.flash_msg_text').html(data.msg);
                }
            });
        });
    });
</script>

<script>
 //dropzone script with multiple files
            (function ($) {
                function readMultiUploadURL(input, callback) {

                    if (input.files) {
                        $.each(input.files, function (index, file) {


                            var reader = new FileReader();
                            reader.onload = function (e) {

                                callback(false, e.target.result);
                            }
                            reader.readAsDataURL(file);
                        });

                    }
                    callback(true, false);
                }


                var arr_multiupload = $("span[data-multiupload]");


                if (arr_multiupload.length > 0) {
                    $.each(arr_multiupload, function (index, elem) {
                        var container_id = $(elem).attr("data-multiupload");


                        var id_multiupload_img = "multiupload_img_" + container_id + "_";
                        var id_multiupload_img_remove = "multiupload_img_remove" + container_id + "_";
                        var id_multiupload_file = id_multiupload_img + "_file";

                        var block_multiupload_src = "data-multiupload-src-" + container_id;
                        var block_multiupload_holder = "data-multiupload-holder-" + container_id;
                        var block_multiupload_fileinputs = "data-multiupload-fileinputs-" + container_id;


                        var input_src = $(elem).find("input[data-multiupload-src]");
                        $(input_src).removeAttr('data-multiupload-src')
                            .attr(block_multiupload_src, "");


                        var block_img_holder = $(elem).find("span[data-multiupload-holder]");
                        $(block_img_holder).removeAttr('data-multiupload-holder')
                            .attr(block_multiupload_holder, "");

                        var block_fileinputs = $(elem).find("span[data-multiupload-fileinputs]");
                        $(block_fileinputs).removeAttr('data-multiupload-fileinputs')
                            .attr(block_multiupload_fileinputs, "");

                        $(input_src).on('change', function (event) {

                            readMultiUploadURL(event.target, function (has_error, img_src) {
                                if (has_error == false) {
                                    addImgToMultiUpload(img_src);
                                }
                            })
                        });

                        function addImgToMultiUpload(img_src) {
                            var id = Math.random().toString(36).substring(2, 10);

                            var html = '<div class="upload-photo" id="' + id_multiupload_img + id + '">' +
                                '<span class="upload-close">' +
                                '<a href="javascript:void(0)" id="' + id_multiupload_img_remove + id + '" ><i class="fa fa-trash-o"></i></a>' +
                                '</span>' +
                                '<img src="' + img_src + '" >' +
                                '</div>';

                            var file_input = '<input type="file" name="file[]" id="' + id_multiupload_file + id + '" style="display:none" />';
                            $(block_img_holder).append(html);
                            $(block_fileinputs).append(file_input);

                            bindRemoveMultiUpload(id);
                        }

                        function bindRemoveMultiUpload(id) {
                            $("#" + id_multiupload_img_remove + id).on('click', function () {
                                $("#" + id_multiupload_img + id).remove();
                                $("#" + id_multiupload_file + id).remove();
                            });
                        }


                    });
                }
            })(jQuery);
</script>

@endsection