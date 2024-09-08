@extends('front.doctor.layout.new_master')
@section('main_content')
    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only">
            <a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a>
        </div>
        <h1 class="main-title center-align">Notifications</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300  has-header minhtnor">
        <div class="container-600px pdmintb">
            <div class="round-box z-depth-3 ">
               <div class="blue-border-block-top"></div>
                <div class="round-box-content blue-border">
                    <ul class="collection brdrtopsd">
                    @if(isset($notification_arr['data']) && !empty($notification_arr['data']))
                    @foreach($notification_arr['data'] as $notification)
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating red center-align large">{{isset($notification['user_details']['first_name']) && !empty($notification['user_details']['first_name']) ? substr( ucfirst($notification['user_details']['first_name']), 0,1) : ''}}{{isset($notification['user_details']['last_name']) && !empty($notification['user_details']['last_name']) ? substr( ucfirst($notification['user_details']['last_name']), 0,1) : ''}}</span>
                                <a href="javascript:void(0)" class="">
                                    
                                    <p class="bluedoc-text"><strong>{{isset($notification['user_details']['title']) ? $notification['user_details']['title'] : ''}} {{isset($notification['user_details']['first_name']) ? $notification['user_details']['first_name'] : ''}} {{isset($notification['user_details']['last_name']) ? $notification['user_details']['last_name'] : ''}}</strong> {{isset($notification['message']) ? $notification['message'] : '' }} </p>
                                    @if(isset($notification['booking_details']['consultation_id']) && $notification['booking_details']['consultation_id'] !='0')
                                    <small class="bluedoc-text"><strong>Consultation ID: {{ $notification['booking_details']['consultation_id']}}</strong></small>
                                @endif
                                    <small class="bluedoc-text">
                                    <strong>
                                    {{isset($notification['created_at']) && !empty($notification['created_at']) ? date("D, F d, Y, h:i a", strtotime($notification['created_at'])) : '-'}}
                                    </strong>
                                    </small>
                                </a>
                            </div>
                        </li>
                      @endforeach
                      @else
                        <h5 class="center-align">No Notification found</h5>
                      @endif
                    </ul>

                    @if($notification_arr['last_page'] != 1)
                    <div class="paginaton-block-main">
                        {{ $paginate }}
                    </div>
                    @endif
                </div>
                <div class="blue-border-block-bottom"></div>
            </div>

        </div>
    </div>
    <!--Container End-->
@endsection