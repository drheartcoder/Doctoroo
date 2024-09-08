<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ConsultationPriceModel;
use Validator;
use Flash;
use Sentinel;
use Session;
/*-------------------------------Ankit Aher(8th April 2017)---------------------------*/
class ConsultationPriceController extends Controller
{
     public function __construct(ConsultationPriceModel $consultation)
    {
        $this->ConsultationPriceModel  = $consultation;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/consultationprice");
        $this->module_title            = "Consultation Price";
        $this->module_view_folder      = "admin.consultation_price";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
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
                $arr_consulation =  $this->ConsultationPriceModel->orderBy('price_id','ASC')->get();   
                
                if($arr_consulation!=FALSE)
                {
                    $arr_manage_consultation = $arr_consulation->toArray();
                }

                $this->arr_view_data['arr_data']        = $arr_manage_consultation;
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
              $this->arr_view_data['page_title']      = 'Update Consultation Price';
              //$arr_patient = $arr_states = array();
              $price_id             = base64_decode($enc_id);  

              $obj_consultaion      = $this->ConsultationPriceModel->where('price_id',$price_id)->first();

              if($obj_consultaion!=FALSE)
              {

                    $arr_consult = $obj_consultaion->toArray();

              }       

            //dd($arr_consult);
          
            $this->arr_view_data['arr_data']        = $arr_consult; 
            $this->arr_view_data['enc_id']          = $enc_id; 
            $this->arr_view_data['module_url_path'] = $this->module_url_path; 
            $this->arr_view_data['module_title']    = 'Update Consultation Price'; 
            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
         }

        return redirect()->back(); 
    }

    public function update(Request $request,$enc_id=null)
    {  
        if($enc_id)
        {
            $price_id                                = base64_decode($enc_id);
            
            $arr_rules                               = array();
            $arr_rules['consultation_time_from']     = 'required';
            $arr_rules['consultation_time_to']       = 'required';
            $arr_rules['patient_day_cost']           = 'required';
            $arr_rules['doctor_day_fee']             = 'required';
            $arr_rules['day_profit']                 = 'required';
            $arr_rules['patient_night_cost']         = 'required';
            $arr_rules['doctor_night_fee']           = 'required';
            $arr_rules['night_profit']               = 'required';
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();

            $arr_data['consultation_time_from']   = $form_data['consultation_time_from'];
            $arr_data['consultation_time_to']     = $form_data['consultation_time_to'];
            $arr_data['patient_day_cost']         = $form_data['patient_day_cost'];
            $arr_data['doctor_day_fee']           = $form_data['doctor_day_fee'];
            $arr_data['day_profit']               = $form_data['day_profit'];
            $arr_data['patient_night_cost']       = $form_data['patient_night_cost'];
            $arr_data['doctor_night_fee']         = $form_data['doctor_night_fee'];
            $arr_data['night_profit']             = $form_data['night_profit'];
                    
            $update_data = $this->ConsultationPriceModel->where('price_id',$price_id)->update($arr_data);
            //dd($update_data);
            if($update_data)
            {
                Flash::success('Consultaion Price Updated Successfully.');
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
                $result  =  $this->ConsultationPriceModel->where('price_id',$record_id)->first();
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
