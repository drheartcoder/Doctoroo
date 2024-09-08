<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PaymentMethodsModel;
use App\Models\CreditsModel;
use App\Models\MembershipPaymentModel;
use App\Models\StripeCustomerModel;
use App\Models\StripeCardModel;
use App\Models\StripeConnectedAccountsModel;
use App\Models\UserModel;
use App\Models\DoctorModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;
use Session;
use DB;
use Stripe;


class StripeController extends Controller
{
    public function __construct(MembershipPaymentModel           $MembershipPaymentModel,
                                StripeCustomerModel              $StripeCustomerModel,
                                StripeCardModel              	 $StripeCardModel,
                                StripeConnectedAccountsModel	 $StripeConnectedAccountsModel,
                                UserModel						 $UserModel,
                                DoctorModel						 $DoctorModel)
    {
        $this->arr_view_data                        = [];
        $this->module_title                         = "Stripe Details";
        $this->module_url_path                      = url('/').'/admin/stripe/';
        $this->module_view_folder                   = "admin.stripe";

        $this->MembershipPaymentModel               = $MembershipPaymentModel;
        $this->StripeCustomerModel                  = $StripeCustomerModel;
        $this->StripeCardModel                  	= $StripeCardModel;
        $this->StripeConnectedAccountsModel         = $StripeConnectedAccountsModel;
        $this->UserModel         					= $UserModel;
        $this->DoctorModel         					= $DoctorModel;

        $user                                       = Sentinel::check();
        $this->user_id                              = '';

        if($user!=false)
        {
           $this->user_id                           = $user->id;
        }
        else
        {
           $this->user_id                           = null;
        }
    }

    /*
    | Function  : Get all the stripe connected accounts and doctor details
    | Author    : Deepak Arvind Salunke
    | Date      : 04/11/2017
    | Output    : Show the list
    */

    public function connected_accounts()
    {
    	\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
		$account 				= Stripe\Account::all();
		$account_list 			= $account->data;

		$new_account_details 	= [];
		foreach ($account_list as $list)
		{
			$get_doctor_data = $this->UserModel->with('doctor_details')->where('email',$list->email)->first();
			if($get_doctor_data)
			{
				$doctor_data = $get_doctor_data->toArray();

				$account_details['doctor_data'] 			= $doctor_data;
			}

			$account_details['id'] 						= $list->id;
			$account_details['country'] 				= $list->country;
			$account_details['default_currency'] 		= $list->default_currency;
			$account_details['display_name'] 			= $list->display_name;
			$account_details['email'] 					= $list->email;
			$account_details['statement_descriptor'] 	= $list->statement_descriptor;
			$account_details['type'] 					= $list->type;

			$new_account_details[] 						= $account_details;
		}
		
		$this->arr_view_data['account_list'] 		  	= $new_account_details;
		$this->arr_view_data['page_title']            	= "Stripe Details";
		$this->arr_view_data['module_title']            = "Stripe Details";
		$this->arr_view_data['module_url_path']			= $this->module_url_path;
		return view($this->module_view_folder.'.connected_accounts',$this->arr_view_data);
    } // end connected_accounts


    /*
    | Function  : Get all the data for selected stripe connected accounts and doctor details
    | Author    : Deepak Arvind Salunke
    | Date      : 04/11/2017
    | Output    : Show all the details
    */

    public function connected_accounts_view($enc_id)
    {
    	$account_id = base64_decode($enc_id);

    	\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
		$account 				= \Stripe\Account::retrieve($account_id);

		$get_doctor_data = $this->UserModel->with('doctor_details')->where('email',$account->email)->first();
		if($get_doctor_data)
		{
			$this->arr_view_data['doctor_data'] = $get_doctor_data->toArray();
		}

		$this->arr_view_data['account_data'] 		  	= $account;
		$this->arr_view_data['page_title']            	= "Account Details";
		$this->arr_view_data['module_url_path']			= $this->module_url_path;
		return view($this->module_view_folder.'.connected_accounts_view',$this->arr_view_data);
    } // end connected_accounts_view


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 04/11/2017
    | Output    : Success or Error
    */

    public function connected_accounts_delete($enc_id)
    {
    	$account_id = base64_decode($enc_id);

    	\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
		$account = \Stripe\Account::retrieve($account_id);
		$delete = $account->delete();

		if($delete['true'])
		{
			Flash::success('Account deleted successfully.');
            return redirect(url('/').'/admin/stripe/connected_accounts');
		}
		else
		{
			Flash::error('Something went wrong. Please try agian.');
            return redirect()->back();
		}

    } // end connected_accounts_delete


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 04/11/2017
    | Output    : Success or Error
    */

    public function connected_accounts_reject($enc_id)
    {
    	$account_id = base64_decode($enc_id);

    	\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
		$account = \Stripe\Account::retrieve($account_id);
		$reject = $account->reject(array("reason" => "other"));

		if($reject['true'])
		{
			Flash::success('Account rejected successfully.');
            return redirect(url('/').'/admin/stripe/connected_accounts');
		}
		else
		{
			Flash::error('Something went wrong. Please try agian.');
            return redirect()->back();
		}

    } // end connected_accounts_reject



