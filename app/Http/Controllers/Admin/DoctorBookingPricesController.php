<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\DoctorConsultationPriceModel;
use Validator;
use Flash;
use Sentinel;
use Session;
/*-------------------------------Ankit Aher(8th April 2017)---------------------------*/
class DoctorBookingPricesController extends Controller
{
     public function __construct(DoctorConsultationPriceModel $doctorconsultationprice)
    {
        $this->DoctorConsultationPriceModel     = $doctorconsultationprice;
        $this->arr_view_data                = [];
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/doctor_consultation_prices");
        $this->module_title                 = "Doctor Consultation Earnings";
        $this->module_view_folder           = "admin.doctor_consultation_prices";
        $this->admin_panel_slug             = config('app.project.admin_panel_slug');
    }

     public function index()
     {

        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings                = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $arr_doctorbooking =  $this->DoctorConsultationPriceModel->orderBy('id','ASC')->get();   
                
                if($arr_doctorbooking!=FALSE)
                {
                    $arr_manage_doctorbooking = $arr_doctorbooking->toArray();
                }
                //dd($arr_manage_doctorbooking);

                $this->arr_view_data['arr_data']        = $arr_manage_doctorbooking;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
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
    public function edit($enc_id=FALSE)
    {
         if($enc_id!="")   
         {
              $this->arr_view_data['page_title']      = 'Update Doctor Consultation Earnings';
              //$arr_patient = $arr_states = array();
              $id             = base64_decode($enc_id);  

              $obj_doctorbooking      = $this->DoctorConsultationPriceModel->where('id',$id)->first();

              if($obj_doctorbooking!=FALSE)
              {

                    $arr_docbooking = $obj_doctorbooking->toArray();

              }       

            //dd($arr_docbooking);
          
            $this->arr_view_data['arr_data']        = $arr_docbooking; 
            $this->arr_view_data['enc_id']          = $enc_id; 
            $this->arr_view_data['module_url_path'] = $this->module_url_path; 
            $this->arr_view_data['module_title']    = 'Doctor Consultation Earnings'; 
            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
         }

        return redirect()->back(); 
    }

    public function update(Request $request,$enc_id=null)
    {  
        if($enc_id)
        {
            $id                                 = base64_decode($enc_id);
            
            $arr_rules                          = array();
            $arr_rules['time']                  = 'required';
            $arr_rules['day']                   = 'required';
            $arr_rules['day_hourly_rate']       = 'required';
            $arr_rules['night']                 = 'required';
            $arr_rules['night_hourly_rate']     = 'required';
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();

            $arr_data['time']                   = $form_data['time'];
            $arr_data['day']                    = $form_data['day'];
            $arr_data['day_hourly_rate']        = $form_data['day_hourly_rate'];
            $arr_data['night']                  = $form_data['night'];
            $arr_data['night_hourly_rate']      = $form_data['night_hourly_rate'];
                    
            $update_data = $this->DoctorConsultationPriceModel->where('id',$id)->update($arr_data);
            //dd($update_data);
            if($update_data)
            {
                Flash::success('Doctor Consultation Earnings Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Data.');
            }

        }

        return redirect()->back();
    }
    
    
    public function multi_action(Request $request)
    {
        $arr_rules                  = array();
        $arr_rules['multi_action']  = "required";
        $arr_rules['checked_record']= "required";

        $validator                  = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
              Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
              return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $multi_action   = $request->input("multi_action");
        $checked_record = $request->input("checked_record");

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        
        foreach($checked_record as $key=>$record_id)
        {
            $record_id  =  base64_decode($record_id);
            if($multi_action=="delete")
            {
                $result  =  $this->DoctorConsultationPriceModel->where('id',$record_id)->first();
                if(isset($result) && count($result)>0)
                {
                    $record_del = $result->delete();
                    if($record_del)
                    {
                        Flash::success("Record(s) deleted successfully.");
                    }
                    else
                    {
                        Flash::error("Error while deleting record.");
                    }
                }
            } 
        }
        return redirect()->back();

    }
   
}   
