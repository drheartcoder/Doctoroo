<?php
namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\HealthGeneralModel;
use App\Models\HealthConditionModel;
use App\Models\LifeStylelModel;
use App\Models\MedicationModel;
use App\Models\MedicalHistoryUpdatesModel;
use App\Models\DynamicHealthGeneralModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\PatientPrescriptionModel;
use App\Models\MyPharmacyModel;
use App\Models\MedicationPrescriptionModel;
use App\Models\UserEntitlementModel;
use App\Models\EntitlementModel;
use App\Models\ConsultationDocumentsModel;
use App\Models\MedicationCertificateModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\PharmacyListModel;
use App\Models\FamilyMemberModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Session;
use File;
use PDF;

class MyHealthController extends Controller
{
    public function __construct(
                                  HealthGeneralModel              $HealthGeneralModel,
                                  HealthConditionModel            $HealthConditionModel,
                                  LifeStylelModel                 $LifeStylelModel,
                                  MedicationModel                 $MedicationModel,
                                  MedicalHistoryUpdatesModel      $medical_updates_model,
                                  DynamicHealthGeneralModel       $dynamic_general_model,
                                  PatientConsultationBookingModel $consultation_model,
                                  PatientPrescriptionModel        $patient_prescription_model,
                                  MyPharmacyModel                 $my_pharmacy_model,
                                  MedicationPrescriptionModel     $prescription_model,
                                  UserEntitlementModel            $UserEntitlementModel,
                                  EntitlementModel                $EntitlementModel,
                                  ConsultationDocumentsModel      $ConsultationDocumentsModel,
                                  MedicationCertificateModel      $MedicationCertificateModel,
                                  PatientModel                    $PatientModel,
                                  DoctorModel                     $DoctorModel,
                                  FamilyMemberModel               $FamilyMemberModel,
                                  PharmacyListModel               $PharmacyListModel
                                )
    {

        $this->arr_view_data                      = [];
        //$this->NotificationModel                = $NotificationModel;
        $this->HealthGeneralModel                 = $HealthGeneralModel;
        $this->HealthConditionModel               = $HealthConditionModel;
        $this->LifeStylelModel                    = $LifeStylelModel;
        $this->MedicationModel                    = $MedicationModel;
        $this->MedicalHistoryUpdatesModel         = $medical_updates_model;
        $this->DynamicHealthGeneralModel          = $dynamic_general_model;
        $this->PatientConsultationBookingModel    = $consultation_model;
        $this->PatientPrescriptionModel           = $patient_prescription_model;
        $this->MyPharmacyModel                    = $my_pharmacy_model;
        $this->MedicationPrescriptionModel        = $prescription_model;
        $this->UserEntitlementModel               = $UserEntitlementModel;
        $this->EntitlementModel                   = $EntitlementModel;
        $this->ConsultationDocumentsModel         = $ConsultationDocumentsModel;
        $this->MedicationCertificateModel         = $MedicationCertificateModel;
        $this->PatientModel                       = $PatientModel;
        $this->DoctorModel                        = $DoctorModel;
        $this->PharmacyListModel                  = $PharmacyListModel;
        $this->FamilyMemberModel                  = $FamilyMemberModel;

        $this->doctor_image_url                   = url('/public').config('app.project.img_path.doctor_image');

        $this->patient_prescription_public        = public_path().config('app.project.img_path.precription_file');
        $this->patient_prescription               = url('/public').config('app.project.img_path.precription_file');

        $this->prescription_img_base_path         = public_path().config('app.project.img_path.prescription_img');
        $this->prescription_img_public_path       = url('/public').config('app.project.img_path.prescription_img');

        $this->consultation_documents_base_url    = url('/public').config('app.project.img_path.consultation_documents');
        $this->consultation_documents_public_url  = public_path().config('app.project.img_path.consultation_documents');

        $this->module_view_folder                 = 'front.patient.my_health';
        $this->module_url_path                    = url('/').'/patient/my_health';
        $this->module_title                       = "My Health";
    
        $user                                     = Sentinel::check();
        if($user)
        {
            $this->user_id                        = $user->id;
        }
        else
        {
            $this->user_id                        = null;
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 05/12/2017
    | Output    : 
    */

    public function documents_consultation()
    {
      $arr_user = [];
      $user = Sentinel::check();
      if($user!=false)
      {
        $arr_user = $user->toArray();
      }

      $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                           ->orderBy('consultation_datetime', 'DESC')
                                                           ->with('doctor_user_details')
                                                           ->get();
      if($get_consult)
      {
          $consult_arr = $get_consult->toArray();
      }
      

      $new_carr   = [];
      $group_darr = [];
      foreach ($consult_arr as  $value) {
          if(in_array($value['doctor_user_id'], $group_darr)){
          }
          else{
              $new_carr[]     = $value;
              $group_darr[]   = $value['doctor_user_id'];
          }  
      }

      $get_booking_doc = $this->ConsultationDocumentsModel->where('patient_id', $this->user_id)
                                                          ->with('user_data')
                                                          ->orderBy('created_at', 'DESC')
                                                          ->paginate(10);

      if($get_booking_doc)
      {
        $this->arr_view_data['bd_paginate']      = clone $get_booking_doc;
        $this->arr_view_data['booking_document'] = $get_booking_doc->toArray();
      }

      $this->arr_view_data['consultation_documents_base_url']   = $this->consultation_documents_base_url;
      $this->arr_view_data['consultation_documents_public_url'] = $this->consultation_documents_public_url;
      
      $this->arr_view_data['arr_user']                      = $arr_user;
      $this->arr_view_data['consult_arr']                   = $new_carr;
      $this->arr_view_data['page_title']                    = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']               = $this->module_url_path;

      return view($this->module_view_folder.'.documents_consultation',$this->arr_view_data);
    } // end documents_consultation



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function documents_prescription()
    {

      $arr_user = [];
      $user = Sentinel::check();
      if($user!=false)
      {
        $arr_user = $user->toArray();
      }      

      $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                           ->orderBy('consultation_datetime', 'DESC')
                                                           ->with('doctor_user_details')
                                                           ->get();
      if($get_consult)
      {
          $consult_arr = $get_consult->toArray();
      }
      

      $new_carr   = [];
      $group_darr = [];
      foreach ($consult_arr as  $value) {
          if(in_array($value['doctor_user_id'], $group_darr)){
          }
          else{
              $new_carr[]     = $value;
              $group_darr[]   = $value['doctor_user_id'];
          }  
      }

      $prescription_obj = $this->MedicationPrescriptionModel->where('patient_id', $this->user_id)
                                                            ->with('userinfo','doctor_details')
                                                            ->orderBy('file_added_on','DESC')
                                                            ->paginate(10);

      if($prescription_obj)
      {
        $this->arr_view_data['pp_paginate']       = clone $prescription_obj;
        $this->arr_view_data['prescription_data'] = $prescription_obj->toArray();
      }

      $this->arr_view_data['arr_user']                      = $arr_user;
      $this->arr_view_data['prescription_img_public_path']  = $this->prescription_img_public_path;
      $this->arr_view_data['prescription_img_base_path']    = $this->prescription_img_base_path;
      $this->arr_view_data['patient_prescription_public']   = $this->patient_prescription_public;
      $this->arr_view_data['patient_prescription']          = $this->patient_prescription;
      $this->arr_view_data['consult_arr']                   = $new_carr;
      $this->arr_view_data['page_title']                    = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']               = $this->module_url_path;

      return view($this->module_view_folder.'.documents_prescription',$this->arr_view_data);
    } // end documents_prescription


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function documents_medical_certificate()
    {

      $get_consult = $this->PatientConsultationBookingModel->where('patient_user_id', $this->user_id)
                                                           ->orderBy('consultation_datetime', 'DESC')
                                                           ->with('doctor_user_details')
                                                           ->get();
      if($get_consult)
      {
          $consult_arr = $get_consult->toArray();
      }
      

      $new_carr   = [];
      $group_darr = [];
      foreach ($consult_arr as  $value) {
          if(in_array($value['doctor_user_id'], $group_darr)){
          }
          else{
              $new_carr[]     = $value;
              $group_darr[]   = $value['doctor_user_id'];
          }  
      }

      $medical_certificate_obj = $this->MedicationCertificateModel->where('patient_id', $this->user_id)
                                                                  ->with('userinfo')
                                                                  ->orderBy('created_at','DESC')
                                                                  ->paginate(10);

      if($medical_certificate_obj)
      {
        $this->arr_view_data['mc_paginate']      = clone $medical_certificate_obj;
        $this->arr_view_data['certificate_data'] = $medical_certificate_obj->toArray();
      }

      $this->arr_view_data['consult_arr']                   = $new_carr;
      $this->arr_view_data['page_title']                    = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']               = $this->module_url_path;

      return view($this->module_view_folder.'.documents_medical_certificate',$this->arr_view_data);
    } // end documents_medical_certificate


    public function download_medical_certificate($cert_id)
    {
      $id = base64_decode($cert_id);

      $get_cert_data = $this->MedicationCertificateModel->where('id', $id)->first();
      if($get_cert_data)
      {
        $cert_data = $get_cert_data->toArray();
      }

      $doctor_id          = $cert_data['created_by'];
      $patient_id         = $cert_data['patient_id'];
      $family_member_id   = $cert_data['family_member_id'];
      $start_date         = $cert_data['start_date'];
      $end_date           = $cert_data['end_date'];
      $activity           = $cert_data['activity'];
      $reason_for_absent  = $cert_data['reason_for_absent'];

      $this->arr_view_data['from_date'] = date('d/m/Y', strtotime($start_date));
      $this->arr_view_data['to_date']   = date('d/m/Y', strtotime($end_date));

      if($family_member_id == '0')
      {
        $get_patient_data = $this->PatientModel->where('user_id',$patient_id)->with('userinfo')->first();
        if($get_patient_data)
        {
          $this->arr_view_data['patient_data'] = $get_patient_data->toArray();
        }
      }
      else if($family_member_id != '0')
      {
        $get_family_data = $this->FamilyMemberModel->where('user_id',$patient_id)->first();
        if($get_family_data)
        {
          $family_data = $get_family_data->toArray();

          $this->arr_view_data['family_data'] = $family_data;
        }
      }

      $get_doctor_data = $this->DoctorModel->where('user_id', $doctor_id)->with('userinfo')->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_data'] = $get_doctor_data->toArray();
      }

      $this->arr_view_data['current_date']  = date("d/m/Y");
      $this->arr_view_data['activity']      = $activity;
      $this->arr_view_data['reason_for_absent'] = $reason_for_absent;

      Session::put("arr_medical_certi_data",'');
      return response()->json($this->arr_view_data);
    } // end  download_medical_certificate

    public function generate_medical_certificate_pdf(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_medical_certi_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }
      $arr_data = Session::get("arr_medical_certi_data");
      if(!empty($arr_data))
      {
      // Custom Header
      PDF::setHeaderCallback(function($pdf) { 

              // Position at 15 mm from top
              $pdf->SetY(15);
              // Set font
              $pdf->SetFont('helvetica', 'B', 20);
              // Title
              //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');
              //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

              // Image method signature:
              // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

              //$pdf->SetXY(110, 200);
              $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);


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

      PDF::SetTitle('Doctoroo | Medical Certificate');
      PDF::SetMargins(10, 30, 10, 10);
      PDF::SetFontSubsetting(false);
      PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      PDF::AddPage();
      PDF::writeHTML(view($this->module_view_folder.'.medical_certificate_pdf', $arr_data)->render());
        if( isset($arr_data['type']) && $arr_data['type']=='download')
        {
          PDF::Output('medical_certificate.pdf','D');
        }
        else
        {
          PDF::Output('medical_certificate.pdf');
        }
      }
      return redirect()->back();
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function general()
    {

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;



      return view($this->module_view_folder.'.general',$this->arr_view_data);
    } // end general


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function medical_history_page($id)
    {
      $general_health=$this->HealthGeneralModel->where('user_id',$this->user_id)->first();
      
      $health_condition=$this->HealthConditionModel->where('user_id',$this->user_id)->first();
     
      $lifestyle=$this->LifeStylelModel->where('user_id',$this->user_id)->first();

      $medication=$this->MedicationModel->where('user_id',$this->user_id)
                                        ->orderBy('id','desc')
                                        ->get();
      
      if($general_health)
      {
        $general_health_arr = $general_health->toArray();
        $this->arr_view_data['general_health_arr']     = $general_health_arr;

        $get_dynamic_general = $this->DynamicHealthGeneralModel->where('general_id', $general_health_arr['id'])->get();
        if($get_dynamic_general)
        {
          $this->arr_view_data['dynamic_general_data'] = $get_dynamic_general->toArray();
        }
      }

      if($health_condition)
      {
        $health_condition_arr=$health_condition->toArray();
        $this->arr_view_data['health_condition_arr']     = $health_condition_arr;
      }

      if($lifestyle)
      {
        $lifestyle_arr=$lifestyle->toArray();
        $this->arr_view_data['lifestyle_arr']     = $lifestyle_arr;
      }

      if($medication)
      {
        $medication_arr = $medication->toArray();
        $this->arr_view_data['medication_arr']     = $medication_arr;
      }

      $this->arr_view_data['patient_prescription_public'] = $this->patient_prescription_public;
      $this->arr_view_data['patient_prescription']        = $this->patient_prescription;            
    
      $this->arr_view_data['page_title']                  = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['active_tab_id']               = $id;
      

      $get_patient_data = \DB::table('users')->where('id',$this->user_id)->first();
      $this->arr_view_data['user_details']  = $get_patient_data;
      return view($this->module_view_folder.'.condition',$this->arr_view_data);
    } // end condition


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function medication()
    {

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;
      $get_patient_data = \DB::table('users')->where('id',$this->user_id)->first();
      $this->arr_view_data['user_details']  = $get_patient_data;
      return view($this->module_view_folder.'.medication',$this->arr_view_data);
    } // end medication


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 28/07/2017
    | Output    : 
    */

    public function lifestyle()
    {

      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;

      $get_patient_data = \DB::table('users')->where('id',$this->user_id)->first();
      $this->arr_view_data['user_details']  = $get_patient_data;
      return view($this->module_view_folder.'.lifestyle',$this->arr_view_data);
    } // end lifestyle


    public function condition_store(Request $request)
    {
      $num    =   $this->HealthConditionModel->where('user_id',$this->user_id)->count();
      if($num>0)
      {
        $condition_arr=array(
              'diabetes'                 =>   $request->diabetes,
              'heart_desease'            =>   $request->heart_desease,
              'heart_desease_detail'     =>   $request->heart_desease_detail,
              'stroke'                   =>   $request->stroke,
              'blood_pressure'           =>   $request->blood_pressure,
              'high_cholestrol'          =>   $request->high_cholestrol,
              'asthma'                   =>   $request->asthma,
              'depression'               =>   $request->depression,
              'arthrits'                 =>   $request->arthrits
          );

        $res = $this->HealthConditionModel->where('user_id',$this->user_id)
                                          ->update($condition_arr);

        if($res)
        {
          $arr_response['msg']="Medical history saved successfully";
        }
        else
        {
         $arr_response['msg']= "Something went to wrong or now Changes found";
        }
      }
      else
      {
        $this->HealthConditionModel->user_id=$this->user_id;
        $this->HealthConditionModel->diabetes=$request->diabetes;
        $this->HealthConditionModel->heart_desease=$request->heart_desease;
        $this->HealthConditionModel->heart_desease_detail=$request->heart_desease_detail;
        $this->HealthConditionModel->stroke=$request->stroke;
        $this->HealthConditionModel->blood_pressure=$request->blood_pressure;
        $this->HealthConditionModel->high_cholestrol=$request->high_cholestrol;
        $this->HealthConditionModel->asthma=$request->asthma;
        $this->HealthConditionModel->depression=$request->depression;
        $this->HealthConditionModel->arthrits=$request->arthrits;

        $res=$this->HealthConditionModel->save();

        if($res)
        {
          $arr_response['msg']="Medical history saved successfully";
        }
        else
        {
          $arr_response['msg']="Something went to wrong";
        }

      }

      $this->MedicalHistoryUpdatesModel->patient_id = $this->user_id;
      $this->MedicalHistoryUpdatesModel->updated_by = $this->user_id;
      $this->MedicalHistoryUpdatesModel->save();

      return response()->json($arr_response);
    }

    public function general_store(Request $request)
    {
      $num    =   $this->HealthGeneralModel->where('user_id',$this->user_id)->count();
      if($num>0)
      {

        $general_arr = array(
              'allergy'                   => $request->input('allergy'),
              'surgery'                   => $request->input('surgery'),
              'surgery_details'           => $request->input('surgery_details'),
              'pregnancy'                 => $request->input('pregnancy'),
              'family_history'            => $request->input('family_history'),
              'other'                     => $request->input('other'),
              'diabetes'                  => $request->input('diabetes'),
              'heart_disease'             => $request->input('heart_desease'),
              'heart_disease_details'     => $request->input('heart_desease_detail'),
              'stroke'                    => $request->input('stroke'),
              'blood_pressure'            => $request->input('blood_pressure'),
              'high_cholesterol'          => $request->input('high_cholestrol'),
              'asthma'                    => $request->input('asthma'),
              'depression'                => $request->input('depression'),
              'arthritis'                 => $request->input('arthrits'),
              'allergy_details'           => $request->input('allergy_details'),
              'pregnancy_details'         => $request->input('pregnancy_details'),
              'family_history_details'    => $request->input('family_history_details'),
              'other_details'             => $request->input('other_details'),
              'diabetes_details'          => $request->input('diabetes_details'),
              'stroke_details'            => $request->input('stroke_details'),
              'blood_pressure_details'    => $request->input('blood_pressure_details'),
              'high_cholesterol_details'  => $request->input('high_cholesterol_details'),
              'asthma_details'            => $request->input('asthma_details'),
              'depression_details'        => $request->input('depression_details'),
              'arthritis_details'         => $request->input('arthritis_details'),
          );

        $res = $this->HealthGeneralModel->where('user_id',$this->user_id)
                                        ->update($general_arr);

        if($request->input('dyn_arr') != null && !empty($request->input('dyn_arr')))
        {
          $dyn_arr =$request->input('dyn_arr');
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
                
                  $this->DynamicHealthGeneralModel->where('id', $id)
                                                  ->update($data_arr);
              }
            }

        }                                        

        $arr_response['msg'] = "Medical history saved successfully";
      }
      else
      {
        $this->HealthGeneralModel->user_id                 = $this->user_id;
        $this->HealthGeneralModel->allergy                 = $request->input('allergy');
        $this->HealthGeneralModel->surgery                 = $request->input('surgery');
        $this->HealthGeneralModel->surgery_details         = $request->input('surgery_details');
        $this->HealthGeneralModel->pregnancy               = $request->input('pregnancy');
        $this->HealthGeneralModel->family_history          = $request->input('family_history');
        $this->HealthGeneralModel->other                   = $request->input('other');
        $this->HealthGeneralModel->diabetes                = $request->input('diabetes');
        $this->HealthGeneralModel->heart_disease           = $request->input('heart_desease');
        $this->HealthGeneralModel->heart_disease_details   = $request->input('heart_desease_detail');
        $this->HealthGeneralModel->stroke                  = $request->input('stroke');
        $this->HealthGeneralModel->blood_pressure          = $request->input('blood_pressure');
        $this->HealthGeneralModel->high_cholesterol        = $request->input('high_cholestrol');
        $this->HealthGeneralModel->asthma                  = $request->input('asthma');
        $this->HealthGeneralModel->depression              = $request->input('depression');
        $this->HealthGeneralModel->arthritis               = $request->input('arthrits');
        $this->HealthGeneralModel->allergy_details         = $request->input('allergy_details');
        $this->HealthGeneralModel->pregnancy_details       = $request->input('pregnancy_details');
        $this->HealthGeneralModel->family_history_details  = $request->input('family_history_details');
        $this->HealthGeneralModel->other_details           = $request->input('other_details');
        $this->HealthGeneralModel->diabetes_details        = $request->input('diabetes_details');
        $this->HealthGeneralModel->stroke_details          = $request->input('stroke_details');
        $this->HealthGeneralModel->blood_pressure_details  = $request->input('blood_pressure_details');
        $this->HealthGeneralModel->high_cholesterol_details = $request->input('high_cholesterol_details');
        $this->HealthGeneralModel->asthma_details          = $request->input('asthma_details');
        $this->HealthGeneralModel->depression_details      = $request->input('depression_details');
        $this->HealthGeneralModel->arthritis_details       = $request->input('arthritis_details');

        $res = $this->HealthGeneralModel->save();

        if($res)
        {
          $arr_response['msg']="Medical history saved successfully";
        }
        else
        {
          $arr_response['msg']="Something went to wrong";
        }

      }

      $this->MedicalHistoryUpdatesModel->patient_id = $this->user_id;
      $this->MedicalHistoryUpdatesModel->updated_by = $this->user_id;
      $this->MedicalHistoryUpdatesModel->save();

      return response()->json($arr_response);
    }

