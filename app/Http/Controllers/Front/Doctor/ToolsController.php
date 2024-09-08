<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\FamilyMemberModel;
use App\Models\DoctorModel;
use App\Models\PatientConsultationBookingModel;
use App\Models\ConsultationDocumentsModel;
use App\Models\MedicationCertificateModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use PDF;
use Session;
use File;

class ToolsController extends Controller
{
    public function __construct(
                                  UserModel                       $user_model,
                                  PatientModel                    $patient_model,
                                  FamilyMemberModel               $family_member_model,
                                  DoctorModel                     $doctor_model,
                                  PatientConsultationBookingModel $PatientConsultationBookingModel,
                                  ConsultationDocumentsModel      $ConsultationDocumentsModel,
                                  MedicationCertificateModel      $MedicationCertificateModel
                                )
    {
        $this->arr_view_data                    = [];
        
        $this->UserModel                        = $user_model;
        $this->PatientModel                     = $patient_model;
        $this->FamilyMemberModel                = $family_member_model;
        $this->DoctorModel                      = $doctor_model;
        $this->PatientConsultationBookingModel  = $PatientConsultationBookingModel;
        $this->ConsultationDocumentsModel       = $ConsultationDocumentsModel;
        $this->MedicationCertificateModel       = $MedicationCertificateModel;

      	$this->module_view_folder               = 'front.doctor.patient.tools';
        $this->module_url_path                  = url('/').'/doctor/patient/tools';

        $this->consultation_documents_base_url   = url('/public').config('app.project.img_path.consultation_documents');
        $this->consultation_documents_public_url = public_path().config('app.project.img_path.consultation_documents');
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
    }


    /*
    | Function  : Get patient family members data of the selected patient
    | Author    : Deepak Arvind Salunke
    | Date      : 24/08/2017
    | Output    : Show patient and family member data
    */

    public function index($enc_id)
    {
      $doctor_info = [];
      $doctor_info = Sentinel::check();
      if($doctor_info!=false)
      {
        $doctor_info = $doctor_info->toArray();
      }

      $patient_id = base64_decode($enc_id);

      $get_user = $this->PatientModel->where('user_id',$patient_id)->with('userinfo')->first();
      if($get_user)
      {
        $this->arr_view_data['user_data'] = $get_user->toArray();
      }
      //dd($this->arr_view_data['user_data']);

      $get_family_members = $this->FamilyMemberModel->where('user_id',$patient_id)->get();
      if($get_family_members)
      {
        $this->arr_view_data['family_members_data'] = $get_family_members->toArray();
      }
      //dd($this->arr_view_data['family_members_data']);

      $this->arr_view_data['enc_patient_id']      = $enc_id;
      $this->arr_view_data['doctor_info']         = $doctor_info;
      $this->arr_view_data['page_title']          = "Tools";
      $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
      return view($this->module_view_folder.'.index',$this->arr_view_data);
    }


    /*
    | Function  : Generate medical certificate and insert patient data in it.
    | Author    : Deepak Arvind Salunke
    | Date      : 24/08/2017
    | Output    : gererate PDF file for download
    */

    public function generate_medical_certificate_store(Request $request)
    {
      $patient_id         = $request->input('patient_id');
      $patient_type       = $request->input('patient_type');
      $start_date         = $request->input('start_date');
      $end_date           = $request->input('end_date');
      $activity           = $request->input('activity');
      $reason_for_absent  = $request->input('reason_for_absent');

      if($patient_type == 'user')
      {
        $get_patient_data = $this->PatientModel->where('user_id',$patient_id)->with('userinfo')->first();
        if($get_patient_data)
        {
          $this->arr_view_data['patient_data'] = $get_patient_data->toArray();

          $certificate['patient_id'] = $patient_id;
          $certificate['family_member_id'] = '0';
        }
      }
      else if($patient_type == 'family')
      {
        $get_family_data = $this->FamilyMemberModel->where('id',$patient_id)->first();
        if($get_family_data)
        {
          $family_data = $get_family_data->toArray();

          $certificate['patient_id'] = $family_data['user_id'];
          $certificate['family_member_id'] = $family_data['id'];

          $this->arr_view_data['family_data'] = $family_data;
        }
      }

      $get_doctor_data = $this->DoctorModel->where('user_id', $this->user_id)->with('userinfo')->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_data'] = $get_doctor_data->toArray();
      }

      $certificate['created_by']        = $this->user_id;
      $certificate['start_date']        = date('Y-m-d', strtotime($start_date));
      $certificate['end_date']          = date('Y-m-d', strtotime($end_date));
      $certificate['activity']          = $activity;
      $certificate['reason_for_absent'] = $reason_for_absent;
      $insertGetId = $this->MedicationCertificateModel->create($certificate);

      $cert_id = base64_encode($insertGetId['id']);
      //return redirect(url('/').'/doctor/patients/tools/generate_medical_certificate/'.$cert_id);

      $id = base64_decode($cert_id);

