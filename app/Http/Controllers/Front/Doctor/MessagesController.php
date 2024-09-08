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
use App\Models\ChatModel;

use Twilio\Rest\Client;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use PDF;

class MessagesController extends Controller
{
    public function __construct(
                                  UserModel                       $user_model,
                                  PatientModel                    $patient_model,
                                  FamilyMemberModel               $family_member_model,
                                  DoctorModel                     $doctor_model,
                                  PatientConsultationBookingModel $consultation_model
                                )
    {
        $this->arr_view_data                    = [];
        
        $this->UserModel                        = $user_model;
        $this->PatientModel                     = $patient_model;
        $this->FamilyMemberModel                = $family_member_model;
        $this->DoctorModel                      = $doctor_model;
        $this->PatientConsultationBookingModel  = $consultation_model;

        $this->patient_img_base_path            = public_path().config('app.project.img_path.patient');
        $this->patient_img_public_path          = url('/public').config('app.project.img_path.patient');

      	$this->module_view_folder               = 'front.doctor.messages';
        $this->module_url_path                  = url('/').'/doctor/messages';
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
    }


    /*
    | Function  : Get all the messages data
    | Author    : Deepak Arvind Salunke
    | Date      : 18/09/2017
    | Output    : Show all the messages list and details
    */

    public function index()
    {
          $logged_dr    = Sentinel::getUser();
          $logged_dr_id = $logged_dr->id;

          $patients = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                            ->with('patient_user_details')
                                                            ->where('doctor_user_id', $this->user_id)
                                                            ->with('patient_info')
                                                            ->groupBy('patient_user_id')
                                                            ->get();


          if($patients)
          {
              $this->arr_view_data['patient_data']    = $patients->toArray();
          }

          $this->arr_view_data['patient_profile_pic'] = $this->patient_img_public_path;
          $this->arr_view_data['logged_dr_id']        = $logged_dr_id;
          $this->arr_view_data['page_title']          = "Messages";
          $this->arr_view_data['module_url_path']     = $this->module_url_path;
            
          return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    
}
?>
