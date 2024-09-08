<?php

namespace App\Http\Middleware\Front;

use Closure;

use App\Models\StaticPagesModel;
use App\Models\AustraliaStatesModel;
use App\Models\MobileCountryCodeModel;
use App\Models\UserTimezonesModel;
use App\Models\UserModel;
use App\Models\TimezonesModel;
use App\Models\TimezoneModel;
use App\Models\AdminProfileModel;
use App\Models\PharmacyListModel;
use App\Common\Services\VirgilService;

use Sentinel;
use App;
use DateTimeZone;
use Carbon\Carbon;

use Virgil\Sdk\Api\VirgilApi;
use Virgil\Sdk\Api\VirgilApiContext;
use Virgil\Sdk\Api\AppCredentials;
use Virgil\Sdk\Buffer;


class GeneralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arr_page_list = StaticPagesModel::select(['page_slug','page_name'])->get()->toArray();
        view()->share('arr_page_list',$arr_page_list);

        $get_states = AustraliaStatesModel::where('status', '1')->orderBy('id', 'DESC')->get()->toArray();
        view()->share('get_states',$get_states);

        $get_mobcode = MobileCountryCodeModel::orderBy('nicename', 'ASC')->where('phonecode','!=',0)->get()->toArray();
        view()->share('mobcode_data',$get_mobcode);

        $get_pharmacy_list = PharmacyListModel::orderBy('company_name', 'ASC')->get()->toArray();
        view()->share('pharmacy_list',$get_pharmacy_list);        

        // get login user details
        $user = Sentinel::check();
        $user_timezone_data = [];
        $user_image_url = $user_timezone_data['location'] = '';

        if($user != false)
        {
            $user_id = $user->id;

            // user online data
            $get_user_online = UserModel::where('id',$user_id)->where('is_online',1)->count();
            if($get_user_online != 1)
            {
                $user_online['is_online'] = 1;
                UserModel::where('id',$user_id)->update($user_online);
            }
            else
            {
                /*$user_online['is_online'] = 0;
                UserModel::where('id',$user_id)->update($user_online);
                return redirect(url('/')."/logout/You are already login! Please logout from other device and then try again.");*/
            }

            if($user->inRole('patient'))
            {
                $path               = 'public/'.'uploads/front/patient/profile-image/';
                $user_image_url     = url('/').'/public'.config('app.project.img_path.patient');

                // get user timezone
                $get_user_data = UserModel::where('id',$user_id)->with('patientinfo', 'patientinfo.timezone_data')->first();
                if($get_user_data)
                {
                    $user_data = $get_user_data->toArray();
                    $user_timezone_id = $user_data['patientinfo']['timezone'];
                    $user_timezone_data = $user_data['patientinfo']['timezone_data'];

                    view()->share('user_timezone_data',$user_timezone_data);
                }
                else
                {
                    $set_user_timezone = TimezoneModel::where('id', 362)->first();
                    if($set_user_timezone)
                    {
                        $user_timezone_data = $set_user_timezone->toArray();
                        view()->share('user_timezone_data',$user_timezone_data);
                    }
                }
            }
            if($user->inRole('doctor'))
            {
                $path               = 'public/'.'uploads/front/doctor/';
                $user_image_url     = url('/').'/public'.config('app.project.img_path.doctor');

                // get user timezone
                $get_user_data = UserModel::where('id',$user_id)->with('doctor_details', 'doctor_details.timezone_data')->first();
                if($get_user_data)
                {
                    $user_data = $get_user_data->toArray();
                    $user_timezone_id = $user_data['doctor_details']['timezone'];
                    $user_timezone_data = $user_data['doctor_details']['timezone_data'];

                    view()->share('user_timezone_data',$user_timezone_data);
                }
                else
                {
                    $set_user_timezone = TimezoneModel::where('id', 362)->first();
                    if($set_user_timezone)
                    {
                        $user_timezone_data = $set_user_timezone->toArray();
                        view()->share('user_timezone_data',$user_timezone_data);
                    }
                }
            }

            // set time zone for the user
            /*$timezonelist   = DateTimeZone::listIdentifiers();
            foreach($timezonelist as $list)
            {
                if($user_timezone_data['location'] != '' && $user_timezone_data['location'] != null)
                {
                    if($user_timezone_data['location'] == $list)
                    {
                        date_default_timezone_set($list);
                    }
                }
            }*/

            $user_profile_img       = $user_image_url.$user->profile_image;
            $default_profile_img    = $user_image_url."default-image.jpeg";

            if(isset($user->profile_image) && !empty($user->profile_image) && file_exists($path.$user->profile_image))
            {
                view()->share('user_profile_pic',$user_profile_img);
            }
            else
            {
                view()->share('user_profile_pic',$default_profile_img);
            }

            $user = array(
                            'user_id' => $user->id,
                            'email' => $user->email,
                            'title' => $user->title,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'login_time' => $user->login_time,
                            'logout_time' => $user->logout_time,
                        );
            
            view()->share('arr_user_data',$user);

        }

        return $next($request);
    }

    function decryptData($key, $enctext)
    {
      $plaintext = $key->decrypt($enctext)->toString();
      return $plaintext;
    }
}
