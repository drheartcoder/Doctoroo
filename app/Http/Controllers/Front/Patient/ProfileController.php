<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\MedicareDetailsModel;
use App\Models\RegularDoctorModel;
use App\Models\MainPharmaciesModel;
use App\Models\TempConsultationBookingModel;
use App\Models\StatesModel;
use App\Models\PrefixModel;
use App\Models\NotificationModel;

use App\Common\Services\EmailService;

use Validator;
use Flash;
use Sentinel;
use Activation;
use DB;
use Reminder;
use URL;
use Session;

class ProfileController extends Controller
{

    public function __construct(UserModel                       $UserModel,
                                PatientModel                    $PatientModel,
                                MedicareDetailsModel            $MedicareDetails,
                                RegularDoctorModel              $RegularDoctor,
                                EmailService                    $EmailService,
                                MainPharmaciesModel             $MainPharmacies,
                                StatesModel                     $state,
                                PrefixModel                     $prefix_model,
                                TempConsultationBookingModel    $TempConsultationBookingModel,
                                NotificationModel               $notification)

    {	
    	$this->arr_view_data[]              = [];
    	$this->UserModel	                = $UserModel;
        $this->PatientModel                 = $PatientModel;
        $this->MedicareDetailsModel         = $MedicareDetails;
        $this->RegularDoctorModel           = $RegularDoctor;
        $this->MainPharmaciesModel          = $MainPharmacies;
        $this->EmailService                 = $EmailService;
        $this->StatesModel                  = $state;
        $this->PrefixModel                  = $prefix_model;
        $this->TempConsultationBookingModel = $TempConsultationBookingModel;
        $this->NotificationModel            =  $notification;

        $this->module_title                 = "Patient";
    	$this->module_view_folder           = 'front.patient';
        $this->module_url_path              = url('/').'/patient/profile';
        $this->public_img_path              = url('/public').config('app.project.img_path.card-photo');
        $this->base_path                    = base_path().'/public';
        $this->site_url                     = url('/');
        $this->pharmacy_path                = url('/').'/patient';
        $this->profile_image                = public_path().config('app.project.img_path.profile-image');
        $this->profile_image_public         = url('/public').config('app.project.img_path.profile-image');


        $this->user_id = '';
        $user          = Sentinel::check();
        if($user)
        {
          $this->user_id = $user->id;
        }

    }	
   
    public function index(Request $request)
    {


        $arr_prefix       = [];
        $arr_notification = [];
        $this->arr_view_data['page_title'] = 'My Profile';
        $local_pharmacy = "";
        $patient_arr    = array();

        $obj_prefix     = $this->PrefixModel->get();
        if($obj_prefix)
        {
            $arr_prefix = $obj_prefix->toArray();
        }

        $user = Sentinel::check();
       
        if($user)
        {
            $patient_info = $this->PatientModel->where('user_id',$user->id)->with(['userinfo','medicaredetails','regulardoctor'])->first();
            if($patient_info)
            {
            
                $patient_arr = $patient_info->toArray();
                if(isset($patient_arr['suburb']) && $patient_arr['suburb']!="")
                {
                  
                    $search_term = $patient_arr['suburb'];
                    $obj_main_pharmacy   = $this->MainPharmaciesModel->where('suburb','LIKE','%'.$search_term.'%')->orderBy('pharmacy_name','asc')->get();    
                                  
                }    
                else
                {
                 
                    $obj_main_pharmacy    = $this->MainPharmaciesModel->take(100)->orderBy('pharmacy_name','asc')->get();
                }
                   
                $this->arr_view_data['patient_arr'] = $patient_arr;

                if($obj_main_pharmacy)
                {

                    $arr_search_location = $obj_main_pharmacy->toArray();
                }
                
                $this->arr_view_data['arr_pharmacies'] = $arr_search_location;

            }

        }
        else
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }
        

