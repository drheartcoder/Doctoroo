<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class SendNotificationController extends Controller
{
  
		public function __construct()
        {	


        }
        public function sendPushNotificationToGCMSever($token_id, $message)
        {
        		
        		$token = base64_decode($token_id);
		        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
				
				$fields = array(
		            'to' => "ABC",
		            'notification' => array('title' => 'Doctoroo', 'body' => 'That is all we want'),
		            'data' => array('message' => $message)
		        );
		 		
		        $headers = array(
		            'Authorization:key=' .getenv('FCM_SERVER_KEY'),
		            'Content-Type:application/json'
		        );		
				$ch = curl_init();
		 
		        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
		        curl_setopt($ch, CURLOPT_POST, true);
		        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
		        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		    
		        $result = curl_exec($ch);
				dd($result);				       
		        curl_close($ch);

		        return $result;
				
        }


}
?>