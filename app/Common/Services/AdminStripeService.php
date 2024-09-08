<?php 
namespace App\Common\Services;
use Illuminate\Http\Request;
use \Stripe\Stripe as Stripe;
use \Stripe\Charge as Charge;

/*
	Admin payment services 
	By : Sheshkumar Kumar Prajapati
	Date: 30 january 2017

*/

class AdminStripeService
{
		public function __construct()
		{
			$arr_stripe            	= [];
			$this->secret_key    	= "sk_test_wxfv0h0PA3IiHDs3aTklNAz9";
			$this->stripe = Stripe::setApiKey($this->secret_key);

			//dd($this->stripe);
			$this->arr_error_bag = [];
			$this->arr_error_bag['status'] = 'pass';
		}

		/* STEP 1:  ACCOUNT CREATION  */
		public function create_bank_account(Array $arr_data = [])
		{
			$account = [];

			if(!isset($arr_data['country']) || $arr_data['country'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_country']= "";
			}

			if(!isset($arr_data['routing_number']) || $arr_data['routing_number'] <= 0  || $arr_data['routing_number'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_routing_number']= "";
			}

			if(!isset($arr_data['account_number']) || $arr_data['account_number'] <= 0  || $arr_data['account_number'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_account_number']= "";
			}
		
			if($this->arr_error_bag['status'] == 'pass') 
			{
				try
				{
					$account = \Stripe\Account::create(array
					(
					  	"managed" => true,
					  	"country" => $arr_data['country'],
					  	"external_account" 	=> array
					  	(
					    	"object" 			=> "bank_account",
					    	"country"	 		=> $arr_data['country'],
					    	"currency" 			=> "usd",
					    	"routing_number" 	=> $arr_data['routing_number'],
					    	"account_number" 	=> $arr_data['account_number'],
						)
					));
					return $account;

				}
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();
				}
			}

			return $this->arr_error_bag;
		}

		/* STEP : 2  USER VARIFICATION DATA */
		public function user_varification_first(Array $arr_data = [])
		{
			$account = [];

			if(!isset($arr_data['account_id']) || $arr_data['account_id'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_account_id']	= "Account Id is Missing";
			}		

			if(!isset($arr_data['dob']) || $arr_data['dob'] == ''  )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_dob']	= "";
			}

			if(!isset($arr_data['first_name']) || $arr_data['first_name'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_first_name']= "";
			}

			if(!isset($arr_data['last_name']) || $arr_data['last_name'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_last_name']= "";
			}

			if(!isset($arr_data['type']) || $arr_data['type'] == ''  )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_account_type']	= "";
			}

			if(!isset($arr_data['location']) || $arr_data['location'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_location']= "";
			}

			if(!isset($arr_data['city']) || $arr_data['city'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_city']= "";
			}

			if(!isset($arr_data['state']) || $arr_data['state'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_state']= "";
			}

			if(!isset($arr_data['postal_code']) || $arr_data['postal_code'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_postal_code']= "";
			}

			if(!isset($arr_data['ssn_no']) || $arr_data['ssn_no'] <= 0 || $arr_data['ssn_no'] == ''  )
			{
				$this->arr_error_bag['status'] = 'failed'; 
				$this->arr_error_bag['err_ssn_no']= "";
			}

			if($this->arr_error_bag['status'] == 'pass') 
			{
				$date 	= explode('-', $arr_data['dob']);

				try
				{	
					$account = \Stripe\Account::retrieve($arr_data['account_id']);
					//dd($account);
					$account->tos_acceptance->date 		= time();
					$account->tos_acceptance->ip 		= $_SERVER['REMOTE_ADDR'];
					$account->legal_entity->dob->day 	= $date[2];
					$account->legal_entity->dob->month 	= $date[1];
					$account->legal_entity->dob->year 	= $date[0];
					$account->legal_entity->first_name 	= $arr_data['first_name'];
					$account->legal_entity->last_name 	= $arr_data['last_name'];
					$account->legal_entity->type 		= $arr_data['type'];

					$account->legal_entity->address->line1 		 = $arr_data['location'];
					$account->legal_entity->address->postal_code = $arr_data['postal_code'];
					$account->legal_entity->address->city 		 = $arr_data['city'];
					$account->legal_entity->address->state 		 = $arr_data['state'];
					
					$account->legal_entity->ssn_last_4 			 = $arr_data['ssn_no'];

					$account->save();
					//dd($account);
					return  $account;
				}
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();
				}
			}

			return $this->arr_error_bag;			
		}

		public function fileupload(Array $arr_data = [])
		{
			$account = [];

			if(!isset($arr_data['account_id']) || $arr_data['account_id'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_account_id']	= "Account Id is Missing";
			}

			if(!isset($arr_data['file_name']) || $arr_data['file_name'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_identity_document']	= "";
			}	

			if($this->arr_error_bag['status'] == 'pass') 
			{
				try
				{
					$account = \Stripe\FileUpload::create(
					array(
					    	"purpose" => "identity_document",
					    	"file"    => fopen(public_path('uploads/certificate/'.$arr_data['file_name']), 'r'),
					  	),
					array(
					    	"stripe_account" => $arr_data['account_id']
					  	)
					);

					return $account;
				}
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();
				}
			}

			return $this->arr_error_bag;
		}


		public function user_varification_second(Array $arr_data = [])
		{
			$account = [];
			// dd($request->all);
			// if(!isset($arr_data['account_id']) || $arr_data['account_id'] == '' )
			// {
			// 	$this->arr_error_bag['status']  = 'failed'; 
			// 	$this->arr_error_bag['err_account_id']	= "Account Id is Missing";
			// }

			// if(!isset($arr_data['file_id']) || $arr_data['file_id'] == '' )
			// {
			// 	$this->arr_error_bag['status']  = 'failed'; 
			// 	$this->arr_error_bag['err_file_id']	= "";
			// }	

			// if(!isset($arr_data['personal_id']) || $arr_data['personal_id'] == '' )
			// {
			// 	$this->arr_error_bag['status']  = 'failed'; 
			// 	$this->arr_error_bag['err_personal_id']	= "";
			// }	

			if($this->arr_error_bag['status'] == 'pass') 
			{
				try
				{
					$account = \Stripe\Account::retrieve($arr_data['account_id']);
					$account->legal_entity->personal_id_number 		= $arr_data['personal_id'];
					$account->legal_entity->verification->document 	= $arr_data['file_id'];
					$account->save();

					return  $account;
				}	
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();
				}
			}

			return $this->arr_error_bag;
		}

		public function create_charge(Array $arr_data = [])
		{
			$create_charge = [];

			if(!isset($arr_data['account_id']) || $arr_data['account_id'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_account_id']	= "Account Id is Missing";
			}

			if(!isset($arr_data['token']) || $arr_data['token'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_file_id']	= "Transaction token is missing";
			}	

			if(!isset($arr_data['amount']) || $arr_data['amount'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_personal_id']	= "Transaction amount is missing";
			}	
			
			if($this->arr_error_bag['status'] == 'pass') 
			{
				/*$arr_data['amount'] = (round($arr_data['amount'] * 100));*/
				$arr_data['amount'] = intval($arr_data['amount']);
				try
				{
					$create_charge = Charge::create(array
					(
					  "amount" 		=> $arr_data['amount'],
					  "currency" 	=> "usd",	
					  "source" 		=> $arr_data['token']		
					));

			        return $create_charge;
				}
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();	
				}
			}

			return 	$this->arr_error_bag;
		}	

		public function create_transfer(Array $arr_data = [])
		{
			$create_transfer = [];

			if(!isset($arr_data['account_id']) || $arr_data['account_id'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_account_id']	= "Account Id is Missing";
			}

			if(!isset($arr_data['token']) || $arr_data['token'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_file_id']	= "Transaction token is missing";
			}	

			if(!isset($arr_data['amount']) || $arr_data['amount'] == '' )
			{
				$this->arr_error_bag['status']  = 'failed'; 
				$this->arr_error_bag['err_personal_id']	= "Transaction amount is missing";
			}	

			if($this->arr_error_bag['status'] == 'pass') 
			{
				/*$commission 		= ($arr_data['commission'] + 2.9);
				$amount	 			= round($arr_data['amount'] * 100);
				$application_fee 	= ($amount*$commission)/100;

				$amount = round($amount - ($application_fee - 8.45)); */
				
				$amount = $arr_data['amount'];

				try
				{
					$create_transfer = \Stripe\Transfer::create(array(
					  "amount" => intval($amount),
					  "currency" => "usd",
					  "destination" => $arr_data['account_id'],
					  "description" => "Transfer for ".$arr_data['email']
					));

					return  $create_transfer;
				}
				catch(\Exception $e)
				{
					$this->arr_error_bag['status']  =  'failed';
					$this->arr_error_bag['err_exception'] = $e->getMessage();	
				}
			}

			return 	$this->arr_error_bag;
		}	

		public function retrive_account_information($account_id)
		{
			try
			{
				$account = \Stripe\Account::retrieve($account_id);
				return  $account;
			}	
			catch(\Exception $e)
			{
				$this->arr_error_bag['status']  =  'failed';
				$this->arr_error_bag['err_exception'] = $e->getMessage();
			}	

			return 	$this->arr_error_bag;
		}

	}
?>


