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

	$admin_path = config('app.project.admin_panel_slug');
	
	//Route::get('/','Front\HomeController@index');
	Route::get('/','Front\HomeController@coming_soon');
	Route::get('/ICareForYou','Front\HomeController@icareforyou');
	Route::get('/ICareForYou/{ICareForYou}', ['middleware' =>'front_general', 'as'=>"ICareForYou",'uses'=>'Front\HomeController@coming_soon']);
	Route::get('/index.php','Front\HomeController@coming_soon');
	Route::get('/home','Front\HomeController@coming_soon');


	Route::get('/import','Front\ImportController@import');
	Route::get('/process_import','Front\ImportController@process_import');


	/*--------------------------------------------------------------------------
                    UNLINK FAMILY MEMBBER 
	---------------------------------------------------------------------------*/

	Route::any('member_unlink_confirmation/{member_id}/{mail}',     ['as'=>'member-unlink','uses'=>'Front\Patient\SettingController@member_unlink_confirmation']);
	Route::any('/set_account_details/{member_id}',      			['as'=>'set_account_details','uses'=>'Front\Patient\SettingController@set_account_details']);
	Route::any('/family_members/account_details_set',      				['as'=>'account_details_set','uses'=>'Front\Patient\SettingController@account_details_set']);
	Route::any('/family_members/mobile_no_check',   				['as'=>"mobile_no_check",'uses'=>'Front\Patient\SettingController@mobile_no_check']);

	/*--------------------------------------------------------------------------*/
	

	Route::group(array('prefix' => '/cronjobs'), function()
    {
    	$route_slug       =  "";
    	$module_controller=  "Front\CronJobsController@";

    	Route::get('/get_stripe_connected_account', ['as' => $route_slug.'get_stripe_connected_account', 'uses' => $module_controller.'get_stripe_connected_account']);

    	Route::get('/consultation_notification', ['as' => $route_slug.'consultation_notification', 'uses' => $module_controller.'consultation_notification']);
    	Route::get('/consultation_notification_after_thirty_min', ['as' => $route_slug.'consultation_notification_after_thirty_min', 'uses' => $module_controller.'consultation_notification_after_thirty_min']);
    	
    });


	Route::group([],function() use($admin_path)
	{

		/* Admin Routes */
		Route::group(['prefix' => $admin_path,'middleware'=>['admin_general']], function () 
		{

			$route_slug        = "admin_auth_";
			$module_controller = "Admin\AuthController@";

			/* Admin Auth Routes Starts */
			Route::get('/',               	['as'=>$route_slug.'login',            'uses'=>$module_controller.'login']);	
			Route::get('login',           	['as'=>$route_slug.'login',            'uses'=>$module_controller.'login']);
			Route::any('process_login',   	['as'=>$route_slug.'process_login',    'uses'=>$module_controller.'process_login']);
			Route::any('otp_verification',  ['as'=>$route_slug.'otp_verification',    'uses'=>$module_controller.'otp_verification']);
			Route::any('verify_otp',  		['as'=>$route_slug.'verify_otp',    'uses'=>$module_controller.'verify_otp']);
			Route::any('resend_otp',  		['as'=>$route_slug.'resend_otp',    'uses'=>$module_controller.'resend_otp']);
			Route::any('forget_password/resend_otp',  		['as'=>$route_slug.'forget_password_resend_otp',    'uses'=>$module_controller.'forget_password_resend_otp']);
			Route::get('change_password', 	['as'=>$route_slug.'change_password',  'uses'=>$module_controller.'change_password']);
			Route::post('update_password',	['as'=>$route_slug.'update_password',  'uses'=>$module_controller.'update_password']);
			Route::any('/forget_password/verify_otp',  		['as'=>$route_slug.'verify_otp',    'uses'=>$module_controller.'forget_password_verify_otp']);
			Route::any('/forget_password/otp_verification',  		['as'=>$route_slug.'verify_otp',    'uses'=>$module_controller.'forget_password_otp_verification']);

			Route::any('/patient/send_otp_by_ajax', ['as'=>$route_slug.'send_otp_by_ajax', 'uses' => $module_controller.'send_otp_by_ajax']);
			Route::any('/verify_otp_by_ajax', ['as'=>$route_slug.'verify_otp_by_ajax', 'uses' => $module_controller.'verify_otp_by_ajax']);


			Route::post('forgot_password', ['as'=>$route_slug.'forgot_password',     'uses'=>$module_controller.'forgot_password']);
			Route::get('reset_password/{token}',['as'=>$route_slug.'reset_password','uses'=>$module_controller.'reset_password']);
			Route::post('reset_password/{enc_id}',['as'=>$route_slug.'update_reset_password','uses'=>$module_controller.'update_reset_password']);

			Route::group(['middleware'=>['authadmin']], function () 
			{
				$route_slug        = "admin_auth_";
				$module_controller = "Admin\AuthController@";

				/* Dashboard */
				Route::get('/dashboard',['as'=>$route_slug.'dashboard','uses'=>'Admin\DashboardController@index']);
				Route::get('/logout',   ['as'=>$route_slug.'logout',   'uses'=>$module_controller.'logout']);

				/*Account Settings*/
				$account_controller = "Admin\AccountSettingsController@";

				Route::get('account_settings', ['as'=>$route_slug.'account_settings_show','uses'=>$account_controller.'index']);
				Route::post('account_settings/update/{enc_id}', ['as' => $route_slug.'account_settings_update', 'uses' => $account_controller.'update']);

				/*Social links Settings*/
				$social_controller = "Admin\SocialLinksController@";
				Route::get('socialsettings', ['as' => $route_slug.'account_social_settings', 'uses' => $social_controller.'index']);
				Route::post('socialsettings/update', ['as' => $route_slug.'account_social_settings_update', 'uses' => $social_controller.'update']);

				/*Site Settings*/
				$site_controller = "Admin\SiteSettingsController@";
				Route::get('siteSettings', ['as' => $route_slug.'site_settings', 'uses' => $site_controller.'index']);
				Route::post('siteSettings/update', ['as' => $route_slug.'account_site_settings_update', 'uses' => $site_controller.'update']);
			

				/*Contact Enquiry*/
				$contact_enquiry_controller = "Admin\ContactEnquiryController@";
				Route::get('ContactEnquiry',                 ['as' => $route_slug.'contact_enquiry', 'uses' => $contact_enquiry_controller.'index']);
				Route::post('ContactEnquiry/manage',         ['as' => $route_slug.'account_site_settings_update', 'uses' => $contact_enquiry_controller.'update']);
				Route::get('ContactEnquiry/delete/{enc_id}', ['as' => $route_slug.'contact_enquiry', 'uses' => $contact_enquiry_controller.'delete']);
				Route::post('ContactEnquiry/multi_action',   ['as' => $route_slug.'multi_action',   'uses' => $contact_enquiry_controller.'multi_action']);
				Route::get('ContactEnquiry/reply/{enc_id}',  ['as' => $route_slug.'contact_enquiry', 'uses' => $contact_enquiry_controller.'reply']);
				Route::post('ContactEnquiry/send',           ['as' => $route_slug.'send',   'uses' => $contact_enquiry_controller.'send']);
				Route::get('ContactEnquiry/view/{enc_id}',   ['as' => $route_slug.'contact_enquiry', 'uses' => $contact_enquiry_controller.'view']);

				/*--------------------------------------Email Template--------------------------------------------------*/

				Route::group(array('prefix' => '/email_template'), function()
				{	
					$route_slug        = "admin_email_template_";
					$module_controller = "Admin\EmailTemplateController@";

					Route::get('/',				  ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
					Route::get('create/',		  ['as' => $route_slug.'create','uses' => $module_controller.'create']);
					Route::post('store/',		  ['as' => $route_slug.'store', 'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',	  ['as' => $route_slug.'edit',	 'uses' => $module_controller.'edit']);
					Route::get('view/{enc_id}',	  ['as' => $route_slug.'edit',	 'uses' => $module_controller.'view']);
					Route::post('update/{enc_id}',['as' => $route_slug.'update','uses' => $module_controller.'update']);
				});
				


				/*-------------------------------staic Pages(Seema)-----------------------------------------*/

				Route::group(array('prefix' => '/static_pages'), function()
				{
					$route_slug        = "static_pages_";
					$module_controller = "Admin\StaticPagesController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
				});
				/*------------------------------------------------Dynamic page------------------------------*/
				Route::group(array('prefix' => '/dynamic_pages'), function()
				{
					$route_slug        = "dynamic_pages_";
					$module_controller = "Admin\DynamicPagesController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::get('dynamicedit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'dynamicedit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::post('dynamicupdate/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'dynamicupdate']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
				});

				/*--------------------------------------------blog--------------------------------------------*/
				Route::group(array('prefix' => '/blog'), function()
				{
					$route_slug        = "blog_";
					$module_controller = "Admin\BlogController@";

					Route::get('/', 		          		 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::post('store',               		 ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('create',               		 ['as' => $route_slug.'create',    'uses' => $module_controller.'create']);
					Route::get('edit/{enc_id}',        		 ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',     	     ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('delete/{enc_id}',            ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::get('activate/{enc_id}',          ['as' => $route_slug.'activate',  'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',        ['as' => $route_slug.'deactivate', 'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',              ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
					Route::get('category',             		 ['as' => $route_slug.'category',    'uses' => $module_controller.'category']);
					Route::get('create_category',            ['as' => $route_slug.'category',    'uses' => $module_controller.'createcategory']);
					Route::post('storecategory',             ['as' => $route_slug.'store',    'uses' => $module_controller.'storecategory']);
					Route::get('edit_category/{enc_id}',     ['as' => $route_slug.'edit',     'uses' => $module_controller.'editcategory']);
					Route::post('updatecategory/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'updatecategory']);
					Route::get('deletecategory/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'deletecategory']);
					Route::get('activatecategory/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activatecategory']);
					Route::get('deactivatecategory/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivatecategory']);
					Route::post('multiaction_category',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multiaction_category']);
				});


				/*------------------------------pricingplan&pricingtable-(Ankit)-------------------------*/
				Route::group(array('prefix' => '/pricingplan'), function()
				{
					$route_slug        = "pricingplan_";
					$module_controller = "Admin\PricingPlanController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::post('update',			 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
					Route::post('store',			 ['as' => $route_slug.'store',	  'uses' => $module_controller.'store']);
					Route::post('updatenote',			 ['as' => $route_slug.'updatenote',	  'uses' => $module_controller.'updatenote']);
					//Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
				});

				/*------------------------------Managefees-----------------------------*/
				Route::group(array('prefix' => '/managefees'), function()
				{
					$route_slug        = "managefees_";
					$module_controller = "Admin\ManageFeesController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::post('update',			 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
				});


				/*------------------------------consultationprice-----------------------------*/
				Route::group(array('prefix' => '/consultationprice'), function()
				{
					$route_slug        = "consultationprice_";
					$module_controller = "Admin\ConsultationPriceController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  		'uses' => $module_controller.'index']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     		'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',   		'uses' => $module_controller.'update']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',	'uses' => $module_controller.'multi_action']);
				});


				/*------------------------------doctor consultation prices-----------------------------*/
				Route::group(array('prefix' => '/doctor_consultation_prices'), function()
				{
					$route_slug        = "doctorbookingprices_";
					$module_controller = "Admin\DoctorBookingPricesController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  		'uses' => $module_controller.'index']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     		'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',			'uses' => $module_controller.'update']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',	'uses' => $module_controller.'multi_action']);
				});

				/*------------------------------ doctor time interval -----------------------------*/
				Route::group(array('prefix' => 'doctor/time_interval'), function()
				{
					$route_slug        = "doctor";
					$module_controller = "Admin\DoctorTimeIntervalController@";

					Route::get('/', 	 ['as' => $route_slug.'time_interval',	           'uses' => $module_controller.'index']);
					Route::any('/edit',  ['as' => $route_slug.'time_interval',	           'uses' => $module_controller.'edit']);

				});


				/*-----------------------------------------doctor-------------------------*/
				Route::group(array('prefix' => 'doctor'), function()
				{
					$route_slug        = "doctor";
					$module_controller = "Admin\DoctorController@";

					Route::get('verifieddoctor', 	 ['as' => $route_slug.'manage',	           'uses' => $module_controller.'index']);

					Route::get('applications',		 ['as' => $route_slug.'applications',	   'uses' => $module_controller.'applications']);
					/*Route::get('invitation',		 ['as' => $route_slug.'doctorinvitation',  'uses' => $module_controller.'invitation']);*/
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',          'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',        'uses' => $module_controller.'deactivate']);
					Route::get('live/{enc_id}',  ['as' => $route_slug.'live',          'uses' => $module_controller.'live']);
					Route::get('offline/{enc_id}',['as' => $route_slug.'offline',        'uses' => $module_controller.'offline']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',            'uses' => $module_controller.'delete']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',      'uses' => $module_controller.'multi_action']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',              'uses' => $module_controller.'edit']);
					Route::get('show/{enc_id}',      ['as' => $route_slug.'show',              'uses' => $module_controller.'show']);
					Route::get('show_fee_schedule/{enc_id}',      ['as' => $route_slug.'show_fee_schedule',              'uses' => $module_controller.'show_fee_schedule']);
					Route::get('verify/{enc_id}',    ['as' => $route_slug.'verify',            'uses' => $module_controller.'verify']);
					Route::get('activations/{enc_id}',['as' => $route_slug.'activations',      'uses' => $module_controller.'activations']);
					Route::post('update/{enc_id}',['as' => $route_slug.'update',      'uses' => $module_controller.'update']);
					Route::post('updatestep2/{enc_id}',['as' => $route_slug.'update',      'uses' => $module_controller.'update2']);
					Route::post('updatestep3/{enc_id}',['as' => $route_slug.'update',      'uses' => $module_controller.'update3']);
					Route::get('/download/{type}/{enc_id}',	           ['as'=>$route_slug.'step1', 'uses'=>$module_controller.'download_certificate']);

					Route::get('admin_verified_mini/{enc_id}',['as' => $route_slug.'admin_verified_mini',      'uses' => $module_controller.'admin_verified_mini']);
					Route::get('admin_verified_main/{enc_id}',['as' => $route_slug.'admin_verified_main',      'uses' => $module_controller.'admin_verified_main']);
				});
				
				/*--------------------------------invitation---------------*/
				Route::group(array('prefix' => '/invitation'), function()
				{
					$route_slug        = "invitation_";
					$module_controller = "Admin\InvitationController@";

					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',            'uses' => $module_controller.'delete']);	
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',      'uses' => $module_controller.'multi_action']);
					Route::get('display/{enc_id}',		 ['as' => $route_slug.'display',	   'uses' => $module_controller.'display']);

					Route::get('/doctor', 		         ['as' => $route_slug.'doctor/manage',	  'uses' => $module_controller.'doctor_invitation']);
					Route::get('/doctor/delete/{enc_id}', 		         ['as' => $route_slug.'doctor/delete',	  'uses' => $module_controller.'doctor_invitation_delete']);
					Route::any('/doctor/multi_action', 		         ['as' => $route_slug.'doctor/multi_action',	  'uses' => $module_controller.'doctor_multi_action']);

					Route::get('/pharmacy', 		         ['as' => $route_slug.'pharmacy/manage',	  'uses' => $module_controller.'pharmacy_invitation']);
					Route::get('/pharmacy/delete/{enc_id}', 		         ['as' => $route_slug.'pharmacy/delete',	  'uses' => $module_controller.'pharmacy_invitation_delete']);
					Route::any('/pharmacy/multi_action', 		         ['as' => $route_slug.'pharmacy/multi_action',	  'uses' => $module_controller.'pharmacy_multi_action']);

					Route::get('/patient', 		         ['as' => $route_slug.'patient/manage',	  'uses' => $module_controller.'patient_invitation']);
					Route::get('/patient/delete/{enc_id}', 		         ['as' => $route_slug.'patient/delete',	  'uses' => $module_controller.'patient_invitation_delete']);
					Route::any('/patient/multi_action', 		         ['as' => $route_slug.'patient/multi_action',	  'uses' => $module_controller.'patient_multi_action']);

				});

                /*--------------------------------phone number store---------------*/
				Route::group(array('prefix' => '/mobile_number_change_request'), function()
				{
					$route_slug        = "phone_number_change_";
					$module_controller = "Admin\MobileNumberChangeRequestController@";

					Route::get('delete/{enc_id}',        ['as' => $route_slug.'delete',            'uses' => $module_controller.'delete']);	
					Route::post('multi_action',          ['as' => $route_slug.'multi_action',      'uses' => $module_controller.'multi_action']);
					Route::get('display/{enc_id}',		 ['as' => $route_slug.'display',	   'uses' => $module_controller.'display']);

					Route::get('/doctor', 		            ['as' => $route_slug.'doctor/manage',	              'uses' => $module_controller.'doctor_requests']);
					Route::get('/doctor/delete/{enc_id}', 	['as' => $route_slug.'doctor/delete',	              'uses' => $module_controller.'request_delete']);
					Route::any('/doctor/multi_action', 		['as' => $route_slug.'doctor/multi_action',	          'uses' => $module_controller.'multi_action']);

                    Route::any('/doctor/accept_request/{enc_id}/{enc_id1}/{enc_id3}/{enc_id4}', 	['as' => $route_slug.'doctor/accept_request',	      'uses' => $module_controller.'accept_request']);

					Route::get('/patient', 		            ['as' => $route_slug.'patient/manage',	              'uses' => $module_controller.'patient_requests']);
					Route::get('/patient/delete/{enc_id}', 	['as' => $route_slug.'patient/delete',	              'uses' => $module_controller.'request_delete']);
					Route::any('/patient/multi_action', 	['as' => $route_slug.'patient/multi_action',	      'uses' => $module_controller.'multi_action']);
                    
                    Route::any('/patient/accept_request/{enc_id}/{enc_id1}/{enc_id3}/{enc_id4}', 	['as' => $route_slug.'patient/accept_request',	      'uses' => $module_controller.'accept_request']);



				}); 
				
				/*-----------------------------------------pharmacies----------------------------------------*/

				Route::group(array('prefix' => 'pharmacy'), function()
				{
					
					$route_slug        = "pharmacy";
					$module_controller = "Admin\PharmacyController@";

					Route::get('verifiedpharmacies', 		 ['as' => $route_slug.'manage',	             'uses' => $module_controller.'index']);
					Route::get('applications', 		         ['as' => $route_slug.'applications',        'uses' => $module_controller.'applications']);
					Route::get('verify/{enc_id}',            ['as' => $route_slug.'verify',              'uses' => $module_controller.'verify']);
					Route::get('show/{enc_id}',              ['as' => $route_slug.'show',                'uses' => $module_controller.'show']);
					Route::get('delete/{enc_id}',            ['as' => $route_slug.'delete',              'uses' => $module_controller.'delete']);
					Route::post('multi_action',              ['as' => $route_slug.'multi_action',        'uses' => $module_controller.'multi_action']);	
					Route::get('activations/{enc_id}',       ['as' => $route_slug.'activations',         'uses' => $module_controller.'activations']);
					Route::get('edit/{enc_id}',              ['as' => $route_slug.'edit',                'uses' => $module_controller.'edit']);
					Route::get('edit_pharmacy/{enc_id}',     ['as' => $route_slug.'edit_pharmacy',       'uses' => $module_controller.'edit_pharmacy']);
					Route::post('update/{enc_id}',           ['as' => $route_slug.'update',              'uses' => $module_controller.'update']);
					Route::get('activate/{enc_id}',  		 ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',		 ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::get('invitation', 		         ['as' => $route_slug.'invitation',        'uses' => $module_controller.'invitation']);
					Route::get('invitation/delete/{enc_id}', 		         ['as' => $route_slug.'invitation/delete',        'uses' => $module_controller.'invitation_delete']);
					Route::post('invitation/multi_delete', 		         ['as' => $route_slug.'invitation/multi_delete',        'uses' => $module_controller.'multi_delete']);
					
					Route::get('admin_verified/{enc_id}',['as' => $route_slug.'admin_verified',      'uses' => $module_controller.'admin_verified']);
				});			

					/*------------------------------------------patient---------------------------------------------*/
			
				Route::group(array('prefix' => 'patient'), function()
				{
					$route_slug       = "patient_";
					$module_controller = "Admin\PatientController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	      'uses' => $module_controller.'index']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
					Route::get('activation/{enc_id}',['as' => $route_slug.'activation',   'uses' => $module_controller.'activations']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete']);
					Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',	      'uses' => $module_controller.'show']);
					Route::get('family/{enc_id}',	 ['as' => $route_slug.'family',	      'uses' => $module_controller.'family']);
					Route::get('medicalhistory/{enc_id}',	 ['as' => $route_slug.'medical_history',	      'uses' => $module_controller.'medicalhistory']);
					Route::any('family_update/{enc_id}',['as' => $route_slug.'familyupdate','uses' => $module_controller.'datasave']);
					Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',	      'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',       'uses' => $module_controller.'update']);
					Route::get('local_pharmacy',     ['as' => $route_slug.'local_pharmacy','uses' => $module_controller.'local_pharmacy']);

				});

				/*--------------------------------------------Dispute Payment ----------------------------------------------*/

			    Route::group(array('prefix' => 'dispute'), function()
			    {

			    	$route_slug        =  "dispute_";
			    	$module_controller =  "Admin\DisputePaymentController@";
			    	
			    	Route::get('/', 	   	                 ['as' => $route_slug.'manage',	      'uses' => $module_controller.'index']);
			    	Route::get('view/{enc_id}',              ['as' => $route_slug.'reply',	      'uses' => $module_controller.'view']);
			    	Route::post('response',                  ['as' => $route_slug.'response',	  'uses' => $module_controller.'response']);
			    	Route::post('multi_action',              ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
			    	Route::get('download_dispute/{enc_id}',  ['as' => $route_slug.'download_dispute','uses' => $module_controller.'download_dispute']);
					Route::any('change_status/{enc_dispute_id}', ['as' => $route_slug.'change_status','uses' => $module_controller.'change_status']);
					Route::any('refund', 					 ['as' => $route_slug.'refund','uses' => $module_controller.'refund']);
			    	
			    	
			    });

			    /*--------------------------------------------Stripe Payment ----------------------------------------------*/

			    Route::group(array('prefix' => 'stripe'), function()
			    {

			    	$route_slug        =  "stripe_";
			    	$module_controller =  "Admin\StripeController@";
			    	
			    	Route::get('/connected_accounts',		['as' => $route_slug.'connected_accounts',		'uses' => $module_controller.'connected_accounts']);
			    	Route::get('/connected_accounts/view/{enc_id}',	['as' => $route_slug.'connected_accounts_view',		'uses' => $module_controller.'connected_accounts_view']);
			    	Route::get('/connected_accounts/delete/{enc_id}',	['as' => $route_slug.'connected_accounts_delete',		'uses' => $module_controller.'connected_accounts_delete']);
			    	Route::get('/connected_accounts/reject/{enc_id}',	['as' => $route_slug.'connected_accounts_reject',		'uses' => $module_controller.'connected_accounts_reject']);
			    	
			    });

				/*-----------------------------------------------faqs-----------------------------------------------*/

				Route::group(array('prefix' => 'faqs'), function()
				{
					$route_slug         = "faqs_";
					$module_controller  = "Admin\FaqsController@";

					Route::get('/', 		         			['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 			['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             			['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      			['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   			['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('activate/{enc_id}',  			['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',			['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::get('delete/{enc_id}',				['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::post('multi_action',      			['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
					Route::get('category',             			['as' => $route_slug.'category',    'uses' => $module_controller.'category']);
					Route::get('create_category',           	['as' => $route_slug.'category',    'uses' => $module_controller.'createcategory']);
					Route::post('storecategory',            	['as' => $route_slug.'store',    'uses' => $module_controller.'storecategory']);
					Route::get('edit_category/{enc_id}',    	['as' => $route_slug.'edit',     'uses' => $module_controller.'editcategory']);
					Route::post('updatecategory/{enc_id}',  	['as' => $route_slug.'update',   'uses' => $module_controller.'updatecategory']);
					Route::get('deletecategory/{enc_id}',    	['as' => $route_slug.'delete',   'uses' => $module_controller.'deletecategory']);
					Route::get('activatecategory/{enc_id}',  	['as' => $route_slug.'activate',   'uses' => $module_controller.'activatecategory']);
					Route::get('deactivatecategory/{enc_id}',	['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivatecategory']);
					Route::post('multiaction_category',      	['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multiaction_category']);
				});

				/*----------------------------------membership faqs----------------------------------------------*/

				Route::group(array('prefix' => 'membership_faqs'), function()
				{
					$route_slug         = "membership_faqs_";
					$module_controller  = "Admin\MembershipFaqsController@";

					Route::get('/', 		         			['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 			['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             			['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      			['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   			['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('activate/{enc_id}',  			['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',			['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::get('delete/{enc_id}',				['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::post('multi_action',      			['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
					Route::get('category',             			['as' => $route_slug.'category',    'uses' => $module_controller.'category']);
					Route::get('create_category',           	['as' => $route_slug.'category',    'uses' => $module_controller.'createcategory']);
					Route::post('storecategory',            	['as' => $route_slug.'store',    'uses' => $module_controller.'storecategory']);
					Route::get('edit_category/{enc_id}',    	['as' => $route_slug.'edit',     'uses' => $module_controller.'editcategory']);
					Route::post('updatecategory/{enc_id}',  	['as' => $route_slug.'update',   'uses' => $module_controller.'updatecategory']);
					Route::get('deletecategory/{enc_id}',    	['as' => $route_slug.'delete',   'uses' => $module_controller.'deletecategory']);
					Route::get('activatecategory/{enc_id}',  	['as' => $route_slug.'activate',   'uses' => $module_controller.'activatecategory']);
					Route::get('deactivatecategory/{enc_id}',	['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivatecategory']);
					Route::post('multiaction_category',      	['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multiaction_category']);
				});


				/*----------------------------------membership ----------------------------------------------*/

				Route::group(array('prefix' => 'membership'), function()
				{
					$route_slug         = "membership";
					$module_controller  = "Admin\MembershipController@";

					Route::get('/', 		         			['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('edit/{enc_id}',      			['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   			['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::any('show/{enc_id}',   				['as' => $route_slug.'show',   	'uses' => $module_controller.'show']);
					Route::get('delete/{enc_id}',				['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::post('multi_action',      			['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);

					Route::any('plan_price',      				['as' => $route_slug.'plan_price',   'uses' => $module_controller.'plan_price']);
					Route::any('plan_price/update',      		['as' => $route_slug.'plan_price/update',   'uses' => $module_controller.'update_plan']);

					Route::any('discount_code/list',      		['as' => $route_slug.'discount_code_list',   'uses' => $module_controller.'discount_code_list']);
					Route::any('discount_code/create',      	['as' => $route_slug.'discount_code_create',   'uses' => $module_controller.'discount_code_create']);
					Route::any('discount_code/store',      	    ['as' => $route_slug.'discount_code_store',   'uses' => $module_controller.'discount_code_store']);
					Route::any('discount_code/edit/{enc_id}',   ['as' => $route_slug.'discount_code_edit',   'uses' => $module_controller.'discount_code_edit']);
					Route::any('discount_code/update/{enc_id}', ['as' => $route_slug.'discount_code_update',   'uses' => $module_controller.'discount_code_update']);
					Route::any('discount_code/view/{enc_id}',   ['as' => $route_slug.'discount_code_view',   'uses' => $module_controller.'discount_code_view']);
					Route::get('discount_code/activate/{enc_id}', ['as' => $route_slug.'discount_code_activate',   'uses' => $module_controller.'discount_code_activate']);
					Route::get('discount_code/deactivate/{enc_id}', ['as' => $route_slug.'discount_code_deactivate',   'uses' => $module_controller.'discount_code_deactivate']);
					Route::any('discount_code/delete/{enc_id}',	['as' => $route_slug.'discount_code_delete',   'uses' => $module_controller.'discount_code_delete']);
					Route::any('discount_code/multi_action',    ['as' => $route_slug.'discount_code_multi_action',   'uses' => $module_controller.'discount_code_multi_action']);
				});

				/*------------------------------- Feedback -----------------------------------------*/


				Route::group(array('prefix' => 'feedback'), function()
				{
					$route_slug         = "feedback_";
					$module_controller  = "Admin\FeedbackController@";
					Route::get('delete/{enc_id}',				['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::post('multi_action',      			['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);

					Route::get('/', 		         			['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
				});


				/*-------------------------------Speciality Pages-----------------------------------------*/

				Route::group(array('prefix' => '/speciality'), function()
				{
					$route_slug       = "speciality_";
					$module_controller = "Admin\SpecialityController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);

		  		});

		  		Route::group(array('prefix' => '/languages'), function()
				{
					$route_slug       = "languages_";
					$module_controller = "Admin\LanguageSpokenController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);

		  		});
			
				/*------------------------------------How It Works(Seema)---------------------------------------------------------------*/
				Route::group(array('prefix' => '/howitworks'), function()
				{
					$route_slug        = "howitworks_";
					$module_controller = "Admin\HowItWorksController@";

					Route::get('/', 		         ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
					Route::post('store',             ['as' => $route_slug.'store',    'uses' => $module_controller.'store']);
					Route::get('edit/{enc_id}',      ['as' => $route_slug.'edit',     'uses' => $module_controller.'edit']);
					Route::post('update/{enc_id}',   ['as' => $route_slug.'update',   'uses' => $module_controller.'update']);
					Route::get('delete/{enc_id}',    ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
					Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',   'uses' => $module_controller.'activate']);
					Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate']);
					Route::post('multi_action',      ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
				});

			    // Feedback manage admin -Poonam

			    Route::group(array('prefix' => '/feedback'), function()
			    {
			    	$route_slug       =  "feedback";
			    	$module_controller=  "Admin\FeedbackController@";
			    	Route::get('/', 		         	 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			    	Route::get('delete/{enc_id}',    	 ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
			    	Route::get('changeStatus/{enc_id}/{status}',  ['as' => $route_slug.'changeStatus', 'uses' => $module_controller.'changeStatus']);
			    	Route::post('multi_action',          ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
			    });


			    /*-----------------------------------------------Consultation-----------------------------------------------*/

			    Route::group(array('prefix' => '/consultation'), function()
				{
					$route_slug       = "consultation_";
					$module_controller = "Admin\ConsultationController@";

					Route::get('/', 		          		 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
					Route::get('show/{enc_id}',      ['as' => $route_slug.'show', 'uses' => $module_controller.'show']);
				});


			    /*------------------------------Admin Notification-----------------------------*/
				Route::group(array('prefix' => '/notification'), function()
				{
					$route_slug        = "notification_";
					$module_controller = "Admin\AdminNotificationController@";

					Route::any('/', 		        ['as' => $route_slug.'list',	  'uses' => $module_controller.'index']);
					Route::post('get_count',		['as' => $route_slug.'get_count', 'uses' => $module_controller.'get_count']);
					Route::any('delete/{end_id}',   ['as' => $route_slug.'delete', 'uses' => $module_controller.'delete']);
				});

			});
		});
	});	


	/******************************************************Front******************************************************************/

	Route::post('newsletter',['as'=>'newsletter','uses'=>'Front\NewsletterController@index']);

	Route::group(['middleware' => []],function() 
	{
		/* Front Routes */
		Route::group(['prefix' => '','middleware'=>['front_general']], function () 
		{
			$route_slug       = "front_home_";
			$module_controller = "Front\HomeController@";

			//Route::get('/',                             ['as' => $route_slug.'home',				'uses' => $module_controller.'index']);
			Route::get('/',                             ['as' => $route_slug.'home',				'uses' => $module_controller.'coming_soon']);
			Route::get('info/{enc_id}',                 ['as' => $route_slug.'static_page_info',	'uses' => $module_controller.'static_page_info']);
			Route::get('contact-us',                    ['as' => $route_slug.'contact_us',			'uses' => $module_controller.'contact_us']);
			Route::post('contactus/store',				['as' => $route_slug.'store',				'uses' => $module_controller.'store']);
			Route::get('pricing',						['as'=>$route_slug.'pricing',				'uses' => $module_controller.'pricing']);
			Route::get('health/{page_slug}',			['as'=>$route_slug.'page_slug',				'uses' => $module_controller.'dynamic']);
			//Route::get('{page_slug}',					['as'=>$route_slug.'page_slug',				'uses' => $module_controller.'pages']);
			Route::get('/faqs',							['as'=>$route_slug.'faqs',					'uses' => $module_controller.'faqs']);
			Route::get('/telemedicine',					['as'=>$route_slug.'telemedicine',					'uses' => $module_controller.'pages']);
			Route::get('/talk-to-a-doctor-online',		['as'=>$route_slug.'talk-to-a-doctor-online',		'uses' => $module_controller.'pages']);
			Route::get('/see-a-doctor-at-home',			['as'=>$route_slug.'see-a-doctor-at-home',			'uses' => $module_controller.'pages']);
			Route::get('/online-doctor-prescriptions',	['as'=>$route_slug.'online-doctor-prescriptions',	'uses' => $module_controller.'pages']);
			Route::get('/online-doctors-certificate',	['as'=>$route_slug.'online-doctors-certificate',	'uses' => $module_controller.'pages']);
			Route::get('/online-doctors',				['as'=>$route_slug.'online-doctors',				'uses' => $module_controller.'pages']);
			Route::get('/online-doctor-consultations',	['as'=>$route_slug.'online-doctor-consultations',	'uses' => $module_controller.'pages']);
			Route::get('/after-hours-home-doctor',		['as'=>$route_slug.'after-hours-home-doctor',		'uses' => $module_controller.'pages']);
			Route::get('/chat-with-a-doctor',		    ['as'=>$route_slug.'chat-with-a-doctor',		    'uses' => $module_controller.'pages']);
			Route::get('/online-doctors-australia',		['as'=>$route_slug.'online-doctors-australia',		    'uses' => $module_controller.'pages']);
			Route::get('/dial-a-doctor-on-demand',		['as'=>$route_slug.'dial-a-doctor-on-demand',		    'uses' => $module_controller.'pages']);
			Route::get('/book-a-doctor-online-in-australia',		    ['as'=>$route_slug.'book-a-doctor-online-in-australia',		    'uses' => $module_controller.'pages']);
			Route::get('/see-a-gp-online',		    ['as'=>$route_slug.'see-a-gp-online',		    'uses' => $module_controller.'pages']);
			Route::get('/home-doctor-service-online',		    ['as'=>$route_slug.'home-doctor-service-online',		    'uses' => $module_controller.'pages']);
			Route::get('/get-a-sick-note-&-doctor-certificate',		    ['as'=>$route_slug.'get-a-sick-note-and-doctor-certificate',		    'uses' => $module_controller.'pages']);
			Route::get('/homepage-doctoroo',		    ['as'=>$route_slug.'homepage-doctoroo',		    'uses' => $module_controller.'pages']);
			Route::get('/see-a-doctor-at-home-without-travelling-anywhere',		    ['as'=>$route_slug.'see-a-doctor-at-home-without-travelling-anywhere',		    'uses' => $module_controller.'pages']);

			Route::get('doctor/faqs',                    ['as' => $route_slug.'doctor_faqs',			'uses' => $module_controller.'doctor_faqs']);

		});
	});

	Route::group(array('prefix' => '/subscribe'), function()
    {
    	$route_slug       =  "subscribe";
    	$module_controller=  "Front\SubscribeController@";
    	Route::get('/', 		         	 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
    	Route::get('delete/{enc_id}',    	 ['as' => $route_slug.'delete',   'uses' => $module_controller.'delete']);
    	Route::get('changeStatus/{enc_id}/{status}',  ['as' => $route_slug.'changeStatus', 'uses' => $module_controller.'changeStatus']);
    	Route::post('multi_action',          ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action']);
    });

	Route::group(array('prefix'=>'blogs'),function(){
		$route_slug       =  "blog";
    	$module_controller=  "Front\BlogController@";
		Route::get('/',['as'=>'blogs','uses'=>$module_controller.'index']);
		Route::get('/addtofavorite/{blog_id}/{user_id}',['as'=>$route_slug.'addtofavorite', 'uses'=>$module_controller.'addtofavorite']);
		Route::get('/{slug}',['as'=>$route_slug.'blog_details', 'uses'=>$module_controller.'blog_details']);
		Route::post('/search', ['as'=>$route_slug.'search_txt' , 'uses'=>$module_controller.'search']);
		Route::get('/category/{category_slug}',['as'=>$route_slug.'blog_search_category', 'uses'=>$module_controller.'blog_search_category']);
		Route::get('/search/{year}/{month}',['as'=>$route_slug.'blog_search_heirarchy', 'uses'=>$module_controller.'blog_search_heirarchy']);
		Route::post('/comment/store/{blog_id}',['as'=>$route_slug.'comment_store', 'uses'=>$module_controller.'comment_store']);

	});

	@include_once(app_path('Http/Routes/front.php'));

	@include_once(app_path('Http/Routes/doctor.php'));

	@include_once(app_path('Http/Routes/pharmacy.php'));

	@include_once(app_path('Http/Routes/patient.php'));

	/*@include_once(app_path('Http/Routes/new_patient.php'));*/


	/******************************************************  Create User *****************************************************************/

	Route::group(['prefix' => 'users'], function () 
	{
		Route::get('/create_role',function()
		{	
			$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Pharmacy',
		    'slug' => 'pharmacy',
		    'permissions' => [
      		 'admin'   => false,
      		 ]
			]);
		});


		Route::get('/assign_role',function()
		{
			$role = Sentinel::findRoleBySlug('admin');
			$user = Sentinel::findById(1); //assgning role to perticular user id statically.
			$user->roles()->attach($role);
		});

		Route::get('/create_user',function()
		{
			$credentials = [
					    'email'    => 'doctorondemand@webwing.com',
					    'password' => 'password',
					];

			$user = Sentinel::registerAndActivate($credentials);
		});
	});	  
	// testing route to create user by sentinel end here

	Route::get('twilio_test', ['as'=>'twilio_test', 	'uses'=>'Front\TwilioTestController@index']);