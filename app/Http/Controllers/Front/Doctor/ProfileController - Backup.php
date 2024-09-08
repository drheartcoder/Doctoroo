<?php
namespace App\Http\Controllers\Front\Doctor;
use App\Models\UserModel;
use App\Models\LanguageModel;
use App\Models\DoctorModel;
use App\Models\TimezoneModel;
use App\Models\DoctorReferencesModel;
use App\Models\PrefixModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;


class ProfileController extends Controller
{
    public function __construct(UserModel             $user_model,
                                LanguageModel         $language_model,
                                DoctorModel           $doctor_model,
                                TimezoneModel         $timezone,
                                DoctorReferencesModel $doctor_refernce,
                                PrefixModel           $prefix_model)
    {

        $this->arr_view_data      = [];

        $this->UserModel                    = $user_model;
        $this->LanguageModel                = $language_model;
        $this->DoctorModel                  = $doctor_model;
        $this->DoctorReferencesModel        = $doctor_refernce;
        $this->TimezoneModel                = $timezone;
        $this->PrefixModel                  = $prefix_model;


      	$this->module_view_folder           = 'front.doctor.profile';
        $this->module_url_path              = url('/').'/doctor/profile';

        $this->doctor_base_img_path          = public_path().config('app.project.img_path.doctor');
        $this->doctor_public_img_path        = url('/public').config('app.project.img_path.doctor');

        $this->ahpra_certificate_base_path      = public_path().config('app.project.img_path.AHPRA_certificate');
        $this->driver_licence_base_path         = public_path().config('app.project.img_path.drivers_licence');
        $this->telehealth_certificate_base_path = public_path().config('app.project.img_path.telehealth_certificate');

        $this->video_base_path      = public_path().config('app.project.img_path.doctor_video');
        $this->video_public_path    = url('/public').config('app.project.img_path.doctor_video');

        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }


    }
     /*------------------------------ Rohini Jagtap----10 march 2017------------------------------------------------*/
    
    public function profile_step1()
    {
        $current_date = $is_dst = '';
        $arr_language = $arr_doctor = $arr_timezone = $arr_timezone_dst=[];


        $obj_language = $this->LanguageModel->get();
        if($obj_language)
        {
            $arr_language = $obj_language->toArray();
        }

        /* get austrlia timezone according to dst*/
        $obj_timezone = $this->TimezoneModel->get();
        if($obj_timezone)
        {
            $arr_timezone = $obj_timezone->toArray();
        }

        $obj_prefix  = $this->PrefixModel->get();
        if($obj_prefix)
        {
             $arr_prefix = $obj_prefix->toArray();
        }

        $date         = new DateTime("now");
        $is_dst       = intval(date_format($date, "I"));
        if($is_dst==0)
        {
            
                foreach($arr_timezone as $key =>$timezone)
                {
                    $arr_timezone_dst[$key]['id']            = $timezone['id'];
                    $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                }
        }
        else
        {
           

                foreach ($arr_timezone as $key => $timezone) 
                {
                    if($timezone['summer_time']=='')
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['standard_time'];
                    }
                    else
                    {
                        $arr_timezone_dst[$key]['id']            = $timezone['id'];
                        $arr_timezone_dst[$key]['time']          = $timezone['summer_time'];
                    }
                   
                }
        }


        $obj_doctor   = $this->DoctorModel->where('user_id','=',$this->user_id)
                                          ->with(['userinfo'=>function($q){
                                                $q->select('id','title','email','first_name','last_name','profile_image');
                                          }])
                                          ->first();
        if($obj_doctor)
        {
          $arr_doctor_data = $obj_doctor->toArray();
        }
        $this->arr_view_data['arr_prefix']      = $arr_prefix;
        $this->arr_view_data['arr_timezone']    = $arr_timezone_dst;
        $this->arr_view_data['arr_doctor_data'] = $arr_doctor_data;
        $this->arr_view_data['arr_language']    = $arr_language;
        $this->arr_view_data['page_title']     = 'Profile Step 1';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.step1',$this->arr_view_data);
    }
    public function update_profile_step1(Request $request)
    {

        $arr_rules                          = $form_data = $arr_doctor_data = [];
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required";
        $arr_rules['language']              = "required";
        $arr_rules['phone']                 = "required|max:10|min:10";
        $arr_rules['qualification']         = "required";
       // $arr_rules['timezone']              = "required";
        $arr_rules['suburb_practice']       = "required";
        $arr_rules['practice_experience']   = "required";

        $validator  = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $obj_doctor                                 = $this->DoctorModel->with(['userinfo'=>function($q){
                                                                                 $q->select('id','profile_image');
                                                                          }])
                                                                        ->where('user_id','=',$this->user_id)
                                                                        ->first();

        $form_data                                  = $request->all();
        $arr_doctor_data['gender']                  = $form_data['gender'];
        $arr_doctor_data['language_spoken']         = $form_data['language'];
        $arr_doctor_data['regular_practice_name']   = $form_data['practice_name'];

        $arr_doctor_data['suburb_of_practice']      = $form_data['suburb_practice'];
        $arr_doctor_data['practice_address']        = $form_data['address'];
        $arr_doctor_data['practice_phone']          = isset($form_data['office_phone'])?$form_data['office_phone']:'';
        $arr_doctor_data['practice_timezone']       = isset($form_data['current_timezone'])?$form_data['current_timezone']:'';
        $arr_doctor_data['contact_phone']           = $form_data['phone'];
        $arr_doctor_data['contact_mobile']          = isset($form_data['mobile_no'])?$form_data['mobile_no']:'';
        $arr_doctor_data['practitioner_experience'] = $form_data['practice_experience'];
        $arr_doctor_data['medical_qualification']   = $form_data['qualification'];

        $arr_user_data['title']                     = $form_data['title'];
        $arr_user_data['first_name']                = $form_data['first_name'];
        $arr_user_data['last_name']                 = $form_data['last_name'];

        if($request->hasFile('doctor_profile_image')) 
        {
            $profile_image  = $request->file('doctor_profile_image');

            $img_valiator   = Validator::make(array('image'=>$profile_image),array('image' => 'mimes:png,jpeg,jpg')); 

            if($profile_image->isValid() && $img_valiator->passes())
            {

                  if(isset($obj_doctor->userinfo->profile_image) && $obj_doctor->userinfo->profile_image!="") 
                  {
                      $path = $this->doctor_base_img_path.$obj_doctor->userinfo->profile_image;
                      $file_exist = file_exists($path);

                      if($file_exist) 
                      {
                          unlink($path);
                      }
                  }


                  $fileExtension                  = strtolower($profile_image->getClientOriginalExtension()); 
                  $enc_profile_image              = sha1(uniqid().$profile_image.uniqid()).'.'.$fileExtension;
                  $profile_image->move($this->doctor_base_img_path, $enc_profile_image);
                  
                  $arr_user_data['profile_image'] = $enc_profile_image;
                  
            }
            else
            {
                 Flash::error('Invalid file extension,please select valid image.');
                 return back()->withErrors($validator)->withInput($request->all());
            }
                
        }

        $user                 = Sentinel::findById($this->user_id);
        $update_user_data     = Sentinel::update($user,$arr_user_data);
        if($obj_doctor)
        {
          $update_doctor_data = $obj_doctor->update($arr_doctor_data);
        }
         
        if($update_user_data || $update_doctor_data)
        {
            Flash::success('Step 1 has been saved. Continue step 2 below.');
            return redirect($this->module_url_path.'/step2');
        }
        else
        {
            Flash::error('Error occure while updating doctor details.');
            return redirect()->back();
        }



    }
    public function profile_step2()
    {
        $obj_doctor   = $this->DoctorModel->where('user_id','=',$this->user_id)
                                          ->with(['userinfo'=>function($q){
                                                $q->select('id','title','email','first_name','last_name','profile_image');
                                          },'doctor_refernces'])

                                          ->first();
        if($obj_doctor)
        {
           $arr_doctor_data = $obj_doctor->toArray();
           //dd($arr_doctor_data);
        }

        $this->arr_view_data['arr_doctor_data'] = $arr_doctor_data;

        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['page_title']      = 'Profile Step 2';
        return view($this->module_view_folder.'.step2',$this->arr_view_data);
    }
    public function update_profile_step2(Request $request)
    {
        $count_refernce                      = 0;
        $arr_rules                           = $form_data = $arr_doctor_data =$arr_refernce= [];
        $arr_rules['provider_no']            = "required";
        $arr_rules['prescriber_no']          = "required";
        $arr_rules['registration_no']        = "required";
        $arr_rules['abn_number']             = "required";
        $arr_rules['telehealth_number']      = "required";
       


        $validator  = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $form_data  = $request->all();
        $arr_doctor_data['practitioner_provider_number']           = $form_data['provider_no'];
        $arr_doctor_data['practitioner_prescriber_number']         = $form_data['prescriber_no'];
        $arr_doctor_data['AHPRA_registration_number']              = $form_data['registration_no'];
        $arr_doctor_data['ABN']                                    = $form_data['abn_number'];
        $arr_doctor_data['telehealth_insurance_provider']          = $form_data['telehealth_number'];
        $arr_doctor_data['drivers_licence_number']                 = $form_data['driver_licence'];

        $arr_refernce['user_id']                                    = $this->user_id;

        /* add or update doctor refernces */
        if(isset($form_data['ref_name']) && $form_data['ref_name']!='')
        {

            foreach($form_data['ref_name'] as $key=>$name)
            {

                if($form_data['ref_name'][$key]!='' && $form_data['ref_number'][$key]!='' && $form_data['ref_email'][$key] && $form_data['ref_phone'][$key]!='')
                {
                   $arr_refernce['reference_name']   = $form_data['ref_name'][$key];
                   $arr_refernce['reference_number'] = $form_data['ref_number'][$key];
                   $arr_refernce['reference_email']  = $form_data['ref_email'][$key];
                   $arr_refernce['reference_phone']  = $form_data['ref_phone'][$key];
                   $arr_refernce['ref_index']        = $form_data['ref_index'][$key];

                    $refernce_count         = $this->DoctorReferencesModel->where('user_id','=',$this->user_id)
                                                                          ->where('ref_index','=',$key)->count();

                    if($refernce_count>0)
                    {
                       $obj_update_refernce = $this->DoctorReferencesModel->where('user_id','=',$this->user_id)
                                                                          ->where('ref_index','=',$key)
                                                                          ->update($arr_refernce);
                    }
                    else
                    {
                       $obj_create_refernce = $this->DoctorReferencesModel->create($arr_refernce);
                    }
                  
        
                }          
               
            }
         }
            

             $obj_doctor                             = $this->DoctorModel->where('user_id','=',$this->user_id)
                                                                                       ->first();

             /*AHPRA certificate upload code*/
            if($request->hasFile('AHPRA_certificate')) 
            {
                $AHPRA_certificate  = $request->file('AHPRA_certificate');

                $img_valiator       = Validator::make(array('image'=>$AHPRA_certificate),array('image' => 'mimes:png,jpeg,jpg,pdf,doc')); 

                if($AHPRA_certificate->isValid() && $img_valiator->passes())
                {

                      if(isset($obj_doctor->AHPRA_certificate) && $obj_doctor->AHPRA_certificate!="") 
                      {
                          $path = $this->ahpra_certificate_base_path.$obj_doctor->AHPRA_certificate;
                          $file_exist = file_exists($path);

                          if($file_exist) 
                          {
                              unlink($path);
                          }
                      }


                      $fileExtension                        = strtolower($AHPRA_certificate->getClientOriginalExtension()); 
                      $enc_ahpra_certificate                = sha1(uniqid().$AHPRA_certificate.uniqid()).'.'.$fileExtension;
                      $AHPRA_certificate->move($this->ahpra_certificate_base_path,$enc_ahpra_certificate);
                      
                      $arr_doctor_data['AHPRA_certificate'] = $enc_ahpra_certificate;
                      
                }
                else
                {
                     Flash::error('Invalid file extension,please select valid image.');
                     return back()->withErrors($validator)->withInput($request->all());
                }
                    
            }
             /*telehealth certificate upload code*/
            if($request->hasFile('telehealth_certificate')) 
            {
                $telehealth_certificate  = $request->file('telehealth_certificate');

                $img_valiator            = Validator::make(array('image'=>$telehealth_certificate),array('image' => 'mimes:png,jpeg,jpg,pdf,doc')); 

                if($telehealth_certificate->isValid() && $img_valiator->passes())
                {

                      if(isset($obj_doctor->upload_insurance_policy) && $obj_doctor->upload_insurance_policy!="") 
                      {
                          $path = $this->telehealth_certificate_base_path.$obj_doctor->upload_insurance_policy;
                          $file_exist = file_exists($path);

                          if($file_exist) 
                          {
                              unlink($path);
                          }
                      }


                      $fileExtension                        = strtolower($telehealth_certificate->getClientOriginalExtension()); 
                      $enc_telehealth_certificate                = sha1(uniqid().$telehealth_certificate.uniqid()).'.'.$fileExtension;
                      $telehealth_certificate->move($this->telehealth_certificate_base_path,$enc_telehealth_certificate);
                      
                      $arr_doctor_data['upload_insurance_policy'] = $enc_telehealth_certificate;
                      
                }
                else
                {
                     Flash::error('Invalid file extension,please select valid image.');
                     return back()->withErrors($validator)->withInput($request->all());
                }
            }

             /*drivers  licence  upload code*/
            if($request->hasFile('driving_certificate')) 
            {
                $driver_licence = $request->file('driving_certificate');

                $img_valiator   = Validator::make(array('image'=>$driver_licence),array('image' => 'mimes:png,jpeg,jpg,pdf,doc')); 

                if($driver_licence->isValid() && $img_valiator->passes())
                {

                      if(isset($obj_doctor->upload_drivers_licence) && $obj_doctor->upload_drivers_licence!="") 
                      {
                          $path = $this->driver_licence_base_path.$obj_doctor->upload_drivers_licence;
                          $file_exist = file_exists($path);

                          if($file_exist) 
                          {
                              unlink($path);
                          }
                      }


                      $fileExtension                     = strtolower($driver_licence->getClientOriginalExtension()); 
                      $enc_driver_licence                = sha1(uniqid().$driver_licence.uniqid()).'.'.$fileExtension;
                      $driver_licence->move($this->driver_licence_base_path,$enc_driver_licence);
                      
                      $arr_doctor_data['upload_drivers_licence'] = $enc_driver_licence;
                      
                }
                else
                {
                     Flash::error('Invalid file extension,please select valid image.');
                     return back()->withErrors($validator)->withInput($request->all());
                }
            }

            if($obj_doctor)
            {
              $update_doctor_data = $obj_doctor->update($arr_doctor_data);
            }
             
            if($update_doctor_data)
            {
                Flash::success('Step 2 has been saved. Continue step 3 below.');
                return redirect($this->module_url_path.'/step3');
            }
            else
            {
                Flash::error('Error occure while updating doctor details.');
                return redirect()->back();
            }

       
    }
    public function profile_step3()
    {
        $obj_doctor   = $this->DoctorModel->where('user_id','=',$this->user_id)
                                          ->with(['userinfo'=>function($q){
                                                $q->select('id','title','email','first_name','last_name','profile_image');
                                          }])

                                          ->first();
        if($obj_doctor)
        {
           $arr_doctor_data = $obj_doctor->toArray();

        }
        $this->arr_view_data['video_base_path']   = $this->video_base_path;
        $this->arr_view_data['video_public_path'] = $this->video_public_path;
        $this->arr_view_data['arr_doctor_data']   = $arr_doctor_data;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['page_title']        = 'Profile Step 3';
        return view($this->module_view_folder.'.step3',$this->arr_view_data);
    }
    public function update_profile_step3(Request $request)
    {
         $size_in_mb = '';
         $form_data  = $arr_rules = [];

         $form_data              = $request->all();
         $obj_doctor             = $this->DoctorModel->where('user_id','=',$this->user_id)
                                                   ->first();
          if($request->hasFile('doctor_video')) 
          {       
                $video          = $request->file('doctor_video');
                
                  $size = $video->getClientSize();
                  $size_in_mb = number_format($size / 1048576, 2);
                  
                  if(isset($size_in_mb) && $size_in_mb>10)
                  {
                      Flash::error('Please upload video upto 10 MB only.');
                      return redirect()->back();
                  }

                  if(isset($obj_doctor->video) && $obj_doctor->video!="") 
                  {
                      $path       = $this->video_base_path.$obj_doctor->video;
                      $file_exist = file_exists($path);

                      if($file_exist) 
                      {
                          unlink($path);
                      }
                  }
                  
                    $fileExtension            = strtolower($video->getClientOriginalExtension()); 

                    $enc_video                = sha1(uniqid().$video.uniqid()).'.'.$fileExtension;
                    $video->move($this->video_base_path,$enc_video);    

                    $arr_doctor_data['video'] = $enc_video;
                    $arr_doctor_data['video_extension'] = $fileExtension;
              
       
          }
          $arr_doctor_data['biography'] = $form_data['biography'];

          $doctor_update_status         = $obj_doctor->update($arr_doctor_data); 

          if($doctor_update_status)
          {
              Flash::success('You\'ve successfully updated your profile details.');
              return redirect()->back();
              //return redirect($this->module_url_path.'/dashboard');
          }
          else
          {
              Flash::error('Error occure while updating doctor details.');
              return redirect()->back();
          }

       
    }
    public function download_certificate($type)
    {
        $arr_certificate = [];
        $file_name       = '';
        $obj_certificate = $this->DoctorModel->where('user_id','=',$this->user_id)
                                                    ->select('AHPRA_certificate','upload_insurance_policy','upload_drivers_licence')
                                                    ->first();
        if($obj_certificate)
        {
              $arr_certificate    = $obj_certificate->toArray();
              if($type=='ahpra')
              {
                   
                  
                       
                        $file_name          = $arr_certificate['AHPRA_certificate'];
                        $pathToFile      = $this->ahpra_certificate_base_path.$file_name;

                        $file_exits      = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
                        
                  
              }
              else if($type=='insurance')
              {
                        $file_name          = $arr_certificate['upload_insurance_policy'];
                        $pathToFile      = $this->telehealth_certificate_base_path.$file_name;

                        $file_exits      = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
              }
              else if($type=='drivers_licence')
              {
                        $file_name          = $arr_certificate['upload_drivers_licence'];
                        $pathToFile         = $this->driver_licence_base_path.$file_name;

                        $file_exits         = file_exists($pathToFile);
                        if($file_exits)
                        {
                           //ob_end_clean(); //clear the buffer memory before download file
                           return response()->download($pathToFile, $file_name); 
                        }
                        else
                        {
                           Flash::error("Error while downloading an document.");
                        }
              }
        }
        return redirect()->back();
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