<?php

namespace App\Common\Services;
use Twilio\Rest\Client;

class SMSService
{
	public function __construct()
	{
		
	}

	// $arr_sms_data = array parameter should be - $to and $body
	public function send_sms($arr_sms_data = FALSE)
	{
		if($arr_sms_data)
		{
			// Send an SMS using Twilio's REST API and PHP
			$sid = env('TWILIO_SID'); // Your Account SID from www.twilio.com/console
			$token = env('TWILIO_TOKEN'); // Your Auth Token from www.twilio.com/console

			$client = new Client($sid, $token);
			$message = $client->messages->create($arr_sms_data['to'], // Text this number
														array(
														'from' => env('TWILIO_FROM'), // From a valid Twilio number
														'body' => $arr_sms_data['body']
														)
												);
			if($message->sid)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return false;
	}
}
?>