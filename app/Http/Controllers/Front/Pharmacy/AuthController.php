<?php

namespace App\Http\Controllers\Front\Pharmacy;

use App\Models\MainPharmaciesModel;
use App\Models\PharmacyModel;
use App\Models\PharmacyTimeSchedule;
use App\Models\SpecialityModel;
use App\Models\LanguageModel;
use App\Models\UserModel;
use App\Models\PharmacyBannerGroupModel;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\EmailService;
use Flash;
use Paginate;
use Sentinel;
use Meta;
use DB;
use Validator;
use Session;
use Activation;

class AuthController extends Controller
{
    public function __construct(MainPharmaciesModel          $main_pharmacies,
                                PharmacyModel                $temp_pharmacy,
                                PharmacyTimeSchedule         $temp_time_schedule,
                                SpecialityModel              $SpecialityModel,
                                LanguageModel                $LanguageModel,
                                UserModel                    $user_model,
                                EmailService                 $EmailService,
                                PharmacyBannerGroupModel     $banner_group)

    {

        $this->MainPharmaciesModel               = $main_pharmacies;
        $this->PharmacyModel                     = $temp_pharmacy;
        $this->PharmacyTimeSchedule              = $temp_time_schedule;
        $this->SpecialityModel                   = $SpecialityModel;
        $this->LanguageModel                     = $LanguageModel;
        $this->UserModel                         = $user_model;
        $this->PharmacyBannerGroupModel          = $banner_group;

        $this->EmailService                      =  $EmailService;



        $this->arr_view_data            = [];
        $this->module_title             = "Pharmacy";
        $this->module_url_path          = url('/').'/pharmacy';
        $this->module_view_folder       = "front.pharmacy";
        $this->site_url                 = url('/');
        $this->module_title             = "Pharmacy";
        $this->pharmacy_base_img_path   = public_path().config('app.project.img_path.pharmacy');
        $this->pharmacy_public_img_path = url('/public').config('app.project.img_path.pharmacy');


        $this->arr_days = [];
        $this->arr_days['MON'] = "Monday";
        $this->arr_days['TUE'] = "Tuesday";
        $this->arr_days['WED'] = "Wednesday";
        $this->arr_days['THU'] = "Thursday";
        $this->arr_days['FRI'] = "Friday";
        $this->arr_days['SAT'] = "Saturday";
        $this->arr_days['SUN'] = "Sunday";

    }
    /*
     Rohini Jagtap
     Description:load pharmacy page 
     date:22 feb 2017
    */
     public function index(Request $request)
    {
        $arr_pharmacy_location_id ='';
        $arr_search_location  = $arr_location=[];
        $form_data            = $request->all();
        $distance             = 0;
        $search_pharmacy_id   = $search_term = '';
      

        $obj_main_pharmacy = $this->MainPharmaciesModel->with(['pharmacy_applications'=>function($q){
                                                       $q->select('id','main_pharmacy_id','pharmacy_name','phone','address1','address2');
                                                       }]);

        if(isset($form_data['search_term']) && $form_data['search_term']!='')
        {
            
              $search_term               = $form_data['search_term'];
              $arr_location              = explode(" ", $search_term);
              if(is_numeric($search_term))
              {
                  $arr_search_location   = $this->search_pharmacy_by_postcode($search_term);
              }
              else
              {
                  $arr_search_location   = $this->search_pharmacy_by_address($arr_location[0]);

              }


        }
        else
        {
           /*load 100 pharmacy if no searching is applied*/
           $obj_main_pharmacy    = $obj_main_pharmacy->take(100)->orderBy('pharmacy_name','asc')->get();
      
            if($obj_main_pharmacy)
            {
                $arr_search_location = $obj_main_pharmacy->toArray();
            }


        }

        //dd($arr_search_location);

        $arr_speciality = array();
        $speciality_arr = $this->SpecialityModel->where('speciality_status','Active')->get();
        if($speciality_arr)
        {
            $arr_speciality = $speciality_arr->toArray();
        }
        $language_arr = $this->LanguageModel->get();
        if($language_arr)
        {
            $arr_language = $language_arr->toArray();
        }

        $this->arr_view_data['arr_speciality']             = $arr_speciality;
        $this->arr_view_data['arr_language']               = $arr_language;
        $this->arr_view_data['arr_search_location']        = $arr_search_location;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['module_title']               = $this->module_title;
        $this->arr_view_data['page_title']                 = $this->module_title;
        $this->arr_view_data['site_url']                   = $this->site_url;

        // for seo 
        $this->arr_view_data['title']               = "Get Connected with Pharmacy Network at Doctoroo";
        $this->arr_view_data['description']         = "Doctoroo is an online platform that allows healthcare professionals to offer their services through video visits, digital prescriptions and connected pharmacy network.";

        return view($this->module_view_folder.'.index',$this->arr_view_data);

    }
 
