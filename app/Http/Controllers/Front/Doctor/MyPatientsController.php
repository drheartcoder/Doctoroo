<?php
namespace App\Http\Controllers\Front\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Common\Services\VirgilService;
use Twilio\Rest\Client;

use App\Models\UserModel;
use App\Models\LanguageModel;
use App\Models\DoctorModel;
use App\Models\PrefixModel;
use App\Models\PatientModel;
use App\Models\MedicareDetailsModel;
use App\Models\RegularDoctorModel;
use App\Models\MedicalhistoryModel;
use App\Models\IllnessAndConditionModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\FamilyMemberModel;
use App\Models\HealthGeneralModel;
use App\Models\HealthConditionModel;
use App\Models\LifeStylelModel;
use App\Models\MedicationModel;
use App\Models\MyPharmacyModel;
use App\Models\DynamicHealthGeneralModel;
use App\Models\FamilyDoctorsModel;
use App\Models\DoctorInvitationModel;
use App\Models\PharmacyModel;
use App\Models\MedicationPrescriptionModel;
use App\Models\EntitlementModel;
use App\Models\PatientsRegularDoctorModel;
use App\Models\NotificationModel;
use App\Models\MedicationImagesModel;
use App\Models\MedicalHistoryUpdatesModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\ConsultationNotesModel;
use App\Models\ConsultationDocumentsModel;
use App\Models\ProfileAffectedAreaModel;
use App\Models\UserEntitlementModel;
use App\Models\PharmacyListModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use DB;
use Session;
use File;
use PDF;


class MyPatientsController extends Controller
{
      public function __construct(UserModel                       $user_model,
                                  LanguageModel                   $language_model,
                                  EmailService                    $EmailService, 
                                  DoctorModel                     $doctor_model,
                                  PrefixModel                     $prefix_model,
                                  PatientModel                    $patient_model,
                                  MedicareDetailsModel            $medicare_model,
                                  RegularDoctorModel              $regular_model,
                                  MedicalhistoryModel             $medicalhistory_model,
                                  IllnessAndConditionModel        $illness_model,
                                  PatientConsultationBookingModel $consultation_model,
                                  FamilyMemberModel               $familiy_member,
                                  HealthGeneralModel              $general_model,
                                  HealthConditionModel            $condition_model,
                                  LifeStylelModel                 $lifestyle_model,
                                  MedicationModel                 $medication_model,
                                  MyPharmacyModel                 $my_pharmacy_model,
                                  DynamicHealthGeneralModel       $dynamic_general_model,
                                  FamilyDoctorsModel              $FamilyDoctorsModel,
                                  DoctorInvitationModel           $doctor_invt_model,
                                  PharmacyModel                   $pharmacy_model,
                                  MedicationPrescriptionModel     $prescription_model,
                                  EntitlementModel                $entitlement_model,
                                  PatientsRegularDoctorModel      $PatientsRegularDoctorModel,
                                  NotificationModel               $NotificationModel,
                                  MedicationImagesModel           $medication_images_model,
                                  MedicalHistoryUpdatesModel      $medical_updates_model,
                                  PatientConsultationImagesModel  $consultation_image,
                                  ConsultationNotesModel          $ConsultationNotesModel,
                                  ConsultationDocumentsModel      $ConsultationDocumentsModel,
                                  ProfileAffectedAreaModel        $ProfileAffectedAreaModel,
                                  UserEntitlementModel            $UserEntitlementModel,
                                  PharmacyListModel               $PharmacyListModel,
                                  VirgilService                   $virgil_service
                                  )
                       
      {

          $this->arr_view_data                    = [];

          $this->EmailService                     = $EmailService;
          $this->UserModel                        = $user_model;
          $this->LanguageModel                    = $language_model;
          $this->DoctorModel                      = $doctor_model;
          $this->PrefixModel                      = $prefix_model;

          $this->PatientModel                     = $patient_model;
          $this->MedicareDetailsModel             = $medicare_model;
          $this->RegularDoctorModel               = $regular_model;
          $this->MedicalhistoryModel              = $medicalhistory_model;
          $this->IllnessAndConditionModel         = $illness_model;
          $this->PatientConsultationBookingModel  = $consultation_model;
          $this->FamilyMemberModel                = $familiy_member;
          $this->HealthGeneralModel               = $general_model;
          $this->HealthConditionModel             = $condition_model;
          $this->LifeStylelModel                  = $lifestyle_model;
          $this->MedicationModel                  = $medication_model;
          $this->MyPharmacyModel                  = $my_pharmacy_model;
          $this->DynamicHealthGeneralModel        = $dynamic_general_model;
          $this->FamilyDoctorsModel               = $FamilyDoctorsModel;
          $this->DoctorInvitationModel            = $doctor_invt_model;
          $this->PharmacyModel                    = $pharmacy_model;
          $this->MedicationPrescriptionModel      = $prescription_model;
          $this->entitlement_model                = $entitlement_model;
          $this->PatientsRegularDoctorModel       = $PatientsRegularDoctorModel;
          $this->NotificationModel                = $NotificationModel;
          $this->MedicationImagesModel            = $medication_images_model;
          $this->MedicalHistoryUpdatesModel       = $medical_updates_model;
          $this->PatientConsultationImagesModel   = $consultation_image;
          $this->ConsultationNotesModel           = $ConsultationNotesModel;
          $this->ConsultationDocumentsModel       = $ConsultationDocumentsModel;
          $this->ProfileAffectedAreaModel         = $ProfileAffectedAreaModel;
          $this->UserEntitlementModel             = $UserEntitlementModel;
          $this->PharmacyListModel                = $PharmacyListModel;
          $this->VirgilService                    = $virgil_service;

          $this->module_title                     = "My Patients";
        	$this->module_view_folder               = 'front.doctor.patient';
          $this->module_url_path                  = url('/').'/doctor';
          $this->module_patient_path              = url('/').'/doctor/patients';

          $this->patient_base_img_path            = public_path().config('app.project.img_path.patient');
          $this->patient_public_img_path          = url('/public').config('app.project.img_path.patient');

          $this->profile_img_base_path            = public_path().config('app.project.img_path.patient');
          $this->profile_img_public_path          = url('/public').config('app.project.img_path.patient');

          $this->prescription_img_base_path       = public_path().config('app.project.img_path.prescription_img');
          $this->prescription_img_public_path     = url('/public').config('app.project.img_path.prescription_img');

          $this->medication_img_base_path         = public_path().config('app.project.img_path.medication_img');
          $this->medication_img_public_path       = url('/public').config('app.project.img_path.medication_img');

          $this->patient_uploads_public_url       = public_path().config('app.project.img_path.patient_uploads');
          $this->patient_uploads_base_url         = url('/public').config('app.project.img_path.patient_uploads');
          $this->profile_uploads_base_url             = public_path().config('app.project.img_path.patient_uploads');
          $this->consultation_documents_base_url      = url('/public').config('app.project.img_path.consultation_documents');
          $this->consultation_documents_public_url    = public_path().config('app.project.img_path.consultation_documents');

          $this->patient_prescription_public        = public_path().config('app.project.img_path.precription_file');
          $this->patient_prescription               = url('/public').config('app.project.img_path.precription_file');

          $this->consultation_documents_base_url      = url('/public').config('app.project.img_path.consultation_documents');
          $this->consultation_documents_public_url    = public_path().config('app.project.img_path.consultation_documents');

          $user = Sentinel::check();
          if($user)
          {
            $this->user_id = $user->id;
          }
          else
          {
            $this->user_id = null;
          }

          $this->sid                              = config('services.twilio')['accountSid'];
          $this->token                            = config('services.twilio')['auth_token'];
          $this->service_id                       = config('services.twilio')['service_id'];
          $this->client                           = new Client($this->sid,$this->token);

          DB::connection()->enableQueryLog();
    }

    /*--------------------------------------------------------------------------
                                  DOCTOROO PATIENTS - LISTING
    ----------------------------------------------------------------------------*/
    public function doctoroo_patients()
    {
      
     $patients = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                         ->with('patient_user_details')
                                                         ->where('doctor_user_id', $this->user_id)
                                                         ->whereHas('patient_info' , function($patient){
                                                           $patient->where('type','doctoroo');
                                                          })->with('patient_info')
                                                         ->groupby('patient_user_id')
                                                         ->paginate(10);                                                         

      if($patients)
      {
       $this->arr_view_data['paginate']                   = clone $patients;
       $this->arr_view_data['patients_arr']               = $patients->toArray();
      }

      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;

      return view($this->module_view_folder.'.doctoroo_patients')->with($this->arr_view_data);
    }
    /*--------------------------------------------------------------------------
                                  MY OWN PATIENTS - LISTING
    ----------------------------------------------------------------------------*/

