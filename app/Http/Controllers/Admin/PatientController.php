<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use App\Models\UserModel;
use App\Models\MedicareDetailsModel;
use App\Models\RegularDoctorModel;
use App\Models\DoctorInvitationModel;
use App\Models\StatesModel;
use App\Models\MainPharmaciesModel;
use App\Models\FamilyMemberModel;
use App\Models\MedicalhistoryModel;
use App\Models\IllnessAndConditionModel;
use App\Models\PrefixModel;
use App\Models\PatientMedicalhistoryModel;
use App\Models\MobileCountryCodeModel;
use App\Models\EntitlementModel;
use App\Models\ProfileAffectedAreaModel;
use App\Models\FamilyDoctorsModel;

use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use Response;
use File;
/*-------------------------------Ankit Aher(20th feb 2017)---------------------------*/
class PatientController extends Controller
{
     public function __construct(UserModel                  $user,
                                PatientModel                $patient, 
                                MedicareDetailsModel        $medicare,
                                RegularDoctorModel          $regular,
                                DoctorInvitationModel       $invitation,
                                StatesModel                 $state,
                                MainPharmaciesModel         $MainPharmacies,
                                FamilyMemberModel           $family,
                                MedicalhistoryModel         $history,
                                IllnessAndConditionModel    $illness,
                                PrefixModel                 $prefix_model,
                                PatientMedicalhistoryModel  $patientmedicalhistory,
                                MobileCountryCodeModel      $mob_country_code,
                                EntitlementModel            $entitlement_model,
                                ProfileAffectedAreaModel    $ProfileAffectedAreaModel,
                                FamilyDoctorsModel          $FamilyDoctorsModel)
    {
       
        $this->UserModel                    = $user;
        $this->PatientModel                 = $patient;
        $this->MedicareDetailsModel         = $medicare;
        $this->RegularDoctorModel           = $regular;
        $this->DoctorInvitationModel        = $invitation;
        $this->StatesModel                  = $state;
        $this->MainPharmaciesModel          = $MainPharmacies;
        $this->FamilyMemberModel            = $family;
        $this->MedicalhistoryModel          = $history;
        $this->IllnessAndConditionModel     = $illness;
        $this->PrefixModel                  = $prefix_model;
        $this->PatientMedicalhistoryModel   = $patientmedicalhistory;
        $this->MobileCountryCodeModel       = $mob_country_code;
        $this->entitlement_model            = $entitlement_model;
        $this->ProfileAffectedAreaModel     = $ProfileAffectedAreaModel;
        $this->FamilyDoctorsModel           = $FamilyDoctorsModel;

        $this->arr_view_data                = [];
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/patient");
        $this->module_title                 = "Patient";
        $this->module_view_folder           = "admin.patient";
        $this->admin_panel_slug             = config('app.project.admin_panel_slug');
        $this->public_img_path              = url('/public').config('app.project.img_path.card-photo');
        $this->base_path                    = base_path().'/public';
        $this->site_url                     = url('/');

        $this->patient_uploads_url                  = public_path().config('app.project.img_path.patient_uploads');
        $this->patient_uploads_base_url             = url('/public').config('app.project.img_path.patient_uploads');

        $this->patient_profile_img_base_path                = public_path().config('app.project.img_path.patient');
        $this->patient_profile_img_public_path              = url('/public').config('app.project.img_path.patient');

    }

    /*================Updated by Seema(27-Feb-2017)========================================*/

