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
	Route::any('patient/booking/payment/stripe/membershipPayment',	  		['as'=>'patient/booking/payment/stripe/stripePayment','uses'=>'Front\Patient\PaymentController@membershipPayment']);

	Route::any('doctor/stripe/authenticate_code',	  		['as'=>'doctor/stripe/authenticate_code','uses'=>'Front\Patient\PaymentController@authenticate_code']);

	Route::any('doctor/verify_otp', ['as'=>'doctor/verify_otp', 'uses' => 'Front\Doctor\AuthController@verify_otp']);
	Route::any('doctor/resend_otp', ['as'=>'doctor/resend_otp', 'uses' => 'Front\Doctor\AuthController@resend_otp']);

	$module_controller = "Front\Doctor\MyPatientsController@";

	Route::any('/doctor/patients/change_profile_type/{enc_patient_id}/{enc_doctor_id}/{enc_type}',		['as'=>"change_profile_type",'uses'=>$module_controller.'change_profile_type']);

	Route::group(['prefix'=>'doctor', 'middleware' =>'front_general'],function()
	{

		$route_slug        = "doctor_";
		$module_controller = "Front\Doctor\AuthController@";

		Route::get('/',						   ['as'=>$route_slug.'index',		  'uses'=>$module_controller.'index']);
		Route::any('/duplicate/email',	       ['as'=>$route_slug.'duplicate',	  'uses'=>$module_controller.'duplicate']);
		Route::any('/duplicate/mobile_no',	   ['as'=>$route_slug.'duplicate_mobile_no_check',	  'uses'=>$module_controller.'duplicate_mobile_no_check']);
		Route::post('/signup/store',	       ['as'=>$route_slug.'signup_store', 'uses'=>$module_controller.'store_signup']);
		Route::get('/thankyou',			       ['as'=>$route_slug.'thankyou',	  'uses'=>$module_controller.'thankyou']);


		Route::any('/profile_about/{enc_id}',	['as'=>$route_slug."profile_about",'uses'=>$module_controller.'profile_about']);


		/*------------------------------------------ New Doctor Start ------------------------------------------*/

		/*------------------------------------------ Sign-up Start ------------------------------------------*/
		Route::any('/signup/step1/{enc_id}',	       	['as'=>$route_slug.'signup_step1', 'uses'=>$module_controller.'signup_step1']);
		Route::any('/signup/store_step1/{enc_id}',		['as'=>$route_slug.'store_step1', 'uses'=>$module_controller.'store_step1']);
		Route::any('/signup/step2/{enc_id}',	       	['as'=>$route_slug.'signup_step2', 'uses'=>$module_controller.'signup_step2']);
		Route::any('/signup/store_step2/{enc_id}',		['as'=>$route_slug.'store_step2', 'uses'=>$module_controller.'store_step2']);
		Route::any('/signup/step3/{enc_id}',	       	['as'=>$route_slug.'signup_step3', 'uses'=>$module_controller.'signup_step3']);
		Route::any('/signup/store_step3/{enc_id}',		['as'=>$route_slug.'store_step3', 'uses'=>$module_controller.'store_step3']);
		Route::any('/signup/step4/{enc_id}',	       	['as'=>$route_slug.'signup_step4', 'uses'=>$module_controller.'signup_step4']);
		Route::any('/signup/store_step4/{enc_id}',		['as'=>$route_slug.'store_step4', 'uses'=>$module_controller.'store_step4']);
		Route::any('/signup/step5/{enc_id}',	       	['as'=>$route_slug.'signup_step5', 'uses'=>$module_controller.'signup_step5']);
		Route::any('/signup/store_step5/{enc_id}',		['as'=>$route_slug.'store_step5', 'uses'=>$module_controller.'store_step5']);
		/*------------------------------------------ Sign-up End ------------------------------------------*/




		/* change mobile number */
        Route::any('/change_mobile_no/store',['as'=>$route_slug.'signup_voucher', 'uses'=>$module_controller.'store_change_mobile_no']);
        Route::any('/verify_cpnotp', ['as'=>'verify_cpnotp', 'uses' => $module_controller.'verify_cpnotp']);
        Route::any('/resend_cpnotp', ['as'=>'resend_cpnotp', 'uses' => $module_controller.'resend_cpnotp']);
        /* endchange mobile number */



        


		/*------------------------------------------ Dashboard Start ------------------------------------------*/
		Route::group(array('prefix' => '/profile','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "doctor_profile";
			$module_controller = "Front\Doctor\ProfileController@";
			
			Route::get('/dashboard',	   ['as'=>$route_slug.'dashboard', 'uses'=>'Front\Doctor\DashboardController@index']);
			Route::any('/new_device_used', ['as'=>$route_slug.'new_device_used', 'uses'=>'Front\Doctor\DashboardController@new_device_used']);
		});
		/*------------------------------------------ Dashboard End ------------------------------------------*/


		/*------------------------------------------ New Notification starts here ------------------------------------------*/
			
		Route::group(array('prefix' => '/notification','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "doctor_notification";
			$module_controller = "Front\Doctor\NotificationController@";
			Route::any('/',	       ['as'=>$route_slug, 'uses'=>$module_controller.'index']);

		});

		/*------------------------------------------ New Notification end here ------------------------------------------*/

		/*------------------------------------------ New consultation starts here ------------------------------------------*/


		Route::group(array('prefix' => '/consultation','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "consultation";
			$module_controller = "Front\Doctor\ConsultationController@";
      

			Route::any('/new_consultation_request',		            ['as'=>$route_slug.'new_consultation_request',           'uses'=>$module_controller.'new_consultation_request']);
			Route::any('/consultation_request_with_ajax',		    ['as'=>$route_slug.'consultation_request_with_ajax',     'uses'=>$module_controller.'consultation_request_with_ajax']);


			Route::any('/upcoming_consultation',		['as'=>$route_slug.'upcoming_consultation', 'uses'=>$module_controller.'upcoming_consultation']);
			Route::any('/past_consultation',			['as'=>$route_slug.'past_consultation', 'uses'=>$module_controller.'past_consultation']);
			Route::any('/past_consultation/update',		['as'=>$route_slug.'past_consultation/update', 'uses'=>$module_controller.'past_consultation_update']);
			Route::any('/decline_consultation',			['as'=>$route_slug.'decline_consultation', 'uses'=>$module_controller.'decline_consultation']);
			Route::any('/new_consultation_request_details/{enc_id}',		['as'=>$route_slug.'new_consultation_request_details', 'uses'=>$module_controller.'new_consultation_request_details']);
			Route::any('/booking_status',				['as'=>$route_slug.'booking_status', 'uses'=>$module_controller.'booking_status']);
			Route::get('/upcoming_consultation_details/{enc_id}',	['as'=>$route_slug.'upcoming_consultation_details', 'uses'=>$module_controller.'upcoming_consultation_details']);
			Route::get('/past_consultation_details/{enc_id}',		['as'=>$route_slug.'past_consultation_details', 'uses'=>$module_controller.'past_consultation_details']);

			Route::any('/past_consultation_details/download/{enc_id}',	['as'=>$route_slug.'past_consultation_details_download', 'uses'=>$module_controller.'past_consultation_details_download']);

			Route::any('/past_consultation_details_generate_pdf',	['as'=>$route_slug.'past_consultation_details_download_pdf', 'uses'=>$module_controller.'past_consultation_details_download_pdf']);
			
			Route::get('/declined_consultation_details/{enc_id}',		['as'=>$route_slug.'declined_consultation_details', 'uses'=>$module_controller.'declined_consultation_details']);

			Route::any('/cancel_consultation/{enc_id}',			['as'=>$route_slug.'cancel_consultation', 'uses'=>$module_controller.'cancel_consultation']);

			Route::any('/show_available_time',			['as'=>$route_slug.'show_available_time', 'uses'=>$module_controller.'show_available_time']);
			Route::any('/process_offer_time',			['as'=>$route_slug.'process_offer_time', 'uses'=>$module_controller.'process_offer_time']);
			Route::any('/get_doctor_available_time',	['as'=>$route_slug.'get_doctor_available_time', 'uses'=>$module_controller.'get_doctor_available_time']);
			Route::any('/update_booking_time',			['as'=>$route_slug.'update_booking_time', 'uses'=>$module_controller.'update_booking_time']);
			Route::any('/update_booking_call_status',	['as'=>$route_slug.'update_booking_call_status', 'uses'=>$module_controller.'update_booking_call_status']);
			Route::any('/start_video_call',				['as'=>$route_slug.'start_video_call', 'uses'=>$module_controller.'start_video_call']);
			Route::any('/check_patient_active_video_call',				['as'=>$route_slug.'check_patient_active_video_call', 'uses'=>$module_controller.'check_patient_active_video_call']);
	    });


	    /*------------------------------------------ New consultation ends here ------------------------------------------*/

	    /*------------------------------------------CALENDER & AVAILABILITY START  ------------------------------------------*/


		Route::group(array('prefix' => '/availability','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "availability";
			$module_controller = "Front\Doctor\AvailabilityController@";


			Route::any('/',		['as'=>$route_slug.'', 'uses'=>$module_controller.'index']);

			Route::any('/store',		['as'=>$route_slug.'store', 'uses'=>$module_controller.'store']);
			Route::any('/update',		['as'=>$route_slug.'update', 'uses'=>$module_controller.'update']);

			Route::any('/get_available_time',		['as'=>$route_slug.'get_available_time', 'uses'=>$module_controller.'get_available_time']);
			Route::any('/get_booking_time',			['as'=>$route_slug.'get_booking_time', 'uses'=>$module_controller.'get_booking_time']);
			Route::any('/delete_available_time',			['as'=>$route_slug.'delete_available_time', 'uses'=>$module_controller.'delete_available_time']);
			
	    });


	    /*------------------------------------------ CALENDER & AVAILABILITY END ------------------------------------------*/

	    /*------------------------------------------ My patients starts here ------------------------------------------*/

	    Route::group(array('prefix'=>'/patients','middleware'=>'auth_doctor'), function()
	    {

	    	$route_slug        = "doctoroo_patient";
			$module_controller = "Front\Doctor\MyPatientsController@";

			Route::get('/doctoroo_patients',	['as'=>$route_slug.'doctoroo_patients', 'uses'=>$module_controller.'doctoroo_patients']);
			Route::any('/search_patient_name',	['as'=>$route_slug.'search_patient_name', 'uses'=>$module_controller.'search_patient_name']);
			Route::any('/search_patient',	   	['as'=>$route_slug.'search_patient', 'uses'=>$module_controller.'search_patient']);

			Route::any('/details/{enc_id}',	   	['as'=>$route_slug.'my_patients_details', 'uses'=>$module_controller.'my_patients_details']);

			Route::any('/details/download/{enc_id}',	   	['as'=>$route_slug.'download_pdf', 'uses'=>$module_controller.'patient_details_pdf_download']);

			Route::any('/generate_patient_details_pdf_download',['as'=>$route_slug.'download_pdf', 'uses'=>$module_controller.'generate_patient_details_pdf_download']);

			Route::any('/medical_history/{enc_id}',	   	['as'=>$route_slug.'my_patients_medical_history', 'uses'=>$module_controller.'my_patients_medical_history']);

			Route::any('/consultation_history/{enc_id}', ['as'=>$route_slug.'my_patients_consultation_history', 'uses'=>$module_controller.'my_patients_consultation_history']);		

			//Route::any('/tools/{enc_id}',	   	['as'=>$route_slug.'my_patients_tools', 'uses'=>$module_controller.'my_patients_tools']);
			Route::any('/consultation_guide/{enc_id}',	['as'=>$route_slug.'my_patients_consultation_guide', 'uses'=>$module_controller.'my_patients_consultation_guide']);

			Route::any('/family_members/add',	      	['as'=>$route_slug."family_members_add",'uses'=>$module_controller.'family_members_add']);
			Route::any('/family_members/edit',	      	['as'=>$route_slug."family_members_edit",'uses'=>$module_controller.'family_members_edit']);
			Route::any('/family_members/delete',	  	['as'=>$route_slug."family_members_delete",'uses'=>$module_controller.'family_members_delete']);

			Route::any('/medical_condition/add',	     ['as'=>$route_slug."medical_condition_add",'uses'=>$module_controller.'medical_condition_add']);
			Route::any('/medical_condition/update_lifestyle',	['as'=>$route_slug."update_lifestyle",'uses'=>$module_controller.'update_lifestyle']);
			Route::any('/medication_details/{enc_userid}/{enc_id}',	['as'=>$route_slug."medication_details",'uses'=>$module_controller.'medication_details']);
			Route::any('/medication/add/{enc_id}',		['as'=>$route_slug."add_medication",'uses'=>$module_controller.'add_medication']);
			Route::any('/medication/store',				['as'=>$route_slug."store_medication",'uses'=>$module_controller.'store_medication']);
			Route::any('/medication_details/edit',		['as'=>$route_slug."edit_medication",'uses'=>$module_controller.'edit_medication']);
			Route::any('/medication_details/delete',	['as'=>$route_slug."edit_medication",'uses'=>$module_controller.'delete_medication']);
			
			Route::any('/prescription/add',				['as'=>$route_slug."add_prescription",'uses'=>$module_controller.'add_prescription']);
			Route::any('/prescription/edit',			['as'=>$route_slug."edit_prescription",'uses'=>$module_controller.'edit_prescription']);
			Route::any('/prescription/delete',			['as'=>$route_slug."delete_prescription",'uses'=>$module_controller.'delete_prescription']);
			Route::any('/medication_image/delete',		['as'=>$route_slug."delete_medication_img",'uses'=>$module_controller.'delete_medication_img']);
			Route::any('/medical_general/update',	     ['as'=>$route_slug."update_medical_general",'uses'=>$module_controller.'update_medical_general']);
			Route::any('/medical_general/insert',	     ['as'=>$route_slug."insert_medical_general",'uses'=>$module_controller.'insert_medical_general']);
			Route::any('/medical_general/delete',	     ['as'=>$route_slug."delete_medical_general",'uses'=>$module_controller.'delete_medical_general']);

			Route::any('/family_doctors/add/{enc_id}',	['as'=>$route_slug.'family_doctors_add','uses'=>$module_controller.'family_doctors_add']);
			Route::any('/family_doctors/add_data',		['as'=>$route_slug.'add_doctor','uses'=>$module_controller.'add_doctor']);
			Route::any('/check_member_mail',			['as'=>$route_slug.'check_member_mail','uses'=>$module_controller.'check_member_mail']);
			Route::any('/family_members/unlink/{patient_id}/{member_id}', 		['as'=>$route_slug."family_members_unlink",'uses'=>$module_controller.'family_members_unlink']);
			Route::any('/family_members/member_unlink_mail',['as'=>$route_slug."family_members_unlink_mail",'uses'=>$module_controller.'family_members_unlink_mail']);

			Route::any('/add_pharmacy/{enc_id}',		['as'=>$route_slug.'add_pharmacy','uses'=>$module_controller.'add_pharmacy']);

			Route::any('/add_pharmacy/{enc_id}/search',	['as'=>$route_slug.'search_pharmacy','uses'=>$module_controller.'search_pharmacy']);
			Route::any('/add_pharmacy_data',			['as'=>$route_slug.'add_pharmacy_data','uses'=>$module_controller.'add_pharmacy_data']);
			Route::any('/delete_my_pharmacy',			['as'=>$route_slug.'delete_my_pharmacy','uses'=>$module_controller.'delete_my_pharmacy']);

			Route::any('/edit_patient',					['as'=>$route_slug.'edit_patient','uses'=>$module_controller.'edit_patient']);
			Route::any('/add_patient',					['as'=>$route_slug.'edit_patient','uses'=>$module_controller.'add_patient']);
			Route::any('/store_patient',				['as'=>$route_slug.'store_patient','uses'=>$module_controller.'store_patient']);


			Route::get('/myown_patients',					['as'=>$route_slug.'myown_patients', 'uses'=>$module_controller.'myown_patients']);
			Route::get('/notify_patient',					['as'=>$route_slug.'notify_patient', 'uses'=>$module_controller.'notify_patient']);

			Route::any('/consultation_history/{type}/{enc_id}', ['as'=>$route_slug.'my_patients_consultation_history_all_records', 'uses'=>$module_controller.'my_patients_consultation_history_all_records']);

			Route::any('/new_consultation_details/{enc_patient_id}/{enc_id}', ['as'=>$route_slug.'new_consultation_request_details', 'uses'=>$module_controller.'new_consultation_request_details']);

			Route::any('/upcoming_consultation_details/{enc_patient_id}/{enc_id}', ['as'=>$route_slug.'upcoming_consultation_details', 'uses'=>$module_controller.'upcoming_consultation_details']);

			Route::any('/past_consultation_details/{enc_patient_id}/{enc_id}', ['as'=>$route_slug.'past_consultation_details', 'uses'=>$module_controller.'past_consultation_details']);
			Route::any('/past_consultation_details/update', ['as'=>$route_slug.'past_consultation_details', 'uses'=>$module_controller.'past_consultation_update']);

			Route::any('/medical_history/download/{enc_id}',	   	['as'=>$route_slug.'medical_history_download_pdf', 'uses'=>$module_controller.'medical_history_pdf_download']);

			Route::any('/generate_medical_history_pdf_download',['as'=>$route_slug.'download_pdf', 'uses'=>$module_controller.'generate_medical_history_pdf_download']);

			Route::any('/past_consultation_detail/download/{enc_id}',		['as'=>$route_slug.'past_consultation_details_download', 'uses'=>$module_controller.'past_consultation_details_download']);

			Route::any('/entitlement/get_details',	  ['as'=>$route_slug.'entitlement/get_details', 'uses'=>$module_controller.'get_entitlement_details']);
			Route::any('/entitlement/store',	      ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'store_entitlement_details']);		
			Route::any('/entitlement/delete',	      ['as'=>$route_slug."entitlement_details",'uses'=>$module_controller.'delete_entitlement_details']);	



            /*------------------------------------------ doctor activity here ------------------------------------------*/
			Route::group(['prefix'=>'patient_history','middleware' =>'auth_doctor'],function()
		    {
		    	$route_slug        = "doctoroo_patient";
			    $module_controller = "Front\Doctor\MyPatientsController@";
		      	Route::any('/view',	      ['as'=>$route_slug."view",   'uses'=>$module_controller.'patient_history_view']);	
		      	
			});
		    /*------------------------------------------ doctor activity here ------------------------------------------*/



			/*------------------------------------------ tool starts here ------------------------------------------*/
			Route::group(['prefix'=>'tools','middleware' =>'auth_doctor'],function()
		    {
	            $route_slug        = "tools";
	            $module_controller = "Front\Doctor\ToolsController@";

	            Route::get('/{enc_id}',						['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);
	            Route::any('/other_file_upload/{enc_id}',	['as'=>$route_slug.'other_file_upload', 'uses'=> $module_controller.'other_file_upload']);
	            Route::post('/store_upload_file',			['as'=>$route_slug.'store_upload_file', 'uses'=> $module_controller.'store_upload_file']);

	            Route::any('/generate_medical_certificate/store', ['as'=>$route_slug.'generate_medical_certificate_store', 'uses'=> $module_controller.'generate_medical_certificate_store']);
	            Route::any('/generate/generate_medical_certificate_pdf', ['as'=>$route_slug.'generate_medical_certificate_pdf', 'uses'=> $module_controller.'generate_medical_certificate_pdf']);
	            Route::any('/generate_medical_certificate/{enc_id}', ['as'=>$route_slug.'generate_medical_certificate', 'uses'=> $module_controller.'generate_medical_certificate']);
		    });
		    /*------------------------------------------ tool ends here ------------------------------------------*/


			/*------------------------------------------ chat starts here ------------------------------------------*/
			Route::group(['prefix'=>'chats','middleware' =>'auth_doctor'],function()
		    {
	            $route_slug        = "chat";
	            $module_controller = "Front\Doctor\ChatController@";

	            Route::any('/{enc_id}',		['as'=>$route_slug.'create_channel', 'uses'=> $module_controller.'create_channel']);
	            Route::any('/send/message',	['as'=>$route_slug.'send_message', 'uses'=> $module_controller.'send_message']);
	            Route::any('/get/messages',	['as'=>$route_slug.'get_messages', 'uses'=> $module_controller.'get_messages']);
	            Route::any('/patient_chat',	['as'=>$route_slug.'patient_chat', 'uses'=> $module_controller.'patient_chat']);
	            Route::any('/get/{enc_id}',	['as'=>$route_slug.'get', 'uses'=> $module_controller.'create_channel_or_get_message']);
				Route::any('/virgil/store',		['as'=>$route_slug.'virgil', 'uses'=> $module_controller.'virgil']);

	            //Route::any('/patient_chat',	function(){ dd('here'); });

		    });
		    /*------------------------------------------ chat ends here ------------------------------------------*/


		});

		/*------------------------------------------ My patients ends here ------------------------------------------*/


		/*------------------------------------------ Membership starts here ------------------------------------------*/

		  Route::group(['prefix'=>'membership','middleware' =>'auth_doctor'],function()
	      {

	            $route_slug        = "membership";
	            $module_controller = "Front\Doctor\MembershipController@";
	            

	            /*standard membership*/
	            Route::get('/standard',['as'=>$route_slug, 'uses'=> $module_controller.'standard']);
	          
	            /*premium membership*/
	            Route::get('/premium',['as'=>$route_slug, 'uses'=> $module_controller.'premium']);

	            /*other route*/
	            Route::get('/select_membership',['as'=>$route_slug, 'uses'=> $module_controller.'select_membership']);

	            /*Membership payment*/
	            Route::any('/payment',['as'=>$route_slug, 'uses'=> $module_controller.'payment']);

	            /*Card details store*/
	            Route::any('/payment_method',['as'=>$route_slug, 'uses'=> $module_controller.'payment_method']);

	            /*Membership payment*/
	            Route::any('/store',['as'=>$route_slug, 'uses'=> $module_controller.'store_membership']);


	            /* tushar */

	            Route::any('/store_fees',['as'=>$route_slug, 'uses'=> $module_controller.'store_membership_ta']);

                /* tushar */


	            Route::any('/cancel',['as'=>$route_slug, 'uses'=> $module_controller.'cancel_next_month_membership']);
	            Route::any('/get_membership',['as'=>$route_slug, 'uses'=> $module_controller.'get_next_month_membership']);


				Route::any('/store_day_rate',	['as'=>$route_slug.'store_day_rate', 'uses'=> $module_controller.'store_day_rate']);
				Route::any('/store_night_rate',	['as'=>$route_slug.'store_night_rate', 'uses'=> $module_controller.'store_night_rate']);
				Route::any('/billing',			['as'=>$route_slug.'billing', 'uses'=> $module_controller.'billing']);
				Route::any('/invoice/{enc_id}',	['as'=>$route_slug.'invoice', 'uses'=> $module_controller.'invoice']);
				Route::any('/invoice/download/{enc_id}',['as'=>$route_slug.'invoice_download', 'uses'=> $module_controller.'invoice_download']);
				Route::any('/generate_membership_invoice_pdf',['as'=>$route_slug.'invoice_download', 'uses'=> $module_controller.'generate_membership_invoice_pdf']);

				Route::any('/delete_doctor_fees',['as'=>$route_slug.'delete_doctor_fees', 'uses'=> $module_controller.'delete_doctor_fees']);
				Route::any('/edit_doctor_fees',['as'=>$route_slug.'edit_doctor_fees', 'uses'=> $module_controller.'edit_doctor_fees']);

				Route::any('/check_voucher_code_available',['as'=>$route_slug.'check_voucher_code_available', 'uses'=> $module_controller.'check_voucher_code_available']);


	      });

	    /*------------------------------------------ Membership ends here ------------------------------------------*/


	    /*------------------------------------------ Billing starts here ------------------------------------------*/

		  Route::group(['prefix'=>'billing','middleware' =>'auth_doctor'],function()
	      {

	        	$route_slug        = "billing";
	            $module_controller = "Front\Doctor\BillingController@";
	            
	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
	            Route::get('/view/{enc_id}',['as'=>$route_slug, 'uses'=> $module_controller.'consultation_invoice']);
	            Route::any('/invoice/download/{enc_id}',['as'=>$route_slug.'invoice_download', 'uses'=> $module_controller.'invoice_download']);
				Route::any('/generate_invoice_pdf',['as'=>$route_slug.'invoice_download', 'uses'=> $module_controller.'generate_invoice_pdf']);
	            Route::get('/bank_account',['as'=>$route_slug, 'uses'=> $module_controller.'bank_account']);
	           	Route::get('/bank_account/connect',['as'=>$route_slug, 'uses'=> $module_controller.'bank_account']);
	            Route::any('/update_bank_details',['as'=>$route_slug, 'uses'=> $module_controller.'update_bank_details']);
	           	
	           	Route::any('/bank_account/{msg}',['as'=>$route_slug, 'uses'=> $module_controller.'stripe_msg']);
	           	Route::any('/unset_session',['as'=>$route_slug, 'uses'=> $module_controller.'unset_session']);


	            Route::get('/my_discount',['as'=>$route_slug, 'uses'=> $module_controller.'my_discount']);
	            Route::post('/store',['as'=>$route_slug, 'uses'=> $module_controller.'store']);
	            Route::any('/get_shared_patients',['as'=>$route_slug, 'uses'=> $module_controller.'get_shared_patients']);

	            Route::any('/update_codes',['as'=>$route_slug, 'uses'=> $module_controller.'update_codes']);
	            Route::any('/delete_codes',['as'=>$route_slug, 'uses'=> $module_controller.'delete_codes']);
	            Route::any('/search_patient_name',['as'=>$route_slug.'search_patient_name', 'uses'=> $module_controller.'search_patient_name']);
	            Route::any('/search_patient',['as'=>$route_slug.'search_patient', 'uses'=> $module_controller.'search_patient']);
	            Route::any('/share_code/{enc_id}',['as'=>$route_slug.'share_code', 'uses'=> $module_controller.'share_code']);
	            	            	         
	      });

	    /*------------------------------------------ Billing ends here ------------------------------------------*/


	    /*--------------------  Payment methods start  -------------------------*/
		Route::group(['prefix'=>'settings/card', 'middleware' =>'auth_doctor'],function()
		{
			$route_slug        = "card_";
			$module_controller = "Front\Doctor\CardController@";

			Route::any('/list',						['as'=>$route_slug.'list','uses'=>$module_controller.'listing']);
			Route::any('/store',					['as'=>$route_slug.'store','uses'=>$module_controller.'store']);
			Route::any('/delete',					['as'=>$route_slug.'delete','uses'=>$module_controller.'delete']);
		});
		/*--------------------  Payment methods end  -------------------------*/


	    /*------------------------------------------ video chat starts here ------------------------------------------*/
		Route::group(['prefix'=>'video','middleware' =>'auth_doctor'],function()
	    {
            $route_slug        = "video";
            $module_controller = "Front\Doctor\VideoChatController@";

            Route::get('/{enc_id}',			['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);
            Route::any('status',	['as'=>$route_slug.'update_video_call_status', 'uses'=> $module_controller.'update_video_call_status']);
            Route::get('connect_video/{enc_id}', ['as'=>$route_slug.'connect_video', 'uses'=> $module_controller.'connect_video']);
            Route::any('check_patient_active',			['as'=>$route_slug.'check_patient_active', 'uses'=> $module_controller.'check_patient_active']);

            Route::any('update_video_call_end_status',			['as'=>$route_slug.'update_video_call_end_status', 'uses'=> $module_controller.'update_video_call_end_status']);
            Route::any('update_video_call_reject_status',			['as'=>$route_slug.'update_video_call_reject_status', 'uses'=> $module_controller.'update_video_call_reject_status']);
            Route::any('update_video_call_time',			['as'=>$route_slug.'update_video_call_time', 'uses'=> $module_controller.'update_video_call_time']);

	    });
	    /*------------------------------------------ video chat ends here ------------------------------------------*/


	    /*------------------------------------------ Profile starts here ------------------------------------------*/

		  	Route::group(['prefix'=>'my_profile','middleware' =>'auth_doctor'],function()
	      	{

	            $route_slug        = "my_profile_";
	            $module_controller = "Front\Doctor\ProfileController@";

	            Route::any('/about_yourself',		 ['as'=>$route_slug.'about_yourself', 'uses'=> $module_controller.'about_yourself']);
	            Route::any('/update_about_yourself', ['as'=>$route_slug.'update_about_yourself', 'uses'=> $module_controller.'update_about_yourself']);

	            Route::any('/your_medical_practice', 		['as'=>$route_slug.'your_medical_practice', 'uses'=> $module_controller.'your_medical_practice']);
	            Route::any('/update_your_medical_practice',	['as'=>$route_slug.'update_your_medical_practice', 'uses'=> $module_controller.'update_your_medical_practice']);

	            Route::any('/your_medical_qualifications',	['as'=>$route_slug.'your_medical_qualifications', 'uses'=> $module_controller.'your_medical_qualifications']);
	            Route::any('/update_your_medical_qualifications',['as'=>$route_slug.'update_your_medical_qualifications', 'uses'=> $module_controller.'update_your_medical_qualifications']);

	            Route::any('/official_documents_verification',	['as'=>$route_slug.'official_documents_verification', 'uses'=> $module_controller.'official_documents_verification']);
	            Route::any('/update_official_documents_verification', ['as'=>$route_slug.'update_official_documents_verification', 'uses'=> $module_controller.'update_official_documents_verification']);

	            Route::any('/personalise_your_profile_for_patients', ['as'=>$route_slug.'personalise_your_profile_for_patients', 'uses'=> $module_controller.'personalise_your_profile_for_patients']);
	            Route::any('/update_personalise_your_profile_for_patients', ['as'=>$route_slug.'update_personalise_your_profile_for_patients', 	'uses'=> $module_controller.'update_personalise_your_profile_for_patients']);

	            

	      	});

	    /*------------------------------------------ Profile ends here ------------------------------------------*/



	    /*------------------------------------------ Pharmacies starts here ------------------------------------------*/

		  	Route::group(['prefix'=>'pharmacies','middleware' =>'auth_doctor'],function()
	      	{

	            $route_slug        = "pharmacies_";
	            $module_controller = "Front\Doctor\PharmaciesController@";

	            Route::any('/',		 	['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);
	            Route::any('/search',	['as'=>$route_slug.'search', 'uses'=> $module_controller.'search']);
	            
	      	});

	    /*------------------------------------------ Pharmacies ends here ------------------------------------------*/



	    /*------------------------------------------ Messages starts here ------------------------------------------*/

		  	Route::group(['prefix'=>'messages','middleware' =>'auth_doctor'],function()
	      	{

	            $route_slug        = "messages_";
	            $module_controller = "Front\Doctor\MessagesController@";

	            Route::any('/',		 ['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);

	            //Route::any('/patient',	['as'=>$route_slug.'patient', 'uses'=> $module_controller.'patient']);
	      	});

	    /*------------------------------------------ Messages ends here ------------------------------------------*/



	    /*------------------------------------------ Setting starts here ------------------------------------------*/

	    	Route::group(['prefix'=>'settings','middleware' =>'auth_doctor'],function()
	      	{

	            $route_slug        = "settings_";
	            $module_controller = "Front\Doctor\SettingsController@";

	            Route::any('/',		 ['as'=>$route_slug.'index', 'uses'=> $module_controller.'index']);

	            /*------------------------------------------ Password and Email starts here ------------------------------------------*/

	            Route::any('/email_and_password',	 ['as'=>$route_slug.'index', 'uses'=> $module_controller.'email_and_password']);
	            Route::any('/password/reset',		 ['as'=>$route_slug.'index', 'uses'=> $module_controller.'password_reset']);
	            Route::any('/password/update',		 ['as'=>$route_slug.'index', 'uses'=> $module_controller.'password_update']);

	            /*------------------------------------------ Password and Email ends here ------------------------------------------*/


	            /*------------------------------------------ Notification starts here ------------------------------------------*/

	            Route::any('/notification',		 	 ['as'=>$route_slug.'notification', 'uses'=> $module_controller.'notification']);
	            Route::any('/store_notification',	 ['as'=>$route_slug.'store_notification', 'uses'=> $module_controller.'store_notification']);

	            /*------------------------------------------ Notification ends here ------------------------------------------*/

	            /*------------------------------------------  Invitation credit & codes start------------------------------------------*/

				Route::any('/invitation',			['as'=>$route_slug.'invitation','uses'=>$module_controller.'invitation']);
				Route::any('/invitation/patient',	['as'=>$route_slug.'invitation/patient','uses'=>$module_controller.'patient_invitation']);
				Route::any('/invitation/patient/check',	['as'=>$route_slug.'invitation/patient/check','uses'=>$module_controller.'check_patient_invitation_mail']);
				Route::any('/invitation/doctor',	['as'=>$route_slug.'invitation/doctor','uses'=>$module_controller.'doctor_invitation']);
				Route::any('/invitation/doctor/check',	['as'=>$route_slug.'invitation/doctor/check','uses'=>$module_controller.'check_doctor_invitation_mail']);
				Route::any('/invitation/pharmacy',	['as'=>$route_slug.'invitation/pharmacy','uses'=>$module_controller.'pharmacy_invitation']);
				Route::any('/invitation/pharmacy/check',	['as'=>$route_slug.'invitation/doctor/check','uses'=>$module_controller.'check_pharmacy_invitation_mail']);

				/*------------------------------------------  Invitation credit & codes end ------------------------------------------*/

				/*------------------------------------------  Disputes start ------------------------------------------*/
				
				Route::any('/disputes',				['as'=>$route_slug.'disputes', 'uses'=>$module_controller.'disputes']);
				Route::any('/disputes/open',		['as'=>$route_slug.'disputes_open', 'uses'=>$module_controller.'disputes_open']);
				Route::any('/disputes/closed',		['as'=>$route_slug.'disputes_closed', 'uses'=>$module_controller.'disputes_closed']);

				Route::any('/disputes/store',		['as'=>$route_slug.'disputes_store',	'uses'=>$module_controller.'disputes_store']);
				Route::any('/disputes/against_user',['as'=>$route_slug.'against_user',	'uses'=>$module_controller.'dispute_against_user']);
				Route::any('/disputes/comments',	['as'=>$route_slug.'comments',	'uses'=>$module_controller.'dispute_comments']);
				Route::any('/disputes/comments/send',['as'=>$route_slug.'comments_send',	'uses'=>$module_controller.'dispute_comments_store']);
				/*Route::any('/disputes/view',		['as'=>$route_slug.'disputes_view',		'uses'=>$module_controller.'disputes_view']);
				Route::any('/disputes/status',		['as'=>$route_slug.'disputes_status',	'uses'=>$module_controller.'disputes_status']);*/

			/*------------------------------------------ Disputes end -------------------------------------------*/	

			

				/*------------------------------------------  Help and support start------------------------------------------*/

						/*----------------------------------  Feedback start ----------------------------------*/

				Route::any('/feedback',				['as'=>$route_slug.'feedback','uses'=>$module_controller.'feedback']);
				Route::any('/feedback/store',		['as'=>$route_slug.'feedback_store','uses'=>$module_controller.'feedback_store']);

			             /*---------------------------------  Feedback end -------------------------------------*/

				Route::any('/faq',					['as'=>$route_slug.'invitation','uses'=>$module_controller.'faq_categories']);
				Route::any('/faqs/{id}/{faq_id?}',	['as'=>$route_slug.'faq','uses'=>$module_controller.'faq']);
				Route::any('/faq/search_faq',		['as'=>$route_slug.'search_faq','uses'=>$module_controller.'search_faq']);
				Route::any('/enquiry_msg',			['as'=>$route_slug.'enquiry_msg','uses'=>$module_controller.'enquiry_msg']);
				Route::any('/legal',				['as'=>$route_slug.'legal','uses'=>$module_controller.'legal']);
				Route::get('{slug}', 				['uses' => $module_controller.'dynamic_pages'])->where('slug', '([A-Za-z0-9\-\/]+)');

				/*------------------------------------------  Help and support end ------------------------------------------*/


				/*--------------------  Camera & Internet Pre-call Test start-------------------------*/		

				Route::any('/camera_and_internet_test',	['as'=>$route_slug.'camera_and_internet_test','uses'=>$module_controller.'camera_and_internet_test']);

				/*--------------------  Camera & Internet Pre-call Test end-------------------------*/	
	      	});

	    /*------------------------------------------ Setting ends here ------------------------------------------*/

	    Route::any('/continue_session',	   ['as'=>$route_slug.'continue_session', 'uses'=>'Front\Doctor\DashboardController@continue_session']);
				

		/*------------------------------------------ New Doctor End ------------------------------------------*/

		 /*routes for deleting an account */
		Route::get('/delete',			       ['as'=>$route_slug.'delete',	  'uses'=>$module_controller.'delete_account']);


		Route::get('/thanks',			       ['as'=>$route_slug.'thanks',	  	  'uses'=>$module_controller.'thanks']);
		Route::get('/verify/{enc_id}/{token}', ['as'=>$route_slug.'verify',	      'uses'=>$module_controller.'verify']);
		Route::get('error/{msg?}',              ['as'=>$route_slug.'error',        'uses'=>$module_controller.'error']);
		Route::get('success/{msg}',            ['as'=>$route_slug.'success',      'uses'=>$module_controller.'success']);

        //Route::get('thankyou',                 ['as'=>$route_slug.'thankyou',     'uses'=>$module_controller.'thankyou']);


	    Route::any('/signin',	               ['as'=>$route_slug.'signin',		  'uses'=>$module_controller.'login']);
        Route::get('/resend_verification_mail/{enc_id}',	       ['as'=>$route_slug.'resend_verification_mail','uses'=>$module_controller.'resend_verification_mail']);
        Route::get('/setpassword/{enc_id}',	   ['as'=>$route_slug.'setpassword',  'uses'=>$module_controller.'setpassword']);
        Route::post('/verify_setpassword',	   ['as'=>$route_slug.'signin',		  'uses'=>$module_controller.'verify_setpassword']);
	    

          /* prefernces route */
	      Route::group(['prefix'=>'preference','middleware' =>'auth_doctor'],function()
	      {

	            $route_slug        = "preference_";
	            $module_controller = "Front\Doctor\PreferenceController@";

	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
	            Route::post('/create',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'store']);
	      });

	       /*history route */
	      Route::group(['prefix'=>'history','middleware' =>'auth_doctor'],function()
	      {

	            $route_slug        = "history_";
	            $module_controller = "Front\Doctor\HistoryController@";
	            
	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
	         
	      });

	      /* Appoinment route */
	      Route::group(['prefix'=>'appointment','middleware' =>'auth_doctor'],function()
	      {
	            $route_slug        = "appointment_";
	            $module_controller = "Front\Doctor\AppointmentController@";
				
				Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
				Route::post('/create',['as'=>$route_slug, 'uses'=> $module_controller.'create']);
				Route::post('/update',['as'=>$route_slug, 'uses'=> $module_controller.'update']);
	           
	      });

	         /* invitation route */
	      Route::group(['prefix'=>'invitation','middleware' =>'auth_doctor'],function()
	      {

	            $route_slug        = "invitation_";
	            $module_controller = "Front\Doctor\InvitationController@";

	            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);

	            Route::post('/create',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'store']);
	            Route::post('/create_doctor_invitation',['as'=>$route_slug.'create_doctor_invitation', 'uses'=> $module_controller.'store_doctor_invitation']);
	            Route::post('/create_pharmacy_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_pharmacy_invitation']);
	            Route::post('/create_patient_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_patient_invitation']);
	            
	      });


		/*consultation booking status*/
		Route::group(array('prefix' => '/consultation','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "consultation";
			$module_controller = "Front\Doctor\ConsultationController@";

			Route::get('/',['as'=>$route_slug.'status', 'uses'=>$module_controller.'index']);
			Route::get('/change_status/{enc_id}/{type}',['as'=>$route_slug.'status', 'uses'=>$module_controller.'change_booking_status']);
			Route::get('/details/{enc_id}/{familiy_enc_id?}/{status?}',['as'=>$route_slug.'details','uses'=>$module_controller.'show_consultation_details']);
			Route::post('/offer_another_time/',['as'=>$route_slug.'offer_another_time','uses'=>$module_controller.'offer_another_time']);
			Route::get('/download/{enc_id}',['as'=>$route_slug.'download','uses'=>$module_controller.'download_precription']);
			Route::get('/call/{enc_id}',	['as'=>$route_slug.'start_consultation', 'uses'=>$module_controller.'start_consultation']);

			Route::get('/host/{enc_id}', 			['as'=>$route_slug.'host', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/participant', 		['as'=>$route_slug.'participant', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/history1', 		['as'=>$route_slug.'history1', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/start', 			['as'=>$route_slug.'start', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/stop/{enc_id}', 	['as'=>$route_slug.'stop', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/download/{enc_id}',['as'=>$route_slug.'download', 'uses'=>$module_controller.'start_consultation']);
	   		Route::get('/delete/{enc_id}', 	['as'=>$route_slug.'delete', 'uses'=>$module_controller.'start_consultation']);
	    });

	   /*=================Answer a Question ===========================*/		

	   Route::group(array('middleware'=>'auth_doctor'), function()
	    {

	    	$route_slug        = "answer_a_question_";
			$module_controller = "Front\Doctor\AnswerAQuestionController@";

			Route::get('/answer-a-question',   	       ['as'=>$route_slug.'answer-a-question', 'uses'=>$module_controller.'index']);
			Route::get('/answer-a-question/{enc_id}',  ['as'=>$route_slug.'detail',            'uses'=>$module_controller.'details']);
			Route::post('/reply/{enc_id}',             ['as'=>$route_slug.'reply',             'uses'=>$module_controller.'reply']);
			Route::get('/download/{enc_id}',           ['as'=>$route_slug.'download',          'uses'=>$module_controller.'download']);
		});

	   Route::group(array('middleware'=>'auth_doctor'),function(){

	   		$route_slug        = "video_";
			$module_controller = "Front\CallTestController@";
	   		Route::get('/start_consultation', 			['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		
	   		$route_slug        = "video_";
			$module_controller = "Front\CallTestController1@";
	   		Route::get('/start_consultation1', 	['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/host', 				['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/participant', 			['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/history1', 			['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/start', 				['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/stop/{enc_id}', 		['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/download/{enc_id}', 	['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   		Route::get('/delete/{enc_id}', 		['as'=>$route_slug.'consultation', 'uses'=>$module_controller.'index']);
	   });
	});
?>