    public function lifestyle_store(Request $request)
    {
      $num    =   $this->LifeStylelModel->where('user_id',$this->user_id)->count();
      if($num>0)
      {

        $general_arr=array(
              'physical_activity'         => $request->physical_activity,
              'food_habit'                => $request->food_habit,
              'smoking'                   => $request->smoking,
              'alcohol'                   => $request->alcohol,
              'stress_level'              => $request->stress_level,
              'average_sleep'             => $request->average_sleep,
              'other_lifestyle'           => $request->other_lifestyle
          );

        $res = $this->LifeStylelModel->where('user_id',$this->user_id)
                                     ->update($general_arr);
        $arr_response['msg']="Medical history saved successfully";                                     
      }
      else
      {
        $this->LifeStylelModel->user_id=$this->user_id;
        $this->LifeStylelModel->physical_activity=$request->physical_activity;
        $this->LifeStylelModel->food_habit=$request->food_habit;
        $this->LifeStylelModel->smoking=$request->smoking;
        $this->LifeStylelModel->alcohol=$request->alcohol;
        $this->LifeStylelModel->stress_level=$request->stress_level;
        $this->LifeStylelModel->average_sleep=$request->average_sleep;
        $this->LifeStylelModel->other_lifestyle=$request->other_lifestyle;
        $res=$this->LifeStylelModel->save();

        if($res)
        {
          $arr_response['msg']="Medical history saved successfully";
        }
        else
        {
          $arr_response['msg']="Something went to wrong";
        }

      }

      $this->MedicalHistoryUpdatesModel->patient_id = $this->user_id;
      $this->MedicalHistoryUpdatesModel->updated_by = $this->user_id;
      $this->MedicalHistoryUpdatesModel->save();

      return response()->json($arr_response);
    }

