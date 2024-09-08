<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PaymentMethodsModel;
use App\Models\CreditsModel;
use App\Models\MembershipPaymentModel;
use App\Models\StripeCustomerModel;
use App\Models\DoctorPremiumRateModel;
use App\Models\StripeCardModel;
use App\Models\StripeConnectedAccountsModel;
use App\Models\DoctorPremiumMembershipModel;
use App\Models\PatientConsultationPaymentModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\DoctroFeesModel;
use App\Models\AdminProfileModel;
use App\Models\FamilyDoctorsModel;
use App\Models\UserModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;
use Session;
use DB;
use Stripe;
use Mail;


class PaymentController extends Controller
{
    public function __construct(MembershipPaymentModel           $MembershipPaymentModel,
                                StripeCustomerModel              $StripeCustomerModel,
                                DoctorPremiumRateModel           $DoctorPremiumRateModel,
                                StripeCardModel                  $StripeCardModel,
                                StripeConnectedAccountsModel     $StripeConnectedAccountsModel,
                                DoctorPremiumMembershipModel     $DoctorPremiumMembershipModel,
                                PatientConsultationPaymentModel  $PatientConsultationPaymentModel,
                                PatientConsultationBookingModel  $PatientConsultationBookingModel,
                                AdminProfileModel                $AdminProfileModel,
                                DoctroFeesModel                  $DoctroFeesModel,
                                FamilyDoctorsModel               $FamilyDoctorsModel,
                                UserModel                        $UserModel)
    {
        $this->arr_view_data                        = [];
        $this->module_title                         = "Booking";
        $this->module_url_path                      = url('/').'/patient/payment';
        $this->module_view_folder                   = "front.patient.payment";

        $this->MembershipPaymentModel               = $MembershipPaymentModel;
        $this->StripeCustomerModel                  = $StripeCustomerModel;
        $this->DoctorPremiumRateModel               = $DoctorPremiumRateModel;
        $this->StripeCardModel                      = $StripeCardModel;
        $this->StripeConnectedAccountsModel         = $StripeConnectedAccountsModel;
        $this->DoctorPremiumMembershipModel         = $DoctorPremiumMembershipModel;
        $this->PatientConsultationPaymentModel      = $PatientConsultationPaymentModel;
        $this->PatientConsultationBookingModel      = $PatientConsultationBookingModel;
        $this->DoctroFeesModel                      = $DoctroFeesModel;
        $this->AdminProfileModel                    = $AdminProfileModel;
        $this->FamilyDoctorsModel                   = $FamilyDoctorsModel;
        $this->UserModel                            = $UserModel;

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

    public function stripePayment(Request $request)
    {
      $account_data = [];
      $card_id = $request->input('card_id');

      if(!empty(Session::get('booking.booking_fee')))
      {
        $booking_fee = Session::get('booking.booking_fee');
      }
      elseif(empty(Session::get('booking.booking_fee')))
      {
        return redirect(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }

      $total_amount = add_gst($booking_fee);

      //$amount = substr($booking_fee,1,5);

      // get doctor id
      //$doctor_id = Session::get('booking.doctor_id');

      if(!empty(Session::get('booking.doctor_id')))
      {
        // get doctor id
        $doctor_id = Session::get('booking.doctor_id');
      }
      elseif(empty(Session::get('booking.doctor_id')))
      {
        return redirect(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }
      
      if(empty(Session::get('booking.patient')) || empty(Session::get('booking.symptoms')) || empty(Session::get('booking.user_type')))
      {
        return redirect(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }

      // get doctor set rate for consultations
      $doctor_id = Session::get('booking.doctor_id');
      $get_doctor_rate = $this->DoctorPremiumRateModel->where('doctor_id', $doctor_id)->first();
      if($get_doctor_rate)
      {
        $doctor_rate = $get_doctor_rate->toArray();
      }

      // get card id and customer id for payment
      $get_card_details = $this->StripeCardModel->where('id', $card_id)->first();
      if($get_card_details)
      {
        $card_details = $get_card_details->toArray();
      }

      // get connected account id
      $get_account_data = $this->StripeConnectedAccountsModel->where('user_id', $doctor_id)->first();
      if($get_account_data)
      {
        $account_data = $get_account_data->toArray();
      }
      if(empty($account_data) || $account_data == '')
      {
        return response()->back(url('/')."/patient/booking")->with('error', 'Your Consultation session has expire please try again.');
      }

      \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

      // for Payment
      try{

          $charge = Stripe\Charge::create(array(
            "customer"        => $card_details['customer_id'],
            "source"          => $card_details['card_id'],
            "amount"          => (int) $total_amount * 100,
            "capture"         => false,
            "currency"        => "AUD",
            "application_fee" => 500,
            "destination"     => array(
                "account"   => $account_data['connect_id']
              ),
          ));

      } catch (\Stripe\Error\RateLimit $excharge) {
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
      } catch (\Stripe\Error\InvalidRequest $excharge) {
        // Invalid parameters were supplied to Stripe's API
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
      } catch (\Stripe\Error\Authentication $excharge) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
      } catch (\Stripe\Error\ApiConnection $excharge) {
        // Network communication with Stripe failed
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
      } catch (\Stripe\Error\Base $excharge) {
        // Display a very generic error to the user, and maybe send
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
        // yourself an email
      } catch (Exception $excharge) {
        // Something else happened, completely unrelated to Stripe
          $charge = $excharge->getJsonBody();
          $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
      }
      

      if($charge['status'] == 'succeeded')
      {
        // check if transaction id is already present in session
        if(!empty(Session::get('booking.transaction_id')))
        {
          Session::forget('booking.transaction_id');
        }

        Session::put('booking', array_add($booking = Session::get('booking'), 'transaction_id', $charge['id']));
        return redirect(url('').'/patient/booking/store_booking');
      }
      else if($userMsg != '' && $userMsg != null)
      {
        Session::flash('message', $userMsg);
        return redirect()->back();
      }
      else if($userMsg == '' && $userMsg == null)
      {
        Session::flash('message', 'Something went wrong. PLease try again later');
        return redirect()->back();
      }
    }


    public function membershipPayment(Request $request)
    {
      $userMsg = $membership_amount = '';

      $card_id            = $request->input('card_id');
      $membership_package = $request->input('membership_package');
      $membership_price   = $request->input('membership_price');
      $base_price         = $request->input('base_price');
      $gst_price          = $request->input('gst_price');
      $discount_id        = $request->input('discount_id');

      $get_member_plan = $this->DoctorPremiumMembershipModel->first();
      if($get_member_plan)
      {
        $member_plan = $get_member_plan->toArray();

        if($membership_package == 'monthly')
        {
          $membership_amount = $member_plan['total_monthly_amount'];
        }
        else if($membership_package == 'annually')
        {
          $membership_amount = $member_plan['total_annually_amount']; 
        }
      }

      // get card id and customer id for payment
      $get_card_details = $this->StripeCardModel->where('user_id', $this->user_id)->where('card_id', $card_id)->first();
      if($get_card_details)
      {
        $card_details = $get_card_details->toArray();
      }

      // check if card no is already present in session
      if(!empty(Session::get('membership.card_id')))
      {
        Session::forget('membership.card_id');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'card_id', $card_id));

      // check if package is already present in session
      if(!empty(Session::get('membership.membership_package')))
      {
        Session::forget('membership.membership_package');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'membership_package', $membership_package));

      // check if price is already present in session
      if(!empty(Session::get('membership.membership_price')))
      {
        Session::forget('membership.membership_price');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'membership_price', $membership_price));

      // check if discount id is already present in session
      if(!empty(Session::get('membership.discount_id')))
      {
        Session::forget('membership.discount_id');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'discount_id', $discount_id));