    /*
    | Function  : Get customer id and by using it get all the card details from stripe account
    | Author    : Deepak Arvind Salunke
    | Date      : 10/10/2017
    | Output    : Success or Error
    */

    public function listing(Request $request)
    {
		$get_card_id = $this->StripeCardModel->where('user_id',$this->user_id)->get();
		if($get_card_id)
		{
			$card_list = $get_card_id->toArray();
		}

		$new_card_details = [];

		foreach($card_list as $list)
		{
			\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
			$customer = \Stripe\Customer::retrieve($list['customer_id']);
			$card = $customer->sources->retrieve($list['card_id']);

			$card_details['id']         = $list['id'];
			$card_details['customer_id']= $customer->id;
			$card_details['card_type']  = $card->brand;
			$card_details['card_no']    = $card->last4;
			$card_details['exp_month']  = $card->exp_month;
			$card_details['exp_year']   = $card->exp_year;

			$new_card_details[] = $card_details;
		}

		$this->arr_view_data['payment_methods']       =  $new_card_details;
		$this->arr_view_data['page_title']            =  "Payment Method";
		$this->arr_view_data['module_url_path']       =  $this->module_url_path;
		return view($this->module_view_folder.'.payment_card',$this->arr_view_data);
    } // end listing


    /*
    | Function  : Get all the card details and store it to stripe account
    | Author    : Deepak Arvind Salunke
    | Date      : 10/10/2017
    | Output    : Success or Error
    */

    public function store(Request $request)
    {
		$arr_rules['card_no']           =   "required";
		$arr_rules['cvv']               =   "required";
		$arr_rules['card_expiry_date']  =   "required";
		//$arr_rules['card_type']         =   "required";

		$validator  =   Validator::make($request->all(),$arr_rules);
		if($validator->fails())
		{
			$arr_response['msg']= "All fields are required";
			return response()->json($arr_response);
		}

		$cvv              = $request->input('cvv');
		$card_no          = $request->input('card_no');
		//$card_type = $request->input('card_type');

		$card_expiry_date = $request->input('card_expiry_date');
		$arr_expire       = explode('/', $card_expiry_date);
		$expire_month     = $arr_expire[0];
		$expire_year      = $arr_expire[1];

		\Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

		// Create a token
		$token = \Stripe\Token::create(array(
			"card" => array(
				"number"    => $card_no,
				"exp_month" => $expire_month,
			  	"exp_year"  => $expire_year,
			  	"cvc"       => $cvv,
			)
		));

		$user     = Sentinel::findById($this->user_id);

		$get_user = $this->StripeCustomerModel->where('user_id',$this->user_id)->first();
		if(count($get_user) > 0)
		{
			$cust_list = $get_user->toArray();

			$customer = \Stripe\Customer::retrieve($cust_list['customer_id']);
			$card = $customer->sources->create(array(
				"source" => $token
			));

			$data['user_id']     = $this->user_id;
			$data['customer_id'] = $cust_list['customer_id'];
			$data['card_id'] 	 = $card->id;

			$action = $this->StripeCardModel->insert($data);
		}
		else
		{
			// Create a Customer
			$customer = \Stripe\Customer::create(array(
				"email" => $user->email
			));

			$customer = \Stripe\Customer::retrieve($customer->id);
			$card = $customer->sources->create(array(
				"source" => $token
			));

			$data['user_id']     = $this->user_id;
			$data['customer_id'] = $customer->id;
			$action = $this->StripeCustomerModel->insert($data);			

			$data['user_id']     = $this->user_id;
			$data['customer_id'] = $customer->id;
			$data['card_id'] 	 = $card->id;
			$action = $this->StripeCardModel->insert($data);
		}
		
		if($action)
		{
			$arr_response['msg']= "Payment method added successfully !";
		}
		else
		{
			$arr_response['msg']= "Something went to wrong";
		}
		return response()->json($arr_response);

    } // end store


    /*
    | Function  : Get all the card details and store it to stripe account
    | Author    : Deepak Arvind Salunke
    | Date      : 11/10/2017
    | Output    : Success or Error
    */    

    public function delete(Request $request)
    {
        $arr_rules['id'] = "required";
        
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
	        $arr_response['msg']= "Please select card to delete!";
	        return response()->json($arr_response);
        }
        $id = $request->input('id');

        $get_customer_id = $this->StripeCardModel->where('user_id',$this->user_id)
                                                 ->where('id', $id)
                                                 ->first();
        if($get_customer_id)
        {
        	$customer_list = $get_customer_id->toArray();
        }
        
        \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));
        $customer = \Stripe\Customer::retrieve($customer_list['customer_id']);
        $confirm = $customer->sources->retrieve($customer_list['card_id'])->delete();

        if($confirm->deleted == true)
        {
	        $del_customer_id = $this->StripeCardModel->where('user_id',$this->user_id)
	                                                 ->where('id', $id)
	                                                 ->delete();

	        $arr_response['msg'] = "Payment method deleted successfully";
        }
        else
        {
          	$arr_response['msg'] = "Something went to wrong";
        }
        return response()->json($arr_response);

    } // end delete

}
?>