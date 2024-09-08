<?php //Laxmi
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SpecialityModel;
use Validator;
use Flash;
use Session;

class SpecialityController extends Controller
{
	public function __construct(SpecialityModel $static)
    {
        $this->SpecialityModel           = $static;
        $this->arr_view_data             = [];
        $this->module_url_path           = url(config('app.project.admin_panel_slug')."/speciality");
        $this->speciality_img_base_path  = base_path() . '/public'.config('app.project.img_path.speciality_image');
        $this->speciality_img_url_path   = url('/') .config('app.project.img_path.speciality_image');
        $this->module_title              = "Speciality";
        $this->module_url_slug           = "speciality";
        $this->module_view_folder        = "admin.speciality";        
    }
    public function index()
    {
        $static_info = $this->SpecialityModel->get();
    	if($static_info!=FALSE)
    	{
    		$pages_data = $static_info->toArray();
    	}

    	$this->arr_view_data['page_title']       = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
    	$this->arr_view_data['speciality_img_url_path'] = $this->speciality_img_url_path;
    	$this->arr_view_data['module_title']     = str_singular($this->module_title);    	
        $this->arr_view_data['arr_static_pages'] = $pages_data;
        //$this->arr_view_data['pages_data'] = $pages_data;
    	return view($this->module_view_folder.'/index',$this->arr_view_data);	 
    }
    public function create()
    {
        //dd($this->speciality_img_base_path);
        $this->arr_view_data['page_title']      = 'Add Doctor Speciality';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        return view($this->module_view_folder.'/create',$this->arr_view_data);   
    }
    public function store(Request $request)
    {
        $arr_rules = array();

        $arr_rules['speciality']    = 'required';        
        $arr_rules['meta_title']    = 'required';
        $arr_rules['meta_keyword']  = 'required';
        $arr_rules['meta_desc']     = 'required';        

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all();
        $arr_data  = array();

        $arr_data['speciality']   = $form_data['speciality'];                
        $arr_data['meta_title']   = $form_data['meta_title'];
        $arr_data['meta_keyword'] = $form_data['meta_keyword'];
        $arr_data['meta_desc']    = $form_data['meta_desc'];


        if($request->hasFile('speciality_image')) 
        {
            $img_valiator = Validator::make(array('image'=>$request->file('speciality_image')),array(
                                            'image' => 'mimes:png,jpeg,jpg'));            

              if ($request->file('speciality_image')->isValid() && $img_valiator->passes())
              {
                  $speciality_image_name = "";
                  $fileExtension = strtolower($request->file('speciality_image')->getClientOriginalExtension()); 

                  if($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg')
                  {
                      $speciality_image_name = sha1(uniqid().$speciality_image_name.uniqid()).'.'.$fileExtension;

                      $request->file('speciality_image')->move($this->speciality_img_base_path, $speciality_image_name);                      

                      $arr_data['image'] = $speciality_image_name;
                  }
              }
        }
        $store_info = $this->SpecialityModel->create($arr_data);

        if($store_info)
        {
            Flash::success('Doctor Speciality Add Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Creating page.');
        }

        return redirect()->back();
    }

     public function edit($enc_id=null)
    {
        if($enc_id)
        {
            $page_id  = base64_decode($enc_id);

            $page_information = $this->SpecialityModel->where('id',$page_id)->first();


            if($page_information)
            {
                $page_data = $page_information->toArray();
            }   

            $this->arr_view_data['pages_data']      = $page_data;
            $this->arr_view_data['img_path']        = $this->speciality_img_url_path;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Edit Doctor Speciality';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);

            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
        }

        return redirect()->back();
    }

     public function update(Request $request, $enc_id)
    { 
        $page_id = base64_decode($enc_id);
        $arr_rules = array();
        $status = FALSE;
        //dd($request->all());
       /* 
        $arr_rules['speciality']    = 'required';        
        $arr_rules['meta_title']    = 'required';
        $arr_rules['meta_keyword']  = 'required';
        $arr_rules['meta_desc']     = 'required';          

      
       $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('error','Error while updating profile details.');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }*/
        
        $form_data = array();
        $form_data = $request->all();

        $obj_speciality = $this->SpecialityModel->where('id',$page_id);
        //$update_data = $this->SpecialityModel->where('id',$page_id)->update($arr_data);

        if($obj_speciality && sizeof($obj_speciality) > 0)
        {
           $arr_data = array();

           $arr_data['speciality']   = $form_data['speciality'];                
           $arr_data['meta_title']   = $form_data['meta_title'];
           $arr_data['meta_keyword'] = $form_data['meta_keyword'];
           $arr_data['meta_desc']    = $form_data['meta_desc'];         

         if($request->hasFile('speciality_image')) 
          {
            $img_valiator = Validator::make(array('image'=>$request->file('speciality_image')),array(
                                            'image' => 'mimes:png,jpeg,jpg')); 

              if ($request->file('speciality_image')->isValid() && $img_valiator->passes())
              {
                  $speciality_image_name = $form_data['speciality_image'];
                  $fileExtension = strtolower($request->file('speciality_image')->getClientOriginalExtension()); 

                  if($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg')
                  {
                      $speciality_image_name = sha1(uniqid().$speciality_image_name.uniqid()).'.'.$fileExtension;
                      $request->file('speciality_image')->move($this->speciality_img_base_path, $speciality_image_name);
                      $arr_data['image'] = $speciality_image_name;

                       //unlink exiting image
                      if ($speciality_image_name && isset($obj_speciality->speciality_image) && $obj_speciality->speciality_image!="") 
                      {
                          if ($obj_speciality->speciality_image!='defaul_profile_image.png') 
                          {
                              $file_exits = file_exists($this->speciality_img_base_path.$obj_speciality->speciality_image);

                              if ($file_exits) 
                              {
                                  unlink($this->speciality_img_base_path.$obj_speciality->profile_image);
                              }
                          }
                      }
                  }
              }
          }
            $status = $obj_speciality->update($arr_data);
            $obj_speciality_details  = $this->SpecialityModel->where('id',$page_id); 
            //dd($status);       
        }
        if ($status) 
        {
              $this->arr_view_data['arr_data']                = $arr_data;  
              $this->arr_view_data['page_title']              = "Edit Doctor Speciality";
              $this->arr_view_data['module_title']            = "Edit Doctor Speciality";
              $this->arr_view_data['module_url_path']         = $this->module_url_path;
                               
              Flash::success('Doctor Speciality Updated Successfully');
        }
        else
        {
             Flash::error('Problem Occured, While Updating Page.');
        }        
        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result = $this->SpecialityModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Doctor Speciality Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Page.');
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
    public function activate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result = $this->SpecialityModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['speciality_status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Doctor Speciality Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Page Status.');
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
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result = $this->SpecialityModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['speciality_status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Doctor Speciality Dectivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Dectivating Page Status.');
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
               $result = $this->SpecialityModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {              
                        Flash::success('Doctor Speciality Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {

                $result = $this->SpecialityModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['speciality_status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Doctor Speciality Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
               
                $result = $this->SpecialityModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['speciality_status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Doctor Speciality Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }

}


 ?>