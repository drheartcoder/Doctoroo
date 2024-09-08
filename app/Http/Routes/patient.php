<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('sendSms', ['as'=>'OTP TEST', 'uses' => 'Front\Patient\AuthController@sendSms']);
Route::any('patient/verify_otp', ['as'=>'patient/verify_otp', 'uses' => 'Front\Patient\AuthController@verify_otp']);




Route::any('patient/resend_otp', ['as'=>'patient/resend_otp', 'uses' => 'Front\Patient\AuthController@resend_otp']);

	Route::any('send_sms_otp', ['as'=>'OTP TEST', 'uses' => 'Front\Patient\AuthController@send_sms_otp']);

	Route::any('patient/booking/payment/stripe/makePayment',	  		['as'=>'patient/booking/payment/stripe/makePayment','uses'=>'Front\Patient\PaymentController@stripe_make_payment']);

	Route::any('patient/booking/payment/stripe/stripePayment',	  		['as'=>'patient/booking/payment/stripe/stripePayment','uses'=>'Front\Patient\PaymentController@stripePayment']);

	Route::any('patient/booking/payment/stripe/buy_credits',	  		['as'=>'patient/booking/payment/stripe/buycredits','uses'=>'Front\Patient\PaymentController@buy_credits']);

	Route::any('patient/booking/payment/stripe/confirm_payment',	  		['as'=>'patient/booking/payment/stripe/confirm_payment','uses'=>'Front\Patient\PaymentController@confirm_payment']);

	
	/*--------------------  Payment methods start  -------------------------*/
		Route::group(['prefix'=>'patient/setting/card', 'middleware' =>['auth_patient', 'front_general']],function()
		{
			$route_slug        = "card_";
			$module_controller = "Front\Patient\CardController@";

			Route::any('/list',						['as'=>$route_slug.'list','uses'=>$module_controller.'listing']);
			Route::any('/store',					['as'=>$route_slug.'store','uses'=>$module_controller.'store']);
			Route::any('/delete',					['as'=>$route_slug.'delete','uses'=>$module_controller.'delete']);
		});
	/*--------------------  Payment methods end  -------------------------*/


	Route::group(['prefix'=>'patient', 'middleware' =>'front_general'],function()
	{

		$route_slug        = "patient_";
		$module_controller = "Front\Patient\AuthController@";

		Route::any('/duplicate/email',	                ['as'=>$route_slug.'duplicate','uses'=>$module_controller.'duplicate']);
		Route::any('/duplicate/mobile_no',	      		['as'=>$route_slug.'duplicate_mobile_no_check','uses'=>$module_controller.'duplicate_mobile_no_check']);
		Route::post('/check_code/friends_code',	        ['as'=>$route_slug.'check_code','uses'=>$module_controller.'check_code']);
		Route::post('/signup/store',	                ['as'=>$route_slug.'signup_store','uses'=>$module_controller.'store_signup']);
		Route::post('/signup-voucher/store',	        ['as'=>$route_slug.'signup_voucher','uses'=>$module_controller.'store_signup_voucher']);
		Route::get('/error',			                ['as'=>$route_slug.'error','uses'=>$module_controller.'error']);
		Route::get('/verify/{enc_id}/{activation_code}',['as'=>$route_slug.'verify','uses'=>$module_controller.'verify']);
		Route::any('/signin_check',	                    ['as'=>$route_slug.'signin','uses'=>$module_controller.'signin_check']);
		Route::get('/resend-verification-email/{enc_id}',['as'=>$route_slug.'resend_verification_email','uses'=>$module_controller.'resend_verification_email']);
		/*routes for deleting an account */
		Route::get('/delete',			                ['as'=>$route_slug.'delete','uses'=>$module_controller.'delete_account']);

		/*notification route */
        Route::get('/notification',	['as'=>'notification','uses'=>'Front\Patient\NotificationController@show_notification']);

        Route::get('/notification/details/{enc_id}',	['as'=>'notification','uses'=>'Front\Patient\NotificationController@show_notification_details']);


        
        /* change mobile number */
        Route::any('/change_mobile_no/store',	        ['as'=>$route_slug.'signup_voucher', 	'uses'=>$module_controller.'store_change_mobile_no']);
        Route::any('/verify_cpnotp', ['as'=>'verify_cpnotp', 'uses' => 'Front\Patient\AuthController@verify_cpnotp']);
        Route::any('/resend_cpnotp', ['as'=>'resend_cpnotp', 'uses' => 'Front\Patient\AuthController@resend_cpnotp']);
        /* endchange mobile number */
		
		/*======================================Patient Profile=============================================================================*/

		Route::get('/thankyou',			               ['as'=>$route_slug.'thankyou',		'uses'=>$module_controller.'thankyou']);
		Route::get('/thankyou/forgetpassword',         ['as'=>$route_slug.'thankyou_forget','uses'=>$module_controller.'thankyoumail']);
		Route::get('/back',			                   ['as'=>$route_slug.'back',			'uses'=>$module_controller.'back']);
		Route::get('/verify/{enc_id}/{activation_code}',['as'=>$route_slug.'verify',	    'uses'=>$module_controller.'verify']);
		Route::post('/signin_check',	                ['as'=>$route_slug.'signin',		'uses'=>$module_controller.'signin_check']);
		

		Route::group(['middleware' =>'auth_patient'],function()
	    {
			
			$route_slug        = "patient_profile_";
			$module_controller = "Front\Patient\ProfileController@";

			Route::get('/profile',	     			['as'=>$route_slug."profile",		   'uses'=>$module_controller.'index']);
			Route::post('/store_profile',			['as'=>$route_slug.'store_profile',	   'uses'=>$module_controller.'store_profile']);
			Route::get('/search_pharmacy',			['as'=>$route_slug.'search_pharmacy',  'uses'=>$module_controller.'search_pharmacy']);
			Route::get('/search_pharmacy_by_suburb',['as'=>$route_slug.'search_pharmacy_by_suburb',  'uses'=>$module_controller.'search_pharmacy_by_suburb']);
			Route::get('/profileimage',			    ['as'=>$route_slug.'profile_image',	   'uses'=>$module_controller.'profile_image']);
			Route::post('/upload_profile',			['as'=>$route_slug.'upload_profile',   'uses'=>$module_controller.'upload_profile']);
			Route::get('/location_listing',         ['as'=>$route_slug.'location_listing', 'uses'=> $module_controller.'location_listing']);

			Route::get('/change_password',	    ['as'=>$route_slug.'change_password', 'uses'=>$module_controller.'change_password']);
			Route::post('/update_password',	    ['as'=>$route_slug.'update_password', 'uses'=>$module_controller.'update_password']);


			Route::get('/profile/fast',			['as'=>$route_slug.'profile_fast', 	'uses'=>$module_controller.'fast_profile']);
			Route::post('/profile/store_fast_profile',	['as'=>$route_slug.'store_route_slug', 'uses'=>$module_controller.'store_fast_profile']);

		});

		
		/*------------------------------------------ New Patient Start ------------------------------------------*/

		/*------------------------------------------ New Patient Dashboard Start ------------------------------------------*/
		
		Route::group(['middleware' =>'auth_patient'],function()
	    {
			$route_slug        = "patient_profile_";
			$module_controller = "Front\Patient\DashboardController@";
            
			Route::any('/continue_session',	     						['as'=>$route_slug."continue_session", 'uses'=>$module_controller.'continue_session']);

			Route::any('/dashboard',	     							['as'=>$route_slug."dashboard", 'uses'=>$module_controller.'dashboard']);
			Route::any('/new_device_used', 								['as'=>$route_slug.'new_device_used', 'uses'=>'Front\Doctor\DashboardController@new_device_used']);

			Route::any('/consultation_request_with_ajax',		    ['as'=>$route_slug.'consultation_request_with_ajax',     'uses'=>$module_controller.'consultation_request_with_ajax']);

			Route::any('/new_consultations_request/details/{enc_id}',	['as'=>$route_slug."new_consultations_request/details",'uses'=>$module_controller.'new_consultation_request_details']);
			Route::any('/new_consultations/search_doctor_name',	     	['as'=>$route_slug."new_consultations/search_doctor_name",'uses'=>$module_controller.'search_doctor_new_consultation']);
			Route::any('/new_consultations/search_new_consultation',	['as'=>$route_slug."search_doctor_name",'uses'=>$module_controller.'search_new_consultation']);

			Route::any('/upcoming_consultations',	    				['as'=>$route_slug."upcoming_consultations",'uses'=>$module_controller.'upcoming_consultations']);
			Route::any('/upcoming_consultation/details/{enc_id}',	    ['as'=>$route_slug."upcoming_consultation/details",'uses'=>$module_controller.'upcoming_consultation_details']);
			Route::any('/upcoming_consultation/search_doctor_name',	    ['as'=>$route_slug."upcoming_consultation/search",'uses'=>$module_controller.'search_doctor_upcoming_consultation']);
			Route::any('/upcoming_consultation/search',	     			['as'=>$route_slug."upcoming_consultation/search",'uses'=>$module_controller.'search_upcoming_consultation']);
			Route::any('/upcoming_consultation/invoice/{enc_id}',	    ['as'=>$route_slug."upcoming_consultation/invoice",'uses'=>$module_controller.'upcoming_consultation_invoice']);
			Route::any('/upcoming_consultation/invoice/download/{enc_id}',['as'=>$route_slug."upcoming_consultation/invoice/donwload/invoice",'uses'=>$module_controller.'upcoming_consultation_invoice_download']);
			Route::any('/generate_upcoming_consultation_invoice_pdf',	    ['as'=>$route_slug."generate_upcoming_consultation_invoice_pdf",'uses'=>$module_controller.'generate_upcoming_consultation_invoice_pdf']);
			
			Route::any('/upcoming_consultation/update_booking_time',['as'=>$route_slug."update_booking_time",'uses'=>$module_controller.'update_booking_time']);
			Route::any('/upcoming_consultation/update_booking_call_status',['as'=>$route_slug."update_booking_call_status",'uses'=>$module_controller.'update_booking_call_status']);
			Route::any('/upcoming_consultation/start_video_call',		['as'=>$route_slug.'start_video_call', 'uses'=>$module_controller.'start_video_call']);
			Route::any('/upcoming_consultation/check_doctor_active_video_call',	['as'=>$route_slug.'check_doctor_active_video_call', 'uses'=>$module_controller.'check_doctor_active_video_call']);

			Route::any('/past_consultations',	     					['as'=>$route_slug."past_consultations",'uses'=>$module_controller.'past_consultations']);
			Route::any('/past_consultation/details/{enc_id}',	    	['as'=>$route_slug."past_consultation/details",'uses'=>$module_controller.'past_consultation_details']);
			Route::any('/past_consultation/invoice/{enc_id}',	    	['as'=>$route_slug."past_consultation_invoice/invoice",'uses'=>$module_controller.'past_consultation_invoice']);
			Route::any('/generate_invoice_pdf',	     					['as'=>$route_slug."generate_invoice_pdf",'uses'=>$module_controller.'generate_invoice_pdf']);
			
			Route::any('/past_consultation/invoice/download/{enc_id}',	['as'=>$route_slug."past_consultation/invoice/donwload/invoice",'uses'=>$module_controller.'past_consultation_invoice_download']);
			Route::any('/past_consultations/search_doctor_name',	    ['as'=>$route_slug."past_consultations/search_doctor_name",'uses'=>$module_controller.'search_doctor_name']);
			Route::any('/past_consultations/search_past_consultation',	['as'=>$route_slug."search_past_consultation",'uses'=>$module_controller.'search_past_consultation']);

			Route::any('/declined_consultations',	     				['as'=>$route_slug."declined_consultations",'uses'=>$module_controller.'declined_consultations']);
			Route::any('/declined_consultation/details/{enc_id}',	    ['as'=>$route_slug."declined_consultation/details",'uses'=>$module_controller.'declined_consultation_details']);
			Route::any('/declined_consultation/search_doctor_name',	    ['as'=>$route_slug."declined_consultation/search_doctor_name",'uses'=>$module_controller.'search_doctor_declined_consultation']);
			Route::any('/declined_consultation/search_declined_consultation', ['as'=>$route_slug."declined_consultation/search_declined_consultation",'uses'=>$module_controller.'search_declined_consultation']);
			
			Route::any('/my_doctors',	     							['as'=>$route_slug."my_doctors",'uses'=>$module_controller.'my_doctors']);
			Route::any('/my_doctors/search_doctor_name',	     		['as'=>$route_slug."my_doctors/search_doctor_name",'uses'=>$module_controller.'my_doctors_search_name']);
			Route::any('/my_doctors/search',	     					['as'=>$route_slug."my_doctors/search",'uses'=>$module_controller.'my_doctors_search']);

			Route::any('/upcoming_search',	     						['as'=>$route_slug."upcoming_search",'uses'=>$module_controller.'upcoming_search']);
			Route::any('/get_upcoming_search',	     					['as'=>$route_slug."get_upcoming_search",'uses'=>$module_controller.'get_upcoming_search']);
			Route::any('/past_search',	     							['as'=>$route_slug."past_search",'uses'=>$module_controller.'past_search']);
			Route::any('/get_past_search',	     						['as'=>$route_slug."get_past_search",'uses'=>$module_controller.'get_past_search']);
			Route::any('/doctor_search',	     						['as'=>$route_slug."doctor_search",'uses'=>$module_controller.'doctor_search']);
			Route::any('/get_doctor_search',	     					['as'=>$route_slug."get_doctor_search",'uses'=>$module_controller.'get_doctor_search']);
		});

		/*------------------------------------------ New Patient Dashboard End ------------------------------------------*/




		/*------------------------------------------ Doctor Booking Start ------------------------------------------*/


		Route::group(['prefix'=>'booking','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "patient_booking_";
			$module_controller = "Front\Patient\BookingController@";

			/*------------------------------------------ Payment Start ------------------------------------------*/
				

			Route::group(['prefix'=>'payment','middleware' =>'auth_patient'],function()
			{
				$route_slug        = "payment_gateway_";
				$module_controller = "Front\Patient\PaymentController@";

				Route::any('/',	  							['as'=>$route_slug."request_booking",'uses'=>$module_controller.'request_booking']);

				/*Route::any('/checkout',	  					['as'=>$route_slug,'uses'=>$module_controller.'checkout']);*/
				Route::any('/initiate/stripe/',	  			['as'=>$route_slug."stripe_payment",'uses'=>$module_controller.'stripe_payment']);
				Route::any('/stripe/proceed/',	  			['as'=>$route_slug."stripe_proceed",'uses'=>$module_controller.'stripe_proceed']);
				/*Route::any('/stripe/makePayment/',			['as'=>$route_slug,'uses'=>$module_controller.'stripe_make_payment']);*/

				Route::any('/success/',	  					['as'=>$route_slug."success",'uses'=>$module_controller.'payment_success']);
				Route::any('/approve/',	  					['as'=>$route_slug."approve",'uses'=>$module_controller.'payment_approve']);
				Route::any('/cancel/',	  					['as'=>$route_slug."cancel",'uses'=>$module_controller.'payment_cancel']);
				Route::any('/error/',	  					['as'=>$route_slug."error",'uses'=>$module_controller.'payment_error']);
				
			});

			/*------------------------------------------ Payment End ------------------------------------------------*/

			Route::get('/',	  							['as'=>$route_slug."book_a_doctor",'uses'=>$module_controller.'book_a_doctor']);
			Route::get('/select_doctor/{enc_id}',	  	['as'=>$route_slug."select_doctor_for_booking",'uses'=>$module_controller.'select_doctor_for_booking']);
			Route::any('/show_available_doctors',		['as'=>$route_slug."show_available_doctors",'uses'=>$module_controller.'show_available_doctors']);
			Route::any('/show_available_doctors/{day}',	['as'=>$route_slug."show_available_doctors/today",'uses'=>$module_controller.'show_available_doctors_all_records']);
			Route::get('/search_available_doctors',		['as'=>$route_slug."search_available_doctors",'uses'=>$module_controller.'search_available_doctors']);
			Route::any('/available_doctor/{enc_id}/{enc_date}',	['as'=>$route_slug."available_doctor",'uses'=>$module_controller.'available_doctor']);

            Route::any('/get_fess',                 	['as'=>$route_slug."get_fess",'uses'=>$module_controller.'get_fess']);

			Route::any('/profile_about/{enc_id}/{enc_date}',	['as'=>$route_slug."profile_about",'uses'=>$module_controller.'profile_about']);
			Route::any('/review_booking',	  			['as'=>$route_slug."review_booking",'uses'=>$module_controller.'review_booking']);
			Route::any('/get_doctor_available_time',	['as'=>$route_slug."get_doctor_available_time",'uses'=>$module_controller.'get_doctor_available_time']);
			Route::any('/pricing_details',				['as'=>$route_slug."pricing_details",'uses'=>$module_controller.'pricing_details']);

			Route::any('/booking_request_confirmation',	['as'=>$route_slug."booking_request_confirmation",'uses'=>$module_controller.'booking_request_confirmation']);
			Route::any('/booking_request_confirmation/{enc_id}',['as'=>$route_slug."booking_request_confirmation",'uses'=>$module_controller.'booking_request_confirmation']);
			Route::any('/cancellation_refunds',			['as'=>$route_slug."cancellation_refunds",'uses'=>$module_controller.'cancellation_refunds']);
			Route::any('/emergencies_warning',			['as'=>$route_slug."emergencies_warning",'uses'=>$module_controller.'emergencies_warning']);
			Route::any('/online_waiting_room',			['as'=>$route_slug."online_waiting_room",'uses'=>$module_controller.'online_waiting_room']);
			Route::any('/online_waiting_room/{enc_id}',	['as'=>$route_slug."online_waiting_room",'uses'=>$module_controller.'online_waiting_room']);
			Route::any('/difference_bet_time/{startdate}/{enddate}',	['as'=>$route_slug."difference_bet_time",'uses'=>$module_controller.'difference_bet_time']);
			Route::any('/stripe_payment',				['as'=>$route_slug."stripe_payment",'uses'=>$module_controller.'stripe_payment']);
			Route::any('/confirm_booking',				['as'=>$route_slug."confirm_booking",'uses'=>$module_controller.'confirm_booking']);
			Route::any('/confirm_booking/{enc_id}', 	['as'=>$route_slug."confirm_booking",'uses'=>$module_controller.'confirm_booking']);
			Route::any('/consultation_details',			['as'=>$route_slug."consultation_details",'uses'=>$module_controller.'consultation_details']);
			Route::any('/consultation_details/{enc_id}',['as'=>$route_slug."consultation_details",'uses'=>$module_controller.'consultation_details']);
			Route::any('/search_doctor_name',			['as'=>$route_slug."search_doctor_name",'uses'=>$module_controller.'search_doctor_name']);
			Route::any('/store_booking',				['as'=>$route_slug."store_booking",'uses'=>$module_controller.'store_booking']);

			Route::any('/cancel_consultation',			['as'=>$route_slug."cancel_consultation",'uses'=>$module_controller.'cancel_consultation']);
			Route::any('/reschedule_consultation',		['as'=>$route_slug."reschedule_consultation",'uses'=>$module_controller.'reschedule_consultation']);
			Route::any('/cancel_consultation/{enc_id}',	['as'=>$route_slug."cancel_consultation",'uses'=>$module_controller.'cancel_consultation']);
			

			Route::any('/reschedule_consultation/{enc_id}',			['as'=>$route_slug."reschedule_consultation",'uses'=>$module_controller.'reschedule_consultation']);
			Route::any('/reschedule/profile_about/{enc_id}/{enc_doctor_id}',	['as'=>$route_slug."profile_about",'uses'=>$module_controller.'reschedule_profile_about']);
			Route::any('/reschedule_update_consultation/{enc_id}',	['as'=>$route_slug."reschedule_update_consultation",'uses'=>$module_controller.'reschedule_update_consultation']);
			
			Route::any('/reschedule_within_1hr_consultation/{enc_id}', ['as'=>$route_slug."reschedule_within_1hr_consultation",'uses'=>$module_controller.'reschedule_within_1hr_consultation']);

			/*Route::any('/rebooking_for_reschedule/{id}',			['as'=>$route_slug."rebooking_for_reschedule",'uses'=>$module_controller.'rebooking_for_reschedule']);*/
		});

		/*------------------------------------------ Doctor Booking End ------------------------------------------------*/


		/*------------------------------------------ video chat starts here ------------------------------------------*/
		Route::group(['prefix'=>'video','middleware' =>'auth_patient'],function()
	    {
            $route_slug        = "video";
            $module_controller = "Front\Patient\VideoChatController@";

            Route::get('/{enc_id}',						['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);
            Route::any('status',	['as'=>$route_slug.'update_video_call_status', 'uses'=> $module_controller.'update_video_call_status']);
            Route::get('connect_video/{enc_id}',		['as'=>$route_slug.'connect_video', 'uses'=> $module_controller.'connect_video']);
            Route::any('check_doctor_active',			['as'=>$route_slug.'check_doctor_active', 'uses'=> $module_controller.'check_doctor_active']);

            Route::any('update_video_call_end_status',		['as'=>$route_slug.'update_video_call_end_status', 'uses'=> $module_controller.'update_video_call_end_status']);
            Route::any('update_video_call_reject_status',	['as'=>$route_slug.'update_video_call_reject_status', 'uses'=> $module_controller.'update_video_call_reject_status']);

            Route::any('update_video_call_time',			['as'=>$route_slug.'update_video_call_time', 'uses'=> $module_controller.'update_video_call_time']);
            

            
	    });
	    /*------------------------------------------ video chat ends here ------------------------------------------*/


		/*------------------------------------------ My Health Start ------------------------------------------------*/

		Route::group(['prefix'=>'my_health','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "my_health_";
			$module_controller = "Front\Patient\MyHealthController@";

			Route::any('/medical_history',			['as'=>$route_slug."medical_history",'uses'=>$module_controller.'medical_history']);
			Route::any('/doctor_Activity',      	['as'=>$route_slug."doctor_Activity",'uses'=>$module_controller.'doctor_activity']);

			Route::any('/documents/consultation',	['as'=>$route_slug."documents_consultation",'uses'=>$module_controller.'documents_consultation']);
			Route::any('/documents/prescription',	['as'=>$route_slug."documents_prescription",'uses'=>$module_controller.'documents_prescription']);
			Route::any('/documents/medical_certificate',	['as'=>$route_slug."documents_medical_certificate",'uses'=>$module_controller.'documents_medical_certificate']);
			Route::any('/documents/medical_certificate/download/{end_id}',	['as'=>$route_slug."download_medical_certificate",'uses'=>$module_controller.'download_medical_certificate']);
			Route::any('/documents/generate_medical_certificate_pdf',	['as'=>$route_slug."generate_medical_certificate_pdf",'uses'=>$module_controller.'generate_medical_certificate_pdf']);

			Route::any('/general',					['as'=>$route_slug."general",'uses'=>$module_controller.'general']);
			Route::any('/medical_history/{id}',		['as'=>$route_slug."medical_history",'uses'=>$module_controller.'medical_history_page']);
			Route::any('/general_store',			['as'=>$route_slug."general_store",'uses'=>$module_controller.'general_store']);
			Route::any('/condition_store',			['as'=>$route_slug."condition_store",'uses'=>$module_controller.'condition_store']);
			Route::any('/lifestyle_store',			['as'=>$route_slug."lifestyle_store",'uses'=>$module_controller.'lifestyle_store']);
			Route::any('/medication',				['as'=>$route_slug."medication",'uses'=>$module_controller.'medication']);
			Route::any('/medication_store',				['as'=>$route_slug."medication_store",'uses'=>$module_controller.'medication_store']);
			Route::any('/medication_deatails_add',	['as'=>$route_slug."medication_deatails_add",'uses'=>$module_controller.'medication_deatails_add']);
			Route::any('/medication_deatails_delete',	['as'=>$route_slug."medication_deatails_delete",'uses'=>$module_controller.'medication_deatails_delete']);
			Route::any('/lifestyle',				['as'=>$route_slug."lifestyle",'uses'=>$module_controller.'lifestyle']);
			Route::any('/add_medication',   ['as'=>$route_slug.'add_medication',   'uses'=>$module_controller.'add_medication']);

			Route::any('/add_new_general_condition',	['as'=>$route_slug."add_new_general_condition",'uses'=>$module_controller.'add_new_general_condition']);
			Route::any('/medical_general/delete',	['as'=>$route_slug."medical_general/delete",'uses'=>$module_controller.'medical_general_delete']);

			Route::any('/upload_patient_prescription',   ['as'=>$route_slug.'upload_patient_prescription',   'uses'=>$module_controller.'upload_patient_prescription']);
			Route::any('/prescription/store',				['as'=>$route_slug."prescription_store",'uses'=>$module_controller.'prescription_store']);
			Route::any('/prescription/delete',				['as'=>$route_slug."prescription_store",'uses'=>$module_controller.'prescription_delete']);
			Route::any('/prescription/update',				['as'=>$route_slug."prescription_update",'uses'=>$module_controller.'prescription_update']);
			Route::any('/prescription/{enc_id}',				['as'=>$route_slug."prescription",'uses'=>$module_controller.'prescription']);
			
		});

		/*------------------------------------------ My Health End --------------------------------------------------*/
		

		/*------------------------------------------ Messages and Notification Start ------------------------------------------------*/

		Route::group(['prefix'=>'messages_and_notification','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "messgaes_and_notification_";
			$module_controller = "Front\Patient\NotificationController@";
			
			//Route::any('/messages_list',	['as'=>$route_slug."messages_list",'uses'=>$module_controller.'messages_list']);
			Route::get('/notification',		['as'=>$route_slug."notification",'uses'=>$module_controller.'notification']);
		});

		Route::group(['prefix'=>'chat','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "chat";
			$module_controller = "Front\Patient\ChatController@";
			
			Route::get('/',						['as'=>$route_slug."index",'uses'=>$module_controller.'index']);

			Route::get('/messages_list',		['as'=>$route_slug."messages_list",'uses'=>$module_controller.'messages_list']);
			Route::get('/my_messages/{enc_id}',	['as'=>$route_slug."my_messages",'uses'=>$module_controller.'my_messages']);
			Route::get('/messages/{enc_id}',	['as'=>$route_slug."create_channel",'uses'=>$module_controller.'create_channel']);
			Route::post('/send_message/',		['as'=>$route_slug.'send_message', 'uses'=> $module_controller.'send_message']);
			Route::any('/get_messages',		    ['as'=>$route_slug.'get_messages', 'uses'=> $module_controller.'get_messages']);
			Route::any('/virgil/store',			['as'=>$route_slug.'virgil', 'uses'=> $module_controller.'virgil']);
			
		});

		/*------------------------------------------ Messages and Notification End --------------------------------------------------*/



		/*----------------------------------------New Patient Setting start --------------------------------------------*/

			Route::group(['prefix'=>'setting','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "patient_setting";
			$module_controller = "Front\Patient\SettingController@";

			Route::get('/',	                          ['as'=>$route_slug."settings",'uses'=>$module_controller.'settings']);

		/*--------------------------------New Patient Personal details start -------------------------------------------*/

		
			Route::get('/personal_details',	          ['as'=>$route_slug."personal_details",'uses'=>$module_controller.'personal_details']);
			Route::get('/edit_personal_details',	  ['as'=>$route_slug."edit_personal_details",'uses'=>$module_controller.'edit_personal_details']);
			Route::post('/store',	                  ['as'=>$route_slug."store",'uses'=>$module_controller.'store']);
			Route::any('/entitlement/get_details',	  ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'get_entitlement_details']);		
			Route::any('/entitlement/store',	      ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'store_entitlement_details']);		
			Route::any('/entitlement/store',	      ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'store_entitlement_details']);		
			Route::any('/entitlement/delete',	      ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'delete_entitlement_details']);		


		
		/*---------------------------------New Patient Setting Personal details  End ---------------------------------*/

		/*--------------------------------New Patient Family Members start -------------------------------------------*/

			Route::any('/family_members',	          		['as'=>$route_slug."family_members",'uses'=>$module_controller.'family_members']);
			Route::any('/family_members/add',	      		['as'=>$route_slug."family_members_add",'uses'=>$module_controller.'family_members_add']);
			Route::any('/family_members/view',	      		['as'=>$route_slug."family_members_view",'uses'=>$module_controller.'family_members_view']);
			Route::any('/family_members/edit',	      		['as'=>$route_slug."family_members_edit",'uses'=>$module_controller.'family_members_edit']);
			Route::any('/family_members/delete',	  		['as'=>$route_slug."family_members_delete",'uses'=>$module_controller.'family_members_delete']);
			Route::any('/family_members/unlink/{id}', 		['as'=>$route_slug."family_members_unlink",'uses'=>$module_controller.'family_members_unlink']);
			Route::any('/family_members/member_unlink_mail',['as'=>$route_slug."family_members_unlink_mail",'uses'=>$module_controller.'family_members_unlink_mail']);
			Route::any('/member_unlink_confirmation/{member_id}/{mail}',      ['as'=>$route_slug."member_unlink_confirmation",'uses'=>$module_controller.'member_unlink_confirmation']);
			Route::any('/member_set_password/{member_id}',  ['as'=>$route_slug."member_set_password",'uses'=>$module_controller.'member_set_password']);
			Route::any('/family_members/password_set',      ['as'=>$route_slug."password_set",'uses'=>$module_controller.'password_set']);


		/*--------------------------------New Patient Family Members End -------------------------------------------*/

		/*--------------------------------New Patient Family Doctor start -------------------------------------------*/

			Route::any('/family_doctors',				['as'=>$route_slug.'family_doctors','uses'=>$module_controller.'family_doctors']);
			Route::any('/family_doctors/add',			['as'=>$route_slug.'family_doctors_add','uses'=>$module_controller.'family_doctors_add']);
			Route::any('/family_doctors/add_data',		['as'=>$route_slug.'add_doctor','uses'=>$module_controller.'add_doctor']);
			Route::any('/family_doctors/edit/{enc_id}',	['as'=>$route_slug.'edit_doctor','uses'=>$module_controller.'edit_doctor']);
			Route::any('/family_doctors/edit_data',		['as'=>$route_slug.'family_doctors_edit_data','uses'=>$module_controller.'edit_doctor_data']);
			Route::any('/family_doctors/view/{enc_id}',	['as'=>$route_slug.'family_doctors_view','uses'=>$module_controller.'family_doctors_view']);
			Route::any('/family_doctors/delete_unlink',	['as'=>$route_slug.'family_doctor_delete_unlink','uses'=>$module_controller.'family_doctor_delete_unlink']);
		/*--------------------------------New Patient Family Doctor end -------------------------------------------*/

		/*--------------------------------New Patient email & password start -------------------------------------------*/		

			Route::any('/email_and_password',		['as'=>$route_slug.'email_and_password','uses'=>$module_controller.'email_and_password']);
			Route::any('/password_reset',			['as'=>$route_slug.'password_reset','uses'=>$module_controller.'password_reset']);
			Route::any('/password_reset_data',		['as'=>$route_slug.'password_reset_data','uses'=>$module_controller.'password_reset_data']);

		/*--------------------------------New Patient email & password end -------------------------------------------*/

		/*--------------------------------  My Pharamacy & Preferences Start -----------------------------------------*/

			Route::any('/my_pharmacy',					['as'=>$route_slug.'my_pharmacy','uses'=>$module_controller.'my_pharmacy']);
			Route::any('/delete_my_pharmacy/{enc_id}',	['as'=>$route_slug.'delete_my_pharmacy','uses'=>$module_controller.'delete_my_pharmacy']);
			Route::any('/delete_my_pharmacy',			['as'=>$route_slug.'delete_my_pharmacy','uses'=>$module_controller.'delete_my_pharmacy']);
			Route::any('/add_pharmacy',					['as'=>$route_slug.'add_pharmacy','uses'=>$module_controller.'add_pharmacy']);
			Route::any('/search_pharmacy',				['as'=>$route_slug.'search_pharmacy','uses'=>$module_controller.'search_pharmacy']);
			Route::any('/add_pharmacy_data',			['as'=>$route_slug.'add_pharmacy_data','uses'=>$module_controller.'add_pharmacy_data']);
			Route::any('/invite_pharmacy',				['as'=>$route_slug.'invite_pharmacy','uses'=>$module_controller.'invite_pharmacy']);
			Route::any('/invite_pharmacy_data',			['as'=>$route_slug.'invite_pharmacy_data','uses'=>$module_controller.'invite_pharmacy_data']);
			Route::any('/preference_store',			['as'=>$route_slug.'preference_store','uses'=>$module_controller.'preference_store']);

		/*--------------------------------  My Pharamacy & Preferences End -------------------------------------------*/

		/*--------------------------------  BILLING & PAYMENTS START -----------------------------------------*/

			/*--------------------  Invitation credit & codes start-------------------------*/

		Route::any('/invitation',			['as'=>$route_slug.'invitation','uses'=>$module_controller.'invitation']);
		Route::any('/invite_doctor',		['as'=>$route_slug.'invite_doctor','uses'=>$module_controller.'invite_doctor']);

			/*--------------------  Invitation credit & codes end-------------------------*/

			/*--------------------  Payment methods start-------------------------*/

		Route::any('/payment_method_settings',		['as'=>$route_slug.'payment_method_settings','uses'=>$module_controller.'payment_method_settings']);
		Route::any('/payment_method',				['as'=>$route_slug.'payment_method','uses'=>$module_controller.'payment_method']);	
		Route::any('/payment_method_details',		['as'=>$route_slug.'payment_method_details','uses'=>$module_controller.'payment_method_details']);	
		Route::any('/payment_method_edit',			['as'=>$route_slug.'payment_method_edit','uses'=>$module_controller.'payment_method_edit']);
		Route::any('/payment_method_remove',		['as'=>$route_slug.'payment_method_remove','uses'=>$module_controller.'payment_method_remove']);	
		

			/*--------------------  Payment methods end-------------------------*/		


			/*--------------------  Camera & Internet Pre-call Test start-------------------------*/		

			Route::any('/camera_and_internet_test',	['as'=>$route_slug.'camera_and_internet_test','uses'=>$module_controller.'camera_and_internet_test']);

			/*--------------------  Camera & Internet Pre-call Test end-------------------------*/		


			/*--------------------  Invoices & codes start-------------------------*/
			Route::any('/invoice',		['as'=>$route_slug.'invoice','uses'=>$module_controller.'invoice']);	

			/*--------------------  Invoices & codes end-------------------------*/

			/*--------------------  Disputes start-------------------------*/
			Route::any('/disputes',				['as'=>$route_slug.'disputes', 'uses'=>$module_controller.'disputes']);
			Route::any('/disputes/open',		['as'=>$route_slug.'disputes_open', 'uses'=>$module_controller.'disputes_open']);
			Route::any('/disputes/closed',		['as'=>$route_slug.'disputes_closed', 'uses'=>$module_controller.'disputes_closed']);

			Route::any('/disputes/store',		['as'=>$route_slug.'disputes_store',	'uses'=>$module_controller.'disputes_store']);
			Route::any('/disputes/view',		['as'=>$route_slug.'disputes_view',		'uses'=>$module_controller.'disputes_view']);
			Route::any('/disputes/status',		['as'=>$route_slug.'disputes_status',	'uses'=>$module_controller.'disputes_status']);
			Route::any('/disputes/against_user',['as'=>$route_slug.'against_user',	'uses'=>$module_controller.'dispute_against_user']);
			Route::any('/disputes/comments',	['as'=>$route_slug.'comments',	'uses'=>$module_controller.'dispute_comments']);
			Route::any('/disputes/comments/send',['as'=>$route_slug.'comments_send',	'uses'=>$module_controller.'dispute_comments_store']);

			/*--------------------  Disputes end-------------------------*/	

		/*--------------------------------  BILLING & PAYMENTS END -----------------------------------------*/

		/*--------------------------------  HELP & SUPPORT STARTS -----------------------------------------*/

					/*---------------------  faq start ---------------------------*/


		Route::any('/faq',						['as'=>$route_slug.'faq','uses'=>$module_controller.'faq_categories']);
		Route::any('/faqs/{id}/{faq_id?}',		['as'=>$route_slug.'faq','uses'=>$module_controller.'faq']);
		Route::any('/faq/search_faq',			['as'=>$route_slug.'search_faq','uses'=>$module_controller.'search_faq']);
		
					/*---------------------  faq end ---------------------------*/

					/*---------------------  feedback start ---------------------------*/

		Route::any('/feedback',				['as'=>$route_slug.'feedback','uses'=>$module_controller.'feedback']);
		Route::any('/feedback/store',		['as'=>$route_slug.'feedback_store','uses'=>$module_controller.'feedback_store']);
					
					/*---------------------  feedback end ---------------------------*/

		

					/*-------------------  Contact & support start ---------------------*/

		Route::any('/enquiry_msg',			['as'=>$route_slug.'enquiry_msg','uses'=>$module_controller.'enquiry_msg']);						

					/*-------------------  Contact & support end ---------------------*/


					/*---------------------  faq end ---------------------------*/

		/*--------------------------------  HELP & SUPPORT ENDS -----------------------------------------*/

		

		/*--------------------------------  CHECK EMAIL EXIST OR NOT START-----------------------------------------*/

		Route::any('/check_mail',						['as'=>$route_slug.'check_mail','uses'=>$module_controller.'check_mail']);
		Route::any('/check_member_mail',				['as'=>$route_slug.'check_member_mail','uses'=>$module_controller.'check_member_mail']);
		Route::any('/check_doctor_invitation_mail',		['as'=>$route_slug.'check_doctor_invitation_mail','uses'=>$module_controller.'check_doctor_invitation_mail']);
		Route::any('/check_pharmacy_invitation_mail',	['as'=>$route_slug.'check_pharmacy_invitation_mail','uses'=>$module_controller.'check_pharmacy_invitation_mail']);


		/*--------------------------------  CHECK EMAIL EXIST OR NOT END -----------------------------------------*/

		/*--------------------------------  NOTIFICATIONS START-----------------------------------------*/

		Route::any('/notification_settings',	['as'=>$route_slug.'notification_settings','uses'=>$module_controller.'notification_settings']);
		Route::any('/notification_store',		['as'=>$route_slug.'notification_store','uses'=>$module_controller.'notification_store']);

		/*--------------------------------  NOTIFICATIONS END-----------------------------------------*/

		/*--------------------------------  LEGAL START -----------------------------------------*/

		Route::any('/legal',		['as'=>$route_slug.'legal','uses'=>$module_controller.'legal']);
		
		// Create dynamic pages - mission, privacy policy, terms & conditions
		Route::get('{slug}', 		['uses' => $module_controller.'dynamic_pages'])->where('slug', '([A-Za-z0-9\-\/]+)');

		/*--------------------------------  LEGAL END -----------------------------------------*/

		});

		/*------------------------------------------ New Patient Setting End ------------------------------------------*/





		/*question module*/
		Route::group(['prefix'=>'question','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "question";
			$module_controller = "Front\Patient\QuestionController@";
			Route::get('/ask',	 ['as'=>$route_slug.'ask_question','uses'=>$module_controller.'index']);
			Route::post('/store',['as'=>$route_slug.'store_question','uses'=>$module_controller.'store']);
			Route::get('/answered',['as'=>$route_slug.'store_question','uses'=>$module_controller.'show_answered_questions']);
			Route::get('/unanswered',['as'=>$route_slug.'store_question','uses'=>$module_controller.'show_unanswered_questions']);
		});


		  /* prefernces route */
	      Route::group(['prefix'=>'preference','middleware' =>'auth_patient'],function()
	      {

	            $route_slug        = "preference_";
	            $module_controller = "Front\Patient\PreferenceController@";

	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
	            Route::post('/create',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'store']);
	      });

	       /*Request route */
	      Route::group(['prefix'=>'request','middleware' =>'auth_patient'],function()
	      {

	            $route_slug        = "request_";
	            $module_controller = "Front\Patient\RequestController@";

	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
	            Route::get('/change_status/{enc_id}/{status}',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'change_status']);
	      });

	       /* invitation route */
	      Route::group(['prefix'=>'invitation','middleware' =>'auth_patient'],function()
	      {

	            $route_slug        = "invitation_";
	            $module_controller = "Front\Patient\InvitationController@";

	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);

	            Route::post('/create',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'store']);

	            Route::post('/create_doctor_invitation',['as'=>$route_slug.'create_doctor_invitation', 'uses'=> $module_controller.'store_doctor_invitation']);

	            Route::post('/create_pharmacy_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_pharmacy_invitation']);

	            Route::post('/create_patient_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_patient_invitation']);
	            
	      });


		/*=============================================Medical History===================================================================*/

		Route::group(['prefix'=>'medicalhistory','middleware' =>'auth_patient'],function(){
			
			$route_slug        = "patient_medicalhistory_";
			$module_controller = "Front\Patient\MedicalhistoryController@";

			
			Route::get('/step-1/{enc_id?}',	     	['as'=>$route_slug."step-2",   'uses'=>$module_controller.'step_one']);
			Route::get('/step-2/{enc_id?}',	     	['as'=>$route_slug."step-3",   'uses'=>$module_controller.'step_two']);
			Route::get('/step-3/{enc_id?}',	     	['as'=>$route_slug."step-4",	'uses'=>$module_controller.'step_three']);
			Route::post('/store_step_1',	     	['as'=>$route_slug."store_step_2",	   'uses'=>$module_controller.'store_step_1']);
			Route::post('/store_step_2',	     	['as'=>$route_slug."store_step_3",	   'uses'=>$module_controller.'store_step_2']);
			Route::post('/store_step_3',	     	['as'=>$route_slug."store_step_4",	   'uses'=>$module_controller.'store_step_3']);
			Route::get('/download/{enc_id}',	    ['as'=>$route_slug."download_percription",'uses'=>$module_controller.'download_precription']);
			Route::get('/update',	                ['as'=>$route_slug."update",            'uses'=>$module_controller.'update']);
			Route::get('/medication_listing',	    ['as'=>$route_slug."medication_listing",'uses'=>$module_controller.'medication_listing']);

			Route::get('/health',	         ['as'=>$route_slug."update",     'uses'=>$module_controller.'show_health']);

			Route::get('/delete/{enc_id}',   ['as'=>$route_slug.'delete_medication',   'uses'=>$module_controller.'delete_medication']);

			Route::post('/set_familiy_member',['as'=>$route_slug.'set_familiy_member',	'uses'=>$module_controller.'set_familiy_member']);

	    });

		Route::group(['prefix'=>'booking','middleware' =>'auth_patient'],function()
		{
			$route_slug        = "patient_booking";
			$module_controller = "Front\Patient\BookingController@";

			Route::get('/upcoming',	  ['as'=>$route_slug,'uses'=>$module_controller.'show_upcoming_booking']);
			Route::get('/past',	      ['as'=>$route_slug,'uses'=>$module_controller.'show_past_booking']);
			Route::post('/create_reminder',	  ['as'=>$route_slug,'uses'=>$module_controller.'store_reminder']);
			Route::get('/delete_reminder/{enc_id}',	  ['as'=>$route_slug,'uses'=>$module_controller.'delete_reminder']);

		});
		/*==============================================Dashboard=============================================================*/

		/*Route::group(['middleware' =>'auth_patient'],function()
	    {
			$route_slug        = "patient_dashboard_";
			$module_controller = "Front\Patient\DashboardController@";

			Route::get('/dashboard',	     			['as'=>$route_slug."dashboard",		   'uses'=>$module_controller.'index']);

		});*/
	
		 /*chating route*/
		/*Route::group(['prefix'=>'chat','middleware' =>'auth_patient'],function()
		{

			$route_slug        = "chat";
			$module_controller = "Front\Patient\ChatController@";

			Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
			Route::get('/create_channel/{enc_id}',['as'=>$route_slug, 'uses'=> $module_controller.'create_channel']);
			Route::post('/send_message/',['as'=>$route_slug, 'uses'=> $module_controller.'send_message']);
		 
		});*/


	   /*======================= Dispute ===========================*/

		Route::group(['middleware' =>'auth_patient'],function()
	    {
			$route_slug        = "patient_disputes_";
			$module_controller = "Front\Patient\DisputesController@";

			Route::get('/dispute/{enc_id}',	 	    ['as'=>$route_slug."dispute",		   'uses'=>$module_controller.'index']);
			Route::get('/dispute',	 	            ['as'=>$route_slug."dispute",		   'uses'=>$module_controller.'index']);
			Route::get('/add',	     			    ['as'=>$route_slug."add",		       'uses'=>$module_controller.'add']);
			Route::get('/store_dispute',	     	['as'=>$route_slug."store",	           'uses'=>$module_controller.'store_dispute']);
			Route::post('/dispute_response',	    ['as'=>$route_slug."response",	       'uses'=>$module_controller.'response']);
			Route::get('/download_dispute/{enc_id}',['as'=>$route_slug."download_dispute", 'uses'=>$module_controller.'download_dispute']);
	    });

	/*============================ confirm booking ======================================================*/
		

	});

	
	Route::group(['prefix'=>'search','middleware' =>'auth_patient'],function(){

		$route_slug 	=	'search_';
		$module_controller 	=	'Front\Patient\SearchController@';

		Route::get('/doctor/who-is-patient',				['as'=>$route_slug.'who_is_patient',					'uses'=>$module_controller.'step_1_who_is_patient']);
		Route::post('/store_family_member',					['as'=>$route_slug.'store_family_member',				'uses'=>$module_controller.'store_family_member']);
		Route::post('/doctor/store_step_1_who_is_patient',	['as'=>$route_slug.'store_step_1_who_is_patient',		'uses'=>$module_controller.'store_step_1_who_is_patient']);
		Route::get('/doctor/what-are-you-seeking-from-doctor',['as'=>$route_slug.'what_are_you_seeking_from_doctor','uses'=>$module_controller.'step_2_what_are_you_seeking_from_doctor']);
		Route::post('/doctor/store_step_2_what_are_you_seeking_from_doctor',['as'=>$route_slug.'store_step_2_what_are_you_seeking_from_doctor', 'uses'=>$module_controller.'store_step_2_what_are_you_seeking_from_doctor']);
		Route::get('/doctor/prescription/questions', 		['as'=>$route_slug.'prescription_questions', 			'uses'=>$module_controller.'step_3A_prescription_questions']);
		Route::post('/doctor/store_prescription_questions', ['as'=>$route_slug.'store_prescription_questions', 		'uses'=>$module_controller.'store_step_3A_prescription_questions']);
		Route::get('/doctor/medical-history/questions',		['as'=>$route_slug.'medical_history_questions',			'uses'=>$module_controller.'step_3B_medical_certificate_questions']);

		Route::post('/doctor/store_step_3B_medical_certificate_questions',['as'=>$route_slug.'store_medical_history_questions','uses'=>$module_controller.'store_3B_medical_certificate_questions']);
		Route::get('/delete/booking_images/{enc_id}',		['as'=>$route_slug.'booking_images',					'uses'=>$module_controller.'booking_images']);
		Route::get('/download/prescription/{end_id}',		['as'=>$route_slug.'download_precription',				'uses'=>$module_controller.'download_precription']);
		Route::get('/doctor/more-precise',					['as'=>$route_slug.'more_precise',						'uses'=>$module_controller.'step_4_more_precise_doctor']);
		Route::get('/doctor/search_more_precise',			['as'=>$route_slug.'search_more_precise', 				'uses'=>$module_controller.'search_more_precise']);
		Route::get('/doctor/specific',				 		['as'=>$route_slug.'specific', 							'uses'=>$module_controller.'search_specific']);
		Route::get('/doctor/suitable',						['as'=>$route_slug.'suitable', 							'uses'=>$module_controller.'search_suitable']);
		Route::get('/doctor/availability',					['as'=>$route_slug.'doctor_availability', 				'uses'=>$module_controller.'get_availability']);
		Route::post('/doctor/confirm_booking',				['as'=>$route_slug.'confirm_booking', 					'uses'=>$module_controller.'confirm_booking']);
		Route::get('/doctor/checkout',						['as'=>$route_slug.'checkout',							'uses'=>$module_controller.'step_6_checkout']);
		Route::post('/doctor/store_step_6_checkout',		['as'=>$route_slug.'store_checkout',					'uses'=>$module_controller.'store_step_6_checkout']);
		Route::get('/doctor/who-is-patient/fast',			['as'=>$route_slug.'fast_who_is_patient', 				'uses'=>$module_controller.'fast_who_is_patient']);
		Route::post('/doctor/store_fast_who_is_patient',	['as'=>$route_slug.'store_fast_who_is_patient',			'uses'=>$module_controller.'store_fast_who_is_patient']);
	});

	$route_slug 		=	'search_';
	$module_controller 	=	'Front\Patient\SearchController@';
	Route::get('/patient/consultation/confirm/',			['as'=>$route_slug.'consultation_confirm', 'uses'=>$module_controller.'consultation_confirm']);


