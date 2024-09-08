@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor doctor-patient-list-main">
        <input type="hidden" id="code_share_message" value="{{Session::get('message')}}">
        @php 
            if(!empty(Session::get('message')))
            {
            Session::forget('message');
            }
        @endphp 

        <div id="medical" class="tab-content medi patient-list-block doctor-patient-list-main">
            <div class="patient-list-heading">
                <span class="patient-list-title">
                    Search Result(s)
                </span>                
                <a href="{{$module_url_path}}/my_discount" class="add-new-patient-btn">
                    Back
                </a>
            </div>
            <div class="blue-border-block-top"></div>
            <div class="transactions-table table-responsive paitent-list-table">
                <!--div format starts here-->
                @if(isset($patients_arr['data']) && sizeof($patients_arr['data']) != '0')
                <div class="table ">
                    <div class="table-row heading hidden-xs">
                        <div class="table-cell">Patient's Name</div>                        
                        <div class="table-cell">Type</div>
                        <div class="table-cell">Date of birth</div>
                        <div class="table-cell">Gender</div>
                        <div class="table-cell center-align">Share</div>
                    </div>
                        @foreach($patients_arr['data'] as $val)
                            <div class="table-row content-row-table">
                                <div class="table-cell transaction-id">
                                    @php
                                        $src="";
                                        if(isset($val['patient_user_details']['profile_image']) && File::exists($patient_base_img_path.$val['patient_user_details']['profile_image']))
                                        {
                                           $src = $patient_public_img_path.$val['patient_user_details']['profile_image'];
                                        }
                                        else
                                        {
                                           $src = $patient_public_img_path.'default-image.jpeg';
                                        }  
                                    @endphp
                                    <span class="patient-profile-pic"><img src="{{$src}}" alt="" /> </span>
                                    <span class="patient-name-block">{{isset($val['userinfo']['first_name']) ? $val['userinfo']['first_name'] : ''}} {{isset($val['userinfo']['last_name']) ? $val['userinfo']['last_name'] : ''}}</span>
                                </div>                        
                                <div class="table-cell transaction-price">My Own</div>
                                <div class="table-cell transaction-date">
                                    {{isset($val['date_of_birth']) ? date('Y/m/d', strtotime($val['date_of_birth'])) : ''}}
                                </div>
                                <div class="table-cell transaction-desciption">
                                    <span class="description">
                                        @php
                                            if(isset($val['gender']))
                                            {
                                                if($val['gender']=='F')   
                                                {
                                                    echo "Female";
                                                }
                                                else
                                                {
                                                    echo "Male";
                                                }
                                            }
                                        @endphp
                                    </span>
                                </div>
                                <div class="table-cell transaction-status view-details-btn">
                                    <a href="#code_share_confirm_popup" data-id="{{ base64_encode($val['userinfo']['id']) }}" id="share_code_btn">Share Code</a>
                                        </div>
                            </div>            
                        @endforeach
                </div>
                @else
                    <h5 class="center-align">No Records found...</h5>
                @endif
                <div class="paginaton-block-main">
                    {{$paginate}}
                </div>
            </div>
            <div class="blue-border-block-bottom"></div>
        </div>        
    </div>

    <a href="#code_share_popup" id="code_share" style="display: none"></a>
    <div id="code_share_popup" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align" id="code_share_msg"></p>
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align ">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Ok</a>
        </div>     
    </div>

    <div id="code_share_confirm_popup" class="modal addperson">
         <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p class="center-align">Do you really want to share code?</p>
                    <input type="hidden" id="user_id">
                </div>             
            </div>         
        </div>         
        <div class="modal-footer center-align two-btn-block">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons right" id="confirm_share">Ok</a>
        </div>     
    </div>

    <script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>
    <script>
    $(document).ready(function(){
        var url="<?php echo $module_url_path; ?>";
        if($('#code_share_message').val() != '' && $('#code_share_message').val() != null)
        {
            $('#code_share_msg').html($('#code_share_message').val());
            $('#code_share').click();
        }

        $('#share_code_btn').click(function(){
            $('#user_id').val($(this).attr('data-id'))
        });

        $('#confirm_share').click(function(){
            var user_id=$('#user_id').val();
            window.location = url+'/share_code/'+user_id;
        });

    });

    </script>

@endsection