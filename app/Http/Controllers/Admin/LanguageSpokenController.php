<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\LanguageModel;
use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use Response;
/*-------------------------------Deepak Bari(08th Aug, 2017)---------------------------*/

class LanguageSpokenController extends Controller
{
     public function __construct(
                                    LanguageModel               $LanguageModel 
                                )
    {        
        $this->LanguageModel                = $LanguageModel;
        $this->arr_view_data                = [];
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/languages");
        $this->module_title                 = "Language";
        $this->module_view_folder           = "admin.language";
        $this->admin_panel_slug             = config('app.project.admin_panel_slug');
        $this->public_img_path              = url('/public').config('app.project.img_path.card-photo');
        $this->base_path                    = base_path().'/public';
        $this->site_url                     = url('/');
    }

    public function index()
    { 
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_language = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {             
                $arr_manage = $this->LanguageModel->get();                                                 
             
                if($arr_manage!=FALSE)
                {
                    $arr_language = $arr_manage->toArray();
                }

                $this->arr_view_data['arr_language']     = $arr_language; 
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = 'Languages';
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

    public function create()
    {
        $this->arr_view_data['page_title']      = 'Add Language';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/create',$this->arr_view_data);   
    }

    public function store(Request $request)
    {   
        $arr_rules = array();
        $arr_rules['language']    = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all();
        $arr_data = array();
    
        $arr_data['language']             = $form_data['language'];
        $arr_data['language_status']      = '1';

        $duplicate = $this->LanguageModel->where('language',$arr_data['language'])->count();
       
        if($duplicate>0)
        {
          Flash::success('This Language is already added.');
          return redirect()->back();
        }
        else
        {
          $store_info = $this->LanguageModel->create($arr_data);

          if($store_info)
          {
            Flash::success('Language Added Successfully.');
          }
          else
          {
            Flash::error('Problem Occured, While adding language.');
          }

          return redirect()->back();
        }
    }

    public function edit($enc_id=FALSE)
    {
        if($enc_id)
        {
           $language_id  = base64_decode($enc_id);

           $language_info = $this->LanguageModel->where('id',$language_id)->first();

           if($language_info)
           {
                $language_data = $language_info->toArray();
           }   

           $this->arr_view_data['language_data']      = $language_data;
           $this->arr_view_data['enc_id']          = $enc_id;
           $this->arr_view_data['page_title']      = 'Edit Language';
           $this->arr_view_data['module_url_path'] = $this->module_url_path;
           $this->arr_view_data['module_title']    = str_singular($this->module_title);
           return view($this->module_view_folder.'/edit',$this->arr_view_data);      
        }

        return redirect()->back(); 
    }

    public function update(Request $request,$enc_id)
    { 
        if($enc_id)
        {
            $language_id = base64_decode($enc_id);
            
            $arr_rules = array();
            $arr_rules['language']    = 'required';
            
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data  = array();

            $arr_data['language']    = $form_data['language'];
           
            $update_data = $this->LanguageModel->where('id',$language_id)->update($arr_data);

            if($update_data)
            {
                Flash::success('Language Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Page.');
            }
        }

        return redirect()->back();
    }

    public function activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $language_id = base64_decode($enc_id);
            $language_info = $this->LanguageModel->where('id',$language_id)->first();

            if(sizeof($language_info)>0)
            {
                $update_result = $this->LanguageModel->where('id',$language_id)->update(['language_status'=>'1']);
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
    }

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $language_id = base64_decode($enc_id);
            $language_info = $this->LanguageModel->where('id',$language_id)->first();

            if(sizeof($language_info)>0)
            {
                $update_result = $this->LanguageModel->where('id',$language_id)->update(['language_status'=>'0']);
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
    }

    public function multi_action(Request $request)
    {  
        $arr_rules                     = array();
        $arr_rules['multi_action']     = 'required';
        $arr_rules['checked_record']   = 'required';

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
               $result = $this->LanguageModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {               
                        Flash::success('Language(s) Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {
                $result = $this->LanguageModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['language_status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success('Language(s) Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                $result = $this->LanguageModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['language_status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success('Language(s) Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {
        if($enc_id)
        {
            $language_id = base64_decode($enc_id);

            $result = $this->LanguageModel->where('id',$language_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Language Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Language.');
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
    }

}   
