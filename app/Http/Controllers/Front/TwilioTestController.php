<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Services\SMSService;

class TwilioTestController extends Controller
{
    public function __construct(SMSService $SMSService)
	{
		$this->SMSService = $SMSService;
	}

	public function index()
	{
		$code = $this->SMSService->send_sms(array('to'=>'+919923266699','body'=>'This is mona testing'));
		dd($code);
	}

    public function index_actal_example()
    {
    	// Send an SMS using Twilio's REST API and PHP
		$sid = "AC4ca1f6c00395f47b83008868cc6171e0"; // Your Account SID from www.twilio.com/console
		$token = "cad98747820bd291de180e93058dee2c"; // Your Auth Token from www.twilio.com/console

		$client = new Client($sid, $token);
		$message = $client->messages->create(
		  '+919923266699', // Text this number
		  array(
		    'from' => '+61481071530', // From a valid Twilio number
		    'body' => 'Hello from webwing!'
		  )
		);
		return $message->sid;
    }
}
