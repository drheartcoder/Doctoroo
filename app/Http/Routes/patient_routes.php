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
	Route::group(['prefix'=>'patient'],function()
	{

		$route_slug        = "patient_";
		$module_controller = "Front\Patient\AuthController@";

		Route::get('/duplicate/email',	                ['as'=>$route_slug.'duplicate',		'uses'=>$module_controller.'duplicate']);
		Route::post('/signup/store',	                ['as'=>$route_slug.'signup_store', 	'uses'=>$module_controller.'store_signup']);
		Route::get('/error',			                ['as'=>$route_slug.'error',			'uses'=>$module_controller.'error']);
		Route::get('/verify/{enc_id}/{activation_code}',['as'=>$route_slug.'verify',	    'uses'=>$module_controller.'verify']);
		Route::post('/signin_check',	                ['as'=>$route_slug.'signin',		'uses'=>$module_controller.'signin_check']);
	
		Route::get('/resend-verification-email/{enc_id}',['as'=>$route_slug.'resend_verification_email',	'uses'=>$module_controller.'resend_verification_email']);

		 /*routes for deleting an account */
		Route::get('/delete',			                ['as'=>$route_slug.'delete',	  'uses'=>$module_controller.'delete_account']);



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

		});

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

			Route::post('/add_medication',   ['as'=>$route_slug.'add_medication',   'uses'=>$module_controller.'add_medication']);

			Route::get('/delete/{enc_id}',   ['as'=>$route_slug.'delete_medication',   'uses'=>$module_controller.'delete_medication']);

			Route::post('/set_familiy_member',['as'=>$route_slug.'set_familiy_member',	'uses'=>$module_controller.'set_familiy_member']);

	    });

		/*==============================================Dashboard=============================================================*/

		Route::group(['middleware' =>'auth_patient'],function()
	    {
			$route_slug        = "patient_dashboard_";
			$module_controller = "Front\Patient\DashboardController@";

			Route::get('/dashboard',	     			['as'=>$route_slug."dashboard",		   'uses'=>$module_controller.'index']);

		});
	
	

	   /*============================================== Dispute =============================================================*/

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

	/*=========================================End====================================================================================*/

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
	});
