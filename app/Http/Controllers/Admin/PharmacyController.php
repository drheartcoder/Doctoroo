<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Models\UserModel;
use App\Models\PharmacyModel;
use App\Models\PharmacyTimeSchedule;
use App\Models\PharmacyBannerGroupModel;
use App\Models\PharmacyInvitationModel;
use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use URL;
use Paginator;
/*-------------------------------Ankit Aher(20th feb 2017) updated by Seema(3-March-2017)---------------------------*/

class PharmacyController extends Controller
{
    public function __construct(
                                UserModel                    $user,
                                PharmacyModel                $pharmacy,
                                PharmacyTimeSchedule         $timeschedule,
                                EmailService                 $mail_service,
                                PharmacyBannerGroupModel     $banner,
                                PharmacyInvitationModel      $invitation
                                )
    {

        $this->UserModel                = $user;
        $this->PharmacyModel            = $pharmacy;

        $this->EmailService             = $mail_service;
        $this->PharmacyTimeSchedule     = $timeschedule;
        $this->PharmacyBannerGroupModel = $banner;
        $this->invitation               = $invitation;
        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/pharmacy");
        $this->module_title             = "Pharmacy";
        $this->module_view_folder       = "admin.pharmacy";
        $this->admin_panel_slug         = config('app.project.admin_panel_slug');

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

    }