    public function index()
    {

        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {             
                $arr_manage =  $this->PatientModel->whereHas('userinfo',function(){})
                                                  ->with(['userinfo.roles' => function($query) {

                                                      $query->where('slug','=','patient');
                                                  }])
                                                  ->orderBy('id','DESC')
                                                  ->get(); 
             
                if($arr_manage!=FALSE)
                {
                    $arr_manage_patient = $arr_manage->toArray();
                }

                $this->arr_view_data['arr_patient']     = $arr_manage_patient; 
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = 'Manage Patient';
                return view($this->module_view_folder.'/index',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    /*===================Seema(27-Feb-2017)==========================*/

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
                    Flash::success('Patient Activated Successfully.');
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
                    Flash::success('Patient Dectivated Successfully.');
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

        if($enc_id!="")
        {
            $user_id     = base64_decode($enc_id);
            $user_result = $this->UserModel->where('id',$user_id)->delete(); 

            if($user_result)
            {
                $patient_result = $this->PatientModel->where('user_id',$user_id)->delete();
                if($patient_result)
                {
                    Flash::success('Patient Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Patient.');
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

    public function multi_action(Request $request)
    {
       
        $arr_rules                   =  array();
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
                    $deletedoctor =    $this->PatientModel->where('user_id',$record_id)->first();
                    if($deletedoctor)
                    {
                        $result_info = $deletedoctor->delete();

                        if($result_info)
                        {                   
                            Flash::success('Patient Deleted Successfully'); 
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
                        Flash::success('Patient Activated Successfully'); 
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
                        Flash::success('Patient Deactivated Successfully.');  
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

    public function activations($enc_id=FALSE)
    {

        if($enc_id!="")
        {
            $user_id = base64_decode($enc_id);
            $update_arr = array('verification_status'=>'1',
                                'user_status'=>'Active',
                                'token'      =>'');

        $user = Sentinel::findById($user_id);

        $activation = Activation::createModel()->where('user_id', $user_id)->first();

        if(Activation::exists($user))
        {
            if(Activation::complete($user, $activation->code))
            {
                 //As per testers requirement
                 
                 $resUser = $this->UserModel->where('id',$user_id)->update($update_arr);

                 if($resUser)
                 {
                    Flash::success('Patient verification completed successfully.');
                 }
                 else
                 {
                    Flash::error('Problem Occured, While patient verification.');
                 }      
                 
            }
            else
            {
               Flash::error('Problem Occured, While patient verification.');
            }   
        } 
        else{
                
               $activation = Activation::create($user);

               if($activation)
               {
                   $resUser = $this->UserModel->where('id',$user_id)->update(['verification_status'=>'1','user_status'=>'Active','token'=>'']);
                   if($resUser)
                   {
                       Flash::success('Patient verification completed successfully.');
                   }
                   else
                   {
                       Flash::error('Problem Occured, While patient verification.');
                   }      
               }     
            }   
           
       
        }
         return redirect()->back();   
    }

    public function show($enc_id=null)
    {
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            
        
            $arr_manage =  $this->PatientModel->with(['userinfo','medicaredetails','regulardoctor','localpharmacy'])->where('user_id',$id)->first();

             if($arr_manage!=FALSE)
            {
                $arr_manage_patient = $arr_manage->toArray();
            }

            // get referred_by user details
            $referred_by_user = [];
            $referred_by_user['title'] = $referred_by_user['first_name'] = $referred_by_user['last_name'] = '';
            if($arr_manage_patient['referred_by'] != 0)
            {
                $arr_user = Sentinel::findById($arr_manage_patient['referred_by']);
                if($arr_user!=FALSE)
                {
                    $referred_by_user = $arr_user->toArray();
                }
            }

            $arr_medi = $this->MedicareDetailsModel->where('user_id',$id)->get();

            if($arr_medi!=FALSE)
            {
                $arr_manage_medicare = $arr_medi->toArray();
            }

            // get all the patient which have used this user referral code for signup
            $arr_friend_users = $arr_friend_users_details = [];
            $arr_friend_users = $this->PatientModel->with('userinfo')->where('referred_by', $arr_manage_patient['user_id'])->get();
            if(count($arr_friend_users) > 0)
            {
                $arr_friend_users_details = $arr_friend_users->toArray();   
            }
            //dd($arr_friend_users_details);
          
            /*--------------------------for family member-------------------------*/
            $arr_family = $this->FamilyMemberModel->with('userinfo')->where('user_id',$id)->get();
            if($arr_medi!=FALSE)
            {
                $arr_familymember = $arr_family->toArray();
            }
            if(isset($arr_manage_patient['mobile_code']) && !empty($arr_manage_patient['mobile_code']))
            {
                $get_mob_code = $this->MobileCountryCodeModel->where('id', $arr_manage_patient['mobile_code'])->first();
                if($get_mob_code)
                {
                    $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
                   
                } 

            }
            if(isset($arr_manage_patient['user_id']) && !empty($arr_manage_patient['user_id']))
            {
                $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $arr_manage_patient['user_id'])
                                                            ->get();
                if($affected_area_img)
                {
                  $this->arr_view_data['affected_area_img_arr'] = $affected_area_img->toArray();      
                }  

                

                $family_doctors = $this->FamilyDoctorsModel->where([
                                                                    ['user_id',$arr_manage_patient['user_id']],
                                                                    ['status','link']
                                                                  ])
                                                            ->with('userinfo')
                                                            ->orderBy('id','desc')
                                                            ->get();

                if(isset($family_doctors) && !empty($family_doctors))
                {
                    $this->arr_view_data['family_doctor_arr'] = $family_doctors->toArray();
                }
            }
            

            $entitlement_arr = $this->entitlement_model->get();

            if($entitlement_arr)
            {
                $this->arr_view_data['entitlement_arr'] = $entitlement_arr->toArray();
            }
            
            $this->arr_view_data['patient_profile_img_base_path']   = $this->patient_profile_img_base_path;
            $this->arr_view_data['patient_profile_img_public_path'] = $this->patient_profile_img_public_path;  
            $this->arr_view_data['patient_uploads_url']             = $this->patient_uploads_url;
            $this->arr_view_data['patient_uploads_base_url']        = $this->patient_uploads_base_url;
            $this->arr_view_data['data_info']                       = $arr_manage_patient;
            $this->arr_view_data['data_medicare']                   = $arr_manage_medicare;
            $this->arr_view_data['data_family']                     = $arr_familymember;
            $this->arr_view_data['enc_id']                          = $enc_id;
            $this->arr_view_data['page_title']                      = 'Patient Details';
            $this->arr_view_data['module_url_path']                 = $this->module_url_path;
            $this->arr_view_data['module_title']                    = 'Patient Details';
            $this->arr_view_data['referred_user']                   = $referred_by_user;
            $this->arr_view_data['arr_friend_users_details']        = $arr_friend_users_details;

            return view($this->module_view_folder.'/show',$this->arr_view_data);     
        }

        return redirect()->back();
    }

    public function family($enc_id=null)
    { 
        if($enc_id)
        {
            $id  = base64_decode($enc_id);

             $arr_manage =  $this->PatientModel->with(['userinfo','medicaredetails','regulardoctor'])->where('user_id',$id)->first();
          
            if($arr_manage!=FALSE)
            {
                $get_mob_code = $this->MobileCountryCodeModel->where('id', $arr_manage['mobile_code'])->first();
                if($get_mob_code)
                {
                    $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
                } 
                $arr_manage_patient = $arr_manage->toArray();
              
            }

            /*--------------------------for family member-------------------------*/
            $arr_family = $this->FamilyMemberModel->where('user_id',$id)->with('userinfo')->get();
            if($arr_family!=FALSE)
            {
                $arr_familymember = $arr_family->toArray();
            }  
            
            $this->arr_view_data['data_patient']    = $arr_manage_patient;
            $this->arr_view_data['data_family']     = $arr_familymember;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Family Members';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = 'Family Members';

            return view($this->module_view_folder.'/familymember',$this->arr_view_data);     
        }

        return redirect()->back();

    }
    /*------------------------------family member upadte-------------------*/
    public function datasave(Request $request,$enc_id=null)
    {
        if($enc_id)   
        {          
            $id                         = base64_decode($enc_id); 
            $form_data                  = array();
            $arr_data                   = array();
            $responce_data              = array();
            $form_data                  = $request->all();
            
            $arr_data['relationship']   = $form_data['relationship'];
            $arr_data['first_name']     = $form_data['first_name'];
            $arr_data['last_name']      = $form_data['last_name'];
            $arr_data['gender']         = $form_data['gender'];
            $arr_data['date_of_birth']  = $form_data['date_of_birth'];
            $arr_data['mobile_number']  = $form_data['mobile_number'];

            $update_status = $this->FamilyMemberModel->where('id',$id)->update($arr_data);

            if ($update_status)
            {
                $responce_data['status']  = 'SUCCESS';
                $responce_data['message'] = 'Record updaed successfully';
            }
            else
            {
                $responce_data['status']  = 'ERROR';
                $responce_data['message'] = 'Error while updating record';
            }
        }
        else
        {
            $responce_data['status']  = 'ERROR';
            $responce_data['message'] = 'Error while updating record';
        }

        return response()->json($responce_data);
    }
    /*-------------displya medical history------------------*/
    public function medicalhistory($enc_id=null)
    { //dd('hh'); 
        $arr_manage_patient = $arr_familymember = $arr_medicalhistory = [];
        $illness_str        = '';
        if($enc_id)
        {
            $id  = base64_decode($enc_id);

            /*--------------------------for family member-------------------------*/
            $arr_family = $this->FamilyMemberModel->where('id',$id)->first();
            if($arr_family!=FALSE)
            {
                $arr_familymember = $arr_family->toArray();

            }  
            $family_member_id=$arr_familymember['id'];
             $obj_medicalhistory = $this->MedicalhistoryModel
                                       ->whereHas('illnessinfo',function($q){})

                                       ->with(['illnessinfo'=>function($q) use($family_member_id){
                                        $q->where('family_member_id','=',$family_member_id);
                                      },'patient_medical_history','get_family_info','patient_details.userinfo'])

                                       ->where("family_member_id",'=',$id)
                                       ->where('user_id','=',$arr_familymember['user_id'])
                                       ->first();

            if(isset($obj_medicalhistory) && $obj_medicalhistory!='' &&  $obj_medicalhistory!=null)
            {
                $arr_medicalhistory = $obj_medicalhistory->toArray();
           
            }
            
            /*----------current past illness--------------*/
            if(isset($arr_medicalhistory) && sizeof($arr_medicalhistory)>0)
            {   
                  if(isset($arr_medicalhistory['illnessinfo']['illness_id']) && $arr_medicalhistory['illnessinfo']['illness_id']!='')
                    { 
                        foreach($arr_medicalhistory['illnessinfo']['illness_id'] as $illness_id)
                        { 
                            $obj_illness   =   $this->IllnessAndConditionModel->where('id',$illness_id)->select('illness_name')->first();
                           //dd($obj_illness);
                            $arr_illness[] =   $obj_illness->illness_name;
                        }
                        $illness_str   = implode(',',$arr_illness);
                        //dd($illness_str);
                    }

            }
            /*for current & past medication details*/
            $obj_current_medicalhistory = $this->PatientMedicalhistoryModel->where("family_member_id",'=',$id);
            $obj_past_medicalhistory    = $this->PatientMedicalhistoryModel->where("family_member_id",'=',$id);
            $obj_curr_medicalhistory      =  $obj_current_medicalhistory->where('m_type','current')
                                                                      ->where('family_member_id','=',$id)
                                                                      ->get();

             $obj_past_medicalhistory =  $obj_past_medicalhistory->where('m_type','past')
                                                                    ->where('family_member_id','=',$id)
                                                                    ->get();

             if($obj_curr_medicalhistory!=FALSE)
             {
                   $arr_curr_medicalhistory =  $obj_curr_medicalhistory->toArray();
                   
             }

             if($obj_past_medicalhistory!=FALSE)
             {
                   $arr_past_medicalhistory =  $obj_past_medicalhistory->toArray();

             }

            $this->arr_view_data['data_patient']             = $arr_manage_patient;
            $this->arr_view_data['data_family']              = $arr_familymember;
            $this->arr_view_data['data_history']             = $arr_medicalhistory;
            $this->arr_view_data['illness_str']              = $illness_str;
            $this->arr_view_data['arr_curr_medicalhistory']  = $arr_curr_medicalhistory;
            $this->arr_view_data['arr_past_medicalhistory']  = $arr_past_medicalhistory;
            $this->arr_view_data['enc_id']                   = $enc_id;
            $this->arr_view_data['page_title']               = 'Medical History';
            $this->arr_view_data['module_url_path']          = $this->module_url_path;
            $this->arr_view_data['module_title']             = 'Family Members';

            return view($this->module_view_folder.'/medicalhistory',$this->arr_view_data);     
        }

        return redirect()->back();

    }

    public function edit($enc_id=FALSE)
    {
         if($enc_id!="")   
         {
                $arr_prefix     = [];
        
                $patient_arr    = array();

                $obj_prefix     = $this->PrefixModel->get();
                if($obj_prefix)
                {
                    $arr_prefix = $obj_prefix->toArray();
                }
              $this->arr_view_data['page_title']      = 'Update Patient';
              $arr_patient = $arr_states = array();
              $user_id = base64_decode($enc_id);  

              $obj_patient = $this->PatientModel->where('user_id',$user_id)->with(['userinfo','medicaredetails','regulardoctor'])->first();

              if($obj_patient!=FALSE)
              {
                    $arr_patient = $obj_patient->toArray();

              }       

              $obj_main_pharmacy = $this->MainPharmaciesModel->take(100)->orderBy('pharmacy_name','asc')->get();

            /*========Pharmacy Array================*/

            if($obj_main_pharmacy)
            {
                $arr_search_location = $obj_main_pharmacy->toArray();
            }


            $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $user_id)
                                                            ->get();
            if($affected_area_img)
            {
              $this->arr_view_data['affected_area_img_arr'] = $affected_area_img->toArray();      
            }

            $entitlement_arr = $this->entitlement_model->get();

            if($entitlement_arr)
            {
                $this->arr_view_data['entitlement_arr'] = $entitlement_arr->toArray();
            }

             $get_mob_code = $this->MobileCountryCodeModel->get();
              if($get_mob_code)
              {
                  $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
              }

            $this->arr_view_data['patient_profile_img_base_path']   = $this->patient_profile_img_base_path;
            $this->arr_view_data['patient_profile_img_public_path'] = $this->patient_profile_img_public_path;  
            $this->arr_view_data['patient_uploads_url']             = $this->patient_uploads_url;
            $this->arr_view_data['patient_uploads_base_url']        = $this->patient_uploads_base_url;
            $this->arr_view_data['arr_prefix']                      = $arr_prefix;
            $this->arr_view_data['arr_pharmacies']                  = $arr_search_location;
            $this->arr_view_data['arr_patient']                     = $arr_patient;  
            $this->arr_view_data['module_url_path']                 = $this->module_url_path; 
            $this->arr_view_data['module_title']                    = 'Update Patient'; 

            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
         }

        return redirect()->back(); 
    }

    public function update(Request $request,$enc_id)
    { 
        $form_data  =   $request->all();
        $update_arr['title'] = $form_data['title'];
        $update_arr['first_name'] = $form_data['first_name'];
        $update_arr['last_name'] = $form_data['last_name'];


        if($enc_id!="")
        {
            $user_id   = base64_decode($enc_id);  

            $obj_data = $this->UserModel->where('id',$user_id)->first(['id','profile_image']);
            if($obj_data)
            {
                $arr_profile_data = $obj_data->toArray(); 
            }

            $file_name = $arr_profile_data['profile_image'];

            $arr_rules = array();

            $arr_rules['title']                = 'required';
            $arr_rules['first_name']           = 'required';
            $arr_rules['last_name']            = 'required';
            $arr_rules['gender']               = 'required';
            $arr_rules['day_of_birth']         = 'required';
            $arr_rules['date_of_month']        = 'required';
            $arr_rules['date_of_year']         = 'required';
            $arr_rules['mobile_no']            = 'required|numeric';
            $arr_rules['mobile_no_code']       = 'required';
            $arr_rules['address']              = 'required';
            $arr_rules['entitlement']          = 'required';
            $arr_rules['entitlement_card_no']  = 'required';
            

            $validator = Validator::make($request->all(),$arr_rules);

              if($validator->fails())
              {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
              }
        

        }
        /*======================Profile Image===============================================*/

          if($request->hasFile('profile_image'))
          { 
              $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 

              $arr_file_types = ['jpg','jpeg','png','bmp'];

              if(in_array($fileExtension, $arr_file_types) )
              {
                    if(isset($arr_profile_data) && sizeof($arr_profile_data)>0)
                    {
                          if(File::exists($this->patient_profile_img_base_path.$arr_profile_data['profile_image']))
                          {              
                            @unlink($this->patient_profile_img_base_path.$arr_profile_data['profile_image']);
                          } 
                    }

                    $file_name      = $request->input('profile_image');
                    $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $request->file('profile_image')->move($this->patient_profile_img_base_path, $file_name);
                    $update_arr['profile_image'] = $file_name;
              } 
              else 
              {
                Session::flash('msg','Please upload valid image with jpg, jpeg ,png extension');
                return redirect()->back();
              }  
          }
        

      $exist_img_arr = explode(',',$request->existing_images);

      $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $user_id)
                                                          ->select('affected_area_photo')
                                                        ->get();
      if(isset($affected_area_img) && !empty($affected_area_img))
      {
          $affected_area_img_arr = $affected_area_img->toArray();     
          $img_arr=[];
          foreach($affected_area_img_arr as $img)
          {
              if(!empty($img['affected_area_photo']))
              {
                  array_push($img_arr, $img['affected_area_photo']);
              }
          }

          $before = $img_arr;
          $after =  $exist_img_arr;

          $delete_array = array_diff($img_arr,$exist_img_arr);

          foreach($delete_array as $val)
          {
              $this->ProfileAffectedAreaModel->where('affected_area_photo',$val)
                                             ->delete();
               if($val!='' && File::exists($this->patient_uploads_url.$val))                                
               {
                  unlink($this->patient_uploads_url.$val);
               }
          }
      }


      if($request->hasFile('affected_area'))
      { 

         $medical_file   =   $request->file('affected_area');
          if(isset($medical_file) && sizeof($medical_file)>0)
          {
              $cnt = 1;

              foreach($medical_file as $file)
              {
                $extention  =   strtolower($file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('medical_img_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                    return redirect()->back()->withInput($request->all());
                }
                else if($file->getClientSize() > 5000000)
                {
                    Session::flash('medical_img_error','Please upload image with small size. Max size allowed is 5mb');
                    return redirect()->back()->withInput($request->all());
                }
                else
                {
                    $medical_name           = $file;
                    $medical_file_extension = strtolower($file->getClientOriginalExtension()); 
                    $medical_file_name      = sha1(uniqid().$medical_name.uniqid()).'.'.$medical_file_extension;
                    $medical_upload_result  = $file->move($this->patient_uploads_url, $medical_file_name);

                    $data_arr['patient_id']          = $user_id;
                    $data_arr['affected_area_photo'] = $medical_file_name;

                    $this->ProfileAffectedAreaModel->create($data_arr);
                    $cnt++;
                }
              }
          }
      }

      
        
        $arr_data['gender']           = $form_data['gender']; 
        $arr_data['date_of_birth']    = $form_data['date_of_year'].'-'.$form_data['date_of_month'].'-'.$form_data['day_of_birth']; 
        $arr_data['mobile_code']      = $form_data['mobile_no_code']; 
        $arr_data['mobile_no']        = encrypt_value($form_data['mobile_no']); 
        $arr_data['phone_no']         = $form_data['enc_phone_no']; 
        $arr_data['suburb']           = $form_data['enc_address']; 
        $arr_data['entitlement_id']   = $form_data['entitlement']; 
        $arr_data['card_no']          = $form_data['entitlement_card_no']; 
        
        if($user_id)
        {    
            $update_patient         = $this->PatientModel->where('user_id',$user_id)->update($arr_data);

             $update_result = $this->UserModel->where('id',$user_id)->update($update_arr);

             if($update_patient || $update_result || $medicare_result || $regular_doctor_result)
             {

                 Flash::success("Profile has been updated successfully."); 
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

    public function local_pharmacy(Request $request)
    {
        $search_term = $request->input('search_pharmacy');
        if($search_term!="")
        {
            $arr_pharmacies = array();
            $str = ''; 

            $str .='<select name="local_pharmacy" id="local_pharmacy" class="form-control">'; 
            $str .= '<option value="">-Select Local Pharmacy-</option>';

            $obj_main_pharmacy   = $this->MainPharmaciesModel->where('suburb','LIKE','%'.$search_term.'%')->orderBy('pharmacy_name','asc')->get();    
            if($obj_main_pharmacy!=FALSE)
            {
                $arr_pharmacies = $obj_main_pharmacy->toArray();
             
                if(sizeof($arr_pharmacies)>0)
                {                  
                    foreach ($arr_pharmacies as $pharmacy) {

                        $str .= '<option value="'.$pharmacy['id'].'">'.$pharmacy['pharmacy_name'].'</option>';
                    }

                }
                else { echo"error"; }    
            }
            else { echo"error"; }

          echo $str.= '</select>';  
        }

     }
    /*=========================End===========================================================*/

}   
