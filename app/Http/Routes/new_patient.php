<?php
	/* New Patient Dashboard */
	Route::group(['prefix'=>'patient'],function(){

		$route_slug        = "patient_";
		$module_controller = "Front\Patient\NewDashboardController@";

		/*Route::get('/dashboard', 					['as'=>$route_slug.'dashboard', 'uses'=>$module_controller.'dashboard']);*/
		/*Route::get('/book_a_doctor', 				['as'=>$route_slug.'book_a_doctor', 'uses'=>$module_controller.'book_a_doctor']);*/
		Route::get('/profile_availibility', 		['as'=>$route_slug.'profile_availibility', 'uses'=>$module_controller.'profile_availibility']);
		Route::get('/profile_about', 				['as'=>$route_slug.'profile_about', 'uses'=>$module_controller.'profile_about']);
		Route::get('/consultation_details', 		['as'=>$route_slug.'consultation_details', 'uses'=>$module_controller.'consultation_details']);
		Route::get('/consultation_invoice', 		['as'=>$route_slug.'consultation_invoice', 'uses'=>$module_controller.'consultation_invoice']);
		Route::get('/disputes', 					['as'=>$route_slug.'disputes', 'uses'=>$module_controller.'disputes']);
		Route::get('/feedback', 					['as'=>$route_slug.'feedback', 'uses'=>$module_controller.'feedback']);
		Route::get('/search_available_doctors', 	['as'=>$route_slug.'search_available_doctors', 'uses'=>$module_controller.'search_available_doctors']);
		Route::get('/review_booking', 				['as'=>$route_slug.'review_booking', 'uses'=>$module_controller.'review_booking']);
		Route::get('/booking_request_confirmation', ['as'=>$route_slug.'booking_request_confirmation', 'uses'=>$module_controller.'booking_request_confirmation']);
		Route::get('/cancellation_refunds', 		['as'=>$route_slug.'cancellation_refunds', 'uses'=>$module_controller.'cancellation_refunds']);
		Route::get('/online_waiting_room', 			['as'=>$route_slug.'online_waiting_room', 'uses'=>$module_controller.'online_waiting_room']);
		Route::get('/my_shop', 		                ['as'=>$route_slug.'my_shop', 'uses'=>$module_controller.'my_shop']);
		Route::get('/messages_list', 		        ['as'=>$route_slug.'messages_list', 'uses'=>$module_controller.'messages_list']);
		Route::get('/notification', 		        ['as'=>$route_slug.'notification', 'uses'=>$module_controller.'notification']);
		Route::get('/settings', 		            ['as'=>$route_slug.'settings', 'uses'=>$module_controller.'settings']);
		Route::get('/my_health', 		            ['as'=>$route_slug.'my_health', 'uses'=>$module_controller.'my_health']);
		Route::get('/my_health_conditions', 		['as'=>$route_slug.'my_health_conditions', 'uses'=>$module_controller.'my_health_conditions']);
		Route::get('/my_consulations', 		        ['as'=>$route_slug.'my_consulations', 'uses'=>$module_controller.'my_consulations']);
		Route::get('/my_orders', 		            ['as'=>$route_slug.'my_orders', 'uses'=>$module_controller.'my_orders']);
		Route::get('/faq', 		                    ['as'=>$route_slug.'faq', 'uses'=>$module_controller.'faq']);
		Route::get('/faq_settings', 		        ['as'=>$route_slug.'faq_settings', 'uses'=>$module_controller.'faq_settings']);
		Route::get('/add_pharmacy_order', 		    ['as'=>$route_slug.'add_pharmacy_order', 'uses'=>$module_controller.'add_pharmacy_order']);
		Route::get('/pharmacy_details', 		    ['as'=>$route_slug.'pharmacy_details', 'uses'=>$module_controller.'pharmacy_details']);
		Route::get('/add_medication', 		        ['as'=>$route_slug.'add_medication', 'uses'=>$module_controller.'add_medication']);
		Route::get('/question_for_free', 		    ['as'=>$route_slug.'question_for_free', 'uses'=>$module_controller.'question_for_free']);
		Route::get('/personal_details', 		    ['as'=>$route_slug.'personal_details', 'uses'=>$module_controller.'personal_details']);
		Route::get('/edit_personal_detail',         ['as'=>$route_slug.'edit_personal_detail', 'uses'=>$module_controller.'edit_personal_detail']);

		Route::get('/family_member', 		        ['as'=>$route_slug.'family_member', 'uses'=>$module_controller.'family_member']);
		Route::get('/family_doctor', 		        ['as'=>$route_slug.'family_doctor', 'uses'=>$module_controller.'family_doctor']);
		Route::get('/my_pharmacy', 		            ['as'=>$route_slug.'my_pharmacy', 'uses'=>$module_controller.'my_pharmacy']);
		Route::get('/email_password', 		        ['as'=>$route_slug.'email_password', 'uses'=>$module_controller.'email_password']);
		Route::get('/notification_settings',        ['as'=>$route_slug.'notification_settings', 'uses'=>$module_controller.'notification_settings']);
		Route::get('/payment_method_settings',      ['as'=>$route_slug.'payment_method_settings', 'uses'=>$module_controller.'payment_method_settings']);
		Route::get('/payment_method',               ['as'=>$route_slug.'payment_method', 'uses'=>$module_controller.'payment_method']);
		Route::get('/invoice',                      ['as'=>$route_slug.'invoice', 'uses'=>$module_controller.'invoice']);
		Route::get('/invitation',                   ['as'=>$route_slug.'invitation', 'uses'=>$module_controller.'invitation']);
		Route::get('/open_disputes',                ['as'=>$route_slug.'open_disputes', 'uses'=>$module_controller.'open_disputes']);
        Route::get('/legal',                        ['as'=>$route_slug.'legal', 'uses'=>$module_controller.'legal']);
        Route::get('/mission',                      ['as'=>$route_slug.'mission', 'uses'=>$module_controller.'mission']);
        Route::get('/privacy',                      ['as'=>$route_slug.'privacy', 'uses'=>$module_controller.'privacy']);
        Route::get('/conditions',                   ['as'=>$route_slug.'conditions', 'uses'=>$module_controller.'conditions']);
        Route::get('/online_waiting_room',          ['as'=>$route_slug.'online_waiting_room', 'uses'=>$module_controller.'online_waiting_room']);
		Route::get('/my_consulations_1', 		    ['as'=>$route_slug.'my_consulations_1', 'uses'=>$module_controller.'my_consulations_1']);
	});