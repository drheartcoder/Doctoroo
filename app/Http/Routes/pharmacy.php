<?php

	Route::group(['prefix'=>'pharmacy', 'middleware' =>'front_general'],function()
	{

		    $route_slug        = "pharmacy_";
		    $module_controller = "Front\Pharmacy\AuthController@";
	
      	Route::get('/',                                ['as'=>$route_slug.'index',	'uses'=> $module_controller.'index']);
        Route::post('/login',                          ['as'=>$route_slug.'login',  'uses'=> $module_controller.'login']);
        Route::get('/is_email_exist/{email}',          ['as'=>$route_slug.'is_email_exist',  'uses'=> $module_controller.'is_email_exist']);
    	  Route::get('signup_step1/{token_enc_id}/{enc_id?}',['as'=>$route_slug.'signup_step1','uses'=> $module_controller.'signup_step1']);
        Route::get('/resend_verification_mail/{enc_id}',['as'=>$route_slug.'resend_verification_mail', 'uses'=> $module_controller.'resend_verification_mail']);
      	Route::post('store_signup_step1',              ['as'=>$route_slug.'store_signup_step1',  'uses'=> $module_controller.'store_signup_step1']);
    	  Route::get('signup_step2/{enc_id}/{flag?}',    ['as'=>$route_slug.'signup_step2',  'uses'=> $module_controller.'signup_step2']);
    	  Route::post('store_signup_step2',              ['as'=>$route_slug.'store_signup_step2',  'uses'=> $module_controller.'store_signup_step2']);
    	  Route::get('signup_step3/{enc_id}',            ['as'=>$route_slug.'signup_step3',  'uses'=> $module_controller.'signup_step3']);
    	  Route::post('store_signup_step3',              ['as'=>$route_slug.'store_signup_step3',  'uses'=> $module_controller.'store_signup_step3']);
    	  Route::get('thank_you/{msg}/{msg1?}/{msg2?}',  ['as'=>$route_slug.'thank_you',  'uses'=> $module_controller.'thank_you']);
        Route::get('error/{msg}',                      ['as'=>$route_slug.'error',  'uses'=> $module_controller.'error']);
        Route::get('verify/{enc_id}/{token}',          ['as'=>$route_slug.'verify', 'uses'=> $module_controller.'verify']);


         /*routes for deleting an account */
        Route::get('/delete',            ['as'=>$route_slug.'delete',   'uses'=>$module_controller.'delete_account']);

        Route::get('location_listing',                 ['as'=>$route_slug.'location_listing', 'uses'=> $module_controller.'location_listing']);

        
        Route::group(['middleware'=>'auth_pharmacy'],function()
        {
          /* profile route */
           $route_slug         = "pharmacy_profile";
           $module_controller  = "Front\Pharmacy\ProfileController@";
         
          Route::get('/dashboard',           ['as'=>$route_slug.'dashboard',           'uses'=> $module_controller.'index']);
          Route::get('/change_password',     ['as'=>$route_slug.'change_password',           'uses'=> $module_controller.'change_password']);

          Route::get('/profile_step1',        ['as'=>$route_slug.'profile_step1',      'uses'=> $module_controller.'profile_step1']);
   
          Route::post('/update_profile_step1',['as'=>$route_slug.'update_profile_step1','uses'=> $module_controller.'update_profile_step1']);

          Route::get('/profile_step2',        ['as'=>$route_slug.'profile_step2',       'uses'=> $module_controller.'profile_step2']);

          Route::post('/update_profile_step2',['as'=>$route_slug.'update_profile_step2','uses'=> $module_controller.'update_profile_step2']);

          Route::get('/profile_step3',       ['as'=>$route_slug.'profile_step3',         'uses'=> $module_controller.'profile_step3']);

          Route::post('/update_profile_step3',['as'=>$route_slug.'update_profile_step3', 'uses'=> $module_controller.'update_profile_step3']);

          Route::post('/update_password',['as'=>$route_slug.'update_password', 'uses'=> $module_controller.'update_password']);
        });


        
      /* prefernces route */
      Route::group(['prefix'=>'preference','middleware'=>'auth_pharmacy'],function()
      {

            $route_slug        = "prefernces_";
            $module_controller = "Front\Pharmacy\PreferenceController@";

            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);
            Route::post('/create',['as'=>$route_slug.'preference', 'uses'=> $module_controller.'store']);
      });

      /* invitation route */
      Route::group(['prefix'=>'invitation','middleware'=>'auth_pharmacy'],function()
      {

            $route_slug        = "invitation_";
            $module_controller = "Front\Pharmacy\InvitationController@";


            Route::get('/',['as'=>$route_slug, 'uses'=> $module_controller.'index']);

            Route::post('/create',['as'=>$route_slug.'prefernces', 'uses'=> $module_controller.'store']);

            Route::post('/create_doctor_invitation',['as'=>$route_slug.'create_doctor_invitation', 'uses'=> $module_controller.'store_doctor_invitation']);

            Route::post('/create_pharmacy_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_pharmacy_invitation']);

            Route::post('/create_patient_invitation',['as'=>$route_slug.'create_pharmacy_invitation', 'uses'=> $module_controller.'store_patient_invitation']);
      });

  });