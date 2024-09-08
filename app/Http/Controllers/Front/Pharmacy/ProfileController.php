<?php
namespace App\Http\Controllers\Front\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PharmacyModel;
use App\Models\UserModel;
use App\Models\PharmacyTimeSchedule;
use App\Models\PharmacyBannerGroupModel;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use Validator;



class ProfileController extends Controller
{
    public function __construct( PharmacyModel           $temp_pharmacy,
                                PharmacyTimeSchedule     $temp_time_schedule,
                                UserModel                $user_model,
                                PharmacyBannerGroupModel $pharmacy_banner)
    {
        $this->arr_view_data            = [];
        $this->module_title             = "Pharmacy";
        $this->module_url_path          = url('/').'/pharmacy';
        $this->module_view_folder       = "front.pharmacy.profile";
        $this->site_url                 = url('/');

        $this->UserModel                = $user_model;
        $this->PharmacyModel            = $temp_pharmacy;
        $this->PharmacyTimeSchedule     = $temp_time_schedule;
        $this->PharmacyBannerGroupModel = $pharmacy_banner;

        $this->pharmacy_base_img_path   = public_path().config('app.project.img_path.pharmacy');
        $this->pharmacy_public_img_path = url('/public').config('app.project.img_path.pharmacy');

        $this->arr_days        = [];
        $this->arr_days['MON'] = "Monday";
        $this->arr_days['TUE'] = "Tuesday";
        $this->arr_days['WED'] = "Wednesday";
        $this->arr_days['THU'] = "Thursday";
        $this->arr_days['FRI'] = "Friday";
        $this->arr_days['SAT'] = "Saturday";
        $this->arr_days['SUN'] = "Sunday";

        $user = Sentinel::check();
        if($user!=false)
        {
           $this->user_id  = $user->id;
        }
      
    

    }
    /*
      Rohini Jagtap
      date:8 march 2017
      edit and update pharmacy profile details
    */
    public function index()
    {
          $arr_pharmacy = [];
          $arr_pharmacy  = get_pharmacy_profile_data();

          $this->arr_view_data['arr_pharmacy']     =  $arr_pharmacy;
          $this->arr_view_data['page_title']       = 'Dashboard';
          $this->arr_view_data['module_url_path']  =  $this->module_url_path;
          return view($this->module_view_folder.'.dashboard',$this->arr_view_data);
    }
    /*
      Rohini Jagtap
      date:8 march 2017
      edit pharmacy profile step1 details
    */
    public function profile_step1()
    {
          $arr_pharmacy   = $arr_banner_group = [];
          $obj_pharmacy   = $this->PharmacyModel->where('user_id','=',$this->user_id)->with(['userinfo'=>function($q){

                                                                                            $q->select('id','email','first_name','last_name');

                                                                                        }])
                                                                                       ->first(); 
          if($obj_pharmacy)
          {
            
             $arr_pharmacy  = $obj_pharmacy->toArray();

          }

          $obj_banner_group     = $this->PharmacyBannerGroupModel->get();
          if($obj_banner_group)
          {
              $arr_banner_group = $obj_banner_group->toArray();

          }
          $this->arr_view_data['arr_banner_group'] = $arr_banner_group;
          $this->arr_view_data['arr_pharmacy']     = $arr_pharmacy;
          $this->arr_view_data['page_title']       = 'Profile';
          $this->arr_view_data['module_url_path']  = $this->module_url_path;
		     return view($this->module_view_folder.'.step1',$this->arr_view_data);
    }
    /*
      Rohini Jagtap
      date:8 march 2017
      update pharmacy profile step1 details
    */
    public function update_profile_step1(Request $request)
    {
        $arr_rules = $form_data = $arr_pharmacy_data = [];
        $obj_signup_update ='';

        $pharmacy_id = $token_id = 0;
        $arr_rules['first_name']    = "required";
        $arr_rules['last_name']     = "required";
        $arr_rules['pharmacy_name'] = "required";
        $arr_rules['phone']         = "required|max:10|min:10";
        $arr_rules['address1']      = "required";


        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $form_data = $request->all();
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

        $arr_user['first_name']       = $form_data['first_name'];
        $arr_user['last_name']        = $form_data['last_name'];
        $arr_user['phone']            = $form_data['phone'];

        $user                         = Sentinel::findById($this->user_id);
        if($user)
        {
          $user_update_status         = Sentinel::update($user,$arr_user);
        }

        $obj_pharmacy          = $this->PharmacyModel->where('user_id','=',$this->user_id)->first();

        if($request->hasFile('pharmacy_logo')) 
        {
            $pharmacy_logo  = $request->file('pharmacy_logo');

            $img_valiator   = Validator::make(array('image'=>$pharmacy_logo),array('image' => 'mimes:png,jpeg,jpg')); 

            if($pharmacy_logo->isValid() && $img_valiator->passes())
            {

                  if(isset($obj_pharmacy->logo) && $obj_pharmacy->logo!="") 
                  {
                      $path = $this->pharmacy_base_img_path.'/'.$obj_pharmacy->logo;
                      $file_exist = file_exists($path);

                      if($file_exist) 
                      {
                          unlink($path);
                      }
                  }


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
        if($obj_pharmacy)
        {
          $pharmacy_update_status     = $obj_pharmacy->update($arr_pharmacy_data);
        }

        if($user_update_status || $pharmacy_update_status)
        {
           Flash::success('Your first step has been saved! Continue step 2 of 3 below.'); 
           return redirect($this->module_url_path.'/profile_step2');
        }
        else
        {
           Flash::success('Error while updating a profile.'); 
           return redirect()->back();
        }
     

    }
    /*
      Rohini Jagtap
      date:8 march 2017
      edit pharmacy profile step2 details
    */
    public function profile_step2()
    {
        $arr_pharmacy     = [];
        $obj_pharmacy     =   $this->PharmacyModel->where('user_id','=',$this->user_id)
                                                  ->first(); 
        if($obj_pharmacy)
        {
           $arr_pharmacy  = $obj_pharmacy->toArray();
        }
        
        $this->arr_view_data['arr_pharmacy']       = $arr_pharmacy;
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        return view($this->module_view_folder.'.step2',$this->arr_view_data);
    }
     /*
      Rohini Jagtap
      date:8 march 2017
      update pharmacy profile step2 details
    */
    public function update_profile_step2(Request $request)
    {
        $arr_update = $arr_rules =$form_data=[];
        $arr_rules['aprox_script_per_day']    = "required";
        $arr_rules['computer_system_used']    = "required";

        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $form_data = $request->all();

        $arr_update['aprox_script_per_day']                = $form_data['aprox_script_per_day'];
        $arr_update['computer_system_used']                = $form_data['computer_system_used'];
        $arr_update['other_computer_system']               = isset($form_data['other_field'])?$form_data['other_field']:'';
        $arr_update['services']                            = $form_data['services'];
        $arr_update['other_service']                       = isset($form_data['other_service'])?$form_data['other_service']:'';

       
        $obj_pharmacy                 = $this->PharmacyModel->where('user_id','=',$this->user_id)->first();
        if($obj_pharmacy)
        {
          $pharmacy_update_status     = $obj_pharmacy->update($arr_update);
        }

        if($pharmacy_update_status)
        {
           Flash::success('Step 2 saved,you are one step away!'); 
           return redirect($this->module_url_path.'/profile_step3');
        }
        else
        {
           Flash::success('Error while updating a profile.'); 
           return redirect()->back();
        }

    }
     /*
      Rohini Jagtap
      date:8 march 2017
      edit pharmacy profile step3 details
    */
    public function profile_step3()
    {
        $arr_days     = $arr_pharmacy_schedule = [];
        $arr_off_days = [];
        $arr_days     = $this->arr_days;
        $obj_schedule = $this->PharmacyTimeSchedule->where('user_id','=',$this->user_id)->first();
        if($obj_schedule)
        {
            $arr_pharmacy_schedule = $obj_schedule->toArray();
        }

         foreach ($arr_days as $day_key => $day) 
         {
            $small_case_day_slug = strtolower($day_key); 
            if(isset($arr_pharmacy_schedule[$small_case_day_slug.'_off']) && $arr_pharmacy_schedule[$small_case_day_slug.'_off']==1)
            {
                $arr_off_days[$small_case_day_slug.'_off'] = $arr_pharmacy_schedule[$small_case_day_slug.'_off'];

            }
             
         }
        $this->arr_view_data['arr_days']              = $arr_days;
        $this->arr_view_data['arr_pharmacy_schedule'] = $arr_pharmacy_schedule;
        $this->arr_view_data['module_url_path']       = $this->module_url_path;
        return view($this->module_view_folder.'.step3',$this->arr_view_data);
    }
     /*
      Rohini Jagtap
      date:8 march 2017
      update pharmacy profile step3 details
    */
    public function update_profile_step3(Request $request)
    {
         $form_data = $arr_days = $arr_time_data =[];
         $obj_schedule_update = $message ='';

          $arr_days  = $this->arr_days;
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

          $obj_schedule                        = $this->PharmacyTimeSchedule->where('user_id',$this->user_id);
          if($obj_schedule)
          {
            $schedule_update_status            = $obj_schedule->update($arr_time_data);
          }
          if($schedule_update_status)
          {

              Flash::success('Your profile details updated successfully.'); 
              return redirect($this->module_url_path.'/dashboard');

          }
          else
          {
             Flash::success('Error while updating a profile.'); 
             return redirect()->back(); 
          }
    }
    /*
      Rohini jagtap
      date:16 march 2017
      description:load change password view
    */
    public function change_password()
    {
          $this->arr_view_data['page_title']       = 'Change Password';
          $this->arr_view_data['module_url_path']  = $this->module_url_path;
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
  
}
?>