    public function add_medication()
    {
      $this->arr_view_data['page_title']                = str_singular($this->module_title);
      $this->arr_view_data['module_url_path']           = $this->module_url_path;
       
      $get_patient_data = \DB::table('users')->where('id',$this->user_id)->first();
      $this->arr_view_data['user_details']  = $get_patient_data; 
      return view($this->module_view_folder.'.add_medication')->with($this->arr_view_data);
    }

    public function medication_store(Request $request)
    {
      /*$this->MedicationModel->user_id             = $this->user_id;
      $this->MedicationModel->medication_name     = $request->medication_name;
      $this->MedicationModel->medication_purpose  = $request->medication_purpose;
      $this->MedicationModel->medication_duration = $request->medication_duration;
      $res = $this->MedicationModel->save();*/

      $data['user_id']             = $this->user_id;
      $data['medication_name']     = $request->medication_name;
      $data['medication_purpose']  = $request->medication_purpose;
      $data['medication_duration'] = $request->medication_duration;

      $res = $this->MedicationModel->insertGetId($data);

      if($res)
      {
        $arr_response['msg'] = "Medication saved successfully";
        $arr_response['id'] = base64_encode($res);
      }
      else
      {
        $arr_response['msg'] = "Something went to wrong";
      }
      
      return response()->json($arr_response);
    }

