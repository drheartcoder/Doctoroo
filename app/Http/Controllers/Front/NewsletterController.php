<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Common\Services\MailChimpService;

class NewsletterController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
    	
    	$arr_rules = [];
    	$arr_rules['email'] = "required|email";

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return response()->json(['status'=>'ERROR','msg'=>$validator->messages()->first()]);
    	}
    	$mailchimp = new MailChimpService();
    	
    	$mailchimp_responce = $mailchimp->subscribe($request->input('email'));

    	 if(isset($mailchimp_responce) && $mailchimp_responce['status']==TRUE)
        {
            return response()->json(['status'=>'SUCCESS','msg'=>'Thank you for newsletter subscription.']);
        }   
        else
        {
            if (isset($mailchimp_responce['error_code']) && $mailchimp_responce['error_code']==214) 
            {
                return response()->json(['status'=>'ERROR','msg'=>'You have already subscribed with this email id.']);    
            }

            return response()->json(['status'=>'ERROR','msg'=>'Error while newsletter subscription.']);
        }
	}
}
