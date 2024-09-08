<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethodsModel;
use App\Models\CreditsModel;
use App\Models\MembershipPaymentModel;
use App\Models\StripeCustomerModel;
use App\Models\StripeCardModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;
use Session;
use DB;
use Stripe;


class CardController extends Controller
{
    public function __construct(MembershipPaymentModel           $MembershipPaymentModel,
                                StripeCustomerModel              $StripeCustomerModel,
                                StripeCardModel              	 $StripeCardModel)
    {
        $this->arr_view_data                        = [];
        $this->module_title                         = "Booking";
        $this->module_url_path                      = url('/').'/doctor/settings/card/';
        $this->module_view_folder                   = "front.doctor.settings.membership";

        $this->MembershipPaymentModel               = $MembershipPaymentModel;
        $this->StripeCustomerModel                  = $StripeCustomerModel;
        $this->StripeCardModel                  	= $StripeCardModel;

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

			$card_details['customer_id']= $customer->id;
			$card_details['card_type']  = $card->brand;
			$card_details['card_no']    = $card->last4;
			$card_details['exp_month']  = $card->exp_month;
			$card_details['exp_year']   = $card->exp_year;

			$get_card_id = $this->StripeCardModel->where('card_id',$list['card_id'])->first();
			if($get_card_id)
			{
				$card_list = $get_card_id->toArray();
			}

			$card_details['id']         = $card_list['id'];

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

    	if(!empty($request->input('Package'))){
		        \Session::put('mem_package' ,  $request->input('Package'));
		}

		$arr_rules['card_no']           =   "required";
		$arr_rules['cvv']               =   "required";
		$arr_rules['card_expiry_date']  =   "required";

		$validator  =   Validator::make($request->all(),$arr_rules);
		if($validator->fails())
		{
			$arr_response['msg']= "All fields are required";
			return response()->json($arr_response);
		}

		$cvv              = $request->input('cvv');
		$card_no          = $request->input('card_no');

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
			$action              = $this->StripeCustomerModel->insert($data);			

			$data['user_id']     = $this->user_id;
			$data['customer_id'] = $customer->id;
			$data['card_id'] 	 = $card->id;
			$action              = $this->StripeCardModel->insert($data);
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