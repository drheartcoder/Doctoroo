<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Models\ManageFeesModel;
use App\Models\DoctroFeesModel;
use Validator;
use Flash;
use Sentinel;
use Session;
/*-------------------------------Ankit Aher(20th feb 2017)---------------------------*/
class ManageFeesController extends Controller
{
     public function __construct(ManageFeesModel $manage, DoctroFeesModel $DoctroFeesModel
        )
    {
        $this->ManageFeesModel         = $manage;
        $this->DoctroFeesModel         = $DoctroFeesModel;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/managefees");
        $this->module_title            = "Manage Fees";
        $this->module_view_folder      = "admin.managefees";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }

     public function index()
     {
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_manage_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                //$arr_manage =  $this->ManageFeesModel->get();   
                $arr_manage =  $this->DoctroFeesModel->first();   
                
                if($arr_manage!=FALSE)
                {
                    $arr_manage_settings = $arr_manage->toArray();
                }

                $this->arr_view_data['arr_data']        = $arr_manage_settings;
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
     public function update(request $request)
    {   
         $arr_rules = $form_data  = array();
         $form_data               = $request->all();
         $arr_data                =   array();
         $arr_data['fees']        = $form_data['fees'];

         $fee                 = $form_data['fees'];
         $doctoroo_commission = $form_data['doctoroo_commission'];
         $doctoroo_fee        = $form_data['doctoroo_fee'];
         
         $fee_arr['fee']                 = $fee;
         $fee_arr['doctoroo_commission'] = $doctoroo_commission;
         $fee_arr['doctoroo_fee']        = $doctoroo_fee;


        $fee = $fee;

        $doctoroo_commission = $doctoroo_commission ;
        $doctoroo_fee = $doctoroo_fee;

        $commision = $fee / $doctoroo_commission;
        $total_commission = $commision + $doctoroo_fee; 
        
        $total_fee = $fee + $total_commission; 


        $fee_arr['total_fee']        = $total_fee;

        $update_info = $this->DoctroFeesModel->where('id','1')->update($fee_arr);   
         
        /*foreach($form_data['fees'] as $fee_key=>$fee_value)
        {
           $store_info= $this->ManageFeesModel->where('label',$fee_key)->update(['fees'=>$fee_value]);

        }*/

         if($update_info) 
         {
            Flash::success('Consultation Fee Updated Successfully.'); 
         }
         else
         {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
         }
         return redirect()->back();
    }
       
   
}   
