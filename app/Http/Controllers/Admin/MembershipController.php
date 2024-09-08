<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\FaqsMembershipModel;
use App\Models\FaqMembershipCategoryModel;
use App\Models\DoctorPremiumMembershipModel;
use App\Models\DoctorPremiumRateModel;
use App\Models\MembershipPaymentModel;
use App\Models\MembershipDiscountCodeModel;
use App\Models\MembershipUsedDiscountModel;

use Validator;
use Flash;
use Sentinel;
use Session;


/*-------------------------------Prashant Patil(22th aug 2017)---------------------------*/
class MembershipController extends Controller
{
     public function __construct(FaqsMembershipModel            $faqs_membership,
                                FaqMembershipCategoryModel      $faq_membership_cat,
                                DoctorPremiumRateModel          $DoctorPremiumRateModel,
                                DoctorPremiumMembershipModel    $DoctorPremiumMembershipModel,
                                MembershipPaymentModel          $MembershipPaymentModel,
                                MembershipDiscountCodeModel     $MembershipDiscountCodeModel,
                                MembershipUsedDiscountModel     $MembershipUsedDiscountModel
                                )
    {
        $this->FaqsMembershipModel              = $faqs_membership;
        $this->FaqMembershipCategoryModel       = $faq_membership_cat;
        $this->DoctorPremiumRateModel           = $DoctorPremiumRateModel;
        $this->DoctorPremiumMembershipModel     = $DoctorPremiumMembershipModel;
        $this->MembershipPaymentModel           = $MembershipPaymentModel;
        $this->MembershipDiscountCodeModel      = $MembershipDiscountCodeModel;
        $this->MembershipUsedDiscountModel      = $MembershipUsedDiscountModel;

        $this->arr_view_data                    = [];
        $this->module_url_path                  = url(config('app.project.admin_panel_slug')."/membership");
        $this->module_title                     = "Membership";
        $this->module_view_folder               = "admin.membership";
        $this->admin_panel_slug                 = config('app.project.admin_panel_slug');
    }

    public function index()
    {
        
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_membership = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $arr_membership =  $this->MembershipPaymentModel->with('userinfo')->orderBy('id', 'DESC')->get();
                if($arr_membership!=FALSE)
                {
                    $arr_membership = $arr_membership->toArray();
                }

                $this->arr_view_data['arr_membership']  = $arr_membership;
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

    public function edit($enc_id=null)
    {
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            $membership_arr = [];
            $membership = $this->DoctorPremiumRateModel->with('userinfo','membership_payment')->where('id',$id)->first();
            if($membership)
            {
                $membership_arr = $membership->toArray();
            }
            $this->arr_view_data['membership_arr']  = $membership_arr;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Edit Membership ';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);

            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
        }

        return redirect()->back();
    }

    public function update(Request $request,$enc_id=null)
    { 
        
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_rules = array();
            $arr_rules['day_rate']     = 'required';
            $arr_rules['night_rate']    = 'required';
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();

           
           

            $arr_data['day_rate']    = $form_data['day_rate'];
            $arr_data['night_rate']       = $form_data['night_rate'];           
                    
            $update_data = $this->DoctorPremiumRateModel->where('id',$id)->update($arr_data);
            
            if($update_data)
            {
                Flash::success('Membership Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Data.');
            }

        }

