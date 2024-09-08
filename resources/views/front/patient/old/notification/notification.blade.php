@extends('front.patient.layout._after_patient_login_master')                    
@section('main_content')

	<div class="container-fluid fix-left-bar">
         <div class="row">
  			<div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="inner-head">{{ $page_title or 'Notifications' }}</div>
                       <div class="head-bor"></div>
                     </div>
                 </div>
                 	
	                <div class="table-responsive basic-table not-tble">
	                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
	                     @if(isset($arr_notification) && sizeof($arr_notification)>0)
	                        <tr class="table-head">
	                           <td>No. </td>
	                           <td>Date</td>
	                           <td>Notification From</td>
	                           <td>Message</td>
	                           <td style="text-align:center;">Action</td>
	                        </tr>
		                     @foreach($arr_notification as $key=>$notification)
		            
		                     	<?php $i =  $key + 1;  ?>
		                        <tr>
		                           <td>{{ $i or '' }}</td>
		                           <td>
		                           	@if(isset($notification['created_at']) && $notification['created_at']!='')
		                           		<?php 
		                           			$notification_date = date('d M Y, h:i a',strtotime($notification['created_at']));
		                           		?>
		                           	@endif
		                           	{{ $notification_date or '--' }}
		                           </td>
		                           <td>
		                           	{{ $notification['user_details']['title'] or '--' }}
		                           	{{ $notification['user_details']['first_name'] or '--' }}
		                           	{{ $notification['user_details']['last_name'] or '--' }}
		                           </td>
		                           <td>
		                           	@if(isset($notification['message']) && $notification['message']!='')
		                           		@if(strlen($notification['message'])>50)
		                           		  {{str_limit($notification['message'],50)}} 
		                           		@else
		                           		  {{ $notification['message'] or '--' }}
		                           		@endif
		                           	@else
		                           	{{ '--' }}
		                           	@endif
		                           		
		                           </td>
		                           <td style="text-align:center;">
		                           	
		                           	  <a href="{{ $module_url_path }}/details/{{ base64_encode($notification['id']) }}" class="del-icon">More</a>
		                           </td>
		                        </tr>
		                     @endforeach
		                    @else
		                    <tr>
		                    	<td>
		                    		<div class="search-grey-bx">
		                                <div class="row">
		                                      {{ 'No notifications are present.' }}
		                                </div>
		                            </div>      
		                    	</td>
		                    </tr>
	                    @endif
	                    </table>
	                </div>
	             
                  <br/>
               </div>
            </div>
               <div class="hidden-xs col-sm-2 col-md-2 col-lg-1">&nbsp;</div>
         </div>
     </div>

@endsection