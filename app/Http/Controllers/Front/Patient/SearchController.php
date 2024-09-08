<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\FamilyMemberModel;
use App\Models\TempConsultationBookingModel;
use App\Models\TempConsultationBookingImagesModel;
use App\Models\PatientConsultationImagesModel;
use App\Models\PatientTempPrescriptionQuestionsModel;
use App\Models\PatientPrescriptionQuestionsModel;
use App\Models\TempPatientMedicationQuestionsModel;
use App\Models\PatientMedicationQuestionsModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\SpecialityModel;
use App\Models\LanguageModel;
use App\Models\PricingNoteModel;
use App\Models\PricingTableModel;
use App\Models\DoctorModel;
use App\Models\DoctorPreferencesModel;
use App\Models\AvailabilityModel;
use App\Models\NotificationModel;
use App\Common\Services\EmailService;
use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;
use DB;
use Input;

class SearchController extends Controller
{

    public function __construct(UserModel $UserModel,PatientModel $PatientModel,EmailService $EmailService,FamilyMemberModel $FamilyMemberModel, TempConsultationBookingModel $TempConsultationBookingModel,TempConsultationBookingImagesModel $TempConsultationBookingImagesModel,PatientTempPrescriptionQuestionsModel $PatientTempPrescriptionQuestionsModel,TempPatientMedicationQuestionsModel $TempPatientMedicationQuestionsModel,SpecialityModel $SpecialityModel, LanguageModel $LanguageModel , PricingNoteModel $PricingNoteModel,PricingTableModel $PricingTableModel,DoctorModel $DoctorModel,DoctorPreferencesModel $DoctorPreferencesModel,AvailabilityModel $AvailabilityModel,PatientConsultationBookingModel $PatientConsultationBookingModel,PatientPrescriptionQuestionsModel $PatientPrescriptionQuestionsModel,PatientMedicationQuestionsModel $PatientMedicationQuestionsModel,PatientConsultationImagesModel $PatientConsultationImagesModel,NotificationModel $notification_model)
    {	
    	$this->arr_view_data[]    =  [];
    	$this->UserModel	      =	 $UserModel;
        $this->PatientModel       =  $PatientModel;
        $this->FamilyMemberModel  =  $FamilyMemberModel;
        $this->TempConsultationBookingModel         = $TempConsultationBookingModel;
        $this->TempConsultationBookingImagesModel   = $TempConsultationBookingImagesModel;
        $this->PatientTempPrescriptionQuestionsModel= $PatientTempPrescriptionQuestionsModel;
        $this->TempPatientMedicationQuestionsModel  = $TempPatientMedicationQuestionsModel;
        $this->PatientMedicationQuestionsModel      = $PatientMedicationQuestionsModel;
        $this->PatientConsultationBookingModel      = $PatientConsultationBookingModel;
        $this->PatientPrescriptionQuestionsModel    = $PatientPrescriptionQuestionsModel;
        $this->PatientConsultationImagesModel       = $PatientConsultationImagesModel;
        $this->SpecialityModel    =  $SpecialityModel;
        $this->LanguageModel      =  $LanguageModel;
        $this->PricingTableModel  =  $PricingTableModel;
        $this->PricingNoteModel   =  $PricingNoteModel;
        $this->DoctorModel        =  $DoctorModel;
        $this->NotificationModel      =  $notification_model;
        $this->DoctorPreferencesModel = $DoctorPreferencesModel;
        $this->AvailabilityModel  =  $AvailabilityModel;
        $this->EmailService       =  $EmailService;
    	$this->module_view_folder = 'front.patient.search';
        $this->health_issue_base_img_path           = public_path().config('app.project.img_path.health_issue_img_path');
        $this->health_issue_base_img_public_path    = url('/public').config('app.project.img_path.health_issue_img_path');
        $this->prescription_base_img_path           =  public_path().config('app.project.img_path.prescription_img');
        $this->prescription_base_img_public_path    = url('/public').config('app.project.img_path.prescription_img');
        $this->doc_profile_img_public_path          = url('/public').config('app.project.img_path.doctor');
        $this->doc_profile_img_base_path            = public_path().config('app.project.img_path.doctor');
        $this->doctor_video_path                    = url('/public').config('app.project.img_path.doctor_video');
        $this->client = \Eway\Rapid::createClient(config('services.EWAY')['API_KEY'] ,config('services.EWAY')['API_PASSWORD'],\Eway\Rapid\Client::MODE_SANDBOX);
    }	