     public function index()
     {

        /*$this->arr_view_data['page_title']  =  str_singular($this->module_title);*/
        $this->arr_view_data['page_title']  =  'Verified Pharmacies';
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {


                $arr_manage =  $this->PharmacyModel->whereHas('userinfo',function(){})
                                                   ->with(['userinfo.roles' => function($query) {

                                                        $query->where('slug','=','pharmacy');
                                                  }])
                                                  ->whereHas('userinfo', function($query)
                                                  {
                                                        $query->where('verification_status',1);
                                                        $query->where('admin_verification_status_mini',1);
                                                        $query->orderBy('id','DESC');
                                                       
                                                  })
                                                  ->orderBy('id','DESC')
                                                  ->get(); 


                if($arr_manage!=FALSE)
                {
                    $arr_manage_doctor = $arr_manage->toArray();
                }
                //dd($arr_manage_doctor);
                
                $this->arr_view_data['arr_pharmacy']    = $arr_manage_doctor;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = 'Verified Pharmacies';
                return view($this->module_view_folder.'/verifiedpharmacies',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/verifieddoctor');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    /*========================Seema(3 March)===================================*/

    public function applications()
    {

            /*$this->arr_view_data['page_title']  =  str_singular($this->module_title);*/
            $this->arr_view_data['page_title']  =  'Pharmacy Applications';
            $this->arr_view_data['arr_pharmacy']= array();

            $obj_pharmacy = $this->PharmacyModel->whereHas('userinfo',function(){})
                                                ->with(['userinfo.roles' => function($query) {

                                                      $query->where('slug','=','pharmacy');
                                                }])
                                                ->whereHas('userinfo', function($query)
                                                {
                                                      $query->where('admin_verification_status_mini',0);
                                                      $query->orWhere('verification_status',0);
                                                      $query->orderBy('id','DESC');
                                                     
                                                })
                                                ->orderBy('id','DESC')
                                                ->get(); 


            if($obj_pharmacy!=FALSE)
            {
                $arr_pharmacy = $obj_pharmacy->toArray();
            }    



            $this->arr_view_data['arr_pharmacy']    = $arr_pharmacy;
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = 'Pharmacy Applications';
            return view($this->module_view_folder.'/pharmacyapplication',$this->arr_view_data);
    } 

    public function verify($enc_id)
    {

        $user_id    = base64_decode($enc_id);

        $user       = Sentinel::findById($user_id);

        $activation = Activation::createModel()->where('user_id', $user_id)->first();

        if(Activation::exists($user))
        {
            if(Activation::complete($user, $activation->code))
            {
                 //As per testers requirement
                 $arr_mail_data =  $this->notify_mail_data($user_id);
                 $email_status  = $this->EmailService->send_mail($arr_mail_data);

                 if($email_status)
                 {
                      Flash::success('Pharmacy verification mail send successfully.'); 
                      return redirect()->back();
                 }  
            }
            else
            {
                  Flash::error('Problem Occured, While pharmacy verification mail sending.');
                  return redirect()->back();
            }   
        } 
        else
        {
                
               $activation = Activation::create($user);

               if($activation)
               {                  
                    $arr_mail_data =  $this->notify_mail_data($user_id);
                    $email_status  = $this->EmailService->send_mail($arr_mail_data); 

                   if($email_status)
                   { 
                        Flash::success('Pharmacy verification mail send successfully.'); 
                        return redirect()->back();
                   } 
                   else
                   {
                       Flash::error('Problem Occured, While pharmacy verification mail sending.');
                       return redirect()->back();
                   }

               } 

        }   
           
        return redirect()->back();   

    }

    public function notify_mail_data($user_id)
    {

        $user = $this->UserModel->where('id',$user_id)->first();

       if($user)
        {
            $arr_user   = $user->toArray();
            $token_code = rand(00000,99999);

            $update_result = $this->UserModel->where('id',$user_id)->update(['token'=>$token_code]);

            if($update_result)
            {
                $activation_url = '<a target="_blank" style="background:#50ab50; color:#fff; text-align:center;border-radius: 4px; padding: 15px 18px; text-decoration: none;" href="'.URL::to('pharmacy/verify/'.base64_encode($arr_user['id']).'/'.base64_encode($token_code) ).'">Verify Account</a>.<br/>' ;

                $arr_built_content = ['USER_FNAME'    => $arr_user['first_name'],
                                      'EMAIL'         => $arr_user['email'],
                                      'ACTIVATION_URL'=> $activation_url, 
                                      'APP_NAME'      => config('app.project.name')];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '6';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_user;

                return $arr_mail_data;
            }       
        }

        return FALSE;
    }

    public function show($enc_id=FALSE)
    {
        $arr_days = $arr_pharmacy = [];

        if($enc_id!="")
        {
            $arr_days         = $this->arr_days;
            $pharmacy_user_id = base64_decode($enc_id);
            $obj_pharmacy     = $this->PharmacyModel->where('user_id',$pharmacy_user_id)
                                                    ->with(['timeSchedule','userinfo'=>function($q){
                                                        $q->select('id','email','first_name','last_name');
                                                    }])
                                                    ->first();
            if($obj_pharmacy)
            {
              $arr_pharmacy   = $obj_pharmacy->toArray();
            }
             $obj_banner_group     = $this->PharmacyBannerGroupModel->get();
            if($obj_banner_group)
            {
                $arr_banner_group = $obj_banner_group->toArray();

            }
            
        $arr_off_days = [];
        $arr_pharmacy_schedule = [];
        $obj_schedule = $this->PharmacyTimeSchedule->where('user_id','=',$pharmacy_user_id)->first();
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

            $this->arr_view_data['pharmacy_base_img_path']     = $this->pharmacy_base_img_path;
            $this->arr_view_data['pharmacy_public_img_path']   = $this->pharmacy_public_img_path;
            $this->arr_view_data['arr_pharmacy_schedule']      = $arr_pharmacy_schedule;
            $this->arr_view_data['arr_days']                   = $arr_days;
            $this->arr_view_data['arr_pharmacy']               = $arr_pharmacy;
            $this->arr_view_data['arr_banner']                 = $arr_banner_group;
            $this->arr_view_data['page_title']                 =  'Pharmacy Details'; 
            $this->arr_view_data['enc_user_id']                = $enc_id;
            $this->arr_view_data['module_url_path']            = $this->module_url_path;
            $this->arr_view_data['module_title']               = ' Pharmacy Details';
            return view($this->module_view_folder.'/show',$this->arr_view_data);  
        }

        return redirect()->back();     
    }  
    
    public function activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $user_id = base64_decode($enc_id);
            $user_info = $this->UserModel->where('id',$user_id)->first();

            if(sizeof($user_info)>0)
            {
                $update_result = $this->UserModel->where('id',$user_id)->update(['user_status'=>'Active']);
                if($update_result)
                {
                    Flash::success('Pharmacy User Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }

        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();

    }

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $user_id = base64_decode($enc_id);
            $user_info = $this->UserModel->where('id',$user_id)->first();

            if(sizeof($user_info)>0)
            {
                $update_result = $this->UserModel->where('id',$user_id)->update(['user_status'=>'Block']);
                if($update_result)
                {
                    Flash::success('Pharmacy User Dectivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }

        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $delete_pharmacy_user = $this->UserModel->where('id',$id)->delete();

            if($delete_pharmacy_user)
            {
                  $pharmacy_result = $this->PharmacyModel->where('user_id',$id)->delete();
                  $time_result     = $this->PharmacyTimeSchedule->where('user_id',$id)->delete();

                  if($pharmacy_result || $time_result)
                  {
                        Flash::success('Pharmacy User Deleted Successfully.');
                  }
                  else 
                  {                   
                       Flash::error('Problem Occured, While Deleting Pharmacy User.');
                  }     

                Flash::success('Pharmacy User Deleted Successfully.');   

            }
            else
            {
                  Flash::error('Problem Occured, While Deleting Pharmacy User.');
            }
             
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

      return redirect()->back();

    }

    public function multi_action(Request $request)
    {
       
        $arr_rules                   = array();
        $arr_rules['multi_action']   = 'required';
        $arr_rules['checked_record'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');


        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            { 
        
                $deleteuser= $this->UserModel->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    $deletedoctor =    $this->PharmacyModel->where('user_id',$record_id)->first();
                    if($deletedoctor)
                    {
                        $result_info = $deletedoctor->delete();

                        if($result_info)
                        {
                   
                            Flash::success('Pharmacie\'s Deleted Successfully'); 
                        }
                        else
                        {
                            Flash::error('Problem Occured, While Deleting Patient');    
                        }
                    }        
                } 
            }
            elseif($multi_action=="activate")
            {
                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['user_status'=>'Active']);

                    if($result_status)
                    { 

                        Flash::success('Pharmacie\'s Activated Successfully'); 
                    }
                    else
                    {

                        Flash::error('Problem Occured, While Activating Patient');    
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['user_status'=>'Block']);

                    if($result_status)
                    {  

                        Flash::success('Pharmacie\'s Deactivated Successfully.');  
                    }
                    else
                    {

                        Flash::error('Problem Occured, While Deactivating Patient.');    
                    }
                }        
            }
        }

        return redirect()->back();
    }
    /*
      Manually verified user account & send mail of credencials
    */
    public function activations($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $user_id = base64_decode($enc_id);

            $update_arr = array('verification_status'=>'1',
                                //'user_status'=>'Active',
                                'token'      =>'');

            $user = Sentinel::findById($user_id);

            $activation = Activation::createModel()->where('user_id', $user_id)->first();

            if(Activation::exists($user))
            {
                if(Activation::complete($user, $activation->code))
                {
                       $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

                       if($resUser)
                       {
                            $arr_mail_data =  $this->send_login_credencial_mail($user);
                            $email_status  =  $this->EmailService->send_mail($arr_mail_data);

                            Flash::success('Pharmacy verification completed successfully.');
                       }  
                       else
                       {
                          Flash::error('Error, While pharmacy verification.');
                       }      
                     
                }
                else
                {   
                   Flash::error('Error, While pharmacy verification.');
                }   
            } 
            else{
                        
                   $activation = Activation::create($user);

                   if($activation)
                   {
                       $resUser = $this->UserModel->where('id',$user_id)->update(['verification_status'=>'1','user_status'=>'Active','token'=>'']);
                       if($resUser)
                       {
                            $arr_mail_data =  $this->send_login_credencial_mail($user);
                            $email_status  =  $this->EmailService->send_mail($arr_mail_data);
                            Flash::success('Pharmacy verification completed successfully.');
                       }
                       else
                       {
                            Flash::error('Error, While pharmacy verification.');
                       }     
                   }     
                }   
        }   
        return redirect()->back();   
    }

    public function send_login_credencial_mail($user)
    {
          $arr_built_content = $arr_mail_data = [];
          $password = mt_rand(100000, 999999);
         
          if($user)
          {
                 $arr_built_content = ['FIRST_NAME'    => $user->first_name,
                                       'EMAIL'         => $user->email,
                                       'PASSWORD'      => $password,  
                                       'APP_NAME'      => config('app.project.name')];


                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '39';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $user;

          }
          return $arr_mail_data;
    }

    /*
    Rohini Jagtap 
    date:6 march 2017
    description:edit pharmacy details
    */
   /* ---------Ankit Aher(23rd march)---------------*/
    public function edit($enc_id=FALSE)
    {
        $arr_days = $arr_pharmacy = [];
        if($enc_id!="")
        {

            $arr_days         = $this->arr_days;
            $pharmacy_user_id = base64_decode($enc_id);
            $obj_pharmacy     = $this->PharmacyModel->where('user_id',$pharmacy_user_id)
                                                    ->with(['timeSchedule','userinfo'=>function($q){
                                                        $q->select('id','email','first_name','last_name');
                                                    }])
                                                    ->first();
            if($obj_pharmacy)
            {
              $arr_pharmacy        = $obj_pharmacy->toArray();
            }
             $obj_banner_group     = $this->PharmacyBannerGroupModel->get();
            if($obj_banner_group)
            {
                $arr_banner_group  = $obj_banner_group->toArray();

            }
            
        $arr_off_days = [];
        $arr_pharmacy_schedule = [];
     
        $obj_schedule = $this->PharmacyTimeSchedule->where('user_id','=',$pharmacy_user_id)->first();
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

            $this->arr_view_data['pharmacy_base_img_path']     = $this->pharmacy_base_img_path;
            $this->arr_view_data['pharmacy_public_img_path']   = $this->pharmacy_public_img_path;
            $this->arr_view_data['arr_pharmacy_schedule']      = $arr_pharmacy_schedule;
            $this->arr_view_data['arr_days']                   = $arr_days;
            $this->arr_view_data['arr_pharmacy']               = $arr_pharmacy;
            $this->arr_view_data['arr_banner']                 = $arr_banner_group;
            $this->arr_view_data['page_title']                 = 'Edit Pharmacy';     
            $this->arr_view_data['enc_user_id']                = $enc_id;
            $this->arr_view_data['module_url_path']            = $this->module_url_path;
            $this->arr_view_data['module_title']               = 'Update Pharmacy Details';
            return view($this->module_view_folder.'/edit',$this->arr_view_data);  
        }

        return redirect()->back();
    }
    public function edit_pharmacy($enc_id=FALSE)
    {
        $arr_days = $arr_pharmacy = [];
        if($enc_id!="")
        {

            $arr_days         = $this->arr_days;
            $pharmacy_user_id = base64_decode($enc_id);
            $obj_pharmacy     = $this->PharmacyModel->where('user_id',$pharmacy_user_id)
                                                    ->with(['timeSchedule','userinfo'=>function($q){
                                                        $q->select('id','email','first_name','last_name');
                                                    }])
                                                    ->first();
            if($obj_pharmacy)
            {
              $arr_pharmacy        = $obj_pharmacy->toArray();
            }
             $obj_banner_group     = $this->PharmacyBannerGroupModel->get();
            if($obj_banner_group)
            {
                $arr_banner_group  = $obj_banner_group->toArray();

            }
            
        $arr_off_days = [];
        $arr_pharmacy_schedule = [];
     
        $obj_schedule = $this->PharmacyTimeSchedule->where('user_id','=',$pharmacy_user_id)->first();
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

        $this->arr_view_data['pharmacy_base_img_path']     = $this->pharmacy_base_img_path;
        $this->arr_view_data['pharmacy_public_img_path']   = $this->pharmacy_public_img_path;
        $this->arr_view_data['arr_pharmacy_schedule']      = $arr_pharmacy_schedule;
        $this->arr_view_data['arr_days']                   = $arr_days;
        $this->arr_view_data['arr_pharmacy']               = $arr_pharmacy;
        $this->arr_view_data['arr_banner']                 = $arr_banner_group;
        $this->arr_view_data['page_title']                 = 'Edit Pharmacy';     
        $this->arr_view_data['enc_user_id']                = $enc_id;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['module_title']               = 'Update Pharmacy Details';
        return view($this->module_view_folder.'/edit_pharmacy',$this->arr_view_data);  
        }

        return redirect()->back();
    }
    /*
      Rohini Jagtap 
      date:6 march 2017
      description:update pharmacy details
    */
       /* ---------Ankit Aher(23rd march)---------------*/
    public function update(Request $request)
    {
        $form_data                          = $arr_update = $arr_data = $arr_schedule = [];
        $arr_update                         = $arr_rules  =$form_data=[];
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required";
        $arr_rules['contact_role']          = "required";
        $arr_rules['pharmacy_name']         = "required";
        $arr_rules['phone']                 = "required";
        $arr_rules['address1']              = "required";
        $arr_rules['aprox_script_per_day']  = "required";
        $arr_rules['computer_system_used']  = "required";
        $arr_rules['opening_hour_notes']    = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $form_data = $request->all();
        $arr_days  = $this->arr_days;

        $user_id   = base64_decode($form_data['enc_user_id']);

        $arr_data['first_name']                  = $form_data['first_name'];
        $arr_data['last_name']                   = $form_data['last_name'];
        //$arr_data['email']                       = $form_data['email_id'];
        $arr_update['contact_role']              = isset($form_data['contact_role'])?$form_data['contact_role']:'';
        $arr_update['other_role']                = isset($form_data['other_role'])?$form_data['other_role']:'';
        $arr_update['pharmacy_name']             = $form_data['pharmacy_name'];
        $arr_update['phone']                     = $form_data['phone'];
        $arr_update['fax']                       = isset($form_data['fax'])?$form_data['fax']:'';
        $arr_update['address1']                  = $form_data['address1'];
        $arr_update['address2']                  = isset($form_data['address2'])?$form_data['address2']:''; 
        $arr_update['part_of_banner_group']      = isset($form_data['part_of_banner_group'])?$form_data['part_of_banner_group']:'';
        $arr_update['other_group']               = isset($form_data['other_group'])?$form_data['other_group']:'';
        $arr_update['website']                   = isset($form_data['website'])?$form_data['website']:'';
        $arr_update['ABN_number']                = isset($form_data['ABN'])?$form_data['ABN']:'';
        $arr_update['aprox_script_per_day']      = $form_data['aprox_script_per_day'];
        $arr_update['computer_system_used']      = $form_data['computer_system_used'];
        $arr_update['other_computer_system']     = isset($form_data['other_computer_system'])?$form_data['other_computer_system']:'';
        $arr_update['services']                  = $form_data['services'];
        $arr_update['other_service']             = isset($form_data['other_service'])?$form_data['other_service']:'';
        

        $obj_pharmacy             = $this->PharmacyModel->where('user_id','=',$user_id)->first();
       // $pharmacy_update_status     = $obj_pharmacy->update($arr_update);
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
                  $arr_update['logo']        = $enc_pharmacy_logo;
                  
            }
            else
            {
                 Flash::error('Invalid file extension,please select valid image.');
                 return back()->withErrors($validator)->withInput($request->all());
            }
                
        }

         /* schedule details*/ 
          if(sizeof($arr_days)>0)
          {
               foreach ($arr_days as $day_key => $day) 
               {     
                     $small_case_day_slug = strtolower($day_key); 
                     $arr_schedule[$small_case_day_slug.'_open']  = null;
                     $arr_schedule[$small_case_day_slug.'_close'] = null;
                     $arr_schedule[$small_case_day_slug.'_off']   = '0';
                     $status = $request->input($small_case_day_slug.'_off');

                     $arr_schedule[$small_case_day_slug.'_open']  = date("H:i ",strtotime($request->input($small_case_day_slug.'_open')));
                     $arr_schedule[$small_case_day_slug.'_close'] = date("H:i ",strtotime($request->input($small_case_day_slug.'_close')));
                     if($status!=0)
                     {
                         $arr_schedule[$small_case_day_slug.'_off']   = 1;
                     }

               }

          }
          $arr_schedule['opening_hour_notes'] = $form_data['opening_hour_notes'];

          $user_update              = $this->UserModel->where('id','=',$user_id)->update($arr_data);
          
          if($obj_pharmacy)
          {
            $pharmacy_update        = $obj_pharmacy->update($arr_update);
          }

          
          $count    = $this->PharmacyTimeSchedule->where('user_id','=',$user_id)->count();
          if($count > 0 )
          {
              $schedule_update        = $this->PharmacyTimeSchedule->where('user_id','=',$user_id)->update($arr_schedule);
          }
          else
          {
                 $arr_schedule['user_id'] = $user_id;
                 $schedule_update         = $this->PharmacyTimeSchedule->create($arr_schedule);
          }
          
          if($user_update || $pharmacy_update || $schedule_update)
          {
              Flash::success('Pharmacy details updated successfully.');
          }
          else
          {
               Flash::error('Error while updating a pharmacy details.');
          }
          return redirect()->back();

    }
    /*=========================End============================================================*/        
 
    
    /*
    | Function  : Pharmacy verification by admin
    | Author    : Deepak Arvind Salunke
    | Date      : 25/09/2017
    | Output    : Success or Error
    */

    public function admin_verified($enc_id = FALSE)
    {
        if($enc_id != "")
        {
            $user_id = base64_decode($enc_id);

            $update_arr = array('admin_verification_status_mini' => '1',
                                'user_status'               => 'Active',
                                'token'                     => '');

            $user = Sentinel::findById($user_id);
                     
            $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

            if($resUser)
            {

                Flash::success('Pharmacy verification completed successfully.');
            }
            else
            {
                Flash::error('Error, while pharmacy verification.');
            }      
                  
        
        }   
        return redirect()->back();
    } // end admin_verified

}   
