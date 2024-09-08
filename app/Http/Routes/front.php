<?php
	Route::group(['middleware' =>'front_general'],function()
	{
	  	$route_slug        = "front_";
	  	$module_controller = "Front\AuthController@";
			  
	  	Route::get('logout/{msg?}',                  			 ['as'=>$route_slug.'logout',    'uses'=> $module_controller.'logout']);
	  	Route::get('thankyou/{msg}/{msg1?}',    				 ['as'=>$route_slug.'thankyou',  'uses'=> $module_controller.'thankyou']);
	    /*routes for deleting an account */
		Route::post('/close_account',		   					 ['as'=>$route_slug.'close_account',	'uses'=>$module_controller.'close_account']);
		Route::get('/send_notification/{token}/{message}',       ['as'=>$route_slug.'success', 			'uses'=>'Front\SendNotificationController@sendPushNotificationToGCMSever']);
	    Route::any('/forgotpassword',	                		 ['as'=>$route_slug."forgotpassword", 	'uses'=>$module_controller.'forgotpassword']);
		Route::get('/resetpassword/{enc_id}',					 ['as'=>$route_slug."resetpassword",  	'uses'=>$module_controller.'resetpassword']);
		Route::post('/store_resetpassword/{enc_id}',			 ['as'=>$route_slug."store_resetpassword", 	'uses'=>$module_controller.'store_resetpassword']);
		Route::any('/forgotpassword/verify_otp',	             ['as'=>$route_slug."forgotpassword", 	'uses'=>$module_controller.'verify_otp_forget_password']);
		Route::any('/forgotpassword/resend_otp',	             ['as'=>$route_slug."forgotpassword", 	'uses'=>$module_controller.'resend_otp']);
	    
	    /*routes for deleting an account */
		Route::any('/publish/card',	 							 ['as'=>$route_slug."publish card", 'uses'=>$module_controller.'transmitToServer' ]);
	});

?>