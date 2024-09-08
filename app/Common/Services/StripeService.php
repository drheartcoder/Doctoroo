<?php 

namespace App\Common\Services;
use Illuminate\Http\Request;

use \Stripe\Stripe as Stripe;
use \Stripe\Charge as Charge;

class StripeService
{
	public function __construct()
	{
		$arr_stripe            	= [];

		$this->secret_key    	= "sk_test_wxfv0h0PA3IiHDs3aTklNAz9";
		$this->stripe 			= Stripe::setApiKey($this->secret_key);		

		$this->arr_error_bag 	= [];
		$this->arr_error_bag['status'] = 'pass';
	}

	public function charge_token(Array $arr_data = [])
	{
		if(isset($arr_data['token']) == false)
		{
			$this->arr_error_bag['status'] = 'failed';
			$this->arr_error_bag['reason'] = "Charge Token is Missing";
		}

		if(isset($arr_data['amount']) == false)
		{
			$this->arr_error_bag['status'] = 'failed';
			$this->arr_error_bag['reason'] = "Amount is Missing";
		}

		if((double)($arr_data['amount']) <= 0 )
		{
			$this->arr_error_bag['status'] = 'failed';
			$this->arr_error_bag['reason'] = "Amount should be greater than zero";
		}

		if ($this->arr_error_bag['status'] == 'pass') 
		{	
			$token  =  $arr_data['token'];
			$amount = (round($arr_data['amount']*100));
			try 
			{
				$charge_response = Charge::create(array
				(
				  "source" => $token,
				  "amount" => $amount,
				  "currency" => "usd",	
				  'description' => 'Test',							  
				));
				// dd($charge_response);

				if(isset($charge_response) && sizeof($charge_response)>0)
			    {			    	
			    	return $charge_response;
		        } 
		        else
		        {
		        	$this->arr_error_bag['status'] = 'failed';
		        	$this->arr_error_bag['reason'] = 'Stripe Response Data missing';
		        }
			} 
			catch(\Exception $e)
			{
				$this->arr_error_bag['status'] = 'failed';
				$this->arr_error_bag['reason'] = $e->getMessage();
			}
		}
		else
		{
			$this->arr_error_bag['status'] = 'failed';
		    $this->arr_error_bag['reason'] = 'Stripe Response Data missing';
		}	

		return $this->arr_error_bag; 
	}
}

?>