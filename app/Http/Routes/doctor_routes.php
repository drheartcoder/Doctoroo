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

	Route::group(['prefix'=>'doctor'],function()
	{

		$route_slug        = "doctor_";
		$module_controller = "Front\Doctor\AuthController@";

		Route::get('/',						   ['as'=>$route_slug.'index',		  'uses'=>$module_controller.'index']);
		Route::get('/duplicate/email',	       ['as'=>$route_slug.'duplicate',	  'uses'=>$module_controller.'duplicate']);
		Route::post('/signup/store',	       ['as'=>$route_slug.'signup_store', 'uses'=>$module_controller.'store_signup']);
		Route::get('/thankyou',			       ['as'=>$route_slug.'thankyou',	  'uses'=>$module_controller.'thankyou']);

		 /*routes for deleting an account */
		Route::get('/delete',			       ['as'=>$route_slug.'delete',	  'uses'=>$module_controller.'delete_account']);


		Route::get('/thanks',			       ['as'=>$route_slug.'thanks',	  	  'uses'=>$module_controller.'thanks']);
		Route::get('/verify/{enc_id}/{token}', ['as'=>$route_slug.'verify',	      'uses'=>$module_controller.'verify']);
		Route::get('error/{msg?}',              ['as'=>$route_slug.'error',        'uses'=>$module_controller.'error']);
		Route::get('success/{msg}',            ['as'=>$route_slug.'success',      'uses'=>$module_controller.'success']);

        //Route::get('thankyou',                 ['as'=>$route_slug.'thankyou',     'uses'=>$module_controller.'thankyou']);


	    Route::post('/signin',	               ['as'=>$route_slug.'signin',		  'uses'=>$module_controller.'login']);
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

	      /* Appoinment route */
	      Route::group(['prefix'=>'appointment','middleware' =>'auth_doctor'],function()
	      {

	            $route_slug        = "appointment_";
	            $module_controller = "Front\Doctor\AppointmentController@";
				
				Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
				Route::post('/create',['as'=>$route_slug, 'uses'=> $module_controller.'create']);
	           
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

	      
	    /*profile routes start from here */		
		Route::group(array('prefix' => '/profile','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "doctor_profile";
			$module_controller = "Front\Doctor\ProfileController@";


			Route::get('/dashboard',	       ['as'=>$route_slug.'dashboard', 'uses'=>'Front\Doctor\DashboardController@index']);
			
			Route::get('/step1',	           ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'profile_step1']);
			Route::post('/update_step1',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'update_profile_step1']);
			Route::get('/step2',	           ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'profile_step2']);
			Route::post('/update_step2',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'update_profile_step2']);
			Route::get('/step3',	           ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'profile_step3']);
			Route::post('/update_step3',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'update_profile_step3']);

			Route::get('/download/{type}',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'download_certificate']);
			Route::get('/change_password',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'change_password']);
			Route::post('/update_password',	   ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'update_password']);


		});

		/*consultation booking status*/
		Route::group(array('prefix' => '/booking','middleware'=>'auth_doctor'), function()
	    {
	    	$route_slug        = "booking";
			$module_controller = "Front\Doctor\ConsultationController@";

			Route::get('/change_status/{enc_id}/{type}',['as'=>$route_slug.'status', 'uses'=>$module_controller.'change_booking_status']);

			Route::get('/details/{enc_id}',['as'=>$route_slug.'details','uses'=>$module_controller.'show_booking_details']);

			Route::post('/offer_another_time/',['as'=>$route_slug.'offer_another_time','uses'=>$module_controller.'offer_another_time']);
			
	    });

		/*========================================My Patients====================================================================*/

		Route::group(array('middleware'=>'auth_doctor'), function()
	    {

	    	$route_slug        = "doctoroo_patient";
			$module_controller = "Front\Doctor\MyPatientsController@";

			Route::get('mypatients/doctoroo',   	       ['as'=>$route_slug.'doctoroo', 'uses'=>$module_controller.'index']);
			Route::get('mypatients/{enc_id}',	           ['as'=>$route_slug.'mypatients', 'uses'=>$module_controller.'mypatients']);
			
		});

	   /*========================================Answer a Question ===============================================================*/		

	   Route::group(array('middleware'=>'auth_doctor'), function()
	    {

	    	$route_slug        = "answer_a_question_";
			$module_controller = "Front\Doctor\AnswerAQuestionController@";

			Route::get('/answer-a-question',   	       ['as'=>$route_slug.'answer-a-question', 'uses'=>$module_controller.'index']);
			Route::get('/answer-a-question/{enc_id}',  ['as'=>$route_slug.'detail',            'uses'=>$module_controller.'details']);
			Route::post('/reply/{enc_id}',             ['as'=>$route_slug.'reply',             'uses'=>$module_controller.'reply']);
			Route::get('/download/{enc_id}',           ['as'=>$route_slug.'download',          'uses'=>$module_controller.'download']);
			
			
			
		});
   
    
	});
?>