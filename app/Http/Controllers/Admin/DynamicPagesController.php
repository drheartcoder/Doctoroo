<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\DynamicPagesModel;
use App\Models\DescriptionModel;
use App\Models\DynamicAboutDoctorModel;
use App\Models\DynamicFaqModel;
use Validator;
use Flash;
class DynamicPagesController extends Controller
{
    public function __construct(DynamicPagesModel $dynamic,DescriptionModel $desc,DynamicAboutDoctorModel $dynamicdoctor,DynamicFaqModel $dynamicfaq)
    {
        $this->DynamicPagesModel            = $dynamic;
        $this->DescriptionModel             = $desc;
        $this->DynamicAboutDoctorModel      = $dynamicdoctor;
        $this->DynamicFaqModel              = $dynamicfaq;
        $this->arr_view_data                = [];
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/dynamic_pages");
        $this->module_title                 = "Dynamic Pages";
        $this->module_url_slug              = "dynamic_pages";
        $this->module_view_folder           = "admin.dynamic_pages";
        $this->admin_panel_slug = config('app.project.admin_panel_slug');
    }

    public function index()
    {

       /* $dynamic_info = $this->DynamicPagesModel->orderBy('page_id', 'DESC')->get();*/
        $dynamic_info = $this->DynamicPagesModel->get();
    	if($dynamic_info!=FALSE)
    	{
    		$pages_data = $dynamic_info->toArray();
    	}
    	$this->arr_view_data['page_title']        = str_singular($this->module_title);
    	$this->arr_view_data['module_url_path']   = $this->module_url_path;
    	$this->arr_view_data['module_title']      = str_singular($this->module_title);
    	$this->arr_view_data['arr_dynamic_pages'] = $pages_data;
    	return view($this->module_view_folder.'/index',$this->arr_view_data);	 
    }

    public function create()
    {
    	$this->arr_view_data['page_title']      = 'Add Dynamic Pages';
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
    	$this->arr_view_data['module_title']    = str_singular($this->module_title);
    	return view($this->module_view_folder.'/create',$this->arr_view_data);	 
    }

    public function store(Request $request)
    {   $page_slug="";
    	$arr_rules                 = array();
    	$arr_rules['page_name']    = 'required';
    	$arr_rules['page_title']   = 'required';
    	$arr_rules['meta_title']   = 'required';
    	$arr_rules['meta_keyword'] = 'required';
    	$arr_rules['meta_desc']    = 'required';
    	$arr_rules['page_desc']    = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);

    	if($validator->fails())
    	{
    		return redirect()->back()->withError($validator)->withInput($request->all());
    	}

    	$form_data  = array();
    	$form_data  = $request->all();
    	$arr_data   = array();
    	$arr_data['page_name']     = $form_data['page_name'];
    	$arr_data['page_slug']     = str_slug($form_data['page_name']);
    	$arr_data['page_title']    = $form_data['page_title'];
    	$arr_data['page_desc']     = $form_data['page_desc'];
    	$arr_data['meta_title']    = $form_data['meta_title'];
    	$arr_data['meta_keyword']  = $form_data['meta_keyword'];
    	$arr_data['meta_desc']     = $form_data['meta_desc'];

        $duplicate = $this->DynamicPagesModel->where('page_slug',$arr_data['page_slug'])->count();
       
        if($duplicate>0)
        {
          Flash::success('page slug already exist.');
          return redirect()->back();

        }
    