    public function medication_deatails_add(Request $request)
    {
      $medication_arr=array(
            'medication_name'       =>    $request->active_ingredient,
            'medication_purpose'    =>    $request->medication_purpose,
            'medication_duration'   =>    $request->medication_duration
      );
      
      $res=$this->MedicationModel->where('id',$request->id)
                                 ->update($medication_arr);
      
      $arr_response['status'] = 'success';
      $arr_response['msg']="Medication saved successfully";

      $this->MedicalHistoryUpdatesModel->patient_id = $this->user_id;
      $this->MedicalHistoryUpdatesModel->updated_by = $this->user_id;
      $this->MedicalHistoryUpdatesModel->save();
      
      return response()->json($arr_response);
    }

    public function medication_deatails_delete(Request $request)
    {
      $id = $request->id;
      if(isset($id) && !empty($id))
      {
        $res = $this->MedicationModel->where('id',$id)
                              ->delete();
        if($res)
        {
          $arr_response['status'] = 'success'; 
          $arr_response['msg'] = 'Medication deleted successfully'; 

          @unlink($this->patient_prescription_public.$request->delete_prescription_file);

        } 
        else
        {
          $arr_response['status'] = 'success'; 
          $arr_response['msg'] = 'Something went to wrong'; 
        }                              
      }
      else
      {
        $arr_response['status'] = 'error'; 
        $arr_response['msg'] = 'Bad Request'; 
      }

      return response()->json($arr_response);

    }