    public function get_lat_long($address)
    {
        $lat     = '';
        $long    = '';
        $address = str_replace(" ", "+", $address);

        $url     = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Australia&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response   = curl_exec($ch);
        $response_a = json_decode($response);

         if(isset($response_a->results[0]->geometry->location->lat))
        {
            $lat = $response_a->results[0]->geometry->location->lat;
        }
        if(isset($response_a->results[0]->geometry->location->lng)) 
        {   
            $long = $response_a->results[0]->geometry->location->lng;
        }    
        return $lat.','.$long;
    }   

    /*
      Rohini jagtap
      Description:search pharmacy by using postcode
      date:1 march 2017

    */
    public function search_pharmacy_by_postcode($postcode)
    {
        $lat=$long='';
        $arr_postcode_lat_long = $arr_postcode_coordinates = $arr_postcode=$arr_near_location=$arr_search_location=[];

         $circle_radius  = 6371; /*radious in meter*/
         $max_distance   = 5;

        if(isset($postcode) && $postcode!='')
        {
            $address = $postcode.','.'australia';
            $arr_postcode_lat_long          = $this->get_lat_long($address); 
            $arr_postcode_coordinates       = explode(',',$arr_postcode_lat_long);

            $arr_postcode['latitude']       = $arr_postcode_coordinates[0];
            $arr_postcode['longitude']      = $arr_postcode_coordinates[1]; 


             if($arr_postcode['latitude']!='' && $arr_postcode['longitude']!='')
             {
               $arr_near_location = DB::select(
                 'SELECT * FROM
                      (SELECT id, pharmacy_name, location, suburb,phone_no,latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $arr_postcode['latitude'] . ')) * cos(radians(latitude)) *
                      cos(radians(longitude) - radians(' . $arr_postcode['longitude'] . ')) +
                      sin(radians(' .$arr_postcode['latitude']. ')) * sin(radians(latitude))))
                      AS distance
                      FROM dod_main_pharmacies) AS distances
                  WHERE distance < ' . $max_distance);

             }
             if(isset($arr_near_location) && sizeof($arr_near_location)>0)
             {
                  foreach($arr_near_location as $key=>$location)
                  {
                        $arr_search_location[$key]['id']            = $location->id;
                        $arr_search_location[$key]['pharmacy_name'] = $location->pharmacy_name;
                        $arr_search_location[$key]['suburb']        = $location->suburb;
                        $arr_search_location[$key]['latitude']      = $location->latitude;
                        $arr_search_location[$key]['longitude']     = $location->longitude;
                        $arr_search_location[$key]['location']      = $location->location;
                        $arr_search_location[$key]['phone_no']      = $location->phone_no;
                  }
             }

        }
        return $arr_search_location;

        

    }
     /*
      Rohini jagtap
      Description:search pharmacy by using surburb
      date:22 feb 2017
    */
    public function search_pharmacy_by_address($search_term)
    {

         $arr_lat_long = $arr_main_pharmacy = $arr_coordinates = $arr_map = $arr_pharmacy_location = $arr_map_location = $arr_search_location= [];

          if($search_term!='')
          {
              $obj_main_pharmacy   = $this->MainPharmaciesModel->where('suburb','LIKE','%'.$search_term.'%')
                                                               ->orderBy('id','desc')
                                                               ->get(); 

           

              if(isset($obj_main_pharmacy) && $obj_main_pharmacy!='')
              {
                  $circle_radius  = 6371;//3959; /*for meter*/
                  $max_distance   = 5;
                  $arr_main_pharmacy = $obj_main_pharmacy->toArray();

                  foreach ($arr_main_pharmacy as $key => $pharmacy) 
                  {
                      if(isset($pharmacy['location']) && isset($pharmacy['suburb']))
                      {
                           $address            = $pharmacy['location'].','.$pharmacy['suburb'];

                           $arr_lat_long[$key] = $this->get_lat_long($address); 

                           $arr_coordinates    = explode(',',$arr_lat_long[$key]);

                           $arr_map[$key]['latitude']  = $arr_coordinates[0];
                           $arr_map[$key]['longitude'] = $arr_coordinates[1];  

                           if($arr_map[$key]['latitude']!='' && $arr_map[$key]['longitude']!='')
                           {
                             $arr_map_location = DB::select(
                               'SELECT * FROM
                                    (SELECT id, pharmacy_name, location, phone_no, suburb, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $arr_map[$key]['latitude'] . ')) * cos(radians(latitude)) *
                                    cos(radians(longitude) - radians(' . $arr_map[$key]['longitude'] . ')) +
                                    sin(radians(' .$arr_map[$key]['latitude']. ')) * sin(radians(latitude))))
                                    AS distance
                                    FROM dod_main_pharmacies) AS distances
                                WHERE distance < ' . $max_distance);
                           }
                          
              
                      }

                     
                  } 
                  if(isset($arr_map_location) && sizeof($arr_map_location)>0)
                  {
                     foreach($arr_map_location as $key=>$location)
                      {
                          $arr_search_location[$key]['id']            = $location->id;
                          $arr_search_location[$key]['pharmacy_name'] = $location->pharmacy_name;
                          $arr_search_location[$key]['suburb']        = $location->suburb;
                          $arr_search_location[$key]['latitude']      = $location->latitude;
                          $arr_search_location[$key]['longitude']     = $location->longitude;
                          $arr_search_location[$key]['location']      = $location->location;
                          $arr_search_location[$key]['phone_no']      = $location->phone_no;
                      }
                  }
              }
          }
          return $arr_search_location;

     }
     /*
      rohini j
      description:load first step of signup
      date:2 march 2017
     */
     public function signup_step1($token_enc_id,$enc_id=false)
     {

         $arr_pharmacy = $arr_temp_pharmacy = $arr_main_pharmacy =[];
         $token_id                          = base64_decode($token_enc_id);
        if(isset($enc_id) && $enc_id!=false)
        {
              $pharmacy_id       = base64_decode($enc_id);

              /* get main pharmacy details*/
              $obj_main_pharmacy = $this->MainPharmaciesModel->where('id',$pharmacy_id)
                                                        ->select('id','pharmacy_name','suburb','phone_no','location')
                                                        ->first();
              if($obj_main_pharmacy)
              {
                  $arr_main_pharmacy = $obj_main_pharmacy->toArray();
              }
              
              /* get temprory pharmacy details if exist*/
              $obj_temp_pharmacy     = $this->PharmacyModel->where('main_pharmacy_id',$pharmacy_id)
                                                          ->with(['userinfo'=>function($q){

                                                             $q->select('id','email','first_name','last_name');

                                                          }])
                                                           ->first();
              if($obj_temp_pharmacy)
              {
                 $arr_temp_pharmacy  = $obj_temp_pharmacy->toArray();
              }
              $this->arr_view_data['pharmacy_enc_id']  = $enc_id;

        }
        else if($token_enc_id!='')
        {
               
                /* get temprory pharmacy details if exist*/
                $obj_temp_pharmacy     = $this->PharmacyModel->where('token_id',$token_id)
                                                             ->with(['userinfo'=>function($q){

                                                                 $q->select('id','email','first_name','last_name');

                                                              }])
                                                            ->first();
                if($obj_temp_pharmacy)
                {
                   $arr_temp_pharmacy  = $obj_temp_pharmacy->toArray();
                }
                $this->arr_view_data['pharmacy_enc_id']  = '';
        }
        $obj_banner_group     = $this->PharmacyBannerGroupModel->get();
        if($obj_banner_group)
        {
            $arr_banner_group = $obj_banner_group->toArray();

        }
        $this->arr_view_data['arr_banner_group']        = $arr_banner_group;
        $this->arr_view_data['enc_token_id']            = $token_enc_id;
        $this->arr_view_data['arr_main_pharmacy']       = $arr_main_pharmacy;
        $this->arr_view_data['arr_temp_pharmacy']       = $arr_temp_pharmacy;
        $this->arr_view_data['module_url_path']         = $this->module_url_path;
        return view($this->module_view_folder.'.signup_step1',$this->arr_view_data);
     }
    /*
      rohini j
      description:store details of first signup
      date:2 march 2017
    */
     public function store_signup_step1(Request $request)
     {
        $arr_rules = $form_data = $arr_pharmacy_data = [];
        $obj_signup_update = $obj_signup_create='';

        $pharmacy_id = $token_id = 0;
        $arr_rules['first_name']    = "required";
        $arr_rules['last_name']     = "required";
        $arr_rules['email_id']      = "required|Email";
        $arr_rules['pharmacy_name'] = "required";
        $arr_rules['phone']         = "required";
        $arr_rules['password']      = "required";
        $arr_rules['address1']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $form_data       = $request->all(); 

         $token_id       = base64_decode($form_data['enc_token_id']);
        if(isset($form_data['enc_pharmacy_id']) && $form_data['enc_pharmacy_id']!='')
        {
            $pharmacy_id = base64_decode($form_data['enc_pharmacy_id']);
            $arr_pharmacy_data['main_pharmacy_id'] = $pharmacy_id;
        }
        
        $arr_pharmacy_data['token_id']         = $token_id;
        $arr_pharmacy_data['contact_role']     = isset($form_data['contact_role'])?$form_data['contact_role']:'';
        $arr_pharmacy_data['other_role']       = isset($form_data['other_role'])?$form_data['other_role']:'';
        $arr_pharmacy_data['pharmacy_name']    = $form_data['pharmacy_name'];
        $arr_pharmacy_data['phone']            = $form_data['phone'];
        $arr_pharmacy_data['fax']              = isset($form_data['fax'])?$form_data['fax']:'';
        $arr_pharmacy_data['address1']         = $form_data['address1'];
        $arr_pharmacy_data['address2']         = isset($form_data['address2'])?$form_data['address2']:'';
        $arr_pharmacy_data['part_of_banner_group'] = isset($form_data['part_of_banner_group'])?$form_data['part_of_banner_group']:'';
        $arr_pharmacy_data['other_group']     = isset($form_data['other_group'])?$form_data['other_group']:'';
        $arr_pharmacy_data['website']         = isset($form_data['website'])?$form_data['website']:'';
        $arr_pharmacy_data['ABN_number']      = isset($form_data['ABN'])?$form_data['ABN']:'';
        

          $user_id = session::get('user_id');

          if($this->check_availability_of_email_id($form_data['email_id'],$user_id)==false)
          {

             Flash::error('User is already exist with same email id.');
             return back()->withErrors($validator)->withInput($request->all());
          }


        if($request->hasFile('pharmacy_logo')) 
        {
            $pharmacy_logo  = $request->file('pharmacy_logo');

            $img_valiator   = Validator::make(array('image'=>$pharmacy_logo),array('image' => 'mimes:png,jpeg,jpg')); 

            if($pharmacy_logo->isValid() && $img_valiator->passes())
            {
                  $fileExtension             = strtolower($pharmacy_logo->getClientOriginalExtension()); 
                  $enc_pharmacy_logo         = sha1(uniqid().$pharmacy_logo.uniqid()).'.'.$fileExtension;
                  $pharmacy_logo->move($this->pharmacy_base_img_path, $enc_pharmacy_logo);
                  
                  $arr_pharmacy_data['logo'] = $enc_pharmacy_logo;

                  
            }
            else
            {
                 Flash::error('Invalid file extension,please select valid image.');
                 return back()->withErrors($validator)->withInput($request->all());
            }
                
        }

        /* insert into user table */

        $arr_user['first_name']       = $form_data['first_name'];
        $arr_user['last_name']        = $form_data['last_name'];
        $arr_user['email']            = $form_data['email_id'];
        $arr_user['password']         = $form_data['password'];
        $arr_user['phone']            = $form_data['phone'];
        $arr_user['user_status']      = 'Block';
                       
                 
          $obj_signup = $this->PharmacyModel;
          if($pharmacy_id!='')
          {
                $pharmacy_count         =  $obj_signup->where('main_pharmacy_id',$pharmacy_id)->count();
                if($pharmacy_count>0)
                {
                    $obj_signup_update  =  $obj_signup->where('main_pharmacy_id',$pharmacy_id);
                    $obj_signup_update  =  $obj_signup_update->update($arr_pharmacy_data);
                }
                else
                {
                    $user_id            =  $this->register_user($arr_user);
                    session::put('user_id',$user_id);
                    $arr_pharmacy_data['user_id'] =  $user_id;
                    $obj_signup_create  =  $obj_signup->create($arr_pharmacy_data);
                   
                }
          }
          elseif($token_id!='')
          {
                $pharmacy_count         =  $obj_signup->where('token_id',$token_id)->count();
                if($pharmacy_count>0)
                {
                    $obj_signup_update  =  $obj_signup->where('token_id',$token_id);
                    $obj_signup_update  =  $obj_signup_update->update($arr_pharmacy_data);
                }
                else
                {
                    $user_id            =  $this->register_user($arr_user);
                    session::put('user_id',$user_id);
                    $arr_pharmacy_data['user_id'] =  $user_id;
                    $obj_signup_create  =  $obj_signup->create($arr_pharmacy_data);
                   
                }
          }
          if($obj_signup_update || $obj_signup_create)
          {
              Flash::success('Your first step has been saved! Continue step 2 of 3 below.');
              return redirect($this->module_url_path.'/signup_step2/'.$form_data['enc_token_id']);
          }
          else
          {
              Flash::error('Error while updating a pharmacy signup details.');
              return redirect()->back();
          }


     }

     
     public function register_user($arr_user_data)
     {
         $user        = Sentinel::createModel();
         $user_status = Sentinel::register($arr_user_data);
         $role        = Sentinel::findRoleBySlug('pharmacy');
         $user_status->roles()->attach($role);
         return $user_status->id;
     }
     /*
        Rohini j
        Desc:load page of signup step 2
        date:2 march 2017
     */
     public function signup_step2($enc_id)
     {
        $arr_temp_pharmacy = [];
        if(isset($enc_id) && $enc_id!='')
        {
           $token_id    = base64_decode($enc_id);
        }
        /* get temprory pharmacy details if exist*/
        $obj_temp_pharmacy     = $this->PharmacyModel->where('token_id',$token_id)->first();
        if($obj_temp_pharmacy)
        {
           $arr_temp_pharmacy  = $obj_temp_pharmacy->toArray();

        }
        $this->arr_view_data['arr_temp_pharmacy']  = $arr_temp_pharmacy;
        $this->arr_view_data['enc_token_id']       = $enc_id;
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        return view($this->module_view_folder.'.signup_step2',$this->arr_view_data);
     }
     /*
        Rohini j
        Desc:store signup step 2 details
        date:2 march 2017
     */
     public function store_signup_step2(Request $request)
     {
          $arr_rules =  $arr_pharmacy_data = [];

          $arr_rules['aprox_script_per_day']    = "required";
          $arr_rules['computer_system_used']    = "required";


          $validator = Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
              return redirect()->back()->withErrors($validator)->withInput($request->all());
          }

          $form_data   = $request->all(); 


          $token_id = base64_decode($form_data['enc_token_id']);

          $arr_pharmacy_data['aprox_script_per_day']  = $form_data['aprox_script_per_day'];

          $arr_pharmacy_data['computer_system_used']  = $form_data['computer_system_used'];

          $arr_pharmacy_data['other_computer_system'] = isset($form_data['other_field'])?$form_data['other_field']:'';

          $arr_pharmacy_data['services']              = $form_data['services'];
          $arr_pharmacy_data['other_service']         = isset($form_data['other_service'])?$form_data['other_service']:'';


          $obj_signup_step2_update  =  $this->PharmacyModel->where('token_id',$token_id)->first();
          $obj_signup_step2_update  =  $obj_signup_step2_update->update($arr_pharmacy_data);

          if($obj_signup_step2_update)
          {
               Flash::success('Step 2 saved ,You are one step away!');
               return redirect($this->module_url_path.'/signup_step3/'.$form_data['enc_token_id']);
          }

     }

     public function signup_step3($enc_id)
     {

        $arr_days = [];
        if(isset($enc_id) && $enc_id!='')
        {
           $this->arr_view_data['enc_token_id']  = $enc_id;
        }

        $arr_days = $this->arr_days;
        $this->arr_view_data['arr_days']         = $arr_days;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
        return view($this->module_view_folder.'.signup_step3',$this->arr_view_data);
     }

      public function store_signup_step3(Request $request)
      {  

          $form_data = $arr_days = $arr_time_data =[];

          $obj_schedule_update = $obj_schedule_create = '';

          $arr_days  = $this->arr_days;

          $token_id              = base64_decode($request->input('enc_token_id')); 

          $obj_main_pharmacy     =  $this->PharmacyModel->where('token_id',$token_id);

          if($obj_main_pharmacy)
          {
              $obj_main_pharmacy                = $obj_main_pharmacy->first();
              $arr_time_data['user_id']         = $obj_main_pharmacy->user_id;
          }

          /* 12-hour time to 24-hour time*/ 
          if(sizeof($arr_days)>0)
          {
              foreach ($arr_days as $day_key => $day) 
               {
                     $small_case_day_slug = strtolower($day_key); 

                     $arr_time_data[$small_case_day_slug.'_open'] = null;
                     $arr_time_data[$small_case_day_slug.'_close'] = null;
                     $arr_time_data[$small_case_day_slug.'_off'] = '0';

                     $status = $request->input($small_case_day_slug.'_off');

                     $arr_time_data[$small_case_day_slug.'_open']  = date("H:i ",strtotime($request->input($small_case_day_slug.'_open')));
                     $arr_time_data[$small_case_day_slug.'_close'] = date("H:i ",strtotime($request->input($small_case_day_slug.'_close')));

                     if($status!=0)
                     {
                         $arr_time_data[$small_case_day_slug.'_off']   = 1;
                     }
                    

               }


          }

          $arr_time_data['opening_hour_notes'] = $request->input('opening_hour_notes');
          $arr_time_data['main_pharmacy_id']   = $token_id;

          $obj_schedule            = $this->PharmacyTimeSchedule;
          $pharmacy_schedule_count =  $obj_schedule->where('main_pharmacy_id',$token_id)->count();
          if($pharmacy_schedule_count>0)
          {
              $obj_schedule_update = $obj_schedule->where('main_pharmacy_id',$token_id);
              $obj_schedule_update = $obj_schedule_update->update($arr_time_data);
          }
          else
          {
              $obj_schedule_create = $obj_schedule->create($arr_time_data);
          }
          if($obj_schedule_update || $obj_schedule_create)
          {
              
              $user  =  Sentinel::findById($obj_main_pharmacy->user_id);
              $activation         =   Activation::create($user);
              $activation_code    =   $activation->code;

              $activation_link    ='<a class="btn_emailer_cls" href="'.url('/pharmacy/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
              $arr_built_content = [ 
                                      'FIRST_NAME' => $user->first_name , 
                                      'APP_NAME'   => config('app.project.name'),
                                      'ACTIVATION_LINK' => $activation_link,
                                   ];

              $arr_mail_data                      = [];
              $arr_mail_data['email_template_id'] = '38';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $user;
              $email_status  = $this->EmailService->send_mail($arr_mail_data);

              $message = "Our Team will review your application and contact you for any questions or confirmation. In the meantime, keep an eye out for an activation link in your email.";

              $message1 = 'THANK YOU FOR SIGNING UP.';

              $message2 = 'You\'re one step closer from joining the future of healthcare in Australia.';
              
              return redirect($this->module_url_path.'/thank_you/'.$message.'/'.$message1.'/'.$message2);
          }

      }
      /*
        Rohini j
        Desc:pharmacy login
        date:6 march 2017
     */
      public function login(Request $request)
      {

          $form_data = $arr_credencial = $arr_json = [];
          $remember_me = 0;

          $arr_rules['email']    =   "required|email";
          $arr_rules['password'] =   "required|min:6";

          
          $form_data   = $request->all();
          $remember_me = $form_data['remember_me'];

          $validator  =   Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
              $arr_json['status'] =  "error";
              $arr_json['msg']    =  'Invalid credencials,Please try again.';
              return response()->json($arr_json);
          }

          $form_data = $request->all();

          if(isset($form_data['email']) && isset($form_data['password']))
          {
                $arr_credencial['email']    = $form_data['email'];
                $arr_credencial['password'] = $form_data['password'];
            
          }
          $user = Sentinel::findByCredentials($arr_credencial);
          if($user)
          {     

                if($user->inRole('admin'))
                {
                   $arr_json['status'] =  "error";
                   $arr_json['msg']    =  'User is not allowed to login.';
                   return response()->json($arr_json);
                }
                else if($user->inRole('pharmacy'))
                {
                    
                    if($user->verification_status==0)
                    { 
                              
                        if($user->token!='')
                        {
                             $url = $this->module_url_path.'/resend_verification_mail/'.base64_encode($user->id);
                             $arr_json['status'] =  "error";
                             $arr_json['msg']    =  'Please click the link we’ve given here'." ".'<a href='.$url.'>Resend Verification Mail</a>';
                             return response()->json($arr_json);
                          
                        }
                        else
                        {
                             $arr_json['status'] =  "error";
                             $arr_json['msg']    =  'Oops! Your Email has not been verified yet. Please check your mailbox and verify your account, or contact us on customercare@doctoroo.com.au. Thank you.';
                             return response()->json($arr_json);
                        }                       
                       
                    }
                    else if($user->admin_verification_status_mini == 0)
                    {
                        $arr_json['status'] =  "error";
                        $arr_json['msg']    =  'Oops! Your account has not yet been verified by Admin. Please wait until we\'ve been able to process your application, or contact us on customercare@doctoroo.com.au. Thank you';
                        return response()->json($arr_json);
                    }
                    else
                    {
                        try 
                        { 

                            if(isset($remember_me) && $remember_me == "1")
                            {
                                $check_authentication = Sentinel::authenticateAndRemember($arr_credencial);

                                setcookie ("email",$form_data['email'],time()+ (10 * 365 * 24 * 60 * 60));
                                setcookie ("password",$form_data['password'],time()+ (10 * 365 * 24 * 60 * 60));
                            }
                            else
                            {                        
                                $check_authentication = Sentinel::authenticate($arr_credencial);

                                if(isset($_COOKIE["email"])) 
                                {
                                    setcookie ("email","");
                                }
                                if(isset($_COOKIE["password"])) 
                                {
                                    setcookie ("password","");
                                }
                            }
                      
                            if($check_authentication)
                            {            
                                  $login_status = Sentinel::login($user);
                                  if($login_status)
                                  {
                                      $arr_json['status'] =  "success";
                                      $arr_json['msg']    =  'You are login successfully.';
                                      return response()->json($arr_json);
                                  } 
                                  else
                                  {
                                       $arr_json['status'] =  "error";
                                       $arr_json['msg']    =  'Invalid credentials, Please try again.';
                                       return response()->json($arr_json);
                                  }                 
                            }
                            else
                            {
                                    $arr_json['status'] =  "error";
                                    $arr_json['msg']    =  'Invalid credentials, Please try again.';
                                    return response()->json($arr_json);
                            }
                        } 
                        catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) 
                        {
                             $arr_json['status'] =  "error";
                             $arr_json['msg']    =  'Account has not been verified yet. Please check your mailbox and verify your account.';
                            return response()->json($arr_json);

                        }
                    }
                }
                else
                {
                    $arr_json['status'] =  "error";
                    $arr_json['msg']    =  'User is not present with this role.';
                    return response()->json($arr_json);
                }
                
          }
          else
          {
               $arr_json['status'] =  "error";
               $arr_json['msg']    =  'User does not exist.';
               return response()->json($arr_json);
          }
         
      }
     /*
        Rohini j
        Desc:Check duplication of email id
        date:2 march 2017
     */

     public function check_availability_of_email_id($email_id,$userid)
     {
        $exist_flag = true;
        /* check in user table */
        $user_count =  $this->UserModel->where('email',$email_id)->where('id','<>',$userid)->count();
        if($user_count>0)
        {
          $exist_flag= false;
        }
        return $exist_flag;
     }

     public function thank_you($message,$message1=false,$message2=false)
     {
          $this->module_front_folder = 'front';
          if($message1!=false)
          {
               $this->arr_view_data['message1']   = $message1;
          }
          if($message2!=false)
          {
               $this->arr_view_data['message2']   = $message2;
          }

          $this->arr_view_data['message']    = $message;
          return view($this->module_front_folder.'.thankyou',$this->arr_view_data);

     }

    /*========================Seema(4-March-2017)=========================*/

     public function error($message)
     {
         
        $this->arr_view_data['message']    = $message;
        return view($this->module_view_folder.'.error',$this->arr_view_data);

     }
      public function verify($enc_id=FALSE,$token=FALSE)
      {
          
          $enc_id             = base64_decode($enc_id);
          $activation_code    = base64_decode($token);

          $user           = Sentinel::findById($enc_id);
          $activation     = Activation::exists($user);
          if($activation)
          {
              if (Activation::complete($user, $activation_code))
              {
                  $tmp_user = $this->UserModel->where('id',$enc_id)->first();
                  if($tmp_user)
                  {
                      $tmp_user->verification_status = 1;
                      $tmp_user->user_status = 'Active';
                      $tmp_user->save();    
                  }
                  //$login_status = Sentinel::login($user);

                  $this->arr_view_data['status'] = 'VERIFIED';
                  $this->arr_view_data['message'] = 'Your account verified successfully. Please wait until we\'ve been able to process your application, or contact us on customercare@doctoroo.com.au.';
                   
                  return view($this->module_view_folder.'.verification_status')->with($this->arr_view_data);
                  //return redirect($this->module_url_path.'/thank_you/'.$message);

                  
              }
              else
              {
                  $message = 'Error while activating account. Please try again later';
                  Flash::error('Error while activating account. Please try again later');
                  return redirect($this->module_url_path.'/error/'.$message);
              }
          }
          else
          {   $message ="Your account is already verified.";
              Flash::error('Your account is already verified.');
              return redirect($this->module_url_path.'/error/'.$message);
          }

      } 

      /*========================Seema code end=========================*/

      /*
        Rohini j
        date:7 march 2017
        description:resend email to the user if it is not veririfed
      */
      public function resend_verification_mail($userid)
      {
          $arr_built_content = $arr_mail_data = [];
          $message           = '';
          if(isset($userid) && $userid!='')
          {
              $id   = base64_decode($userid);
              $user = Sentinel::findById($id);
          
              $arr_data['first_name']     =   $user->first_name;
              $arr_data['last_name']      =   $user->last_name;
              $arr_data['email']          =   $user->email;

              $url = url($this->module_url_path.'/verify/'.base64_encode($user->id).'/'.base64_encode($user->token));
              $activation_link            =   '<a class="btn_emailer_cls" href="'.$url.'"> Verify Now </a>';

               $arr_built_content = [ 
                                  'FIRST_NAME'=>$arr_data['first_name'] , 
                                  'APP_NAME'  =>config('app.project.name'),
                                  'ACTIVATION_LINK'=>$activation_link,
                                   ];

              $arr_mail_data['email_template_id'] = '38';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $arr_data;

              $email_status  = $this->EmailService->send_mail($arr_mail_data);
              if($email_status)
              {
                    $message = "Verification email has been sent successfully to your registered email id, please check your email inbox & verify your account.";
                    return redirect($this->module_url_path.'/thank_you/'.$message);

              }
              else
              {
                   $message = "Error occure while sending a mail ti user email id.";
                   return redirect($this->module_url_path.'/error/'.$message);
              }
          } 
          else
          {
              $message = "No such a user available";
              return redirect($this->module_url_path.'/error/'.$message);
             
          }
        
      }
      public function location_listing()
      {
            $arr_result      = $arr_location = [];
            $term            = \Request::get('term');
            $postcode        = $address ='';
            $obj_result      = $this->MainPharmaciesModel->where('suburb','like',$term.'%')
                                                         ->select('id','suburb')
                                                         ->groupBy('suburb')
                                                         ->get();

            if(isset($obj_result) && $obj_result!='' && sizeof($obj_result)>0)
            {

                  $arr_result = $obj_result->toArray();
                  if(count($arr_result) > 0)
                  {
                      foreach ($arr_result as $key => $value) 
                      {

                        $address = $this->get_postal_code($value['suburb']);
                        $arr_location[$key]['label']  = $value['suburb'].' '.$address;
                        $arr_location[$key]['suburb'] = $value['suburb'];
                        $arr_location[$key]['id']     = $value['id'];
                      }
                      
                  }
                  else
                  {
                      $arr_location['label'] = 'Result not found.';

                  }
            }
            else
            {
                $arr_location['label'] = 'Result not found.';

            }

            return response()->json($arr_location);
      }
      public function get_postal_code($address)
      {
            $zipcode = $state_short_name = $location_str ='';
            $address = str_replace(" ", "+", $address);


            $url     = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Australia&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response   = curl_exec($ch);
            $response_a = json_decode($response);

              if(isset($response_a->results[0]->address_components[4]->long_name))
              {
                 $zipcode         =  $response_a->results[0]->address_components[4]->long_name;
              }
              if(isset($response_a->results[0]->address_components[1]->short_name))
              {
                 $state_short_name =  $response_a->results[0]->address_components[1]->short_name;
              }

              $location_str = $state_short_name." ".$zipcode;
              return $location_str;

            
      }
      /*To delete user account load view*/
      public function delete_account()
      {
           $this->arr_view_data['module_url_path']  =  $this->module_url_path;
           $this->arr_view_data['page_title']           = 'Delete Account';
           return view($this->module_view_folder.'.delete_account',$this->arr_view_data);
      }


  
}