        else
        {
        	$store_info = $this->DynamicPagesModel->create($arr_data);

        	if($store_info)
        	{
        		Flash::success('Page Created Successfully.');
        	}
        	else
        	{
        		Flash::error('Problem Occured, While Creating page.');
        	}

        	return redirect()->back();
        }
    }

    public function edit($enc_id=null)
    { 
    	if($enc_id)
    	{
    		$page_id  = base64_decode($enc_id);

    		$page_information = $this->DynamicPagesModel->where('page_id',$page_id)->first();
            $page_description = $this->DescriptionModel->where('page_id',$page_id)->get();

    		if($page_information)
    		{
    			$page_data = $page_information->toArray();
    		}
            if($page_description)
            {
                $page_desc = $page_description->toArray();
            }	
    		$this->arr_view_data['pages_data']      = $page_data;
            $this->arr_view_data['pages_desc']      = $page_desc;
    		$this->arr_view_data['enc_id']          = $enc_id;
    		$this->arr_view_data['page_title']      = 'Edit Dynamic Pages';
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
    		$page_id = base64_decode($enc_id);

    		$arr_rules                         = array();
    		$arr_rules['title']                = 'required';
	    	$arr_rules['subtitle']             = 'required';
	    	$arr_rules['title1']               = 'required';
	    	$arr_rules['description1']         = 'required';
            $arr_rules['title2']               = 'required';
            $arr_rules['description2']         = 'required';
            $arr_rules['icon_description1']    = 'required';
            $arr_rules['icon_description2']    = 'required';
            $arr_rules['icon_description3']    = 'required';
            $arr_rules['title3']               = 'required';
	    	$arr_rules['description3']         = 'required';
            $arr_rules['meta_title']           = 'required';
            $arr_rules['meta_keyword']         = 'required';
            $arr_rules['meta_desc']            = 'required';
	    	$arr_rules['description']          = 'required';

	    	$validator = Validator::make($request->all(),$arr_rules);

	    	if($validator->fails())
	    	{
	    		return redirect()->back()->withError($validator)->withInput($request->all());
	    	}

	    	$form_data                        = array();
	    	$form_data                        = $request->all();
	    	$arr_data                         = array();
            $description                      = array(); 
	    	$arr_data['title']                = $form_data['title'];
	    	$arr_data['subtitle']             = $form_data['subtitle'];
	    	$arr_data['title1']               = $form_data['title1'];
	    	$arr_data['description1']         = $form_data['description1'];
	    	$arr_data['title2']               = $form_data['title2'];
	    	$arr_data['description2']         = $form_data['description2'];
            $arr_data['icon_description1']    = $form_data['icon_description1'];
            $arr_data['icon_description2']    = $form_data['icon_description2'];
            $arr_data['icon_description3']    = $form_data['icon_description3'];
            $arr_data['title3']               = $form_data['title3'];
            $arr_data['description3']         = $form_data['description3'];
            $arr_data['meta_title']           = $form_data['meta_title'];
            $arr_data['meta_keyword']         = $form_data['meta_keyword'];
            $arr_data['meta_desc']            = $form_data['meta_desc'];
           
	    	$update_data = $this->DynamicPagesModel->where('page_id',$page_id)->update($arr_data);
           
	    	if($update_data)
	    	{ 
                 $this->DescriptionModel->where('page_id',$page_id)->delete();
               
                 for($i=0;$i<count($form_data['description']);$i++)
                { 
                     $arr_desc['description']  = $form_data['description'][$i];
                     $arr_desc['page_id']      = $page_id;
                    
                    $data = $this->DescriptionModel->create($arr_desc);  
                }

	    	  Flash::success('Dynamic Page Updated Successfully.');
	    	}
	    	else
	    	{
	    		Flash::error('Problem Occured, While Updating Dynamic Page.');
	    	}

	    }

	    return redirect()->back();
    }

    public function dynamicedit($enc_id=null)
    { 
        if($enc_id)
        {
            $page_id  = base64_decode($enc_id);

            $page_information = $this->DynamicPagesModel->where('page_id',$page_id)->first();
            $page_description = $this->DynamicAboutDoctorModel->where('page_id',$page_id)->get();
            $page_faq         = $this->DynamicFaqModel->where('page_id',$page_id)->get();
            if($page_information)
            {
                $page_data = $page_information->toArray();
            }
            if($page_description)
            {
                $page_desc = $page_description->toArray();
            } 
             if($page_faq)
            {
                $page_faqdesc = $page_faq->toArray();
            }     

            $this->arr_view_data['pages_data']      = $page_data;
            $this->arr_view_data['pages_desc']      = $page_desc;
            $this->arr_view_data['pages_faq']       = $page_faqdesc;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Edit Dynamic Pages';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);
            return view($this->module_view_folder.'/dynamicedit',$this->arr_view_data);     
        }

        return redirect()->back();
    }
    public function dynamicupdate(Request $request,$enc_id=null)
    { 
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $arr_rules = array();
            $arr_rules['title']                = 'required';
            $arr_rules['subtitle']             = 'required';
            $arr_rules['title1']               = 'required';
            $arr_rules['description1']         = 'required';
            $arr_rules['title2']               = 'required';
            $arr_rules['description2']         = 'required';
            $arr_rules['title3']               = 'required';
            $arr_rules['description3']         = 'required';
            $arr_rules['title4']               = 'required';
            $arr_rules['description4']         = 'required';
            $arr_rules['subdescription4']      = 'required';
            $arr_rules['title5']               = 'required';
            $arr_rules['description5']         = 'required';
            $arr_rules['title6']               = 'required';
            $arr_rules['description6']         = 'required';
            $arr_rules['subdescription6']      = 'required';
            $arr_rules['title7']               = 'required';
            $arr_rules['description7']         = 'required';
            $arr_rules['meta_title']           = 'required';
            $arr_rules['meta_keyword']         = 'required';
            $arr_rules['meta_desc']            = 'required';
            
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();
            $description= array(); 
            $arr_data['title']             = $form_data['title'];
            //$arr_data['page_slug']  = str_slug($form_data['page_name']);
            $arr_data['subtitle']          = $form_data['subtitle'];
            $arr_data['title1']            = $form_data['title1'];
            $arr_data['description1']      = $form_data['description1'];
            $arr_data['title2']            = $form_data['title2'];
            $arr_data['description2']      = $form_data['description2'];
            $arr_data['title3']            = $form_data['title3'];
            $arr_data['description3']      = $form_data['description3'];
            $arr_data['title4']            = $form_data['title4'];
            $arr_data['description4']      = $form_data['description4'];
            $arr_data['subdescription4']   = $form_data['subdescription4'];
            $arr_data['title5']            = $form_data['title5'];
            $arr_data['description5']      = $form_data['description5'];
            $arr_data['title6']            = $form_data['title6'];
            $arr_data['description6']      = $form_data['description6'];
            $arr_data['subdescription6']   = $form_data['subdescription6'];
            $arr_data['title7']            = $form_data['title7'];
            $arr_data['description7']      = $form_data['description7'];
            $arr_data['meta_title']        = $form_data['meta_title'];
            $arr_data['meta_keyword']      = $form_data['meta_keyword'];
            $arr_data['meta_desc']         = $form_data['meta_desc'];
            // $arr_data['description']  = $form_data['description'];

            $update_data = $this->DynamicPagesModel->where('page_id',$page_id)->update($arr_data);
           //dd($update_data);
            if($update_data)
            { 
                 $this->DynamicAboutDoctorModel->where('page_id',$page_id)->delete();
                 $this->DynamicFaqModel->where('page_id',$page_id)->delete();
                 for($i=0;$i<count($form_data['description']);$i++)
                { 
                     $arr_desc['description']  = $form_data['description'][$i];
                     $arr_desc['page_id']      = $page_id;
                    
                    $data = $this->DynamicAboutDoctorModel->create($arr_desc);
               
                }
                
                /*for($i=0;$i<count($form_data['faqdescription']);$i++)
                { 
                     $arr_faqdesc['faqdescription']  = $form_data['faqdescription'][$i];
                     $arr_faqdesc['page_id']      = $page_id;
                    
                    $data = $this->DynamicFaqModel->create($arr_faqdesc);
               
                }*/


              Flash::success('Data Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Data.');
            }

        }

        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {

        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result = $this->DynamicPagesModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Page Deleted Successfully.');
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
 

}