    public function add_new_general_condition(Request $request)
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
          $msg    = "New condition added successfully";
          $status = "success";
        }
        else
        {
          $msg    = "Something went wrong";
          $status = "error";
        }

        $response_data = array('status'=>$status,'msg'=>$msg);
        return response()->json($response_data);
    }

    public function medical_general_delete(Request $request)
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
        $msg    = "Medical General Condition successfully deleted";
        $status = "success";
      }
      else
      {
        $msg    = "Error! Something went wrong";
        $status = "error";
      }

      $response_data = array('status'=>$status,'msg'=>$msg);
      return response()->json($response_data);

    }

    public function prescription($enc_id = false)
    {
      $medication_id = base64_decode($enc_id);

      $get_medication_data = $this->MedicationModel->with('medication_img','userinfo')
                                                   ->where('user_id',$this->user_id)
                                                   ->where('id',$medication_id)
                                                   ->first();
      if($get_medication_data)
      {
        $this->arr_view_data['medication_arr_data'] = $get_medication_data->toArray();
      }
      
      $get_prescription_data = $this->MedicationPrescriptionModel->with('pharmacy_list')
                                                                 ->where('patient_id',$this->user_id)
                                                                 ->where('medication_id',$medication_id)
                                                                 ->get();
      if($get_prescription_data)
      {
        $this->arr_view_data['prescription_arr_data'] = $get_prescription_data->toArray();
      }

      /*$get_pharmacy_list = $this->MyPharmacyModel->where('patient_id', $this->user_id)
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


      $get_entitlement = $this->EntitlementModel->get();
      if($get_entitlement)
      {
        $this->arr_view_data['entitlement_arr'] = $get_entitlement->toArray();
      }


      $get_entitlement_user = $this->UserEntitlementModel->where('user_id', $this->user_id)
                                                         ->with('user_entitlement')
                                                         ->get();
      if($get_entitlement_user)
      {
        $this->arr_view_data['entitlement_user_arr'] = $get_entitlement_user->toArray();
      }
      //dd($this->arr_view_data['entitlement_user_arr']);

      $this->arr_view_data['prescription_path']           = $this->prescription_img_public_path;
      $this->arr_view_data['prescription_base_path']      = $this->prescription_img_base_path;
      $this->arr_view_data['module_url_path']             = $this->module_url_path;
      $this->arr_view_data['enc_medication_id']           = $enc_id;

      return view($this->module_view_folder.'.prescription',$this->arr_view_data);
    }

    public function prescription_store(Request $request)
    {
      $curret_datetime    = date("Y-m-d h:i:s");
      $patient_id         = $this->user_id; 
      $doctor_id          = '';
      $medical_id         = base64_decode($request->input('enc_medication_id'));
      $repeats            = $request->input('cmb_repeats');
      $direction          = $request->input('txt_direction');
      $hardcopy_location  = $request->input('cmb_hardcopy_location');
      $pharmacy_id        = $request->input('cmb_pharmacy_id');

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
                  return response()->json(['status'=>'fail']);
                  //return redirect()->back()->withInput($request->all());
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

              $current_datetime = date('Y-m-d H:i:s');

              $data['file_added_by']     = $this->user_id;
              $data['file_added_on']     = $current_datetime;
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
        $msg    = "Digital Prescription added successfully";
        $status = "success";
        $response_data = array('status'=>$status,'msg'=>$msg);
        return response()->json($response_data);
      }
      else
      {
        $msg    = "Something went to wrong ! Please try again later";
        $status = "error";
        $response_data = array('status'=>$status,'msg'=>$msg);
        return response()->json($response_data);
      }
      Session::flash('message', $msg);
      //return redirect()->back();
      return response()->json(['status'=>'fail']);

    }

    /*--------------------------------------------------------------------------
                                  PRESCRIPTION - DELETE
    ----------------------------------------------------------------------------*/

    public function prescription_delete(Request $request)
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

    /*--------------------------------------------------------------------------
                                  PRESCRIPTION - UPDATE
    ----------------------------------------------------------------------------*/

    public function prescription_update(Request $request)
    {
        $curret_datetime    = date("Y-m-d h:i:s");
        $prescription_id    = $request->prescription_id;
        $repeats            = $request->input('edit_cmb_repeats');
        $direction          = $request->input('edit_txt_direction');
        $hardcopy_location  = $request->input('edit_cmb_hardcopy_location');
        $pharmacy_id        = $request->input('edit_cmb_pharmacy_id');
        $patient_id         = $this->user_id;
        $upload_file_name   = '';

       // dd($request->input('old_pres_uploaded_file'));

        if($request->hasFile('edit_pres_uploaded_file'))
        {
            $uploaded_file   =   $request->file('edit_pres_uploaded_file');
            if(isset($uploaded_file) && sizeof($uploaded_file)>0)
            {
                $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('upload_file_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                    //return redirect()->back()->withInput($request->all());
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
                    $upload_file_name      = $request->file('edit_pres_uploaded_file');
                    $upload_file_extension = strtolower($request->file('edit_pres_uploaded_file')->getClientOriginalExtension()); 
                    $upload_file_name      = sha1(uniqid().$upload_file_name.uniqid()).'.'.$upload_file_extension;
                    $upload_file_result    = $request->file('edit_pres_uploaded_file')->move($this->prescription_img_base_path, $upload_file_name);
                }
                $data['uploaded_file']      = $upload_file_name;
                
                $current_datetime = date('Y-m-d H:i:s');

                $data['file_added_by']     = $this->user_id;
                $data['file_added_on']     = $current_datetime;
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
        $update['patient_id']       = $this->user_id;
        $update['updated_by']       = $this->user_id;
        $update_data                = $this->MedicationPrescriptionModel->where('id', $prescription_id)->update($data);
        $medical_updates            = $this->MedicalHistoryUpdatesModel->create($update);
        if($update_data)
        {
          $msg    = "Digital Prescription updated successfully";
          $status = "success";
          $response_data = array('status'=>$status,'msg'=>$msg);
          return response()->json($response_data);
        }
        else
        {
          $msg    = "Something went to wrong ! Please try again later";
          $status = "error";
          $response_data = array('status'=>$status,'msg'=>$msg);
          return response()->json($response_data);
        }

        Session::flash('message', $msg);
        return response()->json(['status'=>'fail']);
        //return redirect()->back();
    }

    public function doctor_activity(Request $request)
    {
          $doctor_activity =  \DB::table('dod_view_patient')
                                   ->select('dod_view_patient.*')
                                   ->where('dod_view_patient.patient_id' , $this->user_id)
                                   ->orderBy('id' ,'DESC')
                                   ->get();

          $data['doctor_activity']             = $this->make_pagination_links($doctor_activity,10);
          $data['obj_pagination']              = $data['doctor_activity'];
          $data['arr_doctor_activity']         = $data['doctor_activity']->toArray();
          $data['patient_prescription_public'] = $this->patient_prescription_public;
          return view($this->module_view_folder.'.doctor_activity',$data);
    }

    public function make_pagination_links($items,$perPage)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    } 
}
?>