      $get_cert_data = $this->MedicationCertificateModel->where('id', $id)->first();
      if($get_cert_data)
      {
        $cert_data = $get_cert_data->toArray();
      }

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

      $get_doctor_data = $this->DoctorModel->where('user_id', $this->user_id)->with('userinfo')->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_data'] = $get_doctor_data->toArray();
      }

      $this->arr_view_data['current_date']  = date("d/m/Y");
      $this->arr_view_data['activity']      = $activity;
      $this->arr_view_data['reason_for_absent'] = $reason_for_absent;
      Session::put("arr_medical_certi_data",'');
      return response()->json($this->arr_view_data);
    }// end generate_medical_certificate


    /*
    | Function  : Generate medical certificate and insert patient data in it.
    | Author    : Deepak Arvind Salunke
    | Date      : 24/08/2017
    | Output    : gererate PDF file for download
    */

    public function generate_medical_certificate($cert_id)
    {
      $id = base64_decode($cert_id);

      $get_cert_data = $this->MedicationCertificateModel->where('id', $id)->first();
      if($get_cert_data)
      {
        $cert_data = $get_cert_data->toArray();
      }

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

      $get_doctor_data = $this->DoctorModel->where('user_id', $this->user_id)->with('userinfo')->first();
      if($get_doctor_data)
      {
        $this->arr_view_data['doctor_data'] = $get_doctor_data->toArray();
      }

      $this->arr_view_data['current_date']  = date("d/m/Y");
      $this->arr_view_data['activity']      = $activity;
      $this->arr_view_data['reason_for_absent'] = $reason_for_absent;
      Session::put("arr_medical_certi_data",'');
      return response()->json($this->arr_view_data);
    }// end generate_medical_certificate
    

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
        PDF::Output('medical_certificate.pdf');
      }
      return redirect()->back();
    }

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 04/12/2017
    | Output    : 
    */

    public function other_file_upload($enc_id)
    {
      $patient_id = base64_decode($enc_id);

      $get_booking_data = $this->PatientConsultationBookingModel->where('doctor_user_id', $this->user_id)
                                                                ->where('patient_user_id', $patient_id)      
                                                                ->get();
      
      $get_patient_data = $this->UserModel->where('id',$patient_id)->first();
      if($get_patient_data)
      {
        $this->arr_view_data['patient_data'] = $get_patient_data->toArray();
      }
      
      if($get_booking_data)
      {
        $this->arr_view_data['booking_data'] = $get_booking_data->toArray();
      }

      $this->arr_view_data['enc_patient_id']      = $enc_id;
      $this->arr_view_data['page_title']          = "Tools";
      $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
      return view($this->module_view_folder.'.other_file_upload',$this->arr_view_data);

    } // end other_file_upload


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 04/12/2017
    | Output    : 
    */

    public function store_upload_file(Request $request)
    {
        $uploaded_file_name = '';

        // upload file
        if($request->hasFile('txt_file'))
        {
            $uploaded_file   =  $request->file('txt_file');

            if(isset($uploaded_file) && sizeof($uploaded_file)>0)
            {
                $extention  =   strtolower($uploaded_file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('txt_file_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                    return response()->json(['status'=>'fail']);
                    //return redirect()->back()->withInput($request->all());
                }
                else if($uploaded_file->getClientSize() > 5000000)
                {
                    Session::flash('txt_file_error','Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json(['status'=>'fail']);
                    //return redirect()->back()->withInput($request->all());
                }
                else
                {
                    //@unlink($this->consultation_documents_base_url.$request->input('old_txt_file'));
                    $uploaded_file_name      = $request->file('txt_file');
                    $uploaded_file_extension = strtolower($request->file('txt_file')->getClientOriginalExtension()); 
                    $uploaded_file_name      = sha1(uniqid().$uploaded_file_name.uniqid()).'.'.$uploaded_file_extension;
                    $id_proof_upload_result  = $request->file('txt_file')->move($this->consultation_documents_public_url, $uploaded_file_name);
                }
            }
            else
            {
                Session::flash('txt_file_error','Please upload valid image/document.');
                return response()->json(['status'=>'fail']);
                //return redirect()->back()->withInput($request->all());
            }
        }

        $form_data = $request->all();

        $data['patient_id']       = base64_decode($form_data['txt_patient_id']);
        $data['consultation_id']  = $form_data['cmb_booking_id'];
        $data['doctor_id']        = $this->user_id;
        $data['document']         = $uploaded_file_name;

        $create_file_data = $this->ConsultationDocumentsModel->create($data);
        if($create_file_data)
        {
          Session::flash('txt_file_error','File Uploaded Successfully');
          return response()->json(['status'=>'success']);
          //return redirect()->back();
        }
        else
        {
          Session::flash('txt_file_error','Something went wrong! Please try again.');
          return response()->json(['status'=>'fail']);
          //return redirect()->back(); 
        }

    } // end store_upload_file

}
?>