      \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

      $_output = $_token = $_transfer = [];
      $ex_output = $ex_token = $ex_transfer = '';


        // for Payment
        try{

            $_output = \Stripe\Charge::create([
                "customer" => $card_details['customer_id'],
                "source"   => $card_details['card_id'],
                "amount"   => (int) $membership_price * 100,
                'currency' => 'AUD',
            ]);

        } catch (\Stripe\Error\RateLimit $ex_output) {
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_output) {
          // Invalid parameters were supplied to Stripe's API
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_output) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_output) {
          // Network communication with Stripe failed
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_output) {
          // Display a very generic error to the user, and maybe send
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_output) {
          // Something else happened, completely unrelated to Stripe
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        if($_output['status'] == 'succeeded')
        {
          // check if transaction id is already present in session
          if(!empty(Session::get('membership.transaction_id')))
          {
            Session::forget('membership.transaction_id');
          }
          Session::put('membership', array_add($membership = Session::get('membership'), 'transaction_id', $_output['id']));
          Session::set('payment_status','paid');

          return redirect(url('').'/doctor/membership/store');
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 17/11/2017
    | Output    : Success or Error
    */

    public function confirm_payment(Request $request)
    {
      $content = [];
      $booking_id = $request->input('booking_id');
      $patient_name = ltrim(rtrim($request->input('patient_name')));
      $doctor_consultation_notes = $request->input('doctor_consultation_notes');
      $symptoms = $request->input('symptoms');
      $doc_files_arr = $request->file('doc_files_arr');
      $doc_images_arr = $request->file('doc_images_arr');
      $pat_images_arr = $request->file('pat_images_arr');
      $purpose_for_arr = $request->input('purpose_for_arr');


      $get_booking_data = $this->PatientConsultationBookingModel->where('id', $booking_id)->first();
      if($get_booking_data)
      {
        $booking_data       = $get_booking_data->toArray();

        $patient_id         = $booking_data['patient_user_id'];
        $doctor_id          = $booking_data['doctor_user_id'];
        $charge_id          = $booking_data['transaction_id'];
        $doctor_charge_per_4_mins = $booking_data['consultation_charge'];
        $doctor_charge_per_min = $booking_data['consultation_charge_per_min'];

        $call_time_doctor   = $booking_data['call_time'];
        //if($call_time == ''){ $call_time = '00:00:00'; }
        $call_time_patient  = $booking_data['call_time_patient'];


        // get the smallest time of booking
        if(strtotime($call_time_doctor) > strtotime($call_time_patient))
        {
          $call_time = $call_time_patient;
        }
        else
        {
          $call_time = $call_time_doctor;
        }


        // convert sec's or hour's into min's
        $rounded = date('H:i:s', round(strtotime($call_time)/60)*60);
        $explode = explode(':', $rounded);
        $h       = $explode[0];
        $m       = $explode[1];
        if($h != 00)
        {
          $h_to_m = $h * 60;
          $m = $m + $h_to_m;
        }

        //count total no of consultation invoice
        $count_invoice = $this->PatientConsultationPaymentModel->count();
        if($count_invoice <= 0)
        {
          $invoice_id = "I00401";
        }
        else
        {
          //get the last invoice_id
          $get_id  = $this->PatientConsultationPaymentModel->latest()->first();
          if($get_id)
          {
            $new_id = substr($get_id->invoice_id, 1);
            $invoice_id = "I".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
          }
        }

        // check call if less than or more than 4 mins

        // if call is equal or less than 4 mins
        if($m <= 4)
        {
          
              // equal to 4 mins
              if($m == 4)
              {
                  \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

                  // for Payment
                  try
                  {

                    $charge = Stripe\Charge::retrieve($charge_id);
                    $charge->capture();
                  }
                  catch (\Stripe\Error\RateLimit $excharge)
                  {
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  }
                  catch (\Stripe\Error\InvalidRequest $excharge)
                  {
                      // Invalid parameters were supplied to Stripe's API
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  }
                  catch (\Stripe\Error\Authentication $excharge)
                  {
                      // Authentication with Stripe's API failed
                      // (maybe you changed API keys recently)
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  }
                  catch (\Stripe\Error\ApiConnection $excharge)
                  {
                      // Network communication with Stripe failed
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  }
                  catch (\Stripe\Error\Base $excharge)
                  {
                      // Display a very generic error to the user, and maybe send
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                      // yourself an email
                  }
                  catch (Exception $excharge)
                  {
                      // Something else happened, completely unrelated to Stripe
                      $charge = $excharge->getJsonBody();
                      $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  }

                  if(($userMsg != null) && !empty($userMsg))
                  {
                      echo "error";
                  }

                  if($charge['status'] == 'succeeded')
                  {
                    $data['invoice_id']     = $invoice_id;
                    $data['booking_id']     = $booking_id;
                    $data['patient_id']     = $patient_id;
                    $data['doctor_id']      = $doctor_id;
                    $data['charge_id']      = $charge_id;
                    $data['payment_status'] = 'completed';
                    $data['payment_amount'] = $doctor_charge_per_4_mins;
                    $data['call_time']      = gmdate('H:i:s', $m * 60);

                    $store_charge = $this->PatientConsultationPaymentModel->insert($data);
                  }
              }

              // less than 4 mins
              else
              {
                    \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

                    try 
                    {
                        $charge = Stripe\Charge::retrieve($charge_id);
                        $charge->capture();
                    }
                    catch (\Stripe\Error\RateLimit $excharge)
                    {
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                    }
                    catch (\Stripe\Error\InvalidRequest $excharge)
                    {
                        // Invalid parameters were supplied to Stripe's API
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                    }
                    catch (\Stripe\Error\Authentication $excharge)
                    {
                        // Authentication with Stripe's API failed
                        // (maybe you changed API keys recently)
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                    }
                    catch (\Stripe\Error\ApiConnection $excharge)
                    {
                        // Network communication with Stripe failed
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                    }
                    catch (\Stripe\Error\Base $excharge)
                    {
                        // Display a very generic error to the user, and maybe send
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                        // yourself an email
                    }
                    catch (Exception $excharge)
                    {
                        // Something else happened, completely unrelated to Stripe
                        $charge = $excharge->getJsonBody();
                        $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                    }

                    if(($userMsg != null) && !empty($userMsg))
                    {
                        echo "error";
                    }

                    if($charge['status'] == 'succeeded')
                    {
                        $data['invoice_id']     = $invoice_id;
                        $data['booking_id']     = $booking_id;
                        $data['patient_id']     = $patient_id;
                        $data['doctor_id']      = $doctor_id;
                        $data['charge_id']      = $charge->id;
                        $data['payment_status'] = 'completed';
                        $data['payment_amount'] = $doctor_charge_per_4_mins;
                        $data['call_time']      = gmdate('H:i:s', $m * 60);

                        $store_charge = $this->PatientConsultationPaymentModel->insert($data);
                    }
              }
        }

        // if call time is more than 4 mins 
        else
        {
              // more than 4 mins
              $extra_mins = (int) $m - 4;

              // capture amount for 4 mins
              \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

              try 
              {
                  $charge = Stripe\Charge::retrieve($charge_id);
                  $charge->capture();
              }
              catch (\Stripe\Error\RateLimit $excharge)
              {
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              }
              catch (\Stripe\Error\InvalidRequest $excharge)
              {
                  // Invalid parameters were supplied to Stripe's API
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              }
              catch (\Stripe\Error\Authentication $excharge)
              {
                  // Authentication with Stripe's API failed
                  // (maybe you changed API keys recently)
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              }
              catch (\Stripe\Error\ApiConnection $excharge)
              {
                  // Network communication with Stripe failed
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              }
              catch (\Stripe\Error\Base $excharge)
              {
                  // Display a very generic error to the user, and maybe send
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
                  // yourself an email
              }
              catch (Exception $excharge)
              {
                  // Something else happened, completely unrelated to Stripe
                  $charge = $excharge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$charge['error']['message'].'.';
              }

              if(($userMsg != null) && !empty($userMsg))
              {
                  echo "error";
              }

              if($charge['status'] == 'succeeded')
              {
                $data['invoice_id']     = $invoice_id;
                $data['booking_id']     = $booking_id;
                $data['patient_id']     = $patient_id;
                $data['doctor_id']      = $doctor_id;
                $data['charge_id']      = $charge_id;
                $data['payment_status'] = 'completed';
                $data['payment_amount'] = $doctor_charge_per_4_mins;
                $data['call_time']      = gmdate('H:i:s', 4 * 60);

                $store_charge = $this->PatientConsultationPaymentModel->insert($data);
              }


              // for extra mins of call 
              $extra_amount = (int) $extra_mins * (int) $doctor_charge_per_min;

              $total_extra_amount = add_gst($extra_amount);

              // get connected account id
              $get_account_data = $this->StripeConnectedAccountsModel->where('user_id', $doctor_id)->first();
              if($get_account_data)
              {
                $account_data = $get_account_data->toArray();
              }


              // charge for extra amount
              \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

              try 
              {
                  $extra_charge = Stripe\Charge::create(array(
                    "customer"        => $charge->customer,
                    "source"          => $charge->source->id,
                    "amount"          => (int) $total_extra_amount * 100,
                    "currency"        => "AUD",
                    //"application_fee" => 500,
                    "destination"     => array(
                          "account"   => $account_data['connect_id'],
                          //"amount"  => 1500
                        ),
                  ));
              }
              catch (\Stripe\Error\RateLimit $exextra_charge)
              {
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
              }
              catch (\Stripe\Error\InvalidRequest $exextra_charge)
              {
                  // Invalid parameters were supplied to Stripe's API
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
              }
              catch (\Stripe\Error\Authentication $exextra_charge)
              {
                  // Authentication with Stripe's API failed
                  // (maybe you changed API keys recently)
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
              }
              catch (\Stripe\Error\ApiConnection $exextra_charge)
              {
                  // Network communication with Stripe failed
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
              }
              catch (\Stripe\Error\Base $exextra_charge)
              {
                  // Display a very generic error to the user, and maybe send
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
                  // yourself an email
              }
              catch (Exception $exextra_charge)
              {
                  // Something else happened, completely unrelated to Stripe
                  $extra_charge = $exextra_charge->getJsonBody();
                  $userMsg = 'Transaction failed - '.$extra_charge['error']['message'].'.';
              }

              if(($userMsg != null) && !empty($userMsg))
              {
                  echo "error";
              }


              if($extra_charge['status'] == 'succeeded')
              {
                $data['invoice_id']     = $invoice_id;
                $data['booking_id']     = $booking_id;
                $data['patient_id']     = $patient_id;
                $data['doctor_id']      = $doctor_id;
                $data['charge_id']      = $extra_charge->id;
                $data['payment_status'] = 'completed';
                $data['payment_amount'] = $extra_amount;
                $data['call_time']      = gmdate('H:i:s', $extra_mins * 60);

                $store_charge = $this->PatientConsultationPaymentModel->insert($data);
              }

        }
        $data = [''];
        if($store_charge)
        {
          
          $update_booking['booking_status'] = 'Completed';
          $update_booking['patient_active_video_call'] = 'no';
          $update_booking['doctor_active_video_call'] = 'no';
          $this->PatientConsultationBookingModel->where('id', $booking_id)->update($update_booking);

          $get_family_doctor = $this->FamilyDoctorsModel->where('user_id', $patient_id)->where('consultation_details', 'yes')->with('userinfo')->get();
          if($get_family_doctor)
          {
            $family_doctor_data = $get_family_doctor->toArray();

            if(count($family_doctor_data) > 0)
            {

              foreach ($family_doctor_data as $doc_data)
              {
                  $content = [];
                  /* -- send mail to family doctor of the patient -- */
                  /* content variables in view */

                  $content['booking_data']    = $booking_data;
                  $content['patient_name']    = $patient_name;
                  $content['doctor_consultation_notes']  = $doctor_consultation_notes;
                  $content['symptoms']        = $symptoms;
                  $content['purpose_for_arr'] = $purpose_for_arr;
                  /*$content['doc_files_arr']   = $doc_files_arr;
                  $content['doc_images_arr']  = $doc_images_arr;
                  $content['pat_images_arr']  = $pat_images_arr;*/
                  $content['first_name']      = $doc_data['first_name'];
                  $content['last_name']       = $doc_data['last_name'];
                  $content['doc_email']       = $doc_data['email'];

                  /* built content variables in view */
                  $content             = view('front.email.consult_details',compact('content'))->render();
                  $content             = html_entity_decode($content);
                  /* end built content variables in view */
                 
                  $to_email_id         = $doc_data['email'];;
                  $project_name        = config('app.project.name');
                  $mail_subject        = config('app.project.name').' - Consultations Details';


                  /* get admin email */
                      $get_admin       = $this->AdminProfileModel->first();
                      $get_admin       = $get_admin->toArray();
                      $mail_form       = $get_admin['contact_email'];
                  /* end get admin email */    

                  if(!empty($mail_form))
                  {
                      $mail_form           = $mail_form;
                  }
                  else{
                      $mail_form           = config('app.project.admin_email');
                  }
                  $mail_form               = $mail_form;
                  $send_mail = Mail::send(array(), array(), function ($message) use ($to_email_id, $mail_form, $project_name, $mail_subject, $content, $doc_files_arr, $doc_images_arr, $pat_images_arr) {
                        $message->from($mail_form, $project_name);
                        $message->to($to_email_id)
                                ->subject($mail_subject)
                                ->setBody($content, 'text/html');

                        foreach($pat_images_arr as $patImgfiles)
                        {
                          $message->attach($patImgfiles->getPathName());
                        }

                        foreach($doc_images_arr as $docImgfiles)
                        {
                          $message->attach($docImgfiles->getPathName());
                        }

                        foreach($doc_files_arr as $docfiles)
                        {
                          $message->attach($docfiles->getPathName());
                        }
                  });
                  /* -- end  mail to family doctor of the patient -- */     
              }

              
            }
          }
          echo "success";
        }
        else
        {
          echo "error";
        }
        
      }

    } // end confirm_payment


    public function authenticate_code()
    {
        if($_REQUEST['code'])
        {
          $code = $_REQUEST['code'];
          $stripeKey = config('services.stripe.STRIPE_SECRET');
          $client_id = config('services.stripe.CLIENT_ID');

          $params = array();
          $params['grant_type'] = 'authorization_code';
          $params['code'] = $code;
          $params['client_secret'] = $stripeKey;
          $params['client_id'] = $client_id;

          $url = 'https://connect.stripe.com/oauth/token';

          $ch = curl_init();
          $header = array ();
          curl_setopt( $ch, CURLOPT_URL, $url );
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

          curl_setopt( $ch, CURLOPT_POSTFIELDS,$params);

          $response = curl_exec( $ch );
          $resp = json_decode($response, true);
          
          if($resp['token_type'] == 'bearer')
          {
            return redirect( url('/')."/thankyou/You've%20successfully%20connected%20your%20stripe%20account%20to%20doctoroo%20stripe%20account!/Stripe%20Account%20Connected" );
          }
          else if($resp['error'] == 'invalid_grant')
          {
            return redirect( url('/')."/doctor/error/Stripe" );
          }

        }
        else
        {
          return redirect( url('/')."/doctor/error/Stripe" );
        }
    }












    public function stripePayment1(Request $request)
    {
      //dd($request->all());
      //dd(Session::get('booking'));

      $card_no      = base64_decode($request->input('card_no'));
      $expire_date  = $request->input('expire_date');
      $arr_expire   = explode('/', $expire_date);
      $expire_month = $arr_expire[0];
      $expire_year  = $arr_expire[1];
      $cvv          = $request->input('cvv');

      $userMsg      = '';

      // check if card no is already present in session
      if(!empty(Session::get('booking.card_no')))
      {
        Session::forget('booking.card_no');
      }
      Session::put('booking', array_add($booking = Session::get('booking'), 'card_no', $card_no));

      // check if expire month is already present in session
      if(!empty(Session::get('booking.expire_month')))
      {
        Session::forget('booking.expire_month');
      }
      Session::put('booking', array_add($booking = Session::get('booking'), 'expire_month', $expire_month));

      // check if expire year is already present in session
      if(!empty(Session::get('booking.expire_year')))
      {
        Session::forget('booking.expire_year');
      }
      Session::put('booking', array_add($booking = Session::get('booking'), 'expire_year', $expire_year));

      // check if cvv is already present in session
      if(!empty(Session::get('booking.cvv')))
      {
        Session::forget('booking.cvv');
      }
      Session::put('booking', array_add($booking = Session::get('booking'), 'cvv', $cvv));


      \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

      $_output = $_token = $_transfer = [];
      $ex_output = $ex_token = $ex_transfer = '';

      // for token
      try{
            $_token = \Stripe\Token::create([
              'card' => [
                  'number'    => $card_no,
                  'exp_month' => $expire_month,
                  'exp_year'  => $expire_year,
                  //'cvc'       => $cvv,
              ],
            ]);

        // check if transaction id is already present in session
        if(!empty(Session::get('booking.transaction_id')))
        {
          Session::forget('booking.transaction_id');
        }
          Session::put('booking', array_add($booking = Session::get('booking'), 'transaction_id', $_token['id']));

        } catch (\Stripe\Error\RateLimit $ex_token) {
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_token) {
          // Invalid parameters were supplied to Stripe's API
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_token) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_token) {
          // Network communication with Stripe failed
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_token) {
          // Display a very generic error to the user, and maybe send
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_token) {
          // Something else happened, completely unrelated to Stripe
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        // for Payment
        try{

            $_output = \Stripe\Charge::create([
                'source' => $_token['id'],
                'currency' => 'AUD',
                'amount'   => '50',
                //"transfer_group" => "ORDER10",
            ]);

        } catch (\Stripe\Error\RateLimit $ex_output) {
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_output) {
          // Invalid parameters were supplied to Stripe's API
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_output) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_output) {
          // Network communication with Stripe failed
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_output) {
          // Display a very generic error to the user, and maybe send
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_output) {
          // Something else happened, completely unrelated to Stripe
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        // For payment sharing 
        /*try{

            $_transfer = \Stripe\Transfer::create(array(
              "amount" => 4000,
              "currency" => "AUD",
              "destination" => "acct_1A4StfByoSvp1xL0",
              "transfer_group" => "ORDER10",
            ));

        } catch (\Stripe\Error\RateLimit $ex_transfer) {
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_transfer) {
          // Invalid parameters were supplied to Stripe's API
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_transfer) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_transfer) {
          // Network communication with Stripe failed
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_transfer) {
          // Display a very generic error to the user, and maybe send
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_transfer) {
          // Something else happened, completely unrelated to Stripe
            $_transfer = $ex_transfer->getJsonBody();
            $userMsg = 'Transaction failed - '.$_transfer['error']['message'].'.';
        }*/

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        if($_output['status'] == 'succeeded')
        {
          return redirect(url('').'/patient/booking/store_booking');
        }
    }


    public function membershipPayment1(Request $request)
    {
      $membership = $this->MembershipPaymentModel->where('doctor_id',$this->user_id)
                                                     ->orderBy('id','DESC')
                                                     ->first();

      if(isset($membership) && !empty($membership))
      {
        $membership_arr = $membership->toArray();

        if(isset($membership['package']) && !empty($membership['package']))
        {
          if($membership['package'] == 'monthly' || $membership['package'] == 'annually')
           {
            $curr = date("Y-m-d H:i:s",strtotime('+1 month'));
            $current_datetime = date("Y-m-d H:i:s");
            
            if($current_datetime < date($membership['end_date']))
            {
              $end_date = date("F d, Y", strtotime($membership['end_date']));
              if($membership['package'] ='annually')
              {
                $package = 'Annual';
              }
              else if($membership['package'] ='annually')
              {
                $package = 'Monthly';
              }
              Session::flash('message', 'You already have '.$package.'  membership that ends on '.$end_date.'. You may change your membership');
              return redirect()->back();
            }
            
           }
        }
      }

      //dd($request->all());

      /*$card_no            = base64_decode($request->input('card_no'));
      $expire_date        = $request->input('expire_date');
      $arr_expire         = explode('/', $expire_date);
      $expire_month       = $arr_expire[0];
      $expire_year        = $arr_expire[1];
      $cvv                = $request->input('cvv');*/

      $card_id            = $request->input('card_id');
      $membership_package = $request->input('membership_package');

      $userMsg      = '';

      // check if card no is already present in session
      if(!empty(Session::get('membership.card_no')))
      {
        Session::forget('membership.card_no');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'card_no', $card_no));

      // check if package is already present in session
      if(!empty(Session::get('membership.membership_package')))
      {
        Session::forget('membership.membership_package');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'membership_package', $membership_package));

      // check if expire month is already present in session
      if(!empty(Session::get('membership.expire_month')))
      {
        Session::forget('membership.expire_month');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'expire_month', $expire_month));

      // check if expire year is already present in session
      if(!empty(Session::get('membership.expire_year')))
      {
        Session::forget('membership.expire_year');
      }
      
      Session::put('membership', array_add($membership = Session::get('membership'), 'expire_year', $expire_year));

      // check if cvv is already present in session
      if(!empty(Session::get('membership.cvv')))
      {
        Session::forget('membership.cvv');
      }
      Session::put('membership', array_add($membership = Session::get('membership'), 'cvv', $cvv));

      \Stripe\Stripe::setApiKey(config('services.stripe.STRIPE_SECRET'));

      $_output = $_token = $_transfer = [];
      $ex_output = $ex_token = $ex_transfer = '';

      // for token
      try{
            $_token = \Stripe\Token::create([
              'card' => [
                  'number'    => $card_no,
                  'exp_month' => $expire_month,
                  'exp_year'  => $expire_year,
                  'cvc'       => $cvv,
              ],
            ]);

        // check if transaction id is already present in session
        if(!empty(Session::get('membership.transaction_id')))
        {
          Session::forget('membership.transaction_id');
        }
        Session::put('membership', array_add($membership = Session::get('membership'), 'transaction_id', $_token['id']));

        } catch (\Stripe\Error\RateLimit $ex_token) {
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_token) {
          // Invalid parameters were supplied to Stripe's API
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_token) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_token) {
          // Network communication with Stripe failed
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_token) {
          // Display a very generic error to the user, and maybe send
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_token) {
          // Something else happened, completely unrelated to Stripe
            $_token = $ex_token->getJsonBody();
            $userMsg = 'Transaction failed - '.$_token['error']['message'].'.';
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        // for Payment
        try{

            $_output = \Stripe\Charge::create([
                'source' => $_token['id'],
                'currency' => 'AUD',
                'amount'   => '99',
            ]);

        } catch (\Stripe\Error\RateLimit $ex_output) {
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\InvalidRequest $ex_output) {
          // Invalid parameters were supplied to Stripe's API
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Authentication $ex_output) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\ApiConnection $ex_output) {
          // Network communication with Stripe failed
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        } catch (\Stripe\Error\Base $ex_output) {
          // Display a very generic error to the user, and maybe send
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
          // yourself an email
        } catch (Exception $ex_output) {
          // Something else happened, completely unrelated to Stripe
            $_output = $ex_output->getJsonBody();
            $userMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        if(($userMsg != null) && !empty($userMsg))
        {
          Session::flash('message', $userMsg);
          return redirect()->back();
        }

        if($_output['status'] == 'succeeded')
        {
          return redirect(url('').'/doctor/membership/store');
        }
    }

    public function _payment_initiate(Request $request)
    {
        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/

      $this->arr_view_data['page_title']                = "Processing your payment";
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.initiate-payment',$this->arr_view_data);
    }
    

    public function payment_initiate(Request $request)
    {
        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $presentation = PayPal::Presentation();

        $item1 = PayPal::Item();
        $item1->setName(session('paymentGatewayData.paymentDesc'))
              ->setDescription(session('paymentGatewayData.paymentDesc'))
              ->setCurrency(config('services.paypal.currencyType'))
              ->setQuantity(1)
              ->setPrice(session('paymentGatewayData.netPayablePrice'));

        $itemList = PayPal::ItemList();
        $itemList->addItem($item1);

        $details = PayPal::Details();
        $details->setShipping(0)->setTax(0.0)->setSubTotal(session('paymentGatewayData.netPayablePrice'));

        $amount = PayPal:: Amount();
        $amount->setCurrency(config('services.paypal.currencyType'));
        $amount->setTotal(session('paymentGatewayData.netPayablePrice'))
               ->setDetails($details);
       
        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setInvoiceNumber(uniqid());
        $transaction->setDescription(session('paymentGatewayData.paymentDesc'));

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(url('').'/payment/approve/');
        $redirectUrls->setCancelUrl(url('').'/payment/cancel/');

        $payment = PayPal::Payment();
        $payment->setIntent(config('services.paypal.authType'));
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

      $response = $payment->create($this->_apiContext);
      $redirectUrl = $response->links[1]->href;
      $redirectTo = $redirectUrl;

      $this->arr_view_data['redirectTo']                = $redirectTo;

      $this->arr_view_data['page_title']                = "Processing your payment";
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.initiate-payment',$this->arr_view_data);
    }

    public function payment_approve(Request $request)
    {
        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        $payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        $result = $payment->execute($paymentExecution, $this->_apiContext);

        if(count($result) && isset($result->transactions[0]->related_resources[0]->sale->id) )
        {
            $txn_id = $result->transactions[0]->related_resources[0]->sale->id;
            $redirectTo = url('').'/payment/success/?txn_id='.$txn_id;
        }
        else{
            return redirect(url('').'/payment/error/');
        }

        $data = array('pageTitle' => 'Approving your payment', 'middleContent' => 'front.payment.payment-approve','multipleArray' => array('redirectTo' => $redirectTo));
        return view('front.template')->with($data);

      $this->arr_view_data['redirectTo']                = $redirectTo;

      $this->arr_view_data['page_title']                = "Processing your payment";
      $this->arr_view_data['module_url_path']           = $this->module_url_path;
    }

    public function payment_success(Request $request)
    {
        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/
        $txn_id = $request->get('txn_id');

        if(isset($txn_id) && !empty($txn_id))
        {
            $this->arr_view_data['transaction_id'] = $txn_id;
            $this->arr_view_data['returnPageUrl']  = url('/').'/patient/booking/booking_request_confirmation';
            $this->arr_view_data['grandTotal']     = "24";

            Session::forget('booking.transaction_id');

            // update session booking array
            Session::put('booking', array_add($booking = Session::get('booking'), 'transaction_id', $txn_id));
        }
        else
        {
            return redirect(url('').'/patient/booking/payment/error');
        }

        $this->arr_view_data['page_title']          = "Successfull Payment";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        //return view($this->module_view_folder.'.payment-success',$this->arr_view_data);
        return redirect(url('').'/patient/booking/booking_request_confirmation');
    }

    public function payment_cancel(Request $request)
    {
        $this->arr_view_data['returnPageUrl']       = url('/').'/patient/booking/review_booking';
        $this->arr_view_data['page_title']          = "Cancel Payment";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.payment-cancel',$this->arr_view_data);
    }

    public function payment_error(Request $request)
    {
        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/

        $this->arr_view_data['returnPageUrl']       = url('/').'/patient/booking/review_booking';
        $this->arr_view_data['grandTotal']          = "24";

        $this->arr_view_data['page_title']          = "Error Payment";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.payment-error',$this->arr_view_data);
    }

    public function stripe_payment(Request $request) 
    {
      /*$gatewayStatus = $request->session()->has('paymentGatewayData');
      if(empty($gatewayStatus)){
          return redirect(url(''));
      }*/

      $this->arr_view_data['redirectTo']                = url('').'/patient/booking/payment/stripe/proceed/';

      $this->arr_view_data['page_title']                = "Processing your payment";
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.initiate-payment',$this->arr_view_data);
    }

    public function stripe_proceed(Request $request)
    {  
      /*$gatewayStatus = $request->session()->has('paymentGatewayData');
      if(empty($gatewayStatus)){
          return redirect(url(''));
      }*/
        
      /*Stripe Checkout*/
      $this->arr_view_data['stripeKey']                 = config('services.stripe.STRIPE_KEY');
      $this->arr_view_data['formAction']                = url('/').'/patient/booking/payment/stripe/makePayment/';
      $this->arr_view_data['cancelUrl']                 = url('/').'/patient/booking/payment/cancel/';
      $this->arr_view_data['errorUrl']                  = url('/').'/patient/booking/payment/error/';

      $this->arr_view_data['boxName']                   = "doctoroo";
      $this->arr_view_data['boxDesc']                   = 'Payment for Doctor Booking (AUD $24)';
      $this->arr_view_data['boxPrice']                  = '$24';
      $this->arr_view_data['boxEmail']                  = 'deepak@webwingtechnologies.com';

      return view($this->module_view_folder.'.stripe',$this->arr_view_data);
    }

    public function stripe_make_payment(Request $request)
    {  

        /*$gatewayStatus = $request->session()->has('paymentGatewayData');
        if(empty($gatewayStatus)){
            return redirect(url(''));
        }*/
        $status             = 'fail';
        $redirectTo         ='';
        $stripeSecret       = config('services.stripe.STRIPE_SECRET');
        Stripe::setApiKey($stripeSecret);
        $token              = $request->input('stripeToken');
        $planDesc           = 'Payment for Doctor Booking (AUD $24)';
        $jobPrice           = '$24';
        $_email             = 'deepak@webwingtechnologies.com';

        $charge = Stripe::Charges()->create(array(
            'source'   => $token,
            'amount'   => $jobPrice,
            'currency' => config('services.stripe.currencyType'),
            'description' => $planDesc,
            'receipt_email' => $_email
        ));

        if(count($charge)){
            $status = "done";
            $redirectTo = url('/').'/patient/booking/payment/success?txn_id='.$token;
        }
        else{
            $status = 'fail';
            $redirectTo = url('/').'/patient/booking/payment/error/';
        }

        $abc = array('token_id' => $token,'status' => $status,'redirectTo' => $redirectTo);

        return json_encode([
            'token_id' => $token,'status' => $status,
            'redirectTo' => $redirectTo
        ]);
    }
}
?>