        return redirect()->back();
    }

     public function show($enc_id=null)
    {
        if($enc_id)
        {
            $id  = base64_decode($enc_id);
            $membership_arr = [];
            $membership = $this->MembershipPaymentModel->with('userinfo')->where('id',$id)->first();
            if($membership)
            {
                $membership_arr = $membership->toArray();
            }
            
            $this->arr_view_data['membership_arr']  = $membership_arr;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Show Membership ';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);

            return view($this->module_view_folder.'/show',$this->arr_view_data);     
        }

        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {

        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->DoctorPremiumRateModel->where('id',$id)->delete();

            if($result)
            {
                Flash::success('Data Deleted Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Deleting Data.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function multi_action(Request $request)
    {
       
        $arr_rules                       = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');


        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {
               $result = $this->DoctorPremiumRateModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success('Data Deleted Successfully'); 
                    }
                }        
            } 
        }

        return redirect()->back();
    }

    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 16/10/2017
    | Output    : Success or Error
    */

    public function plan_price(Request $request)
    {
        $membership_arr = $this->DoctorPremiumMembershipModel->first();
        if(isset($membership_arr) && !empty($membership_arr))
        {
                $this->arr_view_data['membership_arr'] = $membership_arr->toArray();
        }

        $this->arr_view_data['page_title']      = 'Update Membership ';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/plan_price/index',$this->arr_view_data);
    } // end membership_plan_price

    public function update_plan(Request $request,$enc_id=null)
    { 
            
            $arr_rules = array();
            $arr_rules['monthly_amount']     = 'required';
            $arr_rules['monthly_gst']        = 'required';
            $arr_rules['monthly_discount']   = 'required';
            $arr_rules['annually_amount']    = 'required';
            $arr_rules['annually_gst']       = 'required';
            $arr_rules['annually_discount']  = 'required';

            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();
           
            $arr_data['monthly_amount']     = $form_data['monthly_amount'];
            $arr_data['monthly_gst']        = $form_data['monthly_gst'];
            $arr_data['monthly_discount']   = $form_data['monthly_discount'];
            $arr_data['annually_amount']    = $form_data['annually_amount'];
            $arr_data['annually_gst']       = $form_data['annually_gst'];
            $arr_data['annually_discount']  = $form_data['annually_discount'];

            $total_monthly_amt =  $form_data['monthly_amount'] + $form_data['monthly_gst'];
            $total_annually_amt =  $form_data['annually_amount'] + $form_data['annually_gst'];

            $arr_data['total_monthly_amount']  = $total_monthly_amt;
            $arr_data['total_annually_amount']  = $total_annually_amt;

                             
            $update_data = $this->DoctorPremiumMembershipModel->where('id','1')->update($arr_data);
            
            if($update_data)
            {
                Flash::success('Membership plan Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Data.');
            }

        return redirect()->back();
    }



    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 25/12/2017
    | Output    : Success or Error
    */

    public function discount_code_list()
    {

        $get_membership_discount_code = $this->MembershipDiscountCodeModel->get();
        if($get_membership_discount_code)
        {
            $this->arr_view_data['membership_discount_code'] = $get_membership_discount_code->toArray();
        }

        $this->arr_view_data['page_title']      = 'Membership Discount Code';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/discount_code/index',$this->arr_view_data);

    } // end discount_code_list



    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 25/12/2017
    | Output    : Success or Error
    */

    public function discount_code_create()
    {

        $this->arr_view_data['page_title']      = 'Membership Discount Code';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/discount_code/create',$this->arr_view_data);

    } // end discount_code_create


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 26/12/2017
    | Output    : Success or Error
    */

    public function discount_code_store(Request $request)
    {

        $form_data = $request->all();

        $mydate = date_default_timezone_set("Africa/Maputo");

        $data['code']               = "MDC".rand(0, 9).date('ymdhis').rand(0, 9);
        $data['percentage']         = $form_data['percentage'];
        $data['start_expiry_date']  = $form_data['start_year'].'-'.$form_data['start_month'].'-'.$form_data['start_day'];
        $data['end_expiry_date']    = $form_data['end_year'].'-'.$form_data['end_month'].'-'.$form_data['end_day'];
        $data['status']             = $form_data['status'];

        $store_date = $this->MembershipDiscountCodeModel->create($data);
        if($store_date)
        {
            Flash::success('Membership Discount Code Added Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Adding Data.');
        }
        return redirect(url('/').'/admin/membership/discount_code/list');

    } // end discount_code_store


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 25/12/2017
    | Output    : Success or Error
    */

    public function discount_code_edit($enc_id)
    {

        $id = base64_decode($enc_id);

        $get_membership_discount_code = $this->MembershipDiscountCodeModel->where('id', $id)->first();
        if($get_membership_discount_code)
        {
            $this->arr_view_data['membership_discount_code'] = $get_membership_discount_code->toArray();
        }

        $this->arr_view_data['page_title']      = 'Membership Discount Code';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/discount_code/edit',$this->arr_view_data);

    } // end discount_code_edit


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 26/12/2017
    | Output    : Success or Error
    */

    public function discount_code_update(Request $request, $enc_id)
    {

        $form_data = $request->all();

        $data['code']               = $form_data['discount_code'];
        $data['percentage']         = $form_data['percentage'];
        $data['start_expiry_date']  = $form_data['start_year'].'-'.$form_data['start_month'].'-'.$form_data['start_day'];
        $data['end_expiry_date']    = $form_data['end_year'].'-'.$form_data['end_month'].'-'.$form_data['end_day'];
        $data['status']             = $form_data['status'];

        $id = base64_decode($enc_id);

        $update_date = $this->MembershipDiscountCodeModel->where('id', $id)->update($data);
        if($update_date)
        {
            Flash::success('Membership Discount Code Updated Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Updating Data.');
        }
        return redirect()->back();

    } // end discount_code_update


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 25/12/2017
    | Output    : Success or Error
    */

    public function discount_code_view($enc_id)
    {

        $id = base64_decode($enc_id);

        $get_membership_discount_code = $this->MembershipDiscountCodeModel->where('id', $id)->first();
        if($get_membership_discount_code)
        {
            $this->arr_view_data['membership_discount_code'] = $get_membership_discount_code->toArray();
        }

        $get_used_discount = $this->MembershipUsedDiscountModel->with('discount_code', 'user_details')->get();
        if($get_used_discount)
        {
            $this->arr_view_data['used_discount'] = $get_used_discount->toArray();
        }
        //dd($this->arr_view_data['used_discount']);

        $this->arr_view_data['page_title']      = 'Membership Discount Code';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/discount_code/view',$this->arr_view_data);

    } // end discount_code_view


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 25/12/2017
    | Output    : Success or Error
    */

    public function discount_code_delete($enc_id)
    {

        $id = base64_decode($enc_id);

        $delete_date = $this->MembershipDiscountCodeModel->where('id', $id)->delete();
        if($delete_date)
        {
            Flash::success('Membership Discount Code Deleted Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Deleting Data.');
        }
        return redirect()->back();

    } // end discount_code_delete


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 26/12/2017
    | Output    : Success or Error
    */

    public function discount_code_activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->MembershipDiscountCodeModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->MembershipDiscountCodeModel->where('id',$id)->update(['status'=>'active']);
                if($update_result)
                {
                    Flash::success('Language Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }

        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    } // end discount_code_activate


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 26/12/2017
    | Output    : Success or Error
    */

    public function discount_code_deactivate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->MembershipDiscountCodeModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->MembershipDiscountCodeModel->where('id',$id)->update(['status'=>'block']);
                if($update_result)
                {
                    Flash::success('Language Dectivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    } // end discount_code_deactivate


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 26/12/2017
    | Output    : Success or Error
    */

    public function discount_code_multi_action(Request $request)
    {
       
        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');


        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            { 
        
                $delete_data = $this->MembershipDiscountCodeModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success('Doctor\'s Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->MembershipDiscountCodeModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'active']);

                    if($result_status)
                    { 
                        Flash::success('Doctor\'s  Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->MembershipDiscountCodeModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'block']);

                    if($result_status)
                    {  
                        Flash::success('Doctor\'s  Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
    } // end discount_code_multi_action
   
}   
