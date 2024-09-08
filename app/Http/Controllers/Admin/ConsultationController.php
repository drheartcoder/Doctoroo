<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientConsultationBookingModel;
use Validator;
use Flash;
use Sentinel;
use Session;

class ConsultationController extends Controller
{
	public function __construct(PatientConsultationBookingModel $consultation)
    {
        $this->PatientConsultationBookingModel = $consultation;
        $this->arr_view_data           = [];

        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/consultation");

        $this->module_title            = "Consultations";
        $this->module_url_slug		   = "consultations";
        $this->module_view_folder      = "admin.consultation";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }

    /*
	| Function : Get Data from Database
	| Auther : Deepak Arvind Salunke
	| Date   : 20/04/2017
	| Output: Display data from Database in Tabular form
	*/

    public function index()
    {
    	$arr_consultation		            = array();

    	// Get User from Database
        $user = Sentinel::check();

        if($user)
        {
            // Check User is Admin or not
            if($user->inRole('admin'))
            {     

		    	$query = $this->PatientConsultationBookingModel->with('patient_user_details','familiy_member_info','doctor_user_details')->orderBy('id', 'DESC')->get();
		    	if($query)
		    	{
		    		$arr_consultation = $query->toArray();
		    	}

		    	$this->arr_view_data['arr_consultation_data']	 = $arr_consultation;
		    	$this->arr_view_data['page_title']				 = $this->module_title;
		        $this->arr_view_data['module_url_path']			 = $this->module_url_path;
		    	$this->arr_view_data['module_title']			 = $this->module_title;    

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



	/*
	| Function : Get Data from Database
	| Auther : Deepak Arvind Salunke
	| Date   : 20/04/2017
	| Output: Display data from database
	*/

	public function show($enc_id)
	{
		$arr_consultation		            = array();
		$consultation_id = base64_decode($enc_id);

    	// Get User from database
        $user = Sentinel::check();

        if($user)
        {
            // Check User is Admin or not
            if($user->inRole('admin'))
            {     
		        $query = $this->PatientConsultationBookingModel->with('patient_user_details','patient_info','familiy_member_info','doctor_user_details','booking_status_data')->where('id',$consultation_id)->first();
		    	if($query)
		    	{
		    		$arr_consultation = $query->toArray();
		    		//dd($arr_consultation);
		    	}

		    	$this->arr_view_data['arr_consultation_data']	 = $arr_consultation;
		    	$this->arr_view_data['page_title']				 = str_singular($this->module_title);
		        $this->arr_view_data['module_url_path']			 = $this->module_url_path;
		    	$this->arr_view_data['module_title']			 = str_singular($this->module_title);    

		        return view($this->module_view_folder.'/show',$this->arr_view_data);	
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
}