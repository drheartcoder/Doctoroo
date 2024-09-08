@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/dashboard" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Messages</h1>
        <!-- <div class="fix-add-btn">
            <a href="javascript:void(0)"><span class="grey-text">New Message</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
            </a>
        </div> -->
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 posrel has-header has-footer minhtnor">

        <div class="container posrel futspace">
            <ul class="collection brdrtopsd messageslist">
                @if(isset($doctors_list) && !empty($doctors_list))
                    @foreach($doctors_list as $val)
                    
                        @php
                            $doctor_title = isset($val['doctor_user_details']['title']) ? $val['doctor_user_details']['title'] : '';
                            $doctor_first = isset($val['doctor_user_details']['first_name']) ? $val['doctor_user_details']['first_name'] : '';
                            $doctor_last  = isset($val['doctor_user_details']['last_name']) ? $val['doctor_user_details']['last_name'] : '';
                            $doctor_is_online = isset($val['doctor_user_details']['is_online']) ? $val['doctor_user_details']['is_online'] : '';

                            // check listisng image
                            if ( isset($val['doctor_user_details']['profile_image']) && !empty($val['doctor_user_details']['profile_image']) )
                            {
                                $profile_images = $doctor_public_img_path.$val['doctor_user_details']['profile_image'];
                                // check if image exists or not
                                if ( File::exists($profile_images) ) 
                                {
                                    $profile_images = $doctor_public_img_path."default-image.jpeg";
                                } // end if
                            } // end if
                            else
                            {
                                $profile_images = $doctor_public_img_path."default-image.jpeg";
                            } // end else

                        @endphp

                        <li class="collection-item avatar">
                            <a class="valign-wrapper" href="{{url('')}}/patient/chat/messages/{{base64_encode($val['doctor_user_id'])}}">
                                <div class="image-avtar left"><img src="{{ $profile_images }}" alt="" class="circle" />
                                @if($doctor_is_online == 1)
                                    <span class="onlinenew"></span>
                                @else
                                    <span class="online"></span>
                                @endif
                                </div>
                                <div class="doc-detail left">
                                    <span class="title "><!-- <img src="{{ url('/') }}/public/new/images/doctor-icon-small.svg" class="docicon" /> -->{{ $doctor_title.' '.$doctor_first.' '.$doctor_last }}</span>
                                    <p class="text-greyblue"></p>
                                </div>
                                <!-- <div class="doc-action right"> <span class="badge circle">1</span></div> -->

                                <div class="clearfix"></div>
                            </a>
                        </li>
                    @endforeach    
                @endif    
                
            </ul>
        </div>
    </div>

    <!-- Modal Reschedule -->
    <div id="resechdule" class="modal resechdule">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->
    
    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Structure End -->

@endsection