    public function step_1_who_is_patient()
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }
        
        $show_popup = 1;

        $this->arr_view_data['arr_pricing'] =$this->arr_view_data['family_members'] = array();
        $user_id = $user->id;
        $this->arr_view_data['page_title'] = 'Who is patient';
        $arr_family_mem = $this->FamilyMemberModel->where('user_id',$user_id)->get();
        if($arr_family_mem)
        {
            $this->arr_view_data['family_members'] = $arr_family_mem;
        }
        $pricing_tbl  = $this->PricingTableModel->get();
        if($pricing_tbl)
        {
            $this->arr_view_data['arr_pricing'] =  $pricing_tbl->toArray();
        }
        $pricing_note = $this->PricingNoteModel->get();
        if($pricing_note)
        {
            $this->arr_view_data['arr_pricing_notes'] =  $pricing_note->toArray();
        }
        ##chk for profile is filled or not
        $user_info = $this->UserModel->where('id',$user->id)->first();
        if($user_info)
        {
            $user_arr = $user_info->toArray();
            if(count($user_arr)>0)
            {
                if($user_arr['title']=='')
                {
                    $show_popup = 1;
                }
                else
                {
                    $show_popup = 0;
                }
            }
        }
        $this->arr_view_data['show_popup'] = $show_popup;
        return view($this->module_view_folder.'.step_1_who_is_patient',$this->arr_view_data);
    }

    public function store_step_1_who_is_patient(Request $request)
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }
        $form_data = $request->all();
        Session::set('booking_patient_id',$form_data['selector']);
        Session::set('booking_visitor_id',uniqid());
        return redirect('/search/doctor/what-are-you-seeking-from-doctor');
    }

    public function step_2_what_are_you_seeking_from_doctor()
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }
        $booking_patient_id = Session::get('booking_patient_id');
        if($booking_patient_id=='')
        {
            return redirect('/search/doctor/who-is-patient');
        }

        $this->arr_view_data['arr_booking'] = $this->arr_view_data['arr_booking_images'] = array();
        $this->arr_view_data['page_title'] = 'What are you seeking from the doctor?';
        ##--> if record already in process and in database
        $exist_rec  =    $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->get();
        if($exist_rec)
        {
            $this->arr_view_data['arr_booking'] = $exist_rec->toArray();
        }  
        $exist_rec_images  =    $this->TempConsultationBookingImagesModel->where('temp_booking_id',Session::get('temp_booking_id'))->get();
        if($exist_rec_images)
        {
            $this->arr_view_data['arr_booking_images'] = $exist_rec_images->toArray();
        }    
        $this->arr_view_data['health_issue_base_img_public_path'] =    $this->health_issue_base_img_public_path;    
        return view($this->module_view_folder.'.step_2_what_are_you_seeking_from_doctor',$this->arr_view_data);
    }

    public function store_step_2_what_are_you_seeking_from_doctor(Request $request)
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='')
        {
            return redirect('/search/doctor/who-is-patient');
        }

        $arr_rules['health_issue'] = 'required';
        $form_data  =   $request->all();
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please enter your health issue');
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $str_consultation_for = '';
        if(count($form_data['selector'])>0)
        {
            $str_consultation_for = implode(',',$form_data['selector']);
        }

        $arr_data['user_id']            = $user->id;
        $arr_data['family_member_id']   = Session::get('booking_patient_id');
        $arr_data['visitor_id']         = Session::get('booking_visitor_id');
        $arr_data['health_issue']       = $form_data['health_issue'];
        $arr_data['consultation_for']   = $str_consultation_for;
        $arr_data['signup_type']        = "FULL";
        if(Session::get('temp_booking_id')!='' && Session::get('temp_booking_id')!='0')
        {
            Session::set('signup_type','FULL');
            $exist = $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->get();  
            
            if(count($exist)>0)
            {
                $updt_rec = $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->update($arr_data);   
                $result = $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->get(); 
                $res = $result->toArray();
                $booking_id  = $res[0]['booking_id'];
            }
            else
            {
                $res = $this->TempConsultationBookingModel->create($arr_data);
                $booking_id = $res->booking_id;
            }
        }
        else
        {
            $res = $this->TempConsultationBookingModel->create($arr_data);
            $booking_id = $res->booking_id;
        }
        
        if($res)
        {
            $files = $request->file('profile_image');            
            Session::set('temp_booking_id',$booking_id);
            Session::set('consultation_for', $str_consultation_for);

            if(count($files)>0 && $request->hasFile('profile_image'))
            {
                foreach ($files as $key => $img_file) 
                {
                    if($img_file!='')
                    {
                        $fileExtension = strtolower($img_file->getClientOriginalExtension());
                        if(in_array($fileExtension,['png','gif','jpeg','jpg','pdf']))
                        {   
                            $filename = rand(1111,9999);
                            $fileExt = $img_file->getClientOriginalExtension();
                            $fileName = sha1(uniqid().$filename.uniqid()).'.'.$fileExt;
                            $upload_success = $img_file->move($this->health_issue_base_img_path, $fileName);

                            $arr_images = array();
                            $arr_images['user_id']          =  $user->id;
                            $arr_images['family_member_id'] =  Session::get('booking_patient_id');
                            $arr_images['temp_booking_id']  =  $booking_id;
                            $arr_images['health_image']     =  $fileName;

                            $this->TempConsultationBookingImagesModel->create($arr_images);
                        }
                    }
                }
            }

            if($str_consultation_for!='')
            {
                $arr_consultation_for = explode(',',$str_consultation_for);
                if(in_array('All',$arr_consultation_for) || in_array('prescription',$arr_consultation_for))
                {
                    Flash::success('We’ve saved step 1. If you know which prescription you want, complete the following page. ');
                    return redirect('/search/doctor/prescription/questions');
                }
                 else if(in_array('All',$arr_consultation_for) || in_array('medical_certificate',$arr_consultation_for))
                {
                    Flash::success('Please fill the following form for Medical certificate');
                    return redirect('/search/doctor/medical-history/questions');
                }
                else if(in_array('advice_and_treatement',$arr_consultation_for))
                {
                    Flash::success('Your health issue is records successfully.');
                    return redirect('/search/doctor/more-precise');
                }                
            }
            else
            {
                Flash::error('Some thing got wrong. Please try again');
                return redirect('/search/doctor/who-is-patient');
            }
        }
        else
        {
            Flash::error('Error while submiting health conditions.');
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }
    }

    public function step_3A_prescription_questions()
    {
        $user = Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='' || Session::get('consultation_for')=='')
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $this->arr_view_data['page_title']  =   'Prescription Questions';
        $this->arr_view_data['family_members'] = $this->arr_view_data['pres_ques_info'] = array();
        $arr_family_mem = $this->FamilyMemberModel->where('user_id',$user->id)->get();
        if($arr_family_mem)
        {
            $this->arr_view_data['family_members'] = $arr_family_mem;
        }
        $pres_ques = $this->PatientTempPrescriptionQuestionsModel->where('temp_booking_id',Session::get('temp_booking_id'))->where('user_id',$user->id)->get();
        if($pres_ques)
        {
            $this->arr_view_data['pres_ques_info'] = $pres_ques->toArray();
        }
        return view($this->module_view_folder.'.step_3A_prescription_questions',$this->arr_view_data);
    }

    public function store_step_3A_prescription_questions(Request $request)
    {
        $user = Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='' || Session::get('consultation_for')=='')
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $arr_rules = array();
        
        if($request->input('currently_taking_medications','')=='')
        {       
            $arr_rules["other_info"]                        =   "required";
            $arr_rules["what_is_medications"]               =   "required";
            $arr_rules["how_long_medications"]              =   "required";
        }     

        $messages = array(
                    'other_info.required'=>'Please enter any other information regarding your health',
                    'what_is_medications.required'=>'please enter What kind of medications you are taking?',
                    'current_prescription_upload.required'=>'Please upload prescription',
                    'how_long_medications.required'=>'Please enter how long you are taking these medications?'
                    );

        $validator = Validator::make($request->all(),$arr_rules,$messages);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            
        $form_data  =   $request->all();

        if($request->hasFile('current_prescription_upload'))
        {
            $current_prescription_upload = $request->file('current_prescription_upload');

            if($current_prescription_upload!='' && count($current_prescription_upload)>0)
            {
                $extention  =   strtolower($current_prescription_upload->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                if(!in_array($extention, $valid_ext))
                {
                    Flash::error('Please upload valid image with valid extension i.e jpg,png,jpeg,bmp');
                    return redirect()->back()->withInput($request->all());
                }
                else
                {
                    @unlink($this->prescription_base_img_path.$request->input('old_current_prescription_upload'));
                    $file_name      = $request->file('current_prescription_upload');
                    $file_extension = strtolower($request->file('current_prescription_upload')->getClientOriginalExtension()); 
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $upload_result  = $request->file('current_prescription_upload')->move($this->prescription_base_img_path, $file_name);
                    $arr_data["current_prescription_upload"]       =   $file_name;
                }
            }
        }
        $arr_data['family_member_id']                   = Session::get('booking_patient_id');
        $arr_data['who_is_patient']                     = Session::get('booking_patient_id');
        $arr_data['temp_booking_id']                   =   Session::get('temp_booking_id');
        $arr_data["currently_taking_medications"]      =   $request->input('currently_taking_medications','');
        $arr_data["other_info"]                        =   $form_data['other_info'];
        $arr_data["what_is_medications"]               =   $form_data['what_is_medications'];
        $arr_data["how_long_medications"]              =   $form_data['how_long_medications'];
        $arr_data["user_id"]                           =   $user->id;
        
       
        $pres_ques = $this->PatientTempPrescriptionQuestionsModel->where('temp_booking_id',Session::get('temp_booking_id'))->where('user_id',$user->id)->count();
        
        if($pres_ques)
        {
            $res = $this->PatientTempPrescriptionQuestionsModel->where('temp_booking_id',Session::get('temp_booking_id'))->where('user_id',$user->id)->update($arr_data);
        }
        else
        {
            $res = $this->PatientTempPrescriptionQuestionsModel->create($arr_data);
        }
        
        if($res)
        {
            Flash::success('Prescription details updated successfully. Please follow the few steps.');
            if(Session::get('consultation_for')!='')
            {
                $arr_consultation_for = explode(',',Session::get('consultation_for'));
                if(in_array('All',$arr_consultation_for))
                {
                    return redirect('/search/doctor/medical-history/questions');
                }
                else
                {
                    return redirect('/search/doctor/more-precise');
                }            
            }
        }
        else
        {
            Flash::error('Error while submitting prescription details. Please try again.');
            return redirect()->back();
        }

    }

    public function step_3B_medical_certificate_questions()
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='' || Session::get('consultation_for')=='')
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $this->arr_view_data['page_title']  =   'Medical Certificate Questions';
        $this->arr_view_data['family_members'] = $this->arr_view_data['medi_ques_info'] = array();
        $arr_family_mem = $this->FamilyMemberModel->where('user_id',$user->id)->get();
        if($arr_family_mem)
        {
            $this->arr_view_data['family_members'] = $arr_family_mem;
        }
        $pres_ques = $this->TempPatientMedicationQuestionsModel->where('temp_booking_id',Session::get('temp_booking_id'))->where('user_id',$user->id)->get();
        if($pres_ques)
        {
            $this->arr_view_data['medi_ques_info'] = $pres_ques->toArray();
        }
        return view($this->module_view_folder.'.step_3B_medical_history_questions',$this->arr_view_data);
    }

    public function store_3B_medical_certificate_questions(Request $request)
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='' || Session::get('consultation_for')=='')
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }
        
        $arr_rules['symptoms_from']     = 'required';
        $arr_rules['certificate_from_date'] = 'required';
        $arr_rules['certificate_to_date']   = 'required';

        $messages=array(
            'who_is_patient.required'       => 'Please select who is Patient',
            'symptoms.required'             => 'Please enter symptoms',
            'symptoms_from.required'        => 'Please enter from which date do you have the symptoms?',
            'certificate_from_date.required'=> 'Please select Certificate from date',
            'certificate_to_date.required'  => 'Please select Certificate to date',
        );
        
        $validator = Validator::make($request->all(),$arr_rules,$messages);
        if($validator->fails())
        {
            return redirect()->Back()->withErrors($validator)->withInput($request->all());
        }

        $form_data = $request->all();

        $arr_data['family_member_id']   = Session::get('booking_patient_id');
        $arr_data['who_is_patient']     = Session::get('booking_patient_id');
        $arr_data['symptoms_from']      = $form_data['symptoms_from'];
        $arr_data['certificate_from_date'] = date('Y-m-d',strtotime($form_data['certificate_from_date']));
        $arr_data['certificate_to_date']= date('Y-m-d',strtotime($form_data['certificate_to_date']));
        $arr_data['user_id']            = $user->id;
        $arr_data['temp_booking_id']    = Session::get("temp_booking_id");

        $count = $this->TempPatientMedicationQuestionsModel->where('temp_booking_id',Session::get("temp_booking_id"))->count();
        if($count>0)
        {
            $res = $this->TempPatientMedicationQuestionsModel->where('temp_booking_id',Session::get("temp_booking_id"))->update($arr_data);
        }
        else
        {
            $res = $this->TempPatientMedicationQuestionsModel->create($arr_data);
        }

        if($res)
        {
            Flash::success('Your all health issues are recorded successfully. Please search for doctor');
            return redirect('/search/doctor/more-precise');
        }
        else
        {
            Flash::success('Error while recording the medications Questions. Please try again later.');
            return redirect()->back();
        }
    }

    public function store_family_member(Request $request)
    {
        
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        $arr_rules['first_name']    = 'required';
        $arr_rules['last_name']     = 'required';
        $arr_rules['day']           = 'required';
        $arr_rules['month']         = 'required';
        $arr_rules['year']          = 'required';
        $arr_rules['relationship']  = 'required';
        $arr_rules['mobile_number'] = 'required';

        $form_data = $request->all();
        
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please fill all fields then submit the form.');
            return redirect('/search/doctor/who-is-patient');
        }

        if($form_data['account_action']=="add_to_this_account" || $form_data['account_action']=="")
        {
            $arr_data['first_name']     = $form_data['first_name'];
            $arr_data['last_name']      = $form_data['last_name'];
            $arr_data['gender']         = $form_data['gender'];
            $arr_data['date_of_birth']  = date('Y-m-d',strtotime($form_data['day']."-".$form_data['month']."-".$form_data['year']));
            $arr_data['relationship']   = $form_data['relationship'];
            $arr_data['mobile_number']  = $form_data['mobile_number'];
            $arr_data['user_id']        = $user->id;

            $res = $this->FamilyMemberModel->create($arr_data);
            if($res)
            {
                $family_member_id = $res->id;
                Session::set('booking_patient_id',$family_member_id);
                Flash::success($form_data["first_name"].' has been added successfully. You can now continue with searching for and booking a Doctor.');
                if(Session::get('signup_type')=='FAST')
                {
                    return redirect('/search/doctor/who-is-patient/fast?'.$request->getQueryString());  
                }
                else
                {
                    return redirect('/search/doctor/who-is-patient');
                }
            }
            else
            {
                Flash::error('Error while adding new family member. Please refresh the page and try again.');
                return redirect('/search/doctor/who-is-patient');
            }
        }
        else
        {
            Sentinel::logout();
            return redirect('/home');
        }
    }

    public function booking_images($image_id)
    {
        if($image_id)
        {
            $image_res = $this->TempConsultationBookingImagesModel->where('id',$image_id)->get();
            $res = $this->TempConsultationBookingImagesModel->where('id',$image_id)->delete();
            if($res)
            {
                $arr_img = $image_res->toArray();
                unlink($this->health_issue_base_img_path.$arr_img[0]['health_image']);
                echo 'success';
            }
            else
            {
                echo 'error';
            }
        }
    }

    public function download_precription($file_name)
    {
        return response()->download($this->prescription_base_img_path.$file_name); 
    }

    public function step_4_more_precise_doctor()
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        if(Session::get('booking_patient_id')=='' || Session::get('booking_visitor_id')=='' || Session::get('consultation_for')=='')
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $this->arr_view_data['page_title'] = 'Search More precise doctor';
        $spec_res = $this->SpecialityModel->where('speciality_status','Active')->get();
        if($spec_res)
        {
            $this->arr_view_data['speciality'] = $spec_res->toArray();
        }
        $this->arr_view_data['page_title'] = 'Search More precise doctor';
        $lang_res = $this->LanguageModel->where('language_status','1')->get();
        if($lang_res)
        {
            $this->arr_view_data['languages'] = $lang_res->toArray();
        }
        return view($this->module_view_folder.'.step_4_more_precise_doctor',$this->arr_view_data);
    }

    public function search_more_precise(Request $request)
    {
        
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }
        
        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }
        
        $spec_res = $this->SpecialityModel->where('speciality_status','Active')->get();
        if($spec_res)
        {
            $this->arr_view_data['speciality'] = $spec_res->toArray();
        }
        $this->arr_view_data['page_title'] = 'Search More precise doctor';
        $lang_res = $this->LanguageModel->where('language_status','1')->get();
        if($lang_res)
        {
            $this->arr_view_data['languages'] = $lang_res->toArray();
        }
        
        
        if($request->specific_doctor=='Yes')
        {
            $doctor_arr = $this->search_specific($request);
            $this->arr_view_data['doctor_video_path'] = $this->doctor_video_path;
            $this->arr_view_data['doc_profile_img_public_path'] = $this->doc_profile_img_public_path;
            $this->arr_view_data['doc_profile_img_base_path'] = $this->doc_profile_img_base_path;            
            $this->arr_view_data['available_doctor_arr'] = $doctor_arr['available_doctor_arr'];
            $this->arr_view_data['next_doctor_arr']      = $doctor_arr['next_doctor_arr'];
            return view($this->module_view_folder.'.step_5A_search_specific_doctor',$this->arr_view_data);
        }
        else
        {
            $this->arr_view_data['page_title'] = 'Search Suitable Doctor';        
            $this->arr_view_data['suitable_doctor'] = $this->search_suitable($request);
            return view($this->module_view_folder.'.step_5B_search_suitable_doctor',$this->arr_view_data);
        }
    }

    public function validate_input($input)
    {
        $input = urldecode($input);
        $input = str_replace(' ','',$input);
        $input = urlencode($input);
        return $input;
    }

    public function search_specific(Request $request)
    {
        $doctor_arr = $available_doctor_arr = $next_doctor_arr = array();
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $form_data = $request->all();
        $language = $form_data['language'];
        $gender = $form_data['gender'];
        $this->arr_view_data['page_title'] = 'Search Specific Doctor';
        $date = date('Y-m-d',strtotime($request->available_date));
        $this->arr_view_data['date']=$date;
        $obj_doctor_preferece  = $this->DoctorPreferencesModel;
        $curr_time = date('H:i');
        //DB::enableQueryLog();
        $avi_result =   $this->UserModel->whereHas('doctor_details',function($q) use($gender,$language) 
                                        {
                                            if($gender!='Any')
                                            {
                                                $q->where('gender',$gender);
                                                $q->where('verification_status',1);
                                                $q->where('user_status','Active');
                                            }
                                            $q->where('language_spoken',$language);
                                            $q->select('user_id','id');
                                        })
                                        ->whereHas('doctor_availability', function ($que) use($request,$date,$curr_time) { 
                                            
                                            $que->whereRaw('("'.convert_12_to_24($request->available_time).'" BETWEEN start_time and end_time AND date = "'.$date.'" AND  "'.convert_12_to_24($request->available_time).'" > "'.$curr_time.'")') ;
                                            $que->orWhereRaw('("'.convert_12_to_24($request->available_time).'" < start_time AND "'.convert_12_to_24($request->available_time).'" < end_time AND date = "'.$date.'" AND  "'.convert_12_to_24($request->available_time).'" > "'.$curr_time.'")'); 
                                            $que->orderBy('start_time','ASC');
                                        })
                                        ->with(['doctor_availability'=>function($query) use($request,$date,$curr_time){

                                            //$query->where('date','=',$date);
                                            $query->whereRaw('("'.convert_12_to_24($request->available_time).'" BETWEEN start_time and end_time AND date = "'.$date.'" AND  "'.convert_12_to_24($request->available_time).'" > "'.$curr_time.'")') ;
                                            $query->orWhereRaw('("'.convert_12_to_24($request->available_time).'" < start_time AND "'.convert_12_to_24($request->available_time).'" < end_time AND date = "'.$date.'" AND  "'.convert_12_to_24($request->available_time).'" > "'.$curr_time.'")'); 
                                            $query->orderBy('start_time','ASC');
                                        },'doctor_details'])
                                        ->get();
                                        
        if($avi_result)
        {
            $available_doctor_arr = $avi_result->toArray();
        }
        

        $nxt_result =  $this->UserModel->whereHas('doctor_details',function($q) use($gender,$language) 
                                        {
                                            if($gender!='Any')
                                            {
                                                $q->where('gender',$gender);
                                            }
                                            $q->where('language_spoken',$language);
                                            $q->where('verification_status',1);
                                            $q->where('user_status','Active');
                                            $q->select('user_id','id');
                                        })
                                        ->whereHas('doctor_availability', function ($query) use($request,$date)
                                        {
                                            $query->where('date','>',$date);
                                            $query->take(2);
                                            $query->orderBy('start_time','ASC');
                                        })
                                        ->with(['doctor_availability'=>function ($query1) use($request,$date)
                                        {
                                            $query1->where('date','>',$date);
                                            //$query1->take(2);
                                            $query1->orderBy('start_time','ASC');
                                        },'doctor_details'])
                                        ->get();

        if($nxt_result)
        {
            $next_doctor_arr = $nxt_result->toArray();
        }
        $doctor_arr = array('available_doctor_arr'=>$available_doctor_arr,'next_doctor_arr'=>$next_doctor_arr);
        return $doctor_arr;
    }

    public function search_suitable()
    {
        $user   =   Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $today  = date('Y-m-d');
        $curr_time = date('H:i');
        
        $get_suit_dates = $this->UserModel->whereHas('doctor_details',function(){})
                                    ->with('doctor_details')
                                    ->whereHas('doctor_availability',function($q) use($today) {
                                        $q->where('date','>=',$today);
                                        $q->distinct('date');
                                        $q->select('user_id','date');
                                    })
                                    ->with(['doctor_availability'=>function($qry) use($today) {
                                        $qry->where('date','>=',$today);                                                            
                                        $qry->distinct('date');
                                        $qry->select('user_id','date');
                                    }])
                                    ->where('verification_status',1)
                                    ->where('user_status','Active')
                                    ->get();
        if($get_suit_dates)
        {
            $get_suit_dates_arr = $get_suit_dates->toArray();
        }
       
        $get_suit = $this->UserModel->whereHas('doctor_details',function(){})
                                    ->with('doctor_details')
                                    ->whereHas('doctor_availability',function($q) use($today,$curr_time) {
                                        $q->where('date','=',$today);
                                        $q->whereRaw('(("'.$curr_time.'" BETWEEN start_time AND end_time) OR ("'.$curr_time.'" <= start_time AND "'.$curr_time.'" <= end_time))');
                                    })
                                    ->with(['doctor_availability'=>function($qry) use($today,$curr_time) {
                                        $qry->where('date','=',$today);                                                                                
                                        $qry->whereRaw('(("'.$curr_time.'" BETWEEN start_time AND end_time) OR ("'.$curr_time.'" <= start_time AND "'.$curr_time.'" <= end_time))');
                                    }])
                                    ->where('verification_status',1)
                                    ->where('user_status','Active')
                                    ->get();

        if($get_suit)
        {
            $get_suit_arr = $get_suit->toArray();
        }
        $sui_doctor_arr = array('suit_doctor_arr'=>$get_suit_arr,'get_suit_dates_arr'=>$get_suit_dates_arr);
        return $sui_doctor_arr;
    }

    public function get_availability(Request $request)
    {
        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $str_slots = $str_nxt_slots = '';
        $available_doctor_arr = $arr_slots = $narr_slots = $main =array();
        $doctor_id = $request->input('doctor_id');
        $day_type = $request->input('day_type');
        $date = date('Y-m-d',strtotime($request->available_date));
        $nxt_date = date('Y-m-d',strtotime('+1 day',strtotime($request->available_date)));
        $nxt_day_date = date('Y-m-d',strtotime('+1 day',strtotime($nxt_date)));
        $curr_time = Date('H:i');
        $time_diff = '';
        //echo $request->available_time." < ".$curr_time;
        if($request->available_time > $curr_time)
        {
            if($day_type!='' & $doctor_id!='')
            {
                $arr_allocated_times = array();
                if($day_type=='today' && $doctor_id!='')
                {
                    //DB::enableQueryLog();
                    $get_allocated_times = $this->PatientConsultationBookingModel->where('consultation_date',date('Y-m-d'))->where('consultation_time','>',convert_12_to_24(date('H:i')))->select('consultation_time')->get();
                    if($get_allocated_times)
                    {
                        $arr_allocated_times = $get_allocated_times->toArray();
                    }
                    //DB::enableQueryLog();
                    $avi_result =   $this->AvailabilityModel
                                         //->where('user_id',$doctor_id)
                                         ->whereRaw('("'.convert_12_to_24($request->available_time).'" BETWEEN start_time and end_time AND date = "'.$date.'" AND user_id="'.$doctor_id.'" )') 
                                         ->orWhereRaw('("'.convert_12_to_24($request->available_time).'" < start_time AND "'.convert_12_to_24($request->available_time).'" < end_time AND date = "'.$date.'" AND user_id="'.$doctor_id.'" )')
                                         ->orderBy('start_time','ASC')
                                         ->get();
                        if($avi_result)
                        {
                            $available_doctor_arr = $avi_result->toArray();
                            foreach ($available_doctor_arr as $avi_value) 
                            {     
                                $arr_slots = create_time_slots($avi_value['start_time'],$avi_value['end_time'],'today',$arr_slots);    
                            }
                        }
                        if(count($arr_slots)>0)
                        {
                            $style ='';
                            foreach ($arr_slots as $slots) 
                            {   
                                if(count($arr_allocated_times)>0)
                                {
                                    foreach ($arr_allocated_times as $tvalue) 
                                    {
                                        
                                        $t2value = date("H:i",strtotime("+5 minutes",strtotime($tvalue['consultation_time'])));
                                        //echo '<br />'.convert_12_to_24($slots).'=='.$tvalue['consultation_time'].' || '.convert_12_to_24($slots).'=='.$t2value ;
                                        if(convert_12_to_24($slots)==convert_12_to_24($tvalue['consultation_time']) || convert_12_to_24($slots)==convert_12_to_24($t2value) )
                                        {
                                            $style = "style='background-color:#aeaeae !important; color:#ffffff !important;'";
                                        }
                                    }
                                }
                                ?>
                                <a <?php echo $style; ?> href="javascript:void(0);" class="grn-time <?php if($style==''){ ?>assign_confirm_time <?php } ?>" data-doctor-id="<?php echo $doctor_id; ?>" data-date="<?php echo date('l d M',strtotime($date)); ?>" data-time="<?php echo strtoupper($slots); ?>"><?php echo strtoupper($slots); ?></a>
                             <?php  $style = '';
                             } 
                        }
                        else
                        {
                            $str_slots = '<div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span> No Records Found
                                             </div>';   
                        }
                        return $str_slots;
                }
                else
                {

                    //DB::enableQueryLog();
                    $nxt_result =   $this->AvailabilityModel->whereRaw('((date ="'.$nxt_date.'" OR date = "'.$nxt_day_date.'") AND user_id="'.$doctor_id.'")')
                                                ->orderBy('start_time','ASC') 
                                                ->get();
                    if($nxt_result)
                    {   
                        $nxt_doctor_arr = $nxt_result->toArray(); 
                        foreach ($nxt_doctor_arr as $nxt_value) 
                        {
                            $narr_slots=array();
                            $narr_slots = create_time_slots($nxt_value['start_time'],$nxt_value['end_time'],'next',$narr_slots);
                            if(array_key_exists($nxt_value['date'],$main))
                            {
                                $main[$nxt_value['date']] = array_unique(array_merge($main[$nxt_value['date']],$narr_slots));
                            }
                            else
                            {
                                $main[$nxt_value['date']]=$narr_slots;  
                            }
                        }
                    }
                 
                    if(count($main)>0)
                    { 
                       foreach ($main as $k =>$day_value) 
                       {
                            $str_nxt_slots .= '<div class="day-txtt" style="color:#644e7c;"><strong>'.date('l, d Y',strtotime($k)).'</strong></div>';
                            foreach($day_value as $ars)
                            {
                                if(count($arr_allocated_times)>0)
                                {
                                    foreach ($arr_allocated_times as $tvalue) 
                                    {
                                        $t2value = date("H:i",strtotime("+5 minutes",strtotime($tvalue['consultation_time'])));
                                        //echo '<br />'.convert_12_to_24($slots).'=='.$tvalue['consultation_time'].' || '.convert_12_to_24($slots).'=='.$t2value ;
                                        if(convert_12_to_24($slots)==convert_12_to_24($tvalue['consultation_time']) || convert_12_to_24($slots)==convert_12_to_24($t2value) )
                                        {
                                            $style = 'style="background-color:#aeaeae !important; color:#ffffff !important;"';
                                        }
                                    }
                                }
                                $str_nxt_slots .= '<a '.$style.' href="javascript:void(0);" class="grn-time assign_confirm_time" data-doctor-id="'.$doctor_id.'" data-time="'.strtoupper($ars).'" data-date="'.date('l d M',strtotime($k)).'">'.strtoupper($ars).'</a>';    
                                 $style = '';                
                            } 
                       }
                    } 
                    return $str_nxt_slots;
                }
            }
        }
        else 
        {
            return  $str_slots = '<div class="alert-box error alert alert-warning alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="font-size: 20px;">×</span></button>
                                             <span>Error: </span>Requested time should be greater than current time.
                                             </div>';   
        }
    }
    
    public function get_time_difference($time1, $time2)
    {
        $time1 = strtotime("1980-01-01 $time1");
        $time2 = strtotime("1980-01-01 $time2");
        if ($time2 < $time1) 
        {
            $time2 += 86400;
        }
        return date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
    }

    public function confirm_booking(Request $request)
    {
        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');
        
        if($booking_patient_id!='' || $booking_visitor_id!='' || $consultation_for!='')
        {
            if($request->confirm_date!='' && $request->confirm_time!='' && $request->doctor_id!='')
            {
                $temp_booking_id = Session::get('temp_booking_id');
                if($temp_booking_id!='')
                {   
                    $updt_arr = array('consultation_date'=>date('Y-m-d',strtotime($request->confirm_date)),'consultation_time'=>convert_12_to_24($request->confirm_time),'doctor_id'=>$request->doctor_id);
                    $res = $this->TempConsultationBookingModel->where('booking_id',$temp_booking_id)->update($updt_arr);
                    if($res)
                    {
                        if(Session::get('signup_type')=='FAST')
                        {
                            return redirect('/search/doctor/who-is-patient/fast?'.$request->getQueryString());  
                        }
                        else
                        {
                            return redirect('/search/doctor/checkout?'.$request->getQueryString());   
                        }                        
                    }
                    else
                    {
                        return redirect('/search/doctor/search_more_precise?'.$request->getQueryString());  
                    }
                }
                else
                {
                    return redirect('/search/doctor/who-is-patient1');    
                }
            }
            else
            {
                return redirect('/search/doctor/who-is-patient2');
            }
        }
        else
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }
    }

    public function step_6_checkout(Request $request)
    {
        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            if(Session::get('signup_type')=='FULL')
            {
                return redirect('/search/doctor/what-are-you-seeking-from-doctor');
            }
            else
            {
                return redirect('/search/doctor/who-is-patient/fast?'.$request->getQueryString());  
            }
        }

        $is_valide_time = $this->check_time_before_payment();
        if($is_valide_time===false)
        {
            Flash::error('Consultation time should be greater than Current time');
            return redirect('/search/doctor/search_more_precise?'.$request->getQueryString());  
        }

        $this->arr_view_data['page_title'] = 'Checkout';
        return view($this->module_view_folder.'.step_6_search_checkout',$this->arr_view_data);
    }


    public function store_step_6_checkout(Request $request)
    {
        $booking_patient_id = Session::get('booking_patient_id');
        $booking_visitor_id = Session::get('booking_visitor_id');
        $consultation_for   = Session::get('consultation_for');

        if(!isset($booking_patient_id) || !isset($booking_visitor_id) || !isset($consultation_for))
        {
            return redirect('/search/doctor/what-are-you-seeking-from-doctor');
        }

        $is_valide_time = $this->check_time_before_payment();
        if($is_valide_time===false)
        {
            Flash::error('Consultation time should be greater than Current time');
            return redirect()->back();   
        }

        $form_data = $request->all();
        if(count($form_data)>0)
        {
            $errors = '';
            $arr_price = get_consultation_minute_cost('01:00'); 
            $transaction = [
                'Payment' => [
                    'TotalAmount' =>$arr_price['price'],
                ],
                'TransactionType' => \Eway\Rapid\Enum\TransactionType::PURCHASE,
                'SecuredCardData' => $request->SecuredCardData,
                'Capture'=>false
            ];

            $response = $this->client->createTransaction(\Eway\Rapid\Enum\ApiMethod::DIRECT, $transaction);
            //dd($response->toArray());
            if (!$response->getErrors()) 
            {
                $responce_arr = $response->toArray();
                if($response->TransactionStatus && $response->ResponseCode=='00')
                {   
                    $temp_booking_id    = Session::get('temp_booking_id');
                    $booking_patient_id = Session::get('booking_patient_id');
                    $booking_visitor_id = Session::get('booking_visitor_id');
                    $consultation_for   = Session::get('consultation_for');
                    $signup_type        = ((Session::get('signup_type'))?Session::get('signup_type'):'FULL');  
                    $result             = $this->TempConsultationBookingModel->where('booking_id',$temp_booking_id)->first();
                    if($result)
                    {
                        $res = $result->toArray();
                                          
                        $insert_arr = array(
                        'family_member_id'      => $res['family_member_id'],
                        'patient_user_id'       => $res['user_id'],
                        'doctor_user_id'        => $res['doctor_id'],
                        'visitor_id'            => $res['visitor_id'],
                        'health_issue'          => $res['health_issue'],                        
                        'consultation_for'      => $res['consultation_for'],
                        'consultation_date'     => $res['consultation_date'],
                        'consultation_time'     => $res['consultation_time'],
                        'consultation_charge'   => $responce_arr['Payment']['TotalAmount'],
                        'card_paid_by'          => 'card',
                        'eway_transaction_id'   => $responce_arr['TransactionID'],
                        'booking_status'        => 'Pending',
                        'signup_type'           => $signup_type,
                        'card_number'           => $responce_arr['Customer']['CardDetails']['Number'],
                        'card_name'             => $responce_arr['Customer']['CardDetails']['Name'],
                        'card_exp_month'        => $responce_arr['Customer']['CardDetails']['ExpiryMonth'],
                        'card_exp_year'         => $responce_arr['Customer']['CardDetails']['ExpiryYear'],
                        'card_start_month'      => '00',//$responce_arr['Customer']['CardDetails']['StartMonth'],
                        'card_start_year'       => '00'//,$responce_arr['Customer']['CardDetails']['StartYear']
                        );

                        $insert_res = $this->PatientConsultationBookingModel->create($insert_arr);
                        if($insert_res)
                        {
                            $img_result = $this->TempConsultationBookingImagesModel->where('temp_booking_id',$temp_booking_id)->get();
                            if($img_result)
                            {
                                if(count($img_result)>0)
                                {
                                    foreach ($img_result as $keyvalue) 
                                    {
                                        $im_arr = $keyvalue->toArray();
                                        $res = $this->PatientConsultationImagesModel->create($im_arr);
                                        $del_result = $this->TempConsultationBookingImagesModel->where('id',$keyvalue['id'])->delete();
                                    }
                                }
                            }

                            $pre_result = $this->PatientTempPrescriptionQuestionsModel->where('temp_booking_id',$temp_booking_id)->first();
                            if($pre_result)
                            {
                                $pre_arr = $pre_result->toArray();
                                if(count($pre_arr)>0)
                                {
                                    $preres_arr = $this->PatientPrescriptionQuestionsModel->create($pre_arr);
                                    $del_pre    = $this->PatientTempPrescriptionQuestionsModel->where('temp_booking_id',$temp_booking_id)->delete();
                                }
                            }

                            $med_result = $this->TempPatientMedicationQuestionsModel->where('temp_booking_id',$temp_booking_id)->first();
                            if($med_result)
                            {
                                $med_arr = $med_result->toArray();
                                if(count($med_arr)>0)
                                {
                                    $preres_arr = $this->PatientMedicationQuestionsModel->create($med_arr);
                                    $pre_med_res = $this->TempPatientMedicationQuestionsModel->where('temp_booking_id',$temp_booking_id)->delete();
                                }
                            }

                            $del_res = $this->TempConsultationBookingModel->where('booking_id',$temp_booking_id)->delete();
                            if($del_res)
                            {
                                Session::forget('temp_booking_id');
                                Session::forget('booking_patient_id');
                                Session::forget('booking_visitor_id');
                                Session::forget('consultation_for');
                                Session::forget('signup_type');
                                return redirect('/patient/consultation/confirm');
                            }
                        }
                        else
                        {
                            Flash::error('Something went wrong. Please try again later..');
                            return redirect('/search/doctor/who-is-patient');
                        }
                    }
                    else
                    {
                        Flash::error('Something went wrong. Please try again');
                        return redirect()->back();
                    }
                }
                else
                {
                    return redirect()->back()->withErrors('Invalid Response! Please try again...');
                }
            } 
            else 
            {
                foreach ($response->getErrors() as $error) 
                {
                    $errors .=  "Error: ".\Eway\Rapid::getMessage($error)."<br>";
                }
                return redirect()->back()->withErrors($errors);
            }
        }
        else
        {
            return redirect()->back()->withErrors('Invalid Request! Please try again');
        }
    }

    public function check_time_before_payment()
    {
        $curr_time = date('H:i');
        $temp_booking_id = Session::get('temp_booking_id');
        if($temp_booking_id!='')
        {
            $result = $this->TempConsultationBookingModel->where('booking_id',$temp_booking_id)->first();
            if($result)
            {
                $arr_result = $result->toArray();
                if($arr_result['consultation_time']!='')
                {
                    //$curr_time = date('H:i',strtotime('+10 minutes',strtotime($curr_time)));
                    //echo $curr_time.'<='.$arr_result['consultation_time'];exit;
                    if($curr_time>=$arr_result['consultation_time'])
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                else
                {
                    return true;
                }
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }

    public function consultation_confirm()
    {      
        return view($this->module_view_folder.'.step_7_booking_confirm',$this->arr_view_data);
    }

    public function fast_who_is_patient()
    {
        $user = Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }

        $exist_rec  =    $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->get();
        if($exist_rec)
        {
            $this->arr_view_data['arr_booking'] = $exist_rec->toArray();
        }  
        $arr_family_mem = $this->FamilyMemberModel->where('user_id',$user->id)->get();
        if($arr_family_mem)
        {
            $this->arr_view_data['family_members'] = $arr_family_mem;
        }
        return view($this->module_view_folder.'.fast_who_is_patient_with_health_issue',$this->arr_view_data);
    }

    public function store_fast_who_is_patient(Request $request)
    {
        $user = Sentinel::check();
        if(!$user)
        {
            return redirect('/');
        }        
        //dd($request->all());
        if($request->selector!=null && $request->selector!='' && $request->health_issue!=null && $request->health_issue!='')
        {
            Session::set('booking_patient_id',$request->selector);
            $arr_data['family_member_id']   = $request->selector;
            $arr_data['health_issue']       = $request->health_issue;
            $updt_rec = $this->TempConsultationBookingModel->where('booking_id',Session::get('temp_booking_id'))->update($arr_data); 
            if($updt_rec)
            {
                return redirect('/search/doctor/checkout?'.$request->getQueryString());   
            }
            else
            {
                return redirect('/search/doctor/search_more_precise?'.$request->getQueryString());  
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}