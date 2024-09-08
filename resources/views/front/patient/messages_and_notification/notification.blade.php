@extends('front.patient.layout._dashboard_master')
@section('main_content')

	<div class="header bookhead">
		<div class="backarrow "><a href="{{url('/')}}/patient/dashboard" class="center-align"><i class="material-icons">chevron_left</i></a></div>
		<h1 class="main-title center-align">Notifications</h1>
	</div>

	<!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

	<!-- <div class="container posrel has-header padtp minhtnor"> -->
		<ul class="collection brdrtopsd marbt">
			@if(isset($notification_arr['data']) && !empty($notification_arr['data']))
				@foreach($notification_arr['data'] as $val)
					<li class="collection-item">
						<div class="valign-wrapper quest">
							<span class="circle btn-floating red center-align large">{{isset($val['user_details']['first_name']) && !empty($val['user_details']['first_name']) ? substr( ucfirst($val['user_details']['first_name']), 0,1) : ''}}{{isset($val['user_details']['last_name']) && !empty($val['user_details']['last_name']) ? substr( ucfirst($val['user_details']['last_name']), 0,1) : ''}}</span>
							@php
								$url = '';							
								if($val['type'] == 'reschedule')
								{
									$url = url('').'/patient/booking/online_waiting_room/'.base64_encode($val['booking_id']);
								}
								elseif($val['type'] == 'booking_cancelled')
								{
									$url = url('').'/patient/booking/online_waiting_room/'.base64_encode($val['booking_id']);
								}
								elseif($val['type'] == 'consultation_pending')
								{
									$url = url('').'/patient/booking/online_waiting_room/'.base64_encode($val['booking_id']);
								}
								else
								{
									$url = '';
								}

							@endphp
							<a href="{{$url}}" class="">
								<p class="bluedoc-text"><strong>{{isset($val['user_details']['first_name']) ? $val['user_details']['first_name'] : ''}} {{isset($val['user_details']['last_name']) ? $val['user_details']['last_name'] : ''}}</strong> {{isset($val['message']) ? $val['message'] : '-'}}
								</p>
								@if(isset($val['booking_details']['consultation_id']) && $val['booking_details']['consultation_id'] !='0')
									<small class="bluedoc-text"><strong>Consultation ID: {{ $val['booking_details']['consultation_id']}}</strong></small>
								@endif
								<small class="bluedoc-text"><strong>{{isset($val['created_at']) ? date("D, F d, Y, h:i a", strtotime($val['created_at'])) : '-' }}</strong>
								</small>
							</a>
						</div>
					</li>
				@endforeach
			@else
				<h5 class="center-align">No Notification found</h5>
			@endif	
		</ul>
		<div class="paginaton-block-main">
            {{ $paginate }}
        </div>

        </div>
	</div>

@endsection