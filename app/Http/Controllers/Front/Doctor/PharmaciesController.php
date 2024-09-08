<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\FamilyMemberModel;
use App\Models\DoctorModel;
use App\Models\PharmacyListModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use PDF;
use Input;

class PharmaciesController extends Controller
{
    public function __construct(
                                  UserModel           $user_model,
                                  PatientModel        $patient_model,
                                  FamilyMemberModel   $family_member_model,
                                  DoctorModel         $doctor_model,
                                  PharmacyListModel   $PharmacyListModel
                                )
    {
        $this->arr_view_data                    = [];
        
        $this->UserModel                        = $user_model;
        $this->PatientModel                     = $patient_model;
        $this->FamilyMemberModel                = $family_member_model;
        $this->DoctorModel                      = $doctor_model;
        $this->PharmacyListModel                = $PharmacyListModel;

      	$this->module_view_folder               = 'front.doctor.pharmacies';
        $this->module_url_path                  = url('/').'/doctor/pharmacies';
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }

        \DB::connection()->enableQueryLog();
        //$queries = DB::getQueryLog();
    }


    /*
    | Function  : Get all the pharmacies data
    | Author    : Deepak Arvind Salunke
    | Date      : 18/09/2017
    | Output    : Show all the pharmacies list and details
    */

    public function index()
    {
          
          $get_phramacy_data = $this->PharmacyListModel->orderBy('company_name', 'ASC')
                                                       ->paginate(5);
          if($get_phramacy_data)
          {
            $this->arr_view_data['paginate']      = clone $get_phramacy_data;
            $this->arr_view_data['pharmacy_data'] = $get_phramacy_data->toArray();
          }

          $this->arr_view_data['page_title']          = "Pharmacies";
          $this->arr_view_data['module_url_path']     = $this->module_url_path;
            
          return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    
    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 01/01/2018
    | Output    : 
    */

    public function search(Request $request)
    {
          
        //dd($request->all());

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

        $this->arr_view_data['search_keyword']      = $suburb;
        $this->arr_view_data['page_title']          = "Pharmacies";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
        return view($this->module_view_folder.'.search',$this->arr_view_data);

    }

}
?>