    public function myown_patients()
    {
     $own_patients = $this->PatientModel->orderBy('id','desc')
                                        ->with('userinfo')
                                        ->where([['created_by', $this->user_id],['type','myown']])
                                        ->with('userinfo')
                                        ->paginate(10);                                                         

     if($own_patients)
      {
       $this->arr_view_data['paginate']                   = clone $own_patients;
       $this->arr_view_data['patients_arr']               = $own_patients->toArray();
      }

      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;

      return view($this->module_view_folder.'.myown_patients')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                  SEARCH PATIENT BY NAME
    ----------------------------------------------------------------------------*/

    public function search_patient_name(Request $request)
    {
      $patient_keyword = $request->doc_keyword;
      if($request->patient_type == 'doctoroo' )
      {
        $patient_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                              ->whereHas('patient_user_details', function($user_details) use($patient_keyword) {
                                                                  if(!empty($patient_keyword))
                                                                    { 
                                                                      $user_details->where('first_name','like','%'.$patient_keyword.'%');
                                                                      $user_details->orWhere('last_name','like','%'.$patient_keyword.'%');
                                                                     }
                                                            })->with('patient_user_details')
                                                              ->where('doctor_user_id', $this->user_id)
                                                              ->groupby('patient_user_id')
                                                              ->paginate(10);                                                             
      }
      else if($request->patient_type == 'myown' )
      {
          $patient_name = $this->PatientModel->orderBy('id','desc')
                                             ->whereHas('userinfo', function($user_details) use($patient_keyword) {
                                                  if(!empty($patient_keyword))
                                                    { 
                                                      $user_details->where('first_name','like','%'.$patient_keyword.'%');
                                                      $user_details->orWhere('last_name','like','%'.$patient_keyword.'%');
                                                     }
                                           })->with('userinfo')
                                             ->where('created_by', $this->user_id)
                                             ->paginate(10); 
        
      }

      
      if($patient_name)
      {
        $patient_arr = $patient_name->toArray();
        $patient_arr =$patient_arr['data'];
        $arr_json['status'] = 'success';
        $arr_json['data']   = $patient_arr;
      }
      else
      {
        $arr_json['status'] = 'error';        
      }
      return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                                  SEARCH PATIENT
    ----------------------------------------------------------------------------*/

     public function search_patient(Request $request)
     {
      if(!empty($request->sort_by))
      {
        $sort_by=$request->sort_by;
      }
      else
      {
        $sort_by="";
      }

        if($request->patient_type == 'doctoroo')
        {
            $obj_patient = "";
            $obj_patient = $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                                 ->with(['patient_info','patient_user_details'])
                                                                 ->groupby('patient_user_id')
                                                                 ->orderBy('id',$sort_by);

            if($request->doctor_name!="")
            {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $patient_name = $request->doctor_name;
              if(strstr($patient_name, ' '))
              {
                list($fname,$lname) = explode(' ', $patient_name);
                if(isset($fname) && isset($lname))
                {
                  $obj_patient = $obj_patient->whereHas('patient_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                }
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_patient = $obj_patient->whereHas('patient_user_details', function($user_details) use($patient_name) {
                                                                        if(!empty($patient_name))
                                                                          { 
                                                                            $user_details->where('first_name',$patient_name);
                                                                           }
                                                                        });
              }        
            }

            if($request->gender!="")
            {
              $gender = $request->gender;
              $this->arr_view_data['gender']  = $gender;
              if($gender=='Male'){ $gen='M'; }else { $gen='F'; }      
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($gen) {
                                                                        if(!empty($gen))
                                                                          { 
                                                                            $user_details->where('gender',$gen);
                                                                           }
                                                                        });
            }

            if($request->selected_date!="")
            {
              $this->arr_view_data['dob']  = $request->selected_date;
              $date1 = strtr($request->selected_date, '/', '-');
              $dob=date('Y-m-d', strtotime($date1)); 
                    
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($dob) {
                                                                          if(!empty($dob))
                                                                            { 
                                                                              $user_details->where('date_of_birth',$dob);
                                                                             }
                                                                          });
            }

            if($request->entitlement_id!="")
            {
              $this->arr_view_data['entitlement_id']  = $request->entitlement_id;
              $entitlement_id = $request->entitlement_id;
                              
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($entitlement_id) {
                                                                          if(!empty($entitlement_id))
                                                                            { 
                                                                              $user_details->where('card_no',$entitlement_id);
                                                                             }
                                                                         });
            }

            $obj_patient = $obj_patient->paginate(10);

            if($obj_patient)
            {
              $this->arr_view_data['paginate']                   = clone $obj_patient;
              $this->arr_view_data['patients_arr']               = $obj_patient->toArray();     
            } 
              
            $this->arr_view_data['module_url_path']             = $this->module_url_path;
            $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
            $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;

            return view($this->module_view_folder.'.patient_search')->with($this->arr_view_data);
        }
        else if($request->patient_type == "myown")
        {
          $obj_patient = "";
            $obj_patient = $this->PatientModel->where('created_by',$this->user_id)
                                                                 ->with('userinfo')
                                                                 //->groupby('patient_user_id')
                                                                 ->orderBy('id',$sort_by);

        if($request->doctor_name!="")
            {
              $this->arr_view_data['doctor_name']  = $request->doctor_name;
              $patient_name = $request->doctor_name;
              if(strstr($patient_name, ' '))
              {
                list($fname,$lname) = explode(' ', $patient_name);
                if(isset($fname) && isset($lname))
                {
                  $obj_patient = $obj_patient->whereHas('userinfo', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                }
              }
              else
              { 
                $this->arr_view_data['doctor_name']  = $request->doctor_name;
                $obj_patient = $obj_patient->whereHas('userinfo', function($user_details) use($patient_name) {
                                                                        if(!empty($patient_name))
                                                                          { 
                                                                            $user_details->where('first_name',$patient_name);
                                                                           }
                                                                        });
              }        
            }
            if($request->gender!="")
            {
              $gender = $request->gender;

              $this->arr_view_data['gender']  = $gender;

              if($gender=='Male'){ $gen='M'; }else { $gen='F'; }      
              $obj_patient = $obj_patient->where('gender',$gen);
                                                                            
            }

            if($request->selected_date!="")
            {
              $this->arr_view_data['dob']  = $request->selected_date;
              $date1 = strtr($request->selected_date, '/', '-');
              $dob=date('Y-m-d', strtotime($date1)); 
                    
              $obj_patient = $obj_patient->where('date_of_birth',$dob);
            }

            if($request->entitlement_id!="")
            {
              $this->arr_view_data['entitlement_id']  = $request->entitlement_id;
              $entitlement_id = $request->entitlement_id;
                              
              $obj_patient = $obj_patient->where('card_no',$entitlement_id);
            }

            $obj_patient = $obj_patient->paginate(10);

            if($obj_patient)
            {
              $this->arr_view_data['paginate']                   = clone $obj_patient;
              $this->arr_view_data['patients_arr']               = $obj_patient->toArray();     
            } 
              
            $this->arr_view_data['module_url_path']             = $this->module_url_path;
            $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
            $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;

            return view($this->module_view_folder.'.mypatient_search')->with($this->arr_view_data);
                                                                                                                      
        }
      

      
      
    }


    /*
    | Function  : Get all the personal details, Family doctor, pharmacies, previously consultation doctoroo doctors, family members of 
    |             the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 11/08/2017
    | Output    : Show all the personal details, Family doctor, pharmacies, previously consultation doctoroo doctors, family members of 
    |             the selected patient
    */

    /*--------------------------------------------------------------------------
                                  MY PATIENT DETAILS(DOCTOROO & MYOWN)
    ----------------------------------------------------------------------------*/

    public function my_patients_details($enc_id)
    {
      $user_id = base64_decode($enc_id);
      $patient_details = $this->PatientModel->where('user_id',$user_id)
                                            ->orderBy('id','desc')
                                            ->with('userinfo')
                                            ->with(['memberfamily' => function($member){
                                                $member->where('member_status','link');
                                                $member->orderBy('id','desc');
                                            }])
                                            ->with(['familydoctor' => function($doctor){
                                                $doctor->where('status','link');
                                                /*$doctor->where('patient_action','accepted');*/
                                                $doctor->orderBy('id','desc');
                                            }])
                                            ->with(['regularfamilydoctor' => function($regular_doctor) use($user_id){
                                                $regular_doctor->where('patient_id',$user_id);
                                            }])
                                            ->get();

      if($patient_details)
      {
        $this->arr_view_data['patient_details']   = $patient_details->toArray();
      }

      if(isset($this->arr_view_data['patient_details'][0]['regularfamilydoctor']))
      {
        $doctor_id=array();
        foreach($this->arr_view_data['patient_details'][0]['regularfamilydoctor'] as $val)
        {
          if($val['regular'] == 'yes')
          {
            array_push($doctor_id,$val['doctor_id']);
          }
        }
         
        if($doctor_id)
        {
          $regular_doctor_arr = $this->UserModel->whereIn('id',$doctor_id)->get();
          $this->arr_view_data['regular_doctor_arr'] = $regular_doctor_arr->toArray();
        } 
      }

      $get_pharmacy_list = $this->MyPharmacyModel->where('patient_id', $user_id)
                                                 ->orderBy('id','desc')
                                                 /*->with(['pharmacy_user_details' => function($user) {
                                                        $user->where('user_status', 'Active');
                                                        $user->where('verification_status', '1');
                                                        $user->where('deleted_at', null);
                                                 }])
                                                 ->with('pharmacy_details')*/
                                                 ->with('pharmacy_list')
                                                 ->get();
      if($get_pharmacy_list)
      {
        $this->arr_view_data['pharmacy_data'] = $get_pharmacy_list->toArray();
      }

      $previous_seen_dr= $this->PatientConsultationBookingModel->where('patient_user_id',$user_id)
                                                               ->orderBy('id','desc')
                                                               ->groupby('doctor_user_id')
                                                               ->with('doctor_user_details')->get();

      if($previous_seen_dr)
      {
        $this->arr_view_data['previous_seen_dr'] = $previous_seen_dr->toArray();
      }

      $entitlement_arr=$this->entitlement_model->get()->toArray();

      $regular_doctor= $this->PatientsRegularDoctorModel->where([
                                                                  ['patient_id',$user_id],
                                                                  ['doctor_id',$this->user_id]])
                                                        ->select('regular')
                                                        ->first();
      if($regular_doctor)
      {
        $this->arr_view_data['regular_doctor_status']     = $regular_doctor->regular;        
      }

      $affected_area_img = $this->ProfileAffectedAreaModel->where('patient_id' , $user_id)
                                                            ->get();
      if($affected_area_img)
      {
        $this->arr_view_data['affected_area_img_arr'] = $affected_area_img->toArray();      
      }   

      $entitle_arr = $this->UserEntitlementModel->where('user_id' , $user_id)
                                                   ->with('user_entitlement')
                                                ->get();

      if($entitle_arr)
      {
        $this->arr_view_data['user_entitlement_arr'] = $entitle_arr->toArray();
      }                                                       

      $this->arr_view_data['patient_uploads_url']         = $this->patient_uploads_public_url;
      $this->arr_view_data['patient_uploads_base_url']    = $this->patient_uploads_base_url;
      $this->arr_view_data['entitlement']                 = $entitlement_arr;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;

      return view($this->module_view_folder.'.my_patients_details')->with($this->arr_view_data);
    } 

    /*--------------------------------------------------------------------------
                                  FAMILY MEMBER - ADD
    ----------------------------------------------------------------------------*/

    public function family_members_add(Request $request)
    {
        $obj = new FamilyMemberModel;

        $obj->user_id       = base64_decode($request->enc_patient_id);
        $obj->relationship  = $request->user_relation;
        $obj->first_name    = ucfirst(strtolower($request->firstname));
        $obj->last_name     = ucfirst(strtolower($request->lastname));
        $obj->gender        = $request->gender;
        $obj->email         = $request->email;
        $obj->mobile_number = $request->contact_no;
        $obj->date_of_birth = $request->datebirth;
        $obj->member_status = 'link';

        $obj->save();
        if($obj)
        {
          $msg    = "Family Member Added Successfully";
          $status = 'success';
        }
        else
        {
          $msg    = "Something went to wrong";
          $status = 'error';
        }

        $data = array('status'=>$status,'msg'=>$msg);

        return response()->json($data);
    }

    /*--------------------------------------------------------------------------
                                  FAMILY MEMBER - EDIT
    ----------------------------------------------------------------------------*/

    public function family_members_edit(Request $request)
    {
        $data=[
                'first_name'    => ucfirst(strtolower($request->firstname)),
                'last_name'     => ucfirst(strtolower($request->lastname)),
                'relationship'  => $request->user_relation,
                'email'         => $request->member_email,
                'mobile_number' => $request->contact_no,
                'date_of_birth' => $request->datebirth,
                'gender'        => $request->gender
              ];

        $res = $this->FamilyMemberModel->where('id',$request->member_id)->update($data);
        if($res)
        {
          $msg    = "Family Member Updated Successfully";
          $status = 'success';
        }
        else
        {
          $msg    = "Something went to wrong";
          $status = 'error';
        }

        $data = array('status'=>$status,'msg'=>$msg);

        return response()->json($data);
    }

    /*--------------------------------------------------------------------------
                                  FAMILY MEMBER - DELETE
    ----------------------------------------------------------------------------*/

    public function family_members_delete(Request $request)
    { 
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

       if(!empty($request->member_id))
       {
          
          $count = $this->PatientConsultationBookingModel->where('family_member_id',$request->member_id)
                                                          ->where('consultation_datetime', '>=', $current_datetime)
                                                          ->where(function ($query) {
                                                                $query->where('booking_status', 'Pending')
                                                                      ->orWhere('booking_status', 'Confirmed');
                                                            })
                                                         ->count();
                                                                    
          if($count > 0 )
          {
              $msg = "You can't delete this member, consultation has been booked for this member. You may delete this member after consultation or cancel consultation and delete";
              $status = 'error';
               $data = array('status'=>$status,'msg'=>$msg);
          } 
          else
          {
              $patient_uploads_url = $this->patient_uploads_public_url;

              $data = $this->PatientConsultationImagesModel->where('family_member_id' ,$request->member_id)
                                                  ->get();

              if(isset($data) && !empty($data))
              {
                $data_arr = $data->toArray();
                foreach($data_arr as $val )
                {
                  if(isset($val['health_image']) && !empty($val['health_image']) && File::exists($patient_uploads_url.$val['health_image']))
                  {
                    @unlink($patient_uploads_url.$val['health_image']);
                  }
                }
              }

              $this->PatientConsultationImagesModel->where('family_member_id' ,$request->member_id)
                                                   ->delete();
                                                   
              $this->PatientConsultationBookingModel->where('family_member_id' ,$request->member_id)
                                                    ->delete();

              $delete = $this->FamilyMemberModel->destroy($request->member_id);

              if($delete)
              {
                $msg    = "Family Member Deleted Successfully";
                $status = 'success';
                $data = array('status'=>$status,'msg'=>$msg);
                return response()->json($data);
              }
              else
              {
                $msg    = "Something went to wrong";
                $status = 'error';
                $data = array('status'=>$status,'msg'=>$msg);
                
              }
          }
          return response()->json($data);                                               
       }
    }


    /*
    | Function  : Get all the medical history of the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 14/08/2017
    | Output    : Show all the medical history of the selected patient
    */

    public function my_patients_medical_history($enc_id)
    {
      $general_arr_data = $this->arr_view_data['lifestyle_arr_data'] = [];
      $get_general_data = '';

      $user_id = base64_decode($enc_id);

      $get_general_data = $this->HealthGeneralModel->where('user_id',$user_id)->first();
      if($get_general_data)
      {
        $general_arr_data = $get_general_data->toArray();

        $get_dynamic_general = $this->DynamicHealthGeneralModel->where('general_id', $general_arr_data['id'])->get();
        if($get_dynamic_general)
        {
          $this->arr_view_data['dynamic_general_data'] = $get_dynamic_general->toArray();
        }
      }

      $get_lifestyle_data = $this->LifeStylelModel->where('user_id',$user_id)->first();
      if($get_lifestyle_data)
      {
        $this->arr_view_data['lifestyle_arr_data'] = $get_lifestyle_data->toArray();
      }

      $get_medication_data = $this->MedicationModel->where('user_id',$user_id)->get();
      if($get_medication_data)
      {
        $this->arr_view_data['medication_arr_data'] = $get_medication_data->toArray();
      }

      $get_medical_updates = $this->MedicalHistoryUpdatesModel->with('user_info')
                                                              ->where('patient_id',$user_id)
                                                              ->orderBy('id','desc')
                                                              ->first();
      if($get_medical_updates)
      {
        $this->arr_view_data['medical_updates_arr'] = $get_medical_updates->toArray();
      }

      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['general_arr_data']            = $general_arr_data;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;

      $get_patient_data = \DB::table('users')->where('id', $user_id)->first();
      $this->arr_view_data['user_details']  = $get_patient_data;

      return view($this->module_view_folder.'.my_patients_medical_history')->with($this->arr_view_data);
    } // end my_patients_medical_history


    /*--------------------------------------------------------------------------
                  SHOW CONSULTATION HISTORY OF THE SELECTED PATIENT
    ----------------------------------------------------------------------------*/

    public function my_patients_consultation_history($enc_id)
    {
      $user_id = base64_decode($enc_id);

      $current_datetime = date('Y-m-d H:i:s');
      $current_date     = date('Y-m-d');
      $current_time     = date('H:i:s');
      $new_booking = $this->PatientConsultationBookingModel->with('patient_user_details','doctor_user_details')
                                                           ->where('patient_user_id', $user_id)
                                                           ->where('booking_status','Pending')
                                                           ->orderBy('id','DESC')
                                                           /*->where('consultation_datetime', '>', $current_datetime)*/
                                                           ->get();
      if($new_booking)
      {
        $this->arr_view_data['new_booking']   = $new_booking->toArray();
      } 
      $upcoming_consultation = $this->PatientConsultationBookingModel
                                    ->where([
                                           /*['consultation_datetime','>',$current_datetime],*/
                                           ['booking_status','Confirmed'],
                                           ['patient_user_id',$user_id]
                                          ])
                                  ->with('patient_user_details','doctor_user_details')
                                  ->orderBy('id','DESC')
                                  ->get();
      if($upcoming_consultation)
      {
        $this->arr_view_data['upcoming_consultation_arr']     = $upcoming_consultation->toArray();
      }
      
      $past_consultation = $this->PatientConsultationBookingModel
                                ->where('patient_user_id',$user_id)
                                //->where([
                                       //['consultation_datetime','<',$current_datetime]
                                      //])
                                ->where(function($query) use($current_datetime){
                                      $query->where('booking_status','Completed');
                                      /*$query->orWhere('booking_status','Confirmed');*/
                                 })
                                ->orderBy('id','DESC')
                                ->with('patient_user_details','doctor_user_details')
                                ->get();
      if($past_consultation)
      {
        $this->arr_view_data['past_consultation_arr'] =$past_consultation->toArray();
      }
       
     $this->arr_view_data['show_records']                = '5';
     $this->arr_view_data['enc_patient_id']              = $enc_id;
     $this->arr_view_data['doctor_id']                   = $this->user_id;
     $this->arr_view_data['current_doctor_id']           = $this->user_id;
     $this->arr_view_data['module_url_path']             = $this->module_url_path;

     return view($this->module_view_folder.'.my_patients_consultation_history')->with($this->arr_view_data);
    } 

    /*--------------------------------------------------------------------------
        SHOW ALL CONSULTATION HISTORY OF THE SELECTED PATIENT(ALL RECORDS)
    ----------------------------------------------------------------------------*/

    public function my_patients_consultation_history_all_records($type,$enc_id)
    {
      $user_id = base64_decode($enc_id);

      $current_datetime = date('Y-m-d H:i:s');
      $current_date     = date('Y-m-d');
      $current_time     = date('H:i:s');

      if($type == 'new')
      {
        $new_booking = $this->PatientConsultationBookingModel->with('patient_user_details','doctor_user_details')
                                                             ->where('patient_user_id', $user_id)
                                                             ->where('booking_status','Pending')
                                                             ->orderBy('id','DESC')
                                                             /*->where('consultation_datetime', '>', $current_datetime)*/
                                                             ->paginate(10);
        if($new_booking)
        {
            $this->arr_view_data['paginate']      = clone $new_booking;
            $this->arr_view_data['new_booking']   = $new_booking->toArray();
        }
      }
      else if($type == 'upcoming')
      {
        $upcoming_consultation = $this->PatientConsultationBookingModel
                              ->where([
                                     /*['consultation_datetime','>',$current_datetime],*/
                                     ['booking_status','Confirmed'],
                                     ['patient_user_id',$user_id]
                                    ])
                              ->with('patient_user_details','doctor_user_details')
                              ->orderBy('id','DESC')
                              ->paginate(10);
      
        if($upcoming_consultation)
        {
          $this->arr_view_data['paginate']                      = clone $upcoming_consultation;
          $this->arr_view_data['upcoming_consultation_arr']     = $upcoming_consultation->toArray();
        }
      }
      else if($type == 'past')
      {
        $past_consultation = $this->PatientConsultationBookingModel
                                    ->where('patient_user_id',$user_id)
                                    /*->where([
                                       ['consultation_datetime','<',$current_datetime]
                                      ])*/
                                    ->where(function($query) use($current_datetime){
                                          $query->orWhere('booking_status','Completed');
                                          /*$query->orWhere('booking_status','Confirmed');*/
                                     })
                                    ->with('patient_user_details','doctor_user_details')
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
        if($past_consultation)
        {
         $this->arr_view_data['paginate']                 = clone $past_consultation;
         $this->arr_view_data['past_consultation_arr']    = $past_consultation->toArray();
        }
      }
      else
      {
        $this->arr_view_data['paginate']                  = '';
      }
    
      $this->arr_view_data['doctor_id']                   = $this->user_id;
      $this->arr_view_data['type']                        = $type;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['current_doctor_id']           = $this->user_id;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;

      return view($this->module_view_folder.'.my_patients_consultation_history_all_records')->with($this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                  NEW CONSULTATION REQUEST DETAILS
    ----------------------------------------------------------------------------*/

    public function new_consultation_request_details($enc_patient_id,$enc_id)
    {
        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

        $arr_family_member = $arr_booking_data = [];

        $get_booking = $this->PatientConsultationBookingModel->with('patient_user_details','doctor_user_details')
                                                             ->where('booking_status','Pending')
                                                             /*->where('consultation_datetime', '>', $current_datetime)*/
                                                             ->where('id',base64_decode($enc_id))
                                                             ->first();
        if($get_booking)
        {
            $arr_booking_data = $get_booking->toArray();
        }
        
        if(isset($arr_booking_data['family_member_id']) && $arr_booking_data['family_member_id'] != 0)
        {
            $get_family_data = $this->FamilyMemberModel
                                    ->where('id', $arr_booking_data['family_member_id'])
                                    ->first();

            if($get_family_data)
            {
                $arr_family_member = $get_family_data->toArray();
            }
        }


        $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
        if(isset($health_images))
        {
           $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
        } 

        $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url; 
        $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url;
        $this->arr_view_data['enc_patient_id']    = $enc_patient_id;
        $this->arr_view_data['doctor_id']         = $this->user_id;
        $this->arr_view_data['current_user_id']   = $this->user_id;
        $this->arr_view_data['arr_family_member'] = $arr_family_member;
        $this->arr_view_data['arr_booking']       = $arr_booking_data;
        $this->arr_view_data['profile_img_path']  = $this->profile_img_public_path;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;

        return view($this->module_view_folder.'.new_consultation_request_details')->with($this->arr_view_data);
    } 

    /*--------------------------------------------------------------------------
                  UPCOMING CONSULTATION DETAILS
    ----------------------------------------------------------------------------*/

    public function upcoming_consultation_details($enc_patient_id,$enc_id)
    {
      $upcoming_consultation = $this->PatientConsultationBookingModel
                                      ->where([['id', base64_decode($enc_id)],['booking_status','Confirmed']])
                                      ->with('patient_user_details','doctor_user_details','consultation_documents','consultation_notes','invoice_info')
                                      ->first();

      if($upcoming_consultation)
      {
       $this->arr_view_data['upcoming_consultation_arr']   = $upcoming_consultation->toArray();
      }

      $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
      if(isset($health_images))
      {
         $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
      } 

      $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url; 
      $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url; 
      $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
      $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;      
      $this->arr_view_data['enc_patient_id']    = $enc_patient_id;
      $this->arr_view_data['doctor_id']         = $this->user_id;
      $this->arr_view_data['current_user_id']   = $this->user_id;
      $this->arr_view_data['module_url_path']   = $this->module_url_path;

      return view($this->module_view_folder.'.upcoming_consultation_details')->with($this->arr_view_data);
    } 

    /*--------------------------------------------------------------------------
                        PAST CONSULTATION DETAILS
    ----------------------------------------------------------------------------*/
    
    public function past_consultation_details($enc_patient_id,$enc_id)
    {
       $current_datetime = date( "Y-m-d H:i:s");

       $past_consultation = $this->PatientConsultationBookingModel
                                 ->where('id', base64_decode($enc_id))
                                 /*->where([
                                       ['consultation_datetime','<',$current_datetime]
                                      ])*/
                                ->where(function($query) use($current_datetime){
                                      $query->where('booking_status','Completed');
                                      /*$query->orWhere('booking_status','Confirmed');*/
                                 })
                                 ->with('patient_user_details','doctor_user_details','consultation_documents','consultation_notes','invoice_info')
                                 ->first();

       if($past_consultation)
       {
        $this->arr_view_data['past_consultation_arr']   = $past_consultation->toArray();
       }  

       $health_images =$this->PatientConsultationImagesModel->where('booking_id',base64_decode($enc_id))
                                                             ->get();
       if(isset($health_images))
       {
         $this->arr_view_data['health_images_arr']  =   $health_images->toArray();
       }

       $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
       $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;
       $this->arr_view_data['patient_uploads_public_url'] = $this->patient_uploads_public_url; 
       $this->arr_view_data['patient_uploads_base_url']   = $this->patient_uploads_base_url;  
       $this->arr_view_data['enc_patient_id']    = $enc_patient_id;
       $this->arr_view_data['doctor_id']         = $this->user_id;
       $this->arr_view_data['current_user_id']   = $this->user_id;
       $this->arr_view_data['module_url_path']   = $this->module_url_path;
       return view($this->module_view_folder.'.past_consultation_details')->with($this->arr_view_data);

   }


    /*--------------------------------------------------------------------------
                       MY PATIENT - CONSULTATION GUIDE
    ----------------------------------------------------------------------------*/

    public function my_patients_consultation_guide($enc_id)
    {
      $user_id = base64_decode($enc_id);

      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      return view($this->module_view_folder.'.my_patients_consultation_guide')->with($this->arr_view_data);
    } 

    /*--------------------------------------------------------------------------
                                  FAMILY DOCTOR ADD PAGE
    ---------------------------------------------------------------------------*/

    public function family_doctors_add($enc_patient_id)
    {
      $get_user = $this->UserModel->where('id', base64_decode($enc_patient_id))->first();
      if($get_user)
      {
        $this->arr_view_data['user_data'] = $get_user->toArray();
      }

      $this->arr_view_data['enc_patient_id']           = $enc_patient_id;
      $this->arr_view_data['profile_img_public_path']  = $this->profile_img_public_path;
      $this->arr_view_data['page_title']               = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']          = $this->module_url_path;
      $this->arr_view_data['multipleArray']            = array($this->arr_view_data);

      return view($this->module_view_folder.'.doctor_add')->with($this->arr_view_data);       
    }
    /*--------------------------------------------------------------------------
                                  FAMILY DOCTOR ADD DATA
    ---------------------------------------------------------------------------*/

    public function add_doctor(Request $request)
    {

      if($request->action=='check_mail')
      {
        $num    =   $this->FamilyDoctorsModel->where('email',$request->email)->count();
        if($num>0)
        {
          $arr_response['msg']='Email id already registered, Please try again with other email id.';
        }
        else
        {
          $arr_response['msg']='not_exist';
        }
        return response()->json($arr_response);
        exit();
      }
      else if($request->action=='search_dr')
      {
        $search_txt=$request->search_txt;

        $data_arr=DB::table('users')
                  ->join('role_users','users.id','=','role_users.user_id')
                  ->where([
                            ['role_users.role_id','2'],
                            ['users.first_name','LIKE','%'.$search_txt.'%']
                      ])->orderBy('users.first_name' , 'ASC')
                  ->take(10)
                  ->get();

        return response()->json(['response'=>$data_arr]);
        exit();
      }
      else if($request->action=='search_dr_by_lname')
      {
        $search_txt=$request->search_txt;

        $data_arr=DB::table('users')
                  ->join('role_users','users.id','=','role_users.user_id')
                  ->where([
                            ['role_users.role_id','2'],
                            ['users.last_name','LIKE','%'.$search_txt.'%']
                      ])->orderBy('users.last_name' , 'ASC')
                    ->get();                                

        return response()->json(['response'=>$data_arr]);
        exit();
      }
      else if($request->action=='select_doctor')
      {
        $res=DB::table('users')
        ->join('dod_doctor','users.id','=','dod_doctor.user_id')
        ->where('users.id',$request->user_id)->get();

        return response()->json(['response'=>$res]);
        exit();
      }

      $this->FamilyDoctorsModel->user_id              = base64_decode($request->enc_patient_id);
      $this->FamilyDoctorsModel->first_name           = ucfirst(strtolower($request->fname));
      $this->FamilyDoctorsModel->last_name            = ucfirst(strtolower($request->lname));
      $this->FamilyDoctorsModel->phone_no             = $request->phone_no;
      $this->FamilyDoctorsModel->mobile_no            = $request->mob_no;
      $this->FamilyDoctorsModel->email                = $request->dr_mail;
      $this->FamilyDoctorsModel->practice_name        = $request->pract_name;
      $this->FamilyDoctorsModel->practice_address     = $request->pract_addr;
      $this->FamilyDoctorsModel->consultation_details = $request->consultation;
      $this->FamilyDoctorsModel->status               = 'link';
      $this->FamilyDoctorsModel->patient_action       = 'pending';

      $status = $this->FamilyDoctorsModel->save();

      if($status && $request->mail_action=='send')
      {
          
        $this->module_path=url('');
        $link="<a class='btn_emailer_cls' href='".url('')."/doctor"."'>Accept Invitation</a>";

        $arr_built_content = [ 
                                'MEMBER'            =>  $request->fname.' '.$request->lname , /* REceiver name */ 
                                'APP_NAME'          =>  config('app.project.name'),
                                'SENDER'            =>  'SENDER NAME',                
                                'ACCEPT'            =>   $link
                              ];

        $arr_data['first_name']     =   $request->fname;
        $arr_data['last_name']     =   $request->lname;
        $arr_data['email']         =   $request->dr_mail;
                                  
        $arr_mail_data                      = [];
        $arr_mail_data['email_template_id'] = '42';
        $arr_mail_data['arr_built_content'] = $arr_built_content;
        $arr_mail_data['user']              = $arr_data;
        $mail_status  = $this->EmailService->send_mail($arr_mail_data);       
      }

      if($status)
      {
        $this->DoctorInvitationModel->user_id=base64_decode($request->enc_patient_id);
        $this->DoctorInvitationModel->first_name=$request->fname;
        $this->DoctorInvitationModel->last_name=$request->lname;
        $this->DoctorInvitationModel->phone=$request->mob_no;
        $this->DoctorInvitationModel->email=$request->dr_mail;
        $this->DoctorInvitationModel->practice_name=$request->pract_name;
        $this->DoctorInvitationModel->address=$request->pract_addr;
        $this->DoctorInvitationModel->save();

        $msg = "has added new family doctor. If not confirm then you can remove that doctor from your family doctor list";

        $this->NotificationModel->from_user_id  = $this->user_id;
        $this->NotificationModel->to_user_id    = base64_decode($request->enc_patient_id);
        $this->NotificationModel->message       = $msg;
        $res = $this->NotificationModel->save();

        $arr_response['status'] = 'success';
        $arr_response['msg']    = 'Family Doctor added successfully';
      }
      else
      {
        $arr_response['status'] = 'error';
        $arr_response['msg']    = 'Something went to wrong'; 
      } 
      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                  FAMILY MEMBER - EMAIL CHECK 
    ---------------------------------------------------------------------------*/

    public function check_member_mail(Request $request)
    {
        $num    =   $this->FamilyMemberModel->where('email',$request->email_id)->count();

        if($num>0)
        {
          $arr_response['status']='exist';
          $arr_response['msg']='Email id already registered, Please try again with other email id.';
        }
        else
        {
          $arr_response['status']='not_exist';
          $arr_response['msg']='';
        }

        return response()->json($arr_response); 
    }

     /*--------------------------------------------------------------------------
                                     UNLINK FAMILY MEMBER FORM
        -----------------------------------------------------------------------------*/
    public function family_members_unlink($patient_id,$member_id)
    {
      $members = $this->FamilyMemberModel->where([
            ['id', '=', base64_decode($member_id)]
      ])->with('userinfo')->get();

      if(!empty($members))
      {
        $member_array = $members->toArray();
      }

      $this->arr_view_data['enc_patient_id']              = $patient_id;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['member_data']                 = $member_array;
      $this->arr_view_data['multipleArray']               = $this->arr_view_data;

      return view($this->module_view_folder.'.family_member_unlink',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                     FAMILY MEMBER UNLINK - SEND MAIL
    ----------------------------------------------------------------------------*/

     public function family_members_unlink_mail(Request $request)
    {

        $current_datetime = date('Y-m-d H:i:s');
        $current_date     = date('Y-m-d');
        $current_time     = date('H:i:s');

       if(!empty($request->member_id))
       {
          
          $count = $this->PatientConsultationBookingModel->where('family_member_id',$request->member_id)
                                                          ->where('consultation_datetime', '>=', $current_datetime)
                                                          ->where(function ($query) {
                                                                $query->where('booking_status', 'Pending')
                                                                      ->orWhere('booking_status', 'Confirmed');
                                                            })
                                                         ->count();
                                                                    
          if($count > 0 )
          {
              $msg = "You can't unlink this member, consultation has been booked for this member. You may unlink this member after consultation or cancel consultation and unlink";
              

              $arr_response['status']='error';
              $arr_response['msg']= $msg;
          }
          else
          {
              $this->module_path=url('');
      
              $from_mail="";
              
              $res=$this->UserModel->where('id',$this->user_id)->first();

              if($res)
              {
                $user_arr=$res->toArray();
                $from_mail=$user_arr['email'];
              }
           
              $member=$this->FamilyMemberModel->where('id',$request->member_id)->first();
              if($member)
              {
                $member_arr=$member->toArray();
              }
              
              $this->arr_view_data['module_url_path']= $this->module_url_path;
              $this->arr_view_data['user_arr']=$user_arr;
              $this->arr_view_data['member_mail']=$request->email;
              $this->arr_view_data['member_arr']=$member_arr;

              $this->arr_view_data['multipleArray']=$this->arr_view_data;

              $arr_data['first_name']     =   "";
              $arr_data['last_name']      =   "";
              $arr_data['email']          =   $request->email;
              $arr_data['password']       =   "";
              $arr_data['user_status']    =   'Active';

              $sender_fname="";
              $sender_lname="";

              if(!empty($user_arr['first_name']))
              {
                $sender_fname=$user_arr['first_name'];
              }

              if(!empty($user_arr['last_name']))
              {
                $sender_lname=$user_arr['last_name'];
              }

              $unlink_link="<a class='btn_emailer_cls' href='".$this->module_path."/member_unlink_confirmation/".base64_encode($member_arr['id'])."/".base64_encode($request->email)."'>Unlink Account</a>";

              $arr_built_content = [ 
                                      'MEMBER'=>  $member_arr['first_name'].' '.$member_arr['last_name'] , 
                                      'APP_NAME'  =>config('app.project.name'),
                                      'SENDER'    =>$sender_fname.' '.$sender_lname,
                                      'ACTIVATION_LINK'=>'my_link',
                                      'UNLINK'    =>$unlink_link
                                   ];

              $arr_mail_data                      = [];
              $arr_mail_data['email_template_id'] = '40';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $arr_data;
              $mail_status  = $this->EmailService->send_mail($arr_mail_data);

              if($mail_status)
              {
                  $arr_response['status']='success';
                  $arr_response['msg']='Successfully Sent!';
              }
              else
              {
                $arr_response['status']='error';
                $arr_response['msg']='Something went to wrong !';
              }
          }
      }


      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                     ADD PHARMACY - PAGE
    ----------------------------------------------------------------------------*/

    public function add_pharmacy($enc_patient_id)
    {
      /*$get_pharmacy_list = $this->PharmacyModel->whereHas('userinfo' , function($user) {
                                                        $user->where('user_status', 'Active');
                                                        $user->where('verification_status', '1');
                                                        $user->where('deleted_at', null);
                                                })
                                                ->with('userinfo')
                                                ->paginate(10);*/

      $get_pharmacy_list = $this->PharmacyListModel->orderBy('company_name', 'ASC')->paginate(5);

      if($get_pharmacy_list)
      {
        $paginate = clone $get_pharmacy_list;
        $pharmacy_data = $get_pharmacy_list->toArray();

        $this->arr_view_data['pharmacy_data'] = $pharmacy_data;
        $this->arr_view_data['paginate']      = $paginate;
      }

      $this->arr_view_data['enc_patient_id']           = $enc_patient_id;
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      return view($this->module_view_folder.'.add_pharmacy',$this->arr_view_data);
    }

    /*--------------------------------------------------------------------------
                                     PHARMACY - SEARCH
    ----------------------------------------------------------------------------*/

     public function search_pharmacy($enc_patient_id, Request $request)
    {
        $suburb       = $request->input('suburb');

        $route        = $request->input('route');
        $locality     = $request->input('locality');
        $area         = $request->input('administrative_area_level_1');
        $postal_code  = $request->input('postal_code');
        $country      = $request->input('country');

        if(is_numeric($suburb))
        {
            $get_phramacy_data = $this->PharmacyListModel->orderBy('company_name', 'ASC')
                                                         ->where('code','like','%'.$suburb.'%')
                                                         ->paginate(5);
        }
        else
        {
            $get_phramacy_data = $this->PharmacyListModel->orderBy('company_name', 'ASC')
                                                         ->where('street','like','%'.$route.'%');
                                                         if($locality != '')
                                                         {
                                                          $get_phramacy_data->orWhere('suburb','like','%'.$locality.'%');
                                                         }
                                                         if($area != '')
                                                         {
                                                          $get_phramacy_data->orWhere('state','like','%'.$area.'%');
                                                         }
                                                         if($postal_code != '')
                                                         {
                                                          $get_phramacy_data->orWhere('code','like','%'.$postal_code.'%');
                                                         }
                                                         if($country != '')
                                                         {
                                                          $get_phramacy_data->orWhere('country','like','%'.$country.'%');
                                                         }
                                                         $get_phramacy_data = $get_phramacy_data->paginate(5);
        }

        $queries = \DB::getQueryLog();
        //dd($queries);

        if($get_phramacy_data)
        {
          $this->arr_view_data['paginate']      = clone $get_phramacy_data;
          $this->arr_view_data['pharmacy_data'] = $get_phramacy_data->toArray();
        }

        $this->arr_view_data['enc_patient_id']      = $enc_patient_id;
        $this->arr_view_data['search_keyword']      = $suburb;
        $this->arr_view_data['page_title']          = "Pharmacies";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
        return view($this->module_view_folder.'.search_pharmacy',$this->arr_view_data);      
    }

    /*--------------------------------------------------------------------------
                                     PHARMACY - STORE
    ----------------------------------------------------------------------------*/
    public function add_pharmacy_data(Request $request)
    {
       $num = $this->MyPharmacyModel->where([
                                                  ['patient_id','=',base64_decode($request->enc_patient_id)],
                                                  ['pharmacy_id','=',$request->pharmacy_id]
                                                  ]
                                                )
                                                  ->count();

       if($num==0)
       {
        $this->MyPharmacyModel->patient_id=base64_decode($request->enc_patient_id);
        $this->MyPharmacyModel->pharmacy_id=$request->pharmacy_id;

        $res=$this->MyPharmacyModel->save();

        if($res)
        {
          $arr_response['msg']='Pharmacy Added successfully';
        }
        else
        {
         $arr_response['msg']='Something went to wrong, Please try again'; 
        }
       }
       else
       {
        $arr_response['msg']='This Pharmacy is already added';
       }

       return response()->json($arr_response);           
    }

    /*--------------------------------------------------------------------------
                                  MY PHARMACY - DELETE
    ----------------------------------------------------------------------------*/

    public function delete_my_pharmacy(Request $request)
    {
      $my_pharmacy_id = base64_decode($request->pharmacy_id);

      $del_pharmacy = $this->MyPharmacyModel->where('id', $my_pharmacy_id)->delete();

      if($del_pharmacy)
      {
        $msg    = "Pharmacy Deleted Successfully";
        $status = 'success';
        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
      }
      else
      {
        $msg    = "Problem Occured While Deleting Pharmacy";
        $status = 'error';
        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
      }
    }


    /*
    | Function  : get the data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 14/08/2017
    | Output    : show to status and reload the page to show new entry in ajax
    */

    public function medical_condition_add(Request $request)
    {
      $data['patient_id']   = base64_decode($request->input('enc_patient_id'));
      $data['doctor_id']    = $this->user_id;
      $data['general_id']   = $request->input('medical_general_id');
      $data['title']        = $request->input('title');
      $data['description']  = $request->input('description');

      $update['patient_id'] = $data['patient_id'];
      $update['updated_by'] = $this->user_id;

      $insert_data      = $this->DynamicHealthGeneralModel->create($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($insert_data)
      {
        $msg    = "Successfully added to Patient's Medical History";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }

      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    } // end medical_condition_add

    /*--------------------------------------------------------------------------
                                  EDIT PATIENT INFORMATION
    ----------------------------------------------------------------------------*/

    public function edit_patient(Request $request)
    {
      $res = $this->UserModel->where('id',base64_decode($request->enc_patient_id))
                             ->update(['first_name' => $request->fname , 'last_name' => $request->lname]);
      
      $date1 = strtr($request->dob, '/', '-');
      $date=date('Y-m-d', strtotime($date1));
    
      $patient_info = array(
          'date_of_birth'  => $date,
          'mobile_no'      => encrypt_value($request->mobile_no),
          'gender'         => $request->gender, 
          'phone_no'       => $request->enc_phone_no,  
          'suburb'         => $request->enc_address,
          'card_no'        => $request->card_no, 
          'entitlement_id' => $request->entitlement 
        ); 

      $num = $this->PatientsRegularDoctorModel->where([
                                                        ['patient_id',base64_decode($request->enc_patient_id)],
                                                        ['doctor_id',$this->user_id]])
                                                ->count();
      if($num>0)
      {
        $this->PatientsRegularDoctorModel->where([
                                                      ['patient_id',base64_decode($request->enc_patient_id)],
                                                      ['doctor_id',$this->user_id]])
                                         ->update(['regular' => $request->regular_doctor]);
      }
      else
      {
        $this->PatientsRegularDoctorModel->patient_id = base64_decode($request->enc_patient_id);
        $this->PatientsRegularDoctorModel->doctor_id  = $this->user_id;
        $this->PatientsRegularDoctorModel->save();
      }

      $patient_res = $this->PatientModel->where('user_id',base64_decode($request->enc_patient_id))
                                        ->update($patient_info);                     
      if($res && $patient_res)
      {
          $arr_response['msg'] = "Patient Details updated successfully";
      } 
      else
      {
        $arr_response['msg'] = "Something went to wrong";
      }      

      return response()->json($arr_response);           
    }

    public function add_patient()
    {
      $last_record = $this->UserModel->latest()->select('id')->first();

      $doctor_record = $this->UserModel->select('email')->where('id',$this->user_id)->first();

      if($doctor_record)
      {
        $doctor_email = $doctor_record->email;
      }
      if($last_record)
      {
        $last_id = $last_record->id;
        $last_id += 1;
      }

      if(isset($doctor_email) && isset($last_id))
      {
        $email = $doctor_email.$last_id;

        $this->arr_view_data['doctor_email'] = $email; 
      }

      $entitlement_arr=$this->entitlement_model->get()->toArray();
      $doctor_arr = $this->UserModel->where('id',$this->user_id)->first();
      if(isset($doctor_arr) && !empty($doctor_arr))
      {
        $this->arr_view_data['doctor_arr']                =$doctor_arr->toArray();  
      }
      //dd($this->arr_view_data['doctor_arr']);
      $this->arr_view_data['entitlement']                 = $entitlement_arr;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      return view($this->module_view_folder.'.add_patient')->with($this->arr_view_data);
    }


    /*
    | Function  : Get all the data and store it.
    | Author    : Deepak Arvind Salunke
    | Date      : 16/08/2017
    | Output    : show to status and reload the page to show new entry in ajax
    */

    public function update_lifestyle(Request $request)
    {
      $doctor_id                    = $this->user_id;
      $general_id                   = $request->input('medical_general_id');
      $lifestyle_id                 = $request->input('lifestyle_id');

      $data['user_id']              = base64_decode($request->input('enc_patient_id'));
      $data['physical_activity']    = $request->input('physical_activities');
      $data['food_habit']           = $request->input('food_habits');
      $data['smoking']              = $request->input('smoking');
      $data['alcohol']              = $request->input('alcohol');
      $data['stress_level']         = $request->input('stress_levels');
      $data['average_sleep']        = $request->input('average_sleep');
      $data['other_lifestyle']      = $request->input('other');

      $update['patient_id']         = $data['user_id'];
      $update['updated_by']         = $this->user_id;

      if(isset($lifestyle_id) && !empty($lifestyle_id))
      {
        $update_data = $this->LifeStylelModel->where('id',$lifestyle_id)->update($data);
        $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
        
          $msg    = "Medical history saved successfully";
          $status = "success";
        
        
      }
      else
      {
        $create_data = $this->LifeStylelModel->create($data);
        if($create_data)
        {
          $msg    = "Successfully created to Patient's Medical History";
          $status = "success";
        }
        else
        {
          $msg    = "Error! Something went wrong while ";
          $status = "error";
        }
      }

      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    } // end update_lifestyle

    /*--------------------------------------------------------------------------
                                  ADD NEW PATIENT
    ----------------------------------------------------------------------------*/

    public function store_patient(Request $request)
    {
      /* Encryption Card Id */
      $cardId = Session::get('cardId');
      if($cardId == '')
      {
          Flash::error('Something went wrong. Please try again.');
          return redirect()->back();
      }

      // create Virgil api
      $virgilApi = $this->VirgilService->clientToken();
      $userCards = $virgilApi->Cards->get($cardId);


      $last_record = $this->UserModel->latest()->select('id')->first();

      $doctor_record = $this->UserModel->select('email')->where('id',$this->user_id)->first();

      if($doctor_record)
      {
        $doctor_email = $doctor_record->email;
      }
      if($last_record)
      {
        $last_id = $last_record->id;
        $last_id += 1;
      }

      if(isset($doctor_email) && isset($last_id))
      {
        $email = $doctor_email.$last_id;  
      }
      
      $date1 = strtr($request->dob, '/', '-');
      $date = date('Y-m-d', strtotime($date1));

      $arr_data['first_name']     =   $request->fname;
      $arr_data['last_name']      =   $request->lname;
      $arr_data['email']          =   $email;
      $arr_data['password']       =   '12123132';
      $arr_data['dump_id']        =   $cardId;
      $arr_data['dump_session']   =   $request->txt_userkey;
      $arr_data['user_status']    =   'Active';

      $user                       =   Sentinel::register($arr_data);

      if($user)
      {
        $patient_data['user_id']               = $user->id; 
        $patient_data['date_of_birth']         = $date; 
        $patient_data['mobile_no']             = encrypt_value($request->mobile_no); 
        $patient_data['gender']                = $request->gender; 
        $patient_data['phone_no']              = $request->phone_no; 
        $patient_data['suburb']                = $this->VirgilService->encryptData($userCards, $request->address);
        $patient_data['card_no']               = ''; 
        $patient_data['entitlement_id']        = '';
        $patient_data['type']                  = 'myown'; 
        $patient_data['original_profile_type'] = 'myown'; 
        $patient_data['created_by']            = $this->user_id; 

        $user  =  Sentinel::findById($user->id);
        $role  =  Sentinel::findRoleBySlug('patient');
        $user->roles()->attach($role);

        // create user for twilio chat
        $create_user = $this->create_user($user->first_name.''.$user->last_name.''.$user->id);

        $activation =   Activation::create($user);
        $activation_code    =   'doctoroo';  //$activation->code;

        $res_patient = $this->PatientModel->create($patient_data);
        if($res_patient)
        {
          $this->PatientsRegularDoctorModel->patient_id = $user->id;
          $this->PatientsRegularDoctorModel->doctor_id  = $this->user_id;
          $this->PatientsRegularDoctorModel->regular    = $request->regular_doctor;
          $this->PatientsRegularDoctorModel->save();

          $arr_response['msg'] = "New Patient added successfully";
        }
        else
        {
          $arr_response['msg'] = "Error while creating your account. Please try again later";
        }
      }
      else
      {
        $arr_response['msg'] = "Some error occured. Please try again later";
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
             PROFILE TYPE CHANGE - SEND NOTIFICATION AND E MAIL TO PATIENT
    ----------------------------------------------------------------------------*/
    public function notify_patient(Request $request)
    {
      if($request->patient_type=='doctoroo')
      {
        $msg = "wants to make you his own patient.";
        $change_type='myown';
      }
      else
      {
        $msg = "wants you to make your own Doctoroo account.";
        $change_type='doctoroo';
      }
      /*$count = $this->NotificationModel->where([['from_user_id',$this->user_id],
                                                ['to_user_id',base64_decode($request->enc_patient_id)], 
                                                ['booking_id','0'], 
                                                ['message','wants to make you his own patient'], 
                                              ])
                                       ->count();
      if($count == 0)
      {*/
        $this->NotificationModel->from_user_id = $this->user_id;
        $this->NotificationModel->to_user_id = base64_decode($request->enc_patient_id);
        $this->NotificationModel->message = $msg;

        $patient_info = $this->UserModel->where('id' ,base64_decode($request->enc_patient_id))
                        ->first();
        if(isset($patient_info) && !empty($patient_info))
        {
          $patient_arr = $patient_info->toArray();
          $patient_name = $patient_arr['first_name'];
          $patient_email = $patient_arr['email'];
        }
        else
        {
          $patient_name = "";
        }   


        $user = Sentinel::findById($this->user_id);

        if($user)
        {
          $doctor_title = isset($user->title) ? $user->title : '';
          $doctor_fname = isset($user->first_name) ? $user->first_name : '';
          $doctor_lname = isset($user->last_name) ? $user->last_name : '';
          $doctor_name = $doctor_title.' '.$doctor_fname.' '.$doctor_lname;
        }
        else
        {
          $doctor_fname = '';
          $doctor_name = '';
          $doctor_lname = '';
          $patient_email = '';
        }

        $change_type_link    ='<a class="btn_emailer_cls" href="'.url('/doctor/patients/change_profile_type/'.$request->enc_patient_id.'/'.base64_encode($this->user_id).'/'.base64_encode($change_type)).'"> Change Profile Type </a>';
                
        $arr_built_content = [ 
                                'FIRST_NAME' => $doctor_fname,
                                'APP_NAME' => config('app.project.name'),
                                'CHANGE_TYPE_BTN' => $change_type_link,
                                'PATIENT_NAME' => $patient_name, 
                                'DOCTOR_NAME' => $doctor_name,
                                'MSG' => $msg
                             ];

        $user['first_name']  = $doctor_fname;                                    
        $user['last_name']   = $doctor_lname;                                    
        $user['email']       = $patient_email;                                    

        $arr_mail_data                      = [];
        $arr_mail_data['email_template_id'] = '45';
        $arr_mail_data['arr_built_content'] = $arr_built_content;
        $arr_mail_data['user']              = $user;
        $email_status  = $this->EmailService->send_mail($arr_mail_data);

        if($email_status)
        {
          $res = $this->NotificationModel->save();
          if($res)
          {
            $arr_response['msg'] = 'Notification and email sent successfully';
          }
          else
          {
            $arr_response['msg'] = 'Something went to wrong';
          }  
        }
        else
        {
          $arr_response['msg'] = 'Something went to wrong';
        }
        
      /*}
      else
      {
        $arr_response['msg'] = 'You have already sent request';
      }*/

      return response()->json($arr_response);
    }

    /*
    | Function  : Get all the medication details for the selected medication
    | Author    : Deepak Arvind Salunke
    | Date      : 16/08/2017
    | Output    : Show all the medication details for the selected medication
    */

    public function medication_details($enc_userid, $enc_id)
    {
      $patient_id    = base64_decode($enc_userid);
      $medication_id = base64_decode($enc_id);


      $get_medication_data = $this->MedicationModel->with('medication_img','userinfo')
                                                   ->where('user_id',$patient_id)
                                                   ->where('id',$medication_id)
                                                   ->first();
      if($get_medication_data)
      {
        $this->arr_view_data['medication_arr_data'] = $get_medication_data->toArray();
      }
      
      $get_prescription_data = $this->MedicationPrescriptionModel->with('pharmacy_list')
                                                                 ->where('patient_id',$patient_id)
                                                                 ->where('medication_id',$medication_id)
                                                                 ->get();
      if($get_prescription_data)
      {
        $this->arr_view_data['prescription_arr_data'] = $get_prescription_data->toArray();
      }
      
      /*$get_pharmacy_list = $this->MyPharmacyModel->where('patient_id', $patient_id)
                                                 ->orderBy('id','desc')
                                                 ->with(['pharmacy_user_details' => function($user) {
                                                        $user->where('user_status', 'Active');
                                                        $user->where('verification_status', '1');
                                                        $user->where('deleted_at', null);
                                                 }])
                                                 ->with('pharmacy_details')
                                                 ->get();*/

      $get_pharmacy_list = $this->PharmacyListModel->orderBy('company_name', 'ASC')->get();                                    
      if($get_pharmacy_list)
      {
        $this->arr_view_data['pharmacy_data'] = $get_pharmacy_list->toArray();
      }
      
      $this->arr_view_data['patient_prescription_public'] = $this->patient_prescription_public;
      $this->arr_view_data['patient_prescription']        = $this->patient_prescription;
      $this->arr_view_data['medication_path']             = $this->medication_img_public_path;
      $this->arr_view_data['prescription_path']           = $this->prescription_img_public_path;
      $this->arr_view_data['prescription_base_path']      = $this->prescription_img_base_path;
      $this->arr_view_data['enc_medication_id']           = $enc_id;
      $this->arr_view_data['enc_patient_id']              = $enc_userid;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      return view($this->module_view_folder.'.medication_details')->with($this->arr_view_data);
    } // end medication_details


    /*
    | Function  : Get form value and store new medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 16/08/2017
    | Output    : 
    */

    public function add_prescription(Request $request)
    {
      $curret_datetime    = date("Y-m-d h:i:s");
      $patient_id         = base64_decode($request->input('enc_patient_id'));
      $doctor_id          = $this->user_id;
      $medical_id         = base64_decode($request->input('medical_general_id'));
      $repeats            = $request->input('cmb_repeats');
      $direction          = $request->input('txt_direction');
      $hardcopy_location  = $request->input('cmb_hardcopy_location');
      $pharmacy_id        = $request->input('cmb_pharmacy_id');

      // upload id proof
      if($request->hasFile('txt_uploaded_file'))
      {
          $uploaded_file   =   $request->file('txt_uploaded_file');

          if(isset($uploaded_file) && sizeof($uploaded_file)>0)
          {
              $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
              $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

              if(!in_array($extention, $valid_ext))
              {
                  Session::flash('upload_file_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                  //return redirect()->back()->withInput($request->all());
                  return response()->json(['status'=>'fail']);
              }
              else if($uploaded_file->getClientSize() > 5000000)
              {
                  Session::flash('upload_file_error','Please upload image/document with small size. Max size allowed is 5mb');
                  return response()->json(['status'=>'fail']);
                  //return redirect()->back()->withInput($request->all());
              }
              else
              {
                  @unlink($this->prescription_img_public_path.$request->input('old_txt_uploaded_file'));
                  $upload_file_name      = $request->file('txt_uploaded_file');
                  $upload_file_extension = strtolower($request->file('txt_uploaded_file')->getClientOriginalExtension()); 
                  $upload_file_name      = sha1(uniqid().$upload_file_name.uniqid()).'.'.$upload_file_extension;
                  $upload_file_result    = $request->file('txt_uploaded_file')->move($this->prescription_img_base_path, $upload_file_name);
              }
              $data['uploaded_file']     = $upload_file_name;
          }
          else
          {
              Session::flash('upload_file_error','Please upload valid image/document.');
              return response()->json(['status'=>'fail']);
              //return redirect()->back()->withInput($request->all());
          }
      }

      $data['patient_id']         = $patient_id;
      $data['doctor_id']          = $doctor_id;
      $data['medication_id']      = $medical_id;
      $data['prescription_date']  = $curret_datetime;
      $data['repeats']            = $repeats;
      $data['directions']         = $direction;
      $data['hardcopy_location']  = $hardcopy_location;
      $data['pharmacy_id']        = $pharmacy_id;

      $update['patient_id']       = $patient_id;
      $update['updated_by']       = $this->user_id;

      $insert_data = $this->MedicationPrescriptionModel->create($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($insert_data)
      {
        $msg    = "Successfully added to Patient's Digital Prescription";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }

      Session::flash('message', $msg);
      return response()->json(['status'=>'success']);
      //return redirect()->back();
    } // end add_prescription



    /*
    | Function  : Get form value and update prescription for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 18/08/2017
    | Output    : 
    */

    public function edit_prescription(Request $request)
    {
      //dd($request->all());
      $curret_datetime    = date("Y-m-d h:i:s");
      $prescription_id    = $request->input('id');
      $repeats            = $request->input('repeats');
      $direction          = $request->input('direction');
      $hardcopy_location  = $request->input('hardcopy_location');
      $pharmacy_id        = $request->input('pharmacy_id');
      $patient_id         = base64_decode($request->input('enc_patient_id'));
      $upload_file_name   = '';

     // dd($request->input('old_pres_uploaded_file'));

      if($request->hasFile('pres_uploaded_file'))
      {
          $uploaded_file   =   $request->file('pres_uploaded_file');
          if(isset($uploaded_file) && sizeof($uploaded_file)>0)
          {
              $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
              $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

              if(!in_array($extention, $valid_ext))
              {
                  Session::flash('upload_file_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                  //return redirect()->back()->withInput($request->all());
                  return response()->json(['status'=>'fail']);
              }
              else if($uploaded_file->getClientSize() > 5000000)
              {
                  Session::flash('upload_file_error','Please upload image/document with small size. Max size allowed is 5mb');
                  return response()->json(['status'=>'fail']);
                  //return redirect()->back()->withInput($request->all());
              }
              else
              {
                  @unlink($this->prescription_img_base_path.$request->input('old_pres_uploaded_file'));
                  $upload_file_name      = $request->file('pres_uploaded_file');
                  $upload_file_extension = strtolower($request->file('pres_uploaded_file')->getClientOriginalExtension()); 
                  $upload_file_name      = sha1(uniqid().$upload_file_name.uniqid()).'.'.$upload_file_extension;
                  $upload_file_result    = $request->file('pres_uploaded_file')->move($this->prescription_img_base_path, $upload_file_name);
              }
              $data['uploaded_file']      = $upload_file_name;
          }
          else
          {
              Session::flash('upload_file_error','Please upload valid image/document.');
              return response()->json(['status'=>'fail']);
              //return redirect()->back()->withInput($request->all());
          }
      }

      $data['prescription_date']  = $curret_datetime;
      $data['repeats']            = $repeats;
      $data['directions']         = $direction;
      $data['hardcopy_location']  = $hardcopy_location;
      $data['pharmacy_id']        = $pharmacy_id;

      $update['patient_id'] = $patient_id;
      $update['updated_by'] = $this->user_id;

      $update_data = $this->MedicationPrescriptionModel->where('id', $prescription_id)->update($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($update_data)
      {
        $msg    = "Successfully updated to Patient's Digital Prescription";
        $status = "success";
        $response_data = array('status'=>$status,'msg'=>$msg);
        return response()->json(['status'=>'fail']);
        //return response()->json($response_data);
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
        $response_data = array('status'=>$status,'msg'=>$msg);
        return response()->json($response_data);
      }
    } // end edit_prescription


    /*
    | Function  : Get form value and update medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 17/08/2017
    | Output    : 
    */

    public function edit_medication(Request $request)
    {
      $patient_id     = base64_decode($request->input('enc_patient_id'));
      $doctor_id      = $this->user_id;
      $medical_id     = base64_decode($request->input('medical_general_id'));
      $name           = $request->input('name');
      $reason         = $request->input('reason');
      $duration       = $request->input('duration');

      // upload id proof
      if($request->hasFile('med_img'))
      {
          $uploaded_file   =   $request->file('med_img');

          if(isset($uploaded_file) && sizeof($uploaded_file)>0)
          {
              $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
              $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

              if(!in_array($extention, $valid_ext))
              {
                  Session::flash('medication_image_upload_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                  return redirect()->back()->withInput($request->all());
              }
              else if($uploaded_file->getClientSize() > 5000000)
              {
                  Session::flash('medication_image_upload_error','Please upload image with small size. Max size allowed is 5mb');
                  return redirect()->back()->withInput($request->all());
              }
              else
              {
                  @unlink($this->medication_img_base_path.$request->input('old_med_img'));
                  //$upload_file_name      = $request->file('med_img');
                  $upload_file_extension  = strtolower($request->file('med_img')->getClientOriginalExtension()); 
                  $uploaded_file          = sha1(uniqid().$uploaded_file.uniqid()).'.'.$upload_file_extension;
                  $upload_file_result     = $request->file('med_img')->move($this->medication_img_base_path, $uploaded_file);
              }
              $file['file']               = $uploaded_file;
          }
          else
          {
              Session::flash('medication_image_upload_error','Please upload valid image.');
              return redirect()->back()->withInput($request->all());
          }
      }

      $file['medication_id']          = $medical_id;

      //$data['medication_id']        = $medical_id;
      //$data['doctor_id']            = $doctor_id;
      //$data['user_id']                = $patient_id;
      $data['medication_name']        = $name;
      $data['medication_purpose']     = $reason;
      $data['medication_duration']    = $duration;

      $update['patient_id'] = $patient_id;
      $update['updated_by'] = $this->user_id;

      $update_data = $this->MedicationModel->where('id',$medical_id)->where('user_id',$patient_id)->update($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($request->hasFile('med_img'))
      {
        $create_data = $this->MedicationImagesModel->create($file);
      }
      if($update_data)
      {
        $msg    = "Successfully update to Patient's Medication";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }
      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);
    } // end edit_medication



    /*
    | Function  : display for new medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 19/08/2017
    | Output    : redirect it to store_medication function 
    */

    public function add_medication($enc_id)
    {
      $user_id = base64_decode($enc_id);

      $get_user = $this->UserModel->where('id', $user_id)->first();
      if($get_user)
      {
        $this->arr_view_data['user_data'] = $get_user->toArray();
      }

      $get_medication_data = $this->MedicationModel->with('medication_img')
                                                   ->where('user_id',$user_id)
                                                   ->get();
      if($get_medication_data)
      {
        $this->arr_view_data['medication_arr_data'] = $get_medication_data->toArray();
      }
      

      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['medication_path']             = $this->medication_img_public_path;
      $this->arr_view_data['prescription_path']           = $this->prescription_img_public_path;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      return view($this->module_view_folder.'.add_medication')->with($this->arr_view_data);
    } // end add_medication


    /*
    | Function  : Get form value and store new medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 16/08/2017
    | Output    : 
    */

    public function delete_medication_img(Request $request)
    {
      $img_id = $request->input('img_id');

      $get_data = $this->MedicationImagesModel->where('id',$img_id)->first();
      if($get_data)
      {
        $img_arr_data = $get_data->toArray();
      }

      $get_medication_data = $this->MedicationModel->where('id',$img_arr_data['medication_id'])->first();
      if($get_medication_data)
      {
        $medication_arr = $get_medication_data->toArray();
      }

      if(isset($img_arr_data) && sizeof($img_arr_data)>0)
      {
        if(File::exists($this->medication_img_base_path.$img_arr_data['file']))
        {
          unlink($this->medication_img_base_path.$img_arr_data['file']);
        }
      }

      $update['patient_id'] = $medication_arr['user_id'];
      $update['updated_by'] = $this->user_id;

      $delete_data = $this->MedicationImagesModel->where('id',$img_id)->delete();
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($delete_data)
      {
        //$msg    = "Successfully delete to Patient's Medication";
        $msg    = $img_id;
        $status = "success";
      }
      else
      {
        //$msg    = "Error! Something went wrong";
        $status = "error";
      }
      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    } // end delete_medication_img


    /*
    | Function  : Get form value and store new medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 19/08/2017
    | Output    : 
    */

    public function store_medication(Request $request)
    {
      // upload id proof
      if($request->hasFile('upload_img'))
      {
          $uploaded_file   =   $request->file('upload_img');

          if(isset($uploaded_file) && sizeof($uploaded_file)>0)
          {
              $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
              $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

              if(!in_array($extention, $valid_ext))
              {
                  Session::flash('medication_data_msg','Error! Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                  return redirect()->back()->withInput($request->all());
              }
              else if($uploaded_file->getClientSize() > 5000000)
              {
                  Session::flash('medication_data_msg','Error! Please upload image with small size. Max size allowed is 5mb');
                  return redirect()->back()->withInput($request->all());
              }
              else
              {
                  @unlink($this->medication_img_base_path.$request->input('old_med_img'));
                  $upload_file_extension  = strtolower($request->file('upload_img')->getClientOriginalExtension()); 
                  $uploaded_file          = sha1(uniqid().$uploaded_file.uniqid()).'.'.$upload_file_extension;
                  $upload_file_result     = $request->file('upload_img')->move($this->medication_img_base_path, $uploaded_file);
              }
              $img_data['file']           = $uploaded_file;
          }
          else
          {
              Session::flash('medication_data_msg','Error! Please upload valid image.');
              return redirect()->back()->withInput($request->all());
          }
      }

      $enc_patient_id               = $request->input('enc_patient_id');
      $data['user_id']              = base64_decode($request->input('enc_patient_id'));

      if($request->input('enc_exist_medication') != null  && !empty($request->input('enc_exist_medication')))
      {
        $data['medication_name']    = $request->input('enc_exist_medication');
      }
      else if($request->input('enc_name') != null && !empty($request->input('enc_name')))
      {
        $data['medication_name']    = $request->input('enc_name');
      }

      $data['medication_purpose']   = $request->input('enc_reason');
      $data['medication_duration']  = $request->input('enc_duration');

      $update['patient_id'] = $data['user_id'];
      $update['updated_by'] = $this->user_id;

      $medication_id = $this->MedicationModel->insertGetId($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($medication_id)
      {
        $img_data['medication_id']  = $medication_id;
        $enc_medication_id          = base64_encode($medication_id);

        $store_img = $this->MedicationImagesModel->create($img_data);
        if($store_img)
        {
          Session::flash('medication_data_msg','Medication details added Successfully');
          return redirect( url('/').'/doctor/patients/medication_details/'.$enc_patient_id.'/'.$enc_medication_id);
        }
        else
        {
          Session::flash('medication_data_msg','Error! Something went wrong while saving image.');
          return redirect()->back()->withInput($request->all());
        }
      }
      else
      {
        Session::flash('medication_data_msg','Error! Something went wrong while saving data.');
        return redirect()->back()->withInput($request->all());
      }
    } // end add_medication


    /*
    | Function  : Get form value and update general medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 21/08/2017
    | Output    : Success or Error
    */

    public function update_medical_general(Request $request)
    {
      $patient_id                       = base64_decode($request->input('enc_patient_id'));
      $medical_general_id               = $request->input('medical_general_id');
      $data['allergy']                  = $request->input('allergies');
      $data['allergy_details']          = $request->input('allergy_details');
      $data['surgery']                  = $request->input('surgeries');
      $data['surgery_details']          = $request->input('surgeries_details');
      $data['pregnancy']                = $request->input('pregnancies');
      $data['pregnancy_details']        = $request->input('pregnancy_details');
      $data['family_history']           = $request->input('family_history');
      $data['family_history_details']   = $request->input('family_history_details');
      $data['other']                    = $request->input('other');
      $data['other_details']            = $request->input('other_details');
      $data['diabetes']                 = $request->input('diabetes');
      $data['diabetes_details']         = $request->input('diabetes_details');
      $data['heart_disease']            = $request->input('heart_disease');
      $data['heart_disease_details']    = $request->input('heart_disease_details');
      $data['stroke']                   = $request->input('stroke');
      $data['stroke_details']           = $request->input('stroke_details');
      $data['blood_pressure']           = $request->input('blood_pressure');
      $data['blood_pressure_details']   = $request->input('blood_pressure_details');
      $data['high_cholesterol']         = $request->input('high_cholesterol');
      $data['high_cholesterol_details'] = $request->input('high_cholesterol_details');
      $data['asthma']                   = $request->input('asthma');
      $data['asthma_details']           = $request->input('asthma_details');
      $data['depression']               = $request->input('depression');
      $data['depression_details']       = $request->input('depression_details');
      $data['arthritis']                = $request->input('arthritis');
      $data['arthritis_details']        = $request->input('arthritis_details');

      
      $update['patient_id'] = $patient_id;
      $update['updated_by'] = $this->user_id;

      $update_data = $this->HealthGeneralModel->where('id',$medical_general_id)->update($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);

      if(isset($request->dyn_arr) && !empty($request->dyn_arr))
        {
          
          $dyn_arr =$request->dyn_arr;
            foreach($dyn_arr as $v)
            {
              $val = explode('_', $v);
              if(isset($val[0]) && isset($val[0]))
              {
                $id = $val[0];
                $status = $val[1];
                $desc = $val[2];

                $data_arr['status'] = $status;
                $data_arr['description'] = $desc;
                
                $dyn_res = $this->DynamicHealthGeneralModel->where('id', $id)
                                                           ->update($data_arr);
              }
            }
        }


      if($update_data || isset($dyn_res))
      {
        $msg    = "Medical history saved successfully";
        $status = "success";
      }
      else
      {
        $msg    = "Something went to wrong or no changes found";
        $status = "error";
      }
      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    } // end update_medical_general


    /*
    | Function  : Get form value and insert new general medication for the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 21/08/2017
    | Output    : Success or Error
    */

    public function insert_medical_general(Request $request)
    {
      $data['user_id']                  = base64_decode($request->input('enc_patient_id'));
      $data['allergy']                  = $request->input('allergies');
      $data['allergy_details']          = $request->input('allergy_details');
      $data['surgery']                  = $request->input('surgeries');
      $data['surgery_details']          = $request->input('surgeries_details');
      $data['pregnancy']                = $request->input('pregnancies');
      $data['pregnancy_details']        = $request->input('pregnancy_details');
      $data['family_history']           = $request->input('family_history');
      $data['family_history_details']   = $request->input('family_history_details');
      $data['other']                    = $request->input('other');
      $data['other_details']            = $request->input('other_details');
      $data['diabetes']                 = $request->input('diabetes');
      $data['diabetes_details']         = $request->input('diabetes_details');
      $data['heart_disease']            = $request->input('heart_disease');
      $data['heart_disease_details']    = $request->input('heart_disease_details');
      $data['stroke']                   = $request->input('stroke');
      $data['stroke_details']           = $request->input('stroke_details');
      $data['blood_pressure']           = $request->input('blood_pressure');
      $data['blood_pressure_details']   = $request->input('blood_pressure_details');
      $data['high_cholesterol']         = $request->input('high_cholesterol');
      $data['high_cholesterol_details'] = $request->input('high_cholesterol_details');
      $data['asthma']                   = $request->input('asthma');
      $data['asthma_details']           = $request->input('asthma_details');
      $data['depression']               = $request->input('depression');
      $data['depression_details']       = $request->input('depression_details');
      $data['arthritis']                = $request->input('arthritis');
      $data['arthritis_details']        = $request->input('arthritis_details');

      $update['patient_id'] = $data['user_id'];
      $update['updated_by'] = $this->user_id;

      $insert_data = $this->HealthGeneralModel->insert($data);
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($insert_data)
      {
        $msg    = "Successfully insert to Patient's General Medication";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }
      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    } // end insert_medical_general

    /*--------------------------------------------------------------------------
                                  PATIENT DETAILS PDF
    ----------------------------------------------------------------------------*/
    public function patient_details_pdf_download($enc_id)
    {
      $user_id = base64_decode($enc_id);
      $patient_details = $this->PatientModel->where('user_id',$user_id)
                                            ->with('userinfo')
                                            ->with(['memberfamily' => function($member){
                                                $member->where('member_status','link');
                                                $member->orderBy('id','desc');
                                            }])
                                            ->with(['familydoctor' => function($doctor){
                                                $doctor->where('status','link');
                                                $doctor->orderBy('id','desc');
                                            }])
                                            ->with(['regularfamilydoctor' => function($regular_doctor) use($user_id){
                                                $regular_doctor->where('patient_id',$user_id);
                                            }])
                                            ->first();

      $file_fname = "";
      $file_lname = "";
      if($patient_details)
      {
        $patient_details = $patient_details->toArray();
        
        $this->arr_view_data['patient_details']           =  $patient_details;

        //dd($this->arr_view_data['patient_details']);
        
        if(isset($patient_details['regularfamilydoctor']))
        {
          $doctor_id=array();
          foreach($this->arr_view_data['patient_details']['regularfamilydoctor'] as $val)
          {
            if($val['regular'] == 'yes')
            {
              array_push($doctor_id,$val['doctor_id']);
            }
          }
           
          if($doctor_id)
          {
            $regular_doctor_arr = $this->UserModel->whereIn('id',$doctor_id)->get();
            $this->arr_view_data['regular_doctor_arr'] = $regular_doctor_arr->toArray();
          } 

        }

        if($patient_details['userinfo']['first_name'])
        {
         $file_fname = $this->arr_view_data['patient_details']['userinfo']['first_name'].'_'; 
        }
       
        if($patient_details['userinfo']['last_name'])
        {
         $file_lname = $this->arr_view_data['patient_details']['userinfo']['last_name']; 
        }
      }

      $get_pharmacy_list = $this->MyPharmacyModel->where('patient_id', $user_id)
                                                 ->orderBy('id','desc')
                                                 ->with(['pharmacy_user_details' => function($user) {
                                                      $user->where('user_status', 'Active');
                                                      $user->where('verification_status', '1');
                                                      $user->where('deleted_at', null);
                                                  }])
                                                ->with('pharmacy_details')
                                                ->get();
      if($get_pharmacy_list)
      {
        $this->arr_view_data['pharmacy_data'] = $get_pharmacy_list->toArray();
      }

      $previous_seen_dr= $this->PatientConsultationBookingModel->where('patient_user_id',$user_id)
                                                               ->orderBy('id','desc')
                                                               ->groupby('doctor_user_id')
                                                               ->with('doctor_user_details')->get();

      if($previous_seen_dr)
      {
        $this->arr_view_data['previous_seen_dr'] = $previous_seen_dr->toArray();
      }

      $entitlement_arr=$this->entitlement_model->get()->toArray();

      $regular_doctor= $this->PatientsRegularDoctorModel->where([
                                                                  ['patient_id',$user_id],
                                                                  ['doctor_id',$this->user_id]])
                                                        ->select('regular')
                                                        ->first();
      if($regular_doctor)
      {
        $this->arr_view_data['regular_doctor_status']     = $regular_doctor->regular;        
      }

      $entitle_arr = $this->UserEntitlementModel->where('user_id' , $user_id)
                                                   ->with('user_entitlement')
                                                ->get();
      if($entitle_arr)
      {
        $this->arr_view_data['user_entitlement_arr'] = $entitle_arr->toArray();
      } 

      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['pdf_name']                    = $file_fname.$file_lname.'.pdf';
      Session::put("arr_patient_data",'');
      return response()->json($this->arr_view_data);
// /      return view($this->module_view_folder.'.pdf.patient_details_pdf')->with($this->arr_view_data);
      
    }


    public function generate_patient_details_pdf_download(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_patient_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
        //Generata PDF Code
        $arr_data = Session::get('arr_patient_data');
        if(!empty($arr_data))
        {
            PDF::setHeaderCallback(function($pdf) {

            $pdf->SetY(15);
            // Set font
            $pdf->SetFont('helvetica', 'B', 20);
            // Title
            //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

            // Image method signature:
            // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

            $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);

            $pdf->SetY(40);

          });

          // Custom Footer
          PDF::setFooterCallback(function($pdf) {

                  // Position at 15 mm from bottom
                  $pdf->SetY(-15);
                  // Set font
                  $pdf->SetFont('helvetica', 'I', 8);
                  // Page number
                  $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

          });
          PDF::SetTitle('Doctoroo | Patient Details');
          PDF::SetMargins(10, 30, 10, 10);
          PDF::SetFontSubsetting(false);
          PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          PDF::AddPage();
          PDF::writeHTML(view($this->module_view_folder.'.pdf.patient_details_pdf_php', $arr_data)->render());
          PDF::Output($arr_data['pdf_name'].'.pdf');
        }
        return redirect()->back();
      
    }

    public function medical_history_pdf_download($enc_id)
    {
      $patient_details = $this->UserModel->where('id',base64_decode($enc_id))->with('patientinfo')->first();
      if($patient_details)
      {
        $patient_arr = $patient_details->toArray();
        $this->arr_view_data['patient_arr'] = $patient_arr;
        if($patient_arr['first_name'])
        {
         $file_fname = $patient_arr['first_name'].'_'; 
        }
       
        if($patient_arr['last_name'])
        {
         $file_lname = $patient_arr['last_name']; 
        }
      }
      
      $general_arr_data = $this->arr_view_data['lifestyle_arr_data'] = [];
      $get_general_data = '';

      $user_id = base64_decode($enc_id);

      $get_general_data = $this->HealthGeneralModel->where('user_id',$user_id)->first();
      if($get_general_data)
      {
        $general_arr_data = $get_general_data->toArray();

        $get_dynamic_general = $this->DynamicHealthGeneralModel->where('general_id', $general_arr_data['id'])->get();
        if($get_dynamic_general)
        {
          $this->arr_view_data['dynamic_general_data'] = $get_dynamic_general->toArray();
        }
      }
      //dd($general_arr_data);
      
      $get_lifestyle_data = $this->LifeStylelModel->where('user_id',$user_id)->first();
      if($get_lifestyle_data)
      {
        $this->arr_view_data['lifestyle_arr_data'] = $get_lifestyle_data->toArray();
      }

      $get_medication_data = $this->MedicationModel->where('user_id',$user_id)->get();
      if($get_medication_data)
      {
        $this->arr_view_data['medication_arr_data'] = $get_medication_data->toArray();
      }
        
      $this->arr_view_data['general_arr_data']            = $general_arr_data;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;
      $this->arr_view_data['pdf_name']                    = $file_fname.$file_lname.'_medical_history.pdf';
      
      Session::put("arr_medical_data",'');
      return response()->json($this->arr_view_data);
    }


    public function generate_medical_history_pdf_download(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_medical_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      $arr_data = Session::get('arr_medical_data');
      if(!empty($arr_data))
      {
              // Custom Header
        PDF::setHeaderCallback(function($pdf) {

                $pdf->SetY(15);
                // Set font
                $pdf->SetFont('helvetica', 'B', 20);
                // Title
                //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                // Image method signature:
                // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

                $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
                $pdf->SetY(40);

        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {

                // Position at 15 mm from bottom
                $pdf->SetY(-15);
                // Set font
                $pdf->SetFont('helvetica', 'I', 8);
                // Page number
                $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        });

        PDF::SetTitle('Doctoroo | Patient Medical history');
        PDF::SetMargins(10, 30, 10, 10);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
        PDF::AddPage();
        PDF::writeHTML(view($this->module_view_folder.'.pdf.medical_history_pdf', $arr_data)->render());
        PDF::Output($arr_data['pdf_name'].'.pdf');
      }
      return redirect()->back();
    }



    /*
    | Function  : Delete the selected general medical condition
    | Author    : Deepak Arvind Salunke
    | Date      : /08/2017
    | Output    : Success or Error
    */

    public function delete_medical_general(Request $request)
    {
      $patient_id         = base64_decode($request->input('enc_patient_id'));
      $medical_general_id = $request->input('medical_general_id');
      $dynamic_general_id = $request->input('dynamic_general_id');

      $update['patient_id'] = $patient_id;
      $update['updated_by'] = $this->user_id;

      $delete_data = $this->DynamicHealthGeneralModel->where('id',$dynamic_general_id)->where('general_id',$medical_general_id)->delete();
      $medical_updates  = $this->MedicalHistoryUpdatesModel->create($update);
      if($delete_data)
      {
        $msg    = "Successfully deleted Medical General Condition";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }

      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    }// end delete_medical_general

    public function past_consultation_details_download($enc_id)
    {
      $current_datetime = date( "Y-m-d H:i:s");
      $past_consultation = $this->PatientConsultationBookingModel
                                ->where('id', base64_decode($enc_id))
                                ->where([
                                       ['consultation_datetime','<',$current_datetime]
                                      ])
                                ->where(function($query) use($current_datetime){
                                      $query->orWhere('booking_status','Completed');
                                      $query->orWhere('booking_status','Confirmed');
                                 })
                                ->with('patient_user_details','patient_info','familiy_member_info','doctor_user_details')
                                ->first();

      $fname = "";
      $fname = "";

      if($past_consultation)
      {
       $past_consultation_arr                          = $past_consultation->toArray();
       $this->arr_view_data['past_consultation_arr']   = $past_consultation_arr;
      }  

      if($past_consultation_arr['familiy_member_info'] == null)
      {
        $fname = isset($past_consultation_arr['patient_user_details']['first_name']) ? $past_consultation_arr['patient_user_details']['first_name'].'-' : '';

        $lname = isset($past_consultation_arr['patient_user_details']['last_name']) ? $past_consultation_arr['patient_user_details']['last_name'].'-' : '';
      }
      else
      {
        $fname = isset($past_consultation_arr['familiy_member_info']['first_name']) ? $past_consultation_arr['familiy_member_info']['first_name'].'-' : '';

        $lname = isset($past_consultation_arr['familiy_member_info']['last_name']) ? $past_consultation_arr['familiy_member_info']['last_name'].'-' : '';
      }

      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['enc_patient_id']              = $enc_id;
      $this->arr_view_data['profile_img_base_path']       = $this->profile_img_base_path;
      $this->arr_view_data['profile_img_public_path']     = $this->profile_img_public_path;

      // Custom Header
      PDF::setHeaderCallback(function($pdf) {

              $pdf->SetY(15);
              // Set font
              $pdf->SetFont('helvetica', 'B', 20);
              // Title
              //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

              // Image method signature:
              // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

              $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);

              $pdf->SetY(40);

      });

      // Custom Footer
      PDF::setFooterCallback(function($pdf) {

              // Position at 15 mm from bottom
              $pdf->SetY(-15);
              // Set font
              $pdf->SetFont('helvetica', 'I', 8);
              // Page number
              $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

      });
      
      PDF::SetTitle('Doctoroo | Post Consultation Details');
      PDF::SetMargins(10, 30, 10, 10);
      PDF::SetFontSubsetting(false);
      PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      PDF::AddPage();
      PDF::writeHTML(view($this->module_view_folder.'.pdf.past_consultation_details', $this->arr_view_data)->render());
      PDF::Output($fname.$lname.'post-consultation-details.pdf');
    }


    /*
    | Function  : Create user for twilio chat
    | Author    : Deepak Arvind Salunke
    | Date      : 09/09/2017
    | Output    : Success or Error
    */

    public function create_user($username)
    {
        // Create the user
        $user = $this->client->chat
                     ->services($this->service_id)
                     ->users
                     ->create($username);

        return $user->identity;
        
    } // end create_user













    public function index(Request $request,$type=FALSE)
    {

          $arr_medical_history = $form_data = $arr_patient_list = [];
          $form_data = $request->all();

          $this->arr_view_data['page_title'] = 'My Patients';
          if(count($form_data)>0)
          {

                $search_obj = $this->search_patient($form_data);
                if($search_obj!=FALSE)
                {

                   $arr_patient_list = $search_obj->toArray();

                }
          }
          else
          {
            
            $arr_patient_list = $this->get_patient_list($type);

          }
          $this->arr_view_data['patient_base_img_path']         = $this->patient_base_img_path;  
          $this->arr_view_data['patient_public_img_path']       = $this->patient_public_img_path; 
          $this->arr_view_data['page_title']                    = 'My Patients'; 
          $this->arr_view_data['module_patient_path']           = $this->module_patient_path;             
          $this->arr_view_data['arr_patient_list']              = $arr_patient_list;                                 
          $this->arr_view_data['module_url_path']               = $this->module_url_path;
          return view($this->module_view_folder.'.show',$this->arr_view_data);
    }

    public function get_patients_details($enc_id=FALSE,$enc_family_id=FALSE)
    {

         $arr_patient =  $arr_patient_list = $arr_medical_history = $illness_str = []; 
         $this->arr_view_data['page_title'] = 'My Patients';
         $arr_patient_list  = $this->get_patient_list();

         if(isset($enc_family_id) && $enc_family_id!='')
         {
            $familiy_member_id = base64_decode($enc_family_id);
         }
         else
         {
            $familiy_member_id = 0;
         }

         if(isset($enc_id) && $enc_id!="") 
         {
                    $id = base64_decode($enc_id);
                    $obj_patient = $this->PatientModel->with(['userinfo'=>function($q){

                                                            $q->select('id','first_name','last_name','email');

                                                        },'medicaredetails','regulardoctor',
                                                        'familymember'=>function($qry)use($familiy_member_id){

                                                              $qry->where('id','=',$familiy_member_id);

                                                        }])
                                                      ->where('user_id',$id)
                                                      ->first();

                    if($obj_patient!=FALSE)
                    {
                         $arr_patient = $obj_patient->toArray();                        
                    }

                    $obj_medical_history = $this->MedicalhistoryModel->with(['illnessinfo'])
                                                                     ->where('user_id',$id)
                                                                     ->where('family_member_id',$familiy_member_id)
                                                                     ->first();
                    if($obj_medical_history!=FALSE)                                                 
                    {
                        $arr_medical_history = $obj_medical_history->toArray();

                        /* get illness name */
                        if(isset($arr_medical_history) && sizeof($arr_medical_history))
                        {   
                            if(isset($arr_medical_history['illnessinfo']['illness_id']) && $arr_medical_history['illnessinfo']['illness_id']!='')
                              {
                                  foreach($arr_medical_history['illnessinfo']['illness_id'] as $illness_id)
                                  {
                                      $obj_illness   =   $this->IllnessAndConditionModel->where('id',$illness_id)->select('illness_name')->first();
                                      $arr_illness[] =   $obj_illness->illness_name;

                                  }
                                  $illness_str   = implode(',',$arr_illness);
                              }
                        }                       
                        $this->arr_view_data['illness_str']         = $illness_str; 
                        $this->arr_view_data['arr_medical_history'] = $arr_medical_history; 
                     
                    }
                     $this->arr_view_data['patient_base_img_path']         = $this->patient_base_img_path;  
                     $this->arr_view_data['patient_public_img_path']       = $this->patient_public_img_path; 
                     $this->arr_view_data['arr_patient_list']              = $arr_patient_list; 
                     $this->arr_view_data['arr_patient']                   = $arr_patient; 
                     $this->arr_view_data['module_patient_path']           = $this->module_patient_path; 
                     $this->arr_view_data['module_url_path']               = $this->module_url_path;
                     return view($this->module_view_folder.'.show',$this->arr_view_data); 
         }
         return redirect()->back();  
    }

    public function download_card($enc_id=FALSE)
    {

          if($enc_id!="")
          {

              $user_id = base64_decode($enc_id);

              $obj_medicare_info = $this->MedicareDetailsModel->where('user_id',$id)->first();
              if($obj_medicare_info!=FALSE)
              {

                  $arr_medicare = $obj_medicare_info->toArray();

                  if(sizeof($arr_medicare)>0)
                  {

                      if(isset($arr_medicare['card_image']) && $arr_medicare['card_image']!=""  && file_exists('uploads/patient/card-photo/'.$arr_medicare['card_image']))
                      {    
                   
                          $file     = "uploads/patient/card-photo/".$arr_medicare['card_image'];
                          return Response::download($file);

                      }    
                  }    
              }

          }

         return redirect()->back(); 
    }

   /* public function search_patient($form_data=array())
    {

        $obj_patient = "";
        $obj_patient = $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                             ->where('booking_status','=','Confirmed')
                                                             ->with(['patient_info'])
                                                             ->groupby('patient_user_id');

        if($form_data['phone_no'])
        {
            $phone_no    = $form_data['phone_no'];

            $obj_patient = $obj_patient->with(['patient_info'=>function($q)use($phone_no ){
                                                $q->where('mobile_no','=',$phone_no );  
                                              }]);
        }

        if($form_data['patient_name']!="")
        {

            $patient_name = $form_data['patient_name'];
            if(strstr($patient_name, ' '))
            {

                list($fname,$lname) = explode(' ', $patient_name);
                if(isset($fname) && isset($lname))
                {

                    $obj_patient = $obj_patient->with(['patient_user_details'=>function($q1)use($fname,$lname){
                                                $q1->where('first_name','LIKE','%'.$fname.'%');
                                                $q1->where('last_name','LIKE','%'.$lname.'%');
                                              }]);
                }
            }
            else
            {
                $obj_patient = $obj_patient->with(['patient_user_details'=>function($q1)use($patient_name){
                                                $q1->where('first_name','LIKE','%'.$patient_name.'%');
                                             
                                              }]);
            }
            
        }

        if($form_data['email']!="")
        {
             $email_id    = $form_data['email'];
             $obj_patient = $obj_patient->with(['patient_user_details'=>function($q2)use($email_id){
                                                $q2->where('email','=',$email_id);
                                             
                                              }]);
        }

        $obj_patient = $obj_patient->get();

        return $obj_patient;

    }*/
    /*
       14 Apr 2017
       Rohini j
       get doctoroo & mypatient patient list
    */
    public function get_patient_list($type=FALSE)
    {
            $arr_patient_list = $arr_patient = [];

            /*get doctoroo patient list */
            if($type==false)
            {
                $obj_data         =  $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                                           ->where('booking_status','=','Confirmed')
                                                                           ->whereHas('patient_user_details',function($qry){
                                                                              $qry->where('is_invited','<>',"1");
                                                                            })  
                                                                           ->with(['patient_user_details'=>function($q){

                                                                              $q->where('is_invited','<>',"1");

                                                                              $q->select('id','email','first_name','last_name','profile_image','is_invited');  

                                                                           },'patient_info']);

                $obj_patient      =   $obj_data->groupby('patient_user_id')->get();
          }
          else
          {
                  /* get invited patient list */
                 $obj_patient     =  $this->PatientConsultationBookingModel->where('doctor_user_id',$this->user_id)
                                                                   ->where('booking_status','=','Confirmed')
                                                                   ->whereHas('patient_user_details',function($qry){
                                                                      $qry->where('is_invited','=',"1");
                                                                    }) 
                                                                   ->with(['patient_user_details'=>function($q){

                                                                       $q->where('is_invited','=',1);

                                                                       $q->select('id','email','first_name','last_name','profile_image');  

                                                                   },'patient_info'])
                                                                   ->groupby('patient_user_id')
                                                                   ->get();

          }

          if($obj_patient!=FALSE)                               
          {
               $arr_patient_list = $obj_patient->toArray();  
               if(isset($arr_patient_list) && sizeof($arr_patient_list)>0)
               {
                  /*get familiy member info of perticuler patient*/
                  foreach($arr_patient_list as $key =>$list)
                  {
                       $obj_familiy_patient = $this->FamilyMemberModel->where('user_id','=',$list['patient_user_id'])
                                                                      ->with(['consultation_info'=>function($q){
                                                                          $q->where('booking_status','=','Confirmed');
                                                                          $q->select('id','patient_user_id','booking_status');
                                                                      }])->get();

                      if($obj_familiy_patient)
                      {
                          $arr_patient  = $obj_familiy_patient->toArray();

                      }
                      $arr_patient_list[$key]['familiy_member'] = $arr_patient;                     
                  }
               }                
          }
          return $arr_patient_list;
    }

    public function past_consultation_update(Request $request)
    {
        $upd_res ="";
        $delete_res ="";
        $ins_res = "";
        $consultation_notes = $request->consultation_notes;

        $consultation_id = $request->consultation_id;
        $patient_user_id  = $request->patient_user_id;

        if(isset($request->delete_doc) && $request->delete_doc != '')
        {
          $delete_doc_ids = explode(',', $request->delete_doc);
          $delete_ids = array_filter($delete_doc_ids);

          $del_arr = $this->ConsultationDocumentsModel->whereIn('id', $delete_ids)->get();
          if(isset($del_arr) && !empty($del_arr))
          {
            $data_del = $del_arr->toArray();

            foreach($data_del as $val)
            {
                if(isset($val['document']) && !empty($val['document']) && File::exists($this->consultation_documents_public_url.$val['document']))
                  {
                    @unlink($this->consultation_documents_public_url.$val['document']);
                  }
            }

            $delete_res = $this->ConsultationDocumentsModel->whereIn('id' , $delete_ids)->delete();

          }
          
        }

        if(isset($request->delete_img) && $request->delete_img != '')
        {
          $delete_img_ids = explode(',', $request->delete_img);
          $delete_img = array_filter($delete_img_ids);

          $del_img_arr = $this->PatientConsultationImagesModel->whereIn('id', $delete_img)->get();
          if(isset($del_img_arr) && !empty($del_img_arr))
          {
            $data_img_del = $del_img_arr->toArray();

            foreach($data_img_del as $values)
            {
                if(isset($values['health_image']) && !empty($values['health_image']) && File::exists($this->patient_uploads_public_url.$values['health_image']))
                  {
                    @unlink($this->patient_uploads_public_url.$values['health_image']);
                  }
            }

            $delete_res = $this->PatientConsultationImagesModel->whereIn('id' , $delete_img)->delete();

          } 
        }
              
        if($request->hasFile('consultation_document'))
        {
            $consultation_document   =   $request->file('consultation_document');


            if(isset($consultation_document) && sizeof($consultation_document)>0)
            {
              

              foreach($consultation_document as $file)
              {
                $extention  =   strtolower($file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('doc_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp');
                    return redirect()->back()->withInput($request->all());
                }
                else if($file->getClientSize() > 5000000)
                {
                    Session::flash('doc_error','Please upload image with small size. Max size allowed is 5mb');
                    return redirect()->back()->withInput($request->all());
                }
                else
                {
                    $document_name          = $file;
                    $document_file_ext      = strtolower($file->getClientOriginalExtension()); 
                    $doc_file_name      = sha1(uniqid().$document_name.uniqid()).'.'.$document_file_ext;
                    $doc_upload_result  = $file->move($this->consultation_documents_public_url, $doc_file_name);
                    if($doc_upload_result)
                    {
                      $upd_arr = array(
                        'consultation_id' => $consultation_id,
                        'patient_id'      => $patient_user_id,
                        'doctor_id'       => $this->user_id,
                        'document'        => $doc_file_name
                      );

                      $upd_res = $this->ConsultationDocumentsModel->create($upd_arr);  
                      
                    }
                    
                }
              }

            }
            else
            {
                Session::flash('id_proof_error','Please upload valid image/document.');
                return redirect()->back()->withInput($request->all());
            }



        }

        if($request->hasFile('consultation_images'))
      {
          $medical_file   =   $request->file('consultation_images');
          if(isset($medical_file) && sizeof($medical_file)>0)
          {
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
                    $medical_upload_result  = $file->move($this->profile_uploads_base_url, $medical_file_name);

                    $insert_arr = array(
                          'user_id'      => $patient_user_id,
                          'booking_id'   => $consultation_id,
                          'health_image' => $medical_file_name,
                      );
                    $ins_res = $this->PatientConsultationImagesModel->create($insert_arr);
                }
              }
          }
          else
          {
              Session::flash('medical_img_error','Please upload valid image.');
              return redirect()->back()->withInput($request->all());
          }
      }

      $notes_arr = array(
              'consultation_id' => $consultation_id,
              'doctor_id'       => $this->user_id,
              'patient_id'      => $patient_user_id,
              'notes'           => $consultation_notes,
        );
      $count = $this->ConsultationNotesModel->where('consultation_id' ,$consultation_id)->count();

      if($count > 0)
      {
        $notes_res = $this->ConsultationNotesModel->where('consultation_id' ,$consultation_id)
                                                  ->update($notes_arr);    
      }
      else
      {
          $notes_res = $this->ConsultationNotesModel->create($notes_arr);
      }

       

        if($upd_res || $delete_res || $ins_res || $notes_res)
         {
            Session::flash('message','Consultation details updated successfully');
         }
         else
         {
            Session::flash('message','No Changes found'); 
         }

      return redirect()->back();
    }

      /*--------------------------------------------------------------------------
                    ENTITLEMENT - GET DETAILS
      -----------------------------------------------------------------------------*/

    public function get_entitlement_details(Request $request)
    {
      $patient_id = base64_decode($request->patient_id);
      $entitlement_id = $request->id;
      $entitle_arr = $this->UserEntitlementModel->where('entitlement_id', $entitlement_id)
                                                ->where('user_id' , $patient_id)
                                                ->first(); 
      $arr_response = array();                                                
      
      if($entitle_arr)
      {
         $arr_response = $entitle_arr->toArray();
         $arr_json['status'] = 'success';
         $arr_json['card_no'] = isset($arr_response['card_no']) ? $arr_response['card_no'] : '';

         if($arr_response['affect_area_img'] !='' && File::exists($this->patient_uploads_public_url.$arr_response['affect_area_img']))
         {
            $arr_json['affected_area_photo'] = isset($arr_response['affect_area_img']) ? $arr_response['affect_area_img'] : ''; 
         }
         else
         {
            $arr_json['affected_area_photo'] = ''; 
         }
      }
      else
      {
        $arr_json['status'] = 'error'; 
      }

      return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                    ENTITLEMENT - STORE
      -----------------------------------------------------------------------------*/

    public function store_entitlement_details(Request $request)
    {
        $patient_id = base64_decode($request->patient_id);
        $exist_img_arr = explode(',',$request->existing_images);
        $affected_area_img = $this->UserEntitlementModel->where('user_id' , $patient_id)
                                                        ->where('entitlement_id' , $request->entitlement_id)
                                                        ->select('affect_area_img')
                                                        ->get();
        if(isset($affected_area_img) && !empty($affected_area_img))
        {
            $affected_area_img_arr = $affected_area_img->toArray();     
            $img_arr=[];
            foreach($affected_area_img_arr as $img)
            {
                if(!empty($img['affect_area_img']))
                {
                    array_push($img_arr, $img['affect_area_img']);
                }
            }

            $before = $img_arr;
            $after =  $exist_img_arr;

            $delete_array = array_diff($img_arr,$exist_img_arr);

            foreach($delete_array as $val)
            {
                $this->UserEntitlementModel->where('affect_area_img',$val)
                                               ->delete();
                 if($val!='' && File::exists($this->patient_uploads_public_url.$val))                                
                 {
                    unlink($this->patient_uploads_public_url.$val);
                 }
            }
        }
        
        if($request->hasFile('affected_area'))
        { 
           $file   =   $request->file('affected_area');
            /*if(isset($medical_file) && sizeof($medical_file)>0)
            {
              foreach($medical_file as $file)
              {*/
                 $img_delete = $this->UserEntitlementModel->where('user_id' , $patient_id)
                                                                ->where('entitlement_id' , $request->entitlement_id)
                                                                ->select('affect_area_img')
                                                                ->first();
                  if($img_delete)
                  {
                      $img = $img_delete->toArray();

                      $delete_img = isset($img['affect_area_img']) ? $img['affect_area_img'] : '';

                       if($delete_img!='' && File::exists($this->patient_uploads_public_url.$delete_img))                                
                       {
                          @unlink($this->patient_uploads_public_url.$delete_img);
                       }

                  }                                                                 

                $medical_name           = $file;
                $medical_file_extension = strtolower($file->getClientOriginalExtension()); 
                $medical_file_name      = sha1(uniqid().$medical_name.uniqid()).'.'.$medical_file_extension;
                $medical_upload_result  = $file->move($this->patient_uploads_public_url, $medical_file_name);

                $entitle_arr['affect_area_img']  = $medical_file_name;    
              /*}
            }*/
        }

        $entitle_arr['card_no']        = $request->card_no;

        $count = $this->UserEntitlementModel->where('user_id' , $patient_id)
                                            ->where('entitlement_id', $request->entitlement_id)
                                            ->count();
        if($count > 0)
        {
          $entitle_res = $this->UserEntitlementModel->where('user_id', $patient_id)
                                                    ->where('entitlement_id', $request->entitlement_id)
                                                    ->update($entitle_arr);  

          $arr_response['msg'] = 'Entitlement details saved Successfully'; 
        }               
        else
        {
          $entitle_arr['user_id']        = $patient_id;
          $entitle_arr['entitlement_id'] = $request->entitlement_id;
           
          $entitle_res = $this->UserEntitlementModel->create($entitle_arr);

          if($entitle_res)
          {
             $arr_response['msg'] = 'Entitlement details saved Successfully'; 
          }
          else
          {
             $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
          }

        }
        
        return response()->json($arr_response);

    }

      /*--------------------------------------------------------------------------
                    ENTITLEMENT - DELETE
      -----------------------------------------------------------------------------*/

    public function delete_entitlement_details(Request $request)
    {
      
      $img_delete = $this->UserEntitlementModel->where('id' , $request->id)
                                                 ->select('affect_area_img')
                                                 ->first();
      
      $res = $this->UserEntitlementModel->where('id',$request->id)
                                        ->delete();
      if($res)
      {

        if($img_delete)
        {
          $img = $img_delete->toArray();

          $delete_img = isset($img['affect_area_img']) ? $img['affect_area_img'] : '';

           if($delete_img!='' && File::exists($this->patient_uploads_public_url.$delete_img))                                
           {
              @unlink($this->patient_uploads_public_url.$delete_img);
           }

        }

        $arr_response['msg'] = 'Entitlement deleted successfully';
      }
      else
      {
        $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
      }                                        

      return response()->json($arr_response);

    }

    /*--------------------------------------------------------------------------
                                  MEDICATION - DELETE
    ----------------------------------------------------------------------------*/

    public function delete_medication(Request $request)
    {
      $medication_id = base64_decode($request->id);

      $medication_presc = $this->MedicationPrescriptionModel->where('medication_id' , $medication_id)->get();

      if(isset($medication_presc) && !empty($medication_presc))
      {
          $medication_presc_arr = $medication_presc->toArray();

          foreach($medication_presc_arr as $val)
          {  
              if($val['uploaded_file'] != '' && File::exists($this->prescription_img_base_path.$val['uploaded_file']))
              {
                @unlink($this->prescription_img_base_path.$val['uploaded_file']);
              }
          }

          $del_medi_presc = $this->MedicationPrescriptionModel->where('medication_id', $medication_id)->delete();
      }

      $medication_img = $this->MedicationImagesModel->where('medication_id' , $medication_id)->get();

      if(isset($medication_img) && !empty($medication_img))
      {
          $medication_img_arr = $medication_img->toArray();

          foreach($medication_img_arr as $val)
          {  
              if($val['file'] != '' && File::exists($this->medication_img_base_path.$val['file']))
              {
                 @unlink($this->medication_img_base_path.$val['file']);
              }
          }

          $this->MedicationImagesModel->where('medication_id', $medication_id)->delete();
      }

      
      $res = $this->MedicationModel->where('id' , $medication_id)->delete();
     
      if($res)
      {
        $arr_response['msg'] = 'Medication delated successfully';
      }
      else
      {
        $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
      }

      return response()->json($arr_response);
    }

    /*--------------------------------------------------------------------------
                                  PRESCRIPTION - DELETE
    ----------------------------------------------------------------------------*/

    public function delete_prescription(Request $request)
    {
      $prescription_id = $request->id;

      $medication_presc = $this->MedicationPrescriptionModel->where('id' , $prescription_id)->get();

      if(isset($medication_presc) && !empty($medication_presc))
      {
          $medication_presc_arr = $medication_presc->toArray();

          foreach($medication_presc_arr as $val)
          {  
              if($val['uploaded_file'] != '' && File::exists($this->prescription_img_base_path.$val['uploaded_file']))
              {
                @unlink($this->prescription_img_base_path.$val['uploaded_file']);
              }
          }
      }

      $res = $this->MedicationPrescriptionModel->where('id', $prescription_id)->delete();

      if($res)
      {
        $arr_response['msg'] = 'Digital prescription delated successfully';
      }
      else
      {
        $arr_response['msg'] = 'Something went to wrong ! Please try again later.';
      }

      return response()->json($arr_response);

    }

    public function patient_history_view(Request $request)
    {
      $patient_id = base64_decode($request->input('patient_id'));
      $doctor_id   = $this->user_id;
      
      $user        = Sentinel::check();
      $doctor_fname = $user->first_name;
      $doctor_lname = $user->last_name;

      $view_array   = [];
      $view_array['patient_id'] = $patient_id;
      $view_array['doctor_id']  = $doctor_id;

      if($request->input('entitlement_name')!=""){
         //$view_array['action']     = ' has downlod your '.$request->input('entitlement_name').' entitlement';
        $view_array['action']     = ' has downloaded your details and entitlement information';
      }
      else{
         if($request->input('page') == 'medical_history'){
           $view_array['action']     = ' has viewed your medical history';
         } else if($request->input('page') == 'patient_details'){
           $view_array['action']     = ' has viewed your patient details';
         }
      }

      $view_array['is_read']    = 'no';

      $insert = \DB::table('dod_view_patient')->insertGetId($view_array);

      if($insert){
        echo "done";
      }else{
        echo 'error';
      }
    }


    /*--------------------------------------------------------------------------
                      PATIENT - CHANGE PROFILE TYPE(DOCTOROO, MYOWN)
    ----------------------------------------------------------------------------*/

    public function change_profile_type($enc_patient_id = false, $enc_doctor_id = false, $enc_type = false )
    {
      
      if($enc_patient_id && $enc_doctor_id && $enc_type)
      {
          $patient_profile_type = base64_decode($enc_type);
          if($patient_profile_type == 'doctoroo')
          {
            $created_by = '0';
          }
          else
          {
            $created_by = base64_decode($enc_doctor_id);
          }

          $upd_arr['type'] = $patient_profile_type;
          $upd_arr['created_by'] = $created_by;
          $res = $this->PatientModel->where('user_id' , base64_decode($enc_patient_id))
                             ->update($upd_arr);
          if($res)
          {
            $status = 'success';
            $message = 'Your profile type changed successfully';
            
          }                             
          else
          {
            $status = 'error';
            $message = 'Something went to wrong ! Please try again later.';
          }
          $this->arr_view_data['status'] = $status; 
          $this->arr_view_data['message'] = $message; 

          return view('front.doctor.verification_status')->with($this->arr_view_data);

      } 
    }  
   
}
?>