        $this->arr_view_data['user_id']                = $this->user_id;
        $this->arr_view_data['arr_prefix']            = $arr_prefix;
        $this->arr_view_data['module_url_path']       = $this->module_url_path;
        $this->arr_view_data['site_url']              = $this->site_url;
        return view($this->module_view_folder.'.profile',$this->arr_view_data);
    }

    public function store_profile(Request $request)
    {
    
        $arr_rules = array();
        $arr_rules['title']         = 'required';
        $arr_rules['first_name']    = 'required';
        $arr_rules['last_name']     = 'required';
        $arr_rules['gender']        = 'required';
        $arr_rules['email_address'] = 'required|email';
        $arr_rules['day_of_birth']  = 'required';
        $arr_rules['date_of_month'] = 'required';
        $arr_rules['date_of_year']  = 'required';
        $arr_rules['mobile_no']     = 'required|numeric';
        $arr_rules['phone_no']      = 'required';
        $arr_rules['address']       = 'required';
        $arr_rules['suburb']        = 'required';
       

        /*===========Medicare Details===================*/
        $medicare_type              = $request->input('medicare_type'); 

        $arr_rules['medicare_type'] = 'required';

        if($medicare_type=="Medicare")
        {
            $arr_rules['card_no']       = 'required|numeric';
            $arr_rules['card_month']    = 'required';
            $arr_rules['card_year']     = 'required';
            $arr_rules['reference_no']  = 'required';
        }

        if($medicare_type=="Concession" || $medicare_type=="Safety Net Card")    
        {

            $arr_rules['card_no']       = 'required|numeric';
            //$arr_rules['card_photo']    = 'image';
        }    
        
        /*=============Regular Doctor====================*/

       $invite_this_doctor     = $request->input('invite_this_doctor'); 

       if($invite_this_doctor!="")
       {

            $arr_rules['doctor_name']      = 'required';
            $arr_rules['practice_name']    = 'required';
            $arr_rules['doctor_phone']     = 'required|numeric';
            $arr_rules['doctor_address']   = 'required';
       }


        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
           Flash::error("Problem Occured.".$validator->errors()); 
           return back()->withErrors($validator)->withInput();
        }



        $file_name = "";

        if($request->hasFile('card_photo'))
        {

            $card_photo   =   $request->file('card_photo');

            if(isset($card_photo) && sizeof($card_photo)>0)
            {

                    $arr_card_photo_size  = [];
                    $arr_card_photo_size  = getimagesize($request->file('card_photo'));

                    $extention  =   strtolower($card_photo->getClientOriginalExtension());
                    $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                    if(!in_array($extention, $valid_ext))
                    {

                        Flash::error('Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                        return redirect()->back()->withInput($request->all());
                    }
                    else
                    {
                        @unlink(config('app.project.img_path.card-photo').$request->input('old_card_photo'));
                        $file_name      = $request->file('card_photo');
                        $file_extension = strtolower($request->file('card_photo')->getClientOriginalExtension()); 
                        $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                        $upload_result  = $request->file('card_photo')->move($this->base_path.config('app.project.img_path.card-photo'), $file_name);
                    }
            }
            else
            {
                Flash::error('Please upload valid image.');
                return redirect()->back()->withInput($request->all());
            }
        }
        else
        {

            $file_name = $request->input('old_card_photo');
        }

        $form_data  =   $request->all();

        $arr_data['gender']        = $form_data['gender']; 
        $arr_data['date_of_birth'] = $form_data['date_of_year'].'-'.$form_data['date_of_month'].'-'.$form_data['day_of_birth']; 
        $arr_data['mobile_no']     = $form_data['mobile_no']; 
        $arr_data['phone_no']      = $form_data['phone_no']; 
        $arr_data['streen_address']= $form_data['address']; 
        $arr_data['manually_address']= $form_data['manually_address']; 
        $arr_data['suburb']        = $form_data['suburb']; 
        $arr_data['my_local_pharmacy']= $request->input('local_pharmacy',0);

        /*=========Medicare Details=============================*/

        $arr_medicare['medicare_type']              = $form_data['medicare_type'];
        if($arr_medicare['medicare_type']=='Medicare')
        {

            $arr_medicare['medicare_card_no']           = $form_data['card_no'];
            $arr_medicare['individual_card_no']         = $form_data['reference_no'];
            $arr_medicare['medicare_card_expiry_month'] = $form_data['card_month'];
            $arr_medicare['medicare_card_expiry_year']  = $form_data['card_year'];
            $arr_medicare['card_image'] = '';
        }

        if($arr_medicare['medicare_type']=='Concession' || $arr_medicare['medicare_type']=='Safety Net Card')
        {    

            $arr_medicare['medicare_card_no'] = $form_data['card_no'];
            $arr_medicare['card_image'] = $file_name;
            $arr_medicare['individual_card_no']         = '';
            $arr_medicare['medicare_card_expiry_month'] = '';
            $arr_medicare['medicare_card_expiry_year']  = '';
        }    

        /*===============Regular Doctor======================================*/

        if(isset($form_data['invite_this_doctor']))
        {

            $arr_regular_doctor['invite_this_doctor']  = $form_data['invite_this_doctor'];
            $arr_regular_doctor['reg_doctor_name']     = $form_data['doctor_name'];
            $arr_regular_doctor['reg_practice_name']   = $form_data['practice_name'];
            $arr_regular_doctor['reg_doctor_phone']    = $form_data['doctor_phone'];
            $arr_regular_doctor['reg_doctor_address']  = $form_data['doctor_address'];

        }
        else
        {

            $arr_regular_doctor['invite_this_doctor']  = '';
            $arr_regular_doctor['reg_doctor_name']     = '';
            $arr_regular_doctor['reg_practice_name']   = '';
            $arr_regular_doctor['reg_doctor_phone']    = '';
            $arr_regular_doctor['reg_doctor_address']  = '';
            $arr_regular_doctor['invite_this_doctor']  = '0';

        }

        if(isset($form_data['notify_my_regular_doctor']))
        {

            $arr_regular_doctor['notify_my_regular_doctor']  = $form_data['notify_my_regular_doctor'];

        }
        else
        {
            $arr_regular_doctor['notify_my_regular_doctor']  = '0';
        }


        $user = Sentinel::check();
        
        if($user)
        {
            $update_patient         = $this->PatientModel->where('user_id',$user->id)->update($arr_data);

            /*========================Medicare Details==================================================*/

            $medicare_details_exist = $this->MedicareDetailsModel->where('user_id',$user->id)->count();

            if($medicare_details_exist>0)
            {

               $medicare_result = $this->MedicareDetailsModel->where('user_id',$user->id)->update($arr_medicare);
            }
            else
            {
                
                $arr_medicare['user_id'] = $user->id;
                $medicare_result = $this->MedicareDetailsModel->create($arr_medicare);
            }

            /*====================Regular Doctor ==========================================================*/

            if(isset($arr_regular_doctor['notify_my_regular_doctor']) || isset($arr_regular_doctor['invite_this_doctor']))
            {

                $regular_doctor_exist = $this->RegularDoctorModel->where('user_id',$user->id)->count();
                if($regular_doctor_exist>0)
                {

                    /*to update data in reguler doctor model*/ 
                   $this->RegularDoctorModel->where('user_id',$user->id)->update($arr_regular_doctor);
                   $regular_doctor_result = $this->RegularDoctorModel->where('user_id',$user->id)->update($arr_regular_doctor);
                }
                else
                {
                    
                    /*to add data in reguler doctor model*/ 
                    $arr_regular_doctor['user_id'] = $user->id;
                     $this->RegularDoctorModel->create($arr_regular_doctor);
                    $regular_doctor_result = $this->RegularDoctorModel->create($arr_regular_doctor);
                }
            }

            /*======================User ===========================================================*/

            $update_arr = array('title'        => $form_data['title'],
                                'first_name'   => $form_data['first_name'],
                                'last_name'    => $form_data['last_name']);
                                

             $update_result = $this->UserModel->where('id',$user->id)->update($update_arr);

             if($update_patient || $update_result || $medicare_result || $regular_doctor_result)
             {
                 Flash::success("Profile has been updated successfully."); 
                if(isset($form_data['status_redirect']) && $form_data['status_redirect']!="")
                {
                   
                    if($form_data['status_redirect']=='no')
                    {
                        return redirect()->back();
                    }
                    else
                    {
                        return redirect(url('/').'/search/doctor/who-is-patient');
                    }
                     
                }
                else
                {
                  
                    return redirect()->back();
                }
                 
             }
             else
             {

                 Flash::error("Problem Occured, While updating profile."); 
                 return redirect()->back(); 
             }
             
        }
        else
        {

             Flash::error("Invalid User."); 
             return redirect()->back(); 
        }

      return redirect()->back(); 
    }

    /*========================Seema(2-March-2017)==============================================*/

    public function search_pharmacy(Request $request)
    {

        $search_term = "";
        $form_data   = $request->all();

        if(isset($form_data['search_pharmacy']) && $form_data['search_pharmacy']!='')
        {
            $search_term   = trim($form_data['search_pharmacy']);

             $arr_location              = explode(" ", $search_term);

             if(is_numeric($search_term))
             {
             
                  $arr_search_location   = $this->search_pharmacy_by_postcode($search_term);
             }
             else
             {

                  $arr_search_location   = $this->search_pharmacy_by_address($arr_location[0]);

              }

            $user = Sentinel::check();

            if($user)
            {

               $patient_info = $this->PatientModel->where('user_id',$user->id)->with(['userinfo','medicaredetails','regulardoctor'])->first();

               if($patient_info)
               {
                    $this->arr_view_data['patient_arr'] = $patient_info->toArray();
               } 
            }   

            $this->arr_view_data['search_term']     = $search_term;    
            $this->arr_view_data['arr_pharmacies']  = $arr_search_location;  
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['site_url']        = $this->site_url;
            return view($this->module_view_folder.'.loadpharmacies',$this->arr_view_data);

        }
        else
        {

            echo"error";
        }
    }

    public function get_lat_long($address)
    {

        $lat     = '';
        $long    = '';
       // $address = str_replace("+", " ", $address);
        $address = preg_replace("/\s/", "-", $address);

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
                      (SELECT id, pharmacy_name, location, suburb, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $arr_postcode['latitude'] . ')) * cos(radians(latitude)) *
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

              $obj_main_pharmacy   = $this->MainPharmaciesModel->where('suburb','LIKE','%'.$search_term.'%')
                                                               ->orderBy('pharmacy_name','desc')
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
                                    (SELECT id, pharmacy_name, location, suburb, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $arr_map[$key]['latitude'] . ')) * cos(radians(latitude)) *
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
                      }
                  }
              }
              return $arr_search_location;
    }

    public function search_pharmacy_by_suburb(Request $request)
    {

        $arr_lat_long = $arr_main_pharmacy = $arr_coordinates = $arr_map = $arr_pharmacy_location = $arr_map_location = $arr_search_location= [];
        $search_pharmacy = array();$search_term="";
        $form_data   = $request->all();

        if(isset($form_data['search_pharmacy']) && $form_data['search_pharmacy']!='')
        {
            
         
            $search_pharmacy   = explode(' ',$form_data['search_pharmacy']);

            if(isset($search_pharmacy))
            {

                $search_term = $search_pharmacy[0];

                $obj_main_pharmacy   = $this->MainPharmaciesModel->where('suburb','LIKE','%'.$search_pharmacy[0].'%')
                                                               ->orderBy('pharmacy_name','desc')
                                                               ->get(); 

           

                  if(isset($obj_main_pharmacy) && $obj_main_pharmacy!='')
                  {
                    
                      $arr_main_pharmacy = $obj_main_pharmacy->toArray();
                  }

               if(isset($search_pharmacy[0]) && isset($search_pharmacy[1]) && isset($search_pharmacy[2]))
               {   

                    $search_term = $search_pharmacy[0].' '.$search_pharmacy[1].' '.$search_pharmacy[2];   
                }
                    
            }      

            $user = Sentinel::check();

            if($user)
            {

               $patient_info = $this->PatientModel->where('user_id',$user->id)->with(['userinfo','medicaredetails','regulardoctor'])->first();

               if($patient_info)
               {
                    $this->arr_view_data['patient_arr'] = $patient_info->toArray();
               } 
            }   
          
            $this->arr_view_data['search_term']     = $search_term;    
            $this->arr_view_data['arr_pharmacies']  = $arr_main_pharmacy;  
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['site_url']        = $this->site_url;
            return view($this->module_view_folder.'.loadpharmacies',$this->arr_view_data);
        }    
    }

    public function profile_image()
    {

        $this->arr_view_data['page_title'] = 'Patient Profile';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        
        return view($this->module_view_folder.'.patientprofile',$this->arr_view_data);
    }

    public function upload_profile(Request $request)
    {
       
        $upload_profile_image = "";

        $user = Sentinel::check();
        
        if($user)
        {

            if($request->hasFile('profile-image'))
            {

                $profile_image   =   $request->file('profile-image');

                if(isset($profile_image) && sizeof($profile_image)>0)
                {

                        $arr_card_photo_size  = [];
                        $arr_card_photo_size  = getimagesize($request->file('profile-image'));
       
                        if(isset($arr_card_photo_size[0]) && $arr_card_photo_size[0]!="" && isset($arr_card_photo_size[1]) && $arr_card_photo_size[1]!="")
                        {
                            if($arr_card_photo_size[0]<175 || $arr_card_photo_size[1]<188)
                            {
                                Flash::error('Please upload image of size greater than 200 X 190 for better resolution.');
                               return redirect()->back();
                            }
                        }

                        $extention  =   strtolower($profile_image->getClientOriginalExtension());
                        $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                        if(!in_array($extention, $valid_ext))
                        {

                            Flash::error('Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                            return redirect()->back()->withInput($request->all());
                        }
                        else
                        {

                            @unlink(config('app.project.img_path.profile-image').$request->input('old_profile_image'));
                            $upload_profile_image      = $request->file('profile-image');
                            $file_extension            = strtolower($request->file('profile-image')->getClientOriginalExtension()); 
                            $upload_profile_image      = sha1(uniqid().$upload_profile_image.uniqid()).'.'.$file_extension;
                            $upload_result             = $request->file('profile-image')->move($this->base_path.config('app.project.img_path.patient'), $upload_profile_image);
                            //dd($upload_result );
                        }
                }
                else
                {
                    Flash::error('Please upload valid image.');
                    return redirect()->back()->withInput($request->all());
                }
            }
            else
            {

                $upload_profile_image = $request->input('old_profile_image');
            }

            $update_result = $this->UserModel->where('id',$user->id)->update(array('profile_image'=>$upload_profile_image));

            if($update_result)
            {

                Flash::success('Profile Updated Successfully.');
                return redirect()->back();
            }
            else
            {

                Flash::error("Problem Occured, While updating profile."); 
                return redirect()->back(); 
            }

        }    
      return redirect()->back();  
    }
    /*by rohini */
    public function location_listing()
    {
        $arr_result      = $arr_location = [];
        $term            = trim(\Request::get('term'));
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
    /*================================End=========================================================*/
    /*
      Rohini jagtap
      date:17 march 2017
      description:load change password view
    */
    public function change_password()
    {
          $this->arr_view_data['page_title']       = 'Change Password';
          $this->arr_view_data['module_url_path']  = $this->module_url_path;
          $this->arr_view_data['patient_path']    = $this->pharmacy_path;
         return view($this->module_view_folder.'.change_password',$this->arr_view_data);
    }

    public function update_password(Request $request)
    {
        $arr_rules = $arr_credencial = [];
        $new_credentials             = [];

        $arr_rules['current_password']    = "required";
        $arr_rules['new_password']        = "required";
        $arr_rules['confirm_password']    = "required";
       

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user                       = Sentinel::check();

        $password                   = trim($request->input('current_password'));

        $arr_credencial['email']    = $user->email;        
        $arr_credencial['password'] = $password;

        if(Sentinel::validateCredentials($user,$arr_credencial)) 
        { 
          
            $new_credentials['password'] = $request->input('new_password');

            if(Sentinel::update($user,$new_credentials))
            {
              Flash::success('Password changed successfully.');
            }
            else
            {
              Flash::error('Problem occured while changing a password.');
            }          
        } 
        else
        {
           Flash::error('Your current password is invalid.');          
        }       
        return redirect()->back(); 
    } 
    /*------------ Rohini work start from here-------------------------------------------- */
    public function get_notification_data()
    {
        $arr_notification = [];
        $obj_notificaton  =  $this->NotificationModel->where('to_user_id',$this->user_id)->get();
        if($obj_notificaton)
        {
            $arr_notification = $obj_notificaton->toArray();
        }
        return $arr_notification;
    }
   
    ## fast signup functions
    public function fast_profile()
    {
        $arr_prefix     = [];
        $this->arr_view_data['page_title'] = 'My Profile';
        $local_pharmacy = "";
        $patient_arr    = array();

        $obj_prefix     = $this->PrefixModel->get();
        if($obj_prefix)
        {
            $arr_prefix = $obj_prefix->toArray();
        }

        $user = Sentinel::check();
       
        if(!$user)
        {
            Flash::error('Please login to your account.');
            return redirect(url('/')."/patient/error");
        }

        $patient_info = $this->PatientModel->where('user_id',$user->id)->with(['userinfo'])->first();
        if($patient_info)
        {
            $patient_arr = $patient_info->toArray();
            $this->arr_view_data['patient_arr'] = $patient_arr;
        }
       
        $this->arr_view_data['arr_prefix']      = $arr_prefix;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['site_url']        = $this->site_url;
        return view($this->module_view_folder.'.fast_profile',$this->arr_view_data);
    }

    public function store_fast_profile(Request $request)
    {
        $arr_rules = array();
        $arr_rules['title']         = 'required';
        $arr_rules['first_name']    = 'required';
        $arr_rules['last_name']     = 'required';
        $arr_rules['gender']        = 'required';
        $arr_rules['email_address'] = 'required|email';
        $arr_rules['day_of_birth']  = 'required';
        $arr_rules['date_of_month'] = 'required';
        $arr_rules['date_of_year']  = 'required';
        $arr_rules['mobile_no']     = 'required|numeric';
        $arr_rules['phone_no']      = 'required';
        $arr_rules['address']       = 'required';
        $arr_rules['suburb']        = 'required';
       
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
           Flash::error("Problem Occured.".$validator->errors()); 
           return back()->withErrors($validator)->withInput();
        }


        $form_data  =   $request->all();

        $arr_data['gender']        = $form_data['gender']; 
        $arr_data['date_of_birth'] = $form_data['date_of_year'].'-'.$form_data['date_of_month'].'-'.$form_data['day_of_birth']; 
        $arr_data['mobile_no']     = $form_data['mobile_no']; 
        $arr_data['phone_no']      = $form_data['phone_no']; 
        $arr_data['streen_address']= $form_data['address']; 
        $arr_data['manually_address']= $form_data['manually_address']; 
        $arr_data['suburb']        = $form_data['suburb']; 
        $arr_data['my_local_pharmacy']= 0;

        $user = Sentinel::check();
        
        if($user)
        {
            $update_patient         = $this->PatientModel->where('user_id',$user->id)->update($arr_data);
            $update_arr = array('title'        => $form_data['title'],
                                'first_name'   => $form_data['first_name'],
                                'last_name'    => $form_data['last_name']);
            $update_result = $this->UserModel->where('id',$user->id)->update($update_arr);
            if($update_patient || $update_result)
            {
                Flash::success("Profile has been updated successfully."); 
                if(isset($form_data['status_redirect']) && $form_data['status_redirect']!="")
                {
                   
                    if($form_data['status_redirect']=='no')
                    {
                        return redirect()->back();
                    }
                    else
                    {
                        $today_date = date('d-m-Y');
                        $current_time = date("H:i",strtotime('+5 minutes'));
                        Session::set('consultation_for','advice_and_treatement');
                        Session::set('booking_patient_id',0);
                        Session::set('signup_type','FAST');
                        $visitor_id = Session::get('booking_visitor_id');
                        if($visitor_id=='')
                        {
                            Session::set('booking_visitor_id',uniqid());
                        }
                        ##-->insert first record in temp booking table
                        $temp_booking_id = Session::get('temp_booking_id');
                        if($temp_booking_id=='')
                        {
                            $insrt_arr = array();
                            $insrt_arr['user_id']            = $user->id;
                            $insrt_arr['family_member_id']   = Session::get('booking_patient_id');
                            $insrt_arr['visitor_id']         = Session::get('booking_visitor_id');
                            $insrt_arr['consultation_for']   = Session::get('consultation_for');
                            $insrt_arr['signup_type']        = Session::get('signup_type');
                            $res = $this->TempConsultationBookingModel->create($insrt_arr);
                            if($res)
                            {
                                Session::set('temp_booking_id',$res->booking_id);
                                return redirect('/search/doctor/search_more_precise?speciality=GP++(General+Practitioner)&available_date='.urlencode($today_date).'&available_time='.urlencode(convert_24_to_12($current_time)).'&language=English&gender=Any&specific_doctor=Yes');
                            }
                            else
                            {
                                return redirect('/search/doctor/who-is-patient');
                            }
                        }
                        else
                        {
                            return redirect('/search/doctor/who-is-patient');
                        }
                    }
                }
                else
                {
                    return redirect()->back();
                }
            }
            else
            {
                Flash::error("Problem Occured, While updating profile."); 
                return redirect()->back(); 
            }
        }
        else
        {
            Flash::error("Invalid User."); 
            return redirect()->back(); 
        }
        return redirect()->back(); 
    }
}