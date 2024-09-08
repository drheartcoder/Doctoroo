<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PricingPlanModel;
use App\Models\PricingTableModel;
use App\Models\DescriptionModel;
use App\Models\PricingNoteModel;
use Validator;
use Flash;
use Sentinel;
use Session;

class PricingPlanController extends Controller
{
     public function __construct(PricingPlanModel $social,PricingTableModel $pricing,DescriptionModel $description,PricingNoteModel $note)
    {
        $this->PricingPlanModel        = $social;
        $this->PricingTableModel       = $pricing;
        $this->DescriptionModel        = $description;
        $this->PricingNoteModel        = $note;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/pricingplan");
        $this->module_title            = "Pricing Plan";
        $this->module_view_folder      = "admin.pricingplan";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }
    public function index()
    {

        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $arr_social     =  $this->PricingPlanModel->where('id','1')->first();
                $arr_info       =  $this->PricingTableModel->get();
                $price_note     =  $this->PricingNoteModel->get();   
                if($arr_social!=FALSE)
                {
                    $arr_social_settings = $arr_social->toArray();
                }
                if($arr_info!=FALSE)
                {
                    $arr_price = $arr_info->toArray();
                }
                 if($price_note!=FALSE)
                {
                    $arr_note = $price_note->toArray();
                }

                $this->arr_view_data['arr_data']            = $arr_social_settings;
                $this->arr_view_data['arr_info']            = $arr_price;
                $this->arr_view_data['arr_note']            = $arr_note;
                $this->arr_view_data['module_url_path']     = $this->module_url_path;
                $this->arr_view_data['module_title']        = str_singular($this->module_title);
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
     /*----------------------updating pricing plan(Ankit Aher 16feb2017)--------------------------------*/

     public function update(request $request)
     {   
         $arr_rules                  = $form_data = array();
         $form_data                  = $request->all();
         $arr_rules['title_1']       =  "required";
         $arr_rules['description_1'] =  "required";
         $arr_rules['title_2']       =  "required";
         $arr_rules['description_2'] =  "required";
         $arr_rules['title_3']       =  "required";
         $arr_rules['description_3'] =  "required";

         $validator                  =  Validator::make($form_data,$arr_rules);
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
         }
         $arr_data                  =   array();
         $arr_data['title_1']       =   $form_data['title_1'];
         $arr_data['description_1'] =   $form_data['description_1'];
         $arr_data['title_2']       =   $form_data['title_2'];
         $arr_data['description_2'] =   $form_data['description_2'];
         $arr_data['title_3']       =   $form_data['title_3'];
         $arr_data['description_3'] =   $form_data['description_3'];
        
         $status                    =   $this->PricingPlanModel->where('id',1)->update($arr_data);
         if($status) 
         {
            Flash::success(str_singular($this->module_title).' Updated Successfully.'); 
         }
         else
         {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
         }
         return redirect()->back();
      }
    /*-------------------storing pricing table data (Ankit Aher 16feb2017)---------------------*/

        public function store(Request $request)
        {   
            $arr_rules                       = array();
            $arr_rules['length_of_call']     = 'required';
            $arr_rules['day_time_cost']      = 'required';
            $arr_rules['night_time_cost']    = 'required';
            
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();
            $arr_data['length_of_call']     = $form_data['length_of_call'];
            $arr_data['day_time_cost']      = $form_data['day_time_cost'];
            $arr_data['night_time_cost']    = $form_data['night_time_cost'];
            
            if($this->PricingTableModel->truncate()) 
            { 
                for($i=0;$i<count($form_data['length_of_call']);$i++)
                { 
                     $arr_data['length_of_call']   = $form_data['length_of_call'][$i];
                     $arr_data['day_time_cost']    = $form_data['day_time_cost'][$i];
                     $arr_data['night_time_cost']  = $form_data['night_time_cost'][$i];
                     $store_info = $this->PricingTableModel->create($arr_data);  
                }
                if($store_info)
                {
                    Flash::success('Data Inserted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Data Inserting.');
                }
            }
            return redirect()->back();
        }  
        /*-----------------------------update pricing note--------------------------*/
        public function updatenote(Request $request)
        {
            $arr_rules                     = array();
            $arr_rules['pricing_note']     = 'required';
          
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }
            
            $form_data                      = array();
            $form_data                      = $request->all();
            $arr_data                       = array();
            $arr_data['pricing_note']       = $form_data['pricing_note'];
        
            if($this->PricingNoteModel->truncate()) 
            { 
                for($i=0;$i<count($form_data['pricing_note']);$i++)
                { 
                     $arr_data['pricing_note']  = $form_data['pricing_note'][$i];
                     $info = $this->PricingNoteModel->create($arr_data);  
                }
                if($info)
                {
                    Flash::success('Data Inserted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Data Inserting.');
                }
            }
            return redirect()->back();
        }  

}